<?php 
$SHONiR_Order_Details = $SHONiR_Main['SHONiR_Order_Details'];

$SHONiR_Order = $SHONiR_Order_Details['Order'];
$SHONiR_Products = $SHONiR_Order_Details['Products'];

$SHONiR_bill_country = SHONiR_Countries_Fnc($SHONiR_Order['bill_country_id']);
if($SHONiR_bill_country){
$SHONiR_bill_country = $SHONiR_bill_country[0]['name'];
}else{
  $SHONiR_bill_country = ''; 
}

$SHONiR_bill_region = SHONiR_Regions_Fnc($SHONiR_Order['bill_region_id']);
if($SHONiR_bill_region){
$SHONiR_bill_region = $SHONiR_bill_region[0]['name'];
}else{
  $SHONiR_bill_region = ''; 
}
$SHONiR_bill_city = SHONiR_Cities_Fnc($SHONiR_Order['bill_city_id']);
if($SHONiR_bill_city){
$SHONiR_bill_city = $SHONiR_bill_city[0]['name'];
}else{
  $SHONiR_bill_city = ''; 
}
$SHONiR_ship_country = SHONiR_Countries_Fnc($SHONiR_Order['ship_country_id']);
if($SHONiR_ship_country){
$SHONiR_ship_country = $SHONiR_ship_country[0]['name'];
}else{
  $SHONiR_ship_country = ''; 
}
$SHONiR_ship_region = SHONiR_Regions_Fnc($SHONiR_Order['ship_region_id']);
if($SHONiR_ship_region){
$SHONiR_ship_region = $SHONiR_ship_region[0]['name'];
}else{
  $SHONiR_ship_region = ''; 
}
$SHONiR_ship_city = SHONiR_Cities_Fnc($SHONiR_Order['ship_city_id']);
if($SHONiR_ship_city){
$SHONiR_ship_city = $SHONiR_ship_city[0]['name'];
}else{
  $SHONiR_ship_city = ''; 
}

$SHONiR_User_Type = SHONiR_User_Type_Fnc($SHONiR_Order['user_type']);  

