<?php $SHONiR_All_Languages = $SHONiR_Main['SHONiR_Languages']; 
$SHONiR_All_Categories = $SHONiR_Main['SHONiR_Categories'];
$SHONiR_All_Brands = $SHONiR_Main['SHONiR_Brands'];
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
<input type="hidden" name="files_sort_order" id="files_sort_order" value="">
      <!-- Begin Page Content -->
      <div class="container-fluid">

        <!-- Page Heading -->
        <div class="d-sm-flex align-items-center justify-content-between mb-4">
          <h1 class="h3 mb-0 text-gray-800">Products : Add</h1>
          <button type="submit" class="d-none d-sm-inline-block btn btn-sm btn-primary shadow-sm"> <i class="fas fa-save fa-lg text-white-50"></i> &nbsp; Save </button>
        </div>


 <!-- DataTales Example -->

 <div class="row">
          <div class="col-md-8 col-sm-8 col-xs-12 ">
 
 <div class="card shadow mb-4"> 
            <div class="card-header py-3">
              <h6 class="m-0 font-weight-bold text-primary">Product Information </h6>
            </div>
            <div class="card-body">
              <div class="table-responsive">

              <div class="mb-3"> 
          <label for="parent">Brand</label>
         
          <select class="form-control" id="brand_id" name="brand_id">
          <option value="0">---None---</option>
          <?php 
          $SHONiR_brand_id = SHONiR_Post_Fnc('brand_id');
          if($SHONiR_All_Brands ){
          foreach($SHONiR_All_Brands as $Brand){  ?>
  <option value="<?php echo $Brand['brand_id']?>" <?php echo ($Brand['brand_id'] == $SHONiR_brand_id)?'selected="selected" selected':''; ?> ><?php echo $Brand['name']?></option>
  <?php }}?>
</select>
          </div>

              <div class="mb-3"> 
          <label for="parent">Parent Category</label>
         
          <select class="form-control" id="parent" name="parent[]" multiple="multiple" required>
          <option value="0">---None---</option>
          <?php 
          $SHONiR_parent = SHONiR_Post_Fnc('parent');
          if($SHONiR_All_Categories){
          foreach($SHONiR_All_Categories as $Category){  ?>
  <option value="<?php echo $Category['category_id']?>" <?php echo @(in_array($Category['category_id'], $SHONiR_parent))?'selected="selected" selected':''; ?> ><?php echo $Category['name']?></option>
  <?php }}?>
