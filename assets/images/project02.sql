-- --------------------------------------------------------
-- Host:                         127.0.0.1
-- Server version:               10.4.21-MariaDB - mariadb.org binary distribution
-- Server OS:                    Win64
-- HeidiSQL Version:             12.7.0.6850
-- --------------------------------------------------------

/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET NAMES utf8 */;
/*!50503 SET NAMES utf8mb4 */;
/*!40103 SET @OLD_TIME_ZONE=@@TIME_ZONE */;
/*!40103 SET TIME_ZONE='+00:00' */;
/*!40014 SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0 */;
/*!40101 SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='NO_AUTO_VALUE_ON_ZERO' */;
/*!40111 SET @OLD_SQL_NOTES=@@SQL_NOTES, SQL_NOTES=0 */;


-- Dumping database structure for project02
CREATE DATABASE IF NOT EXISTS `project02` /*!40100 DEFAULT CHARACTER SET utf8mb4 */;
USE `project02`;

-- Dumping structure for table project02.events
CREATE TABLE IF NOT EXISTS `events` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `title` varchar(255) NOT NULL,
  `description` text NOT NULL,
  `start` datetime NOT NULL,
  `end` datetime NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=5 DEFAULT CHARSET=utf8mb4;

-- Dumping data for table project02.events: ~4 rows (approximately)
INSERT INTO `events` (`id`, `title`, `description`, `start`, `end`) VALUES
	(1, 'pet selling', 'new event', '2024-05-03 00:00:00', '2024-05-04 23:59:59'),
	(2, 'pet selling', 'new event', '2024-05-03 00:00:00', '2024-05-04 23:59:59'),
	(3, 'pet selling', 'new event', '2024-05-03 00:00:00', '2024-05-04 23:59:59'),
	(4, 'exhibition', 'special', '2024-05-22 00:00:00', '2024-05-24 23:59:59');

-- Dumping structure for table project02.pets
CREATE TABLE IF NOT EXISTS `pets` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `pet_type` varchar(50) DEFAULT NULL,
  `brand` varchar(50) DEFAULT NULL,
  `country` varchar(50) DEFAULT NULL,
  `age` int(11) DEFAULT NULL,
  `gender` enum('Male','Female') DEFAULT NULL,
  `price` decimal(10,2) DEFAULT NULL,
  `description` text DEFAULT NULL,
  `image` varchar(255) DEFAULT NULL,
  `status` varchar(10) DEFAULT 'stock',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=37 DEFAULT CHARSET=utf8mb4;

