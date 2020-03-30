-- phpMyAdmin SQL Dump
-- version 4.8.5
-- https://www.phpmyadmin.net/
--
-- Hôte : 127.0.0.1:3306
-- Généré le :  lun. 30 mars 2020 à 12:45
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
) ENGINE=MyISAM AUTO_INCREMENT=4 DEFAULT CHARSET=utf8;

--
-- Déchargement des données de la table `achats`
--

INSERT INTO `achats` (`id`, `id_utilisateurs`, `prix`, `date_achat`) VALUES
(1, 1, 3, '2020-03-24 11:00:00'),
(2, 3, 2, '2020-03-29 07:00:00'),
(3, 2, 4, '2020-03-29 18:00:00');

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
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Structure de la table `categories`
--

DROP TABLE IF EXISTS `categories`;
CREATE TABLE IF NOT EXISTS `categories` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `nom` varchar(255) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=7 DEFAULT CHARSET=utf8;

--
-- Déchargement des données de la table `categories`
--

INSERT INTO `categories` (`id`, `nom`) VALUES
(1, 'mariage'),
(2, 'anniversaire'),
(3, 'autre'),
(6, 'pouik');

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
) ENGINE=MyISAM AUTO_INCREMENT=4 DEFAULT CHARSET=utf8;

--
-- Déchargement des données de la table `categories_produits`
--

INSERT INTO `categories_produits` (`id`, `id_produits`, `id_categories`) VALUES
(1, 13, 1),
(2, 14, 1),
(3, 15, 1);

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
) ENGINE=MyISAM AUTO_INCREMENT=6 DEFAULT CHARSET=utf8;

--
-- Déchargement des données de la table `panier`
--

INSERT INTO `panier` (`id`, `id_produits`, `id_achats`, `quantite`) VALUES
(1, 13, 1, 3),
(2, 15, 2, 1),
(3, 14, 2, 1),
(4, 14, 3, 2),
(5, 15, 3, 2);

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
  `note` int(11) NOT NULL DEFAULT '5',
  `categorie` varchar(255) NOT NULL,
  `sous_cat` varchar(255) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=16 DEFAULT CHARSET=utf8;

--
-- Déchargement des données de la table `produits`
--

INSERT INTO `produits` (`id`, `nom`, `description`, `prix`, `stock`, `image`, `note`, `categorie`, `sous_cat`) VALUES
(13, 'produit6', 'produit1', 1, 1, 'img/produit/13.jpg', 5, 'Mariage', 'Chocolat'),
(14, 'produit2', 'produit2', 1, 1, 'img/logo.png', 5, 'Mariage', 'Chocolat'),
(15, 'produit3', 'produit3', 1, 1, 'img/logo.png', 5, 'Mariage', 'Chocolat');

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
(3, 'les-deux', 1),
(4, 'chocolat', 2),
(5, 'fruit', 2),
(6, 'les-deux', 2),
(7, 'chocolat', 3),
(8, 'fruit', 3),
(9, 'les-deux', 3);

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
(1, 13, 1),
(2, 14, 1),
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
