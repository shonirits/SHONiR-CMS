<?php // Lets get the strat time of code
$SHONiR_Time = microtime();
$SHONiR_Time = explode(' ', $SHONiR_Time);
$SHONiR_Time = $SHONiR_Time[1] + $SHONiR_Time[0];
$SHONiR_Start = $SHONiR_Time;

define('SHONiR_START', $SHONiR_Start);
$GLOBALS['SHONiR_START'] = $SHONiR_Start;
define('SHONiR_VERSION', 0.1);

$SHONiR_MinimumPHPVersion = 7;

if (phpversion() < $SHONiR_MinimumPHPVersion)
{
    die("Your PHP version must be {$SHONiR_MinimumPHPVersion} or higher to run SHONiR CMS ".SHONiR_VERSION.". Current PHP version: " . phpversion());
}

// We will use this to ensure scripts are not called from outside of the framework
define( "SHONiR", TRUE );

header('Cache-Control: max-age=84600');

// virtual root path
define('SHONiR_ROOT', __DIR__ . DIRECTORY_SEPARATOR);

// location of the config file.
require_once('shonir.config.php');

// get included files by composer.
require_once('./vendor/autoload.php');
@ob_get_clean();

// start session
session_start() or die('Session could not be started.');

$GLOBALS['SHONiR_SESSION_ID'] = session_id();

$GLOBALS['SHONiR_VERSION'] = SHONiR_VERSION;

$GLOBALS['SHONiR_APANEL'] = SHONiR_IDLE;

// connecting database.
$SHONiR_DB_Con = SHONiR_Connect_DB_Fnc($SHONiR_DB_Host, $SHONiR_DB_Name, $SHONiR_DB_Username, $SHONiR_DB_Password, $SHONiR_DB_Port, $SHONiR_DB_Socket);

$SHONiR_Settings = array();

$SHONiR_Query_Settings = SHONiR_Query_Fnc("select * from tbl_settings order by sort_order");

$SHONiR_Row_Settings = SHONiR_Row_Fnc($SHONiR_Query_Settings);

if($SHONiR_Row_Settings > 0 ){

while($SHONiR_Fetch_Settings = SHONiR_Fetch_Fnc($SHONiR_Query_Settings)){

    $SHONiR_Settings[$SHONiR_Fetch_Settings['setting_code'].'_'.$SHONiR_Fetch_Settings['setting_key']] = $SHONiR_Fetch_Settings['setting_value'];

}

}else{

    die("Unable to load website settings. Please contact to developer at WhatsApp: +92-333-333-6426 or email at info@shonir.com or for more infomation visit website www.shonir.com");

}

unset($SHONiR_MinimumPHPVersion);

$GLOBALS['SHONiR_SETTINGS'] = $SHONiR_Settings;

define('SHONiR_SETTINGS', $SHONiR_Settings);

if(SHONiR_SETTINGS['config_error_reporting']=="FALSE"){

    error_reporting(0);

}else{

ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
ini_set('error_reporting', E_ALL );
error_reporting(E_ALL);

set_error_handler("SHONiR_Error_Handler_Fnc");

}


define('SHONiR_CACHE_LIFE', (3600 * SHONiR_SETTINGS['config_cache_life']));

//output buffering
if(SHONiR_SETTINGS['config_buffering']=="TRUE"){
ob_start();
}

// default time zone
date_default_timezone_set(SHONiR_SETTINGS['config_timezone']);

// current link

$SHONiR_URL_CHANGE = FALSE;

$SHONiR_HTTP = (isset($_SERVER['HTTPS']) && $_SERVER['HTTPS'] === 'on' ? "https" : "http") ;

$SHONiR_HOST =    $_SERVER['HTTP_HOST'];

if(SHONiR_SETTINGS['config_ssl'] == 'STRICT' && (!isset($_SERVER['HTTPS']) || $_SERVER['HTTPS'] != 'on')){

    $SHONiR_URL_CHANGE = TRUE;

    $SHONiR_HTTP = "https";

}elseif(SHONiR_SETTINGS['config_ssl'] == 'NONE' && (isset($_SERVER['HTTPS']) && $_SERVER['HTTPS'] === 'on')){

    $SHONiR_URL_CHANGE = TRUE;

    $SHONiR_HTTP = "http";

}

