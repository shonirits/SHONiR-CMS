<?php defined('SHONiR') OR exit('No direct script access allowed');

function SHONiR_Category_Href_Fnc($SHONiR_ID, $SHONiR_Slug = "None", $SHONiR_Mode = "Basic"){

    $SHONiR_Data = FALSE;

    if(!$SHONiR_ID){

        return $SHONiR_Data;

    }

if(SHONiR_SETTINGS['config_sef'] == "TRUE"){

    if($SHONiR_Mode == "Basic"){

    $SHONiR_Data = SHONiR_BASE.'Products/'.$SHONiR_ID.'_'.$SHONiR_Slug;

    }else{

        $SHONiR_Data = SHONiR_BASE.'Ajax/Category-Quick-View/'.$SHONiR_ID.'_'.$SHONiR_Slug;

    }

}else{

    $SHONiR_Data = SHONiR_BASE.'index.php?id='.$SHONiR_ID.'&type=Categories&mode='.$SHONiR_Mode;


}

return $SHONiR_Data;

}

function SHONiR_Categories_Menu_Fnc($SHONiR_Array, $SHONiR_Level=1){

    $SHONiR_Data ='';
    $SHONiR_Level++;

    if($SHONiR_Array){

    foreach ($SHONiR_Array as $Array_key => $Array_value)
    {
        $SHONiR_LI_Class =    '';
        $SHONiR_Href_Class =    '';

        if(isset($Array_value['child'])){

            if($SHONiR_Level==1)
            {
                
                $SHONiR_LI_Class =    'nav-item dropdown';
                $SHONiR_Href_Class =    'nav-link';

            }else{

                $SHONiR_LI_Class =    'dropdown-submenu';
                $SHONiR_Href_Class =    'dropdown-item';


            }

            $SHONiR_Data .= '<li class="'.$SHONiR_LI_Class.'">';
            $SHONiR_Data .= '<a id="dropdownMenu'.$SHONiR_Level.'" href="'.SHONiR_Category_Href_Fnc($Array_value['category_id'], $Array_value['slug']).'" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" class="'.$SHONiR_Href_Class.' dropdown-toggle">'.$Array_value['name'].'</a>';
            $SHONiR_Data .= '<ul aria-labelledby="dropdownMenu'.$SHONiR_Level.'" class="dropdown-menu border-0 shadow">';
            $SHONiR_Data .= SHONiR_Categories_Menu_Fnc($Array_value['child'], $SHONiR_Level);
            $SHONiR_Data .= '</li>';
            $SHONiR_Data .= '</ul>';

        }else{

            if($SHONiR_Level==1)
            {
                
                $SHONiR_LI_Class =    'nav-item';
                $SHONiR_Href_Class =    'nav-link';

            }else{

                $SHONiR_LI_Class =    '';
                $SHONiR_Href_Class =    'dropdown-item';


            }

            $SHONiR_Data .= '<li class="'.$SHONiR_LI_Class.'"><a href="'.SHONiR_Category_Href_Fnc($Array_value['category_id'], $Array_value['slug']).'" class="'.$SHONiR_Href_Class.'">'.$Array_value['name'].'</a></li>';

        }
        
    }

}

    return $SHONiR_Data;

}


