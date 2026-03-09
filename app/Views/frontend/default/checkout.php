<?php echo view('frontend/'.$cc['frontend_theme'].'/common/page_start'); ?>
  <head>
  <?php echo view('frontend/'.$cc['frontend_theme'].'/common/head');?>
  </head>
  <body id="body"><?php echo view('frontend/'.$cc['frontend_theme'].'/common/body_start');?>

  <!-- Theme Cart Header Start
================================================== -->

 <section class="container-fluid cart">
<div class="container">
		<div class="row">
			<div class="col-md-12 logo text-center">
				<a href="<?php echo $cc['base_url']; ?>" title="<?php echo $cc['app_name']; ?>">
					<img data-src="<?php echo $cc['img_url'].'public/images/frontend/'.$cc['frontend_theme'].'/logo.webp'; ?>" class="img-fluid" alt="<?php echo $cc['app_name']; ?>" />
					</a>      
			</div>
		</div>
	</div>
</section>
<!-- Theme Cart Header End
================================================== -->


<!-- Theme Cart Notice Start
================================================== -->

 <section class="container-fluid cart">
<div class="container notice">
		<div class="row">
			<div class="col-md-12 ">
				  <div class="alert alert-info" role="alert">
  <b>Before you submit, here’s a quick reassurance:</b> No payment is required at this stage — only personalized service built on trust. All details you provide will be used exclusively to craft your custom quotation. Your email and WhatsApp contact are kept strictly private, and will only be used if we need clarification to tailor your quote perfectly. We never share or sell your data. 
  <br><br>
  🔒 <strong>Secure. Confidential. Commitment-Free.</strong>  
  Begin your custom journey with confidence — explore freely, ask questions, and enjoy risk-free quoting with no strings attached.
</div>   
			</div>
		</div>
		<div class="row bullets">
			<div class="col-md-3 py-2">
				<i class="fa-solid fa-circle-check"></i> Verified Supplier
		</div>
    <div class="col-md-3 py-2">
				<i class="fa-solid fa-circle-check"></i> Global Dispatch Partner
		</div>
    <div class="col-md-3 py-2">
				<i class="fa-solid fa-circle-check"></i> Your Gear, Your Way
		</div>
		<div class="col-md-3 py-2">
				<i class="fa-solid fa-circle-check"></i> No Pressure, Just Possibilities
		</div>	
		</div>		
	
	<div class="row">
		<div class="col-md-12 py-2">
			<hr>
		</div>	
	</div>
	</div>
</section>
<!-- Theme Cart Notice End
================================================== -->

  <!-- Theme Content Start
================================================== -->

