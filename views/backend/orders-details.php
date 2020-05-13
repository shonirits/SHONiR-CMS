<!doctype html>
<html lang="en">
  <head>
  <?php require_once('common/head.php');?>
  <title><?php echo $SHONiR_Main['meta_title'] ?></title>
<meta name="description" content="<?php echo $SHONiR_Main['meta_description'] ?>">
<meta name="keywords" content="<?php echo $SHONiR_Main['meta_keyword'] ?>" />
  </head>

  <body id="page-top"><?php require_once('common/start.php');?>

<!-- Page Wrapper -->
<div id="wrapper">

<?php require_once('common/top.php');?>
<form  name="SHONiR_Add_Frm" id="SHONiR_Add_Frm" method="POST" role="form" enctype='multipart/form-data' >
<input type="hidden" name="SHONiR_CSRF" id="SHONiR_CSRF" value="<?php echo $SHONiR_Main['SHONiR_CSRF'];?>">
      <!-- Begin Page Content -->
      <div class="container-fluid">

        <!-- Page Heading -->
        <div class="d-sm-flex align-items-center justify-content-between mb-4">
          <h1 class="h3 mb-0 text-gray-800">Orders : Details</h1>
          <button type="submit" class="d-none d-sm-inline-block btn btn-sm btn-primary shadow-sm"><i class="fas fa-edit fa-lg text-white-50"></i> &nbsp; Update </button>
        </div>


 <!-- DataTales Example -->

 <div class="row">
          <div class="col-md-6 col-sm-6 col-xs-12 ">
 
 <div class="card shadow mb-4"> 
            <div class="card-header py-3">
              <h6 class="m-0 font-weight-bold text-primary">Overview </h6>
            </div>
            <div class="card-body">
              <div class="table-responsive">

              <div class="mb-3"> 
          <label for="parent">Billing</label>
        
         
          </div>
               

        
              </div>
            </div>
          </div>


          <div class="card shadow mb-4">
            <div class="card-header py-3">
              <h6 class="m-0 font-weight-bold text-primary">Customer Comments:</h6>
            </div>
            <div class="card-body">
              <div class="table-responsive">
            
          <div class="mb-3">
          <label for="sort_order">Sort Order</label>
          <input type="text" class="form-control" id="sort_order" name="sort_order" placeholder="0" required="" value="">
          </div>


        
              </div>
            </div>
          </div>

          

          </div>


          <div class="col-md-6 col-sm-6 col-xs-12 ">          

 

          <div class="card shadow mb-4">
            <div class="card-header py-3">
              <h6 class="m-0 font-weight-bold text-primary">Bill To</h6>
            </div>
            <div class="card-body">
              <div class="table-responsive">
            
          <div class="mb-3">
          <label for="sort_order">Sort Order</label>
          <input type="text" class="form-control" id="sort_order" name="sort_order" placeholder="0" required="" value="">
          </div>


        
              </div>
            </div>
          </div>


          <div class="card shadow mb-4">
            <div class="card-header py-3">
              <h6 class="m-0 font-weight-bold text-primary">Ship To</h6>
            </div>
            <div class="card-body">
              <div class="table-responsive">
            
          <div class="mb-3">
          <label for="sort_order">Sort Order</label>
          <input type="text" class="form-control" id="sort_order" name="sort_order" placeholder="0" required="" value="">
          </div>


        
              </div>
            </div>
          </div>



</div>

<div class="col-md-12 col-sm-12 col-xs-12 ">
 
 <div class="card shadow mb-4"> 
            <div class="card-header py-3">
              <h6 class="m-0 font-weight-bold text-primary">Products </h6>
            </div>
            <div class="card-body">
              <div class="table-responsive">

              <div class="mb-3"> 
          <label for="parent">Billing</label>
        
         
          </div>
               

        
              </div>
            </div>
          </div>

          </div>

</form>
      </div>
      <!-- /.container-fluid -->

</form>
    </div>
    <!-- End of Main Content -->

    <?php require_once('common/footer.php');?>

</div>
<?php require_once('common/end.php');?>

<script>

  p(document).ready(function() {
 p('#parent').select2();
});

</script>

  </body>
</html><?php
require_once('common/clear.php');
?>