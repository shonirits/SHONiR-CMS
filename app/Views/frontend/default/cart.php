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
            <b>Just a reminder:</b> Sending an inquiry doesn’t require any payment and you'll never be asked for payment at this stage. We offer free quotations with no obligation to purchase. Explore freely, ask questions, and let us tailor your gear—risk-free and commitment-free.
          </div>    
			</div>
		</div>
		<div class="row bullets">
			<div class="col-md-3 py-2">
				<i class="fa-solid fa-circle-check"></i> No upfront costs
		</div>
		<div class="col-md-3 py-2">
				<i class="fa-solid fa-circle-check"></i> No hidden fees
		</div>
		<div class="col-md-3 py-2">
				<i class="fa-solid fa-circle-check"></i> 100% personalized service
		</div>
		<div class="col-md-3 py-2">
				<i class="fa-solid fa-circle-check"></i> Free quote—no strings attached
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
	<div class="container">
		<div class="row">
			<div class="col-md-12 py-2">
			<h1><i class="fa-solid fa-cart-shopping icon"></i> Quote Cart</h1>
			</div>		
			</div>	

<div class="row">
	<?php $total_items = 0;
$total_quantity = 0;
$total_from = 0;
$total_to = 0;
if (!empty($carts_items) && is_array($carts_items)) {?>
<div class="col-md-8 ">
	<div class="row">
		<form name="cart_frm" id="cart_frm" action="<?php echo $cc['base_url'].'Cart'; ?>" method="POST" role="form" novalidate>
<input type="hidden" name="token" id="token" value="<?php echo $token; ?>">
<input type="hidden" name="do" id="do" value="update">
	<div class="col-md-12 ">
<?php 
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
 					<div class="product-card p-3 my-3 shadow-sm">
                            <div class="row align-items-center">
                                <div class="col-md-2">
                                    <a href="<?php echo $item_details['url']; ?>" data-bs-toggle="tooltip" data-bs-original-title="<?php echo $item_details['name']; ?>" title="<?php echo $item_details['name']; ?>"><img data-src="<?php echo $uploads['url']; ?>" alt="<?php echo $item_details['name']; ?>" class="product-image"></a>
                                </div>
                                <div class="col-md-4"><a href="<?php echo $item_details['url']; ?>" data-bs-toggle="tooltip" data-bs-original-title="<?php echo $item_details['name']; ?>" title="<?php echo $item_details['name']; ?>">
                                    <h6 class="mb-1 text-truncate"><?php echo $item_details['name']; ?></h6>
                                    <p class="text-muted mb-0"><?php echo $item_details['model']; ?></p>
									</a>
                                </div>
                                <div class="col-md-3">
                                    <div class="d-flex align-items-center gap-2">
                                        <button class="quantity-btn" onclick="update_quantity_fnc(this, -1)">-</button>
                                        <input type="number" name="<?php echo $item_info['cart_item_id']; ?>" id="<?php echo $item_info['cart_item_id']; ?>" class="quantity-input" value="<?php echo $item_info['quantity']; ?>" min="1" maxlength="11" minlength="1" required="required" required onkeypress="return is_key_digit_fnc(event);" ondrop="return false;" onpaste="return false;">										
                                        <button class="quantity-btn" onclick="update_quantity_fnc(this, 1)">+</button>
										<div class="invalid-feedback">  
										MOQ is 1. 
										</div>
                                    </div>
                                </div>
                                <div class="col-md-2">
                                  <?php if($cc['price'] == 'TRUE'){?>
                                   <small> US $ <?php echo number_format($item_details['price']*$item_info['quantity'], 2).' - '; echo ($item_details['price_previous'] > $item_details['price'])?number_format($item_details['price_previous']*$item_info['quantity'], 2):number_format($item_details['price']*$item_info['quantity'], 2); ?></small>
                                    <?php }else{ ?>
                                    <span class="fw-bold discount-badge">Quote Ready</span>
                                    <?php } ?>
                                </div>
                                <div class="col-md-1">
									<a href="<?php echo $cc['base_url'].'Cart?do=remove&cart_item_id='.$item_info['cart_item_id']; ?>"  data-bs-toggle="tooltip" data-bs-original-title="Remove" title="Remove">
                                    <i class="fa-solid fa-trash-can remove-btn"></i>
									</a>
                                </div>
                            </div>
                        </div>
<?php }?>						
</div>
</div>
<div class="row ">
	<div class="col-md-6 py-4">
		<a href="<?php echo $cc['base_url'].'all.html'; ?>" class="btn btn-primary">Add More to Your Inquiry</a>
	</div>
	<div class="col-md-6 py-4">
		<button type="submit" class="btn btn-dark">Update</button>
	</div>
</div>	
</div>
</form>
<div class="col-md-4 py-3">
<div class="summary-card p-4 shadow-sm">
  <h5 class="mb-4">Inquiry Summary</h5>
 <div class="d-flex justify-content-between mb-3">
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
						<?php if($cc['promo_code'] == 'TRUE'){ ?>
                        <div class="mb-4">
                            <div class="input-group">
                                <input type="text" class="form-control" placeholder="Promo code">
                                <button class="btn btn-outline-secondary" type="button">Apply</button>
                            </div>
                        </div>	
					<?php } ?>
<a href="<?php echo $cc['base_url'].'Checkout'; ?>" class="btn btn-primary checkout-btn w-100 mb-3">
                            Submit for Quotation
                        </a>

<div class="d-flex justify-content-center gap-2">
						<i class="fa-solid fa-lock fa-shake text-success pt-1" ></i>
                            <span class="text-muted" data-bs-toggle="tooltip" data-bs-original-title="Your information is protected with SSL encryption and handled with care." title="Your information is protected with SSL encryption and handled with care.">Secure & Confidential</span>
                        </div>
                    </div>
</div>
<?php }else{?>
<div class="col-md-12 py-4">
 <div class="alert alert-danger" role="alert">
            <b>No items found</b>—please add items to request a quote. <a href="<?php echo $cc['base_url'].'all.html'; ?>" class="btn btn-primary">View All Items</a>

 </div>  
</div>
<?php }?>
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
                var form = document.getElementById('cart_frm'); 
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