<?php $SHONiR_Cart = $SHONiR_Main['SHONiR_Cart']; 
$SHONiR_Cart_Products = $SHONiR_Cart['Products']; ?>
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

<form name="SHONiR_Checkout_Frm" id="SHONiR_Checkout_Frm" method="POST" novalidate>
<input type="hidden" name="SHONiR_CSRF" id="SHONiR_CSRF" value="<?php echo $SHONiR_Main['SHONiR_CSRF'];?>">

<div class="container-fluid wow slideInRight slow" >
  <div class="container  ">
  <div class="row ">  
  <div class="col th-heading text-center">
  <?php echo $SHONiR_Main['name'] ?>
</div>
</div>


<div class="container-fluid px-lg-0  wow bounceInLeft slow">
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
<?php foreach ($SHONiR_Cart_Products as $key => $val){
    ?>
  <div class="row" id="cart_product_<?php echo $SHONiR_Cart_Products[$key]['id']?>">
  <tr class="col-md-1 text-center">
  
  <td><a href="<?php echo SHONiR_BASE.'Go/Pr/'.$SHONiR_Cart_Products[$key]['product_id']; ?>"><img src="<?php echo SHONiR_Write_Uploads_Fnc($SHONiR_Cart_Products[$key]['image']) ?>" alt="" title="" class="img-thumbnail" style=" min-width: 100px; max-width: 100px; min-height: 100px; max-height: 100px;"></a> </td>

<td class="col-md-5 text-left"><a href="<?php echo SHONiR_BASE.'Go/Pr/'.$SHONiR_Cart_Products[$key]['product_id']; ?>"><?php echo $SHONiR_Cart_Products[$key]['name']?></a>
<p><?php echo 'Reference#: '.$SHONiR_Cart_Products[$key]['reference']?></p>
</td>

<td class="col-md-2"> <?php echo $SHONiR_Cart_Products[$key]['quantity']?> </td>
<td class="text-center col-md-2"><?php echo SHONiR_Write_Price_Fnc($SHONiR_Cart_Products[$key]['price'], SHONiR_CURRENCY['currency_id']); ?></td>

<td class="text-right col-md-2"><?php echo SHONiR_Write_Price_Fnc($SHONiR_Cart_Products[$key]['price']*$SHONiR_Cart_Products[$key]['quantity'], SHONiR_CURRENCY['currency_id']); ?></td>  
</tr>                            
  </div>
<?php } ?>
</tbody>
</table>

<div class="row">
  <div class="col"></div>
  <div class="col"></div>
  <div class="col">Items: <?php echo $SHONiR_Cart['Items']?></div>
  <div class="col">Sub Total: <?php echo SHONiR_Write_Price_Fnc($SHONiR_Cart['Sub'], SHONiR_CURRENCY['currency_id']); ?></div>                              
  </div>


                        




<div class="row">
<div class="col">

<div class="card card-space">
  <h5 class="card-header card-header-cart"><span><i class="fas fa-user"></i></span> Create an Account or Login</h5>
  <div class="card-body">
  <div class="form-check form-check-inline">
  <input class="form-check-input" type="radio" name="checkout_type" id="checkout_type0" value="0" required>
  <label class="form-check-label" for="checkout_type0">Guest Checkout</label>
   </div>
 <div class="form-check form-check-inline">
  <input class="form-check-input" type="radio" name="checkout_type" id="checkout_type2" value="2">
  <label class="form-check-label" for="checkout_type2">Login Customer</label>
 </div>
 <div class="form-check form-check-inline">
  <input class="form-check-input" type="radio" name="checkout_type" id="checkout_type1" value="1">
  <label class="form-check-label" for="checkout_type1">New Account</label>
 </div>
 <div class="invalid-feedback">Please select atleast one checkout type.</div>


<p><b>Guest Checkout -</b> Just place order without any account order hoistory.<br/>
<b>Login Customer -</b> Login into your existing account and quick checkout.<br/>
<b>New Account -</b> Register 100% Free account and keep all your order history save.</p>

 </div>
</div>

<div class="card card-space">
  <h5 class="card-header card-header-cart"><span><i class="fas fa-location-arrow"></i></span> Shipping Method</h5>
  <div class="card-body">
  <div class="form-check form-check">
  <input class="form-check-input" type="radio" id="shipping_method0" name="shipping_method" value="free" required>
  <label class="form-check-label" for="shipping_method0">Free Shipping - Rs00.00</label>
 </div>
 <div class="form-check form-check">
  <input class="form-check-input" type="radio" id="shipping_method1" name="shipping_method" value="standerd" >
  <label class="form-check-label" for="shipping_method1">Standered Shipping - Rs100.00</label>
 </div>
 <div class="form-check form-check">
  <input class="form-check-input" type="radio" id="shipping_method2" name="shipping_method" value="express" >
  <label class="form-check-label" for="shipping_method2">Express Shipping - Rs250.00</label>
 </div>

 <div class="invalid-feedback">Please select atleast one shipping method.</div>
 
 </div>
