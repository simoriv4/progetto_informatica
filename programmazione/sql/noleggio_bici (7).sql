-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Creato il: Mag 23, 2024 alle 23:56
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
(1, 1),
(2, 5),
(3, 6),
(4, 7),
(5, 8),
(6, 9),
(7, 10),
(8, 11),
(9, 12),
(10, 13);

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

--
-- Dump dei dati per la tabella `bicicletta`
--

INSERT INTO `bicicletta` (`ID`, `numero_seriale`, `marca`, `codice_GPS`, `is_locked`, `RFID`) VALUES
(1, 1234567890, 'bianchi', '4567098767', 1, 'G000001');

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

--
-- Dump dei dati per la tabella `cliente`
--

INSERT INTO `cliente` (`ID`, `ID_user`, `numero_carta`, `smart_card`) VALUES
(1, 14, 34567890, 712072);

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
(24, 20133, 'Piazza Leonardo da Vinci', 32, 'Milano', 'Lombardia', 'MI', 45.4780150, 9.2272450),
(25, 22045, 'Cesare Battisti', 40, 'Lambrugo', 'Lombardia', 'Como', 45.7635144, 9.2399504),
(26, 22066, 'Santa Caterina da Siena', 3, 'Mariano Comense', 'Lombardia', 'Como', 45.6871025, 9.1798586),
(27, 22045, 'Roma', 20, 'Lambrugo', 'Lombradia', 'Como', 45.7603710, 9.2415671),
(28, 22045, 'Roma', 29, 'Lambrugo', 'Lombradia', 'Como', 45.7603710, 9.2415671),
(29, 22045, 'Stoppanni', 2, 'lambrugo', 'Lombradia', 'como', 45.7574019, 9.2418510),
(30, 22045, 'stoppani', 2, 'lambrugo', 'lombardia', 'como', 45.7574019, 9.2418510),
(31, 22045, 'roma', 3, 'lambrugo', 'lomabrdia', 'como', 45.7603710, 9.2415671),
(32, 20100, 'Via 8422', 2, 'Milano', 'Lombardia', 'MI', 45.4737719, 9.2266430),
(33, 20100, 'Via 4031', 30, 'Milano', 'Lombardia', 'MI', 45.4797911, 9.2204343),
(34, 20100, 'Via 6076', 41, 'Milano', 'Lombardia', 'MI', 45.4714500, 9.1953833),
(35, 20100, 'Via 4588', 25, 'Milano', 'Lombardia', 'MI', 45.4816404, 9.2489412),
(36, 20100, 'Via 7440', 31, 'Milano', 'Lombardia', 'MI', 45.4820828, 9.2399435),
(37, 20100, 'Via 4138', 63, 'Milano', 'Lombardia', 'MI', 45.4823330, 9.2440656),
(38, 20100, 'Via 7633', 91, 'Milano', 'Lombardia', 'MI', 45.4904017, 9.1867748),
(39, 20100, 'Via 144', 21, 'Milano', 'Lombardia', 'MI', 45.4891441, 9.1822150),
(40, 20100, 'Via 62', 98, 'Milano', 'Lombardia', 'MI', 45.4906836, 9.2442766),
(41, 20100, 'Via 1906', 29, 'Milano', 'Lombardia', 'MI', 45.4877950, 9.2223239),
(42, 20100, 'Via 9013', 94, 'Milano', 'Lombardia', 'MI', 45.4951468, 9.2204474),
(43, 20100, 'Via 5683', 26, 'Milano', 'Lombardia', 'MI', 45.4812791, 9.2430435),
(44, 20100, 'Via 7980', 91, 'Milano', 'Lombardia', 'MI', 45.4933605, 9.2113975),
(45, 20100, 'Via 3633', 75, 'Milano', 'Lombardia', 'MI', 45.4743037, 9.2196231),
(46, 20100, 'Via 8052', 76, 'Milano', 'Lombardia', 'MI', 45.4635636, 9.1921179),
(47, 20100, 'Via 2421', 60, 'Milano', 'Lombardia', 'MI', 45.4788858, 9.2196083),
(48, 20100, 'Via 2038', 42, 'Milano', 'Lombardia', 'MI', 45.4746459, 9.2214789),
(49, 20100, 'Via 5047', 87, 'Milano', 'Lombardia', 'MI', 45.4817597, 9.1888874),
(50, 20100, 'Via 4042', 1, 'Milano', 'Lombardia', 'MI', 45.4853329, 9.1910657),
(51, 20100, 'Via 694', 90, 'Milano', 'Lombardia', 'MI', 45.4991190, 9.1952977),
(52, 20100, 'Via 1960', 16, 'Milano', 'Lombardia', 'MI', 45.4655290, 9.1950376),
(53, 20100, 'Via 7731', 66, 'Milano', 'Lombardia', 'MI', 45.4861088, 9.1999705),
(54, 20100, 'Via 984', 47, 'Milano', 'Lombardia', 'MI', 45.4794248, 9.1816242),
(55, 20100, 'Via 5760', 66, 'Milano', 'Lombardia', 'MI', 45.4690466, 9.1907348),
(56, 20100, 'Via 7665', 9, 'Milano', 'Lombardia', 'MI', 45.4992541, 9.2249337),
(57, 20100, 'Via 6541', 27, 'Milano', 'Lombardia', 'MI', 45.4760694, 9.1948539),
(58, 20100, 'Via 5992', 86, 'Milano', 'Lombardia', 'MI', 45.4856933, 9.2251013),
(59, 20100, 'Via 163', 30, 'Milano', 'Lombardia', 'MI', 45.4815889, 9.2370519),
(60, 20100, 'Via 4583', 46, 'Milano', 'Lombardia', 'MI', 45.4933906, 9.2364142),
(61, 20100, 'Via 9822', 53, 'Milano', 'Lombardia', 'MI', 45.4683479, 9.2127331),
(62, 20100, 'Via 5058', 72, 'Milano', 'Lombardia', 'MI', 45.4662839, 9.2254664),
(63, 20100, 'Via 2088', 78, 'Milano', 'Lombardia', 'MI', 45.4973187, 9.2035147),
(64, 20100, 'Via 6176', 89, 'Milano', 'Lombardia', 'MI', 45.4758324, 9.2035828),
(65, 20100, 'Via 3229', 50, 'Milano', 'Lombardia', 'MI', 45.4789841, 9.2417283),
(66, 20100, 'Via 371', 99, 'Milano', 'Lombardia', 'MI', 45.4712519, 9.2115283),
(67, 20100, 'Via 1765', 41, 'Milano', 'Lombardia', 'MI', 45.4875784, 9.1956029),
(68, 20100, 'Via 1913', 5, 'Milano', 'Lombardia', 'MI', 45.4824748, 9.2269709),
(69, 20100, 'Via 3822', 67, 'Milano', 'Lombardia', 'MI', 45.4733687, 9.2263916),
(70, 20100, 'Via 9977', 32, 'Milano', 'Lombardia', 'MI', 45.4826774, 9.2431109),
(71, 20100, 'Via 9619', 81, 'Milano', 'Lombardia', 'MI', 45.4732341, 9.1963028),
(72, 20100, 'Via 4499', 18, 'Milano', 'Lombardia', 'MI', 45.4664377, 9.2002255),
(73, 20100, 'Via 3846', 97, 'Milano', 'Lombardia', 'MI', 45.4976973, 9.2378632),
(74, 20100, 'Via 381', 31, 'Milano', 'Lombardia', 'MI', 45.4619634, 9.2029645),
(75, 20100, 'Via 8745', 50, 'Milano', 'Lombardia', 'MI', 45.4792460, 9.2448577),
(76, 20100, 'Via 3891', 19, 'Milano', 'Lombardia', 'MI', 45.4666643, 9.1985713),
(77, 20100, 'Via 4364', 83, 'Milano', 'Lombardia', 'MI', 45.4735034, 9.1945478),
(78, 20100, 'Via 9733', 3, 'Milano', 'Lombardia', 'MI', 45.4803358, 9.2123997),
(79, 20100, 'Via 4549', 79, 'Milano', 'Lombardia', 'MI', 45.4822733, 9.2091852),
(80, 20100, 'Via 3615', 42, 'Milano', 'Lombardia', 'MI', 45.4927992, 9.2400203),
(81, 20100, 'Via 9720', 83, 'Milano', 'Lombardia', 'MI', 45.4825532, 9.2036231);

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

