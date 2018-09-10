<!--A Design by KHORSHED ALAM
Author: E-VISION
Author URL: http://www.eslctg.com
-->
<?php
//include("login_check.php");
error_reporting(0);
include("config/dbconnect.php");
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
                                        <h1>Photo Gallery</h1>
                                        <img class="dot-square" src="images/icons/line-small.png">
                                    </div>
                                </div>
                            </div>

                            <div class="row">
                                <div class="col-md-12"> <!-- data-scrollreveal="enter left over 1s after 0.5s" -->
                          
                                    <fieldset class="filter flat">
                                        <div>
                                            <select id="select_element">	
												 <option value="all" selected >All</option>
											<?php 
												$sqlf = mysqli_query($con,"SELECT * FROM album");
												while($rowf = mysqli_fetch_array($sqlf)){
											?>
                                            <option value="<?php echo $rowf['class'];?>"><?php echo $rowf['title'];?></option> 
                                            <?php	
											}
										?>   
                                            </select> 
                                        </div>
                                    </fieldset>
                                </div>
                            </div>

                            <div class="row">
                                <div class="col-md-12"> <!-- data-scrollreveal="enter left over 1s after 0.5s" -->
                                
                                <div class="photo-gallery-container">
                                <ul class="magnet photo-gallery" style="">
							<?php 
								$sqlg = mysqli_query($con,"SELECT id,aid,title,image FROM gallery");
								while($rowg = mysqli_fetch_array($sqlg)){
							?>
                            <li class="magnet-item room odd first-child rooms">
                                    <div>
                                        <a href="cp/images/gallery/<?php echo $rowg['image'];?>" title="<?php echo $rowg['title'];?>" class="vt-item" rel="restaurant_vtours[king-deluxe]">
                                        <div><img src="cp/images/gallery/<?php echo $rowg['image'];?>"></div>
                                        <h4><?php echo $rowg['title'];?></h4></a>
                                    </div>
                            </li>
							<?
								}
							?>	
                            </ul>
                                    
                            </div>
                               
                        </div>
                    </div>
                </div><!-- END .Gallery-container -->
            </div>

                <script type="text/javascript">
                    $('#select_element').change(function(){
                        if($(this).val() == 'all'){
                            $('.photo-gallery-container ul.photo-gallery li').fadeIn(2000);
                            $('.photo-gallery-container ul.photo-gallery li').css('display', 'inline-block');
                        }else{
                            $('.photo-gallery-container ul.photo-gallery li').fadeOut();
                            $('.photo-gallery-container ul.photo-gallery li.'+$(this).val()).css('display', 'inline-block');
                            $('.photo-gallery-container ul.photo-gallery li.'+$(this).val()).fadeIn(2000);
                        }
                        
                    });
                </script>
		
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