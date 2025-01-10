-- --------------------------------------------------------
-- Host:                         127.0.0.1
-- Server version:               8.0.30 - MySQL Community Server - GPL
-- Server OS:                    Win64
-- HeidiSQL Version:             12.1.0.6537
-- --------------------------------------------------------

/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET NAMES utf8 */;
/*!50503 SET NAMES utf8mb4 */;
/*!40103 SET @OLD_TIME_ZONE=@@TIME_ZONE */;
/*!40103 SET TIME_ZONE='+00:00' */;
/*!40014 SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0 */;
/*!40101 SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='NO_AUTO_VALUE_ON_ZERO' */;
/*!40111 SET @OLD_SQL_NOTES=@@SQL_NOTES, SQL_NOTES=0 */;


-- Dumping database structure for realestatemanagamentsystem
CREATE DATABASE IF NOT EXISTS `realestatemanagamentsystem` /*!40100 DEFAULT CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci */ /*!80016 DEFAULT ENCRYPTION='N' */;
USE `realestatemanagamentsystem`;

-- Dumping structure for table realestatemanagamentsystem.inquiries
CREATE TABLE IF NOT EXISTS `inquiries` (
  `id` int NOT NULL AUTO_INCREMENT,
  `property_id` int DEFAULT NULL,
  `inquiry_name` varchar(255) DEFAULT NULL,
  `inquiry_number` varchar(20) DEFAULT NULL,
  `inquiry_email` varchar(255) DEFAULT NULL,
  `inquiry_message` text,
  `inquiry_status` varchar(50) CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci NOT NULL DEFAULT 'pending',
  `date_added` datetime DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `property_id` (`property_id`),
  CONSTRAINT `inquiries_ibfk_1` FOREIGN KEY (`property_id`) REFERENCES `properties` (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=6 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

-- Dumping data for table realestatemanagamentsystem.inquiries: ~1 rows (approximately)
REPLACE INTO `inquiries` (`id`, `property_id`, `inquiry_name`, `inquiry_number`, `inquiry_email`, `inquiry_message`, `inquiry_status`, `date_added`) VALUES
	(5, 26, 'John Doe', '09261232293', 'john.doe@gmail.com', 'Can you provide more information on the square footage of the property?', 'pending', NULL);

-- Dumping structure for table realestatemanagamentsystem.inventory
CREATE TABLE IF NOT EXISTS `inventory` (
  `id` int unsigned NOT NULL AUTO_INCREMENT,
  `property_id` int DEFAULT NULL,
  `fullname` varchar(50) DEFAULT NULL,
  `contact` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci DEFAULT NULL,
  `address` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci DEFAULT NULL,
  `payment_method` varchar(50) DEFAULT NULL,
  `amount` decimal(20,6) NOT NULL DEFAULT '0.000000',
  `change` decimal(20,6) NOT NULL DEFAULT '0.000000',
  `remark` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci DEFAULT NULL,
  `status` varchar(50) DEFAULT NULL,
  `date_added` timestamp NULL DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`),
  KEY `property_id` (`property_id`)
) ENGINE=InnoDB AUTO_INCREMENT=11 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

-- Dumping data for table realestatemanagamentsystem.inventory: ~10 rows (approximately)
REPLACE INTO `inventory` (`id`, `property_id`, `fullname`, `contact`, `address`, `payment_method`, `amount`, `change`, `remark`, `status`, `date_added`) VALUES
	(1, 25, 'John Erick Gofredo', 'johnerickgofredo@gmail.com', 'San Miguel', 'Cash', 600000.000000, 0.000000, 'Completed', NULL, '2024-12-01 05:17:48'),
	(2, 28, 'Karl Cabuguas', 'karlcabuguas@gmail.com', 'San Pedro St', 'Credit Card', 2532000.000000, 0.000000, 'Completed', NULL, '2024-01-01 05:19:50'),
	(3, 22, 'john.doe1', 'john.doe1234@gmail.com', '456 Oak Avenue, Los Angeles, CA 90001', 'Cash', 325000.000000, 0.000000, 'Completed', NULL, '2024-03-03 07:08:18'),
	(4, 23, 'robert miller', 'robert.miller7788@gmail.com', '123 Maple Street, Springfield, IL 62701', 'Cash', 450000.000000, 0.000000, '', NULL, '2024-04-03 07:08:59'),
	(5, 26, 'Linda Garcia', 'linda.garcia9900@gmail.com', '654 Cedar Lane, New York, NY 10001', 'Cash', 300000.000000, 0.000000, '', NULL, '2024-05-03 07:09:31'),
	(6, 26, 'Lisa Martin', 'lisa.martin4455@gmail.com', '987 Elm Drive, Chicago, IL 60601', 'Credit Card', 300000.000000, 0.000000, '', NULL, '2024-07-03 07:10:35'),
	(7, 27, 'David Brown', 'david.brown3344@gmail.com', '111 Cherry Crescent, Atlanta, GA 30301', 'Digital Wallet', 525000.000000, 0.000000, '', NULL, '2024-12-03 07:11:27'),
	(8, 27, 'Sarah Williams', 'sarah.williams1122@gmail.com', '222 Willow Way, Boston, MA 02108', 'Credit Card', 525000.000000, 0.000000, '', NULL, '2024-11-03 07:16:03'),
	(9, 28, 'Emily Smith', 'emily.smith5678@gmail.com', '444 Ash Street, Seattle, WA 98101', 'Cash', 2532000.000000, 0.000000, '', NULL, '2024-10-03 07:17:40'),
	(10, 28, 'James Moore', 'james.moore2233@gmail.com', '111 Cherry Crescent, Atlanta, GA 30301', 'Digital Wallet', 2532000.000000, 0.000000, '', NULL, '2024-11-03 07:18:23');

-- Dumping structure for table realestatemanagamentsystem.news
CREATE TABLE IF NOT EXISTS `news` (
  `id` int NOT NULL AUTO_INCREMENT,
  `news_title` varchar(250) CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci NOT NULL,
  `news_content` text NOT NULL,
  `is_deleted` tinyint(1) DEFAULT '0',
  `date_added` timestamp NULL DEFAULT CURRENT_TIMESTAMP,
  `image` varchar(250) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=5 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

-- Dumping data for table realestatemanagamentsystem.news: ~4 rows (approximately)
REPLACE INTO `news` (`id`, `news_title`, `news_content`, `is_deleted`, `date_added`, `image`) VALUES
	(1, 'test', 'tests', 1, '2024-12-02 05:52:42', 'sample10.jpg'),
	(2, 'How AI is Shaping the Future of Everyday Life', 'Artificial Intelligence (AI) is revolutionizing our daily routines. From smarter healthcare systems that aid doctors in diagnosing diseases to autonomous vehicles improving road safety, AI is making life more efficient. In education, AI is personalizing learning experiences, while smart home devices are making our homes more convenient.', 0, '2024-12-02 16:45:38', '2.png'),
	(3, 'Exploring the 2024 Real Estate Market: Trends and Opportunities', 'The real estate market in 2024 is experiencing notable shifts, driven by evolving economic conditions and consumer preferences. With interest rates stabilizing, buyers and investors are cautiously returning to the market, looking for opportunities in both residential and commercial properties.\r\n\r\nOne of the key trends is the growing demand for suburban homes. With remote work becoming more permanent, many people are opting for larger spaces outside major cities. This shift has increased interest in suburban areas, offering more affordable options with room for growth.', 0, '2024-12-03 03:46:57', 'r.jpg'),
	(4, 'The Impact of Interest Rates on the 2024 Housing Market', 'As interest rates stabilize, both buyers and sellers are adjusting their strategies, making it a more balanced market for transactions in 2024.', 0, '2024-12-03 03:55:19', '3.jpg');

-- Dumping structure for table realestatemanagamentsystem.properties
CREATE TABLE IF NOT EXISTS `properties` (
  `id` int NOT NULL AUTO_INCREMENT,
  `name` varchar(255) NOT NULL,
  `description` text NOT NULL,
  `address` varchar(255) NOT NULL,
  `price` decimal(10,2) NOT NULL,
  `status` enum('available','sold','pending') CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci NOT NULL DEFAULT 'available',
  `image` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci DEFAULT NULL,
  `date_added` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `is_deleted` tinyint(1) NOT NULL DEFAULT '0',
  `transaction_type` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=33 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

-- Dumping data for table realestatemanagamentsystem.properties: ~9 rows (approximately)
REPLACE INTO `properties` (`id`, `name`, `description`, `address`, `price`, `status`, `image`, `date_added`, `is_deleted`, `transaction_type`) VALUES
	(21, 'Spacious Living Areas Home', ' Enjoy an open-concept layout with a bright and airy living room that flows seamlessly into the dining area, perfect for entertaining friends and family.', '321 Elm Avenue, Coral Springs, FL 33065', 230000.00, 'available', 'house-with-balcony.jpg', '2024-10-17 01:48:13', 1, 'sell'),
	(22, 'Cozy Cottage Retreat', 'This charming 3-bedroom, 2-bathroom cottage features a rustic design with modern amenities. Enjoy a spacious living room with a fireplace, a bright kitchen, and a large backyard perfect for outdoor activities.', ' 123 Cedar Lane, Asheville, NC 28801', 325000.00, 'sold', 'sample10.jpg', '2024-12-17 01:56:28', 0, 'rent'),
	(23, 'Contemporary Urban Loft', 'Experience city living in this stylish 2-bedroom, 2-bathroom loft. Features include high ceilings, large windows, and a sleek kitchen with stainless steel appliances. Located in the heart of downtown with easy access to shops and restaurants.', '456 Main Street, Chicago, IL 60601', 450000.00, 'sold', 'sample3.jpg', '2024-03-17 01:58:02', 0, 'sell'),
	(24, 'Luxurious Waterfront Estate', 'This stunning 6-bedroom, 5-bathroom estate offers breathtaking lake views. Enjoy an open floor plan, gourmet kitchen, and a private dock. Perfect for entertaining or a peaceful retreat.', '789 Lakeshore Drive, Miami, FL 33101', 1500000.00, 'sold', 'sample4.jpg', '2024-11-17 02:03:11', 0, 'sell'),
	(25, 'Spacious Family Home', ' A beautifully updated 4-bedroom, 3-bathroom home featuring a large backyard, two-car garage, and a cozy family room. Located in a quiet neighborhood close to schools and parks.', '321 Oakwood Drive, Seattle, WA 98101', 600000.00, 'sold', 'sample6.jpg', '2024-09-17 02:05:04', 0, 'sell'),
	(26, 'Elegant Townhouse', 'This lovely 3-bedroom, 2-bathroom townhouse offers modern finishes, a spacious layout, and a private patio. Located in a vibrant community with easy access to public transportation.', '654 Maple Street, Atlanta, GA 30301', 300000.00, 'available', 'sample7.jpg', '2024-05-17 02:06:11', 0, 'sell'),
	(27, 'Charming Historic Home', 'Step back in time with this beautifully restored 4-bedroom, 2-bathroom historic home. Features original hardwood floors, a grand staircase, and a large front porch. Close to downtown amenities.', '987 Elm Street, Boston, MA 02101', 525000.00, 'available', 'sample8.jpg', '2024-03-17 02:07:12', 0, 'sell'),
	(28, 'Elegant Ranch Style Home', 'This beautifully maintained 3-bedroom, 2-bathroom ranch-style home offers a cozy fireplace, an updated kitchen, and a large outdoor space. Perfect for families or retirees.', '876 Pine Lane, Portland, OR 97201', 2532000.00, 'available', 'sample9.jpg', '2024-01-17 02:07:57', 0, 'rent'),
	(29, 'Stylish Condo with Amenities', 'Enjoy luxury living in this modern 2-bedroom, 2-bathroom condo featuring a fitness center, rooftop pool, and secure parking. Located in a vibrant neighborhood close to nightlife and dining.', '543 Sunset Boulevard, Los Angeles, CA 90001', 500000.00, 'available', 'sample10.jpg', '2024-10-17 02:08:41', 1, 'sell');

-- Dumping structure for table realestatemanagamentsystem.user_account
CREATE TABLE IF NOT EXISTS `user_account` (
  `id` int unsigned NOT NULL AUTO_INCREMENT,
  `username` varchar(30) NOT NULL,
  `password` varchar(255) NOT NULL,
  `user_type` varchar(255) NOT NULL,
  `created_at` timestamp NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`),
  UNIQUE KEY `username` (`username`)
) ENGINE=InnoDB AUTO_INCREMENT=36 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

-- Dumping data for table realestatemanagamentsystem.user_account: ~24 rows (approximately)
REPLACE INTO `user_account` (`id`, `username`, `password`, `user_type`, `created_at`) VALUES
	(1, 'admin', '$2y$10$Xlu2ATaDcr851d5PYGo5T.A7vj6PwFtWjV0wcuJAaaj40/J2UYFs2', 'admin', '2024-10-09 20:07:14'),
	(2, '', '$2y$10$pEwVgOcaJBm.8pHgZx7riOF9.Fu4g6qf8coqxYo8rk0n5EN4dZXr6', 'regular', '2024-10-10 21:11:23'),
	(5, 'okay', '$2y$10$10OKZ.7cGNAqHaEw0C5dMeB2p24atkVIupgpTZPaM9LMXLet10vVm', 'regular', '2024-10-10 21:21:21'),
	(6, 'HELLO', '$2y$10$fuQR3MN4dhXqtMb4WPBwDOG2oqt3OlJ3bck9L0zXYsRGCB1KnSbCW', 'regular', '2024-10-10 21:23:10'),
	(7, 'F', '$2y$10$IG7oP/1bizvRsp/KKVjYau/fwQgw7lEyEa7536nCSo7ca7jzsGdjS', 'regular', '2024-10-11 16:07:21'),
	(8, 'EHLLO', '$2y$10$R8waJBtG9tbWiT4SoQ8q4uiI8bet9sTspHZQcFeA3P6M1PBGKJbsS', 'regular', '2024-10-11 16:07:44'),
	(9, 'try', '$2y$10$QwfkUz.XX0CDcLU28Y4PLO4DfFdVnrwOWsiHwbFYbMixYBniHd5Mm', 'regular', '2024-10-11 16:18:09'),
	(10, 'dsadsa', '$2y$10$bvCWLlTEeg5lBIBlQFNsCu7onN9410d5rFrwoALROaa6w7H3Z8Hxm', 'regular', '2024-10-11 16:31:10'),
	(11, 'v', '$2y$10$kl.WWsrt5c3FP3G7VARTC.BRJw562N2DaJfhrbugTURvWRFZ2JMU6', 'regular', '2024-10-11 16:31:33'),
	(12, 'n', '$2y$10$M5I8V0t8q7BdBe/KVWg3ouHGJP97rOq9yqcrfg4jn7skiNy3IDzXS', 'regular', '2024-10-11 16:44:09'),
	(14, 'm', '$2y$10$LN3d/ZIf0vShAOW4lEvl4OPGR8Uzo7BxVW.YRz9KzQhhw3u8gzZM.', 'regular', '2024-10-11 16:47:46'),
	(16, 'l', '$2y$10$pQiOfF4kwq5XhSBu/Xa7luKIsN6jmPI86yrDcqhxpVYYtaoX74i5O', 'regular', '2024-10-11 17:45:33'),
	(17, 'o', '$2y$10$bhs.aJ/eYfTPXlKdCMFzsem0K5MV4c8tQiZRAHT5ZahFfDZ2X5j8i', 'regular', '2024-10-11 17:46:34'),
	(18, 'qw', '$2y$10$Wi6dmxBq49GBux5RP.ludOiNx1xoyYsNyx8uhxG9NG28WIYjEAhh2', 'regular', '2024-10-11 17:47:05'),
	(19, 'p', '$2y$10$vbyu2SWyGo8Rftt0Ap.PueHmTkYGA1PPD4PwXLHLR9yBG7BxWX23a', 'regular', '2024-10-11 17:47:34'),
	(22, 'r', '$2y$10$R.Rp10w03VWVY8F7Z02Y4O/KO/Nb10upBvtXUuRkO8HTCsuswvmhS', 'regular', '2024-10-11 17:56:26'),
	(24, 'w', '$2y$10$HZ8FrPPmDLcHONJIfpq7B.VSgzX/8EI8FrZSyLqPaV52thJ5V71mW', 'regular', '2024-10-11 17:58:30'),
	(25, '123213213', '$2y$10$feke86jdrqDOHXEmigeCoehTp4CcCGcLt/QixJkCWKUTvtFFR1XAG', 'regular', '2024-10-11 18:00:17'),
	(27, 'lastome', '$2y$10$AGfSexx1NMTn40ZsZpjhT.wRmRnzlXRgNZ8q5YDZGtXxrWzHPt/M6', 'regular', '2024-10-11 19:08:01'),
	(29, 'taedsadsadsad', '$2y$10$pJNDMDI2.smOzFoTju/rH.n9lStQOQu0FHWfwR9QBnzPJR3o6Rreu', 'regular', '2024-10-11 19:13:05'),
	(32, 'sdsa', '$2y$10$/HqPqlg/LHdE5feqoAMQZuDzQmPIo6LGHNMxLxHkRPtQJoYLTmV1O', 'regular', '2024-10-11 19:25:08'),
	(33, 'ejhaygofredo', '$2y$10$.3NXbEIFtWuGKKyAnl/tquMAyNmHXzTRSEveMfmZiKgWybOwcbrrq', 'regular', '2024-10-11 19:53:24'),
	(34, 'regular', '$2y$10$Cg/ErP1OOihWZEkaOUsSyO6/6j4y2JD0Iw9ZfLyvbB9BTlAUNXwWi', 'regular', '2024-10-12 17:09:03'),
	(35, 'test123', '$2y$10$rlJDd84HxMv1HBHYlADeJe5O7bC4WUly2wn8OTCYG4Yc6N/Qwu7xa', 'regular', '2024-10-12 18:32:44');

/*!40103 SET TIME_ZONE=IFNULL(@OLD_TIME_ZONE, 'system') */;
/*!40101 SET SQL_MODE=IFNULL(@OLD_SQL_MODE, '') */;
/*!40014 SET FOREIGN_KEY_CHECKS=IFNULL(@OLD_FOREIGN_KEY_CHECKS, 1) */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40111 SET SQL_NOTES=IFNULL(@OLD_SQL_NOTES, 1) */;
