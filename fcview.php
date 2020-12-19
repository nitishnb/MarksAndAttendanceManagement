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
if(isset($_GET['del']))
{
	$id=($_GET['del']);
	$adn="delete from lec_course where l_id=?";
	$stmt= $mysqli->prepare($adn);
	$stmt->bind_param(s,$id);
	$rs=$stmt->execute();
	if(rs==true)
	{
	echo "<script>alert('All course has been successfully Removed');</script>";
	header('location:fcview.php');
	}
}
?>

<!DOCTYPE html>
<html>
<head>
<title>Faculty-Course View</title>
    <!-- Required meta tags -->
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
<button class="glow-on-hover" onclick="location.href = 'fadminforms.php';" type="button">Back</button>
<br>
<h2><b  style="color: green">Faculty-Course Details</b></h2>
	
	<table class="customer-table">
		<thead>
			<tr>
			<th>Sl no</th>
			<th>Faculty ID</th>
			<th>Faculty Name</th>
			<th>No. of Courses Handled</th>
			<th>Action</th>
			</tr>
		</thead>
		<tfoot>
			<tr>
				<td colspan="3">
					Can't add new Course here
				</td>
			</tr>
		</tfoot>
		<tbody>
<?php //code for read data from Database
	$ret = "(select lc.l_id, l.l_name, count(lc.l_id) as noc from lec_course lc, lecturer l WHERE l.l_id=lc.l_id group by lc.l_id) union (select l.l_id, l.l_name, 0 as noc from lecturer l where l.l_id not in ( select lc.l_id from lec_course lc))";
	$stmt2 = $mysqli->prepare($ret);
	$stmt2->execute();
	 $res=$stmt2->get_result();
	 $cnt=1;
	   while($row=$res->fetch_object())
	  {
?>
<tr>
<td><?php echo $cnt;?></td>
<td><?php echo $row->l_id;?></td>
<td><?php echo $row->l_name;?></td>
<td><?php echo $row->noc;?></td>
<td><a href="fcedit.php?lid=<?php echo $row->l_id;?>"><b>Edit</b></a>&emsp;|&emsp;<a href="fcview.php?del=<?php echo $row->l_id;?>" onclick="return confirm('Are you sure?')"><b  style="color: red">Remove all Courses</b></a></td>
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

