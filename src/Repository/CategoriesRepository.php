<?php

namespace App\Repository;

use App\Entity\Categories;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @extends ServiceEntityRepository<Categories>
 *
 * @method Categories|null find($id, $lockMode = null, $lockVersion = null)
 * @method Categories|null findOneBy(array $criteria, array $orderBy = null)
 * @method Categories[]    findAll()
 * @method Categories[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class CategoriesRepository extends ServiceEntityRepository
{
    private $produitsRepository;
    private $imageProduitRepository;

    public function __construct(ManagerRegistry $registry, ProduitsRepository $produitsRepository, ImageProduitRepository $imageProduitRepository)
    {
        parent::__construct($registry, Categories::class);
        $this->produitsRepository = $produitsRepository;
        $this->imageProduitRepository = $imageProduitRepository;
    }

    //    /**
    //     * @return Categories[] Returns an array of Categories objects
    //     */
    //    public function findByExampleField($value): array
    //    {
    //        return $this->createQueryBuilder('c')
    //            ->andWhere('c.exampleField = :val')
    //            ->setParameter('val', $value)
    //            ->orderBy('c.id', 'ASC')
    //            ->setMaxResults(10)
    //            ->getQuery()
    //            ->getResult()
    //        ;
    //    }

    //    public function findOneBySomeField($value): ?Categories
    //    {
    //        return $this->createQueryBuilder('c')
    //            ->andWhere('c.exampleField = :val')
    //            ->setParameter('val', $value)
    //            ->getQuery()
    //            ->getOneOrNullResult()
    //        ;
    //    }

    public function getCategories()
    {

        $categories = $this->createQueryBuilder('c')
            ->getQuery()
            ->getResult();

        $categoriesArray = [];
        foreach ($categories as $key => $categorie) {
            $categorieData = [];
            $categorieData['nom'] = $categorie->getNom();

            $randomProduct =  $this->produitsRepository->createQueryBuilder('p')
            ->where('p.categorie = :categoryId')
            ->setParameter('categoryId', $categorie->getIdCategorie())
            ->setMaxResults(1)
            ->getQuery()
            ->getResult();

            if ($randomProduct) {

                $images = $randomProduct[0]->getProduitImages();
                foreach ($images as $imageProduit) {
                    $image = $imageProduit->getImage();
                    if ($image) {
                        $categorieData['images'] = 'https://localhost:8000/uploads/'.$image->getLien();
                        $categorieData['display'] = "<img src='/uploads/{$image->getLien()}' alt='Image' width='100' />";
                    }
                }

            }            
            $categoriesArray[] = $categorieData;

        }

        return $categoriesArray;
    }

    public function getAllCategories(): array
    {
        $noms = $this->createQueryBuilder('c')
            ->select('c.nom')
            ->getQuery()
            ->getResult();

        $nomList = array_column($noms, 'nom');

        return $nomList;
    }

}
