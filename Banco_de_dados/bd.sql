CREATE DATABASE  IF NOT EXISTS `wdaloc` /*!40100 DEFAULT CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci */ /*!80016 DEFAULT ENCRYPTION='N' */;
USE `wdaloc`;
-- MySQL dump 10.13  Distrib 8.0.33, for Win64 (x86_64)
--
-- Host: localhost    Database: wdaloc
-- ------------------------------------------------------
-- Server version	8.0.33

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
-- Table structure for table `admi`
--

DROP TABLE IF EXISTS `admi`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `admi` (
  `id` int NOT NULL AUTO_INCREMENT,
  `adm` varchar(45) COLLATE utf8mb4_unicode_ci NOT NULL,
  `adme` varchar(100) COLLATE utf8mb4_unicode_ci NOT NULL,
  `senha` varchar(20) COLLATE utf8mb4_unicode_ci NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `admi`
--

LOCK TABLES `admi` WRITE;
/*!40000 ALTER TABLE `admi` DISABLE KEYS */;
INSERT INTO `admi` VALUES (1,'tuanne','tuanne@gmail.com','1234');
/*!40000 ALTER TABLE `admi` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `alugados`
--

DROP TABLE IF EXISTS `alugados`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `alugados` (
  `id` int NOT NULL AUTO_INCREMENT,
  `nomela` varchar(45) COLLATE utf8mb4_unicode_ci NOT NULL,
  `nomeua` varchar(45) COLLATE utf8mb4_unicode_ci NOT NULL,
  `dataalug` date NOT NULL,
  `dataprev` date NOT NULL,
  `datadev` varchar(50) COLLATE utf8mb4_unicode_ci NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=28 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `alugados`
--

LOCK TABLES `alugados` WRITE;
/*!40000 ALTER TABLE `alugados` DISABLE KEYS */;
INSERT INTO `alugados` VALUES (14,'O pequeno Príncipe','Tuanne da Frota Augusto','2023-05-08','2023-06-07','09/05/2023'),(16,'Revolução dos bichos','Antonio José dos Santos Filho','2023-05-08','2023-05-07','08/05/2023'),(17,'Orgulho e Preconceito','Emanuela Pinto da Frota Sousa','2023-05-08','2023-05-07','09/05/2023'),(21,'Sakura Card Captors vol.1','Tuanne da Frota Augusto','2023-01-11','2023-02-10','0'),(22,'Orgulho e Preconceito','Emanuel Guilherme da Frota da Silva','2023-04-04','2023-05-04','0'),(23,'Neon Genesis Evangelion','Emanuel Guilherme da Frota da Silva','2023-05-09','2023-06-08','09/05/2023'),(24,'Revolução dos bichos','asukinha','2023-05-09','2023-06-08','0'),(25,'O pequeno Príncipe','Emanuel Guilherme da Frota da Silva','2023-05-10','2023-05-24','09/05/2023'),(26,'O Castelo Andante de Howl','asukinha','2023-05-01','2023-05-09','09/05/2023'),(27,'Orgulho e Preconceito','Vivencia Pinto da Frota Sousa','2023-04-10','2023-05-09','0');
/*!40000 ALTER TABLE `alugados` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `editoras`
--

DROP TABLE IF EXISTS `editoras`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `editoras` (
  `id` int NOT NULL AUTO_INCREMENT,
  `nomee` varchar(45) COLLATE utf8mb4_unicode_ci NOT NULL,
  `emaile` varchar(110) COLLATE utf8mb4_unicode_ci NOT NULL,
  `numeroe` int NOT NULL,
  `sitee` varchar(45) COLLATE utf8mb4_unicode_ci NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=6 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `editoras`
--

LOCK TABLES `editoras` WRITE;
/*!40000 ALTER TABLE `editoras` DISABLE KEYS */;
INSERT INTO `editoras` VALUES (2,'pe','pe@perna',32412454,'pe.com.dedo.br'),(3,'New POP','NewPOPmangas@gmail.com',987654321,''),(4,'HarperCollins','HarperCollins@gmail.com',232434452,'https://harpercollins.com.br/'),(5,'jbc','jdbc@brasil.com',46242152,'https://editorajbc.com.br/');
/*!40000 ALTER TABLE `editoras` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `livros`
--

DROP TABLE IF EXISTS `livros`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `livros` (
  `id` int NOT NULL AUTO_INCREMENT,
  `nomel` varchar(45) COLLATE utf8mb4_unicode_ci NOT NULL,
  `autor` varchar(45) COLLATE utf8mb4_unicode_ci NOT NULL,
  `editoral` varchar(45) COLLATE utf8mb4_unicode_ci NOT NULL,
  `lanc` date NOT NULL,
  `estoque` int NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=9 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `livros`
--

LOCK TABLES `livros` WRITE;
/*!40000 ALTER TABLE `livros` DISABLE KEYS */;
INSERT INTO `livros` VALUES (2,'O pequeno Príncipe','Antoine de Saint-Exupéry','HarperCollins','1943-04-06',25),(4,'Neon Genesis Evangelion','Hideaki Anno','New POP','1995-10-04',17),(5,'Orgulho e Preconceito','Jane Austen','pe','1813-01-28',29),(6,'Revolução dos bichos','George Ownell','pe','1985-07-09',14),(7,'O Castelo Andante de Howl','Wynne Jones','HarperCollins','1986-04-25',13),(8,'Sakura Card Captors vol.1','CLAMP','jbc','1996-05-15',15);
/*!40000 ALTER TABLE `livros` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `usuarios`
--

DROP TABLE IF EXISTS `usuarios`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `usuarios` (
  `id` int NOT NULL AUTO_INCREMENT,
  `usuario` varchar(45) COLLATE utf8mb4_unicode_ci NOT NULL,
  `emailu` varchar(110) COLLATE utf8mb4_unicode_ci NOT NULL,
  `numerou` varchar(45) COLLATE utf8mb4_unicode_ci NOT NULL,
  `enderecou` varchar(45) COLLATE utf8mb4_unicode_ci NOT NULL,
  `cidadeu` varchar(45) COLLATE utf8mb4_unicode_ci NOT NULL,
  `cpfu` varchar(45) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=18 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `usuarios`
--

LOCK TABLES `usuarios` WRITE;
/*!40000 ALTER TABLE `usuarios` DISABLE KEYS */;
INSERT INTO `usuarios` VALUES (10,'Tuanne da Frota Augusto','brendatf188@gmail.com','986354033','Rua Manuel Pereira','FORTALEZA ce','08491497308'),(11,'Emanuela Pinto da Frota Sousa','emanuelapfrotas@gmail.com','988448501','Rua Manuel Pereira','FORTALEZA ce','84004324'),(12,'Emanuel Guilherme da Frota da Silva','netunian@gmail.com','1454595958','Rua Manuel Pereira','Fortaleza CE','8595459240'),(13,'Antonio José dos Santos Filho','antoniodoll@gmail.com','4857245052','r.Raquel de Holanda','Fortaleza CE',''),(14,'Heloisa Rocha Menezes','heloo@gmail.com','58734042','rua.Professor Costa Mendes','Fortaleza CE',''),(15,'asukinha','asukinha@penpen','24532653','alemanha rua nein','alemanha ce',''),(16,'Evelyne Pinto Frota Sousa','veve@gmail.com','344541623442','Rua Manuel Pereira','FORTALEZA ce','44576207848'),(17,'Vivencia Pinto da Frota Sousa','vivi@gmail.com','354657633','Rua Manuel Pereira','FORTALEZA','7687675645');
/*!40000 ALTER TABLE `usuarios` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Dumping events for database 'wdaloc'
--

--
-- Dumping routines for database 'wdaloc'
--
/*!40103 SET TIME_ZONE=@OLD_TIME_ZONE */;

/*!40101 SET SQL_MODE=@OLD_SQL_MODE */;
/*!40014 SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS */;
/*!40014 SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
/*!40111 SET SQL_NOTES=@OLD_SQL_NOTES */;

-- Dump completed on 2023-05-10  1:03:45
