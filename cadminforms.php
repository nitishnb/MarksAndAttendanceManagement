<?php
	session_start();
	if(!isset($_SESSION['username'])){
		header("location:First%20page.php");
	} else {
	 $user=$_SESSION['username'];
	}
	
  	if(isset($_POST['submit3']))
  	{
  		$ccode=$_POST['ccode'];
  		$cname=$_POST['cname'];
  		$hrs=$_POST['hrs'];
		$credits=$_POST['credits'];
		$lab=$_POST['lab'];

  		$conn=mysqli_connect("localhost","root","");
  		mysqli_select_db($conn,'attendence_management');
		// Check connection
		if ($conn->connect_error) {
		die("Connection failed: " . $conn->connect_error);
		}
  		$query="SELECT * FROM course WHERE course_code='".$ccode."'";
  		$res=mysqli_query($conn,$query);
  		$num=mysqli_num_rows($res);
  		if($num  >=  1)
  		{
					echo "<script> alert('⚠️ This Course code is already registered') </script>";
					echo "<script>location.href = 'http://localhost/project%20work/cadminforms.php';</script>";
  		}
  		else
  		{
				$sql = "INSERT INTO course (course_code, course_name, total_no_of_hrs_allocated, credits,lab) VALUES ('$ccode', '$cname', '$hrs', '$credits', '$lab')";
				if ($conn->query($sql) === TRUE) {
					echo "<script> alert('New record inserted successfully') </script>";
							echo "<script>location.href = 'http://localhost/project%20work/cadminforms.php';</script>";
				} else {
							echo "<script> alert('Error..!!') </script>";
							echo "<script>location.href = 'http://localhost/project%20work/cadminforms.php';</script>";
				}
				$conn->close();
  		}
	}
?>
<!DOCTYPE html>
<html>
<head>
<title>Course Forms</title>
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

			
<h1>New course info</h1>
			<section id="three" class="wrapper align-center">
				<div class="inner">
					<div class="flex flex-2">
						<article>
							<div class="image round">
								<img src="pic04.png" alt="Pic 01" />
							</div>
							<header>
								<h3>Course Details</h3>
							</header>
							<footer>
							<center><button onclick="document.getElementById('id03').style.display='block'" style="width:auto;">Enter</button>
							<button onclick="location.href = 'cview.php';" style="width:auto;">Edit</button>
							<div id="id03" class="modal">
							  <span onclick="document.getElementById('id03').style.display='none'" class="close" title="Close Modal">&times;</span>
							  <form name="form" onsubmit="return checkCForm(this);" action="" method="post" class="modal-content">
								<div class="container">
								  <h1>Course Details</h1>
								  <p>Please enter Course details.</p>
								  <hr>
								  <label for="Course name"><b>Course name:</b></label>
								  <input type="text" placeholder="Enter Course name" name="cname" required>

								  <label for="Course code"><b>Course code:</b></label>
								  <input type="text" placeholder="Enter Course Code" name="ccode" required>

								  <label for="Hours:"><b>No. of Hours:</b></label>
								  <input type="text" placeholder="Total no. of Hours alloted" name="hrs" required>

								  <label for="Credits"><b>Credits:</b></label>
								  <input type="text" placeholder="Enter no. of Credits" name="credits">

								  <div class="form-group">
								  <label for="sel1"><b>This Course has</b></label>
								  <select class="form-control" id="sel1" name="lab">
									<option></option>
									<option value="">Only CIE tests</option>
									<option value="YES">Laboratory and Theory Tests</option>
									<option value="NO">Only Theory Tests</option>
								  </select>
								  </div> 
								  <div class="clearfix">
									<button type="submit" class="submitbtn" name="submit3">enter</button>
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
var modal = document.getElementById('id03');

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
  function checkCForm(form)
  {
    var re = /^[\w]+$/;
    if(!re.test(form.ccode.value)) {
      alert("Error: Course code contains invalid characters!");
      form.ccode.focus();
      return false;
    }
	
	var r =  /^[A-Za-z ]+$/;
	 if(!r.test(form.cname.value)) {
      alert("Error: Course Name contains invalid characters!");
      form.cname.focus();
      return false;
    }

	var p = /^\d{1,2}$/;
	if(!p.test(form.hrs.value)) {
      alert("Error: No. of hours must contain atmost 2 digits only!");
      form.hrs.focus();
      return false;
    }
	
	var c = /^\d{1}$/;
	if(!c.test(form.credits.value)) {
      alert("Error: Credits must be of one digit!");
      form.credits.focus();
      return false;
    }
    return true;
  }
</script>

</main>

</body>

</html>