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
    <form name="SHONiR_Contact_Frm" id="SHONiR_Contact_Frm" method="POST" novalidate>
<input type="hidden" name="SHONiR_CSRF" id="SHONiR_CSRF" value="<?php echo $SHONiR_Main['SHONiR_CSRF'];?>">
  <!-- contact from start -->
  <div class="container t-contact">
  <div class="row heading">
<div class="col-md-12 col-12">
<h1><?php echo $SHONiR_Main['name'] ?></h1>
<hr>
</div>
  </div>
<div class="row details">
  <div class="col-md-3 col-12">
<h1>Get in touch</h1>
  </div>
  <div class="col-md-9">
      <h5>If you have any questions, just fill in the contact form, and we will answer you shortly.</h5>
  </div>
</div>
<div class="form">
    <div class="row">
        <div class="col-md-4 col-12"><input class="form-control input" type="text" id="name" name="name" value="<?php echo SHONiR_Post_Fnc('name') ?>"  placeholder="Your name" required><div class="invalid-feedback">  
                                            Please provide your valid name. 
                                        </div></div>
        <div class="col-md-4 col-12"><input class="form-control input" type="email" id="email" name="email" placeholder="Your email address" value="<?php echo SHONiR_Post_Fnc('email') ?>" required ><div class="invalid-feedback">  
                                            Please provide your valid email address. 
                                        </div>  </div>
        <div class="col-md-4 col-12"><input class="form-control input" type="tel" id="telephone" name="telephone" value="<?php echo SHONiR_Post_Fnc('mobile') ?>"  placeholder="Your mobile number" required ><div class="invalid-feedback">  
                                            Please provide your valid mobile number. 
                                        </div>  &nbsp;  <span id="valid-msg" class="hide valid-msg">✓ Valid</span>
                                            <span id="error-msg" class="hide error-msg"></span>  
                                        </div>
    </div>
    <div class="row mt-3">
        <div class="col-md-4 col-12">
            <select class="form-control input selectpicker countrypicker" data-flag="true" id="country" name="country" required></select><div class="invalid-feedback">  
                                            Please select your country. 
                                        </div>
        </div>
        <div class="col-md-4 col-12">
            <select class="form-control input selectpicker countrypicker" data-flag="true"  id="region" name="region"><option value="">Select country first</option></select><div class="invalid-feedback">  
                                            Please select your region/state. 
                                        </div>
        </div>
        <div class="col-md-4 col-12">
            <select class="form-control input selectpicker countrypicker" data-flag="true" id="city" name="city"><option value="">Select state first</option></select><div class="invalid-feedback">  
                                            Please select your city. 
                                        </div>
        </div>
    </div>
    <div class="row mt-3" >
        <div class="col-md-12">
            <div class="form-group">
                <textarea class="form-control input" rows="5" id="message" name="message" placeholder="Please write us your message." required><?php echo SHONiR_H2T_Fnc(SHONiR_Post_Fnc('message')) ?></textarea> <div class="invalid-feedback">  
                                            Please provide your message in reasonable details. 
                                        </div>
              </div> 
        </div>
     
    </div>
 
<div class="row">
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

    <div class=" row submit">
       <div class="col">
        <button class="hvr-bounce-to-top">Send Message</button>
       </div>
    </div>
    <hr>
    <div class=" row ">
       <div class="col">
       <?php echo $SHONiR_Main['description'] ?>
       </div>
    </div>
</div>
</div>
</form>
  <!-- contact form end -->
  <?php }else{
  
  echo '<div class="alert alert-danger" role="alert">
  Nothing Found! Your requested record not exist in database.
</div>';

}?>


<?php include('includes/footer.php');?>
    
    <?php require_once('common/end.php');?> 
     
 <script>
  d(document).ready(function(){
  var input = document.querySelector("#telephone");
var errorMsg = document.querySelector("#error-msg");
 var validMsg = document.querySelector("#valid-msg");
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
                var form = document.getElementById('SHONiR_Contact_Frm'); 
                form.addEventListener('submit', function (event) {  
                    if (form.checkValidity() === false || iti.isValidNumber() === false) {  
                        event.preventDefault();  
                        event.stopPropagation();  
                    }  
                    form.classList.add('was-validated');  
                }, false);
            }, false);  
        })(); 


w(window).on('load', function () { 
    setTimeout(function() { 
 var telephone = p("#telephone").val().trim(); 
 var ftelephone = telephone.replace(/ /gi, "");
 p("#telephone").val(ftelephone);
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
  </body>
</html><?php
require_once('common/clear.php');
?>