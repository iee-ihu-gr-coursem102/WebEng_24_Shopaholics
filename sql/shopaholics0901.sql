/*!999999\- enable the sandbox mode */ 
-- MariaDB dump 10.19  Distrib 10.6.18-MariaDB, for debian-linux-gnu (x86_64)
--
-- Host: localhost    Database: shopaholics
-- ------------------------------------------------------
-- Server version	10.6.18-MariaDB-0ubuntu0.22.04.1

/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;
/*!40103 SET @OLD_TIME_ZONE=@@TIME_ZONE */;
/*!40103 SET TIME_ZONE='+00:00' */;
/*!40014 SET @OLD_UNIQUE_CHECKS=@@UNIQUE_CHECKS, UNIQUE_CHECKS=0 */;
/*!40014 SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0 */;
/*!40101 SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='NO_AUTO_VALUE_ON_ZERO' */;
/*!40111 SET @OLD_SQL_NOTES=@@SQL_NOTES, SQL_NOTES=0 */;

--
-- Table structure for table `items`
--

DROP TABLE IF EXISTS `items`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `items` (
  `item_id` int(64) NOT NULL AUTO_INCREMENT,
  `list_id` int(11) NOT NULL,
  `order_id` int(11) NOT NULL,
  `item` varchar(30) NOT NULL,
  `quantity` double DEFAULT NULL,
  `measuring_unit` int(11) NOT NULL,
  `completed` tinyint(1) NOT NULL DEFAULT 0,
  PRIMARY KEY (`item_id`),
  KEY `list_id` (`list_id`),
  CONSTRAINT `items_ibfk_1` FOREIGN KEY (`list_id`) REFERENCES `lists` (`list_id`)
) ENGINE=InnoDB AUTO_INCREMENT=113 DEFAULT CHARSET=utf8mb3 COLLATE=utf8mb3_bin;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `items`
--

