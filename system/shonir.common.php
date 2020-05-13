<?php defined('SHONiR') OR exit('No direct script access allowed');

function SHONiR_Error_Handler_Fnc($code, $message, $file, $line){

    if (!(error_reporting() & $code)) {

        return false;
    }

    switch ($code) {
        case E_NOTICE:
        case E_USER_NOTICE:
            $error = 'Notice';
            break;
        case E_WARNING:
        case E_USER_WARNING:
            $error = 'Warning';
            break;
        case E_ERROR:
        case E_USER_ERROR:
            $error = 'Fatal Error';
            break;
        default:
            $error = 'Unknown';
            break;
    }    

    if (SHONiR_SETTINGS['config_error_display']=="TRUE") {
        echo date('Y-m-d G:i:s').' - <b>' . $error . '</b>: ' . $message . ' in <b>' . $file . '</b> on line <b>' . $line . '</b>';
    }

    if (SHONiR_SETTINGS['config_error_log']=="TRUE") {

    $SHONiR_log_file = SHONiR_ROOT.'cache/error.log'; 

    $SHONiR_log_file = fopen($SHONiR_log_file, "a");        
     fwrite($SHONiR_log_file, date('Y-m-d G:i:s') . ' - ' . print_r('PHP ' . $error . ':  ' . $message . ' in ' . $file . ' on line ' . $line, true) . "\n");
     fclose($SHONiR_log_file);
    }

    die();
           
}


function SHONiR_User_Type_Fnc($SHONiR_ID){

    switch($SHONiR_ID){
        case 1: 
            return 'Administrator';
        break;
        case 2: 
            return 'Vendor';
        break;
        case 3: 
            return 'Customer';
        break;
        default:     
        return 'Guest';
        break;
       }
       
}


function SHONiR_Template_Fnc($SHONiR_File, $SHONiR_Array){

    $loader = new \Twig\Loader\FilesystemLoader(SHONiR_ROOT.'templates');
$twig = new \Twig\Environment($loader, ['cache' => false, 'strict_variables' => false]);
$filter = new \Twig\TwigFilter('write_price', 'SHONiR_Write_Price_Fnc');
$twig->addFilter($filter);

$template = $twig->load($SHONiR_File);

return $template->render($SHONiR_Array);
       
}

function SHONiR_Write_Price_Fnc($SHONiR_Price, $SHONiR_ID = FALSE){

    if($SHONiR_ID == FALSE || $SHONiR_ID == SHONiR_CURRENCY['currency_id']){
        $SHONiR_Currency = SHONiR_CURRENCY;
    }else{
        $SHONiR_Currency = SHONiR_Currencies_Fnc($SHONiR_ID, 1, 'asc', 1);
    }

    $SHONiR_Return = $SHONiR_Currency['symbol_left'].number_format($SHONiR_Price, $SHONiR_Currency['decimal_place']).$SHONiR_Currency['symbol_right'];

return $SHONiR_Return;
}

function SHONiR_Is_Ajax_Fnc(){

    $SHONiR_Return = FALSE;

    if(!empty($_SERVER['HTTP_X_REQUESTED_WITH']) && strtolower($_SERVER['HTTP_X_REQUESTED_WITH']) == 'xmlhttprequest') {
        $SHONiR_Return = TRUE;
    }

    return $SHONiR_Return;

    }


    function SHONiR_Countries_Fnc($SHONiR_ID = 0, $SHONiR_Column = "id"){

        $SHONiR_Return = FALSE;

        $SHONiR_Extra = "";

        if($SHONiR_ID){

            $SHONiR_Extra = " where ".$SHONiR_Column."=".$SHONiR_ID;
            
        }
    
        $SHONiR_Query_Countries = SHONiR_Query_Fnc("select * from tbl_countries ".$SHONiR_Extra." order by name asc;" );

  $SHONiR_Row_Countries = SHONiR_Row_Fnc($SHONiR_Query_Countries);

  if($SHONiR_Row_Countries > 0 ){
        
        $SHONiR_Return = SHONiR_Fetch_All_ASSOC_Fnc($SHONiR_Query_Countries);

    }
    
        return $SHONiR_Return;
    
        }


        function SHONiR_Regions_Fnc($SHONiR_ID = 0, $SHONiR_Column = "id", $SHONiR_Extra = ""){

            $SHONiR_Return = FALSE;
        
            if($SHONiR_ID){

                if($SHONiR_Extra){

                    $SHONiR_Extra = " where ".$SHONiR_Column."=".$SHONiR_ID.$SHONiR_Extra;

                }else{
    
                $SHONiR_Extra = " where ".$SHONiR_Column."=".$SHONiR_ID;

                }
                
            }
        
            $SHONiR_Query_Regions = SHONiR_Query_Fnc("select * from tbl_regions ".$SHONiR_Extra." order by name asc;" );
    
      $SHONiR_Row_Regions = SHONiR_Row_Fnc($SHONiR_Query_Regions);
    
      if($SHONiR_Row_Regions > 0 ){
            
            $SHONiR_Return = SHONiR_Fetch_All_ASSOC_Fnc($SHONiR_Query_Regions);
    
        }
        
            return $SHONiR_Return;
        
            }


            function SHONiR_Cities_Fnc($SHONiR_ID = 0, $SHONiR_Column = "id", $SHONiR_Extra = ""){

                $SHONiR_Return = FALSE;
            
                if($SHONiR_ID){
    
                    if($SHONiR_Extra){
    
                        $SHONiR_Extra = " where ".$SHONiR_Column."=".$SHONiR_ID.$SHONiR_Extra;
    
                    }else{
        
                    $SHONiR_Extra = " where ".$SHONiR_Column."=".$SHONiR_ID;
    
                    }
                    
                
            
                $SHONiR_Query_Cities = SHONiR_Query_Fnc("select * from tbl_cities ".$SHONiR_Extra." order by name asc;" );
        
          $SHONiR_Row_Cities = SHONiR_Row_Fnc($SHONiR_Query_Cities);
        
          if($SHONiR_Row_Cities > 0 ){
                
                $SHONiR_Return = SHONiR_Fetch_All_ASSOC_Fnc($SHONiR_Query_Cities);
        
            }
            
        }
                return $SHONiR_Return;
            
                }


    function SHONiR_Get_Number_Fnc($SHONiR_Text){

        $SHONiR_Return = FALSE;
        $SHONiR_Allow = str_split("0123456789");
        $SHONiR_String = str_split($SHONiR_Text);

        if(strlen($SHONiR_Text)>0){           
        
            foreach($SHONiR_String as $i => $c){
                if(!in_array($c, $SHONiR_Allow))
                    unset($SHONiR_String[$i]);
            }
            
            $SHONiR_Return =  ltrim(implode("", $SHONiR_String), '0');        

    }

        return $SHONiR_Return;
    
        }


        function SHONiR_Get_Price_Fnc($SHONiR_Text){

            $SHONiR_Return = FALSE;
    
            $SHONiR_Allow = str_split("0123456789.");
            $SHONiR_String = str_split($SHONiR_Text);
    
            if(strlen($SHONiR_Text)>0){            
            
                foreach($SHONiR_String as $i => $c){
                    if(!in_array($c, $SHONiR_Allow))
                        unset($SHONiR_String[$i]);
                }

                $SHONiR_Return =  implode("", $SHONiR_String);          
    
        }
    
            return $SHONiR_Return;
        
            }


