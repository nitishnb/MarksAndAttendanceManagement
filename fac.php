<?php
session_start();
	$host="localhost";
$Username="root";
$password="";
$db="attendence_management";
$msg="";
$cn=mysqli_connect($host,$Username);
mysqli_select_db($cn,$db);
           $username=$_SESSION['username'];
           $q1 = mysqli_query($cn, "SELECT lc.course_code, c.course_name from course c, lec_course lc where c.course_code=lc.course_code and lc.l_id='".$username."'");
           $num = mysqli_num_rows($q1);
           if ($num == 1) {
            while ($row = mysqli_fetch_assoc($q1)) {
               $course_id = $row['course_code'];
           }
            $_SESSION['course_code'] = $course_id;
            header("location: faculty1.php");
            die();
           }
    else if(isset($_POST['submit'])){
            $_SESSION['course_code']=$_POST['cs'];
            header("location: faculty1.php");
            die();
         }
?>

<!DOCTYPE html>
<!--[if lt IE 7 ]> <html lang="en" class="ie6 ielt8"> <![endif]-->
<!--[if IE 7 ]>    <html lang="en" class="ie7 ielt8"> <![endif]-->
<!--[if IE 8 ]>    <html lang="en" class="ie8"> <![endif]-->
<!--[if (gte IE 9)|!(IE)]><!--> <html lang="en"> <!--<![endif]-->
<head>
    <style>
        .form-control {
  display: block;
  width: 100%;
  height: calc(1.5em + 0.75rem + 2px);
  padding: 0.375rem 0.75rem;
  font-size: 1rem;
  font-weight: 400;
  line-height: 1.5;
  color: #495057;
  background-color: #fff;
  background-clip: padding-box;
  border: 1px solid #ced4da;
  border-radius: 0.25rem;
  transition: border-color 0.15s ease-in-out, box-shadow 0.15s ease-in-out;
}

@media (prefers-reduced-motion: reduce) {
  .form-control {
    transition: none;
  }
}

.form-control::-ms-expand {
  background-color: transparent;
  border: 0;
}

.form-control:-moz-focusring {
  color: transparent;
  text-shadow: 0 0 0 #495057;
}

.form-control:focus {
  color: #495057;
  background-color: #fff;
  border-color: #80bdff;
  outline: 0;
  box-shadow: 0 0 0 0.2rem rgba(0, 123, 255, 0.25);
}

.form-control::-webkit-input-placeholder {
  color: #6c757d;
  opacity: 1;
}

.form-control::-moz-placeholder {
  color: #6c757d;
  opacity: 1;
}

.form-control:-ms-input-placeholder {
  color: #6c757d;
  opacity: 1;
}

.form-control::-ms-input-placeholder {
  color: #6c757d;
  opacity: 1;
}

.form-control::placeholder {
  color: #6c757d;
  opacity: 1;
}

.form-control:disabled, .form-control[readonly] {
  background-color: #e9ecef;
  opacity: 1;
}

select.form-control:focus::-ms-value {
  color: #495057;
  background-color: #fff;
}

.form-group {
  margin-bottom: 1rem;
  display: -ms-flexbox;
  display: flex;
  -ms-flex: 0 0 auto;
  flex: 0 0 auto;
  -ms-flex-flow: row wrap;
  flex-flow: row wrap;
  -ms-flex-align: center;
  align-items: center;
  margin-bottom: 0;
}

    </style>
<meta charset="utf-8">
<title>attendence management</title>
<link rel="stylesheet" type="text/css" href="facultystyle.css" />
</head>
<body>
<div class="container">
    <section id="content">
        <form method="post" >
            <h1>Course selection</h1>
            <div>
                Please select your course <br> <br>
                  <div class="form-group">
               
                <select class="form-control" id="sel1" name="cs">
                    <option></option>
                <?php
                 $q1 = mysqli_query($cn, "SELECT lc.course_code, c.course_name from course c, lec_course lc where c.course_code=lc.course_code and lc.l_id='".$username."'");
                 while ($row = mysqli_fetch_assoc($q1)) {
                    $course_id = $row['course_code'];
                    $course_name = $row['course_name'];
                ?>

               <div>
                  <option value='<?php echo $course_id; ?>'>  <?php echo $course_name; ?> </option> 
            <?php } ?>
                    </select>
            </div>

            <div>
                <input name="submit" type="submit" value="Continue" />

            </div>
        </form><!-- form -->
        
    </section><!-- content -->
</div><!-- container -->
</body>
</html>