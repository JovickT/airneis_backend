<?php

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

        if (isset($criteria['material']) && !empty($criteria['material'])) {
            $qb->innerJoin('p.materiaux', 'm')
                ->andWhere('m.nom IN (:material)')
                ->setParameter('material', $criteria['material']);
        }

        if (isset($criteria['category']) && !empty($criteria['category'])) {
            $qb->innerJoin('p.categorie', 'c')
                ->andWhere('c.nom IN (:category)')
                ->setParameter('category', $criteria['category']);
        }

        if (isset($criteria['price_min'])) {
            $qb->andWhere('p.prix >= :price_min')
                ->setParameter('price_min', $criteria['price_min']);
        }

        if (isset($criteria['price_max'])) {
            $qb->andWhere('p.prix <= :price_max')
                ->setParameter('price_max', $criteria['price_max']);
        }

        if (isset($criteria['in_stock']) && $criteria['in_stock']) {
            $qb->andWhere('p.quantite > 0');
        }

        // Pas utilisé pour le moment
        if (isset($criteria['sort_by'])) {
            $sortBy = $criteria['sort_by'];
            $sortOrder = $criteria['sort_order'] ?? 'ASC';

            $qb->orderBy('p.' . $sortBy, $sortOrder);
        }

        return $qb->getQuery()->getResult();
    }
}
