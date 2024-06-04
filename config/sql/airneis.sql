-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Hôte : 127.0.0.1:3306
-- Généré le : mar. 04 juin 2024 à 07:47
-- Version du serveur : 8.2.0
-- Version de PHP : 8.2.13

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Base de données : `airneis`
--

-- --------------------------------------------------------

--
-- Structure de la table `adresses`
--

DROP TABLE IF EXISTS `adresses`;
CREATE TABLE IF NOT EXISTS `adresses` (
  `id_adresse` int NOT NULL AUTO_INCREMENT,
  `pays` varchar(50) NOT NULL,
  `ville` varchar(50) NOT NULL,
  `code_postal` varchar(8) NOT NULL,
  `rue` varchar(100) NOT NULL,
  PRIMARY KEY (`id_adresse`)
) ENGINE=InnoDB AUTO_INCREMENT=11 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Déchargement des données de la table `adresses`
--

INSERT INTO `adresses` (`id_adresse`, `pays`, `ville`, `code_postal`, `rue`) VALUES
(1, 'France', 'Bondaroy', '45300', '1 impasse des coquelicots'),
(3, 'France', 'Evry', '91280', '2 rue de l\'exemple'),
(4, 'France', 'Mantes-la-jolie', '78256', '128 avenue du test'),
(6, 'France', 'Paris', '75015', '45 boulevard de la paix'),
(7, 'France', 'Palaiseau', '91120', '9 allée de louise bruneau'),
(8, 'France', 'L\'Hay-les-roses', '94320', '132 rue de Bicêtre'),
(9, 'France', 'L\'Hay-les-roses', '94320', '132 rue de Bicêtre'),
(10, 'France', 'Palaiseau', '91120', '9 allée louise bruneau');

-- --------------------------------------------------------

--
-- Structure de la table `carrousel`
--

