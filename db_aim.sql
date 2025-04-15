-- MySQL dump 10.13  Distrib 8.0.41, for Win64 (x86_64)
--
-- Host: localhost    Database: aim
-- ------------------------------------------------------
-- Server version	5.5.5-10.4.32-MariaDB

/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!50503 SET NAMES utf8 */;
/*!40103 SET @OLD_TIME_ZONE=@@TIME_ZONE */;
/*!40103 SET TIME_ZONE='+00:00' */;
/*!40014 SET @OLD_UNIQUE_CHECKS=@@UNIQUE_CHECKS, UNIQUE_CHECKS=0 */;
/*!40014 SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0 */;
/*!40101 SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='NO_AUTO_VALUE_ON_ZERO' */;
/*!40111 SET @OLD_SQL_NOTES=@@SQL_NOTES, SQL_NOTES=0 */;

--
-- Table structure for table `activity`
--

DROP TABLE IF EXISTS `activity`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `activity` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `activity_name` varchar(100) DEFAULT NULL,
  `parent_id` int(11) DEFAULT NULL,
  `is_active` smallint(6) DEFAULT NULL,
  `order_id` int(11) DEFAULT NULL,
  `created_at` datetime DEFAULT NULL,
  `updated_at` datetime DEFAULT NULL,
  PRIMARY KEY (`id`) USING BTREE
) ENGINE=InnoDB AUTO_INCREMENT=24 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci ROW_FORMAT=DYNAMIC;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `activity`
--

