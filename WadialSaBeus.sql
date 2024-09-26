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
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
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
) ENGINE=InnoDB AUTO_INCREMENT=10 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `carte_invitations`
--

LOCK TABLES `carte_invitations` WRITE;
/*!40000 ALTER TABLE `carte_invitations` DISABLE KEYS */;
INSERT INTO `carte_invitations` VALUES (2,7,2,'Baptême de Samba','bapteme-samba.png','Venez célébrer le baptême de notre fils Samba, le samedi prochain.','2024-09-18 12:44:52','2024-09-18 12:44:52'),(6,7,2,'Baptême de Samba','bapteme-samba.png','Venez célébrer le baptême de notre fils Samba, le samedi prochain.','2024-09-18 12:50:53','2024-09-18 12:50:53'),(8,7,2,'Baptême de Samba','bapteme-samba.png','Venez célébrer le baptême de notre fils Samba, le samedi prochain.','2024-09-18 12:51:15','2024-09-18 12:51:15'),(9,6,3,'Invitation Mariagennnnnnn','image_url.jpg','Vous êtes invités à notre mariage le 25 décembre 2024.','2024-09-18 13:29:01','2024-09-18 13:29:01');
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
  `carte_invitation_id` bigint unsigned NOT NULL,
  `client_id` bigint unsigned NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `carte_personnalisees_carte_invitation_id_foreign` (`carte_invitation_id`),
  KEY `carte_personnalisees_client_id_foreign` (`client_id`),
  CONSTRAINT `carte_personnalisees_carte_invitation_id_foreign` FOREIGN KEY (`carte_invitation_id`) REFERENCES `carte_invitations` (`id`) ON DELETE CASCADE,
  CONSTRAINT `carte_personnalisees_client_id_foreign` FOREIGN KEY (`client_id`) REFERENCES `clients` (`id`) ON DELETE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=8 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `carte_personnalisees`
--

LOCK TABLES `carte_personnalisees` WRITE;
/*!40000 ALTER TABLE `carte_personnalisees` DISABLE KEYS */;
INSERT INTO `carte_personnalisees` VALUES (7,2,1,'2024-09-18 12:51:16','2024-09-18 12:51:16');
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
) ENGINE=InnoDB AUTO_INCREMENT=14 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `categorie_prestataires`
--

LOCK TABLES `categorie_prestataires` WRITE;
/*!40000 ALTER TABLE `categorie_prestataires` DISABLE KEYS */;
INSERT INTO `categorie_prestataires` VALUES (2,'Traiteur','Catégorie pour les cérémonies de baptême au Sénégal','2024-09-18 12:44:52','2024-09-18 12:44:52'),(3,'Décoration','Catégorie pour les fêtes d’anniversaire au Sénégal','2024-09-18 12:44:52','2024-09-18 12:44:52'),(4,'Mariage','Catégorie pour les événements de mariage au Sénégal','2024-09-18 12:50:22','2024-09-18 12:50:22'),(5,'Traiteur','Catégorie pour les cérémonies de baptême au Sénégal','2024-09-18 12:50:22','2024-09-18 12:50:22'),(6,'Décoration','Catégorie pour les fêtes d’anniversaire au Sénégal','2024-09-18 12:50:22','2024-09-18 12:50:22'),(7,'Mariage','Catégorie pour les événements de mariage au Sénégal','2024-09-18 12:50:53','2024-09-18 12:50:53'),(8,'Traiteur','Catégorie pour les cérémonies de baptême au Sénégal','2024-09-18 12:50:53','2024-09-18 12:50:53'),(9,'Décoration','Catégorie pour les fêtes d’anniversaire au Sénégal','2024-09-18 12:50:53','2024-09-18 12:50:53'),(10,'Mariage','Catégorie pour les événements de mariage au Sénégal','2024-09-18 12:51:15','2024-09-18 12:51:15'),(11,'Traiteur','Catégorie pour les cérémonies de baptême au Sénégal','2024-09-18 12:51:15','2024-09-18 12:51:15'),(12,'Décoration','Catégorie pour les fêtes d’anniversaire au Sénégal','2024-09-18 12:51:15','2024-09-18 12:51:15'),(13,'décoration','Mise à jour de la description pour le baptême','2024-09-18 13:03:58','2024-09-18 13:03:58');
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
) ENGINE=InnoDB AUTO_INCREMENT=50 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `categories`
--

