 <div>
	<a href="javascript:;" class="showBook"></a>
	<a href="javascript:;" class="showMenu"></a>
</div>

<div>
	<ul id="custom-main-nav">
		<li class="  nav-1494"><a href="index.php">Home</a><hr></li>
		
		<?php 
			$sqlf = mysqli_query($con,"SELECT * FROM facilities");
			while($rowf = mysqli_fetch_array($sqlf)){
			if(!empty($rowf['identy'])){			
		?>
		<li class="  nav-1743">
			<a href="rooms-and-suites.php?sfid=<?php echo $rowf['id'];?>" class="find has_transition_400"><?php echo $rowf['title'];?></a><hr></li>
		<?php }else{
			?>
			<li class="  nav-1743">
			<a href="others-facilities-pages.php?sfid=<?php echo $rowf['id'];?>" class="find has_transition_400"><?php echo $rowf['title'];?></a><hr></li>
			<?php
			}			
		}
		?>
		<li class="  nav-1747"><a href="spacial-offer.php">
		Special Offers</a><hr></li>
		
		<li class="  nav-1747"><a href="meetings-and-events.php">
		Meetings & Events</a><hr></li>
		
		<li class="  nav-1749"><a href="photo-gallery.php">
		Photo Gallery</a><hr></li>
		
		<li class="  nav-1749"><a href="contact-us.php">
		Contact Us</a><hr></li>	
		
		<li class="  nav-1749"><a href="#">
		Virtual Tours</a></li>
	</ul>

	<!--<img src="images/icons/luxury-awards2014.png" class="custom-img">-->

	<ul class="guest-policy-ul">
		<li class=" ">
			<a href="guest-policy.html">Guest Policy</a>
		</li>
		<li class="">
			<a href="#" target="_blank">TEA RESORT & MUSEUM SURVEY</a>
		</li>
	</ul>

	<ul class="contacts" style="display: none;">
		<li>
			<a href="#" class="icon tel">Contact</a>
		</li>
		<li>
			<a href="mailto:tearesort@yahoo.com" class="icon email">E-Mail</a>
		</li>
		<li>
			<a href="#" class="icon map">Location</a>
		</li>
	</ul>
	<ul>
		<li style="border-bottom: none;">
			<a href="javascript:;" class="selected">
				Reservation
			</a>
			<div>
				<fieldset class="flat booking booking-1">
					<p>
						You can make confirmed booking with online payment by your credit or debit card. <br><br>
						Enjoy 50% discount on room rack rate.
					</p>
					<p class="accept">We Accept
					<img src="images/cards.png"></p>
					<div class="input-submit">
						<a href="booking.php" class="normal-link">Book Online</a>
					</div>
					<p class="small">For more information:<br> +88 01712 071502</p>
				</fieldset>
			</div>
		</li>		
	</ul>
</div>