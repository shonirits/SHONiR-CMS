<?php defined('SHONiR') OR exit('No direct script access allowed');

function SHONiR_Blog_Href_Fnc($SHONiR_ID, $SHONiR_Slug = "None", $SHONiR_Mode = "Basic"){

    $SHONiR_Data = FALSE;

    if(!$SHONiR_ID){

        return $SHONiR_Data;

    }

if(SHONiR_SETTINGS['config_sef'] == "TRUE"){

    if($SHONiR_Mode == "Basic"){

    $SHONiR_Data = SHONiR_BASE.'Blogs/'.$SHONiR_ID.'_'.$SHONiR_Slug.'.'.SHONiR_SETTINGS['config_extension'];

    }else{

        $SHONiR_Data = SHONiR_BASE.'Ajax/Blog-Quick-View/'.$SHONiR_ID.'_'.$SHONiR_Slug.'.'.SHONiR_SETTINGS['config_extension'];

    }

}else{

    $SHONiR_Data = SHONiR_BASE.'index.php?id='.$SHONiR_ID.'&type=blogs&mode='.$SHONiR_Mode;


}

return $SHONiR_Data;

}


function SHONiR_Blog_Details_Fnc($SHONiR_ID, $SHONiR_Where, $SHONiR_Language_ID, $SHONiR_Hit = FALSE){

    $SHONiR_Data = array();

    if(!$SHONiR_ID){

        return false;

    }

    $SHONiR_Get_Blog = SHONiR_Get_Blog_Fnc($SHONiR_ID, $SHONiR_Where);

            if(!$SHONiR_Get_Blog){

                return false;
    
               }

    if($SHONiR_Hit){

        SHONiR_Query_Fnc("update tbl_blogs set viewed=(viewed+1), hits=(hits+1), last_hit =". time() ." where blog_id=".$SHONiR_ID);

        
    }


     $SHONiR_Get_Blog_Description = SHONiR_Blog_Description_Fnc($SHONiR_ID, $SHONiR_Language_ID);

     $SHONiR_Blog_Uploads = SHONiR_Uploads_Fnc($SHONiR_ID, 'blog');

     if($SHONiR_Blog_Uploads){

        $SHONiR_Data['image'] = $SHONiR_Blog_Uploads[0]['upload_file'];

     }else{

        $SHONiR_Data['image'] = 'n-a.png';

     }


      $SHONiR_Data['uploads'] = $SHONiR_Blog_Uploads;

      $SHONiR_User_Type = SHONiR_User_Type_Fnc($SHONiR_Get_Blog['user_type']);

     $SHONiR_Data['user'] = array();

     if($SHONiR_User_Type != 'Guest'){

    $SHONiR_Fnc = "SHONiR_".$SHONiR_User_Type."_Fnc";

    if (function_exists($SHONiR_Fnc)) {

        $SHONiR_Data['user'] = call_user_func($SHONiR_Fnc, $SHONiR_Get_Blog['user_id']);

    }

   }


      $SHONiR_Data['href'] =  SHONiR_Blog_Href_Fnc($SHONiR_ID, $SHONiR_Get_Blog_Description['slug']);

      $SHONiR_Data['qhref'] =  SHONiR_Blog_Href_Fnc($SHONiR_ID, $SHONiR_Get_Blog_Description['slug'], 'Quick');
               
      $SHONiR_Data = array_merge($SHONiR_Get_Blog,$SHONiR_Get_Blog_Description,$SHONiR_Data);

      return $SHONiR_Data;


}

function SHONiR_Get_Blog_Fnc($SHONiR_ID =  null, $SHONiR_Where = null){

    $SHONiR_Data = array();

    if(!$SHONiR_ID){
        $SHONiR_ID =  SHONiR_URI['ID'];
    }

    if($SHONiR_ID ){

        $SHONiR_Query_Blog = SHONiR_Query_Fnc("select * from tbl_blogs where blog_id=".$SHONiR_ID.$SHONiR_Where);

$SHONiR_Row_Blog= SHONiR_Row_Fnc($SHONiR_Query_Blog);

if($SHONiR_Row_Blog > 0 ){

    $SHONiR_Data = SHONiR_Fetch_Fnc($SHONiR_Query_Blog);

}else{
 
    $SHONiR_Data = false;

}
    }else{
     
        $SHONiR_Data = false;

    }
 
return $SHONiR_Data;

}

function SHONiR_Blog_Description_Fnc($SHONiR_ID, $SHONiR_Language_ID){

    $SHONiR_Query_Blog_Extra = " and language_id=".$SHONiR_Language_ID;

    $SHONiR_Query_Blog_Description = SHONiR_Query_Fnc("select * from tbl_blogs_description where blog_id=".$SHONiR_ID." ".$SHONiR_Query_Blog_Extra);

    $SHONiR_Row_Blog_Description = SHONiR_Row_Fnc($SHONiR_Query_Blog_Description);

    if($SHONiR_Row_Blog_Description > 0 ){

    $SHONiR_Fetch_Blog_Description = SHONiR_Fetch_Fnc($SHONiR_Query_Blog_Description);

    }else{
          
            $SHONiR_Fetch_Blog_Description = false;

    }

    return $SHONiR_Fetch_Blog_Description;

}

