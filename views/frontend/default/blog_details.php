<?php

$SHONiR_Blog_Details = $SHONiR_Main['SHONiR_Blog_Details'];

?><!doctype html>
<html lang="en">
  <head>
  <?php require_once('common/head.php');?>
  <title><?php echo $SHONiR_Main['meta_title'] ?></title>
<meta name="description" content="<?php echo $SHONiR_Main['meta_description'] ?>">
<meta name="keywords" content="<?php echo $SHONiR_Main['meta_keyword'] ?>" />
  </head>
  <body><?php require_once('common/start.php');?>

  <?php include('includes/header.php');?>

<?php include('includes/banners.php'); ?>

<div class="container-fluid th-product-detail wow fadeInUp slow" >

<!-- Page Content -->
<div class="container">

<div class="row">

  <!-- Post Content Column -->
  <div class="col-lg-8">

    <!-- Title -->
    <h1 class="mt-4"><?php echo $SHONiR_Blog_Details['name']?></h1>

    <!-- Author -->
    <p class="lead text-primary">
      by <i class="fas fa-user"></i>
      <?php 

$SHONiR_Blogs_user = $SHONiR_Blog_Details['user']; 

if($SHONiR_Blogs_user){

  echo $SHONiR_Blogs_user['firstname'].' '.$SHONiR_Blogs_user['lastname'];

}else{

  echo 'Guest';

}
 ?>
    </p>

    <hr>

    <!-- Date/Time -->
    <p><?php echo date("l, F d, Y \\a\\t h:i A", $SHONiR_Blog_Details['published_time'])?></p>

    <hr>

    <!-- Preview Image -->
    <img class="img-fluid rounded" ci-src="<?php echo SHONiR_CDN_IMG.'media/uploads/'.$SHONiR_Blog_Details['image'];?>" alt="<?php echo $SHONiR_Blog_Details['name']?>">

    <hr>

    <!-- Post Content -->
    <p class="lead"><?php echo $SHONiR_Blog_Details['description']?></p>

    <?php
                    $SHONiR_Str_Tag = $SHONiR_Blog_Details['meta_keyword'];
                    if($SHONiR_Str_Tag){ ?>
    <hr>
    <?php $SHONiR_Str_Array = explode(',',$SHONiR_Str_Tag);
foreach ($SHONiR_Str_Array as $values)
{
  $SHONiR_Str_value = trim($values,"\0 \t \n \x0B \r ");
?>
                        <a href="Blogs/search?q=<?php echo $SHONiR_Str_value;?>" class="badge badge-pill badge-light"><?php echo $SHONiR_Str_value;?></a>
                        <?php } ?>
                        <?php } ?>                        
    <hr>

    <!-- Comments Form -->
    <div class="<?php echo (!$GLOBALS['SHONiR_USER'])?'th-overlay-area':''; ?>" id="post-comment-area">
    <div class="card my-4 ">
      
      <h5 class="card-header">Leave a Comment:</h5>
      <div class="card-body">
      <form name="SHONiR_Comment_Frm" id="SHONiR_Comment_Frm" method="POST" novalidate>
<input type="hidden" name="SHONiR_CSRF" id="SHONiR_CSRF" value="<?php echo $SHONiR_Main['SHONiR_CSRF'];?>">
<input type="hidden" name="type" id="type" value="blog">
          <div class="form-group">
            <textarea name="details" id="details" class="form-control" rows="3" required></textarea>
            <div class="invalid-feedback">  
                                            Please provide your instruction in reasonable details. 
                                        </div>
            <?php if(!$GLOBALS['SHONiR_USER']){ ?>
            <div class="th-overlay-content">
              <div>
            <a type="submit" class="th-social-btnlogin th-login-google" href="<?php echo SHONiR_BASE.'Customers/Login/google?continue='.urlencode(SHONiR_LINK); ?>"> &nbsp; <i class="fab fa-google"></i> Sign in with Google  &nbsp; </a> &nbsp; <a type="submit" class="th-social-btnlogin th-login-facebook"  href="<?php echo SHONiR_BASE.'Customers/Login/facebook?continue='.urlencode(SHONiR_LINK); ?>" > &nbsp;  <i class="fab fa-facebook-f"></i> Sign in with Facebook  &nbsp;  </a></div>
            
  </div><?php }?>
          </div>
          <input type="button" id="post-comment-btn" value="Post" class="btn btn-primary rounded-0 py-2">

        </form>
      </div>
    </div>
