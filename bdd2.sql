-- --------------------------------------------------------
-- Hôte:                         127.0.0.1
-- Version du serveur:           5.7.33 - MySQL Community Server (GPL)
-- SE du serveur:                Win64
-- HeidiSQL Version:             11.2.0.6213
-- --------------------------------------------------------

/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET NAMES utf8 */;
/*!50503 SET NAMES utf8mb4 */;
/*!40014 SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0 */;
/*!40101 SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='NO_AUTO_VALUE_ON_ZERO' */;
/*!40111 SET @OLD_SQL_NOTES=@@SQL_NOTES, SQL_NOTES=0 */;


-- Listage de la structure de la base pour forum
CREATE DATABASE IF NOT EXISTS `forum` /*!40100 DEFAULT CHARACTER SET latin1 */;
USE `forum`;

-- Listage de la structure de la table forum. category
CREATE TABLE IF NOT EXISTS `category` (
  `id_category` int(11) NOT NULL AUTO_INCREMENT,
  `nameCategory` varchar(30) NOT NULL,
  PRIMARY KEY (`id_category`)
) ENGINE=InnoDB AUTO_INCREMENT=11 DEFAULT CHARSET=utf8mb4;

-- Listage des données de la table forum.category : ~8 rows (environ)
/*!40000 ALTER TABLE `category` DISABLE KEYS */;
INSERT INTO `category` (`id_category`, `nameCategory`) VALUES
	(1, 'Générale'),
	(2, 'Technologie'),
	(3, 'Loisir et sport'),
	(4, 'Actualités'),
	(5, 'Carrière et emploi'),
	(6, 'Politique'),
	(7, 'Education'),
	(8, 'Santé et bien-être');
/*!40000 ALTER TABLE `category` ENABLE KEYS */;

-- Listage de la structure de la table forum. post
CREATE TABLE IF NOT EXISTS `post` (
  `id_post` int(11) NOT NULL AUTO_INCREMENT,
  `textPost` longtext NOT NULL,
  `dateCreationMessage` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `topic_id` int(11) DEFAULT NULL,
  `user_id` int(11) DEFAULT NULL,
  PRIMARY KEY (`id_post`) USING BTREE,
  KEY `topic` (`topic_id`),
  KEY `memberMessage` (`user_id`) USING BTREE,
  CONSTRAINT `topic` FOREIGN KEY (`topic_id`) REFERENCES `topic` (`id_topic`),
  CONSTRAINT `userMessage` FOREIGN KEY (`user_id`) REFERENCES `user` (`id_user`)
) ENGINE=InnoDB AUTO_INCREMENT=105 DEFAULT CHARSET=utf8mb4;

-- Listage des données de la table forum.post : ~5 rows (environ)
/*!40000 ALTER TABLE `post` DISABLE KEYS */;
INSERT INTO `post` (`id_post`, `textPost`, `dateCreationMessage`, `topic_id`, `user_id`) VALUES
	(31, 'cccccc', '2023-03-27 11:55:44', 10, 1),
	(48, 'test\r\n', '2023-03-29 11:49:00', 10, 3),
	(50, 'aaa', '2023-03-29 11:49:08', 10, 3),
	(75, 'zdzdd', '2023-03-30 10:40:20', 12, 3),
	(76, 'zdzd', '2023-03-30 10:40:22', 12, 3);
/*!40000 ALTER TABLE `post` ENABLE KEYS */;

-- Listage de la structure de la table forum. topic
CREATE TABLE IF NOT EXISTS `topic` (
  `id_topic` int(11) NOT NULL AUTO_INCREMENT,
  `title` varchar(50) NOT NULL,
  `dateCreationTopic` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `locked` tinyint(4) NOT NULL DEFAULT '0',
  `user_id` int(11) DEFAULT NULL,
  `category_id` int(11) DEFAULT NULL,
  PRIMARY KEY (`id_topic`),
  KEY `category` (`category_id`),
  KEY `member` (`user_id`) USING BTREE,
  CONSTRAINT `category` FOREIGN KEY (`category_id`) REFERENCES `category` (`id_category`),
  CONSTRAINT `user` FOREIGN KEY (`user_id`) REFERENCES `user` (`id_user`)
) ENGINE=InnoDB AUTO_INCREMENT=33 DEFAULT CHARSET=utf8mb4;

