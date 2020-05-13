<?php defined('SHONiR') OR exit('No direct script access allowed');

require("vendor/phpmailer/phpmailer/src/PHPMailer.php");
require("vendor/phpmailer/phpmailer/src/SMTP.php");
require("vendor/phpmailer/phpmailer/src/Exception.php");


use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\SMTP;
use PHPMailer\PHPMailer\Exception;

function SHONiR_Ajax_Fnc_Render(){

$SHONiR_last_try = time()-3600;
$SHONiR_mail_sent = time()-10;
$SHONiR_Error = FALSE;
$SHONiR_Main_Rand = (bool)rand(0,1);


/* $SHONiR_Query = SHONiR_Query_Fnc("select * from tbl_products order by product_id asc;");

$SHONiR_Row = SHONiR_Row_Fnc($SHONiR_Query);

if($SHONiR_Row > 0 ){

  while($row =  SHONiR_Fetch_Fnc($SHONiR_Query))
{


$SHONiR_Reference = SHONiR_Reference_Fnc();

SHONiR_Query_Fnc("update tbl_products set  reference ='". $SHONiR_Reference ."' where product_id=".$row['product_id']);

}

}
exit; */

if(SHONiR_SETTINGS['time_mail_sent']<$SHONiR_mail_sent && $SHONiR_Main_Rand == 1){

   SHONiR_Query_Fnc("update tbl_settings set setting_value='".time()."' where setting_code='time' and setting_key='mail_sent'");

   $SHONiR_Query_Mail = SHONiR_Query_Fnc("select * from tbl_mails where status=0 and total_try<24 and last_try<".$SHONiR_last_try." ORDER BY RAND() LIMIT 1");

   $SHONiR_Row_Mail = SHONiR_Row_Fnc($SHONiR_Query_Mail);

   if($SHONiR_Row_Mail > 0){

    $SHONiR_Record_Mail = SHONiR_Fetch_Fnc($SHONiR_Query_Mail);

    SHONiR_Query_Fnc("update tbl_mails set last_try=".time()." where mail_id=".$SHONiR_Record_Mail['mail_id']);

$mail = new PHPMailer;

try {

    $mail->isSMTP();
    $mail->Host       = SHONiR_SETTINGS['smtp_host'];
    $mail->SMTPAuth   = true;
    $mail->Username   = SHONiR_SETTINGS['smtp_username'];
    $mail->Password   = SHONiR_SETTINGS['smtp_password'];
    if(SHONiR_SETTINGS['smtp_encryption'] === 'tls') {
    $mail->SMTPSecure = PHPMailer::ENCRYPTION_STARTTLS;
    }
    $mail->Port       = SHONiR_SETTINGS['smtp_port'];

    $mail->setFrom(SHONiR_SETTINGS['smtp_from'], SHONiR_SETTINGS['website_company']);
    $mail->addAddress($SHONiR_Record_Mail['email'], $SHONiR_Record_Mail['name']);
    if($SHONiR_Record_Mail['html']){
    $mail->isHTML(true);
    }
    $mail->Subject = $SHONiR_Record_Mail['subject'];
    $mail->Body = $SHONiR_Record_Mail['message'];

    if(!$mail->send()) {

        $SHONiR_Error = "Mailer Error: ".$mail->ErrorInfo;

        SHONiR_Query_Fnc("update tbl_mails set status=0, total_try=(total_try+1), last_error='".$SHONiR_Error."',  last_try=".time()." where mail_id=".$SHONiR_Record_Mail['mail_id']);

      } else {

        SHONiR_Query_Fnc("update tbl_mails set status=1, last_try=".time()." where mail_id=".$SHONiR_Record_Mail['mail_id']);

      }

} catch (Exception $e) {

    $SHONiR_Error = "Mailer Error: ".$mail->ErrorInfo;

    SHONiR_Query_Fnc("update tbl_mails set status=0, total_try=(total_try+1), last_error='".$SHONiR_Error."', last_try=".time()." where mail_id=".$SHONiR_Record_Mail['mail_id']);

}

}

}


    if(SHONiR_Is_Ajax_Fnc() === FALSE){
       die("Access denied - Look like your request is unsecure or invalid. Please reload the page and try again.");
        }

    $SHONiR_Second = SHONiR_URI['Second'];

    $SHONiR_Third = SHONiR_URI['Third'];

    $SHONiR_ID = SHONiR_URI['ID'];


    if($SHONiR_Second === "AP" && $SHONiR_Third == "Login" && (SHONiR_Post_Fnc('username') && SHONiR_Post_Fnc('password'))){

        $GLOBALS['SHONiR_CACHE'] = FALSE;

    $SHONiR_Username = SHONiR_Post_Fnc('username');
    $SHONiR_Password = SHONiR_Post_Fnc('password');
    $SHONiR_Remember = SHONiR_Post_Fnc('remember');

    echo SHONiR_AP_Login_Fnc($SHONiR_Username, md5($SHONiR_Password), $SHONiR_Remember);


    $GLOBALS['SHONiR_RENDER'] = FALSE;

    }elseif($SHONiR_Second == "Email" && ($SHONiR_Third == "Subscribe" || $SHONiR_Third == "UnSubscribe" ) &&  SHONiR_Post_Fnc('email', FILTER_VALIDATE_EMAIL)){

        $GLOBALS['SHONiR_CACHE'] = FALSE;

        $SHONiR_Email = SHONiR_Post_Fnc('email');

        $SHONiR_Query_Email = SHONiR_Query_Fnc("select * from tbl_emails where email='".$SHONiR_Email."'");

        $SHONiR_Row_Email = SHONiR_Row_Fnc($SHONiR_Query_Email);

        if($SHONiR_Third == 'Subscribe'){

            if($SHONiR_Row_Email > 0){

 SHONiR_Query_Fnc("update tbl_emails set unsubscribe=0, add_time=".time().", add_ip='".SHONiR_IP."' where email='".$SHONiR_Email."'");

            }else{

                SHONiR_Query_Fnc("insert into tbl_emails (email, add_time, add_ip) values ('".$SHONiR_Email."', ".time().", '".SHONiR_IP."' )");

            }

            echo '<div class="alert alert-success" role="alert"><b>Congratulations!</b> You have successfully add your email to our mailing list and subscribed to our newsletter.</div>';


        echo '<p>If you don\'t want to receive our newsletter anymore, then please <button type="button" onclick="SHONiR_Subscribe_Fnc(\''.$SHONiR_Email.'\')" class="btn btn-link">click here</button> to unsubscribe your email address. </p>';


        }else{

            if($SHONiR_Row_Email > 0){

                SHONiR_Query_Fnc("update tbl_emails set unsubscribe=1, unsubscribe_time=".time().", unsubscribe_ip='".SHONiR_IP."' where email='".$SHONiR_Email."'");


                echo '<div class="alert alert-warning" role="alert"><b>Congratulations!</b> Your email has been removed unsubscribe from our newsletter. </div>';

            }else{

                echo '<div class="alert alert-danger" role="alert"><b>Oops!</b> Your email is not existing in our mailing list.</div>';


            }


        }



            $GLOBALS['SHONiR_RENDER'] = FALSE;
          }elseif($SHONiR_Second === "Countries"){

            $SHONiR_country_id = SHONiR_Post_Fnc('country_id');

            $SHONiR_Column = '';

            if($SHONiR_country_id){

              $SHONiR_ID = $SHONiR_country_id;

              $SHONiR_Column = "id";

            }

            $Countries = SHONiR_Countries_Fnc($SHONiR_ID, $SHONiR_Column);

            if($Countries){
              echo '<option value="">Select Country</option>'; 
              foreach ($Countries as $Country_key => $Country_value)
    {
      echo '<option value="'.$Country_value['id'].'">'.$Country_value['name'].'</option>'; 
    }

            }else{

              echo '<option value="">Country not available</option>';
            }

            $GLOBALS['SHONiR_RENDER'] = FALSE;

          }elseif($SHONiR_Second === "Regions"){

            $SHONiR_country_id = SHONiR_Post_Fnc('country_id');

            $SHONiR_Column = '';

            if($SHONiR_country_id){

              $SHONiR_ID = $SHONiR_country_id;

              $SHONiR_Column = "country_id";

            }

            $Regions = SHONiR_Regions_Fnc($SHONiR_ID, $SHONiR_Column);

            if($Regions){
              echo '<option value="">Select State</option>'; 
              foreach ($Regions as $Region_key => $Region_value)
    {
      echo '<option value="'.$Region_value['id'].'">'.$Region_value['name'].'</option>'; 
    }

            }else{

              echo '<option value="">State not available</option>';
            }

            $GLOBALS['SHONiR_RENDER'] = FALSE;

          }elseif($SHONiR_Second === "Cities"){

            $SHONiR_region_id = SHONiR_Post_Fnc('region_id');

            $SHONiR_Column = '';

            if($SHONiR_region_id){

              $SHONiR_ID = $SHONiR_region_id;

              $SHONiR_Column = "region_id";

            }

            $Cities = SHONiR_Cities_Fnc($SHONiR_ID, $SHONiR_Column);

            if($Cities){
              echo '<option value="">Select City</option>'; 
              foreach ($Cities as $City_key => $City_value)
    {
      echo '<option value="'.$City_value['id'].'">'.$City_value['name'].'</option>'; 
    }

            }else{

              echo '<option value="">City not available</option>';
            }

            $GLOBALS['SHONiR_RENDER'] = FALSE;

        }elseif($SHONiR_Second === "Cart" && $SHONiR_Third == "Items"){

            $GLOBALS['SHONiR_CACHE'] = FALSE;

            $SHONiR_Cart_Items = 0;
            $SHONiR_Cart_Sub = 0;

           $SHONiR_Cart_Details = SHONiR_Cart_Details_Fnc('session_id', $GLOBALS['SHONiR_SESSION_ID']);

           if($SHONiR_Cart_Details){

            $SHONiR_Cart_Items = $SHONiR_Cart_Details['Items'];
             $SHONiR_Cart_Sub = $SHONiR_Cart_Details['Sub'];

           }

    SHONiR_Session_Write_Fnc('cart_items', $SHONiR_Cart_Items);
    SHONiR_Session_Write_Fnc('cart_sub', $SHONiR_Cart_Sub);

            echo 'd("#SHONiR_cart_items").html("'.$SHONiR_Cart_Items.'");';

            $GLOBALS['SHONiR_RENDER'] = FALSE;

        }elseif($SHONiR_Second === "Pages" && $SHONiR_ID){

                $SHONiR_Data = SHONiR_Page_Fnc($SHONiR_ID);

                if($SHONiR_Data){

                $GLOBALS['SHONiR_AJAX_VIEWS'] = $SHONiR_Second;

                return $SHONiR_Data;

                }else{

                    echo '<b>Oops... Page Not Found!</b>  <p>We\'re sorry, but the page you were looking for doesn\'t exist.</p>';


                    $GLOBALS['SHONiR_RENDER'] = FALSE;


                }

            }elseif($SHONiR_Second === "Add-to-Cart" && $SHONiR_ID){

                $GLOBALS['SHONiR_CACHE'] = FALSE;

                $SHONiR_Product_Details = SHONiR_Product_Details_Fnc($SHONiR_ID, ' and status=1', SHONiR_LANGUAGE['language_id']);

    if($SHONiR_Product_Details){

        $SHONiR_Cart_Details = SHONiR_Cart_Details_Fnc('session_id', $GLOBALS['SHONiR_SESSION_ID']);

        if($SHONiR_Cart_Details){

            $SHONiR_cart_id = $SHONiR_Cart_Details['Cart']['cart_id'];

        }else{

        SHONiR_Query_Fnc("insert into tbl_cart (session_id, add_ip, user_id, user_type, add_time, edit_time) values ('".$GLOBALS['SHONiR_SESSION_ID']."', '".SHONiR_IP."', ".SHONiR_USER['user_id'].", '".SHONiR_USER['user_type']."', ".time().", ".time()." )");

        $SHONiR_cart_id = SHONiR_Insert_ID_Fnc();

        }

        if($SHONiR_cart_id){

            $SHONiR_quantity = SHONiR_Post_Fnc('quantity', FILTER_VALIDATE_INT);
        if(!$SHONiR_quantity && $SHONiR_quantity<1){
            $SHONiR_quantity = 1;
        }

   SHONiR_Query_Fnc("insert into tbl_cart_products (cart_id, product_id, quantity) values (".$SHONiR_cart_id.", ".$SHONiR_ID.", ".$SHONiR_quantity.")");

            $SHONiR_Alert['type'] = 'success';
                $SHONiR_Alert['message'] = 'Success: You have added <b><a href="'.SHONiR_BASE.'Go/Pr/'.$SHONiR_ID.'">'.$SHONiR_Product_Details['name'].'</a></b> to your <b><a href="'.SHONiR_BASE.'Cart">shopping cart</a></b>! ';

        }else{

            $SHONiR_Alert['type'] = 'error';
           $SHONiR_Alert['message'] = 'An unknown error occurred. Please refresh the page and try again.';

        }


                header('Content-type: application/json');
                echo json_encode($SHONiR_Alert);

    }else{

        echo '<b>Oops... Page Not Found!</b>  <p>We\'re sorry, but the page you were looking for doesn\'t exist.</p>';

    }
    $GLOBALS['SHONiR_RENDER'] = FALSE;

            }elseif($SHONiR_Second === "Product-Quick-View" && $SHONiR_ID){

                $SHONiR_Product_Details = SHONiR_Product_Details_Fnc($SHONiR_ID, ' and status=1', SHONiR_LANGUAGE['language_id']);

                if($SHONiR_Product_Details){

                    $SHONiR_CSRF = SHONiR_Post_Fnc('SHONiR_CSRF');

                    $SHONiR_Captcha = SHONiR_Post_Fnc('captcha');

                    if($SHONiR_CSRF){

                    header('Content-type: application/json');

                        if(SHONiR_CSRF_Fnc($SHONiR_CSRF)){

                            if(SHONiR_Captcha_Fnc_Render($SHONiR_Captcha)){

                              $SHONiR_ship_name = SHONiR_Post_Fnc('ship_name');
                              $SHONiR_ship_email = SHONiR_Post_Fnc('ship_email');
                              $SHONiR_ship_cell = SHONiR_Get_Number_Fnc(SHONiR_Post_Fnc('ship_cell'));
                              $SHONiR_ship_address1 = SHONiR_T2H_Fnc(SHONiR_Post_Fnc('ship_address1'));
                              $SHONiR_ship_address2 = SHONiR_Post_Fnc('ship_address2');
                              $SHONiR_ship_postcode = SHONiR_SETTINGS['website_postcode'];
                              $SHONiR_ship_country_id = SHONiR_SETTINGS['website_country_id'];
                              $SHONiR_ship_region_id = SHONiR_SETTINGS['website_region_id'];
                              $SHONiR_ship_city_id = SHONiR_SETTINGS['website_city_id'];
                              
                              $SHONiR_bill_name = $SHONiR_ship_name ;
                $SHONiR_bill_email = $SHONiR_ship_email;
                $SHONiR_bill_cell = $SHONiR_ship_cell;
                $SHONiR_bill_address1 = $SHONiR_ship_address1;
                $SHONiR_bill_address2 = $SHONiR_ship_address2;
                $SHONiR_bill_postcode = $SHONiR_ship_postcode;
                $SHONiR_bill_country_id = $SHONiR_ship_country_id;
                $SHONiR_bill_region_id = $SHONiR_ship_region_id;
                $SHONiR_bill_city_id = $SHONiR_ship_city_id;

                $SHONiR_user_comments = SHONiR_T2H_Fnc(SHONiR_Post_Fnc('user_comments'));

                $SHONiR_shipping_method = SHONiR_Post_Fnc('shipping_method');
                $SHONiR_payment_method = SHONiR_Post_Fnc('payment_method');
                

                $SHONiR_Cart['quantity'] = SHONiR_Post_Fnc('quantity');

                $SHONiR_Products[0] = array_merge($SHONiR_Cart,$SHONiR_Product_Details);

                SHONiR_New_Order_Fnc($SHONiR_Products, $SHONiR_ship_name, $SHONiR_ship_email, $SHONiR_ship_cell, $SHONiR_ship_address1, $SHONiR_ship_address2, $SHONiR_ship_postcode, $SHONiR_ship_country_id, $SHONiR_ship_region_id, $SHONiR_ship_city_id, $SHONiR_bill_name, $SHONiR_bill_email, $SHONiR_bill_cell, $SHONiR_bill_address1, $SHONiR_bill_address2, $SHONiR_bill_postcode, $SHONiR_bill_country_id, $SHONiR_bill_region_id, $SHONiR_bill_city_id, $SHONiR_shipping_method, $SHONiR_payment_method, 0, 0, '', SHONiR_USER['user_id'], SHONiR_USER['user_type'], $SHONiR_user_comments);


                    $SHONiR_Alert['type'] = 'success';
                                $SHONiR_Alert['message'] = '<b>Thank You!</b> Your order has been placed and is being processed. We will get back to you as soon as possible.';
                                echo json_encode($SHONiR_Alert);

                            }else{

                                $SHONiR_Alert['type'] = 'error';
                                $SHONiR_Alert['message'] = 'You entered an incorrect CAPTCHA. Please try again.';
                                $SHONiR_Alert['SHONiR_CSRF'] = SHONiR_CSRF_Fnc('G');
                                echo json_encode($SHONiR_Alert);

                             }

                                    }else{

                                        $SHONiR_Alert['type'] = 'error';
                                        $SHONiR_Alert['message'] = 'Please make sure your browser has cookies enabled and try again.';
                                        $SHONiR_Alert['SHONiR_CSRF'] = SHONiR_CSRF_Fnc('G');
                                        echo  json_encode($SHONiR_Alert);

                                     }

                                     $GLOBALS['SHONiR_RENDER'] = FALSE;

                                    }

                    $SHONiR_Main['SHONiR_CSRF'] = SHONiR_CSRF_Fnc('G');

                    $SHONiR_Main['SHONiR_Product_Details'] = $SHONiR_Product_Details;

                    $GLOBALS['SHONiR_AJAX_VIEWS'] = $SHONiR_Second;

                    $SHONiR_Data["SHONiR_Main"] =  $SHONiR_Main;

                    return $SHONiR_Data;

                }else{

                    echo '<b>Oops... Page Not Found!</b>  <p>We\'re sorry, but the page you were looking for doesn\'t exist.</p>';


                    $GLOBALS['SHONiR_RENDER'] = FALSE;


                }


    }else{

        echo date('l jS \of F Y h:i:s A');

        $GLOBALS['SHONiR_CACHE'] = FALSE;

        $GLOBALS['SHONiR_RENDER'] = FALSE;

    }


}


?>