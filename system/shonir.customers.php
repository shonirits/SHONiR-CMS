<?php defined('SHONiR') OR exit('No direct script access allowed');

function SHONiR_Customer_Logout_Fnc(){

  SHONiR_Session_Delete_Fnc('SHONiR_User');
  SHONiR_Session_Delete_Fnc('SHONiR_C_ID');
  SHONiR_Session_Delete_Fnc('SHONiR_C_Password');
  SHONiR_Cookie_Delete_Fnc('SHONiR_C_Password');
  
}

function SHONiR_Customer_Login_Fnc($SHONiR_ID, $SHONiR_Password, $SHONiR_Remember = 0){

  $SHONiR_Data = SHONiR_Customer_Fnc($SHONiR_ID, 'customer_id');

    $SHONiR_Again_Attempt = 0;
    $SHONiR_Return = '';

    if($SHONiR_Data){

      if($SHONiR_Data['total_attempt'] > 3 && $SHONiR_Data['again_attempt']>time()){

        $SHONiR_Again_Attempt = (time() + ($SHONiR_Data['total_attempt']*60*60));

        $SHONiR_Time_Difference = SHONiR_Time_Difference_Fnc(time(), $SHONiR_Again_Attempt);

        SHONiR_Query_Fnc("update tbl_customers set total_attempt=total_attempt+1, last_attempt=".time().", again_attempt =".$SHONiR_Again_Attempt." where customer_id=".$SHONiR_Data['customer_id']."");
        
        $SHONiR_Return = '<b>Error:</b> Too many failed login attempts. Please try again after '.$SHONiR_Time_Difference;    

    }else{

      if($SHONiR_Data['password'] ==$SHONiR_Password){

        if($SHONiR_Data['status'] == 0 ){

          if($SHONiR_Data['total_attempt']>3){

              $SHONiR_Again_Attempt = (time() + ($SHONiR_Data['total_attempt']*60*60));
  
           }

           SHONiR_Query_Fnc("update tbl_customers set total_attempt=total_attempt+1, last_attempt=".time().",  again_attempt =".$SHONiR_Again_Attempt." where customer_id=".$SHONiR_Data['customer_id']."");

           $SHONiR_Return = '<b>Error:</b> Your account has to be confirmed by an administrator before you can login.';

      }elseif($SHONiR_Data['status'] == 1 ){

          SHONiR_Query_Fnc("update tbl_customers set total_attempt=0, last_attempt=0, again_attempt=0 where customer_id=".$SHONiR_Data['customer_id']."");

          SHONiR_Query_Fnc("update tbl_visitors set user_id=".$SHONiR_Data['customer_id'].", user_type=3 where session_id='".$GLOBALS['SHONiR_SESSION_ID']."'");
              
          $SHONiR_User = array();

          $SHONiR_User['user_id'] = $SHONiR_Data['customer_id'];
          $SHONiR_User['user_type'] = 3;            
          
          SHONiR_Session_Write_Fnc('SHONiR_User', array_merge($SHONiR_User,$SHONiR_Data));

          SHONiR_Session_Write_Fnc('SHONiR_C_ID', $SHONiR_ID);
          SHONiR_Session_Write_Fnc('SHONiR_C_Password', $SHONiR_Password);

          SHONiR_Cookie_Write_Fnc('SHONiR_C_ID', $SHONiR_ID, 3600*24*30);

          if($SHONiR_Remember)
          {
          
          SHONiR_Cookie_Write_Fnc('SHONiR_C_Password', $SHONiR_Password, 3600*24*30);

          }else{

              SHONiR_Cookie_Delete_Fnc('SHONiR_C_Password');
          }

          $SHONiR_Return = 'success';

      }else{

          if($SHONiR_Data['total_attempt']>3){

              $SHONiR_Again_Attempt = (time() + ($SHONiR_Data['total_attempt']*60*60));
  
           }
   
           SHONiR_Query_Fnc("update tbl_customers set total_attempt=total_attempt+1, last_attempt=".time().", again_attempt =".$SHONiR_Again_Attempt." where customer_id=".$SHONiR_Data['customer_id']."");
  
           $SHONiR_Return =  '<b>Error:</b> Your account has been disabled or suspended. If you belive this is in error, please contact at WhatsApp '.SHONiR_SETTINGS['website_telephone'].' or email at '.SHONiR_SETTINGS['website_email'].' or for more information visit developer website '.SHONiR_SETTINGS['website_url'].'.';
  
      }  

      }else{

        if($SHONiR_Data['total_attempt']>3){

            $SHONiR_Again_Attempt = (time() + ($SHONiR_Data['total_attempt']*60*60));

         }
 
         SHONiR_Query_Fnc("update tbl_customers set total_attempt=total_attempt+1, last_attempt=".time().", again_attempt =".$SHONiR_Again_Attempt." where customer_id=".$SHONiR_Data['customer_id']."");
         
         $SHONiR_Return = '<b>Error:</b> Incorrect username or password.';

        }

      
    }

    }else{

      $SHONiR_Return =  '<b>Error:</b> Incorrect username or password.';
  }

  return $SHONiR_Return ;


}

