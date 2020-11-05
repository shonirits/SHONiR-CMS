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
        
        <?php echo $SHONiR_Main['description'] ?>
      </div>    
      
  </div>
  <div class="row th-contact">

  <div class="col">
  <form name="SHONiR_Order_Track_Frm" id="SHONiR_Order_Track_Frm" method="get" novalidate>
    
  <input type="text" id="refrence" name="refrence" value=""  placeholder="" class="form-control" aria-describedby="inputGroupPrepend" required />  

  <input type="submit" value="Track" class="btn btn-primary btn-block rounded-0 py-2">


</form>
      </div>    
      
  </div>


  <?php if(SHONiR_Get_Fnc('refrence')){ ?>

  <div class="row th-contact">
  <div class="col">

  <?php print_r($Order)?>

  </div>      
  </div>

  <?php }?>

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
(function () {  
            'use strict';  
            window.addEventListener('load', function () {  
                var form = document.getElementById('SHONiR_Contact_Frm'); 
                form.addEventListener('submit', function (event) {  
                    if (form.checkValidity() === false) {  
                        event.preventDefault();  
                        event.stopPropagation();  
                    }  
                    form.classList.add('was-validated');  
                }, false);
            }, false);  
        })(); 
 </script>
  </body>
</html><?php
require_once('common/clear.php');
?>