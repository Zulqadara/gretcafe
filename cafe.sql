-- --------------------------------------------------------
-- Host:                         127.0.0.1
-- Server version:               5.6.17 - MySQL Community Server (GPL)
-- Server OS:                    Win64
-- HeidiSQL Version:             9.4.0.5125
-- --------------------------------------------------------

/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET NAMES utf8 */;
/*!50503 SET NAMES utf8mb4 */;
/*!40014 SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0 */;
/*!40101 SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='NO_AUTO_VALUE_ON_ZERO' */;


-- Dumping database structure for cafe
CREATE DATABASE IF NOT EXISTS `cafe` /*!40100 DEFAULT CHARACTER SET latin1 */;
USE `cafe`;

-- Dumping structure for table cafe.admin
CREATE TABLE IF NOT EXISTS `admin` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(50) DEFAULT NULL,
  `password` varchar(50) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=latin1;

-- Dumping data for table cafe.admin: ~0 rows (approximately)
/*!40000 ALTER TABLE `admin` DISABLE KEYS */;
REPLACE INTO `admin` (`id`, `name`, `password`) VALUES
	(1, 'Margaret Mayor', '123');
/*!40000 ALTER TABLE `admin` ENABLE KEYS */;

-- Dumping structure for table cafe.food
CREATE TABLE IF NOT EXISTS `food` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(50) DEFAULT NULL,
  `type` varchar(50) DEFAULT NULL,
  `price` double DEFAULT NULL,
  `available` varchar(50) DEFAULT 'Yes',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=57 DEFAULT CHARSET=latin1;

