-- phpMyAdmin SQL Dump
-- version 4.8.5
-- https://www.phpmyadmin.net/
--
-- Hôte : 127.0.0.1:3306
-- Généré le :  ven. 07 juin 2019 à 11:52
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
-- Base de données :  `juniorentreprise`
--

-- --------------------------------------------------------

--
-- Structure de la table `table_client`
--

DROP TABLE IF EXISTS `table_client`;
CREATE TABLE IF NOT EXISTS `table_client` (
  `id_client` int(11) NOT NULL AUTO_INCREMENT,
  `nom_societe` varchar(100) NOT NULL,
  `num_siren` varchar(25) NOT NULL,
  `email` varchar(50) NOT NULL,
  `adresse` varchar(100) NOT NULL,
  `code_postal` int(10) NOT NULL,
  `indice_confiance` int(2) NOT NULL,
  `telephone` varchar(15) NOT NULL,
  `nb_contrats` int(3) DEFAULT NULL,
  `argent_regle` decimal(10,2) DEFAULT NULL,
  `argent_du` decimal(10,2) DEFAULT NULL,
  `argent_total` decimal(10,2) DEFAULT NULL,
  PRIMARY KEY (`id_client`)
) ENGINE=InnoDB AUTO_INCREMENT=6 DEFAULT CHARSET=latin1;

--
-- Déchargement des données de la table `table_client`
--

INSERT INTO `table_client` (`id_client`, `nom_societe`, `num_siren`, `email`, `adresse`, `code_postal`, `indice_confiance`, `telephone`, `nb_contrats`, `argent_regle`, `argent_du`, `argent_total`) VALUES
(1, 'Michel', '399 538 789', 'carrefour@wanadoo.fr', '3 chemin de la source', 69005, 4, '06 56 78 33 54', 2, '400.00', '200.50', '600.00'),
(2, 'Apple', '399 539 780', 'Apple@wanadoo.fr', '2 rue du paridis', 42740, 5, '06 57 89 00 90', 1, '2000.00', '4000.00', '6000.00'),
(3, 'ProColor', '399 540 780', 'ProColor@wanadoo.fr', '34 allé des cocotiers', 65841, 2, '07 89 45 69 49', 4, '1300.00', '0.00', '1300.00'),
(4, 'Google', '399 541 780', 'Google@wanadoo.fr', '51 boulevard de la republique', 15000, 3, '05 69 49 48 49', 1, '5000.96', '500.00', '5500.00'),
(5, 'IUTLyon1', '399 542 780', 'IUTLyon1@wanadoo.fr', 'Villeurbanne', 69002, 0, '04 89 48 48 56', 3, '500.00', '250.00', '750.00');

-- --------------------------------------------------------

--
-- Structure de la table `table_convention`
--

DROP TABLE IF EXISTS `table_convention`;
CREATE TABLE IF NOT EXISTS `table_convention` (
  `id_convention` int(11) NOT NULL AUTO_INCREMENT,
  `id_client` int(4) NOT NULL,
  `date_debut` date NOT NULL,
  `date_fin` date NOT NULL,
  `montant` double(10,2) NOT NULL,
  `sujet` varchar(255) NOT NULL,
  `statut_projet` varchar(100) NOT NULL,
  `date_facture` date DEFAULT NULL,
  `montant_regle` double(10,2) DEFAULT NULL,
  PRIMARY KEY (`id_convention`),
  KEY `fk_convention` (`id_client`)
) ENGINE=InnoDB AUTO_INCREMENT=6 DEFAULT CHARSET=latin1;

--
-- Déchargement des données de la table `table_convention`
--

INSERT INTO `table_convention` (`id_convention`, `id_client`, `date_debut`, `date_fin`, `montant`, `sujet`, `statut_projet`, `date_facture`, `montant_regle`) VALUES
(1, 1, '2019-05-02', '2020-05-02', 200.00, 'Realiser un drone', 'Terminé', '2019-05-01', 400.50),
(2, 3, '2019-05-03', '2020-05-03', 400.50, 'Developper le design', 'En cours', '2019-05-02', NULL),
(3, 1, '2019-05-04', '2020-05-04', 500.00, 'Developper une application', 'En cours', '2019-05-03', NULL),
(4, 5, '2019-05-05', '2020-05-05', 300.00, 'Developper un robot', 'En cours', '2019-05-04', NULL),
(5, 4, '2019-05-06', '2020-05-06', 250.00, 'Developper un réseau', 'En cours', '2019-05-05', NULL);

