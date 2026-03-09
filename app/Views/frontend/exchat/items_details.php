<?php echo view('frontend/'.$cc['frontend_theme'].'/common/page_start'); ?>
  <head>
  <?php echo view('frontend/'.$cc['frontend_theme'].'/common/head');?>
   </head>
  <body id="body"><?php echo view('frontend/'.$cc['frontend_theme'].'/common/body_start');?>
  <?php echo view('frontend/'.$cc['frontend_theme'].'/common/header');?>
  <?php echo view('frontend/'.$cc['frontend_theme'].'/common/hero_slide');?>
  <!-- Theme Content Start
================================================== -->

<section class="container-fluid t-content t-items_details ">

<div class="container ">
		<div class="row">
			<div class="col-md-6 ">
				<nav aria-label="breadcrumb">
  <ol class="breadcrumb">
    <li class="breadcrumb-item"><a href="<?php echo $cc['base_url']; ?>">Home</a></li>
    <li class="breadcrumb-item active" aria-current="page"><?php echo $row['name'];?></li>
  </ol>
</nav>
			</div>
			<div class="col-md-6 d-flex flex-row-reverse ">
				<ol class="pagination">
                    <?php if($previous){
                        echo '<li><a href="'.$cc['base_url'].slug2url_fnc('items_details', $previous['item_id'], $previous['slug'], $previous['name']).'" data-bs-toggle="tooltip" data-placement="top" title="'.$previous['name'].'"><i class="fa-solid fa-angle-left"></i> Previous</a></li>';
                         } 
                    if($next){
                    echo '<li><a href="'.$cc['base_url'].slug2url_fnc('items_details', $next['item_id'], $next['slug'], $next['name']).'" data-bs-toggle="tooltip" data-placement="top" title="'.$next['name'].'">Next <i class="fa-solid fa-angle-right"></i></i></a></li>';
                      } ?>
				</ol>
			</div>
		</div>

<div class="row mt-4" id="<?php echo 'item_'.$row['item_id'].'_zone';?>">
<div class="col-md-5">  
<?php  
if(!empty($images) && is_array($images)) {
    if(count($images) > 1){
        ?>
    <div id="imagesContainer" class="item-gallery-layout">  
    
        <div id="itemCarousel" class="f-carousel main-item-carousel">
          <div class="f-carousel__viewport">
        <?php
    foreach ($images as $image)
            {
              ?>
        <div class="f-carousel__slide" data-thumb-src="<?php echo $cc['img_url'].display_image_fnc('webp-0x0', $image['upload_file']); ?>" data-fancybox="items_images" data-src="<?php echo $cc['img_url'].display_image_fnc('webp-0x0', $image['upload_file']); ?>">
            <img alt="<?php echo $row['name'];?>" data-lazy-src="<?php echo $cc['img_url'].display_image_fnc('webp-0x0', $image['upload_file']); ?>"/>
        </div>
<?php  } ?>
</div>
</div>
</div>
<?php  } else {?>
<div class="f-carousel__slide" data-thumb-src="<?php echo $cc['img_url'].display_image_fnc('webp-0x0', $images[0]['upload_file']); ?>" data-fancybox="items_images" data-src="<?php echo $cc['img_url'].display_image_fnc('webp-0x0', $images[0]['upload_file']); ?>">
            <img alt="<?php echo $row['name'];?>" class="img-fluid" data-src="<?php echo $cc['img_url'].display_image_fnc('webp-0x0', $images[0]['upload_file']); ?>"/>
        </div>
         <?php  } }else{?>
            <div class="noImage">No Image Available</div>
         <?php  } ?>


    
      </div>
      <div class="col-md-7 ">
      <form name="item_<?php echo $row['item_id']; ?>_frm" id="item_<?php echo $row['item_id']; ?>_frm" class="needs-validation" novalidate>
        <div class="pinpoint">
        <h2 class="heading"><?php echo $row['title'];?> </h2>
					<span class="model">Model: <?php echo $row['model'];?></span>

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
					
					<div class="spotlight">
						<?php echo $row['spotlight'];?>
</div>



<div class="row quantity align-items-center">
  <div class="col-auto">
    <label for="quantity" class="col-form-label">Quantity:</label>
  </div>
  <div class="col-auto">
    <input type="number" id="quantity" name="quantity" class="form-control" min="<?php echo $row['minimum']; ?>" max="<?php echo ($row['stock'] > $row['minimum'])?$row['minimum']:$row['stock']; ?>" step="1" value="<?php echo $row['minimum']; ?>" inputmode="numeric" pattern="[0-9]*" oninput="this.value = this.value.replace(/[^0-9]/g, '');" required> <div class="invalid-feedback">
                                    There is a minimum <?php echo $row['minimum']; ?> & maximum <?php echo ($row['stock'] > $row['minimum'])?$row['minimum']:$row['stock']; ?> quantity limit for this product.</div>
  </div>
