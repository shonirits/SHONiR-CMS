<?php 
if($Recently_Viewed_Products){
?>
   <!--Recently Viewed Start -->

   <div class="container-fluid wow swing slow" >
  <div class="container  ">
  <div class="row ">  
  <div class="col th-heading text-center">
  Recently Viewed Products
</div>
</div>
<div class="row ">   
        <div class="col">
        <div class="recently_viewed_products_carousel owl-carousel owl-theme">
<?php foreach ($Recently_Viewed_Products as $Recently_key => $Recently_value)
            {
                           
              ?>
  <div> 
  <div class="col">
  <div class="th-product-grid">
                <div class="product-image">
                    <a href="<?php echo $Recently_value['href'] ?>">
                        <img class="owl-lazy pic-1" data-src="<?php echo SHONiR_Write_Uploads_Fnc($Recently_value['image']) ?>" data-src-retina="<?php echo SHONiR_Write_Uploads_Fnc($Recently_value['image']) ?>">
                        <?php if(isset($Recently_value['image2'])){?>
                        <img class="pic-2" src="<?php echo SHONiR_Write_Uploads_Fnc($Recently_value['image2']) ?>" >
                        <?php }?>
                    </a>
                    <ul class="social">
                    <li><a href="<?php echo $Recently_value['href'] ?>" data-tip="View Details"><i class="fas fa-info"></i></a></li>
                        <li><a data-tip="Quick View" data-fancybox data-type="ajax" data-src="<?php echo $Recently_value['qhref']; ?>" href="javascript:;"><i class="fa fa-search"></i></a></li>
                        <li><a href="javascript:SHONiR_AddtoCart_Fnc(<?php echo $Recently_value['product_id']?>);" data-tip="Add to Inquiry Basket"><i class="fa fa-shopping-cart"></i></a></li>
                    </ul>
                  
                    <!--span class="product-new-label">Sale</span>
                    <span class="product-discount-label">20%</span-->
                </div>
                <!--ul class="rating">
                    <li class="fa fa-star"></li>
                    <li class="fa fa-star"></li>
                    <li class="fa fa-star"></li>
                    <li class="fa fa-star"></li>
                    <li class="fa fa-star disable"></li>
                </ul-->
                <div class="product-content">
                    <h3 class="title"><a href="<?php echo $Recently_value['href']; ?>"><?php echo $Recently_value['name']?></a></h3>
                    <!--div class="price">$16.00
                        <span>$20.00</span>
                    </div-->
                    <div class="model"><?php echo SHONiR_Write_Price_Fnc($Recently_value['selling_price'], SHONiR_CURRENCY['currency_id']); ?></div>
                    <a href="javascript:SHONiR_AddtoCart_Fnc(<?php echo $Recently_value['product_id']?>);" class="add-to-cart" href="">+ Add To Inquiry Basket</a>
                </div>
            </div>
            
   
            </div>
</div>
            <?php }?>

</div>
      </div>    
      
  </div>
</div>
</div>

   <!-- Recently Viewed Products End -->
   <?php } ?>




<!-- Footer start -->

<div class="container-fluid th-footer wow lightSpeedIn slow" id="s-contact">
<div class="container  ">
<div class="row ">  

<div class="col-md-3 col-xs-12 th-xs-space">
<div class="heading">Quick Links</div>
<div class="th-footer_menu">
  <ul>
    <li><a href="<?php echo SHONiR_BASE ?>" class="nav-link">Homepage</a></li>
    <li><a href="<?php echo SHONiR_BASE.'Products'?>" class="nav-link">Products</a></li>
    <li><a href="<?php echo SHONiR_BASE.''?>" class="nav-link">Brands</a></li>
    <li><a href="<?php echo SHONiR_BASE.''?>" class="nav-link">Track Order</a></li>
    <li><a href="<?php echo SHONiR_BASE.''?>" class="nav-link">Custom Order</a></li>
    <li><a href="<?php echo SHONiR_BASE.''?>" class="nav-link">My Account</a></li>
    <li><a href="<?php echo SHONiR_BASE.''?>" class="nav-link">Return Form</a></li>    
  </u>
</div>
</div>  

