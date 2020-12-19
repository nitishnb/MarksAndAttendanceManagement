<?php
session_start();
if(!isset($_SESSION['username'])){
    header("location:First%20page.php");
} else {
 $user=$_SESSION['username'];
}
$conn=mysqli_connect("localhost","root","");
      mysqli_select_db($conn,'attendence_management');

?>

<!DOCTYPE html>
<html>
<head>
<title>My profile</title>

<link rel="stylesheet" type="text/css" href="attend.css">
<style>
h2
{
  text-align: center;
}
body {
  background-image: url('n3.jpg');
  background-repeat: no-repeat;
  color: #000;
  background-attachment: fixed;
  background-size: cover;
}
.card {
  box-shadow: 0 4px 8px 0 rgba(0, 0, 0, 0.2);
  max-width: 300px;
  margin: auto;
  text-align: center;
  font-family: arial;
  background-color: #fffdd0;
}
.title {
  font-size: 18px;
}
m {
  color: green;
  font-style: italic;
}
</style>
</head><body>
<main id="mainn">
<div id="mySidenav" class="sidenav">
  <a href="adminforms.php">Home</a>
   <a href="About_admin.html">About</a>
  <a href="adminprofile.php">My Profile</a>
  <a href="logouta.php">Logout</a>
</div>


<div class="topctr">
     <div id ="main" class="menuic" onclick="myFunction(this)">
     <div class="bar1"></div>
     <div class="bar2"></div>
     <div class="bar3"></div>
     </div>
   &emsp;&emsp;&emsp;<img src="https://upload.wikimedia.org/wikipedia/en/thumb/8/87/BMS_College_of_Engineering.svg/1200px-BMS_College_of_Engineering.svg.png" height="30px" width="30px">&emsp;<cap> BMSCE </cap> 
<div class="header-right">
    <a href="logouta.php">Logout</a>
    </div>&emsp;
<div class="header-right">
    <a href="adminprofile.php" class="att" >My Profile</a>
    </div>&emsp;
<div class="header-right">
    <a href="About_admin.html">About</a>
    </div>&emsp;
<div class="header-right">
    <a href="adminforms.php">Home</a>
</div>
</div>
<br><br>


<h2><b  style="color: black">My profile</b></h2><br>
<div class="card">
<p class="title">
<?php
		if ($conn->connect_error) {
		die("Connection failed: " . $conn->connect_error);
		}
$sql = "SELECT admin_name, phno FROM admin where admin_id='$user'";
$result = $conn->query($sql);

if ($result->num_rows > 0) {
    // output data of each row
    if($row = $result->fetch_assoc()) {
        echo "<br><br><m>Name:</m> ". $row["admin_name"]. "<br><br><m>Phone number:</m>  " . $row["phno"] . "<br><br>";
    }
}
$conn->close();
?></p><br>Click here to <a href="adminchangepassword.php"><b  style="color: blue">Change Password</b></a><br><br><br>
</div>
<script>

function myFunction(x) {
if (x.classList.contains("menuic"))
openNav();
if(x.classList.contains("change"))
closeNav();
x.classList.toggle("change");
}
 function openNav() {
document.getElementById("mySidenav").style.width = "250px";
document.getElementById("mainn").style.marginLeft = "250px";
document.body.style.backgroundColor = "rgba(0,0,0,0.4)";

}
function closeNav() {
document.getElementById("mySidenav").style.width = "0";
document.getElementById("mainn").style.marginLeft = "0";
document.body.style.backgroundColor = "#f2f2f2";
}

</script>

</main>

</body>

</html>