LOCK TABLES `activity` WRITE;
/*!40000 ALTER TABLE `activity` DISABLE KEYS */;
INSERT INTO `activity` VALUES (1,'Loading Preparation',NULL,1,1,NULL,NULL),(2,'Transshipment',NULL,1,2,NULL,NULL),(3,'Abnormality',NULL,1,3,NULL,NULL),(4,'Test Crane/P2H',1,1,1,NULL,NULL),(5,'Barge ALong side',1,1,2,NULL,NULL),(6,'Loading Time',2,1,1,NULL,'2025-04-15 06:45:32'),(7,'VIDS',2,1,6,NULL,NULL),(8,'Final Trimming',2,1,7,NULL,NULL),(9,'Loading',2,1,8,NULL,NULL),(10,'VFDS',2,1,9,NULL,NULL),(11,'Transfer HE from MV/BG',2,1,10,NULL,NULL),(12,'Barge Cast Off',2,1,11,NULL,NULL),(13,'Logistic Supply',3,1,1,NULL,NULL),(14,'Repair',3,1,2,NULL,NULL),(15,'Bad Weather',3,1,3,NULL,NULL),(16,'WOTH',3,1,4,NULL,NULL),(17,'WCD',3,1,5,NULL,NULL),(18,'Waiting TB',3,1,6,NULL,NULL),(20,'Shiftting FC',2,1,2,NULL,NULL),(21,'Shifting BG',2,1,3,NULL,NULL),(22,'Transfer H/E dari FC ke Tongkang (THBG)',2,1,4,NULL,NULL),(23,'Transfer H/E dari Tongkang ke FC (THFC)',2,1,5,NULL,NULL);
/*!40000 ALTER TABLE `activity` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `cctv`
--

DROP TABLE IF EXISTS `cctv`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `cctv` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `floating_crane_id` int(11) DEFAULT NULL,
  `code` varchar(10) DEFAULT NULL,
  `name` varchar(100) DEFAULT NULL,
  `position` varchar(100) DEFAULT NULL,
  `ip_cctv` varchar(20) DEFAULT NULL,
  `ip_server` varchar(20) DEFAULT NULL,
  `rtsp` varchar(255) DEFAULT NULL,
  `embed` varchar(255) DEFAULT NULL,
  `type_streaming` varchar(255) DEFAULT NULL COMMENT 'embed . m3u8 . youtube , video\r\n',
  `thumnail` varchar(255) DEFAULT NULL,
  `is_active` varchar(1) DEFAULT NULL COMMENT '0 - 1',
  `created_by` int(11) DEFAULT NULL,
  `created_at` datetime DEFAULT NULL,
  `modified_by` int(11) DEFAULT NULL,
  `modified_at` datetime DEFAULT NULL,
  `latitude` varchar(45) DEFAULT NULL,
  `longitude` varchar(45) DEFAULT NULL,
  PRIMARY KEY (`id`) USING BTREE
) ENGINE=InnoDB AUTO_INCREMENT=9 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci ROW_FORMAT=DYNAMIC;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `cctv`
--

LOCK TABLES `cctv` WRITE;
/*!40000 ALTER TABLE `cctv` DISABLE KEYS */;
INSERT INTO `cctv` VALUES (1,1,'C001','CCTV ','Main Deck','192.168.1.1','192.168.1.1',NULL,'https://www.youtube.com/embed/znfYD4RrQWA?si=i-az2TI_QiKSULCi','youtube',NULL,NULL,NULL,NULL,NULL,NULL,'11.8166','122.0942'),(2,1,'C002','CCTV 2','Main Deck 2','5343643654','121313','','https://www.youtube.com/embed/nCozv2WKERc?si=-Ld8o8DH0GKJEhRN','2','zxzxz','1',NULL,NULL,NULL,NULL,'11.9804','121.9189'),(3,1,'C003','CCTV 3','Main Deck 3',NULL,NULL,NULL,'https://www.youtube.com/embed/6G8z9sByY98?si=1wLzSfOmtT9ZfFiL',NULL,NULL,NULL,NULL,NULL,NULL,NULL,'10.7202','122.5621'),(4,2,'G001','CCTV fc2 1 ','Main Deck',NULL,NULL,NULL,'https://www.youtube.com/embed/gGNWdUNAQws?si=zUPiR1T0ZdEYMczj',NULL,NULL,NULL,NULL,NULL,NULL,NULL,'9.8166','120.0942'),(5,2,'G002','CCTV fc2 2','Main Deck 2',NULL,NULL,NULL,'https://www.youtube.com/embed/-rYpWQ7c-H0?si=aokWgf-fby2kz2cr',NULL,NULL,NULL,NULL,NULL,NULL,NULL,'11.3889','122.6277'),(6,2,'G003','CCTV fc2 3','Main Deck 3',NULL,NULL,NULL,'https://www.youtube.com/embed/lx1qlaOhu_I?si=W6RWytrkkwj2r0Hm',NULL,NULL,NULL,NULL,NULL,NULL,NULL,'10.5929','122.6325'),(8,3,'C99201','bag samping','samping',NULL,NULL,'443','https://www.youtube.com/embed/lx1qlaOhu_I?si=W6RWytrkkwj2r0Hm',NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL);
/*!40000 ALTER TABLE `cctv` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `floating_crane`
--

DROP TABLE IF EXISTS `floating_crane`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `floating_crane` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `code` varchar(8) DEFAULT NULL,
  `name` varchar(100) DEFAULT NULL,
  `latitude` varchar(45) DEFAULT NULL,
  `longitude` varchar(45) DEFAULT NULL,
  PRIMARY KEY (`id`) USING BTREE
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci ROW_FORMAT=DYNAMIC;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `floating_crane`
--

LOCK TABLES `floating_crane` WRITE;
/*!40000 ALTER TABLE `floating_crane` DISABLE KEYS */;
INSERT INTO `floating_crane` VALUES (1,'FC001','FC Avant Grade','-6.25618','106.98926'),(2,'FC002','crane dua','-6.25700','107.99921'),(3,'FC002','FC Avant 3','-6.25620','108.98926');
/*!40000 ALTER TABLE `floating_crane` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `job_order`
--

DROP TABLE IF EXISTS `job_order`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `job_order` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `date` date DEFAULT NULL,
  `order_no` varchar(20) DEFAULT NULL,
  `order_name` varchar(100) DEFAULT NULL,
  `floating_crane_id` int(11) DEFAULT NULL,
  `mother_vessel_id` int(11) DEFAULT NULL,
  `pic` varchar(100) DEFAULT NULL,
  `datetime_start` datetime DEFAULT NULL,
  `datetime_end` datetime DEFAULT NULL,
  `date_time_total` decimal(10,0) DEFAULT NULL,
  `order_status` int(11) DEFAULT NULL COMMENT '1 : Not started 2 : Progress 3 : Done',
  `created_by` int(11) DEFAULT NULL,
  `created_at` datetime DEFAULT NULL,
  `modified_by` int(11) DEFAULT NULL,
  `modified_at` datetime DEFAULT NULL,
  `is_active` int(11) DEFAULT NULL,
  PRIMARY KEY (`id`) USING BTREE
) ENGINE=InnoDB AUTO_INCREMENT=9 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci ROW_FORMAT=DYNAMIC;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `job_order`
--

LOCK TABLES `job_order` WRITE;
/*!40000 ALTER TABLE `job_order` DISABLE KEYS */;
INSERT INTO `job_order` VALUES (1,'2025-02-26','ORD25020001','Perpindahan Batubara',1,2,'Rara','2025-02-26 08:00:00','2025-02-26 21:15:00',145,2,NULL,NULL,NULL,NULL,1),(2,'0000-00-00','ORD25020002','order 1',2,2,'tiara','0000-00-00 00:00:00','0000-00-00 00:00:00',0,2,NULL,NULL,NULL,NULL,1),(3,'0000-00-00','ORD25020003','order 2',2,2,'sani','0000-00-00 00:00:00','0000-00-00 00:00:00',0,2,NULL,NULL,NULL,NULL,1),(4,'2025-02-27','ORD25020004','Perpindahan Batubara',1,2,'tisya','2025-02-28 15:00:00','2025-02-28 16:20:00',100,2,NULL,NULL,NULL,NULL,1),(5,'2025-02-27','ORD25020005','Perpindahan 2',1,2,'tisya','2025-02-28 10:00:00','2025-02-28 11:04:00',64,2,NULL,NULL,NULL,NULL,1),(6,'2025-03-28','ORD25020006','Perpindahan Batubara',1,2,'niel','2025-02-28 00:00:00','2025-02-28 02:20:00',140,2,NULL,NULL,NULL,NULL,1),(7,'2025-03-28','ORD25020007','Perpindahan 2',1,2,'ika','2025-02-28 08:00:00','2025-02-28 10:05:00',125,2,NULL,NULL,NULL,NULL,1),(8,'2025-03-28','ORD25020008','Perpindahan 3',1,2,'ika','2025-02-28 08:00:00','2025-02-28 10:15:00',135,2,NULL,NULL,NULL,NULL,1);
/*!40000 ALTER TABLE `job_order` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `job_order_detail`
--

DROP TABLE IF EXISTS `job_order_detail`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `job_order_detail` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `job_order_id` int(11) DEFAULT NULL,
  `activity_id` int(11) DEFAULT NULL,
  `datetime_start` datetime DEFAULT NULL,
  `datetime_end` datetime DEFAULT NULL,
  `total_time` double DEFAULT NULL,
  `degree` double DEFAULT NULL,
  `created_at` datetime DEFAULT NULL,
  `created_by` int(11) DEFAULT NULL,
  `degree_2` varchar(45) DEFAULT NULL,
  `achieve_sla` int(11) DEFAULT NULL,
  PRIMARY KEY (`id`) USING BTREE
) ENGINE=InnoDB AUTO_INCREMENT=22 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci ROW_FORMAT=DYNAMIC;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `job_order_detail`
--

LOCK TABLES `job_order_detail` WRITE;
/*!40000 ALTER TABLE `job_order_detail` DISABLE KEYS */;
INSERT INTO `job_order_detail` VALUES (1,1,6,'2025-03-01 10:10:43','2025-03-01 10:12:00',2,120,NULL,NULL,'121',1),(2,7,3,'2025-03-01 05:44:43','2025-03-01 05:44:43',0,180,NULL,NULL,'90',0),(3,1,6,'2025-03-01 10:15:43','2025-03-01 10:16:43',1,125,NULL,NULL,'126',1),(4,1,6,'2025-03-17 11:00:00','2025-03-01 11:05:00',5,130,NULL,NULL,'137',0),(5,1,6,'2025-04-09 11:00:00','2025-04-09 12:00:00',60,180,'2025-04-09 17:00:00',NULL,'190',0),(6,1,6,'2025-04-09 11:00:00','2025-04-09 12:00:00',60,170,'2025-04-09 17:00:00',NULL,'190',0),(7,1,6,'2025-04-09 11:00:00','2025-04-09 12:00:00',1,150,'2025-04-09 17:00:00',NULL,'190',1),(8,1,6,'2025-04-10 11:10:00','2025-04-10 12:00:00',3.5,180,'2025-04-10 11:00:00',NULL,'190',0),(9,1,6,'2025-04-10 15:00:00','2025-04-10 15:01:00',1.5,165,'2025-04-10 15:00:00',NULL,'170',1),(10,1,6,'2025-04-10 15:00:00','2025-04-10 15:01:00',2,165,'2025-04-10 15:00:00',NULL,'170',1),(19,4,6,'2025-04-11 00:00:00','2025-04-11 00:02:00',2,130,NULL,NULL,'135',1),(20,1,6,'2025-04-11 00:05:00','2025-04-11 00:06:00',1,120,NULL,NULL,'124',1),(21,1,6,'2025-04-11 00:07:00','2025-04-11 00:10:00',3,100,NULL,NULL,'120',0);
/*!40000 ALTER TABLE `job_order_detail` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `job_order_summary`
--

DROP TABLE IF EXISTS `job_order_summary`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `job_order_summary` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `job_order_id` int(11) DEFAULT NULL,
  `activity_id` int(11) DEFAULT NULL,
  `total_date_time` double DEFAULT NULL,
  PRIMARY KEY (`id`) USING BTREE
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci ROW_FORMAT=DYNAMIC;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `job_order_summary`
--

LOCK TABLES `job_order_summary` WRITE;
/*!40000 ALTER TABLE `job_order_summary` DISABLE KEYS */;
INSERT INTO `job_order_summary` VALUES (1,1,6,140),(2,1,13,10.2),(3,4,6,2);
/*!40000 ALTER TABLE `job_order_summary` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `mother_vessel`
--

DROP TABLE IF EXISTS `mother_vessel`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `mother_vessel` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `code` varchar(8) DEFAULT NULL,
  `name` varchar(100) DEFAULT NULL,
  `imo` varchar(45) DEFAULT NULL,
  `mmsi` varchar(45) DEFAULT NULL,
  `call_sign` varchar(45) DEFAULT NULL,
  `ais_transponder_class` varchar(45) DEFAULT NULL,
  `general_vessel_type` varchar(45) DEFAULT NULL,
  `detailed_vessel_type` varchar(45) DEFAULT NULL,
  `service_status` varchar(45) DEFAULT NULL,
  `port_of_registry` varchar(45) DEFAULT NULL,
  `year_built` date DEFAULT NULL,
  PRIMARY KEY (`id`) USING BTREE
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci ROW_FORMAT=DYNAMIC;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `mother_vessel`
--

LOCK TABLES `mother_vessel` WRITE;
/*!40000 ALTER TABLE `mother_vessel` DISABLE KEYS */;
INSERT INTO `mother_vessel` VALUES (2,'a001','vessel satu',NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL);
/*!40000 ALTER TABLE `mother_vessel` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `sla`
--

DROP TABLE IF EXISTS `sla`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `sla` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `activity_id` int(11) DEFAULT NULL,
  `sla` decimal(10,0) DEFAULT NULL,
  PRIMARY KEY (`id`) USING BTREE
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci ROW_FORMAT=DYNAMIC;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `sla`
--

LOCK TABLES `sla` WRITE;
/*!40000 ALTER TABLE `sla` DISABLE KEYS */;
INSERT INTO `sla` VALUES (1,6,2);
/*!40000 ALTER TABLE `sla` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `status`
--

DROP TABLE IF EXISTS `status`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `status` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(45) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `status`
--

LOCK TABLES `status` WRITE;
/*!40000 ALTER TABLE `status` DISABLE KEYS */;
INSERT INTO `status` VALUES (1,'Not Started'),(2,'In Progress'),(3,'Done');
/*!40000 ALTER TABLE `status` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `user`
--

DROP TABLE IF EXISTS `user`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `user` (
  `user_id` bigint(20) NOT NULL AUTO_INCREMENT,
  `name` varchar(100) NOT NULL,
  `email` varchar(45) NOT NULL,
  `username` varchar(100) NOT NULL,
  `passwd` varchar(100) NOT NULL,
  `id_karyawan` int(11) DEFAULT NULL,
  `id_groups` enum('1','2','3') NOT NULL DEFAULT '3' COMMENT 'option : 1 = Super Admin\r\n2 = Admin\r\n3 = User',
  `base_menu` enum('role','custom') NOT NULL DEFAULT 'role' COMMENT 'option : role / custom',
  `ppFile` varchar(255) DEFAULT NULL,
  `id_branch` int(11) DEFAULT NULL,
  `isaktif` enum('1','2','3','4') NOT NULL DEFAULT '1' COMMENT 'option : 1 = baru/non-aktif\r\n2 = aktif\r\n3 = hapus\r\n4 = suspend',
  `last_update_login` datetime DEFAULT NULL,
  `approvekey` varchar(25) NOT NULL,
  `keygen` datetime DEFAULT NULL,
  `cookie` varchar(100) NOT NULL,
  `insert_by` varchar(100) DEFAULT NULL,
  `date_insert` timestamp NOT NULL DEFAULT current_timestamp(),
  `update_by` varchar(100) DEFAULT NULL,
  `date_update` timestamp NULL DEFAULT NULL ON UPDATE current_timestamp(),
  PRIMARY KEY (`user_id`) USING BTREE,
  KEY `user_ibfk_1` (`id_groups`) USING BTREE,
  KEY `username` (`username`) USING BTREE
) ENGINE=InnoDB AUTO_INCREMENT=13 DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci ROW_FORMAT=DYNAMIC;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `user`
--

LOCK TABLES `user` WRITE;
/*!40000 ALTER TABLE `user` DISABLE KEYS */;
INSERT INTO `user` VALUES (1,'Dwi Kuswarno','','dwi','e10adc3949ba59abbe56e057f20f883e',NULL,'1','role',NULL,1,'2','2025-04-15 04:48:39','',NULL,'HXDBKvhqrdfoQ4HNQjAVrN5jcsEEw7Py9bMJxKFvIM0zLw7WainnRkOgAY1ioltO',NULL,'2016-10-27 17:39:53',NULL,'2025-04-15 02:48:39'),(2,'Vendor Master','','master','eb0a191797624dd3a48fa681d3061212',NULL,'1','role',NULL,1,'4','2020-05-14 18:47:20','',NULL,'',NULL,'2018-12-03 02:46:50',NULL,'2020-11-01 05:00:28'),(3,'Admin','','admin','4fbd41a36dac3cd79aa1041c9648ab89',NULL,'2','role',NULL,1,'2','2020-05-14 18:48:15','',NULL,'','dwi','2019-01-16 10:44:58','dwi','2022-02-25 04:15:37'),(4,'User','','user','ee11cbb19052e40b07aac0ca060c23ee',NULL,'3','role',NULL,1,'4',NULL,'',NULL,'','dwi','2019-01-16 10:45:15',NULL,'2020-11-01 05:01:07'),(5,'Muniarsih','niar@nathabuana.id','niar','e46920f7ec22cd46f848bba7b80e3478',NULL,'1','role',NULL,1,'2','2024-11-26 13:56:44','',NULL,'4PFrgi8gAhJMkK1ZtOpqJRQIuM6jqzXLacC6Un4xNoVs5mGyft5aShiNY3v3uoTB','dwi','2020-10-16 09:55:25','awi','2024-11-26 06:56:44'),(6,'Anung Wicaksono','anung@nathabuana.id','awi','83d5c0f298e249c6f1772c7188080ea4',NULL,'1','role',NULL,1,'2','2024-11-04 14:23:45','',NULL,'Q97HNvyr8WK5hmcAQUnXEHzAOZbznWS4FRVGL2bUgDy01f4amqT5xRNuuIs9iYvC','dwi','2020-10-16 09:56:58','dwi','2024-11-04 07:23:45'),(7,'Aden Maulana','aden.maulana@nathabuana.id','aden','de5afa86dd897c038f930a791a4601e4',2,'2','role',NULL,NULL,'2','2022-06-15 08:00:21','',NULL,'','awi','2021-01-06 02:49:32','awi','2022-06-15 01:00:21'),(8,'Indra Hermawan','indra@nathabuana.com','indra','8ef334db11d44b74859422d7fc4a9b1b',30,'2','role',NULL,NULL,'2','2024-09-02 14:22:18','',NULL,'','dwi','2021-07-06 01:30:21','dwi','2024-09-02 07:22:18'),(9,'Ferry Agus','','ferry','06acce575406715f24ddcddcce92eca2',1,'3','custom',NULL,NULL,'2',NULL,'',NULL,'','awi','2022-02-14 09:48:48',NULL,NULL),(11,'Astaka Sarwiyanto','astaka@nanthabuana.id','astaka','a57f671e3bd818d5d1d77437772d9eb9',6,'1','role',NULL,NULL,'2','2023-01-02 08:52:47','',NULL,'68u5LMO9DserhBQ40Ya92XFkCI7e2vwwjlX1inTZzvfRA8BgRqk1SPcSQNfK3rTW','awi','2023-01-02 01:43:21','awi','2024-03-08 07:39:07'),(12,'Test','','test','f2fc9c769effa56554ad6da756c9d8b2',8,'1','role',NULL,NULL,'2',NULL,'',NULL,'','awi','2024-03-08 07:35:12','awi','2024-03-08 07:36:55');
/*!40000 ALTER TABLE `user` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `user_akses`
--

DROP TABLE IF EXISTS `user_akses`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `user_akses` (
  `user_akses_id` int(11) NOT NULL AUTO_INCREMENT,
  `user_id` bigint(20) NOT NULL,
  `user_menu_id` int(11) NOT NULL,
  `view` varchar(1) DEFAULT NULL,
  `add` varchar(1) DEFAULT NULL,
  `edit` varchar(1) DEFAULT NULL,
  `del` varchar(1) DEFAULT NULL,
  `detail` varchar(1) DEFAULT NULL,
  `eksport` varchar(1) DEFAULT NULL,
  `import` varchar(1) DEFAULT NULL,
  `insert_by` varchar(100) DEFAULT NULL,
  `date_insert` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp(),
  `update_by` varchar(100) DEFAULT NULL,
  `date_update` timestamp NULL DEFAULT NULL ON UPDATE current_timestamp(),
  PRIMARY KEY (`user_akses_id`) USING BTREE,
  KEY `user_id` (`user_id`) USING BTREE,
  KEY `user_menu_id` (`user_menu_id`) USING BTREE
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci ROW_FORMAT=DYNAMIC;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `user_akses`
--

LOCK TABLES `user_akses` WRITE;
/*!40000 ALTER TABLE `user_akses` DISABLE KEYS */;
/*!40000 ALTER TABLE `user_akses` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `user_akses_role`
--

DROP TABLE IF EXISTS `user_akses_role`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `user_akses_role` (
  `user_akses_id` int(11) NOT NULL AUTO_INCREMENT,
  `role_id` tinyint(4) NOT NULL,
  `user_menu_id` int(11) NOT NULL,
  `view` varchar(1) DEFAULT NULL,
  `add` varchar(1) DEFAULT NULL,
  `edit` varchar(1) DEFAULT NULL,
  `del` varchar(1) DEFAULT NULL,
  `detail` varchar(1) DEFAULT NULL,
  `eksport` varchar(1) DEFAULT NULL,
  `import` varchar(1) DEFAULT NULL,
  `insert_by` varchar(100) DEFAULT NULL,
  `date_insert` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp(),
  `update_by` varchar(100) DEFAULT NULL,
  `date_update` timestamp NULL DEFAULT NULL ON UPDATE current_timestamp(),
  PRIMARY KEY (`user_akses_id`) USING BTREE,
  KEY `user_id` (`role_id`) USING BTREE,
  KEY `user_menu_id` (`user_menu_id`) USING BTREE
) ENGINE=InnoDB AUTO_INCREMENT=1357 DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci ROW_FORMAT=DYNAMIC;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `user_akses_role`
--

LOCK TABLES `user_akses_role` WRITE;
/*!40000 ALTER TABLE `user_akses_role` DISABLE KEYS */;
INSERT INTO `user_akses_role` VALUES (75,2,38,'1',NULL,NULL,NULL,NULL,NULL,NULL,'sys','2020-11-09 01:54:46',NULL,'2020-11-09 01:54:46'),(76,2,41,'1','1','1','1','1','1','1','sys','2020-11-09 01:55:01',NULL,'2020-11-09 01:55:01'),(77,2,47,'1','1','1','1','1','1','1','sys','2020-11-09 01:55:09',NULL,'2020-11-09 01:55:09'),(78,2,62,'1',NULL,NULL,NULL,NULL,NULL,NULL,'sys','2020-11-09 01:54:54',NULL,'2020-11-09 01:54:54'),(79,2,74,'1','1','1','1','1','1','1',NULL,'2020-11-09 01:55:17',NULL,'2020-11-09 01:55:17'),(80,2,44,'1','1','1','1','1','1','1','sys','2020-11-09 01:55:24',NULL,'2020-11-09 01:55:24'),(81,2,46,'1','1','1','1','1','1','1','sys','2020-11-09 01:55:31',NULL,'2020-11-09 01:55:31'),(82,2,48,'1','1','1','1','1','1','1','sys','2020-11-09 01:55:38',NULL,'2020-11-09 01:55:38'),(83,2,39,'1',NULL,NULL,NULL,NULL,NULL,NULL,NULL,'2020-11-09 01:54:39',NULL,'2020-11-09 01:54:39'),(84,2,69,'1','1','1','1','1','1','1','sys','2020-11-09 01:55:38',NULL,NULL),(85,2,71,'1','1','1','1','1','1','1','sys','2020-11-09 01:55:38',NULL,NULL),(86,2,72,'1','1','1','1','1','1','1','sys','2020-11-09 01:55:38',NULL,NULL),(88,2,75,'1','1','1','1','1','1','1',NULL,'2020-05-14 11:05:28',NULL,NULL),(89,2,49,'1','1','1','1','1','1','1',NULL,'2020-05-14 11:05:28',NULL,NULL),(90,2,61,'1','1','1','1','1','1','1',NULL,'2020-05-14 11:05:28',NULL,NULL),(94,2,76,'1','1','1','1','1','1','1',NULL,'2020-05-14 11:05:28',NULL,NULL),(98,2,42,'1','1','1','1','1','1','1',NULL,'2020-05-14 11:05:28',NULL,NULL),(99,2,45,'1','1','1','1','1','1','1','sys','2020-05-14 11:05:28',NULL,NULL),(655,3,1,NULL,NULL,NULL,NULL,NULL,NULL,NULL,'awi','2022-02-14 09:49:50',NULL,NULL),(656,3,11,NULL,NULL,NULL,NULL,NULL,NULL,NULL,'awi','2022-02-14 09:49:50',NULL,NULL),(657,3,12,NULL,NULL,NULL,NULL,NULL,NULL,NULL,'awi','2022-02-14 09:49:50',NULL,NULL),(658,3,13,NULL,NULL,NULL,NULL,NULL,NULL,NULL,'awi','2022-02-14 09:49:50',NULL,NULL),(659,3,14,NULL,NULL,NULL,NULL,NULL,NULL,NULL,'awi','2022-02-14 09:49:50',NULL,NULL),(660,3,15,NULL,NULL,NULL,NULL,NULL,NULL,NULL,'awi','2022-02-14 09:49:50',NULL,NULL),(661,3,16,NULL,NULL,NULL,NULL,NULL,NULL,NULL,'awi','2022-02-14 09:49:50',NULL,NULL),(662,3,62,'1',NULL,NULL,NULL,NULL,NULL,NULL,'awi','2022-02-14 09:49:50',NULL,NULL),(663,3,63,NULL,NULL,NULL,NULL,NULL,NULL,NULL,'awi','2022-02-14 09:49:50',NULL,NULL),(664,3,65,NULL,NULL,NULL,NULL,NULL,NULL,NULL,'awi','2022-02-14 09:49:50',NULL,NULL),(665,3,64,NULL,NULL,NULL,NULL,NULL,NULL,NULL,'awi','2022-02-14 09:49:50',NULL,NULL),(666,3,69,'1','1','1','1','1','1','1','awi','2022-02-14 09:49:50',NULL,NULL),(667,3,70,NULL,NULL,NULL,NULL,NULL,NULL,NULL,'awi','2022-02-14 09:49:50',NULL,NULL),(668,3,71,NULL,NULL,NULL,NULL,NULL,NULL,NULL,'awi','2022-02-14 09:49:50',NULL,NULL),(669,3,72,NULL,NULL,NULL,NULL,NULL,NULL,NULL,'awi','2022-02-14 09:49:50',NULL,NULL),(670,3,47,NULL,NULL,NULL,NULL,NULL,NULL,NULL,'awi','2022-02-14 09:49:50',NULL,NULL),(671,3,74,NULL,NULL,NULL,NULL,NULL,NULL,NULL,'awi','2022-02-14 09:49:50',NULL,NULL),(672,3,75,NULL,NULL,NULL,NULL,NULL,NULL,NULL,'awi','2022-02-14 09:49:50',NULL,NULL),(673,3,39,NULL,NULL,NULL,NULL,NULL,NULL,NULL,'awi','2022-02-14 09:49:50',NULL,NULL),(674,3,45,NULL,NULL,NULL,NULL,NULL,NULL,NULL,'awi','2022-02-14 09:49:50',NULL,NULL),(675,3,42,NULL,NULL,NULL,NULL,NULL,NULL,NULL,'awi','2022-02-14 09:49:50',NULL,NULL),(676,3,44,NULL,NULL,NULL,NULL,NULL,NULL,NULL,'awi','2022-02-14 09:49:50',NULL,NULL),(677,3,49,NULL,NULL,NULL,NULL,NULL,NULL,NULL,'awi','2022-02-14 09:49:50',NULL,NULL),(678,3,48,NULL,NULL,NULL,NULL,NULL,NULL,NULL,'awi','2022-02-14 09:49:50',NULL,NULL),(679,3,61,NULL,NULL,NULL,NULL,NULL,NULL,NULL,'awi','2022-02-14 09:49:50',NULL,NULL),(680,3,46,NULL,NULL,NULL,NULL,NULL,NULL,NULL,'awi','2022-02-14 09:49:50',NULL,NULL),(681,3,76,NULL,NULL,NULL,NULL,NULL,NULL,NULL,'awi','2022-02-14 09:49:50',NULL,NULL),(682,3,85,NULL,NULL,NULL,NULL,NULL,NULL,NULL,'awi','2022-02-14 09:49:50',NULL,NULL),(683,3,43,NULL,NULL,NULL,NULL,NULL,NULL,NULL,'awi','2022-02-14 09:49:50',NULL,NULL),(684,3,86,NULL,NULL,NULL,NULL,NULL,NULL,NULL,'awi','2022-02-14 09:49:50',NULL,NULL),(685,3,38,NULL,NULL,NULL,NULL,NULL,NULL,NULL,'awi','2022-02-14 09:49:50',NULL,NULL),(686,3,66,NULL,NULL,NULL,NULL,NULL,NULL,NULL,'awi','2022-02-14 09:49:50',NULL,NULL),(687,3,41,NULL,NULL,NULL,NULL,NULL,NULL,NULL,'awi','2022-02-14 09:49:50',NULL,NULL),(688,3,95,NULL,NULL,NULL,NULL,NULL,NULL,NULL,'awi','2022-02-14 09:49:50',NULL,NULL),(689,3,40,NULL,NULL,NULL,NULL,NULL,NULL,NULL,'awi','2022-02-14 09:49:50',NULL,NULL),(690,3,50,NULL,NULL,NULL,NULL,NULL,NULL,NULL,'awi','2022-02-14 09:49:50',NULL,NULL),(691,3,51,NULL,NULL,NULL,NULL,NULL,NULL,NULL,'awi','2022-02-14 09:49:50',NULL,NULL),(692,3,52,NULL,NULL,NULL,NULL,NULL,NULL,NULL,'awi','2022-02-14 09:49:50',NULL,NULL),(693,3,78,NULL,NULL,NULL,NULL,NULL,NULL,NULL,'awi','2022-02-14 09:49:50',NULL,NULL),(694,3,80,NULL,NULL,NULL,NULL,NULL,NULL,NULL,'awi','2022-02-14 09:49:50',NULL,NULL),(695,3,83,NULL,NULL,NULL,NULL,NULL,NULL,NULL,'awi','2022-02-14 09:49:50',NULL,NULL),(696,3,81,NULL,NULL,NULL,NULL,NULL,NULL,NULL,'awi','2022-02-14 09:49:50',NULL,NULL),(697,3,82,NULL,NULL,NULL,NULL,NULL,NULL,NULL,'awi','2022-02-14 09:49:50',NULL,NULL),(698,3,10,NULL,NULL,NULL,NULL,NULL,NULL,NULL,'awi','2022-02-14 09:49:50',NULL,NULL),(699,3,17,NULL,NULL,NULL,NULL,NULL,NULL,NULL,'awi','2022-02-14 09:49:50',NULL,NULL),(700,3,18,NULL,NULL,NULL,NULL,NULL,NULL,NULL,'awi','2022-02-14 09:49:50',NULL,NULL),(701,3,19,NULL,NULL,NULL,NULL,NULL,NULL,NULL,'awi','2022-02-14 09:49:50',NULL,NULL),(702,3,20,NULL,NULL,NULL,NULL,NULL,NULL,NULL,'awi','2022-02-14 09:49:50',NULL,NULL),(703,3,21,NULL,NULL,NULL,NULL,NULL,NULL,NULL,'awi','2022-02-14 09:49:50',NULL,NULL),(704,3,22,NULL,NULL,NULL,NULL,NULL,NULL,NULL,'awi','2022-02-14 09:49:50',NULL,NULL),(705,3,23,NULL,NULL,NULL,NULL,NULL,NULL,NULL,'awi','2022-02-14 09:49:50',NULL,NULL),(706,3,24,NULL,NULL,NULL,NULL,NULL,NULL,NULL,'awi','2022-02-14 09:49:50',NULL,NULL),(707,3,25,NULL,NULL,NULL,NULL,NULL,NULL,NULL,'awi','2022-02-14 09:49:50',NULL,NULL),(708,3,26,NULL,NULL,NULL,NULL,NULL,NULL,NULL,'awi','2022-02-14 09:49:50',NULL,NULL),(709,3,27,NULL,NULL,NULL,NULL,NULL,NULL,NULL,'awi','2022-02-14 09:49:50',NULL,NULL),(710,3,28,NULL,NULL,NULL,NULL,NULL,NULL,NULL,'awi','2022-02-14 09:49:50',NULL,NULL),(711,3,29,NULL,NULL,NULL,NULL,NULL,NULL,NULL,'awi','2022-02-14 09:49:50',NULL,NULL),(712,3,30,NULL,NULL,NULL,NULL,NULL,NULL,NULL,'awi','2022-02-14 09:49:50',NULL,NULL),(713,3,31,NULL,NULL,NULL,NULL,NULL,NULL,NULL,'awi','2022-02-14 09:49:50',NULL,NULL),(714,3,32,NULL,NULL,NULL,NULL,NULL,NULL,NULL,'awi','2022-02-14 09:49:50',NULL,NULL),(715,3,33,NULL,NULL,NULL,NULL,NULL,NULL,NULL,'awi','2022-02-14 09:49:50',NULL,NULL),(716,3,34,NULL,NULL,NULL,NULL,NULL,NULL,NULL,'awi','2022-02-14 09:49:50',NULL,NULL),(717,3,35,NULL,NULL,NULL,NULL,NULL,NULL,NULL,'awi','2022-02-14 09:49:50',NULL,NULL),(718,3,36,NULL,NULL,NULL,NULL,NULL,NULL,NULL,'awi','2022-02-14 09:49:50',NULL,NULL),(719,3,37,NULL,NULL,NULL,NULL,NULL,NULL,NULL,'awi','2022-02-14 09:49:50',NULL,NULL),(720,3,53,NULL,NULL,NULL,NULL,NULL,NULL,NULL,'awi','2022-02-14 09:49:50',NULL,NULL),(721,3,54,NULL,NULL,NULL,NULL,NULL,NULL,NULL,'awi','2022-02-14 09:49:50',NULL,NULL),(722,3,55,NULL,NULL,NULL,NULL,NULL,NULL,NULL,'awi','2022-02-14 09:49:50',NULL,NULL),(723,3,56,NULL,NULL,NULL,NULL,NULL,NULL,NULL,'awi','2022-02-14 09:49:50',NULL,NULL),(724,3,57,NULL,NULL,NULL,NULL,NULL,NULL,NULL,'awi','2022-02-14 09:49:50',NULL,NULL),(725,3,58,NULL,NULL,NULL,NULL,NULL,NULL,NULL,'awi','2022-02-14 09:49:50',NULL,NULL),(726,3,59,NULL,NULL,NULL,NULL,NULL,NULL,NULL,'awi','2022-02-14 09:49:50',NULL,NULL),(727,3,60,NULL,NULL,NULL,NULL,NULL,NULL,NULL,'awi','2022-02-14 09:49:50',NULL,NULL),(728,3,67,NULL,NULL,NULL,NULL,NULL,NULL,NULL,'awi','2022-02-14 09:49:50',NULL,NULL),(729,3,68,NULL,NULL,NULL,NULL,NULL,NULL,NULL,'awi','2022-02-14 09:49:50',NULL,NULL),(730,3,73,NULL,NULL,NULL,NULL,NULL,NULL,NULL,'awi','2022-02-14 09:49:50',NULL,NULL),(731,3,79,NULL,NULL,NULL,NULL,NULL,NULL,NULL,'awi','2022-02-14 09:49:50',NULL,NULL),(732,3,77,NULL,NULL,NULL,NULL,NULL,NULL,NULL,'awi','2022-02-14 09:49:50',NULL,NULL),(733,3,84,NULL,NULL,NULL,NULL,NULL,NULL,NULL,'awi','2022-02-14 09:49:50',NULL,NULL),(734,3,87,NULL,NULL,NULL,NULL,NULL,NULL,NULL,'awi','2022-02-14 09:49:50',NULL,NULL),(735,3,88,NULL,NULL,NULL,NULL,NULL,NULL,NULL,'awi','2022-02-14 09:49:50',NULL,NULL),(736,3,90,NULL,NULL,NULL,NULL,NULL,NULL,NULL,'awi','2022-02-14 09:49:50',NULL,NULL),(737,3,91,NULL,NULL,NULL,NULL,NULL,NULL,NULL,'awi','2022-02-14 09:49:50',NULL,NULL),(738,3,92,'1','1','1','1','1','1','1','awi','2022-02-14 09:49:50',NULL,NULL),(739,3,93,NULL,NULL,NULL,NULL,NULL,NULL,NULL,'awi','2022-02-14 09:49:50',NULL,NULL),(740,3,94,NULL,NULL,NULL,NULL,NULL,NULL,NULL,'awi','2022-02-14 09:49:50',NULL,NULL),(741,3,2,NULL,NULL,NULL,NULL,NULL,NULL,NULL,'awi','2022-02-14 09:49:50',NULL,NULL),(742,3,3,NULL,NULL,NULL,NULL,NULL,NULL,NULL,'awi','2022-02-14 09:49:50',NULL,NULL),(743,3,5,NULL,NULL,NULL,NULL,NULL,NULL,NULL,'awi','2022-02-14 09:49:50',NULL,NULL),(744,3,4,NULL,NULL,NULL,NULL,NULL,NULL,NULL,'awi','2022-02-14 09:49:50',NULL,NULL),(745,3,6,NULL,NULL,NULL,NULL,NULL,NULL,NULL,'awi','2022-02-14 09:49:50',NULL,NULL),(746,3,7,NULL,NULL,NULL,NULL,NULL,NULL,NULL,'awi','2022-02-14 09:49:50',NULL,NULL),(747,3,8,NULL,NULL,NULL,NULL,NULL,NULL,NULL,'awi','2022-02-14 09:49:50',NULL,NULL),(748,3,9,NULL,NULL,NULL,NULL,NULL,NULL,NULL,'awi','2022-02-14 09:49:50',NULL,NULL),(1287,1,1,'1','1','1','1','1','1','1','dwi','2025-03-03 23:45:23',NULL,'2025-03-03 23:45:23'),(1288,1,62,'1',NULL,NULL,NULL,NULL,NULL,NULL,'dwi','2025-01-22 16:52:09',NULL,NULL),(1289,1,69,'1','1','1','1','1','1','1','dwi','2025-01-22 16:52:09',NULL,NULL),(1290,1,70,'1','1','1','1','1','1','1','dwi','2025-01-22 16:52:09',NULL,NULL),(1291,1,39,'1',NULL,NULL,NULL,NULL,NULL,NULL,'dwi','2025-01-22 16:52:09',NULL,NULL),(1292,1,45,'1','1','1','1','1','1','1','dwi','2025-01-22 16:52:09',NULL,NULL),(1293,1,42,'1','1','1','1','1','1','1','dwi','2025-01-22 16:52:09',NULL,NULL),(1294,1,44,'1','1','1','1','1','1','1','dwi','2025-01-22 16:52:09',NULL,NULL),(1295,1,85,'1',NULL,NULL,NULL,NULL,NULL,NULL,'dwi','2025-01-22 16:52:09',NULL,NULL),(1296,1,43,'1','1','1','1','1','1','1','dwi','2025-01-22 16:52:09',NULL,NULL),(1297,1,38,'1',NULL,NULL,NULL,NULL,NULL,NULL,'dwi','2025-01-22 16:52:09',NULL,NULL),(1298,1,41,'1','1','1','1','1','1','1','dwi','2025-01-22 16:52:09',NULL,NULL),(1299,1,95,'1','1','1','1','1','1','1','dwi','2025-01-22 16:52:09',NULL,NULL),(1300,1,18,'1','1','1','1','1','1','1','dwi','2025-01-22 16:52:09',NULL,NULL),(1301,1,10,'1','1','1','1','1','1','1','dwi','2025-03-11 12:06:40',NULL,'2025-03-11 12:06:40'),(1302,1,17,'1','1','1','1','1','1','1','dwi','2025-01-22 16:52:09',NULL,NULL),(1303,1,19,'1','1','1','1','1','1','1','dwi','2025-01-22 16:52:09',NULL,NULL),(1304,1,101,'1','1','1','1','1','1','1','dwi','2025-01-22 16:52:09',NULL,NULL),(1305,1,91,'1',NULL,NULL,NULL,NULL,NULL,NULL,'dwi','2025-01-22 16:52:09',NULL,NULL),(1306,1,92,'1','1','1','1','1','1','1','dwi','2025-01-22 16:52:09',NULL,NULL),(1307,1,88,'1',NULL,NULL,NULL,NULL,NULL,NULL,'dwi','2025-01-22 16:52:09',NULL,NULL),(1308,1,90,'1','1','1','1','1','1','1','dwi','2025-01-22 16:52:09',NULL,NULL),(1309,1,96,'1','1','1','1','1','1','1','dwi','2025-01-22 16:52:09',NULL,NULL),(1310,1,97,'1','1','1','1','1','1','1','dwi','2025-01-22 16:52:09',NULL,NULL),(1311,1,98,'1','1','1','1','1','1','1','dwi','2025-01-22 16:52:09',NULL,NULL),(1312,1,99,'1','1','1','1','1','1','1','dwi','2025-01-22 16:52:09',NULL,NULL),(1314,1,102,'1',NULL,NULL,NULL,NULL,NULL,NULL,'dwi','2025-01-22 16:52:09',NULL,NULL),(1315,1,111,'1','1','1','1','1','1','1','dwi','2025-01-22 16:52:09',NULL,NULL),(1316,1,112,'1','1','1','1','1','1','1','dwi','2025-01-22 16:52:09',NULL,NULL),(1317,1,113,'1','1','1','1','1','1','1','dwi','2025-01-22 16:52:09',NULL,NULL),(1318,1,132,'1','1','1','1','1',NULL,NULL,'dwi','2025-01-22 16:52:09',NULL,NULL),(1319,1,133,'1','1','1','1','1',NULL,NULL,'dwi','2025-01-22 16:52:09',NULL,NULL),(1328,1,103,'1',NULL,NULL,NULL,NULL,NULL,NULL,'dwi','2025-01-22 16:52:09',NULL,NULL),(1329,1,104,'1',NULL,NULL,NULL,NULL,NULL,NULL,'dwi','2025-01-22 16:52:09',NULL,NULL),(1330,1,105,'1','1','1','1','1','1','1','dwi','2025-01-22 16:52:09',NULL,NULL),(1331,1,106,'1','1','1','1','1','1','1','dwi','2025-01-22 16:52:09',NULL,NULL),(1332,1,107,'1','1','1','1','1','1','1','dwi','2025-01-22 16:52:09',NULL,NULL),(1333,1,108,'1','1','1','1','1','1','1','dwi','2025-01-22 16:52:09',NULL,NULL),(1334,1,117,'1',NULL,NULL,NULL,NULL,NULL,NULL,'dwi','2025-01-22 16:52:09',NULL,NULL),(1335,1,118,'1','1','1','1','1','1','1','dwi','2025-01-22 16:52:09',NULL,NULL),(1346,1,2,'1','1','1','1','1','1','1','dwi','2025-03-01 06:34:47',NULL,'2025-03-01 06:34:47'),(1347,1,3,'1','1','1','1','1','1','1','dwi','2025-02-27 13:04:57',NULL,'2025-02-27 13:04:57'),(1348,1,5,'1','1','1','1','1','1','1','dwi','2025-02-26 20:54:41',NULL,'2025-02-26 20:54:41'),(1349,1,4,'1','1','1','1','1','1','1','dwi','2025-01-22 16:52:09',NULL,NULL),(1350,1,6,'1','1','1','1','1','1','1','dwi','2025-02-26 21:28:04',NULL,'2025-02-26 21:28:04'),(1351,1,7,'1','1','1','1','1','1','1','dwi','2025-01-22 16:52:09',NULL,NULL),(1352,1,8,'1','1','1','1','1','1','1','dwi','2025-01-22 16:52:09',NULL,NULL),(1353,1,9,'1','1','1','1','1','1','1','dwi','2025-01-22 16:52:09',NULL,NULL),(1355,1,11,'1','1','1','1','1','1','1',NULL,'2025-03-21 04:48:02',NULL,NULL),(1356,1,12,'1','1','1','1','1','1','1',NULL,'2025-04-15 04:17:06',NULL,NULL);
/*!40000 ALTER TABLE `user_akses_role` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `user_group`
--

DROP TABLE IF EXISTS `user_group`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `user_group` (
  `id` mediumint(8) unsigned NOT NULL AUTO_INCREMENT,
  `name` varchar(20) NOT NULL,
  `description` varchar(100) NOT NULL,
  `insert_by` varchar(100) DEFAULT NULL,
  `date_insert` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp(),
  `update_by` varchar(100) DEFAULT NULL,
  `date_update` timestamp NULL DEFAULT NULL ON UPDATE current_timestamp(),
  PRIMARY KEY (`id`) USING BTREE
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci ROW_FORMAT=DYNAMIC;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `user_group`
--

LOCK TABLES `user_group` WRITE;
/*!40000 ALTER TABLE `user_group` DISABLE KEYS */;
INSERT INTO `user_group` VALUES (1,'Super Admin','Super Administrator',NULL,'2020-05-08 04:26:54',NULL,NULL),(2,'Admin','Administrator',NULL,'2020-05-08 04:27:07',NULL,NULL),(3,'User','General User',NULL,'2020-05-08 04:27:24',NULL,NULL);
/*!40000 ALTER TABLE `user_group` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `user_menu`
--

DROP TABLE IF EXISTS `user_menu`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `user_menu` (
  `user_menu_id` int(11) NOT NULL AUTO_INCREMENT,
  `title` varchar(100) NOT NULL DEFAULT '',
  `link_type` varchar(20) NOT NULL DEFAULT 'uri',
  `page_id` int(11) NOT NULL DEFAULT 0,
  `module_name` varchar(80) NOT NULL DEFAULT '',
  `url` varchar(255) NOT NULL DEFAULT '',
  `uri` varchar(255) NOT NULL DEFAULT '',
  `menu_position_id` int(11) NOT NULL DEFAULT 0,
  `position` int(11) NOT NULL DEFAULT 0,
  `target` varchar(10) DEFAULT NULL,
  `parent_id` int(11) NOT NULL DEFAULT 0,
  `is_parent` tinyint(1) NOT NULL DEFAULT 0,
  `show_menu` tinyint(1) NOT NULL DEFAULT 1,
  `um_class` varchar(100) DEFAULT NULL,
  `um_order` int(11) NOT NULL,
  `insert_by` varchar(100) DEFAULT NULL,
  `date_insert` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp(),
  `update_by` varchar(100) DEFAULT NULL,
  `date_update` timestamp NULL DEFAULT NULL ON UPDATE current_timestamp(),
  PRIMARY KEY (`user_menu_id`) USING BTREE,
  KEY `user_group_id` (`menu_position_id`) USING BTREE
) ENGINE=InnoDB AUTO_INCREMENT=13 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci ROW_FORMAT=DYNAMIC;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `user_menu`
--

LOCK TABLES `user_menu` WRITE;
/*!40000 ALTER TABLE `user_menu` DISABLE KEYS */;
INSERT INTO `user_menu` VALUES (1,'Dashboard','page',0,'dashboard_menu','dashboard/dashboard_menu','',0,0,NULL,0,0,1,NULL,1,NULL,'2025-03-21 05:15:35',NULL,'2025-03-21 05:15:35'),(2,'CCTV Surveillance','uri',0,'cctv_surveilance_menu','cctv_surveilance/cctv_surveilance_menu','',0,0,NULL,0,0,1,NULL,2,NULL,'2025-03-21 05:15:35',NULL,'2025-03-21 05:15:35'),(3,'Job Order','uri',0,'job_order_menu','job_order/job_order_menu','',0,0,NULL,0,0,1,NULL,3,NULL,'2025-03-21 05:15:35',NULL,'2025-03-21 05:15:35'),(4,'Master Data','page',0,'master','#','',0,0,NULL,0,1,1,'fa-list-alt',6,NULL,'2025-03-21 05:15:35',NULL,'2025-03-21 05:15:35'),(5,'Mother Vessel','uri',0,'master_mother_vessel_menu','master/master_mother_vessel_menu','',0,0,NULL,4,0,1,NULL,1,NULL,'2025-02-26 21:08:58',NULL,'2025-02-26 21:08:58'),(6,'Floating Crane','uri',0,'master_floating_crane_menu','master/master_floating_crane_menu','',0,0,NULL,4,0,1,NULL,2,NULL,'2025-02-26 21:25:47',NULL,'2025-02-26 21:25:47'),(7,'CCTV','uri',0,'master_cctv_menu','master/master_cctv_menu','',0,0,NULL,4,0,1,NULL,3,NULL,'2025-02-26 21:30:52',NULL,'2025-02-26 21:30:52'),(8,'General System','page',0,'','','',0,0,NULL,0,0,1,NULL,7,NULL,'2025-03-21 05:15:35',NULL,'2025-03-21 05:15:35'),(9,'Order Detail','uri',0,'job_order_detail_menu','job_order/job_order_detail_menu','',0,0,NULL,0,0,1,NULL,5,NULL,'2025-03-21 05:15:35',NULL,'2025-03-21 05:15:35'),(10,'Dashboard Detail','page',0,'dashboard_detail_menu','dashboard/dashboard_detail_menu','',0,0,NULL,0,0,0,NULL,0,NULL,'2025-03-05 04:09:41',NULL,'2025-03-05 04:09:41'),(11,'Order Summary','uri',0,'job_order_summary_menu','job_order/job_order_summary_menu','',0,0,NULL,0,0,1,NULL,4,NULL,'2025-03-21 05:15:35',NULL,'2025-03-21 05:15:35'),(12,'Activity','uri',0,'master_activity_menu','master/master_activity_menu','',0,0,NULL,4,0,1,NULL,4,NULL,'2025-02-26 21:30:52',NULL,'2025-02-26 21:30:52');
/*!40000 ALTER TABLE `user_menu` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `vessel_ais_information`
--

DROP TABLE IF EXISTS `vessel_ais_information`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `vessel_ais_information` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `mother_vessel_id` int(11) DEFAULT NULL,
  `navigational_status` varchar(45) DEFAULT NULL,
  `position_received` varchar(45) DEFAULT NULL,
  `vessel_local_time` datetime DEFAULT NULL,
  `latitude` varchar(45) DEFAULT NULL,
  `longitude` varchar(45) DEFAULT NULL,
  `speed` varchar(45) DEFAULT NULL,
  `course` varchar(45) DEFAULT NULL,
  `true_heading` varchar(45) DEFAULT NULL,
  `rate_of_turn` varchar(45) DEFAULT NULL,
  `draught` varchar(45) DEFAULT NULL,
  `reported_destination` varchar(45) DEFAULT NULL,
  `matched_destination` varchar(45) DEFAULT NULL,
  `estimated_time_of_arrival` datetime DEFAULT NULL,
  `ais_source` varchar(45) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `vessel_ais_information`
--

LOCK TABLES `vessel_ais_information` WRITE;
/*!40000 ALTER TABLE `vessel_ais_information` DISABLE KEYS */;
/*!40000 ALTER TABLE `vessel_ais_information` ENABLE KEYS */;
UNLOCK TABLES;
/*!40103 SET TIME_ZONE=@OLD_TIME_ZONE */;

/*!40101 SET SQL_MODE=@OLD_SQL_MODE */;
/*!40014 SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS */;
/*!40014 SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
/*!40111 SET SQL_NOTES=@OLD_SQL_NOTES */;

-- Dump completed on 2025-04-15 11:50:12
