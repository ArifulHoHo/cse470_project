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
-- Database: `valorantcoachapp`
--

-- --------------------------------------------------------

--
-- Table structure for table `coaching`
--

CREATE TABLE `coaching` (
  `Coach_ID` int(4) NOT NULL,
  `user_ID` int(4) NOT NULL,
  `requestDate` date NOT NULL,
  `coachedDate` date NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `coaching`
--

INSERT INTO `coaching` (`Coach_ID`, `user_ID`, `requestDate`, `coachedDate`) VALUES
(4, 3, '2022-12-09', '0000-00-00'),
(5, 3, '2022-12-09', '0000-00-00');

-- --------------------------------------------------------

--
-- Table structure for table `coach_history`
--

CREATE TABLE `coach_history` (
  `user_ID` int(4) NOT NULL,
  `coach_ID` int(4) NOT NULL,
  `date` date NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Table structure for table `messages`
--

CREATE TABLE `messages` (
  `coachID` int(4) NOT NULL,
  `userID` int(4) NOT NULL,
  `meettime` time DEFAULT NULL,
  `meetdate` date DEFAULT NULL,
  `meetlink` text DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `messages`
--

INSERT INTO `messages` (`coachID`, `userID`, `meettime`, `meetdate`, `meetlink`) VALUES
(5, 6, '20:29:00', '2022-12-20', 'jljkl'),
(4, 3, '07:48:00', '2022-12-15', 'kuyky');

-- --------------------------------------------------------

--
-- Table structure for table `payment`
--

CREATE TABLE `payment` (
  `transaction_id` varchar(9) NOT NULL,
  `transaction_card` varchar(15) NOT NULL,
  `amount` int(11) NOT NULL,
  `date` date NOT NULL,
  `Coach_ACCId` int(11) DEFAULT NULL,
  `user_ACCId` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `payment`
--

INSERT INTO `payment` (`transaction_id`, `transaction_card`, `amount`, `date`, `Coach_ACCId`, `user_ACCId`) VALUES
('09C7380E8', 'Nexus Pay', 80, '2022-12-06', 4, 3),
('10A84B739', 'Nexus Pay', 80, '2022-12-07', 4, 3),
('1602C3BED', 'Nexus Pay', 80, '2022-12-12', 3, 3),
('169AA3013', 'City touch', 80, '2022-12-09', 4, 3),
('3913E0B17', 'Nexus Pay', 80, '2022-12-06', 5, 6),
('A7C35789E', 'Nexus Pay', 80, '2022-12-07', 4, 3),
('ABA010AB6', 'Nexus Pay', 80, '2022-12-09', 5, 3);

-- --------------------------------------------------------

--
-- Table structure for table `reviews`
--

CREATE TABLE `reviews` (
  `coachID` int(11) NOT NULL,
  `playerID` int(11) NOT NULL,
  `review` text NOT NULL,
  `date` date NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `reviews`
--

INSERT INTO `reviews` (`coachID`, `playerID`, `review`, `date`) VALUES
(5, 6, 'He is the best coach ever. Learned so much about my strafing and crosshair placement. Such a cool guy!', '2022-12-12'),
(4, 6, 'Shroud is just the best - player and coach! I learned a lot from him!', '2022-12-19'),
(7, 6, 'Followed him from tiktok, now he is one of the most popular valorant streamers!! A very good coach', '2022-12-19'),
(7, 3, 'He is probably one of the most dedicated coaches I have ever had. I jumped straight from Bronze 3 to Gold 1 with his tips. #nasa_man', '2022-12-19');

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `AccID` int(4) NOT NULL,
  `Name` varchar(25) NOT NULL,
  `email` varchar(50) NOT NULL,
  `country` varchar(25) NOT NULL,
  `IGN` varchar(25) NOT NULL,
  `IG_Tag` varchar(5) NOT NULL,
  `photo_url` text NOT NULL,
  `password` varchar(32) NOT NULL,
  `user_type` varchar(10) DEFAULT NULL,
  `coach_desc` varchar(1000) DEFAULT NULL,
  `coach_exp_years` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`AccID`, `Name`, `email`, `country`, `IGN`, `IG_Tag`, `photo_url`, `password`, `user_type`, `coach_desc`, `coach_exp_years`) VALUES
(3, 'Mohammad Ariful Islam', 'sicorpthermopolis@gmail.com', 'Bangladesh', 'ArifulHoHo', '0400', 'IMG-6393391ec9f4e7.48774559.jpg', '40f87cdd28e39587cd8a22dfd0586269', 'Player', NULL, NULL),
(4, 'Shroud', 'abc@gmail.com', 'Canada', 'SenShroud', '0001', 'IMG-638b406025e7a6.08375808.jpg', '84a50ad51088271689fd2d7c4dee5903', 'Coach', 'You know who I am.', 4),
(5, 'Terry Walker', 'xqy@gmail.com', 'England', 'Average Jonas', '0230', 'IMG-638b4bf4048407.54508674.jpg', '40f87cdd28e39587cd8a22dfd0586269', 'Coach', NULL, 3),
(6, 'Aninda', 'aaa@gmail.com', 'Australia', 'Nilporix', '1370', 'IMG-638de16f3c7f19.02267176.jpg', '40f87cdd28e39587cd8a22dfd0586269', 'Player', NULL, NULL),
(7, 'Jollz', 'abc@gmail.com', 'Australia', 'Jollztv', '0029', 'IMG-639af3435db6a0.06329038.jpg', '40f87cdd28e39587cd8a22dfd0586269', 'Coach', 'Follow me on Tiktok @Jollstv. Also subscribe to my youtube channel for more coaching content.Cheers!', 6);

--
-- Indexes for dumped tables
--

--
-- Indexes for table `messages`
--
ALTER TABLE `messages`
  ADD KEY `coachID` (`coachID`),
  ADD KEY `userID` (`userID`);

--
-- Indexes for table `payment`
--
ALTER TABLE `payment`
  ADD PRIMARY KEY (`transaction_id`),
  ADD KEY `Coach_ACCId` (`Coach_ACCId`),
  ADD KEY `user_ACCId` (`user_ACCId`);

--
-- Indexes for table `reviews`
--
ALTER TABLE `reviews`
  ADD KEY `coachID` (`coachID`),
  ADD KEY `playerID` (`playerID`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`AccID`),
  ADD UNIQUE KEY `IG_Tag` (`IG_Tag`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `AccID` int(4) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `messages`
--
ALTER TABLE `messages`
  ADD CONSTRAINT `messages_ibfk_1` FOREIGN KEY (`coachID`) REFERENCES `users` (`AccID`),
  ADD CONSTRAINT `messages_ibfk_2` FOREIGN KEY (`userID`) REFERENCES `users` (`AccID`);

--
-- Constraints for table `payment`
--
ALTER TABLE `payment`
  ADD CONSTRAINT `payment_ibfk_1` FOREIGN KEY (`Coach_ACCId`) REFERENCES `users` (`AccID`),
  ADD CONSTRAINT `payment_ibfk_2` FOREIGN KEY (`user_ACCId`) REFERENCES `users` (`AccID`);

--
-- Constraints for table `reviews`
--
ALTER TABLE `reviews`
  ADD CONSTRAINT `reviews_ibfk_1` FOREIGN KEY (`coachID`) REFERENCES `users` (`AccID`),
  ADD CONSTRAINT `reviews_ibfk_2` FOREIGN KEY (`playerID`) REFERENCES `users` (`AccID`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