<section class="container-fluid cart">
  <?php if (!empty($carts_items) && is_array($carts_items)) {?>
	<div class="container">
    <form name="checkout_frm" id="checkout_frm" action="<?php echo $cc['base_url'].'Checkout'; ?>" method="POST" role="form" novalidate>
<input type="hidden" name="checkout" id="checkout" value="<?php echo $checkout; ?>">
<input type="hidden" name="do" id="do" value="send">
<input type="hidden" name="captcha_token" id="captcha_token" value="<?php echo $captcha_token; ?>">
		<div class="row">
			<div class="col-12 py-2">
  <div class="row align-items-center">
    <div class="col-12 col-md-6">
      <h1 class="m-0">
        <i class="fa-solid fa-cart-shopping icon"></i> Finalize Quote Request
      </h1>
    </div>
    <div class="col-12 col-md-6 text-md-end mt-2 mt-md-0">
      <a href="<?php echo $cc['base_url'].'all.html'; ?>" class="btn btn-outline-primary">View All Items</a>
      <a href="<?php echo $cc['base_url'].'Cart'; ?>" class="btn btn-outline-dark ms-2">Back To Cart</a>
    </div>
  </div>
</div>		
			</div>	
<div class="row">
<div class="col-md-8">
  <div class="row my-3">
    <div class="col-md-6 position-relative">
      <label for="name" class="form-label">
        <i class="fa-solid fa-user" data-bs-toggle="tooltip" data-bs-original-title="Enter your full name" title="Enter your full name"></i> Your Name
      </label>
      <input type="text" class="form-control" id="name" name="name" placeholder="Enter your name" value="<?php echo $form['name']; ?>" required>
      <div class="invalid-feedback">Name is required.</div>
    </div>
    <div class="col-md-6 position-relative">
      <label for="company" class="form-label">
        <i class="fa-solid fa-building" data-bs-toggle="tooltip" data-bs-original-title="Your company or organization" title="Your company or organization"></i> Company
      </label>
      <input type="text" class="form-control" id="company" name="company" placeholder="Company name" value="<?php echo $form['company']; ?>" required>
      <div class="invalid-feedback">Company is required.</div>
    </div>
  </div>

  <div class="row mb-3">
    <div class="col-md-6 position-relative">
      <label for="email" class="form-label">
        <i class="fa-solid fa-envelope" data-bs-toggle="tooltip" data-bs-original-title="Your email for correspondence" title="Your email for correspondence"></i> Email
      </label>
      <input type="email" class="form-control" id="email" name="email" placeholder="you@example.com" value="<?php echo $form['email']; ?>" required>
      <div class="invalid-feedback">Valid email is required.</div>
    </div>
    <div class="col-md-6 position-relative">
      <label for="phone" class="form-label">
        <i class="fa-brands fa-whatsapp" data-bs-toggle="tooltip" data-bs-original-title="WhatsApp number with country code" title="WhatsApp number with country code"></i> WhatsApp
      </label>
      <input type="text" class="form-control" id="phone" name="phone" placeholder="+1XXXXXXXXXX" value="<?php echo $form['phone']; ?>" required>
      <div class="invalid-feedback">WhatsApp number is required.</div>
    </div>
  </div>

  <div class="mb-3 position-relative">
    <label for="address" class="form-label">
      <i class="fa-solid fa-location-dot" data-bs-toggle="tooltip" data-bs-original-title="Primary address for delivery" title="Primary address for delivery"></i> Address
    </label>
    <input type="text" class="form-control" id="address" name="address" placeholder="Street address" value="<?php echo $form['address']; ?>" required>
    <div class="invalid-feedback">Address is required.</div>
  </div>

  <div class="mb-3">
    <label for="address2" class="form-label">Address 2 (Optional)</label>
    <input type="text" class="form-control" id="address2" name="address2" placeholder="Suite, apartment, etc." value="<?php echo $form['address2']; ?>">
  </div>

  <div class="row mb-3">
    <div class="col-md-6 position-relative">
      <label for="country" class="form-label">
        <i class="fa-solid fa-earth-asia" data-bs-toggle="tooltip" data-bs-original-title="Country for shipping estimate" title="Country for shipping estimate"></i> Country
      </label>
      <input type="text" class="form-control" id="country" name="country" value="<?php echo $form['country']; ?>" required>
      <div class="invalid-feedback">Country is required.</div>
    </div>
    <div class="col-md-6 position-relative">
      <label for="state" class="form-label">
        <i class="fa-solid fa-map" data-bs-toggle="tooltip" data-bs-original-title="Your state or province" title="Your state or province"></i> State
      </label>
      <input type="text" class="form-control" id="state" name="state" value="<?php echo $form['state']; ?>" required>
      <div class="invalid-feedback">State is required.</div>
    </div>
  </div>

  <div class="row mb-3">
    <div class="col-md-6 position-relative">
      <label for="city" class="form-label">
        <i class="fa-solid fa-city" data-bs-toggle="tooltip" data-bs-original-title="City for order processing" title="City for order processing"></i> City
      </label>
      <input type="text" class="form-control" id="city" name="city" value="<?php echo $form['city']; ?>" required>
      <div class="invalid-feedback">City is required.</div>
    </div>
    <div class="col-md-6 position-relative">
      <label for="zip" class="form-label">
        <i class="fa-solid fa-box" data-bs-toggle="tooltip" data-bs-original-title="Postal code for delivery" title="Postal code for delivery"></i> Zip
      </label>
      <input type="text" class="form-control" id="zip" name="zip" value="<?php echo $form['zip']; ?>" required>
      <div class="invalid-feedback">Zip code is required.</div>
    </div>
  </div>

  <div class="mb-3">
    <label for="details" class="form-label">
      <i class="fa-solid fa-comment-dots" data-bs-toggle="tooltip" data-bs-original-title="Share details about selected items, customization preferences, or any order-specific instructions." title="Share details about selected items, customization preferences, or any order-specific instructions."></i> Instructions & Requirements
    </label>
    <textarea class="form-control" id="details" name="details" rows="4" placeholder="E.g. size breakdown, embroidery placement, packaging details, delivery instructions…" required><?php echo $form['details']; ?></textarea><div class="invalid-feedback">Please provide your instructions or requirements.</div>
  </div>

  <div class="row mb-3">
  <div class="col-12 col-md-6 d-flex flex-column justify-content-center">
    <label for="captcha" class="form-label">
      <i class="fa-solid fa-shield-halved"></i> CAPTCHA Code
    </label>
    <img id="captcha_image" data-src="<?php echo $cc['base_url'].'Tools/captcha_image/'.$captcha_token; ?>" alt="CAPTCHA" class="rounded shadow-sm mb-2 captcha_image">
  </div>
  <div class="col-12 col-md-6 d-flex align-items-center">
    <input type="text" class="form-control" id="captcha_code" name="captcha_code" placeholder="Enter CAPTCHA" required>
    <div class="invalid-feedback">Please enter the CAPTCHA code.</div>
  </div>
</div>

</div>

<div class="col-md-4 py-3">
<div class="summary-card p-4 shadow-sm">
  <h5 class="mb-4">Quotation Summary</h5>
<?php 
$total_items = 0;
$total_quantity = 0;
$total_from = 0;
$total_to = 0;
foreach($carts_items as $item_info){ 
	$total_items++;
	$total_quantity += $item_info['quantity'];
	$item_details = json_decode($item_info['item_details'], true)?? [];
	$item_details['url'] = $cc['base_url'].slug2url_fnc('items_details', $item_details['item_id'], $item_details['slug'], $item_details['name']);
	$uploads = json_decode($item_info['uploads'], true)?? [];
	if (!empty($uploads['upload_file'])) {
        $uploads['url'] = $cc['img_url'].display_image_fnc('webp-'.$cc['tiny_image_width'].'x'.$cc['tiny_image_height'], $uploads['upload_file']);
    }else{
        $uploads = [
            'upload_id' => 0,
            'upload_file' => 'image-not-found.webp',
            'url' => $cc['img_url'].display_image_fnc('webp-'.$cc['tiny_image_width'].'x'.$cc['tiny_image_height'], 'image-not-found.webp')
        ];
    }
    if (!empty($cc['price']) && strtolower($cc['price']) == 'true') {
    $total_from += $item_details['price']*$item_info['quantity'];
  $total_to += ($item_details['price_previous'] > $item_details['price'])?$item_details['price_previous']*$item_info['quantity']:$item_details['price']*$item_info['quantity'];
    }
	?>
  <div class="card m-0 product-card">
    <div class="row g-0 align-items-center">
      <div class="col-md-3 p-1">
        <a href="<?php echo $item_details['url']; ?>" data-bs-toggle="tooltip" data-bs-original-title="<?php echo $item_details['name']; ?>" title="<?php echo $item_details['name']; ?>"><img data-src="<?php echo $uploads['url']; ?>" alt="<?php echo $item_details['name']; ?>" class="img-fluid rounded-start"></a>
      </div>
      <div class="col-md-9">
        <div class="card-body p-1">
          <a href="<?php echo $item_details['url']; ?>" data-bs-toggle="tooltip" data-bs-original-title="<?php echo $item_details['name']; ?>" title="<?php echo $item_details['name']; ?>">
          <h6 class="card-title m-0 text-truncate"><?php echo $item_details['name']; ?></h6>
          <p class="m-0 text-muted">Model: <?php echo $item_details['model']; ?></p>
          <p class="m-0 text-muted">Quantity: <?php echo $item_info['quantity']; ?></p>
          <?php if($cc['price'] == 'TRUE'){?>
                                   <small> US $ <?php echo number_format($item_details['price']*$item_info['quantity'], 2).' - '; echo ($item_details['price_previous'] > $item_details['price'])?number_format($item_details['price_previous']*$item_info['quantity'], 2):number_format($item_details['price']*$item_info['quantity'], 2); ?></small>
                                    <?php }else{ ?>
                                    <span class="discount-badge">Quote Ready</span>
                                    <?php } ?>
          
  </a>
        </div>
      </div>
    </div>
  </div>
<?php }?>	
 <div class="d-flex justify-content-between my-3">
                            <span class="text-muted">Total Items</span>
                            <span><?php echo $total_items; ?></span>
  </div>

<div class="d-flex justify-content-between mb-3">
                            <span class="text-muted">Total Quantity</span>
                            <span><?php echo $total_quantity; ?></span>
                        </div>
                        <hr>
	<div class="d-flex justify-content-between mb-4">
                            <span class="fw-bold">Total Price</span>
                             <?php if($cc['price'] == 'TRUE'){?>
                              <small> US $ <?php echo number_format($total_from, 2).' - '; echo number_format($total_to, 2); ?></small>
                              <?php }else{ ?>
                            <span class="fw-bold discount-badge">Quote Ready</span>
                            <?php } ?>
                        </div>
<button type="submit" class="btn btn-primary checkout-btn w-100 mb-3">
                          <i class="fa-solid fa-paper-plane me-1"></i>  Send Inquiry Now
                        </button>

<div class="d-flex justify-content-center gap-2">
						<i class="fa-solid fa-lock fa-shake text-success pt-1" ></i>
                            <span class="text-muted" data-bs-toggle="tooltip" data-bs-original-title="Your information is protected with SSL encryption and handled with care." title="Your information is protected with SSL encryption and handled with care.">Secure & Confidential</span>
                        </div>
                    </div>
                    
</div>

</div>
</form>
	</div>  
  <?php }?>
