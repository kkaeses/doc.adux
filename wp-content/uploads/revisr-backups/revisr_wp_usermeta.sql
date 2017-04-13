
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
) ENGINE=InnoDB AUTO_INCREMENT=39 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_520_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

LOCK TABLES `wp_usermeta` WRITE;
/*!40000 ALTER TABLE `wp_usermeta` DISABLE KEYS */;
INSERT INTO `wp_usermeta` VALUES (1,1,'nickname','kkaeses'),(2,1,'first_name',''),(3,1,'last_name',''),(4,1,'description',''),(5,1,'rich_editing','true'),(6,1,'comment_shortcuts','false'),(7,1,'admin_color','fresh'),(8,1,'use_ssl','0'),(9,1,'show_admin_bar_front','true'),(10,1,'locale',''),(11,1,'wp_capabilities','a:1:{s:13:\"administrator\";b:1;}'),(12,1,'wp_user_level','10'),(13,1,'dismissed_wp_pointers','vc_pointers_frontend_editor,vc_pointers_backend_editor,vc_grid_item'),(14,1,'show_welcome_panel','1'),(15,1,'session_tokens','a:3:{s:64:\"d8091abcd48b75cd6d07f5786a56197068ecfbc8d5dbda2832d69a8df597691c\";a:4:{s:10:\"expiration\";i:1492069717;s:2:\"ip\";s:3:\"::1\";s:2:\"ua\";s:121:\"Mozilla/5.0 (Macintosh; Intel Mac OS X 10_12_3) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/57.0.2987.133 Safari/537.36\";s:5:\"login\";i:1491896917;}s:64:\"bcfe58925a3607967cb34d70f45bf8ca0eae3ff3e5d1f291521b01168b7684b8\";a:4:{s:10:\"expiration\";i:1492154797;s:2:\"ip\";s:3:\"::1\";s:2:\"ua\";s:121:\"Mozilla/5.0 (Macintosh; Intel Mac OS X 10_12_3) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/57.0.2987.133 Safari/537.36\";s:5:\"login\";i:1491981997;}s:64:\"163428445573b9b6bbc1ecab7017394fffcaed5e28cbf1b7c1c2c4e4cb7855f9\";a:4:{s:10:\"expiration\";i:1493213980;s:2:\"ip\";s:14:\"217.64.241.138\";s:2:\"ua\";s:121:\"Mozilla/5.0 (Macintosh; Intel Mac OS X 10_12_3) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/57.0.2987.133 Safari/537.36\";s:5:\"login\";i:1492004380;}}'),(16,1,'wp_dashboard_quick_press_last_post_id','895'),(17,1,'wp_user-settings','libraryContent=browse&template_window_vcUIPanelWidth=1152&template_window_vcUIPanelLeft=144px&template_window_vcUIPanelTop=34px&editor=tinymce&edit_element_vcUIPanelWidth=720&edit_element_vcUIPanelLeft=267px&edit_element_vcUIPanelTop=193px'),(18,1,'wp_user-settings-time','1491915824'),(19,1,'managenav-menuscolumnshidden','a:2:{i:0;s:3:\"xfn\";i:1;s:11:\"description\";}'),(20,1,'metaboxhidden_nav-menus','a:1:{i:0;s:12:\"add-post_tag\";}'),(21,1,'nav_menu_recently_edited','2'),(22,1,'closedpostboxes_team_member','a:3:{i:0;s:10:\"postcustom\";i:1;s:21:\"mymetabox_revslider_0\";i:2;s:14:\"twitter-custom\";}'),(23,1,'metaboxhidden_team_member','a:1:{i:0;s:7:\"slugdiv\";}'),(24,1,'closedpostboxes_team','a:0:{}'),(25,1,'metaboxhidden_team','a:4:{i:0;s:19:\"wpb_visual_composer\";i:1;s:7:\"slugdiv\";i:2;s:21:\"mymetabox_revslider_0\";i:3;s:14:\"twitter-custom\";}'),(26,1,'closedpostboxes_post','a:2:{i:0;s:21:\"mymetabox_revslider_0\";i:1;s:14:\"twitter-custom\";}'),(27,1,'metaboxhidden_post','a:8:{i:0;s:19:\"new-meta-post-boxes\";i:1;s:11:\"postexcerpt\";i:2;s:13:\"trackbacksdiv\";i:3;s:16:\"commentstatusdiv\";i:4;s:7:\"slugdiv\";i:5;s:9:\"authordiv\";i:6;s:21:\"mymetabox_revslider_0\";i:7;s:14:\"twitter-custom\";}'),(28,1,'closedpostboxes_dashboard','a:1:{i:0;s:17:\"dashboard_primary\";}'),(29,1,'metaboxhidden_dashboard','a:0:{}'),(30,1,'tgmpa_dismissed_notice_tgmpa','1'),(32,1,'meta-box-order_vc_grid_item','a:3:{s:4:\"side\";s:9:\"submitdiv\";s:6:\"normal\";s:49:\"wpb_visual_composer,slugdiv,mymetabox_revslider_0\";s:8:\"advanced\";s:0:\"\";}'),(33,1,'screen_layout_vc_grid_item','2'),(34,1,'closedpostboxes_page','a:1:{i:0;s:14:\"twitter-custom\";}'),(35,1,'metaboxhidden_page','a:6:{i:0;s:12:\"revisionsdiv\";i:1;s:10:\"postcustom\";i:2;s:16:\"commentstatusdiv\";i:3;s:11:\"commentsdiv\";i:4;s:7:\"slugdiv\";i:5;s:9:\"authordiv\";}'),(36,1,'closedpostboxes_clever_menu_theme','a:1:{i:0;s:21:\"mymetabox_revslider_0\";}'),(37,1,'metaboxhidden_clever_menu_theme','a:0:{}'),(38,1,'wp_media_library_mode','grid');
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

