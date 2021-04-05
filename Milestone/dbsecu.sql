-- phpMyAdmin SQL Dump
-- version 4.9.5
-- https://www.phpmyadmin.net/
--
-- Host: localhost:3306
-- Generation Time: Apr 03, 2021 at 08:06 AM
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
-- Table structure for table `apply`
--

DROP TABLE IF EXISTS `apply`;
CREATE TABLE `apply` (
  `applyId` int(11) NOT NULL,
  `jobId` int(11) NOT NULL,
  `id` int(11) NOT NULL,
  `email` varchar(255) NOT NULL,
  `name` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

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
(5, 'Drummer', 'Hits things', '7th Grade'),
(3, 'Animation', 'Stick Figures', '4th Grade'),
(5, 'jfdjk', 'dfkajf', 'dfakjfdj'),
(3, 'FIne!', 'dkajfkdjaf', 'dkajfdj'),
(3, 'Walmart', 'Basic Math', 'High School');

-- --------------------------------------------------------

--
-- Table structure for table `groups`
--

DROP TABLE IF EXISTS `groups`;
CREATE TABLE `groups` (
  `groupName` varchar(255) NOT NULL,
  `id` bigint(20) UNSIGNED NOT NULL,
  `userName` varchar(255) NOT NULL,
  `summary` text,
  `creatorId` bigint(20) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `groups`
--

INSERT INTO `groups` (`groupName`, `id`, `userName`, `summary`, `creatorId`) VALUES
('Programming Stuff', 3, 'Michael', 'Anything but php.', 3),
('Education', 7, 'Administration', NULL, 7),
('stuff', 7, 'Administration', 'Things and stuff', 7),
('Game Design', 3, 'Michael', 'Pew Pew Pew', 3),
('Education', 5, 'Cilantro', NULL, 7),
('Programming Stuff', 5, 'Cilantro', 'Anything but php.', 3),
('stuff', 3, 'Michael', NULL, 7),
('Education', 3, 'Michael', NULL, 7),
('TV Director', 3, 'Michael', 'Director for an action TV Show. Requires dynamic shots, knowledge on martial arts, and at least 5 years experience.', 3),
('Education', 8, 'Me', NULL, 7),
('Testing', 3, 'Michael', 'Testing this add group out.', 3);

-- --------------------------------------------------------

--
-- Table structure for table `job`
--

DROP TABLE IF EXISTS `job`;
CREATE TABLE `job` (
  `jobId` bigint(20) UNSIGNED NOT NULL,
  `id` bigint(20) UNSIGNED NOT NULL,
  `jname` varchar(255) NOT NULL,
  `requirement` varchar(255) NOT NULL,
  `summary` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `job`
--

INSERT INTO `job` (`jobId`, `id`, `jname`, `requirement`, `summary`) VALUES
(1, 3, 'Chief', 'Working a stove', 'Doing the thing where you make stuff on plates taste good because lets be fair food tastes good when cooked with grace. Why the heck did this not work a second ago? Was it a flook or is everything good?'),
(2, 7, 'Random', 'From Admin', 'akdfjakfjka jfkaj fkajfkj af'),
(3, 3, 'TV Director', 'Dynamic shots, 5 years of experience.', 'Director for an action TV Show. Action involves martial arts, shooting sequences, and car chases.'),
(4, 3, 'Programmer', 'PHP, Blade, Javascript', 'Making a social media website with job postings, groups, portfolios.'),
(5, 3, 'Radio Host', '2 Years Experience', 'Hosting a radio show for a country station that has half a million listeners.'),
(6, 3, 'Javascript', '3 years programming experience', 'Working on a dynamic web page for a department store.'),
(7, 3, 'Radio Mixer', '4 Years experiences', 'Control the audio and mixing of radio show for a country station.'),
(8, 3, 'Clean Floors', 'Gradeschool, Good with Mop.', 'Cleaning the floors in an elementary school.'),
(9, 3, 'Rad Paintings', 'Artist', 'Someone who is willing to make a couple of paintings that look cool.'),
(10, 7, 'Petcare', '2 Years in Retail', 'Take care of an Array of animals in a pet store.'),
(11, 7, 'Cashier', 'Highschool Degree', 'Front line cashier focused on checking out customers in an orderly fashion. Radiating with joy for the customers.'),
(12, 7, 'Window Washers', '2 Years of any work', 'Cleaning the windows of skyscrapers. Dangerous job.'),
(13, 7, 'Bird Watcher', 'Any experience with animals', 'Taking care of birds at an important bird sanctuary where hundreds of birds of many sizes are held.'),
(14, 7, 'Decipher Hieroglyphics', 'Dr. In History', 'Deciphering Ancient Egyptian hieroglyphics talking about the sun god ra.'),
(15, 7, 'Some job', 'Just some space.', 'Finding things to put in here. Ra and other things.'),
(16, 3, 'Mixer Radio', 'Just a Switch', 'Testing more of these things for the heck of it.'),
(17, 3, 'Cup Designer', '2 Years in art', 'I have this cool idea of a cup with some letters on it and other things. Letters will be RA.');

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
(3, 'Michael', 'mmohler1@my.gcu.edu', 'admin', NULL, '$2y$10$0X7Tu6WN9CANC0FcmPVHiO8b.bEBcaYtPeszqfqTGWdTbCJkg0eZ2', 'XZCf40YGhqpvs2PtHMZMYuj8eNv4di5Tk5eW2eCO1pmGeoj34JeTVEiBVDbP', '2021-02-11 03:55:09', '2021-02-11 03:55:09'),
(5, 'Cilantro', 'Cilantro@yahoo.com', 'user', NULL, '$2y$10$/QVhMFRYvikvBC/BnS1Zl.EcLNzLjygPqd7Epx1Cfl8YJ/M.Lq4hu', 'QvZHYlGua6mjawHM1R2ySxaG9tIJZSBGOo174DMyhZZaHeCDRec4sPWxtoHD', '2021-02-12 02:48:06', '2021-02-12 02:48:06'),
(7, 'Administration', 'Root@gmail.com', 'admin', NULL, '$2y$10$gkgvE6XP3ts3jxyum/srY.LYzfS3K/Y1neQJSbIrpYZf/Ry0AYyI6', NULL, '2021-02-23 06:52:18', '2021-02-23 06:52:18'),
(8, 'Me', 'Stuff@gmail.com', 'user', NULL, '$2y$10$E4UZiOutan2ydrx9JM6lnOhWNVIiCGnk1A8EYYYhu51T2uuWl1yk6', NULL, '2021-03-27 04:14:21', '2021-03-27 04:14:21');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `apply`
--
ALTER TABLE `apply`
  ADD PRIMARY KEY (`applyId`);

--
-- Indexes for table `efolio`
--
ALTER TABLE `efolio`
  ADD KEY `eConstraint` (`id`);

--
-- Indexes for table `groups`
--
ALTER TABLE `groups`
  ADD KEY `id` (`id`);

--
-- Indexes for table `job`
--
ALTER TABLE `job`
  ADD PRIMARY KEY (`jobId`),
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
-- AUTO_INCREMENT for table `apply`
--
ALTER TABLE `apply`
  MODIFY `applyId` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `job`
--
ALTER TABLE `job`
  MODIFY `jobId` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=18;

--
-- AUTO_INCREMENT for table `migrations`
--
ALTER TABLE `migrations`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `efolio`
--
ALTER TABLE `efolio`
  ADD CONSTRAINT `eConstraint` FOREIGN KEY (`id`) REFERENCES `users` (`id`);

--
-- Constraints for table `groups`
--
ALTER TABLE `groups`
  ADD CONSTRAINT `gConstraint` FOREIGN KEY (`id`) REFERENCES `users` (`id`);

--
-- Constraints for table `job`
--
ALTER TABLE `job`
  ADD CONSTRAINT `jconstraint` FOREIGN KEY (`id`) REFERENCES `users` (`id`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
