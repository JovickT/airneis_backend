
-- Insertion des catégories dans la table "categorie"
INSERT INTO categories (nom) VALUES ('Canapé');
INSERT INTO categories (nom) VALUES ('Table');
INSERT INTO categories (nom) VALUES ('Chaise');
INSERT INTO categories (nom) VALUES ('Lit');
INSERT INTO categories (nom) VALUES ('Armoire');
INSERT INTO categories (nom) VALUES ('Bibliothèque');
INSERT INTO categories (nom) VALUES ('Commode');
INSERT INTO categories (nom) VALUES ('Table basse');
INSERT INTO categories (nom) VALUES ('Buffet');
INSERT INTO categories (nom) VALUES ('Fauteuil');

-- Insertion des marques dans la table "marques"
-- Insertion des marques dans la table "marques"

INSERT INTO marques (nom) VALUES ('LuxeDesign');
INSERT INTO marques (nom) VALUES ('ModernComfort');
INSERT INTO marques (nom) VALUES ('HomeStyle');
INSERT INTO marques (nom) VALUES ('ClassicFurniture');
INSERT INTO marques (nom) VALUES ('TrendyLiving');
INSERT INTO marques (nom) VALUES ('ArtisanHome');
INSERT INTO marques (nom) VALUES ('ContemporaryDesign');
INSERT INTO marques (nom) VALUES ('UrbanStyle');
INSERT INTO marques (nom) VALUES ('LuxuryLiving');
INSERT INTO marques (nom) VALUES ('SmartFurniture');
INSERT INTO marques (nom) VALUES ('ModernLiving');
INSERT INTO marques (nom) VALUES ('RusticHome');
INSERT INTO marques (nom) VALUES ('OfficeComfort');
INSERT INTO marques (nom) VALUES ('OutdoorEssentials');
INSERT INTO marques (nom) VALUES ('DesignerChoice');
INSERT INTO marques (nom) VALUES ('BarTrends');
INSERT INTO marques (nom) VALUES ('SleepWell');
INSERT INTO marques (nom) VALUES ('BasicLiving');
INSERT INTO marques (nom) VALUES ('StorageSolutions');
INSERT INTO marques (nom) VALUES ('KidsZone');
INSERT INTO marques (nom) VALUES ('RetroStyle');
INSERT INTO marques (nom) VALUES ('UrbanLiving');
INSERT INTO marques (nom) VALUES ('CottageCharm');
INSERT INTO marques (nom) VALUES ('BabyEssentials');
INSERT INTO marques (nom) VALUES ('ModernHome');
INSERT INTO marques (nom) VALUES ('IndustrialDesign');
INSERT INTO marques (nom) VALUES ('MultifunctionalFurniture');
INSERT INTO marques (nom) VALUES ('ScandinavianDesign');
INSERT INTO marques (nom) VALUES ('NaturalHome');
INSERT INTO marques (nom) VALUES ('RusticLiving');
INSERT INTO marques (nom) VALUES ('MinimalistStyle');
INSERT INTO marques (nom) VALUES ('VintageVibes');
INSERT INTO marques (nom) VALUES ('ScandinavianDesign');
INSERT INTO marques (nom) VALUES ('BohemianLiving');
INSERT INTO marques (nom) VALUES ('NordicComfort');


-- Insertion des produits dans la table "produits" avec les clés étrangères marque et categorie

-- Canapé
INSERT INTO produits (reference, nom, prix, description, quantite, date_creation, marque, categorie) 
VALUES 
    ('CAN1234', 'Canapé en cuir noir', 799.99, 'Canapé spacieux en cuir noir de haute qualité.', 20, CURDATE(), 1, 1),
    ('CAN2345', 'Canapé d''angle gris', 899.99, 'Canapé d''angle moderne en tissu gris avec accoudoirs ajustables.', 15, CURDATE(), 2, 1),
    ('CAN3456', 'Canapé convertible en tissu', 649.99, 'Canapé convertible pratique en tissu avec un mécanisme facile à utiliser.', 25, CURDATE(), 3, 1),
    ('CAN4567', 'Canapé en cuir marron', 899.99, 'Canapé en cuir véritable de couleur marron avec des coutures décoratives.', 18, CURDATE(), 4, 1),
    ('CAN5678', 'Canapé modulaire en tissu', 999.99, 'Canapé modulaire en tissu avec des modules interchangeables pour une configuration personnalisée.', 12, CURDATE(), 5, 1);

-- Table
INSERT INTO produits (reference, nom, prix, description, quantite, date_creation, marque, categorie) 
VALUES 
    ('TAB1234', 'Table à manger en bois massif', 349.99, 'Table à manger robuste en bois massif avec une finition naturelle.', 15, CURDATE(), 6, 2),
    ('TAB2345', 'Table basse rectangulaire', 199.99, 'Table basse rectangulaire avec un plateau en verre trempé et des pieds en métal.', 20, CURDATE(), 7, 2),
    ('TAB3456', 'Table de cuisine ronde', 249.99, 'Table de cuisine ronde en bois avec un design moderne et des pieds en métal.', 18, CURDATE(), 8, 2),
    ('TAB4567', 'Table d''appoint en marbre', 159.99, 'Table d''appoint élégante avec un plateau en marbre blanc et une base en métal doré.', 22, CURDATE(), 9, 2),
    ('TAB5678', 'Table console extensible', 499.99, 'Table console extensible en bois avec une conception intelligente pour économiser de l''espace.', 10, CURDATE(), 10, 2);

