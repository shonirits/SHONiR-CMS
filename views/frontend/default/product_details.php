<?php

$SHONiR_Product_Details = $SHONiR_Main['SHONiR_Product_Details'];
$SHONiR_Product_Uploads = $SHONiR_Product_Details['uploads'];

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

<?php include('includes/banners.php'); ?>
<div class="container t-product_details">
  <div class="row heading">
<div class="col-md-12 col-12">
<h1>PRODUCT DETAILS</h1>
<hr>
</div>
  </div>
  <form name="SHONiR_Product_<?php echo $SHONiR_Product_Details['product_id']; ?>_Frm" id="SHONiR_Product_<?php echo $SHONiR_Product_Details['product_id']; ?>_Frm" class="needs-validation" novalidate>
    <div class="row">
        <div class="col-md-5 col-12">
        <div id="SHONiR_Product_<?php echo $SHONiR_Product_Details['product_id'] ?>_Gal" data-autoplay="3000" data-loop="true" data-allowfullscreen="true"  data-click="false" data-swipe="true"  data-arrows="always"  data-nav="thumbs" data-thumbheight="48">
        <?php
  foreach ($SHONiR_Product_Uploads as $upload_key => $upload_value)
            {
              $SHONiR_Source = (SHONiR_SETTINGS['config_auto_watermark']=="TRUE")? $upload_value['upload_id'] : $upload_value['upload_file'];

              ?>
        <a href="<?php echo SHONiR_Write_Uploads_Fnc($SHONiR_Source) ?>"><img src="<?php echo SHONiR_Write_Uploads_Fnc($SHONiR_Source) ?>" ></a>
            <?php }?>            
       </div>
       <?php if($SHONiR_Product_Details['featured']){ ?>
      <span class="featured">New</span>
      <?php } ?>
        </div>
        <div class="col-md-7">
        <h2 class="name"><?php echo $SHONiR_Product_Details['name']?></h2>
        <h3 class="model">Article#: <?php echo $SHONiR_Product_Details['model']?></h3>
        <div class="description"><?php echo $SHONiR_Product_Details['description']?> </div>
        <div id="SHONiR_Product_<?php echo $SHONiR_Product_Details['product_id']; ?>_Area">
        <div class="row dform ml-2 pb-2">
        <div class="col-auto mt-2 "><input type="number" id="quantity" name="quantity" class="form-control input" value="<?php echo $SHONiR_Product_Details['minimum']?>"  min="<?php echo $SHONiR_Product_Details['minimum']?>" max="<?php echo $SHONiR_Product_Details['stock']?>" required>
                                    <div class="invalid-feedback">
                                    There is a minimum <?php echo $SHONiR_Product_Details['minimum']?> & maximum <?php echo $SHONiR_Product_Details['stock']?> quantity limit for this product.                                        </div></div>
            <div class="col-auto">
                <button class="hvr-bounce-to-top" type="button" onclick="javascript:SHONiR_AddtoCart_Fnc('<?php echo $SHONiR_Product_Details['product_id'] ?>')"  data-toggle="tooltip" data-placement="top" title="Add to Enquiry Basket"><i class="fa fa-shopping-basket" aria-hidden="true"></i> Add to Enquiry Basket</button>
            </div>
            <div class="col-auto"><button type="button" class="hvr-bounce-to-top"  onclick="javascript:SHONiR_Ajax_Popup_Fnc('<?php echo $SHONiR_Product_Details['ohref'] ?>');"  data-toggle="tooltip" data-placement="top" title="Send Quick Enquiry">
              <i class="fa fa-paper-plane" aria-hidden="true"></i> Send Quick Enquiry </button>
              
              </div>
              </div>
        </div>
        </div>
    </div>
    <div class="row details">
  <div class="col">
  <?php
                    $SHONiR_Str_Tag = $SHONiR_Product_Details['tag'];
                    if($SHONiR_Str_Tag){ ?>
                    <h4 class="heading">Product Tags:</h4>
                    <div class="product-tags">
                      <?php $SHONiR_Str_Array = explode(',',$SHONiR_Str_Tag);
foreach ($SHONiR_Str_Array as $values)
{
  $SHONiR_Str_value = trim($values,"\0 \t \n \x0B \r ");
?>
                        <a href="Products/search?q=<?php echo $SHONiR_Str_value;?>" class="badge badge-pill badge-light"><?php echo $SHONiR_Str_value;?></a>
                        <?php } ?>
                    </div>
                    <?php } ?>
  </div>
    </div>
