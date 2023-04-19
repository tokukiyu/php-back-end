-- THIS ONE IS DIRECT EXPORT FROM SERVER WE USED TO IMPLEMENT THE SYSTEM
--phpMyAdmin SQL Dump
-- version 5.2.0
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Apr 17, 2023 at 04:09 PM
-- Server version: 10.4.27-MariaDB
-- PHP Version: 8.2.0

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `dormitory`
--

-- --------------------------------------------------------

--
-- Table structure for table `admin`
--

CREATE TABLE `admin` (
  `id` int(11) NOT NULL,
  `username` varchar(20) NOT NULL,
  `password` varchar(20) NOT NULL,
  `Staff_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `admin`
--

INSERT INTO `admin` (`id`, `username`, `password`, `Staff_id`) VALUES
(1, 'admin', 'admin', 5);

-- --------------------------------------------------------

--
-- Table structure for table `block`
--

CREATE TABLE `block` (
  `blockId` int(11) NOT NULL,
  `Block_name` varchar(20) NOT NULL,
  `Isnew` tinyint(1) NOT NULL,
  `maxRoom` int(11) NOT NULL,
  `rooms` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `block`
--

INSERT INTO `block` (`blockId`, `Block_name`, `Isnew`, `maxRoom`, `rooms`) VALUES
(2, 'B002', 1, 50, 8),
(4, 'B003', 1, 50, 2),
(6, 'B001', 0, 45, 12),
(7, 'B005', 0, 30, 0),
(8, 'B004', 1, 40, 5),
(15, 'B006', 1, 50, 0);

-- --------------------------------------------------------

--
-- Table structure for table `booking`
--

CREATE TABLE `booking` (
  `bookingId` int(11) NOT NULL,
  `Student_id` int(11) NOT NULL,
  `Room_id` int(11) NOT NULL,
  `checkin_date` date NOT NULL,
  `checkout_date` date NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `booking`
--

INSERT INTO `booking` (`bookingId`, `Student_id`, `Room_id`, `checkin_date`, `checkout_date`) VALUES
(113, 10, 5, '2023-03-26', '2023-04-22'),
(114, 4, 5, '2023-03-26', '2023-04-22'),
(115, 19, 5, '2023-03-26', '2023-04-22'),
(116, 20, 5, '2023-03-26', '2023-04-22'),
(117, 17, 5, '2023-03-26', '2023-04-22'),
(118, 9, 5, '2023-03-26', '2023-04-22'),
(119, 6, 6, '2023-03-26', '2023-04-22'),
(120, 8, 6, '2023-03-26', '2023-04-22'),
(121, 11, 6, '2023-03-26', '2023-04-22'),
(122, 16, 20, '2023-04-15', '2023-04-09'),
(123, 15, 20, '2023-04-15', '2023-04-09'),
(124, 18, 20, '2023-04-15', '2023-04-09'),
(125, 12, 20, '2023-04-15', '2023-04-09'),
(126, 13, 20, '2023-04-15', '2023-04-09'),
(127, 14, 20, '2023-04-15', '2023-04-09'),
(128, 22, 21, '2023-04-15', '2023-04-09'),
(129, 23, 6, '2023-04-02', '2023-04-21');

-- --------------------------------------------------------

--
-- Table structure for table `inventory`
--

CREATE TABLE `inventory` (
  `Item_id` int(20) NOT NULL,
  `roomId` int(11) NOT NULL,
  `Item_name` varchar(20) NOT NULL,
  `Quantity` int(20) NOT NULL,
  `isNew` tinyint(1) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `inventory`
--

INSERT INTO `inventory` (`Item_id`, `roomId`, `Item_name`, `Quantity`, `isNew`) VALUES
(7, 2, 'table', 12, 1),
(8, 2, 'table', 12, 1),
(9, 2, 'table', 66, 1),
(10, 3, 'table', 66, 1),
(11, 3, 'bed', 12, 1),
(12, 3, 'bed', 24, 1),
(13, 3, 'bed', 36, 1),
(14, 3, 'bed', 48, 1),
(15, 3, 'bed', 60, 1),
(16, 3, 'bed', 72, 1),
(17, 3, 'bed', 84, 1),
(18, 3, 'bed', 96, 1),
(19, 3, 'bed', 108, 1),
(20, 3, 'bed', 120, 1),
(21, 3, 'bed', 132, 1),
(22, 3, 'bed', 144, 1),
(23, 3, 'bed', 156, 1),
(24, 3, 'bed', 168, 1),
(25, 3, 'bed', 180, 1),
(26, 3, 'bed', 192, 1),
(27, 3, 'bed', 204, 1),
(28, 3, 'bed', 216, 1),
(29, 3, 'bed', 228, 1),
(30, 3, 'bed', 240, 1),
(31, 3, 'bed', 252, 1),
(32, 3, 'bed', 264, 1),
(33, 3, 'bed', 276, 1),
(34, 3, 'bed', 288, 1),
(35, 3, 'bed', 300, 1),
(36, 3, 'bed', 312, 1),
(38, 2, 'bed', 6, 1),
(39, 2, 'bed', 7, 1),
(40, 2, 'table', 12, 1),
(41, 2, 'table', 24, 1),
(42, 2, 'table', 36, 1),
(43, 2, 'table', 48, 1),
(44, 2, 'table', 60, 1),
(45, 2, 'table', 61, 1),
(46, 2, 'table', 62, 1),
(47, 2, 'table', 63, 1),
(49, 9, 'table', 3, 1),
(50, 9, 'table', 5, 1);

-- --------------------------------------------------------

--
-- Table structure for table `room`
--

CREATE TABLE `room` (
  `roomId` int(20) NOT NULL,
  `roomName` varchar(20) NOT NULL,
  `Block_id` int(20) NOT NULL,
  `number_of_chair` int(20) NOT NULL,
  `number_of_table` int(11) NOT NULL,
  `number_of_bed` int(20) NOT NULL,
  `freeBed` int(11) NOT NULL,
  `availability` tinyint(1) NOT NULL,
  `materialFulfilled` tinyint(1) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `room`
--

INSERT INTO `room` (`roomId`, `roomName`, `Block_id`, `number_of_chair`, `number_of_table`, `number_of_bed`, `freeBed`, `availability`, `materialFulfilled`) VALUES
(1, '6', 2, 14, 10, 6, 6, 1, 1),
(2, '7', 2, 1, 63, 7, 5, 1, 1),
(3, '8', 2, 1, 66, 6, 2, 1, 1),
(4, '2', 4, 1, 3, 1, 6, 1, 1),
(5, '1', 6, 2, 3, 2, 0, 0, 1),
(6, '2', 6, 1, 1, 6, 2, 1, 1),
(7, '3', 6, 1, 1, 6, 6, 1, 1),
(8, '4', 6, 1, 1, 6, 6, 1, 1),
(9, '5', 6, 1, 5, 6, 6, 1, 1),
(10, '6', 6, 1, 1, 6, 6, 1, 1),
(11, '7', 6, 1, 1, 6, 6, 1, 1),
(12, '8', 6, 1, 1, 6, 6, 1, 1),
(13, '9', 6, 1, 1, 6, 6, 1, 1),
(14, '10', 6, 1, 1, 6, 6, 1, 1),
(15, '11', 6, 1, 1, 6, 6, 1, 1),
(16, '12', 6, 1, 1, 6, 6, 1, 1),
(17, '1', 8, 2, 3, 6, 6, 1, 1),
(18, '2', 8, 2, 3, 6, 6, 1, 1),
(19, '3', 8, 2, 3, 6, 6, 1, 1),
(20, '4', 15, 2, 3, 6, 0, 0, 1),
(21, '5', 15, 2, 5, 6, 5, 1, 1);

-- --------------------------------------------------------

--
-- Table structure for table `staff`
--

CREATE TABLE `staff` (
  `Staff_id` int(20) NOT NULL,
  `fname` varchar(20) NOT NULL,
  `mname` varchar(20) NOT NULL,
  `lname` varchar(20) NOT NULL,
  `Job_title` varchar(20) NOT NULL,
  `role` varchar(20) NOT NULL,
  `phone_number` varchar(20) NOT NULL,
  `email` varchar(20) NOT NULL,
  `Student_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `staff`
--

INSERT INTO `staff` (`Staff_id`, `fname`, `mname`, `lname`, `Job_title`, `role`, `phone_number`, `email`, `Student_id`) VALUES
(5, 'after', 'adada', 'year', 'manager', 'Admin', '1234567', 'tokkiyuam@gmail.com', 0),
(6, 'after', 'adada', 'year', 'Genitor', '', '1234567', 'tokkiyuam@gmail.com', 0),
(7, 'after', 'adada', 'year', 'Genitor', '', '1234567', 'tokkiyuam@gmail.com', 0),
(8, 'after', 'adada', 'year', 'Genitor', '', '1234567', 'tokkiyuam@gmail.com', 0),
(9, 'dani', 'megersa', 'year', 'proctor', 'proctor', '111', 'adad@ju.com', 0),
(12, 'dani', 'megersa', 'year', 'proctor', 'proctor', '111', 'adad@ju.com', 0),
(13, 'bilise', 'megersa', 'chala', 'proctor', 'proctor', '1234567', 'adad@ju.com', 0);

-- --------------------------------------------------------

--
-- Table structure for table `student`
--

CREATE TABLE `student` (
  `Student_id` int(20) NOT NULL,
  `fname` varchar(20) NOT NULL,
  `mname` varchar(20) NOT NULL,
  `lname` varchar(20) NOT NULL,
  `sex` varchar(20) NOT NULL,
  `B_date` varchar(20) NOT NULL,
  `phone_number` bigint(20) NOT NULL,
  `email` varchar(20) NOT NULL,
  `year` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `student`
--

INSERT INTO `student` (`Student_id`, `fname`, `mname`, `lname`, `sex`, `B_date`, `phone_number`, `email`, `year`) VALUES
(4, 'abu', 'adada', 'year', 'Male', '2023-04-11', 1234567, 'tokkiyuam@gmail.com', 0),
(6, 'solo', 'adada', 'year', 'Male', '2023-04-11', 1234567, 'tokkiyuam@gmail.com', 0),
(8, 'steve', 'adada', 'year', 'Male', '2023-04-19', 1234567, 'tokkiyuam@gmail.com', 1),
(9, 'debela', 'adada', 'year', 'Male', '2023-04-19', 12222, 'tokkiyuam@gmail.com', 1),
(10, 'abeba', 'adada', 'year', 'Male', '2023-04-19', 12222, 'tokkiyuam@gmail.com', 1),
(11, 'tolesa', 'megersa', 'chala', 'Male', '2023-04-14', 33321, 'adad@ju.com', 1),
(12, 'diriba', 'megersa', 'chala', 'Female', '2023-04-14', 33321, 'adad@ju.com', 1),
(13, 'diribu', 'megersa', 'chala', 'Female', '2023-04-14', 33321, 'adad@ju.com', 1),
(14, 'jaalu', 'megersa', 'chala', 'Female', '2023-04-14', 33321, 'adad@ju.com', 1),
(15, 'darartu', 'megersa', 'chala', 'Female', '2023-04-14', 33321, 'adad@ju.com', 1),
(16, 'bilise', 'megersa', 'chala', 'Female', '2023-04-14', 33321, 'adad@ju.com', 1),
(17, 'darartu', 'megersa', 'chala', 'Male', '2023-04-30', 1234567, 'adad@ju.com', 3),
(18, 'darartu', 'megersa', 'chala', 'Female', '2023-04-09', 1234567, 'adad@ju.com', 2),
(19, 'adur', 'megersa', 'www', 'Male', '2023-04-24', 1234567, 'adad@ju.com', 4),
(20, 'adur', 'megersa', 'www', 'Male', '2023-04-24', 1234567, 'adad@ju.com', 4),
(22, 'tsion', 'ephrem', 'kere', 'Female', '2023-05-05', 941621844, 'tsionephrem7@gmail.c', 1),
(23, 'firaol', 'x', 'tesfaye', 'Male', '2023-04-09', 1234567, 'adad@ju.com', 3);

-- --------------------------------------------------------

--
-- Table structure for table `works_on`
--

CREATE TABLE `works_on` (
  `Job_id` int(11) NOT NULL,
  `job_name` varchar(20) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `works_on`
--

INSERT INTO `works_on` (`Job_id`, `job_name`) VALUES
(5, 'Genitor'),
(3, 'manager'),
(4, 'proctor'),
(6, 'technician');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `admin`
--
ALTER TABLE `admin`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `username` (`username`),
  ADD KEY `Staff_id` (`Staff_id`);

--
-- Indexes for table `block`
--
ALTER TABLE `block`
  ADD PRIMARY KEY (`blockId`);

--
-- Indexes for table `booking`
--
ALTER TABLE `booking`
  ADD PRIMARY KEY (`bookingId`),
  ADD KEY `Room_id` (`Room_id`),
  ADD KEY `booking_ibfk_2` (`Student_id`);

--
-- Indexes for table `inventory`
--
ALTER TABLE `inventory`
  ADD PRIMARY KEY (`Item_id`),
  ADD KEY `inventory_ibfk_1` (`roomId`);

--
-- Indexes for table `room`
--
ALTER TABLE `room`
  ADD PRIMARY KEY (`roomId`),
  ADD KEY `Block_id` (`Block_id`);

--
-- Indexes for table `staff`
--
ALTER TABLE `staff`
  ADD PRIMARY KEY (`Staff_id`),
  ADD KEY `Job_title` (`Job_title`),
  ADD KEY `role` (`role`);

--
-- Indexes for table `student`
--
ALTER TABLE `student`
  ADD PRIMARY KEY (`Student_id`);

--
-- Indexes for table `works_on`
--
ALTER TABLE `works_on`
  ADD PRIMARY KEY (`Job_id`),
  ADD KEY `Job_id` (`Job_id`),
  ADD KEY `Job_id_2` (`Job_id`),
  ADD KEY `job_name` (`job_name`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `admin`
--
ALTER TABLE `admin`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `block`
--
ALTER TABLE `block`
  MODIFY `blockId` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=16;

--
-- AUTO_INCREMENT for table `booking`
--
ALTER TABLE `booking`
  MODIFY `bookingId` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=130;

--
-- AUTO_INCREMENT for table `inventory`
--
ALTER TABLE `inventory`
  MODIFY `Item_id` int(20) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=51;

--
-- AUTO_INCREMENT for table `room`
--
ALTER TABLE `room`
  MODIFY `roomId` int(20) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=22;

--
-- AUTO_INCREMENT for table `staff`
--
ALTER TABLE `staff`
  MODIFY `Staff_id` int(20) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=14;

--
-- AUTO_INCREMENT for table `student`
--
ALTER TABLE `student`
  MODIFY `Student_id` int(20) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=24;

--
-- AUTO_INCREMENT for table `works_on`
--
ALTER TABLE `works_on`
  MODIFY `Job_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `admin`
--
ALTER TABLE `admin`
  ADD CONSTRAINT `admin_ibfk_1` FOREIGN KEY (`Staff_id`) REFERENCES `staff` (`Staff_id`);

--
-- Constraints for table `booking`
--
ALTER TABLE `booking`
  ADD CONSTRAINT `booking_ibfk_1` FOREIGN KEY (`Room_id`) REFERENCES `room` (`roomId`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `booking_ibfk_2` FOREIGN KEY (`Student_id`) REFERENCES `student` (`Student_id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `inventory`
--
ALTER TABLE `inventory`
  ADD CONSTRAINT `inventory_ibfk_1` FOREIGN KEY (`roomId`) REFERENCES `room` (`roomId`);

--
-- Constraints for table `room`
--
ALTER TABLE `room`
  ADD CONSTRAINT `room_ibfk_1` FOREIGN KEY (`Block_id`) REFERENCES `block` (`blockId`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `staff`
--
ALTER TABLE `staff`
  ADD CONSTRAINT `staff_ibfk_1` FOREIGN KEY (`Job_title`) REFERENCES `works_on` (`job_name`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
