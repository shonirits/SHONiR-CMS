<?php $SHONiR_All_Languages = $SHONiR_Main['SHONiR_Languages']; 
$SHONiR_All_Categories = $SHONiR_Main['SHONiR_Categories'];
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
<input type="hidden" name="files_sort_order" id="files_sort_order" value="<?php echo $SHONiR_Main['files_sort_order'];?>">
      <!-- Begin Page Content -->
      <div class="container-fluid">

        <!-- Page Heading -->
        <div class="d-sm-flex align-items-center justify-content-between mb-4">
          <h1 class="h3 mb-0 text-gray-800">Blogs : Edit</h1>
          <button type="submit" class="d-none d-sm-inline-block btn btn-sm btn-primary shadow-sm" onclick="SHONiR_File_Sort_Order_Fnc();"><i class="fas fa-edit fa-lg text-white-50"></i> &nbsp; Update </button>
        </div>


 <!-- DataTales Example -->

 <div class="row">
          <div class="col-md-8 col-sm-8 col-xs-12 ">
 
 <div class="card shadow mb-4"> 
            <div class="card-header py-3">
              <h6 class="m-0 font-weight-bold text-primary">Blog Information </h6>
            </div>
            <div class="card-body">
              <div class="table-responsive">

              

              <div class="mb-3"> 
          <label for="parent">Parent Category</label>
        
          <select class="form-control" id="parent" name="parent[]" multiple="multiple" required>
          <option value="0">---None---</option>
          <?php if($SHONiR_All_Categories){
          foreach($SHONiR_All_Categories as $Category){ 
            ?>
  <option value="<?php echo $Category['category_id']?>" <?php echo @(in_array($Category['category_id'], $SHONiR_Main['SHONiR_Parent']))?'selected="selected" selected':''; ?> ><?php echo $Category['name']?></option>
  <?php 
}}
?>
</select>
          </div>
               <?php 
  
               
               foreach($SHONiR_All_Languages as $language){  ?>
              <div class="mb-3"> 
          <label for="slug_<?php echo $language['language_id']?>"><img src="media/flags/<?php echo $language['image']?>" data-toggle="tooltip" data-placement="top" title="<?php echo $language['name']?>" > Slug</label>
          <input type="text" class="form-control" id="slug_<?php echo $language['language_id']?>" name="slug_<?php echo $language['language_id']?>" placeholder="Page-slug" required="" value="<?php echo $SHONiR_Main['slug_'.$language['language_id']] ?>">
          </div>

          <div class="mb-3">
          <label for="name_<?php echo $language['language_id']?>"><img src="media/flags/<?php echo $language['image']?>" data-toggle="tooltip" data-placement="top" title="<?php echo $language['name']?>" > Name</label>
          <input type="text" class="form-control" id="name_<?php echo $language['language_id']?>" name="name_<?php echo $language['language_id']?>" placeholder="Page Name" required="" value="<?php echo $SHONiR_Main['name_'.$language['language_id']] ?>">
          </div>

<div class="mb-3">
          <label for="description_<?php echo $language['language_id']?>"><img src="media/flags/<?php echo $language['image']?>" data-toggle="tooltip" data-placement="top" title="<?php echo $language['name']?>" > Description</label>
          <textarea type="text" class="form-control" id="description_<?php echo $language['language_id']?>" name="description_<?php echo $language['language_id']?>" placeholder="this is a main Page description." ><?php echo $SHONiR_Main['description_'.$language['language_id']] ?></textarea>
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
          <input type="text" class="form-control" id="meta_title_<?php echo $language['language_id']?>" name="meta_title_<?php echo $language['language_id']?>" placeholder="this meta title use in search and on page" required="" value="<?php echo $SHONiR_Main['meta_title_'.$language['language_id']] ?>">
          </div>

          <div class="mb-3">
          <label for="meta_description_<?php echo $language['language_id']?>"><img src="media/flags/<?php echo $language['image']?>" data-toggle="tooltip" data-placement="top" title="<?php echo $language['name']?>" > Meta Description</label>
          <textarea type="text" class="form-control" id="meta_description_<?php echo $language['language_id']?>" name="meta_description_<?php echo $language['language_id']?>" placeholder="this is a main Page description for meta tag." required=""><?php echo $SHONiR_Main['meta_description_'.$language['language_id']] ?></textarea>
          </div>

<div class="mb-3">
          <label for="meta_keyword_<?php echo $language['language_id']?>"><img src="media/flags/<?php echo $language['image']?>" data-toggle="tooltip" data-placement="top" title="<?php echo $language['name']?>" > Meta Keywords</label>
          <textarea type="text" class="form-control" id="meta_keyword_<?php echo $language['language_id']?>" name="meta_keyword_<?php echo $language['language_id']?>" placeholder="Page, Blogs, sub Page, sub Blogs" required=""><?php echo $SHONiR_Main['meta_keyword_'.$language['language_id']] ?></textarea>
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
          <label for="published_time">Published Time</label>
          <input type="text" class="form-control" id="published_time" name="published_time" placeholder="<?php echo date("F d, Y h:i A", 573091200)?>" required="" value="<?php echo date("F d, Y h:i A", $SHONiR_Main['published_time'])?>">          
          </div>

          <div class="mb-3">
          <label for="sort_order">Sort Order</label>
          <input type="text" class="form-control" id="sort_order" name="sort_order" placeholder="0" required="" value="<?php echo $SHONiR_Main['sort_order'] ?>">
          </div>
          <label for="status" class="d-none d-sm-inline-block btn btn-sm btn-secondary shadow-sm">Status <input type="checkbox" id="status" name="status" value="1" class="badgebox" <?php echo ($SHONiR_Main['status']==1)?'checked="checked" checked':''; ?>><span class="badge">&check;</span></label>
          <label for="listed" class="d-none d-sm-inline-block btn btn-sm btn-secondary shadow-sm">Listed <input type="checkbox" id="listed" name="listed" value="1" class="badgebox"  <?php echo ($SHONiR_Main['listed']==1)?'checked="checked" checked':''; ?>><span class="badge">&check;</span></label>
          <label for="featured" class="d-none d-sm-inline-block btn btn-sm btn-secondary shadow-sm">Featured <input type="checkbox" id="featured" name="featured" value="1" class="badgebox"  <?php echo ($SHONiR_Main['featured']==1)?'checked="checked" checked':''; ?>><span class="badge">&check;</span></label>
          <label for="searchable" class="d-none d-sm-inline-block btn btn-sm btn-secondary shadow-sm">searchable <input type="checkbox" id="searchable" name="searchable" value="1" class="badgebox"  <?php echo ($SHONiR_Main['searchable']==1)?'checked="checked" checked':''; ?>><span class="badge">&check;</span></label>
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

    <?php $cu=0;
    foreach ($SHONiR_Main['uploads'] as $Uploads_value)
            {
              $cu++;              
              ?>

    <div class="preview-image preview-show-<?php echo $cu ?>" id="<?php echo $Uploads_value['upload_file'] ?>">
            <div class="btn btn-danger image-cancel" data-no="<?php echo $cu ?>"><i class="fas fa-trash fa-sm text-white-50"></i></div>
            <div class="image-zone"><img id="pro-img-<?php echo $cu ?>" src="<?php echo SHONiR_BASE.'media/uploads/'.$Uploads_value['upload_file'] ?>"></div>
            <div class="tools-edit-image"><a data-fancybox="images" href="<?php echo SHONiR_BASE.'media/uploads/'.$Uploads_value['upload_file'] ?>" data-no="<?php echo $cu ?>" class="btn btn-info btn-edit-image"><i class="fas fa-search-plus fa-lg text-white-50"></i></a></div>
        </div>

            <?php }?>
      
          </div>  
        
              </div>
            </div>
          </div>

          </div>

</div>

</form>
      </div>
      <!-- /.container-fluid -->

</form>
    </div>
    <!-- End of Main Content -->

    <?php require_once('common/footer.php');?>

</div>
<?php require_once('common/end.php');?>
<script>
  p( function() {

    function cb(start) {
    p('#published_time').val(start.format('MMMM D, YYYY hh:mm A'));
    }
    p('input[name="published_time"]').daterangepicker({
    "singleDatePicker": true,
    "showDropdowns": true,
    "timePicker": true,
    locale: {
      format: 'MMMM D, YYYY hh:mm A'
    }
    }, cb);

    cb(start);
  } );
  </script>
<script>

  p(document).ready(function() {
 p('#parent').select2();
});


p(document).ready(function() {
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
                            '<div class="btn btn-danger image-cancel" data-no="' + num + '"><i class="fas fa-trash fa-sm text-white-50"></i></div>' +
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
tinymce.init({selector:'#description_<?php echo $language['language_id']?>',   branding: false, min_height: 400, menubar: false, plugins: [
    'advlist autolink lists link image charmap print preview anchor',
    'searchreplace visualblocks code fullscreen',
    'insertdatetime media table paste code help wordcount'
  ],
  toolbar: 'undo redo removeformat | bold italic underline strikethrough | fontselect fontsizeselect formatselect | alignleft aligncenter alignright alignjustify | outdent indent |  numlist bullist checklist | forecolor backcolor casechange permanentpen formatpainter  | pagebreak | charmap emoticons | fullscreen  preview save print | insertfile image media pageembed template link anchor codesample | a11ycheck ltr rtl | showcomments addcomment',
toolbar_drawer: 'floating', browser_spellcheck: true, allow_script_urls: true});
<?php }?>
</script>
  </body>
</html><?php
require_once('common/clear.php');
?>