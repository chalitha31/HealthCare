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
) ENGINE=InnoDB AUTO_INCREMENT=10 DEFAULT CHARSET=utf8mb3;

-- Dumping data for table healthcare.bloodtest: ~15 rows (approximately)
INSERT INTO `bloodtest` (`id`, `patientDetails_id`, `reportName`, `test_type`, `issued_Date`, `mlt_id`) VALUES
	(1, 1, 'cbc_medical_report_1_K.G.perera_2024-07-14_14-30-20.jpg', 'fbc', '2024-07-14 14:30:20', '1970671234'),
	(2, 2, 'fpg_medical_report_2_V.G.Kumari_2024-07-18_11-30-54.jpg', 'fpg', '2024-07-18 11:30:54', '1970671234'),
	(3, 6, 'ppbs_medical_report_6_K.P.Karunawathi_2024-07-22_16-35-20.jpg', 'ppbs', '2024-07-22 16:35:20', '1970671234'),
	(4, 2, 'fpg_medical_report_2_V.G.Kumari_2024-07-22_16-35-57.jpg', 'fpg', '2024-07-22 16:35:57', '1970671234'),
	(5, 16, 'lipid_medical_report_16_S.Gunaraththne_2024-07-28_12-40-37.jpg', 'lipid', '2024-07-28 12:40:37', '1970671234'),
	(6, 2, 'cbc_medical_report_2_V.G.Kumari_2024-07-29_10-09-23.jpg', 'fbc', '2024-07-29 10:09:23', '1970671234'),
	(7, 20, 'fpg_medical_report_20_Y.R.sanduni_2024-07-28_12-50-09.jpg', 'fpg', '2024-07-28 12:50:09', '1970671234'),
	(8, 22, NULL, 'fbc', NULL, NULL),
	(9, 21, NULL, 'lipid', NULL, NULL);

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
) ENGINE=InnoDB AUTO_INCREMENT=46 DEFAULT CHARSET=utf8mb3;

