<?php
session_start();
error_reporting(0);
include("config/dbconnect.php");
if(isset($_POST['booking'])){
	
	$indate = trim(date('Y-m-d',strtotime($_POST['check_in'])));		
	$outdate = trim(date('Y-m-d',strtotime($_POST['check_out'])));

	
	$qd = mysqli_query($con,"SELECT DATEDIFF('$outdate','$indate') as difdate");
	$objd = mysqli_fetch_object($qd);
	$night = $objd->difdate;
	
	$adult = trim($_POST['adult']);
	$child = trim($_POST['child']);
	$roomType = trim($_POST['roomType']);
	
	/* $q = "SELECT * FROM `bookings` WHERE (`start_date` BETWEEN '".$indate."' AND '".$outdate."') AND (`end_date` BETWEEN '".$indate."' AND '".$outdate."')"; */ // This Quary also workable.

	$q = "SELECT * FROM `bookings` WHERE `start_date` <= '$indate' AND `end_date` >= '$outdate'";

	$result=mysqli_query($con,$q);
	if (!$result)
		echo(mysqli_error($con));

	if(mysqli_num_rows($result)>0)
		{
			$msg = "<strong>Sorry no available room in this date schedule.</strong> Please search another date schedule.";
		}
    else 
		{
	$qtype = mysqli_query($con,"SELECT id,title,bdt_rate,discount FROM accomodation WHERE id='$roomType'");
	$objatype = mysqli_fetch_object($qtype);
	$id = $objatype->id;	
	$roomName = $objatype->title; 
	$fixdPrice = $objatype->bdt_rate; 	
	$discount = $objatype->discount;	
	
	$roomPrice = $night * $fixdPrice;	
	$serviceCharge = $roomPrice/100*5;
	$total = $roomPrice + $serviceCharge;
	
	$vat = $total/100*15;
	
	$grandTotal = $total + $vat;
	
	$discountAmount = $grandTotal / 100 * $discount;
	
	$totalAmount = $grandTotal - $discountAmount;
	
	//$onlineCharge = $totalAmount/100*3.5;
	
	$bookingAmount = $totalAmount;
	}
}
// Get Search Value to retrive booking-process Page//
$_SESSION['startTime']=$indate;
$_SESSION['endTime']=$outdate;
$_SESSION['guestCount']=$adult;
$_SESSION['childCount']=$child;
$_SESSION['bangloType']=$roomType;
?>

<!doctype html>
<html lang="en">
<head>
<title>Online Booking Process || Tea Resort & Museum</title>
	<?php require("components/head.php"); ?>
