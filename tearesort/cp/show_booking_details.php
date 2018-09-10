<?php
include("config/dbconnect.php");
include("login_check.php");
?>
<!DOCTYPE html>
<head>
<title>All Customer Lookup || Tea Resort & Museum</title>
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
		CUSTOMER DETAILS
    </div>
	<?php 
		if(isset($_GET['clientid'])){
			$cid = $_GET['clientid'];		
			$num = 0;
			$squery = mysqli_query($con,"SELECT c.*,b.booking_time,b.start_date,b.end_date,b.payment_amount FROM clients as c inner join bookings as b where c.client_id=b.client_id and c.client_id='$cid'");
			while($rowviewdetails = mysqli_fetch_array($squery)){
				$num++;

	?>
    <div class="table-responsive">
      <table class="table table-striped b-t b-light table-hover">
    <tr>
      <td align="left" style="background:#ffffff;" width="150px">Name</td>
      <td align="left" style="background:#ffffff;"><?=$rowviewdetails['title']?>
        <?=$rowviewdetails['first_name']?>
        <?=$rowviewdetails['surname']?></td>
    </tr>
     <tr>
      <td align="left" style="background:#ffffff;">Address</td>
      <td align="left" style="background:#ffffff;"><?=$rowviewdetails['street_addr']?></td>
    </tr>
    <tr>
      <td align="left" style="background:#ffffff;">City</td>
      <td align="left" style="background:#ffffff;"><?=$rowviewdetails['city']?></td>
    </tr>
    <tr>
      <td align="left" style="background:#ffffff;">State</td>
      <td align="left" style="background:#ffffff;"><?=$rowviewdetails['province']?></td>
    </tr>
    <tr>
      <td align="left" style="background:#ffffff;">Country</td>
      <td align="left" style="background:#ffffff;"><?=$rowviewdetails['country']?></td>
    </tr>
    <tr>
      <td align="left" style="background:#ffffff;">Zip / Post code:</td>
      <td align="left" style="background:#ffffff;"><?=$rowviewdetails['zip']?></td>
    </tr>
  
    <tr>
      <td align="left" style="background:#ffffff;">Phone </td>
      <td align="left" style="background:#ffffff;"><?=$rowviewdetails['phone']?></td>
   </tr>
    <tr>
      <td align="left" style="background:#ffffff;">NID</td>
      <td align="left" style="background:#ffffff;"><?=$rowviewdetails['nid']?></td>
    </tr>
    <tr>
      <td align="left" style="background:#ffffff;">Email</td>
      <td align="left" style="background:#ffffff;"><?=$rowviewdetails['email']?></td>
    </tr>
	<tr>
      <td align="left" style="background:#ffffff;">Arrival Date</td>
      <td align="left" style="background:#ffffff;"><?=$rowviewdetails['start_date']?></td>
    </tr>
	<tr>
      <td align="left" style="background:#ffffff;">Departure Date</td>
      <td align="left" style="background:#ffffff;"><?=$rowviewdetails['end_date']?></td>
    </tr>
	<tr>
      <td align="left" style="background:#ffffff;">Total Amount</td>
      <td align="left" style="background:#ffffff;"><?php echo number_format($rowviewdetails['payment_amount'],2,'.',',')?> tk.</td>
    </tr>
  </table>
    </div>
   <?php
		}
	}
	?>
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