</div>


<?php if(!empty($parents_categories) && is_array($parents_categories)) {?>
          <div class="categories">
						<span>Categories:</span>
						<ul>
                            <?php foreach ($parents_categories as $parent_category)
                             {

                                 echo '<li><a href="'.$cc['base_url'].slug2url_fnc('items_by_categories', $parent_category['category_id'], $parent_category['slug'], $parent_category['name']).'">'.$parent_category['name'].'</a></li>';

                             } ?>
						</ul>
					</div>
<?php } ?>
          <button type="button" class="btn btn-main" onclick="javascript:add2cart_fnc('<?php echo $row['item_id'] ?>', token, event);"  data-toggle="tooltip" data-placement="top" title="Get Free Quote">Get Free Quote</button>

        </div>
                            </form>
</div>
</div>

<div class="row">

<div class="col-xs-12 pt-5">
<div class="tabCommon">
<ul class="nav nav-tabs " id="commonTab" role="tablist">
  <li class="nav-item" role="presentation">
    <button class="nav-link active" id="first-tab" data-bs-toggle="tab" data-bs-target="#first-tab-pane" type="button" role="tab" aria-controls="first-tab-pane" aria-selected="true">Product Description</button>
  </li>
<?php if(!empty($in_the_same_items) && is_array($in_the_same_items)) { ?>
  <li class="nav-item" role="presentation">
    <button class="nav-link" id="second-tab" data-bs-toggle="tab" data-bs-target="#second-tab-pane" type="button" role="tab" aria-controls="second-tab-pane" aria-selected="false">In The Same Category</button>
  </li>
<?php } 
if(!empty($related_items) && is_array($related_items)) { ?>
  <li class="nav-item" role="presentation">
    <button class="nav-link" id="third-tab" data-bs-toggle="tab" data-bs-target="#third-tab-pane" type="button" role="tab" aria-controls="third-tab-pane" aria-selected="false">Related Products</button>
  </li>
  <?php } ?>
</ul>
<div class="tab-content" id="commonTabContent">
  <div class="tab-pane fade show active" id="first-tab-pane" role="tabpanel" aria-labelledby="first-tab" tabindex="0">
    <h3><?php echo $row['name'];?></h3>
    <p><?php echo $row['description'];?></p>
  </div>
     