LOCK TABLES `categories` WRITE;
/*!40000 ALTER TABLE `categories` DISABLE KEYS */;
INSERT INTO `categories` VALUES (2,'Baptême','Catégorie pour les cérémonies de baptême au Sénégal','2024-09-18 12:18:49','2024-09-18 12:18:49'),(3,'Anniversaire','Catégorie pour les fêtes d’anniversaire au Sénégal','2024-09-18 12:18:49','2024-09-18 12:18:49'),(4,'Mariage','Catégorie pour les événements de mariage au Sénégal','2024-09-18 12:19:37','2024-09-18 12:19:37'),(5,'Baptême','Catégorie pour les cérémonies de baptême au Sénégal','2024-09-18 12:19:37','2024-09-18 12:19:37'),(6,'Anniversaire','Catégorie pour les fêtes d’anniversaire au Sénégal','2024-09-18 12:19:37','2024-09-18 12:19:37'),(7,'Mariage','Catégorie pour les événements de mariage au Sénégal','2024-09-18 12:20:10','2024-09-18 12:20:10'),(8,'Baptême','Catégorie pour les cérémonies de baptême au Sénégal','2024-09-18 12:20:10','2024-09-18 12:20:10'),(9,'Anniversaire','Catégorie pour les fêtes d’anniversaire au Sénégal','2024-09-18 12:20:10','2024-09-18 12:20:10'),(10,'Mariage','Catégorie pour les événements de mariage au Sénégal','2024-09-18 12:22:57','2024-09-18 12:22:57'),(11,'Baptême','Catégorie pour les cérémonies de baptême au Sénégal','2024-09-18 12:22:57','2024-09-18 12:22:57'),(12,'Anniversaire','Catégorie pour les fêtes d’anniversaire au Sénégal','2024-09-18 12:22:57','2024-09-18 12:22:57'),(13,'Mariage','Catégorie pour les événements de mariage au Sénégal','2024-09-18 12:30:27','2024-09-18 12:30:27'),(14,'Baptême','Catégorie pour les cérémonies de baptême au Sénégal','2024-09-18 12:30:27','2024-09-18 12:30:27'),(15,'Anniversaire','Catégorie pour les fêtes d’anniversaire au Sénégal','2024-09-18 12:30:27','2024-09-18 12:30:27'),(16,'Mariage','Catégorie pour les événements de mariage au Sénégal','2024-09-18 12:31:25','2024-09-18 12:31:25'),(17,'Baptême','Catégorie pour les cérémonies de baptême au Sénégal','2024-09-18 12:31:25','2024-09-18 12:31:25'),(18,'Anniversaire','Catégorie pour les fêtes d’anniversaire au Sénégal','2024-09-18 12:31:25','2024-09-18 12:31:25'),(19,'Mariage','Catégorie pour les événements de mariage au Sénégal','2024-09-18 12:33:30','2024-09-18 12:33:30'),(20,'Baptême','Catégorie pour les cérémonies de baptême au Sénégal','2024-09-18 12:33:30','2024-09-18 12:33:30'),(21,'Anniversaire','Catégorie pour les fêtes d’anniversaire au Sénégal','2024-09-18 12:33:30','2024-09-18 12:33:30'),(22,'Mariage','Catégorie pour les événements de mariage au Sénégal','2024-09-18 12:34:36','2024-09-18 12:34:36'),(23,'Baptême','Catégorie pour les cérémonies de baptême au Sénégal','2024-09-18 12:34:36','2024-09-18 12:34:36'),(24,'Anniversaire','Catégorie pour les fêtes d’anniversaire au Sénégal','2024-09-18 12:34:36','2024-09-18 12:34:36'),(25,'Mariage','Catégorie pour les événements de mariage au Sénégal','2024-09-18 12:39:27','2024-09-18 12:39:27'),(26,'Baptême','Catégorie pour les cérémonies de baptême au Sénégal','2024-09-18 12:39:27','2024-09-18 12:39:27'),(27,'Anniversaire','Catégorie pour les fêtes d’anniversaire au Sénégal','2024-09-18 12:39:28','2024-09-18 12:39:28'),(28,'Mariage','Catégorie pour les événements de mariage au Sénégal','2024-09-18 12:40:23','2024-09-18 12:40:23'),(29,'Baptême','Catégorie pour les cérémonies de baptême au Sénégal','2024-09-18 12:40:23','2024-09-18 12:40:23'),(30,'Anniversaire','Catégorie pour les fêtes d’anniversaire au Sénégal','2024-09-18 12:40:23','2024-09-18 12:40:23'),(31,'Mariage','Catégorie pour les événements de mariage au Sénégal','2024-09-18 12:41:05','2024-09-18 12:41:05'),(32,'Baptême','Catégorie pour les cérémonies de baptême au Sénégal','2024-09-18 12:41:05','2024-09-18 12:41:05'),(33,'Anniversaire','Catégorie pour les fêtes d’anniversaire au Sénégal','2024-09-18 12:41:06','2024-09-18 12:41:06'),(34,'Mariage','Catégorie pour les événements de mariage au Sénégal','2024-09-18 12:43:10','2024-09-18 12:43:10'),(35,'Baptême','Catégorie pour les cérémonies de baptême au Sénégal','2024-09-18 12:43:10','2024-09-18 12:43:10'),(36,'Anniversaire','Catégorie pour les fêtes d’anniversaire au Sénégal','2024-09-18 12:43:10','2024-09-18 12:43:10'),(37,'Mariage','Catégorie pour les événements de mariage au Sénégal','2024-09-18 12:44:52','2024-09-18 12:44:52'),(38,'Baptême','Catégorie pour les cérémonies de baptême au Sénégal','2024-09-18 12:44:52','2024-09-18 12:44:52'),(39,'Anniversaire','Catégorie pour les fêtes d’anniversaire au Sénégal','2024-09-18 12:44:52','2024-09-18 12:44:52'),(40,'Mariage','Catégorie pour les événements de mariage au Sénégal','2024-09-18 12:50:22','2024-09-18 12:50:22'),(41,'Baptême','Catégorie pour les cérémonies de baptême au Sénégal','2024-09-18 12:50:22','2024-09-18 12:50:22'),(42,'Anniversaire','Catégorie pour les fêtes d’anniversaire au Sénégal','2024-09-18 12:50:22','2024-09-18 12:50:22'),(43,'Mariage','Catégorie pour les événements de mariage au Sénégal','2024-09-18 12:50:53','2024-09-18 12:50:53'),(44,'Baptême','Catégorie pour les cérémonies de baptême au Sénégal','2024-09-18 12:50:53','2024-09-18 12:50:53'),(45,'Anniversaire','Catégorie pour les fêtes d’anniversaire au Sénégal','2024-09-18 12:50:53','2024-09-18 12:50:53'),(46,'Mariage','Catégorie pour les événements de mariage au Sénégal','2024-09-18 12:51:15','2024-09-18 12:51:15'),(47,'Baptême','Catégorie pour les cérémonies de baptême au Sénégal','2024-09-18 12:51:15','2024-09-18 12:51:15'),(48,'Anniversaire','Catégorie pour les fêtes d’anniversaire au Sénégal','2024-09-18 12:51:15','2024-09-18 12:51:15'),(49,'seminaire','Catégorie pour tout ce qui concerne les mariages','2024-09-18 13:02:25','2024-09-18 13:02:25');
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
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `clients`
--

