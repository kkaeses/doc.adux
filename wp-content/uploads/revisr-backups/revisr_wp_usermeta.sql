
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
DROP TABLE IF EXISTS `wp_usermeta`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `wp_usermeta` (
  `umeta_id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `user_id` bigint(20) unsigned NOT NULL DEFAULT '0',
  `meta_key` varchar(255) COLLATE utf8mb4_unicode_520_ci DEFAULT NULL,
  `meta_value` longtext COLLATE utf8mb4_unicode_520_ci,
  PRIMARY KEY (`umeta_id`),
  KEY `user_id` (`user_id`),
  KEY `meta_key` (`meta_key`(191))
) ENGINE=InnoDB AUTO_INCREMENT=128 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_520_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

LOCK TABLES `wp_usermeta` WRITE;
/*!40000 ALTER TABLE `wp_usermeta` DISABLE KEYS */;
INSERT INTO `wp_usermeta` VALUES (1,1,'nickname','kkaeses'),(2,1,'first_name','Killian'),(3,1,'last_name','Kaeses'),(4,1,'description',''),(5,1,'rich_editing','true'),(6,1,'comment_shortcuts','false'),(7,1,'admin_color','fresh'),(8,1,'use_ssl','0'),(9,1,'show_admin_bar_front','true'),(10,1,'locale',''),(11,1,'wp_capabilities','a:1:{s:13:\"administrator\";b:1;}'),(12,1,'wp_user_level','10'),(13,1,'dismissed_wp_pointers','vc_pointers_frontend_editor,vc_pointers_backend_editor,vc_grid_item,tp09_edit_drag_drop_sort'),(14,1,'show_welcome_panel','0'),(16,1,'wp_dashboard_quick_press_last_post_id','1893'),(17,1,'wp_user-settings','libraryContent=upload&template_window_vcUIPanelWidth=1152&template_window_vcUIPanelLeft=144px&template_window_vcUIPanelTop=34px&editor=tinymce&edit_element_vcUIPanelWidth=1351&edit_element_vcUIPanelLeft=54px&edit_element_vcUIPanelTop=105px&advImgDetails=show'),(18,1,'wp_user-settings-time','1495112040'),(19,1,'managenav-menuscolumnshidden','a:2:{i:0;s:3:\"xfn\";i:1;s:11:\"description\";}'),(20,1,'metaboxhidden_nav-menus','a:1:{i:0;s:12:\"add-post_tag\";}'),(21,1,'nav_menu_recently_edited','2'),(22,1,'closedpostboxes_team_member','a:3:{i:0;s:10:\"postcustom\";i:1;s:21:\"mymetabox_revslider_0\";i:2;s:14:\"twitter-custom\";}'),(23,1,'metaboxhidden_team_member','a:1:{i:0;s:7:\"slugdiv\";}'),(24,1,'closedpostboxes_team','a:0:{}'),(25,1,'metaboxhidden_team','a:4:{i:0;s:19:\"wpb_visual_composer\";i:1;s:7:\"slugdiv\";i:2;s:21:\"mymetabox_revslider_0\";i:3;s:14:\"twitter-custom\";}'),(26,1,'closedpostboxes_post','a:2:{i:0;s:21:\"mymetabox_revslider_0\";i:1;s:14:\"twitter-custom\";}'),(27,1,'metaboxhidden_post','a:8:{i:0;s:19:\"new-meta-post-boxes\";i:1;s:11:\"postexcerpt\";i:2;s:13:\"trackbacksdiv\";i:3;s:16:\"commentstatusdiv\";i:4;s:7:\"slugdiv\";i:5;s:9:\"authordiv\";i:6;s:21:\"mymetabox_revslider_0\";i:7;s:14:\"twitter-custom\";}'),(28,1,'closedpostboxes_dashboard','a:0:{}'),(29,1,'metaboxhidden_dashboard','a:1:{i:0;s:21:\"dashboard_quick_press\";}'),(30,1,'tgmpa_dismissed_notice_tgmpa','1'),(32,1,'meta-box-order_vc_grid_item','a:3:{s:4:\"side\";s:9:\"submitdiv\";s:6:\"normal\";s:49:\"wpb_visual_composer,slugdiv,mymetabox_revslider_0\";s:8:\"advanced\";s:0:\"\";}'),(33,1,'screen_layout_vc_grid_item','2'),(34,1,'closedpostboxes_page','a:1:{i:0;s:14:\"twitter-custom\";}'),(35,1,'metaboxhidden_page','a:6:{i:0;s:12:\"revisionsdiv\";i:1;s:10:\"postcustom\";i:2;s:16:\"commentstatusdiv\";i:3;s:11:\"commentsdiv\";i:4;s:7:\"slugdiv\";i:5;s:9:\"authordiv\";}'),(36,1,'closedpostboxes_clever_menu_theme','a:1:{i:0;s:21:\"mymetabox_revslider_0\";}'),(37,1,'metaboxhidden_clever_menu_theme','a:0:{}'),(38,1,'wp_media_library_mode','grid'),(39,2,'nickname','gdecant'),(40,2,'first_name','Geoffrey'),(41,2,'last_name','Decant'),(42,2,'description',''),(43,2,'rich_editing','true'),(44,2,'comment_shortcuts','false'),(45,2,'admin_color','fresh'),(46,2,'use_ssl','0'),(47,2,'show_admin_bar_front','true'),(48,2,'locale',''),(49,2,'wp_capabilities','a:1:{s:13:\"administrator\";b:1;}'),(50,2,'wp_user_level','10'),(51,2,'dismissed_wp_pointers',''),(52,1,'twitter',''),(53,1,'periscope',''),(54,2,'default_password_nag',''),(55,2,'session_tokens','a:1:{s:64:\"5aba8f239f095731290b4727a62d3776fd775f022f0b4e5e8de70551aae2a1b3\";a:4:{s:10:\"expiration\";i:1509028865;s:2:\"ip\";s:14:\"217.64.241.138\";s:2:\"ua\";s:115:\"Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/61.0.3163.100 Safari/537.36\";s:5:\"login\";i:1508856065;}}'),(56,2,'wp_dashboard_quick_press_last_post_id','2100'),(57,1,'closedpostboxes_wpcuwpfp-news-widget','a:0:{}'),(58,1,'metaboxhidden_wpcuwpfp-news-widget','a:0:{}'),(59,3,'nickname','avandendriessche'),(60,3,'first_name','Adrien'),(61,3,'last_name','Van den Driessche'),(62,3,'description',''),(63,3,'rich_editing','true'),(64,3,'comment_shortcuts','false'),(65,3,'admin_color','fresh'),(66,3,'use_ssl','0'),(67,3,'show_admin_bar_front','true'),(68,3,'locale',''),(69,3,'wp_capabilities','a:1:{s:13:\"administrator\";b:1;}'),(70,3,'wp_user_level','10'),(71,3,'dismissed_wp_pointers',''),(72,3,'default_password_nag',''),(73,3,'session_tokens','a:2:{s:64:\"9c7d257167c216da26c65c26e9695b07f5bf0cd1d1f7f9b668a7c08d9cb0c636\";a:4:{s:10:\"expiration\";i:1493968725;s:2:\"ip\";s:14:\"217.64.241.138\";s:2:\"ua\";s:113:\"Mozilla/5.0 (Windows NT 6.1; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/58.0.3029.81 Safari/537.36\";s:5:\"login\";i:1492759125;}s:64:\"5c6eea5ac947ca7b6d12044bc35948cec28bfbd7144c99504c2b4cb4d2190d73\";a:4:{s:10:\"expiration\";i:1493282183;s:2:\"ip\";s:14:\"217.64.241.138\";s:2:\"ua\";s:113:\"Mozilla/5.0 (Windows NT 6.1; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/58.0.3029.81 Safari/537.36\";s:5:\"login\";i:1493109383;}}'),(74,3,'twitter',''),(75,3,'periscope',''),(76,3,'wp_dashboard_quick_press_last_post_id','1402'),(77,3,'closedpostboxes_post','a:0:{}'),(78,3,'metaboxhidden_post','a:7:{i:0;s:12:\"revisionsdiv\";i:1;s:11:\"postexcerpt\";i:2;s:13:\"trackbacksdiv\";i:3;s:16:\"commentstatusdiv\";i:4;s:11:\"commentsdiv\";i:5;s:7:\"slugdiv\";i:6;s:9:\"authordiv\";}'),(79,1,'session_tokens','a:1:{s:64:\"edfc18993d8d0e520d4fd162e8866848ac088411c4afc10f693b581268cb5852\";a:4:{s:10:\"expiration\";i:1497973361;s:2:\"ip\";s:38:\"2a02:a03f:3e25:700:d014:558c:7b71:2e14\";s:2:\"ua\";s:121:\"Mozilla/5.0 (Macintosh; Intel Mac OS X 10_12_4) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/58.0.3029.110 Safari/537.36\";s:5:\"login\";i:1497800561;}}'),(80,1,'wp_tablepress_user_options','{\"user_options_db_version\":34,\"admin_menu_parent_page\":\"middle\",\"message_first_visit\":false}'),(81,1,'managetablepress_listcolumnshidden','a:1:{i:0;s:22:\"table_last_modified_by\";}'),(82,1,'meta-box-order_dashboard','a:4:{s:6:\"normal\";s:19:\"dashboard_right_now\";s:4:\"side\";s:58:\"dashboard_quick_press,dashboard_activity,dashboard_primary\";s:7:\"column3\";s:0:\"\";s:7:\"column4\";s:0:\"\";}'),(83,4,'nickname','lbakkaus'),(84,4,'first_name','Lesly'),(85,4,'last_name','Bakkaus'),(86,4,'description',''),(87,4,'rich_editing','true'),(88,4,'comment_shortcuts','false'),(89,4,'admin_color','fresh'),(90,4,'use_ssl','0'),(91,4,'show_admin_bar_front','true'),(92,4,'locale',''),(93,4,'wp_capabilities','a:1:{s:13:\"administrator\";b:1;}'),(94,4,'wp_user_level','10'),(95,4,'dismissed_wp_pointers','vc_pointers_backend_editor,tp09_edit_drag_drop_sort'),(96,4,'default_password_nag',''),(98,4,'wp_dashboard_quick_press_last_post_id','2085'),(100,2,'wp_user-settings','edit_element_vcUIPanelWidth=1313&edit_element_vcUIPanelLeft=203px&edit_element_vcUIPanelTop=0px&editor=tinymce'),(101,2,'wp_user-settings-time','1495613881'),(102,4,'wp_user-settings','edit_element_vcUIPanelWidth=650&edit_element_vcUIPanelLeft=556px&edit_element_vcUIPanelTop=42px&editor=tinymce&libraryContent=browse'),(103,4,'wp_user-settings-time','1500975471'),(104,4,'session_tokens','a:3:{s:64:\"bffc4c1961d803d534710d2a012c94e984196e2f85cefb955453e0590692f291\";a:4:{s:10:\"expiration\";i:1510735723;s:2:\"ip\";s:14:\"217.64.241.138\";s:2:\"ua\";s:115:\"Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/61.0.3163.100 Safari/537.36\";s:5:\"login\";i:1510562923;}s:64:\"7a25c7ead740f1c1c55e3b6a129132160d18dab5558a6b6d3c8369dcf5eda60f\";a:4:{s:10:\"expiration\";i:1510755095;s:2:\"ip\";s:14:\"217.64.241.138\";s:2:\"ua\";s:114:\"Mozilla/5.0 (Windows NT 6.1; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/61.0.3163.100 Safari/537.36\";s:5:\"login\";i:1510582295;}s:64:\"b83a9160dd0ea633554c209c7d346c03f889515b3aff4a395276888797d103c5\";a:4:{s:10:\"expiration\";i:1510755099;s:2:\"ip\";s:14:\"217.64.241.138\";s:2:\"ua\";s:114:\"Mozilla/5.0 (Windows NT 6.1; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/61.0.3163.100 Safari/537.36\";s:5:\"login\";i:1510582299;}}'),(105,5,'nickname','yzouari'),(106,5,'first_name',''),(107,5,'last_name',''),(108,5,'description',''),(109,5,'rich_editing','true'),(110,5,'comment_shortcuts','false'),(111,5,'admin_color','fresh'),(112,5,'use_ssl','0'),(113,5,'show_admin_bar_front','true'),(114,5,'locale',''),(115,5,'wp_capabilities','a:1:{s:13:\"administrator\";b:1;}'),(116,5,'wp_user_level','10'),(117,5,'dismissed_wp_pointers',''),(118,5,'default_password_nag',''),(119,5,'session_tokens','a:1:{s:64:\"4718a867c0e6ca5c9d841d7bab45c8cce53fd0be19ca3618305852dccb051dae\";a:4:{s:10:\"expiration\";i:1499854141;s:2:\"ip\";s:12:\"46.182.41.35\";s:2:\"ua\";s:115:\"Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/59.0.3071.115 Safari/537.36\";s:5:\"login\";i:1499681341;}}'),(120,5,'wp_user-settings','mfold=o&editor=tinymce&libraryContent=browse'),(121,5,'wp_user-settings-time','1498666613'),(122,5,'tgmpa_dismissed_notice_tgmpa','1'),(123,5,'twitter',''),(124,5,'periscope',''),(125,5,'wp_dashboard_quick_press_last_post_id','1936'),(126,4,'wp_media_library_mode','grid'),(127,4,'managetablepress_listcolumnshidden','a:1:{i:0;s:22:\"table_last_modified_by\";}');
/*!40000 ALTER TABLE `wp_usermeta` ENABLE KEYS */;
UNLOCK TABLES;
/*!40103 SET TIME_ZONE=@OLD_TIME_ZONE */;

/*!40101 SET SQL_MODE=@OLD_SQL_MODE */;
/*!40014 SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS */;
/*!40014 SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
/*!40111 SET SQL_NOTES=@OLD_SQL_NOTES */;

