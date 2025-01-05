<?php
<<<<<<< HEAD
error_reporting(E_ALL);
ini_set('display_errors', 1);

=======
>>>>>>> 2a6dd2f9fb89d45e29ab2928258317f463468f77
// Include config file
require_once "config.php";

// Define variables and initialize with empty values
<<<<<<< HEAD
$name = $surname = $username = $password = $confirm_password = "";
$name_err = $surname_err = $username_err = $password_err = $confirm_password_err = "";

// Processing form data when the form is submitted
if ($_SERVER["REQUEST_METHOD"] == "POST") {

    // Validate name
    if (empty(trim($_POST["name"]))) {
        $name_err = "Παρακαλώ δώστε όνομα χρήστη.";
    } else {
        $name = trim($_POST["name"]);
    }

    // Validate surname
    if (empty(trim($_POST["surname"]))) {
        $surname_err = "Παρακαλώ δώστε επώνυμο χρήστη.";
    } else {
        $surname = trim($_POST["surname"]);
    }

    // Validate username
    if (empty(trim($_POST["email"]))) {
        $username_err = "Παρακαλώ δώστε e-mail χρήστη.";
    } else {
        // Prepare a select statement
        $sql = "SELECT email FROM users WHERE email = ?";
        if ($stmt = mysqli_prepare($link, $sql)) {
            mysqli_stmt_bind_param($stmt, "s", $param_username);

            // Set parameters
            $param_username = trim($_POST["email"]);

            // Execute the statement
            if (mysqli_stmt_execute($stmt)) {
                mysqli_stmt_store_result($stmt);
                if (mysqli_stmt_num_rows($stmt) == 1) {
                    $username_err = "Αυτό το e-mail υπάρχει ήδη.";
                } else {
                    $username = trim($_POST["email"]);
                }
            } else {
                echo "Ωπ! Κάτι στράβωσε. Παρακαλώ δοκιμάστε ξανά.";
            }
        }
        mysqli_stmt_close($stmt);
    }

    // Validate password
    if (empty(trim($_POST["password"]))) {
        $password_err = "Παρακαλώ δώστε ένα συνθηματικό.";
    } elseif (strlen(trim($_POST["password"])) < 8) {
        $password_err = "Το συνθηματικό πρέπει να αποτελείται από τουλάχιστον 8 χαρακτήρες.";
    } else {
        $password = trim($_POST["password"]);
    }

    // Validate confirm password
    if (empty(trim($_POST["confirm_password"]))) {
        $confirm_password_err = "Παρακαλώ επιβεβαιώστε το συνθηματικό.";
    } else {
        $confirm_password = trim($_POST["confirm_password"]);
        if (empty($password_err) && ($password != $confirm_password)) {
            $confirm_password_err = "Τα συνθηματικά δεν ταιριάζουν.";
        }
    }

    // Check input errors before inserting in the database
    if (empty($name_err) && empty($surname_err) && empty($username_err) && empty($password_err) && empty($confirm_password_err)) {
        // Prepare an insert statement
        $sql = "INSERT INTO users (name, surname, email, password) VALUES (?, ?, ?, ?)";
        if ($stmt = mysqli_prepare($link, $sql)) {
            mysqli_stmt_bind_param($stmt, "ssss", $param_name, $param_surname, $param_username, $param_password);

            // Set parameters
            $param_name = $name;
            $param_surname = $surname;
            $param_username = $username;
            $param_password = password_hash($password, PASSWORD_DEFAULT);

            // Attempt to execute the statement
            if (mysqli_stmt_execute($stmt)) {
                header("location: login.php");
            } else {
                echo "Ωπ! Κάτι στράβωσε. Παρακαλώ δοκιμάστε ξανά.";
            }
        }
        mysqli_stmt_close($stmt);
    }

=======
$username = $password = $confirm_password = "";
$username_err = $password_err = $confirm_password_err = "";
 
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
                /* store result */
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
        $sql = "INSERT INTO users (email, password) VALUES (?, ?)";
         
        if($stmt = mysqli_prepare($link, $sql)){
            // Bind variables to the prepared statement as parameters
            mysqli_stmt_bind_param($stmt, "ss", $param_username, $param_password);
            
            // Set parameters
            $param_username = $username;
            $param_password = password_hash($password, PASSWORD_DEFAULT); // Creates a password hash
            
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
    
>>>>>>> 2a6dd2f9fb89d45e29ab2928258317f463468f77
    // Close connection
    mysqli_close($link);
}
?>
<<<<<<< HEAD

=======
 
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
<header id="header" class="skel-layers-fixed">
	<h1><a href="login.php"><img src="images/deddie_logo.jpg" width="100" height="50"></a></h1>
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
							<span class="help-block"><?php echo $username_err; ?></span>
							</br>
						</div>    
						<div class="form-group <?php echo (!empty($password_err)) ? 'has-error' : ''; ?>">
							<label>Κώδικός</label>
							<input type="password" name="password" class="form-control" value="<?php echo $password; ?>">
							<span class="help-block"><?php echo $password_err; ?></span>
							</br>
						</div>
						<div class="form-group <?php echo (!empty($confirm_password_err)) ? 'has-error' : ''; ?>">
							<label>Επιβεβαίωση Κωδικού</label>
							<input type="password" name="confirm_password" class="form-control" value="<?php echo $confirm_password; ?>">
							<span class="help-block"><?php echo $confirm_password_err; ?></span>
							</br>
						</div>
						<div class="form-group">
							<input type="submit" class="btn btn-primary" value="Υποβολη">
							<input type="reset" class="btn btn-default" value="Καθαρισμος">
						</div>
						</br>
						<p>Έχετε ήδη λογαριασμό? <a href="login.php">Συνδεθείτε εδώ</a>.</p>
					</form>
					</div> 
				</div>
			</div>
	</section>
	<!-- Footer -->
	<?php require "templates/footer.php";?>
</body>
</html>
>>>>>>> 2a6dd2f9fb89d45e29ab2928258317f463468f77