-- Chaise
INSERT INTO produits (reference, nom, prix, description, quantite, date_creation, marque, categorie) 
VALUES 
    ('CHA1234', 'Chaise de salle à manger en bois', 79.99, 'Chaise de salle à manger en bois avec un design simple et une assise confortable.', 30, CURDATE(), 11, 3),
    ('CHA2345', 'Chaise de bureau ergonomique', 129.99, 'Chaise de bureau ergonomique avec un support lombaire réglable et des accoudoirs rembourrés.', 25, CURDATE(), 12, 3),
    ('CHA3456', 'Chaise pliante en métal', 49.99, 'Chaise pliante pratique en métal avec une assise en plastique résistant.', 40, CURDATE(), 13, 3),
    ('CHA4567', 'Chaise longue moderne', 299.99, 'Chaise longue moderne en tissu avec un design élégant et un dossier réglable.', 15, CURDATE(), 14, 3),
    ('CHA5678', 'Chaise de bar en cuir', 149.99, 'Chaise de bar confortable avec un siège rembourré en cuir et une base pivotante.', 20, CURDATE(), 15, 3);

-- Lit
INSERT INTO produits (reference, nom, prix, description, quantite, date_creation, marque, categorie) 
VALUES 
    ('LIT1234', 'Lit double avec tête de lit rembourrée', 899.99, 'Lit double confortable avec une tête de lit rembourrée pour un soutien supplémentaire.', 10, CURDATE(), 16, 4),
    ('LIT2345', 'Lit simple en métal', 199.99, 'Lit simple robuste en métal avec une finition noire classique.', 20, CURDATE(), 17, 4),
    ('LIT3456', 'Lit gigogne en bois', 499.99, 'Lit gigogne en bois avec un tiroir supplémentaire pour un espace de rangement pratique.', 15, CURDATE(), 18, 4),
    ('LIT4567', 'Lit superposé en métal', 399.99, 'Lit superposé en métal avec des barrières de sécurité et des échelles intégrées.', 8, CURDATE(), 19, 4),
    ('LIT5678', 'Lit king-size avec matelas orthopédique', 1499.99, 'Lit king-size avec un matelas orthopédique de luxe pour un confort optimal.', 12, CURDATE(), 20, 4);

-- Armoire
INSERT INTO produits (reference, nom, prix, description, quantite, date_creation, marque, categorie) 
VALUES 
    ('ARM1234', 'Armoire de rangement en bois', 549.99, 'Grande armoire de rangement en bois avec plusieurs étagères et tiroirs.', 8, CURDATE(), 21, 5),
    ('ARM2345', 'Armoire-penderie avec miroir', 699.99, 'Armoire-penderie spacieuse avec un miroir pleine longueur et des portes coulissantes.', 12, CURDATE(), 22, 5),
    ('ARM3456', 'Armoire à bijoux sur pied', 179.99, 'Armoire à bijoux sur pied avec un miroir intégré et des compartiments pour ranger vos accessoires.', 15, CURDATE(), 23, 5),
    ('ARM4567', 'Armoire à chaussures en bois', 129.99, 'Armoire à chaussures en bois avec des étagères réglables pour organiser vos chaussures.', 20, CURDATE(), 24, 5),
    ('ARM5678', 'Armoire de bureau en métal', 299.99, 'Armoire de bureau en métal avec des portes verrouillables pour sécuriser vos documents.', 10, CURDATE(), 25, 5);

-- Bibliothèque
INSERT INTO produits (reference, nom, prix, description, quantite, date_creation, marque, categorie) 
VALUES 
    ('BIB1234', 'Bibliothèque moderne à étagères', 299.99, 'Bibliothèque élégante avec des étagères réglables pour organiser vos livres et décorations.', 12, CURDATE(), 26, 6),
    ('BIB2345', 'Bibliothèque murale en bois', 399.99, 'Bibliothèque murale en bois avec des étagères flottantes pour un look moderne.', 8, CURDATE(), 27, 6),
    ('BIB3456', 'Bibliothèque d''angle en métal', 249.99, 'Bibliothèque d''angle en métal avec des étagères en verre pour un design contemporain.', 10, CURDATE(), 28, 6),
    ('BIB4567', 'Bibliothèque encastrée', 599.99, 'Bibliothèque encastrée sur mesure avec des étagères intégrées pour un rangement élégant.', 6, CURDATE(), 29, 6),
    ('BIB5678', 'Bibliothèque industrielle à roulettes', 349.99, 'Bibliothèque industrielle avec des étagères en bois et une structure en métal robuste.', 15, CURDATE(), 30, 6);

