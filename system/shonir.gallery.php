<?php defined('SHONiR') OR exit('No direct script access allowed');

function SHONiR_Gallery_Fnc_Render(){

    $SHONiR_Main = SHONiR_Page_Details_Fnc(16, ' and p.status=1 ', SHONiR_LANGUAGE['language_id']);

    $SHONiR_Data["Categories_Tree"] = SHONiR_Categories_Tree_Fnc(0, 'c.status=1 and c.listed=1', SHONiR_LANGUAGE['language_id']);

    $SHONiR_Data["Pages_Tree"] = SHONiR_Pages_Tree_Fnc(0, 'p.status=1 and p.listed=1', SHONiR_LANGUAGE['language_id']);

    $SHONiR_Data["Recently_Viewed_Products"] = SHONiR_Get_Products_Fnc(TRUE,0, "p.status=1 and p.listed=1", "p.last_hit", "desc", SHONiR_SETTINGS['config_records_limit']);

    $SHONiR_Data["Main_Banners"] = SHONiR_Get_Banners_Fnc(TRUE, TRUE, "parent_id='gallery' and b.status=1  and b.listed=1 ", 'b.viewed', 'asc');

    $SHONiR_Data["Images"] = SHONiR_Get_Banners_Fnc(TRUE, TRUE, "parent_id='gallery_images' and b.status=1  and b.listed=1 ", 'b.viewed', 'asc');

    $SHONiR_Data["SHONiR_Main"] =  $SHONiR_Main;
                    
    $GLOBALS['SHONiR_VIEWS_FILE'] = 'gallery';

                    return $SHONiR_Data;


}

?>