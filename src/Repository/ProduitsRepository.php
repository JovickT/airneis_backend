<?php

namespace App\Repository;

use App\Entity\Produits;
use DateTime;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @extends ServiceEntityRepository<Produits>
 *
 * @method Produits|null find($id, $lockMode = null, $lockVersion = null)
 * @method Produits|null findOneBy(array $criteria, array $orderBy = null)
 * @method Produits[]    findAll()
 * @method Produits[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class ProduitsRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, Produits::class);
    }

    //    /**
    //     * @return Produits[] Returns an array of Produits objects
    //     */
    //    public function findByExampleField($value): array
    //    {
    //        return $this->createQueryBuilder('p')
    //            ->andWhere('p.exampleField = :val')
    //            ->setParameter('val', $value)
    //            ->orderBy('p.id', 'ASC')
    //            ->setMaxResults(10)
    //            ->getQuery()
    //            ->getResult()
    //        ;
    //    }

    //    public function findOneBySomeField($value): ?Produits
    //    {
    //        return $this->createQueryBuilder('p')
    //            ->andWhere('p.exampleField = :val')
    //            ->setParameter('val', $value)
    //            ->getQuery()
    //            ->getOneOrNullResult()
    //        ;
    //    }

    public function getProduits(){
        $produits = $this->createQueryBuilder('c')
        ->getQuery()
        ->getResult();

        $produitsArray = [];
        foreach ($produits as $produit) {
            $produitData = [];
            // $produitData['id'] = $produit->getId();
            $produitData['reference'] = $produit->getReference();
            $produitData['nom'] = $produit->getNom();
            $produitData['prix'] = $produit->getPrix();
            $produitData['description'] = $produit->getDescription();
            $produitData['quantite'] = $produit->getQuantite();
            $date_creation = $produit->getDateCreation();
            $produitData['date_creation'] = $date_creation->format('d/m/Y');

            $marque = $produit->getMarque();
            if ($marque) {
                $produitData['marque'] = $marque->getNom();
            } else {
                $produitData['marque'] = null;
            }

            $categorie = $produit->getCategorie();
            if ($categorie) {
                $produitData['categorie'] = $categorie->getNom();
            } else {
                $produitData['categorie'] = null;
            }
    
            $produitsArray[] = $produitData;
        }

        return $produitsArray;
    }
}
