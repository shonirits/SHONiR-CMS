<!doctype html>
<html lang="en">
  <head>
  <?php require_once('common/head.php');?>
  <title><?php echo $SHONiR_Main['meta_title'] ?></title>
<meta name="description" content="<?php echo $SHONiR_Main['meta_description'] ?>">
<meta name="keywords" content="<?php echo $SHONiR_Main['meta_keyword'] ?>" />
  </head>
  <body><?php require_once('common/start.php');?>

  <section class="login-block">
    <div class="container">
	<div class="row">
		<div class="col-md-4 login-sec">
		    <h2 class="text-center">Administrator</h2>
		    <form class="login-form" name="SHONiR_Login_Frm" id="SHONiR_Login_Frm">
        <input type="hidden" name="continue" id="continue" value="<?php echo SHONiR_Get_Fnc('continue') ?>">
  <div class="form-group">
    <label for="username" class="text-uppercase">Username</label>
    <input type="text" class="form-control" name="username" id="username" placeholder="" value="<?php echo $SHONiR_Main['username'] ?>">
    
  </div>
  <div class="form-group">
    <label for="password" class="text-uppercase">Password</label>
    <input type="password" class="form-control" name="password" id="password" placeholder="" value="<?php echo $SHONiR_Main['password'] ?>">
  </div>
  
  
    <div class="form-check">
    <label class="form-check-label">
      <input type="checkbox" name="remember" id="remember" value="1" class="form-check-input">
      <small>Remember Me</small>
    </label>
    <button type="button" class="btn btn-login float-right" onclick="SHONiR_Login_Fnc();">Login</button>
  </div>
  
</form>
<div class="copy-text">Created with <i class="fa fa-heart"></i> by <b><a href="http://www.shonir.com">SHONiR</a></b></div>
		</div>
		<div class="col-md-8 banner-sec">
            <div id="Indicators" class="carousel slide" data-ride="carousel">
                 <ol class="carousel-indicators">
                    <li data-target="#Indicators" data-slide-to="0" class="active"></li>
                    <li data-target="#Indicators" data-slide-to="1"></li>
                    <li data-target="#Indicators" data-slide-to="2"></li>
                  </ol>
            <div class="carousel-inner" role="listbox">
    <div class="carousel-item active">
      <img class="d-block img-fluid" src="media/backend/web-promotion.jpg" alt="">
      <div class="carousel-caption d-none d-md-block">
        
  </div>
    </div>
    <div class="carousel-item">
      <img class="d-block img-fluid" src="media/backend/get-email.jpg" alt="">
      <div class="carousel-caption d-none d-md-block">
        
    </div>
    </div>
    <div class="carousel-item">
      <img class="d-block img-fluid" src="media/backend/web-packages.jpg" alt="">
      <div class="carousel-caption d-none d-md-block">
        	
    </div>
  </div>
            </div>	   
		    
		</div>
	</div>
</div>
</section>

    
    <?php require_once('common/end.php');?>

    <script>
    
    p('.carousel').carousel({
    interval: 2000
  })
  
    </script>
 
  </body>
</html><?php
require_once('common/clear.php');
?>