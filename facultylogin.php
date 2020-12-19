<?php
session_start();
	$host="localhost";
$Username="root";
$password="";
$db="attendence_management";
$msg="";
$cn=mysqli_connect($host,$Username);
mysqli_select_db($cn,$db);

    if(isset($_POST['submit'])){

            $username=$_POST['username'];
            $password=$_POST['password']; 
            $_SESSION['username'] = $_POST['username'];
           
             $sql="select * from lecturer where l_id='".$username."' AND password='".$password."'";
            //$sql="select * from signuptable where Username='Nikhil A S'AND Password='123'";
             $res=mysqli_query($cn,$sql);

             if(mysqli_num_rows($res)==1){
                echo "You have successfully logged in";

              header("location: fac.php");
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
<link rel="stylesheet" type="text/css" href="facultystyle.css" />
</head>
<body>
<div class="container">
    <section id="content">
        <form method="post" >
            <h1>Faculty Login</h1>
            <div>
                <input type="text" placeholder="Lecturer id" required="" name="username" />
            </div>
            <div>
                <input type="password" placeholder="Password" required="" name="password" />
            </div>
            <div>
                <input name="submit" type="submit" value="Log in" />
				<?php
				echo '<span style="color:#F92727;text-align:center;">'.$msg.'</span>';
				?>
                <a href="facultyreset.php">Lost your password?</a>
            </div>
        </form><!-- form -->
        
    </section><!-- content -->
</div><!-- container -->
</body>
</html>