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
  
  <!-- gallery from start -->
  <div class="container t-gallery">
  <?php if(isset($SHONiR_Main['name'])){ ?>
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
<?php if($Images){?>
<div class="row mt-3">
<?php
foreach ($Images as $Image_key => $Image_value)
{ 
?>
<div class="col-lg-3 col-md-4 col-6">
      <a href="<?php echo SHONiR_CDN_IMG.'media/uploads/'.$Image_value['image'] ?>" data-fancybox="gallery_images" data-caption="<?php echo $Image_value['name'] ?>" class="d-block mb-4 h-100">
            <img class="img-fluid img-thumbnail" src="<?php echo SHONiR_CDN_IMG.'media/uploads/'.$Image_value['image'] ?>" alt="<?php echo $Image_value['name'] ?>" data-toggle="tooltip" data-placement="top" title="<?php echo $Image_value['name'] ?>">
          </a>
    </div>
<?php }?>
</div>
<?php }?>
<?php }else{
  
  echo '<div class="alert alert-danger" role="alert">
  Nothing Found! Your requested record not exist in database.
</div>';

}?>

</div>

  <!-- gallery from end -->
<?php include('includes/footer.php');?>
    
    <?php require_once('common/end.php');?> 
     
 
  </body>
</html><?php
require_once('common/clear.php');
?>