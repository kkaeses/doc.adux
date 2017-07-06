
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
) ENGINE=InnoDB AUTO_INCREMENT=58 DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

LOCK TABLES `wp_revisr` WRITE;
/*!40000 ALTER TABLE `wp_revisr` DISABLE KEYS */;
INSERT INTO `wp_revisr` VALUES (1,'2017-04-13 09:11:51','Successfully created a new repository.','init','kkaeses'),(2,'2017-04-13 09:22:35','Error pushing changes to the remote repository.','error','kkaeses'),(3,'2017-04-13 09:23:28','Successfully backed up the database.','backup','kkaeses'),(4,'2017-04-13 09:27:38','Error pushing changes to the remote repository.','error','kkaeses'),(5,'2017-04-13 09:33:04','Successfully pushed 2 commits to origin/master.','push','kkaeses'),(6,'2017-04-13 09:44:19','Committed <a href=\"http://doc.adux.be/wp-admin/admin.php?page=revisr_view_commit&commit=a24ebda&success=true\">#a24ebda</a> to the local repository.','commit','kkaeses'),(7,'2017-04-13 09:44:22','Successfully pushed 1 commit to origin/master.','push','kkaeses'),(8,'2017-04-13 09:45:57','Successfully pushed 1 commit to origin/master.','push','kkaeses'),(9,'2017-04-21 09:06:29','Successfully backed up the database.','backup','Revisr Bot'),(10,'2017-04-21 09:06:36','Successfully pushed 2 commits to origin/master.','push','Revisr Bot'),(11,'2017-04-21 09:06:36','The weekly backup was successful.','backup','Revisr Bot'),(12,'2017-04-25 11:38:14','Committed <a href=\"http://doc.adux.be/wp-admin/admin.php?page=revisr_view_commit&commit=be73370&success=true\">#be73370</a> to the local repository.','commit','kkaeses'),(13,'2017-04-25 11:38:18','Successfully pushed 1 commit to origin/master.','push','kkaeses'),(14,'2017-04-27 09:24:19','Successfully backed up the database.','backup','Revisr Bot'),(15,'2017-04-27 09:24:26','Successfully pushed 2 commits to origin/master.','push','Revisr Bot'),(16,'2017-04-27 09:24:26','The weekly backup was successful.','backup','Revisr Bot'),(17,'2017-05-02 10:25:28','Committed <a href=\"http://doc.adux.be/wp-admin/admin.php?page=revisr_view_commit&commit=27c0d53&success=true\">#27c0d53</a> to the local repository.','commit','kkaeses'),(18,'2017-05-02 10:25:50','Successfully pushed 1 commit to origin/master.','push','kkaeses'),(19,'2017-05-03 14:09:34','Committed <a href=\"http://doc.adux.be/wp-admin/admin.php?page=revisr_view_commit&commit=2f21775&success=true\">#2f21775</a> to the local repository.','commit','kkaeses'),(20,'2017-05-03 14:09:53','Successfully pushed 1 commit to origin/master.','push','kkaeses'),(21,'2017-05-04 09:33:58','Error staging files.','error','Revisr Bot'),(22,'2017-05-04 09:34:06','Successfully backed up the database.','backup','Revisr Bot'),(23,'2017-05-04 09:34:13','Successfully pushed 2 commits to origin/master.','push','Revisr Bot'),(24,'2017-05-04 09:34:13','The weekly backup was successful.','backup','Revisr Bot'),(25,'2017-05-11 09:25:51','Error staging files.','error','Revisr Bot'),(26,'2017-05-11 09:26:03','Successfully backed up the database.','backup','Revisr Bot'),(27,'2017-05-11 09:26:22','Successfully pushed 2 commits to origin/master.','push','Revisr Bot'),(28,'2017-05-11 09:26:22','The weekly backup was successful.','backup','Revisr Bot'),(29,'2017-05-18 09:23:16','Error staging files.','error','Revisr Bot'),(30,'2017-05-18 09:23:23','Successfully backed up the database.','backup','Revisr Bot'),(31,'2017-05-18 09:23:30','Successfully pushed 2 commits to origin/master.','push','Revisr Bot'),(32,'2017-05-18 09:23:30','The weekly backup was successful.','backup','Revisr Bot'),(33,'2017-05-25 09:25:52','Error staging files.','error','Revisr Bot'),(34,'2017-05-25 09:25:58','Successfully backed up the database.','backup','Revisr Bot'),(35,'2017-05-25 09:26:09','Successfully pushed 2 commits to origin/master.','push','Revisr Bot'),(36,'2017-05-25 09:26:09','The weekly backup was successful.','backup','Revisr Bot'),(37,'2017-06-01 09:23:44','Error staging files.','error','Revisr Bot'),(38,'2017-06-01 09:23:51','Successfully backed up the database.','backup','Revisr Bot'),(39,'2017-06-01 09:23:56','Successfully pushed 2 commits to origin/master.','push','Revisr Bot'),(40,'2017-06-01 09:23:56','The weekly backup was successful.','backup','Revisr Bot'),(41,'2017-06-08 09:26:51','Error staging files.','error','Revisr Bot'),(42,'2017-06-08 09:26:58','Successfully backed up the database.','backup','Revisr Bot'),(43,'2017-06-08 09:27:05','Successfully pushed 1 commit to origin/master.','push','Revisr Bot'),(44,'2017-06-08 09:27:05','The weekly backup was successful.','backup','Revisr Bot'),(45,'2017-06-15 09:26:21','Error staging files.','error','Revisr Bot'),(46,'2017-06-15 09:26:27','Successfully backed up the database.','backup','Revisr Bot'),(47,'2017-06-15 09:26:41','Successfully pushed 2 commits to origin/master.','push','Revisr Bot'),(48,'2017-06-15 09:26:41','The weekly backup was successful.','backup','Revisr Bot'),(49,'2017-06-22 09:24:07','Error staging files.','error','Revisr Bot'),(50,'2017-06-22 09:24:15','Successfully backed up the database.','backup','Revisr Bot'),(51,'2017-06-22 09:24:26','Successfully pushed 2 commits to origin/master.','push','Revisr Bot'),(52,'2017-06-22 09:24:26','The weekly backup was successful.','backup','Revisr Bot'),(53,'2017-06-29 09:24:26','Error staging files.','error','Revisr Bot'),(54,'2017-06-29 09:24:35','Successfully backed up the database.','backup','Revisr Bot'),(55,'2017-06-29 09:24:45','Successfully pushed 2 commits to origin/master.','push','Revisr Bot'),(56,'2017-06-29 09:24:45','The weekly backup was successful.','backup','Revisr Bot'),(57,'2017-07-06 09:26:35','Error staging files.','error','Revisr Bot');
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

