<?php echo view('backend/'.$cc['backend_theme'].'/common/page_start'); ?>
  <head>
  <?php echo view('backend/'.$cc['backend_theme'].'/common/head');?>
  </head>
  <body><?php echo view('backend/'.$cc['backend_theme'].'/common/body_start');?>
  <?php echo view('backend/'.$cc['backend_theme'].'/common/header');?>
  <form name="edit_frm" id="edit_frm" action="<?php echo $cc['base_url'].'Galleries/edit?id='.$form['id']; ?>" method="POST" role="form" enctype='multipart/form-data' novalidate>
  <input type="hidden" name="images_sort_order" id="images_sort_order" value="<?php 
  foreach ($form['images'] as $image)
            {
              echo $image['upload_file'].'='.$image['sort_order'].',';
            }             
              ?>">
  <input type="hidden" name="token" id="token" value="<?php echo $form['token']; ?>">
          <?php echo csrf_field(); ?>
          <div class="container">
          <div class="row align-items-start">
          <div class="row">
          <div class="col-12 p-3">
          <h1>Galleries<h1>
           </div> 
           <div class="col-8 p-3">
           <h2>Edit: <?php echo $form['id']; ?><h2>
           </div>
           <div class="col-4 p-3">
           <h2><button type="submit" class="btn btn-success">Update</button><h2>
           </div>
           </div>

           <div class="row">
          <!--left panel start-->
          <div class="col-8">
          <div class="card">
          <div class="card-header">
          <h5> Information</h5>
          </div>
          <div class="card-body">  
         
            <div class="row p-3">
          <label for="parent_id" class="form-label">Parent ID</label>
          <input type="text" id="parent_id" name="parent_id" value="<?php echo $form['parent_id']; ?>" class="form-control" aria-describedby="parent_idhelpblock" minlength="2" required>
          <div class="invalid-feedback">  
          Required valid information. 
          </div>
          <div id="parent_idhelpblock" class="form-text">
            Your parent id must be 2-64 characters long, contain letters and numbers, and must not contain spaces, special characters, or emoji.
          </div>
          </div>
          
          <div class="row p-3">
          <label for="parent_type" class="form-label">Parent Type</label>
          <input type="text" id="parent_type" name="parent_type" value="<?php echo $form['parent_type']; ?>" class="form-control" aria-describedby="parent_typehelpblock" minlength="2" required>
          <div class="invalid-feedback">  
          Required valid information. 
          </div>
          <div id="parent_typehelpblock" class="form-text">
            Your parent type must be 2-64 characters long, contain letters and numbers, and must not contain spaces, special characters, or emoji.
          </div>
          </div>

          <div class="row p-3">
          <label for="title" class="form-label">Title</label>
          <input type="text" id="title" name="title" value="<?php echo $form['title']; ?>" class="form-control" aria-describedby="titlehelpblock" minlength="2" >
          <div class="invalid-feedback">  
          Required valid information. 
          </div>
          <div id="titlehelpblock" class="form-text">
            Your title must be 2-256 characters long.
          </div>
          </div>

          <div class="row p-3">
          <label for="name" class="form-label">Name</label>
          <input type="text" id="name" name="name" value="<?php echo $form['name']; ?>" class="form-control" aria-describedby="namehelpblock" minlength="2" >
          <div class="invalid-feedback">  
          Required valid information. 
          </div>
          <div id="namehelpblock" class="form-text">
            Your name must be 2-256 characters long.
          </div>
          </div>

          <div class="row p-3">
          <label for="link" class="form-label">Link</label>
          <input type="text" id="link" name="link" value="<?php echo $form['link']; ?>" class="form-control" aria-describedby="linkhelpblock" minlength="2" >
          <div class="invalid-feedback">  
          Required valid information. 
          </div>
          <div id="linkhelpblock" class="form-text">
            Your link must be 2-256 characters long.
          </div>
          </div>


          <div class="row p-3">
          <label for="description" class="form-label">Description</label>
          <textarea class="form-control" id="description" name="description" class="form-control" aria-describedby="descriptionhelpblock" minlength="2" rows="7"><?php echo $form['description']; ?></textarea>
          <div class="invalid-feedback">  
          Required valid information. 
          </div>
          <div id="descriptionhelpblock" class="form-text">
            Your description must be 2-5000 characters long.
          </div>
          </div>

          </div>
          </div>          
           </div> 
          <!--left panel end-->

          <!--right panel start-->
           <div class="col-4">

           <div class="card">
          <div class="card-header">
          <h5> Visibility</h5>
          </div>
          <div class="card-body">

          <div class="row p-3">
           <div class="form-check form-switch">
            <input class="form-check-input" type="checkbox" role="switch" id="status" name="status" value="1" <?php echo ($form['status'] == 1)?'checked':''; ?>>
            <label class="form-check-label" for="status">Status</label>
          </div>
          </div>

          <div class="row p-3">
           <div class="form-check form-switch">
            <input class="form-check-input" type="checkbox" role="switch" id="featured" name="featured" value="1" <?php echo ($form['featured'] == 1)?'checked':''; ?>>
            <label class="form-check-label" for="featured">Featured</label>
          </div>
          </div>

          <div class="row p-3">
           <div class="form-check form-switch">
            <input class="form-check-input" type="checkbox" role="switch" id="listed" name="listed" value="1" <?php echo ($form['listed'] == 1)?'checked':''; ?>>
            <label class="form-check-label" for="listed">Listed</label>
          </div>
          </div>

          <div class="row p-3">
          <label for="sort_order" class="form-label">Sort Order</label>
          <input type="text" id="sort_order" name="sort_order" value="<?php echo $form['sort_order']; ?>" class="form-control" aria-describedby="sort_orderhelpblock" minlength="1" required="required" required onkeypress="return is_key_digit_fnc(event);" ondrop="return false;" onpaste="return false;">
          <div class="invalid-feedback">  
          Required valid information. 
          </div>
          <div id="sort_orderhelpblock" class="form-text">
            Your sort order must be a positive integer.
          </div>
          </div>
         
          </div>
          </div>

          <div class="card mt-3">
          <div class="card-header">
          <h5> Statistics </h5>
          </div>
          <div class="card-body">

          <div class="row p-3">
          <label for="today_views" class="form-label">Today views</label>
          <input type="text" id="today_views" name="today_views" value="<?php echo $form['today_views']; ?>" class="form-control" aria-describedby="today_viewshelpblock" maxlength="11" minlength="1" required="required" required onkeypress="return is_key_digit_fnc(event);" ondrop="return false;" onpaste="return false;">
          <div class="invalid-feedback">  
          Required valid information. 
          </div>
          <div id="today_viewshelpblock" class="form-text">
            Your item today views must be 1-11 digits long and must not include letters, spaces, special characters, or emojis.
          </div>
          </div>

          <div class="row p-3">
          <label for="lifetime_views" class="form-label">Lifetime Views</label>
          <input type="text" id="lifetime_views" name="lifetime_views" value="<?php echo $form['lifetime_views']; ?>" class="form-control" aria-describedby="lifetime_viewshelpblock" maxlength="11" minlength="1" required="required" required onkeypress="return is_key_digit_fnc(event);" ondrop="return false;" onpaste="return false;">
          <div class="invalid-feedback">  
          Required valid information. 
          </div>
          <div id="lifetime_viewshelpblock" class="form-text">
            Your item Lifetime views must be 1-11 digits long and must not include letters, spaces, special characters, or emojis.
          </div>
          </div>


          <div class="row p-3">
          <label for="today_hits" class="form-label">Today Hits</label>
          <input type="text" id="today_hits" name="today_hits" value="<?php echo $form['today_hits']; ?>" class="form-control" aria-describedby="today_hitshelpblock" maxlength="11" minlength="1" required="required" required onkeypress="return is_key_digit_fnc(event);" ondrop="return false;" onpaste="return false;">
          <div class="invalid-feedback">  
          Required valid information. 
          </div>
          <div id="today_hitshelpblock" class="form-text">
            Your item today hits must be 1-11 digits long and must not include letters, spaces, special characters, or emojis.
          </div>
          </div>


          <div class="row p-3">
          <label for="lifetime_hits" class="form-label">Lifetime Hits</label>
          <input type="text" id="lifetime_hits" name="lifetime_hits" value="<?php echo $form['lifetime_hits']; ?>" class="form-control" aria-describedby="lifetime_hitshelpblock" maxlength="11" minlength="1" required="required" required onkeypress="return is_key_digit_fnc(event);" ondrop="return false;" onpaste="return false;">
          <div class="invalid-feedback">  
          Required valid information. 
          </div>
          <div id="lifetime_hitshelpblock" class="form-text">
            Your item lifetime hits must be 1-11 digits long and must not include letters, spaces, special characters, or emojis.
          </div>
          </div>



          </div>
          </div>
    
         
         


           </div>
           <!--right panel end-->
           </div>


           <div class="row">
           <div class="col-12">
           <div class="card mt-3">
          <div class="card-header">
          <h5> Images</h5>
          </div>
          <div class="card-body">

          <fieldset class="form-group">
          <button type="button" class="d-none d-sm-inline-block btn btn-sm btn-info shadow-sm" onclick="p('#images-pick').click()"><i class="fas fa-upload fa-sm text-white-50"></i> Select Images </button>
        <input type="file" id="images-pick" name="images[]" style="display: none;" class="form-control" accept="image/*" multiple>
        <div id="appended_images_files"> </div>
    </fieldset>
    <div class="preview-images-zone">

    <?php $ci = 0;
    foreach ($form['images'] as $image)
            {
              $ci++;              
              ?>
        <div class="preview-image preview-show-<?php echo $ci; ?>" id="<?php echo $image['upload_file'] ?>">
        <div class="btn btn-danger image-cancel" data-no="<?php echo $ci; ?>"><i class="fas fa-trash fa-sm text-white-50"></i></div>
        <div class="image-zone"><img id="pro-img-<?php echo $ci; ?>" src="<?php echo 'public/uploads/'.$image['upload_file'] ?>"></div>
        <div class="tools-edit-image"><a data-fancybox="grp-images" href="<?php echo 'public/uploads/'.$image['upload_file'] ?>" data-no="<?php echo $ci; ?>" class="btn btn-info btn-edit-image"><i class="fas fa-search-plus fa-lg text-white-50"></i></a></div>
         </div>
            <?php }?>

    </div>   
            
          </div>
          </div>
           </div>
          </div>
         
            </div>
        </div>
