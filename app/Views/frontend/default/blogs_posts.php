<?php echo view('frontend/'.$cc['frontend_theme'].'/common/page_start'); ?>
  <head>
  <?php echo view('frontend/'.$cc['frontend_theme'].'/common/head');?>
  </head>
  <body id="body"><?php echo view('frontend/'.$cc['frontend_theme'].'/common/body_start');?>
  <?php echo view('frontend/'.$cc['frontend_theme'].'/common/header');?>
  <?php echo view('frontend/'.$cc['frontend_theme'].'/common/hero_slide');?>

  <!-- Theme Content Start
================================================== -->

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
            <?php if($content['paging'] == true){ ?><li class="breadcrumb-item"><a href="<?php echo $cc['base_url'].'Blog';?>">Blog</a></li><?php } ?>
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


<section class="container-fluid t-blogs py-1">
    <div class="container">
  <div class="row">
<div class="col-12 col-md-6 col-lg-8">
  <?php if($pagination){ 
     foreach ($pagination['result'] as $row)
                    { ?>
<div class="card border-0 rounded-4 shadow-sm my-4 blog-card shortpost rating-zone" >
    <img src="<?php echo $cc['img_url'].display_image_fnc('webp-'.$cc['post_medium_image_width'].'x'.$cc['post_medium_image_height'], $row['upload_file'], 'auto', $cc['cache_image'], true); ?>" class="card-img-top rounded-top-4" data-bs-toggle="tooltip" alt="<?php echo $row['title']; ?>" title="<?php echo $row['title']; ?>" style="height: <?php echo $cc['post_medium_image_height']; ?>px;">
    <div class="card-body p-3 d-flex flex-column" data-rating="<?php echo $row['ratings']; ?>">
        <?php if(!empty($row['parents_blogs_categories'])) { ?>
        <div class="d-flex align-items-center mb-3 gap-1">
             <?php foreach ($row['parents_blogs_categories'] as $cat) {
                             ?>
            <a href="<?php echo $cc['base_url'].slug2url_fnc('blogs_posts_by_categories', $cat['blog_category_id'], $cat['slug'], $cat['name']); ?>" class="btn btn-outline-secondary btn-sm rounded-pill categories" role="button" data-bs-toggle="tooltip" title="<?php echo $cat['title']; ?>"><?php echo $cat['name'];?></a>
            <?php } ?>
        </div>
        <?php } ?>
        <h5 class="card-title fw-bold mb-3"><?php echo $row['name']; ?></h5>
        <div class="card-text text-secondary mb-4"><?php echo $row['spotlight']; ?></div>
        
        <div class="d-flex align-items-center justify-content-between mb-4 post-meta">
            <?php if(!empty($row['add_by_info'])) { 
                $gender_dp = gender_dp_fnc($row['add_by_info']['gender']);
                ?>
            <div class="d-flex align-items-center">
                <img src="<?php echo $cc['base_url'].'public/images/'.$gender_dp; ?>" class="border rounded-circle me-2" width="32" height="32" alt="<?php echo $row['add_by_info']['nickname']; ?>">
                <small class="fw-semibold"><?php echo $row['add_by_info']['nickname']; ?></small>
            </div>
            <?php } ?>
            <small class="text-secondary"><i class="bi bi-calendar me-1"></i><?php echo time_short_fnc($row['published_time']); ?></small>
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
                <small class="me-3"><i class="fa-solid fa-comments"></i> <?php echo number_abbreviation_fnc($row['comments']); ?></small>
                <small><i class="fa-solid fa-thumbs-up"></i> <?php echo number_abbreviation_fnc($row['likes']); ?></small>
            </div>
        </div>
        
        <div class="mt-auto btn-zone">
            <a href="<?php echo $cc['base_url'].slug2url_fnc('blogs_posts_details', $row['blog_post_id'], $row['slug'], $row['name']); ?>" class="btn btn-outline-dark rounded-pill px-4 py-2 w-100  stretched-link btn-readmore" data-bs-toggle="tooltip" alt="<?php echo $row['title']; ?>" title="<?php echo $row['title']; ?>">
                Read More <i class="bi bi-arrow-right ms-2"></i>
            </a>
        </div>
    </div>
</div>
<?php }?>
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
            echo '<div class="text-bg-danger p-4 m-4">The requested record was not found</div>';
  
          } ?>
