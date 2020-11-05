<?php 
$SHONiR_Product_Details = $SHONiR_Main['SHONiR_Product_Details'];
$SHONiR_Product_Uploads = $SHONiR_Product_Details['uploads'];
?><div class="container t-product_quick_order">
<div class="row heading">
<div class="col-md-12 col-12">
<h1>Product Quick Enquiry</h1>
<hr>
</div>
</div>
<form name="SHONiR_Product_Quick_Order_<?php echo $SHONiR_Product_Details['product_id']; ?>_Frm" id="SHONiR_Product_Quick_Order_<?php echo $SHONiR_Product_Details['product_id']; ?>_Frm" class="needs-validation" novalidate>
<input type="hidden" name="SHONiR_CSRF" id="SHONiR_CSRF" value="<?php echo $SHONiR_Main['SHONiR_CSRF'];?>">
<!-- product view start-->
<div class="row product">

<div class="col-md-4 t-pic">
<a href="<?php echo $SHONiR_Product_Details['href']?>"><img class="img-fluid onex" src="<?php echo SHONiR_Write_Uploads_Fnc($SHONiR_Product_Details['image']) ?>" alt="<?php echo $SHONiR_Product_Details['name']?>">
<?php if(isset($SHONiR_Product_Details['image1'])){?>
<img class="img-fluid twox" src="<?php echo SHONiR_Write_Uploads_Fnc($SHONiR_Product_Details['image1']) ?>" alt="<?php echo $SHONiR_Product_Details['name']?>">
<?php } ?>
</a>
<?php if($SHONiR_Product_Details['featured']){ ?>
      <span class="featured">New</span>
      <?php } ?>
     
</div>
<div class="col-md-6">
<h2 class="name"><?php echo $SHONiR_Product_Details['name']?></h2>
  <h3 class="model">Artical#: <?php echo $SHONiR_Product_Details['model']?></h3>
  <div class="description"><?php echo $SHONiR_Product_Details['description']?></div>
<div class="row links">
<a href="javascript:SHONiR_AddtoCart_Fnc(<?php echo $SHONiR_Product_Details['product_id']; ?>);" data-toggle="tooltip" data-placement="top" title="Add to Enquiry Basket" class="hvr-bounce-to-top" data-original-title="Add to Enquiry Basket"> <i class="fa fa-shopping-basket" aria-hidden="true"></i> Add to Enquiry Basket </a>
          <a href="<?php echo $SHONiR_Product_Details['href']?>" data-toggle="tooltip" data-placement="top" title="Product Details" class="hvr-bounce-to-top" data-original-title="Product Details"> <i class="fas fa-info" aria-hidden="true"></i> 
        Product Details
        </a>
</div>
</div>
</div>
<!-- product view end-->
  <div class="row details ">
