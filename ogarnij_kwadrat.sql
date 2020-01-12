-- phpMyAdmin SQL Dump
-- version 4.9.2
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Czas generowania: 12 Sty 2020, 01:10
-- Wersja serwera: 10.4.11-MariaDB
-- Wersja PHP: 7.4.1

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Baza danych: `ogarnij_kwadrat`
--

-- --------------------------------------------------------

--
-- Struktura tabeli dla tabeli `agreements`
--

CREATE TABLE `agreements` (
  `agreement_id` int(11) NOT NULL,
  `date_from` date NOT NULL,
  `date_to` date DEFAULT NULL,
  `user_id` int(11) NOT NULL,
  `flat_id` int(11) NOT NULL,
  `room_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Struktura tabeli dla tabeli `faults`
--

CREATE TABLE `faults` (
  `fault_id` int(11) NOT NULL,
  `type_id` int(11) NOT NULL,
  `status_id` int(11) NOT NULL,
  `info_id` int(11) DEFAULT NULL,
  `user_id` int(11) NOT NULL,
  `flat_id` int(11) NOT NULL,
  `add_date` date NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Struktura tabeli dla tabeli `faults_additional_info`
--

CREATE TABLE `faults_additional_info` (
  `info_id` int(11) NOT NULL,
  `content` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Struktura tabeli dla tabeli `faults_status`
--

CREATE TABLE `faults_status` (
  `status_id` int(11) NOT NULL,
  `status_name` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Struktura tabeli dla tabeli `faults_types`
--

CREATE TABLE `faults_types` (
  `type_id` int(11) NOT NULL,
  `type_name` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Struktura tabeli dla tabeli `flats`
--

CREATE TABLE `flats` (
  `flat_id` int(11) NOT NULL,
  `address_id` int(11) NOT NULL,
  `info_id` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Zrzut danych tabeli `flats`
--

INSERT INTO `flats` (`flat_id`, `address_id`, `info_id`) VALUES
(18, 35, 4),
(23, 40, NULL),
(24, 41, NULL),
(25, 42, NULL);

-- --------------------------------------------------------

--
-- Struktura tabeli dla tabeli `flats_additional_info`
--

CREATE TABLE `flats_additional_info` (
  `info_id` int(11) NOT NULL,
  `content` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Zrzut danych tabeli `flats_additional_info`
--

INSERT INTO `flats_additional_info` (`info_id`, `content`) VALUES
(4, 'Moje pierwsze mieszkanie!'),
(5, 'dsadasdaa');

-- --------------------------------------------------------

--
-- Struktura tabeli dla tabeli `flats_address`
--

CREATE TABLE `flats_address` (
  `address_id` int(11) NOT NULL,
  `city` varchar(255) NOT NULL,
  `street` varchar(255) NOT NULL,
  `number` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Zrzut danych tabeli `flats_address`
--

INSERT INTO `flats_address` (`address_id`, `city`, `street`, `number`) VALUES
(35, 'Sosnowiec', 'Staropogońska 48', '2'),
(40, 'Łódź', 'Harcmistrza 35', '3'),
(41, 'Wrocław', 'Zaolziańska 13A', '7'),
(42, 'Warszawa', 'Pedałowa 33', '9');

-- --------------------------------------------------------

--
-- Struktura tabeli dla tabeli `phone_numbers`
--

CREATE TABLE `phone_numbers` (
  `number_id` int(11) NOT NULL,
  `number` varchar(20) NOT NULL,
  `user_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Zrzut danych tabeli `phone_numbers`
--

INSERT INTO `phone_numbers` (`number_id`, `number`, `user_id`) VALUES
(1, '678234890', 1);

-- --------------------------------------------------------

--
-- Struktura tabeli dla tabeli `rooms`
--

CREATE TABLE `rooms` (
  `room_id` int(11) NOT NULL,
  `number` int(11) NOT NULL,
  `flat_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Zrzut danych tabeli `rooms`
--

INSERT INTO `rooms` (`room_id`, `number`, `flat_id`) VALUES
(25, 1, 18),
(26, 2, 18),
(27, 1, 24),
(28, 2, 24),
(29, 3, 24),
(30, 1, 25);

-- --------------------------------------------------------

--
-- Struktura tabeli dla tabeli `users`
--

CREATE TABLE `users` (
  `user_id` int(11) NOT NULL,
  `user_name` varchar(255) NOT NULL,
  `user_surname` varchar(255) NOT NULL,
  `user_email` varchar(255) NOT NULL,
  `user_password` text NOT NULL,
  `role_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Zrzut danych tabeli `users`
--

INSERT INTO `users` (`user_id`, `user_name`, `user_surname`, `user_email`, `user_password`, `role_id`) VALUES
(1, 'Kacper', 'Baran', 'baran@ogarnij.pl', '$2y$10$7PFOTdYxEsV6SLPAoLHsGegzHwBCBUrISM6NS2tBDwIbCjRb1BNae', 1);

-- --------------------------------------------------------

--
-- Struktura tabeli dla tabeli `users_role`
--

CREATE TABLE `users_role` (
  `role_id` int(11) NOT NULL,
  `role_name` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Zrzut danych tabeli `users_role`
--

INSERT INTO `users_role` (`role_id`, `role_name`) VALUES
(1, 'Admin'),
(2, 'Renter');

--
-- Indeksy dla zrzutów tabel
--

--
-- Indeksy dla tabeli `agreements`
--
ALTER TABLE `agreements`
  ADD PRIMARY KEY (`agreement_id`),
  ADD KEY `user_id` (`user_id`),
  ADD KEY `flat_id` (`flat_id`),
  ADD KEY `room_id` (`room_id`);

--
-- Indeksy dla tabeli `faults`
--
ALTER TABLE `faults`
  ADD PRIMARY KEY (`fault_id`),
  ADD KEY `type_id` (`type_id`),
  ADD KEY `status_id` (`status_id`),
  ADD KEY `info_id` (`info_id`),
  ADD KEY `user_id` (`user_id`),
  ADD KEY `flat_id` (`flat_id`);

--
-- Indeksy dla tabeli `faults_additional_info`
--
ALTER TABLE `faults_additional_info`
  ADD PRIMARY KEY (`info_id`);

--
-- Indeksy dla tabeli `faults_status`
--
ALTER TABLE `faults_status`
  ADD PRIMARY KEY (`status_id`);

--
-- Indeksy dla tabeli `faults_types`
--
ALTER TABLE `faults_types`
  ADD PRIMARY KEY (`type_id`);

--
-- Indeksy dla tabeli `flats`
--
ALTER TABLE `flats`
  ADD PRIMARY KEY (`flat_id`),
  ADD KEY `address_id` (`address_id`),
  ADD KEY `info_id` (`info_id`);

--
-- Indeksy dla tabeli `flats_additional_info`
--
ALTER TABLE `flats_additional_info`
  ADD PRIMARY KEY (`info_id`);

--
-- Indeksy dla tabeli `flats_address`
--
ALTER TABLE `flats_address`
  ADD PRIMARY KEY (`address_id`);

--
-- Indeksy dla tabeli `phone_numbers`
--
ALTER TABLE `phone_numbers`
  ADD PRIMARY KEY (`number_id`),
  ADD KEY `user_id` (`user_id`);

--
-- Indeksy dla tabeli `rooms`
--
ALTER TABLE `rooms`
  ADD PRIMARY KEY (`room_id`),
  ADD KEY `flat_id` (`flat_id`);

--
-- Indeksy dla tabeli `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`user_id`),
  ADD KEY `role_id` (`role_id`);

--
-- Indeksy dla tabeli `users_role`
--
ALTER TABLE `users_role`
  ADD PRIMARY KEY (`role_id`);

--
-- AUTO_INCREMENT dla tabel zrzutów
--

--
-- AUTO_INCREMENT dla tabeli `agreements`
--
ALTER TABLE `agreements`
  MODIFY `agreement_id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT dla tabeli `faults`
--
ALTER TABLE `faults`
  MODIFY `fault_id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT dla tabeli `faults_additional_info`
--
ALTER TABLE `faults_additional_info`
  MODIFY `info_id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT dla tabeli `faults_status`
--
ALTER TABLE `faults_status`
  MODIFY `status_id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT dla tabeli `faults_types`
--
ALTER TABLE `faults_types`
  MODIFY `type_id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT dla tabeli `flats`
--
ALTER TABLE `flats`
  MODIFY `flat_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=26;

--
-- AUTO_INCREMENT dla tabeli `flats_additional_info`
--
ALTER TABLE `flats_additional_info`
  MODIFY `info_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT dla tabeli `flats_address`
--
ALTER TABLE `flats_address`
  MODIFY `address_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=43;

--
-- AUTO_INCREMENT dla tabeli `phone_numbers`
--
ALTER TABLE `phone_numbers`
  MODIFY `number_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT dla tabeli `rooms`
--
ALTER TABLE `rooms`
  MODIFY `room_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=31;

--
-- AUTO_INCREMENT dla tabeli `users`
--
ALTER TABLE `users`
  MODIFY `user_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT dla tabeli `users_role`
--
ALTER TABLE `users_role`
  MODIFY `role_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- Ograniczenia dla zrzutów tabel
--

--
-- Ograniczenia dla tabeli `agreements`
--
ALTER TABLE `agreements`
  ADD CONSTRAINT `agreements_ibfk_1` FOREIGN KEY (`user_id`) REFERENCES `users` (`user_id`),
  ADD CONSTRAINT `agreements_ibfk_2` FOREIGN KEY (`flat_id`) REFERENCES `flats` (`flat_id`),
  ADD CONSTRAINT `agreements_ibfk_3` FOREIGN KEY (`room_id`) REFERENCES `rooms` (`room_id`);

--
-- Ograniczenia dla tabeli `faults`
--
ALTER TABLE `faults`
  ADD CONSTRAINT `faults_ibfk_1` FOREIGN KEY (`type_id`) REFERENCES `faults_types` (`type_id`),
  ADD CONSTRAINT `faults_ibfk_2` FOREIGN KEY (`status_id`) REFERENCES `faults_status` (`status_id`),
  ADD CONSTRAINT `faults_ibfk_3` FOREIGN KEY (`info_id`) REFERENCES `faults_additional_info` (`info_id`),
  ADD CONSTRAINT `faults_ibfk_4` FOREIGN KEY (`user_id`) REFERENCES `users` (`user_id`),
  ADD CONSTRAINT `faults_ibfk_5` FOREIGN KEY (`flat_id`) REFERENCES `flats` (`flat_id`);

--
-- Ograniczenia dla tabeli `flats`
--
ALTER TABLE `flats`
  ADD CONSTRAINT `flats_ibfk_1` FOREIGN KEY (`address_id`) REFERENCES `flats_address` (`address_id`),
  ADD CONSTRAINT `flats_ibfk_2` FOREIGN KEY (`info_id`) REFERENCES `flats_additional_info` (`info_id`);

--
-- Ograniczenia dla tabeli `phone_numbers`
--
ALTER TABLE `phone_numbers`
  ADD CONSTRAINT `phone_numbers_ibfk_1` FOREIGN KEY (`user_id`) REFERENCES `users` (`user_id`);

--
-- Ograniczenia dla tabeli `rooms`
--
ALTER TABLE `rooms`
  ADD CONSTRAINT `rooms_ibfk_1` FOREIGN KEY (`flat_id`) REFERENCES `flats` (`flat_id`);

--
-- Ograniczenia dla tabeli `users`
--
ALTER TABLE `users`
  ADD CONSTRAINT `users_ibfk_1` FOREIGN KEY (`role_id`) REFERENCES `users_role` (`role_id`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
