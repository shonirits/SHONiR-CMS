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


  <div class="container-fluid wow bounceInRight  slow" id="s-services">
  <div class="container  ">

<div class="row ">  
  <div class="col th-heading text-center">
<?php echo $SHONiR_Main['heading']?>
</div>
</div>
</div>
</div>

<!-- Brands Start -->

<?php 
if($SHONiR_Main['SHONiR_Brands']){
  $SHONiR_Records = $SHONiR_Main['SHONiR_Brands'];
 $SHONiR_Rows = $SHONiR_Records['Rows'];
?>

<div class="container-fluid s-services wow bounceInRight  slow" id="s-services">
  <div class="container  ">
  <div class="row  th-content">   

  <?php 
  $c = 0;
  foreach ($SHONiR_Rows as $key => $val)
            {
              $c++;  

              if ($c==4) {
                echo '</div> <div class="row  s-content">';
                $c=1;
              }

              
              
              
              ?>
        <div class="col  view view-eighth">

        <img src="<?php echo 'media/uploads/'.$SHONiR_Rows[$key]['image'];?>" class="img-fluid">
        <div class="mask">
                        <h2><?php echo $SHONiR_Rows[$key]['name'] ?></h2>
                        <p><?php 
                    $string = strip_tags($SHONiR_Rows[$key]['description']);
if (strlen($string) > 125) {

    $stringCut = substr($string, 0, 125);
    $endPoint = strrpos($stringCut, ' ');

    $string = $endPoint? substr($stringCut, 0, $endPoint) : substr($stringCut, 0);
    $string .= '... ';
}
echo $string;
                    ?></p>
                        <a href="<?php echo $SHONiR_Rows[$key]['href'] ?>" class="info">View Details</a>
                    </div>

       


       
</div>  
<?php }?>
        
  </div>

  <div class="clearfix"></div>
 <div class="row">
 <div class="col-sm-12 col-md-5">Showing <?php echo $SHONiR_Records['Start_Records']?> to <?php echo $SHONiR_Records['End_Records']?> of <?php echo $SHONiR_Records['Total_Records']?> entries</div>
 <div class="col-sm-12 col-md-7 ">
 <?php echo $SHONiR_Records['Pagination']?>
</div>
</div>

  </div>
</div>



<?php }else{
                 
                 if(!$Sub_Categories){
                  echo '<div class="alert alert-danger" role="alert">
                  Nothing Found! Your requested record not exist in database.
                </div>';
}
                  
                }
                ?>
 

<!-- Brands End -->

<?php include('includes/footer.php');?>
    
    <?php require_once('common/end.php');?> 
     
 
  </body>
</html><?php
require_once('common/clear.php');
?>