<?php if(!empty($in_the_same_items) && is_array($in_the_same_items)) {
    ?> <div class="tab-pane fade" id="second-tab-pane" role="tabpanel" aria-labelledby="second-tab" tabindex="0">
   <?php
    foreach ($in_the_same_items as $same_item)
            {
                ?>
  <div class="tabItem">
    <div class="tabItem">
            <div class="product-item" data-rating="<?php echo $same_item['ratings']; ?>" id="<?php echo 'item_'.$same_item['item_id'].'_zone';?>">
                <div class="product-thumb">
                    <?php echo ($same_item['price'] < $same_item['price_previous'] && $cc['badge_sale'] == 'TRUE')?'<span class="bage sale">Sale</span>':''; ?>                       
                    <?php echo ($same_item['newbie'] && $cc['badge_newbie'] == 'TRUE')?'<span class="bage newbie">New</span>':''; ?>                 
                    <?php echo ($same_item['featured'] && $cc['badge_featured'] == 'TRUE')?'<span class="bage featured">Featured</span>':''; ?>
                    <img class="img-responsive" data-src="<?php echo $cc['img_url'].display_image_fnc('webp-'.$cc['small_image_width'].'x'.$cc['small_image_height'], $same_item['upload_file']); ?>" alt="<?php echo $same_item['name']; ?>" />
                    <?php if($cc['ratings'] == 'TRUE'){ ?>
                    <div class="preview-meta">
                        <div class="star-rating">
                            <i class="fa-regular fa-star"></i>
                            <i class="fa-regular fa-star"></i>
                            <i class="fa-regular fa-star"></i>
                            <i class="fa-regular fa-star"></i>
                            <i class="fa-regular fa-star"></i>
                        </div>
                        <?php } ?>
                        <ul>
                            <li>
                                <a href="javascript:void(0);" onclick="product_quick_view_fnc(<?php echo $same_item['item_id']; ?>, '<?php echo data2js_fnc($same_item['title']); ?>', '<?php echo $same_item['model']; ?>', '<?php echo data2js_fnc($same_item['spotlight']); ?>', '<?php echo $cc['img_url'].display_image_fnc('webp-'.$cc['large_image_width'].'x'.$cc['large_image_height'], $same_item['upload_file']); ?>', '<?php echo $cc['base_url'].slug2url_fnc('items_details', $same_item['item_id'], $same_item['slug'], $same_item['meta_title']); ?>', token);" data-bs-toggle="tooltip" data-placement="top" title="Quick View">
                                    <i class="fa-solid fa-magnifying-glass"></i>
                                </a>
                            </li>
                            <li>
                                <a href="<?php echo $cc['base_url'].slug2url_fnc('items_details', $same_item['item_id'], $same_item['slug'], $same_item['meta_title']); ?>" data-bs-toggle="tooltip" data-placement="top" title="More Info">
                                    <i class="fa-solid fa-info"></i>
                                </a>
                            </li>
                            <li>
                                <a href="javascript:void(0);" onclick="javascript:add2cart_fnc('<?php echo $same_item['item_id'] ?>', token, event);" data-bs-toggle="tooltip" data-placement="top" title="Get Free Quote">
                                    <i class="fa-solid fa-basket-shopping"></i>
                                </a>
                            </li>
                        </ul>
                    </div>
                </div>
                <div class="product-content">
                    <h4><a href="<?php echo $cc['base_url'].slug2url_fnc('items_details', $same_item['item_id'], $same_item['slug'], $same_item['meta_title']); ?>"><?php echo $same_item['name']; ?></a></h4>
                    <p>Model: <?php echo $same_item['model']; ?></p>
                </div>
            </div>
        </div>
  </div>

   <?php 
            }?> </div>
   <?php
} ?>

