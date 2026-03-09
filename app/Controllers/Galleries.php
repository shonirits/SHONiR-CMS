<?php

namespace App\Controllers;

class Galleries extends Shonir_Controller
{

    public function __construct() {
        parent::__construct();
    }

    public function index()
    {

        $view_data['page'] = [
            'title' => "Galleries | ".$this->cc['app_name'],
           'description' => "",
           'keywords' => "",
           'url' => current_url(),
           'type' => "website"
         ];  

       $view_data['cc'] = $this->cc;

        return view('welcome_message', $view_data);

    }

    public function gallery($req_id = 0)
    {

    $current_page_id = 'gallery-'.$req_id;
        
        $get_row_where = array('page_id' => $req_id, 'status' => 1, 'published_time<=' => time());                    
        $get_row = $this->CRUDModel->get_row('pages', $get_row_where);

        if(!$get_row){

            throw \CodeIgniter\Exceptions\PageNotFoundException::forPageNotFound(); 

        }


        if($this->cc['ratings'] == 'TRUE'){

        $get_row_ratings_where = array('parent_id' => $req_id, 'parent_type' => 'page'); 
        
        if($this->cc['ratings_guest'] == 'TRUE'){
        $get_row_ratings_where['add_ip'] = $this->request->getIPAddress();
        $get_row_ratings_where['year(from_unixtime(add_time))'] = date("Y");
        $get_row_ratings_where['month(from_unixtime(add_time))'] = date("m");
        $get_row_ratings_where['day(from_unixtime(add_time))'] = date("d");
        }else{
        $get_row_ratings_where['add_ip'] = 0;
        }

        $get_row_ratings = $this->CRUDModel->get_row('ratings', $get_row_ratings_where);

        $get_row['rated'] = 'false';

        if($get_row_ratings){

            $get_row['rated'] = 'true';

        }

    }



    if($this->cc['likes'] == 'TRUE'){

        $get_row_likes_where = array('parent_id' => $req_id, 'parent_type' => 'page'); 
        
        if($this->cc['likes_guest'] == 'TRUE'){
        $get_row_likes_where['add_ip'] = $this->request->getIPAddress();
        $get_row_likes_where['year(from_unixtime(add_time))'] = date("Y");
        $get_row_likes_where['month(from_unixtime(add_time))'] = date("m");
        $get_row_likes_where['day(from_unixtime(add_time))'] = date("d");
        }else{
        $get_row_likes_where['add_ip'] = 0;
        }

        $get_row_likes = $this->CRUDModel->get_row('likes', $get_row_likes_where);

        $get_row['liked'] = 'false';

        if($get_row_likes){

            $get_row['liked'] = 'true';

        }

    }


     $do_update_where = array('page_id' => $req_id);
        $do_update_data = array('last_hit_time' => time(), 'last_view_time' => time(), 'today_views' => $get_row['today_views']+1, 'today_hits' => $get_row['today_hits']+1, 'lifetime_views' => $get_row['lifetime_views']+1, 'lifetime_hits' => $get_row['lifetime_hits']+1);

         if(date("d/m/Y", $get_row['statistics_update']) != date("d/m/Y")){
          $do_update_data['statistics_update'] = time();
          $do_update_data['today_views'] = 1;
          $do_update_data['today_hits'] = 1;
        }


    $do_update = $this->CRUDModel->do_update('pages', $do_update_where, $do_update_data);

     $random_where = "status = 1 AND published_time <= " . time();
        $view_data['random_items'] = $this->CRUDModel->get_items($random_where, 'RAND()', $this->cc['limit_items_trending']);

        $view_data['categories_tree'] = $this->CRUDModel->get_categories_tree($this->cc['base_url']);

        $view_data['pages_tree'] = $this->CRUDModel->get_pages_tree($this->cc['base_url']);

        $pages_where = ['status' => 1, 'listed' => 1, 'published_time <=' => time()];

        $view_data['pages'] = $this->CRUDModel->get_result('pages', $pages_where, 'page_id, sort_order, slug, title, name');

        $categories_where = ['status' => 1, 'listed' => 1, 'published_time <=' => time()];

        $view_data['categories'] = $this->CRUDModel->get_result('categories', $categories_where, 'category_id, items, icon, slug, title, name', 'sort_order ASC');

        $view_data['sections'] = $this->CRUDModel->get_result('sections', '', 'section_id, slug, title, name', 'sort_order ASC', 10);
        $view_data['industries'] = $this->CRUDModel->get_result('industries', '', 'industry_id, slug, title, name', 'sort_order ASC', 10);
        $view_data['voices'] = $this->CRUDModel->get_result('voices', '', 'voice_id, slug, title, name', 'sort_order ASC', 10);
        $view_data['regions'] = $this->CRUDModel->get_result('regions', '', 'region_id, slug, title, name', 'sort_order ASC', 10);

        $view_data['banners'] = $this->CRUDModel->get_banners($current_page_id, 'sort_order ASC');
        $view_data['gallery_videos'] = $this->CRUDModel->get_galleries('gallery-videos', 'video');
        $view_data['gallery_images'] = $this->CRUDModel->get_galleries('gallery-images', 'image');

        if($req_id == 21){
            $parent_id = 'gallery-images';
            $parent_type = 'image';
            $url = $this->cc['base_url'].'g'.$req_id.'/images-gallery.html';
        }else{
            $parent_id = 'gallery-videos';
            $parent_type = 'video';
            $url = $this->cc['base_url'].'g'.$req_id.'/videos-gallery.html';
        }

        $default_limit = $this->cc['limit_gallery_list'];
        $get_result_where = ''; 
        $get_result_like =  '';

        $page = (int) ($this->request->getGet('page') ?? 1);        
        $limit = (int) ($this->request->getGet('limit') ?? $default_limit);

        $order = $this->request->getGet('order');
        $sort = $this->request->getGet('sort');
        $query = $this->request->getGet('query');

        if($query){
            $get_result_like = array( "LOWER(name)" => strtolower($query), "LOWER(title)" => strtolower($query), "LOWER(description)" => strtolower($query));          
         }

        $order_list = array('sort_order' => 'Sort Order', 'title' => 'Title', 'name' => 'Name', 'today_views' => 'Today Views', 'lifetime_views' => 'Lifetime Views', 'today_hits' => 'Today Hits', 'lifetime_hits' => 'Lifetime Hits');
        if(!array_key_exists($order, $order_list)){
            $order = 'sort_order';
        }

        $limit_list = array();
        $x = $default_limit;
        for ($i = 1; $i <= 5; $i++) {
          $x = $x * $i;
          $limit_list[(string)$x] = (string)$x;
      }

        if(!array_key_exists($limit, $limit_list)){
            $limit = $default_limit;
        }
        
        $sort_list = array('ASC' => 'Ascending', 'DESC' => 'Descending');
        if(!array_key_exists($sort, $sort_list)){
            $sort = 'DESC';
        }

         if($limit < $default_limit || $page < 1){
            $alert_data['alert'] = ['type' => 'error', 'message' => "The requested record was not found"];
             $this->session->set($alert_data);
            return redirect()->to($this->cc['base_url']);
        }

        $get_result_where = "status = 1 AND listed = 1 AND parent_id = '" . $parent_id . "' AND parent_type = '" . $parent_type . "'";

         $total_records = $this->CRUDModel->do_count('galleries', $get_result_where, $get_result_like);

        $start = ($page-1)*$limit;

         $get_result_select = "tbl_galleries.*,  
          (SELECT upload_file FROM tbl_uploads  
           WHERE upload_type = 'image'  
           AND parent_type = 'galleries_images'  
           AND parent_id = tbl_galleries.gallery_id  
           ORDER BY  RAND() LIMIT 1) AS upload_file,
          (SELECT upload_id FROM tbl_uploads  
           WHERE upload_type = 'image'  
           AND parent_type = 'galleries_images'  
           AND parent_id = tbl_galleries.gallery_id  
           ORDER BY  RAND() LIMIT 1) AS upload_id";
           
    $get_result = ($total_records > 0)?$this->CRUDModel->get_result('galleries', $get_result_where, $get_result_select, $order.' '.$sort, $limit, $start, $get_result_like):false;

        if($get_result){
        $get_result_update_gallery_ids = array_column($get_result, 'gallery_id');
        if (!empty($get_result_update_gallery_ids)) {
          $get_result_update_galleries = implode(',', $get_result_update_gallery_ids);
          $get_result_update_where = "gallery_id IN ($get_result_update_galleries)";
          $get_result_update_data = ['today_views' => 'today_views + 1', 'last_view_time' => time()];
          $update_result = $this->CRUDModel->do_update('tbl_galleries', $get_result_update_where, $get_result_update_data, false);
        }}

        $view_data['page'] = [
            'title' => $get_row['meta_title']." | ".$this->cc['app_name'],
           'description' => $get_row['meta_description'],
           'keywords' => $get_row['meta_keywords'],
           'url' => current_url(),
           'id' => $current_page_id,
           'type' => "website"
         ];
         
        $view_data['pagination'] = ($total_records > 0)?pagination_fnc($get_result, $total_records, $limit, $page, $url):false; 
        
        $view_data['order_list'] = $order_list;
        $view_data['sort_list'] = $sort_list;
        $view_data['limit_list'] = $limit_list;
        $view_data['order'] = $order;
        $view_data['sort'] = $sort;
        $view_data['limit'] = $limit;
        $view_data['query'] = $query;

       $view_data['cc'] = $this->cc;
       $view_data['row'] = $get_row;
       $view_data['rows'] = $get_result;

       $view_data['structured_data'] = '
       <script type="application/ld+json">
       {
  "@context": "https://schema.org",
  "@type": "WebPage",
  "name": "'.data2json_fnc($get_row['meta_title']).'",
  "description": "'.data2json_fnc($get_row['meta_description']).'",
  "publisher": {
    "@type": "Organization",
    "name": "'.data2json_fnc($this->cc['app_name']).'",
    "url": "'.$this->cc['base_url'].'"
  }
}
  </script>

  <div itemscope itemtype="https://schema.org/WebPage">
    <meta itemprop="name" content="'.data2json_fnc($get_row['meta_title']).'">
    <meta itemprop="description" content="'.data2json_fnc($get_row['meta_description']).'">
    <div itemprop="publisher" itemscope itemtype="https://schema.org/Organization">
        <meta itemprop="name" content="'.data2json_fnc($this->cc['app_name']).'">
        <meta itemprop="url" content="'.$this->cc['base_url'].'">
    </div>
</div>
';

       if($this->cc['cache_time'] > 0){
       $this->cachePage($this->cc['cache_time']);
       }
      
        return view('frontend/'.$this->cc['frontend_theme'].'/galleries', $view_data);



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

        $order_list = array('gallery_id' => 'Gallery ID', 'title' => 'Title', 'name' => 'Name', 'today_views' => 'Today Views', 'lifetime_views' => 'Lifetime Views', 'today_hits' => 'Today Hits', 'lifetime_hits' => 'Lifetime Hits', 'edit_time' => 'Last Edited Time');
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
             return redirect()->to($this->cc['base_url'].'Galleries/list');
           }

