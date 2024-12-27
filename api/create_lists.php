<?php
require "../config.php";
header('Content-Type: application/json; charset=utf-8');

//print_r($_POST);

if (isset($_POST['user_id']) && isset($_POST['list_id'])) {
		try {
		$connection = new PDO($dsn, $username, $password, $options);
		
		//note object
		$updated_lists = array(
								
				//"user_id"			=> $_POST['user_id'],			
				//"list_id"			=> $_POST['list_id'],
				"list_order_id"		=> $_POST['list_order_id'],
				"Title"				=> $_POST['Title'],
				"icon"				=> $_POST['icon'],
				"active"			=> $_POST['active'],	
				"creation_date"		=> $_POST['creation_date']
		);
		
	$duplicates = '';
		foreach ($updated_lists as $key => $value) {
		$duplicates .= "{$key} = VALUES({$key}), ";
		}
		$duplicates = rtrim($duplicates, ', '); 
		
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
				
				"user_id"			=> $_POST['user_id'],			
				"list_id"			=> $lastInsertId
		);		
		
	$sql_junc_t_user_list = sprintf(
		"INSERT INTO %s (%s) VALUES (%s) ",
		"junc_t_user_list",
		implode(", ", array_keys($owners_list)),
		":" . implode(", :", array_keys($owners_list))
		);	
		
		$statement = $connection->prepare($sql_junc_t_user_list);
		$statement->execute($owners_list);
		
		$response = array("last_inserted_id" => $lastInsertId);
		
		echo json_encode($response, JSON_UNESCAPED_UNICODE);
		
		//print_r($response);
		
	}catch(PDOException $error) {
		  echo $sql . "<br>" . $error->getMessage();
		} 
}		

?>