<div class="col-md-3 col-xs-12 th-xs-space">
<div class="heading">Information</div>
<div class="th-footer_menu">
  <ul>
  <?php echo SHONiR_Pages_Menu_Fnc($Pages_Tree, 0);?>
  <li><a href="<?php echo SHONiR_BASE.'Contact'?>" class="nav-link">Contact Us</a></li>
  </u>
</div>
</div> 


<div class="col-md-3 col-xs-12 th-xs-space">
<div class="heading">Newsletter</div>
<div class="form">
  <p>Subscribe to the BabyMall.PK mailing list to receive updates on new arrivals, special offers and other discount information.</p>
<form name="SHONiR_Subscribe_Frm" id="SHONiR_Subscribe_Frm">
<div class="input-group" style="padding: 3px 0;">
<input type="email" class="form-control text_field" name="email" id="email" placeholder="Type your email address..." />
<div class="input-group-append">
<button class="btn btn-secondary" type="button" onclick="SHONiR_Subscribe_Fnc();"><i class="fa fa-paper-plane" aria-hidden="true"></i></button>
</div>
</div>
</form>
</div>
<div class="social-icon">
<ul>
<li><a href="<?php echo SHONiR_SETTINGS['social_facebook']?>"><i class="fab fa-facebook-f"></i></a></li>
<li><a href="<?php echo SHONiR_SETTINGS['social_twitter']?>"><i class="fab fa-twitter"></i></a></li>
<li><a href="<?php echo SHONiR_SETTINGS['social_instagram']?>"><i class="fab fa-instagram"></i></a></li>
<li><a href="<?php echo SHONiR_SETTINGS['social_linkedin']?>"><i class="fab fa-linkedin-in"></i></a></li>
<li><a href="<?php echo SHONiR_SETTINGS['social_youtube']?>"><i class="fab fa-whatsapp"></i></a></li>
</ul>


</div>
</div>  


<div class="col-md-3 col-xs-12 th-xs-space">
<div class="heading">Contact Us</div>
<div class="brand-name"><?php echo SHONiR_SETTINGS['website_company']?></div>

<div class="addres">
<span class="icone"><i class="fas fa-map-marker-alt"></i></span>
<div class="contact">
<?php echo SHONiR_SETTINGS['website_address']?>
</div>
</div>
<div class="addres">
<span class="icone"><i class="fas fa-phone-alt"></i></span>
<div class="contact">
<?php echo SHONiR_SETTINGS['website_telephone']?>
</div>
</div>
<div class="addres">
<span class="icone"><i class="fas fa-envelope"></i></span>
<div class="contact">
<a href="mailto:<?php echo SHONiR_SETTINGS['website_email']?>"><?php echo SHONiR_SETTINGS['website_email']?></a>
</div>
</div>
<div class="addres">
<span class="icone"><i class="fas fa-globe-americas"></i></span>
<div class="contact">
<a href="<?php echo SHONiR_HTTP.'://'.SHONiR_SETTINGS['website_url']?>"><?php echo SHONiR_SETTINGS['website_url']?></a>
</div>
</div>

    
</div>
</div>
</div>

<!-- Footer End -->


<!-- Bottom Start -->
<div class="container th-bottom_space">
<div class="row content wow jackInTheBox slow">  
<div class="col-md-6 col-xs-12 copyrightleft th-xs-space">
Copyrights  &copy; <?php echo SHONiR_SETTINGS['config_copyrights']?> <a href="<?php echo SHONiR_HTTP.'://'.SHONiR_SETTINGS['website_url']?>" ><?php echo SHONiR_SETTINGS['website_company']?></a>. All rights reserved.
</div>   
<div class="col-md-6 col-xs-12 copyrightright th-xs-space">
<a title="This website search engine optimization by ExTech Corporation"  href="https://www.ex.com.pk/web-promotion.html" target="_blank">Website Optimization</a>
&amp; <a title="This website maintained by ExTech Corporation"  href="https://www.ex.com.pk/web-development.html" target="_blank">Maintained</a>
by <a title="This website designed and developed by ExTech Corporation"  href="https://www.ex.com.pk/website-packages.html" target="_blank">ExTech Corporation</a>
</div> 

</div>
</div>

</div>

<!-- Bottom End -->