-- Dumping data for table project02.pets: ~28 rows (approximately)
INSERT INTO `pets` (`id`, `pet_type`, `brand`, `country`, `age`, `gender`, `price`, `description`, `image`, `status`) VALUES
	(8, 'fish', 'gold fish', 'modives', 90, 'Male', 5000.00, 'no', '4.jpg', 'stock'),
	(10, 'dog', 'lionsheperd', 'modives', 8, 'Male', 8800.00, 'no', '6.jpg', 'stock'),
	(11, 'cat', 'Siamese', 'Thailand ', 1, 'Male', 8000.00, 'Known for their sleek, slender bodies, striking blue almond-shaped eyes, and distinctive color points on their ears, face, paws, and tail.', 'cat1.jpg', 'stock'),
	(12, 'cat', 'Maine Coon', 'united state', 3, 'Male', 12000.00, ' One of the largest domesticated cat breeds, Maine Coons have long, thick fur, tufted ears, and a bushy tail. They are known for their friendly and sociable nature.', 'cat2.jpg', 'stock'),
	(13, 'cat', 'Persian', 'Iran', 1, 'Male', 6000.00, 'Recognizable by their long, luxurious fur and flat, pushed-in faces, Persians are a popular breed known for their calm and gentle demeanor.', 'cat3.jpg', 'stock'),
	(14, 'cat', 'bengal', 'United States', 3, 'Male', 7000.00, 'Bengals have a wild appearance with large spots and rosettes reminiscent of a leopard\'s coat. They are active, playful, and intelligent cats.\r\n', 'cat4.jpg', 'stock'),
	(15, 'cat', 'British Shorthair', 'united kindom', 4, 'Female', 4000.00, 'Known for their dense, plush coat and round face with large, round eyes. They have a calm and affectionate nature.', 'cat5.jpg', 'stock'),
	(16, 'cat', 'Abyssinian', 'ithiopia', 2, 'Female', 5500.00, 'Recognizable by their short, ticked coat and active, playful demeanor. They have a slender, athletic build and are very curious.', 'cat6.webp', 'stock'),
	(17, 'dog', 'Labrador Retriever', 'canada', 1, 'Male', 10000.00, 'Friendly, outgoing, and high-spirited companions, Labradors are popular for their intelligence and trainability.', 'labrador.jpg', 'stock'),
	(18, 'dog', 'German Shepherd', 'germany', 3, 'Male', 20000.00, 'Known for their courage, loyalty, and guarding instincts, German Shepherds are highly versatile working dogs.', 'germen_shpeperd.jpg', 'stock'),
	(19, 'dog', 'Golden Retriever', 'scotland', 1, 'Female', 10000.00, ' Intelligent, friendly, and devoted, Golden Retrievers are popular family pets and excellent working dogs.', 'Golden Retriever.jpg', 'stock'),
	(20, 'dog', 'bulldog', 'England', 2, 'Female', 18000.00, 'Bulldogs have a distinctive wrinkled face and pushed-in nose. They are gentle, affectionate, and good with children.', 'Bulldog.jpg', 'stock'),
	(21, 'dog', 'Beagle', 'England', 1, 'Male', 16000.00, 'Small, sturdy, and known for their excellent sense of smell, Beagles are friendly, curious, and great with families.', 'Beagle.webp', 'stock'),
	(22, 'dog', 'Boxer', 'germany', 2, 'Female', 9000.00, 'Boxers are playful, energetic, and good with children. They have a distinctive square muzzle and strong build.\r\n', 'Boxer.jpg', 'stock'),
	(23, 'bird', 'Budgerigar', 'Australia', 1, 'Female', 3000.00, 'Small, social, and colorful parakeet, known for its ability to mimic human speech. Budgies are playful and thrive in pairs or flocks, making them great companions.', 'Budgerigar_bird.jpg', 'stock'),
	(24, 'bird', 'Cockatiel ', 'Australia', 2, 'Male', 5000.00, 'Friendly and affectionate bird with a distinctive crest, often enjoys whistling tunes. Cockatiels are known for their curious nature and can be trained to do simple tricks.', 'Cockatiel_bird.jpg', 'stock'),
	(25, 'bird', 'Lovebird', 'africa', 1, 'Male', 6000.00, 'Small, affectionate parrot known for its strong pair bonding and vibrant colors. Lovebirds are energetic and enjoy playing with toys and interacting with their owners.', 'Lovebird_bird.jpg', 'stock'),
	(26, 'bird', 'Macaw ', 'central and south america', 3, 'Female', 6000.00, 'Large, colorful parrot known for its striking plumage and loud calls, often very social. Macaws form strong bonds with their owners and need spacious environments to thrive.', 'Macaw_bird.jpg', 'stock'),
	(27, 'bird', 'Indian Ringneck Parakeet', 'South Asia', 4, 'Male', 5000.00, 'Medium-sized parakeet known for its striking ring around the neck and ability to mimic speech. These birds are intelligent, curious, and require regular mental stimulation.', 'Indian Ringneck Parakeet_bird.jpg', 'stock'),
	(28, 'bird', 'Zebra Finch', 'Australia', 1, 'Female', 4000.00, 'Small, lively bird with distinctive zebra-like stripes on its chest. Zebra finches are easy to care for and do well in pairs or small groups, making them ideal for beginners.', 'Zebra Finch bird.jpg', 'stock'),
	(29, 'Rabbit', 'Netherland Dwarf ', 'Netherlands', 1, 'Female', 5000.00, 'Smallest domestic rabbit breed, known for its tiny size and friendly temperament. They have a compact body and a short, dense coat, making them a popular pet choice.', 'Netherland Dwarf rabbit.jpg', 'stock'),
	(30, 'Rabbit', 'Holland Lop', 'Netherlands', 1, 'Male', 7000.00, 'Small rabbit with distinctive lopped ears and a playful, affectionate personality. They are known for their sweet nature and are great with families and children.\r\n', 'Holland Lop rabbit.jpg', 'stock'),
	(31, 'Rabbit', 'Mini Rex', 'United States', 3, 'Female', 6000.00, 'Characterized by its velvety, plush coat and friendly demeanor. Mini Rex rabbits are medium-sized and are known for their calm and gentle nature, making them ideal pets.', 'Mini Rex rabbit.jpg', 'stock'),
	(32, 'Rabbit', 'Lionhead', 'Belgium', 3, 'Male', 5000.00, 'Recognized by the mane of fur around its head, resembling a lion’s mane. Lionheads are small, energetic, and social rabbits that enjoy interaction with their owners.', 'Lionhead rabbit.jpg', 'stock'),
	(33, 'Rabbit', 'Flemish Giant', 'Belgium', 3, 'Female', 4000.00, 'One of the largest rabbit breeds, known for its gentle giant nature. Flemish Giants are friendly and can be very affectionate, making them great companions despite their size.', 'Flemish Giant rabbit.jpg', 'stock'),
	(34, 'Rabbit', 'French Lop ', 'France', 2, 'Male', 6000.00, 'Large rabbit with a muscular build and lopped ears, known for its docile nature. French Lops are affectionate and enjoy being around people, requiring a lot of space and exercise.', 'French Lop rabbit.webp', 'stock'),
	(35, 'Rabbit', 'Dutch Rabbit', 'Netherlands', 4, 'Male', 8000.00, 'Medium-sized rabbit known for its distinctive color pattern with a white blaze and saddle. Dutch rabbits are friendly, easy to handle, and make excellent pets for families.', 'Dutch Rabbit.jpg', 'stock'),
	(36, 'Rabbit', 'Mini Lop', 'germany', 1, 'Male', 3000.00, 'Small, stocky rabbit with lopped ears and a sweet, affectionate personality. Mini Lops are playful and enjoy attention, making them great companions for pet owners of all ages.', 'Mini Lop rabbit.jpg', 'stock');

