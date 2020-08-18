-- MySQL dump 10.13  Distrib 5.7.22, for Linux (x86_64)
--
-- Host: localhost    Database: laboratory
-- ------------------------------------------------------
-- Server version	5.7.22-0ubuntu0.16.04.1

/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;
/*!40103 SET @OLD_TIME_ZONE=@@TIME_ZONE */;
/*!40103 SET TIME_ZONE='+00:00' */;
/*!40014 SET @OLD_UNIQUE_CHECKS=@@UNIQUE_CHECKS, UNIQUE_CHECKS=0 */;
/*!40014 SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0 */;
/*!40101 SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='NO_AUTO_VALUE_ON_ZERO' */;
/*!40111 SET @OLD_SQL_NOTES=@@SQL_NOTES, SQL_NOTES=0 */;

--
-- Table structure for table `exam`
--

DROP TABLE IF EXISTS `exam`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `exam` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `id_patient` int(11) NOT NULL,
  `date_recieved` timestamp NULL DEFAULT NULL,
  `date_released` timestamp NULL DEFAULT NULL,
  `age` decimal(6,2) NOT NULL,
  `doctor` varchar(200) COLLATE utf8_bin DEFAULT NULL,
  `state` varchar(50) COLLATE utf8_bin DEFAULT NULL,
  `detail` varchar(200) COLLATE utf8_bin DEFAULT NULL,
  `total_price` decimal(10,2) DEFAULT NULL,
  `discount` float DEFAULT NULL,
  `id_fund` int(11) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=7 DEFAULT CHARSET=utf8 COLLATE=utf8_bin;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `exam`
--