function SHONiR_Captcha_Fnc_Render($SHONiR_Do = "G"){

    $SHONiR_Data = FALSE;

    if(strlen($SHONiR_Do)<1)
    {        
        SHONiR_Session_Delete_Fnc('SHONiR_Captcha_Code');        
        return $SHONiR_Data;
    }

    if($SHONiR_Do == "G"){

    $captcha_code = '';
    $captcha_image_height = 75;
    $captcha_image_width = 275;
    $total_characters_on_image = 5;

    $possible_captcha_letters = 'ACEFHJLMNPRTWXYacdefhjmnprtwxy23479';
$captcha_font = SHONiR_ROOT.'assets/fonts/times_new_yorker.ttf';

$random_captcha_dots = 250;
$random_captcha_lines = 50;
$captcha_text_color = "000000"; 
 
$count = 0;
while ($count < $total_characters_on_image) { 
$captcha_code .= substr(
 $possible_captcha_letters,
 mt_rand(0, strlen($possible_captcha_letters)-1),
 1);
$count++;
}

$captcha_font_size = $captcha_image_height * 0.65;
$captcha_image = @imagecreate(
 $captcha_image_width,
 $captcha_image_height
 );


 $background_color = imagecolorallocate(
    $captcha_image,
    255,
    255,
    255
    );

$captcha_text_color = imagecolorallocate(
 $captcha_image,
 0,
 0,
0
 );
 
$image_noise_color = imagecolorallocate(
 $captcha_image,
 0,
0,
 0
 );

 for( $count=0; $count<$random_captcha_dots; $count++ ) {
    imagefilledellipse(
     $captcha_image,
     mt_rand(0,$captcha_image_width),
     mt_rand(0,$captcha_image_height),
     2,
     3,
     $image_noise_color
     );
    }

    for( $count=0; $count<$random_captcha_lines; $count++ ) {
        imageline(
         $captcha_image,
         mt_rand(0,$captcha_image_width),
         mt_rand(0,$captcha_image_height),
         mt_rand(0,$captcha_image_width),
         mt_rand(0,$captcha_image_height),
         $image_noise_color
         );
        }

        $text_box = imagettfbbox(
            $captcha_font_size,
            0,
            $captcha_font,
            $captcha_code
            ); 
           $x = ($captcha_image_width - $text_box[4])/2;
           $y = ($captcha_image_height - $text_box[5])/2;
           imagettftext(
            $captcha_image,
            $captcha_font_size,
            0,
            $x,
            $y,
            $captcha_text_color,
            $captcha_font,
            $captcha_code
            );
            @ob_get_clean();
            header('Content-Type: image/jpeg'); 
            imagejpeg($captcha_image); 
            imagedestroy($captcha_image); 
            SHONiR_Session_Write_Fnc('SHONiR_Captcha_Code', $captcha_code);exit;

exit;

    }else{

        if(SHONiR_Session_Read_Fnc('SHONiR_Captcha_Code') === $SHONiR_Do){        

        $SHONiR_Data = TRUE;
        
        }

        SHONiR_Session_Delete_Fnc('SHONiR_Captcha_Code');

        return $SHONiR_Data;
    }
}



function SHONiR_Executed_Fnc(){
$SHONiR_Time = microtime();
$SHONiR_Time = explode(' ', $SHONiR_Time);
$SHONiR_Time = $SHONiR_Time[1] + $SHONiR_Time[0];
$SHONiR_Finish = $SHONiR_Time;
$SHONiR_Total_Time = round(($SHONiR_Finish - SHONiR_START), 4);
return 'Page generated in '.$SHONiR_Total_Time.' seconds.';
}

function SHONiR_Cache_Fnc($SHONiR_Do){

    $SHONiR_LANGUAGE = $GLOBALS['SHONiR_LANGUAGE'];

    $SHONiR_Cache_File = SHONiR_ROOT.'cache/'.$SHONiR_LANGUAGE['language_id'].'_'.md5(SHONiR_LINK);

if($SHONiR_Do == "R"){    

    if(file_exists($SHONiR_Cache_File)){

        if(filemtime($SHONiR_Cache_File)<time()-SHONiR_CACHE_LIFE) return;

        readfile($SHONiR_Cache_File);

        echo "<!--SHONiR Cache ".SHONiR_Executed_Fnc()." -->";


        exit;
    }


}


if($SHONiR_Do == "W"){

    if(!file_exists($SHONiR_Cache_File)){
    
    $SHONiR_Page_Content = "<!--SHONiR Cache generated: ".date("l jS \of F Y h:i:s A")." termination: ".date("l jS \of F Y h:i:s A e P", time()+SHONiR_CACHE_LIFE)." URL: ".SHONiR_LINK." -->".ob_get_contents();

    $SHONiR_Page_Content = trim(preg_replace('/\s\s+/', ' ', $SHONiR_Page_Content));

    $SHONiR_Page_Content = trim(preg_replace('/\s+/', ' ', $SHONiR_Page_Content));	

	$SHONiR_Page_Content = str_replace("\r\n","",$SHONiR_Page_Content);

    $SHONiR_File_Open = fopen($SHONiR_Cache_File, 'w');

    fwrite($SHONiR_File_Open, $SHONiR_Page_Content); 
    
    fclose($SHONiR_File_Open);

    echo "<!--SHONiR Cache has been generated: ".date("l jS \of F Y h:i:s A")." termination: ".date("l jS \of F Y h:i:s A e P", time()+SHONiR_CACHE_LIFE)." URL: ".SHONiR_LINK." -->";

    }


}


}

