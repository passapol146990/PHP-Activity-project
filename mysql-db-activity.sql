-- phpMyAdmin SQL Dump
-- version 5.2.2
-- https://www.phpmyadmin.net/
--
-- Host: mysql-db-activity
-- Generation Time: Mar 10, 2025 at 04:39 AM
-- Server version: 5.7.44
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
CREATE DATABASE IF NOT EXISTS `db` DEFAULT CHARACTER SET latin1 COLLATE latin1_swedish_ci;
USE `db`;

-- --------------------------------------------------------

--
-- Table structure for table `account`
--

CREATE TABLE `account` (
  `aid` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `fname` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `lname` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `birthday` date DEFAULT NULL,
  `gmail` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `gender` varchar(10) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `image` text COLLATE utf8mb4_unicode_ci,
  `datetime` datetime DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `account`
--

INSERT INTO `account` (`aid`, `fname`, `lname`, `birthday`, `gmail`, `gender`, `image`, `datetime`) VALUES
('476c6c583fd0c2f1dee6e86e241f5e859231c0e8451d25166f2339584f01051c', 'passapol', 'sutatam', '2004-03-10', 'passapol.sutatam@gmail.com', 'ไม่ระบุเพศ', '476c6c583fd0c2f1dee6e86e241f5e859231c0e8451d25166f2339584f01051c_1741541265.jpg', '2025-03-09 17:27:57'),
('5b894e0e4589c02c8d4646267015342b8fdf659a6b65ddf3d08527fe467c77c3', 'นายภานุมาศ', 'สายธนู', '2005-03-10', '66011212245@msu.ac.th', 'ไม่ระบุเพศ', '5b894e0e4589c02c8d4646267015342b8fdf659a6b65ddf3d08527fe467c77c3_1741541268.jpg', '2025-03-09 17:28:07'),
('6fcc022e4b0b37b850ea4e72c92a1dc7de5a1456a3c74ec4c17f2d9fd1d20e01', 'ธีระภัทร', 'เชื้อนกขุ้ม', '2005-09-13', '66011212103@msu.ac.th', 'ไม่ระบุเพศ', '6fcc022e4b0b37b850ea4e72c92a1dc7de5a1456a3c74ec4c17f2d9fd1d20e01_1741549193.jpg', '2025-03-09 19:52:28'),
('f65ba59fe678bf4832414438b16d14d6ebf149c888f962fceb1b9f9fa7f03482', 'นฤพล', 'ท่าสะอาด', '2005-03-23', '66011212182@msu.ac.th', 'ไม่ระบุเพศ', 'f65ba59fe678bf4832414438b16d14d6ebf149c888f962fceb1b9f9fa7f03482_1741541399.jpg', '2025-03-09 17:30:23');

-- --------------------------------------------------------

--
-- Table structure for table `image`
--

CREATE TABLE `image` (
  `datetime` datetime DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `image` varchar(1000) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `pid` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `image`
--

INSERT INTO `image` (`datetime`, `image`, `pid`, `id`) VALUES
('2025-03-09 17:29:01', '202503095b894e0e4589c02c8d4646267015342b8fdf659a6b65ddf3d08527fe467c77c3_67cdcfdda187b.png', '45f912c3735a028cb58f3c16320a2dab2651ee8105a744a556cfb92c0f70e2d7', 67),
('2025-03-09 17:29:01', '20250309476c6c583fd0c2f1dee6e86e241f5e859231c0e8451d25166f2339584f01051c_67cdcfdd9f77c.png', '7c15e0dc48a22174fb937e8405901170a9cd2a2738fabe37dffb87152f2e171f', 68),
('2025-03-09 17:30:21', '20250309476c6c583fd0c2f1dee6e86e241f5e859231c0e8451d25166f2339584f01051c_67cdd02d1b97a.png', 'a29070f0e895a7c5066fb74f7991fa0c5dbcbf50290b5de0be9f886f63cf3327', 69),
('2025-03-09 17:30:21', '20250309476c6c583fd0c2f1dee6e86e241f5e859231c0e8451d25166f2339584f01051c_67cdd02d5999f.png', 'a29070f0e895a7c5066fb74f7991fa0c5dbcbf50290b5de0be9f886f63cf3327', 70),
('2025-03-09 17:30:21', '20250309476c6c583fd0c2f1dee6e86e241f5e859231c0e8451d25166f2339584f01051c_67cdd02d960a8.png', 'a29070f0e895a7c5066fb74f7991fa0c5dbcbf50290b5de0be9f886f63cf3327', 71),
('2025-03-09 17:30:22', '20250309476c6c583fd0c2f1dee6e86e241f5e859231c0e8451d25166f2339584f01051c_67cdd02dd8b56.png', 'a29070f0e895a7c5066fb74f7991fa0c5dbcbf50290b5de0be9f886f63cf3327', 72),
('2025-03-09 17:30:22', '20250309476c6c583fd0c2f1dee6e86e241f5e859231c0e8451d25166f2339584f01051c_67cdd02e51f78.png', 'a29070f0e895a7c5066fb74f7991fa0c5dbcbf50290b5de0be9f886f63cf3327', 73),
('2025-03-09 17:30:54', '202503095b894e0e4589c02c8d4646267015342b8fdf659a6b65ddf3d08527fe467c77c3_67cdd04e1d9a0.png', '39870bf23de553e9b7c9074b065964153eca32d590ee1dd5e6e135116f85236a', 74),
('2025-03-09 17:31:22', '20250309476c6c583fd0c2f1dee6e86e241f5e859231c0e8451d25166f2339584f01051c_67cdd06a178b3.png', '9fcb26f6d9d8303b08001a69600b7d448c06de278966616912a19a3a67319e0c', 75),
('2025-03-09 17:31:22', '20250309476c6c583fd0c2f1dee6e86e241f5e859231c0e8451d25166f2339584f01051c_67cdd06a6c1ea.png', '9fcb26f6d9d8303b08001a69600b7d448c06de278966616912a19a3a67319e0c', 76),
('2025-03-09 17:31:23', '20250309476c6c583fd0c2f1dee6e86e241f5e859231c0e8451d25166f2339584f01051c_67cdd06ae49de.png', '9fcb26f6d9d8303b08001a69600b7d448c06de278966616912a19a3a67319e0c', 77),
('2025-03-09 17:32:45', '202503095b894e0e4589c02c8d4646267015342b8fdf659a6b65ddf3d08527fe467c77c3_67cdd0bdab09f.png', '6dfa6280beffb06273fea5d1ba084a5b21f783d65eaaebbe41c2889131b9e4a0', 78),
('2025-03-09 17:33:56', '20250309476c6c583fd0c2f1dee6e86e241f5e859231c0e8451d25166f2339584f01051c_67cdd1048131d.png', 'c16b5cf3913dae3fdb4e78551c51a5bd682a594de5f44260d1e130e3300ff176', 79),
('2025-03-09 17:33:56', '20250309476c6c583fd0c2f1dee6e86e241f5e859231c0e8451d25166f2339584f01051c_67cdd1049e8cd.png', 'c16b5cf3913dae3fdb4e78551c51a5bd682a594de5f44260d1e130e3300ff176', 80),
('2025-03-09 17:33:56', '20250309476c6c583fd0c2f1dee6e86e241f5e859231c0e8451d25166f2339584f01051c_67cdd104bbee5.png', 'c16b5cf3913dae3fdb4e78551c51a5bd682a594de5f44260d1e130e3300ff176', 81),
('2025-03-09 17:33:56', '20250309476c6c583fd0c2f1dee6e86e241f5e859231c0e8451d25166f2339584f01051c_67cdd104c9972.png', 'c16b5cf3913dae3fdb4e78551c51a5bd682a594de5f44260d1e130e3300ff176', 82),
('2025-03-09 17:33:57', '20250309476c6c583fd0c2f1dee6e86e241f5e859231c0e8451d25166f2339584f01051c_67cdd104e0298.png', 'c16b5cf3913dae3fdb4e78551c51a5bd682a594de5f44260d1e130e3300ff176', 83),
('2025-03-09 17:33:57', '20250309476c6c583fd0c2f1dee6e86e241f5e859231c0e8451d25166f2339584f01051c_67cdd1054e5ef.png', 'c16b5cf3913dae3fdb4e78551c51a5bd682a594de5f44260d1e130e3300ff176', 84),
('2025-03-09 17:33:57', '20250309476c6c583fd0c2f1dee6e86e241f5e859231c0e8451d25166f2339584f01051c_67cdd10564345.png', 'c16b5cf3913dae3fdb4e78551c51a5bd682a594de5f44260d1e130e3300ff176', 85),
('2025-03-09 17:33:57', '20250309476c6c583fd0c2f1dee6e86e241f5e859231c0e8451d25166f2339584f01051c_67cdd1057233f.png', 'c16b5cf3913dae3fdb4e78551c51a5bd682a594de5f44260d1e130e3300ff176', 86),
('2025-03-09 17:33:57', '20250309476c6c583fd0c2f1dee6e86e241f5e859231c0e8451d25166f2339584f01051c_67cdd105891e9.png', 'c16b5cf3913dae3fdb4e78551c51a5bd682a594de5f44260d1e130e3300ff176', 87),
('2025-03-09 17:33:57', '20250309476c6c583fd0c2f1dee6e86e241f5e859231c0e8451d25166f2339584f01051c_67cdd1059e0d2.png', 'c16b5cf3913dae3fdb4e78551c51a5bd682a594de5f44260d1e130e3300ff176', 88),
('2025-03-09 17:34:15', '202503095b894e0e4589c02c8d4646267015342b8fdf659a6b65ddf3d08527fe467c77c3_67cdd116d0ef1.png', 'e36735adbaf50e41bf87e8c8957a6bccf27cf4e8817093164d333a663ca1e3cd', 89),
('2025-03-09 17:37:28', '202503095b894e0e4589c02c8d4646267015342b8fdf659a6b65ddf3d08527fe467c77c3_67cdd1d8bed9a.png', '9a7a47d149d0c2f8c44a98cd6d8227d1edd3ae9d2e1cae3f31c8c159793424ac', 90),
('2025-03-09 17:37:32', '20250309476c6c583fd0c2f1dee6e86e241f5e859231c0e8451d25166f2339584f01051c_67cdd1dba99e0.png', '76510b82209b19352c7d4abc036caa8a01b2535c9eab43fe5d28433fdec2d5b0', 91),
('2025-03-09 17:37:32', '20250309476c6c583fd0c2f1dee6e86e241f5e859231c0e8451d25166f2339584f01051c_67cdd1dc27e5a.png', '76510b82209b19352c7d4abc036caa8a01b2535c9eab43fe5d28433fdec2d5b0', 92),
('2025-03-09 17:37:32', '20250309476c6c583fd0c2f1dee6e86e241f5e859231c0e8451d25166f2339584f01051c_67cdd1dc30675.png', '76510b82209b19352c7d4abc036caa8a01b2535c9eab43fe5d28433fdec2d5b0', 93),
('2025-03-09 17:37:32', '20250309476c6c583fd0c2f1dee6e86e241f5e859231c0e8451d25166f2339584f01051c_67cdd1dc83e2b.png', '76510b82209b19352c7d4abc036caa8a01b2535c9eab43fe5d28433fdec2d5b0', 94),
('2025-03-09 17:37:32', '20250309476c6c583fd0c2f1dee6e86e241f5e859231c0e8451d25166f2339584f01051c_67cdd1dcc85eb.png', '76510b82209b19352c7d4abc036caa8a01b2535c9eab43fe5d28433fdec2d5b0', 95),
('2025-03-09 17:38:11', '20250309476c6c583fd0c2f1dee6e86e241f5e859231c0e8451d25166f2339584f01051c_67cdd203103ed.png', 'f310a352a8660959acd1297e23c4639d7d50ddd21ac942ff7c2027fc84d3fe27', 97),
('2025-03-09 17:38:11', '20250309476c6c583fd0c2f1dee6e86e241f5e859231c0e8451d25166f2339584f01051c_67cdd2032b0ef.png', 'f310a352a8660959acd1297e23c4639d7d50ddd21ac942ff7c2027fc84d3fe27', 98),
('2025-03-09 17:38:11', '20250309476c6c583fd0c2f1dee6e86e241f5e859231c0e8451d25166f2339584f01051c_67cdd2036c33d.png', 'f310a352a8660959acd1297e23c4639d7d50ddd21ac942ff7c2027fc84d3fe27', 99),
('2025-03-09 17:38:11', '20250309476c6c583fd0c2f1dee6e86e241f5e859231c0e8451d25166f2339584f01051c_67cdd203a9c40.png', 'f310a352a8660959acd1297e23c4639d7d50ddd21ac942ff7c2027fc84d3fe27', 100),
('2025-03-09 17:38:34', '20250309476c6c583fd0c2f1dee6e86e241f5e859231c0e8451d25166f2339584f01051c_67cdd21a9af85.png', '87b8b7d87914c27f92e9fdb982819bb67637525923a58bd58cf796a68d2bd9c9', 101),
('2025-03-09 17:38:56', '20250309476c6c583fd0c2f1dee6e86e241f5e859231c0e8451d25166f2339584f01051c_67cdd23054881.png', '28f3cda82ef2b36d8b1e57073ccad68bd1723d9d0d75bb399ad9b78a45763b05', 102),
('2025-03-09 17:40:07', '20250309476c6c583fd0c2f1dee6e86e241f5e859231c0e8451d25166f2339584f01051c_67cdd27785fd7.png', '884080b3800607b8a449fa7aaa62d331cc96ae1ed6ef432ffb1b77f689814b0b', 103),
('2025-03-09 17:42:46', '20250309476c6c583fd0c2f1dee6e86e241f5e859231c0e8451d25166f2339584f01051c_67cdd315c2c3f.png', 'b6ade2c8b9681450ff2caddbde2997ad27aff0968a6541177f66eba9aea04305', 104),
('2025-03-09 17:43:22', '20250309476c6c583fd0c2f1dee6e86e241f5e859231c0e8451d25166f2339584f01051c_67cdd339f31f7.png', 'ed0a0042c03f4e3d820b77db5e02d50d99b9c8eae32a8288529f55a3d3894263', 105);

-- --------------------------------------------------------

--
-- Table structure for table `post`
--

CREATE TABLE `post` (
  `p_id` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `p_aid` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `p_name` text COLLATE utf8mb4_unicode_ci,
  `p_about` text COLLATE utf8mb4_unicode_ci,
  `p_max` int(11) DEFAULT NULL,
  `p_address` text COLLATE utf8mb4_unicode_ci,
  `p_date_start` date DEFAULT NULL,
  `p_date_end` date DEFAULT NULL,
  `p_give` text COLLATE utf8mb4_unicode_ci,
  `p_datetime` datetime DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `p_status` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `post`
--

INSERT INTO `post` (`p_id`, `p_aid`, `p_name`, `p_about`, `p_max`, `p_address`, `p_date_start`, `p_date_end`, `p_give`, `p_datetime`, `p_status`) VALUES
('28f3cda82ef2b36d8b1e57073ccad68bd1723d9d0d75bb399ad9b78a45763b05', '476c6c583fd0c2f1dee6e86e241f5e859231c0e8451d25166f2339584f01051c', 'ทดสอบระบบรอบที่ 5', 'asdasdtafsdytafsdtasdytfastydfasdasdtafsdytafsdtasdytfastydfasdasdtafsdytafsdtasdytfastydfasdasdtafsdytafsdtasdytfastydfasdasdtafsdytafsdtasdytfastydfasdasdtafsdytafsdtasdytfastydfasdasdtafsdytafsdtasdytfastydfasdasdtafsdytafsdtasdytfastydf', 1, 'asdasdtafsdytafsdtasdytfastydfasdasdtafsdytafsdtasdytfastydfasdasdtafsdytafsdtasdytfastydfasdasdtafsdytafsdtasdytfastydfasdasdtafsdytafsdtasdytfastydfasdasdtafsdytafsdtasdytfastydfasdasdtafsdytafsdtasdytfastydfasdasdtafsdytafsdtasdytfastydf', '2025-03-10', '2025-03-10', 'asdasdtafsdytafsdtasdytfastydfasdasdtafsdytafsdtasdytfastydfasdasdtafsdytafsdtasdytfastydfasdasdtafsdytafsdtasdytfastydfasdasdtafsdytafsdtasdytfastydfasdasdtafsdytafsdtasdytfastydfasdasdtafsdytafsdtas', '2025-03-09 17:38:56', NULL),
('39870bf23de553e9b7c9074b065964153eca32d590ee1dd5e6e135116f85236a', '5b894e0e4589c02c8d4646267015342b8fdf659a6b65ddf3d08527fe467c77c3', 'typeing', 'dadada', 10, 'caca', '2025-03-10', '2025-03-26', 'cacacaa', '2025-03-09 17:30:54', NULL),
('45f912c3735a028cb58f3c16320a2dab2651ee8105a744a556cfb92c0f70e2d7', '5b894e0e4589c02c8d4646267015342b8fdf659a6b65ddf3d08527fe467c77c3', 'ซอยจุ๊แซ่บๆ', 'gjgjgjgj', 10, 'กฟกฟก', '2025-03-10', '2025-03-26', 'กฟกฟก', '2025-03-09 17:29:01', NULL),
('6dfa6280beffb06273fea5d1ba084a5b21f783d65eaaebbe41c2889131b9e4a0', '5b894e0e4589c02c8d4646267015342b8fdf659a6b65ddf3d08527fe467c77c3', 'cacaca', 'caacacac', 5, 'ddqd', '2025-03-10', '2025-04-01', 'sawd', '2025-03-09 17:32:45', NULL),
('76510b82209b19352c7d4abc036caa8a01b2535c9eab43fe5d28433fdec2d5b0', '476c6c583fd0c2f1dee6e86e241f5e859231c0e8451d25166f2339584f01051c', 'ทดสอบระบบรอบที่ 2', 'asdasdtafsdytafsdtasdytfastydfasdasdtafsdytafsdtasdytfastydfasdasdtafsdytafsdtasdytfastydfasdasdtafsdytafsdtasdytfastydfasdasdtafsdytafsdtasdytfastydfasdasdtafsdytafsdtasdytfastydfasdasdtafsdytafsdtasdytfastydfasdasdtafsdytafsdtasdytfastydfasdasdtafsdytafsdtasdytfastydfasdasdtafsdytafsdtasdytfastydfasdasdtafsdytafsdtasdytfastydfasdasdtafsdytafsdtasdytfastydfasdasdtafsdytafsdtasdytfastydfasdasdtafsdytafsdtasdytfastydfasdasdtafsdytafsdtasdytfastydfasdasdtafsdytafsdtasdytfastydfasdasdtafsdytafsdtasdytfastydfasdasdtafsdytafsdtasdytfastydfasdasdtafsdytafsdtasdytfastydfasdasdtafsdytafsdtasdytfastydfasdasdtafsdytafsdtasdytfastydfasdasdtafsdytafsdtasdytfastydfasdasdtafsdytafsdtasdytfastydfasdasdtafsdytafsdtasdytfastydfasdasdtafsdytafsdtasdytfastydfasdasdtafsdytafsdtasdytfastydfasdasdtafsdytafsdtasdytfastydfasdasdtafsdytafsdtasdytfastydfasdasdtafsdytafsdtasdytfastydfasdasdtafsdytafsdtasdytfastydfasdasdtafsdytafsdtasdytfastydfasdasdtafsdytafsdtasdytfastydf', 1, 'asdasdtafsdytafsdtasdytfastydfasdasdtafsdytafsdtasdytfastydfasdasdtafsdytafsdtasdytfastydfasdasdtafsdytafsdtasdytfastydfasdasdtafsdytafsdtasdytfastydfasdasdtafsdytafsdtasdytfastydfasdasdtafsdytafsdtasdytfastydfasdasdtafsdytafsdtasdytfastydf', '2025-03-10', '2025-03-10', 'asdasdtafsdytafsdtasdytfastydfasdasdtafsdytafsdtasdytfastydfasdasdtafsdytafsdtasdytfastydfasdasdtafsdytafsdtasdytfastydfasdasdtafsdytafsdtasdytfastydfasdasdtafsdytafsdtasdytfastydfasdasdtafsdytafsdtas', '2025-03-09 17:37:31', NULL),
('7c15e0dc48a22174fb937e8405901170a9cd2a2738fabe37dffb87152f2e171f', '476c6c583fd0c2f1dee6e86e241f5e859231c0e8451d25166f2339584f01051c', 'ทำหน้าเว็บสำหรับดูสรุปผลกิจกรรม รอบที่ 1', 'ทำหน้าเว็บสำหรับดูสรุปผลกิจกรรม PHP JS HTML CSS BOOSRAP', 30, 'ออนไลน์', '2025-03-10', '2025-03-25', '10,000 บาท', '2025-03-09 17:30:48', NULL),
('87b8b7d87914c27f92e9fdb982819bb67637525923a58bd58cf796a68d2bd9c9', '476c6c583fd0c2f1dee6e86e241f5e859231c0e8451d25166f2339584f01051c', 'ทดสอบระบบรอบที่ 4', 'asdasdtafsdytafsdtasdytfastydfasdasdtafsdytafsdtasdytfastydfasdasdtafsdytafsdtasdytfastydfasdasdtafsdytafsdtasdytfastydfasdasdtafsdytafsdtasdytfastydfasdasdtafsdytafsdtasdytfastydfasdasdtafsdytafsdtasdytfastydfasdasdtafsdytafsdtasdytfastydf', 1, 'asdasdtafsdytafsdtasdytfastydfasdasdtafsdytafsdtasdytfastydfasdasdtafsdytafsdtasdytfastydfasdasdtafsdytafsdtasdytfastydfasdasdtafsdytafsdtasdytfastydfasdasdtafsdytafsdtasdytfastydfasdasdtafsdytafsdtasdytfastydfasdasdtafsdytafsdtasdytfastydf', '2025-03-10', '2025-03-10', 'asdasdtafsdytafsdtasdytfastydfasdasdtafsdytafsdtasdytfastydfasdasdtafsdytafsdtasdytfastydfasdasdtafsdytafsdtasdytfastydfasdasdtafsdytafsdtasdytfastydfasdasdtafsdytafsdtasdytfastydfasdasdtafsdytafsdtas', '2025-03-09 17:38:34', NULL),
('884080b3800607b8a449fa7aaa62d331cc96ae1ed6ef432ffb1b77f689814b0b', '476c6c583fd0c2f1dee6e86e241f5e859231c0e8451d25166f2339584f01051c', 'ทดสอบระบบรอบที่ 6', 'asdasdtafsdytafsdtasdytfastydfasdasdtafsdytafsdtasdytfastydfasdasdtafsdytafsdtasdytfastydfasdasdtafsdytafsdtasdytfastydfasdasdtafsdytafsdtasdytfastydfasdasdtafsdytafsdtasdytfastydfasdasdtafsdytafsdtasdytfastydfasdasdtafsdytafsdtasdytfastydf', 1, 'asdasdtafsdytafsdtasdytfastydfasdasdtafsdytafsdtasdytfastydfasdasdtafsdytafsdtasdytfastydfasdasdtafsdytafsdtasdytfastydfasdasdtafsdytafsdtasdytfastydfasdasdtafsdytafsdtasdytfastydfasdasdtafsdytafsdtasdytfastydfasdasdtafsdytafsdtasdytfastydf', '2025-04-10', '2025-04-15', 'asdasdtafsdytafsdtasdytfastydfasdasdtafsdytafsdtasdytfastydfasdasdtafsdytafsdtasdytfastydfasdasdtafsdytafsdtasdytfastydfasdasdtafsdytafsdtasdytfastydfasdasdtafsdytafsdtasdytfastydfasdasdtafsdytafsdtas', '2025-03-09 17:40:07', NULL),
('9a7a47d149d0c2f8c44a98cd6d8227d1edd3ae9d2e1cae3f31c8c159793424ac', '5b894e0e4589c02c8d4646267015342b8fdf659a6b65ddf3d08527fe467c77c3', 'คุณย่าเคยพูดเอาไว้', 'คนใดที่ถูกเจียว คือคนเดียวที่ถูกใจ', 10000, 'โตเกียว', '2025-03-10', '2025-03-26', 'ของแซ่บ', '2025-03-09 17:37:28', NULL),
('9fcb26f6d9d8303b08001a69600b7d448c06de278966616912a19a3a67319e0c', '476c6c583fd0c2f1dee6e86e241f5e859231c0e8451d25166f2339584f01051c', 'ทำหน้าเว็บสำหรับดูสรุปผลกิจกรรม รอบที่ 3', 'ทำหน้าเว็บสำหรับดูสรุปผลกิจกรรม PHP JS HTML CSS BOOSRAP', 30, 'ออนไลน์', '2025-03-10', '2025-03-25', '10,000 บาท', '2025-03-09 17:31:22', NULL),
('a29070f0e895a7c5066fb74f7991fa0c5dbcbf50290b5de0be9f886f63cf3327', '476c6c583fd0c2f1dee6e86e241f5e859231c0e8451d25166f2339584f01051c', 'ทำหน้าเว็บสำหรับดูสรุปผลกิจกรรม รอบที่ 2 ', 'ทำหน้าเว็บสำหรับดูสรุปผลกิจกรรม PHP JS HTML CSS BOOSRAP', 30, 'ออนไลน์', '2025-03-10', '2025-03-25', '10,000 บาท', '2025-03-09 17:30:37', NULL),
('b6ade2c8b9681450ff2caddbde2997ad27aff0968a6541177f66eba9aea04305', '476c6c583fd0c2f1dee6e86e241f5e859231c0e8451d25166f2339584f01051c', 'hack php project 1', 'hack php project 1', 100, 'IT401', '2025-05-01', '2025-05-05', '1,000 บาท', '2025-03-09 17:42:45', NULL),
('c16b5cf3913dae3fdb4e78551c51a5bd682a594de5f44260d1e130e3300ff176', '476c6c583fd0c2f1dee6e86e241f5e859231c0e8451d25166f2339584f01051c', 'ทดสอบระบบรอบที่ 1 ', 'ทดสอบระบบรอบที่ 1 \r\nhttps://activity.xn--v3cavs8a.xn--o3cw4h/activity/create\r\n<h1>https://activity.xn--v3cavs8a.xn--o3cw4h/activity/create</h1>ทดสอบระบบรอบที่ 1 \r\nhttps://activity.xn--v3cavs8a.xn--o3cw4h/activity/create\r\n<h1>https://activity.xn--v3cavs8a.xn--o3cw4h/activity/create</h1>ทดสอบระบบรอบที่ 1 \r\nhttps://activity.xn--v3cavs8a.xn--o3cw4h/activity/create\r\n<h1>https://activity.xn--v3cavs8a.xn--o3cw4h/activity/create</h1>ทดสอบระบบรอบที่ 1 \r\nhttps://activity.xn--v3cavs8a.xn--o3cw4h/activity/create\r\n<h1>https://activity.xn--v3cavs8a.xn--o3cw4h/activity/create</h1>ทดสอบระบบรอบที่ 1 \r\nhttps://activity.xn--v3cavs8a.xn--o3cw4h/activity/create\r\n<h1>https://activity.xn--v3cavs8a.xn--o3cw4h/activity/create</h1>ทดสอบระบบรอบที่ 1 \r\nhttps://activity.xn--v3cavs8a.xn--o3cw4h/activity/create\r\n<h1>https://activity.xn--v3cavs8a.xn--o3cw4h/activity/create</h1>ทดสอบระบบรอบที่ 1 \r\nhttps://activity.xn--v3cavs8a.xn--o3cw4h/activity/create\r\n<h1>https://activity.xn--v3cavs8a.xn--o3cw4h/activity/create</h1>ทดสอบระบบรอบที่ 1 \r\nhttps://activity.xn--v3cavs8a.xn--o3cw4h/activity/create\r\n<h1>https://activity.xn--v3cavs8a.xn--o3cw4h/activity/create</h1>ทดสอบระบบรอบที่ 1 \r\nhttps://activity.xn--v3cavs8a.xn--o3cw4h/activity/create\r\n<h1>https://activity.xn--v3cavs8a.xn--o3cw4h/activity/create</h1>ทดสอบระบบรอบที่ 1 \r\nhttps://activity.xn--v3cavs8a.xn--o3cw4h/activity/create\r\n<h1>https://activity.xn--v3cavs8a.xn--o3cw4h/activity/create</h1>', 999, 'ทดสอบระบบรอบที่ 1  https://activity.xn--v3cavs8a.xn--o3cw4h/activity/create <h1>https://activity.xn--v3cavs8a.xn--o3cw4h/activity/create</h1>ทดสอบระบบรอบที่ 1  https://activity.xn--v3cavs8a.xn--o3cw4h/activity/create <h1>https://activity.xn--v3cavs8a.xn--o3cw4h/activity/create</h1>', '2025-03-10', '2025-03-10', 'ทดสอบระบบรอบที่ 1  https://activity.xn--v3cavs8a.xn--o3cw4h/activity/create <h1>https://activity.xn--v3cavs8a.xn--o3cw4h/activity/create</h1>ทดสอบระบบรอบที่ 1  https://activity.xn--v3cavs8a.xn--o3cw4h', '2025-03-09 17:33:56', NULL),
('e36735adbaf50e41bf87e8c8957a6bccf27cf4e8817093164d333a663ca1e3cd', '5b894e0e4589c02c8d4646267015342b8fdf659a6b65ddf3d08527fe467c77c3', 'C4c', 'แฟกๆำำกแไฟไก', 10, 'กฟกฟก', '2025-03-10', '2025-04-01', 'กฟกฟกก', '2025-03-09 17:34:14', NULL),
('ed0a0042c03f4e3d820b77db5e02d50d99b9c8eae32a8288529f55a3d3894263', '476c6c583fd0c2f1dee6e86e241f5e859231c0e8451d25166f2339584f01051c', 'hack php project 2', 'hack php project 2', 100, 'IT401', '2025-06-06', '2025-06-10', '1,000 บาท', '2025-03-09 17:43:21', NULL),
('f310a352a8660959acd1297e23c4639d7d50ddd21ac942ff7c2027fc84d3fe27', '476c6c583fd0c2f1dee6e86e241f5e859231c0e8451d25166f2339584f01051c', 'ทดสอบระบบรอบที่ 3 ', 'asdasdtafsdytafsdtasdytfastydfasdasdtafsdytafsdtasdytfastydfasdasdtafsdytafsdtasdytfastydfasdasdtafsdytafsdtasdytfastydfasdasdtafsdytafsdtasdytfastydfasdasdtafsdytafsdtasdytfastydfasdasdtafsdytafsdtasdytfastydfasdasdtafsdytafsdtasdytfastydfasdasdtafsdytafsdtasdytfastydfasdasdtafsdytafsdtasdytfastydfasdasdtafsdytafsdtasdytfastydfasdasdtafsdytafsdtasdytfastydfasdasdtafsdytafsdtasdytfastydfasdasdtafsdytafsdtasdytfastydfasdasdtafsdytafsdtasdytfastydfasdasdtafsdytafsdtasdytfastydfasdasdtafsdytafsdtasdytfastydfasdasdtafsdytafsdtasdytfastydfasdasdtafsdytafsdtasdytfastydfasdasdtafsdytafsdtasdytfastydfasdasdtafsdytafsdtasdytfastydfasdasdtafsdytafsdtasdytfastydfasdasdtafsdytafsdtasdytfastydfasdasdtafsdytafsdtasdytfastydfasdasdtafsdytafsdtasdytfastydfasdasdtafsdytafsdtasdytfastydfasdasdtafsdytafsdtasdytfastydfasdasdtafsdytafsdtasdytfastydfasdasdtafsdytafsdtasdytfastydfasdasdtafsdytafsdtasdytfastydfasdasdtafsdytafsdtasdytfastydfasdasdtafsdytafsdtasdytfastydf', 1, 'asdasdtafsdytafsdtasdytfastydfasdasdtafsdytafsdtasdytfastydfasdasdtafsdytafsdtasdytfastydfasdasdtafsdytafsdtasdytfastydfasdasdtafsdytafsdtasdytfastydfasdasdtafsdytafsdtasdytfastydfasdasdtafsdytafsdtasdytfastydfasdasdtafsdytafsdtasdytfastydf', '2025-03-21', '2025-03-22', 'asdasdtafsdytafsdtasdytfastydfasdasdtafsdytafsdtasdytfastydfasdasdtafsdytafsdtasdytfastydfasdasdtafsdytafsdtasdytfastydfasdasdtafsdytafsdtasdytfastydfasdasdtafsdytafsdtasdytfastydfasdasdtafsdytafsdtas', '2025-03-10 03:22:25', NULL);

-- --------------------------------------------------------

--
-- Table structure for table `register`
--

CREATE TABLE `register` (
  `datetime` datetime DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `pid` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `aid` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `status` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `datetime_submit` date DEFAULT NULL,
  `image_submit` text COLLATE utf8mb4_unicode_ci,
  `status_submit` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `id` int(11) NOT NULL,
  `isRead` tinyint(1) NOT NULL DEFAULT '0'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `register`
--

INSERT INTO `register` (`datetime`, `pid`, `aid`, `status`, `datetime_submit`, `image_submit`, `status_submit`, `id`, `isRead`) VALUES
('2025-03-09 17:30:29', 'a29070f0e895a7c5066fb74f7991fa0c5dbcbf50290b5de0be9f886f63cf3327', 'f65ba59fe678bf4832414438b16d14d6ebf149c888f962fceb1b9f9fa7f03482', 'รอการตรวจสอบ', NULL, NULL, NULL, 81, 0),
('2025-03-09 17:30:31', '45f912c3735a028cb58f3c16320a2dab2651ee8105a744a556cfb92c0f70e2d7', 'f65ba59fe678bf4832414438b16d14d6ebf149c888f962fceb1b9f9fa7f03482', 'รอการตรวจสอบ', NULL, NULL, NULL, 82, 0),
('2025-03-09 17:30:34', '7c15e0dc48a22174fb937e8405901170a9cd2a2738fabe37dffb87152f2e171f', 'f65ba59fe678bf4832414438b16d14d6ebf149c888f962fceb1b9f9fa7f03482', 'รอการตรวจสอบ', NULL, NULL, NULL, 83, 0),
('2025-03-09 17:31:03', '39870bf23de553e9b7c9074b065964153eca32d590ee1dd5e6e135116f85236a', 'f65ba59fe678bf4832414438b16d14d6ebf149c888f962fceb1b9f9fa7f03482', 'รอการตรวจสอบ', NULL, NULL, NULL, 84, 0),
('2025-03-09 17:37:45', '76510b82209b19352c7d4abc036caa8a01b2535c9eab43fe5d28433fdec2d5b0', 'f65ba59fe678bf4832414438b16d14d6ebf149c888f962fceb1b9f9fa7f03482', 'รอการตรวจสอบ', NULL, NULL, NULL, 85, 0),
('2025-03-09 17:37:47', '9a7a47d149d0c2f8c44a98cd6d8227d1edd3ae9d2e1cae3f31c8c159793424ac', 'f65ba59fe678bf4832414438b16d14d6ebf149c888f962fceb1b9f9fa7f03482', 'รอการตรวจสอบ', NULL, NULL, NULL, 86, 0),
('2025-03-09 17:37:49', 'e36735adbaf50e41bf87e8c8957a6bccf27cf4e8817093164d333a663ca1e3cd', 'f65ba59fe678bf4832414438b16d14d6ebf149c888f962fceb1b9f9fa7f03482', 'รอการตรวจสอบ', NULL, NULL, NULL, 87, 0),
('2025-03-09 17:37:53', 'c16b5cf3913dae3fdb4e78551c51a5bd682a594de5f44260d1e130e3300ff176', 'f65ba59fe678bf4832414438b16d14d6ebf149c888f962fceb1b9f9fa7f03482', 'รอการตรวจสอบ', NULL, NULL, NULL, 88, 0),
('2025-03-09 17:38:01', '6dfa6280beffb06273fea5d1ba084a5b21f783d65eaaebbe41c2889131b9e4a0', 'f65ba59fe678bf4832414438b16d14d6ebf149c888f962fceb1b9f9fa7f03482', 'รอการตรวจสอบ', NULL, NULL, NULL, 89, 0),
('2025-03-09 17:38:05', '9fcb26f6d9d8303b08001a69600b7d448c06de278966616912a19a3a67319e0c', 'f65ba59fe678bf4832414438b16d14d6ebf149c888f962fceb1b9f9fa7f03482', 'รอการตรวจสอบ', NULL, NULL, NULL, 90, 0),
('2025-03-09 17:48:34', '76510b82209b19352c7d4abc036caa8a01b2535c9eab43fe5d28433fdec2d5b0', '476c6c583fd0c2f1dee6e86e241f5e859231c0e8451d25166f2339584f01051c', 'รอการตรวจสอบ', NULL, NULL, NULL, 91, 0),
('2025-03-09 17:48:39', '76510b82209b19352c7d4abc036caa8a01b2535c9eab43fe5d28433fdec2d5b0', '5b894e0e4589c02c8d4646267015342b8fdf659a6b65ddf3d08527fe467c77c3', 'รอการตรวจสอบ', NULL, NULL, NULL, 92, 0),
('2025-03-10 03:21:04', 'ed0a0042c03f4e3d820b77db5e02d50d99b9c8eae32a8288529f55a3d3894263', 'f65ba59fe678bf4832414438b16d14d6ebf149c888f962fceb1b9f9fa7f03482', 'อนุมัติ', NULL, NULL, NULL, 93, 0);

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
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=106;

--
-- AUTO_INCREMENT for table `register`
--
ALTER TABLE `register`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=94;

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
