<?php echo view('frontend/'.$cc['frontend_theme'].'/common/page_start'); ?>
  <head>
  <?php echo view('frontend/'.$cc['frontend_theme'].'/common/head');?>
  </head>
  <body id="body"><?php echo view('frontend/'.$cc['frontend_theme'].'/common/body_start');?>
  <?php echo view('frontend/'.$cc['frontend_theme'].'/common/header');?>

   <!-- Theme Breadcrumb Start
================================================== -->

  <section class="container-fluid t-breadcrumb wow wobble">
	<div class="container">
		<div class="row">
			<div class="col-md-12">
				<div class="content">
					<h1 class="page-name"><?php echo $row['name'];?></h1>
                  <nav aria-label="breadcrumb">
          <ol class="breadcrumb">
            <li class="breadcrumb-item"><a href="<?php echo $cc['base_url'];?>">Home</a></li>
            <li class="breadcrumb-item active" aria-current="page"><?php echo $row['name'];?></li>
          </ol>
        </nav>
				</div>
			</div>
		</div>
	</div>
</section>

<!-- Theme Breadcrumb End
================================================== -->

  <!-- Theme Content Start
================================================== -->
<section class="container-fluid t-contact">
  <div class="container wow swing">
    <div class="row">
      <div class="col-12 py-4">
        <?php echo $row['spotlight'] ?>
      </div>
    </div>
  </div>

  <div class="map-wrapper wow rotateIn">
    <iframe src="<?php echo $cc['social_map']; ?>" width="100%" height="700" style="border:0;" allowfullscreen="" loading="lazy" referrerpolicy="no-referrer-when-downgrade"></iframe>
  </div>

  <div class="contact-position py-4 wow pulse">
    <div class="contact_frm container">
      <div class="row mb-4">
        <div class="col-12 text-center">
          <h2 class="t-heading text-center"><?php echo $row['title'] ?></h2>
        </div>
      </div>

      <div class="row">
        <div class="col-lg-6 col-md-12 p-3 mb-4 order-2 order-lg-1 wow bounceIn">
          <?php echo $row['description'] ?>
        </div>

        <div class="col-lg-6 col-md-12 p-3 order-1 order-lg-2 wow bounceIn" id="contact_frm_zone">
          <form name="contact_frm" id="contact_frm" action="<?php echo $cc['base_url'].'Contact'; ?>" method="POST" role="form" novalidate>
<input type="hidden" name="captcha_token" id="captcha_token" value="">
  <div class="mb-3">
      <label for="name" class="form-label">
        <i class="fa-solid fa-user"></i> Your Name
      </label>
      <input type="text" class="form-control" id="name" name="name" placeholder="Enter your name" required>
      <div class="invalid-feedback">Name is required.</div>
  </div>

  <div class="mb-3">
      <label for="email" class="form-label">
        <i class="fa-solid fa-envelope"></i> Email
      </label>
      <input type="email" class="form-control" id="email" name="email" placeholder="Enter your email" required>
      <div class="invalid-feedback">Valid email is required.</div>
  </div>

  <div class="mb-3">
   <label for="phone" class="form-label">
        <i class="fa-brands fa-whatsapp"></i> WhatsApp
      </label>
      <input type="text" class="form-control" id="phone" name="phone" placeholder="+92xxxxxxxxxx" required>
      <div class="invalid-feedback">WhatsApp number is required.</div>
  </div>

  <div class="mb-3">
    <label for="subject" class="form-label">
      <i class="fa-solid fa-comment-dots"></i> Subject
    </label>
    <input type="text" class="form-control" id="subject" name="subject" placeholder="What's the subject?" required>
    <div class="invalid-feedback">Subject is required.</div>
  </div>

  <div class="mb-3">
    <label for="message" class="form-label">
      <i class="fa-solid fa-pencil"></i> Message
    </label>
    <textarea class="form-control" id="message" name="message" rows="4" placeholder="Type your message here" required></textarea>
    <div class="invalid-feedback">Message is required.</div>
  </div>

  <div class="row mb-3">
  <div class="col-12 col-md-6 d-flex flex-column justify-content-center">
    <label for="captcha" class="form-label">
      <i class="fa-solid fa-shield-halved"></i> CAPTCHA Code
    </label>
    <img id="captcha_image" data-src="<?php echo $cc['base_url'].'Tools/captcha_image/'; ?>" alt="CAPTCHA" class="rounded shadow-sm mb-2 captcha_image" >
  </div>
  <div class="col-12 col-md-6 d-flex align-items-center">
    <input type="text" class="form-control" id="captcha_code" name="captcha_code" placeholder="Enter CAPTCHA" required>
    <div class="invalid-feedback">Please enter the CAPTCHA code.</div>
  </div>
