<?php echo view('frontend/'.$cc['frontend_theme'].'/common/page_start'); ?>
  <head>
  <?php echo view('frontend/'.$cc['frontend_theme'].'/common/head');?>
  </head>
  <body id="body"><?php echo view('frontend/'.$cc['frontend_theme'].'/common/body_start');?>
  <?php echo view('frontend/'.$cc['frontend_theme'].'/common/header');?>
  <?php echo view('frontend/'.$cc['frontend_theme'].'/common/hero_slide');?>

  <!-- Theme Content Start
================================================== -->


<?php 
$featured_categories = extract_by_key_fnc($categories_tree, 'items_by_categories', 'category', 'featured', $cc['base_url']);

if(count($featured_categories) > 0){  
?>
<section class="container-fluid t-home categories py-5 px-4">

    <!-- Section Header -->
    <div class="text-center mb-5 heading">
      <h2 class="fw-bold t-heading text-center">Exclusive Selections</h2>
      <p class="text-muted">Discover our curated collections</p>
    </div>

    <!-- Categories Grid -->
    <div class="row g-4">

      <?php foreach ($featured_categories as $featured_category) { ?>

      <div class="col-6 col-sm-4 col-md-3 col-lg-2">
          <div class="card h-100 shadow-sm border-0">
            <a href="<?php echo $featured_category['link']; ?>" class="text-decoration-none">
              <img 
                src="<?php echo $cc['img_url'].display_image_fnc('webp-'.$cc['category_image_width'].'x'.$cc['category_image_height'], $featured_category['image1'], 'fix', $cc['cache_image'], true); ?>" 
                class="card-img-top img-fluid" 
                alt="<?php echo $featured_category['title']; ?>">
              <div class="card-body text-center">
                <h5 class="card-title">
                  <?php echo $featured_category['name']; ?>
                </h5>
                <h6 class="card-subtitle">Explore Collection</h6>
              </div>
            </a>
          </div>
        </div>

      <?php } ?>

    </div>
</section>
<?php } ?>


<?php 

if(isset($content_welcome) && !empty($content_welcome)){ ?>
<section class="container-fluid py-5 px-4 t-home welcome">
  <div class="container">
<div class="row">
<div class="col"><h4 class="fw-semibold"><?php echo $content_welcome['title']; ?></h4></div>
</div>
<div class="row">
<div class="col"><h1 class="fw-bold t-heading text-start"><?php echo $content_welcome['name']; ?></h1></div>
</div>
<div class="row">
<div class="col">

<div class="lh-lg position-relative description">

<?php if(isset($content_welcome['image1']) && !empty($content_welcome['image1'])){ ?>
<div class="img-container float-end">
<div class="img-border"></div>
  <img src="<?php echo $cc['img_url'].display_image_fnc('webp-0x0', $content_welcome['image1'], 'auto', $cc['cache_image'], true); ?>" 
       alt="<?php echo $content_welcome['title']; ?>" 
       class="img-fluid rounded-3 shadow img-styled">
       </div>
<?php } ?>

<?php echo $content_welcome['description']; ?>

</div>

</div>
</div>
  </div>
</section>
<?php } ?>