-- Commode
INSERT INTO produits (reference, nom, prix, description, quantite, date_creation, marque, categorie) 
VALUES 
    ('COM1234', 'Commode vintage en bois', 199.99, 'Commode vintage en bois avec des tiroirs spacieux pour le rangement.', 18, CURDATE(), 31, 7),
    ('COM2345', 'Commode à tiroirs en métal', 149.99, 'Commode à tiroirs en métal avec des poignées en cuir pour un look industriel.', 15, CURDATE(), 32, 7),
    ('COM3456', 'Commode avec paniers en osier', 129.99, 'Commode pratique avec des paniers en osier tressé pour un rangement naturel.', 20, CURDATE(), 33, 7),
    ('COM4567', 'Commode à langer pour bébé', 299.99, 'Commode à langer pour bébé avec des tiroirs de rangement et un espace pour changer bébé.', 10, CURDATE(), 34, 7),
    ('COM5678', 'Commode moderne à six tiroirs', 249.99, 'Commode moderne à six tiroirs avec des poignées encastrées pour un look épuré.', 12, CURDATE(), 35, 7);

-- Table basse
INSERT INTO produits (reference, nom, prix, description, quantite, date_creation, marque, categorie) 
VALUES 
    ('TAB1234', 'Table basse en bois et métal', 129.99, 'Table basse en bois et métal avec une étagère inférieure pour le rangement.', 25, CURDATE(), 1, 8),
    ('TAB2345', 'Table basse avec plateau relevable', 179.99, 'Table basse avec un plateau relevable pour transformer en table à manger occasionnelle.', 18, CURDATE(), 2, 8),
    ('TAB3456', 'Table basse en marbre et laiton', 349.99, 'Table basse en marbre blanc et laiton doré avec un design luxueux.', 8, CURDATE(), 3, 8),
    ('TAB4567', 'Table basse ovale en verre', 299.99, 'Table basse ovale en verre trempé avec une base en acier inoxydable pour une touche moderne.', 12, CURDATE(), 4, 8),
    ('TAB5678', 'Table basse carrée avec tiroirs', 249.99, 'Table basse carrée avec des tiroirs de rangement et une finition en bois naturel.', 15, CURDATE(), 5, 8);

-- Buffet
INSERT INTO produits (reference, nom, prix, description, quantite, date_creation, marque, categorie) 
VALUES 
    ('BUF1234', 'Buffet en bois massif', 499.99, 'Buffet en bois massif avec des portes coulissantes et des étagères réglables.', 14, CURDATE(), 6, 9),
    ('BUF2345', 'Buffet haut moderne', 399.99, 'Buffet haut moderne avec des façades laquées et des poignées encastrées pour un look épuré.', 10, CURDATE(), 7, 9),
    ('BUF3456', 'Buffet industriel en métal', 349.99, 'Buffet industriel en métal avec des portes grillagées et une finition vieillie pour un look vintage.', 12, CURDATE(), 8, 9),
    ('BUF4567', 'Buffet scandinave avec pieds compas', 449.99, 'Buffet scandinave avec des pieds compas et des poignées en laiton pour une ambiance rétro.', 8, CURDATE(), 9, 9),
    ('BUF5678', 'Buffet contemporain à quatre portes', 599.99, 'Buffet contemporain avec quatre portes et des étagères intérieures pour un rangement organisé.', 6, CURDATE(), 10, 9);

-- Fauteuil
INSERT INTO produits (reference, nom, prix, description, quantite, date_creation, marque, categorie) 
VALUES 
    ('FAU1234', 'Fauteuil club en cuir vieilli', 599.99, 'Fauteuil club en cuir vieilli avec un dossier incliné pour un confort optimal.', 22, CURDATE(), 11, 10),
    ('FAU2345', 'Fauteuil bergère rembourré', 399.99, 'Fauteuil bergère rembourré avec des accoudoirs sculptés et un coussin d''assise moelleux.', 18, CURDATE(), 12, 10),
    ('FAU3456', 'Fauteuil en rotin avec coussin', 249.99, 'Fauteuil en rotin avec un coussin d''assise rembourré pour un confort décontracté.', 25, CURDATE(), 13, 10),
    ('FAU4567', 'Fauteuil pivotant en tissu', 299.99, 'Fauteuil pivotant en tissu avec une base en métal chromé pour une rotation à 360 degrés.', 20, CURDATE(), 14, 10),
    ('FAU5678', 'Fauteuil à bascule scandinave', 349.99, 'Fauteuil à bascule scandinave avec une assise rembourrée et des pieds en bois massif.', 15, CURDATE(), 15, 10);


-- Inserts dans la table "materiaux"
INSERT INTO materiaux (nom) VALUES ('Bois massif');
INSERT INTO materiaux (nom) VALUES ('Métal');
INSERT INTO materiaux (nom) VALUES ('Verre');
INSERT INTO materiaux (nom) VALUES ('Cuir');
INSERT INTO materiaux (nom) VALUES ('Tissu');
INSERT INTO materiaux (nom) VALUES ('Rotin');
INSERT INTO materiaux (nom) VALUES ('Marbre');
INSERT INTO materiaux (nom) VALUES ('Plastique');
INSERT INTO materiaux (nom) VALUES ('Osier');
INSERT INTO materiaux (nom) VALUES ('Laiton');