function SHONiR_Mail_Fnc_Render($SHONiR_Email, $SHONiR_Name = '', $SHONiR_Subject, $SHONiR_Message, $SHONiR_HTML = 1)
    {
      
  SHONiR_Query_Fnc("insert into tbl_mails (email, name, subject, message, html, add_time, add_ip) values ('".$SHONiR_Email."', '".$SHONiR_Name."', '".$SHONiR_Subject."', '".$SHONiR_Message."', ".$SHONiR_HTML.",  ".time().", '".SHONiR_IP_Fnc()."' )");

        
    }

function SHONiR_URI_Fnc($SHONiR_Segments = SHONiR_SEGMENT){

    $data = array();
    
    $SHONiR_Total_Segments = (empty($SHONiR_Segments))?0:count($SHONiR_Segments);
    $SHONiR_Second_Segment = '';  
        $SHONiR_Third_Segment = ''; 
        $SHONiR_Fourth_Segment = ''; 
        $SHONiR_Last_Segment = '';
        $SHONiR_Extension = ''; 

    if($SHONiR_Total_Segments == 1){

        $SHONiR_First_Segment = $SHONiR_Segments[0];                

    }elseif($SHONiR_Total_Segments > 1){

        $SHONiR_First_Segment = $SHONiR_Segments[0]; 
        $SHONiR_Second_Segment = $SHONiR_Segments[1];
        if(isset($SHONiR_Segments[2])){
        $SHONiR_Third_Segment = $SHONiR_Segments[2]; 
        if(isset($SHONiR_Segments[3])){
            $SHONiR_Fourth_Segment = $SHONiR_Segments[3]; 
        }
    }

    
        $SHONiR_Last_Segment = $SHONiR_Segments[$SHONiR_Total_Segments - 1];
    
    }else{
    
        $SHONiR_First_Segment = 'Welcome'; 
    
    }

    $SHONiR_Last_Segment_ID =  explode('_', $SHONiR_Last_Segment);
    $SHONiR_ID = $SHONiR_Last_Segment_ID[0];

    if(!ctype_digit($SHONiR_ID)){

        $SHONiR_ID = 0;
    }

    if($SHONiR_Last_Segment){

        $SHONiR_Extension = substr(strrchr($SHONiR_Last_Segment, '.'), 1);
    }

    $data['First'] = $SHONiR_First_Segment;
    $data['Second'] = $SHONiR_Second_Segment;
    $data['Third'] = $SHONiR_Third_Segment;
    $data['Fourth'] = $SHONiR_Fourth_Segment;
    $data['Last'] = $SHONiR_Last_Segment;
    $data['ID'] = $SHONiR_ID;
    $data['EX'] = $SHONiR_Extension;


return $data;


}

function SHONiR_Token_Fnc(){

    $SHONiR_Data = md5(uniqid($GLOBALS['SHONiR_SESSION_ID'], true));

    return $SHONiR_Data;

}

function SHONiR_CSRF_Fnc($SHONiR_Do){

    $SHONiR_Data = FALSE;

    if($SHONiR_Do == "G"){  

        $SHONiR_Data = SHONiR_Token_Fnc();

        SHONiR_Cookie_Write_Fnc($SHONiR_Data, 'SHONiR Cross-site Request Forgery');

    }else{

        $SHONiR_Data = SHONiR_Cookie_Exist_Fnc($SHONiR_Do);
        
        SHONiR_Cookie_Delete_Fnc($SHONiR_Do);

    }

    return $SHONiR_Data;

    
}



function SHONiR_Get_Fnc($SHONiR_Var, $SHONiR_Filter = null){

       if($SHONiR_Var){

        $SHONiR_Data = isset($_GET[$SHONiR_Var])?$_GET[$SHONiR_Var]:null;
    
     }else{
    
        $SHONiR_Data = null;
    
     }    
     
     if($SHONiR_Filter){

        $SHONiR_Data = filter_var($SHONiR_Data, $SHONiR_Filter);
    }

    if($SHONiR_Data){

        $SHONiR_Data = SHONiR_Escape_String_Fnc($SHONiR_Data);
    
     }

 return $SHONiR_Data;


}

function SHONiR_Post_Fnc($SHONiR_Var, $SHONiR_Filter = null){


 if($SHONiR_Var){

    $SHONiR_Data = isset($_POST[$SHONiR_Var])?$_POST[$SHONiR_Var]:null;

 }else{

    $SHONiR_Data = null;

 }

 if($SHONiR_Data){

    if(!is_array($SHONiR_Data)){

    $SHONiR_Data = SHONiR_Escape_String_Fnc($SHONiR_Data);

    }

 }
 
 if($SHONiR_Filter){

    if(!is_array($SHONiR_Data)){

    $SHONiR_Data = filter_var($SHONiR_Data, $SHONiR_Filter);

}

}

 return $SHONiR_Data;

}


function SHONiR_Render_Fnc_Main($SHONiR_File, $SHONiR_Vars = null, $SHONiR_Path = null){

    

    if (is_array($SHONiR_Vars) && !empty($SHONiR_Vars)) {
        extract($SHONiR_Vars);
      }

     if($GLOBALS['SHONiR_AJAX_VIEWS']){$SHONiR_File = $SHONiR_File.'_'.$GLOBALS['SHONiR_AJAX_VIEWS'];}
     if($GLOBALS['SHONiR_VIEWS_FILE']){$SHONiR_File = $GLOBALS['SHONiR_VIEWS_FILE'];}

      if(empty($SHONiR_Path)){

      $SHONiR_Full_File = SHONiR_ROOT."views/".SHONiR_VIEW."/".strtolower($SHONiR_File).".php";

      }else{

        $SHONiR_Full_File = SHONiR_ROOT.$SHONiR_Path."/".strtolower($SHONiR_File).".php";

      }

      if (!file_exists($SHONiR_Full_File))  
{ 
    header("HTTP/1.0 404 Not Found");
    include SHONiR_ROOT."errors/404.php";

} else{

     include $SHONiR_Full_File;

}

}


