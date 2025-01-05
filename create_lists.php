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

if (isset($_SESSION['user_id']) && isset($_POST['list_id'])) {
		try {
		$connection = new PDO($dsn, $username, $password, $options);
		
		$updated_lists = array(
								
				//"list_order_id"	=> $_POST['list_order_id'],
				"list_id"			=> $_POST['list_id'],
				"title"				=> $_POST['title'],
				"category"			=> $_POST['category'],
				"icon"				=> $_POST['icon'],
				"active"			=> $_POST['active'],	
				"creation_date"		=> $_POST['creation_date']
		);
		
	$duplicates = '';
		foreach ($updated_lists as $key => $value) {
		$duplicates .= "{$key} = VALUES({$key}), ";
		}
		$duplicates = rtrim($duplicates, ', '); 
		
		//print_r($duplicates);
		
	$sql = sprintf(
		"INSERT INTO %s (%s) VALUES (%s) ON DUPLICATE KEY UPDATE %s",
		"lists",
		implode(", ", array_keys($updated_lists)),
		":" . implode(", :", array_keys($updated_lists)),
		$duplicates
		);
		
		$statement = $connection->prepare($sql);
		$statement->execute($updated_lists);
		
		$lastInsertId = $connection->lastInsertId();
		
		$owners_list = array(
				
				"user_id"			=> $_SESSION['user_id'],			
				"list_id"			=> $lastInsertId,
				"list_order_id"		=> $_POST['list_order_id']
		);		
		
		$duplicates = '';
		foreach ($owners_list as $key => $value) {
		$duplicates .= "{$key} = VALUES({$key}), ";
		}
		$duplicates = rtrim($duplicates, ', '); 	
		
	$sql_junc_t_user_list = sprintf(
		"INSERT INTO %s (%s) VALUES (%s) ON DUPLICATE KEY UPDATE %s",
		"junc_t_user_list",
		implode(", ", array_keys($owners_list)),
		":" . implode(", :", array_keys($owners_list)),
		$duplicates
		);	
		
		$statement = $connection->prepare($sql_junc_t_user_list);
		$statement->execute($owners_list);
		
		$response = array("last_inserted_id" => $lastInsertId);
		
		echo json_encode($response, JSON_UNESCAPED_UNICODE);
		
	}catch(PDOException $error) {
		  echo $sql . "<br>" . $error->getMessage();
		} 
}	
	
?>
