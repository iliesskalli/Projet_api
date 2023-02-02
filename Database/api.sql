-- phpMyAdmin SQL Dump
-- version 5.1.1
-- https://www.phpmyadmin.net/ 
--
-- Hôte : 127.0.0.1:3306
-- Généré le : lun. 30 jan. 2023 à 19:22
-- Version du serveur : 5.7.36
-- Version de PHP : 7.4.26

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Base de données : `api`
--

-- --------------------------------------------------------

--
-- Structure de la table `categories`
--

DROP TABLE IF EXISTS `categories`;
CREATE TABLE IF NOT EXISTS `categories` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `nom` varchar(256) NOT NULL,
  `description` text NOT NULL,
  `date_creation` datetime NOT NULL,
  `date_maj` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=17 DEFAULT CHARSET=utf8;

--
-- Déchargement des données de la table `categories`
--

INSERT INTO `categories` (`id`, `nom`, `description`, `date_creation`, `date_maj`) VALUES
(1, 'Bricolage', 'test postman', '2023-01-03 00:32:07', '2019-01-03 15:34:33'),
(2, 'Smartphone', 'Telephones', '2024-01-03 02:34:11', '2023-01-03 15:34:33'),
(4, 'AudioVisuel', 'Cinema,Series', '2023-01-03 10:33:07', '2023-01-03 11:27:26'),
(6, 'Livres', 'E-books, livres audio...', '2023-01-03 10:33:07', '2023-01-03 11:27:47'),
(15, 'Alimentaire', 'AjoutÃ© par Postman', '2023-01-03 17:32:41', '2023-01-03 15:33:11');

-- --------------------------------------------------------

--
-- Structure de la table `produits`
--

DROP TABLE IF EXISTS `produits`;
CREATE TABLE IF NOT EXISTS `produits` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `nom` varchar(32) NOT NULL,
  `description` text NOT NULL,
  `prix` decimal(10,0) NOT NULL,
  `categories_id` int(11) NOT NULL,
  `date_creation` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `date_maj` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`),
  KEY `categories_id` (`categories_id`)
) ENGINE=InnoDB AUTO_INCREMENT=8 DEFAULT CHARSET=utf8;

--
-- Déchargement des données de la table `produits`
--

INSERT INTO `produits` (`id`, `nom`, `description`, `prix`, `categories_id`, `date_creation`, `date_maj`) VALUES
(1, 'Iphone 14', 'Phone', '829111100', 2, '2023-01-03 14:05:41', '2023-01-03 12:05:41'),
(2, 'Xiaomi', 'Xiaomi', '785', 2, '2023-01-03 17:05:41', '2023-01-03 15:18:39');

-- --------------------------------------------------------

--
-- Structure de la table `utilisateurs`
--

DROP TABLE IF EXISTS `utilisateurs`;
CREATE TABLE IF NOT EXISTS `utilisateurs` (
  `Mail` varchar(80) NOT NULL,
  `Mdp` varchar(100) NOT NULL,
  `NOM` char(32) DEFAULT NULL,
  `PRENOM` char(32) DEFAULT NULL,
  `Token` varchar(100) NOT NULL,
  PRIMARY KEY (`Mail`,`Mdp`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Déchargement des données de la table `utilisateurs`
--

INSERT INTO `utilisateurs` (`Mail`, `Mdp`, `NOM`, `PRENOM`, `Token`) VALUES
('iliesskalli2@gmail.com', 'Postman', 'Skalli', 'Ilies', '488e320be4da1404b6e5d242130942fa082924fdbe38e7fb9f7745008afdf0bb');
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
