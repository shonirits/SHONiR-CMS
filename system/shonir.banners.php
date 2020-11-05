<?php defined('SHONiR') OR exit('No direct script access allowed');

function SHONiR_Banner_Details_Fnc($SHONiR_ID, $SHONiR_Where='', $SHONiR_Language_ID=SHONiR_LANGUAGE['language_id']){

    $SHONiR_Data = array();

    if(!$SHONiR_ID){

        return false;

    }

    $SHONiR_Get_Banner = SHONiR_Get_Banner_Fnc($SHONiR_ID, $SHONiR_Where);

            if(!$SHONiR_Get_Banner){

                return false;
    
               }


     $SHONiR_Get_Banner_Description = SHONiR_Banner_Description_Fnc($SHONiR_ID, $SHONiR_Language_ID);

     $SHONiR_Banner_Uploads = SHONiR_Uploads_Fnc($SHONiR_ID, 'banner');

     if($SHONiR_Banner_Uploads){

        $SHONiR_Data['image'] = $SHONiR_Banner_Uploads[0]['upload_file'];

     }else{

        $SHONiR_Data['image'] = 'n-a.png';

     }

      $SHONiR_Data['uploads'] = $SHONiR_Banner_Uploads;      
               
      $SHONiR_Data = array_merge($SHONiR_Get_Banner,$SHONiR_Get_Banner_Description,$SHONiR_Data);

      return $SHONiR_Data;


}

function SHONiR_Get_Banner_Fnc($SHONiR_ID =  null, $SHONiR_Where = null){

    $SHONiR_Data = array();

    if(!$SHONiR_ID){
        $SHONiR_ID =  SHONiR_URI['ID'];
    }

    if($SHONiR_ID ){

        $SHONiR_Query_Banner = SHONiR_Query_Fnc("select * from tbl_banners where banner_id=".$SHONiR_ID ."");

$SHONiR_Row_Banner= SHONiR_Row_Fnc($SHONiR_Query_Banner);

if($SHONiR_Row_Banner > 0 ){

    $SHONiR_Data = SHONiR_Fetch_Fnc($SHONiR_Query_Banner);

}else{
 
    $SHONiR_Data = false;

}
    }else{
     
        $SHONiR_Data = false;

    }
 
return $SHONiR_Data;

}

function SHONiR_Banner_Description_Fnc($SHONiR_ID, $SHONiR_Language_ID){

    $SHONiR_Query_Banner_Extra = " and language_id=".$SHONiR_Language_ID;

    $SHONiR_Query_Banner_Description = SHONiR_Query_Fnc("select * from tbl_banners_description where banner_id=".$SHONiR_ID." ".$SHONiR_Query_Banner_Extra);

    $SHONiR_Row_Banner_Description = SHONiR_Row_Fnc($SHONiR_Query_Banner_Description);

    if($SHONiR_Row_Banner_Description > 0 ){

    $SHONiR_Fetch_Banner_Description = SHONiR_Fetch_Fnc($SHONiR_Query_Banner_Description);

    }else{
          
            $SHONiR_Fetch_Banner_Description = false;

    }

    return $SHONiR_Fetch_Banner_Description;

}


