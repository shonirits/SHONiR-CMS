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


  <!-- cart start -->
  <form name="SHONiR_Cart_Frm" id="SHONiR_Cart_Frm" method="POST" novalidate>
  <input type="hidden" name="SHONiR_CSRF" id="SHONiR_CSRF" value="<?php echo $SHONiR_Main['SHONiR_CSRF'];?>">
<div class="container t-cart">
<?php if(isset($SHONiR_Main['name'])){ ?>
<div class="row heading">
<div class="col-md-12 col-12">
<h1><?php echo $SHONiR_Main['name'] ?></h1>
<hr>
</div>
  </div>
<div class="row details">
  <div class="col-md-12">
    <p><?php echo $SHONiR_Main['description'] ?></p>
  </div>
</div>
<?php } ?>

<?php 

if(isset($SHONiR_Main['SHONiR_Cart']['Items']) && $SHONiR_Main['SHONiR_Cart']['Items'] > 0){
  $SHONiR_Cart = $SHONiR_Main['SHONiR_Cart'];
  $SHONiR_Cart_Products = $SHONiR_Cart['Products'];
  ?>
    <table class="table table-bordered">
      <thead>
          <tr>
              <td class="hidden-xs">Image</td>
              <td>Product Details</td>
              <td class="td-qty text-center">Quantity</td>
              <td class="text-center">Remove</td>
          </tr>
      </thead>
      <tbody>
      <?php 

foreach ($SHONiR_Cart_Products as $key => $val){
    ?>
          <tr>
              <td class="hidden-xs">
                  <a href="<?php echo SHONiR_BASE.'Go/Pr/'.$SHONiR_Cart_Products[$key]['product_id']; ?>">
                      <img class="img-fluid" src="<?php echo SHONiR_Write_Uploads_Fnc($SHONiR_Cart_Products[$key]['image']) ?>" alt="<?php echo $SHONiR_Cart_Products[$key]['name']?>" title="" width="47" height="47">
                  </a>
              </td>
              <td class="col-md-8"><a href="<?php echo SHONiR_BASE.'Go/Pr/'.$SHONiR_Cart_Products[$key]['product_id']; ?>"><?php echo $SHONiR_Cart_Products[$key]['name']?></a>
              <p>Article#: <?php echo $SHONiR_Cart_Products[$key]['model']?></p>
              </td>
              <td>
                <div class="input-group "><span class="input-group-btn" ><a class="btn btn-default -down" type="button" href="javascript:SHONiR_Decrement_Fnc('quantity_<?php echo $SHONiR_Cart_Products[$key]['product_id']?>')" value="Decrease Quantity" data-toggle="tooltip" data-placement="top" title="Decrease Quantity">-</a></span><span class="input-group-addon -prefix" style="display: none;"></span><input type="text" id="quantity_<?php echo $SHONiR_Cart_Products[$key]['product_id']?>" name="quantity_<?php echo $SHONiR_Cart_Products[$key]['id']?>" min="<?php echo $SHONiR_Cart_Products[$key]['minimum']?>" max="<?php echo $SHONiR_Cart_Products[$key]['stock']?>" value="<?php echo $SHONiR_Cart_Products[$key]['quantity']?>" class="input-qty form-control text-center" style="display: block;"><span class="input-group-addon -postfix" style="display: none;"></span><span class="input-group-btn"><a class="btn btn-default -up" type="button" href="javascript:SHONiR_Increment_Fnc('quantity_<?php echo $SHONiR_Cart_Products[$key]['product_id']?>')" value="Increase Quantity" data-toggle="tooltip" data-placement="top" title="Increase Quantity">+</a></span><div class="invalid-feedback">  
                                    There is a minimum <?php echo $SHONiR_Cart_Products[$key]['minimum']?> & maximum <?php echo $SHONiR_Cart_Products[$key]['stock']?> quantity limit for this product.
                                        </div></div>
            </td>
              <td class="text-center">
              <a class="remove" data-toggle="tooltip" data-placement="top" title="Remove" href="<?php echo SHONiR_BASE.'Cart/'.$SHONiR_Cart_Products[$key]['id'] ?>"  rel="2">
              <i class="fas fa-trash-alt" aria-hidden="true"></i>
                  </a>
              </td>
          </tr>
          <?php } ?>
        
       <tr>
        <td colspan="2" align="left">Total Quantity</td>
        <td class="total text-center" colspan="3"><b><?php echo $SHONiR_Cart['Quantity']; ?></b></td>
    </tr>
      </tbody>
  </table>
    
    <div class="row cart_options">
      <div class="col-md-4"><a type="button" href="<?php echo SHONiR_BASE.'Products' ?>" class="btn btn-info t-share"><i class="fa fa-share" aria-hidden="true"></i>
        Add More Items</a></div>
      <div class="col-md-4 text-center"><button type="submit" class="btn btn-primary"><i class="fas fa-retweet" aria-hidden="true"></i>
        Update Basket</button></div>
      <div class="col-md-4 text-right"><a type="button" href="<?php echo SHONiR_BASE.'Checkout' ?>" class="btn btn-success"><i class="fa fa-shopping-cart" aria-hidden="true"></i>
        Send Enquiry</a></div>

    </div>
    <div class="row mt-4">
      <div class="col">
      <div class="alert alert-warning">
      <strong>Note:</strong> All items in your Enquiry Basket would be lost if you close this window. 
      </div>
</div>
    </div>
  </div>
  
  <?php }else{
                 
                 echo '<div class="alert alert-danger" role="alert">
                 You have not selected any products to enquire about. Visit a product page and press the "Add to Enquiry" button to add a product to the basket.
               </div>';

               echo '<a class="btn btn-info t-share" type="button" href="'.SHONiR_BASE.'Products"><i class="fas fa-reply-all"></i> Our Products</a>';
}
                 
              
               ?>
