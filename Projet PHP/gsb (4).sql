-- phpMyAdmin SQL Dump
-- version 5.1.1
-- https://www.phpmyadmin.net/
--
-- Hôte : 127.0.0.1:3306
-- Généré le : jeu. 25 avr. 2024 à 08:18
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
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `nom` varchar(50) DEFAULT NULL,
  `description` varchar(50) DEFAULT NULL,
  `date_activité` date DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=utf8mb4;

--
-- Déchargement des données de la table `activités`
--

INSERT INTO `activités` (`id`, `nom`, `description`, `date_activité`) VALUES
(1, 'conference1.0', 'reunion mensuelle', '2024-01-05'),
(2, 'conference2.0', 'reunion mensuelle', '2024-02-02'),
(3, 'conference3.0', 'reunion mensuelle', '2024-03-01');

--
-- Déclencheurs `activités`
--
DROP TRIGGER IF EXISTS `check_date_activite_insert`;
DELIMITER $$
CREATE TRIGGER `check_date_activite_insert` BEFORE INSERT ON `activités` FOR EACH ROW BEGIN
    IF NEW.date_activité < CURDATE() THEN
        SIGNAL SQLSTATE '45000' SET MESSAGE_TEXT = 'Vous ne pouvez pas ajouter une activité avec une date antérieure à la date actuelle.';
    END IF;
END
$$
DELIMITER ;

-- --------------------------------------------------------

--
-- Structure de la table `chercheurs`
--

DROP TABLE IF EXISTS `chercheurs`;
CREATE TABLE IF NOT EXISTS `chercheurs` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `nom` varchar(50) NOT NULL,
  `prenom` varchar(50) NOT NULL,
  `specialite` varchar(50) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=5 DEFAULT CHARSET=utf8;

--
-- Déchargement des données de la table `chercheurs`
--

INSERT INTO `chercheurs` (`id`, `nom`, `prenom`, `specialite`) VALUES
(1, 'Houel', 'Nicolas ', 'Apothicaire'),
(2, 'Charas', 'Moyse', 'Apothicaire'),
(3, 'Parmentier', 'Antoine Augustin', 'Chimie alimentaire'),
(4, 'Fourneau', 'Ernest', 'Chimie therapeutique');

-- --------------------------------------------------------

--
-- Structure de la table `comporte`
--

DROP TABLE IF EXISTS `comporte`;
CREATE TABLE IF NOT EXISTS `comporte` (
  `id_medocT` int(11) NOT NULL AUTO_INCREMENT,
  `idC` int(11) NOT NULL,
  PRIMARY KEY (`id_medocT`,`idC`),
  KEY `id_1` (`idC`)
) ENGINE=MyISAM AUTO_INCREMENT=17 DEFAULT CHARSET=utf8mb4;

--
-- Déchargement des données de la table `comporte`
--

INSERT INTO `comporte` (`id_medocT`, `idC`) VALUES
(1, 1),
(2, 2),
(3, 3),
(4, 4),
(5, 5),
(6, 6),
(7, 7),
(8, 8),
(9, 9),
(10, 10),
(11, 11),
(12, 12),
(13, 13),
(14, 14),
(15, 15),
(16, 16);

-- --------------------------------------------------------

--
-- Structure de la table `contient`
--

