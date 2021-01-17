-- MySQL dump 10.13  Distrib 8.0.22, for Linux (x86_64)
--
-- Host: localhost    Database: inventaireG043
-- ------------------------------------------------------
-- Server version	8.0.22-0ubuntu0.20.04.3

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
-- Table structure for table `activite`
--

DROP TABLE IF EXISTS `activite`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `activite` (
  `id_act` int NOT NULL AUTO_INCREMENT,
  `nom_act` varchar(255) NOT NULL,
  `code_act` int NOT NULL,
  `id_cat` int NOT NULL,
  PRIMARY KEY (`code_act`),
  UNIQUE KEY `id_act` (`id_act`),
  KEY `FK_categorieActivite` (`id_cat`),
  CONSTRAINT `FK_categorieActivite` FOREIGN KEY (`id_cat`) REFERENCES `categorie` (`id_cat`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `activite`
--

LOCK TABLES `activite` WRITE;
/*!40000 ALTER TABLE `activite` DISABLE KEYS */;
/*!40000 ALTER TABLE `activite` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `admin`
--

DROP TABLE IF EXISTS `admin`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `admin` (
  `id_ad` int NOT NULL AUTO_INCREMENT,
  `nom_ad` varchar(255) NOT NULL,
  `email_ad` varchar(255) NOT NULL,
  `mot_passe_ad` varchar(255) NOT NULL,
  `id_surc` int NOT NULL,
  PRIMARY KEY (`id_ad`),
  KEY `FK_succursaleAdmin` (`id_surc`),
  CONSTRAINT `FK_succursaleAdmin` FOREIGN KEY (`id_surc`) REFERENCES `succursale` (`id_surc`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `admin`
--

LOCK TABLES `admin` WRITE;
/*!40000 ALTER TABLE `admin` DISABLE KEYS */;
/*!40000 ALTER TABLE `admin` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `categorie`
--

DROP TABLE IF EXISTS `categorie`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `categorie` (
  `id_cat` int NOT NULL AUTO_INCREMENT,
  `nom_cat` varchar(255) NOT NULL,
  PRIMARY KEY (`id_cat`)
) ENGINE=InnoDB AUTO_INCREMENT=5 DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `categorie`
--

LOCK TABLES `categorie` WRITE;
/*!40000 ALTER TABLE `categorie` DISABLE KEYS */;
INSERT INTO `categorie` VALUES (1,'Epicerie'),(2,'Liquide'),(3,'Vivres frais'),(4,'Bazar');
/*!40000 ALTER TABLE `categorie` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `famille`
--

DROP TABLE IF EXISTS `famille`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `famille` (
  `id_fam` int NOT NULL AUTO_INCREMENT,
  `nom` varchar(255) NOT NULL,
  `code_fam` int NOT NULL,
  `code_act` int NOT NULL,
  PRIMARY KEY (`code_fam`),
  UNIQUE KEY `id_fam` (`id_fam`),
  KEY `FK_activiteFamille` (`code_act`),
  CONSTRAINT `FK_activiteFamille` FOREIGN KEY (`code_act`) REFERENCES `activite` (`code_act`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `famille`
--

LOCK TABLES `famille` WRITE;
/*!40000 ALTER TABLE `famille` DISABLE KEYS */;
/*!40000 ALTER TABLE `famille` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `inventaire`
--

DROP TABLE IF EXISTS `inventaire`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `inventaire` (
  `id_in` int NOT NULL AUTO_INCREMENT,
  `date_debut` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `date_fin` datetime DEFAULT CURRENT_TIMESTAMP,
  `gamme` text,
  `fiche_recap` text,
  `id_surc` int NOT NULL,
  `id_ad` int NOT NULL,
  PRIMARY KEY (`id_in`),
  KEY `FK_succursaleInventaire` (`id_surc`),
  KEY `FK_adminInventaire` (`id_ad`),
  CONSTRAINT `FK_adminInventaire` FOREIGN KEY (`id_ad`) REFERENCES `admin` (`id_ad`),
  CONSTRAINT `FK_succursaleInventaire` FOREIGN KEY (`id_surc`) REFERENCES `succursale` (`id_surc`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `inventaire`
--

LOCK TABLES `inventaire` WRITE;
/*!40000 ALTER TABLE `inventaire` DISABLE KEYS */;
/*!40000 ALTER TABLE `inventaire` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `inventoriste`
--

DROP TABLE IF EXISTS `inventoriste`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `inventoriste` (
  `id_inv` int NOT NULL AUTO_INCREMENT,
  `nom_inv` varchar(255) NOT NULL,
  `email_inv` varchar(255) NOT NULL,
  `mot_passe_inv` varchar(255) NOT NULL,
  `id_surc` int NOT NULL,
  `id_cat` int DEFAULT NULL,
  PRIMARY KEY (`id_inv`),
  KEY `FK_succursaleInventoriste` (`id_surc`),
  KEY `FK_categorieInventoriste` (`id_cat`),
  CONSTRAINT `FK_categorieInventoriste` FOREIGN KEY (`id_cat`) REFERENCES `categorie` (`id_cat`),
  CONSTRAINT `FK_succursaleInventoriste` FOREIGN KEY (`id_surc`) REFERENCES `succursale` (`id_surc`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `inventoriste`
--

LOCK TABLES `inventoriste` WRITE;
/*!40000 ALTER TABLE `inventoriste` DISABLE KEYS */;
/*!40000 ALTER TABLE `inventoriste` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `inventoristeInventaire`
--

DROP TABLE IF EXISTS `inventoristeInventaire`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `inventoristeInventaire` (
  `id_inv` int NOT NULL,
  `id_in` int NOT NULL,
  PRIMARY KEY (`id_inv`,`id_in`),
  KEY `FK_inventaireInventoriste` (`id_in`),
  CONSTRAINT `FK_inventaireInventoriste` FOREIGN KEY (`id_in`) REFERENCES `inventaire` (`id_in`) ON UPDATE CASCADE,
  CONSTRAINT `FK_inventoristeInventaire` FOREIGN KEY (`id_inv`) REFERENCES `inventoriste` (`id_inv`) ON UPDATE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `inventoristeInventaire`
--

LOCK TABLES `inventoristeInventaire` WRITE;
/*!40000 ALTER TABLE `inventoristeInventaire` DISABLE KEYS */;
/*!40000 ALTER TABLE `inventoristeInventaire` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `logAdmin`
--

DROP TABLE IF EXISTS `logAdmin`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `logAdmin` (
  `id_log_ad` int NOT NULL,
  `id_ad` int NOT NULL,
  `message_ad` varchar(255) NOT NULL,
  `date_action` datetime DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`id_log_ad`),
  KEY `FK_adminLogAdmin` (`id_ad`),
  CONSTRAINT `FK_adminLogAdmin` FOREIGN KEY (`id_ad`) REFERENCES `admin` (`id_ad`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `logAdmin`
--

LOCK TABLES `logAdmin` WRITE;
/*!40000 ALTER TABLE `logAdmin` DISABLE KEYS */;
/*!40000 ALTER TABLE `logAdmin` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `logInventoriste`
--

DROP TABLE IF EXISTS `logInventoriste`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `logInventoriste` (
  `id_log_inv` int NOT NULL,
  `id_inv` int NOT NULL,
  `message_inv` varchar(255) NOT NULL,
  `date_action` datetime DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`id_log_inv`),
  KEY `FK_inventoristeLogInventoriste` (`id_inv`),
  CONSTRAINT `FK_inventoristeLogInventoriste` FOREIGN KEY (`id_inv`) REFERENCES `inventoriste` (`id_inv`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `logInventoriste`
--

LOCK TABLES `logInventoriste` WRITE;
/*!40000 ALTER TABLE `logInventoriste` DISABLE KEYS */;
/*!40000 ALTER TABLE `logInventoriste` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `produit`
--

DROP TABLE IF EXISTS `produit`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `produit` (
  `id_prod` int NOT NULL AUTO_INCREMENT,
  `folio` int NOT NULL,
  `libelle_prod` varchar(255) NOT NULL,
  `code_fam` int NOT NULL,
  `prix` int NOT NULL,
  `h_gamme` varchar(255) DEFAULT 'G',
  PRIMARY KEY (`folio`),
  UNIQUE KEY `id_prod` (`id_prod`),
  KEY `FK_familleProduit` (`code_fam`),
  CONSTRAINT `FK_familleProduit` FOREIGN KEY (`code_fam`) REFERENCES `famille` (`code_fam`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `produit`
--

LOCK TABLES `produit` WRITE;
/*!40000 ALTER TABLE `produit` DISABLE KEYS */;
/*!40000 ALTER TABLE `produit` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `quantite`
--

DROP TABLE IF EXISTS `quantite`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `quantite` (
  `id_quant` int NOT NULL AUTO_INCREMENT,
  `q_surf` int DEFAULT NULL,
  `q_res` int DEFAULT NULL,
  `s_surf` int DEFAULT NULL,
  `s_res` int DEFAULT NULL,
  `folio` int NOT NULL,
  PRIMARY KEY (`id_quant`),
  KEY `FK_produitQuantite` (`folio`),
  CONSTRAINT `FK_produitQuantite` FOREIGN KEY (`folio`) REFERENCES `produit` (`folio`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `quantite`
--

LOCK TABLES `quantite` WRITE;
/*!40000 ALTER TABLE `quantite` DISABLE KEYS */;
/*!40000 ALTER TABLE `quantite` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `succursale`
--

DROP TABLE IF EXISTS `succursale`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `succursale` (
  `id_surc` int NOT NULL AUTO_INCREMENT,
  `nom_surc` varchar(255) NOT NULL,
  `nom_cecado` varchar(255) NOT NULL,
  `nom_gerant` varchar(255) NOT NULL,
  PRIMARY KEY (`id_surc`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `succursale`
--

LOCK TABLES `succursale` WRITE;
/*!40000 ALTER TABLE `succursale` DISABLE KEYS */;
INSERT INTO `succursale` VALUES (1,'CECADO ADL - AEROPORT','G043','KOLEVI COLLEY GAVA');
/*!40000 ALTER TABLE `succursale` ENABLE KEYS */;
UNLOCK TABLES;
/*!40103 SET TIME_ZONE=@OLD_TIME_ZONE */;

/*!40101 SET SQL_MODE=@OLD_SQL_MODE */;
/*!40014 SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS */;
/*!40014 SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
/*!40111 SET SQL_NOTES=@OLD_SQL_NOTES */;

-- Dump completed on 2021-01-18  0:30:13