function SHONiR_AP_Banners_Fnc_Render(){

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

        $SHONiR_parent_id = SHONiR_Post_Fnc('parent_id');
        if(!$SHONiR_parent_id){
            $SHONiR_parent_id = 0;
        }

        $SHONiR_link = SHONiR_Post_Fnc('link');    

   SHONiR_Query_Fnc("insert into tbl_banners (parent_id, link, sort_order, status, listed, locked, add_time, edit_time) values ('".$SHONiR_parent_id."', '".$SHONiR_link."', ".$SHONiR_sort_order.", ".$SHONiR_status.", ".$SHONiR_listed.", ".$SHONiR_locked.", ".time().", ".time()." )");

   $SHONiR_banner_id = SHONiR_Insert_ID_Fnc();

   $SHONiR_All_Languages = SHONiR_Languages_Fnc(FALSE, 1, 'asc');

   foreach($SHONiR_All_Languages as $language)
{

   SHONiR_Query_Fnc("insert into tbl_banners_description (banner_id, language_id, slug, name, description, meta_title, meta_description, meta_keyword) values (".$SHONiR_banner_id.", ".$language['language_id'].", '".SHONiR_Slug_Fnc(SHONiR_Post_Fnc('slug_'.$language['language_id']))."', '".SHONiR_Post_Fnc('name_'.$language['language_id'])."', '".SHONiR_Post_Fnc('description_'.$language['language_id'])."', '".SHONiR_Post_Fnc('meta_title_'.$language['language_id'])."', '".SHONiR_Post_Fnc('meta_description_'.$language['language_id'])."', '".SHONiR_Post_Fnc('meta_keyword_'.$language['language_id'])."')");

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

SHONiR_Query_Fnc("insert into tbl_uploads (upload_file, sort_order, parent_id, parent_type, add_time) values ('".$SHONiR_files_final."', ".$SHONiR_sort_order.", ".$SHONiR_banner_id.", 'banner', ".time().")");

move_uploaded_file($SHONiR_files["tmp_name"][$i], SHONiR_ROOT.'media/uploads/'.$SHONiR_files_final);

}

}

   $SHONiR_Alert['type'] = 'success';
   $SHONiR_Alert['message'] = 'New Banner has been added successfully.';
   SHONiR_Session_Write_Fnc('SHONiR_Alert', $SHONiR_Alert);

 SHONiR_Redirect_Fnc(SHONiR_APANEL.'Banners');

}elseif($SHONiR_Second == 'Edit'){

    $SHONiR_Get_banner_id = SHONiR_Get_Fnc('banner_id');

           if(!$SHONiR_Get_banner_id){

            $SHONiR_Alert['type'] = 'error';
        $SHONiR_Alert['message'] = 'Unknown error occurred please try again later.';
        SHONiR_Session_Write_Fnc('SHONiR_Alert', $SHONiR_Alert);
        SHONiR_Redirect_Fnc(SHONiR_APANEL.'Banners');

           }

           $SHONiR_Get_Banner_Records = SHONiR_Get_Banner_Fnc($SHONiR_Get_banner_id);

            if(!$SHONiR_Get_Banner_Records){

                $SHONiR_Alert['type'] = 'error';
            $SHONiR_Alert['message'] = 'The requested record was not found.';
            SHONiR_Session_Write_Fnc('SHONiR_Alert', $SHONiR_Alert);
            SHONiR_Redirect_Fnc(SHONiR_APANEL.'Banners');
    
               }

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

        $SHONiR_parent_id = SHONiR_Post_Fnc('parent_id');
        if(!$SHONiR_parent_id){
            $SHONiR_parent_id = 0;
        }

        $SHONiR_link = SHONiR_Post_Fnc('link');

     SHONiR_Query_Fnc("update tbl_banners set parent_id='". $SHONiR_parent_id ."', link='". $SHONiR_link ."',  sort_order=". $SHONiR_sort_order .", status=". $SHONiR_status .", listed=". $SHONiR_listed .", locked=". $SHONiR_locked .", edit_time =". time() ." where banner_id=".$SHONiR_Get_banner_id);

     $SHONiR_All_Languages = SHONiR_Languages_Fnc(FALSE, 1, 'asc');

        foreach($SHONiR_All_Languages as $language)
{

    if(SHONiR_Banner_Description_Fnc($SHONiR_Get_banner_id, $language['language_id'])){


SHONiR_Query_Fnc("update tbl_banners_description set slug='".SHONiR_Slug_Fnc(SHONiR_Post_Fnc('slug_'.$language['language_id']))."',  name='".SHONiR_Post_Fnc('name_'.$language['language_id'])."',  description='".SHONiR_Post_Fnc('description_'.$language['language_id'])."',  meta_title='".SHONiR_Post_Fnc('meta_title_'.$language['language_id'])."',  meta_description='".SHONiR_Post_Fnc('meta_description_'.$language['language_id'])."',  meta_keyword='".SHONiR_Post_Fnc('meta_keyword_'.$language['language_id'])."'  where language_id=".$language['language_id']." and banner_id=".$SHONiR_Get_banner_id);

    }else{

        SHONiR_Query_Fnc("insert into tbl_banners_description (banner_id, language_id, slug, name, description, meta_title, meta_Description, meta_keyword) values (".$SHONiR_Get_banner_id.", ".$language['language_id'].", '".SHONiR_Slug_Fnc(SHONiR_Post_Fnc('slug_'.$language['language_id']))."', '".SHONiR_Post_Fnc('name_'.$language['language_id'])."', '".SHONiR_Post_Fnc('description_'.$language['language_id'])."', '".SHONiR_Post_Fnc('meta_title_'.$language['language_id'])."', '".SHONiR_Post_Fnc('meta_Description_'.$language['language_id'])."', '".SHONiR_Post_Fnc('meta_keyword_'.$language['language_id'])."')");

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
$SHONiR_Uploads_Records = SHONiR_Uploads_Fnc($SHONiR_Get_banner_id, 'banner');

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


SHONiR_Query_Fnc("insert into tbl_uploads (upload_file, sort_order, parent_id, parent_type, add_time) values ('".$SHONiR_files_final."', ".$SHONiR_sort_order.", ".$SHONiR_Get_banner_id.", 'banner', ".time().")");

move_uploaded_file($SHONiR_files["tmp_name"][$i], SHONiR_ROOT.'media/uploads/'.$SHONiR_files_final);

}

}

$SHONiR_Alert['type'] = 'success';
   $SHONiR_Alert['message'] = 'Banner has been updated successfully.';
   SHONiR_Session_Write_Fnc('SHONiR_Alert', $SHONiR_Alert);

 SHONiR_Redirect_Fnc(SHONiR_APANEL.'Banners');

}

     }else{

        $SHONiR_Alert['type'] = 'error';
        $SHONiR_Alert['message'] = 'Please make sure your browser has cookies enabled and try again.';
        SHONiR_Session_Write_Fnc('SHONiR_Alert', $SHONiR_Alert);

     }

  }

        if($SHONiR_Second == 'Add'){           

            $SHONiR_Main['meta_title'] = 'Add | Banners | SHONiR Administrator Panel | Created with LOVE by SHONiR';

            $SHONiR_Main['meta_description'] = '';
            
            $SHONiR_Main['meta_keyword'] = '';

            $SHONiR_Main['SHONiR_CSRF'] = SHONiR_CSRF_Fnc('G');

            $SHONiR_Main['SHONiR_Languages'] = SHONiR_Languages_Fnc(FALSE, 1, 'asc');
            
            $GLOBALS['SHONiR_VIEWS_FILE'] = "banners-add";

        }elseif($SHONiR_Second == 'Edit'){

            $SHONiR_Get_banner_id = SHONiR_Get_Fnc('banner_id');

           if(!$SHONiR_Get_banner_id){

            $SHONiR_Alert['type'] = 'error';
        $SHONiR_Alert['message'] = 'Unknown error occurred please try again later.';
        SHONiR_Session_Write_Fnc('SHONiR_Alert', $SHONiR_Alert);
        SHONiR_Redirect_Fnc(SHONiR_APANEL.'Banners');

           }

           $SHONiR_Get_Banner_Records = SHONiR_Get_Banner_Fnc($SHONiR_Get_banner_id);

            if(!$SHONiR_Get_Banner_Records){

                $SHONiR_Alert['type'] = 'error';
            $SHONiR_Alert['message'] = 'The requested record was not found.';
            SHONiR_Session_Write_Fnc('SHONiR_Alert', $SHONiR_Alert);
            SHONiR_Redirect_Fnc(SHONiR_APANEL.'Banners');
    
               }
               

            foreach ($SHONiR_Get_Banner_Records as $Banner_key => $Banner_value)
            {

       if(SHONiR_Post_Fnc('SHONiR_CSRF')){

        $SHONiR_Main[$Banner_key] = SHONiR_Post_Fnc($Banner_key);

       }else{

    $SHONiR_Main[$Banner_key] = $Banner_value;

       }

            }  

            $SHONiR_Languages_Records = SHONiR_Languages_Fnc(FALSE, 1, 'asc');

            foreach ($SHONiR_Languages_Records as $Languages_value)
            {

                $SHONiR_Banner_Description_Records[$Languages_value['language_id']] = SHONiR_Banner_Description_Fnc($SHONiR_Get_banner_id, $Languages_value['language_id']);

                if(is_array($SHONiR_Banner_Description_Records[$Languages_value['language_id']])){

                foreach ($SHONiR_Banner_Description_Records[$Languages_value['language_id']] as $Description_key => $Description_value)
            {

                if(SHONiR_Post_Fnc('SHONiR_CSRF')){

                    $SHONiR_Main[$Description_key.'_'.$Languages_value['language_id']] = SHONiR_Post_Fnc($Description_key.'_'.$Languages_value['language_id']);

                }else{

                $SHONiR_Main[$Description_key.'_'.$Languages_value['language_id']] = $Description_value;

                }

            }

        }

            }

            $SHONiR_Uploads_Records = SHONiR_Uploads_Fnc($SHONiR_Get_banner_id, 'banner');

            $SHONiR_Main['uploads'] = $SHONiR_Uploads_Records;

            $SHONiR_files_sort_order='';
 
            foreach ($SHONiR_Uploads_Records as $Uploads_value)
            {

            $SHONiR_files_sort_order .= $Uploads_value['upload_file'].'='.$Uploads_value['sort_order'].',';

            }

            $SHONiR_Main['files_sort_order'] = $SHONiR_files_sort_order;
                

            $SHONiR_Main['meta_title'] = 'Edit | Banners | SHONiR Administrator Panel | Created with LOVE by SHONiR';

            $SHONiR_Main['meta_description'] = '';
            
            $SHONiR_Main['meta_keyword'] = '';

            $SHONiR_Main['SHONiR_GET_ID'] = $SHONiR_Get_banner_id;

            $SHONiR_Main['SHONiR_CSRF'] = SHONiR_CSRF_Fnc('G');

            $SHONiR_Main['SHONiR_Languages'] = $SHONiR_Languages_Records;

            $GLOBALS['SHONiR_VIEWS_FILE'] = "banners-edit";

        }elseif($SHONiR_Second == 'Delete'){

            $SHONiR_Get_banner_id = SHONiR_Get_Fnc('banner_id');

            if(!$SHONiR_Get_banner_id){
 
             $SHONiR_Alert['type'] = 'error';
         $SHONiR_Alert['message'] = 'Unknown error occurred please try again later.';
         SHONiR_Session_Write_Fnc('SHONiR_Alert', $SHONiR_Alert);
         SHONiR_Redirect_Fnc(SHONiR_APANEL.'Banners');
 
            }    

            $SHONiR_Get_Banner_Records = SHONiR_Get_Banner_Fnc($SHONiR_Get_banner_id);

            if(!$SHONiR_Get_Banner_Records){

                $SHONiR_Alert['type'] = 'error';
            $SHONiR_Alert['message'] = 'The requested record was not found.';
            SHONiR_Session_Write_Fnc('SHONiR_Alert', $SHONiR_Alert);
            SHONiR_Redirect_Fnc(SHONiR_APANEL.'Banners');
    
               }         
               
               if($SHONiR_Get_Banner_Records['locked']){

                $SHONiR_Alert['type'] = 'error';
            $SHONiR_Alert['message'] = 'Access Denied! You cannot delete this record.';
            SHONiR_Session_Write_Fnc('SHONiR_Alert', $SHONiR_Alert);
            SHONiR_Redirect_Fnc(SHONiR_APANEL.'Banners');
    
               }

               $SHONiR_Uploads_Records = SHONiR_Uploads_Fnc($SHONiR_Get_banner_id, 'banner');
    
               foreach ($SHONiR_Uploads_Records as $Uploads_value)
               {
   
                SHONiR_Query_Fnc("delete from tbl_uploads where upload_id=".$Uploads_value['upload_id']);

             if (file_exists(SHONiR_ROOT.'media/uploads/'.$Uploads_value['upload_file'])) { unlink (SHONiR_ROOT.'media/uploads/'.$Uploads_value['upload_file']); } 
   
               }


               SHONiR_Query_Fnc("delete from tbl_banners_description where banner_id=".$SHONiR_Get_banner_id);

               SHONiR_Query_Fnc("delete from tbl_banners where banner_id=".$SHONiR_Get_banner_id);

               $SHONiR_Alert['type'] = 'success';
   $SHONiR_Alert['message'] = 'Banner has been deleted successfully.';
   SHONiR_Session_Write_Fnc('SHONiR_Alert', $SHONiR_Alert);

 SHONiR_Redirect_Fnc(SHONiR_APANEL.'Banners');


        }else{

            $SHONiR_Main['meta_title'] = 'Banners | SHONiR Administrator Panel | Created with LOVE by SHONiR';

            $SHONiR_Main['meta_description'] = '';
            
            $SHONiR_Main['meta_keyword'] = '';

          $SHONiR_Main['SHONiR_Get_Banners'] = SHONiR_Get_Banners_Fnc();

        }


    $SHONiR_Data["SHONiR_Main"] =  $SHONiR_Main;

    

