<?php
	session_start();
	if(!isset($_SESSION['username'])){
		header("location:First%20page.php");
	} else {
	 $user=$_SESSION['username'];
	}
?>
<!DOCTYPE html>
<html>
<head>
<title>last Logins</title>
    <!-- Required meta tags -->
    <meta charset="utf-8"> 
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no"> 


<link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css">
<link rel="stylesheet" type="text/css" href="attend.css">
<link rel="stylesheet" type="text/css" href="table.css">
<meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.0/css/bootstrap.min.css">
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
  <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.16.0/umd/popper.min.js"></script>
  <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.0/js/bootstrap.min.js"></script>
<style>
h2
{
  text-align: center;
}
body {
  margin: 0, auto;
  background-image: url("admin1.jpg");
  background-repeat: no-repeat;
  color: #000;
  background-attachment: fixed;
  background-size: cover;
}
.logo {
    margin-top: 75px;
    text-align: center;
    font-size: 42px;
    font-family: Verdana, sans-serif;
    color: #BFCBD6;
}
.button {
  transform: translate(-25%,-30%);
}
</style>
<body>
<main id="mainn">
<div id="mySidenav" class="sidenav">
  <a href="adminforms.php">Home</a>
   <a href="About_admin.html">About</a>
   <a href="logins.php" >Logins' List</a>
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
    <a href="logins.php" class="att">Logins' List</a>
    </div>&emsp;
<div class="header-right">
    <a href="About_admin.html">About</a>
    </div>&emsp;
<div class="header-right">
    <a href="adminforms.php">Home</a>
</div>
</div>
<br><br>
  <h2><b style="color:white">Last 10 Logins' List</b></h2><br>          
  <table class="customer-table">
    <thead >
      <tr>
        <th>Sl.no</th>
        <th>&emsp;&emsp;&emsp;User Name</th>
        <th>&emsp;&emsp;&emsp;Id/USN</th>
        <th>&emsp;&emsp;&emsp;Contact.no</th>
        <th>&emsp;&emsp;Time</th>
        <th>&emsp;&emsp;&emsp;Date(Y-M-D)</th>
        <th>&emsp;&emsp;&emsp;Category</th>
      </tr>
    </thead>
	 <tfoot>
			<tr>
				<td colspan="3">
					Read Only
				</td>
			</tr>
		</tfoot>
    <?php 
   $conn=mysqli_connect("localhost","root","","");
   mysqli_select_db($conn,'attendence_management');
     $q2="select * from logins";  
     $run=mysqli_query($conn, $q2);
     while($row=mysqli_fetch_array($run))
     {
     ?>		
    <tbody>
      <tr>
        <td><?php echo $row['sno']; ?></td>
        <td><?php echo $row['u_name']; ?></td>
        <td><?php echo $row['id']; ?></td>
        <td><?php echo $row['contact']; ?></td>
        <td><?php echo $row['time']; ?></td>
        <td><?php echo $row['date']; ?></td>
        <td><?php echo $row['category']; ?></td>
      </tr>
    <?php }?>
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



