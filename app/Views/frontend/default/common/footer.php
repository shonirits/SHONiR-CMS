

<?php if(!empty($random_items) && is_array($random_items)) { ?>
<!-- Theme You May Also Like Start
================================================== -->
<div class="container-fluid t-ymal py-3 mt-3 wow slideInUp">
<div class="container">
		<div class="row">
			<div class="title py-3">
				<h2 class="t-heading text-center">You May Also Like</h2>
			</div>
		</div>
		<div class="row">
			<div class="col-12">
				<div class="t-ymal-slider">
				 <?php foreach ($random_items as $random_item)
            {
				 $random_item_details = $cc['base_url'].slug2url_fnc('items_details', $random_item['item_id'], $random_item['slug'], $random_item['meta_title']);
                 $random_item_quickview_image = $cc['img_url'].display_image_fnc('webp-'.$cc['large_image_width'].'x'.$cc['large_image_height'], $random_item['upload_file'], 'fix', $cc['cache_image'], $cc['image_original']);

                ?><div>
           <div class="card h-100 shadow-sm border-0 item-card rating-zone">
    <div class="position-relative" data-rating="<?php echo $random_item['ratings']; ?>" id="<?php echo 'item_'.$random_item['item_id'].'_zone';?>">
      <!-- Badges -->
      <?php if($random_item['price_previous'] > $random_item['price'] && $cc['badge_sale'] == 'TRUE'){ ?>
        <span class="badge bg-danger position-absolute top-0 end-0 m-2 z-3">Sale</span>
      <?php } ?>
      <?php if($random_item['newbie'] && $cc['badge_newbie'] == 'TRUE'){ ?>
        <span class="badge bg-success position-absolute top-0 start-0 m-2 z-3">New</span>
      <?php } ?>
      <?php if($random_item['featured'] && $cc['badge_featured'] == 'TRUE'){ ?>
        <span class="badge bg-warning text-dark position-absolute top-0 start-0 m-2 ms-5 z-3">Featured</span>
      <?php } ?>

     <div class="position-relative overflow-hidden">
<a href="<?php echo $random_item_details; ?>" class="text-decoration-none" data-bs-toggle="tooltip" title="<?php echo $random_item['title']; ?>">
  <img src="<?php echo $cc['img_url'].display_image_fnc('webp-'.$cc['small_image_width'].'x'.$cc['small_image_height'], $random_item['upload_file'], 'fix', $cc['cache_image'], $cc['image_original']); ?>" 
       class="card-img-top img-fluid main-img"
       alt="<?php echo $random_item['name']; ?>">

  <?php if(!empty($random_item['upload_file2'])){ ?>
      <img src="<?php echo $cc['img_url'].display_image_fnc('webp-'.$cc['small_image_width'].'x'.$cc['small_image_height'], $random_item['upload_file2'], 'fix', $cc['cache_image'], $cc['image_original']); ?>" 
           class="card-img-top img-fluid position-absolute top-0 start-0 child-img"
           alt="<?php echo $random_item['name']; ?>">
  <?php } ?>
</a>
</div>

    </div>

    <div class="card-body text-center item-rating">
      <!-- Product Title -->
      <h5 class="card-title">
        <a href="<?php echo $random_item_details; ?>" class="text-decoration-none" data-bs-toggle="tooltip" title="<?php echo $random_item['title']; ?>">
          <?php echo $random_item['name']; ?>
        </a>
      </h5>
      <p class="card-text mb-1">Model: <?php echo $random_item['model']; ?></p>

      <!-- Star Ratings -->
      <?php if($cc['ratings'] == 'TRUE'){ ?>
       <div class="star-rating mb-2">
                            <i class="fa-regular fa-star"></i>
                            <i class="fa-regular fa-star"></i>
                            <i class="fa-regular fa-star"></i>
                            <i class="fa-regular fa-star"></i>
                            <i class="fa-regular fa-star"></i>
                        </div>
      <?php } ?>

      <!-- Price -->
      <?php if($cc['price'] == 'TRUE'){ ?>
        <p class="card-text fw-bold">
          US $<?php echo number_format($random_item['price'], 2); ?>
          <?php if($random_item['price_previous'] > $random_item['price']){ ?>
            <span class="text-danger text-decoration-line-through">
              US $<?php echo number_format($random_item['price_previous'], 2); ?>
            </span>
          <?php } ?>
        </p>
      <?php } ?>
    </div>

    <!-- Action Buttons -->
    <div class="card-footer bg-transparent border-0 text-center">
      <div class="btn-group" role="group">
        <button class="btn btn-outline-secondary btn-sm" onclick='item_quick_view_fnc( JSON.parse(this.dataset.details), this.dataset.image, this.dataset.link, token )' data-details='<?php echo htmlspecialchars(json_encode($random_item), ENT_QUOTES, "UTF-8"); ?>' data-image='<?php echo htmlspecialchars($random_item_quickview_image, ENT_QUOTES, "UTF-8"); ?>' data-link='<?php echo htmlspecialchars($random_item_details, ENT_QUOTES, "UTF-8"); ?>' data-bs-toggle="tooltip" title="Quick View">
          <i class="fa-solid fa-magnifying-glass"></i>
        </button>
        <button class="btn btn-outline-secondary btn-sm" onclick='item_quick_send_fnc( JSON.parse(this.dataset.details), this.dataset.image, this.dataset.link, token )' data-details='<?php echo htmlspecialchars(json_encode($random_item), ENT_QUOTES, "UTF-8"); ?>' data-image='<?php echo htmlspecialchars($random_item_quickview_image, ENT_QUOTES, "UTF-8"); ?>' data-link='<?php echo htmlspecialchars($random_item_details, ENT_QUOTES, "UTF-8"); ?>' data-bs-toggle="tooltip" title="Enquire Now">
          <i class="fa-solid fa-paper-plane"></i>
        </button>
        <button class="btn btn-outline-secondary btn-sm" onclick='add2cart_fnc("<?php echo $random_item['item_id'] ?>", token, event);' data-bs-toggle="tooltip" title="Add To Quote Cart">
          <i class="fa-solid fa-basket-shopping"></i>
        </button>
        <a href="<?php echo $random_item_details; ?>" class="btn btn-outline-secondary btn-sm" data-bs-toggle="tooltip" title="More Info">
          <i class="fa-solid fa-info"></i>
        </a>
      </div>
    </div>
  </div>
        </div>
   <?php 
            } ?>      
       
        </div>
			</div>
		</div>
	</div>
</div>
<!-- Theme You May Also Like End
================================================== -->
<?php } ?>