function SHONiR_Blog_Parents_Fnc($SHONiR_ID){

    $SHONiR_Query_Blog_Parents = SHONiR_Query_Fnc("select * from tbl_blogs_to_categories where blog_id=".$SHONiR_ID);

    $SHONiR_Row_Blog_Parents = SHONiR_Row_Fnc($SHONiR_Query_Blog_Parents);

    if($SHONiR_Row_Blog_Parents > 0 ){

        while($SHONiR_Fetch_Blog_Parents = SHONiR_Fetch_Fnc($SHONiR_Query_Blog_Parents))
        {
            
            $SHONiR_Return[] = $SHONiR_Fetch_Blog_Parents['parent_id'];
    
        }

    }else{

        $SHONiR_Return = false;

    }

    return $SHONiR_Return;

}

function SHONiR_AP_Blogs_Fnc_Render(){

    $SHONiR_Second =  SHONiR_URI['Second'];

    $SHONiR_CSRF = SHONiR_Post_Fnc('SHONiR_CSRF');

    if($SHONiR_CSRF){  

    if(SHONiR_CSRF_Fnc($SHONiR_CSRF)){

        if($SHONiR_Second == 'Add'){ 

        $SHONiR_sort_order = SHONiR_Post_Fnc('sort_order', FILTER_VALIDATE_INT);
        if(!$SHONiR_sort_order){
            $SHONiR_sort_order = 0;
        }
        $SHONiR_status = SHONiR_Post_Fnc('status', FILTER_VALIDATE_INT);
        if(!$SHONiR_status){
            $SHONiR_status = 0;
        }
        $SHONiR_listed = SHONiR_Post_Fnc('listed', FILTER_VALIDATE_INT);
        if(!$SHONiR_listed){
            $SHONiR_listed = 0;
        }
        $SHONiR_locked = SHONiR_Post_Fnc('locked', FILTER_VALIDATE_INT);
        if(!$SHONiR_locked){
            $SHONiR_locked = 0;
        }

        $SHONiR_featured= SHONiR_Post_Fnc('featured', FILTER_VALIDATE_INT);
        if(!$SHONiR_featured){
            $SHONiR_featured = 0;
        }

        $SHONiR_published_time = SHONiR_Post_Fnc('published_time');

        if(!$SHONiR_published_time){
            $SHONiR_published_time = 573091200;
        }else{

            $SHONiR_published_time = (int)strtotime($SHONiR_published_time);
        }

        $SHONiR_searchable = SHONiR_Post_Fnc('searchable', FILTER_VALIDATE_INT);
        if(!$SHONiR_searchable){
            $SHONiR_searchable = 0;
        }

    

   SHONiR_Query_Fnc("insert into tbl_blogs (user_id, user_type, sort_order, published_time, status, listed, locked, featured, searchable, add_time, edit_time) values (".SHONiR_USER['user_id'].", ".SHONiR_USER['user_type'].", ".$SHONiR_sort_order.", ".$SHONiR_published_time.", ".$SHONiR_status.", ".$SHONiR_listed.", ".$SHONiR_locked.", ".$SHONiR_featured.", ".$SHONiR_searchable.", ".time().", ".time()." )");

   $SHONiR_blog_id = SHONiR_Insert_ID_Fnc();

   $SHONiR_All_Languages = SHONiR_Languages_Fnc(FALSE, 1, 'asc');

   foreach($SHONiR_All_Languages as $language)
{

   SHONiR_Query_Fnc("insert into tbl_blogs_description (blog_id, language_id, slug, name, description, meta_title, meta_description, meta_keyword) values (".$SHONiR_blog_id.", ".$language['language_id'].", '".SHONiR_Slug_Fnc(SHONiR_Post_Fnc('slug_'.$language['language_id']))."', '".SHONiR_Post_Fnc('name_'.$language['language_id'])."', '".SHONiR_Post_Fnc('description_'.$language['language_id'])."', '".SHONiR_Post_Fnc('meta_title_'.$language['language_id'])."', '".SHONiR_Post_Fnc('meta_description_'.$language['language_id'])."', '".SHONiR_Post_Fnc('meta_keyword_'.$language['language_id'])."')");

}

$SHONiR_parent = SHONiR_Post_Fnc('parent');

if($SHONiR_parent){
    
    foreach ($SHONiR_parent as $parent){

        if($parent > 0 ){

            SHONiR_Query_Fnc("insert into tbl_blogs_to_categories (blog_id, parent_id) values (".$SHONiR_blog_id.", ".$parent.")");

        }

    }     

}

$SHONiR_files = $_FILES['files'];

$SHONiR_files_sort_order = SHONiR_Post_Fnc('files_sort_order');

$SHONiR_files_sort_order_list = explode(',', $SHONiR_files_sort_order); 

$SHONiR_files_sort_order_array = array();

foreach ($SHONiR_files_sort_order_list as $list)
{

    $SHONiR_files_sort_order_value = substr($list, strrpos($list, '='), strlen($list));
    $SHONiR_files_sort_order_key = str_replace($SHONiR_files_sort_order_value, '', $list);
    $SHONiR_files_sort_order_value = str_replace('=', '', $SHONiR_files_sort_order_value);
    $SHONiR_files_sort_order_array[$SHONiR_files_sort_order_key] = $SHONiR_files_sort_order_value;

}

$SHONiR_files_count = count($SHONiR_files['name']);

$SHONiR_files_final  = '';

for($i=0;$i<$SHONiR_files_count;$i++){

    $SHONiR_files_name = $SHONiR_files['name'][$i];

 $SHONiR_files_pos = strrpos($SHONiR_files_name, '.');

 if(empty($SHONiR_files_name) && empty($SHONiR_files_pos)){

 $SHONiR_files_final = '';

 }else{

  $SHONiR_files_extension = substr($SHONiR_files_name, $SHONiR_files_pos, strlen($SHONiR_files_name));  

  $SHONiR_files_final = SHONiR_Slug_Fnc(str_replace($SHONiR_files_extension, '', $SHONiR_files_name));

 $SHONiR_files_final = $SHONiR_files_final."-".SHONiR_Counter_Fnc('uploads').$SHONiR_files_extension;

}

if($SHONiR_files_final)
{

    $SHONiR_sort_order = @$SHONiR_files_sort_order_array[$SHONiR_files_name];

    if(!is_numeric($SHONiR_sort_order)){
        $SHONiR_sort_order = 0;
    }

SHONiR_Query_Fnc("insert into tbl_uploads (upload_file, sort_order, parent_id, parent_type, add_time) values ('".$SHONiR_files_final."', ".$SHONiR_sort_order.", ".$SHONiR_blog_id.", 'blog', ".time().")");

move_uploaded_file($SHONiR_files["tmp_name"][$i], SHONiR_ROOT.'media/uploads/'.$SHONiR_files_final);

if(SHONiR_SETTINGS['config_auto_resize']){
   
SHONiR_Resize_Fnc(SHONiR_ROOT.'media/uploads/'.$SHONiR_files_final);

}

}

}

   $SHONiR_Alert['type'] = 'success';
   $SHONiR_Alert['message'] = 'New Blog has been added successfully.';
   SHONiR_Session_Write_Fnc('SHONiR_Alert', $SHONiR_Alert);

 SHONiR_Redirect_Fnc(SHONiR_APANEL.'Blogs');

}elseif($SHONiR_Second == 'Edit'){

    $SHONiR_Get_blog_id = SHONiR_Get_Fnc('blog_id');

           if(!$SHONiR_Get_blog_id){

            $SHONiR_Alert['type'] = 'error';
        $SHONiR_Alert['message'] = 'Unknown error occurred please try again later.';
        SHONiR_Session_Write_Fnc('SHONiR_Alert', $SHONiR_Alert);
        SHONiR_Redirect_Fnc(SHONiR_APANEL.'Blogs');

           }

           $SHONiR_Get_Blog_Records = SHONiR_Get_Blog_Fnc($SHONiR_Get_blog_id);

            if(!$SHONiR_Get_Blog_Records){

                $SHONiR_Alert['type'] = 'error';
            $SHONiR_Alert['message'] = 'The requested record was not found.';
            SHONiR_Session_Write_Fnc('SHONiR_Alert', $SHONiR_Alert);
            SHONiR_Redirect_Fnc(SHONiR_APANEL.'Blogs');
    
               }


           SHONiR_Query_Fnc("delete from tbl_blogs_to_categories where blog_id=".$SHONiR_Get_blog_id);

    $SHONiR_sort_order = SHONiR_Post_Fnc('sort_order', FILTER_VALIDATE_INT);
        if(!$SHONiR_sort_order){
            $SHONiR_sort_order = 0;
        }
        
        $SHONiR_status = SHONiR_Post_Fnc('status', FILTER_VALIDATE_INT);
        if(!$SHONiR_status){
            $SHONiR_status = 0;
        }
        $SHONiR_listed = SHONiR_Post_Fnc('listed', FILTER_VALIDATE_INT);
        if(!$SHONiR_listed){
            $SHONiR_listed = 0;
        }
        $SHONiR_locked = SHONiR_Post_Fnc('locked', FILTER_VALIDATE_INT);
        if(!$SHONiR_locked){
            $SHONiR_locked = 0;
        }

        $SHONiR_featured= SHONiR_Post_Fnc('featured', FILTER_VALIDATE_INT);
        if(!$SHONiR_featured){
            $SHONiR_featured = 0;
        }

        $SHONiR_published_time = SHONiR_Post_Fnc('published_time');

        if(!$SHONiR_published_time){
            $SHONiR_published_time = 573091200;
        }else{

            $SHONiR_published_time = (int)strtotime($SHONiR_published_time);
        }



        $SHONiR_searchable = SHONiR_Post_Fnc('searchable', FILTER_VALIDATE_INT);
        if(!$SHONiR_searchable){
            $SHONiR_searchable = 0;
        }

     SHONiR_Query_Fnc("update tbl_blogs set sort_order=". $SHONiR_sort_order .", published_time=". $SHONiR_published_time .", status=". $SHONiR_status .", listed=". $SHONiR_listed .", locked=". $SHONiR_locked .", featured=". $SHONiR_featured.",  searchable=". $SHONiR_searchable .",  edit_time =". time() ." where blog_id=".$SHONiR_Get_blog_id);

     $SHONiR_All_Languages = SHONiR_Languages_Fnc(FALSE, 1, 'asc');

        foreach($SHONiR_All_Languages as $language)
{

    if(SHONiR_Blog_Description_Fnc($SHONiR_Get_blog_id, $language['language_id'])){


SHONiR_Query_Fnc("update tbl_blogs_description set slug='".SHONiR_Slug_Fnc(SHONiR_Post_Fnc('slug_'.$language['language_id']))."',  name='".SHONiR_Post_Fnc('name_'.$language['language_id'])."',  description='".SHONiR_Post_Fnc('description_'.$language['language_id'])."',  meta_title='".SHONiR_Post_Fnc('meta_title_'.$language['language_id'])."',  meta_description='".SHONiR_Post_Fnc('meta_description_'.$language['language_id'])."',  meta_keyword='".SHONiR_Post_Fnc('meta_keyword_'.$language['language_id'])."'  where language_id=".$language['language_id']." and blog_id=".$SHONiR_Get_blog_id);

    }else{

        SHONiR_Query_Fnc("insert into tbl_blogs_description (blog_id, language_id, slug, name, description, meta_title, meta_Description, meta_keyword) values (".$SHONiR_Get_blog_id.", ".$language['language_id'].", '".SHONiR_Post_Fnc('slug_'.$language['language_id'])."', '".SHONiR_Slug_Fnc(SHONiR_Post_Fnc('name_'.$language['language_id']))."', '".SHONiR_Post_Fnc('description_'.$language['language_id'])."', '".SHONiR_Post_Fnc('meta_title_'.$language['language_id'])."', '".SHONiR_Post_Fnc('meta_Description_'.$language['language_id'])."', '".SHONiR_Post_Fnc('meta_keyword_'.$language['language_id'])."')");

    }

}

$SHONiR_parent = SHONiR_Post_Fnc('parent');

if($SHONiR_parent){
    
    foreach ($SHONiR_parent as $parent){

        if($parent > 0 ){

            SHONiR_Query_Fnc("insert into tbl_blogs_to_categories (blog_id, parent_id) values (".$SHONiR_Get_blog_id.", ".$parent.")");

        }

    }     

}

$SHONiR_files = $_FILES['files'];

$SHONiR_files_sort_order = SHONiR_Post_Fnc('files_sort_order');

$SHONiR_files_sort_order_list = explode(',', $SHONiR_files_sort_order); 

$SHONiR_files_sort_order_array = array();

foreach ($SHONiR_files_sort_order_list as $list)
{

    $SHONiR_files_sort_order_value = substr($list, strrpos($list, '='), strlen($list));
    $SHONiR_files_sort_order_key = str_replace($SHONiR_files_sort_order_value, '', $list);
    $SHONiR_files_sort_order_value = str_replace('=', '', $SHONiR_files_sort_order_value);
    $SHONiR_files_sort_order_array[$SHONiR_files_sort_order_key] = $SHONiR_files_sort_order_value;

}
$SHONiR_Uploads_Records = SHONiR_Uploads_Fnc($SHONiR_Get_blog_id, 'blog');

            $SHONiR_Main['uploads'] = $SHONiR_Uploads_Records;
 
            foreach ($SHONiR_Uploads_Records as $Uploads_value)
            {

            
                if (!array_key_exists($Uploads_value['upload_file'],$SHONiR_files_sort_order_array)){

                    SHONiR_Query_Fnc("delete from tbl_uploads where upload_id=".$Uploads_value['upload_id']);

                    if (file_exists(SHONiR_ROOT.'media/uploads/'.$Uploads_value['upload_file'])) { unlink (SHONiR_ROOT.'media/uploads/'.$Uploads_value['upload_file']); } 

                }else{

                    $SHONiR_sort_order = @$SHONiR_files_sort_order_array[$Uploads_value['upload_file']];
                    
                    SHONiR_Query_Fnc("update tbl_uploads set sort_order=". $SHONiR_sort_order ." where upload_id=".$Uploads_value['upload_id']);

                }


            }

$SHONiR_files_count = count($SHONiR_files['name']);
$SHONiR_files_final  = '';

for($i=0;$i<$SHONiR_files_count;$i++){

    $SHONiR_files_name = $SHONiR_files['name'][$i];

 $SHONiR_files_pos = strrpos($SHONiR_files_name, '.');

 if(empty($SHONiR_files_name) && empty($SHONiR_files_pos)){

 $SHONiR_files_final = '';

 }else{

  $SHONiR_files_extension = substr($SHONiR_files_name, $SHONiR_files_pos, strlen($SHONiR_files_name));  

  $SHONiR_files_final = SHONiR_Slug_Fnc(str_replace($SHONiR_files_extension, '', $SHONiR_files_name));

 $SHONiR_files_final = $SHONiR_files_final."-".SHONiR_Counter_Fnc('uploads').$SHONiR_files_extension;

}

if($SHONiR_files_final)
{

    $SHONiR_sort_order = @$SHONiR_files_sort_order_array[$SHONiR_files_name];

    if(!is_numeric($SHONiR_sort_order)){
        $SHONiR_sort_order = 0;
    }


SHONiR_Query_Fnc("insert into tbl_uploads (upload_file, sort_order, parent_id, parent_type, add_time) values ('".$SHONiR_files_final."', ".$SHONiR_sort_order.", ".$SHONiR_Get_blog_id.", 'blog', ".time().")");

move_uploaded_file($SHONiR_files["tmp_name"][$i], SHONiR_ROOT.'media/uploads/'.$SHONiR_files_final);

if(SHONiR_SETTINGS['config_auto_resize']){
   
    SHONiR_Resize_Fnc(SHONiR_ROOT.'media/uploads/'.$SHONiR_files_final);
    
    }

}

}

$SHONiR_Alert['type'] = 'success';
   $SHONiR_Alert['message'] = 'Blog has been updated successfully.';
   SHONiR_Session_Write_Fnc('SHONiR_Alert', $SHONiR_Alert);

 SHONiR_Redirect_Fnc(SHONiR_APANEL.'Blogs');

}

     }else{

        $SHONiR_Alert['type'] = 'error';
        $SHONiR_Alert['message'] = 'Please make sure your browser has cookies enabled and try again.';
        SHONiR_Session_Write_Fnc('SHONiR_Alert', $SHONiR_Alert);

     }

  }

        if($SHONiR_Second == 'Add'){           

            $SHONiR_Main['meta_title'] = 'Add | Blogs | SHONiR Administrator Panel | Created with LOVE by SHONiR';

            $SHONiR_Main['meta_description'] = '';
            
            $SHONiR_Main['meta_keyword'] = '';

            $SHONiR_Main['SHONiR_CSRF'] = SHONiR_CSRF_Fnc('G');

            $SHONiR_Main['SHONiR_Languages'] = SHONiR_Languages_Fnc(FALSE, 1, 'asc');
            
            $SHONiR_Main['SHONiR_Categories'] = SHONiR_Get_Blogs_Categories_Fnc();

            $GLOBALS['SHONiR_VIEWS_FILE'] = "blogs-add";


        }elseif($SHONiR_Second == 'Edit'){

            $SHONiR_Get_blog_id = SHONiR_Get_Fnc('blog_id');

           if(!$SHONiR_Get_blog_id){

            $SHONiR_Alert['type'] = 'error';
        $SHONiR_Alert['message'] = 'Unknown error occurred please try again later.';
        SHONiR_Session_Write_Fnc('SHONiR_Alert', $SHONiR_Alert);
        SHONiR_Redirect_Fnc(SHONiR_APANEL.'Blogs');

           }

           $SHONiR_Get_Blog_Records = SHONiR_Get_Blog_Fnc($SHONiR_Get_blog_id);

            if(!$SHONiR_Get_Blog_Records){

                $SHONiR_Alert['type'] = 'error';
            $SHONiR_Alert['message'] = 'The requested record was not found.';
            SHONiR_Session_Write_Fnc('SHONiR_Alert', $SHONiR_Alert);
            SHONiR_Redirect_Fnc(SHONiR_APANEL.'Blogs');
    
               }
               

            foreach ($SHONiR_Get_Blog_Records as $Blog_key => $Blog_value)
            {

       if(SHONiR_Post_Fnc('SHONiR_CSRF')){

        $SHONiR_Main[$Blog_key] = SHONiR_Post_Fnc($Blog_key);

       }else{

    $SHONiR_Main[$Blog_key] = $Blog_value;

       }

            }  

            $SHONiR_Languages_Records = SHONiR_Languages_Fnc(FALSE, 1, 'asc');

            foreach ($SHONiR_Languages_Records as $Languages_value)
            {

                $SHONiR_Blog_Description_Records[$Languages_value['language_id']] = SHONiR_Blog_Description_Fnc($SHONiR_Get_blog_id, $Languages_value['language_id']);

                if(is_array($SHONiR_Blog_Description_Records[$Languages_value['language_id']])){

                foreach ($SHONiR_Blog_Description_Records[$Languages_value['language_id']] as $Description_key => $Description_value)
            {

                if(SHONiR_Post_Fnc('SHONiR_CSRF')){

                    $SHONiR_Main[$Description_key.'_'.$Languages_value['language_id']] = SHONiR_Post_Fnc($Description_key.'_'.$Languages_value['language_id']);

                }else{

                $SHONiR_Main[$Description_key.'_'.$Languages_value['language_id']] = $Description_value;

                }

            }

        }

            }

            $SHONiR_Uploads_Records = SHONiR_Uploads_Fnc($SHONiR_Get_blog_id, 'blog');

            $SHONiR_Main['uploads'] = $SHONiR_Uploads_Records;

            $SHONiR_files_sort_order='';
 
            foreach ($SHONiR_Uploads_Records as $Uploads_value)
            {

            $SHONiR_files_sort_order .= $Uploads_value['upload_file'].'='.$Uploads_value['sort_order'].',';

            }

            $SHONiR_Main['files_sort_order'] = $SHONiR_files_sort_order;
                

            if(SHONiR_Post_Fnc('SHONiR_CSRF')){

                $SHONiR_Main['SHONiR_Parent'] = SHONiR_Post_Fnc('parent');

            }else{

                $SHONiR_Main['SHONiR_Parent'] = SHONiR_Blog_Parents_Fnc($SHONiR_Get_blog_id);

            }

            $SHONiR_Main['meta_title'] = 'Edit | Blogs | SHONiR Administrator Panel | Created with LOVE by SHONiR';

            $SHONiR_Main['meta_description'] = '';
            
            $SHONiR_Main['meta_keyword'] = '';

            $SHONiR_Main['SHONiR_GET_ID'] = $SHONiR_Get_blog_id;

            $SHONiR_Main['SHONiR_CSRF'] = SHONiR_CSRF_Fnc('G');

            $SHONiR_Main['SHONiR_Languages'] = $SHONiR_Languages_Records;

            $SHONiR_Main['SHONiR_Categories'] = SHONiR_Get_Blogs_Categories_Fnc();

            $GLOBALS['SHONiR_VIEWS_FILE'] = "blogs-edit";

        }elseif($SHONiR_Second == 'Delete'){

            $SHONiR_Get_blog_id = SHONiR_Get_Fnc('blog_id');

            if(!$SHONiR_Get_blog_id){
 
             $SHONiR_Alert['type'] = 'error';
         $SHONiR_Alert['message'] = 'Unknown error occurred please try again later.';
         SHONiR_Session_Write_Fnc('SHONiR_Alert', $SHONiR_Alert);
         SHONiR_Redirect_Fnc(SHONiR_APANEL.'Blogs');
 
            }    

            $SHONiR_Get_Blog_Records = SHONiR_Get_Blog_Fnc($SHONiR_Get_blog_id);

            if(!$SHONiR_Get_Blog_Records){

                $SHONiR_Alert['type'] = 'error';
            $SHONiR_Alert['message'] = 'The requested record was not found.';
            SHONiR_Session_Write_Fnc('SHONiR_Alert', $SHONiR_Alert);
            SHONiR_Redirect_Fnc(SHONiR_APANEL.'Blogs');
    
               }      
               
               
               if($SHONiR_Get_Blog_Records['locked']){

                $SHONiR_Alert['type'] = 'error';
            $SHONiR_Alert['message'] = 'Access Denied! You cannot delete this record.';
            SHONiR_Session_Write_Fnc('SHONiR_Alert', $SHONiR_Alert);
            SHONiR_Redirect_Fnc(SHONiR_APANEL.'Blogs');
    
               }

               $SHONiR_Uploads_Records = SHONiR_Uploads_Fnc($SHONiR_Get_blog_id, 'blog');
    
               foreach ($SHONiR_Uploads_Records as $Uploads_value)
               {
   
                SHONiR_Query_Fnc("delete from tbl_uploads where upload_id=".$Uploads_value['upload_id']);

             if (file_exists(SHONiR_ROOT.'media/uploads/'.$Uploads_value['upload_file'])) { unlink (SHONiR_ROOT.'media/uploads/'.$Uploads_value['upload_file']); } 
   
               }

               SHONiR_Query_Fnc("delete from tbl_blogs_to_categories where blog_id=".$SHONiR_Get_blog_id);

               SHONiR_Query_Fnc("delete from tbl_blogs_description where blog_id=".$SHONiR_Get_blog_id);

               SHONiR_Query_Fnc("delete from tbl_blogs where blog_id=".$SHONiR_Get_blog_id);

               $SHONiR_Alert['type'] = 'success';
   $SHONiR_Alert['message'] = 'Blog has been deleted successfully.';
   SHONiR_Session_Write_Fnc('SHONiR_Alert', $SHONiR_Alert);

 SHONiR_Redirect_Fnc(SHONiR_APANEL.'Blogs');


        }else{

            $SHONiR_Main['meta_title'] = 'Blogs | SHONiR Administrator Panel | Created with LOVE by SHONiR';

            $SHONiR_Main['meta_description'] = '';
            
            $SHONiR_Main['meta_keyword'] = '';

          $SHONiR_Main['SHONiR_Get_Blogs'] = SHONiR_Get_Blogs_Fnc();

        }


    $SHONiR_Data["SHONiR_Main"] =  $SHONiR_Main;

    

return $SHONiR_Data;

}

