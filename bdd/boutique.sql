-- phpMyAdmin SQL Dump
-- version 4.9.2
-- https://www.phpmyadmin.net/
--
-- Hôte : 127.0.0.1:3306
-- Généré le :  mer. 15 avr. 2020 à 04:32
-- Version du serveur :  10.4.10-MariaDB
-- Version de PHP :  7.3.12

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Base de données :  `boutique`
--
CREATE DATABASE IF NOT EXISTS `boutique` DEFAULT CHARACTER SET latin1 COLLATE latin1_swedish_ci;
USE `boutique`;

-- --------------------------------------------------------

--
-- Structure de la table `achats`
--

DROP TABLE IF EXISTS `achats`;
CREATE TABLE IF NOT EXISTS `achats` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `id_utilisateurs` int(11) NOT NULL,
  `prix` int(11) NOT NULL,
  `date_achat` datetime NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=6 DEFAULT CHARSET=utf8;

--
-- Déchargement des données de la table `achats`
--

INSERT INTO `achats` (`id`, `id_utilisateurs`, `prix`, `date_achat`) VALUES
(2, 3, 100, '2020-03-29 07:00:00'),
(3, 2, 100, '2020-03-29 18:00:00'),
(5, 1, 50, '2020-04-15 06:17:20');

-- --------------------------------------------------------

--
-- Structure de la table `avis`
--

DROP TABLE IF EXISTS `avis`;
CREATE TABLE IF NOT EXISTS `avis` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `id_produits` int(11) NOT NULL,
  `id_utilisateurs` int(11) NOT NULL,
  `note` int(11) NOT NULL,
  `commentaire` varchar(255) CHARACTER SET utf8 NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=10 DEFAULT CHARSET=latin1;

--
-- Déchargement des données de la table `avis`
--

INSERT INTO `avis` (`id`, `id_produits`, `id_utilisateurs`, `note`, `commentaire`) VALUES
(1, 17, 1, 2, 'Je ne recommande pas'),
(2, 20, 2, 5, 'RAS'),
(3, 18, 2, 4, 'Super produit !'),
(4, 21, 3, 4, 'Très bon produit'),
(5, 16, 3, 5, 'Super produit, je recommande vivement'),
(6, 19, 1, 5, 'J\'adore ce produit'),
(7, 22, 1, 4, 'Satisfaite'),
(8, 23, 1, 3, 'Bof bof'),
(9, 22, 1, 3, 'bon');

-- --------------------------------------------------------

--
-- Structure de la table `categories`
--

DROP TABLE IF EXISTS `categories`;
CREATE TABLE IF NOT EXISTS `categories` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `nom` varchar(255) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=10 DEFAULT CHARSET=utf8;

--
-- Déchargement des données de la table `categories`
--

INSERT INTO `categories` (`id`, `nom`) VALUES
(1, 'mariage'),
(2, 'anniversaire'),
(3, 'autre');

-- --------------------------------------------------------

--
-- Structure de la table `categories_produits`
--

DROP TABLE IF EXISTS `categories_produits`;
CREATE TABLE IF NOT EXISTS `categories_produits` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `id_produits` int(11) NOT NULL,
  `id_categories` int(11) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=34 DEFAULT CHARSET=utf8;

--
-- Déchargement des données de la table `categories_produits`
--

INSERT INTO `categories_produits` (`id`, `id_produits`, `id_categories`) VALUES
(8, 16, 3),
(10, 18, 2),
(9, 17, 2),
(11, 19, 1),
(12, 20, 3),
(13, 21, 3),
(14, 22, 3),
(15, 32, 2),
(16, 42, 1),
(17, 43, 1),
(18, 44, 1),
(19, 45, 1),
(20, 50, 1),
(21, 51, 1),
(22, 57, 1),
(23, 58, 2),
(24, 59, 1),
(25, 62, 1),
(26, 63, 1),
(27, 64, 1),
(28, 72, 1),
(29, 23, 2),
(30, 73, 1),
(31, 74, 1),
(32, 75, 1),
(33, 76, 2);

-- --------------------------------------------------------

--
-- Structure de la table `panier`
--

DROP TABLE IF EXISTS `panier`;
CREATE TABLE IF NOT EXISTS `panier` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `id_produits` int(11) NOT NULL,
  `id_achats` int(11) NOT NULL,
  `quantite` int(11) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=9 DEFAULT CHARSET=utf8;

--
-- Déchargement des données de la table `panier`
--

INSERT INTO `panier` (`id`, `id_produits`, `id_achats`, `quantite`) VALUES
(1, 23, 1, 7),
(2, 19, 2, 1),
(3, 17, 2, 1),
(4, 16, 3, 2),
(5, 18, 3, 2),
(6, 22, 2, 1),
(7, 20, 4, 5),
(8, 22, 5, 2);

-- --------------------------------------------------------

--
-- Structure de la table `panier_temp`
--

DROP TABLE IF EXISTS `panier_temp`;
CREATE TABLE IF NOT EXISTS `panier_temp` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `id_produits` int(11) NOT NULL,
  `nom_produit` varchar(255) NOT NULL,
  `id_utilisateur` int(11) NOT NULL,
  `prix` int(11) NOT NULL,
  `stock` int(11) NOT NULL,
  `quantite` int(11) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=10 DEFAULT CHARSET=latin1;