<section class="container-fluid t-home tabZone wow bounceInRigh">
    <div class="container">
        <div class="row">
            <div class="col-xs-12 pt-4 pb-4">
                <div class="tabCommon">

                <ul class="nav nav-tabs justify-content-center" id="commonTab" role="tablist">                    
                    <?php if(!empty($trending_items) && is_array($trending_items)) { ?>                    
                        <li class="nav-item" role="presentation">
                            <button class="nav-link active" id="first-tab" data-bs-toggle="tab" data-bs-target="#first-tab-pane" type="button" role="tab" aria-controls="first-tab-pane" aria-selected="true">Signature Pieces</button>
                        </li>
                    <?php } ?>
                    
                    <?php if(!empty($newbie_items) && is_array($newbie_items)) { ?>
                        <li class="nav-item" role="presentation">
                            <button class="nav-link" id="second-tab" data-bs-toggle="tab" data-bs-target="#second-tab-pane" type="button" role="tab" aria-controls="second-tab-pane" aria-selected="false">Latest Arrivals</button>
                        </li>
                    <?php } ?>
                    
                    <?php if(!empty($featured_items) && is_array($featured_items)) { ?>
                        <li class="nav-item" role="presentation">
                            <button class="nav-link" id="third-tab" data-bs-toggle="tab" data-bs-target="#third-tab-pane" type="button" role="tab" aria-controls="third-tab-pane" aria-selected="false">Top Features</button>
                        </li>
                    <?php } ?>
                    </ul> <!-- Closing ul tag was missing -->

                    <div class="tab-content wow bounceInRight" id="commonTabContent">
                        
                        <?php if(!empty($trending_items) && is_array($trending_items)) { ?>
                        <div class="tab-pane fade show active" id="first-tab-pane" role="tabpanel" aria-labelledby="first-tab" tabindex="0">
                            <div class="row g-4">
                                <?php foreach ($trending_items as $trending_item)
            {
                $trending_item_details = $cc['base_url'].slug2url_fnc('items_details', $trending_item['item_id'], $trending_item['slug'], $trending_item['meta_title']);
                 $trending_item_quickview_image = $cc['img_url'].display_image_fnc('webp-'.$cc['large_image_width'].'x'.$cc['large_image_height'], $trending_item['upload_file'], 'normal', $cc['cache_image'], $cc['image_original']);
                ?>
 <div class="col-12 col-sm-6 col-md-4 col-lg-3 py-2">
  <div class="card h-100 shadow-sm border-0 item-card rating-zone wow bounceIn">
    <div class="position-relative" data-rating="<?php echo $trending_item['ratings']; ?>" id="<?php echo 'item_'.$trending_item['item_id'].'_zone';?>">
      <!-- Badges -->
      <?php if($trending_item['price_previous'] > $trending_item['price'] && $cc['badge_sale'] == 'TRUE'){ ?>
        <span class="badge bg-danger position-absolute top-0 end-0 m-2 z-3">Sale</span>
      <?php } ?>
      <?php if($trending_item['newbie'] && $cc['badge_newbie'] == 'TRUE'){ ?>
        <span class="badge bg-success position-absolute top-0 start-0 m-2 z-3">New</span>
      <?php } ?>
      <?php if($trending_item['featured'] && $cc['badge_featured'] == 'TRUE'){ ?>
        <span class="badge bg-warning text-dark position-absolute top-0 start-0 m-2 ms-5 z-3">Featured</span>
      <?php } ?>

     <div class="position-relative overflow-hidden">
<a href="<?php echo $trending_item_details; ?>" class="text-decoration-none" data-bs-toggle="tooltip" title="<?php echo $trending_item['title']; ?>">
  <img src="<?php echo $cc['img_url'].display_image_fnc('webp-'.$cc['medium_image_width'].'x'.$cc['medium_image_height'], $trending_item['upload_file'], 'fix', $cc['cache_image'], $cc['image_original']); ?>" 
       class="card-img-top img-fluid main-img"
       alt="<?php echo $trending_item['name']; ?>">

  <?php if(!empty($trending_item['upload_file2'])){ ?>
      <img src="<?php echo $cc['img_url'].display_image_fnc('webp-'.$cc['medium_image_width'].'x'.$cc['medium_image_height'], $trending_item['upload_file2'], 'fix', $cc['cache_image'], $cc['image_original']); ?>" 
           class="card-img-top img-fluid position-absolute top-0 start-0 child-img"
           alt="<?php echo $trending_item['name']; ?>">
  <?php } ?>
</a>
</div>

    </div>

    <div class="card-body text-center item-rating">
      <!-- Product Title -->
      <h5 class="card-title">
        <a href="<?php echo $trending_item_details; ?>" class="text-decoration-none" data-bs-toggle="tooltip" title="<?php echo $trending_item['title']; ?>">
          <?php echo $trending_item['name']; ?>
        </a>
      </h5>
      <p class="card-text mb-1">Model: <?php echo $trending_item['model']; ?></p>

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
          US $<?php echo number_format($trending_item['price'], 2); ?>
          <?php if($trending_item['price_previous'] > $trending_item['price']){ ?>
            <span class="text-danger text-decoration-line-through">
              US $<?php echo number_format($trending_item['price_previous'], 2); ?>
            </span>
          <?php } ?>
        </p>
      <?php } ?>
    </div>

    <!-- Action Buttons -->
    <div class="card-footer bg-transparent border-0 text-center">
      <div class="btn-group" role="group">
        <button class="btn btn-outline-secondary btn-sm" onclick='item_quick_view_fnc( JSON.parse(this.dataset.details), this.dataset.image, this.dataset.link, token )' data-details='<?php echo htmlspecialchars(json_encode($trending_item), ENT_QUOTES, "UTF-8"); ?>' data-image='<?php echo htmlspecialchars($trending_item_quickview_image, ENT_QUOTES, "UTF-8"); ?>' data-link='<?php echo htmlspecialchars($trending_item_details, ENT_QUOTES, "UTF-8"); ?>' data-bs-toggle="tooltip" title="Quick View">
          <i class="fa-solid fa-magnifying-glass"></i>
        </button>
        <button class="btn btn-outline-secondary btn-sm" onclick='item_quick_send_fnc( JSON.parse(this.dataset.details), this.dataset.image, this.dataset.link, token )' data-details='<?php echo htmlspecialchars(json_encode($trending_item), ENT_QUOTES, "UTF-8"); ?>' data-image='<?php echo htmlspecialchars($trending_item_quickview_image, ENT_QUOTES, "UTF-8"); ?>' data-link='<?php echo htmlspecialchars($trending_item_details, ENT_QUOTES, "UTF-8"); ?>' data-bs-toggle="tooltip" title="Enquire Now">
          <i class="fa-solid fa-paper-plane"></i>
        </button>
        <button class="btn btn-outline-secondary btn-sm" onclick='add2cart_fnc("<?php echo $trending_item['item_id'] ?>", token, event);' data-bs-toggle="tooltip" title="Add To Quote Cart">
          <i class="fa-solid fa-basket-shopping"></i>
        </button>
        <a href="<?php echo $trending_item_details; ?>" class="btn btn-outline-secondary btn-sm" data-bs-toggle="tooltip" title="More Info">
          <i class="fa-solid fa-info"></i>
        </a>
      </div>
    </div>
  </div>
</div>
   <?php } ?>
                            </div>
                        </div>
                        <?php } ?>

                        <?php if(!empty($newbie_items) && is_array($newbie_items)) { ?>
                        <div class="tab-pane fade" id="second-tab-pane" role="tabpanel" aria-labelledby="second-tab" tabindex="0">
                            <div class="row g-4">
                                <?php
    foreach ($newbie_items as $newbie_item)
            {
                $newbie_item_details = $cc['base_url'].slug2url_fnc('items_details', $newbie_item['item_id'], $newbie_item['slug'], $newbie_item['meta_title']);
                 $newbie_item_quickview_image = $cc['img_url'].display_image_fnc('webp-'.$cc['large_image_width'].'x'.$cc['large_image_height'], $newbie_item['upload_file'], 'normal', $cc['cache_image'], $cc['image_original']);
                ?>
<div class="col-12 col-sm-6 col-md-4 col-lg-3 py-2">
  <div class="card h-100 shadow-sm border-0 item-card rating-zone wow bounceIn">
    <div class="position-relative" data-rating="<?php echo $newbie_item['ratings']; ?>" id="<?php echo 'item_'.$newbie_item['item_id'].'_zone';?>">
      <!-- Badges -->
      <?php if($newbie_item['price_previous'] > $newbie_item['price'] && $cc['badge_sale'] == 'TRUE'){ ?>
        <span class="badge bg-danger position-absolute top-0 end-0 m-2 z-3">Sale</span>
      <?php } ?>
      <?php if($newbie_item['newbie'] && $cc['badge_newbie'] == 'TRUE'){ ?>
        <span class="badge bg-success position-absolute top-0 start-0 m-2 z-3">New</span>
      <?php } ?>
      <?php if($newbie_item['featured'] && $cc['badge_featured'] == 'TRUE'){ ?>
        <span class="badge bg-warning text-dark position-absolute top-0 start-0 m-2 ms-5 z-3">Featured</span>
      <?php } ?>

     <div class="position-relative overflow-hidden">
<a href="<?php echo $newbie_item_details; ?>" class="text-decoration-none" data-bs-toggle="tooltip" title="<?php echo $newbie_item['title']; ?>">
  <img src="<?php echo $cc['img_url'].display_image_fnc('webp-'.$cc['medium_image_width'].'x'.$cc['medium_image_height'], $newbie_item['upload_file'], 'fix', $cc['cache_image'], $cc['image_original']); ?>" 
       class="card-img-top img-fluid main-img"
       alt="<?php echo $newbie_item['name']; ?>">

  <?php if(!empty($newbie_item['upload_file2'])){ ?>
      <img src="<?php echo $cc['img_url'].display_image_fnc('webp-'.$cc['medium_image_width'].'x'.$cc['medium_image_height'], $newbie_item['upload_file2'], 'fix', $cc['cache_image'], $cc['image_original']); ?>" 
           class="card-img-top img-fluid position-absolute top-0 start-0 child-img"
           alt="<?php echo $newbie_item['name']; ?>">
  <?php } ?>
</a>
</div>

    </div>

    <div class="card-body text-center item-rating">
      <!-- Product Title -->
      <h5 class="card-title">
        <a href="<?php echo $newbie_item_details; ?>" class="text-decoration-none" data-bs-toggle="tooltip" title="<?php echo $newbie_item['title']; ?>">
          <?php echo $newbie_item['name']; ?>
        </a>
      </h5>
      <p class="card-text mb-1">Model: <?php echo $newbie_item['model']; ?></p>

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
          US $<?php echo number_format($newbie_item['price'], 2); ?>
          <?php if($newbie_item['price_previous'] > $newbie_item['price']){ ?>
            <span class="text-danger text-decoration-line-through">
              US $<?php echo number_format($newbie_item['price_previous'], 2); ?>
            </span>
          <?php } ?>
        </p>
      <?php } ?>
    </div>

    <!-- Action Buttons -->
    <div class="card-footer bg-transparent border-0 text-center">
      <div class="btn-group" role="group">
        <button class="btn btn-outline-secondary btn-sm" onclick='item_quick_view_fnc( JSON.parse(this.dataset.details), this.dataset.image, this.dataset.link, token )' data-details='<?php echo htmlspecialchars(json_encode($newbie_item), ENT_QUOTES, "UTF-8"); ?>' data-image='<?php echo htmlspecialchars($newbie_item_quickview_image, ENT_QUOTES, "UTF-8"); ?>' data-link='<?php echo htmlspecialchars($newbie_item_details, ENT_QUOTES, "UTF-8"); ?>' data-bs-toggle="tooltip" title="Quick View">
          <i class="fa-solid fa-magnifying-glass"></i>
        </button>
        <button class="btn btn-outline-secondary btn-sm" onclick='item_quick_send_fnc( JSON.parse(this.dataset.details), this.dataset.image, this.dataset.link, token )' data-details='<?php echo htmlspecialchars(json_encode($newbie_item), ENT_QUOTES, "UTF-8"); ?>' data-image='<?php echo htmlspecialchars($newbie_item_quickview_image, ENT_QUOTES, "UTF-8"); ?>' data-link='<?php echo htmlspecialchars($newbie_item_details, ENT_QUOTES, "UTF-8"); ?>' data-bs-toggle="tooltip" title="Enquire Now">
          <i class="fa-solid fa-paper-plane"></i>
        </button>
        <button class="btn btn-outline-secondary btn-sm" onclick='add2cart_fnc("<?php echo $newbie_item['item_id'] ?>", token, event);' data-bs-toggle="tooltip" title="Add To Quote Cart">
          <i class="fa-solid fa-basket-shopping"></i>
        </button>
        <a href="<?php echo $newbie_item_details; ?>" class="btn btn-outline-secondary btn-sm" data-bs-toggle="tooltip" title="More Info">
          <i class="fa-solid fa-info"></i>
        </a>
      </div>
    </div>
  </div>
</div>
   <?php }?> 
                            </div>
                        </div>
                        <?php } ?>

                        <?php if(!empty($featured_items) && is_array($featured_items)) { ?>
                        <div class="tab-pane fade" id="third-tab-pane" role="tabpanel" aria-labelledby="third-tab" tabindex="0">
                            <div class="row g-4">
                                <?php foreach ($featured_items as $featured_item)
            {
                $featured_item_details = $cc['base_url'].slug2url_fnc('items_details', $featured_item['item_id'], $featured_item['slug'], $featured_item['meta_title']);
                 $featured_item_quickview_image = $cc['img_url'].display_image_fnc('webp-'.$cc['large_image_width'].'x'.$cc['large_image_height'], $featured_item['upload_file'], 'normal', $cc['cache_image'], $cc['image_original']);    
                ?>
<div class="col-12 col-sm-6 col-md-4 col-lg-3 py-2">
  <div class="card h-100 shadow-sm border-0 item-card rating-zone wow bounceIn">
    <div class="position-relative" data-rating="<?php echo $featured_item['ratings']; ?>" id="<?php echo 'item_'.$featured_item['item_id'].'_zone';?>">
      <!-- Badges -->
      <?php if($featured_item['price_previous'] > $featured_item['price'] && $cc['badge_sale'] == 'TRUE'){ ?>
        <span class="badge bg-danger position-absolute top-0 end-0 m-2 z-3">Sale</span>
      <?php } ?>
      <?php if($featured_item['newbie'] && $cc['badge_newbie'] == 'TRUE'){ ?>
        <span class="badge bg-success position-absolute top-0 start-0 m-2 z-3">New</span>
      <?php } ?>
      <?php if($featured_item['featured'] && $cc['badge_featured'] == 'TRUE'){ ?>
        <span class="badge bg-warning text-dark position-absolute top-0 start-0 m-2 ms-5 z-3">Featured</span>
      <?php } ?>

     <div class="position-relative overflow-hidden">
<a href="<?php echo $featured_item_details; ?>" class="text-decoration-none" data-bs-toggle="tooltip" title="<?php echo $featured_item['title']; ?>">
  <img src="<?php echo $cc['img_url'].display_image_fnc('webp-'.$cc['medium_image_width'].'x'.$cc['medium_image_height'], $featured_item['upload_file'], 'fix', $cc['cache_image'], $cc['image_original']); ?>" 
       class="card-img-top img-fluid main-img"
       alt="<?php echo $featured_item['name']; ?>">

  <?php if(!empty($featured_item['upload_file2'])){ ?>
      <img src="<?php echo $cc['img_url'].display_image_fnc('webp-'.$cc['medium_image_width'].'x'.$cc['medium_image_height'], $featured_item['upload_file2'], 'fix', $cc['cache_image'], $cc['image_original']); ?>" 
           class="card-img-top img-fluid position-absolute top-0 start-0 child-img"
           alt="<?php echo $featured_item['name']; ?>">
  <?php } ?>
</a>
</div>

    </div>

    <div class="card-body text-center item-rating">
      <!-- Product Title -->
      <h5 class="card-title">
        <a href="<?php echo $featured_item_details; ?>" class="text-decoration-none" data-bs-toggle="tooltip" title="<?php echo $featured_item['title']; ?>">
          <?php echo $featured_item['name']; ?>
        </a>
      </h5>
      <p class="card-text mb-1">Model: <?php echo $featured_item['model']; ?></p>

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
          US $<?php echo number_format($featured_item['price'], 2); ?>
          <?php if($featured_item['price_previous'] > $featured_item['price']){ ?>
            <span class="text-danger text-decoration-line-through">
              US $<?php echo number_format($featured_item['price_previous'], 2); ?>
            </span>
          <?php } ?>
        </p>
      <?php } ?>
    </div>

    <!-- Action Buttons -->
    <div class="card-footer bg-transparent border-0 text-center">
      <div class="btn-group" role="group">
        <button class="btn btn-outline-secondary btn-sm" onclick='item_quick_view_fnc( JSON.parse(this.dataset.details), this.dataset.image, this.dataset.link, token )' data-details='<?php echo htmlspecialchars(json_encode($featured_item), ENT_QUOTES, "UTF-8"); ?>' data-image='<?php echo htmlspecialchars($featured_item_quickview_image, ENT_QUOTES, "UTF-8"); ?>' data-link='<?php echo htmlspecialchars($featured_item_details, ENT_QUOTES, "UTF-8"); ?>' data-bs-toggle="tooltip" title="Quick View">
          <i class="fa-solid fa-magnifying-glass"></i>
        </button>
        <button class="btn btn-outline-secondary btn-sm" onclick='item_quick_send_fnc( JSON.parse(this.dataset.details), this.dataset.image, this.dataset.link, token )' data-details='<?php echo htmlspecialchars(json_encode($featured_item), ENT_QUOTES, "UTF-8"); ?>' data-image='<?php echo htmlspecialchars($featured_item_quickview_image, ENT_QUOTES, "UTF-8"); ?>' data-link='<?php echo htmlspecialchars($featured_item_details, ENT_QUOTES, "UTF-8"); ?>' data-bs-toggle="tooltip" title="Enquire Now">
          <i class="fa-solid fa-paper-plane"></i>
        </button>
        <button class="btn btn-outline-secondary btn-sm" onclick='add2cart_fnc("<?php echo $featured_item['item_id'] ?>", token, event);' data-bs-toggle="tooltip" title="Add To Quote Cart">
          <i class="fa-solid fa-basket-shopping"></i>
        </button>
        <a href="<?php echo $featured_item_details; ?>" class="btn btn-outline-secondary btn-sm" data-bs-toggle="tooltip" title="More Info">
          <i class="fa-solid fa-info"></i>
        </a>
      </div>
    </div>
  </div>
</div>
   <?php  } ?>
                            </div>
                        </div>
                        <?php } ?>
                        
                    </div> 
                </div> 
            </div> 
        </div>
    </div> 
