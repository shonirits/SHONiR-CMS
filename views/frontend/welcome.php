<?php 
//print_r($Categories_Tree);
?><!doctype html>
<html lang="en">
  <head>
  <?php require_once('common/head.php');?>
  <title><?php echo $SHONiR_Main['meta_title'] ?></title>
<meta name="description" content="<?php echo $SHONiR_Main['meta_description'] ?>">
<meta name="keywords" content="<?php echo $SHONiR_Main['meta_keyword'] ?>" />
  </head>
  <body><?php require_once('common/start.php');?>

  <?php include('includes/header.php');?>

  <?php include('includes/banners.php');?>

   <?php 
if($Trending_Products){
?>

   <!-- Trending Products Start -->

   <div class="container-fluid wow slideInLeft slow" >
  <div class="container  ">
  <div class="row ">  
  <div class="col th-heading text-center">
  Trending Products
</div>
</div>
<div class="row ">   
<div class="col">
<div  class="trending_carousel owl-carousel owl-theme">
<?php foreach ($Trending_Products as $Trending_key => $Trending_value){?>
  <div> 
  <div class="col">
  <div class="th-product-grid">
                <div class="product-image">
<a href="<?php echo $Trending_value['href']; ?>">
<img class="owl-lazy pic-1" data-src="<?php echo SHONiR_Write_Uploads_Fnc($Trending_value['image']) ?>" data-src-retina="<?php echo SHONiR_Write_Uploads_Fnc($Trending_value['image']) ?>">
<?php if(isset($Trending_value['image2'])){?>
<img class="pic-2" src="<?php echo SHONiR_Write_Uploads_Fnc($Trending_value['image2']) ?>" >
<?php }?>
</a>
<ul class="social">
<li><a href="<?php echo $Trending_value['href'] ?>" data-tip="View Details"><i class="fas fa-info"></i></a></li>
<li><a data-tip="Quick View" data-fancybox data-type="ajax" data-src="<?php echo $Trending_value['qhref'] ?>" href="javascript:;"><i class="fa fa-search"></i></a></li>
<li><a href="javascript:SHONiR_AddtoCart_Fnc(<?php echo $Trending_value['product_id']?>);" data-tip="Add to Inquiry Basket"><i class="fa fa-shopping-cart"></i></a></li>
</ul>
</div>
<div class="product-content">
<h3 class="title"><a href="<?php echo $Trending_value['href']; ?>"><?php echo $Trending_value['name']?></a></h3>
                  
<div class="model"><?php echo SHONiR_Write_Price_Fnc($Trending_value['selling_price'], SHONiR_CURRENCY['currency_id']); ?></div>
<a href="javascript:SHONiR_AddtoCart_Fnc(<?php echo $Trending_value['product_id']?>);" class="add-to-cart" href="">+ Add To Inquiry Basket</a>
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

   <!-- Trending Products End -->
   <?php } ?>

   <!-- Welcome End -->

<div class="container-fluid wow slideInRight slow th_welcome_bg" >
<div class="container  ">
<div class="row ">  
<div class="col">
<div class="th_welcome_heading">
<h3><?php echo $SHONiR_Main['name'] ?></h3>
</div>
</div>
</div>
<div class="row ">   
<div class="col th-content">
<?php echo $SHONiR_Main['description'] ?>
</div>    
      
</div>
</div>
</div>

   <!-- Welcome End -->


   <?php 
if($Featured_Products){
?>
   <!-- Featured Products Start -->

   <div class="container-fluid wow bounceInDown slow" >
  <div class="container  ">
  <div class="row ">  
  <div class="col th-heading text-center">
  Featured Products
</div>
</div>
<div class="row ">   
        <div class="col">
        <div class="featured_carousel owl-carousel owl-theme">
<?php foreach ($Featured_Products as $Featured_key => $Featured_value)
            {?>
   <div> 
  <div class="col">
  <div class="th-product-grid">
                <div class="product-image">
                    <a href="<?php echo $Featured_value['href'] ?>">
                        <img class="owl-lazy pic-1" data-src="<?php echo SHONiR_Write_Uploads_Fnc($Featured_value['image']) ?>" data-src-retina="<?php echo SHONiR_Write_Uploads_Fnc($Featured_value['image']) ?>">
                        <?php if(isset($Featured_value['image2'])){?>
                        <img class="pic-2" src="<?php echo SHONiR_Write_Uploads_Fnc($Featured_value['image2']) ?>" >
                        <?php }?>
                    </a>
                    <ul class="social">
                    <li><a href="<?php echo $Featured_value['href'] ?>" data-tip="View Details"><i class="fas fa-info"></i></a></li>
                        <li><a data-tip="Quick View" data-fancybox data-type="ajax" data-src="<?php echo $Featured_value['qhref'] ?>" href="javascript:;"><i class="fa fa-search"></i></a></li>
                        <li><a href="javascript:SHONiR_AddtoCart_Fnc(<?php echo $Featured_value['product_id']?>);" data-tip="Add to Inquiry Basket"><i class="fa fa-shopping-cart"></i></a></li>
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
                    <h3 class="title"><a href="<?php echo $Featured_value['href'] ?>"><?php echo $Featured_value['name']?></a></h3>
                    <!--div class="price">$16.00
                        <span>$20.00</span>
                    </div-->
                    <div class="model"><?php echo SHONiR_Write_Price_Fnc($Featured_value['selling_price'], SHONiR_CURRENCY['currency_id']); ?></div>
                    <a href="javascript:SHONiR_AddtoCart_Fnc(<?php echo $Featured_value['product_id']?>);" class="add-to-cart" href="">+ Add To Inquiry Basket</a>
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

   <!-- Featured Products End -->
   <?php } ?>


   <!-- Featured Categories Start -->

   <?php 
if($Featured_Categories){
?>

   <div class="container-fluid wow rollIn slow" >
  <div class="container  ">
  <div class="row ">  
  <div class="col th-heading text-center">
  Featured Categories
</div>
</div>
  <div class="row  th-content">   

  <?php 
  $c = 0;
  foreach ($Featured_Categories as $Category_key => $Category_value)
            {
              $c++;  

              if ($c==4) {
                echo '</div> <div class="row  th-content">';
                $c=1;
              }
              
              ?>
        <div class="col view view-eighth">
        <img src="<?php echo SHONiR_CDN_IMG.'media/uploads/'.$Category_value['image'];?>" class="img-fluid">
        <div class="mask">
                        <h2><?php echo $Category_value['name'] ?></h2>
                        <p><?php 
                    $string = strip_tags($Category_value['description']);
if (strlen($string) > 125) {

    $stringCut = substr($string, 0, 125);
    $endPoint = strrpos($stringCut, ' ');

    $string = $endPoint? substr($stringCut, 0, $endPoint) : substr($stringCut, 0);
    $string .= '... ';
}
echo $string;
                    ?></p>
                        <a href="<?php echo $Category_value['href'];?>" class="info">View Products</a>
                    </div>
</div>  
<?php }?>
        
  </div>

</div>
</div>

<?php }?>

   <!-- Featured Categories End -->




   

   <?php include('includes/footer.php');?>

    
    <?php require_once('common/end.php');?>
  
 
  
 
  </body>
</html><?php
require_once('common/clear.php'); ?>