</div></form>
<!-- cart end -->  
  
<?php include('includes/footer.php');?>
    
    <?php require_once('common/end.php');?> 
     
 <script>

(function() {
  'use strict';

  window.addEventListener('load', function() {
    var form = document.getElementById('SHONiR_Cart_Frm');
    form.addEventListener('submit', function(event) {
      if (form.checkValidity() === false) {
        event.preventDefault();
        event.stopPropagation();
      }
      form.classList.add('was-validated');
    }, false);
  }, false);
})();

  </script>
<script>
d(document).ready(function(){

  d('#country').html('<option value="">Please Wait...</option>'); 
            d.ajax({
                type:'POST',
                url: SHONiR_BASE+'Ajax/Countries',
                success:function(html){
                    d('#country').html(html);
                }
            });


    d('#country').on('change', function(){
        var countryID = d(this).val();
        if(countryID){
          d('#region').html('<option value="">Please Wait...</option>'); 
            d.ajax({
                type:'POST',
                url: SHONiR_BASE+'Ajax/Regions',
                data:'country_id='+countryID,
                success:function(html){
                    d('#region').html(html);
                    d('#city').html('<option value="">Select state first</option>'); 
                }
            }); 
        }else{
            d('#region').html('<option value="">Select country first</option>');
            d('#city').html('<option value="">Select state first</option>'); 
        }
    });
    
    d('#region').on('change', function(){
        var regionID = d(this).val();
        if(regionID){
          d('#city').html('<option value="">Please Wait...</option>'); 
            d.ajax({
                type:'POST',
                url: SHONiR_BASE+'Ajax/Cities',
                data:'region_id='+regionID,
                success:function(html){
                    d('#city').html(html);
                }
            }); 
        }else{
            d('#city').html('<option value="">Select state first</option>'); 
        }
    });
});
</script>
  </body>
</html><?php
require_once('common/clear.php');
?>