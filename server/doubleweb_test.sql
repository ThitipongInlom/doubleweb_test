-- phpMyAdmin SQL Dump
-- version 4.9.2
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Aug 04, 2020 at 07:32 PM
-- Server version: 10.4.11-MariaDB
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
-- Database: `doubleweb_test`
--

-- --------------------------------------------------------

--
-- Table structure for table `blacklist_member`
--

CREATE TABLE `blacklist_member` (
  `log_id` int(12) NOT NULL,
  `fristname` varchar(100) NOT NULL COMMENT 'ชื่อ',
  `lastname` varchar(100) NOT NULL COMMENT 'นามสกุล',
  `plan_password` varchar(100) DEFAULT NULL COMMENT 'รหัสผ่าน',
  `phone_number` varchar(100) NOT NULL COMMENT 'เบอร์โทร',
  `bank_number` varchar(100) NOT NULL COMMENT 'เลขบัญชี',
  `block_from` varchar(100) NOT NULL COMMENT 'จาก domain ไหน',
  `note` longtext DEFAULT NULL COMMENT 'คอมเม้นท์',
  `create_date` datetime NOT NULL,
  `users_id` int(12) DEFAULT NULL,
  `is_delete` int(1) DEFAULT 0
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `blacklist_member`
--

INSERT INTO `blacklist_member` (`log_id`, `fristname`, `lastname`, `plan_password`, `phone_number`, `bank_number`, `block_from`, `note`, `create_date`, `users_id`, `is_delete`) VALUES
(1, 'Thitipong', 'Inlom', NULL, '0864633160', '0000000', 'http://thaiz.org/', 'ทดสอบๆ', '2020-08-04 21:01:55', 8, 0),
(2, 'Thitipong', 'Inlom', NULL, '0864633160', '0000000', 'http://thaiz.org/', 'ทดสอบๆ', '2020-08-04 23:38:10', 8, 1);

-- --------------------------------------------------------

--
-- Table structure for table `_member`
--

CREATE TABLE `_member` (
  `player_id` int(11) NOT NULL,
  `player_token` varchar(255) NOT NULL,
  `player_username` varchar(100) NOT NULL,
  `player_password` varchar(100) NOT NULL COMMENT 'รหัสผ่านแบบเข้ารหัส',
  `player_plain_password` varchar(100) NOT NULL COMMENT 'รหัสผ่าน',
  `player_fristname` varchar(100) NOT NULL,
  `player_lastname` varchar(100) NOT NULL,
  `player_phone_number` varchar(100) NOT NULL,
  `player_ip_address` varchar(100) NOT NULL,
  `player_isActive` int(1) NOT NULL DEFAULT 0 COMMENT 'สถานนะ',
  `player_status` int(1) NOT NULL DEFAULT 0,
  `player_note` longtext NOT NULL,
  `create_time` datetime NOT NULL,
  `update_time` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `_member`
--

INSERT INTO `_member` (`player_id`, `player_token`, `player_username`, `player_password`, `player_plain_password`, `player_fristname`, `player_lastname`, `player_phone_number`, `player_ip_address`, `player_isActive`, `player_status`, `player_note`, `create_time`, `update_time`) VALUES
(1, '0e4b5008e04f0b9dbd777b1ab4cb9d47a2247c2729f93c8a5afabac5aa1b0f55', 'ingnice009', '$2y$10$nEk3wCygVbN3aqeXdFlmKuH.0VUtepNxPdHZrkFDL/T2YwePF5mou', 'ingnice009', 'Thitipong', 'Inlom', '0864633160', '::1', 1, 0, 'สมัครใช้งาน สำเร็จ ยินดีต้อนรับ', '2020-07-16 06:50:08', '2020-07-18 04:31:54'),
(2, '0e4b5008e04f0b9dbd777b1ab4cb9d47a2247c2729f93c8a5afabac5aa1b0f55', 'aa', '$2y$10$jHcB2nTOYaOpihj5x7Jotuv.XqA5VKabZvDEcxtjR1jsoISNf35Cq', 'aa', 'aa', 'aa', '2222', '::1', 0, 0, 'สมัครใช้งาน สำเร็จ ยินดีต้อนรับ', '2020-07-16 06:53:17', '2020-07-16 06:53:17'),
(3, '0e4b5008e04f0b9dbd777b1ab4cb9d47a2247c2729f93c8a5afabac5aa1b0f55', 'r4', '$2y$10$Xu56/ezC2Z14SEvXorGDrOuvECeZwnRvjXGwYav.QeSXnhljH/SMC', 'rewr#', '4r', 'FFF', '4', '::1', 0, 0, 'สมัครใช้งาน สำเร็จ ยินดีต้อนรับ', '2020-07-16 07:22:21', '2020-07-16 07:22:21'),
(7, '06b3c7c0f142bf1df3e5c40bbc3d613fcaba59c79335e7b647ac94ebe0a3cb7f', 'ingnice007', '$2y$10$.BBntibBNsLtmJcIJ3AwUOURzgMnPSfR5IKNxOWCHbiKK1nYPgHXG', 'ingnice007', 'Thitipong', 'rg', '2626', '::1', 0, 0, 'สมัครใช้งาน สำเร็จ ยินดีต้อนรับ', '2020-07-18 04:29:59', '2020-07-18 04:29:59'),
(8, '9aafbd1131ab1f4efae6f7829100403cde7070cd3fd7bfb8ee18bb71f3d0eeeb', 'nice', '$2y$10$cWSTRfLKDZlXwMvOF5agTOm9NyhA/GeC9Nn3plppO8Guzkpl8i8RG', 'nice', 'Thitipong', 'Inlom', '0864633160', '::1', 1, 0, 'สมัครใช้งาน สำเร็จ ยินดีต้อนรับ', '2020-08-04 17:32:08', '2020-08-04 17:32:09');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `blacklist_member`
--
ALTER TABLE `blacklist_member`
  ADD PRIMARY KEY (`log_id`),
  ADD KEY `bank_number` (`bank_number`);

--
-- Indexes for table `_member`
--
ALTER TABLE `_member`
  ADD PRIMARY KEY (`player_id`),
  ADD KEY `player_token` (`player_token`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `blacklist_member`
--
ALTER TABLE `blacklist_member`
  MODIFY `log_id` int(12) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `_member`
--
ALTER TABLE `_member`
  MODIFY `player_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