</form>
<?php
if($Related_Products){
?>
<!-- carousel start -->
<div class=" t-carousel">
<div class="row pt-4">
  <div class="col-md-6 ">
   <h1>IN THE SAME CATEGORY</h1>
</div>
    <div class="col-md-6"> <div class="navigation">
      <a class="samep"><i class="fas fa-chevron-left" aria-hidden="true"></i></a>
      <a class="samen"><i class="fas fa-chevron-right" aria-hidden="true"></i></a>
  </div></div>
</div> 
<div class="owl-carousel owl-theme same_products">
<?php foreach ($Related_Products as $Related_key => $Related_value)
            {?>
  <div class="item">
    <div class="card t-pic">
    <a href="<?php echo $Related_value['href'] ?>">
    <img class="card-img-top img-fluid onex" src="<?php echo SHONiR_Write_Uploads_Fnc($Related_value['image']) ?>" alt="<?php echo $Related_value['name']?>">
<?php if(isset($Related_value['image1'])){?>
<img class="card-img-top img-fluid twox" src="<?php echo SHONiR_Write_Uploads_Fnc($Related_value['image1']) ?>" alt="<?php echo $Related_value['name']?>">
<?php } ?>    
    </a>
    <?php if($Related_value['featured']){ ?>
      <span>New</span>
    <?php } ?>
      <div class="icons">
<div class="col">
<a href="javascript:SHONiR_Ajax_Popup_Fnc('<?php echo $Related_value['vhref'] ?>');" data-toggle="tooltip" data-placement="right" title="Quick View" class="hvr-bounce-to-top">  <i class="fa fa-eye" aria-hidden="true"></i></a>
</div>
<div class="col">
 <a href="javascript:SHONiR_Ajax_Popup_Fnc('<?php echo $Related_value['ohref'] ?>');" data-toggle="tooltip" data-placement="right" title="Send Quick Enquiry" class="hvr-bounce-to-top"> <i class="fa fa-paper-plane" aria-hidden="true"></i></a>
</div>
      </div>
      <div class="card-body">
        <p class="card-text" data-toggle="tooltip" data-placement="top" title="<?php echo $Related_value['name']?>"><a href="<?php echo $Related_value['href'] ?>"><?php echo $Related_value['name']?></a></p>
        <h6 class="card-title">Artical#: <?php echo $Related_value['model']?></h6>
        <div class="row links">
          <a href="javascript:SHONiR_AddtoCart_Fnc(<?php echo $Related_value['product_id']?>);" data-toggle="tooltip" data-placement="top" title="Add to Enquiry Basket" class="hvr-bounce-to-top"> <i class="fa fa-shopping-basket" aria-hidden="true"></i> Add to Enquiry Basket</a>
          <a href="<?php echo $Related_value['href'] ?>" data-toggle="tooltip" data-placement="top" title="Product Details" class="hvr-bounce-to-top"><i class="fas fa-info"></i></a>
 
        </div>
      </div>
    </div>
  </div>
            <?php } ?>
  
  </div>  
  
</div>

<!-- carousel end -->
<?php
}
?>

<?php
if($Random_Products){
?>
<!-- carousel start -->
<div class=" t-carousel">
<div class="row pt-3">
  <div class="col-md-6 ">
   <h1>YOU MIGHT ALSO LIKE</h1>
</div>
    <div class="col-md-6"> <div class="navigation">
      <a class="likep"><i class="fas fa-chevron-left" aria-hidden="true"></i></a>
      <a class="liken"><i class="fas fa-chevron-right" aria-hidden="true"></i></a>
  </div></div>
</div> 
<div class="owl-carousel owl-theme like_products">
<?php foreach ($Random_Products as $Random_key => $Random_value)
            {?>
  <div class="item">
    <div class="card">
    <a href="<?php echo $Random_value['href'] ?>"><img class="card-img-top img-fluid onex" src="<?php echo SHONiR_Write_Uploads_Fnc($Random_value['image']) ?>" alt="<?php echo $Random_value['name']?>">
<?php if(isset($Random_value['image1'])){?>
<img class="card-img-top img-fluid twox" src="<?php echo SHONiR_Write_Uploads_Fnc($Random_value['image1']) ?>" alt="<?php echo $Random_value['name']?>">
<?php } ?></a>
    <?php if($Random_value['featured']){ ?>
      <span>New</span>
    <?php } ?>
      <div class="icons">
<div class="col">
<a href="javascript:SHONiR_Ajax_Popup_Fnc('<?php echo $Random_value['vhref'] ?>');" data-toggle="tooltip" data-placement="right" title="Quick View" class="hvr-bounce-to-top">  <i class="fa fa-eye" aria-hidden="true"></i></a>
</div>
<div class="col">
 <a href="javascript:SHONiR_Ajax_Popup_Fnc('<?php echo $Random_value['ohref'] ?>');" data-toggle="tooltip" data-placement="right" title="Send Quick Enquiry" class="hvr-bounce-to-top"> <i class="fa fa-paper-plane" aria-hidden="true"></i></a>
</div>
      </div>
      <div class="card-body">
        <p class="card-text" data-toggle="tooltip" data-placement="top" title="<?php echo $Random_value['name']?>"><a href="<?php echo $Random_value['href'] ?>"><?php echo $Random_value['name']?></a></p>
        <h6 class="card-title">Artical#: <?php echo $Random_value['model']?></h6>
        <div class="row links">
          <a href="javascript:SHONiR_AddtoCart_Fnc(<?php echo $Random_value['product_id']?>);" data-toggle="tooltip" data-placement="top" title="Add to Enquiry Basket" class="hvr-bounce-to-top"> <i class="fa fa-shopping-basket" aria-hidden="true"></i> Add to Enquiry Basket</a>
          <a href="<?php echo $Random_value['href'] ?>" data-toggle="tooltip" data-placement="top" title="Product Details" class="hvr-bounce-to-top"><i class="fas fa-info"></i></a>
 
        </div>
      </div>
    </div>
  </div>
            <?php } ?>
  
  </div>  
  
</div>

<!-- carousel end -->
<?php
}
?>

