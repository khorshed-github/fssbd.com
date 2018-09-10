<?php 
	include("config/dbconnect.php");
	echo $rid = $_POST['typeid'];
	exit;
	$sql = mysqli_query($con,"SELECT distinct(room_type_id), room_type_title FROM booking_search WHERE room_type_id='$rid'");
	while($res = mysqli_fetch_array($sql)){
	?>
	<option value="<?php echo $res['room_type_id'];?>"><?php echo $res['room_type_title'];?></option>
	<?php
		}
?>