function SHONiR_Categories_Tree_Fnc($SHONiR_ID =  0, $SHONiR_Where = '', $SHONiR_Language_ID){

    $SHONiR_Data = array();

    $SHONiR_Extra = '';

    if($SHONiR_Where){

        $SHONiR_Extra = $SHONiR_Where." and ";

    }

    if($SHONiR_ID){        
        
        $SHONiR_Query_Categories = SHONiR_Query_Fnc("select c.category_id from tbl_categories c left join tbl_categories_to_categories ctc on c.category_id=ctc.category_id where ".$SHONiR_Extra." ctc.parent_id=".$SHONiR_ID." order by c.sort_order asc;");

    }else{

        $SHONiR_Query_Categories = SHONiR_Query_Fnc("select c.category_id from tbl_categories c left join tbl_categories_to_categories ctc on c.category_id=ctc.category_id where  ".$SHONiR_Extra."  ctc.category_id is null order by c.sort_order asc;");

    }

    $SHONiR_Row_Categories = SHONiR_Row_Fnc($SHONiR_Query_Categories);

    if($SHONiR_Row_Categories > 0 ){  

        while($row =  SHONiR_Fetch_Fnc($SHONiR_Query_Categories))
{        

        if(SHONiR_Has_Sub_Fnc($row['category_id'])){

            $SHONiR_Child['child'] = SHONiR_Categories_Tree_Fnc($row['category_id'], $SHONiR_Where, $SHONiR_Language_ID);            
            $SHONiR_Parent = SHONiR_Category_Details_Fnc($row['category_id'], '', $SHONiR_Language_ID);

            $SHONiR_Data[] = array_merge($SHONiR_Parent,$SHONiR_Child);

        }else{
            
            $SHONiR_Parent = SHONiR_Category_Details_Fnc($row['category_id'], '', $SHONiR_Language_ID);
            $SHONiR_Data[]  =  $SHONiR_Parent;
            
        }


}
    
    }else{

        return 0;

    }
    
return $SHONiR_Data;

}

function SHONiR_Has_Sub_Fnc($SHONiR_ID){

    $SHONiR_Query_Categories = SHONiR_Query_Fnc("select c.category_id from tbl_categories c left join tbl_categories_to_categories ctc on c.category_id=ctc.parent_id where ctc.parent_id=".$SHONiR_ID);

    return SHONiR_Row_Fnc($SHONiR_Query_Categories);

}

function SHONiR_Category_Details_Fnc($SHONiR_ID, $SHONiR_Where, $SHONiR_Language_ID){

    $SHONiR_Data = array();

    if(!$SHONiR_ID){

        return false;

    }

    $SHONiR_Get_Category = SHONiR_Get_Category_Fnc($SHONiR_ID, $SHONiR_Where);

            if(!$SHONiR_Get_Category){

                return false;
    
               }


     $SHONiR_Get_Category_Description = SHONiR_Category_Description_Fnc($SHONiR_ID, $SHONiR_Language_ID);

     $SHONiR_Category_Uploads = SHONiR_Uploads_Fnc($SHONiR_ID, 'category');

     if($SHONiR_Category_Uploads){

        $SHONiR_Data['image'] = $SHONiR_Category_Uploads[0]['upload_file'];

     }else{

        $SHONiR_Data['image'] = 'n-a.png';

     }

      $SHONiR_Data['uploads'] = $SHONiR_Category_Uploads;

      $SHONiR_Data['href'] =  SHONiR_Category_Href_Fnc($SHONiR_ID, $SHONiR_Get_Category_Description['slug']);

      $SHONiR_Data['qhref'] =  SHONiR_Category_Href_Fnc($SHONiR_ID, $SHONiR_Get_Category_Description['slug'], 'Quick');
     
               
      $SHONiR_Data = array_merge($SHONiR_Get_Category,$SHONiR_Get_Category_Description,$SHONiR_Data);

      return $SHONiR_Data;


}



function SHONiR_Get_Category_Fnc($SHONiR_ID =  null, $SHONiR_Where = null){

    $SHONiR_Data = array();

    if(!$SHONiR_ID){
        $SHONiR_ID =  SHONiR_URI['ID'];
    }

    if($SHONiR_ID ){

        $SHONiR_Query_Category = SHONiR_Query_Fnc("select * from tbl_categories where category_id=".$SHONiR_ID ."");

$SHONiR_Row_Category= SHONiR_Row_Fnc($SHONiR_Query_Category);

if($SHONiR_Row_Category > 0 ){

    $SHONiR_Data = SHONiR_Fetch_Fnc($SHONiR_Query_Category);

}else{
 
    $SHONiR_Data = false;

}
    }else{
     
        $SHONiR_Data = false;

    }
 
return $SHONiR_Data;

}

