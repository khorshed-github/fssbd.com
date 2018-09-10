<ul>
	<!-- FADE -->
	<?php
		$sql = mysqli_query($con,"SELECT * FROM slider");
		while($row = mysqli_fetch_array($sql)){
	?>
	<li data-transition="fade" data-slotamount="10" data-thumb="cp/images/slider/<?php echo $row['image'];?>">
		<img src="cp/images/slider/<?php echo $row['image'];?>" alt="<?php echo $row['title'];?>"/>
	</li>
	<?php
	}
	?>
</ul>