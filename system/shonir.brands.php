<?php defined('SHONiR') OR exit('No direct script access allowed');

function SHONiR_Brand_Href_Fnc($SHONiR_ID, $SHONiR_Slug = "None", $SHONiR_Mode = "Basic"){

    $SHONiR_Data = FALSE;

    if(!$SHONiR_ID){

        return $SHONiR_Data;

    }

if(SHONiR_SETTINGS['config_sef'] == "TRUE"){

    if($SHONiR_Mode == "Basic"){

    $SHONiR_Data = SHONiR_BASE.'Brands/'.$SHONiR_ID.'_'.$SHONiR_Slug.'.'.SHONiR_SETTINGS['config_extension'];

    }else{

        $SHONiR_Data = SHONiR_BASE.'Ajax/Brand-Quick-View/'.$SHONiR_ID.'_'.$SHONiR_Slug.'.'.SHONiR_SETTINGS['config_extension'];

    }

}else{

    $SHONiR_Data = SHONiR_BASE.'index.php?id='.$SHONiR_ID.'&type=brands&mode='.$SHONiR_Mode;


}

return $SHONiR_Data;

}


function SHONiR_Brand_Details_Fnc($SHONiR_ID, $SHONiR_Where='', $SHONiR_Language_ID=SHONiR_LANGUAGE['language_id']){

    $SHONiR_Data = array();

    if(!$SHONiR_ID){

        return false;

    }

    $SHONiR_Get_Brand = SHONiR_Get_Brand_Fnc($SHONiR_ID, $SHONiR_Where);

            if(!$SHONiR_Get_Brand){

                return false;
    
               }


     $SHONiR_Get_Brand_Description = SHONiR_Brand_Description_Fnc($SHONiR_ID, $SHONiR_Language_ID);

     $SHONiR_Brand_Uploads = SHONiR_Uploads_Fnc($SHONiR_ID, 'brand');

     if($SHONiR_Brand_Uploads){

        $SHONiR_Data['image'] = $SHONiR_Brand_Uploads[0]['upload_file'];

     }else{

        $SHONiR_Data['image'] = 'n-a.png';

     }

      $SHONiR_Data['uploads'] = $SHONiR_Brand_Uploads;

      $SHONiR_Data['href'] =  SHONiR_Brand_Href_Fnc($SHONiR_ID, $SHONiR_Get_Brand_Description['slug']);

      $SHONiR_Data['qhref'] =  SHONiR_Brand_Href_Fnc($SHONiR_ID, $SHONiR_Get_Brand_Description['slug'], 'Quick');
      
               
      $SHONiR_Data = array_merge($SHONiR_Get_Brand,$SHONiR_Get_Brand_Description,$SHONiR_Data);

      return $SHONiR_Data;


}

function SHONiR_Get_Brand_Fnc($SHONiR_ID =  null, $SHONiR_Where = null){

    $SHONiR_Data = array();

    if(!$SHONiR_ID){
        $SHONiR_ID =  SHONiR_URI['ID'];
    }

    if($SHONiR_ID ){

        $SHONiR_Query_Brand = SHONiR_Query_Fnc("select * from tbl_brands where brand_id=".$SHONiR_ID ."");

$SHONiR_Row_Brand= SHONiR_Row_Fnc($SHONiR_Query_Brand);

if($SHONiR_Row_Brand > 0 ){

    $SHONiR_Data = SHONiR_Fetch_Fnc($SHONiR_Query_Brand);

}else{
 
    $SHONiR_Data = false;

}
    }else{
     
        $SHONiR_Data = false;

    }
 
return $SHONiR_Data;

}

function SHONiR_Brand_Description_Fnc($SHONiR_ID, $SHONiR_Language_ID){

    $SHONiR_Query_Brand_Extra = " and language_id=".$SHONiR_Language_ID;

    $SHONiR_Query_Brand_Description = SHONiR_Query_Fnc("select * from tbl_brands_description where brand_id=".$SHONiR_ID." ".$SHONiR_Query_Brand_Extra);

    $SHONiR_Row_Brand_Description = SHONiR_Row_Fnc($SHONiR_Query_Brand_Description);

    if($SHONiR_Row_Brand_Description > 0 ){

    $SHONiR_Fetch_Brand_Description = SHONiR_Fetch_Fnc($SHONiR_Query_Brand_Description);

    }else{
          
            $SHONiR_Fetch_Brand_Description = false;

    }

    return $SHONiR_Fetch_Brand_Description;

}


