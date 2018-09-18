<?php 
	include("config/odbc-test.php");	
	$bngType = $_POST['rmtype'];
	$check_in = date("Y-m-d",strtotime($_POST['checkin']));
	$check_out = date("Y-m-d",strtotime($_POST['checkout']));
	
	$sql="select roomId,roomName from tbRoomInfo where isActive='1' and typeId='".$bngType."' and roomName not in (select bookingRoomId from tbBookingSetup where roomTypeId='".$bngType."' and status in ('Book','CheckIn') and ('".$check_in."' between convert(date,checkInDate,105) and convert(date,checkOutDate,105)  or '".$check_out."' between convert(date,checkInDate,105) and convert(date,checkOutDate,105))) or roomName in (select bookingRoomId from tbBookingSetup where roomTypeId='".$bngType."' and status in ('Book','CheckIn')  and ('".$check_in."' between convert(date,checkOutDate,105) and convert(date,checkOutDate,105)))";
	$rs=odbc_exec($conn,$sql);
		if (!$rs)
		  {echo "Error in SQL Connection";}			
		while (odbc_fetch_row($rs))
		{
		$rmid=odbc_result($rs,"roomName");
		if(odbc_num_rows($rs)>0){	 							
		   ?>
		  <option value="1"><?php echo $rmid;?></option>	
		<?php
			}else{
				?>
				 <option value="">No Availabe Bungalow.</option>
				<?
			}
		}
		odbc_close($conn);	
	?>