        $view_data['page'] = [
            'title' => "List | Galleries | ".$this->cc['app_name'],
           'description' => "",
           'keywords' => "",
           'url' => current_url(),
           'type' => "website"
         ];         

        $total_records = $this->CRUDModel->do_count('galleries', $get_result_where, $get_result_like);

        $start = ($page-1)*$limit;

        $get_result = ($total_records > 0)?$this->CRUDModel->get_result('galleries', $get_result_where, '', $order.' '.$sort, $limit, $start, $get_result_like):false;

        $url = $this->cc['base_url'].'Galleries/list?query='.$query.'&order='.$order.'&sort='.$sort.'&limit='.$limit;

        $view_data['pagination'] = ($total_records > 0)?pagination_fnc($get_result, $total_records, $limit, $page, $url):false; 
        
        $view_data['order_list'] = $order_list;
        $view_data['sort_list'] = $sort_list;
        $view_data['limit_list'] = $limit_list;
        $view_data['order'] = $order;
        $view_data['sort'] = $sort;
        $view_data['limit'] = $limit;
        $view_data['query'] = $query;
  
        $view_data['cc'] = $this->cc;

        return view('backend/'.$this->cc['backend_theme'].'/galleries_list', $view_data);

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

        $get_row_where = array('gallery_id' => $req_id);                    
        $get_row = $this->CRUDModel->get_row('galleries', $get_row_where);

