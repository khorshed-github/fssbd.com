<?php
include("config/dbconnect.php");
include("login_check.php");
if(isset($_POST['booking'])){	
	$indate = trim(date('Y-m-d',strtotime($_POST['check_in'])));		
	$outdate = trim(date('Y-m-d',strtotime($_POST['check_out'])));
	
	$adult = trim($_POST['adult']);
	$child = trim($_POST['child']);
	$black_reson = trim($_POST['black_reson']);
	//$roomType = trim($_POST['roomType']);
	$ip = $_SERVER['REMOTE_ADDR'];
	$q = "SELECT * FROM `bookings` WHERE `start_date` <= '$indate' AND `end_date` >= '$outdate'";
	$result=mysqli_query($con,$q);
	if (!$result)
		echo(mysqli_error($con));
	if(mysqli_num_rows($result)>0)
		{
			$msg = "<strong>Sorry Searching Room Already Booking.</strong> Please Block Another Date Schedule.";
		}else{			
			/* echo "INSERT INTO `bookings`(`start_date`, `end_date`, `adult_count`, `child_count`, `is_block`, `block_name`, `ip`, `datetime`)VALUES('$indate','$outdate','$adult','$child',1,'$black_reson','$ip',CURRENT_TIMESTAMP)";
			exit; */
			
			$sqlBook = mysqli_query($con,"INSERT INTO `bookings`(`start_date`, `end_date`, `adult_count`, `child_count`, `is_block`, `block_name`, `ip`, `datetime`)VALUES('$indate','$outdate','$adult','$child',1,'$black_reson','$ip',CURRENT_TIMESTAMP)");
			
if($sqlBook){
	$msg = "Room Block Successfull.";
	}else{
	$msg = "Room Block Error!!";
	} 
	}
}
?>
<!DOCTYPE html>
<head>
<title>Room Block List || Tea Resort & Museum</title>
	<?php require("components/head.php");?>
	<style type="text/css">
		.logo{margin-top:0px !important; margin-left:0 !important; width:100%;}
	</style>
</head>
<body>
<section id="container">
<!--header start-->
<header class="header fixed-top clearfix">
<!--logo start-->
<div class="brand">
    <a href="home.php" class="logo">
        <img src="images/tea-resort-logo.jpg" class="img-responsive" alt="Tea Resort & Museum Logo">
    </a>
    <div class="sidebar-toggle-box">
        <div class="fa fa-bars"></div>
    </div>
</div>
<!--logo end-->
<div class="top-nav clearfix">
    <!--search & user info start-->
     <?php require("components/header.php");?>
    <!--search & user info end-->
</div>
</header>
<!--header end-->
<!--sidebar start-->
<aside>
    <div id="sidebar" class="nav-collapse">
        <!-- sidebar menu start-->
        <?php require("components/menu.php");?>
        <!-- sidebar menu end-->
    </div>
</aside>
<!--sidebar end-->

<!--main content start-->
<section id="main-content">
	<section class="wrapper">
		<div class="table-agile-info">
  <div class="panel panel-default">
    <div class="panel-heading">
      <strong><span class=" pull-left">Room Block</span></strong>
      <strong><a class=" pull-right btn btn-primary" href="show_room_block_list.php">Show Room Block</a></strong>
    </div>

	<?php							
		if($msg){?>
		 <div class="alert alert-success" role="alert">
				<button type="button" class="close" data-dismiss="alert" aria-label="close">
					<span aria-hidden="true">&times;</span>
				</button>
				<span><strong><?php echo $msg; ?></strong></span>
		  </div>
		<?php } ?>
		
<div class="box-booking booking-inline">
	<form name="formElem" action="" method="post">
		<div class="form-group">
			<label class="label-control"><strong>Arrival Date</strong></label>
			<div class="booking-form select-black">								
				<label class="check_in">				
					<input type="date" name="check_in" required />			
				</label>
			</div>
		</div>
		<div class="form-group">
			<label class="label-control"><strong>Departure Date</strong></label>
			<div class="booking-form select-black">			
				<label class="check_out">
					<input type="date" name="check_out" required />
				</label>
			</div>
		</div>
		<div class="form-group select">
			<label class="label-control"><strong>Adults</strong></label>
			<div class="input-group select-black">
				<label class="adult">
					<select class="input-md form-control w-md inline v-middle" name="adult" required>			  <option value="1">1</option>
						<option value="2">2</option>
						<option value="3">3</option>
						<option value="4">4</option>
						<option value="5">5</option>
						<option value="6">6</option>						
					</select>
				</label>
			</div>
		</div>
		<div class="form-group select">
			<label class="label-control"><strong>Children</strong></label>
			<div class="input-group select-black">
				<label class="child">
					<select class="input-md form-control w-md inline v-middle" name="child" required >
						<option value="0">0</option>
						<option value="1">1</option>
						<option value="2" selected>2</option>
					</select>
				</label>
			</div>
		</div>		
		<div class="form-group">			
			<label class="label-control"><strong>Room Type</strong></label>
			<div class="input-group select-black">
				<label class="roomType">
					<select class="input-md form-control w-md inline v-middle" name="roomType" required>					
							<option value="1">2 Rooms Bungalow</option>
							<option value="2">3 Rooms Bungalow</option>
					</select>
				</label>
			</div>
		</div>
		<div class="form-group">
			<label class="label-control"><strong>Block Reason</strong></label>
			<div class="booking-form select-black">			
				<label class="black_reson">
					<textarea name="black_reson"></textarea>
				</label>
			</div>
		</div>
		<div class="form-group last">
		<label class="label-control"></label>
		<button id="submit-fomr" name="booking" type="submit" class="btn btn-primary btn-large">Room Block</button>
		</div>
	</form>
</div>

  </div>
</div>
</section>
 <!-- footer -->
		  <?php require("components/footer.php");?>
  <!-- / footer -->
</section>
<!--main content end-->
</section>
<script src="js/bootstrap.js"></script>
<script src="js/jquery.dcjqaccordion.2.7.js"></script>
<script src="js/scripts.js"></script>
<script src="js/jquery.slimscroll.js"></script>
<script src="js/jquery.nicescroll.js"></script>
<script src="js/jquery.scrollTo.js"></script>
<!-- morris JavaScript -->	
<script>
	$(document).ready(function() {
		//BOX BUTTON SHOW AND CLOSE
	   $('.small-graph-box').hover(function() {
		  $(this).find('.box-button').fadeIn('fast');
	   }, function() {
		  $(this).find('.box-button').fadeOut('fast');
	   });
	   $('.small-graph-box .box-close').click(function() {
		  $(this).closest('.small-graph-box').fadeOut(200);
		  return false;
	   });	   
	});
</script>
</body>
</html>