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

<div class="container-fluid th-product-detail wow fadeInUp slow" >
  <div class="container  ">
<div class="row">
            <div class="col-lg-5 mt-20">
                <div class="image-box">
                    <div class="product-main-image">
                        <a data-fancybox="SHONiR_Product_Gallery" href="<?php echo SHONiR_Write_Uploads_Fnc($SHONiR_Product_Details['image']) ?>"><img src="<?php echo SHONiR_Write_Uploads_Fnc($SHONiR_Product_Details['image']); ?>" class="main-image img-fluid"></a>
                    </div>
                    <small class="text-muted">* Click on image to zoom in</small>
                    <?php
if(count($SHONiR_Product_Uploads) > 1){
?>
                    <div class="product-thumbnails">

<?php
  foreach ($SHONiR_Product_Uploads as $upload_key => $upload_value)
            {
              if ($upload_key < 1) continue;

              $SHONiR_Source = (SHONiR_SETTINGS['config_auto_watermark']=="TRUE")? $upload_value['upload_id'] : $upload_value['upload_file'];

              ?>

                            <a data-fancybox="SHONiR_Product_Gallery" href="<?php echo SHONiR_Write_Uploads_Fnc($SHONiR_Source) ?>"> <img src="<?php echo SHONiR_Write_Uploads_Fnc($SHONiR_Source) ?>" class="thumbnail-image img-fluid"></a>

                        <?php }?>
                    </div>
                    <?php }?>
                </div>
            </div>
            <div class="col-lg-7 mt-20">
                <div class="product-data">
                    <h2 class="product-title"><?php echo $SHONiR_Product_Details['name']?></h2>
                    <p class="product-model"><img src="<?php echo SHONiR_BASE.'Code/bar/code128/'.$SHONiR_Product_Details['reference']?>" > </p>
                    <p class="product-model">Model: <?php echo $SHONiR_Product_Details['model']?> </p>
                    <p class="product-model">Price: <?php echo SHONiR_Write_Price_Fnc($SHONiR_Product_Details['selling_price'], SHONiR_CURRENCY['currency_id']); ?> </p>
                    <p><?php $SHONiR_Product_Description = $SHONiR_Product_Details['description'];
                    $string = strip_tags($SHONiR_Product_Description);
