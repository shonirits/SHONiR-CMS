<?php 
$SHONiR_Product_Details = $SHONiR_Main['SHONiR_Product_Details'];
$SHONiR_Product_Uploads = $SHONiR_Product_Details['uploads'];
?>
<div class="container t-product_quick_view">
  <div class="row heading">
<div class="col-md-12 col-12">
<h1>PRODUCT QUICK VIEW</h1>
<hr>
</div>
  </div>
  <form name="SHONiR_Product_Quick_View_<?php echo $SHONiR_Product_Details['product_id']; ?>_Frm" id="SHONiR_Product_Quick_View_<?php echo $SHONiR_Product_Details['product_id']; ?>_Frm" class="needs-validation" novalidate>
  <input type="hidden" name="SHONiR_CSRF" id="SHONiR_CSRF" value="<?php echo $SHONiR_Main['SHONiR_CSRF'];?>">
    <div class="row ">
        <div class="col-md-5 col-12">
        <div id="SHONiR_Product_Quick_View_<?php echo $SHONiR_Product_Details['product_id']; ?>_Gal" data-autoplay="3000" data-loop="true" data-allowfullscreen="true"  data-click="false" data-swipe="true"  data-arrows="always"  data-nav="thumbs" data-thumbheight="48">
        <?php
  foreach ($SHONiR_Product_Uploads as $upload_key => $upload_value)
            {
              $SHONiR_Source = (SHONiR_SETTINGS['config_auto_watermark']=="TRUE")? $upload_value['upload_id'] : $upload_value['upload_file'];

              ?>
        <a href="<?php echo SHONiR_Write_Uploads_Fnc($SHONiR_Source) ?>"><img src="<?php echo SHONiR_Write_Uploads_Fnc($SHONiR_Source) ?>" ></a>
            <?php }?>           
       </div>
       <?php if($SHONiR_Product_Details['featured']){ ?>
      <span class="featured">New</span>
      <?php } ?>
        </div>
        <div class="col-md-7 ">
        <h2 class="name"><?php echo $SHONiR_Product_Details['name']?></h2>
        <h3 class="model">Article#: <?php echo $SHONiR_Product_Details['model']?></h3>
        <div class="description"><?php echo $SHONiR_Product_Details['description']?></div>
        <div id="SHONiR_Product_Quick_View_<?php echo $SHONiR_Product_Details['product_id']; ?>_Area">
        <div class="row dform ml-2 pb-2">
        <div class="col-auto mt-2"><input type="number" id="quantity" name="quantity" class="form-control input" value="<?php echo $SHONiR_Product_Details['minimum']?>" min="<?php echo $SHONiR_Product_Details['minimum']?>" max="<?php echo $SHONiR_Product_Details['stock']?>" required>
                                    <div class="invalid-feedback">
                                    There is a minimum <?php echo $SHONiR_Product_Details['minimum']?> & maximum <?php echo $SHONiR_Product_Details['stock']?> quantity limit for this product.                                        </div></div>
            <div class="col-auto">
            <!-- id="add-to-cart-<?php echo $SHONiR_Product_Details['product_id']; ?>-btn" -->
                <button class="hvr-bounce-to-top" type="button" onclick="javascript:SHONiR_AddtoCart_Fnc(<?php echo $SHONiR_Product_Details['product_id']; ?>, 'Product_Quick_View');" data-toggle="tooltip" data-placement="top" title="Add to Enquiry Basket"><i class="fa fa-shopping-basket" aria-hidden="true"></i> Add to Enquiry Basket</button>
            </div>
            <div class="col-auto"><button type="button" class="hvr-bounce-to-top"  onclick="javascript:SHONiR_Ajax_Popup_Fnc('<?php echo $SHONiR_Product_Details['ohref'] ?>');"  data-toggle="tooltip" data-placement="top" title="Send Quick Enquiry">
              <i class="fa fa-paper-plane" aria-hidden="true"></i> Send Quick Enquiry </button>
              
              </div>
              </div>
        </div>
        </div>
    </div>
    <div class="row details">
  <div class="col">
  <?php
                    $SHONiR_Str_Tag = $SHONiR_Product_Details['tag'];
                    if($SHONiR_Str_Tag){ ?>
                    <h4 class="heading">Product Tags:</h4>
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
</form>

</div>
<script>
  p(function () {   
    p('#SHONiR_Product_Quick_View_<?php echo $SHONiR_Product_Details['product_id']; ?>_Gal').fotorama();
    d("#SHONiR_Product_Quick_View_<?php echo $SHONiR_Product_Details['product_id']; ?>_Frm").keypress(function(e) {
if (e.which == 13) {
  return false;
}

});
  });
  </script>
  