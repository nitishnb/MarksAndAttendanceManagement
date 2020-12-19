
<?php
session_start();
     $conn=mysqli_connect("localhost","root","","");
   mysqli_select_db($conn,'attendence_management');
   if (!isset($_SESSION['course_code']))
    header("location: fac.php");
  else
    $courseid = $_SESSION['course_code'];

require_once __DIR__ . '/vendor/autoload.php';

    $css=/**@lang CSS */"
    body {
    	font-size: 16px;
    }
    table {
        width:100%;
        border:solid 2px grey;
    }
    th, td {
        text-align:center;
        padding:5px;
        border:solid 1px grey;
    } 
    th {
       background-color:#d1dce1;
       font-size: 15px;
    }
    td {
    	font-size: 14px;
    }
    h1 {
        background-color:#e2e2e2;
        text-align: center;
    }
    ";
$d .= "<h1> <center> STUDENTS' MARKS SHEET </center></h1>";

$d .='<strong>Course: </strong> '. $courseid.'<br>';


     $l_id = $_SESSION['username'];
     $q1="SELECT c.course_name FROM course c where c.course_code = '".$courseid."'"; 
     $run2=mysqli_query($conn, $q1);
     $count=0;
     while ($row2 = mysqli_fetch_assoc($run2)) {
       $course = $row2['course_name'];
     }
$d .= '<strong>Course Name: </strong> '. $course.'<br>';

   $que = mysqli_query($conn, "select sem from lec_course where course_code='".$courseid."' and l_id='".$l_id."'");
   while ($r = mysqli_fetch_assoc($que)) {
     $sem = $r['sem'];
   }
$d .= '<strong>Semester and Section: </strong> '. $sem.'<br>';

  $qu = "SELECT SUBSTRING(l_id, 1, 2) AS extract FROM lecturer WHERE l_id = '".$l_id."'";
  $run=mysqli_query($conn, $qu);
  while($row=mysqli_fetch_array($run))
  {
    $dept = $row['extract'];
  }
  switch ($dept) {
    case 'AE': $dept = 'AEROSPACE ENGINEERING';
               break;
    case 'BT': $dept = 'BIO-TECNOLOGY';
               break;
    case 'CH': $dept = 'CHEMICAL ENGINEERING';
               break;
    case 'CS': $dept = 'COMPUTER SCIENCE AND ENGINEERING';
               break;
    case 'CV': $dept = 'CIVIL ENGINEERING';
               break;
    case 'EC': $dept = 'ELECTRONICS AND COMMUNICATION ENGINEERING';
               break;
    case 'EE': $dept = 'ELECTRICAL AND ELECTRONICS ENGINEERING';
               break;
    case 'EI': $dept = 'ELECTRONICS AND INSTRUMENTATION ENGINEERING';
               break;              
    case 'IE': $dept = 'INSTRUMENTATION ENGINEERING AND MANAGEMENT';
               break;
    case 'IS': $dept = 'INFORMATION SCIENCE AND ENGINEERING';
               break;
    case 'ME': $dept = 'MECHANICAL ENGINEERING';
               break;
    case 'ML': $dept = 'MEDICAL ELECTRONICS';
               break;
    case 'TC': $dept = 'ELECTRONICS AND TELECOMMUNICATION ENGINEERING';
               break;
    default: $dept = '';
             break;
  }
$d .= '<strong>Department: </strong> '. $dept.'<br>';

   $que = mysqli_query($conn, "select l_name from lecturer where l_id='".$l_id."'");
   while ($r = mysqli_fetch_assoc($que)) {
     $l_name = $r['l_name'];
   }