LOCK TABLES `exam` WRITE;
/*!40000 ALTER TABLE `exam` DISABLE KEYS */;
INSERT INTO `exam` VALUES (1,1,'2016-01-31 07:57:35',NULL,0.03,'','progress','',25000.00,0,1),(2,2,'2017-05-01 05:28:19',NULL,29.84,'','progress','',10000.00,0,4),(3,3,'2017-05-01 05:46:19',NULL,35.49,'','progress','',30000.00,0,5),(4,4,'2017-05-01 06:15:40',NULL,15.21,'','progress','',10000.00,0,6),(5,2,'2017-05-01 06:16:38',NULL,29.84,'','progress','',15000.00,0,7),(6,3,'2017-05-01 06:17:38',NULL,35.49,'','progress','',10000.00,0,8);
/*!40000 ALTER TABLE `exam` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `exam_tests`
--

DROP TABLE IF EXISTS `exam_tests`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `exam_tests` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `id_exam` int(11) NOT NULL,
  `id_test` int(11) NOT NULL,
  `result` varchar(200) COLLATE utf8_bin DEFAULT NULL,
  `detail` varchar(200) COLLATE utf8_bin DEFAULT NULL,
  `checker` varchar(100) COLLATE utf8_bin DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=11 DEFAULT CHARSET=utf8 COLLATE=utf8_bin;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `exam_tests`
--

LOCK TABLES `exam_tests` WRITE;
/*!40000 ALTER TABLE `exam_tests` DISABLE KEYS */;
INSERT INTO `exam_tests` VALUES (1,1,201,NULL,NULL,NULL),(2,1,270,NULL,NULL,NULL),(3,1,29,NULL,NULL,NULL),(4,2,262,NULL,NULL,NULL),(5,3,261,NULL,NULL,NULL),(6,3,259,NULL,NULL,NULL),(7,4,298,NULL,NULL,NULL),(8,5,205,NULL,NULL,NULL),(9,6,297,NULL,NULL,NULL),(10,6,139,NULL,NULL,NULL);
/*!40000 ALTER TABLE `exam_tests` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `fund`
--

DROP TABLE IF EXISTS `fund`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `fund` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `id_user` int(11) DEFAULT NULL,
  `id_exam` int(11) DEFAULT NULL,
  `dollar` decimal(10,2) DEFAULT NULL,
  `dinar` decimal(15,0) DEFAULT NULL,
  `box_dollar` decimal(10,2) DEFAULT NULL,
  `box_dinar` decimal(15,0) DEFAULT NULL,
  `detail` varchar(200) COLLATE utf8_bin DEFAULT NULL,
  `type` varchar(100) COLLATE utf8_bin DEFAULT NULL,
  `date` datetime DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=9 DEFAULT CHARSET=utf8 COLLATE=utf8_bin;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `fund`
--

LOCK TABLES `fund` WRITE;
/*!40000 ALTER TABLE `fund` DISABLE KEYS */;
INSERT INTO `fund` VALUES (1,NULL,1,0.00,25000,0.00,25000,'discount : 0','payin','2016-01-31 10:57:35'),(2,NULL,2,0.00,45000,0.00,70000,'discount : 0','payin','2016-01-31 15:16:49'),(3,NULL,2,0.00,28000,0.00,98000,'discount : 2000','payin','2016-04-10 16:19:05'),(4,NULL,2,0.00,10000,0.00,108000,'discount : 0','payin','2017-05-01 08:28:19'),(5,NULL,3,0.00,30000,0.00,138000,'discount : 0','payin','2017-05-01 08:46:19'),(6,NULL,4,0.00,10000,0.00,148000,'discount : 0','payin','2017-05-01 09:15:40'),(7,NULL,5,0.00,15000,0.00,163000,'discount : 0','payin','2017-05-01 09:16:38'),(8,NULL,6,0.00,10000,0.00,173000,'discount : 0','payin','2017-05-01 09:17:38');
/*!40000 ALTER TABLE `fund` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `normal_range`
--

DROP TABLE IF EXISTS `normal_range`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `normal_range` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `min_age` float DEFAULT NULL,
  `max_age` float DEFAULT NULL,
  `gender` varchar(50) COLLATE utf8_bin DEFAULT NULL,
  `id_test` int(11) NOT NULL,
  `detail` varchar(200) COLLATE utf8_bin DEFAULT NULL,
  `in_print` varchar(200) COLLATE utf8_bin DEFAULT NULL,
  `date` datetime DEFAULT NULL,
  `min` float DEFAULT NULL,
  `max` float DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=178 DEFAULT CHARSET=utf8 COLLATE=utf8_bin;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `normal_range`
--

LOCK TABLES `normal_range` WRITE;
/*!40000 ALTER TABLE `normal_range` DISABLE KEYS */;
INSERT INTO `normal_range` VALUES (1,15,30,'male',1,'good detail',NULL,'2014-05-27 11:17:07',NULL,NULL),(2,2,33,'male',1,'33','44','2014-05-27 11:17:15',NULL,NULL),(3,11,33,'male',0,'','','2014-05-27 11:37:29',NULL,NULL),(5,13,22,'both',5,'','25 Uml/L','2014-05-27 11:47:48',NULL,NULL),(6,12,36,'male',5,'12','','2014-05-30 12:46:14',NULL,NULL),(7,0.1,10,'male',9,'','','2014-06-05 16:43:28',110,230),(8,21,32,'female',9,'','','2014-06-05 18:34:14',352,482),(9,11,20,'both',9,'','','2014-06-05 18:50:01',140,265),(11,60,70,'male',9,'','','2014-06-05 19:01:33',430,960),(12,0,100,'male',10,'',NULL,'2014-06-05 19:09:48',25,125),(13,0,100,'female',10,'',NULL,'2014-06-05 19:10:27',35,135),(14,0,100,'both',15,'',NULL,'2014-06-05 19:15:47',0,10),(15,0,100,'both',14,'',NULL,'2014-06-05 19:16:17',0,20),(16,0,100,'both',13,'',NULL,'2014-06-05 19:16:43',0,12),(17,0,100,'both',12,'',NULL,'2014-06-05 19:17:11',0,10),(18,0,100,'both',11,'',NULL,'2014-06-05 19:17:35',0,1),(19,0,100,'both',16,'',NULL,'2014-06-05 19:20:08',0,10),(20,0,100,'both',17,'',NULL,'2014-06-05 19:20:47',0,10),(21,0,100,'both',18,'',NULL,'2014-06-05 19:21:55',0.92,2.33),(22,0,100,'female',19,'',NULL,'2014-06-05 19:23:08',5,35),(23,0,100,'male',19,'',NULL,'2014-06-05 19:23:18',3,25),(24,0,100,'female',20,'',NULL,'2014-06-05 19:24:37',0.1,0.9),(25,0,100,'male',20,'',NULL,'2014-06-05 19:24:47',3,10.6),(26,0,100,'both',21,'',NULL,'2014-06-05 19:25:52',10,10000),(27,3,8,'both',22,'',NULL,'2014-06-05 19:27:09',20,250),(28,11,16,'both',22,'',NULL,'2014-06-05 19:27:36',130,600),(29,17,100,'both',22,'',NULL,'2014-06-05 19:27:56',150,350),(30,0,100,'both',23,'',NULL,'2014-06-15 13:18:33',0,200),(31,0,100,'both',24,'',NULL,'2014-06-15 13:18:58',80,160),(32,0.4,1,'both',25,'',NULL,'2014-06-16 10:09:26',10,20),(33,1.01,2,'both',25,'',NULL,'2014-06-16 10:11:02',11,18),(34,14,100,'both',27,'',NULL,'2014-06-16 11:41:26',1.2,2.7),(35,14,100,'both',28,'',NULL,'2014-06-16 11:42:32',58,141),(36,14,100,'both',29,'',NULL,'2014-06-16 11:46:09',0.4,4),(38,0,4,'both',33,'',NULL,'2014-07-03 11:24:14',2.8,4.4),(39,4.1,14,'both',33,'',NULL,'2014-07-03 11:24:48',3.8,5.4),(40,14.1,18,'both',33,'',NULL,'2014-07-03 11:25:21',3.2,4.5),(41,18.1,100,'both',33,'',NULL,'2014-07-03 11:25:49',3.4,4.8),(42,18,100,'male',35,'',NULL,'2014-07-03 11:33:23',40,129),(43,18,100,'female',35,'',NULL,'2014-07-03 11:33:44',35,104),(44,0.5,1,'both',35,'',NULL,'2014-07-03 11:34:40',0,462),(45,1.01,3.9,'both',35,'',NULL,'2014-07-03 11:36:08',0,281),(46,4,6.9,'both',35,'',NULL,'2014-07-03 11:36:34',0,269),(47,7,12.9,'both',35,'',NULL,'2014-07-03 11:37:00',0,300),(48,13,17,'male',35,'',NULL,'2014-07-03 11:38:01',0,390),(49,13,17,'female',35,'',NULL,'2014-07-03 11:38:31',0,187),(50,1,100,'male',36,'',NULL,'2014-07-03 11:49:09',27.2,102),(51,1,100,'female',36,'',NULL,'2014-07-03 11:49:26',18.7,86.9),(52,0.2,4.9,'both',41,'',NULL,'2014-07-03 12:06:13',8.4,10.4),(53,5,20,'both',41,'',NULL,'2014-07-03 12:06:33',9.2,11),(54,20.1,50.9,'both',41,'',NULL,'2014-07-03 12:06:56',8.8,10.2),(55,51,100,'both',41,'',NULL,'2014-07-03 12:07:17',8.4,9.7),(56,1,100,'male',43,'',NULL,'2014-07-04 13:52:56',39,308),(57,1,100,'female',43,'',NULL,'2014-07-04 13:53:17',26,192),(58,16,100,'male',45,'',NULL,'2014-07-04 14:16:46',0.67,1.17),(59,16,100,'female',45,'',NULL,'2014-07-04 14:17:06',0.51,0.95),(60,0.15,1,'both',45,'',NULL,'2014-07-04 14:18:19',0.16,0.39),(61,1.01,2.9,'both',45,'',NULL,'2014-07-04 14:18:58',0.18,0.35),(62,3,4.9,'both',45,'',NULL,'2014-07-04 14:19:32',0.26,0.42),(63,5,6.9,'both',45,'',NULL,'2014-07-04 14:20:08',0.29,0.47),(64,7,8.9,'both',45,'',NULL,'2014-07-04 14:20:35',0.34,0.53),(65,9,10.9,'both',45,'',NULL,'2014-07-04 14:21:11',0.33,0.64),(66,11,12.9,'both',45,'',NULL,'2014-07-04 14:21:39',0.44,0.68),(67,13,15,'both',45,'',NULL,'2014-07-04 14:22:06',0.46,0.77),(68,18,59,'both',46,'',NULL,'2014-07-04 14:24:07',74,106),(69,60,90,'both',46,'',NULL,'2014-07-04 14:24:31',82,115),(70,91,120,'both',46,'',NULL,'2014-07-04 14:24:52',75,121),(71,1,17,'both',46,'',NULL,'2014-07-04 14:25:34',60,100),(72,1,100,'male',47,'',NULL,'2014-07-04 14:28:05',2,30),(73,1,100,'female',47,'',NULL,'2014-07-04 14:28:20',1,24),(74,0.2,100,'male',50,'',NULL,'2014-07-04 14:37:09',59,158),(75,0.2,100,'female',50,'',NULL,'2014-07-04 14:37:34',37,145),(76,16,100,'male',51,'',NULL,'2014-07-04 14:40:09',135,225),(77,16,100,'female',51,'',NULL,'2014-07-04 14:40:33',135,214),(78,2,15,'both',51,'',NULL,'2014-07-04 14:40:54',120,300),(79,0.6,1,'both',56,'',NULL,'2014-07-04 14:49:26',5.1,7.3),(80,1.01,2,'both',56,'',NULL,'2014-07-04 14:49:55',5.6,7.5),(81,3,18,'both',56,'',NULL,'2014-07-04 14:50:25',6,8),(82,0.2,64.9,'both',58,'',NULL,'2014-07-04 14:54:47',13,50),(83,65,120,'both',58,'',NULL,'2014-07-04 14:55:07',13,71),(84,18,60,'both',59,'',NULL,'2014-07-04 14:56:07',6,20),(85,60.1,90,'both',59,'',NULL,'2014-07-04 14:56:30',8,23),(86,1,17,'both',59,'',NULL,'2014-07-04 14:56:56',5,18),(87,0.1,0.9,'both',59,'',NULL,'2014-07-04 14:57:55',4,19),(88,1,100,'male',60,'',NULL,'2014-07-04 14:58:57',3.4,7),(89,1,100,'female',60,'',NULL,'2014-07-04 14:59:16',2.4,5.7),(90,1,100,'male',68,'',NULL,'2014-07-04 15:10:44',10,50),(91,1,100,'female',68,'',NULL,'2014-07-04 15:10:57',10,35),(92,1,100,'male',69,'',NULL,'2014-07-04 15:12:11',10,50),(93,1,100,'female',69,'',NULL,'2014-07-04 15:12:26',10,35),(94,1,100,'male',71,'',NULL,'2014-07-04 15:14:24',70,145),(95,1,100,'female',71,'',NULL,'2014-07-04 15:14:40',80,155),(96,1,100,'male',75,'',NULL,'2014-07-08 17:32:41',0,15),(97,1,100,'female',75,'',NULL,'2014-07-08 17:32:52',0,20),(100,13,100,'both',175,'',NULL,'2014-08-05 14:18:23',0.4,4),(101,13,100,'both',174,'',NULL,'2014-08-05 14:18:55',58,141),(102,13,100,'both',173,'',NULL,'2014-08-05 14:19:16',1.2,2.33),(103,13,100,'both',176,'',NULL,'2014-08-05 14:19:38',4,8.3),(104,13,100,'both',177,'',NULL,'2014-08-05 14:20:10',8,20),(105,1,100,'both',121,'',NULL,'2014-08-06 16:34:28',0,5),(106,1,100,'both',119,'',NULL,'2014-08-06 16:35:18',0,33),(107,1,100,'both',117,'',NULL,'2014-08-06 16:36:37',0,35),(109,1,100,'both',114,'',NULL,'2014-08-06 16:37:39',0,5),(110,0.2,65,'both',185,'',NULL,'2014-08-13 17:58:31',13,50),(111,65.1,100,'both',185,'',NULL,'2014-08-13 17:58:53',13,71),(112,18,60,'both',186,'',NULL,'2014-08-13 17:59:56',6,20),(113,60.1,90,'both',186,'',NULL,'2014-08-13 18:00:14',8,23),(114,16,100,'male',187,'',NULL,'2014-08-13 18:01:46',0.7,1.2),(115,16,100,'female',187,'',NULL,'2014-08-13 18:02:02',0.5,0.95),(116,1,100,'both',190,'',NULL,'2014-08-16 13:30:49',0,1),(117,1,100,'both',191,'',NULL,'2014-08-16 13:32:53',0,0.2),(118,1,2,'both',192,'',NULL,'2014-08-16 13:34:53',5.6,7.5),(119,3,17,'both',192,'',NULL,'2014-08-16 13:35:17',6,8),(120,18,100,'both',192,'',NULL,'2014-08-16 13:35:37',6.6,8.7),(121,0,14,'male',193,'',NULL,'2014-08-16 13:37:16',3.8,5.4),(122,14.1,18,'both',193,'',NULL,'2014-08-16 13:37:42',3.2,4.5),(123,18.1,100,'both',193,'',NULL,'2014-08-16 13:38:02',3.4,4.8),(124,18,100,'male',194,'',NULL,'2014-08-16 13:39:51',40,129),(125,18,100,'female',194,'',NULL,'2014-08-16 13:40:07',35,104),(126,13,17,'male',194,'',NULL,'2014-08-16 13:40:49',0,390),(127,13,17,'female',194,'',NULL,'2014-08-16 13:41:03',0,187),(128,7,12,'both',194,'',NULL,'2014-08-16 13:41:20',0,300),(129,4,6,'both',194,'',NULL,'2014-08-16 13:41:41',0,269),(130,1,3,'both',194,'',NULL,'2014-08-16 13:42:02',0,281),(131,18,100,'male',195,'',NULL,'2014-08-16 13:44:19',10,50),(132,18,100,'female',195,'',NULL,'2014-08-16 13:44:36',10,35),(133,18,100,'male',196,'',NULL,'2014-08-16 13:47:17',10,50),(134,18,100,'female',196,'',NULL,'2014-08-16 13:47:31',10,35),(135,2,15,'both',197,'',NULL,'2014-08-16 13:49:08',120,300),(136,16,100,'male',197,'',NULL,'2014-08-16 13:49:33',135,225),(137,16,100,'female',197,'',NULL,'2014-08-16 13:49:54',135,214),(138,1,100,'both',203,'',NULL,'2014-08-20 15:11:59',30,50),(139,1,100,'male',204,'',NULL,'2014-08-20 15:14:18',70,145),(140,1,100,'female',204,'',NULL,'2014-08-20 15:14:34',80,155),(141,1,100,'both',70,'',NULL,'2014-08-20 15:16:01',70,127),(142,1,8,'both',110,'',NULL,'2014-08-21 16:21:44',50,300),(143,1,100,'male',98,'',NULL,'2014-08-23 18:00:45',0.8,5.6),(144,1,100,'female',98,'',NULL,'2014-08-23 18:01:01',33.9,280),(145,1,100,'male',96,'',NULL,'2014-08-23 18:01:54',2.4,29.5),(146,1,100,'female',96,'',NULL,'2014-08-23 18:02:08',0.5,2.5),(147,1,100,'male',227,'',NULL,'2014-09-01 18:25:46',13,71),(148,1,100,'female',227,'',NULL,'2014-09-01 18:26:32',18,114),(149,14,100,'male',161,'',NULL,'2014-09-15 15:25:27',30,350),(150,17,100,'female',161,'',NULL,'2014-09-15 15:25:38',13,150),(151,0.2,100,'male',162,'',NULL,'2014-09-22 16:37:13',59,158),(152,0.2,100,'female',162,'',NULL,'2014-09-22 16:37:30',37,145),(153,1,100,'both',40,'',NULL,'2014-10-11 15:07:37',0,5),(154,8.1,10,'both',110,'',NULL,'2014-10-18 16:20:04',75,350),(155,10.1,12,'both',110,'',NULL,'2014-10-18 16:21:07',110,550),(156,13,13.9,'both',110,'',NULL,'2014-10-18 16:21:56',183,850),(157,14,16,'both',110,'',NULL,'2014-10-18 16:22:28',220,950),(158,1,100,'both',139,'',NULL,'2014-10-21 13:58:55',20,50),(159,1,100,'both',138,'',NULL,'2014-10-21 13:59:23',91,156),(160,1,100,'male',238,'',NULL,'2014-11-22 15:19:02',39,308),(161,1,100,'female',238,'',NULL,'2014-11-22 15:19:20',26,192),(162,1,100,'both',163,'',NULL,'2014-11-29 16:18:59',250,400),(163,1,100,'both',164,'',NULL,'2014-11-29 16:19:24',180,280),(164,1,13.99,'both',161,'',NULL,'2014-11-29 17:09:17',7,140),(165,1,100,'both',198,'',NULL,'2015-03-31 16:13:10',135,145),(166,1,100,'both',199,'',NULL,'2015-03-31 16:13:30',3.5,5.1),(167,1,100,'both',200,'',NULL,'2015-03-31 16:13:50',95,115),(168,1,100,'both',201,'',NULL,'2015-03-31 16:14:15',1.15,1.33),(169,1,100,'both',202,'',NULL,'2015-03-31 16:14:33',7.2,7.6),(170,1,100,'male',284,'',NULL,'2015-04-15 15:16:28',39,259),(171,1,100,'female',284,'',NULL,'2015-04-15 15:17:10',28,217),(176,1,100,'both',147,'',NULL,'2015-05-12 15:01:44',13,33),(177,0,3,'both',187,'',NULL,'2015-06-20 15:41:51',0.17,0.42);
/*!40000 ALTER TABLE `normal_range` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `patient`
--

DROP TABLE IF EXISTS `patient`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `patient` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(200) COLLATE utf8_bin NOT NULL,
  `dob` date NOT NULL,
  `gender` varchar(50) COLLATE utf8_bin NOT NULL,
  `date` datetime DEFAULT NULL,
  `detail` varchar(200) COLLATE utf8_bin DEFAULT NULL,
  `id_user` int(11) DEFAULT NULL,
  `phone` varchar(100) COLLATE utf8_bin DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=5 DEFAULT CHARSET=utf8 COLLATE=utf8_bin;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `patient`
--

LOCK TABLES `patient` WRITE;
/*!40000 ALTER TABLE `patient` DISABLE KEYS */;
INSERT INTO `patient` VALUES (1,'xc c xc','2016-01-20','male','2016-01-31 10:57:35',NULL,NULL,NULL),(2,'Diako','1987-12-03','male','2017-05-01 08:28:19',NULL,NULL,NULL),(3,'diana karim mahmud','1982-05-10','female','2017-05-01 08:46:19',NULL,NULL,NULL),(4,'di','2002-05-05','male','2017-05-01 09:15:40',NULL,NULL,NULL);
/*!40000 ALTER TABLE `patient` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `profile`
--

DROP TABLE IF EXISTS `profile`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `profile` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(200) COLLATE utf8_bin NOT NULL,
  `type` varchar(200) COLLATE utf8_bin DEFAULT NULL,
  `detail` varchar(200) COLLATE utf8_bin DEFAULT NULL,
  `date` datetime DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=70 DEFAULT CHARSET=utf8 COLLATE=utf8_bin;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `profile`
--

LOCK TABLES `profile` WRITE;
/*!40000 ALTER TABLE `profile` DISABLE KEYS */;
INSERT INTO `profile` VALUES (9,'Autoimmune Rheumatology Screen','','','2014-06-05 19:12:37'),(11,'Hormonal Assay By ECLIA','','','2014-06-05 19:21:05'),(13,'Autoimmune Hepatitis By ELISA','','','2014-06-16 10:02:12'),(15,'General Stool Examination','','','2014-06-16 11:30:54'),(16,'General Urine Examination','','','2014-06-16 11:31:19'),(17,'Autoimmune Thrombosis Screen By ELISA','','','2014-06-16 11:31:58'),(18,'Autoimmune Rheumatology Screen By ELISA','','','2014-06-16 11:32:24'),(22,'Renal Function Test By Cobas C111','','','2014-06-16 11:34:37'),(23,'Lipid Profile By Cobas C111','','','2014-06-16 11:34:53'),(24,'Liver Function Test By Cobas C111','','','2014-06-16 11:35:18'),(25,'Clinical Chemistry By Cobas C111','','','2014-06-16 11:36:45'),(26,'TORCH Screen','','','2014-06-16 11:53:31'),(27,'Brucella Antibody test by ELISA','','','2014-06-16 11:54:12'),(28,'Helicobacter pylori Antibody test by ELISA','','','2014-06-16 11:55:33'),(29,'Viral screen By Immunochromatography','','','2014-06-16 11:56:02'),(30,'Hepatits Virus Screen','','','2014-06-16 11:57:01'),(31,'Chlamydia Antibody test by ELISA','','','2014-06-16 11:57:34'),(32,'VDRL','','','2014-06-16 11:58:08'),(33,'Immunoglobulin assay','','','2014-06-16 11:58:43'),(34,'complement protein','','','2014-06-16 11:59:12'),(35,'Tumor markers By ECLIA','','','2014-06-16 12:00:00'),(36,'Iron status','','','2014-06-16 12:00:20'),(37,'Vitamins By ECLIA','','','2014-06-16 12:01:30'),(39,'EBV (VCA) BY ELISA','','','2014-06-16 12:03:31'),(40,'Parasitic infection','','','2014-06-16 12:04:05'),(41,'Vasculitis by ELISA','','','2014-06-16 12:04:46'),(42,'24hr Urine Collection','','','2014-06-16 12:05:33'),(43,'D-Dimer','','','2014-06-16 12:05:58'),(44,'Serology tests','','','2014-06-16 12:07:03'),(45,'Prothrombine Time','','','2014-06-16 12:08:13'),(46,'Haematology','','','2014-06-16 12:08:28'),(47,'Electrolyte by OPTI LION','','','2014-06-16 12:09:07'),(48,'Celiac Screen','','','2014-06-16 12:09:43'),(49,'Thyroid function test By FEI','','','2014-06-16 12:10:39'),(51,'Hb electrophoresis by HPLC','','','2014-09-01 18:27:59'),(52,'HLA B27 By Real time PCR','','','2014-09-10 16:23:21'),(53,'Helicobacter pylori  Stool Antigen','','','2014-09-23 16:59:15'),(54,'HBV Panel by Immunochromatography','','','2014-11-29 17:55:19'),(55,'CSF','','','2014-12-06 16:36:59'),(56,'Calprotectin Stool test','','','2014-12-09 15:25:14'),(57,'24hr Urine Protein Test','','','2015-01-13 15:53:45'),(58,'24hr Urine Copper Test','','','2015-01-14 17:20:34'),(59,'Anti Echinococcus Antibody by ELISA','','','2015-02-16 14:37:16'),(60,'24hr Urine Collection','','','2015-02-16 18:28:57'),(61,'Glucose Tolerance Test (GTT)','','','2015-02-23 14:11:58'),(62,'Fecal Occult Blood Test','','','2015-02-24 14:44:03'),(63,'Urine Albumin-to-Creatinine Ratio (UACR) by DCA','','','2015-03-04 17:06:50'),(64,'Peritoneal Fluid ','','','2015-03-04 18:42:13'),(65,'Urine protein to creatinine ratio','','','2015-03-07 17:43:06'),(66,'Viral Screen by ECLIA','','','2015-04-28 15:29:28'),(67,'Thyroid Function Test by ECLIA','','','2015-05-10 15:54:03'),(68,'Ascitis Fluid Analysis','','','2015-05-19 17:18:09'),(69,'Immunosuppressant Drugs Assay By ECLIA','','','2015-09-08 17:35:45');
/*!40000 ALTER TABLE `profile` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `test`
--

DROP TABLE IF EXISTS `test`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `test` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `id_profile` int(11) NOT NULL,
  `name` varchar(200) COLLATE utf8_bin NOT NULL,
  `type` varchar(200) COLLATE utf8_bin DEFAULT NULL,
  `price` decimal(15,0) DEFAULT NULL,
  `detail` varchar(200) COLLATE utf8_bin DEFAULT NULL,
  `result_type` varchar(50) COLLATE utf8_bin DEFAULT NULL,
  `date` datetime DEFAULT NULL,
  `default_normal` varchar(200) COLLATE utf8_bin DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=309 DEFAULT CHARSET=utf8 COLLATE=utf8_bin;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `test`
--

LOCK TABLES `test` WRITE;
/*!40000 ALTER TABLE `test` DISABLE KEYS */;
INSERT INTO `test` VALUES (27,11,'T3','',10000,'','nmol/L','2014-06-16 11:40:27','1.2-2.3'),(28,11,'T4','',10000,'','nmol/L','2014-06-16 11:42:06','58 - 141'),(29,11,'TSH','',10000,'','ᶭIU/ml','2014-06-16 11:45:32','0.4 -4.0'),(30,11,'LH','',10000,'','mIU/ml','2014-06-16 11:49:49','women : mid cycle :17-77.follicular:1.1-11.6.luteal:ND-14.7.\r\nmen;0.8-7.6'),(31,25,'Amylase','',7000,'','U/L','2014-07-03 11:19:51','28-100'),(32,25,'Amylase pancreatic','',10000,'','U/L','2014-07-03 11:20:51','13-53'),(33,25,'Albumin','',5000,'','g/dL','2014-07-03 11:22:44','3.4 - 4.8'),(34,25,'Albumin in Urine','',10000,'','mg/L','2014-07-03 11:31:02','First morning urine ,random    ᚲ29 mg/L\r\nUrine (24h)        ᚲ30 mg/day  '),(35,25,'Alkaline Phosphatase','',7000,'','U/L','2014-07-03 11:32:54',''),(36,25,'Ammonia','',10000,'','ᶭg/dL','2014-07-03 11:48:44','Female 18.7 - 86.9\r\nmale  27.2 - 102'),(37,25,'Bicarbonate','',10000,'','mmol/L','2014-07-03 11:50:37','22-29'),(38,25,'Bilirubin direct','',7000,'','mg/dL','2014-07-03 11:56:09','adult   0 - 0.2'),(39,25,'Bilirubin Total','',5000,'','mg/dL','2014-07-03 12:01:32','Adult and Childrin   ᚲ1.0'),(40,25,'C-Reactive Protein','',8000,'','mg/L','2014-07-03 12:04:17','0 - 5'),(41,25,'Calcium','',5000,'','mg/dL','2014-07-03 12:05:41',''),(42,25,'Cholesterol','',4000,'','mg/dL','2014-07-03 12:08:51','ᚲ200'),(43,25,'Creatine kinase','',10000,'','U/L','2014-07-04 13:52:26','Male     39-308\r\nFemale 26-192'),(44,25,'Creatine Kinase MB','',10000,'','U/L','2014-07-04 13:54:43','ᐸ 25'),(45,25,'Creatinine','',4000,'','mg/dL','2014-07-04 14:16:04','Male      0.67 - 1.17\r\nFemale  0.51 - 0.95'),(46,25,'Glucose','',4000,'','mg/dL','2014-07-04 14:23:28','Fasting 70 - 115'),(47,25,'Gamma GT','',10000,'','IU/L','2014-07-04 14:27:43','2 -30'),(48,25,'HDL','',7000,'','mg/dL','2014-07-04 14:31:25','No risk : Males      ᐳ 55\r\n              Females  ᐳ 65   '),(49,25,'HbA1c','',15000,'','%','2014-07-04 14:34:09','4.8 -5.9'),(50,25,'Iron','',7000,'','ᶭg/dL','2014-07-04 14:36:46','female  37 - 145\r\nmale     59 - 158'),(51,25,'lactate Dehydrogenase (LDH)','',10000,'','U/L','2014-07-04 14:39:40',''),(52,25,'LDL','',7000,'','mg/dL','2014-07-04 14:42:45','optimal :  ᐸ 100'),(53,25,'Lipase','',10000,'','U/L','2014-07-04 14:43:33','13 - 60'),(54,25,'Magnesium','',10000,'','mg/dL','2014-07-04 14:45:08','Premature :    1.4 - 1.9\r\nchildren and adult :  1.7 - 2.55'),(55,25,'Inorganic Phosphate','',5000,'','mg/dL','2014-07-04 14:47:08','2.7 - 4.5'),(56,25,'Total Protein','',5000,'','g/dL','2014-07-04 14:48:46','6.6 - 8.7'),(57,25,'Triglycerides','',4000,'No lipid metabolic disorder','mg/dL','2014-07-04 14:52:16','ᐸ 200'),(58,25,'Urea','',4000,'','mg/dL','2014-07-04 14:54:11',''),(59,25,'BUN','',4000,'','mg/dL','2014-07-04 14:55:49',''),(60,25,'Uric acid','',5000,'','mg/dL','2014-07-04 14:58:38',''),(61,25,'Sodium (Na)','',5000,'','mmol/L','2014-07-04 15:02:30','135 - 145'),(62,25,'Potassium (K)','',5000,'','mmol/L','2014-07-04 15:03:48','3.5 - 5.1'),(63,25,'Chloride','',5000,'','mmol/L','2014-07-04 15:04:42','95 - 115'),(64,25,'Ionized Calcium','',5000,'','mmol/L','2014-07-04 15:05:33','1.15 - 1.33'),(65,25,'pH','',0,'','pH unit','2014-07-04 15:06:20','7.2 - 7.6'),(66,25,'TIBC','',7000,'','ᶭg/dL','2014-07-04 15:07:27','250 - 400'),(67,25,'UIBC','',0,'','ᶭg/dL','2014-07-04 15:07:56','180 - 280'),(68,25,'ALT (GPT)','',5000,'','U/L','2014-07-04 15:10:20',''),(69,25,'AST (GOT)','',5000,'','U/L','2014-07-04 15:11:48',''),(70,25,'Zinc','',10000,'','ᶭg/dL','2014-07-04 15:13:28','70 - 127'),(71,25,'Copper','',10000,'','ᶭg/dL','2014-07-04 15:13:59',''),(72,25,'Ceruloplasmin','',25000,'','mg/dL','2014-07-04 15:15:40','20 - 81'),(73,44,'CRP','',5000,'','mg/L','2014-07-05 15:15:11','adult  ᐸ 5.0'),(74,44,'ASO','',7000,'','','2014-07-05 15:15:47',''),(75,46,'ESR','',5000,'','mm/hr','2014-07-05 15:19:12','male : 0-15\r\nfemale : 0-20'),(76,44,'RF','',7000,'','','2014-07-05 16:10:00',''),(77,44,'IM (infectious mono.)','',10000,'','','2014-07-06 13:27:44',''),(78,44,'Brucella Rapid test','',7000,'','','2014-07-06 13:29:00',''),(79,44,'VDRL','',10000,'','','2014-07-06 13:29:22',''),(80,44,'Salmonella Typhi IgG','',10000,'','','2014-07-06 13:30:19',''),(81,44,'Salmonella Typhi IgM','',0,'','','2014-07-06 13:30:38',''),(82,44,'HCG','',5000,'','','2014-07-06 13:33:17',''),(83,29,'HBs Ag','',10000,'','','2014-07-06 13:34:17',''),(84,29,'HCV Ab','',10000,'','','2014-07-06 13:34:34',''),(85,29,'HIV Ab','',10000,'','','2014-07-06 13:34:51',''),(86,46,'CBC','',12000,'','','2014-07-06 13:35:44',''),(87,15,'GSE','',5000,'','','2014-07-06 13:37:56',''),(88,16,'GUE','',5000,'','','2014-07-06 13:38:11',''),(89,27,'Brucella IgG','',15000,'','DU','2014-07-06 13:40:03','Negative :ᐸ 9.0\r\nGrey zone : 9 - 11\r\nPositive : ᐳ 11'),(90,27,'Brucella IgM','',15000,'','DU','2014-07-06 13:41:20','Negative :ᐸ 9.0\r\nGrey zone : 9 - 11\r\nPositive : ᐳ 11'),(91,11,'T Uptake','',10000,'','%','2014-07-08 10:23:02','25 - 35'),(92,11,'Free T3','',10000,'','pmol/L','2014-07-08 10:23:25','4.0 - 8.3'),(93,11,'Free T4','',10000,'','pmol/L','2014-07-08 10:23:40','8.0-20'),(94,11,'FSH','',10000,'','mIU/ml','2014-07-08 10:24:15','women : mid cycle :5.8-21.follicular:2.8-11.3.luteal:1.2-9.0.\r\nmen;0.7-11.1'),(95,11,'Prolactin','',10000,'','ng/ml','2014-07-08 10:24:39','women :  1.9 - 25\r\nmen; 2.5 - 17.0'),(96,11,'Testosterone','',10000,'','nmol/L','2014-07-08 10:25:03','Women: 0.5 - 2.5\r\nmen : 2.4 - 29.5'),(97,11,'Free Testosterone','',15000,'','pg/ml','2014-07-08 10:25:29','Female : 0.4 - 7.1\r\nMale : 4.0 - 30'),(98,11,'DHEA-S','',15000,'','ᶭg/dL','2014-07-08 10:25:54','Female : 33.9 - 280'),(99,11,'Progesterone','',10000,'','ng/ml','2014-07-08 10:26:19','(N: Women;ovulation;0.25-6.2;Follicular;0.25-0.54;Luteal;1.5-20;Menopause;ᐸ0.41);(N:Men ;0.25-0.56)'),(100,11,'17-OH Progesterone','',15000,'','','2014-07-08 10:26:45',''),(101,11,'Estradiol (E2)','',10000,'','pg/ml','2014-07-08 10:27:09','women : follicular:ND-160.luteal:27-246. preiovulary 124-1468 .\r\nmen;ND-56'),(102,11,'Intact PTH','',15000,'','pg/mL','2014-07-08 10:27:35','8.7 - 79.6'),(103,11,'Calcitonin','',15000,'','','2014-07-08 10:27:59',''),(104,11,'Aldosterone','',15000,'','pg/ml','2014-07-08 10:28:32','10 - 360'),(105,11,'ACTH','',20000,'','pg/ml','2014-07-08 10:28:51','7.2 - 63.6'),(106,11,'Cortisol (Morning)','',20000,'','nmol/L','2014-07-08 10:29:32','171 - 536'),(107,11,'Cortisol (evening)','',20000,'','nmol/L','2014-07-08 10:29:55','64 - 327'),(108,11,'HGH (Basal)','',20000,'','ng/ml','2014-07-08 10:30:39','Up to 10'),(109,11,'HGH (After stimulation)','',20000,'','ng/ml','2014-07-08 10:31:04','ᐳ 5.0 Rise from baseline'),(110,11,'IGF-1','',20000,'','ng/ml','2014-07-08 10:31:25',''),(111,11,'Insuline','',20000,'','','2014-07-08 10:31:39',''),(112,11,'C-Peptide','',20000,'','','2014-07-08 10:31:54',''),(113,11,'ßHCG','',10000,'','mIU/mL','2014-07-08 10:32:57','Up to 4.0 in non pregnant women'),(114,35,'CEA','',15000,'','ng/ml','2014-07-08 10:33:48','ᐸ 5.0'),(115,35,'TPSA','',15000,'','ng/mL','2014-07-08 11:10:09','0.21-6.2'),(116,35,'Free PSA','',15000,'','','2014-07-08 11:10:38',''),(117,35,'Ca 15.3','',20000,'','U/ml','2014-07-08 11:11:07','ᐸ 35'),(118,35,'Ca 125','',20000,'','U/ml','2014-07-08 11:11:24','ᐸ 35'),(119,35,'Ca 19.9','',20000,'','U/ml','2014-07-08 11:11:42','ᐸ 33'),(120,35,'Ca 27.29','',20000,'','','2014-07-08 11:12:05',''),(121,35,'AFP','',15000,'','IU/ml','2014-07-08 11:12:40','ᐸ 5.0'),(122,35,'ßHCG','',10000,'','','2014-07-08 11:12:54','Up to 4.0 in non pregnant women'),(123,46,'PCV','',5000,'','%','2014-07-08 11:15:22','35 - 55'),(124,46,'WBC','',5000,'','cells / mm','2014-07-08 11:15:36','4.5 - 10.5 X 10  '),(125,46,'Blood group & Rh','',5000,'','','2014-07-08 11:17:09',''),(126,46,'Bleeding Time','',5000,'','minutes','2014-07-08 11:17:50',''),(127,46,'Clotting Time','',5000,'','minutes','2014-07-08 11:18:16',''),(128,46,'CBP','',20000,'','','2014-07-08 11:20:16',''),(129,46,'Reticulocyte count','',5000,'','','2014-07-08 11:20:52',''),(130,46,'Platelet Count','',5000,'','','2014-07-08 11:21:19',''),(131,46,'Anti thrombin III','',20000,'','','2014-07-08 11:22:14',''),(132,46,'Protein c','',15000,'','','2014-07-08 11:22:36',''),(133,46,'Protein s','',15000,'','','2014-07-08 11:22:56',''),(134,33,'IgG','',10000,'','mg/dL','2014-07-08 11:25:05','800 - 1800'),(135,33,'IgA','',10000,'','mg/dL','2014-07-08 11:25:25','90 - 450'),(136,33,'IgM','',10000,'','mg/dL','2014-07-08 11:25:37','60-280'),(137,33,'IgE','',10000,'','IU/mL','2014-07-08 11:25:56','ᐸ 100'),(138,34,'C3','',10000,'','mg/dL','2014-07-08 11:26:21',''),(139,34,'C4','',10000,'','mg/dL','2014-07-08 11:26:36',''),(140,37,'25-OH Vitamin D','',25000,'','ng/ml','2014-07-08 11:28:52','Severe Deficiency:5-10\r\nDeficient: 10 - 20\r\nOptimal Level: 30 - 50'),(141,37,'B12','',20000,'','pg/mL','2014-07-08 11:31:14','211 - 946'),(142,37,'Folate','',20000,'','ng/mL','2014-07-08 11:31:37','4.6 - 18.7'),(143,23,'Total Cholesterol','',4000,'','mg/dL','2014-07-08 11:33:58','ᐸ 200'),(144,23,'Triglyceride','',4000,'','mg/dL','2014-07-08 11:35:55','ᐸ 200'),(145,23,'HDL','',7000,'','mg/dL','2014-07-08 11:37:02','Males : ᐳ 55\r\nFemales : ᐳ 65'),(146,23,'LDL','',7000,'','mg/dL','2014-07-08 11:39:36','Optimal : ᐸ 100\r\nNear Optimal :100-129\r\nHigh :130-189'),(147,23,'VLDL','',0,'','mg/dl','2014-07-08 11:42:15','13 - 33'),(148,23,'Atherogenic ratio','',0,'','','2014-07-08 11:43:01','ᐸ 5.0'),(149,23,'LDL/HDL','',0,'','','2014-07-08 11:43:30','ᐸ 4.0'),(150,26,'Toxoplasma IgG','',15000,'','IU/mL','2014-07-08 14:56:02','ᐸ 8.0'),(151,26,'Toxoplasma IgM','',15000,'','Index','2014-07-08 14:56:28','ᐸ 0.9'),(152,26,'CMV  IgG','',15000,'','IU/mL','2014-07-08 14:56:50','ᐸ 0.8'),(153,26,'CMV IgM','',15000,'','IU/mL','2014-07-08 14:57:08','ᐸ 0.9'),(154,26,'Rubella IgG','',15000,'','IU/mL','2014-07-08 14:57:29','ᐸ 10.0'),(155,26,'Rubella IgM','',15000,'','Index','2014-07-08 14:57:48','ᐸ 0.9'),(156,26,'HSV II IgG','',15000,'','','2014-07-08 14:58:24',''),(157,26,'HSV II IgM','',15000,'','','2014-07-08 14:58:43',''),(158,31,'Chlamydia trichomatus IgG','',15000,'','NTU','2014-07-08 14:59:33','Negative :ᐸ 9.0\r\nGrey zone : 9 - 11\r\nPositive : ᐳ 11'),(159,31,'Chlamydia trichomatus IgA','',15000,'','NTU','2014-07-08 15:00:16','ᐸ 9.0'),(160,31,'Chlamydia trichomatus IgM','',15000,'','NTU','2014-07-08 15:00:48','Negative :ᐸ 9.0\r\nGrey zone : 9 - 11\r\nPositive : ᐳ 11'),(161,36,'Ferritin','',15000,'','ng/mL','2014-07-08 15:01:53',''),(162,36,'Iron','',7000,'','ᶭg/dL','2014-07-08 15:02:21',''),(163,36,'TIBC','',7000,'','ᶭg/dL','2014-07-08 15:02:40','250 - 400'),(164,36,'UIBC','',0,'','ᶭg/dL','2014-07-08 15:03:28','180 - 280'),(165,28,'Helicobacter pylori IgG','',10000,'','U/mL','2014-07-08 15:04:53','ᐸ 20'),(166,28,'Helicobacter pylori IgA','',10000,'','U/mL','2014-07-08 15:05:09','ᐸ 20'),(167,28,'Helicobacter pylori IgM','',10000,'','U/mL','2014-07-08 15:05:23','ᐸ 40'),(168,9,'ANA','',10000,'','Index','2014-07-09 13:55:32','Negative:ᐸ0.8\r\nequivocal: 0.8-1.2\r\nPositive: ᐳ1.2'),(169,9,'Anti ds DNA IgG','',15000,'','IU/mL','2014-07-09 13:56:03','Negative : ᐸ 20\r\nequivocal : 20-30\r\nPositive : ᐳ 30'),(170,9,'Anti ds DNA IgM','',15000,'','IU/mL','2014-07-09 13:56:21','Negative : ᐸ 20\r\nequivocal : 20-30\r\nPositive : ᐳ 30'),(171,9,'Anti CCP','',20000,'','AU/mL','2014-07-09 13:57:51','Negative: ᐸ 12.0\r\nDoubtful: 12.0 - 18.0\r\nPositive: ᐸ 18.0'),(172,11,'Anti-Mullerian hormone (AMH/MIS)','',50000,'','ng/mL','2014-07-15 14:32:36','High (often PCOS); ᐳ 3.0\r\n\r\nNormal ; ᐳ 0.7\r\n\r\nLow ; 0.3 - 0.6'),(173,49,'T3','',10000,'','nmol/L','2014-08-05 14:05:04','1.2 - 2.33'),(174,49,'T4','',10000,'','nmol/L','2014-08-05 14:06:10','58 - 141'),(175,49,'TSH','',10000,'','ᶭIU/ml','2014-08-05 14:15:00','0.4 - 4.0'),(176,49,'Free T3','',10000,'','pmol/L','2014-08-05 14:17:06','4.0 - 8.3'),(177,49,'FreeT4','',10000,'','pmol/L','2014-08-05 14:17:48','8.0 - 20'),(178,48,'Antigliadin Ab IgG','',10000,'','U/mL','2014-08-12 18:10:00','Negative :ᐸ 12.0 \r\nequivocal : 12 - 18  \r\nPositive : ᐳ 18.0'),(179,48,'Antigliadin Ab IgA','',10000,'','U/mL','2014-08-12 18:10:14','Negative :ᐸ 12.0 \r\nequivocal : 12 - 18  \r\nPositive : ᐳ 18.0'),(180,48,'Anti tissue transglutaminase Ab IgG','',10000,'','U/mL','2014-08-12 18:10:50','Negative :ᐸ 12.0 \r\nequivocal : 12 - 18  \r\nPositive : ᐳ 18.0'),(181,48,'Anti tissue transglutaminase Ab IgA','',10000,'','U/mL','2014-08-12 18:11:17','Negative :ᐸ 12.0 \r\nequivocal : 12 - 18  \r\nPositive : ᐳ 18.0'),(182,48,'Anti endomycel Ab IgG','',15000,'','','2014-08-13 14:42:48',''),(183,48,'Anti endomycel Ab IgA','',15000,'','','2014-08-13 14:43:05',''),(184,49,'FT4I','',0,'','Index','2014-08-13 14:58:24','1.5 - 4.5'),(185,22,'B.Urea','',4000,'','mg/dL','2014-08-13 17:57:59',''),(186,22,'BUN','',4000,'','mg/dL','2014-08-13 17:59:34',''),(187,22,'Creatinine','',4000,'','mg/dL','2014-08-13 18:01:13','0.7-1.2'),(188,22,'Albumin','',5000,'','g/dL','2014-08-13 18:03:00','3.4 - 4.8'),(189,22,'Total Protein','',5000,'','g/dL','2014-08-13 18:04:08','6.6 - 8.7'),(190,24,'Bilirubin Total ','',5000,'','mg/dL','2014-08-16 13:30:28','ᐸ 1.0'),(191,24,'Bilirubin Direct','',7000,'','mg/dL','2014-08-16 13:32:12','0 - 0.2'),(192,24,'Total protein','',5000,'','g/dL','2014-08-16 13:33:59','6.6 - 8.7'),(193,24,'Albumin','',5000,'','g/dL','2014-08-16 13:36:41','3.4 - 4.8'),(194,24,'Alkaline Phosphate','',10000,'','U/L','2014-08-16 13:39:28','40-129'),(195,24,'AST (GOT)','',5000,'','U/L','2014-08-16 13:44:02','10-35'),(196,24,'ALT (GPT)','',5000,'','U/L','2014-08-16 13:47:02','10-35'),(197,24,'LDH','',10000,'','U/L','2014-08-16 13:48:43',''),(198,47,'Sodium','',5000,'','mmol/L','2014-08-16 13:53:04','135 - 145'),(199,47,'Potassium','',5000,'','mmol/L','2014-08-16 13:53:53','3.5 - 5.1'),(200,47,'Chloride','',0,'','mmol/L','2014-08-16 13:54:41','95 - 115'),(201,47,'Ionized Ca','',5000,'','mmol/L','2014-08-16 14:06:41','1.15 - 1.33'),(202,47,'pH','',0,'','pH unit','2014-08-16 14:07:19','7.2 - 7.6'),(203,37,'25-Hydroxy Vitamin D','',25000,'','ng/ml','2014-08-19 18:02:18','30 - 50'),(204,25,'copper','',10000,'','ᶭg/dL','2014-08-19 18:08:46',''),(205,17,'Anti phospholipid Antibody (IgG)','',15000,'','U/ml','2014-08-21 15:25:22','Negative   ᐸ 12  . Equivocal  12-18 .Positive     ᐳ 18\r\n'),(206,17,'Anti phospholipid Antibody (IgM)','',15000,'','U/ml','2014-08-21 15:26:35','Negative   ᐸ 12  . Equivocal  12-18 .Positive     ᐳ 18\r\n'),(208,17,'Anti Cardiolipin Antibody (IgG)','',15000,'','U/ml','2014-08-21 15:40:26','Negative   ᐸ 12  . Equivocal  12-18 .Positive     ᐳ 18\r\n'),(209,17,'Anti Cardiolipin Antibody (IgM)','',15000,'','U/ml','2014-08-21 15:40:37','Negative   ᐸ 12  . Equivocal  12-18 .Positive     ᐳ 18\r\n'),(210,17,'Anti B2 glycoprotein Antibody (IgG)','',15000,'','U/ml','2014-08-21 15:42:00','Negative   ᐸ 12  . Equivocal  12-18 .Positive     ᐳ 18\r\n'),(211,17,'Anti B2 glycoprotein Antibody (IgM)','',15000,'','U/ml','2014-08-21 15:42:20','Negative   ᐸ 12  . Equivocal  12-18 .Positive     ᐳ 18\r\n'),(212,17,'lupus Anticoagulant (LA-PTT)','',15000,'','Sec','2014-08-21 15:47:27','35 + 5'),(213,46,'PT','',10000,'','Sec','2014-08-25 15:07:06','10 - 14'),(217,46,'PT Control','',0,'','Sec','2014-08-25 15:31:28',''),(219,46,'INR','',0,'','','2014-08-25 15:37:03',''),(220,46,'PTT','',10000,'','Sec','2014-08-25 15:37:34','30 - 40'),(221,46,'PTT Control','',0,'','Sec','2014-08-25 15:37:53',''),(222,11,'HCG','',15000,'','mIU/ml','2014-08-26 15:09:23','Up to 5.0 in non pregnant women'),(223,41,'cANCA (PR3)','',10000,'','U/mL','2014-08-26 18:17:56','ᐸ 12.0'),(224,41,'pANCA (MPO)','',10000,'','U/mL','2014-08-26 18:18:29','ᐸ 12.0'),(225,46,'Hb (haemoglobin)','',5000,'','g/dL','2014-08-31 17:45:04','11.5 - 16.5'),(227,11,'SHBG','',20000,'','nmol/L','2014-09-01 16:37:01',''),(228,51,'HbF','',25000,'','%','2014-09-01 18:29:32','ᐸ 2.0 (Age dependent)'),(229,51,'HbA2','',0,'','%','2014-09-01 18:30:09','1.5 -3.5'),(230,49,'Anti-TG Antibody','',12000,'ND : Non Detectable','IU/mL','2014-09-03 16:20:06','ND - 40'),(231,67,'Anti-TPO Antibody','',12000,'','IU/mL','2014-09-03 16:20:33','Negative: ᐸ 31.5,\r\nDoubtful: 31.5 - 38.5,\r\nPositive: ᐳ 38.5'),(232,52,'HLA B27','',60000,'','','2014-09-10 16:23:43',''),(233,49,'TSH Receptor','',15000,'','IU/mL','2014-09-22 14:36:54','ᐸ 1.5'),(234,53,'H. pylori Stool Antigen','',15000,'','','2014-09-23 16:59:54',''),(235,9,'Rheumatoid Factor IgG','',15000,'','AU/mL','2014-10-18 16:27:36','Negative: ᐸ 12, \r\nEquivocal: 12-18,\r\nPositive:ᐳ 18'),(236,9,'Rhematoid Factor IgM','',15000,'','AU/mL','2014-10-18 16:28:15','Negative: ᐸ 12, \r\nEquivocal: 12-18,\r\nPositive:ᐳ 18'),(237,30,'HAV IgM','',10000,'','','2014-11-18 16:47:15',''),(238,25,'Creatine Kinase','',10000,'','U/L','2014-11-22 15:18:40',''),(239,54,'HBs Antigen','',10000,'','','2014-11-29 17:56:59',''),(240,54,'Anti-HBs Antibody','',10000,'','','2014-11-29 17:57:36',''),(241,54,'HBe Antigen','',10000,'','','2014-11-29 17:57:59',''),(242,54,'Anti-HBe Antibody','',10000,'','','2014-11-29 17:58:22',''),(243,54,'Anti-HBc Antibody','',10000,'','','2014-11-29 17:59:09',''),(244,55,'CSF','',15000,'','','2014-12-06 16:37:15',''),(245,56,'Calprotectin','',15000,'','','2014-12-09 15:26:06',''),(247,9,'Anti SCL-70 Ab','',15000,'','AU/mL','2014-12-17 16:44:22','Negative: ᐸ 12.0  \r\nDoubtful: 12-18 \r\nPositive:  ᐳ 18.0'),(248,13,'AMA','',15000,'','U/mL','2014-12-30 16:35:36','ᐸ 12.0'),(249,13,'LKM-1','',15000,'','U/mL','2014-12-30 16:35:54','ᐸ 12.0'),(250,57,'Urine Volume','',0,'','ml/24hr','2015-01-13 15:55:10','600 - 1600'),(251,57,'Urine Protein','',10000,'','mg/24hr','2015-01-13 15:56:14','ᐸ80'),(253,58,'Urine copper','',10000,'','mg/24hr','2015-01-14 17:22:21','15 - 70'),(254,9,'Anti La (SSB)','',15000,'','AU/mL','2015-01-18 15:52:17','Negative   ᐸ 12  . Equivocal  12-18 .Positive     ᐳ 18'),(255,9,'Anti Ro (SSA)','',15000,'','AU/mL','2015-01-18 15:52:41','Negative   ᐸ 12  . Equivocal  12-18 .Positive     ᐳ 18'),(256,9,'Anti SM','',15000,'','AU/mL','2015-01-18 15:59:16','Negative   ᐸ 12  . Equivocal  12-18 .Positive     ᐳ 18'),(257,39,'EBV (VCA) IgG Level','',15000,'','Index','2015-02-12 14:51:39','Negative: ᐸ 0.8\r\nPositive: ᐳ 1.2'),(258,39,'EBV (VCA) IgM Level','',15000,'','Index','2015-02-12 14:52:07','Negative: ᐸ 0.8\r\nPositive: ᐳ 1.2'),(259,59,'Echinococcus IgG Level','',20000,'*Nova Tech Unit','NTU*','2015-02-16 14:38:39','Negative :ᐸ 9.0\r\nGrey zone : 9 - 11\r\nPositive : ᐳ 11'),(260,60,'Urea','',10000,'','','2015-02-16 18:29:48',''),(261,60,'Creatinine','',10000,'','mg/24','2015-02-16 18:30:18','1040 - 2350'),(262,60,'Uric Acid','',10000,'','mg/day','2015-02-16 18:30:37','200 - 1000'),(263,60,'Calcium','',10000,'','mg/day','2015-02-16 18:31:08','ᐸ 250'),(264,60,'Phosphate(Inorganic)','',10000,'','','2015-02-16 18:32:01',''),(265,61,'Fasting Glucose','',5000,'','mg/dL','2015-02-23 14:13:37','110'),(267,61,'60-min. after Glucose load','',5000,'','mg/dL','2015-02-23 14:17:02','ᐸ 184'),(268,61,'120-min. after Glucose load','',5000,'','mg/dL','2015-02-23 14:18:07','ᐸ138'),(270,62,'Fecal Occult Blood','',10000,'','','2015-02-24 14:44:21',''),(271,41,'Anti GBM','',15000,'','','2015-03-03 15:25:56','Negative   ᐸ 12  . Equivocal  12-18 .Positive     ᐳ 18'),(272,63,'Urine Albumin ','',10000,'','mg/L','2015-03-04 17:07:39','ᐸ 29'),(273,63,'Urine Creatinine','',5000,'','mg/dl','2015-03-04 17:08:20','28 - 217'),(274,63,'UACR','',0,'','mg/g','2015-03-04 17:09:44',''),(275,64,'Color','',0,'','','2015-03-04 18:42:53',''),(276,64,'Glucose','',5000,'','mg/dl','2015-03-04 18:43:40','74-106'),(277,64,'Albumin','',10000,'','mg/L','2015-03-04 18:44:54','ᐸ 29'),(278,64,'Gram Stain','',0,'','','2015-03-04 18:45:18',''),(279,64,'WBC','',0,'','','2015-03-04 18:45:45',''),(280,64,'RBC','',0,'','','2015-03-04 18:45:56',''),(281,46,'CBP','',18000,'','','2015-03-07 17:07:25',''),(282,46,'Retic Count','',5000,'','','2015-03-07 17:07:51',''),(283,65,'Urine Protein','',10000,'','mg/dL','2015-03-07 17:44:10','ᐸ 14'),(284,65,'Urine Creatinine','',5000,'','mg/dL','2015-03-07 17:46:07','39 - 259'),(285,65,'UPCR','',0,'','','2015-03-07 17:46:20',''),(286,65,'24hr urine Protein','',0,'','gm','2015-03-07 17:47:56',''),(287,66,'HBs Ag','',10000,'','Index','2015-04-28 15:32:52','Negative: ᐸ 0.9\r\nBordeline:ᐳ 0.9 - ᐸ 1.0\r\nPositive: ᐳ 1.0'),(288,66,'Anti-HCV Ab','',10000,'','Index','2015-04-28 15:34:35','Negative: ᐸ 0.9\r\nBordeline:ᐳ 0.9 - ᐸ 1.0\r\nPositive: ᐳ 1.0'),(289,66,'HIV Combi PT','',10000,'','Index','2015-04-28 15:48:14','Negative: ᐸ 0.9\r\nBordeline:ᐳ 0.9 - ᐸ 1.0\r\nPositive: ᐳ 1.0'),(290,44,'Helicobacter pylori IgG Level','',10000,'','','2015-05-02 16:26:34',''),(291,44,'SLE','',10000,'','','2015-05-04 16:52:19',''),(292,67,'T3','',10000,'','nmol/L','2015-05-10 15:55:05','1.3 - 3.1'),(293,67,'T4','',10000,'','nmol/L','2015-05-10 15:55:27','66 -181'),(294,67,'TSH','',10000,'','ᶭIU/ml','2015-05-10 15:57:01','0.27 - 4.2'),(295,68,'Appearance','',0,'','','2015-05-19 17:18:47',''),(296,68,'RBC','',0,'','Cell/ᶭl','2015-05-19 17:24:37',''),(297,68,'WBC','',0,'','Cell/ᶭl','2015-05-19 17:26:07','ᐸ 500'),(298,68,'Glucose','',10000,'','mg/dl','2015-05-19 17:26:49','40 - 70'),(299,68,'Protein','',10000,'','mg/dl','2015-05-19 17:27:01','15 - 45'),(300,67,'FT3','',10000,'','pmol/L','2015-05-23 15:10:03','3.1 - 6.8'),(301,67,'FT4','',10000,'','pmol/L','2015-05-23 15:10:39','12 - 22'),(302,46,'Blood Film','',8000,'','','2015-07-06 17:41:54',''),(303,9,'Jo-1','',15000,'','AU/ml','2015-08-10 17:17:24','Negative :ᐸ 12.0'),(304,69,'Tacrolimus','',60000,'','ng/ml','2015-09-08 17:39:25',''),(305,69,'Cyclosporine','',45000,'','ng/ml','2015-09-08 17:40:39',''),(306,30,'HBs Antigen','',10000,'','','2015-10-12 16:05:08',''),(307,30,'HCV Antibody','',10000,'','','2015-10-12 16:05:32',''),(308,13,'ANA','',10000,'','Index','2015-10-12 16:09:44','Negative:ᐸ0.8\r\nequivocal: 0.8-1.2\r\nPositive: ᐳ1.2');
/*!40000 ALTER TABLE `test` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `user`
--

DROP TABLE IF EXISTS `user`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `user` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(200) COLLATE utf8_bin NOT NULL,
  `id_permission` int(11) NOT NULL,
  `phone` varchar(50) COLLATE utf8_bin DEFAULT NULL,
  `username` varchar(200) COLLATE utf8_bin NOT NULL,
  `password` varchar(200) COLLATE utf8_bin NOT NULL,
  `register_date` date DEFAULT NULL,
  `image_url` varchar(200) COLLATE utf8_bin DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=5 DEFAULT CHARSET=utf8 COLLATE=utf8_bin;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `user`
--

LOCK TABLES `user` WRITE;
/*!40000 ALTER TABLE `user` DISABLE KEYS */;
INSERT INTO `user` VALUES (1,'diako',1,'07505149171','syronz','743c39a39e9b65e2e17c7368f663eadc','2014-05-27',NULL),(2,'a',1,'07505149171','a','f49851b4ba89f7aba33ddaf5bb83b2aa','2014-06-05',NULL),(3,'dara',1,'07703604132','dara','66821d71b60076539917a06348de86dc','2014-06-18',NULL),(4,'cash',1,'00','cash','da2c6dcf1e032cd8ee6ff4018bf13769','2014-06-18',NULL);
/*!40000 ALTER TABLE `user` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `user_activity`
--

DROP TABLE IF EXISTS `user_activity`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `user_activity` (
  `id` bigint(20) NOT NULL AUTO_INCREMENT,
  `ip` varchar(50) COLLATE utf8_bin DEFAULT NULL,
  `id_user` int(11) DEFAULT '0',
  `action` varchar(200) COLLATE utf8_bin DEFAULT NULL,
  `detail` varchar(200) COLLATE utf8_bin DEFAULT NULL,
  `date` datetime NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=185 DEFAULT CHARSET=utf8 COLLATE=utf8_bin;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `user_activity`
--

LOCK TABLES `user_activity` WRITE;
/*!40000 ALTER TABLE `user_activity` DISABLE KEYS */;
INSERT INTO `user_activity` VALUES (1,'::1',NULL,'login to system','DATA : username = syronz ','2016-01-31 10:57:05'),(2,'::1',NULL,'login to system','DATA : username = a ','2016-01-31 10:57:21'),(3,'::1',2,'View exam Table',NULL,'2016-01-31 10:57:24'),(4,'::1',2,'Add new fund','DATA : 0 , 25000','2016-01-31 10:57:35'),(5,'::1',2,'write data to patientm','DATA : name = name / detail = detail','2016-01-31 10:57:35'),(6,'::1',2,'write data to examm','DATA : name = name / detail = detail','2016-01-31 10:57:35'),(7,'::1',2,'View exam Table',NULL,'2016-01-31 10:57:41'),(8,'::1',2,'View exam Table',NULL,'2016-01-31 10:58:42'),(9,'::1',2,'View exam Table',NULL,'2016-01-31 12:15:09'),(10,'::1',2,'View exam Table',NULL,'2016-01-31 12:19:47'),(11,'::1',2,'View exam Table',NULL,'2016-01-31 12:20:08'),(12,'::1',2,'View exam Table',NULL,'2016-01-31 12:23:13'),(13,'::1',2,'View exam Table',NULL,'2016-01-31 12:29:39'),(14,'::1',2,'View exam Table',NULL,'2016-01-31 12:29:56'),(15,'::1',2,'View exam Table',NULL,'2016-01-31 12:30:28'),(16,'::1',2,'View exam Table',NULL,'2016-01-31 12:33:25'),(17,'::1',2,'View exam Table',NULL,'2016-01-31 12:34:28'),(18,'::1',2,'View exam Table',NULL,'2016-01-31 12:36:57'),(19,'::1',2,'View exam Table',NULL,'2016-01-31 12:38:19'),(20,'::1',2,'View patient Table',NULL,'2016-01-31 12:38:20'),(21,'::1',2,'View profile Table',NULL,'2016-01-31 12:38:21'),(22,'::1',2,'View fund\'s',NULL,'2016-01-31 12:38:26'),(23,'::1',2,'View exam Table',NULL,'2016-01-31 12:38:28'),(24,'::1',2,'View test Table',NULL,'2016-01-31 12:38:40'),(25,'::1',2,'View exam Table',NULL,'2016-01-31 12:38:48'),(26,'::1',2,'search exam\'s','SEARCH: ج','2016-01-31 12:38:52'),(27,'::1',2,'search exam\'s','SEARCH: x','2016-01-31 12:38:54'),(28,'::1',2,'View exam Table',NULL,'2016-01-31 12:38:57'),(29,'::1',NULL,'login to system','DATA : username = a ','2016-01-31 15:16:23'),(30,'::1',2,'View exam Table',NULL,'2016-01-31 15:16:26'),(31,'::1',2,'Add new fund','DATA : 0 , 45000','2016-01-31 15:16:49'),(32,'::1',NULL,'login to system','DATA : username = syronz ','2016-02-01 13:13:47'),(33,'::1',NULL,'login to system','DATA : username = syronz ','2016-02-01 13:13:48'),(34,'::1',NULL,'login to system','DATA : username = a ','2016-02-01 13:13:51'),(35,'::1',2,'View exam Table',NULL,'2016-02-01 13:13:53'),(36,'::1',NULL,'login to system','DATA : username = a ','2016-02-28 14:57:26'),(37,'::1',2,'View fund\'s',NULL,'2016-02-28 14:57:34'),(38,'::1',2,'View exam Table',NULL,'2016-02-28 15:00:20'),(39,'::1',2,'View test Table',NULL,'2016-02-28 15:00:22'),(40,'::1',2,'View exam Table',NULL,'2016-02-28 15:00:48'),(41,'::1',NULL,'login to system','DATA : username = a ','2016-03-16 15:08:21'),(42,'::1',2,'View exam Table',NULL,'2016-03-16 15:08:23'),(43,'::1',2,'View profile Table',NULL,'2016-03-16 15:08:27'),(44,'::1',2,'View test Table',NULL,'2016-03-16 15:08:29'),(45,'::1',2,'View models_stuff Detail',NULL,'2016-03-16 15:08:40'),(46,'::1',2,'View models_stuff Detail',NULL,'2016-03-16 15:08:41'),(47,'::1',2,'search test\'s','SEARCH: جپر','2016-03-16 15:08:59'),(48,'::1',2,'search test\'s','SEARCH: cpr','2016-03-16 15:09:02'),(49,'::1',2,'search test\'s','SEARCH: crp','2016-03-16 15:09:05'),(50,'::1',2,'View models_stuff Detail',NULL,'2016-03-16 15:09:14'),(51,'::1',NULL,'login to system','DATA : username = a ','2016-04-10 16:12:39'),(52,'::1',2,'View profile Table',NULL,'2016-04-10 16:12:53'),(53,'::1',2,'View test Table',NULL,'2016-04-10 16:13:02'),(54,'::1',2,'View normal_range Table',NULL,'2016-04-10 16:13:11'),(55,'::1',2,'View exam Table',NULL,'2016-04-10 16:14:33'),(56,'::1',2,'View patient Table',NULL,'2016-04-10 16:15:47'),(57,'::1',2,'search patient\'s','SEARCH: x','2016-04-10 16:16:04'),(58,'::1',2,'View exam Table',NULL,'2016-04-10 16:16:16'),(59,'::1',2,'Add new fund','DATA : 0 , 28000','2016-04-10 16:19:05'),(60,'::1',2,'View fund\'s',NULL,'2016-04-10 16:19:38'),(61,'::1',2,'View exam Table',NULL,'2016-04-10 16:20:08'),(62,'::1',2,'View test Table',NULL,'2016-04-10 16:20:15'),(63,'::1',2,'View exam Table',NULL,'2016-04-10 16:21:13'),(64,'::1',2,'View exam Table',NULL,'2016-04-10 16:21:43'),(65,'::1',2,'View exam Table',NULL,'2016-04-10 16:21:57'),(66,'::1',NULL,'login to system','DATA : username = a ','2016-11-04 21:42:56'),(67,'::1',2,'View exam Table',NULL,'2016-11-04 21:43:02'),(68,'::1',2,'View fund\'s',NULL,'2016-11-04 21:43:08'),(69,'::1',2,'View exam Table',NULL,'2016-11-04 21:43:47'),(70,'::1',NULL,'login to system','DATA : username = a ','2016-11-11 13:43:37'),(71,'::1',2,'View exam Table',NULL,'2016-11-11 13:43:41'),(72,'::1',2,'View fund\'s',NULL,'2016-11-11 13:43:45'),(73,'::1',2,'View exam Table',NULL,'2016-11-11 13:43:46'),(74,'::1',2,'View exam Table',NULL,'2016-11-11 13:43:52'),(75,'::1',NULL,'login to system','DATA : username = syronz ','2016-11-22 18:42:31'),(76,'::1',NULL,'login to system','DATA : username = syronz ','2016-11-22 18:42:32'),(77,'::1',NULL,'login to system','DATA : username = syronz ','2017-01-10 08:16:21'),(78,'::1',NULL,'login to system','DATA : username = a ','2017-01-10 08:16:31'),(79,'::1',2,'View exam Table',NULL,'2017-01-10 08:16:51'),(80,'::1',2,'View exam Table',NULL,'2017-01-10 08:19:08'),(81,'::1',2,'View exam Table',NULL,'2017-01-10 08:19:24'),(82,'::1',NULL,'login to system','DATA : username = syronz ','2017-04-28 22:29:46'),(83,'::1',NULL,'login to system','DATA : username = a ','2017-04-28 22:29:50'),(84,'::1',2,'View exam Table',NULL,'2017-04-28 22:29:57'),(85,'::1',2,'View exam Table',NULL,'2017-04-28 22:30:13'),(86,'::1',2,'View fund\'s',NULL,'2017-04-28 22:37:15'),(87,'::1',2,'View exam Table',NULL,'2017-04-28 22:37:18'),(88,'::1',NULL,'login to system','DATA : username = a ','2017-05-01 08:26:15'),(89,'::1',2,'View exam Table',NULL,'2017-05-01 08:26:21'),(90,'::1',2,'View exam Table',NULL,'2017-05-01 08:27:37'),(91,'::1',2,'Add new fund','DATA : 0 , 10000','2017-05-01 08:28:19'),(92,'::1',2,'write data to patientm','DATA : name = name / detail = detail','2017-05-01 08:28:19'),(93,'::1',2,'write data to examm','DATA : name = name / detail = detail','2017-05-01 08:28:19'),(94,'::1',2,'View exam Table',NULL,'2017-05-01 08:28:28'),(95,'::1',2,'View exam Table',NULL,'2017-05-01 08:33:45'),(96,'::1',2,'View exam Table',NULL,'2017-05-01 08:34:09'),(97,'::1',2,'View exam Table',NULL,'2017-05-01 08:35:08'),(98,'::1',2,'View exam Table',NULL,'2017-05-01 08:35:30'),(99,'::1',2,'View exam Table',NULL,'2017-05-01 08:35:52'),(100,'::1',2,'View exam Table',NULL,'2017-05-01 08:36:05'),(101,'::1',2,'View exam Table',NULL,'2017-05-01 08:36:29'),(102,'::1',2,'View exam Table',NULL,'2017-05-01 08:36:52'),(103,'::1',2,'View exam Table',NULL,'2017-05-01 08:37:12'),(104,'::1',2,'View exam Table',NULL,'2017-05-01 08:39:27'),(105,'::1',2,'View exam Table',NULL,'2017-05-01 08:39:47'),(106,'::1',2,'View exam Table',NULL,'2017-05-01 08:43:05'),(107,'::1',2,'View exam Table',NULL,'2017-05-01 08:45:32'),(108,'::1',2,'Add new fund','DATA : 0 , 30000','2017-05-01 08:46:19'),(109,'::1',2,'write data to patientm','DATA : name = name / detail = detail','2017-05-01 08:46:19'),(110,'::1',2,'write data to examm','DATA : name = name / detail = detail','2017-05-01 08:46:19'),(111,'::1',2,'View exam Table',NULL,'2017-05-01 08:46:25'),(112,'::1',2,'View exam Table',NULL,'2017-05-01 08:48:37'),(113,'::1',2,'View exam Table',NULL,'2017-05-01 08:48:47'),(114,'::1',2,'View exam Table',NULL,'2017-05-01 08:50:29'),(115,'::1',2,'View exam Table',NULL,'2017-05-01 08:51:34'),(116,'::1',2,'View fund\'s',NULL,'2017-05-01 08:53:15'),(117,'::1',2,'View exam Table',NULL,'2017-05-01 08:53:16'),(118,'::1',2,'View exam Table',NULL,'2017-05-01 08:53:24'),(119,'::1',2,'View test Table',NULL,'2017-05-01 08:53:35'),(120,'::1',2,'View fund\'s',NULL,'2017-05-01 08:53:40'),(121,'::1',2,'View exam Table',NULL,'2017-05-01 08:53:41'),(122,'::1',2,'View exam Table',NULL,'2017-05-01 08:53:50'),(123,'::1',2,'View exam Table',NULL,'2017-05-01 08:57:26'),(124,'::1',2,'View exam Table',NULL,'2017-05-01 08:57:57'),(125,'::1',2,'View exam Table',NULL,'2017-05-01 09:01:27'),(126,'::1',2,'View exam Table',NULL,'2017-05-01 09:03:02'),(127,'::1',2,'View exam Table',NULL,'2017-05-01 09:03:19'),(128,'::1',2,'View exam Table',NULL,'2017-05-01 09:04:00'),(129,'::1',2,'View exam Table',NULL,'2017-05-01 09:06:18'),(130,'::1',2,'View exam Table',NULL,'2017-05-01 09:07:00'),(131,'::1',2,'View exam Table',NULL,'2017-05-01 09:07:37'),(132,'::1',2,'View exam Table',NULL,'2017-05-01 09:08:31'),(133,'::1',2,'View exam Table',NULL,'2017-05-01 09:09:55'),(134,'::1',2,'View exam Table',NULL,'2017-05-01 09:11:37'),(135,'::1',2,'View exam Table',NULL,'2017-05-01 09:11:54'),(136,'::1',2,'View exam Table',NULL,'2017-05-01 09:12:15'),(137,'::1',2,'View exam Table',NULL,'2017-05-01 09:12:42'),(138,'::1',2,'View exam Table',NULL,'2017-05-01 09:13:02'),(139,'::1',2,'View exam Table',NULL,'2017-05-01 09:14:16'),(140,'::1',2,'View exam Table',NULL,'2017-05-01 09:15:17'),(141,'::1',2,'Add new fund','DATA : 0 , 10000','2017-05-01 09:15:40'),(142,'::1',2,'write data to patientm','DATA : name = name / detail = detail','2017-05-01 09:15:40'),(143,'::1',2,'write data to examm','DATA : name = name / detail = detail','2017-05-01 09:15:40'),(144,'::1',2,'View exam Table',NULL,'2017-05-01 09:15:48'),(145,'::1',2,'View exam Table',NULL,'2017-05-01 09:16:21'),(146,'::1',2,'Add new fund','DATA : 0 , 15000','2017-05-01 09:16:38'),(147,'::1',2,'write data to examm','DATA : name = name / detail = detail','2017-05-01 09:16:38'),(148,'::1',2,'View exam Table',NULL,'2017-05-01 09:16:43'),(149,'::1',2,'View exam Table',NULL,'2017-05-01 09:17:13'),(150,'::1',2,'Add new fund','DATA : 0 , 10000','2017-05-01 09:17:38'),(151,'::1',2,'write data to examm','DATA : name = name / detail = detail','2017-05-01 09:17:38'),(152,'::1',2,'View exam Table',NULL,'2017-05-01 09:17:42'),(153,'10.32.131.74',NULL,'login to system','DATA : username = a ','2017-05-08 14:08:46'),(154,'10.32.131.74',2,'View test Table',NULL,'2017-05-08 14:08:57'),(155,'10.32.131.74',2,'View fund\'s',NULL,'2017-05-08 14:09:02'),(156,'10.32.131.74',2,'View patient Table',NULL,'2017-05-08 14:09:06'),(157,'127.0.0.1',NULL,'login to system','DATA : username = syronz ','2018-08-18 11:52:27'),(158,'::1',NULL,'login to system','DATA : username = a ','2018-08-18 11:52:30'),(159,'::1',2,'View exam Table',NULL,'2018-08-18 11:52:33'),(160,'::1',2,'View fund\'s',NULL,'2018-08-18 11:52:34'),(161,'::1',2,'View patient Table',NULL,'2018-08-18 11:52:35'),(162,'::1',2,'View profile Table',NULL,'2018-08-18 11:52:36'),(163,'127.0.0.1',NULL,'login to system','DATA : username = syronz ','2018-11-02 07:18:52'),(164,'::1',NULL,'login to system','DATA : username = root ','2018-11-02 07:18:53'),(165,'::1',NULL,'login to system','DATA : username = a ','2018-11-02 07:19:03'),(166,'::1',2,'View exam Table',NULL,'2018-11-02 07:19:06'),(167,'::1',2,'View fund\'s',NULL,'2018-11-02 07:19:08'),(168,'::1',2,'View exam Table',NULL,'2018-11-02 07:19:10'),(169,'::1',2,'View test Table',NULL,'2018-11-02 07:19:12'),(170,'::1',2,'View fund\'s',NULL,'2018-11-02 07:19:17'),(171,'::1',2,'View patient Table',NULL,'2018-11-02 07:19:18'),(172,'::1',2,'View profile Table',NULL,'2018-11-02 07:19:21'),(173,'::1',2,'View test Table',NULL,'2018-11-02 07:19:23'),(174,'::1',2,'View normal_range Table',NULL,'2018-11-02 07:19:24'),(175,'::1',2,'View test Table',NULL,'2018-11-02 07:19:26'),(176,'::1',2,'View models_stuff Detail',NULL,'2018-11-02 07:19:27'),(177,'::1',2,'View models_stuff Detail',NULL,'2018-11-02 07:19:31'),(178,'::1',2,'View patient Table',NULL,'2018-11-02 07:19:35'),(179,'::1',2,'View fund\'s',NULL,'2018-11-02 07:19:37'),(180,'::1',2,'View exam Table',NULL,'2018-11-02 07:19:38'),(181,'::1',2,'View exam Table',NULL,'2018-11-02 07:23:26'),(182,'::1',2,'View test Table',NULL,'2018-11-02 07:23:30'),(183,'::1',2,'View patient Table',NULL,'2018-11-02 07:23:38'),(184,'::1',2,'View profile Table',NULL,'2018-11-02 07:23:39');
/*!40000 ALTER TABLE `user_activity` ENABLE KEYS */;
UNLOCK TABLES;
/*!40103 SET TIME_ZONE=@OLD_TIME_ZONE */;

/*!40101 SET SQL_MODE=@OLD_SQL_MODE */;
/*!40014 SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS */;
/*!40014 SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
/*!40111 SET SQL_NOTES=@OLD_SQL_NOTES */;

-- Dump completed on 2018-11-02  7:49:11
