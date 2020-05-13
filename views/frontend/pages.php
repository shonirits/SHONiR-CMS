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
  
  <!-- Pages Start -->

<?php 
if($Sub_Pages){
?>

<div class="container-fluid wow bounceInLeft  slow" id="s-services">
  <div class="container  ">

<div class="row ">  
  <div class="col th-heading text-center">
Pages
</div>
</div>
  <div class="row  th-content">   

  <?php 
  $c = 0;
  foreach ($Sub_Pages as $Page_key => $Page_value)
            {
              $c++;  

              if ($c==4) {
                echo '</div> <div class="row ">';
                $c=1;
              }
              
              ?>
        <div class="col view view-eighth">
        <img src="<?php echo 'media/uploads/'.$Page_value['image'];?>" class="img-fluid">
        
        <div class="mask">
                        <h2><?php echo $Page_value['name'] ?></h2>
                        <p><?php 
                    $string = strip_tags($Page_value['description']);
if (strlen($string) > 125) {

    $stringCut = substr($string, 0, 125);
    $endPoint = strrpos($stringCut, ' ');

    $string = $endPoint? substr($stringCut, 0, $endPoint) : substr($stringCut, 0);
    $string .= '... ';
}
echo $string;
                    ?></p>
                        <a href="Pages/<?php echo $Page_value['page_id'].'_'.$Page_value['slug'].'.'.SHONiR_EX ?>" class="info">View Details</a>
                    </div>
</div>  
<?php }?>
        
  </div>

  </div>
</div>

<?php }?>

<!-- Pages End -->
<?php if(isset($SHONiR_Main['name'])){ ?>
<!-- Page Content STart -->

<div class="container-fluid wow slideInRight slow" >
  <div class="container  ">
  <div class="row ">  
  <div class="col th-heading text-center">
  <?php echo $SHONiR_Main['name'] ?>
</div>
</div>
<div class="row ">   
        <div class="col th-content">
        <?php echo $SHONiR_Main['description'] ?>
      </div>    
      
  </div>
</div>
</div>
   <!-- Page Content End -->
<?php }else{
  
  if(!$Sub_Pages){
    echo '<div class="alert alert-danger" role="alert">
    Nothing Found! Your requested record not exist in database.
  </div>';
}

}?>

<?php include('includes/footer.php');?>
    
    <?php require_once('common/end.php');?> 
     
 
  </body>
</html><?php
require_once('common/clear.php');
?>