-- --------------------------------------------------------

--
-- Structure de la table `table_convention_etudiant`
--

DROP TABLE IF EXISTS `table_convention_etudiant`;
CREATE TABLE IF NOT EXISTS `table_convention_etudiant` (
  `id_convention` int(11) NOT NULL,
  `id_etudiant` int(11) NOT NULL,
  PRIMARY KEY (`id_convention`,`id_etudiant`),
  KEY `fk_convetu_etudiant` (`id_etudiant`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Déchargement des données de la table `table_convention_etudiant`
--

INSERT INTO `table_convention_etudiant` (`id_convention`, `id_etudiant`) VALUES
(1, 1),
(4, 1),
(1, 2),
(3, 4),
(2, 5),
(5, 6),
(4, 8),
(3, 9);

-- --------------------------------------------------------

--
-- Structure de la table `table_etudiant`
--

DROP TABLE IF EXISTS `table_etudiant`;
CREATE TABLE IF NOT EXISTS `table_etudiant` (
  `id_etudiant` int(11) NOT NULL AUTO_INCREMENT,
  `civilite` varchar(5) NOT NULL,
  `nom` varchar(200) NOT NULL,
  `prenom` varchar(200) NOT NULL,
  `dateDeNaissance` date NOT NULL,
  `adresse` varchar(200) NOT NULL,
  `code_postal` varchar(10) NOT NULL,
  `telephone` varchar(20) NOT NULL,
  `email` varchar(200) NOT NULL,
  `login` varchar(200) NOT NULL,
  PRIMARY KEY (`id_etudiant`)
) ENGINE=InnoDB AUTO_INCREMENT=10 DEFAULT CHARSET=latin1;

--
-- Déchargement des données de la table `table_etudiant`
--

INSERT INTO `table_etudiant` (`id_etudiant`, `civilite`, `nom`, `prenom`, `dateDeNaissance`, `adresse`, `code_postal`, `telephone`, `email`, `login`) VALUES
(1, 'M', 'Henini', 'Leo', '1998-08-28', '6B Route de la terrasse', '69100', '06 29 70 77 97', 'leo@outlook.fr', 'p1812282'),
(2, 'F', 'Gauthier', 'Charlotte', '1998-06-14', '14 Avenue des hortensias', '69100', '06 59 54 26 35', 'charlotte@outlook.fr', 'p1805647'),
(3, 'M', 'Bat', 'Paulin', '1998-03-14', 'Hamot des villageois', '69100', '06 55 97 46 81', 'paulin@outlook.fr', 'p1800999'),
(4, 'M', 'Touche', 'Aymeric', '1998-06-30', '45 Boulevard Albert Camus', '69100', '06 44 98 24 63', 'aymeric@outlook.fr', 'p1805649'),
(5, 'M', 'Mamouni', 'Yassir', '1998-04-04', 'Bloc A - Les Minguettes', '69100', '06 57 63 91 20', 'yassir@outlook.fr', 'p1805650'),
(6, 'M', 'Dupont', 'Jean-Jacques', '1965-05-14', '2 Allée des bruyères', '69100', '06 64 95 31 40', 'jean-jacques@outlook.fr', 'p1805651'),
(7, 'F', 'Bruyere', 'Geraldine', '1970-11-12', '45 Allée des geraniums', '69100', '06 46 82 60 41', 'geraldine@outlook.fr', 'p1805652'),
(8, 'F', 'Barron', 'Lucie', '1993-06-16', '124 boulevard Pierre Marchand', '69100', '06 39 64 78 02', 'lucie@outlook.fr', 'p1805653'),
(9, 'F', 'Merheim', 'Corinne', '1985-05-07', '14 Route de la République', '69100', '06 54 78 05 03', 'corinne@outlook.fr', 'p1805654');

-- --------------------------------------------------------

--
-- Structure de la table `table_reglement`
--

DROP TABLE IF EXISTS `table_reglement`;
CREATE TABLE IF NOT EXISTS `table_reglement` (
  `id_reglement` int(11) NOT NULL AUTO_INCREMENT,
  `id_convention` int(11) NOT NULL,
  `date_reglement` date NOT NULL,
  `montant_regle` decimal(10,2) NOT NULL,
  `mode_de_reglement` varchar(250) NOT NULL,
  `numero_cheque_cb` varchar(250) DEFAULT NULL,
  PRIMARY KEY (`id_reglement`),
  KEY `fk_reglement_convention` (`id_convention`)
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=latin1;

--
-- Déchargement des données de la table `table_reglement`
--

INSERT INTO `table_reglement` (`id_reglement`, `id_convention`, `date_reglement`, `montant_regle`, `mode_de_reglement`, `numero_cheque_cb`) VALUES
(1, 1, '2019-05-02', '200.00', 'Cheque', '1234567'),
(2, 2, '2019-04-12', '300.00', 'Cheque', '8901234'),
(3, 3, '2019-04-07', '350.00', 'CB', '4978742212345670');

-- --------------------------------------------------------

--
-- Structure de la table `table_utilisateur_admin`
--

DROP TABLE IF EXISTS `table_utilisateur_admin`;
CREATE TABLE IF NOT EXISTS `table_utilisateur_admin` (
  `id_user_admin` int(11) NOT NULL AUTO_INCREMENT,
  `login` varchar(250) NOT NULL,
  `mdp` varchar(250) NOT NULL,
  `mail` varchar(250) NOT NULL,
  PRIMARY KEY (`id_user_admin`)
) ENGINE=MyISAM AUTO_INCREMENT=2 DEFAULT CHARSET=latin1;

--
-- Déchargement des données de la table `table_utilisateur_admin`
--

INSERT INTO `table_utilisateur_admin` (`id_user_admin`, `login`, `mdp`, `mail`) VALUES
(1, 'admin', '$2y$10$BOQfS25rusfGuDUPDz82XOd9yqyx5n2UzPAgUM9hrvJVeNXPeE2ky', 'jeanmichel_roger@hotmail.fr');

-- --------------------------------------------------------

--
-- Structure de la table `table_utilisateur_etudiant`
--

DROP TABLE IF EXISTS `table_utilisateur_etudiant`;
CREATE TABLE IF NOT EXISTS `table_utilisateur_etudiant` (
  `id_user_etu` int(11) NOT NULL AUTO_INCREMENT,
  `login` varchar(100) NOT NULL,
  `mdp` varchar(100) NOT NULL,
  PRIMARY KEY (`id_user_etu`),
  KEY `fk_useretu_login` (`login`)
) ENGINE=InnoDB AUTO_INCREMENT=12 DEFAULT CHARSET=latin1;

--
-- Déchargement des données de la table `table_utilisateur_etudiant`
--

INSERT INTO `table_utilisateur_etudiant` (`id_user_etu`, `login`, `mdp`) VALUES
(1, 'p1812282', '$2y$10$ufMfBz./HdJT1AgGaMvlDugAcPw7IyJpEE8gsYfijx4Wl5WF8S35G'),
(2, 'p1805647', '123'),
(3, 'p1800999', '$2y$10$7n1E8sJLIV7bCoNhLkBSY.oh1zyl2XplMGGI/hjuM5TZEbIdMgmv2'),
(4, 'p1805647', '345'),
(5, 'p1805648', '456'),
(6, 'p1805649', '567'),
(7, 'p1805650', '678'),
(8, 'p1805651', '789'),
(9, 'p1805652', '900'),
(10, 'p1805653', '101'),
(11, 'p1805654', '112');

--
-- Contraintes pour les tables déchargées
--

--
-- Contraintes pour la table `table_convention`
--
ALTER TABLE `table_convention`
  ADD CONSTRAINT `fk_convention` FOREIGN KEY (`id_client`) REFERENCES `table_client` (`id_client`);

--
-- Contraintes pour la table `table_convention_etudiant`
--
ALTER TABLE `table_convention_etudiant`
  ADD CONSTRAINT `fk_convetu_convention` FOREIGN KEY (`id_convention`) REFERENCES `table_convention` (`id_convention`),
  ADD CONSTRAINT `fk_convetu_etudiant` FOREIGN KEY (`id_etudiant`) REFERENCES `table_etudiant` (`id_etudiant`);

--
-- Contraintes pour la table `table_reglement`
--
ALTER TABLE `table_reglement`
  ADD CONSTRAINT `fk_reglement_convention` FOREIGN KEY (`id_convention`) REFERENCES `table_convention` (`id_convention`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