if(SHONiR_SETTINGS['config_www'] == 'STRICT' && substr($SHONiR_HOST, 0,4) != 'www.'){

    $SHONiR_URL_CHANGE = TRUE;

    $SHONiR_HOST =    "www.".$SHONiR_HOST;

}elseif(SHONiR_SETTINGS['config_www'] == 'NONE' && substr($SHONiR_HOST, 0,4) === 'www.'){

    $SHONiR_URL_CHANGE = TRUE;

 $SHONiR_HOST =    preg_replace('#^www\.(.+\.)#i', '$1', $SHONiR_HOST);

}

$SHONiR_Link = $SHONiR_HTTP."://".$SHONiR_HOST.$_SERVER['REQUEST_URI'];

if($SHONiR_URL_CHANGE){

    SHONiR_Redirect_Fnc($SHONiR_Link);

}

$SHONiR_URL = $SHONiR_HTTP."://".$SHONiR_HOST.strtok($_SERVER["REQUEST_URI"], '?');

define('SHONiR_HTTP', $SHONiR_HTTP);

define('SHONiR_URL', $SHONiR_URL);

define('SHONiR_LINK', $SHONiR_Link);

// physical base url
$SHONiR_CPath = $_SERVER['PHP_SELF'];
$SHONiR_PInfo = pathinfo($SHONiR_CPath);
$SHONiR_IndexPos = stripos($SHONiR_PInfo['dirname'],"index.php");
if($SHONiR_IndexPos){
$SHONiR_Dir = substr($SHONiR_PInfo['dirname'], 0, $SHONiR_IndexPos);
}else{
 $SHONiR_Dir = $SHONiR_PInfo['dirname'];
}

$SHONiR_Dir = rtrim($SHONiR_Dir, "/");

$SHONiR_BASE = rtrim((isset($_SERVER['HTTPS']) && $_SERVER['HTTPS'] === 'on' ? "https" : "http") . "://{$_SERVER['HTTP_HOST']}".$SHONiR_Dir,"/");

define('SHONiR_BASE', $SHONiR_BASE.'/');

$SHONiR_CDN = SHONiR_BASE;

if(!empty(SHONiR_SETTINGS['cdn_global'])){

    $SHONiR_CDN = SHONiR_SETTINGS['cdn_global'];

    }

define('SHONiR_CDN', $SHONiR_CDN);

$SHONiR_CDN_AST = SHONiR_BASE;

if(!empty(SHONiR_SETTINGS['cdn_assets'])){

    $SHONiR_CDN_AST = SHONiR_SETTINGS['cdn_assets'];

    }

define('SHONiR_CDN_AST', $SHONiR_CDN_AST);


$SHONiR_CDN_IMG = SHONiR_BASE;

if(!empty(SHONiR_SETTINGS['cdn_images'])){

    $SHONiR_CDN_IMG = SHONiR_SETTINGS['cdn_images'];

    }

define('SHONiR_CDN_IMG', $SHONiR_CDN_IMG);

$SHONiR_APanel = SHONiR_SETTINGS['config_apanel'];

define('SHONiR_ABASE', $SHONiR_BASE.'/'.$SHONiR_APanel);

define('SHONiR_APANEL', SHONiR_ABASE.'/');

$SHONiR_View = "frontend";

$GLOBALS['SHONiR_APANEL'] = FALSE;

$SHONiR_URL_Array = ltrim(str_replace($SHONiR_Dir,"",parse_url($_SERVER['REQUEST_URI'], PHP_URL_PATH)),"/");

