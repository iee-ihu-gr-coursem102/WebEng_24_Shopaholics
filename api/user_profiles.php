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

if (isset($_SESSION['user_id'])) {
		try {
			$connection = new PDO($dsn, $username, $password, $options);
			$user = $_SESSION['user_id'];
			
			$sql = "SELECT Name, Surname, email, picture FROM users 
					WHERE user_id=?;";
					
			$statement = $connection->prepare($sql);
			$statement->bindValue(1, $user, PDO::PARAM_INT);
			$statement->execute();
			$user_data = $statement->fetchAll(PDO::FETCH_ASSOC);
			$response = json_encode($user_data, JSON_UNESCAPED_UNICODE);
			
			print_r($response);
			
			}catch(PDOException $error) {
		  echo $sql . "<br>" . $error->getMessage();
		} 
	}

	// if (isset($_GET['list_items'])) {
	  	// try {
			// $connection = new PDO($dsn, $username, $password, $options);
			// $items = $_GET['list_items'];
			// $sql = "SELECT * FROM items WHERE list_id = :list_id ORDER BY order_id ASC";
			// $statement = $connection->prepare($sql);
			// $statement->bindValue(':list_id', $items, PDO::PARAM_INT);
			// $statement->execute();
			// $data = $statement->fetchAll(PDO::FETCH_ASSOC);
			// $response = json_encode($data, JSON_UNESCAPED_UNICODE);
			
			// print_r($response);
			
			// }catch(PDOException $error) {
			// echo $sql6 . "<br>" . $error->getMessage();
		// }
	// }
	
	// if (isset($_GET['lists'])) {
		// try {
			// $connection = new PDO($dsn, $username, $password, $options);
			// $list = $_GET['lists'];
			// $sql = "SELECT * FROM lists WHERE list_id=?";
			// $statement = $connection->prepare($sql);
			// $statement->bindValue(1, $list, PDO::PARAM_INT);
			// $statement->execute();
			// $data = $statement->fetchAll(PDO::FETCH_ASSOC);
			// $response = json_encode($data, JSON_UNESCAPED_UNICODE);
			
			// print_r($response);
			
			// }catch(PDOException $error) {
		  // echo $sql . "<br>" . $error->getMessage();
		// } 
	// }

?>