<?php
session_start();
if(!isset($_SESSION['username'])){
    header("location:First%20page.php");
} else {
 $username=$_SESSION['username'];
}
$conn=mysqli_connect("localhost","root","", "attendence_management");

?>

<!DOCTYPE html>
<html>
<head>
   <!-- Bootstrap CSS -->
<link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.2.1/css/bootstrap.min.css" integrity="sha384-GJzZqFGwb1QTTN6wy59ffF1BuGJpLSa9DkKMp0DgiMDm4iYMj70gZWKYbI706tWS" crossorigin="anonymous"> 
<link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css">
<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css">
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.1/jquery.min.js"></script>
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/js/bootstrap.min.js"></script>  


<link rel="stylesheet" type="text/css" href="attend.css">

    <style> 
      h1{ 
        color: #33cca6; 
        text-align: center; 
      } 
      h1{ 
        margin-top: 20px; 
      } 
      .tbox {
        height: 220px;
      }
      .btn {
        background-color: #21afde;
      }
    </style> 
</head>
<body>
<main id="mainn">
<div id="mySidenav" class="sidenav">
  <a href="#">About</a>
  <a href="facprofile.php"> My profile </a>
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
    <a href="attend2.php">Attendance</a> 
</div>
<div class="header-right">
    <a href="marks(fac).php">Marks</a>
</div>
<div class="header-right">
    <a href="faculty1.php">Home</a>
</div>
</div>
<div class="container">
  <h1>MY DEPARTMENT COLLEAGUES</h1>
  <br><br>
  <?php 
  $q = mysqli_query($conn, "SELECT substr('".$username."', 1, 3) as str");
  while ($row1 = mysqli_fetch_assoc($q)) {
    $str = $row1['str'];
  }
  $qu = "SELECT l.l_id, l.l_name, l.phno FROM lecturer l where substr(l.l_id, 1, 3) = '".$str."' and l.l_id != '".$username."' order by l.l_name";

$res=mysqli_query($conn, $qu);

while ($row = mysqli_fetch_assoc($res)) {
  $name = $row['l_name'];
  $id = $row['l_id'];
  $phno = $row['phno'];
  
?>

<div class="tbox">
    <img class="pic" src = "user1.png"> 
    <div class="nameplate">
      <br>
      <span> FACULTY NAME   : <?php echo $name; ?> </span> <br>
      <span> USER ID        : <?php echo $id; ?> </span> <br>
      <span> MOBILE         : <?php echo $phno; ?> </span> <br>

    </div>
  </div>
  <br><br><br>

<?php } ?>
</div>
<script>

var myIndex = 0;
carousel();
function carousel() {
  var i;
  var x = document.getElementsByClassName("mySlides");
  for (i = 0; i < x.length; i++) {
    x[i].style.display = "none";
  }
  myIndex++;
  if (myIndex > x.length) {myIndex = 1}
  x[myIndex-1].style.display = "block";
  setTimeout(carousel, 2000); // Change image every 2 seconds
}
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