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
		
		$sql_chk_archive = "SELECT active FROM lists WHERE list_id = :list_id";
		
		$statement = $connection->prepare($sql_chk_archive);
		$statement->bindValue(':list_id', $_POST['list_id']);
		$statement->execute();
		$active = $statement->fetch(PDO::FETCH_ASSOC);
		
		$archived = $active['active'];
		
		if($archived==1){$archived=0;}else{$archived=1;}
			
		//data object
		$update_lists = array(
				"active"			=> $archived,
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