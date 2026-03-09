<?php echo view('backend/'.$cc['backend_theme'].'/common/page_start'); ?>
  <head>
  <?php echo view('backend/'.$cc['backend_theme'].'/common/head');?>
  </head>
  <body><?php echo view('backend/'.$cc['backend_theme'].'/common/body_start');?>
  <?php echo view('backend/'.$cc['backend_theme'].'/common/header');?>
  <form name="edit_frm" id="edit_frm" action="<?php echo $cc['base_url'].'Configurations'; ?>" method="POST" role="form" enctype='multipart/form-data' novalidate>
            <?php echo csrf_field(); ?>
          <div class="container">
          <div class="row align-items-start">
          <div class="row">
          <div class="col-12 p-3">
          <h1>Configurations<h1>
           </div> 
           
          <div class="col-12 p-3 d-flex justify-content-end justify-content-center-sm">
              <button type="submit" class="btn btn-success">Update</button>
          </div>

           </div>

           <div class="row">
          <!--left panel start-->
          <div class="col-8">
          <div class="card">
          <div class="card-header">
          <h5> Website URL</h5>
          </div>
          <div class="card-body">            
          
          <div class="row p-3">
          <label for="base_url" class="form-label">Base URL</label>
          <input type="text" id="base_url" name="base_url" value="<?php echo $form['base_url']; ?>" class="form-control" aria-describedby="base_urlhelpblock" minlength="2"  required>
          <div class="invalid-feedback">  
          Required valid information. 
          </div>
          <div id="base_urlhelpblock" class="form-text">
            Enter a valid base url (Case-Sensitive letters and numbers only, no special characters). Must end with a forward slash (/).
          </div>
          </div>

          <div class="row p-3">
          <label for="assets_url" class="form-label">Assets URL</label>
          <input type="text" id="assets_url" name="assets_url" value="<?php echo $form['assets_url']; ?>" class="form-control" aria-describedby="assets_urlhelpblock" minlength="2"  required>
          <div class="invalid-feedback">  
          Required valid information. 
          </div>
          <div id="assets_urlhelpblock" class="form-text">
            Enter a valid assets url (Case-Sensitive letters and numbers only, no special characters). Must end with a forward slash (/).
          </div>
          </div>

          <div class="row p-3">
          <label for="uploads_url" class="form-label">Uploads URL</label>
          <input type="text" id="uploads_url" name="uploads_url" value="<?php echo $form['uploads_url']; ?>" class="form-control" aria-describedby="uploads_urlhelpblock" minlength="2"  required>
          <div class="invalid-feedback">  
          Required valid information. 
          </div>
          <div id="uploads_urlhelpblock" class="form-text">
            Enter a valid uploads url (Case-Sensitive letters and numbers only, no special characters). Must end with a forward slash (/).
          </div>
          </div>

          <div class="row p-3">
          <label for="img_url" class="form-label">Image URL</label>
          <input type="text" id="img_url" name="img_url" value="<?php echo $form['img_url']; ?>" class="form-control" aria-describedby="img_urlhelpblock" minlength="2"  required>
          <div class="invalid-feedback">  
          Required valid information. 
          </div>
          <div id="img_urlhelpblock" class="form-text">
            Enter a valid image url (Case-Sensitive letters and numbers only, no special characters). Must end with a forward slash (/).
          </div>
          </div>

          <div class="row p-3">
          <label for="css_url" class="form-label">CSS URL</label>
          <input type="text" id="css_url" name="css_url" value="<?php echo $form['css_url']; ?>" class="form-control" aria-describedby="css_urlhelpblock" minlength="2"  required>
          <div class="invalid-feedback">  
          Required valid information. 
          </div>
          <div id="css_urlhelpblock" class="form-text">
            Enter a valid css url (Case-Sensitive letters and numbers only, no special characters). Must end with a forward slash (/).
          </div>
          </div>

          <div class="row p-3">
          <label for="js_url" class="form-label">JS URL</label>
          <input type="text" id="js_url" name="js_url" value="<?php echo $form['js_url']; ?>" class="form-control" aria-describedby="js_urlhelpblock" minlength="2"  required>
          <div class="invalid-feedback">  
          Required valid information. 
          </div>
          <div id="js_urlhelpblock" class="form-text">
            Enter a valid js url (Case-Sensitive letters and numbers only, no special characters). Must end with a forward slash (/).
          </div>
          </div>

          <div class="row p-3">
          <label for="cdn_url" class="form-label">CDN URL</label>
          <input type="text" id="cdn_url" name="cdn_url" value="<?php echo $form['cdn_url']; ?>" class="form-control" aria-describedby="cdn_urlhelpblock" minlength="2"  required>
          <div class="invalid-feedback">  
          Required valid information. 
          </div>
          <div id="cdn_urlhelpblock" class="form-text">
            Enter a valid cdn url (Case-Sensitive letters and numbers only, no special characters). Must end with a forward slash (/).
          </div>
          </div>

          </div>
          </div>  
          
          <div class="card mt-3">
          <div class="card-header">
          <h5> Company Information</h5>
          </div>
          <div class="card-body">
            
          <div class="row p-3">
          <label for="app_author" class="form-label">Author</label>
          <input type="text" id="app_author" name="app_author" value="<?php echo $form['app_author']; ?>" class="form-control" aria-describedby="app_authorhelpblock" minlength="2"  required>
          <div class="invalid-feedback">  
          Required valid information. 
          </div>
          <div id="app_authorhelpblock" class="form-text">
            Enter the full name of the company owner or contact person, between 2 and 64 characters.
          </div>
          </div>
          
          <div class="row p-3">
          <label for="app_name" class="form-label">Name</label>
          <input type="text" id="app_name" name="app_name" value="<?php echo $form['app_name']; ?>" class="form-control" aria-describedby="app_namehelpblock" minlength="2"  required>
          <div class="invalid-feedback">  
          Required valid information. 
          </div>
          <div id="app_namehelpblock" class="form-text">
            Your name must be between 2 and 64 characters. Use the full name as it appears on legal or branding documents.
          </div>
          </div>


          <div class="row p-3">
          <label for="notify_email" class="form-label">Notify Email</label>
          <input type="text" id="notify_email" name="notify_email" value="<?php echo $form['notify_email']; ?>" class="form-control" aria-describedby="notify_emailhelpblock" minlength="2"  required>
          <div class="invalid-feedback">  
          Required valid information. 
          </div>
          <div id="notify_emailhelpblock" class="form-text">
            This email will be used as the sender for all company notifications, including user updates and subscriber messages.
          </div>
          </div>


          <div class="row p-3">
          <label for="app_title" class="form-label">Title</label>
          <input type="text" id="app_title" name="app_title" value="<?php echo $form['app_title']; ?>" class="form-control" aria-describedby="app_titlehelpblock" minlength="2"  required>
          <div class="invalid-feedback">  
          Required valid information. 
          </div>
          <div id="app_titlehelpblock" class="form-text">
           Enter a short, catchy line that describes your company’s mission or services. 
          </div>
          </div>


          <div class="row p-3">
          <label for="app_meta_title" class="form-label">Meta Title</label>
          <input type="text" id="app_meta_title" name="app_meta_title" value="<?php echo $form['app_meta_title']; ?>" class="form-control" aria-describedby="app_meta_titlehelpblock" minlength="2"  required>
          <div class="invalid-feedback">  
          Required valid information. 
          </div>
          <div id="app_meta_titlehelpblock" class="form-text">
            Provide a homepage title (max 60 characters) that includes your company name and core services. Used for SEO and browser tab display.
          </div>
          </div>


          <div class="row p-3">
          <label for="app_meta_description" class="form-label">Meta Description</label>
          <textarea type="text" id="app_meta_description" name="app_meta_description" class="form-control" aria-describedby="app_meta_descriptionhelpblock" minlength="2" rows="5" required><?php echo $form['app_meta_description']; ?></textarea>
          <div class="invalid-feedback">  
          Required valid information. 
          </div>
          <div id="app_meta_descriptionhelpblock" class="form-text">
            Provide a short, compelling description (150–160 characters) that summarizes your company’s services or mission. Used for SEO and search engine previews.
          </div>
          </div>

          <div class="row p-3">
          <label for="app_meta_keywords" class="form-label">Meta Keywords</label>
          <textarea type="text" id="app_meta_keywords" name="app_meta_keywords" class="form-control" aria-describedby="app_meta_keywordshelpblock" minlength="2" rows="5" required><?php echo $form['app_meta_keywords']; ?></textarea>
          <div class="invalid-feedback">  
          Required valid information. 
          </div>
          <div id="app_meta_keywordshelpblock" class="form-text">
           Provide keywords related to your business. Separate each term with a comma. While not used by most search engines, this may help with internal search or metadata.
          </div>
          </div>

          <div class="row p-3">
          <label for="app_founding_date" class="form-label">Founding Date</label>
          <input type="text" id="app_founding_date" name="app_founding_date" value="<?php echo $form['app_founding_date']; ?>" onfocus="date_picker_fnc(this, '', '', 'yy-dd-mm')" onchange="validate_date_fnc(this, 'yyyy-dd-mm')" class="form-control" aria-describedby="app_founding_datehelpblock" required>
          <div class="invalid-feedback">  
          Required valid information. 
          </div>
          <div id="app_founding_datehelpblock" class="form-text">
            Enter the official date your company was founded or registered. Use the format YYYY-MM-DD.
          </div>
          </div>

          <div class="row p-3">
          <label for="app_telephone" class="form-label">Telephone</label>
          <input type="text" id="app_telephone" name="app_telephone" value="<?php echo $form['app_telephone']; ?>" class="form-control" aria-describedby="app_telephonehelpblock" minlength="2"  required>
          <div class="invalid-feedback">  
          Required valid information. 
          </div>
          <div id="app_telephonehelpblock" class="form-text">
            Enter your company’s primary contact number, including country code with international format (e.g., +92-313-333-6426).
          </div>
          </div>

          <div class="row p-3">
          <label for="app_address" class="form-label">Address</label>
          <input type="text" id="app_address" name="app_address" value="<?php echo $form['app_address']; ?>" class="form-control" aria-describedby="app_addresshelpblock" minlength="2"  required>
          <div class="invalid-feedback">  
          Required valid information. 
          </div>
          <div id="app_addresshelpblock" class="form-text">
           Provide the official location of your business. This may be shown on your profile or used for verification.
          </div>
          </div>

          <div class="row p-3">
          <label for="app_city" class="form-label">City</label>
          <input type="text" id="app_city" name="app_city" value="<?php echo $form['app_city']; ?>" class="form-control" aria-describedby="app_cityhelpblock" minlength="2"  required>
          <div class="invalid-feedback">  
          Required valid information. 
          </div>
          <div id="app_cityhelpblock" class="form-text">
            Enter the city where your company is located or registered.
          </div>
          </div>


          <div class="row p-3">
          <label for="app_region" class="form-label">Region</label>
          <input type="text" id="app_region" name="app_region" value="<?php echo $form['app_region']; ?>" class="form-control" aria-describedby="app_regionhelpblock" minlength="2"  required>
          <div class="invalid-feedback">  
          Required valid information. 
          </div>
          <div id="app_regionhelpblock" class="form-text">
            Administrative region where your business is located (e.g., California, Ontario, Punjab)
          </div>
          </div>

          <div class="row p-3">
          <label for="app_postal" class="form-label">Postal Code</label>
          <input type="text" id="app_postal" name="app_postal" value="<?php echo $form['app_postal']; ?>" class="form-control" aria-describedby="app_postalhelpblock" minlength="2"  required>
          <div class="invalid-feedback">  
          Required valid information. 
          </div>
          <div id="app_postalhelpblock" class="form-text">
            Postal code for your business location. Format varies by country (e.g., 10001, SW1A 1AA, 51310).
          </div>
          </div>

           <div class="row p-3">
          <label for="app_country" class="form-label">Country ISO 2-letter</label>
          <input type="text" id="app_country" name="app_country" value="<?php echo $form['app_country']; ?>" class="form-control" aria-describedby="app_countryhelpblock" minlength="2" maxlength="2" required>
          <div class="invalid-feedback">  
          Required valid information. 
          </div>
          <div id="app_countryhelpblock" class="form-text">
            Use ISO 2-letter country code only (e.g., US, PK, GB, CA).
          </div>
          </div>

           <div class="row p-3">
          <label for="app_languages" class="form-label">Languages</label>
          <input type="text" id="app_languages" name="app_languages" value="<?php echo $form['app_languages']; ?>" class="form-control" aria-describedby="app_languageshelpblock" minlength="2"  required>
          <div class="invalid-feedback">  
          Required valid information. 
          </div>
          <div id="app_languageshelpblock" class="form-text">
            Languages available for customer support or services. Use commas to separate (e.g., Urdu, English).
          </div>
          </div>

           <div class="row p-3">
          <label for="app_email" class="form-label">Email</label>
          <input type="email" id="app_email" name="app_email" value="<?php echo $form['app_email']; ?>" class="form-control" aria-describedby="app_emailhelpblock" minlength="2"  required>
          <div class="invalid-feedback">  
          Required valid information. 
          </div>
          <div id="app_emailhelpblock" class="form-text">
            Business email for support or inquiries. Must be a valid format (e.g., info@shonir.com).
          </div>
          </div>

           <div class="row p-3">
          <label for="app_website" class="form-label">Website</label>
          <input type="text" id="app_website" name="app_website" value="<?php echo $form['app_website']; ?>" class="form-control" aria-describedby="app_websitehelpblock" minlength="2"  required>
          <div class="invalid-feedback">  
          Required valid information. 
          </div>
          <div id="app_websitehelpblock" class="form-text">
            Enter your company’s website without http:// or https:// (e.g., shonir.com).
          </div>
          </div>

          </div>
          </div> 

           <div class="card mt-3">
          <div class="card-header">
            <h5>Social Links</h5>
          </div>
          <div class="card-body">

          <div class="row p-3">
          <label for="social_facebook" class="form-label">Facebook URL</label>
          <input type="text" id="social_facebook" name="social_facebook" value="<?php echo $form['social_facebook']; ?>" class="form-control" aria-describedby="social_facebookhelpblock" minlength="2"  required>
          <div class="invalid-feedback">  
          Required valid information. 
          </div>
          <div id="social_facebookhelpblock" class="form-text">
            https://facebook.com/shonirits
          </div>
          </div>

          <div class="row p-3">
          <label for="social_instagram" class="form-label">Instagram URL</label>
          <input type="text" id="social_instagram" name="social_instagram" value="<?php echo $form['social_instagram']; ?>" class="form-control" aria-describedby="social_instagramhelpblock" minlength="2"  required>
          <div class="invalid-feedback">  
          Required valid information. 
          </div>
          <div id="social_instagramhelpblock" class="form-text">
            https://www.instagram.com/shonirits/
          </div>
          </div>

          <div class="row p-3">
          <label for="social_x" class="form-label">X URL</label>
          <input type="text" id="social_x" name="social_x" value="<?php echo $form['social_x']; ?>" class="form-control" aria-describedby="social_xhelpblock" minlength="2"  required>
          <div class="invalid-feedback">  
          Required valid information. 
          </div>
          <div id="social_xhelpblock" class="form-text">
            https://x.com/shonirits
          </div>
          </div>

          <div class="row p-3">
          <label for="social_pinterest" class="form-label">Pinterest URL</label>
          <input type="text" id="social_pinterest" name="social_pinterest" value="<?php echo $form['social_pinterest']; ?>" class="form-control" aria-describedby="social_pinteresthelpblock" minlength="2"  required>
          <div class="invalid-feedback">  
          Required valid information. 
          </div>
          <div id="social_pinteresthelpblock" class="form-text">
            https://www.pinterest.com/shonirits/
          </div>
          </div>

          <div class="row p-3">
          <label for="social_linkedin" class="form-label">LinkedIn URL</label>
          <input type="text" id="social_linkedin" name="social_linkedin" value="<?php echo $form['social_linkedin']; ?>" class="form-control" aria-describedby="social_linkedinhelpblock" minlength="2"  required>
          <div class="invalid-feedback">  
          Required valid information. 
          </div>
          <div id="social_linkedinhelpblock" class="form-text">
           https://www.linkedin.com/company/shonirits/
          </div>
          </div>

          <div class="row p-3">
          <label for="social_youtube" class="form-label">YouTube URL</label>
          <input type="text" id="social_youtube" name="social_youtube" value="<?php echo $form['social_youtube']; ?>" class="form-control" aria-describedby="social_youtubehelpblock" minlength="2"  required>
          <div class="invalid-feedback">  
          Required valid information. 
          </div>
          <div id="social_youtubehelpblock" class="form-text">
            https://www.youtube.com/@shonirits
          </div>
          </div>

          <div class="row p-3">
          <label for="social_blogger" class="form-label">Blogger URL</label>
          <input type="text" id="social_blogger" name="social_blogger" value="<?php echo $form['social_blogger']; ?>" class="form-control" aria-describedby="social_bloggerhelpblock" minlength="2"  required>
          <div class="invalid-feedback">  
          Required valid information. 
          </div>
          <div id="social_bloggerhelpblock" class="form-text">
            https://shonirits.blogspot.com/
          </div>
          </div>

          <div class="row p-3">
          <label for="social_group" class="form-label">Google Group URL</label>
          <input type="text" id="social_group" name="social_group" value="<?php echo $form['social_group']; ?>" class="form-control" aria-describedby="social_grouphelpblock" minlength="2"  required>
          <div class="invalid-feedback">  
          Required valid information. 
          </div>
          <div id="social_grouphelpblock" class="form-text">
            https://groups.google.com/g/shonirits
          </div>
          </div>

          <div class="row p-3">
          <label for="social_tumblr" class="form-label">Tumblr URL</label>
          <input type="text" id="social_tumblr" name="social_tumblr" value="<?php echo $form['social_tumblr']; ?>" class="form-control" aria-describedby="social_tumblrhelpblock" minlength="2"  required>
          <div class="invalid-feedback">  
          Required valid information. 
          </div>
          <div id="social_tumblrhelpblock" class="form-text">
            https://www.tumblr.com/shonirits
          </div>
          </div>

          <div class="row p-3">
          <label for="social_reddit" class="form-label">Reddit URL</label>
          <input type="text" id="social_reddit" name="social_reddit" value="<?php echo $form['social_reddit']; ?>" class="form-control" aria-describedby="social_reddithelpblock" minlength="2"  required>
          <div class="invalid-feedback">  
          Required valid information. 
          </div>
          <div id="social_reddithelpblock" class="form-text">
            https://www.reddit.com/user/shonirits/
          </div>
          </div>

          <div class="row p-3">
          <label for="social_map" class="form-label">Map URL</label>
          <input type="text" id="social_map" name="social_map" value="<?php echo $form['social_map']; ?>" class="form-control" aria-describedby="social_maphelpblock" minlength="2"  required>
          <div class="invalid-feedback">  
          Required valid information. 
          </div>
          <div id="social_maphelpblock" class="form-text">
            https://www.google.com/maps/place/Shonir+Corporation/@32.4967665,74.4916488,17z/
          </div>
          </div>

          <div class="row p-3">
          <label for="social_whatsapp" class="form-label">WhatsApp URL</label>
          <input type="text" id="social_whatsapp" name="social_whatsapp" value="<?php echo $form['social_whatsapp']; ?>" class="form-control" aria-describedby="social_whatsapphelpblock" minlength="2"  required>
          <div class="invalid-feedback">  
          Required valid information. 
          </div>
          <div id="social_whatsapphelpblock" class="form-text">
            https://wa.me/923133336426
          </div>
          </div>

          <div class="row p-3">
          <label for="social_tiktok" class="form-label">Tiktok URL</label>
          <input type="text" id="social_tiktok" name="social_tiktok" value="<?php echo $form['social_tiktok']; ?>" class="form-control" aria-describedby="social_tiktokhelpblock" minlength="2"  required>
          <div class="invalid-feedback">  
          Required valid information. 
          </div>
          <div id="social_tiktokhelpblock" class="form-text">
            https://tiktok.com/@shonirits
          </div>
          </div>

          <div class="row p-3">
          <label for="social_telegram" class="form-label">Telegram URL</label>
          <input type="text" id="social_telegram" name="social_telegram" value="<?php echo $form['social_telegram']; ?>" class="form-control" aria-describedby="social_telegramhelpblock" minlength="2"  required>
          <div class="invalid-feedback">  
          Required valid information. 
          </div>
          <div id="social_telegramhelpblock" class="form-text">
            https://telegram.me/shonirits
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
    <h5>Environment Settings</h5>
  </div>
  <div class="card-body">

   
    <div class="mb-4">
      <label for="frontend_theme" class="form-label">Frontend Theme</label>
      <select class="form-select" id="frontend_theme" name="frontend_theme">
        <?php foreach($frontend_themes as $f_theme){ ?>
          <option value="<?php echo $f_theme; ?>" <?php echo ($f_theme == $form['frontend_theme']) ? 'selected' : ''; ?>><?php echo $f_theme; ?></option>
        <?php } ?>
      </select>
      <div class="form-text">
        Choose the visual style for the public-facing part of your website.
      </div>
    </div>


    <div class="mb-4">
      <label for="backend_theme" class="form-label">Backend Theme</label>
      <select class="form-select" id="backend_theme" name="backend_theme">
        <?php foreach($backend_themes as $b_theme){ ?>
          <option value="<?php echo $b_theme; ?>" <?php echo ($b_theme == $form['backend_theme']) ? 'selected' : ''; ?>><?php echo $b_theme; ?></option>
        <?php } ?>
      </select>
      <div class="form-text">
        Select the theme for your admin dashboard or backend interface.
      </div>
    </div>

 
    <div class="mb-4">
      <label for="cache_time" class="form-label">Cache Time</label>
      <input type="text" id="cache_time" name="cache_time" class="form-control" min="0" required value="<?php echo $form['cache_time']; ?>"  onkeypress="return is_key_numeric_fnc(event);" ondrop="return false;" onpaste="return false;" >
      <div class="invalid-feedback">
        Please enter a valid cache duration in seconds.
      </div>
      <div class="form-text">
        Set how long data should be cached before refreshing. Use seconds (e.g. <strong>300</strong> for 5 minutes).
      </div>
    </div>


    <div class="mb-4">
      <label for="app_key" class="form-label">App Key</label>
      <input type="text" id="app_key" name="app_key" class="form-control" minlength="2" required value="<?php echo $form['app_key']; ?>">
      <div class="invalid-feedback">
        App Key is required and must be valid.
      </div>
      <div class="form-text">
         Your Application Key is required for secure access to the admin login page. Without a valid App Key, access is restricted. Do not use special characters, spaces, or symbols.
      </div>
    </div>

    <div class="mb-4">
      <div class="form-check form-switch">
        <input class="form-check-input" type="checkbox" id="developer_mode" name="developer_mode" value="TRUE" <?php echo ($form['developer_mode'] == 'TRUE') ? 'checked' : ''; ?>>
        <label class="form-check-label" for="developer_mode">Enable Developer Mode</label>
      </div>
      <div class="form-text">
        When enabled, visitors will see a maintenance notice. Registration, login, and ordering will be disabled.
      </div>
    </div>

    <div id="devModeNotice" class="alert alert-warning d-none mt-3">
      <strong>Developer Mode Enabled:</strong> The site is currently under maintenance. Registration, login, and order placement are temporarily disabled.
    </div>

  </div>
