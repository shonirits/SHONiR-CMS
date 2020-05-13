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
  
<?php if(isset($SHONiR_Main['name'])){ ?>
<!-- Page Content STart -->

<div class="container-fluid wow slideInRight slow" >
  <div class="container  ">
  <div class="row ">  
  <div class="col th-heading text-center">
  <?php echo $SHONiR_Main['name'] ?>
</div>
</div>

<div class="row th-cart">  
<div class="col">

<div class="row">  
<div class="col">
<?php //echo $SHONiR_Main['description'] ?>
</div>
</div>
<?php 

if(isset($SHONiR_Main['SHONiR_Cart']['Items']) && $SHONiR_Main['SHONiR_Cart']['Items'] > 0){
  $SHONiR_Cart = $SHONiR_Main['SHONiR_Cart'];
  $SHONiR_Cart_Products = $SHONiR_Cart['Products'];
  ?>

<form name="" id="SHONiR_Cart_Frm" method="POST" novalidate>
<input type="hidden" name="SHONiR_CSRF" id="SHONiR_CSRF" value="<?php echo $SHONiR_Main['SHONiR_CSRF'];?>">

<div class="container-fluid  wow bounceInLeft slow">
  <div class="container">


  <table class="table table-bordered">
  <thead class="table-dark">
    <tr>
      <th scope="col" class="text-center">Image</th>
      <th scope="col">Product Details</th>
      <th scope="col" class="text-center">Quantity</th>
      <th scope="col" class="text-center">Unit&nbsp;Price</th>
      <th scope="col" class="text-right">Total</th>
    </tr>
  </thead>                             
  <tbody>
  
<?php 

foreach ($SHONiR_Cart_Products as $key => $val){
    ?>


<tr class="col-md-1 text-center">
      <td><a href="<?php echo SHONiR_BASE.'Go/Pr/'.$SHONiR_Cart_Products[$key]['product_id']; ?>"><img src="<?php echo SHONiR_Write_Uploads_Fnc($SHONiR_Cart_Products[$key]['image']) ?>" alt="" title="" class="img-thumbnail" style=" min-width: 100px; max-width: 100px; min-height: 100px; max-height: 100px;"></a></td>

      <td class="col-md-4 text-left"><a href="<?php echo SHONiR_BASE.'Go/Pr/'.$SHONiR_Cart_Products[$key]['product_id']; ?>"><?php echo $SHONiR_Cart_Products[$key]['name']?></a><br>
 <?php echo 'Reference#: '.$SHONiR_Cart_Products[$key]['reference']?></td>

      <td class="col-md-3">
      <div class="input-group ">  
      <input type="number" class="form-control" id="quantity_<?php echo $SHONiR_Cart_Products[$key]['product_id']?>" name="quantity_<?php echo $SHONiR_Cart_Products[$key]['id']?>" min="<?php echo $SHONiR_Cart_Products[$key]['minimum']?>" max="<?php echo $SHONiR_Cart_Products[$key]['stock']?>" class="form-control form-control-sm" value="<?php echo $SHONiR_Cart_Products[$key]['quantity']?>" required>
                                        <div class="input-group-append">
                                          <a class="btn btn-danger" data-toggle="tooltip" data-placement="top" title="Remove" href="<?php echo SHONiR_BASE.'Cart/'.$SHONiR_Cart_Products[$key]['id'] ?>"><i class="fas fa-times-circle"></i></a>
</div>
<div class="invalid-feedback">  
                                    There is a minimum <?php echo $SHONiR_Cart_Products[$key]['minimum']?> & maximum <?php echo $SHONiR_Cart_Products[$key]['stock']?> quantity limit for this product.
                                        </div> 
</div></td>
      <td class="text-center col-md-2"><?php echo SHONiR_Write_Price_Fnc($SHONiR_Cart_Products[$key]['selling_price'], SHONiR_CURRENCY['currency_id']); ?></td>
      <td class="text-right col-md-2"><?php echo SHONiR_Write_Price_Fnc($SHONiR_Cart_Products[$key]['selling_price']*$SHONiR_Cart_Products[$key]['quantity'], SHONiR_CURRENCY['currency_id']); ?></td>
</tr> 

<?php } ?>
</tbody>
<thead class="thead-light">
    <tr>
      
      <th scope="col" colspan="2"></th>
      <th scope="col" class="text-center">Total Quantity: <?php echo $SHONiR_Cart['Quantity']; ?></th>
      <th scope="col" colspan="2" class="text-right">Sub Total: <?php echo SHONiR_Write_Price_Fnc($SHONiR_Cart['Sub'], SHONiR_CURRENCY['currency_id']); ?></th>
    </tr>
  </thead>
</table>
<div class="row cat_text">
<h3>What would you like to do next?</h3>
<span>Choose if you have a discount code or reward points you want to use or would like to estimate your delivery cost.</span>
</div>

<div class="accordion" id="accordionExample">
  <div class="card">
    <div class="card-header card-header_custom" id="headingOne">
      <h2 class="mb-0">
        <button class="btn btn-link black" type="button" data-toggle="collapse" data-target="#collapseOne" aria-expanded="true" aria-controls="collapseOne">
        Use Coupon Code <i class="fas fa-arrow-alt-circle-down"></i>
        </button>
      </h2>
    </div>

    <div id="collapseOne" class="collapse" aria-labelledby="headingOne" data-parent="#accordionExample">
      <div class="card-body">
      <label for="exampleInputEmail1">Enter your coupon here</label>
      <div class="input-group mb-3">
  <input type="text" class="form-control" placeholder="Enter your coupon here" aria-label="Recipient's username" aria-describedby="button-addon2">
  <div class="input-group-append">
    <button class="btn btn-secondary" type="button" id="button-addon2">Apply Coupon</button>
  </div>
</div>

      </div>
    </div>
  </div>
  <div class="card">
    <div class="card-header card-header_custom" id="headingTwo">
      <h2 class="mb-0">
        <button class="btn btn-link black collapsed" type="button" data-toggle="collapse" data-target="#collapseTwo" aria-expanded="false" aria-controls="collapseTwo">
        Estimate Shipping & Taxes <i class="fas fa-arrow-alt-circle-down"></i>
        </button>
      </h2>
    </div>
    <div id="collapseTwo" class="collapse" aria-labelledby="headingTwo" data-parent="#accordionExample">
      <div class="card-body">
     
<div class="form-group">
<label for="exampleInputEmail1">Country</label>
<select class="form-control" id="country">  
   </select>
</div>

<div class="form-group">
<label for="exampleInputEmail1">Region / State</label>
<select id="region" class="form-control">
    <option value="">Select country first</option>
</select>
</div>
<div class="form-group">
<label for="exampleInputEmail1">City</label>
<select id="city" class="form-control">
    <option value="">Select state first</option>
</select></div>
<button type="button" class="btn btn-secondary">Get Quotes</button>
      
      </div>
    </div>
  </div>
  <div class="card">
    <div class="card-header card-header_custom" id="headingThree">
      <h2 class="mb-0">
        <button class="btn btn-link black collapsed" type="button" data-toggle="collapse" data-target="#collapseThree" aria-expanded="false" aria-controls="collapseThree">
        Use Gift Voucher <i class="fas fa-arrow-alt-circle-down"></i>
        </button>
      </h2>
    </div>
    <div id="collapseThree" class="collapse" aria-labelledby="headingThree" data-parent="#accordionExample">
      <div class="card-body">
       
      <label for="exampleInputEmail1">Enter your gift voucher code here</label>
      <div class="input-group mb-3">
  <input type="text" class="form-control" placeholder="1234567890123456" aria-label="Recipient's username" aria-describedby="button-addon2">
  <div class="input-group-append">
    <button class="btn btn-secondary" type="button" id="button-addon2">Apply Gift Voucher</button>
  </div>
</div>

      </div>
    </div>
  </div>
</div>
<div class="row">&nbsp;</div>
<div class="row">
<div class="col-md-3 offset-md-9">
<table class="table table-bordered">
<tbody>
<tr>
<td>Shipping:</td>
<td><?php echo ($SHONiR_Cart['Shipping']>0)?SHONiR_Write_Price_Fnc($SHONiR_Cart['Shipping'], SHONiR_CURRENCY['currency_id']):'<b>FREE</b>';?></td>
</tr>
<tr>
<td>Tax:</td>
<td><?php echo ($SHONiR_Cart['Tax']>0)?SHONiR_Write_Price_Fnc($SHONiR_Cart['Tax'], SHONiR_CURRENCY['currency_id']):'<b>NONE</b>';?></td>
</tr>
<tr>
<td><b>Grand Total:</b></td>
<td><b><?php echo SHONiR_Write_Price_Fnc($SHONiR_Cart['Grand'], SHONiR_CURRENCY['currency_id']); ?></b></td>
</tr>
</tbody>
</table>
</div>
</div>
 

<div class="row">
<div class="col"><a class="btn btn-light " type="button" href="<?php echo SHONiR_BASE ?>"><i class="fas fa-reply-all"></i> Continue Shopping</a></div>

<div class="col text-center"><button class="btn btn-primary " type="submit"><i class="fas fa-sync-alt"></i> Update Cart</button>
</div>
<div class="col text-right"><a class="btn btn-success" type="button" href="<?php echo SHONiR_BASE.'Checkout' ?>"><i class="fas fa-shopping-cart"></i> Checkout</a></div> 

</div>




<div class="row">
  <div class="col"></div>
  
                               
  </div>


  <div class="row">
  
  <div class="col">
</div>
  <div class="col"></div>
                               
  </div>
  

  
</div>
</div>   
        
      </div> 
      
  </div></form>
  <?php }else{
                 
                  echo '<div class="alert alert-danger" role="alert">
                  Your shopping cart is empty!
                </div>';

                echo '<a class="btn btn-light " type="button" href="'.SHONiR_BASE.'"><i class="fas fa-reply-all"></i> Continue Shopping</a>';
}
                  
               
                ?>
                

</div>
</div>
   <!-- Page Content End -->
<?php }else{
  
    echo '<div class="alert alert-danger" role="alert">
    Nothing Found! Your requested record not exist in database.
  </div>';

}?>

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