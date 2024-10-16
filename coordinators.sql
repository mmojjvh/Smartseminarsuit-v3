-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: localhost
-- Generation Time: Oct 11, 2024 at 01:07 AM
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
-- Table structure for table `coordinators`
--

CREATE TABLE `coordinators` (
  `id` int(11) NOT NULL,
  `event_id` int(11) NOT NULL,
  `name` varchar(999) NOT NULL,
  `signature` longtext NOT NULL,
  `created_at` timestamp NULL DEFAULT current_timestamp(),
  `updated_at` timestamp NULL DEFAULT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `coordinators`
--

INSERT INTO `coordinators` (`id`, `event_id`, `name`, `signature`, `created_at`, `updated_at`, `deleted_at`) VALUES
(1, 40, 'aqwer qwrqwrq rqr', 'data:image/png;base64,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', '2024-09-30 22:51:59', '2024-09-30 22:51:59', '0000-00-00 00:00:00');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `coordinators`
--
ALTER TABLE `coordinators`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `coordinators`
--
ALTER TABLE `coordinators`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
