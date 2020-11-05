<?php defined('SHONiR') OR exit('No direct script access allowed');

function SHONiR_Welcome_Fnc_Render(){
  
    $SHONiR_Data = array();

    $SHONiR_Data["Categories_Tree"] = SHONiR_Categories_Tree_Fnc(0, 'c.status=1 and c.listed=1', SHONiR_LANGUAGE['language_id']);

    $SHONiR_Data["Pages_Tree"] = SHONiR_Pages_Tree_Fnc(0, 'p.status=1 and p.listed=1', SHONiR_LANGUAGE['language_id']);

    $SHONiR_Data["Featured_Categories"] = SHONiR_Get_Categories_Fnc(0, "c.status=1 and c.featured=1");

    $SHONiR_Escape_Rows = '';

    $SHONiR_Data["New_Products"] = SHONiR_Get_Products_Fnc(TRUE, 0, "p.status=1 and p.listed=1", "p.add_time", "desc", SHONiR_SETTINGS['config_records_limit']);

    if($SHONiR_Data["New_Products"]){
      foreach ($SHONiR_Data["New_Products"] as $New_key => $New_value)
              {
  
                  $SHONiR_Escape_Rows .= ' and p.product_id<>'.$New_value['product_id'];
              }
         }

    $SHONiR_Data["Featured_Products"] = SHONiR_Get_Products_Fnc(TRUE, 0, "p.status=1 and p.listed=1 and p.featured=1", "p.add_time", "desc", SHONiR_SETTINGS['config_records_limit']);

    if($SHONiR_Data["Featured_Products"]){
      foreach ($SHONiR_Data["Featured_Products"] as $Featured_key => $Featured_value)
              {
  
                  $SHONiR_Escape_Rows .= ' and p.product_id<>'.$Featured_value['product_id'];
              }
         }

    $SHONiR_Data["Trending_Products"] = SHONiR_Get_Products_Fnc(TRUE, 0, "p.status=1 and p.listed=1", "p.viewed desc, p.hits", "desc", SHONiR_SETTINGS['config_records_limit']);

    if($SHONiR_Data["Trending_Products"]){
      foreach ($SHONiR_Data["Trending_Products"] as $Trending_key => $Trending_value)
              {
  
                  $SHONiR_Escape_Rows .= ' and p.product_id<>'.$Trending_value['product_id'];
              }
         }

    $SHONiR_Data["Main_Banners"] = SHONiR_Get_Banners_Fnc(TRUE, TRUE, "parent_id='homepage_main' and b.status=1  and b.listed=1 ", 'b.viewed', 'asc');

    $SHONiR_Data["homepage_one"] = SHONiR_Get_Banners_Fnc(TRUE, TRUE, "parent_id='homepage_one' and b.status=1  and b.listed=1 ", 'b.viewed', 'asc', 1);

    $SHONiR_Data["homepage_two"] = SHONiR_Get_Banners_Fnc(TRUE, TRUE, "parent_id='homepage_two' and b.status=1  and b.listed=1 ", 'b.viewed', 'asc', 1);

    $SHONiR_Data["homepage_three"] = SHONiR_Get_Banners_Fnc(TRUE, TRUE, "parent_id='homepage_three' and b.status=1  and b.listed=1 ", 'b.viewed', 'asc', 1);

    $SHONiR_Data["homepage_four"] = SHONiR_Get_Banners_Fnc(TRUE, TRUE, "parent_id='homepage_four' and b.status=1  and b.listed=1 ", 'b.viewed', 'asc', 1);

    $SHONiR_Data["homepage_five"] = SHONiR_Get_Banners_Fnc(TRUE, TRUE, "parent_id='homepage_five' and b.status=1  and b.listed=1 ", 'b.viewed', 'asc', 1);

    $SHONiR_Data["homepage_six"] = SHONiR_Get_Banners_Fnc(TRUE, TRUE, "parent_id='homepage_six' and b.status=1  and b.listed=1 ", 'b.viewed', 'asc', 1);

    $SHONiR_Data["Featured_Blogs"] = SHONiR_Get_Blogs_Fnc(TRUE, 0, "b.status=1 and b.featured=1 and b.published_time<".time(), "b.published_time", "desc", 3);

    $SHONiR_Data["Recently_Viewed_Products"] = SHONiR_Get_Products_Fnc(TRUE, 0, "p.status=1 and p.listed=1", "p.last_hit", "desc", SHONiR_SETTINGS['config_records_limit']);

    $SHONiR_Data["SHONiR_Main"] = SHONiR_Page_Details_Fnc(10);

    $SHONiR_Data["SHONiR_Contact"] = SHONiR_Page_Details_Fnc(14);

return $SHONiR_Data;

}


function SHONiR_AP_Welcome_Fnc_Render(){    


    if(SHONiR_USER['user_type'] == 1){

        $SHONiR_Login =  SHONiR_AP_Login_Fnc(SHONiR_USER['user_id'], SHONiR_USER['password']);

        if($SHONiR_Login == 'success'){

            SHONiR_Redirect_Fnc(SHONiR_APANEL.'Dashboard?S');
    
          }

    }elseif(SHONiR_Cookie_Exist_Fnc('SHONiR_AP_ID') && SHONiR_Cookie_Exist_Fnc('SHONiR_AP_Password')){

      $SHONiR_Login = SHONiR_AP_Login_Fnc(SHONiR_Cookie_Read_Fnc('SHONiR_AP_ID'), SHONiR_Cookie_Read_Fnc('SHONiR_AP_Password'), 1);

      if($SHONiR_Login == 'success'){

        SHONiR_Redirect_Fnc(SHONiR_APANEL.'Dashboard?C');

      }

    }

    $SHONiR_Data = array();

    $SHONiR_Main = array();

    $SHONiR_Main['username'] = '';

    $SHONiR_Main['password'] = '';

    $SHONiR_Main['meta_title'] = 'Welcome to SHONiR Administrator Panel. Created with LOVE by SHONiR';

    $SHONiR_Main['meta_description'] = '';
    
    $SHONiR_Main['meta_keyword'] = '';

    $SHONiR_Data["SHONiR_Main"] =  $SHONiR_Main;

return $SHONiR_Data;

}




?>