<?php
include("config/dbconnect.php");
include("login_check.php");
//Slider Images Change Panel
if(isset($_POST['submit'])){
$uploadOk = 0;
	$ip = $_SERVER["REMOTE_ADDR"];
	$facid = trim($_POST["facid"]);
	$title = trim($_POST["title"]);
	$fileName = rand()."_".$_FILES["fileToUpload"]["name"];
	$tmpName = $_FILES["fileToUpload"]["tmp_name"];
	$size = $_FILES["fileToUpload"]["size"];

	$target_dir = "images/facilities_slider/";
	$target_file = $target_dir . basename($fileName);

	$imageFileType = strtolower(pathinfo($target_file,PATHINFO_EXTENSION));

	// Check if file already exists
	if (file_exists($target_file)) {
		$uploadOk = 1;
	}
	// Check file size
	if ($size > 500000000) {
		$uploadOk = 2;
	}
	// Allow certain file formats
	if($imageFileType != "jpg" && $imageFileType != "png" && $imageFileType != "jpeg"
	&& $imageFileType != "gif" ) {
		$uploadOk = 3;
	}
	
	// Check if $uploadOk is set to 0 by an error
	switch ($uploadOk) {		
    case 1:
        $msg = "Sorry, Image already exists. Plz Change Image Name.";
        break;
		
    case 2:
        $msg = "Sorry, your image is too large.";
        break;
		
    case 3:
       $msg = "Sorry, only JPG, JPEG, PNG & GIF files are allowed.";
        break;
		
    default:
	// if everything is ok, try to upload file
        if (move_uploaded_file($tmpName, $target_file)) {
			
			mysqli_query($con,"INSERT INTO facilities_slider(facilities_id,title,image,userid,ip,datetime,status)
			VALUES('$facid','$title','$fileName','$loggedId','$ip',CURRENT_TIMESTAMP,1)");
			
			mysqli_close($con);	
			
			$msg = "Successfully Save-:)";
		} else {
			$msg = "Save Error!!.";
		}
	}
}
?>
<!DOCTYPE html>
<head>
<title>Add Facilities Page Slider || Tea Resort & Museum</title>
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
		<div class="row">		
			<div class="col-lg-12">
                    <section class="panel">
                        <header class="panel-heading">
                            Facilities Page Slider
                        </header>
                        <div class="panel-body">
                            <div class="position-center">
							<?php							
							if($msg){?>
							 <div class="alert alert-success" role="alert">
									<button type="button" class="close" data-dismiss="alert" aria-label="close">
										<span aria-hidden="true">&times;</span>
									</button>
									<span><strong><?php echo $msg; ?></strong></span>
							  </div>
							<?php } ?>
                               <form method="post" enctype="multipart/form-data">
							   <div class="form-group">
									<select class="form-control m-bot15" name="facid" required="required">
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
							   
                                <div class="form-group">
                                    <label for="sliderTitle">Slider Title</label>
                                    <input type="text" name="title" required="required" class="form-control" placeholder="Enter title">
                                </div>
                                
                                <div class="form-group">
                                    <label for="AttachFile">Attach Image</label>
                                   	<input type="file" name="fileToUpload" required="required" class="form-control" id="formGroupExampleInput">
                                </div>
								
                               <div class="alert alert-warning" role="alert">
									<button type="button" class="close" data-dismiss="alert" aria-label="close">
										<span aria-hidden="true">&times;</span>
									</button>
									<span>Image Max Size<strong>(1700 X 850)</strong> AND Type <strong>(jpg,jpeg,png,gif)</strong>.</span>
							  </div>
                                 <div class="form-group">
									<input type="submit" name="submit" class="btn btn-outline-info" value="UPLOAD" />
									<input type="reset" class="btn btn-outline-success" value="Reset" />
								  </div>
                            </form>
                            </div>

                        </div>
						<button type="button" class="btn btn-outline-primary btn-sm btn-right" onclick="goBack();">Go Back</button>
                    </section>

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