if(empty($SHONiR_URL_Array)){
	$SHONiR_Segments = null;
	$SHONiR_Total_Segments = 0;
}else{
$SHONiR_Segments = explode('/', $SHONiR_URL_Array);
$SHONiR_Total_Segments = count($SHONiR_Segments);
}
if($SHONiR_Total_Segments > 0){
if($SHONiR_Segments[0] == $SHONiR_APanel){
	$SHONiR_View = "backend";
	$GLOBALS['SHONiR_APANEL'] = TRUE;
	$SHONiR_URL_Array = str_replace($SHONiR_APanel,"",$SHONiR_URL_Array);
	$SHONiR_URL_Array = str_replace($SHONiR_APanel.'/',"",$SHONiR_URL_Array);
	$SHONiR_URL_Array =  ltrim(str_replace($SHONiR_Segments[0],"",$SHONiR_URL_Array),"/");
	if(!empty($SHONiR_URL_Array)){
	$SHONiR_Segments = explode('/', $SHONiR_URL_Array);
$SHONiR_Total_Segments = count($SHONiR_Segments);
	}else{
		$SHONiR_Segments = null;
		$SHONiR_Total_Segments = 0;
	}
}
}

if($GLOBALS['SHONiR_APANEL']){

	$SHONiR_Theme = SHONiR_SETTINGS['theme_backend'];

}else{

	$SHONiR_Theme = SHONiR_SETTINGS['theme_frontend'];

}

$GLOBALS['SHONiR_THEME'] = $SHONiR_Theme;
define('SHONiR_THEME', $SHONiR_Theme);
define('SHONiR_VIEW', $SHONiR_View);
define('SHONiR_SEGMENTS', $SHONiR_Segments);
$GLOBALS['SHONiR_RENDER'] = TRUE;
$GLOBALS['SHONiR_AJAX_VIEWS'] = FALSE;
$GLOBALS['SHONiR_VIEWS_FILE'] = FALSE;
$GLOBALS['SHONiR_CACHE'] = TRUE;
$GLOBALS['SHONiR_USER'] = FALSE;


$SHONiR_URI = SHONiR_URI_Fnc(SHONiR_SEGMENTS);

$SHONiR_App_Dir = array('assets', 'backups', 'cache', 'css', 'errors', 'js', 'media', 'system', 'views');

if (in_array($SHONiR_URI['First'], $SHONiR_App_Dir))
  {
  die("Forbidden access is denied. Please contact to developer at WhatsApp: +92-333-333-6426 or email at info@shonir.com or for more infomation visit website www.shonir.com");
  }
  $SHONiR_Dont_Cache = array('Cart', 'Checkout');

  if (in_array($SHONiR_URI['First'], $SHONiR_Dont_Cache) || SHONiR_Session_Exist_Fnc('SHONiR_Alert'))
  {
	$GLOBALS['SHONiR_CACHE'] = FALSE;
}

  $SHONiR_Dont_Visitor = array('Watermark', 'Captcha', 'Code', 'Ajax');

define('SHONiR_URI', $SHONiR_URI);

$SHONiR_IP = SHONiR_IP_Fnc();

define('SHONiR_IP', $SHONiR_IP);

$SHONiR_Agent = isset($_SERVER['HTTP_USER_AGENT']) ? $_SERVER['HTTP_USER_AGENT'] : "undefined";

$SHONiR_Is_Bot = SHONiR_Bot_Fnc($SHONiR_Agent);

$SHONiR_Is_Mobile = SHONiR_Mobile_Fnc($SHONiR_Agent);

$SHONiR_Local = SHONiR_Local_Fnc(SHONiR_IP);

define('SHONiR_LOCAL', $SHONiR_Local);

