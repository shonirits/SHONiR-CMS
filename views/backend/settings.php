<?php $SHONiR_Second =  SHONiR_URI['Second']; ?><!doctype html>
<html lang="en">
  <head>
  <?php require_once('common/head.php');?>
  <title><?php echo $SHONiR_Main['meta_title'] ?></title>
<meta name="description" content="<?php echo $SHONiR_Main['meta_description'] ?>">
<meta name="keywords" content="<?php echo $SHONiR_Main['meta_keyword'] ?>" />
  </head>

  <body id="page-top"><?php require_once('common/start.php');?>

<!-- Brand Wrapper -->
<div id="wrapper">

<?php require_once('common/top.php');?>
<?php if(isset($SHONiR_Main['SHONiR_CSRF'])){?>
<form  name="SHONiR_Add_Frm" id="SHONiR_Add_Frm" method="POST" role="form" enctype='multipart/form-data' >
<input type="hidden" name="SHONiR_CSRF" id="SHONiR_CSRF" value="<?php echo $SHONiR_Main['SHONiR_CSRF'];?>">
<?php }?>  <!-- Begin Brand Content -->
      <div class="container-fluid">

        <!-- Brand Heading -->
        <div class="d-sm-flex align-items-center justify-content-between mb-4">
          <h1 class="h3 mb-0 text-gray-800">Settings <?php echo (isset($SHONiR_Main['page_heading']))?': '.$SHONiR_Main['page_heading']:''; ?></h1>
          <?php if(isset($SHONiR_Main['SHONiR_CSRF'])){?>
           <button type="submit" class="d-none d-sm-inline-block btn btn-sm btn-primary shadow-sm" ><i class="fas fa-edit fa-lg text-white-50"></i> &nbsp; Update </button>
           <?php }?></div>


 <!-- DataTales Example -->

 <div class="row">