</section> 


<section class="container-fluid t-gallery_videos galleries py-5 wow slideInRight">
  <div class="container">
    <div class="row justify-content-center text-center">
	  <div class="col-12">
		<div class="title mb-4">
		  <h2 class="fw-bold t-heading text-center">Trusted by Thousands of Clients Like Yours</h2>
		<p class="text-muted">
		Discover why businesses worldwide rely on us. From authentic client success stories to inspiring case studies and expert insights, our gallery highlights the trust and satisfaction of thousands of customers. See how we deliver value, build relationships, and empower growth every step of the way.
		</p>
		</div>
	  </div>
	  <div class="col-md-12 pt-3">
		<div class="row g-3">
		  <?php 
		  if(!empty($gallery_videos) && is_array($gallery_videos)) {
			  foreach($gallery_videos as $videos){
		  ?>
		  <div class="col-6 col-md-3">
			<div class="video-box">
			  <a href="<?php echo $videos['link']; ?>" data-fancybox="gallery_videos" data-caption="<h4><?php echo $videos['title']; ?></h4><?php echo htmlspecialchars_decode($videos['description']); ?>">
				<img src="<?php echo $cc['img_url'].display_image_fnc('webp-'.$cc['medium_image_width'].'x'.$cc['medium_image_height'], $videos['upload_file'], 'auto', $cc['cache_image'], true); ?>" alt="<?php echo $videos['title']; ?>" class="img-fluid">
				<div class="play-area">
				  <i class="fa-solid fa-circle-play icon"></i> <?php echo $videos['name']; ?>
				</div>
			  </a>
			</div>
		  </div>
		  <?php 
			  }					
			}
		  ?>
		</div>
