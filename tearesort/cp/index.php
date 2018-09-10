<?php
include("config/dbconnect.php");
if(isset($_POST['signIn'])){
	$email = trim($_POST['email']);
	$pass = trim(md5($_POST['password']));
	
	$login_query = mysqli_query($con,"SELECT id,name,user_pic,email,password FROM user where email='$email' and password='$pass' and status=1 limit 1");
	$login_query_num=mysqli_num_rows($login_query);
	if($login_query_num!=0){
		$login_query_row=mysqli_fetch_assoc($login_query);
		$loginId=$login_query_row['id'];		
		$_SESSION['user_id']=$loginId;
		header("Location: home.php");
		exit;		
	}else{
		header("Location: index.php");
	}
}
?>
<!DOCTYPE HTML>
<html lang="en-US">
<head>
<title>Admin Login || Tea Resort & Museum</title>
	<?php require("components/head.php");?>
</head>
<body style="background: url(images/tearesort-get.jpg) no-repeat 0px 0px; background-size:cover;">
<div class="log-w3">
<div class="w3layouts-main">
	<h2><strong>Sign In Now</strong></h2>
		<form method="post">
			<input type="text" class="ggg" name="email" placeholder="E-MAIL" required="">
			<input type="password" class="ggg" name="password" placeholder="PASSWORD" required="">
			<span><input type="checkbox" />Remember Me</span>
			<h6><a href=".">Forgot Password?</a></h6>
				<div class="clearfix"></div>
				<input type="submit" value="Sign In" name="signIn">
		</form>
		<!--<p>Don't Have an Account ?<a href="registration.html">Create an account</a></p>-->
		<p><a href="http://www.tearesort.gov.bd" target="_blank">Tea Resort & Museum || </a>Tea Board Resort & Bungalow in Sylhet</p>
</div>
</div>
<script src="js/bootstrap.js"></script>
</body>
</html>