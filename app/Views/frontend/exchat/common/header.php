<!-- Theme Header Start
================================================== -->
<header class="t-header sticky-top shadow-sm">
  <div class="container-fluid position-relative">

    <!-- Theme Toggle -->
    <button id="themeToggle" class="position-absolute top-0 end-0 m-3" aria-label="Change Theme" data-bs-toggle="tooltip" title="Change Theme">
      <span id="themeIcon">🌙</span>
    </button>

    <div class="container py-3" id="headerContent">
      <div class="row align-items-center justify-content-between flex-column flex-md-row">

        <!-- Logo -->
        <div class="col-auto mb-3 mb-md-0">
          <a href="<?php echo $cc['base_url']; ?>" data-bs-toggle="tooltip" title="<?php echo $cc['app_title']; ?>">
            <img id="logoImg"
                 data-src="<?php echo $cc['img_url'].'public/images/frontend/'.$cc['frontend_theme'].'/logo.webp'; ?>"
                 class="logo"
                 alt="<?php echo $cc['app_title']; ?>"
                 loading="lazy" />
          </a>
        </div>

        <!-- Search Bar -->
        <div class="col text-center text-md-end">
          <form action="search.html" method="get" onsubmit="return validate_search_fnc()" class="d-inline-block w-100 w-md-auto w-lg-50 mx-auto mx-md-0 max-search-width">
            <div class="input-group">
              <input type="text"
                     name="query"
                     id="query-fld"
                     class="form-control search-int"
                     placeholder="Search keyword..."
                     aria-label="Search keyword..."
                     required
                     autocomplete="off">
              <button type="submit" class="btn border-0 search-btn" aria-label="Submit search">
                <i class="fa-solid fa-magnifying-glass"></i>
              </button>
            </div>
          </form>
        </div>

      </div>
    </div>
  </div>
</header>
