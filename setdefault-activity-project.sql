-- phpMyAdmin SQL Dump
-- version 5.2.2
-- https://www.phpmyadmin.net/
--
-- Host: mysql-db-activity
-- Generation Time: Mar 03, 2025 at 03:56 PM
-- Server version: 9.2.0
-- PHP Version: 8.2.27

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `db`
--

-- --------------------------------------------------------

--
-- Table structure for table `account`
--

CREATE TABLE `account` (
  `aid` varchar(255) NOT NULL,
  `fname` varchar(255) NOT NULL,
  `lname` varchar(255) DEFAULT NULL,
  `birthday` date DEFAULT NULL,
  `gmail` varchar(255) DEFAULT NULL,
  `gender` varchar(10) DEFAULT NULL,
  `image` text,
  `datetime` datetime DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

-- --------------------------------------------------------

--
-- Table structure for table `image`
--

CREATE TABLE `image` (
  `datetime` datetime DEFAULT CURRENT_TIMESTAMP,
  `image` varchar(1000) DEFAULT NULL,
  `pid` varchar(255) NOT NULL,
  `id` int NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

-- --------------------------------------------------------

--
-- Table structure for table `post`
--

CREATE TABLE `post` (
  `p_id` varchar(255) NOT NULL,
  `p_aid` varchar(255) NOT NULL,
  `p_name` text CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci,
  `p_about` text CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci,
  `p_max` int DEFAULT NULL,
  `p_address` text CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci,
  `p_date_start` date DEFAULT NULL,
  `p_date_end` date DEFAULT NULL,
  `p_give` text CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci,
  `p_datetime` datetime DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

-- --------------------------------------------------------

--
-- Table structure for table `register`
--

CREATE TABLE `register` (
  `datetime` datetime DEFAULT CURRENT_TIMESTAMP,
  `pid` varchar(255) NOT NULL,
  `aid` varchar(255) NOT NULL,
  `status` varchar(255) DEFAULT NULL,
  `datetime_submit` date DEFAULT NULL,
  `image_submit` text,
  `status_submit` varchar(255) DEFAULT NULL,
  `id` int NOT NULL,
  `isRead` tinyint(1) NOT NULL DEFAULT '0'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Indexes for dumped tables
--

--
-- Indexes for table `account`
--
ALTER TABLE `account`
  ADD PRIMARY KEY (`aid`) USING BTREE;

--
-- Indexes for table `image`
--
ALTER TABLE `image`
  ADD PRIMARY KEY (`id`),
  ADD KEY `fk_image_pid` (`pid`);

--
-- Indexes for table `post`
--
ALTER TABLE `post`
  ADD PRIMARY KEY (`p_id`) USING BTREE,
  ADD KEY `fk_create_aid` (`p_aid`);

--
-- Indexes for table `register`
--
ALTER TABLE `register`
  ADD PRIMARY KEY (`id`),
  ADD KEY `fk_pid` (`pid`),
  ADD KEY `fk_aid` (`aid`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `image`
--
ALTER TABLE `image`
  MODIFY `id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=95;

--
-- AUTO_INCREMENT for table `register`
--
ALTER TABLE `register`
  MODIFY `id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=59;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `image`
--
ALTER TABLE `image`
  ADD CONSTRAINT `fk_image_pid` FOREIGN KEY (`pid`) REFERENCES `post` (`p_id`) ON DELETE CASCADE;

--
-- Constraints for table `post`
--
ALTER TABLE `post`
  ADD CONSTRAINT `fk_create_aid` FOREIGN KEY (`p_aid`) REFERENCES `account` (`aid`) ON DELETE CASCADE;

--
-- Constraints for table `register`
--
ALTER TABLE `register`
  ADD CONSTRAINT `fk_aid` FOREIGN KEY (`aid`) REFERENCES `account` (`aid`) ON DELETE CASCADE,
  ADD CONSTRAINT `fk_pid` FOREIGN KEY (`pid`) REFERENCES `post` (`p_id`) ON DELETE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
