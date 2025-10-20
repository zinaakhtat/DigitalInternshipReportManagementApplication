-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Hôte : 127.0.0.1:3303
-- Généré le : ven. 10 mai 2024 à 11:44
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
-- Base de données : `database`
--

-- --------------------------------------------------------

--
-- Structure de la table `administrateurs`
--

DROP TABLE IF EXISTS `administrateurs`;
CREATE TABLE IF NOT EXISTS `administrateurs` (
  `ID_administrateur` int NOT NULL AUTO_INCREMENT,
  `ID_utilisateur` int DEFAULT NULL,
  PRIMARY KEY (`ID_administrateur`),
  KEY `ID_utilisateur` (`ID_utilisateur`)
) ENGINE=MyISAM AUTO_INCREMENT=2 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Déchargement des données de la table `administrateurs`
--

INSERT INTO `administrateurs` (`ID_administrateur`, `ID_utilisateur`) VALUES
(1, 1);

-- --------------------------------------------------------

--
-- Structure de la table `chefs_departement`
--

DROP TABLE IF EXISTS `chefs_departement`;
CREATE TABLE IF NOT EXISTS `chefs_departement` (
  `ID_chef_departement` int NOT NULL AUTO_INCREMENT,
  `ID_utilisateur` int DEFAULT NULL,
  `ID_filière` int DEFAULT NULL,
  PRIMARY KEY (`ID_chef_departement`),
  KEY `ID_utilisateur` (`ID_utilisateur`),
  KEY `ID_filière` (`ID_filière`)
) ENGINE=MyISAM AUTO_INCREMENT=2 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Déchargement des données de la table `chefs_departement`
--

INSERT INTO `chefs_departement` (`ID_chef_departement`, `ID_utilisateur`, `ID_filière`) VALUES
(1, 2, 1);

-- --------------------------------------------------------

--
-- Structure de la table `etudiants`
--

DROP TABLE IF EXISTS `etudiants`;
CREATE TABLE IF NOT EXISTS `etudiants` (
  `ID_etudiant` int NOT NULL AUTO_INCREMENT,
  `ID_utilisateur` int DEFAULT NULL,
  `ID_filière` int DEFAULT NULL,
  `ID_niveau` int DEFAULT NULL,
  PRIMARY KEY (`ID_etudiant`),
  KEY `ID_utilisateur` (`ID_utilisateur`),
  KEY `ID_filière` (`ID_filière`),
  KEY `ID_niveau` (`ID_niveau`)
) ENGINE=MyISAM AUTO_INCREMENT=6 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Déchargement des données de la table `etudiants`
--

INSERT INTO `etudiants` (`ID_etudiant`, `ID_utilisateur`, `ID_filière`, `ID_niveau`) VALUES
(1, 4, 3, 1);

-- --------------------------------------------------------

--
-- Structure de la table `filieres`
--

DROP TABLE IF EXISTS `filieres`;
CREATE TABLE IF NOT EXISTS `filieres` (
  `ID_filiere` int NOT NULL AUTO_INCREMENT,
  `Nom_filiere` varchar(255) NOT NULL,
  PRIMARY KEY (`ID_filiere`)
) ENGINE=MyISAM AUTO_INCREMENT=8 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Déchargement des données de la table `filieres`
--

INSERT INTO `filieres` (`ID_filiere`, `Nom_filiere`) VALUES
(1, 'BTP'),
(2, 'FID'),
(3, 'INFO'),
(4, 'INDUS'),
(5, 'ELECTRIC'),
(6, 'MECA'),
(7, 'GEE');

-- --------------------------------------------------------

--
-- Structure de la table `niveaux`
--

DROP TABLE IF EXISTS `niveaux`;
CREATE TABLE IF NOT EXISTS `niveaux` (
  `ID_niveau` int NOT NULL AUTO_INCREMENT,
  `Nom_niveau` varchar(50) DEFAULT NULL,
  PRIMARY KEY (`ID_niveau`)
) ENGINE=MyISAM AUTO_INCREMENT=4 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Déchargement des données de la table `niveaux`
--

INSERT INTO `niveaux` (`ID_niveau`, `Nom_niveau`) VALUES
(1, '1ann'),
(2, '2ann'),
(3, '3ann');

-- --------------------------------------------------------

--
-- Structure de la table `rapports_etudiants`
--

DROP TABLE IF EXISTS `rapports_etudiants`;
CREATE TABLE IF NOT EXISTS `rapports_etudiants` (
  `ID_rapport_etudiant` int NOT NULL AUTO_INCREMENT,
  `ID_rapport` int DEFAULT NULL,
  `ID_etudiant` int DEFAULT NULL,
  PRIMARY KEY (`ID_rapport_etudiant`),
  KEY `ID_rapport` (`ID_rapport`),
  KEY `ID_etudiant` (`ID_etudiant`)
) ENGINE=MyISAM AUTO_INCREMENT=7 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Déchargement des données de la table `rapports_etudiants`
--

