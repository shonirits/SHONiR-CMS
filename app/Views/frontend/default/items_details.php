<?php echo view('frontend/'.$cc['frontend_theme'].'/common/page_start'); ?>
  <head>
  <?php echo view('frontend/'.$cc['frontend_theme'].'/common/head');?>
   </head>
  <body id="body"><?php echo view('frontend/'.$cc['frontend_theme'].'/common/body_start');?>
  <?php echo view('frontend/'.$cc['frontend_theme'].'/common/header');?>
  <?php echo view('frontend/'.$cc['frontend_theme'].'/common/hero_slide');?>
  <!-- Theme Content Start
================================================== -->

<section class="container-fluid t-items_details py-4">

<div class="container ">
		<div class="row align-items-center mb-4 g-3">
            <div class="col-md-6">
                <nav aria-label="breadcrumb">
                    <ol class="breadcrumb mb-0">
                        <li class="breadcrumb-item"><a href="<?php echo $cc['base_url']; ?>">Home</a></li>
                        <li class="breadcrumb-item active" aria-current="page"><?php echo $row['name'];?></li>
                    </ol>
                </nav>
            </div>
            <div class="col-md-6">
                <ul class="product-pagination list-unstyled d-flex justify-content-md-end gap-3 mb-0">
                    <?php if($previous){ ?>
                        <li><a href="<?php echo $cc['base_url'].slug2url_fnc('items_details', $previous['item_id'], $previous['slug'], $previous['name']); ?>" class="btn btn-primary btn-nav"  data-bs-toggle="tooltip" title="<?php echo $previous['name']; ?>"><i class="fa-solid fa-chevron-left"></i> Previous</a></li>
                    <?php } ?>
                    <?php if($next){ ?>
                        <li><a href="<?php echo $cc['base_url'].slug2url_fnc('items_details', $next['item_id'], $next['slug'], $next['name']); ?>" class="btn btn-primary btn-nav"  data-bs-toggle="tooltip" title="<?php echo $next['name']; ?>">Next <i class="fa-solid fa-chevron-right"></i></a></li>
                    <?php } ?>
                </ul>
            </div>
        </div>

 
     <!-- USP Cards -->
    <div class="row g-4 mb-5">
      <?php
      $usp = [
        ['fa-cogs','Tailored to Your Needs','With over 36 years of manufacturing expertise, we specialize in OEM and ODM solutions.'],
        ['fa-shield-alt','Trusted Quality','Every product is inspected under strict quality control procedures.'],
        ['fa-globe','Global Reach','Trusted by retailers across the US & Europe including Amazon & Walmart.'],
        ['fa-users','Proven Expertise','International AQL standards with transparent QC reporting.'],
        ['fa-tags','Pricing Transparency','Fair, straightforward, customized quotes — no hidden fees.'],
        ['fa-bolt','Fast Response','Quick replies and smooth communication from inquiry to delivery.']
      ];

      foreach ($usp as $u) { ?>
        <div class="col-md-6 col-lg-4">
          <div class="usp-card">
            <i class="fas <?php echo $u[0]; ?>"></i>
            <h5><?php echo $u[1]; ?></h5>
            <p><?php echo $u[2]; ?></p>
          </div>
        </div>
      <?php } ?>
    </div>