<?php if(!empty($related_items) && is_array($related_items)) {
    ?> <div class="tab-pane fade" id="third-tab-pane" role="tabpanel" aria-labelledby="third-tab" tabindex="0">
   <?php foreach ($related_items as $related_item)
            {
                ?>
  <div class="tabItem">
    <div class="tabItem">
            <div class="product-item" data-rating="<?php echo $related_item['ratings']; ?>" id="<?php echo 'item_'.$related_item['item_id'].'_zone';?>">
                <div class="product-thumb">
                    <?php echo ($related_item['price'] < $related_item['price_previous'] && $cc['badge_sale'] == 'TRUE')?'<span class="bage sale">Sale</span>':''; ?>                       
                    <?php echo ($related_item['newbie'] && $cc['badge_newbie'] == 'TRUE')?'<span class="bage newbie">New</span>':''; ?>                 
                    <?php echo ($related_item['featured'] && $cc['badge_featured'] == 'TRUE')?'<span class="bage featured">Featured</span>':''; ?>
                    <img class="img-responsive" data-src="<?php echo $cc['img_url'].display_image_fnc('webp-'.$cc['small_image_width'].'x'.$cc['small_image_height'], $related_item['upload_file']); ?>" alt="<?php echo $related_item['name']; ?>" />
                    <?php if($cc['ratings'] == 'TRUE'){ ?>
                    <div class="preview-meta">
                        <div class="star-rating">
                            <i class="fa-regular fa-star"></i>
                            <i class="fa-regular fa-star"></i>
                            <i class="fa-regular fa-star"></i>
                            <i class="fa-regular fa-star"></i>
                            <i class="fa-regular fa-star"></i>
                        </div>
                        <?php } ?>
                        <ul>
                            <li>
                                <a href="javascript:void(0);" onclick="product_quick_view_fnc(<?php echo $related_item['item_id']; ?>, '<?php echo data2js_fnc($related_item['title']); ?>', '<?php echo $related_item['model']; ?>', '<?php echo data2js_fnc($related_item['spotlight']); ?>', '<?php echo $cc['img_url'].display_image_fnc('webp-'.$cc['large_image_width'].'x'.$cc['large_image_height'], $related_item['upload_file']); ?>', '<?php echo $cc['base_url'].slug2url_fnc('items_details', $related_item['item_id'], $related_item['slug'], $related_item['meta_title']); ?>', token);" data-bs-toggle="tooltip" data-placement="top" title="Quick View">
                                    <i class="fa-solid fa-magnifying-glass"></i>
                                </a>
                            </li>
                            <li>
                                <a href="<?php echo $cc['base_url'].slug2url_fnc('items_details', $related_item['item_id'], $related_item['slug'], $related_item['meta_title']); ?>" data-bs-toggle="tooltip" data-placement="top" title="More Info">
                                    <i class="fa-solid fa-info"></i>
                                </a>
                            </li>
                            <li>
                                <a href="javascript:void(0);" onclick="javascript:add2cart_fnc('<?php echo $related_item['item_id'] ?>', token, event);" data-bs-toggle="tooltip" data-placement="top" title="Get Free Quote">
                                    <i class="fa-solid fa-basket-shopping"></i>
                                </a>
                            </li>
                        </ul>
                    </div>
                </div>
                <div class="product-content">
                    <h4><a href="<?php echo $cc['base_url'].slug2url_fnc('items_details', $related_item['item_id'], $related_item['slug'], $related_item['meta_title']); ?>"><?php echo $related_item['name']; ?></a></h4>
                    <p>Model: <?php echo $related_item['model']; ?></p>
                </div>
            </div>
        </div>
  </div>

   <?php 
            } ?></div> 
   <?php
} ?>

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
<script data-src="https://cdn.jsdelivr.net/npm/@fancyapps/ui@6.0.26/dist/fancybox/fancybox.umd.js"></script>
<script data-src="https://cdn.jsdelivr.net/npm/@fancyapps/ui@6.0.26/dist/carousel/carousel.umd.js"></script>
<script data-src="https://cdn.jsdelivr.net/npm/@fancyapps/ui@6.0.26/dist/carousel/carousel.arrows.umd.js"></script>
<script data-src="https://cdn.jsdelivr.net/npm/@fancyapps/ui@6.0.26/dist/carousel/carousel.lazyload.umd.js"></script>
<script data-src="https://cdn.jsdelivr.net/npm/@fancyapps/ui@6.0.26/dist/carousel/carousel.thumbs.umd.js"></script>
</body>
<?php echo view('frontend/'.$cc['frontend_theme'].'/common/page_end');?>
<script >
function content_fnc(){
  var wait_to_all_loaded = setInterval(() => {
    if (all_loaded != false) {
      if (typeof Fancybox !== "undefined" && typeof bootstrap !== "undefined" && typeof jQuery.ui !== "undefined") {
        clearInterval(wait_to_all_loaded);
        load_css_fnc('https://cdn.jsdelivr.net/npm/@fancyapps/ui@6.0.26/dist/fancybox/fancybox.css');
        load_css_fnc('https://cdn.jsdelivr.net/npm/@fancyapps/ui@6.0.26/dist/carousel/carousel.css');
        load_css_fnc('https://cdn.jsdelivr.net/npm/@fancyapps/ui@6.0.26/dist/carousel/carousel.arrows.css');
        load_css_fnc('https://cdn.jsdelivr.net/npm/@fancyapps/ui@6.0.26/dist/carousel/carousel.thumbs.css');        
        <?php if($cc['ratings'] == 'TRUE'){ ?>
        let ratedColors = ['#d21917', '#7f00ff', '#edda12', '#07aee5', '#007437'];
        let ratings = <?php echo $row['ratings'];?>+0.1;
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
        initialRating: <?php echo $row['ratings'];?>,
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
  <?php } ?>
 <?php if(count($images) > 1){ ?>
 
  const itemCarousel = Carousel(
                document.getElementById('itemCarousel'),
                {
                    transition: 'slide',
                    preload: 5,                     
                    Dots: false, 
                    LazyLoad: true,
                    Thumbs: {
                        type: 'classic', 
                        Carousel: {
                            dragFree: false,
                            slidesPerPage: 'auto', 
                            Navigation: true, 
                            axis: 'x', 
                            breakpoints: {                                
                                '(min-width: 992px)': {
                                    axis: 'y',
                                },
                            },
                        },
                    },
                },
                {
        Arrows,
        Lazyload,
        Thumbs
      }).init();
<?php } ?>
            Fancybox.bind('[data-fancybox="items_images"]', {
                compact: false,
              idle: false,
              dragToClose: false,
              animated: true,
              showClass: 'f-fadeIn',
              hideClass: 'f-fadeOut',
              Hash: false,
                contentClick: () =>
                    window.matchMedia('(max-width: 578px), (max-height: 578px)').matches
                        ? 'toggleMax'
                        : 'toggleCover',
                <?php if(count($images) > 1){ ?>
                Thumbs: true, 
                Carousel: {
                    transition: 'fadeFast', 
                    preload: 5,
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
                    fit: 'contain', 
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
