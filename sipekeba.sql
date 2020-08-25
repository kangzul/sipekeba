-- MySQL dump 10.17  Distrib 10.3.23-MariaDB, for debian-linux-gnu (x86_64)
--
-- Host: localhost    Database: sipekeba
-- ------------------------------------------------------
-- Server version	10.3.23-MariaDB-1:10.3.23+maria~bionic

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
-- Table structure for table `master_admin`
--

DROP TABLE IF EXISTS `master_admin`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `master_admin` (
  `id_admin` int(11) unsigned NOT NULL AUTO_INCREMENT,
  `username` varchar(25) NOT NULL,
  `password` varchar(100) NOT NULL,
  `real_name` varchar(100) NOT NULL,
  `email` varchar(50) NOT NULL,
  `status` tinyint(1) NOT NULL,
  `created_at` datetime NOT NULL,
  `updated_at` datetime DEFAULT NULL,
  `deleted_at` datetime DEFAULT NULL,
  PRIMARY KEY (`id_admin`),
  UNIQUE KEY `username` (`username`)
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `master_admin`
--

LOCK TABLES `master_admin` WRITE;
/*!40000 ALTER TABLE `master_admin` DISABLE KEYS */;
INSERT INTO `master_admin` VALUES (1,'admin','$2y$10$qCpYfukf6wI2PM5tV6gCteDKvEOvnPEkUaEdEQqfsTFrjJysp1/8u','admin','admin@gmail.com',1,'2020-08-13 20:00:00',NULL,NULL),(2,'adminavis','$2y$10$QIx7qYdWXlhHZVDLaxfpaeZT9Y/xUdJoxbWvBIgmL6jLm4hDpFr9e','aprimavista','adminavis@gmail.com',1,'2020-08-25 11:03:05',NULL,NULL);
/*!40000 ALTER TABLE `master_admin` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `master_laporan`
--

DROP TABLE IF EXISTS `master_laporan`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `master_laporan` (
  `id_laporan` int(11) NOT NULL AUTO_INCREMENT,
  `id_user` int(11) NOT NULL,
  `alasan` text NOT NULL,
  `id_layanan` int(11) NOT NULL,
  `created_at` datetime NOT NULL,
  `deleted_at` datetime DEFAULT NULL,
  `status` tinyint(1) NOT NULL,
  PRIMARY KEY (`id_laporan`),
  KEY `id_user` (`id_user`),
  KEY `id_layanan` (`id_layanan`),
  CONSTRAINT `master_laporan_ibfk_1` FOREIGN KEY (`id_user`) REFERENCES `master_user` (`id_user`) ON DELETE NO ACTION ON UPDATE CASCADE,
  CONSTRAINT `master_laporan_ibfk_2` FOREIGN KEY (`id_layanan`) REFERENCES `master_layanan` (`id`) ON DELETE NO ACTION ON UPDATE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=5 DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `master_laporan`
--

LOCK TABLES `master_laporan` WRITE;
/*!40000 ALTER TABLE `master_laporan` DISABLE KEYS */;
INSERT INTO `master_laporan` VALUES (1,13,'jatuh',1,'2020-08-25 06:47:33',NULL,1),(2,13,'tertelan did atm',4,'2020-08-25 07:20:12',NULL,1),(3,13,'jatuh',3,'2020-08-25 07:31:05',NULL,2),(4,13,'lupa',4,'2020-08-25 07:31:51',NULL,2);
/*!40000 ALTER TABLE `master_laporan` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `master_layanan`
--

DROP TABLE IF EXISTS `master_layanan`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `master_layanan` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `nama_layanan` varchar(150) NOT NULL,
  `keterangan` varchar(100) NOT NULL,
  `status` tinyint(1) NOT NULL,
  `created_at` datetime NOT NULL,
  `deleted_at` datetime DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=5 DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `master_layanan`
--

LOCK TABLES `master_layanan` WRITE;
/*!40000 ALTER TABLE `master_layanan` DISABLE KEYS */;
INSERT INTO `master_layanan` VALUES (1,'KEHILANGAN KTP','Layanan mengurus surat kehilangan KTP',1,'2020-08-14 20:51:50',NULL),(2,'KEHILANGAN KK','Layanan mengurus surat kehilangan Kartu Keluarga',1,'2020-08-15 03:54:48',NULL),(3,'KEHILANGAN  BPJS','Layanan mengurus surat kehilangan BPJS',1,'2020-08-25 06:55:25',NULL),(4,'KEHILANGAN BUKU TABUNGAN ATAU ATM','Layanan mengurus surat kehilangan Buku Tabungan atau ATM',1,'2020-08-25 07:07:06',NULL);
/*!40000 ALTER TABLE `master_layanan` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `master_syarat_layanan`
--

DROP TABLE IF EXISTS `master_syarat_layanan`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `master_syarat_layanan` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `id_layanan` int(11) NOT NULL,
  `syarat` varchar(250) NOT NULL,
  `keterangan` varchar(250) NOT NULL,
  `status` tinyint(1) NOT NULL,
  `created_at` datetime NOT NULL,
  `deleted_at` datetime DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `id_layanan` (`id_layanan`),
  CONSTRAINT `master_syarat_layanan_ibfk_1` FOREIGN KEY (`id_layanan`) REFERENCES `master_layanan` (`id`) ON DELETE NO ACTION ON UPDATE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=16 DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `master_syarat_layanan`
--

LOCK TABLES `master_syarat_layanan` WRITE;
/*!40000 ALTER TABLE `master_syarat_layanan` DISABLE KEYS */;
INSERT INTO `master_syarat_layanan` VALUES (1,1,'Surat Pengantar Kelurahan','Surat dari kelurahan',1,'2020-08-14 21:35:17','2020-08-25 07:07:56'),(2,1,'fotocopy KK','Kehilangan KTP',1,'2020-08-14 21:36:22','2020-08-25 07:08:02'),(3,2,'Surat Keterangan dari Kelurahan','Surat dari kelurahan',1,'2020-08-15 03:55:08','2020-08-25 07:09:12'),(4,2,'fotocopy KK','surat dari kecamatan',1,'2020-08-15 03:55:22','2020-08-25 07:09:17'),(5,3,'surat keterangan dari BPJS beserta nomor BPJS','Kehilangan BPJS',1,'2020-08-25 06:56:06','2020-08-25 07:11:21'),(6,3,'fotocopy Identitas Pelapor','Kehilangan BPJS',1,'2020-08-25 06:56:40','2020-08-25 07:11:24'),(7,2,'fotocopy identitas pelapor','kehilangan KK',1,'2020-08-25 07:00:31','2020-08-25 07:09:21'),(8,1,'fotocopy Identitas Pelapor','Kehilangan KTP',1,'2020-08-25 07:02:01','2020-08-25 07:08:06'),(9,1,'fotocopy Kartu Keluarga','',1,'2020-08-25 07:08:26',NULL),(10,1,'Surat Keterangan dari Kelurahan','',1,'2020-08-25 07:08:49',NULL),(11,1,'fotocopy identitas Pelapor','',1,'2020-08-25 07:09:03',NULL),(12,2,'Surat Keterangan dari Kelurahan beserta Nomor Kartu Keluarga','',1,'2020-08-25 07:09:50',NULL),(13,2,'fotocopy identitas Pelapor','',1,'2020-08-25 07:10:07',NULL),(14,3,'surat keterangan dari BPJS beserta nomor BPJS','',1,'2020-08-25 07:10:54',NULL),(15,3,'fotocopy identitas Pelapor','',1,'2020-08-25 07:11:12',NULL);
/*!40000 ALTER TABLE `master_syarat_layanan` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `master_user`
--

DROP TABLE IF EXISTS `master_user`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `master_user` (
  `id_user` int(11) NOT NULL AUTO_INCREMENT,
  `nama_lengkap` varchar(255) NOT NULL,
  `email` varchar(100) NOT NULL,
  `password` varchar(255) NOT NULL,
  `jenis_kelamin` tinyint(1) NOT NULL,
  `tempat_tgl_lahir` varchar(255) NOT NULL,
  `alamat` text NOT NULL,
  `kewarganegaraan` int(11) NOT NULL,
  `pekerjaan` varchar(255) NOT NULL,
  `agama` int(11) NOT NULL,
  `status` int(11) NOT NULL,
  `created_at` datetime NOT NULL,
  `deleted_at` datetime DEFAULT NULL,
  PRIMARY KEY (`id_user`),
  UNIQUE KEY `email` (`email`)
) ENGINE=InnoDB AUTO_INCREMENT=19 DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `master_user`
--

LOCK TABLES `master_user` WRITE;
/*!40000 ALTER TABLE `master_user` DISABLE KEYS */;
INSERT INTO `master_user` VALUES (1,'demo','demo@gmail.com','$2y$10$6JKnkUPWEk7fHEbeQ2/IlOFiCHgP.vjzB3vLRN06l09G1.iQvBWMi',1,'demo','demo',1,'demo',1,0,'2020-08-25 06:00:00','2020-08-25 19:46:16'),(7,'demo1','demo1@gmail.com','$2y$10$0ek2mt96t8Sz2QlBEXc0juPR.ytYr7eKp4oJaRY5MRYL8rIUkWJoy',1,'demo1','demo1',1,'demo1',1,1,'2020-08-25 06:00:00',NULL),(13,'aprimavista','aprimavistaaa@gmail.com','$2y$10$PD0TnHaU1pCZtSAUZKsvU.in0JzdKLIYqOp6Rkiuo4yq0ZXocYVcS',0,'gresik, 23-09-1996','Malang',1,'mahasiswa',1,1,'2020-08-25 06:00:00',NULL);
/*!40000 ALTER TABLE `master_user` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `rel_laporan`
--

DROP TABLE IF EXISTS `rel_laporan`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `rel_laporan` (
  `id_rel` int(11) NOT NULL AUTO_INCREMENT,
  `id_laporan` int(11) NOT NULL,
  `photo` text NOT NULL,
  `created_at` datetime NOT NULL,
  `deleted_at` datetime DEFAULT NULL,
  PRIMARY KEY (`id_rel`),
  KEY `id_laporan` (`id_laporan`),
  CONSTRAINT `rel_laporan_ibfk_1` FOREIGN KEY (`id_laporan`) REFERENCES `master_laporan` (`id_laporan`) ON DELETE NO ACTION ON UPDATE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=7 DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `rel_laporan`
--

LOCK TABLES `rel_laporan` WRITE;
/*!40000 ALTER TABLE `rel_laporan` DISABLE KEYS */;
INSERT INTO `rel_laporan` VALUES (1,1,'IMG_20200824_1905406190929442170302071.jpg','2020-08-25 06:47:34',NULL),(2,2,'stnk4054364142877326012.jpg','2020-08-25 07:20:13',NULL),(3,3,'surat%20nikah565450051985502597.jpg','2020-08-25 07:31:06',NULL),(4,4,'ijazah6817862177592687655.jpg','2020-08-25 07:31:51',NULL),(5,4,'sim5266668778234232865.jpg','2020-08-25 07:31:52',NULL),(6,4,'IMG_20200824_1905404902623624016572563.jpg','2020-08-25 07:31:53',NULL);
/*!40000 ALTER TABLE `rel_laporan` ENABLE KEYS */;
UNLOCK TABLES;
/*!40103 SET TIME_ZONE=@OLD_TIME_ZONE */;

/*!40101 SET SQL_MODE=@OLD_SQL_MODE */;
/*!40014 SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS */;
/*!40014 SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
/*!40111 SET SQL_NOTES=@OLD_SQL_NOTES */;

-- Dump completed on 2020-08-25 21:40:20
