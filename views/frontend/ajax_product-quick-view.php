<?php 

$SHONiR_Product_Details = $SHONiR_Main['SHONiR_Product_Details'];
$SHONiR_Product_Uploads = $SHONiR_Product_Details['uploads'];

?>  <div class="container  ">
<div class="row">
            <div class="col-lg-5 mt-20">
                <div class="image-box">
                    <div class="product-main-image">
                        <a data-fancybox="SHONiR_Product_Gallery" href="<?php echo SHONiR_Write_Uploads_Fnc($SHONiR_Product_Details['image']) ?>"><img src="<?php echo SHONiR_Write_Uploads_Fnc($SHONiR_Product_Details['image']); ?>" class="main-image img-fluid"></a>
                    </div>
                    <small class="text-muted">* Click on image to zoom in</small>
                    <?php 
if(count($SHONiR_Product_Uploads) > 1){
?>
                    <div class="product-thumbnails">
                    
<?php 
  foreach ($SHONiR_Product_Uploads as $upload_key => $upload_value)
            {
              if ($upload_key < 1) continue;

              $SHONiR_Source = (SHONiR_SETTINGS['config_auto_watermark']=="TRUE")? $upload_value['upload_id'] : $upload_value['upload_file'];
              
              ?>
                        
                            <a data-fancybox="SHONiR_Product_Gallery" href="<?php echo SHONiR_Write_Uploads_Fnc($SHONiR_Source) ?>"> <img src="<?php echo SHONiR_Write_Uploads_Fnc($SHONiR_Source) ?>" class="thumbnail-image img-fluid"></a>
                        
                        <?php }?>
                    </div>
                    <?php }?>
                </div>
            </div>
            <div class="col-lg-7 mt-20">
                <div class="product-data">
                    <h2 class="product-title"><?php echo $SHONiR_Product_Details['name']?></h2>
                    <p class="product-model"><img src="<?php echo SHONiR_BASE.'Code/bar/code128/'.$SHONiR_Product_Details['reference']?>" > </p>
                    <p class="product-model">Model: <?php echo $SHONiR_Product_Details['model']?> </p>
                    <p class="product-model">Price: <?php echo SHONiR_Write_Price_Fnc($SHONiR_Product_Details['selling_price'], SHONiR_CURRENCY['currency_id']); ?> </p>
                    <hr>
                    <div id="quick-form-area">
                    <form name="SHONiR_Quick_Order_Frm" id="SHONiR_Quick_Order_Frm" method="POST" novalidate>
