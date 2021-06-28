-- MySQL dump 10.13  Distrib 8.0.23, for Win64 (x86_64)
--
-- Host: 127.0.0.1    Database: mydb
-- ------------------------------------------------------
-- Server version	8.0.23

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
-- Table structure for table `accounts`
--

DROP TABLE IF EXISTS `accounts`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `accounts` (
  `id` int unsigned NOT NULL AUTO_INCREMENT,
  `username` varchar(45) NOT NULL,
  `created_at` datetime NOT NULL,
  `status` varchar(45) NOT NULL DEFAULT 'ACTIVE',
  PRIMARY KEY (`id`),
  UNIQUE KEY `username_UNIQUE` (`username`),
  UNIQUE KEY `id_UNIQUE` (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=66 DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `accounts`
--

LOCK TABLES `accounts` WRITE;
/*!40000 ALTER TABLE `accounts` DISABLE KEYS */;
INSERT INTO `accounts` VALUES (1,'emms','2020-10-10 06:48:17','ACTIVE'),(2,'iXPvIAawu6YMMQ==','2021-03-22 10:26:02','ACTIVE'),(3,'wbZU9fHWTX1UeA==','2021-03-22 10:26:02','ACTIVE'),(4,'Sl0t84EaSrfXkA==','2021-03-22 10:26:02','ACTIVE'),(5,'8PyAxjKf9K7Usg==','2021-03-22 10:26:02','ACTIVE'),(6,'Tj10bW0Rh4pnaA==','2021-03-22 10:26:02','ACTIVE'),(7,'lPeAnqa6Gut18g==','2021-03-22 10:26:02','ACTIVE'),(8,'d6ZWziLpt9yi/A==','2021-03-22 10:26:02','ACTIVE'),(9,'QEG7PA0Ln6jPnQ==','2021-03-22 10:26:02','ACTIVE'),(10,'WHjE9IcjA61oyw==','2021-03-22 10:26:02','ACTIVE'),(11,'j8+iUOoNXJvILg==','2021-03-22 10:26:02','ACTIVE'),(12,'Fast','2021-03-15 12:14:00','ACTIVE'),(13,'Too Fast','2021-03-15 12:14:00','ACTIVE'),(16,'Sally Handson INC','2021-04-06 17:29:39','ACTIVE'),(21,'Kennedy Walsh doo','2021-04-07 12:19:07','PENDING'),(29,'May INC','2021-04-07 19:08:25','PENDING'),(33,'My Test Account','2021-04-09 18:46:26','PENDING'),(36,'My Account','2021-04-10 14:58:42','PENDING'),(41,'Mine First','2021-04-10 15:19:41','ACTIVE'),(50,'Another one','2021-04-12 13:35:06','PENDING'),(51,'MyJFTB','2021-04-25 20:01:04','ACTIVE'),(52,'JFB','2021-06-22 19:33:56','PENDING'),(59,'JFB2','2021-06-22 19:36:56','PENDING'),(65,'Dzeni','2021-06-28 12:58:03','ACTIVE');
/*!40000 ALTER TABLE `accounts` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `feedback`
--

DROP TABLE IF EXISTS `feedback`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `feedback` (
  `id` int unsigned NOT NULL,
  `title` varchar(45) NOT NULL,
  `text` varchar(300) NOT NULL,
  `date_created` datetime NOT NULL,
  `account_id` int unsigned NOT NULL,
  `recipe_id` int unsigned NOT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `id_UNIQUE` (`id`),
  KEY `recipe_id` (`recipe_id`),
  KEY `account_id_fk_idx` (`account_id`),
  CONSTRAINT `account_id_fk` FOREIGN KEY (`account_id`) REFERENCES `accounts` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  CONSTRAINT `recipe_id_fk` FOREIGN KEY (`recipe_id`) REFERENCES `recipes` (`id`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `feedback`
--

LOCK TABLES `feedback` WRITE;
/*!40000 ALTER TABLE `feedback` DISABLE KEYS */;
/*!40000 ALTER TABLE `feedback` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `ingredients`
--

DROP TABLE IF EXISTS `ingredients`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `ingredients` (
  `id` int unsigned NOT NULL AUTO_INCREMENT,
  `ingredient_name` varchar(100) NOT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `id_UNIQUE` (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=15 DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `ingredients`
--

LOCK TABLES `ingredients` WRITE;
/*!40000 ALTER TABLE `ingredients` DISABLE KEYS */;
INSERT INTO `ingredients` VALUES (1,'flour'),(2,'eggs'),(3,'milk'),(4,'sugar'),(5,'butter'),(6,'cocoa powder'),(7,'strawberry jam'),(8,'bread'),(9,'ketchup'),(10,'mayonnaise'),(11,'sweet pickle relish'),(12,'salt'),(13,'pepper'),(14,'yellow mustard');
/*!40000 ALTER TABLE `ingredients` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `measurement_qty`
--

DROP TABLE IF EXISTS `measurement_qty`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `measurement_qty` (
  `id` int unsigned NOT NULL AUTO_INCREMENT,
  `quantity_amount` varchar(45) NOT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `id_UNIQUE` (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=11 DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `measurement_qty`
--

LOCK TABLES `measurement_qty` WRITE;
/*!40000 ALTER TABLE `measurement_qty` DISABLE KEYS */;
INSERT INTO `measurement_qty` VALUES (1,'one'),(2,'two'),(3,'three'),(4,'four'),(5,'five'),(6,'six'),(7,'seven'),(8,'squeeze'),(9,'dash'),(10,'splash');
/*!40000 ALTER TABLE `measurement_qty` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `measurement_units`
--

DROP TABLE IF EXISTS `measurement_units`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `measurement_units` (
  `id` int unsigned NOT NULL AUTO_INCREMENT,
  `measurement_description` varchar(45) NOT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `id_UNIQUE` (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=5 DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `measurement_units`
--

LOCK TABLES `measurement_units` WRITE;
/*!40000 ALTER TABLE `measurement_units` DISABLE KEYS */;
INSERT INTO `measurement_units` VALUES (1,'cup/s'),(2,'big spoon/s'),(3,'small spoon/s'),(4,'squeeze');
/*!40000 ALTER TABLE `measurement_units` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `recipe_ingredients`
--

DROP TABLE IF EXISTS `recipe_ingredients`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `recipe_ingredients` (
  `id` int unsigned NOT NULL AUTO_INCREMENT,
  `recipe_id` int unsigned NOT NULL,
  `measurement_id` int unsigned NOT NULL,
  `measurement_qty_id` int unsigned NOT NULL,
  `ingredient_id` int unsigned NOT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `ingredients_id_UNIQUE` (`ingredient_id`),
  UNIQUE KEY `measurement_id_UNIQUE` (`measurement_id`),
  UNIQUE KEY `measurement_qty_id_UNIQUE` (`measurement_qty_id`) /*!80000 INVISIBLE */,
  UNIQUE KEY `id_UNIQUE` (`id`),
  UNIQUE KEY `recipe_id_UNIQUE` (`recipe_id`),
  CONSTRAINT `fk_recipe_id` FOREIGN KEY (`recipe_id`) REFERENCES `recipes` (`id`),
  CONSTRAINT `ingredient_id` FOREIGN KEY (`ingredient_id`) REFERENCES `ingredients` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  CONSTRAINT `measurement_id` FOREIGN KEY (`measurement_id`) REFERENCES `measurement_units` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  CONSTRAINT `measurement_qty_id` FOREIGN KEY (`measurement_qty_id`) REFERENCES `measurement_qty` (`id`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=13 DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `recipe_ingredients`
--

LOCK TABLES `recipe_ingredients` WRITE;
/*!40000 ALTER TABLE `recipe_ingredients` DISABLE KEYS */;
INSERT INTO `recipe_ingredients` VALUES (6,5,1,1,3),(7,6,2,2,1);
/*!40000 ALTER TABLE `recipe_ingredients` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `recipecategory`
--

DROP TABLE IF EXISTS `recipecategory`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `recipecategory` (
  `id` int unsigned NOT NULL,
  `category_description` varchar(100) NOT NULL,
  `category_name` varchar(45) NOT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `category_name_UNIQUE` (`category_name`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `recipecategory`
--

LOCK TABLES `recipecategory` WRITE;
/*!40000 ALTER TABLE `recipecategory` DISABLE KEYS */;
INSERT INTO `recipecategory` VALUES (1,'Salty food, real dishes','savory'),(2,'Sweets and desserts','sweet');
/*!40000 ALTER TABLE `recipecategory` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `recipes`
--

DROP TABLE IF EXISTS `recipes`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `recipes` (
  `id` int unsigned NOT NULL AUTO_INCREMENT,
  `recipe_name` varchar(45) NOT NULL,
  `recipe_difficulty_level` int NOT NULL,
  `description` varchar(250) NOT NULL,
  `tips` varchar(250) NOT NULL,
  `created_at` datetime NOT NULL,
  `category_id` int unsigned NOT NULL,
  `account_id` int unsigned NOT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `account_id_UNIQUE` (`account_id`),
  UNIQUE KEY `recipe_name_UNIQUE` (`recipe_name`),
  UNIQUE KEY `id_UNIQUE` (`id`) /*!80000 INVISIBLE */,
  KEY `category_id` (`category_id`) /*!80000 INVISIBLE */,
  KEY `account_id` (`account_id`),
  CONSTRAINT `a_id_fk` FOREIGN KEY (`account_id`) REFERENCES `accounts` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  CONSTRAINT `category_id` FOREIGN KEY (`category_id`) REFERENCES `recipecategory` (`id`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=8 DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `recipes`
--

LOCK TABLES `recipes` WRITE;
/*!40000 ALTER TABLE `recipes` DISABLE KEYS */;
INSERT INTO `recipes` VALUES (5,'Cake',4,'Chocolate cake with strwaberry filling','Let the cake cool before assembling','2021-03-15 12:14:00',2,65),(6,'Toast',1,'Toasted bread','Don\'t let the bread burn and use sourdough bread','2019-01-11 12:12:32',1,51),(7,'Animal style sauce',2,'Sauce to use with your fries','Use more of some ingredient by liking','2020-10-12 17:36:20',1,16);
/*!40000 ALTER TABLE `recipes` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `user`
--

DROP TABLE IF EXISTS `user`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `user` (
  `id` int unsigned NOT NULL AUTO_INCREMENT,
  `name` varchar(45) NOT NULL,
  `email` varchar(45) NOT NULL,
  `password` varchar(45) NOT NULL,
  `status` varchar(45) NOT NULL DEFAULT 'PENDING',
  `role` varchar(45) NOT NULL DEFAULT 'USER',
  `created_at` datetime NOT NULL,
  `token` varchar(45) DEFAULT NULL,
  `token_created_at` datetime DEFAULT NULL,
  `account_id` int unsigned NOT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `username_UNIQUE` (`name`),
  UNIQUE KEY `email_UNIQUE` (`email`),
  UNIQUE KEY `user_id_UNIQUE` (`id`),
  KEY `account_id` (`account_id`),
  CONSTRAINT `acc_id_fk` FOREIGN KEY (`account_id`) REFERENCES `accounts` (`id`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=28 DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `user`
--

LOCK TABLES `user` WRITE;
/*!40000 ALTER TABLE `user` DISABLE KEYS */;
INSERT INTO `user` VALUES (2,'Emma Lowrey','emma.lowrey@gmail.com','pass123','PENDING','USER','0000-00-00 00:00:00',NULL,NULL,1),(3,'Joe Blue','joe.blue@live.com','key1112','PENDING','USER','0000-00-00 00:00:00',NULL,NULL,3),(4,'Sally Handson','sally.hn@stu.ibu.edu.ba','sals123','ACTIVE','USER','2021-04-06 17:29:39','749dea28bd514b414767b633a7c1f0ce',NULL,16),(7,'Kennedy Walsh','kennyy@stu.ibu.edu.ba','kens123','PENDING','USER','2021-04-07 12:19:07','47698c3b4d063d7d8a8bcb31dc16e14d',NULL,21),(8,'May April','mayy@stu.ibu.edu.ba','maya123','PENDING','USER','2021-04-07 19:08:25','8b1ec67388bcc718957fdea6b8620aa4',NULL,29),(13,'Last First','dzenana.mededovic@stu.ibu.edu.ba',' b4af804009cb036a4ccdc33431ef9ac9','ACTIVE','ADMIN','2021-04-10 15:19:41','3ad351789390ba87cb4a6b1ff1cee194',NULL,41),(18,'DJ Khaled','dj@gmail.com','1d12c40b09080aa328c775fc60ee2655','PENDING','ADMIN','2021-04-12 13:35:06','bdf3e40c0ea8f628f56289d97c2458b7',NULL,50),(19,'Dzeni Med','dzenana.mededovic@gmail.com','b4af804009cb036a4ccdc33431ef9ac9','ACTIVE','ADMIN','2021-04-25 20:01:04',NULL,NULL,51),(27,'Dzenana Med','dzenana.mededovic2@gmail.com','32250170a0dca92d53ec9624f336ca24','ACTIVE','USER','2021-06-28 12:58:03',NULL,NULL,65);
/*!40000 ALTER TABLE `user` ENABLE KEYS */;
UNLOCK TABLES;
/*!40103 SET TIME_ZONE=@OLD_TIME_ZONE */;

/*!40101 SET SQL_MODE=@OLD_SQL_MODE */;
/*!40014 SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS */;
/*!40014 SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
/*!40111 SET SQL_NOTES=@OLD_SQL_NOTES */;

-- Dump completed on 2021-06-28 23:45:04
