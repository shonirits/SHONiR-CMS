<?php 

$SHONiR_Brand_Details = $SHONiR_Main['SHONiR_Brand_Details'];

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

<div class="container-fluid th-product-detail wow fadeInUp slow" >
  <div class="container  ">
<div class="row">
            <div class="col-lg-5 mt-20">
                <div class="image-box">
                    <div class="product-main-image">
                        <a data-fancybox="SHONiR_Product_Gallery" href="<?php echo 'media/uploads/'.$SHONiR_Brand_Details['image'] ?>"><img src="<?php echo 'media/uploads/'.$SHONiR_Brand_Details['image']; ?>" class="main-image img-fluid"></a>
                    </div>
                    <small class="text-muted">* Click on image to zoom in</small>
                    
                </div>
            </div>
            <div class="col-lg-7 mt-20">
                <div class="product-data">
                    <h2 class="product-title"><?php echo $SHONiR_Brand_Details['name']?></h2>
                    <hr>   
                    </div>
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
                    <?php echo $SHONiR_Brand_Details['description']?></div>                  
                    
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
                    <div class="model"><?php echo $Related_value['model']?></div> 
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

alert('not ok');

} else {

d('#'+ id + 'Area').LoadingOverlay("show", {
background  : "rgba(150, 150, 150, 0.5)"
});

alert('ok');


}

form.classList.add('was-validated');   

 
});

</script>
  </body>
</html><?php
require_once('common/clear.php');
?>