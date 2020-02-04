-- --------------------------------------------------------
-- Host:                         localhost
-- Server version:               5.7.24 - MySQL Community Server (GPL)
-- Server OS:                    Win64
-- HeidiSQL Version:             10.2.0.5599
-- --------------------------------------------------------

/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET NAMES utf8 */;
/*!50503 SET NAMES utf8mb4 */;
/*!40014 SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0 */;
/*!40101 SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='NO_AUTO_VALUE_ON_ZERO' */;


-- Dumping database structure for simple-login
CREATE DATABASE IF NOT EXISTS `simple-login` /*!40100 DEFAULT CHARACTER SET latin1 */;
USE `simple-login`;

-- Dumping structure for table simple-login.levels
CREATE TABLE IF NOT EXISTS `levels` (
  `id` int(50) NOT NULL AUTO_INCREMENT,
  `name` varchar(200) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=latin1;

-- Dumping data for table simple-login.levels: ~3 rows (approximately)
/*!40000 ALTER TABLE `levels` DISABLE KEYS */;
REPLACE INTO `levels` (`id`, `name`) VALUES
	(1, 'admin'),
	(2, 'cashier'),
	(3, 'customer');
/*!40000 ALTER TABLE `levels` ENABLE KEYS */;

-- Dumping structure for table simple-login.products
CREATE TABLE IF NOT EXISTS `products` (
  `code` varchar(100) NOT NULL,
  `name` varchar(100) DEFAULT NULL,
  `type` varchar(100) DEFAULT NULL,
  `price` int(11) DEFAULT NULL,
  PRIMARY KEY (`code`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- Dumping data for table simple-login.products: ~4 rows (approximately)
/*!40000 ALTER TABLE `products` DISABLE KEYS */;
REPLACE INTO `products` (`code`, `name`, `type`, `price`) VALUES
	('3946', 'Soto Babi', 'Lusin', 40000),
	('B002', 'santuy', 'Pcs', 80000),
	('P00-2', 'Fiesta Chicken Nugget', 'Lusin', 9000),
	('P00-3', 'Tuna', 'Kodi', 20000);
/*!40000 ALTER TABLE `products` ENABLE KEYS */;

-- Dumping structure for table simple-login.users
CREATE TABLE IF NOT EXISTS `users` (
  `id` int(50) NOT NULL AUTO_INCREMENT,
  `name` varchar(50) DEFAULT NULL,
  `email` varchar(50) DEFAULT NULL,
  `password` varchar(50) DEFAULT NULL,
  `id_level` int(50) NOT NULL,
  PRIMARY KEY (`id`),
  KEY `id_level` (`id_level`),
  CONSTRAINT `users_ibfk_1` FOREIGN KEY (`id_level`) REFERENCES `levels` (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=6 DEFAULT CHARSET=latin1;

-- Dumping data for table simple-login.users: ~1 rows (approximately)
/*!40000 ALTER TABLE `users` DISABLE KEYS */;
REPLACE INTO `users` (`id`, `name`, `email`, `password`, `id_level`) VALUES
	(5, 'Pande Muliada', 'pandemuliada@gmail.com', 'password', 1);
/*!40000 ALTER TABLE `users` ENABLE KEYS */;

-- Dumping structure for view simple-login.v_users
-- Creating temporary table to overcome VIEW dependency errors
CREATE TABLE `v_users` (
	`id` INT(50) NOT NULL,
	`name` VARCHAR(50) NULL COLLATE 'latin1_swedish_ci',
	`email` VARCHAR(50) NULL COLLATE 'latin1_swedish_ci',
	`password` VARCHAR(50) NULL COLLATE 'latin1_swedish_ci',
	`id_level` INT(50) NOT NULL,
	`level_name` VARCHAR(200) NOT NULL COLLATE 'latin1_swedish_ci'
) ENGINE=MyISAM;

-- Dumping structure for view simple-login.v_users
-- Removing temporary table and create final VIEW structure
DROP TABLE IF EXISTS `v_users`;
CREATE ALGORITHM=UNDEFINED DEFINER=`root`@`localhost` SQL SECURITY DEFINER VIEW `v_users` AS select `users`.`id` AS `id`,`users`.`name` AS `name`,`users`.`email` AS `email`,`users`.`password` AS `password`,`users`.`id_level` AS `id_level`,`levels`.`name` AS `level_name` from (`users` join `levels` on((`users`.`id_level` = `levels`.`id`)));

/*!40101 SET SQL_MODE=IFNULL(@OLD_SQL_MODE, '') */;
/*!40014 SET FOREIGN_KEY_CHECKS=IF(@OLD_FOREIGN_KEY_CHECKS IS NULL, 1, @OLD_FOREIGN_KEY_CHECKS) */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
