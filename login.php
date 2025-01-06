<?php
// Initialize the session
session_start(); 
// Check if the user is already logged in, if yes then redirect him to welcome page
if(isset($_SESSION["loggedin"]) && $_SESSION["loggedin"] === true){
  header("location: index.php");
  exit;
}
// Include config file
require_once "config.php";
// Define variables and initialize with empty values
$username = $password = "";
$username_err = $password_err = "";
$permission = "";
 
// Processing form data when form is submitted
if($_SERVER["REQUEST_METHOD"] == "POST"){
 
    // Check if username is empty
    if(empty(trim($_POST["email"]))){
        $username_err = "Εισάγετε e-mail χρήστη.";
    }else{
        $username = trim($_POST["email"]);
    }
    
    // Check if password is empty
    if(empty(trim($_POST["password"]))){
        $password_err = "Εισάγετε κωδικό πρόσβασης.";
    }else{
        $password = trim($_POST["password"]);
    }

    // Validate credentials
    if(empty($username_err) && empty($password_err)){
        // Prepare a select statement
        $sql = "SELECT user_id, email, password FROM users WHERE email = ?";
   
        if($stmt = mysqli_prepare($link, $sql)){
            // Bind variables to the prepared statement as parameters
            echo mysqli_stmt_bind_param($stmt, "s", $param_username);
            
            // Set parameters
            $param_username = $username;
            
            // Attempt to execute the prepared statement
            if(mysqli_stmt_execute($stmt)){
                // Store result
                mysqli_stmt_store_result($stmt);
                
                // Check if username exists, if yes then verify password
                if(mysqli_stmt_num_rows($stmt) == 1){                    
                    // Bind result variables
                    mysqli_stmt_bind_result($stmt, $id, $username, $hashed_password);
                    if(mysqli_stmt_fetch($stmt)){
                        if(password_verify($password, $hashed_password)){
                            // Password is correct, so start a new session
                            session_start();
                            
                            // Store data in session variables
                            $_SESSION["loggedin"] = true;
                            $_SESSION["user_id"] = $id;
                            $_SESSION["email"] = $email;
                            //$_SESSION["role"] = $role;
							
                            // Redirect user to welcome page
                            header("location: index.php");
                        } else{
                            // Display an error message if password is not valid
                            $password_err = "Ο κωδικός πρόσβασης που δώσατε δεν είναι σωστός.";
                        }
                    }
                } else{
                    // Display an error message if username doesn't exist
                    $username_err = "Δεν βρέθηκε λογαριασμός με αυτό το όνομα χρήστη.";
                }
            } else{
                echo "Κάτι πήγε λάθος! Παρακαλώ προσπαθήστε ξανά αργότερα.";
            }
        }
        
        // Close statement
        mysqli_stmt_close($stmt);
    }
    
    // Close connection
    mysqli_close($link);
}
?>

<?php require "templates/header.php";?>
<!-- Header -->
<!--header id="header" class="skel-layers-fixed center">
	<h1><a href="login.php"><img src="images/main_logo.png" width="200" height="90"></a></h1>
</header-->

    <section id="one" class="wrapper style1">
		<header class="major">
			<h2><a href="login.php"><img src="images/main_logo.png" width="200" ></a></h2>
				<h3><p>Παρακαλώ εισάγετε τα στοιχεία σας για να συνδεθείτε.</p></h3>
		</header>
			<div class="container">
				<div class="row">
					<div class="12u">
						<form action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>" method="post">
							<div class="form-group <?php echo (!empty($username_err)) ? 'has-error' : ''; ?>">
								<label>e-mail Χρήστη</label>
								<input type="email" name="email" class="form-control" value="<?php echo $username; ?>">
								<span class="help-block"><?php echo $username_err; ?></span>
								</br>
							</div>    
							<div class="form-group <?php echo (!empty($password_err)) ? 'has-error' : ''; ?>">
								<label>Κωδικός Πρόσβασης</label>
								<input type="password" name="password" class="form-control">
								<span class="help-block"><?php echo $password_err; ?></span>
							</div>

							<div class="form-group">
								<input type="submit" class="btn btn-primary" value="ΣΥΝΔΕΣΗ">
							</div>

				<p>Δεν έχετε εγγραφεί ακόμη?! <a href="register.php">Εγγραφείτε τώρα!</a></p>
						</form>

<div class="text-right"><i><a href="forgot-password.html">Ξέχασα το συνθηματικό μου...</i></a></div>

					</div> 
				</div>
			</div>
	</section>
	<!-- Footer -->
	<?php require "templates/footer.php";?>
</body>
</html>