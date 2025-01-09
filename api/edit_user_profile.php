<?php
// Initialize the session
session_start();
// Check if the user is already logged in, if yes then redirect him to welcome page
if(!isset($_SESSION["loggedin"]) && $_SESSION["loggedin"] != true){
    header("location: login.php");
    exit;
}

require_once "../config.php";


$sql = "";

if (isset($_SESSION['user_id'])) {
    try {
        $connection = new PDO($dsn, $username, $password, $options);
        $user = $_SESSION['user_id'];

        $sql = "SELECT Name, Surname, email, picture FROM users 
					WHERE user_id=?;";

        $statement = $connection->prepare($sql);
        $statement->bindValue(1, $user, PDO::PARAM_INT);
        $statement->execute();
        $user_data = $statement->fetchAll(PDO::FETCH_ASSOC);
        $response = json_encode($user_data, JSON_UNESCAPED_UNICODE);

        //print_r($response);
        //print_r($user_data[0]);

    }catch(PDOException $error) {
        echo $sql . "<br>" . $error->getMessage();
    }
}

$username = $user_data[0]['email'];
$password = $confirm_password = "";
$fname = $user_data[0]['Name'];
$surname = $user_data[0]['Surname'];

// Processing form data when form is submitted
if($_SERVER["REQUEST_METHOD"] == "POST"){

    /*
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
                // store result
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
    }  */

    // Check input errors before inserting in database
    if(empty($confirm_password_err)){

        // Prepare an insert statement
        $sql = "UPDATE users 
                SET email = ?, name = ?, surname = ?
                WHERE user_id = ?";

        if($stmt = mysqli_prepare($link, $sql)){
            // Bind variables to the prepared statement as parameters
            mysqli_stmt_bind_param($stmt, "ssss", $param_username, $param_name, $param_surname, $param_user_id);

            // Set parameters
           /*
            if(!empty($_POST['email'])) {
                $param_username = $_POST['email'];
            }
            else {$param_username = $username;}
            if(!empty($_POST['fname'])) {
                $param_name = $_POST['fname'];
            }
            else {$param_name = $fname;}
            if(!empty($_POST['surname'])) {
                $param_surname = $_POST['surname'];
            }
            else {$param_surname = $surname;}
           */
            $param_username = $_POST['email'];
            $param_name = $_POST['fname'];
            $param_surname = $_POST['surname'];
            $param_user_id = $_SESSION['user_id'];

            // Attempt to execute the prepared statement
            if(mysqli_stmt_execute($stmt)){
                // Redirect to login page
                header("location: index.php");
            } else{
                echo "Ωπ! Κάτι στράβωσε. Παρακαλώ δοκιμάστε ξανά.";
            }
        }


        $password = trim($_POST["password"]);
        $confirm_password = trim($_POST["confirm_password"]);

        if(($password != $confirm_password)){
            $confirm_password_err = "Τα συνθηματικά δεν ταιριάζουν.";
        }

        if(empty($confirm_password_err) && !empty($password)) {
            $sql = "UPDATE users SET password = ? WHERE user_id = ?";

            if ($stmt = mysqli_prepare($link, $sql)) {
                mysqli_stmt_bind_param($stmt, "ss", $param_password, $param_user_id);

                $param_password = password_hash($password, PASSWORD_DEFAULT);
                $param_user_id = $_SESSION['user_id'];

                if (mysqli_stmt_execute($stmt)) {
                    header("location: index.php");

                } else {
                    echo "Ωπ! Κάτι στράβωσε. Παρακαλώ δοκιμάστε ξανά.";
                }
            }
        }

/*
        if(!empty($_POST['password']) && $_POST['password'] == $_POST['confirm_password']){
            $param_password = $_POST['password'];
        }
        else {$param_password = $password;}
*/

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
<title>Edit profile</title>
<!-- Header -->
<header id="header" class="skel-layers-fixed">
    <h1><a href="login.php"><img src="images/main-logo.svg height="110"></a></h1>
</header>
</head>
<body>
<section id="one" class="wrapper style1">
    <header class="major">
        <h2>Επεξεργασία προφίλ χρήστη</h2>
        <h3><p>Συμπληρώστε παρακαλώ τα παρακάτω πεδία.</p></h3>
    </header>
    <div class="container">
        <div class="row">
            <div class="12u">
                <form action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>" method="post">
                    <div class="form-group <?php echo (!empty($username_err)) ? 'has-error' : ''; ?>">
                        <label>e-mail Χρήστη</label>
                        <input type="email" name="email" class="form-control" value="<?php echo $username; ?>">
                        <span class="help-block"></span>
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
                    <div class="form-group ">
                        <label>Κωδικός</label>
                        <input type="password" name="password" class="form-control" value="<?php echo $password; ?>">
                        <span class="help-block"></span>
                        </br>
                    </div>
                    <div class="form-group ">
                        <label>Επιβεβαίωση Κωδικού</label>
                        <input type="password" name="confirm_password" class="form-control" value="<?php echo $confirm_password; ?>">
                        <span class="help-block"></span>
                        </br>
                    </div>
                    <div class="form-group">
                        <input type="submit" class="btn btn-primary" value="Υποβολη">
                        <input type="reset" class="btn btn-default" value="Καθαρισμος">
                    </div>
                    </br>

                </form>
            </div>
        </div>
    </div>
</section>
<!-- Footer -->
<?php require "templates/footer.php";?>
</body>
</html>
