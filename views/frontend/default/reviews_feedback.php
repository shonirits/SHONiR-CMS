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
    <form name="SHONiR_Feedback_Frm" id="SHONiR_Feedback_Frm" method="POST" novalidate>
<input type="hidden" name="SHONiR_CSRF" id="SHONiR_CSRF" value="<?php echo $SHONiR_Main['SHONiR_CSRF'];?>">
<input type="hidden" name="packaging" id="packaging" value="<?php echo SHONiR_Post_Fnc('packaging') ?>">
<input type="hidden" name="quality" id="quality" value="<?php echo SHONiR_Post_Fnc('quality') ?>">
<input type="hidden" name="money" id="money" value="<?php echo SHONiR_Post_Fnc('money') ?>">
<input type="hidden" name="responsive" id="responsive" value="<?php echo SHONiR_Post_Fnc('responsive') ?>">
<input type="hidden" name="production" id="production" value="<?php echo SHONiR_Post_Fnc('production') ?>">
<input type="hidden" name="recommended" id="recommended" value="<?php echo SHONiR_Post_Fnc('recommended') ?>">
  <!-- Feedback from start -->
  <div class="container t-feedback">
  <div class="row heading">
<div class="col-md-12 col-12">
<h1><?php echo $SHONiR_Main['name'] ?></h1>
<hr>
</div>
  </div>
<div class="row details">
       <div class="col">
       <?php echo $SHONiR_Main['description'] ?>
    </div>
</div>
<div class="form">

    <div class="row mt-3">
        <div class="col-md-4 col-12"><input class="form-control input" type="text" id="name" name="name" value="<?php echo SHONiR_Post_Fnc('name') ?>"  placeholder="Your name" required><div class="invalid-feedback">  
                                            Please provide your valid name. 
                                        </div></div>
        <div class="col-md-4 col-12"><input class="form-control input" type="email" id="email" name="email" placeholder="Your email address" value="<?php echo SHONiR_Post_Fnc('email') ?>" required ><div class="invalid-feedback">  
                                            Please provide your valid email address. 
                                        </div>  </div>
        <div class="col-md-4 col-12"><select class="form-control input selectpicker countrypicker" data-flag="true" id="country" name="country" required></select><div class="invalid-feedback">  
                                            Please select your country. 
                                        </div>
                                        </div>
    </div>
    
    <div class="row mt-3" >
        <div class="col-md-6 col-12">
        <input class="form-control input" type="text" id="reference" name="reference" value="<?php echo SHONiR_Post_Fnc('reference') ?>"  placeholder="Reference/Order No/Invoice No" required><div class="invalid-feedback">  
                                            Please provide us your reference#/Order No#/Invoice No#. 
                                        </div>
        </div> 
        <div class="col-md-6 col-12">
        <input class="form-control input" type="text" id="subject" name="subject" value="<?php echo SHONiR_Post_Fnc('subject') ?>"  placeholder="Subject/Title/Headline" required><div class="invalid-feedback">  
                                            Please provide subject for your comments. 
                                        </div>
        </div>    
    </div>

    <div class="row mt-3" >
        <div class="col-md-12">
            <div class="form-group">
                <textarea class="form-control input" rows="5" id="details" name="details" placeholder="Please tell us more about your experience with our products/services." required><?php echo SHONiR_H2T_Fnc(SHONiR_Post_Fnc('details')) ?></textarea> <div class="invalid-feedback">  
                Please provide your experience in reasonable details.
                                        </div>
              </div> 
        </div>     
    </div>


    <div class="row mt-3" >
        <div class="col">
<h2>How would you rate the packaging of the product?</h2>
<span id="rate_packaging" class="my-rating-4" data-rating="<?php echo SHONiR_Post_Fnc('packaging') ?>"></span>
<span id="rate_packaging_live" class="live-rating"></span>
        </div>    
    </div>

    <div class="row mt-3" >
        <div class="col">
<h2>How well does our product quality meet your needs?</h2>
<span id="rate_quality" class="my-rating-4" data-rating="<?php echo SHONiR_Post_Fnc('quality') ?>"></span>
<span id="rate_quality_live" class="live-rating"></span>
        </div>    
    </div> 

    <div class="row mt-3" >
        <div class="col">
<h2>How would you rate the value for money of the product?</h2>
<span id="rate_money" class="my-rating-4" data-rating="<?php echo SHONiR_Post_Fnc('money') ?>"></span>
<span id="rate_money_live" class="live-rating"></span>
        </div>    
    </div> 


    <div class="row mt-3" >
        <div class="col">
<h2>How responsive have we been to your questions or concerns about our products?</h2>
<span id="rate_responsive" class="my-rating-4" data-rating="<?php echo SHONiR_Post_Fnc('responsive') ?>"></span>
<span id="rate_responsive_live" class="live-rating"></span>
        </div>    
    </div>  


    <div class="row mt-3" >
        <div class="col">
