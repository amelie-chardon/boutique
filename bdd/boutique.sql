-- phpMyAdmin SQL Dump
-- version 4.9.2
-- https://www.phpmyadmin.net/
--
-- Hôte : 127.0.0.1:3306
-- Généré le :  ven. 10 avr. 2020 à 13:22
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
) ENGINE=MyISAM AUTO_INCREMENT=5 DEFAULT CHARSET=utf8;

--
-- Déchargement des données de la table `achats`
--

INSERT INTO `achats` (`id`, `id_utilisateurs`, `prix`, `date_achat`) VALUES
(1, 1, 3, '2020-03-24 11:00:00'),
(2, 3, 3, '2020-03-29 07:00:00'),
(3, 2, 4, '2020-03-29 18:00:00'),
(4, 1, 50, '2020-04-06 19:22:08');

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
(1, 15, 1, 2, 'je ne recommande pas'),
(2, 15, 2, 5, 'RAS'),
(3, 14, 2, 4, 'super produit !'),
(4, 13, 3, 4, 'trÃ¨s bon'),
(5, 13, 3, 5, 'super produit, je recommande vivement'),
(6, 13, 1, 5, 'ddd'),
(7, 15, 1, 4, 'Satisfaite'),
(8, 14, 1, 3, 'pouik');

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
) ENGINE=MyISAM AUTO_INCREMENT=6 DEFAULT CHARSET=utf8;

--
-- Déchargement des données de la table `categories_produits`
--

INSERT INTO `categories_produits` (`id`, `id_produits`, `id_categories`) VALUES
(2, 14, 3),
(3, 15, 1),
(4, 13, 3);

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
(1, 13, 1, 7),
(2, 15, 2, 1),
(3, 14, 2, 1),
(4, 14, 3, 2),
(5, 15, 3, 2),
(6, 13, 2, 1),
(7, 14, 4, 5);

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
  `description` text NOT NULL,
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
(14, 'produit', 'produit', 5, 1, 'img/produit/14.jpg', 3.5),
(16, 'Fraisier de Mimi', 'Fais avec de l\'amour et des fraises !', 25, 5, 'img/produit/16.jpg', NULL),
(17, 'Ourson ', 'Gâteau d\'anniversaire fourré au chocolat et à l\'abricot .', 25, 5, 'img/produit/17.jpg', NULL),
(18, 'Surprise Fraise', 'Mousse fraise avec coulis au chocolat noir par dessus!', 25, 5, 'img/produit/18.jpg', NULL),
(19, 'Mariage à la rose', 'Gateau de mariage , arome de rose .', 50, 5, 'img/produit/19.jpg', NULL),
(20, 'Charlotte Fraise', 'Charlotte fraise avec zeste de citron', 20, 5, 'img/produit/20.jpg', NULL),
(21, 'Citron Meringue', 'Tarte citron meringue', 25, 5, 'img/produit/21.jpg', NULL),
(22, 'Love chocolat', 'Mousse de chocolat blanc avec coulis fraise .', 25, 5, 'img/produit/22.jpg', NULL),
(23, 'Duo chocolat', 'Praline & chocolat noir ( avec éclat de noisette)', 25, 5, 'img/produit/23.jpg', NULL);

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
  `id_categories` int(11) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=10 DEFAULT CHARSET=utf8;

--
-- Déchargement des données de la table `sous_categories`
--

INSERT INTO `sous_categories` (`id`, `nom`, `id_categories`) VALUES
(1, 'chocolat', 1),
(2, 'fruit', 1),
(3, 'les-deux', 1);

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
) ENGINE=MyISAM AUTO_INCREMENT=4 DEFAULT CHARSET=utf8;

--
-- Déchargement des données de la table `sous_categories_produits`
--

INSERT INTO `sous_categories_produits` (`id`, `id_produits`, `id_sous_categories`) VALUES
(1, 3, 1),
(2, 14, 2),
(3, 15, 1);

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