</select>
          </div>
               <?php  foreach($SHONiR_All_Languages as $language){  ?>
              <div class="mb-3"> 
          <label for="slug_<?php echo $language['language_id']?>"><img src="media/flags/<?php echo $language['image']?>" data-toggle="tooltip" data-placement="top" title="<?php echo $language['name']?>" > Slug</label>
          <input type="text" class="form-control" id="slug_<?php echo $language['language_id']?>" name="slug_<?php echo $language['language_id']?>" placeholder="Product-slug" required="" value="<?php echo SHONiR_Post_Fnc('slug_'.$language['language_id'], 'unescapes') ?>">
          </div>

          <div class="mb-3">
          <label for="name_<?php echo $language['language_id']?>"><img src="media/flags/<?php echo $language['image']?>" data-toggle="tooltip" data-placement="top" title="<?php echo $language['name']?>" > Name</label>
          <input type="text" class="form-control" id="name_<?php echo $language['language_id']?>" name="name_<?php echo $language['language_id']?>" placeholder="Product Name" required="" value="<?php echo SHONiR_Post_Fnc('name_'.$language['language_id'], 'unescapes') ?>">
          </div>

<div class="mb-3">
          <label for="description_<?php echo $language['language_id']?>"><img src="media/flags/<?php echo $language['image']?>" data-toggle="tooltip" data-placement="top" title="<?php echo $language['name']?>" > Description</label>
          <textarea type="text" class="form-control" id="description_<?php echo $language['language_id']?>" name="description_<?php echo $language['language_id']?>" placeholder="this is a main Product description." ><?php echo SHONiR_Post_Fnc('description_'.$language['language_id'], 'unescapes') ?></textarea>
          </div>
<?php }?>

        
              </div>
            </div>
          </div>

          
          <div class="card shadow mb-4"> 
            <div class="card-header py-3">
              <h6 class="m-0 font-weight-bold text-primary">Search engine listing preview</h6>
            </div>
            <div class="card-body">
              <div class="table-responsive">
              <?php
               
               foreach($SHONiR_All_Languages as $language)
{
               ?>
              <div class="mb-3"> 
          <label for="meta_title_<?php echo $language['language_id']?>"><img src="media/flags/<?php echo $language['image']?>" data-toggle="tooltip" data-placement="top" title="<?php echo $language['name']?>" > Meta Title</label>
          <input type="text" class="form-control" id="meta_title_<?php echo $language['language_id']?>" name="meta_title_<?php echo $language['language_id']?>" placeholder="this meta title use in search and on page" required="" value="<?php echo SHONiR_Post_Fnc('meta_title_'.$language['language_id'], 'unescapes') ?>">
          </div>

          <div class="mb-3">
          <label for="meta_description_<?php echo $language['language_id']?>"><img src="media/flags/<?php echo $language['image']?>" data-toggle="tooltip" data-placement="top" title="<?php echo $language['name']?>" > Meta Description</label>
          <textarea type="text" class="form-control" id="meta_description_<?php echo $language['language_id']?>" name="meta_description_<?php echo $language['language_id']?>" placeholder="this is a main product description for meta tag." required=""><?php echo SHONiR_Post_Fnc('meta_description_'.$language['language_id'], 'unescapes') ?></textarea>
          </div>

<div class="mb-3">
          <label for="meta_keyword_<?php echo $language['language_id']?>"><img src="media/flags/<?php echo $language['image']?>" data-toggle="tooltip" data-placement="top" title="<?php echo $language['name']?>" > Meta Keywords</label>
          <textarea type="text" class="form-control" id="meta_keyword_<?php echo $language['language_id']?>" name="meta_keyword_<?php echo $language['language_id']?>" placeholder="name, product, sub product, sub products" required=""><?php echo SHONiR_Post_Fnc('meta_keyword_'.$language['language_id'], 'unescapes') ?></textarea>
          </div>
          <?php }?>

        
              </div>
            </div>
          </div>

          </div>

          <div class="col-md-4 col-sm-4 col-xs-12 ">          

 

          <div class="card shadow mb-4">
            <div class="card-header py-3">
              <h6 class="m-0 font-weight-bold text-primary">Miscellaneous</h6>
            </div>
            <div class="card-body">
              <div class="table-responsive">

              <div class="mb-3">
          <label for="video_link">Video Link:</label>
          <input type="text" class="form-control" id="video_link" name="video_link" placeholder="https://www.youtube.com/watch?v=Ex3nRGX9Fu8" value="<?php echo SHONiR_Post_Fnc('video_link') ?>">
          </div>
            
          <div class="mb-3">
          <label for="sort_order">Sort Order</label>
          <input type="text" class="form-control" id="sort_order" name="sort_order" placeholder="0" required="" value="<?php echo SHONiR_Post_Fnc('sort_order') ?>">
          </div>

          <div class="mb-3">
          <label for="model">Model#</label>
          <input type="text" class="form-control" id="model" name="model" placeholder="S-PRO-1001" required="" value="<?php echo SHONiR_Post_Fnc('model') ?>">
          </div>

          <div class="mb-3">
          <label for="cost_price">Cost Price</label>
          <input type="text" class="form-control" id="cost_price" name="cost_price" placeholder="0" required="" value="<?php echo SHONiR_Post_Fnc('cost_price') ?>">
          </div>

          <div class="mb-3">
          <label for="selling_price">Selling Price</label>
          <input type="text" class="form-control" id="selling_price" name="selling_price" placeholder="0" value="<?php echo SHONiR_Post_Fnc('selling_price') ?>">
          </div>

          <div class="mb-3">
          <!--label for="express_delivery" class="d-none d-sm-inline-block btn btn-sm btn-secondary shadow-sm">Express Delivery <input type="checkbox" id="express_delivery" name="express_delivery" value="1" class="badgebox" <?php echo (SHONiR_Post_Fnc('express_delivery')==1)?'checked="checked" checked':''; ?>><span class="badge">&check;</span></label>
          <label for="standard_delivery" class="d-none d-sm-inline-block btn btn-sm btn-secondary shadow-sm">Standard Delivery <input type="checkbox" id="standard_delivery" name="standard_delivery" value="1" class="badgebox" <?php echo (SHONiR_Post_Fnc('standard_delivery')==1)?'checked="checked" checked':''; ?>><span class="badge">&check;</span></label-->
          <label for="status" class="d-none d-sm-inline-block btn btn-sm btn-secondary shadow-sm">Status <input type="checkbox" id="status" name="status" value="1" class="badgebox" <?php echo (SHONiR_Post_Fnc('status')==1)?'checked="checked" checked':''; ?>><span class="badge">&check;</span></label>
          <label for="listed" class="d-none d-sm-inline-block btn btn-sm btn-secondary shadow-sm">Listed <input type="checkbox" id="listed" name="listed" value="1" class="badgebox"  <?php echo (SHONiR_Post_Fnc('listed')==1)?'checked="checked" checked':''; ?>><span class="badge">&check;</span></label>
          <label for="featured" class="d-none d-sm-inline-block btn btn-sm btn-secondary shadow-sm">Featured <input type="checkbox" id="featured" name="featured" value="1" class="badgebox"  <?php echo (SHONiR_Post_Fnc('featured')==1)?'checked="checked" checked':''; ?>><span class="badge">&check;</span></label>
          <!--label for="locked" class="d-none d-sm-inline-block btn btn-sm btn-secondary shadow-sm">Locked <input type="checkbox" id="locked" name="locked" value="1" class="badgebox"  <?php echo (SHONiR_Post_Fnc('locked')==1)?'checked="checked" checked':''; ?>><span class="badge">&check;</span></label-->
          <label for="searchable" class="d-none d-sm-inline-block btn btn-sm btn-secondary shadow-sm">Searchable <input type="checkbox" id="searchable" name="searchable" value="1" class="badgebox"  <?php echo (SHONiR_Post_Fnc('searchable')==1)?'checked="checked" checked':''; ?>><span class="badge">&check;</span></label>
</div>
          

        
              </div>
            </div>
          </div>


          <div class="card shadow mb-4">
            <div class="card-header py-3">
              <h6 class="m-0 font-weight-bold text-primary">Image</h6>
            </div>
            <div class="card-body">
              <div class="table-responsive">
            
          <div class="mb-3">

          <fieldset class="form-group">
          <button type="button" class="d-none d-sm-inline-block btn btn-sm btn-info shadow-sm" onclick="p('#pro-image').click()"><i class="fas fa-upload fa-sm text-white-50"></i> Select File </button>
        <input type="file" id="pro-image" name="files[]" style="display: none;" class="form-control" multiple>
        <div id="SHONiR_Files"> </div>
    </fieldset>
    <div class="preview-images-zone">
      
          </div>        

        
              </div>
            </div>
          </div>

          </div>

         

