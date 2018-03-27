-- MySQL dump 10.13  Distrib 5.7.17, for macos10.12 (x86_64)
--
-- Host: localhost    Database: gym-management
-- ------------------------------------------------------
-- Server version	5.7.10

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
-- Table structure for table `app_config`
--

DROP TABLE IF EXISTS `app_config`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `app_config` (
  `set_threshold` int(11) NOT NULL,
  `reps_threshold` int(11) NOT NULL,
  PRIMARY KEY (`set_threshold`,`reps_threshold`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `app_config`
--

LOCK TABLES `app_config` WRITE;
/*!40000 ALTER TABLE `app_config` DISABLE KEYS */;
INSERT INTO `app_config` VALUES (20,3);
/*!40000 ALTER TABLE `app_config` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `fee_structure`
--

DROP TABLE IF EXISTS `fee_structure`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `fee_structure` (
  `duration` int(11) NOT NULL,
  `amount` int(11) NOT NULL,
  PRIMARY KEY (`duration`),
  KEY `fees_structure_uk` (`duration`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `fee_structure`
--

LOCK TABLES `fee_structure` WRITE;
/*!40000 ALTER TABLE `fee_structure` DISABLE KEYS */;
INSERT INTO `fee_structure` VALUES (1,1000),(3,3000),(6,6000),(12,12000);
/*!40000 ALTER TABLE `fee_structure` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `fees`
--

DROP TABLE IF EXISTS `fees`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `fees` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `user_id` int(11) NOT NULL,
  `amount` int(11) NOT NULL,
  `from_date` date NOT NULL,
  `to_date` date NOT NULL,
  `payment_mode` varchar(45) NOT NULL,
  `payment_date` datetime NOT NULL,
  PRIMARY KEY (`id`),
  KEY `fees_fk_idx` (`user_id`),
  KEY `fees_uk` (`user_id`,`amount`,`from_date`,`to_date`),
  CONSTRAINT `fees_fk` FOREIGN KEY (`user_id`) REFERENCES `member` (`user_id`) ON DELETE NO ACTION ON UPDATE NO ACTION
) ENGINE=InnoDB AUTO_INCREMENT=8 DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `fees`
--

LOCK TABLES `fees` WRITE;
/*!40000 ALTER TABLE `fees` DISABLE KEYS */;
INSERT INTO `fees` VALUES (3,8,1000,'2018-03-28','2018-04-28','Card','2018-03-28 02:02:10'),(6,8,1000,'2018-04-28','2018-05-28','Card','2018-03-28 02:09:55');
/*!40000 ALTER TABLE `fees` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `manager`
--

DROP TABLE IF EXISTS `manager`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `manager` (
  `user_id` int(11) NOT NULL,
  `qualification` varchar(45) NOT NULL,
  KEY `manager_fk_idx` (`user_id`),
  CONSTRAINT `manager_fk` FOREIGN KEY (`user_id`) REFERENCES `user` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION
) ENGINE=InnoDB DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `manager`
--

LOCK TABLES `manager` WRITE;
/*!40000 ALTER TABLE `manager` DISABLE KEYS */;
INSERT INTO `manager` VALUES (10,'B.COM');
/*!40000 ALTER TABLE `manager` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `member`
--

DROP TABLE IF EXISTS `member`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `member` (
  `user_id` int(11) NOT NULL,
  `gender` varchar(1) NOT NULL,
  `age` int(11) NOT NULL,
  `weight` int(11) NOT NULL,
  `height` int(11) NOT NULL,
  KEY `member_fk_idx` (`user_id`),
  CONSTRAINT `member_fk` FOREIGN KEY (`user_id`) REFERENCES `user` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION
) ENGINE=InnoDB DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `member`
--

LOCK TABLES `member` WRITE;
/*!40000 ALTER TABLE `member` DISABLE KEYS */;
INSERT INTO `member` VALUES (8,'M',23,90,181),(11,'M',20,50,150);
/*!40000 ALTER TABLE `member` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `rfid`
--

DROP TABLE IF EXISTS `rfid`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `rfid` (
  `id` varchar(15) NOT NULL,
  `card_id` varchar(15) NOT NULL,
  `user_id` int(11) DEFAULT NULL,
  PRIMARY KEY (`id`,`card_id`),
  KEY `rfid_fk_idx` (`user_id`),
  KEY `rfid_uk` (`id`,`card_id`,`user_id`),
  KEY `rfid_ci_uk` (`card_id`),
  KEY `rfid_id_uk` (`id`),
  CONSTRAINT `rfid_fk` FOREIGN KEY (`user_id`) REFERENCES `user` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION
) ENGINE=InnoDB DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `rfid`
--

LOCK TABLES `rfid` WRITE;
/*!40000 ALTER TABLE `rfid` DISABLE KEYS */;
INSERT INTO `rfid` VALUES ('54006AE3C518','58309',8),('52009F2D4CAC','11596',11);
/*!40000 ALTER TABLE `rfid` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `trainer`
--

DROP TABLE IF EXISTS `trainer`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `trainer` (
  `user_id` int(11) NOT NULL,
  `gender` varchar(1) NOT NULL,
  `experience` int(11) NOT NULL,
  `salary` int(11) DEFAULT NULL,
  KEY `trainer_fk_idx` (`user_id`),
  CONSTRAINT `trainer_fk` FOREIGN KEY (`user_id`) REFERENCES `user` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION
) ENGINE=InnoDB DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `trainer`
--

LOCK TABLES `trainer` WRITE;
/*!40000 ALTER TABLE `trainer` DISABLE KEYS */;
INSERT INTO `trainer` VALUES (9,'M',2,10000);
/*!40000 ALTER TABLE `trainer` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `user`
--

DROP TABLE IF EXISTS `user`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `user` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `email` varchar(45) NOT NULL,
  `password` varchar(45) NOT NULL,
  `address` varchar(45) DEFAULT NULL,
  `phone` varchar(45) DEFAULT NULL,
  `role` varchar(45) NOT NULL,
  `name` varchar(45) NOT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `email_UNIQUE` (`email`,`password`,`role`)
) ENGINE=InnoDB AUTO_INCREMENT=12 DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `user`
--

LOCK TABLES `user` WRITE;
/*!40000 ALTER TABLE `user` DISABLE KEYS */;
INSERT INTO `user` VALUES (8,'a@a.com','a','Andheri','9876543210','U','Prashant'),(9,'b@b.com','b','Andheri','9876543210','T','Prashant'),(10,'c@c.com','c','Andheri','9876543210','M','Prashant'),(11,'d@d.com','d','Mumbai','9871234','U','Member1');
/*!40000 ALTER TABLE `user` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `user_reps`
--

DROP TABLE IF EXISTS `user_reps`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `user_reps` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `set_id` int(11) NOT NULL,
  `start_time` datetime NOT NULL,
  `end_time` datetime NOT NULL,
  `count` int(11) NOT NULL,
  PRIMARY KEY (`id`),
  KEY `user_reps_fk_idx` (`set_id`),
  KEY `user_reps_uk` (`set_id`,`start_time`,`end_time`,`count`),
  CONSTRAINT `user_reps_fk` FOREIGN KEY (`set_id`) REFERENCES `user_set` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION
) ENGINE=InnoDB AUTO_INCREMENT=55 DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `user_reps`
--

LOCK TABLES `user_reps` WRITE;
/*!40000 ALTER TABLE `user_reps` DISABLE KEYS */;
INSERT INTO `user_reps` VALUES (43,62,'2018-02-27 23:30:55','2018-02-27 23:31:15',10),(44,63,'2018-02-27 23:32:22','2018-02-27 23:32:43',10),(45,64,'2018-02-27 23:34:17','2018-02-27 23:34:43',6),(46,65,'2018-02-27 23:41:38','2018-02-27 23:41:45',3),(47,65,'2018-02-27 23:41:45','2018-02-27 23:41:55',4),(48,65,'2018-02-27 23:41:55','2018-02-27 23:41:59',1),(49,66,'2018-02-27 23:42:22','2018-02-27 23:42:36',8),(50,66,'2018-02-27 23:42:36','2018-02-27 23:42:43',4),(51,67,'2018-02-28 03:17:13','2018-02-28 03:17:22',5),(52,67,'2018-02-28 03:17:22','2018-02-28 03:17:31',4),(53,68,'2018-02-28 03:20:32','2018-02-28 03:20:40',5),(54,68,'2018-02-28 03:20:40','2018-02-28 03:20:51',7);
/*!40000 ALTER TABLE `user_reps` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `user_set`
--

DROP TABLE IF EXISTS `user_set`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `user_set` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `rfid` varchar(15) NOT NULL,
  `start_time` datetime NOT NULL,
  `end_time` datetime NOT NULL,
  PRIMARY KEY (`id`),
  KEY `user_set_fk_idx` (`rfid`),
  KEY `user_set_uk` (`rfid`,`start_time`,`end_time`),
  CONSTRAINT `user_set_fk` FOREIGN KEY (`rfid`) REFERENCES `rfid` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION
) ENGINE=InnoDB AUTO_INCREMENT=69 DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `user_set`
--

LOCK TABLES `user_set` WRITE;
/*!40000 ALTER TABLE `user_set` DISABLE KEYS */;
INSERT INTO `user_set` VALUES (68,'52009F2D4CAC','2018-02-28 03:20:32','2018-02-28 03:20:51'),(62,'54006AE3C518','2018-02-27 23:30:55','2018-02-27 23:31:15'),(63,'54006AE3C518','2018-02-27 23:32:22','2018-02-27 23:32:43'),(64,'54006AE3C518','2018-02-27 23:34:17','2018-02-27 23:34:43'),(65,'54006AE3C518','2018-02-27 23:41:38','2018-02-27 23:41:59'),(66,'54006AE3C518','2018-02-27 23:42:22','2018-02-27 23:42:43'),(67,'54006AE3C518','2018-02-28 03:17:13','2018-02-28 03:17:31');
/*!40000 ALTER TABLE `user_set` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Dumping events for database 'gym-management'
--

--
-- Dumping routines for database 'gym-management'
--
/*!40103 SET TIME_ZONE=@OLD_TIME_ZONE */;

/*!40101 SET SQL_MODE=@OLD_SQL_MODE */;
/*!40014 SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS */;
/*!40014 SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
/*!40111 SET SQL_NOTES=@OLD_SQL_NOTES */;

-- Dump completed on 2018-03-28  2:28:50
