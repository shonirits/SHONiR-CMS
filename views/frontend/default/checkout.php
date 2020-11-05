<?php $SHONiR_Cart = $SHONiR_Main['SHONiR_Cart']; 
$SHONiR_Cart_Products = $SHONiR_Cart['Products']; 

                $SHONiR_ship_name = SHONiR_Post_Fnc('ship_name');
                $SHONiR_ship_company = SHONiR_Post_Fnc('ship_company');
                $SHONiR_ship_email = SHONiR_Post_Fnc('ship_email');
                $SHONiR_ship_cell = SHONiR_Post_Fnc('ship_cell');
                $SHONiR_ship_address1 = SHONiR_Post_Fnc('ship_address1');
                $SHONiR_ship_address2 = SHONiR_Post_Fnc('ship_address2');
                $SHONiR_ship_postcode = SHONiR_Post_Fnc('ship_postcode');
                $SHONiR_ship_country_id = SHONiR_Post_Fnc('ship_country_id');
                $SHONiR_ship_region_id = SHONiR_Post_Fnc('ship_region_id');
                $SHONiR_ship_city_id = SHONiR_Post_Fnc('ship_city_id');  
                
                $SHONiR_shipping_method = SHONiR_Post_Fnc('shipping_method');
                $SHONiR_payment_method = SHONiR_Post_Fnc('payment_method');
                $SHONiR_contract_term = SHONiR_Post_Fnc('contract_term');
                $SHONiR_freight_forwarding = SHONiR_Post_Fnc('freight_forwarding');

                $SHONiR_same_address = SHONiR_Post_Fnc('same_address');

                if($SHONiR_same_address == 1){

                  $SHONiR_same_address = TRUE;

                }else{

                if(SHONiR_Post_Fnc('SHONiR_CSRF')){

                  $SHONiR_same_address = FALSE;

                }else{

                  $SHONiR_same_address = TRUE;

                }

                }


                $SHONiR_bill_name = SHONiR_Post_Fnc('bill_name');
                $SHONiR_bill_company = SHONiR_Post_Fnc('bill_company');
                $SHONiR_bill_email = SHONiR_Post_Fnc('bill_email');
                $SHONiR_bill_cell = SHONiR_Post_Fnc('bill_cell');
                $SHONiR_bill_address1 = SHONiR_Post_Fnc('bill_address1');
                $SHONiR_bill_address2 = SHONiR_Post_Fnc('bill_address2');
                $SHONiR_bill_postcode = SHONiR_Post_Fnc('bill_postcode');
                $SHONiR_bill_country_id = SHONiR_Post_Fnc('bill_country_id');
                $SHONiR_bill_region_id = SHONiR_Post_Fnc('bill_region_id');
                $SHONiR_bill_city_id = SHONiR_Post_Fnc('bill_city_id');



                if(SHONiR_USER['user_type']===3){

                  if(!$SHONiR_ship_name){

                    $SHONiR_ship_name = SHONiR_USER['firstname'].' '.SHONiR_USER['lastname'];

                  }

                  if(!$SHONiR_ship_company){

                    $SHONiR_ship_company = SHONiR_USER['company'];

                  }

                  if(!$SHONiR_ship_email){

                    $SHONiR_ship_email = SHONiR_USER['email'];
                    
                  }


                  if(!$SHONiR_ship_cell){

                    $SHONiR_ship_cell = SHONiR_USER['cell'];
                    
                  }


                  if(!$SHONiR_bill_name){

                    $SHONiR_bill_name = SHONiR_USER['firstname'].' '.SHONiR_USER['lastname'];

                  }

                  if(!$SHONiR_bill_company){

                    $SHONiR_bill_company = SHONiR_USER['company'];

                  }

                  if(!$SHONiR_bill_email){

                    $SHONiR_bill_email = SHONiR_USER['email'];
                    
                  }


                  if(!$SHONiR_bill_cell){

                    $SHONiR_bill_cell = SHONiR_USER['cell'];
                    
                  }

                }


?>
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
  <form name="SHONiR_Checkout_Frm" id="SHONiR_Checkout_Frm" method="POST" novalidate>
  <input type="hidden" name="SHONiR_CSRF" id="SHONiR_CSRF" value="<?php echo $SHONiR_Main['SHONiR_CSRF'];?>">
<div class="container t-checkout">
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
              <td class="text-center">
              <?php echo $SHONiR_Cart_Products[$key]['quantity']?>
            </td>
          </tr>
          <?php } ?>
        
       <tr>
        <td colspan="2" align="left">Total Quantity</td>
        <td class="total text-center" colspan="2" ><b><?php echo $SHONiR_Cart['Quantity']; ?></b></td>
    </tr>
      </tbody>
  </table>
    

  <div class="row">
