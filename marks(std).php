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
  

    <title>marks(std)</title> 
  
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
    <a href="attendence(std).php">Attendance</a> 
</div>
<div class="header-right">
    <a href="#" class="att">Marks</a>
</div>
<div class="header-right">
    <a href="student1.php">Home</a>
</div>
</div>
<br><br>
<div class="container"> 
      <h1>MARKS SHEET</h1> 
  <br>
      <!-- table, table-primary, table-warning, table-danger -->
      <table class="table"> 
        <thead> 
          <tr > 
            <th scope="col">Sl. No.</td> 
            <th scope="col">Course Name</td> 
            <th scope="col">Test1(40)</td> 
            <th scope="col">Test2(40)</td>
            <th scope="col">Test3(40)</td>
            <th scope="col">Quiz1(20)</td>
            <th scope="col">Quiz2(20)</td>
            <th scope="col">Lab1(25)</td>
            <th scope="col">Lab2(25)</td>
            <th scope="col">CIE</td>
          </tr> 
        </thead> 
        <?php
        $var = $_SESSION['usn'];
        $i=1;
        $j=1;
        $_SESSION['usn'] =$var;
        $conn=mysqli_connect("localhost","root","","");
	     mysqli_select_db($conn,'attendence_management');
        $sql="select c.course_name,sc.test1,sc.test2,sc.test3, sc.quiz1,sc.quiz2, sc.lab1, sc.lab2, sc.CIE from course c,student_course_info sc where sc.usn='".$var."' and c.course_code=sc.course_code";
        $run=mysqli_query($conn, $sql);
        $k=mysqli_num_rows ($run);
        while($row=mysqli_fetch_array($run))
        {
          $course_name=$row['course_name'];
          $test1=$row['test1'];
          $test2=$row['test2'];
          $test3=$row['test3'];
          $quiz1=$row['quiz1'];
          $quiz2=$row['quiz2'];
          $lab1=$row['lab1']; 
          $lab2=$row['lab2'];
          $cie=$row['CIE'];  
        ?>
	  <tbody> 
        <?php  if($j == 1) {
        ?>
          <tr class="table-danger"> 
          <th scope="row"><?php echo $i; $i++; ?></td> 
          <td><?php echo $course_name; ?></td>
          <td><?php if ($test1) { echo $test1; } else { echo "";} ?></td>
          <td><?php if ($test2) { echo $test2; } else { echo "";} ?></td>
          <td><?php if ($test3) { echo $test3; } else { echo "";} ?></td>
          <td><?php if ($quiz1) { echo $quiz1; } else { echo "";} ?></td>
          <td><?php if ($quiz2) { echo $quiz2; } else { echo "";} ?></td>
          <td><?php if ($lab1) { echo $lab1; } else { echo "";} ?></td>
          <td><?php if ($lab2) { echo $lab2; } else { echo "";} ?></td>
          <td><?php if ($cie) { echo $cie; } else { echo "";} ?></td>
          </tr>
        <?php } ?>
        <?php  if($j == 2) {
        ?>
          <tr class="table-primary"> 
          <th scope="row"><?php echo $i; $i++; ?></td> 
          <td><?php echo $course_name; ?></td>
          <td><?php if ($test1) { echo $test1; } else { echo "";} ?></td>
          <td><?php if ($test2) { echo $test2; } else { echo "";} ?></td>
          <td><?php if ($test3) { echo $test3; } else { echo "";} ?></td>
          <td><?php if ($quiz1) { echo $quiz1; } else { echo "";} ?></td>
          <td><?php if ($quiz2) { echo $quiz2; } else { echo "";} ?></td>
          <td><?php if ($lab1) { echo $lab1; } else { echo "";} ?></td>
          <td><?php if ($lab2) { echo $lab2; } else { echo "";} ?></td>
          <td><?php if ($cie) { echo $cie; } else { echo "";} ?></td>
          </tr>
        <?php } ?>
        <?php  if($j == 3) {
        ?>
          <tr class="table-warning"> 
          <th scope="row"><?php echo $i; $i++; ?></td> 
          <td><?php echo $course_name; ?></td>
          <td><?php if ($test1) { echo $test1; } else { echo "";} ?></td>
          <td><?php if ($test2) { echo $test2; } else { echo "";} ?></td>
          <td><?php if ($test3) { echo $test3; } else { echo "";} ?></td>
          <td><?php if ($quiz1) { echo $quiz1; } else { echo "";} ?></td>
          <td><?php if ($quiz2) { echo $quiz2; } else { echo "";} ?></td>
          <td><?php if ($lab1) { echo $lab1; } else { echo "";} ?></td>
          <td><?php if ($lab2) { echo $lab2; } else { echo "";} ?></td>
          <td><?php if ($cie) { echo $cie; } else { echo "";} ?></td>
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
    } ?>
        
        
        
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