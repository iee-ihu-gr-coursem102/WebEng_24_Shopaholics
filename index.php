<?php
// Initialize the session
session_start(); 
// Check if the user is already logged in, if yes then redirect him to welcome page
if(!isset($_SESSION["loggedin"]) && $_SESSION["loggedin"] != true){
  header("location: login.php");
  exit;
}
?>
<?php require "templates/header.php";?>

<body id="top" onload="fetch_user_lists(<?php echo ($_SESSION['user_id']);?>, 1), user_profile(<?php echo ($_SESSION['user_id']);?>)"> 
<!--onload="checkUser()"-->
		<!-- Header -->
<div class="wrapper" style="height:100px;">		
	<div class="align-center">
		<header id="header" class="skel-layers-fixed" style="display:flex; flex-direction:row; flex-wrap:nowrap; justify-content:center; align-items:center; height:100px;">
			<h1 class="align-center" ><a href="index.php"><img src="images/main_logo.png" width="100"></a></h1>
			<span style="width:40px;"></span>
			<div id="user_profile" ></div>
			<span style="width:40px;"></span>
			<button class="button" onclick="logout()">Log Out</button>
		</header>
	</div>		
</div>

<div class="box">

	<button class="button" onclick="select_lists()">List Options</button>
	
	<button class="button" onclick="addNewListColapse()">ΝΕΑ ΛΙΣΤΑ</button>
	
	<span style="width:40px;"></span>
	<button class="button" onclick="archived()" style="fa fa-archive">Archived Lists</button>

<div id="listoflists_collapsable" style="width: 100px; display: grid;"></div>
</div>
 </body>
</html>