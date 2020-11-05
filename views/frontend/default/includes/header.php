 
  
<header>
  <div class="container t-header">
<div class="row top">
<div class="col-md-6 col-12">
  <div id="google_translate_element"></div>
</div>
<div class="col-md-6 col-12 cart">
  <i class="fa fa-shopping-basket" aria-hidden="true"></i>
  <a href="<?php echo SHONiR_BASE.'Cart'?>">ENQUIRY BASKET: <span class="items"> <span id="SHONiR_cart_items"></span> </span><b>item(s)</b></a>
</div>
</div>
<div class="row center">
<div class="col-md-12 col-12 logo">
<a href="<?php echo SHONiR_HTTP.'://'.SHONiR_SETTINGS['website_url']?>"><img src="<?php echo SHONiR_CDN_IMG.'media/uploads/'.SHONiR_SETTINGS['config_logo'];?>" class="img-fluid" alt="<?php echo SHONiR_SETTINGS['website_company']?>" /></a>
</div>
</div>
<div class="row bottom">
<div class="col-md-6 menu">
  <a href="<?php echo SHONiR_BASE.'Products'?>" >PRODUCT CATEGORIES <i class="fa fa-bars" aria-hidden="true"></i>
  </a>
</div>
<div id="myNav" class="t-overlay">
  <a href="javascript:void(0)" class="closebtn" onclick="closeNav()">&times;</a>
  <div class="t-overlay-content">
    <div class="th-menu" id='cssmenu'>
    <?php echo SHONiR_Categories_Menu_Fnc($Categories_Tree, 0);?>
    </div>
  </div>
</div>
<div class="col-md-6 search">
  <form name="SHONiR_Search_Frm" id="SHONiR_Search_Frm" action="<?php echo SHONiR_BASE.'Products/search'?>" method="GET" role="form">
    <input type="text" name="q" id="q" placeholder="Search Product...">
    <button type="submit" class="icon">
      <i class="fa fa-search" aria-hidden="true"></i>
    </button>
    </form>
</div>
</div>
  </div>
</header>