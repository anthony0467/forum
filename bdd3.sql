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
CREATE DATABASE IF NOT EXISTS `forum` /*!40100 DEFAULT CHARACTER SET latin1 */ /*!80016 DEFAULT ENCRYPTION='N' */;
USE `forum`;

-- Listage de la structure de table forum. category
CREATE TABLE IF NOT EXISTS `category` (
  `id_category` int NOT NULL AUTO_INCREMENT,
  `nameCategory` varchar(30) COLLATE utf8mb3_bin NOT NULL,
  PRIMARY KEY (`id_category`)
) ENGINE=InnoDB AUTO_INCREMENT=11 DEFAULT CHARSET=utf8mb3 COLLATE=utf8mb3_bin;

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
  `textPost` longtext COLLATE utf8mb3_bin NOT NULL,
  `dateCreationMessage` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `topic_id` int DEFAULT NULL,
  `user_id` int DEFAULT NULL,
  `likePost` int DEFAULT '0',
  PRIMARY KEY (`id_post`) USING BTREE,
  KEY `topic` (`topic_id`),
  KEY `memberMessage` (`user_id`) USING BTREE,
  CONSTRAINT `topic` FOREIGN KEY (`topic_id`) REFERENCES `topic` (`id_topic`),
  CONSTRAINT `userMessage` FOREIGN KEY (`user_id`) REFERENCES `user` (`id_user`)
) ENGINE=InnoDB AUTO_INCREMENT=131 DEFAULT CHARSET=utf8mb3 COLLATE=utf8mb3_bin;

