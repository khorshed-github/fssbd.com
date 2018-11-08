<?php 
	include 'lib/Session.php';
	Session::init();
	include 'lib/Database.php';
	include 'helpers/Format.php';

	spl_autoload_register(function($class){
		include_once "classes/".$class.".php";	
	});

	$cmr = new Customer();
?>


<?php

	$db = new Database();
	$fm = new Format();

?>
<?php
	header("Cache-Control: no-cache, must-revalidate");
	header("Pragma: no-cache");
	header("Expires: Sat, 26 Jul 1997 05:00:00 GMT"); 
	header("Cache-Control: max-age=2592000"); 
?>

<!DOCTYPE html>
<html lang="en">
	
	<head>
	  <title>Best Pay BD</title>
	  <meta charset="utf-8">
	  <meta name="viewport" content="width=device-width, initial-scale=1">
	  <link rel="stylesheet" href="assets/bootstrap3.3.7/css/bootstrap.min.css">
	  <link rel="stylesheet" href="assets/bootstrap3.3.7/css/style.css">
	  <link href="assets/font-awesome-4.7.0/css/font-awesome.css" rel="stylesheet">
	  <script src="assets/bootstrap3.3.7/js/jquery-3.3.1.min.js"></script>
	  <script src="assets/bootstrap3.3.7/js/bootstrap.min.js"></script>
	  <script src="assets/bootstrap3.3.7/js/common.js"></script>
	  <!--<script type="text/javascript" src="assets/bootstrap3.3.7/js/Waypoints-4.0.0.js"></script>
	  <script type="text/javascript" src="assets/bootstrap3.3.7/js/jquery.counterup-1.0.js"></script>-->
	  
	<script>
		/*page Loader Start*/

		window.addEventListener("load", function(){
			var load_screen = document.getElementById("load_screen");
			document.body.removeChild(load_screen);
		});

	/*page Loader End*/
	</script>
	  
	</head>
	<body id="myPage" data-spy="scroll" data-target=".navbar" data-offset="60">
	<!--page Loader Start-->
		<div id="load_screen"><div id="loading"><img src="assets/images/loader-spinner.svg" alt=""></div></div>
	<!--page Loader End-->
	
	<!-- navbar -->
	<nav class="navbar navbar-inverse" id="navFix">
      <div class="container-fluid">
        <div class="navbar-header">
          <button type="button" class="navbar-toggle" data-toggle="collapse" data-target="#myNavbar">
            <span class="icon-bar"></span>
            <span class="icon-bar"></span>
            <span class="icon-bar"></span>                        
          </button>
          <a class="navbar-brand" href="index.php">
          	<img class="img-responsive" src="assets/images/logo.png" style="width:30%;" alt="Logo" >
          </a>
        </div>
        <div class="collapse navbar-collapse" id="myNavbar">
          <ul class="nav navbar-nav">
            <!--<li class="dropdown">
                <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false">Category <span class="caret"></span></a>
                <ul class="dropdown-menu">
                  <li><a href="#">Category-1</a></li>
                  <li><a href="#">Category-2</a></li>
                  <li><a href="#">Category-3</a></li>
                </ul>
            </li>-->
            <li><a href="index.php">Exchange</a></li>
			<li><a href="testimonials.php">Testimonials</a></li>
            <li><a href="blog.php">Blog</a></li>
			<!--<li><a href="#affiliate">Affiliate</a></li> -->
            <li><a href="about.php">About</a></li>
              <li><a href="contact.php">Contact</a></li>
          </ul>
          <!--SearchOption-->
          <!--<div class="col-sm-3 col-md-3">
            <form class="navbar-form" role="search">
                <div class="input-group">
                    <input type="text" class="form-control" placeholder="Search" name="name" required="required">
                    <div class="input-group-btn">
                        <button class="btn btn-default" type="submit"><i class="glyphicon glyphicon-search"></i></button>
                    </div>
                </div>
            </form>
          </div>-->
          <ul class="nav navbar-nav navbar-right">
          	<?php
				if(isset($_GET['cid']))
				{
					Session::destroy();
					header("Location:login.php");
				}
			?>
           	<?php
				$login = Session::get("cusLogin");
				if($login==true) 
				{?>
				   <li><a href="profile.php">Profile</a></li>
		  	<?php
				}?>
            
            <?php
				$login = Session::get("cusLogin");
				if($login==false)
				{?>
                    <li><a href="login.php"><span class="glyphicon glyphicon-log-in"></span> Login</a></li>
				<?php } else { ?>
                    <li><a href="?cid=<?php Session::get('cmrId')?>"><span class="glyphicon glyphicon-log-out"></span> Logout</a></li>
				<?php } ?>
            <!--<li><a href="login.php"><span class="glyphicon glyphicon-log-in"></span> Login</a></li>-->
          </ul>
        </div>
      </div>
    </nav>