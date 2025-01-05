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

if (isset($_SESSION['user_id']) && isset($_POST['update_title'])) {
		try {
		$connection = new PDO($dsn, $username, $password, $options);
		
		//note object
		$update_lists = array(
								
				"title"				=> $_POST['update_title'],
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

if (isset($_SESSION['user_id']) && isset($_POST['update_list_order_id'])) {
		try {
		$connection = new PDO($dsn, $username, $password, $options);
		
		//note object
		$update_lists = array(
								
				//"list_id"			=> $_POST['list_id'],
				"list_order_id"		=> $_POST['update_list_order_id']
		);
		
	$sql = sprintf(
		"UPDATE %s SET %s = %s WHERE user_id = $_SESSION[user_id] AND list_id = $_POST[list_id];",
		"junc_t_user_list",
		implode(", ", array_keys($update_lists)),
		":" . implode(", :", array_keys($update_lists))
		);
		
		$statement = $connection->prepare($sql);
		$statement->execute($update_lists);
		
		}catch(PDOException $error) {
		  echo $sql . "<br>" . $error->getMessage();
	} 
}
exit;
?>