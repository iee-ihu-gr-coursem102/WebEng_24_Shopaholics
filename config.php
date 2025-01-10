<?php
//Configuration for database connection

$host ='localhost';

//$username = "meladmar";
$username = "root";

//$password = "8ds@3G+XmN$35";
$password = "";
$dbname     = "shopaholics"; 

//$socket = '/home/student/ait/2024/meladmar/mysql/run/mysql.sock'; 
$dsn        = "mysql:host=$host;dbname=$dbname"; 
$options    = array(
                PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION
              );
			  
/* Attempt to connect to MySQL database */
//$link = mysqli_connect($host,$username,$password,$dbname,null,$socket);
$link = mysqli_connect($host,$username,$password,$dbname);
 
// Check connection
if($link === false){
    die("ERROR: Could not connect. " . mysqli_connect_error());
}	
?>		  
