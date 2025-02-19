-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Nov 14, 2024 at 04:49 PM
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
-- Database: `book_calendar`
--

-- --------------------------------------------------------

--
-- Table structure for table `bookings`
--

CREATE TABLE `bookings` (
  `id` int(11) NOT NULL,
  `church_id` int(11) NOT NULL,
  `date` date NOT NULL,
  `time_slot` time NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `service_type` enum('Wedding','Baptismal','Funeral') NOT NULL,
  `status` enum('pending','confirmed','cancelled') DEFAULT 'pending'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `booking_slots`
--

CREATE TABLE `booking_slots` (
  `id` int(11) NOT NULL,
  `date` date NOT NULL,
  `slots` int(11) NOT NULL DEFAULT 15,
  `booked` int(11) NOT NULL DEFAULT 0,
  `church_id` int(11) NOT NULL,
  `total_slots` int(11) NOT NULL DEFAULT 15,
  `booked_slots` int(11) NOT NULL DEFAULT 0
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `booking_time_slots`
--

CREATE TABLE `booking_time_slots` (
  `id` int(11) NOT NULL,
  `time_slot` time NOT NULL,
  `max_slots` int(11) DEFAULT 3,
  `is_active` tinyint(1) DEFAULT 1,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `booking_time_slots`
--

INSERT INTO `booking_time_slots` (`id`, `time_slot`, `max_slots`, `is_active`, `created_at`) VALUES
(1, '09:00:00', 0, 1, '2024-11-13 15:21:55'),
(2, '10:00:00', 0, 1, '2024-11-13 15:21:55'),
(3, '11:00:00', 0, 1, '2024-11-13 15:21:55'),
(4, '13:00:00', 0, 1, '2024-11-13 15:21:55'),
(5, '14:00:00', 0, 1, '2024-11-13 15:21:55'),
(6, '15:00:00', 0, 1, '2024-11-13 15:21:55'),
(7, '09:00:00', 0, 1, '2024-11-13 15:25:19'),
(8, '10:00:00', 0, 1, '2024-11-13 15:25:19'),
(9, '11:00:00', 0, 1, '2024-11-13 15:25:19'),
(10, '13:00:00', 0, 1, '2024-11-13 15:25:19'),
(11, '14:00:00', 0, 1, '2024-11-13 15:25:19'),
(12, '15:00:00', 0, 1, '2024-11-13 15:25:19'),
(13, '09:00:00', 0, 1, '2024-11-13 17:01:49'),
(14, '10:00:00', 0, 1, '2024-11-13 17:01:49'),
(15, '11:00:00', 0, 1, '2024-11-13 17:01:49'),
(16, '12:00:00', 0, 1, '2024-11-13 17:01:49'),
(17, '13:00:00', 0, 1, '2024-11-13 17:01:49'),
(18, '14:00:00', 0, 1, '2024-11-13 17:01:49'),
(19, '15:00:00', 0, 1, '2024-11-13 17:01:49'),
(20, '16:00:00', 0, 1, '2024-11-13 17:01:49'),
(21, '17:00:00', 0, 1, '2024-11-13 17:01:49');

-- --------------------------------------------------------

--
-- Table structure for table `churches`
--

CREATE TABLE `churches` (
  `id` int(11) NOT NULL,
  `church_name` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `churches`
--

INSERT INTO `churches` (`id`, `church_name`) VALUES
(1, 'St. Ignatius of Loyola Parish (Ususan, Taguig)'),
(2, 'St. Michael the Archangel Parish (BGC, Taguig)'),
(3, 'Sto. Rosario de Pasig Parish (Rosario, Pasig)'),
(4, 'Sta. Rosa de Lima Parish (Bagong Ilog, Pasig)');

-- --------------------------------------------------------

--
-- Table structure for table `service_time_slots`
--

CREATE TABLE `service_time_slots` (
  `id` int(11) NOT NULL,
  `service_type` enum('Wedding','Baptismal','Funeral') NOT NULL,
  `time_slot` time NOT NULL,
  `max_slots` int(11) NOT NULL,
  `is_active` tinyint(1) DEFAULT 1
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `service_time_slots`
--

INSERT INTO `service_time_slots` (`id`, `service_type`, `time_slot`, `max_slots`, `is_active`) VALUES
(1, 'Wedding', '10:00:00', 1, 1),
(2, 'Wedding', '13:30:00', 1, 1),
(3, 'Wedding', '15:30:00', 1, 1),
(4, 'Baptismal', '08:00:00', 3, 1),
(5, 'Baptismal', '11:30:00', 3, 1),
(6, 'Funeral', '13:00:00', 3, 1),
(7, 'Funeral', '14:00:00', 3, 1),
(8, 'Funeral', '15:00:00', 3, 1);

--
-- Indexes for dumped tables
--

--
-- Indexes for table `bookings`
--
ALTER TABLE `bookings`
  ADD PRIMARY KEY (`id`),
  ADD KEY `church_id` (`church_id`,`date`,`time_slot`);

--
-- Indexes for table `booking_slots`
--
ALTER TABLE `booking_slots`
  ADD PRIMARY KEY (`id`),
  ADD KEY `church_id` (`church_id`);

--
-- Indexes for table `booking_time_slots`
--
ALTER TABLE `booking_time_slots`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `churches`
--
ALTER TABLE `churches`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `service_time_slots`
--
ALTER TABLE `service_time_slots`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `unique_service_time` (`service_type`,`time_slot`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `bookings`
--
ALTER TABLE `bookings`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `booking_slots`
--
ALTER TABLE `booking_slots`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `booking_time_slots`
--
ALTER TABLE `booking_time_slots`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=22;

--
-- AUTO_INCREMENT for table `churches`
--
ALTER TABLE `churches`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `service_time_slots`
--
ALTER TABLE `service_time_slots`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=18;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `booking_slots`
--
ALTER TABLE `booking_slots`
  ADD CONSTRAINT `booking_slots_ibfk_1` FOREIGN KEY (`church_id`) REFERENCES `churches` (`id`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
