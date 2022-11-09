<?php 
session_start();
?>
<?php
$con = mysqli_connect('localhost','root','','khojdb');
if($_SESSION['user']=="exp"){
 $email=$_SESSION['email'];
 echo "$email";
 if(isset($_POST['del'])){
                $delquery = "DELETE FROM `history` WHERE `mail`='$email'"; 
                $resultdel = mysqli_query($con, $delquery);
                if($resultdel==true){
                echo "History is Cleared";
                }
                else{
                	exit("unable to delete data ! :(");
                }
            }
        }
        if($_SESSION['user']=="dev"){
 $dmail=$_SESSION['dmail'];
 echo "$dmail";
 if(isset($_POST['del'])){
                $delquery = "DELETE FROM `history` WHERE `mail`='$dmail'"; 
                $resultdel = mysqli_query($con, $delquery);
                if($resultdel==true){
                echo "History is Cleared";
                }
                else{
                	exit("unable to delete data ! :(");
                }
            }
        }
        if($_SESSION['user']=="dev"){
 $dmail=$_SESSION['dmail'];
 echo "$dmail";
 if(isset($_POST['cdel'])){
                $delquery = "DELETE FROM `flinks` WHERE `mail`='$dmail'"; 
                $resultdel = mysqli_query($con, $delquery);
                if($resultdel==true){
                echo " Consol History is Cleared";
                }
                else{
                    exit("unable to delete data ! :(");
                }
            }
        }
?>
<!DOCTYPE html>
<html>
<head>
	<title>DELETE THE USER HISTORY</title>
	<link rel="shortcut icon" type="image/jpg" href="assets/images/khojFavicon.png" />
</head>
<body>

</body>
</html>