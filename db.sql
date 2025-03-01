-- phpMyAdmin SQL Dump
-- version 5.2.2
-- https://www.phpmyadmin.net/
--
-- Host: mysql-db-activity
-- Generation Time: Mar 01, 2025 at 01:19 PM
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
  `id` int NOT NULL,
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

INSERT INTO `account` (`id`, `aid`, `fname`, `lname`, `birthday`, `gmail`, `gender`, `image`, `datetime`) VALUES
(1, '476c6c583fd0c2f1dee6e86e241f5e859231c0e8451d25166f2339584f01051c', 'พัสพล', 'สุทาธรรม', '2004-06-06', 'passapol.sutatam@gmail.com', 'ชาย', 'https://lh3.googleusercontent.com/a/ACg8ocLEtsi8D0taNDubAOmqHCRyp6Wag9lUo0Qe3lArfOI9ZEE2oj6e=s96-c', '2025-02-28 15:50:56'),
(2, 'e8b901c50641270a4d671f15f6550d252a6ec781c0cb9ba77502c078ce33065a', '', '', NULL, '66011212067@msu.ac.th', NULL, 'https://lh3.googleusercontent.com/a/ACg8ocLt8sCD1rz5v0DYIBejeKd2hyaa6RevlLc17TX0qBNMOqot4ls=s96-c', '2025-03-01 07:35:32'),
(3, '5b894e0e4589c02c8d4646267015342b8fdf659a6b65ddf3d08527fe467c77c3', '', '', NULL, '66011212245@msu.ac.th', NULL, 'https://lh3.googleusercontent.com/a/ACg8ocKbs02z3_RXwf4Rl_F3wJAHCscIQtRFdmpCTPAzCn9rHWxjRDU=s96-c', '2025-03-01 11:14:57'),
(4, 'f65ba59fe678bf4832414438b16d14d6ebf149c888f962fceb1b9f9fa7f03482', '', '', NULL, '66011212182@msu.ac.th', NULL, 'https://lh3.googleusercontent.com/a/ACg8ocINJS-k-QTg0pwKZoZA4Pa2dBth3Mh6xYjJoxPPp0wYgIdDjDs=s96-c', '2025-03-01 11:15:48'),
(5, '1c972a87cebf998c06a381dc8762fd9ad1ac3e2c9f19846d0ce9198c618ae8bb', '', '', NULL, 'myname47586@gmail.com', NULL, 'https://lh3.googleusercontent.com/a/ACg8ocJqU_noSXEoX5KlKOXH1TDXDLrRw42cdMFE6aTz92v-lhuQ7w=s96-c', '2025-03-01 11:46:56'),
(6, '7e97abeb29b66563234df300abfc6b3c505739c45485828f811b2534a9a9b34a', '', '', NULL, 'tmoon2860@gmail.com', NULL, 'https://lh3.googleusercontent.com/a/ACg8ocJ69AFDpHfT7vu5xKHo19m-zc02VxS7KM8bYn1vYFDFtPHhVSU=s96-c', '2025-03-01 11:47:36'),
(7, '790a257754efc52c13672d4d9818dd5f5e2a84de299b49f626b78def718a5c66', 'PHOL', 'Timgan ez', NULL, 'phasphlsuthathrrm976@gmail.com', NULL, 'https://lh3.googleusercontent.com/a/ACg8ocK8pmZC4yFMMG5NDGJlOkz6d0I-_Gpnh-QfCHoiiOF7CuhtTepp=s96-c', '2025-03-01 11:53:45'),
(8, 'a7d57dc302f77a348b304c27a2d848b210fcb285c10286e0c4ae382e1b1832d2', 'CS66', 'Money', NULL, 'moneycs66np@gmail.com', NULL, 'https://lh3.googleusercontent.com/a/ACg8ocKq2yyF1e-LK8jx4O-bRCb03Vuz0pPzm_8XyeXY87n51rZSUA=s96-c', '2025-03-01 12:18:09');

-- --------------------------------------------------------

--
-- Table structure for table `image`
--

