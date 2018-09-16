<?php
include("config/dbconnect.php");
error_reporting(0);
?>
<!doctype html>
<html lang="en">
<head>
		<title>Spacial Offers || Tea Resort & Museum</title>
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
		<div class="offers-page" style="background:#f5f5f5;">
            <div class="container offer-container">                
				<div class="row"> 
					<div class="col-md-12">
						<div class="welcome-text-div">
							<h1>Special Offers <?php echo date("Y");?></h1>
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
                            <a href="#" class="has_transition_400 left">Find More</a>
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
						   <br>
                            <a href="#" class="has_transition_400 left">Find More</a>
                        </div>
                    </div>
                </div>
               <?php 
					}
				}
			   ?>
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