-- MariaDB dump 10.19  Distrib 10.4.32-MariaDB, for Win64 (AMD64)
--
-- Host: localhost    Database: elstore_gis
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
-- Table structure for table `app_ratings`
--

DROP TABLE IF EXISTS `app_ratings`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `app_ratings` (
  `id` int(11) unsigned NOT NULL AUTO_INCREMENT,
  `user_id` int(11) unsigned NOT NULL,
  `rating` int(1) NOT NULL,
  `ulasan` text DEFAULT NULL,
  `created_at` datetime DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `user_id` (`user_id`),
  CONSTRAINT `app_ratings_ibfk_1` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `app_ratings`
--

LOCK TABLES `app_ratings` WRITE;
/*!40000 ALTER TABLE `app_ratings` DISABLE KEYS */;
INSERT INTO `app_ratings` VALUES (1,3,4,'OKE LAH','2026-06-12 00:54:09'),(2,5,5,'gg','2026-06-12 03:00:29'),(3,6,4,'lumayan','2026-06-14 05:47:23');
/*!40000 ALTER TABLE `app_ratings` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `ci_sessions`
--

DROP TABLE IF EXISTS `ci_sessions`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `ci_sessions` (
  `id` varchar(128) NOT NULL,
  `ip_address` varchar(45) NOT NULL,
  `timestamp` int(10) unsigned NOT NULL DEFAULT 0,
  `data` blob NOT NULL,
  KEY `ci_sessions_timestamp` (`timestamp`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `ci_sessions`
--

LOCK TABLES `ci_sessions` WRITE;
/*!40000 ALTER TABLE `ci_sessions` DISABLE KEYS */;
/*!40000 ALTER TABLE `ci_sessions` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `migrations`
--

DROP TABLE IF EXISTS `migrations`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `migrations` (
  `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `version` varchar(255) NOT NULL,
  `class` text NOT NULL,
  `group` varchar(255) NOT NULL,
  `namespace` varchar(255) NOT NULL,
  `time` int(11) NOT NULL,
  `batch` int(11) unsigned NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `migrations`
--

LOCK TABLES `migrations` WRITE;
/*!40000 ALTER TABLE `migrations` DISABLE KEYS */;
/*!40000 ALTER TABLE `migrations` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `toko_elektronik`
--

DROP TABLE IF EXISTS `toko_elektronik`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `toko_elektronik` (
  `id` int(11) unsigned NOT NULL AUTO_INCREMENT,
  `user_id` int(11) unsigned DEFAULT NULL COMMENT 'Pemilik toko (FK users.id)',
  `nama_toko` varchar(150) NOT NULL,
  `slug` varchar(200) DEFAULT NULL,
  `kategori` enum('Smartphone','Komputer & Laptop','Audio & Video','Peralatan Listrik','Elektronik Umum','Apple Authorized','Gaming','Kamera & Optik','Lainnya') NOT NULL DEFAULT 'Elektronik Umum',
  `alamat` text NOT NULL,
  `kecamatan` varchar(100) DEFAULT NULL,
  `kota` varchar(100) NOT NULL DEFAULT 'Kisaran',
  `provinsi` varchar(100) NOT NULL DEFAULT 'Sumatera Utara',
  `latitude` decimal(11,8) NOT NULL,
  `longitude` decimal(11,8) NOT NULL,
  `no_telepon` varchar(20) DEFAULT NULL,
  `email_toko` varchar(150) DEFAULT NULL,
  `website` varchar(255) DEFAULT NULL,
  `jam_buka` varchar(50) DEFAULT NULL COMMENT 'Contoh: 08:00-21:00',
  `deskripsi` text DEFAULT NULL,
  `foto` varchar(255) DEFAULT NULL,
  `rating` decimal(3,1) NOT NULL DEFAULT 0.0,
  `total_ulasan` int(11) NOT NULL DEFAULT 0,
  `status` enum('aktif','nonaktif','pending') NOT NULL DEFAULT 'aktif',
  `created_at` datetime DEFAULT NULL,
  `updated_at` datetime DEFAULT NULL,
  `deleted_at` datetime DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `user_id` (`user_id`),
  KEY `kategori` (`kategori`),
  KEY `status` (`status`),
  KEY `koordinat` (`latitude`,`longitude`)
) ENGINE=InnoDB AUTO_INCREMENT=14 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `toko_elektronik`
--

LOCK TABLES `toko_elektronik` WRITE;
/*!40000 ALTER TABLE `toko_elektronik` DISABLE KEYS */;
INSERT INTO `toko_elektronik` VALUES (1,NULL,'KECE PONSEL',NULL,'Smartphone','Jl. Sisingamangaraja No.538, Sendang Sari','Kisaran Barat','Asahan','Sumatera Utara',2.98199378,99.61269379,'082273357335','default@gmail.com',NULL,'08:00-21:00','Menyediakan Smartphone dan Sparepart Smartphone','1781318367_c570cba483e0780747e3.png',4.5,110,'aktif','2026-06-09 21:22:57','2026-06-14 04:01:44',NULL),(2,NULL,'Toko Sinar Terang',NULL,'Peralatan Listrik','Jl. Imam Bonjol No.69, Kisaran Timur','Kisaran Timur','Asahan','Sumatera Utara',2.98206514,99.63058342,'-','default@gmail.com',NULL,'08.00–14.30','Pusat Peralatan Elektronik terlengkap dengan berbagai merek dan produk.','1781408647_5f689743132bddd5db7d.jpg',4.7,6,'aktif','2026-06-09 21:22:57','2026-06-14 03:44:07',NULL),(3,NULL,'Mecca Ponsel',NULL,'Smartphone','Jl. Imam Bonjol No.18, Kisaran Kota','Kisaran Barat','Asahan','Sumatera Utara',2.98459969,99.63058375,'062341548','default@gmail.com',NULL,'08.00–23.00','Menyediakan Ponsel','1781318813_1f6bdd004c0a54584496.jpg',4.2,47,'aktif','2026-06-09 21:22:57','2026-06-13 02:46:53',NULL),(4,NULL,'Toko Listrik Maju',NULL,'Peralatan Listrik','Jl. Cut Nyak Dien No.3','Kisaran Barat','Kisaran','Sumatera Utara',2.97900000,99.61100000,'0623-33333',NULL,NULL,'07:30-18:00','Menyediakan berbagai peralatan listrik dan instalasi rumah tangga.',NULL,3.9,12,'aktif','2026-06-09 21:22:57','2026-06-09 14:44:07','2026-06-09 14:44:07'),(5,NULL,'Elco Computer',NULL,'Komputer & Laptop','JL Cokroaminoto, No. 190, Kisaran Barat Mekar Baru, Kisaran Kota','Kisaran Barat','Asahan','Sumatera Utara',2.98601414,99.62236493,'085361521100','default@gmail.com',NULL,'08.30–15.30','Spesialis komputer, laptop, dan aksesoris IT terlengkap.','1781319580_541a9f0ccea8733f76fb.jpg',4.4,35,'aktif','2026-06-09 21:22:57','2026-06-13 02:59:40',NULL),(6,NULL,'Central Games Elektronik',NULL,'Gaming','Jl. Cokro Aminoto No.85, Kisaran Kota','Kisaran Barat','Asahan','Sumatera Utara',2.98531741,99.62673903,'081397799700','default@gmail.com',NULL,'08.30–20.00','Gaming','1781319883_76f9e682355fd3db1558.jpg',3.6,28,'aktif','2026-06-09 21:22:57','2026-06-13 03:04:43',NULL),(7,NULL,'Cyber Computer',NULL,'Komputer & Laptop','Jl. Diponegoro No.279, Kisaran Baru','Kisaran Barat','Asahan','Sumatera Utara',2.98320674,99.62025890,'085358910033','default@gmail.com',NULL,'09.00–17.30','Console gaming, PC gaming, aksesori, dan rental game terlengkap.','1781319717_8b25e3f40c3aa6acaed0.jpg',5.0,45,'aktif','2026-06-09 21:22:57','2026-06-13 03:01:57',NULL),(8,NULL,'Intan Computer',NULL,'Komputer & Laptop','JL Imam Bonjol, No. 97, Kisaran Kota','Kisaran Timur','Asahan','Sumatera Utara',2.98162650,99.63060558,'081375852101','kisaran@gmail.com',NULL,'08.00–19.00','Menyediakan Segala Jenis Peralatan dan Kebutuhan Komputer/Laptop','1781236590_a6cd6266790dbea9e884.jpg',4.2,165,'aktif','2026-06-10 02:50:26','2026-06-12 03:56:30',NULL),(9,NULL,'Columbus',NULL,'Elektronik Umum','Jl. Imam Bonjol No.194 B, Tebing Kisaran','Kisaran Timur','Asahan','Sumatera Utara',2.97922649,99.63010132,'081269002962','colombus@gmail.com',NULL,'08.00–19.30','Perabotan Rumah tangga Elektronik','1781236782_dfb9169d2e9c450b9a69.jpg',4.4,4,'aktif','2026-06-10 02:54:12','2026-06-12 03:59:42',NULL),(10,NULL,'Erafone Kota Kisaran',NULL,'Smartphone','Jl. Imam Bonjol No.162, Kisaran Kota','Kisaran Barat','Asahan','Sumatera Utara',2.97978406,99.63015409,'082124389540','erafone@gmail.com',NULL,'09.00–22.00','Menyediakan Smartphone Resmi yang Ter-Integrasi','1781105642_6ad4a0bb220afbc1e3b4.jpg',4.7,75,'aktif','2026-06-10 15:34:02','2026-06-12 03:50:36',NULL),(11,NULL,'Mulia Sukses Elektronik',NULL,'Elektronik Umum','Jl. HOS Cokroaminoto No.152, Kisaran Kota','Kisaran Barat','Asahan','Sumatera Utara',2.98632556,99.61639166,'081370338584','',NULL,'09:00-21:00','Menyediakan peralatan Elektronik sehari-hari untuk pelanggan','1781229132_67facc1e1847d3b2af7f.png',5.0,98,'aktif','2026-06-12 01:52:12','2026-06-12 03:39:42',NULL),(12,2,'Toko Karya',NULL,'Elektronik Umum','Jl. P. Polem No.49, Kisaran Kota','Kisaran Barat','Asahan','Sumatera Utara',2.98361781,99.62607706,'-','default@gmail.com',NULL,'08.00–18.00','Adalah Dia','1781410608_d107f3f448c2316b1726.jpg',4.9,72,'aktif','2026-06-14 04:16:48','2026-06-14 05:36:30',NULL),(13,NULL,'Saudara Baru Elektronik',NULL,'Elektronik Umum','Jl. Veteran No.43, Indra Sakti','Tanjung Balai Selatan','Tanjung Balai','Sumatera Utara',2.96762363,99.80474640,'(0623) 92723','default@gmail.com',NULL,'08.30–18.00','Menjual Perabotan Elektronik di Kota Tanjung Balai','1781414097_6e08276472c703140271.jpg',4.1,29,'aktif','2026-06-14 05:14:57','2026-06-14 05:14:57',NULL);
/*!40000 ALTER TABLE `toko_elektronik` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `users`
--

DROP TABLE IF EXISTS `users`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `users` (
  `id` int(11) unsigned NOT NULL AUTO_INCREMENT,
  `nama_lengkap` varchar(100) NOT NULL,
  `username` varchar(50) NOT NULL,
  `email` varchar(150) NOT NULL,
  `no_hp` varchar(15) DEFAULT NULL,
  `password` varchar(255) NOT NULL,
  `role` enum('admin','pemilik_toko','pengguna') NOT NULL DEFAULT 'pengguna',
  `status` enum('aktif','pending','nonaktif') NOT NULL DEFAULT 'aktif',
  `foto_profil` varchar(255) DEFAULT NULL,
  `remember_token` varchar(100) DEFAULT NULL,
  `last_login` datetime DEFAULT NULL,
  `created_at` datetime DEFAULT NULL,
  `updated_at` datetime DEFAULT NULL,
  `deleted_at` datetime DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `username` (`username`),
  UNIQUE KEY `email` (`email`),
  KEY `role` (`role`),
  KEY `status` (`status`)
) ENGINE=InnoDB AUTO_INCREMENT=7 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `users`
--

LOCK TABLES `users` WRITE;
/*!40000 ALTER TABLE `users` DISABLE KEYS */;
INSERT INTO `users` VALUES (1,'Administrator','admin','admin@elstore-gis.id','081534159731','$2y$10$mhklR/OgV1qVbtNoQp3uHuC4oIDOmQzPkbeXkw7/dbIUllZlSWfP2','admin','aktif',NULL,NULL,'2026-06-18 01:45:17','2026-06-09 21:22:57','2026-06-18 01:45:17',NULL),(2,'Budi Santoso','pemilik1','pemilik@elstore.id','081234567890','$2y$10$yVkRQTxabtnzs/4eC37rhOmWgl4TNIKfxY9lWo0JGx/yuj6GC3XOa','pemilik_toko','aktif',NULL,NULL,'2026-06-14 05:36:15','2026-06-09 21:22:57','2026-06-14 05:36:15',NULL),(3,'Andi Wijaya','user1','user@elstore.id','082345678901','$2y$10$yVkRQTxabtnzs/4eC37rhOmWgl4TNIKfxY9lWo0JGx/yuj6GC3XOa','pengguna','aktif',NULL,NULL,'2026-06-18 02:23:45','2026-06-09 21:22:57','2026-06-18 02:23:45',NULL),(4,'Ghazi Al-Ghifari','rieee_33','fahriefendi93486@gmail.com','081534159731','$2y$10$V01iEo1HMZZu3w5DkJ/1R.2LZ0I81Nx1K5H5RcpclZWYFL0algB5y','pengguna','aktif',NULL,NULL,NULL,'2026-06-10 01:41:48','2026-06-14 03:51:06','2026-06-14 03:51:06'),(5,'Cinta Zahara','cinta1','fcxxguh@gmail.com','082345678901','$2y$10$jOVx/tTE/jiw0LSR5Pl6vur5v1PnV4Zhsn/7SxTcn2fNMOEMSUnDG','pengguna','aktif',NULL,NULL,NULL,'2026-06-12 03:00:03','2026-06-12 03:00:03',NULL),(6,'Tiwi Aulia','tiwiaulia59','tiwiaulia59@gmail.com','082345678901','$2y$10$R.4CkiINWlXeIzAkoMt46Oh2Yu8jnp1F.pt9CMoWRtO7ilYhxQG/y','pengguna','aktif',NULL,NULL,NULL,'2026-06-14 05:46:57','2026-06-14 05:47:07',NULL);
/*!40000 ALTER TABLE `users` ENABLE KEYS */;
UNLOCK TABLES;
/*!40103 SET TIME_ZONE=@OLD_TIME_ZONE */;

/*!40101 SET SQL_MODE=@OLD_SQL_MODE */;
/*!40014 SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS */;
/*!40014 SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
/*!40111 SET SQL_NOTES=@OLD_SQL_NOTES */;

-- Dump completed on 2026-06-18  9:44:57