-- Dumping data for table cafe.food: ~52 rows (approximately)
/*!40000 ALTER TABLE `food` DISABLE KEYS */;
REPLACE INTO `food` (`id`, `name`, `type`, `price`, `available`) VALUES
	(1, 'Mandazi', 'Snacks', 10, 'Yes'),
	(2, 'Doughnuts', 'Snacks', 20, 'Yes'),
	(3, 'Boiled Eggs', 'Snacks', 20, 'Yes'),
	(4, 'Fried Eggs', 'Snacks', 20, 'Yes'),
	(5, 'Beef Samosa', 'Snacks', 25, 'Yes'),
	(6, 'Beef Sausage', 'Snacks', 35, 'Yes'),
	(7, 'Smokies', 'Snacks', 25, 'Yes'),
	(8, 'Cakes', 'Snacks', 20, 'Yes'),
	(9, 'Tea with Mils', 'Hot Beverages', 20, 'Yes'),
	(10, 'Coffee with Milk', 'Hot Beverages', 25, 'Yes'),
	(11, 'Black Tea', 'Hot Beverages', 15, 'Yes'),
	(12, 'Black Coffee', 'Hot Beverages', 15, 'Yes'),
	(13, 'Lemon Tea', 'Hot Beverages', 15, 'Yes'),
	(14, 'Familia Porridge', 'Hot Beverages', 20, 'Yes'),
	(15, 'Soda (300 ml)', 'Soft Drinks', 30, 'Yes'),
	(16, 'Water', 'Soft Drinks', 20, 'Yes'),
	(17, 'Delmonte Juice', 'Soft Drinks', 50, 'Yes'),
	(18, 'Cabbage/Sukumawiki/Spinach & Ugali/Chapati/Rice', 'Specials', 50, 'Yes'),
	(19, 'Traditional Vegetable Ugali/Chapati/Rice', 'Specials', 70, 'Yes'),
	(20, 'Githeri', 'Specials', 50, 'Yes'),
	(21, '1/4 Chicken Plain', 'Main Meal', 150, 'Yes'),
	(22, '1/4 Chicken & Chips', 'Main Meal', 230, 'No'),
	(23, '1/4 Chicken & Chapati', 'Main Meal', 170, 'Yes'),
	(24, '1/4 Chicken & Pilau', 'Main Meal', 230, 'Yes'),
	(25, '1/4 Chicken & Ugali', 'Main Meal', 180, 'Yes'),
	(26, '1/4 Chicken & Rice', 'Main Meal', 190, 'Yes'),
	(27, 'Fish Fillet Plain', 'Main Meal', 110, 'Yes'),
	(28, 'Fish Fillet & Ugali', 'Main Meal', 150, 'Yes'),
	(29, 'Fish Fillet & Chapati', 'Main Meal', 130, 'Yes'),
	(30, 'Fish Fillet & Rice', 'Main Meal', 150, 'Yes'),
	(31, 'Fish Fillet & Pilau', 'Main Meal', 210, 'Yes'),
	(32, 'Bean Stew Plain', 'Main Meal', 40, 'Yes'),
	(33, 'Bean Stew & Rice', 'Main Meal', 80, 'No'),
	(34, 'Bean Stew & Chapati', 'Main Meal', 60, 'Yes'),
	(35, 'Bean Stew & Ugali', 'Main Meal', 70, 'Yes'),
	(36, 'Beef Stew', 'Main Meal', 80, 'Yes'),
	(37, 'Beef Stew & Ugali/Rice/Chapati', 'Main Meal', 120, 'Yes'),
	(38, 'Beef Stew & Irio', 'Main Meal', 150, 'Yes'),
	(39, 'Beef Stew & Chips', 'Main Meal', 160, 'Yes'),
	(40, 'Njahi Stew Plain', 'Main Meal', 60, 'Yes'),
	(41, 'Njahi Stew & Rice', 'Main Meal', 100, 'Yes'),
	(42, 'Njahi Stew & Chapati', 'Main Meal', 80, 'Yes'),
	(43, 'Njahi Stew & Ugali', 'Main Meal', 90, 'Yes'),
	(44, 'Matumbo Plain ', 'Main Meal', 60, 'Yes'),
	(45, 'Matumbo Plain & Ugali', 'Main Meal', 90, 'Yes'),
	(46, 'Matumbo Plain & Chapati', 'Main Meal', 80, 'Yes'),
	(47, 'Matumbo Plain & Rice', 'Main Meal', 100, 'Yes'),
	(48, 'Ugali Plain', 'Accompaniments', 30, 'Yes'),
	(49, 'Fried Rice', 'Accompaniments', 40, 'Yes'),
	(50, 'Chapati', 'Accompaniments', 20, 'Yes'),
	(51, 'Pilau', 'Accompaniments', 100, 'Yes'),
	(52, 'Chips', 'Accompaniments', 80, 'Yes'),
	(53, 'Chips Masala', 'Accompaniments', 100, 'Yes'),
	(54, 'Cabbage', 'Vegetables', 20, 'Yes'),
	(55, 'Sukumawiki/Spinach', 'Vegetables', 20, 'Yes'),
	(56, 'cup cake', 'Snacks', 20, 'Yes');
/*!40000 ALTER TABLE `food` ENABLE KEYS */;

-- Dumping structure for table cafe.management
CREATE TABLE IF NOT EXISTS `management` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(50) DEFAULT NULL,
  `password` varchar(50) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=latin1;

-- Dumping data for table cafe.management: ~0 rows (approximately)
/*!40000 ALTER TABLE `management` DISABLE KEYS */;
REPLACE INTO `management` (`id`, `name`, `password`) VALUES
	(1, 'Jane Mane', '123');
/*!40000 ALTER TABLE `management` ENABLE KEYS */;

-- Dumping structure for table cafe.order
CREATE TABLE IF NOT EXISTS `order` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `total` decimal(10,0) DEFAULT '0',
  `waiterid` int(11) DEFAULT NULL,
  `datetime` date DEFAULT NULL,
  `received` double DEFAULT NULL,
  `change` double DEFAULT NULL,
  `timeofsale` timestamp NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `status` smallint(6) DEFAULT '0',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=101 DEFAULT CHARSET=latin1;

