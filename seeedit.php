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
$id=$_GET['usn'];
$cc=$_GET['cc'];
$see=$_POST['see'];
$ad="update student_course_info set see=? where usn=? and course_code=?";
$stmt= $mysqli->prepare($ad);
$stmt->bind_param('iss',$see,$id,$cc);
$stmt->execute();
// $newId = $stmtins->insert_id;
$stmt->close();
echo "<script>alert('Data updated Successfully');</script>" ;
header('location:seedit.php?usn='.$id);
}?>

<!DOCTYPE html>
<html>
<head>
<title>SEE Edit</title>
    <!-- Required meta tags -->
    <meta charset="utf-8"> 
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no"> 
<title>attendance(fac)</title>  
    <!-- Bootstrap CSS -->
<link rel="stylesheet" type="text/css" href="attend.css">
<link rel="stylesheet" type="text/css" href="back_button.css">
<link rel="stylesheet" type="text/css" href="form.css">
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
.card {
  box-shadow: 0 4px 8px 0 rgba(0, 0, 0, 0.2);
  max-width: 300px;
  margin: auto;
  text-align: center;
  font-family: arial;
  background-color: #fffdd0;
}
.title {
  font-size: 18px;
}
m {
  color: green;
  font-style: italic;
}
.container 
{ margin: 25px auto;
 position: relative;
 width: 900px;
 }
  #content {
    background: #f9f9f9;
    background: -moz-linear-gradient(top,  rgba(248,248,248,1) 0%, rgba(249,249,249,1) 100%);
    background: -webkit-linear-gradient(top,  rgba(248,248,248,1) 0%,rgba(249,249,249,1) 100%);
    background: -o-linear-gradient(top,  rgba(248,248,248,1) 0%,rgba(249,249,249,1) 100%);
    background: -ms-linear-gradient(top,  rgba(248,248,248,1) 0%,rgba(249,249,249,1) 100%);
    background: linear-gradient(top,  rgba(248,248,248,1) 0%,rgba(249,249,249,1) 100%);
    filter: progid:DXImageTransform.Microsoft.gradient( startColorstr='#f8f8f8', endColorstr='#f9f9f9',GradientType=0 );
    -webkit-box-shadow: 0 1px 0 #fff inset;
    -moz-box-shadow: 0 1px 0 #fff inset;
    -ms-box-shadow: 0 1px 0 #fff inset;
    -o-box-shadow: 0 1px 0 #fff inset;
    box-shadow: 0 1px 0 #fff inset;
    border: 1px solid #c4c6ca;
    margin: 20px auto;
    padding: 25px;
    position: relative;
    text-align: center;
    text-shadow: 0 1px 0 #fff;
    width: 400px;
}.Submit {
  border-radiux;
  padding: 10px;
  font-size: 16px;
  margin-top: 15px;
  margin-bottom: 20px;
  width: 30%;
  background-color: #21afde;
  border: none;
  outline: none;
  cursor: pointer;
}
.Submit:active {
  transform: translateY(5px);
  opacity: 0.6;
}
.Submit:hover {
  background-color: #1c8adb;
  box-shadow: 0 12px 16px 0 rgba(0,0,0,0.24), 0 17px 50px 0 rgba(0,0,0,0.19);
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
</div><br>&emsp;
<button class="glow-on-hover" onclick="location.href = 'seedit.php?usn=<?php echo $_GET['usn'];?>';" type="button">Back</button>
<?php
$id=$_GET['usn'];
$cc=$_GET['cc'];
$ret = "select a.*, b.*, c.* from student_course_info a, student b, course c where a.usn=b.usn and a.course_code=c.course_code and a.usn=? and a.course_code=?";
$stmt2 = $mysqli->prepare($ret);
$stmt2->bind_param('ss',$id,$cc);
$stmt2->execute();
$res=$stmt2->get_result();
$cnt=1;
while($row=$res->fetch_object())
{
?>
<div class="container">  
  <form id="contact" name="form" onsubmit="return checkSForm(this);" action="" method="post">
    <h3 style="text-align: center">Students List Edit</h3><br>
	<h4 style="color: grey">Student USN : <b  style="color: blue"><?php echo $row->usn;?></b></h4>
	<h4 style="color: grey">Student Name : <b  style="color: blue"><?php echo $row->s_name;?></b></h4>
	<h4 style="color: grey">Course Code : <b  style="color: blue"><?php echo $row->course_code;?></b></h4>
	<h4 style="color: grey">Course Name : <b  style="color: blue"><?php echo $row->course_name;?></b></h4><br>
	<h4 style="color: grey">Enter SEE marks</b></h4>
	<fieldset>
	  <?php if($row->SEE=='-1'){?>
	  <input type="text" name="see" placeholder="Enter Marks" required="required" tabindex="1" autofocus>
	  <p><b  style="color: red">NOTE: The student was absent for the exam</b></p>
	  <?php } else {?>
	  <input type="text" name="see" placeholder="Enter Marks" value="<?php echo $row->SEE; ?>" required="required" tabindex="1" autofocus>
	  <?php }?>
	</fieldset>
    <fieldset>
	      <button  name="update" value="Submit" type="submit" id="contact-submit" onclick="return confirm('Are you sure?')" required>Submit</button>
 
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
   function checkSForm(form)
  {
	var re = /^[0-9]{1}[0-9]{1}$/;
	var s = /^[1]{1}[0]{2}$/;
	if(!re.test(form.see.value)) {
	  if(!s.test(form.see.value)){
      alert("Error: Sem end marks is invalid!");
      form.see.focus();
      return false;
    }
	}
	return true;
  }
</script>

</main>

</body>

</html>