<?php

namespace App\Controllers;

class Places extends Shonir_Controller
{

    public function __construct() {
        parent::__construct();
    }

    public function index()
    {

        $view_data['page'] = [
            'title' => "Places | ".$this->cc['app_name'],
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

        $order_list = array('place_id' => 'Place ID', 'title' => 'Title', 'name' => 'Name', 'published_time' => 'Published Time', 'today_view' => 'Today View', 'lifetime_view' => 'Lifetime View', 'today_hit' => 'Today Hit', 'lifetime_hit' => 'Lifetime Hit', 'votes' => 'Votes', 'ratings' => 'Ratings', 'add_time' => 'Added Time', 'edit_time' => 'Last Edited Time');
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
            $get_result_like = array("LOWER(slug)" => strtolower($query), "LOWER(name)" => strtolower($query), "LOWER(title)" => strtolower($query), "LOWER(description)" => strtolower($query), "LOWER(spotlight)" => strtolower($query), "LOWER(meta_title)" => strtolower($query), "LOWER(meta_description)" => strtolower($query), "LOWER(meta_keywords)" => strtolower($query));          
         }

        if($limit < $default_limit || $page < 1){
            $alert_data['alert'] = ['type' => 'error', 'message' => "The requested record was not found"];
             $this->session->set($alert_data);
             return redirect()->to($this->cc['base_url'].'Places/list');
           }

        $view_data['page'] = [
            'title' => "List | Places | ".$this->cc['app_name'],
           'description' => "",
           'keywords' => "",
           'url' => current_url(),
           'type' => "website"
         ];         

         $total_records = $this->CRUDModel->do_count('places', $get_result_where, $get_result_like);

        $start = ($page-1)*$limit;

        $get_result = ($total_records > 0)?$this->CRUDModel->get_result('places', $get_result_where, '', $order.' '.$sort, $limit, $start, $get_result_like):false;

        $url = $this->cc['base_url'].'Places/list?query='.$query.'&order='.$order.'&sort='.$sort.'&limit='.$limit;

        $view_data['pagination'] = ($total_records > 0)?pagination_fnc($get_result, $total_records, $limit, $page, $url):false; 
        
        $view_data['order_list'] = $order_list;
        $view_data['sort_list'] = $sort_list;
        $view_data['limit_list'] = $limit_list;
        $view_data['order'] = $order;
        $view_data['sort'] = $sort;
        $view_data['limit'] = $limit;
        $view_data['query'] = $query;
  
        $view_data['cc'] = $this->cc;

        return view('backend/'.$this->cc['backend_theme'].'/places_list', $view_data);

    }

    public function delete()
    {

        $GLOBALS['HTMLS_CACHE'] = false;

        $user_info = $this->_verify_user_area(1);

        $req_id = $this->request->getGet('id');

        $get_row_where = array('place_id' => $req_id);                    
        $get_row = $this->CRUDModel->get_row('places', $get_row_where);

        if(!$get_row){

            $alert_data['alert'] = ['type' => 'error', 'message' => "The record id# ".$req_id." was not found"];
             $this->session->set($alert_data);

             return redirect()->to($this->cc['base_url'].'Places/list');

        }else{

            if($get_row['removable'] != 1){

            $alert_data['alert'] = ['type' => 'error', 'message' => "The record id# ".$req_id." was not removable"];
             $this->session->set($alert_data);

             return redirect()->to($this->cc['base_url'].'Places/list');

          }else{

        $uploads_path = FCPATH.'public/uploads/';

        $get_row_where_images = array('parent_id' => $req_id, 'parent_type' => 'places_images');                    
        $get_result_images = $this->CRUDModel->get_result('uploads', $get_row_where_images);

        $get_row_where_gallery = array('parent_id' => $req_id, 'parent_type' => 'places_gallery');                    
        $get_result_gallery = $this->CRUDModel->get_result('uploads', $get_row_where_gallery);

        foreach ($get_result_images as $image)
            {

                if(file_exists($uploads_path.$image['upload_file'])) { unlink ($uploads_path.$image['upload_file']);}
                $do_delete_where_image = array('upload_id' => $image['upload_id']);
                $this->CRUDModel->do_delete('uploads', $do_delete_where_image);

            }


            foreach ($get_result_gallery as $gallery)
            {

                if(file_exists($uploads_path.$gallery['upload_file'])) { unlink ($uploads_path.$gallery['upload_file']);}
                $do_delete_where_gallery = array('upload_id' => $gallery['upload_id']);
                $this->CRUDModel->do_delete('uploads', $do_delete_where_gallery);

            }

        $this->CRUDModel->do_delete('places', $get_row_where);

        $get_delete_children_items = array('place_id' => $req_id); 
        $this->CRUDModel->do_delete('items_to_places', $get_delete_children_items);
            
        $alert_data['alert'] = ['type' => 'success', 'message' => "The record id# ".$req_id." has been deleted successfully"];
        $this->session->set($alert_data);

        return redirect()->to($this->cc['base_url'].'Places/list');
        }

    }

    }


