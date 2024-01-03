-- phpMyAdmin SQL Dump
-- version 5.1.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1:3306
-- Generation Time: Dec 31, 2023 at 04:42 AM
-- Server version: 5.7.36
-- PHP Version: 7.4.26

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `emplois_temps`
--

-- --------------------------------------------------------

--
-- Table structure for table `cours`
--

DROP TABLE IF EXISTS `cours`;
CREATE TABLE IF NOT EXISTS `cours` (
  `id_cours` int(10) NOT NULL AUTO_INCREMENT,
  `id_promo` int(10) NOT NULL,
  `id_ens` int(10) NOT NULL,
  `id_salle` int(10) NOT NULL,
  `id_mod` int(10) NOT NULL,
  `jour` varchar(25) NOT NULL,
  `heure_debut` time NOT NULL,
  `heure_fin` time NOT NULL,
  PRIMARY KEY (`id_cours`),
  KEY `id_promo` (`id_promo`,`id_ens`,`id_salle`,`id_mod`),
  KEY `t1` (`id_ens`),
  KEY `t2` (`id_mod`),
  KEY `t4` (`id_salle`)
) ENGINE=InnoDB AUTO_INCREMENT=14 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `cours`
--

INSERT INTO `cours` (`id_cours`, `id_promo`, `id_ens`, `id_salle`, `id_mod`, `jour`, `heure_debut`, `heure_fin`) VALUES
(8, 2, 2, 3, 4, 'mardi', '08:00:00', '12:30:00'),
(9, 2, 1, 1, 1, 'dimanche', '08:00:00', '11:00:00'),
(10, 2, 2, 1, 2, 'lundi', '09:30:00', '12:30:00'),
(11, 2, 3, 1, 3, 'mardi', '08:00:00', '11:00:00'),
(12, 2, 4, 1, 4, 'mercredi', '08:00:00', '12:30:00'),
(13, 4, 1, 4, 6, 'mercredi', '14:00:00', '15:30:00');

-- --------------------------------------------------------

--
-- Table structure for table `enseignant`
--

DROP TABLE IF EXISTS `enseignant`;
CREATE TABLE IF NOT EXISTS `enseignant` (
  `id_ens` int(10) NOT NULL AUTO_INCREMENT,
  `nom_ens` varchar(25) NOT NULL,
  `trl` text NOT NULL,
  PRIMARY KEY (`id_ens`)
) ENGINE=InnoDB AUTO_INCREMENT=8 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `enseignant`
--

INSERT INTO `enseignant` (`id_ens`, `nom_ens`, `trl`) VALUES
(1, 'CHADLI Abdelhafidh', '99999'),
(2, 'KHAROUBI Sahraoui', '12345566676'),
(3, 'OUARED Djillali', '12345566676'),
(4, 'DJAAFRI Laouni', '1231231233'),
(5, 'MAAMAR NOUREDINE', '123123'),
(6, 'MAACHOU MOSTAFA', '123123123'),
(7, 'LAKMECHE Zaouaoui', 'f123123123');

-- --------------------------------------------------------

--
-- Table structure for table `etudiant`
--

DROP TABLE IF EXISTS `etudiant`;
CREATE TABLE IF NOT EXISTS `etudiant` (
  `Num_etudiant` int(10) NOT NULL AUTO_INCREMENT,
  `nom` varchar(200) NOT NULL,
  `prenom` varchar(200) NOT NULL,
  ```adresse` text NOT NULL,
  `id_promo` int(10) NOT NULL,
  PRIMARY KEY (`Num_etudiant`),
  KEY `id_promo` (`id_promo`)
) ENGINE=InnoDB AUTO_INCREMENT=7 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `etudiant`
--

INSERT INTO `etudiant` (`Num_etudiant`, `nom`, `prenom`, ```adresse`, `id_promo`) VALUES
(5, 'chebicheb', 'Kheir eddine', 'cc', 3),
(6, 'Hossam', 'ahmed', 'cc', 2);

-- --------------------------------------------------------

--
-- Table structure for table `modules`
--

DROP TABLE IF EXISTS `modules`;
CREATE TABLE IF NOT EXISTS `modules` (
  `id_mod` int(10) NOT NULL AUTO_INCREMENT,
  `nom_mod` varchar(55) NOT NULL,
  `discription` varchar(500) NOT NULL,
  PRIMARY KEY (`id_mod`)
) ENGINE=InnoDB AUTO_INCREMENT=8 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `modules`
--