function SHONiR_Customer_Register_Fnc($SHONiR_Array){

  $SHONiR_Return = FALSE;

  if($SHONiR_Array){

  $SHONiR_Array_Columns = implode(", ", array_keys($SHONiR_Array));

  $SHONiR_Array_Values = '';
  
  foreach($SHONiR_Array as $value){

    $SHONiR_Array_Values .= "'$value', ";

}

$SHONiR_Array_Values = rtrim($SHONiR_Array_Values, ', ');

  $SHONiR_SQL = "insert into tbl_customers ($SHONiR_Array_Columns) values ($SHONiR_Array_Values)";

  SHONiR_Query_Fnc($SHONiR_SQL);

  $SHONiR_Return = TRUE;
  
}else{

  $SHONiR_Return = FALSE;

}

return $SHONiR_Return;


}


function SHONiR_Customer_Fnc($SHONiR_Value, $SHONiR_Key = 'customer_id'){


  $SHONiR_Query_Customer = SHONiR_Query_Fnc("select * from tbl_customers where ".$SHONiR_Key."='".$SHONiR_Value."'");

  $SHONiR_Row_Customer = SHONiR_Row_Fnc($SHONiR_Query_Customer);

  if($SHONiR_Row_Customer > 0){

      $SHONiR_Return = SHONiR_Fetch_Fnc($SHONiR_Query_Customer);

  }else{

      $SHONiR_Return = FALSE;

  }

  return $SHONiR_Return;


}

