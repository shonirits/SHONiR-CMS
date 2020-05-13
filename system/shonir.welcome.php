<?php defined('SHONiR') OR exit('No direct script access allowed');

function SHONiR_Welcome_Fnc_Render(){
  
    $SHONiR_Data = array();

    $SHONiR_Data["Categories_Tree"] = SHONiR_Categories_Tree_Fnc(0, 'c.status=1 and c.listed=1', SHONiR_LANGUAGE['language_id']);

    $SHONiR_Data["Pages_Tree"] = SHONiR_Pages_Tree_Fnc(0, 'p.status=1 and p.listed=1', SHONiR_LANGUAGE['language_id']);

    $SHONiR_Data["Featured_Categories"] = SHONiR_Get_Categories_Fnc(0, "c.status=1 and c.featured=1");

    $SHONiR_Data["Featured_Products"] = SHONiR_Get_Products_Fnc(TRUE, 0, "p.status=1 and p.featured=1", "p.add_time", "desc", SHONiR_SETTINGS['config_records_limit']);

    $SHONiR_Data["Trending_Products"] = SHONiR_Get_Products_Fnc(TRUE, 0, "p.status=1 and p.listed=1", "p.viewed desc, p.hits", "desc", SHONiR_SETTINGS['config_records_limit']);

    $SHONiR_Data["Recently_Viewed_Products"] = SHONiR_Get_Products_Fnc(TRUE, 0, "p.status=1 and p.listed=1", "p.last_hit", "desc", SHONiR_SETTINGS['config_records_limit']);

    $SHONiR_Data["SHONiR_Main"] = SHONiR_Page_Details_Fnc(10);

    $SHONiR_Data["SHONiR_Contact"] = SHONiR_Page_Details_Fnc(14);

return $SHONiR_Data;

}


function SHONiR_AP_Welcome_Fnc_Render(){    


    if(SHONiR_USER['user_type'] == 'Administrator'){

        $SHONiR_Login =  SHONiR_AP_Login_Fnc(SHONiR_USER['username'], SHONiR_USER['password']);

        if($SHONiR_Login == 'success'){

            SHONiR_Redirect_Fnc(SHONiR_APANEL.'Dashboard?S');
    
          }

    }elseif(SHONiR_Cookie_Exist_Fnc('SHONiR_AP_Username') && SHONiR_Cookie_Exist_Fnc('SHONiR_AP_Password')){

      $SHONiR_Login = SHONiR_AP_Login_Fnc(SHONiR_Cookie_Read_Fnc('SHONiR_AP_Username'), SHONiR_Cookie_Read_Fnc('SHONiR_AP_Password'), 1);

      if($SHONiR_Login == 'success'){

        SHONiR_Redirect_Fnc(SHONiR_APANEL.'Dashboard?C');

      }

    }

    $SHONiR_Data = array();

    $SHONiR_Main = array();

    if(SHONiR_Cookie_Exist_Fnc('SHONiR_AP_Username')){

        $SHONiR_Username = SHONiR_Cookie_Read_Fnc('SHONiR_AP_Username');

    }else{

        $SHONiR_Username = '';

    }

    $SHONiR_Main['username'] = $SHONiR_Username;

    $SHONiR_Main['password'] = '';

    $SHONiR_Main['meta_title'] = 'Welcome to SHONiR Administrator Panel. Created with LOVE by SHONiR';

    $SHONiR_Main['meta_description'] = '';
    
    $SHONiR_Main['meta_keyword'] = '';

    $SHONiR_Data["SHONiR_Main"] =  $SHONiR_Main;

return $SHONiR_Data;

}




?>