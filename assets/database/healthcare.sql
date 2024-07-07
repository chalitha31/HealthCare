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
CREATE DATABASE IF NOT EXISTS `healthcare` /*!40100 DEFAULT CHARACTER SET utf8 */ /*!80016 DEFAULT ENCRYPTION='N' */;
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
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8mb3;

-- Dumping data for table healthcare.admin: ~0 rows (approximately)
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
) ENGINE=InnoDB AUTO_INCREMENT=18 DEFAULT CHARSET=utf8mb3;

-- Dumping data for table healthcare.bloodtest: ~17 rows (approximately)
INSERT INTO `bloodtest` (`id`, `patientDetails_id`, `reportName`, `test_type`, `issued_Date`, `mlt_id`) VALUES
	(1, 1, 'lipid_medical_report_1_K.R.karunadasa_2024-07-04_13-01-21.jpg', 'lipid', '2024-07-04 13:01:21', '1970671234'),
	(2, 7, 'hdl_medical_report_7_karunawathimenike_2024-06-29_02-16-33.jpg', 'hdl', '2024-06-29 02:16:33', '1970671234'),
	(3, 8, 'vldl_medical_report_8_Ashinibandara_2024-06-29_03-05-37.jpg', 'vldl', '2024-06-29 03:05:37', '1970671234'),
	(4, 12, 'cbc_medical_report_12_M.R.Rathnasiri_2024-06-29_02-14-00.jpg', 'cbc', '2024-06-29 02:14:00', '1970671234'),
	(5, 11, 'ldl_medical_report_11_subanikumari_2024-06-29_02-15-34.jpg', 'ldl', '2024-06-29 02:15:34', '1970671234'),
	(6, 9, 'ppbs_medical_report_9_LithuliBandara_2024-06-29_03-04-44.jpg', 'ppbs', '2024-06-29 03:04:44', '1970671234'),
	(7, 13, 'lipid_medical_report_1_K.R.karunadasa_2024-07-04_13-01-21.jpg', 'fbs', '2024-06-29 03:15:48', '1970671234'),
	(8, 12, 'ldl_medical_report_12_M.R.Rathnasiri_2024-07-04_18-09-26.jpg', 'ldl', '2024-07-04 18:09:26', '1970671234'),
	(9, 14, 'ppbs_medical_report_14_NipunAnuoama_2024-06-30_15-46-40.jpg', 'ppbs', '2024-06-30 15:46:40', '1970671234'),
	(10, 14, 'cbc_medical_report_14_NipunAnuoama_2024-06-30_15-47-50.jpg', 'cbc', '2024-06-30 15:47:50', '1970671234'),
	(11, 7, 'lipid_medical_report_7_karunawathimenike_2024-07-06_14-45-49.jpg', 'lipid', '2024-07-06 14:45:49', '1970671234'),
	(12, 13, 'ppbs_medical_report_13_Damayanthikumari_2024-07-06_14-45-41.jpg', 'ppbs', '2024-07-06 14:45:41', '1970671234'),
	(13, 15, 'cbc_medical_report_15_sithuminaveesha_2024-07-04_18-11-55.jpg', 'fbc', '2024-07-04 18:11:55', '1970671234'),
	(14, 15, 'fpg_medical_report_15_sithuminaveesha_2024-07-04_18-13-42.jpg', 'fpg', '2024-07-04 18:13:42', '1970671234'),
	(15, 7, 'fpg_medical_report_7_karunawathimenike_2024-07-06_14-47-34.jpg', 'fpg', '2024-07-06 14:47:34', '1970671234'),
	(16, 13, 'ppbs_medical_report_13_Damayanthikumari_2024-07-06_14-50-02.jpg', 'ppbs', '2024-07-06 14:50:02', '1970671234'),
	(17, 7, 'lipid_medical_report_7_karunawathimenike_2024-07-06_14-50-30.jpg', 'lipid', '2024-07-06 14:50:30', '1970671234');

