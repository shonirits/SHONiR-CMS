<?php defined('SHONiR') OR exit('No direct script access allowed');

function SHONiR_Get_Comments_Fnc($SHONiR_Parent = 0,  $SHONiR_Parent_Type = '', $SHONiR_Where = FALSE, $SHONiR_Order = 'c.add_time', $SHONiR_By = 'desc', $SHONiR_Limit = FALSE, $SHONiR_Keywords = null){

  $SHONiR_Data = array(); 

  $SHONiR_SQL = 'select * from tbl_comments c ';

  $SHONiR_Query_Where = FALSE;
  
  $SHONiR_SQL_Limit = '';

  $SHONiR_SQL_Sort = '';

  if($SHONiR_Parent){

    if($SHONiR_Query_Where == FALSE){

      $SHONiR_SQL .= " where "; 
      $SHONiR_Query_Where = TRUE;

    }else{

      $SHONiR_SQL .= " and "; 

    }

    $SHONiR_SQL .= " c.parent_id=".$SHONiR_Parent; 

}

if($SHONiR_Parent_Type){

  if($SHONiR_Query_Where == FALSE){

    $SHONiR_SQL .= " where "; 
    $SHONiR_Query_Where = TRUE;

  }else{

    $SHONiR_SQL .= " and "; 

  }

  $SHONiR_SQL .= " c.parent_type='".$SHONiR_Parent_Type."'"; 

}

if($SHONiR_Where){

  if($SHONiR_Query_Where == FALSE){

    $SHONiR_SQL .= " where "; 
    $SHONiR_Query_Where = TRUE;

  }else{

    $SHONiR_SQL .= " and "; 

  }

  $SHONiR_SQL .= $SHONiR_Where; 

}

  if($SHONiR_Keywords){

    if($SHONiR_Query_Where == FALSE){

      $SHONiR_SQL .= " where "; 
      $SHONiR_Query_Where = TRUE;

    }else{

      $SHONiR_SQL .= " and "; 

    }

      $SHONiR_SQL .= "(c.details LIKE '%".$SHONiR_Keywords."%' OR c.comment_id LIKE '%".$SHONiR_Keywords."%' OR c.user_id LIKE '%".$SHONiR_Keywords."%' OR c.parent_id LIKE '%".$SHONiR_Keywords."%'  )";
  }






  $SHONiR_SQL_Sort = " order by ".$SHONiR_Order."  ".$SHONiR_By." ";

  if($SHONiR_Limit !== FALSE){

  $SHONiR_SQL_Limit = "  limit ".$SHONiR_Limit;

  }

  $SHONiR_Query_Run = $SHONiR_SQL.$SHONiR_SQL_Sort.$SHONiR_SQL_Limit;

  $SHONiR_Query = SHONiR_Query_Fnc($SHONiR_Query_Run);

  $SHONiR_Row = SHONiR_Row_Fnc($SHONiR_Query);

  if($SHONiR_Row > 0 ){       

   $SHONiR_Data = SHONiR_Fetch_All_ASSOC_Fnc($SHONiR_Query);

  }else{

      $SHONiR_Data = false;

  }   

return $SHONiR_Data;

}



?>