if(SHONiR_Session_Exist_Fnc('SHONiR_User')){

$SHONiR_User = 	SHONiR_Session_Read_Fnc('SHONiR_User');

if($SHONiR_User['user_type']==1){

	$SHONiR_Login =  SHONiR_AP_Login_Fnc($SHONiR_User['user_id'], $SHONiR_User['password']);

	if($SHONiR_Login != 'success'){

		SHONiR_AP_Logout_Fnc();

		SHONiR_Session_Delete_Fnc('SHONiR_User');
		$GLOBALS['SHONiR_USER'] = FALSE;
	$SHONiR_User['user_id'] = 0;
	$SHONiR_User['user_type'] = 0;
	$SHONiR_User['password'] = '';

	}else{

		$GLOBALS['SHONiR_USER'] = $SHONiR_User;

	}

}elseif($SHONiR_User['user_type']==3){

	$SHONiR_Login =  SHONiR_Customer_Login_Fnc($SHONiR_User['user_id'], $SHONiR_User['password']);

	if($SHONiR_Login != 'success'){

		SHONiR_Customer_Logout_Fnc();

		SHONiR_Session_Delete_Fnc('SHONiR_User');
		$GLOBALS['SHONiR_USER'] = FALSE;
	$SHONiR_User['user_id'] = 0;
	$SHONiR_User['user_type'] = 0;
	$SHONiR_User['password'] = '';

	}else{

		$GLOBALS['SHONiR_USER'] = $SHONiR_User;

	}

}else{

	SHONiR_Session_Delete_Fnc('SHONiR_User');
	$GLOBALS['SHONiR_USER'] = FALSE;
$SHONiR_User['user_id'] = 0;
$SHONiR_User['user_type'] = 0;
$SHONiR_User['password'] = '';

}


}else{

$GLOBALS['SHONiR_USER'] = FALSE;

$SHONiR_User['user_id'] = 0;
$SHONiR_User['user_type'] = 0;
$SHONiR_User['password'] = '';

}

if($GLOBALS['SHONiR_USER']){

	$GLOBALS['SHONiR_CACHE'] = FALSE;

}

define('SHONiR_USER', $SHONiR_User);

$SHONiR_Language = array();

$SHONiR_Language['language_id'] = 0;

if(SHONiR_Session_Exist_Fnc('web_language_id')){

	$SHONiR_Language['language_id'] = SHONiR_Session_Read_Fnc('web_language_id');

}

$SHONiR_web_language_id = SHONiR_Get_Fnc('web_language_id', FILTER_VALIDATE_INT);

        if($SHONiR_web_language_id){

			$SHONiR_Language['language_id'] = $SHONiR_web_language_id;
		}

if($SHONiR_Language['language_id']){

$SHONiR_Language = SHONiR_Languages_Fnc($SHONiR_Language['language_id'], 1, 'asc', 1);

if(!$SHONiR_Language){

	$SHONiR_Language = SHONiR_Languages_Fnc(FALSE, 1, 'asc', 1);

}

}else{

$SHONiR_Language = SHONiR_Languages_Fnc(FALSE, 1, 'asc', 1);

}

if(!isset($SHONiR_Language['language_id'])){

	$SHONiR_Language = 	$SHONiR_Language[0];

}

SHONiR_Session_Write_Fnc('web_language_id', $SHONiR_Language['language_id']);

define('SHONiR_LANGUAGE', $SHONiR_Language);

$GLOBALS['SHONiR_LANGUAGE'] = $SHONiR_Language;

$SHONiR_Currency = array();

$SHONiR_Currency['currency_id'] = 0;

if(SHONiR_Session_Exist_Fnc('web_currency_id')){

	$SHONiR_Currency['currency_id'] = SHONiR_Session_Read_Fnc('web_currency_id');

}

$SHONiR_web_currency_id = SHONiR_Get_Fnc('web_currency_id', FILTER_VALIDATE_INT);

        if($SHONiR_web_currency_id){

			$SHONiR_Currency['currency_id'] = $SHONiR_web_currency_id;
		}

if($SHONiR_Currency['currency_id']){

$SHONiR_Currency = SHONiR_Currencies_Fnc($SHONiR_Currency['currency_id'], 1, 'asc', 1);

if(!$SHONiR_Currency){

	$SHONiR_Currency = SHONiR_Currencies_Fnc(FALSE, 1, 'asc', 1);

}

}else{

$SHONiR_Currency = SHONiR_Currencies_Fnc(FALSE, 1, 'asc', 1);

}

if(!isset($SHONiR_Currency['currency_id'])){

	$SHONiR_Currency = 	$SHONiR_Currency[0];

}

