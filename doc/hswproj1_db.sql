-- phpMyAdmin SQL Dump
-- version 4.6.5.2
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Erstellungszeit: 26. Apr 2017 um 09:46
-- Server-Version: 10.1.21-MariaDB
-- PHP-Version: 5.6.30

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Datenbank: `hswproj1`
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
  `bdate` datetime NOT NULL,
  `edate` datetime NOT NULL,
  `min_age` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Daten für Tabelle `events`
--

INSERT INTO `events` (`id`, `name`, `description`, `public`, `date`, `creator`, `location`, `price`, `bdate`, `edate`, `min_age`) VALUES
(1, 'test', 4, 0, '2017-04-05', '', 0, '0', '2017-04-20 00:00:00', '2017-04-22 00:00:00', 0),
(2, 'test2', 33, 1, '2017-04-05', '', 0, '0', '0000-00-00 00:00:00', '0000-00-00 00:00:00', 0),
(3, 'emty space', 0, 0, '2017-04-06', '', 0, '0', '0000-00-00 00:00:00', '0000-00-00 00:00:00', 0),
(4, 'IT-Projektmanagement', 0, 0, '2017-04-20', '', 0, '0', '0000-00-00 00:00:00', '0000-00-00 00:00:00', 0);

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
  `age` int(4) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Daten für Tabelle `members`
--

INSERT INTO `members` (`id`, `username`, `email`, `password`, `salt`, `age`) VALUES
(1, 'kuhnke', 'sdf@web.de', '04e7dd2d2fb13430183c6b7f39e62527d0ba05584e1a2de290d314200d83e8ac62121ec33382d35c3a75a88467899dd111b5a153ed9344fe40daadfe31db1c16', '76318990e9a5f60c352a9ef018fb77a97cd578bff188b4cb4f503a7bcb0e0941c114dc6d7fa8e1448161df66ac08f78778112c85da8407db2f1db02b30c5c6d0', '26'),
(2, 'test', 'test2@web.de', '1a52fd055045650c86710030c0b7a22812f08f6162cc4e08724bab7e694d89719d8c9bdf63b9c8a817cef4c79e519914b837e2e164a8e1e365bb0e99eee34cac', '0964adfcb1b56532e4b13d750f10e2da2553692797a4dd64edf090a0603e46ab53b9a2a0e0a10ac15f005e2fca46c6316b044d6dd5e4c55166c23c1e265265cf', '21');

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
  ADD PRIMARY KEY (`id`),
  ADD KEY `id` (`id`),
  ADD KEY `location` (`location`);

--
-- Indizes für die Tabelle `locations`
--
ALTER TABLE `locations`
  ADD PRIMARY KEY (`id`),
  ADD KEY `id` (`id`);

--
-- Indizes für die Tabelle `login_attempts`
--
ALTER TABLE `login_attempts`
  ADD PRIMARY KEY (`user_id`),
  ADD KEY `user_id` (`user_id`);

--
-- Indizes für die Tabelle `members`
--
ALTER TABLE `members`
  ADD PRIMARY KEY (`id`),
  ADD KEY `id` (`id`);

--
-- Indizes für die Tabelle `participants`
--
ALTER TABLE `participants`
  ADD PRIMARY KEY (`event`,`user`),
  ADD KEY `event` (`event`),
  ADD KEY `user` (`user`);

--
-- AUTO_INCREMENT für exportierte Tabellen
--

--
-- AUTO_INCREMENT für Tabelle `events`
--
ALTER TABLE `events`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;
--
-- AUTO_INCREMENT für Tabelle `locations`
--
ALTER TABLE `locations`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT für Tabelle `members`
--
ALTER TABLE `members`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;
--
-- Constraints der exportierten Tabellen
--

--
-- Constraints der Tabelle `locations`
--
ALTER TABLE `locations`
  ADD CONSTRAINT `locations_ibfk_1` FOREIGN KEY (`id`) REFERENCES `events` (`location`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints der Tabelle `login_attempts`
--
ALTER TABLE `login_attempts`
  ADD CONSTRAINT `login_attempts_ibfk_1` FOREIGN KEY (`user_id`) REFERENCES `members` (`id`);

--
-- Constraints der Tabelle `participants`
--
ALTER TABLE `participants`
  ADD CONSTRAINT `participants_ibfk_1` FOREIGN KEY (`event`) REFERENCES `events` (`id`),
  ADD CONSTRAINT `participants_ibfk_2` FOREIGN KEY (`user`) REFERENCES `members` (`id`);

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