</section>


<!-- Theme Content End
================================================== -->

  <!-- Theme Cart Footer Start
================================================== -->

<section class="container-fluid cart">
	<div class="container py-4">
		<div class="row">
			<div class="col-md-12 ">
			<div class="card mb-4">
          <div class="card-body">
            <p><strong>Expected shipping delivery</strong></p>
            <p><?php 
           $base_days = 5;
          $quantity_days = floor($total_quantity / 25);
          if ($quantity_days <= 0) {
              $quantity_days = 1;
          }
          $total_days_min = $base_days + $total_items + $quantity_days;
          $total_days_max = $total_days_min + 9;
          $from_date = date('d.m.Y', strtotime("+$total_days_min days"));
          $till_date = date('d.m.Y', strtotime("+$total_days_max days"));
          echo $from_date . ' - ' . $till_date;          
           ?></p>
			<p>All orders are processed based on your custom requirements. Once we receive your inquiry and confirm all specifications (including sizing, material, colors, labels, and branding), production typically begins within 3–5 business days. Shipping timelines vary depending on destination and order volume:</p>
<p><b>- Domestic Orders:</b> Estimated delivery within 5–7 business days after dispatch.<br/>
<b>- International Orders:</b> Estimated delivery within 8–14 business days depending on location and courier service.<br/>
<b>- Bulk or Custom Orders:</b> May require additional time for production—specific timelines will be shared in your free quotation.</p>
<p>Tracking details will be provided once your order has been shipped. We prioritize secure packaging and timely delivery to ensure your custom products arrive exactly as expected.
</p>
          </div>
        </div>
			</div>		
			</div>	

	<div class="row">
			<div class="col-md-12 ">
			<div class="card mb-4">
          <div class="card-body">
             <p><strong>Payment Information</strong></p>
