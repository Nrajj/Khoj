<?php
session_start();
?>

<?php
if(@$_SESSION['user']=="dev"){
	if(!$_SESSION['dname']) {
	$_SESSION['dname']="Login";
 	if(isset($_POST['action'])) {
 	header("Location: login.php");
					}
						  }
}
?>

<?php
if(@$_SESSION['user']=="exp"){
    if(!$_SESSION['ename']) {
	$_SESSION['ename']="Login";
 	if(isset($_POST['action'])) {
 	header("Location: login.php");
					}
						  }
			}
?>
<!DOCTYPE html>
<html>
<head>
	<title>Khoj Karle Zara.</title>
	<link rel="shortcut icon" type="image/jpg" href="assets/images/khojFavicon.png" />
	<link rel="stylesheet" type="text/css" href="assets/css/style.css">
	<link rel="stylesheet" type="text/css" href="assets/css/userstyle.css">
</head>
<body>
	<form method="POST" action="" class="headermenu" align="center">
		<button class="menubtn" name="action"><?php 
			if(@$_SESSION['user']=="exp") {
				echo " Hi {$_SESSION['ename']}";
				if(isset($_POST['action'])){
				header("Location: expprofile.php");
					}
			}
			if(@$_SESSION['user']=="dev"){
				echo " Hi {$_SESSION['dname']}";
				if(isset($_POST['action'])){
				header("Location: devprofile.php");
					}
			}	
			if(@$_SESSION['user']!="dev" && @$_SESSION['user']!="exp"){	
			echo " Hi Login ";
			 if(isset($_POST['action'])) {
 				 header("Location: login.php");
					}
		}
			?></button>
		</form>
	<div class="wrapper indexPage">
	<div class="mainSection">
		<div class="logoContainer"> 
			<img src="assets\images\khojLogo.jpg" alt="khoj">
		 </div>
		 <div class="logoContainer"> 
			<img src="assets\images\KHOJtxt.png" alt="khojtxt">
		 </div>

		 <div class="searchContainer">
		 	<form action="search.php" method="GET">
		 	<input class="searchBox" type="text" name="term" autocomplete="off" placeholder="Enter Anything to Search ">
		 	<input name="sbtn" class="searchButton" type="submit" value="Search" >
		 	</form>
		 </div>
	</div>
</div>
</body>
</html>