-- --------------------------------------------------------
-- Хост:                         127.0.0.1
-- Версия сервера:               5.7.29 - MySQL Community Server (GPL)
-- Операционная система:         Win64
-- HeidiSQL Версия:              11.0.0.5958
-- --------------------------------------------------------

/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET NAMES utf8 */;
/*!50503 SET NAMES utf8mb4 */;
/*!40014 SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0 */;
/*!40101 SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='NO_AUTO_VALUE_ON_ZERO' */;


-- Дамп структуры базы данных yetycave2
DROP DATABASE IF EXISTS `yetycave2`;
CREATE DATABASE IF NOT EXISTS `yetycave2` /*!40100 DEFAULT CHARACTER SET utf8 */;
USE `yetycave2`;

-- Дамп структуры для таблица yetycave2.categories
DROP TABLE IF EXISTS `categories`;
CREATE TABLE IF NOT EXISTS `categories` (
  `category_id` int(11) NOT NULL AUTO_INCREMENT,
  `category_name` varchar(20) DEFAULT NULL,
  `symbol_code` varchar(20) DEFAULT NULL,
  PRIMARY KEY (`category_id`),
  UNIQUE KEY `unique_category` (`category_name`,`symbol_code`)
) ENGINE=InnoDB AUTO_INCREMENT=7 DEFAULT CHARSET=utf8;

-- Экспортируемые данные не выделены.

-- Дамп структуры для таблица yetycave2.lots
DROP TABLE IF EXISTS `lots`;
CREATE TABLE IF NOT EXISTS `lots` (
  `lot_id` int(11) NOT NULL AUTO_INCREMENT,
  `date_create` timestamp NOT NULL,
  `lot_name` varchar(30) DEFAULT NULL,
  `description` varchar(128) DEFAULT NULL,
  `image` text,
  `start_price` int(11) NOT NULL,
  `date_dead` timestamp NOT NULL,
  `rate_step` int(11) NOT NULL,
  `category_id` int(11) DEFAULT NULL,
  `author_id` int(11) DEFAULT NULL,
  `winner_id` int(11) DEFAULT NULL,
  PRIMARY KEY (`lot_id`),
  KEY `category_id` (`category_id`),
  KEY `author_id` (`author_id`),
  KEY `winner_id` (`winner_id`),
  KEY `lots_search` (`lot_name`,`description`),
  CONSTRAINT `lots_ibfk_1` FOREIGN KEY (`category_id`) REFERENCES `categories` (`category_id`),
  CONSTRAINT `lots_ibfk_2` FOREIGN KEY (`author_id`) REFERENCES `users` (`user_id`),
  CONSTRAINT `lots_ibfk_3` FOREIGN KEY (`winner_id`) REFERENCES `users` (`user_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- Экспортируемые данные не выделены.

-- Дамп структуры для таблица yetycave2.rates
DROP TABLE IF EXISTS `rates`;
CREATE TABLE IF NOT EXISTS `rates` (
  `rate_id` int(11) NOT NULL AUTO_INCREMENT,
  `rate_date` timestamp NOT NULL,
  `rate_sum` int(11) DEFAULT NULL,
  `lot_id` int(11) DEFAULT NULL,
  `user_id` int(11) DEFAULT NULL,
  PRIMARY KEY (`rate_id`),
  KEY `lot_id` (`lot_id`),
  KEY `user_id` (`user_id`),
  CONSTRAINT `rates_ibfk_1` FOREIGN KEY (`lot_id`) REFERENCES `lots` (`lot_id`),
  CONSTRAINT `rates_ibfk_2` FOREIGN KEY (`user_id`) REFERENCES `users` (`user_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- Экспортируемые данные не выделены.

-- Дамп структуры для таблица yetycave2.users
DROP TABLE IF EXISTS `users`;
CREATE TABLE IF NOT EXISTS `users` (
  `user_id` int(11) NOT NULL AUTO_INCREMENT,
  `registration_date` timestamp NOT NULL,
  `email` varchar(128) DEFAULT NULL,
  `user_name` varchar(50) DEFAULT NULL,
  `user_password` varchar(64) DEFAULT NULL,
  `user_contact` text,
  `created_lots` int(11) DEFAULT NULL,
  `dealed_rates` int(11) DEFAULT NULL,
  PRIMARY KEY (`user_id`),
  UNIQUE KEY `unique_users` (`user_name`,`user_password`),
  KEY `created_lots` (`created_lots`),
  KEY `dealed_rates` (`dealed_rates`),
  CONSTRAINT `users_ibfk_1` FOREIGN KEY (`created_lots`) REFERENCES `lots` (`lot_id`),
  CONSTRAINT `users_ibfk_2` FOREIGN KEY (`dealed_rates`) REFERENCES `rates` (`rate_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- Экспортируемые данные не выделены.

/*!40101 SET SQL_MODE=IFNULL(@OLD_SQL_MODE, '') */;
/*!40014 SET FOREIGN_KEY_CHECKS=IF(@OLD_FOREIGN_KEY_CHECKS IS NULL, 1, @OLD_FOREIGN_KEY_CHECKS) */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
