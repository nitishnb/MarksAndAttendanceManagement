<?php
session_start();
if(!isset($_SESSION['username'])){
    header("location:First%20page.php");
} else {
 $user=$_SESSION['username'];
}
unset($_SESSION['sess_user']);
session_destroy();
?>
<!DOCTYPE html>
<head>
	<title> Attendance management </title>
	<link rel="stylesheet"  href="first.css">
</head>

<div class="bg"></div>
<div class="bg bg2"></div>
<div class="bg bg3"></div>

<div class="logo"> <img class = 'symbol' src="https://upload.wikimedia.org/wikipedia/en/thumb/8/87/BMS_College_of_Engineering.svg/1200px-BMS_College_of_Engineering.svg.png"> BMS College of Engineering<br><br>&emsp;
	<?php
 echo " $user ";
?> logged out successfully </div> 

  <div class="button">
  	<a href="First%20page.php" class="btn"><b>LOGIN</b></a>
  </div>

