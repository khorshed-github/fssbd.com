<ul>
	<!-- FADE -->
	<?php
		$sfid = $_GET['sfid'];
		$sql = mysqli_query($con,"SELECT * FROM facilities_slider WHERE facilities_id='$sfid'");
		while($row = mysqli_fetch_array($sql)){
	?>
	<li data-transition="fade" data-slotamount="10" data-thumb="cp/images/facilities_slider/<?php echo $row['image'];?>">
		<img src="cp/images/facilities_slider/<?php echo $row['image'];?>" alt="<?php echo $row['title'];?>"/>
	</li>
	<?php
	}
	?>
</ul>