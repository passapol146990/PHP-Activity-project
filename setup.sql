-- phpMyAdmin SQL Dump
-- version 5.2.2
-- https://www.phpmyadmin.net/
--
-- Host: mysql-db-activity
-- Generation Time: Mar 03, 2025 at 04:52 AM
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

--
-- Dumping data for table `account`
--

INSERT INTO `account` (`aid`, `fname`, `lname`, `birthday`, `gmail`, `gender`, `image`, `datetime`) VALUES
('476c6c583fd0c2f1dee6e86e241f5e859231c0e8451d25166f2339584f01051c', 'passapol', 'sutatam', '2004-06-06', 'passapol.sutatam@gmail.com', 'ชาย', '476c6c583fd0c2f1dee6e86e241f5e859231c0e8451d25166f2339584f01051c_1740898039.jpg', '2025-03-02 06:47:20'),
('790a257754efc52c13672d4d9818dd5f5e2a84de299b49f626b78def718a5c66', 'PHOL', 'Timgan ez', '2025-03-03', 'phasphlsuthathrrm976@gmail.com', 'ชาย', '790a257754efc52c13672d4d9818dd5f5e2a84de299b49f626b78def718a5c66_1740942579.jpg', '2025-03-02 19:09:40'),
('e8b901c50641270a4d671f15f6550d252a6ec781c0cb9ba77502c078ce33065a', 'พัสพล', 'สุทาธรรม', '2004-03-02', '66011212067@msu.ac.th', 'ชาย', 'e8b901c50641270a4d671f15f6550d252a6ec781c0cb9ba77502c078ce33065a_1740924042.jpg', '2025-03-02 14:00:42');

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

--
-- Dumping data for table `image`
--

INSERT INTO `image` (`datetime`, `image`, `pid`, `id`) VALUES
('2025-03-03 01:44:33', '20250303790a257754efc52c13672d4d9818dd5f5e2a84de299b49f626b78def718a5c66_67c5098159790.png', 'c453c349c9ce0dae3c6d4e2ac3b4a80af28eba7bc9c461a0004d0b0d485e7f43', 7),
('2025-03-03 01:44:33', '20250303790a257754efc52c13672d4d9818dd5f5e2a84de299b49f626b78def718a5c66_67c50981615d8.png', 'c453c349c9ce0dae3c6d4e2ac3b4a80af28eba7bc9c461a0004d0b0d485e7f43', 8),
('2025-03-03 01:44:33', '20250303790a257754efc52c13672d4d9818dd5f5e2a84de299b49f626b78def718a5c66_67c5098167baf.png', 'c453c349c9ce0dae3c6d4e2ac3b4a80af28eba7bc9c461a0004d0b0d485e7f43', 9),
('2025-03-03 01:44:33', '20250303790a257754efc52c13672d4d9818dd5f5e2a84de299b49f626b78def718a5c66_67c509816e156.png', 'c453c349c9ce0dae3c6d4e2ac3b4a80af28eba7bc9c461a0004d0b0d485e7f43', 10),
('2025-03-03 01:44:33', '20250303790a257754efc52c13672d4d9818dd5f5e2a84de299b49f626b78def718a5c66_67c5098175fcf.png', 'c453c349c9ce0dae3c6d4e2ac3b4a80af28eba7bc9c461a0004d0b0d485e7f43', 11),
('2025-03-03 01:49:09', '20250303790a257754efc52c13672d4d9818dd5f5e2a84de299b49f626b78def718a5c66_67c50a95d6e17.png', '3cc33cb184a9169b9184d29fc63cf2f853670d023044dcfa40442e7bbb47de2d', 12),
('2025-03-03 01:54:00', '20250303790a257754efc52c13672d4d9818dd5f5e2a84de299b49f626b78def718a5c66_67c50bb8eac17.png', '9346e6b3473f90b5556e047199ca5e49c340115160384f65454526e640f67b52', 13);

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