</form>
<?php echo view('backend/'.$cc['backend_theme'].'/common/footer');?>
<?php echo view('backend/'.$cc['backend_theme'].'/common/body_end');?>
<script data-src="https://cdn.jsdelivr.net/gh/shonirits/SHONiR-CMS@master/public/js/backend/form.min.js"></script>
<script>
(function () {  
            'use strict';  
            window.addEventListener('load', function () {  
                var form = document.getElementById('edit_frm'); 
                form.addEventListener('submit', function (event) {  
                    if (form.checkValidity() === false) {  
                        event.preventDefault();  
                        event.stopPropagation();  
                      }else{
                        overlay_fnc(form);
                        p(form).find(':button').prop('disabled', true);
                      }   
                    form.classList.add('was-validated');  
                }, false);
            }, false);  
        })(); 
 </script>

 <script>
 
function content_fnc() {

  prevent_newlines_fnc('meta_description');
       prevent_newlines_fnc('meta_keywords');

        Fancybox.bind('[data-fancybox="grp-images"]', {
          Carousel: {
            transition: "slide",
          },
        });
      Fancybox.bind('[data-fancybox="grp-gallery"]', {
        Carousel: {
          transition: "slide",
        },
      });

tinymce.init({selector:'#description',   branding: false, min_height: 500, menubar: false, plugins: [
    'advlist autolink lists link image charmap print preview anchor',
    'searchreplace visualblocks code fullscreen',
    'insertdatetime media table paste code help wordcount'
  ],
  toolbar: 'undo redo removeformat | bold italic underline strikethrough | fontselect fontsizeselect formatselect | alignleft aligncenter alignright alignjustify | outdent indent |  numlist bullist checklist | forecolor backcolor casechange permanentpen formatpainter  | pagebreak | charmap emoticons | fullscreen  preview save print | insertfile image media pageembed template link anchor codesample | a11ycheck ltr rtl | showcomments addcomment',
toolbar_drawer: 'floating', browser_spellcheck: true, allow_script_urls: true});

  }
    
  </script>

</body>
<?php echo view('backend/'.$cc['backend_theme'].'/common/page_end');?>