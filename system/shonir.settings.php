<?php defined('SHONiR') OR exit('No direct script access allowed');

function SHONiR_Settings_Update_Fnc($SHONiR_Code, $SHONiR_Key, $SHONiR_Value){

    SHONiR_Query_Fnc("update tbl_settings set setting_value='". $SHONiR_Value ."' where setting_key='".$SHONiR_Key."' and setting_code='".$SHONiR_Code."' ");

}

function SHONiR_AP_Settings_Fnc_Render(){

    $SHONiR_Second =  SHONiR_URI['Second'];

    $SHONiR_CSRF = SHONiR_Post_Fnc('SHONiR_CSRF');

    if($SHONiR_CSRF){  

    if(SHONiR_CSRF_Fnc($SHONiR_CSRF)){

        if($SHONiR_Second == 'Code'){           

            $SHONiR_header = SHONiR_Post_Fnc('header');
            $SHONiR_footer = SHONiR_Post_Fnc('footer');

   SHONiR_Settings_Update_Fnc('code', 'header', $SHONiR_header);
   SHONiR_Settings_Update_Fnc('code', 'footer', $SHONiR_footer);

   $SHONiR_Alert['type'] = 'success';
   $SHONiR_Alert['message'] = 'Code settings has been updated successfully.';
   SHONiR_Session_Write_Fnc('SHONiR_Alert', $SHONiR_Alert);

 SHONiR_Redirect_Fnc(SHONiR_APANEL.'Settings');

        }elseif($SHONiR_Second == 'Website'){

            $SHONiR_company = SHONiR_Post_Fnc('company');
            $SHONiR_email = SHONiR_Post_Fnc('email');
            $SHONiR_telephone = SHONiR_Post_Fnc('telephone');
            $SHONiR_url = SHONiR_Post_Fnc('url');
            $SHONiR_address = SHONiR_Post_Fnc('address');
            $SHONiR_contact_name = SHONiR_Post_Fnc('contact_name');
            $SHONiR_contact_type = SHONiR_Post_Fnc('contact_type');
            $SHONiR_latitude = SHONiR_Post_Fnc('latitude');
            $SHONiR_longitude = SHONiR_Post_Fnc('longitude');

            SHONiR_Settings_Update_Fnc('website', 'company', $SHONiR_company);
            SHONiR_Settings_Update_Fnc('website', 'email', $SHONiR_email);
            SHONiR_Settings_Update_Fnc('website', 'telephone', $SHONiR_telephone);
            SHONiR_Settings_Update_Fnc('website', 'url', $SHONiR_url);
            SHONiR_Settings_Update_Fnc('website', 'address', $SHONiR_address);
            SHONiR_Settings_Update_Fnc('website', 'contact_name', $SHONiR_contact_name);
            SHONiR_Settings_Update_Fnc('website', 'contact_type', $SHONiR_contact_type);
            SHONiR_Settings_Update_Fnc('website', 'latitude', $SHONiR_latitude);
            SHONiR_Settings_Update_Fnc('website', 'longitude', $SHONiR_longitude);


            $SHONiR_Alert['type'] = 'success';
   $SHONiR_Alert['message'] = 'Website settings has been updated successfully.';
   SHONiR_Session_Write_Fnc('SHONiR_Alert', $SHONiR_Alert);

 SHONiR_Redirect_Fnc(SHONiR_APANEL.'Settings');

}elseif($SHONiR_Second == 'SMTP'){

    $SHONiR_host = SHONiR_Post_Fnc('host');
    $SHONiR_username = SHONiR_Post_Fnc('username');
    $SHONiR_password = SHONiR_Post_Fnc('password');
    $SHONiR_port = SHONiR_Post_Fnc('port');
    $SHONiR_encryption = SHONiR_Post_Fnc('encryption');
    $SHONiR_from = SHONiR_Post_Fnc('from');

    SHONiR_Settings_Update_Fnc('smtp', 'host', $SHONiR_host);
    SHONiR_Settings_Update_Fnc('smtp', 'username', $SHONiR_username);
    SHONiR_Settings_Update_Fnc('smtp', 'password', $SHONiR_password);
    SHONiR_Settings_Update_Fnc('smtp', 'port', $SHONiR_port);
    SHONiR_Settings_Update_Fnc('smtp', 'encryption', $SHONiR_encryption);
    SHONiR_Settings_Update_Fnc('smtp', 'from', $SHONiR_from);


    $SHONiR_Alert['type'] = 'success';
   $SHONiR_Alert['message'] = 'SMTP settings has been updated successfully.';
   SHONiR_Session_Write_Fnc('SHONiR_Alert', $SHONiR_Alert);

 SHONiR_Redirect_Fnc(SHONiR_APANEL.'Settings');


            
        }elseif($SHONiR_Second == 'Social'){

            $SHONiR_facebook = SHONiR_Post_Fnc('facebook');
            $SHONiR_skype = SHONiR_Post_Fnc('skype');
            $SHONiR_twitter = SHONiR_Post_Fnc('twitter');
            $SHONiR_instagram = SHONiR_Post_Fnc('instagram');
            $SHONiR_pinterest = SHONiR_Post_Fnc('pinterest');
            $SHONiR_youtube = SHONiR_Post_Fnc('youtube');
            $SHONiR_linkedin = SHONiR_Post_Fnc('linkedin');

            SHONiR_Settings_Update_Fnc('social', 'facebook', $SHONiR_facebook);
            SHONiR_Settings_Update_Fnc('social', 'skype', $SHONiR_skype);
            SHONiR_Settings_Update_Fnc('social', 'twitter', $SHONiR_twitter);
            SHONiR_Settings_Update_Fnc('social', 'instagram', $SHONiR_instagram);
            SHONiR_Settings_Update_Fnc('social', 'pinterest', $SHONiR_pinterest);
            SHONiR_Settings_Update_Fnc('social', 'youtube', $SHONiR_youtube);
            SHONiR_Settings_Update_Fnc('social', 'linkedin', $SHONiR_linkedin);

            $SHONiR_Alert['type'] = 'success';
            $SHONiR_Alert['message'] = 'Social settings has been updated successfully.';
            SHONiR_Session_Write_Fnc('SHONiR_Alert', $SHONiR_Alert);
    
            SHONiR_Redirect_Fnc(SHONiR_APANEL.'Settings');


        }elseif($SHONiR_Second == 'Other'){

            $SHONiR_visitors = SHONiR_Post_Fnc('visitors');
            $SHONiR_pageviews = SHONiR_Post_Fnc('pageviews');
            $SHONiR_copyrights = SHONiR_Post_Fnc('copyrights');
            $SHONiR_ssl = SHONiR_Post_Fnc('ssl');
            $SHONiR_www = SHONiR_Post_Fnc('www');
            $SHONiR_auto_watermark = SHONiR_Post_Fnc('auto_watermark');
            $SHONiR_auto_resize = SHONiR_Post_Fnc('auto_resize');
            $SHONiR_cache = SHONiR_Post_Fnc('cache');
            $SHONiR_sef = SHONiR_Post_Fnc('sef');
            $SHONiR_error_reporting = SHONiR_Post_Fnc('error_reporting');
            $SHONiR_large_image = SHONiR_Post_Fnc('large_image');
            $SHONiR_small_image = SHONiR_Post_Fnc('small_image');
            $SHONiR_cache_life = SHONiR_Post_Fnc('cache_life');
            $SHONiR_adjust = SHONiR_Post_Fnc('adjust');
            $SHONiR_records_limit = SHONiR_Post_Fnc('records_limit');
            $SHONiR_pages_limit = SHONiR_Post_Fnc('pages_limit');

            $SHONiR_logo = $_FILES['logo'];
            $SHONiR_logo_name = $SHONiR_logo['name'];

            $SHONiR_logo_pos = strrpos($SHONiR_logo_name, '.');

 if(empty($SHONiR_logo_name) && empty($SHONiR_logo_pos)){

 $SHONiR_logo_final = '';

 }else{

  $SHONiR_logo_extension = substr($SHONiR_logo_name, $SHONiR_logo_pos, strlen($SHONiR_logo_name));  

  $SHONiR_logo_final = SHONiR_Slug_Fnc(str_replace($SHONiR_logo_extension, '', $SHONiR_logo_name));

 $SHONiR_logo_final = $SHONiR_logo_final."-".SHONiR_Counter_Fnc('uploads').$SHONiR_logo_extension;

}

if($SHONiR_logo_final)
{

move_uploaded_file($SHONiR_logo["tmp_name"], SHONiR_ROOT.'media/uploads/'.$SHONiR_logo_final);

if (file_exists(SHONiR_ROOT.'media/uploads/'.SHONiR_SETTINGS['config_logo'])) { unlink (SHONiR_ROOT.'media/uploads/'.SHONiR_SETTINGS['config_logo']); } 

}else{

    $SHONiR_logo_final = SHONiR_SETTINGS['config_logo'];

}

$SHONiR_icon = $_FILES['icon'];
            $SHONiR_icon_name = $SHONiR_icon['name'];

            $SHONiR_icon_pos = strrpos($SHONiR_icon_name, '.');

 if(empty($SHONiR_icon_name) && empty($SHONiR_icon_pos)){

 $SHONiR_icon_final = '';

 }else{

  $SHONiR_icon_extension = substr($SHONiR_icon_name, $SHONiR_icon_pos, strlen($SHONiR_icon_name));  

  $SHONiR_icon_final = SHONiR_Slug_Fnc(str_replace($SHONiR_icon_extension, '', $SHONiR_icon_name));

 $SHONiR_icon_final = $SHONiR_icon_final."-".SHONiR_Counter_Fnc('uploads').$SHONiR_icon_extension;

}

if($SHONiR_icon_final)
{

move_uploaded_file($SHONiR_icon["tmp_name"], SHONiR_ROOT.'media/uploads/'.$SHONiR_icon_final);

if (file_exists(SHONiR_ROOT.'media/uploads/'.SHONiR_SETTINGS['config_icon'])) { unlink (SHONiR_ROOT.'media/uploads/'.SHONiR_SETTINGS['config_icon']); } 

}else{

    $SHONiR_icon_final = SHONiR_SETTINGS['config_icon'];

}

$SHONiR_watermark = $_FILES['watermark'];
            $SHONiR_watermark_name = $SHONiR_watermark['name'];

            $SHONiR_watermark_pos = strrpos($SHONiR_watermark_name, '.');

 if(empty($SHONiR_watermark_name) && empty($SHONiR_watermark_pos)){

 $SHONiR_watermark_final = '';

 }else{

  $SHONiR_watermark_extension = substr($SHONiR_watermark_name, $SHONiR_watermark_pos, strlen($SHONiR_watermark_name));  

  $SHONiR_watermark_final = SHONiR_Slug_Fnc(str_replace($SHONiR_watermark_extension, '', $SHONiR_watermark_name));

 $SHONiR_watermark_final = $SHONiR_watermark_final."-".SHONiR_Counter_Fnc('uploads').$SHONiR_watermark_extension;

}

if($SHONiR_watermark_final)
{

move_uploaded_file($SHONiR_watermark["tmp_name"], SHONiR_ROOT.'media/uploads/'.$SHONiR_watermark_final);

if (file_exists(SHONiR_ROOT.'media/uploads/'.SHONiR_SETTINGS['config_watermark'])) { unlink (SHONiR_ROOT.'media/uploads/'.SHONiR_SETTINGS['config_watermark']); } 

}else{

    $SHONiR_watermark_final = SHONiR_SETTINGS['config_watermark'];

}

$SHONiR_loader = $_FILES['loader'];
            $SHONiR_loader_name = $SHONiR_loader['name'];

            $SHONiR_loader_pos = strrpos($SHONiR_loader_name, '.');

 if(empty($SHONiR_loader_name) && empty($SHONiR_loader_pos)){

 $SHONiR_loader_final = '';

 }else{

  $SHONiR_loader_extension = substr($SHONiR_loader_name, $SHONiR_loader_pos, strlen($SHONiR_loader_name));  

  $SHONiR_loader_final = SHONiR_Slug_Fnc(str_replace($SHONiR_loader_extension, '', $SHONiR_loader_name));

 $SHONiR_loader_final = $SHONiR_loader_final."-".SHONiR_Counter_Fnc('uploads').$SHONiR_loader_extension;

}

if($SHONiR_loader_final)
{

move_uploaded_file($SHONiR_loader["tmp_name"], SHONiR_ROOT.'media/uploads/'.$SHONiR_loader_final);

if (file_exists(SHONiR_ROOT.'media/uploads/'.SHONiR_SETTINGS['config_loader'])) { unlink (SHONiR_ROOT.'media/uploads/'.SHONiR_SETTINGS['config_loader']); } 

}else{

    $SHONiR_loader_final = SHONiR_SETTINGS['config_loader'];

}

            SHONiR_Settings_Update_Fnc('counter', 'visitors', $SHONiR_visitors);
            SHONiR_Settings_Update_Fnc('counter', 'pageviews', $SHONiR_pageviews);
            SHONiR_Settings_Update_Fnc('config', 'copyrights', $SHONiR_copyrights);
            SHONiR_Settings_Update_Fnc('config', 'ssl', $SHONiR_ssl);
            SHONiR_Settings_Update_Fnc('config', 'www', $SHONiR_www);
            SHONiR_Settings_Update_Fnc('config', 'auto_watermark', $SHONiR_auto_watermark);
            SHONiR_Settings_Update_Fnc('config', 'auto_resize', $SHONiR_auto_resize);
            SHONiR_Settings_Update_Fnc('config', 'cache', $SHONiR_cache);
            SHONiR_Settings_Update_Fnc('config', 'sef', $SHONiR_sef);
            SHONiR_Settings_Update_Fnc('config', 'error_reporting', $SHONiR_error_reporting);
            SHONiR_Settings_Update_Fnc('config', 'large_image', $SHONiR_large_image);
            SHONiR_Settings_Update_Fnc('config', 'small_image', $SHONiR_small_image);
            SHONiR_Settings_Update_Fnc('config', 'cache_life', $SHONiR_cache_life);
            SHONiR_Settings_Update_Fnc('config', 'adjust', $SHONiR_adjust);
            SHONiR_Settings_Update_Fnc('config', 'records_limit', $SHONiR_records_limit);
            SHONiR_Settings_Update_Fnc('config', 'pages_limit', $SHONiR_pages_limit);
            SHONiR_Settings_Update_Fnc('config', 'logo', $SHONiR_logo_final);
           SHONiR_Settings_Update_Fnc('config', 'icon', $SHONiR_icon_final);
           SHONiR_Settings_Update_Fnc('config', 'watermark', $SHONiR_watermark_final);
            SHONiR_Settings_Update_Fnc('config', 'loader', $SHONiR_loader_final);
           

            $SHONiR_Alert['type'] = 'success';
            $SHONiR_Alert['message'] = 'Other settings has been updated successfully.';
            SHONiR_Session_Write_Fnc('SHONiR_Alert', $SHONiR_Alert);
    
            SHONiR_Redirect_Fnc(SHONiR_APANEL.'Settings');
    
        }


    }else{

        $SHONiR_Alert['type'] = 'error';
        $SHONiR_Alert['message'] = 'Please make sure your browser has cookies enabled and try again.';
        SHONiR_Session_Write_Fnc('SHONiR_Alert', $SHONiR_Alert);

     }

    }

    

    if($SHONiR_Second == 'Code'){           

        $SHONiR_Main['meta_title'] = 'Code | Settings | SHONiR Administrator Panel | Created with LOVE by SHONiR';

        $SHONiR_Main['meta_description'] = '';
        
        $SHONiR_Main['meta_keyword'] = '';

        $SHONiR_Main['SHONiR_CSRF'] = SHONiR_CSRF_Fnc('G');

        $SHONiR_Main['page_heading'] = 'HTML Code';

    }elseif($SHONiR_Second == 'SMTP'){

        $SHONiR_Main['meta_title'] = 'Sending Email Server | Settings | SHONiR Administrator Panel | Created with LOVE by SHONiR';

        $SHONiR_Main['meta_description'] = '';
        
        $SHONiR_Main['meta_keyword'] = '';

        $SHONiR_Main['SHONiR_CSRF'] = SHONiR_CSRF_Fnc('G');

        $SHONiR_Main['page_heading'] = 'Sending Email Server';

    }elseif($SHONiR_Second == 'Website'){

        $SHONiR_Main['meta_title'] = 'Website Information | Settings | SHONiR Administrator Panel | Created with LOVE by SHONiR';

        $SHONiR_Main['meta_description'] = '';
        
        $SHONiR_Main['meta_keyword'] = '';

        $SHONiR_Main['SHONiR_CSRF'] = SHONiR_CSRF_Fnc('G');

        $SHONiR_Main['page_heading'] = 'Website Information';
        
    }elseif($SHONiR_Second == 'Social'){

        $SHONiR_Main['meta_title'] = 'Social | Settings | SHONiR Administrator Panel | Created with LOVE by SHONiR';

        $SHONiR_Main['meta_description'] = '';
        
        $SHONiR_Main['meta_keyword'] = '';

        $SHONiR_Main['SHONiR_CSRF'] = SHONiR_CSRF_Fnc('G');

        $SHONiR_Main['page_heading'] = 'Social Networking';

    }elseif($SHONiR_Second == 'Other'){

        $SHONiR_Main['meta_title'] = 'Other | Settings | SHONiR Administrator Panel | Created with LOVE by SHONiR';

        $SHONiR_Main['meta_description'] = '';
        
        $SHONiR_Main['meta_keyword'] = '';

        $SHONiR_Main['SHONiR_CSRF'] = SHONiR_CSRF_Fnc('G');

        $SHONiR_Main['page_heading'] = 'Other';

    }else{
        

        $SHONiR_Main['meta_title'] = 'Settings | SHONiR Administrator Panel | Created with LOVE by SHONiR';

        $SHONiR_Main['meta_description'] = '';
        
        $SHONiR_Main['meta_keyword'] = '';

    }

    $SHONiR_Data["SHONiR_Main"] =  $SHONiR_Main;    

return $SHONiR_Data;

}


        ?>   