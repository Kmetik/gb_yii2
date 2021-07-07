-- MySQL dump 10.13  Distrib 5.7.26, for Linux (x86_64)
--
-- Host: localhost    Database: kmetik_todo
-- ------------------------------------------------------
-- Server version	5.7.26-0ubuntu0.18.04.1

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
-- Table structure for table `activities`
--

DROP TABLE IF EXISTS `activities`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `activities` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `user_id` int(11) NOT NULL,
  `title` varchar(150) NOT NULL,
  `description` text,
  `dateStart` date NOT NULL,
  `timeStart` time NOT NULL,
  `dateFinish` date NOT NULL,
  `timeFinish` time DEFAULT NULL,
  `isBlocked` tinyint(1) DEFAULT '0',
  `isRepeat` tinyint(1) DEFAULT '0',
  `useNotification` tinyint(1) DEFAULT '0',
  `repeatType` varchar(255) DEFAULT NULL,
  `active` tinyint(1) NOT NULL DEFAULT '1',
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `updated_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`),
  KEY `idx-user_activity` (`user_id`),
  CONSTRAINT `fk-user_id-activity_id` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=27 DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `activities`
--

LOCK TABLES `activities` WRITE;
/*!40000 ALTER TABLE `activities` DISABLE KEYS */;
INSERT INTO `activities` VALUES (1,1,'Встать','чтобы лечь','2019-06-19','08:00:00','2019-06-19','09:00:00',0,0,0,NULL,1,'2019-06-27 04:37:07','2019-06-27 04:37:07'),(2,1,'Умыться','чтобы лечь','2019-06-19','09:00:00','2019-06-19','09:15:00',0,0,0,NULL,1,'2019-06-27 04:37:07','2019-06-27 04:37:07'),(3,1,'Поесть','чтобы лечь','2019-06-19','08:00:00','2019-06-19','09:00:00',0,0,0,NULL,1,'2019-06-27 04:37:07','2019-06-27 04:37:07'),(4,1,'Сделать важное дело','чтобы лечь','2019-06-19','14:00:00','2019-06-19','18:00:00',0,0,0,NULL,1,'2019-06-27 04:37:07','2019-06-27 04:37:07'),(5,1,'Неважно что, лишь бы','чтобы лечь','2019-06-20','23:00:00','2019-06-20','23:05:00',0,0,0,NULL,1,'2019-06-27 04:37:07','2019-06-27 04:37:07'),(6,2,'Встать','чтобы упасть','2019-06-19','08:00:00','2019-06-19','09:00:00',0,0,0,NULL,1,'2019-06-27 04:37:07','2019-06-27 04:37:07'),(7,2,'Умыться','чтобы упасть','2019-06-19','09:00:00','2019-06-19','09:15:00',0,0,0,NULL,1,'2019-06-27 04:37:07','2019-06-27 04:37:07'),(8,2,'Погулять','чтобы упасть','2019-06-19','08:00:00','2019-06-19','09:00:00',0,0,0,NULL,1,'2019-06-27 04:37:07','2019-06-27 04:37:07'),(9,2,'Сделать неважное дело','чтобы упасть','2019-06-19','14:00:00','2019-06-19','18:00:00',0,0,0,NULL,1,'2019-06-27 04:37:07','2019-06-27 04:37:07'),(10,2,'Неважно что, лишь бы','чтобы упасть','2019-06-20','11:00:00','2019-06-20','13:05:00',0,0,0,NULL,1,'2019-06-27 04:37:07','2019-06-27 04:37:07'),(11,2,'Съесть собаку','чтобы получить корейскую визу','2019-06-27','23:15:00','2019-06-27','23:30:00',0,0,1,'1d',1,'2019-06-27 15:05:39','2019-06-27 15:05:39'),(24,2,'Плясать на костре','чтобы понять, что плясать на костре плохо','2019-06-28','08:00:00','2019-06-28','09:00:00',0,0,1,'1d',1,'2019-06-27 15:19:34','2019-06-27 15:19:34'),(25,2,'Плясать на костре','чтобы понять, что плясать на костре плохо','2019-06-28','08:00:00','2019-06-28','09:00:00',0,0,1,'1d',1,'2019-06-27 15:20:27','2019-06-27 15:20:27'),(26,4,'Спать и вонять грязным возле офиса водоканала','чтобы включили горячую воду','2019-06-28','12:00:00','2019-06-28','20:00:00',0,0,0,'1d',1,'2019-06-28 07:03:37','2019-06-28 07:03:37');
/*!40000 ALTER TABLE `activities` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `auth_assignment`
--

DROP TABLE IF EXISTS `auth_assignment`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `auth_assignment` (
  `item_name` varchar(64) COLLATE utf8_unicode_ci NOT NULL,
  `user_id` varchar(64) COLLATE utf8_unicode_ci NOT NULL,
  `created_at` int(11) DEFAULT NULL,
  PRIMARY KEY (`item_name`,`user_id`),
  KEY `idx-auth_assignment-user_id` (`user_id`),
  CONSTRAINT `auth_assignment_ibfk_1` FOREIGN KEY (`item_name`) REFERENCES `auth_item` (`name`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `auth_assignment`
--

LOCK TABLES `auth_assignment` WRITE;
/*!40000 ALTER TABLE `auth_assignment` DISABLE KEYS */;
INSERT INTO `auth_assignment` VALUES ('admin','1',1561611759),('user','2',1561611759),('user','3',1561629788),('user','4',1561633990);
/*!40000 ALTER TABLE `auth_assignment` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `auth_item`
--

DROP TABLE IF EXISTS `auth_item`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `auth_item` (
  `name` varchar(64) COLLATE utf8_unicode_ci NOT NULL,
  `type` smallint(6) NOT NULL,
  `description` text COLLATE utf8_unicode_ci,
  `rule_name` varchar(64) COLLATE utf8_unicode_ci DEFAULT NULL,
  `data` blob,
  `created_at` int(11) DEFAULT NULL,
  `updated_at` int(11) DEFAULT NULL,
  PRIMARY KEY (`name`),
  KEY `rule_name` (`rule_name`),
  KEY `idx-auth_item-type` (`type`),
  CONSTRAINT `auth_item_ibfk_1` FOREIGN KEY (`rule_name`) REFERENCES `auth_rule` (`name`) ON DELETE SET NULL ON UPDATE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `auth_item`
--

LOCK TABLES `auth_item` WRITE;
/*!40000 ALTER TABLE `auth_item` DISABLE KEYS */;
INSERT INTO `auth_item` VALUES ('admin',1,NULL,NULL,NULL,1561611759,1561611759),('allPriveleges',2,'полный доступ',NULL,NULL,1561611759,1561611759),('createActivity',2,'создание задачи',NULL,NULL,1561611759,1561611759),('user',1,NULL,NULL,NULL,1561611759,1561611759),('viewEditOwner',2,'редактирование и просмотр события','ownerActivityRule',NULL,1561611759,1561611759);
/*!40000 ALTER TABLE `auth_item` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `auth_item_child`
--

DROP TABLE IF EXISTS `auth_item_child`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `auth_item_child` (
  `parent` varchar(64) COLLATE utf8_unicode_ci NOT NULL,
  `child` varchar(64) COLLATE utf8_unicode_ci NOT NULL,
  PRIMARY KEY (`parent`,`child`),
  KEY `child` (`child`),
  CONSTRAINT `auth_item_child_ibfk_1` FOREIGN KEY (`parent`) REFERENCES `auth_item` (`name`) ON DELETE CASCADE ON UPDATE CASCADE,
  CONSTRAINT `auth_item_child_ibfk_2` FOREIGN KEY (`child`) REFERENCES `auth_item` (`name`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `auth_item_child`
--

LOCK TABLES `auth_item_child` WRITE;
/*!40000 ALTER TABLE `auth_item_child` DISABLE KEYS */;
INSERT INTO `auth_item_child` VALUES ('admin','allPriveleges'),('admin','createActivity'),('user','createActivity'),('admin','viewEditOwner'),('user','viewEditOwner');
/*!40000 ALTER TABLE `auth_item_child` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `auth_rule`
--

DROP TABLE IF EXISTS `auth_rule`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `auth_rule` (
  `name` varchar(64) COLLATE utf8_unicode_ci NOT NULL,
  `data` blob,
  `created_at` int(11) DEFAULT NULL,
  `updated_at` int(11) DEFAULT NULL,
  PRIMARY KEY (`name`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `auth_rule`
--

LOCK TABLES `auth_rule` WRITE;
/*!40000 ALTER TABLE `auth_rule` DISABLE KEYS */;
INSERT INTO `auth_rule` VALUES ('ownerActivityRule',_binary 'O:27:\"app\\rules\\OwnerActivityRule\":3:{s:4:\"name\";s:17:\"ownerActivityRule\";s:9:\"createdAt\";i:1561611759;s:9:\"updatedAt\";i:1561611759;}',1561611759,1561611759);
/*!40000 ALTER TABLE `auth_rule` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `migration`
--

DROP TABLE IF EXISTS `migration`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `migration` (
  `version` varchar(180) NOT NULL,
  `apply_time` int(11) DEFAULT NULL,
  PRIMARY KEY (`version`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `migration`
--

LOCK TABLES `migration` WRITE;
/*!40000 ALTER TABLE `migration` DISABLE KEYS */;
INSERT INTO `migration` VALUES ('m000000_000000_base',1560924972),('m140506_102106_rbac_init',1561610240),('m170907_052038_rbac_add_index_on_auth_assignment_user_id',1561610240),('m180523_151638_rbac_updates_indexes_without_prefix',1561610241),('m190619_050428_CreateTables',1561610226),('m190619_074153_AddFKIndexes',1561610226),('m190619_074835_InsertTestData',1561610227);
/*!40000 ALTER TABLE `migration` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `userFiles`
--

DROP TABLE IF EXISTS `userFiles`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `userFiles` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `user_id` int(11) NOT NULL,
  `activity_id` int(11) NOT NULL,
  `fileURL` varchar(255) NOT NULL,
  PRIMARY KEY (`id`),
  KEY `idx-user_files-activity_id` (`activity_id`),
  KEY `idx-file_id-user_id` (`user_id`),
  CONSTRAINT `fk-file_id-activity_id` FOREIGN KEY (`activity_id`) REFERENCES `activities` (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=7 DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `userFiles`
--

LOCK TABLES `userFiles` WRITE;
/*!40000 ALTER TABLE `userFiles` DISABLE KEYS */;
INSERT INTO `userFiles` VALUES (5,2,25,'images/Black-and-White-Portrait-Lighting-4.jpg'),(6,2,25,'images/Famous-Black-and-White-Portrait-Photographers.jpg');
/*!40000 ALTER TABLE `userFiles` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `users`
--

DROP TABLE IF EXISTS `users`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `users` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(150) NOT NULL,
  `email` varchar(55) NOT NULL,
  `password_hash` varchar(255) NOT NULL,
  `role` int(11) DEFAULT '0',
  `auth_token` varchar(300) DEFAULT NULL,
  `auth_key` varchar(300) DEFAULT NULL,
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`),
  UNIQUE KEY `email` (`email`)
) ENGINE=InnoDB AUTO_INCREMENT=5 DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `users`
--

LOCK TABLES `users` WRITE;
/*!40000 ALTER TABLE `users` DISABLE KEYS */;
INSERT INTO `users` VALUES (1,'Админ','test@test.ru','$2y$13$kLKkX7VDXhyE1aemvUT2M.s/hypaO8pRr4weloyufFqEwJBoChtLS',0,NULL,NULL,'2019-06-27 04:37:07'),(2,'Работяга','test2@test.ru','$2y$13$5anf2LCp.JCvimgL2sz7husf/x44TDd6gffog7p1p/qGRifGMIESe',0,NULL,NULL,'2019-06-27 04:37:07'),(3,'Конь','test3@mail.ru','$2y$13$laBpqJG1I2UmeebYb5NGmu2jkeQ0k/GE593/fAEi6C5i4c/fDsqc6',0,NULL,'9K_2ImOVP1F9bCPduWlZxfsc7uecKJGR','2019-06-27 10:03:08'),(4,'Работяга2','alexiskmetik@gmail.com','$2y$13$j8uSHteVHyWePfe2Hlqtn.BnDcgwN7sHSknU/xw/gLFEVYBaAFmha',0,NULL,'2vzr0FcnV1-NEVzK5T1D3KHyYf9-_ABa','2019-06-27 11:13:10');
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

-- Dump completed on 2019-06-28 19:19:09
