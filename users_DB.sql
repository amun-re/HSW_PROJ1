-- phpMyAdmin SQL Dump
-- version 4.6.5.2
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Erstellungszeit: 18. Apr 2017 um 16:20
-- Server-Version: 10.1.21-MariaDB
-- PHP-Version: 5.6.30

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Datenbank: `users`
--

-- --------------------------------------------------------

--
-- Tabellenstruktur für Tabelle `events`
--

CREATE TABLE `events` (
  `id` int(11) NOT NULL,
  `name` varchar(120) NOT NULL,
  `description` int(11) NOT NULL,
  `public` tinyint(1) NOT NULL,
  `date` date NOT NULL,
  `creator` varchar(50) NOT NULL,
  `location` int(11) NOT NULL,
  `price` decimal(10,0) NOT NULL,
  `bdate` date NOT NULL,
  `edate` date NOT NULL,
  `min_age` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Daten für Tabelle `events`
--

INSERT INTO `events` (`id`, `name`, `description`, `public`, `date`, `creator`, `location`, `price`, `bdate`, `edate`, `min_age`) VALUES
(1, 'test', 4, 0, '2017-04-05', '', 0, '0', '2017-04-20', '2017-04-22', 0),
(2, 'test2', 33, 1, '2017-04-05', '', 0, '0', '0000-00-00', '0000-00-00', 0),
(3, 'emty space', 0, 0, '2017-04-06', '', 0, '0', '0000-00-00', '0000-00-00', 0);

-- --------------------------------------------------------

--
-- Tabellenstruktur für Tabelle `locations`
--

CREATE TABLE `locations` (
  `id` int(11) NOT NULL,
  `name` varchar(120) NOT NULL,
  `place` varchar(60) NOT NULL,
  `plz` int(11) NOT NULL,
  `max_participants` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Tabellenstruktur für Tabelle `login_attempts`
--

CREATE TABLE `login_attempts` (
  `user_id` int(11) NOT NULL,
  `time` varchar(30) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Tabellenstruktur für Tabelle `members`
--

CREATE TABLE `members` (
  `id` int(11) NOT NULL,
  `username` varchar(30) NOT NULL,
  `email` varchar(50) NOT NULL,
  `password` char(128) NOT NULL,
  `salt` char(128) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Daten für Tabelle `members`
--

INSERT INTO `members` (`id`, `username`, `email`, `password`, `salt`) VALUES
(0, 'kuhnke', 'sdf@web.de', 'f341ec895e27a6de632f00827fb232cc96b27147ee72cdd8d99a71254bb0bceebfe354740d7d2969e2812f87c9475b8dd4be542ad88e5220dc2aac45bfea811d', 'fec31c5e423918d0ac132a42871fc98d27125a0c38030bdebe8050097848dd1d28b09149038f1b0ea4d89b01d92fb78a32a1d07692a3d477eb2687ce252511ef');

-- --------------------------------------------------------

--
-- Tabellenstruktur für Tabelle `participants`
--

CREATE TABLE `participants` (
  `event` int(11) NOT NULL,
  `user` int(11) NOT NULL,
  `status` tinyint(4) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Indizes der exportierten Tabellen
--

--
-- Indizes für die Tabelle `events`
--
ALTER TABLE `events`
  ADD PRIMARY KEY (`id`);

--
-- Indizes für die Tabelle `locations`
--
ALTER TABLE `locations`
  ADD PRIMARY KEY (`id`);

--
-- Indizes für die Tabelle `participants`
--
ALTER TABLE `participants`
  ADD PRIMARY KEY (`event`,`user`);

--
-- AUTO_INCREMENT für exportierte Tabellen
--

--
-- AUTO_INCREMENT für Tabelle `events`
--
ALTER TABLE `events`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;
--
-- AUTO_INCREMENT für Tabelle `locations`
--
ALTER TABLE `locations`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
