CREATE DATABASE  IF NOT EXISTS `motocarmanbr8` /*!40100 DEFAULT CHARACTER SET latin1 */;
USE `motocarmanbr8`;
-- MySQL dump 10.13  Distrib 5.6.13, for osx10.6 (i386)
--
-- Host: 127.0.0.1    Database: motocarmanbr8
-- ------------------------------------------------------
-- Server version	5.5.34

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
-- Table structure for table `AuthAssignment`
--

DROP TABLE IF EXISTS `AuthAssignment`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `AuthAssignment` (
  `itemname` varchar(64) NOT NULL,
  `userid` varchar(64) NOT NULL,
  `bizrule` text,
  `data` text,
  PRIMARY KEY (`itemname`,`userid`),
  CONSTRAINT `authassignment_ibfk_1` FOREIGN KEY (`itemname`) REFERENCES `AuthItem` (`name`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `AuthAssignment`
--

LOCK TABLES `AuthAssignment` WRITE;
/*!40000 ALTER TABLE `AuthAssignment` DISABLE KEYS */;
INSERT INTO `AuthAssignment` (`itemname`, `userid`, `bizrule`, `data`) VALUES ('admin','1',NULL,'N;'),('Authenticated','4',NULL,'N;'),('dealer','3',NULL,'N;'),('salesperson','2',NULL,'N;'),('Salesperson','5',NULL,'N;'),('Salesperson','6',NULL,'N;'),('Salesperson','7',NULL,'N;');
/*!40000 ALTER TABLE `AuthAssignment` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `AuthItem`
--

DROP TABLE IF EXISTS `AuthItem`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `AuthItem` (
  `name` varchar(64) NOT NULL,
  `type` int(11) NOT NULL,
  `description` text,
  `bizrule` text,
  `data` text,
  PRIMARY KEY (`name`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `AuthItem`
--

LOCK TABLES `AuthItem` WRITE;
/*!40000 ALTER TABLE `AuthItem` DISABLE KEYS */;
INSERT INTO `AuthItem` (`name`, `type`, `description`, `bizrule`, `data`) VALUES ('admin',2,NULL,NULL,'N;'),('Authenticated',2,NULL,NULL,'N;'),('Car.*',1,NULL,NULL,'N;'),('Car.Admin',0,NULL,NULL,'N;'),('Car.Create',0,NULL,NULL,'N;'),('Car.Delete',0,NULL,NULL,'N;'),('Car.Index',0,NULL,NULL,'N;'),('Car.Update',0,NULL,NULL,'N;'),('Car.View',0,NULL,NULL,'N;'),('Deal.*',1,NULL,NULL,'N;'),('Deal.Admin',0,NULL,NULL,'N;'),('Deal.Create',0,NULL,NULL,'N;'),('Deal.Delete',0,NULL,NULL,'N;'),('Deal.Index',0,NULL,NULL,'N;'),('Deal.Update',0,NULL,NULL,'N;'),('Deal.View',0,NULL,NULL,'N;'),('dealer',2,'Dealer',NULL,'N;'),('Dealership.*',1,NULL,NULL,'N;'),('Dealership.Admin',0,NULL,NULL,'N;'),('Dealership.Create',0,NULL,NULL,'N;'),('Dealership.Delete',0,NULL,NULL,'N;'),('Dealership.Index',0,NULL,NULL,'N;'),('Dealership.Update',0,NULL,NULL,'N;'),('Dealership.View',0,NULL,NULL,'N;'),('DealHistory.*',1,NULL,NULL,'N;'),('DealHistory.Admin',0,NULL,NULL,'N;'),('DealHistory.Create',0,NULL,NULL,'N;'),('DealHistory.Delete',0,NULL,NULL,'N;'),('DealHistory.Index',0,NULL,NULL,'N;'),('DealHistory.Update',0,NULL,NULL,'N;'),('DealHistory.View',0,NULL,NULL,'N;'),('DealStatus.*',1,NULL,NULL,'N;'),('DealStatus.Admin',0,NULL,NULL,'N;'),('DealStatus.Create',0,NULL,NULL,'N;'),('DealStatus.Delete',0,NULL,NULL,'N;'),('DealStatus.Index',0,NULL,NULL,'N;'),('DealStatus.Update',0,NULL,NULL,'N;'),('DealStatus.View',0,NULL,NULL,'N;'),('Guest',2,NULL,NULL,'N;'),('Message.Compose.*',1,NULL,NULL,'N;'),('Message.Compose.Compose',0,NULL,NULL,'N;'),('Message.Delete.*',1,NULL,NULL,'N;'),('Message.Delete.Delete',0,NULL,NULL,'N;'),('Message.Inbox.*',1,NULL,NULL,'N;'),('Message.Inbox.Inbox',0,NULL,NULL,'N;'),('Message.Sent.*',1,NULL,NULL,'N;'),('Message.Sent.Sent',0,NULL,NULL,'N;'),('Message.Suggest.*',1,NULL,NULL,'N;'),('Message.Suggest.User',0,NULL,NULL,'N;'),('Message.View.*',1,NULL,NULL,'N;'),('Message.View.View',0,NULL,NULL,'N;'),('Salesperson',2,'salesperson',NULL,'N;'),('SalesPerson.*',1,NULL,NULL,'N;'),('SalesPerson.Admin',0,NULL,NULL,'N;'),('SalesPerson.Create',0,NULL,NULL,'N;'),('SalesPerson.Delete',0,NULL,NULL,'N;'),('SalesPerson.Index',0,NULL,NULL,'N;'),('SalesPerson.Update',0,NULL,NULL,'N;'),('SalesPerson.View',0,NULL,NULL,'N;'),('SavedCars.*',1,NULL,NULL,'N;'),('SavedCars.Admin',0,NULL,NULL,'N;'),('SavedCars.Create',0,NULL,NULL,'N;'),('SavedCars.Delete',0,NULL,NULL,'N;'),('SavedCars.Index',0,NULL,NULL,'N;'),('SavedCars.Update',0,NULL,NULL,'N;'),('SavedCars.View',0,NULL,NULL,'N;'),('SearchHistory.*',1,NULL,NULL,'N;'),('SearchHistory.Admin',0,NULL,NULL,'N;'),('SearchHistory.Create',0,NULL,NULL,'N;'),('SearchHistory.Delete',0,NULL,NULL,'N;'),('SearchHistory.Index',0,NULL,NULL,'N;'),('SearchHistory.Update',0,NULL,NULL,'N;'),('SearchHistory.View',0,NULL,NULL,'N;'),('Site.*',1,NULL,NULL,'N;'),('Site.Contact',0,NULL,NULL,'N;'),('Site.Error',0,NULL,NULL,'N;'),('Site.Index',0,NULL,NULL,'N;'),('Site.Login',0,NULL,NULL,'N;'),('Site.Logout',0,NULL,NULL,'N;'),('User.*',1,NULL,NULL,'N;'),('User.Activation.*',1,NULL,NULL,'N;'),('User.Activation.Activation',0,NULL,NULL,'N;'),('User.Admin',0,NULL,NULL,'N;'),('User.Admin.*',1,NULL,NULL,'N;'),('User.Admin.Admin',0,NULL,NULL,'N;'),('User.Admin.Create',0,NULL,NULL,'N;'),('User.Admin.Delete',0,NULL,NULL,'N;'),('User.Admin.Update',0,NULL,NULL,'N;'),('User.Admin.View',0,NULL,NULL,'N;'),('User.Create',0,NULL,NULL,'N;'),('User.Default.*',1,NULL,NULL,'N;'),('User.Default.Index',0,NULL,NULL,'N;'),('User.Delete',0,NULL,NULL,'N;'),('User.Index',0,NULL,NULL,'N;'),('User.Login.*',1,NULL,NULL,'N;'),('User.Login.Login',0,NULL,NULL,'N;'),('User.Logout.*',1,NULL,NULL,'N;'),('User.Logout.Logout',0,NULL,NULL,'N;'),('User.Profile.*',1,NULL,NULL,'N;'),('User.Profile.Changepassword',0,NULL,NULL,'N;'),('User.Profile.Edit',0,NULL,NULL,'N;'),('User.Profile.Profile',0,NULL,NULL,'N;'),('User.ProfileField.*',1,NULL,NULL,'N;'),('User.ProfileField.Admin',0,NULL,NULL,'N;'),('User.ProfileField.Create',0,NULL,NULL,'N;'),('User.ProfileField.Delete',0,NULL,NULL,'N;'),('User.ProfileField.Update',0,NULL,NULL,'N;'),('User.ProfileField.View',0,NULL,NULL,'N;'),('User.Recovery.*',1,NULL,NULL,'N;'),('User.Recovery.Recovery',0,NULL,NULL,'N;'),('User.Registration.*',1,NULL,NULL,'N;'),('User.Registration.Registration',0,NULL,NULL,'N;'),('User.Update',0,NULL,NULL,'N;'),('User.User.*',1,NULL,NULL,'N;'),('User.User.Index',0,NULL,NULL,'N;'),('User.User.View',0,NULL,NULL,'N;'),('User.View',0,NULL,NULL,'N;');
/*!40000 ALTER TABLE `AuthItem` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `AuthItemChild`
--

DROP TABLE IF EXISTS `AuthItemChild`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `AuthItemChild` (
  `parent` varchar(64) NOT NULL,
  `child` varchar(64) NOT NULL,
  PRIMARY KEY (`parent`,`child`),
  KEY `child` (`child`),
  CONSTRAINT `authitemchild_ibfk_1` FOREIGN KEY (`parent`) REFERENCES `AuthItem` (`name`) ON DELETE CASCADE ON UPDATE CASCADE,
  CONSTRAINT `authitemchild_ibfk_2` FOREIGN KEY (`child`) REFERENCES `AuthItem` (`name`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `AuthItemChild`
--

LOCK TABLES `AuthItemChild` WRITE;
/*!40000 ALTER TABLE `AuthItemChild` DISABLE KEYS */;
INSERT INTO `AuthItemChild` (`parent`, `child`) VALUES ('Guest','Car.*'),('Guest','Car.Admin'),('Guest','Car.Create'),('Guest','Car.Delete'),('Guest','Car.Index'),('Guest','Car.Update'),('Guest','Car.View'),('Guest','Deal.*'),('Guest','Deal.Admin'),('Guest','Deal.Create'),('Guest','Deal.Delete'),('Guest','Deal.Index'),('Guest','Deal.Update'),('Guest','Deal.View'),('Guest','Dealership.*'),('Guest','Dealership.Admin'),('Guest','Dealership.Create'),('Guest','Dealership.Delete'),('Guest','Dealership.Index'),('Guest','Dealership.Update'),('Guest','Dealership.View'),('Guest','DealHistory.*'),('Guest','DealHistory.Admin'),('Guest','DealHistory.Create'),('Guest','DealHistory.Delete'),('Guest','DealHistory.Index'),('Guest','DealHistory.Update'),('Guest','DealHistory.View'),('Guest','DealStatus.*'),('Guest','DealStatus.Admin'),('Guest','DealStatus.Create'),('Guest','DealStatus.Delete'),('Guest','DealStatus.Index'),('Guest','DealStatus.Update'),('Guest','DealStatus.View'),('Guest','Message.Compose.*'),('Guest','Message.Compose.Compose'),('Guest','Message.Delete.*'),('Guest','Message.Delete.Delete'),('Guest','Message.Inbox.*'),('Guest','Message.Inbox.Inbox'),('Guest','Message.Sent.*'),('Guest','Message.Sent.Sent'),('Guest','Message.Suggest.*'),('Guest','Message.Suggest.User'),('Guest','Message.View.*'),('Guest','Message.View.View'),('Guest','SalesPerson.*'),('Guest','SalesPerson.Admin'),('Guest','SalesPerson.Create'),('Guest','SalesPerson.Delete'),('Guest','SalesPerson.Index'),('Guest','SalesPerson.Update'),('Guest','SalesPerson.View'),('Guest','SavedCars.*'),('Guest','SavedCars.Admin'),('Guest','SavedCars.Create'),('Guest','SavedCars.Delete'),('Guest','SavedCars.Index'),('Guest','SavedCars.Update'),('Guest','SavedCars.View'),('Guest','SearchHistory.*'),('Guest','SearchHistory.Admin'),('Guest','SearchHistory.Create'),('Guest','SearchHistory.Delete'),('Guest','SearchHistory.Index'),('Guest','SearchHistory.Update'),('Guest','SearchHistory.View'),('Guest','Site.*'),('Guest','User.*'),('Guest','User.Activation.*'),('Guest','User.Admin'),('Guest','User.Admin.*'),('Guest','User.Admin.Admin'),('Guest','User.Admin.Create'),('Guest','User.Admin.Delete'),('Guest','User.Admin.Update'),('Guest','User.Admin.View'),('Guest','User.Create'),('Guest','User.Default.*'),('Guest','User.Delete'),('Guest','User.Profile.*'),('Guest','User.ProfileField.*'),('Guest','User.Recovery.*'),('Guest','User.Registration.*'),('Guest','User.User.*');
/*!40000 ALTER TABLE `AuthItemChild` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `Car`
--

DROP TABLE IF EXISTS `Car`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `Car` (
  `ID` int(11) NOT NULL AUTO_INCREMENT,
  `StyleID` varchar(100) DEFAULT NULL,
  `Price` varchar(100) DEFAULT NULL,
  `Make` varchar(45) DEFAULT NULL,
  `Model` varchar(45) DEFAULT NULL,
  `Year` varchar(45) DEFAULT NULL,
  PRIMARY KEY (`ID`),
  UNIQUE KEY `ID_UNIQUE` (`ID`)
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `Car`
--

LOCK TABLES `Car` WRITE;
/*!40000 ALTER TABLE `Car` DISABLE KEYS */;
INSERT INTO `Car` (`ID`, `StyleID`, `Price`, `Make`, `Model`, `Year`) VALUES (1,'1938','21000','BMW','3 Series','2013'),(2,'1111','39000','Audi','Q7','2014');
/*!40000 ALTER TABLE `Car` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `Deal`
--

DROP TABLE IF EXISTS `Deal`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `Deal` (
  `ID` int(11) NOT NULL AUTO_INCREMENT COMMENT 'ID',
  `Car_ID` int(11) NOT NULL,
  `DealStatus_ID` int(11) NOT NULL,
  `SalesPerson_ID` int(11) NOT NULL,
  `User_ID` int(11) NOT NULL,
  `Price` varchar(45) DEFAULT NULL,
  `DateAdded` datetime DEFAULT NULL,
  `LastModified` datetime DEFAULT NULL,
  `Dealership_ID` int(11) NOT NULL,
  PRIMARY KEY (`ID`),
  UNIQUE KEY `ID_UNIQUE` (`ID`),
  KEY `Car_ID_idx` (`Car_ID`),
  KEY `DealStatus_ID_idx` (`DealStatus_ID`),
  KEY `SalesPerson_ID_idx` (`SalesPerson_ID`),
  KEY `User_ID_idx` (`User_ID`),
  KEY `FK_Dealership_Deal_idx` (`Dealership_ID`),
  CONSTRAINT `FK_Car_Deal` FOREIGN KEY (`Car_ID`) REFERENCES `Car` (`ID`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  CONSTRAINT `FK_DealStatus_Deal` FOREIGN KEY (`DealStatus_ID`) REFERENCES `DealStatus` (`ID`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  CONSTRAINT `FK_SalesPerson_Deal` FOREIGN KEY (`SalesPerson_ID`) REFERENCES `SalesPerson` (`ID`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  CONSTRAINT `FK_Users_Deal` FOREIGN KEY (`User_ID`) REFERENCES `tbl_users` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION
) ENGINE=InnoDB AUTO_INCREMENT=5 DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `Deal`
--

LOCK TABLES `Deal` WRITE;
/*!40000 ALTER TABLE `Deal` DISABLE KEYS */;
INSERT INTO `Deal` (`ID`, `Car_ID`, `DealStatus_ID`, `SalesPerson_ID`, `User_ID`, `Price`, `DateAdded`, `LastModified`, `Dealership_ID`) VALUES (1,1,1,1,5,'39993','2014-02-02 00:00:00','2014-02-02 00:00:00',2),(4,2,3,1,4,'55443','2014-02-02 00:00:00','2014-02-02 00:00:00',1);
/*!40000 ALTER TABLE `Deal` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `DealHistory`
--

DROP TABLE IF EXISTS `DealHistory`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `DealHistory` (
  `ID` int(11) NOT NULL AUTO_INCREMENT,
  `Car_ID` int(11) DEFAULT NULL,
  `Deal_ID` int(11) NOT NULL,
  `DealStatus_ID` int(11) DEFAULT NULL,
  `SalesPerson_ID` int(11) DEFAULT NULL,
  `User_ID` int(11) DEFAULT NULL,
  `DealStatus` varchar(45) DEFAULT NULL,
  `Make` varchar(45) DEFAULT NULL,
  `Model` varchar(45) DEFAULT NULL,
  `Price` varchar(45) DEFAULT NULL,
  `SalesPersonUserName` varchar(45) DEFAULT NULL,
  `StyleID` varchar(45) DEFAULT NULL,
  `Year` varchar(45) DEFAULT NULL,
  `UserName` varchar(45) DEFAULT NULL,
  PRIMARY KEY (`ID`),
  UNIQUE KEY `ID_UNIQUE` (`ID`),
  KEY `Deal_ID_idx` (`Deal_ID`),
  KEY `FK_Car_DealHistory_idx` (`Car_ID`),
  KEY `FK_DealStatus_DealHistory_idx` (`DealStatus_ID`),
  KEY `FK_SalesPerson_DealHistory_idx` (`SalesPerson_ID`),
  KEY `FK_Users_DealHistory_idx` (`User_ID`),
  CONSTRAINT `FK_Car_DealHistory` FOREIGN KEY (`Car_ID`) REFERENCES `Car` (`ID`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  CONSTRAINT `FK_DealStatus_DealHistory` FOREIGN KEY (`DealStatus_ID`) REFERENCES `DealStatus` (`ID`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  CONSTRAINT `FK_Deal_DealHistory` FOREIGN KEY (`Deal_ID`) REFERENCES `Deal` (`ID`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  CONSTRAINT `FK_SalesPerson_DealHistory` FOREIGN KEY (`SalesPerson_ID`) REFERENCES `SalesPerson` (`ID`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  CONSTRAINT `FK_Users_DealHistory` FOREIGN KEY (`User_ID`) REFERENCES `tbl_users` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `DealHistory`
--

LOCK TABLES `DealHistory` WRITE;
/*!40000 ALTER TABLE `DealHistory` DISABLE KEYS */;
INSERT INTO `DealHistory` (`ID`, `Car_ID`, `Deal_ID`, `DealStatus_ID`, `SalesPerson_ID`, `User_ID`, `DealStatus`, `Make`, `Model`, `Price`, `SalesPersonUserName`, `StyleID`, `Year`, `UserName`) VALUES (1,1,1,1,1,1,'lkl','lljlkj','lklkj','090909','kjhk','kjhj','kjhkj','kjhhk');
/*!40000 ALTER TABLE `DealHistory` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `DealStatus`
--

DROP TABLE IF EXISTS `DealStatus`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `DealStatus` (
  `ID` int(11) NOT NULL AUTO_INCREMENT,
  `DealStatus` varchar(45) DEFAULT NULL,
  PRIMARY KEY (`ID`),
  UNIQUE KEY `ID_UNIQUE` (`ID`)
) ENGINE=InnoDB AUTO_INCREMENT=5 DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `DealStatus`
--

LOCK TABLES `DealStatus` WRITE;
/*!40000 ALTER TABLE `DealStatus` DISABLE KEYS */;
INSERT INTO `DealStatus` (`ID`, `DealStatus`) VALUES (1,'Accepted'),(2,'Rejected'),(3,'Pending'),(4,'Compared');
/*!40000 ALTER TABLE `DealStatus` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `Dealership`
--

DROP TABLE IF EXISTS `Dealership`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `Dealership` (
  `ID` int(11) NOT NULL AUTO_INCREMENT,
  `User_ID` int(11) NOT NULL,
  `Name` varchar(255) DEFAULT NULL,
  `Address` varchar(1000) DEFAULT NULL,
  `Email` varchar(100) DEFAULT NULL,
  `WorkPhone` varchar(15) DEFAULT NULL,
  `WorkPhone2` varchar(15) DEFAULT NULL,
  `Fax` varchar(15) DEFAULT NULL,
  `Website` varchar(50) DEFAULT NULL,
  `Description` varchar(500) DEFAULT NULL,
  `Active` bit(1) DEFAULT NULL,
  `Photo` longblob,
  `DateAdded` datetime DEFAULT NULL,
  PRIMARY KEY (`ID`),
  KEY `User_ID_idx` (`User_ID`),
  CONSTRAINT `FK_Users_Dealership` FOREIGN KEY (`User_ID`) REFERENCES `tbl_users` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `Dealership`
--

LOCK TABLES `Dealership` WRITE;
/*!40000 ALTER TABLE `Dealership` DISABLE KEYS */;
INSERT INTO `Dealership` (`ID`, `User_ID`, `Name`, `Address`, `Email`, `WorkPhone`, `WorkPhone2`, `Fax`, `Website`, `Description`, `Active`, `Photo`, `DateAdded`) VALUES (1,3,'Toyota of Berkeley','1242 Shattuck Ave Berkeley CA 94706','toyota@toyotaofberkeley.com','987-282-9292','987-282-9293','987-282-9294','www.toyotaofberkeley.com','This is Toyota Dealership in Berkeley.','','','2012-01-01 00:00:00'),(2,2,'Toyota of Richmond','999 Richmond Ave Richmond CA 94777','toyota@toyotaofrichmond.com','971-989-9999','971-989-9998','971-989-9997','www.toyotaofrichmond.com','This is Toyota Dealership in Richmond.','','','2012-01-01 00:00:00');
/*!40000 ALTER TABLE `Dealership` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `Rights`
--

DROP TABLE IF EXISTS `Rights`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `Rights` (
  `itemname` varchar(64) NOT NULL,
  `type` int(11) NOT NULL,
  `weight` int(11) NOT NULL,
  PRIMARY KEY (`itemname`),
  CONSTRAINT `rights_ibfk_1` FOREIGN KEY (`itemname`) REFERENCES `AuthItem` (`name`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `Rights`
--

LOCK TABLES `Rights` WRITE;
/*!40000 ALTER TABLE `Rights` DISABLE KEYS */;
/*!40000 ALTER TABLE `Rights` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `SalesPerson`
--

DROP TABLE IF EXISTS `SalesPerson`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `SalesPerson` (
  `ID` int(11) NOT NULL AUTO_INCREMENT,
  `Dealership_ID` int(11) NOT NULL,
  `User_ID` int(11) NOT NULL,
  `ContactPhone` varchar(45) DEFAULT NULL,
  `Email` varchar(45) DEFAULT NULL,
  `Description` varchar(500) DEFAULT NULL,
  `DateAdded` datetime DEFAULT NULL,
  `Active` bit(1) DEFAULT NULL,
  `Photo` blob,
  PRIMARY KEY (`ID`),
  UNIQUE KEY `ID_UNIQUE` (`ID`),
  KEY `Dealership_ID_idx` (`Dealership_ID`),
  KEY `User_ID_idx` (`User_ID`),
  CONSTRAINT `FK_Dealership_SalesPerson` FOREIGN KEY (`Dealership_ID`) REFERENCES `Dealership` (`ID`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  CONSTRAINT `FK_Users_SalesPerson` FOREIGN KEY (`User_ID`) REFERENCES `tbl_users` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION
) ENGINE=InnoDB AUTO_INCREMENT=8 DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `SalesPerson`
--

LOCK TABLES `SalesPerson` WRITE;
/*!40000 ALTER TABLE `SalesPerson` DISABLE KEYS */;
INSERT INTO `SalesPerson` (`ID`, `Dealership_ID`, `User_ID`, `ContactPhone`, `Email`, `Description`, `DateAdded`, `Active`, `Photo`) VALUES (1,1,5,'929-393-9393','salesperson1@gmail.com','This is Neil Armstrong at Berkeley Toyota.','2012-01-01 00:00:00','',''),(4,1,7,'898-272-2626','salesperson3@gmail.com','This is Brad Pitt at Berkeley Toyota.','2012-01-01 00:00:00','',''),(5,1,6,'232-232-2828','salesperson2@gmail.com','This is Tom Cruise at Berkeley Toyota.','2012-01-01 00:00:00','',''),(6,2,8,'929-393-9393','salesperson4@gmail.com','This is Don Bradman at Richmond Toyota.','2012-01-01 00:00:00','',''),(7,2,9,'929-393-9393','salesperson5@gmail.com','This is John Smith at Richmond Toyota.','2012-01-01 00:00:00','','');
/*!40000 ALTER TABLE `SalesPerson` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `SavedCars`
--

DROP TABLE IF EXISTS `SavedCars`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `SavedCars` (
  `ID` int(11) NOT NULL AUTO_INCREMENT,
  `Car_ID` int(11) NOT NULL,
  `DealStatus_ID` int(11) DEFAULT NULL,
  `User_ID` int(11) NOT NULL,
  `DateAdded` int(11) DEFAULT NULL,
  PRIMARY KEY (`ID`),
  UNIQUE KEY `ID_UNIQUE` (`ID`),
  KEY `FK_Users_SavedCars_idx` (`User_ID`),
  KEY `FK_Car_SavedCars_idx` (`Car_ID`),
  KEY `FK_DealStatus_SavedCars_idx` (`DealStatus_ID`),
  CONSTRAINT `FK_Car_SavedCars` FOREIGN KEY (`Car_ID`) REFERENCES `Car` (`ID`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  CONSTRAINT `FK_DealStatus_SavedCars` FOREIGN KEY (`DealStatus_ID`) REFERENCES `SavedCars` (`ID`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  CONSTRAINT `FK_Users_SavedCars` FOREIGN KEY (`User_ID`) REFERENCES `tbl_users` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION
) ENGINE=InnoDB AUTO_INCREMENT=5 DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `SavedCars`
--

LOCK TABLES `SavedCars` WRITE;
/*!40000 ALTER TABLE `SavedCars` DISABLE KEYS */;
INSERT INTO `SavedCars` (`ID`, `Car_ID`, `DealStatus_ID`, `User_ID`, `DateAdded`) VALUES (1,1,1,4,NULL),(2,2,1,2,11202014),(4,2,1,1,20142609);
/*!40000 ALTER TABLE `SavedCars` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `SearchHistory`
--

DROP TABLE IF EXISTS `SearchHistory`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `SearchHistory` (
  `ID` int(11) NOT NULL AUTO_INCREMENT,
  `User_ID` int(11) NOT NULL,
  `Make` varchar(45) DEFAULT NULL,
  `Model` varchar(45) DEFAULT NULL,
  `Year` varchar(45) DEFAULT NULL,
  `StyleID` varchar(45) DEFAULT NULL,
  `MileageCity` varchar(45) DEFAULT NULL,
  `MileageHighway` varchar(45) DEFAULT NULL,
  `Price` varchar(45) DEFAULT NULL,
  `Trim` varchar(45) DEFAULT NULL,
  `DateAdded` varchar(45) DEFAULT NULL,
  PRIMARY KEY (`ID`),
  UNIQUE KEY `ID_UNIQUE` (`ID`),
  KEY `FK_Users_SearchHistory_idx` (`User_ID`),
  CONSTRAINT `FK_Users_SearchHistory` FOREIGN KEY (`User_ID`) REFERENCES `tbl_users` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `SearchHistory`
--

LOCK TABLES `SearchHistory` WRITE;
/*!40000 ALTER TABLE `SearchHistory` DISABLE KEYS */;
INSERT INTO `SearchHistory` (`ID`, `User_ID`, `Make`, `Model`, `Year`, `StyleID`, `MileageCity`, `MileageHighway`, `Price`, `Trim`, `DateAdded`) VALUES (1,1,'test','test','test','test','22','22','222131','convertible','20140101');
/*!40000 ALTER TABLE `SearchHistory` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `messages`
--

DROP TABLE IF EXISTS `messages`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `messages` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `sender_id` int(11) NOT NULL,
  `receiver_id` int(11) NOT NULL,
  `subject` varchar(256) NOT NULL DEFAULT '',
  `body` text,
  `is_read` enum('0','1') NOT NULL DEFAULT '0',
  `deleted_by` enum('sender','receiver') DEFAULT NULL,
  `created_at` datetime NOT NULL,
  PRIMARY KEY (`id`),
  KEY `sender` (`sender_id`),
  KEY `reciever` (`receiver_id`)
) ENGINE=InnoDB AUTO_INCREMENT=5 DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `messages`
--

LOCK TABLES `messages` WRITE;
/*!40000 ALTER TABLE `messages` DISABLE KEYS */;
INSERT INTO `messages` (`id`, `sender_id`, `receiver_id`, `subject`, `body`, `is_read`, `deleted_by`, `created_at`) VALUES (1,4,3,'test','test','1',NULL,'2014-09-19 07:33:37'),(2,3,1,'test','test','1',NULL,'2014-09-28 21:33:37'),(3,1,4,'test1','test1','0',NULL,'2014-10-08 19:10:26'),(4,1,9,'test 10/9','test 1234','1',NULL,'2014-10-10 00:32:52');
/*!40000 ALTER TABLE `messages` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `tbl_migration`
--

DROP TABLE IF EXISTS `tbl_migration`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `tbl_migration` (
  `version` varchar(255) NOT NULL,
  `apply_time` int(11) DEFAULT NULL,
  PRIMARY KEY (`version`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `tbl_migration`
--

LOCK TABLES `tbl_migration` WRITE;
/*!40000 ALTER TABLE `tbl_migration` DISABLE KEYS */;
INSERT INTO `tbl_migration` (`version`, `apply_time`) VALUES ('m000000_000000_base',1410804633);
/*!40000 ALTER TABLE `tbl_migration` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `tbl_profiles`
--

DROP TABLE IF EXISTS `tbl_profiles`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `tbl_profiles` (
  `user_id` int(11) NOT NULL,
  `lastname` varchar(50) NOT NULL DEFAULT '',
  `firstname` varchar(50) NOT NULL DEFAULT '',
  `birthday` date NOT NULL DEFAULT '0000-00-00',
  `Phone` varchar(255) NOT NULL DEFAULT '',
  PRIMARY KEY (`user_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `tbl_profiles`
--

LOCK TABLES `tbl_profiles` WRITE;
/*!40000 ALTER TABLE `tbl_profiles` DISABLE KEYS */;
INSERT INTO `tbl_profiles` (`user_id`, `lastname`, `firstname`, `birthday`, `Phone`) VALUES (1,'Admin','Administrator','0000-00-00',''),(2,'Toyota','Richmond','1970-03-03',''),(3,'Toyota','Berkeley','1979-10-05',''),(4,'user','test','2000-09-09',''),(5,'Person','Sales','1980-02-02','9192292999'),(6,'Cruise','Tom','1976-10-10','989-232-2288'),(7,'Pitt','Brad','1970-03-03','838-283-2828'),(8,'Bradman','Don','1986-09-09','898-292-9898'),(9,'Smith','John','1992-04-04','928-908-9999');
/*!40000 ALTER TABLE `tbl_profiles` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `tbl_profiles_fields`
--

DROP TABLE IF EXISTS `tbl_profiles_fields`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `tbl_profiles_fields` (
  `id` int(10) NOT NULL AUTO_INCREMENT,
  `varname` varchar(50) NOT NULL,
  `title` varchar(255) NOT NULL,
  `field_type` varchar(50) NOT NULL,
  `field_size` int(3) NOT NULL DEFAULT '0',
  `field_size_min` int(3) NOT NULL DEFAULT '0',
  `required` int(1) NOT NULL DEFAULT '0',
  `match` varchar(255) NOT NULL DEFAULT '',
  `range` varchar(255) NOT NULL DEFAULT '',
  `error_message` varchar(255) NOT NULL DEFAULT '',
  `other_validator` varchar(5000) NOT NULL DEFAULT '',
  `default` varchar(255) NOT NULL DEFAULT '',
  `widget` varchar(255) NOT NULL DEFAULT '',
  `widgetparams` varchar(5000) NOT NULL DEFAULT '',
  `position` int(3) NOT NULL DEFAULT '0',
  `visible` int(1) NOT NULL DEFAULT '0',
  PRIMARY KEY (`id`),
  KEY `varname` (`varname`,`widget`,`visible`)
) ENGINE=InnoDB AUTO_INCREMENT=5 DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `tbl_profiles_fields`
--

LOCK TABLES `tbl_profiles_fields` WRITE;
/*!40000 ALTER TABLE `tbl_profiles_fields` DISABLE KEYS */;
INSERT INTO `tbl_profiles_fields` (`id`, `varname`, `title`, `field_type`, `field_size`, `field_size_min`, `required`, `match`, `range`, `error_message`, `other_validator`, `default`, `widget`, `widgetparams`, `position`, `visible`) VALUES (1,'lastname','Last Name','VARCHAR',50,3,1,'','','Incorrect Last Name (length between 3 and 50 characters).','','','','',1,3),(2,'firstname','First Name','VARCHAR',50,3,1,'','','Incorrect First Name (length between 3 and 50 characters).','','','','',0,3),(3,'birthday','Birthday','DATE',0,0,2,'','','','','0000-00-00','UWjuidate','{\"ui-theme\":\"redmond\"}',3,2),(4,'Phone','Phone','VARCHAR',255,0,0,'','','','','','','',0,2);
/*!40000 ALTER TABLE `tbl_profiles_fields` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `tbl_users`
--

DROP TABLE IF EXISTS `tbl_users`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `tbl_users` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `username` varchar(20) NOT NULL,
  `password` varchar(128) NOT NULL,
  `email` varchar(128) NOT NULL,
  `activkey` varchar(128) NOT NULL DEFAULT '',
  `createtime` int(10) NOT NULL DEFAULT '0',
  `lastvisit` int(10) NOT NULL DEFAULT '0',
  `superuser` int(1) NOT NULL DEFAULT '0',
  `status` int(1) NOT NULL DEFAULT '0',
  PRIMARY KEY (`id`),
  UNIQUE KEY `username` (`username`),
  UNIQUE KEY `email` (`email`),
  KEY `status` (`status`),
  KEY `superuser` (`superuser`)
) ENGINE=InnoDB AUTO_INCREMENT=10 DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `tbl_users`
--

LOCK TABLES `tbl_users` WRITE;
/*!40000 ALTER TABLE `tbl_users` DISABLE KEYS */;
INSERT INTO `tbl_users` (`id`, `username`, `password`, `email`, `activkey`, `createtime`, `lastvisit`, `superuser`, `status`) VALUES (1,'admin','098f6bcd4621d373cade4e832627b4f6','sandeep.kolte@gmail.com','a62257bc1e6035332ba4f094cf12a64e',1261146094,1412894147,1,1),(2,'dealer2','098f6bcd4621d373cade4e832627b4f6','demo@example.com','bf3c958f8f9ad4f911ff22b0cb328c1b',1261146096,0,1,1),(3,'dealer1','098f6bcd4621d373cade4e832627b4f6','agneyy@yahoo.com','26d05d4e8a4980aec871289c0fe96bf3',1410848052,1412893591,0,1),(4,'user1','098f6bcd4621d373cade4e832627b4f6','sandeepkolte@yahoo.com','c1f297742476f70659e6d34edcb37c7a',1411104398,1412893414,0,1),(5,'salesperson1','098f6bcd4621d373cade4e832627b4f6','sandeepkolte@hotmail.com','043050a3e70376e4184a7e97d6adb3d1',1411799126,1411799126,0,1),(6,'salesperson2','098f6bcd4621d373cade4e832627b4f6','peednasetlok@hotmail.com','13d6205f59964a62d8109702191df723',1412791344,1412791344,0,1),(7,'salesperson3','098f6bcd4621d373cade4e832627b4f6','salesperson3@gmail.com','1476ebe318fd97615c0e3aa209021e44',1412791525,1412791525,0,1),(8,'salesperson4','098f6bcd4621d373cade4e832627b4f6','salesperson4@gmail.com','4aa9f19ea7f227095c1a33e8b3387744',1412793228,1412793228,0,1),(9,'salesperson5','098f6bcd4621d373cade4e832627b4f6','salesperson5@gmail.com','b933651d659596e377d85422243841c3',1412793281,1412893983,0,1);
/*!40000 ALTER TABLE `tbl_users` ENABLE KEYS */;
UNLOCK TABLES;
/*!40103 SET TIME_ZONE=@OLD_TIME_ZONE */;

/*!40101 SET SQL_MODE=@OLD_SQL_MODE */;
/*!40014 SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS */;
/*!40014 SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
/*!40111 SET SQL_NOTES=@OLD_SQL_NOTES */;

-- Dump completed on 2014-10-09 21:39:57
