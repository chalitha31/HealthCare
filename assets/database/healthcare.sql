-- --------------------------------------------------------
-- Host:                         127.0.0.1
-- Server version:               8.0.26 - MySQL Community Server - GPL
-- Server OS:                    Win64
-- HeidiSQL Version:             12.5.0.6677
-- --------------------------------------------------------

/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET NAMES utf8 */;
/*!50503 SET NAMES utf8mb4 */;
/*!40103 SET @OLD_TIME_ZONE=@@TIME_ZONE */;
/*!40103 SET TIME_ZONE='+00:00' */;
/*!40014 SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0 */;
/*!40101 SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='NO_AUTO_VALUE_ON_ZERO' */;
/*!40111 SET @OLD_SQL_NOTES=@@SQL_NOTES, SQL_NOTES=0 */;


-- Dumping database structure for healthcare
CREATE DATABASE IF NOT EXISTS `healthcare` /*!40100 DEFAULT CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci */ /*!80016 DEFAULT ENCRYPTION='N' */;
USE `healthcare`;

-- Dumping structure for table healthcare.patients_details
CREATE TABLE IF NOT EXISTS `patients_details` (
  `id` int NOT NULL AUTO_INCREMENT,
  `patients_id` int DEFAULT NULL,
  `reception_id` varchar(50) DEFAULT NULL,
  `symptoms` text,
  `Prescriptions` text,
  `doctor_id` varchar(50) DEFAULT NULL,
  `age` int DEFAULT NULL,
  `symptoms_date` datetime DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `FK_patients_details_register_patients` (`patients_id`),
  KEY `FK_patients_details_register_reception` (`reception_id`),
  KEY `FK_patients_details_registered_doctor` (`doctor_id`),
  CONSTRAINT `FK_patients_details_register_patients` FOREIGN KEY (`patients_id`) REFERENCES `registered_patients` (`p_id`),
  CONSTRAINT `FK_patients_details_register_reception` FOREIGN KEY (`reception_id`) REFERENCES `registered_reception` (`id_num`),
  CONSTRAINT `FK_patients_details_registered_doctor` FOREIGN KEY (`doctor_id`) REFERENCES `registered_doctor` (`id_num`)
) ENGINE=InnoDB AUTO_INCREMENT=14 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

-- Dumping data for table healthcare.patients_details: ~6 rows (approximately)
INSERT INTO `patients_details` (`id`, `patients_id`, `reception_id`, `symptoms`, `Prescriptions`, `doctor_id`, `age`, `symptoms_date`) VALUES
	(1, 5, '1542658v', 'fdfsf', 'sdsdsdasda', '785645v', 25, '2024-06-05 22:00:24'),
	(2, 6, '1542658v', 'fdf', '', '785645v', 35, '2024-06-05 22:00:24'),
	(3, 7, '1542658v', 'abcdeg', '', '785645v', 26, '2024-06-05 22:01:26'),
	(4, 8, '1542658v', 'abnd kfhie kdlke odk', 'penadol  20mg', '785645v', 26, '2024-06-05 22:02:06'),
	(5, 9, '1542658v', 'fdfha uefn ', '', '785645v', 56, '2024-06-05 22:02:25'),
	(6, 7, '1542658v', 'abnd kfhie kfdfffffff33', 'penadol  20mg', '785645v', 27, '2024-06-05 22:04:11'),
	(7, 2, '1542658v', 'head problems\neye problems\nhand problems', '', '785645v', 23, '2024-06-07 19:36:54'),
	(8, 2, '1542658v', '', '', '785645v', 25, '2024-06-07 19:39:12'),
	(9, 2, '1542658v', 'abc deg ghi', '', '785645v', 25, '2024-06-07 19:39:26'),
	(10, 2, '1542658v', 'aaaaaaaaaaaaaaaaaaaaa', '', '785645v', 30, '2024-06-07 21:24:05'),
	(11, 10, '1542658v', 'fdjsp kjdpfmk[p kfkfls ', '', '785645v', 5, '2024-06-07 21:25:07'),
	(12, 10, '1542658v', 'gklgl pgl [[ ]. ggfg', '', '785645v', 16, '2024-06-07 21:25:58'),
	(13, 10, '1542658v', 'a', '', '785645v', 20, '2024-06-07 21:27:02');

