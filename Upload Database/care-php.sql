-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Aug 07, 2024 at 02:47 PM
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
-- Database: `care-php`
--

-- --------------------------------------------------------

--
-- Table structure for table `appointments`
--

CREATE TABLE `appointments` (
  `A_ID` int(11) NOT NULL,
  `Patient_name` varchar(50) NOT NULL,
  `Patient_email` varchar(50) NOT NULL,
  `Patient_phone` varchar(50) NOT NULL,
  `Disease` varchar(50) NOT NULL,
  `Doctor_Name` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `appointments`
--

INSERT INTO `appointments` (`A_ID`, `Patient_name`, `Patient_email`, `Patient_phone`, `Disease`, `Doctor_Name`) VALUES
(16, 'Bemar Person', 'patient@gmail.com', '03191327491', 'Pelo Khalo Zukhami Phobia', 'John Wick'),
(18, 'Patient2', 'Patient2@gmail.com', '03233205953', 'Human phobia', 'Penny Wise'),
(22, 'Patient3', 'Patient3@gmail.com', '01234567891', 'Food Phobia', 'James Bond');

-- --------------------------------------------------------

--
-- Table structure for table `cities`
--

CREATE TABLE `cities` (
  `C_ID` int(11) NOT NULL,
  `C_Name` varchar(50) NOT NULL,
  `Departments` mediumtext NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci COMMENT='City Management Table For Admin';

--
-- Dumping data for table `cities`
--

INSERT INTO `cities` (`C_ID`, `C_Name`, `Departments`) VALUES
(1, 'Karachi', 'Emergency department, ICU, CCU, Surgical Unit'),
(4, 'Lahore', 'Neurology Department, Oncology Department, Radiology Department, Laboratory Services.'),
(6, 'Islamabad', 'Intensive Care Unit, Physical Therapy, Pharmacy, Nutrition Services, Psychiatry');

-- --------------------------------------------------------

--
-- Table structure for table `departments`
--

CREATE TABLE `departments` (
  `Dip-ID` int(11) NOT NULL,
  `Dip-Name` varchar(50) NOT NULL,
  `Location` varchar(50) NOT NULL,
  `Dep-Phone` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `departments`
--

INSERT INTO `departments` (`Dip-ID`, `Dip-Name`, `Location`, `Dep-Phone`) VALUES
(1, 'Emergancy Department', 'Karachi', '03332156784');

-- --------------------------------------------------------

--
-- Table structure for table `user`
--

CREATE TABLE `user` (
  `id` int(11) NOT NULL,
  `name` varchar(50) NOT NULL,
  `email` varchar(50) NOT NULL,
  `password` varchar(50) NOT NULL,
  `phone` varchar(50) NOT NULL,
  `Role` int(11) NOT NULL DEFAULT 3 COMMENT '1=Admin, 2=Doctor, 3=Patient',
  `City` varchar(50) DEFAULT NULL,
  `Education` varchar(50) DEFAULT NULL,
  `Specialization` varchar(50) DEFAULT NULL,
  `Availability` varchar(30) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `user`
--

INSERT INTO `user` (`id`, `name`, `email`, `password`, `phone`, `Role`, `City`, `Education`, `Specialization`, `Availability`) VALUES
(1, 'Admin', 'hi@hi.com', 'hi', '03191327495', 1, 'Karachi', 'Tanking DAMAGE !!!', 'BEST TANK OF ALL TIME!! MINSITANK OP!!', ''),
(11, 'James Bond', 'jamesbond@gmail.com', 'jamesbond', '03191327495', 2, 'Karachi', 'MinsiTank', 'test doctor', 'WEEKLY'),
(32, 'Penny Wise', 'TakeTheBoat@pennywise.com', 'pennywise', '03191727495', 2, 'Lahore', 'CLASS 1 Fail', 'Best Boat Giver 🤡🔪⛵', 'DAILY'),
(33, 'John Wick', 'MrWick@doctor.com', 'JohnWick', '01234567891', 2, 'Islamabad', 'MDCAT', 'skin care specialist', 'Weekly'),
(36, 'Bemar Person', 'patient@gmail.com', 'patient', '03191327491', 3, NULL, NULL, NULL, NULL),
(37, 'Mr Been', 'MrBeen@teddy.com', 'teddy', '55555555555', 2, 'Lahore', 'Comedy', '9999999 IQ ', 'Daily'),
(38, 'Patient2', 'Patient2@gmail.com', 'patient', '03233205953', 3, NULL, NULL, NULL, NULL),
(39, 'Patient3', 'Patient3@gmail.com', 'patient', '01234567891', 3, NULL, NULL, NULL, NULL),
(40, 'Dr. Sarah Johnson', 'sarah@gmail.com', 'pass123', '03482215497', 2, 'New York', 'MD', 'Cardiology', 'Daily'),
(41, 'Dr. Michael Anderson', 'michael@gmail.com', 'doctor456', '03444215497', 2, 'Los Angeles', 'DO', 'Orthopedics', 'Monthly'),
(42, 'Dr. Emily Martinez', 'emily@gmail.com', 'medpass789', '012345847891', 2, 'Chicago', 'MBBS', 'Pediatrics', 'Weekly'),
(43, 'MUHAMMED TAHA KHAN', 'tahanew8242@gmail.com', 'Tahakhan53', '03192924947', 2, 'Karachi', 'Pahli Fail', 'Kuch Nahi AATA', 'WEEKLY');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `appointments`
--
ALTER TABLE `appointments`
  ADD PRIMARY KEY (`A_ID`);

--
-- Indexes for table `cities`
--
ALTER TABLE `cities`
  ADD PRIMARY KEY (`C_ID`);

--
-- Indexes for table `departments`
--
ALTER TABLE `departments`
  ADD PRIMARY KEY (`Dip-ID`);

--
-- Indexes for table `user`
--
ALTER TABLE `user`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `appointments`
--
ALTER TABLE `appointments`
  MODIFY `A_ID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=23;

--
-- AUTO_INCREMENT for table `cities`
--
ALTER TABLE `cities`
  MODIFY `C_ID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT for table `departments`
--
ALTER TABLE `departments`
  MODIFY `Dip-ID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `user`
--
ALTER TABLE `user`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=44;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
