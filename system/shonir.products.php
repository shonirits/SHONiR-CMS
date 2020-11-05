<?php defined('SHONiR') OR exit('No direct script access allowed');

function SHONiR_Product_Href_Fnc($SHONiR_ID, $SHONiR_Slug = "None", $SHONiR_Mode = "Basic"){

    $SHONiR_Data = FALSE;

    if(!$SHONiR_ID){

        return $SHONiR_Data;

    }

if(SHONiR_SETTINGS['config_sef'] == "TRUE"){

    if($SHONiR_Mode == "Basic"){

    $SHONiR_Data = SHONiR_BASE.'Products/'.$SHONiR_ID.'_'.$SHONiR_Slug.'.'.SHONiR_SETTINGS['config_extension'];

    }elseif($SHONiR_Mode == "Order"){

        $SHONiR_Data = SHONiR_BASE.'Ajax/Product-Quick-Order/'.$SHONiR_ID.'_'.$SHONiR_Slug.'.'.SHONiR_SETTINGS['config_extension'];

    }else{

        $SHONiR_Data = SHONiR_BASE.'Ajax/Product-Quick-View/'.$SHONiR_ID.'_'.$SHONiR_Slug.'.'.SHONiR_SETTINGS['config_extension'];

    }

}else{

    $SHONiR_Data = SHONiR_BASE.'index.php?id='.$SHONiR_ID.'&type=products&mode='.$SHONiR_Mode;


}

return $SHONiR_Data;

}


function SHONiR_Product_Details_Fnc($SHONiR_ID, $SHONiR_Where, $SHONiR_Language_ID, $SHONiR_Hit = FALSE){

    $SHONiR_Data = array();

    if(!$SHONiR_ID){

        return false;

    }

    $SHONiR_Get_Product = SHONiR_Get_Product_Fnc($SHONiR_ID, $SHONiR_Where);

            if(!$SHONiR_Get_Product){

                return false;

               }

    if($SHONiR_Hit){

        SHONiR_Query_Fnc("update tbl_products set viewed=(viewed+1), hits=(hits+1), last_hit =". time() ." where product_id=".$SHONiR_ID);


    }


     $SHONiR_Get_Product_Description = SHONiR_Product_Description_Fnc($SHONiR_ID, $SHONiR_Language_ID);

     $SHONiR_Product_Uploads = SHONiR_Uploads_Fnc($SHONiR_ID, 'product');

     if($SHONiR_Product_Uploads){

        $SHONiR_Data['image'] = (SHONiR_SETTINGS['config_auto_watermark']=="TRUE")?$SHONiR_Product_Uploads[0]['upload_id']:$SHONiR_Product_Uploads[0]['upload_file'];

     }else{

        $SHONiR_Data['image'] = 'n-a.png';

     }


      $SHONiR_Data['uploads'] = $SHONiR_Product_Uploads;


      $SHONiR_Data['href'] =  SHONiR_Product_Href_Fnc($SHONiR_ID, $SHONiR_Get_Product_Description['slug']);

      $SHONiR_Data['vhref'] =  SHONiR_Product_Href_Fnc($SHONiR_ID, $SHONiR_Get_Product_Description['slug'], 'View');

      $SHONiR_Data['ohref'] =  SHONiR_Product_Href_Fnc($SHONiR_ID, $SHONiR_Get_Product_Description['slug'], 'Order');

      $SHONiR_Data = array_merge($SHONiR_Get_Product,$SHONiR_Get_Product_Description,$SHONiR_Data);

      return $SHONiR_Data;


}

function SHONiR_Get_Product_Fnc($SHONiR_ID =  null, $SHONiR_Where = null){

    $SHONiR_Data = array();

    if(!$SHONiR_ID){
        $SHONiR_ID =  SHONiR_URI['ID'];
    }

    if($SHONiR_ID ){

        $SHONiR_Query_Product = SHONiR_Query_Fnc("select * from tbl_products where product_id=".$SHONiR_ID.$SHONiR_Where);

$SHONiR_Row_Product= SHONiR_Row_Fnc($SHONiR_Query_Product);

if($SHONiR_Row_Product > 0 ){

    $SHONiR_Data = SHONiR_Fetch_Fnc($SHONiR_Query_Product);

}else{

    $SHONiR_Data = false;

}
    }else{

        $SHONiR_Data = false;

    }

return $SHONiR_Data;

}

function SHONiR_Product_Description_Fnc($SHONiR_ID, $SHONiR_Language_ID){

    $SHONiR_Query_Product_Extra = " and language_id=".$SHONiR_Language_ID;

    $SHONiR_Query_Product_Description = SHONiR_Query_Fnc("select * from tbl_products_description where product_id=".$SHONiR_ID." ".$SHONiR_Query_Product_Extra);

    $SHONiR_Row_Product_Description = SHONiR_Row_Fnc($SHONiR_Query_Product_Description);

    if($SHONiR_Row_Product_Description > 0 ){

    $SHONiR_Fetch_Product_Description = SHONiR_Fetch_Fnc($SHONiR_Query_Product_Description);

    }else{

            $SHONiR_Fetch_Product_Description = false;

    }

    return $SHONiR_Fetch_Product_Description;

}

function SHONiR_Product_Parents_Fnc($SHONiR_ID){

    $SHONiR_Query_Product_Parents = SHONiR_Query_Fnc("select * from tbl_products_to_categories where product_id=".$SHONiR_ID);

    $SHONiR_Row_Product_Parents = SHONiR_Row_Fnc($SHONiR_Query_Product_Parents);

    if($SHONiR_Row_Product_Parents > 0 ){

        while($SHONiR_Fetch_Product_Parents = SHONiR_Fetch_Fnc($SHONiR_Query_Product_Parents))
        {

            $SHONiR_Return[] = $SHONiR_Fetch_Product_Parents['parent_id'];

        }

    }else{

        $SHONiR_Return = false;

    }

    return $SHONiR_Return;

}

