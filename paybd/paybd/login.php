<?php include 'inc/header.php';?>
<?php

	$login = Session::get("cusLogin");
	if($login==true)
	{
		echo "<script>window.location = 'profile.php';</script>";
	}
?>	
	<div class="clear">	</div>
	<div class="container">
		<div class="row">
			<div class="col-md-6 col-md-offset-3">
				<div class="panel panel-login">
					<div class="panel-heading">
						<div class="row">
							<div class="col-xs-4">
								<a href="#" class="active" id="login-form-link">Login</a>
							</div>
							<div class="col-xs-4">
								<a href="#" id="register-form-link">Register</a>
							</div>
							<div class="col-xs-4">
								<a href="#" id="forgot-form-link">Forgot Password?</a>
							</div>
						</div>
						<hr>
                        <span style="color:red;font-size: 18px;" id="register-form-link">
                            <?php
                            if (isset($cusRegister))
                            {
                                echo $msg;
                            }
                            ?>
                        </span>
					</div>

					<div class="panel-body">
						<div class="row">
							<div class="col-lg-12">
								<!--Login form start-->

								<?php
									if($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_POST['login-submit']))
									{
										$cusLogin = $cmr->customerLogin($_POST);
									}
								?>
								<?php
									if(isset($cusLogin))
									{
										echo "$cusLogin";
									}
								 ?>
								<form id="login-form" action="#" method="post" role="form" style="display: block;">
									<div class="form-group">
										<input type="text" name="usernameLogin" id="username" tabindex="1" class="form-control" placeholder="Enter your Email or Username or Mobile" value="" required>
									</div>
									<div class="form-group">
										<input type="password" name="passwordLogin" id="password" tabindex="2" class="form-control" placeholder="Password" required>
									</div>
									<div class="form-group text-center">
										<input type="checkbox" tabindex="3" class="" name="remember" id="remember">
										<label for="remember"> Remember Me</label>
									</div>
									<div class="form-group">
										<div class="row">
											<div class="col-sm-6 col-sm-offset-3">
												<input type="submit" name="login-submit" id="login-submit" tabindex="4" class="form-control btn btn-login" value="Log In">
											</div>
										</div>
									</div>
									<!--<div class="form-group">
										<div class="row">
											<div class="col-lg-12">
												<div class="text-center">
													<a href="#" tabindex="5" class="forgot-password">Forgot Password?</a>
												</div>
											</div>
										</div>
									</div>-->
								</form>
								
								<!--Login form End-->

								<!--Register form Start-->

                                <?php
                                if($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_POST['register-submit']))
                                {
                                    $cusRegister = $cmr->customerRegister($_POST);
                                }
                                ?>
                                <?php
                                if(isset($cusRegister))
                                {
                                    echo "$cusRegister";
                                    
                                }
                                ?>
								<form id="register-form" action="#" method="post" role="form" style="display: none;">

									<div class="form-group">
										<input type="text" name="usernameReg" id="username" tabindex="1" class="form-control" placeholder="Username" value="" required>
									</div>
									<div class="form-group">
										<input type="email" name="emailReg" id="email" tabindex="1" class="form-control" placeholder="Email Address" value="" required>
									</div>
									<div class="form-group">
										<input type="password" name="passwordReg" id="password" tabindex="2" class="form-control" placeholder="Password" required>
									</div>
									<div class="form-group">
										<input type="password" name="confirmPassReg" id="confirm-password" tabindex="2" class="form-control" placeholder="Confirm Password" required>
									</div>
									<div class="form-group">
										<div class="row">
											<div class="col-sm-6 col-sm-offset-3">
												<input type="submit" name="register-submit" id="register-submit" tabindex="4" class="form-control btn btn-register" value="Register Now">
											</div>
										</div>
									</div>
								</form>
								<!--Register form End-->

								
								<!--forgot password start-->
								<form id="forgot-form" action="#" method="post" role="form" style="display: none;">
									<div class="form-group">
										<input type="text" name="forgotEmail" id="forgotEmail" tabindex="1" class="form-control" placeholder="Email Address" value="" required>
									</div>
									<div class="form-group">
										<div class="row">
											<div class="col-sm-6 col-sm-offset-3">
												<input type="submit" name="forgot-submit" id="forgot-submit" tabindex="2" class="form-control btn btn-warning" value="Recover Account">
											</div>
										</div>
									</div>
								</form>
								<!--forgot password End-->
							</div>
						</div>
					</div>
				</div>
			</div>
		</div>	
	</div>
	
	<div class="clear">	</div>

	<script>
		$(function() {

			$('#login-form-link').click(function(e) {
				$("#login-form").delay(100).fadeIn(100);
				$("#register-form").fadeOut(100);
				$("#forgot-form").fadeOut(100);
				$('#register-form-link').removeClass('active');
				$('#forgot-form-link').removeClass('active');
				$(this).addClass('active');
				e.preventDefault();
			});
			$('#register-form-link').click(function(e) {
				$("#register-form").delay(100).fadeIn(100);
				$("#login-form").fadeOut(100);
				$("#forgot-form").fadeOut(100);
				$('#login-form-link').removeClass('active');
				$('#forgot-form-link').removeClass('active');
				$(this).addClass('active');
				e.preventDefault();
			});
			$('#forgot-form-link').click(function(e) {
				$("#forgot-form").delay(100).fadeIn(100);
				$("#login-form").fadeOut(100);
				$("#register-form").fadeOut(100);
				$('#login-form-link').removeClass('active');
				$('#register-form-link').removeClass('active');
				$(this).addClass('active');
				e.preventDefault();
			});

		});
	</script>

<?php include 'inc/footer.php';?>