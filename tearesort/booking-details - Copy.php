<?php
error_reporting(0);
include("config/dbconnect.php");
?>
<!doctype html>
<html lang="en">
<head>
		<title>Online Booking Process || Tea Resort & Museum</title>
		<?php require("components/head.php"); ?>
	<!-- Jquery UI CSS   -->
	<link rel="stylesheet" type="text/css" href="css/style.css">	
    </head>

    <body>
        <div id="perspective">
            <div id="container">
                <div id="top">
                   <?php require("components/header.php");?>
                </div><!-- END #top -->

                <div id="wrapper">
                    <div id="menu_upper">
                        <ul class="contact-ul">
                            <li><a href="tel:+88 01712071502"> +88 01712 071502</a></li>
                        </ul>
                    </div>
                    <div class="quick_socials mobile_hidden">
                       <?php require("components/socialLink.php");?>
                    </div> 
					
		<div class="home-landing scrollable booking"><!--Booking Search -->
			<img src="cp/images/slider/13507_home-banner1.jpg" alt="Tea Resort & Museum"/>
        </div><!-- END .Booking Search -->
		
		<div class="background-radius"></div>
        <a id="style-logo" href="#">Tea Resort &amp; Museum</a>
		
		
		<div class="offers-page" style="background:#f5f5f5;"><!--Booking Details -->
            <div class="container offer-container">
                
				<div class="row"> 
					<div class="col-md-12">
						<div class="welcome-text-div">
							<h1>Booking Details</h1>
							<img class="dot-square" src="images/icons/line-small.png" alt="special offers">
						</div>
					</div>
				</div>
		
                <div class="container">
                        <div class="row">
                            <div class="col-12">
							
							
							<section class="row row-shoping clearfix">
							<div class="row-room clearfix">
								<table cellpadding="4" cellspacing="1" border="0" width="100%" bgcolor="#FFFFFF" style="font-size:13px;">
   <tr>
    <td bgcolor="#f2f2f2" align="center"><strong><?=CHECKIN_DATE_TEXT?></strong></td>
    <td bgcolor="#f2f2f2" align="center"><strong><?=CHECKOUT_DATE_TEXT?></strong></td>
    <td bgcolor="#f2f2f2" align="center"><strong><?=TOTAL_NIGHT_TEXT?></strong></td>
    <td bgcolor="#f2f2f2" align="center"><strong><?=TOTAL_ROOMS_TEXT?></strong></td>
   </tr>
   <tr>
    <td align="center" bgcolor="#f5f9f9"><?=$bsibooking->checkInDate?></td>
    <td align="center" bgcolor="#f5f9f9"><?=$bsibooking->checkOutDate?></td>
    <td align="center" bgcolor="#f5f9f9"><?=$bsibooking->nightCount?></td>
    <td align="center" bgcolor="#f5f9f9"><?=$bsibooking->totalRoomCount?></td>
   </tr>
   <tr>
    <td bgcolor="#f2f2f2" align="center"><strong><?=NUMBER_OF_ROOM_TEXT?></strong></td>
    <td bgcolor="#f2f2f2" align="center"><strong><?=ROOM_TYPE_TEXT?></strong></td>
    <td bgcolor="#f2f2f2" align="center"><strong><?=MAXI_OCCUPENCY_TEXT?></strong></td>
    <td bgcolor="#f2f2f2" align="right" style="padding-right:5px;"><strong><?=GROSS_TOTAL_TEXT?></strong></td>
   </tr>
   <?php		
		foreach($bookingDetails as $bookings){		
			echo '<tr>';
			echo '<td align="center" bgcolor="#f5f9f9">'.$bookings['roomno'].'</td>';
			echo '<td align="center" bgcolor="#f5f9f9">'.$bookings['roomtype'].' ('.$bookings['capacitytitle'].')</td>';				
			echo '<td align="center" bgcolor="#f5f9f9">'.$bookings['capacity'].' Adult</td>';
				
			echo '<td align="right" bgcolor="#f5f9f9" style="padding-right:5px;">'.$bsiCore->config['conf_currency_symbol'].number_format($bookings['grosstotal'], 2 , '.', ',').'</td>';
			echo '</tr>';		
		}
	 ?>
   <tr>
    <td colspan="3" align="right" bgcolor="#f2f2f2"><strong><?=SUB_TOTAL_TEXT?></strong></td>
    <td bgcolor="#f2f2f2" align="right" style="padding-right:5px;"><strong>
     <?=$bsiCore->config['conf_currency_symbol']?><?=number_format($bsibooking->roomPrices['subtotal'], 2 , '.', ',')?>
     </strong></td>
   </tr>
   <?php
		if($bsiCore->config['conf_tax_amount'] > 0 &&  $bsiCore->config['conf_price_with_tax']==0){
			$taxtext=""; 
		?>
   <tr>
    <td colspan="3" align="right" bgcolor="#f5f9f9"><?=TAX_TEXT?>
     
     (
     <?=$bsiCore->config['conf_tax_amount']?>
     %)</td>
    <td align="right" bgcolor="#f5f9f9" style="padding-right:5px;"><span id="taxamountdisplay">
     <?=$bsiCore->config['conf_currency_symbol']?><?=number_format($bsibooking->roomPrices['totaltax'], 2 , '.', ',')?>
     </span></td>
   </tr>

<tr>
    <td colspan="3" align="right" bgcolor="#f5f9f9"><?=SERVICE_TEXT?>
     
     (
     <?=$bsiCore->config['conf_service_amount']?>
     %)</td>
    <td align="right" bgcolor="#f5f9f9" style="padding-right:5px;"><span id="taxamountdisplay">
     <?=$bsiCore->config['conf_currency_symbol']?><?=number_format($bsibooking->roomPrices['totaltax1'], 2 , '.', ',')?>
     </span></td>
   </tr>


    <td colspan="3" align="right" bgcolor="#f2f2f2"><strong><?=GRAND_TOTAL_TEXT?></strong>
     <?=$taxtext?></td>
    <td align="right" bgcolor="#f2f2f2" style="padding-right:5px;"><strong> <span id="grandtotaldisplay">
     <?=$bsiCore->config['conf_currency_symbol']?><?=number_format($bsibooking->roomPrices['grandtotal'], 2 , '.', ',')?>
     </span></strong></td>
   </tr>
   <?php 
		if($bsiCore->config['conf_enabled_deposit'] && ($bsibooking->depositPlans['deposit_percent'] > 0 && $bsibooking->depositPlans['deposit_percent'] < 100)){
		?>
   <tr id="advancepaymentdisplay">
    <td colspan="3" align="right" bgcolor="#f2f2f2"><strong> <?=ADVANCE_PAYMENT_TEXT?>(<span style="font-size:11px;">
     <?=$bsibooking->depositPlans['deposit_percent']?></strong>
     %<?=OF_GRAND_TOTAL_TEXT?></span>)</td>
    <td align="right" bgcolor="#f2f2f2" style="padding-right:5px;"><span id="advancepaymentamount">
     <?=$bsiCore->config['conf_currency_symbol']?><?=number_format($bsibooking->roomPrices['advanceamount_total'], 2 , '.', ',')?>
     </span></td>
   </tr>
   
   <?php
        }?>
   <tr>
    <td colspan="3" align="right" bgcolor="#f5f9f9"><?=ONLINE_TEXT?>
     
     (
     <?=$bsiCore->config['conf_online_amount']?>
     %)</td>
    <td align="right" bgcolor="#f5f9f9" style="padding-right:5px;"><span id="taxamountdisplay">
     <?=$bsiCore->config['conf_currency_symbol']?><?=number_format($bsibooking->roomPrices['totaltax2'], 2 , '.', ',')?>
     </span></td>
   </tr>
   <?php }else{
			$taxtext="(".BD_INC_TAX.")";
		}
		?>
   <tr>
   <?php 
		if($bsiCore->config['conf_enabled_deposit'] && ($bsibooking->depositPlans['deposit_percent'] > 0 && $bsibooking->depositPlans['deposit_percent'] <= 100)){
		?>
   <tr id="advancepaymentdisplay">
    <td colspan="3" align="right" bgcolor="#f2f2f2"><strong> Advance Booking Amount Pay</strong></td>
    <td align="right" bgcolor="#f2f2f2" style="padding-right:5px;"><span id="advancepaymentamount">
     <?=$bsiCore->config['conf_currency_symbol']?><?=number_format($bsibooking->roomPrices['advanceamount'], 2 , '.', ',')?>
     </span></td>
   </tr>
   
   <?php
        }?>
  </table>
							</div>
							<div class="line"></div>
							
						</section><!-- /.shopping-card -->
						
						
						<section class="row row-account clearfix">
							<header class="box-heading">
								<h3 class="head headborder">Account information</h3>
							</header><!-- /.box-heading -->
							<div class="box-body">
								<div class="form-group">
									<label class="label-control">Email<span class="start">*</span></label>
                                    <input type="text" name="email_addr_existing" id="email_addr_existing" class="input-control"  />
								</div>
                                <button id="btn_exisitng_cust" class="btn btn-medium btn-brown" type="submit" style="float:left;">Show Details</button>
							</div><!-- /.box-body -->
						</section><!-- /.account-info -->
						
						
						<form method="post" action="booking-process.php" id="form1" class="signupform">
 <input type="hidden" name="allowlang" id="allowlang" value="no" />
						<section class="row row-billing clearfix">
							<header class="box-heading">
								<h3 class="head headborder">Billing information</h3>
							</header><!-- /.box-heading -->
							<div class="box-body">
								<div class="col-left">
									<div class="form-group">
										<label class="label-control"><?=TITLE_TEXT?><span class="start">*</span></label>
										<div class="input-group select-brown">
											<label class="collapse"><select name="title" id="title" class="form-select required">
       <option value="Mr."><?=MR_TEXT?>.</option>
       <option value="Ms."><?=MS_TEXT?>.</option>
       <option value="Mrs."><?=MRS_TEXT?>.</option>
       <option value="Miss."><?=MISS_TEXT?>.</option>
       <option value="Dr."><?=DR_TEXT?>.</option>
       <option value="Prof."><?=PROF_TEXT?>.</option>
      </select></label>
										</div>
									</div>
									<div class="form-group">
										<label class="label-control"><?=FIRST_NAME_TEXT?><span class="start">*</span></label>
										<input type="text" name="fname" id="fname"  class="input-control required" />
									</div>
									<div class="form-group">
										<label class="label-control"><?=LAST_NAME_TEXT?> <span class="start">*</span></label>
										<input type="text" name="lname" id="lname"  class="input-control required" />
									</div>
                                    <div class="form-group">
										<label class="label-control"><?=PHONE_TEXT?> <span class="start">*</span></label>
										<input type="text" name="phone"  id="phone"  class="input-control required" />
									</div>
                                    <div class="form-group">
										<label class="label-control"><?=EMAIL_TEXT?> <span class="start">*</span></label>
										<input type="text" name="email"  id="email"  class="input-control required" />
									</div>
                                    
                                    
								</div>
								<div class="col-right">
									<div class="form-group">
										<label class="label-control"><?=COUNTRY_TEXT?> <span class="start">*</span></label>
										<div class="input-group select-brown">
											<label class="collapse">
												<select name="country"  id="country" class="form-select required"> 
