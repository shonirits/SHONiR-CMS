<?php defined('SHONiR') OR exit('No direct script access allowed');

function SHONiR_Go_Fnc_Render(){

    $SHONiR_Second = SHONiR_URI['Second'];
    
    $SHONiR_Third = SHONiR_URI['Third'];

    $SHONiR_ID = SHONiR_URI['ID'];

    if($SHONiR_Second === "Pr" && $SHONiR_ID){

        $SHONiR_Product_Details = SHONiR_Product_Details_Fnc($SHONiR_ID, ' and status=1', SHONiR_LANGUAGE['language_id']);

        if($SHONiR_Product_Details){

            SHONiR_Redirect_Fnc($SHONiR_Product_Details['href']);


        }else{

            echo '<b>Oops... Page Not Found!</b>  <p>We\'re sorry, but the page you were looking for doesn\'t exist.</p>';

        }
    }elseif($SHONiR_Second === "Or" && $SHONiR_Third){

        $SHONiR_Order_Details = SHONiR_Order_Details_Fnc($SHONiR_Third, 'reference');

        if($SHONiR_Order_Details){

            SHONiR_Redirect_Fnc($SHONiR_Order_Details['thref']);


        }else{

            echo '<b>Oops... Page Not Found!</b>  <p>We\'re sorry, but the page you were looking for doesn\'t exist.</p>';

        }

    }elseif($SHONiR_Second === "Br" && $SHONiR_ID){

        $SHONiR_Banner_Details = SHONiR_Banner_Details_Fnc($SHONiR_ID, ' and status=1', SHONiR_LANGUAGE['language_id']);

        if($SHONiR_Banner_Details){

            SHONiR_Redirect_Fnc($SHONiR_Banner_Details['link']);

        }else{

            echo '<b>Oops... Page Not Found!</b>  <p>We\'re sorry, but the page you were looking for doesn\'t exist.</p>';

        }

    }elseif($SHONiR_Second === "Pa" && $SHONiR_ID){

        $SHONiR_Page_Details = SHONiR_Page_Details_Fnc($SHONiR_ID, ' and status=1', SHONiR_LANGUAGE['language_id']);

        if($SHONiR_Page_Details){

            SHONiR_Redirect_Fnc($SHONiR_Page_Details['href']);

        }else{

            echo '<b>Oops... Page Not Found!</b>  <p>We\'re sorry, but the page you were looking for doesn\'t exist.</p>';

        }


    }else{

        $SHONiR_Alert['type'] = 'error';
    $SHONiR_Alert['message'] = 'The server is unable to understand your request. Please try again.';
    SHONiR_Session_Write_Fnc('SHONiR_Alert', $SHONiR_Alert);

        SHONiR_Redirect_Fnc(SHONiR_BASE);

    }


    $GLOBALS['SHONiR_RENDER'] = FALSE;

}


?>