-- Listage des données de la table forum.post : ~25 rows (environ)
INSERT INTO `post` (`id_post`, `textPost`, `dateCreationMessage`, `topic_id`, `user_id`, `likePost`) VALUES
	(31, 'cccccc', '2023-03-27 11:55:44', 10, 1, 2),
	(48, 'test\r\n', '2023-03-29 11:49:00', 10, 3, 0),
	(50, 'aaa', '2023-03-29 11:49:08', 10, 3, 0),
	(75, 'zdzdd', '2023-03-30 10:40:20', 12, 3, 7),
	(76, 'zdzd', '2023-03-30 10:40:22', 12, 3, 3),
	(105, 'aaaqddq\r\n', '2023-03-31 07:58:25', 33, 3, 2),
	(108, 'asa', '2023-03-31 08:36:51', 35, 3, 8),
	(109, 'aa', '2023-03-31 09:43:56', 36, 2, 2),
	(110, '\r\n', '2023-03-31 09:46:47', 12, 2, 1),
	(111, 'csc', '2023-03-31 11:33:54', 37, 2, 4),
	(112, 'test', '2023-03-31 13:23:53', 37, 3, 2),
	(113, 'coucu', '2023-03-31 14:33:11', 10, 3, 0),
	(117, 'adada', '2023-03-31 15:06:53', 38, 3, 0),
	(118, 'gfgrg', '2023-03-31 15:36:49', 39, 3, 1),
	(119, 'Contrary to popular belief, Lorem Ipsum is not simply random text. It has roots in a piece of classical Latin literature from 45 BC, making it over 2000 years old. Richard McClintock, a Latin professor at Hampden-Sydney College in Virginia, looked up one of the more obscure Latin words, consectetur, from a Lorem Ipsum passage, and going through the cites of the word in classical literature, discovered the undoubtable source.', '2023-04-01 17:12:52', 40, 13, 0),
	(120, 'someone?\r\n', '2023-04-02 11:18:37', 40, 3, 0),
	(121, 'bonjour', '2023-04-02 11:19:37', 41, 3, 2),
	(122, 'Lorem ipsum dolor sit amet, consectetur adipiscing elit. Fusce laoreet sodales lorem. Vivamus rhoncus, risus ut dapibus laoreet, urna felis interdum lorem, non faucibus est augue et arcu. Pellentesque et nisl mauris. Sed tincidunt egestas tincidunt. Donec dictum nec tortor ut tempor. Phasellus condimentum ligula sit amet est finibus posuere. Vivamus lacus est, rhoncus nec ultricies vel, tempus sed nisi. Praesent et varius justo, eu laoreet nunc. Donec tristique dolor nec rutrum dictum. Nam a libero nulla. Vivamus gravida sem sed nunc mattis, sed accumsan est vulputate.', '2023-04-02 13:51:06', 42, 3, 0),
	(123, 'Etiam bibendum neque non congue viverra. Aliquam at erat at quam fringilla suscipit. Praesent eu lectus eu felis rutrum iaculis sed sed metus. Vivamus vel posuere erat, a luctus ligula. Nullam maximus, velit quis tristique pulvinar, nisi ipsum egestas est, placerat auctor odio neque a odio. Mauris nibh mauris, vehicula vitae lorem facilisis, elementum convallis ex. Integer aliquet congue faucibus. Nunc fermentum lobortis accumsan. Aliquam at viverra metus. Mauris vehicula fermentum condimentum. In quis orci quam. Integer quis ultrices metus, sed commodo erat. Nullam aliquam tristique nisl, nec laoreet urna euismod at. Quisque at ante ut orci fringilla placerat. Donec vulputate lorem in purus accumsan convallis.', '2023-04-02 18:18:13', 43, 3, 2),
	(124, 'Phasellus condimentum ligula sit amet est finibus posuere. Vivamus lacus est, rhoncus nec ultricies vel, tempus sed nisi. Praesent et varius justo, eu laoreet nunc. Donec tristique dolor nec rutrum dictum. Nam a libero nulla. Vivamus gravida sem sed nunc mattis, sed accumsan est vulputate.', '2023-04-02 18:18:29', 43, 3, 1),
	(125, 'Duis ullamcorper, enim vel sagittis tempus, velit neque iaculis libero, ac dignissim ex elit vitae mauris. In tincidunt lacinia ligula ac bibendum. Vivamus lectus nisl, dictum sit amet augue id, euismod pretium velit. Orci varius natoque penatibus et magnis dis parturient montes, nascetur ridiculus mus. Vivamus quis nisi sit amet risus lobortis ullamcorper. Quisque lobortis enim ac gravida tristique. Duis non laoreet magna. Morbi ut ultricies eros. Quisque lectus ipsum, tempus in faucibus luctus, gravida in sapien. Aliquam id massa vitae leo commodo molestie. Vivamus rutrum erat vel purus interdum porttitor. Nam viverra a sapien ut semper. Phasellus congue tincidunt rutrum. Curabitur quis venenatis neque. Vivamus augue ante, aliquet non turpis in, ornare feugiat dolor.', '2023-04-02 18:19:02', 44, 3, 1),
	(126, 'Vivamus porttitor neque porttitor lacus placerat fringilla. Cras porttitor metus metus, eget aliquam purus elementum non. Integer tincidunt egestas sapien in pellentesque. Proin vitae tellus nisi. Sed ut augue purus. Sed tempus, tellus sit amet blandit ultrices, magna lacus volutpat magna, quis tincidunt urna dui non velit. Pellentesque nec mollis felis. Vivamus ullamcorper rhoncus odio.', '2023-04-03 10:02:26', 43, 3, 0),
	(128, 'In arcu quam, sodales et pretium quis, luctus malesuada sem. Nam augue dolor, pellentesque sed feugiat ut, luctus ac ex. Duis ac justo vulputate, maximus tortor id, bibendum urna. Etiam ac magna venenatis, tristique eros non, vulputate massa. Fusce quis elit sed ex molestie suscipit.', '2023-04-03 10:03:23', 43, 3, 0),
	(129, 'Orci varius natoque penatibus et magnis dis parturient montes, nascetur ridiculus mus. Pellentesque habitant morbi tristique senectus et netus et malesuada fames ac turpis egestas. Nullam suscipit at elit at faucibus. Morbi turpis nibh, consectetur at augue id, dignissim ultricies eros.', '2023-04-03 10:03:41', 43, 3, 0),
	(130, 'Morbi turpis nibh, consectetur at augue id, dignissim ultricies eros.\r\n\r\n', '2023-04-03 10:25:27', 43, 12, 0);

