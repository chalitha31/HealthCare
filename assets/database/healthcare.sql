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
) ENGINE=InnoDB AUTO_INCREMENT=31 DEFAULT CHARSET=utf8;

-- Dumping data for table healthcare.bloodtest: ~15 rows (approximately)
INSERT INTO `bloodtest` (`id`, `patientDetails_id`, `reportName`, `test_type`, `issued_Date`, `mlt_id`) VALUES
	(7, 36, 'medical_report_36_kumarsanga_2024-06-19_08-10-54.jpg', 'cbs', '2024-06-19 11:40:54', '1969719008'),
	(17, 29, 'medical_report_29_jjfddr_2024-06-19_08-05-04.jpg', 'cbc', '2024-06-19 11:35:04', '1969719008'),
	(18, 28, 'cbc_medical_report_28_jjfddr_2024-06-24_08-26-43.jpg', 'cbc', '2024-06-24 11:56:43', '1969719008'),
	(19, 38, 'vldl_medical_report_38_adeesha_2024-06-25_12-12-38.jpg', 'vldl', '2024-06-25 12:12:38', '1969719008'),
	(20, 36, 'fbs_medical_report_36_kumarsanga_2024-06-24_18-01-36.jpg', 'ppbs', '2024-06-24 21:31:36', '1969719008'),
	(21, 36, 'fbs_medical_report_36_kumarsanga_2024-06-24_18-18-14.jpg', 'hdl', '2024-06-24 21:48:14', '1969719008'),
	(22, 36, 'fbs_medical_report_36_kumarsanga_2024-06-24_18-20-10.jpg', 'ldl', '2024-06-24 21:50:10', '1969719008'),
	(23, 36, 'cbc_medical_report_36_kumarsanga_2024-06-24_18-43-16.jpg', 'cbc', '2024-06-24 22:13:16', '1969719008'),
	(24, 36, 'cbc_medical_report_36_kumarsanga_2024-06-24_18-43-33.jpg', 'cbc', '2024-06-24 22:13:33', '1969719008'),
	(25, 36, 'hdl_medical_report_36_kumarsanga_2024-06-24_18-44-01.jpg', 'hdl', '2024-06-24 22:14:01', '1969719008'),
	(26, 36, 'ldl_medical_report_36_kumarsanga_2024-06-24_18-44-31.jpg', 'ldl', '2024-06-24 22:14:31', '1969719008'),
	(27, 36, 'ppbs_medical_report_36_kumarsanga_2024-06-24_18-44-59.jpg', 'ppbs', '2024-06-24 22:14:59', '1969719008'),
	(28, 36, 'vldl_medical_report_36_kumarsanga_2024-06-24_18-45-20.jpg', 'vldl', '2024-06-24 22:15:20', '1969719008'),
	(29, 36, 'fbs_medical_report_36_kumarsanga_2024-06-24_18-45-42.jpg', 'fbs', '2024-06-24 22:15:42', '1969719008'),
	(30, 36, 'cbc_medical_report_36_kumarsanga_2024-06-25_13-23-17.jpg', 'cbc', '2024-06-25 13:23:17', '1969719008');

-- Dumping structure for table healthcare.medicines
CREATE TABLE IF NOT EXISTS `medicines` (
  `id` int NOT NULL AUTO_INCREMENT,
  `name` varchar(50) DEFAULT NULL,
  `brand` varchar(50) DEFAULT NULL,
  `quantity` int DEFAULT NULL,
  `exp` date DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=8 DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci;

-- Dumping data for table healthcare.medicines: ~7 rows (approximately)
INSERT INTO `medicines` (`id`, `name`, `brand`, `quantity`, `exp`) VALUES
	(1, 'Zithrocin', 'Zetra pvt ltd', 9800, '2025-02-28'),
	(2, 'Paracetamol', 'ABC Pharma', 400, '2024-10-24'),
	(3, 'Amoxicillin', 'Amox pvt', 439, '2023-07-18'),
	(4, 'Aspirin', 'Aspirin', 3600, '2026-07-03'),
	(5, 'zithrocin', 'Zetra pvt ltd', 150, '2024-07-06'),
	(6, 'pirition', 'zetra pvt ltd', 500, '2024-08-28'),
	(7, 'sdo iosaf', 'refei sdji', 0, '2025-06-23');

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
) ENGINE=InnoDB AUTO_INCREMENT=15 DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci;