function SHONiR_AP_Products_Fnc_Render(){

    $SHONiR_Second =  SHONiR_URI['Second'];

    $SHONiR_CSRF = SHONiR_Post_Fnc('SHONiR_CSRF');

    if($SHONiR_CSRF){

    if(SHONiR_CSRF_Fnc($SHONiR_CSRF)){

        if($SHONiR_Second == 'Add'){

        $SHONiR_sort_order = SHONiR_Post_Fnc('sort_order', FILTER_VALIDATE_INT);
        if(!$SHONiR_sort_order){
            $SHONiR_sort_order = 0;
        }
        $SHONiR_brand_id = SHONiR_Post_Fnc('brand_id', FILTER_VALIDATE_INT);
        if(!$SHONiR_brand_id){
            $SHONiR_brand_id = 0;
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

        $SHONiR_searchable = SHONiR_Post_Fnc('searchable', FILTER_VALIDATE_INT);
        if(!$SHONiR_searchable){
            $SHONiR_searchable = 0;
        }

        $SHONiR_featured = SHONiR_Post_Fnc('featured', FILTER_VALIDATE_INT);
        if(!$SHONiR_featured){
            $SHONiR_featured = 0;
        }

        $SHONiR_express_delivery = SHONiR_Post_Fnc('express_delivery', FILTER_VALIDATE_INT);
        if(!$SHONiR_express_delivery){
            $SHONiR_express_delivery = 0;
        }

        $SHONiR_standard_delivery = SHONiR_Post_Fnc('standard_delivery', FILTER_VALIDATE_INT);
        if(!$SHONiR_standard_delivery){
            $SHONiR_standard_delivery = 0;
        }

        $SHONiR_stock = SHONiR_Post_Fnc('stock', FILTER_VALIDATE_INT);
        if(!$SHONiR_stock){
            $SHONiR_stock = 0;
        }

        $SHONiR_cost_price = SHONiR_Get_Price_Fnc(SHONiR_Post_Fnc('cost_price'));
        if(!$SHONiR_cost_price){
            $SHONiR_cost_price = 0;
        }

        $SHONiR_selling_price = SHONiR_Get_Price_Fnc(SHONiR_Post_Fnc('selling_price'));
        if(!$SHONiR_selling_price){
            $SHONiR_selling_price = 0;
        }

        $SHONiR_model = SHONiR_Post_Fnc('model');

        $SHONiR_video_link = SHONiR_Post_Fnc('video_link');

        $SHONiR_Reference = SHONiR_Reference_Fnc();

   SHONiR_Query_Fnc("insert into tbl_products (reference, sort_order, stock, brand_id, status, listed, locked, searchable, featured, express_delivery, standard_delivery, cost_price, selling_price, model, video_link, add_time, edit_time) values ('".$SHONiR_Reference."', ".$SHONiR_sort_order.",  ".$SHONiR_stock.",  ".$SHONiR_brand_id.", ".$SHONiR_status.", ".$SHONiR_listed.", ".$SHONiR_locked.", ".$SHONiR_searchable.", ".$SHONiR_featured.", ".$SHONiR_express_delivery.", ".$SHONiR_standard_delivery.", '".$SHONiR_cost_price."', '".$SHONiR_selling_price."', '".$SHONiR_model."', '".$SHONiR_video_link."',  ".time().", ".time()." )");

   $SHONiR_product_id = SHONiR_Insert_ID_Fnc();

   $SHONiR_All_Languages = SHONiR_Languages_Fnc(FALSE, 1, 'asc');

   foreach($SHONiR_All_Languages as $language)
{

   SHONiR_Query_Fnc("insert into tbl_products_description (product_id, language_id, slug, name, description, meta_title, meta_description, meta_keyword) values (".$SHONiR_product_id.", ".$language['language_id'].", '".SHONiR_Slug_Fnc(SHONiR_Post_Fnc('slug_'.$language['language_id']))."', '".SHONiR_Post_Fnc('name_'.$language['language_id'])."', '".SHONiR_Post_Fnc('description_'.$language['language_id'])."', '".SHONiR_Post_Fnc('meta_title_'.$language['language_id'])."', '".SHONiR_Post_Fnc('meta_description_'.$language['language_id'])."', '".SHONiR_Post_Fnc('meta_keyword_'.$language['language_id'])."')");

}

$SHONiR_parent = SHONiR_Post_Fnc('parent');

if($SHONiR_parent){

    foreach ($SHONiR_parent as $parent){

        if($parent > 0 ){

            SHONiR_Query_Fnc("insert into tbl_products_to_categories (product_id, parent_id) values (".$SHONiR_product_id.", ".$parent.")");

        }

    }

}


$SHONiR_additional_options = SHONiR_Post_Fnc('additional_option');

SHONiR_Options_Add_Fnc('product', $SHONiR_product_id, $SHONiR_additional_options);

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

SHONiR_Query_Fnc("insert into tbl_uploads (upload_file, sort_order, parent_id, parent_type, add_time) values ('".$SHONiR_files_final."', ".$SHONiR_sort_order.", ".$SHONiR_product_id.", 'product', ".time().")");

move_uploaded_file($SHONiR_files["tmp_name"][$i], SHONiR_ROOT.'media/uploads/'.$SHONiR_files_final);

if(SHONiR_SETTINGS['config_auto_resize']){

SHONiR_Resize_Fnc(SHONiR_ROOT.'media/uploads/'.$SHONiR_files_final);

}

}

}
exit;
   $SHONiR_Alert['type'] = 'success';
   $SHONiR_Alert['message'] = 'New Product has been added successfully.';
   SHONiR_Session_Write_Fnc('SHONiR_Alert', $SHONiR_Alert);

 SHONiR_Redirect_Fnc(SHONiR_APANEL.'Products');

}elseif($SHONiR_Second == 'Edit'){

    $SHONiR_Get_product_id = SHONiR_Get_Fnc('product_id');

           if(!$SHONiR_Get_product_id){

            $SHONiR_Alert['type'] = 'error';
        $SHONiR_Alert['message'] = 'Unknown error occurred please try again later.';
        SHONiR_Session_Write_Fnc('SHONiR_Alert', $SHONiR_Alert);
        SHONiR_Redirect_Fnc(SHONiR_APANEL.'Products');

           }

           $SHONiR_Get_Product_Records = SHONiR_Get_Product_Fnc($SHONiR_Get_product_id);

            if(!$SHONiR_Get_Product_Records){

                $SHONiR_Alert['type'] = 'error';
            $SHONiR_Alert['message'] = 'The requested record was not found.';
            SHONiR_Session_Write_Fnc('SHONiR_Alert', $SHONiR_Alert);
            SHONiR_Redirect_Fnc(SHONiR_APANEL.'Products');

               }


           SHONiR_Query_Fnc("delete from tbl_products_to_categories where product_id=".$SHONiR_Get_product_id);

    $SHONiR_sort_order = SHONiR_Post_Fnc('sort_order', FILTER_VALIDATE_INT);
        if(!$SHONiR_sort_order){
            $SHONiR_sort_order = 0;
        }
        $SHONiR_brand_id = SHONiR_Post_Fnc('brand_id', FILTER_VALIDATE_INT);
        if(!$SHONiR_brand_id){
            $SHONiR_brand_id = 0;
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

        $SHONiR_searchable = SHONiR_Post_Fnc('searchable', FILTER_VALIDATE_INT);
        if(!$SHONiR_searchable){
            $SHONiR_searchable = 0;
        }

        $SHONiR_featured = SHONiR_Post_Fnc('featured', FILTER_VALIDATE_INT);
        if(!$SHONiR_featured){
            $SHONiR_featured = 0;
        }

        $SHONiR_express_delivery = SHONiR_Post_Fnc('express_delivery', FILTER_VALIDATE_INT);
        if(!$SHONiR_express_delivery){
            $SHONiR_express_delivery = 0;
        }

        $SHONiR_standard_delivery = SHONiR_Post_Fnc('standard_delivery', FILTER_VALIDATE_INT);
        if(!$SHONiR_standard_delivery){
            $SHONiR_standard_delivery = 0;
        }

        $SHONiR_stock = SHONiR_Post_Fnc('stock', FILTER_VALIDATE_INT);
        if(!$SHONiR_stock){
            $SHONiR_stock = 0;
        }

        $SHONiR_cost_price = SHONiR_Post_Fnc('cost_price', FILTER_VALIDATE_INT);
        if(!$SHONiR_cost_price){
            $SHONiR_cost_price = 0;
        }

        $SHONiR_selling_price = SHONiR_Post_Fnc('selling_price', FILTER_VALIDATE_INT);
        if(!$SHONiR_selling_price){
            $SHONiR_selling_price = 0;
        }

        $SHONiR_model = SHONiR_Post_Fnc('model');

        $SHONiR_video_link = SHONiR_Post_Fnc('video_link');

     SHONiR_Query_Fnc("update tbl_products set sort_order=". $SHONiR_sort_order .", stock=". $SHONiR_stock .", brand_id=". $SHONiR_brand_id .", status=". $SHONiR_status .", listed=". $SHONiR_listed .", locked=". $SHONiR_locked .", searchable=". $SHONiR_searchable .", featured=". $SHONiR_featured .", express_delivery=". $SHONiR_express_delivery .", standard_delivery=". $SHONiR_standard_delivery .", cost_price='". $SHONiR_cost_price ."',  selling_price='". $SHONiR_selling_price ."', model='". $SHONiR_model ."', video_link='". $SHONiR_video_link ."', edit_time =". time() ." where product_id=".$SHONiR_Get_product_id);

     $SHONiR_All_Languages = SHONiR_Languages_Fnc(FALSE, 1, 'asc');

        foreach($SHONiR_All_Languages as $language)
{

    if(SHONiR_Product_Description_Fnc($SHONiR_Get_product_id, $language['language_id'])){


SHONiR_Query_Fnc("update tbl_products_description set slug='".SHONiR_Slug_Fnc(SHONiR_Post_Fnc('slug_'.$language['language_id']))."',  name='".SHONiR_Post_Fnc('name_'.$language['language_id'])."',  description='".SHONiR_Post_Fnc('description_'.$language['language_id'])."',  meta_title='".SHONiR_Post_Fnc('meta_title_'.$language['language_id'])."',  meta_description='".SHONiR_Post_Fnc('meta_description_'.$language['language_id'])."',  meta_keyword='".SHONiR_Post_Fnc('meta_keyword_'.$language['language_id'])."'  where language_id=".$language['language_id']." and product_id=".$SHONiR_Get_product_id);

    }else{

        SHONiR_Query_Fnc("insert into tbl_products_description (product_id, language_id, slug, name, description, meta_title, meta_Description, meta_keyword) values (".$SHONiR_Get_product_id.", ".$language['language_id'].", '".SHONiR_Post_Fnc('slug_'.$language['language_id'])."', '".SHONiR_Slug_Fnc(SHONiR_Post_Fnc('name_'.$language['language_id']))."', '".SHONiR_Post_Fnc('description_'.$language['language_id'])."', '".SHONiR_Post_Fnc('meta_title_'.$language['language_id'])."', '".SHONiR_Post_Fnc('meta_Description_'.$language['language_id'])."', '".SHONiR_Post_Fnc('meta_keyword_'.$language['language_id'])."')");

    }

}

$SHONiR_parent = SHONiR_Post_Fnc('parent');

if($SHONiR_parent){

    foreach ($SHONiR_parent as $parent){

        if($parent > 0 ){

            SHONiR_Query_Fnc("insert into tbl_products_to_categories (product_id, parent_id) values (".$SHONiR_Get_product_id.", ".$parent.")");

        }

    }

}


$SHONiR_additional_options = SHONiR_Post_Fnc('additional_option');

//print_r($SHONiR_additional_options);echo '<hr>';


SHONiR_Options_Add_Fnc('product', $SHONiR_Get_product_id, $SHONiR_additional_options);

//exit;

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
$SHONiR_Uploads_Records = SHONiR_Uploads_Fnc($SHONiR_Get_product_id, 'product');

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


SHONiR_Query_Fnc("insert into tbl_uploads (upload_file, sort_order, parent_id, parent_type, add_time) values ('".$SHONiR_files_final."', ".$SHONiR_sort_order.", ".$SHONiR_Get_product_id.", 'product', ".time().")");

move_uploaded_file($SHONiR_files["tmp_name"][$i], SHONiR_ROOT.'media/uploads/'.$SHONiR_files_final);

if(SHONiR_SETTINGS['config_auto_resize']){

    SHONiR_Resize_Fnc(SHONiR_ROOT.'media/uploads/'.$SHONiR_files_final);

    }

}

}
//exit;
$SHONiR_Alert['type'] = 'success';
   $SHONiR_Alert['message'] = 'Product has been updated successfully.';
   SHONiR_Session_Write_Fnc('SHONiR_Alert', $SHONiR_Alert);

 SHONiR_Redirect_Fnc(SHONiR_APANEL.'Products');

}

     }else{

        $SHONiR_Alert['type'] = 'error';
        $SHONiR_Alert['message'] = 'Please make sure your browser has cookies enabled and try again.';
        SHONiR_Session_Write_Fnc('SHONiR_Alert', $SHONiR_Alert);

     }

  }

        if($SHONiR_Second == 'Add'){

            $SHONiR_Main['meta_title'] = 'Add | Products | SHONiR Administrator Panel | Created with LOVE by SHONiR';

            $SHONiR_Main['meta_description'] = '';

            $SHONiR_Main['meta_keyword'] = '';

            $SHONiR_Main['SHONiR_CSRF'] = SHONiR_CSRF_Fnc('G');

            $SHONiR_Main['SHONiR_Languages'] = SHONiR_Languages_Fnc(FALSE, 1, 'asc');

            $SHONiR_Main['SHONiR_Categories'] = SHONiR_Get_Categories_Fnc();

            $SHONiR_Main['SHONiR_Brands'] = SHONiR_Get_Brands_Fnc();

            $GLOBALS['SHONiR_VIEWS_FILE'] = "products-add";


        }elseif($SHONiR_Second == 'Edit'){

            $SHONiR_Get_product_id = SHONiR_Get_Fnc('product_id');

           if(!$SHONiR_Get_product_id){

            $SHONiR_Alert['type'] = 'error';
        $SHONiR_Alert['message'] = 'Unknown error occurred please try again later.';
        SHONiR_Session_Write_Fnc('SHONiR_Alert', $SHONiR_Alert);
        SHONiR_Redirect_Fnc(SHONiR_APANEL.'Products');

           }

           $SHONiR_Get_Product_Records = SHONiR_Get_Product_Fnc($SHONiR_Get_product_id);

            if(!$SHONiR_Get_Product_Records){

                $SHONiR_Alert['type'] = 'error';
            $SHONiR_Alert['message'] = 'The requested record was not found.';
            SHONiR_Session_Write_Fnc('SHONiR_Alert', $SHONiR_Alert);
            SHONiR_Redirect_Fnc(SHONiR_APANEL.'Products');

               }


            foreach ($SHONiR_Get_Product_Records as $Product_key => $Product_value)
            {

       if(SHONiR_Post_Fnc('SHONiR_CSRF')){

        $SHONiR_Main[$Product_key] = SHONiR_Post_Fnc($Product_key);

       }else{

    $SHONiR_Main[$Product_key] = $Product_value;

       }

            }

            $SHONiR_Languages_Records = SHONiR_Languages_Fnc(FALSE, 1, 'asc');

            foreach ($SHONiR_Languages_Records as $Languages_value)
            {

                $SHONiR_Product_Description_Records[$Languages_value['language_id']] = SHONiR_Product_Description_Fnc($SHONiR_Get_product_id, $Languages_value['language_id']);

                if(is_array($SHONiR_Product_Description_Records[$Languages_value['language_id']])){

                foreach ($SHONiR_Product_Description_Records[$Languages_value['language_id']] as $Description_key => $Description_value)
            {

                if(SHONiR_Post_Fnc('SHONiR_CSRF')){

                    $SHONiR_Main[$Description_key.'_'.$Languages_value['language_id']] = SHONiR_Post_Fnc($Description_key.'_'.$Languages_value['language_id']);

                }else{

                $SHONiR_Main[$Description_key.'_'.$Languages_value['language_id']] = $Description_value;

                }

            }

        }

            }

            $SHONiR_Uploads_Records = SHONiR_Uploads_Fnc($SHONiR_Get_product_id, 'product');

            $SHONiR_Main['uploads'] = $SHONiR_Uploads_Records;

            $SHONiR_Options_Records = SHONiR_Get_Options_Fnc($SHONiR_Get_product_id, 'product');

            $SHONiR_Main['options'] = $SHONiR_Options_Records;

            $SHONiR_files_sort_order='';

            foreach ($SHONiR_Uploads_Records as $Uploads_value)
            {

            $SHONiR_files_sort_order .= $Uploads_value['upload_file'].'='.$Uploads_value['sort_order'].',';

            }

            $SHONiR_Main['files_sort_order'] = $SHONiR_files_sort_order;


            if(SHONiR_Post_Fnc('SHONiR_CSRF')){

                $SHONiR_Main['SHONiR_Parent'] = SHONiR_Post_Fnc('parent');

            }else{

                $SHONiR_Main['SHONiR_Parent'] = SHONiR_Product_Parents_Fnc($SHONiR_Get_product_id);

            }

            $SHONiR_Main['meta_title'] = 'Edit | Products | SHONiR Administrator Panel | Created with LOVE by SHONiR';

            $SHONiR_Main['meta_description'] = '';

            $SHONiR_Main['meta_keyword'] = '';

            $SHONiR_Main['SHONiR_GET_ID'] = $SHONiR_Get_product_id;

            $SHONiR_Main['SHONiR_CSRF'] = SHONiR_CSRF_Fnc('G');

            $SHONiR_Main['SHONiR_Languages'] = $SHONiR_Languages_Records;

            $SHONiR_Main['SHONiR_Categories'] = SHONiR_Get_Categories_Fnc();

            $SHONiR_Main['SHONiR_Brands'] = SHONiR_Get_Brands_Fnc();

            $GLOBALS['SHONiR_VIEWS_FILE'] = "products-edit";

        }elseif($SHONiR_Second == 'Delete'){

            $SHONiR_Get_product_id = SHONiR_Get_Fnc('product_id');

            if(!$SHONiR_Get_product_id){

             $SHONiR_Alert['type'] = 'error';
         $SHONiR_Alert['message'] = 'Unknown error occurred please try again later.';
         SHONiR_Session_Write_Fnc('SHONiR_Alert', $SHONiR_Alert);
         SHONiR_Redirect_Fnc(SHONiR_APANEL.'Products');

            }

            $SHONiR_Get_Product_Records = SHONiR_Get_Product_Fnc($SHONiR_Get_product_id);

            if(!$SHONiR_Get_Product_Records){

                $SHONiR_Alert['type'] = 'error';
            $SHONiR_Alert['message'] = 'The requested record was not found.';
            SHONiR_Session_Write_Fnc('SHONiR_Alert', $SHONiR_Alert);
            SHONiR_Redirect_Fnc(SHONiR_APANEL.'Products');

               }


               if($SHONiR_Get_Product_Records['locked']){

                $SHONiR_Alert['type'] = 'error';
            $SHONiR_Alert['message'] = 'Access Denied! You cannot delete this record.';
            SHONiR_Session_Write_Fnc('SHONiR_Alert', $SHONiR_Alert);
            SHONiR_Redirect_Fnc(SHONiR_APANEL.'Categories');

               }

               $SHONiR_Uploads_Records = SHONiR_Uploads_Fnc($SHONiR_Get_product_id, 'product');

               foreach ($SHONiR_Uploads_Records as $Uploads_value)
               {

                SHONiR_Query_Fnc("delete from tbl_uploads where upload_id=".$Uploads_value['upload_id']);

             if (file_exists(SHONiR_ROOT.'media/uploads/'.$Uploads_value['upload_file'])) { unlink (SHONiR_ROOT.'media/uploads/'.$Uploads_value['upload_file']); }

               }

               SHONiR_Query_Fnc("delete from tbl_products_to_categories where product_id=".$SHONiR_Get_product_id);

               SHONiR_Query_Fnc("delete from tbl_products_description where product_id=".$SHONiR_Get_product_id);

               SHONiR_Query_Fnc("delete from tbl_products where product_id=".$SHONiR_Get_product_id);

               $SHONiR_Alert['type'] = 'success';
   $SHONiR_Alert['message'] = 'Product has been deleted successfully.';
   SHONiR_Session_Write_Fnc('SHONiR_Alert', $SHONiR_Alert);

 SHONiR_Redirect_Fnc(SHONiR_APANEL.'Products');


        }else{

            $SHONiR_Main['meta_title'] = 'Products | SHONiR Administrator Panel | Created with LOVE by SHONiR';

            $SHONiR_Main['meta_description'] = '';

            $SHONiR_Main['meta_keyword'] = '';

          $SHONiR_Main['SHONiR_Get_Products'] = SHONiR_Get_Products_Fnc();

        }


    $SHONiR_Data["SHONiR_Main"] =  $SHONiR_Main;



