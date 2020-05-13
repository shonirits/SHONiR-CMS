<?php defined('SHONiR') OR exit('No direct script access allowed');

function SHONiR_Session_Write_Fnc($SHONiR_Key, $SHONiR_Value = null){

    $SHONiR_Return = FALSE;

    if ( is_string($SHONiR_Key) ) {

        $_SESSION[$SHONiR_Key] = $SHONiR_Value;

        $SHONiR_Return = TRUE;
    
    }

    return $SHONiR_Return;

}

function SHONiR_Session_Read_Fnc($SHONiR_Key, $SHONiR_Child = FALSE){

    $SHONiR_Return = FALSE;

    if ( is_string($SHONiR_Key) ) {

        if (isset($_SESSION[$SHONiR_Key]))  {

            if ($SHONiR_Child == FALSE)
            {
                $SHONiR_Return = $_SESSION[$SHONiR_Key];

            }
            else
            {
                if (isset($_SESSION[$SHONiR_Key][$SHONiR_Child]))
                {
                    $SHONiR_Return = $_SESSION[$SHONiR_Key][$SHONiR_Child];
                }
            }

        }
    
    }

    return $SHONiR_Return;

}

function SHONiR_Session_Exist_Fnc($SHONiR_Key, $SHONiR_Child = FALSE){

    $SHONiR_Return = FALSE;

    if ( is_string($SHONiR_Key) ) {

        if (isset($_SESSION[$SHONiR_Key]))  {

            if ($SHONiR_Child == FALSE)
            {
                $SHONiR_Return = TRUE;

            }
            else
            {
                if (isset($_SESSION[$SHONiR_Key][$SHONiR_Child]))
                {
                    $SHONiR_Return = TRUE;
                }
            }

        }
    
    }

    return $SHONiR_Return;

}

function SHONiR_Session_Delete_Fnc($SHONiR_Key){

    $SHONiR_Return = FALSE;

    if ( is_string($SHONiR_Key) ) {

        if (isset($_SESSION[$SHONiR_Key]))  {

            unset($_SESSION[$SHONiR_Key]);

            $SHONiR_Return = TRUE;

        }
    
    }    

    return $SHONiR_Return;

}

function SHONiR_Session_New_Fnc(){
    if(!isset($_SESSION)){
    session_start();
    }
    $_SESSION = array();

    if (ini_get("session.use_cookies")) {
        $params = session_get_cookie_params();
        setcookie(session_name(), '', time() - 42000,
            $params["path"], $params["domain"],
            $params["secure"], $params["httponly"]
        );
    }
       
    session_regenerate_id();
    session_destroy();

    session_start();

    session_regenerate_id();
    session_regenerate_id(true);

}

function SHONiR_Session_ReNew_Fnc(){

    $session = array();
        
        foreach ($_SESSION as $k => $v) {
        
            $session[$k] = $v;
            
        }
        
    session_destroy();

    session_start();

    session_regenerate_id();
    session_regenerate_id(true);

    foreach ($session as $k => $v) {
        
        $_SESSION[$k] = $v;
        
    }


}





?>