-- phpMyAdmin SQL Dump
-- version 4.9.2
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Feb 16, 2020 at 01:18 AM
-- Server version: 10.4.11-MariaDB
-- PHP Version: 7.4.1

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `gestheuressupplm`
--

-- --------------------------------------------------------

--
-- Table structure for table `chargesensperm`
--

CREATE TABLE `chargesensperm` (
  `idCharges` int(11) NOT NULL,
  `Semestre` varchar(100) NOT NULL,
  `Filiere` varchar(100) NOT NULL,
  `Niveau` varchar(100) NOT NULL,
  `Module` varchar(100) NOT NULL,
  `Matiere` varchar(100) NOT NULL,
  `TypeEtude` varchar(10) NOT NULL,
  `VolumeHoraire` int(11) NOT NULL,
  `DepartementAttacher` varchar(100) NOT NULL,
  `idEnseiCharge` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `chargesensperm`
--

INSERT INTO `chargesensperm` (`idCharges`, `Semestre`, `Filiere`, `Niveau`, `Module`, `Matiere`, `TypeEtude`, `VolumeHoraire`, `DepartementAttacher`, `idEnseiCharge`) VALUES
(17, 'S3', 'fff', 'nnn', 'mmm', 'mtmt', 'TD', 100, 's55', 21),
(21, 'l', 'lh', 'j', 'lh', 'lkj', 'Cour', 100, 's55', 21),
(28, 'utliy', 'luyrluyr', 'yur', 'ur', 'kutr', 'TP', 120, 's5', 1);

-- --------------------------------------------------------

--
-- Table structure for table `enseignants`
--

CREATE TABLE `enseignants` (
  `idEnsei` int(11) NOT NULL,
  `NomEnsei` varchar(30) NOT NULL,
  `PreNomEnsei` varchar(30) NOT NULL,
  `Grade` varchar(3) NOT NULL,
  `TypeEnsei` varchar(15) NOT NULL,
  `HeureEnsei` int(11) DEFAULT NULL,
  `PrixHeure` int(11) NOT NULL,
  `idEtabEnsei` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `enseignants`
--

INSERT INTO `enseignants` (`idEnsei`, `NomEnsei`, `PreNomEnsei`, `Grade`, `TypeEnsei`, `HeureEnsei`, `PrixHeure`, `idEtabEnsei`) VALUES
(1, 'elmas', 'zain', 'PA', 'Permanent', 360, 220, 10),
(21, 'Alla', 'PREN', 'PES', 'Permanent', 300, 277, 11);

-- --------------------------------------------------------

--
-- Table structure for table `etablissements`
--

CREATE TABLE `etablissements` (
  `idEtab` int(11) NOT NULL,
  `NomEtab` varchar(100) NOT NULL,
  `email` varchar(80) DEFAULT NULL,
  `tel` int(11) DEFAULT NULL,
  `adress` text DEFAULT NULL,
  `ville` varchar(20) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `etablissements`
--

INSERT INTO `etablissements` (`idEtab`, `NomEtab`, `email`, `tel`, `adress`, `ville`) VALUES
(10, 'ENSA', 'ENSA@gmail.com', 547896325, 'Tanger', 'Tanger'),
(11, 'ECO', 'ECO@gmail.com', 547996254, 'tanger', 'Tanger'),
(14, 'FST', 'FST@gmail.com', 568543655, 'Maroc', 'Martil');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `chargesensperm`
--
ALTER TABLE `chargesensperm`
  ADD PRIMARY KEY (`idCharges`),
  ADD KEY `FK_Ensei_Charge` (`idEnseiCharge`);

--
-- Indexes for table `enseignants`
--
ALTER TABLE `enseignants`
  ADD PRIMARY KEY (`idEnsei`),
  ADD KEY `FK_Etab_Ensei` (`idEtabEnsei`);

--
-- Indexes for table `etablissements`
--
ALTER TABLE `etablissements`
  ADD PRIMARY KEY (`idEtab`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `chargesensperm`
--
ALTER TABLE `chargesensperm`
  MODIFY `idCharges` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=31;

--
-- AUTO_INCREMENT for table `enseignants`
--
ALTER TABLE `enseignants`
  MODIFY `idEnsei` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=25;

--
-- AUTO_INCREMENT for table `etablissements`
--
ALTER TABLE `etablissements`
  MODIFY `idEtab` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=51;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `chargesensperm`
--
ALTER TABLE `chargesensperm`
  ADD CONSTRAINT `FK_Ensei_Charge` FOREIGN KEY (`idEnseiCharge`) REFERENCES `enseignants` (`idEnsei`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `enseignants`
--
ALTER TABLE `enseignants`
  ADD CONSTRAINT `FK_Etab_Ensei` FOREIGN KEY (`idEtabEnsei`) REFERENCES `etablissements` (`idEtab`) ON DELETE CASCADE ON UPDATE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
