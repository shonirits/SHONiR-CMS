<?php echo view('backend/'.$cc['backend_theme'].'/common/page_start'); ?>
  <head>
  <?php echo view('backend/'.$cc['backend_theme'].'/common/head');?>
  </head>
  <body><?php echo view('backend/'.$cc['backend_theme'].'/common/body_start');?>
  <?php echo view('backend/'.$cc['backend_theme'].'/common/header');?>
  <form name="add_frm" id="add_frm" action="<?php echo $cc['base_url'].'Items/add'; ?>" method="POST" role="form" enctype='multipart/form-data' novalidate>
  <input type="hidden" name="images_sort_order" id="images_sort_order" value="">
  <input type="hidden" name="gallery_sort_order" id="gallery_sort_order" value="">
  <input type="hidden" name="token" id="token" value="<?php echo $form['token']; ?>">
          <?php echo csrf_field(); ?>
          <div class="container">
          <div class="row align-items-start">
          <div class="row">
          <div class="col-12 p-3">
          <h1>Items<h1>
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
          <label for="categories" class="form-label">Categories</label>
          <select class="form-control" id="categories" name="categories[]" multiple="multiple" required>
          
          <?php 
          if($form['db_categories']){
          foreach($form['db_categories'] as $category){  ?>
          <option value="<?php echo $category['category_id']?>" selected="selected" selected><?php echo $category['name']?></option>
          <?php }}?>
          </select>
          <div class="invalid-feedback">  
          Required valid information. 
          </div>
          <div id="categorieshelpblock" class="form-text">
            You can select multiple categories for this item.
          </div>
          </div>

          <div class="row p-3">
          <label for="sections" class="form-label">Sections</label>
          <select class="form-control" id="sections" name="sections[]" multiple="multiple" required>
          
          <?php 
          if($form['db_sections']){
          foreach($form['db_sections'] as $section){  ?>
          <option value="<?php echo $section['section_id']?>" selected="selected" selected><?php echo $section['name']?></option>
          <?php }}?>
          </select>
          <div class="invalid-feedback">  
          Required valid information. 
          </div>
          <div id="sectionshelpblock" class="form-text">
            You can select multiple sections for this item.
          </div>
          </div>

          <div class="row p-3">
          <label for="brands" class="form-label">Brands</label>
          <select class="form-control" id="brands" name="brands[]" multiple="multiple" required>
          
          <?php 
          if($form['db_brands']){
          foreach($form['db_brands'] as $brand){  ?>
          <option value="<?php echo $brand['brand_id']?>" selected="selected" selected><?php echo $brand['name']?></option>
          <?php }}?>
          </select>
          <div class="invalid-feedback">  
          Required valid information. 
          </div>
          <div id="brandshelpblock" class="form-text">
            You can select multiple brands for this item.
          </div>
          </div>

          <div class="row p-3">
          <label for="awards" class="form-label">Awards</label>
          <select class="form-control" id="awards" name="awards[]" multiple="multiple" required>
          
          <?php 
          if($form['db_awards']){
          foreach($form['db_awards'] as $award){  ?>
          <option value="<?php echo $award['award_id']?>" selected="selected" selected><?php echo $award['name']?></option>
          <?php }}?>
          </select>
          <div class="invalid-feedback">  
          Required valid information. 
          </div>
          <div id="awardshelpblock" class="form-text">
            You can select multiple awards for this item.
          </div>
          </div>

          <div class="row p-3">
          <label for="industries" class="form-label">Industries</label>
          <select class="form-control" id="industries" name="industries[]" multiple="multiple" required>
          
          <?php 
          if($form['db_industries']){
          foreach($form['db_industries'] as $industry){  ?>
          <option value="<?php echo $industry['industry_id']?>" selected="selected" selected><?php echo $industry['name']?></option>
          <?php }}?>
          </select>
          <div class="invalid-feedback">  
          Required valid information. 
          </div>
          <div id="industrieshelpblock" class="form-text">
            You can select multiple industries for this item.
          </div>
          </div>

          <div class="row p-3">
          <label for="regions" class="form-label">Regions</label>
          <select class="form-control" id="regions" name="regions[]" multiple="multiple" required>
          
          <?php 
          if($form['db_regions']){
          foreach($form['db_regions'] as $region){  ?>
          <option value="<?php echo $region['region_id']?>" selected="selected" selected><?php echo $region['name']?></option>
          <?php }}?>
          </select>
          <div class="invalid-feedback">  
          Required valid information. 
          </div>
          <div id="regionshelpblock" class="form-text">
            You can select multiple regions for this item.
          </div>
          </div>

          <div class="row p-3">
          <label for="voices" class="form-label">Voices</label>
          <select class="form-control" id="voices" name="voices[]" multiple="multiple" required>
          
          <?php 
          if($form['db_voices']){
          foreach($form['db_voices'] as $voice){  ?>
          <option value="<?php echo $voice['voice_id']?>" selected="selected" selected><?php echo $voice['name']?></option>
          <?php }}?>
          </select>
          <div class="invalid-feedback">  
          Required valid information. 
          </div>
          <div id="voiceshelpblock" class="form-text">
            You can select multiple voices for this item.
          </div>
          </div>


          <div class="row p-3">
          <label for="natives" class="form-label">Natives</label>
          <select class="form-control" id="natives" name="natives[]" multiple="multiple" required>
          
          <?php 
          if($form['db_natives']){
          foreach($form['db_natives'] as $native){  ?>
          <option value="<?php echo $native['native_id']?>" selected="selected" selected><?php echo $native['name']?></option>
          <?php }}?>
          </select>
          <div class="invalid-feedback">  
          Required valid information. 
          </div>
          <div id="nativeshelpblock" class="form-text">
            You can select multiple natives for this item.
          </div>
          </div>


          <div class="row p-3">
          <label for="places" class="form-label">Places</label>
          <select class="form-control" id="places" name="places[]" multiple="multiple" required>
          
          <?php 
          if($form['db_places']){
          foreach($form['db_places'] as $place){  ?>
          <option value="<?php echo $place['place_id']?>" selected="selected" selected><?php echo $place['name']?></option>
          <?php }}?>
          </select>
          <div class="invalid-feedback">  
          Required valid information. 
          </div>
          <div id="placeshelpblock" class="form-text">
            You can select multiple places for this item.
          </div>
          </div>

          <div class="row p-3">
          <label for="actors" class="form-label">Actors</label>
          <select class="form-control" id="actors" name="actors[]" multiple="multiple" required>
          
          <?php 
          if($form['db_actors']){
          foreach($form['db_actors'] as $actor){  ?>
          <option value="<?php echo $actor['talent_id']?>" selected="selected" selected><?php echo $actor['name']?></option>
          <?php }}?>
          </select>
          <div class="invalid-feedback">  
          Required valid information. 
          </div>
          <div id="actorshelpblock" class="form-text">
            You can select multiple actors for this item.
          </div>
          </div>

          <div class="row p-3">
          <label for="actresses" class="form-label">Actresses</label>
          <select class="form-control" id="actresses" name="actresses[]" multiple="multiple" required>
          
          <?php 
          if($form['db_actresses']){
          foreach($form['db_actresses'] as $actress){  ?>
          <option value="<?php echo $actress['talent_id']?>" selected="selected" selected><?php echo $actress['name']?></option>
          <?php }}?>
          </select>
          <div class="invalid-feedback">  
          Required valid information. 
          </div>
          <div id="actresseshelpblock" class="form-text">
            You can select multiple actresses for this item.
          </div>
          </div>


           <div class="row p-3">
          <label for="directors" class="form-label">Directors</label>
          <select class="form-control" id="directors" name="directors[]" multiple="multiple" required>
          
          <?php 
          if($form['db_directors']){
          foreach($form['db_directors'] as $director){  ?>
          <option value="<?php echo $director['talent_id']?>" selected="selected" selected><?php echo $director['name']?></option>
          <?php }}?>
          </select>
          <div class="invalid-feedback">  
          Required valid information. 
          </div>
          <div id="directorshelpblock" class="form-text">
            You can select multiple directors for this item.
          </div>
          </div>

          <div class="row p-3">
          <label for="producers" class="form-label">Producers</label>
          <select class="form-control" id="producers" name="producers[]" multiple="multiple" required>
          
          <?php 
          if($form['db_producers']){
          foreach($form['db_producers'] as $producer){  ?>
          <option value="<?php echo $producer['talent_id']?>" selected="selected" selected><?php echo $producer['name']?></option>
          <?php }}?>
          </select>
          <div class="invalid-feedback">  
          Required valid information. 
          </div>
          <div id="producershelpblock" class="form-text">
            You can select multiple producers for this item.
          </div>
          </div>


          <div class="row p-3">
          <label for="writers" class="form-label">Writers</label>
          <select class="form-control" id="writers" name="writers[]" multiple="multiple" required>
          
          <?php 
          if($form['db_writers']){
          foreach($form['db_writers'] as $writer){  ?>
          <option value="<?php echo $writer['talent_id']?>" selected="selected" selected><?php echo $writer['name']?></option>
          <?php }}?>
          </select>
          <div class="invalid-feedback">  
          Required valid information. 
          </div>
          <div id="writershelpblock" class="form-text">
            You can select multiple writers for this item.
          </div>
          </div>


          <div class="row p-3">
          <label for="singers" class="form-label">Singers</label>
          <select class="form-control" id="singers" name="singers[]" multiple="multiple" required>
          <?php 
          if($form['db_singers']){
          foreach($form['db_singers'] as $singer){  ?>
          <option value="<?php echo $singer['talent_id']?>" selected="selected" selected><?php echo $singer['name']?></option>
          <?php }}?>
          </select>
          <div class="invalid-feedback">  
          Required valid information. 
          </div>
          <div id="singershelpblock" class="form-text">
            You can select multiple singers for this item.
          </div>
          </div>


          <div class="row p-3">
          <label for="designers" class="form-label">Designers</label>
          <select class="form-control" id="designers" name="designers[]" multiple="multiple" required>
          <?php 
          if($form['db_designers']){
          foreach($form['db_designers'] as $designer){  ?>
          <option value="<?php echo $designer['talent_id']?>" selected="selected" selected><?php echo $designer['name']?></option>
          <?php }}?>
          </select>
          <div class="invalid-feedback">  
          Required valid information. 
          </div>
          <div id="designershelpblock" class="form-text">
            You can select multiple designers for this item.
          </div>
          </div>


          <div class="row p-3">
          <label for="editors" class="form-label">Editors</label>
          <select class="form-control" id="editors" name="editors[]" multiple="multiple" required>
          <?php 
          if($form['db_editors']){
          foreach($form['db_editors'] as $editor){  ?>
          <option value="<?php echo $editor['talent_id']?>" selected="selected" selected><?php echo $editor['name']?></option>
          <?php }}?>
          </select>
          <div class="invalid-feedback">  
          Required valid information. 
          </div>
          <div id="editorshelpblock" class="form-text">
            You can select multiple editors for this item.
          </div>
          </div>


          <div class="row p-3">
          <label for="cinematographers" class="form-label">Cinematographers</label>
          <select class="form-control" id="cinematographers" name="cinematographers[]" multiple="multiple" required>
          <?php 
          if($form['db_cinematographers']){
          foreach($form['db_cinematographers'] as $cinematographer){  ?>
          <option value="<?php echo $cinematographer['talent_id']?>" selected="selected" selected><?php echo $cinematographer['name']?></option>
          <?php }}?>
          </select>
          <div class="invalid-feedback">  
          Required valid information. 
          </div>
          <div id="cinematographershelpblock" class="form-text">
            You can select multiple cinematographers for this item.
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
            <input class="form-check-input" type="checkbox" role="switch" id="newbie" name="newbie" value="1"  <?php echo ($form['newbie'] == 1)?'checked':''; ?>>
            <label class="form-check-label" for="newbie">Newbie</label>
          </div>
          </div>

           <div class="row p-3">
           <div class="form-check form-switch">
            <input class="form-check-input" type="checkbox" role="switch" id="hd" name="hd" value="1"  <?php echo ($form['hd'] == 1)?'checked':''; ?>>
            <label class="form-check-label" for="hd">High Quality</label>
          </div>
          </div>

           <div class="row p-3">
           <div class="form-check form-switch">
            <input class="form-check-input" type="checkbox" role="switch" id="lq" name="lq" value="1"  <?php echo ($form['lq'] == 1)?'checked':''; ?>>
            <label class="form-check-label" for="lq">Low Quality</label>
          </div>
          </div>

          <div class="row p-3">
           <div class="form-check form-switch">
            <input class="form-check-input" type="checkbox" role="switch" id="st" name="st" value="1"  <?php echo ($form['st'] == 1)?'checked':''; ?>>
            <label class="form-check-label" for="st">Subtitle</label>
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
          <label for="model" class="form-label">Model</label>
          <input type="text" id="model" name="model" value="<?php echo $form['model']; ?>" class="form-control" aria-describedby="modelhelpblock" minlength="1" maxlength="190" required>
          <div class="invalid-feedback">  
          Required valid information. 
          </div>
          <div id="modelhelpblock" class="form-text">
            Your item model must be 1-12 characters long, include letters and numbers, and must not contain spaces, special characters, or emojis.
          </div>
          </div>

          <div class="row p-3">
          <label for="sku" class="form-label">SKU</label>
          <input type="text" id="sku" name="sku" value="<?php echo $form['sku']; ?>" class="form-control" aria-describedby="skuhelpblock" minlength="1" maxlength="190" required>
          <div class="invalid-feedback">  
          Required valid information. 
          </div>
          <div id="skuhelpblock" class="form-text">
            Your item sku must be 8-12 characters long, contain letters and numbers, and must not contain spaces, special characters, or emoji.
          </div>
          </div>

          <div class="row p-3">
          <label for="mpn" class="form-label">MPN</label>
          <input type="text" id="mpn" name="mpn" value="<?php echo $form['mpn']; ?>" class="form-control" aria-describedby="mpnhelpblock" minlength="1" maxlength="190" required>
          <div class="invalid-feedback">  
          Required valid information. 
          </div>
          <div id="mpnhelpblock" class="form-text">
            Your mpn must be 6-12 characters long, contain letters and numbers, and must not contain spaces, special characters, or emoji.
          </div>
          </div>

          <div class="row p-3">
          <label for="gtin" class="form-label">GTIN</label>
          <input type="text" id="gtin" name="gtin" value="<?php echo $form['gtin']; ?>" class="form-control" aria-describedby="gtinhelpblock" minlength="1" maxlength="190" required>
          <div class="invalid-feedback">  
          Required valid information. 
          </div>
          <div id="gtinhelpblock" class="form-text">
            Your gtin must be 8-14 characters long, contain letters and numbers, and must not contain spaces, special characters, or emoji.
          </div>
          </div>


          <div class="row p-3">
          <label for="price" class="form-label">Price</label>
          <input type="text" id="price" name="price" value="<?php echo $form['price']; ?>" class="form-control" aria-describedby="pricehelpblock" maxlength="190" minlength="1" required="required" required onkeypress="return is_key_numeric_fnc(event);" ondrop="return false;" onpaste="return false;">
          <div class="invalid-feedback">  
          Required valid information. 
          </div>
          <div id="pricehelpblock" class="form-text">
            The price must be 1-11 digits long and cannot contain letters, spaces, special characters, or emojis.
          </div>
          </div>

          <div class="row p-3">
          <label for="price_previous" class="form-label">Previous Price</label>
          <input type="text" id="price_previous" name="price_previous" value="<?php echo $form['price_previous']; ?>" class="form-control" aria-describedby="price_previoushelpblock" maxlength="190" minlength="1" required="required" required onkeypress="return is_key_numeric_fnc(event);" ondrop="return false;" onpaste="return false;">
          <div class="invalid-feedback">  
          Required valid information. 
          </div>
          <div id="price_previoushelpblock" class="form-text">
            The previous price must be 1-11 digits long and must not include letters, spaces, special characters, or emojis.
          </div>
          </div>

          <div class="row p-3">
          <label for="launch_year" class="form-label">Launch Year</label>
          <select class="form-select" aria-label="launch_year" name="launch_year" id="launch_year" required>
          <option value="">[--- Select Year ---]</option>
          <?php for ($i = 1947; $i <= date('Y'); $i++) { ?>
          <option value="<?php echo $i; ?>" <?php echo ($i == $form['launch_year'])?'selected':''; ?>><?php echo $i; ?></option>
          <?php }?>
        </select>
          <div class="invalid-feedback">  
          Required valid information. 
          </div>
          <div id="launch_yearhelpblock" class="form-text">
            Your launch year must be 4 numbers long.
          </div>
          </div>

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