

<!-- Theme Newsletter Start
================================================== -->
<section class="container-fluid t-newsletter py-5">
  <div class="container">
    <div class="row justify-content-center text-center">
      <div class="col-12">
        <div class="title mb-4">
          <h2 class="fw-bold">Fresh Uploads. New Releases. All the Stories You Love.</h2>
          <p class="fs-6">
			Join thousands of fans discovering fresh uploads, trending releases, and handpicked streaming gems — all delivered straight to your inbox.<br>
			No ads. No clutter. Just pure entertainment, tailored for you.
			</p>
        </div>
      </div>
      <div class="col-md-8 col-lg-6">
        <form class="input-group subscription-form" onsubmit="subscriber_fnc(token); return false;">
          <input type="email" class="form-control" id="subscriber_email" name="subscriber_email" placeholder="Your Email Address" required data-bs-toggle="tooltip" title="Enter a valid email to subscribe">
          <button class="btn btn-main" type="submit">Subscribe for Updates</button>
        </form>
      </div>
    </div>
  </div>
</section>


<?php if (!empty($random_items) && is_array($random_items)) : ?>
<!-- Theme You May Also Like Start
================================================== -->
<section class="t-ymal" aria-labelledby="ymal-heading">
  <div class="container">
    <header class="title">
      <h2 id="ymal-heading">You May Also Like</h2>
    </header>
    <div class="row">
      <div class="col-12">
        <div class="t-ymal-slider">
          <?php foreach ($random_items as $item) : ?>
            <?php
              $rating = round($item['ratings'], 1);
              $fullStars = floor($rating);
              $halfStar = ($rating - $fullStars) >= 0.5;
              $ratingClass = 'rating-' . floor($rating);
            ?>
            <div>
              <article class="item-card" data-rating="<?= $rating; ?>" id="item_<?= $item['item_id']; ?>_zone">
                <div class="item-thumb">
					<div class="badge-group">
						  <?= ($item['newbie'] && $cc['badge_newbie'] === 'TRUE') ? '<span class="badge newbie">New</span>' : '' ?>
                  <?= ($item['hd'] && $cc['badge_hd'] === 'TRUE') ? '<span class="badge hd">HD</span>' : '' ?>
				  <?= ($item['lq'] && $cc['badge_lq'] === 'TRUE') ? '<span class="badge lq">LQ</span>' : '' ?>
						</div>                
                  <a href="<?= $cc['base_url'] . slug2url_fnc('items_details', $item['item_id'], $item['slug'], $item['meta_title']); ?>"  data-bs-toggle="tooltip" data-bs-original-title="<?= $item['meta_title']; ?>"  title="<?= $item['meta_title']; ?>">
                    <img class="img-responsive" loading="lazy" data-src="<?= $cc['img_url'] . display_image_fnc('webp-' . $cc['tiny_image_width'] . 'x' . $cc['tiny_image_height'], $item['upload_file']); ?>" alt="<?= $item['meta_title']; ?>" />
                  </a>
                  <?php if ($cc['ratings'] === 'TRUE') : ?>
                    <div class="preview-meta">
                      <div class="star-rating <?= $ratingClass; ?>" data-bs-toggle="tooltip" data-bs-original-title="Rated <?= $rating ?> out of 5"  title="Rated <?= $rating ?> out of 5">
                        <?php for ($i = 1; $i <= 5; $i++) : ?>
                          <?php if ($i <= $fullStars) : ?>
                            <i class="fa-solid fa-star filled"></i>
                          <?php elseif ($i === $fullStars + 1 && $halfStar) : ?>
                            <i class="fa-solid fa-star-half-stroke filled"></i>
                          <?php else : ?>
                            <i class="fa-regular fa-star"></i>
                          <?php endif; ?>
                        <?php endfor; ?>
                      </div>
                      <div class="meta-stats">
                        <span class="likes"  data-bs-toggle="tooltip" data-bs-original-title="32.6k Likes"  title="32.6k Likes"><i class="fa-solid fa-heart"></i> 32.6k</span>
                        <span class="rates"  data-bs-toggle="tooltip" data-bs-original-title="1.2k Rates"  title="1.2k Rates"><i class="fa-solid fa-user-check"></i> 1.2k</span>
                      </div>
                      <ul class="quick-view">
                        <li>
                          <a href="javascript:void(0);" onclick="product_quick_view_fnc(<?= $item['item_id']; ?>, '<?= data2js_fnc($item['title']); ?>', '<?= $item['model']; ?>', '<?= data2js_fnc($item['spotlight']); ?>', '<?= $cc['img_url'] . display_image_fnc('webp-' . $cc['large_image_width'] . 'x' . $cc['large_image_height'], $item['upload_file']); ?>', '<?= $cc['base_url'] . slug2url_fnc('items_details', $item['item_id'], $item['slug'], $item['meta_title']); ?>', token);" data-bs-toggle="tooltip" data-bs-original-title="Quick View"  title="Quick View">
                            <span class="btn-quick"><i class="fa-solid fa-magnifying-glass"></i> Quick View</span>
                          </a>
                        </li>
                      </ul>
                    </div>
                  <?php endif; ?>
                </div>
                <div class="item-content">
                  <h4>
                    <a href="<?= $cc['base_url'] . slug2url_fnc('items_details', $item['item_id'], $item['slug'], $item['meta_title']); ?>" data-bs-toggle="tooltip" data-bs-original-title="<?= $item['meta_title']; ?>"  title="<?= $item['meta_title']; ?>">
                      <?= $item['name']; ?>
                    </a>
                  </h4>
                </div>
              </article>
            </div>
          <?php endforeach; ?>
        </div>
      </div>
    </div>
  </div>
