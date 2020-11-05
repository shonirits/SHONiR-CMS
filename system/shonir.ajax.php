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
$SHONiR_tmp_time = time()-(3600*12);


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


$SHONiR_Query_Uploads = SHONiR_Query_Fnc("select * from tbl_uploads where  parent_type='tmp' and add_time<'".$SHONiR_tmp_time."' " );

 $SHONiR_Row_Uploads = SHONiR_Row_Fnc($SHONiR_Query_Uploads);
    
      if($SHONiR_Row_Uploads > 0 ){
    
        while($SHONiR_Fetch_Uploads = SHONiR_Fetch_Fnc($SHONiR_Query_Uploads))
        {                     
              if (file_exists(SHONiR_ROOT.'media/tmp/'.$SHONiR_Fetch_Uploads['upload_file'])) { unlink (SHONiR_ROOT.'media/tmp/'.$SHONiR_Fetch_Uploads['upload_file']); }
             
              SHONiR_Query_Fnc("delete from tbl_uploads where upload_id=".$SHONiR_Fetch_Uploads['upload_id']);
          
          }

        }


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

    $SHONiR_Data = SHONiR_AP_Administrator_Fnc($SHONiR_Username, 'username');

    if($SHONiR_Data){

    echo SHONiR_AP_Login_Fnc($SHONiR_Data['administrator_id'], md5($SHONiR_Password), $SHONiR_Remember);

    }else{

      echo '<div class="alert alert-danger" role="alert"><b>Error:</b> Oops! Something went wrong. An unknown error occurred.</div>';

    }


    $GLOBALS['SHONiR_RENDER'] = FALSE;
  }elseif($SHONiR_Second == "Comments" && $SHONiR_Third == "Get" && $SHONiR_ID){

    header('Content-type: application/json');

    $GLOBALS['SHONiR_RENDER'] = FALSE;

    $SHONiR_Order = SHONiR_Post_Fnc('o');

    $SHONiR_Data = '';

    $SHONiR_User_Class = '';

if(!$SHONiR_Order){

    $SHONiR_Order = "c.add_time";
}else{

    $SHONiR_Order = $SHONiR_Order;

}

$SHONiR_By = SHONiR_Post_Fnc('b');

if($SHONiR_By!="asc"){

    $SHONiR_By = "desc";

}

$SHONiR_Where = ' c.status=1 ';

if(SHONiR_USER['user_type'] != 0){

  //$SHONiR_Where .= " and (user_type='".SHONiR_USER['user_type']."' and user_id=".SHONiR_USER['user_id']." )";

}

$SHONiR_type = SHONiR_Post_Fnc('type'); 

$SHONiR_Query = SHONiR_Get_Comments_Fnc($SHONiR_ID, $SHONiR_type, $SHONiR_Where , $SHONiR_Order, $SHONiR_By);

if($SHONiR_Query){
  $SHONiR_Total_Records = count($SHONiR_Query); 
  }else{
      $SHONiR_Total_Records = 0;
  }

$SHONiR_Page_No = SHONiR_Post_Fnc('n');

$SHONiR_Records_Limit = SHONiR_SETTINGS['config_records_limit'];    

$SHONiR_Total_Pages = ceil($SHONiR_Total_Records / $SHONiR_Records_Limit);

if($SHONiR_Page_No>$SHONiR_Total_Pages){

  $SHONiR_Return['type'] = 'error';
  $SHONiR_Return['more'] = 'hide';

}

if(!ctype_digit($SHONiR_Page_No) || $SHONiR_Page_No<1 || $SHONiR_Page_No>$SHONiR_Total_Pages){

  $SHONiR_Page_No = 1;
}     

$SHONiR_Start = ($SHONiR_Page_No-1) * $SHONiR_Records_Limit;      

$SHONiR_SQL_Pagination_Limit = $SHONiR_Start.", ".$SHONiR_Records_Limit;

$SHONiR_Query_Pagination = SHONiR_Get_Comments_Fnc($SHONiR_ID, $SHONiR_type, $SHONiR_Where, $SHONiR_Order, $SHONiR_By, $SHONiR_SQL_Pagination_Limit);

if($SHONiR_Query_Pagination){
  $SHONiR_Row_Pagination = count($SHONiR_Query_Pagination);
  }else{
      $SHONiR_Row_Pagination = 0;
  }

  if($SHONiR_Row_Pagination > 0 ){   

    $SHONiR_Rows = $SHONiR_Query_Pagination;

    foreach ($SHONiR_Rows as $key => $val)
      {

        $SHONiR_User_Class = ' commenter-'.$SHONiR_Rows[$key]['user_type'];

        if($SHONiR_Rows[$key]['user_type'] == 0){

         $SHONiR_val_name = $SHONiR_Rows[$key]['name'];

         $SHONiR_val_picture = SHONiR_CDN_IMG.'media/images/guest.jpg';

        }else{

         $SHONiR_User_Type = SHONiR_User_Type_Fnc($SHONiR_Rows[$key]['user_type']);         

          $SHONiR_Fnc = "SHONiR_".$SHONiR_User_Type."_Fnc"; 

          if (function_exists($SHONiR_Fnc)) {
    
           $SHONiR_get_user = call_user_func($SHONiR_Fnc, $SHONiR_Rows[$key]['user_id']);

           if($SHONiR_get_user){

            $SHONiR_val_name =  $SHONiR_get_user['firstname'];          

            if($SHONiR_get_user['picture']){
            $SHONiR_val_picture = SHONiR_CDN_IMG.'media/uploads/'.$SHONiR_get_user['picture'];
            }else{
              $SHONiR_val_picture = SHONiR_CDN_IMG.'media/images/user.png';
            }

           }else{

            $SHONiR_val_name = 'Unknown User';

            $SHONiR_User_Class = 'commenter-disable';

            $SHONiR_val_picture = SHONiR_CDN_IMG.'media/images/unknown-user.jpg';

           }           
    
        } else {
          
          $SHONiR_val_name = 'Unknown User';
          
          $SHONiR_val_picture = SHONiR_CDN_IMG.'media/images/unknown-user.jpg';

          $SHONiR_User_Class = 'commenter-unknown';

        }

                


        }

        
  
        $SHONiR_Data .= '<div class="media mb-4">
        <img class="d-flex mr-3 rounded-circle" src="'.$SHONiR_val_picture.'" alt="">
        <div class="media-body '.$SHONiR_User_Class.'">
          <h5 class="mt-0">'.$SHONiR_val_name.'</h5>'.$SHONiR_Rows[$key]['details'].'
        </div>
      </div>';
  
      }

      $SHONiR_Return['n'] = $SHONiR_Page_No+1;
      $SHONiR_Return['type'] = 'success';
      $SHONiR_Return['data'] = $SHONiR_Data; 
      
      if($SHONiR_Total_Pages == $SHONiR_Page_No){

        $SHONiR_Return['more'] = 'hide';

      }else{

        $SHONiR_Return['more'] = 'show';

      }
     
  }else{

    $SHONiR_Return['n'] = $SHONiR_Page_No+1;
    $SHONiR_Return['type'] = 'end';
    $SHONiR_Return['data'] = '';

    $SHONiR_Return['more'] = 'hide';

  }    
        
    echo  json_encode($SHONiR_Return); 

  }elseif($SHONiR_Second == "Comments" && $SHONiR_Third == "Post" && $SHONiR_ID){

    header('Content-type: application/json');

    $GLOBALS['SHONiR_RENDER'] = FALSE;   
    
    $SHONiR_CSRF = SHONiR_Post_Fnc('SHONiR_CSRF');

    $SHONiR_Do = TRUE;

    $SHONiR_Data = FALSE;

    $SHONiR_status = 1;

    $SHONiR_details = trim(SHONiR_Post_Fnc('details'));
        $SHONiR_type = SHONiR_Post_Fnc('type');  
        $SHONiR_name = SHONiR_Post_Fnc('name');
        $SHONiR_email= SHONiR_Post_Fnc('email');
        $SHONiR_reply_to= SHONiR_Post_Fnc('reply_to', FILTER_VALIDATE_INT);

        if($SHONiR_details){

        $SHONiR_details = SHONiR_T2H_Fnc($SHONiR_details);

        }else{

          $SHONiR_Alert['type'] = 'error';
          $SHONiR_Alert['message'] = 'Text Too short: Text must be at least 2 characters in length.';
        
          $SHONiR_Do = FALSE;

        }

        if(!$SHONiR_reply_to){
          $SHONiR_reply_to = 0;
      }
   
    if($SHONiR_CSRF){            

      if(SHONiR_CSRF_Fnc($SHONiR_CSRF)){ 
        
        if(SHONiR_USER['user_type'] == 0){

        if(SHONiR_SETTINGS['guest_comments'] == "FALSE" ){

          $SHONiR_Alert['type'] = 'error';
          $SHONiR_Alert['message'] = 'Guest are not allowed to comments. Please login and try again.';
        
          $SHONiR_Do = FALSE;

          $SHONiR_status = 0;

        }

      }

      $SHONiR_Fnc = "SHONiR_".$SHONiR_type."_Details_Fnc"; 

      if (function_exists($SHONiR_Fnc)) {

       $SHONiR_Data = call_user_func($SHONiR_Fnc, $SHONiR_ID, ' and status=1 ', SHONiR_LANGUAGE['language_id']);

    } else {
      
      $SHONiR_Alert['type'] = 'error';
       $SHONiR_Alert['message'] = 'Bad Request: Your browser sent a request that this server could not understand.';          
      $SHONiR_Do = FALSE;
    }

    
    if(!$SHONiR_Data){
      
      $SHONiR_Alert['type'] = 'error';
      $SHONiR_Alert['message'] = 'The requested record was not found or you do not have sufficient permissions to access these records.';          
     $SHONiR_Do = FALSE;

    }


      if($SHONiR_Do){         

     SHONiR_Query_Fnc("insert into tbl_comments (details, name, email, reply_to, parent_id, parent_type, status, add_ip, user_id, user_type, add_time) values ('". $SHONiR_details."', '".$SHONiR_name."', '".$SHONiR_email."',  ".$SHONiR_reply_to.", ".$SHONiR_ID.", '".$SHONiR_type."', ".$SHONiR_status.", '".SHONiR_IP."', ".SHONiR_USER['user_id'].", ".SHONiR_USER['user_type'].", ".time()." )");

        $SHONiR_Alert['type'] = 'success';
        $SHONiR_Alert['message'] = 'Your comment has been post successfully. Thanks for your comment.';

      }

      }else{

        $SHONiR_Alert['type'] = 'error';
        $SHONiR_Alert['message'] = 'Please make sure your browser has cookies enabled and try again.';
      
     }

    }else{

      $SHONiR_Alert['type'] = 'error';
     $SHONiR_Alert['message'] = 'An unknown error occurred. Please refresh the page and try again.';

  }

  $SHONiR_Alert['SHONiR_CSRF'] = SHONiR_CSRF_Fnc('G');

        echo  json_encode($SHONiR_Alert); 

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

            $SHONiR_select = SHONiR_Post_Fnc('select');

            $SHONiR_Column = '';

            if($SHONiR_country_id){

              $SHONiR_ID = $SHONiR_country_id;

              $SHONiR_Column = "id";

            }

            $Countries = SHONiR_Countries_Fnc($SHONiR_ID, $SHONiR_Column, $SHONiR_select);

            if($Countries){
              echo '<option value="">Select Country</option>'; 
              foreach ($Countries as $Country_key => $Country_value)
    {

      if($SHONiR_country_id == $Country_value['id'] && $SHONiR_select){

        $SHONiR_Option_Extra = 'selected="selected"';

      }else{

        $SHONiR_Option_Extra = '';

      }
      echo '<option value="'.$Country_value['id'].'" '.$SHONiR_Option_Extra.'>'.$Country_value['name'].'</option>'; 
    }

            }else{

              echo '<option value="">Country not available</option>';
            }

            $GLOBALS['SHONiR_RENDER'] = FALSE;

          }elseif($SHONiR_Second === "Regions"){

            $SHONiR_country_id = SHONiR_Post_Fnc('country_id');
            $SHONiR_region_id = SHONiR_Post_Fnc('region_id');
            $SHONiR_select = SHONiR_Post_Fnc('select');

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

      if($SHONiR_region_id == $Region_value['id'] && $SHONiR_select){

        $SHONiR_Option_Extra = 'selected="selected"';

      }else{

        $SHONiR_Option_Extra = '';

      }
      echo '<option value="'.$Region_value['id'].'" '.$SHONiR_Option_Extra.'>'.$Region_value['name'].'</option>'; 
    }

            }else{

              echo '<option value="">State not available</option>';
            }

            $GLOBALS['SHONiR_RENDER'] = FALSE;

          }elseif($SHONiR_Second === "Cities"){

            $SHONiR_region_id = SHONiR_Post_Fnc('region_id');
            $SHONiR_city_id = SHONiR_Post_Fnc('city_id');
            $SHONiR_select = SHONiR_Post_Fnc('select');

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

      if($SHONiR_city_id == $City_value['id'] && $SHONiR_select){

        $SHONiR_Option_Extra = 'selected="selected"';

      }else{

        $SHONiR_Option_Extra = '';

      }
      echo '<option value="'.$City_value['id'].'" '.$SHONiR_Option_Extra.'>'.$City_value['name'].'</option>'; 
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
                $SHONiR_Alert['message'] = 'Success: You have added <b><a href="'.SHONiR_BASE.'Go/Pr/'.$SHONiR_ID.'">'.$SHONiR_Product_Details['name'].'</a></b> to your <b><a href="'.SHONiR_BASE.'Cart">Enquiry Basket</a></b>! ';

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

  }elseif($SHONiR_Second === "Uploads"){

    $SHONiR_token = SHONiR_Post_Fnc('token');

    if($SHONiR_token){

      $SHONiR_upload_id = SHONiR_Post_Fnc('upload_id');

    if($SHONiR_Third === "Delete" && $SHONiR_upload_id){

      $SHONiR_Upload =  SHONiR_Uploads_Fnc($SHONiR_upload_id);  

      SHONiR_Query_Fnc("delete from tbl_uploads where upload_id=".$SHONiR_Upload[0]['upload_id']);

      if($SHONiR_Upload[0]['token'] === $SHONiR_token){

      if (file_exists(SHONiR_ROOT.'media/tmp/'.$SHONiR_Upload[0]['upload_file'])) { unlink (SHONiR_ROOT.'media/tmp/'.$SHONiR_Upload[0]['upload_file']); }

      $SHONiR_Response = array (
        'status' => 'success',
        'info'   => 'File '.$SHONiR_Upload[0]['upload_file'].' has been removed successfully.');

      }else{

        $SHONiR_Response = array (
          'status' => 'error',
          'info'   => 'Couldn\'t delete the requested file :(, a mysterious error happend.'
      );

      }

    }else{  

    $SHONiR_file = $_FILES['file'];  

    $SHONiR_file_name = $SHONiR_file['name'];

    $SHONiR_file_pos = strrpos($SHONiR_file_name, '.');


    if(empty($SHONiR_file_name) && empty($SHONiR_file_pos)){

      $SHONiR_file_final = '';
     
      }else{
     
       $SHONiR_file_extension = strtolower(substr($SHONiR_file_name, $SHONiR_file_pos, strlen($SHONiR_file_name)));
     
       $SHONiR_file_final = SHONiR_Slug_Fnc(str_replace($SHONiR_file_extension, '', $SHONiR_file_name));
     
      $SHONiR_file_final = $SHONiR_file_final."-".SHONiR_Counter_Fnc('uploads').$SHONiR_file_extension;
     
     }

     if($SHONiR_file_final)
{

 if(strpos(SHONiR_SETTINGS['custom_upload_files'], $SHONiR_file_extension) === false){

  $SHONiR_Response = array (
    'status' => 'error',
    'info'   => 'You can\'t upload files of this type ['.$SHONiR_file_extension.'].');

  }else{

SHONiR_Query_Fnc("insert into tbl_uploads (upload_file, parent_type, add_time, token) values ('".$SHONiR_file_final."', 'tmp', ".time().", '".$SHONiR_token."')");

$SHONiR_upload_id = SHONiR_Insert_ID_Fnc();

move_uploaded_file($SHONiR_file["tmp_name"], SHONiR_ROOT.'media/tmp/'.$SHONiR_file_final);

$SHONiR_Response = array (
  'status'    => 'success',
  'upload_id' => $SHONiR_upload_id
);

}

}else{

  $SHONiR_Response = array (
    'status' => 'error',
    'info'   => 'Couldn\'t upload the requested file :(, a mysterious error happend.'
);

}

}

}else{

  $SHONiR_Response = array (
    'status' => 'error',
    'info'   => 'An unknown error occurred. Please refresh the page and try again.'
);

}

echo json_encode($SHONiR_Response);
    $GLOBALS['SHONiR_RENDER'] = FALSE;
  }elseif($SHONiR_Second === "Product-Quick-View" && $SHONiR_ID){

    $SHONiR_Product_Details = SHONiR_Product_Details_Fnc($SHONiR_ID, ' and status=1', SHONiR_LANGUAGE['language_id']);

    if($SHONiR_Product_Details){

      $SHONiR_Main['SHONiR_CSRF'] = SHONiR_CSRF_Fnc('G');

      $SHONiR_Main['SHONiR_Product_Details'] = $SHONiR_Product_Details;

      $GLOBALS['SHONiR_AJAX_VIEWS'] = $SHONiR_Second;

      $SHONiR_Data["SHONiR_Main"] =  $SHONiR_Main;

      return $SHONiR_Data;
      
    }else{

      echo '<b>Oops... Page Not Found!</b>  <p>We\'re sorry, but the page you were looking for doesn\'t exist.</p>';

      $GLOBALS['SHONiR_RENDER'] = FALSE;

  }

            }elseif($SHONiR_Second === "Product-Quick-Order" && $SHONiR_ID){

                $SHONiR_Product_Details = SHONiR_Product_Details_Fnc($SHONiR_ID, ' and status=1', SHONiR_LANGUAGE['language_id']);

                if($SHONiR_Product_Details){

                    $SHONiR_CSRF = SHONiR_Post_Fnc('SHONiR_CSRF');

                    $SHONiR_Captcha = SHONiR_Post_Fnc('captcha');

                    if($SHONiR_CSRF){

                    header('Content-type: application/json');

                        if(SHONiR_CSRF_Fnc($SHONiR_CSRF)){

                            if(SHONiR_Captcha_Fnc_Render($SHONiR_Captcha)){

                              $SHONiR_ship_name = SHONiR_Post_Fnc('ship_name');
                              $SHONiR_ship_company = SHONiR_Post_Fnc('ship_company');
                              $SHONiR_ship_email = SHONiR_Post_Fnc('ship_email');
                              $SHONiR_ship_cell = SHONiR_Get_Number_Fnc(SHONiR_Post_Fnc('ship_cell'));
                              $SHONiR_ship_address1 = SHONiR_T2H_Fnc(SHONiR_Post_Fnc('ship_address1'));
                              $SHONiR_ship_address2 = SHONiR_Post_Fnc('ship_address2');
                              $SHONiR_ship_postcode = SHONiR_Post_Fnc('ship_postcode');
                              $SHONiR_ship_country_id = SHONiR_Post_Fnc('ship_country');
                              $SHONiR_ship_region_id = SHONiR_Post_Fnc('ship_region');
                              $SHONiR_ship_city_id = SHONiR_Post_Fnc('ship_city');

                              $SHONiR_contract_term = SHONiR_Post_Fnc('contract_term');
                              $SHONiR_freight_forwarding = SHONiR_Post_Fnc('freight_forwarding');
                              
                              $SHONiR_bill_name = $SHONiR_ship_name ;
                              $SHONiR_bill_company = $SHONiR_ship_company ;
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

            
                SHONiR_New_Order_Fnc($SHONiR_Products, $SHONiR_ship_name, $SHONiR_ship_company, $SHONiR_ship_email, $SHONiR_ship_cell, $SHONiR_ship_address1, $SHONiR_ship_address2, $SHONiR_ship_postcode, $SHONiR_ship_country_id, $SHONiR_ship_region_id, $SHONiR_ship_city_id, $SHONiR_bill_name, $SHONiR_bill_company, $SHONiR_bill_email, $SHONiR_bill_cell, $SHONiR_bill_address1, $SHONiR_bill_address2, $SHONiR_bill_postcode, $SHONiR_bill_country_id, $SHONiR_bill_region_id, $SHONiR_bill_city_id, $SHONiR_shipping_method, $SHONiR_payment_method, 0, 0, '', SHONiR_USER['user_id'], SHONiR_USER['user_type'], $SHONiR_user_comments, $SHONiR_contract_term, $SHONiR_freight_forwarding, SHONiR_SETTINGS['order_product_history']);


                    $SHONiR_Alert['type'] = 'success';
                               // $SHONiR_Alert['message'] = '<b>Thank You!</b> Your order has been placed and is being processed. We will get back to you as soon as possible.';
                               $SHONiR_Alert['message'] = '<b> Thank you for your enquiry!</b>  Your message has been sent successfully. It has been forwarded to the relevant department and will be dealt with as soon as possible.';
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