LOCK TABLES `clients` WRITE;
/*!40000 ALTER TABLE `clients` DISABLE KEYS */;
INSERT INTO `clients` VALUES (1,10,'2024-09-18 12:48:16','2024-09-18 12:48:16'),(2,11,'2024-09-18 13:41:36','2024-09-18 13:41:36');
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
  `date_ajout` timestamp NOT NULL,
  `client_id` bigint unsigned NOT NULL,
  `prestataire_id` bigint unsigned NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `commentaires_client_id_foreign` (`client_id`),
  KEY `commentaires_prestataire_id_foreign` (`prestataire_id`),
  CONSTRAINT `commentaires_client_id_foreign` FOREIGN KEY (`client_id`) REFERENCES `clients` (`id`) ON DELETE CASCADE,
  CONSTRAINT `commentaires_prestataire_id_foreign` FOREIGN KEY (`prestataire_id`) REFERENCES `prestataires` (`id`) ON DELETE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=8 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `commentaires`
--

LOCK TABLES `commentaires` WRITE;
/*!40000 ALTER TABLE `commentaires` DISABLE KEYS */;
INSERT INTO `commentaires` VALUES (6,'Très satisfait des prestations.','2024-09-18 12:51:16',1,2,'2024-09-18 12:51:16','2024-09-18 12:51:16'),(7,'zaertddiiyuizertyrrruazertyop^','2024-09-02 01:00:00',1,4,'2024-09-18 13:36:24','2024-09-18 13:36:24');
/*!40000 ALTER TABLE `commentaires` ENABLE KEYS */;
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
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=10 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `evenements`
--