DROP TABLE IF EXISTS `carrousel`;
CREATE TABLE IF NOT EXISTS `carrousel` (
  `id` int NOT NULL AUTO_INCREMENT,
  `page` varchar(50) COLLATE utf8mb4_unicode_ci NOT NULL,
  `quantite` int NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Déchargement des données de la table `carrousel`
--

INSERT INTO `carrousel` (`id`, `page`, `quantite`) VALUES
(1, 'home', 3),
(2, 'categories', 1);

-- --------------------------------------------------------

--
-- Structure de la table `categories`
--

DROP TABLE IF EXISTS `categories`;
CREATE TABLE IF NOT EXISTS `categories` (
  `id_categorie` int NOT NULL AUTO_INCREMENT,
  `nom` varchar(30) NOT NULL,
  PRIMARY KEY (`id_categorie`)
) ENGINE=InnoDB AUTO_INCREMENT=13 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Déchargement des données de la table `categories`
--

INSERT INTO `categories` (`id_categorie`, `nom`) VALUES
(1, 'Canapé'),
(2, 'Table'),
(3, 'Chaise'),
(4, 'Lit'),
(5, 'Armoire'),
(6, 'Bibliothèque'),
(7, 'Commode'),
(8, 'Table basse'),
(9, 'Buffet'),
(10, 'Fauteuil');

-- --------------------------------------------------------

--
-- Structure de la table `client`
--

DROP TABLE IF EXISTS `client`;
CREATE TABLE IF NOT EXISTS `client` (
  `id_client` int NOT NULL AUTO_INCREMENT,
  `prenom` varchar(40) NOT NULL,
  `nom` varchar(40) NOT NULL,
  `email` varchar(80) NOT NULL,
  `mot_de_passe` varchar(255) NOT NULL,
  `telephone` varchar(15) NOT NULL,
  `id_adresse` int DEFAULT NULL,
  `roles` json NOT NULL,
  PRIMARY KEY (`id_client`),
  UNIQUE KEY `UNIQ_C7440455E7927C74` (`email`),
  KEY `IDX_C74404551DC2A166` (`id_adresse`)
) ENGINE=InnoDB AUTO_INCREMENT=36 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Déchargement des données de la table `client`
--

INSERT INTO `client` (`id_client`, `prenom`, `nom`, `email`, `mot_de_passe`, `telephone`, `id_adresse`, `roles`) VALUES
(31, 'Randy', 'Sapa', 'randy.sapa@gmail.com', '$2y$13$4VflHz7YtnzYNLbKUaFV5Om02yVhc0d11', '', 1, '[\"ROLE_ADMIN\"]'),
(32, 'Jovick', 'Tchakala', 'jovick.tchakala@gmail.com', '$2y$13$mi1lblu9psMD5ttfSW18t.CaZm11ueHu9', '', 1, '[\"ROLE_ADMIN\"]'),
(33, 'Mehdi', 'Triaa', 'mehdi.triaa@gmail.com', '$2y$13$mas.t7se0W2HYlQ7BAHCVuONb3bf8F9yk', '', 1, '[\"ROLE_ADMIN\"]'),
(34, 'Emilien', 'Billaud', 'emilien.billaud@gmail.com', '$2y$13$Mee4DXlDKrxhRV4HcQZ8j.TZ4SLqRyDCn', '', 1, '[\"ROLE_ADMIN\"]'),
(35, 'Chanel', 'Kulenga', 'kulenga.chanel@gmail.com', '$2y$13$nz5CJgZXzRnkz9MPZFcLxe8mH4NOkc9Os', '', 1, '[\"ROLE_USER\"]');

-- --------------------------------------------------------

--
-- Structure de la table `doctrine_migration_versions`
--

DROP TABLE IF EXISTS `doctrine_migration_versions`;
CREATE TABLE IF NOT EXISTS `doctrine_migration_versions` (
  `version` varchar(191) COLLATE utf8mb3_unicode_ci NOT NULL,
  `executed_at` datetime DEFAULT NULL,
  `execution_time` int DEFAULT NULL,
  PRIMARY KEY (`version`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb3 COLLATE=utf8mb3_unicode_ci;

--
-- Déchargement des données de la table `doctrine_migration_versions`
--

INSERT INTO `doctrine_migration_versions` (`version`, `executed_at`, `execution_time`) VALUES
('DoctrineMigrations\\Version20240524123523', '2024-05-24 12:36:59', 1141),
('DoctrineMigrations\\Version20240525173615', '2024-05-25 17:36:42', 52),
('DoctrineMigrations\\Version20240525194655', '2024-05-25 19:47:16', 573);

-- --------------------------------------------------------

--
-- Structure de la table `image`
--

DROP TABLE IF EXISTS `image`;
CREATE TABLE IF NOT EXISTS `image` (
  `id_image` int NOT NULL AUTO_INCREMENT,
  `lien` varchar(255) NOT NULL,
  PRIMARY KEY (`id_image`)
) ENGINE=InnoDB AUTO_INCREMENT=58 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Déchargement des données de la table `image`
--

INSERT INTO `image` (`id_image`, `lien`) VALUES
(1, 'images/300x300-9555e51fdd6fb66ddb069acfd8dda99c.png'),
(2, 'images/300x300-8c52b68089e3ff546cb5a1da812fbc25.png'),
(3, 'images/300x300-52d6df8b5af8ae2a906b3d19b31e69b7.png'),
(4, 'images/300x300-60081e8ba86b535b5b4aac07fb838fce.png'),
(5, 'images/300x300-c061143dce5c75104eadd6daee18da91.png'),
(6, 'images/300x300-2b8fe00ba5cc327924e3ab49807f9951.png'),
(7, 'images/300x300-c684542cc0bfea4a5a78c415edf6e51b.png'),
(8, 'images/300x300-24a76b7b2bff9b6a14d6b81c26420086.png'),
(9, 'images/300x300-4efb7788222b6fa71da788e8263da13d.png'),
(10, 'images/300x300-cb4c1b5ae91d0db753475b836f641940.png'),
(11, 'images/300x300-a95062ba546c2bfd28c067273bf59678.png'),
(12, 'images/300x300-c3ceee366de254dd8f95169a0926bce4.png'),
(13, 'images/300x300-7e694e27c145f3536a7e15c9acb1ff13.png'),
(14, 'images/300x300-0fef85d749fdb11a5f81b88df14bb5de.png'),
(15, 'images/300x300-eb6025d927bb79672383d18e211a3e3c.png'),
(16, 'images/300x300-684fecb043acd036bfb644c73858473a.png'),
(17, 'images/300x300-29b2ac18f17d95e95bbfe817710043de.png'),
(18, 'images/300x300-66d98a9a71235020d90722bb7e994d4b.png'),
(19, 'images/300x300-734c551fdff3e27b74ee24c49e1861e1.png'),
(20, 'images/300x300-e59cc7644c2ac0852f00c4eba4f026c5.png'),
(21, 'images/300x300-4c5f2b7e5fd31c72b79f1578c93223c2.png'),
(22, 'images/300x300-baaa043dcee8c38f6caaae663b26c70f.png'),
(23, 'images/300x300-fae72cb7ceae7c7a56309e46cd7f6c68.png'),
(24, 'images/300x300-ff2da7102986b3c97c503ef7b2f661c7.png'),
(25, 'images/300x300-8cbe24c44326b4f544f6d234e652b639.png'),
(26, 'images/300x300-0256e2694ad913cfd0d238e9bc0f2979.png'),
(27, 'images/300x300-3980bb35dcffce2040197d5642bc123e.png'),
(28, 'images/300x300-cca111934d07a3c35d97ac8fa19f487c.png'),
(29, 'images/300x300-7a1dba51f8ca520df203b1d91f0d04f4.png'),
(30, 'images/300x300-d4d80c72553ade1da833de43ec037833.png'),
(31, 'images/300x300-850ebc006e613d62c2f101a344676e77.png'),
(32, 'images/300x300-7fb1df18506718a1f8cace82e9de8256.png'),
(33, 'images/300x300-22da996c4b39d509fd116383ca0c44ea.png'),
(34, 'images/300x300-d065851cd659121eb638e5868cf35b89.png'),
(35, 'images/300x300-fc60cd8c93b46736c93c782c2011a774.png'),
(36, 'images/300x300-3b67fb849bac864b57b2f75da71ea718.png'),
(37, 'images/300x300-674ec014ea489ac8ec5842e65baf2a17.png'),
(38, 'images/300x300-b2d5617fba61151ae12e0358d6cbe993.png'),
(39, 'images/300x300-5f416d6c06264e24d9ee379623aca66b.png'),
(40, 'images/300x300-fbc3705b5e6b3106549e0e24efe9aefe.png'),
(41, 'images/300x300-2eaca555a12f7a38709df9f6f77ba736.png'),
(42, 'images/300x300-461bb1226aae10c0850f1dc177db884c.png'),
(43, 'images/300x300-f6ab1cc5a3ca1ba614eecf2d1dbcee47.png'),
(44, 'images/300x300-effaae8f7fc3b1f43eaba43532f6b557.png'),
(45, 'images/300x300-4a0012202caee1ac00f533074076e118.png'),
(46, 'images/300x300-8ba0a7469225bdcf4b2b79fe623d30de.png'),
(47, 'images/300x300-c6585e995384080ca09cffb3061bb20e.png'),
(48, 'images/300x300-2756d58115970b08730d9cb13e5f4d76.png'),
(49, 'images/300x300-6df6486612d97e1ca2b2ce2d29d8d707.png'),
(50, 'images/300x300-c6535115f9551797e0316e8c6755d7e8.png'),
(51, 'images/300x300-666992c77ba5c3391c7d10277e7cb6cc.png'),
(52, 'images/300x300-c22b2d53677b1d93df67ebcf595bc070.png'),
(53, 'images/300x300-e73426f5b3d6b1bc92ee04c11e4b6b5d.png'),
(54, 'images/300x300-a54ff7fb463715d71b07d921ed58b788.png'),
(55, 'images/300x300-768ad4dc60a7ef859f62e39a0ad3226a.png'),
(56, 'images/300x300-15586bbe65d37697019e832393a53593.png'),
(57, 'images/300x300-99cd5b3bd6b44a9cc41c07b3ab73fa65.png');

-- --------------------------------------------------------

--
-- Structure de la table `image_carousel`
--

DROP TABLE IF EXISTS `image_carousel`;
CREATE TABLE IF NOT EXISTS `image_carousel` (
  `id` int NOT NULL AUTO_INCREMENT,
  `carrousel_id` int NOT NULL,
  `image_id` int NOT NULL,
  `rang` int NOT NULL,
  PRIMARY KEY (`id`),
  KEY `IDX_9227C9A81AA511C9` (`carrousel_id`),
  KEY `IDX_9227C9A83DA5256D` (`image_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Structure de la table `image_produit`
--

DROP TABLE IF EXISTS `image_produit`;
CREATE TABLE IF NOT EXISTS `image_produit` (
  `id_image_produit` int NOT NULL AUTO_INCREMENT,
  `id_image_id` int NOT NULL,
  `id_produit_id` int NOT NULL,
  PRIMARY KEY (`id_image_produit`),
  KEY `IDX_BCB5BBFB6D7EC9F8` (`id_image_id`),
  KEY `IDX_BCB5BBFBAABEFE2C` (`id_produit_id`)
) ENGINE=InnoDB AUTO_INCREMENT=52 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Déchargement des données de la table `image_produit`
--

INSERT INTO `image_produit` (`id_image_produit`, `id_image_id`, `id_produit_id`) VALUES
(1, 4, 6),
(2, 5, 51),
(3, 6, 7),
(4, 11, 9),
(5, 10, 10),
(6, 8, 8),
(7, 16, 5),
(8, 14, 1),
(9, 15, 4),
(10, 13, 3),
(11, 12, 2),
(12, 17, 15),
(13, 20, 14),
(14, 21, 13),
(15, 19, 11),
(16, 18, 12),
(17, 26, 19),
(18, 25, 17),
(19, 23, 18),
(20, 24, 20),
(21, 22, 16),
(22, 31, 23),
(23, 29, 22),
(24, 27, 25),
(25, 28, 24),
(26, 30, 21),
(27, 36, 27),
(28, 35, 26),
(29, 34, 30),
(30, 33, 29),
(31, 32, 28),
(32, 41, 31),
(33, 40, 32),
(34, 39, 33),
(35, 38, 35),
(36, 37, 34),
(37, 46, 37),
(38, 45, 39),
(39, 44, 38),
(40, 43, 40),
(41, 42, 36),
(42, 51, 44),
(43, 50, 43),
(44, 49, 42),
(45, 48, 45),
(46, 47, 41),
(47, 56, 48),
(48, 55, 49),
(49, 54, 46),
(50, 53, 47),
(51, 52, 50);

-- --------------------------------------------------------

--
-- Structure de la table `marques`
--

DROP TABLE IF EXISTS `marques`;
CREATE TABLE IF NOT EXISTS `marques` (
  `id` int NOT NULL AUTO_INCREMENT,
  `nom` varchar(50) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=38 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Déchargement des données de la table `marques`
--

INSERT INTO `marques` (`id`, `nom`) VALUES
(1, 'LuxeDesign'),
(2, 'ModernComfort'),
(3, 'HomeStyle'),
(4, 'ClassicFurniture'),
(5, 'TrendyLiving'),
(6, 'ArtisanHome'),
(7, 'ContemporaryDesign'),
(8, 'UrbanStyle'),
(9, 'LuxuryLiving'),
(10, 'SmartFurniture'),
(11, 'ModernLiving'),
(12, 'RusticHome'),
(13, 'OfficeComfort'),
(14, 'OutdoorEssentials'),
(15, 'DesignerChoice'),
(16, 'BarTrends'),
(17, 'SleepWell'),
(18, 'BasicLiving'),
(19, 'StorageSolutions'),
(20, 'KidsZone'),
(21, 'RetroStyle'),
(22, 'UrbanLiving'),
(23, 'CottageCharm'),
(24, 'BabyEssentials'),
(25, 'ModernHome'),
(26, 'IndustrialDesign'),
(27, 'MultifunctionalFurniture'),
(28, 'ScandinavianDesign'),
(29, 'NaturalHome'),
(30, 'RusticLiving'),
(31, 'MinimalistStyle'),
(32, 'VintageVibes'),
(33, 'ScandinavianDesign'),
(34, 'BohemianLiving'),
(35, 'NordicComfort'),
(36, 'Ikea');

-- --------------------------------------------------------

--
-- Structure de la table `materiaux`
--

DROP TABLE IF EXISTS `materiaux`;
CREATE TABLE IF NOT EXISTS `materiaux` (
  `id_materiel` int NOT NULL AUTO_INCREMENT,
  `nom` varchar(50) NOT NULL,
  PRIMARY KEY (`id_materiel`)
) ENGINE=InnoDB AUTO_INCREMENT=13 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Déchargement des données de la table `materiaux`
--

INSERT INTO `materiaux` (`id_materiel`, `nom`) VALUES
(1, 'Bois massif'),
(2, 'Métal'),
(3, 'Verre'),
(4, 'Cuir'),
(5, 'Tissu'),
(6, 'Rotin'),
(7, 'Marbre'),
(8, 'Plastique'),
(9, 'Osier'),
(10, 'Laiton'),
(11, 'Contreplaqué');

-- --------------------------------------------------------

--
-- Structure de la table `messenger_messages`
--

DROP TABLE IF EXISTS `messenger_messages`;
CREATE TABLE IF NOT EXISTS `messenger_messages` (
  `id` bigint NOT NULL AUTO_INCREMENT,
  `body` longtext COLLATE utf8mb4_unicode_ci NOT NULL,
  `headers` longtext COLLATE utf8mb4_unicode_ci NOT NULL,
  `queue_name` varchar(190) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` datetime NOT NULL COMMENT '(DC2Type:datetime_immutable)',
  `available_at` datetime NOT NULL COMMENT '(DC2Type:datetime_immutable)',
  `delivered_at` datetime DEFAULT NULL COMMENT '(DC2Type:datetime_immutable)',
  PRIMARY KEY (`id`),
  KEY `IDX_75EA56E0FB7336F0` (`queue_name`),
  KEY `IDX_75EA56E0E3BD61CE` (`available_at`),
  KEY `IDX_75EA56E016BA31DB` (`delivered_at`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Structure de la table `produits`
--

DROP TABLE IF EXISTS `produits`;
CREATE TABLE IF NOT EXISTS `produits` (
  `id_produit` int NOT NULL AUTO_INCREMENT,
  `reference` varchar(15) NOT NULL,
  `nom` varchar(100) NOT NULL,
  `prix` float NOT NULL,
  `description` longtext NOT NULL,
  `quantite` int NOT NULL,
  `date_creation` date NOT NULL,
  `marque` int DEFAULT NULL,
  `categorie` int DEFAULT NULL,
  PRIMARY KEY (`id_produit`),
  KEY `IDX_BE2DDF8C497DD634` (`categorie`),
  KEY `IDX_BE2DDF8C5A6F91CE` (`marque`)
) ENGINE=InnoDB AUTO_INCREMENT=53 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Déchargement des données de la table `produits`
--

INSERT INTO `produits` (`id_produit`, `reference`, `nom`, `prix`, `description`, `quantite`, `date_creation`, `marque`, `categorie`) VALUES
(1, 'CAN1234', 'Canapé en cuir noir', 799.99, 'Canapé spacieux en cuir noir de haute qualité.', 20, '2024-04-13', 1, 1),
(2, 'CAN2345', 'Canapé d\'angle gris', 899.99, 'Canapé d\'angle moderne en tissu gris avec accoudoirs ajustables.', 15, '2024-04-13', 2, 1),
(3, 'CAN3456', 'Canapé convertible en tissu', 649.99, 'Canapé convertible pratique en tissu avec un mécanisme facile à utiliser.', 25, '2024-04-13', 3, 1),
(4, 'CAN4567', 'Canapé en cuir marron', 899.99, 'Canapé en cuir véritable de couleur marron avec des coutures décoratives.', 18, '2024-04-13', 4, 1),
(5, 'CAN5678', 'Canapé modulaire en tissu', 999.99, 'Canapé modulaire en tissu avec des modules interchangeables pour une configuration personnalisée.', 12, '2024-04-13', 5, 1),
(6, 'TAB1234', 'Table à manger en bois massif', 349.99, 'Table à manger robuste en bois massif avec une finition naturelle.', 15, '2024-04-13', 6, 2),
(7, 'TAB2345', 'Table basse rectangulaire', 199.99, 'Table basse rectangulaire avec un plateau en verre trempé et des pieds en métal.', 20, '2024-04-13', 7, 2),
(8, 'TAB3456', 'Table de cuisine ronde', 249.99, 'Table de cuisine ronde en bois avec un design moderne et des pieds en métal.', 18, '2024-04-13', 8, 2),
(9, 'TAB4567', 'Table d\'appoint en marbre', 159.99, 'Table d\'appoint élégante avec un plateau en marbre blanc et une base en métal doré.', 22, '2024-04-13', 9, 2),
(10, 'TAB5678', 'Table console extensible', 499.99, 'Table console extensible en bois avec une conception intelligente pour économiser de l\'espace.', 10, '2024-04-13', 10, 2),
(11, 'CHA1234', 'Chaise de salle à manger en bois', 79.99, 'Chaise de salle à manger en bois avec un design simple et une assise confortable.', 30, '2024-04-13', 11, 3),
(12, 'CHA2345', 'Chaise de bureau ergonomique', 129.99, 'Chaise de bureau ergonomique avec un support lombaire réglable et des accoudoirs rembourrés.', 25, '2024-04-13', 12, 3),
(13, 'CHA3456', 'Chaise pliante en métal', 49.99, 'Chaise pliante pratique en métal avec une assise en plastique résistant.', 40, '2024-04-13', 13, 3),
(14, 'CHA4567', 'Chaise longue moderne', 299.99, 'Chaise longue moderne en tissu avec un design élégant et un dossier réglable.', 15, '2024-04-13', 14, 3),
(15, 'CHA5678', 'Chaise de bar en cuir', 149.99, 'Chaise de bar confortable avec un siège rembourré en cuir et une base pivotante.', 20, '2024-04-13', 15, 3),
(16, 'LIT1234', 'Lit double avec tête de lit rembourrée', 899.99, 'Lit double confortable avec une tête de lit rembourrée pour un soutien supplémentaire.', 10, '2024-04-13', 16, 4),
(17, 'LIT2345', 'Lit simple en métal', 199.99, 'Lit simple robuste en métal avec une finition noire classique.', 20, '2024-04-13', 17, 4),
(18, 'LIT3456', 'Lit gigogne en bois', 499.99, 'Lit gigogne en bois avec un tiroir supplémentaire pour un espace de rangement pratique.', 15, '2024-04-13', 18, 4),
(19, 'LIT4567', 'Lit superposé en métal', 399.99, 'Lit superposé en métal avec des barrières de sécurité et des échelles intégrées.', 8, '2024-04-13', 19, 4),
(20, 'LIT5678', 'Lit king-size avec matelas orthopédique', 1499.99, 'Lit king-size avec un matelas orthopédique de luxe pour un confort optimal.', 12, '2024-04-13', 20, 4),
(21, 'ARM1234', 'Armoire de rangement en bois', 549.99, 'Grande armoire de rangement en bois avec plusieurs étagères et tiroirs.', 8, '2024-04-13', 21, 5),
(22, 'ARM2345', 'Armoire-penderie avec miroir', 699.99, 'Armoire-penderie spacieuse avec un miroir pleine longueur et des portes coulissantes.', 12, '2024-04-13', 22, 5),
(23, 'ARM3456', 'Armoire à bijoux sur pied', 179.99, 'Armoire à bijoux sur pied avec un miroir intégré et des compartiments pour ranger vos accessoires.', 15, '2024-04-13', 23, 5),
(24, 'ARM4567', 'Armoire à chaussures en bois', 129.99, 'Armoire à chaussures en bois avec des étagères réglables pour organiser vos chaussures.', 20, '2024-04-13', 24, 5),
(25, 'ARM5678', 'Armoire de bureau en métal', 299.99, 'Armoire de bureau en métal avec des portes verrouillables pour sécuriser vos documents.', 10, '2024-04-13', 25, 5),
(26, 'BIB1234', 'Bibliothèque moderne à étagères', 299.99, 'Bibliothèque élégante avec des étagères réglables pour organiser vos livres et décorations.', 12, '2024-04-13', 26, 6),
(27, 'BIB2345', 'Bibliothèque murale en bois', 399.99, 'Bibliothèque murale en bois avec des étagères flottantes pour un look moderne.', 8, '2024-04-13', 27, 6),
(28, 'BIB3456', 'Bibliothèque d\'angle en métal', 249.99, 'Bibliothèque d\'angle en métal avec des étagères en verre pour un design contemporain.', 10, '2024-04-13', 28, 6),
(29, 'BIB4567', 'Bibliothèque encastrée', 599.99, 'Bibliothèque encastrée sur mesure avec des étagères intégrées pour un rangement élégant.', 6, '2024-04-13', 29, 6),
(30, 'BIB5678', 'Bibliothèque industrielle à roulettes', 349.99, 'Bibliothèque industrielle avec des étagères en bois et une structure en métal robuste.', 15, '2024-04-13', 30, 6),
(31, 'COM1234', 'Commode vintage en bois', 199.99, 'Commode vintage en bois avec des tiroirs spacieux pour le rangement.', 18, '2024-04-13', 31, 7),
(32, 'COM2345', 'Commode à tiroirs en métal', 149.99, 'Commode à tiroirs en métal avec des poignées en cuir pour un look industriel.', 15, '2024-04-13', 32, 7),
(33, 'COM3456', 'Commode avec paniers en osier', 129.99, 'Commode pratique avec des paniers en osier tressé pour un rangement naturel.', 20, '2024-04-13', 33, 7),
(34, 'COM4567', 'Commode à langer pour bébé', 299.99, 'Commode à langer pour bébé avec des tiroirs de rangement et un espace pour changer bébé.', 10, '2024-04-13', 34, 7),
(35, 'COM5678', 'Commode moderne à six tiroirs', 249.99, 'Commode moderne à six tiroirs avec des poignées encastrées pour un look épuré.', 12, '2024-04-13', 35, 7),
(36, 'TAB1234', 'Table basse en bois et métal', 129.99, 'Table basse en bois et métal avec une étagère inférieure pour le rangement.', 25, '2024-04-13', 1, 8),
(37, 'TAB2345', 'Table basse avec plateau relevable', 179.99, 'Table basse avec un plateau relevable pour transformer en table à manger occasionnelle.', 18, '2024-04-13', 2, 8),
(38, 'TAB3456', 'Table basse en marbre et laiton', 349.99, 'Table basse en marbre blanc et laiton doré avec un design luxueux.', 8, '2024-04-13', 3, 8),
(39, 'TAB4567', 'Table basse ovale en verre', 299.99, 'Table basse ovale en verre trempé avec une base en acier inoxydable pour une touche moderne.', 12, '2024-04-13', 4, 8),
(40, 'TAB5678', 'Table basse carrée avec tiroirs', 249.99, 'Table basse carrée avec des tiroirs de rangement et une finition en bois naturel.', 15, '2024-04-13', 5, 8),
(41, 'BUF1234', 'Buffet en bois massif', 499.99, 'Buffet en bois massif avec des portes coulissantes et des étagères réglables.', 14, '2024-04-13', 6, 9),
(42, 'BUF2345', 'Buffet haut moderne', 399.99, 'Buffet haut moderne avec des façades laquées et des poignées encastrées pour un look épuré.', 10, '2024-04-13', 7, 9),
(43, 'BUF3456', 'Buffet industriel en métal', 349.99, 'Buffet industriel en métal avec des portes grillagées et une finition vieillie pour un look vintage.', 12, '2024-04-13', 8, 9),
(44, 'BUF4567', 'Buffet scandinave avec pieds compas', 449.99, 'Buffet scandinave avec des pieds compas et des poignées en laiton pour une ambiance rétro.', 8, '2024-04-13', 9, 9),
(45, 'BUF5678', 'Buffet contemporain à quatre portes', 599.99, 'Buffet contemporain avec quatre portes et des étagères intérieures pour un rangement organisé.', 6, '2024-04-13', 10, 9),
(46, 'FAU1234', 'Fauteuil club en cuir vieilli', 599.99, 'Fauteuil club en cuir vieilli avec un dossier incliné pour un confort optimal.', 22, '2024-04-13', 11, 10),
(47, 'FAU2345', 'Fauteuil bergère rembourré', 399.99, 'Fauteuil bergère rembourré avec des accoudoirs sculptés et un coussin d\'assise moelleux.', 18, '2024-04-13', 12, 10),
(48, 'FAU3456', 'Fauteuil en rotin avec coussin', 249.99, 'Fauteuil en rotin avec un coussin d\'assise rembourré pour un confort décontracté.', 25, '2024-04-13', 13, 10),
(49, 'FAU4567', 'Fauteuil pivotant en tissu', 299.99, 'Fauteuil pivotant en tissu avec une base en métal chromé pour une rotation à 360 degrés.', 20, '2024-04-13', 14, 10),
(50, 'FAU5678', 'Fauteuil à bascule scandinave', 349.99, 'Fauteuil à bascule scandinave avec une assise rembourrée et des pieds en bois massif.', 15, '2024-04-13', 15, 10),
(51, 'TAB28173', 'Table à manger en bois', 499.99, 'Table en bois massif avec d\'élégante finissions.', 30, '2024-05-03', 6, 2);

--
-- Contraintes pour les tables déchargées
--

--
-- Contraintes pour la table `client`
--
ALTER TABLE `client`
  ADD CONSTRAINT `FK_C74404551DC2A166` FOREIGN KEY (`id_adresse`) REFERENCES `adresses` (`id_adresse`);

--
-- Contraintes pour la table `image_carousel`
--
ALTER TABLE `image_carousel`
  ADD CONSTRAINT `FK_9227C9A81AA511C9` FOREIGN KEY (`carrousel_id`) REFERENCES `carrousel` (`id`),
  ADD CONSTRAINT `FK_9227C9A83DA5256D` FOREIGN KEY (`image_id`) REFERENCES `image` (`id_image`);

--
-- Contraintes pour la table `image_produit`
--
ALTER TABLE `image_produit`
  ADD CONSTRAINT `FK_BCB5BBFB6D7EC9F8` FOREIGN KEY (`id_image_id`) REFERENCES `image` (`id_image`),
  ADD CONSTRAINT `FK_BCB5BBFBAABEFE2C` FOREIGN KEY (`id_produit_id`) REFERENCES `produits` (`id_produit`);

--
-- Contraintes pour la table `produits`
--
ALTER TABLE `produits`
  ADD CONSTRAINT `FK_BE2DDF8C497DD634` FOREIGN KEY (`categorie`) REFERENCES `categories` (`id_categorie`),
  ADD CONSTRAINT `FK_BE2DDF8C5A6F91CE` FOREIGN KEY (`marque`) REFERENCES `marques` (`id`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
