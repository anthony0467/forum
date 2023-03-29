-- --------------------------------------------------------
-- Hôte:                         127.0.0.1
-- Version du serveur:           8.0.30 - MySQL Community Server - GPL
-- SE du serveur:                Win64
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


-- Listage de la structure de la base pour forum
CREATE DATABASE IF NOT EXISTS `forum` /*!40100 DEFAULT CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci */ /*!80016 DEFAULT ENCRYPTION='N' */;
USE `forum`;

-- Listage de la structure de table forum. category
CREATE TABLE IF NOT EXISTS `category` (
  `id_category` int NOT NULL AUTO_INCREMENT,
  `nameCategory` varchar(30) NOT NULL,
  PRIMARY KEY (`id_category`)
) ENGINE=InnoDB AUTO_INCREMENT=11 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

-- Listage des données de la table forum.category : ~8 rows (environ)
INSERT INTO `category` (`id_category`, `nameCategory`) VALUES
	(1, 'Générale'),
	(2, 'Technologie'),
	(3, 'Loisir et sport'),
	(4, 'Actualités'),
	(5, 'Carrière et emploi'),
	(6, 'Politique'),
	(7, 'Education'),
	(8, 'Santé et bien-être');

-- Listage de la structure de table forum. post
CREATE TABLE IF NOT EXISTS `post` (
  `id_post` int NOT NULL AUTO_INCREMENT,
  `textPost` longtext CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci NOT NULL,
  `dateCreationMessage` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `topic_id` int DEFAULT NULL,
  `user_id` int DEFAULT NULL,
  PRIMARY KEY (`id_post`) USING BTREE,
  KEY `topic` (`topic_id`),
  KEY `memberMessage` (`user_id`) USING BTREE,
  CONSTRAINT `topic` FOREIGN KEY (`topic_id`) REFERENCES `topic` (`id_topic`),
  CONSTRAINT `userMessage` FOREIGN KEY (`user_id`) REFERENCES `user` (`id_user`)
) ENGINE=InnoDB AUTO_INCREMENT=69 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

-- Listage des données de la table forum.post : ~16 rows (environ)
INSERT INTO `post` (`id_post`, `textPost`, `dateCreationMessage`, `topic_id`, `user_id`) VALUES
	(31, 'cccccc', '2023-03-27 11:55:44', 10, 1),
	(32, 'je teste le formulaire\r\n', '2023-03-27 12:09:32', 11, 1),
	(33, 'sdddd', '2023-03-27 13:51:06', 12, 1),
	(34, 'ssss', '2023-03-27 13:51:22', 13, 1),
	(35, 'teste education', '2023-03-27 13:52:09', 14, 1),
	(36, 'la technologie !!!!!', '2023-03-27 13:57:06', 15, 1),
	(39, 'non merci', '2023-03-27 15:41:33', 18, 1),
	(40, 'ah ?', '2023-03-27 15:42:04', 18, 1),
	(47, 'bonsoir\r\n', '2023-03-28 19:14:39', 12, 3),
	(48, 'test\r\n', '2023-03-29 11:49:00', 10, 3),
	(50, 'aaa', '2023-03-29 11:49:08', 10, 3),
	(67, 'ttttteeeeest', '2023-03-29 16:30:54', 25, 3);

-- Listage de la structure de table forum. topic
CREATE TABLE IF NOT EXISTS `topic` (
  `id_topic` int NOT NULL AUTO_INCREMENT,
  `title` varchar(50) NOT NULL,
  `dateCreationTopic` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `locked` tinyint NOT NULL DEFAULT '0',
  `user_id` int DEFAULT NULL,
  `category_id` int DEFAULT NULL,
  PRIMARY KEY (`id_topic`),
  KEY `category` (`category_id`),
  KEY `member` (`user_id`) USING BTREE,
  CONSTRAINT `category` FOREIGN KEY (`category_id`) REFERENCES `category` (`id_category`),
  CONSTRAINT `user` FOREIGN KEY (`user_id`) REFERENCES `user` (`id_user`)
) ENGINE=InnoDB AUTO_INCREMENT=26 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