function SHONiR_Category_Description_Fnc($SHONiR_ID, $SHONiR_Language_ID){

    $SHONiR_Query_Category_Extra = " and language_id=".$SHONiR_Language_ID;

    $SHONiR_Query_Category_description = SHONiR_Query_Fnc("select * from tbl_categories_description where category_id=".$SHONiR_ID." ".$SHONiR_Query_Category_Extra);

    $SHONiR_Row_Category_description = SHONiR_Row_Fnc($SHONiR_Query_Category_description);

    if($SHONiR_Row_Category_description > 0 ){

    $SHONiR_Fetch_Category_description = SHONiR_Fetch_Fnc($SHONiR_Query_Category_description);

    }else{
          
            $SHONiR_Fetch_Category_description = false;

    }

    return $SHONiR_Fetch_Category_description;

}

function SHONiR_Category_Parents_Fnc($SHONiR_ID){

    $SHONiR_Query_Category_Parents = SHONiR_Query_Fnc("select * from tbl_categories_to_categories where category_id=".$SHONiR_ID);

    $SHONiR_Row_Category_Parents = SHONiR_Row_Fnc($SHONiR_Query_Category_Parents);

    if($SHONiR_Row_Category_Parents > 0 ){

        while($SHONiR_Fetch_Category_Parents = SHONiR_Fetch_Fnc($SHONiR_Query_Category_Parents))
        {
            
            $SHONiR_Return[] = $SHONiR_Fetch_Category_Parents['parent_id'];
    
        }

    }else{

        $SHONiR_Return = false;

    }

    return $SHONiR_Return;

}


