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
  
<!-- Page Content STart -->

<div class="container-fluid wow slideInRight slow" >
<div class="container login-container">
            <div class="row">
                <div class="col-md-6 login-form-1">
                    <h3>Login with Google</h3>
                    <form>
                        
                        
                        <div class="form-group">
                            <a type="submit" class="btnSubmit" href="<?php echo SHONiR_BASE.'Customers/Login/google'?>"> &nbsp; <i class="fab fa-google"></i> Sign in with Google  &nbsp; </a>
                            </div>
                        <div class="form-group">
                        don't have an account?  <a href="https://gmail.com" class="ForgetPwd">Create FREE Google Account</a>
                        </div>
                    </form>
                </div>
                <div class="col-md-6 login-form-2">
                    <h3>Login with Facebook</h3>
                    <form>
                        
                        <div class="form-group">
                        <a type="submit" class="btnSubmit"  href="<?php echo SHONiR_BASE.'Customers/Login/facebook'?>" > &nbsp;  <i class="fab fa-facebook-f"></i> Sign in with Facebook  &nbsp;  </a>
                        </div>
                        <div class="form-group">

                        don't have an account?  <a href="https://facebook.com" class="ForgetPwd" value="Login">Create FREE Facebook Account</a>
                        </div>
                    </form>
                </div>
            </div>
        </div>
</div>
   <!-- Page Content End -->

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