<!-- Theme Footer Start
================================================== -->

<footer class="container-fluid t-footer py-5 mt-3 wow slideInRight">
  <div class="container">
    <div class="row gy-4">
      
      <!-- Contact -->
      <div class="col-md-4">
        <h5 class="footer-title wow bounceIn">Reach Us</h5>
        <ul class="list-unstyled footer-list">
          <li class="wow bounceIn"><i class="fa-solid fa-building"></i> <strong><?php echo $cc['app_name']; ?></strong></li>
          <li class="wow bounceIn"><i class="fa-solid fa-user"></i> <?php echo $cc['app_author']; ?></li>
		  <li class="wow bounceIn"><i class="fa-solid fa-at"></i> <a href="mailto:<?php echo $cc['app_email']; ?>"><?php echo $cc['app_email']; ?></a></li>
          <li class="wow bounceIn"><i class="fa-solid fa-phone"></i> <a href="tel:<?php echo $cc['app_telephone']; ?>"><?php echo $cc['app_telephone']; ?></a></li>
		  <li class="wow bounceIn"><i class="fa-solid fa-link"></i> <a href="https://<?php echo $cc['app_website']; ?>"><?php echo $cc['app_website']; ?></a></li>
		  <li class="wow bounceIn"><i class="fa-solid fa-location-dot"></i> <?php echo $cc['app_address'].', '.$cc['app_postal'].'-'.$cc['app_city']; ?></li>
		  <li class="wow bounceIn"><i class="fa-solid fa-flag"></i> <?php echo $cc['app_region'].', '.$cc['app_country']; ?></li>
        </ul>
      </div>

      <!-- Quick Links -->
      <div class="col-md-4 col-sm-6">
        <h5 class="footer-title wow bounceIn">Quick Links</h5>
        <ul class="list-unstyled footer-list">
          <li><a href="<?php echo $cc['base_url']; ?>" data-bs-toggle="tooltip" title="Homepage"><i class="fa-solid fa-chevron-right"></i> Homepage</a></li>
          <li><a href="<?php echo $cc['base_url'].'ibc.html'; ?>" data-bs-toggle="tooltip" title="Our Products"><i class="fa-solid fa-chevron-right"></i> Our Products</a></li>
          <?php 
            $bottom_pages = extract_by_key_fnc($pages_tree, 'pages_details', 'page', 'bottom', $cc['base_url']);
            if(count($bottom_pages) > 0){  
              foreach($bottom_pages as $bot_page){
          ?>
          <li class="wow bounceIn">
            <a href="<?php echo $cc['base_url'].slug2url_fnc('pages_details', $bot_page['page_id'], $bot_page['slug'], $bot_page['title']); ?>" data-bs-toggle="tooltip" title="<?php echo $bot_page['title']; ?>">
              <i class="fa-solid fa-chevron-right"></i> <?php echo $bot_page['name']; ?>
            </a>
          </li>
          <?php } } ?>
          <li><a href="<?php echo $cc['base_url'].'g26/videos-gallery.html'; ?>" data-bs-toggle="tooltip" title="Videos Gallery"><i class="fa-solid fa-chevron-right"></i> Videos Gallery</a></li>
          <li><a href="<?php echo $cc['base_url'].'g21/images-gallery.html'; ?>" data-bs-toggle="tooltip" title="Images Gallery"><i class="fa-solid fa-chevron-right"></i> Images Gallery</a></li>
          <li><a href="<?php echo $cc['base_url'].'Blog'; ?>" data-bs-toggle="tooltip" title="Our Blog"><i class="fa-solid fa-chevron-right"></i> Our Blog</a></li>
          <li><a href="<?php echo $cc['base_url'].'Contact'; ?>" data-bs-toggle="tooltip" title="Contact Us"><i class="fa-solid fa-chevron-right"></i> Contact</a></li>
        </ul>
      </div>

      <!-- Newsletter Subscriber -->
      <div class="col-md-4 col-sm-6 t-newsletter">
        <h5 class="footer-title wow bounceIn">Stay Updated with Our Latest Insights</h5>
        <p class="small opacity-75 wow bounceIn">Join our community to receive curated trends, fresh product launches, and exclusive offers directly in your inbox.<br> Quality you can trust — delivered with care.</p>
         <div class="input-group subscription-form">
          <input type="email" class="form-control" id="subscriber_email" name="subscriber_email" placeholder="Enter Your Email Address" data-bs-toggle="tooltip" data-placement="top" title="Please enter a valid email address" value="">
          <button class="btn btn-light" type="button" onclick="subscriber_fnc(token);">Subscribe Now!</button>
        </div>
      </div>
    </div>

	 <!-- Payment & Social -->
    <div class="row mt-3 align-items-center">
      <div class="col-md-4">
        <h6 class="footer-title wow bounceIn">We Accept</h6>
       <img src="<?php echo $cc['img_url'].'public/images/frontend/'.$cc['frontend_theme'].'/payment-accept.png'; ?>" alt="We Accept Various Payment Methods" class="img-fluid mt-1 mb-4 wow bounceIn" data-bs-toggle="tooltip" title="We Accept Various Payment Methods">
      </div>
      <div class="col-md-8 d-flex flex-column align-items-md-end">
		<div>
       <h6 class="footer-title mt-3 wow bounceIn">Follow Us</h6>
        <ul class="social-links list-inline">
          <?php
          $socials = [
            'facebook' => 'fab fa-facebook-f',
            'instagram' => 'fab fa-instagram',
            'x' => 'fab fa-x-twitter',
            'pinterest' => 'fab fa-pinterest-p',
            'linkedin' => 'fab fa-linkedin-in',
            'youtube' => 'fab fa-youtube',
            'blogger' => 'fab fa-blogger-b',
            'group' => 'fa-solid fa-users',
            'tumblr' => 'fab fa-tumblr',
            'reddit' => 'fab fa-reddit-alien',
            'whatsapp' => 'fab fa-whatsapp'
          ];
          foreach ($socials as $key => $icon) {
            $url = $cc["social_{$key}"];
            if (!empty($url)) {
              echo '<li class="list-inline-item wow bounceIn"><a href="'.$url.'" data-bs-toggle="tooltip" title="'.ucfirst($key).'"><i class="'.$icon.'"></i></a></li>';
            }
          }
          ?>
        </ul>