</div>
    <!-- Single Comment -->

    <div id="get-comment-area">
    <form name="SHONiR_Get_Comment_Frm" id="SHONiR_Get_Comment_Frm" method="POST">
    <input type="hidden" name="type" id="type" value="blog">
    <input type="hidden" name="n" id="n" value="0">
    <input type="hidden" name="o" id="o" value="c.add_time">
    <input type="hidden" name="b" id="b" value="desc">    
    </div>

    <div id="load-comment-area" style="display:none"><input type="button" id="load-comment-btn" value="Load More" class="btn btn-primary rounded-0 py-2" onclick="SHONiR_Load_Comments_Fnc('<?php echo SHONiR_BASE.'Ajax/Comments/Get/'.$SHONiR_Blog_Details['blog_id'].'_'.$SHONiR_Blog_Details['slug'].'.'.SHONiR_SETTINGS['config_extension']; ?>')"></div>

  </div>

  <!-- Sidebar Widgets Column -->
  <div class="col-md-4">

    <!-- Search Widget -->
    <div class="card my-4">
      <h5 class="card-header">Search</h5>
      <div class="card-body">
        <div class="input-group">
          <input type="text" class="form-control" placeholder="Search for...">
          <span class="input-group-btn">
            <button class="btn btn-secondary" type="button">Go!</button>
          </span>
        </div>
      </div>
    </div>

    <!-- Categories Widget -->
    <div class="card my-4">
      <h5 class="card-header">Categories</h5>
      <div class="card-body">
        <div class="row">
          <div class="col-lg-6">
            <ul class="list-unstyled mb-0">
              <li>
                <a href="#">Web Design</a>
              </li>
              <li>
                <a href="#">HTML</a>
              </li>
              <li>
                <a href="#">Freebies</a>
              </li>
            </ul>
          </div>
          <div class="col-lg-6">
            <ul class="list-unstyled mb-0">
              <li>
                <a href="#">JavaScript</a>
              </li>
              <li>
                <a href="#">CSS</a>
              </li>
              <li>
                <a href="#">Tutorials</a>
              </li>
            </ul>
          </div>
        </div>
      </div>
    </div>

    <!-- Side Widget -->
    <div class="card my-4">
      <h5 class="card-header">Side Widget</h5>
      <div class="card-body">
        You can put anything you want inside of these side widgets. They are easy to use, and feature the new Bootstrap 4 card containers!
      </div>
    </div>

  </div>

</div>
<!-- /.row -->

</div>
<!-- /.container -->

  
        

        </div>


       

<?php include('includes/footer.php');?>
<?php require_once('common/end.php');?>
<script>
function SHONiR_Load_Comments_Fnc(SHONiR_URL){
  d("#load-comment-area").LoadingOverlay("show", {
background  : "rgba(150, 150, 150, 0.5)"
});
  var form = document.getElementById("SHONiR_Get_Comment_Frm"); 
  data = p(form).serialize();
  request = d.ajax({
              url: SHONiR_URL,
              type: "post",
             dataType:"json",
              data: 'SHONiR=SHONiR&'+data,              
              cache: false
          });

          request.done(function (response, textStatus, jqXHR){                       
                       if(response['type']==='success'){
                        p('#SHONiR_Get_Comment_Frm').find('input[name="n"]').val(response['n']);
                        p("#get-comment-area").append(response['data']);           
                       }

                       if(response['more']==='hide'){
                        p('#load-comment-area').hide();
                       }else{
                        p('#load-comment-area').show();
                        d("#load-comment-area").LoadingOverlay("hide");
                       }
                   });


request.fail(function (jqXHR, textStatus, errorThrown){
              alert("The following error occurred: "+
              textStatus, errorThrown);
          });

  }
  w(window).on('load', function () {
  SHONiR_Load_Comments_Fnc("<?php echo SHONiR_BASE.'Ajax/Comments/Get/'.$SHONiR_Blog_Details['blog_id'].'_'.$SHONiR_Blog_Details['slug'].'.'.SHONiR_SETTINGS['config_extension']; ?>");
});

p("#post-comment-btn").click(function (event) {  

  var form = document.getElementById('SHONiR_Comment_Frm'); 

  if (form.checkValidity() === false) { 

event.preventDefault();  
event.stopPropagation();

} else {

d("#post-comment-area").LoadingOverlay("show", {
background  : "rgba(150, 150, 150, 0.5)"
});

data = p(form).serialize();
request = d.ajax({
              url: "<?php echo SHONiR_BASE.'Ajax/Comments/Post/'.$SHONiR_Blog_Details['blog_id'].'_'.$SHONiR_Blog_Details['slug'].'.'.SHONiR_SETTINGS['config_extension']; ?>",
              type: "post",
             dataType:"json",
              data: 'SHONiR=SHONiR&'+data,              
              cache: false
          });

request.done(function (response, textStatus, jqXHR){ 
                       
                       if(response['type']==='success'){
           
                           d("#post-comment-area").LoadingOverlay("hide");
                           p( "#post-comment-area" ).html('<div class="alert alert-success fade show" role="alert"> ' + response['message'] + ' </div>');
           
                       }else{          
                           
                          p("input[name='SHONiR_CSRF']",form).val(response['SHONiR_CSRF']);
                          d("#post-comment-area").LoadingOverlay("hide");
                          p( "#post-comment-area" ).prepend('<div class="alert alert-danger alert-dismissible fade show" role="alert"> ' + response['message'] + ' <button type="button" class="close" data-dismiss="alert" aria-label="Close">    <span aria-hidden="true">&times;</span> </button></div>');
           
                       }
                   });


request.fail(function (jqXHR, textStatus, errorThrown){
                d("#post-comment-area").LoadingOverlay("hide"); 
              alert("The following error occurred: "+
              textStatus, errorThrown);
          });

}

form.classList.add('was-validated');                    
                          
                }); 

</script>
  </body>
</html><?php
require_once('common/clear.php');
?>
