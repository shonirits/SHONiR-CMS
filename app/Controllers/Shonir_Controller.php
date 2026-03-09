<?php namespace App\Controllers;

class Shonir_Controller extends BaseController
{

  function __construct() {

    $this->CRUDModel = new \App\Models\CRUDModel();
    $this->ToolsModel = new \App\Models\ToolsModel();
   
  }



  function _verify_user_area($role = 0){

    $auto_login = array($this->cc['app_key'], '', 'index', 'login', 'signup', 'forgot_password', 'reset_password');
  
    $var_current_url = current_url(true);
  
    $url_parts = parse_url($var_current_url);
    $hostname = str_replace('www.', '', $url_parts['host']);
  
        $uri = new \CodeIgniter\HTTP\URI($var_current_url);
        $baseURL = config('App')->baseURL;
        $var_segment = '';
        $var_method = '';

        $inSubDir = trim(parse_url($baseURL, PHP_URL_PATH), '/') !== '';
        $subCount = 0;
  
        if ($hostname === 'localhost' || $inSubDir) {
        $subCount = substr_count(parse_url($baseURL, PHP_URL_PATH), '/');
        if($subCount > 0){
        $var_segment = $uri->getSegment(1 + $subCount);
        $var_method = $uri->getSegment(0 + $subCount);
        }
        }else{
        $var_segment = $uri->getSegment(2);
        $var_method = $uri->getSegment(1);
        }
        

      //  print_r($var_method);echo '<hr/>';exit;

        if($this->_is_user_logged_in() == TRUE){

          $user_info = $this->session->user;

          if (in_array($var_segment, $auto_login, TRUE) == TRUE && $var_method == 'Users')
      {

        if($user_info['role'] == 1){
    
        redirect_fnc($this->cc['base_url'].'Backend');

        }else{

        redirect_fnc($this->cc['base_url'].'Users/dashboard');

        }
    
        }else{

          return $user_info;

        }
    
        }else{

          $this->_user_logout(false);
    
          if (in_array($var_segment, $auto_login, TRUE) == FALSE || $var_method != 'Users')
      {


        $alert_data['alert'] = ['type' => 'info', 'message' => "<b>Your session has expired. </b> Please log in again."];    
        $this->session->set($alert_data);
    
       redirect_fnc($this->cc['base_url'].'Users?continue='.url_encode_fnc($var_current_url));
    
      }

      return false;
    
        }


  }

  function _is_user_logged_in() {

    $var_return = FALSE;

    if($this->session->is_logged_in == TRUE){

        if($this->session->user && ($this->session->user !== NULL || $this->session->user !== '')) {
          $var_return = TRUE;                
        }

    }

      return $var_return;

    }

    function _user_logout($redirect = true) {

      $this->session->remove(['is_logged_in', 'user']);
      $this->session->destroy();
      $this->session->start();
      $this->session->regenerate(true);

      $new_session_data = [
        'is_logged_in'  => FALSE,
        'user'     => NULL,
    ];
    
    $this->session->set($new_session_data);

    $this->session->remove('is_logged_in');
    $this->session->remove('user');

    $remove_session_data = ['is_logged_in', 'user'];

    $this->session->remove($remove_session_data);

    $this->session->stop();

    $this->session->start();
    $this->session->regenerate(true);
    $this->session->destroy();

    $this->session->start();
    $this->session->regenerate(true);

      if($this->_is_user_logged_in()){

        $this->_user_logout($redirect);

      }

      if($redirect){

        $alert_data['alert'] = ['type' => 'success', 'message' => "You have been successfully logged out."];

          $this->session->set($alert_data);
        redirect_fnc($this->cc['base_url'].'Users');

      }

}


  function _captcha_token()
    {    

      $token = get_token_fnc(27);
      $code = get_token_fnc(3);

      $var_insert_captcha = array('token' => $token, 'code' => $code, 'add_at' => time(), 'add_ip' => $this->request->getIPAddress());
      $insert_captcha = $this->ToolsModel->insert_captcha($var_insert_captcha);

      return $token;

    }

  function _captcha_verify($captcha_code, $captcha_token)
  {

      $return = false;

      if($captcha_code && $captcha_token){

      $get_where = ['token' => $captcha_token, 'code' => $captcha_code];

      $get_captcha = $this->ToolsModel->get_captcha($get_where);

      if($get_captcha){  

          $return = true;
      
      }

      $delete_where = "token='".$captcha_token."' OR add_ip='".$this->request->getIPAddress()."'";
      $this->ToolsModel->delete_captcha($delete_where);
   
    }   

    return $return;

  }

  
  

}
