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
  CONSTRAINT `FK_messages_messages_status` FOREIGN KEY (`status_id`) REFERENCES `messages_status` (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=6 DEFAULT CHARSET=utf8 COLLATE=utf8_bin;

-- Dumping data for table smsapi.messages: ~1 rows (approximately)
/*!40000 ALTER TABLE `messages` DISABLE KEYS */;
INSERT INTO `messages` (`id`, `message`, `status_id`, `created_at`, `price`) VALUES
	(1, 'asd', 1, '0000-00-00 00:00:00', 0),
	(2, 'sadсадасдасдадсадаsadсадасдасдадсадаsadсадасдасдадсадаsadсадасдасдадсадассссссссссссссссссссссссссссссссссссссссссссссссссссссссссссссс', 1, '2020-04-09 22:31:52', 0.54),
	(3, 'sadсадасдасдадсадаsadсадасдасдадсадаsadсадасдасдадсадаsadсадасдасдадсадассссссссссссссссссссссссссссссссссссссссссссссссссссссссссссссс', 1, '2020-04-09 22:32:29', 0.54),
	(4, 'sadсадасдасдадсадаsadсадасдасдадсадаsadсадасдасдадсадаsadсадасдасдадсадассссссссссссссссссссссссссссссссссссссссссссссссссссссссссссссс', 1, '2020-04-09 22:34:03', 0.54),
	(5, 'sadсадасдасдадсадаsadсадасдасдадсадаsadсадасдасдадсадаsadсадасдасдадсадассссссссссссссссссссссссссссссссссссссссссссссссссссссссссссссс', 1, '2020-04-09 22:34:29', 0.54);
/*!40000 ALTER TABLE `messages` ENABLE KEYS */;

-- Dumping structure for table smsapi.messages_status
CREATE TABLE IF NOT EXISTS `messages_status` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `title` varchar(50) COLLATE utf8_bin NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=utf8 COLLATE=utf8_bin;

-- Dumping data for table smsapi.messages_status: ~3 rows (approximately)
/*!40000 ALTER TABLE `messages_status` DISABLE KEYS */;
INSERT INTO `messages_status` (`id`, `title`) VALUES
	(1, 'waiting'),
	(2, 'sended'),
	(3, 'canceled');
/*!40000 ALTER TABLE `messages_status` ENABLE KEYS */;

-- Dumping structure for table smsapi.tokens
CREATE TABLE IF NOT EXISTS `tokens` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `token` varchar(255) COLLATE utf8_bin NOT NULL,
  `created_at` datetime NOT NULL DEFAULT curtime(),
  `valid_to` datetime DEFAULT NULL,
  `is_active` tinyint(4) NOT NULL DEFAULT 1,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8 COLLATE=utf8_bin;

-- Dumping data for table smsapi.tokens: ~0 rows (approximately)
/*!40000 ALTER TABLE `tokens` DISABLE KEYS */;
INSERT INTO `tokens` (`id`, `token`, `created_at`, `valid_to`, `is_active`) VALUES
	(1, 'sada', '2020-04-09 20:15:53', '2020-04-12 22:15:55', 1);
/*!40000 ALTER TABLE `tokens` ENABLE KEYS */;

/*!40101 SET SQL_MODE=IFNULL(@OLD_SQL_MODE, '') */;
/*!40014 SET FOREIGN_KEY_CHECKS=IF(@OLD_FOREIGN_KEY_CHECKS IS NULL, 1, @OLD_FOREIGN_KEY_CHECKS) */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