<?php if($SHONiR_Second == "Code"){ ?>

          <div class="col-md-12 col-sm-12 col-xs-12">

          <div class="card shadow mb-4">
            <div class="card-header py-3">
              <h6 class="m-0 font-weight-bold text-primary">Header</h6>
            </div>
            <div class="card-body">
              <div class="table-responsive">

          <div class="mb-3">
          <textarea type="text" rows="19" class="form-control" id="header" name="header" placeholder="Header HTML" ><?php echo SHONiR_SETTINGS['code_header']?></textarea>
          </div>

              </div>
            </div>
          </div>

          <div class="card shadow mb-4">
            <div class="card-header py-3">
              <h6 class="m-0 font-weight-bold text-primary">Footer</h6>
            </div>
            <div class="card-body">
              <div class="table-responsive">

          <div class="mb-3">
          <textarea type="text" rows="19" class="form-control" id="footer" name="footer" placeholder="Footer HTML" ><?php echo SHONiR_SETTINGS['code_footer']?></textarea>
          </div>

              </div>
            </div>
          </div>

          </div>

          <?php }elseif($SHONiR_Second == "Website"){ ?>

            <div class="col-md-8 col-sm-8 col-xs-12 ">

 <div class="card shadow mb-4">
            <div class="card-header py-3">
              <h6 class="m-0 font-weight-bold text-primary">Company Information </h6>
            </div>
            <div class="card-body">
              <div class="table-responsive">

              <div class="mb-3">
          <label for="company"> Company Name</label>
          <input type="text" class="form-control" id="company" name="company" placeholder="Shonir Corporation" value="<?php echo SHONiR_SETTINGS['website_company'] ?>">
          </div>

          <div class="mb-3">
          <label for="email">Email</label>
          <input type="text" class="form-control" id="email" name="email" placeholder="info@shonir.com"  value="<?php echo SHONiR_SETTINGS['website_email'] ?>">
          </div>

          <div class="mb-3">
          <label for="telephone">Phone</label>
          <input type="text" class="form-control" id="telephone" name="telephone" placeholder="+923333336426"  value="<?php echo SHONiR_SETTINGS['website_telephone'] ?>">
          </div>

          <div class="mb-3">
          <label for="url"> URL</label>
          <input type="text" class="form-control" id="url" name="url" placeholder="www.shonir.com"  value="<?php echo SHONiR_SETTINGS['website_url'] ?>">
          </div>

          <div class="mb-3">
          <label for="address"> Address</label>
          <textarea type="text" class="form-control" id="address" name="address" placeholder="Gohdpur, Mian Street, Sialkot - 51310, Punjab, Pakistan."> <?php echo SHONiR_SETTINGS['website_address'] ?></textarea>
          </div>



              </div>
            </div>
          </div>



          </div>


          <div class="col-md-4 col-sm-4 col-xs-12 ">



          <div class="card shadow mb-4">
            <div class="card-header py-3">
              <h6 class="m-0 font-weight-bold text-primary">Contact Person</h6>
            </div>
            <div class="card-body">
              <div class="table-responsive">

              <div class="mb-3">
          <label for="contact_name"> Contact Name</label>
          <input type="text" class="form-control" id="contact_name" name="contact_name" placeholder="Mian Shoaib" value="<?php echo SHONiR_SETTINGS['website_contact_name'] ?>">
          </div>


          <div class="mb-3">
          <label for="contact_type">Contact Type</label>
          <input type="text" class="form-control" id="contact_type" name="contact_type" placeholder="Sales Manager" value="<?php echo SHONiR_SETTINGS['website_contact_type'] ?>" >
          </div>



              </div>
            </div>
          </div>


          <div class="card shadow mb-4">
            <div class="card-header py-3">
              <h6 class="m-0 font-weight-bold text-primary">Google Map</h6>
            </div>
            <div class="card-body">
              <div class="table-responsive">


          <div class="mb-3">
          <label for="latitude"> Latitude</label>
          <input type="text" class="form-control" id="latitude" name="latitude" placeholder="32.4878603" value="<?php echo SHONiR_SETTINGS['website_latitude'] ?>">
          </div>


          <div class="mb-3">
          <label for="longitude">Longitude</label>
          <input type="text" class="form-control" id="longitude" name="longitude" placeholder="74.558045" value="<?php echo SHONiR_SETTINGS['website_longitude'] ?>" >
          </div>



              </div>
            </div>
          </div>


          </div>

</div>


<?php }elseif($SHONiR_Second == "SMTP"){ ?>

<div class="col-md-12 col-sm-12 col-xs-12 ">

<div class="card shadow mb-4">
<div class="card-header py-3">
  <h6 class="m-0 font-weight-bold text-primary">Server Information </h6>
</div>
<div class="card-body">
  <div class="table-responsive">

  <div class="mb-3">
<label for="host"> Hostname</label>
<input type="text" class="form-control" id="host" name="host" placeholder="ns.shonir.com" value="<?php echo SHONiR_SETTINGS['smtp_host'] ?>">
</div>

<div class="mb-3">
<label for="username">Username</label>
<input type="text" class="form-control" id="username" name="username" placeholder="shonirits"  value="<?php echo SHONiR_SETTINGS['smtp_username'] ?>">
</div>

<div class="mb-3">
<label for="password">Password</label>
<input type="text" class="form-control" id="password" name="password" placeholder="M!@n6426"  value="<?php echo SHONiR_SETTINGS['smtp_password'] ?>">
</div>

<div class="mb-3">
<label for="port"> Port</label>
<input type="text" class="form-control" id="port" name="port" placeholder="587"  value="<?php echo SHONiR_SETTINGS['smtp_port'] ?>">
</div>

<div class="mb-3">
<label for="encryption"> Encryption</label>
<input type="text" class="form-control" id="encryption" name="encryption" placeholder="tls"  value="<?php echo SHONiR_SETTINGS['smtp_encryption'] ?>">
</div>

<div class="mb-3">
<label for="from"> From</label>
<input type="text" class="form-control" id="from" name="from" placeholder="notify@shonir.com"  value="<?php echo SHONiR_SETTINGS['smtp_from'] ?>">
</div>






  </div>
</div>
</div>



</div>


</div>

<?php }elseif($SHONiR_Second == "Social"){ ?>

  <div class="col-md-12 col-sm-12 col-xs-12">

<div class="card shadow mb-4">
  <div class="card-header py-3">
    <h6 class="m-0 font-weight-bold text-primary">Social Links</h6>
  </div>
  <div class="card-body">
    <div class="table-responsive">

    <div class="mb-3">
          <label for="facebook"> Facebook</label>
          <input type="text" class="form-control" id="facebook" name="facebook" placeholder="Facebook" required="" value="<?php echo SHONiR_SETTINGS['social_facebook'] ?>">
          </div>

          <div class="mb-3">
          <label for="skype"> Skype</label>
          <input type="text" class="form-control" id="skype" name="skype" placeholder="Skype" required="" value="<?php echo SHONiR_SETTINGS['social_skype'] ?>">
          </div>


          <div class="mb-3">
          <label for="twitter"> Twitter</label>
          <input type="text" class="form-control" id="twitter" name="twitter" placeholder="Twitter" required="" value="<?php echo SHONiR_SETTINGS['social_twitter'] ?>">
          </div>

          <div class="mb-3">
          <label for="instagram"> Instagram</label>
          <input type="text" class="form-control" id="instagram" name="instagram" placeholder="Instagram" required="" value="<?php echo SHONiR_SETTINGS['social_instagram'] ?>">
          </div>

          <div class="mb-3">
          <label for="pinterest"> Pinterest</label>
          <input type="text" class="form-control" id="pinterest" name="pinterest" placeholder="Pinterest" required="" value="<?php echo SHONiR_SETTINGS['social_pinterest'] ?>">
          </div>

          <div class="mb-3">
          <label for="youtube"> Youtube</label>
          <input type="text" class="form-control" id="youtube" name="youtube" placeholder="Youtube" required="" value="<?php echo SHONiR_SETTINGS['social_youtube'] ?>">
          </div>

          <div class="mb-3">
          <label for="linkedin"> Linkedin</label>
          <input type="text" class="form-control" id="linkedin" name="linkedin" placeholder="Linkedin" required="" value="<?php echo SHONiR_SETTINGS['social_linkedin'] ?>">
          </div>

    </div>
  </div>
</div>

</div>

<?php }elseif($SHONiR_Second == "Other"){ ?>

<div class="col-md-8 col-sm-8 col-xs-12 ">

<div class="card shadow mb-4">
<div class="card-header py-3">
  <h6 class="m-0 font-weight-bold text-primary">Website Statistics </h6>
</div>
<div class="card-body">
  <div class="table-responsive">

<div class="mb-3">
<label for="visitors"> Visitors</label>
<input type="number" class="form-control" id="visitors" name="visitors" placeholder="0" value="<?php echo SHONiR_SETTINGS['counter_visitors'] ?>">
</div>

<div class="mb-3">
<label for="pageviews"> Pageviews</label>
<input type="number" class="form-control" id="pageviews" name="pageviews" placeholder="0" value="<?php echo SHONiR_SETTINGS['counter_pageviews'] ?>">
</div>

<div class="mb-3">
<label for="copyrights"> Copyrights</label>
<input type="number" class="form-control" id="copyrights" name="copyrights" placeholder="0" value="<?php echo SHONiR_SETTINGS['config_copyrights'] ?>">
</div>

<div class="mb-3">
<label for="copyrights"> SSL</label>
<select class="form-control" id="ssl" name="ssl">
          <option value="NONE" <?php echo (SHONiR_SETTINGS['config_ssl'] == 'NONE')?'selected="selected" selected':''; ?>>NONE</option>
          <option value="STRICT" <?php echo (SHONiR_SETTINGS['config_ssl'] == 'STRICT')?'selected="selected" selected':''; ?>>STRICT</option>
          <option value="FLEXIBLE" <?php echo (SHONiR_SETTINGS['config_ssl'] == 'FLEXIBLE')?'selected="selected" selected':''; ?>>FLEXIBLE</option>
          </select>
</div>

<div class="mb-3">
<label for="copyrights"> WWW</label>
<select class="form-control" id="www" name="www">
<option value="NONE" <?php echo (SHONiR_SETTINGS['config_www'] == 'NONE')?'selected="selected" selected':''; ?>>NONE</option>
          <option value="STRICT" <?php echo (SHONiR_SETTINGS['config_www'] == 'STRICT')?'selected="selected" selected':''; ?>>STRICT</option>
          <option value="FLEXIBLE" <?php echo (SHONiR_SETTINGS['config_www'] == 'FLEXIBLE')?'selected="selected" selected':''; ?>>FLEXIBLE</option>
          </select></div>

          <div class="mb-3">
<label for="buffering" class="d-none d-sm-inline-block btn btn-sm btn-secondary shadow-sm">Buffering <input type="checkbox" id="buffering" name="buffering" value="TRUE" class="badgebox" <?php echo (SHONiR_SETTINGS['config_buffering'] == 'TRUE')?'checked="checked" checked':''; ?>><span class="badge">&check;</span></label>
</div>

<div class="mb-3">
<label for="auto_watermark" class="d-none d-sm-inline-block btn btn-sm btn-secondary shadow-sm">Auto Image Watermark <input type="checkbox" id="auto_watermark" name="auto_watermark" value="TRUE" class="badgebox" <?php echo (SHONiR_SETTINGS['config_auto_watermark'] == "TRUE")?'checked="checked" checked':''; ?>><span class="badge">&check;</span></label>
</div>

<div class="mb-3">
<label for="auto_resize" class="d-none d-sm-inline-block btn btn-sm btn-secondary shadow-sm">Auto Image Resize <input type="checkbox" id="auto_resize" name="auto_resize" value="TRUE" class="badgebox" <?php echo (SHONiR_SETTINGS['config_auto_resize'] == 'TRUE')?'checked="checked" checked':''; ?>><span class="badge">&check;</span></label>
</div>


<div class="mb-3">
<label for="cache" class="d-none d-sm-inline-block btn btn-sm btn-secondary shadow-sm">Cache <input type="checkbox" id="cache" name="cache" value="TRUE" class="badgebox" <?php echo (SHONiR_SETTINGS['config_cache'] == 'TRUE')?'checked="checked" checked':''; ?>><span class="badge">&check;</span></label>
</div>


<div class="mb-3">
<label for="sef" class="d-none d-sm-inline-block btn btn-sm btn-secondary shadow-sm">Search Engine Friendly <input type="checkbox" id="sef" name="sef" value="TRUE" class="badgebox" <?php echo (SHONiR_SETTINGS['config_sef'] == 'TRUE')?'checked="checked" checked':''; ?>><span class="badge">&check;</span></label>
</div>

<div class="mb-3">
<label for="error_reporting"> Error Reporting</label>
<input type="text" class="form-control" id="error_reporting" name="error_reporting" placeholder="E_ALL" value="<?php echo SHONiR_SETTINGS['config_error_reporting'] ?>">

</div>



<div class="mb-3">
<label for="cache_life"> Cache Life</label>
<input type="number" class="form-control" id="cache_life" name="cache_life" placeholder="1" value="<?php echo SHONiR_SETTINGS['config_cache_life'] ?>"> 1 equal to an hour
</div>

<div class="mb-3">
<label for="large_image"> Large Image</label>
<input type="number" class="form-control" id="large_image" name="large_image" placeholder="600" value="<?php echo SHONiR_SETTINGS['config_large_image'] ?>">
</div>

<div class="mb-3">
<label for="small_image"> Small Image</label>
<input type="number" class="form-control" id="small_image" name="small_image" placeholder="300" value="<?php echo SHONiR_SETTINGS['config_small_image'] ?>">
</div>

<div class="mb-3">
<label for="adjust"> Adjust</label>
<input type="number" class="form-control" id="adjust" name="adjust" placeholder="2" value="<?php echo SHONiR_SETTINGS['config_adjust'] ?>">
</div>

<div class="mb-3">
<label for="records_limit"> Page Records Limit</label>
<input type="number" class="form-control" id="records_limit" name="records_limit" placeholder="12" value="<?php echo SHONiR_SETTINGS['config_records_limit'] ?>">
</div>

<div class="mb-3">
<label for="pages_limit"> Pages Limit</label>
<input type="number" class="form-control" id="pages_limit" name="pages_limit" placeholder="4" value="<?php echo SHONiR_SETTINGS['config_pages_limit'] ?>">
</div>



  </div>
</div>
</div>



</div>


<div class="col-md-4 col-sm-4 col-xs-12 ">



<div class="card shadow mb-4">
<div class="card-header py-3">
  <h6 class="m-0 font-weight-bold text-primary">Logo</h6>
</div>
<div class="card-body">
  <div class="table-responsive">

  <fieldset class="form-group">
          <button type="button" class="d-none d-sm-inline-block btn btn-sm btn-info shadow-sm" onclick="p('#logo-image').click()"><i class="fas fa-upload fa-sm text-white-50"></i> Select Image </button>
        <input type="file" id="logo-image" name="logo" style="display: none;" class="form-control" >
    </fieldset>
    <div class="preview-logo-image">
<?php if(SHONiR_SETTINGS['config_logo']){?>
    <div class="preview-image " >
                            <div class="image-zone"><img  src="<?php echo 'media/uploads/'.SHONiR_SETTINGS['config_logo']; ?>"></div>
                            <div class="tools-edit-image"><a data-fancybox="images" href="<?php echo 'media/uploads/'.SHONiR_SETTINGS['config_logo']; ?>"  class="btn btn-info btn-edit-image"><i class="fas fa-search-plus fa-lg text-white-50"></i></a></div>
                            </div>
<?php }?>
    </div>


  </div>
</div>
</div>


<div class="card shadow mb-4">
<div class="card-header py-3">
  <h6 class="m-0 font-weight-bold text-primary">Icon</h6>
</div>
<div class="card-body">
  <div class="table-responsive">

  <fieldset class="form-group">
          <button type="button" class="d-none d-sm-inline-block btn btn-sm btn-info shadow-sm" onclick="p('#icon-image').click()"><i class="fas fa-upload fa-sm text-white-50"></i> Select Image </button>
        <input type="file" id="icon-image" name="icon" style="display: none;" class="form-control" >
    </fieldset>
    <div class="preview-icon-image">
<?php if(SHONiR_SETTINGS['config_icon']){?>
    <div class="preview-image " >
                            <div class="image-zone"><img  src="<?php echo 'media/uploads/'.SHONiR_SETTINGS['config_icon']; ?>"></div>
                            <div class="tools-edit-image"><a data-fancybox="images" href="<?php echo 'media/uploads/'.SHONiR_SETTINGS['config_icon']; ?>"  class="btn btn-info btn-edit-image"><i class="fas fa-search-plus fa-lg text-white-50"></i></a></div>
                            </div>
<?php }?>
    </div>


  </div>
</div>
</div>

<div class="card shadow mb-4">
<div class="card-header py-3">
  <h6 class="m-0 font-weight-bold text-primary">Loader</h6>
</div>
<div class="card-body">
  <div class="table-responsive">

  <fieldset class="form-group">
          <button type="button" class="d-none d-sm-inline-block btn btn-sm btn-info shadow-sm" onclick="p('#loader-image').click()"><i class="fas fa-upload fa-sm text-white-50"></i> Select Image </button>
        <input type="file" id="loader-image" name="loader" style="display: none;" class="form-control" >
    </fieldset>
    <div class="preview-loader-image">
<?php if(SHONiR_SETTINGS['config_loader']){?>
    <div class="preview-image " >
                            <div class="image-zone"><img  src="<?php echo 'media/uploads/'.SHONiR_SETTINGS['config_loader']; ?>"></div>
                            <div class="tools-edit-image"><a data-fancybox="images" href="<?php echo 'media/uploads/'.SHONiR_SETTINGS['config_loader']; ?>"  class="btn btn-info btn-edit-image"><i class="fas fa-search-plus fa-lg text-white-50"></i></a></div>
                            </div>
<?php }?>
    </div>


  </div>
</div>
</div>

<div class="card shadow mb-4">
<div class="card-header py-3">
  <h6 class="m-0 font-weight-bold text-primary">Watermark</h6>
</div>
<div class="card-body">
  <div class="table-responsive">

  <fieldset class="form-group">
          <button type="button" class="d-none d-sm-inline-block btn btn-sm btn-info shadow-sm" onclick="p('#watermark-image').click()"><i class="fas fa-upload fa-sm text-white-50"></i> Select Image </button>
        <input type="file" id="watermark-image" name="watermark" style="display: none;" class="form-control" >
    </fieldset>
    <div class="preview-watermark-image">
<?php if(SHONiR_SETTINGS['config_watermark']){?>
    <div class="preview-image " >
                            <div class="image-zone"><img  src="<?php echo 'media/uploads/'.SHONiR_SETTINGS['config_watermark']; ?>"></div>
                            <div class="tools-edit-image"><a data-fancybox="images" href="<?php echo 'media/uploads/'.SHONiR_SETTINGS['config_watermark']; ?>"  class="btn btn-info btn-edit-image"><i class="fas fa-search-plus fa-lg text-white-50"></i></a></div>
                            </div>
<?php }?>
    </div>


  </div>
</div>
</div>


</div>

</div>
<?php }else{?>
  <div class="col-md-12 col-sm-12 col-xs-12">

  <div class="card shadow mb-4">
            <div class="card-header py-3">
              <h6 class="m-0 font-weight-bold text-primary"></h6>
            </div>
            <div class="card-body">
              <div class="table-responsive">
              <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                  <thead>
                    <tr>
                      <th>Name</th>
                      <th>Details</th>
                      <th>Action</th>
                    </tr>
                  </thead>
                  <tbody>
                  <tr>
                      <td>Website Information</td>
                      <td>Company Name, Email, Telephone, Address, Google Map etc.</td>
                        <td> <a href="<?php echo SHONiR_APANEL.'Settings/Website'; ?>" class="d-none d-sm-inline-block btn btn-sm btn-secondary shadow-sm"><i class="fas fa-edit fa-lg text-white-50"></i></a></td>
                    </tr>

                    <tr>
                      <td>Sending Email Server</td>
                      <td>Hostname, Username, Password etc.</td>
                        <td> <a href="<?php echo SHONiR_APANEL.'Settings/SMTP'; ?>" class="d-none d-sm-inline-block btn btn-sm btn-secondary shadow-sm"><i class="fas fa-edit fa-lg text-white-50"></i></a></td>
                    </tr>

                    <tr>
                      <td>Social Networking</td>
                      <td>Facebook, Twitter, Linkedin etc.</td>
                        <td> <a href="<?php echo SHONiR_APANEL.'Settings/Social'; ?>" class="d-none d-sm-inline-block btn btn-sm btn-secondary shadow-sm"><i class="fas fa-edit fa-lg text-white-50"></i></a></td>
                    </tr>

                    <tr>
                      <td>HTML Code</td>
                      <td>Add Javascript, CSS or HTML Code into Header and Footer.</td>
                        <td> <a href="<?php echo SHONiR_APANEL.'Settings/Social'; ?>" class="d-none d-sm-inline-block btn btn-sm btn-secondary shadow-sm"><i class="fas fa-edit fa-lg text-white-50"></i></a></td>
                    </tr>

                    <tr>
                      <td>Other</td>
                      <td>Website Statistics, Website Logo, Icon and Product Watermark etc.</td>
                        <td> <a href="<?php echo SHONiR_APANEL.'Settings/Other'; ?>" class="d-none d-sm-inline-block btn btn-sm btn-secondary shadow-sm"><i class="fas fa-edit fa-lg text-white-50"></i></a></td>
                    </tr>

                    </tbody>
                </table>


              </div>
            </div>
          </div>
          </div>

<?php }?>
<?php if(isset($SHONiR_Main['SHONiR_CSRF'])){?>
</form>
<?php }?>
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
  document.getElementById('logo-image').addEventListener('change', SHONiR_Single_Image_Fnc, false);
  document.getElementById('icon-image').addEventListener('change', SHONiR_Single_Image_Fnc, false);
  document.getElementById('watermark-image').addEventListener('change', SHONiR_Single_Image_Fnc, false);
  document.getElementById('loader-image').addEventListener('change', SHONiR_Single_Image_Fnc, false);

  function SHONiR_Single_Image_Fnc() {

    if (window.File && window.FileList && window.FileReader) {

      var e = p(this);
      var et = event.target;
      var file = et.files;
      var count = file.length;
      var path = et.value;
      var extn = path.substring(path.lastIndexOf('.') + 1).toLowerCase();
      var output = p(".preview-"+et.id);

      if (extn == "gif" || extn == "png" || extn == "jpg" || extn == "jpeg" || extn == "ico") {

        var reader = new FileReader();

        reader.onload = function (event) {

          var picFile = event.target;
                var html =  '<div class="preview-image " >' +
                            '<div class="image-zone"><img  src="' + picFile.result + '"></div>' +
                            '<div class="tools-edit-image"><a data-fancybox="images" href="' + picFile.result + '"  class="btn btn-info btn-edit-image"><i class="fas fa-search-plus fa-lg text-white-50"></i></a></div>' +
                            '</div>';

                output.html(html);

          }

          reader.readAsDataURL(et.files[0]);

    } else {
         alert("Please select only image file (gif, png, jpg, jpeg, ico)");
     }

    } else {

        alert('Browser not support');

    }

  }


});

</script>
  </body>
</html><?php
require_once('common/clear.php');
?>
