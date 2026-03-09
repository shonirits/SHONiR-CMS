<?php

namespace App\Controllers;

class MailsServers extends Shonir_Controller
{

    public function __construct() {
        parent::__construct();
    }

    public function index()
    {

        $view_data['page'] = [
            'title' => "Mails Servers | ".$this->cc['app_name'],
           'description' => "",
           'keywords' => "",
           'url' => current_url(),
           'type' => "website"
         ];  

       $view_data['cc'] = $this->cc;

        return view('welcome_message', $view_data);

    }


    public function list()
    {

        $GLOBALS['HTMLS_CACHE'] = false;

        $user_info = $this->_verify_user_area(1);

        $default_limit = 10;
        $get_result_where = ''; 
        $get_result_like =  '';

        $page = (int) ($this->request->getGet('page') ?? 1);        
        $limit = (int) ($this->request->getGet('limit') ?? $default_limit);

        $order = $this->request->getGet('order');
        $sort = $this->request->getGet('sort');
        $query = $this->request->getGet('query');

        if(!$page){
            $page = 1;
        }

        $order_list = array('mail_server_id' => 'Mail Server ID', 'hostname' => 'Hostname', 'email' => 'Email', 'username' => 'Username', 'relay' => 'Relay', 'relay_type' => 'Relay Type', 'priority' => 'Priority', 'sent' => 'Sent', 'total_used' => 'Total Used', 'succeed' => 'Succeed', 'failed' => 'Failed', 'port' => 'Port', 'crypto' => 'Crypto', 'status' => 'Status', 'last_used_time' => 'Last Used Time', 'reset_time' => 'Reset Time');
        if(!array_key_exists($order, $order_list)){
            $order = 'email';
        }

        $limit_list = array('10' => '10', '25' => '25', '50' => '50', '100' => '100', '250' => '250', '500' => '500', '1000' => '1000');
        if(!array_key_exists($limit, $limit_list)){
            $limit = 10;
        }
        

        $sort_list = array('ASC' => 'Ascending', 'DESC' => 'Descending');
        if(!array_key_exists($sort, $sort_list)){
            $sort = 'ASC';
        }

        if($query){
            $get_result_like = array("LOWER(mail_server_id)" => strtolower($query), "LOWER(hostname)" => strtolower($query), "LOWER(email)" => strtolower($query), "LOWER(username)" => strtolower($query), "LOWER(port)" => strtolower($query), "LOWER(last_error)" => strtolower($query));          
         }

        if($limit < $default_limit || $page < 1){
            $alert_data['alert'] = ['type' => 'error', 'message' => "The requested record was not found"];
             $this->session->set($alert_data);
             return redirect()->to($this->cc['base_url'].'MailsServers/list');
           }

        $view_data['page'] = [
            'title' => "List | Mails Servers | ".$this->cc['app_name'],
           'description' => "",
           'keywords' => "",
           'url' => current_url(),
           'type' => "website"
         ];         

         $total_records = $this->CRUDModel->do_count('mails_servers', $get_result_where, $get_result_like);

        $start = ($page-1)*$limit;

        $get_result = ($total_records > 0)?$this->CRUDModel->get_result('mails_servers', $get_result_where, '', $order.' '.$sort, $limit, $start, $get_result_like):false;

        $url = $this->cc['base_url'].'MailsServers/list?query='.$query.'&order='.$order.'&sort='.$sort.'&limit='.$limit;

        $view_data['pagination'] = ($total_records > 0)?pagination_fnc($get_result, $total_records, $limit, $page, $url):false; 
        
        $view_data['order_list'] = $order_list;
        $view_data['sort_list'] = $sort_list;
        $view_data['limit_list'] = $limit_list;
        $view_data['order'] = $order;
        $view_data['sort'] = $sort;
        $view_data['limit'] = $limit;
        $view_data['query'] = $query;
  
        $view_data['cc'] = $this->cc;

        return view('backend/'.$this->cc['backend_theme'].'/mails_servers_list', $view_data);

    }

    public function delete()
    {

        $GLOBALS['HTMLS_CACHE'] = false;

        $user_info = $this->_verify_user_area(1);

        if($user_info['role'] == 0){
         $alert_data['alert'] = ['type' => 'error', 'message' => "Authorization failed: You are not permitted to perform this action."];
             $this->session->set($alert_data);
             return redirect()->to($this->cc['base_url'].'Backend');
        }

        $req_id = $this->request->getGet('id');

        $get_row_where = array('mail_server_id' => $req_id);                    
        $get_row = $this->CRUDModel->get_row('mails_servers', $get_row_where);

        if(!$get_row){

            $alert_data['alert'] = ['type' => 'error', 'message' => "The record id# ".$req_id." was not found"];
             $this->session->set($alert_data);

             return redirect()->to($this->cc['base_url'].'MailsServers/list');

        }else{

            if($get_row['removable'] != 1){

            $alert_data['alert'] = ['type' => 'error', 'message' => "The record id# ".$req_id." was not removable"];
             $this->session->set($alert_data);

             return redirect()->to($this->cc['base_url'].'MailsServers/list');

          }else{      

        $this->CRUDModel->do_delete('mails_servers', $get_row_where);
            
        $alert_data['alert'] = ['type' => 'success', 'message' => "The record id# ".$req_id." has been deleted successfully"];
        $this->session->set($alert_data);

        return redirect()->to($this->cc['base_url'].'MailsServers/list');

        }

    }

    }


