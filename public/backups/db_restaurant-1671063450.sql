-- MariaDB dump 10.19  Distrib 10.4.27-MariaDB, for Win64 (AMD64)
--
-- Host: localhost    Database: restaurant_app
-- ------------------------------------------------------
-- Server version	10.4.27-MariaDB

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
-- Table structure for table `attendances`
--

DROP TABLE IF EXISTS `attendances`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `attendances` (
  `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `employee_id` bigint(20) unsigned NOT NULL,
  `date` date NOT NULL,
  `in` time NOT NULL,
  `out` time DEFAULT NULL,
  `email` varchar(255) NOT NULL,
  `password` varchar(255) NOT NULL,
  `status` enum('IN','OUT') NOT NULL,
  `presence` enum('attend','permit') NOT NULL,
  `information` longtext DEFAULT NULL,
  `attandance_prove` longtext DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `attendances`
--

LOCK TABLES `attendances` WRITE;
/*!40000 ALTER TABLE `attendances` DISABLE KEYS */;
INSERT INTO `attendances` VALUES (1,11,'2022-12-14','08:32:02',NULL,'ibnuSyawal@gmail.com','$2y$10$1CqfEzI7jRuLmjKkJlGIaOv/g.z713fothTm9gEhuW6mqKs5VlFmC','IN','attend',NULL,NULL,'2022-12-14 13:32:02','2022-12-14 13:32:02');
/*!40000 ALTER TABLE `attendances` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `categories`
--

DROP TABLE IF EXISTS `categories`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `categories` (
  `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `category_name` varchar(255) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=13 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `categories`
--

LOCK TABLES `categories` WRITE;
/*!40000 ALTER TABLE `categories` DISABLE KEYS */;
INSERT INTO `categories` VALUES (1,'Mie',NULL,NULL),(2,'Makanan Berat',NULL,NULL),(3,'Salad',NULL,NULL),(4,'Makanan Ringan',NULL,NULL),(5,'Es Krim',NULL,NULL),(6,'Gak tau',NULL,NULL),(7,'Lah sih ',NULL,NULL),(8,'Makanan Berlemak',NULL,NULL),(9,'Keripik',NULL,NULL),(10,'yohh',NULL,NULL),(11,'adasd',NULL,NULL),(12,'Es Krim',NULL,NULL);
/*!40000 ALTER TABLE `categories` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `comments`
--

DROP TABLE IF EXISTS `comments`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `comments` (
  `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `user_id` bigint(20) unsigned NOT NULL,
  `menu_id` bigint(20) unsigned NOT NULL,
  `comment` longtext NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `comments`
--

LOCK TABLES `comments` WRITE;
/*!40000 ALTER TABLE `comments` DISABLE KEYS */;
/*!40000 ALTER TABLE `comments` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `contacts`
--

DROP TABLE IF EXISTS `contacts`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `contacts` (
  `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `name` varchar(255) NOT NULL,
  `email` varchar(255) NOT NULL,
  `subject` varchar(50) NOT NULL,
  `message` longtext NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `contacts`
--

LOCK TABLES `contacts` WRITE;
/*!40000 ALTER TABLE `contacts` DISABLE KEYS */;
/*!40000 ALTER TABLE `contacts` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `employees`
--

DROP TABLE IF EXISTS `employees`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `employees` (
  `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `name` varchar(255) NOT NULL,
  `birth` date NOT NULL,
  `age` int(11) NOT NULL,
  `phone_number` varchar(255) NOT NULL,
  `position` varchar(255) NOT NULL,
  `status` enum('Y','N') NOT NULL,
  `email` varchar(255) NOT NULL,
  `password` varchar(255) NOT NULL,
  `profile` varchar(255) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `employees_email_unique` (`email`)
) ENGINE=InnoDB AUTO_INCREMENT=16 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `employees`
--

LOCK TABLES `employees` WRITE;
/*!40000 ALTER TABLE `employees` DISABLE KEYS */;
INSERT INTO `employees` VALUES (1,'Rina Riyanti S.Farm','2014-06-12',28,'(+62) 882 492 942','Admin','N','zelaya.prakasa@gmail.co.id','$2y$10$I8qeeygj3TPT9EjhlgWvWOwnCJSkxHeUbc7.Ppuc/DQMjdpaDrg1a',NULL,'2022-12-14 05:48:14','2022-12-14 05:48:14'),(2,'Prayogo Pangestu','2009-07-21',39,'0913 0150 382','Admin','N','jati70@yahoo.co.id','$2y$10$pf094I/CgtzW7NY1KipPQefgl3Xnx2nho1/jSfvx9SnOFvwn.ivx2',NULL,'2022-12-14 05:48:15','2022-12-14 05:48:15'),(3,'Eli Usamah S.Sos','2006-09-17',46,'(+62) 800 4290 6463','Admin','N','kasiyah.laksita@yahoo.co.id','$2y$10$eYrf3TQJ5AkVDzs4tzRasOTYvNk9CDztq1JD.086fMpn8aOCbFsvm',NULL,'2022-12-14 05:48:15','2022-12-14 05:48:15'),(4,'Dinda Yulianti','2009-01-09',48,'(+62) 733 3469 617','Admin','N','hendri.usamah@yahoo.co.id','$2y$10$KbTdpJFyPWWJ0HoTF7YXP.pA6pDncdxq0OV2tTv/USGsLYBbfIS3G',NULL,'2022-12-14 05:48:15','2022-12-14 05:48:15'),(5,'Argono Rajata','1974-08-24',44,'(+62) 606 2702 4868','Admin','N','pradipta.faizah@yahoo.com','$2y$10$7B6bs9y7GqXBtuCzhwVPWe60JlQXraPenH3LXk/jqcfg.YOXAj6Ta',NULL,'2022-12-14 05:48:15','2022-12-14 05:48:15'),(6,'Marsudi Adriansyah','1995-10-25',18,'0533 7524 756','Admin','N','zrahayu@gmail.com','$2y$10$H8ET2x25ahTNZ9TN4klC7eHiIwrWoAyzmy9Ch2VhQBaEoOx3T9Ud6',NULL,'2022-12-14 05:48:15','2022-12-14 05:48:15'),(7,'Candra Saragih','2016-09-21',44,'(+62) 399 4259 1419','Admin','N','yuniar.tasdik@yahoo.com','$2y$10$BNRfREUJpjj.V25rEvXnBeSfufttNe8uVeQv9oGhrWPg3W8nmxjG.',NULL,'2022-12-14 05:48:15','2022-12-14 05:48:15'),(8,'Bagus Waluyo','2005-12-19',54,'(+62) 813 433 788','Admin','N','latika38@gmail.com','$2y$10$yT99SSAzmziF.wXIAYMvqemZvGkJpFJAUdw5tB2Ss0pXOc3L6OlLO',NULL,'2022-12-14 05:48:15','2022-12-14 05:48:15'),(9,'Carla Handayani','2017-10-17',19,'0383 9834 709','Admin','N','kiandra.zulaika@gmail.co.id','$2y$10$9fvGX8dyUhATVaQ1qfI83OCHyKuD4LQh9vgAQL5T2oNvmtobwQfxe',NULL,'2022-12-14 05:48:15','2022-12-14 05:48:15'),(10,'Dartono Ajiono Sitorus M.Ak','2020-01-13',40,'0272 6548 0955','Admin','N','sihotang.asirwada@yahoo.co.id','$2y$10$Pefpey0/xcGT4a5cRFflDeE4VYRTU9FKiaidTQfJGbP83LsQR/BMO',NULL,'2022-12-14 05:48:15','2022-12-14 05:48:15'),(11,'Ibnu Syawal Aliefian','2004-11-16',18,'082162941198','Admin','Y','ibnuSyawal@gmail.com','$2y$10$UaG.kK/RwFX5JJrfr5NQG..4c83dtll3YK9isIxgvDAMJzH1Dzdma',NULL,NULL,NULL),(12,'Mochammad Ibnu Kamil','2007-05-13',16,'083144158831','Staff','Y','KamilCuyy@gmail.com','$2y$10$Z6YQs9aPvRvDnkHRjDpAuO9b4/x/68uAjPeYVojJ4ZJddeAA2KAIq',NULL,NULL,NULL),(13,'Muhammad Iqro Negoro','2005-08-18',17,'083144158812','Staff','Y','IqroNegoro@gmail.com','$2y$10$5ykEXfkDG4FdiM/IX77vaOf2WiSlb1pUH0nJQ5y1EB1OUReArEaE.',NULL,NULL,NULL),(14,'Aqilah Azzahra','2005-08-18',17,'083145418812','Manager','N','Aqilah1111@gmail.com','$2y$10$Nh0h64MGE0VKc43RS.TYMuSHaH0fzakZNLE8FBcrCwmOP5VGgzB3S',NULL,NULL,NULL),(15,'Akhmad Alwan Rabbani','2005-07-11',17,'082176158812','Chef','Y','ARRabbani@gmail.com','$2y$10$k4x6v9WyhvqsHa2shI5UyeYpCmR/n3quyKIMl4wC2fbs0O6qoc.Lm',NULL,NULL,NULL);
/*!40000 ALTER TABLE `employees` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `failed_jobs`
--

DROP TABLE IF EXISTS `failed_jobs`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `failed_jobs` (
  `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `uuid` varchar(255) NOT NULL,
  `connection` text NOT NULL,
  `queue` text NOT NULL,
  `payload` longtext NOT NULL,
  `exception` longtext NOT NULL,
  `failed_at` timestamp NOT NULL DEFAULT current_timestamp(),
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
-- Table structure for table `galleries`
--

DROP TABLE IF EXISTS `galleries`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `galleries` (
  `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `galleries`
--

LOCK TABLES `galleries` WRITE;
/*!40000 ALTER TABLE `galleries` DISABLE KEYS */;
/*!40000 ALTER TABLE `galleries` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `menus`
--

DROP TABLE IF EXISTS `menus`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `menus` (
  `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `category_id` bigint(20) unsigned NOT NULL,
  `name` varchar(255) NOT NULL,
  `menu_type` enum('mainCourse','appetizer','dessert') NOT NULL,
  `price` varchar(255) NOT NULL,
  `image` varchar(255) NOT NULL,
  `description` longtext NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=5 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `menus`
--

LOCK TABLES `menus` WRITE;
/*!40000 ALTER TABLE `menus` DISABLE KEYS */;
INSERT INTO `menus` VALUES (1,1,'Spaghetti Laurentino','mainCourse','12000','images/nCbS53JxRVl3DIuaYaH9bOEVyWrqXTLUEbPrlYiK.jpg','Makanan Yang sangat Sedap','2022-12-14 06:25:34','2022-12-14 12:59:13'),(2,8,'Steak','mainCourse','82345','images/W15U2MptYa6PlXCTFhkRtb2fgzMHzhlJ3NsHKN7x.png','Steak yang sangat lezat','2022-12-14 06:26:52','2022-12-14 06:26:52'),(3,3,'Salad Italia','appetizer','35000','images/jx8SyAKtZlO3YG5mICQ9UygFogWtbnKqI50SD3Om.png','Mamamia lezatos','2022-12-14 06:30:17','2022-12-14 06:30:17'),(4,2,'Nasi Goreng','mainCourse','20000','images/0XFHuxjDhXUlJzKK42qRhijH88VyXRAlmujSMz61.png','Nasi Goreng yang sangat enak','2022-12-14 06:31:19','2022-12-14 06:31:19');
/*!40000 ALTER TABLE `menus` ENABLE KEYS */;
UNLOCK TABLES;

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
) ENGINE=InnoDB AUTO_INCREMENT=19 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `migrations`
--

