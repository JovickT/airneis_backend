<?php

namespace App\DataFixtures;

use App\Entity\Categories;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Persistence\ObjectManager;

class CategoriesFixtures extends Fixture
{
    public function load(ObjectManager $manager): void
    {
        $categories = [
            [1, 'Canapé'],
            [2, 'Table'],
            [3, 'Chaise'],
            [4, 'Lit'],
            [5, 'Armoire'],
            [6, 'Bibliothèque'],
            [7, 'Commode'],
            [8, 'Table basse'],
            [9, 'Buffet'],
            [10, 'Fauteuil'],
        ];

        foreach ($categories as [$id, $nom]) {
            $categorie = new Categories();
            $categorie->setNom($nom);
            $manager->persist($categorie);
        }

        $manager->flush();
    }
}
