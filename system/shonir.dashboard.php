<?php defined('SHONiR') OR exit('No direct script access allowed');

function SHONiR_Dashboard_Fnc(){


}


function SHONiR_AP_Dashboard_Fnc_Render(){

       $SHONiR_Second =  SHONiR_URI['Second'];

          if($SHONiR_Second == 'Cache'){

      $SHONiR_Cache_Files = glob(SHONiR_ROOT.'cache/*');
      $SHONiR_C = 0;
foreach($SHONiR_Cache_Files as $SHONiR_Cache_File){
  if(is_file($SHONiR_Cache_File)){
    unlink($SHONiR_Cache_File);
    $SHONiR_C++;
}
          }
          $SHONiR_Alert['type'] = 'success';
          $SHONiR_Alert['message'] = 'All '.$SHONiR_C.' cache files has been deleted successfully.';
          SHONiR_Session_Write_Fnc('SHONiR_Alert', $SHONiR_Alert);

          SHONiR_Redirect_Fnc(SHONiR_APANEL.'Dashboard');

          }

          $SHONiR_Query_Bot = SHONiR_Query_Fnc("select count(*) as total from tbl_visitors where bot=1");

          $SHONiR_Fetch_Bot = SHONiR_Fetch_Fnc($SHONiR_Query_Bot);

          $SHONiR_Query_Referer = SHONiR_Query_Fnc("select count(*) as total from tbl_visitors where referer<>''");

          $SHONiR_Fetch_Referer = SHONiR_Fetch_Fnc($SHONiR_Query_Referer);

          $SHONiR_Query_Direct = SHONiR_Query_Fnc("select count(*) as total from tbl_visitors where bot<>1 and referer=''");

          $SHONiR_Fetch_Direct = SHONiR_Fetch_Fnc($SHONiR_Query_Direct);

          $SHONiR_Query_Mobile = SHONiR_Query_Fnc("select count(*) as total from tbl_visitors where mobile=1");

          $SHONiR_Fetch_Mobile = SHONiR_Fetch_Fnc($SHONiR_Query_Mobile);

          $SHONiR_Query_Desktop = SHONiR_Query_Fnc("select count(*) as total from tbl_visitors where mobile<>1");

          $SHONiR_Fetch_Desktop = SHONiR_Fetch_Fnc($SHONiR_Query_Desktop);

          $SHONiR_1dayago = date('d.m.Y',strtotime("-1 days"));

          $SHONiR_Query_1dayago = SHONiR_Query_Fnc("select count(*) as total from tbl_visitors where FROM_UNIXTIME(add_time, '%d.%m.%Y')='".$SHONiR_1dayago."'");

          $SHONiR_Fetch_1dayago = SHONiR_Fetch_Fnc($SHONiR_Query_1dayago);

          $SHONiR_2dayago = date('d.m.Y',strtotime("-2 days"));

          $SHONiR_Query_2dayago = SHONiR_Query_Fnc("select count(*) as total from tbl_visitors where FROM_UNIXTIME(add_time, '%d.%m.%Y')='".$SHONiR_2dayago."'");

          $SHONiR_Fetch_2dayago = SHONiR_Fetch_Fnc($SHONiR_Query_2dayago);

          $SHONiR_3dayago = date('d.m.Y',strtotime("-3 days"));

          $SHONiR_Query_3dayago = SHONiR_Query_Fnc("select count(*) as total from tbl_visitors where FROM_UNIXTIME(add_time, '%d.%m.%Y')='".$SHONiR_3dayago."'");

          $SHONiR_Fetch_3dayago = SHONiR_Fetch_Fnc($SHONiR_Query_3dayago);

          $SHONiR_4dayago = date('d.m.Y',strtotime("-4 days"));

          $SHONiR_Query_4dayago = SHONiR_Query_Fnc("select count(*) as total from tbl_visitors where FROM_UNIXTIME(add_time, '%d.%m.%Y')='".$SHONiR_4dayago."'");

          $SHONiR_Fetch_4dayago = SHONiR_Fetch_Fnc($SHONiR_Query_4dayago);

          $SHONiR_5dayago = date('d.m.Y',strtotime("-5 days"));

          $SHONiR_Query_5dayago = SHONiR_Query_Fnc("select count(*) as total from tbl_visitors where FROM_UNIXTIME(add_time, '%d.%m.%Y')='".$SHONiR_5dayago."'");

          $SHONiR_Fetch_5dayago = SHONiR_Fetch_Fnc($SHONiR_Query_5dayago);

          $SHONiR_6dayago = date('d.m.Y',strtotime("-6 days"));

          $SHONiR_Query_6dayago = SHONiR_Query_Fnc("select count(*) as total from tbl_visitors where FROM_UNIXTIME(add_time, '%d.%m.%Y')='".$SHONiR_6dayago."'");

          $SHONiR_Fetch_6dayago = SHONiR_Fetch_Fnc($SHONiR_Query_6dayago);

          $SHONiR_7dayago = date('d.m.Y',strtotime("-7 days"));

          $SHONiR_Query_7dayago = SHONiR_Query_Fnc("select count(*) as total from tbl_visitors where FROM_UNIXTIME(add_time, '%d.%m.%Y')='".$SHONiR_7dayago."'");

          $SHONiR_Fetch_7dayago = SHONiR_Fetch_Fnc($SHONiR_Query_7dayago);

          $SHONiR_Query = "select * from tbl_visitors order by add_time  desc";

          $SHONiR_Total_Records = SHONiR_Row_Fnc(SHONiR_Query_Fnc($SHONiR_Query));

          $SHONiR_Page_No = SHONiR_Get_Fnc('n');

          $SHONiR_Records_Limit = SHONiR_SETTINGS['config_records_limit'];

    $SHONiR_Total_Pages = ceil($SHONiR_Total_Records / $SHONiR_Records_Limit);

    if(!ctype_digit($SHONiR_Page_No) || $SHONiR_Page_No<1 || $SHONiR_Page_No>$SHONiR_Total_Pages){

        $SHONiR_Page_No = 1;
    }

    $SHONiR_Start = ($SHONiR_Page_No-1) * $SHONiR_Records_Limit;

          $SHONiR_SQL_Pagination_Limit = "  limit ".$SHONiR_Start.", ".$SHONiR_Records_Limit;

          $SHONiR_Query_Pagination = SHONiR_Query_Fnc($SHONiR_Query.$SHONiR_SQL_Pagination_Limit);

          $SHONiR_Row_Pagination = SHONiR_Row_Fnc($SHONiR_Query_Pagination);

          if($SHONiR_Row_Pagination > 0 ){

          $SHONiR_Rows = SHONiR_Fetch_All_ASSOC_Fnc($SHONiR_Query_Pagination);

          $SHONiR_Page = SHONiR_APANEL.'Dashboard?';

          $SHONiR_Style = 'float-right';

          $SHONiR_Main['SHONiR_Pagination'] =  SHONiR_Pagination_Fnc($SHONiR_Page_No, $SHONiR_Records_Limit, $SHONiR_Total_Pages, $SHONiR_Total_Records, $SHONiR_Start, $SHONiR_Row_Pagination, $SHONiR_Rows, $SHONiR_Page, True, True, $SHONiR_Style);

          }else{

            $SHONiR_Main['SHONiR_Pagination'] = false;

          }


          $SHONiR_Main['Updates']  = SHONiR_Read_XML_Fnc("https://www.shonir.com/media/updates.xml");

    $SHONiR_Main['meta_title'] = 'Welcome to SHONiR Administrator Panel. Created with LOVE by SHONiR';

    $SHONiR_Main['meta_description'] = '';

    $SHONiR_Main['meta_keyword'] = '';

    $SHONiR_Main['1dayago'] = $SHONiR_Fetch_1dayago['total'];

    $SHONiR_Main['2dayago'] = $SHONiR_Fetch_2dayago['total'];

    $SHONiR_Main['3dayago'] = $SHONiR_Fetch_3dayago['total'];

    $SHONiR_Main['4dayago'] = $SHONiR_Fetch_4dayago['total'];

    $SHONiR_Main['5dayago'] = $SHONiR_Fetch_5dayago['total'];

    $SHONiR_Main['6dayago'] = $SHONiR_Fetch_6dayago['total'];

    $SHONiR_Main['7dayago'] = $SHONiR_Fetch_7dayago['total'];

    $SHONiR_Main['Referer'] = $SHONiR_Fetch_Referer['total'];

    $SHONiR_Main['Direct'] = $SHONiR_Fetch_Direct['total'];

    $SHONiR_Main['Bot'] = $SHONiR_Fetch_Bot['total'];

    $SHONiR_Main['Mobile'] = $SHONiR_Fetch_Mobile['total'];

    $SHONiR_Main['Desktop'] = $SHONiR_Fetch_Desktop['total'];

    $SHONiR_Data["SHONiR_Main"] =  $SHONiR_Main;

return $SHONiR_Data;


}




?>
