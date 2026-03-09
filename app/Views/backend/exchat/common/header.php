
<nav class="navbar navbar-light bg-light shadow-sm">
  <div class="container-fluid">
    <button class="btn btn-outline-secondary me-2" type="button" data-bs-toggle="offcanvas" data-bs-target="#sidebarMenu" aria-controls="sidebarMenu">
  <i class="fa-solid fa-bars"></i>
</button>

    <a class="navbar-brand fw-bold me-auto" href="https://www.shonir.com"><img data-src="<?php echo $cc['img_url'].'public/images/backend/'.$cc['backend_theme'].'/shonir-header-logo.webp'; ?>" class="img-fluid" alt="SHONiR" /></a>

    <div class="dropdown">
  <a href="#" class="d-flex align-items-center text-dark text-decoration-none dropdown-toggle" data-bs-toggle="dropdown" aria-expanded="false">
    <img src="https://via.placeholder.com/32" alt="Profile" class="rounded-circle me-2">
    <span class="d-none d-sm-inline">Shonir</span>
  </a>
  <ul class="dropdown-menu dropdown-menu-end">
    <li><a class="dropdown-item" href="#">Profile</a></li>
    <li><a class="dropdown-item" href="#">Settings</a></li>
    <li><hr class="dropdown-divider"></li>
    <li><a class="dropdown-item" href="<?php echo $cc['base_url'].'Users/logout'; ?>">Logout</a></li>
  </ul>
</div>

  </div>
</nav>

<!-- Sidebar Offcanvas -->
<div class="offcanvas offcanvas-start text-bg-dark" tabindex="-1" id="sidebarMenu" aria-labelledby="sidebarMenuLabel">
  <div class="offcanvas-header border-bottom">
    <h5 class="offcanvas-title" id="sidebarMenuLabel">Menu</h5>
    <button type="button" class="btn-close btn-close-white" data-bs-dismiss="offcanvas" aria-label="Close"></button>
  </div>
  <div class="offcanvas-body p-0">
    <ul class="list-group list-group-flush">

    <li class="list-group-item bg-dark">
    <a class="text-white text-decoration-none d-flex justify-content-between align-items-center" href="<?php echo $cc['base_url'].'Backend'; ?>">
    <span><i class="fa-solid fa-ellipsis-vertical"></i> Dashboard</span>
  </a>
  </li>

<li class="list-group-item bg-dark">
  <a class="text-white text-decoration-none d-flex justify-content-between align-items-center" data-bs-toggle="collapse" href="#menucategories" role="button" aria-expanded="false" aria-controls="menucategories">
    <span><i class="fa-solid fa-ellipsis-vertical"></i> Categories</span>
    <i class="fa-solid fa-chevron-down small transition" aria-hidden="true"></i>
  </a>
  <div class="collapse ps-3 pt-2" id="menucategories" data-bs-parent="#sidebarMenu">
    <ul class="list-unstyled">
      <li><a class="text-white text-decoration-none d-block py-1 small" href="<?php echo $cc['base_url'].'Categories/list'; ?>"><i class="fa-solid fa-ellipsis"></i> List</a></li>
      <li><a class="text-white text-decoration-none d-block py-1 small" href="<?php echo $cc['base_url'].'Categories/add'; ?>"><i class="fa-solid fa-ellipsis"></i> Add</a></li>
    </ul>
  </div>
</li>

<li class="list-group-item bg-dark">
  <a class="text-white text-decoration-none d-flex justify-content-between align-items-center" data-bs-toggle="collapse" href="#menusections" role="button" aria-expanded="false" aria-controls="menusections">
    <span><i class="fa-solid fa-ellipsis-vertical"></i> Sections</span>
    <i class="fa-solid fa-chevron-down small transition" aria-hidden="true"></i>
  </a>
  <div class="collapse ps-3 pt-2" id="menusections" data-bs-parent="#sidebarMenu">
    <ul class="list-unstyled">
      <li><a class="text-white text-decoration-none d-block py-1 small" href="<?php echo $cc['base_url'].'Sections/list'; ?>"><i class="fa-solid fa-ellipsis"></i> List</a></li>
      <li><a class="text-white text-decoration-none d-block py-1 small" href="<?php echo $cc['base_url'].'Sections/add'; ?>"><i class="fa-solid fa-ellipsis"></i> Add</a></li>
    </ul>
  </div>
