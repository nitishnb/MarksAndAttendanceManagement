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
  
    <!-- Bootstrap CSS -->
<link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.2.1/css/bootstrap.min.css" integrity="sha384-GJzZqFGwb1QTTN6wy59ffF1BuGJpLSa9DkKMp0DgiMDm4iYMj70gZWKYbI706tWS" crossorigin="anonymous"> 
<link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css">
<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css">
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.1/jquery.min.js"></script>
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/js/bootstrap.min.js"></script>  
<link rel="stylesheet" type="text/css" href="attend.css">

<title>Edit marks</title>

</head>
<body>
<main id="mainn">
<div id="mySidenav" class="sidenav">
  <a href="#">About</a>
  <a href="facprofile.php"> My profile </a>
  <a href="course-info.html">Course info</a></div>


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
    <a href="attend2.php">Attendance</a> 
</div>
<div class="header-right">
    <a href="#" class="att">Marks</a>
</div>
<div class="header-right">
    <a href="faculty1.php">Home</a>
</div>
</div>
<br><br>

<div class="container">
  <h1><center> EDIT STUDENTS' MARKS SHEET </center></h1>
<?php
     $l_id = $_SESSION['username'];
     $q1="SELECT c.course_name FROM course c where c.course_code = '".$courseid."'"; 
     $run2=mysqli_query($conn, $q1);
     $count=0;
     while ($row2 = mysqli_fetch_assoc($run2)) {
       $course = $row2['course_name'];
     }

?>
<div class="container">
<div class = "courseinfo"> 
  <div class="c1"> Course Name: <?php echo $course; ?> </div>
  <div class = "c1"> Course code: <?php echo $courseid; ?> </div>
</div>
<br>
<br>

