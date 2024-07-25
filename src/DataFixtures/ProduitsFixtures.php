<?php

namespace App\DataFixtures;

use App\Entity\Categories;
use App\Entity\Marques;
use App\Entity\Materiaux;
use App\Entity\Produits;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Persistence\ObjectManager;

class ProduitsFixtures extends Fixture
{
    public function load(ObjectManager $manager): void
    {
        // Récupération des entités associées
        $categories = $manager->getRepository(Categories::class)->findAll();
        $marques = $manager->getRepository(Marques::class)->findAll();
        $materiaux = $manager->getRepository(Materiaux::class)->findAll();

        // Les données des produits
        $produitsData = [
            [1, 'CAN1234', 'Canapé en cuir noir', 799.99, 'Canapé spacieux en cuir noir de haute qualité.', 20, '2024-04-13', 1, 1, 4],
            [2, 'CAN2345', 'Canapé d\'angle gris', 899.99, 'Canapé d\'angle moderne en tissu gris avec accoudoirs ajustables.', 15, '2024-04-13', 2, 1, 11],
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
            [28, 'BIB3456', "Bibliothèque d'angle en métal", 249.99, "Bibliothèque d'angle en métal avec des étagères en verre pour un design contemporain.", 10, '2024-04-13', 28, 6, 2],
            [29, 'BIB4567', 'Bibliothèque encastrée', 599.99, 'Bibliothèque encastrée sur mesure avec des étagères intégrées pour un rangement élégant.', 6, '2024-04-13', 29, 6, 10],
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

        foreach ($produitsData as [$id, $reference, $nom, $prix, $description, $quantite, $date_creation, $marqueRef, $categorieRef, $materiauxRef]) {
            $produit = new Produits();
            $produit->setReference($reference);
            $produit->setNom($nom);
            $produit->setPrix($prix);
            $produit->setDescription($description);
            $produit->setQuantite($quantite);
            $produit->setDateCreation(new \DateTime($date_creation));

            // Associer la marque
            $marque = $marques[array_search($marqueRef, array_column($marques, 'id'))] ?? null;
            $produit->setMarque($marque);

            // Associer la catégorie
            $categorie = $categories[array_search($categorieRef, array_column($categories, 'id_categorie'))] ?? null;
            $produit->setCategorie($categorie);

            // Associer le matériau
            $materiauxEntity = $materiaux[array_search($materiauxRef, array_column($materiaux, 'id_materiel'))] ?? null;
            $produit->setMateriaux($materiauxEntity);

            $manager->persist($produit);
        }

        $manager->flush();
    }
}
