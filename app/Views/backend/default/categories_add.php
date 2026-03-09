<?php echo view('backend/'.$cc['backend_theme'].'/common/page_start'); ?>
  <head>
  <?php echo view('backend/'.$cc['backend_theme'].'/common/head');?>
  </head>
  <body><?php echo view('backend/'.$cc['backend_theme'].'/common/body_start');?>
  <?php echo view('backend/'.$cc['backend_theme'].'/common/header');?>
  <form name="add_frm" id="add_frm" action="<?php echo $cc['base_url'].'Categories/add'; ?>" method="POST" role="form" enctype='multipart/form-data' novalidate>
  <input type="hidden" name="images_sort_order" id="images_sort_order" value="">
  <input type="hidden" name="gallery_sort_order" id="gallery_sort_order" value="">
  <input type="hidden" name="token" id="token" value="<?php echo $form['token']; ?>">
          <?php echo csrf_field(); ?>
          <div class="container">
          <div class="row align-items-start">
          <div class="row">
          <div class="col-12 p-3">
          <h1>Categories<h1>
           </div> 
           <div class="col-8 p-3">
           <h2>Add New<h2>
           </div>
           <div class="col-4 p-3">
           <h2><button type="submit" class="btn btn-success">Save</button><h2>
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
          <label for="categories" class="form-label">Parent Categories</label>
          <select class="form-control" id="categories" name="categories[]" multiple="multiple" required>
          <option value="0">---None---</option>
          <?php
$selectedCategoryIds = !empty($form['categories']) && is_array($form['categories'])
    ? $form['categories']
    : [];

if (!empty($form['db_categories']) && is_array($form['db_categories'])) {
    foreach ($form['db_categories'] as $category) {
        if (
            !is_array($category) ||
            empty($category['category_id']) ||
            empty($category['name'])
        ) {
            continue;
        }

        $categoryId = (int) $category['category_id'];
        $categoryName = htmlspecialchars($category['name'], ENT_QUOTES);
        $isSelected = in_array($categoryId, $selectedCategoryIds);

        echo '<option value="' . $categoryId . '"'
            . ($isSelected ? ' selected="selected"' : '')
            . '>' . $categoryName . '</option>';
    }
}
?>

          </select>
          <div class="invalid-feedback">  
          Required valid information. 
          </div>
          <div id="categorieshelpblock" class="form-text">
            You can select multiple parent categories for this record.
          </div>
          </div>
            
          
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
          <label for="sort_order" class="form-label">Sort Order</label>
          <input type="text" id="sort_order" name="sort_order" value="<?php echo $form['sort_order']; ?>" class="form-control" aria-describedby="sort_orderhelpblock" minlength="1" required="required" required onkeypress="return is_key_digit_fnc(event);" ondrop="return false;" onpaste="return false;">
          <div class="invalid-feedback">  
          Required valid information. 
          </div>
          <div id="sort_orderhelpblock" class="form-text">
            Your sort order must be a positive integer.
          </div>
          </div>

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
    <div class="preview-images-zone"></div>   
            
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
    <div class="preview-gallery-zone"></div>

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
                var form = document.getElementById('add_frm'); 
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