<?php
	session_start();
	if(!isset($_SESSION['username'])){
		header("location:First%20page.php");
	} else {
	 $user=$_SESSION['username'];
	}
function phpAlert($msg) 
{ 
	echo '<script type="text/javascript">alert("' . $msg . '")</script>'; 
} 
$dbuser="root";
$dbpass="";
$host="localhost";
$dbname = "attendence_management";
$mysqli = new mysqli($host, $dbuser, $dbpass, $dbname);
if(isset($_GET['del']))
{
	$id=($_GET['del']);
	$adn="delete from student_course_info where usn=?";
	$stmt= $mysqli->prepare($adn);
	$stmt->bind_param(s,$id);
	$rs=$stmt->execute();
	$a="delete from attendence where usn=?";
	$stm= $mysqli->prepare($a);
	$stm->bind_param(s,$id);
	$rs=$stm->execute();
	if(rs==true)
	{
		phpAlert("Courses has been unenrolled successfully..!!");
		echo "<script>location.href = 'http://localhost/project%20work/scview.php';</script>";
	}
}
?>

<!DOCTYPE html>
<html>
<head>
<title>Student-Course View</title>
    <meta charset="utf-8"> 
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no"> 
<title>attendance(fac)</title>  

<link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css">
<link rel="stylesheet" type="text/css" href="attend.css">
<link rel="stylesheet" type="text/css" href="table.css">
<link rel="stylesheet" type="text/css" href="back_button.css">
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
tt{
	text-shadow : 0px 1px 0px #999, 0px 2px 0px #888, 0px 3px 0px #777, 0px 4px 0px #666, 0px 5px 0px #555, 0px 6px 0px #444, 0px 7px 0px #333, 0px 8px 0px #001135;
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
<button class="glow-on-hover" onclick="location.href = 'sadminforms.php';" type="button">Back</button>
<br>
<h2><b  style="color: green">Student-Course Details</b></h2>
	<table class="customer-table">
		<thead>
			<tr>
			<th>Sl no</th>
			<th>USN</th>
			<th>Name</th>
			<th>Sem</th>
			<th>No. of Courses Enrolled</th>
			<th>Action</th>
			</tr>
		</thead>
		<tfoot>
			<tr>
				<td colspan="3">
					Click on 'Enroll' to add new courses
				</td>
			</tr>
		</tfoot>
		<tbody>
<?php //code for read data from Database
	$ret = "(select sc.usn, ss.s_name, ss.sem, count(sc.usn) as noc from student_course_info sc, student ss WHERE ss.usn=sc.usn group by sc.usn) union (select s.usn, s.s_name,s.sem,  0 as noc from student s where s.usn not in ( select sc.usn from student_course_info sc))";
	$stmt2 = $mysqli->prepare($ret);
	$stmt2->execute();
	 $res=$stmt2->get_result();
	 $cnt=0;
	   while($row=$res->fetch_object())
	  {
?>
<tr>
<td><?php echo $cnt+1;?></td>
<td><?php echo $row->usn;?></td>
<td><?php echo $row->s_name;?></td>
<td><?php echo $row->sem;?></td>
<td><?php echo $row->noc;?></td>
<td><a href="trash.php?usn=<?php echo $row->usn;?>"><b style="color: green">Enroll</b></a> &emsp;| &emsp;<a href="scedit.php?usn=<?php echo $row->usn;?>"><b>View</b></a> &emsp;|&emsp;<a href="scview.php?del=<?php echo $row->usn;?>" onclick="return confirm('Are you sure?')"><b  style="color: red">Unenroll from all Courses</b></a></td>
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