?><!doctype html>
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
              <?php echo 'Order ID: '.$SHONiR_Order['order_id']; 
              echo '</br>Order# '.$SHONiR_Order['order_no'];
              echo '</br>Reference# '.$SHONiR_Order['reference'];
              echo '</br>Order Time: '.date("l, F t, Y H:i:s ", $SHONiR_Order['add_time']);
               echo '</br>User Type: '. $SHONiR_User_Type;
              ?>
         
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
          <?php echo $SHONiR_Order['user_comments']; ?>
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
          <?php echo 'Name: '.$SHONiR_Order['bill_name'];
          echo '<br/>Cell: '.$SHONiR_Order['bill_cell'];
          echo '<br/>Email: '.$SHONiR_Order['bill_email'];
          echo '<br/>Address: '.$SHONiR_Order['bill_address'].'<br/> City: '.$SHONiR_bill_city.'<br/> Region: '.$SHONiR_bill_region.'<br/> Country: '.$SHONiR_bill_country; ?>
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
          <?php 
          echo 'Name: '.$SHONiR_Order['ship_name'];
          echo '<br/>Cell: '.$SHONiR_Order['ship_cell'];
          echo '<br/>Email: '.$SHONiR_Order['ship_email'];
          echo '<br/>Address: '.$SHONiR_Order['ship_address'].'<br/> City: '.$SHONiR_ship_city.'<br/> Region: '.$SHONiR_ship_region.'<br/> Country:  '.$SHONiR_ship_country;; ?> </div>


        
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

              <table class="table table-bordered">
  <thead class="table-dark">
    <tr>
      <th scope="col" class="text-center">Image</th>
      <th scope="col">Product Details</th>
      <th scope="col" class="text-center">Quantity</th>
      <th scope="col" class="text-center">Unit&nbsp;Price</th>
      <th scope="col" class="text-right">Total</th>
    </tr>
  </thead>

  
  <tbody>
              <?php 
              $SHONiR_Order_Quantity = 0;
              $SHONiR_Order_Subtotal = 0;
              $SHONiR_Order_Items = 0;
              foreach ($SHONiR_Products as $key => $val){

                $SHONiR_Order_Quantity += $SHONiR_Products[$key]['quantity'];
                $SHONiR_Order_Subtotal += $SHONiR_Products[$key]['selling_price']*$SHONiR_Products[$key]['quantity'];
                $SHONiR_Order_Items++;
    ?>
  <div class="row" id="cart_product_<?php echo $SHONiR_Products[$key]['id']?>">
  <tr class="col-md-1 text-center">
  
  <td><a href="<?php echo SHONiR_BASE.'Go/Pr/'.$SHONiR_Products[$key]['product_id']; ?>"><img src="<?php echo SHONiR_Write_Uploads_Fnc($SHONiR_Products[$key]['image']) ?>" alt="" title="" class="img-thumbnail" style=" min-width: 100px; max-width: 100px; min-height: 100px; max-height: 100px;"></a> </td>

<td class="col-md-5 text-left"><a href="<?php echo SHONiR_BASE.'Go/Pr/'.$SHONiR_Products[$key]['product_id']; ?>"><?php echo $SHONiR_Products[$key]['name']?></a>
<p><?php echo 'Reference#: '.$SHONiR_Products[$key]['reference']?></p>
</td>

<td class="col-md-2"> <?php echo $SHONiR_Products[$key]['quantity']?> </td>
<td class="text-center col-md-2"><?php echo SHONiR_Write_Price_Fnc($SHONiR_Products[$key]['selling_price'], $SHONiR_Order['currency_id']); ?></td>

<td class="text-right col-md-2"><?php echo SHONiR_Write_Price_Fnc($SHONiR_Products[$key]['selling_price']*$SHONiR_Products[$key]['quantity'], $SHONiR_Order['currency_id']); ?></td>  
</tr>                            
  </div>
<?php } ?>
</tbody>
<thead class="thead-light">
    <tr>      
      <th scope="col" colspan="2">Total Items: <?php echo $SHONiR_Order_Items; ?></th>
      <th scope="col" class="text-center">Total Quantity: <?php echo $SHONiR_Order_Quantity; ?></th>
      <th scope="col" colspan="2" class="text-right">Sub Total: <?php echo SHONiR_Write_Price_Fnc($SHONiR_Order_Subtotal, $SHONiR_Order['currency_id']); ?></th>
    </tr>
  </thead>
</table>
<?php 
$SHONiR_Order_Shipping = SHONiR_Shipping_Fnc($SHONiR_Order_Subtotal);
$SHONiR_Order_Tax = SHONiR_Tax_Fnc($SHONiR_Order_Shipping+$SHONiR_Order_Subtotal);
$SHONiR_Order_Grand = $SHONiR_Order_Subtotal + $SHONiR_Order_Shipping + $SHONiR_Order_Tax;

?>
<table class="table table-bordered">
<tbody>
<tr>
<td>Shipping:</td>
<td><?php echo ($SHONiR_Order_Shipping>0)?SHONiR_Write_Price_Fnc($SHONiR_Order_Shipping, $SHONiR_Order['currency_id']):'<b>FREE</b>';;?></td>
</tr>
<tr>
<td>Tax:</td>
<td><?php echo ($SHONiR_Order_Tax>0)?SHONiR_Write_Price_Fnc($SHONiR_Order_Tax, $SHONiR_Order['currency_id']):'<b>NONE</b>';?></td>
</tr>
<tr>
<td><b>Grand Total:</b></td>
<td><b><?php echo SHONiR_Write_Price_Fnc($SHONiR_Order_Grand, $SHONiR_Order['currency_id']); ?></b></td>
</tr>
</tbody>
</table>
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