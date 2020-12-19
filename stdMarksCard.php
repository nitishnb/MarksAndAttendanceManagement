<!DOCTYPE html>
<?php session_start();
  $conn=mysqli_connect("localhost","root","","");
  mysqli_select_db($conn,'attendence_management');

  $usn = $_SESSION['usn'];     
?>
<html lang="en"> 
  <head> 
    <!-- Required meta tags -->
    <meta charset="utf-8"> 
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no"> 
  
    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.2.1/css/bootstrap.min.css" integrity="sha384-GJzZqFGwb1QTTN6wy59ffF1BuGJpLSa9DkKMp0DgiMDm4iYMj70gZWKYbI706tWS" crossorigin="anonymous"> 
  <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.2.1/css/bootstrap.min.css" integrity="sha384-GJzZqFGwb1QTTN6wy59ffF1BuGJpLSa9DkKMp0DgiMDm4iYMj70gZWKYbI706tWS" crossorigin="anonymous"> 
<link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css">
<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css">
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.1/jquery.min.js"></script>
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/js/bootstrap.min.js"></script>  

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
      .center {
        display: flex;
        justify-content: center;
        align-items: center;
      } 
      .alert, .alert-warning {
        font-size: 20px;
        position: absolute;
        top: 50%;
        left: 50%;
        transform: translate(-50%, -50%);
      }
      p {
        font-size: 12px;
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
    <a href="#" class="att">Marks Card</a>
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
<br>
<?php
$query = "SELECT course_code FROM student_course_info WHERE usn='".$usn."' AND (CIE = 0 OR CIE = '')";
$run=mysqli_query($conn, $query);
$nums = mysqli_num_rows($run);

if ($nums == 0) {
$query = "SELECT course_code FROM student_course_info WHERE usn='".$usn."' AND CIE >= 20 AND (SEE = '' OR SEE = 0)";
$run=mysqli_query($conn, $query);
$num = mysqli_num_rows($run);

if ($num == 0) {

  $query = "SELECT s_name, SUBSTRING(sem, 1, 1) AS seme FROM student WHERE usn = '".$usn."'";
  $run=mysqli_query($conn, $query);
  while($row=mysqli_fetch_array($run))
  {
    $name = $row['s_name'];
    $sem = $row['seme'];
  }
  $qu = "SELECT SUBSTRING(usn, 6, 2) AS extract FROM student WHERE usn = '".$usn."'";
  $run=mysqli_query($conn, $qu);
  while($row=mysqli_fetch_array($run))
  {
    $dept = $row['extract'];
  }
  switch ($dept) {
    case 'AE': $dept = 'AEROSPACE ENGINEERING';
               break;
    case 'BT': $dept = 'BIO-TECNOLOGY';
               break;
    case 'CH': $dept = 'CHEMICAL ENGINEERING';
               break;
    case 'CS': $dept = 'COMPUTER SCIENCE AND ENGINEERING';
               break;
    case 'CV': $dept = 'CIVIL ENGINEERING';
               break;
    case 'EC': $dept = 'ELECTRONICS AND COMMUNICATION ENGINEERING';
               break;
    case 'EE': $dept = 'ELECTRICAL AND ELECTRONICS ENGINEERING';
               break;
    case 'EI': $dept = 'ELECTRONICS AND INSTRUMENTATION ENGINEERING';
               break;              
    case 'IE': $dept = 'INSTRUMENTATION ENGINEERING AND MANAGEMENT';
               break;
    case 'IS': $dept = 'INFORMATION SCIENCE AND ENGINEERING';
               break;
    case 'ME': $dept = 'MECHANICAL ENGINEERING';
               break;
    case 'ML': $dept = 'MEDICAL ELECTRONICS';
               break;
    case 'TC': $dept = 'ELECTRONICS AND TELECOMMUNICATION ENGINEERING';
               break;
    
    default: $dept = '';
             break;
  }
?>

<div class="container"> 
      <h1>REPORT CARD</h1> 
<br>
<div class = "courseinfo"> 
  <div class="c1"> <b>Student USN &nbsp;&nbsp;:</b> <?php echo $usn; ?> </div>
  <div class="c1"> <b> Student Name&nbsp;&nbsp;:</b> <?php echo $name; ?> </div>
  <div class="c1"> <b>Semester &nbsp;&ensp;&ensp;&ensp;&ensp;&ensp;:</b> <?php echo $sem; ?> </div>
  <div class="c1"> <b>Department&nbsp;&ensp;&ensp;&emsp; :</b> <?php echo $dept;?> </div>
</div>

<table class="table table-bordered table-hover"> 
  <thead class='thead-dark'> 
    <th scope="col">Sl No.</th> 
    <th scope="col">Course Code</th> 
    <th scope="col">Course Name</th> 
    <th scope="col">CIE</th>
    <th scope="col">SEE</th>
    <th scope="col">Total</th>
    <th scope="col">Grades</th>
 </thead> 
<?php
  $query = "SELECT sc.course_code, c.course_name, c.credits, sc.CIE, sc.SEE FROM student_course_info sc, course c WHERE c.course_code = sc.course_code AND usn='".$usn."'";
  $run=mysqli_query($conn, $query);
  $i = 0;
  $totalCredits = 0;
  $gradeCredits = 0;
  $j=1; 
  while ($row = mysqli_fetch_array($run)) {
    ++$i;
    $course_code[$i] = $row['course_code'];
    $course_name[$i] = $row['course_name'];
    $cie[$i] = round($row['CIE']);
    $see[$i] = $row['SEE'];
    $credits[$i] = $row['credits'];

    $total[$i] = round($cie[$i] + ($see[$i] / 2));

    switch($total[$i]) {
      case ($total[$i] > 89): $grade[$i] = 'S';
                              $gradepoint[$i] = 10;
                              break;
      case ($total[$i] > 74): $grade[$i] = 'A';
                              $gradepoint[$i] = 9;
                              break;
      case ($total[$i] > 59): $grade[$i] = 'B';
                              $gradepoint[$i] = 8;
                              break;
      case ($total[$i] > 49): $grade[$i] = 'C';
                              $gradepoint[$i] = 7;
                              break;
      case ($total[$i] > 44): $grade[$i] = 'D';
                              $gradepoint[$i] = 6;
                              break;
      case ($total[$i] > 39): $grade[$i] = 'E';
                              $gradepoint[$i] = 5;
                              break;
      default: $grade[$i] = 'F';
               $gradepoint[$i] = 0;                              
    }
    $totalCredits += $credits[$i];
    $gradeCredits += ($gradepoint[$i] * $credits[$i]);
?>
<?php  if($j == 1) { ?>
<tr class="table-danger">
  <td> <?php echo $i; ?> </td>
  <td> <?php echo $course_code[$i]; ?> </td>
  <td> <?php echo $course_name[$i]; ?> </td>
  <td> <?php echo $cie[$i]; ?> </td>
  <?php if($see[$i]<0){?>
  <td>ABSENT</td>
  <td>ABSENT</td>
  <?php }else{ ?>
  <td> <?php echo $see[$i]; ?> </td>
  <td> <?php echo $total[$i] ?> </td>
  <?php } ?>
  <td> <?php echo $grade[$i]; ?> </td>
</tr>
<?php } ?>
<?php  if($j == 2) { ?>
<tr class="table-primary">
  <td> <?php echo $i; ?> </td>
  <td> <?php echo $course_code[$i]; ?> </td>
  <td> <?php echo $course_name[$i]; ?> </td>
  <td> <?php echo $cie[$i]; ?> </td>
  <?php if($see[$i]<0){?>
  <td>ABSENT</td>
  <td>ABSENT</td>
  <?php }else{ ?>
  <td> <?php echo $see[$i]; ?> </td>
  <td> <?php echo $total[$i] ?> </td>
  <?php } ?>
  <td> <?php echo $grade[$i]; ?> </td>
</tr>
<?php } ?>
<?php  if($j == 3) { ?>
<tr class="table-warning">
  <td> <?php echo $i; ?> </td>
  <td> <?php echo $course_code[$i]; ?> </td>
  <td> <?php echo $course_name[$i]; ?> </td>
  <td> <?php echo $cie[$i]; ?> </td>
  <?php if($see[$i]<0){?>
  <td>ABSENT</td>
  <td>ABSENT</td>
  <?php }else{ ?>
  <td> <?php echo $see[$i]; ?> </td>
  <td> <?php echo $total[$i] ?> </td>
  <?php } ?>
  <td> <?php echo $grade[$i]; ?> </td>
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
  <?php
} 
$sgpa = $gradeCredits / $totalCredits;
if ($sem % 2) {
  $cgpa = $sgpa;
}
else {
  $query = "SELECT cgpa FROM student WHERE usn='".$usn."'";
  $run=mysqli_query($conn, $query);
  $i = 0;
  while ($row = mysqli_fetch_array($run)) {
    $cgpa1 = $row['cgpa'];
  }
  $cgpa = ($cgpa1 + $sgpa) / 2;
}
?>
<thead class="thead-dark">
<div class = "courseinfo"> 
<th scope="col"> </th>
<th scope="col"> </th>
<th scope="col"> </th>
<th scope="col"> </th>
<th scope="col"> </th>
<th scope="col"> <div class="c1"> SGPA: <?php echo $sgpa; ?> </div> </th>
<th scope="col"> <div class="c1"> CGPA: <?php echo $cgpa; ?> </div> </th>
</div>
</div>
</thead>
</table>
<?php 
?>
<p>
<strong>DISCLAIMER </strong> : The results published here are provisional and are provided for immediate information to the examinees. These results may not be used as official confirmation of your achievement. While all efforts have been made to make the information available on this website as authentic as possible, any of the BMSCE staff will not be responsible for any loss caused by shortcoming, defect or inaccuracy in the information provided on this website. Please contact the Controller of Examination for the final official results. 
</p>
<?php } 
	else { ?>
<div class="center">
<div class="alert alert-warning">
  <strong>SEE marks</strong> have not been given yet.
</div>
</div>
<?php }
} else { ?>
<div class="center">
<div class="alert alert-warning">
  Not yet available.
</div>
</div>
<?php }?>
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
</html>