-- Dumping data for table cafe.order: ~64 rows (approximately)
/*!40000 ALTER TABLE `order` DISABLE KEYS */;
REPLACE INTO `order` (`id`, `total`, `waiterid`, `datetime`, `received`, `change`, `timeofsale`, `status`) VALUES
	(18, 480, 1, '2018-03-14', 500, 20, '2018-03-14 12:52:33', 1),
	(19, 730, 1, '2018-03-14', 1000, 270, '2018-03-14 15:15:00', 1),
	(20, 460, 1, '2018-03-14', 500, 40, '2018-03-14 14:49:06', 1),
	(24, 340, 1, '2018-03-14', 1000, 660, '2018-03-14 15:59:23', 1),
	(25, 310, 4, '2018-03-14', 500, 190, '2018-03-14 16:00:56', 1),
	(26, 100, 4, '2018-03-14', 50, -50, '2018-03-14 16:06:07', 1),
	(27, 300, 4, '2018-03-14', 100, -200, '2018-03-14 16:07:47', 1),
	(29, 300, 4, '2018-03-14', 20, -280, '2018-03-14 16:08:58', 1),
	(30, 60, 7, '2018-03-14', 100, 40, '2018-03-14 16:17:07', 1),
	(31, 300, 4, '2018-03-14', 100, -200, '2018-03-14 19:30:16', 1),
	(32, 300, 4, '2018-03-14', 300, 0, '2018-03-14 19:31:36', 1),
	(34, 60, 4, '2018-03-14', 100, 40, '2018-03-14 19:58:04', 1),
	(35, 300, 4, '2018-03-14', 400, 100, '2018-03-14 21:58:19', 1),
	(37, 150, 4, '2018-02-15', 200, 50, '2018-03-15 15:47:52', 1),
	(38, 450, 4, '2018-04-15', 500, 50, '2018-03-15 15:25:49', 1),
	(39, 0, 1, '2018-03-16', NULL, NULL, '2018-03-16 21:41:31', 0),
	(41, 0, 1, '2018-03-16', NULL, NULL, '2018-03-16 21:50:49', 0),
	(42, 0, 1, '2018-03-16', NULL, NULL, '2018-03-16 21:54:57', 0),
	(43, 0, 1, '2018-03-16', NULL, NULL, '2018-03-16 21:57:04', 0),
	(44, 120, 1, '2018-03-16', 200, 80, '2018-03-16 20:34:52', 1),
	(45, 360, 1, '2018-03-16', 400, 40, '2018-03-16 20:33:17', 1),
	(46, 340, 4, '2018-03-16', 340, 0, '2018-03-16 20:36:59', 1),
	(47, 0, 1, '2018-03-17', NULL, NULL, '2018-03-17 22:36:15', 0),
	(48, 0, 1, '2018-03-17', NULL, NULL, '2018-03-17 22:38:10', 0),
	(49, 0, 1, '2018-03-17', NULL, NULL, '2018-03-17 22:38:35', 0),
	(50, 340, 1, '2018-03-18', 400, 60, '2018-03-18 17:56:54', 1),
	(51, 0, 1, '2018-03-19', NULL, NULL, '2018-03-19 15:24:59', 0),
	(52, 540, 1, '2018-03-19', 1000, 460, '2018-03-19 20:14:33', 1),
	(53, 60, 1, '2018-03-19', 100, 40, '2018-03-19 20:14:10', 1),
	(54, 300, 1, '2018-03-19', 400, 100, '2018-03-19 20:17:39', 1),
	(55, 0, 4, '2018-03-19', NULL, NULL, '2018-03-19 22:17:48', 0),
	(56, 0, 4, '2018-03-19', NULL, NULL, '2018-03-19 22:18:08', 0),
	(57, 60, 1, '2018-03-22', 100, 40, '2018-03-22 15:16:14', 1),
	(58, 0, 1, '2018-03-23', NULL, NULL, '2018-03-23 11:19:09', 0),
	(59, 0, 1, '2018-03-23', NULL, NULL, '2018-03-23 11:20:11', 0),
	(60, 0, 1, '2018-03-23', NULL, NULL, '2018-03-23 11:21:02', 0),
	(61, 200, 1, '2018-03-23', 300, 100, '2018-03-24 18:46:38', 1),
	(62, 200, 1, '2018-03-23', 500, 300, '2018-03-23 09:24:16', 1),
	(63, 300, 1, '2018-03-24', 500, 200, '2018-03-24 17:55:41', 1),
	(68, 0, 4, '2018-03-24', NULL, NULL, '2018-03-24 20:46:52', 0),
	(69, 460, 4, '2018-03-24', 500, 40, '2018-03-24 19:01:15', 1),
	(70, 690, 4, '2018-03-24', 700, 10, '2018-03-24 19:07:29', 1),
	(72, 0, 1, '2018-03-24', NULL, NULL, '2018-03-24 21:10:00', 0),
	(73, 0, 1, '2018-03-24', NULL, NULL, '2018-03-24 21:11:07', 0),
	(74, 0, 1, '2018-03-24', NULL, NULL, '2018-03-24 21:11:42', 0),
	(75, 0, 1, '2018-03-24', NULL, NULL, '2018-03-24 21:20:16', 0),
	(76, 400, 1, '2018-03-24', 500, 100, '2018-03-24 19:22:20', 1),
	(77, 0, 1, '2018-03-24', NULL, NULL, '2018-03-24 21:22:29', 0),
	(78, 0, 1, '2018-03-24', NULL, NULL, '2018-03-24 21:25:59', 0),
	(79, 0, 1, '2018-03-24', NULL, NULL, '2018-03-24 21:26:36', 0),
	(80, 0, 1, '2018-03-24', NULL, NULL, '2018-03-24 21:27:50', 0),
	(81, 0, 1, '2018-03-24', NULL, NULL, '2018-03-24 21:28:07', 0),
	(83, 0, 1, '2018-03-25', NULL, NULL, '2018-03-25 21:24:15', 0),
	(84, 0, 1, '2018-03-25', NULL, NULL, '2018-03-25 21:38:03', 0),
	(85, 0, 4, '2018-03-25', NULL, NULL, '2018-03-25 22:35:48', 0),
	(86, 0, 4, '2018-03-25', NULL, NULL, '2018-03-25 22:36:26', 0),
	(87, 0, 1, '2018-03-26', NULL, NULL, '2018-03-26 14:07:02', 0),
	(88, 0, 1, '2018-03-26', NULL, NULL, '2018-03-26 14:13:44', 0),
	(89, 0, 1, '2018-03-26', NULL, NULL, '2018-03-26 14:15:48', 0),
	(90, 3230, 1, '2018-03-26', 4000, 770, '2018-03-26 15:48:38', 1),
	(91, 230, 1, '2018-03-26', 400, 170, '2018-03-26 15:49:38', 1),
	(92, 540, 1, '2018-03-26', 600, 60, '2018-03-26 15:51:21', 1),
	(93, 170, 1, '2018-03-26', 200, 30, '2018-03-26 15:54:48', 1),
	(95, 5100, 1, '2018-03-27', 6000, 900, '2018-03-27 01:31:27', 1),
	(96, 3450, 1, '2018-03-27', 4000, 550, '2018-03-27 00:55:46', 1),
	(97, 0, 1, '2018-03-27', NULL, NULL, '2018-03-27 13:05:41', 0),
	(99, 340, 4, '2018-03-28', 500, 160, '2018-03-28 14:01:42', 1),
	(100, 0, 1, '2018-04-09', NULL, NULL, '2018-04-09 14:23:29', 0);
