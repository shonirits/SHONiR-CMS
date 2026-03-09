<?php

namespace App\Controllers;

class Banners extends Shonir_Controller
{

    public function __construct() {
        parent::__construct();
    }

    public function index()
    {

        $view_data['page'] = [
            'title' => "Banners | ".$this->cc['app_name'],
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

        $order_list = array('banner_id' => 'Banner ID', 'title' => 'Title', 'name' => 'Name', 'published_time' => 'Published Time', 'today_views' => 'Today Views', 'lifetime_views' => 'Lifetime Views', 'today_hits' => 'Today Hits', 'lifetime_hits' => 'Lifetime Hits', 'edit_time' => 'Last Edited Time');
        if(!array_key_exists($order, $order_list)){
            $order = 'name';
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
            $get_result_like = array("LOWER(slug)" => strtolower($query), "LOWER(name)" => strtolower($query), "LOWER(title)" => strtolower($query), "LOWER(description)" => strtolower($query), "LOWER(parent_id)" => strtolower($query), "LOWER(link)" => strtolower($query));          
         }

        if($limit < $default_limit || $page < 1){
            $alert_data['alert'] = ['type' => 'error', 'message' => "The requested record was not found"];
             $this->session->set($alert_data);
             return redirect()->to($this->cc['base_url'].'Banners/list');
           }

        $view_data['page'] = [
            'title' => "List | Banners | ".$this->cc['app_name'],
           'description' => "",
           'keywords' => "",
           'url' => current_url(),
           'type' => "website"
         ];         

        $total_records = $this->CRUDModel->do_count('banners', $get_result_where, $get_result_like);

        $start = ($page-1)*$limit;

        $get_result = ($total_records > 0)?$this->CRUDModel->get_result('banners', $get_result_where, '', $order.' '.$sort, $limit, $start, $get_result_like):false;

        $url = $this->cc['base_url'].'Banners/list?query='.$query.'&order='.$order.'&sort='.$sort.'&limit='.$limit;

        $view_data['pagination'] = ($total_records > 0)?pagination_fnc($get_result, $total_records, $limit, $page, $url):false; 
        
        $view_data['order_list'] = $order_list;
        $view_data['sort_list'] = $sort_list;
        $view_data['limit_list'] = $limit_list;
        $view_data['order'] = $order;
        $view_data['sort'] = $sort;
        $view_data['limit'] = $limit;
        $view_data['query'] = $query;
  
        $view_data['cc'] = $this->cc;

        return view('backend/'.$this->cc['backend_theme'].'/banners_list', $view_data);

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

        $get_row_where = array('banner_id' => $req_id);                    
        $get_row = $this->CRUDModel->get_row('banners', $get_row_where);

        if(!$get_row){

            $alert_data['alert'] = ['type' => 'error', 'message' => "The record id# ".$req_id." was not found"];
             $this->session->set($alert_data);

             return redirect()->to($this->cc['base_url'].'Banners/list');

        }else{

            if($get_row['removable'] != 1){

            $alert_data['alert'] = ['type' => 'error', 'message' => "The record id# ".$req_id." was not removable"];
             $this->session->set($alert_data);

             return redirect()->to($this->cc['base_url'].'Banners/list');

          }else{

        $uploads_path = FCPATH.'public/uploads/';

        $get_row_where_images = array('parent_id' => $req_id, 'parent_type' => 'banners_images');                    
        $get_result_images = $this->CRUDModel->get_result('uploads', $get_row_where_images);

      
        foreach ($get_result_images as $image)
            {

                if(file_exists($uploads_path.$image['upload_file'])) { unlink ($uploads_path.$image['upload_file']);}
                $do_delete_where_image = array('upload_id' => $image['upload_id']);
                $this->CRUDModel->do_delete('uploads', $do_delete_where_image);

            }

        $this->CRUDModel->do_delete('banners', $get_row_where);
            
        $alert_data['alert'] = ['type' => 'success', 'message' => "The record id# ".$req_id." has been deleted successfully"];
        $this->session->set($alert_data);

        return redirect()->to($this->cc['base_url'].'Banners/list');
        }

    }

    }


    public function edit()
    {

        $GLOBALS['HTMLS_CACHE'] = false;

        $user_info = $this->_verify_user_area(1);

        $req_id = $this->request->getGet('id');

        $get_row_where = array('banner_id' => $req_id);                    
        $get_row = $this->CRUDModel->get_row('banners', $get_row_where);

        if(!$get_row){

            $alert_data['alert'] = ['type' => 'error', 'message' => "The requested record id# ".$req_id." was not found"];
             $this->session->set($alert_data);

             return redirect()->to($this->cc['base_url'].'Banners/list');

        }else{

        $get_row_where_images = array('parent_id' => $req_id, 'parent_type' => 'banners_images');                    
        $get_result_images = $this->CRUDModel->get_result('uploads', $get_row_where_images);

        $view_data['form'] = array('id' => $req_id, 'token' => get_token_fnc(16), 'sort_order' => $get_row['sort_order'], 'position' => $get_row['position'], 'title' => $get_row['title'], 'name' => $get_row['name'], 'link' => $get_row['link'], 'description' => $get_row['description'], 'status' => $get_row['status'], 'parent_id' => $get_row['parent_id'], 'parent_type' => $get_row['parent_type'], 'today_views' => $get_row['today_views'], 'lifetime_views' => $get_row['lifetime_views'], 'today_hits' => $get_row['today_hits'], 'lifetime_hits' => $get_row['lifetime_hits'], 'published_year' => date('Y', $get_row['published_time']), 'published_month' => date('n', $get_row['published_time']), 'published_day' => date('j', $get_row['published_time']), 'published_hour' => date('H', $get_row['published_time']), 'published_minute' => date('i', $get_row['published_time']), 'published_second' => date('s', $get_row['published_time']), 'images' => $get_result_images);

        if ($this->request->getMethod() == "POST") {

        if($user_info['role'] == 0){
         $alert_data['alert'] = ['type' => 'error', 'message' => "Authorization failed: You are not permitted to perform this action."];
             $this->session->set($alert_data);
             return redirect()->to($this->cc['base_url'].'Backend');
        }

        $this->validation->setRules([
          'parent_id' => ['label' => 'Parent ID', 'rules' => 'required|trim'],
          'parent_type' => ['label' => 'Parent Type', 'rules' => 'required|trim'],
          'position' => ['label' => 'Position', 'rules' => 'required|trim'],
          'published_year' => ['label' => 'Published Year', 'rules' => 'required|trim'],
          'published_month' => ['label' => 'Published Month', 'rules' => 'required|trim'],
          'published_day' => ['label' => 'Published Day', 'rules' => 'required|trim'],
          'published_hour' => ['label' => 'Published Hour', 'rules' => 'required|trim'],
          'published_minute' => ['label' => 'Published Minute', 'rules' => 'required|trim'],
          'published_second' => ['label' => 'Published Second', 'rules' => 'required|trim'],
          'today_views' => ['label' => 'today_views', 'rules' => 'required|trim|numeric'],
          'lifetime_views' => ['label' => 'lifetime_views', 'rules' => 'required|trim|numeric'],
          'today_hits' => ['label' => 'today_hits', 'rules' => 'required|trim|numeric'],
          'lifetime_hits' => ['label' => 'lifetime_hits', 'rules' => 'required|trim|numeric'],
      ]);
        
        $req_token = $this->request->getPost('token');
        $req_position = $this->request->getPost('position');
        $req_title = $this->request->getPost('title');
        $req_name = $this->request->getPost('name');
        $req_link = $this->request->getPost('link');
        $req_description = $this->request->getPost('description');
        $req_status = (int) ($this->request->getPost('status') ?? 0);
        $req_sort_order = (int) ($this->request->getPost('sort_order') ?? 0);
        $req_parent_id = $this->request->getPost('parent_id');
        $req_parent_type = $this->request->getPost('parent_type');
        $req_published_year = $this->request->getPost('published_year');
        $req_published_month = $this->request->getPost('published_month');
        $req_published_day = $this->request->getPost('published_day');
        $req_published_hour = $this->request->getPost('published_hour');
        $req_published_minute = $this->request->getPost('published_minute');
        $req_published_second = $this->request->getPost('published_second');
        $req_today_views = $this->request->getPost('today_views');
        $req_lifetime_views = $this->request->getPost('lifetime_views');
        $req_today_hits = $this->request->getPost('today_hits');
        $req_lifetime_hits = $this->request->getPost('lifetime_hits');
        

        $view_data['form'] = array('id' => $req_id, 'token' => get_token_fnc(16), 'position' => $req_position, 'sort_order' => $req_sort_order, 'title' => $req_title, 'name' => $req_name, 'link' => $req_link, 'description' => $req_description, 'status' => $req_status, 'parent_id' => $req_parent_id, 'parent_type' => $req_parent_type, 'today_views' => $req_today_views, 'lifetime_views' => $req_lifetime_views, 'today_hits' => $req_today_hits, 'lifetime_hits' => $req_lifetime_hits, 'published_year' => $req_published_year, 'published_month' => $req_published_month, 'published_day' => $req_published_day, 'published_hour' => $req_published_hour, 'published_minute' => $req_published_minute, 'published_second' => $req_published_second,  'images' => $get_result_images);

            if($this->validation->withRequest($this->request)->run() == FALSE){
    
                $alert_data['alert'] = ['type' => 'error', 'message' => $this->validation->listErrors('my_validation_list')];        
                $this->session->set($alert_data);

                }else{

                    $do_count_where = array('token' => $req_token);                    
                    $do_count = $this->CRUDModel->do_count('banners', $do_count_where);

                    if($do_count > 0){
    
                        $alert_data['alert'] = ['type' => 'error', 'message' => 'Duplicate records entry not allowed'];        
                        $this->session->set($alert_data);

                    }else{   


                    $do_update_where = array('banner_id' => $req_id);

                    $var_published_time = "$req_published_year-$req_published_month-$req_published_day $req_published_hour:$req_published_minute:$req_published_second";
                    $var_published_time = datetime_to_unixtimestamp_fnc($var_published_time);

                    $do_update_data =  array('sort_order' => $req_sort_order, 'position' => $req_position, 'title' => $req_title, 'name' => $req_name, 'link' => $req_link, 'description' => $req_description, 'status' => $req_status, 'parent_id' => $req_parent_id, 'parent_type' => $req_parent_type, 'today_views' => $req_today_views, 'lifetime_views' => $req_lifetime_views, 'today_hits' => $req_today_hits, 'lifetime_hits' => $req_lifetime_hits, 'published_time' => $var_published_time, 'token' => $req_token, 'edit_by' => $user_info['user_id'], 'edit_time' => time(), 'edit_ip' => $this->request->getIPAddress());

                   $this->CRUDModel->do_update('banners', $do_update_where, $do_update_data);

                   $uploads_path = FCPATH.'public/uploads/';

                    $req_images = $this->request->getFileMultiple('images');

                    $req_images_sort_order = $this->request->getPost('images_sort_order');

                    $images_sort_order_list = explode(',', $req_images_sort_order);

                    $images_sort_order_list_array = array();

                    foreach ($images_sort_order_list as $list_image)
                    {

                        $images_sort_order_value = substr($list_image, strrpos($list_image, '='), strlen($list_image));
                        $images_sort_order_key = str_replace($images_sort_order_value, '', $list_image);
                        $images_sort_order_value = str_replace('=', '', $images_sort_order_value);
                        $images_sort_order_list_array[$images_sort_order_key] = $images_sort_order_value;

                    }


                    foreach ($get_result_images as $result_image)
                        {

                            if(array_key_exists($result_image['upload_file'], $images_sort_order_list_array)){

                                $var_image_sort_order = $images_sort_order_list_array[$result_image['upload_file']];

                                $do_update_where_result_image = array('upload_id' => $result_image['upload_id']);

                                $do_update_data_result_image =  array('sort_order' => $var_image_sort_order, 'token' => $req_token, 'edit_by' => $user_info['user_id'], 'edit_time' => time(), 'edit_ip' => $this->request->getIPAddress());

                                $this->CRUDModel->do_update('uploads', $do_update_where_result_image, $do_update_data_result_image);

                            }else{

                  if(file_exists($uploads_path.$result_image['upload_file'])) { unlink ($uploads_path.$result_image['upload_file']);}

                  $do_delete_where = array('upload_id' => $result_image['upload_id']);

                  $this->CRUDModel->do_delete('uploads', $do_delete_where);

                            }

                        }

                    $total_images = count($req_images);

                    foreach ($req_images as $image)
                        {

                            if ($image->isValid() && !$image->hasMoved()) {
                                
                            $var_image_name = $image->getName();
                            $var_image_sort_order = $total_images;

                            if(array_key_exists($var_image_name, $images_sort_order_list_array)){
                                $var_image_sort_order = $images_sort_order_list_array[$var_image_name];
                            }

                            $image_new_name = slug_fnc($req_title).'-'.$image->getRandomName();
                            $image->move($uploads_path, $image_new_name);

                            $do_create_data_images =  array('upload_type' => 'image', 'upload_file' => $image_new_name, 'parent_id' => $req_id, 'parent_type' => 'banners_images', 'sort_order' => $var_image_sort_order, 'token' => $req_token, 'add_by' => $user_info['user_id'], 'add_time' => time(), 'add_ip' => $this->request->getIPAddress());

                             $this->CRUDModel->do_create('uploads', $do_create_data_images);

                            }

                        }

    
                            $alert_data['alert'] = ['type' => 'success', 'message' => "The record id# ".$req_id." has been updated successfully"];
                            $this->session->set($alert_data);                

                            return redirect()->to($this->cc['base_url'].'Banners/list');
                        }

                }


        }

        $view_data['page'] = [
            'title' => "Edit | Banners | ".$this->cc['app_name'],
           'description' => "",
           'keywords' => "",
           'url' => current_url(),
           'type' => "website"
         ];  
  
       $view_data['cc'] = $this->cc;

        return view('backend/'.$this->cc['backend_theme'].'/banners_edit', $view_data);

    }

    }


    public function add()
    {

        $GLOBALS['HTMLS_CACHE'] = false;

        $user_info = $this->_verify_user_area(1);

        $var_db_categories = $this->CRUDModel->get_result('categories');

        $view_data['form'] = array('token' => get_token_fnc(16), 'parent_id' => '', 'parent_type' => '', 'position' => '', 'name' => '', 'title' => '', 'link' => '', 'description' => '', 'status' => 1, 'sort_order' => 1, 'published_year' => date('Y'), 'published_month' => date('n'), 'published_day' => date('j'), 'published_hour' => date('H'), 'published_minute' => date('i'), 'published_second' => date('s'));


        if ($this->request->getMethod() == "POST") {

        if($user_info['role'] == 0){
         $alert_data['alert'] = ['type' => 'error', 'message' => "Authorization failed: You are not permitted to perform this action."];
             $this->session->set($alert_data);
             return redirect()->to($this->cc['base_url'].'Backend');
        }

        $this->validation->setRules([
          'parent_id' => ['label' => 'Parent ID', 'rules' => 'required|trim'],
          'parent_type' => ['label' => 'Parent Type', 'rules' => 'required|trim'],
          'position' => ['label' => 'Position', 'rules' => 'required|trim'],
          'published_year' => ['label' => 'Published Year', 'rules' => 'required|trim'],
          'published_month' => ['label' => 'Published Month', 'rules' => 'required|trim'],
          'published_day' => ['label' => 'Published Day', 'rules' => 'required|trim'],
          'published_hour' => ['label' => 'Published Hour', 'rules' => 'required|trim'],
          'published_minute' => ['label' => 'Published Minute', 'rules' => 'required|trim'],
          'published_second' => ['label' => 'Published Second', 'rules' => 'required|trim'],
      ]);
        
        $req_token = $this->request->getPost('token');
        $req_parent_id = $this->request->getPost('parent_id');
        $req_parent_type = $this->request->getPost('parent_type');
        $req_position = $this->request->getPost('position');
        $req_title = $this->request->getPost('title');
        $req_name = $this->request->getPost('name');
        $req_link = $this->request->getPost('link');
        $req_description = $this->request->getPost('description');
        $req_sort_order = (int) ($this->request->getPost('sort_order') ?? 0);
        $req_status = (int) ($this->request->getPost('status') ?? 0);
        $req_published_year = $this->request->getPost('published_year');
        $req_published_month = $this->request->getPost('published_month');
        $req_published_day = $this->request->getPost('published_day');
        $req_published_hour = $this->request->getPost('published_hour');
        $req_published_minute = $this->request->getPost('published_minute');
        $req_published_second = $this->request->getPost('published_second');
        $req_today_views = 99;
        $req_lifetime_views = 999;
        $req_today_hits = 99;
        $req_lifetime_hits = 999;

        $view_data['form'] = array('token' => $req_token, 'parent_id' => $req_parent_id, 'parent_type' => $req_parent_type, 'sort_order' => $req_sort_order, 'position' => $req_position, 'title' => $req_title, 'name' => $req_name, 'link' => $req_link, 'description' => $req_description, 'status' => $req_status, 'published_year' => $req_published_year, 'published_month' => $req_published_month, 'published_day' => $req_published_day, 'published_hour' => $req_published_hour, 'published_minute' => $req_published_minute, 'published_second' => $req_published_second);

            if($this->validation->withRequest($this->request)->run() == FALSE){
    
                $alert_data['alert'] = ['type' => 'error', 'message' => $this->validation->listErrors('my_validation_list')];        
                $this->session->set($alert_data);

                }else{

                    $do_count_where = array('token' => $req_token);                    
                    $do_count = $this->CRUDModel->do_count('banners', $do_count_where);

                    if($do_count > 0){
    
                        $alert_data['alert'] = ['type' => 'error', 'message' => 'Duplicate records entry not allowed'];        
                        $this->session->set($alert_data);

                        }else{

                    $var_published_time = "$req_published_year-$req_published_month-$req_published_day $req_published_hour:$req_published_minute:$req_published_second";
                    $var_published_time = datetime_to_unixtimestamp_fnc($var_published_time);

                    $do_create_data =  array('parent_id' => slug_fnc($req_parent_id), 'parent_type' => slug_fnc($req_parent_type), 'position' => $req_position, 'sort_order' => $req_sort_order, 'title' => $req_title, 'name' => $req_name, 'link' => $req_link, 'description' => $req_description, 'status' => $req_status, 'today_views' => $req_today_views, 'lifetime_views' => $req_lifetime_views, 'today_hits' => $req_today_hits, 'lifetime_hits' => $req_lifetime_hits, 'published_time' => $var_published_time,  'token' => $req_token, 'add_by' => $user_info['user_id'], 'add_time' => time(), 'add_ip' => $this->request->getIPAddress());

                   $do_create_id = $this->CRUDModel->do_create('banners', $do_create_data);

                 

                   $uploads_path = FCPATH.'public/uploads/';

                    $req_images = $this->request->getFileMultiple('images');

                    $req_images_sort_order = $this->request->getPost('images_sort_order');

                    $images_sort_order_list = explode(',', $req_images_sort_order);

                    $images_sort_order_list_array = array();

                    foreach ($images_sort_order_list as $list_image)
                    {

                        $images_sort_order_value = substr($list_image, strrpos($list_image, '='), strlen($list_image));
                        $images_sort_order_key = str_replace($images_sort_order_value, '', $list_image);
                        $images_sort_order_value = str_replace('=', '', $images_sort_order_value);
                        $images_sort_order_list_array[$images_sort_order_key] = $images_sort_order_value;

                    }

                    $total_images = count($req_images);

                    foreach ($req_images as $image)
                        {

                            if ($image->isValid() && !$image->hasMoved()) {
                                
                            $var_image_name = $image->getName();
                            $var_image_sort_order = $total_images;

                            if(array_key_exists($var_image_name, $images_sort_order_list_array)){
                                $var_image_sort_order = $images_sort_order_list_array[$var_image_name];
                            }

                            $image_new_name = slug_fnc($req_title).'-'.$image->getRandomName();
                            $image->move($uploads_path, $image_new_name);

                            $do_create_data_images =  array('upload_type' => 'image', 'upload_file' => $image_new_name, 'parent_id' => $do_create_id, 'parent_type' => 'banners_images', 'sort_order' => $var_image_sort_order, 'token' => $req_token, 'add_by' => $user_info['user_id'], 'add_time' => time(), 'add_ip' => $this->request->getIPAddress());

                             $this->CRUDModel->do_create('uploads', $do_create_data_images);

                            }

                        }
                       
    
                            $alert_data['alert'] = ['type' => 'success', 'message' => "The new record id# ".$do_create_id." has been saved successfully"];
                            $this->session->set($alert_data);   
                            
                            return redirect()->to($this->cc['base_url'].'Banners/list');

                        }

                }


        }

        $view_data['page'] = [
            'title' => "Add | Banners | ".$this->cc['app_name'],
           'description' => "",
           'keywords' => "",
           'url' => current_url(),
           'type' => "website"
         ];  
  
       $view_data['cc'] = $this->cc;

        return view('backend/'.$this->cc['backend_theme'].'/banners_add', $view_data);

    }


    

}


