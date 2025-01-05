<?php
// Initialize the session
session_start();
 
// Unset all of the session variables
$_SESSION = array();
 
// Destroy the session.
session_destroy();
 
// Redirect to login page
header("location: login.php");
exit;
<<<<<<< HEAD
?>
=======
?>
>>>>>>> 2a6dd2f9fb89d45e29ab2928258317f463468f77