</div>


          
</form>

      </div>

      <div class="row">
<div id="additional_options_data" class="col"></div>
</div>

      <div class="row">
<div class="col">
          <select class="form-control" id="additional_select_options" name="additional_select_options">
          <option value="0">---None---</option>
  <option value="radio" >Radio</option>
  <option value="checkbox" >Checkbox</option>
  <option value="select" >Select</option>
  <option value="text" >Text</option>  
  <option value="textarea" >Textarea</option>
  <option value="file" >File</option>
</select>
</div>
<div class="col">
<button type="button" class="d-none d-sm-inline-block btn btn-sm btn-info shadow-sm" onclick="SHONiR_Additional_Options_Fnc();"><i class="fas fa-upload fa-sm text-white-50"></i> Add Option </button>
</div>
</div>    
      <!-- /.container-fluid -->

    </div>
    

    <!-- End of Main Content -->

    <?php require_once('common/footer.php');?>

</div>
<?php require_once('common/end.php');?>

<script>
p(document).ready(function(){
<?php 

$SHONiR_Num = 0;

$SHONiR_additional_options = SHONiR_Post_Fnc('additional_option');

if(!empty($SHONiR_additional_options) && is_array($SHONiR_additional_options)){

foreach ($SHONiR_additional_options as $additional_option){

  echo 'SHONiR_Additional_Options_Fnc('.json_encode($additional_option).');';

  if(isset($additional_option['option_value']) && !empty($additional_option['option_value'])){

    $SHONiR_option_value = $additional_option['option_value'];

            foreach ($SHONiR_option_value as $value){

              echo 'SHONiR_Add_Option_Value_Fnc('.$SHONiR_Num.', '.json_encode($value).');';

            }


  }

  $SHONiR_Num++;

 }

}


?>
});
var SHONiR_Num = 0;