</div>


            <div class="card  mt-3">
  <div class="card-header">
    <h5>Miscellaneous</h5>
  </div>
  <div class="card-body">
    <div class="row g-3">

      <div class="col-md-6">
        <div class="form-check form-switch">
          <input class="form-check-input" type="checkbox" id="price" name="price" value="TRUE" <?php echo ($form['price'] == 'TRUE') ? 'checked' : ''; ?>>
          <label class="form-check-label" for="price">Pricing</label>
        </div>
      </div>

      <div class="col-md-6">
        <div class="form-check form-switch">
          <input class="form-check-input" type="checkbox" id="ratings" name="ratings" value="TRUE" <?php echo ($form['ratings'] == 'TRUE') ? 'checked' : ''; ?>>
          <label class="form-check-label" for="ratings">Ratings</label>
        </div>
      </div>

      <div class="col-md-6">
        <div class="form-check form-switch">
          <input class="form-check-input" type="checkbox" id="likes" name="likes" value="TRUE" <?php echo ($form['likes'] == 'TRUE') ? 'checked' : ''; ?>>
          <label class="form-check-label" for="likes">Likes</label>
        </div>
      </div>

      <div class="col-md-6">
        <div class="form-check form-switch">
          <input class="form-check-input" type="checkbox" id="promo_code" name="promo_code" value="TRUE" <?php echo ($form['promo_code'] == 'TRUE') ? 'checked' : ''; ?>>
          <label class="form-check-label" for="promo_code">Promo Code</label>
        </div>
      </div>

      <div class="col-md-6">
        <div class="form-check form-switch">
          <input class="form-check-input" type="checkbox" id="badge_newbie" name="badge_newbie" value="TRUE" <?php echo ($form['badge_newbie'] == 'TRUE') ? 'checked' : ''; ?>>
          <label class="form-check-label" for="badge_newbie">Newbie</label>
        </div>
      </div>

      <div class="col-md-6">
        <div class="form-check form-switch">
          <input class="form-check-input" type="checkbox" id="badge_featured" name="badge_featured" value="TRUE" <?php echo ($form['badge_featured'] == 'TRUE') ? 'checked' : ''; ?>>
          <label class="form-check-label" for="badge_featured">Featured</label>
        </div>
      </div>

      <div class="col-md-6">
        <div class="form-check form-switch">
          <input class="form-check-input" type="checkbox" id="badge_sale" name="badge_sale" value="TRUE" <?php echo ($form['badge_sale'] == 'TRUE') ? 'checked' : ''; ?>>
          <label class="form-check-label" for="badge_sale">onSale</label>
        </div>
      </div>

    </div>
  </div>
