-- phpMyAdmin SQL Dump
-- version 5.2.0
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Dec 19, 2022 at 07:33 AM
-- Server version: 10.4.24-MariaDB
-- PHP Version: 8.1.6

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `gamevalorant`
--

-- --------------------------------------------------------

--
-- Table structure for table `players`
--

CREATE TABLE `players` (
  `AccId` varchar(4) NOT NULL,
  `IGN` varchar(25) NOT NULL,
  `country` varchar(25) NOT NULL,
  `dateBirth` date NOT NULL,
  `password` varchar(32) NOT NULL,
  `username` varchar(25) NOT NULL,
  `curr_rank` varchar(10) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `players`
--

INSERT INTO `players` (`AccId`, `IGN`, `country`, `dateBirth`, `password`, `username`, `curr_rank`) VALUES
('0001', 'SenShroud', 'Canada', '1991-01-22', 'xxxxxxxx', 'Shroud', 'Radiant'),
('0029', 'Jollztv', 'USA', '1992-04-26', 'xxxxxxxx', 'Jollz', 'Radiant'),
('0230', 'Average Jonas', 'England', '1992-05-26', 'xxxxxxxx', 'JonasBro', 'Radiant'),
('0400', 'ArifulHoHo', 'Bangladesh', '2000-12-22', 'xxxxxxxx', 'ArifulHoHo', 'Radiant'),
('1370', 'Nilporix', 'Bangladesh', '2000-09-12', 'xxxxxxxx', 'Aninda', 'Silver 2');

-- --------------------------------------------------------

--
-- Table structure for table `records`
--

CREATE TABLE `records` (
  `AccNo` varchar(4) NOT NULL,
  `agent` varchar(25) NOT NULL,
  `kills` int(11) NOT NULL,
  `death` int(11) NOT NULL,
  `assist` int(11) NOT NULL,
  `K_D` varchar(5) NOT NULL,
  `hs_percent` varchar(5) NOT NULL,
  `adr` varchar(5) NOT NULL,
  `acs` varchar(5) NOT NULL,
  `score` varchar(5) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Table structure for table `statistics`
--

CREATE TABLE `statistics` (
  `AccNo` varchar(4) DEFAULT NULL,
  `DPR` varchar(5) DEFAULT NULL,
  `KDR` varchar(5) DEFAULT NULL,
  `HS_percent` varchar(5) DEFAULT NULL,
  `Win_percent` varchar(5) DEFAULT NULL,
  `Matches` int(11) DEFAULT NULL,
  `wins` int(11) DEFAULT NULL,
  `KAD` varchar(4) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `statistics`
--

INSERT INTO `statistics` (`AccNo`, `DPR`, `KDR`, `HS_percent`, `Win_percent`, `Matches`, `wins`, `KAD`) VALUES
('0400', '162.0', '1.24', '16.0', '38.3', 47, 18, '1.60'),
('0001', '173.5', '1.01', '31.9', '52.3', 216, 140, '1.88'),
('0230', '162.0', '1.24', '31.9', '52.3', 216, 140, '1.60'),
('1370', '170.0', '1.24', '31.9', '52.3', 216, 140, '1.60'),
('0029', '170.0', '1.24', '31.9', '52.3', 216, 140, '1.60');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `players`
--
ALTER TABLE `players`
  ADD PRIMARY KEY (`AccId`),
  ADD UNIQUE KEY `IGN` (`IGN`);

--
-- Indexes for table `records`
--
ALTER TABLE `records`
  ADD KEY `AccNo` (`AccNo`);

--
-- Indexes for table `statistics`
--
ALTER TABLE `statistics`
  ADD KEY `AccNo` (`AccNo`);

--
-- Constraints for dumped tables
--

--
-- Constraints for table `records`
--
ALTER TABLE `records`
  ADD CONSTRAINT `records_ibfk_1` FOREIGN KEY (`AccNo`) REFERENCES `players` (`AccId`);

--
-- Constraints for table `statistics`
--
ALTER TABLE `statistics`
  ADD CONSTRAINT `statistics_ibfk_1` FOREIGN KEY (`AccNo`) REFERENCES `players` (`AccId`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