<div class="row" id="<?php echo 'item_'.$row['item_id'].'_zone';?>">
<div class="col-md-5 py-2">  
<?php  $main_image_link = '';
if (!empty($images) && is_array($images)) {
    if (count($images) > 1) {

    if($main_image_link == '') {
          $main_image_link = $cc['img_url'] . display_image_fnc('webp-0x0', $images[0]['upload_file'], 'auto', $cc['cache_image'], $cc['image_original']);
        }

        ?>
        <div class="f-carousel pb-3" id="itemCarousel">
          <?php foreach ($images as $image) { ?>
            <div class="f-carousel__slide item_badges"
                 data-src="<?php echo $cc['img_url'] . display_image_fnc('webp-0x0', $image['upload_file'], 'auto', $cc['cache_image'], $cc['image_original']); ?>"
                 data-fancybox="items_images"
                 data-thumb-src="<?php echo $cc['img_url'] . display_image_fnc('webp-0x0', $image['upload_file'], 'auto', $cc['cache_image'], $cc['image_original']); ?>"
            >
              <?php if ($row['price'] < $row['price_previous'] && $cc['badge_sale'] == 'TRUE') { ?>
                <span class="badge sale">Sale</span>
              <?php } ?>
              <?php if ($row['newbie'] && $cc['badge_newbie'] == 'TRUE') { ?>
                <span class="badge newbie">New</span>
              <?php } ?>
              <?php if ($row['featured'] && $cc['badge_featured'] == 'TRUE') { ?>
                <span class="badge featured">Featured</span>
              <?php } ?>
              <?php if ($row['hd'] && $cc['badge_hd'] == 'TRUE') { ?>
                <span class="badge hd">HD</span>
              <?php } ?>
              <?php if ($row['lq'] && $cc['badge_lq'] == 'TRUE') { ?>
                <span class="badge lq">LQ</span>
              <?php } ?>
              <?php if ($row['st'] && $cc['badge_st'] == 'TRUE') { ?>
                <span class="badge st">ST</span>
              <?php } ?>

              <img class="img-fluid"
                data-lazy-src="<?php echo $cc['img_url'] . display_image_fnc('webp-0x0', $image['upload_file'], 'auto', $cc['cache_image'], $cc['image_original']); ?>"
                loading="lazy"
                 alt="<?php echo $row['name']; ?>"
                title="<?php echo $row['name']; ?>"
              />
            </div>
          <?php } ?>
        </div>
        <?php
    } else {
      $main_image_link = $cc['img_url'] . display_image_fnc('webp-0x0', $images[0]['upload_file'], 'auto', $cc['cache_image'], $cc['image_original']);
        ?>
        <div class="f-carousel__slide item_badges"
             data-thumb-src="<?php echo $cc['img_url'].display_image_fnc('webp-0x0', $images[0]['upload_file'], 'auto', $cc['cache_image'], $cc['image_original']); ?>"
             data-fancybox="items_images"
             data-src="<?php echo $cc['img_url'].display_image_fnc('webp-0x0', $images[0]['upload_file'], 'auto', $cc['cache_image'], $cc['image_original']); ?>"
        >
          <?php if ($row['price'] < $row['price_previous'] && $cc['badge_sale'] == 'TRUE') { ?>
            <span class="badge sale">Sale</span>
          <?php } ?>
          <?php if ($row['newbie'] && $cc['badge_newbie'] == 'TRUE') { ?>
            <span class="badge newbie">New</span>
          <?php } ?>
          <?php if ($row['featured'] && $cc['badge_featured'] == 'TRUE') { ?>
            <span class="badge featured">Featured</span>
          <?php } ?>
          <?php if ($row['hd'] && $cc['badge_hd'] == 'TRUE') { ?>
            <span class="badge hd">HD</span>
          <?php } ?>
          <?php if ($row['lq'] && $cc['badge_lq'] == 'TRUE') { ?>
            <span class="badge lq">LQ</span>
          <?php } ?>
          <?php if ($row['st'] && $cc['badge_st'] == 'TRUE') { ?>
            <span class="badge st">ST</span>
          <?php } ?>

          <img alt="<?php echo $row['name'];?>"
               class="img-fluid"
               data-src="<?php echo $cc['img_url'].display_image_fnc('webp-0x0', $images[0]['upload_file'], 'auto', $cc['cache_image'], $cc['image_original']); ?>"
               loading="lazy"
          />
        </div>
        <?php
    }
} else {
    ?>
    <div class="noImage">No Image Available</div>
    <?php
}
?>
      </div>
      <div class="col-md-7 py-2">
      <form name="item_<?php echo $row['item_id']; ?>_frm" id="item_<?php echo $row['item_id']; ?>_frm" class="needs-validation" novalidate>
        <div class="pinpoint">
         <h1 class="title"><?php echo $row['title']; ?></h1>
          <span class="model">Model: <?php echo $row['model']; ?></span>

          <?php if($cc['ratings'] == 'TRUE'){ ?>
            <div class="ratings">
				Rating: <span id="rate_item<?php echo $row['item_id'];?>" class="star-ratings"></span><span id="rate_live_item<?php echo $row['item_id'];?>" class="live-ratings"><?php echo $row['ratings'];?></span>
        </div>
        <?php } ?>

        
          <?php 
        if($cc['likes'] == 'TRUE'){?>
        <div class="likes">Likes: 
        <span class="do-likes" id="do_like_item<?php echo $row['item_id'];?>"><?php echo ($row['liked'] == 'true')?'<i class="fa-solid fa-thumbs-up"></i>':'<i class="fa-regular fa-thumbs-up"></i>';?></span>
        <span class="info-likes" id="info_like_item<?php echo $row['item_id'];?>"><?php echo number_abbreviation_fnc($row['likes']);?></span>
        </div>
        <?php } ?>


        <?php if($cc['price'] == 'TRUE'){?>
                        <div class="price-box my-4">
                            <span class="price-label">Estimated Price:</span>
                            <h2 class="price-value">US $ <?php echo number_format($row['price'], 2).' - '; echo ($row['price_previous'] > $row['price'])?number_format($row['price_previous'], 2):number_format($row['price'], 2); ?></h2>
                            <p class="small text-muted mb-0 price-hint">*Prices vary based on customization & quantity.</p>
                        </div>
                    <?php } ?>
					
					<div class="spotlight">
						<?php echo $row['spotlight'];?>
