<?php
session_set_cookie_params(0);
session_start();
//set_time_limit(10);
error_reporting(0);
ob_start();
//$db = mysqli_connect('localhost','root','','freelance');
//$db = mysqli_connect('localhost','selfempl_user','?;E7e@LmCjp+','selfempl_test');
//$db = mysqli_connect('localhost','selfempl_user','x]c;ID;?yp^+','selfempl_freelance');
$db = mysqli_connect('localhost','selfempl_user','kKbHQHU(RqJ9','selfempl_selfemply0_freelance');
$db2 = mysqli_connect('localhost','selfempl_user','kKbHQHU(RqJ9','selfempl_selfemply0_test');
if($db == false){
	echo 'Connect Error!';
}
?>