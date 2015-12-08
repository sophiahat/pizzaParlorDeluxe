CREATE DATABASE  IF NOT EXISTS `spen7755` /*!40100 DEFAULT CHARACTER SET utf8 */;
USE `spen7755`;
-- MySQL dump 10.13  Distrib 5.6.19, for osx10.7 (i386)
--
-- Host: localhost    Database: spen7755
-- ------------------------------------------------------
-- Server version	5.5.42

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
-- Table structure for table `admins`
--

DROP TABLE IF EXISTS `admins`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `admins` (
  `userID` int(11) NOT NULL AUTO_INCREMENT,
  `login` varchar(25) NOT NULL,
  `firstName` varchar(25) NOT NULL,
  `lastName` varchar(25) NOT NULL,
  `password` varchar(300) NOT NULL DEFAULT 'Noth1ng!',
  `adminLevel` int(11) NOT NULL DEFAULT '2',
  PRIMARY KEY (`userID`)
) ENGINE=InnoDB AUTO_INCREMENT=15 DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `admins`
--

LOCK TABLES `admins` WRITE;
/*!40000 ALTER TABLE `admins` DISABLE KEYS */;
INSERT INTO `admins` VALUES (1,'default','Default','Admin','Noth1ng!',1),(2,'Chris','Chris','Spencer','Bubbaca1!t',1),(3,'Minnie','Minnie','Mouse','Noth1ng!',2),(5,'example','Mr dumster','DumDum','Noth1ng!',2),(6,'money','Money','Penny','JamesBond007*',2),(7,'camper','Happy','Camper','!123456eR',2),(9,'traffic','Traffic','Light','camper1!W',1),(10,'laurie','Laurie','Spencer','Noth1ng!',2),(12,'littleman','Robin','Red','Noth1ng!',2),(14,'sasquatch','Big','Foot','Bubbaca1!t',2);
/*!40000 ALTER TABLE `admins` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `customers`
--

DROP TABLE IF EXISTS `customers`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `customers` (
  `custID` int(11) NOT NULL AUTO_INCREMENT,
  `custFName` varchar(30) NOT NULL,
  `custLName` varchar(30) NOT NULL,
  `custEmail` varchar(100) NOT NULL,
  `custAddress` varchar(30) NOT NULL,
  `custApartment` varchar(15) DEFAULT NULL,
  `custCity` varchar(30) NOT NULL,
  `custState` varchar(30) NOT NULL,
  `custZip` char(10) NOT NULL,
  `custPhone` char(20) NOT NULL,
  PRIMARY KEY (`custID`)
) ENGINE=InnoDB AUTO_INCREMENT=13 DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `customers`
--

LOCK TABLES `customers` WRITE;
/*!40000 ALTER TABLE `customers` DISABLE KEYS */;
INSERT INTO `customers` VALUES (3,'frank','seeberger','fsee@sdf.com','adsf nn street','','cheucville','va','23458','2343453456'),(4,'chris','spencer','chris@chrisspencer.com','7663 n 34th st','','seattle','wa','98103','2045677890'),(9,'Cramwell','Morgenstein','Cmorgenstein@cram.com','345 n tabor st','','seattle','wa','98103','206-988-7896'),(10,'susan','palmer','susanpalmer@susanpalmer.com','879 n young st','','Seattle','wa','98765','206-989-9087'),(11,'Mick','Goodrick','MickeyGoodrickey@goodrick.com','123 boylston ave','','Boston','Ma','02134','234-980-8970'),(12,'Marty ','Feldman','mfeldman@gmail.com','234 n yuour St','','Seattle','WA','98203','206-908-7865');
/*!40000 ALTER TABLE `customers` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `orders`
--

DROP TABLE IF EXISTS `orders`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `orders` (
  `orderID` int(11) NOT NULL AUTO_INCREMENT,
  `dateTimePlaced` datetime NOT NULL,
  `custID` int(11) NOT NULL,
  `pizzaDesc` varchar(255) NOT NULL,
  `priceSub` float NOT NULL,
  `tax` float NOT NULL,
  `priceTotal` float NOT NULL,
  `completed` char(1) NOT NULL DEFAULT 'n',
  `date` date NOT NULL,
  `time` time NOT NULL,
  PRIMARY KEY (`orderID`),
  KEY `custID_FK_idx` (`custID`),
  CONSTRAINT `custID_FK` FOREIGN KEY (`custID`) REFERENCES `customers` (`custID`) ON DELETE NO ACTION ON UPDATE NO ACTION
) ENGINE=InnoDB AUTO_INCREMENT=16 DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `orders`
--

LOCK TABLES `orders` WRITE;
/*!40000 ALTER TABLE `orders` DISABLE KEYS */;
INSERT INTO `orders` VALUES (6,'2015-12-04 11:10:00',4,'20 thin_crust - build_your_own  add - pepperoni - onions - extra_cheese - olives - green_peppers - sundried_tomatoes',23.45,2.11,25.56,'n','2015-12-04','11:10:00'),(7,'2015-12-04 11:15:00',4,'20 thin_crust - build_your_own  add - pepperoni - onions - extra_cheese - olives - green_peppers - sundried_tomatoes',23.45,2.11,25.56,'y','2015-12-04','11:15:00'),(8,'2015-12-04 11:19:00',4,'20 thin_crust - build_your_own  add - pepperoni - onions - extra_cheese - olives - green_peppers - sundried_tomatoes',23.45,2.11,25.56,'n','2015-12-04','11:19:00'),(9,'2015-12-05 23:31:43',4,'20 thin_crust - build_your_own  add - pepperoni - onions - extra_cheese - olives - green_peppers - sundried_tomatoes',23.45,2.11,25.56,'n','2015-12-05','23:31:43'),(10,'2015-12-05 23:32:27',3,'12 deep_dish - meatlover  add - pepperoni - onions - extra_cheese - olives - green_peppers - sundried_tomatoes',16.75,1.51,18.26,'y','2015-12-05','23:32:27'),(11,'2015-12-05 23:34:02',9,'20 deep_dish - build_your_own  add - olives - green_peppers',24.895,2.24,27.13,'n','2015-12-05','23:34:02'),(12,'2015-12-05 23:37:56',10,'16 thin_crust - hawaiian',15.5,1.4,16.9,'n','2015-12-05','23:37:56'),(13,'2015-12-07 00:23:06',11,'20 deep_dish - meatlover',25.85,2.33,28.18,'y','2015-12-07','00:23:06'),(15,'2015-12-07 01:00:46',12,'20 thin_crust - build_your_own  add - olives - sundried_tomatoes',19.25,1.73,20.98,'n','2015-12-07','01:00:46');
/*!40000 ALTER TABLE `orders` ENABLE KEYS */;
UNLOCK TABLES;
/*!40103 SET TIME_ZONE=@OLD_TIME_ZONE */;

/*!40101 SET SQL_MODE=@OLD_SQL_MODE */;
/*!40014 SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS */;
/*!40014 SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
/*!40111 SET SQL_NOTES=@OLD_SQL_NOTES */;

-- Dump completed on 2015-12-06 21:06:52