</section>
<?php endif; ?>

<?php if (!empty($categories) && is_array($categories)) : ?>
<!-- Theme Browse by Categories Start
================================================== -->
<section class="container-fluid t-categories py-5">
  <div class="container">
    <h2 class="text-center mb-4">Browse by Categories</h2>
    <div class="row g-4">
      <?php
        foreach ($categories as $i => $category) {
          echo '
          <div class="col-6 col-sm-4 col-md-3 col-lg-2">
            <a href="' . $cc['base_url'] . slug2url_fnc('items_by_categories', $category['category_id'], $category['slug'], $category['title']) . '" class="category-card text-decoration-none text-center d-block p-3 rounded shadow-sm h-100" style="--i:' . $i . '" aria-label="' . $category['title'] . '"  data-bs-toggle="tooltip" data-bs-original-title="' . $category['title'] . '" title="' . $category['title'] . '">
              <div class="card-inner">
                <div class="category-icon fs-2 mb-2">' . $category['icon'] . '</div>
                <div class="category-name fw-semibold">' . $category['name'] . '</div>
                <div class="category-count">' . $category['items'] . '</div>
              </div>
            </a>
          </div>';
        }
      ?>
    </div>
  </div>
</section>
<?php endif; ?>

<!-- Theme Links Start
================================================== -->
<section class="container-fluid t-links py-5">
  <div class="container">
    <div class="row g-4">

      <!-- Industry -->
      <div class="col-12 col-md-6 col-lg-3">
        <h3 class="group-title">🎬 Industry</h3>
        <ul class="link-list">
          <?php if (!empty($industries) && is_array($industries)) : 
            foreach ($industries as $i => $industry) {
              echo '<li><a href="' . $cc['base_url'] . slug2url_fnc('items_by_industries', $industry['industry_id'], $industry['slug'], $industry['title']) . '" data-bs-toggle="tooltip" data-bs-original-title="' . $industry['title'] . '" title="' . $industry['title'] . '">' . $industry['name'] . '</a></li>';
               ?>
          <?php }
         endif; ?>
        </ul>
      </div>

      <!-- Voice -->
      <div class="col-12 col-md-6 col-lg-3">
        <h3 class="group-title">🗣️ Voice</h3>
        <ul class="link-list">
          <?php if (!empty($voices) && is_array($voices)) : 
            foreach ($voices as $i => $voice) {
              echo '<li><a href="' . $cc['base_url'] . slug2url_fnc('items_by_voices', $voice['voice_id'], $voice['slug'], $voice['title']) . '" data-bs-toggle="tooltip" data-bs-original-title="' . $voice['title'] . '" title="' . $voice['title'] . '">' . $voice['name'] . '</a></li>';
               ?>
          <?php }
         endif; ?>
        </ul>
      </div>

      <!-- Regions -->
      <div class="col-12 col-md-6 col-lg-3">
        <h3 class="group-title">🌍 Regions</h3>
        <ul class="link-list">
          <?php if (!empty($regions) && is_array($regions)) : 
            foreach ($regions as $i => $region) {
              echo '<li><a href="' . $cc['base_url'] . slug2url_fnc('items_by_regions', $region['region_id'], $region['slug'], $region['title']) . '" data-bs-toggle="tooltip" data-bs-original-title="' . $region['title'] . '" title="' . $region['title'] . '">' . $region['name'] . '</a></li>';
               ?>
          <?php }
         endif; ?>
        </ul>
      </div>

      <!-- Sections -->
      <div class="col-12 col-md-6 col-lg-3">
        <h3 class="group-title">📺 Section</h3>
        <ul class="link-list">
          <?php if (!empty($sections) && is_array($sections)) : 
            foreach ($sections as $i => $section) {
              echo '<li><a href="' . $cc['base_url'] . slug2url_fnc('items_by_sections', $section['section_id'], $section['slug'], $section['title']) . '" data-bs-toggle="tooltip" data-bs-original-title="' . $section['title'] . '" title="' . $section['title'] . '">' . $section['name'] . '</a></li>';
               ?>
          <?php }
         endif; ?>
        </ul>
      </div>

    </div>
  </div>