<!-- Jquery UI CSS   -->
<link rel="stylesheet" type="text/css" href="css/style.css">	
</head>
    <body>
        <div id="perspective">
            <div id="container">
                <div id="top">
                   <?php require("components/header.php");?>
                </div><!-- END #top -->

                <div id="wrapper">
                    <div id="menu_upper">
                        <ul class="contact-ul">
                            <li><a href="tel:+88 01712071502"> +88 01712 071502</a></li>
                        </ul>
                    </div>
                    <div class="quick_socials mobile_hidden">
                       <?php require("components/socialLink.php");?>
                    </div> 
					
			<div class="home-landing scrollable">
            <div class="content-holder">
                <!-- ========== REVOLUTION SLIDER ========== -->        
                <div class="fullwidthbanner">
                    <?php require("components/slider.php");?>
                    <!-- <div class="tp-bannertimer"></div> -->
                    <div class="slider-preload-cover">
                    </div>
                </div>
            </div>            
        </div><!-- END .home-landing -->
		
		<div class="background-radius"></div>
        <a id="style-logo" href="#">Tea Resort &amp; Museum</a>			
		<div class="offers-page" style="background:#ffffff;"><!--Booking Details -->
            <div class="container offer-container">                
				<div class="row"> 
					<div class="col-md-12">
						<div class="welcome-text-div">
							<h1>Booking Details</h1>
							<img class="dot-square" src="images/icons/line-small.png" alt="special offers">
						</div>
							<div class="alert alert-danger" role="alert"> 
							<?php
								if($msg){
									echo $msg;
								}
							?>							
							</div>	
					</div>
				</div>
			
                <div class="container">
                        <div class="row">
                            <div class="col-12">	
						<section class="row row-shoping clearfix">
							<div class="row-room clearfix">
								<table cellpadding="0" cellspacing="1" border="0" width="100%" bgcolor="#FFFFFF" style="font-size:13px;">
								   <tr>
									<td bgcolor="#DBEDFC" align="center"><strong>Check-In Date</strong></td>
									<td bgcolor="#DBEDFC" align="center"><strong>Check-Out Date</strong></td>
									<td bgcolor="#DBEDFC" align="center"><strong>Total Nights</strong></td>
									<td bgcolor="#DBEDFC" align="right" style="padding-right:5px;"><strong>Amounts</strong></td>
								   </tr>
								   <tr>
									<td align="center" bgcolor="#f5f9f9"><?php echo date("d-m-Y",strtotime($indate));?></td>
									<td align="center" bgcolor="#f5f9f9"><?php echo date("d-m-Y",strtotime($outdate));?></td>
									<td align="center" bgcolor="#f5f9f9"><?php echo $night;?></td>
									<td align="center" bgcolor="#f5f9f9"></td>
								   </tr>
								   <tr>
									<td bgcolor="#DBEDFC" align="center"><strong>Room Type</strong></td>
									<td bgcolor="#DBEDFC" align="center"><strong>Adult</strong></td>
									<td bgcolor="#DBEDFC" align="center"><strong>Child</strong></td>
									<td bgcolor="#DBEDFC" align="right" style="padding-right:5px;"><strong>Gross Total</strong></td>
								   </tr>
									<tr>
									<td bgcolor="#f5f9f9" align="center"><strong><?php echo $roomName;?></strong></td>
									<td bgcolor="#f5f9f9" align="center"><strong><?php echo $adult;?></strong></td>
									<td bgcolor="#f5f9f9" align="center"><strong><?php echo $child;?></strong></td>
									<td bgcolor="#f5f9f9" align="right" style="padding-right:5px;"><strong><?php echo 'TK'.number_format($roomPrice, 2 , '.', ',');?></strong></td>
								   </tr>

								   <tr>
									<td colspan="3" align="right" bgcolor="#DBEDFC"><strong>Sub Total</strong></td>
									<td bgcolor="#DBEDFC" align="right" style="padding-right:5px;"><strong>
									 <?php echo 'TK'.number_format($roomPrice, 2 , '.', ',');?>
									 </strong></td>
								   </tr>
								   
									<tr>
										<td colspan="3" align="right" bgcolor="#f5f9f9">Service Charge ( 5 %)</td>
										<td align="right" bgcolor="#f5f9f9" style="padding-right:5px;"><span id="taxamountdisplay">
										  <?php echo 'TK'.number_format($serviceCharge, 2 , '.', ',');?>
										 </span></td>
									</tr>
								
									<tr>
									<td colspan="3" align="right" bgcolor="#DBEDFC"><strong> Total</strong></td>
									<td align="right" bgcolor="#DBEDFC" style="padding-right:5px;"><strong> <span id="grandtotaldisplay">
									<?php echo 'TK'.number_format($total, 2 , '.', ',');?>
									 </span></strong></td>
								   </tr>
								   
									<tr>
									<td colspan="3" align="right" bgcolor="#f5f9f9">VAT ( 15 %)</td>
									<td align="right" bgcolor="#f5f9f9" style="padding-right:5px;"><span id="taxamountdisplay">
									  <?php echo 'TK'.number_format($vat, 2 , '.', ',');?>
									 </span></td>
								   </tr>
								   
									<tr>
									<td colspan="3" align="right" bgcolor="#DBEDFC"><strong>Grand Total</strong></td>
									<td align="right" bgcolor="#DBEDFC" style="padding-right:5px;"><strong> <span id="grandtotaldisplay">
									<?php echo 'TK'.number_format($grandTotal, 2 , '.', ',');?>
									 </span></strong></td>
								   </tr>

								   <tr id="advancepaymentdisplay">
									<td colspan="3" align="right" bgcolor="#f5f9f9"><strong> Discount Payment( <?php echo $discount;?>.00 <span style="font-size:11px;"></strong> &nbsp;
									 %of Grand Total</span>)</td>									 
									<td align="right" bgcolor="#f5f9f9" style="padding-right:5px;"><span id="advancepaymentamount">
									 <?php echo 'TK'.number_format($discountAmount, 2 , '.', ',');?>
									 </span></td>
								   </tr>
								   
									<tr>
									<td colspan="3" align="right" bgcolor="#DBEDFC"><strong>Total Amount</strong></td>
									<td align="right" bgcolor="#DBEDFC" style="padding-right:5px;"><strong> <span id="grandtotaldisplay">
									<?php echo 'TK'.number_format($totalAmount, 2 , '.', ',');?>
									 </span></strong></td>
								   </tr>
								   <!--
								   <tr>
									<td colspan="3" align="right" bgcolor="#f5f9f9">Online Charge ( 3.50 %)</td>
									<td align="right" bgcolor="#f5f9f9" style="padding-right:5px;"><span id="taxamountdisplay">
									 <?php// echo 'TK'.number_format($onlineCharge, 2 , '.', ',');?>
									 </span></td>
								   </tr>
								   -->
								   <tr>
								   <tr id="advancepaymentdisplay">
									<td colspan="3" align="right" style=" background:#7ec7bd;"><strong> Advance Booking Amount Pay</strong></td>
									<td align="right" style="padding-right:5px; background:#7ec7bd;"><span id="advancepaymentamount"><strong>
									<?php echo 'TK'.number_format($bookingAmount, 2 , '.', ',');?></strong>
									 </span>
									 </td>
								   </tr>
								  </table>
								</div>
								<div class="line"></div>							
						</section><!-- /.shopping-card -->
						
						
						<section class="row row-account clearfix">
							<header class="box-heading">
								<h3 class="head headborder">Account information</h3>
							</header><!-- /.box-heading -->
							<div class="box-body">
								<div class="form-group">
									<label class="label-control">Email<span class="start">*</span></label>
                                    <input type="text" name="email_addr_existing" id="email_addr_existing" class="input-control" required />
								</div>
                               <!-- <button id="btn_exisitng_cust" class="btn btn-medium btn-brown" type="submit" style="float:left;">FETCH DETAILS</button>-->
							</div><!-- /.box-body -->
						</section><!-- /.account-info -->
						
						<!--  
						//Insert Data into Database using Jquery//
						
						<script type="text/javascript">
							$(document).ready(function(){
								$("#registerButton").click(function(e){
								e.preventDefault();
								  var cid = $("#cid").val();
								  var title = $("#title").val();
								  var fname = $("#fname").val();
								  var lname = $("#lname").val();
								  var phone = $("#phone").val();
								  var email = $("#email").val();
								  var country = $("#country").val();
								  var nid = $("#nid").val();
								  var str_addr = $("#str_addr").val();
								  var city = $("#city").val();
								  var state = $("#state").val();
								  var zipcode = $("#zipcode").val();
								  var message = $("#message").val();
									$.ajax({
										type:"POST",
										url:"booking-process.php",
										data:{cid:cid,title:title,fname:fname,lname:lname,phone:phone,email:email,country:country,nid:nid,str_addr:str_addr,city:city,state:state,zipcode:zipcode,message:message},
										
										 success:function(data){
											alert(data);
											DataClear();
										} 
										
									});
								});								
							});							
							
							function DataClear(){ //Clear Input & textarea all Data after Save
							$("#form1 :input").each(function(){
								$(this).val("");
							});
							$("#form1 :textarea").each(function(){
								$(this).val("");
							});
							}
						</script>
						-->
						<form method="post" action="booking-process.php" id="form1" class="signupform">
						<section class="row row-billing clearfix">
							<header class="box-heading">
								<h3 class="head headborder">Billing information</h3>
							</header><!-- /.box-heading -->
							
							<div class="box-body">
							
							<div id="clientInfo"> <!-- Ajax Loader Page Start -->
							
							<!--getclientinfo.php page-->
							
							</div> <!-- Ajax Loader Page End -->
						
							<div class="row">
								<div class="form-group"> 
									<label for="paymentMethod" class="label-control">Payment<span class="start">*</span></label>
									<input type="radio" name="paymentType"  class="required" required />Credit / Debit Cards / DBBL Nexsus/ Brac Bank/
								</div>
				                <div class="form-group">
									<label class="label-control">Any additional requests<span class="start">*</span></label>
									<textarea name="message" id="message" style="100%; height:80px;" class="input-control"></textarea>
								</div>
								
								<div class="form-action">
									<input type="checkbox" name="tos" id="tos" value="" style="width:15px !important"  class="required" required />&nbsp;      
     I agree with the <a href="javascript: ;" onclick="javascript:myPopup2();"> Terms & Conditions.</a>
									
									<p><button id="registerButton" name="registerButton" type="submit" style="float:left;" class="btn btn-large btn-darkbrown">Book now & Pay Deposit</button></p>
									
								</div>
							</div>
						</div>
							
						</form>
						</section>
                            </div>
                        </div>
                    </div>
									
            </div><!-- END .offer-container -->
        </div>
		
            <?php require("components/footer.php");?>

                </div><!-- END #wrapper -->

                <div id="freezer"></div><!-- END #freezer -->
            </div><!-- END #container -->

            <!-- 
            *********************************************
            *********************************************
                Start Left Menu || freeze contents
            *********************************************
            *********************************************
            -->
            <div id="nav">
			
               <?php require("components/left-menu.php");?>

            </div><!-- END #nav -->
        </div><!-- END #perspective -->
        <script src="js/bootstrap.js"></script>
        <script src="js/jquery-ui.min.js"></script>
        <script src="js/jquery.validate.min.js" type="text/javascript"></script>
        <script src="js/jquery.validate.unobtrusive.min.js" type="text/javascript"></script>

		<script type="text/javascript" src="js/jquery.bxslider.min.js"></script>		
		
        <script src="js/datepicker-en-US.js"></script>
		
        <script src="js/jquery.flexslider-2.4.0.min.js"></script>
        <script src="js/masonry.pkgd.min.js"></script>
        <script src="js/imagesloaded.pkgd.min.js"></script>
        <script src="js/jquery.fancybox.pack.js"></script>
        <script src="js/jquery.viewportchecker.min.js"></script>
        <script src="js/jquery.sticky-kit.min.js"></script>
        <script src="js/jquery.steps.min.js"></script>
        <script src="js/core.obf.js"></script>
        <script src="js/app.js"></script>
		
        <!-- ========== revolution Slider ========== -->  
        <script type="text/javascript" src="js/jquery.themepunch.plugins.min.js"></script>           
        <script type="text/javascript" src="js/jquery.themepunch.revolution.min.js"></script>  
        <script type="text/javascript">
            var tpj=jQuery;                
            //tpj(document).ready(function() {
            
            if (tpj.fn.cssOriginal!=undefined)
                tpj.fn.css = tpj.fn.cssOriginal;
                tpj('.fullwidthbanner').revolution(
                    {   
                        delay: 7000,                                             
                        startwidth:890,
                        startheight:450,                        
                        onHoverStop:"off", // Stop Banner Timet at Hover on Slide on/off
                        
                        thumbWidth:100, // Thumb With and Height and Amount (only if navigation Tyope set to thumb !)
                        thumbHeight:50,
                        thumbAmount:4,
                        
                        hideThumbs:200,
                        navigationType:"none", //bullet, thumb, none, both  (No Shadow in Fullwidth Version !)
                        navigationArrows:"verticalcentered", //nexttobullets, verticalcentered, none
                        navigationStyle:"round", //round,square,navbar
                        
                        touchenabled:"on", // Enable Swipe Function : on/off                        
                        navOffsetHorizontal:0,
                        navOffsetVertical:20,                        
                        fullWidth:"off",                        
                        shadow:0 //0 = no Shadow, 1,2,3 = 3 Different Art of Shadows -  (No Shadow in Fullwidth Version !)        
                    });
        //});
        </script>
        <!-- Custom -->

        <script>
        $(document).ready(function(){
            $('#nav').addClass('close');
            $('#pre-footer .logo-holder').height($('.contact-holder').height());
        });
        </script>

        <!-- Owl Carousel Start -->
        <script src="js/owl-carousel-2/owl.carousel.js" type="text/javascript"></script>
        <!-- Owl Carousel End -->

        <script src="js/jquery.prettyPhoto.js" type="text/javascript"></script>

        <!-- Loader on scroll -->
        <script src="js/jquery-scrollReveal.js" type="text/javascript"></script>

        <!-- Others -->
        <script>
            $(window).on('load', function () {
                $('.slider-preload-cover').hide();
                $('.home-landing>div>h1').show();
            });

            $(document).ready(function(){
                $('.facilities-carousel, #awards-carousel').css('height', 'auto');
            });

        </script>

        <script>
        $('#header .quick_socials ul li').each(function(i){
            setTimeout(function(){$('#header .quick_socials ul li:eq('+i+')').removeClass('hidden_by_scaling');},2400+(100*i));
        });
        </script>

    <script src="js/script.js" type="text/javascript"></script>
    <script type="text/javascript">
    $("#promotional-offer .close-img").click(function () {
        $("#promotional-offer").slideUp(500);
    });
    window.onload = $("#promotional-offer").slideDown(500);
    </script>
		
<script type="text/javascript"> <!-- Email / Existing Client Check -->
	$("#email_addr_existing").blur(function(){
		var email = $(this).val();
		$.ajax({
			url:"getclientinfo.php",
			type:"POST",					
			data:{email:email},
			success:function(data){
				$("#clientInfo").html(data);
			}
		}); 
	});
</script>
<script type="text/javascript" src="js/jquery.validate.js"></script>
<script type="text/javascript">
	$().ready(function() {
		$("#form1").validate();
    });        
</script>
    </body>
</html>                       