    public function edit()
    {

        $GLOBALS['HTMLS_CACHE'] = false;

        $user_info = $this->_verify_user_area(1);

        $req_id = $this->request->getGet('id');

        $get_row_where = array('mail_server_id' => $req_id);                    
        $get_row = $this->CRUDModel->get_row('mails_servers', $get_row_where);

        if(!$get_row){

            $alert_data['alert'] = ['type' => 'error', 'message' => "The requested record id# ".$req_id." was not found"];
             $this->session->set($alert_data);

             return redirect()->to($this->cc['base_url'].'MailsServers/list');

        }else{

        $relay_types_list = relay_types_fnc();

        $view_data['form'] = array('id' => $req_id, 'token' => get_token_fnc(16), 'hostname' => $get_row['hostname'], 'email' => $get_row['email'], 'username' => $get_row['username'], 'password' => $get_row['password'], 'port' => $get_row['port'], 'crypto' => $get_row['crypto'], 'relay' => $get_row['relay'], 'relay_type' => $get_row['relay_type'], 'priority' => $get_row['priority'], 'status' => $get_row['status'], 'relay_types_list' => $relay_types_list);

        if ($this->request->getMethod() == "POST") {

        if($user_info['role'] == 0){
         $alert_data['alert'] = ['type' => 'error', 'message' => "Authorization failed: You are not permitted to perform this action."];
             $this->session->set($alert_data);
             return redirect()->to($this->cc['base_url'].'Backend');
        }
            
        $this->validation->setRules([
          'hostname' => ['label' => 'Hostname', 'rules' => 'required|trim'],
          'email' => ['label' => 'Email', 'rules' => 'required|trim'],
          'username' => ['label' => 'Username', 'rules' => 'required|trim'],
          'password' => ['label' => 'Password', 'rules' => 'required|trim'],
          'port' => ['label' => 'Port', 'rules' => 'required|trim'],
          'relay' => ['label' => 'Relay', 'rules' => 'required|trim'],
          'relay_type' => ['label' => 'Relay Type', 'rules' => 'required|trim'],
          'priority' => ['label' => 'Priority', 'rules' => 'required|trim'],
      ]);
        
        $req_token = $this->request->getPost('token');
        $req_hostname = $this->request->getPost('hostname');
        $req_email = $this->request->getPost('email');
        $req_username = $this->request->getPost('username');
        $req_password = $this->request->getPost('password');
        $req_port = $this->request->getPost('port');
        $req_crypto = $this->request->getPost('crypto');
        $req_relay = (int) ($this->request->getPost('relay') ?? 0);
        $req_relay_type = (int) ($this->request->getPost('relay_type') ?? 0);
        $req_priority = (int) ($this->request->getPost('priority') ?? 0);
        $req_status = (int) ($this->request->getPost('status') ?? 0);
       

        $view_data['form'] = array('token' => $req_token, 'hostname' => $req_hostname, 'email' => $req_email, 'username' => $req_username, 'password' => $req_password, 'port' => $req_port, 'crypto' => $req_crypto, 'relay' => $req_relay, 'relay_type' => $req_relay_type, 'priority' => $req_priority, 'status' => $req_status, 'relay_types_list' => $relay_types_list);

            if($this->validation->withRequest($this->request)->run() == FALSE){
    
                $alert_data['alert'] = ['type' => 'error', 'message' => $this->validation->listErrors('my_validation_list')];        
                $this->session->set($alert_data);

                }else{

                    $do_count_where = array('token' => $req_token);                    
                    $do_count = $this->CRUDModel->do_count('mails_servers', $do_count_where);

                    if($do_count > 0){
    
                        $alert_data['alert'] = ['type' => 'error', 'message' => 'Duplicate records entry not allowed'];        
                        $this->session->set($alert_data);

                    }else{   

                    $do_update_where = array('mail_server_id' => $req_id);

                    $do_update_data =  array('token' => $req_token, 'hostname' => $req_hostname, 'email' => $req_email, 'username' => $req_username, 'password' => $req_password, 'port' => $req_port, 'crypto' => $req_crypto, 'relay' => $req_relay, 'relay_type' => $req_relay_type, 'priority' => $req_priority, 'status' => $req_status, 'edit_by' => $user_info['user_id'], 'edit_time' => time(), 'edit_ip' => $this->request->getIPAddress());

                   $this->CRUDModel->do_update('mails_servers', $do_update_where, $do_update_data);                                
    
                            $alert_data['alert'] = ['type' => 'success', 'message' => "The record id# ".$req_id." has been updated successfully"];
                            $this->session->set($alert_data);                

                            return redirect()->to($this->cc['base_url'].'MailsServers/list');
                        }

                }


        }

        $view_data['page'] = [
            'title' => "Edit | Mails Servers | ".$this->cc['app_name'],
           'description' => "",
           'keywords' => "",
           'url' => current_url(),
           'type' => "website"
         ];  
  
       $view_data['cc'] = $this->cc;

        return view('backend/'.$this->cc['backend_theme'].'/mails_servers_edit', $view_data);

    }

    }


