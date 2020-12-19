<?php
	session_start();
	if(!isset($_SESSION['username'])){
		header("location:First%20page.php");
	} else {
	 $user=$_SESSION['username'];
	}
	
  	if(isset($_POST['submit1']))
  	{
  		$usn=$_POST['susn'];
  		$name=$_POST['sname'];
  		$sem=$_POST['ssem'];
		$cgpa=$_POST['scgpa'];
		$phn=$_POST['phno'];

  		$conn=mysqli_connect("localhost","root","");
  		mysqli_select_db($conn,'attendence_management');
		// Check connection
		if ($conn->connect_error) {
		die("Connection failed: " . $conn->connect_error);
		}
  		$query="SELECT * FROM student WHERE usn='".$usn."'";
  		$res=mysqli_query($conn,$query);
  		$num=mysqli_num_rows($res);
  		if($num  >=  1)
  		{
			echo "<script> alert('⚠️ This USN is already registered') </script>";
			echo "<script>location.href = 'http://localhost/project%20work/sadminforms.php';</script>";
  		}
  		else
  		{
				$sql = "INSERT INTO student (usn, s_name, sem, cgpa, password, phno) VALUES ('$usn', '$name', '$sem', '$cgpa', '$phn', '$phn')";
				if ($conn->query($sql) === TRUE) {
							echo "<script> alert('New record inserted successfully') </script>";
							echo "<script>location.href = 'http://localhost/project%20work/sadminforms.php';</script>";
				} 
				else {
							echo "<script> alert('Error..!!') </script>";
							echo "<script>location.href = 'http://localhost/project%20work/sadminforms.php';</script>";
				}
				$conn->close();
  		}
	}
	
  	if(isset($_POST['submit4']))
  	{
  		$usn=$_POST['susn'];
		$ccode=$_POST['ccode'];

		
  		$conn=mysqli_connect("localhost","root","");
  		mysqli_select_db($conn,'attendence_management');
		// Check connection
		if ($conn->connect_error) {
		die("Connection failed: " . $conn->connect_error);
		}
  		$query="SELECT course_code FROM student_course_info WHERE usn='".$usn."'";
  		$res=mysqli_query($conn,$query);
		
		$num=0;
		if ($res->num_rows > 0) {
		// output data of each row
		while($row = $res->fetch_assoc()) {
			if($row["course_code"]==$ccode)
				$num=1;
		}
		}
  		if($num  ==  1)
  		{
			echo "<script> alert('⚠️ This USN is already registered with this course') </script>";
			echo "<script>location.href = 'http://localhost/project%20work/sadminforms.php';</script>";
  		}
  		else
  		{
				$sql = "INSERT INTO student_course_info (usn, course_code) VALUES ('$usn', '$ccode')";
				
				if ($conn->query($sql) === TRUE) {
							$sq = "INSERT INTO attendence (usn, course_code, attendence_till_date) VALUES ('$usn', '$ccode', 0)";
							$conn->query($sq);
							echo "<script> alert('New record inserted successfully') </script>";
							echo "<script>location.href = 'http://localhost/project%20work/sadminforms.php';</script>";
				} 
				else {
							echo "<script> alert('Error..!!') </script>";
							echo "<script>location.href = 'http://localhost/project%20work/sadminforms.php';</script>";
				}
				$conn->close();
  		}
	}
	
  	if(isset($_POST['submit6']))
  	{
		$ccode=$_POST['ccode'];
  		$usn=$_POST['susn'];
		$seem=$_POST['seem'];
		
  		$conn=mysqli_connect("localhost","root","");
  		mysqli_select_db($conn,'attendence_management');
		if ($conn->connect_error) {
		die("Connection failed: " . $conn->connect_error);
		}
		$num=0;
  		$query="SELECT see FROM student_course_info WHERE usn='".$usn."' and course_code='".$ccode."'";
  		$res=mysqli_query($conn,$query);
		$row = $res->fetch_assoc();
		if($row["see"] !==NULL || $row['see'] > 0)
  		{
			echo "<script> alert('⚠️ Already inserted SEE marks') </script>";
			echo "<script>location.href = 'http://localhost/project%20work/sadminforms.php';</script>";
			$num=1;
  		}
		
		$query="SELECT * FROM student_course_info WHERE usn='".$usn."' and course_code='".$ccode."'";
  		$res=mysqli_query($conn,$query);
		if ($res->num_rows == 0) {
			echo "<script> alert('⚠️ Error: Student/Course is not registerd') </script>";
			echo "<script>location.href = 'http://localhost/project%20work/sadminforms.php';</script>";
			$num=1;
		}

  		if($num==0)
  		{
  			$query = "SELECT cie FROM student_course_info WHERE usn='".$usn."' and course_code='".$ccode."'";
  		    $res=mysqli_query($conn,$query);
  		    $row = $res->fetch_assoc();
		    if ($row['cie'] == 0 || $row['cie'] == NULL) {
				echo "<script> alert('Error: Student/Course is not registerd') </script>";
				echo "<script>location.href = 'http://localhost/project%20work/sadminforms.php';</script>";
			 }
			else if ( $row['cie'] < 20) {
				echo "<script> alert('CIE marks is less than required for this student') </script>";
			}
			 else {
				$sql = "Update student_course_info set see='".$seem."' WHERE usn='".$usn."' and course_code='".$ccode."'";
				
				if ($conn->query($sql) === TRUE) {
							echo "<script> alert('New record inserted successfully') </script>";
							echo "<script>location.href = 'http://localhost/project%20work/sadminforms.php';</script>";
				} 
				else {
							echo "<script> alert('Error..!!') </script>";
							echo "<script>location.href = 'http://localhost/project%20work/sadminforms.php';</script>";
				}
			}
				$conn->close();
  		}
	}
