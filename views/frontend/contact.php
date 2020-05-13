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
<div class="row th-contact">  
<div class="col">
<form name="SHONiR_Contact_Frm" id="SHONiR_Contact_Frm" method="POST" novalidate>
<input type="hidden" name="SHONiR_CSRF" id="SHONiR_CSRF" value="<?php echo $SHONiR_Main['SHONiR_CSRF'];?>">
                                <!--Body-->
                                <div class="form-group">
                                    <div class="input-group mb-2">
                                        <div class="input-group-prepend">
                                            <div class="input-group-text"><i class="fa fa-user icon"></i></div>
                                        </div>
                                        <input type="text" id="name" name="name" value="<?php echo SHONiR_Post_Fnc('name') ?>"  placeholder="Your name" class="form-control" aria-describedby="inputGroupPrepend" required />  
                                        <div class="invalid-feedback">  
                                            Please provide your valid name. 
                                        </div>
                                    </div>
                                </div>
                                <div class="form-group">
                                    <div class="input-group mb-2">
                                        <div class="input-group-prepend">
                                            <div class="input-group-text"><i class="fa fa-envelope icon"></i></div>
                                        </div>
                                        <input type="email" class="form-control" id="email" name="email" placeholder="Your email address" value="<?php echo SHONiR_Post_Fnc('email') ?>" aria-describedby="inputGroupPrepend" required />  
                                        <div class="invalid-feedback">  
                                            Please provide your valid email address. 
                                        </div>  
                                    </div>
                                </div>

                                <div class="form-group">
                                    <div class="input-group mb-2">
                                        <div class="input-group-prepend">
                                            <div class="input-group-text"><i class="fab fa-whatsapp icon"></i></div>
                                        </div>
                                        <input type="tel" pattern="^\d{10}$" id="telephone" name="telephone" value="<?php echo SHONiR_Post_Fnc('mobile') ?>"  placeholder="Your mobile number" class="form-control" aria-describedby="inputGroupPrepend" required />
                                         &nbsp; 
                                        <span id="valid-msg" class="hide">✓ Valid</span>
                                            <span id="error-msg" class="hide"></span>  
                                        <div class="invalid-feedback">  
                                            Please provide your valid mobile number. 
                                        </div>
                                    </div>
                                </div>


                                <div class="form-group">
                                    <div class="input-group mb-2">
                                        <div class="input-group-prepend">
                                            <div class="input-group-text"><i class="fa fa-comment icon"></i></div>
                                        </div>
                                        <textarea class="form-control" id="message" name="message" placeholder="Please write us your message." aria-describedby="inputGroupPrepend" required><?php echo SHONiR_H2T_Fnc(SHONiR_Post_Fnc('message')) ?></textarea>
                                        <div class="invalid-feedback">  
                                            Please provide your message in reasonable details. 
                                        </div>
                                    </div>
                                </div>

                                <div class="form-group">
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

                                <div class="text-center">
                                    <input type="submit" value="Send" class="btn btn-primary btn-block rounded-0 py-2">
                                </div>
                            
        </form>
      </div>

        <div class="col">
        
        <?php echo $SHONiR_Main['description'] ?>
      </div>    
      
  </div>
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
  </body>
</html><?php
require_once('common/clear.php');
?>