<div class="col mt-3">
<h2>Enquiry Form:</h2>
<div id="quick-order-form-<?php echo $SHONiR_Product_Details['product_id']; ?>-area" class="container">
<div class="row">
<div class="col">
  <div class="row form-group">
  <label for="quantity">Quantity:</label>
  <input type="number" id="quantity" name="quantity" class="form-control input" value="<?php echo $SHONiR_Product_Details['minimum']?>" min="<?php echo $SHONiR_Product_Details['minimum']?>" max="<?php echo $SHONiR_Product_Details['stock']?>" required>
                                    <div class="invalid-feedback">
                                    There is a minimum <?php echo $SHONiR_Product_Details['minimum']?> & maximum <?php echo $SHONiR_Product_Details['stock']?> quantity limit for this product.    
     </div>
     
     </div><div class="row form-group">
     <label for="ship_name">Your Name:</label>
    <input type="text" class="form-control input" id="ship_name" name="ship_name" placeholder="Your Name" required />  
                                        <div class="invalid-feedback">  
                                            Please provide your valid name. 
                                        </div>
    </div><div class="row form-group">
    <label for="ship_company">Company Name:</label>
    <input type="text" class="form-control input" id="ship_company" name="ship_company" placeholder="Company Name" required />  
                                        <div class="invalid-feedback">  
                                            Please provide your valid company name. 
                                        </div>
    </div><div class="row form-group">
    <label for="ship_email">Email Address:</label>
    <input type="email" class="form-control input" id="ship_email" name="ship_email" aria-describedby="ship_emailhelp" placeholder="Email Address" required><div class="invalid-feedback">  
                                            Please provide your valid email address. 
                                        </div>
    <small id="ship_emailhelp" class="form-text text-muted">We'll never share your email with anyone else.</small>
    </div><div class="row form-group">
    <label class="control-label label" for="telephone">Contact Number:</label>
    <div class="input-group">
    <input class="form-control input" type="tel" id="telephone_<?php echo $SHONiR_Product_Details['product_id']; ?>" name="telephone" value=""  placeholder="Mobile number" required ><div class="invalid-feedback">  
                                            Please provide your valid mobile number. 
                                        </div>  &nbsp;  <span id="valid-msg_<?php echo $SHONiR_Product_Details['product_id']; ?>" class="hide valid-msg">✓ Valid</span>
                                            <span id="error-msg_<?php echo $SHONiR_Product_Details['product_id']; ?>" class="hide error-msg"></span>
                                            </div>
</div>
                                            <div class="row form-group">
                                            <label for="country">Your Country:</label>
                                            <select class="form-control input selectpicker countrypicker" data-flag="true" id="country" name="ship_country" required></select><div class="invalid-feedback">  
                                            Please select your country. 
                                        </div>
    </div><div class="row form-group">
    <label for="region">Region/State:</label>
    <select class="form-control input selectpicker countrypicker" data-flag="true"  id="region" name="ship_region"><option value="">Select country first</option></select><div class="invalid-feedback">  
                                            Please select your region/state. 
                                        </div>
    </div><div class="row form-group">
    <label for="city">City:</label>
    <select class="form-control input selectpicker countrypicker" data-flag="true" id="city" name="ship_city"><option value="">Select state first</option></select><div class="invalid-feedback">  
                                            Please select your city. 
                                        </div>
    </div><div class="row form-group">
    <label for="ship_postcode">Post/Zip Code:</label>
    <input type="text" class="form-control input" id="ship_postcode" name="ship_postcode" placeholder="Post/Zip Code" required />  
                                        <div class="invalid-feedback">  
                                            Please provide your valid post/zip code. 
                                        </div>
    </div><div class="row form-group">
    <h3>Contract Term:</h3>
    <div class="form-check form-check-inline">
    <input type="radio" class="form-check-input" id="FOB" name="contract_term" value="FOB" required>
  <label class="form-check-label" for="FOB">FOB</label> 
  <input type="radio" class="form-check-input" id="FAS" name="contract_term" value="FAS">
  <label class="form-check-label" for="FAS">FAS</label>
  <input type="radio" class="form-check-input" id="CIF" name="contract_term" value="CIF">
  <label class="form-check-label" for="CIF">CIF</label>
  <input type="radio" class="form-check-input" id="C&F" name="contract_term" value="C&F">
  <label class="form-check-label" for="C&F">C&F</label>
  <input type="radio" class="form-check-input" id="Other" name="contract_term" value="Other">
  <label class="form-check-label" for="Other">Other</label>
  <div class="invalid-feedback" style="margin-left: 1em">Please choose an option</div>
  </div>
  </div>
  <div class="row form-group">
  <h3>Freight Forwarding:</h3>
  <div class="form-check form-check-inline">
  <input type="radio" class="form-check-input" id="by_air" name="freight_forwarding" value="By Air" required>
  <label class="form-check-label" for="by_air">By Air</label>
  <input type="radio" class="form-check-input" id="by_sea" name="freight_forwarding" value="By Sea">
  <label class="form-check-label" for="by_sea">By Sea</label>
  <input type="radio" class="form-check-input" id="by_road" name="freight_forwarding" value="By Road">
  <label class="form-check-label" for="by_road">By Road</label>
  <input type="radio" class="form-check-input" id="Other" name="freight_forwarding" value="Other">
  <label class="form-check-label" for="Other">Other</label>
  <div class="invalid-feedback" style="margin-left: 1em">Please choose an option</div>
  </div>
  </div>
  <div class="row form-group">
  <label for="ship_address1">Shipping Address:</label>
    <textarea class="form-control input" id="ship_address1" name="ship_address1" placeholder="Shipping Address" required></textarea>
                                        <div class="invalid-feedback">  
                                            Please provide your shipping address. 
                                        </div>
    </div><div class="row form-group">
    <label for="user_comments">Additional Instructions:</label>
    <textarea class="form-control input" placeholder="Any Instruction About Your Enquiry" id="user_comments" name="user_comments" required></textarea>
                                        <div class="invalid-feedback">  
                                            Please provide your instruction in reasonable details. 
                                        </div>
    </div>
    <!-- captcha -->