return $SHONiR_Data;

}

function SHONiR_Products_Fnc_Render(){

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

           $SHONiR_Product_Details = SHONiR_Product_Details_Fnc($SHONiR_ID, ' and status=1 ', SHONiR_LANGUAGE['language_id'], TRUE);

            if(!$SHONiR_Product_Details){

                $SHONiR_Alert['type'] = 'error';
            $SHONiR_Alert['message'] = 'The requested record was not found.';
            SHONiR_Session_Write_Fnc('SHONiR_Alert', $SHONiR_Alert);
            SHONiR_Redirect_Fnc(SHONiR_BASE);

               }

               $SHONiR_Get_Query_String = SHONiR_Get_Query_String_Fnc();

               if($SHONiR_Get_Query_String){

                SHONiR_Save_Tags_Fnc($SHONiR_ID, "product", $SHONiR_Get_Query_String);

               }


              $SHONiR_Main['SHONiR_Product_Details'] = $SHONiR_Product_Details;

              $SHONiR_Product_Parents =  SHONiR_Product_Parents_Fnc($SHONiR_ID);


 $SHONiR_Main['meta_title'] = $SHONiR_Product_Details['meta_title'];

    $SHONiR_Main['meta_description'] = $SHONiR_Product_Details['meta_description'];

    $SHONiR_Main['meta_keyword'] = $SHONiR_Product_Details['meta_keyword'];

    $SHONiR_Data["Categories_Tree"] = SHONiR_Categories_Tree_Fnc(0, 'c.status=1 and c.listed=1', SHONiR_LANGUAGE['language_id']);

    $SHONiR_Data["Pages_Tree"] = SHONiR_Pages_Tree_Fnc(0, 'p.status=1 and p.listed=1', SHONiR_LANGUAGE['language_id']);

    $SHONiR_Escape_Rows = ' and p.product_id<>'.$SHONiR_ID;

    $SHONiR_Data["Related_Products"] = SHONiR_Get_Products_Fnc(TRUE, $SHONiR_Product_Parents, "p.status=1 and p.listed=1 ".$SHONiR_Escape_Rows, "p.viewed", "asc", SHONiR_SETTINGS['config_records_limit']);

if($SHONiR_Data["Related_Products"]){
    foreach ($SHONiR_Data["Related_Products"] as $Related_key => $Related_value)
            {

                $SHONiR_Escape_Rows .= ' and p.product_id<>'.$Related_value['product_id'];
            }
}
    $SHONiR_Data["Random_Products"] = SHONiR_Get_Products_Fnc(TRUE, 0, "p.status=1 and p.listed=1 ".$SHONiR_Escape_Rows, "RAND(), p.viewed", "asc", SHONiR_SETTINGS['config_records_limit']);

if($SHONiR_Data["Random_Products"]){
    
    foreach ($SHONiR_Data["Random_Products"] as $Random_key => $Random_value)
            {

                $SHONiR_Escape_Rows .= ' and p.product_id<>'.$Random_value['product_id'];
            }
}
    $SHONiR_Data["Recently_Viewed_Products"] = SHONiR_Get_Products_Fnc(TRUE, 0, "p.status=1 and p.listed=1 ".$SHONiR_Escape_Rows, "p.last_hit", "desc", SHONiR_SETTINGS['config_records_limit']);

    $SHONiR_Data["Main_Banners"] = SHONiR_Get_Banners_Fnc(TRUE, TRUE, "parent_id='product_".$SHONiR_ID."' and b.status=1  and b.listed=1 ", 'b.viewed', 'asc');

    if(!$SHONiR_Data["Main_Banners"] && $SHONiR_Product_Parents){

        $SHONiR_Data["Main_Banners"] = SHONiR_Get_Banners_Fnc(TRUE, TRUE, "parent_id='category_".$SHONiR_Product_Parents[0]."' and b.status=1  and b.listed=1 ", 'b.viewed', 'asc');

    }

    if(!$SHONiR_Data["Main_Banners"]){

        $SHONiR_Data["Main_Banners"] = SHONiR_Get_Banners_Fnc(TRUE, TRUE, "parent_id='products' and b.status=1  and b.listed=1 ", 'b.viewed', 'asc');

    }

    $GLOBALS['SHONiR_VIEWS_FILE'] = 'product_details';

    }else{

        if($SHONiR_Last=='search'){

            $SHONiR_Data["Main_Banners"] = SHONiR_Get_Banners_Fnc(TRUE, TRUE, "parent_id='search' and b.status=1  and b.listed=1 ", 'b.viewed', 'asc');

            $SHONiR_Data["Sub_Categories"] = array();

        }else{

    if(!$SHONiR_ID){

        $SHONiR_Where = " and NOT EXISTS (SELECT * FROM tbl_categories_to_categories ctc WHERE c.category_id = ctc.category_id)";

        $SHONiR_Data["Main_Banners"] = SHONiR_Get_Banners_Fnc(TRUE, TRUE, "parent_id='products' and b.status=1  and b.listed=1 ", 'b.viewed', 'asc');

    }else{

        $SHONiR_Data["Main_Banners"] = SHONiR_Get_Banners_Fnc(TRUE, TRUE, "parent_id='category_".$SHONiR_ID."' and b.status=1  and b.listed=1 ", 'b.viewed', 'asc');

    }

    $SHONiR_Data["Sub_Categories"] = SHONiR_Get_Categories_Fnc($SHONiR_ID, "c.status=1 and c.listed=1".$SHONiR_Where);
}

    $SHONiR_Order = SHONiR_Get_Fnc('o');

    if(!$SHONiR_Order){

    if(SHONiR_Cookie_Exist_Fnc('o')){

        $SHONiR_Order = SHONiR_Cookie_Read_Fnc('o');

    }

}

    if(!$SHONiR_Order){

        $SHONiR_Order = "p.sort_order";
    }

    SHONiR_Cookie_Write_Fnc('o', $SHONiR_Order);

    $SHONiR_Main['SHONiR_o']  =  $SHONiR_Order;

    $SHONiR_By = SHONiR_Get_Fnc('b');

if(!$SHONiR_By){

    if(SHONiR_Cookie_Exist_Fnc('b')){

        $SHONiR_By = SHONiR_Cookie_Read_Fnc('b');

    }

}

    if($SHONiR_By!="desc"){

        $SHONiR_By = "asc";

    }


    SHONiR_Cookie_Write_Fnc('b', $SHONiR_By);

    $SHONiR_Main['SHONiR_b']  =  $SHONiR_By;

    $SHONiR_View = SHONiR_Get_Fnc('v');

    if(!$SHONiR_View){

    if(SHONiR_Cookie_Exist_Fnc('v')){

        $SHONiR_View = SHONiR_Cookie_Read_Fnc('v');

    }

}

    if($SHONiR_View!="list"){

        $SHONiR_View = "grid";

    }

    SHONiR_Cookie_Write_Fnc('v', $SHONiR_View);

    $SHONiR_Main['SHONiR_v']  =  $SHONiR_View;

    if($SHONiR_Last=='search'){

        $SHONiR_Where = "p.status=1 and p.searchable=1";

        $SHONiR_ID = SHONiR_Get_Fnc('c');

        if(!ctype_digit($SHONiR_ID)){

            $SHONiR_ID = 0;

          }

    }else{

        $SHONiR_Where = "p.status=1 and p.listed=1";

    }

    $SHONiR_Query = SHONiR_Get_Products_Fnc(TRUE, $SHONiR_ID,  $SHONiR_Where, $SHONiR_Order, $SHONiR_By, false, $SHONiR_Keywords);

    if($SHONiR_Query){
    $SHONiR_Total_Records = count($SHONiR_Query);
    }else{
        $SHONiR_Total_Records = 0;
    }

    $SHONiR_Page_No = SHONiR_Get_Fnc('n');

    $SHONiR_Records_Limit = SHONiR_Get_Fnc('l');

    if(!ctype_digit($SHONiR_Records_Limit) || $SHONiR_Records_Limit < SHONiR_SETTINGS['config_records_limit'] || $SHONiR_Records_Limit>$SHONiR_Total_Records){

        if(SHONiR_Cookie_Exist_Fnc('l')){

            $SHONiR_Records_Limit = SHONiR_Cookie_Read_Fnc('l');

        }else{

        $SHONiR_Records_Limit = SHONiR_SETTINGS['config_records_limit'];

        }
      }

      SHONiR_Cookie_Write_Fnc('l', $SHONiR_Records_Limit);

      $SHONiR_Main['SHONiR_l']  =  $SHONiR_Records_Limit;


$SHONiR_Total_Pages = ceil($SHONiR_Total_Records / $SHONiR_Records_Limit);

if(!ctype_digit($SHONiR_Page_No) || $SHONiR_Page_No<1 || $SHONiR_Page_No>$SHONiR_Total_Pages){

  $SHONiR_Page_No = 1;
}

$SHONiR_Start = ($SHONiR_Page_No-1) * $SHONiR_Records_Limit;

$SHONiR_SQL_Pagination_Limit = $SHONiR_Start.", ".$SHONiR_Records_Limit;

    $SHONiR_Query_Pagination = SHONiR_Get_Products_Fnc(TRUE, $SHONiR_ID,  $SHONiR_Where, $SHONiR_Order, $SHONiR_By, $SHONiR_SQL_Pagination_Limit, $SHONiR_Keywords);

    if($SHONiR_Query_Pagination){
        $SHONiR_Row_Pagination = count($SHONiR_Query_Pagination);
        }else{
            $SHONiR_Row_Pagination = 0;
        }

    if($SHONiR_Row_Pagination > 0 ){

    $SHONiR_Rows = $SHONiR_Query_Pagination;

    $SHONiR_Page = SHONiR_BASE.'Products/'.$SHONiR_Last.'?q='.$SHONiR_Keywords.'&v='.$SHONiR_View.'&o='.$SHONiR_Order.'&b='.$SHONiR_By.'&l='.$SHONiR_Records_Limit.'&';

    $SHONiR_Style = 'justify-content-center';

    $SHONiR_Main['SHONiR_Products'] =  SHONiR_Pagination_Fnc($SHONiR_Page_No, $SHONiR_Records_Limit, $SHONiR_Total_Pages, $SHONiR_Total_Records, $SHONiR_Start, $SHONiR_Row_Pagination, $SHONiR_Rows, $SHONiR_Page, True, True, $SHONiR_Style);

    }else{

      $SHONiR_Main['SHONiR_Products'] = false;

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

    $SHONiR_Main['details'] = '';

    }elseif($SHONiR_Current_Category) {
        $SHONiR_Main = array_merge($SHONiR_Main,$SHONiR_Current_Category);

        $SHONiR_Main['heading'] = $SHONiR_Current_Category['name'];

        $SHONiR_Main['details'] = $SHONiR_Current_Category['description'];

    }else{


        $SHONiR_Page_Details = SHONiR_Page_Details_Fnc(18, ' and p.status=1 ', SHONiR_LANGUAGE['language_id']);

        $SHONiR_Main['meta_title'] = $SHONiR_Page_Details['meta_title'];

    $SHONiR_Main['meta_description'] = $SHONiR_Page_Details['meta_description'];

    $SHONiR_Main['meta_keyword'] = $SHONiR_Page_Details['meta_keyword'];

        $SHONiR_Main['heading'] = $SHONiR_Page_Details['name'];

        $SHONiR_Main['details'] = $SHONiR_Page_Details['description'];

    }

    $SHONiR_Data["Categories_Tree"] = SHONiR_Categories_Tree_Fnc(0, 'c.status=1 and c.listed=1', SHONiR_LANGUAGE['language_id']);

    $SHONiR_Data["Pages_Tree"] = SHONiR_Pages_Tree_Fnc(0, 'p.status=1 and p.listed=1', SHONiR_LANGUAGE['language_id']);

    $SHONiR_Data["Recently_Viewed_Products"] = SHONiR_Get_Products_Fnc(TRUE, 0, "p.status=1 and p.listed=1", "p.last_hit", "desc", SHONiR_SETTINGS['config_records_limit']);

}