</div>
  <div class="col-12 col-md-6 col-lg-4">

  <!-- Search Box -->
    <div class="card border-0 rounded-4 shadow-sm my-4 search-zone">
        <div class="card-body p-3">
            <form action="<?php echo $cc['base_url']; ?>bsearch.html" method="get" class="d-flex" onsubmit="return validate_bsearch_fnc()">
                <input type="text" name="query" id="bquery-fld" class="form-control me-2 bsearch-int" placeholder="Search blogs..." value="">
                <button type="submit" class="btn btn-primary"><i class="fa-solid fa-magnifying-glass"></i></button>
            </form>
        </div>
    </div>

     <!-- Categories List -->
    <?php if(!empty($blogs_categories)) { ?>
    <div class="card border-0 rounded-4 shadow-sm my-4 navbar-blogs">
        <div class="card-body p-3">
            <h4 class="fw-bold mb-3 t-heading text-start my-3">Categories</h4>
            <ul class="list-unstyled mb-0">
                <?php foreach ($blogs_categories as $b_cat) { ?>
                    <li class="mb-2">
                        <a href="<?php echo $cc['base_url'].slug2url_fnc('blogs_posts_by_categories', $b_cat['blog_category_id'], $b_cat['slug'], $b_cat['name']); ?>" 
                           class="d-block py-1 px-2 rounded hover-bg-primary text-decoration-none <?php echo (isset($blog_category_id) && $blog_category_id == $b_cat['blog_category_id'])?'active':''; ?> <?php echo ($b_cat['posts'] < 1)?'empty-cat':''; ?>">
                           <?php echo $b_cat['name']; ?> <small>(<?php echo number_abbreviation_fnc($b_cat['posts']); ?>)</small>
                        </a>
                    </li>
                <?php } ?>
            </ul>
        </div>
    </div>
    <?php } ?>

    <!-- Optional: Recent Posts -->
    <?php if(!empty($random_blogs_posts)) { ?>
    <div class="col-12 my-4">
            <h4 class="fw-bold mb-3 t-heading text-start my-3">Recently Reading</h4>
                <?php foreach ($random_blogs_posts as $post) { ?>
                    <div class="card border-0 rounded-4 my-4 shadow-sm blog-card shortpost rating-zone" >
    <img src="<?php echo $cc['img_url'].display_image_fnc('webp-'.$cc['post_small_image_width'].'x'.$cc['post_small_image_height'], $post['upload_file'], 'auto', $cc['cache_image'], true); ?>" class="card-img-top rounded-top-4" data-bs-toggle="tooltip" alt="<?php echo $post['title']; ?>" title="<?php echo $post['title']; ?>" style="height: <?php echo $cc['post_small_image_height']; ?>px;">
    <div class="card-body p-3 d-flex flex-column" data-rating="<?php echo $post['ratings']; ?>">
        <?php if(!empty($post['parents_blogs_categories'])) { ?>
        <div class="d-flex align-items-center mb-3 gap-1">
             <?php foreach ($post['parents_blogs_categories'] as $cat) {
                             ?>
            <a href="<?php echo $cc['base_url'].slug2url_fnc('blogs_posts_by_categories', $cat['blog_category_id'], $cat['slug'], $cat['name']); ?>" class="btn btn-outline-secondary btn-sm rounded-pill categories" role="button" data-bs-toggle="tooltip" title="<?php echo $cat['title']; ?>"><?php echo $cat['name'];?></a>
            <?php } ?>
        </div>
        <?php } ?>
        <h5 class="card-title fw-bold mb-3"><?php echo $post['name']; ?></h5>
        <div class="card-text text-secondary mb-4"><?php echo $post['spotlight']; ?></div>
        
        <div class="d-flex align-items-center justify-content-between mb-4 post-meta">
            <?php if(!empty($post['add_by_info'])) { 
                $gender_dp = gender_dp_fnc($post['add_by_info']['gender']);
                ?>
            <div class="d-flex align-items-center">
                <img src="<?php echo $cc['base_url'].'public/images/'.$gender_dp; ?>" class="border rounded-circle me-2" width="32" height="32" alt="<?php echo $post['add_by_info']['nickname']; ?>">
                <small class="fw-semibold"><?php echo $post['add_by_info']['nickname']; ?></small>
            </div>
            <?php } ?>
            <small class="text-secondary"><i class="bi bi-calendar me-1"></i><?php echo time_short_fnc($post['published_time']); ?></small>
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
                <small class="me-3"><i class="fa-solid fa-comments"></i> <?php echo number_abbreviation_fnc($post['comments']); ?></small>
                <small><i class="fa-solid fa-thumbs-up"></i> <?php echo number_abbreviation_fnc($post['likes']); ?></small>
            </div>
        </div>
        
        <div class="mt-auto btn-zone">
            <a href="<?php echo $cc['base_url'].slug2url_fnc('blogs_posts_details', $post['blog_post_id'], $post['slug'], $post['name']); ?>" class="btn btn-outline-dark rounded-pill px-4 py-2 w-100  stretched-link btn-readmore" data-bs-toggle="tooltip" alt="<?php echo $post['title']; ?>" title="<?php echo $post['title']; ?>">
                Read More <i class="bi bi-arrow-right ms-2"></i>
            </a>
        </div>
    </div>
</div>
                <?php } ?>
        </div>
    <?php } ?>


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