-- Listage des données de la table forum.topic : ~12 rows (environ)
INSERT INTO `topic` (`id_topic`, `title`, `dateCreationTopic`, `locked`, `user_id`, `category_id`) VALUES
	(8, 'qdqd ddqqdq', '2023-03-27 11:53:58', 1, 1, 4),
	(10, 'testecccccc', '2023-03-27 11:55:44', 0, 1, 7),
	(11, 'teste', '2023-03-27 12:09:32', 0, 1, 7),
	(12, 'aaa', '2023-03-27 13:51:06', 0, 1, 5),
	(13, 'ddddd', '2023-03-27 13:51:22', 0, 1, 2),
	(14, 'education', '2023-03-27 13:52:09', 0, 1, 7),
	(15, 'j&#039;aime la techno', '2023-03-27 13:57:06', 0, 1, 2),
	(18, 'coucou', '2023-03-27 15:41:33', 0, 1, 6),
	(25, 'test', '2023-03-29 16:30:54', 1, 3, 1);

-- Listage de la structure de table forum. user
CREATE TABLE IF NOT EXISTS `user` (
  `id_user` int NOT NULL AUTO_INCREMENT,
  `email` varchar(50) NOT NULL,
  `pseudo` varchar(50) CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci NOT NULL,
  `password` varchar(255) NOT NULL,
  `role` varchar(50) DEFAULT NULL,
  `dateCreationMember` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`id_user`) USING BTREE
) ENGINE=InnoDB AUTO_INCREMENT=13 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

-- Listage des données de la table forum.user : ~10 rows (environ)
INSERT INTO `user` (`id_user`, `email`, `pseudo`, `password`, `role`, `dateCreationMember`) VALUES
	(1, 'test@test.fr', 'test12', '$2y$10$zdVjkI850GZGhGcnJq1KTuQiLu46MxY8EdfIYe9pAFDPpPfuer4wC', 'membre', '2023-03-24 10:17:17'),
	(2, 'test2@test.fr', 'pseudotest', '$2y$10$zdVjkI850GZGhGcnJq1KTuQiLu46MxY8EdfIYe9pAFDPpPfuer4wC', 'membre', '2023-03-24 16:34:27'),
	(3, 'antho04100m@gmail.com', 'toto', '$2y$10$zdVjkI850GZGhGcnJq1KTuQiLu46MxY8EdfIYe9pAFDPpPfuer4wC', 'admin', '2023-03-27 16:12:09'),
	(6, 'toto@hotmail.fr', 'adada', '$2y$10$zdVjkI850GZGhGcnJq1KTuQiLu46MxY8EdfIYe9pAFDPpPfuer4wC', 'membre', '2023-03-27 16:20:39'),
	(7, 'dd@gg.fr', 'qdqqx', '$2y$10$zdVjkI850GZGhGcnJq1KTuQiLu46MxY8EdfIYe9pAFDPpPfuer4wC', 'membre', '2023-03-27 16:24:58'),
	(8, 'da@fe.com', 'wqwq', '$2y$10$zdVjkI850GZGhGcnJq1KTuQiLu46MxY8EdfIYe9pAFDPpPfuer4wC', 'membre', '2023-03-27 16:28:31'),
	(9, 'nin@nan', 'aaa', '$2y$10$zdVjkI850GZGhGcnJq1KTuQiLu46MxY8EdfIYe9pAFDPpPfuer4wC', 'membre', '2023-03-27 16:33:44'),
	(10, 'titi@test.fr', 'bibou', '$2y$10$zdVjkI850GZGhGcnJq1KTuQiLu46MxY8EdfIYe9pAFDPpPfuer4wC', 'membre', '2023-03-28 08:33:15'),
	(11, 'tutu@tt.fr', 'bil', '$2y$10$zdVjkI850GZGhGcnJq1KTuQiLu46MxY8EdfIYe9pAFDPpPfuer4wC', 'membre', '2023-03-28 08:43:12'),
	(12, 'ata@fr.fr', 'aqww', '$2y$10$zdVjkI850GZGhGcnJq1KTuQiLu46MxY8EdfIYe9pAFDPpPfuer4wC', 'membre', '2023-03-28 10:43:59');

/*!40103 SET TIME_ZONE=IFNULL(@OLD_TIME_ZONE, 'system') */;
/*!40101 SET SQL_MODE=IFNULL(@OLD_SQL_MODE, '') */;
/*!40014 SET FOREIGN_KEY_CHECKS=IFNULL(@OLD_FOREIGN_KEY_CHECKS, 1) */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40111 SET SQL_NOTES=IFNULL(@OLD_SQL_NOTES, 1) */;