-- Dumping structure for table healthcare.registered_doctor
CREATE TABLE IF NOT EXISTS `registered_doctor` (
  `id_num` varchar(50) CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci NOT NULL,
  `name` varchar(50) CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci DEFAULT NULL,
  `email` varchar(50) CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci DEFAULT NULL,
  `mobile` varchar(50) CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci DEFAULT NULL,
  `password` varchar(200) CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci DEFAULT NULL,
  `verification_code` varchar(50) CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci DEFAULT NULL,
  `register_date` datetime DEFAULT NULL,
  PRIMARY KEY (`id_num`) USING BTREE
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

-- Dumping data for table healthcare.registered_doctor: ~0 rows (approximately)
INSERT INTO `registered_doctor` (`id_num`, `name`, `email`, `mobile`, `password`, `verification_code`, `register_date`) VALUES
	('785645v', 'doc01', 'doc@gmail.com', '0716585698', '12342', NULL, '2024-06-05 17:32:06');

-- Dumping structure for table healthcare.registered_patients
CREATE TABLE IF NOT EXISTS `registered_patients` (
  `p_id` int NOT NULL AUTO_INCREMENT,
  `name` varchar(50) CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci DEFAULT NULL,
  `mobile` varchar(12) DEFAULT NULL,
  `email` varchar(50) DEFAULT NULL,
  `id_num` varchar(20) DEFAULT NULL,
  `address` text,
  `age` int DEFAULT NULL,
  `register_date` datetime DEFAULT NULL,
  `reception_id` varchar(50) DEFAULT NULL,
  PRIMARY KEY (`p_id`),
  KEY `FK_register_patients_register_reception` (`reception_id`),
  CONSTRAINT `FK_register_patients_register_reception` FOREIGN KEY (`reception_id`) REFERENCES `registered_reception` (`id_num`)
) ENGINE=InnoDB AUTO_INCREMENT=11 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

-- Dumping data for table healthcare.registered_patients: ~8 rows (approximately)
INSERT INTO `registered_patients` (`p_id`, `name`, `mobile`, `email`, `id_num`, `address`, `age`, `register_date`, `reception_id`) VALUES
	(2, 'abcd efg', '0713772006', 'chalithachamod3031@gmail.com', '196971900830', 'pinnagollawththa maharachchimulla alawwa', 30, '2024-06-07 21:24:00', '1542658v'),
	(3, 'chalitha chamod', '0713772006', 'chalithachamod3031@gmail.com', '196971900830', 'pinnagollawththa maharachchimulla alawwa', 12, '2024-06-05 17:55:27', '1542658v'),
	(4, 'chalitha chamod', '0713772006', 'chalithachamod3031@gmail.com', '196971900830', 'pinnagollawththa maharachchimulla alawwa', 34, '2024-06-05 18:17:16', '1542658v'),
	(5, 'chalitha chamod', '0713772006', 'chalithachamod3031@gmail.com', '196971900830', 'pinnagollawththa maharachchimulla alawwa', 23, '2024-06-05 18:18:07', '1542658v'),
	(6, 'chalitha chamod', '0713772006', 'chalithachamod3031@gmail.com', '196971900830', 'pinnagollawththa maharachchimulla alawwa', 34, '2024-06-05 18:18:53', '1542658v'),
	(7, 'sanuka tharaka', '0711234567', 'sanuka@gmail.com', '254685v', 'galgamuwa alawwa', 30, '2024-06-07 12:26:29', '1542658v'),
	(8, 'sanuka tharaka', '07165846895', 'sanuka@gmail.com', '254685v', 'galgamuwa alawwa', 26, '2024-06-05 22:02:06', '1542658v'),
	(9, 'chalitha chamod', '0783772006', 'chalithachamod@gmail.com', '4564', 'maharachchimulla alawwa', 20, '2024-06-07 12:24:53', '1542658v'),
	(10, 'adeesha', '07165984679', 'abcdeg@gmail.com', '24698752', 'alawwa kurunegala', 20, '2024-06-07 21:26:59', '1542658v');

-- Dumping structure for table healthcare.registered_reception
CREATE TABLE IF NOT EXISTS `registered_reception` (
  `id_num` varchar(50) NOT NULL,
  `name` varchar(50) CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci DEFAULT NULL,
  `email` varchar(50) DEFAULT NULL,
  `mobile` varchar(50) CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci DEFAULT NULL,
  `password` varchar(200) DEFAULT NULL,
  `verification_code` varchar(50) DEFAULT NULL,
  `register_date` datetime DEFAULT NULL,
  PRIMARY KEY (`id_num`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

-- Dumping data for table healthcare.registered_reception: ~0 rows (approximately)
INSERT INTO `registered_reception` (`id_num`, `name`, `email`, `mobile`, `password`, `verification_code`, `register_date`) VALUES
	('1542658v', 'recip_01', 'res@gmail.com', '0716584569', '12345', NULL, '2024-06-05 17:29:18');

-- Dumping structure for table healthcare.user
CREATE TABLE IF NOT EXISTS `user` (
  `fname` varchar(50) DEFAULT NULL,
  `lname` varchar(50) DEFAULT NULL,
  `email` varchar(50) NOT NULL,
  `password` varchar(200) CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci DEFAULT NULL,
  `register_Date` datetime DEFAULT NULL,
  PRIMARY KEY (`email`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

-- Dumping data for table healthcare.user: ~2 rows (approximately)
INSERT INTO `user` (`fname`, `lname`, `email`, `password`, `register_Date`) VALUES
	('abc', 'def', 'abc@gmail.com', '03ac674216f3e15c761ee1a5e255f067953623c8b388b4459e13f978d7c846f4', '2024-06-04 01:32:47'),
	('qwe', 'qwe', 'qwe@gmail.com', 'a665a45920422f9d417e4867efdc4fb8a04a1f3fff1fa07e998e86f7f7a27ae3', '2024-06-04 11:18:10');

/*!40103 SET TIME_ZONE=IFNULL(@OLD_TIME_ZONE, 'system') */;
/*!40101 SET SQL_MODE=IFNULL(@OLD_SQL_MODE, '') */;
/*!40014 SET FOREIGN_KEY_CHECKS=IFNULL(@OLD_FOREIGN_KEY_CHECKS, 1) */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40111 SET SQL_NOTES=IFNULL(@OLD_SQL_NOTES, 1) */;
