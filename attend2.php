<?php 
   session_start();
   $conn=mysqli_connect("localhost","root","","");
   mysqli_select_db($conn,'attendence_management');
   if (!isset($_SESSION['course_code']))
    header("location: fac.php");
  else
    $courseid = $_SESSION['course_code'];

?>
<!DOCTYPE html>
<html lang="en"> 
  <head> 
    <!-- Required meta tags -->
    <meta charset="utf-8"> 
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no"> 
<title>attendance(fac)</title>  
    <!-- Bootstrap CSS -->
<link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.2.1/css/bootstrap.min.css" integrity="sha384-GJzZqFGwb1QTTN6wy59ffF1BuGJpLSa9DkKMp0DgiMDm4iYMj70gZWKYbI706tWS" crossorigin="anonymous"> 
<link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css">
<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css">
  

<link rel="stylesheet" type="text/css" href="attend.css">
<style>
	  	body {
	  margin: 0, auto;
	  background-image: url("n3.jpg");
	  background-repeat: no-repeat;
	  color: #000;
	  background-attachment: fixed;
	  background-size: cover;
	}
</style>
</head>
<body>
<main id="mainn">
<div id="mySidenav" class="sidenav">
  <a href="#">About</a>
  <a href="facprofile.php"> My profile </a>
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
    <a href="logout.php">Logout</a>
</div>
<div class="header-right">
    <a class="att" href="#">Attendance</a> 
</div>
<div class="header-right">
    <a href="marks(fac).php">Marks</a>
</div>
<div class="header-right">
    <a href="faculty1.php">Home</a>
</div>
</div>
<br>

<div class="upbtn">
  
</div>
<div class="container">
  <h1><center> STUDENTS' ATTENDANCE SHEET </center></h1>

<form action="pdfgen1.php">
  <div class="upbtn">
    <button type = "submit" name="update" class="btn">Download</button> 
  </div>
</form>

<?php
     $l_id = $_SESSION['username'];
     $count = 0;
     $q1="SELECT c.course_name, c.total_no_of_hrs_allocated, lc.total_cls_taken, lc.last_taken from course c, lec_course lc where c.course_code=lc.course_code and c.course_code='".$courseid."'";
     $run=mysqli_query($conn, $q1);
     $num = mysqli_num_rows($run);
     $j = 0;
     if ($row = mysqli_fetch_assoc($run)) {
       $course = $row['course_name'];
       $taken = $row['total_cls_taken'];
       $hours = $row['total_no_of_hrs_allocated']; 
       $l_taken = $row['last_taken'];
     }

       ?>
<div class = "courseinfo"> 
  <div class="c1"> Course Name: <?php echo $course; ?> </div>
  <div class = "c1"> Course code: <?php echo $courseid; ?> </div>
  <div class = "c1"> Last Taken On("Y-M-D"): <?php if(!$l_taken) echo ""; else echo $l_taken; ?> </div>
</div>
<br>
<form  method="POST">
<table class="table table-hover">
  <thead>
    <tr>
      <th>Studen's USN</th>
      <th>Student's Name</th>
     <th>Attendance (<?php echo $taken; ?> / <?php echo $hours; ?>)  </th>
     <th>Continous Absence Alert!</th>
     <th>Total Attended</th>
    </tr>
  </thead>
     <?php 
     $q2="select s.s_name, s.usn, a.attendence_till_date, a.cont_absence_alrt from student s,lec_course lc, attendence a where s.usn=a.usn and a.course_code='".$courseid."' and  a.course_code = lc.course_code and lc.l_id = '".$l_id."' and s.sem = lc.sem order by usn";  
     $run=mysqli_query($conn, $q2);
     $i = 0;
     while($row=mysqli_fetch_array($run))
     {
     ?>
     <tbody>
      <tr>
        <td><?php echo $row['usn']; ?></td>
        <td><?php echo $row['s_name']; ?></td>
     <td> 
       <div class="custom-control custom-checkbox">
        <input type="checkbox" class="custom-control-input" id="<?php echo $i; ?>" name="present[]" value="<?php echo $row['usn']; ?>" unchecked />Present? &emsp;        
        <label class="custom-control-label" for="<?php echo $i; ?>"></label> 
      </div>
       </td>
       <?php 
       if($row['cont_absence_alrt'] == 0)
       {?>
       <td> 
       <div class="custom-control custom-checkbox">
        <input type="checkbox" class="custom-control-input" id="<?php echo $i+100; ?>" name="caa[]" value="<?php echo $row['usn']; ?>" unchecked />
                <img src="bell2.png" width="45" height="45" />       
        <label class="custom-control-label" for="<?php echo $i+100; ?>"></label> 
      </div>
       </td>
       <?php }
       else{?>
       <td> 
       <div class="custom-control custom-checkbox">
        <input type="checkbox" class="custom-control-input" id="<?php echo $i+100; ?>" name="caa[]" value="<?php echo $row['usn']; ?>" checked />
                <img src="bell2.png" width="45" height="45" />       
        <label class="custom-control-label" for="<?php echo $i+100; ?>"></label> 
      </div>
       </td>
       <?php }?>

     <td>
      <div class="md-form">
        <input type="text" id="form1" class="form-control text-center" id="<?php echo $i; ?>" name="total_attended[]" value="<?php echo $row['attendence_till_date']?>" >
          <label for="form1"></label>
      </div>
       <input type="hidden" name="usn[]" value="<?php echo $row['usn']; ?>">
     </td>
      </tr>
    </tbody>

   <?php $i++; 
		}
	?>

    </table>
    NOTE: PLEASE DO NOT REFRESH THIS PAGE
    <br><br><br>
    <input type = "submit" name="submit" value="Submit This Class Attendence" class="btngr"  onclick="return alerrt()" />
    <input style="float:right; margin-right:12px;" type = "submit" name="submit1" value="Update Total Attended Only!" class="btn"  onclick="return alerrt()" />  
  </form>

