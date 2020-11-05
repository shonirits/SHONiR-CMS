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


  <?php 
if($Sub_Categories){
?>

<!-- Categories Start -->

  <div class="container t-categories">
  <div class="row heading">
<div class="col-md-12 col-12">
<h1><?php echo $SHONiR_Main['heading']?></h1>
<hr>
</div>
  </div>
<div class="row details">
  <div class="col-md-12">
    <p><?php echo $SHONiR_Main['details']?></p>
  </div>
</div> 
<div class="row sub pb-3">
<?php  foreach ($Sub_Categories as $Category_key => $Category_value){ ?>
    <div class="col-md-3 no-padd"> <div class="items"><a href="<?php echo $Category_value['href'] ?>"><img class="img-fluid" src="<?php echo SHONiR_CDN_IMG.'media/uploads/'.$Category_value['image'];?>" alt=""><div class="t-overlaytext no-padd"><h3 class="no-marg"><?php echo $Category_value['name'] ?></h3></div></a></div></div>
    <?php }?>
</div>
</div>

<!-- Categories End -->
<?php }?>


<?php 
if($SHONiR_Main['SHONiR_Products']){
  $SHONiR_Records = $SHONiR_Main['SHONiR_Products'];
 $SHONiR_Rows = $SHONiR_Records['Rows'];
?>
<!-- Products Start -->

<div class="container t-products">
<?php 
if(!$Sub_Categories){
?>
  <div class="row heading">
<div class="col-md-12 col-12">
<h1><?php echo $SHONiR_Main['heading']?></h1>
<hr>
</div>
  </div>
<div class="row details">
  <div class="col-md-12">
    <p><?php echo $SHONiR_Main['details']?></p>
  </div>
</div>
<div class="row details">
  <div class="col-md-12">
  <div class="alert alert-info" role="alert">
  You are welcome to ask should you need any assistance, clarification, or have any enquiries, require further information or if you're looking for a specific product that's not listed here. please do not hesitate to <a href ="<?php echo SHONiR_BASE.'Contact' ?>">contact us</a>.
</div>
  </div>
</div>
<?php }?>
<div class="row filter pt-3 nav-tabs">
        <div class="col-md-3">
          <div class="row">
            <div class="col-4"><p>Sort By:</p></div>
            <div class="col-6">
              <select name="o" id="sort_order">
                <option value="pd.name" <?php echo ($SHONiR_Main['SHONiR_o']=='pd.name')?'selected="selected"':''; ?>>Name</option>
                <option value="p.model" <?php echo ($SHONiR_Main['SHONiR_o']=='p.model')?'selected="selected"':''; ?>>Model</option>
                <option value="p.add_time" <?php echo ($SHONiR_Main['SHONiR_o']=='p.add_time')?'selected="selected"':''; ?>>Date</option>
                <option value="p.sort_order" <?php echo ($SHONiR_Main['SHONiR_o']=='p.sort_order')?'selected="selected"':''; ?>>Default</option>
                <option value="p.hits" <?php echo ($SHONiR_Main['SHONiR_o']=='p.hits')?'selected="selected"':''; ?>>Trending</option>
                <option value="p.viewed" <?php echo ($SHONiR_Main['SHONiR_o']=='p.viewed')?'selected="selected"':''; ?>>Views</option>
              </select>
            </div>
            <div class="col-2 text-center">
              
            <?php if($SHONiR_Main['SHONiR_b']=="desc"){?>
            <a href="javascript:SHONiR();" id="by_asc"  data-toggle="tooltip" data-placement="top" title="Ascending"><i class="fas fa-long-arrow-alt-up" aria-hidden="true"></i></a>
            <?php }else{?>
            <a href="javascript:SHONiR();" id="by_desc"  data-toggle="tooltip" data-placement="top" title="Descending"><i class="fas fa-long-arrow-alt-down" aria-hidden="true"></i></a>
            <?php }?>

            </div>
          </div>
        </div>
        <div class="col-md-7">
        <div class="row">
          <div class="col-md-10">
            <p class="text-center stats">
              Items <?php echo $SHONiR_Records['Start_Records']?>-<?php echo $SHONiR_Records['End_Records']?> of <?php echo $SHONiR_Records['Total_Records']?>
              </p>
          </div>
          <div class="col-md-2">
            <p class="text-right">Show:</p>
          </div>
        </div>
        </div>
        <div class="col-md-2">
          <div class="row">
            <div class="col">
              <select name="l" id="records_limit">
                <option <?php echo (SHONiR_SETTINGS['config_records_limit']==$SHONiR_Main['SHONiR_l'])?'selected="selected"':''; ?>><?php echo SHONiR_SETTINGS['config_records_limit']?></option>
                <option <?php echo ((SHONiR_SETTINGS['config_records_limit']*2)==$SHONiR_Main['SHONiR_l'])?'selected="selected"':''; ?>><?php echo (SHONiR_SETTINGS['config_records_limit']*2) ?></option>
                <option <?php echo ((SHONiR_SETTINGS['config_records_limit']*5)==$SHONiR_Main['SHONiR_l'])?'selected="selected"':''; ?>><?php echo (SHONiR_SETTINGS['config_records_limit']*5) ?></option>
                <option <?php echo ((SHONiR_SETTINGS['config_records_limit']*10)==$SHONiR_Main['SHONiR_l'])?'selected="selected"':''; ?>><?php echo (SHONiR_SETTINGS['config_records_limit']*10) ?></option>
              </select>
            </div>
            <?php if($SHONiR_Main['SHONiR_v']=="list"){?>
            <div class="col-md-3">
              <a href="javascript:SHONiR();" id="grid_view"  data-toggle="tooltip" data-placement="top" title="Grid View"><i class="fa fa-th" aria-hidden="true"></i></a>
            </div>
            <?php }else{?>
            <div class="col-md-3">
              <a href="javascript:SHONiR();" id="list_view" data-toggle="tooltip" data-placement="top" title="List View"><i class="fa fa-list" aria-hidden="true"></i></a>
            </div>
            <?php }?>
          </div>
        </div>
</div>

<?php if($SHONiR_Main['SHONiR_v']=="list"){?>
  <div class="row list">
  <div class="col">
  <?php   foreach ($SHONiR_Rows as $key => $val) { ?>
    <div class="row zone">
<div class="col-md-4 t-pic">
<a href="<?php echo $SHONiR_Rows[$key]['href'] ?>"><img class="img-fluid onex" src="<?php echo SHONiR_Write_Uploads_Fnc($SHONiR_Rows[$key]['image']) ?>" alt="<?php echo $SHONiR_Rows[$key]['name']?>">
<?php if(isset($SHONiR_Rows[$key]['image1'])){?>
<img class="img-fluid twox" src="<?php echo SHONiR_Write_Uploads_Fnc($SHONiR_Rows[$key]['image1']) ?>" alt="<?php echo $SHONiR_Rows[$key]['name']?>">
<?php } ?>
</a>
<?php if($SHONiR_Rows[$key]['featured']){ ?>
      <span class="featured">New</span>
      <?php } ?>
<div class="icons">
<div class="col">
<a href="javascript:SHONiR_Ajax_Popup_Fnc('<?php echo $SHONiR_Rows[$key]['vhref'] ?>');" data-toggle="tooltip" data-placement="right" title="Quick View" class="hvr-bounce-to-top">  <i class="fa fa-eye" aria-hidden="true"></i></a>
</div>
<div class="col">
 <a href="javascript:SHONiR_Ajax_Popup_Fnc('<?php echo $SHONiR_Rows[$key]['ohref'] ?>');" data-toggle="tooltip" data-placement="right" title="Send Quick Enquiry" class="hvr-bounce-to-top"> <i class="fa fa-shopping-cart" aria-hidden="true"></i></a>
</div>
      </div>

</div>
<div class="col-md-8">
<h3 class="name"><a href="<?php echo $SHONiR_Rows[$key]['href'] ?>"><?php echo $SHONiR_Rows[$key]['name']?></a></h3>
  <h6 class="model">Artical#: <?php echo $SHONiR_Rows[$key]['model']?></h6>
  <div class="description"><?php echo $SHONiR_Rows[$key]['description']?></div>
<div class="row links">
<a href="javascript:SHONiR_AddtoCart_Fnc(<?php echo $SHONiR_Rows[$key]['product_id']?>);" data-toggle="tooltip" data-placement="top" title="Add to Enquiry Basket" class="hvr-bounce-to-top"> <i class="fa fa-shopping-basket" aria-hidden="true"></i> Add to Enquiry Basket </a>
          <a href="<?php echo $SHONiR_Rows[$key]['href'] ?>" data-toggle="tooltip" data-placement="top" title="Product Details" class="hvr-bounce-to-top"><i class="fas fa-info"></i>
        Product Details
        </a>
</div>
</div></div>  
<?php }?>
</div>
</div>
  <?php }else{?>
<div class="row grid">
<?php   foreach ($SHONiR_Rows as $key => $val) { ?>
  <div class="col-md-3 no-padd">
    <div class="card t-pic">
    <a href="<?php echo $SHONiR_Rows[$key]['href'] ?>">
    <img class="card-img-top onex" src="<?php echo SHONiR_Write_Uploads_Fnc($SHONiR_Rows[$key]['image']) ?>" alt="<?php echo $SHONiR_Rows[$key]['name']?>">
<?php if(isset($SHONiR_Rows[$key]['image1'])){?>
<img class="card-img-top twox" src="<?php echo SHONiR_Write_Uploads_Fnc($SHONiR_Rows[$key]['image1']) ?>" alt="<?php echo $SHONiR_Rows[$key]['name']?>">
<?php } ?>     
    </a>
      <?php if($SHONiR_Rows[$key]['featured']){ ?>
      <span>New</span>
      <?php } ?>
      <div class="icons">
<div class="col">
<a href="javascript:SHONiR_Ajax_Popup_Fnc('<?php echo $SHONiR_Rows[$key]['vhref'] ?>');" data-toggle="tooltip" data-placement="right" title="Quick View" class="hvr-bounce-to-top">  <i class="fa fa-eye" aria-hidden="true"></i></a>
</div>
<div class="col">
 <a href="javascript:SHONiR_Ajax_Popup_Fnc('<?php echo $SHONiR_Rows[$key]['ohref'] ?>');" data-toggle="tooltip" data-placement="right" title="Send Quick Enquiry" class="hvr-bounce-to-top"> <i class="fa fa-shopping-cart" aria-hidden="true"></i></a>
</div>
      </div>
      <div class="card-body">
        <p class="card-text" data-toggle="tooltip" data-placement="top" title="<?php echo $SHONiR_Rows[$key]['name']?>"><a href="<?php echo $SHONiR_Rows[$key]['href'] ?>"><?php echo $SHONiR_Rows[$key]['name']?></a></p>
        <h6 class="card-title">Artical#: <?php echo $SHONiR_Rows[$key]['model']?></h6>
        <div class="row links">
          <a href="javascript:SHONiR_AddtoCart_Fnc(<?php echo $SHONiR_Rows[$key]['product_id']?>);" data-toggle="tooltip" data-placement="top" title="Add to Enquiry Basket" class="hvr-bounce-to-top"> <i class="fa fa-shopping-basket" aria-hidden="true"></i> Add to Enquiry Basket </a>
          <a href="<?php echo $SHONiR_Rows[$key]['href'] ?>" data-toggle="tooltip" data-placement="top" title="Product Details" class="hvr-bounce-to-top"><i class="fas fa-info"></i></a>
 
        </div>
      </div>
    </div>
  </div>
  <?php }?>   
</div>
<?php }?>
<!-- PAGINATION START-->
<div class="row">
<div class="container t-pagination">
<?php echo $SHONiR_Records['Pagination']?>  
</div></div>
  <!-- PAGINATION END -->


</div>

<!-- Products End -->
<?php }else{
  if(!$Sub_Categories){
                 
?>

<div class="container t-empty">
  <div class="row heading">
<div class="col-md-12 col-12">
<h1>Nothing Found!</h1>
<hr>
</div>
  </div>
<div class="row details">
  <div class="col-md-12">
  <div class="alert alert-danger" role="alert">
  Sorry, but nothing matched your search terms. Please try again with some different keywords.
                </div>
  </div>
  </div>
<?php } 
 } ?>

 