function SHONiR_Customers_Fnc_Render(){

  SHONiR_Customer_Login_Fnc(8, 'c3a1001edf12902a44b45bfab5818dc8', 1);exit;

    $SHONiR_Second = SHONiR_URI['Second'];
    $SHONiR_Third = SHONiR_URI['Third'];
    $SHONiR_Last = SHONiR_URI['Last'];

    if($SHONiR_Second == 'Logout'){

		SHONiR_Customer_Logout_Fnc();

    SHONiR_Session_New_Fnc();

    $SHONiR_Alert['type'] = 'success';
    $SHONiR_Alert['message'] = 'You have successfully logged out!';
    SHONiR_Session_Write_Fnc('SHONiR_Alert', $SHONiR_Alert);

    SHONiR_Redirect_Fnc(SHONiR_BASE);

		}elseif($SHONiR_Second == 'Login'){

      $SHONiR_continue = SHONiR_Get_Fnc('continue');

      if(!$SHONiR_continue){

        $SHONiR_continue = SHONiR_BASE;

      }

      SHONiR_Session_Write_Fnc('continue', $SHONiR_continue);

      if(SHONiR_USER['user_type'] == 3){

        $SHONiR_Login =  SHONiR_Customer_Login_Fnc(SHONiR_USER['user_id'], SHONiR_USER['password']);

        if($SHONiR_Login == 'success'){

          $SHONiR_continue = SHONiR_Session_Read_Fnc('continue');

          SHONiR_Session_Delete_Fnc('continue');

            SHONiR_Redirect_Fnc($SHONiR_continue.'?&S');
    
          }

    }elseif(SHONiR_Cookie_Exist_Fnc('SHONiR_C_ID') && SHONiR_Cookie_Exist_Fnc('SHONiR_C_Password')){

      $SHONiR_Login = SHONiR_Customer_Login_Fnc(SHONiR_Cookie_Read_Fnc('SHONiR_C_ID'), SHONiR_Cookie_Read_Fnc('SHONiR_C_Password'), 1);

      if($SHONiR_Login == 'success'){

        $SHONiR_continue = SHONiR_Session_Read_Fnc('continue');

          SHONiR_Session_Delete_Fnc('continue');

        SHONiR_Redirect_Fnc($SHONiR_continue.'?&C');

      }

    }
      

    if($SHONiR_Third == 'google'){

        
$clientID = '566117306031-4nihj6unqgu454sqipufrco2e45ujv9q.apps.googleusercontent.com';
$clientSecret = 'dPBGds6jWJ9OgNHJ8AzwMede';
$redirectUri = SHONiR_BASE.'Customers/Login/google';
  
// create Client Request to access Google API
$client = new Google_Client();
$client->setClientId($clientID);
$client->setClientSecret($clientSecret);
$client->setRedirectUri($redirectUri);
$client->addScope("email");
$client->addScope("profile");
 
// authenticate code from Google OAuth Flow
if (SHONiR_Get_Fnc('code')) {
  $token = $client->fetchAccessTokenWithAuthCode(SHONiR_Get_Fnc('code'));
  if(isset($token['access_token'])){
  $client->setAccessToken($token['access_token']);
  
  // get profile info
  $google_oauth = new Google_Service_Oauth2($client);
  $google_account_info = $google_oauth->userinfo->get();

  if(!empty($google_account_info->id)){

  $SHONiR_Customer = SHONiR_Customer_Fnc($google_account_info->id, 'google_id');

if(!$SHONiR_Customer){

  $SHONiR_Customer = SHONiR_Customer_Fnc($google_account_info->email, 'email');

  if($SHONiR_Customer){

   SHONiR_Query_Fnc("update tbl_customers set google_id='".$google_account_info->id."' where email='".$google_account_info->email."'");


  }else{

 $SHONiR_Array = array();
$SHONiR_Split_Fullname = SHONiR_Split_Fullname_Fnc($google_account_info->name);
$SHONiR_Password = SHONiR_Token_Fnc();  
$SHONiR_Array['firstname'] = $SHONiR_Split_Fullname[0];
$SHONiR_Array['lastname'] = $SHONiR_Split_Fullname[1];
$SHONiR_Array['password'] = md5($SHONiR_Password);
$SHONiR_Array['google_id'] = $google_account_info->id;
 $SHONiR_Array['email'] = $google_account_info->email;
 $SHONiR_Array['email_verified'] = 1;
 $SHONiR_Array['status'] = 1;
 $SHONiR_Array['add_time'] = time();
 $SHONiR_Array['add_ip'] = SHONiR_IP;

  SHONiR_Customer_Register_Fnc($SHONiR_Array);

  $SHONiR_Customer = SHONiR_Customer_Fnc($google_account_info->id, 'google_id');

  }  

}

$SHONiR_Customer_Login = SHONiR_Customer_Login_Fnc($SHONiR_Customer['customer_id'], $SHONiR_Customer['password'], 1);

if($SHONiR_Customer_Login == "success"){

  $SHONiR_continue = SHONiR_Session_Read_Fnc('continue');

   SHONiR_Session_Delete_Fnc('continue');

SHONiR_Redirect_Fnc($SHONiR_continue);

}else{

$SHONiR_Alert['type'] = 'error';
$SHONiR_Alert['message'] = $SHONiR_Customer_Login;
SHONiR_Session_Write_Fnc('SHONiR_Alert', $SHONiR_Alert);

}

  }else{

    $SHONiR_Alert['type'] = 'error';
    $SHONiR_Alert['message'] = 'An unknown error occurred connecting to the facebook account authentication';
    SHONiR_Session_Write_Fnc('SHONiR_Alert', $SHONiR_Alert);

  }

} else {

  SHONiR_Redirect_Fnc($client->createAuthUrl());

}


} else {

  SHONiR_Redirect_Fnc($client->createAuthUrl());

}

    }elseif($SHONiR_Third == 'facebook'){

      if(SHONiR_Session_Read_Fnc('facebook_default_access_token'))
       {

        $facebook_default_access_token = SHONiR_Session_Read_Fnc('facebook_default_access_token');

       }
       else
       {

        $facebook_default_access_token = SHONiR_Token_Fnc();

        SHONiR_Session_Write_Fnc('facebook_default_access_token', $facebook_default_access_token);
            
       }

      $facebook = new Facebook\Facebook([
        'app_id' => '535744140369290',
        'app_secret' => '0cb2b9b4350d0c7874064829eae8fada',
        'default_graph_version' => 'v2.4',
        'default_access_token' => $facebook_default_access_token
      ]);



      $facebook_helper = $facebook->getRedirectLoginHelper();
      
      if(SHONiR_Get_Fnc('code'))
      {
       if(SHONiR_Session_Read_Fnc('access_token'))
       {
        $access_token = SHONiR_Session_Read_Fnc('access_token');
       }
       else
       {
        $access_token = $facebook_helper->getAccessToken();
      
        SHONiR_Session_Write_Fnc('access_token', $access_token);
      
        $facebook->setDefaultAccessToken(SHONiR_Session_Read_Fnc('access_token'));
       }   
  
      
       $graph_response = $facebook->get("/me?fields=name,email", $access_token);
      
       $facebook_user_info = $graph_response->getGraphUser();


       if(!empty($facebook_user_info['id'])){

        $SHONiR_Customer = SHONiR_Customer_Fnc($facebook_user_info['id'], 'facebook_id');
      
      if(!$SHONiR_Customer){
      
        if(!empty($facebook_user_info['email']))
       {
        $SHONiR_Customer = SHONiR_Customer_Fnc($facebook_user_info['email'], 'email');
       }
      
        if($SHONiR_Customer){
      
         SHONiR_Query_Fnc("update tbl_customers set facebook_id='".$facebook_user_info['id']."' where email='".$facebook_user_info['email']."'");      
      
        }else{
      
       $SHONiR_Array = array();
      $SHONiR_Split_Fullname = SHONiR_Split_Fullname_Fnc($facebook_user_info['name']);
      $SHONiR_Password = SHONiR_Token_Fnc();  
      $SHONiR_Array['firstname'] = $SHONiR_Split_Fullname[0];
      $SHONiR_Array['lastname'] = $SHONiR_Split_Fullname[1];
      $SHONiR_Array['password'] = md5($SHONiR_Password);
      $SHONiR_Array['facebook_id'] = $facebook_user_info['id'];
       $SHONiR_Array['email'] = $facebook_user_info['email'];
       $SHONiR_Array['email_verified'] = 1;
       $SHONiR_Array['status'] = 1;
       $SHONiR_Array['add_time'] = time();
       $SHONiR_Array['add_ip'] = SHONiR_IP;
      
        SHONiR_Customer_Register_Fnc($SHONiR_Array);
      
        $SHONiR_Customer = SHONiR_Customer_Fnc($facebook_user_info['id'], 'facebook_id');
      
        }  
      
      }


      $SHONiR_Customer_Login = SHONiR_Customer_Login_Fnc($SHONiR_Customer['customer_id'], $SHONiR_Customer['password'], 1);

      if($SHONiR_Customer_Login == "success"){

        $SHONiR_continue = SHONiR_Session_Read_Fnc('continue');

   SHONiR_Session_Delete_Fnc('continue');
      
      SHONiR_Redirect_Fnc($SHONiR_continue);

    }else{

      $SHONiR_Alert['type'] = 'error';
      $SHONiR_Alert['message'] = $SHONiR_Customer_Login;
      SHONiR_Session_Write_Fnc('SHONiR_Alert', $SHONiR_Alert);

    }
      
        }else{
      
      $SHONiR_Alert['type'] = 'error';
    $SHONiR_Alert['message'] = 'An unknown error occurred connecting to the facebook account authentication';
    SHONiR_Session_Write_Fnc('SHONiR_Alert', $SHONiR_Alert);
      
        }
       
      }
      else
      {
       // Get login url
          $facebook_permissions = ['email']; // Optional permissions
      
          $facebook_login_url = $facebook_helper->getLoginUrl('https://babymall.pk/Customers/Login/facebook', $facebook_permissions);
          
          SHONiR_Redirect_Fnc($facebook_login_url);

      }


    }
    


    $SHONiR_Main['meta_title'] = 'Login with Google or Facebook';

    $SHONiR_Main['meta_description'] = ' Continue with Google or Facebook,  Phone number, username, or email. Password.';
    
    $SHONiR_Main['meta_keyword'] = 'login with google, login with facebook, login with gmail';

    $SHONiR_Data["Categories_Tree"] = SHONiR_Categories_Tree_Fnc(0, 'c.status=1 and c.listed=1', SHONiR_LANGUAGE['language_id']);

    $SHONiR_Data["Pages_Tree"] = SHONiR_Pages_Tree_Fnc(0, 'p.status=1 and p.listed=1', SHONiR_LANGUAGE['language_id']);

    $SHONiR_Data["Recently_Viewed_Products"] = SHONiR_Get_Products_Fnc(TRUE, 0, "p.status=1 and p.listed=1", "p.last_hit", "desc", SHONiR_SETTINGS['config_records_limit']);

    $GLOBALS['SHONiR_VIEWS_FILE'] = 'customer_login';

    $SHONiR_Data["SHONiR_Main"] =  $SHONiR_Main;

    return $SHONiR_Data;
    


    }


    
    

}




?>