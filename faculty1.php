<?php
session_start();
if(!isset($_SESSION['username'])){
    header("location:First%20page.php");
} else {
 $username=$_SESSION['username'];
}
$conn=mysqli_connect("localhost","root","", "attendence_management");
$query = "SELECT l_name,l_id,phno from lecturer WHERE l_id='".$username."'";
$result = mysqli_query($conn, $query);
$time1 = date('H:i:sa');
$date1 = date('y/m/d');
while ($row = mysqli_fetch_assoc($result)) {
  $name = $row['l_name'];
 $lid1= $row['l_id'];
  $phno1= $row['phno'];
}
$query1 = "SELECT * from logins";
$result1 = mysqli_query($conn, $query1);
$sl=mysqli_num_rows($result1);
if($sl<10)
{
  $que1="insert into logins (sno,u_name,id,contact,time,date,category) values('".++$sl."','".$name."','".$lid1."','".$phno1."','".$time1."','".$date1."' ,'Fac')";
  mysqli_query($conn, $que1);
}
else
{
  $z=2;
  while($z <= 10)
  {
    $r1=mysqli_query($conn, "SELECT * from logins where sno='".$z."'");
    while ($row1 = mysqli_fetch_assoc($r1)) 
    {
    $u_name = $row1['u_name'];
    $id= $row1['id'];
    $contact= $row1['contact'];
    $time= $row1['time'];
    $date= $row1['date'];
    $category= $row1['category'];
    }
  
    mysqli_query($conn, "update logins set sno='".--$z."',id='".$id."', u_name='".$u_name."',contact='".$contact."',time='".$time."',date='".$date."',category='".$category."' where sno='".$z."' ");
    $z+=2;
  }
  mysqli_query($conn, "update logins set sno=10,u_name='".$name."',id='".$lid1."',contact='".$phno1."',time='".$time1."',date='".$date1."',category='Fac' where sno=10 ");
}
?>

<!DOCTYPE html>
<html>
<head>
<title>Faculty</title>

<link rel="stylesheet" type="text/css" href="faculty_style1.css">
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
    <a href="#" class="att">Home</a>
</div>

</div>

<div class="logo"> <b> WELCOME <?php echo $name; ?>! </b> </div> 

  <div class="button">
  <a href="stdview.php" class="btn"><b>View my Students </b></a>
  <a href="facview.php" class="btn"><b>View my colleagues</b></a>
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