</div>
<?php
   if(isset($_POST['submit']))  
   {
      $val2=0;
      $val4=0;
      $val1=1;
      foreach( $_POST["present"] as $chk1 )                  
       {
        $val1=0;
        $qu1 = mysqli_query($conn, "select usn, course_code from attendence where usn='".$chk1."' and course_code='".$courseid."'");
        if (mysqli_fetch_assoc($qu1) == 0) {
          $res = mysqli_query($conn,"insert into attendence values ('".$courseid."', '".$chk1."', '1')");
          if($res){
            echo "<script> alert('Success') </script>"; 
			echo "<script>location.href = 'faculty1.php';</script>";
		}
		}
        else{
          $val1=mysqli_query($conn,"update attendence set attendence_till_date = attendence_till_date+1 where course_code='".$courseid."' and  usn='".$chk1."'");     
        }
       }

      mysqli_query($conn,"update attendence set cont_absence_alrt = 0");
      $val3=1;
      foreach( $_POST["caa"] as $chk2 )
      {
          $val3=0;
          $val3=mysqli_query($conn,"update attendence set cont_absence_alrt = 1 where course_code='".$courseid."' and  usn='".$chk2."'");

      }
       $val2=mysqli_query($conn,"update lec_course set total_cls_taken = total_cls_taken+1 where course_code='".$courseid."' and  l_id='".$l_id."'");


       $Date = date('y/m/d');
       $val4=mysqli_query($conn,"update lec_course set last_taken ='".$Date."'  where course_code='".$courseid."' and  l_id='".$l_id."'");
        if($val2!=0 && ($val1!=0 || $val1=1) && ($val3!=0 || $val3=1) && $val4!=0){
          echo "<script> alert('Success') </script>";
			    echo "<script>location.href = 'faculty1.php';</script>";
		    }
        else{
        echo "<script> alert('Fail') </script>";
        echo "<script>location.href = 'faculty1.php';</script>";
      }
        $val2 = $val1 = 0;
        unset($_POST['submit']); 

  } 

    if(isset($_POST['submit1'])){
      $val3=0;
     //if (isset($_POST['total_attended']) and isset($_POST['usn'])) {
      //foreach (array_combine($_POST['total_attended'], $_POST['usn']) as $ta => $usno){
      for($j=0;$j<$i;$j++){
        //if($ta <= $taken){
        if (isset($_POST["total_attended"][$j]) and isset($_POST["usn"][$j])){
          $ta=$_POST["total_attended"][$j];
          $usno=$_POST["usn"][$j];
         $val3=mysqli_query($conn," update attendence set attendence_till_date='".$ta."' where course_code='".$courseid."' and usn='".$usno."' ");
        }
        }
      
     
     if($val3 != 0){
          echo "<script> alert('Success') </script>";
			echo "<script>location.href = 'faculty1.php';</script>";
	 }
		else
          echo "<script> alert('Cant update!! check the marks range that u enterd...') </script>";
    }

  ?>

<script>

var myIndex = 0;
carousel();
function carousel() {
  var i;
  var x = document.getElementsByClassName("mySlides");
  for (i = 0; i < x.length; i++) {
    x[i].style.display = "none";
  }
  myIndex++;
  if (myIndex > x.length) {myIndex = 1}
  x[myIndex-1].style.display = "block";
  setTimeout(carousel, 2000); // Change image every 2 seconds
}
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

function alerrt() {
  var hours = "<?php echo $hours; ?>"
  var yes = confirm("Do you want to update?");
  if (yes){
    return true;
  }
  else
    return false;
}
function un_check_all() {

  var checkboxes = document.getElementsByName('chckbox[]');
  checkboxes = [...checkboxes];
  for (var i = 0; i < checkboxes.length; i++) {
    checkboxes[i].checked = false;
  }
}

</script>

</main>

</body>