<h2>how would you rate the production in a timely manner?</h2>
<span id="rate_production" class="my-rating-4" data-rating="<?php echo SHONiR_Post_Fnc('production') ?>"></span>
<span id="rate_production_live" class="live-rating"></span>
        </div>    
    </div> 


    <div class="row mt-3" >
        <div class="col">
<h2>How likely are you to recommend our company, our products or our services to your friends, your colleagues or other organizations?</h2>
<span id="rate_recommended" class="my-rating-4" data-rating="<?php echo SHONiR_Post_Fnc('recommended') ?>"></span>
<span id="rate_recommended_live" class="live-rating"></span>
        </div>    
    </div> 
 
<div class="row mt-4">
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
        <button class="hvr-bounce-to-top"><i class="fa fa-paper-plane" aria-hidden="true"></i> Send Feedback</button>
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
(function () {  
            'use strict';  
            window.addEventListener('load', function () {  
                var form = document.getElementById('SHONiR_Feedback_Frm'); 
                form.addEventListener('submit', function (event) {  
                    if (form.checkValidity() === false || iti.isValidNumber() === false) {  
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

  var form = document.getElementById('SHONiR_Feedback_Frm');

  d("#rate_packaging").starRating({
  totalStars: 10,
  minRating: 1,
  starShape: 'rounded',
  starSize: 35,
  emptyColor: 'lightgray',
  hoverColor: 'salmon',
  activeColor: 'crimson',
  useGradient: false,
  disableAfterRate: false,
  callback: function(currentRating, $el){
    p("input[name='packaging']",form).val(currentRating);
  },
    onHover: function(currentIndex, currentRating, $el){
      d('#rate_packaging_live').text(currentIndex);
    },
    onLeave: function(currentIndex, currentRating, $el){
      d('#rate_packaging_live').text(currentRating);
    }
});

d("#rate_quality").starRating({
  totalStars: 10,
  minRating: 1,
  starShape: 'rounded',
  starSize: 35,
  emptyColor: 'lightgray',
  hoverColor: 'salmon',
  activeColor: 'crimson',
  useGradient: false,
  disableAfterRate: false,
  callback: function(currentRating, $el){
    p("input[name='quality']",form).val(currentRating);
  },
    onHover: function(currentIndex, currentRating, $el){
      d('#rate_quality_live').text(currentIndex);
    },
    onLeave: function(currentIndex, currentRating, $el){
      d('#rate_quality_live').text(currentRating);
    }
});


d("#rate_money").starRating({
  totalStars: 10,
  minRating: 1,
  starShape: 'rounded',
  starSize: 35,
  emptyColor: 'lightgray',
  hoverColor: 'salmon',
  activeColor: 'crimson',
  useGradient: false,
  disableAfterRate: false,
  callback: function(currentRating, $el){
    p("input[name='money']",form).val(currentRating);
  },
    onHover: function(currentIndex, currentRating, $el){
      d('#rate_money_live').text(currentIndex);
    },
    onLeave: function(currentIndex, currentRating, $el){
      d('#rate_money_live').text(currentRating);
    }
});

d("#rate_responsive").starRating({
  totalStars: 10,
  minRating: 1,
  starShape: 'rounded',
  starSize: 35,
  emptyColor: 'lightgray',
  hoverColor: 'salmon',
  activeColor: 'crimson',
  useGradient: false,
  disableAfterRate: false,
  callback: function(currentRating, $el){
    p("input[name='responsive']",form).val(currentRating);
  },
    onHover: function(currentIndex, currentRating, $el){
      d('#rate_responsive_live').text(currentIndex);
    },
    onLeave: function(currentIndex, currentRating, $el){
      d('#rate_responsive_live').text(currentRating);
    }
});

d("#rate_production").starRating({
  totalStars: 10,
  minRating: 1,
  starShape: 'rounded',
  starSize: 35,
  emptyColor: 'lightgray',
  hoverColor: 'salmon',
  activeColor: 'crimson',
  useGradient: false,
  disableAfterRate: false,
  callback: function(currentRating, $el){
    p("input[name='production']",form).val(currentRating);
  },
    onHover: function(currentIndex, currentRating, $el){
      d('#rate_production_live').text(currentIndex);
    },
    onLeave: function(currentIndex, currentRating, $el){
      d('#rate_production_live').text(currentRating);
    }
});

d("#rate_recommended").starRating({
  totalStars: 10,
  minRating: 1,
  starShape: 'rounded',
  starSize: 35,
  emptyColor: 'lightgray',
  hoverColor: 'salmon',
  activeColor: 'crimson',
  useGradient: false,
  disableAfterRate: false,
  callback: function(currentRating, $el){
    p("input[name='recommended']",form).val(currentRating);
  },
    onHover: function(currentIndex, currentRating, $el){
      d('#rate_recommended_live').text(currentIndex);
    },
    onLeave: function(currentIndex, currentRating, $el){
      d('#rate_recommended_live').text(currentRating);
    }
});



  
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
         
          }); 
</script>
  </body>
</html><?php
require_once('common/clear.php');
?>