<?php include('includes/footer.php');?>
    
    <?php require_once('common/end.php');?> 
   <script>

p('#records_limit').on('change', function() {
  SHONiR_Wait_Fnc('Loading...', 'Please wait while we process your request.');
    SHONiR_URL = "<?php echo SHONiR_URL; ?>?q=<?php echo SHONiR_Get_Fnc('q'); ?>&v=<?php echo $SHONiR_Main['SHONiR_v']; ?>&o=<?php echo $SHONiR_Main['SHONiR_o']; ?>&b=<?php echo $SHONiR_Main['SHONiR_b']; ?>&l=" + p(this).find(":selected").val();
    SHONiR_Redirect_Fnc(SHONiR_URL);
});

p('#sort_order').on('change', function() {
  SHONiR_Wait_Fnc('Loading...', 'Please wait while we process your request.');
    SHONiR_URL = "<?php echo SHONiR_URL; ?>?q=<?php echo SHONiR_Get_Fnc('q'); ?>&v=<?php echo $SHONiR_Main['SHONiR_v']; ?>&l=<?php echo $SHONiR_Main['SHONiR_l']; ?>&b=<?php echo $SHONiR_Main['SHONiR_b']; ?>&o=" + p(this).find(":selected").val();
    SHONiR_Redirect_Fnc(SHONiR_URL);
});

