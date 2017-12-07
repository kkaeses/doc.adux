
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
DROP TABLE IF EXISTS `wp_revisr`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `wp_revisr` (
  `id` mediumint(9) NOT NULL AUTO_INCREMENT,
  `time` datetime NOT NULL DEFAULT '0000-00-00 00:00:00',
  `message` text,
  `event` varchar(42) NOT NULL,
  `user` varchar(60) DEFAULT NULL,
  UNIQUE KEY `id` (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=146 DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

LOCK TABLES `wp_revisr` WRITE;
/*!40000 ALTER TABLE `wp_revisr` DISABLE KEYS */;
INSERT INTO `wp_revisr` VALUES (1,'2017-04-13 09:11:51','Successfully created a new repository.','init','kkaeses'),(2,'2017-04-13 09:22:35','Error pushing changes to the remote repository.','error','kkaeses'),(3,'2017-04-13 09:23:28','Successfully backed up the database.','backup','kkaeses'),(4,'2017-04-13 09:27:38','Error pushing changes to the remote repository.','error','kkaeses'),(5,'2017-04-13 09:33:04','Successfully pushed 2 commits to origin/master.','push','kkaeses'),(6,'2017-04-13 09:44:19','Committed <a href=\"http://doc.adux.be/wp-admin/admin.php?page=revisr_view_commit&commit=a24ebda&success=true\">#a24ebda</a> to the local repository.','commit','kkaeses'),(7,'2017-04-13 09:44:22','Successfully pushed 1 commit to origin/master.','push','kkaeses'),(8,'2017-04-13 09:45:57','Successfully pushed 1 commit to origin/master.','push','kkaeses'),(9,'2017-04-21 09:06:29','Successfully backed up the database.','backup','Revisr Bot'),(10,'2017-04-21 09:06:36','Successfully pushed 2 commits to origin/master.','push','Revisr Bot'),(11,'2017-04-21 09:06:36','The weekly backup was successful.','backup','Revisr Bot'),(12,'2017-04-25 11:38:14','Committed <a href=\"http://doc.adux.be/wp-admin/admin.php?page=revisr_view_commit&commit=be73370&success=true\">#be73370</a> to the local repository.','commit','kkaeses'),(13,'2017-04-25 11:38:18','Successfully pushed 1 commit to origin/master.','push','kkaeses'),(14,'2017-04-27 09:24:19','Successfully backed up the database.','backup','Revisr Bot'),(15,'2017-04-27 09:24:26','Successfully pushed 2 commits to origin/master.','push','Revisr Bot'),(16,'2017-04-27 09:24:26','The weekly backup was successful.','backup','Revisr Bot'),(17,'2017-05-02 10:25:28','Committed <a href=\"http://doc.adux.be/wp-admin/admin.php?page=revisr_view_commit&commit=27c0d53&success=true\">#27c0d53</a> to the local repository.','commit','kkaeses'),(18,'2017-05-02 10:25:50','Successfully pushed 1 commit to origin/master.','push','kkaeses'),(19,'2017-05-03 14:09:34','Committed <a href=\"http://doc.adux.be/wp-admin/admin.php?page=revisr_view_commit&commit=2f21775&success=true\">#2f21775</a> to the local repository.','commit','kkaeses'),(20,'2017-05-03 14:09:53','Successfully pushed 1 commit to origin/master.','push','kkaeses'),(21,'2017-05-04 09:33:58','Error staging files.','error','Revisr Bot'),(22,'2017-05-04 09:34:06','Successfully backed up the database.','backup','Revisr Bot'),(23,'2017-05-04 09:34:13','Successfully pushed 2 commits to origin/master.','push','Revisr Bot'),(24,'2017-05-04 09:34:13','The weekly backup was successful.','backup','Revisr Bot'),(25,'2017-05-11 09:25:51','Error staging files.','error','Revisr Bot'),(26,'2017-05-11 09:26:03','Successfully backed up the database.','backup','Revisr Bot'),(27,'2017-05-11 09:26:22','Successfully pushed 2 commits to origin/master.','push','Revisr Bot'),(28,'2017-05-11 09:26:22','The weekly backup was successful.','backup','Revisr Bot'),(29,'2017-05-18 09:23:16','Error staging files.','error','Revisr Bot'),(30,'2017-05-18 09:23:23','Successfully backed up the database.','backup','Revisr Bot'),(31,'2017-05-18 09:23:30','Successfully pushed 2 commits to origin/master.','push','Revisr Bot'),(32,'2017-05-18 09:23:30','The weekly backup was successful.','backup','Revisr Bot'),(33,'2017-05-25 09:25:52','Error staging files.','error','Revisr Bot'),(34,'2017-05-25 09:25:58','Successfully backed up the database.','backup','Revisr Bot'),(35,'2017-05-25 09:26:09','Successfully pushed 2 commits to origin/master.','push','Revisr Bot'),(36,'2017-05-25 09:26:09','The weekly backup was successful.','backup','Revisr Bot'),(37,'2017-06-01 09:23:44','Error staging files.','error','Revisr Bot'),(38,'2017-06-01 09:23:51','Successfully backed up the database.','backup','Revisr Bot'),(39,'2017-06-01 09:23:56','Successfully pushed 2 commits to origin/master.','push','Revisr Bot'),(40,'2017-06-01 09:23:56','The weekly backup was successful.','backup','Revisr Bot'),(41,'2017-06-08 09:26:51','Error staging files.','error','Revisr Bot'),(42,'2017-06-08 09:26:58','Successfully backed up the database.','backup','Revisr Bot'),(43,'2017-06-08 09:27:05','Successfully pushed 1 commit to origin/master.','push','Revisr Bot'),(44,'2017-06-08 09:27:05','The weekly backup was successful.','backup','Revisr Bot'),(45,'2017-06-15 09:26:21','Error staging files.','error','Revisr Bot'),(46,'2017-06-15 09:26:27','Successfully backed up the database.','backup','Revisr Bot'),(47,'2017-06-15 09:26:41','Successfully pushed 2 commits to origin/master.','push','Revisr Bot'),(48,'2017-06-15 09:26:41','The weekly backup was successful.','backup','Revisr Bot'),(49,'2017-06-22 09:24:07','Error staging files.','error','Revisr Bot'),(50,'2017-06-22 09:24:15','Successfully backed up the database.','backup','Revisr Bot'),(51,'2017-06-22 09:24:26','Successfully pushed 2 commits to origin/master.','push','Revisr Bot'),(52,'2017-06-22 09:24:26','The weekly backup was successful.','backup','Revisr Bot'),(53,'2017-06-29 09:24:26','Error staging files.','error','Revisr Bot'),(54,'2017-06-29 09:24:35','Successfully backed up the database.','backup','Revisr Bot'),(55,'2017-06-29 09:24:45','Successfully pushed 2 commits to origin/master.','push','Revisr Bot'),(56,'2017-06-29 09:24:45','The weekly backup was successful.','backup','Revisr Bot'),(57,'2017-07-06 09:26:35','Error staging files.','error','Revisr Bot'),(58,'2017-07-06 09:26:44','Successfully backed up the database.','backup','Revisr Bot'),(59,'2017-07-06 09:26:54','Successfully pushed 2 commits to origin/master.','push','Revisr Bot'),(60,'2017-07-06 09:26:54','The weekly backup was successful.','backup','Revisr Bot'),(61,'2017-07-13 09:27:33','Error staging files.','error','Revisr Bot'),(62,'2017-07-13 09:27:40','Successfully backed up the database.','backup','Revisr Bot'),(63,'2017-07-13 09:27:49','Successfully pushed 2 commits to origin/master.','push','Revisr Bot'),(64,'2017-07-13 09:27:49','The weekly backup was successful.','backup','Revisr Bot'),(65,'2017-07-20 09:25:49','Error staging files.','error','Revisr Bot'),(66,'2017-07-20 09:26:03','Successfully backed up the database.','backup','Revisr Bot'),(67,'2017-07-20 09:26:15','Successfully pushed 2 commits to origin/master.','push','Revisr Bot'),(68,'2017-07-20 09:26:15','The weekly backup was successful.','backup','Revisr Bot'),(69,'2017-07-27 09:25:03','Error staging files.','error','Revisr Bot'),(70,'2017-07-27 09:25:13','Successfully backed up the database.','backup','Revisr Bot'),(71,'2017-07-27 09:25:24','Successfully pushed 2 commits to origin/master.','push','Revisr Bot'),(72,'2017-07-27 09:25:24','The weekly backup was successful.','backup','Revisr Bot'),(73,'2017-08-03 09:22:56','Error staging files.','error','Revisr Bot'),(74,'2017-08-03 09:23:04','Successfully backed up the database.','backup','Revisr Bot'),(75,'2017-08-03 09:23:11','Successfully pushed 1 commit to origin/master.','push','Revisr Bot'),(76,'2017-08-03 09:23:11','The weekly backup was successful.','backup','Revisr Bot'),(77,'2017-08-10 09:27:41','Error staging files.','error','Revisr Bot'),(78,'2017-08-10 09:27:48','Successfully backed up the database.','backup','Revisr Bot'),(79,'2017-08-10 09:28:00','Successfully pushed 2 commits to origin/master.','push','Revisr Bot'),(80,'2017-08-10 09:28:00','The weekly backup was successful.','backup','Revisr Bot'),(81,'2017-08-17 09:27:50','Error staging files.','error','Revisr Bot'),(82,'2017-08-17 09:27:59','Successfully backed up the database.','backup','Revisr Bot'),(83,'2017-08-17 09:28:07','Successfully pushed 2 commits to origin/master.','push','Revisr Bot'),(84,'2017-08-17 09:28:07','The weekly backup was successful.','backup','Revisr Bot'),(85,'2017-08-24 09:27:08','Error staging files.','error','Revisr Bot'),(86,'2017-08-24 09:27:16','Successfully backed up the database.','backup','Revisr Bot'),(87,'2017-08-24 09:27:21','Successfully pushed 1 commit to origin/master.','push','Revisr Bot'),(88,'2017-08-24 09:27:21','The weekly backup was successful.','backup','Revisr Bot'),(89,'2017-08-31 09:28:26','Error staging files.','error','Revisr Bot'),(90,'2017-08-31 09:28:35','Successfully backed up the database.','backup','Revisr Bot'),(91,'2017-08-31 09:28:43','Successfully pushed 2 commits to origin/master.','push','Revisr Bot'),(92,'2017-08-31 09:28:43','The weekly backup was successful.','backup','Revisr Bot'),(93,'2017-09-07 09:23:47','Error staging files.','error','Revisr Bot'),(94,'2017-09-07 09:23:53','Successfully backed up the database.','backup','Revisr Bot'),(95,'2017-09-07 09:24:00','Successfully pushed 1 commit to origin/master.','push','Revisr Bot'),(96,'2017-09-07 09:24:00','The weekly backup was successful.','backup','Revisr Bot'),(97,'2017-09-14 09:23:51','Error staging files.','error','Revisr Bot'),(98,'2017-09-14 09:23:58','Successfully backed up the database.','backup','Revisr Bot'),(99,'2017-09-14 09:24:06','Successfully pushed 2 commits to origin/master.','push','Revisr Bot'),(100,'2017-09-14 09:24:06','The weekly backup was successful.','backup','Revisr Bot'),(101,'2017-09-21 09:25:26','Error staging files.','error','Revisr Bot'),(102,'2017-09-21 09:25:36','Successfully backed up the database.','backup','Revisr Bot'),(103,'2017-09-21 09:25:44','Successfully pushed 2 commits to origin/master.','push','Revisr Bot'),(104,'2017-09-21 09:25:44','The weekly backup was successful.','backup','Revisr Bot'),(105,'2017-09-28 09:27:16','Error staging files.','error','Revisr Bot'),(106,'2017-09-28 09:27:24','Successfully backed up the database.','backup','Revisr Bot'),(107,'2017-09-28 09:27:33','Successfully pushed 1 commit to origin/master.','push','Revisr Bot'),(108,'2017-09-28 09:27:34','The weekly backup was successful.','backup','Revisr Bot'),(109,'2017-10-05 09:24:58','Error staging files.','error','Revisr Bot'),(110,'2017-10-05 09:25:05','Successfully backed up the database.','backup','Revisr Bot'),(111,'2017-10-05 09:25:13','Successfully pushed 2 commits to origin/master.','push','Revisr Bot'),(112,'2017-10-05 09:25:13','The weekly backup was successful.','backup','Revisr Bot'),(113,'2017-10-12 09:26:06','Error staging files.','error','Revisr Bot'),(114,'2017-10-12 09:26:14','Successfully backed up the database.','backup','Revisr Bot'),(115,'2017-10-12 09:26:19','Successfully pushed 1 commit to origin/master.','push','Revisr Bot'),(116,'2017-10-12 09:26:19','The weekly backup was successful.','backup','Revisr Bot'),(117,'2017-10-19 09:23:55','Error staging files.','error','Revisr Bot'),(118,'2017-10-19 09:24:07','Successfully backed up the database.','backup','Revisr Bot'),(119,'2017-10-19 09:24:16','Successfully pushed 2 commits to origin/master.','push','Revisr Bot'),(120,'2017-10-19 09:24:16','The weekly backup was successful.','backup','Revisr Bot'),(121,'2017-10-26 09:27:08','Error staging files.','error','Revisr Bot'),(122,'2017-10-26 09:27:21','Successfully backed up the database.','backup','Revisr Bot'),(123,'2017-10-26 09:27:31','Successfully pushed 2 commits to origin/master.','push','Revisr Bot'),(124,'2017-10-26 09:27:31','The weekly backup was successful.','backup','Revisr Bot'),(125,'2017-11-02 08:23:05','Error staging files.','error','Revisr Bot'),(126,'2017-11-02 08:23:16','Successfully backed up the database.','backup','Revisr Bot'),(127,'2017-11-02 08:23:24','Successfully pushed 2 commits to origin/master.','push','Revisr Bot'),(128,'2017-11-02 08:23:24','The weekly backup was successful.','backup','Revisr Bot'),(129,'2017-11-09 08:23:34','Error staging files.','error','Revisr Bot'),(130,'2017-11-09 08:23:43','Successfully backed up the database.','backup','Revisr Bot'),(131,'2017-11-09 08:23:51','Successfully pushed 2 commits to origin/master.','push','Revisr Bot'),(132,'2017-11-09 08:23:51','The weekly backup was successful.','backup','Revisr Bot'),(133,'2017-11-16 08:23:44','Error staging files.','error','Revisr Bot'),(134,'2017-11-16 08:23:57','Successfully backed up the database.','backup','Revisr Bot'),(135,'2017-11-16 08:24:07','Successfully pushed 2 commits to origin/master.','push','Revisr Bot'),(136,'2017-11-16 08:24:07','The weekly backup was successful.','backup','Revisr Bot'),(137,'2017-11-23 08:24:52','Error staging files.','error','Revisr Bot'),(138,'2017-11-23 08:24:59','Successfully backed up the database.','backup','Revisr Bot'),(139,'2017-11-23 08:25:05','Successfully pushed 1 commit to origin/master.','push','Revisr Bot'),(140,'2017-11-23 08:25:05','The weekly backup was successful.','backup','Revisr Bot'),(141,'2017-11-30 08:25:29','Error staging files.','error','Revisr Bot'),(142,'2017-11-30 08:25:36','Successfully backed up the database.','backup','Revisr Bot'),(143,'2017-11-30 08:25:41','Successfully pushed 1 commit to origin/master.','push','Revisr Bot'),(144,'2017-11-30 08:25:41','The weekly backup was successful.','backup','Revisr Bot'),(145,'2017-12-07 08:23:13','Error staging files.','error','Revisr Bot');
/*!40000 ALTER TABLE `wp_revisr` ENABLE KEYS */;
UNLOCK TABLES;
/*!40103 SET TIME_ZONE=@OLD_TIME_ZONE */;

/*!40101 SET SQL_MODE=@OLD_SQL_MODE */;
/*!40014 SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS */;
/*!40014 SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
/*!40111 SET SQL_NOTES=@OLD_SQL_NOTES */;