</div>

<div class="card card-space">
  <h5 class="card-header card-header-cart"><span><i class="far fa-credit-card"></i></span> Payment Method</h5>
  <div class="card-body">
  <div class="form-check form-check">
  <input class="form-check-input" type="radio" id="payment_method1" name="payment_method" value="cod" required>
  <label class="form-check-label" for="payment_method1">Cash On Delivery </label>
 </div>
 <div class="form-check form-check">
  <input class="form-check-input" type="radio" id="payment_method2" name="payment_method" value="cdc" >
  <label class="form-check-label" for="payment_method2">Credit/Dabit Card </label>
 </div>
 <div class="form-check form-check">
  <input class="form-check-input" type="radio" id="payment_method3" name="payment_method" value="wire" >
  <label class="form-check-label" for="payment_method3">EaisyPaisa/Bank Transfer/ Westren Union </label>
 </div>

 <div class="form-check form-check">
  <input class="form-check-input" type="radio" id="payment_method4" name="payment_method" value="skrill" >
  <label class="form-check-label" for="payment_method4">Skrill </label>
 </div>

 <div class="form-check form-check">
  <input class="form-check-input" type="radio" id="payment_method5" name="payment_method" value="paypal" >
  <label class="form-check-label" for="payment_method5">PayPal </label>
 </div>
 <div class="invalid-feedback">Please select atleast one payment method.</div>
 </div>
</div>

<div class="card card-space">
  <h5 class="card-header card-header-cart"><span><i class="fas fa-gift"></i></span> Additional Packing</h5>
  <div class="card-body">
  <div class="form-check form-check">
  <input class="form-check-input" type="checkbox" id="gift_cover" name="gift_cover" value="1" >
  <label class="form-check-label" for="gift_cover">Gift Cover - Rs.250.00 </label>
 </div>
 <div class="form-check form-check">
  <input class="form-check-input" type="checkbox" id="tag_card" name="tag_card" value="1" >
  <label class="form-check-label" for="tag_card">Tag Card - Rs.250.00 </label>
 </div>
 <div class="form-row" style="margin-top: 15px;">  
  <textarea class="form-control" id="tag_card_text" rows="3" required>Text on Tag Card</textarea>
  <div class="invalid-feedback">Please select atleast 3 charecters.</div>
  </div>
 </div>
</div>


<div class="card card-space">
  <h5 class="card-header card-header-cart"><span><i class="fas fa-comment-dots"></i></span> Add Instruction About Your Order</h5>
  <div class="card-body" style="padding: 0rem !important;">
  
  <textarea class="form-control" id="exampleFormControlTextarea1" rows="3"></textarea>
 
 
 </div>
</div>





</div>

<div class="col">
<div id="checkout_type1_area" style="display:none">
<div class="card card-space">
  <h5 class="card-header card-header-cart"><span><i class="fas fa-user-plus"></i></span> Your Personal Details</h5>
  <div class="card-body">
  <form>
  <div class="form-row">
    <div class="col">
      <input type="text" class="form-control" id="first_name" name="payment_method5"  placeholder="First name *" required>
      <div class="invalid-feedback">Please type your first name.</div>
    </div>
    <div class="col">
      <input type="text" class="form-control" id="last_name" name="payment_method5" placeholder="Last name *" required>
      <div class="invalid-feedback">Please type your last name.</div>
    </div>
  </div>
  <div class="form-row" style="margin-top: 15px;">
    <div class="col">
      <input type="email" class="form-control" id="email" name="payment_method5" placeholder="E-Mail *" required>
      <div class="invalid-feedback">Please type your email address.</div>
    </div>
  </div>
  <div class="form-row" style="margin-top: 15px;">
    <div class="col">
      <input type="text" class="form-control" id="telephone" name="telephone" placeholder="Mobile *" required>
      <div class="invalid-feedback">Please type your mobile number.</div>
    </div>
  </div>  

  </div>
</div>

<div class="card card-space">
  <h5 class="card-header card-header-cart"><span><i class="fas fa-lock"></i></span>Your Password</h5>
  <div class="card-body">
  
  <div class="form-row" style="margin-top: 15px;">
    <div class="col">
      <input type="password" class="form-control" id="password" name="password" placeholder="Password *" required>
      <div class="invalid-feedback">Please type your desire password between 6-16 charecter.</div>
    </div>
  </div>
  <div class="form-row" style="margin-top: 15px;">
    <div class="col">
      <input type="password" class="form-control"  id="cpassword" name="cpassword" placeholder="Confirm Password *" required>
      <div class="invalid-feedback">Please confirm your password.</div>
    </div>
  </div>

  </div>
