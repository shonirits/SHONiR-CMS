<?php

namespace App\Controllers;

class Links extends Shonir_Controller
{

    public function __construct() {
        parent::__construct();
    }

    public function index()
    {

        $view_data['page'] = [
            'title' => "Links | ".$this->cc['app_name'],
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

        $order_list = array('link_id' => 'Link ID', 'category_id' => 'Category', 'parent_type' => 'Parent Type', 'host_id' => 'Host', 'type_id' => 'Link Type', 'url' => 'URL', 'quality_id' => 'Quality', 'duration' => 'Duration', 'file_size' => 'File Size', 'part_id' => 'Part Type', 'part' => 'Part', 'public_id' => 'Public ID', 'published_time' => 'Published Time', 'today_view' => 'Today View', 'lifetime_view' => 'Lifetime View', 'today_hit' => 'Today Hit', 'lifetime_hit' => 'Lifetime Hit', 'votes' => 'Votes', 'ratings' => 'Ratings', 'add_time' => 'Added Time', 'edit_time' => 'Last Edited Time');
        if(!array_key_exists($order, $order_list)){
            $order = 'add_time';
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
            $get_result_like = array("LOWER(link_id)" => strtolower($query), "LOWER(parent_id)" => strtolower($query), "LOWER(url)" => strtolower($query), "LOWER(duration)" => strtolower($query), "LOWER(file_size)" => strtolower($query), "LOWER(part)" => strtolower($query), "LOWER(public_id)" => strtolower($query));          
         }

        if($limit < $default_limit || $page < 1){
            $alert_data['alert'] = ['type' => 'error', 'message' => "The requested record was not found"];
             $this->session->set($alert_data);
             return redirect()->to($this->cc['base_url'].'Links/list');
           }

        $view_data['page'] = [
            'title' => "List | Links | ".$this->cc['app_name'],
           'description' => "",
           'keywords' => "",
           'url' => current_url(),
           'type' => "website"
         ];         

         $total_records = $this->CRUDModel->do_count('links', $get_result_where, $get_result_like);

        $start = ($page-1)*$limit;

        $get_result = ($total_records > 0)?$this->CRUDModel->get_result('links', $get_result_where, '', $order.' '.$sort, $limit, $start, $get_result_like):false;

        if($total_records > 0){

            $parent_map = parent_map_fnc();

        foreach ($get_result as &$row) {
            $ptype = $row['parent_type'] ?? '';
            $pid   = $row['parent_id'] ?? 0;

            if (isset($parent_map[$ptype])) {
                $cfg = $parent_map[$ptype];

                $parent_row = $this->CRUDModel->get_row(
                    $cfg['table'],
                    [$cfg['id'] => $pid],
                    "{$cfg['id']}, {$cfg['name']}"
                );

                $row['name'] = $parent_row[$cfg['name']] ?? '— Unknown —';
            } else {
                $row['name'] = '— Invalid Type —';
            }
        }

    }

        $url = $this->cc['base_url'].'Links/list?query='.$query.'&order='.$order.'&sort='.$sort.'&limit='.$limit;

        $view_data['pagination'] = ($total_records > 0)?pagination_fnc($get_result, $total_records, $limit, $page, $url):false; 
        
        $view_data['order_list'] = $order_list;
        $view_data['sort_list'] = $sort_list;
        $view_data['limit_list'] = $limit_list;
        $view_data['order'] = $order;
        $view_data['sort'] = $sort;
        $view_data['limit'] = $limit;
        $view_data['query'] = $query;
  
        $view_data['cc'] = $this->cc;

        return view('backend/'.$this->cc['backend_theme'].'/links_list', $view_data);

    }

    public function delete()
    {

        $GLOBALS['HTMLS_CACHE'] = false;

        $user_info = $this->_verify_user_area(1);

        $req_id = $this->request->getGet('id');

        $get_row_where = array('link_id' => $req_id);                    
        $get_row = $this->CRUDModel->get_row('links', $get_row_where);

        if(!$get_row){

            $alert_data['alert'] = ['type' => 'error', 'message' => "The record id# ".$req_id." was not found"];
             $this->session->set($alert_data);

             return redirect()->to($this->cc['base_url'].'Links/list');

        }else{

            if($get_row['removable'] != 1){

            $alert_data['alert'] = ['type' => 'error', 'message' => "The record id# ".$req_id." was not removable"];
             $this->session->set($alert_data);

             return redirect()->to($this->cc['base_url'].'Links/list');

          }else{      

        $this->CRUDModel->do_delete('links', $get_row_where);
            
        $alert_data['alert'] = ['type' => 'success', 'message' => "The record id# ".$req_id." has been deleted successfully"];
        $this->session->set($alert_data);

        return redirect()->to($this->cc['base_url'].'Links/list');

        }

    }

    }


    public function edit()
    {

        $GLOBALS['HTMLS_CACHE'] = false;

        $user_info = $this->_verify_user_area(1);

        $req_id = $this->request->getGet('id');

        $type_list = link_types_fnc('', 'id_as_key');

        $get_row_where = array('link_id' => $req_id);                    
        $get_row = $this->CRUDModel->get_row('links', $get_row_where);

        if(!$get_row){

            $alert_data['alert'] = ['type' => 'error', 'message' => "The requested record id# ".$req_id." was not found"];
             $this->session->set($alert_data);

             return redirect()->to($this->cc['base_url'].'Links/list');

        }else{

        $link_types_list = link_types_fnc();
        $link_categories_list = link_categories_fnc();
        $parent_types_list = ['items' => 'Item'];
        $part_types_list = part_types_fnc();
        $host_types_list = host_types_fnc('', 'id_and_name');
        $quality_types_list = quality_types_fnc();
        $parent_list = [];

        $parent_map = parent_map_fnc();

        if ($get_row['parent_id']) {    

            if (isset($parent_map[$get_row['parent_type']])) {
                $cfg = $parent_map[$get_row['parent_type']];

                $row = $this->CRUDModel->get_row(
                    $cfg['table'],
                    [$cfg['id'] => $get_row['parent_id']],
                    "{$cfg['id']}, {$cfg['name']}"
                );

                if ($row) {
                    $parent_list = [
                        $row[$cfg['id']] => $row[$cfg['name']]
                    ];
                }
            }
        }

        $view_data['form'] = array('id' => $req_id, 'token' => get_token_fnc(16), 'category_id' => $get_row['category_id'], 'parent_type' => $get_row['parent_type'], 'parent_id' => $get_row['parent_id'], 'host_id' => $get_row['host_id'], 'type_id' => $get_row['type_id'], 'url' => $get_row['url'], 'quality_id' => $get_row['quality_id'], 'duration' => $get_row['duration'], 'file_size' => $get_row['file_size'], 'part_id' => $get_row['part_id'], 'part' => $get_row['part'], 'public_id' => $get_row['public_id'], 'status' => $get_row['status'], 'sort_order' => $get_row['sort_order'], 'published_year' => date('Y', $get_row['published_time']), 'published_month' => date('n', $get_row['published_time']), 'published_day' => date('j', $get_row['published_time']), 'published_hour' => date('H', $get_row['published_time']), 'published_minute' => date('i', $get_row['published_time']), 'published_second' => date('s', $get_row['published_time']), 'link_categories_list' => $link_categories_list, 'parent_types_list' => $parent_types_list, 'parent_list' => $parent_list, 'host_types_list' => $host_types_list, 'link_types_list' => $link_types_list,  'quality_types_list' => $quality_types_list, 'part_types_list' => $part_types_list, 'today_views' => $get_row['today_views'], 'lifetime_views' => $get_row['lifetime_views'], 'today_hits' => $get_row['today_hits'], 'lifetime_hits' => $get_row['lifetime_hits'], 'votes' => $get_row['votes'], 'ratings' => $get_row['ratings'], 'scores' => $get_row['scores'], 'likes' => $get_row['likes']);

        if ($this->request->getMethod() == "POST") {
            
        $req_parent_type = $this->request->getPost('parent_type');
        $req_parent_id = $this->request->getPost($req_parent_type);

        $this->validation->setRules([
          'category_id' => ['label' => 'Link Category', 'rules' => 'required|trim'],
          'parent_type' => ['label' => 'Parent Type', 'rules' => 'required|trim'],
          $req_parent_type => ['label' => 'Parent', 'rules' => 'required|trim'],
          'host_id' => ['label' => 'Host', 'rules' => 'required|trim'],
          'type_id' => ['label' => 'Link Type', 'rules' => 'required|trim'],
          'url' => ['label' => 'URL', 'rules' => 'required|trim'],
          'quality_id' => ['label' => 'Quality', 'rules' => 'required|trim'],
          'duration' => ['label' => 'Duration', 'rules' => 'required|trim'],
          'file_size' => ['label' => 'File Size', 'rules' => 'required|trim'],
          'part_id' => ['label' => 'Part Type', 'rules' => 'required|trim'],
          'part' => ['label' => 'Part', 'rules' => 'required|trim'],
          'public_id' => ['label' => 'Public ID', 'rules' => 'required|trim'],
          'sort_order' => ['label' => 'Sort Order', 'rules' => 'required|trim'],
          'published_year' => ['label' => 'Published Year', 'rules' => 'required|trim'],
          'published_month' => ['label' => 'Published Month', 'rules' => 'required|trim'],
          'published_day' => ['label' => 'Published Day', 'rules' => 'required|trim'],
          'published_hour' => ['label' => 'Published Hour', 'rules' => 'required|trim'],
          'published_minute' => ['label' => 'Published Minute', 'rules' => 'required|trim'],
          'published_second' => ['label' => 'Published Second', 'rules' => 'required|trim'],
          'today_views' => ['label' => 'Today Views', 'rules' => 'required|trim|numeric'],
          'lifetime_views' => ['label' => 'Lifetime Views', 'rules' => 'required|trim|numeric'],
          'today_hits' => ['label' => 'Today Hits', 'rules' => 'required|trim|numeric'],
          'lifetime_hits' => ['label' => 'Lifetime Hits', 'rules' => 'required|trim|numeric'],
          'ratings' => ['label' => 'Ratings', 'rules' => 'required|trim|decimal'],
          'votes' => ['label' => 'Votes', 'rules' => 'required|trim|numeric'],
          'scores' => ['label' => 'Scores', 'rules' => 'required|trim|decimal'],
          'likes' => ['label' => 'Likes', 'rules' => 'required|trim|numeric'],
      ]);
        
        $req_token = $this->request->getPost('token');
        $req_category_id = (int) ($this->request->getPost('category_id') ?? 0);
        $req_host_id = (int) ($this->request->getPost('host_id') ?? 0);
        $req_type_id = (int) ($this->request->getPost('type_id') ?? 0);
        $req_url = $this->request->getPost('url');
        $req_quality_id = (int) ($this->request->getPost('quality_id') ?? 0);
        $req_duration = $this->request->getPost('duration');
        $req_file_size = $this->request->getPost('file_size');
        $req_part_id = (int) ($this->request->getPost('part_id') ?? 0);
        $req_part = $this->request->getPost('part');
        $req_public_id = $this->request->getPost('public_id');
        $req_status = (int) ($this->request->getPost('status') ?? 0);        
        $req_sort_order = (int) ($this->request->getPost('sort_order') ?? 0);
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
        $req_votes = $this->request->getPost('votes');
        $req_ratings = $this->request->getPost('ratings');
        $req_scores = $this->request->getPost('scores');
        $req_likes = $this->request->getPost('likes');


        if ($req_parent_id) {    

            if (isset($parent_map[$req_parent_type])) {
                $cfg = $parent_map[$req_parent_type];

                $row = $this->CRUDModel->get_row(
                    $cfg['table'],
                    [$cfg['id'] => $req_parent_id],
                    "{$cfg['id']}, {$cfg['name']}"
                );

                if ($row) {
                    $parent_list = [
                        $row[$cfg['id']] => $row[$cfg['name']]
                    ];
                }
            }
        }

        $view_data['form'] = array('id' => $req_id, 'token' => get_token_fnc(16), 'category_id' => $req_category_id, 'parent_type' => $req_parent_type, 'parent_id' => $req_parent_id, 'host_id' => $req_host_id, 'type_id' => $req_type_id, 'url' => $req_url, 'quality_id' => $req_quality_id, 'duration' => $req_duration, 'file_size' => $req_file_size, 'part_id' => $req_part_id, 'part' => $req_part, 'public_id' => $req_public_id, 'status' => $req_status, 'sort_order' => $req_sort_order, 'published_year' => $req_published_year, 'published_month' => $req_published_month, 'published_day' => $req_published_day, 'published_hour' => $req_published_hour, 'published_minute' => $req_published_minute, 'published_second' => $req_published_second, 'link_categories_list' => $link_categories_list, 'parent_types_list' => $parent_types_list, 'parent_list' => $parent_list, 'host_types_list' => $host_types_list, 'link_types_list' => $link_types_list,  'quality_types_list' => $quality_types_list, 'part_types_list' => $part_types_list, 'today_views' => $req_today_views, 'lifetime_views' => $req_lifetime_views, 'today_hits' => $req_today_hits, 'lifetime_hits' => $req_lifetime_hits, 'votes' => $req_votes, 'ratings' => $req_ratings, 'scores' => $req_scores, 'likes' => $req_likes);

            if($this->validation->withRequest($this->request)->run() == FALSE){
    
                $alert_data['alert'] = ['type' => 'error', 'message' => $this->validation->listErrors('my_validation_list')];        
                $this->session->set($alert_data);

                }else{

                    $do_count_where = array('token' => $req_token);                    
                    $do_count = $this->CRUDModel->do_count('links', $do_count_where);

                    if($do_count > 0){
    
                        $alert_data['alert'] = ['type' => 'error', 'message' => 'Duplicate records entry not allowed'];        
                        $this->session->set($alert_data);

                    }else{   

                    $do_update_where = array('link_id' => $req_id);

                    $var_published_time = "$req_published_year-$req_published_month-$req_published_day $req_published_hour:$req_published_minute:$req_published_second";
                    $var_published_time = datetime_to_unixtimestamp_fnc($var_published_time);

                    $do_update_data =  array('category_id' => $req_category_id, 'parent_type' => $req_parent_type, 'parent_id' => $req_parent_id, 'host_id' => $req_host_id, 'type_id' => $req_type_id, 'url' => $req_url, 'quality_id' => $req_quality_id, 'duration' => $req_duration, 'file_size' => $req_file_size, 'part_id' => $req_part_id, 'part' => $req_part, 'public_id' => $req_public_id, 'status' => $req_status, 'sort_order' => $req_sort_order, 'published_time' => $var_published_time, 'today_views' => $req_today_views, 'lifetime_views' => $req_lifetime_views, 'today_hits' => $req_today_hits, 'lifetime_hits' => $req_lifetime_hits, 'votes' => $req_votes, 'ratings' => $req_ratings, 'scores' => $req_scores, 'likes' => $req_likes, 'token' => $req_token, 'edit_by' => $user_info['user_id'], 'edit_time' => time(), 'edit_ip' => $this->request->getIPAddress());

                   $this->CRUDModel->do_update('links', $do_update_where, $do_update_data);                                
    
                            $alert_data['alert'] = ['type' => 'success', 'message' => "The record id# ".$req_id." has been updated successfully"];
                            $this->session->set($alert_data);                

                            return redirect()->to($this->cc['base_url'].'Links/list');
                        }

                }


        }

        $view_data['page'] = [
            'title' => "Edit | Links | ".$this->cc['app_name'],
           'description' => "",
           'keywords' => "",
           'url' => current_url(),
           'type' => "website"
         ];  
  
       $view_data['cc'] = $this->cc;

        return view('backend/'.$this->cc['backend_theme'].'/links_edit', $view_data);

    }

    }


    public function add()
    {

        $GLOBALS['HTMLS_CACHE'] = false;

        $user_info = $this->_verify_user_area(1);

        $link_types_list = link_types_fnc();
        $link_categories_list = link_categories_fnc();
        $parent_types_list = ['items' => 'Item'];
        $part_types_list = part_types_fnc();
        $host_types_list = host_types_fnc('', 'id_and_name');
        $quality_types_list = quality_types_fnc();
        $parent_list = [];

        $view_data['form'] = array('token' => get_token_fnc(16), 'category_id' => '', 'parent_type' => '', 'parent_id' => '', 'host_id' => '', 'type_id' => '', 'url' => '', 'quality_id' => '', 'duration' => '', 'file_size' => '', 'part_id' => '', 'part' => '', 'public_id' => get_token_fnc(32), 'status' => 1, 'sort_order' => '', 'published_year' => date('Y'), 'published_month' => date('n'), 'published_day' => date('j'), 'published_hour' => date('H'), 'published_minute' => date('i'), 'published_second' => date('s'), 'link_categories_list' => $link_categories_list, 'parent_types_list' => $parent_types_list, 'parent_list' => $parent_list, 'host_types_list' => $host_types_list, 'link_types_list' => $link_types_list,  'quality_types_list' => $quality_types_list, 'part_types_list' => $part_types_list);

        if ($this->request->getMethod() == "POST") {

        $req_parent_type = $this->request->getPost('parent_type');
        $req_parent_id = $this->request->getPost($req_parent_type);

        $this->validation->setRules([
          'category_id' => ['label' => 'Link Category', 'rules' => 'required|trim'],
          'parent_type' => ['label' => 'Parent Type', 'rules' => 'required|trim'],
          $req_parent_type => ['label' => 'Parent', 'rules' => 'required|trim'],
          'host_id' => ['label' => 'Host', 'rules' => 'required|trim'],
          'type_id' => ['label' => 'Link Type', 'rules' => 'required|trim'],
          'url' => ['label' => 'URL', 'rules' => 'required|trim'],
          'quality_id' => ['label' => 'Quality', 'rules' => 'required|trim'],
          'duration' => ['label' => 'Duration', 'rules' => 'required|trim'],
          'file_size' => ['label' => 'File Size', 'rules' => 'required|trim'],
          'part_id' => ['label' => 'Part Type', 'rules' => 'required|trim'],
          'part' => ['label' => 'Part', 'rules' => 'required|trim'],
          'public_id' => ['label' => 'Public ID', 'rules' => 'required|trim'],
          'sort_order' => ['label' => 'Sort Order', 'rules' => 'required|trim'],
          'published_year' => ['label' => 'Published Year', 'rules' => 'required|trim'],
          'published_month' => ['label' => 'Published Month', 'rules' => 'required|trim'],
          'published_day' => ['label' => 'Published Day', 'rules' => 'required|trim'],
          'published_hour' => ['label' => 'Published Hour', 'rules' => 'required|trim'],
          'published_minute' => ['label' => 'Published Minute', 'rules' => 'required|trim'],
          'published_second' => ['label' => 'Published Second', 'rules' => 'required|trim'],
      ]);
        
        $req_token = $this->request->getPost('token');
        $req_category_id = (int) ($this->request->getPost('category_id') ?? 0);
        $req_host_id = (int) ($this->request->getPost('host_id') ?? 0);
        $req_type_id = (int) ($this->request->getPost('type_id') ?? 0);
        $req_url = $this->request->getPost('url');
        $req_quality_id = (int) ($this->request->getPost('quality_id') ?? 0);
        $req_duration = $this->request->getPost('duration');
        $req_file_size = $this->request->getPost('file_size');
        $req_part_id = (int) ($this->request->getPost('part_id') ?? 0);
        $req_part = $this->request->getPost('part');
        $req_public_id = $this->request->getPost('public_id');
        $req_status = (int) ($this->request->getPost('status') ?? 0);        
        $req_sort_order = (int) ($this->request->getPost('sort_order') ?? 0);
        $req_published_year = $this->request->getPost('published_year');
        $req_published_month = $this->request->getPost('published_month');
        $req_published_day = $this->request->getPost('published_day');
        $req_published_hour = $this->request->getPost('published_hour');
        $req_published_minute = $this->request->getPost('published_minute');
        $req_published_second = $this->request->getPost('published_second');

        $parent_map = parent_map_fnc();

        if ($req_parent_id) {    

            if (isset($parent_map[$req_parent_type])) {
                $cfg = $parent_map[$req_parent_type];

                $row = $this->CRUDModel->get_row(
                    $cfg['table'],
                    [$cfg['id'] => $req_parent_id],
                    "{$cfg['id']}, {$cfg['name']}"
                );

                if ($row) {
                    $parent_list = [
                        $row[$cfg['id']] => $row[$cfg['name']]
                    ];
                }
            }
        }

        

        $view_data['form'] = array('token' => $req_token, 'category_id' => $req_category_id, 'parent_type' => $req_parent_type, 'parent_id' => $req_parent_id, 'host_id' => $req_host_id, 'type_id' => $req_type_id, 'url' => $req_url, 'quality_id' => $req_quality_id, 'duration' => $req_duration, 'file_size' => $req_file_size, 'part_id' => $req_part_id, 'part' => $req_part, 'public_id' => $req_public_id, 'status' => $req_status, 'sort_order' => $req_sort_order, 'published_year' => $req_published_year, 'published_month' => $req_published_month, 'published_day' => $req_published_day, 'published_hour' => $req_published_hour, 'published_minute' => $req_published_minute, 'published_second' => $req_published_second, 'link_categories_list' => $link_categories_list, 'parent_types_list' => $parent_types_list, 'parent_list' => $parent_list, 'host_types_list' => $host_types_list, 'link_types_list' => $link_types_list,  'quality_types_list' => $quality_types_list, 'part_types_list' => $part_types_list);

            if($this->validation->withRequest($this->request)->run() == FALSE){
    
                $alert_data['alert'] = ['type' => 'error', 'message' => $this->validation->listErrors('my_validation_list')];        
                $this->session->set($alert_data);

                }else{

                    $do_count_where = array('token' => $req_token);                    
                    $do_count = $this->CRUDModel->do_count('links', $do_count_where);

                    if($do_count > 0){
    
                        $alert_data['alert'] = ['type' => 'error', 'message' => 'Duplicate records entry not allowed'];        
                        $this->session->set($alert_data);

                        }else{

                    $var_published_time = "$req_published_year-$req_published_month-$req_published_day $req_published_hour:$req_published_minute:$req_published_second";
                    $var_published_time = datetime_to_unixtimestamp_fnc($var_published_time);

                    $do_create_data =  array('category_id' => $req_category_id, 'parent_type' => $req_parent_type, 'parent_id' => $req_parent_id, 'host_id' => $req_host_id, 'type_id' => $req_type_id, 'url' => $req_url, 'quality_id' => $req_quality_id, 'duration' => $req_duration, 'file_size' => $req_file_size, 'part_id' => $req_part_id, 'part' => $req_part, 'public_id' => $req_public_id, 'status' => $req_status, 'sort_order' => $req_sort_order, 'published_time' => $var_published_time, 'token' => $req_token, 'add_by' => $user_info['user_id'], 'add_time' => time(), 'add_ip' => $this->request->getIPAddress());

                   $do_create_id = $this->CRUDModel->do_create('links', $do_create_data);

   
                            $alert_data['alert'] = ['type' => 'success', 'message' => "The new record id# ".$do_create_id." has been saved successfully"];
                            $this->session->set($alert_data);   
                            
                            return redirect()->to($this->cc['base_url'].'Links/list');

                        }

                }


        }

        $view_data['page'] = [
            'title' => "Add | Links | ".$this->cc['app_name'],
           'description' => "",
           'keywords' => "",
           'url' => current_url(),
           'type' => "website"
         ];  
  
       $view_data['cc'] = $this->cc;

        return view('backend/'.$this->cc['backend_theme'].'/links_add', $view_data);

    }


    

}