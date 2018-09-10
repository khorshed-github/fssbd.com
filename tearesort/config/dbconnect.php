<?php
    date_default_timezone_set('Etc/GMT-6');	
	$con = mysqli_connect("localhost","root","") or die ("Couldn't Connect to Server");
	$db = mysqli_select_db($con,"tearesort") or die ("Couldn't Select Database");
	
		  //******These two line are used for Bangla Character *********/
	mysqli_query($con,"SET CHARACTER SET utf8");
	mysqli_query($con,"SET SESSION collation_connection ='utf8_general_ci'");
?>