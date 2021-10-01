-- Progettazione Web 
DROP DATABASE if exists compravendi; 
CREATE DATABASE compravendi; 
USE compravendi; 
-- MySQL dump 10.13  Distrib 5.6.20, for Win32 (x86)
--
-- Host: localhost    Database: compravendi
-- ------------------------------------------------------
-- Server version	5.6.20

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
-- Table structure for table `ad`
--

DROP TABLE IF EXISTS `ad`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `ad` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `title` varchar(50) NOT NULL,
  `description` varchar(255) NOT NULL,
  `price` double NOT NULL,
  `photo` varchar(256) DEFAULT NULL,
  `username` varchar(15) DEFAULT NULL,
  `item_region` enum('Piemonte','Valle-dAosta','Lombardia','Trentino-Alto-Adige','Veneto','Friuli-Venezia-Giulia','Liguria','Emilia-Romagna','Toscana','Umbria','Marche','Lazio','Abruzzo','Molise','Campania','Puglia','Basilicata','Calabria','Sicilia','Sardegna') DEFAULT NULL,
  `id_category` int(11) DEFAULT NULL,
  `ad_tstamp` datetime DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`),
  KEY `id_category` (`id_category`),
  KEY `ad_ibfk_1` (`username`),
  CONSTRAINT `ad_ibfk_1` FOREIGN KEY (`username`) REFERENCES `user` (`username`) ON DELETE CASCADE,
  CONSTRAINT `ad_ibfk_2` FOREIGN KEY (`id_category`) REFERENCES `category` (`id_category`)
) ENGINE=InnoDB AUTO_INCREMENT=145 DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `ad`
--

LOCK TABLES `ad` WRITE;
/*!40000 ALTER TABLE `ad` DISABLE KEYS */;
INSERT INTO `ad` VALUES (59,'Dalle porte AND OR N','Autore Paolo Corsini anno 2017 ets edizioni.',15,'../img/ads/spiderman/Dalle porte AND OR NOT al sistema calcolatore/','spiderman','Lazio',13,'2020-11-07 16:55:28'),(67,'Cuccioli border coll','vendo cuccioli border collie con genitori con pedigree\r\n',300,'../img/ads/hulk/Cuccioli border collie/','hulk','Basilicata',10,'2020-11-21 19:38:44'),(95,'ktm 125 exc 2003','ottime condizioni astenersi perditempo',1500,'../img/ads/hulk/ktm 125 exc 2003/','hulk','Lazio',1,'2020-11-28 11:22:45'),(96,'Ford Fiesta 2006','auto non marciante necessita sostituzione cinghia distribuzione, oltre cio condizioni generali discrete',1500,'../img/ads/micki10/Ford Fiesta 2006/','micki10','Liguria',1,'2020-11-28 11:24:18'),(114,'lavatrice candy 6kg','lavatrice candy portata 6kg ottime condizioni classe energetica a+ consumo medio 200kW/annuo',200,'../img/ads/gastone/lavatrice candy 6kg/','gastone','Campania',7,'2020-12-02 11:14:59'),(117,'coprisedili sportivi','coprisedili colore rosso - bianco',30,'../img/ads/archimede/coprisedili sportivi/','archimede','Abruzzo',2,'2020-12-04 17:55:11'),(119,'a1','a1',100,'../img/ads/ironman/a1/','ironman','Umbria',1,'2020-12-04 17:58:57'),(120,'a2','a2',200,'../img/ads/ironman/a2/','ironman','Toscana',1,'2020-12-04 17:59:09'),(121,'a3','a3',300,'../img/ads/ironman/a3/','ironman','Puglia',1,'2020-12-04 17:59:26'),(129,'bici da corsa specialized','bici da corsa ruota 26\" ',1200,'..%2Fimg%2Fads%2Fhulk%2Fbici+da+corsa+specialized%2F','hulk','Sicilia',11,'2020-12-14 16:32:16'),(130,'fotocamera reflex canon 600d','usata pochissime volte, condizioni ottime, in dotazioni due ottiche grandangolari. prezzo trattabile.\r\nvaluto scambio con nikon di pari fascia.',400,'..%2Fimg%2Fads%2Fpippo%2Ffotocamera+reflex+canon+600d%2F','pippo','Puglia',4,'2020-12-28 18:41:18'),(134,'giradischi technics lp1200','vendo giradischi in ottime condizioni,testina sostituita da circa un anno, uso sporadico.\r\nastenersi affaristi e perditempo.',550,'..%2Fimg%2Fads%2Futente%2Fgiradischi+technics+lp1200%2F','utente','Lazio',15,'2021-01-12 11:45:29'),(135,'cuffie apple airpods','vendo cuffie apple airpods per passaggio a modello successivo. tenute molto bene, costo spedizione 5â‚¬ eccetto isole',120,'..%2Fimg%2Fads%2Fmicki10%2Fcuffie+apple+airpods%2F','micki10','Basilicata',5,'2021-01-13 10:57:45'),(137,'FiatAgri 180-90','Ottimo stato di conservazione, totale ore lavoro: 5000\r\nPneumatici sostituiti a ore 3000\r\nAstenersi affaristi e perditempo.',7000,'..%2Fimg%2Fads%2Fgastone%2FFiatAgri+180-90%2F','gastone','Marche',18,'2021-01-13 11:07:26'),(138,'placeholder_gastone','placeholder_gastone',0,'..%2Fimg%2Fads%2Fgastone%2Fplaceholder_gastone%2F','gastone','Sardegna',11,'2021-01-13 11:09:24'),(139,'placeholder_micki10','placeholder_micki10',300,'..%2Fimg%2Fads%2Fmicki10%2Fplaceholder_micki10%2F','micki10','Sicilia',1,'2021-01-13 11:10:24'),(140,'placeholder_archimede','placeholder_archimede',10,'..%2Fimg%2Fads%2Farchimede%2Fplaceholder_archimede%2F','archimede','Molise',2,'2021-01-13 11:11:42'),(141,'placeholder_archimede2','placeholder_archimede2',0,'..%2Fimg%2Fads%2Farchimede%2Fplaceholder_archimede2%2F','archimede','Lombardia',8,'2021-01-13 11:11:55'),(142,'Annuncio di prova','Annuncio di prova',300,'..%2Fimg%2Fads%2Fbatman%2FAnnuncio+di+prova%2F','batman','Lombardia',10,'2021-01-13 11:12:53'),(143,'Cercasi barista','Cercasi barista per nuova apertura di un locale.\r\nper maggiori informazione chiamare al numero\r\n334567498.',1000,'..%2Fimg%2Fads%2Fpaolo%2FCercasi+barista%2F','paolo','Abruzzo',17,'2021-01-13 11:15:53'),(144,'altro1','altro1',800,'..%2Fimg%2Fads%2Fmicki10%2Faltro1%2F','micki10','Lazio',16,'2021-01-13 18:30:50');
/*!40000 ALTER TABLE `ad` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `category`
--

DROP TABLE IF EXISTS `category`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `category` (
  `id_category` int(11) NOT NULL AUTO_INCREMENT,
  `category` varchar(25) NOT NULL,
  PRIMARY KEY (`id_category`)
) ENGINE=InnoDB AUTO_INCREMENT=20 DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `category`
--

LOCK TABLES `category` WRITE;
/*!40000 ALTER TABLE `category` DISABLE KEYS */;
INSERT INTO `category` VALUES (1,'Auto e Moto'),(2,'Accessori Auto e Moto'),(3,'Informatica'),(4,'Fotografia'),(5,'Audio/Video'),(6,'Arredamento'),(7,'Elettrodomestici'),(8,'Abbigliamento'),(9,'Giardino e fai-da-te'),(10,'Animali'),(11,'Biciclette'),(12,'Strumenti Musicali'),(13,'Libri'),(14,'Sport'),(15,'Collezionismo'),(16,'Altro'),(17,'Offerte di Lavoro'),(18,'Macchine Agricole'),(19,'Candidati Lavoro');
/*!40000 ALTER TABLE `category` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `user`
--

DROP TABLE IF EXISTS `user`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `user` (
  `username` varchar(15) NOT NULL,
  `password` varchar(15) NOT NULL,
  `name` varchar(15) NOT NULL,
  `surname` varchar(15) NOT NULL,
  `address` varchar(30) NOT NULL,
  `email` varchar(30) NOT NULL,
  `phone` varchar(10) NOT NULL,
  PRIMARY KEY (`username`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `user`
--

LOCK TABLES `user` WRITE;
/*!40000 ALTER TABLE `user` DISABLE KEYS */;
INSERT INTO `user` VALUES ('archimede','archimede','Archimede','Pitagorigo','','archimede@disney.com',''),('batman','batman','bruce','wayne','Gotham city','batman@dc.com','346576982'),('gastone','gastone','Gastone','Paperone','','gastone@disney.com',''),('hulk','hulk','Hulk','Spacca','marvelinc','hulk@marvel.com','333234123'),('ironman','ironman','Tony','Stark','','ironman@marvel.com',''),('micki10','12345','Michele','Paolinelli','Via Massa e Nazzalla, 1345','micki10@live.it','3465860785'),('paolo','paolo','pablo','neruda','Via Giuseppe Garibaldi','paolo@paolo.it','3201907787'),('paperino','paperino','Paperino','Papero','','paperino@disney.com',''),('paperone','paperone','Zio','Paperone','','paperone@disney.com',''),('pippo','pippo','Pippo','Pluto','via tal dei tali','pippo@pluto.paperino','123345567'),('spiderman','spiderman','Peter','Parker','marvel inc','spiderman@marvel.com','123123123'),('utente','22222','Utente','Nuovo','Corso Como 11, Milano','nuovoutente@utente.it','346580782');
/*!40000 ALTER TABLE `user` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `user_preferences`
--

DROP TABLE IF EXISTS `user_preferences`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `user_preferences` (
  `pkey` int(11) NOT NULL AUTO_INCREMENT,
  `show_phone` tinyint(1) NOT NULL DEFAULT '0',
  `show_address` tinyint(1) NOT NULL DEFAULT '0',
  `username_fk` varchar(15) NOT NULL,
  PRIMARY KEY (`pkey`),
  KEY `user_preferences_ibfk_1` (`username_fk`),
  CONSTRAINT `user_preferences_ibfk_1` FOREIGN KEY (`username_fk`) REFERENCES `user` (`username`) ON DELETE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=30 DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `user_preferences`
--

LOCK TABLES `user_preferences` WRITE;
/*!40000 ALTER TABLE `user_preferences` DISABLE KEYS */;
INSERT INTO `user_preferences` VALUES (1,0,0,'archimede'),(5,0,0,'gastone'),(6,1,0,'hulk'),(7,0,0,'ironman'),(15,0,0,'paolo'),(18,0,0,'paperino'),(19,0,0,'paperone'),(20,0,1,'pippo'),(22,0,0,'spiderman'),(27,1,1,'micki10'),(28,1,1,'utente'),(29,0,0,'batman');
/*!40000 ALTER TABLE `user_preferences` ENABLE KEYS */;
UNLOCK TABLES;
/*!40103 SET TIME_ZONE=@OLD_TIME_ZONE */;

/*!40101 SET SQL_MODE=@OLD_SQL_MODE */;
/*!40014 SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS */;
/*!40014 SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
/*!40111 SET SQL_NOTES=@OLD_SQL_NOTES */;

-- Dump completed on 2021-01-14 10:47:55
