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

if (isset($_SESSION['user_id']) && isset($_POST['list_id'])) {

	try {
	$connection = new PDO($dsn, $username, $password, $options);
		
	$list_id = $_POST["list_id"];
	
		$sql_verify_unique_list = "SELECT COUNT(*) FROM junc_t_user_list WHERE  list_id = :shared_list_id;";
		
		$statement = $connection->prepare($sql_verify_unique_list);
		//$statement->bindValue(':second_user', $_SESSION['user_id']);
		$statement->bindValue(':shared_list_id', $_POST['list_id']);
		$statement->execute();
		$return = $statement->fetch();
		print_r($return);
		$counts = (int) $return['COUNT(*)'];
		// Check if the user has shared this list with the same other user
		if($counts > 1){
			// Return error if it has been shared before
		$sql = "DELETE FROM junc_t_user_list WHERE list_id = :list_id 
			AND user_id = :user;
			";
            echo json_encode(array("error" => "Η λίστα αυτή διαμοιράζεται. Η διαγραφή θα ισχύσει μόνο για εσάς."),JSON_UNESCAPED_UNICODE);
			
		}else{
	
		$sql = "DELETE FROM items WHERE list_id = :list_id;
				DELETE FROM junc_t_user_list WHERE list_id = :list_id;
				DELETE FROM lists WHERE list_id = :list_id;
			 ";
            echo json_encode(array("succsess" => "Η λίστα διαγράφηκε επιτυχώς."),JSON_UNESCAPED_UNICODE);			
		};

    $statement = $connection->prepare($sql);
	$statement->bindValue(":list_id", $list_id, PDO::PARAM_INT);
	$statement->bindValue(":user", $_SESSION['user_id'], PDO::PARAM_INT);
    $statement->execute();
		
	} catch(PDOException $error) {
		echo $sql . "<br>" . $error->getMessage();
	}	
} 

exit;

?>