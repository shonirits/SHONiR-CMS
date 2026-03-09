<?php echo view('frontend/'.$cc['frontend_theme'].'/common/page_start'); ?>
  <head>
  <?php echo view('frontend/'.$cc['frontend_theme'].'/common/head');?>
  </head>
  <body id="body"><?php echo view('frontend/'.$cc['frontend_theme'].'/common/body_start');?>
  <?php echo view('frontend/'.$cc['frontend_theme'].'/common/header');?>
  <?php echo view('frontend/'.$cc['frontend_theme'].'/common/hero_slide');?>

  <!-- Theme Breadcrumb Start
================================================== -->

 <section class="container-fluid t-breadcrumb">
	<div class="container">
		<div class="row">
			<div class="col-md-12">
				<div class="content">
					<h1 class="page-name"><?php echo $row['title'];?></h1>
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

<section class="container-fluid py-5 t-pages_details wow pulse">
	<div class="container ">
		<div class="row wow bounceIn">
			<div class="col-md-12 ">
				<?php echo $row['description'];?>
			</div>
		</div>
    <?php 
          if(!empty($rows) && is_array($rows)) {
          ?>
    <div class="row galleries my-5 g-3 wow bounceIn">
        <?php 
              foreach($rows as $gallery) {
                ?>
                <div class="col-6 col-md-3">
        <?php
                if($gallery['parent_type'] == 'image') {
          ?>
				<div class="image-box">
              <a href="<?php echo $cc['img_url'].display_image_fnc('webp-0x0', $gallery['upload_file'], 'normal', $cc['cache_image'], true); ?>" 
                 data-fancybox="galleries" 
                 data-caption="<h4><?php echo $gallery['title']; ?></h4><?php echo htmlspecialchars_decode($gallery['description']); ?>" >
                <img src="<?php echo $cc['img_url'].display_image_fnc('webp-'.$cc['medium_image_width'].'x'.$cc['medium_image_height'], $gallery['upload_file'], 'auto', $cc['cache_image'], true); ?>" 
                     alt="<?php echo $gallery['title']; ?>" 
                     class="img-fluid">
                <div class="icon-overlay">
                  <i class="fa-solid fa-up-right-and-down-left-from-center"></i>
                </div>
                <div class="details-area">
                  <?php echo $gallery['name']; ?>
                </div>
              </a>
            </div>
        <?php }elseif($gallery['parent_type'] == 'video'){ ?>
          <div class="video-box">
			  <a href="<?php echo $gallery['link']; ?>" data-fancybox="galleries" data-caption="<h4><?php echo $gallery['title']; ?></h4><?php echo htmlspecialchars_decode($gallery['description']); ?>">
				<img src="<?php echo $cc['img_url'].display_image_fnc('webp-'.$cc['medium_image_width'].'x'.$cc['medium_image_height'], $gallery['upload_file'], 'auto', $cc['cache_image'], true); ?>" alt="<?php echo $gallery['title']; ?>" class="img-fluid">
				<div class="play-area">
				  <i class="fa-solid fa-circle-play icon"></i> <?php echo $gallery['name']; ?>
				</div>
			  </a>
			</div>
        <?php }  ?>
        </div>
        <?php } ?>
		</div>
    <?php if($pagination){ ?>
  <div class="row justify-content-center text-center text-md-start">
    <div class="col-12 col-md-8 pt-3 d-flex justify-content-center justify-content-md-start">
      <?php echo $pagination['pager']; ?>
    </div>
<div class="col-12 col-md-4 pt-3 d-flex justify-content-center justify-content-md-end align-items-center small text-muted text-nowrap pagination-info">
      <?php echo $pagination['start'].' - '.$pagination['end'].' Of '.$pagination['total_records'].' Records, Total Pages: '.$pagination['total_pages']; ?>
    </div>
  </div>
<?php } ?>
    <?php } ?>
    <div class="row wow bounceIn">
			<div class="col-md-12 ratings">
        <?php if($cc['ratings'] == 'TRUE'){ ?>
				<span class="info-ratings">Rate this content—your insights matter!</span> <span id="rate_page<?php echo $row['page_id'];?>" class="star-ratings"></span><span id="rate_live_page<?php echo $row['page_id'];?>" class="live-ratings"><?php echo $row['ratings'];?></span>
        <?php } 
        if($cc['likes'] == 'TRUE'){?>
        <span class="do-likes" id="do_like_page<?php echo $row['page_id'];?>"><?php echo ($row['liked'] == 'true')?'<i class="fa-solid fa-thumbs-up"></i>':'<i class="fa-regular fa-thumbs-up"></i>';?></span>
        <span class="info-likes" id="info_like_page<?php echo $row['page_id'];?>"><?php echo number_abbreviation_fnc($row['likes']);?></span>
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
       p("#rate_page<?php echo $row['page_id'];?>").starRating({
        starSize: 18,
        strokeWidth: 9,
        strokeColor: '#636363',
        hoverColor: '#0037ff',
        activeColor: ratedColors[activeColor],
        ratedColors: ratedColors,
        useGradient: false,
        initialRating: <?php echo $row['ratings'];?>,
        callback: function(currentRating, $el){
          ratings_fnc('pages', 'page', <?php echo $row['page_id'];?>, currentRating, rating_token);
        },
          onHover: function(currentIndex, currentRating, $el){
            d('#rate_live_page<?php echo $row['page_id'];?>').text(currentIndex);
          },
          onLeave: function(currentIndex, currentRating, $el){
            d('#rate_live_page<?php echo $row['page_id'];?>').text(currentRating);
          }
});
<?php } 
if($cc['likes'] == 'TRUE'){ ?> 
let like_token = token; 
p('#do_like_page<?php echo $row['page_id'];?>').click(function() {    
  likes_fnc('pages', 'page', <?php echo $row['page_id'];?>, like_token);
  });
  <?php } ?>

      }
    }
}, 1000);
  }
</script>