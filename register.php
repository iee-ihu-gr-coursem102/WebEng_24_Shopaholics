<?php
// Include config file
require_once "config.php";

// Define variables and initialize with empty values
$username = $password = $confirm_password = "";
$username_err = $password_err = $confirm_password_err = "";
$fname = $surname = "";
 
// Processing form data when form is submitted
if($_SERVER["REQUEST_METHOD"] == "POST"){

    // Validate username
    if(empty(trim($_POST["email"]))){
        $username_err = "Παρακαλώ δώστε e-mail χρήστη.";
    } else{
        // Prepare a select statement
        $sql = "SELECT email FROM users WHERE email = ?";
        
        if($stmt = mysqli_prepare($link, $sql)){
            // Bind variables to the prepared statement as parameters
            mysqli_stmt_bind_param($stmt, "s", $param_username);
            
            // Set parameters
            $param_username = trim($_POST["email"]);
            
            // Attempt to execute the prepared statement
            if(mysqli_stmt_execute($stmt)){
                //store result
                mysqli_stmt_store_result($stmt);
                
                if(mysqli_stmt_num_rows($stmt) == 1){
                    $username_err = "Αυτό το όνομα χρήστη υπάρχει ήδη.";
                } else{
                    $username = trim($_POST["email"]);
                }
            } else{
                echo "Ωπ! Κάτι στράβωσε. Παρακαλώ δοκιμάστε ξανά.";
            }
        }
         
        // Close statement
        mysqli_stmt_close($stmt);
    }
    
    // Validate password
    if(empty(trim($_POST["password"]))){
        $password_err = "Παρακαλώ δώστε ένα συνθηματικό.";     
    } elseif(strlen(trim($_POST["password"])) < 8){
        $password_err = "Το συνθηματικό πρέπει να αποτελείται από τουλάχιστον 8 χαρακτήρες.";
    } else{
        $password = trim($_POST["password"]);
    }
    
    // Validate confirm password
    if(empty(trim($_POST["confirm_password"]))){
        $confirm_password_err = "Παρακαλώ επιβεβαιώστε το συνθηματικό.";     
    } else{
        $confirm_password = trim($_POST["confirm_password"]);
        if(empty($password_err) && ($password != $confirm_password)){
            $confirm_password_err = "Τα συνθηματικά δεν ταιριάζουν.";
        }
    }
    
    // Check input errors before inserting in database
    if(empty($username_err) && empty($password_err) && empty($confirm_password_err)){
        
        // Prepare an insert statement
        $sql = "INSERT INTO users (email, password, name, surname) VALUES (?, ?, ?, ?)";
         
        if($stmt = mysqli_prepare($link, $sql)){
            // Bind variables to the prepared statement as parameters
            mysqli_stmt_bind_param($stmt, "ssss", $param_username, $param_password, $param_name, $param_surname);
            
            // Set parameters
            $param_username = $username;
            $param_password = password_hash($password, PASSWORD_DEFAULT); // Creates a password hash
            $param_name = $_POST['fname'];
            $param_surname = $_POST['surname'];
            
            // Attempt to execute the prepared statement
            if(mysqli_stmt_execute($stmt)){
                // Redirect to login page
                header("location: login.php");
            } else{
                echo "Ωπ! Κάτι στράβωσε. Παρακαλώ δοκιμάστε ξανά.";
            }
        }
         
        // Close statement
        mysqli_stmt_close($stmt);
    }
    
    // Close connection
    mysqli_close($link);
}
?>
 
<!DOCTYPE html>
<html lang="en">
<head>
	<meta http-equiv="content-type" content="text/html; charset=utf-8" />
	<meta name="description" content="" />
	<meta name="keywords" content="" />
	<!--[if lte IE 8]><script src="js/html5shiv.js"></script><![endif]-->
	<script src="js/jquery.min.js"></script>
	<script src="js/skel.min.js"></script>
	<script src="js/skel-layers.min.js"></script>
	<script src="js/init.js"></script>
	<noscript>
		<link rel="icon" type="image/png" href="/images/icon.png" />
		<link rel="stylesheet" href="css/skel.css" />
		<link rel="stylesheet" href="css/style.css" />
		<link rel="stylesheet" href="css/style-xlarge.css" />
	</noscript>
</head>    
    <title>Sign Up</title>
    <!-- Header -->
<header class="major">
			<h2><a href="login.html"><img src="images/main-logo.svg" height="200px"></a></h2>
</header>
</head>
<body>
    <section id="one" class="wrapper style1">
		<header class="major">
			<h2>Εγγραφή</h2>
				<h3><p>Συμπληρώστε παρακαλώ τα παρακάτω πεδία.</p></h3>
		</header>
			<div class="container">
				<div class="row">
					<div class="12u">
					<form action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>" method="post">
						<div class="form-group <?php echo (!empty($username_err)) ? 'has-error' : ''; ?>">
							<label>e-mail Χρήστη</label>
							<input type="email" name="email" class="form-control" value="<?php echo $username; ?>">
							<span class="help-block" style="color:red"><?php echo $username_err; ?></span>
							</br>
						</div>
                        <div class="form-group">
                            <label>Όνομα</label>
                            <input type="text" name="fname" class="form-control" value="<?php echo $fname; ?>">
                            <span class="help-block"></span>
                            </br>
                        </div>
                        <div class="form-group">
                            <label>Επώνυμο</label>
                            <input type="text" name="surname" class="form-control" value="<?php echo $surname; ?>">
                            <span class="help-block"></span>
                            </br>
                        </div>
                        <div class="form-group <?php echo (!empty($password_err)) ? 'has-error' : ''; ?>">
							<label>Κωδικός</label>
							<input type="password" name="password" class="form-control" value="<?php echo $password; ?>">
							<span class="help-block" style="color:red"><?php echo $password_err; ?></span>
							</br>
						</div>
						<div class="form-group <?php echo (!empty($confirm_password_err)) ? 'has-error' : ''; ?>">
							<label>Επιβεβαίωση Κωδικού</label>
							<input type="password" name="confirm_password" class="form-control" value="<?php echo $confirm_password; ?>">
							<span class="help-block" style="color:red"><?php echo $confirm_password_err; ?></span>
							</br>
						</div>
						<div class="form-group">
							<input type="submit" class="btn btn-primary" value="Υποβολη">
							<input type="reset" class="btn btn-default" value="Καθαρισμος">
						</div>
						</br>
						<p>Έχετε ήδη λογαριασμό? <a href="login.html">Συνδεθείτε εδώ</a>.</p>
					</form>
					</div> 
				</div>
			</div>
	</section>
	<!-- Footer -->
	<?php require "templates/footer.php";?>
</body>
</html>