-- Dumping data for table healthcare.medicines: ~17 rows (approximately)
INSERT INTO `medicines` (`id`, `name`, `brand`, `quantity`, `exp`, `purchase_date`, `outofstock_date`) VALUES
	(1, 'Paracetamol(500mg)', 'GlaxoSmithKline (GSK) Sri Lanka', 490, '2025-03-13', '2024-07-13', NULL),
	(2, 'Dexamethasone(4mg)', 'Ceylon Pharmaceuticals', 0, '2025-01-13', '2024-07-13', '2024-07-14'),
	(3, 'Ciprofloxacin(500mg)', 'Astellas Pharma', 690, '2024-08-11', '2024-07-13', NULL),
	(4, 'Metformin(500mg)', 'Ceyoka Health', 200, '2024-07-28', '2024-07-13', NULL),
	(5, 'Morphine Sulfate(200mg)', 'Sun Pharma', 440, '2024-07-27', '2024-07-13', NULL),
	(6, 'Aspirin(20mg)', 'Cipla Sri Lanka', 125, '2024-09-29', '2024-01-14', NULL),
	(7, 'Amoxicillin(500mg)', 'Astron Limited', 290, '2024-09-13', '2024-07-13', NULL),
	(8, 'Metformin(500mg)', 'Richard Pieris Distributors Ltd', 290, '2024-11-13', '2024-07-13', NULL),
	(9, ' Atorvastatin(10mg)', 'Boehringer Ingelheim', 440, '2025-06-13', '2024-07-13', NULL),
	(10, 'Loperamide(2mg)', 'Astellas Pharma', 50, '2024-07-27', '2024-07-13', NULL),
	(11, 'Ciprofloxacin(250mg)', 'Swiss Pharma (Pvt) Ltd:', 0, '2024-07-28', '2024-07-14', '2024-07-22'),
	(12, 'Amoxicillin(250mg)', 'Sun Pharma Sri Lanka', 100, '2025-01-14', '2024-07-14', NULL),
	(13, 'Ciprofloxacin(250mg)', 'Cipla Pharmaceuticals (Pvt) Ltd', 280, '2024-08-07', '2024-07-14', NULL),
	(14, 'Ciprofloxacin(500mg)', 'Cipla Pharmaceuticals (Pvt) Ltd', 290, '2024-10-14', '2024-07-14', NULL),
	(15, 'Ciprofloxacin(750mg)', 'Cipla Pharmaceuticals (Pvt) Ltd', 500, '2025-02-14', '2024-07-14', NULL),
	(16, 'Amlodipine(5mg)', 'State Pharmaceuticals Corporation of Sri Lanka (SP', 390, '2024-12-14', '2024-07-14', NULL),
	(17, 'Omeprazole(20mg)', 'Hemas Pharmaceuticals', 20, '2024-08-11', '2024-07-14', '2024-07-14'),
	(18, 'Omeprazole(20mg)', 'Hemas Pharmaceuticals', 20, '2024-11-14', '2024-07-14', '2024-07-14'),
	(19, 'Omeprazole(20mg)', ' Omep Pharmaceuticals', 20, '2025-06-16', '2024-07-16', NULL),
	(20, 'Ibuprofen(400 mg)', 'Norvasc', 290, '2025-02-28', '2024-07-22', NULL),
	(21, 'Levothyroxine(0.05mg)', 'Cipro', 0, '2024-09-22', '2024-07-22', '2024-07-22'),
	(22, 'Salbutamol(4mg)', 'Plavix', 290, '2025-06-22', '2024-07-22', NULL),
	(23, 'Salbutamol(100mcg)', 'Plavix', 20, '2025-08-22', '2024-07-22', NULL),
	(24, 'Loratadine (10 mg)', ' Meronem', 0, '2024-09-22', '2024-07-22', '2024-07-22'),
	(25, 'Glibenclamide(5mg)', 'Cipro', 80, '2024-10-22', '2024-07-22', NULL),
	(26, 'Clopidogrel(75mg)', 'Lipito', 100, '2024-08-06', '2024-07-22', NULL),
	(27, 'Furosemide(40mg)', 'Sanofi', 20, '2024-08-05', '2024-07-22', NULL),
	(28, 'Simvastatin(20 mg)', 'Navesta Pharmaceuticals ', 20, '2024-08-07', '2024-07-22', NULL),
	(29, 'Losartan (50 mg)', 'Glucophage', 20, '2024-08-11', '2024-07-22', NULL),
	(30, 'Metronidazole(400mg)', 'Lanka Hospitals Pharmaceuticals (LHP)', 50, '2024-09-02', '2024-07-22', NULL),
	(31, 'Cetirizine (10 mg)', 'Glucophage ', 100, '2024-12-22', '2024-07-22', NULL),
	(32, 'Aspirin( 75 mg)', 'Cipla Pharmaceuticals', 100, '2025-02-22', '2024-07-22', NULL),
	(33, 'Lisinopril( 10 mg)', 'Ceycold ', 90, '2025-03-22', '2024-07-22', NULL),
	(34, 'Acetaminophen (Paracetamol 50mg)', 'Tylenol', 0, '2025-09-22', '2024-07-22', '2024-07-22'),
	(35, 'Guaifenesin(20mg)', 'Mucinex Children’s', 0, '2025-02-22', '2024-07-22', '2024-07-22'),
	(36, 'Diphenhydramine(20mg)', ' Benadryl Children’s', 0, '2024-08-22', '2024-07-22', '2024-07-22'),
	(37, 'Lactulose(20mg)', 'Enulose.', 10, '2024-08-08', '2024-07-22', NULL),
	(38, 'Hydrocortisone Cream (10mg)', 'Aquaphor', 0, '2024-10-22', '2024-07-22', '2024-07-22'),
	(39, 'Cetirizine(10mg)', 'Ceyoka Health', 100, '2025-01-22', '2024-07-22', NULL),
	(40, 'piriton(20mg)', 'Swiss Pharma (Pvt) Ltd:', 50, '2024-08-10', '2024-07-23', NULL),
	(41, 'Paracetamol(500mg)', 'Cipla Sri Lanka', 500, '2025-04-11', '2024-07-24', NULL),
	(42, 'claritin(20mg)', 'Swiss Pharma (Pvt) Ltd:', 10, '2024-08-07', '2024-07-24', NULL),
	(43, 'Loratadine(40mg)', 'Cipla Pharmaceuticals (Pvt) Ltd', 300, '2024-12-29', '2024-07-29', NULL),
	(44, 'Antiporter drops(100ml)', 'Hemas Pharmaceuticals', 5, '2024-08-12', '2024-07-29', NULL),
	(45, 'Paracetamol(500mg)', 'Cipla Pharmaceuticals (Pvt) Ltd', 20, '2024-08-15', '2024-08-01', NULL);

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
) ENGINE=InnoDB AUTO_INCREMENT=34 DEFAULT CHARSET=utf8mb3;

