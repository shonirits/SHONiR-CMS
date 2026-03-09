<?php echo view('frontend/'.$cc['frontend_theme'].'/common/page_start'); ?>
  <head>
  <?php echo view('frontend/'.$cc['frontend_theme'].'/common/head');?>
  </head>
  <body id="body"><?php echo view('frontend/'.$cc['frontend_theme'].'/common/body_start');?>
  <?php echo view('frontend/'.$cc['frontend_theme'].'/common/header');?>
  <?php echo view('frontend/'.$cc['frontend_theme'].'/common/hero_slide');
  
  function render_badges($item, $cc) {
    $badges = '';
    if ($item['newbie'] && $cc['badge_newbie'] === 'TRUE') $badges .= '<span class="badge newbie">New</span>';
    if ($item['hd'] && $cc['badge_hd'] === 'TRUE') $badges .= '<span class="badge hd">HD</span>';
    if ($item['lq'] && $cc['badge_lq'] === 'TRUE') $badges .= '<span class="badge lq">LQ</span>';
    return $badges;
}

function render_rating($rating) {
    $fullStars = floor($rating);
    $halfStar = ($rating - $fullStars) >= 0.5;
    $output = '';
    for ($i = 1; $i <= 5; $i++) {
        if ($i <= $fullStars) $output .= '<i class="fa-solid fa-star filled"></i>';
        elseif ($i === $fullStars + 1 && $halfStar) $output .= '<i class="fa-solid fa-star-half-stroke filled"></i>';
        else $output .= '<i class="fa-regular fa-star"></i>';
    }
    return $output;
}

?>

  <!-- Theme Content Start
================================================== -->

<section class="container-fluid t-content t-home">
  <div class="container">
   <?php if(isset($content_welcome) && !empty($content_welcome)){  ?>
    <div class="row pt-5 pb-3">
      <div class="col-12 pt-5 pb-4 text-center intro">
        <h1 class="d-flex justify-content-center title"><?= $content_welcome['title']; ?></h1>
        <p class="d-flex justify-content-start description"><?= $content_welcome['description']; ?></p>
      </div>
    </div>
<?php } ?>


    <div class="row">
      <div class="col-12 pt-4 pb-4">
        <div class="tabCommon">
          <?php if (!empty($trending_items) || !empty($newbie_items) || !empty($featured_items)) : ?>
            <ul class="nav nav-tabs justify-content-center" id="commonTab" role="tablist">
              <?php if (!empty($trending_items)) : ?>
                <li class="nav-item" role="presentation">
                  <button class="nav-link active" id="first-tab" data-bs-toggle="tab" data-bs-target="#first-tab-pane" type="button" role="tab" aria-controls="first-tab-pane" aria-selected="true">Trending</button>
                </li>
              <?php endif; ?>
              <?php if (!empty($newbie_items)) : ?>
                <li class="nav-item" role="presentation">
                  <button class="nav-link" id="second-tab" data-bs-toggle="tab" data-bs-target="#second-tab-pane" type="button" role="tab" aria-controls="second-tab-pane" aria-selected="false">New Arrival</button>
                </li>
              <?php endif; ?>
              <?php if (!empty($featured_items)) : ?>
                <li class="nav-item" role="presentation">
                  <button class="nav-link" id="third-tab" data-bs-toggle="tab" data-bs-target="#third-tab-pane" type="button" role="tab" aria-controls="third-tab-pane" aria-selected="false">Featured</button>
                </li>
              <?php endif; ?>
            </ul>
          <?php endif; ?>

          <div class="tab-content" id="commonTabContent">
            <?php
            $tabs = [
              'first-tab-pane' => $trending_items ?? [],
              'second-tab-pane' => $newbie_items ?? [],
              'third-tab-pane' => $featured_items ?? []
            ];
            $tabIndex = 0;
            foreach ($tabs as $tabId => $items) :
              if (!empty($items)) :
            ?>
              <div class="tab-pane fade <?= $tabIndex === 0 ? 'show active' : '' ?>" id="<?= $tabId ?>" role="tabpanel" aria-labelledby="<?= explode('-', $tabId)[0] ?>-tab" tabindex="0">
                <?php foreach ($items as $item) :
                  $rating = round($item['ratings'], 1);
                  $ratingClass = 'rating-' . floor($rating);
                ?>
                  <div class="tabItem">
                    <article class="item-card" data-rating="<?= $rating ?>" id="item_<?= $item['item_id'] ?>_zone">
                      <div class="item-thumb">
                        <div class="badge-group"><?= render_badges($item, $cc) ?></div>
                        <a href="<?= $cc['base_url'] . slug2url_fnc('items_details', $item['item_id'], $item['slug'], $item['meta_title']) ?>"
                           data-bs-toggle="tooltip" title="<?= $item['meta_title'] ?>">
                          <img class="img-responsive lazy" loading="lazy"
                               src="<?= $cc['img_url'] . display_image_fnc('webp-' . $cc['small_image_width'] . 'x' . $cc['small_image_height'], $item['upload_file']) ?>"
                               alt="<?= $item['meta_title'] ?>" />
                        </a>
                        <?php if ($cc['ratings'] === 'TRUE') : ?>
                          <div class="preview-meta">
                            <div class="star-rating <?= $ratingClass ?>" title="Rated <?= $rating ?> out of 5">
                              <?= render_rating($rating) ?>
                            </div>
                            <div class="meta-stats">
                              <span class="likes" title="32.6k Likes"><i class="fa-solid fa-heart"></i> 32.6k</span>
                              <span class="rates" title="1.2k Rates"><i class="fa-solid fa-user-check"></i> 1.2k</span>
                            </div>
                            <ul class="quick-view">
                              <li>
                                <a href="javascript:void(0);"
                                   onclick="product_quick_view_fnc(<?= $item['item_id'] ?>, '<?= data2js_fnc($item['title']) ?>', '<?= $item['model'] ?>', '<?= data2js_fnc($item['spotlight']) ?>', '<?= $cc['img_url'] . display_image_fnc('webp-' . $cc['large_image_width'] . 'x' . $cc['large_image_height'], $item['upload_file']) ?>', '<?= $cc['base_url'] . slug2url_fnc('items_details', $item['item_id'], $item['slug'], $item['meta_title']) ?>', token);"
                                   title="Quick View">
                                  <span class="btn-quick"><i class="fa-solid fa-magnifying-glass"></i> Quick View</span>
                                </a>
                              </li>
                            </ul>
                          </div>
                        <?php endif; ?>
                      </div>
                      <div class="item-content">
                        <h4>
                          <a href="<?= $cc['base_url'] . slug2url_fnc('items_details', $item['item_id'], $item['slug'], $item['meta_title']) ?>"
                             title="<?= $item['meta_title'] ?>">
                            <?= $item['name'] ?>
                          </a>
                        </h4>
                      </div>
                    </article>
                  </div>
                <?php endforeach; ?>
              </div>
            <?php
              $tabIndex++;
              endif;
            endforeach;
            ?>
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
<script>
 

</script>