<?php echo view('backend/'.$cc['backend_theme'].'/common/page_start'); ?>
  <head>
  <?php echo view('backend/'.$cc['backend_theme'].'/common/head');?>
  </head>
  <body><?php echo view('backend/'.$cc['backend_theme'].'/common/body_start');?>
  <?php echo view('backend/'.$cc['backend_theme'].'/common/header');?>
  <form name="add_frm" id="add_frm" action="<?php echo $cc['base_url'].'Links/add'; ?>" method="POST" role="form" enctype='multipart/form-data' novalidate>
  <input type="hidden" name="images_sort_order" id="images_sort_order" value="">
  <input type="hidden" name="gallery_sort_order" id="gallery_sort_order" value="">
  <input type="hidden" name="token" id="token" value="<?php echo $form['token']; ?>">
          <?php echo csrf_field(); ?>
          <div class="container">
          <div class="row align-items-start">
          <div class="row">
          <div class="col-12 p-3">
          <h1>Links<h1>
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
          <label for="category_id" class="form-label">Link Category</label>
          <select class="form-control" id="category_id" name="category_id" required>
            <option value="">— Select a link category —</option>
            <?php 
            if (!empty($form['link_categories_list'])) {
                foreach ($form['link_categories_list'] as $id => $name) { ?>
                    <option value="<?php echo $id; ?>" <?php echo (!empty($form['category_id']) && $form['category_id'] == $id) ? 'selected="selected"' : ''; ?>>
                        <?php echo ucfirst($name); ?>
                    </option>
            <?php 
                }
            } 
            ?>
          </select>
          <div class="invalid-feedback">  
            Required valid information.
          </div>
          <div id="category_idhelpblock" class="form-text">
            You can select only one category for this record.
          </div>
        </div>

        <div class="row p-3">
          <label for="parent_type" class="form-label">Parent Type</label>
          <select class="form-control" id="parent_type" name="parent_type" required>
            <option value="">— Select a parent type —</option>
            <?php 
            if (!empty($form['parent_types_list'])) {
                foreach ($form['parent_types_list'] as $id => $name) { ?>
                    <option value="<?php echo $id; ?>" <?php echo (!empty($form['parent_type']) && $form['parent_type'] == $id) ? 'selected="selected"' : ''; ?>>
                        <?php echo ucfirst($name); ?>
                    </option>
            <?php 
                }
            } 
            ?>
          </select>
          <div class="invalid-feedback">  
            Required valid information.
          </div>
          <div id="parent_typehelpblock" class="form-text">
            You can select only one parent type for this record.
          </div>
        </div>

        <span id="parent_id_content"></span>

         <div class="row p-3">
          <label for="host_id" class="form-label">Host</label>
          <select class="form-control" id="host_id" name="host_id" required>
            <option value="">— Select a host —</option>
            <?php 
            if (!empty($form['host_types_list'])) {
                foreach ($form['host_types_list'] as $id => $name) { ?>
                    <option value="<?php echo $id; ?>" <?php echo (!empty($form['host_id']) && $form['host_id'] == $id) ? 'selected="selected"' : ''; ?>>
                        <?php echo ucfirst($name); ?>
                    </option>
            <?php 
                }
            } 
            ?>
          </select>
          <div class="invalid-feedback">  
            Required valid information.
          </div>
          <div id="host_idhelpblock" class="form-text">
            You can select only one host type for this record.
          </div>
        </div>


        <div class="row p-3">
          <label for="type_id" class="form-label">Link Type</label>
          <select class="form-control" id="type_id" name="type_id" required>
            <option value="">— Select a link type —</option>
            <?php 
            if (!empty($form['link_types_list'])) {
                foreach ($form['link_types_list'] as $id => $name) { ?>
                    <option value="<?php echo $id; ?>" <?php echo (!empty($form['type_id']) && $form['type_id'] == $id) ? 'selected="selected"' : ''; ?>>
                        <?php echo ucfirst($name); ?>
                    </option>
            <?php 
                }
            } 
            ?>
          </select>
          <div class="invalid-feedback">  
            Required valid information.
          </div>
          <div id="type_idhelpblock" class="form-text">
            You can select only one type for this record.
          </div>
        </div>


         <div class="row p-3">
          <label for="url" class="form-label">URL</label>
          <textarea class="form-control" id="url" name="url" class="form-control" aria-describedby="urlhelpblock" minlength="2"  required rows="5"><?php echo $form['url']; ?></textarea>
          <div class="invalid-feedback">  
          Required valid information. 
          </div>
          <div id="urlhelpblock" class="form-text">
            Your url must be 2-256 characters long.
          </div>
          </div>


          <div class="row p-3">
          <label for="quality_id" class="form-label">Quality</label>
          <select class="form-control" id="quality_id" name="quality_id" required>
            <option value="">— Select a Quality —</option>
            <?php 
            if (!empty($form['quality_types_list'])) {
                foreach ($form['quality_types_list'] as $id => $name) { ?>
                    <option value="<?php echo $id; ?>" <?php echo (!empty($form['quality_id']) && $form['quality_id'] == $id) ? 'selected="selected"' : ''; ?>>
                        <?php echo ucfirst($name); ?>
                    </option>
            <?php 
                }
            } 
            ?>
          </select>
          <div class="invalid-feedback">  
            Required valid information.
          </div>
          <div id="quality_idhelpblock" class="form-text">
            You can select only one quality type for this record.
          </div>
        </div>


        <div class="row p-3">
          <label for="duration" class="form-label">Duration</label>
          <input type="text" id="duration" name="duration" value="<?php echo $form['duration']; ?>" class="form-control" aria-describedby="durationhelpblock" minlength="2"  required>
          <div class="invalid-feedback">  
          Required valid information. 
          </div>
          <div id="durationhelpblock" class="form-text">
            Your duration must be hh:mm:ss format and must not contain letters, spaces, special characters, or emoji.
          </div>
          </div>


          <div class="row p-3">
          <label for="file_size" class="form-label">File Size</label>
          <input type="text" id="file_size" name="file_size" value="<?php echo $form['file_size']; ?>" class="form-control" aria-describedby="file_sizehelpblock" minlength="2"  required>
          <div class="invalid-feedback">  
          Required valid information. 
          </div>
          <div id="file_sizehelpblock" class="form-text">
            Your file size must be 1.5 GB or 100 MB and must not contain spaces, special characters, or emoji.
          </div>
          </div>

          <div class="row p-3">
          <label for="part_id" class="form-label">Part Type</label>
          <select class="form-control" id="part_id" name="part_id" required>
            <option value="">— Select a part type —</option>
            <?php 
            if (!empty($form['part_types_list'])) {
                foreach ($form['part_types_list'] as $id => $name) { ?>
                    <option value="<?php echo $id; ?>" <?php echo (!empty($form['part_id']) && $form['part_id'] == $id) ? 'selected="selected"' : ''; ?>>
                        <?php echo ucfirst($name); ?>
                    </option>
            <?php 
                }
            } 
            ?>
          </select>
          <div class="invalid-feedback">  
            Required valid information.
          </div>
          <div id="part_idhelpblock" class="form-text">
            You can select only one part type for this record.
          </div>
        </div>

        <div class="row p-3">
          <label for="part" class="form-label">Part</label>
          <input type="text" id="part" name="part" value="<?php echo $form['part']; ?>" class="form-control" aria-describedby="parthelpblock" minlength="1"  required>
          <div class="invalid-feedback">  
          Required valid information. 
          </div>
          <div id="parthelpblock" class="form-text">
            Your part must be unique, 2-64 characters long, contain letters and numbers, and must not contain spaces, special characters, or emoji.
          </div>
          </div>
          
          <div class="row p-3">
          <label for="public_id" class="form-label">Public ID</label>
          <input type="text" id="public_id" name="public_id" value="<?php echo $form['public_id']; ?>" class="form-control" aria-describedby="public_idhelpblock" minlength="2"  required>
          <div class="invalid-feedback">  
          Required valid information. 
          </div>
          <div id="public_idhelpblock" class="form-text">
            Your public id must be unique, 2-64 characters long, contain letters and numbers, and must not contain spaces, special characters, or emoji.
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
          <label for="sort_order" class="form-label">Sort Order</label>
          <input type="number" id="sort_order" name="sort_order" value="<?php echo $form['sort_order']; ?>" class="form-control" aria-describedby="sort_orderhelpblock" minlength="2"  required  onkeypress="return is_key_numeric_fnc(event);" ondrop="return false;" onpaste="return false;">
          <div class="invalid-feedback">  
          Required valid information. 
          </div>
          <div id="sort_orderhelpblock" class="form-text">
           The sort order must be a numeric value without any letters, whitespace, special characters, or emoji.
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
            
         

           </div>
           <!--right panel end-->
           </div>


          </div>
        </div>
</form>
   <?php echo view('backend/'.$cc['backend_theme'].'/common/footer');?>
<?php echo view('backend/'.$cc['backend_theme'].'/common/body_end');?>
<script>const parent_list = <?php echo json_encode($form['parent_list'], JSON_UNESCAPED_UNICODE | JSON_UNESCAPED_SLASHES); ?>;</script>
<script data-src="<?php echo $cc['js_url'].'public/js/backend/form.js?t='.time(); ?>"></script>
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

   const isFormReady = setInterval(() => {

    if (typeof window.isFormLoaded !== 'undefined' && window.isFormLoaded) {
      clearInterval(isFormReady);
      const parent_type = document.getElementById('parent_type');
      parent_type.dispatchEvent(new Event('change'));
    }

  }, 10);


  }
   
  </script>
</body>
<?php echo view('backend/'.$cc['backend_theme'].'/common/page_end');?>