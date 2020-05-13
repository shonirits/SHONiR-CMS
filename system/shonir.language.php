<?php defined('SHONiR') OR exit('No direct script access allowed');

function SHONiR_Languages_Fnc($SHONiR_ID = FALSE, $SHONiR_Status = FALSE, $SHONiR_By = 'asc', $SHONiR_Limit = FALSE){

    $SHONiR_Data = array();    


    if($SHONiR_ID){

        $SHONiR_Query_Language = SHONiR_Query_Fnc("select * from tbl_languages where language_id=".$SHONiR_ID ."");

$SHONiR_Row_Language = SHONiR_Row_Fnc($SHONiR_Query_Language);

if($SHONiR_Row_Language > 0 ){   
    
    $SHONiR_Data = SHONiR_Fetch_Fnc($SHONiR_Query_Language);

}else{

    $SHONiR_Data = false;

}

}else{

    $SHONiR_SQL_Languages = "select * from tbl_languages " ;

    $SHONiR_SQL_Languages_Where = '';
    $SHONiR_SQL_Languages_Limit = '';

    if($SHONiR_Status !== FALSE){

    $SHONiR_SQL_Languages_Where = " where status =".$SHONiR_Status;

    }

    $SHONiR_SQL_Languages_Sort = " order by sort_order  ".$SHONiR_By." ";

    if($SHONiR_Limit !== FALSE){

    $SHONiR_SQL_Languages_Limit = "  limit ".$SHONiR_Limit;

    }

    $SHONiR_Query_Languages = SHONiR_Query_Fnc($SHONiR_SQL_Languages.$SHONiR_SQL_Languages_Where.$SHONiR_SQL_Languages_Sort.$SHONiR_SQL_Languages_Limit);

    $SHONiR_Row_Languages = SHONiR_Row_Fnc($SHONiR_Query_Languages);

    if($SHONiR_Row_Languages > 0 ){  
        
        while($row =  SHONiR_Fetch_Fnc($SHONiR_Query_Languages))
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