</div>
      </div>
    </div>

    <!-- Shipping & Logos -->
    <div class="row mt-3 align-items-center">
      <div class="col-md-4">
        <h6 class="footer-title wow bounceIn">Fast & Safe Shipping</h6>
        <img src="<?php echo $cc['img_url'].'public/images/frontend/'.$cc['frontend_theme'].'/shipping.png'; ?>" data-bs-toggle="tooltip" title="Fast & Safe Shipping" alt="Fast & Safe Shipping" class="img-fluid wow bounceIn">
      </div>
      <div class="col-md-8 d-flex gap-3 justify-content-md-end mt-3 mt-md-0">
        <img src="<?php echo $cc['img_url'].'public/images/frontend/'.$cc['frontend_theme'].'/sialkot-chamber-of-commerce-industry.webp'; ?>" data-bs-toggle="tooltip" title="Sialkot Chamber Of Commerce Industry" alt="Sialkot Chamber Of Commerce Industry" class="footer-logo wow bounceIn">
        <img src="<?php echo $cc['img_url'].'public/images/frontend/'.$cc['frontend_theme'].'/fbr-pakistan.webp'; ?>" data-bs-toggle="tooltip" title="Federal Board of Revenue - Government of Pakistan" alt="Federal Board of Revenue - Government of Pakistan" class="footer-logo wow bounceIn">
      </div>
    </div>

    <!-- Membership -->
    <div class="text-center mt-4">
      <img src="<?php echo $cc['img_url'].'public/images/frontend/'.$cc['frontend_theme'].'/smeta-sedex-membership.png'; ?>" data-bs-toggle="tooltip" title="Proud to be a Sedex Member" alt="Proud to be a Sedex Member" class="footer-logo wow bounceIn">
    </div>
  </div>