-- Dumping data for table healthcare.medicines_recode: ~14 rows (approximately)
INSERT INTO `medicines_recode` (`id`, `patientDetails_id`, `medicine_id`, `qty`, `date`) VALUES
	(1, 1, 1, 5, '2024-07-14'),
	(2, 3, 9, 10, '2024-07-14'),
	(3, 9, 11, 20, '2024-07-14'),
	(4, 5, 17, 10, '2024-07-14'),
	(5, 7, 6, 10, '2024-07-14'),
	(6, 11, 2, 500, '2024-07-14'),
	(7, 8, 3, 10, '2024-07-22'),
	(8, 8, 5, 10, '2024-07-22'),
	(9, 8, 24, 10, '2024-07-22'),
	(10, 10, 36, 10, '2024-07-22'),
	(11, 10, 11, 10, '2024-07-22'),
	(12, 10, 6, 10, '2024-07-22'),
	(13, 12, 1, 10, '2024-07-22'),
	(14, 12, 6, 10, '2024-07-22'),
	(15, 12, 20, 10, '2024-07-22'),
	(16, 13, 34, 10, '2024-07-22'),
	(17, 13, 35, 5, '2024-07-22'),
	(18, 13, 16, 10, '2024-07-22'),
	(19, 13, 37, 10, '2024-07-22'),
	(20, 13, 38, 5, '2024-07-22'),
	(21, 14, 22, 10, '2024-07-22'),
	(22, 14, 21, 5, '2024-07-22'),
	(23, 14, 13, 10, '2024-07-22'),
	(24, 15, 23, 10, '2024-07-22'),
	(25, 15, 28, 10, '2024-07-22'),
	(26, 15, 29, 10, '2024-07-22'),
	(27, 15, 30, 10, '2024-07-22'),
	(28, 15, 33, 10, '2024-07-22'),
	(29, 17, 7, 10, '2024-07-22'),
	(30, 17, 8, 10, '2024-07-22'),
	(31, 17, 14, 10, '2024-07-22'),
	(32, 17, 18, 10, '2024-07-22'),
	(33, 6, 13, 10, '2024-07-29');

