<?php

namespace App\DataFixtures;

use App\Entity\Image;
use App\Entity\Produits;
use App\Entity\ImageProduit;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Persistence\ObjectManager;

class ZImageProduitFixtures extends Fixture
{
    public function load(ObjectManager $manager): void
    {
        // Obtenez les repositories pour Image et Produits
        $imageRepo = $manager->getRepository(Image::class);
        $produitRepo = $manager->getRepository(Produits::class);

        // Assurez-vous que les IDs dans vos données existent dans la base de données
        $data = [
            [1, 4, 6],
            [3, 6, 7],
            [4, 11, 9],
            [5, 10, 10],
            [6, 8, 8],
            [7, 16, 5],
            [8, 14, 1],
            [9, 15, 4],
            [10, 13, 3],
            [11, 12, 2],
            [12, 17, 15],
            [13, 20, 14],
            [14, 21, 13],
            [15, 19, 11],
            [16, 18, 12],
            [17, 26, 19],
            [18, 25, 17],
            [19, 23, 18],
            [20, 24, 20],
            [21, 22, 16],
            [22, 31, 23],
            [23, 29, 22],
            [24, 27, 25],
            [25, 28, 24],
            [26, 30, 21],
            [27, 36, 27],
            [28, 35, 26],
            [29, 34, 30],
            [30, 33, 29],
            [31, 32, 28],
            [32, 41, 31],
            [33, 40, 32],
            [34, 39, 33],
            [35, 38, 35],
            [36, 37, 34],
            [37, 46, 37],
            [38, 45, 39],
            [39, 44, 38],
            [40, 43, 40],
            [41, 42, 36],
            [42, 51, 44],
            [43, 50, 43],
            [44, 49, 42],
            [45, 48, 45],
            [46, 47, 41],
            [47, 56, 48],
            [48, 55, 49],
            [49, 54, 46],
            [50, 53, 47],
            [51, 52, 50]
        ];

        foreach ($data as [$id, $imageId, $produitId]) {
            $image = $imageRepo->find($imageId);
            $produit = $produitRepo->find($produitId);

            if ($image && $produit) {
                $imageProduit = new ImageProduit();
                $imageProduit->setImage($image);
                $imageProduit->setProduit($produit);
                $manager->persist($imageProduit);
            }
        }

        $manager->flush();
    }
}
