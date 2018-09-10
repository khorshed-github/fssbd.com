<?php
ob_start();
session_start();
    date_default_timezone_set('Etc/GMT-6');	
	$con = mysqli_connect("localhost","root","") or die ("Couldn't Connect to Server");
	$db = mysqli_select_db($con,"tearesort") or die ("Couldn't Select Database");
	
		  //******These two line are used for Bangla Character *********/
	mysqli_query($con,"SET CHARACTER SET utf8");
	mysqli_query($con,"SET SESSION collation_connection ='utf8_general_ci'");
	

	error_reporting(0);
	if(isset($_SESSION['user_id'])){
		$loggedId=$_SESSION['user_id'];
		$getloggedinfo = mysqli_query($con,"SELECT * FROM user where id='$loggedId' limit 1");
		$getloggedinfonum=mysqli_num_rows($getloggedinfo);
		if($getloggedinfonum!=0){
			$getloggedinforow=mysqli_fetch_assoc($getloggedinfo);
			$loggedName=$getloggedinforow['name'];
			$loggedType=$getloggedinforow['user_type'];
			$loggedPic=$getloggedinforow['user_pic'];
			if($loggedPic==''){
				$loggedPic="images/favicon.png";
			}else{
				$loggedPic="images/user/".$loggedPic;
			}
		}
	}else{
		$loggedId="";
		$loggedPic="images/favicon.png";
		$loggedName="Your Name";
	}
?>