</footer>
<!-- Theme Footer End
================================================== -->




<section class="container-fluid t-copyright py-4">
  <div class="container">
    <div class="row align-items-center gy-3">

      <!-- Left Side -->
      <div class="col-md-6 text-center text-md-start">
        <p class="mb-0 copyright-text wow bounceIn">
          © 2026 
          <a class="brand-link" href="<?php echo $cc['base_url']; ?>" 
             data-bs-toggle="tooltip"
             title="<?php echo $cc['app_name']; ?>">
             <?php echo $cc['app_name']; ?>
          </a>. All Rights Reserved.
        </p>
      </div>

      <!-- Right Side -->
      <div class="col-md-6 text-center text-md-end">
        <p class="mb-0 developer-text wow bounceIn">

          <a href="https://ex.com.pk/web-development.html"
             class="developer-link"
             rel="follow"
             data-bs-toggle="tooltip"
             title="This site is developed by ExTech Corporation">
             Developed
          </a>

          &

          <a href="https://ex.com.pk/web-promotion.html"
             class="developer-link"
             rel="follow"
             data-bs-toggle="tooltip"
             title="SEO services by ExTech Corporation">
             SEO
          </a>

          by

          <strong>
            <a href="https://ex.com.pk/"
               class="brand-link"
               rel="follow"
               data-bs-toggle="tooltip"
               title="Powered by ExTech Corporation – Engineered for Performance">
               ExTech Corporation
            </a>
          </strong>

          —

          <a href="https://www.ex.com.pk/web-design.html"
             class="developer-link"
             rel="follow"
             data-bs-toggle="tooltip"
             title="Website Designing Companies in Pakistan">
             Website Designing Company Pakistan
          </a>

        </p>
      </div>

    </div>
  </div>
</section>