p("#by_asc").click(function() {
  SHONiR_Wait_Fnc('Loading...', 'Please wait while we process your request.');
  SHONiR_URL = "<?php echo SHONiR_URL; ?>?q=<?php echo SHONiR_Get_Fnc('q'); ?>&o=<?php echo $SHONiR_Main['SHONiR_o']; ?>&l=<?php echo $SHONiR_Main['SHONiR_l']; ?>&b=asc&v=<?php echo $SHONiR_Main['SHONiR_v']; ?>";
    SHONiR_Redirect_Fnc(SHONiR_URL);
    });

    p("#by_desc").click(function() {
  SHONiR_Wait_Fnc('Loading...', 'Please wait while we process your request.');
  SHONiR_URL = "<?php echo SHONiR_URL; ?>?q=<?php echo SHONiR_Get_Fnc('q'); ?>&o=<?php echo $SHONiR_Main['SHONiR_o']; ?>&l=<?php echo $SHONiR_Main['SHONiR_l']; ?>&b=desc&v=<?php echo $SHONiR_Main['SHONiR_v']; ?>";
    SHONiR_Redirect_Fnc(SHONiR_URL);
    });

p("#grid_view").click(function() {
  SHONiR_Wait_Fnc('Loading...', 'Please wait while we process your request.');
  SHONiR_URL = "<?php echo SHONiR_URL; ?>?q=<?php echo SHONiR_Get_Fnc('q'); ?>&o=<?php echo $SHONiR_Main['SHONiR_o']; ?>&l=<?php echo $SHONiR_Main['SHONiR_l']; ?>&b=<?php echo $SHONiR_Main['SHONiR_b']; ?>&n=<?php echo SHONiR_Get_Fnc('n'); ?>&v=grid";
    SHONiR_Redirect_Fnc(SHONiR_URL);
    });

p("#list_view").click(function() {
  SHONiR_Wait_Fnc('Loading...', 'Please wait while we process your request.');
  SHONiR_URL = "<?php echo SHONiR_URL; ?>?q=<?php echo SHONiR_Get_Fnc('q'); ?>&o=<?php echo $SHONiR_Main['SHONiR_o']; ?>&l=<?php echo $SHONiR_Main['SHONiR_l']; ?>&b=<?php echo $SHONiR_Main['SHONiR_b']; ?>&n=<?php echo SHONiR_Get_Fnc('n'); ?>&v=list";
    SHONiR_Redirect_Fnc(SHONiR_URL);
    });

   </script>  
 
  </body>
</html><?php
require_once('common/clear.php');
?>