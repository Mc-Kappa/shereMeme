-- phpMyAdmin SQL Dump
-- version 5.2.0
-- https://www.phpmyadmin.net/
--
-- Host: localhost:8889
-- Czas generowania: 15 Lis 2023, 22:54
-- Wersja serwera: 5.7.39
-- Wersja PHP: 7.4.33

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Baza danych: `as_project`
--

-- --------------------------------------------------------

--
-- Struktura tabeli dla tabeli `users`
--

CREATE TABLE `users` (
  `id` int(11) NOT NULL,
  `user` text COLLATE utf8_polish_ci NOT NULL,
  `password` text COLLATE utf8_polish_ci NOT NULL,
  `2fa_code` varchar(10) COLLATE utf8_polish_ci DEFAULT NULL,
  `last_login` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `last_ip` varchar(10) COLLATE utf8_polish_ci DEFAULT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8 COLLATE=utf8_polish_ci;

--
-- Zrzut danych tabeli `users`
--

INSERT INTO `users` (`id`, `user`, `password`, `2fa_code`, `last_login`, `last_ip`) VALUES
(1, 'admin', '$2y$10$bHwtYHTMkslcH1d4QKSCoeYEZvm.tcBURvnHebOJO8KfakSFsf9G6', NULL, '2023-11-15 22:50:55', '::1'),
(26, 'qqq@yyy.uu', '$2y$10$GAAPCecD9Oo6Zc4khbmlKOzHuVmD1U3clgKtQGPVZKgIVYtIe4cCy', NULL, '2023-11-14 14:26:01', NULL),
(25, 'wojtak123@gmail.com', '$2y$10$yvC1ENKZ3wDq4HG8Q5W3cuM3sKJzIPFkM.JFM/trQ3v7kXPrBkHSu', NULL, '2023-11-14 14:26:01', NULL),
(24, 'xxx@yyy.zz', '$2y$10$G.T6byIhbgJBdP6Tx7uJ0eBf9HyydvlEzdg2eAtrXZIF6j9Md31qq', NULL, '2023-11-14 14:26:01', NULL),
(29, 'www@kkk.pl', '$2y$10$FgZ7muKY9QPuQe8UbF1ateVKyncYR17h.7XuE3gRwmTi8vED8sI2i', NULL, '2023-11-14 14:28:00', NULL),
(28, 'wojciech@reinwestuj.pl', '$2y$10$rSBVL2..PziERR9pKRl.N.qphDVnL6DWB6gg5sdLGmk6NAaBZYKlO', NULL, '2023-11-14 14:26:01', NULL);

--
-- Indeksy dla zrzutów tabel
--

--
-- Indeksy dla tabeli `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `id` (`id`);

--
-- AUTO_INCREMENT dla zrzuconych tabel
--

--
-- AUTO_INCREMENT dla tabeli `users`
--
ALTER TABLE `users`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=30;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
