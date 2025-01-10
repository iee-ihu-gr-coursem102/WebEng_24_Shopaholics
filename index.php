<?php
// Initialize the session
session_start(); 
// Check if the user is already logged in, if yes then redirect him to welcome page
if(!isset($_SESSION["loggedin"]) && $_SESSION["loggedin"] != true){
  header("location: frontend/login.html");
  exit;
}
?>

<?php require "templates/header.php";?>

<?php require "frontend/index.html";?>

<!-- Footer -->
<?php require "templates/footer.php";?>

