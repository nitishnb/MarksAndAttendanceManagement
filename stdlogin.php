<?php session_start();
     
 

$host="localhost";
$Username="root";
$password="";
$db="attendence_management";
$msg="";
$cn=mysqli_connect($host,$Username);
mysqli_select_db($cn,$db);

    if(isset($_POST['submit'])){

            $usn=$_POST['usn'];
            $password=$_POST['password']; 
            $_SESSION['usn'] = $_POST['usn'];
           
             $sql="select * from student where usn='".$usn."' AND password='".$password."'";
            //$sql="select * from signuptable where Username='Nikhil A S'AND Password='123'";
             $res=mysqli_query($cn,$sql);

             if(mysqli_num_rows($res)==1){
                echo "You have successfully logged in";
              header("location: student1.php");
                die();
             }

             else{
                $msg= "Wrong Username/Password";
             }
         }
       

?>


<!DOCTYPE html>

<!--[if lt IE 7 ]> <html lang="en" class="ie6 ielt8"> <![endif]-->
<!--[if IE 7 ]>    <html lang="en" class="ie7 ielt8"> <![endif]-->
<!--[if IE 8 ]>    <html lang="en" class="ie8"> <![endif]-->
<!--[if (gte IE 9)|!(IE)]><!--> <html lang="en"> <!--<![endif]-->
<head>
<meta charset="utf-8">
<title>attendence management</title>
<link rel="stylesheet" type="text/css" href="stdstyle.css" />
</head>
<body>
<div class="container">
    <section id="content">
        <form  method="POST">
            <h1>Student Login</h1>
            <div>
                <input type="text" placeholder="Student USN" required="" id="usn" name="usn" />
            </div>
            <div>
                <input type="password" placeholder="Password" required="" id="password" name="password" />
            </div>
            <div>
                <input type="submit" name="submit" value="Log in" />
               <?php
                echo '<span style="color:#F92727;text-align:center;">'.$msg.'</span>';
                ?>
                <a href="stdreset.php ">Lost your password?</a>
            </div>
        </form><!-- form -->
        
    </section><!-- content -->
</div><!-- container -->
</body>
</html>

