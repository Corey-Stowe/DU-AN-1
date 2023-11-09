-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Nov 09, 2023 at 04:41 AM
-- Server version: 10.4.28-MariaDB
-- PHP Version: 8.1.17

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `du_an1`
--

-- --------------------------------------------------------

--
-- Table structure for table `san_pham`
--

CREATE TABLE `san_pham` (
  `ma_san_pham` int(11) NOT NULL,
  `ten_san_pham` varchar(200) DEFAULT NULL,
  `ma_loai_hang` int(11) DEFAULT NULL,
  `mo_ta` varchar(2000) DEFAULT NULL,
  `ngay_them` date DEFAULT NULL,
  `don_gia` double DEFAULT NULL,
  `giam_gia` double DEFAULT NULL,
  `so_luong` int(10) DEFAULT NULL,
  `luot_xem` int(11) NOT NULL DEFAULT 0,
  `anh` varchar(200) DEFAULT NULL,
  `anh1` varchar(200) DEFAULT NULL,
  `anh2` varchar(200) DEFAULT NULL,
  `anh3` varchar(200) DEFAULT NULL,
  `anh4` varchar(200) DEFAULT NULL,
  `trang_thai` tinyint(2) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Indexes for dumped tables
--

--
-- Indexes for table `san_pham`
--
ALTER TABLE `san_pham`
  ADD PRIMARY KEY (`ma_san_pham`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `san_pham`
--
ALTER TABLE `san_pham`
  MODIFY `ma_san_pham` int(11) NOT NULL AUTO_INCREMENT;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