<div class="col">

<div class="card card-space">
  <h5 class="card-header card-header-cart"><span><i class="fas fa-map-marker-alt"></i></span> Shipping Address</h5>
  <div class="card-body">
  
  <div class="form-row" style="margin-top: 15px;">
    <div class="col">
      <input type="text" class="form-control" name="ship_name" id="ship_name" placeholder="Name *" value="<?php echo $SHONiR_ship_name ?>" required>
      <div class="invalid-feedback">Please type shipping name.</div>
    </div>
  </div>

  <div class="form-row" style="margin-top: 15px;">
    <div class="col">
      <input type="text" class="form-control" name="ship_company" id="ship_company" placeholder="Company Name *" value="<?php echo $SHONiR_ship_company ?>" required>
      <div class="invalid-feedback">Please type shipping company name.</div>
    </div>
  </div>

  <div class="form-row" style="margin-top: 15px;">
  <div class="col">
      <input type="email" class="form-control" name="ship_email" id="ship_email" placeholder="Email address *" value="<?php echo $SHONiR_ship_email ?>"  required>
      <div class="invalid-feedback">Please type shipping email address.</div>
    </div>
  </div>
  <div class="form-row" style="margin-top: 15px;">
  <div class="col">
      <input type="tel" class="form-control" name="ship_cell_short" id="ship_cell_short" placeholder="Mobile number *" value="<?php echo $SHONiR_ship_cell ?>"  required>         
                                        <span id="valid-msg1" class="hide valid-msg">✓ Valid</span>
                                            <span id="error-msg1" class="hide error-msg"></span> 
      <div class="invalid-feedback">Please type shipping mobile number.</div>
    </div>
  </div>
  <div class="form-row" style="margin-top: 15px;">
    <div class="col">
      <input type="text" class="form-control" name="ship_address1" id="ship_address1" placeholder="Address 1 *" value="<?php echo $SHONiR_ship_address1 ?>"  required>
      <div class="invalid-feedback">Please type shipping address.</div>
    </div>
  </div>
  <div class="form-row" style="margin-top: 15px;">
    <div class="col">
      <input type="text" class="form-control" name="ship_address2" id="ship_address2" placeholder="Address 2" value="<?php echo $SHONiR_ship_address2 ?>" >
    </div>
  </div>
  <div class="form-row" style="margin-top: 15px;">
    <div class="col">
      <input type="text" class="form-control" name="ship_postcode" id="ship_postcode" value="<?php echo  $SHONiR_ship_postcode ?>"  placeholder="Post Code *"  required>
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
    <select name="ship_region_id" id="ship_region_id" class="form-control" disabled="disabled">
    <option value="">Select country first</option>
</select>
    </div>
  </div>

  <div class="form-row" style="margin-top: 15px;">
    <div class="col">
    <select name="ship_city_id" id="ship_city_id" class="form-control" disabled="disabled">
    <option value="">Select state first</option>
</select>
    </div>
  </div>

  </div>
</div>


<div class="card card-space mt-3">
  <h5 class="card-header card-header-cart"><span><i class="fas fa-money-bill-alt"></i></span> Billing Address</h5>
  <div class="card-body">

  <div class="form-row" style="margin-top: 7px;">
  <div class="form-check form-check">
  <input class="form-check-input" type="checkbox" id="same_address" name="same_address" value="1" <?php echo ($SHONiR_same_address)?'checked="checked"':''; ?>>
  <label class="form-check-label" for="same_address">Same as shipping</label>
    </div>
  </div>
  <div id="same_address_area" <?php echo ($SHONiR_same_address)?'style="display:none"':''; ?>>
  <div class="form-row" style="margin-top: 22px;">
    <div class="col">
      <input type="text" class="form-control" name="bill_name" id="bill_name" placeholder="Name *" value="<?php echo $SHONiR_bill_name ?>"  required>
      <div class="invalid-feedback">Please type billing name.</div>
    </div>
  </div>
  <div class="form-row" style="margin-top: 15px;">
    <div class="col">
      <input type="text" class="form-control" name="bill_company" id="bill_company" placeholder="Company name *" value="<?php echo $SHONiR_bill_company ?>" required>
      <div class="invalid-feedback">Please type billing company name.</div>
    </div>
  </div>
  <div class="form-row" style="margin-top: 15px;">
  <div class="col">
      <input type="email" class="form-control" name="bill_email" id="bill_email" placeholder="Email address *" value="<?php echo $SHONiR_bill_email ?>"  required>
      <div class="invalid-feedback">Please type billing email address.</div>
    </div>
  </div>
  <div class="form-row" style="margin-top: 15px;">
  <div class="col">
      <input type="tel" class="form-control" name="bill_cell_short" id="bill_cell_short" placeholder="Mobile number *" value="<?php echo $SHONiR_bill_cell ?>"  required> 
      <span id="valid-msg2" class="hide valid-msg">✓ Valid</span>
                                            <span id="error-msg2" class="hide error-msg"></span> 
      <div class="invalid-feedback">Please type billing mobile number.</div>
    </div>
  </div>
  <div class="form-row" style="margin-top: 15px;">
    <div class="col">
      <input type="text" class="form-control" name="bill_address1" id="bill_address1" placeholder="Address 1 *" value="<?php echo $SHONiR_bill_address1 ?>"  required>
      <div class="invalid-feedback">Please type billing address.</div>
    </div>
  </div>
  <div class="form-row" style="margin-top: 15px;">
    <div class="col">
      <input type="text" class="form-control" name="bill_address2" id="bill_address2" placeholder="Address 2" value="<?php echo $SHONiR_bill_address2 ?>" >
    </div>
  </div>
  <div class="form-row" style="margin-top: 15px;">
    <div class="col">
      <input type="text" class="form-control" name="bill_postcode" id="bill_postcode" value="<?php echo $SHONiR_bill_postcode ?>"  placeholder="Post Code *" required>
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
    <select name="bill_region_id" id="bill_region_id" class="form-control" disabled="disabled">
    <option value="">Select country first</option>