        if(!$get_row){

            $alert_data['alert'] = ['type' => 'error', 'message' => "The record id# ".$req_id." was not found"];
             $this->session->set($alert_data);

             return redirect()->to($this->cc['base_url'].'Galleries/list');

        }else{

            if($get_row['removable'] != 1){

            $alert_data['alert'] = ['type' => 'error', 'message' => "The record id# ".$req_id." was not removable"];
             $this->session->set($alert_data);

             return redirect()->to($this->cc['base_url'].'Galleries/list');

          }else{

        $uploads_path = FCPATH.'public/uploads/';

        $get_row_where_images = array('parent_id' => $req_id, 'parent_type' => 'galleries_images');                    
        $get_result_images = $this->CRUDModel->get_result('uploads', $get_row_where_images);

      
        foreach ($get_result_images as $image)
            {

                if(file_exists($uploads_path.$image['upload_file'])) { unlink ($uploads_path.$image['upload_file']);}
                $do_delete_where_image = array('upload_id' => $image['upload_id']);
                $this->CRUDModel->do_delete('uploads', $do_delete_where_image);

            }

        $this->CRUDModel->do_delete('galleries', $get_row_where);
            
        $alert_data['alert'] = ['type' => 'success', 'message' => "The record id# ".$req_id." has been deleted successfully"];
        $this->session->set($alert_data);

        return redirect()->to($this->cc['base_url'].'Galleries/list');
        }

    }

    }


    public function edit()
    {

        $GLOBALS['HTMLS_CACHE'] = false;

        $user_info = $this->_verify_user_area(1);

        $req_id = $this->request->getGet('id');

        $get_row_where = array('gallery_id' => $req_id);                    
        $get_row = $this->CRUDModel->get_row('galleries', $get_row_where);

        if(!$get_row){

            $alert_data['alert'] = ['type' => 'error', 'message' => "The requested record id# ".$req_id." was not found"];
             $this->session->set($alert_data);

             return redirect()->to($this->cc['base_url'].'Galleries/list');

        }else{

        $get_row_where_images = array('parent_id' => $req_id, 'parent_type' => 'galleries_images');                    
        $get_result_images = $this->CRUDModel->get_result('uploads', $get_row_where_images);

        $view_data['form'] = array('id' => $req_id, 'token' => get_token_fnc(16), 'sort_order' => $get_row['sort_order'], 'title' => $get_row['title'], 'name' => $get_row['name'], 'link' => $get_row['link'], 'description' => $get_row['description'], 'status' => $get_row['status'], 'featured' => $get_row['featured'], 'listed' => $get_row['listed'],'parent_id' => $get_row['parent_id'], 'parent_type' => $get_row['parent_type'], 'today_views' => $get_row['today_views'], 'lifetime_views' => $get_row['lifetime_views'], 'today_hits' => $get_row['today_hits'], 'lifetime_hits' => $get_row['lifetime_hits'], 'images' => $get_result_images);

        if ($this->request->getMethod() == "POST") {

        if($user_info['role'] == 0){
         $alert_data['alert'] = ['type' => 'error', 'message' => "Authorization failed: You are not permitted to perform this action."];
             $this->session->set($alert_data);
             return redirect()->to($this->cc['base_url'].'Backend');
        }

        $this->validation->setRules([
          'parent_id' => ['label' => 'Parent ID', 'rules' => 'required|trim'],
          'parent_type' => ['label' => 'Parent Type', 'rules' => 'required|trim'],
          'today_views' => ['label' => 'today_views', 'rules' => 'required|trim|numeric'],
          'lifetime_views' => ['label' => 'lifetime_views', 'rules' => 'required|trim|numeric'],
          'today_hits' => ['label' => 'today_hits', 'rules' => 'required|trim|numeric'],
          'lifetime_hits' => ['label' => 'lifetime_hits', 'rules' => 'required|trim|numeric'],
      ]);
        
        $req_token = $this->request->getPost('token');
        $req_title = $this->request->getPost('title');
        $req_name = $this->request->getPost('name');
        $req_link = $this->request->getPost('link');
        $req_description = $this->request->getPost('description');
        $req_status = (int) ($this->request->getPost('status') ?? 0);
        $req_featured = (int) ($this->request->getPost('featured') ?? 0);
        $req_listed = (int) ($this->request->getPost('listed') ?? 0);
        $req_sort_order = (int) ($this->request->getPost('sort_order') ?? 0);
        $req_parent_id = $this->request->getPost('parent_id');
        $req_parent_type = $this->request->getPost('parent_type');
        $req_today_views = $this->request->getPost('today_views');
        $req_lifetime_views = $this->request->getPost('lifetime_views');
        $req_today_hits = $this->request->getPost('today_hits');
        $req_lifetime_hits = $this->request->getPost('lifetime_hits');
        

        $view_data['form'] = array('id' => $req_id, 'token' => get_token_fnc(16), 'sort_order' => $req_sort_order, 'title' => $req_title, 'name' => $req_name, 'link' => $req_link, 'description' => $req_description, 'status' => $req_status, 'featured' => $req_featured, 'listed' => $req_listed, 'parent_id' => $req_parent_id, 'parent_type' => $req_parent_type, 'today_views' => $req_today_views, 'lifetime_views' => $req_lifetime_views, 'today_hits' => $req_today_hits, 'lifetime_hits' => $req_lifetime_hits, 'images' => $get_result_images);
            if($this->validation->withRequest($this->request)->run() == FALSE){
    
                $alert_data['alert'] = ['type' => 'error', 'message' => $this->validation->listErrors('my_validation_list')];        
                $this->session->set($alert_data);

                }else{

                    $do_count_where = array('token' => $req_token);                    
                    $do_count = $this->CRUDModel->do_count('galleries', $do_count_where);

                    if($do_count > 0){
    
                        $alert_data['alert'] = ['type' => 'error', 'message' => 'Duplicate records entry not allowed'];        
                        $this->session->set($alert_data);

                    }else{   


                    $do_update_where = array('gallery_id' => $req_id);

        
                    $do_update_data =  array('sort_order' => $req_sort_order, 'title' => $req_title, 'name' => $req_name, 'link' => $req_link, 'description' => $req_description, 'status' => $req_status, 'featured' => $req_featured, 'listed' => $req_listed, 'parent_id' => $req_parent_id, 'parent_type' => $req_parent_type, 'today_views' => $req_today_views, 'lifetime_views' => $req_lifetime_views, 'today_hits' => $req_today_hits, 'lifetime_hits' => $req_lifetime_hits, 'token' => $req_token, 'edit_by' => $user_info['user_id'], 'edit_time' => time(), 'edit_ip' => $this->request->getIPAddress());

                   $this->CRUDModel->do_update('galleries', $do_update_where, $do_update_data);

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

                            $do_create_data_images =  array('upload_type' => 'image', 'upload_file' => $image_new_name, 'parent_id' => $req_id, 'parent_type' => 'galleries_images', 'sort_order' => $var_image_sort_order, 'token' => $req_token, 'add_by' => $user_info['user_id'], 'add_time' => time(), 'add_ip' => $this->request->getIPAddress());

                             $this->CRUDModel->do_create('uploads', $do_create_data_images);

                            }

                        }

    
                            $alert_data['alert'] = ['type' => 'success', 'message' => "The record id# ".$req_id." has been updated successfully"];
                            $this->session->set($alert_data);                

                            return redirect()->to($this->cc['base_url'].'Galleries/list');
                        }

                }


        }

        $view_data['page'] = [
            'title' => "Edit | Galleries | ".$this->cc['app_name'],
           'description' => "",
           'keywords' => "",
           'url' => current_url(),
           'type' => "website"
         ];  
  
       $view_data['cc'] = $this->cc;

        return view('backend/'.$this->cc['backend_theme'].'/galleries_edit', $view_data);

    }

    }


    public function add()
    {

        $GLOBALS['HTMLS_CACHE'] = false;

        $user_info = $this->_verify_user_area(1);

        $var_db_categories = $this->CRUDModel->get_result('categories');

        $view_data['form'] = array('token' => get_token_fnc(16), 'parent_id' => '', 'parent_type' => '', 'name' => '', 'title' => '', 'link' => '', 'description' => '', 'status' => 1, 'featured' => 0, 'listed' => 1, 'sort_order' => 1);


        if ($this->request->getMethod() == "POST") {

        if($user_info['role'] == 0){
         $alert_data['alert'] = ['type' => 'error', 'message' => "Authorization failed: You are not permitted to perform this action."];
             $this->session->set($alert_data);
             return redirect()->to($this->cc['base_url'].'Backend');
        }

        $this->validation->setRules([
          'parent_id' => ['label' => 'Parent ID', 'rules' => 'required|trim'],
          'parent_type' => ['label' => 'Parent Type', 'rules' => 'required|trim'],
      ]);
        
        $req_token = $this->request->getPost('token');
        $req_parent_id = $this->request->getPost('parent_id');
        $req_parent_type = $this->request->getPost('parent_type');
        $req_title = $this->request->getPost('title');
        $req_name = $this->request->getPost('name');
        $req_link = $this->request->getPost('link');
        $req_description = $this->request->getPost('description');
        $req_sort_order = (int) ($this->request->getPost('sort_order') ?? 0);
        $req_status = (int) ($this->request->getPost('status') ?? 0);
        $req_featured = (int) ($this->request->getPost('featured') ?? 0);
        $req_listed = (int) ($this->request->getPost('listed') ?? 0);
        $req_today_views = 99;
        $req_lifetime_views = 999;
        $req_today_hits = 99;
        $req_lifetime_hits = 999;

        $view_data['form'] = array('token' => $req_token, 'parent_id' => $req_parent_id, 'parent_type' => $req_parent_type, 'sort_order' => $req_sort_order, 'title' => $req_title, 'name' => $req_name, 'link' => $req_link, 'description' => $req_description, 'status' => $req_status, 'featured' => $req_featured, 'listed' => $req_listed);

            if($this->validation->withRequest($this->request)->run() == FALSE){
    
                $alert_data['alert'] = ['type' => 'error', 'message' => $this->validation->listErrors('my_validation_list')];        
                $this->session->set($alert_data);

                }else{

                    $do_count_where = array('token' => $req_token);                    
                    $do_count = $this->CRUDModel->do_count('galleries', $do_count_where);

                    if($do_count > 0){
    
                        $alert_data['alert'] = ['type' => 'error', 'message' => 'Duplicate records entry not allowed'];        
                        $this->session->set($alert_data);

                        }else{


                    $do_create_data =  array('parent_id' => slug_fnc($req_parent_id), 'parent_type' => slug_fnc($req_parent_type), 'sort_order' => $req_sort_order, 'title' => $req_title, 'name' => $req_name, 'link' => $req_link, 'description' => $req_description, 'status' => $req_status, 'featured' => $req_featured, 'listed' => $req_listed, 'today_views' => $req_today_views, 'lifetime_views' => $req_lifetime_views, 'today_hits' => $req_today_hits, 'lifetime_hits' => $req_lifetime_hits,  'token' => $req_token, 'add_by' => $user_info['user_id'], 'add_time' => time(), 'add_ip' => $this->request->getIPAddress());

                   $do_create_id = $this->CRUDModel->do_create('galleries', $do_create_data);

                 

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

                            $do_create_data_images =  array('upload_type' => 'image', 'upload_file' => $image_new_name, 'parent_id' => $do_create_id, 'parent_type' => 'galleries_images', 'sort_order' => $var_image_sort_order, 'token' => $req_token, 'add_by' => $user_info['user_id'], 'add_time' => time(), 'add_ip' => $this->request->getIPAddress());

                             $this->CRUDModel->do_create('uploads', $do_create_data_images);

                            }

                        }
                       
    
                            $alert_data['alert'] = ['type' => 'success', 'message' => "The new record id# ".$do_create_id." has been saved successfully"];
                            $this->session->set($alert_data);   
                            
                            return redirect()->to($this->cc['base_url'].'Galleries/list');

                        }

                }


        }

        $view_data['page'] = [
            'title' => "Add | Galleries | ".$this->cc['app_name'],
           'description' => "",
           'keywords' => "",
           'url' => current_url(),
           'type' => "website"
         ];  
  
       $view_data['cc'] = $this->cc;

        return view('backend/'.$this->cc['backend_theme'].'/galleries_add', $view_data);

    }


    

}