</li>

<li class="list-group-item bg-dark">
  <a class="text-white text-decoration-none d-flex justify-content-between align-items-center" data-bs-toggle="collapse" href="#menubrands" role="button" aria-expanded="false" aria-controls="menubrands">
    <span><i class="fa-solid fa-ellipsis-vertical"></i> Brands</span>
    <i class="fa-solid fa-chevron-down small transition" aria-hidden="true"></i>
  </a>
  <div class="collapse ps-3 pt-2" id="menubrands" data-bs-parent="#sidebarMenu">
    <ul class="list-unstyled">
      <li><a class="text-white text-decoration-none d-block py-1 small" href="<?php echo $cc['base_url'].'Brands/list'; ?>"><i class="fa-solid fa-ellipsis"></i> List</a></li>
      <li><a class="text-white text-decoration-none d-block py-1 small" href="<?php echo $cc['base_url'].'Brands/add'; ?>"><i class="fa-solid fa-ellipsis"></i> Add</a></li>
    </ul>
  </div>
</li>

<li class="list-group-item bg-dark">
  <a class="text-white text-decoration-none d-flex justify-content-between align-items-center" data-bs-toggle="collapse" href="#menuawards" role="button" aria-expanded="false" aria-controls="menuawards">
    <span><i class="fa-solid fa-ellipsis-vertical"></i> Awards</span>
    <i class="fa-solid fa-chevron-down small transition" aria-hidden="true"></i>
  </a>
  <div class="collapse ps-3 pt-2" id="menuawards" data-bs-parent="#sidebarMenu">
    <ul class="list-unstyled">
      <li><a class="text-white text-decoration-none d-block py-1 small" href="<?php echo $cc['base_url'].'Awards/list'; ?>"><i class="fa-solid fa-ellipsis"></i> List</a></li>
      <li><a class="text-white text-decoration-none d-block py-1 small" href="<?php echo $cc['base_url'].'Awards/add'; ?>"><i class="fa-solid fa-ellipsis"></i> Add</a></li>
    </ul>
  </div>
</li>

<li class="list-group-item bg-dark">
  <a class="text-white text-decoration-none d-flex justify-content-between align-items-center" data-bs-toggle="collapse" href="#menuindustries" role="button" aria-expanded="false" aria-controls="menuindustries">
    <span><i class="fa-solid fa-ellipsis-vertical"></i> Industries</span>
    <i class="fa-solid fa-chevron-down small transition" aria-hidden="true"></i>
  </a>
  <div class="collapse ps-3 pt-2" id="menuindustries" data-bs-parent="#sidebarMenu">
    <ul class="list-unstyled">
      <li><a class="text-white text-decoration-none d-block py-1 small" href="<?php echo $cc['base_url'].'Industries/list'; ?>"><i class="fa-solid fa-ellipsis"></i> List</a></li>
      <li><a class="text-white text-decoration-none d-block py-1 small" href="<?php echo $cc['base_url'].'Industries/add'; ?>"><i class="fa-solid fa-ellipsis"></i> Add</a></li>
    </ul>
  </div>
</li>

