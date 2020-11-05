<?php defined('SHONiR') OR exit('No direct script access allowed');




function SHONiR_AP_Logout_Fnc_Render(){

    SHONiR_AP_Logout_Fnc();

    SHONiR_Session_New_Fnc();

    $SHONiR_Alert['type'] = 'success';
    $SHONiR_Alert['message'] = 'You have successfully logged out!';
    SHONiR_Session_Write_Fnc('SHONiR_Alert', $SHONiR_Alert);

    SHONiR_Redirect_Fnc(SHONiR_APANEL.'Welcome');

}




?>