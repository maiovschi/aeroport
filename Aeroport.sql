-- phpMyAdmin SQL Dump
-- version 5.0.2
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: May 12, 2020 at 09:47 PM
-- Server version: 10.4.11-MariaDB
-- PHP Version: 7.4.5

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `aeroport`
--

-- --------------------------------------------------------

--
-- Table structure for table `angajati`
--

CREATE TABLE `angajati` (
  `idAngajat` int(11) NOT NULL,
  `nume` varchar(45) DEFAULT NULL,
  `prenume` varchar(45) DEFAULT NULL,
  `email` varchar(45) DEFAULT NULL,
  `cnp` varchar(45) DEFAULT NULL,
  `data_angajare` date DEFAULT NULL,
  `salariu` int(11) DEFAULT NULL,
  `tip_angajat` varchar(50) DEFAULT NULL,
  `calificari` text DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `angajati`
--

INSERT INTO `angajati` (`idAngajat`, `nume`, `prenume`, `email`, `cnp`, `data_angajare`, `salariu`, `tip_angajat`, `calificari`) VALUES
(2, 'Ioana', 'Maio', 'dfsafdsa', 'dsaffas', '2020-05-19', 543252, 'Pilot', '747-200'),
(5, 'Daniel', 'Radoi', 'gfd', '543654', '2020-05-12', 5436, 'Steward', NULL),
(6, 'Mihai', 'Gabriel', 'asfa', 'asga', '2020-05-21', 123, 'Pilot', '737-400'),
(7, 'Ioana', 'Mihai', 'asdu', '54165421', '2020-05-04', 5152, 'Steward', NULL),
(8, 'Robin', 'Coman', 'asd', '123', '2020-05-21', 123, 'Pilot', 'A310'),
(9, 'Alex', 'Dobre', 'ALEX', '65456', '2020-05-21', 45, 'Pilot', 'A210'),
(11, 'Andrei', 'Topana', '32131', '213312', '2020-05-04', 312, 'Pilot', 'A310'),
(12, 'Diana', 'Stoenescu', 'fdsj', '312423', '2020-05-05', 3242, 'Pilot', '747-200'),
(13, 'Adrian', 'Titi', 'fdsj', '4324132', '2020-05-12', 23423, 'Pilot', '737-400'),
(14, 'Andrei', 'Ionescu', '43', '4324', '2020-05-12', 234, 'Pilot', '747-200'),
(15, 'Silviu', 'Popescu', 'dfs', '534', '2020-05-05', 4353, 'Pilot', 'A310'),
(16, 'Mircea', 'Dobre', 'dfsafdfs', '324', '2020-05-05', 2121, 'Pilot', '737-400'),
(17, 'Sorin', 'Mihai', '324', '442342', '2020-05-17', 342, 'Pilot', 'A310'),
(18, 'Popescu', 'Mihai', 'fdsafas', '3242', '2020-05-03', 3232, 'Pilot', 'A210');

-- --------------------------------------------------------

--
-- Table structure for table `avioane`
--

CREATE TABLE `avioane` (
  `idAvion` int(11) NOT NULL,
  `model` varchar(45) DEFAULT NULL,
  `marca` varchar(45) DEFAULT NULL,
  `nume` varchar(45) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `avioane`
--

INSERT INTO `avioane` (`idAvion`, `model`, `marca`, `nume`) VALUES
(1, '747-200', 'boeing', 'mama'),
(2, '737-400', 'boeing', 'suceava'),
(3, 'A310', 'airbus', 'bucuresti'),
(4, 'A210', 'airbus', 'siret');

-- --------------------------------------------------------

--
-- Table structure for table `echipaje`
--

CREATE TABLE `echipaje` (
  `idEchipaj` int(11) NOT NULL,
  `idPilot` int(11) DEFAULT NULL,
  `idCopilot` int(11) DEFAULT NULL,
  `nume` varchar(50) NOT NULL,
  `idSteward1` int(11) DEFAULT NULL,
  `idSteward2` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `echipaje`
--

INSERT INTO `echipaje` (`idEchipaj`, `idPilot`, `idCopilot`, `nume`, `idSteward1`, `idSteward2`) VALUES
(4, 2, 12, 'Echipa test 474-200', 5, 7),
(5, 8, 11, 'echipaj test2', 7, 5);

-- --------------------------------------------------------

--
-- Table structure for table `rute`
--

CREATE TABLE `rute` (
  `idRuta` int(11) NOT NULL,
  `aeroport_plecare` varchar(45) DEFAULT NULL,
  `aeroport_sosire` varchar(45) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `rute`
--

INSERT INTO `rute` (`idRuta`, `aeroport_plecare`, `aeroport_sosire`) VALUES
(1, 'bucuresti', 'oradea'),
(2, 'oradea', 'bucuresti'),
(4, 'bucuresti', 'londra'),
(5, 'londra', 'bucuresti');

-- --------------------------------------------------------

--
-- Table structure for table `zboruri`
--

CREATE TABLE `zboruri` (
  `idZbor` int(11) NOT NULL,
  `idRuta` int(11) NOT NULL,
  `idAvion` int(11) NOT NULL,
  `idEchipaj` int(11) NOT NULL,
  `ora_plecare` datetime DEFAULT NULL,
  `ora_sosire` datetime DEFAULT NULL,
  `Observatii` varchar(45) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `zboruri`
--

INSERT INTO `zboruri` (`idZbor`, `idRuta`, `idAvion`, `idEchipaj`, `ora_plecare`, `ora_sosire`, `Observatii`) VALUES
(2, 1, 1, 4, '2020-05-06 12:56:00', '2020-05-06 23:09:00', 'vreme proasta'),
(3, 2, 1, 4, '2020-05-07 11:54:00', '2020-05-07 03:07:00', 'pista 1 in revizie');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `angajati`
--
ALTER TABLE `angajati`
  ADD PRIMARY KEY (`idAngajat`);

--
-- Indexes for table `avioane`
--
ALTER TABLE `avioane`
  ADD PRIMARY KEY (`idAvion`);

--
-- Indexes for table `echipaje`
--
ALTER TABLE `echipaje`
  ADD PRIMARY KEY (`idEchipaj`),
  ADD KEY `pilot_fk` (`idPilot`),
  ADD KEY `copilot_fk` (`idCopilot`),
  ADD KEY `s1_fk` (`idSteward1`),
  ADD KEY `s2_fk` (`idSteward2`);

--
-- Indexes for table `rute`
--
ALTER TABLE `rute`
  ADD PRIMARY KEY (`idRuta`);

--
-- Indexes for table `zboruri`
--
ALTER TABLE `zboruri`
  ADD PRIMARY KEY (`idZbor`),
  ADD KEY `echipaj_fk` (`idEchipaj`),
  ADD KEY `avion_fk` (`idAvion`),
  ADD KEY `ruta_fk` (`idRuta`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `angajati`
--
ALTER TABLE `angajati`
  MODIFY `idAngajat` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=19;

--
-- AUTO_INCREMENT for table `avioane`
--
ALTER TABLE `avioane`
  MODIFY `idAvion` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `echipaje`
--
ALTER TABLE `echipaje`
  MODIFY `idEchipaj` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `rute`
--
ALTER TABLE `rute`
  MODIFY `idRuta` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `zboruri`
--
ALTER TABLE `zboruri`
  MODIFY `idZbor` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `echipaje`
--
ALTER TABLE `echipaje`
  ADD CONSTRAINT `copilot_fk` FOREIGN KEY (`idCopilot`) REFERENCES `angajati` (`idAngajat`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  ADD CONSTRAINT `pilot_fk` FOREIGN KEY (`idPilot`) REFERENCES `angajati` (`idAngajat`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  ADD CONSTRAINT `s1_fk` FOREIGN KEY (`idSteward1`) REFERENCES `angajati` (`idAngajat`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  ADD CONSTRAINT `s2_fk` FOREIGN KEY (`idSteward2`) REFERENCES `angajati` (`idAngajat`) ON DELETE NO ACTION ON UPDATE NO ACTION;

--
-- Constraints for table `zboruri`
--
ALTER TABLE `zboruri`
  ADD CONSTRAINT `avion_fk` FOREIGN KEY (`idAvion`) REFERENCES `avioane` (`idAvion`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  ADD CONSTRAINT `echipaj_fk` FOREIGN KEY (`idEchipaj`) REFERENCES `echipaje` (`idEchipaj`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  ADD CONSTRAINT `ruta_fk` FOREIGN KEY (`idRuta`) REFERENCES `rute` (`idRuta`) ON DELETE NO ACTION ON UPDATE NO ACTION;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
