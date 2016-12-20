-- phpMyAdmin SQL Dump
-- version 4.3.11
-- http://www.phpmyadmin.net
--
-- Host: 127.0.0.1
-- Generation Time: Mar 31, 2016 alle 09:16
-- Versione del server: 5.6.24
-- PHP Version: 5.6.8

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;

--
-- Database: `libretto`
--

-- --------------------------------------------------------

--
-- Struttura della tabella `admin`
--

CREATE TABLE IF NOT EXISTS `admin` (
  `PK_id` int(11) NOT NULL,
  `nome` varchar(50) NOT NULL,
  `cognome` varchar(50) NOT NULL,
  `username` varchar(50) NOT NULL,
  `password` varchar(32) NOT NULL
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8;

--
-- Dump dei dati per la tabella `admin`
--

INSERT INTO `admin` (`PK_id`, `nome`, `cognome`, `username`, `password`) VALUES
(1, 'Mario', 'Rossi', 'nimda', 'da7ade0712cb6417beb45550334bda18');

-- --------------------------------------------------------

--
-- Struttura della tabella `corsi`
--

CREATE TABLE IF NOT EXISTS `corsi` (
  `PK_id` int(11) NOT NULL,
  `nome` varchar(100) NOT NULL,
  `cfu` tinyint(4) NOT NULL DEFAULT '6',
  `anno` tinyint(4) NOT NULL,
  `FK_laurea` int(11) DEFAULT NULL,
  `FK_docente1` int(11) DEFAULT NULL,
  `FK_docente2` int(11) DEFAULT NULL
) ENGINE=InnoDB AUTO_INCREMENT=36 DEFAULT CHARSET=utf8;

--
-- Dump dei dati per la tabella `corsi`
--

INSERT INTO `corsi` (`PK_id`, `nome`, `cfu`, `anno`, `FK_laurea`, `FK_docente1`, `FK_docente2`) VALUES
(1, 'Analisi Matematica', 12, 1, 1, 1, NULL),
(2, 'Matematica Discreta', 12, 1, 1, 14, NULL),
(3, 'Architettura degli elaboratori e laboratorio', 12, 1, 1, 2, NULL),
(4, 'Fisica', 6, 1, 1, 7, NULL),
(5, 'Programmazione e laboratorio', 12, 1, 1, 15, NULL),
(6, 'Algoritmi e strutture dati e laboratorio', 12, 2, 1, 4, NULL),
(7, 'Calcolo delle probabilità e statistica', 6, 2, 1, 5, NULL),
(8, 'Calcolo scientifico', 6, 2, 1, 6, NULL),
(9, 'Fondamenti dell''informatica', 9, 2, 1, 8, NULL),
(10, 'Logica matematica', 6, 2, 1, 12, NULL),
(11, 'Programmazione orientata agli oggetti', 9, 2, 1, 13, NULL),
(12, 'Sistemi operativi e laboratorio', 12, 2, 1, 17, 18),
(13, 'Basi di dati', 9, 3, 1, 3, NULL),
(14, 'Ingegneria del software', 6, 3, 1, 9, NULL),
(15, 'Interazione uomo-macchina', 6, 3, 1, 10, NULL),
(16, 'Linguaggi di programmazione', 9, 3, 1, 11, NULL),
(17, 'Reti di calcolatori', 9, 3, 1, 16, NULL),
(18, 'Algebra lineare', 6, 1, 2, 19, NULL),
(19, 'Analisi matematica', 12, 1, 2, 1, NULL),
(20, 'Architettura degli elaboratori', 6, 1, 2, 2, NULL),
(21, 'Matematica di base e logica', 6, 1, 2, 19, NULL),
(22, 'Programmazione e laboratorio', 12, 1, 2, 22, NULL),
(23, 'Tecnologie Web e laboratorio', 9, 1, 2, 25, NULL),
(24, 'Algoritmi e strutture dati e laboratorio', 12, 2, 2, 4, NULL),
(25, 'Complementi di tecnologie Web', 9, 2, 2, 18, 20),
(26, 'Programmazione orientata agli oggetti', 6, 2, 2, 23, NULL),
(27, 'Psicologia della comunicazione', 6, 2, 2, 24, NULL),
(28, 'Sistemi multimediali e laboratorio', 12, 2, 2, 25, NULL),
(29, 'Sistemi operativi', 6, 2, 2, 17, 18),
(30, 'Statistica applicata', 6, 2, 2, 26, NULL),
(31, 'Basi di dati', 9, 3, 2, 3, NULL),
(32, 'Interazione uomo-macchina', 6, 3, 2, 10, NULL),
(33, 'Reti di calcolatori', 9, 3, 2, 16, NULL),
(34, 'Progetto di siti e portali web', 6, 3, 2, 13, NULL),
(35, 'Immagini e multimedialità', 9, 3, 2, 21, NULL);

-- --------------------------------------------------------

--
-- Struttura della tabella `docenti`
--

CREATE TABLE IF NOT EXISTS `docenti` (
  `PK_id` int(11) NOT NULL,
  `nome` varchar(50) NOT NULL,
  `cognome` varchar(50) NOT NULL
) ENGINE=InnoDB AUTO_INCREMENT=27 DEFAULT CHARSET=utf8;

--
-- Dump dei dati per la tabella `docenti`
--

INSERT INTO `docenti` (`PK_id`, `nome`, `cognome`) VALUES
(1, 'Gianluca', 'Gorni'),
(2, 'Pietro', 'Di Gianantonio'),
(3, 'Angelo', 'Montanari'),
(4, 'Carla', 'Piazza'),
(5, 'Luigi', 'Pace'),
(6, 'Rossana', 'Vermiglio'),
(7, 'Lorenzo', 'Santi'),
(8, 'Agostino', 'Dovier'),
(9, 'Carlo', 'Tasso'),
(10, 'Luca', 'Chittaro'),
(11, 'Marco', 'Comini'),
(12, 'Alberto', 'Marcone'),
(13, 'Giorgio', 'Brajnik'),
(14, 'Giuseppe', 'Lancia'),
(15, 'Claudio', 'Mirolo'),
(16, 'Marino', 'Miculan'),
(17, 'Marina', 'Lenisa'),
(18, 'Ivan', 'Scagnetto'),
(19, 'Giovanna', 'D''Agostino'),
(20, 'Stefano', 'Burigat'),
(21, 'Vito', 'Roberto'),
(22, 'Stefano', 'Mizzaro'),
(23, 'Federico', 'Fontana'),
(24, 'Alan', 'Mattiassi'),
(25, 'Elio', 'Toppano'),
(26, 'Paolo', 'Vidoni');

-- --------------------------------------------------------

--
-- Struttura della tabella `esami`
--

CREATE TABLE IF NOT EXISTS `esami` (
  `PK_id` int(11) NOT NULL,
  `FK_corso` int(11) NOT NULL,
  `FK_studente` char(11) NOT NULL,
  `voto` tinyint(4) DEFAULT NULL,
  `lode` tinyint(1) DEFAULT NULL,
  `data` date DEFAULT NULL,
  `FK_admin` int(11) NOT NULL
) ENGINE=InnoDB AUTO_INCREMENT=7 DEFAULT CHARSET=utf8;

--
-- Dump dei dati per la tabella `esami`
--

INSERT INTO `esami` (`PK_id`, `FK_corso`, `FK_studente`, `voto`, `lode`, `data`, `FK_admin`) VALUES
(1, 1, '000001', 30, 0, '2016-02-05', 1),
(2, 2, '000001', 30, 1, '2016-01-27', 1),
(3, 5, '000002', 27, 0, '2015-01-25', 1),
(4, 3, '000003', 21, 0, '2015-07-17', 1),
(5, 23, '000004', 28, 0, '2015-07-15', 1),
(6, 18, '000001', 30, 1, '2014-07-12', 1);

-- --------------------------------------------------------

--
-- Struttura della tabella `lauree`
--

CREATE TABLE IF NOT EXISTS `lauree` (
  `PK_id` int(11) NOT NULL,
  `nome` varchar(100) NOT NULL,
  `anni` tinyint(4) NOT NULL
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=utf8;

--
-- Dump dei dati per la tabella `lauree`
--

INSERT INTO `lauree` (`PK_id`, `nome`, `anni`) VALUES
(1, 'Informatica', 3),
(2, 'TWM', 3);

-- --------------------------------------------------------

--
-- Struttura della tabella `studenti`
--

CREATE TABLE IF NOT EXISTS `studenti` (
  `matricola` char(6) NOT NULL,
  `FK_laurea` int(11) NOT NULL DEFAULT '1',
  `nome` varchar(50) NOT NULL,
  `cognome` varchar(50) NOT NULL,
  `data_nascita` date NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dump dei dati per la tabella `studenti`
--

INSERT INTO `studenti` (`matricola`, `FK_laurea`, `nome`, `cognome`, `data_nascita`) VALUES
('000001', 1, 'Gianni', 'Verdi', '1996-03-16'),
('000002', 1, 'Paolo', 'Bianchi', '1998-07-29'),
('000003', 1, 'Alessandra', 'Rossi', '1995-08-26'),
('000004', 2, 'Sandro', 'Gialli', '1997-05-29'),
('000005', 2, 'Lisa', 'Verdi', '1989-05-12');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `admin`
--
ALTER TABLE `admin`
  ADD PRIMARY KEY (`PK_id`);

--
-- Indexes for table `corsi`
--
ALTER TABLE `corsi`
  ADD PRIMARY KEY (`PK_id`), ADD KEY `corsi_ibfk_1` (`FK_laurea`), ADD KEY `corsi_ibfk_2` (`FK_docente1`), ADD KEY `corsi_ibfk_3` (`FK_docente2`);

--
-- Indexes for table `docenti`
--
ALTER TABLE `docenti`
  ADD PRIMARY KEY (`PK_id`);

--
-- Indexes for table `esami`
--
ALTER TABLE `esami`
  ADD PRIMARY KEY (`PK_id`), ADD KEY `esami_ibfk_1` (`FK_corso`), ADD KEY `esami_ibfk_2` (`FK_studente`), ADD KEY `esami_ibfk_3` (`FK_admin`);

--
-- Indexes for table `lauree`
--
ALTER TABLE `lauree`
  ADD PRIMARY KEY (`PK_id`);

--
-- Indexes for table `studenti`
--
ALTER TABLE `studenti`
  ADD PRIMARY KEY (`matricola`), ADD KEY `studenti_ibfk_1` (`FK_laurea`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `admin`
--
ALTER TABLE `admin`
  MODIFY `PK_id` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=2;
--
-- AUTO_INCREMENT for table `corsi`
--
ALTER TABLE `corsi`
  MODIFY `PK_id` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=36;
--
-- AUTO_INCREMENT for table `docenti`
--
ALTER TABLE `docenti`
  MODIFY `PK_id` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=27;
--
-- AUTO_INCREMENT for table `esami`
--
ALTER TABLE `esami`
  MODIFY `PK_id` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=7;
--
-- AUTO_INCREMENT for table `lauree`
--
ALTER TABLE `lauree`
  MODIFY `PK_id` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=3;
--
-- Limiti per le tabelle scaricate
--

--
-- Limiti per la tabella `corsi`
--
ALTER TABLE `corsi`
ADD CONSTRAINT `corsi_ibfk_1` FOREIGN KEY (`FK_laurea`) REFERENCES `lauree` (`PK_id`) ON DELETE CASCADE ON UPDATE CASCADE,
ADD CONSTRAINT `corsi_ibfk_2` FOREIGN KEY (`FK_docente1`) REFERENCES `docenti` (`PK_id`) ON DELETE CASCADE ON UPDATE CASCADE,
ADD CONSTRAINT `corsi_ibfk_3` FOREIGN KEY (`FK_docente2`) REFERENCES `docenti` (`PK_id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Limiti per la tabella `esami`
--
ALTER TABLE `esami`
ADD CONSTRAINT `esami_ibfk_1` FOREIGN KEY (`FK_corso`) REFERENCES `corsi` (`PK_id`) ON DELETE CASCADE ON UPDATE CASCADE,
ADD CONSTRAINT `esami_ibfk_2` FOREIGN KEY (`FK_studente`) REFERENCES `studenti` (`matricola`) ON DELETE CASCADE ON UPDATE CASCADE,
ADD CONSTRAINT `esami_ibfk_3` FOREIGN KEY (`FK_admin`) REFERENCES `admin` (`PK_id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Limiti per la tabella `studenti`
--
ALTER TABLE `studenti`
ADD CONSTRAINT `studenti_ibfk_1` FOREIGN KEY (`FK_laurea`) REFERENCES `lauree` (`PK_id`) ON DELETE CASCADE ON UPDATE CASCADE;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
