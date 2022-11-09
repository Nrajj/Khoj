<?php
session_start();
?>
<?php
if (isset($_POST['daction'])) {
	session_destroy();
	header("Location: login.php");
}
if (isset($_POST['profile'])) {
	header("Location: devprofile.php");
}
if (isset($_POST['consol'])) {
  header("Location: consol.php");
}
if (isset($_POST['history'])) {
	header("Location: devhistory.php");
}
if (isset($_POST['khoj'])) {
	header("Location: index.php");
}
if(!@$_SESSION['dmail']){
echo "Hello Echo is this";
}
?>

<?php
  if(isset($_POST['update'])){
  $password= $_POST['pass'];
  $cpassword=$_POST['cpass'];
  $dname = $_POST['dname'];
  $dmail = $_SESSION['dmail'];

  if($password==$cpassword){
    $con = mysqli_connect('localhost','root','','khojdb');
  	$dmailquery = "UPDATE `devo` SET `dname`='$dname', `dpass`='$password' WHERE `dmail`='$dmail'";
    $query=mysqli_query($con,$dmailquery);
    $fetchquery= "SELECT `dname` FROM `devo` WHERE `dmail`='$dmail'";
    $result=mysqli_query($con,$fetchquery);
    echo '<script>alert("Details Updated, We be visible on Re-Login")</script>';

  }
  else {
  	echo '<script>alert("Details Not Updated")</script>';
}
}
?>
<!DOCTYPE html>
<html>
<head>
<title><?php echo "Welcome {$_SESSION['dname']}"; ?></title>
<link rel="shortcut icon" type="image/jpg" href="assets/images/khojFavicon.png" />
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<title>Login form </title>
<link rel="stylesheet" type="text/css" href="assets/css/userstyle.css">
</head>
<body>
	<div class ="hero">
<section class="login-page">
<form align="center" method="POST" action="" class="headermenu">
<button class="menubtn" name="khoj">Khoj</button>
<button class="menubtn" name="profile">Profile</button>
<button class="menubtn" name="consol">Consol</button>
<button class="menubtn" name="history">history</button>
<button class="menubtn" name="daction">Logout</button>
</form>

		<form action="" method="POST">
  	 	 <div class="box">
  	 	 	   <div class="form-head">
  	 	 	   	  <h2>Update Account Details </h2>
  	 	 	   </div>
  	 	 	   <div class="form-body">
  	 	 	   	  <input type="text" name="dname" value="<?php 
              echo "{$_SESSION['dname']}"; ?>" />
              <input type="email" name="dmail" value="<?php echo "{$_SESSION['dmail']}"; ?>" readonly />
  	 	 	   	  <input type="Password" name="pass" placeholder="Enter Password or New" required />
              <input type="Password" name="cpass" placeholder="Confirm Password" required />
              <select name="users" class="select-css">
                <option value="dev">Developer</option>
              </select>
  	 	 	   </div>
           <br>
  	 	 	   <div class="form-footer">
  	 	 	   	  <button name="update" type="submit">Update</button><br>
  	 	 	   	  <h4>Email Cant Be Updated ! </h4>
  	 	 	   </div>
  	 	 </div>
  	 	</form>
  </section>
</div>
</body>
</html>