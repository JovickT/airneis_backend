<?php

// namespace App\Repository;

// use App\Entity\Produits;
// use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
// use Doctrine\Persistence\ManagerRegistry;

// class RechercheRepository extends ServiceEntityRepository
// {
//     public function __construct(ManagerRegistry $registry)
//     {
//         parent::__construct($registry, Produits::class);
//     }

//     public function searchProduitsByKeyword(string $keyword): array
//     {
//         return $this->createQueryBuilder('p')
//             ->where('p.nom LIKE :keyword')
//             ->orWhere('p.description LIKE :keyword')
//             ->setParameter('keyword', '%' . $keyword . '%')
//             ->getQuery()
//             ->getResult();
//     }
// }




namespace App\Repository;

use App\Entity\Produits;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

class RechercheRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, Produits::class);
    }

    public function searchProduits(array $criteria): array
    {
        $qb = $this->createQueryBuilder('p');

        if (isset($criteria['title'])) {
            $qb->andWhere('p.nom LIKE :title')
                ->setParameter('title', '%' . $criteria['title'] . '%');
        }

        if (isset($criteria['description'])) {
            $qb->andWhere('p.description LIKE :description')
                ->setParameter('description', '%' . $criteria['description'] . '%');
        }

        if (isset($criteria['material'])) {
            $qb->andWhere('p.material LIKE :material')
                ->setParameter('material', '%' . $criteria['material'] . '%');
        }

        if (isset($criteria['price_min'])) {
            $qb->andWhere('p.prix >= :price_min')
                ->setParameter('price_min', $criteria['price_min']);
        }

        if (isset($criteria['price_max'])) {
            $qb->andWhere('p.prix <= :price_max')
                ->setParameter('price_max', $criteria['price_max']);
        }

        if (isset($criteria['category'])) {
            $qb->innerJoin('p.categorie', 'c')
                ->andWhere('c.nom = :category')
                ->setParameter('category', $criteria['category']);
        }

        if (isset($criteria['in_stock']) && $criteria['in_stock']) {
            $qb->andWhere('p.quantite > 0');
        }

        // Add sorting
        if (isset($criteria['sort_by'])) {
            $sortBy = $criteria['sort_by'];
            $sortOrder = $criteria['sort_order'] ?? 'ASC';

            $qb->orderBy('p.' . $sortBy, $sortOrder);
        }

        return $qb->getQuery()->getResult();
    }
}
