-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Gegenereerd op: 01 apr 2025 om 11:37
-- Serverversie: 10.4.32-MariaDB
-- PHP-versie: 8.2.12

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `biertest2`
--

-- --------------------------------------------------------

--
-- Tabelstructuur voor tabel `bestellingen`
--

CREATE TABLE `bestellingen` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `product_id` int(11) NOT NULL,
  `klantid` int(11) NOT NULL,
  `bestelling_datum` timestamp NOT NULL DEFAULT current_timestamp(),
  `aantal` int(11) NOT NULL CHECK (`aantal` > 0)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Gegevens worden geëxporteerd voor tabel `bestellingen`
--

INSERT INTO `bestellingen` (`id`, `product_id`, `klantid`, `bestelling_datum`, `aantal`) VALUES
(11, 1, 0, '2025-03-18 21:59:52', 4),
(12, 2, 0, '2025-03-18 21:59:52', 5),
(13, 3, 0, '2025-03-18 21:59:52', 5),
(14, 4, 0, '2025-03-18 21:59:52', 3),
(15, 5, 0, '2025-03-18 21:59:52', 7),
(16, 1, 0, '2025-03-18 22:05:07', 1),
(17, 2, 0, '2025-03-18 22:05:07', 3),
(18, 3, 0, '2025-03-18 22:05:07', 1),
(19, 4, 0, '2025-03-18 22:05:07', 1),
(20, 5, 0, '2025-03-18 22:05:07', 3),
(21, 1, 0, '2025-03-25 13:01:20', 1),
(22, 3, 0, '2025-03-25 13:01:20', 1),
(23, 1, 0, '2025-03-25 13:02:29', 1),
(24, 3, 0, '2025-03-25 13:04:29', 3),
(25, 4, 0, '2025-03-25 13:04:29', 1),
(26, 2, 0, '2025-03-25 13:07:58', 1),
(27, 5, 0, '2025-03-25 13:07:58', 1),
(28, 1, 0, '2025-03-26 07:33:31', 1),
(29, 5, 0, '2025-03-26 07:33:31', 1),
(30, 6, 0, '2025-03-26 07:33:31', 1),
(31, 35, 0, '2025-03-26 09:08:49', 5),
(32, 4, 0, '2025-03-28 17:18:00', 1),
(33, 5, 0, '2025-03-28 17:18:00', 1),
(34, 35, 0, '2025-03-28 17:18:00', 1),
(35, 2, 0, '2025-03-28 21:50:18', 1),
(36, 2, 0, '2025-03-28 21:52:54', 1);

-- --------------------------------------------------------

--
-- Tabelstructuur voor tabel `klanten`
--

CREATE TABLE `klanten` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `naam` varchar(50) NOT NULL,
  `email` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Gegevens worden geëxporteerd voor tabel `klanten`
--

INSERT INTO `klanten` (`id`, `naam`, `email`) VALUES
(1, 'Jan Janssen', 'jan.janssen@example.com'),
(2, 'Piet Pietersen', 'piet.pietersen@example.com'),
(3, 'Klaas de Vries', 'klaas.devries@example.com'),
(4, 'xavi', 'kakerkak11@gmail.com'),
(21, 'kaasjeachttt', 'xavivanbeekalt@gmail.com');

-- --------------------------------------------------------

--
-- Tabelstructuur voor tabel `producten`
--

CREATE TABLE `producten` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `type_id` int(11) NOT NULL,
  `soort_id` int(11) NOT NULL,
  `naam` varchar(50) NOT NULL,
  `prijs` decimal(10,2) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Gegevens worden geëxporteerd voor tabel `producten`
--

INSERT INTO `producten` (`id`, `type_id`, `soort_id`, `naam`, `prijs`) VALUES
(1, 2, 1, 'Amstel Pet ', 24.99),
(2, 1, 1, 'Amstel Bier 330ml', 3.00),
(3, 1, 1, 'Amstel Bier 250ml', 2.39),
(4, 2, 2, 'Heineken Hoodie', 50.00),
(5, 1, 2, 'Heineken Bier 330ml', 3.19),
(6, 1, 2, 'Heineken Bier 250ml', 2.00),
(35, 1, 2, 'ali met een bom', 4.99);

-- --------------------------------------------------------

--
-- Tabelstructuur voor tabel `soorten`
--

CREATE TABLE `soorten` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(20) NOT NULL CHECK (`name` in ('amstel','heineken'))
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Gegevens worden geëxporteerd voor tabel `soorten`
--

INSERT INTO `soorten` (`id`, `name`) VALUES
(1, 'amstel'),
(2, 'heineken');

-- --------------------------------------------------------

--
-- Tabelstructuur voor tabel `types`
--

CREATE TABLE `types` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(20) NOT NULL CHECK (`name` in ('bier','merge'))
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Gegevens worden geëxporteerd voor tabel `types`
--

INSERT INTO `types` (`id`, `name`) VALUES
(1, 'bier'),
(2, 'merge');

--
-- Indexen voor geëxporteerde tabellen
--

--
-- Indexen voor tabel `bestellingen`
--
ALTER TABLE `bestellingen`
  ADD PRIMARY KEY (`id`);

--
-- Indexen voor tabel `klanten`
--
ALTER TABLE `klanten`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `email` (`email`);

--
-- Indexen voor tabel `producten`
--
ALTER TABLE `producten`
  ADD PRIMARY KEY (`id`);

--
-- Indexen voor tabel `soorten`
--
ALTER TABLE `soorten`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `name` (`name`);

--
-- Indexen voor tabel `types`
--
ALTER TABLE `types`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `name` (`name`);

--
-- AUTO_INCREMENT voor geëxporteerde tabellen
--

--
-- AUTO_INCREMENT voor een tabel `bestellingen`
--
ALTER TABLE `bestellingen`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=37;

--
-- AUTO_INCREMENT voor een tabel `klanten`
--
ALTER TABLE `klanten`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=22;

--
-- AUTO_INCREMENT voor een tabel `producten`
--
ALTER TABLE `producten`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=36;

--
-- AUTO_INCREMENT voor een tabel `soorten`
--
ALTER TABLE `soorten`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT voor een tabel `types`
--
ALTER TABLE `types`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
