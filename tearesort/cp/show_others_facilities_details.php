<?php
include("config/dbconnect.php");
include("login_check.php");
error_reporting(0);

//Slider Images Delete Panel
if(isset($_GET['del'])){
	$sid = preg_replace('#[^0-9]#i','',$_GET['del']);

	$sdel = mysqli_query($con,"DELETE FROM facilities_details where id='$sid'");
	 
	 if ($sdel) {
			$msg = "Successfully Deleted-:)";
		} else {
			$msg = "Delete Error!!.";
		} 
}
?>
<!DOCTYPE html>
<head>
<title>All Facilities Details Contents || Tea Resort & Museum</title>
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
      All Facilities Contents
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
	<div class="row w3-res-tb">     
	  <div class="col-sm-6 m-b-xs">
        <select onchange="getFacilitiesDetails(this.value);" id="fatitle" class="input-md form-control w-md inline v-middle">
          <option>Select Facilities Name</option>
					<?php
						$sqlf = mysqli_query($con,"SELECT id,title FROM facilities");
						while($fraw = mysqli_fetch_array($sqlf)){
					?>
					<option value="<?php echo $fraw['id'];?>"><?php echo $fraw['title'];?></option>
					<?php
						}
					?>
				</select>  
		</div>
	  <div class="col-sm-6">
      </div>
    </div>
    <div class="table-responsive">
      <table class="table table-striped b-t b-light table-hover">
        <thead>
          <tr class="bg-warning">
            <th style="width:20px;">
              Sl
            </th>
            <th>Images</th>
            <th>Title</th>
            <th>Upload Date</th>
            <th style="width:15px;">Edit</th>
            <th style="width:15px;">Delete</th>
          </tr>
        </thead>
        <tbody id="allvalue">
			<?php
				$num = 0;
				$select = mysqli_query($con,"SELECT * FROM facilities_details");
				while($data = mysqli_fetch_array($select)){
					$num++;
			?>
          <tr>
            <td><?php echo $num; ?></td>
            <td><img class="img-responsive img-rounded" style="max-height:50px" src="images/facilities_details/<?php echo $data['image'];?>"></td>
            <td><?php echo $data['title'];?></td>
            <td><?php echo date("d-m-Y",strtotime($data['datetime']));?></td>
            <td>
              <a href="edit_facilities_details.php?edt=<?php echo $data['id'];?>" class="active" ui-toggle-class=""><i class="fa fa-edit text-success text-active"></i></a>
            </td>
			<td>
              <a href="?del=<?php echo $data['id'];?>" onclick="return confirm('Do you want to delete?')" class="active" ui-toggle-class=""><i class="fa fa-trash text-danger text"></i></a>
            </td>
          </tr>
		  <?
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
<script type="text/javascript">
	function getFacilitiesDetails(val){		
		$.ajax({
			type: "POST",
			url: "getFacilitiesDetails.php",
			data: "fid="+val,
			success: function(data){
				$("#allvalue").html(data);
			}
		});
	}
</script>
</body>
</html>