function SHONiR_IP_Fnc() {

    // Check for shared Internet/ISP IP
    if (!empty($_SERVER['HTTP_CLIENT_IP']) && SHONiR_Validate_IP_Fnc($_SERVER['HTTP_CLIENT_IP'])) {
        return $_SERVER['HTTP_CLIENT_IP'];
    }

    // Check for IP addresses passing through proxies
    if (!empty($_SERVER['HTTP_X_FORWARDED_FOR'])) {

        // Check if multiple IP addresses exist in var
        if (strpos($_SERVER['HTTP_X_FORWARDED_FOR'], ',') !== false) {
            $iplist = explode(',', $_SERVER['HTTP_X_FORWARDED_FOR']);
            foreach ($iplist as $ip) {
                if (SHONiR_Validate_IP_Fnc($ip))
                    return $ip;
            }
        }
        else {
            if (SHONiR_Validate_IP_Fnc($_SERVER['HTTP_X_FORWARDED_FOR']))
                return $_SERVER['HTTP_X_FORWARDED_FOR'];
        }
    }
    if (!empty($_SERVER['HTTP_X_FORWARDED']) && SHONiR_Validate_IP_Fnc($_SERVER['HTTP_X_FORWARDED']))
        return $_SERVER['HTTP_X_FORWARDED'];
    if (!empty($_SERVER['HTTP_X_CLUSTER_CLIENT_IP']) && SHONiR_Validate_IP_Fnc($_SERVER['HTTP_X_CLUSTER_CLIENT_IP']))
        return $_SERVER['HTTP_X_CLUSTER_CLIENT_IP'];
    if (!empty($_SERVER['HTTP_FORWARDED_FOR']) && SHONiR_Validate_IP_Fnc($_SERVER['HTTP_FORWARDED_FOR']))
        return $_SERVER['HTTP_FORWARDED_FOR'];
    if (!empty($_SERVER['HTTP_FORWARDED']) && SHONiR_Validate_IP_Fnc($_SERVER['HTTP_FORWARDED']))
        return $_SERVER['HTTP_FORWARDED'];

    // Return unreliable IP address since all else failed
    return $_SERVER['REMOTE_ADDR'];
}

/**
 * Ensures an IP address is both a valid IP address and does not fall within
 * a private network range.
 */
function SHONiR_Validate_IP_Fnc($ip) {

    if (strtolower($ip) === 'unknown')
        return false;

    // Generate IPv4 network address
    $ip = ip2long($ip);

    // If the IP address is set and not equivalent to 255.255.255.255
    if ($ip !== false && $ip !== -1) {
        // Make sure to get unsigned long representation of IP address
        // due to discrepancies between 32 and 64 bit OSes and
        // signed numbers (ints default to signed in PHP)
        $ip = sprintf('%u', $ip);

        // Do private network range checking
        if ($ip >= 0 && $ip <= 50331647)
            return false;
        if ($ip >= 167772160 && $ip <= 184549375)
            return false;
        if ($ip >= 2130706432 && $ip <= 2147483647)
            return false;
        if ($ip >= 2851995648 && $ip <= 2852061183)
            return false;
        if ($ip >= 2886729728 && $ip <= 2887778303)
            return false;
        if ($ip >= 3221225984 && $ip <= 3221226239)
            return false;
        if ($ip >= 3232235520 && $ip <= 3232301055)
            return false;
        if ($ip >= 4294967040)
            return false;
    }
    return true;
}


function SHONiR_Referer_Fnc(){

    $SHONiR_Data = null;

    if(isset($_SERVER['HTTP_REFERER'])) {

        $SHONiR_Referer =  parse_url($_SERVER['HTTP_REFERER']);
        $SHONiR_Link = parse_url(SHONiR_LINK);
        if($SHONiR_Referer['host'] != $SHONiR_Link['host']){
            
            $SHONiR_Data = $_SERVER['HTTP_REFERER'];

            SHONiR_Cookie_Write_Fnc('SHONiR_Referer', $SHONiR_Data, 3600);

        }elseif(SHONiR_Cookie_Read_Fnc('SHONiR_Referer')){

            $SHONiR_Data = SHONiR_Cookie_Read_Fnc('SHONiR_Referer');

            SHONiR_Cookie_Write_Fnc('SHONiR_Referer', $SHONiR_Data, 3600);

        }  
        
    }

    return $SHONiR_Data;

}

function SHONiR_IP_Info_Fnc($SHONiR_IP){

    $SHONiR_Data = array();

    if(SHONiR_LOCAL){

        $SHONiR_IP_Info = json_decode('{"country_name":"PAKISTAN","country_code":"PK","city":"Sialkot","ip":"333.333.6426"}');

    }else{

       $SHONiR_IP_Info = @file_get_contents('http://api.hostip.info/get_json.php?ip='.$SHONiR_IP);

       if(!$SHONiR_IP_Info){

                  $SHONiR_IP_Info = json_decode('{"country_name":"??","country_code":"??","city":"??","ip":"'.$SHONiR_IP.'"}');
       }else{

        $SHONiR_IP_Info = json_decode($SHONiR_IP_Info);

       }

    }


        $SHONiR_Data['city'] = $SHONiR_IP_Info->city;

        $SHONiR_Data['country_name'] = $SHONiR_IP_Info->country_name;

        $SHONiR_Data['country_code']= $SHONiR_IP_Info->country_code;

    return $SHONiR_Data;
}

function SHONiR_Local_Fnc($SHONiR_IP){

    $SHONiR_Locals = array('127.0.0.1',  '::1',  'localhost');

    foreach($SHONiR_Locals as $Local)
        {
            if( stripos($SHONiR_IP, $Local ) !== false ) return 1;
        }
    return 0;
}