LOCK TABLES `evenements` WRITE;
/*!40000 ALTER TABLE `evenements` DISABLE KEYS */;
INSERT INTO `evenements` VALUES (2,'Baptême à Thiès','Cérémonie de baptême dans la ville de Thiès','2024-10-15','Thiès','anniversaire','moins de 500000','2024-09-18 12:44:52','2024-09-18 12:44:52'),(3,'Mariage traditionnel','Un mariage traditionnel avec plus de 500 invités à Dakar','2024-09-30','Dakar','mariage','plus de 1000000','2024-09-18 12:50:22','2024-09-18 12:50:22'),(4,'Baptême à Thiès','Cérémonie de baptême dans la ville de Thiès','2024-10-15','Thiès','anniversaire','moins de 500000','2024-09-18 12:50:22','2024-09-18 12:50:22'),(5,'Mariage traditionnel','Un mariage traditionnel avec plus de 500 invités à Dakar','2024-09-30','Dakar','mariage','plus de 1000000','2024-09-18 12:50:53','2024-09-18 12:50:53'),(6,'Baptême à Thiès','Cérémonie de baptême dans la ville de Thiès','2024-10-15','Thiès','anniversaire','moins de 500000','2024-09-18 12:50:53','2024-09-18 12:50:53'),(7,'Mariage traditionnel','Un mariage traditionnel avec plus de 500 invités à Dakar','2024-09-30','Dakar','mariage','plus de 1000000','2024-09-18 12:51:15','2024-09-18 12:51:15'),(8,'Baptême à Thiès','Cérémonie de baptême dans la ville de Thiès','2024-10-15','Thiès','anniversaire','moins de 500000','2024-09-18 12:51:15','2024-09-18 12:51:15'),(9,'Mariage de Fatoumata','Un mariage somptueux au bord de la mer','2024-12-10','Dakar','mariage','500000 à 1000000','2024-09-18 13:16:47','2024-09-18 13:16:47');
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
-- Table structure for table `images`
--

DROP TABLE IF EXISTS `images`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `images` (
  `id` bigint unsigned NOT NULL AUTO_INCREMENT,
  `nom` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `image_data` blob NOT NULL,
  `prestataire_id` bigint unsigned NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `images_prestataire_id_foreign` (`prestataire_id`),
  CONSTRAINT `images_prestataire_id_foreign` FOREIGN KEY (`prestataire_id`) REFERENCES `prestataires` (`id`) ON DELETE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=6 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `images`
--

LOCK TABLES `images` WRITE;
/*!40000 ALTER TABLE `images` DISABLE KEYS */;
INSERT INTO `images` VALUES (4,'cffffffooojjjjjjjjjj',_binary '/tmp/phpaotctF',2,'2024-09-18 13:17:57','2024-09-18 13:17:57'),(5,'cffffffooojjjjjjjjjjkkkk',_binary '/tmp/phpNRUMW6',2,'2024-09-18 13:27:45','2024-09-18 13:27:45');
/*!40000 ALTER TABLE `images` ENABLE KEYS */;
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
) ENGINE=InnoDB AUTO_INCREMENT=50 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `migrations`
--

