 <!-- Top Bar Start -->
<div class="container-fluid th-top-bacgroung-color wow bounceInLeft slow" >
<div class="container " >
<div class="row" >

<div class="col-4 d-none d-sm-block">
<div class="th-search">
<form name="SHONiR_Search_Frm" id="SHONiR_Search_Frm" action="<?php echo SHONiR_BASE.'Products/search'?>" method="GET" role="form">
<div class="input-group ">
<input type="text" class="form-control text_field" name="q" id="q" placeholder="Search Product..." />
<button class="btn button" type="submit"><i class="fa fa-search" aria-hidden="true"></i></button>
</div>
</form>
</div>
</div>

<div class="col  offset-md-5 px-lg-0">
<!--<div id="google_translate_element"></div> <script> function googleTranslateElementInit() { new google.translate.TranslateElement({ pageLanguage: 'en', layout: google.translate.TranslateElement.InlineLayout.SIMPLE }, 'google_translate_element'); } </script> <script src="//translate.google.com/translate_a/element.js?cb=googleTranslateElementInit"></script>-->
<a class="btn btn-link" href="#" role="button">Track Order </a>
</div>

<div class="col px-lg-0">
<div class="dropdown">
<a class="btn btn-link dropdown-toggle" href="#" role="button" id="dropdownMenuLink" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">Account</a>
<div class="dropdown-menu" aria-labelledby="dropdownMenuLink">
<a class="dropdown-item" href="#">Action</a>
<a class="dropdown-item" href="#">Another action</a>
<a class="dropdown-item" href="#">Something else here</a>
</div>
</div>
</div>



  </div>
  </div>
  </div>
<!-- Top Bar End -->

 <!-- Header Start -->
 <div class="container-fluid th-header-background wow fadeInDown slow" >
  <div class="container">
  <div class="row" >


<div class="col ">
<a href="<?php echo SHONiR_HTTP.'://'.SHONiR_SETTINGS['website_url']?>"><img src="<?php echo SHONiR_CDN_IMG.'media/uploads/'.SHONiR_SETTINGS['config_logo'];?>" class="img-fluid" /></a>
</div>


<div class="col offset-3 px-lg-0 d-none d-sm-block">
<div class="th-world">
<div class="th-world-icone"></div>
<div class="th-world-text">
<h5>FREE 1-HOUR DELIVERY*</h5>
<p>Free delivery on all orders over Rs.1000. 
Rs.100 for orders below Rs.1000.</p>
</div>
</div>
</div>
<div class="col px-lg-0 d-none d-sm-block">
<div class="th-gift">
<div class="th-gift-icone"></div>
<div class="th-gift-text">
<h5>Gift Voucher</h5>
<p>For guaranteed gift satisfaction, treat your loved ones with the BabyMall.PK gift voucher.</p>
</div>
</div>
</div>


  </div>
  </div>
  </div>
 <!-- Header End -->

 <!-- Menu Start -->
<div class="container-fluid th-menu wow bounceInRight slow">
<div class="container " >
<div class="row" >
<div class="col" >
<nav class="navbar navbar-expand-lg navbar-light bg-faded">
<div class="container">
<button type="button" data-toggle="collapse" data-target="#navbarContent" aria-controls="navbars" aria-expanded="false" aria-label="Toggle navigation" class="navbar-toggler navbar-toggler-right">
<span class="navbar-toggler-icon"></span>
</button>

<div id="navbarContent" class="collapse navbar-collapse">
<ul class="navbar-nav mr-auto">
<li class="nav-item "><a href="<?php echo SHONiR_BASE ?>" class="nav-link"><i class="fas fa-home fa-lg"></i></a></li>
<?php echo SHONiR_Categories_Menu_Fnc($Categories_Tree, 0);?>
</ul>
</div>
</div>
<div class="col-4 th-basket pull-right d-none d-sm-block">
<ul>
<li><a href="https://wa.me/<?php echo '92'.SHONiR_Get_Number_Fnc(SHONiR_SETTINGS['website_telephone'])?>"><i class="fab fa-whatsapp"></i> <?php echo SHONiR_SETTINGS['website_telephone']?></a></li>
<li><a href="<?php echo SHONiR_BASE.'Cart'?>"><i class="fas fa-shopping-cart "></i> Items(<span id="SHONiR_cart_items"></span>)</a></li>
</ul>
</div>
</nav>



</div>
</div>
</div>
</div>

 <!-- Menu End -->
