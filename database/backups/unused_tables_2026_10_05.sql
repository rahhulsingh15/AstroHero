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
-- Table structure for table `ask_expert_questions`
--

DROP TABLE IF EXISTS `ask_expert_questions`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `ask_expert_questions` (
  `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `user_id` bigint(20) unsigned DEFAULT NULL,
  `name` varchar(255) NOT NULL,
  `email` varchar(255) NOT NULL,
  `question` text NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `ask_expert_questions_user_id_foreign` (`user_id`),
  CONSTRAINT `ask_expert_questions_user_id_foreign` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `ask_expert_questions`
--

LOCK TABLES `ask_expert_questions` WRITE;
/*!40000 ALTER TABLE `ask_expert_questions` DISABLE KEYS */;
INSERT INTO `ask_expert_questions` VALUES (1,1,'Admin','admin@gmail.com','sssssssssssssssssssssssssssssssssssssssssssssssssssssssssssssssssssssssssssssssssssssssssssssssssssssssssssssssssssssssssssssssssssssssssssssssssssssssssssssssssssssssssssssssssssssssssssssssssssssssssssssssssssssssssssssssssssssssssssssssssssssssssssssssssssssssssssssssssssssssssssssssssssssssssssssssssssssssssssssssssssssssssssssssssssssssssssssssssssssssssssssssssssssssssssssssssssssssssss','2026-09-05 06:28:36','2026-09-05 06:28:36');
/*!40000 ALTER TABLE `ask_expert_questions` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `astrologer_consultations`
--

DROP TABLE IF EXISTS `astrologer_consultations`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `astrologer_consultations` (
  `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `title` varchar(255) NOT NULL,
  `image` varchar(255) DEFAULT NULL,
  `image_alt` varchar(255) DEFAULT NULL,
  `link` varchar(255) NOT NULL DEFAULT '#',
  `sort_order` int(11) NOT NULL DEFAULT 0,
  `is_active` tinyint(1) NOT NULL DEFAULT 1,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `astrologer_consultations_title_index` (`title`),
  KEY `astrologer_consultations_sort_order_index` (`sort_order`),
  KEY `astrologer_consultations_is_active_index` (`is_active`)
) ENGINE=InnoDB AUTO_INCREMENT=8 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `astrologer_consultations`
--