function SHONiR_Additional_Options_Fnc(SHONiR_Array=''){
if(SHONiR_Array == ''){
  additional_option =  p('#additional_select_options').val();
}else{
  additional_option = SHONiR_Array['option_type'];

}
<?php  foreach($SHONiR_All_Languages as $language){ ?>
var name_<?php echo $language['language_id']?> = (typeof SHONiR_Array['name_<?php echo $language['language_id']?>'] === "undefined") ? "" : SHONiR_Array['name_<?php echo $language['language_id']?>'];
<?php  } ?>

var sort_order = (typeof SHONiR_Array['sort_order'] === "undefined") ? "" : SHONiR_Array['sort_order'];
var minimum = (typeof SHONiR_Array['minimum'] === "undefined") ? "" : SHONiR_Array['minimum'];
var maximum = (typeof SHONiR_Array['maximum'] === "undefined") ? "" : SHONiR_Array['maximum'];
var further_value = (typeof SHONiR_Array['further_value'] === "undefined") ? "" : SHONiR_Array['further_value'];



  SHONiR_Return = false; 

			  html = '<div class="table-responsive">';
			  html += '  <table id="option-value' + SHONiR_Num + '" class="table table-striped table-bordered table-hover">';
			  html += '  	 <thead>';
			  html += '      <tr>';
        html += '        <td class="text-left">Name '+SHONiR_Num+'</td>';
        html += '        <td class="text-left">Image</td>';
        html += '        <td class="text-right">Stock</td>';
        html += '        <td class="text-right">Sort Order</td>';
        html += '        <td class="text-left">Subtract</td>';
        html += '        <td class="text-right">Cost Price</td>';
			  html += '        <td class="text-right">Selling Price</td>';
			  html += '        <td class="text-right">Points</td>';
        html += '        <td class="text-right">Weight</td>';
        html += '        <td class="text-right">Length</td>';
        html += '        <td class="text-right">Width</td>';
        html += '        <td class="text-right">Height</td>';
			  html += '        <td></td>';
			  html += '      </tr>';
			  html += '  	 </thead>';
			  html += '  	 <tbody>';
			  html += '    </tbody>';
			  html += '    <tfoot>';
			  html += '      <tr>';
			  html += '        <td colspan="12"></td>';
			  html += '        <td class="text-left"><button type="button" onclick="SHONiR_Add_Option_Value_Fnc(' + SHONiR_Num + ');" data-toggle="tooltip" title="Add Option Value" class="btn btn-primary"><i class="fa fa-plus-circle"></i></button></td>';
			  html += '      </tr>';
			  html += '    </tfoot>';
			  html += '  </table>';
			  html += '</div>';		  

if(additional_option == 'radio' || additional_option == 'checkbox' || additional_option == 'select'){

  SHONiR_Return = ' <div class="card shadow mb-4" id="additional-option' + SHONiR_Num + '">' + 
            '<div class="card-header py-3">' +
            ' <div class="row">' +
              '<div class="col-md-6 col-sm-6 col-xs-6 text-left m-0 font-weight-bold text-primary"><h2 class="m-0">'+additional_option+' '+SHONiR_Num+'</h2>' +
              '<input type="hidden" name="additional_option[' + SHONiR_Num + '][option_type]" id="additional_option[' + SHONiR_Num + '][option_type]" value="'+additional_option+'"></div>' +
              '<div class="col-md-6 col-sm-6 col-xs-6 text-right"><button type="button" onclick="p(\'#additional-option' + SHONiR_Num + '\').remove();" data-toggle="tooltip" rel="tooltip" title="Remove" class="btn btn-danger"><i class="fa fa-minus-circle"></i></button></div>'+
            '</div>'+
            '</div>'+
            '<div class="card-body">'+
              '<div class="table-responsive">' +
              <?php  foreach($SHONiR_All_Languages as $language){ ?>
              '<div class="mb-3">' +
          '<label for="additional_option[' + SHONiR_Num + '][name_<?php echo $language['language_id']?>]"> <img src="media/flags/<?php echo $language['image']?>" data-toggle="tooltip" data-placement="top" title="<?php echo $language['name']?>" > Name: </label>' +
          '<input type="text" class="form-control" name="additional_option[' + SHONiR_Num + '][name_<?php echo $language['language_id']?>]" placeholder="Name" required="" value="'+ name_<?php echo $language['language_id']?> +'">' +
         ' </div>' +
              <?php } ?>
         '<div class="mb-3">' +
          '<label for="additional_option[' + SHONiR_Num + '][sort_order]">Sort Order: </label>' +
          '<input type="text" class="form-control"id name="additional_option[' + SHONiR_Num + '][sort_order]" placeholder="'+SHONiR_Num+'" required="" value="'+ sort_order +'">' +
         ' </div>' +

         '<div class="mb-3">' +
          '<label for="additional_option[' + SHONiR_Num + '][required]">Required: </label>' +
          '<select class="form-control" id="idaaa_'+SHONiR_Num+'" name="additional_option[' + SHONiR_Num + '][required]">' +
          '<option value="1">Yes</option>' +
  '<option value="0" >No</option>' +
  '</select>' +
         ' </div>' +   html +
              
              '</div>' +
              '</div>' +
              '</div>';

}else if(additional_option == 'text'){

 SHONiR_Return = ' <div class="card shadow mb-4" id="additional-option' + SHONiR_Num + '">' + 
            '<div class="card-header py-3">' +
            ' <div class="row">' +
              '<div class="col-md-6 col-sm-6 col-xs-6 text-left font-weight-bold text-primary"><h2 class="m-0">Text '+SHONiR_Num+' </h2>' +
              '<input type="hidden" name="additional_option[' + SHONiR_Num + '][option_type]" id="additional_option[' + SHONiR_Num + '][option_type]" value="text"></div>' +
              '<div class="col-md-6 col-sm-6 col-xs-6 text-right"><button type="button" onclick="p(\'#additional-option' + SHONiR_Num + '\').remove();" data-toggle="tooltip" rel="tooltip" title="Remove" class="btn btn-danger"><i class="fa fa-minus-circle"></i></button></div>'+
            '</div>'+
            '</div>'+
            '<div class="card-body">'+
              '<div class="table-responsive">' +
              <?php  foreach($SHONiR_All_Languages as $language){ ?>
              '<div class="mb-3">' +
          '<label for="additional_option[' + SHONiR_Num + '][name_<?php echo $language['language_id']?>]"> <img src="media/flags/<?php echo $language['image']?>" data-toggle="tooltip" data-placement="top" title="<?php echo $language['name']?>" > Name: </label>' +
          '<input type="text" class="form-control" name="additional_option[' + SHONiR_Num + '][name_<?php echo $language['language_id']?>]" placeholder="Name" required="" value="'+ name_<?php echo $language['language_id']?> +'">' +
         ' </div>' +
              <?php } ?>
         '<div class="mb-3">' +
          '<label for="additional_option[' + SHONiR_Num + '][sort_order]">Sort Order: </label>' +
          '<input type="text" class="form-control"id name="additional_option[' + SHONiR_Num + '][sort_order]" placeholder="'+SHONiR_Num+'" required="" value="'+ sort_order +'">' +
         ' </div>' +

         '<div class="mb-3">' +
          '<label for="additional_option[' + SHONiR_Num + '][required]">Required: </label>' +
          '<select class="form-control" id="idaaa_'+SHONiR_Num+'" name="additional_option[' + SHONiR_Num + '][required]">' +
          '<option value="1">Yes</option>' +
  '<option value="0" >No</option>' +
  '</select>' +
         ' </div>' +   

         '<div class="mb-3">' +
          '<label for="additional_option[' + SHONiR_Num + '][minimum]">Minimum Character: </label>' +
          '<input type="text" class="form-control" name="additional_option[' + SHONiR_Num + '][minimum]" placeholder="1" required="" value="'+ minimum +'">' +
         ' </div>' +    

         '<div class="mb-3">' +
          '<label for="additional_option[' + SHONiR_Num + '][maximum]">Maximum Character: </label>' +
          '<input type="text" class="form-control" name="additional_option[' + SHONiR_Num + '][maximum]" placeholder="32" required="" value="'+ maximum +'">' +
         ' </div>' +  
              
              '</div>' +
              '</div>' +
              '</div>';

}else if(additional_option == 'textarea'){

  SHONiR_Return = ' <div class="card shadow mb-4" id="additional-option' + SHONiR_Num + '">' + 
            '<div class="card-header py-3">' +
            ' <div class="row">' +
              '<div class="col-md-6 col-sm-6 col-xs-6 text-left font-weight-bold text-primary"><h2 class="m-0">Textarea '+SHONiR_Num+' </h2>' +
              '<input type="hidden" name="additional_option[' + SHONiR_Num + '][option_type]" id="additional_option[' + SHONiR_Num + '][option_type]" value="textarea"></div>' +
              '<div class="col-md-6 col-sm-6 col-xs-6 text-right"><button type="button" onclick="p(\'#additional-option' + SHONiR_Num + '\').remove();" data-toggle="tooltip" rel="tooltip" title="Remove" class="btn btn-danger"><i class="fa fa-minus-circle"></i></button></div>'+
            '</div>'+
            '</div>'+
            '<div class="card-body">'+
              '<div class="table-responsive">' +
              <?php  foreach($SHONiR_All_Languages as $language){ ?>
              '<div class="mb-3">' +
          '<label for="additional_option[' + SHONiR_Num + '][name_<?php echo $language['language_id']?>]"> <img src="media/flags/<?php echo $language['image']?>" data-toggle="tooltip" data-placement="top" title="<?php echo $language['name']?>" > Name: </label>' +
          '<input type="text" class="form-control" name="additional_option[' + SHONiR_Num + '][name_<?php echo $language['language_id']?>]" placeholder="Name" required="" value="'+ name_<?php echo $language['language_id']?> +'">' +
         ' </div>' +
              <?php } ?>
         '<div class="mb-3">' +
          '<label for="additional_option[' + SHONiR_Num + '][sort_order]">Sort Order: </label>' +
          '<input type="text" class="form-control"id name="additional_option[' + SHONiR_Num + '][sort_order]" placeholder="'+SHONiR_Num+'" required="" value="'+ sort_order +'">' +
         ' </div>' +

         '<div class="mb-3">' +
          '<label for="additional_option[' + SHONiR_Num + '][required]">Required: </label>' +
          '<select class="form-control" id="idaaa_'+SHONiR_Num+'" name="additional_option[' + SHONiR_Num + '][required]">' +
          '<option value="1">Yes</option>' +
  '<option value="0" >No</option>' +
  '</select>' +
         ' </div>' +   

         '<div class="mb-3">' +
          '<label for="additional_option[' + SHONiR_Num + '][minimum]">Minimum Character: </label>' +
          '<input type="number" class="form-control" name="additional_option[' + SHONiR_Num + '][minimum]" placeholder="1" required="" value="'+ minimum +'">' +
         ' </div>' +    

         '<div class="mb-3">' +
          '<label for="additional_option[' + SHONiR_Num + '][maximum]">Maximum Character: </label>' +
          '<input type="number" class="form-control" name="additional_option[' + SHONiR_Num + '][maximum]" placeholder="500" required="" value="'+ maximum +'">' +
         ' </div>' +  
              
              '</div>' +
              '</div>' +
              '</div>';

}else if(additional_option == 'file'){

  SHONiR_Return = ' <div class="card shadow mb-4" id="additional-option' + SHONiR_Num + '">' + 
            '<div class="card-header py-3">' +
            ' <div class="row">' +
              '<div class="col-md-6 col-sm-6 col-xs-6 text-left font-weight-bold text-primary"><h2 class="m-0">File '+SHONiR_Num+' </h2>' +
              '<input type="hidden" name="additional_option[' + SHONiR_Num + '][option_type]" id="additional_option[' + SHONiR_Num + '][option_type]" value="file"></div>' +
              '<div class="col-md-6 col-sm-6 col-xs-6 text-right"><button type="button" onclick="p(\'#additional-option' + SHONiR_Num + '\').remove();" data-toggle="tooltip" rel="tooltip" title="Remove" class="btn btn-danger"><i class="fa fa-minus-circle"></i></button></div>'+
            '</div>'+
            '</div>'+
            '<div class="card-body">'+
              '<div class="table-responsive">' +
              <?php  foreach($SHONiR_All_Languages as $language){ ?>
              '<div class="mb-3">' +
          '<label for="additional_option[' + SHONiR_Num + '][name_<?php echo $language['language_id']?>]"> <img src="media/flags/<?php echo $language['image']?>" data-toggle="tooltip" data-placement="top" title="<?php echo $language['name']?>" > Name: </label>' +
          '<input type="text" class="form-control" name="additional_option[' + SHONiR_Num + '][name_<?php echo $language['language_id']?>]" placeholder="Name" required="" value="'+ name_<?php echo $language['language_id']?> +'">' +
         ' </div>' +
              <?php } ?>
         '<div class="mb-3">' +
          '<label for="additional_option[' + SHONiR_Num + '][sort_order]">Sort Order: </label>' +
          '<input type="text" class="form-control"id name="additional_option[' + SHONiR_Num + '][sort_order]" placeholder="'+SHONiR_Num+'" required="" value="'+ sort_order +'">' +
         ' </div>' +

         '<div class="mb-3">' +
          '<label for="additional_option[' + SHONiR_Num + '][required]">Required: </label>' +
          '<select class="form-control" id="idaaa_'+SHONiR_Num+'" name="additional_option[' + SHONiR_Num + '][required]">' +
          '<option value="1">Yes</option>' +
  '<option value="0" >No</option>' +
  '</select>' +
         ' </div>' +   

         '<div class="mb-3">' +
          '<label for="additional_option[' + SHONiR_Num + '][minimum]">Minimum Filesize (bytes): </label>' +
          '<input type="number" class="form-control" name="additional_option[' + SHONiR_Num + '][minimum]" placeholder="1" required="" value="'+ minimum +'">' +
         ' </div>' +    

         '<div class="mb-3">' +
          '<label for="additional_option[' + SHONiR_Num + '][maximum]">Maximum Filesize (bytes): </label>' +
          '<input type="number" class="form-control"  name="additional_option[' + SHONiR_Num + '][maximum]" placeholder="500" required="" value="'+ maximum +'">' +
         ' </div>' +  
         
         '<div class="mb-3">' +
          '<label for="additional_option[' + SHONiR_Num + '][further_value]">Allow Files Format: </label>' +
          '<input type="text" class="form-control" name="additional_option[' + SHONiR_Num + '][further_value]" placeholder="jpg, gif, png, doc, pdf" value="'+ further_value +'">' +
         ' </div>' +  
              
              '</div>' +
              '</div>' +
              '</div>';

}


if(SHONiR_Return != false){

  p( "#additional_options_data" ).append( SHONiR_Return );

  if(typeof SHONiR_Array['required'] !== "undefined"){

p("[name='additional_option[" + SHONiR_Num + "][required]'] option").removeAttr('selected').filter('[value="'+SHONiR_Array['required']+'"]').attr('selected', true)

}

 SHONiR_Num = SHONiR_Num + 1;

}

}


