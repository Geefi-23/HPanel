-- MySQL dump 10.13  Distrib 8.0.28, for Win64 (x86_64)
--
-- Host: localhost    Database: hpanel
-- ------------------------------------------------------
-- Server version	8.0.28

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
-- Table structure for table `hp_cargos`
--

DROP TABLE IF EXISTS `hp_cargos`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `hp_cargos` (
  `id` int NOT NULL AUTO_INCREMENT,
  `nome` varchar(30) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=52 DEFAULT CHARSET=utf8mb3;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `hp_cargos`
--

LOCK TABLES `hp_cargos` WRITE;
/*!40000 ALTER TABLE `hp_cargos` DISABLE KEYS */;
INSERT INTO `hp_cargos` VALUES (1,'WebMaster'),(3,'Diretor Geral'),(28,'Desenvolvedor'),(29,'Administração Geral'),(30,'Administração de Rádio'),(31,'Administração de Promotoria'),(32,'Administração de Conteúdo'),(33,'Gestão de Campanhas'),(34,'Organização de Eventos'),(35,'Coordenação de Rádio'),(36,'Coordenação de Promotoria'),(37,'Coordenação de Conteúdo'),(38,'Supervisão de Rádio'),(39,'Supervisão de Promotoria'),(40,'Supervisão de Conteúdo'),(41,'Promotoria Oficial'),(42,'Equipe de Apoio'),(43,'Locução'),(44,'Jornalismo'),(45,'Moderação'),(46,'Divulgação'),(47,'Pixel Artista'),(48,'Valorismo'),(49,'Construção'),(50,'Programação de Wireds'),(51,'Promotor');
/*!40000 ALTER TABLE `hp_cargos` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `hp_cargos_permissions`
--

DROP TABLE IF EXISTS `hp_cargos_permissions`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `hp_cargos_permissions` (
  `id` int NOT NULL AUTO_INCREMENT,
  `cargo` int NOT NULL,
  `permission` int NOT NULL,
  PRIMARY KEY (`id`),
  KEY `cargo` (`cargo`),
  KEY `permission` (`permission`),
  CONSTRAINT `hp_cargos_permissions_ibfk_1` FOREIGN KEY (`cargo`) REFERENCES `hp_cargos` (`id`),
  CONSTRAINT `hp_cargos_permissions_ibfk_2` FOREIGN KEY (`permission`) REFERENCES `hp_permissions` (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=128 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `hp_cargos_permissions`
--

LOCK TABLES `hp_cargos_permissions` WRITE;
/*!40000 ALTER TABLE `hp_cargos_permissions` DISABLE KEYS */;
INSERT INTO `hp_cargos_permissions` VALUES (1,3,1),(20,1,3),(22,3,5),(23,1,4),(25,1,5),(27,1,6),(30,1,7),(33,1,8),(35,1,9),(36,1,10),(37,3,6),(38,3,10),(39,3,8),(40,3,4),(41,3,3),(42,3,2),(43,3,9),(44,3,7),(53,28,1),(54,28,2),(55,28,3),(56,28,4),(57,28,6),(58,28,5),(59,28,7),(60,28,8),(61,28,9),(62,28,10),(63,1,2),(64,1,1),(65,29,1),(66,29,2),(67,29,3),(69,29,5),(70,29,7),(71,29,6),(72,29,8),(73,29,9),(74,29,10),(75,29,4),(76,30,6),(77,30,7),(78,30,2),(79,31,2),(80,32,1),(81,32,2),(82,32,5),(83,32,9),(84,32,8),(85,32,10),(86,33,2),(87,34,5),(88,34,1),(89,34,2),(90,35,6),(91,35,7),(92,36,2),(93,37,9),(94,37,8),(95,37,1),(96,37,2),(97,37,5),(98,37,10),(99,38,6),(100,38,7),(101,39,2),(102,40,2),(103,40,1),(104,40,5),(105,40,8),(106,40,9),(107,40,10),(108,41,5),(109,42,5),(110,43,6),(111,44,1),(112,44,5),(113,45,1),(114,45,5),(115,45,8),(116,45,10),(117,46,5),(118,47,5),(119,48,9),(120,48,8),(121,49,5),(122,50,5),(123,51,5),(124,29,11),(125,1,11),(126,3,11),(127,28,11);
/*!40000 ALTER TABLE `hp_cargos_permissions` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `hp_compras`
--

DROP TABLE IF EXISTS `hp_compras`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `hp_compras` (
  `id` int NOT NULL AUTO_INCREMENT,
  `id_compravel` int NOT NULL,
  `nome_compravel` varchar(255) NOT NULL,
  `codigo` varchar(255) NOT NULL,
  `discord_usuario` varchar(255) NOT NULL,
  `resolvido` enum('sim','nao') DEFAULT 'nao',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `hp_compras`
--

LOCK TABLES `hp_compras` WRITE;
/*!40000 ALTER TABLE `hp_compras` DISABLE KEYS */;
INSERT INTO `hp_compras` VALUES (1,1,'Bau de madeira','','! Geefi#4242','sim');
/*!40000 ALTER TABLE `hp_compras` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `hp_permissions`
--

DROP TABLE IF EXISTS `hp_permissions`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `hp_permissions` (
  `id` int NOT NULL AUTO_INCREMENT,
  `nome` varchar(60) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=12 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `hp_permissions`
--

LOCK TABLES `hp_permissions` WRITE;
/*!40000 ALTER TABLE `hp_permissions` DISABLE KEYS */;
INSERT INTO `hp_permissions` VALUES (1,'GERENCIAR NOTICIAS'),(2,'GERENCIAR MEMBROS'),(3,'GERENCIAR CARGOS'),(4,'GERENCIAR PERMISSOES'),(5,'GERENCIAR EVENTOS'),(6,'MARCAR HORARIOS'),(7,'GERENCIAR HORARIOS'),(8,'GERENCIAR COMPRAVEIS'),(9,'GERENCIAR VALORES'),(10,'GERENCIAR HABBLETXD HOME'),(11,'GERENCIAR COMPRAS');
/*!40000 ALTER TABLE `hp_permissions` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `hp_radio_horarios`
--

DROP TABLE IF EXISTS `hp_radio_horarios`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `hp_radio_horarios` (
  `id` int NOT NULL AUTO_INCREMENT,
  `comeca` time NOT NULL,
  `termina` time NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=25 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `hp_radio_horarios`
--

LOCK TABLES `hp_radio_horarios` WRITE;
/*!40000 ALTER TABLE `hp_radio_horarios` DISABLE KEYS */;
INSERT INTO `hp_radio_horarios` VALUES (1,'00:00:00','01:00:00'),(2,'01:00:00','02:00:00'),(3,'02:00:00','03:00:00'),(4,'03:00:00','04:00:00'),(5,'04:00:00','05:00:00'),(6,'05:00:00','06:00:00'),(7,'06:00:00','07:00:00'),(8,'07:00:00','08:00:00'),(9,'08:00:00','09:00:00'),(10,'09:00:00','10:00:00'),(11,'10:00:00','11:00:00'),(12,'11:00:00','12:00:00'),(13,'12:00:00','13:00:00'),(14,'13:00:00','14:00:00'),(15,'14:00:00','15:00:00'),(16,'15:00:00','16:00:00'),(17,'16:00:00','17:00:00'),(18,'17:00:00','18:00:00'),(19,'18:00:00','19:00:00'),(20,'19:00:00','20:00:00'),(21,'20:00:00','21:00:00'),(22,'21:00:00','22:00:00'),(23,'22:00:00','23:00:00'),(24,'23:00:00','00:00:00');
/*!40000 ALTER TABLE `hp_radio_horarios` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `hp_radio_horarios_marcados`
--

DROP TABLE IF EXISTS `hp_radio_horarios_marcados`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `hp_radio_horarios_marcados` (
  `id` int NOT NULL AUTO_INCREMENT,
  `usuario` varchar(255) NOT NULL DEFAULT '',
  `horario` int NOT NULL,
  `dia` date NOT NULL DEFAULT '0000-00-00',
  PRIMARY KEY (`id`),
  KEY `fk_horario` (`horario`),
  CONSTRAINT `fk_horario` FOREIGN KEY (`horario`) REFERENCES `hp_radio_horarios` (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=56 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `hp_radio_horarios_marcados`
--

LOCK TABLES `hp_radio_horarios_marcados` WRITE;
/*!40000 ALTER TABLE `hp_radio_horarios_marcados` DISABLE KEYS */;
INSERT INTO `hp_radio_horarios_marcados` VALUES (32,'Ale',3,'2022-07-12'),(33,'Ale',4,'2022-07-12'),(34,'Ale',5,'2022-07-12'),(35,'Ale',6,'2022-07-12'),(36,'Ale',7,'2022-07-12'),(37,'Ale',8,'2022-07-12'),(38,'Ale',9,'2022-07-12'),(39,'Ale',10,'2022-07-12'),(40,'Ale',11,'2022-07-12'),(41,'Ale',12,'2022-07-12'),(42,'Ale',13,'2022-07-12'),(43,'Ale',14,'2022-07-12'),(44,'Ale',15,'2022-07-12'),(45,'Ale',16,'2022-07-12'),(46,'Ale',17,'2022-07-12'),(47,'Ale',23,'2022-07-12'),(48,'Ale',22,'2022-07-12'),(49,'Ale',21,'2022-07-12'),(50,'Ale',24,'2022-07-12'),(51,'Ale',20,'2022-07-12'),(52,'Ale',19,'2022-07-12'),(53,'Ale',18,'2022-07-12'),(54,'Ale',1,'2022-07-12'),(55,'Ale',2,'2022-07-12');
/*!40000 ALTER TABLE `hp_radio_horarios_marcados` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `hp_users`
--

DROP TABLE IF EXISTS `hp_users`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `hp_users` (
  `id` bigint NOT NULL AUTO_INCREMENT,
  `nome` varchar(30) NOT NULL,
  `senha` varchar(40) DEFAULT NULL,
  `cargo` int NOT NULL,
  `ultimo_login` int DEFAULT NULL,
  `ultimo_ip` varchar(255) DEFAULT NULL,
  `email` varchar(255) DEFAULT NULL,
  `facebook` varchar(255) DEFAULT NULL,
  `twitter` varchar(255) DEFAULT NULL,
  `discord` varchar(255) DEFAULT NULL,
  `ativo` enum('sim','nao') NOT NULL,
  PRIMARY KEY (`id`),
  KEY `fk_cargo` (`cargo`),
  CONSTRAINT `fk_cargo` FOREIGN KEY (`cargo`) REFERENCES `hp_cargos` (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=82 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `hp_users`
--

LOCK TABLES `hp_users` WRITE;
/*!40000 ALTER TABLE `hp_users` DISABLE KEYS */;
INSERT INTO `hp_users` VALUES (13,'Indio','b6c4ecfe0c87245ee209c9d1a09',28,1657222547,'170.246.187.217','','','','','sim'),(28,'Geefi','7b2caeb4818be89f233a412b354',28,1657759989,'::1',NULL,'geefi','@LilPombo','469135204313989131','sim'),(29,'Faretta','69255d0f4c480e8a6d20645c06e',1,1657674691,'152.255.101.242',NULL,'','https://twitter.com/habfreddie','freddie#0001','sim'),(31,'IngridWillians','7dbf0fa09e8969978317dca12e8',1,NULL,NULL,NULL,NULL,NULL,NULL,'sim'),(32,'Lordh','aff661c3198a716686b83d11975',1,NULL,NULL,NULL,NULL,NULL,NULL,'sim'),(33,'Izis','aff661c3198a716686b83d11975',1,NULL,NULL,NULL,NULL,NULL,NULL,'sim'),(34,'Ale','aff661c3198a716686b83d11975',3,1657678199,'201.71.170.141',NULL,'','alebletbr','!Ale#6909','sim'),(35,'Podolatra','5b83a4997e74df15e2be7b7a53f',29,1657565476,'177.0.3.117',NULL,'','@PodolatraHbb','','sim'),(36,'netolampiao','865944d562d05bb9e6e9e6ebbb0',30,NULL,NULL,NULL,NULL,NULL,NULL,'sim'),(37,'Awq','865944d562d05bb9e6e9e6ebbb0',33,NULL,NULL,NULL,NULL,NULL,NULL,'sim'),(38,'Ruiva','865944d562d05bb9e6e9e6ebbb0',40,NULL,NULL,NULL,NULL,NULL,NULL,'sim'),(39,'Maiure','865944d562d05bb9e6e9e6ebbb0',36,NULL,NULL,NULL,NULL,NULL,NULL,'sim'),(40,'PazNaBatata','865944d562d05bb9e6e9e6ebbb0',39,NULL,NULL,NULL,NULL,NULL,NULL,'sim'),(41,'7Lucas','865944d562d05bb9e6e9e6ebbb0',41,NULL,NULL,NULL,NULL,NULL,NULL,'sim'),(42,'foreign','865944d562d05bb9e6e9e6ebbb0',41,NULL,NULL,NULL,NULL,NULL,NULL,'sim'),(43,'Ruivinha','865944d562d05bb9e6e9e6ebbb0',41,NULL,NULL,NULL,NULL,NULL,NULL,'sim'),(44,'amyrbrasil','865944d562d05bb9e6e9e6ebbb0',42,NULL,NULL,NULL,NULL,NULL,NULL,'sim'),(45,'Clarinha1998','865944d562d05bb9e6e9e6ebbb0',42,NULL,NULL,NULL,NULL,NULL,NULL,'sim'),(46,'Mainev','865944d562d05bb9e6e9e6ebbb0',47,NULL,NULL,NULL,NULL,NULL,NULL,'sim'),(47,'AkiraLol','865944d562d05bb9e6e9e6ebbb0',43,NULL,NULL,NULL,NULL,NULL,NULL,'sim'),(48,'Bloos','865944d562d05bb9e6e9e6ebbb0',43,NULL,NULL,NULL,NULL,NULL,NULL,'sim'),(49,'Claudiah','865944d562d05bb9e6e9e6ebbb0',43,NULL,NULL,NULL,NULL,NULL,NULL,'sim'),(50,'DJ4Lasanhass','865944d562d05bb9e6e9e6ebbb0',43,NULL,NULL,NULL,NULL,NULL,NULL,'sim'),(51,'Liso','865944d562d05bb9e6e9e6ebbb0',43,NULL,NULL,NULL,NULL,NULL,NULL,'sim'),(52,'DjBigode','865944d562d05bb9e6e9e6ebbb0',43,NULL,NULL,NULL,NULL,NULL,NULL,'sim'),(53,'Interativo','865944d562d05bb9e6e9e6ebbb0',43,NULL,NULL,NULL,NULL,NULL,NULL,'sim'),(54,'KennedG','865944d562d05bb9e6e9e6ebbb0',43,NULL,NULL,NULL,NULL,NULL,NULL,'sim'),(55,'LakaOreoh','865944d562d05bb9e6e9e6ebbb0',43,NULL,NULL,NULL,NULL,NULL,NULL,'sim'),(56,'LookoBan','865944d562d05bb9e6e9e6ebbb0',43,NULL,NULL,NULL,NULL,NULL,NULL,'sim'),(57,'Medusaa7','865944d562d05bb9e6e9e6ebbb0',43,NULL,NULL,NULL,NULL,NULL,NULL,'sim'),(58,'Megatox','865944d562d05bb9e6e9e6ebbb0',43,NULL,NULL,NULL,NULL,NULL,NULL,'sim'),(59,'Mekinino','865944d562d05bb9e6e9e6ebbb0',43,NULL,NULL,NULL,NULL,NULL,NULL,'sim'),(60,'Moouts','865944d562d05bb9e6e9e6ebbb0',43,NULL,NULL,NULL,NULL,NULL,NULL,'sim'),(61,'nathan9391','865944d562d05bb9e6e9e6ebbb0',43,NULL,NULL,NULL,NULL,NULL,NULL,'sim'),(62,'riquesan321','865944d562d05bb9e6e9e6ebbb0',43,NULL,NULL,NULL,NULL,NULL,NULL,'sim'),(63,'Triled','865944d562d05bb9e6e9e6ebbb0',43,NULL,NULL,NULL,NULL,NULL,NULL,'sim'),(64,'Yuxia','865944d562d05bb9e6e9e6ebbb0',43,NULL,NULL,NULL,NULL,NULL,NULL,'sim'),(65,'Zpekenino','865944d562d05bb9e6e9e6ebbb0',43,NULL,NULL,NULL,NULL,NULL,NULL,'sim'),(66,'yMusqyy','865944d562d05bb9e6e9e6ebbb0',46,NULL,NULL,NULL,NULL,NULL,NULL,'sim'),(67,'Angelicat','865944d562d05bb9e6e9e6ebbb0',51,NULL,NULL,NULL,NULL,NULL,NULL,'sim'),(68,'Coraw','865944d562d05bb9e6e9e6ebbb0',51,NULL,NULL,NULL,NULL,NULL,NULL,'sim'),(69,'eenrico','865944d562d05bb9e6e9e6ebbb0',51,NULL,NULL,NULL,NULL,NULL,NULL,'sim'),(70,'joaovitorf22','865944d562d05bb9e6e9e6ebbb0',51,NULL,NULL,NULL,NULL,NULL,NULL,'sim'),(71,'Ichiso','865944d562d05bb9e6e9e6ebbb0',49,NULL,NULL,NULL,NULL,NULL,NULL,'sim'),(72,'kaspar9','865944d562d05bb9e6e9e6ebbb0',49,NULL,NULL,NULL,NULL,NULL,NULL,'sim'),(73,'NeNeDonuts','865944d562d05bb9e6e9e6ebbb0',49,NULL,NULL,NULL,NULL,NULL,NULL,'sim'),(74,'TrinityBrown','865944d562d05bb9e6e9e6ebbb0',49,NULL,NULL,NULL,NULL,NULL,NULL,'sim'),(75,'Whata','865944d562d05bb9e6e9e6ebbb0',49,NULL,NULL,NULL,NULL,NULL,NULL,'sim'),(76,'SarahAlexandra','865944d562d05bb9e6e9e6ebbb0',50,NULL,NULL,NULL,NULL,NULL,NULL,'sim'),(77,'Brvni','865944d562d05bb9e6e9e6ebbb0',50,NULL,NULL,NULL,NULL,NULL,NULL,'sim'),(78,'fawlklore','865944d562d05bb9e6e9e6ebbb0',50,NULL,NULL,NULL,NULL,NULL,NULL,'sim'),(79,'Xerox','e9ebce183c57848d8fad75ec8c8',28,1657752951,'186.250.208.227',NULL,'','habxerox','habxerox#0769','sim');
/*!40000 ALTER TABLE `hp_users` ENABLE KEYS */;
UNLOCK TABLES;
/*!40103 SET TIME_ZONE=@OLD_TIME_ZONE */;

/*!40101 SET SQL_MODE=@OLD_SQL_MODE */;
/*!40014 SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS */;
/*!40014 SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
/*!40111 SET SQL_NOTES=@OLD_SQL_NOTES */;

-- Dump completed on 2022-07-14  4:12:16
