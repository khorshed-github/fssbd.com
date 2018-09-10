<?php
include("config/dbconnect.php");
include("login_check.php");
	$cid = preg_replace('#[^0-9]#i','',$_GET['edt']);
	$squery = mysqli_query($con,"SELECT * FROM clients WHERE client_id='$cid'");
	$objs = mysqli_fetch_object($squery);
		$id = $objs->client_id;
		$first_name = $objs->first_name;
		$surname = $objs->surname;
		$street_addr = $objs->street_addr;
		$city = $objs->city;
		$province = $objs->province;
		$zip = $objs->zip;
		$country = $objs->country;
		$phone = $objs->phone;
		$nid = $objs->nid;
		$email = $objs->email;

//Customer Lookup Edit Page
if(isset($_POST['submit'])){
	$cid=trim($_POST["cid"]);
	$first_name = trim($_POST["first_name"]);
	$surname = trim($_POST["surname"]);
	$street_addr = trim(str_replace("'","~",$_POST["street_addr"]));
	$city = trim($_POST["city"]);
	$province = trim($_POST["province"]);
	$zip = trim($_POST["zip"]);
	$country = trim($_POST["country"]);
	$phone = trim($_POST["phone"]);
	$nid = trim($_POST["nid"]);
	$email = trim($_POST["email"]);

		$edt = mysqli_query($con,"UPDATE `clients` SET `first_name`='$first_name', `surname`='$surname', `street_addr`='$street_addr', `city`='$city', `province`='$province', `zip`='$zip', `country`='$country', `phone`='$phone', `nid`='$nid', `email`='$email', `datetime`=CURRENT_TIMESTAMP WHERE `client_id`='$cid'");

		mysqli_close($con);
		
		if ($edt){
			$msg = "Successfully Edited-:)";
		} else {
			$msg = "Edited Error!!.";
		}
}
?>
<!DOCTYPE html>
<head>
<title>Edit Clients Lookup || Tea Resort & Museum</title>
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
		<div class="row">		
			<div class="col-lg-12">
                    <section class="panel">
                        <header class="panel-heading">
                            Clients Lookup Edit
                        </header>
                        <div class="panel-body">
                            <div class="position-center">
							<?php							
							if($msg){?>
							 <div class="alert alert-success" role="alert">
									<button type="button" class="close" data-dismiss="alert" aria-label="close">
										<span aria-hidden="true">&times;</span>
									</button>
									<span><strong><?php echo $msg; ?></strong></span>
							  </div>
							<?php } ?>
                               <form method="post" enctype="multipart/form-data">
                                <div class="form-group">
                                    <label for="firstName">First Name</label>
                                    <input type="text" value="<?php echo $first_name;?>" name="first_name" required="required" class="form-control" placeholder="Enter First Name">
                                </div>
								<div class="form-group">
                                    <label for="LastName">Last Name</label>
                                    <input type="text" value="<?php echo $surname;?>" name="surname" required="required" class="form-control" placeholder="Enter Last Name">
                                </div>
								
                                 <div class="form-group">
                                    <label for="address">Address</label>
                                    <textarea name="street_addr" required="required" class="form-control" placeholder="Enter Address"><?php echo $street_addr;?></textarea>
                                </div>
								<div class="form-group">
                                    <label for="city">City</label>
                                    <input type="text" value="<?php echo $city;?>" name="city" required="required" class="form-control" placeholder="City Hare">
                                </div>
								<div class="form-group">
                                    <label for="province">Province</label>
                                    <input type="text" value="<?php echo $province;?>" name="province" required="required" class="form-control" placeholder="Enter Province Name">
                                </div>
								<div class="form-group">
                                    <label for="zip">Zip</label>
                                    <input type="text" value="<?php echo $zip;?>" name="zip" required="required" class="form-control" placeholder="Enter Zip Code">
                                </div>
								<div class="form-group">
                                    <label for="country">Country</label>
                                    <input type="text" value="<?php echo $country;?>" name="country" required="required" class="form-control" placeholder="Enter Country Name">
                                </div>
								<div class="form-group">
                                    <label for="phone">Phone Number</label>
                                    <input type="text" value="<?php echo $phone;?>" name="phone" required="required" class="form-control" placeholder="Enter Phone Number">
                                </div>
								<div class="form-group">
                                    <label for="email">Email Address</label>
                                    <input type="email" value="<?php echo $email;?>" name="email" required="required" class="form-control" placeholder="Enter Email Address">
                                </div>
                                 <div class="form-group">
									<input type="hidden" name="cid" value="<?php echo $cid;?>">
									<input type="submit" onclick="return confirm('Do you want to Edit?')" name="submit" class="btn btn-outline-info" value="Edit" />
									<input type="reset" class="btn btn-outline-success" value="Reset" />
								  </div>
                            </form>
                            </div>

                        </div>
						<button type="button" class="btn btn-outline-primary btn-sm btn-right" onclick="goBack();">Go Back</button>
                    </section>
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