/*!40000 ALTER TABLE `order` ENABLE KEYS */;

-- Dumping structure for table cafe.orderdetails
CREATE TABLE IF NOT EXISTS `orderdetails` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `orderid` int(11) DEFAULT NULL,
  `foodid` int(11) DEFAULT NULL,
  `quantity` int(11) DEFAULT NULL,
  `total` double DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=111 DEFAULT CHARSET=latin1;

-- Dumping data for table cafe.orderdetails: ~82 rows (approximately)
/*!40000 ALTER TABLE `orderdetails` DISABLE KEYS */;
REPLACE INTO `orderdetails` (`id`, `orderid`, `foodid`, `quantity`, `total`) VALUES
	(22, 18, 22, 2, 460),
	(23, 18, 16, 1, 20),
	(24, 19, 22, 3, 690),
	(25, 19, 2, 2, 40),
	(26, 20, 22, 2, 460),
	(28, 24, 21, 1, 150),
	(29, 24, 15, 1, 30),
	(31, 24, 52, 2, 160),
	(32, 25, 16, 2, 40),
	(33, 25, 6, 2, 70),
	(34, 25, 53, 2, 200),
	(35, 26, 56, 5, 100),
	(36, 27, 21, 2, 300),
	(37, 29, 21, 2, 300),
	(38, 30, 15, 2, 60),
	(39, 31, 21, 2, 300),
	(40, 32, 21, 2, 300),
	(42, 34, 15, 2, 60),
	(43, 35, 21, 2, 300),
	(45, 37, 21, 1, 150),
	(46, 38, 21, 3, 450),
	(47, 41, 21, 2, 300),
	(48, 41, 15, 3, 90),
	(49, 42, 21, 2, 300),
	(50, 43, 21, 8, 1200),
	(52, 44, 15, 4, 120),
	(53, 45, 21, 2, 300),
	(54, 45, 16, 3, 60),
	(55, 46, 21, 2, 300),
	(56, 46, 16, 2, 40),
	(57, 47, 21, 1, 150),
	(58, 47, 15, 2, 60),
	(59, 48, 16, 2, 40),
	(60, 49, 15, 2, 60),
	(61, 50, 23, 2, 340),
	(62, 51, 21, 2, 300),
	(63, 52, 34, 9, 540),
	(64, 53, 34, 1, 60),
	(65, 54, 21, 2, 300),
	(66, 55, 21, 2, 300),
	(67, 56, 15, 1, 30),
	(68, 57, 16, 3, 60),
	(69, 58, 3, 5, 100),
	(70, 58, 50, 10, 200),
	(71, 59, 3, 2, 40),
	(72, 60, 3, 5, 100),
	(73, 61, 3, 5, 100),
	(74, 61, 50, 5, 100),
	(75, 62, 3, 5, 100),
	(76, 62, 50, 5, 100),
	(77, 63, 21, 2, 300),
	(78, 67, 24, 2, 460),
	(79, 68, 21, 2, 300),
	(80, 69, 24, 2, 460),
	(81, 70, 24, 3, 690),
	(82, 74, 25, 20, 3600),
	(83, 76, 16, 20, 400),
	(84, 83, 23, 20, 3400),
	(85, 83, 23, 5, 850),
	(86, 83, 23, 2, 340),
	(87, 83, 23, 20, 3400),
	(88, 83, 23, 2, 340),
	(89, 83, 23, 2, 340),
	(90, 83, 23, 20, 3400),
	(91, 83, 23, 20, 3400),
	(92, 84, 23, 20, 3400),
	(93, 84, 23, 2, 340),
	(94, 86, 23, 5, 850),
	(95, 88, 23, 17, 2890),
	(96, 89, 23, 2, 340),
	(97, 89, 24, 1, 230),
	(98, 89, 26, 10, 1900),
	(99, 89, 38, 9, 1350),
	(100, 90, 23, 19, 3230),
	(101, 91, 24, 1, 230),
	(102, 92, 34, 9, 540),
	(103, 93, 23, 1, 170),
	(104, 95, 23, 30, 5100),
	(105, 96, 22, 15, 3450),
	(106, 97, 22, 1, 230),
	(107, 97, 22, 1, 230),
	(108, 97, 22, 1, 230),
	(109, 99, 23, 2, 340),
	(110, 100, 23, 8, 1360);