-- Dumping structure for table healthcare.medicines
CREATE TABLE IF NOT EXISTS `medicines` (
  `id` int NOT NULL AUTO_INCREMENT,
  `name` varchar(50) DEFAULT NULL,
  `brand` varchar(50) DEFAULT NULL,
  `quantity` int DEFAULT NULL,
  `exp` date DEFAULT NULL,
  `purchase_date` date DEFAULT NULL,
  `outofstock_date` date DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=19 DEFAULT CHARSET=utf8mb3;

-- Dumping data for table healthcare.medicines: ~18 rows (approximately)
INSERT INTO `medicines` (`id`, `name`, `brand`, `quantity`, `exp`, `purchase_date`, `outofstock_date`) VALUES
	(1, 'Zithrocin', 'Zetra pvt ltd', 9900, '2025-02-28', '2024-04-03', NULL),
	(2, 'Paracetamol', 'ABC Pharma', 256, '2024-10-24', '2024-02-03', NULL),
	(3, 'Amoxicillin', 'Amox pvt', 439, '2024-03-18', '2024-07-01', NULL),
	(4, 'Aspirin', 'Aspirin', 3537, '2026-07-03', '2024-06-03', NULL),
	(5, 'zithrocin', 'Zetra pvt ltd', 0, '2024-07-06', '2024-06-03', '2024-07-03'),
	(6, 'pirition', 'zetra pvt ltd', 459, '2024-08-28', '2024-07-03', NULL),
	(7, 'Acetaminophen', 'Ace pvt', 0, '2025-06-23', '2024-05-03', '2024-07-04'),
	(8, 'Calcium', 'ABC PVT LTD', 0, '2024-07-24', '2022-07-03', '2024-07-04'),
	(9, 'Dopamine', 'Dop Company', 4, '2024-04-07', '2024-06-17', NULL),
	(10, ' fluoxetine', 'fluii', 900, '2024-07-20', '2024-04-03', NULL),
	(11, 'Aspirin', 'zetra pvt ltd', 0, '2024-09-05', '2023-12-03', NULL),
	(12, 'zithrocin', 'Zetra pvt ltd', 0, '2024-09-07', '2023-07-03', NULL),
	(13, 'gGhespirin', 'fsf', 40, '2024-08-28', '2024-03-03', NULL),
	(14, 'Zithrocin', 'Zetra pvt ltd', 1560, '2026-02-03', '2024-07-03', NULL),
	(15, 'abcde (200mg)', 'abc', 150, '2024-08-16', '2024-07-04', NULL),
	(16, 'A (50mg)', 'a', 118, '2024-08-24', '2024-07-05', NULL),
	(17, 'A (50mg)', 'a', 35, '2024-08-28', '2024-07-06', NULL),
	(18, 'gae (50mg)', 'ffe hwer', 120, '2024-07-20', '2024-07-06', NULL);

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
) ENGINE=InnoDB AUTO_INCREMENT=12 DEFAULT CHARSET=utf8mb3;

-- Dumping data for table healthcare.medicines_recode: ~11 rows (approximately)
INSERT INTO `medicines_recode` (`id`, `patientDetails_id`, `medicine_id`, `qty`, `date`) VALUES
	(1, 2, 3, 30, '2024-06-29'),
	(2, 11, 7, 50, '2024-06-30'),
	(3, 11, 5, 20, '2024-06-30'),
	(4, 4, 4, 6, '2024-06-30'),
	(5, 4, 5, 8, '2024-06-30'),
	(6, 4, 2, 6, '2024-06-30'),
	(7, 14, 2, 50, '2024-06-30'),
	(8, 14, 5, 14, '2024-06-30'),
	(9, 6, 5, 5, '2024-07-03'),
	(10, 6, 6, 10, '2024-07-03'),
	(11, 10, 6, 1, '2024-07-07');

