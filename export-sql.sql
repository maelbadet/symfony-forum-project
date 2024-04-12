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


-- Dumping database structure for forum_test
DROP DATABASE IF EXISTS `forum_test`;
CREATE DATABASE IF NOT EXISTS `forum_test` /*!40100 DEFAULT CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci */ /*!80016 DEFAULT ENCRYPTION='N' */;
USE `forum_test`;

-- Dumping structure for table forum_test.board
DROP TABLE IF EXISTS `board`;
CREATE TABLE IF NOT EXISTS `board` (
  `id` int NOT NULL AUTO_INCREMENT,
  `name` varchar(100) COLLATE utf8mb4_unicode_ci NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=12 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- Dumping data for table forum_test.board: ~11 rows (approximately)
DELETE FROM `board`;
INSERT INTO `board` (`id`, `name`) VALUES
	(1, 'action et aventure'),
	(2, 'board 2'),
	(3, 'board 3'),
	(4, 'board 4'),
	(5, 'board 5'),
	(6, 'board 6'),
	(7, 'board 7'),
	(8, 'board 8'),
	(9, 'board 9'),
	(10, 'board 10'),
	(11, 'comment faire un formulaire en javascript');

-- Dumping structure for table forum_test.board_category
DROP TABLE IF EXISTS `board_category`;
CREATE TABLE IF NOT EXISTS `board_category` (
  `board_id` int NOT NULL,
  `category_id` int NOT NULL,
  PRIMARY KEY (`board_id`,`category_id`),
  KEY `IDX_96BB1A78E7EC5785` (`board_id`),
  KEY `IDX_96BB1A7812469DE2` (`category_id`),
  CONSTRAINT `FK_96BB1A7812469DE2` FOREIGN KEY (`category_id`) REFERENCES `category` (`id`) ON DELETE CASCADE,
  CONSTRAINT `FK_96BB1A78E7EC5785` FOREIGN KEY (`board_id`) REFERENCES `board` (`id`) ON DELETE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- Dumping data for table forum_test.board_category: ~10 rows (approximately)
DELETE FROM `board_category`;
INSERT INTO `board_category` (`board_id`, `category_id`) VALUES
	(1, 1),
	(2, 1),
	(3, 1),
	(4, 1),
	(5, 5),
	(6, 6),
	(7, 7),
	(8, 8),
	(9, 9),
	(10, 10),
	(11, 8);

-- Dumping structure for table forum_test.category
DROP TABLE IF EXISTS `category`;
CREATE TABLE IF NOT EXISTS `category` (
  `id` int NOT NULL AUTO_INCREMENT,
  `name` varchar(100) COLLATE utf8mb4_unicode_ci NOT NULL,
  `role_access` varchar(100) COLLATE utf8mb4_unicode_ci NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=12 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- Dumping data for table forum_test.category: ~10 rows (approximately)
DELETE FROM `category`;
INSERT INTO `category` (`id`, `name`, `role_access`) VALUES
	(1, 'action et aventure', '["ROLE_USER"]'),
	(2, 'roman', '["ROLE_USER"]'),
	(3, 'polar', '["ROLE_USER"]'),
	(4, 'science fiction', '["ROLE_USER"]'),
	(5, 'fantastique', '["ROLE_USER"]'),
	(6, 'pourqoi pas', '["ROLE_USER"]'),
	(7, 'symfony', '["ROLE_USER"]'),
	(8, 'javascript', '["ROLE_USER"]'),
	(9, 'php', '["ROLE_USER"]'),
	(10, 'html/css', '["ROLE_USER"]'),
	(11, 'sjfhbvoh;aus r', '["ROLE_USER"]');

-- Dumping structure for table forum_test.doctrine_migration_versions
DROP TABLE IF EXISTS `doctrine_migration_versions`;
CREATE TABLE IF NOT EXISTS `doctrine_migration_versions` (
  `version` varchar(191) COLLATE utf8mb3_unicode_ci NOT NULL,
  `executed_at` datetime DEFAULT NULL,
  `execution_time` int DEFAULT NULL,
  PRIMARY KEY (`version`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb3 COLLATE=utf8mb3_unicode_ci;

-- Dumping data for table forum_test.doctrine_migration_versions: ~4 rows (approximately)
DELETE FROM `doctrine_migration_versions`;
INSERT INTO `doctrine_migration_versions` (`version`, `executed_at`, `execution_time`) VALUES
	('DoctrineMigrations\\Version20240409153520', '2024-04-09 15:37:47', 525),
	('DoctrineMigrations\\Version20240410131705', '2024-04-10 13:17:19', 65),
	('DoctrineMigrations\\Version20240411083511', '2024-04-11 08:35:30', 285),
	('DoctrineMigrations\\Version20240411094903', '2024-04-11 09:49:09', 32),
	('DoctrineMigrations\\Version20240412140306', '2024-04-12 14:03:21', 75);

-- Dumping structure for table forum_test.message
DROP TABLE IF EXISTS `message`;
CREATE TABLE IF NOT EXISTS `message` (
  `id` int NOT NULL AUTO_INCREMENT,
  `user_entity_id` int DEFAULT NULL,
  `content` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` datetime DEFAULT NULL,
  `updated_at` datetime DEFAULT NULL,
  `deleted_at` datetime DEFAULT NULL,
  `topic_id` int DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `IDX_B6BD307F81C5F0B9` (`user_entity_id`),
  KEY `IDX_B6BD307F1F55203D` (`topic_id`),
  CONSTRAINT `FK_B6BD307F1F55203D` FOREIGN KEY (`topic_id`) REFERENCES `topic` (`id`),
  CONSTRAINT `FK_B6BD307F81C5F0B9` FOREIGN KEY (`user_entity_id`) REFERENCES `user` (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=12 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- Dumping data for table forum_test.message: ~3 rows (approximately)
DELETE FROM `message`;
INSERT INTO `message` (`id`, `user_entity_id`, `content`, `created_at`, `updated_at`, `deleted_at`, `topic_id`) VALUES
	(1, 1, 'va;soduhgapvwou', '2024-04-11 10:30:06', '2024-04-11 10:30:07', '2024-04-11 10:30:08', 1),
	(2, 1, ' egjhrgeahpu erap hueroapp hu heaohpeo uuopgeg ', '2024-04-11 10:30:06', '2024-04-11 10:30:07', '2024-04-11 10:30:08', 1),
	(3, 1, 'sijhavhl alihrga eiyropi rhawp', '2024-04-11 10:30:06', '2024-04-11 10:30:07', '2024-04-11 10:30:08', 1),
	(4, NULL, 'lorem ipsum', NULL, NULL, NULL, 1),
	(5, 1, 'rwtweergers', NULL, NULL, NULL, 1),
	(6, 1, 'glsaihre;l uahwuo;ag;pou aewr', NULL, NULL, NULL, 1),
	(7, 1, 'reg werergersg er', '2024-04-12 07:59:59', NULL, NULL, 1),
	(8, 1, 'bla bla bla', '2024-04-12 10:01:22', NULL, NULL, 1),
	(9, 1, 's;oughog a;pg', '2024-04-12 11:12:38', NULL, NULL, 1),
	(10, 1, 'vkhjas; rhjaawruj;ho;liug ahuiraggaagojrgaep[', '2024-04-12 12:00:51', NULL, NULL, 8),
	(11, 1, 'egerregsere egesgess', '2024-04-12 14:34:38', NULL, NULL, 1);

-- Dumping structure for table forum_test.messenger_messages
DROP TABLE IF EXISTS `messenger_messages`;
CREATE TABLE IF NOT EXISTS `messenger_messages` (
  `id` bigint NOT NULL AUTO_INCREMENT,
  `body` longtext COLLATE utf8mb4_unicode_ci NOT NULL,
  `headers` longtext COLLATE utf8mb4_unicode_ci NOT NULL,
  `queue_name` varchar(190) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` datetime NOT NULL COMMENT '(DC2Type:datetime_immutable)',
  `available_at` datetime NOT NULL COMMENT '(DC2Type:datetime_immutable)',
  `delivered_at` datetime DEFAULT NULL COMMENT '(DC2Type:datetime_immutable)',
  PRIMARY KEY (`id`),
  KEY `IDX_75EA56E0FB7336F0` (`queue_name`),
  KEY `IDX_75EA56E0E3BD61CE` (`available_at`),
  KEY `IDX_75EA56E016BA31DB` (`delivered_at`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- Dumping data for table forum_test.messenger_messages: ~0 rows (approximately)
DELETE FROM `messenger_messages`;

-- Dumping structure for table forum_test.topic
DROP TABLE IF EXISTS `topic`;
CREATE TABLE IF NOT EXISTS `topic` (
  `id` int NOT NULL AUTO_INCREMENT,
  `user_entity_id` int DEFAULT NULL,
  `board_id` int DEFAULT NULL,
  `title` varchar(100) COLLATE utf8mb4_unicode_ci NOT NULL,
  `content` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` datetime DEFAULT NULL,
  `updated_at` datetime DEFAULT NULL,
  `deleted_at` datetime DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `IDX_9D40DE1BE7EC5785` (`board_id`),
  KEY `IDX_9D40DE1B81C5F0B9` (`user_entity_id`),
  CONSTRAINT `FK_9D40DE1B81C5F0B9` FOREIGN KEY (`user_entity_id`) REFERENCES `user` (`id`),
  CONSTRAINT `FK_9D40DE1BE7EC5785` FOREIGN KEY (`board_id`) REFERENCES `board` (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=10 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- Dumping data for table forum_test.topic: ~7 rows (approximately)
DELETE FROM `topic`;
INSERT INTO `topic` (`id`, `user_entity_id`, `board_id`, `title`, `content`, `created_at`, `updated_at`, `deleted_at`) VALUES
	(1, 1, 1, 'salutation', 'agasgr', '2024-04-11 10:28:02', '2024-04-11 10:28:03', '2024-04-11 10:28:04'),
	(3, 1, 2, 'gerhlga h', 'gaer ree', '2024-04-11 11:45:46', '2024-04-11 11:45:46', '2024-04-11 11:45:47'),
	(5, 1, 2, 'gerhlga h', 'gaer ree', '2024-04-11 11:45:46', '2024-04-11 11:45:46', '2024-04-11 11:45:47'),
	(6, 1, 2, 'gerhlga h', 'gaer ree', '2024-04-11 11:45:46', '2024-04-11 11:45:46', '2024-04-11 11:45:47'),
	(7, 1, 2, 'gerhlga h', 'gaer ree', '2024-04-11 11:45:46', '2024-04-11 11:45:46', '2024-04-11 11:45:47'),
	(8, NULL, 11, 'faire avec un for', 'grawgareraes aergragrawe', NULL, NULL, NULL),
	(9, NULL, 1, 'eoiugae ouhyrewua', 'abvaoiuerbo ar[epuer', NULL, NULL, NULL);

-- Dumping structure for table forum_test.user
DROP TABLE IF EXISTS `user`;
CREATE TABLE IF NOT EXISTS `user` (
  `id` int NOT NULL AUTO_INCREMENT,
  `email` varchar(180) COLLATE utf8mb4_unicode_ci NOT NULL,
  `roles` json NOT NULL,
  `password` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `username` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `is_blocked` tinyint(1) NOT NULL,
  `profile_image` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `UNIQ_IDENTIFIER_EMAIL` (`email`)
) ENGINE=InnoDB AUTO_INCREMENT=9 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- Dumping data for table forum_test.user: ~5 rows (approximately)
DELETE FROM `user`;
INSERT INTO `user` (`id`, `email`, `roles`, `password`, `username`, `is_blocked`, `profile_image`) VALUES
	(1, 'tata@gmail.Com', '["ROLE_ADMIN"]', '$2y$13$Oy7qEYFzgeALd9DjMWTypOZxpszlepHEv60emLrR6zSPSoFnshUVu', 'salutation', 0, '66193ffae46e6.png'),
	(5, 'leon@external.fr', '["ROLE_EXTERNE"]', '$2y$13$PvmmPZZThU/dpsWxRusGTu0Oydv/A9DuiXzXnJD32a3EvpW942ofa', NULL, 0, NULL),
	(6, 'kilian@collaborator.fr', '["ROLE_COLLABORATION"]', '$2y$13$uatWEjDwW.P3EPDGxkQENuFEwNOXO7krEW5yRQmZzHk9xpJwQsMYW', NULL, 0, NULL),
	(7, 'mael@insider.fr', '["ROLE_INSIDER"]', '$2y$13$t1Im8UQ2EMdZRLwmmvSF8eFl6U00VyxJ4mn9mptk9UbDhAFfPh41.', NULL, 0, NULL),
	(8, 'mael.badet@livecampus.tech', '["ROLE_ADMIN"]', '$2y$13$zMZne1QzlO5/XTZon/5.SOsFNwKFxBwFku/kTi58KPVMRWf4r2Kea', NULL, 0, NULL);

/*!40103 SET TIME_ZONE=IFNULL(@OLD_TIME_ZONE, 'system') */;
/*!40101 SET SQL_MODE=IFNULL(@OLD_SQL_MODE, '') */;
/*!40014 SET FOREIGN_KEY_CHECKS=IFNULL(@OLD_FOREIGN_KEY_CHECKS, 1) */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40111 SET SQL_NOTES=IFNULL(@OLD_SQL_NOTES, 1) */;
