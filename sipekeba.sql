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
  `id_user` int(11) unsigned NOT NULL AUTO_INCREMENT,
  `username` varchar(25) NOT NULL,
  `password` varchar(100) NOT NULL,
  `real_name` varchar(100) NOT NULL,
  `email` varchar(50) NOT NULL,
  `status` tinyint(1) NOT NULL,
  `created_at` datetime NOT NULL,
  `updated_at` datetime DEFAULT NULL,
  `deleted_at` datetime DEFAULT NULL,
  PRIMARY KEY (`id_user`),
  UNIQUE KEY `username` (`username`)
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `master_admin`
--

LOCK TABLES `master_admin` WRITE;
/*!40000 ALTER TABLE `master_admin` DISABLE KEYS */;
INSERT INTO `master_admin` VALUES (1,'kangzul','$2y$10$fExeWs8oFxBb7ystToT0me.i2XJ9TU2vLEBtXKH8/qcVzjufqKPt.','Zulfa Abdul Majid','kangzulf4@gmail.com',1,'2020-08-13 20:00:00',NULL,NULL),(2,'admin','$2y$10$qCpYfukf6wI2PM5tV6gCteDKvEOvnPEkUaEdEQqfsTFrjJysp1/8u','admin','admin@gmail.com',1,'2020-08-13 20:00:00',NULL,NULL);
/*!40000 ALTER TABLE `master_admin` ENABLE KEYS */;
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
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `master_layanan`
--

LOCK TABLES `master_layanan` WRITE;
/*!40000 ALTER TABLE `master_layanan` DISABLE KEYS */;
INSERT INTO `master_layanan` VALUES (1,'KEHILANGAN KTP','layanan mengurus surat kehilangan ktp',1,'2020-08-14 20:51:50',NULL);
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
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `master_syarat_layanan`
--

LOCK TABLES `master_syarat_layanan` WRITE;
/*!40000 ALTER TABLE `master_syarat_layanan` DISABLE KEYS */;
INSERT INTO `master_syarat_layanan` VALUES (1,1,'Surat Pengantar Kelurahan','Surat dari kelurahan',1,'2020-08-14 21:35:17',NULL),(2,1,'Surat Pengantar RT','Surat dari RT setempat',1,'2020-08-14 21:36:22',NULL);
/*!40000 ALTER TABLE `master_syarat_layanan` ENABLE KEYS */;
UNLOCK TABLES;
/*!40103 SET TIME_ZONE=@OLD_TIME_ZONE */;

/*!40101 SET SQL_MODE=@OLD_SQL_MODE */;
/*!40014 SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS */;
/*!40014 SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
/*!40111 SET SQL_NOTES=@OLD_SQL_NOTES */;

-- Dump completed on 2020-08-14 21:51:45