LOCK TABLES `migrations` WRITE;
/*!40000 ALTER TABLE `migrations` DISABLE KEYS */;
INSERT INTO `migrations` VALUES (1,'2014_10_12_000000_create_users_table',1),(2,'2014_10_12_100000_create_password_resets_table',1),(3,'2019_08_19_000000_create_failed_jobs_table',1),(4,'2019_12_14_000001_create_personal_access_tokens_table',1),(5,'2022_09_25_065800_create_categories_table',1),(6,'2022_09_26_012800_create_menus_table',1),(7,'2022_09_26_072638_create_orders_table',1),(8,'2022_09_26_073516_create_tables_table',1),(9,'2022_09_27_143906_create_payment_methods_table',1),(10,'2022_10_04_145408_create_contacts_table',1),(11,'2022_10_04_150021_create_employees_table',1),(12,'2022_10_22_122202_create_comments_table',1),(13,'2022_10_22_123717_create_vouchers_table',1),(14,'2022_10_30_133219_create_performances_table',1),(15,'2022_10_30_133637_create_works_table',1),(16,'2022_10_31_132324_create_attendances_table',1),(17,'2022_11_17_212620_create_salaries_table',1),(18,'2022_11_28_064505_create_galleries_table',1);
/*!40000 ALTER TABLE `migrations` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `orders`
--

DROP TABLE IF EXISTS `orders`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `orders` (
  `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `menu_id` bigint(20) unsigned NOT NULL,
  `user_id` bigint(20) unsigned NOT NULL,
  `table_id` bigint(20) unsigned NOT NULL,
  `payment_method` varchar(255) NOT NULL,
  `order_code` varchar(255) NOT NULL,
  `quantity` varchar(50) NOT NULL,
  `detail` longtext DEFAULT NULL,
  `price` varchar(50) NOT NULL,
  `total_pay` varchar(50) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `orders`
--

LOCK TABLES `orders` WRITE;
/*!40000 ALTER TABLE `orders` DISABLE KEYS */;
INSERT INTO `orders` VALUES (1,1,2,13,'Pay Pal','S77H67YJu','2',NULL,'12000','24000','2022-12-14 13:10:09','2022-12-14 13:10:09');
/*!40000 ALTER TABLE `orders` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `password_resets`
--

DROP TABLE IF EXISTS `password_resets`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `password_resets` (
  `email` varchar(255) NOT NULL,
  `user` enum('user','employee') NOT NULL,
  `token` varchar(255) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  KEY `password_resets_email_index` (`email`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `password_resets`
--

LOCK TABLES `password_resets` WRITE;
/*!40000 ALTER TABLE `password_resets` DISABLE KEYS */;
/*!40000 ALTER TABLE `password_resets` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `payment_methods`
--

DROP TABLE IF EXISTS `payment_methods`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `payment_methods` (
  `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `method` varchar(255) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `payment_methods`
--

LOCK TABLES `payment_methods` WRITE;
/*!40000 ALTER TABLE `payment_methods` DISABLE KEYS */;
/*!40000 ALTER TABLE `payment_methods` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `performances`
--

DROP TABLE IF EXISTS `performances`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `performances` (
  `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `employee_id` bigint(20) unsigned NOT NULL,
  `date` date NOT NULL,
  `start` time NOT NULL,
  `end` time DEFAULT NULL,
  `description` longtext NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `performances`
--

LOCK TABLES `performances` WRITE;
/*!40000 ALTER TABLE `performances` DISABLE KEYS */;
/*!40000 ALTER TABLE `performances` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `personal_access_tokens`
--

DROP TABLE IF EXISTS `personal_access_tokens`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `personal_access_tokens` (
  `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `tokenable_type` varchar(255) NOT NULL,
  `tokenable_id` bigint(20) unsigned NOT NULL,
  `name` varchar(255) NOT NULL,
  `token` varchar(64) NOT NULL,
  `abilities` text DEFAULT NULL,
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
-- Table structure for table `salaries`
--

DROP TABLE IF EXISTS `salaries`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `salaries` (
  `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `salaries`
--

LOCK TABLES `salaries` WRITE;
/*!40000 ALTER TABLE `salaries` DISABLE KEYS */;
/*!40000 ALTER TABLE `salaries` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `tables`
--

DROP TABLE IF EXISTS `tables`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `tables` (
  `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `table_number` varchar(25) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=31 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `tables`
--

LOCK TABLES `tables` WRITE;
/*!40000 ALTER TABLE `tables` DISABLE KEYS */;
INSERT INTO `tables` VALUES (1,'Table-46','2022-12-14 05:48:15','2022-12-14 05:48:15'),(2,'Table-22','2022-12-14 05:48:15','2022-12-14 05:48:15'),(3,'Table-57','2022-12-14 05:48:15','2022-12-14 05:48:15'),(4,'Table-91','2022-12-14 05:48:15','2022-12-14 05:48:15'),(5,'Table-98','2022-12-14 05:48:15','2022-12-14 05:48:15'),(6,'Table-54','2022-12-14 05:48:15','2022-12-14 05:48:15'),(7,'Table-76','2022-12-14 05:48:15','2022-12-14 05:48:15'),(8,'Table-26','2022-12-14 05:48:15','2022-12-14 05:48:15'),(9,'Table-100','2022-12-14 05:48:15','2022-12-14 05:48:15'),(10,'Table-10','2022-12-14 05:48:15','2022-12-14 05:48:15'),(11,'Table-45','2022-12-14 05:48:15','2022-12-14 05:48:15'),(12,'Table-86','2022-12-14 05:48:15','2022-12-14 05:48:15'),(13,'Table-34','2022-12-14 05:48:15','2022-12-14 05:48:15'),(14,'Table-64','2022-12-14 05:48:15','2022-12-14 05:48:15'),(15,'Table-98','2022-12-14 05:48:15','2022-12-14 05:48:15'),(16,'Table-36','2022-12-14 05:48:15','2022-12-14 05:48:15'),(17,'Table-42','2022-12-14 05:48:15','2022-12-14 05:48:15'),(18,'Table-18','2022-12-14 05:48:15','2022-12-14 05:48:15'),(19,'Table-48','2022-12-14 05:48:15','2022-12-14 05:48:15'),(20,'Table-57','2022-12-14 05:48:15','2022-12-14 05:48:15'),(21,'Table-15','2022-12-14 05:48:15','2022-12-14 05:48:15'),(22,'Table-15','2022-12-14 05:48:15','2022-12-14 05:48:15'),(23,'Table-96','2022-12-14 05:48:15','2022-12-14 05:48:15'),(24,'Table-69','2022-12-14 05:48:15','2022-12-14 05:48:15'),(25,'Table-70','2022-12-14 05:48:15','2022-12-14 05:48:15'),(26,'Table-47','2022-12-14 05:48:15','2022-12-14 05:48:15'),(27,'Table-23','2022-12-14 05:48:15','2022-12-14 05:48:15'),(28,'Table-93','2022-12-14 05:48:15','2022-12-14 05:48:15'),(29,'Table-39','2022-12-14 05:48:15','2022-12-14 05:48:15'),(30,'Table-74','2022-12-14 05:48:15','2022-12-14 05:48:15');
/*!40000 ALTER TABLE `tables` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `users`
--

DROP TABLE IF EXISTS `users`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `users` (
  `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `name` varchar(100) NOT NULL,
  `birth` date NOT NULL,
  `phone_number` varchar(255) NOT NULL,
  `role` enum('costumer','admin') NOT NULL DEFAULT 'costumer',
  `username` varchar(255) NOT NULL,
  `email` varchar(255) NOT NULL,
  `password` varchar(255) NOT NULL,
  `email_verified_at` timestamp NULL DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `users_username_unique` (`username`),
  UNIQUE KEY `users_email_unique` (`email`)
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `users`
--

LOCK TABLES `users` WRITE;
/*!40000 ALTER TABLE `users` DISABLE KEYS */;
INSERT INTO `users` VALUES (1,'Ibnu Syawal Aliefian','2004-11-04','082162941198','admin','Admin','superglidingogre0571@gmail.com','$2y$10$DFXe5op/J1FuMysN.EWPLeYKxrxwGEDdp.eiyM1oV1h4WOuwSX6QW',NULL,NULL,NULL),(2,'Mochammad Ibnu Kamil','2007-05-13','081123515454','costumer','IbnuKamil','IbnuKamil@gmail.com','$2y$10$KpE618dTWieKRt31ZsuCy.tqG.QGda/DzL/Ldt87DXS5atmMcfTL2',NULL,NULL,NULL);
/*!40000 ALTER TABLE `users` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `vouchers`
--

DROP TABLE IF EXISTS `vouchers`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `vouchers` (
  `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `name` varchar(255) NOT NULL,
  `description` longtext NOT NULL,
  `expired` datetime NOT NULL,
  `code` varchar(255) NOT NULL,
  `type` varchar(255) NOT NULL,
  `amount` int(11) NOT NULL,
  `limit` int(11) NOT NULL,
  `minPurchase` varchar(255) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `vouchers_code_unique` (`code`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `vouchers`
--

LOCK TABLES `vouchers` WRITE;
/*!40000 ALTER TABLE `vouchers` DISABLE KEYS */;
/*!40000 ALTER TABLE `vouchers` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `works`
--

DROP TABLE IF EXISTS `works`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `works` (
  `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `employee_id` bigint(20) unsigned NOT NULL,
  `job_desk` varchar(255) NOT NULL,
  `job_done` enum('1','0') NOT NULL DEFAULT '0',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `works`
--

LOCK TABLES `works` WRITE;
/*!40000 ALTER TABLE `works` DISABLE KEYS */;
INSERT INTO `works` VALUES (1,3,'Melayani Para tamu','0',NULL,NULL),(2,9,'Melakukan pengawasan terhadap semu pegawai','0',NULL,NULL);
/*!40000 ALTER TABLE `works` ENABLE KEYS */;
UNLOCK TABLES;
/*!40103 SET TIME_ZONE=@OLD_TIME_ZONE */;

/*!40101 SET SQL_MODE=@OLD_SQL_MODE */;
/*!40014 SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS */;
/*!40014 SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
/*!40111 SET SQL_NOTES=@OLD_SQL_NOTES */;

-- Dump completed on 2022-12-15  7:17:31
