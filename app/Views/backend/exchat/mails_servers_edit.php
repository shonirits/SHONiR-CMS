<?php echo view('backend/'.$cc['backend_theme'].'/common/page_start'); ?>
  <head>
  <?php echo view('backend/'.$cc['backend_theme'].'/common/head');?>
  </head>
  <body><?php echo view('backend/'.$cc['backend_theme'].'/common/body_start');?>
  <?php echo view('backend/'.$cc['backend_theme'].'/common/header');?>
  <form name="edit_frm" id="edit_frm" action="<?php echo $cc['base_url'].'MailsServers/edit?id='.$form['id']; ?>" method="POST" role="form" enctype='multipart/form-data' novalidate>
  <input type="hidden" name="images_sort_order" id="images_sort_order" value="">
  <input type="hidden" name="gallery_sort_order" id="gallery_sort_order" value="">
  <input type="hidden" name="token" id="token" value="<?php echo $form['token']; ?>">
          <?php echo csrf_field(); ?>
          <div class="container">
          <div class="row align-items-start">
          <div class="row">
          <div class="col-12 p-3">
          <h1>Mails Servers<h1>
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
          <label for="hostname" class="form-label">Hostname</label>
          <input type="text" id="hostname" name="hostname" value="<?php echo $form['hostname']; ?>" class="form-control" aria-describedby="hostnamehelpblock" minlength="2"  required>
          <div class="invalid-feedback">  
          Required valid information. 
          </div>
          <div id="hostnamehelpblock" class="form-text">
            Enter a valid hostname, domain name, or IP address. URLs with http:// or https:// are not allowed. Use only plain formats like example.com or 192.168.1.1
          </div>
          </div>

          <div class="row p-3">
          <label for="email" class="form-label">Email</label>
          <input type="email" id="email" name="email" value="<?php echo $form['email']; ?>" class="form-control" aria-describedby="emailhelpblock" minlength="2"  required>
          <div class="invalid-feedback">  
          Required valid information. 
          </div>
          <div id="emailhelpblock" class="form-text">
            Enter a valid email address in the format user@example.com.
          </div>
          </div>

          <div class="row p-3">
          <label for="username" class="form-label">Username</label>
          <input type="text" id="username" name="username" value="<?php echo $form['username']; ?>" class="form-control" aria-describedby="usernamehelpblock" minlength="2"  required>
          <div class="invalid-feedback">  
          Required valid information. 
          </div>
          <div id="usernamehelpblock" class="form-text">
            Enter a username using only letters, numbers, underscores (_), or hyphens (-). Spaces, emojis, and special characters are not allowed.
          </div>
          </div>

          <div class="row p-3">
          <label for="password" class="form-label">Password</label>
          <input type="text" id="password" name="password" value="<?php echo $form['password']; ?>" class="form-control" aria-describedby="passwordhelpblock" minlength="2"  required>
          <div class="invalid-feedback">  
          Required valid information. 
          </div>
          <div id="passwordhelpblock" class="form-text">
            Enter a strong password using at least 8 characters, including letters, numbers, and symbols. Avoid common words or personal information.
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
          <label for="priority" class="form-label">Priority</label>
          <input type="number" id="priority" name="priority" value="<?php echo $form['priority']; ?>" class="form-control" aria-describedby="priorityhelpblock" minlength="1"  required  onkeypress="return is_key_numeric_fnc(event);" ondrop="return false;" onpaste="return false;">
          <div class="invalid-feedback">  
          Required valid information. 
          </div>
          <div id="priorityhelpblock" class="form-text">
           Choose a priority level from 0 to 9, where 0 is lowest and 9 is highest.
          </div>
          </div>

          <div class="row p-3">
          <label for="crypto" class="form-label">Encryption</label>
          <select class="form-control" id="crypto" name="crypto">
            <option value="">— Select a encryption method —</option>
             <option value="" <?php echo (!empty($form['crypto']) && $form['crypto'] == '') ? 'selected="selected"' : ''; ?>>NONE</option>
             <option value="SSL" <?php echo (!empty($form['crypto']) && $form['crypto'] == 'SSL') ? 'selected="selected"' : ''; ?>>SSL</option>
             <option value="TLS" <?php echo (!empty($form['crypto']) && $form['crypto'] == 'TLS') ? 'selected="selected"' : ''; ?>>TLS</option>
          </select>
          <div class="invalid-feedback">  
            Required valid information.
          </div>
          <div id="cryptohelpblock" class="form-text">
            Select the encryption method used for sending emails securely—options typically include SSL, TLS, or none.
          </div>
        </div>

          <div class="row p-3">
          <label for="port" class="form-label">Port</label>
          <input type="number" id="port" name="port" value="<?php echo $form['port']; ?>" class="form-control" aria-describedby="porthelpblock" minlength="1"  required  onkeypress="return is_key_numeric_fnc(event);" ondrop="return false;" onpaste="return false;">
          <div class="invalid-feedback">  
          Required valid information. 
          </div>
          <div id="porthelpblock" class="form-text">
           Enter the port number used for sending emails (e.g., 587 for TLS or 465 for SSL).
          </div>
          </div>

          <div class="row p-3">
          <label for="relay" class="form-label">Relay</label>
          <input type="number" id="relay" name="relay" value="<?php echo $form['relay']; ?>" class="form-control" aria-describedby="relayhelpblock" minlength="1"  required  onkeypress="return is_key_numeric_fnc(event);" ondrop="return false;" onpaste="return false;">
          <div class="invalid-feedback">  
          Required valid information. 
          </div>
          <div id="relayhelpblock" class="form-text">
           Set the maximum number of emails that can be sent through this relay. Use a numeric value only.
          </div>
          </div>

          <div class="row p-3">
          <label for="relay_type" class="form-label">Relay Type</label>
          <select class="form-control" id="relay_type" name="relay_type" required>
            <option value="">— Select a Relay Type —</option>
            <?php 
            if (!empty($form['relay_types_list'])) {
                foreach ($form['relay_types_list'] as $id => $type) { ?>
                    <option value="<?php echo $id; ?>" <?php echo (!empty($form['relay_type']) && $form['relay_type'] == $id) ? 'selected="selected"' : ''; ?>>
                        <?php echo ucfirst($type['name']); ?>
                    </option>
            <?php 
                }
            } 
            ?>
          </select>
          <div class="invalid-feedback">  
            Required valid information.
          </div>
          <div id="relay_typehelpblock" class="form-text">
            Select the relay type to define how often the sending limit resets.
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


  }
   
  </script>
</body>
<?php echo view('backend/'.$cc['backend_theme'].'/common/page_end');?>