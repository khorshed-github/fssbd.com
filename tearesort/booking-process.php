<?php
session_start();
error_reporting(0);
include("config/dbconnect.php");

// Get search value using session variables//
date_default_timezone_set("Asia/Dhaka");
$bkTime = date("Y-m-d h:i:s");

$entryDate = $_SESSION['startTime'];
$outDate = $_SESSION['endTime'];
$adultCount = $_SESSION['guestCount'];
$childCount = $_SESSION['childCount'];
$bangloType = $_SESSION['bangloType'];

	$qd = mysqli_query($con,"SELECT DATEDIFF('$outDate','$entryDate') as difdate");
	$objd = mysqli_fetch_object($qd);
	$night = $objd->difdate;
		
	$qtype = mysqli_query($con,"SELECT id,title,bdt_rate,discount FROM accomodation WHERE id='$bangloType'");
	$objatype = mysqli_fetch_object($qtype);
	$id = $objatype->id;	
	$roomName = $objatype->title;	
	$fixdPrice = $objatype->bdt_rate;	
	$discount = $objatype->discount;	
	
	$roomPrice = $night * $fixdPrice;	
	$serviceCharge = $roomPrice/100*5;
	$total = $roomPrice + $serviceCharge;
	
	$vat = $total/100*15;
	
	$grandTotal = $total + $vat;
	
	$discountAmount = $grandTotal / 100 * $discount;
	
	$totalAmount = $grandTotal - $discountAmount;
	
	$onlineCharge = $totalAmount/100*3.5;
	
	$bookingAmount = $totalAmount + $onlineCharge;
	
	// This is Clients Information from Bookings-details page//

	$ip = $_SERVER['REMOTE_ADDR'];
	$client_id = $_POST['cid'];
	$first_name = mysqli_real_escape_string($con,$_POST['fname']);
	$surname = mysqli_real_escape_string($con,$_POST['lname']);
	$title = mysqli_real_escape_string($con,$_POST['title']);
	$street_addr = mysqli_real_escape_string($con,$_POST['str_addr']);
	$city = mysqli_real_escape_string($con,$_POST['city']);
	$province = mysqli_real_escape_string($con,$_POST['state']);
	$zip = mysqli_real_escape_string($con,$_POST['zipcode']);
	$country = mysqli_real_escape_string($con,$_POST['country']);
	$phone = mysqli_real_escape_string($con,$_POST['phone']);
	$nid = mysqli_real_escape_string($con,$_POST['nid']);
	$email = mysqli_real_escape_string($con,$_POST['email']);
	$message = mysqli_real_escape_string($con,$_POST['message']);

	$qexit = mysqli_query($con,"SELECT email FROM clients WHERE email='$email'");
	if(mysqli_num_rows($qexit) == 0){
	$sqlinsert = mysqli_query($con,"INSERT INTO `clients`(`first_name`, `surname`, `title`, `street_addr`, `city`, `province`, `zip`, `country`, `phone`, `nid`, `email`, `additional_comments`, `ip`, `existing_client`, `datetime`)VALUES('$first_name','$surname','$title','$street_addr','$city','$province','$zip','$country','$phone','$nid','$email','$message','$ip',0,CURRENT_TIMESTAMP)");
	}else{
		$sqlinsert = mysqli_query($con,"UPDATE `clients` SET existing_client=1 WHERE email='$email'");
	}

	$sqlBook = mysqli_query($con,"INSERT INTO `bookings`(`booking_time`, `start_date`, `end_date`, `client_id`, `adult_count`, `child_count`, `extra_guest_count`, `discount_coupon`, `total_cost`, `payment_amount`, `payment_type`, `payment_success`, `payment_txnid`, `paypal_email`, `special_id`, `special_requests`, `is_block`, `is_deleted`, `block_name`, `ip`, `datetime`)VALUES('$bkTime','$entryDate','$outDate','$client_id','$adultCount','$childCount',0,'','$totalAmount','$bookingAmount','','','','','','','','','','$ip',CURRENT_TIMESTAMP)"); 

	if($sqlinsert AND $sqlBook){

$currencyCode = "BDT";
$MerchantID = "TRESORT";
$MerchantRefID = time();
$TxnAmount = $bookingAmount;
	
	echo "<script language=\"JavaScript\">";
	echo "document.write('<form action=\"booking-brack-bank-process.php\" method=\"post\" name=\"formigp\">');";
	echo "document.write('<input type=\"hidden\" name=\"cur\"  value=\"".$currencyCode."\">');";
	echo "document.write('<input type=\"hidden\" name=\"mer_id\"  value=\"".$MerchantID."\">');";
	echo "document.write('<input type=\"hidden\" name=\"mer_txn_id\"  value=\"".$MerchantRefID."\">');";
	echo "document.write('<input type=\"hidden\" name=\"txn_amt\"  value=\"".$TxnAmount."\">');";

/* 
echo "document.write('<input type=\"hidden\" name=\"mer_var1\"  value=\"" "\">');";
echo "document.write('<input type=\"hidden\" name=\"mer_var2\"  value=\"" "\">');";
echo "document.write('<input type=\"hidden\" name=\"mer_var3\"  value=\"" "\">');";
echo "document.write('<input type=\"hidden\" name=\"mer_var4\"  value=\"" "\">');";
 */

	echo "document.write('</form>');";
	echo "setTimeout(\"document.formigp.submit()\",500);";
	echo "</script>";
	
	}else{
		echo $msg = "transaction Error!!";
	} 
?>