<p>We follow a quotation-first payment process designed to ensure clarity and confidence:</p>
<p><b>- Free Quotations:</b> All product inquiries are reviewed without charge. You'll receive a detailed quotation based on your selected items, custom specifications, and quantity.<br/>
<b>- No Payment at Inquiry Stage:</b> You’re never asked to pay when submitting an inquiry. We believe in earning trust by providing full transparency first.<br/>
<b>- Flexible Payment Options:</b> Once you approve the quotation, payment can be made via multiple secure channels including:<br/>
 &nbsp; &nbsp; &nbsp;  &nbsp; &nbsp; &nbsp; - Bank Transfer (Local & International)<br/>
 &nbsp; &nbsp; &nbsp;  &nbsp; &nbsp; &nbsp; - Online Payment Gateways (based on client location)<br/>
 &nbsp; &nbsp; &nbsp;  &nbsp; &nbsp; &nbsp; - Other methods upon mutual agreement<br/>
<b>- Bulk & Custom Orders:</b> For larger orders, milestone or staged payments may be arranged to ensure smooth processing.<br/>
<b>- Invoices & Records:</b> Official invoices are provided post-confirmation, including itemized breakdowns and shipping details.<br/>
</p>
<p>If you’re an e-commerce store, club, or brand representative, we’re happy to tailor payment options to your operational needs.</p>
          </div>
        </div>
			</div>		
			</div>
