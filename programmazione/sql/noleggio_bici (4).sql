-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Creato il: Mag 22, 2024 alle 18:11
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
-- Struttura della tabella `admin`
--

CREATE TABLE `admin` (
  `ID` int(11) NOT NULL,
  `ID_user` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dump dei dati per la tabella `admin`
--

INSERT INTO `admin` (`ID`, `ID_user`) VALUES
(1, 1);

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
-- Struttura della tabella `cliente`
--

CREATE TABLE `cliente` (
  `ID` int(11) NOT NULL,
  `ID_user` int(11) NOT NULL,
  `numero_carta` int(11) NOT NULL,
  `smart_card` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Struttura della tabella `indirizzo`
--

CREATE TABLE `indirizzo` (
  `ID` int(11) NOT NULL,
  `CAP` int(11) NOT NULL,
  `via` varchar(64) NOT NULL,
  `n_civico` int(11) NOT NULL,
  `paese` varchar(32) NOT NULL,
  `regione` varchar(32) NOT NULL,
  `provincia` varchar(32) NOT NULL,
  `lat` decimal(10,7) NOT NULL,
  `lon` decimal(10,7) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dump dei dati per la tabella `indirizzo`
--

INSERT INTO `indirizzo` (`ID`, `CAP`, `via`, `n_civico`, `paese`, `regione`, `provincia`, `lat`, `lon`) VALUES
(13, 20121, 'Via Monte Napoleone', 12, 'Milano', 'Lombardia', 'MI', 45.4670580, 9.1965680),
(14, 20122, 'Corso Venezia', 15, 'Milano', 'Lombardia', 'MI', 45.4677200, 9.2032510),
(15, 20123, 'Piazza del Duomo', 1, 'Milano', 'Lombardia', 'MI', 45.4642030, 9.1918020),
(16, 20124, 'Via Vittor Pisani', 16, 'Milano', 'Lombardia', 'MI', 45.4796810, 9.1979650),
(17, 20125, 'Corso Buenos Aires', 33, 'Milano', 'Lombardia', 'MI', 45.4793490, 9.2040410),
(18, 20126, 'Viale Zara', 56, 'Milano', 'Lombardia', 'MI', 45.4954210, 9.1924400),
(19, 20127, 'Via Padova', 76, 'Milano', 'Lombardia', 'MI', 45.4955720, 9.2243650),
(20, 20128, 'Via Palmanova', 24, 'Milano', 'Lombardia', 'MI', 45.5039950, 9.2390350),
(21, 20129, 'Viale Abruzzi', 11, 'Milano', 'Lombardia', 'MI', 45.4775650, 9.2134900),
(22, 20131, 'Piazza Loreto', 8, 'Milano', 'Lombardia', 'MI', 45.4788040, 9.2161810),
(23, 20132, 'Viale Monza', 120, 'Milano', 'Lombardia', 'MI', 45.5093420, 9.2154220),
(24, 20133, 'Piazza Leonardo da Vinci', 32, 'Milano', 'Lombardia', 'MI', 45.4780150, 9.2272450);

-- --------------------------------------------------------

--
-- Struttura della tabella `operazione`
--

CREATE TABLE `operazione` (
  `ID` int(11) NOT NULL,
  `tipo` enum('noleggio','consegna','','') NOT NULL,
  `data_ora` datetime NOT NULL,
  `tariffa` int(11) DEFAULT NULL,
  `ID_user` int(11) NOT NULL,
  `ID_bicicletta` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Struttura della tabella `stazione`
--

CREATE TABLE `stazione` (
  `ID` int(11) NOT NULL,
  `ID_indirizzo` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dump dei dati per la tabella `stazione`
--

INSERT INTO `stazione` (`ID`, `ID_indirizzo`) VALUES
(32, 13),
(33, 14),
(34, 15),
(35, 16),
(36, 17),
(37, 18),
(38, 19),
(39, 20),
(40, 21),
(41, 22),
(42, 23),
(43, 24);

-- --------------------------------------------------------

--
-- Struttura della tabella `user`
--

CREATE TABLE `user` (
  `ID` int(11) NOT NULL,
  `username` varchar(32) NOT NULL,
  `password` varchar(64) NOT NULL,
  `smart_card` varchar(32) NOT NULL,
  `ID_indirizzo` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dump dei dati per la tabella `user`
--

INSERT INTO `user` (`ID`, `username`, `password`, `smart_card`, `ID_indirizzo`) VALUES
(1, 'admin', '7c6a180b36896a0a8c02787eeafb0e4c', 'admin_smart_cart', 13),
(2, 'client1', 'c1572d05424d0ecb2a65ec6a82aeacbf', 'client1_smart_cart', 14),
(3, 'client2', '3afc79b597f88a72528e864cf81856d2', 'client2_smart_cart', 15),
(4, 'client3', 'fc2921d9057ac44e549efaf0048b2512', 'client3_smart_cart', 16);

--
-- Indici per le tabelle scaricate
--

--
-- Indici per le tabelle `admin`
--
ALTER TABLE `admin`
  ADD PRIMARY KEY (`ID`),
  ADD KEY `ID_user` (`ID_user`);

--
-- Indici per le tabelle `bicicletta`
--
ALTER TABLE `bicicletta`
  ADD PRIMARY KEY (`ID`),
  ADD UNIQUE KEY `numero_seriale` (`numero_seriale`),
  ADD UNIQUE KEY `RFID` (`RFID`);

--
-- Indici per le tabelle `cliente`
--
ALTER TABLE `cliente`
  ADD PRIMARY KEY (`ID`),
  ADD KEY `ID_user` (`ID_user`);

--
-- Indici per le tabelle `indirizzo`
--
ALTER TABLE `indirizzo`
  ADD PRIMARY KEY (`ID`);

--
-- Indici per le tabelle `operazione`
--
ALTER TABLE `operazione`
  ADD PRIMARY KEY (`ID`),
  ADD KEY `ID_user` (`ID_user`,`ID_bicicletta`),
  ADD KEY `ID_bicicletta` (`ID_bicicletta`);

--
-- Indici per le tabelle `stazione`
--
ALTER TABLE `stazione`
  ADD PRIMARY KEY (`ID`),
  ADD KEY `ID_indirizzo` (`ID_indirizzo`);

--
-- Indici per le tabelle `user`
--
ALTER TABLE `user`
  ADD PRIMARY KEY (`ID`),
  ADD UNIQUE KEY `username` (`username`),
  ADD UNIQUE KEY `smart_cart` (`smart_card`),
  ADD KEY `ID_indirizzo` (`ID_indirizzo`);

--
-- AUTO_INCREMENT per le tabelle scaricate
--

--
-- AUTO_INCREMENT per la tabella `admin`
--
ALTER TABLE `admin`
  MODIFY `ID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT per la tabella `bicicletta`
--
ALTER TABLE `bicicletta`
  MODIFY `ID` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT per la tabella `cliente`
--
ALTER TABLE `cliente`
  MODIFY `ID` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT per la tabella `indirizzo`
--
ALTER TABLE `indirizzo`
  MODIFY `ID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=25;

--
-- AUTO_INCREMENT per la tabella `operazione`
--
ALTER TABLE `operazione`
  MODIFY `ID` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT per la tabella `stazione`
--
ALTER TABLE `stazione`
  MODIFY `ID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=44;

--
-- AUTO_INCREMENT per la tabella `user`
--
ALTER TABLE `user`
  MODIFY `ID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- Limiti per le tabelle scaricate
--

--
-- Limiti per la tabella `admin`
--
ALTER TABLE `admin`
  ADD CONSTRAINT `admin_ibfk_1` FOREIGN KEY (`ID_user`) REFERENCES `user` (`ID`) ON DELETE CASCADE;

--
-- Limiti per la tabella `cliente`
--
ALTER TABLE `cliente`
  ADD CONSTRAINT `cliente_ibfk_1` FOREIGN KEY (`ID_user`) REFERENCES `user` (`ID`) ON DELETE CASCADE;

--
-- Limiti per la tabella `operazione`
--
ALTER TABLE `operazione`
  ADD CONSTRAINT `operazione_ibfk_1` FOREIGN KEY (`ID_bicicletta`) REFERENCES `bicicletta` (`ID`),
  ADD CONSTRAINT `operazione_ibfk_2` FOREIGN KEY (`ID_user`) REFERENCES `cliente` (`ID_user`);

--
-- Limiti per la tabella `stazione`
--
ALTER TABLE `stazione`
  ADD CONSTRAINT `stazione_ibfk_1` FOREIGN KEY (`ID_indirizzo`) REFERENCES `indirizzo` (`ID`);

--
-- Limiti per la tabella `user`
--
ALTER TABLE `user`
  ADD CONSTRAINT `user_ibfk_1` FOREIGN KEY (`ID_indirizzo`) REFERENCES `indirizzo` (`ID`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
