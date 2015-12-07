<?php

// connection variables
$host = "localhost";
$port = 3306;
$socket = "";
$user = "root";
$password = "root";
$dbname = "mysql";

// connection
$con = new mysqli($host, $user, $password, $dbname, $port, $socket) or die("Could not establish connection". mysqli_connect_error());

// verify connection
if(!$con) {
    die("could not connect:" . mysqli_error(). "<br><br>");
} else {
    print "connection has been made <br><br>";
}

// drop database if it exists
$sql = "DROP DATABASE IF EXISTS `spen7755`;";


// check for success
if (mysqli_query($con, $sql)) {
    print "spen7755 database dropped <br><br>";
} else {
    print "spen7755 database not dropped" . $sql->error . "<br><br>";
}

// create new database
$sql = "CREATE DATABASE IF NOT EXISTS spen7755 DEFAULT CHARACTER SET utf8 COLLATE utf8_general_ci;";

// check for success
if (mysqli_query($con, $sql)) {
    print "spen7755 database created <br><br>";
} else {
    print "spen7755 database not created" . $sql->error . "<br><br>";
}

// reset target database to new database
$dbname = "spen7755";

// switch to new database
$con = new mysqli($host, $user, $password, $dbname, $port, $socket) or die("Could not establish connection" . mysqli_connect_error());

// verify connection
if(!$con) {
    die("could not connect to spen7755:" . mysqli_error(). "<br><br>");
} else {
    print "spen7755 connection has been made <br><br>";
}

//// ADMINS TABLE

// drop admins table
$sql = "DROP TABLE IF EXISTS `admins`";

// check for success
if (mysqli_query($con, $sql)) {
    print "admins table dropped <br><br>";
} else {
    print "admins table not dropped" . $sql->error . "<br><br>";
}

// create admins table
$sql = "CREATE TABLE `admins` (
  `userID` int(11) NOT NULL AUTO_INCREMENT,
  `login` varchar(25) NOT NULL,
  `firstName` varchar(25) NOT NULL,
  `lastName` varchar(25) NOT NULL,
  `password` varchar(300) NOT NULL DEFAULT 'Noth1ng!',
  `adminLevel` int(11) NOT NULL DEFAULT '2',
  PRIMARY KEY (`userID`)
) ENGINE=InnoDB AUTO_INCREMENT=15 DEFAULT CHARSET=utf8";

// check for success
if (mysqli_query($con, $sql)) {
    print "admins table created <br><br>";
} else {
    print "admins table not created" . $sql->error . "<br><br>";
}

///load data into admin
$sql = "LOCK TABLES `admins` WRITE; INSERT INTO `admins` VALUES (1,'default','Default','Admin','Noth1ng!',1),(2,'Chris','Chris','Spencer','Bubbaca1!t',1),(3,'Minnie','Minnie','Mouse','Noth1ng!',2),(5,'example','Mr dumster','DumDum','Noth1ng!',2),(6,'money','Money','Penny','JamesBond007*',2),(7,'camper','Happy','Camper','!123456eR',2),(9,'traffic','Traffic','Light','camper1!W',1),(10,'laurie','Laurie','Spencer','Noth1ng!',2),(12,'littleman','Robin','Red','Noth1ng!',2),(14,'sasquatch','Big','Foot','Bubbaca1!t',2); UNLOCK TABLES;";

// check for success
if (mysqli_query($con, $sql)) {
    print "admins data loaded <br><br>";
} else {
    print "admins data not loaded" . $sql->error . "<br><br>";
}

///CUSTOMERS TABLE


// drop customers table
$sql = "DROP TABLE IF EXISTS `customers`";

// check for success
if (mysqli_query($con, $sql)) {
    print "customers table dropped <br><br>";
} else {
    print "customers table not dropped" . $sql->error . "<br><br>";
}

// create customers table
$sql = "CREATE TABLE `customers` (
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
) ENGINE=InnoDB AUTO_INCREMENT=13 DEFAULT CHARSET=utf8";

// check for success
if (mysqli_query($con, $sql)) {
    print "customers table created <br><br>";
} else {
    print "customers table not created" . $sql->error . "<br><br>";
}