<li class="list-group-item bg-dark">
  <a class="text-white text-decoration-none d-flex justify-content-between align-items-center" data-bs-toggle="collapse" href="#menuplaces" role="button" aria-expanded="false" aria-controls="menuplaces">
    <span><i class="fa-solid fa-ellipsis-vertical"></i> Places</span>
    <i class="fa-solid fa-chevron-down small transition" aria-hidden="true"></i>
  </a>
  <div class="collapse ps-3 pt-2" id="menuplaces" data-bs-parent="#sidebarMenu">
    <ul class="list-unstyled">
      <li><a class="text-white text-decoration-none d-block py-1 small" href="<?php echo $cc['base_url'].'Places/list'; ?>"><i class="fa-solid fa-ellipsis"></i> List</a></li>
      <li><a class="text-white text-decoration-none d-block py-1 small" href="<?php echo $cc['base_url'].'Places/add'; ?>"><i class="fa-solid fa-ellipsis"></i> Add</a></li>
    </ul>
  </div>
</li>

<li class="list-group-item bg-dark">
  <a class="text-white text-decoration-none d-flex justify-content-between align-items-center" data-bs-toggle="collapse" href="#menuregions" role="button" aria-expanded="false" aria-controls="menuregions">
    <span><i class="fa-solid fa-ellipsis-vertical"></i> Regions</span>
    <i class="fa-solid fa-chevron-down small transition" aria-hidden="true"></i>
  </a>
  <div class="collapse ps-3 pt-2" id="menuregions" data-bs-parent="#sidebarMenu">
    <ul class="list-unstyled">
      <li><a class="text-white text-decoration-none d-block py-1 small" href="<?php echo $cc['base_url'].'Regions/list'; ?>"><i class="fa-solid fa-ellipsis"></i> List</a></li>
      <li><a class="text-white text-decoration-none d-block py-1 small" href="<?php echo $cc['base_url'].'Regions/add'; ?>"><i class="fa-solid fa-ellipsis"></i> Add</a></li>
    </ul>
  </div>
</li>

<li class="list-group-item bg-dark">
  <a class="text-white text-decoration-none d-flex justify-content-between align-items-center" data-bs-toggle="collapse" href="#menuvoices" role="button" aria-expanded="false" aria-controls="menuvoices">
    <span><i class="fa-solid fa-ellipsis-vertical"></i> Voices</span>
    <i class="fa-solid fa-chevron-down small transition" aria-hidden="true"></i>
  </a>
  <div class="collapse ps-3 pt-2" id="menuvoices" data-bs-parent="#sidebarMenu">
    <ul class="list-unstyled">
      <li><a class="text-white text-decoration-none d-block py-1 small" href="<?php echo $cc['base_url'].'Voices/list'; ?>"><i class="fa-solid fa-ellipsis"></i> List</a></li>
      <li><a class="text-white text-decoration-none d-block py-1 small" href="<?php echo $cc['base_url'].'Voices/add'; ?>"><i class="fa-solid fa-ellipsis"></i> Add</a></li>
    </ul>
  </div>
</li>

<li class="list-group-item bg-dark">
  <a class="text-white text-decoration-none d-flex justify-content-between align-items-center" data-bs-toggle="collapse" href="#menunatives" role="button" aria-expanded="false" aria-controls="menunatives">
    <span><i class="fa-solid fa-ellipsis-vertical"></i> Natives</span>
    <i class="fa-solid fa-chevron-down small transition" aria-hidden="true"></i>
  </a>
  <div class="collapse ps-3 pt-2" id="menunatives" data-bs-parent="#sidebarMenu">
    <ul class="list-unstyled">
      <li><a class="text-white text-decoration-none d-block py-1 small" href="<?php echo $cc['base_url'].'Natives/list'; ?>"><i class="fa-solid fa-ellipsis"></i> List</a></li>
      <li><a class="text-white text-decoration-none d-block py-1 small" href="<?php echo $cc['base_url'].'Natives/add'; ?>"><i class="fa-solid fa-ellipsis"></i> Add</a></li>
    </ul>
  </div>
</li>

