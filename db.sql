-- phpMyAdmin SQL Dump
-- version 5.2.2
-- https://www.phpmyadmin.net/
--
-- Host: mysql-db-activity
-- Generation Time: Mar 02, 2025 at 06:48 PM
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
('2025-03-02 15:51:24', '20250302476c6c583fd0c2f1dee6e86e241f5e859231c0e8451d25166f2339584f01051c_67c47e7c3302d.png', '25a3b08361bbb505ade3c2f709046ad364a952bfb544a5c50abdc47f7cf437a8', 1),
('2025-03-02 15:59:03', '20250302476c6c583fd0c2f1dee6e86e241f5e859231c0e8451d25166f2339584f01051c_67c480473ac65.png', '943929e3ac2f1bc11051b9824be64e8a6248868820bc4eb903f837561638ad0e', 2),
('2025-03-02 18:02:21', '20250302476c6c583fd0c2f1dee6e86e241f5e859231c0e8451d25166f2339584f01051c_67c49d2d48ca0.png', 'b4fec308b27962fe37ed501e9477c4a0e81c518039d0d663008c1d34d2a0c2e5', 3);

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
('25a3b08361bbb505ade3c2f709046ad364a952bfb544a5c50abdc47f7cf437a8', '476c6c583fd0c2f1dee6e86e241f5e859231c0e8451d25166f2339584f01051c', 'พัสพล ทดสอบระบบ', 's', 5, 'กองกิจการนิสิต', '2025-03-02', '2025-03-02', '10,000 บาท', '2025-03-02 15:51:24'),
('943929e3ac2f1bc11051b9824be64e8a6248868820bc4eb903f837561638ad0e', '476c6c583fd0c2f1dee6e86e241f5e859231c0e8451d25166f2339584f01051c', 'xxxx', 'x', 5, 'กองกิจการนิสิต', '2025-03-02', '2025-03-02', '10,000 บาท', '2025-03-02 15:59:03'),
('b4fec308b27962fe37ed501e9477c4a0e81c518039d0d663008c1d34d2a0c2e5', '476c6c583fd0c2f1dee6e86e241f5e859231c0e8451d25166f2339584f01051c', 'xxxx ', 'x', 50, 'xx', '2025-03-10', '2025-03-10', 'xx', '2025-03-02 18:02:21');

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
  `isRead` int NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Dumping data for table `register`
--

INSERT INTO `register` (`datetime`, `pid`, `aid`, `status`, `datetime_submit`, `image_submit`, `status_submit`, `id`, `isRead`) VALUES
('2025-03-02 16:57:41', '943929e3ac2f1bc11051b9824be64e8a6248868820bc4eb903f837561638ad0e', '476c6c583fd0c2f1dee6e86e241f5e859231c0e8451d25166f2339584f01051c', 'อนุมัติ', NULL, NULL, NULL, 1, 2),
('2025-03-02 18:26:43', 'b4fec308b27962fe37ed501e9477c4a0e81c518039d0d663008c1d34d2a0c2e5', '476c6c583fd0c2f1dee6e86e241f5e859231c0e8451d25166f2339584f01051c', 'รอการตรวจสอบ', NULL, NULL, NULL, 2, 0),
('2025-03-02 18:39:57', '25a3b08361bbb505ade3c2f709046ad364a952bfb544a5c50abdc47f7cf437a8', '476c6c583fd0c2f1dee6e86e241f5e859231c0e8451d25166f2339584f01051c', 'รอการตรวจสอบ', NULL, NULL, NULL, 3, 0);

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
  MODIFY `id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `register`
--
ALTER TABLE `register`
  MODIFY `id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

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
