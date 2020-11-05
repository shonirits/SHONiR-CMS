<?php defined('SHONiR') OR exit('No direct script access allowed');

function SHONiR_Custom_Fnc_Render(){

    $SHONiR_Second = SHONiR_URI['Second'];

    $SHONiR_Third = SHONiR_URI['Third'];

    $SHONiR_ID = SHONiR_URI['ID'];

    $SHONiR_CSRF = SHONiR_Post_Fnc('SHONiR_CSRF');

     $SHONiR_Captcha = SHONiR_Post_Fnc('captcha'); 

    if($SHONiR_Second === "enquiry"){

        if($SHONiR_CSRF){

            if(SHONiR_CSRF_Fnc($SHONiR_CSRF)){

                if(SHONiR_Captcha_Fnc_Render($SHONiR_Captcha)){

                    $SHONiR_country = SHONiR_Countries_Fnc(SHONiR_Post_Fnc('country'));
                    $SHONiR_country = $SHONiR_country[0]['name'];

                    $SHONiR_region = SHONiR_Regions_Fnc(SHONiR_Post_Fnc('region'));
                    $SHONiR_region = $SHONiR_region[0]['name'];

                    $SHONiR_city = SHONiR_Cities_Fnc(SHONiR_Post_Fnc('city'));
                    $SHONiR_city = $SHONiR_city[0]['name'];

                    $SHONiR_Order = SHONiR_Counter_Fnc('order');

                    $SHONiR_Query_Uploads = SHONiR_Query_Fnc("select * from tbl_uploads where token='".$SHONiR_CSRF."' order by sort_order asc;" );

                    $SHONiR_Message_Extra = '';
    
      $SHONiR_Row_Uploads = SHONiR_Row_Fnc($SHONiR_Query_Uploads);
    
      if($SHONiR_Row_Uploads > 0 ){
    
        while($SHONiR_Fetch_Uploads = SHONiR_Fetch_Fnc($SHONiR_Query_Uploads))
        {
            if (file_exists(SHONiR_ROOT.'media/tmp/'.$SHONiR_Fetch_Uploads['upload_file'])){
                
                $SHONiR_token = '';

            SHONiR_Query_Fnc("update tbl_uploads set  parent_type='custom_enquiry', parent_id=".$SHONiR_Order." where  upload_id=".$SHONiR_Fetch_Uploads['upload_id']);
            rename(SHONiR_ROOT.'media/tmp/'.$SHONiR_Fetch_Uploads['upload_file'], SHONiR_ROOT.'media/uploads/custom/'.$SHONiR_Fetch_Uploads['upload_file']);
            $SHONiR_File = SHONiR_BASE.'media/uploads/custom/'.$SHONiR_Fetch_Uploads['upload_file'];
            $SHONiR_Message_Extra .= '<a href="'.$SHONiR_File.'" target="_blank">'.$SHONiR_File.'</a><br>';

            }else{

                SHONiR_Query_Fnc("delete from tbl_uploads where upload_id=".$SHONiR_Fetch_Uploads['upload_id']);

            }

        }

    }

    if($SHONiR_Message_Extra){

        $SHONiR_Message_Extra = "<hr/> <b>Attached Files:</b> <br/><p>".$SHONiR_Message_Extra.'</p>';

    }


                    $SHONiR_Subject = 'Web Custom Enquiry: '.SHONiR_Post_Fnc('ship_name');
    $SHONiR_Message = '<p> <p><b>Order#:</b> '.$SHONiR_Order.'</p>  <p><b>Name:</b> '.SHONiR_Post_Fnc('ship_name').'</p>  <p><b>Email:</b> '.SHONiR_Post_Fnc('ship_email').'</p>  <p><b>Mobile:</b> '.SHONiR_Post_Fnc('mobile').'</p>  <p><b>Company:</b> '.SHONiR_Post_Fnc('ship_company').'</p>  <p><b>Contract Term:</b> '.SHONiR_Post_Fnc('contract_term').'</p>  <p><b>Freight Forwarding:</b> '.SHONiR_Post_Fnc('freight_forwarding').'</p> <p><b>Country:</b> '.$SHONiR_country.'</p> <p><b>Region:</b> '.$SHONiR_region.'</p> <p><b>City:</b> '.$SHONiR_city.'</p> <p><b>Specifications:</b> '.SHONiR_T2H_Fnc(SHONiR_Post_Fnc('specifications')).'</p>   <p><b>Targets:</b> '.SHONiR_T2H_Fnc(SHONiR_Post_Fnc('targets')).'</p>   <p><b>Instructions:</b> '.SHONiR_T2H_Fnc(SHONiR_Post_Fnc('instructions')).'</p>   <p><b>IP Address:</b> '.SHONiR_IP_Fnc().'</p></p>'.$SHONiR_Message_Extra;

    SHONiR_Mail_Fnc_Render(SHONiR_SETTINGS['website_email'], SHONiR_SETTINGS['website_contact_name'], $SHONiR_Subject, $SHONiR_Message);

    SHONiR_Mail_Fnc_Render(SHONiR_Post_Fnc('ship_email'), SHONiR_Post_Fnc('ship_name'), 'Copy of '.$SHONiR_Subject, $SHONiR_Message);  


                    $SHONiR_Alert['type'] = 'success';
                    $SHONiR_Alert['message'] = '<b>Thank you for your enquiry.</b> It has been forwarded to the relevant department and will be dealt with as soon as possible.';
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

    $SHONiR_Main = SHONiR_Page_Details_Fnc(17, ' and p.status=1 ', SHONiR_LANGUAGE['language_id']);

    $SHONiR_Main['SHONiR_CSRF'] = SHONiR_CSRF_Fnc('G');

    $SHONiR_Data["Categories_Tree"] = SHONiR_Categories_Tree_Fnc(0, 'c.status=1 and c.listed=1', SHONiR_LANGUAGE['language_id']);

    $SHONiR_Data["Pages_Tree"] = SHONiR_Pages_Tree_Fnc(0, 'p.status=1 and p.listed=1', SHONiR_LANGUAGE['language_id']);

    $SHONiR_Data["Recently_Viewed_Products"] = SHONiR_Get_Products_Fnc(TRUE,0, "p.status=1 and p.listed=1", "p.last_hit", "desc", SHONiR_SETTINGS['config_records_limit']);

    $SHONiR_Data["Main_Banners"] = SHONiR_Get_Banners_Fnc(TRUE, TRUE, "parent_id='custom_enquiry' and b.status=1  and b.listed=1 ", 'b.viewed', 'asc');

    $SHONiR_Data["SHONiR_Main"] =  $SHONiR_Main;
                    
    $GLOBALS['SHONiR_VIEWS_FILE'] = 'custom_enquiry';

                    return $SHONiR_Data;

                }else{

                    $SHONiR_Alert['type'] = 'error';
    $SHONiR_Alert['message'] = '<b>Nothing Found!</b> Your requested record not exist in database.';
    SHONiR_Session_Write_Fnc('SHONiR_Alert', $SHONiR_Alert);
   SHONiR_Redirect_Fnc(SHONiR_BASE); 


                }

}


?>