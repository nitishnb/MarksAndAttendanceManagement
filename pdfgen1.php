
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
$d .= "<h1> <center> STUDENTS' ATTENDANCE SHEET </center></h1>";

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

   $que = mysqli_query($conn, "select total_cls_taken from lec_course where course_code='".$courseid."' and l_id='".$l_id."'");
   while ($r = mysqli_fetch_assoc($que)) {
     $total_cls_taken = $r['total_cls_taken'];
   }
  
    $table="<table>";
    $table.="<thead>";
    $table.="<tr><th>USN</th><th>Name</th><th>Total Class Taken</th><th>Total Class Attended</th><th>Percentile(Attendance)</th></tr>";
    $table.="</thead>";
    $q2="select s.s_name, s.usn from student s, student_course_info sc, lec_course lc where s.usn=sc.usn and sc.course_code='".$courseid."' and sc.course_code = lc.course_code and lc.l_id = '".$l_id."' and s.sem = lc.sem order by usn";  
     $run=mysqli_query($conn, $q2);
     $i = 0;
     $j = 0;
     while($row=mysqli_fetch_array($run))
     {
         $usn[$i]=$row['usn'];
         $s_name[$i]=$row['s_name'];
         $que = mysqli_query($conn, "select attendence_till_date from attendence where course_code='".$courseid."' and usn='".$usn[$i]."'");
         while ($r = mysqli_fetch_assoc($que)) {
            $attendence_till_date[$i] = $r['attendence_till_date'];
         }
         $Percentile[$i] = ($attendence_till_date[$i] / $total_cls_taken) * 100;
         $table .= "<tbody>";
         $table.="</tbody>";
         $table.="<tr><td>".$usn[$i]."</td><td>".$s_name[$i]."</td><td>".$total_cls_taken."</td><td>".$attendence_till_date[$i]."</td><td>".round($Percentile[$i])."%</td></tr>";
    }
    $table.="</table>";
    $head="<head><style>$css</style></head>";
    $body="<body>$d$table</body>";
    
$mpdf = new \Mpdf\Mpdf();
$mpdf->SetHeader('B.M.S. College of Engineering');
$mpdf->WriteHTML("<html>$head$body</html>");
$mpdf->output("Students' Attendance sheet.pdf",'D');
?>