</div>


 <?php if($cc['app_type']){?>
<div class="row quantity align-items-center">
  <div class="col-auto">
    <label for="quantity" class="col-form-label">Quantity:</label>
  </div>
  <div class="col-auto">
    <input type="number" id="quantity" name="quantity" class="form-control" min="<?php echo $row['minimum']; ?>" max="<?php echo ($row['stock'] > $row['minimum'])?$row['stock']:$row['minimum']; ?>" step="1" value="<?php echo $row['minimum']; ?>" inputmode="numeric" pattern="[0-9]*" oninput="this.value = this.value.replace(/[^0-9]/g, '');" required> <div class="invalid-feedback">
                                    There is a minimum <?php echo $row['minimum']; ?> & maximum <?php echo ($row['stock'] > $row['minimum'])?$row['stock']:$row['minimum']; ?> quantity limit for this product.</div>
  </div>
</div>
 <?php }?>

<?php if(!empty($parents_categories)) { ?>
                        <div class="cat-tags mt-4 d-flex align-items-center">
                            <span class="small fw-bold text-muted">Categories:</span>
                            <?php foreach ($parents_categories as $cat) {
                                echo '<a href="'.$cc['base_url'].slug2url_fnc('items_by_categories', $cat['category_id'], $cat['slug'], $cat['name']).'" class="cat-link">'.$cat['name'].'</a>';
                            } ?>
                        </div>
                    <?php } 
                    
  $items_details = $cc['base_url'].slug2url_fnc('items_details', $row['item_id'], $row['slug'], $row['meta_title']);

                    ?>

<div class="action mt-4">
  <?php if($cc['app_type']){?>
          <button type="button" class="btn btn-primary hvr-radial-out" onclick="add2cart_fnc('<?php echo $row['item_id'] ?>', token, event);"  data-bs-toggle="tooltip" title="Get Free Quote"> <i class="fa-solid fa-basket-shopping"></i> Get Free Quote</button>
          <?php }?>
          <button type="button" class="btn btn-secondary hvr-radial-out"
    onclick='item_quick_send_fnc(
      JSON.parse(this.dataset.details),
      this.dataset.image,
      this.dataset.link,
      token
    )'
    data-details='<?php echo htmlspecialchars(json_encode($row), ENT_QUOTES, "UTF-8"); ?>'
    data-image='<?php echo htmlspecialchars($main_image_link, ENT_QUOTES, "UTF-8"); ?>'
    data-link='<?php echo htmlspecialchars($items_details, ENT_QUOTES, "UTF-8"); ?>'
    data-bs-toggle="tooltip" title="Enquire Now">
   <i class="fa-solid fa-paper-plane"></i> Enquire Now
</button>

</div>
        </div>
                            </form>
</div>
</div>