--
-- Dump dei dati per la tabella `operazione`
--

INSERT INTO `operazione` (`ID`, `tipo`, `data_ora`, `tariffa`, `ID_user`, `ID_bicicletta`) VALUES
(5, 'noleggio', '2024-05-23 12:00:00', 10, 14, 1),
(6, 'consegna', '2024-05-23 14:00:00', 0, 14, 1),
(7, 'noleggio', '2024-05-24 10:00:00', 15, 14, 1),
(8, 'consegna', '2024-05-24 12:00:00', 0, 14, 1);

-- --------------------------------------------------------

--
-- Struttura della tabella `stazione`
--

CREATE TABLE `stazione` (
  `ID` int(11) NOT NULL,
  `nome` varchar(32) NOT NULL,
  `numero_slot` int(11) NOT NULL,
  `ID_indirizzo` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dump dei dati per la tabella `stazione`
--

INSERT INTO `stazione` (`ID`, `nome`, `numero_slot`, `ID_indirizzo`) VALUES
(290, 'Stazione 2', 15, 33),
(291, 'Stazione 3', 14, 32),
(292, 'Stazione 4', 5, 81),
(293, 'Stazione 5', 21, 44),
(294, 'Stazione 6', 9, 42),
(295, 'Stazione 7', 16, 51),
(296, 'Stazione 8', 7, 17),
(297, 'Stazione 9', 16, 69),
(298, 'Stazione 10', 18, 15),
(299, 'Stazione 11', 20, 19),
(300, 'Stazione 12', 7, 52),
(301, 'Stazione 13', 13, 62),
(302, 'Stazione 14', 22, 61),
(303, 'Stazione 15', 5, 36),
(304, 'Stazione 16', 6, 64),
(305, 'Stazione 17', 23, 20),
(306, 'Stazione 18', 15, 49),
(307, 'Stazione 19', 10, 65),
(308, 'Stazione 20', 19, 67),
(309, 'Stazione 21', 5, 50),
(310, 'Stazione 22', 18, 73),
(311, 'Stazione 23', 11, 45),
(312, 'Stazione 24', 24, 23),
(313, 'Stazione 25', 19, 76),
(314, 'Stazione 26', 6, 79),
(315, 'Stazione 27', 23, 38),
(316, 'Stazione 28', 21, 46),
(317, 'Stazione 29', 22, 80),
(318, 'Stazione 30', 14, 57),
(319, 'Stazione 31', 20, 18),
(320, 'Stazione 32', 11, 48),
(321, 'Stazione 33', 16, 63),
(322, 'Stazione 34', 12, 56),
(323, 'Stazione 35', 14, 41),
(324, 'Stazione 36', 23, 66),
(325, 'Stazione 37', 18, 53),
(326, 'Stazione 38', 13, 75),
(327, 'Stazione 39', 18, 22),
(328, 'Stazione 40', 14, 78),
(329, 'Stazione 41', 19, 68),
(330, 'Stazione 42', 17, 16),
(331, 'Stazione 43', 24, 21),
(332, 'Stazione 44', 19, 34),
(333, 'Stazione 45', 15, 37),
(334, 'Stazione 46', 10, 55),
(335, 'Stazione 47', 14, 72),
(336, 'Stazione 48', 8, 77),
(337, 'Stazione 49', 23, 71),
(338, 'Stazione 50', 13, 13);

-- --------------------------------------------------------

--
-- Struttura della tabella `user`
--

CREATE TABLE `user` (
  `ID` int(11) NOT NULL,
  `username` varchar(32) NOT NULL,
  `password` varchar(64) NOT NULL,
  `nome` varchar(32) NOT NULL,
  `cognome` varchar(32) NOT NULL,
  `smart_card` varchar(32) NOT NULL,
  `ID_indirizzo` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dump dei dati per la tabella `user`
--

INSERT INTO `user` (`ID`, `username`, `password`, `nome`, `cognome`, `smart_card`, `ID_indirizzo`) VALUES
(1, 'admin', '7c6a180b36896a0a8c02787eeafb0e4c', 'Mario', 'Rossi', 'admin_smart_cart', 13),
(2, 'client1', 'c1572d05424d0ecb2a65ec6a82aeacbf', 'Luca', 'Verdi', 'client1_smart_cart', 14),
(3, 'client2', '3afc79b597f88a72528e864cf81856d2', 'Giuseppe', 'Breviario', 'client2_smart_cart', 15),
(4, 'client3', 'fc2921d9057ac44e549efaf0048b2512', 'Luca', 'Sbesh', 'client3_smart_cart', 16),
(5, 'a', '0cc175b9c0f1b6a831c399e269772661', 'Simone', 'Riva', '506096', 25),
(6, 'b', '92eb5ffee6ae2fec3ad71c777531578f', 'b', 'b', '281128', 25),
(7, 'c', '4a8a08f09d37b73795649038408b5f33', 'c', 'c', '971812', 26),
(8, 'd', '8277e0910d750195b448797616e091ad', 'd', 'd', '069922', 26),
(9, 'v', '9e3669d19b675bd57058fd4664205d2a', 'v', 'v', '351429', 27),
(10, 't', 'e358efa489f58062f10dd7316b65649e', 't', 't', '004941', 28),
(11, 'p', '83878c91171338902e0fe0fb97a8c47a', 'p', 'p', '662382', 28),
(12, 'h', '2510c39011c5be704182423e3a695e91', 'h', 'h', '757101', 29),
(13, 'o', 'd95679752134a2d9eb61dbd7b91c4bcc', 'o', 'o', '637777', 30),
(14, 'j', '363b122c528f54df4a0446b6bab05515', 'j', 'jj', '712072', 31);

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
  ADD UNIQUE KEY `ID_indirizzo_2` (`ID_indirizzo`),
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
  MODIFY `ID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;

--
-- AUTO_INCREMENT per la tabella `bicicletta`
--
ALTER TABLE `bicicletta`
  MODIFY `ID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT per la tabella `cliente`
--
ALTER TABLE `cliente`
  MODIFY `ID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT per la tabella `indirizzo`
--
ALTER TABLE `indirizzo`
  MODIFY `ID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=95;

--
-- AUTO_INCREMENT per la tabella `operazione`
--
ALTER TABLE `operazione`
  MODIFY `ID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- AUTO_INCREMENT per la tabella `stazione`
--
ALTER TABLE `stazione`
  MODIFY `ID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=352;

--
-- AUTO_INCREMENT per la tabella `user`
--
ALTER TABLE `user`
  MODIFY `ID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=15;

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