</div>

  <div class="d-grid">
    <button type="submit" class="btn btn-primary hvr-radial-out">
      <i class="fa-solid fa-paper-plane"></i> Send Message
    </button>
  </div>
</form>
        </div>
      </div>
    </div>
  </div>
</section>

<!-- Theme Content End
================================================== -->
  <?php echo view('frontend/'.$cc['frontend_theme'].'/common/footer');?>
<?php echo view('frontend/'.$cc['frontend_theme'].'/common/body_end');?>
<script>
(function () {
  'use strict';
  window.addEventListener('load', function () {
    var form = document.getElementById('contact_frm');
    form.addEventListener('submit', function (event) {
      if (form.checkValidity() === false) {
        event.preventDefault();
        event.stopPropagation();
      } else {
        event.preventDefault();
        overlay_fnc(form);
        p(form).find(':button').prop('disabled', true);
        var formData = p(form).serialize();
        p.ajax({
          url: '<?php echo $cc['base_url'].'Ajax/contact'; ?>', 
          type: 'POST',
          headers: {'X-Requested-With': 'XMLHttpRequest'},
          data: formData,
          dataType: 'json',
          success: function (response, status, xhr) {
            if(response.status && response.data){
            if(response.status === 'TRUE'){              
            d('#contact_frm_zone').html('<div class="alert alert-success my-3" role="alert">'+response.data.alert+'</div>');
            } else if(response.status === 'FALSE'){

              p('#captcha_token').val(response.data.captcha_token);
              p('#captcha_code').val('');

              p('#captcha_image').attr('src', '<?php echo $cc['base_url'].'Tools/captcha_image/'; ?>'+response.data.captcha_token);
              
            d('#contact_frm_zone').append('<div class="alert alert-danger alert-dismissible fade show my-3" role="alert">'+response.data.alert+'<button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></div>');
              form.classList.remove('was-validated');
            p(form).find(':button').prop('disabled', false);
            p(form).LoadingOverlay("hide");
             event.stopPropagation();

            } else{

              d('#contact_frm_zone').append('<div class="alert alert-danger alert-dismissible fade show my-3" role="alert"><b>Oops!</b> Something went wrong. Please refresh the page and try submitting your message again. </div>');
              form.classList.remove('was-validated');
             event.stopPropagation();
              p(form).LoadingOverlay("hide");

            }

            }else{

              dump_fnc(response);

             d('#contact_frm_zone').append('<div class="alert alert-danger alert-dismissible fade show my-3" role="alert">Uh-oh! We weren’t able to process your message. A quick refresh should fix it — then please try again.</div>');
              form.classList.remove('was-validated');
             event.stopPropagation();
             p(form).LoadingOverlay("hide");

            }          
          }
          
        });
      }
      form.classList.add('was-validated');
    }, false);
  }, false);
})();
</script> 
</body>
<?php echo view('frontend/'.$cc['frontend_theme'].'/common/page_end');?>
<script >
function content_fnc(){
   var wait_to_all_loaded = setInterval(() => {
    if (all_loaded != false) {
clearInterval(wait_to_all_loaded);  
    p.ajax({
    url: `${ccp.base_url}Ajax/captcha_token`,
    type: 'POST',
    headers: { 'X-Requested-With': 'XMLHttpRequest' },
    dataType: 'json',
    success: function(response) {
      if (response.status === 'TRUE' && response.data.captcha_token) {
        let newToken = response.data.captcha_token;
        p(`#captcha_token`).val(newToken);
        p(`#captcha_image`).attr('src', `${ccp.base_url}Tools/captcha_image/${newToken}`);
      }
    },
    error: function() {
      console.error('Failed to load captcha token');
    }
  });
    }
}, 1000);
}
</script>