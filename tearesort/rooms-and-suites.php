<!--A Design by KHORSHED ALAM
Author: E-VISION
Author URL: http://www.eslctg.com
-->
<?php
error_reporting(0);
include("config/dbconnect.php");
?>
<!doctype html>
<html lang="en">
<head>
	<title>Rooms & Banglo in Tea Resort & Museum</title>
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
                    <?php require("components/facilities-slider.php");?>
                    <!-- <div class="tp-bannertimer"></div> -->
                    <div class="slider-preload-cover">
                    </div>
                </div>
            </div>            
        </div><!-- END .home-landing -->

                    <div class="background-radius"></div>
                    <a id="style-logo" href="index.html">Tea Resort &amp; Museum</a>

                    <div class="welcome-container-holder">
                        <div class="container">
                            <div class="row">
                                <div class="col-md-12">
                                    <div class="welcome-text-div pattern">
                                        <p class="page-header"><span>Discover Rooms &amp; Bungalow</span></h1>
                                        <img src="images/icons/line.png" alt="grand sultan">
                                        <p>
                                           A most modern concept, a combination of design, style, space and a peaceful faraway outlook of gardens, lake or swimming pool, the bungalow is 1600/1200 sqft. in size featuring a  TV with comprehensive cable TV channels. A large drawing room, dining room and verandah are welcome benefits for business and leisure travellers alike.
                                        </p>
                                    </div>
                                </div>
                            </div>
                            <div>
                            </div>
                        </div><!-- END .container -->
                    </div><!-- END .welcome-container-holder -->

                    <div class="container">
                        <div class="row">
                            <div class="col-12">
                                <div id="calls" class="rooms-info-container">
									<?php
										//$sfid = $_GET['sfid'];
										$sqla = mysqli_query($con,"SELECT * FROM accomodation WHERE facilities_id='$sfid'");
										$count = 1;
										while($rowa = mysqli_fetch_array($sqla)){
											$count++;
										if($count % 2 == 0){											
									?>
                                    <div class="calls-content left visible">
                                        <div class="pic has_transition_1000_cubic big"><img class="full_width" src="cp/images/accomodation/<?php echo $rowa['image'];?>" alt="king deluxe room"></div>
                                        <div class="pic has_transition_1000_cubic small"><img class="full_width" src="cp/images/accomodation/<?php echo $rowa['image'];?>" alt="king deluxe room"></div>
                                        <div class="room_summary">
                                            <div class="content right">
                                                <p class="room_titlename"><?php echo $rowa['title'];?></p>
                                                <img src="images/icons/classy_spacer.png" alt="grand sultan" class="line">
                                                <ul class="info-ul">
                                                    <li><div class="number"><p><?php echo $rowa['sqm'];?></p></div><div class="text"><p><span>size</span> sqm</p></div></li>
                                                    <li><div class="number"><p><?php echo $rowa['sqf'];?></p></div><div class="text"><p><span>size</span> sqf</p></div></li>
                                                    <li><div class="number"><p><?php echo $rowa['guest'];?></p></div><div class="text"><p><span> max</span> guests</p></div></li>
                                                    <!-- <li><div class="number"><p>1</p></div><div class="text"><p><span>no</span>room</p></div></li> -->
                                                </ul>

                                                <div class="rack-rate"><span class="rate-title">Rack Rate</span><span class="rate">BDT <i><?php echo $rowa['bdt_rate'];?></i> / US $<i><?php echo $rowa['usd_rate'];?></i></span></div>
                                                <div class="rack-rate mobile"><span class="rate-title">Rack Rate</span><span class="rate">BDT <i><?php echo $rowa['bdt_rate'];?></i> / US $<i><?php echo $rowa['usd_rate'];?></i></span></div>

                                                <div class="discount-offer">
				 <p>Room Rates Exclusive of  <span>5%</span> Service Charge & <span>15%</span> VAT</p>
				<p>Enjoy <span><?php echo $rowa['discount'];?>%</span> discount on room rack rate.</p>
				<!-- <p class="mobile">Enjoy <span>45%</span> discount on room rack rate.</p> -->
			</div>
			<!-- 
			<div class="discount-offer mobile">
				<p>Enjoy <span>45%</span> discount on room rack rate.</p>
			</div> -->
                                                <ul class="link-ul">
                                                    <li><a href="#">Find More</a></li>
                                                    <!-- <li><a href="#">Book Now</a></li> -->
                                                </ul>
                                            </div>
                                        </div>
                                    </div><!-- END .calls-content -->									
									<?php
											}else{									
									?>
									
                                    <div class="calls-content right visible">
                                        <div class="pic has_transition_1000_cubic small"><img class="full_width" src="cp/images/accomodation/<?php echo $rowa['image'];?>" alt="queen deluxe"></div>

                                        <div class="room_summary">
                                            <div class="content left">
                                                <p class="room_titlename"><?php echo $rowa['title'];?></p>
                                                <img src="images/icons/classy_spacer.png" class="line" alt="">
                                                <ul class="info-ul">
                                                    <li><div class="number"><p><?php echo $rowa['sqm'];?></p></div><div class="text"><p><span>size</span> sqm</p></div></li>
                                                    <li><div class="number"><p><?php echo $rowa['sqf'];?></p></div><div class="text"><p><span>size</span> sqf</p></div></li>
                                                    <li><div class="number"><p><?php echo $rowa['guest'];?></p></div><div class="text"><p><span> max</span> guests</p></div></li>
                                                    <!-- <li><div class="number"><p>1</p></div><div class="text"><p><span>no</span>room</p></div></li> -->
                                                </ul>

                                                <div class="rack-rate"><span class="rate-title">Rack Rate</span><span class="rate">BDT <i><?php echo $rowa['bdt_rate'];?></i> / US $<i><?php echo $rowa['usd_rate'];?></i></span></div>
                                                <div class="rack-rate mobile"><span class="rate-title">Rack Rate</span><span class="rate">BDT <i><?php echo $rowa['bdt_rate'];?></i> / US $<i><?php echo $rowa['usd_rate'];?></i></span></div>
                                                
                                                <div class="discount-offer">
    <p>Room Rates Exclusive of  <span>5%</span> Service Charge & <span>15%</span> VAT</p>
    <p>Enjoy <span><?php echo $rowa['discount'];?>%</span> discount on room rack rate.</p>
    <!-- <p class="mobile">Enjoy <span>45%</span> discount on room rack rate.</p> -->
</div>
<!-- 
<div class="discount-offer mobile">
    <p>Enjoy <span>45%</span> discount on room rack rate.</p>
</div> -->
                                                <ul class="link-ul">
                                                    <li><a href="#">Find More</a></li>
                                                    <!-- <li><a href="#">Book Now</a></li> -->
                                                </ul>
                                            </div>
                                        </div>

                                        <div class="pic has_transition_1000_cubic big"><img class="full_width" src="cp/images/accomodation/<?php echo $rowa['image'];?>" alt="triple deluxe"></div>
                                    </div><!-- END .calls-content -->
								<?php
									}
								}
								?>
									

                                </div><!-- END #calls -->
                            </div>
                        </div>
                    </div>

                    <!-- Offers -->
					
					<!--Offers Carousel Section Hare-->
					
                    <!-- END Offers -->

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

    </body>
</html>