function SHONiR_AP_Categories_Fnc_Render(){

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
        $SHONiR_featured = SHONiR_Post_Fnc('featured', FILTER_VALIDATE_INT);
        if(!$SHONiR_featured){
            $SHONiR_featured = 0;
        }

   SHONiR_Query_Fnc("insert into tbl_categories (sort_order, status, listed, locked, featured, add_time, edit_time) values (".$SHONiR_sort_order.", ".$SHONiR_status.", ".$SHONiR_listed.", ".$SHONiR_locked.", ".$SHONiR_featured.", ".time().", ".time()." )");

   $SHONiR_category_id = SHONiR_Insert_ID_Fnc();

   $SHONiR_All_Languages = SHONiR_Languages_Fnc(FALSE, 1, 'asc');

   foreach($SHONiR_All_Languages as $language)
{

   SHONiR_Query_Fnc("insert into tbl_categories_description (category_id, language_id, slug, name, description, meta_title, meta_description, meta_keyword) values (".$SHONiR_category_id.", ".$language['language_id'].", '".SHONiR_Slug_Fnc(SHONiR_Post_Fnc('slug_'.$language['language_id']))."', '".SHONiR_Post_Fnc('name_'.$language['language_id'])."', '".SHONiR_Post_Fnc('description_'.$language['language_id'])."', '".SHONiR_Post_Fnc('meta_title_'.$language['language_id'])."', '".SHONiR_Post_Fnc('meta_description_'.$language['language_id'])."', '".SHONiR_Post_Fnc('meta_keyword_'.$language['language_id'])."')");

}

$SHONiR_parent = SHONiR_Post_Fnc('parent');

if($SHONiR_parent){
    
    foreach ($SHONiR_parent as $parent){

        if($parent > 0 ){

            SHONiR_Query_Fnc("insert into tbl_categories_to_categories (category_id, parent_id) values (".$SHONiR_category_id.", ".$parent.")");

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

SHONiR_Query_Fnc("insert into tbl_uploads (upload_file, sort_order, parent_id, parent_type, add_time) values ('".$SHONiR_files_final."', ".$SHONiR_sort_order.", ".$SHONiR_category_id.", 'category', ".time().")");

move_uploaded_file($SHONiR_files["tmp_name"][$i], SHONiR_ROOT.'media/uploads/'.$SHONiR_files_final);

}

}

   $SHONiR_Alert['type'] = 'success';
   $SHONiR_Alert['message'] = 'New category has been added successfully.';
   SHONiR_Session_Write_Fnc('SHONiR_Alert', $SHONiR_Alert);

 SHONiR_Redirect_Fnc(SHONiR_APANEL.'Categories');

}elseif($SHONiR_Second == 'Edit'){

    $SHONiR_Get_category_id = SHONiR_Get_Fnc('category_id');

           if(!$SHONiR_Get_category_id){

            $SHONiR_Alert['type'] = 'error';
        $SHONiR_Alert['message'] = 'Unknown error occurred please try again later.';
        SHONiR_Session_Write_Fnc('SHONiR_Alert', $SHONiR_Alert);
        SHONiR_Redirect_Fnc(SHONiR_APANEL.'Categories');

           }

           $SHONiR_Get_Category_Records = SHONiR_Get_Category_Fnc($SHONiR_Get_category_id);

            if(!$SHONiR_Get_Category_Records){

                $SHONiR_Alert['type'] = 'error';
            $SHONiR_Alert['message'] = 'The requested record was not found.';
            SHONiR_Session_Write_Fnc('SHONiR_Alert', $SHONiR_Alert);
            SHONiR_Redirect_Fnc(SHONiR_APANEL.'Categories');
    
               }


           SHONiR_Query_Fnc("delete from tbl_categories_to_categories where category_id=".$SHONiR_Get_category_id);

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

        $SHONiR_featured = SHONiR_Post_Fnc('featured', FILTER_VALIDATE_INT);
        if(!$SHONiR_featured){
            $SHONiR_featured = 0;
        }

     SHONiR_Query_Fnc("update tbl_categories set sort_order=". $SHONiR_sort_order .", status=". $SHONiR_status .", listed=". $SHONiR_listed .", locked=". $SHONiR_locked .", featured=". $SHONiR_featured .", edit_time =". time() ." where category_id=".$SHONiR_Get_category_id);

     $SHONiR_All_Languages = SHONiR_Languages_Fnc(FALSE, 1, 'asc');

        foreach($SHONiR_All_Languages as $language)
{

    if(SHONiR_Category_Description_Fnc($SHONiR_Get_category_id, $language['language_id'])){


SHONiR_Query_Fnc("update tbl_categories_description set slug='".SHONiR_Slug_Fnc(SHONiR_Post_Fnc('slug_'.$language['language_id']))."',  name='".SHONiR_Post_Fnc('name_'.$language['language_id'])."',  description='".SHONiR_Post_Fnc('description_'.$language['language_id'])."',  meta_title='".SHONiR_Post_Fnc('meta_title_'.$language['language_id'])."',  meta_description='".SHONiR_Post_Fnc('meta_description_'.$language['language_id'])."',  meta_keyword='".SHONiR_Post_Fnc('meta_keyword_'.$language['language_id'])."'  where language_id=".$language['language_id']." and category_id=".$SHONiR_Get_category_id);

    }else{

        SHONiR_Query_Fnc("insert into tbl_categories_description (category_id, language_id, slug, name, description, meta_title, meta_description, meta_keyword) values (".$SHONiR_Get_category_id.", ".$language['language_id'].", '".SHONiR_Slug_Fnc(SHONiR_Post_Fnc('slug_'.$language['language_id']))."', '".SHONiR_Post_Fnc('name_'.$language['language_id'])."', '".SHONiR_Post_Fnc('description_'.$language['language_id'])."', '".SHONiR_Post_Fnc('meta_title_'.$language['language_id'])."', '".SHONiR_Post_Fnc('meta_description_'.$language['language_id'])."', '".SHONiR_Post_Fnc('meta_keyword_'.$language['language_id'])."')");

    }

}

$SHONiR_parent = SHONiR_Post_Fnc('parent');

if($SHONiR_parent){
    
    foreach ($SHONiR_parent as $parent){

        if($parent > 0 ){

            SHONiR_Query_Fnc("insert into tbl_categories_to_categories (category_id, parent_id) values (".$SHONiR_Get_category_id.", ".$parent.")");

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
$SHONiR_Uploads_Records = SHONiR_Uploads_Fnc($SHONiR_Get_category_id, 'category');

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


SHONiR_Query_Fnc("insert into tbl_uploads (upload_file, sort_order, parent_id, parent_type, add_time) values ('".$SHONiR_files_final."', ".$SHONiR_sort_order.", ".$SHONiR_Get_category_id.", 'category', ".time().")");

move_uploaded_file($SHONiR_files["tmp_name"][$i], SHONiR_ROOT.'media/uploads/'.$SHONiR_files_final);

}

}

$SHONiR_Alert['type'] = 'success';
   $SHONiR_Alert['message'] = 'Category has been updated successfully.';
   SHONiR_Session_Write_Fnc('SHONiR_Alert', $SHONiR_Alert);

 SHONiR_Redirect_Fnc(SHONiR_APANEL.'Categories');

}

     }else{

        $SHONiR_Alert['type'] = 'error';
        $SHONiR_Alert['message'] = 'Please make sure your browser has cookies enabled and try again.';
        SHONiR_Session_Write_Fnc('SHONiR_Alert', $SHONiR_Alert);

     }

  }

        if($SHONiR_Second == 'Add'){           

            $SHONiR_Main['meta_title'] = 'Add | Categories | SHONiR Administrator Panel | Created with LOVE by SHONiR';

            $SHONiR_Main['meta_description'] = '';
            
            $SHONiR_Main['meta_keyword'] = '';

            $SHONiR_Main['SHONiR_CSRF'] = SHONiR_CSRF_Fnc('G');

            $SHONiR_Main['SHONiR_Languages'] = SHONiR_Languages_Fnc(FALSE, 1, 'asc');
            
            $SHONiR_Main['SHONiR_Categories'] = SHONiR_Get_Categories_Fnc();

            $GLOBALS['SHONiR_VIEWS_FILE'] = "categories-add";


        }elseif($SHONiR_Second == 'Edit'){

            $SHONiR_Get_category_id = SHONiR_Get_Fnc('category_id');

           if(!$SHONiR_Get_category_id){

            $SHONiR_Alert['type'] = 'error';
        $SHONiR_Alert['message'] = 'Unknown error occurred please try again later.';
        SHONiR_Session_Write_Fnc('SHONiR_Alert', $SHONiR_Alert);
        SHONiR_Redirect_Fnc(SHONiR_APANEL.'Categories');

           }

           $SHONiR_Get_Category_Records = SHONiR_Get_Category_Fnc($SHONiR_Get_category_id);

            if(!$SHONiR_Get_Category_Records){

                $SHONiR_Alert['type'] = 'error';
            $SHONiR_Alert['message'] = 'The requested record was not found.';
            SHONiR_Session_Write_Fnc('SHONiR_Alert', $SHONiR_Alert);
            SHONiR_Redirect_Fnc(SHONiR_APANEL.'Categories');
    
               }
               

            foreach ($SHONiR_Get_Category_Records as $Category_key => $Category_value)
            {

       if(SHONiR_Post_Fnc('SHONiR_CSRF')){

        $SHONiR_Main[$Category_key] = SHONiR_Post_Fnc($Category_key);

       }else{

    $SHONiR_Main[$Category_key] = $Category_value;

       }

            }  

            $SHONiR_Languages_Records = SHONiR_Languages_Fnc(FALSE, 1, 'asc');

            foreach ($SHONiR_Languages_Records as $Languages_value)
            {

                $SHONiR_Category_Description_Records[$Languages_value['language_id']] = SHONiR_Category_Description_Fnc($SHONiR_Get_category_id, $Languages_value['language_id']);

                if(is_array($SHONiR_Category_Description_Records[$Languages_value['language_id']])){

                foreach ($SHONiR_Category_Description_Records[$Languages_value['language_id']] as $Description_key => $Description_value)
            {

                if(SHONiR_Post_Fnc('SHONiR_CSRF')){

                    $SHONiR_Main[$Description_key.'_'.$Languages_value['language_id']] = SHONiR_Post_Fnc($Description_key.'_'.$Languages_value['language_id']);

                }else{

                $SHONiR_Main[$Description_key.'_'.$Languages_value['language_id']] = $Description_value;

                }

            }

        }

            }

            $SHONiR_Uploads_Records = SHONiR_Uploads_Fnc($SHONiR_Get_category_id, 'category');

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

                $SHONiR_Main['SHONiR_Parent'] = SHONiR_Category_Parents_Fnc($SHONiR_Get_category_id);

            }

            $SHONiR_Main['meta_title'] = 'Edit | Categories | SHONiR Administrator Panel | Created with LOVE by SHONiR';

            $SHONiR_Main['meta_description'] = '';
            
            $SHONiR_Main['meta_keyword'] = '';

            $SHONiR_Main['SHONiR_GET_ID'] = $SHONiR_Get_category_id;

            $SHONiR_Main['SHONiR_CSRF'] = SHONiR_CSRF_Fnc('G');

            $SHONiR_Main['SHONiR_Languages'] = $SHONiR_Languages_Records;

            $SHONiR_Main['SHONiR_Categories'] = SHONiR_Get_Categories_Fnc();

            $GLOBALS['SHONiR_VIEWS_FILE'] = "categories-edit";

        }elseif($SHONiR_Second == 'Delete'){

            $SHONiR_Get_category_id = SHONiR_Get_Fnc('category_id');

            if(!$SHONiR_Get_category_id){
 
             $SHONiR_Alert['type'] = 'error';
         $SHONiR_Alert['message'] = 'Unknown error occurred please try again later.';
         SHONiR_Session_Write_Fnc('SHONiR_Alert', $SHONiR_Alert);
         SHONiR_Redirect_Fnc(SHONiR_APANEL.'Categories');
 
            }    

            $SHONiR_Get_Category_Records = SHONiR_Get_Category_Fnc($SHONiR_Get_category_id);

            if(!$SHONiR_Get_Category_Records){

                $SHONiR_Alert['type'] = 'error';
            $SHONiR_Alert['message'] = 'The requested record was not found.';
            SHONiR_Session_Write_Fnc('SHONiR_Alert', $SHONiR_Alert);
            SHONiR_Redirect_Fnc(SHONiR_APANEL.'Categories');
    
               }         

               if($SHONiR_Get_Category_Records['locked']){

                $SHONiR_Alert['type'] = 'error';
            $SHONiR_Alert['message'] = 'Access Denied! You cannot delete this record.';
            SHONiR_Session_Write_Fnc('SHONiR_Alert', $SHONiR_Alert);
            SHONiR_Redirect_Fnc(SHONiR_APANEL.'Categories');
    
               }
               

               $SHONiR_Uploads_Records = SHONiR_Uploads_Fnc($SHONiR_Get_category_id, 'category');
    
               foreach ($SHONiR_Uploads_Records as $Uploads_value)
               {
   
                SHONiR_Query_Fnc("delete from tbl_uploads where upload_id=".$Uploads_value['upload_id']);

             if (file_exists(SHONiR_ROOT.'media/uploads/'.$Uploads_value['upload_file'])) { unlink (SHONiR_ROOT.'media/uploads/'.$Uploads_value['upload_file']); } 
   
               }

               SHONiR_Query_Fnc("delete from tbl_categories_to_categories where category_id=".$SHONiR_Get_category_id);

               SHONiR_Query_Fnc("delete from tbl_categories_description where category_id=".$SHONiR_Get_category_id);

               SHONiR_Query_Fnc("delete from tbl_categories where category_id=".$SHONiR_Get_category_id);

               $SHONiR_Alert['type'] = 'success';
   $SHONiR_Alert['message'] = 'Category has been deleted successfully.';
   SHONiR_Session_Write_Fnc('SHONiR_Alert', $SHONiR_Alert);

 SHONiR_Redirect_Fnc(SHONiR_APANEL.'Categories');


        }else{

            $SHONiR_Main['meta_title'] = 'Categories | SHONiR Administrator Panel | Created with LOVE by SHONiR';

            $SHONiR_Main['meta_description'] = '';
            
            $SHONiR_Main['meta_keyword'] = '';

           $SHONiR_Main['SHONiR_Get_Categories'] = SHONiR_Get_Categories_Fnc();

        }


    $SHONiR_Data["SHONiR_Main"] =  $SHONiR_Main;

