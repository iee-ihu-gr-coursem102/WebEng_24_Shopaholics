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

if (isset($_POST['list_id']) ) {
	
	try {
		$connection = new PDO($dsn, $username, $password, $options);
		
		$item_id = $_POST['item_id'];
		$sql_verify_item = "SELECT list_id FROM items WHERE item_id = :item_id";
		
		$statement = $connection->prepare($sql_verify_item);
		$statement->bindValue(':item_id', $item_id);
		$statement->execute();
		$verification = $statement->fetch(PDO::FETCH_ASSOC);
		
		//note object
if ($verification && $verification['list_id']==$_POST['list_id']) {
		
		$connection = new PDO($dsn, $username, $password, $options);
		
		$updated_items = array(
			"list_id" 	=> $_POST['list_id'],
			"order_id"	=> $_POST['order_id'],
			"item" 		=> $_POST['item'],
			"quantity" 	=> $_POST['quantity'],
			"measuring_unit" => $_POST['measuring_unit'],
			"completed" => $_POST['completed'],
			"item_id" 	=> $_POST['item_id'] 
			);

		$sql = "UPDATE items 
			SET list_id = :list_id, 
				order_id = :order_id, 
				item = :item, 
				quantity = :quantity, 
				measuring_unit = :measuring_unit, 
				completed = :completed
			WHERE item_id = :item_id";


		$statement = $connection->prepare($sql);

	foreach ($updated_items as $key => $value) {
		$statement->bindValue(":{$key}", $value);
	}
	$statement->execute();
	
}else{	

$updated_items = array(
								
				//"item_id"			=> $_POST['item_id'],			
				"list_id"			=> $_POST['list_id'],
				"order_id"			=> $_POST['order_id'],
				"item"				=> $_POST['item'],
				"quantity"			=> $_POST['quantity'],
				"measuring_unit"	=> $_POST['measuring_unit'],
				"completed"			=> $_POST['completed'],	
		);
		
	$sql = sprintf(
		"INSERT INTO %s (%s) VALUES (%s)",
		"items",
		implode(", ", array_keys($updated_items)),
		":" . implode(", :", array_keys($updated_items)),
		//$duplicates
		);
		
		$statement = $connection->prepare($sql);
		$statement->execute($updated_items);		
}	
		
	// Check if the statement was executed successfully
if ($statement) {
    // Get the last inserted ID if the insert was successful
    $lastInsertId = $connection->lastInsertId();
    
    // Check if rows were affected (if an update occurred)
    $rowCount = $statement->rowCount();

    // Prepare the response
    if ($rowCount > 0) {
        $response = array(
            "status" 			=> "success",
            "message" 			=> "Record inserted/updated successfully.",
            "last_inserted_id" 	=> $lastInsertId,
            "affected_rows" 	=> $rowCount,
			//"duplicates" 		=> $duplicates
        );
    } else {
        $response = array(
            "status" 			=> "info",
            "message" 			=> "No changes made to existing record.",
            "last_inserted_id" 	=> null,
            "affected_rows" 	=> $rowCount,
			//"duplicates" 		=> $duplicates
        );
    }
} else {
    $response = array(
        "status" => "error",
        "message" => "Failed to execute the query.",
        "error" => $statement->errorInfo()
    );
}

	echo json_encode($response);
	
	} catch(PDOException $error) {
		echo $sql . "<br>" . $error->getMessage();
	}
	
} 

exit;

?>
