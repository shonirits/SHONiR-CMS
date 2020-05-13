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
          <h1 class="h3 mb-0 text-gray-800">Products</h1>
          <a href="<?php echo SHONiR_APANEL.'Products/Add'; ?>" class="d-none d-sm-inline-block btn btn-sm btn-primary shadow-sm"><i class="fas fa-plus fa-lg text-white-50"></i> &nbsp; Add Product</a>
        </div>


 <!-- DataTales Example -->
 <div class="card shadow mb-4">
            <div class="card-header py-3">
              <h6 class="m-0 font-weight-bold text-primary"></h6>
            </div>
            <div class="card-body">
              <div class="table-responsive">
              <?php 

if($SHONiR_Main['SHONiR_Get_Products']){

?>
                <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                  <thead>
                    <tr>
                      <th>Name</th>
                      <th>Image</th>                      
                      <th>Model</th>
                      <th>Price</th>
                      <th>Sort Order</th>
                      <th>Reference</th>
                      <!--th>Status</th>
                      <th>Listed</th>
                      <th>Searchable</th>
                      <th>Featured</th-->
                      <th>Action</th>
                    </tr>
                  </thead>
                  <tbody>
                    <?php foreach ($SHONiR_Main['SHONiR_Get_Products'] as $Product_key => $Product_value)
            {?>
                    <tr>
                      <td><?php echo $Product_value['name'] ?></td>
                      <td><img height="100" src="<?php echo SHONiR_Write_Uploads_Fnc($Product_value['image']) ?>" ></td>                     
                      <td><?php echo $Product_value['model'] ?></td>
                      <td><?php echo $Product_value['selling_price'] ?></td>
                      <td><?php echo $Product_value['sort_order'] ?></td>
                      <td><?php echo $Product_value['reference'] ?></td>
                      <!--td><i class="fas fa-<?php echo ($Product_value['status']==1)?'check':'times'; ?> fa-lg "></i><span class="none"><?php echo $Product_value['status'] ?></span></td>
                      <td><i class="fas fa-<?php echo ($Product_value['listed']==1)?'check':'times'; ?> fa-lg "></i><span class="none"><?php echo $Product_value['listed'] ?></span></td>
                      <td><i class="fas fa-<?php echo ($Product_value['searchable']==1)?'check':'times'; ?> fa-lg "></i><span class="none"><?php echo $Product_value['searchable'] ?></span></td>
                      <td><i class="fas fa-<?php echo ($Product_value['featured']==1)?'check':'times'; ?> fa-lg "></i><span class="none"><?php echo $Product_value['featured'] ?></span></td-->
                      <td> <a href="<?php echo SHONiR_APANEL.'Products/Edit?product_id='.$Product_value['product_id']; ?>" class="d-none d-sm-inline-block btn btn-sm btn-secondary shadow-sm"><i class="fas fa-edit fa-lg text-white-50"></i></a> <a href="javascript:SHONiR_Confirm_Fnc('Delete Page', 'Are you sure to delete this Page?', '<?php echo SHONiR_APANEL.'Products/Delete?product_id='.$Product_value['product_id']; ?>')" class="d-none d-sm-inline-block btn btn-sm btn-danger shadow-sm"><i class="fas fa-trash fa-lg text-white-50"></i></a></td>
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