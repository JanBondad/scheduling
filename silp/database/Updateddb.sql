-- MySQL dump 10.13  Distrib 8.0.34, for Win64 (x86_64)
--
-- Host: localhost    Database: scheddb
-- ------------------------------------------------------
-- Server version	8.0.27

/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!50503 SET NAMES utf8 */;
/*!40103 SET @OLD_TIME_ZONE=@@TIME_ZONE */;
/*!40103 SET TIME_ZONE='+00:00' */;
/*!40014 SET @OLD_UNIQUE_CHECKS=@@UNIQUE_CHECKS, UNIQUE_CHECKS=0 */;
/*!40014 SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0 */;
/*!40101 SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='NO_AUTO_VALUE_ON_ZERO' */;
/*!40111 SET @OLD_SQL_NOTES=@@SQL_NOTES, SQL_NOTES=0 */;

--
-- Table structure for table `audit trail`
--

DROP TABLE IF EXISTS `audit trail`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `audit trail` (
  `date` date NOT NULL,
  `user` varchar(30) NOT NULL,
  `email` varchar(100) NOT NULL,
  `time_in` datetime NOT NULL,
  `time_out` datetime NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Table structure for table `baptism`
--

DROP TABLE IF EXISTS `baptism`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `baptism` (
  `baptism_record_id` int NOT NULL AUTO_INCREMENT,
  `catechumen_fname` varchar(100) COLLATE utf8mb4_unicode_ci NOT NULL,
  `catechumen_mname` varchar(100) COLLATE utf8mb4_unicode_ci NOT NULL,
  `catechumen_lname` varchar(100) COLLATE utf8mb4_unicode_ci NOT NULL,
  `date_of_birth` varchar(100) COLLATE utf8mb4_unicode_ci NOT NULL,
  `place_of_birth` varchar(100) COLLATE utf8mb4_unicode_ci NOT NULL,
  `nationality` varchar(100) COLLATE utf8mb4_unicode_ci NOT NULL,
  `father_fname` varchar(100) COLLATE utf8mb4_unicode_ci NOT NULL,
  `father_mname` varchar(100) COLLATE utf8mb4_unicode_ci NOT NULL,
  `father_lname` varchar(100) COLLATE utf8mb4_unicode_ci NOT NULL,
  `father_placeofbirth` varchar(100) COLLATE utf8mb4_unicode_ci NOT NULL,
  `father_address` varchar(100) COLLATE utf8mb4_unicode_ci NOT NULL,
  `father_civilstatus` varchar(50) COLLATE utf8mb4_unicode_ci NOT NULL,
  `mother_fname` varchar(100) COLLATE utf8mb4_unicode_ci NOT NULL,
  `mother_mname` varchar(100) COLLATE utf8mb4_unicode_ci NOT NULL,
  `mother_lname` varchar(100) COLLATE utf8mb4_unicode_ci NOT NULL,
  `mother_placeofbirth` varchar(100) COLLATE utf8mb4_unicode_ci NOT NULL,
  `mother_address` varchar(100) COLLATE utf8mb4_unicode_ci NOT NULL,
  `mother_civilstatus` varchar(50) COLLATE utf8mb4_unicode_ci NOT NULL,
  `p_sponsor(male)` varchar(100) COLLATE utf8mb4_unicode_ci NOT NULL,
  `p_sponsor(female)` varchar(100) COLLATE utf8mb4_unicode_ci NOT NULL,
  `sponsor_three` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `sponsor_four` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `sponsor_five` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `sponsor_six` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `sponsor_seven` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `sponsor_eight` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `date_time` varchar(100) COLLATE utf8mb4_unicode_ci NOT NULL,
  `place_of_baptism` varchar(100) COLLATE utf8mb4_unicode_ci NOT NULL,
  `priest` varchar(100) COLLATE utf8mb4_unicode_ci NOT NULL,
  `email` varchar(100) COLLATE utf8mb4_unicode_ci NOT NULL,
  `contact_no` int NOT NULL,
  `sched_type` varchar(50) COLLATE utf8mb4_unicode_ci NOT NULL,
  `reserver_name` varchar(100) COLLATE utf8mb4_unicode_ci NOT NULL,
  `birth_cert` longblob,
  PRIMARY KEY (`baptism_record_id`)
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Table structure for table `bookings`
--

DROP TABLE IF EXISTS `bookings`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `bookings` (
  `id` int NOT NULL,
  `church_id` int NOT NULL,
  `service_type` varchar(50) COLLATE utf8mb4_general_ci NOT NULL,
  `date` date NOT NULL,
  `time_slot` time NOT NULL,
  `status` varchar(20) COLLATE utf8mb4_general_ci DEFAULT 'pending',
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`),
  KEY `church_id` (`church_id`,`date`,`time_slot`),
  KEY `service_type` (`service_type`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Table structure for table `burial`
--

DROP TABLE IF EXISTS `burial`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `burial` (
  `burial_record_id` int NOT NULL AUTO_INCREMENT,
  `full_name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `age` int NOT NULL,
  `date_of_death` varchar(100) COLLATE utf8mb4_unicode_ci NOT NULL,
  `funeral_date` varchar(100) COLLATE utf8mb4_unicode_ci NOT NULL,
  `parish` varchar(100) COLLATE utf8mb4_unicode_ci NOT NULL,
  `funeral_location` varchar(100) COLLATE utf8mb4_unicode_ci NOT NULL,
  `reserver_name` varchar(100) COLLATE utf8mb4_unicode_ci NOT NULL,
  `email` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `contact_no` varchar(10) COLLATE utf8mb4_unicode_ci NOT NULL,
  `death_certificate` longblob NOT NULL,
  PRIMARY KEY (`burial_record_id`)
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Table structure for table `chatapp`
--

DROP TABLE IF EXISTS `chatapp`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `chatapp` (
  `user_id` int NOT NULL,
  `unique_id` int NOT NULL,
  `fname` varchar(255) NOT NULL,
  `lname` varchar(255) NOT NULL,
  `email` varchar(255) NOT NULL,
  `password` varchar(255) NOT NULL,
  `img` varchar(255) NOT NULL,
  `status` varchar(255) NOT NULL,
  PRIMARY KEY (`user_id`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Table structure for table `matrimony`
--

DROP TABLE IF EXISTS `matrimony`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `matrimony` (
  `id` int NOT NULL AUTO_INCREMENT,
  `groom_name` varchar(255) COLLATE utf8mb4_general_ci NOT NULL,
  `bride_name` varchar(255) COLLATE utf8mb4_general_ci NOT NULL,
  `dob_groom` varchar(100) COLLATE utf8mb4_general_ci NOT NULL,
  `dob_bride` varchar(100) COLLATE utf8mb4_general_ci NOT NULL,
  `pob_groom` varchar(255) COLLATE utf8mb4_general_ci NOT NULL,
  `pob_bride` varchar(255) COLLATE utf8mb4_general_ci NOT NULL,
  `address_groom` varchar(255) COLLATE utf8mb4_general_ci NOT NULL,
  `address_bride` varchar(255) COLLATE utf8mb4_general_ci NOT NULL,
  `religion_groom` varchar(100) COLLATE utf8mb4_general_ci NOT NULL,
  `religion_bride` varchar(100) COLLATE utf8mb4_general_ci NOT NULL,
  `fathername_groom` varchar(255) COLLATE utf8mb4_general_ci NOT NULL,
  `fathername_bride` varchar(255) COLLATE utf8mb4_general_ci NOT NULL,
  `mothername_groom` varchar(255) COLLATE utf8mb4_general_ci NOT NULL,
  `mothername_bride` varchar(255) COLLATE utf8mb4_general_ci NOT NULL,
  `witness_male` varchar(255) COLLATE utf8mb4_general_ci NOT NULL,
  `witness_female` varchar(255) COLLATE utf8mb4_general_ci NOT NULL,
  `relation_male` varchar(100) COLLATE utf8mb4_general_ci NOT NULL,
  `relation_female` varchar(100) COLLATE utf8mb4_general_ci NOT NULL,
  `baptismal_groom` longblob,
  `confirmation_groom` varchar(255) COLLATE utf8mb4_general_ci DEFAULT NULL,
  `birthcert_groom` longblob,
  `baptismal_bride` longblob,
  `confirmation_bride` longblob,
  `birthcert_bride` longblob,
  `reserve_name` varchar(255) COLLATE utf8mb4_general_ci NOT NULL,
  `email` varchar(255) COLLATE utf8mb4_general_ci NOT NULL,
  `phone_number` varchar(20) COLLATE utf8mb4_general_ci NOT NULL,
  `no_of_guest` int DEFAULT '0',
  `parish` varchar(255) COLLATE utf8mb4_general_ci NOT NULL,
  `priest` varchar(100) COLLATE utf8mb4_general_ci NOT NULL,
  `date_time` datetime NOT NULL,
  `event_type` enum('Regular','Special (Kasalang Bayan)','Wedding','Other') COLLATE utf8mb4_general_ci DEFAULT NULL,
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=5 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Table structure for table `ordination for priesthood`
--

DROP TABLE IF EXISTS `ordination for priesthood`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `ordination for priesthood` (
  `serial_no` int NOT NULL,
  `name_of_ordinandi` varchar(100) NOT NULL,
  `date_of_ordination` date NOT NULL,
  `consecrator` varchar(100) NOT NULL,
  PRIMARY KEY (`serial_no`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Table structure for table `parish immaculate`
--

DROP TABLE IF EXISTS `parish immaculate`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `parish immaculate` (
  `PARISH` varchar(100) NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Table structure for table `parish st anne`
--

DROP TABLE IF EXISTS `parish st anne`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `parish st anne` (
  `PARISH` varchar(100) NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Table structure for table `parish sto nino`
--

DROP TABLE IF EXISTS `parish sto nino`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `parish sto nino` (
  `PARISH` varchar(100) NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Table structure for table `parish sto tomas`
--

DROP TABLE IF EXISTS `parish sto tomas`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `parish sto tomas` (
  `PARISH` varchar(100) NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Table structure for table `service_time_slots`
--

DROP TABLE IF EXISTS `service_time_slots`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `service_time_slots` (
  `id` int NOT NULL,
  `service_type` varchar(50) COLLATE utf8mb4_general_ci NOT NULL,
  `time_slot` time NOT NULL,
  `max_slots` int NOT NULL DEFAULT '1',
  `is_active` tinyint(1) NOT NULL DEFAULT '1',
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`),
  KEY `service_type` (`service_type`,`time_slot`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Table structure for table `users`
--

DROP TABLE IF EXISTS `users`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `users` (
  `id` int NOT NULL,
  `first_name` varchar(100) COLLATE utf8mb4_general_ci NOT NULL,
  `middle_name` varchar(100) COLLATE utf8mb4_general_ci NOT NULL,
  `surname` varchar(100) COLLATE utf8mb4_general_ci NOT NULL,
  `suffix` varchar(10) COLLATE utf8mb4_general_ci DEFAULT NULL,
  `sex` tinyint NOT NULL DEFAULT '0',
  `username` varchar(100) COLLATE utf8mb4_general_ci NOT NULL,
  `email` varchar(200) COLLATE utf8mb4_general_ci NOT NULL,
  `mobile_no` varchar(20) COLLATE utf8mb4_general_ci NOT NULL,
  `parish` tinyint NOT NULL DEFAULT '0',
  `address` varchar(200) COLLATE utf8mb4_general_ci NOT NULL,
  `region_text` varchar(250) COLLATE utf8mb4_general_ci NOT NULL,
  `province_text` varchar(255) COLLATE utf8mb4_general_ci NOT NULL,
  `city_text` varchar(255) COLLATE utf8mb4_general_ci NOT NULL,
  `barangay_text` varchar(255) COLLATE utf8mb4_general_ci NOT NULL,
  `street_text` varchar(250) COLLATE utf8mb4_general_ci NOT NULL,
  `zip` varchar(250) COLLATE utf8mb4_general_ci NOT NULL,
  `password` varchar(200) COLLATE utf8mb4_general_ci NOT NULL,
  `role` tinyint NOT NULL DEFAULT '0',
  `status` tinyint(1) NOT NULL,
  `created_at` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `updated_at` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `verification_code` text COLLATE utf8mb4_general_ci NOT NULL,
  `email_veification_at` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;
/*!40101 SET character_set_client = @saved_cs_client */;
/*!40103 SET TIME_ZONE=@OLD_TIME_ZONE */;

/*!40101 SET SQL_MODE=@OLD_SQL_MODE */;
/*!40014 SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS */;
/*!40014 SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
/*!40111 SET SQL_NOTES=@OLD_SQL_NOTES */;

-- Dump completed on 2025-02-22 15:41:52
