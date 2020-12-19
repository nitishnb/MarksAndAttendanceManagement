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
$phno=$_POST['phno'];
$uid=$_GET['lid'];
$ad="update lecturer set l_name=?, phno=? where l_id=?";
$stmt= $mysqli->prepare($ad);
$stmt->bind_param('sis',$name,$phno,$uid);
$stmt->execute();
// $newId = $stmtins->insert_id;
$stmt->close();
echo "<script>alert('Data updated Successfully');</script>" ;
echo "<script>location.href = 'http://localhost/project%20work/fview.php';</script>";
}?>

<!DOCTYPE html>
<html>
<head>
<title>Faculty Edit</title>
    <!-- Required meta tags -->
    <meta charset="utf-8"> 
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no"> 
<title>attendance(fac)</title>  
    <!-- Bootstrap CSS -->
<link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.2.1/css/bootstrap.min.css" integrity="sha384-GJzZqFGwb1QTTN6wy59ffF1BuGJpLSa9DkKMp0DgiMDm4iYMj70gZWKYbI706tWS" crossorigin="anonymous"> 
<link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css">
<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css">
<link rel="stylesheet" type="text/css" href="attend.css">
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
</div>
<br>&emsp;
<button class="glow-on-hover" onclick="location.href = 'fview.php';" type="button">Back</button>
<?php
$id=$_GET['lid'];
$ret = "select * from lecturer where l_id=?";
$stmt2 = $mysqli->prepare($ret);
$stmt2->bind_param('s',$id);
$stmt2->execute();
$res=$stmt2->get_result();
$cnt=1;
while($row=$res->fetch_object())
{
?>
<div class="container">
 <section id="content">
   <form name="form" onsubmit="return checkFForm(this);" action="" method="post">
    <h1>FACULTY EDIT</h1><br>
	<h5>Faculty ID : <?php echo $row->l_id;?></h5>
<br>             <!-- Material input -->
<div class="md-form">
 <label for="form1">FACULTY NAME</label>
  <input type="text" name="name" value="<?php echo $row->l_name;?>" required="required"  id="form1" class="form-control">
</div><br>
<div class="md-form">
 <label for="form1">CONTACT NO.</label>
  <input type="text" name="phno" value="<?php echo $row->phno; ?>" required="required" id="form1" class="form-control">
</div><br>
 <div>
 <input class="Submit" type="submit" name="update" value="Submit"  onclick="return confirm('Are you sure?')"/>
  <br><br>
            </div>
        </form><!-- form -->
</section>
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
  function checkFForm(form)
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
	
    return true;
  }
</script>

</main>

</body>

</html>