    public function edit()
    {

        $GLOBALS['HTMLS_CACHE'] = false;

        $user_info = $this->_verify_user_area(1);

        $req_id = $this->request->getGet('id');

        $get_row_where = array('place_id' => $req_id);                    
        $get_row = $this->CRUDModel->get_row('places', $get_row_where);

        if(!$get_row){

            $alert_data['alert'] = ['type' => 'error', 'message' => "The requested record id# ".$req_id." was not found"];
             $this->session->set($alert_data);

             return redirect()->to($this->cc['base_url'].'Places/list');

        }else{

        $get_row_where_images = array('parent_id' => $req_id, 'parent_type' => 'places_images');                    
        $get_result_images = $this->CRUDModel->get_result('uploads', $get_row_where_images);

        $get_row_where_gallery = array('parent_id' => $req_id, 'parent_type' => 'places_gallery');                    
        $get_result_gallery = $this->CRUDModel->get_result('uploads', $get_row_where_gallery);

        $view_data['form'] = array('id' => $req_id, 'token' => get_token_fnc(16), 'slug' => $get_row['slug'], 'title' => $get_row['title'], 'name' => $get_row['name'], 'spotlight' => $get_row['spotlight'], 'description' => $get_row['description'], 'status' => $get_row['status'], 'searchable' => $get_row['searchable'], 'listed' => $get_row['listed'], 'featured' => $get_row['featured'], 'today_views' => $get_row['today_views'], 'lifetime_views' => $get_row['lifetime_views'], 'today_hits' => $get_row['today_hits'], 'lifetime_hits' => $get_row['lifetime_hits'], 'votes' => $get_row['votes'], 'ratings' => $get_row['ratings'], 'scores' => $get_row['scores'], 'likes' => $get_row['likes'], 'top' => $get_row['top'], 'bottom' => $get_row['bottom'], 'published_year' => date('Y', $get_row['published_time']), 'published_month' => date('n', $get_row['published_time']), 'published_day' => date('j', $get_row['published_time']), 'published_hour' => date('H', $get_row['published_time']), 'published_minute' => date('i', $get_row['published_time']), 'published_second' => date('s', $get_row['published_time']), 'meta_title' => $get_row['meta_title'], 'meta_description' => $get_row['meta_description'], 'meta_keywords' => $get_row['meta_keywords'], 'images' => $get_result_images, 'gallery' => $get_result_gallery);

        if ($this->request->getMethod() == "POST") {

        $this->validation->setRules([
          'slug' => ['label' => 'Slug', 'rules' => 'required|trim'],
          'title' => ['label' => 'Title', 'rules' => 'required|trim'],
          'name' => ['label' => 'Name', 'rules' => 'required|trim'],
          'spotlight' => ['label' => 'Spotlight', 'rules' => 'required|trim'],
          'description' => ['label' => 'Description', 'rules' => 'required|trim'],
          'published_year' => ['label' => 'Published Year', 'rules' => 'required|trim'],
          'published_month' => ['label' => 'Published Month', 'rules' => 'required|trim'],
          'published_day' => ['label' => 'Published Day', 'rules' => 'required|trim'],
          'published_hour' => ['label' => 'Published Hour', 'rules' => 'required|trim'],
          'published_minute' => ['label' => 'Published Minute', 'rules' => 'required|trim'],
          'published_second' => ['label' => 'Published Second', 'rules' => 'required|trim'],
          'meta_title' => ['label' => 'Meta Title', 'rules' => 'required|trim'],
          'meta_description' => ['label' => 'Meta Description', 'rules' => 'required|trim'],
          'meta_keywords' => ['label' => 'Meta Keywords', 'rules' => 'required|trim'],
          'today_views' => ['label' => 'today_views', 'rules' => 'required|trim|numeric'],
          'lifetime_views' => ['label' => 'lifetime_views', 'rules' => 'required|trim|numeric'],
          'today_hits' => ['label' => 'today_hits', 'rules' => 'required|trim|numeric'],
          'lifetime_hits' => ['label' => 'lifetime_hits', 'rules' => 'required|trim|numeric'],
          'ratings' => ['label' => 'ratings', 'rules' => 'required|trim|decimal'],
          'scores' => ['label' => 'scores', 'rules' => 'required|trim|decimal'],
          'likes' => ['label' => 'likes', 'rules' => 'required|trim|numeric'],
      ]);
        
        $req_token = $this->request->getPost('token');
        $req_slug = $this->request->getPost('slug');
        $req_title = $this->request->getPost('title');
        $req_name = $this->request->getPost('name');
        $req_spotlight = $this->request->getPost('spotlight');
        $req_description = $this->request->getPost('description');
        $req_status = (int) ($this->request->getPost('status') ?? 0);
        $req_searchable = (int) ($this->request->getPost('searchable') ?? 0);
        $req_listed = (int) ($this->request->getPost('listed') ?? 0);
        $req_featured = (int) ($this->request->getPost('featured') ?? 0);
        $req_top = (int) ($this->request->getPost('top') ?? 0);
        $req_bottom = (int) ($this->request->getPost('bottom') ?? 0);
        $req_published_year = $this->request->getPost('published_year');
        $req_published_month = $this->request->getPost('published_month');
        $req_published_day = $this->request->getPost('published_day');
        $req_published_hour = $this->request->getPost('published_hour');
        $req_published_minute = $this->request->getPost('published_minute');
        $req_published_second = $this->request->getPost('published_second');
        $req_meta_title = $this->request->getPost('meta_title');
        $req_meta_description = $this->request->getPost('meta_description');
        $req_meta_keywords = $this->request->getPost('meta_keywords');
        $req_today_views = $this->request->getPost('today_views');
        $req_lifetime_views = $this->request->getPost('lifetime_views');
        $req_today_hits = $this->request->getPost('today_hits');
        $req_lifetime_hits = $this->request->getPost('lifetime_hits');
        $req_votes = $this->request->getPost('votes');
        $req_ratings = $this->request->getPost('ratings');
        $req_scores = $this->request->getPost('scores');
        $req_likes = $this->request->getPost('likes');

        $view_data['form'] = array('id' => $req_id, 'token' => get_token_fnc(16), 'slug' => $req_slug, 'title' => $req_title, 'name' => $req_name, 'spotlight' => $req_spotlight, 'description' => $req_description, 'status' => $req_status, 'searchable' => $req_searchable, 'listed' => $req_listed, 'featured' => $req_featured, 'top' => $req_top, 'bottom' => $req_bottom, 'today_views' => $req_today_views, 'lifetime_views' => $req_lifetime_views, 'today_hits' => $req_today_hits, 'lifetime_hits' => $req_lifetime_hits, 'votes' => $req_votes, 'ratings' => $req_ratings, 'scores' => $req_scores, 'likes' => $req_likes, 'published_year' => $req_published_year, 'published_month' => $req_published_month, 'published_day' => $req_published_day, 'published_hour' => $req_published_hour, 'published_minute' => $req_published_minute, 'published_second' => $req_published_second, 'meta_title' => $req_meta_title, 'meta_description' => $req_meta_description, 'meta_keywords' => $req_meta_keywords, 'images' => $get_result_images, 'gallery' => $get_result_gallery);

            if($this->validation->withRequest($this->request)->run() == FALSE){
    
                $alert_data['alert'] = ['type' => 'error', 'message' => $this->validation->listErrors('my_validation_list')];        
                $this->session->set($alert_data);

                }else{

                    $do_count_where = array('token' => $req_token);                    
                    $do_count = $this->CRUDModel->do_count('places', $do_count_where);

                    if($do_count > 0){
    
                        $alert_data['alert'] = ['type' => 'error', 'message' => 'Duplicate records entry not allowed'];        
                        $this->session->set($alert_data);

                    }else{   

                    $do_update_where = array('place_id' => $req_id);

                    $var_published_time = "$req_published_year-$req_published_month-$req_published_day $req_published_hour:$req_published_minute:$req_published_second";
                    $var_published_time = datetime_to_unixtimestamp_fnc($var_published_time);

                    $do_update_data =  array('slug' => slug_fnc($req_slug), 'title' => $req_title, 'name' => $req_name, 'spotlight' => $req_spotlight, 'description' => $req_description, 'status' => $req_status, 'searchable' => $req_searchable, 'today_views' => $req_today_views, 'lifetime_views' => $req_lifetime_views, 'today_hits' => $req_today_hits, 'lifetime_hits' => $req_lifetime_hits, 'votes' => $req_votes, 'ratings' => $req_ratings, 'scores' => $req_scores, 'likes' => $req_likes, 'listed' => $req_listed, 'featured' => $req_featured, 'top' => $req_top, 'bottom' => $req_bottom, 'published_time' => $var_published_time, 'meta_title' => $req_meta_title, 'meta_description' => $req_meta_description, 'meta_keywords' => $req_meta_keywords, 'token' => $req_token, 'edit_by' => $user_info['user_id'], 'edit_time' => time(), 'edit_ip' => $this->request->getIPAddress());

                   $this->CRUDModel->do_update('places', $do_update_where, $do_update_data);

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

                            $do_create_data_images =  array('upload_type' => 'image', 'upload_file' => $image_new_name, 'parent_id' => $req_id, 'parent_type' => 'places_images', 'sort_order' => $var_image_sort_order, 'token' => $req_token, 'add_by' => $user_info['user_id'], 'add_time' => time(), 'add_ip' => $this->request->getIPAddress());

                             $this->CRUDModel->do_create('uploads', $do_create_data_images);

                            }

                        }

                        $req_gallery = $this->request->getFileMultiple('gallery');

                        $req_gallery_sort_order = $this->request->getPost('gallery_sort_order');
    
                        $gallery_sort_order_list = explode(',', $req_gallery_sort_order);
    
                        $gallery_sort_order_list_array = array();
    
                        foreach ($gallery_sort_order_list as $list_gallery)
                        {
    
                            $gallery_sort_order_value = substr($list_gallery, strrpos($list_gallery, '='), strlen($list_gallery));
                            $gallery_sort_order_key = str_replace($gallery_sort_order_value, '', $list_gallery);
                            $gallery_sort_order_value = str_replace('=', '', $gallery_sort_order_value);
                            $gallery_sort_order_list_array[$gallery_sort_order_key] = $gallery_sort_order_value;
    
                        }


                        foreach ($get_result_gallery as $result_gallery)
                        {

                            if(array_key_exists($result_gallery['upload_file'], $gallery_sort_order_list_array)){

                                $var_gallery_sort_order = $gallery_sort_order_list_array[$result_gallery['upload_file']];

                                $do_update_where_result_gallery = array('upload_id' => $result_gallery['upload_id']);

                                $do_update_data_result_gallery =  array('sort_order' => $var_gallery_sort_order, 'token' => $req_token, 'edit_by' => $user_info['user_id'], 'edit_time' => time(), 'edit_ip' => $this->request->getIPAddress());

                                $this->CRUDModel->do_update('uploads', $do_update_where_result_gallery, $do_update_data_result_gallery);

                            }else{

                  if(file_exists($uploads_path.$result_gallery['upload_file'])) { unlink ($uploads_path.$result_gallery['upload_file']);}

                  $do_delete_where = array('upload_id' => $result_gallery['upload_id']);

                  $this->CRUDModel->do_delete('uploads', $do_delete_where);

                            }

                        }
    
                        $total_gallery = count($req_gallery);
    
                        foreach ($req_gallery as $gallery)
                            {
    
                                if ($gallery->isValid() && !$gallery->hasMoved()) {
                                    
                                $var_gallery_name = $gallery->getName();
                                $var_gallery_sort_order = $total_gallery;
    
                                if(array_key_exists($var_gallery_name, $gallery_sort_order_list_array)){
                                    $var_gallery_sort_order = $gallery_sort_order_list_array[$var_gallery_name];
                                }
    
                                $gallery_new_name = slug_fnc($req_title).'-'.$gallery->getRandomName();
                                $gallery->move($uploads_path, $gallery_new_name);

                                $do_create_data_gallery =  array('upload_type' => 'image', 'upload_file' => $gallery_new_name, 'parent_id' => $req_id, 'parent_type' => 'places_gallery', 'sort_order' => $var_gallery_sort_order, 'token' => $req_token, 'add_by' => $user_info['user_id'], 'add_time' => time(), 'add_ip' => $this->request->getIPAddress());

                             $this->CRUDModel->do_create('uploads', $do_create_data_gallery);

    
                                }
    
                            }
    
                            $alert_data['alert'] = ['type' => 'success', 'message' => "The record id# ".$req_id." has been updated successfully"];
                            $this->session->set($alert_data);                

                            return redirect()->to($this->cc['base_url'].'Places/list');
                        }

                }


        }