<div class="row mt-3">
  <div class="col">
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
    <!-- captcha -->
    <div class="row form-group">
    <button type="button" id="quick-order-form-<?php echo $SHONiR_Product_Details['product_id']; ?>-btn" data-toggle="tooltip" data-placement="top" title="Send Enquiry" class="hvr-bounce-to-top mt-3" data-original-title="Send Enquiry">
    <i class="fa fa-paper-plane" aria-hidden="true"></i> Send Enquiry
  </button>
  </div>
  </div>
<div>    
</div>  
</div>
  </div> 
  </div>
  </div> 
</form>

</div>

        <script>    
d(document).ready(function(){
var input = document.querySelector("#telephone_<?php echo $SHONiR_Product_Details['product_id']; ?>");
var errorMsg = document.querySelector("#error-msg_<?php echo $SHONiR_Product_Details['product_id']; ?>");
 var validMsg = document.querySelector("#valid-msg_<?php echo $SHONiR_Product_Details['product_id']; ?>");
  var errorMap = ["Invalid number", "Invalid country code", "Too short", "Too long", "Invalid number"];
  var iti = window.intlTelInput(input, {
    allowDropdown: true,
  autoHideDialCode: true,
  formatOnDisplay: true,
  autoPlaceholder: "aggressive",
  nationalMode: true,
  separateDialCode: true,
  hiddenInput: "mobile",
  initialCountry: "auto",
  geoIpLookup: function(callback) {
    p.get('https://ipinfo.io', function() {}, "jsonp").always(function(resp) {
      var countryCode = (resp && resp.country) ? resp.country : "";
      callback(countryCode);
    });
  },
  utilsScript:  SHONiR_BASE+"assets/intl-tel/16.0.15/build/js/utils.js?1585994360633"
});

var reset = function() {
  input.classList.remove("error");
  errorMsg.innerHTML = "";
  errorMsg.classList.add("hide");
  validMsg.classList.add("hide");
};

input.addEventListener('blur', function() {
  reset();
  if (input.value.trim()) {
    if (iti.isValidNumber()) {
      validMsg.classList.remove("hide");
    } else {
      input.classList.add("error");
      var errorCode = iti.getValidationError();
      errorMsg.innerHTML = errorMap[errorCode];
      errorMsg.classList.remove("hide");
    }
  }
});

input.addEventListener('change', reset);
input.addEventListener('keyup', reset);
});
(function () {  
            'use strict';  
            window.addEventListener('load', function () {  
                var form = document.getElementById('SHONiR_Product_Quick_Order_<?php echo $SHONiR_Product_Details['product_id']; ?>_Frm'); 
                form.addEventListener('submit', function (event) {  
                    if (form.checkValidity() === false || iti.isValidNumber() === false) {  
                        event.preventDefault();  
                        event.stopPropagation();  
                    }  
                    form.classList.add('was-validated');  
                }, false);
            }, false);  
        })(); 


        p("#quick-order-form-<?php echo $SHONiR_Product_Details['product_id']; ?>-btn").click(function (event) {                          
                        
                        var form = document.getElementById('SHONiR_Product_Quick_Order_<?php echo $SHONiR_Product_Details['product_id']; ?>_Frm');
                                       
                if (form.checkValidity() === false || iti.isValidNumber() === false) { 

                        event.preventDefault();  
                        event.stopPropagation();

                    } else {

                        d("#quick-order-form-<?php echo $SHONiR_Product_Details['product_id']; ?>-area").LoadingOverlay("show", {
                    background  : "rgba(150, 150, 150, 0.5)"
                    });
                    
                    data = p(form).serialize();
                    var ship_cell = iti.getNumber();  
                    request = d.ajax({
              url: "<?php echo $SHONiR_Product_Details['ohref'] ?>",
              type: "post",
             dataType:"json",
              data: 'SHONiR=SHONiR&ship_cell='+ship_cell+'&'+data,              
              cache: false
          });

          request.done(function (response, textStatus, jqXHR){ 
                       
            if(response['type']==='success'){

                d("#quick-order-form-<?php echo $SHONiR_Product_Details['product_id']; ?>-area").LoadingOverlay("hide");
                p( "#quick-order-form-<?php echo $SHONiR_Product_Details['product_id']; ?>-area" ).html('<div class="alert alert-success fade show" role="alert"> ' + response['message'] + ' </div>');

            }else{

                p("input[name='captcha']",form).val('');
                SHONiR_Captcha_Fnc();
               p("input[name='SHONiR_CSRF']",form).val(response['SHONiR_CSRF']);
               d("#quick-order-form-<?php echo $SHONiR_Product_Details['product_id']; ?>-area").LoadingOverlay("hide");
               p( "#quick-order-form-<?php echo $SHONiR_Product_Details['product_id']; ?>-area" ).prepend('<div class="alert alert-danger alert-dismissible fade show" role="alert"> ' + response['message'] + ' <button type="button" class="close" data-dismiss="alert" aria-label="Close">    <span aria-hidden="true">&times;</span> </button></div>');

            }
        });

            request.fail(function (jqXHR, textStatus, errorThrown){
                d("#quick-order-form-<?php echo $SHONiR_Product_Details['product_id']; ?>-area").LoadingOverlay("hide"); 
              alert("The following error occurred: "+
              textStatus, errorThrown);
          });

              }                        
                    form.classList.add('was-validated');                    
                          
                }); 


