-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: localhost
-- Generation Time: Sep 30, 2024 at 01:46 AM
-- Server version: 10.4.28-MariaDB
-- PHP Version: 8.0.28

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `laravel_ai_certificate`
--

-- --------------------------------------------------------

--
-- Table structure for table `attendance`
--

CREATE TABLE `attendance` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `user_id` bigint(20) UNSIGNED NOT NULL,
  `event_id` bigint(20) UNSIGNED NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `timeout` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `attendance`
--

INSERT INTO `attendance` (`id`, `user_id`, `event_id`, `created_at`, `timeout`, `updated_at`, `deleted_at`) VALUES
(1, 2, 1, '2024-04-07 17:26:19', NULL, '2024-04-07 17:26:19', '2024-04-07 17:34:24'),
(2, 2, 1, '2024-04-07 17:36:14', NULL, '2024-04-07 17:36:14', '2024-04-09 14:54:46'),
(3, 2, 1, '2024-04-07 17:37:16', NULL, '2024-04-07 17:37:16', NULL),
(4, 3, 1, '2024-04-09 17:39:22', NULL, '2024-04-09 17:39:22', NULL),
(5, 2, 2, '2024-04-23 22:12:43', NULL, '2024-04-23 22:12:43', NULL),
(6, 2, 3, '2024-04-26 09:25:20', NULL, '2024-04-26 09:25:20', NULL),
(7, 5, 4, '2024-06-14 06:38:55', NULL, '2024-06-14 06:38:55', NULL),
(8, 14, 3, '2024-06-19 10:35:22', NULL, '2024-06-19 10:35:22', NULL),
(9, 14, 5, '2024-06-19 10:56:39', NULL, '2024-06-19 10:56:39', NULL),
(10, 15, 6, '2024-06-20 05:19:41', NULL, '2024-06-20 05:19:41', NULL),
(11, 16, 6, '2024-06-25 13:08:25', NULL, '2024-06-25 13:08:25', NULL),
(12, 16, 7, '2024-06-25 13:20:15', NULL, '2024-06-25 13:20:15', NULL),
(13, 16, 8, '2024-06-25 17:07:17', NULL, '2024-06-25 17:07:17', NULL),
(14, 16, 9, '2024-09-29 21:01:12', '2024-09-29 23:25:07', '2024-09-29 23:25:07', NULL),
(15, 3, 9, '2024-04-09 17:39:22', NULL, '2024-04-09 17:39:22', NULL);

--
-- Indexes for dumped tables
--

--
-- Indexes for table `attendance`
--
ALTER TABLE `attendance`
  ADD PRIMARY KEY (`id`),
  ADD KEY `attendance_user_id_foreign` (`user_id`),
  ADD KEY `attendance_event_id_foreign` (`event_id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `attendance`
--
ALTER TABLE `attendance`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=16;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `attendance`
--
ALTER TABLE `attendance`
  ADD CONSTRAINT `attendance_event_id_foreign` FOREIGN KEY (`event_id`) REFERENCES `events` (`id`),
  ADD CONSTRAINT `attendance_user_id_foreign` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