SHONiR_Session_Write_Fnc('web_currency_id', $SHONiR_Currency['currency_id']);

define('SHONiR_CURRENCY', $SHONiR_Currency);

$GLOBALS['SHONiR_CURRENCY'] = $SHONiR_Currency;

$SHONiR_Visitor = SHONiR_Get_Visitor_Fnc('session_id', $GLOBALS['SHONiR_SESSION_ID']);

if($SHONiR_Visitor){

if((SHONiR_IDLE - (time() - $SHONiR_Visitor['edit_time'])) <= 0){

	SHONiR_Session_New_Fnc();

	$GLOBALS['SHONiR_SESSION_ID'] = session_id();

	$GLOBALS['SHONiR_USER'] = FALSE;

$SHONiR_User['user_id'] = 0;
$SHONiR_User['user_type'] = 0;

	$SHONiR_IP_Info = SHONiR_IP_Info_Fnc(SHONiR_IP);

SHONiR_Query_Fnc("insert into tbl_visitors (session_id, add_ip, language_id, currency_id, url, referer, bot, mobile, agent, user_id, user_type, country, city, code, add_time, edit_time) values ('".$GLOBALS['SHONiR_SESSION_ID']."', '".SHONiR_IP."', ".SHONiR_LANGUAGE['language_id'].", ".SHONiR_CURRENCY['currency_id'].", '".SHONiR_LINK."', '".SHONiR_Referer_Fnc()."', $SHONiR_Is_Bot, $SHONiR_Is_Mobile, '.$SHONiR_Agent.', ".SHONiR_USER['user_id'].", '".SHONiR_USER['user_type']."', '".$SHONiR_IP_Info['country_name']."', '".$SHONiR_IP_Info['city']."', '".$SHONiR_IP_Info['country_code']."', ".time().", ".time()." )");

SHONiR_Counter_Fnc('visitors');

}else{

	if(SHONiR_Is_Ajax_Fnc() === FALSE && in_array($SHONiR_URI['First'], $SHONiR_Dont_Visitor) === FALSE){
SHONiR_Query_Fnc("update tbl_visitors set edit_time=".time().", url='".SHONiR_LINK."', language_id=".SHONiR_LANGUAGE['language_id'].", currency_id=".SHONiR_CURRENCY['currency_id'].", user_id=".SHONiR_USER['user_id'].", user_type='".SHONiR_USER['user_type']."' where session_id='".$GLOBALS['SHONiR_SESSION_ID']."'");
SHONiR_Counter_Fnc('pageviews');
}else{

	SHONiR_Query_Fnc("update tbl_visitors set edit_time=".time()." where session_id='".$GLOBALS['SHONiR_SESSION_ID']."'");
}
}

}else{

$SHONiR_IP_Info = SHONiR_IP_Info_Fnc(SHONiR_IP);

if(SHONiR_Is_Ajax_Fnc() === FALSE && in_array($SHONiR_URI['First'], $SHONiR_Dont_Visitor) === FALSE){

SHONiR_Query_Fnc("insert into tbl_visitors (session_id, add_ip, language_id, currency_id, url, referer, bot, mobile, agent, user_id, user_type, country, city, code, add_time, edit_time) values ('".$GLOBALS['SHONiR_SESSION_ID']."', '".SHONiR_IP."', ".SHONiR_LANGUAGE['language_id'].", ".SHONiR_CURRENCY['currency_id'].", '".SHONiR_LINK."',  '".SHONiR_Referer_Fnc()."', $SHONiR_Is_Bot, $SHONiR_Is_Mobile, '.$SHONiR_Agent.', ".SHONiR_USER['user_id'].", '".SHONiR_USER['user_type']."', '".$SHONiR_IP_Info['country_name']."', '".$SHONiR_IP_Info['city']."', '".$SHONiR_IP_Info['country_code']."', ".time().", ".time()." )");

SHONiR_Counter_Fnc('visitors');

}

}

$SHONiR_Visitor = SHONiR_Get_Visitor_Fnc('session_id', $GLOBALS['SHONiR_SESSION_ID']);