</select>
    </div>
  </div>

  <div class="form-row" style="margin-top: 15px;">
    <div class="col">
    <select name="bill_city_id" id="bill_city_id" class="form-control" disabled="disabled">
    <option value="">Select state first</option>
</select>
    </div>
  </div>
</div>
  </div>
</div>

</div>

<div class="col">


<div class="card card-space">
  <h5 class="card-header card-header-cart"><span><i class="fas fa-location-arrow"></i></span> Contract Term </h5>
  <div class="card-body">  
  <div class="form-check ">
 <input type="radio" class="form-check-input" id="FOB" name="contract_term" value="FOB"  <?php echo ($SHONiR_contract_term=='FOB')?'checked="checked"':''; ?> required>
  <label class="form-check-label" for="FOB">FOB</label> 
  </div>
  <div class="form-check ">
  <input type="radio" class="form-check-input" id="FAS" name="contract_term" value="FAS" <?php echo ($SHONiR_contract_term=='FAS')?'checked="checked"':''; ?>>
  <label class="form-check-label" for="FAS">FAS</label>
  </div>
  <div class="form-check ">
  <input type="radio" class="form-check-input" id="CIF" name="contract_term" value="CIF" <?php echo ($SHONiR_contract_term=='CIF')?'checked="checked"':''; ?>>
  <label class="form-check-label" for="CIF">CIF</label>
  </div>
  <div class="form-check ">
  <input type="radio" class="form-check-input" id="C&F" name="contract_term" value="C&F" <?php echo ($SHONiR_contract_term=='C&F')?'checked="checked"':''; ?>>
  <label class="form-check-label" for="C&F">C&F</label>
  </div>
  <div class="form-check ">
  <input type="radio" class="form-check-input" id="Other" name="contract_term" value="Other" <?php echo ($SHONiR_contract_term=='Other')?'checked="checked"':''; ?>>
  <label class="form-check-label" for="Other">Other</label>
  <div class="invalid-feedback" style="margin-left: 1em">Please choose an option</div>
</div>
 </div>
 </div>

<div class="card card-space mt-3">
  <h5 class="card-header card-header-cart"><span><i class="far fa-credit-card"></i></span> Freight Forwarding</h5>
  <div class="card-body">
  <div class="form-check ">
  <input type="radio" class="form-check-input" id="by_air" name="freight_forwarding" value="By Air" <?php echo ($SHONiR_freight_forwarding=='By Air')?'checked="checked"':''; ?> required>
  <label class="form-check-label" for="by_air">By Air</label> 
  </div>
  <div class="form-check ">   
  <input type="radio" class="form-check-input" id="by_sea" name="freight_forwarding" value="By Sea" <?php echo ($SHONiR_freight_forwarding=='By Sea')?'checked="checked"':''; ?>>
  <label class="form-check-label" for="by_sea">By Sea</label>
  </div>
  <div class="form-check ">
  <input type="radio" class="form-check-input" id="by_road" name="freight_forwarding" value="By Road" <?php echo ($SHONiR_freight_forwarding=='By Road')?'checked="checked"':''; ?>>
  <label class="form-check-label" for="by_road">By Road</label>
  </div>
  <div class="form-check ">
  <input type="radio" class="form-check-input" id="Other" name="freight_forwarding" value="Other" <?php echo ($SHONiR_freight_forwarding=='Other')?'checked="checked"':''; ?>>
  <label class="form-check-label" for="Other">Other</label>
  <div class="invalid-feedback" style="margin-left: 1em">Please choose an option</div>
 </div>
 </div>