--
-- Dumping data for table `post`
--

INSERT INTO `post` (`p_id`, `p_aid`, `p_name`, `p_about`, `p_max`, `p_address`, `p_date_start`, `p_date_end`, `p_give`, `p_datetime`) VALUES
('3cc33cb184a9169b9184d29fc63cf2f853670d023044dcfa40442e7bbb47de2d', '790a257754efc52c13672d4d9818dd5f5e2a84de299b49f626b78def718a5c66', 'แข่งเขียนเว็บไซด์ ครั้งที่ 1', 'แข่งเขียนเว็บไซด์บันทึกกิจกรรม\r\nโดยให้เขียนเว็บไซด์ที่สามารถ\r\n- ล็อกอินได้\r\n- สร้างกิจรรมได้\r\n- สมัครกิจกรรมได้\r\nโดยทำให้สมเหตุสมผลที่สุด\r\nเป็นการแข่งแบบออนไลน์ google meet อ่านรายละเอียดเพิ่มเติมที่ : https://docs.google.com/document/d/1s4xu6f9WJJFutjitvj6gUQckGaFLSnDpWENCO4bN6Jc/edit?usp=sharing', 10, 'ออนไลน์', '2025-03-10', '2025-03-10', 'ผู้ชนะกิจกรรมอันดับที่ 1 ได้รับเงิน 10000 บาท', '2025-03-03 01:49:09'),
('9346e6b3473f90b5556e047199ca5e49c340115160384f65454526e640f67b52', '790a257754efc52c13672d4d9818dd5f5e2a84de299b49f626b78def718a5c66', 'แข่งเขียนเว็บไซด์ ครั้งที่ 2', 'แข่งเขียนเว็บไซด์ API End point\r\nโดยให้เขียนเว็บไซด์ที่สามารถ\r\n- ล็อกอินได้\r\n- สร้างกิจรรมได้\r\n- สมัครกิจกรรมได้\r\nโดยทำให้สมเหตุสมผลที่สุด\r\nเป็นการแข่งแบบออนไลน์ google meet อ่านรายละเอียดเพิ่มเติมที่ : https://docs.google.com/document/d/1s4xu6f9WJJFutjitvj6gUQckGaFLSnDpWENCO4bN6Jc/edit?usp=sharing', 10, 'ออนไลน์', '2025-03-11', '2025-03-11', 'ผู้ชนะกิจกรรมอันดับที่ 1 ได้รับเงิน 10000 บาท', '2025-03-03 01:54:00'),
('c453c349c9ce0dae3c6d4e2ac3b4a80af28eba7bc9c461a0004d0b0d485e7f43', '790a257754efc52c13672d4d9818dd5f5e2a84de299b49f626b78def718a5c66', 'Coding IT ครั้งที่ 1', 'แข่งขันเขียนโปรแกรมครั้งที่ 1 \r\nผู้เข้าแข่งขันเริ่มแข่งที่ : มหาวิทยาลัยมหาสารคาม คณะ IT ชั้น 4 ห้อง 401\r\nเวลาในการแข่งขัน : 8.00 - 16.00 น.\r\nวันที่จัดกิจกรรม : 8/8/2568\r\nสิ่งที่ผู้เข้าร่วมต้องเตรียมมามีแค่โน๊ตบุ๊ค', 50, 'มหาวิทยาลัยมหาสารคาม คณะ IT ชั้น 4 ห้อง 401', '2025-08-08', '2025-08-08', 'เงินรางวัลที่ 1 จำนวน 10000 บาท เงินรางวัลที่ 2 จำนวน 5000 บาท เงินรางวัลที่ 3 จำนวน 1000 บาท และ เงินรางวัลที่ 4-15 จำนวน 100 บาท', '2025-03-03 01:44:33');

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
  MODIFY `id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=17;

--
-- AUTO_INCREMENT for table `register`
--
ALTER TABLE `register`
  MODIFY `id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=31;

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
