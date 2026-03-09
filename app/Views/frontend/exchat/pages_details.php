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

<section class="container-fluid t-content t-pages_details">
	<div class="container ">
		<div class="row">
			<div class="col-md-12">
				<?php echo $row['description'];?>
			</div>
		</div>
    <div class="row">
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