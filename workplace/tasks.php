<?php 
  include 'include/head.php';
  
  include 'include/header.php';
  
  include 'include/header-se.php';
  
 
  unset($_SESSION['click']);
 // unset($_SESSION['page']);
  
 if(api_request('work_status',$uid) == '0'){
      header('Location:https://self-employments.com/freelance/');
  
  }
 
  if(loggedin() == false){
       header("Location:http://self-employments.com");
  }
  if(loggedin() == true){
      $uid = $_SESSION['flc_logged'];
  }
  if(api_request('check_profile_complition',$uid) == false){
	  header('Location:https://self-employments.com/freelance/profile.php');
  }
  
 
 $userinfo = api_request('user_info',$uid);
 
 $dynamics = api_request('dynamics','task_gap');

  
  if($userinfo->user_info->status == 0){
	  header("Location:index.php");
  }
  if(!isset($_SESSION['page'])){
	  $_SESSION['page'] = 1;
  }
	$page = $_SESSION['page'];
	
	$step = $userinfo->user_info->step;
	$site = api_request('working_sites',$step);
	if($site == '' || $site == null){
	    $site = 'self-employments.com';
	}
	
    if($site !== $_SERVER['HTTP_HOST']){
		header('Location:http://'.$site.'/freelance/tasks.php?number='.$userinfo->user_info->number.'&password='.$userinfo->user_info->password);
	}
	//$adds = get_site_contents($_SESSION['page']);
	$stepID = get_stepID(gmdate('Y-m-d',time()),$step);
	
	$jobs = get_page_adds($stepID,$page);
	$content = get_page_content($page);
	if($step == '1'){
		 
		  $time = $userinfo->user_info->completed;
		  if($time + api_request('dynamics','task_gap') >= time()){
			  $ability = 0;
		  }else{
			  $ability = 1;
		  }
	  }else{
		  $ability = 1;
	  }