var SHONiR_Num_Value =0;
  
function SHONiR_Add_Option_Value_Fnc(SHONiR_Num, SHONiR_Array='') {

  <?php  foreach($SHONiR_All_Languages as $language){ ?>
var name_<?php echo $language['language_id']?> = (typeof SHONiR_Array['name_<?php echo $language['language_id']?>'] === "undefined") ? "" : SHONiR_Array['name_<?php echo $language['language_id']?>'];
<?php  } ?>

var sort_order = (typeof SHONiR_Array['sort_order'] === "undefined") ? "" : SHONiR_Array['sort_order'];
var stock = (typeof SHONiR_Array['stock'] === "undefined") ? "" : SHONiR_Array['stock'];
var cost_price = (typeof SHONiR_Array['cost_price'] === "undefined") ? "" : SHONiR_Array['cost_price'];
var selling_price = (typeof SHONiR_Array['selling_price'] === "undefined") ? "" : SHONiR_Array['selling_price'];
var points = (typeof SHONiR_Array['points'] === "undefined") ? "" : SHONiR_Array['points'];
var weight = (typeof SHONiR_Array['weight'] === "undefined") ? "" : SHONiR_Array['weight'];
var length = (typeof SHONiR_Array['length'] === "undefined") ? "" : SHONiR_Array['length'];
var width = (typeof SHONiR_Array['width'] === "undefined") ? "" : SHONiR_Array['width'];
var height = (typeof SHONiR_Array['height'] === "undefined") ? "" : SHONiR_Array['height'];



	  html = '<tr id="option-value-row' + SHONiR_Num_Value + '">';
    html += '  <td class="text-left">';
    <?php  foreach($SHONiR_All_Languages as $language){ ?>
      html += '<img src="media/flags/<?php echo $language['image']?>" data-toggle="tooltip" data-placement="top" title="<?php echo $language['name']?>" >';
      html += '<input type="text" class="form-control" id="additional_option[' + SHONiR_Num + '][option_value][' + SHONiR_Num_Value + '][name_<?php echo $language['language_id']?>]" name="additional_option[' + SHONiR_Num + '][option_value][' + SHONiR_Num_Value + '][name_<?php echo $language['language_id']?>]" placeholder="Name" required="" value="' + name_<?php echo $language['language_id']?> + '">';
      <?php } ?>
    html += '</td>';
    html += '  <td class="text-right"><input type="file" id="additional_option' + SHONiR_Num + 'option_value' + SHONiR_Num_Value + 'file" name="additional_option' + SHONiR_Num + 'option_value' + SHONiR_Num_Value + 'file" accept="image/*" style="display:none" /><div class="single-image-preview-zone" id="additional_option' + SHONiR_Num + 'option_value' + SHONiR_Num_Value + '" name="additional_option[' + SHONiR_Num + '][option_value][' + SHONiR_Num_Value + ']" ><div class="image-upload" onclick="SHONiR_Single_Image_Select_Fnc(\'additional_option' + SHONiR_Num + 'option_value' + SHONiR_Num_Value + '\', true)"><i class="fas fa-upload"></i></div></div></td>';
    html += '  <td class="text-right"><input type="text" name="additional_option[' + SHONiR_Num + '][option_value][' + SHONiR_Num_Value + '][stock]" value="' + stock + '" placeholder="Stock" class="form-control" /></td>';
	  html += '  <td class="text-right"><input type="text" name="additional_option[' + SHONiR_Num + '][option_value][' + SHONiR_Num_Value + '][sort_order]" value="' + sort_order + '" placeholder="' + SHONiR_Num_Value + '" class="form-control" /></td>';
	  html += '  <td class="text-left"><select name="additional_option[' + SHONiR_Num + '][option_value][' + SHONiR_Num_Value + '][subtract]" class="form-control">';
	  html += '    <option value="1">Yes</option>';
	  html += '    <option value="0">No</option>';
	  html += '  </select></td>';
	  html += '  <td class="text-right"><select name="additional_option[' + SHONiR_Num + '][option_value][' + SHONiR_Num_Value + '][cost_price_prefix]" class="form-control">';
	  html += '    <option value="+">+</option>';
	  html += '    <option value="-">-</option>';
	  html += '  </select>';
    html += '  <input type="text" name="additional_option[' + SHONiR_Num + '][option_value][' + SHONiR_Num_Value + '][cost_price]" value="' + cost_price + '" placeholder="Cost Price" class="form-control" /></td>';
    html += '  <td class="text-right"><select name="additional_option[' + SHONiR_Num + '][option_value][' + SHONiR_Num_Value + '][selling_price_prefix]" class="form-control">';
	  html += '    <option value="+">+</option>';
	  html += '    <option value="-">-</option>';
	  html += '  </select>';
	  html += '  <input type="text" name="additional_option[' + SHONiR_Num + '][option_value][' + SHONiR_Num_Value + '][selling_price]" value="' + selling_price + '" placeholder="Selling Price" class="form-control" /></td>';
	  html += '  <td class="text-right"><select name="additional_option[' + SHONiR_Num + '][option_value][' + SHONiR_Num_Value + '][points_prefix]" class="form-control">';
	  html += '    <option value="+">+</option>';
	  html += '    <option value="-">-</option>';
	  html += '  </select>';
	  html += '  <input type="text" name="additional_option[' + SHONiR_Num + '][option_value][' + SHONiR_Num_Value + '][points]" value="' + points + '" placeholder="Points" class="form-control" /></td>';
	  html += '  <td class="text-right"><select name="additional_option[' + SHONiR_Num + '][option_value][' + SHONiR_Num_Value + '][weight_prefix]" class="form-control">';
	  html += '    <option value="+">+</option>';
	  html += '    <option value="-">-</option>';
	  html += '  </select>';
    html += '  <input type="text" name="additional_option[' + SHONiR_Num + '][option_value][' + SHONiR_Num_Value + '][weight]" value="' + weight + '" placeholder="Weight" class="form-control" /></td>';
    html += '  <td class="text-right"><select name="additional_option[' + SHONiR_Num + '][option_value][' + SHONiR_Num_Value + '][length_prefix]" class="form-control">';
	  html += '    <option value="+">+</option>';
	  html += '    <option value="-">-</option>';
	  html += '  </select>';
    html += '  <input type="text" name="additional_option[' + SHONiR_Num + '][option_value][' + SHONiR_Num_Value + '][length]" value="' + length + '" placeholder="Length" class="form-control" /></td>';
    html += '  <td class="text-right"><select name="additional_option[' + SHONiR_Num + '][option_value][' + SHONiR_Num_Value + '][width_prefix]" class="form-control">';
	  html += '    <option value="+">+</option>';
	  html += '    <option value="-">-</option>';
	  html += '  </select>';
    html += '  <input type="text" name="additional_option[' + SHONiR_Num + '][option_value][' + SHONiR_Num_Value + '][width]" value="' + width + '" placeholder="Width" class="form-control" /></td>';
    html += '  <td class="text-right"><select name="additional_option[' + SHONiR_Num + '][option_value][' + SHONiR_Num_Value + '][height_prefix]" class="form-control">';
	  html += '    <option value="+">+</option>';
	  html += '    <option value="-">-</option>';
	  html += '  </select>';
    html += '  <input type="text" name="additional_option[' + SHONiR_Num + '][option_value][' + SHONiR_Num_Value + '][height]" value="' + height + '" placeholder="Height" class="form-control" /></td>';
    html += '  <td class="text-left"><button type="button" onclick="p(\'#option-value-row' + SHONiR_Num_Value + '\').remove();" data-toggle="tooltip" rel="tooltip" title="Remove" class="btn btn-danger"><i class="fa fa-minus-circle"></i></button></td>';
	  html += '</tr>';

	  p('#option-value' + SHONiR_Num + ' tbody').append(html);

    if(typeof SHONiR_Array['subtract'] !== "undefined"){
p("[name='additional_option[" + SHONiR_Num + "][option_value][" + SHONiR_Num_Value + "][subtract]'] option").removeAttr('selected').filter('[value="'+SHONiR_Array['subtract']+'"]').attr('selected', true)
}


if(typeof SHONiR_Array['cost_price_prefix'] !== "undefined"){
p("[name='additional_option[" + SHONiR_Num + "][option_value][" + SHONiR_Num_Value + "][cost_price_prefix]'] option").removeAttr('selected').filter('[value="'+SHONiR_Array['cost_price_prefix']+'"]').attr('selected', true)
}

if(typeof SHONiR_Array['selling_price_prefix'] !== "undefined"){
p("[name='additional_option[" + SHONiR_Num + "][option_value][" + SHONiR_Num_Value + "][selling_price_prefix]'] option").removeAttr('selected').filter('[value="'+SHONiR_Array['selling_price_prefix']+'"]').attr('selected', true)
}

if(typeof SHONiR_Array['points_prefix'] !== "undefined"){
p("[name='additional_option[" + SHONiR_Num + "][option_value][" + SHONiR_Num_Value + "][points_prefix]'] option").removeAttr('selected').filter('[value="'+SHONiR_Array['points_prefix']+'"]').attr('selected', true)
}

if(typeof SHONiR_Array['weight_prefix'] !== "undefined"){
p("[name='additional_option[" + SHONiR_Num + "][option_value][" + SHONiR_Num_Value + "][weight_prefix]'] option").removeAttr('selected').filter('[value="'+SHONiR_Array['weight_prefix']+'"]').attr('selected', true)
}

if(typeof SHONiR_Array['length_prefix'] !== "undefined"){
p("[name='additional_option[" + SHONiR_Num + "][option_value][" + SHONiR_Num_Value + "][length_prefix]'] option").removeAttr('selected').filter('[value="'+SHONiR_Array['length_prefix']+'"]').attr('selected', true)
}

if(typeof SHONiR_Array['width_prefix'] !== "undefined"){
p("[name='additional_option[" + SHONiR_Num + "][option_value][" + SHONiR_Num_Value + "][width_prefix]'] option").removeAttr('selected').filter('[value="'+SHONiR_Array['width_prefix']+'"]').attr('selected', true)
}

if(typeof SHONiR_Array['height_prefix'] !== "undefined"){
p("[name='additional_option[" + SHONiR_Num + "][option_value][" + SHONiR_Num_Value + "][height_prefix]'] option").removeAttr('selected').filter('[value="'+SHONiR_Array['height_prefix']+'"]').attr('selected', true)
}

    SHONiR_Num_Value++;
  }

  function SHONiR_Single_Image_Remove_Fnc(SHONiR_ID){

    var file_id = SHONiR_ID+'file';
    p('#'+file_id).val('');
    p("#"+SHONiR_ID).html('<div class="image-upload" onclick="SHONiR_Single_Image_Select_Fnc(\''+SHONiR_ID+'\', true);"><i class="fas fa-upload"></i></div>');

  }

  function SHONiR_Single_Image_Select_Fnc(SHONiR_Element, SHONiR_ID = false){

if(SHONiR_ID === true){
  var zone_id = SHONiR_Element;
} else{    
  var zone_id = p(SHONiR_Element).attr("id");
}
    var file_id = zone_id+'file';

    p('#'+file_id).trigger('click'); 

    p('#'+file_id).on('change', function() {

      if (window.File && window.FileList && window.FileReader) { 

        var input = this;
        
        if (input.files && input.files[0]) {

          var imageType = /image.*/; 

          var file = input.files[0]; 
          
          if (!file.type.match(imageType)) {
            alert('Please select correct image format');
return false;
} 

          var reader = new FileReader();

          reader.onload = function (e) {
p("#"+zone_id).html('<div class="image-cancel"  onclick="SHONiR_Single_Image_Remove_Fnc(\''+zone_id+'\');">X</div> <img src="' + e.target.result + '"><div class="image-upload" onclick="SHONiR_Single_Image_Select_Fnc(\''+zone_id+'\', true);"><i class="fas fa-upload"></i></div><div class="image-zoom"><a data-fancybox="'+zone_id+'" href="' + e.target.result + '" data-no="'+zone_id+'"><i class="fas fa-eye fa-lg text-white-50"></i></a></div> ');

}
reader.readAsDataURL(input.files[0]);       

        }

} else {

        alert('Browser not support');

        return false;

    }

});

 }

  p(document).ready(function() {
 p('#parent').select2();
 p('#brand_id').select2();
 p('#additional_options').select2();

    document.getElementById('pro-image').addEventListener('change', SHONiR_Read_Image_Fnc, false);    

    p( ".preview-images-zone" ).sortable({
    stop: function(event, ui) {
        var data = "";

        p(".preview-image").each(function(i, el){
            var ord = p(el).attr('id');
            data += ord+"="+p(el).index()+",";
        });
       p('#files_sort_order').val(data);
    }
}).disableSelection();
    
   p(document).on('click', '.image-cancel', function() {
        let no = p(this).data('no');
        p(".preview-image.preview-show-"+no).remove();
        p("#image-file-"+no).remove();
        SHONiR_File_Sort_Order_Fnc();
    });
});

