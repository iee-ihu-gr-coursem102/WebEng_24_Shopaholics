<?php
//Configuration for database connection

$host       = "localhost";
<<<<<<< HEAD
$username   = "meladma";
$password   = "!8pmM$@tz";
=======
$username   = "root";
$password   = "";
>>>>>>> 2a6dd2f9fb89d45e29ab2928258317f463468f77
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
<<<<<<< HEAD
?>		  
=======
?>		  
>>>>>>> 2a6dd2f9fb89d45e29ab2928258317f463468f77