</section>





<!-- Theme Footer Start
================================================== -->
<footer class="container-fluid t-footer text-center py-4">
  <div class="container">
    <div class="row justify-content-center">
      <div class="col-lg-10 col-md-12">
          <?php
      $socials = [
      'facebook-f'     => ['key' => 'social_facebook',   'title' => 'Join the movement on Facebook', 'style' => 'brands'],
      'instagram'      => ['key' => 'social_instagram',  'title' => 'Feel the pulse on Instagram', 'style' => 'brands'],
      'x-twitter'      => ['key' => 'social_x',          'title' => 'Catch our latest drops on X', 'style' => 'brands'],
      'whatsapp'       => ['key' => 'social_whatsapp',   'title' => 'Stay in the loop via WhatsApp', 'style' => 'brands'],
      'telegram'       => ['key' => 'social_telegram',   'title' => 'Unlock exclusive updates on Telegram', 'style' => 'brands'],
      'tiktok'         => ['key' => 'social_tiktok',     'title' => 'Watch the vibe unfold on TikTok', 'style' => 'brands'],
      'pinterest-p'    => ['key' => 'social_pinterest',  'title' => 'Get inspired on Pinterest', 'style' => 'brands'],
      'linkedin-in'    => ['key' => 'social_linkedin',   'title' => 'Grow with us on LinkedIn', 'style' => 'brands'],
      'youtube'        => ['key' => 'social_youtube',    'title' => 'Experience our story on YouTube', 'style' => 'brands'],
      'blogger-b'      => ['key' => 'social_blogger',    'title' => 'Read behind-the-scenes insights on Blogger', 'style' => 'brands'],
      'people-group'   => ['key' => 'social_group',      'title' => 'Collaborate with our crew on Google Groups', 'style' => 'solid'],
      'tumblr'         => ['key' => 'social_tumblr',     'title' => 'Explore our aesthetic on Tumblr', 'style' => 'brands'],
      'reddit-alien'   => ['key' => 'social_reddit',     'title' => 'Join the buzz on Reddit', 'style' => 'brands']
    ];


          ?>
           <ul class="social-media list-inline mb-4">
  <?php foreach ($socials as $icon => $data): ?>
    <?php if (!empty($cc[$data['key']])): ?>
      <li class="list-inline-item mx-2">
        <a href="<?php echo $cc[$data['key']]; ?>" target="_blank" rel="noopener" data-bs-toggle="tooltip" data-bs-original-title="<?php echo $data['title']; ?>" title="<?php echo $data['title']; ?>">
          <i class="fa-<?php echo $data['style']; ?> fa-<?php echo $icon; ?>"></i>
        </a>
      </li>
    <?php endif; ?>
  <?php endforeach; ?>