function SHONiR_AP_Brands_Fnc_Render(){

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

   SHONiR_Query_Fnc("insert into tbl_brands (sort_order, status, listed, locked, add_time, edit_time) values (".$SHONiR_sort_order.", ".$SHONiR_status.", ".$SHONiR_listed.", ".$SHONiR_locked.", ".time().", ".time()." )");

   $SHONiR_brand_id = SHONiR_Insert_ID_Fnc();

   $SHONiR_All_Languages = SHONiR_Languages_Fnc(FALSE, 1, 'asc');

   foreach($SHONiR_All_Languages as $language)
{

   SHONiR_Query_Fnc("insert into tbl_brands_description (brand_id, language_id, slug, name, description, meta_title, meta_description, meta_keyword) values (".$SHONiR_brand_id.", ".$language['language_id'].", '".SHONiR_Slug_Fnc(SHONiR_Post_Fnc('slug_'.$language['language_id']))."', '".SHONiR_Post_Fnc('name_'.$language['language_id'])."', '".SHONiR_Post_Fnc('description_'.$language['language_id'])."', '".SHONiR_Post_Fnc('meta_title_'.$language['language_id'])."', '".SHONiR_Post_Fnc('meta_description_'.$language['language_id'])."', '".SHONiR_Post_Fnc('meta_keyword_'.$language['language_id'])."')");

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

SHONiR_Query_Fnc("insert into tbl_uploads (upload_file, sort_order, parent_id, parent_type, add_time) values ('".$SHONiR_files_final."', ".$SHONiR_sort_order.", ".$SHONiR_brand_id.", 'brand', ".time().")");

move_uploaded_file($SHONiR_files["tmp_name"][$i], SHONiR_ROOT.'media/uploads/'.$SHONiR_files_final);

}

}

   $SHONiR_Alert['type'] = 'success';
   $SHONiR_Alert['message'] = 'New brand has been added successfully.';
   SHONiR_Session_Write_Fnc('SHONiR_Alert', $SHONiR_Alert);

 SHONiR_Redirect_Fnc(SHONiR_APANEL.'Brands');

}elseif($SHONiR_Second == 'Edit'){

    $SHONiR_Get_brand_id = SHONiR_Get_Fnc('brand_id');

           if(!$SHONiR_Get_brand_id){

            $SHONiR_Alert['type'] = 'error';
        $SHONiR_Alert['message'] = 'Unknown error occurred please try again later.';
        SHONiR_Session_Write_Fnc('SHONiR_Alert', $SHONiR_Alert);
        SHONiR_Redirect_Fnc(SHONiR_APANEL.'Brands');

           }

           $SHONiR_Get_Brand_Records = SHONiR_Get_Brand_Fnc($SHONiR_Get_brand_id);

            if(!$SHONiR_Get_Brand_Records){

                $SHONiR_Alert['type'] = 'error';
            $SHONiR_Alert['message'] = 'The requested record was not found.';
            SHONiR_Session_Write_Fnc('SHONiR_Alert', $SHONiR_Alert);
            SHONiR_Redirect_Fnc(SHONiR_APANEL.'Brands');
    
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

     SHONiR_Query_Fnc("update tbl_brands set sort_order=". $SHONiR_sort_order .", status=". $SHONiR_status .", listed=". $SHONiR_listed .", locked=". $SHONiR_locked .", edit_time =". time() ." where brand_id=".$SHONiR_Get_brand_id);

     $SHONiR_All_Languages = SHONiR_Languages_Fnc(FALSE, 1, 'asc');

        foreach($SHONiR_All_Languages as $language)
{

    if(SHONiR_Brand_Description_Fnc($SHONiR_Get_brand_id, $language['language_id'])){


SHONiR_Query_Fnc("update tbl_brands_description set slug='".SHONiR_Slug_Fnc(SHONiR_Post_Fnc('slug_'.$language['language_id']))."',  name='".SHONiR_Post_Fnc('name_'.$language['language_id'])."',  description='".SHONiR_Post_Fnc('description_'.$language['language_id'])."',  meta_title='".SHONiR_Post_Fnc('meta_title_'.$language['language_id'])."',  meta_description='".SHONiR_Post_Fnc('meta_description_'.$language['language_id'])."',  meta_keyword='".SHONiR_Post_Fnc('meta_keyword_'.$language['language_id'])."'  where language_id=".$language['language_id']." and brand_id=".$SHONiR_Get_brand_id);

    }else{

        SHONiR_Query_Fnc("insert into tbl_brands_description (brand_id, language_id, slug, name, description, meta_title, meta_Description, meta_keyword) values (".$SHONiR_Get_brand_id.", ".$language['language_id'].", '".SHONiR_Slug_Fnc(SHONiR_Post_Fnc('slug_'.$language['language_id']))."', '".SHONiR_Post_Fnc('name_'.$language['language_id'])."', '".SHONiR_Post_Fnc('description_'.$language['language_id'])."', '".SHONiR_Post_Fnc('meta_title_'.$language['language_id'])."', '".SHONiR_Post_Fnc('meta_Description_'.$language['language_id'])."', '".SHONiR_Post_Fnc('meta_keyword_'.$language['language_id'])."')");

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
$SHONiR_Uploads_Records = SHONiR_Uploads_Fnc($SHONiR_Get_brand_id, 'brand');

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


SHONiR_Query_Fnc("insert into tbl_uploads (upload_file, sort_order, parent_id, parent_type, add_time) values ('".$SHONiR_files_final."', ".$SHONiR_sort_order.", ".$SHONiR_Get_brand_id.", 'brand', ".time().")");

move_uploaded_file($SHONiR_files["tmp_name"][$i], SHONiR_ROOT.'media/uploads/'.$SHONiR_files_final);

}

}

$SHONiR_Alert['type'] = 'success';
   $SHONiR_Alert['message'] = 'Brand has been updated successfully.';
   SHONiR_Session_Write_Fnc('SHONiR_Alert', $SHONiR_Alert);

 SHONiR_Redirect_Fnc(SHONiR_APANEL.'Brands');

}

     }else{

        $SHONiR_Alert['type'] = 'error';
        $SHONiR_Alert['message'] = 'Please make sure your browser has cookies enabled and try again.';
        SHONiR_Session_Write_Fnc('SHONiR_Alert', $SHONiR_Alert);

     }

  }

        if($SHONiR_Second == 'Add'){           

            $SHONiR_Main['meta_title'] = 'Add | Brands | SHONiR Administrator Panel | Created with LOVE by SHONiR';

            $SHONiR_Main['meta_description'] = '';
            
            $SHONiR_Main['meta_keyword'] = '';

            $SHONiR_Main['SHONiR_CSRF'] = SHONiR_CSRF_Fnc('G');

            $SHONiR_Main['SHONiR_Languages'] = SHONiR_Languages_Fnc(FALSE, 1, 'asc');
            
            $SHONiR_Main['SHONiR_Brands'] = SHONiR_Get_Brands_Fnc();

            $GLOBALS['SHONiR_VIEWS_FILE'] = "brands-add";


        }elseif($SHONiR_Second == 'Edit'){

            $SHONiR_Get_brand_id = SHONiR_Get_Fnc('brand_id');

           if(!$SHONiR_Get_brand_id){

            $SHONiR_Alert['type'] = 'error';
        $SHONiR_Alert['message'] = 'Unknown error occurred please try again later.';
        SHONiR_Session_Write_Fnc('SHONiR_Alert', $SHONiR_Alert);
        SHONiR_Redirect_Fnc(SHONiR_APANEL.'Brands');

           }

           $SHONiR_Get_Brand_Records = SHONiR_Get_Brand_Fnc($SHONiR_Get_brand_id);

            if(!$SHONiR_Get_Brand_Records){

                $SHONiR_Alert['type'] = 'error';
            $SHONiR_Alert['message'] = 'The requested record was not found.';
            SHONiR_Session_Write_Fnc('SHONiR_Alert', $SHONiR_Alert);
            SHONiR_Redirect_Fnc(SHONiR_APANEL.'Brands');
    
               }
               

            foreach ($SHONiR_Get_Brand_Records as $Brand_key => $Brand_value)
            {

       if(SHONiR_Post_Fnc('SHONiR_CSRF')){

        $SHONiR_Main[$Brand_key] = SHONiR_Post_Fnc($Brand_key);

       }else{

    $SHONiR_Main[$Brand_key] = $Brand_value;

       }

            }  

            $SHONiR_Languages_Records = SHONiR_Languages_Fnc(FALSE, 1, 'asc');

            foreach ($SHONiR_Languages_Records as $Languages_value)
            {

                $SHONiR_Brand_Description_Records[$Languages_value['language_id']] = SHONiR_Brand_Description_Fnc($SHONiR_Get_brand_id, $Languages_value['language_id']);

                if(is_array($SHONiR_Brand_Description_Records[$Languages_value['language_id']])){

                foreach ($SHONiR_Brand_Description_Records[$Languages_value['language_id']] as $Description_key => $Description_value)
            {

                if(SHONiR_Post_Fnc('SHONiR_CSRF')){

                    $SHONiR_Main[$Description_key.'_'.$Languages_value['language_id']] = SHONiR_Post_Fnc($Description_key.'_'.$Languages_value['language_id']);

                }else{

                $SHONiR_Main[$Description_key.'_'.$Languages_value['language_id']] = $Description_value;

                }

            }

        }

            }

            $SHONiR_Uploads_Records = SHONiR_Uploads_Fnc($SHONiR_Get_brand_id, 'brand');

            $SHONiR_Main['uploads'] = $SHONiR_Uploads_Records;

            $SHONiR_files_sort_order='';
 
            foreach ($SHONiR_Uploads_Records as $Uploads_value)
            {

            $SHONiR_files_sort_order .= $Uploads_value['upload_file'].'='.$Uploads_value['sort_order'].',';

            }

            $SHONiR_Main['files_sort_order'] = $SHONiR_files_sort_order;
                

            $SHONiR_Main['meta_title'] = 'Edit | Brands | SHONiR Administrator Panel | Created with LOVE by SHONiR';

            $SHONiR_Main['meta_description'] = '';
            
            $SHONiR_Main['meta_keyword'] = '';

            $SHONiR_Main['SHONiR_GET_ID'] = $SHONiR_Get_brand_id;

            $SHONiR_Main['SHONiR_CSRF'] = SHONiR_CSRF_Fnc('G');

            $SHONiR_Main['SHONiR_Languages'] = $SHONiR_Languages_Records;

            $GLOBALS['SHONiR_VIEWS_FILE'] = "brands-edit";

        }elseif($SHONiR_Second == 'Delete'){

            $SHONiR_Get_brand_id = SHONiR_Get_Fnc('brand_id');

            if(!$SHONiR_Get_brand_id){
 
             $SHONiR_Alert['type'] = 'error';
         $SHONiR_Alert['message'] = 'Unknown error occurred please try again later.';
         SHONiR_Session_Write_Fnc('SHONiR_Alert', $SHONiR_Alert);
         SHONiR_Redirect_Fnc(SHONiR_APANEL.'Brands');
 
            }    

            $SHONiR_Get_Brand_Records = SHONiR_Get_Brand_Fnc($SHONiR_Get_brand_id);

            if(!$SHONiR_Get_Brand_Records){

                $SHONiR_Alert['type'] = 'error';
            $SHONiR_Alert['message'] = 'The requested record was not found.';
            SHONiR_Session_Write_Fnc('SHONiR_Alert', $SHONiR_Alert);
            SHONiR_Redirect_Fnc(SHONiR_APANEL.'Brands');
    
               }         
               
               if($SHONiR_Get_Brand_Records['locked']){

                $SHONiR_Alert['type'] = 'error';
            $SHONiR_Alert['message'] = 'Access Denied! You cannot delete this record.';
            SHONiR_Session_Write_Fnc('SHONiR_Alert', $SHONiR_Alert);
            SHONiR_Redirect_Fnc(SHONiR_APANEL.'Brands');
    
               }

               $SHONiR_Uploads_Records = SHONiR_Uploads_Fnc($SHONiR_Get_brand_id, 'brand');
    
               foreach ($SHONiR_Uploads_Records as $Uploads_value)
               {
   
                SHONiR_Query_Fnc("delete from tbl_uploads where upload_id=".$Uploads_value['upload_id']);

             if (file_exists(SHONiR_ROOT.'media/uploads/'.$Uploads_value['upload_file'])) { unlink (SHONiR_ROOT.'media/uploads/'.$Uploads_value['upload_file']); } 
   
               }


               SHONiR_Query_Fnc("delete from tbl_brands_description where brand_id=".$SHONiR_Get_brand_id);

               SHONiR_Query_Fnc("delete from tbl_brands where brand_id=".$SHONiR_Get_brand_id);

               $SHONiR_Alert['type'] = 'success';
   $SHONiR_Alert['message'] = 'Brand has been deleted successfully.';
   SHONiR_Session_Write_Fnc('SHONiR_Alert', $SHONiR_Alert);

 SHONiR_Redirect_Fnc(SHONiR_APANEL.'Brands');


        }else{

            $SHONiR_Main['meta_title'] = 'Brands | SHONiR Administrator Panel | Created with LOVE by SHONiR';

            $SHONiR_Main['meta_description'] = '';
            
            $SHONiR_Main['meta_keyword'] = '';

          $SHONiR_Main['SHONiR_Get_Brands'] = SHONiR_Get_Brands_Fnc();

        }


    $SHONiR_Data["SHONiR_Main"] =  $SHONiR_Main;

    