</div>


<div class="card card-space mt-3">
  <h5 class="card-header card-header-cart"><span><i class="fas fa-comment-dots"></i></span> Add Instruction About Your Enquiry</h5>
  <div class="card-body" style="padding: 0rem !important;">

  <textarea class="form-control" placeholder="Any Instruction About Your Enquiry" id="user_comments" name="user_comments" required rows="3"><?php echo SHONiR_H2T_Fnc(SHONiR_Post_Fnc('user_comments')); ?></textarea> <div class="invalid-feedback">  
                                            Please provide your instruction in reasonable details. 
                                        </div>
 
 </div>
</div>

<div class="form-group mt-3">
                                    <div class="input-group mb-2">
<div class="captcha">
                                        <div class="code"><img id="captcha_image" src="<?php echo SHONiR_BASE.'Captcha?'.time(); ?>" alt=""></div>
                                        <div class="text"><span>Type above code [Case-Sensitive]</span>
                                          <input type="text" id="captcha" name="captcha" value=""  placeholder="" class="form-control " autocomplete="off" required />
                                        <div class="invalid-feedback">  
                                            Please type captcha code. 
                                        </div></div>
                                        <div class="reload">
                                       <a href="javascript:SHONiR_Captcha_Fnc();"> <i id="captcha_icon" class="fas fa-sync-alt fa-3x" data-toggle="tooltip" data-placement="top" title="Get new code"></i></a>
                                        </div>
                                        </div>
</div>
</div>

<button type="submit" data-toggle="tooltip" data-placement="top" title="Send Enquiry" class="t-btn hvr-bounce-to-top mt-3" data-original-title="Send Enquiry"><i class="fa fa-paper-plane" aria-hidden="true"></i> Send Enquiry</button>

</div>

</div>
   </div>
  </div>
  
  <?php }
             ?>
</div></form>
<!-- cart end -->  

