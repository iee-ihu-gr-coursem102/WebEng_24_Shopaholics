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

<style>
    #listoflists_collapsable {

        display: flex;
        flex-wrap: wrap;
        flex-direction: row;
        justify-content: center;
        text-align: center;
    }
</style>
<body id="top" onload="fetch_user_lists(<?php echo ($_SESSION['user_id']);?>, 1), user_profile(<?php echo ($_SESSION['user_id']);?>)"> 
<!--onload="checkUser()"-->
		<!-- Header -->
<div class="wrapper" style="height:100px;">
	<div class="align-center">
		<header id="header" class="skel-layers-fixed" style="display:flex; flex-direction:row; flex-wrap:nowrap; justify-content:center; align-items:center; height:100px;">
			<h1 class="align-center" style="padding: 5px" ><a href="index.php"><img src="images/main_logo.png" width="90px"></a></h1>
			<span style="width:25px;"></span>
			<div id="user_profile" ></div>
            <span style="width:25px;"></span>
			<button class="button" style="width: 175px; height: 50px" onclick="logout()">ΑΠΟΣΥΝΔΕΣΗ</button>
            <span style="width:25px;"></span>
            <a href="contact_form.html">
                <button class="button" style="width: 175px; height: 50px">ΕΠΙΚΟΙΝΩΝΙΑ</button>
            </a>

		</header>
	</div>		
</div>

<div style="display: flex; justify-content: center">
    <div class="box" style="width: 600px; text-align: center; align-content: center" >

        <button class="button" onclick="select_lists()" style="margin: 0px 5px 10px 0px">ΕΠΙΛΟΓΕΣ ΛΙΣΤΩΝ</button>

        <button class="button" onclick="addNewListColapse()" style="margin: 0px 5px 10px 0px">ΝΕΑ ΛΙΣΤΑ</button>

        <button id="archive_toggle" class="button Active_Lists" onclick="archive_toggle()" style="margin: 0px 5px 10px 0px">ΕΝΕΡΓΕΣ ΛΙΣΤΕΣ</button>

        <div id="listoflists_collapsable" ></div>
    </div>
</div>


<!-- Footer -->
<?php require "templates/footer.php";?>
 </body>
</html>