return $SHONiR_Data;

}



function SHONiR_Get_Banners_Fnc($SHONiR_Viewed = FALSE, $SHONiR_Random = FALSE, $SHONiR_Where = FALSE, $SHONiR_Order = 'b.sort_order', $SHONiR_By = 'asc', $SHONiR_Limit = FALSE){

    $SHONiR_Data = array();  
    
    $SHONiR_SQL_Banners_Where = '';

    $SHONiR_SQL_Banners = "select * from tbl_banners b" ;

    if($SHONiR_Where !== FALSE){

        $SHONiR_SQL_Banners_Where = " where ".$SHONiR_Where;
    
        }

    
    $SHONiR_SQL_Banners_Limit = '';    

    $SHONiR_SQL_Banners_Sort = " order by ".$SHONiR_Order."  ".$SHONiR_By." ";

    if($SHONiR_Random !== FALSE){

        $SHONiR_SQL_Banners_Sort .= ", RAND() ";
    
        }

    if($SHONiR_Limit !== FALSE){

    $SHONiR_SQL_Banners_Limit = "  limit ".$SHONiR_Limit;

    }

    $SHONiR_Query_Banners = SHONiR_Query_Fnc($SHONiR_SQL_Banners.$SHONiR_SQL_Banners_Where.$SHONiR_SQL_Banners_Sort.$SHONiR_SQL_Banners_Limit);

    $SHONiR_Row_Banners = SHONiR_Row_Fnc($SHONiR_Query_Banners);


    if($SHONiR_Row_Banners > 0 ){  
        
        while($row =  SHONiR_Fetch_Fnc($SHONiR_Query_Banners))
{

    if($SHONiR_Viewed){

        SHONiR_Query_Fnc("update tbl_banners set viewed=(viewed+1) where banner_id=".$row['banner_id']);   
    }

    $SHONiR_Banner_description = SHONiR_Banner_Description_Fnc($row['banner_id'], SHONiR_LANGUAGE['language_id']);

    $SHONiR_Banner_Uploads = SHONiR_Uploads_Fnc($row['banner_id'], 'banner');

    if($SHONiR_Banner_Uploads){

        if($SHONiR_Random){

            $SHONiR_X = array_rand($SHONiR_Banner_Uploads);

        }else{

            $SHONiR_X = 0;


        }

        $SHONiR_More['image'] = $SHONiR_Banner_Uploads[$SHONiR_X]['upload_file'];

     }else{

        $SHONiR_More['image'] = 'n-a.png';

     }

     $SHONiR_More['uploads'] = $SHONiR_Banner_Uploads;


    if($SHONiR_Banner_description > 0 ){

        $SHONiR_Data[] = array_merge($row,$SHONiR_Banner_description,$SHONiR_More);

    }else{    

        $SHONiR_Data[] = array_merge($row,$SHONiR_More);

    }

    
}

    }else{

        $SHONiR_Data = false;

    }   


    
 
return $SHONiR_Data;

}



?>