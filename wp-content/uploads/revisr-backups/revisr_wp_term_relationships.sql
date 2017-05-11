
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
DROP TABLE IF EXISTS `wp_term_relationships`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `wp_term_relationships` (
  `object_id` bigint(20) unsigned NOT NULL DEFAULT '0',
  `term_taxonomy_id` bigint(20) unsigned NOT NULL DEFAULT '0',
  `term_order` int(11) NOT NULL DEFAULT '0',
  PRIMARY KEY (`object_id`,`term_taxonomy_id`),
  KEY `term_taxonomy_id` (`term_taxonomy_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_520_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

LOCK TABLES `wp_term_relationships` WRITE;
/*!40000 ALTER TABLE `wp_term_relationships` DISABLE KEYS */;
INSERT INTO `wp_term_relationships` VALUES (101,5,0),(103,5,0),(105,5,0),(149,4,0),(149,8,0),(164,4,0),(166,4,0),(168,4,0),(170,4,0),(172,4,0),(193,2,0),(210,2,0),(211,2,0),(212,2,0),(213,2,0),(214,2,0),(282,4,0),(284,1,0),(286,4,0),(288,4,0),(290,4,0),(292,4,0),(296,4,0),(300,4,0),(302,4,0),(304,4,0),(307,4,0),(309,4,0),(311,4,0),(313,4,0),(317,4,0),(319,4,0),(323,4,0),(327,4,0),(329,4,0),(333,4,0),(337,4,0),(339,4,0),(342,4,0),(347,4,0),(807,3,0),(808,3,0),(810,3,0),(812,3,0),(813,3,0),(815,3,0),(817,3,0),(819,3,0),(821,3,0),(823,3,0),(825,3,0),(827,3,0),(829,3,0),(831,3,0),(833,3,0),(835,3,0),(911,4,0),(913,4,0),(915,4,0),(917,4,0),(919,4,0),(921,4,0),(923,4,0),(925,4,0),(927,4,0),(929,4,0),(931,4,0),(933,4,0),(935,4,0),(937,4,0),(939,4,0),(941,4,0),(1309,31,0),(1310,31,0),(1311,31,0),(1312,31,0),(1313,31,0),(1314,31,0),(1315,31,0),(1316,31,0),(1317,31,0),(1322,32,0),(1323,32,0),(1324,32,0),(1325,32,0),(1326,32,0),(1327,32,0),(1328,32,0),(1329,33,0),(1330,33,0),(1331,33,0),(1332,33,0),(1333,33,0),(1334,34,0),(1335,34,0),(1336,34,0),(1337,32,0),(1651,4,0),(1654,4,0),(1656,4,0),(1669,4,0),(1706,5,0),(1709,5,0),(1712,5,0),(1724,5,0),(1726,5,0),(1728,5,0),(1730,5,0);
/*!40000 ALTER TABLE `wp_term_relationships` ENABLE KEYS */;
UNLOCK TABLES;
/*!40103 SET TIME_ZONE=@OLD_TIME_ZONE */;

/*!40101 SET SQL_MODE=@OLD_SQL_MODE */;
/*!40014 SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS */;
/*!40014 SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
/*!40111 SET SQL_NOTES=@OLD_SQL_NOTES */;