</div>

<div class="col-md-12 mt-5"><a href="<?php echo $cc['base_url'].'g26/videos-gallery.html'; ?>" class="btn btn-secondary hvr-bounce-to-right">Visit Video Gallery Page to Know <?php echo $cc['app_name']; ?> More</a></div>

</div>

  </div>
</section>


<section class="container-fluid t-gallery_images galleries py-5 wow slideInLeft">
  <div class="container">
    <div class="row justify-content-center text-center">
      <div class="col-12">
        <div class="title mb-4">
          <h2 class="fw-bold t-heading text-center">Explore Our Visual Journey: A Gallery of Excellence</h2>
          <p class="text-muted">
            Step into our world of creativity and craftsmanship. This gallery showcases the artistry, innovation, and attention to detail that define our brand. From striking visuals to inspiring designs, experience excellence brought to life through every image.
          </p>
        </div>
      </div>

      <div class="col-md-12 pt-3">
        <div class="row g-3">
          <?php 
          if(!empty($gallery_images) && is_array($gallery_images)) {
              foreach($gallery_images as $images){
          ?>
          <div class="col-6 col-md-4 col-lg-2">
            <div class="image-box">
              <a href="<?php echo $cc['img_url'].display_image_fnc('webp-0x0', $images['upload_file'], 'normal', $cc['cache_image'], true); ?>" 
                 data-fancybox="gallery_images" 
                 data-caption="<h4><?php echo $images['title']; ?></h4><?php echo htmlspecialchars_decode($images['description']); ?>" >
                <img src="<?php echo $cc['img_url'].display_image_fnc('webp-'.$cc['small_image_width'].'x'.$cc['small_image_height'], $images['upload_file'], 'auto', $cc['cache_image'], true); ?>" 
                     alt="<?php echo $images['title']; ?>" 
                     class="img-fluid">
                <div class="icon-overlay">
                  <i class="fa-solid fa-up-right-and-down-left-from-center"></i>
                </div>
                <div class="details-area">
                  <?php echo $images['name']; ?>
                </div>
              </a>
            </div>
          </div>
          <?php 
              }                 
            }
          ?>
        </div>
      </div>

      <div class="col-md-12 mt-5 text-center">
        <a href="<?php echo $cc['base_url'].'g21/images-gallery.html'; ?>" 
           class="btn btn-primary hvr-shutter-in-horizontal">
           Visit Full Image Gallery to Explore <?php echo $cc['app_name']; ?> More
        </a>
      </div>
    </div>
  </div>
