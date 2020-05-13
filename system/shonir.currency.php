<?php defined('SHONiR') OR exit('No direct script access allowed');

function SHONiR_Currencies_Fnc($SHONiR_ID = FALSE, $SHONiR_Status = FALSE, $SHONiR_By = 'asc', $SHONiR_Limit = FALSE){

    $SHONiR_Data = array();
    
    if($SHONiR_ID){

        $SHONiR_Query_Currency = SHONiR_Query_Fnc("select * from tbl_currencies where currency_id=".$SHONiR_ID ."");

$SHONiR_Row_Currency = SHONiR_Row_Fnc($SHONiR_Query_Currency);

if($SHONiR_Row_Currency > 0 ){   
    
    $SHONiR_Data = SHONiR_Fetch_Fnc($SHONiR_Query_Currency);

}else{

    $SHONiR_Data = false;

}

}else{

    $SHONiR_SQL_Currencies = "select * from tbl_currencies " ;

    $SHONiR_SQL_Currencies_Where = '';
    $SHONiR_SQL_Currencies_Limit = '';

    if($SHONiR_Status !== FALSE){

    $SHONiR_SQL_Currencies_Where = " where status =".$SHONiR_Status;

    }

    $SHONiR_SQL_Currencies_Sort = " order by sort_order  ".$SHONiR_By." ";

    if($SHONiR_Limit !== FALSE){

    $SHONiR_SQL_Currencies_Limit = "  limit ".$SHONiR_Limit;

    }

    $SHONiR_Query_Currencies = SHONiR_Query_Fnc($SHONiR_SQL_Currencies.$SHONiR_SQL_Currencies_Where.$SHONiR_SQL_Currencies_Sort.$SHONiR_SQL_Currencies_Limit);

    $SHONiR_Row_Currencies = SHONiR_Row_Fnc($SHONiR_Query_Currencies);

    if($SHONiR_Row_Currencies > 0 ){  
        
        while($row =  SHONiR_Fetch_Fnc($SHONiR_Query_Currencies))
{
    $SHONiR_Data[] = $row;
}

    }else{

        $SHONiR_Data = false;

    }   


    }
 
return $SHONiR_Data;

}




?>