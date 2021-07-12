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
CREATE DATABASE IF NOT EXISTS `yety` /*!40100 DEFAULT CHARACTER SET utf8 */;
USE `yety`;

-- Дамп структуры для таблица yety.categories
CREATE TABLE IF NOT EXISTS `categories` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `category_name` varchar(20) DEFAULT NULL,
  `symbol_code` varchar(20) DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `unique_category` (`category_name`,`symbol_code`)
) ENGINE=InnoDB AUTO_INCREMENT=7 DEFAULT CHARSET=utf8;

-- Дамп данных таблицы yety.categories: ~6 rows (приблизительно)
/*!40000 ALTER TABLE `categories` DISABLE KEYS */;
INSERT INTO `categories` (`id`, `category_name`, `symbol_code`) VALUES
	(3, 'Ботинки', 'boots'),
	(1, 'Доски и лыжи', 'boards'),
	(5, 'Инструменты', 'tools'),
	(2, 'Крепления', 'attachment'),
	(4, 'Одежда', 'clothing'),
	(6, 'Разное', 'other');
/*!40000 ALTER TABLE `categories` ENABLE KEYS */;

-- Дамп структуры для таблица yety.lots
CREATE TABLE IF NOT EXISTS `lots` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `date_create` date NOT NULL,
  `lot_name` varchar(255) DEFAULT NULL,
  `description` varchar(128) DEFAULT NULL,
  `image` varchar(255) DEFAULT NULL,
  `start_price` int(11) NOT NULL,
  `date_dead` date DEFAULT NULL,
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
) ENGINE=InnoDB AUTO_INCREMENT=22 DEFAULT CHARSET=utf8;

-- Дамп данных таблицы yety.lots: ~17 rows (приблизительно)
/*!40000 ALTER TABLE `lots` DISABLE KEYS */;
INSERT INTO `lots` (`id`, `date_create`, `lot_name`, `description`, `image`, `start_price`, `date_dead`, `rate_step`, `category_id`, `author_id`, `winner_id`) VALUES
	(1, '2021-03-21', '2014 Rossignol District Snowboard', 'doska', 'img/lot-1.jpg', 10999, '2021-05-06', 1000, 1, 1, NULL),
	(2, '2021-03-20', 'Rossignol', 'doska', 'img/lot-2.jpg', 159999, '2021-05-05', 100, 1, 2, NULL),
	(3, '2021-03-19', 'Крепления Union Contact Pro 2015 года размер L/XL', 'krepi', 'img/lot-3.jpg', 8000, '2021-05-11', 100, 2, 1, NULL),
	(4, '2021-03-18', 'Ботинки для сноуборда DC Mutiny Charocal', 'boty', 'img/lot-4.jpg', 10999, '2021-05-18', 100, 3, 2, NULL),
	(5, '2021-03-17', 'Куртка для сноуборда DC Mutiny Charocal', 'kurtka', 'img/lot-5.jpg', 7500, '2021-05-16', 100, 4, 1, NULL),
	(6, '2021-03-16', 'Маска Oakley Canopy', 'ochki', 'img/lot-6.jpg', 5400, '2021-05-05', 100, 6, 2, NULL),
	(7, '2021-05-06', 'test', 'dsoka', NULL, 10000, '2021-05-07', 100, NULL, 1, NULL),
	(8, '2021-05-06', 'test', 'testtest', NULL, 10000, '2021-05-21', 100, 3, 1, NULL),
	(9, '2021-05-07', 'test', 'adswqe', NULL, 1000, '2021-05-07', 100, 1, 1, NULL),
	(11, '2021-05-07', 'test', 'adswqe', NULL, 1000, '2021-05-08', 100, 1, 1, NULL),
	(12, '2021-05-07', 'testimg', 'adswqe', NULL, 1000, '2021-05-08', 100, 1, 1, NULL),
	(13, '2021-05-08', 'test3', 'фуцйуйу', '60967b71c61eb.img', 1000, '2021-05-09', 100, 1, 1, NULL),
	(14, '2021-05-08', 'test3', 'фуцйуйу', '60967b9187f6f.img', 1000, '2021-05-09', 100, 1, 1, NULL),
	(15, '2021-05-08', 'test3', 'eqwqwe', '60967bbb605df.img', 1000, '2021-05-09', 100, 2, 1, NULL),
	(16, '2021-05-08', 'testimage', 'superdoska', '60967c638251e.img', 1000, '2021-05-09', 100, 1, 1, NULL),
	(17, '2021-05-08', 'testimage', 'superdoska', 'uploads/60967dc185149.img', 1000, '2021-05-09', 100, 1, 1, NULL),
	(18, '2021-05-08', 'testimg', 'asfsdf', '60967e9686585.img', 1000, '2021-05-09', 100, 1, 1, NULL),
	(19, '2021-05-08', 'testimg', 'superdoska', 'uploads/60967f62a6f66.img', 1000, '2021-05-09', 100, 1, 1, NULL),
	(20, '2021-05-08', 'testimg', 'superdoska', 'uploads/60967f9d57d51.img', 1000, '2021-05-09', 100, 1, 1, NULL),
	(21, '2021-05-08', 'Сноуборд', 'Хороший Сноуборд', 'uploads/609680bb72ab8.img', 10000, '2021-05-20', 100, 1, 1, NULL);
/*!40000 ALTER TABLE `lots` ENABLE KEYS */;

-- Дамп структуры для таблица yety.rates
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
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=utf8;

-- Дамп данных таблицы yety.rates: ~3 rows (приблизительно)
/*!40000 ALTER TABLE `rates` DISABLE KEYS */;
INSERT INTO `rates` (`id`, `rate_date`, `rate_sum`, `lot_id`, `user_id`) VALUES
	(1, '2021-03-20 11:34:30', 11099, 1, 2),
	(2, '2021-03-20 11:34:30', 160099, 2, 1),
	(3, '2021-03-20 11:34:30', 160199, 2, 1);
/*!40000 ALTER TABLE `rates` ENABLE KEYS */;

-- Дамп структуры для таблица yety.users
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
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=utf8;

-- Дамп данных таблицы yety.users: ~2 rows (приблизительно)
/*!40000 ALTER TABLE `users` DISABLE KEYS */;
INSERT INTO `users` (`id`, `registration_date`, `email`, `user_name`, `user_password`, `user_contact`) VALUES
	(1, '2021-03-20 11:34:30', 'sj@groove.com', 'sjfromgroove', '12345', '88005555535'),
	(2, '2021-03-20 11:34:30', 'tykva@gmail.com', 'tykva', '12345', 'https://t.me/sakh_TopSecret');
/*!40000 ALTER TABLE `users` ENABLE KEYS */;

/*!40101 SET SQL_MODE=IFNULL(@OLD_SQL_MODE, '') */;
/*!40014 SET FOREIGN_KEY_CHECKS=IF(@OLD_FOREIGN_KEY_CHECKS IS NULL, 1, @OLD_FOREIGN_KEY_CHECKS) */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
