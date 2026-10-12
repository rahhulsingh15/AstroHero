-- MariaDB dump 10.19  Distrib 10.4.32-MariaDB, for Win64 (AMD64)
--
-- Host: localhost    Database: kundli_db
-- ------------------------------------------------------
-- Server version	10.4.32-MariaDB

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
-- Table structure for table `migrations`
--

DROP TABLE IF EXISTS `migrations`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `migrations` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `migration` varchar(255) NOT NULL,
  `batch` int(11) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=36 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `migrations`
--

LOCK TABLES `migrations` WRITE;
/*!40000 ALTER TABLE `migrations` DISABLE KEYS */;
INSERT INTO `migrations` VALUES (1,'0001_01_01_000000_create_users_table',1),(2,'0001_01_01_000001_create_cache_table',1),(3,'0001_01_01_000002_create_jobs_table',1),(4,'2026_09_03_061900_create_hero_sections_table',2),(5,'2026_09_03_090353_create_online_astrologer_sections_table',3),(6,'2026_09_03_103012_create_expert_astrologers_table',4),(7,'2026_09_04_051000_create_goodies_table',5),(8,'2026_09_04_062706_create_ask_expert_questions_table',6),(9,'2026_09_04_064716_create_astrology_predictions_table',7),(10,'2026_09_04_070904_create_free_astrology_services_table',8),(11,'2026_09_04_084007_create_astrologer_consultations_table',9),(12,'2026_09_04_091616_create_festival_calendars_table',10),(13,'2026_09_04_111854_create_shubh_muhurats_table',11),(14,'2026_09_05_043354_create_popular_posts_table',12),(15,'2026_09_05_070528_create_talk_astrologer_helps_table',13),(16,'2026_09_05_090750_create_astrologer_faqs_table',14),(17,'2026_09_07_053447_create_free_kundli_sections_tables',15),(18,'2026_09_07_072654_create_free_kundli_guides_table',16),(19,'2026_09_07_083758_create_free_kundli_faqs_table',17),(20,'2026_09_07_091659_create_kundli_blogs_table',18),(21,'2026_09_07_113553_create_matching_heroes_table',19),(22,'2026_09_07_121920_create_matching_cta_sections_table',20),(23,'2026_09_08_053551_create_matching_guides_table',21),(24,'2026_09_08_064355_create_kundli_matches_table',22),(25,'2026_09_09_054112_create_yearly_horoscopes_table',23),(26,'2026_09_09_082642_create_horoscope_contents_table',24),(27,'2026_09_09_105745_create_best_astrologer_contents_table',25),(28,'2026_09_10_043630_create_chat_with_astrologer_contents_table',26),(29,'2026_09_10_060631_create_contact_banners_table',27),(30,'2026_09_10_070135_create_contact_details_table',28),(31,'2026_09_14_045012_create_kundli_faq_contents_table',29),(32,'2026_09_22_055852_create_device_tokens_table',30),(33,'2026_09_30_063832_create_daily_horoscopes_table',31),(34,'2026_10_03_100000_create_astrologer_categories_and_home_services_tables',32),(35,'2026_10_03_110000_create_astrologer_pages_tables',33);
/*!40000 ALTER TABLE `migrations` ENABLE KEYS */;
UNLOCK TABLES;
/*!40103 SET TIME_ZONE=@OLD_TIME_ZONE */;

/*!40101 SET SQL_MODE=@OLD_SQL_MODE */;
/*!40014 SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS */;
/*!40014 SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
/*!40111 SET SQL_NOTES=@OLD_SQL_NOTES */;

-- Dump completed on 2026-10-05 10:39:48
