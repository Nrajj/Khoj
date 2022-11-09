<?php
session_start();
?>
<?php
if (isset($_POST['action'])) {
	session_destroy();
	header("Location: login.php");
}
if (isset($_POST['profile'])) {
	header("Location: expprofile.php");
}
if (isset($_POST['history'])) {
	header("Location: exphistory.php");
}
if (isset($_POST['khoj'])) {
	header("Location: index.php");
}
if(!$_SESSION['email']){
echo "Hello Echo is this";
}
?>

<?php
$con = mysqli_connect('localhost','root','','khojdb');

  if(isset($_POST['update'])){
  $password= $_POST['pass'];
  $cpassword=$_POST['cpass'];
  $ename = $_POST['name'];
  $email = $_SESSION['email'];

  if($password==$cpassword){
  	$emailquery = "UPDATE `exp` SET `ename`='$ename', `epass`='$password' WHERE `email`='$email'"; 
    $query = mysqli_query($con, $emailquery);
    echo '<script>alert("Details Updated")</script>';
  }
  else {
    echo '<script>alert("Details Not Updated")</script>';
 }
}
?>
<!DOCTYPE html>
<html>
<head>
<title><?php echo "Welcome {$_SESSION['username']}"; ?></title>
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
<button class="menubtn" name="history">history</button>
<button class="menubtn" name="action">Logout</button>
</form>

		<form action="" method="POST">
  	 	 <div class="box">
  	 	 	   <div class="form-head">
  	 	 	   	  <h2>Update Account Details </h2>
  	 	 	   </div>
  	 	 	   <div class="form-body">
  	 	 	   	  <input type="text" name="name" value="<?php echo "{$_SESSION['username']}"; ?>" />
              <input type="email" name="email" value="<?php echo "{$_SESSION['email']}"; ?>" readonly />
  	 	 	   	  <input type="Password" name="pass" placeholder="Enter Password or New"  />
              <input type="Password" name="cpass" placeholder="Confirm Password"  />
              <select name="users" class="select-css">
                <option value="exp">Explorer</option>
              </select>
  	 	 	   </div>
           <br>
  	 	 	   <div class="form-footer">
  	 	 	   	  <button name="update" type="submit">Update</button><br>
  	 	 	   	  <h4>Input only that deatils which are required to update,Email Cant Be Updated ! </h4>
  	 	 	   </div>
  	 	 </div>
  	 	</form>
  </section>
</div>
</body>
</html>