function SHONiR_Bot_Fnc($SHONiR_Agent){
    
       $SHONiR_Bots = array('Googlebot',  'Baiduspider',  'ia_archiver',  'R6_FeedFetcher',  'NetcraftSurveyAgent',  'Sogou web spider',  'bingbot',  'Yahoo! Slurp',  'facebookexternalhit',  'PrintfulBot',  'msnbot',  'Twitterbot',  'UnwindFetchor',  'urlresolver',  'Butterfly',  'TweetmemeBot',  'PaperLiBot',  'MJ12bot',  'AhrefsBot',  'Exabot',  'Ezooms',  'YandexBot',  'SearchmetricsBot',  'picsearch',  'TweetedTimes Bot',  'QuerySeekerSpider',  'ShowyouBot',  'woriobot',  'merlinkbot',  'BazQuxBot',  'Kraken',  'SISTRIX Crawler',  'R6_CommentReader',  'magpie-crawler',  'GrapeshotCrawler',  'PercolateCrawler',  'MaxPointCrawler',  'R6_FeedFetcher',  'NetSeer crawler',  'grokkit-crawler',  'SMXCrawler',  'PulseCrawler',  'Y!J-BRW',  '80legs.com/webcrawler',  'Mediapartners-Google',  'Spinn3r',  'InAGist',  'Python-urllib',  'NING',  'TencentTraveler',  'Feedfetcher-Google',  'mon.itor.us',  'spbot',  'Feedly',  'bitlybot',  'ADmantX Platform',  'Niki-Bot',  'Pinterest',  'python-requests',  'DotBot',  'HTTP_Request2',  'linkdexbot',  'A6-Indexer',  'Baiduspider',  'TwitterFeed',  'Microsoft Office',  'Pingdom',  'BTWebClient',  'KatBot',  'SiteCheck',  'proximic',  'Sleuth',  'Abonti',  '(BOT for JCE)',  'Baidu',  'Tiny Tiny RSS',  'newsblur',  'updown_tester',  'linkdex',  'baidu',  'searchmetrics',  'genieo',  'majestic12',  'spinn3r',  'profound',  'domainappender',  'VegeBot',  'terrykyleseoagency.com',  'CommonCrawler Node',  'AdlesseBot',  'metauri.com',  'libwww-perl',  'rogerbot-crawler',  'MegaIndex.ru', 'ltx71', 'Qwantify', 'Traackr.com', 'Re-Animator Bot',  'Pcore-HTTP',  'BoardReader',  'omgili',  'okhttp',  'CCBot',  'Java/1.8',  'semrush.com',  'feedbot',  'CommonCrawler',  'AdlesseBot',  'MetaURI',  'ibwww-perl',  'rogerbot',  'MegaIndex',  'BLEXBot',  'FlipboardProxy',  'techinfo@ubermetrics-technologies.com',  'trendictionbot',  'Mediatoolkitbot',  'trendiction',  'ubermetrics',  'ScooperBot',  'TrendsmapResolver',  'Nuzzel',  'Go-http-client',  'Applebot',  'LivelapBot',  'GroupHigh',  'SemrushBot',  'ltx71',  'commoncrawl',  'istellabot',  'DomainCrawler',  'cs.daum.net',  'StormCrawler',  'GarlikCrawler',  'The Knowledge AI',  'getstream.io/winds',  'YisouSpider',  'archive.org_bot',  'semantic-visions.com',  'FemtosearchBot',  '360Spider',  'linkfluence.com',  'glutenfreepleasure.com',  'Gluten Free Crawler',  'YaK/1.0',  'Cliqzbot',  'app.hypefactors.com',  'axios',  'semantic-visions.com',  'webdatastats.com',  'schmorp.de',  'SEOkicks',  'DuckDuckBot',  'Barkrowler',  'ZoominfoBot',  'Linguee Bot',  'Mail.RU_Bot',  'OnalyticaBot',  'Linguee Bot',  'admantx-adform',  'Buck/2.2',  'Barkrowler',  'Zombiebot',  'Nutch',  'SemanticScholarBot',  'Jetslide',  'scalaj-http',  'XoviBot',  'sysomos.com',  'PocketParser',  'newspaper',  'serpstatbot',  'MetaJobBot',  'SeznamBot/3.2',  'VelenPublicWebCrawler/1.0',  'WordPress.com mShots',  'adscanner',  'BacklinkCrawler',  'netEstate NE Crawler',  'Astute SRM',  'GigablastOpenSource/1.0',  'DomainStatsBot',  'Winds: Open Source RSS & Podcast',  'dlvr.it',  'BehloolBot',  '7Siters' );
   
       foreach($SHONiR_Bots as $Bot)
           {
               if( stripos(strtolower($SHONiR_Agent), strtolower($Bot) ) !== false ) return 1;
           }
       return 0;
   }


   function SHONiR_Mobile_Fnc($SHONiR_Agent){
    
    $SHONiR_Mobiles = array('android',  'avantgo',  'blackberry',  'bolt',  'boost',  'cricket',  'bingbot',  'docomo',  'fone',  'hiptop',  'mini',  'mobi',  'palm',  'phone',  'pie',  'tablet',  'up\.browser',  'up\.link',  'webos',  'wos',  'Java',  'Windows Phone',  '\bi?OS\b',  'BREW');

    foreach($SHONiR_Mobiles as $Mobile)
        {
            if( stripos(strtolower($SHONiR_Agent), strtolower($Mobile) ) !== false ) return 1;
        }
    return 0;
}


function SHONiR_Slug_Fnc($SHONiR_Text){
    
    // replace non letter or digits by -
  $SHONiR_Text = preg_replace('~[^\pL\d]+~u', '-', $SHONiR_Text);

  // transliterate
  $SHONiR_Text = iconv('utf-8', 'us-ascii//TRANSLIT', $SHONiR_Text);

  // remove unwanted characters
  $SHONiR_Text = preg_replace('~[^-\w]+~', '', $SHONiR_Text);

  // trim
  $SHONiR_Text = trim($SHONiR_Text, '-');

  // remove duplicate -
  $SHONiR_Text = preg_replace('~-+~', '-', $SHONiR_Text);

  // lowercase
  $SHONiR_Text = strtolower($SHONiR_Text);

  if (empty($SHONiR_Text)) {
    $SHONiR_Text = 'n-a';
  }

  return $SHONiR_Text;
}

function SHONiR_T2H_Fnc($SHONiR_Content){
    $SHONiR_Data = '';
    if(strlen($SHONiR_Content)>1){
    $SHONiR_Data = str_replace("\'" , "&#039;", $SHONiR_Content);
   $SHONiR_Data = str_replace("'" , "&#039;", $SHONiR_Data);
   $SHONiR_Data = str_replace('\r\n','<br/>', $SHONiR_Data);
    $SHONiR_Data = str_replace("\r\n",'<br/>', $SHONiR_Data);
    $SHONiR_Data = str_replace('\r','<br/>', $SHONiR_Data);
    $SHONiR_Data = str_replace("\r",'<br/>', $SHONiR_Data);
    $SHONiR_Data = str_replace('\n','<br/>', $SHONiR_Data);
    $SHONiR_Data = str_replace("\n",'<br/>', $SHONiR_Data);
    $SHONiR_Data = nl2br($SHONiR_Data);
    }
    return $SHONiR_Data;
}

