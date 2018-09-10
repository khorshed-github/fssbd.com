<?php
include("config/dbconnect.php");
error_reporting(0);
?>
<!doctype html>
<html lang="en">
<head>
	<title>Tea Resort & Museum - Tea Board Resort & Bungalow in Sylhet region of Bangladesh</title>
	<?php require("components/head.php"); ?>
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

        <div class="welcome-container-holder">
            <div class="container">
                <div class="row">
                    <div class="col-md-12">
                        <div class="welcome-text-div pattern">
                            <h1><span>Welcome to</span> Tea Resort &amp; Museum</h1>
                            <img src="images/icons/line.png" alt="Tea Resort">
                            <p>
                                Tea Resort, one of the most attractive modern leisure Resort constructed by the British consultant to suite their peaceful dwelling in the midst of a tea state with a wonderful landscape consisting of more than 25 acres of Green Hills and Hill tops. The resort campus is gifted with a scenic beauty featuring modern interior design and architecture, outdoor Park, modern swimming pool, lawn tennis, table tennis and badminton. The restaurant caters return area of local Asian international cuisines with emphasis on fresh healthy and creative flavors. For site seeing there are monipuri village, khasiya punji, Madabpur Lake, Tea Estates and Lawacherra forest with their captivating views. Tea resort is conventionally located Near Sreemangal town, well communicated with Dhaka Chittagong and sylhet by road rail and air. It offers luxurious a condition excellent facilities omitted service and warm hospitality to make every moment of a memorable relaxing and enjoyable.
                            </p>
                        </div>
                    </div>
                </div>
                <div>
                </div>
            </div><!-- END .container -->
        </div><!-- END .welcome-container-holder -->

        <div class="facilities-container-holder">
            <div class="container offer-container">
                <div class="row">
                    <div class="col-md-4">
                        <div class="welcome-text-div inner-header-div">
                            <p class="header-one">At A Glance</p>
                            <img src="images/icons/line-small.png" alt="At a glance at Tea Resort & Museum">
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="col-md-12">
                        <div id="services-carousel" class="facilities-carousel fadeOut owl-carousel owl-theme">
							<?php require("components/facilities.php");?>
                        </div><!-- END #services-carousel -->
                        <!-- Carousel -->
                        <script>
                        $(document).ready(function() {
                          var owlk = $("#services-carousel");
                          owlk.owlCarousel({
                            nav:true,
                            items: 1,
                            dots: false,
                            navContainer: '.services-carousel-container .customNavigation',
                            navText: [$('.prev'),$('.next')],
                            animateOut: 'fadeOut',
                            loop: true,
                            autoplay:false,
                            margin: 10
                          });
                        });
                        </script>
                        <!-- End Carousel -->
                    </div><!-- END .col -->
                </div><!-- END .row -->
            </div><!-- END .container -->
        </div><!-- END .facilities-container-holder -->

        <div id="calls">
            <div class="calls-content left visible home">
                <div class="matt_block _1 has_transition_1000_cubic">
                <!-- <a href="#"> -->
                    <div class="content">
                        <img class="cls_logo centered has_transition_800" src="images/icons/meeting.png"  class="img-responsive" alt="meeting venues at Tea Resort & Museum">
                        <h3 class="cls_title has_transition_800">Meetings &amp; Events Coming Soon..</h3>
                        <img class="centered cls_spacer has_transition_800" src="images/icons/small_spacer_white.png" class="img-responsive" alt="gs meetings">
                        <div class="ref_title has_transition_800">Organize annual conference, product launch, board meeting, or any type of business activities and celebrate a GRAND event. Call us today to book your next event.</div>
                        <a href="meetings-and-events.php" class="more has_transition_400">Find More</a>
                    </div>
                    <!-- </a> -->
                </div>
                <div class="pic has_transition_1000_cubic"><img class="full_width" src="cp/images/meeting-events/meetings-and-events.jpg" alt="meetings"></div>
            </div>            
        </div><!-- END #calls -->
		
            <div class="container offer-container">                
				<div class="row"> 
					<div class="col-md-12">
						<div class="welcome-text-div">
							<h1>Spacial Offers <?php echo date("Y");?></h1>
							<img class="dot-square" src="images/icons/line-small.png" alt="special offers">
						</div>
					</div>
				</div>
				<?php
					$sqlOffer = mysqli_query($con,"SELECT * FROM offer");
					while($queryRow = mysqli_fetch_array($sqlOffer)){
					$count++;
					if($count % 2 == 0){
				?>
                <div class="row">
                    <div class="col-md-6">
                        <div class="package-text-container offer-text-container">
                            <h1><?php echo $queryRow['title'];?></h1>
                            <h4 class="offer-date">Valid From <?php echo date("d M Y",strtotime($queryRow['start_date']));?> To <?php echo date("d M Y",strtotime($queryRow['end_date']));?> with <?php echo $queryRow['discount'];?>% Discount!!</h4>
                            <p><?php echo $queryRow['description'];?></p>
                            <a href="spacial-offer.php" class="has_transition_400 left">Find More</a>
                        </div>
                    </div>

                    <div class="col-md-6 dot-line-right-big">
                        <div class="dot-line-right">
                            <img src="cp/images/offer/<?php echo $queryRow['image'];?>" alt="<?php echo $queryRow['title'];?>">
                        </div>
                    </div>
                </div>                
				<?php
					}else{
				?>				
                <div class="row">
                    <div class="col-md-6">
                        <div class="dot-line-left offers-dot-line-left">
                            <img src="cp/images/offer/<?php echo $queryRow['image'];?>" class="img-responsive" alt="<?php echo $queryRow['title'];?>">
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="package-text-container right offers-right">
                            <h1><?php echo $queryRow['title'];?></h1>
							<br>
                            <h4 class="offer-date">Valid From <?php echo date("d M Y",strtotime($queryRow['start_date']));?> To <?php echo date("d M Y",strtotime($queryRow['end_date']));?> with <?php echo $queryRow['discount'];?>% Discount!!</h4>
						   <p><?php echo $queryRow['description'];?></p>
						   <br/>
                            <a href="spacial-offer.php" class="has_transition_400 left">Find More</a>
                        </div>
                    </div>
                </div>
               <?php 
					}
				}
			   ?>
            </div><!-- END .offer-container -->
			
			<div id="calls" style="background:#f0f0f0;">
				<div class="container">
					<div class="row">
						<div class="col-md-4">
							<div class="thumbnail">
								<a href="">
								<img class="img-responsive img-thumbnail" alt="" src="images/man-icon.png" style="width:100%">
								<div class="caption"><strong>Md.Khorshed Alam</strong></div>
								</a>						
							</div>
						</div>
						<div class="col-md-4">
							<div class="thumbnail">
								<a href="">
								<img class="img-responsive img-thumbnail" alt="" src="images/man-icon.png" style="width:100%">
								<div class="caption"><strong>Md.Khorshed Alam</strong></div>
								</a>						
							</div>
						</div>
						<div class="col-md-4">
							<div class="thumbnail">
								<a href="">
								<img class="img-responsive img-thumbnail" alt="" src="images/man-icon.png" style="width:100%">
								<div class="caption"><strong>Md.Khorshed Alam</strong></div>
								</a>						
							</div>
						</div>
					</div>
				</div>
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
    </body>
</html>                        