-- Dumping data for table healthcare.medicines_recode: ~11 rows (approximately)
INSERT INTO `medicines_recode` (`id`, `patientDetails_id`, `medicine_id`, `qty`, `date`) VALUES
	(4, 27, 2, 50, '2024-06-21'),
	(5, 27, 1, 1000, '2024-06-23'),
	(6, 27, 5, 2, '2024-06-23'),
	(7, 27, 1, 100, '2024-06-23'),
	(8, 27, 4, 500, '2024-06-23'),
	(9, 35, 3, 61, '2024-06-23'),
	(10, 35, 7, 20, '2024-06-16'),
	(11, 26, 2, 30, '2024-06-23'),
	(12, 26, 7, 5, '2024-06-24'),
	(13, 30, 1, 100, '2024-06-24'),
	(14, 30, 4, 400, '2024-06-24');

-- Dumping structure for table healthcare.mlt_equipments
CREATE TABLE IF NOT EXISTS `mlt_equipments` (
  `id` int NOT NULL AUTO_INCREMENT,
  `name` varchar(100) DEFAULT NULL,
  `quantity` int DEFAULT NULL,
  `weekly` int DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=5 DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci;

-- Dumping data for table healthcare.mlt_equipments: ~4 rows (approximately)
INSERT INTO `mlt_equipments` (`id`, `name`, `quantity`, `weekly`) VALUES
	(1, 'asf gre', 14, 3),
	(2, 'gsyh', 84, 7),
	(3, 'fdsg', 44, 9),
	(4, 'hjgty', 499, 36);

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
) ENGINE=InnoDB AUTO_INCREMENT=39 DEFAULT CHARSET=utf8;