return $SHONiR_Data;

}



function SHONiR_Get_Brands_Fnc($SHONiR_Parent = 0, $SHONiR_Where = FALSE, $SHONiR_Order = 'b.sort_order', $SHONiR_By = 'asc', $SHONiR_Limit = FALSE){

    $SHONiR_Data = array();  
    
    $SHONiR_SQL_Brands_Where = '';


    $SHONiR_SQL_Brands = "select * from tbl_brands b" ;

    if($SHONiR_Where !== FALSE){

        $SHONiR_SQL_Brands_Where = " where ".$SHONiR_Where;
    
        }

    
    $SHONiR_SQL_Brands_Limit = '';    

    $SHONiR_SQL_Brands_Sort = " order by ".$SHONiR_Order."  ".$SHONiR_By." ";

    if($SHONiR_Limit !== FALSE){

    $SHONiR_SQL_Brands_Limit = "  limit ".$SHONiR_Limit;

    }

    $SHONiR_Query_Brands = SHONiR_Query_Fnc($SHONiR_SQL_Brands.$SHONiR_SQL_Brands_Where.$SHONiR_SQL_Brands_Sort.$SHONiR_SQL_Brands_Limit);

    $SHONiR_Row_Brands = SHONiR_Row_Fnc($SHONiR_Query_Brands);


    if($SHONiR_Row_Brands > 0 ){  
        
        while($row =  SHONiR_Fetch_Fnc($SHONiR_Query_Brands))
{

    $SHONiR_Brand_description = SHONiR_Brand_Description_Fnc($row['brand_id'], SHONiR_LANGUAGE['language_id']);

    $SHONiR_Brand_Uploads = SHONiR_Uploads_Fnc($row['brand_id'], 'brand');

    if($SHONiR_Brand_Uploads){

        $SHONiR_More['image'] = $SHONiR_Brand_Uploads[0]['upload_file'];

     }else{

        $SHONiR_More['image'] = 'n-a.png';

     }

     $SHONiR_More['uploads'] = $SHONiR_Brand_Uploads;


    if($SHONiR_Brand_description > 0 ){

        $SHONiR_More['href'] =  SHONiR_Brand_Href_Fnc($row['brand_id'], $SHONiR_Brand_description['slug']);

      $SHONiR_More['qhref'] =  SHONiR_Brand_Href_Fnc($row['brand_id'], $SHONiR_Brand_description['slug'], 'Quick');

        $SHONiR_Data[] = array_merge($row,$SHONiR_Brand_description,$SHONiR_More);

    }else{

        $SHONiR_More['href'] =  SHONiR_Brand_Href_Fnc($row['brand_id'], 'Empty');

      $SHONiR_More['qhref'] =  SHONiR_Brand_Href_Fnc($row['brand_id'], 'Empty', 'Quick');
      

        $SHONiR_Data[] = array_merge($row,$SHONiR_More);

    }

    
}

    }else{

        $SHONiR_Data = false;

    }   


    
 
return $SHONiR_Data;

}



