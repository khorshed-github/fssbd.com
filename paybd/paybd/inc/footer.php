
		<div class="clear"></div>
		<section id="footer">
		<div class="container-fluid">
			<div class="row">
			<div class="container">
				<div class="col-xs-12 col-sm-12 col-md-4 col-lg-4 footerRightBorder">
					<p class="headerText">Quick links</p>
					<ul class="list-unstyled quick-links">
						<li><a href="index.php"><i class="fa fa-angle-double-right"></i>Home</a></li>
						<li><a href="testimonials.php"><i class="fa fa-angle-double-right"></i>Testimonials</a></li>
						<li><a href="about.php"><i class="fa fa-angle-double-right"></i>About</a></li>
						<li><a href="contact.php"><i class="fa fa-angle-double-right"></i>Contact</a></li>
						<li><a href="faq.php"><i class="fa fa-angle-double-right"></i>FAQ</a></li>
					</ul>
				</div>
				<div class="col-xs-12 col-sm-12 col-md-4 col-lg-4 footerRightBorder">
					<p class="headerText">Contact Info</p>
					<ul class="list-unstyled quick-links" style="color: #eeeeee;">
					<?php
						$query="select companyName,email,mobile,officeAddress from tbcompanyinfo";
						$selectData=$db->select($query);
						if($selectData)
						{
							while($result=$selectData->fetch_assoc())
							{

						?>
							<li><i class="fa fa-phone"></i> <?php echo $result['mobile']; ?></li>
							<li><i class="fa fa-envelope"></i> <?php echo $result['email']; ?></li>
							<li><i class="fa fa-home"></i> <?php echo $result['officeAddress']; ?></li>
					   <?php 
						}
						}
					?>
					</ul>
				</div>
				<div class="col-xs-12 col-sm-12 col-md-4 col-lg-4">
					<p class="headerText">Payment Allowance</p>
					<img style="height:110px; width:290px;padding-top:8px;padding-right3px;" src="assets/images/cardpay.jpg" alt="Payment">
					<br>
					<br>
					<?php
						$query="select youtube,facebook,twiter,instagram from tbsocialinfo";
						$selectData=$db->select($query);
						if($selectData)
						{
							while($result=$selectData->fetch_assoc())
							{

						?>
						<ul class="list-unstyled list-inline social">
							<li class="list-inline-item"><a href="<?php echo $result['facebook']; ?>" target="_blank"><i class="fa fa-facebook"></i></a></li>
							<li class="list-inline-item"><a href="<?php echo $result['twiter']; ?>" target="_blank"><i class="fa fa-twitter"></i></a></li>
							<li class="list-inline-item"><a href="<?php echo $result['instagram']; ?>" target="_blank"><i class="fa fa-instagram"></i></a></li>
							<li class="list-inline-item"><a href="<?php echo $result['youtube']; ?>" target="_blank"><i class="fa fa-youtube"></i></a></li>
							<!--<li class="list-inline-item"><a href="index.php" target="_blank"><i class="fa fa-envelope"></i></a></li>-->
						</ul>
					<?php 
						}
						}
					?>
				</div>
				</div>
			</div>
			<!--<div class="row">
				<div class="col-xs-12 col-sm-12 col-md-12 mt-2 mt-sm-5">
					
				</div>
			</div>-->
		</div>
		</section>

		
		<footer class="container-fluid text-center">
	  		<a href="#myPage" title="To Top">
				<span class="glyphicon glyphicon-chevron-up"></span>
			</a>
		  	<p>Developed By: <a href="http://www.codinghelpbd.com">CodingHelpBD.com</a></p>
		</footer>
		
		<script>
			$(document).ready(function(){
  				
				/*Fix Navigation*/
			
				var prevScrollpos = window.pageYOffset;
				window.onscroll = function() {
				var currentScrollPos = window.pageYOffset;
				  if (prevScrollpos > currentScrollPos) {
					document.getElementById("navFix").style.top = "0";
				  } else {
					document.getElementById("navFix").style.top = "-50px";
				  }
				  prevScrollpos = currentScrollPos;
				}

				/*Fix Navigation*/

				
				/*Scroll to Top*/
				// Add smooth scrolling to all links in navbar + footer link
				$(".navbar a, footer a[href='#myPage']").on('click', function(event) {
				// Make sure this.hash has a value before overriding default behavior
				if (this.hash !== "") {
				  // Prevent default anchor click behavior
				  event.preventDefault();
				  // Store hash
				  var hash = this.hash;

				  // Using jQuery's animate() method to add smooth page scroll
				  // The optional number (900) specifies the number of milliseconds it takes to scroll to the specified area
				  $('html, body').animate({
					scrollTop: $(hash).offset().top
				  }, 900, function(){

					// Add hash (#) to URL when done scrolling (default click behavior)
					window.location.hash = hash;
				  });
				} // End if
				});
				/*Scroll to Top*/


				/*Scroll Animation*/
				  $(window).scroll(function() {
					$(".slideanim").each(function(){
					  var pos = $(this).offset().top;

					  var winTop = $(window).scrollTop();
						if (pos < winTop + 600) {
						  $(this).addClass("slide");
						}
					});
				  });
				/*Scroll Animation*/
			})
			
			/**/
			/*jQuery('.statistic-counter').counterUp({
                delay: 10,
                time: 2000
            });*/
			
		</script>

	</body>
</html>