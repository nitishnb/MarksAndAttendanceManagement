<?php 
	function phpAlert($msg) 
	{ 
		echo '<script type="text/javascript">alert("' . $msg . '")</script>'; 
	} 
	error_reporting(-1);
	ini_set('display_errors', true);
	$num=0;
	$rows = empty($_POST['rows']) ? 0 : (int)$_POST['rows'] ;
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
<link rel="stylesheet" type="text/css" href="table.css">
<link rel="stylesheet" type="text/css" href="back_button.css">
<style>
.button3{
display:inline-block;
padding:0.3em 1.2em;
margin:0 0.3em 0.3em 0;
border-radius:2em;
box-sizing: border-box;
text-decoration:none;
font-family:'Roboto',sans-serif;
font-weight:300;
color:#FFFFFF;
background-color:#4eb5f1;
text-align:center;
transition: all 0.2s;
}
a.button3:hover{
background-color:#4095c6;
}
@media all and (max-width:30em){
.button3{
display:block;
margin:0.2em auto;
}
}
input, select {
    display: block;
    width: 100%;
    padding: 8px 16px;
    line-height: 25px;
    font-size: 14px;
    font-weight: 500;
    font-family: inherit;
    border-radius: 6px;
    -webkit-appearance: none;
    color: var(--input-color);
    border: 1px solid var(--input-border);
    background: var(--input-background);
    transition: border .3s ease;
    &::placeholder {
        color: var(--input-placeholder);
    }
    &:focus {
        outline: none;
        border-color: var(--input-border-focus);
    }
}
.effect-7{border: 1px solid #ccc; padding: 7px 14px 9px; transition: 0.4s;}

.effect-7 ~ .focus-border:before,
.effect-7 ~ .focus-border:after{content: ""; position: absolute; top: 0; left: 50%; width: 0; height: 2px; background-color: #3399FF; transition: 0.4s;}
.effect-7 ~ .focus-border:after{top: auto; bottom: 0;}
.effect-7 ~ .focus-border i:before,
.effect-7 ~ .focus-border i:after{content: ""; position: absolute; top: 50%; left: 0; width: 2px; height: 0; background-color: #3399FF; transition: 0.6s;}
.effect-7 ~ .focus-border i:after{left: auto; right: 0;}
.effect-7:focus ~ .focus-border:before,
.effect-7:focus ~ .focus-border:after{left: 0; width: 100%; transition: 0.4s;}
.effect-7:focus ~ .focus-border i:before,
.effect-7:focus ~ .focus-border i:after{top: 0; height: 100%; transition: 0.6s;}

.col-3{float: left; width: 20%; margin: 40px 3%; position: relative;} /* necessary to give position: relative to parent. */
input[type="text"]{font: 15px/24px "Lato", Arial, sans-serif; color: #333; width: 100%; box-sizing: border-box; letter-spacing: 1px;}

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

  <center><h2>Student Details Form</h2><br>
        </center>
<?php if($rows==0) {?>
	<div class="container">  
  <form id="contact" name="form" action="" method="post">
<fieldset>
	<h4>&emsp;Enter No. of Records to be Inserted</h4><div class="col-3">
        	<input class="effect-7" placeholder="No. Of Students" type="text" name="rows" tabindex="1" required autofocus />
            <span class="focus-border">
            	<i></i>
            </span>
        </div>
		<br><br><button name="submit" type="submit" value="Add" class="button3">ADD</button>
</fieldset> 
  </form>
</div>
<?php } 
else {?>
<p style="text-align: center">(Enter <?php echo $rows;?> Students' details)</p>
<?php } 
 if(0 !== $rows): ?>	
<TABLE class="customer-table" width="350px" border="1">
			<thead>
			<tr>
			<th>Sl. No</th>
			<th>USN</th>
			<th>Name</th>
			<th>Semester</th>
			<th>CGPA</th>
			<th>Phone No.</th>
			</tr>
		</thead>
        <!-- create loop which loops the number of times defined in $rows -->
        <?php foreach(range(1, $rows) as $row): ?>
										  <TR>
									<form onsubmit="return checkForm(this);" name="form" action="" method="post">
									<TD> <?php echo $row;?> </TD>
									<TD> <INPUT placeholder="Enter USN" type="text" name="usn[]" required /> </TD>	
									<TD> <INPUT placeholder="Enter Name" type="text" name="name[]" id='name'/> </TD>										
									<TD><select type="text" name="sem[]" required>
																		<option></option>
																		<optgroup label="4th semester">
																		<option value="4 A">4 A</option>
																		<option value="4 B">4 B</option>
																		<option value="4 C">4 C</option>
																		</optgroup>
																	</select></TD>
									<TD> <INPUT placeholder="Enter Cgpa(D.DD)" type="text" name="cgpa[]"  required /> </TD>
									<TD> <INPUT placeholder="Enter Phone number" type="text" name="phno[]" required /> </TD>
									</form>
								</TR>
        <?php endforeach; ?>
</TABLE><br>
	<center><button type="submit" name="enter" class="button3" onclick="return confirm('Are you sure?')">SUBMIT</button></center>
      <?php endif; ?>


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

function validateForm(){
  if((document.getElementById("name").value).length == 0){
 			alert(" Please Enter Name Value!");  
    		return false;
  }	 	
}

  function checkForm(form)
  {
	
	var r = /^[A-Za-z. ]+$/;
	var n=document.getElementById("name").value;
	 if(!r.test(n)) {
      alert("Error: Name contains invalid characters!");
	  document.getElementById("name").focus();
      return false;
    }
	
		var p = /^\d{10}$/;
	if(!p.test(form.phno[].value)) {
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

<?php
				$conn=mysqli_connect("localhost","root","");
				mysqli_select_db($conn,'attendence_management');
				// Check connection
				if ($conn->connect_error) {
				die("Connection failed: " . $conn->connect_error);
				}
  	if(isset($_POST['enter']))
  	{	
		$num=0;
  		$usn=$_POST['usn'];
		$i=count($usn);
		if(count(array_unique($usn)) < $i)
		{
			$num=-1;
			phpAlert("⚠️ Two or more students have same USNs..!!");
		}
		for($k = 0; $k < $i; $k++) {
				 for($j = 0; $j < $i; $j++) {
							if ($_POST['usn'][$j] == $_POST['usn'][$k] ) {
										$num==1;
							} 
				  }
				if($num  ==  1)
				{
					phpAlert("⚠️ The Student with ".$u." is entered twice or more.");
				}
		}
		if($num  ==  0){
		foreach($usn as $u):
				$query="SELECT usn FROM student";
				$res=mysqli_query($conn,$query);
				if ($res->num_rows > 0) {
				// output data of each row
				while($row = $res->fetch_assoc()) {
					if($row["usn"]===$u)
						$num=1;
				}
				}
				if($num  ==  1)
				{
					phpAlert("⚠️ The Student with ".$u." is already Enrolled.");
					break 1;
				}
		endforeach;
		}
		
	if($num==0){
      for($j = 0; $j < $i; $j++) {
				$usn=$_POST['usn'][$j];
				$name=$_POST['name'][$j];
				$sem=$_POST['sem'][$j];
				$cgpa=$_POST['cgpa'][$j];
				$phno=$_POST['phno'][$j];
				$sql = "INSERT INTO student (usn, s_name, sem, cgpa, password, phno) VALUES ('$usn', '$name', '$sem', '$cgpa', '$phno', '$phno')";
				if ($conn->query($sql) === TRUE) {
							$num==0;
				}
      }
	  if($num==0){
	  phpAlert("Succesfully inserted ".$i." records..!!");
	  }
	  else
		  phpAlert("Error..!!");
	}
		$conn->close();
	}
?>

</main>

</body>

</html>