</div>
</div>
<div class="card card-space">
  <h5 class="card-header card-header-cart"><span><i class="fas fa-map-marker-alt"></i></span>Shipping Address</h5>
  <div class="card-body">
  
  <div class="form-row" style="margin-top: 15px;">
    <div class="col">
      <input type="text" class="form-control" name="ship_name" id="ship_name" placeholder="Name/Company *" required>
      <div class="invalid-feedback">Please type shipping name/company.</div>
    </div>
  </div>
  <div class="form-row" style="margin-top: 15px;">
    <div class="col">
      <input type="text" class="form-control" name="ship_address1" id="ship_address1" placeholder="Address 1 *" required>
      <div class="invalid-feedback">Please type shipping address.</div>
    </div>
  </div>
  <div class="form-row" style="margin-top: 15px;">
    <div class="col">
      <input type="text" class="form-control" name="ship_address2" id="ship_address2" placeholder="Address 2">
    </div>
  </div>
  <div class="form-row" style="margin-top: 15px;">
    <div class="col">
      <input type="text" class="form-control" name="ship_postcode" id="ship_postcode" placeholder="Post Code *" required>
      <div class="invalid-feedback">Please type shipping post/zip code.</div>
    </div>
  </div>
  <div class="form-row" style="margin-top: 15px;">
    <div class="col">
    <select class="form-control" name="ship_country_id" id="ship_country_id" disabled="disabled" required>  
   </select>
   <div class="invalid-feedback">Please select shipping country.</div>
    </div>
  </div>
  <div class="form-row" style="margin-top: 15px;">
    <div class="col">
    <select name="ship_region_id" id="ship_region_id" class="form-control" disabled="disabled" required>
    <option value="">Select country first</option>
</select>
<div class="invalid-feedback">Please select shipping state/region.</div>
    </div>
  </div>

  <div class="form-row" style="margin-top: 15px;">
    <div class="col">
    <select name="ship_city_id" id="ship_city_id" class="form-control" disabled="disabled" required>
    <option value="">Select state first</option>
</select>
<div class="invalid-feedback">Please select shipping city.</div>
    </div>
  </div>

  </div>
</div>


<div class="card card-space">
  <h5 class="card-header card-header-cart"><span><i class="fas fa-map-marker-alt"></i></span>Billing Address</h5>
  <div class="card-body">

  <div class="form-row" style="margin-top: 15px;">
  <div class="form-check form-check">
  <input class="form-check-input" type="checkbox" id="same_address" name="same_address" value="1" >
  <label class="form-check-label" for="same_address">Same as shipping</label>
    </div>
  </div>
  
  <div class="form-row" style="margin-top: 15px;">
    <div class="col">
      <input type="text" class="form-control" name="bill_name" id="bill_name" placeholder="Name/Company *" required>
      <div class="invalid-feedback">Please type billing name/company.</div>
    </div>
  </div>
  <div class="form-row" style="margin-top: 15px;">
    <div class="col">
      <input type="text" class="form-control" name="bill_address1" id="bill_address1" placeholder="Address 1 *" required>
      <div class="invalid-feedback">Please type billing address.</div>
    </div>
  </div>
  <div class="form-row" style="margin-top: 15px;">
    <div class="col">
      <input type="text" class="form-control" name="bill_address2" id="bill_address2" placeholder="Address 2">
    </div>
  </div>
  <div class="form-row" style="margin-top: 15px;">
    <div class="col">
      <input type="text" class="form-control" name="bill_postcode" id="bill_postcode" placeholder="Post Code *" required>
      <div class="invalid-feedback">Please type billing post/zip code.</div>
    </div>
  </div>
  <div class="form-row" style="margin-top: 15px;">
    <div class="col">
    <select class="form-control" name="bill_country_id" id="bill_country_id" disabled="disabled" required>  
   </select>
   <div class="invalid-feedback">Please select billing country.</div>
    </div>
  </div>
  <div class="form-row" style="margin-top: 15px;">
    <div class="col">
    <select name="bill_region_id" id="bill_region_id" class="form-control" disabled="disabled" required>
    <option value="">Select country first</option>
</select>
<div class="invalid-feedback">Please select billing state/region.</div>
    </div>
  </div>

  <div class="form-row" style="margin-top: 15px;">
    <div class="col">
    <select name="bill_city_id" id="bill_city_id" class="form-control" disabled="disabled" required>
    <option value="">Select state first</option>
