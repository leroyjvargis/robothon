<?php
session_start();
 
$dbhost = "localhost"; 
$dbname = "robothon_db";
$dbuser = "root";
$dbpass = ""; 
 
$link = mysqli_connect($dbhost, $dbuser, $dbpass, $dbname) or die("MySQL Error: " . mysql_error());



?>