w(window).on('load', function () { 
    setTimeout(function() { 
 var telephone = p("#telephone_<?php echo $SHONiR_Product_Details['product_id']; ?>").val().trim(); 
 var ftelephone = telephone.replace(/ /gi, "");
 p("#telephone_<?php echo $SHONiR_Product_Details['product_id']; ?>").val(ftelephone);
}, 1500);
});
 </script>      
  <script>
d(document).ready(function(){
  
  d('#country').html('<option value="">Please Wait...</option>'); 
            d.ajax({
                type:'POST',
                url: SHONiR_BASE+'Ajax/Countries',            
                success:function(html){
                    d('#country').html(html);
                    <?php if(SHONiR_Post_Fnc('country')){
                  echo 'd("#country").val('.SHONiR_Post_Fnc('country').').trigger("change");';
                } ?>
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
                    <?php if(SHONiR_Post_Fnc('region')){
                  echo 'd("#region").val('.SHONiR_Post_Fnc('region').').trigger("change");';
                } ?>
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
                    <?php if(SHONiR_Post_Fnc('city')){
                  echo 'd("#city").val('.SHONiR_Post_Fnc('city').').trigger("change");';
                } ?>
                }
            }); 
        }else{
            d('#city').html('<option value="">Select state first</option>'); 
        }
    });
});
</script>