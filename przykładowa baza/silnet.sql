-- phpMyAdmin SQL Dump
-- version 5.0.3
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Czas generowania: 30 Sty 2022, 16:37
-- Wersja serwera: 10.4.14-MariaDB
-- Wersja PHP: 7.4.11

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Baza danych: `silnet`
--

-- --------------------------------------------------------

--
-- Struktura tabeli dla tabeli `company`
--

CREATE TABLE `company` (
  `id` int(11) NOT NULL,
  `company_name` varchar(100) NOT NULL,
  `add_date` datetime NOT NULL,
  `mod_date` datetime NOT NULL,
  `logo` longblob DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Zrzut danych tabeli `company`
--

INSERT INTO `company` (`id`, `company_name`, `add_date`, `mod_date`, `logo`) VALUES
(1, 'SILNET', '2022-01-29 00:00:00', '2022-01-29 00:00:00', NULL),
(2, 'MAZURY', '2022-01-29 00:00:00', '2022-01-29 00:00:00', NULL),
(3, 'MOJA FIRMA', '2022-01-29 10:11:46', '2022-01-30 02:47:47', NULL),
(5, 'PHP DEV', '2022-01-30 10:54:06', '2022-01-30 10:54:06', NULL);

-- --------------------------------------------------------

--
-- Struktura tabeli dla tabeli `workers`
--

CREATE TABLE `workers` (
  `id` int(11) NOT NULL,
  `name` varchar(100) NOT NULL,
  `surname` varchar(100) NOT NULL,
  `add_date` datetime NOT NULL,
  `mod_date` datetime NOT NULL,
  `company_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Zrzut danych tabeli `workers`
--

INSERT INTO `workers` (`id`, `name`, `surname`, `add_date`, `mod_date`, `company_id`) VALUES
(1, 'WOJCIECH', 'WOJTKOWIAK', '2022-01-30 11:52:43', '2022-01-30 01:35:51', 2),
(2, 'MACIEJ', 'NOWAK', '2022-01-30 11:53:17', '2022-01-30 11:53:17', 1),
(3, 'JAROSŁAW', 'NOWAK', '2022-01-30 11:53:54', '2022-01-30 03:11:38', 2),
(4, 'LECH', 'JELEŃ', '2022-01-30 11:55:06', '2022-01-30 11:55:06', 2),
(5, 'ANGELIKA', 'ANGELA', '2022-01-30 11:55:06', '2022-01-30 11:55:06', 3),
(6, 'MAGDA', 'MAGDALENA', '2022-01-30 11:56:01', '2022-01-30 11:56:01', 3),
(7, 'IZABELA', 'IZA', '2022-01-30 11:56:01', '2022-01-30 11:56:01', 4),
(8, 'PAWEŁ', 'JA', '2022-01-30 12:00:18', '2022-01-30 12:00:18', 6),
(9, 'ALA', 'KOT', '2022-01-30 12:06:47', '2022-01-30 12:06:47', 7),
(11, 'JACEK', 'MAJ', '2022-01-30 01:44:39', '2022-01-30 01:44:39', 2),
(12, 'KRZYSZTOF', 'MAJ', '2022-01-30 01:45:24', '2022-01-30 01:45:24', 2);

--
-- Indeksy dla zrzutów tabel
--

--
-- Indeksy dla tabeli `company`
--
ALTER TABLE `company`
  ADD PRIMARY KEY (`id`);

--
-- Indeksy dla tabeli `workers`
--
ALTER TABLE `workers`
  ADD PRIMARY KEY (`id`),
  ADD KEY `workers_ibfk_1` (`company_id`);

--
-- AUTO_INCREMENT dla zrzuconych tabel
--

--
-- AUTO_INCREMENT dla tabeli `company`
--
ALTER TABLE `company`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- AUTO_INCREMENT dla tabeli `workers`
--
ALTER TABLE `workers`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=14;

--
-- Ograniczenia dla zrzutów tabel
--

--
-- Ograniczenia dla tabeli `workers`
--
ALTER TABLE `workers`
  ADD CONSTRAINT `workers_ibfk_1` FOREIGN KEY (`company_id`) REFERENCES `company` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