DROP TABLE IF EXISTS `contient`;
CREATE TABLE IF NOT EXISTS `contient` (
  `id_medocC` int(11) NOT NULL AUTO_INCREMENT,
  `id` int(11) NOT NULL,
  PRIMARY KEY (`id_medocC`,`id`),
  KEY `id_1` (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=17 DEFAULT CHARSET=utf8mb4;

--
-- Déchargement des données de la table `contient`
--

INSERT INTO `contient` (`id_medocC`, `id`) VALUES
(1, 1),
(2, 2),
(3, 3),
(4, 4),
(5, 5),
(6, 6),
(7, 7),
(8, 8),
(9, 9),
(10, 10),
(11, 11),
(12, 12),
(13, 13),
(14, 14),
(15, 15),
(16, 16);

-- --------------------------------------------------------

--
-- Structure de la table `effets_secondaires`
--

DROP TABLE IF EXISTS `effets_secondaires`;
CREATE TABLE IF NOT EXISTS `effets_secondaires` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `Descriptif` varchar(500) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=17 DEFAULT CHARSET=utf8mb4;

--
-- Déchargement des données de la table `effets_secondaires`
--

INSERT INTO `effets_secondaires` (`id`, `Descriptif`) VALUES
(1, 'Risque de lésions hépatiques en cas de surdosage.'),
(2, ' Irritation gastrique et ulcères.'),
(3, 'les nausées et les sensations vertigineuses'),
(4, 'Risque accru d\'infections gastro-intestinales.'),
(5, 'Réactions allergiques, parfois sévères.'),
(6, 'Somnolence, dépendance physique et psychique.'),
(7, 'Palpitations cardiaques, troubles du sommeil.'),
(8, 'Augmente le risque de saignement gastrique et d\'ulcères.'),
(9, 'Risque accru de douleurs musculaires et de lésions hépatiques.'),
(10, 'Constipation, dépression respiratoire.'),
(11, 'Troubles gastro-intestinaux, hypoglycémie.'),
(12, 'Insomnie, diminution de la libido.'),
(13, 'Risque accru de saignements, interactions médicamenteuses.'),
(14, 'Toux sèche, hypotension.'),
(15, 'Somnolence, dépendance.'),
(16, 'Prise de poids, augmentation de la pression artérielle.');

-- --------------------------------------------------------

--
-- Structure de la table `effets_thérapeutiques`
--

DROP TABLE IF EXISTS `effets_thérapeutiques`;
CREATE TABLE IF NOT EXISTS `effets_thérapeutiques` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `Descriptif` varchar(500) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=17 DEFAULT CHARSET=utf8mb4;

--
-- Déchargement des données de la table `effets_thérapeutiques`
--

INSERT INTO `effets_thérapeutiques` (`id`, `Descriptif`) VALUES
(1, 'Soulagement de la douleur et réduction de la fièvre.'),
(2, 'Anti-inflammatoire non stéroïdien, soulage la douleur et réduit l\'inflammation.'),
(3, 'Soulage la douleur en agissant sur des cellules nerveuses particulières de la moelle épinière et du cerveau.'),
(4, 'Réduction de la production d\'acide gastrique, traitement des ulcères gastriques et du reflux gastro-œsophagien.'),
(5, 'Antibiotique, traitement des infections bactériennes.'),
(6, 'Anxiolytique, anticonvulsivant, relaxant musculaire.'),
(7, 'Hormone thyroïdienne de remplacement, traitement de l\'hypothyroïdie.'),
(8, 'Analgésique, anti-inflammatoire, prévention des caillots sanguins.'),
(9, 'Réduction du cholestérol, prévention des maladies cardiovasculaires.'),
(10, 'Analgésique puissant, utilisé pour soulager la douleur sévère.'),
(11, 'Traitement du diabète de type 2, aide à contrôler la glycémie.'),
(12, 'Antidépresseur, traitement des troubles anxieux et de la dépression.'),
(13, 'Anticoagulant, prévention des caillots sanguins.'),
(14, 'Inhibiteur de l\'enzyme de conversion de l\'angiotensine, traitement de l\'hypertension et de l\'insuffisance cardiaque.'),
(15, 'Anxiolytique, traitement des troubles anxieux et des crises de panique.'),
(16, 'Corticostéroïde, traitement des inflammations et des réactions allergiques.');

-- --------------------------------------------------------

--
-- Structure de la table `incompatibilité`
--

DROP TABLE IF EXISTS `incompatibilité`;
CREATE TABLE IF NOT EXISTS `incompatibilité` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `id_1` int(11) NOT NULL,
  PRIMARY KEY (`id`,`id_1`),
  KEY `id_1` (`id_1`)
) ENGINE=MyISAM AUTO_INCREMENT=17 DEFAULT CHARSET=utf8mb4;

--
-- Déchargement des données de la table `incompatibilité`
--

INSERT INTO `incompatibilité` (`id`, `id_1`) VALUES
(1, 2),
(2, 1),
(3, 4),
(4, 3),
(5, 6),
(6, 5),
(7, 8),
(8, 7),
(9, 10),
(10, 9),
(11, 12),
(12, 11),
(13, 14),
(14, 13),
(15, 16),
(16, 15);

-- --------------------------------------------------------

--
-- Structure de la table `medicaments`
--

DROP TABLE IF EXISTS `medicaments`;
CREATE TABLE IF NOT EXISTS `medicaments` (
  `id` int(11) NOT NULL,
  `nom` varchar(50) DEFAULT NULL,
  `description` text NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8mb4;

--
-- Déchargement des données de la table `medicaments`
--

INSERT INTO `medicaments` (`id`, `nom`, `description`) VALUES
(1, 'Paracétamol', 'Le paracétamol, aussi appelé acétaminophène, est un composé chimique utilisé comme antalgique et antipyrétique, qui figure parmi les médicaments les plus communs, utilisés et prescrits au monde.'),
(2, 'Ibuprofène', 'Ibuprofène est la dénomination commune internationale de l\'acide 2-4-propyl phénylpropanoïque. Il s\'agit de la substance active d\'un médicament AINS utilisé pour soulager les symptômes de l\'arthrite, de la dysménorrhée primaire, de la pyrexie et comme analgésique, spécialement en cas d\'inflammation.'),
(3, 'Tramadol', 'Le tramadol est un antalgique central développé par la firme allemande Grünenthal GmbH dans les années 1970. Il est classé dans la catégorie des analgésiques de niveau 2, catégorie comprenant également la codéine, les extraits d\'opium et anciennement le dextropropoxyphène.'),
(4, 'Omeprazole', 'L\'oméprazole est une substance active médicamenteuse de la famille des inhibiteurs de la pompe à protons qui réduit la sécrétion acide de l\'estomac.'),
(5, 'Amoxicilline', 'L\'amoxicilline est un antibiotique β-lactamine bactéricide de la famille des aminopénicillines indiqué dans le traitement des infections bactériennes à germes sensibles.'),
(6, 'Diazépam', 'Le diazépam est un médicament de la famille des benzodiazépines. Il possède des propriétés anxiolytiques, sédatives, amnésiantes et hypnotiques. Néanmoins, en raison de ses effets importants de somnolence résiduelle le lendemain matin, il est de moins en moins utilisé comme hypnotique en clinique.'),
(7, 'Lévothyroxine', 'La lévothyroxine, aussi connue sous le nom de L-thyroxine, T4 synthétique ou 3,5,3\',5\'-tetraiodo-L-thyronine, est une forme synthétique de la thyroxine, également utilisée comme médicament.'),
(8, 'Aspirine', 'L’acide acétylsalicylique, plus connu sous le nom commercial d’aspirine, est un anti-inflammatoire non stéroïdien. C’est la substance active de nombreux médicaments aux propriétés antalgiques, antipyrétiques et anti-inflammatoires. Il est surtout utilisé comme antiagrégant plaquettaire.'),
(9, 'Atorvastatine', 'L\'atorvastatine est un médicament de type statine utilisé pour son action hypocholestérolémiante. Cette molécule a été découverte par la société américaine Warner-Lambert et lancée en 1997.'),
(10, 'Morphine', 'La morphine est le principal alcaloïde de l\'opium, le latex du pavot somnifère. C\'est une molécule complexe utilisée en médecine comme analgésique et comme drogue pour son action euphorisante. L\'opium est utilisé en médecine depuis le IIIᵉ millénaire av.'),
(11, 'Metformine', 'La metformine est un antidiabétique oral de la famille des biguanides normoglycémiants utilisé dans le traitement du diabète de type 2. Son rôle est de diminuer l\'insulino-résistance de l\'organisme intolérant aux glucides et de diminuer la néoglucogenèse hépatique.'),
(12, 'Citalopram', 'Le citalopram, ou plus exactement le bromhydrate de citalopram, est un antidépresseur inhibiteur sélectif de la recapture de la sérotonine, il est utilisé pour le traitement de la dépression, associé ou non à des troubles de l\'humeur, et dans l\'ensemble des troubles de l\'anxiété.'),
(13, 'Warfarine', 'Le coumaphène ou warfarine est un composé organique de la famille des coumarines. C\'est une substance active de produit phytosanitaire, qui présente un effet rodenticide, avec toutefois de possibles phénomènes de résistance aux rodenticides.'),
(14, 'Lisinopril', 'Le lisinopril est un médicament inhibiteur de l\'enzyme de conversion. Il est utilisé pour traiter l\'hypertension artérielle, l\'insuffisance cardiaque et l\'après crises cardiaques. Pour l\'hypertension artérielle, il s\'agit généralement d\'un traitement de première intention.'),
(15, 'Alprazolam', 'L\'alprazolam est une benzodiazépine de la famille des triazolobenzodiazépines utilisée comme un anxiolytique d\'action rapide. En France, l\'alprazolam est la benzodiazépine la plus prescrite et est connue sous son nom commercial Xanax.'),
(16, 'Prednisone', 'La prednisone est un corticostéroïde, prodrogue métabolisée par le foie par réduction du carbonyle en hydroxyde par la 11-β-oxydoréductase hépatique, en prednisolone.');

-- --------------------------------------------------------

--
-- Structure de la table `rejoint`
--

DROP TABLE IF EXISTS `rejoint`;
CREATE TABLE IF NOT EXISTS `rejoint` (
  `id` int(11) NOT NULL,
  `id_act` int(11) NOT NULL,
  PRIMARY KEY (`id`,`id_act`),
  KEY `id_act` (`id_act`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Déchargement des données de la table `rejoint`
--

INSERT INTO `rejoint` (`id`, `id_act`) VALUES
(2, 1),
(3, 1),
(1, 2),
(2, 2),
(3, 2),
(4, 3);

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
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Déchargement des données de la table `utilisateurs`
--

INSERT INTO `utilisateurs` (`id`, `nom`, `prenom`, `adresse_mail`, `profession`, `MDP`) VALUES
(1, 'Jean', 'Christophe', 'Jean.christophe@gmail.com', 'orthophoniste', 'Soleil123'),
(2, 'Andrer', 'quentin', 'quentin123@gmail.com', 'generaliste', '23'),
(3, 'Philipe', 'Baptiste', 'Baptiste.philipe@gmail.com', 'orl', 'gvojerzs'),
(4, 'admin', 'admin', 'admin@gmail.com', 'admin', 'root');

--
-- Déclencheurs `utilisateurs`
--
DROP TRIGGER IF EXISTS `check_profession_insert`;
DELIMITER $$
CREATE TRIGGER `check_profession_insert` BEFORE INSERT ON `utilisateurs` FOR EACH ROW BEGIN
    IF NEW.profession = '' OR NEW.profession IS NULL THEN
        SIGNAL SQLSTATE '45000' SET MESSAGE_TEXT = 'La profession ne peut pas être vide.';
    END IF;
END
$$
DELIMITER ;

--
-- Contraintes pour les tables déchargées
--

--
-- Contraintes pour la table `rejoint`
--
ALTER TABLE `rejoint`
  ADD CONSTRAINT `rejoint_ibfk_1` FOREIGN KEY (`id`) REFERENCES `utilisateurs` (`id`),
  ADD CONSTRAINT `rejoint_ibfk_2` FOREIGN KEY (`id_act`) REFERENCES `activités` (`id`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
