<?php
	$to = $email;
	$subject = "Tea Resort & Museum Bookings details";

	$message = "
	<html>
	<head>
	<title>Bookings details</title>
	</head>
	<body>
	<p>Bookings details for</p>
	<table>
	<tr>
	<th>Name</th>
	<th>Email</th>
	<th>Check In</th>
	<th>Check Out</th>
	<th>Amount</th>
	</tr>
	<tr>
	<td>'".$title."' '".$first_name."' '".$surname;"'</td>
	<td>'".$email."'</td>
	<td>'".$entryDate."'</td>
	<td>'".$outDate."'</td>
	<td>'".$bookingAmount."'</td>
	</tr>
	</table>
	</body>
	</html>
	";

	// Always set content-type when sending HTML email
	$headers = 'MIME-Version: 1.0' . '\r\n';
	$headers .= 'Content-type:text/html;charset=UTF-8' . '\r\n';

	// More headers
	$headers .= 'From: <"'.$email.'">' . '\r\n';
	$headers .= 'Cc: noreply@tearesort.gov.bd' . '\r\n';

	mail($to,$subject,$message,$headers);
	
	
// Another way to send Email Function
	
$to = $email;

$subject = "Tea Resort & Museum Bookings details";

$headers = "From: <".$email."> \r\n";
$headers .= "Reply-To: no-reply@tearesort.gov.bd \r\n";
//$headers .= "BCC: rahaman@thecodero.net\r\n";
$headers .= "MIME-Version: 1.0\r\n";
$headers .= "Content-Type: text/html; charset=ISO-8859-1\r\n";
$message = '<html><body>';
$message .= '<h1>Bookings details:</h1>';
$message .= '</body></html>';
$message = '<html><body>';
$message .= '<img src="http://www.islctg.com/images/ISL-header.png" alt="'.$subject.'" />';
$message .= '<table rules="all" style="border-color: #666;" cellpadding="15">';
$message .= "<tr style='background: #eee;'><td><strong>Name :</strong> </td><td>" . strip_tags($title.' '. $first_name. ' '.$surname) . "</td></tr>";
$message .= "<tr><td><strong>Email ID :</strong> </td><td>" . strip_tags($email) . "</td></tr>";
$message .= "<tr><td><strong>Check In Date:</strong> </td><td>" . strip_tags($entryDate) . "</td></tr>";
$message .= "<tr><td><strong>Check Out Date:</strong> </td><td>" . strip_tags($outDate) . "</td></tr>";
$message .= "<tr><td><strong>Amount:</strong> </td><td>" . strip_tags($bookingAmount) ."</td></tr>";
$message .= "</table>";
$message .= "</body></html>";

mail($to, $subject, $message, $headers); 
//mail function end
?>