-- Dumping structure for table healthcare.mlt_equipments
CREATE TABLE IF NOT EXISTS `mlt_equipments` (
  `id` int NOT NULL AUTO_INCREMENT,
  `name` varchar(100) DEFAULT NULL,
  `quantity` int DEFAULT NULL,
  `purchase_date` date DEFAULT NULL,
  `avalable_quantity` int DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=11 DEFAULT CHARSET=utf8mb3;

-- Dumping data for table healthcare.mlt_equipments: ~10 rows (approximately)
INSERT INTO `mlt_equipments` (`id`, `name`, `quantity`, `purchase_date`, `avalable_quantity`) VALUES
	(1, 'Blood collection tubes', 35, NULL, 35),
	(2, 'Latex gloves', 135, NULL, 0),
	(3, 'Urine collection cups', 10, NULL, 10),
	(4, 'Sterile syringes', 481, NULL, 250),
	(5, 'Hypodermic needles', 18, NULL, 10),
	(6, 'EDTA tubes (lavender top)', 13, NULL, 12),
	(7, 'Sterile gauze pads', 81, NULL, 56),
	(8, 'test tube', 11, NULL, 0),
	(9, 'ad', 123, '2024-07-06', 120),
	(10, 'abcedf` tube', 150, '2024-07-06', 150);

-- Dumping structure for table healthcare.patients_details
CREATE TABLE IF NOT EXISTS `patients_details` (
  `id` int NOT NULL AUTO_INCREMENT,
  `patients_id` int DEFAULT NULL,
  `age` int DEFAULT NULL,
  `reception_id` varchar(50) DEFAULT NULL,
  `symptoms` text,
  `medical_report` text,
  `Prescriptions` text,
  `Prescriptions_date` datetime DEFAULT NULL,
  `doctor_id` varchar(50) DEFAULT NULL,
  `symptoms_date` datetime DEFAULT NULL,
  `medicine_status` varchar(50) DEFAULT 'pending',
  PRIMARY KEY (`id`),
  KEY `FK_patients_details_register_patients` (`patients_id`),
  KEY `FK_patients_details_register_reception` (`reception_id`),
  KEY `FK_patients_details_registered_doctor` (`doctor_id`),
  CONSTRAINT `FK_patients_details_register_patients` FOREIGN KEY (`patients_id`) REFERENCES `registered_patients` (`p_id`),
  CONSTRAINT `FK_patients_details_register_reception` FOREIGN KEY (`reception_id`) REFERENCES `registered_reception` (`id_num`),
  CONSTRAINT `FK_patients_details_registered_doctor` FOREIGN KEY (`doctor_id`) REFERENCES `registered_doctor` (`id_num`)
) ENGINE=InnoDB AUTO_INCREMENT=17 DEFAULT CHARSET=utf8mb3;

-- Dumping data for table healthcare.patients_details: ~16 rows (approximately)
INSERT INTO `patients_details` (`id`, `patients_id`, `age`, `reception_id`, `symptoms`, `medical_report`, `Prescriptions`, `Prescriptions_date`, `doctor_id`, `symptoms_date`, `medicine_status`) VALUES
	(1, 1, 68, '1990563467', ' High Blood Pressure\nOften asymptomatic, but can include headaches, shortness of breath, nosebleeds.\nGenetics, diet, stress, underlying conditions.', 'yes', '', NULL, '0000000000', '2024-06-28 17:39:38', 'pending'),
	(2, 2, 64, '1990563467', 'Diabetes\nIncreased thirst, frequent urination, fatigue, blurred vision.\n\n', 'no', 'Insulin.\r\nempagliflozin', '2024-06-28 18:40:44', '1988235678', '2024-06-28 17:42:24', 'true'),
	(3, 3, 45, '1990563467', 'Fever\nElevated body temperature, chills, sweating, headache, muscle aches.', 'fever', 'peracitamol\r\nAcetaminophen (Tylenol), Ibuprofen (Advil, Motrin), Aspirin (for adults).', '2024-06-28 18:41:59', '1988235678', '2024-06-28 18:00:35', 'Medication cancelled'),
	(4, 4, 56, '1990563467', ' Influenza\n High fever, headache, extreme fatigue, dry cough, sore throat, muscle aches.', 'no', 'acetaminophen, ibuprofen).', '2024-06-28 18:45:05', '1988235678', '2024-06-28 18:02:35', 'true'),
	(5, 5, 54, '1990563467', ' Headache\n Pain in the head or upper neck, tension, throbbing.\n  \n', 'headache', 'peracitamol', '2024-06-28 19:03:52', '1988235678', '2024-06-28 18:05:46', 'pending'),
	(6, 6, 12, '1990563467', 'Allergic\nSneezing, itching, rash, swelling, watery eyes.', 'no', 'Antihistamines (diphenhydramine, cetirizine, loratadine), Decongestants ', '2024-06-28 18:43:10', '1988235678', '2024-06-28 18:06:48', 'true'),
	(7, 7, 68, '1990563467', 'Muscle Pain\nSoreness, stiffness, aching in muscles.', 'no', '', NULL, '0000000000', '2024-06-28 18:09:20', 'pending'),
	(8, 8, 24, '1990563467', 'Depression\nersistent sadness, loss of interest, fatigue, changes in appetite, sleep disturbances.', 'cholostrol', 'xxxxx', '2024-06-29 03:13:46', '1988235678', '2024-06-28 18:11:50', 'pending'),
	(9, 9, 12, '1990563467', ' Cough\n Persistent cough, throat irritation, chest discomfort.', 'no', 'wwww', '2024-06-29 03:14:29', '1988235678', '2024-06-28 18:13:06', 'Medication cancelled'),
	(10, 10, 68, '1990563467', ' Skin Rash\nRedness, itching, swelling, blisters.', 'no', 'piriton', '2024-06-29 03:06:50', '1988235678', '2024-06-28 18:15:56', 'true'),
	(11, 3, 45, '1990563467', 'cholostrol', 'no', 'Perryton', '2024-06-30 10:24:46', '1988235678', '2024-06-28 18:48:00', 'true'),
	(12, 4, 56, '1990563467', 'cholostrol', 'yes', '', NULL, '0000000000', '2024-06-28 18:49:07', 'pending'),
	(13, 5, 54, '1990563467', 'xxxx', 'no', '', NULL, '0000000000', '2024-06-29 03:12:43', 'pending'),
	(14, 11, 50, '1990563467', 'abc\ndef\nghi\nili jodhsa kia0s9ud kjpd', '2024.06.55 medicine date a;awwa ', 'piriton \r\npenadol\r\n', '2024-06-30 15:48:41', '1988235678', '2024-06-30 15:43:36', 'true'),
	(15, 6, 12, '1990563467', 'abc dej\nfjo eowi [pweiop\newi0ew-of', 'no', '', NULL, '0000000000', '2024-07-04 18:10:43', 'pending'),
	(16, 11, 52, '1990563467', 'abc\ndewf\nfhji', 'no', 'abc\r\nfreg\r\nkgjo\r\nkjoe\r\nwoekfk kwekf pke fpe', '2024-07-05 01:33:12', '1988235678', '2024-07-05 01:32:36', 'pending');

-- Dumping structure for table healthcare.registered_doctor
CREATE TABLE IF NOT EXISTS `registered_doctor` (
  `id_num` varchar(50) NOT NULL,
  `name` varchar(50) DEFAULT NULL,
  `email` varchar(50) DEFAULT NULL,
  `mobile` varchar(50) DEFAULT NULL,
  `password` varchar(200) DEFAULT NULL,
  `verification_code` varchar(50) DEFAULT NULL,
  `register_date` datetime DEFAULT NULL,
  `status` int DEFAULT '1',
  `age` int DEFAULT NULL,
  `address` text,
  `image` varchar(100) DEFAULT NULL,
  PRIMARY KEY (`id_num`) USING BTREE,
  KEY `FK_registered_doctor_ststus_type` (`status`),
  CONSTRAINT `FK_registered_doctor_ststus_type` FOREIGN KEY (`status`) REFERENCES `status_type` (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb3;

-- Dumping data for table healthcare.registered_doctor: ~3 rows (approximately)
INSERT INTO `registered_doctor` (`id_num`, `name`, `email`, `mobile`, `password`, `verification_code`, `register_date`, `status`, `age`, `address`, `image`) VALUES
	('0000000000', 'none', 'none', 'none', NULL, NULL, '2024-06-17 00:38:59', 1, NULL, NULL, NULL),
	('1969719008', NULL, 'chalithachamod3031@gmail.com', NULL, 'f7cc686e1244355fbcb93b82065426c9cb0fff8271ac27ffef317bb33eb9c747', NULL, '2024-06-30 15:52:56', 1, NULL, NULL, NULL),
	('1988235678', 'kamal perera', 'krishanibandara7@gmail.com', '0785678234', '891890c808e66a1f2acf429267f383c96654c26d22d11b7c62d755eb9079eb53', NULL, '2024-06-28 17:48:50', 1, 36, 'agruwella', NULL);

-- Dumping structure for table healthcare.registered_mlt
CREATE TABLE IF NOT EXISTS `registered_mlt` (
  `id_num` varchar(50) NOT NULL,
  `name` varchar(50) DEFAULT NULL,
  `email` varchar(50) DEFAULT NULL,
  `mobile` varchar(50) DEFAULT NULL,
  `password` varchar(200) DEFAULT NULL,
  `verification_code` varchar(50) DEFAULT NULL,
  `register_date` datetime DEFAULT NULL,
  `status` int DEFAULT '1',
  `age` int DEFAULT NULL,
  `address` varchar(50) DEFAULT NULL,
  `image` varchar(100) DEFAULT NULL,
  PRIMARY KEY (`id_num`) USING BTREE,
  KEY `FK_mlt_status_type` (`status`) USING BTREE,
  CONSTRAINT `FK_mlt_status_type` FOREIGN KEY (`status`) REFERENCES `status_type` (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb3;

-- Dumping data for table healthcare.registered_mlt: ~0 rows (approximately)
INSERT INTO `registered_mlt` (`id_num`, `name`, `email`, `mobile`, `password`, `verification_code`, `register_date`, `status`, `age`, `address`, `image`) VALUES
	('1970671234', 'sumith kumara', 'chathurangibandara058@gmail.com', '0785645380', '51b1046249a850d2ca5294fccea504411734620fb20d0bb7d8fa6590ca65d522', NULL, '2024-06-28 18:33:15', 1, 54, 'No10,kegalle', NULL);

-- Dumping structure for table healthcare.registered_patients
CREATE TABLE IF NOT EXISTS `registered_patients` (
  `p_id` int NOT NULL AUTO_INCREMENT,
  `name` varchar(50) DEFAULT NULL,
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
) ENGINE=InnoDB AUTO_INCREMENT=12 DEFAULT CHARSET=utf8mb3;

-- Dumping data for table healthcare.registered_patients: ~11 rows (approximately)
INSERT INTO `registered_patients` (`p_id`, `name`, `mobile`, `email`, `id_num`, `address`, `age`, `register_date`, `reception_id`) VALUES
	(1, 'K.R.karunadasa', '07089674532', '', '195678904532', 'hettimulla,kegalle', 68, '2024-06-28 17:39:38', '1990563467'),
	(2, 'H. sumanawathi', '0754678901', '', '1960456789', 'atugoda,kegalle', 64, '2024-06-28 17:42:24', '1990563467'),
	(3, 'subani kumari', '0712456789', 'suba@gmail.com', '19784567432', 'moronthota', 45, '2024-06-28 18:00:35', '1990563467'),
	(4, 'M.R.Rathnasiri', '0356789012', '', '196789234560', 'molagoda', 56, '2024-06-28 18:02:35', '1990563467'),
	(5, 'Damayanthi kumari', '076345890', 'damayanthi@gmail.com', '19705678321', 'bulathkohupitiya', 54, '2024-06-28 18:05:46', '1990563467'),
	(6, 'sithumi naveesha', '0356789435', '', '', 'hettimulla', 12, '2024-06-28 18:06:48', '1990563467'),
	(7, 'karunawathi menike', '0355678902', '', '1955678902', 'minuwangamuwa', 68, '2024-06-28 18:09:20', '1990563467'),
	(8, 'Ashini bandara', '07089674532', 'ash@gamil.com', '2000345672', 'debathgama', 24, '2024-06-28 18:11:50', '1990563467'),
	(9, 'Lithuli Bandara', '0745623123', '', '', 'meedeniya,hettimulla', 12, '2024-06-28 18:13:06', '1990563467'),
	(10, 'Ananda Kumara', '0785634567', 'ananda@gmail.com', '1955673456', 'meedeniya,hettimulla', 68, '2024-06-28 18:15:56', '1990563467'),
	(11, 'Nipun Anuoama', '0713772006', 'chalithachamod3031@gmail.com', '', 'pinnagollawththa maharachchimulla alawwa', 52, '2024-06-30 15:50:59', '1990563467');

-- Dumping structure for table healthcare.registered_pharmacists
CREATE TABLE IF NOT EXISTS `registered_pharmacists` (
  `id_num` varchar(50) NOT NULL,
  `name` varchar(50) DEFAULT NULL,
  `email` varchar(50) DEFAULT NULL,
  `mobile` varchar(50) DEFAULT NULL,
  `password` varchar(200) DEFAULT NULL,
  `verification_code` varchar(50) DEFAULT NULL,
  `register_date` datetime DEFAULT NULL,
  `status` int DEFAULT '1',
  `age` int DEFAULT NULL,
  `address` text,
  `image` varchar(100) DEFAULT NULL,
  PRIMARY KEY (`id_num`) USING BTREE,
  KEY `FK_registered_pharmacists_status_type` (`status`),
  CONSTRAINT `FK_registered_pharmacists_status_type` FOREIGN KEY (`status`) REFERENCES `status_type` (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb3;

-- Dumping data for table healthcare.registered_pharmacists: ~0 rows (approximately)
INSERT INTO `registered_pharmacists` (`id_num`, `name`, `email`, `mobile`, `password`, `verification_code`, `register_date`, `status`, `age`, `address`, `image`) VALUES
	('1978345678', 'Kamal Ekanayaka', 'chathurangibandara05@gmail.com', '0708945671', '4669590396f9689d0d3f8ed605b05ffeebfd511cce05b5fe4d57e9c21e7e8751', NULL, '2024-06-28 18:20:06', 1, 45, 'paragammana', NULL);

-- Dumping structure for table healthcare.registered_reception
CREATE TABLE IF NOT EXISTS `registered_reception` (
  `id_num` varchar(50) NOT NULL,
  `address` text,
  `name` varchar(50) DEFAULT NULL,
  `email` varchar(50) DEFAULT NULL,
  `mobile` varchar(50) DEFAULT NULL,
  `password` varchar(200) DEFAULT NULL,
  `verification_code` varchar(50) DEFAULT NULL,
  `register_date` datetime DEFAULT NULL,
  `image` varchar(100) DEFAULT NULL,
  `status` int DEFAULT '1',
  `age` int DEFAULT NULL,
  PRIMARY KEY (`id_num`),
  KEY `FK_registered_reception_status_type` (`status`),
  CONSTRAINT `FK_registered_reception_status_type` FOREIGN KEY (`status`) REFERENCES `status_type` (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb3;

-- Dumping data for table healthcare.registered_reception: ~0 rows (approximately)
INSERT INTO `registered_reception` (`id_num`, `address`, `name`, `email`, `mobile`, `password`, `verification_code`, `register_date`, `image`, `status`, `age`) VALUES
	('1990563467', 'No10,kegalle', 'sanduni kaushalya', 'krishanibandara43@gmail.com', '07089674532', '7292d5933867caddd46f3c3674917146ecf8fc8162a22457e3fd13f6038855dc', NULL, '2024-06-28 17:25:58', NULL, 1, 34);

-- Dumping structure for table healthcare.status_type
CREATE TABLE IF NOT EXISTS `status_type` (
  `id` int NOT NULL AUTO_INCREMENT,
  `name` varchar(50) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=utf8mb3;

-- Dumping data for table healthcare.status_type: ~2 rows (approximately)
INSERT INTO `status_type` (`id`, `name`) VALUES
	(1, 'Allow'),
	(2, 'block');

-- Dumping structure for table healthcare.user
CREATE TABLE IF NOT EXISTS `user` (
  `fname` varchar(50) DEFAULT NULL,
  `lname` varchar(50) DEFAULT NULL,
  `email` varchar(50) NOT NULL,
  `password` varchar(200) DEFAULT NULL,
  `register_Date` datetime DEFAULT NULL,
  `mobile` varchar(12) DEFAULT NULL,
  `status` int DEFAULT '1',
  PRIMARY KEY (`email`),
  KEY `FK_user_status_type` (`status`),
  CONSTRAINT `FK_user_status_type` FOREIGN KEY (`status`) REFERENCES `status_type` (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb3;

-- Dumping data for table healthcare.user: ~0 rows (approximately)

/*!40103 SET TIME_ZONE=IFNULL(@OLD_TIME_ZONE, 'system') */;
/*!40101 SET SQL_MODE=IFNULL(@OLD_SQL_MODE, '') */;
/*!40014 SET FOREIGN_KEY_CHECKS=IFNULL(@OLD_FOREIGN_KEY_CHECKS, 1) */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40111 SET SQL_NOTES=IFNULL(@OLD_SQL_NOTES, 1) */;
