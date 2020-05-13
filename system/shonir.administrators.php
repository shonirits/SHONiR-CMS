<?php defined('SHONiR') OR exit('No direct script access allowed');



function SHONiR_AP_Login_Fnc($SHONiR_Username, $SHONiR_Password, $SHONiR_Remember = 0){

    $SHONiR_Data = SHONiR_AP_Administrator_Fnc($SHONiR_Username, 'username');

    $SHONiR_Again_Attempt = 0;
    $SHONiR_Return = '';

    if($SHONiR_Data){

        if($SHONiR_Data['total_attempt'] > 3 && $SHONiR_Data['again_attempt']>time()){

            $SHONiR_Again_Attempt = (time() + ($SHONiR_Data['total_attempt']*60*60));
    
            $SHONiR_Time_Difference = SHONiR_Time_Difference_Fnc(time(), $SHONiR_Again_Attempt);
    
            SHONiR_Query_Fnc("update tbl_administrators set total_attempt=total_attempt+1, last_attempt=".time().", again_attempt =".$SHONiR_Again_Attempt." where administrator_id=".$SHONiR_Data['administrator_id']."");
            
            $SHONiR_Return = '<div class="alert alert-danger" role="alert"><b>Error:</b> Too many failed login attempts. Please try again after '.$SHONiR_Time_Difference.'</div>';    
    
        }else{
            
       if($SHONiR_Data['password'] ==$SHONiR_Password){  
           
        if($SHONiR_Data['status'] == 0 ){

            if($SHONiR_Data['total_attempt']>3){

                $SHONiR_Again_Attempt = (time() + ($SHONiR_Data['total_attempt']*60*60));
    
             }

             SHONiR_Query_Fnc("update tbl_administrators set total_attempt=total_attempt+1, last_attempt=".time().",  again_attempt =".$SHONiR_Again_Attempt." where administrator_id=".$SHONiR_Data['administrator_id']."");

             $SHONiR_Return = '<div class="alert alert-danger" role="alert"><b>Error:</b> Your account has to be confirmed by an administrator before you can login.</div>';

        }elseif($SHONiR_Data['status'] == 1 ){

            SHONiR_Query_Fnc("update tbl_administrators set total_attempt=0, last_attempt=0, again_attempt=0 where administrator_id=".$SHONiR_Data['administrator_id']."");

            SHONiR_Query_Fnc("update tbl_visitors set user_id=".$SHONiR_Data['administrator_id'].", user_type=1 where session_id='".$GLOBALS['SHONiR_SESSION_ID']."'");
                
            $SHONiR_User = array();

            $SHONiR_User['user_id'] = $SHONiR_Data['administrator_id'];
            $SHONiR_User['user_type'] = 1;            
            
            SHONiR_Session_Write_Fnc('SHONiR_User', array_merge($SHONiR_User,$SHONiR_Data));

            SHONiR_Session_Write_Fnc('SHONiR_AP_Username', $SHONiR_Username);
            SHONiR_Session_Write_Fnc('SHONiR_AP_Password', $SHONiR_Password);

            SHONiR_Cookie_Write_Fnc('SHONiR_AP_Username', $SHONiR_Username, 3600*24*30);

            if($SHONiR_Remember)
            {
            
            SHONiR_Cookie_Write_Fnc('SHONiR_AP_Password', $SHONiR_Password, 3600*24*30);

            }else{

                SHONiR_Cookie_Delete_Fnc('SHONiR_AP_Password');
            }

            $SHONiR_Return = 'success';

        }else{

            if($SHONiR_Data['total_attempt']>3){

                $SHONiR_Again_Attempt = (time() + ($SHONiR_Data['total_attempt']*60*60));
    
             }
     
             SHONiR_Query_Fnc("update tbl_administrators set total_attempt=total_attempt+1, last_attempt=".time().", again_attempt =".$SHONiR_Again_Attempt." where administrator_id=".$SHONiR_Data['administrator_id']."");
    
             $SHONiR_Return =  '<div class="alert alert-danger" role="alert"><b>Error:</b> Your account has been disabled or suspended. If you belive this is in error, please contact at WhatsApp +92-333-333-6426 or email at info@shonir.com or for more information visit developer website www.shonir.com.</div>';
    
        }


        }else{

            if($SHONiR_Data['total_attempt']>3){
    
                $SHONiR_Again_Attempt = (time() + ($SHONiR_Data['total_attempt']*60*60));
    
             }
     
             SHONiR_Query_Fnc("update tbl_administrators set total_attempt=total_attempt+1, last_attempt=".time().", again_attempt =".$SHONiR_Again_Attempt." where administrator_id=".$SHONiR_Data['administrator_id']."");
             
             $SHONiR_Return = '<div class="alert alert-danger" role="alert"><b>Error:</b> Incorrect username or password.</div>';
    
            }
        }

    }else{

        $SHONiR_Return =  '<div class="alert alert-danger" role="alert"><b>Error:</b> Incorrect username or password.</div>';
    }

    return $SHONiR_Return ;

}

function SHONiR_AP_Administrator_Fnc($SHONiR_Value, $SHONiR_Key = 'administrator_id'){


    $SHONiR_Query_Administrator = SHONiR_Query_Fnc("select * from tbl_administrators where ".$SHONiR_Key."='".$SHONiR_Value."'");

    $SHONiR_Row_Administrator = SHONiR_Row_Fnc($SHONiR_Query_Administrator);

    if($SHONiR_Row_Administrator > 0){

        $SHONiR_Return = SHONiR_Fetch_Fnc($SHONiR_Query_Administrator);

    }else{

        $SHONiR_Return = FALSE;

    }

    return $SHONiR_Return;


}


?>