<?php
if($Recently_Viewed_Products){
?>
<!-- carousel start -->
<div class=" t-carousel">
<div class="row pt-3">
  <div class="col-md-6 ">
   <h1>TRENDING PRODUCTS</h1>
</div>
    <div class="col-md-6"> <div class="navigation">
      <a class="trendp"><i class="fas fa-chevron-left" aria-hidden="true"></i></a>
      <a class="trendn"><i class="fas fa-chevron-right" aria-hidden="true"></i></a>
  </div></div>
</div> 
<div class="owl-carousel owl-theme trend_products">
<?php foreach ($Recently_Viewed_Products as $Recently_Viewed_key => $Recently_Viewed_value)
            {?>
  <div class="item">
    <div class="card">
    <a href="<?php echo $Recently_Viewed_value['href'] ?>"><img class="card-img-top img-fluid onex" src="<?php echo SHONiR_Write_Uploads_Fnc($Recently_Viewed_value['image']) ?>" alt="<?php echo $Recently_Viewed_value['name']?>">
<?php if(isset($Recently_Viewed_value['image1'])){?>
<img class="card-img-top img-fluid twox" src="<?php echo SHONiR_Write_Uploads_Fnc($Recently_Viewed_value['image1']) ?>" alt="<?php echo $Recently_Viewed_value['name']?>">
<?php } ?></a>
    <?php if($Recently_Viewed_value['featured']){ ?>
      <span>New</span>
    <?php } ?>
      <div class="icons">
<div class="col">
<a href="javascript:SHONiR_Ajax_Popup_Fnc('<?php echo $Recently_Viewed_value['vhref'] ?>');" data-toggle="tooltip" data-placement="right" title="Quick View" class="hvr-bounce-to-top">  <i class="fa fa-eye" aria-hidden="true"></i></a>
</div>
<div class="col">
 <a href="javascript:SHONiR_Ajax_Popup_Fnc('<?php echo $Recently_Viewed_value['ohref'] ?>');" data-toggle="tooltip" data-placement="right" title="Send Quick Enquiry" class="hvr-bounce-to-top"> <i class="fa fa-paper-plane" aria-hidden="true"></i></a>
</div>
      </div>
      <div class="card-body">
        <p class="card-text" data-toggle="tooltip" data-placement="top" title="<?php echo $Recently_Viewed_value['name']?>"><a href="<?php echo $Recently_Viewed_value['href'] ?>"><?php echo $Recently_Viewed_value['name']?></a></p>
        <h6 class="card-title">Artical#: <?php echo $Recently_Viewed_value['model']?></h6>
        <div class="row links">
          <a href="javascript:SHONiR_AddtoCart_Fnc(<?php echo $Recently_Viewed_value['product_id']?>);" data-toggle="tooltip" data-placement="top" title="Add to Enquiry Basket" class="hvr-bounce-to-top"> <i class="fa fa-shopping-basket" aria-hidden="true"></i> Add to Enquiry Basket</a>
          <a href="<?php echo $Recently_Viewed_value['href'] ?>" data-toggle="tooltip" data-placement="top" title="Product Details" class="hvr-bounce-to-top"><i class="fas fa-info"></i></a>
 
        </div>
      </div>
    </div>
  </div>
            <?php } ?>
  
  </div>  
  
</div>

<!-- carousel end -->
<?php
}
?>


</div>
</div>
<?php include('includes/footer.php');?>
<?php require_once('common/end.php');?>
<script>
  p(function () {   
    p('#SHONiR_Product_<?php echo $SHONiR_Product_Details['product_id'] ?>_Gal').fotorama();
    d("#SHONiR_Product_<?php echo $SHONiR_Product_Details['product_id']; ?>_Frm").keypress(function(e) {
if (e.which == 13) {
  return false;
}
});
  });
</script>
  </body>
</html><?php
require_once('common/clear.php');
?>