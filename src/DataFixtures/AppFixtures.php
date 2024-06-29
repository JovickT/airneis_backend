<?php

namespace App\DataFixtures;

use App\Entity\Adresses;
use App\Entity\Carrousel;
use App\Entity\Categories;
use App\Entity\Client;
use App\Entity\Image;
use App\Entity\ImageProduit;
use App\Entity\Marques;
use App\Entity\Materiaux;
use App\Entity\Produits;
use DateTime;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Persistence\ObjectManager;


class AppFixtures extends Fixture
{

    public function load(ObjectManager $manager): void
    {

        $adressesData = [
            ['France', 'Bondaroy', '45300', '1 impasse des coquelicots'],
            ['France', 'Evry', '91280', '2 rue de l\'exemple'],
            ['France', 'Mantes-la-jolie', '78256', '128 avenue du test'],
            ['France', 'Paris', '75015', '45 boulevard de la paix'],
            ['France', 'Palaiseau', '91120', '9 allée de louise bruneau'],
            ['France', 'L\'Hay-les-roses', '94320', '132 rue de Bicêtre'],
            ['France', 'L\'Hay-les-roses', '94320', '132 rue de Bicêtre'],
            ['France', 'Palaiseau', '91120', '9 allée louise bruneau'],
        ];

        foreach ($adressesData as [$pays, $ville, $codePostal, $rue]) {
            $adresse = new Adresses();
            $adresse->setPays($pays)
                    ->setVille($ville)
                    ->setCodePostal($codePostal)
                    ->setRue($rue);

            $manager->persist($adresse);
        }

        $carrouselData = [
            [1, 'home', 3],
            [2, 'categories', 1],
        ];

        foreach ($carrouselData as [$id, $page, $quantite]) {
            $carrousel = new Carrousel();
            $carrousel->setPage($page)
                      ->setQuantite($quantite);

            $manager->persist($carrousel);
        }


        $categoriesData = [
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

        foreach ($categoriesData as [$id, $nom]) {
            $categorie = new Categories();
            $categorie->setNom($nom);

            $manager->persist($categorie);
        }

        $images = [
            'images/300x300-9555e51fdd6fb66ddb069acfd8dda99c.png',
            'images/300x300-8c52b68089e3ff546cb5a1da812fbc25.png',
            'images/300x300-52d6df8b5af8ae2a906b3d19b31e69b7.png',
            'images/300x300-60081e8ba86b535b5b4aac07fb838fce.png',
            'images/300x300-c061143dce5c75104eadd6daee18da91.png',
            'images/300x300-2b8fe00ba5cc327924e3ab49807f9951.png',
            'images/300x300-c684542cc0bfea4a5a78c415edf6e51b.png',
            'images/300x300-24a76b7b2bff9b6a14d6b81c26420086.png',
            'images/300x300-4efb7788222b6fa71da788e8263da13d.png',
            'images/300x300-cb4c1b5ae91d0db753475b836f641940.png',
            'images/300x300-a95062ba546c2bfd28c067273bf59678.png',
            'images/300x300-c3ceee366de254dd8f95169a0926bce4.png',
            'images/300x300-7e694e27c145f3536a7e15c9acb1ff13.png',
            'images/300x300-0fef85d749fdb11a5f81b88df14bb5de.png',
            'images/300x300-eb6025d927bb79672383d18e211a3e3c.png',
            'images/300x300-684fecb043acd036bfb644c73858473a.png',
            'images/300x300-29b2ac18f17d95e95bbfe817710043de.png',
            'images/300x300-66d98a9a71235020d90722bb7e994d4b.png',
            'images/300x300-734c551fdff3e27b74ee24c49e1861e1.png',
            'images/300x300-e59cc7644c2ac0852f00c4eba4f026c5.png',
            'images/300x300-4c5f2b7e5fd31c72b79f1578c93223c2.png',
            'images/300x300-baaa043dcee8c38f6caaae663b26c70f.png',
            'images/300x300-fae72cb7ceae7c7a56309e46cd7f6c68.png',
            'images/300x300-ff2da7102986b3c97c503ef7b2f661c7.png',
            'images/300x300-8cbe24c44326b4f544f6d234e652b639.png',
            'images/300x300-0256e2694ad913cfd0d238e9bc0f2979.png',
            'images/300x300-3980bb35dcffce2040197d5642bc123e.png',
            'images/300x300-cca111934d07a3c35d97ac8fa19f487c.png',
            'images/300x300-7a1dba51f8ca520df203b1d91f0d04f4.png',
            'images/300x300-d4d80c72553ade1da833de43ec037833.png',
            'images/300x300-850ebc006e613d62c2f101a344676e77.png',
            'images/300x300-7fb1df18506718a1f8cace82e9de8256.png',
            'images/300x300-22da996c4b39d509fd116383ca0c44ea.png',
            'images/300x300-d065851cd659121eb638e5868cf35b89.png',
            'images/300x300-fc60cd8c93b46736c93c782c2011a774.png',
            'images/300x300-3b67fb849bac864b57b2f75da71ea718.png',
            'images/300x300-674ec014ea489ac8ec5842e65baf2a17.png',
            'images/300x300-b2d5617fba61151ae12e0358d6cbe993.png',
            'images/300x300-5f416d6c06264e24d9ee379623aca66b.png',
            'images/300x300-fbc3705b5e6b3106549e0e24efe9aefe.png',
            'images/300x300-2eaca555a12f7a38709df9f6f77ba736.png',
            'images/300x300-461bb1226aae10c0850f1dc177db884c.png',
            'images/300x300-f6ab1cc5a3ca1ba614eecf2d1dbcee47.png',
            'images/300x300-effaae8f7fc3b1f43eaba43532f6b557.png',
            'images/300x300-4a0012202caee1ac00f533074076e118.png',
            'images/300x300-8ba0a7469225bdcf4b2b79fe623d30de.png',
            'images/300x300-c6585e995384080ca09cffb3061bb20e.png',
            'images/300x300-2756d58115970b08730d9cb13e5f4d76.png',
            'images/300x300-6df6486612d97e1ca2b2ce2d29d8d707.png',
            'images/300x300-c6535115f9551797e0316e8c6755d7e8.png',
            'images/300x300-666992c77ba5c3391c7d10277e7cb6cc.png',
            'images/300x300-c22b2d53677b1d93df67ebcf595bc070.png',
            'images/300x300-e73426f5b3d6b1bc92ee04c11e4b6b5d.png',
            'images/300x300-a54ff7fb463715d71b07d921ed58b788.png',
            'images/300x300-768ad4dc60a7ef859f62e39a0ad3226a.png',
            'images/300x300-15586bbe65d37697019e832393a53593.png',
            'images/300x300-99cd5b3bd6b44a9cc41c07b3ab73fa65.png'
        ];

        foreach ($images as $key => $lien) {
            $image = new Image();
            $image->setLien($lien);
            $manager->persist($image);

            // Store reference for later use
            $this->addReference('image_' . ($key + 1), $image);
        }

        $marques = [
            'LuxeDesign',
            'ModernComfort',
            'HomeStyle',
            'ClassicFurniture',
            'TrendyLiving',
            'ArtisanHome',
            'ContemporaryDesign',
            'UrbanStyle',
            'LuxuryLiving',
            'SmartFurniture',
            'ModernLiving',
            'RusticHome',
            'OfficeComfort',
            'OutdoorEssentials',
            'DesignerChoice',
            'BarTrends',
            'SleepWell',
            'BasicLiving',
            'StorageSolutions',
            'KidsZone',
            'RetroStyle',
            'UrbanLiving',
            'CottageCharm',
            'BabyEssentials',
            'ModernHome',
            'IndustrialDesign',
            'MultifunctionalFurniture',
            'ScandinavianDesign',
            'NaturalHome',
            'RusticLiving',
            'MinimalistStyle',
            'VintageVibes',
            'ScandinavianDesign',
            'BohemianLiving',
            'NordicComfort',
            'Ikea',
        ];

        foreach ($marques as $key => $nomMarque) {
            $marque = new Marques();
            $marque->setNom($nomMarque);
            $manager->persist($marque);

            // Store reference for later use
            $this->addReference('marque_' . ($key + 1), $marque);
        }

       
        $produitsData = [
            [1, 'CAN1234', 'Canapé en cuir noir', 799.99, 'Canapé spacieux en cuir noir de haute qualité.', 20, '2024-04-13', 'marque_1', 'categorie_1', 'materiaux_4'],
            [2, 'CAN2345', 'Canapé d\'angle gris', 899.99, 'Canapé d\'angle moderne en tissu gris avec accoudoirs ajustables.', 15, '2024-04-13', 'marque_2', 'categorie_1', 'materiaux_11'],
            [3, 'CAN3456', 'Canapé convertible en tissu', 649.99, 'Canapé convertible pratique en tissu avec un mécanisme facile à utiliser.', 25, '2024-04-13', 3, 1, 5],
            [4, 'CAN4567', 'Canapé en cuir marron', 899.99, 'Canapé en cuir véritable de couleur marron avec des coutures décoratives.', 18, '2024-04-13', 4, 1, 4],
            [5, 'CAN5678', 'Canapé modulaire en tissu', 999.99, 'Canapé modulaire en tissu avec des modules interchangeables pour une configuration personnalisée.', 12, '2024-04-13', 5, 1, 5],
            [6, 'TAB1234', 'Table à manger en bois massif', 349.99, 'Table à manger robuste en bois massif avec une finition naturelle.', 15, '2024-04-13', 6, 2, 1],
            [7, 'TAB2345', 'Table basse rectangulaire', 199.99, 'Table basse rectangulaire avec un plateau en verre trempé et des pieds en métal.', 20, '2024-04-13', 7, 2, 8],
            [8, 'TAB3456', 'Table de cuisine ronde', 249.99, 'Table de cuisine ronde en bois avec un design moderne et des pieds en métal.', 18, '2024-04-13', 8, 2, 8],
            [9, 'TAB4567', 'Table d\'appoint en marbre', 159.99, 'Table d\'appoint élégante avec un plateau en marbre blanc et une base en métal doré.', 22, '2024-04-13', 9, 2, 7],
            [10, 'TAB5678', 'Table console extensible', 499.99, "Table console extensible en bois avec une conception intelligente pour économiser de l'espace.", 10, '2024-04-13', 10, 2, 8],
            [11, 'CHA1234', 'Chaise de salle à manger en bois', 79.99, 'Chaise de salle à manger en bois avec un design simple et une assise confortable.', 30, '2024-04-13', 11, 3, 1],
            [12, 'CHA2345', 'Chaise de bureau ergonomique', 129.99, 'Chaise de bureau ergonomique avec un support lombaire réglable et des accoudoirs rembourrés.', 25, '2024-04-13', 12, 3, 2],
            [13, 'CHA3456', 'Chaise pliante en métal', 49.99, 'Chaise pliante pratique en métal avec une assise en plastique résistant.', 40, '2024-04-13', 13, 3, 2],
            [14, 'CHA4567', 'Chaise longue moderne', 299.99, 'Chaise longue moderne en tissu avec un design élégant et un dossier réglable.', 15, '2024-04-13', 14, 3, 8],
            [15, 'CHA5678', 'Chaise de bar en cuir', 149.99, 'Chaise de bar confortable avec un siège rembourré en cuir et une base pivotante.', 20, '2024-04-13', 15, 3, 4],
            [16, 'LIT1234', 'Lit double avec tête de lit rembourrée', 899.99, 'Lit double confortable avec une tête de lit rembourrée pour un soutien supplémentaire.', 10, '2024-04-13', 16, 4, 5],
            [17, 'LIT2345', 'Lit simple en métal', 199.99, 'Lit simple robuste en métal avec une finition noire classique.', 20, '2024-04-13', 17, 4, 2],
            [18, 'LIT3456', 'Lit gigogne en bois', 499.99, 'Lit gigogne en bois avec un tiroir supplémentaire pour un espace de rangement pratique.', 15, '2024-04-13', 18, 4, 1],
            [19, 'LIT4567', 'Lit superposé en métal', 399.99, 'Lit superposé en métal avec des barrières de sécurité et des échelles intégrées.', 8, '2024-04-13', 19, 4, 2],
            [20, 'LIT5678', 'Lit king-size avec matelas orthopédique', 1499.99, 'Lit king-size avec un matelas orthopédique de luxe pour un confort optimal.', 12, '2024-04-13', 20, 4, 6],
            [21, 'ARM1234', 'Armoire de rangement en bois', 549.99, 'Grande armoire de rangement en bois avec plusieurs étagères et tiroirs.', 8, '2024-04-13', 21, 5, 1],
            [22, 'ARM2345', 'Armoire-penderie avec miroir', 699.99, 'Armoire-penderie spacieuse avec un miroir pleine longueur et des portes coulissantes.', 12, '2024-04-13', 22, 5, 1],
            [23, 'ARM3456', 'Armoire à bijoux sur pied', 179.99, 'Armoire à bijoux sur pied avec un miroir intégré et des compartiments pour ranger vos accessoires.', 15, '2024-04-13', 23, 5, 1],
            [24, 'ARM4567', 'Armoire à chaussures en bois', 129.99, 'Armoire à chaussures en bois avec des étagères réglables pour organiser vos chaussures.', 20, '2024-04-13', 24, 5, 1],
            [25, 'ARM5678', 'Armoire de bureau en métal', 299.99, 'Armoire de bureau en métal avec des portes verrouillables pour sécuriser vos documents.', 10, '2024-04-13', 25, 5, 2],
            [26, 'BIB1234', 'Bibliothèque moderne à étagères', 299.99, 'Bibliothèque élégante avec des étagères réglables pour organiser vos livres et décorations.', 12, '2024-04-13', 26, 6, 8],
            [27, 'BIB2345', 'Bibliothèque murale en bois', 399.99, 'Bibliothèque murale en bois avec des étagères flottantes pour un look moderne.', 8, '2024-04-13', 27, 6, 1],
            [28, 'BIB3456', "Bibliothèque d'angle en métal", 249.99, "Bibliothèque d'angle en métal avec des étagères en verre pour un design contemporain.', 10, '2024-04-13', 28, 6, 2],
            [29, 'BIB4567', 'Bibliothèque encastrée', 599.99, 'Bibliothèque encastrée sur mesure avec des étagères intégrées pour un rangement élégant.", 6, '2024-04-13', 29, 6, 10],
            [30, 'BIB5678', 'Bibliothèque industrielle à roulettes', 349.99, 'Bibliothèque industrielle avec des étagères en bois et une structure en métal robuste.', 15, '2024-04-13', 30, 6, 10],
            [31, 'COM1234', 'Commode vintage en bois', 199.99, 'Commode vintage en bois avec des tiroirs spacieux pour le rangement.', 18, '2024-04-13', 31, 7, 1],
            [32, 'COM2345', 'Commode à tiroirs en métal', 149.99, 'Commode à tiroirs en métal avec des poignées en cuir pour un look industriel.', 15, '2024-04-13', 32, 7, 2],
            [33, 'COM3456', 'Commode avec paniers en osier', 129.99, 'Commode pratique avec des paniers en osier tressé pour un rangement naturel.', 20, '2024-04-13', 33, 7, 9],
            [34, 'COM4567', 'Commode à langer pour bébé', 299.99, 'Commode à langer pour bébé avec des tiroirs de rangement et un espace pour changer bébé.', 10, '2024-04-13', 34, 7, 8],
            [35, 'COM5678', 'Commode moderne à six tiroirs', 249.99, 'Commode moderne à six tiroirs avec des poignées encastrées pour un look épuré.', 12, '2024-04-13', 35, 7, 1],
            [36, 'TAB1234', 'Table basse en bois et métal', 129.99, 'Table basse en bois et métal avec une étagère inférieure pour le rangement.', 25, '2024-04-13', 1, 8, 2],
            [37, 'TAB2345', 'Table basse avec plateau relevable', 179.99, 'Table basse avec un plateau relevable pour transformer en table à manger occasionnelle.', 18, '2024-04-13', 2, 8, 8],
            [38, 'TAB3456', 'Table basse en marbre et laiton', 349.99, 'Table basse en marbre blanc et laiton doré avec un design luxueux.', 8, '2024-04-13', 3, 8, 10],
            [39, 'TAB4567', 'Table basse ovale en verre', 299.99, 'Table basse ovale en verre trempé avec une base en acier inoxydable pour une touche moderne.', 12, '2024-04-13', 4, 8, 3],
            [40, 'TAB5678', 'Table basse carrée avec tiroirs', 249.99, 'Table basse carrée avec des tiroirs de rangement et une finition en bois naturel.', 15, '2024-04-13', 5, 8, 2],
            [41, 'BUF1234', 'Buffet en bois massif', 499.99, 'Buffet en bois massif avec des portes coulissantes et des étagères réglables.', 14, '2024-04-13', 6, 9, 1],
            [42, 'BUF2345', 'Buffet haut moderne', 399.99, 'Buffet haut moderne avec des façades laquées et des poignées encastrées pour un look épuré.', 10, '2024-04-13', 7, 9, 7],
            [43, 'BUF3456', 'Buffet industriel en métal', 349.99, 'Buffet industriel en métal avec des portes grillagées et une finition vieillie pour un look vintage.', 12, '2024-04-13', 8, 9, 2],
            [44, 'BUF4567', 'Buffet scandinave avec pieds compas', 449.99, 'Buffet scandinave avec des pieds compas et des poignées en laiton pour une ambiance rétro.', 8, '2024-04-13', 9, 9, NULL],
            [45, 'BUF5678', 'Buffet contemporain à quatre portes', 599.99, 'Buffet contemporain avec quatre portes et des étagères intérieures pour un rangement organisé.', 6, '2024-04-13', 10, 9, 11],
            [46, 'FAU1234', 'Fauteuil club en cuir vieilli', 599.99, 'Fauteuil club en cuir vieilli avec un dossier incliné pour un confort optimal.', 22, '2024-04-13', 11, 10, 4],
            [47, 'FAU2345', 'Fauteuil bergère rembourré', 399.99, "Fauteuil bergère rembourré avec des accoudoirs sculptés et un coussin d'assise moelleux.", 18, '2024-04-13', 12, 10, 5],
            [48, 'FAU3456', 'Fauteuil en rotin avec coussin', 249.99, "Fauteuil en rotin avec un coussin d'assise rembourré pour un confort décontracté.", 25, '2024-04-13', 13, 10, 4],
            [49, 'FAU4567', 'Fauteuil pivotant en tissu', 299.99, 'Fauteuil pivotant en tissu avec une base en métal chromé pour une rotation à 360 degrés.', 20, '2024-04-13', 14, 10, 5],
            [50, 'FAU5678', 'Fauteuil à bascule scandinave', 349.99, 'Fauteuil à bascule scandinave avec une assise rembourrée et des pieds en bois massif.', 15, '2024-04-13', 15, 10, 7],
            [51, 'TAB28173', 'Table à manger en bois', 499.99, "Table en bois massif avec d'élégante finissions.", 30, '2024-05-03', 6, 2, 1]
        ];

        foreach ($produitsData as $data) {
            $produit = new Produits();
            $produit->setReference($data[1])
                    ->setNom($data[2])
                    ->setPrix($data[3])
                    ->setDescription($data[4])
                    ->setQuantite($data[5])
                    ->setDateCreation(new DateTime($data[6]))
                    ->setMarque($this->getReference($data[7]))
                    ->setCategorie($this->getReference($data[8]))
                    ->setMateriaux($this->getReference($data[9]));

            $manager->persist($produit);
        }

        $data = [
            [1, 4, 6],
            [2, 5, 51],
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
            [51, 52, 50],
        ];

        foreach ($data as [$id, $idImage, $idProduit]) {
            $imageProduit = new ImageProduit();
            
            // You need to fetch the actual Image and Produits entities from the database
            $image = $manager->getRepository(Image::class)->find($idImage);
            $produit = $manager->getRepository(Produits::class)->find($idProduit);

            // Check if the image and produit exist
            if (!$image || !$produit) {
                throw new \Exception('Invalid Image or Produit reference');
            }

            $imageProduit->setIdImage($image);
            $imageProduit->setIdProduit($produit);

            $manager->persist($imageProduit);
        }

        $data = [
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

        foreach ($data as [$id, $nom]) {
            $materiaux = new Materiaux();
            $materiaux->setNom($nom);

            $manager->persist($materiaux);
        }

        $data = [
            [1, 'Randy', 'Sapa', 'randy.sapa@gmail.com', '$2y$13$4VflHz7YtnzYNLbKUaFV5Om02yVhc0d11', '', 1, 'ROLE_ADMIN'],
            [2, 'Jovick', 'Tchakala', 'jovick.tchakala@gmail.com', '$2y$13$mi1lblu9psMD5ttfSW18t.CaZm11ueHu9', '', 1, 'ROLE_ADMIN'],
            [3, 'Mehdi', 'Triaa', 'mehdi.triaa@gmail.com', '$2y$13$mas.t7se0W2HYlQ7BAHCVuONb3bf8F9yk', '', 1, 'ROLE_ADMIN'],
            [4, 'Emilien', 'Billaud', 'emilien.billaud@gmail.com', '$2y$13$Mee4DXlDKrxhRV4HcQZ8j.TZ4SLqRyDCn', '', 1, 'ROLE_ADMIN'],
        ];

        foreach ($data as [$id, $prenom, $nom, $email, $password, $telephone, $id_adresse, $roles]) {
            $client = new Client();
            $client->setPrenom($prenom)
                   ->setNom($nom)
                   ->setEmail($email)
                   ->setPassword($password)
                   ->setTelephone($telephone)
                   ->setRoles([$roles]);

            // You may need to set the address separately based on your application logic
            // $adresse = $manager->getRepository(Adresses::class)->find($id_adresse);
            // $client->setAdresse($adresse);

            $manager->persist($client);
        }



        $manager->flush();
    }
}
