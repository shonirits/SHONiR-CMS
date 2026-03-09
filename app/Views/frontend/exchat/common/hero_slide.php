<?php 
if(!empty($hero_slides) && is_array($hero_slides)) {
if(count($hero_slides) === 1){
  $slide = $hero_slides[0];
$slide_link = !empty($slide['link']) ? $slide['link'] : '';
    echo $slide_link ? '<a href="' . $slide_link . '">' : '';
    echo '<img data-src="' . $cc['img_url'].display_image_fnc('webp-'.$cc['hero_slides_width'].'x'.$cc['hero_slides_height'], $slide['upload_file']) . '" class="img-fluid" alt="' . $slide['title'] . '" border="0">';
    echo $slide_link ? '</a>' : '';
}else{
?>
<!-- Theme Hero Slide Start
================================================== -->
<section class="t-hero-slider">
  <?php 
    
  foreach ($hero_slides as $hero_slide)
            {

                ?>
  <div class="slider-item hero-area" style="background-image: url(<?php echo $cc['img_url'].display_image_fnc('webp-'.$cc['hero_slides_width'].'x'.$cc['hero_slides_height'], $hero_slide['upload_file']); ?>);">
    <div class="container">
      <div class="row">
        <div class="col-lg-8 text-<?php echo $hero_slide['position']; ?>">
          <p class="animate__animated animate__backInLeft" data-duration-in=".3" data-animation-in="fadeInUp" data-delay-in=".1"><?php echo $hero_slide['title']; ?></p>
          <h1 class="animate__animated animate__backInRight" data-duration-in=".4" data-animation-in="fadeInUp" data-delay-in=".5"><?php echo $hero_slide['description']; ?></h1>
<?php 
if(!empty($hero_slide['link'])){
?>
          <a class="btn animate__animated animate__backInUp" data-duration-in=".6" data-animation-in="fadeInUp" data-delay-in=".7" href="<?php echo $hero_slide['link']; ?>"><?php echo $hero_slide['name']; ?></a>
          <?php 
}
?>
        </div>
      </div>
    </div>
  </div>
  <?php 
}
?>
</section>
<!-- Theme Hero Slide End
================================================== -->
<?php 
}
}
?>