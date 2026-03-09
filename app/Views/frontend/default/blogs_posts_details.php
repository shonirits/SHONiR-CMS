<?php echo view('frontend/'.$cc['frontend_theme'].'/common/page_start'); ?>
  <head>
  <?php echo view('frontend/'.$cc['frontend_theme'].'/common/head');?>
  </head>
  <body id="body"><?php echo view('frontend/'.$cc['frontend_theme'].'/common/body_start');?>
  <?php echo view('frontend/'.$cc['frontend_theme'].'/common/header');?>
  <?php echo view('frontend/'.$cc['frontend_theme'].'/common/hero_slide');?>

  <!-- Theme Content Start
================================================== -->


<section class="container-fluid t-blogs py-4">
    <div class="container">
       
    
    <div class="row align-items-center g-3">
            <div class="col-md-6">
                <nav aria-label="breadcrumb">
                    <ol class="breadcrumb mb-0">
                        <li class="breadcrumb-item"><a href="<?php echo $cc['base_url']; ?>">Home</a></li>
                        <li class="breadcrumb-item"><a href="<?php echo $cc['base_url'].'Blog'; ?>">Blog</a></li>
                        <li class="breadcrumb-item active" aria-current="page"><?php echo $row['name'];?></li>
                    </ol>
                </nav>
            </div>
            <div class="col-md-6">
                <ul class="product-pagination list-unstyled d-flex justify-content-md-end gap-3 mb-0">
                    <?php if($previous){ ?>
                        <li><a href="<?php echo $cc['base_url'].slug2url_fnc('blogs_posts_details', $previous['blog_post_id'], $previous['slug'], $previous['name']); ?>" class="btn btn-primary btn-nav"  data-bs-toggle="tooltip" title="<?php echo $previous['name']; ?>"><i class="fa-solid fa-chevron-left"></i> Previous</a></li>
                    <?php } ?>
                    <?php if($next){ ?>
                        <li><a href="<?php echo $cc['base_url'].slug2url_fnc('blogs_posts_details', $next['blog_post_id'], $next['slug'], $next['name']); ?>" class="btn btn-primary btn-nav"  data-bs-toggle="tooltip" title="<?php echo $next['name']; ?>">Next <i class="fa-solid fa-chevron-right"></i></a></li>
                    <?php } ?>
                </ul>
            </div>
        </div>


  <div class="row">
<!-- Blogs Posts Details Left Side -->
  <?php 
    $post_header_image =  $cc['img_url'].display_image_fnc('webp-'.$cc['post_large_image_width'].'x'.$cc['post_large_image_height'], 'notfound.webp', 'fix', $cc['cache_image'], $cc['image_original']);
    if (!empty($images) && is_array($images)) {
        $post_header_image = $images[0];
    $post_header_image = $cc['img_url'].display_image_fnc('webp-'.$cc['post_large_image_width'].'x'.$cc['post_large_image_height'], $post_header_image['upload_file'], 'auto', $cc['cache_image'], true);
    }
    ?>
