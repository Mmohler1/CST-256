-- phpMyAdmin SQL Dump
-- version 4.9.5
-- https://www.phpmyadmin.net/
--
-- Host: localhost:3306
-- Generation Time: Feb 08, 2021 at 04:02 AM
-- Server version: 5.7.24
-- PHP Version: 7.4.1

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `dbsecu`
--
CREATE DATABASE IF NOT EXISTS `dbsecu` DEFAULT CHARACTER SET utf8 COLLATE utf8_general_ci;
USE `dbsecu`;

-- --------------------------------------------------------

--
-- Table structure for table `admins`
--

DROP TABLE IF EXISTS `admins`;
CREATE TABLE `admins` (
  `name` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `email` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `migrations`
--

DROP TABLE IF EXISTS `migrations`;
CREATE TABLE `migrations` (
  `id` int(10) UNSIGNED NOT NULL,
  `migration` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `batch` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `migrations`
--

INSERT INTO `migrations` (`id`, `migration`, `batch`) VALUES
(1, '2014_10_12_000000_create_users_table', 1),
(2, '2014_10_12_100000_create_password_resets_table', 1);

-- --------------------------------------------------------

--
-- Table structure for table `password_resets`
--

DROP TABLE IF EXISTS `password_resets`;
CREATE TABLE `password_resets` (
  `email` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `token` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `password_resets`
--

INSERT INTO `password_resets` (`email`, `token`, `created_at`) VALUES
('mmohler1@my.gcu.edu', '$2y$10$CYMrbxDbKe8zXYFo1ZCiA.dK0PpqzaKN.GRDlja4a99N0PH72Ttl.', '2021-01-25 00:30:28');

-- --------------------------------------------------------

--
-- Table structure for table `suspended`
--

DROP TABLE IF EXISTS `suspended`;
CREATE TABLE `suspended` (
  `username` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `email` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `count` int(3) DEFAULT NULL,
  `deleted` tinyint(1) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `suspended`
--

INSERT INTO `suspended` (`username`, `email`, `count`, `deleted`) VALUES
('Kyle', 'kyle@gmail.com', NULL, 1);

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

DROP TABLE IF EXISTS `users`;
CREATE TABLE `users` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `email` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `email_verified_at` timestamp NULL DEFAULT NULL,
  `password` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `remember_token` varchar(100) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `name`, `email`, `email_verified_at`, `password`, `remember_token`, `created_at`, `updated_at`) VALUES
(1, 'Michael', 'mmohler1@my.gcu.edu', NULL, '$2y$10$TCOgJQwVBh7zwY/C.pus.ehJmEYuzAITg0YPmtuHFedv1NEnAasB2', 'D5rIRrevnjMLLUb8ciaXobU1eg9uum8W0Fkmm6KO35yBGpkzZWWex75GOUfj', '2021-01-24 02:53:50', '2021-01-24 02:53:50'),
(2, 'Garcia', 'mikelobyo@hotmail.com', NULL, '$2y$10$p7gNEAskAlG/OEToVcJZdujTBdRGz/Vp.317au78bHYE71v474zZ.', NULL, '2021-01-24 08:56:51', '2021-01-24 08:56:51'),
(3, 'John', 'john@gmail.com', NULL, '$2y$10$FqXUjitLTrheaSdyUc624.Y5Gqglh/7740p3S4uf0FFn6kSfI2IIu', NULL, '2021-01-25 00:26:16', '2021-01-25 00:26:16'),
(5, 'J0hn', 'J0hn@gmail.com', NULL, '$2y$10$o/icW0SZn1UszrdCN13TmeXw3H.M4fTJu1/lbYwB65XoRZn..JYT2', NULL, '2021-01-25 00:49:31', '2021-01-25 00:49:31'),
(7, 'John1', 'John1@gmail.com', NULL, '$2y$10$MBoH7MLj8OvHPrAcBO0sr..vKjsf9akzNfrCA9A3SvAKSZDnm8186', NULL, '2021-01-25 01:59:03', '2021-01-25 01:59:03'),
(8, 'Cilantro', 'cilantro@yahoo.com', NULL, '$2y$10$06V.TAOwaFe0DZWVa11w1eOBAtZYOr6G0WGWq/E28aqmyKoyw2ZRW', NULL, '2021-02-08 07:28:50', '2021-02-08 07:28:50');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `migrations`
--
ALTER TABLE `migrations`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `password_resets`
--
ALTER TABLE `password_resets`
  ADD KEY `password_resets_email_index` (`email`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `users_email_unique` (`email`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `migrations`
--
ALTER TABLE `migrations`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=15;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
