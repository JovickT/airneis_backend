<?php

namespace App\DataFixtures;

use App\Entity\Carrousel;
use App\Entity\Image;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Persistence\ObjectManager;
use Doctrine\Common\DataFixtures\DependentFixtureInterface;

class CarrouselImageFixtures extends Fixture implements DependentFixtureInterface
{
    public function load(ObjectManager $manager): void
    {
        // Données d'association entre Carrousel et Image
        $associations = [
            [1, 57],
            [2, 15],
            [3, 88],
            [4, 92],
            [5, 29],
            [6, 116],
            [7, 38],
            [8, 46],
            [9, 145],
            [10, 52],
            [11, 4],
            [12, 6],
            [13, 8],
            [14, 9],
            [15, 7],
            [16, 5],
            [17, 59],
            [18, 61],
            [19, 63],
            [20, 15],
            [21, 64],
            [22, 19],
            [23, 18],
            [24, 21],
            [25, 20],
            [26, 17],
            [27, 22],
            [28, 25],
            [29, 23],
            [30, 26],
            [31, 24],
            [32, 30],
            [33, 29],
            [34, 31],
            [35, 28],
            [36, 27],
            [37, 35],
            [38, 36],
            [39, 32],
            [40, 33],
            [41, 34],
            [42, 41],
            [43, 41],
            [44, 40],
            [45, 39],
            [46, 37],
            [47, 38],
            [48, 42],
            [49, 46],
            [50, 44],
            [51, 139],
            [52, 43],
            [53, 47],
            [54, 49],
            [55, 50],
            [56, 48],
            [57, 54],
            [58, 53],
            [59, 56],
            [60, 55],
            [61, 52],
            [62, 161],
            [63, 162],
            [64, 163],
        ];

        // Récupération des carrousels et images depuis la base de données
        $carrousels = $manager->getRepository(Carrousel::class)->findAll();
        $images = $manager->getRepository(Image::class)->findAll();

        $carrouselMap = [];
        $imageMap = [];

        foreach ($carrousels as $carrousel) {
            $carrouselMap[$carrousel->getId()] = $carrousel;
        }

        foreach ($images as $image) {
            $imageMap[$image->getIdImage()] = $image;
        }

        foreach ($associations as [$carrouselId, $imageId]) {
            if (isset($carrouselMap[$carrouselId]) && isset($imageMap[$imageId])) {
                $carrousel = $carrouselMap[$carrouselId];
                $image = $imageMap[$imageId];

                $carrousel->addImage($image);
                $manager->persist($carrousel);
            }
        }

        $manager->flush();
    }

    public function getDependencies(): array
    {
        return [
            CarrouselFixtures::class, // Assure-toi que les fixtures des carrousels sont chargées avant
            ImageFixtures::class,     // Assure-toi que les fixtures des images sont chargées avant
        ];
    }
}
