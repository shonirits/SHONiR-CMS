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

      <!-- Begin Page Content -->
      <div class="container-fluid">

        <!-- Page Heading -->
        <div class="d-sm-flex align-items-center justify-content-between mb-4">
          <h1 class="h3 mb-0 text-gray-800">Orders</h1>
          
        </div>


 <!-- DataTales Example -->
 <div class="card shadow mb-4">
            <div class="card-header py-3">
              <h6 class="m-0 font-weight-bold text-primary"></h6>
            </div>
            <div class="card-body">
              <div class="table-responsive">
              <?php 

if($SHONiR_Main['SHONiR_Get_Orders']){

?>
                <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                  <thead>
                    <tr>
                      <th>Order#</th>
                      <th>User</th>
                      <th>Reference#</th>                      
                      <th>Items</th>
                      <th>Qty</th>
                      <th>Status</th>
                      <th>Total</th>                                             
                    </tr>
                  </thead>
                  <tbody>
                    <?php 
             foreach ($SHONiR_Main['SHONiR_Get_Orders'] as $Order_key => $Order_value)
            {              
              ?>
                    <tr>
                      <td><?php echo $Order_value['order_no'] ?></td>
                      <td><?php echo SHONiR_User_Type_Fnc($Order_value['user_type']); ?></td>
                      <td><a href="<?php echo SHONiR_APANEL.'Orders/Details?order_id='.$Order_value['order_id']; ?>"><?php echo $Order_value['reference'] ?></a></td>                     
                      <td><?php echo $Order_value['items'] ?></td>
                      <td><?php echo $Order_value['quantity'] ?></td>
                      <td><?php echo SHONiR_Order_Status_Fnc($Order_value['status']); ?></td>
                      <td><?php echo SHONiR_Write_Price_Fnc($Order_value['grandtotal'], $Order_value['currency_id']); ?></td>   
                                         
                    </tr>
<?php } ?>
                  </tbody>
                </table>
                <?php }else{
                  
                  echo '<div class="alert alert-danger" role="alert">
                  Nothing Found! Your requested record not exist in database.
                </div>';
                  
                }?>
              </div>
            </div>
          </div>

      </div>
      <!-- /.container-fluid -->

    </div>
    <!-- End of Main Content -->

    <?php require_once('common/footer.php');?>

</div>
<?php require_once('common/end.php');?>
<script>

p(document).ready(function() {
  p('#dataTable').DataTable( {
        "lengthMenu": [[50, 100, 250, -1], [50, 100, 250, "All"]]
    } );
});

</script>
  </body>
</html><?php
require_once('common/clear.php');
?>