/*!40000 ALTER TABLE `orderdetails` ENABLE KEYS */;

-- Dumping structure for table cafe.outoforder
CREATE TABLE IF NOT EXISTS `outoforder` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `foodid` int(11) DEFAULT NULL,
  `date` datetime DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=6 DEFAULT CHARSET=latin1;

-- Dumping data for table cafe.outoforder: ~4 rows (approximately)
/*!40000 ALTER TABLE `outoforder` DISABLE KEYS */;
REPLACE INTO `outoforder` (`id`, `foodid`, `date`) VALUES
	(1, 23, '2018-03-13 23:14:29'),
	(2, 24, '2018-03-13 23:21:29'),
	(3, 21, '2018-03-13 23:21:30'),
	(4, 33, '2018-03-13 23:21:32'),
	(5, 22, '2018-03-14 18:01:26');
/*!40000 ALTER TABLE `outoforder` ENABLE KEYS */;

-- Dumping structure for table cafe.production
CREATE TABLE IF NOT EXISTS `production` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `foodid` int(11) DEFAULT NULL,
  `quantity` int(11) DEFAULT '0',
  `date` date DEFAULT NULL,
  `remainder` int(11) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=39 DEFAULT CHARSET=latin1;

-- Dumping data for table cafe.production: ~21 rows (approximately)
/*!40000 ALTER TABLE `production` DISABLE KEYS */;
REPLACE INTO `production` (`id`, `foodid`, `quantity`, `date`, `remainder`) VALUES
	(13, 22, 5, '2018-03-18', 0),
	(14, 23, 4, '2018-03-18', 0),
	(15, 22, 4, '2018-03-19', 0),
	(16, 34, 12, '2018-03-19', 0),
	(17, 5, 2, '2018-03-19', 0),
	(18, 5, 50, '2018-03-22', 0),
	(19, 3, 30, '2018-03-22', 0),
	(20, 23, 2, '2018-03-22', 0),
	(21, 3, 20, '2018-03-23', 0),
	(22, 50, 50, '2018-03-23', 0),
	(23, 23, 10, '2018-03-24', 0),
	(24, 24, 20, '2018-03-24', 14),
	(25, 16, 20, '2018-03-24', 20),
	(26, 23, 10, '2018-03-25', 10),
	(27, 22, 20, '2018-03-25', 20),
	(28, 23, 20, '2018-03-26', 0),
	(29, 24, 2, '2018-03-26', 1),
	(30, 26, 30, '2018-03-26', 30),
	(31, 25, 20, '2018-03-26', 20),
	(32, 34, 10, '2018-03-26', 1),
	(33, 5, 20, '2018-03-26', 20),
	(34, 38, 10, '2018-03-26', 10),
	(35, 23, 20, '2018-03-27', -10),
	(36, 22, 20, '2018-03-27', 5),
	(37, 23, 20, '2018-03-28', 18),
	(38, 23, 20, '2018-04-09', 20);