<option value="" selected="selected">Select Country</option> 
<option value="United States">United States</option> 
<option value="United Kingdom">United Kingdom</option> 
<option value="Afghanistan">Afghanistan</option> 
<option value="Albania">Albania</option> 
<option value="Algeria">Algeria</option> 
<option value="American Samoa">American Samoa</option> 
<option value="Andorra">Andorra</option> 
<option value="Angola">Angola</option> 
<option value="Anguilla">Anguilla</option> 
<option value="Antarctica">Antarctica</option> 
<option value="Antigua and Barbuda">Antigua and Barbuda</option> 
<option value="Argentina">Argentina</option> 
<option value="Armenia">Armenia</option> 
<option value="Aruba">Aruba</option> 
<option value="Australia">Australia</option> 
<option value="Austria">Austria</option> 
<option value="Azerbaijan">Azerbaijan</option> 
<option value="Bahamas">Bahamas</option> 
<option value="Bahrain">Bahrain</option> 
<option value="Bangladesh">Bangladesh</option> 
<option value="Barbados">Barbados</option> 
<option value="Belarus">Belarus</option> 
<option value="Belgium">Belgium</option> 
<option value="Belize">Belize</option> 
<option value="Benin">Benin</option> 
<option value="Bermuda">Bermuda</option> 
<option value="Bhutan">Bhutan</option> 
<option value="Bolivia">Bolivia</option> 
<option value="Bosnia and Herzegovina">Bosnia and Herzegovina</option> 
<option value="Botswana">Botswana</option> 
<option value="Bouvet Island">Bouvet Island</option> 
<option value="Brazil">Brazil</option> 
<option value="British Indian Ocean Territory">British Indian Ocean Territory</option> 
<option value="Brunei Darussalam">Brunei Darussalam</option> 
<option value="Bulgaria">Bulgaria</option> 
<option value="Burkina Faso">Burkina Faso</option> 
<option value="Burundi">Burundi</option> 
<option value="Cambodia">Cambodia</option> 
<option value="Cameroon">Cameroon</option> 
<option value="Canada">Canada</option> 
<option value="Cape Verde">Cape Verde</option> 
<option value="Cayman Islands">Cayman Islands</option> 
<option value="Central African Republic">Central African Republic</option> 
<option value="Chad">Chad</option> 
<option value="Chile">Chile</option> 
<option value="China">China</option> 
<option value="Christmas Island">Christmas Island</option> 
<option value="Cocos (Keeling) Islands">Cocos (Keeling) Islands</option> 
<option value="Colombia">Colombia</option> 
<option value="Comoros">Comoros</option> 
<option value="Congo">Congo</option> 
<option value="Congo, The Democratic Republic of The">Congo, The Democratic Republic of The</option> 
<option value="Cook Islands">Cook Islands</option> 
<option value="Costa Rica">Costa Rica</option> 
<option value="Cote D'ivoire">Cote D'ivoire</option> 
<option value="Croatia">Croatia</option> 
<option value="Cuba">Cuba</option> 
<option value="Cyprus">Cyprus</option> 
<option value="Czech Republic">Czech Republic</option> 
<option value="Denmark">Denmark</option> 
<option value="Djibouti">Djibouti</option> 
<option value="Dominica">Dominica</option> 
<option value="Dominican Republic">Dominican Republic</option> 
<option value="Ecuador">Ecuador</option> 
<option value="Egypt">Egypt</option> 
<option value="El Salvador">El Salvador</option> 
<option value="Equatorial Guinea">Equatorial Guinea</option> 
<option value="Eritrea">Eritrea</option> 
<option value="Estonia">Estonia</option> 
<option value="Ethiopia">Ethiopia</option> 
<option value="Falkland Islands (Malvinas)">Falkland Islands (Malvinas)</option> 
<option value="Faroe Islands">Faroe Islands</option> 
<option value="Fiji">Fiji</option> 
<option value="Finland">Finland</option> 
<option value="France">France</option> 
<option value="French Guiana">French Guiana</option> 
<option value="French Polynesia">French Polynesia</option> 
<option value="French Southern Territories">French Southern Territories</option> 
<option value="Gabon">Gabon</option> 
<option value="Gambia">Gambia</option> 
<option value="Georgia">Georgia</option> 
<option value="Germany">Germany</option> 
<option value="Ghana">Ghana</option> 
<option value="Gibraltar">Gibraltar</option> 
<option value="Greece">Greece</option> 
<option value="Greenland">Greenland</option> 
<option value="Grenada">Grenada</option> 
<option value="Guadeloupe">Guadeloupe</option> 
<option value="Guam">Guam</option> 
<option value="Guatemala">Guatemala</option> 
<option value="Guinea">Guinea</option> 
<option value="Guinea-bissau">Guinea-bissau</option> 
<option value="Guyana">Guyana</option> 
<option value="Haiti">Haiti</option> 
<option value="Heard Island and Mcdonald Islands">Heard Island and Mcdonald Islands</option> 
<option value="Holy See (Vatican City State)">Holy See (Vatican City State)</option> 
<option value="Honduras">Honduras</option> 
<option value="Hong Kong">Hong Kong</option> 
<option value="Hungary">Hungary</option> 
<option value="Iceland">Iceland</option> 
<option value="India">India</option> 
<option value="Indonesia">Indonesia</option> 
<option value="Iran, Islamic Republic of">Iran, Islamic Republic of</option> 
<option value="Iraq">Iraq</option> 
<option value="Ireland">Ireland</option> 
<option value="Israel">Israel</option> 
<option value="Italy">Italy</option> 
<option value="Jamaica">Jamaica</option> 
<option value="Japan">Japan</option> 
<option value="Jordan">Jordan</option> 
<option value="Kazakhstan">Kazakhstan</option> 
<option value="Kenya">Kenya</option> 
<option value="Kiribati">Kiribati</option> 
<option value="Korea, Democratic People's Republic of">Korea, Democratic People's Republic of</option> 
<option value="Korea, Republic of">Korea, Republic of</option> 
<option value="Kuwait">Kuwait</option> 
<option value="Kyrgyzstan">Kyrgyzstan</option> 
<option value="Lao People's Democratic Republic">Lao People's Democratic Republic</option> 
<option value="Latvia">Latvia</option> 
<option value="Lebanon">Lebanon</option> 
<option value="Lesotho">Lesotho</option> 
<option value="Liberia">Liberia</option> 
<option value="Libyan Arab Jamahiriya">Libyan Arab Jamahiriya</option> 
<option value="Liechtenstein">Liechtenstein</option> 
<option value="Lithuania">Lithuania</option> 
<option value="Luxembourg">Luxembourg</option> 
<option value="Macao">Macao</option> 
<option value="Macedonia, The Former Yugoslav Republic of">Macedonia, The Former Yugoslav Republic of</option> 
<option value="Madagascar">Madagascar</option> 
<option value="Malawi">Malawi</option> 
<option value="Malaysia">Malaysia</option> 
<option value="Maldives">Maldives</option> 
<option value="Mali">Mali</option> 
<option value="Malta">Malta</option> 
<option value="Marshall Islands">Marshall Islands</option> 
<option value="Martinique">Martinique</option> 
<option value="Mauritania">Mauritania</option> 
<option value="Mauritius">Mauritius</option> 
<option value="Mayotte">Mayotte</option> 
<option value="Mexico">Mexico</option> 
<option value="Micronesia, Federated States of">Micronesia, Federated States of</option> 
<option value="Moldova, Republic of">Moldova, Republic of</option> 
<option value="Monaco">Monaco</option> 
<option value="Mongolia">Mongolia</option> 
<option value="Montserrat">Montserrat</option> 
<option value="Morocco">Morocco</option> 
<option value="Mozambique">Mozambique</option> 
<option value="Myanmar">Myanmar</option> 
<option value="Namibia">Namibia</option> 
<option value="Nauru">Nauru</option> 
<option value="Nepal">Nepal</option> 
<option value="Netherlands">Netherlands</option> 
<option value="Netherlands Antilles">Netherlands Antilles</option> 
<option value="New Caledonia">New Caledonia</option> 
<option value="New Zealand">New Zealand</option> 
<option value="Nicaragua">Nicaragua</option> 
<option value="Niger">Niger</option> 
<option value="Nigeria">Nigeria</option> 
<option value="Niue">Niue</option> 
<option value="Norfolk Island">Norfolk Island</option> 
<option value="Northern Mariana Islands">Northern Mariana Islands</option> 
<option value="Norway">Norway</option> 
<option value="Oman">Oman</option> 
<option value="Pakistan">Pakistan</option> 
<option value="Palau">Palau</option> 
<option value="Palestinian Territory, Occupied">Palestinian Territory, Occupied</option> 
<option value="Panama">Panama</option> 
<option value="Papua New Guinea">Papua New Guinea</option> 
<option value="Paraguay">Paraguay</option> 
<option value="Peru">Peru</option> 
<option value="Philippines">Philippines</option> 
<option value="Pitcairn">Pitcairn</option> 
<option value="Poland">Poland</option> 
<option value="Portugal">Portugal</option> 
<option value="Puerto Rico">Puerto Rico</option> 
<option value="Qatar">Qatar</option> 
<option value="Reunion">Reunion</option> 
<option value="Romania">Romania</option> 
<option value="Russian Federation">Russian Federation</option> 
<option value="Rwanda">Rwanda</option> 
<option value="Saint Helena">Saint Helena</option> 
<option value="Saint Kitts and Nevis">Saint Kitts and Nevis</option> 
<option value="Saint Lucia">Saint Lucia</option> 
<option value="Saint Pierre and Miquelon">Saint Pierre and Miquelon</option> 
<option value="Saint Vincent and The Grenadines">Saint Vincent and The Grenadines</option> 
<option value="Samoa">Samoa</option> 
<option value="San Marino">San Marino</option> 
<option value="Sao Tome and Principe">Sao Tome and Principe</option> 
<option value="Saudi Arabia">Saudi Arabia</option> 
<option value="Senegal">Senegal</option> 
<option value="Serbia and Montenegro">Serbia and Montenegro</option> 
<option value="Seychelles">Seychelles</option> 
<option value="Sierra Leone">Sierra Leone</option> 
<option value="Singapore">Singapore</option> 
<option value="Slovakia">Slovakia</option> 
<option value="Slovenia">Slovenia</option> 
<option value="Solomon Islands">Solomon Islands</option> 
<option value="Somalia">Somalia</option> 
<option value="South Africa">South Africa</option> 
<option value="South Georgia and The South Sandwich Islands">South Georgia and The South Sandwich Islands</option> 
<option value="Spain">Spain</option> 
<option value="Sri Lanka">Sri Lanka</option> 
<option value="Sudan">Sudan</option> 
<option value="Suriname">Suriname</option> 
<option value="Svalbard and Jan Mayen">Svalbard and Jan Mayen</option> 
<option value="Swaziland">Swaziland</option> 
<option value="Sweden">Sweden</option> 
<option value="Switzerland">Switzerland</option> 
<option value="Syrian Arab Republic">Syrian Arab Republic</option> 
<option value="Taiwan, Province of China">Taiwan, Province of China</option> 
<option value="Tajikistan">Tajikistan</option> 
<option value="Tanzania, United Republic of">Tanzania, United Republic of</option> 
<option value="Thailand">Thailand</option> 
<option value="Timor-leste">Timor-leste</option> 
<option value="Togo">Togo</option> 
<option value="Tokelau">Tokelau</option> 
<option value="Tonga">Tonga</option> 
<option value="Trinidad and Tobago">Trinidad and Tobago</option> 
<option value="Tunisia">Tunisia</option> 
<option value="Turkey">Turkey</option> 
<option value="Turkmenistan">Turkmenistan</option> 
<option value="Turks and Caicos Islands">Turks and Caicos Islands</option> 
<option value="Tuvalu">Tuvalu</option> 
<option value="Uganda">Uganda</option> 
<option value="Ukraine">Ukraine</option> 
<option value="United Arab Emirates">United Arab Emirates</option> 
<option value="United Kingdom">United Kingdom</option> 
<option value="United States">United States</option> 
<option value="United States Minor Outlying Islands">United States Minor Outlying Islands</option> 
<option value="Uruguay">Uruguay</option> 
<option value="Uzbekistan">Uzbekistan</option> 
<option value="Vanuatu">Vanuatu</option> 
<option value="Venezuela">Venezuela</option> 
<option value="Viet Nam">Viet Nam</option> 
<option value="Virgin Islands, British">Virgin Islands, British</option> 
<option value="Virgin Islands, U.S.">Virgin Islands, U.S.</option> 
<option value="Wallis and Futuna">Wallis and Futuna</option> 
<option value="Western Sahara">Western Sahara</option> 
<option value="Yemen">Yemen</option> 
<option value="Zambia">Zambia</option> 
<option value="Zimbabwe">Zimbabwe</option>
</select>
											</label>
										</div>
                                        <div class="form-group">
										<label class="label-control"><?=FAX_TEXT?> <span class="start">*</span></label>
										<input type="text" name="fax"  id="fax" class="input-control required" />
									</div>
                                    <div class="form-group">
										<label class="label-control"><?=ADDRESS_TEXT?> <span class="start">*</span></label>
										<input type="text" name="str_addr" id="str_addr"  class="input-control required" />
									</div>
                                    <div class="form-group">
										<label class="label-control"><?=CITY_TEXT?> <span class="start">*</span></label>
										<input type="text" name="city"  id="city" class="input-control required" />
									</div>
                                    <div class="form-group">
										<label class="label-control"><?=STATE_TEXT?> <span class="start">*</span></label>
										<input type="text" name="state"  id="state" class="input-control" />
									</div>
                                    <div class="form-group">
										<label class="label-control"><?=POSTAL_CODE_TEXT?> <span class="start">*</span></label>
										<input type="text" name="zipcode"  id="zipcode" class="input-control" />
									</div>
									</div>
									
								</div>
							</div><!-- /.box-body -->
						</section><!-- /.billing-info -->



                       <section class="row row-payment clearfix">
							<header class="box-heading">
								<h3 class="head headborder">Payment</h3>
							</header><!-- /.box-heading -->
							<div class="box-body">
					
										<div class="form-group">
											<?php
				$paymentGatewayDetails = $bsiCore->loadPaymentGateways();				
				foreach($paymentGatewayDetails as $key => $value){ 	
					echo '<input type="radio" name="payment_type" id="payment_type_'.$key.'" value="'.$key.'" class="required" />'.$value['name'].'<br />';
				}
				?>
      <label class="error" generated="true" for="payment_type" style="display:none;"><?=FIELD_REQUIRED_ALERT?>.</label>
										</div><!-- /.ideal-via-mobile -->
									
						
							</div><!-- /.box-body -->
						</section><!-- /.payment -->
						<div class="row">
				                <div class="form-group">
										<label class="label-control"><?=ADDITIONAL_REQUESTS_TEXT?><span class="start">*</span></label>
										<textarea name="message" style="width:300px; height:70px;" class="input-control"></textarea>
								</div>
								<div class="form-action">
									<input type="checkbox" name="tos" id="tos" value="" style="width:15px !important"  class="required"/>
      &nbsp;
      
     <?=I_AGREE_WITH_THE_TEXT?> <a href="javascript: ;" onclick="javascript:myPopup2();"> <?=TERMS_AND_CONDITIONS_TEXT?>.</a>
									<p><button id="registerButton" type="submit" style="float:left;" class="btn btn-large btn-darkbrown">Book now & Pay Deposit</button></p>
								</div>
							</form>
						
						
						
                            </div>
                        </div>
                    </div>
               
            </div><!-- END .offer-container -->
            </div>
		
            <?php require("components/footer.php");?>

                </div><!-- END #wrapper -->

                <div id="freezer"></div><!-- END #freezer -->
            </div><!-- END #container -->

            <!-- 
            *********************************************
            *********************************************
                Start Left Menu || freeze contents
            *********************************************
            *********************************************
            -->
            <div id="nav">
			
               <?php require("components/left-menu.php");?>

            </div><!-- END #nav -->
        </div><!-- END #perspective -->
        <script src="js/bootstrap.js"></script>
        <script src="js/jquery-ui.min.js"></script>
        <script src="js/jquery.validate.min.js" type="text/javascript"></script>
        <script src="js/jquery.validate.unobtrusive.min.js" type="text/javascript"></script>


	<script type="text/javascript" src="js/jquery.bxslider.min.js"></script>
		
		
		
        <script src="js/datepicker-en-US.js"></script>
		
        <script src="js/jquery.flexslider-2.4.0.min.js"></script>
        <script src="js/masonry.pkgd.min.js"></script>
        <script src="js/imagesloaded.pkgd.min.js"></script>
        <script src="js/jquery.fancybox.pack.js"></script>
        <script src="js/jquery.viewportchecker.min.js"></script>
        <script src="js/jquery.sticky-kit.min.js"></script>
        <script src="js/jquery.steps.min.js"></script>
        <script src="js/core.obf.js"></script>
        <script src="js/app.js"></script>


		
        <!-- ========== revolution Slider ========== -->  
        <script type="text/javascript" src="js/jquery.themepunch.plugins.min.js"></script>           
        <script type="text/javascript" src="js/jquery.themepunch.revolution.min.js"></script>  
        <script type="text/javascript">
            var tpj=jQuery;                
            //tpj(document).ready(function() {
            
            if (tpj.fn.cssOriginal!=undefined)
                tpj.fn.css = tpj.fn.cssOriginal;
                tpj('.fullwidthbanner').revolution(
                    {   
                        delay: 7000,                                             
                        startwidth:890,
                        startheight:450,                        
                        onHoverStop:"off", // Stop Banner Timet at Hover on Slide on/off
                        
                        thumbWidth:100, // Thumb With and Height and Amount (only if navigation Tyope set to thumb !)
                        thumbHeight:50,
                        thumbAmount:4,
                        
                        hideThumbs:200,
                        navigationType:"none", //bullet, thumb, none, both  (No Shadow in Fullwidth Version !)
                        navigationArrows:"verticalcentered", //nexttobullets, verticalcentered, none
                        navigationStyle:"round", //round,square,navbar
                        
                        touchenabled:"on", // Enable Swipe Function : on/off                        
                        navOffsetHorizontal:0,
                        navOffsetVertical:20,                        
                        fullWidth:"off",                        
                        shadow:0 //0 = no Shadow, 1,2,3 = 3 Different Art of Shadows -  (No Shadow in Fullwidth Version !)        
                    });
        //});
        </script>

        <!-- Custom -->

        <script>
        $(document).ready(function(){
            $('#nav').addClass('close');
            $('#pre-footer .logo-holder').height($('.contact-holder').height());
        });
        </script>

        <!-- Owl Carousel Start -->
        <script src="js/owl-carousel-2/owl.carousel.js" type="text/javascript"></script>
        <!-- Owl Carousel End -->

        <script src="js/jquery.prettyPhoto.js" type="text/javascript"></script>

        <!-- Loader on scroll -->
        <script src="js/jquery-scrollReveal.js" type="text/javascript"></script>

        <!-- Others -->
        <script>
            $(window).on('load', function () {
                $('.slider-preload-cover').hide();
                $('.home-landing>div>h1').show();
            });

            $(document).ready(function(){
                $('.facilities-carousel, #awards-carousel').css('height', 'auto');
            });

        </script>

        <script>
        $('#header .quick_socials ul li').each(function(i){
            setTimeout(function(){$('#header .quick_socials ul li:eq('+i+')').removeClass('hidden_by_scaling');},2400+(100*i));
        });
        </script>

        <script src="js/script.js" type="text/javascript"></script>


        <script type="text/javascript">
    $("#promotional-offer .close-img").click(function () {
        $("#promotional-offer").slideUp(500);
    });
    window.onload = $("#promotional-offer").slideDown(500);
    </script>
	

    </body>
</html>                        