function SHONiR_H2T_Fnc($SHONiR_Content){
    $SHONiR_Data = '';
    if(strlen($SHONiR_Content)>1){
        $SHONiR_Data = str_replace("\'" , "'", $SHONiR_Content);
   $SHONiR_Data = str_replace("&#039;" , "'", $SHONiR_Data);
   $SHONiR_Data = str_replace('\r\n',"\r\n", $SHONiR_Data);
    $SHONiR_Data = str_replace('<br/>',"\r\n", $SHONiR_Data);
    $SHONiR_Data = str_replace("<br/>","\r\n", $SHONiR_Data);        
    $SHONiR_Data = strip_tags($SHONiR_Data);
    }    
    return $SHONiR_Data;
}


function SHONiR_Domain_Fnc($SHONiR_URL){

    $SHONiR_Parse = parse_url($SHONiR_URL);
    $SHONiR_Domain = isset($SHONiR_Parse['host']) ? $SHONiR_Parse['host'] : $SHONiR_Parse['path'];    
    return $SHONiR_Domain;

}


function SHONiR_Counter_Fnc($SHONiR_Key, $SHONiR_Do = TRUE){

    $SHONiR_Data = 1;

    $SHONiR_Query_Counter = SHONiR_Query_Fnc("select * from tbl_settings where setting_code='counter' and setting_key='".$SHONiR_Key."' ");

    $SHONiR_Row_Counter = SHONiR_Row_Fnc($SHONiR_Query_Counter);
    
    if($SHONiR_Row_Counter > 0 ){
    
        $SHONiR_Fetch_Counter = SHONiR_Fetch_Fnc($SHONiR_Query_Counter);

        $SHONiR_Data = $SHONiR_Fetch_Counter['setting_value'];

        if($SHONiR_Do){

            $SHONiR_Data = (int)$SHONiR_Data + 1;

        SHONiR_Query_Fnc("update tbl_settings set setting_value=". $SHONiR_Data ." where setting_code='counter'  and setting_key='".$SHONiR_Key."' ");

        }

    }

  return $SHONiR_Data;
}


function SHONiR_Time_Difference_Fnc($SHONiR_Time_One, $SHONiR_Time_Two, $SHONiR_Time_Full = false) {
    

    if ($SHONiR_Time_One > $SHONiR_Time_Two) { 
        
        $now = new DateTime;
    $ago = new DateTime(date("Y-m-d H:i:s", $SHONiR_Time_Two));
    $diff = $now->diff($ago);

    $diff->w = floor($diff->d / 7);
    $diff->d -= $diff->w * 7;

    $string = array(
        'y' => 'year',
        'm' => 'month',
        'w' => 'week',
        'd' => 'day',
        'h' => 'hour',
        'i' => 'minute',
        's' => 'second',
    );
    foreach ($string as $k => &$v) {
        if ($diff->$k) {
            $v = $diff->$k . ' ' . $v . ($diff->$k > 1 ? 's' : '');
        } else {
            unset($string[$k]);
        }
    }

    if (!$SHONiR_Time_Full) $string = array_slice($string, 0, 1);
    return $string ? implode(', ', $string) . ' ago' : 'just now';


     }else{
  
    // get hour/min/sec values
    $SHONiR_Total_Seconds = ($SHONiR_Time_Two - $SHONiR_Time_One);
    $SHONiR_Hours        = ($SHONiR_Total_Seconds/(60*60))%24;
    $SHONiR_Minutes      = ($SHONiR_Total_Seconds/60)%60;
    $SHONiR_Seconds      = $SHONiR_Total_Seconds % 60;
  
    // format output
    $SHONiR_Output = "";
    if ($SHONiR_Hours) { $SHONiR_Output .= "$SHONiR_Hours Hours, "; }
    $SHONiR_Output .= "$SHONiR_Minutes Minutes, ";
    $SHONiR_Output .= "$SHONiR_Seconds Seconds";
     }

    return $SHONiR_Output;
  }

  function SHONiR_Redirect_Fnc($SHONiR_URL) {
    if(headers_sent())
    {
      echo "<script>document.location.href='".$SHONiR_URL."'</script>";
    }
    else
    {
      header("location: ".$SHONiR_URL);
    }
    exit;
  }


  function SHONiR_Resize_Fnc($SHONiR_Source){

    $maxDim = SHONiR_SETTINGS['config_large_image'];

    $ext = array(".jpg", "jpeg", ".png", ".gif");

    if (file_exists($SHONiR_Source)) {

        $filetype = substr($imagesource,strlen($imagesource)-4,4);

        $filetype = strtolower($filetype);

        if (!in_array($filetype, $ext))
  {
    
    return false;

  }

    list($width, $height, $type, $attr) = getimagesize( $SHONiR_Source );

if ( $width > $maxDim || $height > $maxDim ) {
    $target_filename = $SHONiR_Source;
    $ratio = $width/$height;
    if( $ratio > 1) {
        $new_width = $maxDim;
        $new_height = $maxDim/$ratio;
    } else {
        $new_width = $maxDim*$ratio;
        $new_height = $maxDim;
    }
    $src = @imagecreatefromstring( file_get_contents( $SHONiR_Source ) );

    $dst = @imagecreatetruecolor( $new_width, $new_height );

    imagecopyresampled( $dst, $src, 0, 0, 0, 0, $new_width, $new_height, $width, $height );

    imagedestroy( $src );

    if($filetype == ".jpg" || $filetype == "jpeg" ){

    imagejpeg( $dst, $target_filename ); 

    }

    if($filetype == ".png"){

        imagepng( $dst, $target_filename );

    }

    if($filetype == ".gif"){

        imagegif( $dst, $target_filename ); 
    
        }

    imagedestroy( $dst );
}

    }

  }

  function SHONiR_Watermark_Fnc_Render(){

    $SHONiR_ID = SHONiR_URI['ID'];

    $SHONiR_Default = FALSE;

    $SHONiR_Uploads = SHONiR_Uploads_Fnc($SHONiR_ID);    

    if(count($SHONiR_Uploads) > 0){

        $imagesource = SHONiR_ROOT.'media/uploads/'.$SHONiR_Uploads[0]['upload_file'];

        if (file_exists($imagesource)) {

            $filetype = substr($imagesource,strlen($imagesource)-4,4);

    $filetype = strtolower($filetype);

    $ext = array(".jpg", "jpeg", ".png", ".gif");

    if (in_array($filetype, $ext))
  {    

    if($filetype == ".gif"){
        $header="image/gif";
    $image = @imagecreatefromgif($imagesource);
} 
if($filetype == ".jpg" || $filetype == "jpeg" ){
    $header="image/jpeg";$image = @imagecreatefromjpeg($imagesource);
} 
if($filetype == ".png"){$header="image/png";
    $image = @imagecreatefrompng($imagesource);
} 

if (!$image){die();}

$imagesource = SHONiR_ROOT.'media/uploads/'.SHONiR_SETTINGS['config_watermark'];

if (file_exists($imagesource)) {

$watermark = @imagecreatefrompng($imagesource);

$imagewidth = imagesx($image);$imageheight = imagesy($image); 

$watermarkwidth = imagesx($watermark);

$watermarkheight =imagesy($watermark);

$startwidth = (($imagewidth - $watermarkwidth)/2);

$startheight = (($imageheight - $watermarkheight)/2);

imagecopy($image, $watermark,$startwidth, $startheight, 0, 0, $watermarkwidth, $watermarkheight);

@ob_get_clean();
header("Content-Type: ".$header);

if($filetype == ".jpg" || $filetype == "jpeg" ){

    imagejpeg( $image ); 

    }

    if($filetype == ".png"){

        imagepng( $image );

    }

    if($filetype == ".gif"){

        imagegif( $image ); 
    
        }

imagedestroy($image);

imagedestroy($watermark);

}else{

    $SHONiR_Default = TRUE;
}

}else{

    $SHONiR_Default = TRUE;
}

}else{

    $SHONiR_Default = TRUE;
}

    }else{

        $SHONiR_Default = TRUE;
    }
    
    
    if($SHONiR_Default){

        $imagesource = SHONiR_ROOT.'media/uploads/n-a.png';

        if (file_exists($imagesource)) { 

            @ob_get_clean();
            header("Content-Type: image/png");

            $image = @imagecreatefrompng($imagesource);

            imagejpeg($image);

            imagedestroy($image);
        
        }else{

            die("Forbidden access is denied. Please contact to developer at WhatsApp: +92-333-333-6426 or email at info@shonir.com or for more infomation visit website www.shonir.com");
       
        }


    }

    exit;

}


