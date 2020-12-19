<?php
	session_start();
	$msg="";
	if(isset($_POST['submit']))
	{
		$username=$_POST['username'];
		$password=$_POST['password'];
		$conn=mysqli_connect("localhost","root","", "attendence_management");
		$_SESSION['username'] = $_POST['username'];
  		
             $sql="select * from admin where admin_id='".$username."' AND password='".$password."'";
             $res=mysqli_query($conn,$sql);

             if(mysqli_num_rows($res) >= 1){
                echo "You have successfully logged in";
				header("location: adminforms.php");
                die();
             }
             else{
                $msg= "Wrong ID/Password";
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
<link rel="stylesheet" type="text/css" href="adminstyle.css" />
</head>
<body>
    <!-- <img src="admin.jpg" class="bg"> -->
<div class="container">

    <section id="content">
        <form method="post" >
            <h1>Admin Login</h1>
            <div>
                <input type="text" placeholder="Admin ID" required="" name="username" />
            </div>
            <div>
                <input type="password" placeholder="Password" required="" name="password" />
            </div>
            <div>
                <input name="submit" type="submit" value="Log in" />
				<?php
				echo '<span style="color:#F92727;text-align:center;">'.$msg.'</span>';
				?>
                <a href="adminreset.php">Lost your password?</a>
            </div>
        </form><!-- form -->
        
    </section><!-- content -->
</div><!-- container -->
</body>
</html>