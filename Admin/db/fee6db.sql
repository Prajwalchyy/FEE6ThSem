-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Sep 19, 2024 at 04:18 AM
-- Server version: 10.4.32-MariaDB
-- PHP Version: 8.2.12

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `fee6`
--

-- --------------------------------------------------------

--
-- Table structure for table `program`
--

CREATE TABLE `program` (
  `pid` int(11) NOT NULL,
  `pname` varchar(255) NOT NULL,
  `pbased` varchar(50) NOT NULL,
  `pfullname` varchar(255) DEFAULT NULL,
  `pyear` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `program`
--

INSERT INTO `program` (`pid`, `pname`, `pbased`, `pfullname`, `pyear`) VALUES
(1, 'BHM', 'year', 'jadbfkjsaf', 4),
(2, 'BCA', 'semester', 'Bachelor Of Computer Application', 4),
(3, 'BIM', 'semester', 'asd', 4),
(4, 'BBS', 'year', 'a,sndasjndasd', 4);

-- --------------------------------------------------------

--
-- Table structure for table `student`
--

CREATE TABLE `student` (
  `sid` int(11) NOT NULL,
  `senroll` varchar(255) NOT NULL,
  `sname` varchar(255) NOT NULL,
  `scontact` varchar(20) NOT NULL,
  `ssex` varchar(10) NOT NULL,
  `pid` int(11) DEFAULT NULL,
  `sbatchyear` int(11) NOT NULL,
  `spassword` varchar(255) NOT NULL,
  `sfee` decimal(10,2) DEFAULT NULL,
  `sfeeplan` varchar(50) NOT NULL,
  `sstatus` varchar(20) DEFAULT 'active'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `student`
--

INSERT INTO `student` (`sid`, `senroll`, `sname`, `scontact`, `ssex`, `pid`, `sbatchyear`, `spassword`, `sfee`, `sfeeplan`, `sstatus`) VALUES
(14, '1', 'Niraj  Kumar chaudhary', '9811111111', 'male', 2, 2081, 'pass12345', 20000.00, 'semester', 'active'),
(15, '2', 'Prajwal Chaudhary', '9822222222', 'male', 2, 2081, 'pass12345', 20000.00, 'semester', 'active'),
(16, '3', 'Ankit Tamang', '9833333333', 'male', 3, 2081, 'pass12345', 20000.00, 'yearly', 'active'),
(17, '4', 'manish', '9844444444', 'male', 1, 2081, 'pass12345', 20000.00, 'yearly', 'active'),
(18, '5', 'Gaurav', '9855555555', 'male', 3, 2081, 'pass12345', 20000.00, 'yearly', 'active'),
(19, '6', 'Bishal', '9866666666', 'female', 3, 2081, 'pass12345', 20000.00, 'semester', 'active'),
(22, '40', 'Sushant chy', '9800000040', 'female', 3, 2081, 'pass12345', 20000.00, 'yearly', 'active'),
(23, '12', 'Z', '9800000012', 'female', 2, 2081, 'pass12345', 20000.00, 'semester', 'active'),
(24, '13', 'ZZ', '9800000013', 'female', 3, 2081, 'pass12345', 20000.00, 'semester', 'active'),
(25, '14', 'Example14', '9800000014', 'male', 4, 2081, 'pass12345', 20000.00, 'yearly', 'active');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `program`
--
ALTER TABLE `program`
  ADD PRIMARY KEY (`pid`);

--
-- Indexes for table `student`
--
ALTER TABLE `student`
  ADD PRIMARY KEY (`sid`),
  ADD KEY `pid` (`pid`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `program`
--
ALTER TABLE `program`
  MODIFY `pid` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `student`
--
ALTER TABLE `student`
  MODIFY `sid` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=26;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `student`
--
ALTER TABLE `student`
  ADD CONSTRAINT `student_ibfk_1` FOREIGN KEY (`pid`) REFERENCES `program` (`pid`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;