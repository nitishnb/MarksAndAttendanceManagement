<?php
    session_start();
    $msg="";
    if(isset($_POST['reset']))
    {
        $username=$_POST['username'];
        $password=$_POST['password'];
        $cpassword=$_POST['cpassword'];
        $conn=mysqli_connect("localhost","root","", "attendence_management");
        $_SESSION['username'] = $_POST['username'];
        if ($password != $cpassword) {
            $msg = "Password and Confirm Password should match!";
        }
        else 
        {
           $sql="select * from admin where id='".$username."'";
           $res=mysqli_query($conn,$sql);
           if(mysqli_num_rows($res) == 1){
              $sql1="update admin set password = '".$password."' where id='".$username."'";
              $res1=mysqli_query($conn,$sql1);
              if($res1) {
                echo "<script> alert('Successfully updated your password!') </script>";
                header("location: adminforms.php");
                die();
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
  
?>


?>

<!DOCTYPE html>
<!--[if lt IE 7 ]> <html lang="en" class="ie6 ielt8"> <![endif]-->
<!--[if IE 7 ]>    <html lang="en" class="ie7 ielt8"> <![endif]-->
<!--[if IE 8 ]>    <html lang="en" class="ie8"> <![endif]-->
<!--[if (gte IE 9)|!(IE)]><!--> <html lang="en"> <!--<![endif]-->
<head>
<meta charset="utf-8">
<title>attendence management</title>
<link rel="stylesheet" type="text/css" href="adminreset.css" />
</head>
<body>
<div class="container">
    <section id="content">
        <form method="POST">
            <h1>Reset Password</h1>
             <div>
                <input type="text" placeholder="Admin ID" required="" name = "username" id="username" />
            </div>
            <div>
                <input type="password" placeholder="New Password" required="" id="password" name="password" />
            </div>
            <div>
                <input type="password" placeholder="Retype Password" required="" id="password" name="cpassword" />
            </div>
            <div>
                <input type="submit" value="Reset" name="reset" />
                <?php
                echo '<span style="color:#F92727;text-align:center;">'.$msg.'</span>';
                ?>
                <a href="adminlogin.html">Have an account? Log in</a>
            </div>
        </form><!-- form -->
        
    </section><!-- content -->
</div><!-- container -->
</body>
</html>