define('SHONiR_SESSION_ID', $GLOBALS['SHONiR_SESSION_ID']);

if(SHONiR_SETTINGS['config_cache'] == "TRUE" && $GLOBALS['SHONiR_APANEL'] == FALSE && $GLOBALS['SHONiR_CACHE'] == TRUE){
	SHONiR_Cache_Fnc("R");
}

$SHONiR_Query_Online = SHONiR_Query_Fnc("select count(*) as total from tbl_visitors where edit_time>".(time()-SHONiR_IDLE)."");

$SHONiR_Fetch_Online = SHONiR_Fetch_Fnc($SHONiR_Query_Online);

$GLOBALS['SHONiR_ONLINE'] = $SHONiR_Fetch_Online['total'];

$SHONiR_Path = null;
$SHONiR_Data = null;

/*
 *---------------------------------------------------------------
 * LAUNCH THE APPLICATION
 *---------------------------------------------------------------
 * Now that everything is setup, it's time to actually fire
 * up the engines and make this app do its thang.
 */

$SHONiR_Fnc = ($GLOBALS['SHONiR_APANEL'] == TRUE)?'AP_':'';

if($SHONiR_Fnc === 'AP_'){

	if($SHONiR_URI['First'] != 'Welcome'){

		$SHONiR_Login =  SHONiR_AP_Login_Fnc(SHONiR_USER['user_id'], SHONiR_USER['password']);

        if($SHONiR_Login != 'success'){

          $SHONiR_Alert['type'] = 'error';
          $SHONiR_Alert['message'] = 'Access Denied: You must login to access requested page.';
          SHONiR_Session_Write_Fnc('SHONiR_Alert', $SHONiR_Alert);
          $SHONiR_Continue = urlencode(SHONiR_LINK);
          SHONiR_Redirect_Fnc(SHONiR_APANEL.'Welcome?continue='.$SHONiR_Continue);

          }

	}

}else{

	if($SHONiR_URI['First'] == 'Customers'){

		$GLOBALS['SHONiR_CACHE'] = FALSE;

		if($SHONiR_URI['Second'] != 'Login'){

		$SHONiR_Login =  SHONiR_Customer_Login_Fnc(SHONiR_USER['user_id'], SHONiR_USER['password']);

        if($SHONiR_Login != 'success'){

          $SHONiR_Alert['type'] = 'error';
          $SHONiR_Alert['message'] = 'Access Denied: You must login to access requested page.';
          SHONiR_Session_Write_Fnc('SHONiR_Alert', $SHONiR_Alert);
          $SHONiR_Continue = urlencode(SHONiR_LINK);
          SHONiR_Redirect_Fnc(SHONiR_BASE.'Customers/Login?continue='.$SHONiR_Continue);

          }

	}


	}

}

$SHONiR_Fnc = "SHONiR_".$SHONiR_Fnc.ucfirst($SHONiR_URI['First'])."_Fnc_Render";

if (function_exists($SHONiR_Fnc)) {
    $SHONiR_Data = call_user_func($SHONiR_Fnc);
} else {
	$SHONiR_First_Segments = "404";
	$SHONiR_Path = "errors";
}

if($SHONiR_Data == false){
	$SHONiR_First_Segments = "404";
	$SHONiR_Path = "errors";
}

if($GLOBALS['SHONiR_RENDER']){
 SHONiR_Render_Fnc_Main($SHONiR_URI['First'], $SHONiR_Data, $SHONiR_Path);
}

 SHONiR_Close_DB_Fnc();

if(SHONiR_SETTINGS['config_cache'] == "TRUE" && $GLOBALS['SHONiR_APANEL'] == FALSE && $GLOBALS['SHONiR_RENDER'] && $GLOBALS['SHONiR_CACHE'] == TRUE && ob_get_length() > 0){
	SHONiR_Cache_Fnc("W");
}

if(SHONiR_SETTINGS['config_buffering'] == "TRUE" && ob_get_length() > 0){
	ob_end_flush();
}

exit;
?>
