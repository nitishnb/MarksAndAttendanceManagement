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
if(isset($_GET['cc']))
{	if(isset($_GET['usn']))
	{
	$id=($_GET['usn']);
	$cd=($_GET['cc']);
	$adn="delete from student_course_info where usn=? and course_code=?";
	$stmt= $mysqli->prepare($adn);
	$stmt->bind_param('ss',$id,$cd);
	$rs=$stmt->execute();
	$a="delete from attendence where usn=? and course_code=?";
	$stmt= $mysqli->prepare($a);
	$stmt->bind_param('ss',$id,$cd);
	$rs=$stmt->execute();
	if($rs==true)
	{
	echo "<script type='text/javascript'>alert('course has been successfully Removed');</script>";
	header('location:scedit.php?usn='.$id);
	}
	}
}
?>

<!DOCTYPE html>
<html>
<head>
<title>Student-Course Edit</title>
    <!-- Required meta tags -->

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
table{
  font-size: large;
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
<button class="glow-on-hover" onclick="location.href = 'scview.php';" type="button">Back</button>
<br>
<h2><b  style="color: green">Student-Course Details</b></h2>
<h6>Student-USN : <?php echo $_GET['usn'];?>
	<table class="customer-table">
		<thead>
			<tr>
			<th>Sl no</th>
			<th>Course Code</th>
			<th>Course Name</th>
			<th>Action</th>
			</tr>
		</thead>
		<tfoot>
			<tr>
				<td colspan="3">
					Can't enroll new courses here
				</td>
			</tr>
		</tfoot>
		<tbody>
<?php //code for read data from Database
	$id=$_GET['usn'];
	$ret = "select a.course_code, a.usn, b.s_name, c.course_name from student_course_info a, student b, course c where a.usn=b.usn and a.course_code=c.course_code and a.usn=? order by a.course_code";
	$stmt2 = $mysqli->prepare($ret);
	$stmt2->bind_param('s',$id);
	$stmt2->execute();
	 $res=$stmt2->get_result();
	 $cnt=0;
	   while($row=$res->fetch_object())
	  {
?>
<tr>
<td><?php echo $cnt+1;?></td>
<td><?php echo $row->course_code;?></td>
<td><?php echo $row->course_name;?></td>
<td><a href="scedit.php?usn=<?php echo $row->usn;?>&cc=<?php echo $row->course_code;?>" onclick="return confirm('Are you sure?')"><b  style="color: red">Unenroll</b></a></td>
</tr>
<?php $cnt=$cnt+1; }
if($cnt==0){
	?>
<tr><td colspan="4"><h6><b  style="color: red">No Courses Enrolled to view</b></h6></td></tr><?php } ?>
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

