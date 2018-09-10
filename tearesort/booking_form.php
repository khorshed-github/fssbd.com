<div class="box-booking booking-inline">
	<form id="formElem" name="formElem" action="booking-details.php" method="post">
		<div class="form-group">
			<label class="label-control"><strong>Arrival Date</strong></label>
			<div class="booking-form select-black">
				<label class="collapse input">
					<input type="text" name="check_in" id="arrival-date" class="input-control border-black" required />
				</label>
			</div>
		</div>
		<div class="form-group">
			<label class="label-control"><strong>Departure Date</strong></label>
			<div class="booking-form select-black">
				<label class="collapse input">
					<input type="text" name="check_out" id="departure-date" class="input-control border-black" required />
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
			<label class="label-control"><strong>Room Type</strong></label>
			<div class="input-group select-black">
				<label class="collapse">
					<select class="form-select" id="roomType" name="roomType" required />	
							<!-- Show Room Type Get Ajax Value -->
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
