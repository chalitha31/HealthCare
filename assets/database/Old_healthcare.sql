-- --------------------------------------------------------
-- Host:                         127.0.0.1
-- Server version:               8.0.26 - MySQL Community Server - GPL
-- Server OS:                    Win64
-- HeidiSQL Version:             12.5.0.6677
-- --------------------------------------------------------

/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET NAMES utf8 */;
/*!50503 SET NAMES utf8 */;
/*!40103 SET @OLD_TIME_ZONE=@@TIME_ZONE */;
/*!40103 SET TIME_ZONE='+00:00' */;
/*!40014 SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0 */;
/*!40101 SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='NO_AUTO_VALUE_ON_ZERO' */;
/*!40111 SET @OLD_SQL_NOTES=@@SQL_NOTES, SQL_NOTES=0 */;


-- Dumping database structure for healthcare
CREATE DATABASE IF NOT EXISTS `healthcare` /*!40100 DEFAULT CHARACTER SET utf8 COLLATE utf8_general_ci */ /*!80016 DEFAULT ENCRYPTION='N' */;
USE `healthcare`;

-- Dumping structure for table healthcare.admin
CREATE TABLE IF NOT EXISTS `admin` (
  `id` int NOT NULL AUTO_INCREMENT,
  `name` varchar(50) DEFAULT NULL,
  `password` varchar(200) DEFAULT NULL,
  `mobile` varchar(50) DEFAULT NULL,
  `email` varchar(50) DEFAULT NULL,
  `status` int DEFAULT '1',
  PRIMARY KEY (`id`),
  KEY `FK_admin_status_type` (`status`),
  CONSTRAINT `FK_admin_status_type` FOREIGN KEY (`status`) REFERENCES `status_type` (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8;

-- Dumping data for table healthcare.admin: ~1 rows (approximately)
INSERT INTO `admin` (`id`, `name`, `password`, `mobile`, `email`, `status`) VALUES
	(1, 'admin', '03ac674216f3e15c761ee1a5e255f067953623c8b388b4459e13f978d7c846f4', '0716589563', 'admin@gmail.com', 1);

-- Dumping structure for table healthcare.bloodtest
CREATE TABLE IF NOT EXISTS `bloodtest` (
  `id` int NOT NULL AUTO_INCREMENT,
  `patientDetails_id` int DEFAULT NULL,
  `reportName` varchar(150) DEFAULT NULL,
  `test_type` varchar(50) DEFAULT NULL,
  `issued_Date` datetime DEFAULT NULL,
  `mlt_id` varchar(50) DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `FK_bloodtest_patients_details` (`patientDetails_id`),
  CONSTRAINT `FK_bloodtest_patients_details` FOREIGN KEY (`patientDetails_id`) REFERENCES `patients_details` (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- Dumping data for table healthcare.bloodtest: ~0 rows (approximately)

-- Dumping structure for table healthcare.medicines
CREATE TABLE IF NOT EXISTS `medicines` (
  `id` int NOT NULL AUTO_INCREMENT,
  `name` varchar(50) DEFAULT NULL,
  `brand` varchar(50) DEFAULT NULL,
  `quantity` int DEFAULT NULL,
  `exp` date DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=10 DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci;

-- Dumping data for table healthcare.medicines: ~9 rows (approximately)
INSERT INTO `medicines` (`id`, `name`, `brand`, `quantity`, `exp`) VALUES
	(1, 'Zithrocin', 'Zetra pvt ltd', 9800, '2025-02-28'),
	(2, 'Paracetamol', 'ABC Pharma', 362, '2024-10-24'),
	(3, 'Amoxicillin', 'Amox pvt', 439, '2024-03-18'),
	(4, 'Aspirin', 'Aspirin', 3543, '2026-07-03'),
	(5, 'zithrocin', 'Zetra pvt ltd', 47, '2024-07-06'),
	(6, 'pirition', 'zetra pvt ltd', 500, '2024-08-28'),
	(7, 'Acetaminophen', 'Ace pvt', 0, '2025-06-23'),
	(8, 'Calcium', 'ABC PVT LTD', 0, '2024-07-24'),
	(9, 'Dopamine', 'Dop Company', 4, '2024-04-07');

-- Dumping structure for table healthcare.medicines_recode
CREATE TABLE IF NOT EXISTS `medicines_recode` (
  `id` int NOT NULL AUTO_INCREMENT,
  `patientDetails_id` int DEFAULT NULL,
  `medicine_id` int DEFAULT NULL,
  `qty` int DEFAULT NULL,
  `date` date DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `FK__patients_details` (`patientDetails_id`),
  KEY `FK__medicines` (`medicine_id`),
  CONSTRAINT `FK__medicines` FOREIGN KEY (`medicine_id`) REFERENCES `medicines` (`id`),
  CONSTRAINT `FK__patients_details` FOREIGN KEY (`patientDetails_id`) REFERENCES `patients_details` (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci;

-- Dumping data for table healthcare.medicines_recode: ~0 rows (approximately)

-- Dumping structure for table healthcare.mlt_equipments
CREATE TABLE IF NOT EXISTS `mlt_equipments` (
  `id` int NOT NULL AUTO_INCREMENT,
  `name` varchar(100) DEFAULT NULL,
  `quantity` int DEFAULT NULL,
  `weekly` int DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=8 DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci;

-- Dumping data for table healthcare.mlt_equipments: ~7 rows (approximately)
INSERT INTO `mlt_equipments` (`id`, `name`, `quantity`, `weekly`) VALUES
	(1, 'Blood collection tubes', 50, 6),
	(2, 'Latex gloves', 150, 10),
	(3, 'Urine collection cups', 25, 12),
	(4, 'Sterile syringes', 496, 39),
	(5, 'Hypodermic needles', 33, 1),
	(6, 'EDTA tubes (lavender top)', 2, 6),
	(7, 'Sterile gauze pads', 96, 26);

-- Dumping structure for table healthcare.patients_details
CREATE TABLE IF NOT EXISTS `patients_details` (
  `id` int NOT NULL AUTO_INCREMENT,
  `patients_id` int DEFAULT NULL,
  `age` int DEFAULT NULL,
  `reception_id` varchar(50) CHARACTER SET utf8 COLLATE utf8_general_ci DEFAULT NULL,
  `symptoms` text CHARACTER SET utf8 COLLATE utf8_general_ci,
  `medical_report` text CHARACTER SET utf8 COLLATE utf8_general_ci,
  `Prescriptions` text CHARACTER SET utf8 COLLATE utf8_general_ci,
  `Prescriptions_date` datetime DEFAULT NULL,
  `doctor_id` varchar(50) CHARACTER SET utf8 COLLATE utf8_general_ci DEFAULT NULL,
  `symptoms_date` datetime DEFAULT NULL,
  `medicine_status` varchar(50) CHARACTER SET utf8 COLLATE utf8_general_ci DEFAULT 'pending',
  PRIMARY KEY (`id`),
  KEY `FK_patients_details_register_patients` (`patients_id`),
  KEY `FK_patients_details_register_reception` (`reception_id`),
  KEY `FK_patients_details_registered_doctor` (`doctor_id`),
  CONSTRAINT `FK_patients_details_register_patients` FOREIGN KEY (`patients_id`) REFERENCES `registered_patients` (`p_id`),
  CONSTRAINT `FK_patients_details_register_reception` FOREIGN KEY (`reception_id`) REFERENCES `registered_reception` (`id_num`),
  CONSTRAINT `FK_patients_details_registered_doctor` FOREIGN KEY (`doctor_id`) REFERENCES `registered_doctor` (`id_num`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- Dumping data for table healthcare.patients_details: ~0 rows (approximately)

-- Dumping structure for table healthcare.registered_doctor
CREATE TABLE IF NOT EXISTS `registered_doctor` (
  `id_num` varchar(50) CHARACTER SET utf8 COLLATE utf8_general_ci NOT NULL,
  `name` varchar(50) CHARACTER SET utf8 COLLATE utf8_general_ci DEFAULT NULL,
  `email` varchar(50) CHARACTER SET utf8 COLLATE utf8_general_ci DEFAULT NULL,
  `mobile` varchar(50) CHARACTER SET utf8 COLLATE utf8_general_ci DEFAULT NULL,
  `password` varchar(200) CHARACTER SET utf8 COLLATE utf8_general_ci DEFAULT NULL,
  `verification_code` varchar(50) CHARACTER SET utf8 COLLATE utf8_general_ci DEFAULT NULL,
  `register_date` datetime DEFAULT NULL,
  `status` int DEFAULT '1',
  `age` int DEFAULT NULL,
  `address` text CHARACTER SET utf8 COLLATE utf8_general_ci,
  `image` varchar(100) CHARACTER SET utf8 COLLATE utf8_general_ci DEFAULT NULL,
  PRIMARY KEY (`id_num`) USING BTREE,
  KEY `FK_registered_doctor_ststus_type` (`status`),
  CONSTRAINT `FK_registered_doctor_ststus_type` FOREIGN KEY (`status`) REFERENCES `status_type` (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- Dumping data for table healthcare.registered_doctor: ~1 rows (approximately)
INSERT INTO `registered_doctor` (`id_num`, `name`, `email`, `mobile`, `password`, `verification_code`, `register_date`, `status`, `age`, `address`, `image`) VALUES
	('0000000000', 'none', 'none', 'none', NULL, NULL, '2024-06-17 00:38:59', 1, NULL, NULL, NULL);

-- Dumping structure for table healthcare.registered_mlt
CREATE TABLE IF NOT EXISTS `registered_mlt` (
  `id_num` varchar(50) CHARACTER SET utf8 COLLATE utf8_general_ci NOT NULL,
  `name` varchar(50) CHARACTER SET utf8 COLLATE utf8_general_ci DEFAULT NULL,
  `email` varchar(50) CHARACTER SET utf8 COLLATE utf8_general_ci DEFAULT NULL,
  `mobile` varchar(50) CHARACTER SET utf8 COLLATE utf8_general_ci DEFAULT NULL,
  `password` varchar(200) CHARACTER SET utf8 COLLATE utf8_general_ci DEFAULT NULL,
  `verification_code` varchar(50) CHARACTER SET utf8 COLLATE utf8_general_ci DEFAULT NULL,
  `register_date` datetime DEFAULT NULL,
  `status` int DEFAULT '1',
  `age` int DEFAULT NULL,
  `address` varchar(50) DEFAULT NULL,
  `image` varchar(100) DEFAULT NULL,
  PRIMARY KEY (`id_num`) USING BTREE,
  KEY `FK_mlt_status_type` (`status`) USING BTREE,
  CONSTRAINT `FK_mlt_status_type` FOREIGN KEY (`status`) REFERENCES `status_type` (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- Dumping data for table healthcare.registered_mlt: ~0 rows (approximately)

-- Dumping structure for table healthcare.registered_patients
CREATE TABLE IF NOT EXISTS `registered_patients` (
  `p_id` int NOT NULL AUTO_INCREMENT,
  `name` varchar(50) CHARACTER SET utf8 COLLATE utf8_general_ci DEFAULT NULL,
  `mobile` varchar(12) CHARACTER SET utf8 COLLATE utf8_general_ci DEFAULT NULL,
  `email` varchar(50) CHARACTER SET utf8 COLLATE utf8_general_ci DEFAULT NULL,
  `id_num` varchar(20) CHARACTER SET utf8 COLLATE utf8_general_ci DEFAULT NULL,
  `address` text CHARACTER SET utf8 COLLATE utf8_general_ci,
  `age` int DEFAULT NULL,
  `register_date` datetime DEFAULT NULL,
  `reception_id` varchar(50) CHARACTER SET utf8 COLLATE utf8_general_ci DEFAULT NULL,
  PRIMARY KEY (`p_id`),
  KEY `FK_register_patients_register_reception` (`reception_id`),
  CONSTRAINT `FK_register_patients_register_reception` FOREIGN KEY (`reception_id`) REFERENCES `registered_reception` (`id_num`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- Dumping data for table healthcare.registered_patients: ~0 rows (approximately)

-- Dumping structure for table healthcare.registered_pharmacists
CREATE TABLE IF NOT EXISTS `registered_pharmacists` (
  `id_num` varchar(50) CHARACTER SET utf8 COLLATE utf8_general_ci NOT NULL,
  `name` varchar(50) CHARACTER SET utf8 COLLATE utf8_general_ci DEFAULT NULL,
  `email` varchar(50) CHARACTER SET utf8 COLLATE utf8_general_ci DEFAULT NULL,
  `mobile` varchar(50) CHARACTER SET utf8 COLLATE utf8_general_ci DEFAULT NULL,
  `password` varchar(200) CHARACTER SET utf8 COLLATE utf8_general_ci DEFAULT NULL,
  `verification_code` varchar(50) CHARACTER SET utf8 COLLATE utf8_general_ci DEFAULT NULL,
  `register_date` datetime DEFAULT NULL,
  `status` int DEFAULT '1',
  `age` int DEFAULT NULL,
  `address` text,
  `image` varchar(100) DEFAULT NULL,
  PRIMARY KEY (`id_num`) USING BTREE,
  KEY `FK_registered_pharmacists_status_type` (`status`),
  CONSTRAINT `FK_registered_pharmacists_status_type` FOREIGN KEY (`status`) REFERENCES `status_type` (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- Dumping data for table healthcare.registered_pharmacists: ~0 rows (approximately)

-- Dumping structure for table healthcare.registered_reception
CREATE TABLE IF NOT EXISTS `registered_reception` (
  `id_num` varchar(50) CHARACTER SET utf8 COLLATE utf8_general_ci NOT NULL,
  `address` text CHARACTER SET utf8 COLLATE utf8_general_ci,
  `name` varchar(50) CHARACTER SET utf8 COLLATE utf8_general_ci DEFAULT NULL,
  `email` varchar(50) CHARACTER SET utf8 COLLATE utf8_general_ci DEFAULT NULL,
  `mobile` varchar(50) CHARACTER SET utf8 COLLATE utf8_general_ci DEFAULT NULL,
  `password` varchar(200) CHARACTER SET utf8 COLLATE utf8_general_ci DEFAULT NULL,
  `verification_code` varchar(50) CHARACTER SET utf8 COLLATE utf8_general_ci DEFAULT NULL,
  `register_date` datetime DEFAULT NULL,
  `image` varchar(100) CHARACTER SET utf8 COLLATE utf8_general_ci DEFAULT NULL,
  `status` int DEFAULT '1',
  `age` int DEFAULT NULL,
  PRIMARY KEY (`id_num`),
  KEY `FK_registered_reception_status_type` (`status`),
  CONSTRAINT `FK_registered_reception_status_type` FOREIGN KEY (`status`) REFERENCES `status_type` (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- Dumping data for table healthcare.registered_reception: ~0 rows (approximately)

-- Dumping structure for table healthcare.status_type
CREATE TABLE IF NOT EXISTS `status_type` (
  `id` int NOT NULL AUTO_INCREMENT,
  `name` varchar(50) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=utf8;

-- Dumping data for table healthcare.status_type: ~2 rows (approximately)
INSERT INTO `status_type` (`id`, `name`) VALUES
	(1, 'Allow'),
	(2, 'block');

-- Dumping structure for table healthcare.user
CREATE TABLE IF NOT EXISTS `user` (
  `fname` varchar(50) DEFAULT NULL,
  `lname` varchar(50) DEFAULT NULL,
  `email` varchar(50) NOT NULL,
  `password` varchar(200) CHARACTER SET utf8 COLLATE utf8_general_ci DEFAULT NULL,
  `register_Date` datetime DEFAULT NULL,
  `mobile` varchar(12) DEFAULT NULL,
  `status` int DEFAULT '1',
  PRIMARY KEY (`email`),
  KEY `FK_user_status_type` (`status`),
  CONSTRAINT `FK_user_status_type` FOREIGN KEY (`status`) REFERENCES `status_type` (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- Dumping data for table healthcare.user: ~0 rows (approximately)

/*!40103 SET TIME_ZONE=IFNULL(@OLD_TIME_ZONE, 'system') */;
/*!40101 SET SQL_MODE=IFNULL(@OLD_SQL_MODE, '') */;
/*!40014 SET FOREIGN_KEY_CHECKS=IFNULL(@OLD_FOREIGN_KEY_CHECKS, 1) */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40111 SET SQL_NOTES=IFNULL(@OLD_SQL_NOTES, 1) */;
