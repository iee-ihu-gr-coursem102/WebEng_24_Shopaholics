<?php
//Configuration for database connection

$host       = "localhost";
$username   = "root";
$password   = "";
$dbname     = "shopaholics"; 
$dsn        = "mysql:host=$host;dbname=$dbname"; 
$options    = array(
                PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION
              );
			  
/* Attempt to connect to MySQL database */
$link = mysqli_connect($host,$username,$password,$dbname);
 
// Check connection
if($link === false){
    die("ERROR: Could not connect. " . mysqli_connect_error());
}	
?>		  