<?php 
	$sqlf = mysqli_query($con,"SELECT * FROM facilities");
	while($rowf = mysqli_fetch_array($sqlf)){
?>
<div class="item">
	<img src="cp/images/facilities/<?php echo $rowf['image'];?>" alt="<?php echo $rowf['title'];?>">
	<div class="services-carousel-container">
			<div class="customNavigation">
			  <a class="btn prev"></a>
			  <a class="btn next"></a>
			</div>
			<p class="glance-item-name"><?php echo $rowf['title'];?></p>
			<!-- <p class="sub-header">Discover Your Luxurious EXPERIENCE</p> -->

			<p class="detail">
				<?php echo $rowf['description'];?>
			</p>
		<?php if(!empty($rowf['identy'])){
			
		?>
			<a href="rooms-and-suites.php?sfid=<?php echo $rowf['id'];?>" class="find has_transition_400">Find More</a>
		<?php }else{
			?>
			<a href="others-facilities-pages.php?sfid=<?php echo $rowf['id'];?>" class="find has_transition_400">Find More</a>
			<?php
			}
			?>
	</div><!-- END .services-carousel-container -->
</div><!-- END .item -->
<?php
	}
?>