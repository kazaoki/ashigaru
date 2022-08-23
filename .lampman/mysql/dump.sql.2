-- MySQL dump 10.13  Distrib 5.7.31, for Linux (x86_64)
--
-- Host: localhost    Database: test
-- ------------------------------------------------------
-- Server version	5.7.31

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
-- Table structure for table `admins`
--

DROP TABLE IF EXISTS `admins`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `admins` (
  `id` int(11) NOT NULL AUTO_INCREMENT COMMENT 'ID',
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP COMMENT '作成日時',
  `updated_at` datetime DEFAULT NULL COMMENT '更新日時',
  `status` smallint(2) NOT NULL DEFAULT '1' COMMENT '状態',
  `login_id` varchar(32) NOT NULL COMMENT 'ログインID',
  `login_pw` varchar(255) NOT NULL COMMENT 'ログインパスワード',
  PRIMARY KEY (`id`),
  UNIQUE KEY `login_id` (`login_id`),
  KEY `status` (`status`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8mb4 COMMENT='管理者';
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `admins`
--

LOCK TABLES `admins` WRITE;
/*!40000 ALTER TABLE `admins` DISABLE KEYS */;
INSERT INTO `admins` VALUES (1,'2021-08-16 02:35:02',NULL,1,'admin','$2y$10$H/4AD6Kt3m15LxUZr7aRkenyLTszqYAMrLyiFTeRCXgbZjZd7PG8C');
/*!40000 ALTER TABLE `admins` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `login_sessions`
--

DROP TABLE IF EXISTS `login_sessions`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `login_sessions` (
  `id` int(11) NOT NULL AUTO_INCREMENT COMMENT 'ID',
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP COMMENT '作成日時',
  `updated_at` datetime DEFAULT NULL COMMENT '更新日時',
  `status` smallint(2) NOT NULL DEFAULT '1' COMMENT '状態',
  `login_id` varchar(32) DEFAULT NULL COMMENT 'ログインID',
  `access_ip` text COMMENT 'アクセスIP',
  `session_id` char(32) DEFAULT NULL COMMENT 'セッションID',
  PRIMARY KEY (`id`),
  KEY `status` (`status`)
) ENGINE=InnoDB AUTO_INCREMENT=8 DEFAULT CHARSET=utf8mb4 COMMENT='ログインセッション';
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `login_sessions`
--

LOCK TABLES `login_sessions` WRITE;
/*!40000 ALTER TABLE `login_sessions` DISABLE KEYS */;
INSERT INTO `login_sessions` VALUES (1,'2021-08-16 04:56:28','2021-08-16 13:56:28',1,'admin','172.22.0.1','gqetf9muue3caismcrqt1sm8ou'),(2,'2021-08-16 04:56:37','2021-08-16 13:56:37',1,'admin','172.22.0.1','gqetf9muue3caismcrqt1sm8ou'),(3,'2021-08-16 04:59:13','2021-08-16 13:59:13',1,'admin','172.22.0.1','gqetf9muue3caismcrqt1sm8ou'),(4,'2022-08-19 05:09:34','2022-08-19 14:09:34',1,'admin','172.23.0.1','4tco7kvfgjknh209qqcf7mprg3'),(5,'2022-08-19 05:09:34','2022-08-19 14:09:34',1,'admin','172.23.0.1','4mkiqkoq2j4q1tafi47no89and'),(6,'2022-08-19 05:25:11','2022-08-19 14:25:11',1,'admin','172.23.0.1','4tco7kvfgjknh209qqcf7mprg3'),(7,'2022-08-22 21:26:45','2022-08-23 06:26:45',1,'admin','172.18.0.1','199fr9s9lif6n94116kqslpj0p');
/*!40000 ALTER TABLE `login_sessions` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `news`
--

DROP TABLE IF EXISTS `news`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `news` (
  `id` int(11) NOT NULL AUTO_INCREMENT COMMENT 'ID',
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP COMMENT '作成日時',
  `updated_at` datetime DEFAULT NULL COMMENT '更新日時',
  `deleted_at` datetime DEFAULT NULL COMMENT '削除日時',
  `status` smallint(2) NOT NULL DEFAULT '1' COMMENT '状態',
  `published_at` datetime NOT NULL COMMENT '公開日時',
  `title` text NOT NULL COMMENT 'タイトル',
  `content` text COMMENT '本文',
  `category_id` int(11) NOT NULL COMMENT 'カテゴリID',
  `type` enum('entry','pdf','url') NOT NULL DEFAULT 'entry' COMMENT '記事タイプ',
  `url` text COMMENT 'リンク先URL',
  `is_blank` tinyint(1) DEFAULT NULL COMMENT 'リンク先は別窓か:記事タイプが pdf または url のとき時のみ有効',
  `pdf_filename` text COMMENT 'アップロードPDFファイル名',
  PRIMARY KEY (`id`),
  KEY `status` (`status`)
) ENGINE=InnoDB AUTO_INCREMENT=28 DEFAULT CHARSET=utf8mb4 COMMENT='お知らせ';
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `news`
--

LOCK TABLES `news` WRITE;
/*!40000 ALTER TABLE `news` DISABLE KEYS */;
INSERT INTO `news` VALUES (1,'2022-08-22 07:20:32','2022-08-23 14:35:19',NULL,1,'2022-08-23 14:10:00','お知らせサンプル001','<p>test1<br />\r\n<strong>te<span style=\"background-color:#e74c3c;\">st2</span></strong><br />\r\ntest33333333</p>\r\n',3,'pdf','https://google.com',1,'sample-001.pdf'),(2,'2022-08-22 07:20:32',NULL,NULL,1,'2022-08-22 16:20:32','お知らせサンプル002','test1\ntest2\ntest3\n',2,'entry',NULL,NULL,NULL),(3,'2022-08-22 07:20:32',NULL,NULL,1,'2022-08-22 16:20:32','お知らせサンプル003','test1\ntest2\ntest3\n',3,'entry',NULL,NULL,NULL),(4,'2022-08-22 07:20:32',NULL,NULL,1,'2022-08-22 16:20:32','お知らせサンプル004','test1\ntest2\ntest3\n',1,'entry',NULL,NULL,NULL),(5,'2022-08-22 07:20:32',NULL,NULL,1,'2022-08-22 16:20:32','お知らせサンプル005','test1\ntest2\ntest3\n',2,'entry',NULL,NULL,NULL),(6,'2022-08-22 07:20:33',NULL,NULL,1,'2022-08-22 16:20:33','お知らせサンプル006','test1\ntest2\ntest3\n',3,'entry',NULL,NULL,NULL),(7,'2022-08-22 07:20:33',NULL,NULL,1,'2022-08-22 16:20:33','お知らせサンプル007','test1\ntest2\ntest3\n',1,'entry',NULL,NULL,NULL),(8,'2022-08-22 07:20:33',NULL,NULL,1,'2022-08-22 16:20:33','お知らせサンプル008','test1\ntest2\ntest3\n',2,'entry',NULL,NULL,NULL),(9,'2022-08-22 07:20:33',NULL,NULL,1,'2022-08-22 16:20:33','お知らせサンプル009','test1\ntest2\ntest3\n',3,'entry',NULL,NULL,NULL),(10,'2022-08-22 07:20:33',NULL,NULL,1,'2022-08-22 16:20:33','お知らせサンプル010','test1\ntest2\ntest3\n',1,'entry',NULL,NULL,NULL),(11,'2022-08-22 07:20:33',NULL,NULL,1,'2022-08-22 16:20:33','お知らせサンプル011','test1\ntest2\ntest3\n',2,'entry',NULL,NULL,NULL),(12,'2022-08-22 07:20:33',NULL,NULL,1,'2022-08-22 16:20:33','お知らせサンプル012','test1\ntest2\ntest3\n',3,'entry',NULL,NULL,NULL),(13,'2022-08-22 07:20:33',NULL,NULL,1,'2022-08-22 16:20:33','お知らせサンプル013','test1\ntest2\ntest3\n',1,'entry',NULL,NULL,NULL),(14,'2022-08-22 07:20:33',NULL,NULL,1,'2022-08-22 16:20:33','お知らせサンプル014','test1\ntest2\ntest3\n',2,'entry',NULL,NULL,NULL),(15,'2022-08-22 07:20:33',NULL,NULL,1,'2022-08-22 16:20:33','お知らせサンプル015','test1\ntest2\ntest3\n',3,'entry',NULL,NULL,NULL),(16,'2022-08-22 07:20:33',NULL,NULL,1,'2022-08-22 16:20:33','コンテンツ確認','ダミーです。文字の大きさ、量、字間、行間等を確認するために入れています。<br>文章はダミーです。文字の大きさ、量、字間、行間等を確認するために入れています。<br><br><br>この文章はダミーです。文字の大きさ、量、字間、行間等を確認するために入れています。この文章はダミーです。<br>量、字間、行間等を確認するために入れています。この文章はダミーです。<br>文字の大きさ、量、字間、行間等を確認するために入れています。<br><br><br>ダミーです。<br>文字の大きさ、量、字間、行間等を確認するために入れています。<br><br><br>行間等を確認するために入れています。文章はダミーです。<br>文字の大きさ、量、字間、行間等を確認するために入れています。この文章はダミーです。<br>文字を確認するために入れています。この文章はダミーです。<br>量、字間、行間等を確認するために入れています。',1,'entry',NULL,NULL,NULL),(17,'2022-08-22 07:20:33',NULL,NULL,1,'2022-08-22 16:20:33','リンクお知らせAAA',NULL,1,'url','https://google.com',NULL,NULL),(18,'2022-08-22 07:20:33',NULL,NULL,1,'2022-08-22 16:20:33','リンクお知らせBBB（別窓）',NULL,3,'url','https://yahoo.jp',1,NULL),(19,'2022-08-22 07:20:33',NULL,NULL,1,'2022-08-22 16:20:33','PDFお知らせ111',NULL,2,'pdf',NULL,NULL,'ほげほげ.pdf'),(20,'2022-08-22 07:20:33',NULL,NULL,1,'2022-08-22 16:20:33','PDFお知らせ222（別窓）',NULL,1,'pdf',NULL,1,'ふげふげ.pdf'),(21,'2022-08-23 05:22:24','2022-08-23 14:22:24',NULL,1,'2022-08-23 14:10:00','お知らせサンプル001','<p>test1<br />\r\n<strong>te<span style=\"background-color:#e74c3c;\">st2</span></strong><br />\r\ntest33333333</p>\r\n',3,'pdf','https://google.com',1,'魑魅魍魎魑魅魍魎魑魅魍魎魑魅魍魎魑魅魍魎魑魅魍魎魑魅魍魎.pdf'),(22,'2022-08-23 05:25:18','2022-08-23 14:25:18',NULL,1,'2022-08-23 14:10:00','お知らせサンプル001','<p>test1<br />\r\n<strong>te<span style=\"background-color:#e74c3c;\">st2</span></strong><br />\r\ntest33333333</p>\r\n',3,'pdf','https://google.com',1,'漢字サンプルファイル.pdf'),(23,'2022-08-23 05:25:54','2022-08-23 14:25:54',NULL,1,'2022-08-23 14:10:00','お知らせサンプル001','<p>test1<br />\r\n<strong>te<span style=\"background-color:#e74c3c;\">st2</span></strong><br />\r\ntest33333333</p>\r\n',3,'pdf','https://google.com',1,'sample-001.pdf'),(24,'2022-08-23 05:27:21','2022-08-23 14:27:21',NULL,1,'2022-08-23 14:10:00','お知らせサンプル001','<p>test1<br />\r\n<strong>te<span style=\"background-color:#e74c3c;\">st2</span></strong><br />\r\ntest33333333</p>\r\n',3,'pdf','https://google.com',1,'魑魅魍魎魑魅魍魎魑魅魍魎魑魅魍魎魑魅魍魎魑魅魍魎魑魅魍魎.pdf'),(25,'2022-08-23 05:30:19','2022-08-23 14:30:19',NULL,1,'2022-08-23 14:10:00','お知らせサンプル001','<p>test1<br />\r\n<strong>te<span style=\"background-color:#e74c3c;\">st2</span></strong><br />\r\ntest33333333</p>\r\n',3,'pdf','https://google.com',1,'漢字サンプルファイル.pdf'),(26,'2022-08-23 05:31:20','2022-08-23 14:31:20',NULL,1,'2022-08-23 14:10:00','お知らせサンプル001','<p>test1<br />\r\n<strong>te<span style=\"background-color:#e74c3c;\">st2</span></strong><br />\r\ntest33333333</p>\r\n',3,'pdf','https://google.com',1,'漢字サンプルファイル.pdf'),(27,'2022-08-23 05:31:36','2022-08-23 14:31:36',NULL,1,'2022-08-23 14:10:00','お知らせサンプル001','<p>test1<br />\r\n<strong>te<span style=\"background-color:#e74c3c;\">st2</span></strong><br />\r\ntest33333333</p>\r\n',3,'entry','https://google.com',NULL,NULL);
/*!40000 ALTER TABLE `news` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `news_categories`
--

DROP TABLE IF EXISTS `news_categories`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `news_categories` (
  `id` int(11) NOT NULL AUTO_INCREMENT COMMENT 'ID',
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP COMMENT '作成日時',
  `updated_at` datetime DEFAULT NULL COMMENT '更新日時',
  `deleted_at` datetime DEFAULT NULL COMMENT '削除日時',
  `status` smallint(2) NOT NULL DEFAULT '1' COMMENT '状態',
  `sort` smallint(6) NOT NULL COMMENT 'ソート',
  `label` text NOT NULL COMMENT 'ラベル',
  `slug` varchar(32) NOT NULL COMMENT 'スラッグ',
  PRIMARY KEY (`id`),
  KEY `status` (`status`)
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=utf8mb4 COMMENT='お知らせカテゴリ';
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `news_categories`
--

LOCK TABLES `news_categories` WRITE;
/*!40000 ALTER TABLE `news_categories` DISABLE KEYS */;
INSERT INTO `news_categories` VALUES (1,'2022-08-22 07:20:32',NULL,NULL,1,1,'お知らせ','cat1'),(2,'2022-08-22 07:20:32',NULL,NULL,1,2,'更新情報','cat2'),(3,'2022-08-22 07:20:32',NULL,NULL,1,3,'お客様の声','cat3');
/*!40000 ALTER TABLE `news_categories` ENABLE KEYS */;
UNLOCK TABLES;
/*!40103 SET TIME_ZONE=@OLD_TIME_ZONE */;

/*!40101 SET SQL_MODE=@OLD_SQL_MODE */;
/*!40014 SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS */;
/*!40014 SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
/*!40111 SET SQL_NOTES=@OLD_SQL_NOTES */;

-- Dump completed on 2022-08-23 14:38:28