--
-- Déchargement des données de la table `panier_temp`
--

INSERT INTO `panier_temp` (`id`, `id_produits`, `nom_produit`, `id_utilisateur`, `prix`, `stock`, `quantite`) VALUES
(9, 15, 'produit3', 1, 2, 10, 3),
(8, 14, 'produit1', 1, 10, 5, 3);

-- --------------------------------------------------------

--
-- Structure de la table `produits`
--

DROP TABLE IF EXISTS `produits`;
CREATE TABLE IF NOT EXISTS `produits` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `nom` varchar(255) NOT NULL,
  `description` varchar(1000) NOT NULL,
  `prix` int(11) NOT NULL,
  `stock` int(11) NOT NULL,
  `image` varchar(255) NOT NULL DEFAULT 'img/logo.png',
  `note` float DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=77 DEFAULT CHARSET=utf8;

--
-- Déchargement des données de la table `produits`
--

INSERT INTO `produits` (`id`, `nom`, `description`, `prix`, `stock`, `image`, `note`) VALUES
(16, 'Fraisier de Mimi', 'Fait avec de l\'amour et des fraises !', 25, 5, 'img/produit/16.jpg', NULL),
(17, 'Ourson', 'GÃ¢teau d\'anniversaire fourrÃ© au chocolat et Ã  l\'abricot.', 25, 5, 'img/produit/17.jpg', NULL),
(18, 'Surprise Fraise', 'Mousse fraise avec coulis au chocolat noir par dessus!', 25, 5, 'img/produit/18.jpg', NULL),
(19, 'Mariage Ã  la rose', 'GÃ¢teau de mariage, arÃ´me de rose.', 50, 5, 'img/produit/19.jpg', NULL),
(20, 'Charlotte Fraise', 'Charlotte fraise avec zeste de citron.', 20, 5, 'img/produit/20.jpg', NULL),
(21, 'Citron Meringue', 'Tarte citron meringuÃ©e.', 25, 5, 'img/produit/21.jpg', NULL),
(22, 'Love chocolat', 'Mousse de chocolat blanc avec coulis fraise.', 25, 5, 'img/produit/22.jpg', 3.5),
(23, 'Duo chocolat', 'Praline & chocolat noir (avec Ã©clat de noisettes)', 25, 5, 'img/produit/23.jpg', NULL);

-- --------------------------------------------------------

--
-- Structure de la table `roles`
--

DROP TABLE IF EXISTS `roles`;
CREATE TABLE IF NOT EXISTS `roles` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `role` varchar(100) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=4 DEFAULT CHARSET=latin1;

--
-- Déchargement des données de la table `roles`
--

INSERT INTO `roles` (`id`, `role`) VALUES
(1, 'admin'),
(2, 'client'),
(3, 'random');

-- --------------------------------------------------------

--
-- Structure de la table `sous_categories`
--

DROP TABLE IF EXISTS `sous_categories`;
CREATE TABLE IF NOT EXISTS `sous_categories` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `nom` varchar(255) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=10 DEFAULT CHARSET=utf8;

--
-- Déchargement des données de la table `sous_categories`
--

INSERT INTO `sous_categories` (`id`, `nom`) VALUES
(1, 'chocolat'),
(2, 'fruit'),
(3, 'autre');

-- --------------------------------------------------------

--
-- Structure de la table `sous_categories_produits`
--

DROP TABLE IF EXISTS `sous_categories_produits`;
CREATE TABLE IF NOT EXISTS `sous_categories_produits` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `id_produits` int(11) NOT NULL,
  `id_sous_categories` int(11) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=18 DEFAULT CHARSET=utf8;

--
-- Déchargement des données de la table `sous_categories_produits`
--

INSERT INTO `sous_categories_produits` (`id`, `id_produits`, `id_sous_categories`) VALUES
(1, 16, 1),
(4, 17, 3),
(6, 18, 1),
(8, 19, 3),
(9, 20, 2),
(10, 21, 2),
(11, 22, 1),
(17, 76, 2),
(13, 23, 3),
(15, 44, 3),
(16, 75, 1);

-- --------------------------------------------------------

--
-- Structure de la table `utilisateurs`
--

DROP TABLE IF EXISTS `utilisateurs`;
CREATE TABLE IF NOT EXISTS `utilisateurs` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `login` varchar(255) NOT NULL,
  `mdp` varchar(255) NOT NULL,
  `mail` varchar(40) NOT NULL,
  `role` varchar(30) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=4 DEFAULT CHARSET=utf8;

--
-- Déchargement des données de la table `utilisateurs`
--

INSERT INTO `utilisateurs` (`id`, `login`, `mdp`, `mail`, `role`) VALUES
(1, 'nana', '$2y$05$TnqzaQt38Xz6fscyPu9wfO/4G/WfBC5PosxbR9MHqpfC2YQMdEIF2', 'nana@gmail.com', 'admin'),
(2, 'azerty', '$2y$05$7EB1gsYT/qFpu0lkBORP1OxhOVGPhmZi2f415q0i13DrPzC3P6Qv6', 'azerty@sfr.fr', 'admin'),
(3, 'toto', '$2y$05$wAq6m4ExwusS6lSUSALh8ucU5VFtsva7F1ah2v8a9omQUEBf.vT7m', 'toto@orange.fr', 'membre');
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