<li class="list-group-item bg-dark">
  <a class="text-white text-decoration-none d-flex justify-content-between align-items-center" data-bs-toggle="collapse" href="#menutalents" role="button" aria-expanded="false" aria-controls="menutalents">
    <span><i class="fa-solid fa-ellipsis-vertical"></i> Talents</span>
    <i class="fa-solid fa-chevron-down small transition" aria-hidden="true"></i>
  </a>
  <div class="collapse ps-3 pt-2" id="menutalents" data-bs-parent="#sidebarMenu">
    <ul class="list-unstyled">
      <li><a class="text-white text-decoration-none d-block py-1 small" href="<?php echo $cc['base_url'].'Talents/list'; ?>"><i class="fa-solid fa-ellipsis"></i> List</a></li>
      <li><a class="text-white text-decoration-none d-block py-1 small" href="<?php echo $cc['base_url'].'Talents/add'; ?>"><i class="fa-solid fa-ellipsis"></i> Add</a></li>
    </ul>
  </div>
</li>

<li class="list-group-item bg-dark">
  <a class="text-white text-decoration-none d-flex justify-content-between align-items-center" data-bs-toggle="collapse" href="#menuitems" role="button" aria-expanded="false" aria-controls="menuitems">
    <span><i class="fa-solid fa-ellipsis-vertical"></i> Items</span>
    <i class="fa-solid fa-chevron-down small transition" aria-hidden="true"></i>
  </a>
  <div class="collapse ps-3 pt-2" id="menuitems" data-bs-parent="#sidebarMenu">
    <ul class="list-unstyled">
      <li><a class="text-white text-decoration-none d-block py-1 small" href="<?php echo $cc['base_url'].'Items/list'; ?>"><i class="fa-solid fa-ellipsis"></i> List</a></li>
      <li><a class="text-white text-decoration-none d-block py-1 small" href="<?php echo $cc['base_url'].'Items/add'; ?>"><i class="fa-solid fa-ellipsis"></i> Add</a></li>
    </ul>
  </div>
</li>

<li class="list-group-item bg-dark">
  <a class="text-white text-decoration-none d-flex justify-content-between align-items-center" data-bs-toggle="collapse" href="#menupages" role="button" aria-expanded="false" aria-controls="menupages">
    <span><i class="fa-solid fa-ellipsis-vertical"></i> Pages</span>
    <i class="fa-solid fa-chevron-down small transition" aria-hidden="true"></i>
  </a>
  <div class="collapse ps-3 pt-2" id="menupages" data-bs-parent="#sidebarMenu">
    <ul class="list-unstyled">
      <li><a class="text-white text-decoration-none d-block py-1 small" href="<?php echo $cc['base_url'].'Pages/list'; ?>"><i class="fa-solid fa-ellipsis"></i> List</a></li>
      <li><a class="text-white text-decoration-none d-block py-1 small" href="<?php echo $cc['base_url'].'Pages/add'; ?>"><i class="fa-solid fa-ellipsis"></i> Add</a></li>
    </ul>
  </div>
</li>

<li class="list-group-item bg-dark">
  <a class="text-white text-decoration-none d-flex justify-content-between align-items-center" data-bs-toggle="collapse" href="#menulinks" role="button" aria-expanded="false" aria-controls="menulinks">
    <span><i class="fa-solid fa-ellipsis-vertical"></i> Links</span>
    <i class="fa-solid fa-chevron-down small transition" aria-hidden="true"></i>
  </a>
  <div class="collapse ps-3 pt-2" id="menulinks" data-bs-parent="#sidebarMenu">
    <ul class="list-unstyled">
      <li><a class="text-white text-decoration-none d-block py-1 small" href="<?php echo $cc['base_url'].'Links/list'; ?>"><i class="fa-solid fa-ellipsis"></i> List</a></li>
      <li><a class="text-white text-decoration-none d-block py-1 small" href="<?php echo $cc['base_url'].'Links/add'; ?>"><i class="fa-solid fa-ellipsis"></i> Add</a></li>
    </ul>
  </div>
