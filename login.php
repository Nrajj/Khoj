<?php
include("config.php");
?>
<?php
session_start();
?>
<?php
$con = mysqli_connect('localhost','root','','khojdb');

  if(isset($_POST['submit'])){
  $password= $_POST['pass'];
  $email = $_POST['email'];
  $user = $_POST['users'];

  if($user === "exp"){
  $emailquery = "SELECT * FROM `exp` WHERE `email`='$email' AND `epass`= '$password'"; 
  $query = mysqli_query($con, $emailquery);

    if(mysqli_num_rows($query) == 1){
      $result = mysqli_fetch_assoc($query);
      $_SESSION['username']= $result['ename'];
      $_SESSION['ename']=$_SESSION['username'];
      $_SESSION['email']= $result['email'];
      $_SESSION['user']= "exp";
      echo '<script>alert("Login Successful")</script>';
      header("Location: index.php");
                                    }
     else {
     echo '<script>alert("Login Failed, Details Mismatched")</script>';
          }
                     }
    if($user === "dev"){
  $dmailquery = "SELECT * FROM `devo` WHERE `dmail`='$email' AND `dpass`= '$password'"; 
  $query = mysqli_query($con, $dmailquery);

    if(mysqli_num_rows($query) == 1){
      $result = mysqli_fetch_assoc($query);
      $_SESSION['username']= $result['dname'];
      $_SESSION['dname']=$_SESSION['username'];
      $_SESSION['dmail']= $result['dmail'];
      $_SESSION['user']= "dev";
    echo " {$_SESSION['username']} has been Login Successful, Start Contributing !";
    header("Location: index.php");
                                    }
  else {
   echo '<script>alert("Login Failed, Details Mismatched")</script>';
       }
                      }
}
?>

<html>
<head>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<title>Login form </title>
<link rel="shortcut icon" type="image/jpg" href="assets/images/khojFavicon.png" />
<link rel="stylesheet" type="text/css" href="assets/css/userstyle.css">
</head>
<body>
  <div class ="hero">
  <section class="login-page">
  	 <form action="login.php" method="POST">
  	 	 <div class="box">
  	 	 	   <div class="form-head">
  	 	 	   	  <h2>Member Login</h2>
  	 	 	   </div>
  	 	 	   <div class="form-body">
  	 	 	   	  <input type="email" name="email" placeholder="Enter email" required />
  	 	 	   	  <input type="Password" name="pass"  placeholder="Password" required />
              <select name="users" class="select-css">
                <option value="exp">Explorer</option>
                  <option value="dev">Developer</option>
              </select>
           </div>
           <br>
  	 	 	   <div class="form-footer">
  	 	 	   	  <button name="submit" type="submit">Sign In</button><br><br>
              <h4>New User <a href="register.php">Sign Up</a></h4>
  	 	 	   </div>
  	 	 </div>
  	 </form>
  </section>
</div>
</body>
</html>