function SHONiR_Write_Uploads_Fnc($SHONiR_Source){

if($SHONiR_Source){

return (SHONiR_SETTINGS['config_auto_watermark']=="TRUE")?SHONiR_CDN_IMG.'Watermark/'.$SHONiR_Source:SHONiR_CDN_IMG.'media/uploads/'.$SHONiR_Source;


}else{

    return SHONiR_CDN_IMG.'media/uploads/n-a.png';
}

}

function SHONiR_Reference_Fnc(){

    $SHONiR_Letters = 'ACEFHJLMNPRTWXY';

    $SHONiR_Shuffle = substr(str_shuffle($SHONiR_Letters), 0, 3);

    $SHONiR_Counter = SHONiR_Counter_Fnc('reference');

    $SHONiR_Return = $SHONiR_Shuffle.str_pad($SHONiR_Counter, 7, '0', STR_PAD_LEFT);


    return $SHONiR_Return;

}
  function SHONiR_Uploads_Fnc($SHONiR_ID, $SHONiR_Type = FALSE){

    if($SHONiR_Type){

    $SHONiR_Query_Uploads_Extra = " parent_type ='".$SHONiR_Type."' and parent_id=".$SHONiR_ID;

  }else{

    $SHONiR_Query_Uploads_Extra = " upload_id =".$SHONiR_ID;

  }  

  $SHONiR_Query_Uploads = SHONiR_Query_Fnc("select * from tbl_uploads where ".$SHONiR_Query_Uploads_Extra." order by sort_order asc;" );

  $SHONiR_Row_Uploads = SHONiR_Row_Fnc($SHONiR_Query_Uploads);

  if($SHONiR_Row_Uploads > 0 ){

    while($SHONiR_Fetch_Uploads = SHONiR_Fetch_Fnc($SHONiR_Query_Uploads))
    {
        
        $SHONiR_Return[] = $SHONiR_Fetch_Uploads;

    }

    }else{

        $SHONiR_Return = array();

    }

    return $SHONiR_Return;



}

function SHONiR_Valid_XML_Fnc($SHONiR_Content)
{
    $SHONiR_Content = trim($SHONiR_Content);
    if (empty($SHONiR_Content)) {
        return false;
    }

    if (stripos($SHONiR_Content, '<!DOCTYPE html>') !== false) {
        return false;
    }

    libxml_use_internal_errors(true);
    simplexml_load_string($SHONiR_Content);
    $SHONiR_Errors = libxml_get_errors();          
    libxml_clear_errors();  

    return empty($SHONiR_Errors);
}

function SHONiR_Read_XML_Fnc($SHONiR_File){

 $SHONiR_Data = @simplexml_load_file($SHONiR_File);

 if(empty(SHONiR_Valid_XML_Fnc($SHONiR_Data))){

    return $SHONiR_Data;

 }else{
     
    return false;

 } 

}

