<?php echo view('backend/'.$cc['backend_theme'].'/common/page_start'); ?>
  <head>
  <?php echo view('backend/'.$cc['backend_theme'].'/common/head');?>
  </head>
  <body><?php echo view('backend/'.$cc['backend_theme'].'/common/body_start');?>
  <?php echo view('backend/'.$cc['backend_theme'].'/common/header');?>
  <form name="edit_frm" id="edit_frm" action="<?php echo $cc['base_url'].'Brands/edit?id='.$form['id']; ?>" method="POST" role="form" enctype='multipart/form-data' novalidate>
  <input type="hidden" name="images_sort_order" id="images_sort_order" value="<?php 
  foreach ($form['images'] as $image)
            {
              echo $image['upload_file'].'='.$image['sort_order'].',';
            }             
              ?>">
  <input type="hidden" name="gallery_sort_order" id="gallery_sort_order" value="<?php 
  foreach ($form['gallery'] as $gallery)
            {
              echo $gallery['upload_file'].'='.$gallery['sort_order'].',';
            }             
              ?>">
  <input type="hidden" name="token" id="token" value="<?php echo $form['token']; ?>">
          <?php echo csrf_field(); ?>
          <div class="container">
          <div class="row align-items-start">
          <div class="row">
          <div class="col-12 p-3">
          <h1>Brands<h1>
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
          <label for="slug" class="form-label">Slug</label>
          <input type="text" id="slug" name="slug" value="<?php echo $form['slug']; ?>" class="form-control" aria-describedby="slughelpblock" minlength="2"  required>
          <div class="invalid-feedback">  
          Required valid information. 
          </div>
          <div id="slughelpblock" class="form-text">
            Your slug must be 2-64 characters long, contain letters and numbers, and must not contain spaces, special characters, or emoji.
          </div>
          </div>

          <div class="row p-3">
          <label for="title" class="form-label">Title</label>
          <input type="text" id="title" name="title" value="<?php echo $form['title']; ?>" class="form-control" aria-describedby="titlehelpblock" minlength="2"  required>
          <div class="invalid-feedback">  
          Required valid information. 
          </div>
          <div id="titlehelpblock" class="form-text">
            Your title must be 2-256 characters long.
          </div>
          </div>

          <div class="row p-3">
          <label for="name" class="form-label">Name</label>
          <input type="text" id="name" name="name" value="<?php echo $form['name']; ?>" class="form-control" aria-describedby="namehelpblock" minlength="2"  required>
          <div class="invalid-feedback">  
          Required valid information. 
          </div>
          <div id="namehelpblock" class="form-text">
            Your name must be 2-256 characters long.
          </div>
          </div>

          <div class="row p-3">
          <label for="spotlight" class="form-label">Spotlight</label>
          <textarea class="form-control" id="spotlight" name="spotlight" class="form-control" aria-describedby="spotlighthelpblock" minlength="2"  required rows="5"><?php echo $form['spotlight']; ?></textarea>
          <div class="invalid-feedback">  
          Required valid information. 
          </div>
          <div id="spotlighthelpblock" class="form-text">
            Your spotlight must be 2-5000 characters long.
          </div>
          </div>


          <div class="row p-3">
          <label for="description" class="form-label">Description</label>
          <textarea class="form-control" id="description" name="description" class="form-control" aria-describedby="descriptionhelpblock" minlength="2"  required rows="7"><?php echo $form['description']; ?></textarea>
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
            <input class="form-check-input" type="checkbox" role="switch" id="searchable" name="searchable" value="1"  <?php echo ($form['searchable'] == 1)?'checked':''; ?>>
            <label class="form-check-label" for="searchable">Searchable</label>
          </div>
          </div>

          <div class="row p-3">
           <div class="form-check form-switch">
            <input class="form-check-input" type="checkbox" role="switch" id="listed" name="listed" value="1"  <?php echo ($form['listed'] == 1)?'checked':''; ?>>
            <label class="form-check-label" for="listed">Listed</label>
          </div>
          </div>

          <div class="row p-3">
           <div class="form-check form-switch">
            <input class="form-check-input" type="checkbox" role="switch" id="featured" name="featured" value="1"  <?php echo ($form['featured'] == 1)?'checked':''; ?>>
            <label class="form-check-label" for="featured">Featured</label>
          </div>
          </div>

          <div class="row p-3">
           <div class="form-check form-switch">
            <input class="form-check-input" type="checkbox" role="switch" id="top" name="top" value="1"  <?php echo ($form['top'] == 1)?'checked':''; ?>>
            <label class="form-check-label" for="top">Top</label>
          </div>
          </div>

          <div class="row p-3">
           <div class="form-check form-switch">
            <input class="form-check-input" type="checkbox" role="switch" id="bottom" name="bottom" value="1"  <?php echo ($form['bottom'] == 1)?'checked':''; ?>>
            <label class="form-check-label" for="bottom">Bottom</label>
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


          <div class="row p-3">
          <label for="votes" class="form-label">Votes</label>
          <input type="text" id="votes" name="votes" value="<?php echo $form['votes']; ?>" class="form-control" aria-describedby="voteshelpblock" maxlength="11" minlength="1" required="required" required onkeypress="return is_key_digit_fnc(event);" ondrop="return false;" onpaste="return false;">
          <div class="invalid-feedback">  
          Required valid information. 
          </div>
          <div id="voteshelpblock" class="form-text">
            Your item votes must be 1-11 digits long and must not include letters, spaces, special characters, or emojis.
          </div>
          </div>

          <div class="row p-3">
          <label for="ratings" class="form-label">Ratings</label>
          <input type="text" id="ratings" name="ratings" value="<?php echo $form['ratings']; ?>" class="form-control" aria-describedby="ratingshelpblock" maxlength="190" minlength="1" required="required" required onkeypress="return is_key_numeric_fnc(event);" ondrop="return false;" onpaste="return false;">
          <div class="invalid-feedback">  
          Required valid information. 
          </div>
          <div id="ratingshelpblock" class="form-text">
            The ratings must be 1-11 digits long and must not include letters, spaces, special characters, or emojis.
          </div>
          </div>

          <div class="row p-3">
          <label for="scores" class="form-label">Scores</label>
          <input type="text" id="scores" name="scores" value="<?php echo $form['scores']; ?>" class="form-control" aria-describedby="scoreshelpblock" maxlength="190" minlength="1" required="required" required onkeypress="return is_key_numeric_fnc(event);" ondrop="return false;" onpaste="return false;">
          <div class="invalid-feedback">  
          Required valid information. 
          </div>
          <div id="scoreshelpblock" class="form-text">
           The scores must be 1-11 digits long and must not include letters, spaces, special characters, or emojis.
          </div>
          </div>

          <div class="row p-3">
          <label for="likes" class="form-label">Likes</label>
          <input type="text" id="likes" name="likes" value="<?php echo $form['likes']; ?>" class="form-control" aria-describedby="likeshelpblock" maxlength="190" minlength="1" required="required" required onkeypress="return is_key_digit_fnc(event);" ondrop="return false;" onpaste="return false;">
          <div class="invalid-feedback">  
          Required valid information. 
          </div>
          <div id="likeshelpblock" class="form-text">
            Your item likes must be 1-11 digits long and must not include letters, spaces, special characters, or emojis.
          </div>
          </div>

          </div>
          </div>


          <div class="card mt-3">
          <div class="card-header">
          <h5> Miscellaneous </h5>
          </div>
          <div class="card-body">

          <div class="row p-3">
          <label for="published_time" class="form-label mb-0">Published Time</label>
            <div class="row row-cols-lg-auto g-2 align-items-center">
          <div class="col-12">
          <select class="form-select" aria-label="published_year" name="published_year" id="published_year" required>
          <option value="">Year</option>
          <?php for ($i = date('Y'); $i <= date('Y')+1; $i++) { ?>
          <option value="<?php echo $i; ?>" <?php echo ($i == $form['published_year'])?'selected':''; ?>><?php echo $i; ?></option>
          <?php }?>
        </select><div class="invalid-feedback">  
          Required valid information. 
          </div>
          </div>
          <div class="col-12">
          <select class="form-select" aria-label="published_month" name="published_month" id="published_month" required>
          <option value="">Month</option>
          <?php for ($i = 1; $i <= 12; $i++) { ?>
          <option value="<?php echo ($i < 10)?'0'.$i:$i; ?>" <?php echo ($i == $form['published_month'])?'selected':''; ?>><?php echo ($i < 10)?'0'.$i:$i; ?></option>
          <?php }?>
        </select><div class="invalid-feedback">  
          Required valid information. 
          </div>
          </div>
          <div class="col-12">
          <select class="form-select" aria-label="published_day" name="published_day" id="published_day" required>
          <option value="">Day</option>
          <?php for ($i = 1; $i <= 31; $i++) { ?>
          <option value="<?php echo ($i < 10)?'0'.$i:$i; ?>" <?php echo ($i == $form['published_day'])?'selected':''; ?>><?php echo ($i < 10)?'0'.$i:$i; ?></option>
          <?php }?>
        </select><div class="invalid-feedback">  
          Required valid information. 
          </div>
          </div>
          <div class="col-12">
          <select class="form-select" aria-label="published_hour" name="published_hour" id="published_hour" required>
          <option value="">Hour</option>
          <?php for ($i = 0; $i <= 23; $i++) { ?>
          <option value="<?php echo ($i < 10)?'0'.$i:$i; ?>" <?php echo ($i == $form['published_hour'])?'selected':''; ?>><?php echo ($i < 10)?'0'.$i:$i; ?></option>
          <?php }?>
        </select><div class="invalid-feedback">  
          Required valid information. 
          </div>
          </div>
          <div class="col-12">
          <select class="form-select" aria-label="published_minute" name="published_minute" id="published_minute" required>
          <option value="">Minute</option>
          <?php for ($i = 0; $i <= 59; $i++) { ?>
          <option value="<?php echo ($i < 10)?'0'.$i:$i; ?>" <?php echo ($i == $form['published_minute'])?'selected':''; ?>><?php echo ($i < 10)?'0'.$i:$i; ?></option>
          <?php }?>
        </select><div class="invalid-feedback">  
          Required valid information. 
          </div>
          </div>
          <div class="col-12">
          <select class="form-select" aria-label="published_second" name="published_second" id="published_second" required>
          <option value="">Second</option>
          <?php for ($i = 0; $i <= 59; $i++) { ?>
          <option value="<?php echo ($i < 10)?'0'.$i:$i; ?>" <?php echo ($i == $form['published_second'])?'selected':''; ?>><?php echo ($i < 10)?'0'.$i:$i; ?></option>
          <?php }?>
        </select><div class="invalid-feedback">  
          Required valid information. 
          </div>
          </div>
          </div>
          
          </div>


          </div>
          </div>
            
          <div class="card mt-3">
          <div class="card-header">
            <h5>SEO</h5>
          </div>
          <div class="card-body">

           <div class="row p-3">
          <label for="meta_title" class="form-label">Meta Title</label>
          <input type="text" id="meta_title" name="meta_title" value="<?php echo $form['meta_title']; ?>" class="form-control" aria-describedby="meta_titlehelpblock" minlength="2"  required>
          <div class="invalid-feedback">  
          Required valid information. 
          </div>
          <div id="meta_titlehelpblock" class="form-text">
            Your meta title must be 2-64 characters long, contain letters and numbers, and must not contain spaces, special characters, or emoji.
          </div>
          </div>

          <div class="row p-3">
          <label for="meta_description" class="form-label">Meta Description</label>
          <textarea class="form-control" id="meta_description" name="meta_description" class="form-control" aria-describedby="meta_descriptionhelpblock" minlength="2"  required rows="5"><?php echo $form['meta_description']; ?></textarea>
          <div class="invalid-feedback">  
          Required valid information. 
          </div>
          <div id="meta_descriptionhelpblock" class="form-text">
            Your meta description must be 2-256 characters long.
          </div>
          </div>

          <div class="row p-3">
          <label for="meta_keywords" class="form-label">Meta Keywords</label>
          <textarea class="form-control" id="meta_keywords" name="meta_keywords" class="form-control" aria-describedby="meta_keywordshelpblock" minlength="2"  required rows="5"><?php echo $form['meta_keywords']; ?></textarea>
          <div class="invalid-feedback">  
          Required valid information. 
          </div>
          <div id="meta_keywordshelpblock" class="form-text">
            Your meta keywords must be 2-256 characters long.
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


          <div class="row">
           <div class="col-12">
           <div class="card mt-3">
          <div class="card-header">
          <h5> Gallery</h5>
          </div>
          <div class="card-body">
         
          <fieldset class="form-group">
          <button type="button" class="d-none d-sm-inline-block btn btn-sm btn-info shadow-sm" onclick="p('#gallery-pick').click()"><i class="fas fa-upload fa-sm text-white-50"></i> Select Images </button>
        <input type="file" id="gallery-pick" name="gallery[]" style="display: none;" class="form-control" accept="image/*" multiple>
        <div id="appended_gallery_files"> </div>
    </fieldset>
    <div class="preview-gallery-zone">

    <?php $cg = 0;
    foreach ($form['gallery'] as $gallery)
            {
              $cg++;              
              ?>
        <div class="preview-gallery preview-show-<?php echo $cg; ?>" id="<?php echo $gallery['upload_file'] ?>">
        <div class="btn btn-danger gallery-cancel" data-no="<?php echo $cg; ?>"><i class="fas fa-trash fa-sm text-white-50"></i></div>
        <div class="gallery-zone"><img id="pro-img-<?php echo $cg; ?>" src="<?php echo 'public/uploads/'.$gallery['upload_file'] ?>"></div>
        <div class="tools-edit-gallery"><a data-fancybox="grp-gallery" href="<?php echo 'public/uploads/'.$gallery['upload_file'] ?>" data-no="<?php echo $cg; ?>" class="btn btn-info btn-edit-image"><i class="fas fa-search-plus fa-lg text-white-50"></i></a></div>
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
<script data-src="<?php echo $cc['js_url'].'public/js/backend/form.js?t='.time(); ?>"></script>
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

      tinymce.init({selector:'#spotlight',   branding: false, min_height: 300, menubar: false, plugins: [
    'advlist autolink lists link image charmap print preview anchor',
    'searchreplace visualblocks code fullscreen',
    'insertdatetime media table paste code help wordcount'
  ],
  toolbar: 'undo redo removeformat | bold italic underline strikethrough | fontselect fontsizeselect formatselect | alignleft aligncenter alignright alignjustify | outdent indent |  numlist bullist checklist | forecolor backcolor casechange permanentpen formatpainter  | pagebreak | charmap emoticons | fullscreen  preview save print | insertfile image media pageembed template link anchor codesample | a11ycheck ltr rtl | showcomments addcomment',
toolbar_drawer: 'floating', browser_spellcheck: true, allow_script_urls: true});

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