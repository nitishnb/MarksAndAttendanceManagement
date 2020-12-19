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
error_reporting(-1);
ini_set('display_errors', true);
$num=0;
$rows = empty($_POST['rows']) ? 0 : (int)$_POST['rows'] ;
  	if(isset($_POST['update']))
  	{
  		$usn=$_GET['usn'];
		$c=$_POST['ccode'];
		if(count(array_unique($c))<count($c))
		{
			$num=-1;
			phpAlert("⚠️ There shouldn't be two or more same courses.Try again..!!");
		}
	if($num  ==  0){
		foreach($c as $ccode):
				$conn=mysqli_connect("localhost","root","");
				mysqli_select_db($conn,'attendence_management');
				// Check connection
				if ($conn->connect_error) {
				die("Connection failed: " . $conn->connect_error);
				}
				$query="SELECT course_code FROM student_course_info WHERE usn='".$usn."'";
				$res=mysqli_query($conn,$query);
				if ($res->num_rows > 0) {
				// output data of each row
				while($row = $res->fetch_assoc()) {
					if($row["course_code"]==$ccode)
						$num=1;
				}
				}
				if($num  ==  1)
				{
					phpAlert("⚠️ The course ".$ccode." is already Enrolled. Try again..!!");
				}
		endforeach;
	}
	if($num  ==  0){
		foreach($c as $ccode):
				$conn=mysqli_connect("localhost","root","");
				mysqli_select_db($conn,'attendence_management');
						$sql = "INSERT INTO student_course_info (usn, course_code) VALUES ('$usn', '$ccode')";
						if ($conn->query($sql) === TRUE) {
									$sq = "INSERT INTO attendence (usn, course_code, attendence_till_date) VALUES ('$usn', '$ccode', 0)";
									$conn->query($sq);
						}
						$conn->close();
		endforeach;
		phpAlert("New record inserted successfully");
		echo "<script>location.href = 'http://localhost/project%20work/scview.php';</script>";
	}
	}
?>

<!DOCTYPE html>
<html>
<head>
<title>Student Edit</title>
    <!-- Required meta tags -->
    <meta charset="utf-8"> 
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no"> 
<title>attendance(fac)</title>  
    <!-- Bootstrap CSS -->
<link rel="stylesheet" type="text/css" href="attend.css">
<link rel="stylesheet" type="text/css" href="back_button.css">
<link rel="stylesheet" type="text/css" href="form.css">
<style>
body {
  background-image: url('n3.jpg');
  background-repeat: no-repeat;
  color: #000;
  background-attachment: fixed;
  background-size: cover;
}
h2
{
  text-align: center;
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
    <a href="adminprofile.php">My Profile</a>
    </div>&emsp;
<div class="header-right">
    <a href="About_admin.html">About</a>
    </div>&emsp;
<div class="header-right">
    <a href="adminforms.php" class="att">Home</a>
</div>
</div>
<br>&emsp;
<button class="glow-on-hover" onclick="location.href = 'scview.php';" type="button">Back</button>
<?php
$dbuser="root";
$dbpass="";
$host="localhost";
$dbname = "attendence_management";
$mysqli = new mysqli($host, $dbuser, $dbpass, $dbname);
$id=$_GET['usn'];
$ret = "select * from student where usn=?";
$stmt2 = $mysqli->prepare($ret);
$stmt2->bind_param('s',$id);
$stmt2->execute();
$res=$stmt2->get_result();
$cnt=1;
while($row=$res->fetch_object())
{
?>
<div class="container">  
  <form id="contact" name="form" onsubmit="return checkForm(this);" action="" method="post">
    <h3 style="text-align: center">Students List Edit</h3><br>
	<h4 style="color: grey">Student USN : <b  style="color: blue"><?php echo $row->usn;?></b></h4>

<h4 style="color: grey">Student Name : <b  style="color: blue"><?php echo $row->s_name;?></b></h4><br>
<?php if($rows==0) {?>
<fieldset>
  <input placeholder="NUMBER OF COURSES TO ENROLL" type="text" name="rows" tabindex="1" required autofocus>
      </fieldset>
    <fieldset>
	<button name="submit" type="submit" id="contact-submit" value="Add">ADD</button>
      </fieldset>
<?php } 
else {?>
<h4 style="text-align: center">Choose <?php echo $rows;?> Course Codes</h4>
<?php } ?>
<?php if(0 !== $rows): ?>
        <!-- create loop which loops the number of times defined in $rows -->
        <?php foreach(range(1, $rows) as $row): ?>
										  <h4>Course code <?php echo $row; ?>:</h4>
										  <?php         
											$conn=mysqli_connect("localhost","root","");
											mysqli_select_db($conn,'attendence_management');
											$sql="select course_code, course_name from course";
											$run=mysqli_query($conn, $sql);
											if($run->num_rows){
											$select= '<fieldset><select name="ccode[]" required><option></option><optgroup label="Course codes - Course name">';
											while($row=mysqli_fetch_array($run)){
												  $select.='<option value="'.$row['course_code'].'">'.$row['course_code'].' - '.$row['course_name'].'</option>';
											  }
											}
											$select.='</optgroup></select></fieldset>';
											echo $select;
										   ?>
										<br>
        <?php endforeach; ?>
    <fieldset>
	      <button  name="update" value="Submit" type="submit" id="contact-submit" onclick="return confirm('Are you sure?')" required>Submit</button>
 
	</fieldset>
    <p style="color: red">Note:<br>Do Not Enter Same Course More Than Once<br>Do not choose Course which is already enrolled</p>
      <?php endif; ?>
  </form>
</div>
<?php } ?>



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
  function checkForm(form)
  {
	
	var r = /^[A-Za-z. ]+$/;
	 if(!r.test(form.name.value)) {
      alert("Error: Name contains invalid characters!");
      form.name.focus();
      return false;
    }
	
	var p = /^\d{10}$/;
	if(!p.test(form.phno.value)) {
      alert("Error: Phone number must contain 10 digits only!");
      form.phno.focus();
      return false;
    }
	
	var re = /^[0-9]{1}\.[0-9]{2}$/;
	var s = /^[1]{1}[0]{1}\.[0]{2}$/;
	if(!re.test(form.cgpa.value)) {
	  if(!s.test(form.cgpa.value)){
      alert("Error: SGPA is invalid!");
      form.cgpa.focus();
      return false;
	  }
    }
	
    return true;
  }
</script>

</main>

</body>

</html>

