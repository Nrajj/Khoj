<?php
session_start();
$_SESSION['url']="";
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
$con = mysqli_connect('localhost','root','','khojdb');
    if(isset($_POST['addurl'])){
    $newurl= $_POST['newurl'];
    $_SESSION['url']=$newurl;
    $dmail = $_SESSION['dmail'];
    $fdate = date("Y-m-d h:i:sa");
  	$dmailquery = "INSERT INTO `flinks`(`mail`,`flink`,`fdate`) VALUES('$dmail','$newurl','$fdate') "; 
    $query = mysqli_query($con, $dmailquery);
      header("Location: crawl.php?cnno=".$cnno."&copies=".$nocopy."', '_blank'");
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
<div>
		<form action="" method="POST">
  	 	 <div class="box">
  	 	 	   <div class="form-head">
  	 	 	   	  <h2>Update Account Details </h2>
  	 	 	   </div>
  	 	 	   <div class="form-body">
  	 	 	   	  <input type="text" name="newurl" placeholder="https://www.xyz.com"  />
  	 	 	   </div>
           <br>
  	 	 	   <div class="form-footer">
            <a href="crawl.php" target="_blank"><button name="addurl" type="submit">Start Crowl</button></a>
  	 	 	   </div>
  	 	 </div>
  	 	</form>
</div>
      <form  action="" method="POST">
     <table class="historytbl" align="center">
        <tr>
          <th>SR.</th>
          <th>Crawled Activity</th>
          <th>Time</th>
        </tr>
        <?php
                $con = mysqli_connect('localhost','root','','khojdb');
                $dmail=$_SESSION['dmail'];
                $query = "SELECT `flink`,`fdate` FROM `flinks` WHERE `mail`='$dmail'"; 
                $result = mysqli_query($con, $query);
                $i=1;
                while($rows=$result->fetch_assoc())
                {
                  $urlhistory = $rows['flink'];
                  $timehistory = $rows['fdate'];
             ?>
          <tr>
            <td><?php echo "$i"; ?></td>
          <td><?php echo "$urlhistory"; ?></td>
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
<button class="del" name="cdel">Clear Consol History</button>
</form>
  </section>
</div>
</body>
</html>