-- Dumping data for table healthcare.patients_details: ~11 rows (approximately)
INSERT INTO `patients_details` (`id`, `patients_id`, `age`, `reception_id`, `symptoms`, `medical_report`, `Prescriptions`, `Prescriptions_date`, `doctor_id`, `symptoms_date`, `medicine_status`) VALUES
	(25, 5, 56, '156879245v', 'tyhtfhfgh', 'no', 'dffe', '2024-06-18 16:37:11', '48946454555', '2024-06-17 12:12:34', 'pending'),
	(26, 4, 34, '196971900830', 'asdsadsa dsadas dasd sa d', 'no', 'dfsfsf', '2024-06-18 16:38:13', '48946454555', '2024-06-18 13:30:13', 'true'),
	(27, 4, 34, '196971900830', 'aaabbccddee', 'no', 'fsdsadsd dkfs kodkf ksd fkdskf \r\npkpfs\r\nppsd\r\npdfp\r\npppdf kpspdfp pdskf jiofj sih hsa dihjas djias di dasd asda asf asf asf sajid jisajdias jisajdi jifsjf \r\npkds pd\r\npsdf\r\npsd[fpdkfp kpdskf[ kpdkfpskdfpskf[\r\npkdsp[', '2024-06-18 16:48:26', '48946454555', '2024-06-18 13:30:30', 'true'),
	(28, 16, 45, '196971900830', 'hfghfghdg', 'no', 'fghfhtrh ', '2024-06-25 12:13:03', '353544353434', '2024-06-18 13:41:28', 'Medication cancelled'),
	(29, 16, 45, '196971900830', 'new seek', 'rdg reutrs th  httij y\r\nrhtuj yuj y\r\ntuuu6yityk y7tk 7', 'hhrrrr hsdyh trrrwg eyyy ytehjt', '2024-06-25 01:24:26', '353544353434', '2024-06-18 13:42:12', 'pending'),
	(30, 2, 30, '196971900830', 'new medic no', 'no', 'niifggdg', '2024-06-20 00:14:54', '353544353434', '2024-06-18 15:05:49', 'true'),
	(31, 10, 20, '196971900830', 'new medical yes', 'Lorem ipsum dolor sit amet consectetur adipisicing elit. Maxime mollitia,\r\nmolestiae quas vel sint commodi repudiandae consequuntur voluptatum laborum\r\nnumquam blanditiis harum quisquam eius sed odit fugiat iusto fuga praesentium\r\noptio, eaque rerum! Provident similique accusantium nemo autem. Veritatis\r\nobcaecati tenetur iure eius earum ut molestias architecto voluptate aliquam\r\nnihil, eveniet aliquid culpa officia aut! Impedit sit sunt quaerat, odit,\r\ntenetur error, harum nesciunt ipsum debitis quas aliquid. Reprehenderit,\r\nquia. Quo neque error repudiandae fuga? Ipsa laudantium molestias eos \r\nsapiente officiis modi at sunt excepturi expedita sint? Sed quibusdam\r\nrecusandae alias error harum maxime adipisci amet laborum. Perspiciatis \r\nminima nesciunt dolorem! Officiis iure rerum voluptates a cumque velit \r\nquibusdam sed amet tempora. Sit laborum ab, eius fugit doloribus tenetur \r\nfugiat, temporibus enim commodi iusto libero magni deleniti quod quam \r\nconsequuntur! Commodi minima excepturi repudiandae velit hic maxime\r\ndoloremque. Quaerat provident commodi consectetur veniam similique ad \r\nearum omnis ipsum saepe, voluptas, hic voluptates pariatur est explicabo \r\nfugiat, dolorum eligendi quam cupiditate excepturi mollitia maiores labore \r\nsuscipit quas? Nulla, placeat. Voluptatem quaerat non architecto ab laudantium\r\nmodi minima sunt esse temporibus sint culpa, recusandae aliquam numquam \r\ntotam ratione voluptas quod exercitationem fuga. Possimus quis earum veniam \r\nquasi aliquam eligendi, placeat qui corporis!', 'dfgfdsf', '2024-06-18 16:47:05', '48946454555', '2024-06-18 15:06:05', 'pending'),
	(34, 19, 54, '196971900830', 'new  reg med yes', 'hfhtrhh ', 'tryhr', '2024-06-25 12:13:12', '353544353434', '2024-06-18 15:11:24', 'pending'),
	(35, 20, 54, '196971900830', 'new reg no med', 'no', 'hfgfdg', '2024-06-18 16:50:13', '48946454555', '2024-06-18 15:11:54', 'true'),
	(36, 21, 12, '196971900830', 'new patie incluede  reprt', 'efwefwef', '', '2024-06-25 12:19:16', '353544353434', '2024-06-18 18:24:45', 'pending'),
	(38, 10, 20, '196971900830', '1stline\ndek\nthun jaspd jfpoejf sf\n4line oodsjf josdofsdfoj sjdfoj sdjfojeofj sdjfjeojfosjf jsojfojsodjf sdojfosjdf jsdofj 6tkkoooooos', 'no', 'hf fdgh dfh df', '2024-06-25 12:12:51', '353544353434', '2024-06-20 00:21:56', 'pending');

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

