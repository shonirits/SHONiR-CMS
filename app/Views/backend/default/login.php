<?php echo view('backend/'.$cc['backend_theme'].'/common/page_start'); ?>
  <head>
  <?php echo view('backend/'.$cc['backend_theme'].'/common/head');?>
  </head>
  <body><?php echo view('backend/'.$cc['backend_theme'].'/common/body_start');?>
<div class="bg-light py-3 py-md-5">
  <div class="container">
    <div class="row justify-content-md-center">
      <div class="col-12 col-md-11 col-lg-8 col-xl-7 col-xxl-6">
        <div class="bg-white p-4 p-md-5 rounded shadow-sm">
          <div class="row">
            <div class="col-12">
              <div class="text-center mb-5">
              <h2> User Login </h2>
              </div>
            </div>
          </div>
          <form name="login_frm" id="login_frm" class="row g-3" action="<?php echo $cc['base_url'].'Users/'.$key; ?>" method="POST" novalidate>
          <?php echo csrf_field(); ?>
          <input type="hidden" name="continue" value="<?php echo $continue; ?>">
          <input type="hidden" name="captcha_token" value="<?php echo $captcha_token; ?>">
            <div class="row gy-3 gy-md-4 overflow-hidden">
              <div class="col-12">
                <label for="email" class="form-label">Email <span class="text-danger">*</span></label>
                <div class="input-group">
                <span class="input-group-text">
                <i class="fa-solid fa-at"></i>
                  </span>
                  <input type="email" class="form-control" name="email" id="email" required>
                </div>
              </div>
              <div class="col-12">
                <label for="password" class="form-label">Password <span class="text-danger">*</span></label>
                <div class="input-group">
                  <span class="input-group-text">
                  <i class="fa-solid fa-key"></i>
                  </span>
                  <input type="password" class="form-control" name="password" id="password" value="" required>
                </div>
              </div>
              <div class="col-12 p-1 text-center">
                        <label for="captcha_code" class="text-center p-2"><b>CAPTCHA</b></label>
                        <div class="col-12 p-1 text-center"><img src="<?php echo $cc['base_url'].'Tools/captcha_image/'.$captcha_token; ?>" ></div>
                        <div class="input-group">
                  <span class="input-group-text">
                  <i class="fa-solid fa-fingerprint"></i>
                  </span>
                  <input type="text" class="form-control" name="captcha_code" id="captcha_code" required>
                </div>
              </div>
              <div class="col-12">
                <div class="d-grid">
                  <button class="btn btn-primary btn-lg" type="submit">Log In</button>
                </div>
              </div>
            </div>
          </form>
          <div class="row">
            <div class="col-12">
              <hr class="mt-5 mb-4 border-secondary-subtle">
              <div class="d-flex gap-2 gap-md-4 flex-column flex-md-row justify-content-md-center">
                <a href="#!" class="link-secondary text-decoration-none">Create new account</a>
                <a href="#!" class="link-secondary text-decoration-none">Forgot password</a>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>
</div>
<?php echo view('backend/'.$cc['backend_theme'].'/common/footer');?>
<?php echo view('backend/'.$cc['backend_theme'].'/common/body_end');?>
<script>
(function () {  
            'use strict';  
            window.addEventListener('load', function () {  
                var form = document.getElementById('login_frm');                 
                form.addEventListener('submit', function (event) {  
                    if (form.checkValidity() === false) {  
                        event.preventDefault();  
                        event.stopPropagation();  
                      }else{
                        overlay_fnc(form);
                        p(form).find(':button').prop('disabled', true);
                      }   
                    form.classList.add('was-validated');  
                }, false);
            }, false);  
        })(); 
 </script>
</body>
<?php echo view('backend/'.$cc['backend_theme'].'/common/page_end');?>