</div>

           <div class="card mt-3">
          <div class="card-header">
          <h5> Images</h5>
          </div>
          <div class="card-body">

          <div class="row p-3">
        <label class="form-label">Hero Slides</label>

        <div class="col-md-6 mb-3">
          <label for="hero_slides_width" class="form-label">Width (PX)</label>
          <input type="text" id="hero_slides_width" name="hero_slides_width" value="<?php echo $form['hero_slides_width']; ?>" class="form-control" aria-describedby="hero_slides_help" minlength="2" onkeypress="return is_key_numeric_fnc(event);" ondrop="return false;" onpaste="return false;" required>
          <div class="invalid-feedback">
            Required valid information.
          </div>
        </div>

        <div class="col-md-6 mb-3">
          <label for="hero_slides_height" class="form-label">Height (PX)</label>
          <input type="text" id="hero_slides_height" name="hero_slides_height" value="<?php echo $form['hero_slides_height']; ?>" class="form-control" aria-describedby="hero_slides_help" minlength="2"  onkeypress="return is_key_numeric_fnc(event);" ondrop="return false;" onpaste="return false;" required>
          <div class="invalid-feedback">
            Required valid information.
          </div>
        </div>

        <div class="col-12">
          <div id="hero_slides_help" class="form-text">
            Specify the hero slides width and height in pixels.
          </div>
        </div>
      </div>

         
         <div class="row p-3">
        <label class="form-label">Tiny Images</label>

        <div class="col-md-6 mb-3">
          <label for="tiny_image_width" class="form-label">Width (PX)</label>
          <input type="text" id="tiny_image_width" name="tiny_image_width" value="<?php echo $form['tiny_image_width']; ?>" class="form-control" aria-describedby="tiny_image_help" minlength="2"  onkeypress="return is_key_numeric_fnc(event);" ondrop="return false;" onpaste="return false;" required>
          <div class="invalid-feedback">
            Required valid information.
          </div>
        </div>

        <div class="col-md-6 mb-3">
          <label for="tiny_image_height" class="form-label">Height (PX)</label>
          <input type="text" id="tiny_image_height" name="tiny_image_height" value="<?php echo $form['tiny_image_height']; ?>" class="form-control" aria-describedby="tiny_image_help" minlength="2"  onkeypress="return is_key_numeric_fnc(event);" ondrop="return false;" onpaste="return false;" required>
          <div class="invalid-feedback">
            Required valid information.
          </div>
        </div>

        <div class="col-12">
          <div id="tiny_image_help" class="form-text">
            Specify the tiny image width and height in pixels.
          </div>
        </div>
      </div>


      <div class="row p-3">
        <label class="form-label">Small Images</label>

        <div class="col-md-6 mb-3">
          <label for="small_image_width" class="form-label">Width (PX)</label>
          <input type="text" id="small_image_width" name="small_image_width" value="<?php echo $form['small_image_width']; ?>" class="form-control" aria-describedby="small_image_help" minlength="2"  onkeypress="return is_key_numeric_fnc(event);" ondrop="return false;" onpaste="return false;" required>
          <div class="invalid-feedback">
            Required valid information.
          </div>
        </div>

        <div class="col-md-6 mb-3">
          <label for="small_image_height" class="form-label">Height (PX)</label>
          <input type="text" id="small_image_height" name="small_image_height" value="<?php echo $form['small_image_height']; ?>" class="form-control" aria-describedby="small_image_help" minlength="2"  onkeypress="return is_key_numeric_fnc(event);" ondrop="return false;" onpaste="return false;" required>
          <div class="invalid-feedback">
            Required valid information.
          </div>
        </div>

        <div class="col-12">
          <div id="small_image_help" class="form-text">
            Specify the small image width and height in pixels.
          </div>
        </div>
      </div>

      <div class="row p-3">
        <label class="form-label">Medium Images</label>

        <div class="col-md-6 mb-3">
          <label for="medium_image_width" class="form-label">Width (PX)</label>
          <input type="text" id="medium_image_width" name="medium_image_width" value="<?php echo $form['medium_image_width']; ?>" class="form-control" aria-describedby="medium_image_help" minlength="2"  onkeypress="return is_key_numeric_fnc(event);" ondrop="return false;" onpaste="return false;" required>
          <div class="invalid-feedback">
            Required valid information.
          </div>
        </div>

        <div class="col-md-6 mb-3">
          <label for="medium_image_height" class="form-label">Height (PX)</label>
          <input type="text" id="medium_image_height" name="medium_image_height" value="<?php echo $form['medium_image_height']; ?>" class="form-control" aria-describedby="medium_image_help" minlength="2"  onkeypress="return is_key_numeric_fnc(event);" ondrop="return false;" onpaste="return false;" required>
          <div class="invalid-feedback">
            Required valid information.
          </div>
        </div>

        <div class="col-12">
          <div id="medium_image_help" class="form-text">
            Specify the medium image width and height in pixels.
          </div>
        </div>
      </div>

      <div class="row p-3">
        <label class="form-label">Large Images</label>

        <div class="col-md-6 mb-3">
          <label for="large_image_width" class="form-label">Width (PX)</label>
          <input type="text" id="large_image_width" name="large_image_width" value="<?php echo $form['large_image_width']; ?>" class="form-control" aria-describedby="large_image_help" minlength="2"  onkeypress="return is_key_numeric_fnc(event);" ondrop="return false;" onpaste="return false;" required>
          <div class="invalid-feedback">
            Required valid information.
          </div>
        </div>

        <div class="col-md-6 mb-3">
          <label for="large_image_height" class="form-label">Height (PX)</label>
          <input type="text" id="large_image_height" name="large_image_height" value="<?php echo $form['large_image_height']; ?>" class="form-control" aria-describedby="large_image_help" minlength="2"  onkeypress="return is_key_numeric_fnc(event);" ondrop="return false;" onpaste="return false;" required>
          <div class="invalid-feedback">
            Required valid information.
          </div>
        </div>

        <div class="col-12">
          <div id="large_image_help" class="form-text">
            Specify the large image width and height in pixels.
          </div>
        </div>
      </div>


       <div class="row p-3">
        <label class="form-label">Category Images</label>

        <div class="col-md-6 mb-3">
          <label for="category_image_width" class="form-label">Width (PX)</label>
          <input type="text" id="category_image_width" name="category_image_width" value="<?php echo $form['category_image_width']; ?>" class="form-control" aria-describedby="large_image_help" minlength="2"  onkeypress="return is_key_numeric_fnc(event);" ondrop="return false;" onpaste="return false;" required>
          <div class="invalid-feedback">
            Required valid information.
          </div>
        </div>

        <div class="col-md-6 mb-3">
          <label for="category_image_height" class="form-label">Height (PX)</label>
          <input type="text" id="category_image_height" name="category_image_height" value="<?php echo $form['category_image_height']; ?>" class="form-control" aria-describedby="large_image_help" minlength="2"  onkeypress="return is_key_numeric_fnc(event);" ondrop="return false;" onpaste="return false;" required>
          <div class="invalid-feedback">
            Required valid information.
          </div>
        </div>

        <div class="col-12">
          <div id="large_image_help" class="form-text">
            Specify the category image width and height in pixels.
          </div>
        </div>
      </div>

      <div class="row p-3">
          <label for="image_quality" class="form-label">Image Quality</label>
          <input type="text" id="image_quality" name="image_quality" value="<?php echo $form['image_quality']; ?>" class="form-control" aria-describedby="image_qualityhelpblock" minlength="2"   onkeypress="return is_key_numeric_fnc(event);" ondrop="return false;" onpaste="return false;" required>
          <div class="invalid-feedback">  
          Required valid information. 
          </div>
          <div id="image_qualityhelpblock" class="form-text">
            Set the image quality level from 0 to 100. Lower values reduce size; higher values improve quality (numeric only).
          </div>
          </div>

          </div>
          </div>

           <div class="card mt-3">
          <div class="card-header">
          <h5> Item Listing </h5>
          </div>
          <div class="card-body">

          <div class="row p-3">
          <label for="limit_items_list" class="form-label">Items By Category</label>
          <input type="text" id="limit_items_list" name="limit_items_list" value="<?php echo $form['limit_items_list']; ?>" class="form-control" aria-describedby="limit_items_listhelpblock" minlength="2"  onkeypress="return is_key_numeric_fnc(event);" ondrop="return false;" onpaste="return false;"  required>
          <div class="invalid-feedback">  
          Required valid information. 
          </div>
          <div id="limit_items_listhelpblock" class="form-text">
            Specify the maximum number of items to display per page on the item by category page (numeric only).
          </div>
          </div>


          <div class="row p-3">
          <label for="limit_items_newbie" class="form-label">New Items Page</label>
          <input type="text" id="limit_items_newbie" name="limit_items_newbie" value="<?php echo $form['limit_items_newbie']; ?>" class="form-control" aria-describedby="limit_items_newbiehelpblock" minlength="2"  onkeypress="return is_key_numeric_fnc(event);" ondrop="return false;" onpaste="return false;"  required>
          <div class="invalid-feedback">  
          Required valid information. 
          </div>
          <div id="limit_items_newbiehelpblock" class="form-text">
           Specify the maximum number of items to display per page on the new items listing page (numeric only).
          </div>
          </div>


          <div class="row p-3">
          <label for="limit_items_featured" class="form-label">Featured Items Page</label>
          <input type="text" id="limit_items_featured" name="limit_items_featured" value="<?php echo $form['limit_items_featured']; ?>" class="form-control" aria-describedby="limit_items_featuredhelpblock" minlength="2"  onkeypress="return is_key_numeric_fnc(event);" ondrop="return false;" onpaste="return false;"  required>
          <div class="invalid-feedback">  
          Required valid information. 
          </div>
          <div id="limit_items_featuredhelpblock" class="form-text">
           Specify the maximum number of items to display per page on the featured items listing page (numeric only).
          </div>
          </div>


          <div class="row p-3">
          <label for="limit_items_sale" class="form-label">onSale Items Page</label>
          <input type="text" id="limit_items_sale" name="limit_items_sale" value="<?php echo $form['limit_items_sale']; ?>" class="form-control" aria-describedby="limit_items_salehelpblock" minlength="2"  onkeypress="return is_key_numeric_fnc(event);" ondrop="return false;" onpaste="return false;"  required>
          <div class="invalid-feedback">  
          Required valid information. 
          </div>
          <div id="limit_items_salehelpblock" class="form-text">
            Specify the maximum number of items to display per page on the onSale items listing page (numeric only).
          </div>
          </div>


          <div class="row p-3">
          <label for="limit_items_trending" class="form-label">Trending Items Page</label>
          <input type="text" id="limit_items_trending" name="limit_items_trending" value="<?php echo $form['limit_items_trending']; ?>" class="form-control" aria-describedby="limit_items_trendinghelpblock" minlength="2"  onkeypress="return is_key_numeric_fnc(event);" ondrop="return false;" onpaste="return false;"  required>
          <div class="invalid-feedback">  
          Required valid information. 
          </div>
          <div id="limit_items_trendinghelpblock" class="form-text">
           Specify the maximum number of items to display per page on the trending items listing page (numeric only).
          </div>
          </div>

          <div class="row p-3">
          <label for="limit_items_search" class="form-label">Search Items Page</label>
          <input type="text" id="limit_items_search" name="limit_items_search" value="<?php echo $form['limit_items_search']; ?>" class="form-control" aria-describedby="limit_items_searchhelpblock" minlength="2"  onkeypress="return is_key_numeric_fnc(event);" ondrop="return false;" onpaste="return false;"  required>
          <div class="invalid-feedback">  
          Required valid information. 
          </div>
          <div id="limit_items_searchhelpblock" class="form-text">
            Specify the maximum number of items to display per page on the search items listing page (numeric only).
          </div>
          </div>

          <div class="row p-3">
          <label for="limit_items_all" class="form-label">All Items Page</label>
          <input type="text" id="limit_items_all" name="limit_items_all" value="<?php echo $form['limit_items_all']; ?>" class="form-control" aria-describedby="limit_items_allhelpblock" minlength="2"  onkeypress="return is_key_numeric_fnc(event);" ondrop="return false;" onpaste="return false;"  required>
          <div class="invalid-feedback">  
          Required valid information. 
          </div>
          <div id="limit_items_allhelpblock" class="form-text">
            Specify the maximum number of items to display per page on the all items listing page (numeric only).
          </div>
          </div>

           <div class="row p-3">
          <label for="limit_items_related" class="form-label">Related Items</label>
          <input type="text" id="limit_items_related" name="limit_items_related" value="<?php echo $form['limit_items_related']; ?>" class="form-control" aria-describedby="limit_items_relatedhelpblock" minlength="2"  onkeypress="return is_key_numeric_fnc(event);" ondrop="return false;" onpaste="return false;"  required>
          <div class="invalid-feedback">  
          Required valid information. 
          </div>
          <div id="limit_items_relatedhelpblock" class="form-text">
          Specify the maximum number of related items to display on the item details page (numeric only).
          </div>
          </div>

          <div class="row p-3">
          <label for="limit_items_same" class="form-label">In the Same Categories Items</label>
          <input type="text" id="limit_items_same" name="limit_items_same" value="<?php echo $form['limit_items_same']; ?>" class="form-control" aria-describedby="limit_items_samehelpblock" minlength="2"  onkeypress="return is_key_numeric_fnc(event);" ondrop="return false;" onpaste="return false;"  required>
          <div class="invalid-feedback">  
          Required valid information. 
          </div>
          <div id="limit_items_samehelpblock" class="form-text">
           Specify the maximum number of items from the same category to display on the item details page (numeric only).
          </div>
          </div>
  
          </div>
          </div>
    

          <div class="card mt-3">
          <div class="card-header">
          <h5> IP Info Token </h5>
          </div>
          <div class="card-body">

          <div class="row p-3">
          <label for="ip_info_token" class="form-label">Token</label>
          <input type="text" id="ip_info_token" name="ip_info_token" value="<?php echo $form['ip_info_token']; ?>" class="form-control" aria-describedby="ip_info_tokenhelpblock" minlength="2"  required>
          <div class="invalid-feedback">  
          Required valid information. 
          </div>
          <div id="ip_info_tokenhelpblock" class="form-text">
            This token allows your app to detect visitor countries and enrich traffic analytics. Get your token from ipinfo.io.
          </div>
          </div>
        

          </div>
          </div>
            
          <div class="card mt-3">
          <div class="card-header">
            <h5>Celebiz API</h5>
          </div>
          <div class="card-body">
          
          <div class="row p-3">
          <label for="celebiz_public_key" class="form-label">Public Key</label>
          <input type="text" id="celebiz_public_key" name="celebiz_public_key" value="<?php echo $form['celebiz_public_key']; ?>" class="form-control" aria-describedby="celebiz_public_keyhelpblock" minlength="2"  required>
          <div class="invalid-feedback">  
          Required valid information. 
          </div>
          <div id="celebiz_public_keyhelpblock" class="form-text">
            This key connects your app to Celebiz for real-time currency rates. Get your free public key from www.celebiz.com.
          </div>
          </div>

          <div class="row p-3">
          <label for="celebiz_secret_key" class="form-label">Secret Key</label>
          <input type="text" id="celebiz_secret_key" name="celebiz_secret_key" value="<?php echo $form['celebiz_secret_key']; ?>" class="form-control" aria-describedby="celebiz_secret_keyhelpblock" minlength="2"  required>
          <div class="invalid-feedback">  
          Required valid information. 
          </div>
          <div id="celebiz_secret_keyhelpblock" class="form-text">
            This key works with your Celebiz public key to securely fetch live currency rates. Visit www.celebiz.com to get your credentials.
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
          <h5> Developer Mode Notice</h5>
          </div>
          <div class="card-body">

          <textarea class="form-control" id="developer_mode_notice" name="developer_mode_notice" class="form-control" aria-describedby="developer_mode_noticehelpblock" minlength="2"  required rows="8"><?php echo $form['developer_mode_notice']; ?></textarea>
          <div class="invalid-feedback">  
          Required valid information. 
          </div>
          <div id="developer_mode_noticehelpblock" class="form-text">
            When developer mode is enabled, this notification message will be displayed at the top of each page on the website.
          </div>

          </div>
          </div>
           </div>
          </div>


           <div class="row">
           <div class="col-12">
           <div class="card mt-3">
          <div class="card-header">
          <h5> Head Code</h5>
          </div>
          <div class="card-body">

          <textarea class="form-control" id="head_code" name="head_code" class="form-control" aria-describedby="head_codehelpblock" minlength="2"  rows="12"><?php echo $form['head_code']; ?></textarea>
          <div class="invalid-feedback">  
          Required valid information. 
          </div>
          <div id="head_codehelpblock" class="form-text">
            Add custom HTML, CSS, or JavaScript code to be injected into the &lt;head&gt; section of every page. Useful for meta tags, analytics scripts, or styling.
          </div>

          </div>
          </div>
           </div>
          </div>


          <div class="row">
           <div class="col-12">
           <div class="card mt-3">
          <div class="card-header">
          <h5> End Code</h5>
          </div>
          <div class="card-body">

      <textarea class="form-control" id="end_code" name="end_code" class="form-control" aria-describedby="end_codehelpblock" minlength="2"  rows="12"><?php echo $form['end_code']; ?></textarea>
          <div class="invalid-feedback">  
          Required valid information. 
          </div>
          <div id="end_codehelpblock" class="form-text">
             Add custom code to be injected at the end of every page, just before the closing &lt;/body&gt; tag. Ideal for scripts, tracking pixels, or footer enhancements.
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

       prevent_newlines_fnc('app_meta_description');
       prevent_newlines_fnc('app_meta_keywords');

  }
    
  </script>

</body>
<?php echo view('backend/'.$cc['backend_theme'].'/common/page_end');?>