LOCK TABLES `migrations` WRITE;
/*!40000 ALTER TABLE `migrations` DISABLE KEYS */;
INSERT INTO `migrations` VALUES (6,'0001_01_01_000000_create_users_table',1),(7,'0001_01_01_000001_create_cache_table',1),(8,'0001_01_01_000002_create_jobs_table',1),(9,'2024_09_15_205935_create_personal_access_tokens_table',1),(10,'2024_09_15_210946_create_categories_table',1),(37,'2024_09_15_211007_create_clients_table',2),(38,'2024_09_15_211031_create_categorie_prestataires_table',2),(39,'2024_09_15_211048_create_prestataires_table',2),(40,'2024_09_15_211104_create_evenements_table',2),(41,'2024_09_15_211248_create_carte_invitations_table',2),(42,'2024_09_15_211328_create_carte_personnalisees_table',2),(43,'2024_09_15_211354_create_notifications_table',2),(44,'2024_09_15_211411_create_commentaires_table',2),(45,'2024_09_15_211421_create_votes_table',2),(46,'2024_09_15_211503_create_admins_table',2),(47,'2024_09_15_213916_create_permission_tables',2),(48,'2024_09_16_184952_create_sessions_table',2),(49,'2024_09_17_102601_create_images_table',2);
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
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `permissions`
--

LOCK TABLES `permissions` WRITE;
/*!40000 ALTER TABLE `permissions` DISABLE KEYS */;
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
  `categorie_prestataire_id` bigint unsigned NOT NULL,
  `logo` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `ninea` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `disponibilite` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `prestataires_user_id_foreign` (`user_id`),
  KEY `prestataires_categorie_prestataire_id_foreign` (`categorie_prestataire_id`),
  CONSTRAINT `prestataires_categorie_prestataire_id_foreign` FOREIGN KEY (`categorie_prestataire_id`) REFERENCES `categorie_prestataires` (`id`) ON DELETE CASCADE,
  CONSTRAINT `prestataires_user_id_foreign` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=9 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `prestataires`
--

LOCK TABLES `prestataires` WRITE;
/*!40000 ALTER TABLE `prestataires` DISABLE KEYS */;
INSERT INTO `prestataires` VALUES (2,7,2,'logo_resto_diop.jpg','789456ttttt','Lundi, Mardi, Mercredi, Samedi de 10h à 18h','2024-09-18 12:44:52','2024-09-18 12:44:52'),(4,7,2,'logo_resto_diop.jpg','789456ttttt','Lundi, Mardi, Mercredi, Samedi de 10h à 18h','2024-09-18 12:50:22','2024-09-18 12:50:22'),(6,7,2,'logo_resto_diop.jpg','789456ttttt','Lundi, Mardi, Mercredi, Samedi de 10h à 18h','2024-09-18 12:50:53','2024-09-18 12:50:53'),(8,7,2,'logo_resto_diop.jpg','789456ttttt','Lundi, Mardi, Mercredi, Samedi de 10h à 18h','2024-09-18 12:51:15','2024-09-18 12:51:15');
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
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `roles`
--

LOCK TABLES `roles` WRITE;
/*!40000 ALTER TABLE `roles` DISABLE KEYS */;
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
INSERT INTO `sessions` VALUES ('VY3HNjokwDcWwTL1vLKBh8aOgcZbsyBhJ6f6Zu6B',7,'YTozOntzOjY6Il90b2tlbiI7czo0MDoiczRmZXd0anFwQ2NITjQxeFVGekRqM0wxaFlLYnNhckl5bFhocmhGdiI7czo5OiJfcHJldmlvdXMiO2E6MTp7czozOiJ1cmwiO3M6MjE6Imh0dHA6Ly8xMjcuMC4wLjE6ODAwMCI7fXM6NjoiX2ZsYXNoIjthOjI6e3M6Mzoib2xkIjthOjA6e31zOjM6Im5ldyI7YTowOnt9fX0=',1726665162,'127.0.0.1','insomnia/9.3.3');
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
  `description` text COLLATE utf8mb4_unicode_ci,
  `adresse` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `telephone` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `role` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT 'client',
  `status` enum('active','inactive') COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT 'active',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `remember_token` varchar(100) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `users_email_unique` (`email`)
) ENGINE=InnoDB AUTO_INCREMENT=12 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `users`
--