-- Dumping data for table healthcare.registered_doctor: ~9 rows (approximately)
INSERT INTO `registered_doctor` (`id_num`, `name`, `email`, `mobile`, `password`, `verification_code`, `register_date`, `status`, `age`, `address`, `image`) VALUES
	('0000000000', 'none', 'none', 'none', NULL, NULL, '2024-06-17 00:38:59', 1, NULL, NULL, NULL),
	('12345678912', NULL, 'abc@gmail.com', NULL, 'cc9fb108f1d9181b4eb4de8c21493875416f8ce6e462a29c1e380c94a6c6e6e2', NULL, '2024-06-16 14:58:37', 1, NULL, NULL, NULL),
	('1969719008', 'chaliiaa', 'cchamod93@gmail.com', '0716585982', '15e2b0d3c33891ebb0f1ef609ec419420c20e320ce94c65fbc8c3312448eb225', NULL, '2024-06-17 00:34:33', 1, 72, 'alwwaaaaa', '666f3721b143a.jpeg'),
	('19697190083', NULL, 'abc@gmail.com', NULL, '7acc4ec32d7e307932dc42ea4073979a68d5a0ee4e441e268809c948eff65232', NULL, '2024-06-16 14:58:49', 1, NULL, NULL, NULL),
	('196971900830', NULL, 'chamodnadeeshan91@gmail.com', NULL, '6666a437', NULL, '2024-06-16 14:58:49', 1, NULL, NULL, NULL),
	('20912658453V', NULL, 'kawshalya20001025@gmail.com', NULL, '6667f99f', NULL, '2024-06-16 14:58:50', 1, NULL, NULL, NULL),
	('353544353434', 'iro', 'irodhakashmi@gmail.com', '0713772006', '8d969eef6ecad3c29a3a629280e686cf0c3f5d5a86aff3ca12020c923adc6c92', NULL, '2024-06-20 00:14:38', 1, 32, 'tgsdg', NULL),
	('446541231348v', 'kashmi ', 'irodhakashmi@gmail.com', '0713214698', '2a8610aefdd0028c6bf074dd18721c0ef8bc43241cc7a653d7aedf2036bdf6b3', NULL, '2024-06-12 12:23:38', 1, 25, 'pasyala', '66687ae7148a6.jpeg'),
	('48946454555', 'kkaasshhmmii', 'irodhakashmi@gmail.com', '0716428659', 'f745b2d1a2118cf2e38b0c941166f9d81e201ff17dadea3c92ee464b370027ad', NULL, '2024-06-18 13:28:55', 1, 45, 'gdfgds efsd ', NULL),
	('785645v', 'doc01', 'doc@gmail.com', '0716585698', '12342', NULL, '2024-06-05 17:32:06', 1, NULL, NULL, NULL);

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
INSERT INTO `registered_mlt` (`id_num`, `name`, `email`, `mobile`, `password`, `verification_code`, `register_date`, `status`, `age`, `address`, `image`) VALUES
	('1969719008', 'mlt1', 'cchamod93@gmail.com', '0715684589', '2a8610aefdd0028c6bf074dd18721c0ef8bc43241cc7a653d7aedf2036bdf6b3', NULL, '2024-06-18 23:00:41', 1, 35, 'af fewf af', NULL);

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
) ENGINE=InnoDB AUTO_INCREMENT=22 DEFAULT CHARSET=utf8;

