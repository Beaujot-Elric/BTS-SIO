-- phpMyAdmin SQL Dump
-- version 5.1.1
-- https://www.phpmyadmin.net/
--
-- Hôte : 127.0.0.1:3306
-- Généré le : jeu. 14 mars 2024 à 07:12
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
-- Base de données : `gsb`
--

-- --------------------------------------------------------

--
-- Structure de la table `activités`
--

DROP TABLE IF EXISTS `activités`;
CREATE TABLE IF NOT EXISTS `activités` (
  `id` varchar(50) NOT NULL,
  `nom` varchar(50) DEFAULT NULL,
  `description` varchar(50) DEFAULT NULL,
  `date_activité` date DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8mb4;

--
-- Déchargement des données de la table `activités`
--

INSERT INTO `activités` (`id`, `nom`, `description`, `date_activité`) VALUES
('1', 'conference1.0', 'reunion mensuelle', '2024-01-05'),
('2', 'conference2.0', 'reunion mensuelle', '2024-02-02'),
('3', 'conference3.0', 'reunion mensuelle', '2024-03-01');

-- --------------------------------------------------------

--
-- Structure de la table `comporte`
--

DROP TABLE IF EXISTS `comporte`;
CREATE TABLE IF NOT EXISTS `comporte` (
  `id` int(11) NOT NULL,
  `id_1` varchar(50) NOT NULL,
  PRIMARY KEY (`id`,`id_1`),
  KEY `id_1` (`id_1`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Structure de la table `comtient`
--

DROP TABLE IF EXISTS `comtient`;
CREATE TABLE IF NOT EXISTS `comtient` (
  `id` int(11) NOT NULL,
  `id_1` varchar(50) NOT NULL,
  PRIMARY KEY (`id`,`id_1`),
  KEY `id_1` (`id_1`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Structure de la table `effets_secondaires`
--

DROP TABLE IF EXISTS `effets_secondaires`;
CREATE TABLE IF NOT EXISTS `effets_secondaires` (
  `id` varchar(50) NOT NULL,
  `Descriptif` varchar(50) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8mb4;

--
-- Déchargement des données de la table `effets_secondaires`
--

INSERT INTO `effets_secondaires` (`id`, `Descriptif`) VALUES
('1', 'nausées'),
('2', 'vomissements'),
('3', 'diarrhée');

-- --------------------------------------------------------

--
-- Structure de la table `effets_thérapeutiques`
--

DROP TABLE IF EXISTS `effets_thérapeutiques`;
CREATE TABLE IF NOT EXISTS `effets_thérapeutiques` (
  `id` varchar(50) NOT NULL,
  `Descriptif` varchar(50) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8mb4;

--
-- Déchargement des données de la table `effets_thérapeutiques`
--

INSERT INTO `effets_thérapeutiques` (`id`, `Descriptif`) VALUES
('1', 'antidouleur'),
('2', 'anti-inflammatoire'),
('3', 'antalgique');

-- --------------------------------------------------------

--
-- Structure de la table `incompatibilité`
--

DROP TABLE IF EXISTS `incompatibilité`;
CREATE TABLE IF NOT EXISTS `incompatibilité` (
  `id` int(11) NOT NULL,
  `id_1` int(11) NOT NULL,
  PRIMARY KEY (`id`,`id_1`),
  KEY `id_1` (`id_1`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Structure de la table `medicaments`
--

DROP TABLE IF EXISTS `medicaments`;
CREATE TABLE IF NOT EXISTS `medicaments` (
  `id` int(11) NOT NULL,
  `nom` varchar(50) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8mb4;

--
-- Déchargement des données de la table `medicaments`
--

INSERT INTO `medicaments` (`id`, `nom`) VALUES
(1, 'paracétamol'),
(2, 'ibuprofène'),
(3, 'tramadol');

-- --------------------------------------------------------

--
-- Structure de la table `rejoin`
--

DROP TABLE IF EXISTS `rejoin`;
CREATE TABLE IF NOT EXISTS `rejoin` (
  `id` varchar(50) NOT NULL,
  `id_1` varchar(50) NOT NULL,
  PRIMARY KEY (`id`,`id_1`),
  KEY `id_1` (`id_1`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Structure de la table `utilisateurs`
--

DROP TABLE IF EXISTS `utilisateurs`;
CREATE TABLE IF NOT EXISTS `utilisateurs` (
  `id` int(50) NOT NULL,
  `nom` varchar(50) DEFAULT NULL,
  `prenom` varchar(50) DEFAULT NULL,
  `adresse_mail` varchar(50) DEFAULT NULL,
  `profession` varchar(50) DEFAULT NULL,
  `MDP` varchar(20) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8mb4;

--
-- Déchargement des données de la table `utilisateurs`
--

INSERT INTO `utilisateurs` (`id`, `nom`, `prenom`, `adresse_mail`, `profession`, `MDP`) VALUES
(1, 'Jean', 'Christophe', 'Jean.christophe@gmail.com', 'orthophoniste', 'Soleil123'),
(2, 'Andrer', 'quentin', 'quentin123@gmail.com', 'generaliste', '23'),
(3, 'Philipe', 'Baptiste', 'Baptiste.philipe@gmail.com', 'orl', '');
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
