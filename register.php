<?php
error_reporting(E_ALL);
ini_set('display_errors', 1);

// Include config file
require_once "config.php";

// Define variables and initialize with empty values
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

    // Close connection
    mysqli_close($link);
}
?>