-- Listage de la structure de table forum. topic
CREATE TABLE IF NOT EXISTS `topic` (
  `id_topic` int NOT NULL AUTO_INCREMENT,
  `title` varchar(50) COLLATE utf8mb3_bin NOT NULL,
  `dateCreationTopic` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `locked` tinyint NOT NULL DEFAULT '0',
  `user_id` int DEFAULT NULL,
  `category_id` int DEFAULT NULL,
  PRIMARY KEY (`id_topic`),
  KEY `category` (`category_id`),
  KEY `member` (`user_id`) USING BTREE,
  CONSTRAINT `category` FOREIGN KEY (`category_id`) REFERENCES `category` (`id_category`),
  CONSTRAINT `user` FOREIGN KEY (`user_id`) REFERENCES `user` (`id_user`)
) ENGINE=InnoDB AUTO_INCREMENT=45 DEFAULT CHARSET=utf8mb3 COLLATE=utf8mb3_bin;

-- Listage des données de la table forum.topic : ~13 rows (environ)
INSERT INTO `topic` (`id_topic`, `title`, `dateCreationTopic`, `locked`, `user_id`, `category_id`) VALUES
	(10, 'testecccccc', '2023-03-27 11:55:44', 0, 1, 7),
	(12, 'aaa', '2023-03-27 13:51:06', 0, 1, 5),
	(33, 'nouveau', '2023-03-31 07:58:25', 0, 3, 1),
	(35, 'test', '2023-03-31 08:36:51', 0, 3, 2),
	(36, 'teste like', '2023-03-31 09:43:56', 1, 2, 1),
	(37, 'csc', '2023-03-31 11:33:54', 0, 2, 6),
	(38, 'adad', '2023-03-31 15:06:53', 0, 3, 1),
	(39, 'tttt', '2023-03-31 15:36:49', 0, 3, 2),
	(40, 'Where does it come from?', '2023-04-01 17:12:52', 1, 13, 1),
	(41, 'teste actu', '2023-04-02 11:19:37', 0, 3, 4),
	(42, 'Lorem Ipsum', '2023-04-02 13:51:06', 0, 3, 6),
	(43, 'lorem ispum', '2023-04-02 18:18:13', 0, 3, 4),
	(44, 'Phasellus tristique orci turpis.', '2023-04-02 18:19:02', 0, 3, 5);

-- Listage de la structure de table forum. user
CREATE TABLE IF NOT EXISTS `user` (
  `id_user` int NOT NULL AUTO_INCREMENT,
  `email` varchar(50) COLLATE utf8mb3_bin NOT NULL,
  `pseudo` varchar(50) COLLATE utf8mb3_bin NOT NULL,
  `password` varchar(255) COLLATE utf8mb3_bin NOT NULL,
  `role` varchar(50) CHARACTER SET utf8mb3 COLLATE utf8mb3_bin DEFAULT 'membre',
  `dateCreationMember` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `status` tinyint DEFAULT '0',
  PRIMARY KEY (`id_user`) USING BTREE
) ENGINE=InnoDB AUTO_INCREMENT=16 DEFAULT CHARSET=utf8mb3 COLLATE=utf8mb3_bin;

-- Listage des données de la table forum.user : ~13 rows (environ)
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
	(12, 'ata@fr.fr', 'aqww', '$2y$10$zdVjkI850GZGhGcnJq1KTuQiLu46MxY8EdfIYe9pAFDPpPfuer4wC', 'membre', '2023-03-28 10:43:59', 0),
	(13, 'qsd@fr.fr', 'bouboule', '$2y$10$TGXWLRfg8Z4n51SMAJC0m.Q3TBzJ5Bg5hQd0GicJQOak2DreVsFYG', 'membre', '2023-04-01 10:33:58', 0),
	(14, 'last@fr.fr', 'Last', '$2y$10$/tFr8qzqmaH/T6Mg9YjwCOV6JWGHcjpo0F3HUdijv72H7xS9sSFYy', 'membre', '2023-04-03 16:34:20', 0),
	(15, 'an@fr.fr', 'anotherTest', '$2y$10$1vYsCXICj1OHY0SKsZWZD.ivKU7qX6lrlgsOv1Q4MvYvbnnyJq.Vq', 'membre', '2023-04-03 16:36:58', 0);

/*!40103 SET TIME_ZONE=IFNULL(@OLD_TIME_ZONE, 'system') */;
/*!40101 SET SQL_MODE=IFNULL(@OLD_SQL_MODE, '') */;
/*!40014 SET FOREIGN_KEY_CHECKS=IFNULL(@OLD_FOREIGN_KEY_CHECKS, 1) */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40111 SET SQL_NOTES=IFNULL(@OLD_SQL_NOTES, 1) */;
