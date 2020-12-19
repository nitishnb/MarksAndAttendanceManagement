<?php
session_start();
if(!isset($_SESSION['usn'])){
    header("location:First%20page.php");
} else {
 $user=$_SESSION['usn'];
}
?>

<!DOCTYPE html>
<html>
<head>

<title>My profile</title>
<link rel="stylesheet" type="text/css" href="attend.css">
<style>
	  	body {
	  margin: 0, auto;
	  background-image: url("n1.jpg");
	  background-repeat: no-repeat;
	  color: #000;
	  background-attachment: fixed;
	  background-size: cover;
	}
      h1{ 
        color: BLACK; 
        text-align: center; 
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
</head>
<body>
<main id="mainn">
<div id="mySidenav" class="sidenav">
  <a href="About_Student.html">About</a>
  <a href="stdprofile.php"> My profile </a>
  <a href="course-info.html">Course info</a>
</div>


<div class="topctr">
     <div id ="main" class="menuic" onclick="myFunction(this)">
     <div class="bar1"></div>
     <div class="bar2"></div>
     <div class="bar3"></div>
     </div>
   &emsp;&emsp;&emsp;<img src="https://upload.wikimedia.org/wikipedia/en/thumb/8/87/BMS_College_of_Engineering.svg/1200px-BMS_College_of_Engineering.svg.png" height="30px" width="30px">&emsp;<cap> BMSCE </cap> 
<div class="header-right">
    <a href="logout.php">Logout</a>
</div>
<div class="header-right">
    <a href="stdMarksCard.php">Marks Card</a>
</div>
<div class="header-right">
    <a href="attendence(std).php">Attendance</a> 
</div>
<div class="header-right">
    <a href="marks(std).php">Marks</a>
</div>
<div class="header-right">
    <a href="student1.php">Home</a>
</div>
</div>
<br><br>

<h1>My profile</h1><br>
<div class="card">
<p class="title">
<?php
  		$conn=mysqli_connect("localhost","root","");
  		mysqli_select_db($conn,'attendence_management');
		// Check connection
		if ($conn->connect_error) {
		die("Connection failed: " . $conn->connect_error);
		}
$sql = "SELECT s_name, usn, sem, cgpa, phno FROM student where usn='$user'";
$result = $conn->query($sql);

if ($result->num_rows > 0) {
    // output data of each row
    while($row = $result->fetch_assoc()) {
        echo "<br><br><m>Name:</m> ". $row["s_name"]. "<br><br><m>USN:</m> ". $row["usn"]. "<br><br><m>Semester:</m> ". $row["sem"]."<br><br><m>CGPA:</m> ". $row["cgpa"].  "<br><br><m>Phone number:</m>  " . $row["phno"] . "<br><br>";
    }
}
$conn->close();
?>
</p><br>Click here to <a href="stdchangepassword.php"><b>Change Password</b></a><br><br><br>
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

