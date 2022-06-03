-- MariaDB dump 10.19  Distrib 10.4.24-MariaDB, for Win64 (AMD64)
--
-- Host: localhost    Database: db_auto_457687
-- ------------------------------------------------------
-- Server version	10.4.24-MariaDB

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
-- Table structure for table `absence`
--

DROP TABLE IF EXISTS `absence`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `absence` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `date_abs` date DEFAULT NULL,
  `nbr_heur` int(11) DEFAULT NULL,
  `user_id` int(11) NOT NULL,
  PRIMARY KEY (`id`),
  KEY `user_id` (`user_id`),
  CONSTRAINT `constraint_user_abs` FOREIGN KEY (`user_id`) REFERENCES `absence` (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `absence`
--

LOCK TABLES `absence` WRITE;
/*!40000 ALTER TABLE `absence` DISABLE KEYS */;
/*!40000 ALTER TABLE `absence` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `administrateur`
--

DROP TABLE IF EXISTS `administrateur`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `administrateur` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `username` varchar(50) DEFAULT NULL,
  `nom` varchar(30) DEFAULT NULL,
  `prenom` varchar(30) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `administrateur`
--

LOCK TABLES `administrateur` WRITE;
/*!40000 ALTER TABLE `administrateur` DISABLE KEYS */;
/*!40000 ALTER TABLE `administrateur` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `assister`
--

DROP TABLE IF EXISTS `assister`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `assister` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `idGroup` int(11) DEFAULT NULL,
  `idSeance` int(11) DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `idSeance` (`idSeance`),
  KEY `idGroup` (`idGroup`),
  CONSTRAINT `constraint_assister_group` FOREIGN KEY (`idGroup`) REFERENCES `groupformation` (`id`),
  CONSTRAINT `constraint_assister_seance` FOREIGN KEY (`idSeance`) REFERENCES `seanceformation` (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `assister`
--

LOCK TABLES `assister` WRITE;
/*!40000 ALTER TABLE `assister` DISABLE KEYS */;
/*!40000 ALTER TABLE `assister` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `candidat`
--

DROP TABLE IF EXISTS `candidat`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `candidat` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `username` varchar(50) DEFAULT NULL,
  `nom_fr` varchar(30) DEFAULT NULL,
  `nom_ar` varchar(30) DEFAULT NULL,
  `prenom_fr` varchar(30) DEFAULT NULL,
  `prenom_ar` varchar(30) DEFAULT NULL,
  `date_naiss` date DEFAULT NULL,
  `lieu_naiss` varchar(30) DEFAULT NULL,
  `ville` varchar(255) DEFAULT NULL,
  `adresse` varchar(255) DEFAULT NULL,
  `sixe` varchar(255) DEFAULT NULL,
  `phone` varchar(20) DEFAULT NULL,
  `cin` varchar(50) DEFAULT NULL,
  `dateInscris` date DEFAULT NULL,
  `dateDebut` date DEFAULT NULL,
  `dateFin` date DEFAULT NULL,
  `nbr_heure_theorique` int(11) DEFAULT NULL,
  `nbr_heure_pratique` int(11) DEFAULT NULL,
  `n_siteMini` int(11) DEFAULT NULL,
  `permisId` int(11) DEFAULT NULL,
  `groupId` int(11) DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `permisId` (`permisId`),
  KEY `groupId` (`groupId`),
  CONSTRAINT `constraint_candidat_group` FOREIGN KEY (`groupId`) REFERENCES `groupformation` (`id`),
  CONSTRAINT `constraint_candidat_permis` FOREIGN KEY (`permisId`) REFERENCES `permis` (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `candidat`
--

LOCK TABLES `candidat` WRITE;
/*!40000 ALTER TABLE `candidat` DISABLE KEYS */;
/*!40000 ALTER TABLE `candidat` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `examen`
--

DROP TABLE IF EXISTS `examen`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `examen` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `typeExamen` int(11) DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `typeExamen` (`typeExamen`),
  CONSTRAINT `constraint_examen_type` FOREIGN KEY (`typeExamen`) REFERENCES `typeexamen` (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `examen`
--

LOCK TABLES `examen` WRITE;
/*!40000 ALTER TABLE `examen` DISABLE KEYS */;
/*!40000 ALTER TABLE `examen` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `groupformation`
--

DROP TABLE IF EXISTS `groupformation`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `groupformation` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `nom` varchar(50) DEFAULT NULL,
  `descriprion` varchar(255) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `groupformation`
--

LOCK TABLES `groupformation` WRITE;
/*!40000 ALTER TABLE `groupformation` DISABLE KEYS */;
/*!40000 ALTER TABLE `groupformation` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `histrorypayiement`
--

DROP TABLE IF EXISTS `histrorypayiement`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `histrorypayiement` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `total` int(11) DEFAULT NULL,
  `totalPayie` int(11) DEFAULT NULL,
  `datePayiement` date DEFAULT NULL,
  `payiementId` int(11) NOT NULL,
  PRIMARY KEY (`id`),
  KEY `payiementId` (`payiementId`),
  CONSTRAINT `constraint_h_pa_pay` FOREIGN KEY (`payiementId`) REFERENCES `payiement` (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `histrorypayiement`
--

LOCK TABLES `histrorypayiement` WRITE;
/*!40000 ALTER TABLE `histrorypayiement` DISABLE KEYS */;
/*!40000 ALTER TABLE `histrorypayiement` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `histroryqcm`
--

DROP TABLE IF EXISTS `histroryqcm`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `histroryqcm` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `resultat` int(11) DEFAULT NULL,
  `condidatId` int(11) DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `condidatId` (`condidatId`),
  CONSTRAINT `constraint_h_qcm_candidat` FOREIGN KEY (`condidatId`) REFERENCES `candidat` (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `histroryqcm`
--

LOCK TABLES `histroryqcm` WRITE;
/*!40000 ALTER TABLE `histroryqcm` DISABLE KEYS */;
/*!40000 ALTER TABLE `histroryqcm` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `moniteur`
--

DROP TABLE IF EXISTS `moniteur`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `moniteur` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `username` varchar(50) DEFAULT NULL,
  `nom` varchar(20) DEFAULT NULL,
  `prenom` varchar(20) DEFAULT NULL,
  `num_cap` varchar(50) DEFAULT NULL,
  `date_cap` date DEFAULT NULL,
  `typeMoniteurId` int(11) DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `date_cap` (`date_cap`),
  KEY `constarint_type_moniteur` (`typeMoniteurId`),
  CONSTRAINT `constarint_type_moniteur` FOREIGN KEY (`typeMoniteurId`) REFERENCES `typemoniteur` (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `moniteur`
--

LOCK TABLES `moniteur` WRITE;
/*!40000 ALTER TABLE `moniteur` DISABLE KEYS */;
/*!40000 ALTER TABLE `moniteur` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `payiement`
--

DROP TABLE IF EXISTS `payiement`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `payiement` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `total` int(11) DEFAULT NULL,
  `totalPayie` int(11) DEFAULT NULL,
  `candidatId` int(11) NOT NULL,
  PRIMARY KEY (`id`),
  KEY `candidatId` (`candidatId`),
  CONSTRAINT `constraint_candidat_payie` FOREIGN KEY (`candidatId`) REFERENCES `candidat` (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `payiement`
--

LOCK TABLES `payiement` WRITE;
/*!40000 ALTER TABLE `payiement` DISABLE KEYS */;
/*!40000 ALTER TABLE `payiement` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `permis`
--

DROP TABLE IF EXISTS `permis`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `permis` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `Categorie` varchar(30) DEFAULT NULL,
  `descriprion` varchar(255) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `permis`
--

LOCK TABLES `permis` WRITE;
/*!40000 ALTER TABLE `permis` DISABLE KEYS */;
/*!40000 ALTER TABLE `permis` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `qcm`
--

DROP TABLE IF EXISTS `qcm`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `qcm` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `qcm`
--

LOCK TABLES `qcm` WRITE;
/*!40000 ALTER TABLE `qcm` DISABLE KEYS */;
/*!40000 ALTER TABLE `qcm` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `resultatexamen`
--

DROP TABLE IF EXISTS `resultatexamen`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `resultatexamen` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `resultatExamen_1` int(11) DEFAULT NULL,
  `resultatExamen_2` int(11) DEFAULT NULL,
  `dateExamen_1` date DEFAULT NULL,
  `dateExamen_2` date DEFAULT NULL,
  `candidatId` int(11) DEFAULT NULL,
  `examenId` int(11) DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `candidatId` (`candidatId`),
  KEY `candidatId_2` (`candidatId`),
  KEY `examenId` (`examenId`),
  CONSTRAINT `consatraint_examen_result` FOREIGN KEY (`examenId`) REFERENCES `examen` (`id`),
  CONSTRAINT `constraint_candidat_result` FOREIGN KEY (`candidatId`) REFERENCES `candidat` (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `resultatexamen`
--

LOCK TABLES `resultatexamen` WRITE;
/*!40000 ALTER TABLE `resultatexamen` DISABLE KEYS */;
/*!40000 ALTER TABLE `resultatexamen` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `role`
--

DROP TABLE IF EXISTS `role`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `role` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `role` varchar(30) DEFAULT NULL,
  `descriprion` varchar(255) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `role`
--

LOCK TABLES `role` WRITE;
/*!40000 ALTER TABLE `role` DISABLE KEYS */;
/*!40000 ALTER TABLE `role` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `seanceformation`
--

DROP TABLE IF EXISTS `seanceformation`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `seanceformation` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `nom` varchar(50) DEFAULT NULL,
  `descriprion` varchar(255) DEFAULT NULL,
  `date_formation` date DEFAULT NULL,
  `typeFormation` int(11) DEFAULT NULL,
  `duree` int(11) DEFAULT NULL,
  `moniteurId` int(11) DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `moniteurId` (`moniteurId`),
  KEY `typeFormation` (`typeFormation`),
  CONSTRAINT `constraint_seance_miniteur` FOREIGN KEY (`moniteurId`) REFERENCES `moniteur` (`id`),
  CONSTRAINT `constraint_typ_formation` FOREIGN KEY (`typeFormation`) REFERENCES `typeformation` (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `seanceformation`
--

LOCK TABLES `seanceformation` WRITE;
/*!40000 ALTER TABLE `seanceformation` DISABLE KEYS */;
/*!40000 ALTER TABLE `seanceformation` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `secretariat`
--

DROP TABLE IF EXISTS `secretariat`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `secretariat` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `username` varchar(50) DEFAULT NULL,
  `nom` varchar(30) DEFAULT NULL,
  `prenom` varchar(30) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `secretariat`
--

LOCK TABLES `secretariat` WRITE;
/*!40000 ALTER TABLE `secretariat` DISABLE KEYS */;
/*!40000 ALTER TABLE `secretariat` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `serie`
--

DROP TABLE IF EXISTS `serie`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `serie` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `serie`
--

LOCK TABLES `serie` WRITE;
/*!40000 ALTER TABLE `serie` DISABLE KEYS */;
/*!40000 ALTER TABLE `serie` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `typeexamen`
--

DROP TABLE IF EXISTS `typeexamen`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `typeexamen` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `type` varchar(30) DEFAULT NULL,
  `descriprion` varchar(255) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `typeexamen`
--

LOCK TABLES `typeexamen` WRITE;
/*!40000 ALTER TABLE `typeexamen` DISABLE KEYS */;
/*!40000 ALTER TABLE `typeexamen` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `typeformation`
--

DROP TABLE IF EXISTS `typeformation`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `typeformation` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `type` varchar(30) DEFAULT NULL,
  `descriprion` varchar(255) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `typeformation`
--

LOCK TABLES `typeformation` WRITE;
/*!40000 ALTER TABLE `typeformation` DISABLE KEYS */;
/*!40000 ALTER TABLE `typeformation` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `typemoniteur`
--

DROP TABLE IF EXISTS `typemoniteur`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `typemoniteur` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `type` varchar(30) DEFAULT NULL,
  `descriprion` varchar(255) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `typemoniteur`
--

LOCK TABLES `typemoniteur` WRITE;
/*!40000 ALTER TABLE `typemoniteur` DISABLE KEYS */;
/*!40000 ALTER TABLE `typemoniteur` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `utilisateur`
--

DROP TABLE IF EXISTS `utilisateur`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `utilisateur` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `username` varchar(50) DEFAULT NULL,
  `password` varchar(255) DEFAULT NULL,
  `roleId` int(11) DEFAULT NULL,
  `status` tinyint(1) DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `roleId` (`roleId`),
  CONSTRAINT `constraint_user_role` FOREIGN KEY (`roleId`) REFERENCES `role` (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `utilisateur`
--

LOCK TABLES `utilisateur` WRITE;
/*!40000 ALTER TABLE `utilisateur` DISABLE KEYS */;
/*!40000 ALTER TABLE `utilisateur` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `vehicule`
--

DROP TABLE IF EXISTS `vehicule`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `vehicule` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `model` varchar(50) DEFAULT NULL,
  `marque` varchar(255) DEFAULT NULL,
  `matricule` varchar(50) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `vehicule`
--

LOCK TABLES `vehicule` WRITE;
/*!40000 ALTER TABLE `vehicule` DISABLE KEYS */;
/*!40000 ALTER TABLE `vehicule` ENABLE KEYS */;
UNLOCK TABLES;
/*!40103 SET TIME_ZONE=@OLD_TIME_ZONE */;

/*!40101 SET SQL_MODE=@OLD_SQL_MODE */;
/*!40014 SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS */;
/*!40014 SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
/*!40111 SET SQL_NOTES=@OLD_SQL_NOTES */;

-- Dump completed on 2022-05-29 15:06:31