<?php include('includes/footer.php');?>
    
    <?php require_once('common/end.php');?> 
     
 <script>
   d(document).ready(function(){
var input1 = document.querySelector("#ship_cell_short");
var errorMsg1 = document.querySelector("#error-msg1");
 var validMsg1 = document.querySelector("#valid-msg1");
  var errorMap1 = ["Invalid number", "Invalid country code", "Too short", "Too long", "Invalid number"];
  var iti1 = window.intlTelInput(input1, {
    allowDropdown: true,
  autoHideDialCode: true,
  formatOnDisplay: true,
  autoPlaceholder: "aggressive",
  nationalMode: true,
  separateDialCode: true,
  hiddenInput: "ship_cell",
  initialCountry: "auto",
  geoIpLookup: function(callback) {
    p.get('https://ipinfo.io', function() {}, "jsonp").always(function(resp) {
      var countryCode = (resp && resp.country) ? resp.country : "";
      callback(countryCode);
    });
  },
  utilsScript:  SHONiR_BASE+"assets/intl-tel/16.0.15/build/js/utils.js?1585994360633"
});

/* iti.setCountry("pk"); */

var reset1 = function() {
  input1.classList.remove("error");
  errorMsg1.innerHTML = "";
  errorMsg1.classList.add("hide");
  validMsg1.classList.add("hide");
};

input1.addEventListener('blur', function() {
  reset1();
  if (input1.value.trim()) {
    if (iti1.isValidNumber()) {
      validMsg1.classList.remove("hide");
    } else {
      input1.classList.add("error");
      var errorCode1 = iti1.getValidationError();
      errorMsg1.innerHTML = errorMap1[errorCode1];
      errorMsg1.classList.remove("hide");
    }
  }
});

input1.addEventListener('change', reset1);
input1.addEventListener('keyup', reset1);


var input2 = document.querySelector("#bill_cell_short");
var errorMsg2 = document.querySelector("#error-msg2");
 var validMsg2 = document.querySelector("#valid-msg2");
  var errorMap2 = ["Invalid number", "Invalid country code", "Too short", "Too long", "Invalid number"];
  var iti2 = window.intlTelInput(input2, {
    allowDropdown: true,
  autoHideDialCode: true,
  formatOnDisplay: true,
  autoPlaceholder: "aggressive",
  nationalMode: true,
  separateDialCode: true,
  hiddenInput: "bill_cell",
  initialCountry: "auto",
  geoIpLookup: function(callback) {
    p.get('https://ipinfo.io', function() {}, "jsonp").always(function(resp) {
      var countryCode = (resp && resp.country) ? resp.country : "";
      callback(countryCode);
    });
  },
  utilsScript:  SHONiR_BASE+"assets/intl-tel/16.0.15/build/js/utils.js?1585994360633"
});

/* iti.setCountry("pk"); */

var reset2 = function() {
  input2.classList.remove("error");
  errorMsg2.innerHTML = "";
  errorMsg2.classList.add("hide");
  validMsg2.classList.add("hide");
};

input2.addEventListener('blur', function() {
  reset2();
  if (input2.value.trim()) {
    if (iti2.isValidNumber()) {
      validMsg2.classList.remove("hide");
    } else {
      input2.classList.add("error");
      var errorCode2 = iti2.getValidationError();
      errorMsg2.innerHTML = errorMap2[errorCode2];
      errorMsg2.classList.remove("hide");
    }
  }
});

input2.addEventListener('change', reset1);
input2.addEventListener('keyup', reset1);

});
  (function () {  
            'use strict';  
            window.addEventListener('load', function () {  
                var form = document.getElementById('SHONiR_Checkout_Frm'); 
                form.addEventListener('submit', function (event) {  
                    if (form.checkValidity() === false || iti1.isValidNumber() === false) {  
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
  
  

  d('#same_address').on('change', function(){

    if(d(this).is(':checked')){
      d("#same_address_area :input").attr("disabled", true);
      d('#same_address_area').fadeOut(1000);

    } else {
      d('#same_address_area').fadeIn(1000);
      d("#same_address_area :input").attr("disabled", false);
    }

     });

     d('#gift_cover').on('change', function(){

      if(d(this).is(':checked')){
      d('#tag_card_area').fadeOut(1000);
    } else {
      d('#tag_card_area').fadeIn(1000);
    }


    }); 

  d('#ship_country_id').html('<option value="">Please Wait...</option>'); 
            d.ajax({
                type:'POST',
                url: SHONiR_BASE+'Ajax/Countries',
                success:function(html){
                   d('#ship_country_id').html(html);
                   d("#ship_country_id").attr("disabled", false);
                   <?php if($SHONiR_ship_country_id){?>
                   d('#ship_country_id option[value="<?php echo $SHONiR_ship_country_id; ?>"]').attr("selected", "selected");
                   p("#ship_country_id").change();
                   <?php }?>
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
                    <?php if($SHONiR_ship_region_id){?>
                   d('#ship_region_id option[value="<?php echo $SHONiR_ship_region_id; ?>"]').attr("selected", "selected");
                   p("#ship_region_id").change();
                   <?php }?>
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
                    <?php if($SHONiR_ship_city_id){?>
                   d('#ship_city_id option[value="<?php echo $SHONiR_ship_city_id; ?>"]').attr("selected", "selected");
                   <?php }?>
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
                   <?php 
    if($SHONiR_same_address){
     echo 'd("#same_address_area :input").attr("disabled", true);'; 
    }
    
    ?>
    <?php if($SHONiR_bill_country_id){?>
                   d('#bill_country_id option[value="<?php echo $SHONiR_bill_country_id; ?>"]').attr("selected", "selected");
                   p("#bill_country_id").change();
                   <?php }?>
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
                    <?php if($SHONiR_bill_region_id){?>
                   d('#bill_region_id option[value="<?php echo $SHONiR_bill_region_id; ?>"]').attr("selected", "selected");
                   p("#bill_region_id").change();
                   <?php }?> 
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
                    <?php if($SHONiR_bill_city_id){?>
                   d('#bill_city_id option[value="<?php echo $SHONiR_bill_city_id; ?>"]').attr("selected", "selected");
                   <?php }?>
                }
            }); 
        }else{
            d('#bill_city_id').html('<option value="">Select state first</option>'); 
        }
    });


});
w(window).on('load', function () { 
    setTimeout(function() { 
 var ship_cell_short = p("#ship_cell_short").val().trim(); 
 var ship_cell_short_r = ship_cell_short.replace(/ /gi, "");
 p("#ship_cell_short").val(ship_cell_short_r);
 var bill_cell_short = p("#bill_cell_short").val().trim(); 
 var bill_cell_short_r = bill_cell_short.replace(/ /gi, "");
 p("#bill_cell_short").val(bill_cell_short_r);
}, 1500);
});
</script>
  </body>
</html><?php
require_once('common/clear.php');
?>