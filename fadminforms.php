<?php
	session_start();
	if(!isset($_SESSION['username'])){
		header("location:First%20page.php");
	} else {
	 $user=$_SESSION['username'];
	}
	
  	if(isset($_POST['submit2']))
  	{
  		$fname=$_POST['fname'];
  		$fid=$_POST['fid'];
		$phn=$_POST['phno'];

  		$conn=mysqli_connect("localhost","root","");
  		mysqli_select_db($conn,'attendence_management');
		// Check connection
		if ($conn->connect_error) {
		die("Connection failed: " . $conn->connect_error);
		}
  		$query="SELECT * FROM lecturer WHERE l_id='".$fid."'";
  		$res=mysqli_query($conn,$query);
  		$num=mysqli_num_rows($res);
  		if($num  >=  1)
  		{		echo "<script> alert('⚠️ This ID is already registered') </script>";
				echo "<script>location.href = 'http://localhost/project%20work/fadminforms.php';</script>";
  		}
  		else
  		{
				$sql = "INSERT INTO lecturer (l_id, l_name, password, phno) VALUES ('$fid', '$fname', '$phn', '$phn')";
				if ($conn->query($sql) === TRUE) {
							echo "<script> alert('New record inserted successfully') </script>";
							echo "<script>location.href = 'http://localhost/project%20work/fadminforms.php';</script>";
				} else {
							echo "<script> alert('Error..!!') </script>";
							echo "<script>location.href = 'http://localhost/project%20work/fadminforms.php';</script>";
				}
				$conn->close();
  		}
	}
	
  	if(isset($_POST['submit5']))
  	{
  		$fid=$_POST['fid'];
		$ccode=$_POST['ccode'];
		$fsem=$_POST['fsem'];
		
  		$conn=mysqli_connect("localhost","root","");
  		mysqli_select_db($conn,'attendence_management');
		// Check connection
		if ($conn->connect_error) {
		die("Connection failed: " . $conn->connect_error);
		}
  		$query="SELECT course_code FROM lec_course WHERE l_id='".$fid."' AND course_code='".$ccode."' AND sem='".$fsem."'";
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
  		{	echo "<script> alert('⚠️ Already registered ') </script>";
			echo "<script>location.href = 'http://localhost/project%20work/fadminforms.php';</script>";
  		}
  		else
  		{
				$sql = "INSERT INTO lec_course (course_code, l_id, sem, total_cls_taken) VALUES ('$ccode', '$fid', '$fsem' , 0)";
				
				if ($conn->query($sql) === TRUE) {
							echo "<script> alert('New record inserted successfully') </script>";
							echo "<script>location.href = 'http://localhost/project%20work/fadminforms.php';</script>";
				} else {
							echo "<script> alert('Error..!!') </script>";
							echo "<script>location.href = 'http://localhost/project%20work/fadminforms.php';</script>";
				}
				$conn->close();
  		}
	}
?>
<!DOCTYPE html>
<html>
<head>
<title>Faculty Forms</title>
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

			

	
<h1>New Faculty info</h1>
			<section id="three" class="wrapper align-center">
				<div class="inner">
					<div class="flex flex-2">
						<article>
							<div class="image round">
								<img src="pic05.jpg" alt="Pic 01" />
							</div>
							<header>
								<h3>Faculty Details</h3>
							</header>
							<footer>
							<button onclick="document.getElementById('id02').style.display='block'" style="width:auto;">Enter</button>
							<button onclick="location.href = 'fview.php';" style="width:auto;">Edit</button>
							<div id="id02" class="modal">
							  <span onclick="document.getElementById('id02').style.display='none'" class="close" title="Close Modal">&times;</span>
							  <form name="form" onsubmit="return checkFForm(this);" action="" method="post" class="modal-content">
								<div class="container">
								  <h1>Faculty Details</h1>
								  <p>Please enter faculty details.</p>
								  <hr>
								  <label for="Faculty name"><b>Faculty name:</b></label><br>
								  <input type="text" placeholder="Enter faculty name" name="fname" required><br>

								  <label for="Faculty ID"><b>Faculty ID: </b></label>(Enter as 'dept@f_name' ,ex:cse@nnn)<br>
								  <input type="text" placeholder="Enter Faculty ID" name="fid" required><br>

								  <label for="NUMBER"><b>Phone Number:</b></label><br>
								  <input type="text" placeholder="Enter Phone number" name="phno" required minlength="10" maxlength="10"><br>
								  
									(Note : This Faculty ID will be Faculty's username and phone number will be password)
								  <div class="clearfix">
									<button type="submit" class="submitbtn" name="submit2">enter</button>
								  </div>
								</div>
							  </form>
							</div>
							</footer>
						</article>
						<article>
							<div class="image round">
								<img src="pic04.png" alt="Pic 02" />
							</div>
							<header>
								<h3>Faculty Course Details</h3>
							</header>
							<footer>
								<button onclick="document.getElementById('id05').style.display='block'" style="width:auto;">Enter</button>
								<button onclick="location.href = 'fcview.php';" style="width:auto;">Edit</button>
								<div id="id05" class="modal">
								  <span onclick="document.getElementById('id05').style.display='none'" class="close" title="Close Modal">&times;</span>
								  <form name="form" method="post" class="modal-content" action="" enctype='multipart/form-data'>
									<div class="container">
									  <h1>Courses handeled by Faculty Details</h1>
									  <p>Please enter details.</p>
									  <hr>

									  <label for="Faculty ID"><b>Faculty ID:</b></label>&emsp;
									  <?php         
										$conn=mysqli_connect("localhost","root","");
										mysqli_select_db($conn,'attendence_management');
										$sql="select l_id, l_name from lecturer";
										$run=mysqli_query($conn, $sql);
										if($run->num_rows){
										$select= '<select name="fid" class="form-control" id="sel1" required><option></option><optgroup label="Faculty IDs - Faculty Names">';
										while($row=mysqli_fetch_array($run)){
											  $select.='<option value="'.$row['l_id'].'">'.$row['l_id'].' - '.$row['l_name'].'</option>';
										  }
										}
										$select.='</optgroup></select>';
										echo $select;
									   ?>
										<br>

									  <label for="Sem"><b>Semester and Section:</b></label>    <br>
										<select type="text" placeholder="Enter Sem" name="fsem" class="form-control" id="sel1" required>
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


									  
										<button type="submit" class="submitbtn" name="submit5">enter</button>
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
var modal = document.getElementById('id02');
var modal = document.getElementById('id03');
var modal = document.getElementById('id04');
var modal = document.getElementById('id05');
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


  function checkFForm(form)
  {
    var re =/^[\w]{3}@[\w]{3}$/;
    if(!re.test(form.fid.value)) {
      alert("Error: Faculty ID is not in given format!!");
      form.fid.focus();
      return false;
    }
	
	var r = /^[A-Za-z. ]+$/;
	if(!r.test(form.fname.value)) {
      alert("Error: Name contains invalid characters!");
      form.fname.focus();
      return false;
    }

	var p = /^\d{10}$/;
	if(!p.test(form.phno.value)) {
      alert("Error: Phone number must contain 10 digits only!");
      form.phno.focus();
      return false;
    }
	
    return true;
  }
</script>

</main>

</body>

</html>