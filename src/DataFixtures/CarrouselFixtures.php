<?php

namespace App\DataFixtures;

use App\Entity\Carrousel;
use App\Entity\Image;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Persistence\ObjectManager;
use Doctrine\Common\DataFixtures\DependentFixtureInterface;

class CarrouselFixtures extends Fixture implements DependentFixtureInterface
{
    public function load(ObjectManager $manager): void
    {
        // Création des carrousels avec données fournies
        $carrouselsData = [
            [1, 1, 'Table'],
            [2, 1, 'Canapé'],
            [3, 1, 'Chaise'],
            [4, 1, 'Lit'],
            [5, 1, 'Armoire'],
            [6, 1, 'Bibliothèque'],
            [7, 1, 'Commode'],
            [8, 1, 'Table basse'],
            [9, 1, 'Buffet'],
            [10, 1, 'Fauteuil'],
            [11, 1, 'Table à manger en bois massif'],
            [12, 1, 'Table basse rectangulaire'],
            [13, 1, 'Table de cuisine ronde'],
            [14, 1, "Table d\'appoint en marbre"],
            [15, 1, 'Table console extensible'],
            [16, 1, 'Table à manger en bois'],
            [17, 1, 'Canapé en cuir noir'],
            [18, 1, "Canapé d\'angle gris"],
            [19, 1, 'Canapé convertible en tissu'],
            [20, 1, 'Canapé en cuir marron'],
            [21, 1, 'Canapé modulaire en tissu'],
            [22, 1, 'Chaise de salle à manger en bois'],
            [23, 1, 'Chaise de bureau ergonomique'],
            [24, 1, 'Chaise pliante en métal'],
            [25, 1, 'Chaise longue moderne'],
            [26, 1, 'Chaise de bar en cuir'],
            [27, 1, 'Lit double avec tête de lit rembourrée'],
            [28, 1, 'Lit simple en métal'],
            [29, 1, 'Lit gigogne en bois'],
            [30, 1, 'Lit superposé en métal'],
            [31, 1, 'Lit king-size avec matelas orthopédique'],
            [32, 1, 'Armoire de rangement en bois'],
            [33, 1, 'Armoire-penderie avec miroir'],
            [34, 1, 'Armoire à bijoux sur pied'],
            [35, 1, 'Armoire à chaussures en bois'],
            [36, 1, 'Armoire de bureau en métal'],
            [37, 1, 'Bibliothèque moderne à étagères'],
            [38, 1, 'Bibliothèque murale en bois'],
            [39, 1, "Bibliothèque d\'angle en métal"],
            [40, 1, 'Bibliothèque encastrée'],
            [41, 1, 'Bibliothèque industrielle à roulettes'],
            [42, 1, 'Commode vintage en bois'],
            [43, 1, 'Commode vintage en bois'],
            [44, 1, 'Commode à tiroirs en métal'],
            [45, 1, 'Commode avec paniers en osier'],
            [46, 1, 'Commode à langer pour bébé'],
            [47, 1, 'Commode moderne à six tiroirs'],
            [48, 1, 'Table basse en bois et métal'],
            [49, 1, 'Table basse avec plateau relevable'],
            [50, 1, 'Table basse en marbre et laiton'],
            [51, 1, 'Table basse ovale en verre'],
            [52, 1, 'Table basse carrée avec tiroirs'],
            [53, 1, 'Buffet en bois massif'],
            [54, 1, 'Buffet haut moderne'],
            [55, 1, 'Buffet industriel en métal'],
            [56, 1, 'Buffet contemporain à quatre portes'],
            [57, 1, 'Fauteuil club en cuir vieilli'],
            [58, 1, 'Fauteuil bergère rembourré'],
            [59, 1, 'Fauteuil en rotin avec coussin'],
            [60, 1, 'Fauteuil pivotant en tissu'],
            [61, 1, 'Fauteuil à bascule scandinave'],
            [62, 1, 'Slide 1'],
            [63, 2, 'Slide 2'],
            [64, 3, 'Slide 3']
        ];

        // Récupération des images depuis la base de données
        $images = $manager->getRepository(Image::class)->findAll();
        $imageCount = count($images);

        foreach ($carrouselsData as [$id,$rang, $nom]) {
            $carrousel = new Carrousel();
            $carrousel->setNom($nom);
            $carrousel->setRang($rang);

            // // Associe aléatoirement des images au carrousel
            // for ($i = 0; $i < rand(1, 5); $i++) {
            //     if ($imageCount > 0) {
            //         $image = $images[array_rand($images)];
            //         $carrousel->addImage($image);
            //     }
            // }

            $manager->persist($carrousel);
        }

        $manager->flush();
    }

    public function getDependencies(): array
    {
        return [
            ImageFixtures::class, // Assure-toi que les fixtures des images sont chargées avant
        ];
    }
}
