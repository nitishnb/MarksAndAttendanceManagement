<?php
	session_start();
	if(!isset($_SESSION['username'])){
		header("location:First%20page.php");
	} else {
	 $user=$_SESSION['username'];
	}
     $conn=mysqli_connect("localhost","root","","");
   mysqli_select_db($conn,'attendence_management');
    $courseid = $_GET['ccode'];

?>
<!DOCTYPE html>
<html lang="en"> 
  <head> 
    <!-- Required meta tags -->
<meta charset="utf-8"> 
<meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no"> 
    <!-- Bootstrap CSS -->
<link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.2.1/css/bootstrap.min.css" integrity="sha384-GJzZqFGwb1QTTN6wy59ffF1BuGJpLSa9DkKMp0DgiMDm4iYMj70gZWKYbI706tWS" crossorigin="anonymous"> 
<link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css">
<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css">
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.1/jquery.min.js"></script>
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/js/bootstrap.min.js"></script>
<link rel="stylesheet" type="text/css" href="attend.css">
<link rel="stylesheet" type="text/css" href="table.css">
<link rel="stylesheet" type="text/css" href="back_button.css">

<title>Course wise SEE marks</title>

<style type="text/css">
        .center {
        display: flex;
        justify-content: center;
        align-items: center;
      } 
      .alert, .alert-success {
        font-size: 18px;
        position: absolute;
        top: 50%;
        left: 50%;
        transform: translate(-117%, -70%);
      }
body {
  background-repeat: no-repeat;
  color: #000;
  background-attachment: fixed;
  background-size: cover;
}
</style>

</head>
<body>
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
    <a href="adminprofile.php" >My Profile</a>
    </div>&emsp;
<div class="header-right">
    <a href="About_admin.html">About</a>
    </div>&emsp;
<div class="header-right">
    <a href="adminforms.php" class="att">Home</a>
</div>
</div><br>&emsp;
<button class="glow-on-hover" onclick="location.href = 'scourse.php';" type="button">Back</button>
<br>

<div class="container">
  <h1><center> SEE Marks Sheet </center></h1>

<?php
     $q1="SELECT c.course_name FROM course c where c.course_code = '".$courseid."'"; 
     $run2=mysqli_query($conn, $q1);
     $count=0;
     while ($row2 = mysqli_fetch_assoc($run2)) {
       $course = $row2['course_name'];
     }
    
?>
<div class="container">
<div class = "courseinfo"> 
  <div class="c1"> Course Name: <?php echo $course; ?> </div>
  <div class = "c1"> Course code: <?php echo $courseid; ?> </div>
</div>
<br>
<br>
<p> NOTE: Enter 'A' or 'a' for absentee students</p>

<form action="" id = "cbtn" method="post">
<table class="table table-hover">
  <thead>
    <tr>
     <th>Sl. No</th>
     <th>Student's USN</th>
     <th>Student's Name</th>
      <th>SEE</th>
    </tr>
  </thead>
     <tbody>
   <?php
    $q2="SELECT sc.*, s.s_name FROM student_course_info sc, student s WHERE sc.usn=s.usn and sc.course_code='".$courseid."' order by sc.usn";  
     $run=mysqli_query($conn, $q2);
     $i = 0;
     $j = 0;
     while($row=mysqli_fetch_array($run))
     {
         $usn[$i]=$row['usn'];
         $s_name[$i]=$row['s_name'];
     ?>
      <tr>
        <td><?php echo $i+1; ?></td>
        <td><?php echo $usn[$i]; ?></td>
        <td><?php echo $s_name[$i]; ?></td>
      <?php 
      $q3="select see from student_course_info where course_code='".$courseid."' and usn='".$usn[$i]."'"; 
      $run3=mysqli_query($conn, $q3);
      if ($row3 = mysqli_fetch_assoc($run3)) {
       $see = $row3['see']; 
     }

       if ($see != '' && $see != '-1') { ?>        
      <td>
      <div class="md-form">
        <input type="text" id="form1" class="form-control text-center" value="<?php echo $see; ?>" name="see[]">
          <label for="form1"></label>
      </div>
      <input type="hidden" name="usn[]" value="<?php echo $usn[$i]; ?>">
    </td>
       <?php }
       else if ($see == '-1') { ?>        
      <td>
      <div class="md-form">
        <input type="text" id="form1" class="form-control text-center" placeholder="ABSENT" name="see[]">
          <label for="form1"></label>
      </div>
      <input type="hidden" name="usn[]" value="<?php echo $usn[$i]; ?>">
    </td>
    <?php }
      else {
      ?>
      <td>
      <div class="md-form">
        <input type="text" id="form1" class="form-control text-center" placeholder="Enter Marks" name="see[]" >
          <label for="form1"></label>
      </div>
      <input type="hidden" name="usn[]" value="<?php echo $usn[$i]; ?>">
    </td> <?php } ?>
 </tr>
 <?php $i++;} ?>
 </tbody>
  </table>
  
  <div class="upbtn">
    <button type = "submit" name="update" class="btngr" onclick="return alerrt()">Update</button> 
  </div>

  </form>
</div>

<?php
   $res = 0;

   if(isset($_POST['update']))  
    {
      if (isset($_POST['see'])) {
      for($j = 0; $j < $i; $j++) {
        if (!empty($_POST['see'][$j]) && isset($_POST['see'][$j]) && isset($_POST['usn'][$j])) {
		if ($_POST['see'][$j] == 'A' or $_POST['see'][$j] == 'a') 
            $res = mysqli_query($conn, "update student_course_info set see='-1' where usn='".$_POST['usn'][$j]."' and course_code='".$courseid."'");
          else {
            if ($_POST['see'][$j] > 100 || $_POST['see'][$j] < 0)
              echo "<script> alert('Fail! SEE marks is invalid'); </script>";
            else
              $res = mysqli_query($conn, "update student_course_info set see='".$_POST['see'][$j]."' where usn='".$_POST['usn'][$j]."' and course_code='".$courseid."'"); 
        }
		}
      }
    }



 if ($res) { 
  echo "<script> alert('Success! Marks has been stored successfully'); </script>";
  echo("<script>location.href = 'scourse.php';</script>");
 }
}
?>

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

function alerrt() {
  var yes = confirm("Do you want to update?");
  if (yes){
    return true;
  }
  else
    return false;
}

</script>

</main>

</body>