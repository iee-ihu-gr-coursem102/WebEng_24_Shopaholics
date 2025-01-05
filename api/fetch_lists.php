<?php
require "../config.php";
header('Content-Type: application/json; charset=utf-8');

	if (isset($_GET['user_lists']) && isset($_GET['active_list'])) {
		try {
			$connection = new PDO($dsn, $username, $password, $options);
			$user = $_GET['user_lists'];
			$active = $_GET['active_list'];
			$sql = "SELECT * FROM lists JOIN junc_t_user_list on lists.list_id = junc_t_user_list.list_id 
			WHERE user_id=? AND active=?
			ORDER BY list_order_id ASC;";
			$statement = $connection->prepare($sql);
			$statement->bindValue(1, $user, PDO::PARAM_INT);
			$statement->bindValue(2, $active, PDO::PARAM_INT);
			$statement->execute();
			$data = $statement->fetchAll(PDO::FETCH_ASSOC);
			$response = json_encode($data, JSON_UNESCAPED_UNICODE);
			
			print_r($response);
			
			}catch(PDOException $error) {
		  echo $sql . "<br>" . $error->getMessage();
		} 
	}

	if (isset($_GET['list_items'])) {
	  	try {
			$connection = new PDO($dsn, $username, $password, $options);
			$items = $_GET['list_items'];
			$sql = "SELECT * FROM items WHERE list_id = :list_id ORDER BY order_id ASC";
			$statement = $connection->prepare($sql);
			$statement->bindValue(':list_id', $items, PDO::PARAM_INT);
			$statement->execute();
			$data = $statement->fetchAll(PDO::FETCH_ASSOC);
			$response = json_encode($data, JSON_UNESCAPED_UNICODE);
			
			print_r($response);
			
			}catch(PDOException $error) {
			echo $sql6 . "<br>" . $error->getMessage();
		}
	}
	
	if (isset($_GET['lists'])) {
		try {
			$connection = new PDO($dsn, $username, $password, $options);
			$list = $_GET['lists'];
			$sql = "SELECT * FROM lists WHERE list_id=?";
			$statement = $connection->prepare($sql);
			$statement->bindValue(1, $list, PDO::PARAM_INT);
			$statement->execute();
			$data = $statement->fetchAll(PDO::FETCH_ASSOC);
			$response = json_encode($data, JSON_UNESCAPED_UNICODE);
			
			print_r($response);
			
			}catch(PDOException $error) {
		  echo $sql . "<br>" . $error->getMessage();
		} 
	}

?>