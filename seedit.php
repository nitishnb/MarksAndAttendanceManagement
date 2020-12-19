<?php
	session_start();
	if(!isset($_SESSION['username'])){
		header("location:First%20page.php");
	} else {
	 $user=$_SESSION['username'];
	}
$dbuser="root";
$dbpass="";
$host="localhost";
$dbname = "attendence_management";
$mysqli = new mysqli($host, $dbuser, $dbpass, $dbname);
?>

<!DOCTYPE html>
<html>
<head>
<title>SEE Edit</title>
    <!-- Required meta tags -->
    <meta charset="utf-8"> 
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

<link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css">
<link rel="stylesheet" type="text/css" href="attend.css">
<link rel="stylesheet" type="text/css" href="table.css">
<link rel="stylesheet" type="text/css" href="back_button.css">
<style>
h2, h6
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
    <a href="adminprofile.php" >My Profile</a>
    </div>&emsp;
<div class="header-right">
    <a href="About_admin.html">About</a>
    </div>&emsp;
<div class="header-right">
    <a href="adminforms.php" class="att">Home</a>
</div>
</div><br>&emsp;
<button class="glow-on-hover" onclick="location.href = 'seview.php';" type="button">Back</button>
<br>
<h2><b  style="color: green">Student-Course Details</b></h2>
<h6>Student-USN : <?php echo $_GET['usn'];?></h6>
	
	<table class="customer-table">
		<thead>
			<tr>
			<th>Sl no</th>
			<th>Course Code</th>
			<th>Course Name</th>
			<th>SEE Marks</th>
			<th>Action</th>
			</tr>
		</thead>
		<tfoot>
			<tr>
				<td colspan="3">
					A=Absent &emsp; NE=Not Entered
				</td>
			</tr>
		</tfoot>
		<tbody>
<?php //code for read data from Database
	$id=$_GET['usn'];
	$ret = "select a.course_code, a.usn, b.s_name,a.see, c.course_name from student_course_info a, student b, course c where a.usn=b.usn and a.course_code=c.course_code and a.usn=? order by a.course_code";
	$stmt2 = $mysqli->prepare($ret);
	$stmt2->bind_param('s',$id);
	$stmt2->execute();
	 $res=$stmt2->get_result();
	 $cnt=1;
	   while($row=$res->fetch_object())
	  {
?>
<tr>
<td><?php echo $cnt;?></td>
<td><?php echo $row->course_code;?></td>
<td><?php echo $row->course_name;?></td>
<td><?php 
$num=0;
if($row->see=='-1')
{
	?><b  style="color: red"><?php echo "A";?></b><?php
}
else if($row->see==NULL)
{
	$num=1;
	?><b  style="color: grey"><?php echo "NE";?></b><?php
}
else{
?><b  style="color: black"><?php echo $row->see;?></b><?php
}?></td>
<?php
if($num==0)
{?>
<td><a href="seeedit.php?usn=<?php echo $row->usn;?>&cc=<?php echo $row->course_code;?>"><b>Edit</b></a></td>
<?php }
else{
	?>
	<td><a href="seeedit.php?usn=<?php echo $row->usn;?>&cc=<?php echo $row->course_code;?>"><b style="color: green">Enter</b></a></td>
<?php }?>
	</tr>
<?php $cnt=$cnt+1; } ?>
</tbody>
</table>
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