$d .= '<strong>Faculty handled: </strong> '. $l_name.'<br><br>';

   $que = mysqli_query($conn, "select lab from course where course_code='".$courseid."'");
   while ($r = mysqli_fetch_assoc($que)) {
     $lab = $r['lab'];
   }
  
   if ($lab == 'NO') {

    $table="<table>";
    $table.="<thead>";
    $table.="<tr><th>USN</th><th>Name</th><th>Test 1</th><th>Test 2</th><th>Test 3</th><th>Quiz 1</th><th>Quiz 2</th><th>CIE</th></tr>";
    $table.="</thead>";
    $q2="select s.s_name, s.usn, sc.test1, sc.test2, sc.test3, sc.quiz1, sc.quiz2, sc.cie from student s, student_course_info sc, lec_course lc where s.usn=sc.usn and sc.course_code='".$courseid."' and sc.course_code = lc.course_code and lc.l_id = '".$l_id."' and s.sem = lc.sem order by usn";  
     $run=mysqli_query($conn, $q2);
     $i = 0;
     $j = 0;
     while($row=mysqli_fetch_array($run))
     {
         $usn[$i]=$row['usn'];
         $s_name[$i]=$row['s_name'];
         $test1[$i] = $row['test1'];
         $test2[$i] = $row['test2'];
         $test3[$i] = $row['test3'];
         $quiz1[$i] = $row['quiz1'];
         $quiz2[$i] = $row['quiz2'];
         $cie[$i] = $row['cie'];
         $table .= "<tbody>";
         $table.="</tbody>";
         $table.="<tr><td>".$usn[$i]."</td><td>".$s_name[$i]."</td><td>".$test1[$i]."</td><td>".$test2[$i]."</td><td>".$test3[$i]."</td><td>".$quiz1[$i]."</td><td>".$quiz2[$i]."</td><td>".$cie[$i]."</td></tr>";
    }
    $table.="</table>";
    $head="<head><style>$css</style></head>";
    $body="<body>$d$table</body>";
}

else if ($lab == 'YES') {

    $table="<table>";
    $table.="<thead>";
    $table.="<tr><th>USN</th><th>Name</th><th>Test 1</th><th>Test 2</th><th>Test 3</th><th>Quiz 1</th><th>Lab 1</th><th>Lab 2</th><th>CIE</th></tr>";
    $table.="</thead>";
    $q2="select s.s_name, s.usn, sc.test1, sc.test2, sc.test3, sc.quiz1, sc.lab1, sc.lab2, sc.cie from student s, student_course_info sc, lec_course lc where s.usn=sc.usn and sc.course_code='".$courseid."' and sc.course_code = lc.course_code and lc.l_id = '".$l_id."' and s.sem = lc.sem order by usn";  
     $run=mysqli_query($conn, $q2);
     $i = 0;
     $j = 0;
     while($row=mysqli_fetch_array($run))
     {
         $usn[$i]=$row['usn'];
         $s_name[$i]=$row['s_name'];
         $test1[$i] = $row['test1'];
         $test2[$i] = $row['test2'];
         $test3[$i] = $row['test3'];
         $quiz1[$i] = $row['quiz1'];
         $lab1[$i] = $row['lab1'];
         $lab2[$i] = $row['lab2'];
         $cie[$i] = $row['cie'];
         $table .= "<tbody>";
         $table.="</tbody>";
         $table.="<tr><td>".$usn[$i]."</td><td>".$s_name[$i]."</td><td>".$test1[$i]."</td><td>".$test2[$i]."</td><td>".$test3[$i]."</td><td>".$quiz1[$i]."</td><td>".$lab1[$i]."</td><td>".$lab2[$i]."</td><td>".$cie[$i]."</td></tr>";
    }
    $table.="</table>";
    $head="<head><style>$css</style></head>";
    $body="<body>$d$table</body>";
}

else {
   $table="<table>";
    $table.="<thead>";
    $table.="<tr><th>USN</th><th>Name</th><th>CIE</th></tr>";
    $table.="</thead>";
    $q2="select s.s_name, s.usn, sc.cie from student s, student_course_info sc, lec_course lc where s.usn=sc.usn and sc.course_code='".$courseid."' and sc.course_code = lc.course_code and lc.l_id = '".$l_id."' and s.sem = lc.sem order by usn";  
     $run=mysqli_query($conn, $q2);
     $i = 0;
     $j = 0;
     while($row=mysqli_fetch_array($run))
     {
         $usn[$i]=$row['usn'];
         $s_name[$i]=$row['s_name'];
         $cie[$i] = $row['cie'];
         $table .= "<tbody>";
         $table.="</tbody>";
         $table.="<tr><td>".$usn[$i]."</td><td>".$s_name[$i]."</td><td>".$cie[$i]."</td></tr>";
    }
    $table.="</table>";
    $head="<head><style>$css</style></head>";
    $body="<body>$d$table</body>";
}
    
$mpdf = new \Mpdf\Mpdf();
$mpdf->SetHeader('B.M.S. College of Engineering');
$mpdf->WriteHTML("<html>$head$body</html>");
$mpdf->output("Students' Marks sheet.pdf",'D');
?>