</li>

<li class="list-group-item bg-dark">
  <a class="text-white text-decoration-none d-flex justify-content-between align-items-center" data-bs-toggle="collapse" href="#menubanners" role="button" aria-expanded="false" aria-controls="menubanners">
    <span><i class="fa-solid fa-ellipsis-vertical"></i> Banners</span>
    <i class="fa-solid fa-chevron-down small transition" aria-hidden="true"></i>
  </a>
  <div class="collapse ps-3 pt-2" id="menubanners" data-bs-parent="#sidebarMenu">
    <ul class="list-unstyled">
      <li><a class="text-white text-decoration-none d-block py-1 small" href="<?php echo $cc['base_url'].'Banners/list'; ?>"><i class="fa-solid fa-ellipsis"></i> List</a></li>
      <li><a class="text-white text-decoration-none d-block py-1 small" href="<?php echo $cc['base_url'].'Banners/add'; ?>"><i class="fa-solid fa-ellipsis"></i> Add</a></li>
    </ul>
  </div>
</li>

<li class="list-group-item bg-dark">
  <a class="text-white text-decoration-none d-flex justify-content-between align-items-center" data-bs-toggle="collapse" href="#menumailsservers" role="button" aria-expanded="false" aria-controls="menumailsservers">
    <span><i class="fa-solid fa-ellipsis-vertical"></i> Mails Servers</span>
    <i class="fa-solid fa-chevron-down small transition" aria-hidden="true"></i>
  </a>
  <div class="collapse ps-3 pt-2" id="menumailsservers" data-bs-parent="#sidebarMenu">
    <ul class="list-unstyled">
      <li><a class="text-white text-decoration-none d-block py-1 small" href="<?php echo $cc['base_url'].'MailsServers/list'; ?>"><i class="fa-solid fa-ellipsis"></i> List</a></li>
      <li><a class="text-white text-decoration-none d-block py-1 small" href="<?php echo $cc['base_url'].'MailsServers/add'; ?>"><i class="fa-solid fa-ellipsis"></i> Add</a></li>
    </ul>
  </div>
</li>

<li class="list-group-item bg-dark">
    <a class="text-white text-decoration-none d-flex justify-content-between align-items-center" href="<?php echo $cc['base_url'].'Emails/list'; ?>">
    <span><i class="fa-solid fa-ellipsis-vertical"></i> Emails</span>
  </a>
  </li>

 <li class="list-group-item bg-dark">
    <a class="text-white text-decoration-none d-flex justify-content-between align-items-center" href="<?php echo $cc['base_url'].'Configurations'; ?>">
    <span><i class="fa-solid fa-ellipsis-vertical"></i> Configurations</span>
  </a>
  </li>
  

  <li class="list-group-item bg-dark">
    <a class="text-white text-decoration-none d-flex justify-content-between align-items-center" href="<?php echo $cc['base_url'].'Analytics'; ?>">
    <span><i class="fa-solid fa-ellipsis-vertical"></i> Analytics</span>
  </a>
  </li>

  <li class="list-group-item bg-dark">
    <a class="text-white text-decoration-none d-flex justify-content-between align-items-center" href="javascript:confirm_fnc('Cancel', '', '', 'Delete', '<?php echo $cc['base_url'].'Backend/cleanup_caches'; ?>', '', 'Cleanup Caches', '<p>Are you sure you want to clear all caches? This action will:</p><ul><li>Remove all active user sessions</li><li>Delete browser session data</li><li>Erase cached HTML, PHP, and image files</li></ul><p><strong>Please note:</strong> After clearing, website speed may temporarily decrease and server load might increase as resources are regenerated.</p>');">
    <span><i class="fa-solid fa-ellipsis-vertical"></i> Clear Caches</span>
  </a>
  </li>

  

    </ul>
  </div>
</div>