<?php defined('SHONiR') OR exit('No direct script access allowed');

function SHONiR_Checkout_Fnc_Render(){

    $SHONiR_Main = SHONiR_Page_Details_Fnc(15, ' and p.status=1 ', SHONiR_LANGUAGE['language_id']);  
    
    if(!$SHONiR_Main){

        SHONiR_Redirect_Fnc(SHONiR_BASE.'Cart');

    }

    $SHONiR_Main['SHONiR_Cart'] = SHONiR_Cart_Details_Fnc('session_id', $GLOBALS['SHONiR_SESSION_ID']);

    if(!isset($SHONiR_Main['SHONiR_Cart']['Items']) || $SHONiR_Main['SHONiR_Cart']['Items'] < 1){

        SHONiR_Redirect_Fnc(SHONiR_BASE.'Cart');

    }

    $SHONiR_CSRF = SHONiR_Post_Fnc('SHONiR_CSRF');

    $SHONiR_Captcha = SHONiR_Post_Fnc('captcha');

    if($SHONiR_CSRF){     

        if(SHONiR_CSRF_Fnc($SHONiR_CSRF)){

            if(SHONiR_Captcha_Fnc_Render($SHONiR_Captcha)){     
                
              
                $SHONiR_ship_name = SHONiR_Post_Fnc('ship_name');
                $SHONiR_ship_email = SHONiR_Post_Fnc('ship_email');
                $SHONiR_ship_cell = SHONiR_Get_Number_Fnc(SHONiR_Post_Fnc('ship_cell'));
                $SHONiR_ship_address1 = SHONiR_Post_Fnc('ship_address1');
                $SHONiR_ship_address2 = SHONiR_Post_Fnc('ship_address2');
                $SHONiR_ship_postcode = SHONiR_Post_Fnc('ship_postcode');
                $SHONiR_ship_country_id = SHONiR_Post_Fnc('ship_country_id');
                $SHONiR_ship_region_id = SHONiR_Post_Fnc('ship_region_id');
                $SHONiR_ship_city_id = SHONiR_Post_Fnc('ship_city_id');

                $SHONiR_same_address = SHONiR_Post_Fnc('same_address');

                if($SHONiR_same_address){

                $SHONiR_bill_name = $SHONiR_ship_name ;
                $SHONiR_bill_email = $SHONiR_ship_email;
                $SHONiR_bill_cell = $SHONiR_ship_cell;
                $SHONiR_bill_address1 = $SHONiR_ship_address1;
                $SHONiR_bill_address2 = $SHONiR_ship_address2;
                $SHONiR_bill_postcode = $SHONiR_ship_postcode;
                $SHONiR_bill_country_id = $SHONiR_ship_country_id;
                $SHONiR_bill_region_id = $SHONiR_ship_region_id;
                $SHONiR_bill_city_id = $SHONiR_ship_city_id;

                }else{

                $SHONiR_bill_name = SHONiR_Post_Fnc('bill_name');
                $SHONiR_bill_email = SHONiR_Post_Fnc('bill_email');
                $SHONiR_bill_cell = SHONiR_Get_Number_Fnc(SHONiR_Post_Fnc('bill_cell'));
                $SHONiR_bill_address1 = SHONiR_Post_Fnc('bill_address1');
                $SHONiR_bill_address2 = SHONiR_Post_Fnc('bill_address2');
                $SHONiR_bill_postcode = SHONiR_Post_Fnc('bill_postcode');
                $SHONiR_bill_country_id = SHONiR_Post_Fnc('bill_country_id');
                $SHONiR_bill_region_id = SHONiR_Post_Fnc('bill_region_id');
                $SHONiR_bill_city_id = SHONiR_Post_Fnc('bill_city_id');

                }

                $SHONiR_shipping_method = SHONiR_Post_Fnc('shipping_method');
                $SHONiR_payment_method = SHONiR_Post_Fnc('payment_method');
                $SHONiR_gift_cover = SHONiR_Post_Fnc('gift_cover');
                $SHONiR_tag_card = SHONiR_Post_Fnc('tag_card');
                $SHONiR_tag_card_text = SHONiR_T2H_Fnc(SHONiR_Post_Fnc('tag_card_text'));
                $SHONiR_user_comments = SHONiR_T2H_Fnc(SHONiR_Post_Fnc('user_comments'));

                SHONiR_New_Order_Fnc($SHONiR_Main['SHONiR_Cart']['Products'], $SHONiR_ship_name, $SHONiR_ship_email, $SHONiR_ship_cell, $SHONiR_ship_address1, $SHONiR_ship_address2, $SHONiR_ship_postcode, $SHONiR_ship_country_id, $SHONiR_ship_region_id, $SHONiR_ship_city_id, $SHONiR_bill_name, $SHONiR_bill_email, $SHONiR_bill_cell, $SHONiR_bill_address1, $SHONiR_bill_address2, $SHONiR_bill_postcode, $SHONiR_bill_country_id, $SHONiR_bill_region_id, $SHONiR_bill_city_id, $SHONiR_shipping_method, $SHONiR_payment_method, $SHONiR_gift_cover, $SHONiR_tag_card, $SHONiR_tag_card_text, SHONiR_USER['user_id'], SHONiR_USER['user_type'], $SHONiR_user_comments);

                SHONiR_Cart_Empty_Fnc();
                    
                $SHONiR_Alert['type'] = 'success';
                $SHONiR_Alert['message'] = '<b>Thank You!</b> Your order has been placed and is being processed. We will get back to you as soon as possible.';
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

    $SHONiR_Data["Categories_Tree"] = SHONiR_Categories_Tree_Fnc(0, 'c.status=1 and c.listed=1', SHONiR_LANGUAGE['language_id']);

    $SHONiR_Data["Pages_Tree"] = SHONiR_Pages_Tree_Fnc(0, 'p.status=1 and p.listed=1', SHONiR_LANGUAGE['language_id']);

    $SHONiR_Data["Recently_Viewed_Products"] = SHONiR_Get_Products_Fnc(TRUE, 0, "p.status=1 and p.listed=1", "p.last_hit", "desc", SHONiR_SETTINGS['config_records_limit']);

    $SHONiR_Data["SHONiR_Main"] =  $SHONiR_Main;

    return $SHONiR_Data;

}




?>