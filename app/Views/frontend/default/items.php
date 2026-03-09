<?php echo view('frontend/'.$cc['frontend_theme'].'/common/page_start'); ?>
  <head>
  <?php echo view('frontend/'.$cc['frontend_theme'].'/common/head');?>
   </head>
  <body id="body"><?php echo view('frontend/'.$cc['frontend_theme'].'/common/body_start');?>
  <?php echo view('frontend/'.$cc['frontend_theme'].'/common/header');?>
  <?php echo view('frontend/'.$cc['frontend_theme'].'/common/hero_slide');?>


   <!-- Theme Breadcrumb Start
================================================== -->

  <section class="container-fluid t-breadcrumb wow wobble">
	<div class="container">
		<div class="row">
			<div class="col-md-12">
				<div class="content">
					<h1 class="page-name"><?php echo $content['title'];?></h1>
                  <nav aria-label="breadcrumb">
          <ol class="breadcrumb">
            <li class="breadcrumb-item"><a href="<?php echo $cc['base_url'];?>">Home</a></li>
            <li class="breadcrumb-item active" aria-current="page"><?php echo $content['name'];?></li>
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

<?php 
$subcategory_list = [];

if($content['by'] == 'ibc'){
   
$subcategory_list = get_first_level_fnc($categories_tree, $category_id, 'items_by_categories', 'category', $cc['base_url']);

if(count($subcategory_list) > 0){  
?>
<section class="container-fluid t-category py-5">
  <div class="container">
    <?php $i = 1; foreach ($subcategory_list as $index => $subcategory) { ?>
      <div class="row category-row align-items-center mb-5 <?php echo ($index % 2 !== 0) ? 'reverse' : ''; ?>  wow bounceIn">
        
        <!-- IMAGE -->
        <div class="col-lg-6 mb-4 mb-lg-0">
          <div class="category-image">
            <a href="<?php echo $subcategory['link']; ?>">
              <img
                src="<?php echo $cc['img_url'] . display_image_fnc('webp-' . $cc['category_image_width'] . 'x' . $cc['category_image_height'], $subcategory['image1'], 'fix', $cc['cache_image'], true); ?>"
                alt="<?php echo $subcategory['title']; ?>"
                class="img-fluid"
              >
            </a>
          </div>
        </div>

        <!-- CONTENT -->
        <div class="col-lg-6">
          <div class="category-content">
            <span class="category-number">0<?php echo $i; ?></span>
            <h3 class="category-title"><?php echo $subcategory['name']; ?></h3>
            <div class="category-features my-4">
                                <div class="feature-item d-inline-block me-3 mb-2 hvr-pulse">
                                    <i class="fas fa-check-circle text-accent me-1"></i>
                                    Customizable
                                </div>
                                <div class="feature-item d-inline-block me-3 mb-2 hvr-pulse">
                                    <i class="fas fa-check-circle text-accent me-1"></i>
                                    Trusted Quality
                                </div>
                                <div class="feature-item d-inline-block mb-2 hvr-pulse">
                                    <i class="fas fa-check-circle text-accent me-1"></i>
                                    Global Reach
                                </div>
                            </div>
            <p class="category-desc">
              <?php echo $subcategory['spotlight']; ?>
            </p>
            <a href="<?php echo $subcategory['link']; ?>" class="btn btn-primary btn-round-full hvr-radial-out">
                        Explore Collection <i class="fa-solid fa-arrow-right ms-2"></i>
                    </a>
          </div>
        </div>

      </div>
    <?php $i++; } ?>
  </div>
</section>
 <?php } 
 }
 ?>
