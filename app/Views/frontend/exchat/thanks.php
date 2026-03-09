<?php echo view('frontend/'.$cc['frontend_theme'].'/common/page_start'); ?>
  <head>
  <?php echo view('frontend/'.$cc['frontend_theme'].'/common/head');?>
  </head>
  <body id="body"><?php echo view('frontend/'.$cc['frontend_theme'].'/common/body_start');?>

  <!-- Theme Cart Header Start
================================================== -->

 <section class="container-fluid cart">
<div class="container py-5">
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
<div class="container notice py-3">
		<div class="row">
			<div class="col-md-12 ">
				  <div class="alert alert-success" role="alert">
  <b>Thank You for Your Inquiry!</b> Your order# <?php echo $order_number; ?> has been received. Our team is reviewing your specifications and will send a personalized quote shortly.
</div>   
			</div>
		</div>
		<div class="row bullets">
			<div class="col-md-3 py-2">
				<i class="fa-solid fa-circle-check"></i> Quote Crafted to Your Specs
		</div>
    <div class="col-md-3 py-2">
				<i class="fa-solid fa-circle-check"></i> Expert Review in Progress
		</div>
    <div class="col-md-3 py-2">
				<i class="fa-solid fa-circle-check"></i> Premium Materials. Proven Quality
		</div>
		<div class="col-md-3 py-2">
				<i class="fa-solid fa-circle-check"></i> Flexible Options Available
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
<div class="container py-5">
  <div class="row">
			<div class="col-md-6 ">
        <div class="thank-you-actions">
  <h3>What You Can Do Next:</h3>
  <ul style="list-style: disc; padding-left: 20px; font-size: 16px; color: #333;">
    <li><a href="<?php echo $cc['base_url'].'all.html'; ?>">Explore more products tailored to your needs</a></li>
    <li>Connect with our team instantly on <a href="https://wa.me/<?php
    $whatsapp_link = clean_phone_fnc($cc['app_telephone']).'?text='.urlencode("Hello! I just submitted a quote inquiry# {$order_number} and would like to ask a few questions.");
    
    echo $whatsapp_link; ?>" target="_blank">WhatsApp</a></li>
    <li>Check your inbox for a personalized quote summary</li>
    <li>Reach out for adjustments or custom options</li>
    <li>Follow us on social media for updates and new arrivals</li>
  </ul>
</div>
</div>
<div class="col-md-6 ">
        <div class="quote-summary-box p-4" style="background-color:#f9f9f9; border-radius:8px; box-shadow:0 0 8px rgba(0,0,0,0.05);">
  <h4 class="mb-3"><i class="fa-solid fa-envelope-open-text"></i> Your Quote Is On Its Way</h4>
  <p style="font-size:14px; color:#555;">Order Number: <span style="background:#fff8b3; padding:3px 6px; border-radius:4px;"><?php echo $order_number; ?></span></p>
  <p style="font-size:14px; color:#555;">You’ll receive a detailed quote via email within 1–2 business days.</p>
  <a href="<?php echo $cc['base_url'].'all.html'; ?>" class="btn btn-primary mt-3">🛍️ Explore More Options</a>
</div>
</div>
</div>
</div>
</section>

<!-- Theme Content End
================================================== -->


  <!-- Theme Cart Footer Start
================================================== -->

<section class="container-fluid cart">
	<div class="container py-4">
		<div class="row">
			<div class="col-md-12 ">
			<div class="card shadow-sm mb-4">
  <div class="card-body">
    <h4 class="card-title mb-3">
      🚚 From Crafting to Global Dispatch
    </h4>
    <p class="card-text text-muted">
      At <strong><?php echo $cc['app_name']; ?></strong>, your order begins with precision and ends with worldwide delivery — packaged with care and backed by transparency.
    </p>
    <p class="card-text">
      Once your design, specs, and preferences are confirmed, production begins within <strong>3–5 business days</strong>. We ship using trusted international partners and local services, based on your selected method and destination.
    </p>

    <ul class="list-group list-group-flush mb-3">
      <li class="list-group-item">
        <strong>Domestic Orders:</strong> Delivered within <strong>5–7 business days</strong> after dispatch via reliable national couriers.
      </li>
      <li class="list-group-item">
        <strong>International Shipping:</strong> Arrives within <strong>8–14 business days</strong> depending on location and preferred carrier (DHL, EMS, FedEx, Pak Postal Service).
      </li>
      <li class="list-group-item">
        <strong>Bulk & Custom Orders:</strong> A personalized timeline will be outlined in your quotation and managed with support from our cargo agent <strong>Decent Cargo & Courier</strong>.
      </li>
    </ul>

    <p class="card-text">
      All shipments include proper export/import documentation and tracking. We charge only the actual shipping cost and provide a copy of the shipping invoice for full transparency. From prototype to doorstep — your gear is in safe hands.
    </p>
  </div>
</div>
			</div>		
			</div>	

	<div class="row">
			<div class="col-md-12 ">
			<div class="card mb-4">
          <div class="card-body">
            <p><strong>💳 Payment Process — Designed for Clarity & Confidence</strong></p>
<p>At <?php echo $cc['app_name']; ?>, your journey begins with transparency, not transaction. We believe in showcasing quality before asking for commitment.</p>

<p><b>• Free Quotation First:</b> Every inquiry is reviewed without charge. You’ll receive a customized quote based on product type, quantity, and specifications — no minimum order limits.</p>
<p><b>• Pay When You’re Ready:</b> We ask for payment only after you’ve approved the quote and confirmed all design details.</p>
<p><b>• Flexible & Secure Methods:</b> Once confirmed, we offer secure options including Bank Transfer (local & international), online gateways (region-based), and other methods by mutual agreement.</p>
<p><b>• Official Documentation:</b> Your payment is backed by formal invoices, shipping records, and detailed product breakdowns.</p>
<p><b>• Bulk & Custom Orders:</b> We accommodate staged payments, milestone arrangements, and wholesale-friendly terms for clubs, brands, and resellers.</p>

<p>We don’t believe in pressure — just possibilities. Your satisfaction and trust lead everything we do. If you’re placing a larger order or working on behalf of a business, we’re happy to tailor the payment process to suit your operational workflow.</p>
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