<div class="col-12 col-md-6 col-lg-8">
<div class="card border-0 rounded-4 shadow-sm my-4 blog-card" >
    <img src="<?php echo $post_header_image; ?>" class="card-img-top rounded-top-4" data-bs-toggle="tooltip" alt="<?php echo $row['name']; ?>" title="<?php echo $row['name']; ?>" style="height: <?php echo $cc['post_large_image_height']; ?>px;">
    <div class="card-body p-3 d-flex flex-column">
        <?php if(!empty($parents_blogs_categories)) { ?>
        <div class="d-flex align-items-center mb-3 gap-1">
             <?php foreach ($parents_blogs_categories as $cat) {
                             ?>
            <a href="<?php echo $cc['base_url'].slug2url_fnc('blogs_posts_by_categories', $cat['blog_category_id'], $cat['slug'], $cat['name']); ?>" class="btn btn-outline-secondary btn-sm rounded-pill categories" role="button" data-bs-toggle="tooltip" title="<?php echo $cat['title']; ?>"><?php echo $cat['name'];?></a>
            <?php } ?>
        </div>
        <?php } ?>
        <h5 class="card-title fw-bold my-3"><?php echo $row['title']; ?></h5>
        <div class="card-text my-2"><?php echo $row['description']; ?></div>
        
        <div class="d-flex align-items-center justify-content-between my-2 post-meta">
            <?php if(!empty($row['add_by_info'])) { 
                $gender_dp = gender_dp_fnc($row['add_by_info']['gender']);
                ?>
            <div class="d-flex align-items-center">
                <img src="<?php echo $cc['base_url'].'public/images/'.$gender_dp; ?>" class="border rounded-circle me-2" width="32" height="32" alt="<?php echo $row['add_by_info']['nickname']; ?>">
                <small class="fw-semibold"><?php echo $row['add_by_info']['nickname']; ?></small>
            </div>
            <?php } ?>
            <small class="text-secondary"><i class="bi bi-calendar me-1"></i><?php echo date('F j, Y \a\t H:i:s O', $row['published_time']); ?></small>
        </div>

         <div class="d-flex align-items-center justify-content-between mb-2 wow bounceIn">
    <div class="ratings d-flex align-items-center">
        <?php if($cc['ratings'] == 'TRUE'){ ?>
            <span class="info-ratings me-2">Rate this content—your insights matter!</span>
            <span id="rate_blog_post<?php echo $row['blog_post_id'];?>" class="star-ratings me-2"></span>
            <span id="rate_live_blog_post<?php echo $row['blog_post_id'];?>" class="live-ratings"><?php echo $row['ratings'];?></span>
        <?php } ?>
    </div>

    <div class="likes d-flex align-items-center">
        <?php if($cc['likes'] == 'TRUE'){ ?>
            <span class="do-likes me-2" id="do_like_blog_post<?php echo $row['blog_post_id'];?>">
                <?php echo ($row['liked'] == 'true') 
                    ? '<i class="fa-solid fa-thumbs-up"></i>' 
                    : '<i class="fa-regular fa-thumbs-up"></i>';?>
            </span>
            <span class="info-likes" id="info_like_blog_post<?php echo $row['blog_post_id'];?>">
                <?php echo number_abbreviation_fnc($row['likes']);?>
            </span>
        <?php } ?>
    </div>
</div>
  
    </div>
</div>
</div>

  
<!-- Right Side -->
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
<script>
  function content_fnc(){
  var wait_to_all_loaded = setInterval(() => {
    if (all_loaded != false) {
      if (typeof bootstrap !== "undefined" && typeof jQuery.ui !== "undefined") {
        clearInterval(wait_to_all_loaded);  
        
        <?php if($cc['ratings'] == 'TRUE'){ ?>     
        let ratedColors = ['#d21917', '#7f00ff', '#edda12', '#07aee5', '#007437'];
        let ratings = <?php echo $row['ratings'];?>+0.1;
        let initialRating = ratings.toFixed(0);
        let activeColor = initialRating-1;
        let rating_token = token;
       p("#rate_blog_post<?php echo $row['blog_post_id'];?>").starRating({
        starSize: 18,
        strokeWidth: 9,
        strokeColor: '#636363',
        hoverColor: '#0037ff',
        activeColor: ratedColors[activeColor],
        ratedColors: ratedColors,
        useGradient: false,
        initialRating: <?php echo $row['ratings'];?>,
        callback: function(currentRating, $el){
          ratings_fnc('blogs_posts', 'blog_post', <?php echo $row['blog_post_id'];?>, currentRating, rating_token);
        },
          onHover: function(currentIndex, currentRating, $el){
            d('#rate_live_blog_post<?php echo $row['blog_post_id'];?>').text(currentIndex);
          },
          onLeave: function(currentIndex, currentRating, $el){
            d('#rate_live_blog_post<?php echo $row['blog_post_id'];?>').text(currentRating);
          }
});
<?php } 
if($cc['likes'] == 'TRUE'){ ?> 
let like_token = token; 
p('#do_like_blog_post<?php echo $row['blog_post_id'];?>').click(function() {    
  likes_fnc('blogs_posts', 'blog_post', <?php echo $row['blog_post_id'];?>, like_token);
  });
  <?php } ?>

      }
    }
}, 1000);
  }
</script>