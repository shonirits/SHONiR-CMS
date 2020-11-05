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
          <h1 class="h3 mb-0 text-gray-800">Blogs Categories</h1>
          <a href="<?php echo SHONiR_APANEL.'Blogs_Categories/Add'; ?>" class="d-none d-sm-inline-block btn btn-sm btn-primary shadow-sm"><i class="fas fa-plus fa-lg text-white-50"></i> &nbsp; Add Blogs Category</a>
        </div>


 <!-- DataTales Example -->
 <div class="card shadow mb-4">
            <div class="card-header py-3">
              <h6 class="m-0 font-weight-bold text-primary"></h6>
            </div>
            <div class="card-body">
              <div class="table-responsive">
              <?php 

if($SHONiR_Main['SHONiR_Get_Categories']){

?>
                <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                  <thead>
                    <tr>
                      <th>Name</th>
                      <th>Parent</th>                      
                      <th>Child</th>
                      <th>Products</th>
                      <th>Sort Order</th>
                      <th>Status</th>
                      <th>Listed</th>
                      <!--th>Locked</th-->
                      <th>Featured</th>
                      <th>Action</th>
                    </tr>
                  </thead>
                  <tbody>
                    <?php foreach ($SHONiR_Main['SHONiR_Get_Categories'] as $Category_key => $Category_value)
            {?>
                    <tr>
                      <td><?php echo $Category_value['name'] ?></td>
                      <td><?php echo $Category_value['slug'] ?></td>                     
                      <td><a href=""><?php echo 0 ?></a></td>
                      <td><a href=""><?php echo 0 ?></a></td>
                      <td><?php echo $Category_value['sort_order'] ?></td>
                      <td><i class="fas fa-<?php echo ($Category_value['status']==1)?'check':'times'; ?> fa-lg "></i><span class="none"><?php echo $Category_value['status'] ?></span></td>
                      <td><i class="fas fa-<?php echo ($Category_value['listed']==1)?'check':'times'; ?> fa-lg "></i><span class="none"><?php echo $Category_value['listed'] ?></span></td>
                      <!--td><i class="fas fa-<?php echo ($Category_value['locked']==1)?'check':'times'; ?> fa-lg "></i><span class="none"><?php echo $Category_value['locked'] ?></span></td-->
                      <td><i class="fas fa-<?php echo ($Category_value['featured']==1)?'check':'times'; ?> fa-lg "></i><span class="none"><?php echo $Category_value['featured'] ?></span></td>
                      <td> <a href="<?php echo SHONiR_APANEL.'Blogs_Categories/Edit?category_id='.$Category_value['category_id']; ?>" class="d-none d-sm-inline-block btn btn-sm btn-secondary shadow-sm"><i class="fas fa-edit fa-lg text-white-50"></i></a> <a href="javascript:SHONiR_Confirm_Fnc('Delete Category', 'Are you sure to delete this category?', '<?php echo SHONiR_APANEL.'Blogs_Categories/Delete?category_id='.$Category_value['category_id']; ?>')" class="d-none d-sm-inline-block btn btn-sm btn-danger shadow-sm"><i class="fas fa-trash fa-lg text-white-50"></i></a></td>
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