-- Dumping structure for table healthcare.mlt_equipments
CREATE TABLE IF NOT EXISTS `mlt_equipments` (
  `id` int NOT NULL AUTO_INCREMENT,
  `name` varchar(100) DEFAULT NULL,
  `quantity` int DEFAULT NULL,
  `purchase_date` date DEFAULT NULL,
  `avalable_quantity` int DEFAULT NULL,
  `expire_date` date DEFAULT NULL,
  `view` int DEFAULT '1',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=50 DEFAULT CHARSET=utf8mb3;

-- Dumping data for table healthcare.mlt_equipments: ~22 rows (approximately)
INSERT INTO `mlt_equipments` (`id`, `name`, `quantity`, `purchase_date`, `avalable_quantity`, `expire_date`, `view`) VALUES
	(1, 'test tube', 16, '2024-07-18', 16, NULL, 1),
	(2, 'silinger', 9, '2024-07-18', 0, NULL, 0),
	(3, 'Syringes and Needles', 500, '2024-07-13', 0, NULL, 1),
	(4, 'Vacutainer Tubes', 1100, '2024-07-13', 50, NULL, 1),
	(5, 'Tourniquets', 30, '2024-07-24', 25, NULL, 1),
	(6, 'Alcohol Swabs', 1550, '2024-07-18', 1550, NULL, 1),
	(7, 'Gloves', 380, '2024-07-18', 380, NULL, 1),
	(8, 'Microhematocrit Tubes', 500, '2024-07-13', 480, NULL, 1),
	(9, 'Blood Sample Racks', 10, '2024-07-13', 10, NULL, 1),
	(10, 'Blood Gas Analyzer', 5, '2024-07-13', 3, NULL, 1),
	(11, 'Quality Control Materials', 200, '2024-07-14', 200, NULL, 1),
	(12, 'Electrophoresis', 3, '2024-07-14', 2, NULL, 1),
	(13, 'Compound microscopes', 2, '2024-07-14', 2, NULL, 1),
	(14, 'Microscope slides', 2, '2024-07-14', 2, NULL, 1),
	(15, 'Coverslips', 5, '2024-07-24', 5, NULL, 1),
	(16, 'Blood culture bottles', 40, '2024-07-14', 20, NULL, 1),
	(17, 'Automated blood culture system', 1, '2024-07-14', 1, NULL, 1),
	(18, 'Microhematocrit Centrifuge', 1, '2024-07-14', 1, NULL, 1),
	(19, 'Glucometer', 2, '2024-07-14', 2, NULL, 1),
	(20, 'Barcode Scanner and Printer', 1, '2024-07-14', 0, NULL, 1),
	(21, 'Hemoglobinometer', 1, '2024-07-14', 0, NULL, 1),
	(22, 'Capillary Tube Sealer', 5, '2024-07-14', 3, NULL, 1),
	(23, 'Laminar Flow Hood', 4, '2024-07-14', 4, NULL, 1),
	(24, 'Biohazard waste', 2, '2024-07-14', 0, NULL, 1),
	(25, 'Safety goggles and lab coats', 1, '2024-07-14', 1, NULL, 1),
	(26, 'Pipettes', 10, '2024-07-14', 9, NULL, 1),
	(27, 'Pipette tips', 12, '2024-07-14', 12, NULL, 1),
	(28, 'Protein electrophoresis equipment', 1, '2024-07-14', 1, NULL, 1),
	(29, 'Freezer for long-term storage', 1, '2024-07-14', 1, NULL, 1),
	(30, 'Refrigerator for sample storage', 1, '2024-07-14', 1, NULL, 1),
	(31, 'CO2 incubator', 1, '2024-07-14', 1, NULL, 1),
	(32, 'Basic chemistry analyzer', 1, '2024-07-14', 1, NULL, 1),
	(33, 'Electrolyte analyzer', 1, '2024-07-14', 1, NULL, 1),
	(34, 'Blood collection sets', 2, '2024-07-22', 2, NULL, 1),
	(35, 'Syringes', 10, '2024-07-14', 10, NULL, 1),
	(36, 'Microcentrifuge', 1, '2024-07-14', 1, NULL, 1),
	(37, 'Benchtop centrifuge', 1, '2024-07-14', 1, NULL, 1),
	(38, '	silinger', 20, '2024-07-18', 20, NULL, 1),
	(39, 'Anti-D (50ml)', 10, '2024-06-18', 5, '2024-07-19', 0),
	(40, 'Anti-B (50ml)', 12, '2024-07-19', 12, '2024-08-11', 1),
	(41, 'Anti-B (50ml)', 2, '2024-07-19', 0, '2024-07-19', 0),
	(42, 'Anti-B (50ml)', 5, '2024-07-19', 5, '2024-08-04', 1),
	(43, 'Benzene(50ml)', 2, '2024-07-19', 2, '2024-07-22', 1),
	(44, 'Benzene(50ml)', 2, '2024-07-19', 2, '2024-07-24', 1),
	(45, 'Ethylenediaminetetraacetic acid (EDTA 100ml)((', 5, '2024-07-22', 5, '2024-11-22', 1),
	(46, 'Heparin(20ml)', 3, '2024-07-22', 3, '2024-07-22', 1),
	(47, 'Sodium Citrate(2mg)', 10, '2024-07-22', 10, '2024-09-07', 1),
	(48, 'Hydrogen Peroxide (H2O2)(50ml)', 10, '2024-07-22', 10, '2024-10-22', 1),
	(49, 'Phenol Red (50ml)', 10, '2024-07-29', 10, '2024-11-29', 1);

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
) ENGINE=InnoDB AUTO_INCREMENT=24 DEFAULT CHARSET=utf8mb3;

