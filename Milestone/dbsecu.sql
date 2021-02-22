-- phpMyAdmin SQL Dump
-- version 4.9.5
-- https://www.phpmyadmin.net/
--
-- Host: localhost:3306
-- Generation Time: Feb 22, 2021 at 11:53 PM
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
-- Table structure for table `efolio`
--

DROP TABLE IF EXISTS `efolio`;
CREATE TABLE `efolio` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `History` varchar(255) NOT NULL,
  `Skills` varchar(255) NOT NULL,
  `Education` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `efolio`
--

INSERT INTO `efolio` (`id`, `History`, `Skills`, `Education`) VALUES
(5, 'Drummerss', 'Hits', '7th Grade'),
(3, 'Animation', 'Stick Figures', '4th Grade'),
(5, 'jfdjk', 'dfkajf', 'dfakjfdj'),
(3, 'Stuff', 'Things', 'My head');

-- --------------------------------------------------------

--
-- Table structure for table `job`
--

DROP TABLE IF EXISTS `job`;
CREATE TABLE `job` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `jname` varchar(255) NOT NULL,
  `requirement` varchar(255) NOT NULL,
  `summary` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `job`
--

INSERT INTO `job` (`id`, `jname`, `requirement`, `summary`) VALUES
(3, 'Chief', 'Working a stove', 'Doing the thing where you make stuff on plates taste good because lets be fair food tastes good when cooked with grace. Why the heck did this not work a second ago? Was it a flook or is everything good?');

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

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

DROP TABLE IF EXISTS `users`;
CREATE TABLE `users` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `email` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `roles` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT 'user',
  `email_verified_at` timestamp NULL DEFAULT NULL,
  `password` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `remember_token` varchar(100) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `name`, `email`, `roles`, `email_verified_at`, `password`, `remember_token`, `created_at`, `updated_at`) VALUES
(3, 'Michael', 'mmohler1@my.gcu.edu', 'admin', NULL, '$2y$10$0X7Tu6WN9CANC0FcmPVHiO8b.bEBcaYtPeszqfqTGWdTbCJkg0eZ2', '5SZP4VqgF3pRPTI8plWv8IPS38irRpgrCi4b1dSQ2Lh16DFNjhNiwPlVeD9C', '2021-02-11 03:55:09', '2021-02-11 03:55:09'),
(5, 'Cilantro', 'Cilantro@yahoo.com', 'user', NULL, '$2y$10$/QVhMFRYvikvBC/BnS1Zl.EcLNzLjygPqd7Epx1Cfl8YJ/M.Lq4hu', NULL, '2021-02-12 02:48:06', '2021-02-12 02:48:06'),
(6, 'Kyle', 'Kyle@gmail.com', 'suspended', NULL, '$2y$10$4t2u.M6QELduSQcFhkjGjO6QVpFwaH5JGuMpIK1BLwFBNOJ8po7jK', NULL, '2021-02-12 14:27:21', '2021-02-12 14:27:21'),
(7, 'Administration', 'Root@gmail.com', 'user', NULL, '$2y$10$gkgvE6XP3ts3jxyum/srY.LYzfS3K/Y1neQJSbIrpYZf/Ry0AYyI6', NULL, '2021-02-23 06:52:18', '2021-02-23 06:52:18');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `efolio`
--
ALTER TABLE `efolio`
  ADD KEY `eConstraint` (`id`);

--
-- Indexes for table `job`
--
ALTER TABLE `job`
  ADD KEY `jconstraint` (`id`);

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
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `efolio`
--
ALTER TABLE `efolio`
  ADD CONSTRAINT `eConstraint` FOREIGN KEY (`id`) REFERENCES `users` (`id`);

--
-- Constraints for table `job`
--
ALTER TABLE `job`
  ADD CONSTRAINT `jconstraint` FOREIGN KEY (`id`) REFERENCES `users` (`id`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
