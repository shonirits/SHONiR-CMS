<?php defined('SHONiR') OR exit('No direct script access allowed');

function SHONiR_Cookie_Write_Fnc($SHONiR_Key, $SHONiR_Value = null, $SHONiR_Age = 3600, $SHONiR_Path = '/'){

    $SHONiR_Return = FALSE;

    if ( is_string($SHONiR_Key) ) {

        setcookie($SHONiR_Key, $SHONiR_Value, time()+$SHONiR_Age, $SHONiR_Path);

        $SHONiR_Return = TRUE;
    
    }
    
    return $SHONiR_Return;

}

function SHONiR_Cookie_Read_Fnc($SHONiR_Key, $SHONiR_Child = FALSE){

    $SHONiR_Return = FALSE;

    if ( is_string($SHONiR_Key) ) {

        if (isset($_COOKIE) && is_array($_COOKIE) && array_key_exists($SHONiR_Key, $_COOKIE)) {

            if ($SHONiR_Child == FALSE)
            {
                $SHONiR_Return = $_COOKIE[$SHONiR_Key];

            }
            else
            {
                if (isset($_COOKIE[$SHONiR_Key][$SHONiR_Child]))
                {
                    $SHONiR_Return = $_COOKIE[$SHONiR_Key][$SHONiR_Child];
                }
            }

        }
    
    }

    return $SHONiR_Return;

}

function SHONiR_Cookie_Exist_Fnc($SHONiR_Key, $SHONiR_Child = FALSE){

    $SHONiR_Return = FALSE;

    if ( is_string($SHONiR_Key) ) {

        if (isset($_COOKIE) && is_array($_COOKIE) && array_key_exists($SHONiR_Key, $_COOKIE)) {

            if ($SHONiR_Child == FALSE)
            {
                $SHONiR_Return = TRUE;

            }
            else
            {
                if (isset($_COOKIE[$SHONiR_Key][$SHONiR_Child]))
                {
                    $SHONiR_Return = TRUE;
                }
            }

        }
    
    }

    return $SHONiR_Return;

}

function SHONiR_Cookie_Delete_Fnc($SHONiR_Key, $SHONiR_Path = '/'){

    $SHONiR_Return = FALSE;

    if ( is_string($SHONiR_Key) ) {

        if (isset($_COOKIE[$SHONiR_Key]))  {

            unset($_COOKIE[$SHONiR_Key]);

          setcookie($SHONiR_Key, "", time() - 3600, $SHONiR_Path);            

            $SHONiR_Return = TRUE;

        }
    
    }    

    return $SHONiR_Return;

}





?>