<!-- Tabs Section -->
        <div class="row mt-5">
            <div class="col-12">
                <div class="product-tabs">
                    <!-- Tab Navigation -->
                    <ul class="nav nav-tabs" id="productTab" role="tablist">
                        <li class="nav-item" role="presentation">
                            <button class="nav-link active" id="description-tab" data-bs-toggle="tab" data-bs-target="#description" type="button" role="tab" aria-controls="description" aria-selected="true">
                                <i class="fas fa-file-alt me-2"></i>
                                Product Description
                            </button>
                        </li>
                        
                        <?php if(!empty($in_the_same_items) && is_array($in_the_same_items)): ?>
                        <li class="nav-item" role="presentation">
                            <button class="nav-link" id="same-category-tab" data-bs-toggle="tab" data-bs-target="#same-category" type="button" role="tab" aria-controls="same-category" aria-selected="false">
                                <i class="fas fa-layer-group me-2"></i>
                                More in This Category
                            </button>
                        </li>
                        <?php endif; ?>
                        
                        <?php if(!empty($related_items) && is_array($related_items)): ?>
                        <li class="nav-item" role="presentation">
                            <button class="nav-link" id="related-products-tab" data-bs-toggle="tab" data-bs-target="#related-products" type="button" role="tab" aria-controls="related-products" aria-selected="false">
                                <i class="fas fa-random me-2"></i>
                                Belonging to the same type
                            </button>
                        </li>
                        <?php endif; ?>
                    </ul>

                    <!-- Tab Content -->
                    <div class="tab-content" id="productTabContent">
                        <!-- Description Tab -->
                        <div class="tab-pane fade show active" id="description" role="tabpanel" aria-labelledby="description-tab">
                            <div class="tab-content-inner">
                              <div class="row g-3 my-1">
                                <h3 class="tab-title t-heading text-start"><?php echo $row['name']; ?></h3>
                                <div class="description-content">
                                    <?php echo $row['description']; ?>
                                </div>
                                </div>
                            </div>
                        </div>

                        <!-- Same Category Tab -->
                        <?php if(!empty($in_the_same_items) && is_array($in_the_same_items)): ?>
                        <div class="tab-pane fade" id="same-category" role="tabpanel" aria-labelledby="same-category-tab">
                            <div class="tab-content-inner">
                                <div class="row g-3 my-1">
                                    <?php foreach ($in_the_same_items as $same_item): 
                                       $same_item_details = $cc['base_url'].slug2url_fnc('items_details', $same_item['item_id'], $same_item['slug'], $same_item['meta_title']);
                                       $same_item_quickview_image = $cc['img_url'].display_image_fnc('webp-'.$cc['large_image_width'].'x'.$cc['large_image_height'], $same_item['upload_file'], 'normal', $cc['cache_image'], $cc['image_original']);
                                         ?>
                                   <div class="col-12 col-sm-6 col-md-4 col-lg-3 py-2">
  <div class="card h-100 shadow-sm border-0 item-card rating-zone wow bounceIn">
    <div class="position-relative" data-rating="<?php echo $same_item['ratings']; ?>" id="<?php echo 'item_'.$same_item['item_id'].'_zone';?>">
      <!-- Badges -->
      <?php if($same_item['price_previous'] > $same_item['price'] && $cc['badge_sale'] == 'TRUE'){ ?>
        <span class="badge bg-danger position-absolute top-0 end-0 m-2 z-3">Sale</span>
      <?php } ?>
      <?php if($same_item['newbie'] && $cc['badge_newbie'] == 'TRUE'){ ?>
        <span class="badge bg-success position-absolute top-0 start-0 m-2 z-3">New</span>
      <?php } ?>
      <?php if($same_item['featured'] && $cc['badge_featured'] == 'TRUE'){ ?>
        <span class="badge bg-warning text-dark position-absolute top-0 start-0 m-2 ms-5 z-3">Featured</span>
      <?php } ?>

     <div class="position-relative overflow-hidden">
<a href="<?php echo $same_item_details; ?>" class="text-decoration-none" data-bs-toggle="tooltip" title="<?php echo $same_item['title']; ?>">
  <img src="<?php echo $cc['img_url'].display_image_fnc('webp-'.$cc['medium_image_width'].'x'.$cc['medium_image_height'], $same_item['upload_file'], 'fix', $cc['cache_image'], $cc['image_original']); ?>" 
       class="card-img-top img-fluid main-img"
       alt="<?php echo $same_item['name']; ?>">

  <?php if(!empty($same_item['upload_file2'])){ ?>
      <img src="<?php echo $cc['img_url'].display_image_fnc('webp-'.$cc['medium_image_width'].'x'.$cc['medium_image_height'], $same_item['upload_file2'], 'fix', $cc['cache_image'], $cc['image_original']); ?>" 
           class="card-img-top img-fluid position-absolute top-0 start-0 child-img"
           alt="<?php echo $same_item['name']; ?>">
  <?php } ?>
