<?php 
$hero_slides = array_filter($banners, function($banner) {
    return isset($banner['parent_type']) && $banner['parent_type'] === 'hero-slides';
});
$hero_slides = array_values($hero_slides);

if(!empty($hero_slides)): 
    $total_slides = count($hero_slides);
    $limit = $cc['limit_hero_slides'] ?? 5;
    
    if($total_slides === 1): 
        $slide = $hero_slides[0];
        $slide_image = $cc['img_url'].display_image_fnc('webp-'.$cc['hero_slides_width'].'x'.$cc['hero_slides_height'], $slide['upload_file'], 'fix', $cc['cache_image'], true);
?>
        <div class="t-single-hero">
            <a href="<?= !empty($slide['link']) ? $slide['link'] : 'javascript:void(0);' ?>">
                <img src="<?= $slide_image ?>" class="img-fluid" alt="<?= $slide['title'] ?>" loading="eager">
            </a>
        </div>
<?php else: ?>
    <section class="t-hero-slider" id="hero-slider">
        <?php 
        foreach ($hero_slides as $index => $slide): 
            if ($index >= $limit) break;
            $bg_image = $cc['img_url'].display_image_fnc('webp-'.$cc['hero_slides_width'].'x'.$cc['hero_slides_height'], $slide['upload_file'], 'fix', $cc['cache_image'], true);
            
        ?>
        <div class="slider-item" style="background-image: linear-gradient(rgba(0,0,0,0.2), rgba(0,0,0,0.2)), url('<?= $bg_image ?>');">
            <div class="container h-100">
                <div class="row h-100 align-items-center">
                    <div class="col-lg-8 d-flex flex-column text-<?php echo $slide['position']; ?> align-items-<?php echo $slide['position']; ?>">
                        
                        <?php if(!empty($slide['title'])): ?>
                            <div class="title animate__animated" data-animation-in="fadeInDown" data-delay-in="0.3">
                                <?= $slide['title'] ?>
                            </div>
                        <?php endif; ?>

                        <?php if(!empty($slide['description'])): ?>
                            <div class="description animate__animated" data-animation-in="fadeInUp" data-delay-in="0.5">
                                <?= $slide['description'] ?>
                            </div>
                        <?php endif; ?>

                        <?php if(!empty($slide['link'])): ?>
                            <div class="btn-wrapper animate__animated" data-animation-in="zoomIn" data-delay-in="0.8">
                                <a href="<?= $slide['link'] ?>" class="btn btn-primary">
                                    <?= $slide['name'] ?>
                                </a>
                            </div>
                        <?php endif; ?>

                    </div>
                </div>
            </div>
        </div>
        <?php endforeach; ?>
    </section>
<?php endif; endif; ?>