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
if(isset($_POST['update']))
{
$name=$_POST['name'];
$cgpa=$_POST['cgpa'];
$phno=$_POST['phno'];
$sem=$_POST['sem'];
$uid=$_GET['usn'];
$ad="update student set s_name=?, cgpa=?, phno=?, sem=? where usn=?";
$stmt= $mysqli->prepare($ad);
$stmt->bind_param('ssiss',$name,$cgpa,$phno,$sem,$uid);
$stmt->execute();
// $newId = $stmtins->insert_id;
$stmt->close();
echo "<script>alert('Data updated Successfully');</script>" ;
echo "<script>location.href = 'http://localhost/project%20work/sview.php';</script>";
}?>

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
<button class="glow-on-hover" onclick="location.href = 'sview.php';" type="button">Back</button>
<?php
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
	<h4 style="color: grey">Student USN : <b  style="color: blue"><?php echo $row->usn;?></b></h4><br>
<fieldset>
	<h4>Name</h4>
  <input type="text" name="name" value="<?php echo $row->s_name;?>" tabindex="1" required autofocus>
</fieldset> 

</fieldset> 
<h4>Semester</h4>
  <select type="text" name="sem" tabindex="2" required autofocus>
												<option value="<?php echo $row->sem;?>"><?php echo $row->sem;?></option>
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
</fieldset>

<fieldset>
<h4>Phone Number</h4>
  <input type="text" name="phno" value="<?php echo $row->phno; ?>" tabindex="3" required autofocus>
</fieldset> 

<fieldset>
<h4>CGPA</h4>
  <input type="text" name="cgpa" value="<?php echo $row->cgpa; ?>" tabindex="4" required autofocus>
</fieldset> 
    <fieldset>
	      <button  type="submit"  onclick="return confirm('Are you sure?')" name="update" value="Submit" id="contact-submit" required>Submit</button>
	</fieldset>
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
	
	var re = /^[0-9]{1}\.[0-9]*$/;
	var s = /^[1]{1}[0]{1}\.[0]*$/;
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