-- Dumping data for table healthcare.registered_patients: ~17 rows (approximately)
INSERT INTO `registered_patients` (`p_id`, `name`, `mobile`, `email`, `id_num`, `address`, `age`, `register_date`, `reception_id`) VALUES
	(2, 'abcd efg', '0713772006', 'chalithachamod3031@gmail.com', '196971900830', 'pinnagollawththa maharachchimulla alawwa', 30, '2024-06-07 03:24:00', '1542658v'),
	(3, 'vvvvv', '0713772006', 'chalithachamod3031@gmail.com', '196971900830', 'pinnagollawththa maharachchimulla alawwa', 12, '2024-04-05 17:55:27', '1542658v'),
	(4, 'chalitha chamod', '0713772006', 'chalithachamod3031@gmail.com', '196971900830', 'pinnagollawththa maharachchimulla alawwa', 34, '2024-06-05 18:17:16', '1542658v'),
	(5, 'cano', '0713772006', 'chalithachamod3031@gmail.com', '196971900830', 'pinnagollawththa maharachchimulla alawwa', 29, '2024-06-16 23:54:40', '1542658v'),
	(6, 'nadee', '0713772006', 'chalithachamod3031@gmail.com', '196971900830', 'pinnagollawththa maharachchimulla alawwa', 34, '2024-06-05 18:18:53', '1542658v'),
	(7, 'sanuka tharaka', '0711234567', 'sanuka@gmail.com', '254685v', 'galgamuwa alawwa', 30, '2024-06-07 12:26:29', '1542658v'),
	(8, 'sanuka tharaka', '07165846895', 'sanuka@gmail.com', '254685v', 'galgamuwa alawwa', 26, '2024-06-05 22:02:06', '1542658v'),
	(9, 'chalitha chamod', '0783772006', 'chalithachamod@gmail.com', '4564', 'maharachchimulla alawwa', 20, '2024-06-07 12:24:53', '1542658v'),
	(10, 'adeesha', '07165984679', 'abcdeg@gmail.com', '24698752', 'alawwa kurunegala', 20, '2024-06-07 21:26:59', '1542658v'),
	(11, 'new pation ', '0716584569', 'abc@gmail.com', '196971900830', 'alawwa', 60, '2024-06-11 21:21:18', '5468421v'),
	(12, 'aaaaaaaaaaaaa', '0726589875', 'accv@gmail.com', '545444645646v', 'khfyu jhsnald', 53, '2024-06-16 09:58:57', '196971900830'),
	(13, 'abcd', '0716589652', 'a@gmail.com', '', 'abc def ghi', 52, '2024-06-16 13:58:57', '196971900830'),
	(14, 'asd', '071658956', '', '', 'sfsdf', 34, '2024-06-17 00:37:08', '196971900830'),
	(15, 'gfg', '0726589575', '', '', 'dgfdg', 43, '2024-06-17 00:40:38', '196971900830'),
	(16, 'jjfddr', '0716584698', '', '', 'gd gdfg', 45, '2024-06-18 13:41:28', '196971900830'),
	(17, 'fqrtd ferf ', '0716585923', '', '', 'fds rgh fer wf', 23, '2024-06-18 15:07:06', '196971900830'),
	(18, 'fqrtd ferf ', '0716585923', '', '', 'fds rgh fer wf', 23, '2024-06-18 15:08:36', '196971900830'),
	(19, 'gdddg', '0716585923', '', '', 'fds rgh fer wf', 54, '2024-06-18 15:11:24', '196971900830'),
	(20, 'jhgjgfhfgh', '0716585923', '', '', 'fds rgh fer wf', 54, '2024-06-18 15:11:54', '196971900830'),
	(21, 'kumar sanga', '0716584569', '', '', 'new address adi ', 12, '2024-06-18 18:24:45', '196971900830');

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

-- Dumping data for table healthcare.registered_pharmacists: ~3 rows (approximately)
INSERT INTO `registered_pharmacists` (`id_num`, `name`, `email`, `mobile`, `password`, `verification_code`, `register_date`, `status`, `age`, `address`, `image`) VALUES
	('1969719008', NULL, 'chalit031@gmail.com', NULL, '66da271138c20d5168a3b323107a668494098bd98aed42d8399b12b095be9fdd', NULL, NULL, 1, NULL, NULL, NULL),
	('196971900830', NULL, 'chamodnadeeshan91@gmail.com', NULL, '6667f8fc', NULL, NULL, 2, NULL, NULL, NULL),
	('345465635333v', 'pharmists new', 'chamodnadeeshan91@gmail.com', '07165585952', '8d969eef6ecad3c29a3a629280e686cf0c3f5d5a86aff3ca12020c923adc6c92', NULL, '2024-06-23 19:58:49', 1, 36, 'fdsf fewgs', '6672fed9885af.jpeg');

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

