<?php
// Initialize the session
session_start(); 
// Check if the user is already logged in, if yes then redirect him to welcome page
if(!isset($_SESSION["loggedin"]) && $_SESSION["loggedin"] != true){
  header("location: login.php");
  exit;
}

require "../config.php";
header('Content-Type: application/json; charset=utf-8');

if (isset($_POST['list_id'])) {
		try {
		$connection = new PDO($dsn, $username, $password, $options);


		
		//note object
		$update_lists = array(
								
				//"list_id"			=> $_POST['list_id'],
				//"list_order_id"	=> $_POST['list_order_id'],
				"active"			=> $_POST['archive_list'],
				//"icon"			=> $_POST['icon'],
				//"active"			=> $_POST['active'],	

		);
		
	$sql = sprintf(
		"UPDATE %s SET %s = %s WHERE list_id = $_POST[list_id];",
		"lists",
		implode(", ", array_keys($update_lists)),
		":" . implode(", :", array_keys($update_lists))
		);
		
		$statement = $connection->prepare($sql);
		$statement->execute($update_lists);
		
		}catch(PDOException $error) {
		  echo $sql . "<br>" . $error->getMessage();
	} 
}

?>