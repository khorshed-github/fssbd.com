<?php
include("config/dbconnect.php");
include("login_check.php");
?>
<!DOCTYPE html>
<head>
<title>User Profile || Tea Resort & Museum</title>
	<?php require("components/head.php");?>
	<style type="text/css">
		.logo{margin-top:0px !important; margin-left:0 !important; width:100%;}
	</style>
</head>
<body>
<section id="container">
<!--header start-->
<header class="header fixed-top clearfix">
<!--logo start-->
<div class="brand">
    <a href="home.php" class="logo">
        <img src="images/tea-resort-logo.jpg" class="img-responsive" alt="Tea Resort & Museum Logo">
    </a>
    <div class="sidebar-toggle-box">
        <div class="fa fa-bars"></div>
    </div>
</div>
<!--logo end-->
<div class="top-nav clearfix">
    <!--search & user info start-->
     <?php require("components/header.php");?>
    <!--search & user info end-->
</div>
</header>
<!--header end-->
<!--sidebar start-->
<aside>
    <div id="sidebar" class="nav-collapse">
        <!-- sidebar menu start-->
        <?php require("components/menu.php");?>
        <!-- sidebar menu end-->
    </div>
</aside>
<!--sidebar end-->

<!--main content start-->
<section id="main-content">
	<section class="wrapper">
		<div class="table-agile-info">
  <div class="panel panel-default">
    <div class="panel-heading">
      User Profile
    </div>
	<?php							
		if($msg){?>
		 <div class="alert alert-success" role="alert">
				<button type="button" class="close" data-dismiss="alert" aria-label="close">
					<span aria-hidden="true">&times;</span>
				</button>
				<span><strong><?php echo $msg; ?></strong></span>
		  </div>
		<?php } ?>
    <div class="table-responsive">
      <table class="table table-striped b-t b-light table-hover">
        <thead>
          <tr class="bg-warning">            
            <th>Picture</th>
            <th>Name</th>
            <th>Email</th>
            <th>Mobile</th>
            <th style="width:15px;">Edit</th>
          </tr>
        </thead>
        <tbody id="allslider">
			<?php			
			$select = mysqli_query($con,"SELECT * FROM user");
			while($data = mysqli_fetch_array($select)){
			?>
		  <tr>			
			<td><img class="img-responsive img-rounded" style="max-height:80px" src="images/user/<?php echo $data['user_pic'];?>"></td>
			<td><?php echo $data['name'];?></td>
			<td><?php echo $data['email'];?></td>
			<td><?php echo $data['mobile'];?></td>
			<td>
			  <a href="edit_profile.php?edt=<?php echo $data['id'];?>" class="active" ui-toggle-class=""><i class="fa fa-edit text-success text-active"></i></a>
			</td>			
		  </tr>
		  <?php
			}
		  ?>    
        </tbody>
      </table>
    </div>
	<!--
    <footer class="panel-footer">
      <div class="row">        
        <div class="col-sm-5 text-center">
          <small class="text-muted inline m-t-sm m-b-sm">showing 20-30 of 50 items</small>
        </div>
        <div class="col-sm-7 text-right text-center-xs">                
          <ul class="pagination pagination-sm m-t-none m-b-none">
            <li><a href=""><i class="fa fa-chevron-left"></i></a></li>
            <li><a href="">1</a></li>
            <li><a href="">2</a></li>
            <li><a href="">3</a></li>
            <li><a href="">4</a></li>
            <li><a href=""><i class="fa fa-chevron-right"></i></a></li>
          </ul>
        </div>
      </div>
    </footer>
	-->
  </div>
</div>
</section>
 <!-- footer -->
		  <?php require("components/footer.php");?>
  <!-- / footer -->
</section>
<!--main content end-->
</section>
<script src="js/bootstrap.js"></script>
<script src="js/jquery.dcjqaccordion.2.7.js"></script>
<script src="js/scripts.js"></script>
<script src="js/jquery.slimscroll.js"></script>
<script src="js/jquery.nicescroll.js"></script>
<script src="js/jquery.scrollTo.js"></script>
<!-- morris JavaScript -->	
<script>
	$(document).ready(function() {
		//BOX BUTTON SHOW AND CLOSE
	   $('.small-graph-box').hover(function() {
		  $(this).find('.box-button').fadeIn('fast');
	   }, function() {
		  $(this).find('.box-button').fadeOut('fast');
	   });
	   $('.small-graph-box .box-close').click(function() {
		  $(this).closest('.small-graph-box').fadeOut(200);
		  return false;
	   });
	   
	});
</script>
</body>
</html>