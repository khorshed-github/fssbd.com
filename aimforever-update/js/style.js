$(document).ready(function(){$(".header-login-btn").click(function(){$(".login-area").toggleClass("login-area-0")}),$(".flexslider").flexslider({animation:"slide",itemMargin:0,prevText:"&#xeb87;",nextText:"&#xeb88;",animation:"fade",easing:"swing",slideshowSpeed:4e3,animationSpeed:1e3}),$("#login_form").submit(function(e){$.ajax({type:"POST",url:"freelance/include/login.php",data:$("#login_form").serialize(),success:function(e){var i=JSON.parse(e);1==i.success?($("#login_form_error").html('<div class="alert alert-success animated fadeIn">Redirecting to Dashboard</div>'),window.setTimeout(function(){window.location.href="freelance/index.php"},3e3)):$("#login_form_error").html('<div class="alert alert-danger animated fadeIn">'+i.message+"</div>")}}),e.preventDefault()}),$("#register_form").submit(function(e){$.ajax({type:"POST",url:"freelance/include/register.php",data:$("#register_form").serialize(),success:function(e){var i=JSON.parse(e);1==i.success?($("#register_form_error").html('<div class="alert alert-success animated fadeIn">Successfully Registered </div>'),window.setTimeout(function(){window.location.href="freelance/index.php"},3e3)):$("#register_form_error").html('<div class="alert alert-danger animated fadeIn">'+i.message+"</div>")}}),e.preventDefault()})});