$SHONiR_Data["SHONiR_Main"] =  $SHONiR_Main;

    return $SHONiR_Data;

}

function SHONiR_Get_Products_Fnc($SHONiR_Viewed = FALSE, $SHONiR_Parent = 0, $SHONiR_Where = FALSE, $SHONiR_Order = 'p.sort_order', $SHONiR_By = 'asc', $SHONiR_Limit = FALSE, $SHONiR_Keywords = null){

    $SHONiR_Data = array();

    $SHONiR_SQL_Products_Where = ' where pd.language_id='.SHONiR_LANGUAGE['language_id'];
    $SHONiR_Parent_Where = '';

    $SHONiR_SQL_Search = '';

    if($SHONiR_Keywords){

        $SHONiR_SQL_Search = "(p.reference LIKE '%".$SHONiR_Keywords."%' OR p.model LIKE '%".$SHONiR_Keywords."%' OR pd.slug LIKE '%".$SHONiR_Keywords."%' OR pd.name LIKE '%".$SHONiR_Keywords."%' OR pd.description LIKE '%".$SHONiR_Keywords."%' OR pd.tag LIKE '%".$SHONiR_Keywords."%' OR pd.meta_title LIKE '%".$SHONiR_Keywords."%' OR pd.meta_description LIKE '%".$SHONiR_Keywords."%' OR pd.meta_keyword LIKE '%".$SHONiR_Keywords."%' )";

        $SHONiR_SQL_Products_Where .= ' and '.$SHONiR_SQL_Search;
    }

    //echo $SHONiR_SQL_Products_Where;exit;

    if($SHONiR_Parent){

        $SHONiR_SQL_Products = "select * from tbl_products p left join tbl_products_description pd on p.product_id=pd.product_id left join tbl_products_to_categories ptc on p.product_id=ptc.product_id" ;

        if(is_array($SHONiR_Parent)){
            $SHONiR_Parent_Array = $SHONiR_Parent;
            foreach($SHONiR_Parent as $key => $value)
{
    $SHONiR_Parent_Where .= ($SHONiR_Parent_Where)?' or ':'';
    $SHONiR_Parent_Where .=" ptc.parent_id=". $value;
}

$SHONiR_SQL_Products_Where .= " and ". $SHONiR_Parent_Where;

        }else{

        $SHONiR_SQL_Products_Where .= " and ptc.parent_id=".$SHONiR_Parent;

        }

        if($SHONiR_Where !== FALSE){

            $SHONiR_SQL_Products_Where .= " and ".$SHONiR_Where;

            }

    }else{

    $SHONiR_SQL_Products = "select * from tbl_products p left join tbl_products_description pd on p.product_id=pd.product_id" ;

    if($SHONiR_Where !== FALSE){

        $SHONiR_SQL_Products_Where .= " and ".$SHONiR_Where;

        }

    }

    $SHONiR_SQL_Products_Limit = '';

    $SHONiR_SQL_Products_Sort = " order by ".$SHONiR_Order."  ".$SHONiR_By." ";

    if($SHONiR_Limit !== FALSE){

    $SHONiR_SQL_Products_Limit = "  limit ".$SHONiR_Limit;

    }

    $SHONiR_Query_Run = $SHONiR_SQL_Products.$SHONiR_SQL_Products_Where.$SHONiR_SQL_Products_Sort.$SHONiR_SQL_Products_Limit;

    $SHONiR_Query_Products = SHONiR_Query_Fnc($SHONiR_Query_Run);

    $SHONiR_Row_Products = SHONiR_Row_Fnc($SHONiR_Query_Products);

    if($SHONiR_Row_Products > 0 ){

        while($row =  SHONiR_Fetch_Fnc($SHONiR_Query_Products))
{

    if($SHONiR_Viewed){

        SHONiR_Query_Fnc("update tbl_products set viewed=(viewed+1) where product_id=".$row['product_id']);
    }

    $SHONiR_More['image2'] = '';

    $SHONiR_Product_Uploads = SHONiR_Uploads_Fnc($row['product_id'], 'product');

    if($SHONiR_Product_Uploads){

        $SHONiR_More['image'] = (SHONiR_SETTINGS['config_auto_watermark']=="TRUE")?$SHONiR_Product_Uploads[0]['upload_id']:$SHONiR_Product_Uploads[0]['upload_file'];

        if(count($SHONiR_Product_Uploads) > 1){

            $SHONiR_More['image2'] = (SHONiR_SETTINGS['config_auto_watermark']=="TRUE")?$SHONiR_Product_Uploads[1]['upload_id']:$SHONiR_Product_Uploads[1]['upload_file'];
        }else{

            unset($SHONiR_More['image2']);
        }

     }else{

        $SHONiR_More['image'] = 'n-a.png';

     }

     $SHONiR_More['href'] =  SHONiR_Product_Href_Fnc($row['product_id'], $row['slug']);

     $SHONiR_More['vhref'] =  SHONiR_Product_Href_Fnc($row['product_id'], $row['slug'], 'View');

     $SHONiR_More['ohref'] =  SHONiR_Product_Href_Fnc($row['product_id'], $row['slug'], 'Order');

     $SHONiR_Data[] = array_merge($row,$SHONiR_More);


}

    }else{

        $SHONiR_Data = false;

    }


return $SHONiR_Data;

}




?>
