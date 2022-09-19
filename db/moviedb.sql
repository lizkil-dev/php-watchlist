-- phpMyAdmin SQL Dump
-- version 5.2.0
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Erstellungszeit: 19. Sep 2022 um 15:47
-- Server-Version: 10.4.24-MariaDB
-- PHP-Version: 8.1.6

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Datenbank: `moviedb`
--

-- --------------------------------------------------------

--
-- Tabellenstruktur für Tabelle `actors`
--

CREATE TABLE `actors` (
  `actorID` int(4) NOT NULL,
  `actorname` varchar(20) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Daten für Tabelle `actors`
--

INSERT INTO `actors` (`actorID`, `actorname`) VALUES
(11934, ''),
(3, 'Antonio Banderas'),
(11933, 'Bill Murray'),
(11845, 'Charlbi Dean'),
(11942, 'Charlotte Rampling'),
(11957, 'Dakota Johnson'),
(5, 'Emma Stone'),
(11938, 'Firtz'),
(11927, 'Gerda'),
(11844, 'Harris Dickinson'),
(1, 'Olivia Colman'),
(2, 'Penelope Cruz'),
(4, 'Rachel Weisz'),
(11931, 'Russel Crowe'),
(11947, 'Tuomo Harrelson'),
(11932, 'Viggo Mortensen'),
(11941, 'Virginie Efira'),
(11846, 'Woody Harrelson'),
(11930, 'Zac Efron');

-- --------------------------------------------------------

--
-- Tabellenstruktur für Tabelle `cast`
--

CREATE TABLE `cast` (
  `movieFK` int(4) NOT NULL,
  `actorFK` int(4) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Daten für Tabelle `cast`
--

INSERT INTO `cast` (`movieFK`, `actorFK`) VALUES
(169, 5),
(169, 4),
(128, 11930),
(128, 11931),
(128, 11932),
(128, 11933),
(76, 11941),
(76, 11942),
(170, 11844),
(170, 11845),
(170, 11846),
(173, 11934),
(171, 1),
(171, 11957);

-- --------------------------------------------------------

--
-- Tabellenstruktur für Tabelle `directors`
--

CREATE TABLE `directors` (
  `directorID` int(11) NOT NULL,
  `directorname` varchar(20) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Daten für Tabelle `directors`
--

INSERT INTO `directors` (`directorID`, `directorname`) VALUES
(226, ''),
(223, 'asdf'),
(221, 'Fritz'),
(4, 'Gastón Duprat'),
(212, 'Giorgos Lanthimos'),
(214, 'Maggie Gyllenhaal'),
(3, 'Mariano Cohn'),
(197, 'n.a.'),
(218, 'Paul Verhoeven'),
(219, 'Paula'),
(186, 'Peter Farrelly'),
(148, 'Ruben Östlund'),
(224, 'Sushmit Ghosh');

-- --------------------------------------------------------

--
-- Tabellenstruktur für Tabelle `genres`
--

CREATE TABLE `genres` (
  `genreID` int(4) NOT NULL,
  `genrename` varchar(20) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Daten für Tabelle `genres`
--

INSERT INTO `genres` (`genreID`, `genrename`) VALUES
(1, 'Action'),
(7, 'Adventure'),
(13, 'Animation'),
(12, 'Biopic'),
(3, 'Comedy'),
(14, 'Documentary'),
(2, 'Drama'),
(9, 'Fantasy'),
(11, 'Historical'),
(10, 'Horror'),
(5, 'Romance'),
(8, 'Satire'),
(4, 'SciFi'),
(6, 'Thriller');

-- --------------------------------------------------------

--
-- Tabellenstruktur für Tabelle `language`
--

CREATE TABLE `language` (
  `languageID` int(4) NOT NULL,
  `languagename` varchar(10) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Daten für Tabelle `language`
--

INSERT INTO `language` (`languageID`, `languagename`) VALUES
(6, ''),
(1, 'english'),
(5, 'french'),
(2, 'german'),
(4, 'hindi'),
(3, 'spanish');

-- --------------------------------------------------------

--
-- Tabellenstruktur für Tabelle `moviedirectedby`
--

CREATE TABLE `moviedirectedby` (
  `directorFK` int(4) NOT NULL,
  `movieFK` int(4) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Daten für Tabelle `moviedirectedby`
--

INSERT INTO `moviedirectedby` (`directorFK`, `movieFK`) VALUES
(186, 128),
(148, 170),
(212, 169),
(214, 171),
(218, 76),
(224, 173);

-- --------------------------------------------------------

--
-- Tabellenstruktur für Tabelle `moviegenres`
--

CREATE TABLE `moviegenres` (
  `genreFK` int(4) NOT NULL,
  `movieFK` int(4) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Daten für Tabelle `moviegenres`
--

INSERT INTO `moviegenres` (`genreFK`, `movieFK`) VALUES
(3, 169),
(8, 170),
(1, 128),
(3, 128),
(2, 76),
(11, 76),
(2, 171),
(14, 173);

-- --------------------------------------------------------

--
-- Tabellenstruktur für Tabelle `movielanguages`
--

CREATE TABLE `movielanguages` (
  `languageFK` int(4) NOT NULL,
  `movieFK` int(4) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Daten für Tabelle `movielanguages`
--

INSERT INTO `movielanguages` (`languageFK`, `movieFK`) VALUES
(1, 128),
(1, 169),
(1, 170),
(1, 171),
(5, 76),
(4, 173);

-- --------------------------------------------------------

--
-- Tabellenstruktur für Tabelle `movies`
--

CREATE TABLE `movies` (
  `movieID` int(4) NOT NULL,
  `title` varchar(50) NOT NULL,
  `year` int(4) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Daten für Tabelle `movies`
--

INSERT INTO `movies` (`movieID`, `title`, `year`) VALUES
(76, 'Benedetta', 2021),
(128, 'The Greatest Beer Run Ever', 2022),
(169, 'The Favourite', 2018),
(170, 'Triangle of Sadness', 2022),
(171, 'The Lost Daughter', 2021),
(173, 'Writing with Fire', 2021);

-- --------------------------------------------------------

--
-- Tabellenstruktur für Tabelle `movietags`
--

CREATE TABLE `movietags` (
  `tagFK` int(4) NOT NULL,
  `movieFK` int(4) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Daten für Tabelle `movietags`
--

INSERT INTO `movietags` (`tagFK`, `movieFK`) VALUES
(1, 169),
(2, 169),
(16, 170),
(25, 128),
(26, 128),
(28, 76),
(20, 171),
(4, 171),
(24, 171),
(34, 173),
(35, 173);

-- --------------------------------------------------------

--
-- Tabellenstruktur für Tabelle `tags`
--

CREATE TABLE `tags` (
  `tagID` int(4) NOT NULL,
  `tagname` varchar(20) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Daten für Tabelle `tags`
--

INSERT INTO `tags` (`tagID`, `tagname`) VALUES
(2, '18th century'),
(25, '60s'),
(26, 'america'),
(3, 'arthouse'),
(20, 'artsy'),
(32, 'Autumn'),
(17, 'easy'),
(1, 'england'),
(34, 'feminism'),
(16, 'glamour'),
(35, 'india'),
(4, 'psychological'),
(28, 'religion'),
(12, 'spring'),
(13, 'summer'),
(15, 'Winter'),
(24, 'women');

--
-- Indizes der exportierten Tabellen
--

--
-- Indizes für die Tabelle `actors`
--
ALTER TABLE `actors`
  ADD PRIMARY KEY (`actorID`),
  ADD UNIQUE KEY `actorname` (`actorname`);

--
-- Indizes für die Tabelle `cast`
--
ALTER TABLE `cast`
  ADD KEY `movieFK` (`movieFK`),
  ADD KEY `actorFK` (`actorFK`);

--
-- Indizes für die Tabelle `directors`
--
ALTER TABLE `directors`
  ADD PRIMARY KEY (`directorID`),
  ADD UNIQUE KEY `directorname` (`directorname`);

--
-- Indizes für die Tabelle `genres`
--
ALTER TABLE `genres`
  ADD PRIMARY KEY (`genreID`),
  ADD UNIQUE KEY `genreName` (`genrename`);

--
-- Indizes für die Tabelle `language`
--
ALTER TABLE `language`
  ADD PRIMARY KEY (`languageID`),
  ADD UNIQUE KEY `languagename` (`languagename`);

--
-- Indizes für die Tabelle `moviedirectedby`
--
ALTER TABLE `moviedirectedby`
  ADD KEY `directorFK` (`directorFK`),
  ADD KEY `movieFK` (`movieFK`);

--
-- Indizes für die Tabelle `moviegenres`
--
ALTER TABLE `moviegenres`
  ADD KEY `genreFK` (`genreFK`),
  ADD KEY `movieFK` (`movieFK`);

--
-- Indizes für die Tabelle `movielanguages`
--
ALTER TABLE `movielanguages`
  ADD KEY `languageFK` (`languageFK`),
  ADD KEY `movieFK` (`movieFK`);

--
-- Indizes für die Tabelle `movies`
--
ALTER TABLE `movies`
  ADD PRIMARY KEY (`movieID`),
  ADD UNIQUE KEY `title` (`title`);

--
-- Indizes für die Tabelle `movietags`
--
ALTER TABLE `movietags`
  ADD KEY `tagFK` (`tagFK`),
  ADD KEY `movieFK` (`movieFK`);

--
-- Indizes für die Tabelle `tags`
--
ALTER TABLE `tags`
  ADD PRIMARY KEY (`tagID`),
  ADD UNIQUE KEY `tagName` (`tagname`);

--
-- AUTO_INCREMENT für exportierte Tabellen
--

--
-- AUTO_INCREMENT für Tabelle `actors`
--
ALTER TABLE `actors`
  MODIFY `actorID` int(4) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11958;

--
-- AUTO_INCREMENT für Tabelle `directors`
--
ALTER TABLE `directors`
  MODIFY `directorID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=229;

--
-- AUTO_INCREMENT für Tabelle `genres`
--
ALTER TABLE `genres`
  MODIFY `genreID` int(4) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=51;

--
-- AUTO_INCREMENT für Tabelle `language`
--
ALTER TABLE `language`
  MODIFY `languageID` int(4) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=54;

--
-- AUTO_INCREMENT für Tabelle `movies`
--
ALTER TABLE `movies`
  MODIFY `movieID` int(4) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=178;

--
-- AUTO_INCREMENT für Tabelle `tags`
--
ALTER TABLE `tags`
  MODIFY `tagID` int(4) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=38;

--
-- Constraints der exportierten Tabellen
--

--
-- Constraints der Tabelle `cast`
--
ALTER TABLE `cast`
  ADD CONSTRAINT `cast_ibfk_1` FOREIGN KEY (`movieFK`) REFERENCES `movies` (`movieID`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `cast_ibfk_2` FOREIGN KEY (`actorFK`) REFERENCES `actors` (`actorID`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints der Tabelle `moviedirectedby`
--
ALTER TABLE `moviedirectedby`
  ADD CONSTRAINT `moviedirectedby_ibfk_1` FOREIGN KEY (`movieFK`) REFERENCES `movies` (`movieID`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `moviedirectedby_ibfk_2` FOREIGN KEY (`directorFK`) REFERENCES `directors` (`directorID`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints der Tabelle `moviegenres`
--
ALTER TABLE `moviegenres`
  ADD CONSTRAINT `moviegenres_ibfk_1` FOREIGN KEY (`movieFK`) REFERENCES `movies` (`movieID`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `moviegenres_ibfk_2` FOREIGN KEY (`genreFK`) REFERENCES `genres` (`genreID`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints der Tabelle `movielanguages`
--
ALTER TABLE `movielanguages`
  ADD CONSTRAINT `movielanguages_ibfk_1` FOREIGN KEY (`movieFK`) REFERENCES `movies` (`movieID`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `movielanguages_ibfk_2` FOREIGN KEY (`languageFK`) REFERENCES `language` (`languageID`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints der Tabelle `movietags`
--
ALTER TABLE `movietags`
  ADD CONSTRAINT `movietags_ibfk_1` FOREIGN KEY (`movieFK`) REFERENCES `movies` (`movieID`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `movietags_ibfk_2` FOREIGN KEY (`tagFK`) REFERENCES `tags` (`tagID`) ON DELETE CASCADE ON UPDATE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
