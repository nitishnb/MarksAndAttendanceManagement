<!DOCTYPE html>
<?php session_start();
     
?>

<html lang="en"> 
  <head> 
    <!-- Required meta tags -->
    <meta charset="utf-8"> 
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no"> 
  
    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.2.1/css/bootstrap.min.css" integrity="sha384-GJzZqFGwb1QTTN6wy59ffF1BuGJpLSa9DkKMp0DgiMDm4iYMj70gZWKYbI706tWS" crossorigin="anonymous"> 
  

    <title>attendance(std)</title> 
  
    <style> 
		body {
	  margin: 0, auto;
	  background-image: url("n1.jpg");
	  background-repeat: no-repeat;
	  color: #000;
	  background-attachment: fixed;
	  background-size: cover;
	}
      thead th {
			background-color: #204051;
			color: white; 
		}
      h1{ 
        color: green; 
        text-align: center; 
      } 
      div{ 
      
      } 
    </style> 

<link rel="stylesheet" type="text/css" href="attend.css">
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
    <a href="logouts.php">Logout</a>
</div>
<div class="header-right">
    <a href="stdMarksCard.php">Marks Card</a>
</div>
<div class="header-right">
    <a href="#" class="att">Attendance</a> 
</div>
<div class="header-right">
    <a href="marks(std).php" >Marks</a>
</div>
<div class="header-right">
    <a href="student1.php">Home</a>
</div>
</div>
<br><br><div class="container"> 
      <h1>ATTENDANCE</h1> 
  
<br>
      <!-- table, table-primary, table-warning, table-danger -->
      <table class="table"> 
        <thead> 
          <tr> 
            <th scope="col">Sl. No.</td> 
            <th scope="col">Course Name</td> 
            <th scope="col">Present % Of Attendance</td> 
            <th scope="col">No.Of Classes You Can Skip</td> 
          </tr> 
        </thead> 
         <?php
        $var = $_SESSION['usn'];
        $i=1;
        $j=1;
        $_SESSION['usn'] = $var;
        $conn=mysqli_connect("localhost","root","","");
       mysqli_select_db($conn,'attendence_management');
        $sql=" select a.attendence_till_date,c.course_name,c.total_no_of_hrs_allocated,c.course_code from attendence a,course c where a.usn='".$var."' and a.course_code=c.course_code ";
        $run=mysqli_query($conn, $sql);
        while($row=mysqli_fetch_array($run))
        {
          $course_name=$row['course_name'];
          $course_code=$row['course_code'];
          $attendence_till_date=$row['attendence_till_date'];
          $total_hrs=$row['total_no_of_hrs_allocated'];
        ?>
        <?php
        $sql1="select l.total_cls_taken from lec_course l where l.course_code='".$course_code."' ";
        $run1=mysqli_query($conn, $sql1);
        while($row1=mysqli_fetch_array($run1))
        {
          $attendence_denmi=$row1['total_cls_taken'];
        }
        if ($attendence_denmi) {
        $total_miss=$total_hrs*15/100;
        $miss=$total_miss-($attendence_denmi-$attendence_till_date);
      }
        ?>
        <tbody> 
        <?php  if($j == 1) {
        ?>
          <tr class="table-danger"> 
          <th scope="row"><?php echo $i; $i++; ?></td> 
          <td><?php echo $course_name; ?></td>
          <td><?php if ($attendence_denmi) {  echo $attendence_till_date/$attendence_denmi*100;} else {echo "";} ?></td>
          <td><?php if ($attendence_denmi) { if($miss < 0) echo"0"; else echo (int)$miss; } else {echo "";}?></td>
          </tr>
        <?php } ?>
        <?php  if($j == 2) {
        ?>
          <tr class="table-primary"> 
          <th scope="row"><?php echo $i; $i++; ?></td> 
          <td><?php echo $course_name; ?></td>
          <td><?php if ($attendence_denmi) {  echo $attendence_till_date/$attendence_denmi*100;} else {echo "";} ?></td>
          <td><?php if ($attendence_denmi) { if($miss < 0) echo"0"; else echo (int)$miss; } else {echo "";}?></td>
           </tr>
        <?php } ?>
        <?php  if($j == 3) {
        ?>
          <tr class="table-warning"> 
          <th scope="row"><?php echo $i; $i++; ?></td> 
          <td><?php echo $course_name; ?></td>
          <td><?php if ($attendence_denmi) {  echo $attendence_till_date/$attendence_denmi*100;} else {echo "";} ?></td>
          <td><?php if ($attendence_denmi) { if($miss < 0) echo"0"; else echo (int)$miss; } else {echo "";}?></td>
          </tr>
        <?php } ?>
      <?php  
      if($j == 1) {
        $j=2;continue;
      }
      if($j == 2) {
        $j=3;continue;
      }
      if($j == 3)
        $j=1;

        ?>
          
      <?php } ?>
          
        </tbody> 
      </table> 
  
      
  
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