LOCK TABLES `astrologer_consultations` WRITE;
/*!40000 ALTER TABLE `astrologer_consultations` DISABLE KEYS */;
INSERT INTO `astrologer_consultations` VALUES (1,'Love & Relationship','uploads/consultations/consult_1788512677_6a9a89a5eb406.png','Reiki Healer','#',1,1,'2026-09-04 03:34:37','2026-09-04 03:34:37'),(2,'Marriage & Kundli','uploads/consultations/consult_1788512733_6a9a89ddd355d.png','Popular Astrologers','#',2,1,'2026-09-04 03:35:33','2026-09-04 03:35:33'),(3,'Career','uploads/consultations/consult_1788512769_6a9a8a019739b.png','Learn Tarot','#',3,1,'2026-09-04 03:36:09','2026-09-04 03:36:09'),(4,'Woman Astrologer','uploads/consultations/consult_1788512800_6a9a8a2051db0.png','Rudra Abhishek Pooja','#',4,1,'2026-09-04 03:36:40','2026-09-04 03:36:52'),(5,'Business','uploads/consultations/consult_1788512864_6a9a8a6031be1.png','Palm Reader','#',5,1,'2026-09-04 03:37:44','2026-09-04 03:37:44'),(6,'Money','uploads/consultations/consult_1788512891_6a9a8a7b4b5df.png','Palm Reader','#',6,1,'2026-09-04 03:38:11','2026-09-04 03:38:11');
/*!40000 ALTER TABLE `astrologer_consultations` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `astrologer_faqs`
--

DROP TABLE IF EXISTS `astrologer_faqs`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `astrologer_faqs` (
  `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `heading` varchar(255) DEFAULT NULL,
  `content` longtext DEFAULT NULL,
  `main_heading` varchar(255) NOT NULL DEFAULT 'How Can Talking to an Astrologer Help You?',
  `is_active` tinyint(1) NOT NULL DEFAULT 1,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `astrologer_faqs`
--

LOCK TABLES `astrologer_faqs` WRITE;
/*!40000 ALTER TABLE `astrologer_faqs` DISABLE KEYS */;
INSERT INTO `astrologer_faqs` VALUES (1,'How Can Talking to an Astrologer Help You?','<div class=\"faq_box\">\r\n                                <h3 class=\"faq_question\">24×7 Astrology Consultation – Anytime, Anywhere</h3>\r\n                                <p class=\"faq_answer\">Astrotalk entertains a pool of Astrologers who are versed in Vedic\r\n                                    astrology, Vastu, Numerology, Tarot card reading, Panchang and more. You shall avail\r\n                                    these services and ask queries accordingly. For example, you can ask the astrologers\r\n                                    about your love life, career, financial issues, shubh muhurats, contact them for a\r\n                                    handwritten kundli report and so on. At AstroTalk, we motivate our astrologers to be\r\n                                    their professional best and also expect the same from you.</p>\r\n                            </div>\r\n                            <div class=\"faq_box\">\r\n                                <h3 class=\"faq_question\">Why do all the astrologers have such good ratings?</h3>\r\n                                <p class=\"faq_answer\">All the astrologers who make it to the Astrotalk platform are\r\n                                    categorised across 3 stages. Stage 1 includes astrologers that are highly rated by\r\n                                    our customers because of their excellent work. The Stage 2 astrologers are the ones\r\n                                    whose ratings fall below fixed criteria. And when that happens, we intentionally\r\n                                    remove their profile from the platform so that our customers only get to consult\r\n                                    from the top-rated astrologers (Stage 1 astrologers). These Stage 2 astrologers are\r\n                                    then trained by our expert astrologers, and if they do well during the training,\r\n                                    they are brought back on the platform, and if not, they are moved to Stage 3 i.e.\r\n                                    they are unrecruited.</p>\r\n                            </div>\r\n                            <div class=\"faq_box\">\r\n                                <h3 class=\"faq_question\">Can I speak to the same astrologers I had spoken earlier too?\r\n                                </h3>\r\n                                <p class=\"faq_answer\">Yes, you can do that. Both the Astrotalk app and website has a\r\n                                    section with the history of all the purchases you have made on Astrotalk. You can\r\n                                    check the section to connect with the same astrologer multiple times.</p>\r\n                            </div>\r\n                            <div class=\"faq_box\">\r\n                                <h3 class=\"faq_question\">Will my phone number be kept confidential?</h3>\r\n                                <p class=\"faq_answer\">We respect your privacy and as a firm, we are obliged to keep your\r\n                                    information well guarded so no one could ever misuse it whatsoever. You can count on\r\n                                    us.</p>\r\n                            </div>\r\n                            <div class=\"faq_box\">\r\n                                <h3 class=\"faq_question\">Why some astrologers on the app are so expensive?</h3>\r\n                                <p class=\"faq_answer\">Astrotalk promises the best services to its customers and thus\r\n                                    recruits well-experienced astrologers after thorough scrutiny. Most of the\r\n                                    astrologers we have onboard entertain an experience of over 10+ years. This is to\r\n                                    ensure the predictions or any other information they share with you is based on\r\n                                    their broad knowledge, so you always receive accurate information. Also, Astrotalk\r\n                                    saves your precious time by helping you consult expert astrologers from the comfort\r\n                                    of your home, thus saving your time and money. We maintain strict standards and\r\n                                    offer optimum quality. So in a nutshell, our service is qualitative and not\r\n                                    expensive.</p>\r\n                            </div>\r\n\r\n\r\n                            <div class=\"faq_box\">\r\n                                <h3 class=\"faq_question\">What efforts do I need to make to talk to astrologer?</h3>\r\n                                <p class=\"faq_answer\">If you seek to talk to expert astrologers on the Astrotalk\r\n                                    platform, all you need to do is recharge your wallet, find an astrologer you would\r\n                                    like to talk to and simply ring them up. The process will feel like you are simply\r\n                                    calling or texting your friends.</p>\r\n                            </div>\r\n\r\n\r\n                            <div class=\"faq_box\">\r\n                                <h3 class=\"faq_question\">Why should I choose Astrotalk for astrology consultation?</h3>\r\n                                <p class=\"faq_answer\">Astrotalk has always worked to offer the best service to its\r\n                                    customers, and the result of the same is exceptional ratings and reviews that\r\n                                    Astrotalk has garnered on Google, PlayStore, Facebook and other such platforms. It\r\n                                    is the successful predictions that have inspired people to leave a good word for us\r\n                                    and we continue to live upon that thrust of them.</p>\r\n                            </div>\r\n\r\n\r\n                            <div class=\"faq_box\">\r\n                                <h3 class=\"faq_question\">Is Astrotalk safe?</h3>\r\n                                <p class=\"faq_answer\">Astrotalk is a 100% safe platform to use any time of the day, both\r\n                                    financially and interaction wise. Astrotalk adopts the best practices to ensure not\r\n                                    only a great user experience but also user safety, be it on the website or app. User\r\n                                    privacy is the top priority for us and hence we adopt the best encryption\r\n                                    methodologies to protect transactions and any personal information that you share\r\n                                    with us or the astrologer. At Astrotalk, as many as one-lakh transactions happen on\r\n                                    a daily basis, and users are able to do these transactions without any hesitation.\r\n                                    We personally encourage users to use their credit/debit cards on Astrotalk with full\r\n                                    confidence and interact with astrologers without hesitation, as they will always\r\n                                    ensure you the best services.</p>\r\n                            </div>','How Can Talking to an Astrologer Help You?',1,'2026-09-05 04:16:22','2026-09-05 04:16:22');
/*!40000 ALTER TABLE `astrologer_faqs` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `astrology_predictions`
--

DROP TABLE IF EXISTS `astrology_predictions`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `astrology_predictions` (
  `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `name` varchar(255) NOT NULL,
  `image` varchar(255) DEFAULT NULL,
  `image_alt` varchar(255) DEFAULT NULL,
  `sort_order` int(11) NOT NULL DEFAULT 0,
  `is_active` tinyint(1) NOT NULL DEFAULT 1,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `astrology_predictions_name_index` (`name`),
  KEY `astrology_predictions_sort_order_index` (`sort_order`),
  KEY `astrology_predictions_is_active_index` (`is_active`)
) ENGINE=InnoDB AUTO_INCREMENT=13 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `astrology_predictions`
--

LOCK TABLES `astrology_predictions` WRITE;
/*!40000 ALTER TABLE `astrology_predictions` DISABLE KEYS */;
INSERT INTO `astrology_predictions` VALUES (1,'Aries','uploads/astrology_prediction/prediction_1788504977_6a9a6b91a6cb7.png','aries',0,1,'2026-09-04 01:26:17','2026-09-04 01:26:17'),(2,'Taurus','uploads/astrology_prediction/prediction_1788505004_6a9a6bac3eba4.png','taurus',0,1,'2026-09-04 01:26:44','2026-09-04 01:26:44'),(3,'Gemini','uploads/astrology_prediction/prediction_1788505027_6a9a6bc311c64.png','gemini',0,1,'2026-09-04 01:27:07','2026-09-04 01:27:07'),(4,'Cancer','uploads/astrology_prediction/prediction_1788505049_6a9a6bd941f27.png','cancer',0,1,'2026-09-04 01:27:29','2026-09-04 01:27:29'),(5,'Leo','uploads/astrology_prediction/prediction_1788505088_6a9a6c009fff3.png','leo',0,1,'2026-09-04 01:28:08','2026-09-04 01:28:08'),(6,'Virgo','uploads/astrology_prediction/prediction_1788505131_6a9a6c2b39295.png','virgo',0,1,'2026-09-04 01:28:51','2026-09-04 01:28:51'),(7,'Libra','uploads/astrology_prediction/prediction_1788505153_6a9a6c411db60.png','libra',0,1,'2026-09-04 01:29:13','2026-09-04 01:29:13'),(8,'Scorpio','uploads/astrology_prediction/prediction_1788505175_6a9a6c57bb441.png','scorpio',0,1,'2026-09-04 01:29:35','2026-09-04 01:29:35'),(9,'Sagittarius','uploads/astrology_prediction/prediction_1788505211_6a9a6c7b67ae7.png','sagittarius',0,1,'2026-09-04 01:30:11','2026-09-04 01:30:11'),(10,'Capricorn','uploads/astrology_prediction/prediction_1788505249_6a9a6ca1bc5e2.png','capricorn',0,1,'2026-09-04 01:30:49','2026-09-04 01:30:49'),(11,'Aquarius','uploads/astrology_prediction/prediction_1788505295_6a9a6ccf10baf.png','aquarius',0,1,'2026-09-04 01:31:35','2026-09-04 01:31:35'),(12,'Pisces','uploads/astrology_prediction/prediction_1788505313_6a9a6ce1c6826.png','pisces',0,1,'2026-09-04 01:31:53','2026-09-04 01:31:53');
/*!40000 ALTER TABLE `astrology_predictions` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `best_astrologer_contents`
--

DROP TABLE IF EXISTS `best_astrologer_contents`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `best_astrologer_contents` (
  `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `content` longtext DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `best_astrologer_contents`
--

LOCK TABLES `best_astrologer_contents` WRITE;
/*!40000 ALTER TABLE `best_astrologer_contents` DISABLE KEYS */;
INSERT INTO `best_astrologer_contents` VALUES (1,'<div class=\"free_online_kundli\">\r\n                        <h4 class=\"text-center\">Why Consult an Astrologer in Jaipur?</h4>\r\n                        <p>Jaipur has always been a center of cultural richness and Vedic wisdom. Many people come here\r\n                            looking for the best astrologers in Jaipur who can guide them with age-old practices and\r\n                            modern approaches.</p>\r\n                        <p>An astrologer in Jaipur is not just someone who tells your future,&nbsp; they help you understand\r\n                            your present better. Whether you’re facing confusion in your love life or unsure about your\r\n                            next move in career, the top astrologer in\r\n                            Jaipur can provide spiritual insights.</p>\r\n                        <p>From free astrologer in Jaipur consultations to personal sessions, the city offers a mix of\r\n                            traditional and digital astrology services. And if you\'re someone searching for a lady\r\n                            astrologer in Jaipur who understands your concerns\r\n                            deeply, you’ll find reliable options in the city.</p>\r\n                    </div>\r\n                    <div class=\"free_online_kundli\">\r\n                        <h4>How to Select the Best Astrologers for You?</h4>\r\n                        <p>Finding the best astrologers in Jaipur is easier when you keep a few points in mind:</p>\r\n                        <ul>\r\n                            <li>Choose well-known platforms like Astrotalk that list verified astrologers&nbsp;</li>\r\n                            <li>Read reviews, ratings, and check what area they specialise in&nbsp;</li>\r\n                            <li>Go for astrologers with a good digital presence — the top 10 astrologer in Jaipur often\r\n                                have websites or profiles&nbsp;</li>\r\n                            <li>If you prefer ease, choose an astrologer in Jaipur near me with online consultation\r\n                                options\r\n                            </li>\r\n                            <li>Get referrals from friends or search “best astrologer in Jaipur Rajasthan” to find\r\n                                trusted nam</li>\r\n\r\n                        </ul>\r\n                        <p>Whether it’s a top 5 astrologer in Jaipur or someone local like an astrologer in Jaipur city,\r\n                            comfort and trust should guide your choice.</p>\r\n                    </div>\r\n                    <div class=\"free_online_kundli\">\r\n                        <h4>What Astrology Services are Offered?</h4>\r\n                        <p>If you\'re exploring astrology services in Jaipur, here’s what you can expect from the best\r\n                            astrologers in Jaipur:</p>\r\n                        <ul>\r\n                            <li>Birth chart reading – Every experienced astrologer in Jaipur starts with your kundli\r\n                                (birth chart) to understand your life pattern.&nbsp;</li>\r\n                            <li>Career guidance – People consult the top astrologer in Jaipur when they’re unsure about\r\n                                job shifts, business, or studies.&nbsp;</li>\r\n                            <li>Love &amp; marriage guidance – The famous astrologer in Jaipur can read your chart and tell\r\n                                if your relationship is aligned for success.&nbsp;</li>\r\n                            <li>Spiritual path and clarity – The best astrologers in Jaipur also help you align with\r\n                                your life’s spiritual purpose.&nbsp;</li>\r\n                            <li>Daily/weekly predictions – Some even offer regular insights to help you plan your days\r\n                                better.\r\n                            </li>\r\n                        </ul>\r\n                        <p>From a local astrologer in Jaipur near me to a renowned astrologer in Mansarovar Jaipur,\r\n                            services are tailored for what you need most.</p>\r\n                    </div>\r\n                    <div class=\"free_online_kundli\">\r\n                        <h4>What Questions to Ask an Astrologer?</h4>\r\n                        <p>When meeting the best astrologers in Jaipur, it’s good to be clear about your questions:</p>\r\n                        <ul>\r\n                            <li>Focus on areas like love, career, health, or personal growth&nbsp;</li>\r\n                            <li>You can ask when a good time is for starting something new&nbsp;</li>\r\n                            <li>Ask about compatibility in relationships or friendships&nbsp;</li>\r\n                            <li>You can also inquire about spiritual blockages or patterns you should be aware of</li>\r\n                        </ul>\r\n                        <p>Whether you’re meeting a top astrologer in Jaipur online or offline, clear questions help the\r\n                            astrologer guide you better.</p>\r\n                    </div>\r\n                    <div class=\"free_online_kundli\">\r\n                        <h4>Offline vs Online Astrologers in Jaipur – What’s Better?</h4>\r\n                        <p><strong>Online Astrologers in Jaipur:</strong></p>\r\n                        <ul>\r\n                            <li>Easy access to top 10 astrologer in Jaipur without stepping out&nbsp;</li>\r\n                            <li>You can compare and read real-time feedback before choosing&nbsp;&nbsp;</li>\r\n                            <li>Talk from anywhere in comfort&nbsp;</li>\r\n                            <li>Get time slots that suit your routine</li>\r\n                        </ul>\r\n                        <p><strong>Offline Astrologers</strong></p>\r\n\r\n                        <ul>\r\n                            <li>Face-to-face meetings feel more personal&nbsp;</li>\r\n                            <li>Great if you’re searching for a best astrologer in Jaipur near me&nbsp;</li>\r\n                            <li>Some people prefer local sessions like with an astrologer in Jaipur city&nbsp;</li>\r\n                            <li>Good option for regular visitors who like to build a personal rapport</li>\r\n\r\n                        </ul>\r\n                        <p>Whether it’s online or offline, Jaipur offers many experts from free astrologer in Jaipur\r\n                            listings to premium astrologers.</p>\r\n                    </div>\r\n                    <div class=\"free_online_kundli\">\r\n                        <h4>Conclusion:</h4>\r\n                        <p>Your astrology journey is about connection, energy, and understanding. With so many choices,\r\n                            finding the best astrologers in Jaipur may take time&nbsp; but the right one will make you feel\r\n                            heard and understood. Whether you are looking\r\n                            for the top 5 astrologer in Jaipur or a lady astrologer in Jaipur, trust your instinct.</p>\r\n                        <p>The stars may not change, but the way you understand their influence can shift your path. So\r\n                            explore, ask questions, and let your trusted astrologer in Jaipur help you walk through life\r\n                            with confidence.&nbsp;</p>\r\n                        <p>Don’t hesitate to check verified profiles on trusted platforms like Astrotalk and find the\r\n                            best astrologer in Jaipur Rajasthan who speaks your language and understand you&nbsp; emotionally\r\n                            and spiritually.</p>\r\n                    </div>','2026-09-09 06:00:32','2026-09-09 06:00:32');
/*!40000 ALTER TABLE `best_astrologer_contents` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `chat_with_astrologer_contents`
--

DROP TABLE IF EXISTS `chat_with_astrologer_contents`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `chat_with_astrologer_contents` (
  `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `content` longtext DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `chat_with_astrologer_contents`
--

LOCK TABLES `chat_with_astrologer_contents` WRITE;
/*!40000 ALTER TABLE `chat_with_astrologer_contents` DISABLE KEYS */;
INSERT INTO `chat_with_astrologer_contents` VALUES (1,'<div class=\"faq_wrapper\">\r\n                        <div class=\"free_online_kundli\">\r\n                            <h4 class=\"text-center\">How Chatting with an astrologer can help you?</h4>\r\n                            <h2 class=\"text-center\">Best online astrology consultation</h2>\r\n\r\n                        </div>\r\n                        <div class=\"help_content\">\r\n                            <p>There’s no need to overthink your worries when the right guidance is just a call away.\r\n                                Our\r\n                                platform connects you with 500+ trusted astrologers who are available on chat to help\r\n                                you\r\n                                understand and resolve concerns related to love, finance, Vastu, career, luck, marriage\r\n                                and\r\n                                more. Life naturally comes with ups and downs—while the good moments lift us up, the\r\n                                difficult phases can create stress, confusion and emotional imbalance. These challenges\r\n                                can\r\n                                even affect your relationships and overall peace of mind. With timely astrological\r\n                                insight,\r\n                                you can navigate such moments with clarity, confidence and a sense of direction,\r\n                                ensuring\r\n                                your personal and emotional well-being stays intact.</p>\r\n\r\n                            <p>Astrotalk offers exceptional astrology consultation services that help you understand and\r\n                                resolve\r\n                                the challenges you face in different areas of life. Many difficulties arise due to\r\n                                planetary\r\n                                influences that have been a part of our horoscope since birth. Each person goes through\r\n                                certain\r\n                                predefined dashas—such as Shani Dasha or Rahu Dasha—which can bring obstacles, stress\r\n                                and\r\n                                unexpected setbacks. These phases may affect confidence, finances, relationships and\r\n                                overall\r\n                                stability. With the right guidance and timely remedies, these negative effects can be\r\n                                reduced or\r\n                                prevented. Our expert astrologers provide the insights and solutions you need to\r\n                                navigate these\r\n                                planetary periods with clarity and strength.</p>\r\n                            <p>We bring together a team of highly experienced and knowledgeable astrologers specialising\r\n                                in\r\n                                Vedic Astrology, Numerology, Tarot Reading, Reiki Healing, Nandi Astrology, Vastu and\r\n                                more. You\r\n                                can connect with any of these experts through chat and seek guidance on the issues\r\n                                affecting\r\n                                your life. With years of practice and deep astrological insight, our astrologers analyze\r\n                                your\r\n                                concerns and offer clear, effective and personalised solutions to help you move forward\r\n                                with\r\n                                confidence.</p>\r\n                            <p>Astrology isn’t limited to solving problems—it also helps you make the right decisions\r\n                                during\r\n                                important life events. Whether you’re planning a wedding and need the shubh muhurat,\r\n                                choosing a\r\n                                name for your newborn, scheduling the mundan ceremony, or selecting the right gemstone\r\n                                based on\r\n                                your rashi, expert astrologers can guide you with accurate and personalized advice. From\r\n                                auspicious timings to gemstone recommendations, a quick chat with an astrologer gives\r\n                                you\r\n                                clarity whenever you need it. We offer both free and paid consultation options, making\r\n                                guidance\r\n                                accessible to everyone. You can easily find us by searching terms like online chat with\r\n                                astrologer, free astro chat, talk to astrologer online, or astrologer near me. Our goal\r\n                                is to\r\n                                deliver complete satisfaction through trusted and meaningful astrological\r\n                                services—including\r\n                                free kundli generation and matchmaking.</p>\r\n\r\n                        </div>\r\n\r\n                    </div>','2026-09-09 23:23:54','2026-09-09 23:23:54');
/*!40000 ALTER TABLE `chat_with_astrologer_contents` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `contact_banners`
--

DROP TABLE IF EXISTS `contact_banners`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `contact_banners` (
  `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `banner_image` varchar(255) DEFAULT NULL,
  `alt_text` varchar(255) DEFAULT 'contactus-banner',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `contact_banners`
--

LOCK TABLES `contact_banners` WRITE;
/*!40000 ALTER TABLE `contact_banners` DISABLE KEYS */;
INSERT INTO `contact_banners` VALUES (1,'uploads/banners/contact_banner_1789021078.png','contactus-banner','2026-09-10 06:15:13','2026-09-10 00:47:58');
/*!40000 ALTER TABLE `contact_banners` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `contact_details`
--

DROP TABLE IF EXISTS `contact_details`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `contact_details` (
  `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `content` longtext DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `contact_details`
--

LOCK TABLES `contact_details` WRITE;
/*!40000 ALTER TABLE `contact_details` DISABLE KEYS */;
INSERT INTO `contact_details` VALUES (1,'<div class=\"popular_products_boses\">\r\n\r\n    <div class=\"popular_products_title mb-4\">\r\n        <h2>GET IN TOUCH WITH US</h2>\r\n    </div>\r\n\r\n    <div class=\"row g-3\">\r\n\r\n        <!-- Email -->\r\n        <div class=\"col-lg-6\">\r\n            <div class=\"contact-box d-flex align-items-center\">\r\n                <div class=\"contact-icon\">\r\n                    <img src=\"/assets/images/email-address.png\" alt=\"Email Address\">\r\n                </div>\r\n                <div class=\"contact-content\">\r\n                    <h6>Email Address</h6>\r\n                    <p>support@newstoyool.com</p>\r\n                </div>\r\n            </div>\r\n        </div>\r\n\r\n        <!-- India -->\r\n        <div class=\"col-lg-6\">\r\n            <div class=\"contact-box d-flex align-items-center\">\r\n                <div class=\"contact-icon\">\r\n                    <img src=\"/assets/images/india.png\" alt=\"India\">\r\n                </div>\r\n                <div class=\"contact-content\">\r\n                    <h6>INDIA</h6>\r\n                    <p>+91-0000-000-000</p>\r\n                </div>\r\n            </div>\r\n        </div>\r\n\r\n        <!-- Canada -->\r\n        <div class=\"col-lg-6\">\r\n            <div class=\"contact-box d-flex align-items-center\">\r\n                <div class=\"contact-icon\">\r\n                    <img src=\"/assets/images/canada.png\" alt=\"Canada\">\r\n                </div>\r\n                <div class=\"contact-content\">\r\n                    <h6>CANADA</h6>\r\n                    <p>+12266420007</p>\r\n                </div>\r\n            </div>\r\n        </div>\r\n\r\n        <!-- Australia -->\r\n        <div class=\"col-lg-6\">\r\n            <div class=\"contact-box d-flex align-items-center\">\r\n                <div class=\"contact-icon\">\r\n                    <img src=\"/assets/images/australia.png\" alt=\"Australia\">\r\n                </div>\r\n                <div class=\"contact-content\">\r\n                    <h6>AUSTRALIA</h6>\r\n                    <p>+61485135194</p>\r\n                </div>\r\n            </div>\r\n        </div>\r\n\r\n        <!-- USA -->\r\n        <div class=\"col-lg-6\">\r\n            <div class=\"contact-box d-flex align-items-center\">\r\n                <div class=\"contact-icon\">\r\n                    <img src=\"/assets/images/usa.png\" alt=\"USA\">\r\n                </div>\r\n                <div class=\"contact-content\">\r\n                    <h6>USA</h6>\r\n                    <p>+12089774560</p>\r\n                </div>\r\n            </div>\r\n        </div>\r\n\r\n        <!-- UK -->\r\n        <div class=\"col-lg-6\">\r\n            <div class=\"contact-box d-flex align-items-center\">\r\n                <div class=\"contact-icon\">\r\n                    <img src=\"/assets/images/uk.png\" alt=\"UK\">\r\n                </div>\r\n                <div class=\"contact-content\">\r\n                    <h6>UK</h6>\r\n                    <p>+447451278944</p>\r\n                </div>\r\n            </div>\r\n        </div>\r\n\r\n    </div>\r\n\r\n    <div class=\"mt-5 mb-3\">\r\n        <h3 class=\"reach_us_title\">Reach us</h3>\r\n    </div>\r\n    <div class=\"row g-3\">\r\n\r\n        <div class=\"col-lg-6\">\r\n            <div class=\"contact-box d-flex align-items-center\">\r\n                <div class=\"contact-icon\">\r\n                    <img src=\"/assets/images/office.png\" alt=\"Registered Office\">\r\n                </div>\r\n                <div class=\"contact-content\">\r\n                    <h6>Registered Office</h6>\r\n                    <p>B-9/3, Zenith Plaza, Green Park Extension, New Delhi - 110016</p>\r\n                </div>\r\n            </div>\r\n        </div>\r\n\r\n        <div class=\"col-lg-6\">\r\n            <div class=\"contact-box d-flex align-items-center\">\r\n                <div class=\"contact-icon\">\r\n                    <img src=\"/assets/images/building.png\" alt=\"Corporate Office\">\r\n                </div>\r\n                <div class=\"contact-content\">\r\n                    <h6>Corporate Office</h6>\r\n                    <p>Plot 22, Starview Tech Park, Okhla Phase II, New Delhi - 110020</p>\r\n                </div>\r\n            </div>\r\n        </div>\r\n\r\n    </div>\r\n\r\n    <div class=\"contact-map mt-4\">\r\n        <iframe src=\"https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d14026.041472372624!2d77.089!3d28.463!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x390d18f0a4b5d9ab%3A0x2d0b2cbe6c7d9e2!2sAstroyogi!5e0!3m2!1sen!2sin!4v1754300000000!5m2!1sen!2sin\" allowfullscreen=\"\" loading=\"lazy\" referrerpolicy=\"no-referrer-when-downgrade\">\r\n        </iframe>\r\n    </div>\r\n\r\n</div>','2026-09-10 01:43:29','2026-09-10 01:57:42');
/*!40000 ALTER TABLE `contact_details` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `device_tokens`
--

DROP TABLE IF EXISTS `device_tokens`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `device_tokens` (
  `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `token` text NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `device_tokens_token_unique` (`token`) USING HASH
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `device_tokens`
--

LOCK TABLES `device_tokens` WRITE;
/*!40000 ALTER TABLE `device_tokens` DISABLE KEYS */;
INSERT INTO `device_tokens` VALUES (1,'dLBykzBAJSvFoTPwMCGsGp:APA91bFPHQJeTbfezb5XbO5kwIl9ZFpse6fgW4B8OeMTjYP_0V0u2N5bEfuxebfUDnR2ursfOfSdHbuxELxXAQ5iuDiSB_YhUN_zPs9b3_nCO48D1KNiITE','2026-09-22 01:14:21','2026-09-22 01:14:21');
/*!40000 ALTER TABLE `device_tokens` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `expert_astrologers`
--

DROP TABLE IF EXISTS `expert_astrologers`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `expert_astrologers` (
  `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `section_title` varchar(255) DEFAULT NULL,
  `name` varchar(255) NOT NULL,
  `expertise` varchar(255) DEFAULT NULL,
  `image` varchar(255) DEFAULT NULL,
  `image_alt` varchar(255) DEFAULT NULL,
  `call_title` varchar(255) NOT NULL DEFAULT 'Free Call',
  `call_link` varchar(255) NOT NULL DEFAULT '#',
  `chat_title` varchar(255) NOT NULL DEFAULT 'Free Chat',
  `chat_link` varchar(255) NOT NULL DEFAULT 'chat-astrologer.html',
  `sort_order` int(11) NOT NULL DEFAULT 0,
  `is_active` tinyint(1) NOT NULL DEFAULT 1,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `expert_astrologers_name_index` (`name`),
  KEY `expert_astrologers_sort_order_index` (`sort_order`),
  KEY `expert_astrologers_is_active_index` (`is_active`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `expert_astrologers`
--

LOCK TABLES `expert_astrologers` WRITE;
/*!40000 ALTER TABLE `expert_astrologers` DISABLE KEYS */;
INSERT INTO `expert_astrologers` VALUES (1,'Get Your First Call or Chat FREE with Our Expert Astrologers – Consult Now!','Priya Sharma','Love, Marriage, Career','uploads/expert_astrologers/astrologer_1788438185_6a9966a998252.png','Priya Sharma','Free Call','#','Free Chat','chat-astrologer.html',0,1,'2026-09-03 06:53:05','2026-09-03 06:53:05');
/*!40000 ALTER TABLE `expert_astrologers` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `festival_calendars`
--

DROP TABLE IF EXISTS `festival_calendars`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `festival_calendars` (
  `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `title` varchar(255) NOT NULL,
  `festival_day` varchar(10) NOT NULL,
  `festival_month` varchar(15) NOT NULL,
  `short_desc` text DEFAULT NULL,
  `image` varchar(255) DEFAULT NULL,
  `image_alt` varchar(255) DEFAULT NULL,
  `link` varchar(255) NOT NULL DEFAULT '#',
  `sort_order` int(11) NOT NULL DEFAULT 0,
  `is_active` tinyint(1) NOT NULL DEFAULT 1,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `festival_calendars_title_index` (`title`),
  KEY `festival_calendars_sort_order_index` (`sort_order`),
  KEY `festival_calendars_is_active_index` (`is_active`)
) ENGINE=InnoDB AUTO_INCREMENT=11 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `festival_calendars`
--

LOCK TABLES `festival_calendars` WRITE;
/*!40000 ALTER TABLE `festival_calendars` DISABLE KEYS */;
INSERT INTO `festival_calendars` VALUES (1,'Sharad Navratri (Pratipada)','11','Oct','Shardiya Navratri begins with Ghatasthapana, dedicated to the worship of the nine divine forms of Maa Durga.','uploads/festivals/festival_1788519460_6a9aa4243b974.png','navratri_day_1','#',1,1,'2026-09-04 10:57:08','2026-09-04 05:27:40'),(2,'Maha Navami','19','Oct','The ninth day of Navratri, observed with Kanya Pujan and Hawan, marking the conclusion of the fasts.','uploads/festivals/festival_1788519481_6a9aa43901c0f.png','maha_navami','#',2,1,'2026-09-04 10:57:08','2026-09-04 05:28:01'),(3,'Dussehra (Vijayadashami)','20','Oct','Celebrates the victory of Lord Rama over Ravana and Goddess Durga over Mahishasura, signifying victory of good over evil.','uploads/festivals/festival_1788519495_6a9aa44727043.png','dussehra','#',3,1,'2026-09-04 10:57:08','2026-09-04 05:28:15'),(4,'Karwa Chauth','29','Oct','Auspicious fasting day observed by married women from sunrise to moonrise for the long life of their husbands.','uploads/festivals/festival_1788519508_6a9aa454a1810.png','karwa_chauth','#',4,1,'2026-09-04 10:57:08','2026-09-04 05:28:28'),(5,'Dhanteras','06','Nov','Also known as Dhantrayodashi, dedicated to Lord Dhanvantari and Goddess Lakshmi; highly auspicious for new purchases.','images/ninth-day.png','dhanteras','#',5,1,'2026-09-04 10:57:08','2026-09-04 10:57:08'),(6,'Diwali (Lakshmi Puja)','08','Nov','The festival of lights celebrating the homecoming of Lord Rama, observed with grand Lakshmi-Ganesha pujan.','images/ninth-day.png','diwali','#',6,1,'2026-09-04 10:57:08','2026-09-04 10:57:08'),(7,'Govardhan Puja','09','Nov','Celebrates Lord Krishna lifting the Govardhan Parvat to protect villagers from torrential rains.','images/ninth-day.png','govardhan_puja','#',7,1,'2026-09-04 10:57:08','2026-09-04 10:57:08'),(8,'Bhai Dooj','10','Nov','Celebrates the eternal bond between brothers and sisters with tilak ceremonies and prayers.','images/ninth-day.png','bhai_dooj','#',8,1,'2026-09-04 10:57:08','2026-09-04 10:57:08'),(9,'Chhath Puja (Sandhya Arghya)','15','Nov','Four-day ancient Vedic festival dedicated to Surya Dev and Chhathi Maiya, observed with holy rituals.','images/ninth-day.png','chhath_puja','#',9,1,'2026-09-04 10:57:08','2026-09-04 10:57:08'),(10,'Devutthana Ekadashi','20','Nov','Marks the awakening of Lord Vishnu after four months of Yoga Nidra, officially commencing the Hindu wedding season.','images/ninth-day.png','devutthana_ekadashi','#',10,1,'2026-09-04 10:57:08','2026-09-04 10:57:08');
/*!40000 ALTER TABLE `festival_calendars` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `free_astrology_services`
--

DROP TABLE IF EXISTS `free_astrology_services`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `free_astrology_services` (
  `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `title` varchar(255) NOT NULL,
  `image` varchar(255) DEFAULT NULL,
  `image_alt` varchar(255) DEFAULT NULL,
  `link` varchar(255) NOT NULL DEFAULT '#',
  `sort_order` int(11) NOT NULL DEFAULT 0,
  `is_active` tinyint(1) NOT NULL DEFAULT 1,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `free_astrology_services_title_index` (`title`),
  KEY `free_astrology_services_sort_order_index` (`sort_order`),
  KEY `free_astrology_services_is_active_index` (`is_active`)
) ENGINE=InnoDB AUTO_INCREMENT=14 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `free_astrology_services`
--

LOCK TABLES `free_astrology_services` WRITE;
/*!40000 ALTER TABLE `free_astrology_services` DISABLE KEYS */;
INSERT INTO `free_astrology_services` VALUES (1,'Free Kundli','uploads/free_astrology_services/free_service_1788506744_6a9a7278e6470.png','free_kundli','#',1,1,'2026-09-04 01:55:44','2026-09-04 01:55:44'),(2,'Free Chat','uploads/free_astrology_services/free_service_1788506794_6a9a72aa107da.png','free_chat','#',2,1,'2026-09-04 01:56:34','2026-09-04 01:56:34'),(3,'Free Talk','uploads/free_astrology_services/free_service_1788506849_6a9a72e1623b8.png','free talk','#',3,1,'2026-09-04 01:57:29','2026-09-04 02:56:14'),(4,'Horoscope','uploads/free_astrology_services/free_service_1788506878_6a9a72fe93afd.png','horoscope','#',4,1,'2026-09-04 01:57:58','2026-09-04 01:57:58'),(5,'Tarot Reading','uploads/free_astrology_services/free_service_1788506913_6a9a7321965b6.png','tarot_reading','#',5,1,'2026-09-04 01:58:33','2026-09-04 01:58:33'),(6,'Vedic Astrology','uploads/free_astrology_services/free_service_1788506946_6a9a73421d775.png','vedic_astrology','#',6,1,'2026-09-04 01:59:06','2026-09-04 01:59:06'),(7,'Daily Rashiphal','uploads/free_astrology_services/free_service_1788506982_6a9a7366d60ec.png','daily_rashiphal','#',7,1,'2026-09-04 01:59:42','2026-09-04 01:59:42'),(8,'Numerology','uploads/free_astrology_services/free_service_1788510610_6a9a8192eaf2b.png','numerology','#',8,1,'2026-09-04 03:00:10','2026-09-04 03:00:10'),(9,'Name Meaning','uploads/free_astrology_services/free_service_1788510648_6a9a81b837e38.png','name_meaning','#',9,1,'2026-09-04 03:00:48','2026-09-04 03:00:48'),(10,'Daily Horoscopes','uploads/free_astrology_services/free_service_1788510682_6a9a81da24c85.png','daily_horoscopes','#',10,1,'2026-09-04 03:01:22','2026-09-04 03:01:22'),(11,'Aquarius','uploads/free_astrology_services/free_service_1788510775_6a9a8237f09fd.png','aquarius','#',11,1,'2026-09-04 03:02:56','2026-09-04 03:02:56'),(12,'Pisces','uploads/free_astrology_services/free_service_1788510805_6a9a8255f2890.png','pisces','#',12,1,'2026-09-04 03:03:26','2026-09-04 03:03:26');
/*!40000 ALTER TABLE `free_astrology_services` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `free_kundli_faqs`
--

DROP TABLE IF EXISTS `free_kundli_faqs`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `free_kundli_faqs` (
  `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `title` varchar(255) NOT NULL DEFAULT 'Kundli FAQ',
  `content` longtext DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `free_kundli_faqs`
--

LOCK TABLES `free_kundli_faqs` WRITE;
/*!40000 ALTER TABLE `free_kundli_faqs` DISABLE KEYS */;
INSERT INTO `free_kundli_faqs` VALUES (1,'Kundli FAQ','<div class=\"accordion-item\">\r\n                                        <h2 class=\"accordion-header\">\r\n                                            <button class=\"accordion-button collapsed\" type=\"button\" data-bs-toggle=\"collapse\" data-bs-target=\"#faq1\">\r\n                                                What is the Lagna Chart?\r\n                                            </button>\r\n                                        </h2>\r\n                                        <div id=\"faq1\" class=\"accordion-collapse collapse\" data-bs-parent=\"#faqAccordion\">\r\n                                            <div class=\"accordion-body\">\r\n                                                Lagna Chart is the main birth chart in Vedic astrology that shows the\r\n                                                planetary positions at the time of birth.\r\n                                            </div>\r\n                                        </div>\r\n                                    </div>\r\n\r\n                                    <div class=\"accordion-item\">\r\n                                        <h2 class=\"accordion-header\">\r\n                                            <button class=\"accordion-button collapsed\" type=\"button\" data-bs-toggle=\"collapse\" data-bs-target=\"#faq2\">\r\n                                                How to read Kundli or Lagna Chart?\r\n                                            </button>\r\n                                        </h2>\r\n                                        <div id=\"faq2\" class=\"accordion-collapse collapse\" data-bs-parent=\"#faqAccordion\">\r\n                                            <div class=\"accordion-body\">\r\n                                                Read the ascendant, planets, zodiac signs, and houses to understand\r\n                                                different aspects of life.\r\n                                            </div>\r\n                                        </div>\r\n                                    </div>\r\n\r\n                                    <div class=\"accordion-item\">\r\n                                        <h2 class=\"accordion-header\">\r\n                                            <button class=\"accordion-button collapsed\" type=\"button\" data-bs-toggle=\"collapse\" data-bs-target=\"#faq3\">\r\n                                                How to read Kundali houses?\r\n                                            </button>\r\n                                        </h2>\r\n                                        <div id=\"faq3\" class=\"accordion-collapse collapse\" data-bs-parent=\"#faqAccordion\">\r\n                                            <div class=\"accordion-body\">\r\n                                                Each house represents different life areas like career, marriage,\r\n                                                education, health, and wealth.\r\n                                            </div>\r\n                                        </div>\r\n                                    </div>\r\n\r\n                                    <div class=\"accordion-item\">\r\n                                        <h2 class=\"accordion-header\">\r\n                                            <button class=\"accordion-button collapsed\" type=\"button\" data-bs-toggle=\"collapse\" data-bs-target=\"#faq4\">\r\n                                                Is Kundli 100% correct?\r\n                                            </button>\r\n                                        </h2>\r\n                                        <div id=\"faq4\" class=\"accordion-collapse collapse\" data-bs-parent=\"#faqAccordion\">\r\n                                            <div class=\"accordion-body\">\r\n                                                Kundli provides astrological guidance based on planetary positions and\r\n                                                should be considered as guidance.\r\n                                            </div>\r\n                                        </div>\r\n                                    </div>\r\n\r\n                                    <div class=\"accordion-item\">\r\n                                        <h2 class=\"accordion-header\">\r\n                                            <button class=\"accordion-button collapsed\" type=\"button\" data-bs-toggle=\"collapse\" data-bs-target=\"#faq5\">\r\n                                                What is the Navamsa chart?\r\n                                            </button>\r\n                                        </h2>\r\n                                        <div id=\"faq5\" class=\"accordion-collapse collapse\" data-bs-parent=\"#faqAccordion\">\r\n                                            <div class=\"accordion-body\">\r\n                                                Navamsa Chart is an important divisional chart mainly used for marriage\r\n                                                and spiritual analysis.\r\n                                            </div>\r\n                                        </div>\r\n                                    </div>\r\n\r\n                                    <div class=\"accordion-item\">\r\n                                        <h2 class=\"accordion-header\">\r\n                                            <button class=\"accordion-button collapsed\" type=\"button\" data-bs-toggle=\"collapse\" data-bs-target=\"#faq6\">\r\n                                                Why Are Your Date of Birth and Time Important for Your Kundli?\r\n                                            </button>\r\n                                        </h2>\r\n                                        <div id=\"faq6\" class=\"accordion-collapse collapse\" data-bs-parent=\"#faqAccordion\">\r\n                                            <div class=\"accordion-body\">\r\n                                                Accurate birth date and time ensure correct planetary positions in your\r\n                                                Kundli.\r\n                                            </div>\r\n                                        </div>\r\n                                    </div>','2026-09-07 03:31:36','2026-09-07 03:31:36');
/*!40000 ALTER TABLE `free_kundli_faqs` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `free_kundli_guides`
--

DROP TABLE IF EXISTS `free_kundli_guides`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `free_kundli_guides` (
  `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `title` varchar(255) DEFAULT 'Online Kundali Guide',
  `content` longtext DEFAULT NULL,
  `is_active` tinyint(1) NOT NULL DEFAULT 1,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `free_kundli_guides`
--

LOCK TABLES `free_kundli_guides` WRITE;
/*!40000 ALTER TABLE `free_kundli_guides` DISABLE KEYS */;
INSERT INTO `free_kundli_guides` VALUES (1,'Create Your Free Online Kundali','<div class=\"free_online_kundli\">\r\n                        <h4>Create Your Free Online Kundali Using Our Kundali Making Software</h4>\r\n                        <p>Kundli making is just one click away! It’s possible with Astroyogi\'s free Kundali making\r\n                            software generates an online horoscope in seconds. Trusted by millions worldwide, our free\r\n                            online Kundli generator reveals accurate insights into planetary positions, doshas, and key\r\n                            life events.</p>\r\n                        <p>So, if you want your Janam Kundali on the go, just use our Kundali making software or\r\n                            download the Kundli app to access your personalized lagna chart anytime, anywhere. One tap,\r\n                            and you get your janam kundli in Hindi or English as it comes with multilingual support.</p>\r\n                        <p>Once you have a basic analysis of your horoscope, you can consult Astroyogi\'s expert\r\n                            astrologers online for more detailed and accurate Kundli predictions. Whether at home or\r\n                            traveling, you can consult experts 24/7 and get clarity on every aspect of life.</p>\r\n                    </div>\r\n                    <div class=\"free_online_kundli\">\r\n                        <h4>How Does the Astroyogi Free Kundali Software or Birth Chart Calculator Help You?</h4>\r\n                        <p>You can utilize this online Kundli software to generate a free Janam Kundli which gives\r\n                            authentic information based on astrological calculations and planetary positions. Hence,\r\n                            this birth chart holds the key to unlocking your potential and understanding the true course\r\n                            of your life.</p>\r\n                        <p>From choosing the right life partner to exploring new career opportunities, starting a\r\n                            business, or ensuring harmony in your present, your kundli generated at no cost becomes a\r\n                            guiding light at every step.</p>\r\n                    </div>\r\n\r\n                    <div class=\"free_online_kundli\">\r\n                        <h4>With Astroyogi\'s free Kundali software, you can get:</h4>\r\n                        <ul>\r\n                            <li>Horoscope chart with a geometrical diagram consisting of&nbsp;<span>planets</span>, zodiac\r\n                                lords,\r\n                                and&nbsp;<span>kundali houses</span></li>\r\n                            <li>Planetary details during your birth that include</li>\r\n                            <li><span>Nakshatra</span></li>\r\n                            <li><span>Ascendant</span></li>\r\n                            <li>Sign</li>\r\n                            <li>Nakshatra Lord</li>\r\n                            <li><span>Yog</span></li>\r\n                            <li><span>Tithi</span></li>\r\n                            <li><span>Kundli Dosha</span>, like<span>&nbsp;Manglik Dosha</span>,<span>&nbsp;<span>Kaal Sarp</span>\r\n                                    Dosha</span>,&nbsp;<span>Pitra Dosha</span>, and more\r\n                                (whether\r\n                                present or absent).</li>\r\n                            <li>Planetary&nbsp;<span>Dasha&nbsp;</span>details like Rahu, Ketu, Shani, and more.</li>\r\n                            <li>Favorable Vedic astrology and<span>&nbsp;Numerology </span>&nbsp;details</li>\r\n                            <li>Remedies:&nbsp;<span>Gemstone&nbsp;</span>wearing,<span>&nbsp;mantra&nbsp;</span>chanting, performing pujas,\r\n                                charity,<span>&nbsp;yoga</span>,\r\n                                meditation, and more.</li>\r\n                        </ul>\r\n                    </div>\r\n\r\n\r\n                    <div class=\"free_online_kundli\">\r\n                        <h4>What Is a Janam Kundali or Birth Chart?</h4>\r\n                        <p>A Janam Kundali, or Birth chart, is like a cosmic blueprint of your life. Vedic astrologers\r\n                            create your Kundli by date of birth, place of birth, and time of birth. It\'s like a roadmap\r\n                            that shows the exact positions of&nbsp;<span>planets,&nbsp;zodiac signs</span>, houses, and all major\r\n                            astrological\r\n                            aspects present at the time of your birth. These aspects in your natal or birth chart are\r\n                            considered significant in an astrological analysis.</p>\r\n                        <p>Vedic astrology uses your Kundli chart to interpret your destiny, personality, strengths, and\r\n                            weaknesses. Astrologers can provide insights into various aspects of your life, including\r\n                            career, relationships, and wealth, by analyzing your Kundli online or offline. Moreover,\r\n                            your Janam Kundali can reveal patterns and influences that can shape your journey through\r\n                            life.</p>\r\n                    </div>\r\n\r\n\r\n                    <div class=\"free_online_kundli\">\r\n                        <h4>Benefits of Janam Kundali or Horoscope Reading</h4>\r\n                        <p>With the help of a Janam Kundli software or online horoscope reading, you can gain\r\n                            personalized insights into your life. Here are the benefits:</p>\r\n                        <ul>\r\n                            <li><strong>Deal With Ups and Downs:&nbsp;</strong> helps you identify your good and bad times.\r\n                                Use it to\r\n                                organize your life better and navigate through ups and downs.</li>\r\n                            <li><strong>Reveals Your Purpose in Life:</strong>&nbsp;Your Kundli reveals your life\'s purpose,\r\n                                destiny, and\r\n                                karmic patterns. It\'s like a road map for your journey.</li>\r\n                            <li><strong>Helps in Taking Better Decisions:&nbsp;</strong> the help of a kundali calculator,\r\n                                you can receive\r\n                                personalized guidance to organize your life and make better decisions about career,\r\n                                education, love, marriage, money, and family.</li>\r\n                            <li><strong>Deal With Doshas:</strong>&nbsp;Your Kundli can assist you in meeting challenges,\r\n                                overcoming\r\n                                obstacles, and dealing with doshas. Also, it offers advice on how to overcome life\'s\r\n                                challenges and improve your overall well-being.</li>\r\n                            <li><strong>Navigate Issues in Relationships:&nbsp;</strong> your Janam Kundali can help you\r\n                                navigate\r\n                                relationships with family, friends, and partners. It helps you understand your\r\n                                compatibility, fix any communication issues, and explore areas for growth, allowing you\r\n                                to build stronger and more harmonious connections.</li>\r\n                            <li><strong>Improve Your Current Situation:</strong>&nbsp;Our free janam kundali analysis will\r\n                                help you overcome\r\n                                any osbtacles you may face in the future or are currently dealing with. This will\r\n                                enhance your current well-being and even help in achieving success ahead.</li>\r\n                            <li><strong>Deeper Understanding of Yourself:</strong>&nbsp;Connecting with your Kundli can help\r\n                                you gain a deeper\r\n                                understanding of who you are and increase your self-awareness. It functions as a manual\r\n                                for personal development and self-discovery.</li>\r\n                            <li><strong>Health &amp; Spiritual Growth:</strong>&nbsp;It gives clues about your health, mental\r\n                                well-being, and\r\n                                spiritual journey. It\'s like a guide to how you\'re feeling physically, mentally, and\r\n                                spiritually.</li>\r\n                            <li><strong>Guide to Wellness &amp; Growth:</strong>&nbsp;Your Kundli helps you understand spiritual\r\n                                development and\r\n                                the meaning of your life. It leads you in the direction of purpose and self-discovery.\r\n                            </li>\r\n                        </ul>\r\n                    </div>',0,'2026-09-07 03:03:31','2026-09-07 03:03:31');
/*!40000 ALTER TABLE `free_kundli_guides` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `free_kundli_sections`
--

DROP TABLE IF EXISTS `free_kundli_sections`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `free_kundli_sections` (
  `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `main_heading` varchar(255) NOT NULL DEFAULT 'Kundli',
  `description` text DEFAULT NULL,
  `main_image` varchar(255) DEFAULT NULL,
  `titles` text DEFAULT NULL,
  `images` longtext DEFAULT NULL,
  `is_active` tinyint(1) NOT NULL DEFAULT 1,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `free_kundli_sections`
--

LOCK TABLES `free_kundli_sections` WRITE;
/*!40000 ALTER TABLE `free_kundli_sections` DISABLE KEYS */;
INSERT INTO `free_kundli_sections` VALUES (1,'Kundli','A Kundli or Kundali is also known as the birth chart, is simply an astrological chart that provides insights into your life events by analyzing positions of celestial bodies. Consider it the horoscope by date of birth, as it only uses your date of birth, place, and time.','uploads/free_kundli/1788762805_main_6a9e5ab5b1b41.png','UNDLI, MATCHING, ASCENDANT, MAHADASHA, DOSHA, HOUSE, YOG, DASHA, LOVE, TYPES, MARRIAGE','[\"uploads\\/free_kundli\\/1788779183_6a9e9aaf42b71.png\",\"uploads\\/free_kundli\\/1788779183_6a9e9aaf43c83.png\",\"uploads\\/free_kundli\\/1788779183_6a9e9aaf443fa.png\",\"uploads\\/free_kundli\\/1788779183_6a9e9aaf44b57.png\",\"uploads\\/free_kundli\\/1788779183_6a9e9aaf45327.png\",\"uploads\\/free_kundli\\/1788779183_6a9e9aaf45aaa.png\",\"uploads\\/free_kundli\\/1788779183_6a9e9aaf46237.png\",\"uploads\\/free_kundli\\/1788779183_6a9e9aaf46af2.png\",\"uploads\\/free_kundli\\/1788779183_6a9e9aaf478e4.png\",\"uploads\\/free_kundli\\/1788779183_6a9e9aaf48250.png\",\"uploads\\/free_kundli\\/1788779183_6a9e9aaf489f9.png\"]',1,'2026-09-07 01:03:25','2026-09-07 05:36:23');
/*!40000 ALTER TABLE `free_kundli_sections` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `goodies`
--

DROP TABLE IF EXISTS `goodies`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `goodies` (
  `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `section_title` varchar(255) DEFAULT NULL,
  `titles` text DEFAULT NULL,
  `images` text DEFAULT NULL,
  `image_alts` text DEFAULT NULL,
  `links` text DEFAULT NULL,
  `is_active` tinyint(1) NOT NULL DEFAULT 1,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `goodies_is_active_index` (`is_active`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `goodies`
--

LOCK TABLES `goodies` WRITE;
/*!40000 ALTER TABLE `goodies` DISABLE KEYS */;
INSERT INTO `goodies` VALUES (1,'Goodies for Good Times','Gemstone, Rudraksha, Online Puja, Yantra','uploads/goodies/goodies_6a9a62c2a95b4.png,uploads/goodies/goodies_6a9a62c2aa2e2.png,uploads/goodies/goodies_6a9a62c2aafb4.png,uploads/goodies/goodies_6a9a62c2ab952.png','gemstone_goodies, rudraksha_goodies, online_puja_goodies, yantra_goodies',NULL,1,'2026-09-04 00:41:09','2026-09-04 00:48:42');
/*!40000 ALTER TABLE `goodies` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `horoscope_contents`
--

DROP TABLE IF EXISTS `horoscope_contents`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `horoscope_contents` (
  `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `content` longtext DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `horoscope_contents`
--

LOCK TABLES `horoscope_contents` WRITE;
/*!40000 ALTER TABLE `horoscope_contents` DISABLE KEYS */;
INSERT INTO `horoscope_contents` VALUES (3,'<div class=\"free_online_kundli\">\r\n                        <p>The New Year brings new possibilities for everyone, but how do we identify which\r\n                            opportunities are truly meant for us? The simplest way is through your Yearly Horoscope,\r\n                            prepared by highly experienced Vedic astrologers who study planetary movements and their\r\n                            impact on your life. This detailed horoscope helps you understand how different aspects of\r\n                            your life—such as love, marriage, career, finances, and health—may change in the coming\r\n                            year, allowing you to make confident and informed decisions for a better future.\r\n                        </p>\r\n                        <p>Your Yearly Horoscope acts as a personal guide for the upcoming year, helping you navigate\r\n                            life with clarity and confidence. By analyzing planetary shifts and their influence on your\r\n                            emotions, decisions, and circumstances, astrologers provide insights into the opportunities\r\n                            and challenges you may encounter. With this valuable knowledge, you can plan ahead,\r\n                            strengthen important areas of life, and make choices that align with your growth, success,\r\n                            and overall well-being.</p>\r\n\r\n                    </div>\r\n                    <div class=\"free_online_kundli\">\r\n                        <h4 class=\"text-center mb-4\"> Complimentary astrology services\r\n                        </h4>\r\n                        <div class=\"row g-4\">\r\n                            <div class=\"col-lg-3 col-md-6\">\r\n                                <div class=\"complimentary_card\">\r\n                                    <div class=\"comp_icon\">\r\n                                        <i class=\"fa-regular fa-sun\"></i>\r\n                                    </div>\r\n                                    <h5 class=\"comp_title\">Today\'s Horoscope</h5>\r\n                                    <p class=\"comp_text\">Unsure about how your day will unfold? Get free Aries horoscope\r\n                                        online prediction from top astrologer. Read your Aries Zodiac Sign Horoscope\r\n                                        today!</p>\r\n                                </div>\r\n                            </div>\r\n\r\n                            <div class=\"col-lg-3 col-md-6\">\r\n                                <div class=\"complimentary_card\">\r\n                                    <div class=\"comp_icon\">\r\n                                        <i class=\"fa-solid fa-border-all\"></i>\r\n                                    </div>\r\n                                    <h5 class=\"comp_title\">Free kundli</h5>\r\n                                    <p class=\"comp_text\">Generate your free online kundli report from Astrotalk. Our\r\n                                        Kundli software can help you predict the future for yourself by reading the\r\n                                        birth chart.</p>\r\n                                </div>\r\n                            </div>\r\n\r\n                            <div class=\"col-lg-3 col-md-6\">\r\n                                <div class=\"complimentary_card\">\r\n                                    <div class=\"comp_icon\">\r\n                                        <i class=\"fa-solid fa-user-group\"></i>\r\n                                    </div>\r\n                                    <h5 class=\"comp_title\">Compatibility</h5>\r\n                                    <p class=\"comp_text\">Confused by love? Remove the doubts &amp; find the sparks! Check\r\n                                        the compatibility with your partner using our tool and ignite a love that lasts\r\n                                        forever.</p>\r\n                                </div>\r\n                            </div>\r\n\r\n                            <div class=\"col-lg-3 col-md-6\">\r\n                                <div class=\"complimentary_card\">\r\n                                    <div class=\"comp_icon\">\r\n                                        <i class=\"fa-solid fa-fire\"></i>\r\n                                    </div>\r\n                                    <h5 class=\"comp_title\">Festival 2024</h5>\r\n                                    <p class=\"comp_text\">Festivals are myriad celebrations, each a unique form of joy.\r\n                                        Explore the diverse world of festivities – a realm of celebration</p>\r\n                                </div>\r\n                            </div>\r\n                        </div>\r\n                    </div>','2026-09-09 03:33:07','2026-09-09 03:33:07');
/*!40000 ALTER TABLE `horoscope_contents` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `kundli_blogs`
--

DROP TABLE IF EXISTS `kundli_blogs`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `kundli_blogs` (
  `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `title` varchar(255) NOT NULL,
  `link` varchar(255) DEFAULT '#',
  `image` varchar(255) DEFAULT NULL,
  `author_name` varchar(255) NOT NULL DEFAULT 'Team Astroyogi',
  `author_image` varchar(255) DEFAULT NULL,
  `published_date` date DEFAULT NULL,
  `sort_order` int(11) NOT NULL DEFAULT 0,
  `is_active` tinyint(1) NOT NULL DEFAULT 1,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=6 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `kundli_blogs`
--

LOCK TABLES `kundli_blogs` WRITE;
/*!40000 ALTER TABLE `kundli_blogs` DISABLE KEYS */;
INSERT INTO `kundli_blogs` VALUES (3,'8th House Lord in 4th House: What Does It Mean for You in Astrology?','#','uploads/kundli_blogs/blog_1788776344_6a9e8f98e10a7.png','Team Astroyogi','uploads/kundli_blogs/author_1788776344_6a9e8f98e14af.png','2026-09-07',1,0,'2026-09-07 04:49:04','2026-09-07 04:49:04'),(4,'How the 4th Lord in 7th House Affects Your Relationships and Home','#','uploads/kundli_blogs/blog_1788777120_6a9e92a0b76db.png','Team Astroyogi','uploads/kundli_blogs/author_1788777120_6a9e92a0b7b65.png','2026-09-07',2,0,'2026-09-07 05:02:00','2026-09-07 05:02:00'),(5,'How the 9th Lord in 1st House Shapes Your Personality and Destiny','#','uploads/kundli_blogs/blog_1788777165_6a9e92cdb373f.png','Team Astroyogi','uploads/kundli_blogs/author_1788777165_6a9e92cdb3b26.png','2026-09-07',3,0,'2026-09-07 05:02:45','2026-09-07 05:02:45');
/*!40000 ALTER TABLE `kundli_blogs` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `kundli_faq_contents`
--

DROP TABLE IF EXISTS `kundli_faq_contents`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `kundli_faq_contents` (
  `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `title` varchar(255) NOT NULL DEFAULT 'FAQ',
  `content` longtext DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `kundli_faq_contents`
--

LOCK TABLES `kundli_faq_contents` WRITE;
/*!40000 ALTER TABLE `kundli_faq_contents` DISABLE KEYS */;
INSERT INTO `kundli_faq_contents` VALUES (1,'FAQ','<div class=\"accordion\" id=\"faqAccordion\">\r\n\r\n                                    <div class=\"accordion-item\">\r\n                                        <h2 class=\"accordion-header\">\r\n                                            <button class=\"accordion-button collapsed\" type=\"button\" data-bs-toggle=\"collapse\" data-bs-target=\"#faq1\">\r\n                                                What is the Lagna Chart?\r\n                                            </button>\r\n                                        </h2>\r\n                                        <div id=\"faq1\" class=\"accordion-collapse collapse\" data-bs-parent=\"#faqAccordion\">\r\n                                            <div class=\"accordion-body\">\r\n                                                Lagna Chart is the main birth chart in Vedic astrology that shows the\r\n                                                planetary positions at the time of birth.\r\n                                            </div>\r\n                                        </div>\r\n                                    </div>\r\n\r\n                                    <div class=\"accordion-item\">\r\n                                        <h2 class=\"accordion-header\">\r\n                                            <button class=\"accordion-button collapsed\" type=\"button\" data-bs-toggle=\"collapse\" data-bs-target=\"#faq2\">\r\n                                                How to read Kundli or Lagna Chart?\r\n                                            </button>\r\n                                        </h2>\r\n                                        <div id=\"faq2\" class=\"accordion-collapse collapse\" data-bs-parent=\"#faqAccordion\">\r\n                                            <div class=\"accordion-body\">\r\n                                                Read the ascendant, planets, zodiac signs, and houses to understand\r\n                                                different aspects of life.\r\n                                            </div>\r\n                                        </div>\r\n                                    </div>\r\n\r\n                                    <div class=\"accordion-item\">\r\n                                        <h2 class=\"accordion-header\">\r\n                                            <button class=\"accordion-button collapsed\" type=\"button\" data-bs-toggle=\"collapse\" data-bs-target=\"#faq3\">\r\n                                                How to read Kundali houses?\r\n                                            </button>\r\n                                        </h2>\r\n                                        <div id=\"faq3\" class=\"accordion-collapse collapse\" data-bs-parent=\"#faqAccordion\">\r\n                                            <div class=\"accordion-body\">\r\n                                                Each house represents different life areas like career, marriage,\r\n                                                education, health, and wealth.\r\n                                            </div>\r\n                                        </div>\r\n                                    </div>\r\n\r\n                                    <div class=\"accordion-item\">\r\n                                        <h2 class=\"accordion-header\">\r\n                                            <button class=\"accordion-button collapsed\" type=\"button\" data-bs-toggle=\"collapse\" data-bs-target=\"#faq4\">\r\n                                                Is Kundli 100% correct?\r\n                                            </button>\r\n                                        </h2>\r\n                                        <div id=\"faq4\" class=\"accordion-collapse collapse\" data-bs-parent=\"#faqAccordion\">\r\n                                            <div class=\"accordion-body\">\r\n                                                Kundli provides astrological guidance based on planetary positions and\r\n                                                should be considered as guidance.\r\n                                            </div>\r\n                                        </div>\r\n                                    </div>\r\n\r\n                                    <div class=\"accordion-item\">\r\n                                        <h2 class=\"accordion-header\">\r\n                                            <button class=\"accordion-button collapsed\" type=\"button\" data-bs-toggle=\"collapse\" data-bs-target=\"#faq5\">\r\n                                                What is the Navamsa chart?\r\n                                            </button>\r\n                                        </h2>\r\n                                        <div id=\"faq5\" class=\"accordion-collapse collapse\" data-bs-parent=\"#faqAccordion\">\r\n                                            <div class=\"accordion-body\">\r\n                                                Navamsa Chart is an important divisional chart mainly used for marriage\r\n                                                and spiritual analysis.\r\n                                            </div>\r\n                                        </div>\r\n                                    </div>\r\n\r\n                                    <div class=\"accordion-item\">\r\n                                        <h2 class=\"accordion-header\">\r\n                                            <button class=\"accordion-button collapsed\" type=\"button\" data-bs-toggle=\"collapse\" data-bs-target=\"#faq6\">\r\n                                                Why Are Your Date of Birth and Time Important for Your Kundli?\r\n                                            </button>\r\n                                        </h2>\r\n                                        <div id=\"faq6\" class=\"accordion-collapse collapse\" data-bs-parent=\"#faqAccordion\">\r\n                                            <div class=\"accordion-body\">\r\n                                                Accurate birth date and time ensure correct planetary positions in your\r\n                                                Kundli.\r\n                                            </div>\r\n                                        </div>\r\n                                    </div>\r\n\r\n                                </div>','2026-09-14 23:20:51','2026-09-14 23:20:51');
/*!40000 ALTER TABLE `kundli_faq_contents` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `kundli_matches`
--

DROP TABLE IF EXISTS `kundli_matches`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `kundli_matches` (
  `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `user_id` bigint(20) unsigned DEFAULT NULL,
  `boy_name` varchar(255) NOT NULL,
  `boy_dob` date NOT NULL,
  `boy_tob` time NOT NULL,
  `boy_place` varchar(255) NOT NULL,
  `boy_rashi` varchar(255) DEFAULT NULL,
  `boy_nakshatra` varchar(255) DEFAULT NULL,
  `girl_name` varchar(255) NOT NULL,
  `girl_dob` date NOT NULL,
  `girl_tob` time NOT NULL,
  `girl_place` varchar(255) NOT NULL,
  `girl_rashi` varchar(255) DEFAULT NULL,
  `girl_nakshatra` varchar(255) DEFAULT NULL,
  `total_score` decimal(4,1) NOT NULL,
  `verdict_status` varchar(255) NOT NULL,
  `score_breakdown` longtext CHARACTER SET utf8mb4 COLLATE utf8mb4_bin DEFAULT NULL CHECK (json_valid(`score_breakdown`)),
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `kundli_matches_user_id_foreign` (`user_id`),
  CONSTRAINT `kundli_matches_user_id_foreign` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE SET NULL
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `kundli_matches`
--

LOCK TABLES `kundli_matches` WRITE;
/*!40000 ALTER TABLE `kundli_matches` DISABLE KEYS */;
INSERT INTO `kundli_matches` VALUES (1,1,'Rahul Sharma','2000-04-16','12:00:00','Jaipur','Capricorn','Uttara Ashadha','Priya Verma','2002-09-23','12:00:00','jaipur','Sagittarius','Purva Ashadha',24.0,'Good / Acceptable Match','{\"varna\":{\"name\":\"Varna (Spiritual)\",\"max\":1,\"obtained\":1},\"vashya\":{\"name\":\"Vashya (Dominance)\",\"max\":2,\"obtained\":0},\"tara\":{\"name\":\"Tara (Destiny & Health)\",\"max\":3,\"obtained\":3},\"yoni\":{\"name\":\"Yoni (Physical & Intimacy)\",\"max\":4,\"obtained\":3},\"maitri\":{\"name\":\"Graha Maitri (Mental Harmony)\",\"max\":5,\"obtained\":3},\"gana\":{\"name\":\"Gana (Temperament)\",\"max\":6,\"obtained\":6},\"bhakoot\":{\"name\":\"Bhakoot (Emotional & Family)\",\"max\":7,\"obtained\":0},\"nadi\":{\"name\":\"Nadi (Genetics & Progeny)\",\"max\":8,\"obtained\":8}}','2026-09-08 05:16:03','2026-09-08 05:16:03'),(2,3,'Rahul Sharma','2002-06-04','12:00:00','Jaipur','Scorpio','Anuradha','Priya Verma','2000-08-03','12:00:00','jaipur','Capricorn','Shravana',27.5,'Good / Acceptable Match','{\"varna\":{\"name\":\"Varna (Spiritual)\",\"max\":1,\"obtained\":1},\"vashya\":{\"name\":\"Vashya (Dominance)\",\"max\":2,\"obtained\":1},\"tara\":{\"name\":\"Tara (Destiny & Health)\",\"max\":3,\"obtained\":1.5},\"yoni\":{\"name\":\"Yoni (Physical & Intimacy)\",\"max\":4,\"obtained\":2},\"maitri\":{\"name\":\"Graha Maitri (Mental Harmony)\",\"max\":5,\"obtained\":1},\"gana\":{\"name\":\"Gana (Temperament)\",\"max\":6,\"obtained\":6},\"bhakoot\":{\"name\":\"Bhakoot (Emotional & Family)\",\"max\":7,\"obtained\":7},\"nadi\":{\"name\":\"Nadi (Genetics & Progeny)\",\"max\":8,\"obtained\":8}}','2026-09-08 23:29:15','2026-09-08 23:29:15');
/*!40000 ALTER TABLE `kundli_matches` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `matching_cta_sections`
--

DROP TABLE IF EXISTS `matching_cta_sections`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `matching_cta_sections` (
  `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `title` text NOT NULL,
  `btn1_text` varchar(255) NOT NULL DEFAULT 'Talk to Astrologer',
  `btn1_link` varchar(255) NOT NULL DEFAULT 'chat-astrologer',
  `btn2_text` varchar(255) NOT NULL DEFAULT 'Chat with Astrologer',
  `btn2_link` varchar(255) NOT NULL DEFAULT '#',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `matching_cta_sections`
--

LOCK TABLES `matching_cta_sections` WRITE;
/*!40000 ALTER TABLE `matching_cta_sections` DISABLE KEYS */;
INSERT INTO `matching_cta_sections` VALUES (1,'Connect with an Astrologer on Call or Chat for more personalised detailed predictions.','Talk to Astrologer','#','Chat with Astrologer','#','2026-09-07 07:01:14','2026-09-07 07:04:20');
/*!40000 ALTER TABLE `matching_cta_sections` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `matching_guides`
--

DROP TABLE IF EXISTS `matching_guides`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `matching_guides` (
  `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `title` varchar(255) NOT NULL DEFAULT 'Kundli Matching Guide & Overview',
  `content` longtext DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `matching_guides`
--

LOCK TABLES `matching_guides` WRITE;
/*!40000 ALTER TABLE `matching_guides` DISABLE KEYS */;
INSERT INTO `matching_guides` VALUES (1,'Kundli Matching Guide & Overview','<div class=\"free_online_kundli\">\r\n                        <h4 class=\"text-center\">Kundli Matching: Kundli Gun Milan A Friend or a Foe?</h4>\r\n                        <p>When families ask for kundli gun milan before marriage, many couples start feeling nervous.\r\n                            They think, will this ancient method support our love or break us apart? Sometimes, low gun\r\n                            scores scare people. But expert astrologers say kundli gun milan is not a final judgment.&nbsp;\r\n                        </p>\r\n                        <p>It’s more like a guide. It shows where your bond is strong and where you may need to put in\r\n                            extra effort. It doesn’t decide your fate, but helps you understand each other better.\r\n                            Knowing your match through gun milan can make you more aware of what to improve together.&nbsp;\r\n                        </p>\r\n                        <p>It’s not your enemy it’s like a helpful friend. When used right, kundli gun milan can\r\n                            actually make your relationship stronger and prepare you better for married life.</p>\r\n                    </div>\r\n\r\n\r\n                    <div class=\"free_online_kundli\">\r\n                        <h4 class=\"text-center\">What is Kundli Milan - A Friend Or A Foe?</h4>\r\n                        <p>Some people feel that kundli matching might create confusion in their love life. They worry\r\n                            that a low gun milan score could make it harder for their families to accept the marriage.\r\n                            But experienced astrologers say that kundali matching is more like a helpful guide than a\r\n                            problem.</p>\r\n                        <p>Think of it like a map, it shows the way but doesn’t decide the destination. Kundali matching\r\n                            by name and date of birth helps highlight the good parts of a relationship and the areas\r\n                            that may need extra care. It doesn’t stop love; instead, it supports it by showing possible\r\n                            challenges in advance.</p>\r\n                        <p>When couples know what to expect, they can handle situations better. This way, love grows\r\n                            stronger with understanding and preparation. So, kundli matching is not a barrier—it\'s a\r\n                            tool that helps couples walk their path together with more clarity.</p>\r\n                    </div>\r\n\r\n                    <div class=\"free_online_kundli\">\r\n                        <h4 class=\"text-center\">What Happens During Kundli Milan?</h4>\r\n                        <p>Kundli Milan online is the process where astrologers compare the birth charts of two people\r\n                            to check if they are a good marriage match. Kundli match making helps you understand\r\n                            compatibility based on ancient astrological principles like Ashtakoota. They study the\r\n                            positions of planets, moon signs, and eight key points, known as Ashtakoota Milan. Marriage\r\n                            kundali matching checks long-term compatibility to help couples start their journey with\r\n                            clarity and trust.</p>\r\n                        <p>First, they make separate charts using the exact date, time, and place of birth. Then, they\r\n                            match both charts and give a score based on compatibility. But it’s not just about numbers.\r\n                            Expert astrologers also give advice and solutions. Astrotalk kundli matching services\r\n                            explain everything clearly and also guide you about marriage timing and any possible issues.\r\n                        </p>\r\n\r\n\r\n                    </div>\r\n                    <div class=\"free_online_kundli\">\r\n                        <h4 class=\"text-center\">What are The 8 Factors in Kundli Matching (Ashtakoota Milan)</h4>\r\n                        <h2 class=\"text-center\">Kundali matching for marriage helps find emotional, physical, and\r\n                            spiritual harmony between\r\n                            partners.</h2>\r\n                    </div>\r\n\r\n                    <div class=\"free_online_kundli\">\r\n                        <h4 class=\"text-center\">🪐 Varna</h4>\r\n                        <p>Varna compatibility tells us how spiritually and mentally balanced two people are. It checks\r\n                            if one partner may try to control the other. This match carries 1 point in Gun Milan. If\r\n                            Varna matches well, both partners respect each other’s thoughts and grow together, making\r\n                            their bond stronger and filled with mutual support and understanding.</p>\r\n                    </div>\r\n\r\n\r\n                    <div class=\"free_online_kundli\">\r\n                        <h4 class=\"text-center\">🔱 Vashya</h4>\r\n                        <p>Vashya shows how much control or influence one partner may have over the other in a\r\n                            relationship. It gets 2 points in Kundli matching. If the score is good, both partners\r\n                            understand and influence each other well. If not, it may lead to control issues. But with\r\n                            remedies, these issues can be balanced for a happy marriage.</p>\r\n                    </div>\r\n\r\n                    <div class=\"free_online_kundli\">\r\n                        <h4 class=\"text-center\">⭐ Tara</h4>\r\n                        <p>Tara\'s compatibility is about the health and happiness of a couple. It checks if both\r\n                            partners will stay physically and mentally strong together. It gives 3 points in kundali\r\n                            match making. When Tara matches well, couples stay healthy, support each other, and grow\r\n                            together. Their teamwork brings peace, success, and good results in life.</p>\r\n                    </div>\r\n\r\n                    <div class=\"free_online_kundli\">\r\n                        <h4 class=\"text-center\">🔔 Well\r\n                        </h4>\r\n                        <p>Yoni compatibility checks how well two people match physically and emotionally. It’s\r\n                            important for love, closeness, and a happy married life. In Kundali matching, this factor\r\n                            gets 4 points. Good Yoni compatibility means strong attraction and bonding. It also helps\r\n                            show if a couple can stay close and keep the spark alive in their relationship.</p>\r\n                    </div>\r\n\r\n                    <div class=\"free_online_kundli\">\r\n                        <h4 class=\"text-center\">🧭 Rasyadhipati\r\n                        </h4>\r\n                        <p>Rasyadhipati tells how well two people connect mentally and become good friends. It checks\r\n                            how smoothly they talk and understand each other. In gun milan by date of birth, it gives 5\r\n                            points. Good Rasyadhipati means couples think alike, support each other’s ideas, and build a\r\n                            strong friendship making their bond happy and long-lasting.</p>\r\n                    </div>\r\n\r\n                    <div class=\"free_online_kundli\">\r\n                        <h4 class=\"text-center\">🌕 Gana\r\n                        </h4>\r\n                        <p>Gana compatibility checks how two people’s nature and behavior match. It tells if they will\r\n                            get along easily or face differences. This part gives 6 points in kundli matching. If Ganas\r\n                            match, couples can similarly handle stress. Even different Ganas can work well together if\r\n                            they understand each other and adjust in social or family life.</p>\r\n                    </div>\r\n\r\n                    <div class=\"free_online_kundli\">\r\n                        <h4 class=\"text-center\"> 🐚 Rashi\r\n                        </h4>\r\n                        <p>Rashi compatibility checks how well two people understand each other\'s feelings. It is based\r\n                            on moon signs and gives 7 points in marriage compatibility by date of birth. When Rashi\r\n                            compatibility is strong, couples feel safe, understood, and emotionally close. They support\r\n                            each other better during tough times, which helps build trust and a strong bond in the\r\n                            relationship.</p>\r\n                    </div>\r\n\r\n\r\n                    <div class=\"free_online_kundli\">\r\n                        <h4 class=\"text-center\"> 🪔 Nandi\r\n                        </h4>\r\n\r\n                        <p>Nandi compatibility is about happiness, children, and family growth. It helps check if a\r\n                            couple can have kids and build a happy family. This part gives 8 points in the AstroTalk\r\n                            kundali matching score. Good Nandi compatibility means a joyful life, healthy children, and\r\n                            a peaceful home. It also supports the couple’s success and family development together.</p>\r\n                    </div>\r\n\r\n\r\n\r\n                    <div class=\"free_online_kundli\">\r\n                        <h4 class=\"text-center\"> Kundli Gun Milan Score – What Does It Mean?\r\n                        </h4>\r\n                        <p>Gun Milan scoring helps you easily understand how well two people match for marriage. If the\r\n                            score is more than 24, it means a strong and happy match. If it’s between 18 and 24, it\r\n                            shows a good match with a few things to work on. Don’t worry, simple astrological remedies\r\n                            can help. Even with average scores, many couples live happily. If the score is below 18,\r\n                            there might be bigger problems, but that doesn’t mean the end. With the help of expert\r\n                            astrologers, remedies, and true love, many challenges in gun milan can be solved\r\n                            successfully. In India, kundli matching for marriage is still one of the most trusted ways\r\n                            to ensure a happy and successful union.</p>\r\n                    </div>\r\n\r\n                    <div class=\"free_online_kundli\">\r\n                        <h4 class=\"text-center\">How to Avail Kundli Matching Service Online?\r\n                        </h4>\r\n                        <ul>\r\n                            <li><strong>Step 1:&nbsp;</strong> Start by picking a trusted astrology website like AstroTalk.\r\n                                It\'s known for\r\n                                giving correct and reliable kundli matching results.</li>\r\n                            <li><strong>Step 2:&nbsp;</strong> Now, gather some simple birth details—date of birth, time of\r\n                                birth, and place of\r\n                                birth—for both people.</li>\r\n                            <li><strong>Step 3:&nbsp;</strong> Enter the details into the online kundali matching form. In\r\n                                seconds, you’ll get\r\n                                insights about your compatibility.</li>\r\n                            <li><strong>Step 4:&nbsp;</strong> Don’t know the exact time? No worries! Many sites offer kundli\r\n                                matching by name\r\n                                and date of birth too.</li>\r\n                            <li><strong>Step 5:&nbsp;</strong> websites give free kundali milan, while others offer paid,\r\n                                detailed reports\r\n                                with more guidance.</li>\r\n                            <li><strong>Step 6:&nbsp;</strong> you want more clarity, you can talk to expert astrologers who\r\n                                explain\r\n                                everything in a simple, friendly way.</li>\r\n                            <li><strong>Step 7:&nbsp;</strong> on your match, they may also suggest easy remedies or\r\n                                solutions to improve\r\n                                compatibility.</li>\r\n                            <li><strong>Step 8:</strong> &nbsp;You can even get advice anytime over the phone—from anywhere\r\n                                in\r\n                                the world.</li>\r\n\r\n                        </ul>\r\n                    </div>\r\n\r\n                    <div class=\"free_online_kundli\">\r\n                        <h4 class=\"text-center\"> Why Choose Our Kundli Matching?\r\n                        </h4>\r\n                        <p>Professional kundali matching Astrotalk services are better than free online tools in many\r\n                            ways. Real astrologers give personal advice that computer reports can’t. They don’t just\r\n                            check gun milan but also see things like doshas, planets, and the right time for marriage.&nbsp;\r\n                        </p>\r\n                        <p>They also give simple and helpful remedies that work in real life. These experts help you\r\n                            understand your relationship better. Good kundli matching services support you even after\r\n                            marriage.&nbsp;</p>\r\n                        <p>They guide you about the best time to marry, how to improve compatibility, and how to keep\r\n                            peace in the family. These astrologers become your trusted marriage guides.</p>\r\n                    </div>\r\n                    <div class=\"free_online_kundli\">\r\n                        <h4 class=\"text-center mb-4\"> Complimentary astrology services\r\n                        </h4>\r\n                        <div class=\"row g-4\">\r\n                            <div class=\"col-lg-3 col-md-6\">\r\n                                <div class=\"complimentary_card\">\r\n                                    <div class=\"comp_icon\">\r\n                                        <i class=\"fa-regular fa-sun\"></i>\r\n                                    </div>\r\n                                    <h5 class=\"comp_title\">Today\'s Horoscope</h5>\r\n                                    <p class=\"comp_text\">Unsure about how your day will unfold? Get free Aries horoscope\r\n                                        online prediction from top astrologer. Read your Aries Zodiac Sign Horoscope\r\n                                        today!</p>\r\n                                </div>\r\n                            </div>\r\n\r\n                            <div class=\"col-lg-3 col-md-6\">\r\n                                <div class=\"complimentary_card\">\r\n                                    <div class=\"comp_icon\">\r\n                                        <i class=\"fa-solid fa-border-all\"></i>\r\n                                    </div>\r\n                                    <h5 class=\"comp_title\">Free kundli</h5>\r\n                                    <p class=\"comp_text\">Generate your free online kundli report from Astrotalk. Our\r\n                                        Kundli software can help you predict the future for yourself by reading the\r\n                                        birth chart.</p>\r\n                                </div>\r\n                            </div>\r\n\r\n                            <div class=\"col-lg-3 col-md-6\">\r\n                                <div class=\"complimentary_card\">\r\n                                    <div class=\"comp_icon\">\r\n                                        <i class=\"fa-solid fa-user-group\"></i>\r\n                                    </div>\r\n                                    <h5 class=\"comp_title\">Compatibility</h5>\r\n                                    <p class=\"comp_text\">Confused by love? Remove the doubts &amp; find the sparks! Check\r\n                                        the compatibility with your partner using our tool and ignite a love that lasts\r\n                                        forever.</p>\r\n                                </div>\r\n                            </div>\r\n\r\n                            <div class=\"col-lg-3 col-md-6\">\r\n                                <div class=\"complimentary_card\">\r\n                                    <div class=\"comp_icon\">\r\n                                        <i class=\"fa-solid fa-fire\"></i>\r\n                                    </div>\r\n                                    <h5 class=\"comp_title\">Festival 2024</h5>\r\n                                    <p class=\"comp_text\">Festivals are myriad celebrations, each a unique form of joy.\r\n                                        Explore the diverse world of festivities – a realm of celebration</p>\r\n                                </div>\r\n                            </div>\r\n                        </div>\r\n                    </div>','2026-09-08 00:25:09','2026-09-08 00:25:09');
/*!40000 ALTER TABLE `matching_guides` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `matching_heroes`
--

DROP TABLE IF EXISTS `matching_heroes`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `matching_heroes` (
  `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `image` varchar(255) DEFAULT NULL,
  `title` varchar(255) NOT NULL DEFAULT 'Kundli Matching',
  `subtitle` varchar(255) DEFAULT 'Find your right one, through matchmaking',
  `description` text DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `matching_heroes`
--

LOCK TABLES `matching_heroes` WRITE;
/*!40000 ALTER TABLE `matching_heroes` DISABLE KEYS */;
INSERT INTO `matching_heroes` VALUES (1,'uploads/matching/matching_hero_1788781738.png','Kundli Matching','Find your right one, through matchmaking','Have you ever thought, “Are we made for each other?” That’s where Kundli matching comes in. It\'s been a trusted way for Indian families to find the right life partner for generations. This method uses the age-old science of astrology to see if two people are truly compatible for a happy and peaceful marriage.','2026-09-07 06:18:58','2026-09-07 06:18:58');
/*!40000 ALTER TABLE `matching_heroes` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `online_astrologer_sections`
--

DROP TABLE IF EXISTS `online_astrologer_sections`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `online_astrologer_sections` (
  `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `sign_name` text DEFAULT NULL,
  `badge_class` text DEFAULT NULL,
  `image_alt` text DEFAULT NULL,
  `images` text DEFAULT NULL,
  `title` varchar(255) DEFAULT NULL,
  `description` text DEFAULT NULL,
  `is_active` tinyint(1) NOT NULL DEFAULT 1,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `online_astrologer_sections`
--

LOCK TABLES `online_astrologer_sections` WRITE;
/*!40000 ALTER TABLE `online_astrologer_sections` DISABLE KEYS */;
INSERT INTO `online_astrologer_sections` VALUES (2,'Aries, Taurus, Gemini, Cancer, Leo, Virgo, Libra, Scorpio, Sagittarius, Capricorn, Aquarius, Pisces','z-aries, z-taurus, z-gemini, z-cancer, z-leo, z-virgo, z-libra, z-scorpio, z-sagittarius, z-capricorn, z-aquarius, z-pisces','aries_zodiac_sign, taurus_zodiac_sign, gemini_zodiac_sign, cancer_zodiac_sign, leo_zodiac_sign, virgo_zodiac_sign, libra_zodiac_sign, scorpio_zodiac_sign, sagittarius_zodiac_sign, capricorn_zodiac_sign, aquarius_zodiac_sign, pisces_zodiac_sign','uploads/online_astrologer_section/zodiac_6a9944d60c4f9.svg,uploads/online_astrologer_section/zodiac_6a9944d60cd36.svg,uploads/online_astrologer_section/zodiac_6a9944d60d59a.svg,uploads/online_astrologer_section/zodiac_6a9944d60ddec.svg,uploads/online_astrologer_section/zodiac_6a9944d60e62c.svg,uploads/online_astrologer_section/zodiac_6a9944d60f1b7.svg,uploads/online_astrologer_section/zodiac_6a9944d60fccd.svg,uploads/online_astrologer_section/zodiac_6a9944d61054b.svg,uploads/online_astrologer_section/zodiac_6a9944d610e36.svg,uploads/online_astrologer_section/zodiac_6a9944d611644.svg,uploads/online_astrologer_section/zodiac_6a9944d611e7b.svg,uploads/online_astrologer_section/zodiac_6a9944d61276f.svg','Aries Love Horoscope','If you get a chance to display your presentation skills, don\'t lose it. Your eloquence may receive wide acclaim. Your children too may give you reason to be proud. Do remember to take time out for the elderly in your family.',1,'2026-09-03 04:28:46','2026-09-03 04:28:46');
/*!40000 ALTER TABLE `online_astrologer_sections` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `popular_posts`
--

DROP TABLE IF EXISTS `popular_posts`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `popular_posts` (
  `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `title` varchar(255) NOT NULL,
  `image` varchar(255) DEFAULT NULL,
  `image_alt` varchar(255) DEFAULT NULL,
  `link` varchar(255) NOT NULL DEFAULT '#',
  `sort_order` int(11) NOT NULL DEFAULT 0,
  `is_active` tinyint(1) NOT NULL DEFAULT 1,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `popular_posts_title_index` (`title`),
  KEY `popular_posts_sort_order_index` (`sort_order`),
  KEY `popular_posts_is_active_index` (`is_active`)
) ENGINE=InnoDB AUTO_INCREMENT=5 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `popular_posts`
--

LOCK TABLES `popular_posts` WRITE;
/*!40000 ALTER TABLE `popular_posts` DISABLE KEYS */;
INSERT INTO `popular_posts` VALUES (1,'Shopping Guide for Dhanteras Based on Your Zodiac','https://images.unsplash.com/photo-1610030469983-98e550d6193c?w=600&auto=format&fit=crop&q=80','Shopping Guide for Dhanteras','#',1,1,'2026-09-05 05:06:14','2026-09-05 05:06:14'),(2,'What To Avoid Bringing Home Diwali','https://images.unsplash.com/photo-1577083552431-6e5fd01aa342?w=600&auto=format&fit=crop&q=80','Avoid These Things','#',2,1,'2026-09-05 05:06:14','2026-09-05 05:06:14'),(3,'Perfect Bhai Dooj Gifts For Your Sister Based on Astrology','https://images.unsplash.com/photo-1513151233558-d860c5398176?w=600&auto=format&fit=crop&q=80','Bhai Dooj Gifts','#',3,1,'2026-09-05 05:06:14','2026-09-05 05:06:14'),(4,'Diwali Week: Astrological Predictions for 12 Zodiac Signs','https://images.unsplash.com/photo-1532968961962-8a0cb3a2d4f5?w=600&auto=format&fit=crop&q=80','Diwali Week Predictions','#',4,1,'2026-09-05 05:06:14','2026-09-05 05:06:14');
/*!40000 ALTER TABLE `popular_posts` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `shubh_muhurats`
--

DROP TABLE IF EXISTS `shubh_muhurats`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `shubh_muhurats` (
  `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `title` varchar(255) NOT NULL,
  `icon` varchar(255) NOT NULL DEFAULT '?',
  `sort_order` int(11) NOT NULL DEFAULT 0,
  `is_active` tinyint(1) NOT NULL DEFAULT 1,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `shubh_muhurats_title_index` (`title`),
  KEY `shubh_muhurats_sort_order_index` (`sort_order`),
  KEY `shubh_muhurats_is_active_index` (`is_active`)
) ENGINE=InnoDB AUTO_INCREMENT=15 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `shubh_muhurats`
--

LOCK TABLES `shubh_muhurats` WRITE;
/*!40000 ALTER TABLE `shubh_muhurats` DISABLE KEYS */;
INSERT INTO `shubh_muhurats` VALUES (1,'Abhijit Muhurat','🪔',1,1,'2026-09-04 11:54:55','2026-09-04 11:54:55'),(2,'Griha Pravesh','🪔',2,1,'2026-09-04 11:54:55','2026-09-04 11:54:55'),(3,'Vivah Muhurat','🪔',3,1,'2026-09-04 11:54:55','2026-09-04 11:54:55'),(4,'Namkaran Muhurat','🪔',4,1,'2026-09-04 11:54:55','2026-09-04 11:54:55'),(5,'Mundan Muhurat','🪔',5,1,'2026-09-04 11:54:55','2026-09-04 11:54:55'),(6,'Vahan Kharidi','🪔',6,1,'2026-09-04 11:54:55','2026-09-04 11:54:55'),(7,'Property Purchase','🪔',7,1,'2026-09-04 11:54:55','2026-09-04 11:54:55'),(8,'Upanayana Sanskar','🪔',8,1,'2026-09-04 11:54:55','2026-09-04 11:54:55'),(9,'Karnavedha','🪔',9,1,'2026-09-04 11:54:55','2026-09-04 11:54:55'),(10,'Annaprashan','🪔',10,1,'2026-09-04 11:54:55','2026-09-04 11:54:55'),(11,'Business Opening','🪔',11,1,'2026-09-04 11:54:55','2026-09-04 11:54:55'),(12,'Sarvartha Siddhi Yoga','🪔',12,1,'2026-09-04 11:54:55','2026-09-04 11:54:55'),(13,'Amrit Siddhi Yoga','🪔',13,1,'2026-09-04 11:54:55','2026-09-04 11:54:55'),(14,'Guru Pushya Yoga','🪔',14,1,'2026-09-04 11:54:55','2026-09-04 11:54:55');
/*!40000 ALTER TABLE `shubh_muhurats` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `talk_astrologer_helps`
--

DROP TABLE IF EXISTS `talk_astrologer_helps`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `talk_astrologer_helps` (
  `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `heading` varchar(255) DEFAULT NULL,
  `subheading` varchar(255) DEFAULT NULL,
  `content` longtext DEFAULT NULL,
  `is_active` tinyint(1) NOT NULL DEFAULT 1,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `talk_astrologer_helps`
--

LOCK TABLES `talk_astrologer_helps` WRITE;
/*!40000 ALTER TABLE `talk_astrologer_helps` DISABLE KEYS */;
INSERT INTO `talk_astrologer_helps` VALUES (1,'How Can Talking to an Astrologer Help You?','24×7 Astrology Consultation – Anytime, Anywhere','<p>\r\n                            Facing financial uncertainty? Or simply wondering what day to host that big-fat, dreamy and\r\n                            maybe sustainable wedding of yours? Well, AstroTalk’s astrology consultation services, which\r\n                            connect you with over 500 astrologers online, can be your one-stop destination to find\r\n                            answers to all such queries.\r\n                        </p>\r\n\r\n                        <p>\r\n                            If you ask a Vedic astrologer what prompts all the happenings in our life, they will tell\r\n                            you how it all circles around the movement and the shifting of planets. These Navgrahas, as\r\n                            we call them in astrology, not only shift up above us but also through the houses in our\r\n                            kundli. While one day Jupiter is in the second house of your Kundli, which is the house of\r\n                            finance, on the other, it might have shifted to the seventh, i.e. the house of partnership,\r\n                            relationship and such mushy traits. This shifting is what influences the life happenings,\r\n                            which is studied by the best astrologers.\r\n                        </p>\r\n\r\n                        <p>\r\n                            How does the shifting of planets from one house to another influence our life you might ask?\r\n                            Well, it simply depends on the trait of the planet which has shifted. For example, if\r\n                            Jupiter is camping the second house (house of finance) of your kundli, you might witness a\r\n                            surge in your finance or knowledge. But on the other hand, if the dreaded planet ketu is\r\n                            occupying that spot, you might witness a drain of wealth as the Ketu makes a person\r\n                            materialistic and prone to bad habits. After Ketu, another planet will camp in the same\r\n                            house bringing its own influences.\r\n                        </p>\r\n\r\n                        <h5>How does astrology consultation work?</h5>\r\n\r\n                        <p>\r\n                            While surely we can’t change the position of the planets but only negate their harmful\r\n                            effects on us. And in the process, online astrology consultation can help. If you are\r\n                            dealing with issues in life, you can, using Astrotalk’s platform, chat and talk to\r\n                            astrologers online and get solutions to such problems. Astrology consultation introduces\r\n                            numerous astrologers including Vedic astrologers, Tarot card readers, Numerologists, Vastu\r\n                            experts and so on who you can share your problem with and get solutions for the same.\r\n                        </p>\r\n\r\n                        <p>\r\n                            Meanwhile, you can also take astrology consultation online and call astrology to avail\r\n                            various other services like kundli matching, getting a handwritten janam kundli, vastu\r\n                            planning, finding out shubh muhurat for marriage, or buying a property and so\r\n                            on. AstroTalk offers exceptional astrology prediction services through its pool of\r\n                            astrologers who are highly qualified and versed in whatever they do. Besides 24*7\r\n                            availability, Astrotalk helps in ensuring your privacy is maintained, and you enjoy 100%\r\n                            customer satisfaction when you talk to astrologer online about anything and everything. If\r\n                            you want to talk to astrologer on phone, or talk to astrologer online, ask astrologer\r\n                            numerology, and also looking for astrologer near me, then Astrotalk is the best online\r\n                            platform for you to connect with the best Astrologers in India. To find Astrotalk online,\r\n                            just search the terms astrology phone consultation or astrologer on phone or call astrologer\r\n                            or talk to astrologer for free, and talk to Astro online. Astrotalk has a long list of top\r\n                            and best astrologers in India online. We are committed to offering you the best astrology\r\n                            services.\r\n                        </p>',1,'2026-09-05 03:35:17','2026-09-06 23:53:40');
/*!40000 ALTER TABLE `talk_astrologer_helps` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `yearly_horoscopes`
--

DROP TABLE IF EXISTS `yearly_horoscopes`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `yearly_horoscopes` (
  `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `zodiac_sign` varchar(50) NOT NULL,
  `title` varchar(150) NOT NULL,
  `year` varchar(10) NOT NULL DEFAULT '2026',
  `image` varchar(255) DEFAULT NULL,
  `description` text NOT NULL,
  `sort_order` int(11) NOT NULL DEFAULT 1,
  `status` tinyint(1) NOT NULL DEFAULT 1,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=13 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `yearly_horoscopes`
--

LOCK TABLES `yearly_horoscopes` WRITE;
/*!40000 ALTER TABLE `yearly_horoscopes` DISABLE KEYS */;
INSERT INTO `yearly_horoscopes` VALUES (1,'Aries','Aries Yearly Horoscope','2026','assets/images/hioroscope1.png','Love and Relationships: This year brings clarity and growth in your personal relationships. Singles may find someone truly special during mid-year, while those in committed relationships will deepen their bonds. Challenges may arise in the first quarter, requiring patience and open communication.',1,1,'2026-09-09 06:59:14','2026-09-09 06:59:14'),(2,'Taurus','Taurus Yearly Horoscope','2026','assets/images/hioroscope2.png','Love and Relationships: 2026 promises emotional growth and stability in your relationships, Taurus. Singles may encounter someone truly aligned with their values, especially during the second quarter. For those in committed relationships, this is a year of strengthening shared foundations.',2,1,'2026-09-09 06:59:14','2026-09-09 06:59:14'),(3,'Gemini','Gemini Yearly Horoscope','2026','assets/images/hioroscope3.png','Love and Relationships: 2026 is a year of exploration and connection for Gemini. Singles may find themselves drawn to someone intellectually stimulating during the second quarter. Those in relationships will focus on understanding their partner’s deeper emotional landscape.',3,1,'2026-09-09 06:59:14','2026-09-09 06:59:14'),(4,'Cancer','Cancer Yearly Horoscope','2026','assets/images/hioroscope4.png','Love and Relationships: 2026 brings emotional depth and harmony to your relationships, Cancer. Singles may encounter a soulmate connection during the second half of the year, especially around August. For couples, this year provides pathways to heal and flourish.',4,1,'2026-09-09 06:59:14','2026-09-09 06:59:14'),(5,'Leo','Leo Yearly Horoscope','2026','assets/images/hioroscope5.png','Love and Relationships: 2026 will be a year of passion and transformation for Leos in matters of the heart. Singles may find themselves drawn to someone who truly understands their vibrant personality, especially during the latter half of the year.',5,1,'2026-09-09 06:59:14','2026-09-09 06:59:14'),(6,'Virgo','Virgo Yearly Horoscope','2026','assets/images/hioroscope6.png','Love and Relationships: 2026 will be a year of emotional growth and understanding in relationships for Virgos. Singles may find themselves drawn to someone who complements their personality around the second quarter.',6,1,'2026-09-09 06:59:14','2026-09-09 06:59:14'),(7,'Libra','Libra Yearly Horoscope','2026','assets/images/hioroscope7.png','Love and Relationships: 2026 will be a year of harmony and deep connection for Libras. Singles may find someone with whom they share a unique intellectual and emotional bond, especially during the second quarter.',7,1,'2026-09-09 06:59:14','2026-09-09 06:59:14'),(8,'Scorpio','Scorpio Yearly Horoscope','2026','assets/images/hioroscope8.png','Love and Relationships: 2026 promises deep emotional connections and transformative growth in your relationships, Scorpio. Singles may experience an unexpected romantic encounter during the second half of the year that feels destined.',8,1,'2026-09-09 06:59:14','2026-09-09 06:59:14'),(9,'Sagittarius','Sagittarius Yearly Horoscope','2026','assets/images/hioroscope9.png','Love and Relationships: 2026 brings exciting growth in your personal life, Sagittarius. For singles, the year starts off with a bang, and you might meet someone who resonates with your adventurous spirit.',9,1,'2026-09-09 06:59:14','2026-09-09 06:59:14'),(10,'Capricorn','Capricorn Yearly Horoscope','2026','assets/images/hioroscope10.png','Love and Relationships: 2026 promises growth and deeper connections in your love life, Capricorn. For singles, the year may bring a few unexpected romantic opportunities, particularly during the second half.',10,1,'2026-09-09 06:59:14','2026-09-09 06:59:14'),(11,'Aquarius','Aquarius Yearly Horoscope','2026','assets/images/hioroscope11.png','Love and Relationships: 2026 is a year of self-discovery and strengthening bonds for Aquarius. Singles may feel a sense of independence and exploration early in the year, but a deep connection could form unexpectedly by mid-year.',11,1,'2026-09-09 06:59:14','2026-09-09 06:59:14'),(12,'Pisces','Pisces Yearly Horoscope','2026','assets/images/hioroscope12.png','Love and Relationships: 2026 will be a year of emotional growth and strengthening your bonds, Pisces. For singles, there is a strong chance of meeting someone who truly understands your sensitive and intuitive nature.',12,1,'2026-09-09 06:59:14','2026-09-09 06:59:14');
/*!40000 ALTER TABLE `yearly_horoscopes` ENABLE KEYS */;
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
