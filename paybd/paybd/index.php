<?php include 'inc/header.php';?>
	
	<div class="container-fluid">
	
		<div class="box">
			<div class="row">
				<div class="col-md-1 noticeBoard">
					<p>Notice: </p>
				</div>
            <?php
                $query="select autoId,noticeName from tbnoticeinfo";
                $selectData=$db->select($query);
                if($selectData)
                {
                    while($result=$selectData->fetch_assoc())
                    {

                ?>
				<div class="col-md-8 noticeBoard">
					<marquee behavior="left" direction="">
						<p><?php echo $result['noticeName']; ?></p>
					</marquee>
				</div>
            <?php 
                   }
                }
            ?>
				<div class="col-md-3">
					<img style="height:70px; width:280px;padding-top:8px;padding-right3px;" src="assets/images/ads/placeYourAdHear.gif" alt="Advertise With Us 70x280">
				</div>
			</div>
		</div>
		<div class="clear"></div>
		<div class="row">
			<div class="col-md-9">
                <div class="box">
                    <div class="clear">	</div>
                    <div class="radio">
                    	<label>
                            <label class="radio-inline">
                                <input type="radio" name="optradio" checked>Buy
                            </label>
                            <label class="radio-inline">
                                <input type="radio" name="optradio">Sell
                            </label>
                    	</label>
                    </div>

                    <form action="" method="POST" class="form-inline" role="form">
                    	<div class="form-group">
                            <select name="selectSend" id="selectIdSend" class="form-control">
                                <?php
                                $query="select autoId, vCurrencyName, image from tbcurrencyinfo order by vCurrencyName";
                                $selectData=$db->select($query);
                                if($selectData)
                                {
                                    while($result=$selectData->fetch_assoc())
                                    {
                                        ?>
                                        <option value="<?php echo $result['autoId']?>"><?php echo $result['vCurrencyName']?></option>
                                        <?php
                                    }
                                }
                                ?>

                            </select>

                    		<input type="text" class="form-control" name="vSendAmount" id="" placeholder="SEND">

                            <select name="selectReceive" id="selectIdReceive" class="form-control">
                                <?php
                                $query="select autoId, vCurrencyName, image from tbcurrencyinfo order by vCurrencyName";
                                $selectData=$db->select($query);
                                if($selectData)
                                {
                                    while($result=$selectData->fetch_assoc())
                                    {
                                        ?>
                                        <option value="<?php echo $result['autoId']?>"><?php echo $result['vCurrencyName']?></option>
                                        <?php
                                    }
                                }
                                ?>
                            </select>

                            <input type="text" class="form-control" name="vReceiveAmount" id="inputReceive" placeholder="RECEIVE" readonly>

                            <button type="submit" class="btn btn-primary">Exchange</button>
                            
                    	</div>
                        <div>
                            <label>Exchange rate: 1 BDT = 1 BTD </label>
                            <label style="margin-top: 2%;">&nbsp;&nbsp;&nbsp; Reserve: 1 BTD</label>
                        </div>
                    </form>

                    <div class="clear">	</div>

                </div>




				<!--<div class="box">
					<form id="bit_exchange_form">
						<div class="col-md-6">
							<div class="row">
								<div class="col-md-3 hidden-xs hidden-sm">
									<div style="margin-top:50px;">
										<img src="assets/images/icons/Bitcoin.png" id="bit_image_send" width="72px" height="72px" class="img-circle img-bordered">
									</div>
								</div>
								<div class="col-md-9">
									<h3><i class="fa fa-arrow-up"></i> Send</h3>
									<div class="form-group">
										<select class="form-control form_style_1 input-lg" id="bit_gateway_send" name="bit_gateway_send" onchange="bit_refresh('1');">
											<option value="7" >Skrill. USD</option>
											<option value="8" >Neteller. USD</option>
											<option value="9" >Perfect Money. USD</option>
											<option value="10" >Payeer. USD</option>
											<option value="11" >Bkash Agent BDT</option>
											<option value="14" selected>bKash Personal BDT</option>
											<option value="15" >Rocket Personal BDT</option>
											<option value="23" >Coinbase BTC USD</option>
											<option value="24" >Coinbase ETH USD</option>
											<option value="25" >Coinbase LTC USD</option>
											<option value="26" >Coinbase BCH USD</option>						
										</select>
									</div>
									<div class="form-group">
										<input type="text" class="form-control form_style_1 input-lg" id="bit_amount_send" name="bit_amount_send" value="0" onkeyup="bit_calculator();" onkeydown="bit_calculator();">
									</div>
									<div class="text text-muted pull-right" style="padding-bottom:10px;font-weight:bold;">Exchange rate: <span id="bit_exchange_rate">-</span></div>
								</div>
							</div>
						</div>
						<div class="col-md-6">
							<div class="row">
								<div class="col-md-9">
									<h3><i class="fa fa-arrow-down"></i> Receive</h3>
									<div class="form-group">
										<select class="form-control form_style_1 input-lg" id="bit_gateway_receive" name="bit_gateway_receive"  onchange="bit_refresh('2');">
											<option value="7" >Skrill. USD</option>
											<option value="8" >Neteller. USD</option>
											<option value="9" selected>Perfect Money. USD</option>
											<option value="10" >Payeer. USD</option>
											<option value="14" >bKash Personal BDT</option>
											<option value="15" >Rocket Personal BDT</option>
											<option value="20" >Payza. USD</option>
											<option value="21" >WebMoney. USD</option>
											<option value="22" >PayPal. USD</option>
											<option value="23" >Coinbase BTC USD</option>
											<option value="27" >Payoneer. USD</option>	
										</select>
									</div>
									<div class="form-group">
										<input type="text" class="form-control form_style_1 input-lg" id="bit_amount_receive" name="bit_amount_receive" disabled value="0">
									</div>
									<div class="text text-muted" style="padding-bottom:10px;font-weight:bold;">Reserve: <span id="bit_reserve">-</span></div>
								</div>
								<div class="col-md-3 hidden-xs hidden-sm">
									<div style="margin-top:50px;">
										<img src="assets/images/icons/Skrill.png" id="bit_image_receive" width="72px" height="72px" class="img-circle img-bordered">
									</div>
								</div>
							</div>
						</div>
						<div class="col-md-12">
							<input type="hidden" name="bit_amount_receive" id="bit_amount_receive2">
							<input type="hidden" name="bit_rate_from" id="bit_rate_from">
							<input type="hidden" name="bit_rate_to" id="bit_rate_to">
							<input type="hidden" name="bit_currency_from" id="bit_currency_from">
							<input type="hidden" name="bit_currency_to" id="bit_currency_to">
							<input type="hidden" id="bit_login_to_exchange" name="bit_login_to_exchange" value="1">
							<input type="hidden" id="bit_ses_uid" name="bit_ses_uid" value="0">
							<center>
								<button type="button" class="btn btn-primary btn-lg"  onclick="bit_exchange_step_1();">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<i class="fa fa-refresh"></i> Exchange&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</button>
							</center>
						</div>
					</form>	
				</div>-->






                <div class="clear">	</div>

                <!--Letest Exchange Start-->
				<div class="box">
					<div class="col-md-12 text-center">
						<h2>Letest Exchange</h2>
					</div>
					<div class="col-md-12">
						<!--<div class="row">-->
                    <!--<div class="col-md-8">-->
                    <table class="table table-striped table-hover table-bordered">
					 <thead>
						<tr>
							<th class="text-center">Send <i class="fa fa-arrow-up"></i></th>
							<th class="text-center">Receive <i class="fa fa-arrow-down"></i></th>
							<th class="text-center">Amount</th>

							<th class="text-center">Username</th>
							<th class="text-center">Date</th>
							<th class="text-center">Status</th>
						  </tr>
					</thead>
						  <tbody>
							   <tr>
									<td><img src="assets/images/icons/Bitcoin.png" width="30px" height="30">  </td>
									<td><img src="assets/images/icons/Dogecoin.png" width="30px" height="30"> </td>
									<td>60 USD</td>
									<td>mirazul704</td>
									<td><span>21/06/2018</span></td>
									<td><span class="label label-success"><i class="fa fa-check"></i> Processed</span></td>
								</tr>
								<tr>
									<td><img src="assets/images/icons/Dogecoin.png" width="30px" height="30">  </td>
									<td><img src="assets/images/icons/Dogecoin.png" width="30px" height="30"> </td>
									<td>3000 BDT</td>

									<td>esysbd</td>
									<td><span>21/06/2018</span></td>
									<td><span class="label label-warning"><i class="fa fa-clock-o"></i> Awaiting Confirmation</span></td>
								</tr>
								<tr>
									<td><img src="assets/images/icons/Dogecoin.png" width="30px" height="30">  </td>
									<td><img src="assets/images/icons/Dogecoin.png" width="30px" height="30"> </td>
									<td>1200 BDT</td>
									<td>ShibliMoon</td>
									<td><span>21/06/2018</span></td>
									<td><span class="label label-warning"><i class="fa fa-clock-o"></i> Awaiting Payment</span></td>
								</tr>
							 </tbody>
						 </table>
						<!--</div>-->
					   <!--</div>-->
					</div>
				</div>
				<!--Letest Exchange End-->
				
				<div class="clear text-center">
                    <img src="assets/images/ads/adv728x90.png" alt="adv">
                </div>

				<!--Testimonials Start-->
				<div class="box">
					<div class="col-md-12 text-center">
						<h2>Testimonial</h2>
					</div>
					<div class="col-md-12">
					  <div class="carousel slide" data-ride="carousel" id="quote-carousel">
						<!-- Bottom Carousel Indicators -->
						<ol class="carousel-indicators">
						  <li data-target="#quote-carousel" data-slide-to="0" class="active"></li>
						  <li data-target="#quote-carousel" data-slide-to="1"></li>
						  <li data-target="#quote-carousel" data-slide-to="2"></li>
						</ol>

						<!-- Carousel Slides / Quotes -->
						<div class="carousel-inner">
                          
                        <?php
                            $query="select autoId,userId,comment,image from tbtestimonial limit 3";
                            $selectData=$db->select($query);
                            if($selectData)
                            {
                                $i=0;
                                $active="";
                                while($result=$selectData->fetch_assoc())
                                {
                                    if($i==0)
                                    {
                                        $active="active";
                                    }
                                    else{
                                        $active="";
                                    }
                        ?>
                        <div class="item <?php echo $active; ?>">
							<blockquote>
							  <div class="row">
								<div class="col-sm-2 text-center">
								  <img class="img-circle" src="assets/images/user/<?php echo $result['image'];?>" style="width: 100px;height:100px;">
								</div>
								<div class="col-sm-10">
								  <p><?php echo $result['comment'];?></p>
								  <small><?php echo $result['userId'];?></small>
								</div>
							  </div>
							</blockquote>
						 </div>
                        <?php 
                            $i++;
                                }
                            }
                        ?>						  
						</div>

						<!-- Carousel Buttons Next/Prev -->
						<a data-slide="prev" href="#quote-carousel" class="left carousel-control"><i class="fa fa-chevron-left"></i></a>
						<a data-slide="next" href="#quote-carousel" class="right carousel-control"><i class="fa fa-chevron-right"></i></a>
					  </div>                          
					</div>
				</div>
				<!--Testimonials End-->
				
				<div class="clear"></div>
				
				<!--Our Coustomer Info Start-->
				<!--slideanim-->
				<div class="box slideanim">
					<div class="col-md-12 text-center">
						<h2>Our Happy Client</h2>
					</div>
					<div class="col-md-12 counter" id="counter">
							<div class="main_counter_area">
								<div class="overlay p-y-3">
									<div class="main_counter_content text-center white-text wow fadeInUp">
										<div class="col-md-3 ">
											<div class="single_counter p-y-2 m-t-1">
												<i class="fa fa-users m-b-1"></i>
												<h2 class="statistic-counter">100</h2>
												<p>Total Client</p>
											</div>
										</div>
										<div class="col-md-3">
											<div class="single_counter p-y-2 m-t-1">
												<i class="fa fa-arrow-down m-b-1"></i>
												<h2 class="statistic-counter">400</h2>
												<p>Total Send</p>
											</div>
										</div>
										<div class="col-md-3">
											<div class="single_counter p-y-2 m-t-1">
												<i class="fa fa-arrow-up m-b-1"></i>
												<h2 class="statistic-counter">312</h2>
												<p>Total Receive</p>
											</div>
										</div>
										<div class="col-md-3">
											<div class="single_counter p-y-2 m-t-1">
												<i class="fa fa-database m-b-1"></i>
												<h2 class="statistic-counter">480</h2>
												<p>Total Reserve</p>
											</div>
										</div>
									</div>
								</div>
							</div>
					</div>
				</div>
				<!--Our Coustomer Info End-->
				
			</div>
			<div class="col-md-3">
				<div class="box">
					<div class='col-md-12 text-center'>
						<h2>Track exchange</h2>
					</div>
					<div class='col-md-12 text-center'>
						<input type="text" class="form-control form_style_1 input-lg" id="bit_amount_receive" name="bit_amount_receive" placeholder="Type hear exchange id">
					</div>
					<div class="col-md-12 text-center"></div>
					<div class='col-md-12 text-center'>
						<button type="button" style="margin-top:5px;" class="btn btn-primary btn-lg">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<i class="fa fa-refresh"></i> Track&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</button>
					</div>
				</div>
				
				<div class="clear">	</div>
				
				<div class="box">
					<div class="row">
						<div class='col-md-12 text-center'>
						    <h2>Our Reserve</h2>
						</div>
                        <?php
                        $query="select image,vCurrencyName,dblAmount from tbcurrencyinfo a inner join tbcurrencyreserve b on a.autoId=b.iCurrencyId order by vCurrencyName";
                        $selectData=$db->select($query);
                        if($selectData)
                        {
                            while($result=$selectData->fetch_assoc())
                            {
                         ?>
						<div class="col-md-12" style="margin-bottom:10px; margin-left:10%; border-bottom: 1px solid #f5f5f5;">
							<img src="admin/<?php echo $result['image']?>" width="42px" height="42px" class="img-circle img-bordered pull-left">
							<span class="pull-left" style="margin-left:5px;">
								<span style="font-size:15px;font-weight:bold;"><?php echo $result['vCurrencyName']?></span><br/>
								<span class="text text-muted" style=" float: left;"><?php echo $result['dblAmount']?> </span>
							</span>
						</div>
						
						<br><br>
                                <?php
                            }
                         }
                         ?>
					</div>
				</div>
				
				<div class="clear"></div>
				
				<div class="box">
					<div class="row">
						<div class="col-md-12">
							<img style="height:300px; width:250px;padding-top:8px;" src="assets/images/ads/advertiseWithUs.gif" alt="Advertise With Us">
						</div>
					</div>
				</div>
			</div>
		</div>
	</div>



<?php include 'inc/footer.php';?>