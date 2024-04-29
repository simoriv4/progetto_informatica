-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Creato il: Apr 30, 2024 alle 00:02
-- Versione del server: 10.4.32-MariaDB
-- Versione PHP: 8.2.12

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `noleggio_bici`
--

-- --------------------------------------------------------

--
-- Struttura della tabella `bicicletta`
--

CREATE TABLE `bicicletta` (
  `ID` int(11) NOT NULL,
  `numero_seriale` int(11) NOT NULL,
  `marca` varchar(32) NOT NULL,
  `codice_GPS` varchar(32) NOT NULL,
  `is_locked` tinyint(1) NOT NULL,
  `RFID` varchar(32) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Struttura della tabella `consegna`
--

CREATE TABLE `consegna` (
  `ID` int(11) NOT NULL,
  `ID_noleggio` int(11) NOT NULL,
  `data` date NOT NULL,
  `ora` time NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Struttura della tabella `lettura_bici`
--

CREATE TABLE `lettura_bici` (
  `ID_RFID` int(11) NOT NULL,
  `ID_bicicletta` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Struttura della tabella `noleggio`
--

CREATE TABLE `noleggio` (
  `ID` int(11) NOT NULL,
  `ID_user` int(11) NOT NULL,
  `data` date NOT NULL,
  `stazione_noelggio` varchar(32) NOT NULL,
  `ora` time NOT NULL,
  `ID_bicicletta` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Struttura della tabella `rfid_reader`
--

CREATE TABLE `rfid_reader` (
  `ID` int(11) NOT NULL,
  `numero_slot` int(11) NOT NULL,
  `is_free` tinyint(1) NOT NULL,
  `sede` varchar(32) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Struttura della tabella `user`
--

CREATE TABLE `user` (
  `ID` int(11) NOT NULL,
  `username` varchar(32) NOT NULL,
  `password` varchar(64) NOT NULL,
  `is_admin` tinyint(1) NOT NULL,
  `carta_credito` decimal(16,0) NOT NULL,
  `via` varchar(64) NOT NULL,
  `paese` varchar(32) NOT NULL,
  `n_civico` int(11) NOT NULL,
  `smart_cart` varchar(32) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Indici per le tabelle scaricate
--

--
-- Indici per le tabelle `bicicletta`
--
ALTER TABLE `bicicletta`
  ADD PRIMARY KEY (`ID`),
  ADD UNIQUE KEY `numero_seriale` (`numero_seriale`),
  ADD UNIQUE KEY `RFID` (`RFID`);

--
-- Indici per le tabelle `consegna`
--
ALTER TABLE `consegna`
  ADD PRIMARY KEY (`ID`),
  ADD KEY `ID_noleggio` (`ID_noleggio`);

--
-- Indici per le tabelle `lettura_bici`
--
ALTER TABLE `lettura_bici`
  ADD KEY `ID_RFID` (`ID_RFID`,`ID_bicicletta`),
  ADD KEY `ID_bicicletta` (`ID_bicicletta`);

--
-- Indici per le tabelle `noleggio`
--
ALTER TABLE `noleggio`
  ADD PRIMARY KEY (`ID`),
  ADD KEY `ID_user` (`ID_user`),
  ADD KEY `ID_bicicletta` (`ID_bicicletta`);

--
-- Indici per le tabelle `rfid_reader`
--
ALTER TABLE `rfid_reader`
  ADD PRIMARY KEY (`ID`);

--
-- Indici per le tabelle `user`
--
ALTER TABLE `user`
  ADD PRIMARY KEY (`ID`),
  ADD UNIQUE KEY `username` (`username`),
  ADD UNIQUE KEY `smart_cart` (`smart_cart`);

--
-- AUTO_INCREMENT per le tabelle scaricate
--

--
-- AUTO_INCREMENT per la tabella `bicicletta`
--
ALTER TABLE `bicicletta`
  MODIFY `ID` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT per la tabella `consegna`
--
ALTER TABLE `consegna`
  MODIFY `ID` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT per la tabella `noleggio`
--
ALTER TABLE `noleggio`
  MODIFY `ID` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT per la tabella `rfid_reader`
--
ALTER TABLE `rfid_reader`
  MODIFY `ID` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT per la tabella `user`
--
ALTER TABLE `user`
  MODIFY `ID` int(11) NOT NULL AUTO_INCREMENT;

--
-- Limiti per le tabelle scaricate
--

--
-- Limiti per la tabella `consegna`
--
ALTER TABLE `consegna`
  ADD CONSTRAINT `consegna_ibfk_1` FOREIGN KEY (`ID_noleggio`) REFERENCES `noleggio` (`ID`);

--
-- Limiti per la tabella `lettura_bici`
--
ALTER TABLE `lettura_bici`
  ADD CONSTRAINT `lettura_bici_ibfk_1` FOREIGN KEY (`ID_RFID`) REFERENCES `rfid_reader` (`ID`),
  ADD CONSTRAINT `lettura_bici_ibfk_2` FOREIGN KEY (`ID_bicicletta`) REFERENCES `bicicletta` (`ID`);

--
-- Limiti per la tabella `noleggio`
--
ALTER TABLE `noleggio`
  ADD CONSTRAINT `noleggio_ibfk_2` FOREIGN KEY (`ID_user`) REFERENCES `user` (`ID`),
  ADD CONSTRAINT `noleggio_ibfk_3` FOREIGN KEY (`ID_bicicletta`) REFERENCES `bicicletta` (`ID`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