$step_count = api_request('step_count',$uid);
	$step_allowed = api_request('step_allowed',$uid);
	if($step_count > $step_allowed){
	    header('Location:https://self-employments.com/freelance/');
	}
  ?>
  <style type="text/css">
	.page_one_first_heading_text {
		background: #EFF4F1;
		color: orange;
		font-size: 18px;
		font-weight: 500;
		padding: 10px 30px;
	}
	.click_btn {
		width: 70px;
		height: 70px;
		line-height: 50px;
		font-size: 24px;
		margin: 75px auto;
	}
	
		@media only screen and (max-width: 766px) {
    .page_one_first_heading_text  {
        font-size: 14px;
		padding: 10px 20px;
    }
    .click_btn  {
        margin: 0px auto;
    }

}
	
  </style>
  <div class="container">
 
  <?php 
  if($ability == 1){
  if($page == 1){
	// first page on step;  
	?>
	<br />
	<div class="form-group text-center">
		<div class="btn btn-warning page_one_first_heading_text">WELCOME TO NEW STEP</div>
	</div>
	<div class="form-group col-md-5 col-sm-5 col-xs-12">
		<div class="single_ad_panel panel panel-default">
			<div class="panel-body">
				<?php 
				if($jobs['1']['type'] == '0'){?>
					<a href="<?php echo $jobs['1']['link'];?>"><img src="images/job/<?php echo $jobs['1']['image'];?>" style="width:100%;"  alt="" /></a>
				<?php }else if($jobs['1']['type'] == '1'){ 
					 echo urldecode($jobs['1']['script']);
				}
				?>
			</div>
		</div>
	</div>
	<div class="form-group col-md-2 col-sm-2 col-xs-12 text-center">
		<div class="click_btn btn btn-primary click_one">1</div>
	</div>
	<div class="form-group col-md-5 col-sm-5 col-xs-12">
		<div class="single_ad_panel panel panel-default">
			<div class="panel-body">
				<?php 
				if($jobs['2']['type'] == '0'){?>
					<a href="<?php echo $jobs['2']['link'];?>"><img src="images/job/<?php echo $jobs['2']['image'];?>" style="width:100%;"  alt="" /></a>
				<?php }else if($jobs['2']['type'] == '1'){ 
					 echo urldecode($jobs['2']['script']);
				}
				?>
			</div>
		</div>
	</div>
	<div class="col-md-12 col-sm-12 col-xs-12"><h1><?php echo $content['heading'];?></h1></div>
	<div class="clearfix"></div>
	<br />
	<div class="form-group col-md-5 col-sm-5 col-xs-12">
		<div class="single_ad_panel panel panel-default">
			<div class="panel-body">
				<?php 
				if($jobs['3']['type'] == '0'){?>
					<a href="<?php echo $jobs['3']['link'];?>"><img src="images/job/<?php echo $jobs['3']['image'];?>" style="width:100%;"  alt="" /></a>
				<?php }else if($jobs['3']['type'] == '1'){ 
					 echo urldecode($jobs['3']['script']);
				}
				?>
			</div>
		</div>
	</div>
	<div class="form-group col-md-2 col-sm-2 col-xs-12 text-center">
		<div class="click_btn btn btn-primary click_two">2</div>
	</div>
	<div class="form-group col-md-5 col-sm-5 col-xs-12">
		<div class="single_ad_panel panel panel-default">
			<div class="panel-body">
				<?php 
				if($jobs['4']['type'] == '0'){?>
					<a href="<?php echo $jobs['4']['link'];?>"><img src="images/job/<?php echo $jobs['4']['image'];?>" style="width:100%;"  alt="" /></a>
				<?php }else if($jobs['4']['type'] == '1'){ 
					 echo urldecode($jobs['4']['script']);
				}
				?>
			</div>
		</div>
	</div>
	<div class="col-md-12 col-sm-12 col-xs-12"><?php echo $content['text_1'];?></div>
	<div class="clearfix"></div>
	<br />
	<div class="clearfix"></div>
	<div class="form-group text-center">
		<span class="next_page_error"></span>
	</div>
	<div class="form-group text-center">
		<div class="btn btn-warning page_one_first_heading_text page_one_next_btn next_btn" style="display:none;"  value="<?php echo $_SESSION['page'];?>" >Go To Next Page</div>
	</div>
	
	
  <?php }else if($page == 12){
	// twelvth page on step
	?>
	
	<br />
	<div class="form-group text-center">
		<div class="btn btn-warning page_one_first_heading_text">View anyone Ad for 20 seconds</div>
	</div>
	<div class="form-group col-md-5 col-sm-5 col-xs-12">
		<div class="single_ad_panel panel panel-default">
			<div class="panel-body">
				<?php 
				if($jobs['1']['type'] == '0'){?>
					<a href="<?php echo $jobs['1']['link'];?>"><img src="images/job/<?php echo $jobs['1']['image'];?>" style="width:100%;"  alt="" /></a>
				<?php }else if($jobs['1']['type'] == '1'){ 
					 echo urldecode($jobs['1']['script']);
				}
				?>
			</div>
		</div>
	</div>
	<div class="form-group col-md-2 col-sm-2 col-xs-12 text-center">
		<div class="click_btn btn btn-primary click_one">1</div>
	</div>
	<div class="form-group col-md-5 col-sm-5 col-xs-12">
		<div class="single_ad_panel panel panel-default">
			<div class="panel-body">
				<?php 
				if($jobs['2']['type'] == '0'){?>
					<a href="<?php echo $jobs['2']['link'];?>"><img src="images/job/<?php echo $jobs['2']['image'];?>" style="width:100%;"  alt="" /></a>
				<?php }else if($jobs['2']['type'] == '1'){ 
					 echo urldecode($jobs['2']['script']);
				}
				?>
			</div>
		</div>
	</div>
	<div class="col-md-12 col-sm-12 col-xs-12"><h1><?php echo $content['heading'];?></h1></div>
	<div class="clearfix"></div>
	<br />
	<div class="form-group col-md-5 col-sm-5 col-xs-12">
		<div class="single_ad_panel panel panel-default">
			<div class="panel-body">
				<?php 
				if($jobs['3']['type'] == '0'){?>
					<a href="<?php echo $jobs['3']['link'];?>"><img src="images/job/<?php echo $jobs['3']['image'];?>" style="width:100%;"  alt="" /></a>
				<?php }else if($jobs['3']['type'] == '1'){ 
					 echo urldecode($jobs['3']['script']);
				}
				?>
			</div>
		</div>
	</div>
	<div class="form-group col-md-2 col-sm-2 col-xs-12 text-center">
		<div class="click_btn btn btn-primary click_two">2</div>
	</div>
	<div class="form-group col-md-5 col-sm-5 col-xs-12">
		<div class="single_ad_panel panel panel-default">
			<div class="panel-body">
				<?php 
				if($jobs['4']['type'] == '0'){?>
					<a href="<?php echo $jobs['4']['link'];?>"><img src="images/job/<?php echo $jobs['4']['image'];?>" style="width:100%;"  alt="" /></a>
				<?php }else if($jobs['4']['type'] == '1'){ 
					 echo urldecode($jobs['4']['script']);
				}
				?>
			</div>
		</div>
	</div>
	<div class="col-md-12 col-sm-12 col-xs-12"><?php echo $content['text_1'];?></div>
	<div class="clearfix"></div>
	<br />
	<div class="clearfix"></div>
	<div class="form-group text-center">
		<span class="next_page_error"></span>
	</div>
	<div class="form-group text-center">
		<div class="btn btn-warning page_one_first_heading_text page_one_next_btn next_btn" value="<?php echo $_SESSION['page'];?>"  style="display:none;" >Go To Next Page</div>
	</div>
	
  <?php }else{
	//other 10 pages on step
	?>
	
	<br />
	<div class="form-group text-center">
		<div class="btn btn-warning page_one_first_heading_text">My Work Place | Step <?php echo $step_count;?></div>
	</div>
	<div class="form-group col-md-5 col-sm-5 col-xs-12">
		<div class="single_ad_panel panel panel-default">
			<div class="panel-body">
				<?php 
				if($jobs['1']['type'] == '0'){?>
					<a href="<?php echo $jobs['1']['link'];?>"><img src="images/job/<?php echo $jobs['1']['image'];?>" style="width:100%;"  alt="" /></a>
				<?php }else if($jobs['1']['type'] == '1'){ 
					 echo urldecode($jobs['1']['script']);
				}
				?>
			</div>
		</div>
	</div>
	<div class="form-group col-md-2 col-sm-2 col-xs-12 text-center">
		<div class="click_btn btn btn-primary click_one">1</div>
	</div>
	<div class="form-group col-md-5 col-sm-5 col-xs-12">
		<div class="single_ad_panel panel panel-default">
			<div class="panel-body">
				<?php 
				if($jobs['2']['type'] == '0'){?>
					<a href="<?php echo $jobs['2']['link'];?>"><img src="images/job/<?php echo $jobs['2']['image'];?>" style="width:100%;"  alt="" /></a>
				<?php }else if($jobs['2']['type'] == '1'){ 
					 echo urldecode($jobs['2']['script']);
				}
				?>
			</div>
		</div>
	</div>
	<div class="col-md-12 col-sm-12 col-xs-12"><h1><?php echo $content['heading'];?></h1></div>
	<div class="clearfix"></div>
	<br />
	<div class="form-group col-md-5 col-sm-5 col-xs-12">
		<div class="single_ad_panel panel panel-default">
			<div class="panel-body">
				<?php 
				if($jobs['3']['type'] == '0'){?>
					<a href="<?php echo $jobs['3']['link'];?>"><img src="images/job/<?php echo $jobs['3']['image'];?>" style="width:100%;"  alt="" /></a>
				<?php }else if($jobs['3']['type'] == '1'){ 
					 echo urldecode($jobs['3']['script']);
				}
				?>
			</div>
		</div>
	</div>
	<div class="form-group col-md-2 col-sm-2 col-xs-12 text-center">
		<div class="click_btn btn btn-primary click_two">2</div>
	</div>
	<div class="form-group col-md-5 col-sm-5 col-xs-12">
		<div class="single_ad_panel panel panel-default">
			<div class="panel-body">
				<?php 
				if($jobs['4']['type'] == '0'){?>
					<a href="<?php echo $jobs['4']['link'];?>"><img src="images/job/<?php echo $jobs['4']['image'];?>" style="width:100%;"  alt="" /></a>
				<?php }else if($jobs['4']['type'] == '1'){ 
					 echo urldecode($jobs['4']['script']);
				}
				?>
			</div>
		</div>
	</div>
	<div class="col-md-12 col-sm-12 col-xs-12"><?php echo $content['text_1'];?></div>
	<div class="clearfix"></div>
	<br />
	<div class="form-group col-md-12 col-sm-12 col-xs-12 text-center">
		<div class="click_btn btn btn-primary click_three">3</div>
	</div>
	<div class="form-group col-md-4 col-sm-4 col-xs-12">
		<div class="single_ad_panel panel panel-default">
			<div class="panel-body">
				<?php 
				if($jobs['5']['type'] == '0'){?>
					<a href="<?php echo $jobs['5']['link'];?>"><img src="images/job/<?php echo $jobs['5']['image'];?>" style="width:100%;"  alt="" /></a>
				<?php }else if($jobs['5']['type'] == '1'){ 
					 echo urldecode($jobs['5']['script']);
				}
				?>
			</div>
		</div>
	</div>
	<div class="form-group col-md-4 col-sm-4 col-xs-12">
		<div class="single_ad_panel panel panel-default">
			<div class="panel-body">
				<?php 
				if($jobs['6']['type'] == '0'){?>
					<a href="<?php echo $jobs['6']['link'];?>"><img src="images/job/<?php echo $jobs['6']['image'];?>" style="width:100%;"  alt="" /></a>
				<?php }else if($jobs['6']['type'] == '1'){ 
					 echo urldecode($jobs['6']['script']);
				}
				?>
			</div>
		</div>
	</div>
	<div class="form-group col-md-4 col-sm-4 col-xs-12">
		<div class="single_ad_panel panel panel-default">
			<div class="panel-body">
				<?php 
				if($jobs['7']['type'] == '0'){?>
					<a href="<?php echo $jobs['7']['link'];?>"><img src="images/job/<?php echo $jobs['7']['image'];?>" style="width:100%;"  alt="" /></a>
				<?php }else if($jobs['7']['type'] == '1'){ 
					 echo urldecode($jobs['7']['script']);
				}
				?>
			</div>
		</div>
	</div>
	<div class="form-group col-md-4 col-sm-4 col-xs-12">
		<div class="single_ad_panel panel panel-default">
			<div class="panel-body">
				<?php 
				if($jobs['8']['type'] == '0'){?>
					<a href="<?php echo $jobs['8']['link'];?>"><img src="images/job/<?php echo $jobs['8']['image'];?>" style="width:100%;"  alt="" /></a>
				<?php }else if($jobs['8']['type'] == '1'){ 
					 echo urldecode($jobs['8']['script']);
				}
				?>
			</div>
		</div>
	</div>
	<div class="form-group col-md-4 col-sm-4 col-xs-12">
		<div class="single_ad_panel panel panel-default">
			<div class="panel-body">
				<?php 
				if($jobs['9']['type'] == '0'){?>
					<a href="<?php echo $jobs['9']['link'];?>"><img src="images/job/<?php echo $jobs['9']['image'];?>" style="width:100%;"  alt="" /></a>
				<?php }else if($jobs['9']['type'] == '1'){ 
					 echo urldecode($jobs['9']['script']);
				}
				?>
			</div>
		</div>
	</div>
	<div class="form-group col-md-4 col-sm-4 col-xs-12">
		<div class="single_ad_panel panel panel-default">
			<div class="panel-body">
				<?php 
				if($jobs['10']['type'] == '0'){?>
					<a href="<?php echo $jobs['10']['link'];?>"><img src="images/job/<?php echo $jobs['10']['image'];?>" style="width:100%;"  alt="" /></a>
				<?php }else if($jobs['10']['type'] == '1'){ 
					 echo urldecode($jobs['10']['script']);
				}
				?>
			</div>
		</div>
	</div>
	<div class="form-group col-md-12 col-sm-12 col-xs-12 text-center">
		<div class="click_btn btn btn-primary click_four">4</div>
	</div>
		<div class="form-group col-md-12 col-sm-12 col-xs-12">
		<div class="single_ad_panel panel panel-default">
			<div class="panel-body">
				<?php 
				$adid = 5;
				//print_r($adid);
				if(get_table_data_single_row('banners','id',$adid,'type') == '2'){?>
					<a href="<?php echo get_table_data_single_row('banners','id',$adid,'link');?>"><img src="images/ads/<?php echo get_table_data_single_row('banners','id',$adid,'image');?>" style="width:100%;"  alt="" /></a>
				<?php }else if(get_table_data_single_row('banners','id',$adid,'type') == '1'){
					 echo urldecode(get_table_data_single_row('banners','id',$adid,'script'));
				}?>
			</div>
		</div>
	</div>
	<div class="clearfix"></div>
	<div class="form-group text-center">
		<span class="next_page_error"></span>
	</div>
	<div class="form-group text-center">
		<div class="btn btn-warning page_other_next_btn next_btn " style="display:none;"  value="<?php echo $_SESSION['page'];?>" >Go To Next Step</div>
	</div>
	<div class="form-group text-center">
		<nav>
		  <ul class="pagination">
			<li class="<?php if($page == 2){echo 'active';}?>">
			  <span>1 <span class="sr-only">(current)</span></span>
			</li>
			<li class="<?php if($page == 3){echo 'active';}?>">
			  <span>2 <span class="sr-only">(current)</span></span>
			</li>
			<li class="<?php if($page == 4){echo 'active';}?>">
			  <span>3 <span class="sr-only">(current)</span></span>
			</li>
			<li class="<?php if($page == 5){echo 'active';}?>">
			  <span>4 <span class="sr-only">(current)</span></span>
			</li>
			<li class="<?php if($page == 6){echo 'active';}?>">
			  <span>5 <span class="sr-only">(current)</span></span>
			</li>
			<li class="<?php if($page == 7){echo 'active';}?>">
			  <span>6 <span class="sr-only">(current)</span></span>
			</li>
			<li class="<?php if($page == 8){echo 'active';}?>">
			  <span>7 <span class="sr-only">(current)</span></span>
			</li>
			<li class="<?php if($page == 9){echo 'active';}?>">
			  <span>8 <span class="sr-only">(current)</span></span>
			</li>
			<li class="<?php if($page == 10){echo 'active';}?>">
			  <span>9 <span class="sr-only">(current)</span></span>
			</li>
			<li class="<?php if($page == 11){echo 'active';}?>">
			  <span>10 <span class="sr-only">(current)</span></span>
			</li>
		  </ul>
		</nav>
	</div>
  <?php }}else if($ability == 0){?>
	<br />
	<div class="form-group text-center">
		<div class="btn btn-warning page_one_first_heading_text">View anyone Ad for 20 seconds</div>
	</div>
	<div class="form-group col-md-5 col-sm-5 col-xs-12">
		<div class="single_ad_panel panel panel-default">
			<div class="panel-body">
				<?php 
				if($jobs['1']['type'] == '0'){?>
					<a href="<?php echo $jobs['1']['link'];?>"><img src="images/job/<?php echo $jobs['1']['image'];?>" style="width:100%;"  alt="" /></a>
				<?php }else if($jobs['1']['type'] == '1'){ 
					 echo urldecode($jobs['1']['script']);
				}
				?>
			</div>
		</div>
	</div>
	<div class="form-group col-md-2 col-sm-2 col-xs-12 text-center">
		<div class="click_btn btn btn-primary click_one">1</div>
	</div>
	<div class="form-group col-md-5 col-sm-5 col-xs-12">
		<div class="single_ad_panel panel panel-default">
			<div class="panel-body">
				<?php 
				if($jobs['2']['type'] == '0'){?>
					<a href="<?php echo $jobs['2']['link'];?>"><img src="images/job/<?php echo $jobs['2']['image'];?>" style="width:100%;"  alt="" /></a>
				<?php }else if($jobs['2']['type'] == '1'){
					 echo urldecode($jobs['2']['script']);
				}
				?>
			</div>
		</div>
	</div>
	<div class="col-md-12 col-sm-12 col-xs-12"><h1><?php echo $content['heading'];?></h1></div>
	<div class="clearfix"></div>
	<br />
	<div class="form-group col-md-5 col-sm-5 col-xs-12">
		<div class="single_ad_panel panel panel-default">
			<div class="panel-body" />
		</div>
	</div>
	<div class="form-group col-md-2 col-sm-2 col-xs-12 text-center">
		<div class="click_btn btn btn-primary click_two">2</div>
	</div>
	<div class="form-group col-md-5 col-sm-5 col-xs-12">
		<div class="single_ad_panel panel panel-default">
			<div class="panel-body">
				<?php 
				if($jobs['4']['type'] == '0'){?>
					<a href="<?php echo $jobs['4']['link'];?>"><img src="images/job/<?php echo $jobs['4']['image'];?>" style="width:100%;"  alt="" /></a>
				<?php }else if($jobs['4']['type'] == '1'){ 
					 echo urldecode($jobs['4']['script']);
				}
				?>
			</div>
		</div>
	</div>
	<div class="col-md-12 col-sm-12 col-xs-12"><?php echo $content['text_1'];?></div>
	<div class="clearfix"></div>
	<br />
	
		<input type="hidden" id="task_time_now" value="<?php echo $time;?>"   />
		
		<div class="form-group text-center">
			<div class="btn btn-warning page_one_first_heading_text">Please wait <span id="" >
		<?php 
		$new_time = ($time + api_request('dynamics','task_gap')) - time();
		echo date('i',$new_time).' Minutes '.date('s',$new_time).' Seconds';
		?>
		for next work in this site</span></div>
		</div>
  <?php }?>
  
  </div>
  <div class="clearfix"></div>
<?php 
  include 'include/footer.php';
?>
