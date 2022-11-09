<?php
include("config.php");
?>
<?php
$con = mysqli_connect('localhost','root','','khojdb');

  if(isset($_POST['submit'])){
  $username= $_POST['name'];
  $password= $_POST['pass'];
  $email = $_POST['email'];
  $cpassword= $_POST['cpass'];
  $user = $_POST['users'];

 if($user === "exp"){
$emailquery = "SELECT * FROM `exp` WHERE ename='$username' OR email='$email' "; 
$query = mysqli_query($con, $emailquery);
 
 if(mysqli_num_rows($query) > 0){
  echo "email already exist";
 }
 else {
  if($password===$cpassword){
    $insertquery = "INSERT INTO `exp`(`ename`,`email`,`epass`) values('$username','$email','$password')";
    $iquery= mysqli_query($con, $insertquery);
    echo "Signup Successful, Login to Your Account !";
    header("Location: login.php");
  }
  else {
    echo "password mismatch";
  }
 }
}

 if($user === "dev"){
$dmailquery = "SELECT * FROM `devo` WHERE `dmail` = '$email' ";
$query = mysqli_query($con, $dmailquery);
$emailcount = mysqli_num_rows($query);
 if($emailcount >0){
  echo "email already exist";
 }
 else {
  if($password===$cpassword){
    $insertquery = "INSERT INTO `devo`(`dname`,`dmail`,`dpass`) values('$username','$email','$password')";
    $iquery= mysqli_query($con, $insertquery);
    echo "Signup Successful, Login to Your Account !";
    header("Location: login.php");
  }
  else {
    echo "password mismatch";
  }
 }
}

}
?>

<html>
<head>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<title>Sign Up form</title>
<link rel="shortcut icon" type="image/jpg" href="assets/images/khojFavicon.png" />
<link rel="stylesheet" type="text/css" href="assets/css/userstyle.css">
</head>
<body>
  <div class ="hero">
  <section class="login-page">
  	 <form action="register.php" method="POST">
  	 	 <div class="box">
  	 	 	   <div class="form-head">
  	 	 	   	  <h2>New Member </h2>
  	 	 	   </div>
  	 	 	   <div class="form-body">
  	 	 	   	  <input type="text" name="name" placeholder="Enter name" required />
              <input type="email" name="email" placeholder="Enter email" required />
  	 	 	   	  <input type="Password" name="pass" placeholder="Password" required />
              <input type="Password" name="cpass" placeholder="Confirm Password" required />
              <select name="users" class="select-css">
                <option value="exp">Explorer</option>
                  <option value="dev">Developer</option>
              </select>
  	 	 	   </div>
           <br>
  	 	 	   <div class="form-footer">
  	 	 	   	  <button name="submit" type="submit">Sign Up</button><br><br>
              <h4>Existing User <a href="login.php">Sign In</a></h4>
  	 	 	   </div>
  	 	 </div>
  	 </form>
  </section>
</div>
</body>
</html>