function SHONiR_Pagination_Fnc($SHONiR_Page_No, $SHONiR_Records_Limit, $SHONiR_Total_Pages, $SHONiR_Total_Records, $SHONiR_Start, $SHONiR_Row_Pagination, $SHONiR_Rows, $SHONiR_Page, $SHONiR_First_Button = TRUE, $SHONiR_Next_Button = TRUE,  $SHONiR_Style = ''){
     
    
    if($SHONiR_Row_Pagination > 0 ){     

    $SHONiR_Data['Rows'] = $SHONiR_Rows;

     $SHONiR_Data['Page_No'] = $SHONiR_Page_No;

    $SHONiR_Data['Total_Records'] =  $SHONiR_Total_Records;

    $SHONiR_Data['Total_Pages'] = $SHONiR_Total_Pages;

    $SHONiR_Second_Last_Page = $SHONiR_Total_Pages-1;

    $SHONiR_Data['Start_Records'] = $SHONiR_Start+1;

    $SHONiR_Data['End_Records'] = (($SHONiR_Start+$SHONiR_Records_Limit)>$SHONiR_Total_Records)?$SHONiR_Total_Records:($SHONiR_Start+$SHONiR_Records_Limit);

    $SHONiR_Previous = $SHONiR_Page_No - 1;

$SHONiR_Next = $SHONiR_Page_No + 1;

$SHONiR_Pages_Limit = SHONiR_SETTINGS['config_pages_limit'];

$SHONiR_Adjust = SHONiR_SETTINGS['config_adjust'];

$SHONiR_Pagination = '<ul class="pagination '.$SHONiR_Style.'">';

if($SHONiR_First_Button == TRUE ){
if($SHONiR_Page_No > 1){
    $SHONiR_Pagination .= "<li class=' page-item'><a  class='page-link' href='".$SHONiR_Page."n=1'>&lsaquo;&lsaquo; First </a></li>";
    }
    }

    if($SHONiR_Next_Button == TRUE ){

    $SHONiR_Pagination .= '<li class="page-item';
    $SHONiR_Pagination .= ($SHONiR_Page_No <= 1)?' disabled':'';
    $SHONiR_Pagination .=  '"><a  class="page-link" ';
    $SHONiR_Pagination .=  ($SHONiR_Page_No > 1)?'href="'.$SHONiR_Page.'n='.$SHONiR_Previous.'"':'';
    $SHONiR_Pagination .=  '>Previous</a></li>';

    }

    if ($SHONiR_Total_Pages <= $SHONiR_Records_Limit){  	 
		for ($counter = 1; $counter <= $SHONiR_Total_Pages; $counter++){
			if ($counter == $SHONiR_Page_No) {
                $SHONiR_Pagination .= "<li class='page-item active'><a class='page-link' >$counter</a></li>";	
				}else{
                    $SHONiR_Pagination .= "<li class='page-item'><a  class='page-link' href='".$SHONiR_Page."n=$counter'>$counter</a></li>";
				}
        }
    }
    
    elseif($SHONiR_Total_Pages > $SHONiR_Records_Limit){

        if($SHONiR_Page_No <= $SHONiR_Pages_Limit) {			
            for ($counter = 1; $counter < ($SHONiR_Pages_Limit*2); $counter++){		 
                   if ($counter == $SHONiR_Page_No) {
                    $SHONiR_Pagination .= "<li class='page-item active'><a class='page-link' >$counter</a></li>";	
                       }else{
                        $SHONiR_Pagination .= "<li class='page-item'><a class='page-link'  href='".$SHONiR_Page."n=$counter'>$counter</a></li>";
                       }
               }
               $SHONiR_Pagination .= "<li class='page-item'><a class='page-link' >...</a></li>";
               $SHONiR_Pagination .= "<li class='page-item'><a  class='page-link' href='".$SHONiR_Page."n=".$SHONiR_Second_Last_Page."'>".$SHONiR_Second_Last_Page."</a></li>";
               $SHONiR_Pagination .= "<li class='page-item'><a  class='page-link' href='".$SHONiR_Page."n=".$SHONiR_Total_Pages."'>".$SHONiR_Total_Pages."</a></li>";
               }

               elseif($SHONiR_Page_No > $SHONiR_Pages_Limit && $SHONiR_Page_No < $SHONiR_Total_Pages - $SHONiR_Pages_Limit) {		 
                $SHONiR_Pagination .=  "<li class='page-item'><a  class='page-link' href='".$SHONiR_Page."n=1'>1</a></li>";
                $SHONiR_Pagination .=  "<li class='page-item'><a  class='page-link' href='".$SHONiR_Page."n=2'>2</a></li>";
                $SHONiR_Pagination .=  "<li class='page-item'><a class='page-link' >...</a></li>";
                for ($counter = $SHONiR_Page_No - $SHONiR_Adjust; $counter <= $SHONiR_Page_No + $SHONiR_Adjust; $counter++) {			
                   if ($counter == $SHONiR_Page_No) {
                    $SHONiR_Pagination .=  "<li class='page-item active'><a class='page-link' >$counter</a></li>";	
                        }else{
                            $SHONiR_Pagination .=  "<li class='page-item'><a class='page-link'  href='".$SHONiR_Page."n=$counter'>$counter</a></li>";
                        }                  
               }
               $SHONiR_Pagination .=  "<li class='page-item'><a class='page-link' >...</a></li>";
               $SHONiR_Pagination .=  "<li class='page-item'><a  class='page-link' href='".$SHONiR_Page."n=".$SHONiR_Second_Last_Page."'>".$SHONiR_Second_Last_Page."</a></li>";
               $SHONiR_Pagination .=  "<li class='page-item'><a  class='page-link' href='".$SHONiR_Page."n=".$SHONiR_Total_Pages."'>".$SHONiR_Total_Pages."</a></li>";      
                    }
                
                else {
                    $SHONiR_Pagination .=  "<li class='page-item'><a  class='page-link' href='".$SHONiR_Page."n=1'>1</a></li>";
                    $SHONiR_Pagination .=  "<li class='page-item'><a  class='page-link' href='".$SHONiR_Page."n=2'>2</a></li>";
                    $SHONiR_Pagination .=  "<li class='page-item'><a class='page-link' >...</a></li>";
        
                for ($counter = $SHONiR_Total_Pages - ($SHONiR_Pages_Limit+2); $counter <= $SHONiR_Total_Pages; $counter++) {
                  if ($counter == $SHONiR_Page_No) {
                    $SHONiR_Pagination .=  "<li class='page-item active'><a class='page-link' >$counter</a></li>";	
                        }else{
                            $SHONiR_Pagination .=  "<li class='page-item'><a  class='page-link' href='".$SHONiR_Page."n=$counter'>$counter</a></li>";
                        }                   
                        }
                    }
            }

            if($SHONiR_Next_Button == TRUE ){

            $SHONiR_Pagination .= "<li class='page-item ";

            $SHONiR_Pagination .= ($SHONiR_Page_No >= $SHONiR_Total_Pages)?'disabled':'';

            $SHONiR_Pagination .=  "'><a  class='page-link'"; 

            $SHONiR_Pagination .=  ($SHONiR_Page_No < $SHONiR_Total_Pages)?"href='".$SHONiR_Page."n=$SHONiR_Next'":"";

            $SHONiR_Pagination .= '>Next</a></li>';

            }

            if($SHONiR_First_Button == TRUE ){
            if($SHONiR_Page_No < $SHONiR_Total_Pages){
                $SHONiR_Pagination .=  "<li class='page-item'><a  class='page-link' href='".$SHONiR_Page."n=".$SHONiR_Total_Pages."'>Last &rsaquo;&rsaquo;</a></li>";
                }
            }

                $SHONiR_Pagination .= '</ul>';


                $SHONiR_Data['Pagination'] = $SHONiR_Pagination;         

     }else{

        $SHONiR_Data = false;

     }     

     return $SHONiR_Data;

    


}


?>