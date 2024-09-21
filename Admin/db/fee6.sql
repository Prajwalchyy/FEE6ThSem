-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Sep 20, 2024 at 06:58 PM
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
-- Table structure for table `admin`
--

CREATE TABLE `admin` (
  `aid` int(11) NOT NULL,
  `auser` varchar(255) NOT NULL,
  `apass` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `admin`
--

INSERT INTO `admin` (`aid`, `auser`, `apass`) VALUES
(1, 'admin1@gmail.com', 'admin1'),
(2, 'admin2@gmail.com', 'admin2');

-- --------------------------------------------------------

--
-- Table structure for table `fee_transaction`
--

CREATE TABLE `fee_transaction` (
  `feeid` int(11) NOT NULL,
  `sid` int(11) DEFAULT NULL,
  `mid` int(11) DEFAULT NULL,
  `receipt_number` varchar(50) DEFAULT NULL,
  `feecategory` varchar(100) DEFAULT NULL,
  `payment_method` varchar(50) DEFAULT NULL,
  `amount` decimal(10,2) DEFAULT NULL,
  `payment_date` date DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `morefee`
--

CREATE TABLE `morefee` (
  `mid` int(11) NOT NULL,
  `sid` int(11) NOT NULL,
  `mfeecategory` varchar(255) NOT NULL,
  `amount` decimal(10,2) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `morefee`
--

INSERT INTO `morefee` (`mid`, `sid`, `mfeecategory`, `amount`) VALUES
(1, 22, 'Transportation', 1000.00),
(2, 22, 'Transportation', 20.00),
(3, 19, 'Others', 500.00),
(4, 19, 'Exam fee', 200.00),
(5, 18, 'Others', 2000.00),
(6, 22, 'Exam fee', 500.00),
(7, 23, 'Transportation', 1000.00),
(8, 23, 'Exam fee', 500.00);

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
-- Indexes for table `admin`
--
ALTER TABLE `admin`
  ADD PRIMARY KEY (`aid`);

--
-- Indexes for table `fee_transaction`
--
ALTER TABLE `fee_transaction`
  ADD PRIMARY KEY (`feeid`),
  ADD KEY `sid` (`sid`),
  ADD KEY `mid` (`mid`);

--
-- Indexes for table `morefee`
--
ALTER TABLE `morefee`
  ADD PRIMARY KEY (`mid`),
  ADD KEY `sid` (`sid`);

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
-- AUTO_INCREMENT for table `admin`
--
ALTER TABLE `admin`
  MODIFY `aid` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `fee_transaction`
--
ALTER TABLE `fee_transaction`
  MODIFY `feeid` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `morefee`
--
ALTER TABLE `morefee`
  MODIFY `mid` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

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
-- Constraints for table `fee_transaction`
--
ALTER TABLE `fee_transaction`
  ADD CONSTRAINT `fee_transaction_ibfk_1` FOREIGN KEY (`sid`) REFERENCES `student` (`sid`),
  ADD CONSTRAINT `fee_transaction_ibfk_2` FOREIGN KEY (`mid`) REFERENCES `morefee` (`mid`);

--
-- Constraints for table `morefee`
--
ALTER TABLE `morefee`
  ADD CONSTRAINT `morefee_ibfk_1` FOREIGN KEY (`sid`) REFERENCES `student` (`sid`);

--
-- Constraints for table `student`
--
ALTER TABLE `student`
  ADD CONSTRAINT `student_ibfk_1` FOREIGN KEY (`pid`) REFERENCES `program` (`pid`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