<input type="hidden" name="SHONiR_CSRF" id="SHONiR_CSRF" value="<?php echo $SHONiR_Main['SHONiR_CSRF'];?>">
                                <!--Body-->
                                <div class="form-group">

                                <div class="input-group mb-2">
                                        <div class="input-group-prepend">
                                            <div class="input-group-text"><i class="fa fa-cart-plus icon"></i></div>
                                        </div>
                                        <input type="number" id="quantity" name="quantity" value="<?php echo $SHONiR_Product_Details['minimum']?>"  placeholder="<?php echo $SHONiR_Product_Details['minimum']?>" class="form-control" aria-describedby="inputGroupPrepend" min="<?php echo $SHONiR_Product_Details['minimum']?>" max="<?php echo $SHONiR_Product_Details['stock']?>" required />  
                                        <div class="invalid-feedback">  
                                        There is a minimum <?php echo $SHONiR_Product_Details['minimum']?> & maximum <?php echo $SHONiR_Product_Details['stock']?> quantity limit for this product. 
                                        </div>
                                    </div>
                                    
                                </div>

                                <div class="form-group">
                                    <div class="input-group mb-2">
                                        <div class="input-group-prepend">
                                            <div class="input-group-text"><i class="fa fa-user icon"></i></div>
                                        </div>
                                        <input type="text" id="ship_name" name="ship_name" value=""  placeholder="Your name" class="form-control" aria-describedby="inputGroupPrepend" required />  
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
                                        <input type="email" class="form-control" id="ship_email" name="ship_email" placeholder="Your email address" value="" aria-describedby="inputGroupPrepend" required />  
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
                                        <input type="tel" pattern="^\d{10}$" id="ship_cell_short" name="ship_cell_short" value=""  placeholder="Your mobile number" class="form-control" aria-describedby="inputGroupPrepend" required /> 
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
                                            <div class="input-group-text"><i class="fa fa-map-marker icon"></i></div>
                                        </div>
                                        <textarea class="form-control" id="ship_address1" name="ship_address1" placeholder="Shipping Address" aria-describedby="inputGroupPrepend" required></textarea>
                                        <div class="invalid-feedback">  
                                            Please provide your shipping address. 
                                        </div>
                                    </div>
                                </div>


                                <div class="form-group">
                                    <div class="input-group mb-2">
                                        <div class="input-group-prepend">
                                            <div class="input-group-text"><i class="fa fa-comment icon"></i></div>
                                        </div>
                                        <textarea class="form-control" id="user_comments" name="user_comments" placeholder="Any Instruction About Your Order" aria-describedby="inputGroupPrepend" required></textarea>
                                        <div class="invalid-feedback">  
                                            Please provide your instruction in reasonable details. 
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
                                    <input type="button" id="quick-popup-btn" value="Send" class="btn btn-primary btn-block rounded-0 py-2">
                                </div>
                            
        </form></div>
                    <hr>   
                    <?php 
                    $SHONiR_Str_Tag = $SHONiR_Product_Details['tag'];
                    if($SHONiR_Str_Tag){ ?>                
                    <h5>Product Tags:</h5>                    
                    <div class="product-tags">
                      <?php $SHONiR_Str_Array = explode(',',$SHONiR_Str_Tag);
foreach ($SHONiR_Str_Array as $values)
{
  $SHONiR_Str_value = trim($values,"\0 \t \n \x0B \r ");
?>
                        <a href="Products/search?q=<?php echo $SHONiR_Str_value;?>" class="badge badge-pill badge-light"><?php echo $SHONiR_Str_value;?></a>
                        <?php } ?>
                    </div>
                    <?php } ?>
                </div>
            </div>
        </div>
        <div class="row mt-80 tabs" id="product_description">
            <div class="col-lg-12">
                <ul class="nav nav-tabs" role="tablist">
                    <li class="nav-item">
                        <a class="nav-link active" href="#t1body1" aria-controls="t1body1" role="tab" data-toggle="tab">Description</a>
                    </li>
                    
                </ul>

                <div class="tab-content tabs-content">
                    <div role="tabpanel" class="tab-pane fade show active" id="t1body1">
                    <?php echo $SHONiR_Product_Details['description'];?>  </div>                  
                    
                </div>
            </div>
        </div>
        </div>
        </div>
        <script>    


var input = document.querySelector("#ship_cell_short");
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
  /* hiddenInput: "ship_cell", */
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


                                
                    p("#quick-popup-btn").click(function (event) {                          
                        
                        var form = document.getElementById('SHONiR_Quick_Order_Frm');
                                       
                if (form.checkValidity() === false || iti.isValidNumber() === false) { 

                        event.preventDefault();  
                        event.stopPropagation();

                    } else {

                        d("#quick-form-area").LoadingOverlay("show", {
                    background  : "rgba(150, 150, 150, 0.5)"
                    });
                    
                    data = p(form).serialize();
                    var ship_cell = iti.getNumber();  
                    request = d.ajax({
              url: "<?php echo $SHONiR_Product_Details['qhref'] ?>",
              type: "post",
             dataType:"json",
              data: 'SHONiR=SHONiR&ship_cell='+ship_cell+'&'+data,              
              cache: false
          });

          request.done(function (response, textStatus, jqXHR){ 
                       
            if(response['type']==='success'){

                d("#quick-form-area").LoadingOverlay("hide");
                p( "#quick-form-area" ).html('<div class="alert alert-success fade show" role="alert"> ' + response['message'] + ' </div>');

            }else{

                p("input[name='captcha']",form).val('');
                SHONiR_Captcha_Fnc();
               p("input[name='SHONiR_CSRF']",form).val(response['SHONiR_CSRF']);
               d("#quick-form-area").LoadingOverlay("hide");
               p( "#quick-form-area" ).prepend('<div class="alert alert-danger alert-dismissible fade show" role="alert"> ' + response['message'] + ' <button type="button" class="close" data-dismiss="alert" aria-label="Close">    <span aria-hidden="true">&times;</span> </button></div>');

            }
        });

            request.fail(function (jqXHR, textStatus, errorThrown){
                d("#quick-form-area").LoadingOverlay("hide"); 
              alert("The following error occurred: "+
              textStatus, errorThrown);
          });

              }                        
                    form.classList.add('was-validated');                    
                          
                }); 


 </script>