-- Listage des données de la table forum.topic : ~4 rows (environ)
/*!40000 ALTER TABLE `topic` DISABLE KEYS */;
INSERT INTO `topic` (`id_topic`, `title`, `dateCreationTopic`, `locked`, `user_id`, `category_id`) VALUES
	(8, 'qdqd ddqqdq', '2023-03-27 11:53:58', 1, 1, 4),
	(10, 'testecccccc', '2023-03-27 11:55:44', 0, 1, 7),
	(12, 'aaa', '2023-03-27 13:51:06', 0, 1, 5),
	(25, 'test', '2023-03-29 16:30:54', 1, 3, 1);
/*!40000 ALTER TABLE `topic` ENABLE KEYS */;

-- Listage de la structure de la table forum. user
CREATE TABLE IF NOT EXISTS `user` (
  `id_user` int(11) NOT NULL AUTO_INCREMENT,
  `email` varchar(50) NOT NULL,
  `pseudo` varchar(50) NOT NULL,
  `password` varchar(255) NOT NULL,
  `role` varchar(50) DEFAULT NULL,
  `dateCreationMember` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `status` tinyint(4) DEFAULT '0',
  PRIMARY KEY (`id_user`) USING BTREE
) ENGINE=InnoDB AUTO_INCREMENT=13 DEFAULT CHARSET=utf8mb4;

-- Listage des données de la table forum.user : ~10 rows (environ)
/*!40000 ALTER TABLE `user` DISABLE KEYS */;
INSERT INTO `user` (`id_user`, `email`, `pseudo`, `password`, `role`, `dateCreationMember`, `status`) VALUES
	(1, 'test@test.fr', 'test12', '$2y$10$zdVjkI850GZGhGcnJq1KTuQiLu46MxY8EdfIYe9pAFDPpPfuer4wC', 'membre', '2023-03-24 10:17:17', 1),
	(2, 'test2@test.fr', 'pseudotest', '$2y$10$zdVjkI850GZGhGcnJq1KTuQiLu46MxY8EdfIYe9pAFDPpPfuer4wC', 'membre', '2023-03-24 16:34:27', 0),
	(3, 'antho04100m@gmail.com', 'toto', '$2y$10$zdVjkI850GZGhGcnJq1KTuQiLu46MxY8EdfIYe9pAFDPpPfuer4wC', 'admin', '2023-03-27 16:12:09', 0),
	(6, 'toto@hotmail.fr', 'adada', '$2y$10$zdVjkI850GZGhGcnJq1KTuQiLu46MxY8EdfIYe9pAFDPpPfuer4wC', 'membre', '2023-03-27 16:20:39', 0),
	(7, 'dd@gg.fr', 'qdqqx', '$2y$10$zdVjkI850GZGhGcnJq1KTuQiLu46MxY8EdfIYe9pAFDPpPfuer4wC', 'membre', '2023-03-27 16:24:58', 0),
	(8, 'da@fe.com', 'wqwq', '$2y$10$zdVjkI850GZGhGcnJq1KTuQiLu46MxY8EdfIYe9pAFDPpPfuer4wC', 'membre', '2023-03-27 16:28:31', 0),
	(9, 'nin@nan', 'aaa', '$2y$10$zdVjkI850GZGhGcnJq1KTuQiLu46MxY8EdfIYe9pAFDPpPfuer4wC', 'membre', '2023-03-27 16:33:44', 1),
	(10, 'titi@test.fr', 'bibou', '$2y$10$zdVjkI850GZGhGcnJq1KTuQiLu46MxY8EdfIYe9pAFDPpPfuer4wC', 'membre', '2023-03-28 08:33:15', 1),
	(11, 'tutu@tt.fr', 'bil', '$2y$10$zdVjkI850GZGhGcnJq1KTuQiLu46MxY8EdfIYe9pAFDPpPfuer4wC', 'membre', '2023-03-28 08:43:12', 0),
	(12, 'ata@fr.fr', 'aqww', '$2y$10$zdVjkI850GZGhGcnJq1KTuQiLu46MxY8EdfIYe9pAFDPpPfuer4wC', 'membre', '2023-03-28 10:43:59', 0);
/*!40000 ALTER TABLE `user` ENABLE KEYS */;

/*!40101 SET SQL_MODE=IFNULL(@OLD_SQL_MODE, '') */;
/*!40014 SET FOREIGN_KEY_CHECKS=IFNULL(@OLD_FOREIGN_KEY_CHECKS, 1) */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40111 SET SQL_NOTES=IFNULL(@OLD_SQL_NOTES, 1) */;