-- Dumping data for table healthcare.patients_details: ~16 rows (approximately)
INSERT INTO `patients_details` (`id`, `patients_id`, `age`, `reception_id`, `symptoms`, `medical_report`, `Prescriptions`, `Prescriptions_date`, `doctor_id`, `symptoms_date`, `medicine_status`) VALUES
	(1, 1, 56, '1990563467', 'High Blood Pressure\nHypertension', 'no', 'aspirine', '2024-07-14 14:36:09', '1988235678', '2024-07-13 17:03:38', 'true'),
	(2, 2, 48, '1990563467', 'Diabetes\nHigh blood sugar', 'yes', '', NULL, '0000000000', '2024-07-13 17:05:52', 'pending'),
	(3, 3, 50, '1990563467', ' High Cholesterol\n', 'no', 'Atorvastatin (10mg)\r\n one tablet daily', '2024-07-13 22:37:20', '1988235678', '2024-07-13 17:07:20', 'true'),
	(4, 4, 12, '1990563467', 'Cough', 'no', 'piriton\r\nsetrepcil\r\n', '2024-07-13 22:38:41', '1988235678', '2024-07-13 17:09:04', 'Medication cancelled'),
	(5, 5, 15, '1990563467', 'Fever and Pain', 'no', 'penadol (500mg)/5 b/d \r\npiriton\r\n', '2024-07-13 22:35:03', '1988235678', '2024-07-13 17:10:15', 'true'),
	(6, 6, 70, '1990563467', 'Osteoporosis', 'no', 'Ciprofloxacin(250mg)	\r\nCiprofloxacin(500mg)	\r\nCiprofloxacin(750mg)	\r\nAmlodipine(5mg)	\r\nOmeprazole(20mg)	\r\nOmeprazole(20mg)	\r\nIbuprofen(400 mg)', '2024-07-29 10:07:45', '1988235678', '2024-07-13 17:12:55', 'true'),
	(7, 7, 7, '1990563467', 'Upset Stomach\n', 'no', 'paracitamol(500mg)/ 5/b,d', '2024-07-14 22:43:24', '1988235678', '2024-07-13 17:17:22', 'true'),
	(8, 8, 34, '1990563467', ' Nausea', 'she is under my care for nausea she is recommended 02 days leave from 2024.0723/2024.07.25', 'Ciprofloxacin(250mg)/b/d\r\nLoratadine (10 mg)\r\nMorphine Sulfate(200mg)\r\n                                        1/10	', '2024-07-22 15:47:54', '1988235678', '2024-07-13 17:27:38', 'true'),
	(9, 5, 15, '1990563467', 'fever \nheadaches\ncold\ncough\n', 'In 13^th 2024, Ms S.G. Thashmila suffering from fever,cough,cold and headaches. ', 'penadol(500mg) -( 2 each every 6 hours - 10 pills - after b/d )\r\npiriton(20mg)/ ( 1/2each - 10 pills - after b/d )\r\ncertercine(20mg)/ ( 1/2 each - 10 pills - after b/d )\r\n', '2024-07-13 23:00:26', '1988235678', '2024-07-13 22:31:27', 'true'),
	(10, 1, 56, '1990563467', 'Allergic Conjunctivitis', 'no', 'Diphenhydramine(20mg\r\nCiprofloxacin(250mg\r\nLoratadine (10 mg)\r\n                                1/10', '2024-07-22 15:49:46', '1988235678', '2024-07-14 22:42:00', 'true'),
	(11, 3, 50, '1990563467', 'high blood presure', 'no', 'Ciprofloxacin - 500 mg/ 10/b,d', '2024-07-14 22:44:10', '1988235678', '2024-07-14 22:42:20', 'true'),
	(12, 7, 7, '1990563467', 'fever', 'she is under my care for viral fever he is recommended two days leave from 2024.07.22/2024.07.23 ', 'Paracetamol(500mg- 6 of 6 hours\r\nAspirin(20mg)-b/d\r\nIbuprofen(400 mg/ d\r\n                              2/10\r\n\r\n', '2024-07-22 15:43:45', '1988235678', '2024-07-17 13:22:22', 'true'),
	(13, 9, 12, '1990563467', 'Allergies', 'no', 'Acetaminophen (Paracetamol) \r\nGuaifenesin(20mg) 	\r\nDiphenhydramine(20mg)\r\nLactulose(20mg)	 \r\nHydrocortisone Cream (10mg) \r\n                                                  1/10/b/d', '2024-07-22 16:37:13', '1988235678', '2024-07-22 15:56:13', 'true'),
	(14, 10, 14, '1990563467', 'Fever and Pain\nCough and Cold\nEczema\n', 'This is a certify that MR. Hirusha is under my care for fever. He is recommended two days leave from 2024,07.22', 'Ibuprofen(400 mg)\r\nLevothyroxine(0.05mg)\r\nSalbutamol(4mg)\r\n', '2024-07-22 17:04:05', '1988235678', '2024-07-22 16:03:07', 'true'),
	(15, 2, 48, '1990563467', 'fever, Pain, inflammation', 'no', 'Simvastatin(20 mg)\r\nLosartan (50 mg) \r\nMetronidazole(400mg)	\r\nCetirizine (10 mg) 	\r\nAspirin( 75 mg\r\nLisinopril( 10 mg\r\n                            1/10/b/d', '2024-07-22 16:38:52', '1988235678', '2024-07-22 16:04:04', 'true'),
	(16, 11, 67, '1990563467', ' High blood pressure', 'yes', '', NULL, '0000000000', '2024-07-22 16:05:46', 'pending'),
	(17, 12, 64, '1990563467', 'xxxxxxx', 'no', 'Amoxicillin(500mg)\r\nMetformin(500mg)\r\nCiprofloxacin(500mg\r\nOmeprazole(20mg)', '2024-07-22 17:29:27', '1988235678', '2024-07-22 16:34:23', 'true'),
	(18, 12, 64, '1990563467', 'fever\nmild to moderate pain\n\n', 'no', 'Paracetamol(500mg)\r\nAspirin(20mg)\r\nAmoxicillin(500mg\r\nCetirizine (10 mg)\r\n                   (b/d,1/10)', '2024-07-24 17:12:26', '1988235678', '2024-07-23 06:25:00', 'pending'),
	(19, 13, 26, '1990563467', 'fever', 'xxx', 'Paracetamol(500mg) \r\nDexamethasone(4mg)	\r\nCiprofloxacin(500mg)\r\nMetformin(500mg)	\r\nMorphine Sulfate(200mg)	\r\nAspirin(20mg)\r\nAmoxicillin(500mg) 1/10', '2024-07-28 11:31:16', '1988235678', '2024-07-25 10:20:00', 'pending'),
	(20, 13, 26, '1990563467', 'cholostrol', 'no', '', NULL, '0000000000', '2024-07-28 11:35:41', 'pending'),
	(21, 12, 64, '1990563467', 'suger', 'no', '', NULL, '0000000000', '2024-07-28 11:35:53', 'pending'),
	(22, 14, 24, '1990563467', 'fever', 'yes', '', NULL, '0000000000', '2024-07-29 10:03:05', 'pending'),
	(23, 15, 24, '1990563467', 'fever', 'no', '', NULL, '0000000000', '2024-08-01 09:28:29', 'pending');

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