function SHONiR_File_Sort_Order_Fnc(){
  var data = "";
        p(".preview-image").each(function(i, el){
            var ord = p(el).attr('id');
            data += ord+"="+p(el).index()+",";
        });

        p('#files_sort_order').val(data);
}

function SHONiR_Read_Image_Fnc() {  

    if (window.File && window.FileList && window.FileReader) {

      var num = 0;
var names = [];

        var files = event.target.files; 
        var output = p(".preview-images-zone");
        var e = p(this);

        var clone = e.clone(true).prop('id', 'image-file-'+num ).addClass('SHONiR_Files');
              
        for (let i = 0; i < files.length; i++) {
          var file = files[i];
          names[i] = files[i].name;
            if (!file.type.match('image')) continue;

          var picReader = new FileReader();         

            picReader.addEventListener('load', function (event) {
                var picFile = event.target;
                var html =  '<div class="preview-image preview-show-' + num + '" id="' +  names[num] + '">' +
                            '<div class="image-cancel" data-no="' + num + '">X</div>' +
                            '<div class="image-zone"><img id="pro-img-' + num + '" src="' + picFile.result + '"></div>' +
                            '<div class="tools-edit-image"><a data-fancybox="images" href="' + picFile.result + '" data-no="' + num + '" class="btn btn-info btn-edit-image"><i class="fas fa-search-plus fa-lg text-white-50"></i></a></div>' +
                            '</div>';

                output.append(html);

                clone.appendTo('#SHONiR_Files');

                num = num + 1;
          });
            
         picReader.readAsDataURL(file);
              
        }
        e.val('');SHONiR_File_Sort_Order_Fnc();
    } else {
        alert('Browser not support');
    }
}

