<?php
error_reporting(0);
include("config/dbconnect.php");
?>
<!doctype html>
<html lang="en">
<head>
	<title>Contact Us || Tea Resort & Museum - Only 5 star resort in Sylhet region of Bangladesh</title>
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
                    <div class="slider-preload-cover"></div>
                </div>
            </div>            
        </div><!-- END .home-landing -->

                    <div class="background-radius"></div>
                    <a id="style-logo" href="index.php">Tea Resort &amp; Museum</a>

                 <div class="contact-us">
                    <div class="rooms-detail-summary-container room-facilities-container" style="background:#42bfef !important;">
                        <div class="container offer-container">
                            <div class="row">
                                <div class="col-md-12">
                                    <div class="welcome-text-div">
                                        <h1>Contact Us</h1>
                                        <img class="dot-square" src="images/icons/line-small.png">
                                    </div>
                                </div>
                            </div>

                            <div class="row">
                                <div class="col-md-4"> <!-- data-scrollreveal="enter left over 1s after 0.5s" -->
                                    <div class="address_div">
                                        <h3>Tea Resort &amp; Museum</h3>
                                        <ul>
                                            <li class="odd first-child">Srimongal, Moulvibazar - 3210, Bangladesh.</li>
                                            <li class="even">For Reservation: +88 01712 071502<br>For Corporate or Group Event: +88 01712 071502 </li>                                        
                                        </ul>
										
                                        <a href="https://www.google.com.bd/maps/place/Sreemangal+Tea+Resort+and+Museum/@24.3028927,91.7541482,16z/data=!4m23!1m15!4m14!1m6!1m2!1s0x375179f338f9090d:0x57548f3a3ad79890!2sSreemangal+Tea+Resort+and+Museum,+Sreemangal+-+Bhanugach+Rd,+Sreemangal+3210!2m2!1d91.7601034!2d24.301893!1m6!1m2!1s0x375179ed67d3b74d:0xce4d10877581789c!2sGrand+Sultan+Tea+Resort+and+Golf,+Sreemangal+Bhanugach+Rd!2m2!1d91.7642647!2d24.3017127!3m6!1s0x375179f338f9090d:0x57548f3a3ad79890!5m1!1s2018-05-31!8m2!3d24.301893!4d91.7601034" style="font-size: 25px;border: 1px solid;padding: 8px;display: block;">Get Direction on Google Map</a>
                                        <br>
										
                                    </div>
                                    <p>Tea Resort & Museum is a wholly owned subsidiary of Excursion & Resorts Bangladesh Ltd.</p>
                                    <img src="images/icons/excursion-resortsbd-Logo.png" class="powered-by-logo">
									
                                </div>

                                <div class="col-md-8">
                                    <div class="mauticform_wrapper contact-form" id="mauticform_wrapper_contactus">
                                    <form action="mail.php" autocomplete="false" data-mautic-form="contactus" id="mauticform_contactus" method="post" name="mauticform_contactus" role="form" target="mauticiframe_contactus">
                                        <div class="mauticform-error" id="mauticform_contactus_error"></div>
                                        <div class="mauticform-message" id="mauticform_contactus_message"></div>
                                        <div class="mauticform-innerform">
                                            <div class="mauticform-row mauticform-text" id="mauticform_contactus_first_name">
                                                <label class="col-md-3 mauticform-label" for="mauticform_input_contactus_first_name" id="mauticform_label_contactus_first_name">First Name</label> <input class="col-md-9 mauticform-input" id="mauticform_input_contactus_first_name" name="first_name" type="text" value=""> <span class="mauticform-errormsg" style="display: none;"></span>
                                            </div><br>
                                            <br>
                                            <div class="mauticform-row mauticform-text" id="mauticform_contactus_last_name">
                                                <label class="col-md-3 mauticform-label" for="mauticform_input_contactus_last_name" id="mauticform_label_contactus_last_name">Last Name</label> <input class="col-md-9 mauticform-input" id="mauticform_input_contactus_last_name" name="last_name" type="text" value=""> <span class="mauticform-errormsg" style="display: none;"></span>
                                            </div><br>
                                            <div class="mauticform-row mauticform-tel" id="mauticform_contactus_mobile">
                                                <label class="col-md-3 mauticform-label" for="mauticform_input_contactus_mobile" id="mauticform_label_contactus_mobile">Mobile</label> <input class="col-md-9 mauticform-input" id="mauticform_input_contactus_mobile" name="mobile" type="tel" value=""> <span class="mauticform-errormsg" style="display: none;"></span>
                                            </div><br>
                                            <div class="mauticform-row mauticform-email" id="mauticform_contactus_email">
                                                <label class="col-md-3 mauticform-label" for="mauticform_input_contactus_email" id="mauticform_label_contactus_email">Email</label> <input class="col-md-9 mauticform-input" id="mauticform_input_contactus_email" name="email" type="email" value=""> <span class="mauticform-errormsg" style="display: none;"></span>
                                            </div><br>
                                            <div class="mauticform-row mauticform-text" id="mauticform_contactus_message">
                                                <label class="col-md-3 mauticform-label" for="mauticform_input_contactus_message" id="mauticform_label_contactus_message">Message</label> <br>
                                                <textarea class="col-md-9 mauticform-textarea" id="mauticform_input_contactus_message" name="message"></textarea> <span class="mauticform-errormsg" style="display: none;"></span>
                                            </div><br>
                                            <br>
                                            <div class="mauticform-row mauticform-text mauticform-required" data-validate="4__5_" data-validation-type="captcha" id="mauticform_contactus_4__5_">
                                                <label class="col-md-3 mauticform-label" for="mauticform_input_contactus_4__5_" id="mauticform_label_contactus_4__5_">4 + 5 = ?</label> <input class="col-md-9 mauticform-input" id="mauticform_input_contactus_4__5_" name="mauticform[4__5_]" type="text" value=""> <span class="mauticform-errormsg" style="display: none;">This is required.</span>
                                            </div><br>
                                            
                                            <input id="mauticform_contactus_id" name="mauticform[formId]" type="hidden" value="6"> <input id="mauticform_contactus_return" name="mauticform[return]" type="hidden" value=""> <input id="mauticform_contactus_name" name="mauticform[formName]" type="hidden" value="contactus">
                                        </div><input id="mauticform_contactus_messenger" name="mauticform[messenger]" type="hidden" value="1">
                                        <br>
                                            <div class="mauticform-row mauticform-button-wrapper package-text-container" id="mauticform_contactus_submit">
                                                <button class="contact-us" id="mauticform_input_contactus_submit" name="submit" type="submit">Submit</button>
                                            </div><br>
                                            <br>
                                    </form>
                                </div>

							</div>
						</div>
					</div>
				</div>
            </div><!-- End .contact-us -->
                    
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