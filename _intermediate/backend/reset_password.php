<?php

// Initialize the session
session_start(); 
// Check if the user is already logged in, if yes then redirect him to welcome page
if(isset($_SESSION["loggedin"]) && $_SESSION["loggedin"] === true){
  header("location: index.php");
  exit;
}
// Define variables and initialize with empty values
$username = "";
$username_err = "";
$permission = "";
require "templates/header.php";?>

<!-- Header -->
<!--header id="header" class="skel-layers-fixed center">
	<h1><a href="login.php"><img src="images/main_logo.png" width="200" height="90"></a></h1>
</header-->

    <section id="one" class="wrapper style1">
		<header class="major">
			<h2><a href="login.php"><img src="images/main_logo.png" width="200" height="90"></a></h2>
				<h3><p>Παρακαλώ εισάγετε το e-mail που έχετε δηλώσει για να προχωρήσετε.</p></h3>
		</header>
			<div class="container">
				<div class="row">
					<div class="12u">
						<form action="create_token.php" method="post">
							<div class="form-group <?php echo (!empty($username_err)) ? 'has-error' : ''; ?>">
								<label>E-mail Χρήστη</label>
								<input type="email" name="email" class="form-control" value="<?php echo $username; ?>">
								<span class="help-block"><?php echo $username_err; ?></span>
								</br>		
								<input type="submit" class="btn btn-primary" value="RESET">
							</div>

				<p>Δεν έχετε εγγραφεί ακόμη?! <a href="register.php">Εγγραφείτε τώρα!</a></p>
						</form>

					</div> 
				</div>
			</div>
	</section>
	<!-- Footer -->
	<?php require "templates/footer.php";?>
</body>
</html>