return $SHONiR_Data;

}



function SHONiR_Get_Categories_Fnc($SHONiR_Parent = 0, $SHONiR_Where = FALSE, $SHONiR_Order = 'c.sort_order', $SHONiR_By = 'asc', $SHONiR_Limit = FALSE){

    $SHONiR_Data = array();  
    
    $SHONiR_SQL_Categories_Where = '';

    if($SHONiR_Parent){

        $SHONiR_SQL_Categories = "select * from tbl_categories c left join tbl_categories_to_categories ctc on c.category_id=ctc.category_id ";
        
        $SHONiR_SQL_Categories_Where = " where ctc.parent_id=".$SHONiR_Parent;

        if($SHONiR_Where !== FALSE){

            $SHONiR_SQL_Categories_Where .= " and ".$SHONiR_Where;
        
            }

    }else{

    $SHONiR_SQL_Categories = "select * from tbl_categories c" ;

    if($SHONiR_Where !== FALSE){

        $SHONiR_SQL_Categories_Where = " where ".$SHONiR_Where;
    
        }

    }

    
    $SHONiR_SQL_Categories_Limit = '';    

    $SHONiR_SQL_Categories_Sort = " order by ".$SHONiR_Order."  ".$SHONiR_By." ";

    if($SHONiR_Limit !== FALSE){

    $SHONiR_SQL_Categories_Limit = "  limit ".$SHONiR_Limit;

    }

    $SHONiR_Query_Categories = SHONiR_Query_Fnc($SHONiR_SQL_Categories.$SHONiR_SQL_Categories_Where.$SHONiR_SQL_Categories_Sort.$SHONiR_SQL_Categories_Limit);

    $SHONiR_Row_Categories = SHONiR_Row_Fnc($SHONiR_Query_Categories);


    if($SHONiR_Row_Categories > 0 ){  
        
        while($row =  SHONiR_Fetch_Fnc($SHONiR_Query_Categories))
{

    $SHONiR_Category_description = SHONiR_Category_Description_Fnc($row['category_id'], SHONiR_LANGUAGE['language_id']);

    $SHONiR_Category_Uploads = SHONiR_Uploads_Fnc($row['category_id'], 'category');

    if($SHONiR_Category_Uploads){

        $SHONiR_More['image'] = $SHONiR_Category_Uploads[0]['upload_file'];

     }else{

        $SHONiR_More['image'] = 'n-a.png';

     }

     $SHONiR_More['uploads'] = $SHONiR_Category_Uploads;

     
    if($SHONiR_Category_description > 0 ){

    $SHONiR_More['href'] =  SHONiR_Category_Href_Fnc($row['category_id'], $SHONiR_Category_description['slug']);

     $SHONiR_More['qhref'] =  SHONiR_Category_Href_Fnc($row['category_id'], $SHONiR_Category_description['slug'], 'Quick');

        $SHONiR_Data[] = array_merge($row,$SHONiR_Category_description,$SHONiR_More);

    }else{

        $SHONiR_More['href'] =  SHONiR_Category_Href_Fnc($row['category_id'], 'Empty');

     $SHONiR_More['qhref'] =  SHONiR_Category_Href_Fnc($row['category_id'], 'Empty', 'Quick');

        $SHONiR_Data[] = array_merge($row,$SHONiR_More);

    }

    
}

    }else{

        $SHONiR_Data = false;

    }   


    
 
return $SHONiR_Data;

}




?>