-- Dumping data for table healthcare.registered_doctor: ~5 rows (approximately)
INSERT INTO `registered_doctor` (`id_num`, `name`, `email`, `mobile`, `password`, `verification_code`, `register_date`, `status`, `age`, `address`, `image`) VALUES
	('0000000000', 'none', 'none', 'none', NULL, NULL, '2024-06-17 00:38:59', 1, NULL, NULL, NULL),
	('19847860097', 'anoja jothirathne', 'anoja@wyb.ac.lk', '07089674532', '95e210cdc10f66d5bcf23dc1cf7ad8e5d1dd9f4356dfd4f5bfc9892498de52b1', NULL, '2024-07-29 10:01:06', 1, 40, 'No10,kegalle', NULL),
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
	('195678904532', NULL, 'mlt@gmail.com', NULL, 'e3521a43a01e9b046dc8507f5b18142d8aca68e6d54af2a71fd044cdb6873fb2', NULL, '2024-07-24 14:51:52', 1, NULL, NULL, NULL),
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
) ENGINE=InnoDB AUTO_INCREMENT=16 DEFAULT CHARSET=utf8mb3;

-- Dumping data for table healthcare.registered_patients: ~10 rows (approximately)
INSERT INTO `registered_patients` (`p_id`, `name`, `mobile`, `email`, `id_num`, `address`, `age`, `register_date`, `reception_id`) VALUES
	(1, 'K.G.perera', '07089674532', '', '1968567890', 'No 67,Kegalle', 56, '2024-07-13 17:03:38', '1990563467'),
	(2, 'V.G.Kumari', '07845233478', 'kumari@gmail.com', '1976236789', 'No 36/1, hettimulla', 48, '2024-07-13 17:05:52', '1990563467'),
	(3, 'S.silva', '07056789023', '', '1974457890', 'No 45,kegalle', 50, '2024-07-23 06:29:22', '1990563467'),
	(4, 'K.R.rashminda Hirushan', '0356789123', '', '', 'No 66, Minuwangamuwa', 12, '2024-07-13 17:09:04', '1990563467'),
	(5, 'S.G.Thashmila ', '0712345789', '', '', 'No 255/2, Moradana', 15, '2024-07-13 17:10:15', '1990563467'),
	(6, 'K.P. Karunawathi', '0351234781', '', '1954678905', 'No 25,Moronthota,Kegalle', 70, '2024-07-13 17:12:55', '1990563467'),
	(7, 'A.R.Sanduni Bgaya', '07845233478', '', '', 'Nikapitya,Kegalle', 7, '2024-07-13 17:17:22', '1990563467'),
	(8, 'Shanika Nirmani', '0765434670', 'shani@gmail.com', '1990567845', 'No56/9,  ', 34, '2024-07-13 17:27:38', '1990563467'),
	(9, 'K.S.Rashmi Anjalee', '07089674532', '', '', 'No  34, Hettimulla ', 12, '2024-07-22 15:56:13', '1990563467'),
	(10, 'G.P. hirusha', '0765434670', '', '', 'hettimulla,kegalle', 14, '2024-07-22 16:03:07', '1990563467'),
	(11, 'S. Gunaraththne', '0785634567', '', '1956789087', 'No10,kegalle', 67, '2024-07-22 16:05:46', '1990563467'),
	(12, 'S.M. Perera', '0765434670', 'perera@gamil.com', '1960897654', 'kegalle', 64, '2024-07-22 16:34:23', '1990563467'),
	(13, 'Y.R. sanduni', '07089674532', 'sanduni@gmail.com', '1998675467', 'No 45,kegalle', 26, '2024-07-25 10:20:00', '1990563467'),
	(14, 'S.T.Thathsarani', '0785634567', 'thathsarani@gmail.com', '2000065105678', 'No45,colombo', 24, '2024-07-29 10:03:28', '1990563467'),
	(15, 'E.R.K.Chathurangi Bandara', '0765434670', 'krishanibandara43@gmail.com', '2000234567', 'meedeniya,hettimulla', 24, '2024-08-01 09:28:29', '1990563467');

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
	('1978345678', 'Kamal Ekanayaka', 'chathurangibandara05@gmail.com', '0708945671', '4669590396f9689d0d3f8ed605b05ffeebfd511cce05b5fe4d57e9c21e7e8751', NULL, '2024-06-28 18:20:06', 1, 45, 'paragammana', NULL),
	('20000897645', 'kasuni perera', 'chalithachamod3031@gmail.com', '07845233478', 'f63e7ba71de88a877e320318d0112356c381276dc6b6a58381726bef4bbc1481', NULL, '2024-07-27 19:47:25', 1, 24, 'No 45,kegalle', NULL);

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
	('1990563467', 'No10,kegalle', 'sanduni kaushalya', 'krishanibandara43@gmail.com', '07089674532', '7292d5933867caddd46f3c3674917146ecf8fc8162a22457e3fd13f6038855dc', NULL, '2024-07-28 11:19:34', NULL, 1, 34);

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