CREATE TABLE `image` (
  `id` int NOT NULL,
  `datetime` datetime DEFAULT CURRENT_TIMESTAMP,
  `image` varchar(1000) DEFAULT NULL,
  `pid` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Dumping data for table `image`
--

INSERT INTO `image` (`id`, `datetime`, `image`, `pid`) VALUES
(6, '2025-02-28 18:00:30', '20250228476c6c583fd0c2f1dee6e86e241f5e859231c0e8451d25166f2339584f01051c_67c1f9be45280.png', '03aa9b124dd7875a0e64d4421425c22855dc90dacf79159a592c066ac5f97ea2'),
(7, '2025-02-28 18:00:30', '20250228476c6c583fd0c2f1dee6e86e241f5e859231c0e8451d25166f2339584f01051c_67c1f9be49530.png', '03aa9b124dd7875a0e64d4421425c22855dc90dacf79159a592c066ac5f97ea2'),
(8, '2025-02-28 18:00:30', '20250228476c6c583fd0c2f1dee6e86e241f5e859231c0e8451d25166f2339584f01051c_67c1f9be4f97f.png', '03aa9b124dd7875a0e64d4421425c22855dc90dacf79159a592c066ac5f97ea2'),
(9, '2025-02-28 18:00:30', '20250228476c6c583fd0c2f1dee6e86e241f5e859231c0e8451d25166f2339584f01051c_67c1f9be52acb.png', '03aa9b124dd7875a0e64d4421425c22855dc90dacf79159a592c066ac5f97ea2'),
(10, '2025-03-01 02:50:30', '20250301476c6c583fd0c2f1dee6e86e241f5e859231c0e8451d25166f2339584f01051c_67c275f63e82f.png', 'b2caff1379b72da57569b73a7312495815b64d9028ea3d0b5c11782d51d06b05'),
(11, '2025-03-01 02:50:30', '20250301476c6c583fd0c2f1dee6e86e241f5e859231c0e8451d25166f2339584f01051c_67c275f6425d7.png', 'b2caff1379b72da57569b73a7312495815b64d9028ea3d0b5c11782d51d06b05'),
(12, '2025-03-01 02:50:30', '20250301476c6c583fd0c2f1dee6e86e241f5e859231c0e8451d25166f2339584f01051c_67c275f6463fe.png', 'b2caff1379b72da57569b73a7312495815b64d9028ea3d0b5c11782d51d06b05'),
(13, '2025-03-01 02:50:30', '20250301476c6c583fd0c2f1dee6e86e241f5e859231c0e8451d25166f2339584f01051c_67c275f6498b7.png', 'b2caff1379b72da57569b73a7312495815b64d9028ea3d0b5c11782d51d06b05'),
(14, '2025-03-01 07:00:48', '20250301476c6c583fd0c2f1dee6e86e241f5e859231c0e8451d25166f2339584f01051c_67c2b0a0b31ba.png', 'b38402a3b42c5bce6892f3b9097f6e6ab01bf1aa7e0631106364476756a0b9de'),
(15, '2025-03-01 13:09:10', '20250301476c6c583fd0c2f1dee6e86e241f5e859231c0e8451d25166f2339584f01051c_67c306f6cc163.png', '19a713d6b9a96e26645494f2a9f8d3faf2b5da580342808d63663f3471c86eb9'),
(16, '2025-03-01 13:09:10', '20250301476c6c583fd0c2f1dee6e86e241f5e859231c0e8451d25166f2339584f01051c_67c306f6d07d9.png', '19a713d6b9a96e26645494f2a9f8d3faf2b5da580342808d63663f3471c86eb9'),
(17, '2025-03-01 13:09:10', '20250301476c6c583fd0c2f1dee6e86e241f5e859231c0e8451d25166f2339584f01051c_67c306f6d4794.png', '19a713d6b9a96e26645494f2a9f8d3faf2b5da580342808d63663f3471c86eb9');

-- --------------------------------------------------------

--
-- Table structure for table `post`
--

CREATE TABLE `post` (
  `id` int NOT NULL,
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

INSERT INTO `post` (`id`, `p_id`, `p_aid`, `p_name`, `p_about`, `p_max`, `p_address`, `p_date_start`, `p_date_end`, `p_give`, `p_datetime`) VALUES
(4, '03aa9b124dd7875a0e64d4421425c22855dc90dacf79159a592c066ac5f97ea2', '476c6c583fd0c2f1dee6e86e241f5e859231c0e8451d25166f2339584f01051c', 'ทดสอบระบบ', 'พัสพลทดสอบระบบ ด้วยการบันทึกรูปกิจกรรม 4 รูป', 20, 'ออนไลน์', '2000-01-01', '2000-02-01', 'ความรู้ น้ำดื่ม ข้าวเที่ยง', '2025-02-28 18:00:30'),
(5, 'b2caff1379b72da57569b73a7312495815b64d9028ea3d0b5c11782d51d06b05', '476c6c583fd0c2f1dee6e86e241f5e859231c0e8451d25166f2339584f01051c', 'ทดสอบระบบ2', 'x', 20, 'ออนไลน์', '0001-10-01', '0001-01-01', 'ความรู้ น้ำดื่ม ข้าวเที่ยง', '2025-03-01 02:50:30'),
(6, '279fd2bfd2b6575ac5255d947a296b344b8f3aaf0cc4295c195b473b079c1c25', '476c6c583fd0c2f1dee6e86e241f5e859231c0e8451d25166f2339584f01051c', 'ทดสอบระบบ3', NULL, 20, 'ออนไลน์', '2004-02-02', '2004-02-02', 'ความรู้ น้ำดื่ม ข้าวเที่ยง', '2025-03-01 06:59:11'),
(7, 'b38402a3b42c5bce6892f3b9097f6e6ab01bf1aa7e0631106364476756a0b9de', '476c6c583fd0c2f1dee6e86e241f5e859231c0e8451d25166f2339584f01051c', 'แข่งเขียนโค้ด ครั้งที่ 1', 'แข่งเขียนโปรแกรมด้วยภาษาคอมพิวเตอร์ไม่จำกันภาษา', 50, 'ออนไลน์', '2568-05-03', '2568-05-03', 'เงินรางวัล 2,500 บาท', '2025-03-01 07:00:48'),
(8, '19a713d6b9a96e26645494f2a9f8d3faf2b5da580342808d63663f3471c86eb9', '476c6c583fd0c2f1dee6e86e241f5e859231c0e8451d25166f2339584f01051c', 'ป', 'ป', 100, 'ป', '2000-01-03', '2000-01-03', 'ป', '2025-03-01 13:09:10');

-- --------------------------------------------------------

--
-- Table structure for table `register`
--

CREATE TABLE `register` (
  `id` int NOT NULL,
  `datetime` datetime DEFAULT CURRENT_TIMESTAMP,
  `pid` varchar(255) NOT NULL,
  `cid` varchar(255) NOT NULL,
  `aid` varchar(255) NOT NULL,
  `status` varchar(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

-- --------------------------------------------------------

--
-- Table structure for table `submit`
--

CREATE TABLE `submit` (
  `id` int NOT NULL,
  `datetime` datetime DEFAULT CURRENT_TIMESTAMP,
  `image` varchar(1000) DEFAULT NULL,
  `pid` varchar(255) NOT NULL,
  `aid` varchar(255) NOT NULL,
  `status` varchar(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Indexes for dumped tables
--

--
-- Indexes for table `account`
--
ALTER TABLE `account`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `aid` (`aid`);

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
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `p_id` (`p_id`),
  ADD KEY `fk_create_aid` (`p_aid`);

--
-- Indexes for table `register`
--
ALTER TABLE `register`
  ADD PRIMARY KEY (`id`),
  ADD KEY `fk_pid` (`pid`),
  ADD KEY `fk_cid` (`cid`),
  ADD KEY `fk_aid` (`aid`);

--
-- Indexes for table `submit`
--
ALTER TABLE `submit`
  ADD PRIMARY KEY (`id`),
  ADD KEY `fk_post_pid` (`pid`),
  ADD KEY `fk_submit_aid` (`aid`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `account`
--
ALTER TABLE `account`
  MODIFY `id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- AUTO_INCREMENT for table `image`
--
ALTER TABLE `image`
  MODIFY `id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=18;

--
-- AUTO_INCREMENT for table `post`
--
ALTER TABLE `post`
  MODIFY `id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- AUTO_INCREMENT for table `register`
--
ALTER TABLE `register`
  MODIFY `id` int NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `submit`
--
ALTER TABLE `submit`
  MODIFY `id` int NOT NULL AUTO_INCREMENT;

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
  ADD CONSTRAINT `fk_cid` FOREIGN KEY (`cid`) REFERENCES `account` (`aid`) ON DELETE CASCADE,
  ADD CONSTRAINT `fk_pid` FOREIGN KEY (`pid`) REFERENCES `post` (`p_id`) ON DELETE CASCADE;

--
-- Constraints for table `submit`
--
ALTER TABLE `submit`
  ADD CONSTRAINT `fk_post_pid` FOREIGN KEY (`pid`) REFERENCES `post` (`p_id`) ON DELETE CASCADE,
  ADD CONSTRAINT `fk_submit_aid` FOREIGN KEY (`aid`) REFERENCES `account` (`aid`) ON DELETE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
