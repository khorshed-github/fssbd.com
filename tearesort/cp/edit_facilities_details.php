<?php
include("config/dbconnect.php");
include("login_check.php");
	$sid = preg_replace('#[^0-9]#i','',$_GET['edt']);
	$sdel = mysqli_query($con,"SELECT * FROM facilities_details WHERE id='$sid'");
	$objs = mysqli_fetch_object($sdel);
		$id = $objs->id;
		$title = $objs->title;
		$description = $objs->description;
		$image = $objs->image;

//Slider Images Edit Panel
if(isset($_POST['submit'])){	
$uploadOk = 0;
	$fsid=trim($_POST["id"]);
	$ip = $_SERVER["REMOTE_ADDR"];
	$title = trim($_POST["title"]);
	$description = trim(str_replace("'","~",$_POST["description"]));
	$fileName = rand()."_".$_FILES["fileToUpload"]["name"];
	$tmpName = $_FILES["fileToUpload"]["tmp_name"];
	$size = $_FILES["fileToUpload"]["size"];

	$target_dir = "images/facilities_details/";
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
       move_uploaded_file($tmpName, $target_file); 
	}
		$select = mysqli_query($con,"UPDATE facilities SET title='$title',description='$description',image='$fileName',userid='$loggedId',ip='$ip',datetime=CURRENT_TIMESTAMP WHERE id='$fsid'");
			
			mysqli_close($con);
			
	 if ($select)	
		{
			$msg = "Successfully Edited-:)";
		} else {
			$msg = "Edit Error!!.";
		}
}
?>
<!DOCTYPE html>
<head>
<title>Edit Facilities Details || Tea Resort & Museum</title>
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
                            Front Page Facilities Details Edit
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
                                    <label for="exampleInputEmail1">Title</label>
                                    <input type="text" value="<?php echo $title;?>" name="title" required="required" class="form-control" placeholder="Enter title">
                                </div>
                                 <div class="form-group">
                                    <label for="exampleInputEmail1">Facilities Short Description</label>
                                    <textarea name="description" required="required" class="form-control" placeholder="Enter title"><?php echo $description;?></textarea>
                                </div>
                                <div class="form-group">
                                    <label for="exampleInputFile">Attach Image</label>
                                   	<input type="file" value="<?php echo $image;?>" name="fileToUpload" required="required" class="form-control" id="formGroupExampleInput">
                                </div>
								
                               <div class="alert alert-warning" role="alert">
									<button type="button" class="close" data-dismiss="alert" aria-label="close">
										<span aria-hidden="true">&times;</span>
									</button>
									<span>Image Max Size<strong>(778 X 558)</strong> AND Type <strong>(jpg,jpeg,png,gif)</strong>.</span>
							  </div>
                                 <div class="form-group">
									<input type="hidden" name="id" value="<?php echo $id;?>">
									<input type="submit" onclick="return confirm('Do you want to Edit?')" name="submit" class="btn btn-outline-info" value="Submit" />
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