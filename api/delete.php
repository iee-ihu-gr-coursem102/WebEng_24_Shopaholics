<?php
require "../config.php";
header('Content-Type: application/json; charset=utf-8');

print_r($_POST['item_id']);	//&& isset($_POST['item_id'])

if (isset($_POST['item_id']) ) {
	
	try {
	$connection = new PDO($dsn, $username, $password, $options);
		
	$item_id = $_POST["item_id"];
	
	$sql = "DELETE FROM items WHERE item_id = ?;";

    $statement = $connection->prepare($sql);
	$statement->bindValue(1, $item_id, PDO::PARAM_INT);
    $statement->execute();
		
	} catch(PDOException $error) {
		echo $sql . "<br>" . $error->getMessage();
	}	
} 

exit;

?>