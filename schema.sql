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


-- Дамп структуры базы данных yety
DROP DATABASE IF EXISTS `yety`;
CREATE DATABASE IF NOT EXISTS `yety` /*!40100 DEFAULT CHARACTER SET utf8 */;
USE `yety`;

-- Дамп структуры для таблица yety.categories
DROP TABLE IF EXISTS `categories`;
CREATE TABLE IF NOT EXISTS `categories` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `category_name` varchar(20) DEFAULT NULL,
  `symbol_code` varchar(20) DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `unique_category` (`category_name`,`symbol_code`)
) ENGINE=InnoDB AUTO_INCREMENT=13 DEFAULT CHARSET=utf8;

INSERT INTO categories (category_name, symbol_code)
VALUES ('Доски и лыжи', 'boards');
INSERT INTO categories (category_name, symbol_code)
VALUES ('Крепления', 'attachment');
INSERT INTO categories (category_name, symbol_code)
VALUES ('Ботинки', 'boots');
INSERT INTO categories (category_name, symbol_code)
VALUES ('Одежда', 'clothing');
INSERT INTO categories (category_name, symbol_code)
VALUES ('Инструменты', 'tools');
INSERT INTO categories (category_name, symbol_code)
VALUES ('Разное', 'other');

-- Экспортируемые данные не выделены.

-- Дамп структуры для таблица yety.users
DROP TABLE IF EXISTS `users`;
CREATE TABLE IF NOT EXISTS `users` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `registration_date` timestamp NOT NULL,
  `email` varchar(128) DEFAULT NULL,
  `user_name` varchar(50) DEFAULT NULL,
  `user_password` varchar(64) DEFAULT NULL,
  `user_contact` text,
  PRIMARY KEY (`id`),
  UNIQUE KEY `unique_usermane` (`user_name`),
  UNIQUE KEY `unique_useremail` (`email`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;




-- Дамп структуры для таблица yety.lots
DROP TABLE IF EXISTS `lots`;
CREATE TABLE IF NOT EXISTS `lots` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `date_create` timestamp NOT NULL,
  `lot_name` varchar(30) DEFAULT NULL,
  `description` varchar(128) DEFAULT NULL,
  `image` varchar(512) DEFAULT NULL,
  `start_price` int(11) NOT NULL,
  `date_dead` timestamp NOT NULL,
  `rate_step` int(11) NOT NULL,
  `category_id` int(11) DEFAULT NULL,
  `author_id` int(11) DEFAULT NULL,
  `winner_id` int(11) DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `category_id` (`category_id`),
  KEY `author_id` (`author_id`),
  KEY `winner_id` (`winner_id`),
  KEY `lots_search` (`lot_name`,`description`),
  CONSTRAINT `lots_ibfk_1` FOREIGN KEY (`category_id`) REFERENCES `categories` (`id`),
  CONSTRAINT `lots_ibfk_2` FOREIGN KEY (`author_id`) REFERENCES `users` (`id`),
  CONSTRAINT `lots_ibfk_3` FOREIGN KEY (`winner_id`) REFERENCES `users` (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- Экспортируемые данные не выделены.

-- Дамп структуры для таблица yety.rates
DROP TABLE IF EXISTS `rates`;
CREATE TABLE IF NOT EXISTS `rates` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `rate_date` timestamp NOT NULL,
  `rate_sum` int(11) DEFAULT NULL,
  `lot_id` int(11) DEFAULT NULL,
  `user_id` int(11) DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `lot_id` (`lot_id`),
  KEY `user_id` (`user_id`),
  CONSTRAINT `rates_ibfk_1` FOREIGN KEY (`lot_id`) REFERENCES `lots` (`id`),
  CONSTRAINT `rates_ibfk_2` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- Экспортируемые данные не выделены.


-- Экспортируемые данные не выделены.

/*!40101 SET SQL_MODE=IFNULL(@OLD_SQL_MODE, '') */;
/*!40014 SET FOREIGN_KEY_CHECKS=IF(@OLD_FOREIGN_KEY_CHECKS IS NULL, 1, @OLD_FOREIGN_KEY_CHECKS) */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
