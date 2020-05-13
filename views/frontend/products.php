<!doctype html>
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


  <div class="container-fluid wow bounceInRight  slow" id="s-services">
  <div class="container  ">

<div class="row ">  
  <div class="col th-heading text-center">
<?php echo $SHONiR_Main['heading']?>
</div>
</div>
</div>
</div>

  
  <!-- Catefories Start -->

<?php 
if($Sub_Categories){
?>

<div class="container-fluid wow bounceInLeft  slow" id="s-services">
  <div class="container  ">

  <div class="row  th-content">   

  <?php 
  $c = 0;
  foreach ($Sub_Categories as $Category_key => $Category_value)
            {
              $c++;  

              if ($c==4) {
                echo '</div> <div class="row ">';
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
                        <a href="<?php echo $Category_value['href'] ?>" class="info">View Products</a>
                    </div> 


</div>  
<?php }?>
        
  </div>

  </div>
</div>

<?php }?>

<!-- Catefories End -->

<!-- Products Start -->

<?php 
if($SHONiR_Main['SHONiR_Products']){
  $SHONiR_Records = $SHONiR_Main['SHONiR_Products'];
 $SHONiR_Rows = $SHONiR_Records['Rows'];
?>

<div class="container-fluid s-services wow bounceInRight  slow" id="s-services">
  <div class="container  ">
  <div class="row  th-content">   

  <?php 
  $c = 0;
  foreach ($SHONiR_Rows as $key => $val)
            {
              $c++;  

              if ($c==4) {
                echo '</div> <div class="row  s-content">';
                $c=1;
              }

              
              
              
              ?>
        <div class="col ">
        <div class="th-product-grid">
                <div class="product-image">
                    <a href="<?php echo $SHONiR_Rows[$key]['href'] ?>">
                        <img class="pic-1" src="<?php echo SHONiR_Write_Uploads_Fnc($SHONiR_Rows[$key]['image']) ?>" >
                        <?php if(isset($SHONiR_Rows[$key]['image2'])){?>
                        <img class="pic-2" src="<?php echo SHONiR_Write_Uploads_Fnc($SHONiR_Rows[$key]['image2']) ?>" >
                        <?php }?>
                    </a>
                    <ul class="social">
                    <li><a  data-tip="View Details" href="<?php echo $SHONiR_Rows[$key]['href'] ?>"><i class="fas fa-info"></i></a></li>
                        <li><a data-tip="Quick View" data-fancybox data-type="ajax" data-src="<?php echo $SHONiR_Rows[$key]['qhref'] ?>" href="javascript:;"><i class="fa fa-search"></i></a></li>
                        <li><a href="javascript:SHONiR_AddtoCart_Fnc(<?php echo $SHONiR_Rows[$key]['product_id']?>);" data-tip="Add to Inquiry Basket"><i class="fa fa-shopping-cart"></i></a></li>
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
                    <h3 class="title"><a href="<?php echo $SHONiR_Rows[$key]['href'] ?>"><?php echo $SHONiR_Rows[$key]['name']?></a></h3>
                    <!--div class="price">$16.00
                        <span>$20.00</span>
                    </div-->
                    <div class="model"><?php echo SHONiR_Write_Price_Fnc($SHONiR_Rows[$key]['selling_price'], SHONiR_CURRENCY['currency_id']); ?></div>
                    <a href="javascript:SHONiR_AddtoCart_Fnc(<?php echo $SHONiR_Rows[$key]['product_id']?>);" class="add-to-cart" href="">+ Add To Inquiry Basket</a>
                </div>
            </div>


       
</div>  
<?php }?>
        
  </div>

  <div class="clearfix"></div>
 <div class="row">
 <div class="col-sm-12 col-md-5">Showing <?php echo $SHONiR_Records['Start_Records']?> to <?php echo $SHONiR_Records['End_Records']?> of <?php echo $SHONiR_Records['Total_Records']?> entries</div>
 <div class="col-sm-12 col-md-7 ">
 <?php echo $SHONiR_Records['Pagination']?>
</div>
</div>

  </div>
</div>



<?php }else{
                 
                 if(!$Sub_Categories){
                  echo '<div class="alert alert-danger" role="alert">
                  Nothing Found! Your requested record not exist in database.
                </div>';
}
                  
                }
                ?>
 

<!-- Products End -->

<?php include('includes/footer.php');?>
    
    <?php require_once('common/end.php');?> 
     
 
  </body>
</html><?php
require_once('common/clear.php');
?>