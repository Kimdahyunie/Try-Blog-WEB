-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Jun 25, 2024 at 07:51 PM
-- Server version: 10.4.32-MariaDB
-- PHP Version: 8.0.30

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `scp_db`
--

-- --------------------------------------------------------

--
-- Table structure for table `comments_tbl`
--

CREATE TABLE `comments_tbl` (
  `id` int(11) NOT NULL,
  `user_id` int(10) NOT NULL,
  `event_id` int(10) NOT NULL,
  `user_fname` varchar(100) NOT NULL,
  `user_lname` varchar(100) NOT NULL,
  `date` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp(),
  `comment` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `comments_tbl`
--

INSERT INTO `comments_tbl` (`id`, `user_id`, `event_id`, `user_fname`, `user_lname`, `date`, `comment`) VALUES
(7, 15, 1, 'Shawn', ' Lacambra', '2024-04-30 12:19:19', 'Yooooooooo lets gooooooo!'),
(8, 15, 2, 'Shawn', ' Lacambra', '2024-04-30 12:19:44', 'Of course its coach rowell, BOSS ROWELL LANG SAKALAM'),
(9, 1, 1, 'polwyn', 'poll', '2024-06-25 17:00:39', 'yow');

-- --------------------------------------------------------

--
-- Table structure for table `event_tbl`
--

CREATE TABLE `event_tbl` (
  `id` int(10) NOT NULL,
  `edesc` varchar(255) NOT NULL,
  `ename` varchar(100) NOT NULL,
  `edate` date NOT NULL,
  `etime` time NOT NULL DEFAULT current_timestamp(),
  `elocation` varchar(100) NOT NULL,
  `eorg` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `event_tbl`
--

INSERT INTO `event_tbl` (`id`, `edesc`, `ename`, `edate`, `etime`, `elocation`, `eorg`) VALUES
(1, 'Hey fellow artrads member? Join Artrads Dance Crew for an intensive training session on May 1, 2024, at CvSU-CCAT CC1. Enhance and show your dance skills and be part of a vibrant and passionate dance community!', 'Intensive Training Sessions ', '2024-06-03', '13:28:00', 'CvSU-CCAT CC1', 'ARTRADS'),
(2, 'Join us for an exciting Choreo Class with our very own Coach Rowell Tibatib and Learn new dance moves and techniques in hip-hop in a fun and energetic way!', 'Choreo Class with Coach Rowell Tibatib', '2024-06-12', '16:27:00', 'CvSU-CCAT CC2', 'ARTRADS'),
(3, 'Let us rejoice and show a support for our fellow Artrads dance crew members that represents our campus in this coming CvSu Culture and Arts Competition in Street Dance Competition', 'CvSu Culture and Arts Competition', '2024-05-28', '01:30:00', 'CvSU Indang Campus (Main)', 'ARTRADS');

-- --------------------------------------------------------

--
-- Table structure for table `memberstbl`
--

CREATE TABLE `memberstbl` (
  `id` int(10) NOT NULL,
  `fname` varchar(100) NOT NULL,
  `lname` varchar(100) NOT NULL,
  `status` varchar(100) NOT NULL,
  `usertype` varchar(100) NOT NULL,
  `dept` varchar(100) NOT NULL,
  `year` varchar(100) NOT NULL,
  `section` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `memberstbl`
--

INSERT INTO `memberstbl` (`id`, `fname`, `lname`, `status`, `usertype`, `dept`, `year`, `section`) VALUES
(1, 'Polwyn', 'Martinez', 'active', 'Student', 'DCS', '3rd', 'Section C'),
(2, 'Cristhian', 'Mariquina', 'active\r\n', 'Student', 'DCS', '3rd', 'Section C');

-- --------------------------------------------------------

--
-- Table structure for table `scp_tbl`
--

CREATE TABLE `scp_tbl` (
  `id` int(10) NOT NULL,
  `fname` varchar(100) NOT NULL,
  `lname` varchar(100) NOT NULL,
  `email` varchar(100) NOT NULL,
  `password` varchar(100) NOT NULL,
  `user_type` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `scp_tbl`
--

INSERT INTO `scp_tbl` (`id`, `fname`, `lname`, `email`, `password`, `user_type`) VALUES
(1, 'polwyn', 'poll', 'pol@gmail.com', 'pol123', 'student'),
(2, 'POLLL', 'pollll', 'pol123@gmail.com', 'pol123', 'student'),
(3, 'heraldd', 'sumido', 'heraldsumido@gmail.com', 'pol123', 'student'),
(4, 'jeje', 'arar', 'jear@gmail.com', 'je123', 'student'),
(5, 'rald', 'he', 'heraldsumido123@gmail.com', 'rald123', 'student'),
(6, 'rald', 'he', 'heraldsumido123@gmail.com', 'rald123', 'student'),
(7, 'jayson', 'jajay', 'hay@gmail.com', 'jay123', 'student'),
(8, 'jayson', 'jajay', 'hay@gmail.com', 'jay123', 'student'),
(9, 'polpol', 'polpol', 'pol1234@gmail.com', 'pol1233', 'student'),
(10, 'ds', 'sdfs', 'sdf@as', 'sdfsdfs', 'student'),
(11, 'asdsad', 'asdasd', 'asdsa@asd', 'asda', 'student'),
(12, 'pol', 'asa', 'jeje@gmail.com', 'je123', 'student'),
(13, 'asdsa', 'asdad', 'asdsa@asd', 'sdaasda', 'student'),
(14, 'shawn', 'aldrin', 'shawn@gmail.com', 'shawn123', 'student'),
(15, 'Shawn', 'Lacambra', 'shawnicakes@gmail.com', 'shawnpogi123', 'student'),
(16, 'admin', '1', 'admin123@admin', 'admin123', 'Admin');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `comments_tbl`
--
ALTER TABLE `comments_tbl`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `event_tbl`
--
ALTER TABLE `event_tbl`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `memberstbl`
--
ALTER TABLE `memberstbl`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `scp_tbl`
--
ALTER TABLE `scp_tbl`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `comments_tbl`
--
ALTER TABLE `comments_tbl`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;

--
-- AUTO_INCREMENT for table `event_tbl`
--
ALTER TABLE `event_tbl`
  MODIFY `id` int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `memberstbl`
--
ALTER TABLE `memberstbl`
  MODIFY `id` int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `scp_tbl`
--
ALTER TABLE `scp_tbl`
  MODIFY `id` int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=17;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
