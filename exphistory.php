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
if(!@$_SESSION['time']){
	$_SESSION['time']="empty";
}
if(!@$_SESSION['term']){
	$_SESSION['term']="empty";
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
<form method="POST" action="" class="headermenu" align="center">
<button class="menubtn" name="khoj">Khoj</button>
<button class="menubtn" name="profile">Profile</button>
<button class="menubtn" name="history">history</button>
<button class="menubtn" name="action">Logout</button>
</form>

<form  action="" method="POST">
  	 <table class="historytbl" align="center">
  	 		<tr>
          <th>SR.</th>
  	 			<th>Searched Activity</th>
  	 			<th>Time</th>
  	 		</tr>
  	 		<?php
                $con = mysqli_connect('localhost','root','','khojdb');
                $email=$_SESSION['email'];
                $query = "SELECT `term`,`time` FROM `history` WHERE `mail`='$email'"; 
                $result = mysqli_query($con, $query);
                $i=1;
                while($rows=$result->fetch_assoc())
                {
                  $termhistory = $rows['term'];
                  $timehistory = $rows['time'];
             ?>
          <tr>
            <td><?php echo "$i"; ?></td>
  	 			<td><?php echo "$termhistory"; ?></td>
  	 			<td><?php echo "$timehistory"; ?></td>
  	 		</tr>
  	 		<?php
        $i++;
        }
  	 		?>
  	 </table>
     <br>
     <br>
</form>
<form action="delete.php" method="POST" align="center">
<button class="del" name="del">Clear History</button>
</form>
</section>
</div>
</body>
</html>