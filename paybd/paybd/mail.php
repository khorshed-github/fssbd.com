<?php
error_reporting(0);
if (isset($_POST['submit'])) {
    $fname = $_POST['first_name'];
    $lname = $_POST['last_name'];
    $mobile = $_POST['mobile'];
    $email = $_POST['email'];
    $msg = $_POST['message'];

    // Another way to send Email Function

    $to = "Tea Resort & Museum <tearesort@yahoo.com>";

    $subject = "Tea Resort & Museum Bookings details";

    $headers = "From: <" . $email . "> \r\n";
    //$headers .= "Reply-To: no-reply@tearesort.gov.bd \r\n";
    //$headers .= "BCC: rahaman@thecodero.net\r\n";
    $headers .= "MIME-Version: 1.0\r\n";
    $headers .= "Content-Type: text/html; charset=ISO-8859-1\r\n";
    $message = '<html><body>';
    $message .= '<h1>Guest Messages From Contact Page:</h1>';
    $message .= '</body></html>';
    $message = '<html><body>';
    $message .= '<img src="http://tearesort.gov.bd/logo/Sreemangal-Tea-Resort-Logo.jpg" alt="Tea Resort & Museum Logo" />';
    $message .= '<table rules="all" style="border-color: #666;" cellpadding="15">';
    $message .= "<tr style='background: #eee;'><td><strong>Name :</strong> </td><td>" . strip_tags($fname . ' ' . $lname) . "</td></tr>";
    $message .= "<tr><td><strong>Mobile Number :</strong> </td><td>" . strip_tags($mobile) . "</td></tr>";
    $message .= "<tr><td><strong>Messages :</strong> </td><td>" . strip_tags($msg) . "</td></tr>";
    $message .= "</table>";
    $message .= "<p> Thank you for your Comment</p>";
    $message .= "</body></html>";

    $send = mail($to, $subject, $message, $headers);
}
if ($send) {
    header("Location: contact-us.php");
} else {

}
//mail function end
?>