        $view_data['page'] = [
            'title' => "Edit | Places | ".$this->cc['app_name'],
           'description' => "",
           'keywords' => "",
           'url' => current_url(),
           'type' => "website"
         ];  
  
       $view_data['cc'] = $this->cc;

        return view('backend/'.$this->cc['backend_theme'].'/places_edit', $view_data);

    }

    }


    public function add()
    {

        $GLOBALS['HTMLS_CACHE'] = false;

        $user_info = $this->_verify_user_area(1);

        $view_data['form'] = array('token' => get_token_fnc(16), 'slug' => '', 'name' => '', 'title' => '', 'spotlight' => '', 'description' => '', 'status' => 1, 'searchable' => 1, 'listed' => 1, 'featured' => 0, 'top' => 0, 'bottom' => 0, 'published_year' => date('Y'), 'published_month' => date('n'), 'published_day' => date('j'), 'published_hour' => date('H'), 'published_minute' => date('i'), 'published_second' => date('s'), 'meta_title' => '', 'meta_description' => '', 'meta_keywords' => '');


        if ($this->request->getMethod() == "POST") {

        $this->validation->setRules([
          'slug' => ['label' => 'Slug', 'rules' => 'required|trim'],
          'title' => ['label' => 'Title', 'rules' => 'required|trim'],
          'name' => ['label' => 'Name', 'rules' => 'required|trim'],
          'spotlight' => ['label' => 'Spotlight', 'rules' => 'required|trim'],
          'description' => ['label' => 'Description', 'rules' => 'required|trim'],
          'published_year' => ['label' => 'Published Year', 'rules' => 'required|trim'],
          'published_month' => ['label' => 'Published Month', 'rules' => 'required|trim'],
          'published_day' => ['label' => 'Published Day', 'rules' => 'required|trim'],
          'published_hour' => ['label' => 'Published Hour', 'rules' => 'required|trim'],
          'published_minute' => ['label' => 'Published Minute', 'rules' => 'required|trim'],
          'published_second' => ['label' => 'Published Second', 'rules' => 'required|trim'],
          'meta_title' => ['label' => 'Meta Title', 'rules' => 'required|trim'],
          'meta_description' => ['label' => 'Meta Description', 'rules' => 'required|trim'],
          'meta_keywords' => ['label' => 'Meta Keywords', 'rules' => 'required|trim'],
      ]);
        
        $req_token = $this->request->getPost('token');
        $req_slug = $this->request->getPost('slug');
        $req_title = $this->request->getPost('title');
        $req_name = $this->request->getPost('name');
        $req_spotlight = $this->request->getPost('spotlight');
        $req_description = $this->request->getPost('description');
        $req_status = (int) ($this->request->getPost('status') ?? 0);
        $req_searchable = (int) ($this->request->getPost('searchable') ?? 0);
        $req_listed = (int) ($this->request->getPost('listed') ?? 0);
        $req_featured = (int) ($this->request->getPost('featured') ?? 0);
        $req_top = (int) ($this->request->getPost('top') ?? 0);
        $req_bottom = (int) ($this->request->getPost('bottom') ?? 0);
        $req_published_year = $this->request->getPost('published_year');
        $req_published_month = $this->request->getPost('published_month');
        $req_published_day = $this->request->getPost('published_day');
        $req_published_hour = $this->request->getPost('published_hour');
        $req_published_minute = $this->request->getPost('published_minute');
        $req_published_second = $this->request->getPost('published_second');
        $req_meta_title = $this->request->getPost('meta_title');
        $req_meta_description = $this->request->getPost('meta_description');
        $req_meta_keywords = $this->request->getPost('meta_keywords');

        $view_data['form'] = array('token' => $req_token, 'slug' => $req_slug, 'title' => $req_title, 'name' => $req_name, 'spotlight' => $req_spotlight, 'description' => $req_description, 'status' => $req_status, 'searchable' => $req_searchable, 'listed' => $req_listed, 'featured' => $req_featured, 'top' => $req_top, 'bottom' => $req_bottom, 'published_year' => $req_published_year, 'published_month' => $req_published_month, 'published_day' => $req_published_day, 'published_hour' => $req_published_hour, 'published_minute' => $req_published_minute, 'published_second' => $req_published_second, 'meta_title' => $req_meta_title, 'meta_description' => $req_meta_description, 'meta_keywords' => $req_meta_keywords);

            if($this->validation->withRequest($this->request)->run() == FALSE){
    
                $alert_data['alert'] = ['type' => 'error', 'message' => $this->validation->listErrors('my_validation_list')];        
                $this->session->set($alert_data);

                }else{

                    $do_count_where = array('token' => $req_token);                    
                    $do_count = $this->CRUDModel->do_count('places', $do_count_where);

                    if($do_count > 0){
    
                        $alert_data['alert'] = ['type' => 'error', 'message' => 'Duplicate records entry not allowed'];        
                        $this->session->set($alert_data);

                        }else{

                    $var_published_time = "$req_published_year-$req_published_month-$req_published_day $req_published_hour:$req_published_minute:$req_published_second";
                    $var_published_time = datetime_to_unixtimestamp_fnc($var_published_time);

                    $do_create_data =  array('slug' => slug_fnc($req_slug), 'title' => $req_title, 'name' => $req_name, 'spotlight' => $req_spotlight, 'description' => $req_description, 'status' => $req_status, 'searchable' => $req_searchable, 'listed' => $req_listed, 'featured' => $req_featured, 'top' => $req_top, 'bottom' => $req_bottom, 'published_time' => $var_published_time, 'meta_title' => $req_meta_title, 'meta_description' => $req_meta_description, 'meta_keywords' => $req_meta_keywords, 'token' => $req_token, 'add_by' => $user_info['user_id'], 'add_time' => time(), 'add_ip' => $this->request->getIPAddress());

                   $do_create_id = $this->CRUDModel->do_create('places', $do_create_data);

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

                            $do_create_data_images =  array('upload_type' => 'image', 'upload_file' => $image_new_name, 'parent_id' => $do_create_id, 'parent_type' => 'places_images', 'sort_order' => $var_image_sort_order, 'token' => $req_token, 'add_by' => $user_info['user_id'], 'add_time' => time(), 'add_ip' => $this->request->getIPAddress());

                             $this->CRUDModel->do_create('uploads', $do_create_data_images);

                            }

                        }

                        $req_gallery = $this->request->getFileMultiple('gallery');

                        $req_gallery_sort_order = $this->request->getPost('gallery_sort_order');
    
                        $gallery_sort_order_list = explode(',', $req_gallery_sort_order);
    
                        $gallery_sort_order_list_array = array();
    
                        foreach ($gallery_sort_order_list as $list_gallery)
                        {
    
                            $gallery_sort_order_value = substr($list_gallery, strrpos($list_gallery, '='), strlen($list_gallery));
                            $gallery_sort_order_key = str_replace($gallery_sort_order_value, '', $list_gallery);
                            $gallery_sort_order_value = str_replace('=', '', $gallery_sort_order_value);
                            $gallery_sort_order_list_array[$gallery_sort_order_key] = $gallery_sort_order_value;
    
                        }
    
                        $total_gallery = count($req_gallery);
    
                        foreach ($req_gallery as $gallery)
                            {
    
                                if ($gallery->isValid() && !$gallery->hasMoved()) {
                                    
                                $var_gallery_name = $gallery->getName();
                                $var_gallery_sort_order = $total_gallery;
    
                                if(array_key_exists($var_gallery_name, $gallery_sort_order_list_array)){
                                    $var_gallery_sort_order = $gallery_sort_order_list_array[$var_gallery_name];
                                }
    
                                $gallery_new_name = slug_fnc($req_title).'-'.$gallery->getRandomName();
                                $gallery->move($uploads_path, $gallery_new_name);

                                $do_create_data_gallery =  array('upload_type' => 'image', 'upload_file' => $gallery_new_name, 'parent_id' => $do_create_id, 'parent_type' => 'places_gallery', 'sort_order' => $var_gallery_sort_order, 'token' => $req_token, 'add_by' => $user_info['user_id'], 'add_time' => time(), 'add_ip' => $this->request->getIPAddress());

                             $this->CRUDModel->do_create('uploads', $do_create_data_gallery);

    
                                }
    
                            }
    
                            $alert_data['alert'] = ['type' => 'success', 'message' => "The new record id# ".$do_create_id." has been saved successfully"];
                            $this->session->set($alert_data);   
                            
                            return redirect()->to($this->cc['base_url'].'Places/list');

                        }

                }


        }

        $view_data['page'] = [
            'title' => "Add | Places | ".$this->cc['app_name'],
           'description' => "",
           'keywords' => "",
           'url' => current_url(),
           'type' => "website"
         ];  
  
       $view_data['cc'] = $this->cc;

        return view('backend/'.$this->cc['backend_theme'].'/places_add', $view_data);

    }


    

}