/*!40000 ALTER TABLE `production` ENABLE KEYS */;

-- Dumping structure for table cafe.staff
CREATE TABLE IF NOT EXISTS `staff` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(50) DEFAULT NULL,
  `type` varchar(50) DEFAULT NULL,
  `password` varchar(50) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=9 DEFAULT CHARSET=latin1;

-- Dumping data for table cafe.staff: ~4 rows (approximately)
/*!40000 ALTER TABLE `staff` DISABLE KEYS */;
REPLACE INTO `staff` (`id`, `name`, `type`, `password`) VALUES
	(1, 'Jhon Doe', 'waiter', '123'),
	(2, 'Doe Jane', 'waiter', '456'),
	(3, 'Mary James', 'waiter', '789'),
	(4, 'Jake Reedes', 'cashier', '123'),
	(5, 'Jack Neil', 'store', '123'),
	(6, 'Joe Jack', 'waiter', '123'),
	(7, 'bonface', 'cashier', '1'),
	(8, 'James Joe', 'production', '123');
/*!40000 ALTER TABLE `staff` ENABLE KEYS */;

-- Dumping structure for table cafe.stock
CREATE TABLE IF NOT EXISTS `stock` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(50) NOT NULL DEFAULT '0',
  `date` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `quantity` double DEFAULT '0',
  `price` int(11) DEFAULT '0',
  `arch` smallint(6) DEFAULT '0',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=6 DEFAULT CHARSET=latin1;

