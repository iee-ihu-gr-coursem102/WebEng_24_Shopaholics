<?php
// Initialize the session
session_start();

// Redirect if already logged in
if (isset($_SESSION["loggedin"]) && $_SESSION["loggedin"] === true) {
    header("location: ../index.php");
    exit;
}

// Include config file
require_once "../config.php";


// Initialize variables
$username = $password = "";
$username_err = $password_err = "";

// Process form submission
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Validate input
    $username = trim($_POST["email"] ?? "");
    $password = trim($_POST["password"] ?? "");

    if (empty($username)) {
        $username_err = "Εισάγετε e-mail χρήστη.";
    }
    if (empty($password)) {
        $password_err = "Εισάγετε κωδικό πρόσβασης.";
    }

    // If no errors, validate credentials
    if (empty($username_err) && empty($password_err)) {
        $sql = "SELECT user_id, email, password FROM users WHERE email = ?";
        if ($stmt = mysqli_prepare($link, $sql)) {
            mysqli_stmt_bind_param($stmt, "s", $param_username);
            $param_username = $username;

            if (mysqli_stmt_execute($stmt)) {
                mysqli_stmt_store_result($stmt);
                if (mysqli_stmt_num_rows($stmt) == 1) {
                    mysqli_stmt_bind_result($stmt, $id, $username, $hashed_password);
                    if (mysqli_stmt_fetch($stmt) && password_verify($password, $hashed_password)) {
                        session_start();
                        $_SESSION["loggedin"] = true;
                        $_SESSION["user_id"] = $id;
                        $_SESSION["email"] = $username;
                        print_r($_SESSION);
                        header("location: ../index.php");
                        exit;
                    } else {
                        $password_err = "Ο κωδικός πρόσβασης που δώσατε δεν είναι σωστός.";
                        echo json_encode($password_err, JSON_UNESCAPED_UNICODE);
                        //echo ($password_err);
                        //sleep(2);
                        header("location: ../index.php");

                    }
                } else {

                    $username_err = "Δεν βρέθηκε λογαριασμός με αυτό το όνομα χρήστη.";
                    echo $username_err;
                    header("location: ../index.php");
                }
            } else {
                header("location: ../index.php");
                echo "Κάτι πήγε λάθος! Παρακαλώ προσπαθήστε ξανά αργότερα.";
            }
        }
        mysqli_stmt_close($stmt);
    }
    mysqli_close($link);
}