<p> NOTE: Enter 'AB' or 'ab' for absentee students</p>
<?php 
   $que = mysqli_query($conn, "select lab from course where course_code='".$courseid."'");
   while ($r = mysqli_fetch_assoc($que)) {
     $lab = $r['lab'];
   }
   
   if ($lab == 'NO') {

?>
<form action="" id = "cbtn" method="post">
<table class="table table-hover">
  <thead>
    <tr>
     <th>Student's USN</th>
     <th>Student's Name</th>
     <th>Test 1 (40)</th>
     <th>Test 2 (40)</th>
     <th>Test 3 (40)</th>
      <th>Quiz 1 (20)</th>
      <th>Quiz 2 (20)</th>
      <th>Final CIE</th>
    </tr>
  </thead>
     <?php
    $q2="select s.s_name, s.usn from student s, student_course_info sc, lec_course lc where s.usn=sc.usn and sc.course_code='".$courseid."' and sc.course_code = lc.course_code and lc.l_id = '".$l_id."' and s.sem = lc.sem order by usn";  
     $run=mysqli_query($conn, $q2);
     $i = 0;
     while($row=mysqli_fetch_array($run))
     {
         $usn[$i]=$row['usn'];
         $s_name[$i]=$row['s_name'];
     ?>
     <tbody>
      <tr>
        <td><?php echo $usn[$i]; ?></td>
        <td><?php echo $s_name[$i]; ?></td>
      <?php 
      $q3="select test1 from student_course_info where course_code='".$courseid."' and usn='".$usn[$i]."'"; 
      $run3=mysqli_query($conn, $q3);
      while ($row3 = mysqli_fetch_assoc($run3)) {
       $test1 = $row3['test1']; 
     }
      if ($test1 != '0' && $test1 != '') { ?>        
      <td>
      <div class="md-form">
        <input type="text" id="form1" class="form-control text-center" value="<?php echo $test1; ?>" name="test1[]" >
          <label for="form1"></label>
      </div>
      <input type="hidden" name="usn[]" value="<?php echo $usn[$i]; ?>">
      <?php }
      else if ($test1 == '0') { ?>        
      <td>
      <div class="md-form">
        <input type="text" id="form1" class="form-control text-center" value="ABSENT" name="test1[]" >
          <label for="form1"></label>
      </div>
      <input type="hidden" name="usn[]" value="<?php echo $usn[$i]; ?>">
    </td>
       <?php }
      else {
      ?>
      <td>
      <div class="md-form">
        <input type="text" id="form1" class="form-control text-center" readonly >
          <label for="form1"></label>
      </div>
    </td> <?php } ?>

    <td>  
    <?php 
      $q4="select test2 from student_course_info where course_code='".$courseid."' and usn='".$usn[$i]."'"; 
      $run4=mysqli_query($conn, $q4);
      while ($row4 = mysqli_fetch_assoc($run4)) {
       $test2 = $row4['test2']; 
     }
      if ($test2 != '0' && $test2 != '') { ?>        
      
      <div class="md-form">
        <input type="text" id="form1" class="form-control text-center" value="<?php echo $test2; ?>" name="test2[]" >
          <label for="form1"></label>
      </div>
      <input type="hidden" name="usn1[]" value="<?php echo $usn[$i]; ?>">
    
      <?php }
      else if ($test2 == '0') { ?>        
    
      <div class="md-form">
        <input type="text" id="form1" class="form-control text-center" value="ABSENT" name="test2[]" >
          <label for="form1"></label>
      </div>
      <input type="hidden" name="usn1[]" value="<?php echo $usn[$i]; ?>">
    
       <?php }
      else {
      ?>
      <div class="md-form">
        <input type="text" id="form2" class="form-control text-center" readonly >
          <label for="form2"></label>
      </div>
    </td> <?php } ?>
 
     <td>  
    <?php 
      $q4="select test3 from student_course_info where course_code='".$courseid."' and usn='".$usn[$i]."'"; 
      $run4=mysqli_query($conn, $q4);
      while ($row4 = mysqli_fetch_assoc($run4)) {
       $test3 = $row4['test3']; 
     }
      if ($test3 != '0' && $test3 != '') { ?>        
      <div class="md-form">
        <input type="text" id="form1" class="form-control text-center" value="<?php echo $test3; ?>" name="test3[]" >
          <label for="form1"></label>
      </div>
      <input type="hidden" name="usn4[]" value="<?php echo $usn[$i]; ?>">
    </td>
       <?php }
      else if ($test3 == '0') { ?>              
      <div class="md-form">
        <input type="text" id="form1" class="form-control text-center" value="ABSENT" name="test3[]" >
          <label for="form1"></label>
      </div>
      <input type="hidden" name="usn4[]" value="<?php echo $usn[$i]; ?>">
    </td>
       <?php }
      else {
      ?>
      <div class="md-form">
        <input type="text" id="form2" class="form-control text-center" readonly >
          <label for="form2"></label>
      </div>
    </td> <?php } ?>

    <td>  
    <?php 
      $q5="select quiz1 from student_course_info where course_code='".$courseid."' and usn='".$usn[$i]."'"; 
      $run5=mysqli_query($conn, $q5);
      while ($row5 = mysqli_fetch_assoc($run5)) {
       $quiz1 = $row5['quiz1']; 
     }
      if ($quiz1 != '0' && $quiz1 != '') { ?>        
      <div class="md-form">
        <input type="text" id="form1" class="form-control text-center" value="<?php echo $quiz1; ?>" name="quiz1[]" >
          <label for="form1"></label>
      </div>
      <input type="hidden" name="usn2[]" value="<?php echo $usn[$i]; ?>">
    </td>
       <?php }
      else if ($quiz1 == '0') { ?>        
      <div class="md-form">
        <input type="text" id="form1" class="form-control text-center" value="ABSENT" name="quiz1[]" >
          <label for="form1"></label>
      </div>
      <input type="hidden" name="usn2[]" value="<?php echo $usn[$i]; ?>">
    </td>
       <?php }
      else {
      ?>
      <div class="md-form">
        <input type="text" id="form2" class="form-control text-center" readonly >
          <label for="form2"></label>
      </div>      
    </td> <?php } ?>    

    <td>  
    <?php 
      $q6="select quiz2 from student_course_info where course_code='".$courseid."' and usn='".$usn[$i]."'"; 
      $run6=mysqli_query($conn, $q6);
      while ($row6 = mysqli_fetch_assoc($run6)) {
       $quiz2 = $row6['quiz2']; 
     }
      if ($quiz2 != '0' && $quiz2 != '') { ?>        
      <div class="md-form">
        <input type="text" id="form1" class="form-control text-center" value="<?php echo $quiz2; ?>" name="quiz2[]" >
          <label for="form1"></label>
      </div>
      <input type="hidden" name="usn3[]" value="<?php echo $usn[$i]; ?>">
    </td>
       <?php }
      else if ($quiz2 == '0') { ?>        
      <div class="md-form">
        <input type="text" id="form1" class="form-control text-center" value="ABSENT" name="quiz2[]" >
          <label for="form1"></label>
      </div>
      <input type="hidden" name="usn3[]" value="<?php echo $usn[$i]; ?>">
    </td>
       <?php }
      else {
      ?>
     <div class="md-form">
        <input type="text" id="form2" class="form-control text-center" readonly >
          <label for="form2"></label>
      </div>
      </td> <?php } ?>

    <td>
          <?php 
      $sql = mysqli_query($conn, "select test1, test2, test3, quiz1, quiz2 from student_course_info where usn='".$usn[$i]."' and course_code='".$courseid."'");
      while($row7=mysqli_fetch_assoc($sql))
        {
         $test_1=$row7['test1'];
         $test_2=$row7['test2'];
         $test_3=$row7['test3'];
         $quiz_1=$row7['quiz1'];
         $quiz_2=$row7['quiz2'];     
      }
      if ($test_1 != '' and $test_2 != '' and $test_3 != '' and $quiz_1 != '' and $quiz_2 != '') {
        $MAX = max($test_1, $test_2, $test_3);
        $MIN = min($test_1, $test_2, $test_3);
        if (($test_1 <= $MAX && $test_1 > $MIN) and ($test_1 < $MAX && $test_1 >= $MIN))
          $SMAX = $test_1;
        else if (($test_2 <= $MAX && $test_2 >= $MIN) and ($test_2 < $MAX && $test_2 >= $MIN))
          $SMAX = $test_2;
        else 
          $SMAX = $test_3;
        $cie = round(($MAX/2) + ($SMAX/2) + ($quiz_1/4) + ($quiz_2/4));
        $sqll = 0;
        $sqll = mysqli_query($conn, "update student_course_info set CIE='".$cie."' where usn='".$usn[$i]."' and course_code='".$courseid."'");
         ?>
        <div class="md-form">
        <input type="text" id="form1" class="form-control text-center" value="<?php echo $cie; ?>" readonly >
          <label for="form1"></label>
        </div>
      <?php }
      else { ?>
       <div class="md-form">
        <input type="text" id="form1" class="form-control text-center" value="" readonly >
          <label for="form1"></label>
        </div>
      <?php } ?>      
    </td>
 </tr>
 </tbody>
 <?php $i++;} ?>
  </table>
  <div class="upbtn">
    <button type = "submit" name="update" class="btngr" onclick="return alerrt()">Update</button> 
  </div>

  </form>
</div>


<?php
   $sqll = 0;
   $res = $res1 = $res2 = $res3 = $res4 = 0;
   
   if(isset($_POST['update']))  
    {
      if (isset($_POST['test1'])) {
      for($j = 0; $j < $i; $j++) {
        if (!empty($_POST['test1'][$j]) && isset($_POST['test1'][$j]) && isset($_POST['usn'][$j])) {
          if ($_POST['test1'][$j] == 'AB' or $_POST['test1'][$j] == 'ab') 
            $res = mysqli_query($conn, "update student_course_info set test1='0' where usn='".$_POST['usn'][$j]."' and course_code='".$courseid."'");
          else {
            if ($_POST['test1'][$j] > 40)
              echo "<script> alert('Fail! Cannot enter Test 1 marks as it is greater than 40'); </script>";
            else
              $res = mysqli_query($conn, "update student_course_info set test1='".$_POST['test1'][$j]."' where usn='".$_POST['usn'][$j]."' and course_code='".$courseid."'"); 
          }
        }
      }
    }

    if (isset($_POST['test2']) and isset($_POST['usn1'])) {
      for($j = 0; $j < $i; $j++) {
        if (!empty($_POST['test2'][$j]) && isset($_POST['test2'][$j]) && isset($_POST['usn1'][$j])) {
          if ($_POST['test2'][$j] == 'ab' or $_POST['test2'][$j] == 'AB') 
            $res1 = mysqli_query($conn, "update student_course_info set test2='0' where usn='".$_POST['usn1'][$j]."' and course_code='".$courseid."'");
          else {
            if ($_POST['test2'][$j] > 40)
              echo "<script> alert('Fail! Cannot enter Test 2 marks as it is greater than 40'); </script>";
            else {
              $res1 = mysqli_query($conn, "update student_course_info set test2='".$_POST['test2'][$j]."' where usn='".$_POST['usn1'][$j]."' and course_code='".$courseid."'"); 
            }
          }
        }
      }
    }

    if (isset($_POST['test3'])) {
      for($j = 0; $j < $i; $j++) {
        if (!empty($_POST['test3'][$j]) && isset($_POST['test3'][$j]) && isset($_POST['usn4'][$j])) {
          if ($_POST['test3'][$j] == 'AB' or $_POST['test3'][$j] == 'ab') 
            $res4 = mysqli_query($conn, "update student_course_info set test3='0' where usn='".$_POST['usn4'][$j]."' and course_code='".$courseid."'");
          else {
            if ($_POST['test1'][$j] > 40)
              echo "<script> alert('Fail! Cannot enter Test 3 marks as it is greater than 40'); </script>";
            else
              $res4 = mysqli_query($conn, "update student_course_info set test3='".$_POST['test3'][$j]."' where usn='".$_POST['usn4'][$j]."' and course_code='".$courseid."'"); 
          }
        }
      }
    }

    if(isset($_POST['quiz1'])) {
      for($j = 0; $j < $i; $j++) {
        if (!empty($_POST['quiz1'][$j]) && isset($_POST['quiz1'][$j]) && isset($_POST['usn2'][$j])) {
          if ($_POST['quiz1'][$j] == 'AB' or $_POST['quiz1'][$j] == 'ab') 
            $res2 = mysqli_query($conn, "update student_course_info set quiz1='0' where usn='".$_POST['usn2'][$j]."' and course_code='".$courseid."'");
          else {
            if ($_POST['quiz1'][$j] > 20)
              echo "<script> alert('Fail! Cannot enter Quiz 1 marks as it is greater than 20'); </script>";
            else
              $res2 = mysqli_query($conn, "update student_course_info set quiz1='".$_POST['quiz1'][$j]."' where usn='".$_POST['usn2'][$j]."' and course_code='".$courseid."'"); 
          }
        }
      }
    }

    if(isset($_POST['quiz2']) and isset($_POST['usn3'])) {
      for($j = 0; $j < $i; $j++) {
        if (!empty($_POST['quiz2'][$j]) && isset($_POST['quiz2'][$j]) && isset($_POST['usn3'][$j])) {
          if ($_POST['quiz2'][$j] == 'AB' or $_POST['quiz2'][$j] == 'ab') 
            $res3 = mysqli_query($conn, "update student_course_info set quiz2='0' where usn='".$_POST['usn3'][$j]."' and course_code='".$courseid."'");
          else {
            if ($_POST['quiz2'][$j] > 20)
              echo "<script> alert('Fail! Cannot enter Quiz 2 marks as it is greater than 20'); </script>";
            else
              $res3 = mysqli_query($conn, "update student_course_info set quiz2='".$_POST['quiz2'][$j]."' where usn='".$_POST['usn3'][$j]."' and course_code='".$courseid."'"); 
          }
        }
      }
    }
      
 if ($res || $res1 || $res2 || $res3 || $res4 || $sqll) { 
  echo "<script> alert('Success! Marks has been stored successfully'); </script>";
echo "<script> location.href = 'marks(fac).php'; </script>";
 }
}
}

   else if ($lab == 'YES') {
?>
<form action="" id = "cbtn" method="post">
<table class="table table-hover">
  <thead>
    <tr>
     <th>Student's USN</th>
     <th>Student's Name</th>
     <th>Test 1 (40)</th>
     <th>Test 2 (40)</th>
     <th> Test 3 (40) </th>
      <th>Quiz / AAT (20)</th>
      <th>Lab 1 (25)</th>
      <th>Lab 2 (25)</th>
      <th>Final CIE</th>
    </tr>
  </thead>
   <?php
    $q2="select s.s_name, s.usn from student s, student_course_info sc, lec_course lc where s.usn=sc.usn and sc.course_code='".$courseid."' and sc.course_code = lc.course_code and lc.l_id = '".$l_id."' and s.sem = lc.sem order by usn";  
     $run=mysqli_query($conn, $q2);
     $i = 0;
     $j = 0;
     while($row=mysqli_fetch_array($run))
     {
         $usn[$i]=$row['usn'];
         $s_name[$i]=$row['s_name'];
     ?>
     <tbody>
      <tr>
        <td><?php echo $usn[$i]; ?></td>
        <td><?php echo $s_name[$i]; ?></td>
      <?php 
      $q3="select test1 from student_course_info where course_code='".$courseid."' and usn='".$usn[$i]."'"; 
      $run3=mysqli_query($conn, $q3);
      while ($row3 = mysqli_fetch_assoc($run3)) {
       $test1 = $row3['test1']; 
     }
      if ($test1 != '0' && $test1 != '') { ?>        
      <td>
      <div class="md-form">
        <input type="text" id="form1" class="form-control text-center" value="<?php echo $test1; ?>" name="test1[]" >
          <label for="form1"></label>
      </div>
      <input type="hidden" name="usn[]" value="<?php echo $usn[$i]; ?>">
      <?php }
      else if ($test1 == '0') { ?>        
      <td>
      <div class="md-form">
        <input type="text" id="form1" class="form-control text-center" value="ABSENT" name="test1[]" >
          <label for="form1"></label>
      </div>
      <input type="hidden" name="usn[]" value="<?php echo $usn[$i]; ?>">
    </td>
       <?php }
      else {
      ?>
      <td>
      <div class="md-form">
        <input type="text" id="form1" class="form-control text-center" readonly >
          <label for="form1"></label>
      </div>
    </td> <?php } ?>

    <td>  
    <?php 
      $q4="select test2 from student_course_info where course_code='".$courseid."' and usn='".$usn[$i]."'"; 
      $run4=mysqli_query($conn, $q4);
      while ($row4 = mysqli_fetch_assoc($run4)) {
       $test2 = $row4['test2']; 
     }
      if ($test2 != '0' && $test2 != '') { ?>        
      
      <div class="md-form">
        <input type="text" id="form1" class="form-control text-center" value="<?php echo $test2; ?>" name="test2[]" >
          <label for="form1"></label>
      </div>
      <input type="hidden" name="usn1[]" value="<?php echo $usn[$i]; ?>">
    
      <?php }
      else if ($test2 == '0') { ?>        
    
      <div class="md-form">
        <input type="text" id="form1" class="form-control text-center" value="ABSENT" name="test2[]" >
          <label for="form1"></label>
      </div>
      <input type="hidden" name="usn1[]" value="<?php echo $usn[$i]; ?>">
    
       <?php }
      else {
      ?>
      <div class="md-form">
        <input type="text" id="form2" class="form-control text-center" readonly >
          <label for="form2"></label>
      </div>
    </td> <?php } ?>
 
     <td>  
    <?php 
      $q4="select test3 from student_course_info where course_code='".$courseid."' and usn='".$usn[$i]."'"; 
      $run4=mysqli_query($conn, $q4);
      while ($row4 = mysqli_fetch_assoc($run4)) {
       $test3 = $row4['test3']; 
     }
      if ($test3 != '0' && $test3 != '') { ?>        
      <div class="md-form">
        <input type="text" id="form1" class="form-control text-center" value="<?php echo $test3; ?>" name="test3[]" >
          <label for="form1"></label>
      </div>
      <input type="hidden" name="usn4[]" value="<?php echo $usn[$i]; ?>">
    </td>
       <?php }
      else if ($test3 == '0') { ?>              
      <div class="md-form">
        <input type="text" id="form1" class="form-control text-center" value="ABSENT" name="test3[]" >
          <label for="form1"></label>
      </div>
      <input type="hidden" name="usn4[]" value="<?php echo $usn[$i]; ?>">
    </td>
       <?php }
      else {
      ?>
      <div class="md-form">
        <input type="text" id="form2" class="form-control text-center" readonly >
          <label for="form2"></label>
      </div>
    </td> <?php } ?>

    <td>  
    <?php 
      $q5="select quiz1 from student_course_info where course_code='".$courseid."' and usn='".$usn[$i]."'"; 
      $run5=mysqli_query($conn, $q5);
      while ($row5 = mysqli_fetch_assoc($run5)) {
       $quiz1 = $row5['quiz1']; 
     }
      if ($quiz1 != '0' && $quiz1 != '') { ?>        
      <div class="md-form">
        <input type="text" id="form1" class="form-control text-center" value="<?php echo $quiz1; ?>" name="quiz1[]" >
          <label for="form1"></label>
      </div>
      <input type="hidden" name="usn2[]" value="<?php echo $usn[$i]; ?>">
    </td>
       <?php }
      else if ($quiz1 == '0') { ?>        
      <div class="md-form">
        <input type="text" id="form1" class="form-control text-center" value="ABSENT" name="quiz1[]" >
          <label for="form1"></label>
      </div>
      <input type="hidden" name="usn2[]" value="<?php echo $usn[$i]; ?>">
    </td>
       <?php }
      else {
      ?>
      <div class="md-form">
        <input type="text" id="form2" class="form-control text-center" readonly >
          <label for="form2"></label>
      </div>      
    </td> <?php } ?>    

   <td>  
    <?php 
      $q6="select lab1 from student_course_info where course_code='".$courseid."' and usn='".$usn[$i]."'"; 
      $run6=mysqli_query($conn, $q6);
      while ($row6 = mysqli_fetch_assoc($run6)) {
       $lab1 = $row6['lab1']; 
     }
     if ($lab1 != '0' && $lab1 != '') { ?>        
      <div class="md-form">
        <input type="text" id="form1" class="form-control text-center" value="<?php echo $lab1; ?>" name="lab1[]" >
          <label for="form1"></label>
      </div>
      <input type="hidden" name="usn3[]" value="<?php echo $usn[$i]; ?>">
    </td>
       <?php }
      else if ($lab1 == '0') { ?>        
      <div class="md-form">
        <input type="text" id="form1" class="form-control text-center" value="ABSENT" name="lab1[]" >
          <label for="form1"></label>
      </div>
      <input type="hidden" name="usn3[]" value="<?php echo $usn[$i]; ?>">
    </td>
       <?php }
      else {
      ?>
      <div class="md-form">
        <input type="text" id="form2" class="form-control text-center" readonly >
          <label for="form2"></label>
      </div>      
    </td> <?php } ?>

    <td>  
    <?php 
      $q8="select lab2 from student_course_info where course_code='".$courseid."' and usn='".$usn[$i]."'";
      $run8=mysqli_query($conn, $q8);
      while ($row8 = mysqli_fetch_assoc($run8)) {
       $lab2 = $row8['lab2']; 
     }
     if ($lab2 != '0' && $lab2 != '') { ?>        
      <div class="md-form">
        <input type="text" id="form1" class="form-control text-center" value="<?php echo $lab2; ?>" name="lab2[]" >
          <label for="form1"></label>
      </div>
      <input type="hidden" name="usn5[]" value="<?php echo $usn[$i]; ?>">
    </td>
       <?php }
      else if ($lab2 == '0') { ?>        
      <div class="md-form">
        <input type="text" id="form1" class="form-control text-center" value="ABSENT" name="lab2[]" >
          <label for="form1"></label>
      </div>
      <input type="hidden" name="usn5[]" value="<?php echo $usn[$i]; ?>">
    </td>
       <?php }
      else {
      ?>
      <div class="md-form">
        <input type="text" id="form2" class="form-control text-center" readonly >
          <label for="form2"></label>
      </div>      
    </td> <?php } ?>

    <td>
     <?php 
      $sql = mysqli_query($conn, "select test1, test2, test3, quiz1, lab1, lab2 from student_course_info where usn='".$usn[$i]."' and course_code='".$courseid."'");
      while($row7=mysqli_fetch_assoc($sql))
        {
         $test_1=$row7['test1'];
         $test_2=$row7['test2'];
         $test_3=$row7['test3'];
         $quiz_1=$row7['quiz1'];
         $lab_1=$row7['lab1'];
         $lab_2=$row7['lab2'];
      }
      if ($test_1 != '' and $test_2 != '' and $test_3 != '' and $quiz_1 != '' and $lab2 != '' and $lab_2 != '') {
        $MAX = max($test_1, $test_2, $test_3);
        $MIN = min($test_1, $test_2, $test_3);
        if (($test_1 <= $MAX && $test_1 > $MIN) and ($test_1 < $MAX && $test_1 >= $MIN))
          $SMAX = $test_1;
        else if (($test_2 <= $MAX && $test_2 >= $MIN) and ($test_2 < $MAX && $test_2 >= $MIN))
          $SMAX = $test_2;
        else 
          $SMAX = $test_3;
        $cie = round(($MAX/4) + ($SMAX/4) + ($quiz_1/4) + ($lab_1/2) + ($lab_2/2));
        $sqll = 0;
        $sqll = mysqli_query($conn, "update student_course_info set CIE='".$cie."' where usn='".$usn[$i]."' and course_code='".$courseid."'");
         ?>
        <div class="md-form">
        <input type="text" id="form1" class="form-control text-center" value="<?php echo $cie; ?>" readonly >
          <label for="form1"></label>
        </div>
      <?php }
      else { ?>
       <div class="md-form">
        <input type="text" id="form1" class="form-control text-center" value="" readonly >
          <label for="form1"></label>
        </div>
      <?php } ?>      
    </td>
 </tr>
 </tbody>
 <?php $i++;} ?>
  </table>
  
  <div class="upbtn">
    <button type = "submit" name="update" class="btngr" onclick="return alerrt()">Update</button> 
  </div>

  </form>
</div>

<?php
   $sqll = 0;
   $res = $res1 = $res2 = $res3 = $res4 = $res5 = 0;

   if(isset($_POST['update']))  
    {
      if (isset($_POST['test1'])) {
      for($j = 0; $j < $i; $j++) {
        if (!empty($_POST['test1'][$j]) && isset($_POST['test1'][$j]) && isset($_POST['usn'][$j])) {
          if ($_POST['test1'][$j] == 'AB' or $_POST['test1'][$j] == 'ab') 
            $res = mysqli_query($conn, "update student_course_info set test1='0' where usn='".$_POST['usn'][$j]."' and course_code='".$courseid."'");
          else {
            if ($_POST['test1'][$j] > 40)
              echo "<script> alert('Fail! Cannot enter Test 1 marks as it is greater than 40'); </script>";
            else
              $res = mysqli_query($conn, "update student_course_info set test1='".$_POST['test1'][$j]."' where usn='".$_POST['usn'][$j]."' and course_code='".$courseid."'"); 
          }
        }
      }
    }

    if (isset($_POST['test2']) and isset($_POST['usn1'])) {
      for($j = 0; $j < $i; $j++) {
        if (!empty($_POST['test2'][$j]) && isset($_POST['test2'][$j]) && isset($_POST['usn1'][$j])) {
          if ($_POST['test2'][$j] == 'ab' or $_POST['test2'][$j] == 'AB') 
            $res1 = mysqli_query($conn, "update student_course_info set test2='0' where usn='".$_POST['usn1'][$j]."' and course_code='".$courseid."'");
          else {
            if ($_POST['test2'][$j] > 40)
              echo "<script> alert('Fail! Cannot enter Test 2 marks as it is greater than 40'); </script>";
            else {
              $res1 = mysqli_query($conn, "update student_course_info set test2='".$_POST['test2'][$j]."' where usn='".$_POST['usn1'][$j]."' and course_code='".$courseid."'"); 
            }
          }
        }
      }
    }

    if (isset($_POST['test3'])) {
      for($j = 0; $j < $i; $j++) {
        if (!empty($_POST['test3'][$j]) && isset($_POST['test3'][$j]) && isset($_POST['usn4'][$j])) {
          if ($_POST['test3'][$j] == 'AB' or $_POST['test3'][$j] == 'ab') 
            $res3 = mysqli_query($conn, "update student_course_info set test3='0' where usn='".$_POST['usn4'][$j]."' and course_code='".$courseid."'");
          else {
            if ($_POST['test1'][$j] > 40)
              echo "<script> alert('Fail! Cannot enter Test 3 marks as it is greater than 40'); </script>";
            else
              $res3 = mysqli_query($conn, "update student_course_info set test3='".$_POST['test3'][$j]."' where usn='".$_POST['usn4'][$j]."' and course_code='".$courseid."'"); 
          }
        }
      }
    }

    if(isset($_POST['quiz1'])) {
      for($j = 0; $j < $i; $j++) {
        if (!empty($_POST['quiz1'][$j]) && isset($_POST['quiz1'][$j]) && isset($_POST['usn2'][$j])) {
          if ($_POST['quiz1'][$j] == 'AB' or $_POST['quiz1'][$j] == 'ab') 
            $res2 = mysqli_query($conn, "update student_course_info set quiz1='0' where usn='".$_POST['usn2'][$j]."' and course_code='".$courseid."'");
          else {
            if ($_POST['quiz1'][$j] > 20)
              echo "<script> alert('Fail! Cannot enter Quiz 1 marks as it is greater than 20'); </script>";
            else
              $res2 = mysqli_query($conn, "update student_course_info set quiz1='".$_POST['quiz1'][$j]."' where usn='".$_POST['usn2'][$j]."' and course_code='".$courseid."'"); 
          }
        }
      }
    }

    if(isset($_POST['lab1']) and isset($_POST['usn3'])) {
      for($j = 0; $j < $i; $j++) {
        if (!empty($_POST['lab1'][$j]) && isset($_POST['lab1'][$j]) && isset($_POST['usn3'][$j])) {
          if ($_POST['lab1'][$j] == 'AB' or $_POST['lab1'][$j] == 'ab') 
            $res4 = mysqli_query($conn, "update student_course_info set lab1='0' where usn='".$_POST['usn3'][$j]."' and course_code='".$courseid."'");
          else {
            if ($_POST['lab1'][$j] > 25)
              echo "<script> alert('Fail! Cannot enter Lab 1 marks as it is greater than 25'); </script>";
            else
              $res4 = mysqli_query($conn, "update student_course_info set lab1='".$_POST['lab1'][$j]."' where usn='".$_POST['usn3'][$j]."' and course_code='".$courseid."'"); 
          }
        }
      }
    }

    if(isset($_POST['lab2']) and isset($_POST['usn5'])) {
      for($j = 0; $j < $i; $j++) {
        if (!empty($_POST['lab2'][$j]) && isset($_POST['lab2'][$j]) && isset($_POST['usn5'][$j])) {
          if ($_POST['lab2'][$j] == 'AB' or $_POST['lab2'][$j] == 'ab') 
            $res5 = mysqli_query($conn, "update student_course_info set lab2='0' where usn='".$_POST['usn5'][$j]."' and course_code='".$courseid."'");
          else {
            if ($_POST['lab2'][$j] > 25)
              echo "<script> alert('Fail! Cannot enter Lab 2 marks as it is greater than 25'); </script>";
            else
              $res5 = mysqli_query($conn, "update student_course_info set lab2='".$_POST['lab2'][$j]."' where usn='".$_POST['usn5'][$j]."' and course_code='".$courseid."'"); 
          }
        }
      }
    }

 if ($res || $res1 || $res2 || $res3 || $res4 || $res5 || $sqll) { 
  echo "<script> alert('Success! Marks has been stored successfully'); </script>";
  echo "<script> location.href = 'marks(fac).php'; </script>";
 }
}
}

