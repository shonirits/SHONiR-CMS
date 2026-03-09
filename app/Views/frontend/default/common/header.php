<header class="container-fluid t-header p-0">
  
  <div class="top-zone d-none d-lg-block">
    <div class="container d-flex justify-content-between align-items-center">
      <div class="text py-1">Free worldwide shipping on orders over $500</div>
      <div class="social py-1">
        <a href="<?php echo $cc["social_facebook"]; ?>"><i class="fab fa-facebook-f"></i></a>
        <a href="<?php echo $cc["social_instagram"]; ?>"><i class="fab fa-instagram"></i></a>
        <a href="<?php echo $cc["social_linkedin"]; ?>"><i class="fab fa-linkedin-in"></i></a>
      </div>
    </div>
  </div>

  <div class="main-zone py-1">
    <div class="container">
      <div class="row align-items-center">
        <div class="col-2 d-lg-none">
          <button class="navbar-toggler"
        type="button"
        data-bs-toggle="collapse"
        data-bs-target="#main_nav"
        aria-controls="main_nav"
        aria-expanded="false"
        aria-label="Toggle navigation">
  <span class="navbar-toggler-icon"></span>
</button>
        </div>

        <div class="col-lg-3 col-6 text-center text-lg-start logo">
          <a href="<?php echo $cc['base_url']; ?>">
            <img src="<?php echo $cc['img_url'].'public/images/frontend/'.$cc['frontend_theme'].'/logo.webp'; ?>" class="img-fluid" alt="Logo">
          </a>
        </div>

        <div class="col-lg-6 d-none d-lg-block search-zone">
          <form action="<?php echo $cc['base_url']; ?>search.html" method="get" onsubmit="return validate_search_fnc()">
            <div class="input-group">
              <input class="form-control search-int" type="text" name="query" id="query-fld" placeholder="Enter model or keyword...">
              <button class="btn search-btn" type="submit">
                <i class="fa-solid fa-magnifying-glass"></i>
              </button>
            </div>
          </form>
        </div>

        <div class="col-lg-3 col-4 text-end icon-zone">
          <ul class="list-inline m-0 p-0 d-flex justify-content-end align-items-center">
            <li class="list-inline-item d-lg-none me-3"><a href="javascript:void(0)" class="search-trigger">
                    <i class="fa-solid fa-magnifying-glass"></i>
                </a></li>
           <li class="list-inline-item dropdown cart-zone position-relative">
  <a href="#"
     class="position-relative link dropdown-toggle"
     data-bs-toggle="dropdown"
     data-bs-auto-close="outside"
     aria-expanded="false">
     
    <i class="fa-solid fa-basket-shopping"></i>
    <span class="badge total-cart-items">0</span>
    <span class="d-none d-lg-inline-block ms-1">Quote Cart</span>
  </a>

  <div class="dropdown-menu dropdown-menu-end quick-cart-content p-2">
    <!-- cart content here -->
  </div>
</li>
          </ul>
        </div>
        
      </div>
    </div>
  </div>

  <nav id="navbar_top"
     class="navbar navbar-expand-lg navbar-zone p-0"
     aria-label="Main Navigation">

  <div class="container">
    <div class="collapse navbar-collapse justify-content-center main_nav"
         id="main_nav">
      <ul class="navbar-nav level-0">
        <?php 
        
        $quick_links = [
    [
        'name' => 'Quick Links',
        'link' => '#',
        'children' => [           
            ['name' => 'Videos Gallery', 'link' => $cc['base_url'].'g26/videos-gallery.html'],
            ['name' => 'Images Gallery', 'link' => $cc['base_url'].'g21/images-gallery.html'],
            ['name' => 'Our Blog', 'link' => $cc['base_url'].'Blog'],
            ['name' => 'Contact', 'link' => $cc['base_url'].'Contact']
        ]
    ],
     ['name' => 'Our Products', 'link' => $cc['base_url'].'ibc.html']
];

$top_pages = extract_by_key_fnc($pages_tree, 'pages_details', 'page', 'top', $cc['base_url']);

if(count($top_pages) > 0){
    foreach($top_pages as $top_page){
        $quick_links[0]['children'][] = [
            'name' => $top_page['name'],
            'link' => $cc['base_url'].slug2url_fnc('pages_details', $top_page['page_id'], $top_page['slug'], $top_page['title'])
        ];
    }
}

$menu_items = array_merge($quick_links, $categories_tree);

echo navbar_fnc($menu_items, $page['id']);
        ?>
      </ul>
    </div>
  </div>
</nav>

</header>