</ul>
<ul class="menu text-uppercase">
  <?php $bottom_pages = select_pages_fnc($pages_tree, $cc['base_url'], 'bottom');
				if(count($bottom_pages) > 0){  
					foreach($bottom_pages as $page){ ?>
      <li>
        <a href="<?php echo $cc['base_url'] . slug2url_fnc('pages_details', $page['id'], $page['slug'], $page['title']); ?>" data-bs-toggle="tooltip" data-bs-original-title="<?php echo $page['title']; ?>" title="<?php echo $page['title']; ?>">
          <?php echo $page['name']; ?>
        </a>
      </li>
    <?php } } ?>
  <li><a href="<?php echo $cc['base_url'] . 'Contact'; ?>" data-bs-toggle="tooltip" data-bs-original-title="Actors" title="Actors">Actors</a></li>
  <li><a href="<?php echo $cc['base_url'] . 'Contact'; ?>" data-bs-toggle="tooltip" data-bs-original-title="Actresses" title="Actresses">Actresses</a></li>
  <li><a href="<?php echo $cc['base_url'] . 'Contact'; ?>" data-bs-toggle="tooltip" data-bs-original-title="Directors" title="Directors">Directors</a></li>
  <li><a href="<?php echo $cc['base_url'] . 'Contact'; ?>" data-bs-toggle="tooltip" data-bs-original-title="Producers" title="Producers">Producers</a></li>
  <li><a href="<?php echo $cc['base_url'] . 'Contact'; ?>" data-bs-toggle="tooltip" data-bs-original-title="Writers" title="Writers">Writers</a></li>
  <li><a href="<?php echo $cc['base_url'] . 'Contact'; ?>" data-bs-toggle="tooltip" data-bs-original-title="Singers" title="Singers">Singers</a></li>
  <li><a href="<?php echo $cc['base_url'] . 'Contact'; ?>" data-bs-toggle="tooltip" data-bs-original-title="Designers" title="Designers">Designers</a></li>
  <li><a href="<?php echo $cc['base_url'] . 'Contact'; ?>" data-bs-toggle="tooltip" data-bs-original-title="Editors" title="Editors">Editors</a></li>
  <li><a href="<?php echo $cc['base_url'] . 'Contact'; ?>" data-bs-toggle="tooltip" data-bs-original-title="Cinematographers" title="Cinematographers">Cinematographers</a></li>
  <li><a href="<?php echo $cc['base_url'] . 'Contact'; ?>" data-bs-toggle="tooltip" data-bs-original-title="Contact" title="Contact">Contact</a></li>
</ul>


        <p class="copyright small mb-1">
          &copy; <?php echo date('Y'); ?> <a href="<?php echo $cc['base_url']; ?>"  data-bs-toggle="tooltip" data-bs-original-title="<?php echo $cc['app_name']; ?>" title="<?php echo $cc['app_name']; ?>"><?php echo $cc['app_name']; ?></a>. All rights reserved.
        </p>

        <p class="powered small mb-0">
          <a href="https://ex.com.pk/web-development.html" rel="follow" data-bs-toggle="tooltip" data-bs-original-title="This site is developed by ExTech Corporation" title="This site is developed by ExTech Corporation">Developed</a> &amp;
          <a href="https://ex.com.pk/web-promotion.html" rel="follow" data-bs-toggle="tooltip" data-bs-original-title="SEO services by ExTech Corporation" title="SEO services by ExTech Corporation">SEO</a> by
          <strong><a href="https://ex.com.pk/" rel="follow" data-bs-toggle="tooltip" data-bs-original-title="Powered by ExTech Corporation – Engineered for Performance" title="Powered by ExTech Corporation – Engineered for Performance
">ExTech Corporation</a></strong>
        </p>

      </div>
    </div>
  </div>
</footer>