    public function add()
    {

        $GLOBALS['HTMLS_CACHE'] = false;

        $user_info = $this->_verify_user_area(1);

        $relay_types_list = relay_types_fnc();

        $view_data['form'] = array('token' => get_token_fnc(16), 'hostname' => '', 'email' => '', 'username' => '', 'password' => '', 'port' => '', 'crypto' => '', 'relay' => '', 'relay_type' => '', 'priority' => '', 'status' => 1, 'relay_types_list' => $relay_types_list);

        if ($this->request->getMethod() == "POST") {

        if($user_info['role'] == 0){
         $alert_data['alert'] = ['type' => 'error', 'message' => "Authorization failed: You are not permitted to perform this action."];
             $this->session->set($alert_data);
             return redirect()->to($this->cc['base_url'].'Backend');
        }

        $this->validation->setRules([
          'hostname' => ['label' => 'Hostname', 'rules' => 'required|trim'],
          'email' => ['label' => 'Email', 'rules' => 'required|trim'],
          'username' => ['label' => 'Username', 'rules' => 'required|trim'],
          'password' => ['label' => 'Password', 'rules' => 'required|trim'],
          'port' => ['label' => 'Port', 'rules' => 'required|trim'],
          'relay' => ['label' => 'Relay', 'rules' => 'required|trim'],
          'relay_type' => ['label' => 'Relay Type', 'rules' => 'required|trim'],
          'priority' => ['label' => 'Priority', 'rules' => 'required|trim'],
      ]);
        
        $req_token = $this->request->getPost('token');
        $req_hostname = $this->request->getPost('hostname');
        $req_email = $this->request->getPost('email');
        $req_username = $this->request->getPost('username');
        $req_password = $this->request->getPost('password');
        $req_port = $this->request->getPost('port');
        $req_crypto = $this->request->getPost('crypto');
        $req_relay = (int) ($this->request->getPost('relay') ?? 0);
        $req_relay_type = (int) ($this->request->getPost('relay_type') ?? 0);
        $req_priority = (int) ($this->request->getPost('priority') ?? 0);
        $req_status = (int) ($this->request->getPost('status') ?? 0);
        

        $view_data['form'] = array('token' => $req_token, 'hostname' => $req_hostname, 'email' => $req_email, 'username' => $req_username, 'password' => $req_password, 'port' => $req_port, 'crypto' => $req_crypto, 'relay' => $req_relay, 'relay_type' => $req_relay_type, 'priority' => $req_priority, 'status' => $req_status, 'relay_types_list' => $relay_types_list);

            if($this->validation->withRequest($this->request)->run() == FALSE){
    
                $alert_data['alert'] = ['type' => 'error', 'message' => $this->validation->listErrors('my_validation_list')];        
                $this->session->set($alert_data);

                }else{

                    $do_count_where = array('token' => $req_token);                    
                    $do_count = $this->CRUDModel->do_count('mails_servers', $do_count_where);

                    if($do_count > 0){
    
                        $alert_data['alert'] = ['type' => 'error', 'message' => 'Duplicate records entry not allowed'];        
                        $this->session->set($alert_data);

                        }else{

                    $do_create_data =  array('token' => $req_token, 'hostname' => $req_hostname, 'email' => $req_email, 'username' => $req_username, 'password' => $req_password, 'port' => $req_port, 'crypto' => $req_crypto, 'relay' => $req_relay, 'relay_type' => $req_relay_type, 'priority' => $req_priority, 'status' => $req_status, 'add_by' => $user_info['user_id'], 'add_time' => time(), 'add_ip' => $this->request->getIPAddress());

                   $do_create_id = $this->CRUDModel->do_create('mails_servers', $do_create_data);

   
                            $alert_data['alert'] = ['type' => 'success', 'message' => "The new record id# ".$do_create_id." has been saved successfully"];
                            $this->session->set($alert_data);   
                            
                            return redirect()->to($this->cc['base_url'].'MailsServers/list');

                        }

                }


        }

        $view_data['page'] = [
            'title' => "Add | Mails Servers | ".$this->cc['app_name'],
           'description' => "",
           'keywords' => "",
           'url' => current_url(),
           'type' => "website"
         ];  
  
       $view_data['cc'] = $this->cc;

        return view('backend/'.$this->cc['backend_theme'].'/mails_servers_add', $view_data);

    }


    

}