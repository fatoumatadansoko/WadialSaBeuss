-- MySQL dump 10.13  Distrib 8.0.37, for Linux (x86_64)
--
-- Host: localhost    Database: WadialSaBeuss
-- ------------------------------------------------------
-- Server version	8.0.37-0ubuntu0.23.10.2

/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!50503 SET NAMES utf8mb4 */;
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
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `admins` (
  `id` bigint unsigned NOT NULL AUTO_INCREMENT,
  `user_id` bigint unsigned NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `admins_user_id_foreign` (`user_id`),
  CONSTRAINT `admins_user_id_foreign` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `admins`
--

LOCK TABLES `admins` WRITE;
/*!40000 ALTER TABLE `admins` DISABLE KEYS */;
/*!40000 ALTER TABLE `admins` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `cache`
--

DROP TABLE IF EXISTS `cache`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `cache` (
  `key` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `value` mediumtext COLLATE utf8mb4_unicode_ci NOT NULL,
  `expiration` int NOT NULL,
  PRIMARY KEY (`key`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `cache`
--

LOCK TABLES `cache` WRITE;
/*!40000 ALTER TABLE `cache` DISABLE KEYS */;
INSERT INTO `cache` VALUES ('cS0jdz3FwXJGtIW1','a:1:{s:11:\"valid_until\";i:1731327791;}',1732387211),('dHdDeJfyS1im0MTW','a:1:{s:11:\"valid_until\";i:1731177570;}',1732310370);
/*!40000 ALTER TABLE `cache` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `cache_locks`
--

DROP TABLE IF EXISTS `cache_locks`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `cache_locks` (
  `key` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `owner` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `expiration` int NOT NULL,
  PRIMARY KEY (`key`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `cache_locks`
--

LOCK TABLES `cache_locks` WRITE;
/*!40000 ALTER TABLE `cache_locks` DISABLE KEYS */;
/*!40000 ALTER TABLE `cache_locks` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `carte_invitations`
--

DROP TABLE IF EXISTS `carte_invitations`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `carte_invitations` (
  `id` bigint unsigned NOT NULL AUTO_INCREMENT,
  `user_id` bigint unsigned NOT NULL,
  `categorie_id` bigint unsigned NOT NULL,
  `nom` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `image` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `contenu` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `carte_invitations_user_id_foreign` (`user_id`),
  KEY `carte_invitations_categorie_id_foreign` (`categorie_id`),
  CONSTRAINT `carte_invitations_categorie_id_foreign` FOREIGN KEY (`categorie_id`) REFERENCES `categories` (`id`) ON DELETE CASCADE,
  CONSTRAINT `carte_invitations_user_id_foreign` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=8 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `carte_invitations`
--

LOCK TABLES `carte_invitations` WRITE;
/*!40000 ALTER TABLE `carte_invitations` DISABLE KEYS */;
INSERT INTO `carte_invitations` VALUES (3,7,2,'Invitation Mariage,jj','cartes_invitations/hmSKbPpYhe6SEQzB8njwtQcQloWdWzCAPEn7KJIS.png','Vous êtes invités à notre mariage le 25 décembre 2024.','2024-10-16 11:52:44','2024-10-23 17:54:16'),(4,1,2,'Fatima & Khalil','cartes_invitations/hmSKbPpYhe6SEQzB8njwtQcQloWdWzCAPEn7KJIS.png','22/04/2025','2024-10-16 12:59:42','2024-10-16 12:59:42'),(5,1,2,'Fatima & Khalil','cartes_invitations/yhCQ85q63jCk62KyO55ymP7aAXXZRi6J2rupCDch.png','22/04/2025','2024-10-16 13:00:09','2024-10-16 13:00:09'),(6,1,3,'Séminaire','cartes_invitations/WcWHICyjFmdisYuNCfJTf8qFI3VHuYcl9TCexxFU.png','54887877','2024-10-16 16:34:53','2024-10-16 16:34:53'),(7,1,1,'llllllllllll','cartes_invitations/w61qPwImRSBbEv4MSoFgQLJAcMXQULQhzTOslmtz.jpg','kkkkkkkkkkkkkkkkkkkkkkk','2024-10-30 12:11:14','2024-10-30 12:11:14');
/*!40000 ALTER TABLE `carte_invitations` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `carte_personnalisees`
--

DROP TABLE IF EXISTS `carte_personnalisees`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `carte_personnalisees` (
  `id` bigint unsigned NOT NULL AUTO_INCREMENT,
  `nom` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `image` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `contenu` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `carte_invitation_id` bigint unsigned NOT NULL,
  `client_id` bigint unsigned NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `carte_personnalisees_carte_invitation_id_foreign` (`carte_invitation_id`),
  KEY `carte_personnalisees_client_id_foreign` (`client_id`),
  CONSTRAINT `carte_personnalisees_carte_invitation_id_foreign` FOREIGN KEY (`carte_invitation_id`) REFERENCES `carte_invitations` (`id`) ON DELETE CASCADE,
  CONSTRAINT `carte_personnalisees_client_id_foreign` FOREIGN KEY (`client_id`) REFERENCES `clients` (`id`) ON DELETE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=26 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `carte_personnalisees`
--

LOCK TABLES `carte_personnalisees` WRITE;
/*!40000 ALTER TABLE `carte_personnalisees` DISABLE KEYS */;
INSERT INTO `carte_personnalisees` VALUES (9,'graduate','cartes_invitations/R4dVAoBn0MLZ0bOEz9sgHEEPIo24lH4BBl4zDf4A.png','25/10/2024',3,1,'2024-10-16 11:53:27','2024-10-16 11:53:27'),(10,'Fatima & Khalil','cartes_invitations/hmSKbPpYhe6SEQzB8njwtQcQloWdWzCAPEn7KJIS.png','22/04/2025',4,1,'2024-10-16 13:02:11','2024-10-16 13:02:11'),(11,'Séminaire','cartes_invitations/R4dVAoBn0MLZ0bOEz9sgHEEPIo24lH4BBl4zDf4A.png','25/10/2024',3,1,'2024-10-16 16:32:03','2024-10-16 16:32:03'),(12,'Saliou','cartes_invitations/hmSKbPpYhe6SEQzB8njwtQcQloWdWzCAPEn7KJIS.png','22/04/2025',4,1,'2024-10-16 16:53:59','2024-10-16 16:53:59'),(13,'Fatima & Khalil','cartes_invitations/yhCQ85q63jCk62KyO55ymP7aAXXZRi6J2rupCDch.png','Nous avons le plaisir de vous inviter à participer à notre événement de mariage qui se tiendra le 02/10/2024',5,1,'2024-10-17 16:37:16','2024-10-17 16:37:16'),(14,'Fatima & Khalil','cartes_invitations/hmSKbPpYhe6SEQzB8njwtQcQloWdWzCAPEn7KJIS.png','22/04/2025dddddddd',4,1,'2024-10-25 12:36:06','2024-10-25 12:36:06'),(15,'Fatima & Khalilmmmmmmm','cartes_invitations/hmSKbPpYhe6SEQzB8njwtQcQloWdWzCAPEn7KJIS.png','22/04/2025',4,1,'2024-10-25 12:38:51','2024-10-25 12:38:51'),(16,'Fatima & Khalil1','cartes_invitations/hmSKbPpYhe6SEQzB8njwtQcQloWdWzCAPEn7KJIS.png','22/04/2025',4,1,'2024-10-25 12:50:32','2024-10-25 12:50:32'),(17,'Fatima & Khalil','cartes_invitations/yhCQ85q63jCk62KyO55ymP7aAXXZRi6J2rupCDch.png','22/04/2025,,,,,,,,,',5,1,'2024-10-25 14:46:18','2024-10-25 14:46:18'),(18,'Fatima & Khalil','cartes_invitations/hmSKbPpYhe6SEQzB8njwtQcQloWdWzCAPEn7KJIS.png','lellll',4,1,'2024-10-25 17:00:58','2024-10-25 17:00:58'),(19,'jdkdkzk','cartes_invitations/hmSKbPpYhe6SEQzB8njwtQcQloWdWzCAPEn7KJIS.png','mariagefatimabelary',3,1,'2024-10-28 11:32:55','2024-10-28 11:32:55'),(20,'12/02/2025','cartes_invitations/hmSKbPpYhe6SEQzB8njwtQcQloWdWzCAPEn7KJIS.png','mariagefatimabelary',3,1,'2024-10-28 12:05:21','2024-10-28 12:05:21'),(21,'12/02/2025','cartes_invitations/hmSKbPpYhe6SEQzB8njwtQcQloWdWzCAPEn7KJIS.png','mariagefatimabelary',3,1,'2024-10-29 11:23:34','2024-10-29 11:23:34'),(22,'12/02/2025','cartes_invitations/yhCQ85q63jCk62KyO55ymP7aAXXZRi6J2rupCDch.png','mariagefatimabelary',5,1,'2024-10-29 11:25:20','2024-10-29 11:25:20'),(23,'Mariagedemacousine','cartes_invitations/yhCQ85q63jCk62KyO55ymP7aAXXZRi6J2rupCDch.png','dimanchele3',5,1,'2024-10-30 11:42:04','2024-10-30 11:42:04'),(24,'Invitation Mariag','cartes_invitations/hmSKbPpYhe6SEQzB8njwtQcQloWdWzCAPEn7KJIS.png','Vous êtes invités à notre mariage le 25 décembre 2024.',3,1,'2024-10-30 12:09:33','2024-10-30 12:09:33'),(25,'8888888888888888','cartes_invitations/hmSKbPpYhe6SEQzB8njwtQcQloWdWzCAPEn7KJIS.png','22/04/2025',4,1,'2024-10-30 12:10:17','2024-10-30 12:10:17');
/*!40000 ALTER TABLE `carte_personnalisees` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `categorie_prestataires`
--

DROP TABLE IF EXISTS `categorie_prestataires`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `categorie_prestataires` (
  `id` bigint unsigned NOT NULL AUTO_INCREMENT,
  `titre` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `description` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `categorie_prestataires`
--

LOCK TABLES `categorie_prestataires` WRITE;
/*!40000 ALTER TABLE `categorie_prestataires` DISABLE KEYS */;
INSERT INTO `categorie_prestataires` VALUES (1,'Couture',NULL,NULL,NULL),(2,'Hotel',NULL,NULL,NULL),(3,'Décoration',NULL,NULL,NULL);
/*!40000 ALTER TABLE `categorie_prestataires` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `categories`
--

DROP TABLE IF EXISTS `categories`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `categories` (
  `id` bigint unsigned NOT NULL AUTO_INCREMENT,
  `titre` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `description` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=5 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `categories`
--

LOCK TABLES `categories` WRITE;
/*!40000 ALTER TABLE `categories` DISABLE KEYS */;
INSERT INTO `categories` VALUES (1,'Anniversaire',NULL,NULL,NULL),(2,'Mariage',NULL,NULL,NULL),(3,'Séminaire',NULL,NULL,NULL),(4,'After work',NULL,NULL,NULL);
/*!40000 ALTER TABLE `categories` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `clients`
--

DROP TABLE IF EXISTS `clients`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `clients` (
  `id` bigint unsigned NOT NULL AUTO_INCREMENT,
  `user_id` bigint unsigned NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `clients_user_id_foreign` (`user_id`),
  CONSTRAINT `clients_user_id_foreign` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `clients`
--

LOCK TABLES `clients` WRITE;
/*!40000 ALTER TABLE `clients` DISABLE KEYS */;
INSERT INTO `clients` VALUES (1,4,'2024-10-15 20:12:46','2024-10-15 20:12:46'),(2,6,'2024-10-16 16:30:23','2024-10-16 16:30:23'),(3,10,'2024-11-05 11:18:34','2024-11-05 11:18:34');
/*!40000 ALTER TABLE `clients` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `commentaires`
--

DROP TABLE IF EXISTS `commentaires`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `commentaires` (
  `id` bigint unsigned NOT NULL AUTO_INCREMENT,
  `contenu` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `note` tinyint unsigned NOT NULL DEFAULT '1',
  `user_id` bigint unsigned NOT NULL,
  `prestataire_id` bigint unsigned NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `commentaires_user_id_foreign` (`user_id`),
  KEY `commentaires_prestataire_id_foreign` (`prestataire_id`),
  CONSTRAINT `commentaires_prestataire_id_foreign` FOREIGN KEY (`prestataire_id`) REFERENCES `prestataires` (`id`) ON DELETE CASCADE,
  CONSTRAINT `commentaires_user_id_foreign` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=10 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `commentaires`
--

LOCK TABLES `commentaires` WRITE;
/*!40000 ALTER TABLE `commentaires` DISABLE KEYS */;
INSERT INTO `commentaires` VALUES (1,'Un service impécable pour moi',5,4,1,'2024-10-15 20:16:28','2024-10-15 20:16:28'),(2,'je suis satissfait',3,4,2,'2024-10-15 22:42:25','2024-10-15 22:42:25'),(3,'oiuyzertyui',3,4,2,'2024-10-16 16:31:36','2024-10-16 16:31:36'),(4,'zaertyuhjklm',4,4,2,'2024-10-22 16:01:53','2024-10-22 16:01:53'),(5,'kkkkkkkkkkkkkkkk',3,4,3,'2024-10-24 07:06:36','2024-10-24 07:06:36'),(6,'ssssssssssss',2,5,1,'2024-10-28 12:57:19','2024-10-28 12:57:19'),(7,'sssssssssss',4,5,4,'2024-10-28 12:57:40','2024-10-28 12:57:40'),(8,'jjdddddddddddddddddd',3,4,3,'2024-11-04 13:31:36','2024-11-04 13:31:36'),(9,'Je recommande viviement vos services',3,4,6,'2024-11-06 13:41:04','2024-11-06 13:41:04');
/*!40000 ALTER TABLE `commentaires` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `demande_prestations`
--

DROP TABLE IF EXISTS `demande_prestations`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `demande_prestations` (
  `id` bigint unsigned NOT NULL AUTO_INCREMENT,
  `etat` enum('en_attente','approuvée','rejetée') COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT 'en_attente',
  `prestataire_id` bigint unsigned NOT NULL,
  `user_id` bigint unsigned NOT NULL,
  `message` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `demande_prestations_prestataire_id_foreign` (`prestataire_id`),
  KEY `demande_prestations_user_id_foreign` (`user_id`),
  CONSTRAINT `demande_prestations_prestataire_id_foreign` FOREIGN KEY (`prestataire_id`) REFERENCES `prestataires` (`id`) ON DELETE CASCADE,
  CONSTRAINT `demande_prestations_user_id_foreign` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=19 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `demande_prestations`
--

LOCK TABLES `demande_prestations` WRITE;
/*!40000 ALTER TABLE `demande_prestations` DISABLE KEYS */;
INSERT INTO `demande_prestations` VALUES (1,'approuvée',2,4,NULL,'2024-10-15 22:42:07','2024-11-06 16:09:31'),(2,'en_attente',1,2,NULL,'2024-10-16 11:56:17','2024-10-16 11:56:17'),(3,'approuvée',2,4,NULL,'2024-10-16 12:06:21','2024-11-06 16:10:31'),(4,'en_attente',2,4,NULL,'2024-10-16 16:31:20','2024-10-23 12:56:42'),(5,'en_attente',2,1,NULL,'2024-10-16 16:49:23','2024-10-23 13:03:22'),(6,'en_attente',1,4,NULL,'2024-10-20 22:50:16','2024-10-20 22:50:16'),(7,'en_attente',4,4,NULL,'2024-10-21 16:33:37','2024-10-23 13:49:14'),(9,'en_attente',3,4,NULL,'2024-10-21 16:42:13','2024-10-25 17:18:57'),(10,'en_attente',3,4,NULL,'2024-10-23 13:08:57','2024-10-23 14:00:53'),(11,'en_attente',3,4,NULL,'2024-10-23 20:58:11','2024-10-25 16:59:04'),(12,'en_attente',4,4,NULL,'2024-10-23 21:32:13','2024-10-25 16:16:37'),(13,'en_attente',4,4,NULL,'2024-10-23 21:33:19','2024-10-25 16:19:55'),(14,'en_attente',3,4,NULL,'2024-10-24 07:06:06','2024-10-25 16:36:04'),(15,'en_attente',2,4,NULL,'2024-10-25 09:34:21','2024-10-25 16:18:18'),(16,'en_attente',3,4,NULL,'2024-10-25 12:37:35','2024-10-28 12:50:28'),(17,'en_attente',2,4,NULL,'2024-10-28 09:04:43','2024-10-31 15:31:08'),(18,'en_attente',5,5,NULL,'2024-10-31 10:07:08','2024-10-31 10:07:08');
/*!40000 ALTER TABLE `demande_prestations` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `evenements`
--

DROP TABLE IF EXISTS `evenements`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `evenements` (
  `id` bigint unsigned NOT NULL AUTO_INCREMENT,
  `titre` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `description` text COLLATE utf8mb4_unicode_ci,
  `event_date` date NOT NULL,
  `lieu` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `type` enum('mariage','anniversaire','bapteme','seminaire','bridal shower','after work','graduation','ceremonie') COLLATE utf8mb4_unicode_ci NOT NULL,
  `budget` enum('moins de 500000','500000 à 1000000','plus de 1000000') COLLATE utf8mb4_unicode_ci NOT NULL,
  `user_id` bigint unsigned NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `evenements_user_id_foreign` (`user_id`),
  CONSTRAINT `evenements_user_id_foreign` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=6 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `evenements`
--

LOCK TABLES `evenements` WRITE;
/*!40000 ALTER TABLE `evenements` DISABLE KEYS */;
INSERT INTO `evenements` VALUES (1,'Mariage de ma fille',NULL,'2024-10-16','Dakar','mariage','moins de 500000',4,'2024-10-15 22:42:55','2024-10-15 22:42:55'),(2,'Mon anniversaire',NULL,'2024-10-28','Dakar','mariage','moins de 500000',4,'2024-10-15 23:02:36','2024-10-15 23:02:36'),(3,'Séminaire',NULL,'2024-10-18','Dakar','mariage','moins de 500000',4,'2024-10-16 16:31:05','2024-10-16 16:31:05'),(4,'Mon anniversaire','je veux ma marier avec un bon mari pieux,respectueux et responsable','2025-02-26','Thiès','mariage','moins de 500000',4,'2024-10-25 09:39:22','2024-10-25 09:39:22'),(5,'Anniver','jizuue hhfhfhfhhh','2024-10-31','Saint-Louis','anniversaire','moins de 500000',4,'2024-10-25 17:00:31','2024-10-25 17:00:31');
/*!40000 ALTER TABLE `evenements` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `failed_jobs`
--

DROP TABLE IF EXISTS `failed_jobs`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `failed_jobs` (
  `id` bigint unsigned NOT NULL AUTO_INCREMENT,
  `uuid` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `connection` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `queue` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `payload` longtext COLLATE utf8mb4_unicode_ci NOT NULL,
  `exception` longtext COLLATE utf8mb4_unicode_ci NOT NULL,
  `failed_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`),
  UNIQUE KEY `failed_jobs_uuid_unique` (`uuid`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `failed_jobs`
--

LOCK TABLES `failed_jobs` WRITE;
/*!40000 ALTER TABLE `failed_jobs` DISABLE KEYS */;
/*!40000 ALTER TABLE `failed_jobs` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `invites`
--

DROP TABLE IF EXISTS `invites`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `invites` (
  `id` bigint unsigned NOT NULL AUTO_INCREMENT,
  `carte_personnalisee_id` bigint unsigned NOT NULL,
  `user_id` bigint unsigned NOT NULL,
  `email` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `nom` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `statut` tinyint(1) NOT NULL DEFAULT '0',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `invites_carte_personnalisee_id_foreign` (`carte_personnalisee_id`),
  KEY `invites_user_id_foreign` (`user_id`),
  CONSTRAINT `invites_carte_personnalisee_id_foreign` FOREIGN KEY (`carte_personnalisee_id`) REFERENCES `carte_personnalisees` (`id`) ON DELETE CASCADE,
  CONSTRAINT `invites_user_id_foreign` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=88 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `invites`
--

LOCK TABLES `invites` WRITE;
/*!40000 ALTER TABLE `invites` DISABLE KEYS */;
INSERT INTO `invites` VALUES (1,9,4,'fatishma121@gmail.com','',1,'2024-10-16 11:54:02','2024-10-16 11:54:02'),(2,9,4,'fatoumatadansoko61@gmail.com','',0,'2024-10-16 11:54:04','2024-10-16 11:54:04'),(3,12,4,'fatishma121@gmail.com','',0,'2024-10-17 09:52:48','2024-10-17 09:52:48'),(4,12,4,'fatoumatadansoko61@gmail.com','',0,'2024-10-17 09:52:51','2024-10-17 09:52:51'),(5,12,4,'souleymane9700@gmail.com','',0,'2024-10-17 09:52:52','2024-10-17 09:52:52'),(6,9,4,'fatoumatadansoko61@gmail.com','Fatoumata Dansoko',0,'2024-10-17 11:16:16','2024-10-17 11:16:16'),(7,9,4,'fatoumata.dansoko@unchk.edu.sn','Fatoumata D.',1,'2024-10-17 11:16:17','2024-10-17 11:16:17'),(8,9,4,'fatishma121@gmail.com','Fatishma',0,'2024-10-17 11:16:18','2024-10-17 11:16:18'),(9,9,4,'fatoumatadansoko61@gmail.com','Fatoumata Dansoko',0,'2024-10-17 11:35:07','2024-10-17 11:35:07'),(10,9,4,'fatoumata.dansoko@unchk.edu.sn','Fatoumata D.',0,'2024-10-17 11:35:09','2024-10-17 11:35:09'),(11,9,4,'fatishma121@gmail.com','Fatishma',0,'2024-10-17 11:35:10','2024-10-17 11:35:10'),(12,9,4,'fatoumatadansoko61@gmail.com','Fatoumata Dansoko',0,'2024-10-17 11:42:58','2024-10-17 11:42:58'),(13,9,4,'fatoumata.dansoko@unchk.edu.sn','Fatoumata D.',0,'2024-10-17 11:42:59','2024-10-17 11:42:59'),(14,9,4,'fatishma121@gmail.com','Fatishma',0,'2024-10-17 11:43:01','2024-10-17 11:43:01'),(15,9,4,'fatoumatadansoko61@gmail.com','Fatoumata Dans',0,'2024-10-17 11:57:42','2024-10-17 11:57:42'),(16,9,4,'fatoumata.dansoko@unchk.edu.sn','Fatoumata D.',0,'2024-10-17 11:57:43','2024-10-17 11:57:43'),(17,9,4,'fatishma121@gmail.com','Fatishma',0,'2024-10-17 11:57:45','2024-10-17 11:57:45'),(18,9,4,'fatoumatadansoko61@gmail.com','Fatoumata Dans',0,'2024-10-17 12:06:03','2024-10-17 12:06:03'),(19,9,4,'fatoumata.dansoko@unchk.edu.sn','Fatoumata D.',0,'2024-10-17 12:06:04','2024-10-17 12:06:04'),(20,9,4,'fatishma121@gmail.com','Fatishma',0,'2024-10-17 12:06:05','2024-10-17 12:06:05'),(21,9,4,'fatoumatadansoko61@gmail.com','Fatoumata Dans',0,'2024-10-17 12:13:06','2024-10-17 12:13:06'),(22,9,4,'fatoumata.dansoko@unchk.edu.sn','Fatoumata D.',0,'2024-10-17 12:13:07','2024-10-17 12:13:07'),(23,9,4,'fatishma121@gmail.com','Fatishma',0,'2024-10-17 12:13:09','2024-10-17 12:13:09'),(24,9,4,'fatoumatadansoko61@gmail.com','Fatoumata Dans',0,'2024-10-17 12:15:50','2024-10-17 12:15:50'),(25,9,4,'fatoumata.dansoko@unchk.edu.sn','Fatoumata D.',0,'2024-10-17 12:15:51','2024-10-17 12:15:51'),(26,9,4,'fatishma121@gmail.com','Fatishma',0,'2024-10-17 12:15:52','2024-10-17 12:15:52'),(27,9,4,'fatoumatadansoko61@gmail.com','Fatoumata Dans',0,'2024-10-17 12:25:38','2024-10-17 12:25:38'),(28,9,4,'fatoumata.dansoko@unchk.edu.sn','Fatoumata D.',0,'2024-10-17 12:25:40','2024-10-17 12:25:40'),(29,9,4,'fatishma121@gmail.com','Fatishma',0,'2024-10-17 12:25:41','2024-10-17 12:25:41'),(30,10,4,'souleyman9700@gmail.com','souleyma',0,'2024-10-17 16:32:36','2024-10-17 16:32:36'),(31,10,4,'fatishma121@gmail.com','fatishma',0,'2024-10-17 16:32:37','2024-10-17 16:32:37'),(32,13,4,'adodabo00@gmail.com','adama',0,'2024-10-17 16:37:52','2024-10-17 16:37:52'),(33,9,5,'fatoumatadansoko61@gmail.com','Fatoumata Dans',0,'2024-10-22 11:38:12','2024-10-22 11:38:12'),(34,9,5,'fatoumata.dansoko@unchk.edu.sn','Fatoumata D.',0,'2024-10-22 11:38:13','2024-10-22 11:38:13'),(35,9,5,'fatishma121@gmail.com','Fatishma',0,'2024-10-22 11:38:15','2024-10-22 11:38:15'),(36,9,5,'fatoumatadansoko61@gmail.com','Fatoumata Dans',0,'2024-10-22 11:42:02','2024-10-22 11:42:02'),(37,9,5,'fatoumata.dansoko@unchk.edu.sn','Fatoumata D.',0,'2024-10-22 11:42:03','2024-10-22 11:42:03'),(38,9,5,'fatishma121@gmail.com','Fatishma',0,'2024-10-22 11:42:04','2024-10-22 11:42:04'),(39,9,4,'fatoumatadansoko61@gmail.com','Fatoumata Dans',0,'2024-10-22 11:44:57','2024-10-22 11:44:57'),(40,9,4,'fatoumata.dansoko@unchk.edu.sn','Fatoumata D.',0,'2024-10-22 11:44:58','2024-10-22 11:44:58'),(41,9,4,'fatishma121@gmail.com','Fatishma',0,'2024-10-22 11:44:59','2024-10-22 11:44:59'),(42,9,4,'fatoumatadansoko61@gmail.com','Fatoumata Dans',0,'2024-10-22 11:54:47','2024-10-22 11:54:47'),(43,9,4,'fatoumata.dansoko@unchk.edu.sn','Fatoumata D.',0,'2024-10-22 11:54:49','2024-10-22 11:54:49'),(44,9,4,'fatishma121@gmail.com','Fatishma',0,'2024-10-22 11:54:50','2024-10-22 11:54:50'),(45,9,4,'fatoumatadansoko61@gmail.com','Fatoumata Dans',0,'2024-10-22 11:55:47','2024-10-22 11:55:47'),(46,9,4,'fatoumata.dansoko@unchk.edu.sn','Fatoumata D.',0,'2024-10-22 11:55:48','2024-10-22 11:55:48'),(47,9,4,'fatishma121@gmail.com','Fatishma',0,'2024-10-22 11:55:49','2024-10-22 11:55:49'),(48,9,4,'fatoumatadansoko61@gmail.com','Fatoumata Dans',0,'2024-10-22 12:07:26','2024-10-22 12:07:26'),(49,9,4,'fatoumata.dansoko@unchk.edu.sn','Fatoumata D.',0,'2024-10-22 12:07:27','2024-10-22 12:07:27'),(50,9,4,'fatishma121@gmail.com','Fatishma',0,'2024-10-22 12:07:28','2024-10-22 12:07:28'),(51,9,4,'fatoumatadansoko61@gmail.com','Fatoumata Dans',0,'2024-10-22 12:16:59','2024-10-22 12:16:59'),(52,9,4,'fatoumata.dansoko@unchk.edu.sn','Fatoumata D.',0,'2024-10-22 12:17:00','2024-10-22 12:17:00'),(53,9,4,'fatishma121@gmail.com','Fatishma',0,'2024-10-22 12:17:01','2024-10-22 12:17:01'),(54,9,4,'fatoumatadansoko61@gmail.com','Fatoumata Dans',0,'2024-10-22 12:26:29','2024-10-22 12:26:29'),(55,9,4,'fatoumata.dansoko@unchk.edu.sn','Fatoumata D.',0,'2024-10-22 12:26:30','2024-10-22 12:26:30'),(56,9,4,'fatishma121@gmail.com','Fatishma',0,'2024-10-22 12:26:31','2024-10-22 12:26:31'),(57,9,4,'fatoumatadansoko61@gmail.com','Fatoumata Dans',0,'2024-10-22 12:38:09','2024-10-22 12:38:09'),(58,9,4,'fatoumata.dansoko@unchk.edu.sn','Fatoumata D.',0,'2024-10-22 12:38:10','2024-10-22 12:38:10'),(59,9,4,'fatishma121@gmail.com','Fatishma',0,'2024-10-22 12:38:11','2024-10-22 12:38:11'),(60,9,4,'fatoumatadansoko61@gmail.com','Fatoumata Dans',0,'2024-10-22 12:39:47','2024-10-22 12:39:47'),(61,9,4,'fatoumata.dansoko@unchk.edu.sn','Fatoumata D.',0,'2024-10-22 12:39:47','2024-10-22 12:39:47'),(62,9,4,'fatishma121@gmail.com','Fatishma',0,'2024-10-22 12:39:48','2024-10-22 12:39:48'),(63,9,4,'fatoumatadansoko61@gmail.com','Fatoumata Dans',0,'2024-10-22 13:34:44','2024-10-22 13:34:44'),(64,9,4,'fatoumata.dansoko@unchk.edu.sn','Fatoumata D.',0,'2024-10-22 13:34:45','2024-10-22 13:34:45'),(65,9,4,'fatishma121@gmail.com','Fatishma',0,'2024-10-22 13:34:46','2024-10-22 13:34:46'),(66,9,4,'fatoumatadansoko61@gmail.com','Fatoumata Dans',1,'2024-10-22 13:43:25','2024-10-22 13:54:57'),(67,9,4,'fatoumata.dansoko@unchk.edu.sn','Fatoumata D.',0,'2024-10-22 13:43:27','2024-10-22 13:43:27'),(68,9,4,'fatishma121@gmail.com','Fatishma',0,'2024-10-22 13:43:28','2024-10-22 13:43:28'),(69,13,4,'fatishma121@gmail.com','fanta',1,'2024-10-22 15:34:16','2024-10-22 15:36:02'),(70,10,4,'fallouniang776@gmail.com','fallou',0,'2024-10-25 12:36:38','2024-10-25 12:36:38'),(71,14,4,'fatishma121@gmail.com','fanta',1,'2024-10-25 13:28:42','2024-10-25 13:29:00'),(72,13,4,'fatishma121@gmail.com','fatima',0,'2024-10-25 13:31:32','2024-10-25 13:31:32'),(73,13,4,'fatishma121@gmail.com','fatishma',0,'2024-10-25 13:31:34','2024-10-25 13:31:34'),(74,16,4,'fatishma121@gmail.com','anna',0,'2024-10-25 14:50:36','2024-10-25 14:50:36'),(75,17,4,'fatishma121@gmail.com','Fatima',1,'2024-10-25 17:02:24','2024-10-25 17:03:36'),(76,17,4,'fatishma121@gmail.com','Fanta',0,'2024-10-25 17:02:26','2024-10-25 17:02:26'),(77,17,4,'fatoumatadansoko61@gmail.com','Fatima',0,'2024-10-25 17:02:27','2024-10-25 17:02:27'),(78,20,4,'fatishma121@gmail.com','anna',0,'2024-10-29 10:55:56','2024-10-29 10:55:56'),(79,21,5,'diallomariam0715@gmail.com','Mariama',0,'2024-10-30 10:37:00','2024-10-30 10:37:00'),(80,21,4,'souleyman9700@gmail.com','souleymane',0,'2024-10-31 10:15:07','2024-10-31 10:15:07'),(81,24,4,'fatishma121@gmail.com','fanta',0,'2024-10-31 10:22:15','2024-10-31 10:22:15'),(82,23,4,'fatishma121@gmail.com','fatima',0,'2024-10-31 10:23:31','2024-10-31 10:23:31'),(83,23,4,'fatishma121@gmail.com','fatima',0,'2024-10-31 10:23:41','2024-10-31 10:23:41'),(84,24,4,'fatishma121@gmail.com','fanta',0,'2024-10-31 10:24:10','2024-10-31 10:24:10'),(85,24,4,'fatishma121@gmail.com','fatima',0,'2024-10-31 10:57:57','2024-10-31 10:57:57'),(86,24,4,'fatoumatadansoko61@gmail.com','fatishma',0,'2024-10-31 10:58:00','2024-10-31 10:58:00'),(87,25,4,'fatishma121@gmail.com','fanta',0,'2024-10-31 10:58:20','2024-10-31 10:58:20');
/*!40000 ALTER TABLE `invites` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `job_batches`
--

DROP TABLE IF EXISTS `job_batches`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `job_batches` (
  `id` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `total_jobs` int NOT NULL,
  `pending_jobs` int NOT NULL,
  `failed_jobs` int NOT NULL,
  `failed_job_ids` longtext COLLATE utf8mb4_unicode_ci NOT NULL,
  `options` mediumtext COLLATE utf8mb4_unicode_ci,
  `cancelled_at` int DEFAULT NULL,
  `created_at` int NOT NULL,
  `finished_at` int DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `job_batches`
--

LOCK TABLES `job_batches` WRITE;
/*!40000 ALTER TABLE `job_batches` DISABLE KEYS */;
/*!40000 ALTER TABLE `job_batches` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `jobs`
--

DROP TABLE IF EXISTS `jobs`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `jobs` (
  `id` bigint unsigned NOT NULL AUTO_INCREMENT,
  `queue` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `payload` longtext COLLATE utf8mb4_unicode_ci NOT NULL,
  `attempts` tinyint unsigned NOT NULL,
  `reserved_at` int unsigned DEFAULT NULL,
  `available_at` int unsigned NOT NULL,
  `created_at` int unsigned NOT NULL,
  PRIMARY KEY (`id`),
  KEY `jobs_queue_index` (`queue`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `jobs`
--

LOCK TABLES `jobs` WRITE;
/*!40000 ALTER TABLE `jobs` DISABLE KEYS */;
/*!40000 ALTER TABLE `jobs` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `migrations`
--

DROP TABLE IF EXISTS `migrations`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `migrations` (
  `id` int unsigned NOT NULL AUTO_INCREMENT,
  `migration` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `batch` int NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=20 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `migrations`
--

LOCK TABLES `migrations` WRITE;
/*!40000 ALTER TABLE `migrations` DISABLE KEYS */;
INSERT INTO `migrations` VALUES (1,'0001_01_01_000000_create_users_table',1),(2,'0001_01_01_000001_create_cache_table',1),(3,'0001_01_01_000002_create_jobs_table',1),(4,'2024_09_15_205935_create_personal_access_tokens_table',1),(5,'2024_09_15_210946_create_categories_table',1),(6,'2024_09_15_211031_create_categorie_prestataires_table',1),(7,'2024_09_15_211104_create_evenements_table',1),(8,'2024_09_15_211248_create_carte_invitations_table',1),(9,'2024_09_15_211328_create_carte_personnalisees_table',1),(10,'2024_09_15_211354_create_notifications_table',1),(11,'2024_09_15_211411_create_commentaires_table',1),(12,'2024_09_15_213916_create_permission_tables',1),(13,'2024_09_16_184952_create_sessions_table',1),(14,'2024_10_08_135429_create_demande_prestation_table',1),(15,'2024_10_10_155217_create_invites_table',1),(16,'2024_10_17_103700_add_nom_to_invites_table',2),(17,'2024_10_20_165526_modify_column_type_in_users_table',3),(18,'2024_10_22_105743_add_statut_to_invites_table',4),(19,'2024_10_23_104947_modify_etat_column_in_demande_prestations_table',5);
/*!40000 ALTER TABLE `migrations` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `model_has_permissions`
--

DROP TABLE IF EXISTS `model_has_permissions`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `model_has_permissions` (
  `permission_id` bigint unsigned NOT NULL,
  `model_type` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `model_id` bigint unsigned NOT NULL,
  PRIMARY KEY (`permission_id`,`model_id`,`model_type`),
  KEY `model_has_permissions_model_id_model_type_index` (`model_id`,`model_type`),
  CONSTRAINT `model_has_permissions_permission_id_foreign` FOREIGN KEY (`permission_id`) REFERENCES `permissions` (`id`) ON DELETE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `model_has_permissions`
--

LOCK TABLES `model_has_permissions` WRITE;
/*!40000 ALTER TABLE `model_has_permissions` DISABLE KEYS */;
/*!40000 ALTER TABLE `model_has_permissions` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `model_has_roles`
--

DROP TABLE IF EXISTS `model_has_roles`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `model_has_roles` (
  `role_id` bigint unsigned NOT NULL,
  `model_type` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `model_id` bigint unsigned NOT NULL,
  PRIMARY KEY (`role_id`,`model_id`,`model_type`),
  KEY `model_has_roles_model_id_model_type_index` (`model_id`,`model_type`),
  CONSTRAINT `model_has_roles_role_id_foreign` FOREIGN KEY (`role_id`) REFERENCES `roles` (`id`) ON DELETE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `model_has_roles`
--

LOCK TABLES `model_has_roles` WRITE;
/*!40000 ALTER TABLE `model_has_roles` DISABLE KEYS */;
INSERT INTO `model_has_roles` VALUES (3,'App\\Models\\User',1),(2,'App\\Models\\User',2),(1,'App\\Models\\User',4),(2,'App\\Models\\User',5),(1,'App\\Models\\User',6),(2,'App\\Models\\User',7),(2,'App\\Models\\User',8),(2,'App\\Models\\User',9),(1,'App\\Models\\User',10),(2,'App\\Models\\User',11);
/*!40000 ALTER TABLE `model_has_roles` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `notifications`
--

DROP TABLE IF EXISTS `notifications`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `notifications` (
  `id` bigint unsigned NOT NULL AUTO_INCREMENT,
  `object` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `message` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `notifications`
--

LOCK TABLES `notifications` WRITE;
/*!40000 ALTER TABLE `notifications` DISABLE KEYS */;
/*!40000 ALTER TABLE `notifications` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `permissions`
--

DROP TABLE IF EXISTS `permissions`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `permissions` (
  `id` bigint unsigned NOT NULL AUTO_INCREMENT,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `guard_name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `permissions_name_guard_name_unique` (`name`,`guard_name`)
) ENGINE=InnoDB AUTO_INCREMENT=26 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `permissions`
--

LOCK TABLES `permissions` WRITE;
/*!40000 ALTER TABLE `permissions` DISABLE KEYS */;
INSERT INTO `permissions` VALUES (1,'activer_utilisateur','api','2024-10-15 20:04:56','2024-10-15 20:04:56'),(2,'voir_utilisateur','api','2024-10-15 20:04:56','2024-10-15 20:04:56'),(3,'créer_roles','api','2024-10-15 20:04:56','2024-10-15 20:04:56'),(4,'supprimer_roles','api','2024-10-15 20:04:56','2024-10-15 20:04:56'),(5,'modifier_roles','api','2024-10-15 20:04:56','2024-10-15 20:04:56'),(6,'ajouter_carte','api','2024-10-15 20:04:56','2024-10-15 20:04:56'),(7,'modifier_carte','api','2024-10-15 20:04:56','2024-10-15 20:04:56'),(8,'supprimer_carte','api','2024-10-15 20:04:56','2024-10-15 20:04:56'),(9,'voir_carte','api','2024-10-15 20:04:56','2024-10-15 20:04:56'),(10,'voir_invités','api','2024-10-15 20:04:56','2024-10-15 20:04:56'),(11,'voir_cartes_personnalisees','api','2024-10-15 20:04:56','2024-10-15 20:04:56'),(12,'voir_evenments','api','2024-10-15 20:04:56','2024-10-15 20:04:56'),(13,'creer_carte_personnalisee','api','2024-10-15 20:04:56','2024-10-15 20:04:56'),(14,'voir_demandeprestation','api','2024-10-15 20:04:56','2024-10-15 20:04:56'),(15,'evaluer_demandes','api','2024-10-15 20:04:56','2024-10-15 20:04:56'),(16,'modifier_carte_personnalisee','api','2024-10-15 20:04:56','2024-10-15 20:04:56'),(17,'envoyer_carte_personnalisee','api','2024-10-15 20:04:56','2024-10-15 20:04:56'),(18,'organiser_evenment','api','2024-10-15 20:04:56','2024-10-15 20:04:56'),(19,'creer_evenement','api','2024-10-15 20:04:56','2024-10-15 20:04:56'),(20,'modifier_evenement','api','2024-10-15 20:04:56','2024-10-15 20:04:56'),(21,'supprimer_evenement','api','2024-10-15 20:04:56','2024-10-15 20:04:56'),(22,'voir_prestataires','api','2024-10-15 20:04:56','2024-10-15 20:04:56'),(23,'faire_demandeprestattion','api','2024-10-15 20:04:56','2024-10-15 20:04:56'),(24,'faire des commentaires','api','2024-10-15 20:04:56','2024-10-15 20:04:56'),(25,'modfier_profil','api','2024-10-15 20:04:56','2024-10-15 20:04:56');
/*!40000 ALTER TABLE `permissions` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `personal_access_tokens`
--

DROP TABLE IF EXISTS `personal_access_tokens`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `personal_access_tokens` (
  `id` bigint unsigned NOT NULL AUTO_INCREMENT,
  `tokenable_type` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `tokenable_id` bigint unsigned NOT NULL,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `token` varchar(64) COLLATE utf8mb4_unicode_ci NOT NULL,
  `abilities` text COLLATE utf8mb4_unicode_ci,
  `last_used_at` timestamp NULL DEFAULT NULL,
  `expires_at` timestamp NULL DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `personal_access_tokens_token_unique` (`token`),
  KEY `personal_access_tokens_tokenable_type_tokenable_id_index` (`tokenable_type`,`tokenable_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `personal_access_tokens`
--

LOCK TABLES `personal_access_tokens` WRITE;
/*!40000 ALTER TABLE `personal_access_tokens` DISABLE KEYS */;
/*!40000 ALTER TABLE `personal_access_tokens` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `prestataires`
--

DROP TABLE IF EXISTS `prestataires`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `prestataires` (
  `id` bigint unsigned NOT NULL AUTO_INCREMENT,
  `user_id` bigint unsigned NOT NULL,
  `categorie_prestataire_id` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `description` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `ninea` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `prestataires_user_id_foreign` (`user_id`),
  CONSTRAINT `prestataires_user_id_foreign` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=7 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `prestataires`
--

LOCK TABLES `prestataires` WRITE;
/*!40000 ALTER TABLE `prestataires` DISABLE KEYS */;
INSERT INTO `prestataires` VALUES (1,2,'2','La prestation de service correspond à l\'engagement d\'un professionnel (prestataire de service en freelance)','MPOSSS7','2024-10-15 20:06:58','2024-10-15 20:06:58'),(2,5,'1','La prestation de service correspond à l\'engagement d\'un professionnel (prestataire de service en freelance)','Mkruoerui5','2024-10-15 22:30:15','2024-10-15 22:30:15'),(3,7,'2','La prestation de service correspond à l\'engagement d\'un professionnel (prestataire de service en freelance)','Mkruoerui53','2024-10-16 17:23:56','2024-10-16 17:23:56'),(4,8,'[\"1\",\"2\"]','La prestation de service correspond à l\'engagement d\'un professionnel (prestataire de service en freelance)','jjjjjjjjjjjjjj','2024-10-20 00:29:16','2024-10-20 00:29:16'),(5,9,'[\"2\",\"1\"]','La prestation de service correspond à l\'engagement d\'un professionnel (prestataire de service en freelance)','123456987p','2024-10-30 16:56:03','2024-10-30 16:56:03'),(6,11,'[\"1\"]','La prestation de service correspond à l\'engagement d\'un professionnel (prestataire de service en freelance)','NKJDJ5OEO555','2024-11-06 13:34:55','2024-11-06 13:34:55');
/*!40000 ALTER TABLE `prestataires` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `role_has_permissions`
--

DROP TABLE IF EXISTS `role_has_permissions`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `role_has_permissions` (
  `permission_id` bigint unsigned NOT NULL,
  `role_id` bigint unsigned NOT NULL,
  PRIMARY KEY (`permission_id`,`role_id`),
  KEY `role_has_permissions_role_id_foreign` (`role_id`),
  CONSTRAINT `role_has_permissions_permission_id_foreign` FOREIGN KEY (`permission_id`) REFERENCES `permissions` (`id`) ON DELETE CASCADE,
  CONSTRAINT `role_has_permissions_role_id_foreign` FOREIGN KEY (`role_id`) REFERENCES `roles` (`id`) ON DELETE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `role_has_permissions`
--

LOCK TABLES `role_has_permissions` WRITE;
/*!40000 ALTER TABLE `role_has_permissions` DISABLE KEYS */;
INSERT INTO `role_has_permissions` VALUES (9,1),(10,1),(11,1),(14,1),(15,1),(22,1),(23,1),(25,1),(14,2),(15,2),(1,3),(2,3),(3,3),(4,3),(5,3),(6,3),(7,3),(8,3),(9,3),(10,3),(11,3);
/*!40000 ALTER TABLE `role_has_permissions` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `roles`
--

DROP TABLE IF EXISTS `roles`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `roles` (
  `id` bigint unsigned NOT NULL AUTO_INCREMENT,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `guard_name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `roles_name_guard_name_unique` (`name`,`guard_name`)
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `roles`
--

LOCK TABLES `roles` WRITE;
/*!40000 ALTER TABLE `roles` DISABLE KEYS */;
INSERT INTO `roles` VALUES (1,'client','api','2024-10-15 20:04:56','2024-10-15 20:04:56'),(2,'prestataire','api','2024-10-15 20:04:56','2024-10-15 20:04:56'),(3,'admin','api','2024-10-15 20:04:56','2024-10-15 20:04:56');
/*!40000 ALTER TABLE `roles` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `sessions`
--

DROP TABLE IF EXISTS `sessions`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `sessions` (
  `id` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `user_id` int unsigned DEFAULT NULL,
  `payload` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `last_activity` int NOT NULL,
  `ip_address` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `user_agent` text COLLATE utf8mb4_unicode_ci,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `sessions`
--

LOCK TABLES `sessions` WRITE;
/*!40000 ALTER TABLE `sessions` DISABLE KEYS */;
INSERT INTO `sessions` VALUES ('46NuYBAwIRfwGikeLV4C2hyu0gRJ3Td0py9enAOg',NULL,'YTozOntzOjY6Il90b2tlbiI7czo0MDoiQkc5RkVVM0V6MkxoeUZZMlZkVEhGazRuUjNsaFJWWXpldmQ3czgwRiI7czo5OiJfcHJldmlvdXMiO2E6MTp7czozOiJ1cmwiO3M6MjE6Imh0dHA6Ly9sb2NhbGhvc3Q6ODAwMCI7fXM6NjoiX2ZsYXNoIjthOjI6e3M6Mzoib2xkIjthOjA6e31zOjM6Im5ldyI7YTowOnt9fX0=',1729601415,'127.0.0.1','Mozilla/5.0 (X11; Linux x86_64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/129.0.0.0 Safari/537.36'),('8QlaIG12FKCfSLoz0V6ffmcq3LiaBaSEDgK5ldGs',NULL,'YTozOntzOjY6Il90b2tlbiI7czo0MDoiMElYRlVTSUhtaWNBeXpBVWhzU1ZCejE5QWtuVFJXblJXUTJ2TlVFVyI7czo5OiJfcHJldmlvdXMiO2E6MTp7czozOiJ1cmwiO3M6MjE6Imh0dHA6Ly8xMjcuMC4wLjE6ODAwMCI7fXM6NjoiX2ZsYXNoIjthOjI6e3M6Mzoib2xkIjthOjA6e31zOjM6Im5ldyI7YTowOnt9fX0=',1731078496,'127.0.0.1','Mozilla/5.0 (X11; Linux x86_64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/130.0.0.0 Safari/537.36'),('l1E0uNPa8onuC01evJRb34GFcWS0WhMHW2waDquU',4,'YTozOntzOjY6Il90b2tlbiI7czo0MDoibWc2U3FYWFhuWXJqcWczNlhwM1Fpc3hZOWk4UTFPUG1Wazc2OXlQUSI7czo5OiJfcHJldmlvdXMiO2E6MTp7czozOiJ1cmwiO3M6MjE6Imh0dHA6Ly8xMjcuMC4wLjE6ODAwMCI7fXM6NjoiX2ZsYXNoIjthOjI6e3M6Mzoib2xkIjthOjA6e31zOjM6Im5ldyI7YTowOnt9fX0=',1729074539,'127.0.0.1','insomnia/9.3.3'),('qQLDx5FoQTwGIlT02kJRmeHnNuzFgUXDw6cTs9Cx',NULL,'YTozOntzOjY6Il90b2tlbiI7czo0MDoiNDRzZlJNRnAzdHQ0MHViaDkwdHhxSWhheWk1QzVrV3BIZVJSRjIxMyI7czo5OiJfcHJldmlvdXMiO2E6MTp7czozOiJ1cmwiO3M6MjE6Imh0dHA6Ly9sb2NhbGhvc3Q6ODAwMCI7fXM6NjoiX2ZsYXNoIjthOjI6e3M6Mzoib2xkIjthOjA6e31zOjM6Im5ldyI7YTowOnt9fX0=',1729364779,'127.0.0.1','insomnia/9.3.3');
/*!40000 ALTER TABLE `sessions` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `users`
--

DROP TABLE IF EXISTS `users`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `users` (
  `id` bigint unsigned NOT NULL AUTO_INCREMENT,
  `nom` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `email` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `password` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `adresse` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `telephone` bigint NOT NULL,
  `logo` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `status` enum('active','inactive') COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT 'active',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `remember_token` varchar(100) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `users_email_unique` (`email`),
  UNIQUE KEY `users_telephone_unique` (`telephone`)
) ENGINE=InnoDB AUTO_INCREMENT=12 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `users`
--

LOCK TABLES `users` WRITE;
/*!40000 ALTER TABLE `users` DISABLE KEYS */;
INSERT INTO `users` VALUES (1,'Fatoumata DANSOKO','fatoumata.dansoko@unchk.edu.sn','$2y$12$ALUYdWVajzucRp8ncneVqeNwyfbj6l164OSWmQcxtQHz61fCSFCKO','123 Admin St, Admin City',221770374697,'users/xDJmHaEgxMre2MrOo897zhuJJ0FTBQk50zyTBNnp.png','active','2024-10-15 20:05:33','2024-10-15 20:05:33',NULL),(2,'Ndeye CISSE','ndeyecise@gmail.com','$2y$12$O4XM60R0uZ9DK/.tXeJiIee/3hRPArTN9XjxIhrdrK1Ez9VQ5lLYy','dakar',7710233567,'users/ymCxVKKfMI4xq0TImZgo21PmnqkPX47emdIJuxWd.png','active','2024-10-15 20:06:58','2024-10-15 20:06:58',NULL),(4,'Ndeye CISSE','fatishma121@gmail.com','$2y$12$NOnOZIs66WdKsSUkoL3UaeaRWBq88QeonmL0C0C9tg/J.PMeB8.qi','dakar',7710233599,'users/fVqKFhfigt9CLPWdxmvPmMaTVspiVs1AwX3a7Om0.png','active','2024-10-15 20:12:46','2024-10-15 20:12:46',NULL),(5,'6point9','6.point9@gmail.com','$2y$12$k3EsjF6YWfXew7Uuf/4Wuewf9aNJcZB4s4s5WeZS28eq6oZKTCjz.','Liberte 6',771009988,'users/xDJmHaEgxMre2MrOo897zhuJJ0FTBQk50zyTBNnp.png','active','2024-10-15 22:30:15','2024-11-11 09:45:55',NULL),(6,'Fatima','gatueeet@gmail.com','$2y$12$CRwl2RmSKbZ0/LvxbCxRIupCxZezXVtqOhC4ZDN2TMUeSb4tQ6N7u','Keur massar',777774488,'users/cO5CDV2Ld1XU37T3UMSkLtOoTmybSquHpas58gqH.png','active','2024-10-16 16:30:23','2024-10-16 16:30:23',NULL),(7,'Cheikh  Saliou TALLA','csstalla.ext@simplon.co','$2y$12$PfLaUSxZQQiMItKGBWqkyuRxgVeL0gNGbr20XT/C638Scv6GUkzQu','Dakar',77490669566,'users/oq52tuHGNxrdc07GHcgEWQrsRKuiJzGpQK9xUSn2.png','active','2024-10-16 17:23:56','2024-10-16 17:23:56',NULL),(8,'annamarone','anna@gmail.com','$2y$12$a9UuJ180CElhSq4y9HEEhuUF1BdXGUlDyy/63l5KY.ikphPs6CfQO','malika',774445588,'users/k2REhw9jXYELp3hSRdAevj7UOxKtKwtZfLtmep7a.png','active','2024-10-20 00:29:16','2024-11-09 18:31:04',NULL),(9,'Fatoumata DANSOKO','fatishma21@gmail.com','$2y$12$KV/RzLEqhGoEG90DD5kT.eIc11iOr88oFQ3l0bdJntSaYTRo1Xzwu','dakar',777693591,'users/ZQekygnTICVbnzpjlTlrOCPBACzVbUer3bVhUPAv.png','active','2024-10-30 16:56:03','2024-10-30 16:56:03',NULL),(10,'Adjia Oumy FALL','adja@gmail.com','$2y$12$PPz0X3xv5w2awDjHZLJJPONMIPMOHx/Br96r.VrmGkRi4LIERLOLK','Medina',777778899,'users/mzqfT6zJNuJpnYn13HWNjsQHuHS9MXontrBVWsZU.png','active','2024-11-05 11:18:34','2024-11-09 18:31:44',NULL),(11,'6point9','6point.9@gmail.com','$2y$12$XuNX3xctCaeBO5bKa9enquBlymtg9p0I7lLFLl./gLgccgvVdwbFS','Sacrée coeur',778889966,'users/LfO5qRMumQ0NVV0H6P6zv2Ju7I1cbbrGrteIIFld.png','active','2024-11-06 13:34:55','2024-11-06 13:34:55',NULL);
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

-- Dump completed on 2024-11-12  7:48:49