function SHONiR_Brands_Fnc_Render(){

    $SHONiR_ID =  SHONiR_URI['ID'];

    $SHONiR_EX =  SHONiR_URI['EX'];

    $SHONiR_Where = "";

    if($SHONiR_EX== SHONiR_SETTINGS['config_extension']){

        if(!$SHONiR_ID){

            $SHONiR_Alert['type'] = 'error';
        $SHONiR_Alert['message'] = 'Unknown error occurred please try again later.';
        SHONiR_Session_Write_Fnc('SHONiR_Alert', $SHONiR_Alert);
        SHONiR_Redirect_Fnc(SHONiR_BASE);

           }

           $SHONiR_Brand_Details = SHONiR_Brand_Details_Fnc($SHONiR_ID, ' and status=1 ', SHONiR_LANGUAGE['language_id']);


           if(!$SHONiR_Brand_Details){

            $SHONiR_Alert['type'] = 'error';
        $SHONiR_Alert['message'] = 'The requested record was not found.';
        SHONiR_Session_Write_Fnc('SHONiR_Alert', $SHONiR_Alert);
        SHONiR_Redirect_Fnc(SHONiR_BASE);

           }

           $SHONiR_Main['SHONiR_Brand_Details'] = $SHONiR_Brand_Details;

           $SHONiR_Main['meta_title'] = $SHONiR_Brand_Details['meta_title'];

    $SHONiR_Main['meta_description'] = $SHONiR_Brand_Details['meta_description'];
    
    $SHONiR_Main['meta_keyword'] = $SHONiR_Brand_Details['meta_keyword'];

    $SHONiR_Data["Related_Products"] = SHONiR_Get_Products_Fnc(TRUE, $SHONiR_Product_Parents, "p.status=1 and p.listed=1 and p.brand_id=".$SHONiR_ID, "p.viewed", "asc", SHONiR_SETTINGS['config_records_limit']);

    $GLOBALS['SHONiR_VIEWS_FILE'] = 'brand_details';

    }else{


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

        $SHONiR_Where = "b.status=1 and b.listed=1";


        $SHONiR_Query = SHONiR_Get_Brands_Fnc($SHONiR_ID,  $SHONiR_Where, 'b.'.$SHONiR_Order, $SHONiR_By, FALSE);


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

        $SHONiR_Query_Pagination = SHONiR_Get_Brands_Fnc($SHONiR_ID,  $SHONiR_Where, 'b.'.$SHONiR_Order, $SHONiR_By, $SHONiR_SQL_Pagination_Limit);          

    if($SHONiR_Query_Pagination){
        $SHONiR_Row_Pagination = count($SHONiR_Query_Pagination);
        }else{
            $SHONiR_Row_Pagination = 0;
        }

        if($SHONiR_Row_Pagination > 0 ){   

            $SHONiR_Rows = $SHONiR_Query_Pagination;
        
            $SHONiR_Page = SHONiR_BASE.'Brands?o='.$SHONiR_Order.'&b='.$SHONiR_By.'&';
        
            $SHONiR_Style = 'float-right';
        
            $SHONiR_Main['SHONiR_Brands'] =  SHONiR_Pagination_Fnc($SHONiR_Page_No, $SHONiR_Records_Limit, $SHONiR_Total_Pages, $SHONiR_Total_Records, $SHONiR_Start, $SHONiR_Row_Pagination, $SHONiR_Rows, $SHONiR_Page, True, True, $SHONiR_Style);
        
            }else{
        
              $SHONiR_Main['SHONiR_Brands'] = false;
        
            }

            $SHONiR_Main['meta_title'] = 'Our Brands Categories';

    $SHONiR_Main['meta_description'] = '';
    
    $SHONiR_Main['meta_keyword'] = '';

    $SHONiR_Main['heading'] = 'Our Brands Categories';
        

    }


    $SHONiR_Data["Categories_Tree"] = SHONiR_Categories_Tree_Fnc(0, 'c.status=1 and c.listed=1', SHONiR_LANGUAGE['language_id']);

    $SHONiR_Data["Pages_Tree"] = SHONiR_Pages_Tree_Fnc(0, 'p.status=1 and p.listed=1', SHONiR_LANGUAGE['language_id']);

    $SHONiR_Data["Recently_Viewed_Products"] = SHONiR_Get_Products_Fnc(TRUE, 0, "p.status=1 and p.listed=1", "p.last_hit", "desc", SHONiR_SETTINGS['config_records_limit']);

    $SHONiR_Data["SHONiR_Main"] =  $SHONiR_Main;

    return $SHONiR_Data;

    print_r($SHONiR_Query);exit;

}

?>