<?php if($pagination || count($subcategory_list) < 1){  ?>
<section class="container-fluid t-items_list wow pulse">

<div class="container">
  <?php if($pagination){ ?>
		<div class="row g-3 my-1">
      <?php  foreach ($pagination['result'] as $row)
                    { 
           $row_details = $cc['base_url'].slug2url_fnc('items_details', $row['item_id'], $row['slug'], $row['meta_title']);
           $row_quickview_image = $cc['img_url'].display_image_fnc('webp-'.$cc['large_image_width'].'x'.$cc['large_image_height'], $row['upload_file'], 'normal', $cc['cache_image'], $cc['image_original']);                      
                      ?>
      <div class="col-12 col-sm-6 col-md-4 col-lg-3 py-2">
  <div class="card h-100 shadow-sm border-0 item-card rating-zone wow bounceIn">
    <div class="position-relative" data-rating="<?php echo $row['ratings']; ?>" id="<?php echo 'item_'.$row['item_id'].'_zone';?>">
      <!-- Badges -->
      <?php if($row['price_previous'] > $row['price'] && $cc['badge_sale'] == 'TRUE'){ ?>
        <span class="badge bg-danger position-absolute top-0 end-0 m-2 z-3">Sale</span>
      <?php } ?>
      <?php if($row['newbie'] && $cc['badge_newbie'] == 'TRUE'){ ?>
        <span class="badge bg-success position-absolute top-0 start-0 m-2 z-3">New</span>
      <?php } ?>
      <?php if($row['featured'] && $cc['badge_featured'] == 'TRUE'){ ?>
        <span class="badge bg-warning text-dark position-absolute top-0 start-0 m-2 ms-5 z-3">Featured</span>
      <?php } ?>

     <div class="position-relative overflow-hidden">
<a href="<?php echo $row_details; ?>" class="text-decoration-none" data-bs-toggle="tooltip" title="<?php echo $row['title']; ?>">
  <img src="<?php echo $cc['img_url'].display_image_fnc('webp-'.$cc['medium_image_width'].'x'.$cc['medium_image_height'], $row['upload_file'], 'fix', $cc['cache_image'], $cc['image_original']); ?>" 
       class="card-img-top img-fluid main-img"
       alt="<?php echo $row['name']; ?>">

  <?php if(!empty($row['upload_file2'])){ ?>
      <img src="<?php echo $cc['img_url'].display_image_fnc('webp-'.$cc['medium_image_width'].'x'.$cc['medium_image_height'], $row['upload_file2'], 'fix', $cc['cache_image'], $cc['image_original']); ?>" 
           class="card-img-top img-fluid position-absolute top-0 start-0 child-img"
           alt="<?php echo $row['name']; ?>">
  <?php } ?>
</a>
</div>

    </div>

    <div class="card-body text-center item-rating">
      <!-- Product Title -->
      <h5 class="card-title">
        <a href="<?php echo $row_details; ?>" class="text-decoration-none" data-bs-toggle="tooltip" title="<?php echo $row['title']; ?>">
          <?php echo $row['name']; ?>
        </a>
      </h5>
      <p class="card-text mb-1">Model: <?php echo $row['model']; ?></p>

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
          US $<?php echo number_format($row['price'], 2); ?>
          <?php if($row['price_previous'] > $row['price']){ ?>
            <span class="text-danger text-decoration-line-through">
              US $<?php echo number_format($row['price_previous'], 2); ?>
            </span>
          <?php } ?>
        </p>
      <?php } ?>
    </div>

    <!-- Action Buttons -->
    <div class="card-footer bg-transparent border-0 text-center">
      <div class="btn-group" role="group">
        <button class="btn btn-outline-secondary btn-sm" onclick='item_quick_view_fnc( JSON.parse(this.dataset.details), this.dataset.image, this.dataset.link, token )' data-details='<?php echo htmlspecialchars(json_encode($row), ENT_QUOTES, "UTF-8"); ?>' data-image='<?php echo htmlspecialchars($row_quickview_image, ENT_QUOTES, "UTF-8"); ?>' data-link='<?php echo htmlspecialchars($row_details, ENT_QUOTES, "UTF-8"); ?>' data-bs-toggle="tooltip" title="Quick View">
          <i class="fa-solid fa-magnifying-glass"></i>
        </button>
        <button class="btn btn-outline-secondary btn-sm" onclick='item_quick_send_fnc( JSON.parse(this.dataset.details), this.dataset.image, this.dataset.link, token )' data-details='<?php echo htmlspecialchars(json_encode($row), ENT_QUOTES, "UTF-8"); ?>' data-image='<?php echo htmlspecialchars($row_quickview_image, ENT_QUOTES, "UTF-8"); ?>' data-link='<?php echo htmlspecialchars($row_details, ENT_QUOTES, "UTF-8"); ?>' data-bs-toggle="tooltip" title="Enquire Now">
          <i class="fa-solid fa-paper-plane"></i>
        </button>
        <button class="btn btn-outline-secondary btn-sm" onclick='add2cart_fnc("<?php echo $row['item_id'] ?>", token, event);' data-bs-toggle="tooltip" title="Add To Quote Cart">
          <i class="fa-solid fa-basket-shopping"></i>
        </button>
        <a href="<?php echo $row_details; ?>" class="btn btn-outline-secondary btn-sm" data-bs-toggle="tooltip" title="More Info">
          <i class="fa-solid fa-info"></i>
        </a>
      </div>
    </div>
  </div>
</div>
      <?php } ?>
		</div>
    <?php if($content['paging'] == true){ ?>
  <div class="row justify-content-center text-center text-md-start">
    <div class="col-12 col-md-8 pt-3 d-flex justify-content-center justify-content-md-start">
      <?php echo $pagination['pager']; ?>
    </div>
<div class="col-12 col-md-4 pt-3 d-flex justify-content-center justify-content-md-end align-items-center small text-muted text-nowrap pagination-info">
      <?php echo $pagination['start'].' - '.$pagination['end'].' Of '.$pagination['total_records'].' Records, Total Pages: '.$pagination['total_pages']; ?>
    </div>
  </div>
<?php } ?>

<?php }else{
           if(count($subcategory_list) < 1){
            echo '<div class="text-bg-danger p-4 m-4">The requested record was not found</div>';
  }
          } ?>
</div>

</section>
<?php } ?>
<!-- Theme Content End
================================================== -->
  <?php echo view('frontend/'.$cc['frontend_theme'].'/common/footer');?>
<?php echo view('frontend/'.$cc['frontend_theme'].'/common/body_end');?>
</body>
<?php echo view('frontend/'.$cc['frontend_theme'].'/common/page_end');?>