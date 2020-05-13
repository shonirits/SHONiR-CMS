<?php defined('SHONiR') OR exit('No direct script access allowed');




function SHONiR_AP_Logout_Fnc_Render(){

    SHONiR_Session_Delete_Fnc('SHONiR_User');
    SHONiR_Session_Delete_Fnc('SHONiR_AP_Username');
    SHONiR_Session_Delete_Fnc('SHONiR_AP_Password');
    SHONiR_Cookie_Delete_Fnc('SHONiR_AP_Password');

    SHONiR_Session_New_Fnc();

    $SHONiR_Alert['type'] = 'success';
    $SHONiR_Alert['message'] = 'You have successfully logged out!';
    SHONiR_Session_Write_Fnc('SHONiR_Alert', $SHONiR_Alert);

    SHONiR_Redirect_Fnc(SHONiR_APANEL.'Welcome');

}




?>