INSERT INTO `rapports_etudiants` (`ID_rapport_etudiant`, `ID_rapport`, `ID_etudiant`) VALUES
(1, 1, 1),
(2, 2, 1),
(3, 2, 1),
(4, 1, 1),
(5, 3, 1),
(6, 4, 1);

-- --------------------------------------------------------

--
-- Structure de la table `rapports_stage`
--

DROP TABLE IF EXISTS `rapports_stage`;
CREATE TABLE IF NOT EXISTS `rapports_stage` (
  `ID_rapport` int NOT NULL AUTO_INCREMENT,
  `Titre_rapport` varchar(255) DEFAULT NULL,
  `Description_rapport` text,
  `Date_depot` date DEFAULT NULL,
  `Chemin_fichier` varchar(255) DEFAULT NULL,
  PRIMARY KEY (`ID_rapport`)
) ENGINE=MyISAM AUTO_INCREMENT=5 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Déchargement des données de la table `rapports_stage`
--

INSERT INTO `rapports_stage` (`ID_rapport`, `Titre_rapport`, `Description_rapport`, `Date_depot`, `Chemin_fichier`) VALUES
(1, 'cyber security', 'une description détaillée sur le domaine cyber security', '2024-05-10', 'C:wamp64	mpphpCE54.tmp'),
(2, 'cyber security', 'une description détaillée sur le domaine cyber security', '2024-05-10', 'C:wamp64	mpphpCE54.tmp'),
(3, 'web development', 'web development', '2024-05-10', ''),
(4, 'web development', 'web development', '2024-05-10', 'C:/wamp64/www/projet final/Projet_web/files\\output_4.pdf');

-- --------------------------------------------------------

--
-- Structure de la table `roles`
--

DROP TABLE IF EXISTS `roles`;
CREATE TABLE IF NOT EXISTS `roles` (
  `ID_role` int NOT NULL AUTO_INCREMENT,
  `Nom_role` varchar(50) NOT NULL,
  PRIMARY KEY (`ID_role`)
) ENGINE=MyISAM AUTO_INCREMENT=5 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Déchargement des données de la table `roles`
--

INSERT INTO `roles` (`ID_role`, `Nom_role`) VALUES
(1, 'administrateur'),
(2, 'chef de département'),
(3, 'secrétaire de département'),
(4, 'étudiant');

-- --------------------------------------------------------

--
-- Structure de la table `secretaires_departement`
--

DROP TABLE IF EXISTS `secretaires_departement`;
CREATE TABLE IF NOT EXISTS `secretaires_departement` (
  `ID_secretaire_departement` int NOT NULL AUTO_INCREMENT,
  `ID_utilisateur` int DEFAULT NULL,
  `ID_filière` int DEFAULT NULL,
  PRIMARY KEY (`ID_secretaire_departement`),
  KEY `ID_utilisateur` (`ID_utilisateur`),
  KEY `ID_filière` (`ID_filière`)
) ENGINE=MyISAM AUTO_INCREMENT=2 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Déchargement des données de la table `secretaires_departement`
--

INSERT INTO `secretaires_departement` (`ID_secretaire_departement`, `ID_utilisateur`, `ID_filière`) VALUES
(1, 3, 3);

-- --------------------------------------------------------

--
-- Structure de la table `utilisateurs`
--

DROP TABLE IF EXISTS `utilisateurs`;
CREATE TABLE IF NOT EXISTS `utilisateurs` (
  `ID_utilisateur` int NOT NULL AUTO_INCREMENT,
  `Nom` varchar(255) DEFAULT NULL,
  `Prenom` varchar(255) DEFAULT NULL,
  `Email` varchar(255) DEFAULT NULL,
  `Mot_de_passe` varchar(255) DEFAULT NULL,
  `ID_role` int DEFAULT NULL,
  PRIMARY KEY (`ID_utilisateur`),
  KEY `ID_role` (`ID_role`)
) ENGINE=MyISAM AUTO_INCREMENT=5 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Déchargement des données de la table `utilisateurs`
--

INSERT INTO `utilisateurs` (`ID_utilisateur`, `Nom`, `Prenom`, `Email`, `Mot_de_passe`, `ID_role`) VALUES
(1, 'Doe', 'John', 'john.doe@gmail.com', '123', 1),
(2, 'Smith', 'Alice', 'alice.smith@gmail.com', '456', 2),
(3, 'Johnson', 'Michael', 'michael.johnson@gmail.com', '789', 3),
(4, 'Zina', 'akhtat', 'zinaakhtat@gmail.com', '333', 4);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
