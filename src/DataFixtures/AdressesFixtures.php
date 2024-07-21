<?php

namespace App\DataFixtures;

use App\Entity\Adresses;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Persistence\ObjectManager;

class AdressesFixtures extends Fixture
{
    public function load(ObjectManager $manager): void
    {
        $adresses = [
            ['France', 'Bondaroy', '45300', '1 impasse des coquelicots'],
            ['France', 'Paris', '75000', '12 rue de Rivoli'],
            ['France', 'Lyon', '69000', '23 boulevard de la République'],
            // Ajoutez d'autres adresses si nécessaire
        ];

        foreach ($adresses as [$pays, $ville, $code_postal, $rue]) {
            $adresse = new Adresses();
            $adresse->setPays($pays)
                    ->setVille($ville)
                    ->setCodePostal($code_postal)
                    ->setRue($rue);

            $manager->persist($adresse);
        }

        $manager->flush();
    }
}
