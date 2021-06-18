<?php

	require('adminadditionals/connection.php');
	require('adminadditionals/functions.php');
	$msg="";
	if(isset($_POST['submit'])){
		$username=get_safe_value($conn,$_POST['username']);
		$email=get_safe_value($conn,$_POST['email']);
		$password=get_safe_value($conn,$_POST['pass']);
		$sql="select * from admin where username='$username' and email='$email' and password='$password'";
		$res=mysqli_query($conn,$sql);
		$count=mysqli_num_rows($res);
		if($count>0){
			$_SESSION['ADMIN_LOGIN']='yes';
			$_SESSION['ADMIN_USERNAME']=$username;
			header('location: adminhome.php');
		}
		else{
			$msg="please enter correct details";
		}
	}
?>

<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<meta http-equiv="X-UA-Compatible" content="IE=edge">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<title>On My Mart</title>
	<link rel="stylesheet" href="rule2.css" type="text/CSS">
</head>
<body>

<div class="logo" style="text-align:center;">
	<!--<pre style="text-align:center;">-->On My<br>Mart<!--</pre>-->
</div>

	<div class="form-container">
		<form method="post" action="" id="form">
			<h3>Admin Login</h3>
			<hr>  </hr>
			
			<div class="container">
				<input type="text"name="username" placeholder="enter your username" required/>
			</div>
			
			<div class="container">
				<input type="email" name="email" placeholder="enter your email"required/>
			</div>

			<div class="container">
				<input type="password" name="pass" placeholder="enter your password" required/>
			</div>

			<input type="submit" name="submit" value="login">
			<br>
			<div class="errormsg">
				<?php 
					echo $msg;
				?>
			</div>
		</form>
	</div>
</body>
<html>