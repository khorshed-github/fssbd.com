<?php 
	include("config/dbconnect.php");	
	$sqlr = mysqli_query($con,"SELECT id,room_type_id,room_type_title FROM booking_search WHERE id='".$_POST['typeid']."'");
	while($resr = mysqli_fetch_array($sqlr)){
	?>	
	<option value="<?php echo $resr['room_type_id'];?>"><?php echo $resr['room_type_title'];?></option>
	<?php
	}
?>