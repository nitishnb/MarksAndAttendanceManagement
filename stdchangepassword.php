<?php
session_start();
if(!isset($_SESSION['usn'])){
    header("location:First%20page.php");
} else {
 $username=$_SESSION['usn'];
}
    $msg="";
    if(isset($_POST['reset']))
    {
        $oldpass=$_POST['pass'];
        $password=$_POST['password'];
        $cpassword=$_POST['cpassword'];
        $conn=mysqli_connect("localhost","root","", "attendence_management");
		$qu1 = mysqli_query($conn, "select * from student where usn='".$username."' and password='".$oldpass."'");
        if (mysqli_fetch_assoc($qu1) == 0) {
			$msg="Old password is incorrect..!!";
        }
		else{
        if ($password != $cpassword) {
            $msg = "New Passwords didn't match..!!";

        }
        else 
        {
           $sql="select * from student where usn='".$username."'";
           $res=mysqli_query($conn,$sql);
           if(mysqli_num_rows($res) == 1){
              $sql1="update student set password = '".$password."' where usn='".$username."'";
              $res1=mysqli_query($conn,$sql1);
              if($res1) {
                $msg = 'Successfully updated your password..!!';
               }
               else {
                $msg = "Could not update your password!";
               }
          }
          else {
            $msg = "Invalid username/password!";
          }   
      }
	}
  }
  
?>
<!DOCTYPE html>
<html>
<head>
<link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.2.1/css/bootstrap.min.css" integrity="sha384-GJzZqFGwb1QTTN6wy59ffF1BuGJpLSa9DkKMp0DgiMDm4iYMj70gZWKYbI706tWS" crossorigin="anonymous"> 
<link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css">
<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css">

<style>
body {
  margin: 0, auto;
  background-image: url("n1.jpg");
  background-repeat: no-repeat;
  color: #000;
  background-attachment: fixed;
  background-size: cover;
}
.container 
{ margin: 25px auto;
  padding: 5px;
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
}
.Submit {
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
</head>

<link rel="stylesheet" type="text/css" href="attend.css">
<main id="mainn">
<div id="mySidenav" class="sidenav">
  <a href="About_Student.html">About</a>
  <a href="stdprofile.php"> My profile </a>
  <a href="course-info.html">Course info</a>
</div>


<div class="topctr">
     <div id ="main" class="menuic" onclick="myFunction(this)">
     <div class="bar1"></div>
     <div class="bar2"></div>
     <div class="bar3"></div>
     </div>
   &emsp;&emsp;&emsp;<img src="https://upload.wikimedia.org/wikipedia/en/thumb/8/87/BMS_College_of_Engineering.svg/1200px-BMS_College_of_Engineering.svg.png" height="30px" width="30px">&emsp;<cap> BMSCE </cap> 
  
<div class="header-right">
    <a href="logouts.php">Logout</a>
</div>
<div class="header-right">
    <a href="attendence(std).php">Attendance</a> 
</div>
<div class="header-right">
    <a href="marks(std).php">Marks</a>
</div>
<div class="header-right">
    <a href="student1.php">Home</a>
</div>
</div>
<br><br>
<div class="container">
 <section id="content">
   <form method="POST">
    <h1>Change Password</h1>
<br>             <!-- Material input -->
<div class="md-form">
  <input type="password" id="form1" class="form-control" name="pass" placeholder="Old password">
  <label for="form1"></label>
</div>
<div class="md-form">
  <input type="password" id="form1" class="form-control" name="password" placeholder="New password">
  <label for="form1"></label>
</div>
<div class="md-form">
  <input type="password" id="form1" class="form-control" name="cpassword" placeholder="Retype password">
  <label for="form1"></label>
</div>
 <div>
 <input class="Submit" type="submit" value="Reset" name="reset" />
	<br>
	  	<?php
			if($msg=="Successfully updated your password..!!")
  			echo nl2br('<span style="color:#0B570B;text-align:center;">'.$msg.'</span>');
			else
  			echo '<span style="color:#F92727;text-align:center;">'.$msg.'</span>';
		?>
            </div>
        </form><!-- form -->
        
    </section><!-- content -->
</div><!-- container -->


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