-- Dumping data for table cafe.stock: ~5 rows (approximately)
/*!40000 ALTER TABLE `stock` DISABLE KEYS */;
REPLACE INTO `stock` (`id`, `name`, `date`, `quantity`, `price`, `arch`) VALUES
	(1, 'Flour', '2018-03-12 17:15:42', 3, 50, 0),
	(2, 'Oil', '2018-03-12 17:15:55', 1, 0, 0),
	(3, 'Sugar', '2018-03-12 17:16:11', 32, 0, 0),
	(4, 'Butter', '2018-03-14 21:13:53', 42, 0, 0),
	(5, 'Salt', '2018-03-27 00:55:18', 100, 200, 0);
/*!40000 ALTER TABLE `stock` ENABLE KEYS */;

-- Dumping structure for table cafe.stockrelease
CREATE TABLE IF NOT EXISTS `stockrelease` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `stockid` int(11) DEFAULT NULL,
  `quantity` double DEFAULT NULL,
  `date` datetime DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=14 DEFAULT CHARSET=latin1;

-- Dumping data for table cafe.stockrelease: ~12 rows (approximately)
/*!40000 ALTER TABLE `stockrelease` DISABLE KEYS */;
REPLACE INTO `stockrelease` (`id`, `stockid`, `quantity`, `date`) VALUES
	(1, 1, 18, '2018-03-12 17:16:39'),
	(2, 2, 9, '2018-03-12 17:16:43'),
	(3, 1, 2, '2018-03-14 00:03:35'),
	(4, 1, 5, '2018-03-14 18:02:44'),
	(5, 3, 3, '2018-03-14 18:02:51'),
	(6, 3, 5, '2018-03-14 21:00:44'),
	(7, 1, 5, '2018-03-14 21:07:21'),
	(8, 5, 200, '2018-03-27 00:56:22'),
	(9, 5, 100, '2018-03-27 01:13:36'),
	(10, 5, 100, '2018-03-28 14:40:18'),
	(11, 1, 2, '2018-03-28 14:40:22'),
	(12, 4, 2.4, '2018-05-02 21:03:37'),
	(13, 4, 20.4, '2018-05-02 21:08:31');
/*!40000 ALTER TABLE `stockrelease` ENABLE KEYS */;

-- Dumping structure for table cafe.stockupdate
CREATE TABLE IF NOT EXISTS `stockupdate` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `stockid` int(11) DEFAULT NULL,
  `quantity` double DEFAULT NULL,
  `date` datetime DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=12 DEFAULT CHARSET=latin1;

-- Dumping data for table cafe.stockupdate: ~9 rows (approximately)
/*!40000 ALTER TABLE `stockupdate` DISABLE KEYS */;
REPLACE INTO `stockupdate` (`id`, `stockid`, `quantity`, `date`) VALUES
	(1, 1, 30, '2018-03-12 17:15:47'),
	(2, 2, 10, '2018-03-12 17:16:00'),
	(3, 3, 40, '2018-03-12 17:16:16'),
	(4, 1, 5, '2018-03-14 21:06:29'),
	(5, 4, 20, '2018-03-14 21:14:14'),
	(6, 4, 2, '2018-03-15 20:04:37'),
	(7, 4, 2, '2018-03-16 09:57:00'),
	(8, 23, 2, '2018-03-18 12:31:39'),
	(9, 5, 500, '2018-03-27 00:55:37'),
	(10, 4, 20.4, '2018-05-02 21:07:45'),
	(11, 4, 20.4, '2018-05-02 21:08:03');
/*!40000 ALTER TABLE `stockupdate` ENABLE KEYS */;

/*!40101 SET SQL_MODE=IFNULL(@OLD_SQL_MODE, '') */;
/*!40014 SET FOREIGN_KEY_CHECKS=IF(@OLD_FOREIGN_KEY_CHECKS IS NULL, 1, @OLD_FOREIGN_KEY_CHECKS) */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