</a>
</div>

    </div>

    <div class="card-body text-center item-rating">
      <!-- Product Title -->
      <h5 class="card-title">
        <a href="<?php echo $same_item_details; ?>" class="text-decoration-none" data-bs-toggle="tooltip" title="<?php echo $same_item['title']; ?>">
          <?php echo $same_item['name']; ?>
        </a>
      </h5>
      <p class="card-text mb-1">Model: <?php echo $same_item['model']; ?></p>

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
          US $<?php echo number_format($same_item['price'], 2); ?>
          <?php if($same_item['price_previous'] > $same_item['price']){ ?>
            <span class="text-danger text-decoration-line-through">
              US $<?php echo number_format($same_item['price_previous'], 2); ?>
            </span>
          <?php } ?>
        </p>
      <?php } ?>
    </div>

    <!-- Action Buttons -->
    <div class="card-footer bg-transparent border-0 text-center">
      <div class="btn-group" role="group">
        <button class="btn btn-outline-secondary btn-sm" onclick='item_quick_view_fnc( JSON.parse(this.dataset.details), this.dataset.image, this.dataset.link, token )' data-details='<?php echo htmlspecialchars(json_encode($same_item), ENT_QUOTES, "UTF-8"); ?>' data-image='<?php echo htmlspecialchars($same_item_quickview_image, ENT_QUOTES, "UTF-8"); ?>' data-link='<?php echo htmlspecialchars($same_item_details, ENT_QUOTES, "UTF-8"); ?>' data-bs-toggle="tooltip" title="Quick View">
          <i class="fa-solid fa-magnifying-glass"></i>
        </button>
        <button class="btn btn-outline-secondary btn-sm" onclick='item_quick_send_fnc( JSON.parse(this.dataset.details), this.dataset.image, this.dataset.link, token )' data-details='<?php echo htmlspecialchars(json_encode($same_item), ENT_QUOTES, "UTF-8"); ?>' data-image='<?php echo htmlspecialchars($same_item_quickview_image, ENT_QUOTES, "UTF-8"); ?>' data-link='<?php echo htmlspecialchars($same_item_details, ENT_QUOTES, "UTF-8"); ?>' data-bs-toggle="tooltip" title="Enquire Now">
          <i class="fa-solid fa-paper-plane"></i>
        </button>
        <button class="btn btn-outline-secondary btn-sm" onclick='add2cart_fnc("<?php echo $same_item['item_id'] ?>", token, event);' data-bs-toggle="tooltip" title="Add To Quote Cart">
          <i class="fa-solid fa-basket-shopping"></i>
        </button>
        <a href="<?php echo $same_item_details; ?>" class="btn btn-outline-secondary btn-sm" data-bs-toggle="tooltip" title="More Info">
          <i class="fa-solid fa-info"></i>
        </a>
      </div>
    </div>
  </div>
</div>
                                    <?php endforeach; ?>
                                </div>
                            </div>
                        </div>
                        <?php endif; ?>

                        <!-- Related Products Tab -->
                        <?php if(!empty($related_items) && is_array($related_items)): ?>
                        <div class="tab-pane fade" id="related-products" role="tabpanel" aria-labelledby="related-products-tab">
                            <div class="tab-content-inner">
                                <div class="row g-3 my-1">
                                    <?php foreach ($related_items as $related_item): 
                                        $related_item_details = $cc['base_url'].slug2url_fnc('items_details', $related_item['item_id'], $related_item['slug'], $related_item['meta_title']);
                                        $related_item_quickview_image = $cc['img_url'].display_image_fnc('webp-'.$cc['large_image_width'].'x'.$cc['large_image_height'], $related_item['upload_file'], 'normal', $cc['cache_image'], $cc['image_original']);
                                    ?>
