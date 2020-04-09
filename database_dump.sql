-- --------------------------------------------------------
-- Host:                         127.0.0.1
-- Server version:               10.4.10-MariaDB - mariadb.org binary distribution
-- Server OS:                    Win64
-- HeidiSQL Version:             10.2.0.5599
-- --------------------------------------------------------

/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET NAMES utf8 */;
/*!50503 SET NAMES utf8mb4 */;
/*!40014 SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0 */;
/*!40101 SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='NO_AUTO_VALUE_ON_ZERO' */;


-- Dumping database structure for smsapi
CREATE DATABASE IF NOT EXISTS `smsapi` /*!40100 DEFAULT CHARACTER SET utf8 COLLATE utf8_bin */;
USE `smsapi`;

-- Dumping structure for table smsapi.messages
CREATE TABLE IF NOT EXISTS `messages` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `message` varchar(255) COLLATE utf8_bin NOT NULL,
  `status_id` int(11) NOT NULL,
  `created_at` datetime DEFAULT curtime(),
  `price` float NOT NULL DEFAULT 0,
  PRIMARY KEY (`id`),
  KEY `FK_messages_messages_status` (`status_id`),
  CONSTRAINT `FK_messages_messages_status` FOREIGN KEY (`status_id`) REFERENCES `messages_status` (`id`) ON DELETE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=11 DEFAULT CHARSET=utf8 COLLATE=utf8_bin;

-- Data exporting was unselected.

-- Dumping structure for table smsapi.messages_numbers
CREATE TABLE IF NOT EXISTS `messages_numbers` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `phone_number` varchar(255) COLLATE utf8_bin NOT NULL,
  `message_id` int(11) NOT NULL,
  PRIMARY KEY (`id`),
  KEY `FK_messages_numbers_messages` (`message_id`),
  CONSTRAINT `FK_messages_numbers_messages` FOREIGN KEY (`message_id`) REFERENCES `messages` (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=5 DEFAULT CHARSET=utf8 COLLATE=utf8_bin;

-- Data exporting was unselected.

-- Dumping structure for table smsapi.messages_status
CREATE TABLE IF NOT EXISTS `messages_status` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `title` varchar(50) COLLATE utf8_bin NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=utf8 COLLATE=utf8_bin;

-- Data exporting was unselected.

-- Dumping structure for table smsapi.tokens
CREATE TABLE IF NOT EXISTS `tokens` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `token` varchar(255) COLLATE utf8_bin NOT NULL,
  `created_at` datetime NOT NULL DEFAULT curtime(),
  `valid_to` datetime DEFAULT NULL,
  `is_active` tinyint(4) NOT NULL DEFAULT 1,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8 COLLATE=utf8_bin;

-- Data exporting was unselected.

/*!40101 SET SQL_MODE=IFNULL(@OLD_SQL_MODE, '') */;
/*!40014 SET FOREIGN_KEY_CHECKS=IF(@OLD_FOREIGN_KEY_CHECKS IS NULL, 1, @OLD_FOREIGN_KEY_CHECKS) */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