///load data into customers
$sql = "LOCK TABLES `customers` WRITE; INSERT INTO `customers` VALUES (3,'frank','seeberger','fsee@sdf.com','adsf nn street','','cheucville','va','23458','2343453456'),(4,'chris','spencer','chris@chrisspencer.com','7663 n 34th st','','seattle','wa','98103','2045677890'),(9,'Cramwell','Morgenstein','Cmorgenstein@cram.com','345 n tabor st','','seattle','wa','98103','206-988-7896'),(10,'susan','palmer','susanpalmer@susanpalmer.com','879 n young st','','Seattle','wa','98765','206-989-9087'),(11,'Mick','Goodrick','MickeyGoodrickey@goodrick.com','123 boylston ave','','Boston','Ma','02134','234-980-8970'),(12,'Marty ','Feldman','mfeldman@gmail.com','234 n yuour St','','Seattle','WA','98203','206-908-7865'); UNLOCK TABLES;";

// check for success
if (mysqli_query($con, $sql)) {
    print "customers data loaded <br><br>";
} else {
    print "customers data not loaded" . $sql->error . "<br><br>";
}

///ORDERS TABLE


// drop orders table
$sql = "DROP TABLE IF EXISTS `orders`";

// check for success
if (mysqli_query($con, $sql)) {
    print "orders table dropped <br><br>";
} else {
    print "orders table not dropped" . $sql->error . "<br><br>";
}

// create orders table
$sql = "CREATE TABLE `orders` (
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
) ENGINE=InnoDB AUTO_INCREMENT=16 DEFAULT CHARSET=utf8";

// check for success
if (mysqli_query($con, $sql)) {
    print "orders table created <br><br>";
} else {
    print "orders table not created" . $sql->error . "<br><br>";
}

///load data into orders
$sql = "LOCK TABLES `orders` WRITE; INSERT INTO `orders` VALUES (6,'2015-12-04 11:10:00',4,'20 thin_crust - build_your_own  add - pepperoni - onions - extra_cheese - olives - green_peppers - sundried_tomatoes',23.45,2.11,25.56,'n','2015-12-04','11:10:00'),(7,'2015-12-04 11:15:00',4,'20 thin_crust - build_your_own  add - pepperoni - onions - extra_cheese - olives - green_peppers - sundried_tomatoes',23.45,2.11,25.56,'y','2015-12-04','11:15:00'),(8,'2015-12-04 11:19:00',4,'20 thin_crust - build_your_own  add - pepperoni - onions - extra_cheese - olives - green_peppers - sundried_tomatoes',23.45,2.11,25.56,'n','2015-12-04','11:19:00'),(9,'2015-12-05 23:31:43',4,'20 thin_crust - build_your_own  add - pepperoni - onions - extra_cheese - olives - green_peppers - sundried_tomatoes',23.45,2.11,25.56,'n','2015-12-05','23:31:43'),(10,'2015-12-05 23:32:27',3,'12 deep_dish - meatlover  add - pepperoni - onions - extra_cheese - olives - green_peppers - sundried_tomatoes',16.75,1.51,18.26,'y','2015-12-05','23:32:27'),(11,'2015-12-05 23:34:02',9,'20 deep_dish - build_your_own  add - olives - green_peppers',24.895,2.24,27.13,'n','2015-12-05','23:34:02'),(12,'2015-12-05 23:37:56',10,'16 thin_crust - hawaiian',15.5,1.4,16.9,'n','2015-12-05','23:37:56'),(13,'2015-12-07 00:23:06',11,'20 deep_dish - meatlover',25.85,2.33,28.18,'y','2015-12-07','00:23:06'),(15,'2015-12-07 01:00:46',12,'20 thin_crust - build_your_own  add - olives - sundried_tomatoes',19.25,1.73,20.98,'n','2015-12-07','01:00:46'); UNLOCK TABLES;";

// check for success
if (mysqli_query($con, $sql)) {
    print "orders data loaded <br><br>";
} else {
    print "orders data not loaded" . $sql->error . "<br><br>";
}

$con->close();
?>