<div class="col-12 col-sm-6 col-md-4 col-lg-3 py-2">
  <div class="card h-100 shadow-sm border-0 item-card rating-zone wow bounceIn">
    <div class="position-relative" data-rating="<?php echo $related_item['ratings']; ?>" id="<?php echo 'item_'.$related_item['item_id'].'_zone';?>">
      <!-- Badges -->
      <?php if($related_item['price_previous'] > $related_item['price'] && $cc['badge_sale'] == 'TRUE'){ ?>
        <span class="badge bg-danger position-absolute top-0 end-0 m-2 z-3">Sale</span>
      <?php } ?>
      <?php if($related_item['newbie'] && $cc['badge_newbie'] == 'TRUE'){ ?>
        <span class="badge bg-success position-absolute top-0 start-0 m-2 z-3">New</span>
      <?php } ?>
      <?php if($related_item['featured'] && $cc['badge_featured'] == 'TRUE'){ ?>
        <span class="badge bg-warning text-dark position-absolute top-0 start-0 m-2 ms-5 z-3">Featured</span>
      <?php } ?>

     <div class="position-relative overflow-hidden">
<a href="<?php echo $related_item_details; ?>" class="text-decoration-none" data-bs-toggle="tooltip" title="<?php echo $related_item['title']; ?>">
  <img src="<?php echo $cc['img_url'].display_image_fnc('webp-'.$cc['medium_image_width'].'x'.$cc['medium_image_height'], $related_item['upload_file'], 'fix', $cc['cache_image'], $cc['image_original']); ?>" 
       class="card-img-top img-fluid main-img"
       alt="<?php echo $related_item['name']; ?>">

  <?php if(!empty($related_item['upload_file2'])){ ?>
      <img src="<?php echo $cc['img_url'].display_image_fnc('webp-'.$cc['medium_image_width'].'x'.$cc['medium_image_height'], $related_item['upload_file2'], 'fix', $cc['cache_image'], $cc['image_original']); ?>" 
           class="card-img-top img-fluid position-absolute top-0 start-0 child-img"
           alt="<?php echo $related_item['name']; ?>">
  <?php } ?>
</a>
</div>

    </div>

    <div class="card-body text-center item-rating">
      <!-- Product Title -->
      <h5 class="card-title">
        <a href="<?php echo $related_item_details; ?>" class="text-decoration-none" data-bs-toggle="tooltip" title="<?php echo $related_item['title']; ?>">
          <?php echo $related_item['name']; ?>
        </a>
      </h5>
      <p class="card-text mb-1">Model: <?php echo $related_item['model']; ?></p>

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
          US $<?php echo number_format($related_item['price'], 2); ?>
          <?php if($related_item['price_previous'] > $related_item['price']){ ?>
            <span class="text-danger text-decoration-line-through">
              US $<?php echo number_format($related_item['price_previous'], 2); ?>
            </span>
          <?php } ?>
        </p>
      <?php } ?>
    </div>

    <!-- Action Buttons -->
    <div class="card-footer bg-transparent border-0 text-center">
      <div class="btn-group" role="group">
        <button class="btn btn-outline-secondary btn-sm" onclick='item_quick_view_fnc( JSON.parse(this.dataset.details), this.dataset.image, this.dataset.link, token )' data-details='<?php echo htmlspecialchars(json_encode($related_item), ENT_QUOTES, "UTF-8"); ?>' data-image='<?php echo htmlspecialchars($related_item_quickview_image, ENT_QUOTES, "UTF-8"); ?>' data-link='<?php echo htmlspecialchars($related_item_details, ENT_QUOTES, "UTF-8"); ?>' data-bs-toggle="tooltip" title="Quick View">
          <i class="fa-solid fa-magnifying-glass"></i>
        </button>
        <button class="btn btn-outline-secondary btn-sm" onclick='item_quick_send_fnc( JSON.parse(this.dataset.details), this.dataset.image, this.dataset.link, token )' data-details='<?php echo htmlspecialchars(json_encode($related_item), ENT_QUOTES, "UTF-8"); ?>' data-image='<?php echo htmlspecialchars($related_item_quickview_image, ENT_QUOTES, "UTF-8"); ?>' data-link='<?php echo htmlspecialchars($related_item_details, ENT_QUOTES, "UTF-8"); ?>' data-bs-toggle="tooltip" title="Enquire Now">
          <i class="fa-solid fa-paper-plane"></i>
        </button>
        <button class="btn btn-outline-secondary btn-sm" onclick='add2cart_fnc("<?php echo $related_item['item_id'] ?>", token, event);' data-bs-toggle="tooltip" title="Add To Quote Cart">
          <i class="fa-solid fa-basket-shopping"></i>
        </button>
        <a href="<?php echo $related_item_details; ?>" class="btn btn-outline-secondary btn-sm" data-bs-toggle="tooltip" title="More Info">
          <i class="fa-solid fa-info"></i>
        </a>
      </div>
    </div>
  </div>
