<?php

namespace App\DataFixtures;

use App\Entity\Materiaux;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Persistence\ObjectManager;

class MateriauxFixtures extends Fixture
{
    public function load(ObjectManager $manager): void
    {
        $materiaux = [
            [1, 'Bois massif'],
            [2, 'Métal'],
            [3, 'Verre'],
            [4, 'Cuir'],
            [5, 'Tissu'],
            [6, 'Rotin'],
            [7, 'Marbre'],
            [8, 'Plastique'],
            [9, 'Osier'],
            [10, 'Laiton'],
            [11, 'Contreplaqué'],
        ];

        foreach ($materiaux as [$id, $nom]) {
            $materiau = new Materiaux();
            $materiau->setNom($nom);
            $manager->persist($materiau);
        }

        $manager->flush();
    }
}
