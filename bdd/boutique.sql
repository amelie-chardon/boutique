-- phpMyAdmin SQL Dump
-- version 4.8.5
-- https://www.phpmyadmin.net/
--
-- Hôte : 127.0.0.1:3306
-- Généré le :  ven. 10 avr. 2020 à 16:42
-- Version du serveur :  5.7.26
-- Version de PHP :  7.2.18

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
CREATE DATABASE IF NOT EXISTS `boutique` DEFAULT CHARACTER SET utf8 COLLATE utf8_general_ci;
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
) ENGINE=MyISAM AUTO_INCREMENT=5 DEFAULT CHARSET=utf8;

--
-- Déchargement des données de la table `achats`
--

INSERT INTO `achats` (`id`, `id_utilisateurs`, `prix`, `date_achat`) VALUES
(1, 1, 175, '2020-03-24 11:00:00'),
(2, 3, 100, '2020-03-29 07:00:00'),
(3, 2, 100, '2020-03-29 18:00:00'),
(4, 1, 100, '2020-04-06 19:22:08');

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
) ENGINE=MyISAM AUTO_INCREMENT=9 DEFAULT CHARSET=latin1;

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
(8, 23, 1, 3, 'Bof bof');

-- --------------------------------------------------------

--
-- Structure de la table `categories`
--

DROP TABLE IF EXISTS `categories`;
CREATE TABLE IF NOT EXISTS `categories` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `nom` varchar(255) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=9 DEFAULT CHARSET=utf8;

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
) ENGINE=MyISAM AUTO_INCREMENT=15 DEFAULT CHARSET=utf8;

--
-- Déchargement des données de la table `categories_produits`
--

INSERT INTO `categories_produits` (`id`, `id_produits`, `id_categories`) VALUES
(8, 16, 2),
(10, 18, 3),
(9, 17, 2),
(11, 19, 1),
(12, 20, 3),
(13, 21, 3),
(14, 22, 3);

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
) ENGINE=MyISAM AUTO_INCREMENT=8 DEFAULT CHARSET=utf8;

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
(7, 20, 4, 5);

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
) ENGINE=MyISAM AUTO_INCREMENT=25 DEFAULT CHARSET=utf8;

--
-- Déchargement des données de la table `produits`
--

INSERT INTO `produits` (`id`, `nom`, `description`, `prix`, `stock`, `image`, `note`) VALUES
(16, 'Fraisier de Mimi', 'Fait avec de l\'amour et des fraises !', 25, 5, 'img/produit/16.jpg', NULL),
(17, 'Ourson ', 'GÃ¢teau d\'anniversaire fourrÃ© au chocolat et Ã  l\'abricot.', 25, 5, 'img/produit/17.jpg', NULL),
(18, 'Surprise Fraise', 'Mousse fraise avec coulis au chocolat noir par dessus!', 25, 5, 'img/produit/18.jpg', NULL),
(19, 'Mariage Ã  la rose', 'GÃ¢teau de mariage, arÃ´me de rose.', 50, 5, 'img/produit/19.jpg', NULL),
(20, 'Charlotte Fraise', 'Charlotte fraise avec zeste de citron.', 20, 5, 'img/produit/20.jpg', NULL),
(21, 'Citron Meringue', 'Tarte citron meringuÃ©e.', 25, 5, 'img/produit/21.jpg', NULL),
(22, 'Love chocolat', 'Mousse de chocolat blanc avec coulis fraise.', 25, 5, 'img/produit/22.jpg', NULL),
(23, 'Duo chocolat', 'Praline & chocolat noir (avec Ã©clat de noisettes)', 25, 5, 'img/produit/23.jpg', NULL);

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
) ENGINE=MyISAM AUTO_INCREMENT=14 DEFAULT CHARSET=utf8;

--
-- Déchargement des données de la table `sous_categories_produits`
--

INSERT INTO `sous_categories_produits` (`id`, `id_produits`, `id_sous_categories`) VALUES
(5, 17, 2),
(1, 16, 2),
(4, 17, 1),
(6, 18, 1),
(7, 18, 2),
(8, 19, 3),
(9, 20, 2),
(10, 21, 2),
(11, 22, 1),
(12, 22, 2),
(13, 23, 3);

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
