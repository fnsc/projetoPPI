CREATE DATABASE  IF NOT EXISTS `projeto_ppi` /*!40100 DEFAULT CHARACTER SET latin1 */;
USE `projeto_ppi`;
-- MySQL dump 10.13  Distrib 5.7.17, for macos10.12 (x86_64)
--
-- Host: 127.0.0.1    Database: projeto_ppi
-- ------------------------------------------------------
-- Server version	5.7.17

/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;
/*!40103 SET @OLD_TIME_ZONE=@@TIME_ZONE */;
/*!40103 SET TIME_ZONE='+00:00' */;
/*!40014 SET @OLD_UNIQUE_CHECKS=@@UNIQUE_CHECKS, UNIQUE_CHECKS=0 */;
/*!40014 SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0 */;
/*!40101 SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='NO_AUTO_VALUE_ON_ZERO' */;
/*!40111 SET @OLD_SQL_NOTES=@@SQL_NOTES, SQL_NOTES=0 */;

--
-- Table structure for table `care`
--

DROP TABLE IF EXISTS `care`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `care` (
  `idCare` int(11) NOT NULL AUTO_INCREMENT,
  `idPet` int(11) NOT NULL,
  `tipo` varchar(45) NOT NULL,
  `descricao` varchar(45) NOT NULL,
  `data` date NOT NULL,
  `status` tinyint(1) NOT NULL DEFAULT '1',
  PRIMARY KEY (`idCare`),
  KEY `carePossuiPet_idx` (`idPet`),
  CONSTRAINT `carePossuiPet` FOREIGN KEY (`idPet`) REFERENCES `pet` (`idPet`) ON DELETE NO ACTION ON UPDATE NO ACTION
) ENGINE=InnoDB AUTO_INCREMENT=24 DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `care`
--

LOCK TABLES `care` WRITE;
/*!40000 ALTER TABLE `care` DISABLE KEYS */;
INSERT INTO `care` VALUES (1,1,'Consultas','Consulta de rotina','2017-06-09',1),(2,1,'Consultas','Vacinas','2017-07-07',1),(3,1,'Vacina','Raiva','2017-04-02',1),(4,1,'Vacina','leshmaniose','2017-06-04',1),(5,1,'Vacina','parvo','2017-06-05',1),(6,2,'banho','banho e tosa','2017-06-05',1),(7,2,'Consultas','Vacina','2017-07-07',1),(8,2,'Consultas','Vacina','2017-07-07',1),(9,8,'teste','testeEvento','2017-06-15',1),(10,5,'Banho','Banho','2017-06-15',1),(11,5,'teste2','teste2','2017-06-15',1),(12,5,'test3','test3','2017-06-15',1),(13,5,'test4','test4','2017-06-15',1),(14,5,'test5','test5','2017-06-11',1),(15,6,'test6','test6','2017-06-11',1),(16,1,'test7','test7','2017-06-11',1),(17,9,'Banho e Tosa','Banho cheirosinho e tosa higiênica','2017-06-17',1),(18,10,'Aula Adestrador','Terceira aula de adestramento','2017-06-12',1),(19,5,'consulta','zxv','2017-06-19',1),(20,5,'Vacina','Anti rabica','2017-06-30',1),(21,12,'Consulta','Normal','2017-06-21',1),(22,12,'Vacina','Anti rabica','2017-06-19',1),(23,5,'asdf','sad','2017-06-22',1);
/*!40000 ALTER TABLE `care` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `pet`
--

DROP TABLE IF EXISTS `pet`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `pet` (
  `idPet` int(11) NOT NULL AUTO_INCREMENT,
  `idUsuario` int(11) NOT NULL,
  `nome` varchar(45) NOT NULL,
  `nascimento` date DEFAULT NULL,
  `tipo` tinyint(4) DEFAULT NULL,
  `raca` varchar(45) NOT NULL,
  `status` tinyint(1) NOT NULL DEFAULT '1',
  PRIMARY KEY (`idPet`),
  KEY `petPossuiDono_idx` (`idUsuario`),
  CONSTRAINT `petPossuiDono` FOREIGN KEY (`idUsuario`) REFERENCES `usuario` (`idUsuario`) ON DELETE NO ACTION ON UPDATE NO ACTION
) ENGINE=InnoDB AUTO_INCREMENT=13 DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `pet`
--

LOCK TABLES `pet` WRITE;
/*!40000 ALTER TABLE `pet` DISABLE KEYS */;
INSERT INTO `pet` VALUES (1,7,'Pirata','2011-06-08',NULL,'Border Collie',1),(2,7,'Cacau','2012-11-23',NULL,'Labrador',1),(3,7,'Yuna','2015-11-23',NULL,'Border Collie',1),(4,7,'Luke','2015-10-15',NULL,'Border Collie',1),(5,1,'Dog','1990-11-07',NULL,'Fila',1),(6,1,'Faísca','1992-07-22',NULL,'Pinscher',1),(7,1,'Nina','2000-12-26',NULL,'Salsicha',1),(8,1,'Buiu','2011-01-23',NULL,'Salsicha',1),(9,2,'Yuna','2015-09-23',NULL,'Border Collie',1),(10,2,'Guspe','2003-01-01',NULL,'Labrador',1),(11,3,'Luke','2015-11-23',NULL,'Border Collie',1),(12,25,'Domus','1986-12-25',NULL,'Vira lata',1);
/*!40000 ALTER TABLE `pet` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `usuario`
--

DROP TABLE IF EXISTS `usuario`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `usuario` (
  `idUsuario` int(11) NOT NULL AUTO_INCREMENT,
  `email` varchar(45) NOT NULL,
  `senha` varchar(45) NOT NULL,
  `status` tinyint(1) NOT NULL DEFAULT '1',
  PRIMARY KEY (`idUsuario`),
  UNIQUE KEY `email_UNIQUE` (`email`)
) ENGINE=InnoDB AUTO_INCREMENT=26 DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `usuario`
--

LOCK TABLES `usuario` WRITE;
/*!40000 ALTER TABLE `usuario` DISABLE KEYS */;
INSERT INTO `usuario` VALUES (1,'gabrieldfc@yahoo.com.br','123',1),(2,'tribiaa@hotmail.com','123',1),(3,'henriqueguedesp@gmail.com','123',1),(4,'brunaPinheiro','123',1),(5,'b@uol.com.br','123',1),(6,'a@uol.com.br','123',1),(7,'8','9',1),(8,'eu@eu.com','123',1),(9,'tu@tu.com','123',1),(10,'3','3',1),(11,'br@br.com','123',1),(12,'zeRuela','123',1),(13,'fulano@fulano.com','123',1),(14,'nos@nos.com','123',1),(15,'mega@mega.com','123',1),(16,'x@c.com','123',1),(17,'h@h.com','123',1),(18,'k@k.com','123',1),(19,'p@p.com','123',1),(20,'i@i.com','123',1),(21,'t@t.com','123',1),(22,'m@m.com','123',1),(23,'n@n.com','123',1),(24,'1','123',1),(25,'natanielsa@gmail.com','123',1);
/*!40000 ALTER TABLE `usuario` ENABLE KEYS */;
UNLOCK TABLES;
/*!40103 SET TIME_ZONE=@OLD_TIME_ZONE */;

/*!40101 SET SQL_MODE=@OLD_SQL_MODE */;
/*!40014 SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS */;
/*!40014 SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
/*!40111 SET SQL_NOTES=@OLD_SQL_NOTES */;

-- Dump completed on 2017-06-26 21:57:51