function SHONiR_Blogs_Fnc_Render(){

    $SHONiR_ID =  SHONiR_URI['ID'];

    $SHONiR_EX =  SHONiR_URI['EX'];

    $SHONiR_Last = SHONiR_URI['Last'];

    $SHONiR_Keywords = SHONiR_Get_Fnc('q');

    $SHONiR_Where = "";
    
    if($SHONiR_EX== SHONiR_SETTINGS['config_extension']){


        if(!$SHONiR_ID){

            $SHONiR_Alert['type'] = 'error';
        $SHONiR_Alert['message'] = 'Unknown error occurred please try again later.';
        SHONiR_Session_Write_Fnc('SHONiR_Alert', $SHONiR_Alert);
        SHONiR_Redirect_Fnc(SHONiR_BASE);

           }


           $SHONiR_Blog_Details = SHONiR_Blog_Details_Fnc($SHONiR_ID, ' and status=1 ', SHONiR_LANGUAGE['language_id'], TRUE);

            if(!$SHONiR_Blog_Details){

                $SHONiR_Alert['type'] = 'error';
            $SHONiR_Alert['message'] = 'The requested record was not found.';
            SHONiR_Session_Write_Fnc('SHONiR_Alert', $SHONiR_Alert);
            SHONiR_Redirect_Fnc(SHONiR_BASE);
    
               }

               $SHONiR_Get_Query_String = SHONiR_Get_Query_String_Fnc();

               if($SHONiR_Get_Query_String){
    
                SHONiR_Save_Tags_Fnc($SHONiR_ID, "blog", $SHONiR_Get_Query_String);
    
               }

               
              $SHONiR_Main['SHONiR_Blog_Details'] = $SHONiR_Blog_Details;

              $SHONiR_Blog_Parents =  SHONiR_Blog_Parents_Fnc($SHONiR_ID);


 $SHONiR_Main['meta_title'] = $SHONiR_Blog_Details['meta_title'];

    $SHONiR_Main['meta_description'] = $SHONiR_Blog_Details['meta_description'];
    
    $SHONiR_Main['meta_keyword'] = $SHONiR_Blog_Details['meta_keyword'];

    $SHONiR_Main['SHONiR_CSRF'] = SHONiR_CSRF_Fnc('G');

    $SHONiR_Data["Blogs_Categories_Tree"] = SHONiR_Blogs_Categories_Tree_Fnc(0, 'c.status=1 and c.listed=1', SHONiR_LANGUAGE['language_id']);

    $SHONiR_Data["Related_Blogs"] = SHONiR_Get_Blogs_Fnc(TRUE, $SHONiR_Blog_Parents, "b.status=1 and b.listed=1 and b.blog_id<>".$SHONiR_ID, "b.viewed", "asc", SHONiR_SETTINGS['config_records_limit']);

    $SHONiR_Data["Recently_Viewed_Blogs"] = SHONiR_Get_Blogs_Fnc(TRUE, 0, "b.status=1 and b.listed=1 and b.blog_id<>".$SHONiR_ID, "b.last_hit", "desc", SHONiR_SETTINGS['config_records_limit']);

    $SHONiR_Data["Categories_Tree"] = SHONiR_Categories_Tree_Fnc(0, 'c.status=1 and c.listed=1', SHONiR_LANGUAGE['language_id']);

    $SHONiR_Data["Pages_Tree"] = SHONiR_Pages_Tree_Fnc(0, 'p.status=1 and p.listed=1', SHONiR_LANGUAGE['language_id']);

    $SHONiR_Data["Recently_Viewed_Products"] = SHONiR_Get_Products_Fnc(TRUE, 0, "p.status=1 and p.listed=1", "p.last_hit", "desc", SHONiR_SETTINGS['config_records_limit']);

    $GLOBALS['SHONiR_VIEWS_FILE'] = 'blog_details';

    }else{

        if($SHONiR_Last=='search'){

            $SHONiR_Data["Sub_Categories"] = array();

        }else{

    if(!$SHONiR_ID){

        $SHONiR_Where = " and NOT EXISTS (SELECT * FROM tbl_blogs_categories_to_categories ctc WHERE c.category_id = ctc.category_id)";

    }    
       
    $SHONiR_Data["Sub_Categories"] = SHONiR_Get_Categories_Fnc($SHONiR_ID, "c.status=1 and c.listed=1".$SHONiR_Where);
}

    $SHONiR_Order = SHONiR_Get_Fnc('o');

    if(!$SHONiR_Order){

        $SHONiR_Order = "sort_order";
    }else{

        $SHONiR_Order = $SHONiR_Order;

    }

    $SHONiR_By = SHONiR_Get_Fnc('b');

    if($SHONiR_By!="desc"){

        $SHONiR_By = "asc";

    }

    if($SHONiR_Last=='search'){

        $SHONiR_Where = "b.status=1 and b.searchable=1";

        $SHONiR_ID = SHONiR_Get_Fnc('c');

        if(!ctype_digit($SHONiR_ID)){

            $SHONiR_ID = 0;

          } 

    }else{

        $SHONiR_Where = "b.status=1 and b.listed=1";


    }



    $SHONiR_Query = SHONiR_Get_Blogs_Fnc(TRUE, $SHONiR_ID,  $SHONiR_Where, 'b.'.$SHONiR_Order, $SHONiR_By, false, $SHONiR_Keywords);

    if($SHONiR_Query){
    $SHONiR_Total_Records = count($SHONiR_Query); 
    }else{
        $SHONiR_Total_Records = 0;
    }

    $SHONiR_Page_No = SHONiR_Get_Fnc('n');

    $SHONiR_Records_Limit = SHONiR_SETTINGS['config_records_limit'];    

$SHONiR_Total_Pages = ceil($SHONiR_Total_Records / $SHONiR_Records_Limit);

if(!ctype_digit($SHONiR_Page_No) || $SHONiR_Page_No<1 || $SHONiR_Page_No>$SHONiR_Total_Pages){

  $SHONiR_Page_No = 1;
}     

$SHONiR_Start = ($SHONiR_Page_No-1) * $SHONiR_Records_Limit;      

$SHONiR_SQL_Pagination_Limit = $SHONiR_Start.", ".$SHONiR_Records_Limit; 

    $SHONiR_Query_Pagination = SHONiR_Get_Blogs_Fnc(TRUE, $SHONiR_ID,  $SHONiR_Where, 'b.'.$SHONiR_Order, $SHONiR_By, $SHONiR_SQL_Pagination_Limit, $SHONiR_Keywords);          

    if($SHONiR_Query_Pagination){
        $SHONiR_Row_Pagination = count($SHONiR_Query_Pagination);
        }else{
            $SHONiR_Row_Pagination = 0;
        }
    
    if($SHONiR_Row_Pagination > 0 ){   

    $SHONiR_Rows = $SHONiR_Query_Pagination;

    $SHONiR_Page = SHONiR_BASE.'Blogs/'.$SHONiR_Last.'?o='.$SHONiR_Order.'&b='.$SHONiR_By.'&';

    $SHONiR_Style = 'float-right';

    $SHONiR_Main['SHONiR_Blogs'] =  SHONiR_Pagination_Fnc($SHONiR_Page_No, $SHONiR_Records_Limit, $SHONiR_Total_Pages, $SHONiR_Total_Records, $SHONiR_Start, $SHONiR_Row_Pagination, $SHONiR_Rows, $SHONiR_Page, True, True, $SHONiR_Style);

    }else{

      $SHONiR_Main['SHONiR_Blogs'] = false;

    }

    if($SHONiR_ID){

        $SHONiR_Current_Category = SHONiR_Category_Details_Fnc($SHONiR_ID,'c.status=1', SHONiR_LANGUAGE['language_id']);
    }else{

        $SHONiR_Current_Category = false;
    }

    if($SHONiR_Keywords){

        $SHONiR_Main['meta_title'] = 'Search: '.$SHONiR_Keywords;

    $SHONiR_Main['meta_description'] = '';
    
    $SHONiR_Main['meta_keyword'] = '';

    $SHONiR_Main['heading'] = 'Search: '.$SHONiR_Keywords;


    }elseif($SHONiR_Current_Category) {
        $SHONiR_Main = array_merge($SHONiR_Main,$SHONiR_Current_Category);

        $SHONiR_Main['heading'] = $SHONiR_Current_Category['name'];
    }else{

    $SHONiR_Main['meta_title'] = 'Our Blog Categories';

    $SHONiR_Main['meta_description'] = '';
    
    $SHONiR_Main['meta_keyword'] = '';

    $SHONiR_Main['heading'] = 'Our Blog Categories';

    }

    $SHONiR_Data["Categories_Tree"] = SHONiR_Blogs_Categories_Tree_Fnc(0, 'c.status=1 and c.listed=1', SHONiR_LANGUAGE['language_id']);

    $SHONiR_Data["Pages_Tree"] = SHONiR_Pages_Tree_Fnc(0, 'p.status=1 and p.listed=1', SHONiR_LANGUAGE['language_id']);

    $SHONiR_Data["Recently_Viewed_Blogs"] = SHONiR_Get_Blogs_Fnc(TRUE, 0, "b.status=1 and b.listed=1", "b.last_hit", "desc", SHONiR_SETTINGS['config_records_limit']);

}

$SHONiR_Data["SHONiR_Main"] =  $SHONiR_Main;

    return $SHONiR_Data;

}