</script>

<script>

<?php  foreach($SHONiR_All_Languages as $language)
{
               ?>
tinymce.init({selector:'#description_<?php echo $language['language_id']?>', branding: false, min_height: 400, menubar: false, plugins: [
    'advlist autolink lists link image charmap print preview anchor',
    'searchreplace visualblocks fullscreen',
    'insertdatetime media table paste code help wordcount codesample'
  ],
  codesample_languages: [
    { text: 'HTML/XML', value: 'markup' },
    { text: 'JavaScript', value: 'javascript' },
    { text: 'CSS', value: 'css' },
    { text: 'PHP', value: 'php' },
    { text: 'Ruby', value: 'ruby' },
    { text: 'Python', value: 'python' },
    { text: 'Java', value: 'java' },
    { text: 'C', value: 'c' },
    { text: 'C#', value: 'csharp' },
    { text: 'C++', value: 'cpp' }
  ],
  toolbar: 'undo redo removeformat | bold italic underline strikethrough | fontselect fontsizeselect formatselect | alignleft aligncenter alignright alignjustify | outdent indent |  numlist bullist checklist | forecolor backcolor casechange permanentpen formatpainter  | pagebreak | charmap emoticons | fullscreen  preview save print | insertfile image media pageembed template link anchor codesample | a11ycheck ltr rtl | showcomments addcomment | code',
toolbar_drawer: 'floating', browser_spellcheck: true, allow_script_urls: true});
<?php }?>
</script>
  </body>
</html><?php
require_once('common/clear.php');
?>