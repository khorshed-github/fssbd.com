<div class="box-booking booking-inline">
	<form id="formElem" name="formElem" action="booking-details.php" method="post">
		<div class="form-group">
			<label class="label-control"><strong>Check-in date</strong></label>
			<div class="booking-form select-black">								
				<label class="collapse input">				
					<input type="date" onchange="datechack(this.value);" name="check_in" id="check_in" class="input-control border-black" required />			
				</label>
			</div>
		</div>		
		<div class="form-group">
			<label class="label-control"><strong>Check-out date</strong></label>
			<div class="booking-form select-black">			
				<label class="collapse input">
					<input type="date" onchange="datechack(this.value);" name="check_out" id="check_out" class="input-control border-black" required />
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
					<select class="form-select" name="roomType" id="roomType" onchange="datechack(this.value);" required />
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
					<?php
						/* include("config/odbc-test.php");
						echo $sql="select roomId,roomName from tbRoomInfo where isActive='1' and typeId='".$bngType."' and roomName not in (select bookingRoomId from tbBookingSetup where roomTypeId='".$bngType."' and status in ('Book','CheckIn') and ('".$check_in."' between convert(date,checkInDate,105) and convert(date,checkOutDate,105)  or '".$check_out."' between convert(date,checkInDate,105) and convert(date,checkOutDate,105))) or roomName in (select bookingRoomId from tbBookingSetup where roomTypeId='".$bngType."' and status in ('Book','CheckIn')  and ('".$check_in."' between convert(date,checkOutDate,105) and convert(date,checkOutDate,105)))"; */?>
			<div class="input-group select-black">
				<label class="collapse">
					<select class="form-select" name="roomNo" id="roomId" required />	
					
						<!-- load ajax data -->
						
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
<!--
<script type="text/javascript">
	function datechack(){
		var startDate = document.getElementById("check_in").value;
		console.log(startDate);
		var endDate = document.getElementById("check_out").value;
		var bngType = document.getElementById("roomType").value;
	<?php 
		$startDate = "<script>document.write(startDate)</script>";			
		$endDate = "<script>document.write(endDate)</script>"; 
		echo $check_in = date("Y-m-d",strtotime($startDate));
		echo $check_out = date("Y-m-d",strtotime($endDate));
		echo $bngType = "<script>document.write(bngType)</script>";
	?> 		
	}	
</script>
-->
<script type="text/javascript"> 
		function datechack(){	
				var startDate = document.getElementById("check_in").value;
				var endDate = document.getElementById("check_out").value;
				var bngType = document.getElementById("roomType").value;
			$.ajax({				
				type: "POST",
				url: "getRoomType.php",
				data: {'rmtype':bngType, 'checkin':startDate, 'checkout':endDate},				
				success: function(data){
					$("#roomId").html(data);
				}
			});
		}
</script>
<!-- Room Type Check 
<script type="text/javascript"> 
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
-->