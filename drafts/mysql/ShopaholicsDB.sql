/*!999999\- enable the sandbox mode */ 
-- MariaDB dump 10.19  Distrib 10.6.18-MariaDB, for debian-linux-gnu (x86_64)
--
-- Host: localhost    Database: ShopaholicsDB
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
-- Temporary table structure for view `CAR_NEEDS_VIEW`
--

DROP TABLE IF EXISTS `CAR_NEEDS_VIEW`;
/*!50001 DROP VIEW IF EXISTS `CAR_NEEDS_VIEW`*/;
SET @saved_cs_client     = @@character_set_client;
SET character_set_client = utf8;
/*!50001 CREATE VIEW `CAR_NEEDS_VIEW` AS SELECT
 1 AS `g_Name`,
  1 AS `date`,
  1 AS `est_price` */;
SET character_set_client = @saved_cs_client;

--
-- Table structure for table `goods`
--

DROP TABLE IF EXISTS `goods`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `goods` (
  `g_ID` int(11) NOT NULL AUTO_INCREMENT,
  `g_Name` varchar(255) NOT NULL,
  `list_ID` int(11) NOT NULL,
  PRIMARY KEY (`g_ID`)
) ENGINE=InnoDB AUTO_INCREMENT=17 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `goods`
--

LOCK TABLES `goods` WRITE;
/*!40000 ALTER TABLE `goods` DISABLE KEYS */;
INSERT INTO `goods` VALUES (1,'Μπαταρία',4),(2,'Σετ Πατάκια',4),(3,'Αδιάβροχο Μπουφάν Παιδικό',3),(4,'Ρεζέρβα',4),(5,'Σέρβις LPG',4),(6,'Αλυσίδες Χιονιού',4),(7,'Πλύσιμο Μέσα Έξω',4),(8,'Πλυστικό Υγρό',4),(9,'Τσίπουρο Άνευ 1 lt',2),(10,'Αβγά 30 30Τ',2),(11,'Μωρομάντιλα',1),(12,'Αφρός Ξυρίσματος',1),(13,'Μαλλακτικό Πλυντηρίου',1),(14,'Καθαριστικό Ζαντών',4);
/*!40000 ALTER TABLE `goods` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `lists`
--

DROP TABLE IF EXISTS `lists`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `lists` (
  `list_ID` int(11) NOT NULL,
  `list_Name` varchar(64) NOT NULL,
  PRIMARY KEY (`list_ID`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `lists`
--

LOCK TABLES `lists` WRITE;
/*!40000 ALTER TABLE `lists` DISABLE KEYS */;
INSERT INTO `lists` VALUES (1,'Super Market'),(2,'Flea Market'),(3,'Mall'),(4,'Car Needs');
/*!40000 ALTER TABLE `lists` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `post_it`
--

DROP TABLE IF EXISTS `post_it`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `post_it` (
  `post_it_ID` int(11) NOT NULL,
  `list_ID` int(11) NOT NULL,
  `g_ID` int(11) NOT NULL,
  `date` date NOT NULL,
  `est_price` float NOT NULL,
  PRIMARY KEY (`post_it_ID`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `post_it`
--

LOCK TABLES `post_it` WRITE;
/*!40000 ALTER TABLE `post_it` DISABLE KEYS */;
INSERT INTO `post_it` VALUES (1,4,5,'2012-01-25',80),(2,4,7,'2023-12-24',10),(3,4,1,'2020-01-25',60);
/*!40000 ALTER TABLE `post_it` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Final view structure for view `CAR_NEEDS_VIEW`
--

/*!50001 DROP VIEW IF EXISTS `CAR_NEEDS_VIEW`*/;
/*!50001 SET @saved_cs_client          = @@character_set_client */;
/*!50001 SET @saved_cs_results         = @@character_set_results */;
/*!50001 SET @saved_col_connection     = @@collation_connection */;
/*!50001 SET character_set_client      = utf8mb4 */;
/*!50001 SET character_set_results     = utf8mb4 */;
/*!50001 SET collation_connection      = utf8mb4_unicode_ci */;
/*!50001 CREATE ALGORITHM=UNDEFINED */
/*!50013 DEFINER=`meladma`@`localhost` SQL SECURITY DEFINER */
/*!50001 VIEW `CAR_NEEDS_VIEW` AS select `goods`.`g_Name` AS `g_Name`,`post_it`.`date` AS `date`,`post_it`.`est_price` AS `est_price` from (`post_it` join `goods` on(`post_it`.`g_ID` = `goods`.`g_ID`)) */;
/*!50001 SET character_set_client      = @saved_cs_client */;
/*!50001 SET character_set_results     = @saved_cs_results */;
/*!50001 SET collation_connection      = @saved_col_connection */;
/*!40103 SET TIME_ZONE=@OLD_TIME_ZONE */;

/*!40101 SET SQL_MODE=@OLD_SQL_MODE */;
/*!40014 SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS */;
/*!40014 SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
/*!40111 SET SQL_NOTES=@OLD_SQL_NOTES */;

-- Dump completed on 2024-12-08 12:05:04