?>
<!DOCTYPE html>
<html>
<head>
<title>Student Forms</title>
<link rel="stylesheet" type="text/css" href="attend.css">
<link rel="stylesheet" type="text/css" href="adminforms.css">
		<link rel="stylesheet" href="main.css" />

<style>
body {
  background-image: url('n3.jpg');
  background-repeat: no-repeat;
  color: #000;
  background-attachment: fixed;
  background-size: cover;
}
.back-icon {
  width: 30px;
  height: 30px;
  display: inline-block;
}
.back-icon__row {
  height: 10px;
  width: 30px;
  display: flex;
}
.back-icon__elem {
  height: 8px;
  width: 8px;
  margin-right: 2px;
  margin-bottom: 2px;
  background: #000000;
  border-radius: 38%;
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
</div>
<br>&emsp;
<a class="back-icon" href="adminforms.php">
  <div class="back-icon__row">
    <div class="back-icon__elem"></div>
    <div class="back-icon__elem"></div>
    <div class="back-icon__elem"></div>
  </div>
   <div class="back-icon__row">
    <div class="back-icon__elem"></div>
    <div class="back-icon__elem"></div>
    <div class="back-icon__elem"></div>
  </div>
  <div class="back-icon__row">
    <div class="back-icon__elem"></div>
    <div class="back-icon__elem"></div>
    <div class="back-icon__elem"></div>
  </div>
</a>

<h1>New Student info</h1>
			<section id="three" class="wrapper align-center">
				<div class="inner">
					<div class="flex flex-2">
						<article>
							<div class="image round">
								<img src="pic01.png" alt="Pic 01" />
							</div>
							<header>
								<h3>Student Details</h3>
							</header>
							
							<footer>
								<button onclick="document.getElementById('id01').style.display='block'" style="width:auto;">Enter</button>
								<button onclick="location.href = 'sview.php';" style="width:auto;">Edit</button>
									<div id="id01" class="modal">
									  <span onclick="document.getElementById('id01').style.display='none'" class="close" title="Close Modal">&times;</span>
									  <form name="form" method="post" onsubmit="return checkForm(this);" action="" class="modal-content" enctype='multipart/form-data'>
										<div class="container">
										  <h1>Student Details</h1>
										  <p>Please enter Student details.</p>
										  <hr>
										  <label for="Student name"><b>Student name:</b></label>
										  <input type="text" placeholder="Enter student name" name="sname" required>
										  
										  <label for="USN"><b>Student USN:</b></label>
										  <input type="text" placeholder="Enter USN" name="susn" required minlength="10" maxlength="10">

										  <label for="Sem"><b>Semester and Section:</b></label>   
											<select type="text" placeholder="Enter Sem" class="form-control" id="sel1" name="ssem" required>
												<option></option>
												<optgroup label="1th semester">
												<option value="1 A">1 A</option><option value="1 B">1 B</option><option value="1 C">1 C</option>
												</optgroup>
												<optgroup label="2th semester">
												<option value="2 A">2 A</option><option value="2 B">2 B</option><option value="2 C">2 C</option>
												</optgroup>
												<optgroup label="3th semester">
												<option value="3 A">3 A</option><option value="3 B">3 B</option><option value="3 C">3 C</option>
												</optgroup>
												<optgroup label="4th semester">
												<option value="4 A">4 A</option><option value="4 B">4 B</option><option value="4 C">4 C</option>
												</optgroup>
												<optgroup label="5th semester">
												<option value="5 A">5 A</option><option value="5 B">5 B</option><option value="5 C">5 C</option>
												</optgroup>
												<optgroup label="6th semester">
												<option value="6 A">6 A</option><option value="6 B">6 B</option><option value="6 C">6 C</option>
												</optgroup>
												<optgroup label="7th semester">
												<option value="7 A">7 A</option><option value="7 B">7 B</option><option value="7 C">7 C</option>
												</optgroup>
												<optgroup label="8th semester">
												<option value="8 A">8 A</option><option value="8 B">8 B</option><option value="8 C">8 C</option>
												</optgroup>
											</select>
											

										  <label for="CGPA"><b>CGPA:</b></label>
										  <input type="text" placeholder="Enter CGPA (d.dd format)" name="scgpa" required>
										   
										  <label for="NUMBER"><b>Phone Number:</b></label>
										  <input type="text" placeholder="Enter Phone number" name="phno" required minlength="10" maxlength="10">

										  <div class="clearfix">
											(Note : This USN will be student's username and phone number will be password)
											<button type="submit" class="submitbtn" name="submit1" >enter</button>
										  </div>
										</div>
									  </form>
									</div>
							</footer>
						</article>
						<article>
							<div class="image round">
								<img src="pic02.png" alt="Pic 02" />
							</div>
							<header>
								<h3>Student Course Details</h3>
							</header>
							<footer>
								<!--<button onclick="document.getElementById('id04').style.display='block'" style="width:auto;">Enter</button>-->
								<button onclick="location.href = 'scview.php';" style="width:auto;">Enter</button>
								<!--<div id="id04" class="modal">
								  <span onclick="document.getElementById('id04').style.display='none'" class="close" title="Close Modal">&times;</span>
								  <form name="form" method="post" action="" class="modal-content" enctype='multipart/form-data'>
									<div class="container">
									  <h1>Courses enrolled by Student Details</h1>
									  <p>Please enter details.</p>
									  <hr>

									  <label for="USN"><b>Student USN:</b></label>&emsp;
									  
									  <?php         
										$conn=mysqli_connect("localhost","root","");
										mysqli_select_db($conn,'attendence_management');
										$sql="select usn,s_name from student";
										$run=mysqli_query($conn, $sql);
										if($run->num_rows){
										$select= '<select name="susn" class="form-control" id="sel1" required><option></option><optgroup label="Enrolled Students USNs - Student names">';
										while($row=mysqli_fetch_array($run)){
											  $select.='<option value="'.$row['usn'].'">'.$row['usn'].' - '.$row['s_name'].'</option>';
										  }
										}
										$select.='</optgroup></select>';
										echo $select;
									   ?>
										<br>
										  <label for="Course code"><b>Course code:</b></label>&emsp;
										  <?php         
											$conn=mysqli_connect("localhost","root","");
											mysqli_select_db($conn,'attendence_management');
											$sql="select course_code, course_name from course";
											$run=mysqli_query($conn, $sql);
											if($run->num_rows){
											$select= '<select name="ccode" class="form-control" id="sel1" required><option></option><optgroup label="Course codes - Course name">';
											while($row=mysqli_fetch_array($run)){
												  $select.='<option value="'.$row['course_code'].'">'.$row['course_code'].' - '.$row['course_name'].'</option>';
											  }
											}
											$select.='</optgroup></select>';
											echo $select;
										   ?>
										<br>
									  
										<button type="submit" class="submitbtn" name="submit4">enter</button>
									  </div>
									</div>
								  </form>-->
								</div>
							</footer>
						</article>
						<br><br>
						<article>
							<div class="image round">
								<img src="pic03.jpg" alt="Pic 02" />
							</div>
							<header>
								<h3>SEE Details</h3>
							</header>
							<footer>
								<button onclick="document.getElementById('id06').style.display='block'" style="width:auto;">Enter</button>
								<div id="id06" class="modal">
								  <span onclick="document.getElementById('id06').style.display='none'" class="close" title="Close Modal">&times;</span>
								  <form name="form" onsubmit="return checkSForm(this);" method="post" action="" class="modal-content" enctype='multipart/form-data'>
									<div class="container">
									  <!--<h1>Courses enrolled by Student Details</h1>
									  <p>Please enter details.</p>
									  <hr>

									  <label for="USN"><b>Student USN:</b></label>&emsp;
									  
									  <?php         
										$conn=mysqli_connect("localhost","root","");
										mysqli_select_db($conn,'attendence_management');
										$sql="select usn,s_name from student";
										$run=mysqli_query($conn, $sql);
										if($run->num_rows){
										$select= '<select name="susn" class="form-control" id="sel1" required><option></option><optgroup label="Enrolled Students USNs - Student names">';
										while($row=mysqli_fetch_array($run)){
											  $select.='<option value="'.$row['usn'].'">'.$row['usn'].' - '.$row['s_name'].'</option>';
										  }
										}
										$select.='</optgroup></select>';
										echo $select;
									   ?>
										<br>
										  <label for="Course code"><b>Course code:</b></label>&emsp;
										  <?php         
											$conn=mysqli_connect("localhost","root","");
											mysqli_select_db($conn,'attendence_management');
											$sql="select course_code, course_name from course";
											$run=mysqli_query($conn, $sql);
											if($run->num_rows){
											$select= '<select name="ccode" class="form-control" id="sel1" required><option></option><optgroup label="Course codes - Course name">';
											while($row=mysqli_fetch_array($run)){
												  $select.='<option value="'.$row['course_code'].'">'.$row['course_code'].' - '.$row['course_name'].'</option>';
											  }
											}
											$select.='</optgroup></select>';
											echo $select;
										   ?>
										<br>
										
										<label for="NUMBER"><b>SEE Marks:</b></label>
										  <input type="text" placeholder="Enter see marks" name="seem" required minlength="1" maxlength="3">
									  
										<button type="submit" class="submitbtn" name="submit6">enter</button>-->
										<p>Choose one of the options</p>
									  <hr>
										  <a href="scourse.php" class="btn"><b>Enter SEE Course wise </b></a>
										  <a href="seview.php" class="btn"><b>Enter SEE Student wise </b></a>
									  </div>
									</div>
								  </form>
								</div>
							</footer>
						</article>
					</div>
				</div>
			</section>




<script>
// Get the modal
var modal = document.getElementById('id01');
var modal = document.getElementById('id04');
var modal = document.getElementById('id06');

// When the user clicks anywhere outside of the modal, close it
window.onclick = function(event) {
  if (event.target == modal) {
    modal.style.display = "none";
  }
}

var myIndex = 0;
carousel();

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
    var re = /^[\A-Z0-9]+$/;
    if(!re.test(form.susn.value)) {
      alert("Error: USN contains invalid characters!");
      form.susn.focus();
      return false;
    }
	
	var r = /^[A-Za-z. ]+$/;
	 if(!r.test(form.sname.value)) {
      alert("Error: Name contains invalid characters!");
      form.sname.focus();
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
	if(!re.test(form.scgpa.value)) {
	  if(!s.test(form.scgpa.value)){
      alert("Error: SGPA is invalid!");
      form.scgpa.focus();
      return false;
	  }
    }
	
    return true;
  }

   function checkSForm(form)
  {
	var re = /^[0-9]{1}[0-9]{1}$/;
	var s = /^[1]{1}[0]{2}$/;
	if(!re.test(form.seem.value)) {
	  if(!s.test(form.seem.value)){
      alert("Error: Sem end marks is invalid!");
      form.seem.focus();
      return false;
    }
	}
	return true;
  }
</script>

</main>

</body>

</html>