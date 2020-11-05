<?php defined('SHONiR') OR exit('No direct script access allowed');

function SHONiR_Reviews_Fnc_Render(){

$SHONiR_Second = SHONiR_URI['Second'];

$SHONiR_Third = SHONiR_URI['Third'];

$SHONiR_ID = SHONiR_URI['ID'];

$SHONiR_CSRF = SHONiR_Post_Fnc('SHONiR_CSRF');

     $SHONiR_Captcha = SHONiR_Post_Fnc('captcha'); 

    if($SHONiR_Second === "feedback"){

        if($SHONiR_CSRF){

            if(SHONiR_CSRF_Fnc($SHONiR_CSRF)){

                if(SHONiR_Captcha_Fnc_Render($SHONiR_Captcha)){


                    $SHONiR_country = SHONiR_Countries_Fnc(SHONiR_Post_Fnc('country'));
                    $SHONiR_country = $SHONiR_country[0]['name'];


                    $SHONiR_Subject = 'Web Feedback: '.SHONiR_Post_Fnc('name');
                    $SHONiR_Message = '<p> <p><b>Name:</b> '.SHONiR_Post_Fnc('name').'</p>  <p><b>Email:</b> '.SHONiR_Post_Fnc('email').'</p> <p><b>Country:</b> '.$SHONiR_country.'</p> <p><b>Reference#:</b> '.SHONiR_Post_Fnc('reference').'</p>  <p><b>Subject:</b> '.SHONiR_Post_Fnc('subject').'</p>  <p><b>Details:</b> '.SHONiR_T2H_Fnc(SHONiR_Post_Fnc('details')).'</p>   <p><b>Packaging:</b> '.SHONiR_Post_Fnc('packaging').'</p>  <p><b>Quality:</b> '.SHONiR_Post_Fnc('quality').'</p>  <p><b>Money:</b> '.SHONiR_Post_Fnc('money').'</p>  <p><b>Responsive:</b> '.SHONiR_Post_Fnc('responsive').'</p>  <p><b>Production:</b> '.SHONiR_Post_Fnc('production').'</p>  <p><b>Recommended:</b> '.SHONiR_Post_Fnc('recommended').'</p>     <p><b>IP Address:</b> '.SHONiR_IP_Fnc().'</p></p>';
                
                   SHONiR_Mail_Fnc_Render(SHONiR_SETTINGS['website_email'], SHONiR_SETTINGS['website_contact_name'], $SHONiR_Subject, $SHONiR_Message);

                    SHONiR_Query_Fnc("insert into tbl_comments (details, name, email, parent_type, subject, packaging, quality, money, responsive, production, recommended, reference, add_ip, user_id, user_type, add_time) values ('". SHONiR_T2H_Fnc(SHONiR_Post_Fnc('details'))."', '".SHONiR_Post_Fnc('name')."', '".SHONiR_Post_Fnc('email')."', 'feedback', '".SHONiR_Post_Fnc('subject')."', '".SHONiR_Post_Fnc('packaging')."', '".SHONiR_Post_Fnc('quality')."', '".SHONiR_Post_Fnc('money')."', '".SHONiR_Post_Fnc('responsive')."', '".SHONiR_Post_Fnc('production')."', '".SHONiR_Post_Fnc('recommended')."', '".SHONiR_Post_Fnc('reference')."', '".SHONiR_IP."', ".SHONiR_USER['user_id'].", ".SHONiR_USER['user_type'].", ".time()." )");

                    $SHONiR_Alert['type'] = 'success';
                    $SHONiR_Alert['message'] = 'Thank you for having taken your time to provide us with your valuable feedback. <b>We will use your feedback for future improvement.</b>';
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

    $SHONiR_Main['SHONiR_CSRF'] = SHONiR_CSRF_Fnc('G');

    $SHONiR_Main = SHONiR_Page_Details_Fnc(13, ' and p.status=1 ', SHONiR_LANGUAGE['language_id']);

    $SHONiR_Main['SHONiR_CSRF'] = SHONiR_CSRF_Fnc('G');

    $SHONiR_Data["Categories_Tree"] = SHONiR_Categories_Tree_Fnc(0, 'c.status=1 and c.listed=1', SHONiR_LANGUAGE['language_id']);

    $SHONiR_Data["Pages_Tree"] = SHONiR_Pages_Tree_Fnc(0, 'p.status=1 and p.listed=1', SHONiR_LANGUAGE['language_id']);

    $SHONiR_Data["Recently_Viewed_Products"] = SHONiR_Get_Products_Fnc(TRUE,0, "p.status=1 and p.listed=1", "p.last_hit", "desc", SHONiR_SETTINGS['config_records_limit']);

    $SHONiR_Data["Main_Banners"] = SHONiR_Get_Banners_Fnc(TRUE, TRUE, "parent_id='feedback' and b.status=1  and b.listed=1 ", 'b.viewed', 'asc');

    $SHONiR_Data["SHONiR_Main"] =  $SHONiR_Main;
                    
    $GLOBALS['SHONiR_VIEWS_FILE'] = 'reviews_feedback';

                    return $SHONiR_Data;


    }else{

        $SHONiR_Alert['type'] = 'error';
$SHONiR_Alert['message'] = '<b>Nothing Found!</b> Your requested record not exist in database.';
SHONiR_Session_Write_Fnc('SHONiR_Alert', $SHONiR_Alert);
SHONiR_Redirect_Fnc(SHONiR_BASE); 


    }


}

?>