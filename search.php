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

<?php
include("config.php");
include("classes/siteresultprovider.php");
include("classes/ImageResultsProvider.php");
?>
<?php
	if(isset($_GET["term"])&& $_GET['term']==true){
	$term= $_GET["term"];	
		}
	else{
		exit("You must enter a search term");
	}

$type= isset($_GET["type"]) ? $_GET["type"]: "sites";
$page= isset($_GET["page"]) ? $_GET["page"]: 1;

?> 
<?php

if(isset($_GET['term']) && $_GET['term']==true ){
	$termh= $_GET['term'];
	$_SESSION['term']=$termh;
	$date=date("Y-m-d h:i:sa");
	$_SESSION['time']=date("Y-m-d h:i:sa");
	if(@$_SESSION['user'] == "exp"){
	   $email=$_SESSION['email'];
		$conn = mysqli_connect('localhost','root','','khojdb');
		$iquery= "INSERT INTO `history`(`mail`,`term`,`time`) VALUES('$email','$termh','$date')";
		$result= mysqli_query($conn, $iquery);
	}
	if(@$_SESSION['user'] == "dev"){
	    $email=$_SESSION['dmail'];
		$conn = mysqli_connect('localhost','root','','khojdb');
		$iquery= "INSERT INTO `history`(`mail`,`term`,`time`) VALUES('$email','$termh','$date')";
		$result= mysqli_query($conn, $iquery);
	}
}
?>
<!DOCTYPE html>
<html>
<head>
	<title>Khoj Karle Zara.</title>
	<link rel="shortcut icon" type="image/jpg" href="assets/images/khojFavicon.png" />
	<link rel="stylesheet" href="https://cdn.jsdelivr.net/gh/fancyapps/fancybox@3.5.7/dist/jquery.fancybox.min.css" />
	<link rel="stylesheet" type="text/css" href="assets/css/style.css">
	<link rel="stylesheet" type="text/css" href="assets/css/userstyle.css">
	<script 
  src="https://code.jquery.com/jquery-3.5.1.min.js"
  integrity="sha256-9/aliU8dGd2tb6OSsuzixeV4y/faTqgFtohetphbbj0="
  crossorigin="anonymous">
	</script>

</head>
<body>
<div class="wrapper">
	<div class="header">
		
		<div class="headerContent">
		<div class="logoContainer"> 
			<a href="index.php">
			<img src="assets\images\KHOJtxt.png" alt="khoj">
			</a>
		</div>
		
		<div class="searchContainer"> 
			<form action="search.php" method="GET">
				<div class="searchBarContainer">

					<input type="hidden" name="type" value="<?php echo $type; ?>">

					<input class="searchBox" type="text" name="term" value="<?php echo $term; ?>">
					<button name="searchbtn" class="searchButton">
						<img src="assets\images\icons\search.png">
					</button>
				</div>
			</form>
		</div>
	<form method="POST" action="" class="headermenu" align="right">
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
		</div>
	<div class="tabsContainer">
		<ul class="tabList">
			<li class="<?php echo $type == 'sites' ? 'active' : '' ?>">
				<a href='<?php echo "search.php?term=$term&type=sites"; ?>'>
					Sites
				</a>
			</li>
			<li class="<?php echo $type == 'images' ? 'active' : '' ?>">
				<a href='<?php echo "search.php?term=$term&type=images"; ?>' >
					Images
				</a>
			</li>
		</ul>

	</div>
	</div>

	<div class="mainResultsSection">
		
		<?php

		if($type == "sites") {
			$resultsProvider = new SiteResultsProvider($con);
		$pageSize = 8;
		}
		else {

		$resultsProvider = new ImageResultsProvider($con);
		$pageSize = 30;
	}

		$numResults = $resultsProvider->getNumResults($term);
		echo "<p class='resultsCount'>$numResults results found</p>";
		echo $resultsProvider->getResultsHtml($page, $pageSize, $term);
		?>

	</div>

<div class="paginationContainer">
<div class="pageButtons">
	<div class="pageNumberContainer">
		<img src="assets/images/khojpageStart.png">
	</div>
	
	<?php 
	$pagesToShow = 10;
	$numPages = ceil($numResults/$pageSize);
	$pagesLeft = min($pagesToShow, $numPages);
	$currentPage = $page - floor($pagesToShow/2);

	if($currentPage < 1) {
		$currentPage = 1;
	}
 	
	if($currentPage + $pagesLeft > $numPages + 1 ) {
		$currentPage = $numPages + 1 - $pagesLeft;
	}

	while($pagesLeft !=0 && $currentPage <= $numPages) {

		if($currentPage == $page) {
			echo "<div class='pageNumberContainer'>
		<img src='assets/images/khojpageSelected.png'>
		<span class='pageNumber'>$currentPage</span>
		</div>";
		}
		else {
		echo "<div class='pageNumberContainer'>
		<a href='search.php?term=$term&type=$type&page=$currentPage'>
		<img src='assets/images/khojpage.png'>
		<span class='pageNumber'>$currentPage</span></a>
		</div>";
	}
		$currentPage++ ;
		$pagesLeft-- ;
	}
	?>

	<div class="pageNumberContainer">
		<img src="assets/images/khojpageEnd.png">
	</div>
</div>
</div>

</div>

<script src="https://cdn.jsdelivr.net/gh/fancyapps/fancybox@3.5.7/dist/jquery.fancybox.min.js"></script>
<script src="https://unpkg.com/masonry-layout@4/dist/masonry.pkgd.min.js"></script>
<script type="text/javascript" src="assets/js/script.js"></script>
</body>
</html>