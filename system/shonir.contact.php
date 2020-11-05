<?php defined('SHONiR') OR exit('No direct script access allowed');

function SHONiR_Contact_Fnc_Render(){

    $SHONiR_CSRF = SHONiR_Post_Fnc('SHONiR_CSRF');

    $SHONiR_Captcha = SHONiR_Post_Fnc('captcha');    

    if($SHONiR_CSRF){

        if(SHONiR_CSRF_Fnc($SHONiR_CSRF)){

            if(SHONiR_Captcha_Fnc_Render($SHONiR_Captcha)){ 

                $SHONiR_country = SHONiR_Countries_Fnc(SHONiR_Post_Fnc('country'));
$SHONiR_country = $SHONiR_country[0]['name'];

$SHONiR_region = SHONiR_Regions_Fnc(SHONiR_Post_Fnc('region'));
$SHONiR_region = $SHONiR_region[0]['name'];

$SHONiR_city = SHONiR_Cities_Fnc(SHONiR_Post_Fnc('city'));
$SHONiR_city = $SHONiR_city[0]['name'];
                
    $SHONiR_Subject = 'Web Message: '.SHONiR_Post_Fnc('name');
    $SHONiR_Message = '<p> <p><b>Name:</b> '.SHONiR_Post_Fnc('name').'</p>  <p><b>Email:</b> '.SHONiR_Post_Fnc('email').'</p>  <p><b>Mobile:</b> '.SHONiR_Post_Fnc('mobile').'</p> <p><b>Country:</b> '.$SHONiR_country.'</p> <p><b>Region:</b> '.$SHONiR_region.'</p> <p><b>City:</b> '.$SHONiR_city.'</p> <p><b>Message:</b> '.SHONiR_T2H_Fnc(SHONiR_Post_Fnc('message')).'</p>   <p><b>IP Address:</b> '.SHONiR_IP_Fnc().'</p></p>';
    
    SHONiR_Mail_Fnc_Render(SHONiR_SETTINGS['website_email'], SHONiR_SETTINGS['website_contact_name'], $SHONiR_Subject, $SHONiR_Message);

    SHONiR_Mail_Fnc_Render(SHONiR_Post_Fnc('email'), SHONiR_Post_Fnc('name'), 'Copy of '.$SHONiR_Subject, $SHONiR_Message);
    
    $SHONiR_Alert['type'] = 'success';
    $SHONiR_Alert['message'] = 'Thank you for your message. We will get back to you as soon as possible.';
    SHONiR_Session_Write_Fnc('SHONiR_Alert', $SHONiR_Alert);
   SHONiR_Redirect_Fnc(SHONiR_BASE);          


}else{

    $SHONiR_Alert['type'] = 'error';
    $SHONiR_Alert['message'] = 'You entered an incorrect CAPTCHA. Please try again.';
    SHONiR_Session_Write_Fnc('SHONiR_Alert', $SHONiR_Alert);

 }

        }else{

            $SHONiR_Alert['type'] = 'error';
            $SHONiR_Alert['message'] = 'Please make sure your browser has cookies enabled and try again.';
            SHONiR_Session_Write_Fnc('SHONiR_Alert', $SHONiR_Alert);
    
         }


    }

    $SHONiR_Main = SHONiR_Page_Details_Fnc(14, ' and p.status=1 ', SHONiR_LANGUAGE['language_id']);

    $SHONiR_Main['SHONiR_CSRF'] = SHONiR_CSRF_Fnc('G');

    $SHONiR_Data["Categories_Tree"] = SHONiR_Categories_Tree_Fnc(0, 'c.status=1 and c.listed=1', SHONiR_LANGUAGE['language_id']);

    $SHONiR_Data["Pages_Tree"] = SHONiR_Pages_Tree_Fnc(0, 'p.status=1 and p.listed=1', SHONiR_LANGUAGE['language_id']);

    $SHONiR_Data["Recently_Viewed_Products"] = SHONiR_Get_Products_Fnc(TRUE,0, "p.status=1 and p.listed=1", "p.last_hit", "desc", SHONiR_SETTINGS['config_records_limit']);

    $SHONiR_Data["Main_Banners"] = SHONiR_Get_Banners_Fnc(TRUE, TRUE, "parent_id='contact' and b.status=1  and b.listed=1 ", 'b.viewed', 'asc');

    $SHONiR_Data["SHONiR_Main"] =  $SHONiR_Main;

    return $SHONiR_Data;

}




?>