</div>
                                       
                                    <?php endforeach; ?>
                                </div>
                            </div>
                        </div>
                        <?php endif; ?>
                    </div>
                </div>

        </div>
    </div>

</div>
</section>
<!-- Theme Content End
================================================== -->
  <?php echo view('frontend/'.$cc['frontend_theme'].'/common/footer');?>
<?php echo view('frontend/'.$cc['frontend_theme'].'/common/body_end');?>

</body>
<?php echo view('frontend/'.$cc['frontend_theme'].'/common/page_end');?>
<script >
function content_fnc(){
  var wait_to_all_loaded = setInterval(() => {
    if (all_loaded != false) {
      if (typeof Fancybox !== "undefined" && typeof Carousel !== "undefined" && typeof bootstrap !== "undefined" && typeof jQuery.ui !== "undefined") {
        clearInterval(wait_to_all_loaded);   
          
        <?php if($cc['ratings'] == 'TRUE'){ ?>     
        let ratedColors = ['#d21917', '#7f00ff', '#edda12', '#07aee5', '#007437'];
        let ratingsNum = parseFloat(<?php echo $row['ratings'];?>) || 0;
        let ratings = ratingsNum+0.1;
        let initialRating = ratings.toFixed(0);
        let activeColor = initialRating-1;
        let rating_token = token;
       p("#rate_item<?php echo $row['item_id'];?>").starRating({
        starSize: 22,
        strokeWidth: 9,
        strokeColor: '#636363',
        hoverColor: '#0037ff',
        activeColor: ratedColors[activeColor],
        ratedColors: ratedColors,
        useGradient: false,
        initialRating: ratingsNum,
        callback: function(currentRating, $el){
          ratings_fnc('items', 'item', <?php echo $row['item_id'];?>, currentRating, rating_token);
        },
          onHover: function(currentIndex, currentRating, $el){
            d('#rate_live_item<?php echo $row['item_id'];?>').text(currentIndex);
          },
          onLeave: function(currentIndex, currentRating, $el){
            d('#rate_live_item<?php echo $row['item_id'];?>').text(currentRating);
          }
});
<?php } 
if($cc['likes'] == 'TRUE'){ ?>  
let like_token = token;
p('#do_like_item<?php echo $row['item_id'];?>').click(function() {    
  likes_fnc('items', 'item', <?php echo $row['item_id'];?>, like_token);
  });
  <?php } 
   if(count($images) > 1){ ?>
 const itemCarousel = Carousel(
        document.getElementById("itemCarousel"),
        {
           transition: 'slide',
    preload: 3,
    Dots: false,
    Thumbs: {
      type: 'classic',
      Carousel: {
        dragFree: false,
        slidesPerPage: 'auto',
        Navigation: true,
        axis: 'y',
        breakpoints: {
          '(max-width: 991px)': {
            axis: 'x',
          },
        },
      },
    },
    Images: {
      lazy: true
    }
        },
        {
          Lazyload,
          Arrows,
          Thumbs,
        }
      ).init();
<?php } ?>

Fancybox.bind('[data-fancybox="items_images"]', {
  compact: false,
  idle: false,
  dragToClose: false,
  contentClick: () =>
    window.matchMedia('(max-width: 578px), (max-height: 578px)').matches
      ? 'toggleMax'
      : 'toggleCover',
  animated: false,
  showClass: false,
  hideClass: false,
  Hash: false,
  <?php if(count($images) > 1){ ?>
  Thumbs: true,
  Carousel: {
    transition: 'fadeFast',
    preload: 3,
  },
  <?php } ?>
  Toolbar: {
    display: {
      left: [],
      middle: [],
      right: ['close'],
    },
  },
  Images: {
    zoom: true,
    Panzoom: {
      panMode: 'mousemove',
      mouseMoveFactor: 1.1,
    },
  },
});
      
 }
    }
}, 1000);
}
</script>