LOCK TABLES `items` WRITE;
/*!40000 ALTER TABLE `items` DISABLE KEYS */;
INSERT INTO `items` VALUES (2,39,2,'jeans',1,9,0),(100,32,2,'μακαρόνια',2,10,0),(101,32,1,'τυρί',500,0,0),(102,32,3,'γάλα',1,3,0),(103,32,4,'αφρόλουτρο',1,11,0),(104,33,1,'υαλοκαθαριστήρες',1,12,0),(105,33,2,'λάδια',5,3,0),(106,34,2,'παντελόνι',1,9,0),(107,34,1,'πουκάμισο',1,9,0),(108,34,3,'t-shirt',2,9,0),(109,35,1,'γραβιέρα',0.5,1,0),(110,39,1,'maroon coat',1,10,0),(111,40,1,'LPG Service',300,8,0),(112,40,2,'Snow Socks',2,12,0);
/*!40000 ALTER TABLE `items` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `junc_t_user_list`
--

DROP TABLE IF EXISTS `junc_t_user_list`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `junc_t_user_list` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `user_id` int(11) NOT NULL,
  `list_id` int(11) NOT NULL,
  `list_order_id` int(11) NOT NULL,
  PRIMARY KEY (`id`),
  KEY `user_id` (`user_id`),
  KEY `list_id` (`list_id`),
  CONSTRAINT `junc_t_user_list_ibfk_1` FOREIGN KEY (`user_id`) REFERENCES `users` (`user_id`),
  CONSTRAINT `junc_t_user_list_ibfk_2` FOREIGN KEY (`list_id`) REFERENCES `lists` (`list_id`)
) ENGINE=InnoDB AUTO_INCREMENT=45 DEFAULT CHARSET=utf8mb3 COLLATE=utf8mb3_bin;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `junc_t_user_list`
--

LOCK TABLES `junc_t_user_list` WRITE;
/*!40000 ALTER TABLE `junc_t_user_list` DISABLE KEYS */;
INSERT INTO `junc_t_user_list` VALUES (34,3,32,0),(35,3,33,1),(36,3,34,4),(37,3,35,4),(38,3,36,4),(39,3,37,5),(40,3,38,6),(41,6,39,1),(42,6,40,0),(43,6,41,2),(44,7,42,0);
/*!40000 ALTER TABLE `junc_t_user_list` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `lists`
--

DROP TABLE IF EXISTS `lists`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `lists` (
  `list_id` int(11) NOT NULL AUTO_INCREMENT,
  `title` varchar(30) NOT NULL,
  `category` varchar(30) DEFAULT NULL,
  `icon` blob DEFAULT NULL,
  `active` tinyint(1) NOT NULL,
  `creation_date` date NOT NULL DEFAULT current_timestamp(),
  PRIMARY KEY (`list_id`)
) ENGINE=InnoDB AUTO_INCREMENT=43 DEFAULT CHARSET=utf8mb3 COLLATE=utf8mb3_bin;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `lists`
--

LOCK TABLES `lists` WRITE;
/*!40000 ALTER TABLE `lists` DISABLE KEYS */;
INSERT INTO `lists` VALUES (32,'Μασούτης','1','',1,'2025-01-05'),(33,'Αυτοκίνητο','1','',1,'2025-01-05'),(34,'Ρούχα','1','',1,'2025-01-05'),(35,'Lidl','1','',1,'2025-01-05'),(36,'5','1','',1,'2025-01-05'),(37,'6','1','',1,'2025-01-05'),(38,'7','1','',1,'2025-01-05'),(39,'mall','1','',1,'2025-01-06'),(40,'car','1','',1,'2025-01-06'),(41,'flea market','1','',1,'2025-01-06'),(42,'Car','1','',1,'2025-01-09');
/*!40000 ALTER TABLE `lists` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `users`
--

DROP TABLE IF EXISTS `users`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `users` (
  `user_id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(30) NOT NULL,
  `surname` varchar(30) NOT NULL,
  `email` text NOT NULL,
  `password` varchar(64) NOT NULL,
  `picture` varchar(255) DEFAULT NULL,
  `creation_date` date NOT NULL DEFAULT current_timestamp(),
  `reset_password_token` varchar(64) DEFAULT NULL,
  `token_expiration` datetime DEFAULT NULL,
  PRIMARY KEY (`user_id`)
) ENGINE=InnoDB AUTO_INCREMENT=8 DEFAULT CHARSET=utf8mb3 COLLATE=utf8mb3_bin;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `users`
--

LOCK TABLES `users` WRITE;
/*!40000 ALTER TABLE `users` DISABLE KEYS */;
INSERT INTO `users` VALUES (3,'Περικλής','Βουτσάς','periklis@cocol.gr','$2y$10$b3GM.PLwj6yRO5ZQ/zW71umOm6QV2PdeCaUwXp3IWtKvEdiaI52KS',NULL,'2025-01-04',NULL,NULL),(4,'Νικολέτα','Βουτσά','nikoleta@cocol.gr','$2y$10$Jp0.Wwwod8uV8vfoAKv6Be5Da089YJQ1nyOX.pSeayiLys4PesFmS',NULL,'2025-01-04',NULL,NULL),(6,'Maria','Gregoraki','mariagreg@gmail.com','$2y$10$ToGtn1mYLXmFgPMrNDE1A.z1OM7d1uxrg57uBc45Ks4n0KTdoN6GK',NULL,'2025-01-06',NULL,NULL),(7,'Mel','Ryzen','meladma@gmail.com','$2y$10$ZLz/YmWqbLK9D6aQh/Ghyur.CYp5JEEZ.KRv3OszTiznZcDKFHbLi',NULL,'2025-01-06','23139c98253980e1f803bfd4a456902a9dcdb755b2f5ce15c51df6536b30bce6','2025-01-08 20:56:16');
/*!40000 ALTER TABLE `users` ENABLE KEYS */;
UNLOCK TABLES;
/*!40103 SET TIME_ZONE=@OLD_TIME_ZONE */;

/*!40101 SET SQL_MODE=@OLD_SQL_MODE */;
/*!40014 SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS */;
/*!40014 SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
/*!40111 SET SQL_NOTES=@OLD_SQL_NOTES */;

-- Dump completed on 2025-01-09 22:46:39