LOCK TABLES `users` WRITE;
/*!40000 ALTER TABLE `users` DISABLE KEYS */;
INSERT INTO `users` VALUES (6,'Fatoum','fatoumatadansoko61@gmail.com','$2y$12$bu.VchGYuI65DhywYtuyauo1o47zJYnDsxbjxI0QzBbq66evwXmWy','azertyuio','123 Main Street','1234516789','prestataire','active','2024-09-17 19:47:04','2024-09-17 19:47:04',NULL),(7,'Fatoum','fatishma121@gmail.com','$2y$12$cl0mUJTSL3/87v24AAXfn.Vqv59B.6/LX5w.ZKRbUwLoQgYtMXR5a','azertyuio','123 Main Street','1234516789','client','active','2024-09-17 19:47:55','2024-09-17 19:47:55',NULL),(8,'Fatoum','adodabo00@gmail.com','$2y$12$vHJY5EygFCRvFtNqWHoCvOHomJ20AmBIzolv7D4URyjocr79Dl4Bm','azertyuio','123 Main Street','1234516789','prestataire','active','2024-09-17 20:05:11','2024-09-17 20:05:11',NULL),(9,'Fatoum','adodabo0rr0@gmail.com','$2y$12$Abqp5SxZgxawneA4RiBcmuPRGRrQ5N3.dw4M8rIyas5k0FQ9D3u7W','azertyuio','123 Main Street','1234516789','client','active','2024-09-18 12:42:23','2024-09-18 12:42:23',NULL),(10,'Fatoum','adodablo0rr0@gmail.com','$2y$12$fzLwXkTHYvuvAWlDZ/5nzOt4jtFeeHkCqTNscF2S2NY5rCPlnyhZm','azertyuio','123 Main Street','1234516789','client','active','2024-09-18 12:48:16','2024-09-18 12:48:16',NULL),(11,'Fatouml','adodablom0rr0@gmail.com','$2y$12$bzsoQ2jvS/lVOqyqrVt04e6Dh82InE2UcZYoTDvSwm/A8uJjjfn4W','azertyuio','123 Main Street','1234516789','client','active','2024-09-18 13:41:36','2024-09-18 13:41:36',NULL);
/*!40000 ALTER TABLE `users` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `votes`
--

DROP TABLE IF EXISTS `votes`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `votes` (
  `id` bigint unsigned NOT NULL AUTO_INCREMENT,
  `note` tinyint unsigned NOT NULL DEFAULT '1',
  `client_id` bigint unsigned NOT NULL,
  `prestataire_id` bigint unsigned NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `votes_client_id_foreign` (`client_id`),
  KEY `votes_prestataire_id_foreign` (`prestataire_id`),
  CONSTRAINT `votes_client_id_foreign` FOREIGN KEY (`client_id`) REFERENCES `clients` (`id`) ON DELETE CASCADE,
  CONSTRAINT `votes_prestataire_id_foreign` FOREIGN KEY (`prestataire_id`) REFERENCES `prestataires` (`id`) ON DELETE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=7 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `votes`
--

LOCK TABLES `votes` WRITE;
/*!40000 ALTER TABLE `votes` DISABLE KEYS */;
INSERT INTO `votes` VALUES (5,5,1,2,NULL,NULL),(6,4,1,2,'2024-09-18 13:13:43','2024-09-18 13:13:43');
/*!40000 ALTER TABLE `votes` ENABLE KEYS */;
UNLOCK TABLES;
/*!40103 SET TIME_ZONE=@OLD_TIME_ZONE */;

/*!40101 SET SQL_MODE=@OLD_SQL_MODE */;
/*!40014 SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS */;
/*!40014 SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
/*!40111 SET SQL_NOTES=@OLD_SQL_NOTES */;

-- Dump completed on 2024-09-19  9:45:16