-- Dumping structure for table project02.transactions
CREATE TABLE IF NOT EXISTS `transactions` (
  `id` int(10) NOT NULL AUTO_INCREMENT,
  `user_id` int(10) NOT NULL,
  `pet_id` int(10) NOT NULL,
  `trace_no` varchar(50) NOT NULL,
  `date_time` datetime NOT NULL,
  PRIMARY KEY (`id`),
  KEY `FK_transactions_users` (`user_id`),
  KEY `FK_transactions_pets` (`pet_id`),
  CONSTRAINT `FK_transactions_pets` FOREIGN KEY (`pet_id`) REFERENCES `pets` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  CONSTRAINT `FK_transactions_users` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=42 DEFAULT CHARSET=utf8mb4;

-- Dumping data for table project02.transactions: ~0 rows (approximately)

-- Dumping structure for table project02.users
CREATE TABLE IF NOT EXISTS `users` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `first_name` varchar(50) NOT NULL,
  `last_name` varchar(50) NOT NULL,
  `address` varchar(255) NOT NULL,
  `dob` date NOT NULL,
  `age` int(11) NOT NULL,
  `nic` varchar(20) NOT NULL,
  `email` varchar(100) NOT NULL,
  `contact_number` varchar(15) NOT NULL,
  `gender` enum('male','female') NOT NULL,
  `password` varchar(255) NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=17 DEFAULT CHARSET=utf8mb4;

-- Dumping data for table project02.users: ~16 rows (approximately)
INSERT INTO `users` (`id`, `first_name`, `last_name`, `address`, `dob`, `age`, `nic`, `email`, `contact_number`, `gender`, `password`, `created_at`) VALUES
	(1, 'dinoshi', 'sewwandi', 'no 04,madugasthenna,maharathenna,menikhinna', '2024-05-08', 44, '200152501358', 'dinoshi@gmail.com', '0765609128', 'female', '$2y$10$ZTQeb0368Hns1vM5qTx.uO0tcLuDFblM4Sj4mLusWX9T3texy4TEe', '2024-05-24 16:30:52'),
	(2, 'dinoshi', 'sewwandi', 'no 04,madugasthenna,maharathenna,menikhinna', '2024-05-09', 22, '200152501358', 'dinosewwandi@gmail.com', '0765609128', 'female', '$2y$10$WZfFEtUYfc21c0HlRAtRhuxvByNiprRMShlceDTRFWgKI.TFiQlz6', '2024-05-24 19:45:55'),
	(3, 'John', 'Doe', '123 Main St', '1980-05-15', 44, 'NIC123456', 'john.doe@example.com', '555-1234', 'male', 'password123', '2024-05-25 11:36:42'),
	(4, 'Jane', 'Smith', '456 Oak Ave', '1992-08-22', 31, 'NIC654321', 'jane.smith@example.com', '555-5678', 'female', 'password456', '2024-05-25 11:36:42'),
	(5, 'Alice', 'Johnson', '789 Pine Rd', '1985-12-05', 38, 'NIC112233', 'alice.johnson@example.com', '555-8765', 'female', 'password789', '2024-05-25 11:36:42'),
	(6, 'Bob', 'Brown', '321 Cedar Ln', '1975-03-10', 49, 'NIC445566', 'bob.brown@example.com', '555-4321', 'male', 'password101', '2024-05-25 11:36:42'),
	(7, 'Charlie', 'Davis', '654 Spruce St', '1990-07-14', 33, 'NIC778899', 'charlie.davis@example.com', '555-7890', 'male', 'password202', '2024-05-25 11:36:42'),
	(8, 'Emily', 'Clark', '987 Willow Blvd', '1987-11-20', 36, 'NIC334455', 'emily.clark@example.com', '555-0987', 'female', 'password303', '2024-05-25 11:36:42'),
	(9, 'David', 'Lopez', '123 Maple St', '1995-04-02', 29, 'NIC556677', 'david.lopez@example.com', '555-6789', 'male', 'password404', '2024-05-25 11:36:42'),
	(10, 'Emma', 'Martinez', '456 Birch Dr', '1982-01-18', 42, 'NIC990011', 'emma.martinez@example.com', '555-1239', 'female', 'password505', '2024-05-25 11:36:42'),
	(11, 'Michael', 'Garcia', '789 Elm St', '1989-09-09', 34, 'NIC223344', 'michael.garcia@example.com', '555-3456', 'male', 'password606', '2024-05-25 11:36:42'),
	(12, 'Olivia', 'Wilson', '321 Pine Ave', '1993-06-30', 30, 'NIC667788', 'olivia.wilson@example.com', '555-6543', 'female', 'password707', '2024-05-25 11:36:42'),
	(13, 'ridmi', 'ketayamge', 'kegalle', '2000-12-28', 23, '20000000', 'ridmi@gmail.com', '464557568', 'female', '$2y$10$8deb16J9yv3.8F6ANRFbUOv9Gr7q0ZZhgW4joNA64nE.7CmJMTA6C', '2024-05-25 16:34:20'),
	(14, 'lasitha', 'akalanka', 'menikhinna', '2004-12-05', 20, '200456783', 'lasitha@gmail.com', '0702204003', 'male', '$2y$10$mgXvS9LQsO8cpw4o9lSKguVPkhL8Zis4cTyGHoxgP.YnogRvYMMY6', '2024-05-31 10:48:54'),
	(15, 'wathsala', 'rathnayake', 'digana.kandy', '2000-12-12', 80, '34545', 'wathsala@gmail.com', '0765609128', 'female', '$2y$10$1bcX0qWaBHNo8cuTuM9WxO4uONh65/KarMAdyBAlmqVj/3G5JO3YG', '2024-05-31 10:56:59'),
	(16, 'nox', 'dev', 'NoxStudio', '2000-07-13', 23, '200000000000', 'noxstudios66@gmail.com', '0711111111', 'male', '$2y$10$89lhoZNFVGgDNLJ13iIRh.MoimVfwSUv4W4hj6nEfj16zL2KTd9sa', '2024-06-08 23:57:10');

/*!40103 SET TIME_ZONE=IFNULL(@OLD_TIME_ZONE, 'system') */;
/*!40101 SET SQL_MODE=IFNULL(@OLD_SQL_MODE, '') */;
/*!40014 SET FOREIGN_KEY_CHECKS=IFNULL(@OLD_FOREIGN_KEY_CHECKS, 1) */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40111 SET SQL_NOTES=IFNULL(@OLD_SQL_NOTES, 1) */;