function SHONiR_Get_Blogs_Fnc($SHONiR_Viewed = FALSE, $SHONiR_Parent = 0, $SHONiR_Where = FALSE, $SHONiR_Order = 'b.sort_order', $SHONiR_By = 'asc', $SHONiR_Limit = FALSE, $SHONiR_Keywords = null){

    $SHONiR_Data = array(); 
    
    $SHONiR_SQL_Blogs_Where = ' where bd.language_id='.SHONiR_LANGUAGE['language_id'];
    $SHONiR_Parent_Where = '';

    $SHONiR_SQL_Search = '';

    if($SHONiR_Keywords){

        $SHONiR_SQL_Search = "(bd.slug LIKE '%".$SHONiR_Keywords."%' OR bd.name LIKE '%".$SHONiR_Keywords."%' OR bd.description LIKE '%".$SHONiR_Keywords."%' OR bd.tag LIKE '%".$SHONiR_Keywords."%' OR bd.meta_title LIKE '%".$SHONiR_Keywords."%' OR bd.meta_description LIKE '%".$SHONiR_Keywords."%' OR bd.meta_keyword LIKE '%".$SHONiR_Keywords."%' )";

        $SHONiR_SQL_Blogs_Where .= ' and '.$SHONiR_SQL_Search;
    }

    //echo $SHONiR_SQL_Blogs_Where;exit;

    if($SHONiR_Parent){

        $SHONiR_SQL_Blogs = "select * from tbl_blogs b left join tbl_blogs_description bd on b.blog_id=bd.blog_id left join tbl_blogs_to_categories btc on b.blog_id=btc.blog_id" ; 

        if(is_array($SHONiR_Parent)){
            $SHONiR_Parent_Array = $SHONiR_Parent;
            foreach($SHONiR_Parent as $key => $value)
{
    $SHONiR_Parent_Where .= ($SHONiR_Parent_Where)?' or ':'';
    $SHONiR_Parent_Where .=" btc.parent_id=". $value;
}

$SHONiR_SQL_Blogs_Where .= " and btc.parent_id=". $SHONiR_Parent_Where;

        }else{

        $SHONiR_SQL_Blogs_Where .= " and btc.parent_id=".$SHONiR_Parent;
        
        }

        if($SHONiR_Where !== FALSE){

            $SHONiR_SQL_Blogs_Where .= " and ".$SHONiR_Where;
        
            }

    }else{
    
    $SHONiR_SQL_Blogs = "select * from tbl_blogs b left join tbl_blogs_description bd on b.blog_id=bd.blog_id" ;

    if($SHONiR_Where !== FALSE){

        $SHONiR_SQL_Blogs_Where .= " and ".$SHONiR_Where;
    
        }

    }

    $SHONiR_SQL_Blogs_Limit = '';

    $SHONiR_SQL_Blogs_Sort = " order by ".$SHONiR_Order."  ".$SHONiR_By." ";

    if($SHONiR_Limit !== FALSE){

    $SHONiR_SQL_Blogs_Limit = "  limit ".$SHONiR_Limit;

    }

    $SHONiR_Query_Run = $SHONiR_SQL_Blogs.$SHONiR_SQL_Blogs_Where.$SHONiR_SQL_Blogs_Sort.$SHONiR_SQL_Blogs_Limit;

    $SHONiR_Query_Blogs = SHONiR_Query_Fnc($SHONiR_Query_Run);

    $SHONiR_Row_Blogs = SHONiR_Row_Fnc($SHONiR_Query_Blogs);

    if($SHONiR_Row_Blogs > 0 ){  
        
        while($row =  SHONiR_Fetch_Fnc($SHONiR_Query_Blogs))
{

    if($SHONiR_Viewed){

        SHONiR_Query_Fnc("update tbl_blogs set viewed=(viewed+1) where blog_id=".$row['blog_id']);   
    }

    $SHONiR_More['image2'] = '';

    $SHONiR_Blog_Uploads = SHONiR_Uploads_Fnc($row['blog_id'], 'blog');

    if($SHONiR_Blog_Uploads){

        $SHONiR_More['image'] = $SHONiR_Blog_Uploads[0]['upload_file'];       

        if(count($SHONiR_Blog_Uploads) > 1){            

            $SHONiR_More['image2'] = $SHONiR_Blog_Uploads[1]['upload_file'];
        }else{

            unset($SHONiR_More['image2']);
        }

     }else{

        $SHONiR_More['image'] = 'n-a.png';

     }

     $SHONiR_User_Type = SHONiR_User_Type_Fnc($row['user_type']);

     $SHONiR_More['user'] = array();

     if($SHONiR_User_Type != 'Guest'){

    $SHONiR_Fnc = "SHONiR_".$SHONiR_User_Type."_Fnc";

    if (function_exists($SHONiR_Fnc)) {

        $SHONiR_More['user'] = call_user_func($SHONiR_Fnc, $row['user_id']);

    }

   }

     $SHONiR_More['href'] =  SHONiR_Blog_Href_Fnc($row['blog_id'], $row['slug']);

     $SHONiR_More['qhref'] =  SHONiR_Blog_Href_Fnc($row['blog_id'], $row['slug'], 'Quick');



     $SHONiR_Data[] = array_merge($row,$SHONiR_More);

   

    
}

    }else{

        $SHONiR_Data = false;

    }   

 
return $SHONiR_Data;

}




?>