</section>

<?php if($featured_blogs_posts){  ?>
<section class="container-fluid py-5">
    <div class="container">
        <div class="row mb-5">
            <div class="col-12 text-center">
                <small class="text-uppercase text-secondary mb-2 d-block" style="letter-spacing: 0.3rem;">Our Blogs</small>
                <h2 class="display-4 fw-light mb-3">Latest <span class="fw-bold border-bottom border-1 border-dark pb-0">Insights</span></h2>
                <p class="text-secondary col-lg-6 mx-auto">Curated stories, expert opinions, and industry trends delivered with elegance</p>
            </div>
        </div>
      
   <div class="row g-4 mb-5">
  <?php 
    $blogs_posts_counter = 0;
    foreach ($featured_blogs_posts as $blogs_posts)
        {
           $blogs_posts_counter++;
      $blogs_posts_col_class = ($blogs_posts_counter === 1) ? 'col-lg-8' : 'col-lg-4'; ?>
<div class="col-12 col-md-6 <?php echo $blogs_posts_col_class; ?>">
<div class="card border-0 rounded-4 shadow-sm blog-card shortpost rating-zone" >
    <img src="<?php echo $cc['img_url'].display_image_fnc('webp-'.$cc['post_medium_image_width'].'x'.$cc['post_medium_image_height'], $blogs_posts['upload_file'], 'auto', $cc['cache_image'], true); ?>" class="card-img-top rounded-top-4" data-bs-toggle="tooltip" alt="<?php echo $blogs_posts['title']; ?>" title="<?php echo $blogs_posts['title']; ?>" style="height: <?php echo $cc['post_medium_image_height']; ?>px;">
    <div class="card-body p-3 d-flex flex-column" data-rating="<?php echo $blogs_posts['ratings']; ?>">
        <?php if(!empty($blogs_posts['parents_blogs_categories'])) { ?>
        <div class="d-flex align-items-center mb-3 gap-1">
             <?php foreach ($blogs_posts['parents_blogs_categories'] as $cat) {
                             ?>
            <a href="<?php echo $cc['base_url'].slug2url_fnc('blogs_posts_by_categories', $cat['blog_category_id'], $cat['slug'], $cat['name']); ?>" class="btn btn-outline-secondary btn-sm rounded-pill categories" role="button" data-bs-toggle="tooltip" title="<?php echo $cat['title']; ?>"><?php echo $cat['name'];?></a>
            <?php } ?>
        </div>
        <?php } ?>
        <h5 class="card-title fw-bold mb-3"><?php echo $blogs_posts['name']; ?></h5>
        <div class="card-text text-secondary mb-4"><?php echo $blogs_posts['spotlight']; ?></div>
        
        <div class="d-flex align-items-center justify-content-between mb-4 post-meta">
            <?php if(!empty($blogs_posts['add_by_info'])) { 
                $gender_dp = gender_dp_fnc($blogs_posts['add_by_info']['gender']);
                ?>
            <div class="d-flex align-items-center">
                <img src="<?php echo $cc['base_url'].'public/images/'.$gender_dp; ?>" class="border rounded-circle me-2" width="32" height="32" alt="<?php echo $blogs_posts['add_by_info']['nickname']; ?>">
                <small class="fw-semibold"><?php echo $blogs_posts['add_by_info']['nickname']; ?></small>
            </div>
            <?php } ?>
            <small class="text-secondary"><i class="bi bi-calendar me-1"></i><?php echo time_short_fnc($blogs_posts['published_time']); ?></small>
        </div>

        <div class="d-flex align-items-center justify-content-between mb-4 blog-engagement">
            <?php if($cc['ratings'] == 'TRUE'){ ?>
       <div class="star-rating mb-2">
                            <i class="fa-regular fa-star"></i>
                            <i class="fa-regular fa-star"></i>
                            <i class="fa-regular fa-star"></i>
                            <i class="fa-regular fa-star"></i>
                            <i class="fa-regular fa-star"></i>
                        </div>
      <?php } ?>
            <div class="d-flex align-items-center text-secondary">
                <small class="me-3"><i class="fa-solid fa-comments"></i> <?php echo number_abbreviation_fnc($blogs_posts['comments']); ?></small>
                <small><i class="fa-solid fa-thumbs-up"></i> <?php echo number_abbreviation_fnc($blogs_posts['likes']); ?></small>
            </div>
        </div>
        
        <div class="mt-auto btn-zone">
            <a href="<?php echo $cc['base_url'].slug2url_fnc('blogs_posts_details', $blogs_posts['blog_post_id'], $blogs_posts['slug'], $blogs_posts['name']); ?>" class="btn btn-outline-dark rounded-pill px-4 py-2 w-100  stretched-link btn-readmore" data-bs-toggle="tooltip" alt="<?php echo $blogs_posts['title']; ?>" title="<?php echo $blogs_posts['title']; ?>">
                Read More <i class="bi bi-arrow-right ms-2"></i>
            </a>
        </div>
    </div>
</div>
</div>
<?php } ?> 
</div>
       
    <div class="row mt-5">
            <div class="col-12 text-center">
                <a class="btn btn-dark rounded-pill px-5 py-3 fw-semibold" href="<?php echo $cc['base_url'].'Blogs'; ?>" role="button" data-bs-toggle="tooltip" title="Explore All Articles">
                    <i class="bi bi-arrow-right me-2"></i>Explore All Articles
</a>
            </div>
        </div>
    </div>
</section>
<?php } ?>
<!-- Theme Content End
================================================== -->
  <?php echo view('frontend/'.$cc['frontend_theme'].'/common/footer');?>
<?php echo view('frontend/'.$cc['frontend_theme'].'/common/body_end');?>
</body>
<?php echo view('frontend/'.$cc['frontend_theme'].'/common/page_end');?>