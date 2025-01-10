<?php
// Include config file
require_once "config.php";

// Processing form data when form is submitted
if($_SERVER["REQUEST_METHOD"] == "POST"){
 
    // Check if username is empty
    if(empty(trim($_POST["email"]))){
        $username_err = "Εισάγετε όνομα χρήστη.";
    } else{
        $username = htmlspecialchars(trim($_POST["email"]));
    }
       
    // Validate credentials
    if(empty($username_err)){
        header("location: ");
            } else{
                echo "Κάτι πήγε λάθος! Παρακαλώ προσπαθήστε ξανά αργότερα.";
            }
        }

	// Prepare a select statement
      $sql = "UPDATE users 
				SET reset_password_token = ?, 
					token_expiration = ?
				WHERE email = ?";
   
        if($stmt = mysqli_prepare($link, $sql)){
          // Bind variables to the prepared statement as parameters
          echo mysqli_stmt_bind_param($stmt, "sss", $new_token, $expiration_date, $username);
            
            // Set parameters
            $new_token = "1234567812345678123456781234567812345678123456781234567812345678";
			$expiration_date = "2024-12-19";
			$username = trim($_POST["email"]);
            
            // Attempt to execute the prepared statement
            if(mysqli_stmt_execute($stmt)){
                // Store result
                mysqli_stmt_store_result($stmt);

                            session_start();					
                            // Redirect user to welcome page
?>
<script>alert("Το συνθηματικό σας αρχικοποιήθηκε. Σας έχει αποσταλεί e-mail με οδηγίες για την επανάκτηση του.");
window.location="login.php";
</script><?php
                            //header("location: login.php");
                        } 
                    }
        // Close statement
        mysqli_stmt_close($stmt);

    // Close connection
    mysqli_close($link);
?>