else {
 ?>
<form action="" id = "cbtn" method="post">
<table class="table table-hover">
  <thead>
    <tr>
     <th>Student's USN</th>
     <th>Student's Name</th>
     <th>CIE (50)</th>
   </tr>
 </thead>
<?php
    $q2="select s.s_name, s.usn from student s, student_course_info sc, lec_course lc where s.usn=sc.usn and sc.course_code='".$courseid."' and sc.course_code = lc.course_code and lc.l_id = '".$l_id."' and s.sem = lc.sem order by usn";  
    $run=mysqli_query($conn, $q2);
     $i = 0;
     while($row=mysqli_fetch_array($run))
     {
         $usn[$i]=$row['usn'];
         $s_name[$i]=$row['s_name'];
     ?>
     <tbody>
      <tr>
        <td><?php echo $usn[$i]; ?></td>
        <td><?php echo $s_name[$i]; ?></td>
      <td>
      <?php 
      $q1="select CIE from student_course_info where course_code='".$courseid."' and usn='".$usn[$i]."'"; 
      $run1=mysqli_query($conn, $q1);
      while ($row1 = mysqli_fetch_assoc($run1)) {
       $cie = $row1['CIE']; 
     }

     if ($cie != '0' && $cie != '') { ?>        
      <div class="md-form">
        <input type="text" id="form1" class="form-control text-center" value="<?php echo $cie; ?>" name="cie[]" >
          <label for="form1"></label>
      </div>
      <input type="hidden" name="usn0[]" value="<?php echo $usn[$i]; ?>">
    </td>
       <?php }
      else if ($cie == '0') { ?>        
      <div class="md-form">
        <input type="text" id="form1" class="form-control text-center" value="ABSENT" name="cie[]" >
          <label for="form1"></label>
      </div>
      <input type="hidden" name="usn0[]" value="<?php echo $usn[$i]; ?>">
    </td>
       <?php }
      else {
      ?>
      <div class="md-form">
        <input type="text" id="form2" class="form-control text-center" readonly >
          <label for="form2"></label>
      </div>      
    </td> <?php } ?>
</td>
 </tr>
 </tbody>
 <?php $i++;} ?>
  </table>

  <div class="upbtn">
    <button type = "submit" name="update" class="btngr" onclick="return alerrt()">Update</button> 
  </div>
  </form>
</div>
</div>

<?php
   $res = 0;

   if(isset($_POST['update']))  
    {
      if (isset($_POST['cie']) and isset($_POST['usn0'])) {
      for($j = 0; $j < $i; $j++) {
        if (!empty($_POST['cie'][$j]) && isset($_POST['cie'][$j]) && isset($_POST['usn0'][$j])) {
          if ($_POST['cie'][$j] == 'AB' or $_POST['cie'][$j] == 'ab') 
            $res = mysqli_query($conn, "update student_course_info set cie='0' where usn='".$_POST['usn0'][$j]."' and course_code='".$courseid."'");
          else {
            if ($_POST['cie'][$j] > 50)
              echo "<script> alert('Fail! Cannot enter CIE marks as it is greater than 50'); </script>";
            else
              $res = mysqli_query($conn, "update student_course_info set cie='".$_POST['cie'][$j]."' where usn='".$_POST['usn0'][$j]."' and course_code='".$courseid."'"); 
          }
        }
      }
    }

  if ($res) { 
  echo "<script> alert('Success! Marks has been stored successfully'); </script>";
  echo "<script> location.href = 'marks(fac).php'; </script>";
 }
}
} 
?>

<form action="marks(fac).php">
  <div style="float:right; margin-right:0px;" class="upbtn">
    <button  class="btn">Go back</button> 
  </div>
</form>


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
  var yes = confirm("Do you want to update?");
  if (yes){
    return true;
  }
  else
    return false;
}

</script>

</main>

</body>