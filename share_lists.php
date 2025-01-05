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

if (isset($_SESSION['user_id']) && isset($_POST['list_id']) && isset($_POST['user_email'])) {
		try {
		$connection = new PDO($dsn, $username, $password, $options);
		
		$user_email = $_POST['user_email'];
		$sql_verify_email = "SELECT user_id FROM users WHERE email = :email";
		
		$statement = $connection->prepare($sql_verify_email);
		$statement->bindValue(':email', $user_email);
		$statement->execute();
		$user_id = $statement->fetch(PDO::FETCH_ASSOC);
		
		// Check if the user was found
        if (!$user_id) {
            // Return error if email doesn't exist
            echo json_encode(array("error" => "Ο χρήστης δεν βρέθηκε!\nΔοκιμάστε ξανά."),JSON_UNESCAPED_UNICODE);
			$_POST['user_email']="";
            exit;
        }
		
		// Check if the user is the owner
        if ($_SESSION['user_id']==$user_id['user_id']) {
            // Return error if email is the same
            echo json_encode(array("error" => "Δεν μπορείτε να διαμοιράσετε τη λίστα στον εαυτό σας.\nΔοκιμάστε να κλωνοποιήσετε τη λίστα σας."),JSON_UNESCAPED_UNICODE);
			$_POST['user_email']="";
            exit;
        }
		
		$sql_verify_unique_list = "SELECT * FROM junc_t_user_list WHERE user_id = :second_user AND list_id = :shared_list_id;";
		
		$statement = $connection->prepare($sql_verify_unique_list);
		$statement->bindValue(':second_user', $user_id['user_id']);
		$statement->bindValue(':shared_list_id', $_POST['list_id']);
		$statement->execute();
		$return = $statement->fetch(PDO::FETCH_ASSOC);//sos εδώ! θέλει fix
		print_r($return);
		// Check if the user has shared this list with the same other user
		if($return>1){
			// Return error if it has been shared before
            echo json_encode(array("error" => "Η λίστα αυτή είναι ήδη διαμοιρασμένη με τον χρήστη που έχει το e-mail: ".$_POST['user_email']),JSON_UNESCAPED_UNICODE);
			$_POST['user_email']="";
            exit;
		}
		
		$shared_lists = array(
				"user_id" => $user_id['user_id'],
				"list_id" => $_POST['list_id']
				);
		
		$sql_junc_t_user_list = sprintf(
				"INSERT INTO %s (%s) VALUES (%s) ",
				"junc_t_user_list",
				implode(", ", array_keys($shared_lists)),
				":" . implode(", :", array_keys($shared_lists))
				);	
		
		$statement = $connection->prepare($sql_junc_t_user_list);
		$statement->execute($shared_lists);
		
		$lastInsertId = $connection->lastInsertId();
		$response = array("last_inserted_id" => $lastInsertId);
		echo json_encode($response, JSON_UNESCAPED_UNICODE);
		
	}catch(PDOException $error) {
		  echo $sql . "<br>" . $error->getMessage();
		} 
}		

?>
