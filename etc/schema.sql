-- MySQL dump 10.13  Distrib 5.7.19, for osx10.12 (x86_64)
--
-- Host: localhost    Database: vuedium
-- ------------------------------------------------------
-- Server version	5.7.19

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
-- Table structure for table `post`
--

DROP TABLE IF EXISTS `post`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `post` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `slug` varchar(500) NOT NULL,
  `title` varchar(255) NOT NULL,
  `description` text NOT NULL,
  `published_dt` datetime DEFAULT NULL,
  `created_dt` datetime NOT NULL,
  `updated_dt` datetime DEFAULT NULL,
  `deleted_dt` datetime DEFAULT NULL,
  `user_id` int(10) unsigned NOT NULL,
  `image_url` varchar(500) DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `slug_UNIQUE` (`slug`),
  KEY `fk_post_user1_idx` (`user_id`),
  CONSTRAINT `fk_post_user1` FOREIGN KEY (`user_id`) REFERENCES `user` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION
) ENGINE=InnoDB AUTO_INCREMENT=15 DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `post`
--

LOCK TABLES `post` WRITE;
/*!40000 ALTER TABLE `post` DISABLE KEYS */;
INSERT INTO `post` VALUES (3,'my-little-title','my little title','description\n	\n','2017-12-12 12:12:12','2017-12-12 12:12:12','2017-12-10 00:21:25','2017-12-10 00:21:25',1,NULL),(4,'este-es-un-hermoso-titulo','este es un hermoso titulo','description del orto',NULL,'2017-12-09 17:00:44',NULL,NULL,1,NULL),(5,'another-2-y-que-wa','another 2 y que wa','edited description',NULL,'2017-12-09 17:04:08','2017-12-10 04:08:39','2017-12-10 00:19:48',1,NULL),(6,'este','este','description del orto',NULL,'2017-12-09 23:03:55',NULL,NULL,1,NULL),(7,'jelou','jelou','description del orto',NULL,'2017-12-09 23:04:05',NULL,NULL,1,NULL),(8,'testing-api','testing api','edited description',NULL,'2017-12-11 15:06:21',NULL,NULL,1,NULL),(9,'otro-ejemplo-del-api','otro ejemplo del api','edited description',NULL,'2017-12-11 15:25:34',NULL,NULL,1,NULL),(10,'asdasdasd','asdasdasd','edited description',NULL,'2017-12-11 16:35:26',NULL,NULL,1,NULL),(11,'another-thing-here','another thing here','edited description',NULL,'2017-12-11 18:40:34',NULL,NULL,1,NULL),(12,'another-thing-here-2','another thing here 2','edited description',NULL,'2017-12-11 18:46:34',NULL,NULL,1,NULL),(13,'another-thing-here-3','another thing here 3','edited description','2017-12-11 18:46:48','2017-12-11 18:46:48',NULL,NULL,1,NULL),(14,'another-thing-here-4','another thing here 4','edited description',NULL,'2017-12-11 18:46:57',NULL,NULL,1,NULL);
/*!40000 ALTER TABLE `post` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `propel_migration`
--

DROP TABLE IF EXISTS `propel_migration`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `propel_migration` (
  `version` int(11) DEFAULT '0'
) ENGINE=InnoDB DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `propel_migration`
--

LOCK TABLES `propel_migration` WRITE;
/*!40000 ALTER TABLE `propel_migration` DISABLE KEYS */;
/*!40000 ALTER TABLE `propel_migration` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `token`
--

DROP TABLE IF EXISTS `token`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `token` (
  `id` char(22) NOT NULL,
  `type` varchar(10) NOT NULL DEFAULT 'access',
  `details` text,
  `expire_dt` datetime NOT NULL,
  `created_dt` datetime NOT NULL,
  `updated_dt` datetime DEFAULT NULL,
  `user_id` int(10) unsigned NOT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `id_UNIQUE` (`id`),
  KEY `fk_token_user_idx` (`user_id`),
  CONSTRAINT `fk_token_user` FOREIGN KEY (`user_id`) REFERENCES `user` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION
) ENGINE=InnoDB DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `token`
--

LOCK TABLES `token` WRITE;
/*!40000 ALTER TABLE `token` DISABLE KEYS */;
INSERT INTO `token` VALUES ('accesstokenvuedium','access',NULL,'2024-05-31 10:10:10','2017-12-09 10:10:10',NULL,1);
/*!40000 ALTER TABLE `token` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `user`
--

DROP TABLE IF EXISTS `user`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `user` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `first_name` varchar(45) NOT NULL,
  `last_name` varchar(45) DEFAULT NULL,
  `password` varchar(50) NOT NULL,
  `email` varchar(50) NOT NULL,
  `created_dt` datetime NOT NULL,
  `updated_dt` datetime DEFAULT NULL,
  `avatar` varchar(500) DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `email_UNIQUE` (`email`)
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `user`
--

LOCK TABLES `user` WRITE;
/*!40000 ALTER TABLE `user` DISABLE KEYS */;
INSERT INTO `user` VALUES (1,'gu',NULL,'','em','2017-11-11 11:11:11',NULL,NULL),(2,'Vuedium','guy','1234','email@email.com','2017-12-09 10:10:10',NULL,NULL);
/*!40000 ALTER TABLE `user` ENABLE KEYS */;
UNLOCK TABLES;
/*!40103 SET TIME_ZONE=@OLD_TIME_ZONE */;

/*!40101 SET SQL_MODE=@OLD_SQL_MODE */;
/*!40014 SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS */;
/*!40014 SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
/*!40111 SET SQL_NOTES=@OLD_SQL_NOTES */;

-- Dump completed on 2017-12-11 16:23:41