</select>
<div class="invalid-feedback">Please select billing city.</div>
    </div>
  </div>

  </div>
</div>

<button type="submit" class="btn btn-light">CONFIRM ORDER</button>


</div>

</div>



</div>
</div>
</div>
</div>

</form>

   <!-- Page Content End -->
<?php }else{
  
    echo '<div class="alert alert-danger" role="alert">
    Nothing Found! Your requested record not exist in database.
  </div>';

}?>

<?php include('includes/footer.php');?>
    
    <?php require_once('common/end.php');?> 
     
 <script>
  (function () {  
            'use strict';  
            window.addEventListener('load', function () {  
                var form = document.getElementById('SHONiR_Checkout_Frm'); 
                form.addEventListener('submit', function (event) {  
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

  d('#checkout_type0').on('change', function(){

    d('#checkout_type0_area').fadeIn(1000);
    d('#checkout_type1_area').fadeOut(1000);
    d('#checkout_type2_area').fadeOut(1000);

  });

  d('#checkout_type1').on('change', function(){

d('#checkout_type1_area').fadeIn(1000);
d('#checkout_type0_area').fadeOut(1000);
d('#checkout_type2_area').fadeOut(1000);

});

d('#checkout_type2').on('change', function(){

d('#checkout_type2_area').fadeIn(1000);
d('#checkout_type1_area').fadeOut(1000);
d('#checkout_type0_area').fadeOut(1000);

});

  
  

 d('#ship_country_id').html('<option value="">Please Wait...</option>'); 
            d.ajax({
                type:'POST',
                url: SHONiR_BASE+'Ajax/Countries',
                success:function(html){
                   d('#ship_country_id').html(html);
                   d("#ship_country_id").attr("disabled", false);
                }
            });


    d('#ship_country_id').on('change', function(){
        var countryID = d(this).val();
        if(countryID){
          d('#ship_region_id').html('<option value="">Please Wait...</option>'); 
            d.ajax({
                type:'POST',
                url: SHONiR_BASE+'Ajax/Regions',
                data:'country_id='+countryID,
                success:function(html){
                    d('#ship_region_id').html(html);
                    d("#ship_region_id").attr("disabled", false);
                    d('#ship_city_id').html('<option value="">Select state first</option>'); 
                }
            }); 
        }else{
            d('#ship_region_id').html('<option value="">Select country first</option>');
            d('#ship_city_id').html('<option value="">Select state first</option>'); 
        }
    });
    
    d('#ship_region_id').on('change', function(){
        var regionID = d(this).val();
        if(regionID){
          d('#ship_city_id').html('<option value="">Please Wait...</option>'); 
            d.ajax({
                type:'POST',
                url: SHONiR_BASE+'Ajax/Cities',
                data:'region_id='+regionID,
                success:function(html){
                    d('#ship_city_id').html(html);
                    d("#ship_city_id").attr("disabled", false);
                }
            }); 
        }else{
            d('#ship_city_id').html('<option value="">Select state first</option>'); 
        }
    });


    d('#bill_country_id').html('<option value="">Please Wait...</option>'); 
            d.ajax({
                type:'POST',
                url: SHONiR_BASE+'Ajax/Countries',
                success:function(html){
                   d('#bill_country_id').html(html);
                   d("#bill_country_id").attr("disabled", false);
                }
            });


    d('#bill_country_id').on('change', function(){
        var countryID = d(this).val();
        if(countryID){
          d('#bill_region_id').html('<option value="">Please Wait...</option>'); 
            d.ajax({
                type:'POST',
                url: SHONiR_BASE+'Ajax/Regions',
                data:'country_id='+countryID,
                success:function(html){
                    d('#bill_region_id').html(html);
                    d("#bill_region_id").attr("disabled", false);
                    d('#bill_city_id').html('<option value="">Select state first</option>'); 
                }
            }); 
        }else{
            d('#bill_region_id').html('<option value="">Select country first</option>');
            d('#bill_city_id').html('<option value="">Select state first</option>'); 
        }
    });
    
    d('#bill_region_id').on('change', function(){
        var regionID = d(this).val();
        if(regionID){
          d('#bill_city_id').html('<option value="">Please Wait...</option>'); 
            d.ajax({
                type:'POST',
                url: SHONiR_BASE+'Ajax/Cities',
                data:'region_id='+regionID,
                success:function(html){
                    d('#bill_city_id').html(html);
                    d("#bill_city_id").attr("disabled", false);
                }
            }); 
        }else{
            d('#bill_city_id').html('<option value="">Select state first</option>'); 
        }
    });


});
</script>
  </body>
</html><?php
require_once('common/clear.php');
?>