-- Dumping data for table healthcare.registered_reception: ~5 rows (approximately)
INSERT INTO `registered_reception` (`id_num`, `address`, `name`, `email`, `mobile`, `password`, `verification_code`, `register_date`, `image`, `status`, `age`) VALUES
	('123456789V', NULL, NULL, 'cchamod93@gmail.com', NULL, '1a0726492bcbbfbd90dedf100497e9414cc1ed47ddad33cb60bcbbc9392883a6', NULL, NULL, NULL, 1, NULL),
	('1542658v', NULL, 'recip_01', 'res@gmail.com', '0716584569', '12345', NULL, '2024-06-05 17:29:18', NULL, 1, NULL),
	('156879245v', 'alawwa', 'tharaka', 'cchamod93@gmail.com', '0754568963', '8da41ee37bfc4a6afa809c4f9e59730fc2e45ca00fe7f3e2bd7d1b41b62184cb', NULL, '2024-06-11 21:06:56', '66686bfba9ab8.jpeg', 1, 55),
	('196971900830', 'aaa bbb ccc', 'sanuka', 'chalithachamod3031@gmail.com', '0713658698', '5994471abb01112afcc18159f6cc74b4f511b99806da59b3caf5a9c173cacfc5', NULL, '2024-06-15 19:06:51', '6668688ec15c2.jpeg', 1, 35),
	('5468421v', 'kurunegala', 'new rec', 'chamodnadeeshan91@gmail.com', '078456985', 'c0a779ff6d98ada508205607cae551d84b8273de27aa1cea77a093ccd18295e1', NULL, '2024-06-11 21:18:26', '666871ca0649b.jpeg', 1, 36),
	('58498456216', 'fdfsdgsd', 'chathuni', 'chathurangibandara05@gmail.com', '071648569', '5b66cc79629f6a3f37542fa2ce6bcf18339a524bf69d0e9090086dbf63ec20db', NULL, '2024-06-19 09:45:59', NULL, 1, 34);

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

-- Dumping data for table healthcare.user: ~5 rows (approximately)
INSERT INTO `user` (`fname`, `lname`, `email`, `password`, `register_Date`, `mobile`, `status`) VALUES
	('abc', 'def', 'abc@gmail.com', '03ac674216f3e15c761ee1a5e255f067953623c8b388b4459e13f978d7c846f4', '2024-06-04 01:32:47', NULL, 1),
	('abcd', 'efghi', 'chalithachamod3031@gmail.com', '8d969eef6ecad3c29a3a629280e686cf0c3f5d5a86aff3ca12020c923adc6c92', '2024-06-15 12:40:13', '0711234568', 1),
	('kaws', 'disa', 'kaw@gmail.com', '5994471abb01112afcc18159f6cc74b4f511b99806da59b3caf5a9c173cacfc5', '2024-06-12 19:42:04', NULL, 1),
	('qwe', 'qwe', 'qwe@gmail.com', 'a665a45920422f9d417e4867efdc4fb8a04a1f3fff1fa07e998e86f7f7a27ae3', '2024-06-04 11:18:10', NULL, 1),
	('qwr', 'gtwe', 'qwwwe@gmail.com', '8bb0cf6eb9b17d0f7d22b456f121257dc1254e1f01665370476383ea776df414', '2024-06-15 12:42:56', '0711234567', 1);

/*!40103 SET TIME_ZONE=IFNULL(@OLD_TIME_ZONE, 'system') */;
/*!40101 SET SQL_MODE=IFNULL(@OLD_SQL_MODE, '') */;
/*!40014 SET FOREIGN_KEY_CHECKS=IFNULL(@OLD_FOREIGN_KEY_CHECKS, 1) */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40111 SET SQL_NOTES=IFNULL(@OLD_SQL_NOTES, 1) */;