if (strlen($string) > 225) {

    $stringCut = substr($string, 0, 225);
    $endPoint = strrpos($stringCut, ' ');

    $string = $endPoint? substr($stringCut, 0, $endPoint) : substr($stringCut, 0);
    $string .= '... <a href="javascript:SHONiR_Scroll_Fnc(\'product_description\')">Read More</a>';
}
echo $string;
                    ?></p>
                    <div id="SHONiR_Product_<?php echo $SHONiR_Product_Details['product_id']; ?>_Area">
                    <hr>
                    <form name="SHONiR_Product_<?php echo $SHONiR_Product_Details['product_id']; ?>_Frm" id="SHONiR_Product_<?php echo $SHONiR_Product_Details['product_id']; ?>_Frm" method="POST" novalidate>

                        <table class="table table-bordered d-inline-block border-0">
                            <tbody>
                            <tr>
                                <td>
                                    <label>Select Quanity: </label>
                                </td>
                                <td>
                                    <input type="number" id="quantity" name="quantity" class="form-control form-control-sm" value="<?php echo $SHONiR_Product_Details['minimum']?>"  min="<?php echo $SHONiR_Product_Details['minimum']?>" max="<?php echo $SHONiR_Product_Details['stock']?>" required>
                                    <div class="invalid-feedback">
                                    There is a minimum <?php echo $SHONiR_Product_Details['minimum']?> & maximum <?php echo $SHONiR_Product_Details['stock']?> quantity limit for this product.                                        </div>
                                </td>
                            </tr>
                        </tbody></table>
                        <button class="btn btn-primary btn-lg" type="button" onclick="javascript:SHONiR_AddtoCart_Fnc('<?php echo $SHONiR_Product_Details['product_id'] ?>')"><i class="fa fa-shopping-cart"></i> Add to Cart</button>
                        <button class="btn btn-outline-primary btn-lg" type="button" onclick="javascript:SHONiR_Ajax_Popup_Fnc('<?php echo $SHONiR_Product_Details['qhref'] ?>');"><i class="fa fa-shopping-bag"></i> Quick Order</button>
                    </form>
                    <hr>
                    </div>
                    <?php
                    $SHONiR_Str_Tag = $SHONiR_Product_Details['tag'];
                    if($SHONiR_Str_Tag){ ?>
                    <h5>Product Tags:</h5>
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
        </div>
        <div class="row mt-80 tabs" id="product_description">
            <div class="col-lg-12">
                <ul class="nav nav-tabs" role="tablist">
                    <li class="nav-item">
                        <a class="nav-link active" href="#t1body1" aria-controls="t1body1" role="tab" data-toggle="tab">Description</a>
                    </li>

                </ul>

                <div class="tab-content tabs-content">
                    <div role="tabpanel" class="tab-pane fade show active" id="t1body1">
                    <?php echo $SHONiR_Product_Description;?>  </div>

                </div>
            </div>
        </div>
        </div>
        </div>


        <?php
if($Related_Products){
?>
   <!--Recently Viewed Start -->

   <div class="container-fluid wow swing slow" >
  <div class="container  ">
  <div class="row ">
  <div class="col th-heading text-center">
  Related Products
</div>
</div>
<div class="row ">
        <div class="col">
        <div class="related_products_carousel owl-carousel owl-theme">
<?php foreach ($Related_Products as $Related_key => $Related_value)
            {?>
  <div>
  <div class="col">
  <div class="th-product-grid">
                <div class="product-image">
                    <a href="<?php echo $Related_value['href'] ?>">
                        <img class="owl-lazy pic-1" data-src="<?php echo SHONiR_Write_Uploads_Fnc($Related_value['image']) ?>" data-src-retina="<?php echo SHONiR_Write_Uploads_Fnc($Related_value['image']) ?>">
                        <?php if(isset($Related_value['image2'])){?>
                        <img class="pic-2" src="<?php echo SHONiR_Write_Uploads_Fnc($Related_value['image2']) ?>" >
                        <?php }?>
                    </a>
                    <ul class="social">
                    <li><a href="<?php echo $Related_value['href'] ?>" data-tip="View Details"><i class="fas fa-info"></i></a></li>
                        <li><a data-tip="Quick View" data-fancybox data-type="ajax" data-src="<?php echo $Related_value['qhref'] ?>" href="javascript:;"><i class="fa fa-search"></i></a></li>
                        <li><a href="javascript:SHONiR_AddtoCart_Fnc(<?php echo $Related_value['product_id']?>);" data-tip="Add to Inquiry Basket"><i class="fa fa-shopping-cart"></i></a></li>
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
                    <h3 class="title"><a href="<?php echo $Related_value['href'] ?>"><?php echo $Related_value['name']?></a></h3>
                    <!--div class="price">$16.00
                        <span>$20.00</span>
                    </div-->
                    <div class="model"><?php echo SHONiR_Write_Price_Fnc($Related_value['selling_price'], SHONiR_CURRENCY['currency_id']); ?></div>
                    <a href="javascript:SHONiR_AddtoCart_Fnc(<?php echo $Related_value['product_id']?>);" class="add-to-cart" href="">+ Add To Inquiry Basket</a>
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

   <!-- Related Products End -->
   <?php } ?>

<?php include('includes/footer.php');?>
<?php require_once('common/end.php');?>
<script>

p("#SHONiR_Product_<?php echo $SHONiR_Product_Details['product_id'] ?>_Btn").click(function (event) {

var product_id = <?php echo $SHONiR_Product_Details['product_id'] ?>;

 var id = 'SHONiR_Product_' + product_id + '_';

 var form = document.getElementById(id + 'Frm');

 if (form.checkValidity() === false) {

event.preventDefault();
event.stopPropagation();

} else {

d('#'+ id + 'Area').LoadingOverlay("show", {
background  : "rgba(150, 150, 150, 0.5)"
});

}

form.classList.add('was-validated');


});

</script>
  </body>
</html><?php
require_once('common/clear.php');
?>
