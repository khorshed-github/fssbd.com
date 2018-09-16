<div class="box-booking booking-inline">
	<form id="formElem" name="formElem" action="booking-details.php" method="post">
		<div class="form-group">
			<label class="label-control"><strong>Arrival Date</strong></label>
			<div class="booking-form select-black">								
				<label class="collapse input">				
					<input type="date" name="check_in" class="input-control border-black" required />			
				</label>
			</div>
		</div>
		<div class="form-group">
			<label class="label-control"><strong>Departure Date</strong></label>
			<div class="booking-form select-black">			
				<label class="collapse input">
					<input type="date" name="check_out" class="input-control border-black" required />
				</label>
			</div>
		</div>
		<div class="form-group select">
			<label class="label-control"><strong>Adults</strong></label>
			<div class="input-group select-black">
				<label class="collapse">
					<select onchange="getRoomType(this.value);" class="form-select" id="adult" name="adult" required>
						<?php 
						$sqlGest = mysqli_query($con,"SELECT adult_gest FROM booking_search");
						while($resGest = mysqli_fetch_array($sqlGest)){
						?>
						<option value="<?php echo $resGest['adult_gest'];?>"><?php echo $resGest['adult_gest'];?>
						</option>
						<?php
							}
						?>
					</select>
				</label>
			</div>
		</div>
		<div class="form-group select">
			<label class="label-control"><strong>Children</strong></label>
			<div class="input-group select-black">
				<label class="collapse">
					<select class="form-select" id="child" name="child" required />
						<option value="0">0</option>
						<option value="1">1</option>
						<option value="2" selected>2</option>
					</select>
				</label>
			</div>
		</div>
		<div class="form-group">			
			<label class="label-control"><strong>Bungalow Type</strong></label>
			<div class="input-group select-black">
				<label class="collapse">
					<select class="form-select" name="roomType" required />
						 <option value=""></option>
							<?php
						include("config/odbc-test.php");
							$sql1 = "select roomTypeId,roomType from tbRoomType";
							$rs=odbc_exec($conn,$sql1);
							if (!$rs)
							  {echo "Error in SQL Connection";}
							
							while (odbc_fetch_row($rs))
							{
							  $rmTid=odbc_result($rs,"roomTypeId");
							  $rmTname=odbc_result($rs,"roomType");
							  echo "<tr><td></td>";
							   ?>						 							 
							  <option value="<?php echo $rmTid;?>"><?php echo $rmTname;?></option>							 
							<?
							}
							odbc_close($conn);			
						?>
							
					</select>
				</label>
			</div>
		</div>
		
		<div class="form-group">			
			<label class="label-control"><strong>Bungalow No</strong></label>
			<div class="input-group select-black">
				<label class="collapse">
					<select class="form-select" name="roomNo" required />	
					<?php
						include("config/odbc-test.php");
						$sql="select roomId,roomName from tbRoomInfo where isActive='1' and typeId='2' and roomName not in (select bookingRoomId from tbBookingSetup where roomTypeId='2' and status in ('Book','CheckIn') and ('2018-09-16' between convert(date,checkInDate,105) and convert(date,checkOutDate,105)  or '2018-09-17' between convert(date,checkInDate,105) and convert(date,checkOutDate,105))) or roomName in (select bookingRoomId from tbBookingSetup where roomTypeId='2' and status in ('Book','CheckIn')  and ('2018-09-16' between convert(date,checkOutDate,105) and convert(date,checkOutDate,105)))";
							$rs=odbc_exec($conn,$sql);
							if (!$rs)
							  {echo "Error in SQL Connection";}
							
							while (odbc_fetch_row($rs))
							{
							  $rmid=odbc_result($rs,"roomName");
							
							   ?>
							  <option value="1"><?php echo $rmid;?></option>							 
							<?
							}
							odbc_close($conn);			
						?>
							
					</select>
				</label>
			</div>
		</div>	
		
		<div class="form-group last">
		<label class="label-control"></label>
		<button id="submit-fomr" name="booking" type="submit" class="btn btn-large btn-darkbrown">Book now</button>
		</div>
	</form>
</div>
<script type="text/javascript"> <!-- Email / Existing Client Check -->
		function getRoomType(val){	
			$.ajax({
				type: "POST",
				url: "getRoomType.php",
				data: 'typeid='+val,
				success: function(data){
					$("#roomType").html(data);
				}
			});
		}
</script>