-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Feb 19, 2025 at 11:17 PM
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
-- Database: `u493132415_pasiginaenae`
--

-- --------------------------------------------------------

--
-- Table structure for table `audit trail`
--

CREATE TABLE `audit trail` (
  `date` date NOT NULL,
  `user` varchar(30) NOT NULL,
  `email` varchar(100) NOT NULL,
  `time_in` datetime NOT NULL,
  `time_out` datetime NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

-- --------------------------------------------------------

--
-- Table structure for table `baptism`
--

CREATE TABLE `baptism` (
  `baptism_record_id` int(11) NOT NULL,
  `catechumen_fname` varchar(100) NOT NULL,
  `catechumen_mname` varchar(100) NOT NULL,
  `catechumen_lname` varchar(100) NOT NULL,
  `date_of_birth` varchar(100) NOT NULL,
  `place_of_birth` varchar(100) NOT NULL,
  `nationality` varchar(100) NOT NULL,
  `father_fname` varchar(100) NOT NULL,
  `father_mname` varchar(100) NOT NULL,
  `father_lname` varchar(100) NOT NULL,
  `father_placeofbirth` varchar(100) NOT NULL,
  `father_address` varchar(100) NOT NULL,
  `father_civilstatus` varchar(50) NOT NULL,
  `mother_fname` varchar(100) NOT NULL,
  `mother_mname` varchar(100) NOT NULL,
  `mother_lname` varchar(100) NOT NULL,
  `mother_placeofbirth` varchar(100) NOT NULL,
  `mother_address` varchar(100) NOT NULL,
  `mother_civilstatus` varchar(50) NOT NULL,
  `p_sponsor(male)` varchar(100) NOT NULL,
  `p_sponsor(female)` varchar(100) NOT NULL,
  `sponsor_three` varchar(255) DEFAULT NULL,
  `sponsor_four` varchar(255) DEFAULT NULL,
  `sponsor_five` varchar(255) DEFAULT NULL,
  `sponsor_six` varchar(255) DEFAULT NULL,
  `sponsor_seven` varchar(255) DEFAULT NULL,
  `sponsor_eight` varchar(255) DEFAULT NULL,
  `date_time` varchar(100) NOT NULL,
  `place_of_baptism` varchar(100) NOT NULL,
  `priest` varchar(100) NOT NULL,
  `email` varchar(100) NOT NULL,
  `contact_no` int(11) NOT NULL,
  `sched_type` varchar(50) NOT NULL,
  `reserver_name` varchar(100) NOT NULL,
  `birth_cert` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `baptism`
--

INSERT INTO `baptism` (`baptism_record_id`, `catechumen_fname`, `catechumen_mname`, `catechumen_lname`, `date_of_birth`, `place_of_birth`, `nationality`, `father_fname`, `father_mname`, `father_lname`, `father_placeofbirth`, `father_address`, `father_civilstatus`, `mother_fname`, `mother_mname`, `mother_lname`, `mother_placeofbirth`, `mother_address`, `mother_civilstatus`, `p_sponsor(male)`, `p_sponsor(female)`, `sponsor_three`, `sponsor_four`, `sponsor_five`, `sponsor_six`, `sponsor_seven`, `sponsor_eight`, `date_time`, `place_of_baptism`, `priest`, `email`, `contact_no`, `sched_type`, `reserver_name`, `birth_cert`) VALUES
(1, 'Jezreel Deniel', 'Manalang', 'David', '06/12/2003', 'Our Lady Of Lourdes Hospital', 'Filipino', 'Sonny', 'Zamora', 'David', 'Mandaluyong', 'Hatdog', 'married', 'Filipina', 'Manalang', 'David', 'Pampanga', 'Hotdog', 'married', 'Saturnino Mercado David', 'Eufemia Zamora', '', '', '', '', '', '', '', 'Sta. Rosa de Lima Parish', 'qqfqf', 'dummyaccount@gmail.com', 2147483647, 'Special', 'hotdog', 'Jezreel Deniel M David.png');

-- --------------------------------------------------------

--
-- Table structure for table `bookings`
--

CREATE TABLE `bookings` (
  `id` int(11) NOT NULL,
  `church_id` int(11) NOT NULL,
  `service_type` varchar(50) NOT NULL,
  `date` date NOT NULL,
  `time_slot` time NOT NULL,
  `status` varchar(20) DEFAULT 'pending',
  `created_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `burial`
--

CREATE TABLE `burial` (
  `burial_record_id` int(11) NOT NULL,
  `full_name` varchar(255) NOT NULL,
  `age` int(11) NOT NULL,
  `date_of_death` varchar(100) NOT NULL,
  `funeral_date` varchar(100) NOT NULL,
  `parish` varchar(100) NOT NULL,
  `funeral_location` varchar(100) NOT NULL,
  `reserver_name` varchar(100) NOT NULL,
  `email` varchar(255) NOT NULL,
  `contact_no` varchar(10) NOT NULL,
  `death_certificate` longblob NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `burial`
--

INSERT INTO `burial` (`burial_record_id`, `full_name`, `age`, `date_of_death`, `funeral_date`, `parish`, `funeral_location`, `reserver_name`, `email`, `contact_no`, `death_certificate`) VALUES
(1, 'Sarah Duterte', 46, '10/22/2024', '', 'St. Ignatius of Loyola Parish', 'Lambac', 'DummyAccount', 'dummyaccount@gmail.com', '9437086977', 0x4d69647465726d204578616d696e6174696f6e5f2049544320433330322d33303249205f2053595354454d20494e544547524154494f4e20414e4420415243482031205f20575f53205f20365f3030504d2d385f3030504d5f365f3030504d2d395f3030504d205f207462615f482d3431322e706466),
(2, 'Samson Delilah', 49, '10/22/2024', '', 'St. Michael the Archangel Parish, BGC', 'Natividad', 'DummyAccount2', 'dummyaccount@gmail.com', '9437086977', 0x4d69647465726d204578616d696e6174696f6e5f2049544320433330322d33303249205f2053595354454d20494e544547524154494f4e20414e4420415243482031205f20575f53205f20365f3030504d2d385f3030504d5f365f3030504d2d395f3030504d205f207462615f482d3431322e706466),
(3, 'Asasdasd F. Adsdesd', 20, 'December 20, 2024', '', 'St. Ignatius of Loyola Parish', 'Maquiapo', 'Jan Fernan Bondad', 'jinfernan1202@gmail.com', '9564150085', 0x3031342d313438783139392d436f7069652e6a7067);

-- --------------------------------------------------------

--
-- Table structure for table `chatapp`
--

CREATE TABLE `chatapp` (
  `user_id` int(11) NOT NULL,
  `unique_id` int(255) NOT NULL,
  `fname` varchar(255) NOT NULL,
  `lname` varchar(255) NOT NULL,
  `email` varchar(255) NOT NULL,
  `password` varchar(255) NOT NULL,
  `img` varchar(255) NOT NULL,
  `status` varchar(255) NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

-- --------------------------------------------------------

--
-- Table structure for table `matrimony`
--

CREATE TABLE `matrimony` (
  `id` int(11) NOT NULL,
  `groom_name` varchar(255) NOT NULL,
  `bride_name` varchar(255) NOT NULL,
  `dob_groom` varchar(100) NOT NULL,
  `dob_bride` varchar(100) NOT NULL,
  `pob_groom` varchar(255) NOT NULL,
  `pob_bride` varchar(255) NOT NULL,
  `address_groom` varchar(255) NOT NULL,
  `address_bride` varchar(255) NOT NULL,
  `religion_groom` varchar(100) NOT NULL,
  `religion_bride` varchar(100) NOT NULL,
  `fathername_groom` varchar(255) NOT NULL,
  `fathername_bride` varchar(255) NOT NULL,
  `mothername_groom` varchar(255) NOT NULL,
  `mothername_bride` varchar(255) NOT NULL,
  `witness_male` varchar(255) NOT NULL,
  `witness_female` varchar(255) NOT NULL,
  `relation_male` varchar(100) NOT NULL,
  `relation_female` varchar(100) NOT NULL,
  `baptismal_groom` varchar(255) DEFAULT NULL,
  `confirmation_groom` varchar(255) DEFAULT NULL,
  `birthcert_groom` varchar(255) DEFAULT NULL,
  `baptismal_bride` varchar(255) DEFAULT NULL,
  `confirmation_bride` varchar(255) DEFAULT NULL,
  `birthcert_bride` varchar(255) DEFAULT NULL,
  `reserve_name` varchar(255) NOT NULL,
  `email` varchar(255) NOT NULL,
  `phone_number` varchar(20) NOT NULL,
  `no_of_guest` int(11) DEFAULT 0,
  `parish` varchar(255) NOT NULL,
  `priest` varchar(100) NOT NULL,
  `date_time` datetime NOT NULL,
  `event_type` enum('Wedding','Other') NOT NULL DEFAULT 'Wedding',
  `created_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `matrimony`
--

INSERT INTO `matrimony` (`id`, `groom_name`, `bride_name`, `dob_groom`, `dob_bride`, `pob_groom`, `pob_bride`, `address_groom`, `address_bride`, `religion_groom`, `religion_bride`, `fathername_groom`, `fathername_bride`, `mothername_groom`, `mothername_bride`, `witness_male`, `witness_female`, `relation_male`, `relation_female`, `baptismal_groom`, `confirmation_groom`, `birthcert_groom`, `baptismal_bride`, `confirmation_bride`, `birthcert_bride`, `reserve_name`, `email`, `phone_number`, `no_of_guest`, `parish`, `priest`, `date_time`, `event_type`, `created_at`) VALUES
(2, 'Jan Fernan Bondad', 'Missy Claire Doctor', '0000-00-00', '0000-00-00', 'Mandaluyong City', 'Taguig City', 'Taguig City', 'Taguig City', 'Roman Catholic', 'Roman Catholic', 'Fernando S. Bondad', 'Allan Doctor', '', '', '', '', '', '', '', '', '', '', '', '', '', 'jinfernan1202@gmail.com', '9564150085', 30, 'St. Ignatius of Loyola Parish', '', '2025-02-26 10:00:00', '', '2025-02-18 14:15:10'),
(3, 'Jan Fernan Bondad', 'Missy Claire Doctor', 'December 2, 2000', 'February 10, 2002', 'Mandaluyong City', 'Taguig City', 'Taguig City', 'Taguig City', 'Roman Catholic', 'Roman Catholic', 'Fernando S. Bondad', 'Allan Doctor', 'Maria Teresa I. Bondad', 'Melissa Doctor', 'Aldrian Florentino', 'France Bondad', 'Brother in Law', 'Sister', '', '', '', '', '', '', '', 'jinfernan1202@gmail.com', '9564150085', 30, 'St. Ignatius of Loyola Parish', '', '2025-02-26 10:00:00', '', '2025-02-19 12:20:56'),
(4, 'Jan Fernan Bondad', 'Missy Claire Doctor', 'December 2, 2000', 'February 10, 2002', 'Mandaluyong City', 'Taguig City', 'Taguig City', 'Taguig City', 'Roman Catholic', 'Roman Catholic', 'Fernando S. Bondad', 'Allan Doctor', 'Maria Teresa I. Bondad', 'Melissa Doctor', 'Aldrian Florentino', 'France Bondad', 'Brother in Law', 'Sister', '', '', '', '', '', '', '', 'jinfernan1202@gmail.com', '9564150085', 30, 'St. Ignatius of Loyola Parish', 'Rev. Fr. Mariano Agruda III, OCD', '2025-02-27 10:00:00', '', '2025-02-19 12:27:42');

-- --------------------------------------------------------

--
-- Table structure for table `ordination for priesthood`
--

CREATE TABLE `ordination for priesthood` (
  `serial_no` int(20) NOT NULL,
  `name_of_ordinandi` varchar(100) NOT NULL,
  `date_of_ordination` date NOT NULL,
  `consecrator` varchar(100) NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

--
-- Dumping data for table `ordination for priesthood`
--

INSERT INTO `ordination for priesthood` (`serial_no`, `name_of_ordinandi`, `date_of_ordination`, `consecrator`) VALUES
(2, 'REV. FR. ADAM GREGOR MOZO ARELLANO', '2022-11-30', 'MOST REV. MYLO HUBERT C. VERGARA, D.D'),
(3, 'REV. FR. JOSEPH DORIA SANTOS', '2021-02-02', 'MOST REV. MYLO HUBERT C. VERGARA, D.D'),
(4, 'REV. FR. FLOREDELITO CAONES DADOR, JR.', '2021-02-02', 'MOST REV. MYLO HUBERT C. VERGARA, D.D'),
(5, 'REV. FR. JULIUS VEGO DE GRACIA', '2021-02-02', 'MOST REV. MYLO HUBERT C. VERGARA, D.D'),
(6, 'REV. FR. JOHN ALBERT VARGAS ABSALON', '2021-02-02', 'MOST REV. MYLO HUBERT C. VERGARA, D.D'),
(7, 'REV. FR. JOHN MICHAEL GALLA MALLANAO', '2023-11-27', 'MOST REV. MYLO HUBERT C. VERGARA, D.D'),
(8, 'REV. FR. RODIFEL GARCIA DE LEON', '2023-11-27', 'MOST REV. MYLO HUBERT C. VERGARA, D.D'),
(9, 'REV. FR. CEDRIC MACATIMPAG MIRALLES', '2023-11-27', 'MOST REV. MYLO HUBERT C. VERGARA, D.D');

-- --------------------------------------------------------

--
-- Table structure for table `parish immaculate`
--

CREATE TABLE `parish immaculate` (
  `PARISH` varchar(100) NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

--
-- Dumping data for table `parish immaculate`
--

INSERT INTO `parish immaculate` (`PARISH`) VALUES
('STA. ROSA DE LIMA PARISH, BAGONG-ILOG, PASIG CITY'),
('IMMACULATE CONCEPTION CATHEDRAL-PARISH, MALINAO, PASIG CITY'),
('SAN GUILLERMO PARISH, BUTING, PASIG CITY'),
('HOLY FAMILY PARISH, KAPITOLYO, PASIG CITY'),
('SAN AGUSTIN PARISH, PALATIW, PASIG CITY'),
('SAN ANTONIO ABAD PARISH, MAYBUNGA, PASIG CITY'),
('SAN SEBASTIAN PARISH, PINAGBUHATAN, PASIG CITY'),
('SANTA CLARA DE MONTEFALCO PARISH, CANIOGAN, PASIG CITY'),
('SANTA MARTHA PARISH, KALAWAAN, PASIG CITY'),
('IMMACULATE CONCEPTION CATHEDRAL-PARISH, MALINAO, PASIG CITY'),
('SAN GUILLERMO PARISH, BUTING, PASIG CITY'),
('HOLY FAMILY PARISH, KAPITOLYO, PASIG CITY'),
('SAN AGUSTIN PARISH, PALATIW, PASIG CITY'),
('SAN ANTONIO ABAD PARISH, MAYBUNGA, PASIG CITY'),
('SAN SEBASTIAN PARISH, PINAGBUHATAN, PASIG CITY'),
('SANTA CLARA DE MONTEFALCO PARISH, CANIOGAN, PASIG CITY'),
('SANTA MARTHA PARISH, KALAWAAN, PASIG CITY');

-- --------------------------------------------------------

--
-- Table structure for table `parish st anne`
--

CREATE TABLE `parish st anne` (
  `PARISH` varchar(100) NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

--
-- Dumping data for table `parish st anne`
--

INSERT INTO `parish st anne` (`PARISH`) VALUES
(''),
(''),
(''),
('ST. IGNATIUS OF LOYOLA PARISH, USUSAN, TAGUIG CITY'),
('MINOR BASILICA AND ARCHDIOCESAN SHRINE OF ST. ANNE, STA. ANA, TAGUIG CITY'),
('DIOCESAN SHRINE OF STA. MARTA, PARISH OF SAN ROQUE, POBLACION, PATEROS, METRO MANILA'),
('ST. MICHAEL THE ARCHANGEL PARISH, HAGONOY, TAGUIG CITY'),
('ST. JOHN THE BAPTIST PARISH (DAMBANANG KAWAYAN), LIGID-TIPAS, TAGUIG CITY '),
('ST. PETER THE FISHERMAN PARISH, NAPINDAN, TAGUIG CITY');

-- --------------------------------------------------------

--
-- Table structure for table `parish sto nino`
--

CREATE TABLE `parish sto nino` (
  `PARISH` varchar(100) NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

--
-- Dumping data for table `parish sto nino`
--

INSERT INTO `parish sto nino` (`PARISH`) VALUES
('ST. MICHAEL THE ARCHANGEL PARISH, BGC, TAGUIG CITY'),
('STO. NINO DE TAGUIG PARISH, NORTH SIGNAL VILLAGE, TAGUIG CITY'),
('INA NG MGA DUKHA PARISH, WESTERN BICUTAN, TAGUIG CITY'),
('MARIA, REYNA NG MGA APOSTOL PARISH, PINAGSAMA, TAGUIG CITY'),
('OUR LADY OF THE MOST HOLY ROSARY PARISH, OLD LOWER BICUTAN, TAGUIG CITY'),
('ST. JOSEPH PARISH, UPPER BICUTAN TAGUIG CITY'),
('SAGRADA FAMILIA PARISH, BAGUMBAYAN, TAGUIG CITY'),
('OUR MOTHER OF PERPETUAL HELP PARISH, BAGONG TANYAG, TAGUIG CITY'),
('SAN VICENTE FERRER PARISH, PINAGSAMA, TAGUIG CITY'),
('STO. NINO DE TAGUIG PARISH, NORTH SIGNAL VILLAGE, TAGUIG CITY'),
('INA NG MGA DUKHA PARISH, WESTERN BICUTAN, TAGUIG CITY'),
('MARIA, REYNA NG MGA APOSTOL PARISH, PINAGSAMA, TAGUIG CITY'),
('OUR LADY OF THE MOST HOLY ROSARY PARISH, OLD LOWER BICUTAN, TAGUIG CITY'),
('ST. JOSEPH PARISH, UPPER BICUTAN TAGUIG CITY'),
('SAGRADA FAMILIA PARISH, BAGUMBAYAN, TAGUIG CITY'),
('OUR MOTHER OF PERPETUAL HELP PARISH, BAGONG TANYAG, TAGUIG CITY'),
('SAN VICENTE FERRER PARISH, PINAGSAMA, TAGUIG CITY');

-- --------------------------------------------------------

--
-- Table structure for table `parish sto tomas`
--

CREATE TABLE `parish sto tomas` (
  `PARISH` varchar(100) NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

--
-- Dumping data for table `parish sto tomas`
--

INSERT INTO `parish sto tomas` (`PARISH`) VALUES
('STO. ROSARIO DE PASIG PARISH, ROSARIO, PASIG CITY'),
('STO. TOMAS DE VILLANUEVA, SANTOLAN, PASIG CITY'),
('IMMACULATE CONCEPTION PARISH, KARANGALAN VILLAGE, PASIG CITY'),
('STA. LUCIA PARISH, MANGGAHAN, PASIG CITY'),
('STO. NINO DE PASIG PARISH, MANGGAHAN, PASIG'),
('ST. JUDE THADDEUS PARISH, STA. LUCIA, PASIG CITY'),
('STO. TOMAS DE VILLANUEVA, SANTOLAN, PASIG CITY'),
('IMMACULATE CONCEPTION PARISH, KARANGALAN VILLAGE, PASIG CITY'),
('STA. LUCIA PARISH, MANGGAHAN, PASIG CITY'),
('STO. NINO DE PASIG PARISH, MANGGAHAN, PASIG'),
('ST. JUDE THADDEUS PARISH, STA. LUCIA, PASIG CITY');

-- --------------------------------------------------------

--
-- Table structure for table `service_time_slots`
--

CREATE TABLE `service_time_slots` (
  `id` int(11) NOT NULL,
  `service_type` varchar(50) NOT NULL,
  `time_slot` time NOT NULL,
  `max_slots` int(11) NOT NULL DEFAULT 1,
  `is_active` tinyint(1) NOT NULL DEFAULT 1,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `service_time_slots`
--

INSERT INTO `service_time_slots` (`id`, `service_type`, `time_slot`, `max_slots`, `is_active`, `created_at`) VALUES
(1, 'Wedding', '10:00:00', 1, 1, '2025-02-18 11:26:36'),
(2, 'Wedding', '13:30:00', 1, 1, '2025-02-18 11:26:36'),
(3, 'Wedding', '15:30:00', 1, 1, '2025-02-18 11:26:36'),
(4, 'Baptismal', '08:00:00', 10, 1, '2025-02-18 11:26:36'),
(5, 'Baptismal', '11:30:00', 10, 1, '2025-02-18 11:26:36'),
(6, 'Funeral', '13:00:00', 3, 1, '2025-02-18 11:26:36'),
(7, 'Funeral', '14:00:00', 3, 1, '2025-02-18 11:26:36'),
(8, 'Funeral', '15:00:00', 3, 1, '2025-02-18 11:26:36');

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `id` int(13) NOT NULL,
  `first_name` varchar(100) NOT NULL,
  `middle_name` varchar(100) NOT NULL,
  `surname` varchar(100) NOT NULL,
  `suffix` varchar(10) DEFAULT NULL,
  `sex` tinyint(10) NOT NULL DEFAULT 0,
  `username` varchar(100) NOT NULL,
  `email` varchar(200) NOT NULL,
  `mobile_no` varchar(20) NOT NULL,
  `parish` tinyint(20) NOT NULL DEFAULT 0,
  `address` varchar(200) NOT NULL,
  `region_text` varchar(250) NOT NULL,
  `province_text` varchar(255) NOT NULL,
  `city_text` varchar(255) NOT NULL,
  `barangay_text` varchar(255) NOT NULL,
  `street_text` varchar(250) NOT NULL,
  `zip` varchar(250) NOT NULL,
  `password` varchar(200) NOT NULL,
  `role` tinyint(20) NOT NULL DEFAULT 0,
  `status` tinyint(1) NOT NULL,
  `created_at` datetime NOT NULL DEFAULT current_timestamp(),
  `updated_at` datetime NOT NULL DEFAULT current_timestamp(),
  `verification_code` text NOT NULL,
  `email_veification_at` datetime NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `first_name`, `middle_name`, `surname`, `suffix`, `sex`, `username`, `email`, `mobile_no`, `parish`, `address`, `region_text`, `province_text`, `city_text`, `barangay_text`, `street_text`, `zip`, `password`, `role`, `status`, `created_at`, `updated_at`, `verification_code`, `email_veification_at`) VALUES
(2, 'alliyah cher', 'o', 'villalobos', '', 0, 'alliyah27', 'villialobos@gmail.com', '1122334455', 0, 'philippines, san juan', '', '0', '0', '0', '', '', 'av123', 4, 0, '2024-08-29 23:36:24', '2024-09-18 23:04:39', '', '2024-10-11 08:00:37'),
(7, 'jez', 'reel', 'david', 'jr', 0, 'bucdevgin11', 'jez@gmail.com', '987654321', 0, 'oqhwdhwkjq', '', '0', '0', '0', '', '', 'red12345', 0, 0, '2024-09-19 15:47:25', '2024-09-19 15:47:25', '', '2024-10-11 08:00:37'),
(8, 'dummy', '1', 'account', 'js', 1, 'dummy1', 'dummy@gmail.com', '1424124215215', 0, 'philippines, mandaluyong city', '', '0', '0', '0', '', '', '12345', 3, 0, '2024-09-20 23:41:12', '2024-09-20 23:41:12', '', '2024-10-11 08:00:37'),
(21, 'alliyah', 'cher', 'villalobos', 'js', 1, 'av123', 'av@gmail.com', '09437086977', 1, 'philippines, mandaluyong city', 'Region III (Central Luzon)', 'Bataan', 'Dinalupihan', '', 'blk4 lot 25, caramoan st.', '1999', 'green345', 0, 0, '2024-09-26 18:34:05', '2024-09-26 18:34:05', '', '2024-10-11 08:00:37'),
(22, 'jan', 'fernan', 'bondad', 'jr', 0, 'bondad12345', 'bondad@gmail.com', '09437086977', 0, 'philippines, mandaluyong city', '', '', '', '', '', '', 'red12345', 1, 1, '2024-10-04 15:46:59', '2024-10-04 15:46:59', '', '2024-10-11 08:00:37'),
(23, 'dummy', 'account', '3', 'jr', 0, 'dummy3', 'jezreeldeniel@gmail.com', '09437086977', 3, '', 'National Capital Region (NCR)', 'City Of Manila', 'Intramuros', 'Barangay 655', 'blk4 lot 25, caramoan st.', '1999', 'dummy12345', 0, 0, '2024-10-11 08:31:50', '2024-10-11 08:31:50', '', '2024-10-11 08:31:50'),
(24, 'dummy', 'account', '4', 'jr', 0, 'dummy4', 'jezreeldavid@gmail.com', '09437086977', 3, '', 'National Capital Region (NCR)', 'City Of Manila', 'Intramuros', 'Barangay 655', 'blk4 lot 25, caramoan st.', '1999', 'dummy4', 0, 0, '2024-10-11 08:34:39', '2024-10-11 08:34:39', '', '2024-10-11 08:34:39'),
(25, 'dummy', 'account', '2', 'jr.', 0, 'dummyaccount2', 'dummyaccount@gmail.com', '1287421981', 0, '', 'National Capital Region (NCR)', 'City Of Manila', 'Intramuros', 'Barangay 655', 'hatdog st.', '21322', 'Green345', 0, 0, '2024-10-20 02:48:27', '2024-10-20 02:48:27', '', '2024-10-20 02:48:27'),
(26, 'Jan Fernan', 'Ignacio', 'Bondad', 'n/a', 0, 'Fernie1202', 'jinfernan1202@gmail.com', '09564150085', 0, '', 'National Capital Region (NCR)', 'Ncr, Fourth District', 'Taguig City', 'Ususan', '96 A NP CRUZ ST.', '1630', 'Bebeloves', 0, 0, '2024-10-22 14:08:25', '2024-10-22 14:08:25', '', '2024-10-22 14:08:25'),
(27, 'Alliyah Cher', 'Cruz', 'Villalobos', 'n/a', 1, 'Alliyah Cher', 'alliyahcher.villalobos@my.jru.edu', '09155924366', 1, '', 'National Capital Region (NCR)', 'Ncr, Second District', 'City Of San Juan', 'Pedro Cruz', 'J.Basa', '1500', 'Alliyah', 0, 0, '2024-10-29 06:34:56', '2024-10-29 06:34:56', '', '2024-10-29 06:34:56'),
(31, 'Yunho', 'Stephano', 'Jeong', 'Jr.', 0, 'Yunho', 'jeongyunho@gmail.com', '09925438335', 1, '', 'Region I (Ilocos Region)', 'Ilocos Sur', 'San Ildefonso', 'Gongogong', 'San Juan City', '1500', 'yunho', 0, 0, '2024-10-30 07:25:38', '2024-10-30 07:25:38', '', '2024-10-30 07:25:38'),
(32, 'Marvin', 'Guanzon', 'Marben', 'Mr.', 0, 'marben10', 'marvinjay.magante@my.jru.edu', '09353985231', 2, '', 'National Capital Region (NCR)', 'Ncr, Second District', 'City Of Pasig', 'Pinagbuhatan', 'M.H Del Pilar St.', '1603', 'b550uoqtbdgk', 0, 0, '2024-10-30 12:43:49', '2024-10-30 12:43:49', '', '2024-10-30 12:43:49'),
(33, 'Steven Tiu', 'Maligallig', 'Na pogi', 'Sr.', 0, 'Tiumami', 'steventiu@gmail.com', '1234567', 1, '', 'National Capital Region (NCR)', 'City Of Manila', 'Santa Ana', 'Barangay 793', 'hotdog', '1016', '38RN8htGw4QEpA2', 0, 0, '2024-10-31 17:46:21', '2024-10-31 17:46:21', '', '2024-10-31 17:46:21'),
(34, 'Jongo', 'Martin', 'Choi', 'n/a', 0, 'Choi_Jongho', 'nekohead1@gmail.com', '09155924366', 1, '', '', '', '', '', 'San Juan City', '1500', 'Jongho', 0, 0, '2024-11-12 13:56:38', '2024-11-12 13:56:38', '', '2024-11-12 13:56:38');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `baptism`
--
ALTER TABLE `baptism`
  ADD PRIMARY KEY (`baptism_record_id`);

--
-- Indexes for table `bookings`
--
ALTER TABLE `bookings`
  ADD PRIMARY KEY (`id`),
  ADD KEY `church_id` (`church_id`,`date`,`time_slot`),
  ADD KEY `service_type` (`service_type`);

--
-- Indexes for table `burial`
--
ALTER TABLE `burial`
  ADD PRIMARY KEY (`burial_record_id`);

--
-- Indexes for table `chatapp`
--
ALTER TABLE `chatapp`
  ADD PRIMARY KEY (`user_id`);

--
-- Indexes for table `matrimony`
--
ALTER TABLE `matrimony`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `ordination for priesthood`
--
ALTER TABLE `ordination for priesthood`
  ADD PRIMARY KEY (`serial_no`);

--
-- Indexes for table `service_time_slots`
--
ALTER TABLE `service_time_slots`
  ADD PRIMARY KEY (`id`),
  ADD KEY `service_type` (`service_type`,`time_slot`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `username` (`username`),
  ADD UNIQUE KEY `email` (`email`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `baptism`
--
ALTER TABLE `baptism`
  MODIFY `baptism_record_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `bookings`
--
ALTER TABLE `bookings`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `burial`
--
ALTER TABLE `burial`
  MODIFY `burial_record_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `chatapp`
--
ALTER TABLE `chatapp`
  MODIFY `user_id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `matrimony`
--
ALTER TABLE `matrimony`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `ordination for priesthood`
--
ALTER TABLE `ordination for priesthood`
  MODIFY `serial_no` int(20) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;

--
-- AUTO_INCREMENT for table `service_time_slots`
--
ALTER TABLE `service_time_slots`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` int(13) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=35;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
