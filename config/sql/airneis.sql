-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Hôte : 127.0.0.1:3306
-- Généré le : lun. 26 août 2024 à 16:28
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
-- Structure de la table `admin`
--

DROP TABLE IF EXISTS `admin`;
CREATE TABLE IF NOT EXISTS `admin` (
  `id` int NOT NULL AUTO_INCREMENT,
  `prenom` varchar(40) COLLATE utf8mb4_unicode_ci NOT NULL,
  `nom` varchar(40) COLLATE utf8mb4_unicode_ci NOT NULL,
  `email` varchar(180) COLLATE utf8mb4_unicode_ci NOT NULL,
  `roles` json NOT NULL,
  `password` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `UNIQ_IDENTIFIER_EMAIL` (`email`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Déchargement des données de la table `admin`
--

INSERT INTO `admin` (`id`, `prenom`, `nom`, `email`, `roles`, `password`) VALUES
(1, 'Admin', 'Admin', 'admin@example.com', '[\"ROLE_ADMIN\"]', '$2y$13$Pd6wTHrmTQQavZliXLlk3.rIUFzslwxBclLi7yrwSBosMhpKXzwUS');

-- --------------------------------------------------------

--
-- Structure de la table `adresses`
--

DROP TABLE IF EXISTS `adresses`;
CREATE TABLE IF NOT EXISTS `adresses` (
  `id_adresse` int NOT NULL AUTO_INCREMENT,
  `pays` varchar(50) COLLATE utf8mb4_unicode_ci NOT NULL,
  `ville` varchar(50) COLLATE utf8mb4_unicode_ci NOT NULL,
  `code_postal` varchar(8) COLLATE utf8mb4_unicode_ci NOT NULL,
  `rue` varchar(100) COLLATE utf8mb4_unicode_ci NOT NULL,
  PRIMARY KEY (`id_adresse`)
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Déchargement des données de la table `adresses`
--

INSERT INTO `adresses` (`id_adresse`, `pays`, `ville`, `code_postal`, `rue`) VALUES
(1, 'France', 'Bondaroy', '45300', '1 impasse des coquelicots'),
(2, 'France', 'Paris', '75000', '12 rue de Rivoli'),
(3, 'France', 'Lyon', '69000', '23 boulevard de la République');

-- --------------------------------------------------------

--
-- Structure de la table `carrousel`
--

DROP TABLE IF EXISTS `carrousel`;
CREATE TABLE IF NOT EXISTS `carrousel` (
  `id` int NOT NULL AUTO_INCREMENT,
  `rang` int NOT NULL,
  `nom` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=65 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Déchargement des données de la table `carrousel`
--

INSERT INTO `carrousel` (`id`, `rang`, `nom`) VALUES
(1, 1, 'Table'),
(2, 1, 'Canapé'),
(3, 1, 'Chaise'),
(4, 1, 'Lit'),
(5, 1, 'Armoire'),
(6, 1, 'Bibliothèque'),
(7, 1, 'Commode'),
(8, 1, 'Table basse'),
(9, 1, 'Buffet'),
(10, 1, 'Fauteuil'),
(11, 1, 'Table à manger en bois massif'),
(12, 1, 'Table basse rectangulaire'),
(13, 1, 'Table de cuisine ronde'),
(14, 1, "Table d\'appoint en marbre"),
(15, 1, 'Table console extensible'),
(16, 1, 'Table à manger en bois'),
(17, 1, 'Canapé en cuir noir'),
(18, 1, "Canapé d\'angle gris"),
(19, 1, 'Canapé convertible en tissu'),
(20, 1, 'Canapé en cuir marron'),
(21, 1, 'Canapé modulaire en tissu'),
(22, 1, 'Chaise de salle à manger en bois'),
(23, 1, 'Chaise de bureau ergonomique'),
(24, 1, 'Chaise pliante en métal'),
(25, 1, 'Chaise longue moderne'),
(26, 1, 'Chaise de bar en cuir'),
(27, 1, 'Lit double avec tête de lit rembourrée'),
(28, 1, 'Lit simple en métal'),
(29, 1, 'Lit gigogne en bois'),
(30, 1, 'Lit superposé en métal'),
(31, 1, 'Lit king-size avec matelas orthopédique'),
(32, 1, 'Armoire de rangement en bois'),
(33, 1, 'Armoire-penderie avec miroir'),
(34, 1, 'Armoire à bijoux sur pied'),
(35, 1, 'Armoire à chaussures en bois'),
(36, 1, 'Armoire de bureau en métal'),
(37, 1, 'Bibliothèque moderne à étagères'),
(38, 1, 'Bibliothèque murale en bois'),
(39, 1, "Bibliothèque d\'angle en métal"),
(40, 1, 'Bibliothèque encastrée'),
(41, 1, 'Bibliothèque industrielle à roulettes'),
(42, 1, 'Commode vintage en bois'),
(43, 1, 'Commode vintage en bois'),
(44, 1, 'Commode à tiroirs en métal'),
(45, 1, 'Commode avec paniers en osier'),
(46, 1, 'Commode à langer pour bébé'),
(47, 1, 'Commode moderne à six tiroirs'),
(48, 1, 'Table basse en bois et métal'),
(49, 1, 'Table basse avec plateau relevable'),
(50, 1, 'Table basse en marbre et laiton'),
(51, 1, 'Table basse ovale en verre'),
(52, 1, 'Table basse carrée avec tiroirs'),
(53, 1, 'Buffet en bois massif'),
(54, 1, 'Buffet haut moderne'),
(55, 1, 'Buffet industriel en métal'),
(56, 1, 'Buffet contemporain à quatre portes'),
(57, 1, 'Fauteuil club en cuir vieilli'),
(58, 1, 'Fauteuil bergère rembourré'),
(59, 1, 'Fauteuil en rotin avec coussin'),
(60, 1, 'Fauteuil pivotant en tissu'),
(61, 1, 'Fauteuil à bascule scandinave'),
(62, 1, 'Slide 1'),
(63, 2, 'Slide 2'),
(64, 3, 'Slide 3');

-- --------------------------------------------------------

--
-- Structure de la table `carrousel_images`
--

DROP TABLE IF EXISTS `carrousel_images`;
CREATE TABLE IF NOT EXISTS `carrousel_images` (
  `carrousel_id` int NOT NULL,
  `image_id` int NOT NULL,
  PRIMARY KEY (`carrousel_id`,`image_id`),
  KEY `IDX_B6396D71AA511C9` (`carrousel_id`),
  KEY `IDX_B6396D73DA5256D` (`image_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Déchargement des données de la table `carrousel_images`
--

INSERT INTO `carrousel_images` (`carrousel_id`, `image_id`) VALUES
(1, 57),
(2, 15),
(3, 88),
(4, 92),
(5, 29),
(6, 116),
(7, 38),
(8, 46),
(9, 145),
(10, 52),
(11, 4),
(12, 6),
(13, 8),
(14, 9),
(15, 7),
(16, 5),
(17, 59),
(18, 61),
(19, 63),
(20, 15),
(21, 64),
(22, 19),
(23, 18),
(24, 21),
(25, 20),
(26, 17),
(27, 22),
(28, 25),
(29, 23),
(30, 26),
(31, 24),
(32, 30),
(33, 29),
(34, 31),
(35, 28),
(36, 27),
(37, 35),
(38, 36),
(39, 32),
(40, 33),
(41, 34),
(42, 41),
(43, 41),
(44, 40),
(45, 39),
(46, 37),
(47, 38),
(48, 42),
(49, 46),
(50, 44),
(51, 139),
(52, 43),
(53, 47),
(54, 49),
(55, 50),
(56, 48),
(57, 54),
(58, 53),
(59, 56),
(60, 55),
(61, 52),
(62, 161),
(63, 162),
(64, 163);

-- --------------------------------------------------------

--
-- Structure de la table `categories`
--

DROP TABLE IF EXISTS `categories`;
CREATE TABLE IF NOT EXISTS `categories` (
  `id_categorie` int NOT NULL AUTO_INCREMENT,
  `nom` varchar(30) COLLATE utf8mb4_unicode_ci NOT NULL,
  PRIMARY KEY (`id_categorie`)
) ENGINE=InnoDB AUTO_INCREMENT=11 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

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
  `prenom` varchar(40) COLLATE utf8mb4_unicode_ci NOT NULL,
  `nom` varchar(40) COLLATE utf8mb4_unicode_ci NOT NULL,
  `email` varchar(80) COLLATE utf8mb4_unicode_ci NOT NULL,
  `roles` json NOT NULL,
  `mot_de_passe` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `telephone` varchar(15) COLLATE utf8mb4_unicode_ci NOT NULL,
  `stripe_customer_id` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  PRIMARY KEY (`id_client`),
  UNIQUE KEY `UNIQ_C7440455E7927C74` (`email`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Structure de la table `client_adresse`
--

DROP TABLE IF EXISTS `client_adresse`;
CREATE TABLE IF NOT EXISTS `client_adresse` (
  `client_id` int NOT NULL,
  `adresse_id` int NOT NULL,
  PRIMARY KEY (`client_id`,`adresse_id`),
  KEY `IDX_91624C6B19EB6921` (`client_id`),
  KEY `IDX_91624C6B4DE7DC5C` (`adresse_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Structure de la table `commande`
--

DROP TABLE IF EXISTS `commande`;
CREATE TABLE IF NOT EXISTS `commande` (
  `id_commande` int NOT NULL AUTO_INCREMENT,
  `id_client` int DEFAULT NULL,
  `id_panier` int DEFAULT NULL,
  `reference` varchar(8) COLLATE utf8mb4_unicode_ci NOT NULL,
  `date_commande` datetime NOT NULL,
  `id_adresse` int DEFAULT NULL,
  `etat` varchar(20) COLLATE utf8mb4_unicode_ci NOT NULL,
  `id_payment_method` int DEFAULT NULL,
  PRIMARY KEY (`id_commande`),
  UNIQUE KEY `UNIQ_6EEAA67DAEA34913` (`reference`),
  KEY `IDX_6EEAA67DE173B1B8` (`id_client`),
  KEY `IDX_6EEAA67D2FBB81F` (`id_panier`),
  KEY `IDX_6EEAA67D1DC2A166` (`id_adresse`),
  KEY `IDX_6EEAA67D46071CF0` (`id_payment_method`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Structure de la table `contact`
--

DROP TABLE IF EXISTS `contact`;
CREATE TABLE IF NOT EXISTS `contact` (
  `id` int NOT NULL AUTO_INCREMENT,
  `prenom` varchar(40) COLLATE utf8mb4_unicode_ci NOT NULL,
  `nom` varchar(40) COLLATE utf8mb4_unicode_ci NOT NULL,
  `email` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `message` longtext COLLATE utf8mb4_unicode_ci NOT NULL,
  `date_creation` datetime NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

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
('DoctrineMigrations\\Version20240720231227', '2024-08-14 11:17:56', 1106),
('DoctrineMigrations\\Version20240722234124', '2024-08-14 11:17:57', 89),
('DoctrineMigrations\\Version20240725074011', '2024-08-14 11:17:57', 14),
('DoctrineMigrations\\Version20240725164507', '2024-08-14 11:17:57', 15),
('DoctrineMigrations\\Version20240725181807', '2024-08-14 11:17:57', 69),
('DoctrineMigrations\\Version20240729111650', '2024-08-14 11:17:58', 62),
('DoctrineMigrations\\Version20240729184745', '2024-08-14 11:17:58', 12),
('DoctrineMigrations\\Version20240730001147', '2024-08-14 11:17:58', 34),
('DoctrineMigrations\\Version20240730085457', '2024-08-14 11:17:58', 154),
('DoctrineMigrations\\Version20240802095342', '2024-08-14 11:17:58', 17),
('DoctrineMigrations\\Version20240811085147', '2024-08-14 11:17:58', 24),
('DoctrineMigrations\\Version20240818082014', '2024-08-18 08:20:20', 258);

-- --------------------------------------------------------

--
-- Structure de la table `image`
--

DROP TABLE IF EXISTS `image`;
CREATE TABLE IF NOT EXISTS `image` (
  `id_image` int NOT NULL AUTO_INCREMENT,
  `lien` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `nom` varchar(40) COLLATE utf8mb4_unicode_ci NOT NULL,
  PRIMARY KEY (`id_image`)
) ENGINE=InnoDB AUTO_INCREMENT=164 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Déchargement des données de la table `image`
--

INSERT INTO `image` (`id_image`, `lien`, `nom`) VALUES
(1, 'images/300x300-9555e51fdd6fb66ddb069acfd8dda99c.png', ''),
(2, 'images/300x300-8c52b68089e3ff546cb5a1da812fbc25.png', ''),
(3, 'images/300x300-52d6df8b5af8ae2a906b3d19b31e69b7.png', ''),
(4, 'images/300x300-60081e8ba86b535b5b4aac07fb838fce.png', 'Table à manger en bois massif'),
(5, 'images/300x300-c061143dce5c75104eadd6daee18da91.png', 'Table à manger en bois'),
(6, 'images/300x300-2b8fe00ba5cc327924e3ab49807f9951.png', 'Table basse rectangulaire'),
(7, 'images/300x300-c684542cc0bfea4a5a78c415edf6e51b.png', 'Table console extensible'),
(8, 'images/300x300-24a76b7b2bff9b6a14d6b81c26420086.png', 'Table de cuisine ronde'),
(9, 'images/300x300-4efb7788222b6fa71da788e8263da13d.png', "Table d\'appoint en marbre"),
(10, 'images/300x300-cb4c1b5ae91d0db753475b836f641940.png', ''),
(11, 'images/300x300-a95062ba546c2bfd28c067273bf59678.png', ''),
(12, 'images/300x300-c3ceee366de254dd8f95169a0926bce4.png', "Canapé d\'angle gris"),
(13, 'images/300x300-7e694e27c145f3536a7e15c9acb1ff13.png', 'Canapé convertible en tissu'),
(14, 'images/300x300-0fef85d749fdb11a5f81b88df14bb5de.png', 'Canapé en cuir noir'),
(15, 'images/300x300-eb6025d927bb79672383d18e211a3e3c.png', 'Canapé en cuir marron'),
(16, 'images/300x300-684fecb043acd036bfb644c73858473a.png', 'Canapé modulaire en tissu'),
(17, 'images/300x300-29b2ac18f17d95e95bbfe817710043de.png', 'Chaise de bar en cuir'),
(18, 'images/300x300-66d98a9a71235020d90722bb7e994d4b.png', 'Chaise de bureau ergonomique'),
(19, 'images/300x300-734c551fdff3e27b74ee24c49e1861e1.png', 'Chaise de salle à manger en bois'),
(20, 'images/300x300-e59cc7644c2ac0852f00c4eba4f026c5.png', 'Chaise longue moderne'),
(21, 'images/300x300-4c5f2b7e5fd31c72b79f1578c93223c2.png', 'Chaise pliante en métal'),
(22, 'images/300x300-baaa043dcee8c38f6caaae663b26c70f.png', 'Lit double avec tête de lit rembourrée'),
(23, 'images/300x300-fae72cb7ceae7c7a56309e46cd7f6c68.png', 'Lit gigogne en bois'),
(24, 'images/300x300-ff2da7102986b3c97c503ef7b2f661c7.png', 'Lit king-size avec matelas orthopédique'),
(25, 'images/300x300-8cbe24c44326b4f544f6d234e652b639.png', 'Lit simple en métal'),
(26, 'images/300x300-0256e2694ad913cfd0d238e9bc0f2979.png', 'Lit superposé en métal'),
(27, 'images/300x300-3980bb35dcffce2040197d5642bc123e.png', 'Armoire de bureau en métal'),
(28, 'images/300x300-cca111934d07a3c35d97ac8fa19f487c.png', 'Armoire à chaussures en bois'),
(29, 'images/300x300-7a1dba51f8ca520df203b1d91f0d04f4.png', 'Armoire-penderie avec miroir'),
(30, 'images/300x300-d4d80c72553ade1da833de43ec037833.png', 'Armoire de rangement en bois'),
(31, 'images/300x300-850ebc006e613d62c2f101a344676e77.png', 'Armoire à bijoux sur pied'),
(32, 'images/300x300-7fb1df18506718a1f8cace82e9de8256.png', "Bibliothèque d\'angle en métal"),
(33, 'images/300x300-22da996c4b39d509fd116383ca0c44ea.png', 'Bibliothèque encastrée'),
(34, 'images/300x300-d065851cd659121eb638e5868cf35b89.png', 'Bibliothèque industrielle à roulettes'),
(35, 'images/300x300-fc60cd8c93b46736c93c782c2011a774.png', 'Bibliothèque moderne à étagères'),
(36, 'images/300x300-3b67fb849bac864b57b2f75da71ea718.png', 'Bibliothèque murale en bois'),
(37, 'images/300x300-674ec014ea489ac8ec5842e65baf2a17.png', 'Commode à langer pour bébé'),
(38, 'images/300x300-b2d5617fba61151ae12e0358d6cbe993.png', 'Commode moderne à six tiroirs'),
(39, 'images/300x300-5f416d6c06264e24d9ee379623aca66b.png', 'Commode avec paniers en osier'),
(40, 'images/300x300-fbc3705b5e6b3106549e0e24efe9aefe.png', 'Commode à tiroirs en métal'),
(41, 'images/300x300-2eaca555a12f7a38709df9f6f77ba736.png', 'Commode vintage en bois'),
(42, 'images/300x300-461bb1226aae10c0850f1dc177db884c.png', 'Table basse en bois et métal'),
(43, 'images/300x300-f6ab1cc5a3ca1ba614eecf2d1dbcee47.png', 'Table basse carrée avec tiroirs'),
(44, 'images/300x300-effaae8f7fc3b1f43eaba43532f6b557.png', 'Table basse en marbre et laiton'),
(45, 'images/300x300-4a0012202caee1ac00f533074076e118.png', 'Table basse ovale en verre'),
(46, 'images/300x300-8ba0a7469225bdcf4b2b79fe623d30de.png', 'Table basse avec plateau relevable'),
(47, 'images/300x300-c6585e995384080ca09cffb3061bb20e.png', 'Buffet en bois massif'),
(48, 'images/300x300-2756d58115970b08730d9cb13e5f4d76.png', 'Buffet contemporain à quatre portes'),
(49, 'images/300x300-6df6486612d97e1ca2b2ce2d29d8d707.png', 'Buffet haut moderne'),
(50, 'images/300x300-c6535115f9551797e0316e8c6755d7e8.png', 'Buffet industriel en métal'),
(51, 'images/300x300-666992c77ba5c3391c7d10277e7cb6cc.png', 'Buffet scandinave avec pieds compas'),
(52, 'images/300x300-c22b2d53677b1d93df67ebcf595bc070.png', 'Fauteuil à bascule scandinave'),
(53, 'images/300x300-e73426f5b3d6b1bc92ee04c11e4b6b5d.png', 'Fauteuil bergère rembourré'),
(54, 'images/300x300-a54ff7fb463715d71b07d921ed58b788.png', 'Fauteuil club en cuir vieilli'),
(55, 'images/300x300-768ad4dc60a7ef859f62e39a0ad3226a.png', 'Fauteuil pivotant en tissu'),
(56, 'images/300x300-15586bbe65d37697019e832393a53593.png', 'Fauteuil en rotin avec coussin'),
(57, 'images/300x300-99cd5b3bd6b44a9cc41c07b3ab73fa65.png', 'Image 1 catégorie'),
(58, 'images/300x300-3afc64de63513d8e7d043a740a2def51.png', 'Canapé en cuir noir'),
(59, 'images/300x300-b356a66897684f98b18ca88812ee1346.png', 'Canapé en cuir noir'),
(60, 'images/300x300-69c82169d6ea7a89598543cf43a83094.png', "Canapé d\'angle gris"),
(61, 'images/300x300-853f3c0de39082f7c5499026948837ae.png', "Canapé d\'angle gris"),
(62, 'images/300x300-b416cdca9d22778f147ca3dfa87fa6c0.png', 'Canapé convertible en tissu 2'),
(63, 'images/300x300-c260d356719823a58a34b31aeb0f72a1.png', 'Canapé convertible en tissu'),
(64, 'images/300x300-ed76ca981e2749ebf4e87bbbdab3fa09.png', 'Canapé modulaire en tissu'),
(65, 'images/300x300-751905df730471b3c493f2dd97ff57eb.png', 'Canapé en cuir marron 2'),
(66, 'images/300x300-947c9bd14d7732b0079a980c44e9abe0.png', 'Canapé en cuir marron 3'),
(67, 'images/300x300-06d3117edc836f6eec23a296d2c178fb.png', 'Canapé modulaire en tissu 2'),
(68, 'images/300x300-533da194be1bec3f6dc7c39132673f34.png', 'Canapé modulaire en tissu 3'),
(69, 'images/300x300-56f4b5f1edeb8869c3d2d305418a8a39.png', 'Table à manger en bois massif 2'),
(70, 'images/300x300-534c4589598e54fcf2e3008254f77c0d.png', 'Table à manger en bois massif 3'),
(71, 'images/300x300-aafa53efc011bd54e7b2e39e17b60003.png', 'Table console extensible 2'),
(72, 'images/300x300-5280b09578c3e6a33032eb43b6fe436b.png', 'Table console extensible 3'),
(73, 'images/300x300-7f1f29c2c3ddf23f5d255c3e62c8954b.png', 'Table de cuisine ronde 2'),
(74, 'images/300x300-f827758f438dbb46b1694e8bb4abc592.png', 'Table de cuisine ronde 3'),
(75, 'images/300x300-da9671bea72f8e870ac505fbc907e3e5.png', 'Table basse rectangulaire 2'),
(76, 'images/300x300-7e1464166b5abdac3d2d1e946bc4c119.png', 'Table basse rectangulaire 3'),
(77, 'images/300x300-f07e8cb1acd1448f70829e8c642eaa33.png', "Table d\'appoint en marbre 2"),
(78, 'images/300x300-45286e128b9ac96638d65a3703f5a3af.png', "Table d\'appoint en marbre 3"),
(79, 'images/300x300-28040d0bf5f563023bf13ce510fa9f62.png', 'Table à manger en bois 2'),
(80, 'images/300x300-1667308f27ef90d71b95641c3c925f15.png', 'Table à manger en bois 3'),
(81, 'images/300x300-cf16764c796bdafb1f30c665c4f4a19c.png', 'Chaise de salle à manger en bois 2'),
(82, 'images/300x300-68a5267f1e2450f087b49bf5dc9f0e0b.png', 'Chaise de salle à manger en bois 3'),
(83, 'images/300x300-62f82662157c87bbeb8b1fd10e90de41.png', 'Chaise de bureau ergonomique 3'),
(84, 'images/300x300-8506732e7d29f4a8ced3489ab8f42d5f.png', 'Chaise de bureau ergonomique 2'),
(85, 'images/300x300-1fa6fa44a653312abcab40cd5e9b31c2.png', 'Chaise de bar en cuir 3'),
(86, 'images/300x300-4d76ad4ba5972044ac04312ea7cc603d.png', 'Chaise de bar en cuir 2'),
(87, 'images/300x300-c26c94e29db9d7d2c4b1dc90be576629.png', 'Chaise longue moderne 3'),
(88, 'images/300x300-1835711718120d504a44c4c51972b521.png', 'Chaise longue moderne 2'),
(89, 'images/300x300-75b1c3f2bceb8eb41c4ccfa17a167658.png', 'Chaise pliante en métal 2'),
(90, 'images/300x300-78ea7d881c9f3d4ad7c20a06b58ce557.png', 'Chaise pliante en métal 3'),
(91, 'images/300x300-ba0002ec063c85a5d0fe226c75c5b787.png', 'Lit double avec tête de lit rembourrée 2'),
(92, 'images/300x300-7bf5a5bdfce3105b4ca1299bb53cb456.png', 'Lit double avec tête de lit rembourrée 3'),
(93, 'images/300x300-ebce0a694e42ea1511305430d71f2956.png', 'Lit gigogne en bois 2'),
(94, 'images/300x300-6a6599d074ca065a52e1663f2761b564.png', 'Lit gigogne en bois 3'),
(95, 'images/300x300-8880425753c2c19d9f474b2ddbfe76d8.png', 'Lit k-size avec matelas orthopédique 2'),
(96, 'images/300x300-f7e8a15e1174523cb2fdaf43b2712b54.png', 'Lit k-size avec matelas orthopédique 3'),
(97, 'images/300x300-e7b65535ade4e8d22ac8c9483fedd87f.png', 'Lit simple en métal 2'),
(98, 'images/300x300-6da90940527111e082eacf3530ae2ef4.png', 'Lit simple en métal 3'),
(99, 'images/300x300-b1fbb8272ae7943167846d96bae22755.png', 'Lit superposé en métal 2'),
(100, 'images/300x300-74d1f80ce4e9543e7225060f72ec46b0.png', 'Lit superposé en métal 3'),
(101, 'images/300x300-2de94d9da2c8200349d152ced02a5b0b.png', 'Armoire à bijoux sur pied 2'),
(102, 'images/300x300-025e6600c7b11cf523691cb798b4707a.png', 'Armoire à bijoux sur pied 3'),
(103, 'images/300x300-cb2025c8c7271d58fc2f1efc568b4de5.png', 'Armoire à chaussures en bois 2'),
(104, 'images/300x300-2631eac7646839f803381b730a8bed32.png', 'Armoire à chaussures en bois 3'),
(105, 'images/300x300-5c4a1765f2d9de4284c74fff9a8836e1.png', 'Armoire de bureau en métal 3'),
(106, 'images/300x300-524e43d8462d99aed64b9112f6e9021e.png', 'Armoire de bureau en métal 2'),
(107, 'images/300x300-ce65a20c6797f10b2e149b8826887fb3.png', 'Armoire de rangement en bois 2'),
(108, 'images/300x300-e132a2371d799d2b38c4ff57d313ff1f.png', 'Armoire de rangement en bois 3'),
(109, 'images/300x300-dab7ee3b04de3303b2e0761cb22e8643.png', 'Armoire-penderie avec miroir 3'),
(110, 'images/300x300-c94ac8ff6974fa8d2ed34e6c81201750.png', 'Armoire-penderie avec miroir 2'),
(111, 'images/300x300-bc4e897c0b4af1c4be73562a83f2d5b2.png', "Bibliothèque d\'angle en métal 2"),
(112, 'images/300x300-8bb94ac02368eb8465fc4de3b22f9420.png', "Bibliothèque d\'angle en métal 3"),
(113, 'images/300x300-fd83796d38d92edd460d5eabc4f20f64.png', 'Bibliothèque encastrée 2'),
(114, 'images/300x300-a1ea18bebbdc67fba34703e481496c60.png', 'Bibliothèque encastrée 3'),
(115, 'images/300x300-66c81811564eeb33ccd390860829b52e.png', 'Bibliothèque moderne à étagères 3'),
(116, 'images/300x300-722388a6860ab4ab209cb90342b1028e.png', 'Bibliothèque moderne à étagères 2'),
(117, 'images/300x300-f89080a1b85c8f6967b2ff12c8f47c0a.png', 'Bibliothèque murale en bois 3'),
(118, 'images/300x300-d74452e76f34c7c31d06159b22244b50.png', 'Bibliothèque murale en bois 2'),
(119, 'images/300x300-c37c63272cdf7567f46dd9335e4e0091.png', 'Bibliothèque industrielle à roulettes 2'),
(120, 'images/300x300-e452282c9db06904b831e672c70a91e9.png', 'Bibliothèque industrielle à roulettes 3'),
(121, 'images/300x300-e910c12815e07041918d880e82abcbb3.png', 'Commode à langer pour bébé 2'),
(122, 'images/300x300-ebd6e80b67e925af618871d4fff5ce47.png', 'Commode à langer pour bébé 3'),
(123, 'images/300x300-e466fbaef49eec6d23fa239e47df0311.png', 'Commode à tiroirs en métal 2'),
(124, 'images/300x300-1c9e15632a78db449ecafa25e9e3328e.png', 'Commode à tiroirs en métal 3'),
(125, 'images/300x300-805d28d04d4cbc36b6469443d1db6649.png', 'Commode avec paniers en osier 2'),
(126, 'images/300x300-bfcf307b8017e8dee1e0043b2f89ee72.png', 'Commode avec paniers en osier 3'),
(127, 'images/300x300-767d2b0f1ab216a5b70b5d06f24e88bb.png', 'Commode moderne à six tiroirs 2'),
(128, 'images/300x300-fc0dc33139aba8949b1829ad06d43398.png', 'Commode moderne à six tiroirs 3'),
(129, 'images/300x300-48e645283cf95795841ae9f6a42d9375.png', 'Commode vintage en bois 3'),
(130, 'images/300x300-8c4799f08ed7fe0b5dbe6565aa63e02f.png', 'Commode vintage en bois 2'),
(131, 'images/300x300-e8a7f6c2008b79faf51471c04c68ec67.png', 'Table basse avec plateau relevable 2'),
(132, 'images/300x300-8dc04e36624e466a6cedb1c3fd27c5f3.png', 'Table basse avec plateau relevable 3'),
(133, 'images/300x300-bb5812ed69faad29682e6d494d0836ba.png', 'Table basse carrée avec tiroirs 3'),
(134, 'images/300x300-b4745065d6668afeaa653311918a7fd6.png', 'Table basse carrée avec tiroirs 2'),
(135, 'images/300x300-847633780fd635852720154bf1491a10.png', 'Table basse en bois et métal 2'),
(136, 'images/300x300-ef012cd83447076533c2f616688ad875.png', 'Table basse en bois et métal 3'),
(137, 'images/300x300-1e4676d54839f3225571a0c256900c92.png', 'Table basse en marbre et laiton 2'),
(138, 'images/300x300-e8a81f5c79e89ca57322e0bb32c56e51.png', 'Table basse en marbre et laiton 3'),
(139, 'images/300x300-deab714697f0f6157a61e70b06fbdc0b.png', 'Table basse ovale en verre 2'),
(140, 'images/300x300-9723cb12a7b150354acc9ffbaa2074ad.png', 'Table basse ovale en verre 3'),
(141, 'images/300x300-304ca1c36e9c62d9abf1de562be1ec3c.png', 'Buffet contemporain à quatre portes 2'),
(142, 'images/300x300-99722b54cf2e5da500b0abedf1e5f2b9.png', 'Buffet contemporain à quatre portes 3'),
(143, 'images/300x300-57e9d72a5b89f9603ec9c7322eeb01c8.png', 'Buffet en bois massif 2'),
(144, 'images/300x300-c00e895e9c15d8f08f7877aa06deba72.png', 'Buffet en bois massif 3'),
(145, 'images/300x300-67c1792bb7c8bc04f2148cd9d0501711.png', 'Buffet haut moderne 2'),
(146, 'images/300x300-b26d68e1145cd4e6748d09438ab90251.png', 'Buffet haut moderne 3'),
(147, 'images/300x300-d949855056bf6a5ebded909f7d1c98ce.png', 'Buffet industriel en métal 2'),
(148, 'images/300x300-d3f2c22397e098535eb64bf750cf8534.png', 'Buffet industriel en métal 3'),
(149, 'images/300x300-b1e957ed5d8248f9642dbeac6282c179.png', 'Buffet scandinave avec pieds compas 3'),
(150, 'images/300x300-0fdb1c3c3aa9665b683c48b5ec23724a.png', 'Buffet scandinave avec pieds compas 2'),
(151, 'images/300x300-249935a9178934fffa19507cdf3e4fce.png', 'Fauteuil à bascule scandinave 2'),
(152, 'images/300x300-704df75e2f568dce3fcc9c4706947078.png', 'Fauteuil à bascule scandinave 3'),
(153, 'images/300x300-637080aeffaf5d4459c00410f20ee233.png', 'Fauteuil bergère rembourré 2'),
(154, 'images/300x300-49a19cedc76a53bb5f73e4e46cdda202.png', 'Fauteuil bergère rembourré 3'),
(155, 'images/300x300-e2a6229703c54f6cd2cba564b44c3907.png', 'Fauteuil club en cuir vieilli 2'),
(156, 'images/300x300-f9ed4afeae748c84a84b69c0b4c9edf5.png', 'Fauteuil club en cuir vieilli 3'),
(157, 'images/300x300-dd0a952c34af639129e2f18d1c2b7a3c.png', 'Fauteuil en rotin avec coussin 2'),
(158, 'images/300x300-4af20f7760cbede0153cb1bada779653.png', 'Fauteuil en rotin avec coussin 3'),
(159, 'images/300x300-be5fa805368fe838851c863b85c3f24f.png', 'Fauteuil pivotant en tissu 3'),
(160, 'images/300x300-06be7ea5a4ad1c7ca7dbcbf27ed39bf4.png', 'Fauteuil pivotant en tissu 2'),
(161, 'images/300x300-0cdb20204c107c751375f8a9f5487e45.png', 'Slide 1'),
(162, 'images/300x300-f4eb641148ee43e5b77769da7ceb4c29.png', 'Slide 2'),
(163, 'images/300x300-2888a318d762dca5c6a640e73ec176ca.png', 'Slide 3');

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
  `id_image` int NOT NULL,
  `id_produit` int NOT NULL,
  PRIMARY KEY (`id_image_produit`),
  KEY `IDX_BCB5BBFB2BB8456F` (`id_image`),
  KEY `IDX_BCB5BBFBF7384557` (`id_produit`)
) ENGINE=InnoDB AUTO_INCREMENT=152 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Déchargement des données de la table `image_produit`
--

INSERT INTO `image_produit` (`id_image_produit`, `id_image`, `id_produit`) VALUES
(1, 4, 6),
(2, 6, 7),
(3, 11, 9),
(4, 10, 10),
(5, 8, 8),
(6, 16, 5),
(7, 14, 1),
(8, 15, 4),
(9, 13, 3),
(10, 12, 2),
(11, 17, 15),
(12, 20, 14),
(13, 21, 13),
(14, 19, 11),
(15, 18, 12),
(16, 26, 19),
(17, 25, 17),
(18, 23, 18),
(19, 24, 20),
(20, 22, 16),
(21, 31, 23),
(22, 29, 22),
(23, 27, 25),
(24, 28, 24),
(25, 30, 21),
(26, 36, 27),
(27, 35, 26),
(28, 34, 30),
(29, 33, 29),
(30, 32, 28),
(31, 41, 31),
(32, 40, 32),
(33, 39, 33),
(34, 38, 35),
(35, 37, 34),
(36, 46, 37),
(37, 45, 39),
(38, 44, 38),
(39, 43, 40),
(40, 42, 36),
(41, 51, 44),
(42, 50, 43),
(43, 49, 42),
(44, 48, 45),
(45, 47, 41),
(46, 56, 48),
(47, 55, 49),
(48, 54, 46),
(49, 53, 47),
(50, 52, 50),
(51, 58, 1),
(52, 59, 1),
(53, 60, 2),
(54, 61, 2),
(55, 5, 51),
(56, 63, 3),
(57, 62, 3),
(58, 66, 4),
(59, 67, 4),
(60, 68, 5),
(61, 69, 5),
(62, 70, 6),
(63, 71, 6),
(64, 72, 10),
(65, 73, 10),
(66, 74, 8),
(67, 75, 8),
(68, 76, 7),
(69, 77, 7),
(70, 78, 9),
(71, 79, 9),
(72, 80, 51),
(73, 81, 51),
(74, 82, 11),
(75, 83, 11),
(76, 84, 12),
(77, 85, 12),
(78, 90, 13),
(79, 91, 13),
(80, 88, 14),
(81, 89, 14),
(82, 86, 15),
(83, 87, 15),
(84, 92, 16),
(85, 93, 16),
(86, 98, 17),
(87, 99, 17),
(88, 94, 18),
(89, 95, 18),
(90, 100, 19),
(91, 101, 19),
(92, 96, 20),
(93, 97, 20),
(94, 108, 21),
(95, 109, 21),
(96, 110, 22),
(97, 111, 22),
(98, 102, 23),
(99, 103, 23),
(100, 104, 24),
(101, 105, 24),
(102, 106, 25),
(103, 107, 25),
(104, 116, 26),
(105, 117, 26),
(106, 118, 27),
(107, 119, 27),
(108, 112, 28),
(109, 113, 28),
(110, 114, 29),
(111, 115, 29),
(112, 120, 30),
(113, 121, 30),
(114, 130, 31),
(115, 131, 31),
(116, 124, 32),
(117, 125, 32),
(118, 126, 33),
(119, 127, 33),
(120, 122, 34),
(121, 123, 34),
(122, 128, 35),
(123, 129, 35),
(124, 136, 36),
(125, 137, 36),
(126, 132, 37),
(127, 133, 37),
(128, 138, 38),
(129, 139, 38),
(130, 140, 39),
(131, 141, 39),
(132, 134, 40),
(133, 135, 40),
(134, 144, 41),
(135, 145, 41),
(136, 146, 42),
(137, 147, 42),
(138, 149, 43),
(139, 150, 43),
(140, 151, 44),
(141, 152, 44),
(142, 142, 45),
(143, 143, 45),
(144, 157, 46),
(145, 158, 46),
(146, 155, 47),
(147, 156, 47),
(148, 159, 48),
(149, 160, 48),
(150, 153, 50),
(151, 154, 50);

-- --------------------------------------------------------

--
-- Structure de la table `marques`
--

DROP TABLE IF EXISTS `marques`;
CREATE TABLE IF NOT EXISTS `marques` (
  `id` int NOT NULL AUTO_INCREMENT,
  `nom` varchar(50) COLLATE utf8mb4_unicode_ci NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=37 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

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
  `nom` varchar(50) COLLATE utf8mb4_unicode_ci NOT NULL,
  PRIMARY KEY (`id_materiel`)
) ENGINE=InnoDB AUTO_INCREMENT=12 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

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
-- Structure de la table `panier`
--

DROP TABLE IF EXISTS `panier`;
CREATE TABLE IF NOT EXISTS `panier` (
  `id_panier` int NOT NULL AUTO_INCREMENT,
  `client_id` int NOT NULL,
  `lots` json NOT NULL,
  `date_creation` datetime NOT NULL,
  `date_modification` datetime NOT NULL,
  `etat` varchar(20) COLLATE utf8mb4_unicode_ci NOT NULL,
  PRIMARY KEY (`id_panier`),
  KEY `IDX_24CC0DF219EB6921` (`client_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Structure de la table `payment_method`
--

DROP TABLE IF EXISTS `payment_method`;
CREATE TABLE IF NOT EXISTS `payment_method` (
  `id` int NOT NULL AUTO_INCREMENT,
  `client_id` int DEFAULT NULL,
  `stripe_payment_method_id` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `last4` varchar(4) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `brand` varchar(50) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `exp_month` int DEFAULT NULL,
  `exp_year` int DEFAULT NULL,
  `etat` tinyint(1) NOT NULL DEFAULT '0',
  PRIMARY KEY (`id`),
  KEY `IDX_7B61A1F619EB6921` (`client_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Structure de la table `produits`
--

DROP TABLE IF EXISTS `produits`;
CREATE TABLE IF NOT EXISTS `produits` (
  `id_produit` int NOT NULL AUTO_INCREMENT,
  `marque` int DEFAULT NULL,
  `categorie` int DEFAULT NULL,
  `materiaux` int DEFAULT NULL,
  `reference` varchar(15) COLLATE utf8mb4_unicode_ci NOT NULL,
  `nom` varchar(100) COLLATE utf8mb4_unicode_ci NOT NULL,
  `prix` double NOT NULL,
  `description` longtext COLLATE utf8mb4_unicode_ci NOT NULL,
  `quantite` int NOT NULL,
  `date_creation` datetime NOT NULL,
  PRIMARY KEY (`id_produit`),
  KEY `IDX_BE2DDF8C5A6F91CE` (`marque`),
  KEY `IDX_BE2DDF8C497DD634` (`categorie`),
  KEY `IDX_BE2DDF8C97C56625` (`materiaux`)
) ENGINE=InnoDB AUTO_INCREMENT=52 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Déchargement des données de la table `produits`
--

INSERT INTO `produits` (`id_produit`, `marque`, `categorie`, `materiaux`, `reference`, `nom`, `prix`, `description`, `quantite`, `date_creation`) VALUES
(1, 1, 1, 4, 'CAN1234', 'Canapé en cuir noir', 799.99, 'Canapé spacieux en cuir noir de haute qualité.', 20, '2024-04-13 00:00:00'),
(2, 2, 1, 11, 'CAN2345', 'Canapé d\'angle gris', 899.99, 'Canapé d\'angle moderne en tissu gris avec accoudoirs ajustables.', 15, '2024-04-13 00:00:00'),
(3, 3, 1, 5, 'CAN3456', 'Canapé convertible en tissu', 649.99, 'Canapé convertible pratique en tissu avec un mécanisme facile à utiliser.', 25, '2024-04-13 00:00:00'),
(4, 4, 1, 4, 'CAN4567', 'Canapé en cuir marron', 899.99, 'Canapé en cuir véritable de couleur marron avec des coutures décoratives.', 18, '2024-04-13 00:00:00'),
(5, 5, 1, 5, 'CAN5678', 'Canapé modulaire en tissu', 999.99, 'Canapé modulaire en tissu avec des modules interchangeables pour une configuration personnalisée.', 12, '2024-04-13 00:00:00'),
(6, 6, 2, 1, 'TAB1234', 'Table à manger en bois massif', 349.99, 'Table à manger robuste en bois massif avec une finition naturelle.', 15, '2024-04-13 00:00:00'),
(7, 7, 2, 8, 'TAB2345', 'Table basse rectangulaire', 199.99, 'Table basse rectangulaire avec un plateau en verre trempé et des pieds en métal.', 20, '2024-04-13 00:00:00'),
(8, 8, 2, 8, 'TAB3456', 'Table de cuisine ronde', 249.99, 'Table de cuisine ronde en bois avec un design moderne et des pieds en métal.', 18, '2024-04-13 00:00:00'),
(9, 9, 2, 7, 'TAB4567', "Table d\'appoint en marbre", 159.99, "Table d\'appoint élégante avec un plateau en marbre blanc et une base en métal doré.", 22, '2024-04-13 00:00:00'),
(10, 10, 2, 8, 'TAB5678', 'Table console extensible', 499.99, "Table console extensible en bois avec une conception intelligente pour économiser de l\'espace.", 10, '2024-04-13 00:00:00'),
(11, 11, 3, 1, 'CHA1234', 'Chaise de salle à manger en bois', 79.99, 'Chaise de salle à manger en bois avec un design simple et une assise confortable.', 30, '2024-04-13 00:00:00'),
(12, 12, 3, 2, 'CHA2345', 'Chaise de bureau ergonomique', 129.99, 'Chaise de bureau ergonomique avec un support lombaire réglable et des accoudoirs rembourrés.', 25, '2024-04-13 00:00:00'),
(13, 13, 3, 2, 'CHA3456', 'Chaise pliante en métal', 49.99, 'Chaise pliante pratique en métal avec une assise en plastique résistant.', 40, '2024-04-13 00:00:00'),
(14, 14, 3, 8, 'CHA4567', 'Chaise longue moderne', 299.99, 'Chaise longue moderne en tissu avec un design élégant et un dossier réglable.', 15, '2024-04-13 00:00:00'),
(15, 15, 3, 4, 'CHA5678', 'Chaise de bar en cuir', 149.99, 'Chaise de bar confortable avec un siège rembourré en cuir et une base pivotante.', 20, '2024-04-13 00:00:00'),
(16, 16, 4, 5, 'LIT1234', 'Lit double avec tête de lit rembourrée', 899.99, 'Lit double confortable avec une tête de lit rembourrée pour un soutien supplémentaire.', 10, '2024-04-13 00:00:00'),
(17, 17, 4, 2, 'LIT2345', 'Lit simple en métal', 199.99, 'Lit simple robuste en métal avec une finition noire classique.', 20, '2024-04-13 00:00:00'),
(18, 18, 4, 1, 'LIT3456', 'Lit gigogne en bois', 499.99, 'Lit gigogne en bois avec un tiroir supplémentaire pour un espace de rangement pratique.', 15, '2024-04-13 00:00:00'),
(19, 19, 4, 2, 'LIT4567', 'Lit superposé en métal', 399.99, 'Lit superposé en métal avec des barrières de sécurité et des échelles intégrées.', 8, '2024-04-13 00:00:00'),
(20, 20, 4, 6, 'LIT5678', 'Lit king-size avec matelas orthopédique', 1499.99, 'Lit king-size avec un matelas orthopédique de luxe pour un confort optimal.', 12, '2024-04-13 00:00:00'),
(21, 21, 5, 1, 'ARM1234', 'Armoire de rangement en bois', 549.99, 'Grande armoire de rangement en bois avec plusieurs étagères et tiroirs.', 8, '2024-04-13 00:00:00'),
(22, 22, 5, 1, 'ARM2345', 'Armoire-penderie avec miroir', 699.99, 'Armoire-penderie spacieuse avec un miroir pleine longueur et des portes coulissantes.', 12, '2024-04-13 00:00:00'),
(23, 23, 5, 1, 'ARM3456', 'Armoire à bijoux sur pied', 179.99, 'Armoire à bijoux sur pied avec un miroir intégré et des compartiments pour ranger vos accessoires.', 15, '2024-04-13 00:00:00'),
(24, 24, 5, 1, 'ARM4567', 'Armoire à chaussures en bois', 129.99, 'Armoire à chaussures en bois avec des étagères réglables pour organiser vos chaussures.', 20, '2024-04-13 00:00:00'),
(25, 25, 5, 2, 'ARM5678', 'Armoire de bureau en métal', 299.99, 'Armoire de bureau en métal avec des portes verrouillables pour sécuriser vos documents.', 10, '2024-04-13 00:00:00'),
(26, 26, 6, 8, 'BIB1234', 'Bibliothèque moderne à étagères', 299.99, 'Bibliothèque élégante avec des étagères réglables pour organiser vos livres et décorations.', 12, '2024-04-13 00:00:00'),
(27, 27, 6, 1, 'BIB2345', 'Bibliothèque murale en bois', 399.99, 'Bibliothèque murale en bois avec des étagères flottantes pour un look moderne.', 8, '2024-04-13 00:00:00'),
(28, 28, 6, 2, 'BIB3456', "Bibliothèque d\'angle en métal", 249.99, "Bibliothèque d\'angle en métal avec des étagères en verre pour un design contemporain.", 10, '2024-04-13 00:00:00'),
(29, 29, 6, 10, 'BIB4567', 'Bibliothèque encastrée', 599.99, 'Bibliothèque encastrée sur mesure avec des étagères intégrées pour un rangement élégant.', 6, '2024-04-13 00:00:00'),
(30, 30, 6, 10, 'BIB5678', 'Bibliothèque industrielle à roulettes', 349.99, 'Bibliothèque industrielle avec des étagères en bois et une structure en métal robuste.', 15, '2024-04-13 00:00:00'),
(31, 31, 7, 1, 'COM1234', 'Commode vintage en bois', 199.99, 'Commode vintage en bois avec des tiroirs spacieux pour le rangement.', 18, '2024-04-13 00:00:00'),
(32, 32, 7, 2, 'COM2345', 'Commode à tiroirs en métal', 149.99, 'Commode à tiroirs en métal avec des poignées en cuir pour un look industriel.', 15, '2024-04-13 00:00:00'),
(33, 33, 7, 9, 'COM3456', 'Commode avec paniers en osier', 129.99, 'Commode pratique avec des paniers en osier tressé pour un rangement naturel.', 20, '2024-04-13 00:00:00'),
(34, 34, 7, 8, 'COM4567', 'Commode à langer pour bébé', 299.99, 'Commode à langer pour bébé avec des tiroirs de rangement et un espace pour changer bébé.', 10, '2024-04-13 00:00:00'),
(35, 35, 7, 1, 'COM5678', 'Commode moderne à six tiroirs', 249.99, 'Commode moderne à six tiroirs avec des poignées encastrées pour un look épuré.', 12, '2024-04-13 00:00:00'),
(36, 1, 8, 2, 'TAB1234', 'Table basse en bois et métal', 129.99, 'Table basse en bois et métal avec une étagère inférieure pour le rangement.', 25, '2024-04-13 00:00:00'),
(37, 2, 8, 8, 'TAB2345', 'Table basse avec plateau relevable', 179.99, 'Table basse avec un plateau relevable pour transformer en table à manger occasionnelle.', 18, '2024-04-13 00:00:00'),
(38, 3, 8, 10, 'TAB3456', 'Table basse en marbre et laiton', 349.99, 'Table basse en marbre blanc et laiton doré avec un design luxueux.', 8, '2024-04-13 00:00:00'),
(39, 4, 8, 3, 'TAB4567', 'Table basse ovale en verre', 299.99, 'Table basse ovale en verre trempé avec une base en acier inoxydable pour une touche moderne.', 12, '2024-04-13 00:00:00'),
(40, 5, 8, 2, 'TAB5678', 'Table basse carrée avec tiroirs', 249.99, 'Table basse carrée avec des tiroirs de rangement et une finition en bois naturel.', 15, '2024-04-13 00:00:00'),
(41, 6, 9, 1, 'BUF1234', 'Buffet en bois massif', 499.99, 'Buffet en bois massif avec des portes coulissantes et des étagères réglables.', 14, '2024-04-13 00:00:00'),
(42, 7, 9, 7, 'BUF2345', 'Buffet haut moderne', 399.99, 'Buffet haut moderne avec des façades laquées et des poignées encastrées pour un look épuré.', 10, '2024-04-13 00:00:00'),
(43, 8, 9, 2, 'BUF3456', 'Buffet industriel en métal', 349.99, 'Buffet industriel en métal avec des portes grillagées et une finition vieillie pour un look vintage.', 12, '2024-04-13 00:00:00'),
(44, 9, 9, NULL, 'BUF4567', 'Buffet scandinave avec pieds compas', 449.99, 'Buffet scandinave avec des pieds compas et des poignées en laiton pour une ambiance rétro.', 8, '2024-04-13 00:00:00'),
(45, 10, 9, 11, 'BUF5678', 'Buffet contemporain à quatre portes', 599.99, 'Buffet contemporain avec quatre portes et des étagères intérieures pour un rangement organisé.', 6, '2024-04-13 00:00:00'),
(46, 11, 10, 4, 'FAU1234', 'Fauteuil club en cuir vieilli', 599.99, 'Fauteuil club en cuir vieilli avec un dossier incliné pour un confort optimal.', 22, '2024-04-13 00:00:00'),
(47, 12, 10, 5, 'FAU2345', 'Fauteuil bergère rembourré', 399.99, "Fauteuil bergère rembourré avec des accoudoirs sculptés et un coussin d\'assise moelleux.", 18, '2024-04-13 00:00:00'),
(48, 13, 10, 4, 'FAU3456', 'Fauteuil en rotin avec coussin', 249.99, "Fauteuil en rotin avec un coussin d\'assise rembourré pour un confort décontracté.", 25, '2024-04-13 00:00:00'),
(49, 14, 10, 5, 'FAU4567', 'Fauteuil pivotant en tissu', 299.99, 'Fauteuil pivotant en tissu avec une base en métal chromé pour une rotation à 360 degrés.', 20, '2024-04-13 00:00:00'),
(50, 15, 10, 7, 'FAU5678', 'Fauteuil à bascule scandinave', 349.99, 'Fauteuil à bascule scandinave avec une assise rembourrée et des pieds en bois massif.', 15, '2024-04-13 00:00:00'),
(51, 6, 2, 1, 'TAB28173', 'Table à manger en bois', 499.99, "Table en bois massif avec d\'élégante finissions.", 30, '2024-05-03 00:00:00');

--
-- Contraintes pour les tables déchargées
--

--
-- Contraintes pour la table `carrousel_images`
--
ALTER TABLE `carrousel_images`
  ADD CONSTRAINT `FK_B6396D71AA511C9` FOREIGN KEY (`carrousel_id`) REFERENCES `carrousel` (`id`),
  ADD CONSTRAINT `FK_B6396D73DA5256D` FOREIGN KEY (`image_id`) REFERENCES `image` (`id_image`);

--
-- Contraintes pour la table `client_adresse`
--
ALTER TABLE `client_adresse`
  ADD CONSTRAINT `FK_91624C6B19EB6921` FOREIGN KEY (`client_id`) REFERENCES `client` (`id_client`),
  ADD CONSTRAINT `FK_91624C6B4DE7DC5C` FOREIGN KEY (`adresse_id`) REFERENCES `adresses` (`id_adresse`);

--
-- Contraintes pour la table `commande`
--
ALTER TABLE `commande`
  ADD CONSTRAINT `FK_6EEAA67D1DC2A166` FOREIGN KEY (`id_adresse`) REFERENCES `adresses` (`id_adresse`),
  ADD CONSTRAINT `FK_6EEAA67D2FBB81F` FOREIGN KEY (`id_panier`) REFERENCES `panier` (`id_panier`),
  ADD CONSTRAINT `FK_6EEAA67D46071CF0` FOREIGN KEY (`id_payment_method`) REFERENCES `payment_method` (`id`),
  ADD CONSTRAINT `FK_6EEAA67DE173B1B8` FOREIGN KEY (`id_client`) REFERENCES `client` (`id_client`);

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
  ADD CONSTRAINT `FK_BCB5BBFB2BB8456F` FOREIGN KEY (`id_image`) REFERENCES `image` (`id_image`),
  ADD CONSTRAINT `FK_BCB5BBFBF7384557` FOREIGN KEY (`id_produit`) REFERENCES `produits` (`id_produit`);

--
-- Contraintes pour la table `panier`
--
ALTER TABLE `panier`
  ADD CONSTRAINT `FK_24CC0DF219EB6921` FOREIGN KEY (`client_id`) REFERENCES `client` (`id_client`);

--
-- Contraintes pour la table `payment_method`
--
ALTER TABLE `payment_method`
  ADD CONSTRAINT `FK_7B61A1F619EB6921` FOREIGN KEY (`client_id`) REFERENCES `client` (`id_client`);

--
-- Contraintes pour la table `produits`
--
ALTER TABLE `produits`
  ADD CONSTRAINT `FK_BE2DDF8C497DD634` FOREIGN KEY (`categorie`) REFERENCES `categories` (`id_categorie`),
  ADD CONSTRAINT `FK_BE2DDF8C5A6F91CE` FOREIGN KEY (`marque`) REFERENCES `marques` (`id`),
  ADD CONSTRAINT `FK_BE2DDF8C97C56625` FOREIGN KEY (`materiaux`) REFERENCES `materiaux` (`id_materiel`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
