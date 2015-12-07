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


$con->close();
?>