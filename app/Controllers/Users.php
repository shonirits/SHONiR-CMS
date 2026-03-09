<?php namespace App\Controllers;

class Users extends Shonir_Controller
{

    public function __construct() {
        parent::__construct();
    }

    public function index()
    {

        $GLOBALS['HTMLS_CACHE'] = false;

       $this->_verify_user_area();

       $current_page_id = 'login';


         $req_continue = $this->request->getGetPost('continue');

       if ($this->request->getMethod() == "POST") {

        $req_key = $this->request->getPost('key');
        $req_captcha_code = $this->request->getPost('captcha_code');
        $req_captcha_token = $this->request->getPost('captcha_token');

        if($req_key && $req_captcha_code && $req_captcha_token){
            
            if($this->_captcha_verify($req_captcha_code, $req_captcha_token)){

            return redirect()->to($this->cc['base_url'].'Users/'.$req_key.'?continue='.$req_continue);

            }else{

                $alert_data['alert'] = ['type' => 'error', 'message' => "Incorrect CAPTCHA Code"];
                $this->session->set($alert_data);

            }

            }

       }

       $view_data['cc'] = $this->cc;

       $view_data['page'] = [
            'title' => "Secure Login | ".$this->cc['app_name'],
           'description' => "",
           'keywords' => "",
           'url' => current_url(),
           'id' => $current_page_id,
           'type' => "website"
         ]; 

       $view_data['continue'] = $req_continue;
       $view_data['captcha_token'] = $this->_captcha_token();

        return view('backend/'.$this->cc['backend_theme'].'/welcome', $view_data);

    }


    public function dashboard()
    {
        $GLOBALS['HTMLS_CACHE'] = false;
        $this->_verify_user_area();

        $view_data['page'] = [
            'title' => "Dashboard | User | ".$this->cc['app_name'],
           'description' => "",
           'keywords' => "",
           'url' => current_url(),
           'type' => "website"
         ];  
  
       $view_data['cc'] = $this->cc;

       

        return view('backend/'.$this->cc['backend_theme'].'/users_dashboard', $view_data);

    }

     public function logout()
    {

        $this->_user_logout(false);

          $alert_data['alert'] = ['type' => 'info', 'message' => "<b>You'\ve safely logged out. </b> See you again soon!"];    
        $this->session->set($alert_data);
    
       redirect_fnc($this->cc['base_url'].'Users');

    }


    public function _remap($method, $params = array())
    {

        $GLOBALS['HTMLS_CACHE'] = false;

        $current_page_id = 'login';

        if (method_exists($this, $method)) {

           return call_user_func_array(array($this,$method), $params);

        } else {

        if ($this->cc['app_key'] == $method) {

            $this->_verify_user_area();

            $req_continue = $this->request->getGetPost('continue');

            if ($this->request->getMethod() == "POST") {

                $req_email = $this->request->getPost('email');
                $req_password = $this->request->getPost('password');
                $req_captcha_code = $this->request->getPost('captcha_code');
                $req_captcha_token = $this->request->getPost('captcha_token');
                
                $this->validation->setRules([
                    'email' => ['label' => 'Email Address', 'rules' => 'required|trim|valid_email|min_length[3]'],
                    'password' => ['label' => 'Password', 'rules' => 'required|min_length[6]'],
                    'captcha_code' => ['label' => 'Captcha Code', 'rules' => 'required|min_length[2]'],
                ]);

                if ($this->validation->withRequest($this->request)->run() == FALSE) {
    
                    $alert_data['alert'] = ['type' => 'error', 'message' => $this->validation->listErrors('my_validation_list')];  
                    $this->session->set($alert_data);
                    }else{

                if($req_captcha_code && $req_captcha_token){

                  if($this->_captcha_verify($req_captcha_code, $req_captcha_token)){

                    $get_user_where = ['email' => $req_email];
                    $get_user = $this->CRUDModel->get_row('users', $get_user_where);

                if ($get_user) {

                 if ($get_user['password'] === md5($req_password)) {

                if ($get_user['status'] == 1) {  

                    $ses_data = [
                        'user' => $get_user,
                        'is_logged_in' => TRUE
                    ];

                    $this->session->set($ses_data);
                    $this->_verify_user_area();

                } else {

                        $alert_data['alert'] = ['type' => 'error', 'message' => "Your account is not activated."];
                        $this->session->set($alert_data);
                    }

                } else {

                        $alert_data['alert'] = ['type' => 'error', 'message' => "The login information submitted is invalid."];
                        $this->session->set($alert_data);
                    }

                } else {

                    $alert_data['alert'] = ['type' => 'error', 'message' => "Sorry, we don\'t recognize your entered information."];
                    $this->session->set($alert_data);
                }

            }else{

                $alert_data['alert'] = ['type' => 'error', 'message' => "Incorrect CAPTCHA Code"];
                $this->session->set($alert_data);
            }

        }else{

            $alert_data['alert'] = ['type' => 'error', 'message' => "The information submitted is invalid."];
            $this->session->set($alert_data);
        }

            }

            }

            $view_data['page'] = [
                'title' => "Login | User | ".$this->cc['app_name'],
               'description' => "",
               'keywords' => "",
               'url' => current_url(),
               'id' => $current_page_id,
               'type' => "website"
             ];      
      
           $view_data['cc'] = $this->cc;
           $view_data['key'] = $method; 
           $view_data['continue'] = $req_continue;
           $view_data['captcha_token'] = $this->_captcha_token();
    
            return view('backend/'.$this->cc['backend_theme'].'/login', $view_data);

        } else {

            throw \CodeIgniter\Exceptions\PageNotFoundException::forPageNotFound(); 

        }

    }


    }

}