<div class="row">
	<div class="col-md-6 py-3 copyright">
	Copyright &copy; 2025 <a href="<?php echo $cc['base_url']; ?>" data-bs-toggle="tooltip" data-bs-original-title="<?php echo $cc['app_name']; ?>" title="<?php echo $cc['app_name']; ?>"><?php echo $cc['app_name']; ?></a>, All rights reserved.
	</div>
	<div class="col-md-6 py-3 powered text-end">
	<a href="https://ex.com.pk/web-development.html" rel="follow" data-bs-toggle="tooltip" data-bs-original-title="This site is developed by ExTech Corporation" title="This site is developed by ExTech Corporation">Developed</a> & <a href="https://ex.com.pk/web-promotion.html" rel="follow" data-bs-toggle="tooltip" data-bs-original-title="SEO services by ExTech Corporation" title="SEO services by ExTech Corporation">SEO</a> by <strong><a href="https://ex.com.pk/" rel="follow" data-bs-toggle="tooltip" data-bs-original-title="Powered by ExTech Corporation – Engineered for Performance" title="Powered by ExTech Corporation – Engineered for Performance
">ExTech Corporation</a></strong>
	</div>
	</div>
	</div>
</section>
<!-- Theme Cart Footer End
================================================== -->
<?php echo view('frontend/'.$cc['frontend_theme'].'/common/body_end');?>
</body>
<?php echo view('frontend/'.$cc['frontend_theme'].'/common/page_end');?>
<script>
(function () {  
            'use strict';  
            window.addEventListener('load', function () {  
                var form = document.getElementById('checkout_frm'); 
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
<script>
  function content_fnc(){
  var wait_to_all_loaded = setInterval(() => {
    if (all_loaded != false) {
      if (typeof bootstrap !== "undefined" && typeof jQuery.ui !== "undefined") {
        clearInterval(wait_to_all_loaded);  
        


      }
    }
}, 100);
  }
</script>