INSERT INTO `modules` (`id_mod`, `nom_mod`, `discription`) VALUES
(1, 'Maintenance Logiciel', 'jsdh'),
(2, 'GPI', 'phone'),
(3, 'Developpement app Mobile', 'qrchi'),
(4, 'Xml Avance et web 2.0', 'ccc'),
(5, 'Techniques d\'express et de redation scientifique', 'vvv'),
(6, 'Legislation et deontomogie du travail', 'fff'),
(7, 'Anglais', 'vvv');

-- --------------------------------------------------------

--
-- Table structure for table `promotion`
--

DROP TABLE IF EXISTS `promotion`;
CREATE TABLE IF NOT EXISTS `promotion` (
  `id_promo` int(10) NOT NULL AUTO_INCREMENT,
  `id_speci` int(10) NOT NULL,
  `niveau` int(11) NOT NULL,
  PRIMARY KEY (`id_promo`),
  KEY `id_speci` (`id_speci`),
  KEY `niveau` (`niveau`)
) ENGINE=InnoDB AUTO_INCREMENT=11 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `promotion`
--

INSERT INTO `promotion` (`id_promo`, `id_speci`, `niveau`) VALUES
(2, 1, 2),
(3, 1, 1),
(4, 2, 2),
(5, 2, 1),
(6, 3, 2),
(7, 3, 1),
(8, 4, 1),
(9, 4, 2),
(10, 4, 3);

-- --------------------------------------------------------

--
-- Table structure for table `salles`
--

DROP TABLE IF EXISTS `salles`;
CREATE TABLE IF NOT EXISTS `salles` (
  `id_salle` int(10) NOT NULL AUTO_INCREMENT,
  `nom_salle` varchar(25) NOT NULL,
  `discription` varchar(500) NOT NULL,
  PRIMARY KEY (`id_salle`)
) ENGINE=InnoDB AUTO_INCREMENT=5 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `salles`
--

INSERT INTO `salles` (`id_salle`, `nom_salle`, `discription`) VALUES
(1, '23', 'mkdfnh'),
(2, '33', 'sd'),
(3, '4', 'df'),
(4, '1', 'er');

-- --------------------------------------------------------

--
-- Table structure for table `specialite`
--

DROP TABLE IF EXISTS `specialite`;
CREATE TABLE IF NOT EXISTS `specialite` (
  `id_speci` int(10) NOT NULL AUTO_INCREMENT,
  `nom_speci` varchar(200) NOT NULL,
  `discription` varchar(500) NOT NULL,
  PRIMARY KEY (`id_speci`)
) ENGINE=InnoDB AUTO_INCREMENT=5 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `specialite`
--

INSERT INTO `specialite` (`id_speci`, `nom_speci`, `discription`) VALUES
(1, 'MGL', 'Gene logiciel'),
(2, 'MRT', 'réusax'),
(3, 'MGI', 'informatiq'),
(4, 'L', 'info');

--
-- Constraints for dumped tables
--

--
-- Constraints for table `cours`
--
ALTER TABLE `cours`
  ADD CONSTRAINT `cours_ibfk_1` FOREIGN KEY (`id_promo`) REFERENCES `promotion` (`id_promo`) ON DELETE CASCADE,
  ADD CONSTRAINT `t1` FOREIGN KEY (`id_ens`) REFERENCES `enseignant` (`id_ens`) ON DELETE CASCADE,
  ADD CONSTRAINT `t2` FOREIGN KEY (`id_mod`) REFERENCES `modules` (`id_mod`) ON DELETE CASCADE,
  ADD CONSTRAINT `t4` FOREIGN KEY (`id_salle`) REFERENCES `salles` (`id_salle`) ON DELETE CASCADE;

--
-- Constraints for table `etudiant`
--
ALTER TABLE `etudiant`
  ADD CONSTRAINT `T8i` FOREIGN KEY (`id_promo`) REFERENCES `promotion` (`id_promo`);

--
-- Constraints for table `promotion`
--
ALTER TABLE `promotion`
  ADD CONSTRAINT `t5` FOREIGN KEY (`id_speci`) REFERENCES `specialite` (`id_speci`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
