<?php

namespace App\Controllers;

class Tools extends Shonir_Controller
{

    public function __construct() {
        parent::__construct();
    }


    public function items_old_v2()
    {

      $user_info = $this->_verify_user_area(1);
      $req_token = get_token_fnc(32);

       $get_row_where_items_old = array('rn>' => 0);                    
       $get_row_items_old = $this->CRUDModel->get_result('items_old', $get_row_where_items_old);
       $uploads_old_path = FCPATH.'public/uploads_old/items/';
       $uploads_path = FCPATH.'public/uploads/';

       $r = 0;

      foreach ($get_row_items_old as $item_old)
            {
              $r++;
               $get_row_where_items_description = array('pn' => $item_old['rn']);                    
        $get_row_items_description = $this->CRUDModel->get_row('itemsdetails', $get_row_where_items_description);

        $old_filename = $item_old['file2'];
        
         $upload_file_old_full = $uploads_old_path.$old_filename;

              if($get_row_items_description){                

                $req_id = $item_old['rn'];
                $req_slug = slug_fnc($get_row_items_description['name']);
                $req_title = $get_row_items_description['mtitle'];
                $req_name = $get_row_items_description['name'];
                $req_spotlight = $get_row_items_description['mdescription'];
                $req_description = $get_row_items_description['description'];
                $req_status = 1;
                $req_searchable = 1;
                $req_listed = 1;
                $req_featured = 1;
                $req_published_time = time();
                $req_meta_title = $get_row_items_description['mtitle'];
                $req_meta_description = $get_row_items_description['mdescription'];
                $req_meta_keywords = $get_row_items_description['mkeywords'];
                $req_today_views = 99;
                $req_lifetime_views = 999;
                $req_today_hits = 99;
                $req_lifetime_hits = 999;
                $req_votes = 99;
                $req_ratings = 5;
                $req_scores = 495;
                $req_likes = 99;

                $upload_file = $req_slug.'-'.$old_filename;
                $upload_file_full = $uploads_path.$upload_file;

                $req_launch_year = 2025;

                $req_model = $item_old['code'];
                $req_sku = get_token_fnc(2, 'capital_alphabetic').'-'.get_token_fnc(4, 'numbers').'-'.get_token_fnc(2, 'capital_alphabetic');
                $req_mpn = get_token_fnc(2, 'capital_alphabetic').'-'.get_token_fnc(6, 'numbers');
                $req_gtin = get_token_fnc(13, 'numbers');
                $req_price = get_token_fnc(2, 'numbers').'.'.get_token_fnc(2, 'numbers');
                $req_price_previous = $req_price+(get_token_fnc(2, 'numbers').'.'.get_token_fnc(2, 'numbers'));
                $req_today_views = 99;
                $req_lifetime_views = 999;
                $req_today_hits = 99;
                $req_lifetime_hits = 999;
                $req_votes = 99;
                $req_ratings = 5;
                $req_scores = 495;
                $req_likes = 99;

                 $is_exist_where_items = array('item_id' => $req_id); 

                $is_exist_item_id = $this->CRUDModel->is_exist('items', $is_exist_where_items);

                if(!$is_exist_item_id){

                 $do_create_item_data = array('item_id' => $req_id, 'slug' => $req_slug, 'title' => $req_title, 'name' => $req_name, 'spotlight' => $req_spotlight, 'description' => $req_description, 'status' => $req_status, 'searchable' => $req_searchable, 'listed' => $req_listed, 'featured' => $req_featured, 'sku' => $req_sku, 'model' => $req_model, 'mpn' => $req_mpn, 'gtin' => $req_gtin, 'price' => $req_price, 'price_previous' => $req_price_previous, 'today_views' => $req_today_views, 'lifetime_views' => $req_lifetime_views, 'today_hits' => $req_today_hits, 'lifetime_hits' => $req_lifetime_hits, 'votes' => $req_votes, 'ratings' => $req_ratings, 'scores' => $req_scores, 'likes' => $req_likes, 'launch_year' => $req_launch_year, 'published_time' => $req_published_time, 'meta_title' => $req_meta_title, 'meta_description' => $req_meta_description, 'meta_keywords' => $req_meta_keywords, 'token' => $req_token, 'add_by' => 0, 'add_time' => time(), 'add_ip' => $this->request->getIPAddress());

                 $do_create_item_id = $this->CRUDModel->do_create('items', $do_create_item_data);


                  if($item_old['pn']){
                 $do_create_items_to_categories =  array('item_id' => $req_id, 'category_id' => $item_old['pn']);
                $this->CRUDModel->do_create('items_to_categories', $do_create_items_to_categories);
                 }
      
               print_r($do_create_item_data);echo '<hr>';

               if(file_exists($upload_file_old_full)) {

                $do_create_data_images =  array('upload_type' => 'image', 'upload_file' => $upload_file, 'parent_id' => $req_id, 'parent_type' => 'items_images', 'sort_order' => 1, 'token' => $req_token, 'add_by' => 0, 'add_time' => time(), 'add_ip' => $this->request->getIPAddress());

                 $this->CRUDModel->do_create('uploads', $do_create_data_images);

                echo $upload_file_old_full.' <<<< OLD --- NEW >>>> '.$upload_file_full.'<br/>';

                 rename($upload_file_old_full, $upload_file_full);
                  
                  }

                }

      $get_row_where_uploads = array('pn' => $req_id);                    
      $get_row_uploads = $this->CRUDModel->get_result('igallery', $get_row_where_uploads);


      $sort_order = 1;

      foreach ($get_row_uploads as $upload)
            {  

              $sort_order++;

      $upload_file_old_full = $uploads_old_path.$upload['file1'];
      $upload_file = $req_slug.'-'.$upload['file1'];
      $upload_file_full = $uploads_path.$upload_file;

     if(file_exists($upload_file_old_full)) {

     $do_create_data_images =  array('upload_type' => 'image', 'upload_file' => $upload_file, 'parent_id' => $req_id, 'parent_type' => 'items_images', 'sort_order' => $sort_order, 'token' => $req_token, 'add_by' => 0, 'add_time' => time(), 'add_ip' => $this->request->getIPAddress());

      $this->CRUDModel->do_create('uploads', $do_create_data_images);

     echo $upload_file_old_full.' <<<< OLD --- NEW >>>> '.$upload_file_full.'<hr/>';

      rename($upload_file_old_full, $upload_file_full);
      
      }

            }

                  }

                  // if($r > 10){
                  //   exit;
                  // }

            }
    }

    public function categories_old_v2()
    {

      $user_info = $this->_verify_user_area(1);
      $req_token = get_token_fnc(32);

       $get_row_where_categories_old = array('rn>' => 0);                    
       $get_row_categories_old = $this->CRUDModel->get_result('categories_old', $get_row_where_categories_old);
       $uploads_old_path = FCPATH.'public/uploads_old/categories/';
       $uploads_path = FCPATH.'public/uploads/';

      foreach ($get_row_categories_old as $category_old)
            {
               $get_row_where_categories_description = array('pn' => $category_old['rn']);                    
        $get_row_categories_description = $this->CRUDModel->get_row('categoriesdetails', $get_row_where_categories_description);

        $old_filename = $category_old['file2'];
        
         $upload_file_old_full = $uploads_old_path.$old_filename;

              if($get_row_categories_description){                

                $req_id = $category_old['rn'];
                $req_slug = slug_fnc($get_row_categories_description['name']);
                $req_title = $get_row_categories_description['mtitle'];
                $req_name = $get_row_categories_description['name'];
                $req_spotlight = $get_row_categories_description['mdescription'];
                $req_description = $get_row_categories_description['description'];
                $req_status = 1;
                $req_searchable = 1;
                $req_listed = 1;
                $req_featured = 1;
                $req_published_time = time();
                $req_meta_title = $get_row_categories_description['mtitle'];
                $req_meta_description = $get_row_categories_description['mdescription'];
                $req_meta_keywords = $get_row_categories_description['mkeywords'];
                $req_today_views = 99;
                $req_lifetime_views = 999;
                $req_today_hits = 99;
                $req_lifetime_hits = 999;
                $req_votes = 99;
                $req_ratings = 5;
                $req_scores = 495;
                $req_likes = 99;

                $upload_file = $req_slug.'-'.$old_filename;
                $upload_file_full = $uploads_path.$upload_file;

                 $is_exist_where_categories = array('category_id' => $req_id); 

                $is_exist_category_id = $this->CRUDModel->is_exist('categories', $is_exist_where_categories);

                if(!$is_exist_category_id){

                 $do_create_category_data = array('category_id' => $req_id, 'slug' => $req_slug, 'title' => $req_title, 'name' => $req_name, 'spotlight' => $req_spotlight, 'description' => $req_description, 'status' => $req_status, 'searchable' => $req_searchable, 'listed' => $req_listed, 'featured' => $req_featured,  'today_views' => $req_today_views, 'lifetime_views' => $req_lifetime_views, 'today_hits' => $req_today_hits, 'lifetime_hits' => $req_lifetime_hits, 'votes' => $req_votes, 'ratings' => $req_ratings, 'scores' => $req_scores, 'likes' => $req_likes, 'published_time' => $req_published_time, 'meta_title' => $req_meta_title, 'meta_description' => $req_meta_description, 'meta_keywords' => $req_meta_keywords, 'token' => $req_token, 'add_by' => 0, 'add_time' => time(), 'add_ip' => $this->request->getIPAddress());

                 $do_create_category_id = $this->CRUDModel->do_create('categories', $do_create_category_data);

                 if($category_old['pn']){
                 $do_create_categories_to_categories =  array('children_id' => $req_id, 'parent_id' => $category_old['pn']);
                $this->CRUDModel->do_create('categories_to_categories', $do_create_categories_to_categories);
                 }
      
               print_r($do_create_category_data);echo '<hr>';

               if(file_exists($upload_file_old_full)) {

                $do_create_data_images =  array('upload_type' => 'image', 'upload_file' => $upload_file, 'parent_id' => $req_id, 'parent_type' => 'categories_images', 'sort_order' => 1, 'token' => $req_token, 'add_by' => 0, 'add_time' => time(), 'add_ip' => $this->request->getIPAddress());

                 $this->CRUDModel->do_create('uploads', $do_create_data_images);

                echo $upload_file_old_full.' <<<< OLD --- NEW >>>> '.$upload_file_full.'<br/>';

                  rename($upload_file_old_full, $upload_file_full);
                  
                  }

                }

                  }

            }
    }


    public function pages_old_v2()
    {

      $user_info = $this->_verify_user_area(1);
      $req_token = get_token_fnc(32);

       $get_row_where_pages_old = array('rn>' => 0);                    
       $get_row_pages_old = $this->CRUDModel->get_result('webcontents', $get_row_where_pages_old);
       $uploads_old_path = FCPATH.'public/uploads_old/';
       $uploads_path = FCPATH.'public/uploads/';

      foreach ($get_row_pages_old as $page_old)
            {
               $get_row_where_pages_description = array('pn' => $page_old['rn']);                    
        $get_row_pages_description = $this->CRUDModel->get_row('webcontentsdetail', $get_row_where_pages_description);
        
         $upload_file_old_full = $uploads_old_path.$page_old['file1'];

              if($get_row_pages_description){                

                $req_id = $page_old['rn'];
                $req_slug = slug_fnc($get_row_pages_description['mtitle']);
                $req_title = $get_row_pages_description['mtitle'];
                $req_name = $get_row_pages_description['title'];
                $req_spotlight = $get_row_pages_description['mdescription'];
                $req_description = $get_row_pages_description['description'];
                $req_status = 1;
                $req_searchable = 1;
                $req_listed = 1;
                $req_featured = 1;
                $req_published_time = time();
                $req_meta_title = $get_row_pages_description['mtitle'];
                $req_meta_description = $get_row_pages_description['mdescription'];
                $req_meta_keywords = $get_row_pages_description['mkeywords'];
                $req_today_views = 99;
                $req_lifetime_views = 999;
                $req_today_hits = 99;
                $req_lifetime_hits = 999;
                $req_votes = 99;
                $req_ratings = 5;
                $req_scores = 495;
                $req_likes = 99;

                $upload_file = $req_slug.'-'.$page_old['file1'];
                $upload_file_full = $uploads_path.$upload_file;

                 $is_exist_where_pages = array('page_id' => $req_id); 

                $is_exist_page_id = $this->CRUDModel->is_exist('pages', $is_exist_where_pages);

                if(!$is_exist_page_id){

                 $do_create_page_data = array('page_id' => $req_id, 'slug' => $req_slug, 'title' => $req_title, 'name' => $req_name, 'spotlight' => $req_spotlight, 'description' => $req_description, 'status' => $req_status, 'searchable' => $req_searchable, 'listed' => $req_listed, 'featured' => $req_featured,  'today_views' => $req_today_views, 'lifetime_views' => $req_lifetime_views, 'today_hits' => $req_today_hits, 'lifetime_hits' => $req_lifetime_hits, 'votes' => $req_votes, 'ratings' => $req_ratings, 'scores' => $req_scores, 'likes' => $req_likes, 'published_time' => $req_published_time, 'meta_title' => $req_meta_title, 'meta_description' => $req_meta_description, 'meta_keywords' => $req_meta_keywords, 'token' => $req_token, 'add_by' => 0, 'add_time' => time(), 'add_ip' => $this->request->getIPAddress());

                 $do_create_page_id = $this->CRUDModel->do_create('pages', $do_create_page_data);
      
               print_r($do_create_page_data);echo '<hr>';

               if(file_exists($upload_file_old_full)) {

                $do_create_data_images =  array('upload_type' => 'image', 'upload_file' => $upload_file, 'parent_id' => $req_id, 'parent_type' => 'pages_images', 'sort_order' => 1, 'token' => $req_token, 'add_by' => 0, 'add_time' => time(), 'add_ip' => $this->request->getIPAddress());

                 $this->CRUDModel->do_create('uploads', $do_create_data_images);

                echo $upload_file_old_full.' <<<< OLD --- NEW >>>> '.$upload_file_full.'<br/>';

                  rename($upload_file_old_full, $upload_file_full);
                  
                  }

                }

                  }

            }
    }


     public function pages_old()
    {

      $user_info = $this->_verify_user_area(1);
      $req_token = get_token_fnc(32);

      $get_row_where_pages_old = array('page_id>' => 0);                    
      $get_row_pages_old = $this->CRUDModel->get_result('pages_old', $get_row_where_pages_old);


        foreach ($get_row_pages_old as $page_old)
            {

       $get_row_where_pages_description = array('page_id' => $page_old['page_id']);                    
        $get_row_pages_description = $this->CRUDModel->get_row('pages_description', $get_row_where_pages_description);       

  if($get_row_pages_description){


     $get_row_where_uploads = array('parent_id' => $page_old['page_id'], 'parent_type' => 'page');                    
      $get_row_uploads = $this->CRUDModel->get_result('uploads_old', $get_row_where_uploads);
      
$uploads_old_path = FCPATH.'public/uploads_old/';

$uploads_path = FCPATH.'public/uploads/';

$sort_order = 1;

      foreach ($get_row_uploads as $upload)
            {  

              $sort_order++;


      $upload_file_old_full = $uploads_old_path.$upload['upload_file'];
      $upload_file = $get_row_pages_description['slug'].'-'.$upload['upload_file'];
      $upload_file_full = $uploads_path.$upload_file;

     if(file_exists($upload_file_old_full)) {

     $do_create_data_images =  array('upload_type' => 'image', 'upload_file' => $upload_file, 'parent_id' => $page_old['page_id'], 'parent_type' => 'pages_images', 'sort_order' => $sort_order, 'token' => $req_token, 'add_by' => 0, 'add_time' => time(), 'add_ip' => $this->request->getIPAddress());

      $this->CRUDModel->do_create('uploads', $do_create_data_images);

     echo $upload['upload_id'].' >> '.$upload['upload_file'].' >> '.$upload_file.'<br/>';

      rename($upload_file_old_full, $upload_file_full);
      
      }

            }

        $get_row_where = array('page_id' => $page_old['page_id']);                    
        $get_row = $this->CRUDModel->get_row('pages', $get_row_where);

        if(!$get_row){

        $req_slug = $get_row_pages_description['slug'];
        $req_title = $get_row_pages_description['meta_title'];
        $req_name = $get_row_pages_description['name'];
        $req_spotlight = $get_row_pages_description['meta_description'];
        $req_description = $get_row_pages_description['description'];
        $req_status = 1;
        $req_searchable = 1;
        $req_listed = 1;
        $req_featured = 1;
        $req_launch_year = 2025;
        $req_published_time = time();
        $req_meta_title = $get_row_pages_description['meta_title'];
        $req_meta_description = $get_row_pages_description['meta_description'];
        $req_meta_keywords = $get_row_pages_description['meta_keyword'];
        $req_today_views = 99;
        $req_lifetime_views = 999;
        $req_today_hits = 99;
        $req_lifetime_hits = 999;
        $req_votes = 99;
        $req_ratings = 5;
        $req_scores = 495;
        $req_likes = 99;

      $do_create_page_data = array('page_id' => $page_old['page_id'], 'slug' => slug_fnc($req_slug), 'title' => $req_title, 'name' => $req_name, 'spotlight' => $req_spotlight, 'description' => $req_description, 'status' => $req_status, 'searchable' => $req_searchable, 'listed' => $req_listed, 'featured' => $req_featured,  'today_views' => $req_today_views, 'lifetime_views' => $req_lifetime_views, 'today_hits' => $req_today_hits, 'lifetime_hits' => $req_lifetime_hits, 'votes' => $req_votes, 'ratings' => $req_ratings, 'scores' => $req_scores, 'likes' => $req_likes, 'launch_year' => $req_launch_year, 'published_time' => $req_published_time, 'meta_title' => $req_meta_title, 'meta_description' => $req_meta_description, 'meta_keywords' => $req_meta_keywords, 'token' => $req_token, 'add_by' => 0, 'add_time' => time(), 'add_ip' => $this->request->getIPAddress());

      $do_create_page_id = $this->CRUDModel->do_create('pages', $do_create_page_data);

      echo $page_old['page_id'].' >> '.$get_row_pages_description['slug'].'<hr/>';

        }

      }

            }


      echo '<hr/>okay';

       exit;

    }



    public function categories_old()
    {

      $user_info = $this->_verify_user_area(1);
      $req_token = get_token_fnc(32);

      $get_row_where_categories_old = array('category_id>' => 0);                    
      $get_row_categories_old = $this->CRUDModel->get_result('categories_old', $get_row_where_categories_old);


        foreach ($get_row_categories_old as $category_old)
            {

       $get_row_where_categories_description = array('category_id' => $category_old['category_id']);                    
        $get_row_categories_description = $this->CRUDModel->get_row('categories_description', $get_row_where_categories_description);       

  if($get_row_categories_description){


     $get_row_where_uploads = array('parent_id' => $category_old['category_id'], 'parent_type' => 'category');                    
      $get_row_uploads = $this->CRUDModel->get_result('uploads_old', $get_row_where_uploads);
      
$uploads_old_path = FCPATH.'public/uploads_old/';

$uploads_path = FCPATH.'public/uploads/';

$sort_order = 1;

      foreach ($get_row_uploads as $upload)
            {  

              $sort_order++;


      $upload_file_old_full = $uploads_old_path.$upload['upload_file'];
      $upload_file = $get_row_categories_description['slug'].'-'.$upload['upload_file'];
      $upload_file_full = $uploads_path.$upload_file;

     if(file_exists($upload_file_old_full)) {

     $do_create_data_images =  array('upload_type' => 'image', 'upload_file' => $upload_file, 'parent_id' => $category_old['category_id'], 'parent_type' => 'categories_images', 'sort_order' => $sort_order, 'token' => $req_token, 'add_by' => 0, 'add_time' => time(), 'add_ip' => $this->request->getIPAddress());

      $this->CRUDModel->do_create('uploads', $do_create_data_images);

     echo $upload['upload_id'].' >> '.$upload['upload_file'].' >> '.$upload_file.'<br/>';

      rename($upload_file_old_full, $upload_file_full);
      
      }

            }

        $get_row_where = array('category_id' => $category_old['category_id']);                    
        $get_row = $this->CRUDModel->get_row('categories', $get_row_where);

        if(!$get_row){

        $req_slug = $get_row_categories_description['slug'];
        $req_title = $get_row_categories_description['meta_title'];
        $req_name = $get_row_categories_description['name'];
        $req_spotlight = $get_row_categories_description['meta_description'];
        $req_description = $get_row_categories_description['description'];
        $req_status = 1;
        $req_searchable = 1;
        $req_listed = 1;
        $req_featured = 1;
        $req_launch_year = 2025;
        $req_published_time = time();
        $req_meta_title = $get_row_categories_description['meta_title'];
        $req_meta_description = $get_row_categories_description['meta_description'];
        $req_meta_keywords = $get_row_categories_description['meta_keyword'];
        $req_today_views = 99;
        $req_lifetime_views = 999;
        $req_today_hits = 99;
        $req_lifetime_hits = 999;
        $req_votes = 99;
        $req_ratings = 5;
        $req_scores = 495;
        $req_likes = 99;

      $do_create_category_data = array('category_id' => $category_old['category_id'], 'slug' => slug_fnc($req_slug), 'title' => $req_title, 'name' => $req_name, 'spotlight' => $req_spotlight, 'description' => $req_description, 'status' => $req_status, 'searchable' => $req_searchable, 'listed' => $req_listed, 'featured' => $req_featured,  'today_views' => $req_today_views, 'lifetime_views' => $req_lifetime_views, 'today_hits' => $req_today_hits, 'lifetime_hits' => $req_lifetime_hits, 'votes' => $req_votes, 'ratings' => $req_ratings, 'scores' => $req_scores, 'likes' => $req_likes, 'launch_year' => $req_launch_year, 'published_time' => $req_published_time, 'meta_title' => $req_meta_title, 'meta_description' => $req_meta_description, 'meta_keywords' => $req_meta_keywords, 'token' => $req_token, 'add_by' => 0, 'add_time' => time(), 'add_ip' => $this->request->getIPAddress());

      $do_create_category_id = $this->CRUDModel->do_create('categories', $do_create_category_data);

      echo $category_old['category_id'].' >> '.$get_row_categories_description['slug'].'<hr/>';

        }

      }

            }


      echo '<hr/>okay';

       exit;

    }



    public function products_old()
    {

      $user_info = $this->_verify_user_area(1);
      $req_token = get_token_fnc(32);

      $get_row_where_product = array('product_id>' => 0);                    
      $get_row_product = $this->CRUDModel->get_result('products', $get_row_where_product);


        foreach ($get_row_product as $product)
            {

       $get_row_where_products_description = array('product_id' => $product['product_id']);                    
        $get_row_products_description = $this->CRUDModel->get_row('products_description', $get_row_where_products_description);       

  if($get_row_products_description){


     $get_row_where_uploads = array('parent_id' => $product['product_id'], 'parent_type' => 'product');                    
      $get_row_uploads = $this->CRUDModel->get_result('uploads_old', $get_row_where_uploads);
      
$uploads_old_path = FCPATH.'public/uploads_old/';

$uploads_path = FCPATH.'public/uploads/';

$sort_order = 1;

      foreach ($get_row_uploads as $upload)
            {  

              $sort_order++;

      $upload_file_old_full = $uploads_old_path.$upload['upload_file'];
      $upload_file = $get_row_products_description['slug'].'-'.$upload['upload_file'];
      $upload_file_full = $uploads_path.$upload_file;

     if(file_exists($upload_file_old_full)) {

     $do_create_data_images =  array('upload_type' => 'image', 'upload_file' => $upload_file, 'parent_id' => $product['product_id'], 'parent_type' => 'items_images', 'sort_order' => $sort_order, 'token' => $req_token, 'add_by' => 0, 'add_time' => time(), 'add_ip' => $this->request->getIPAddress());

      $this->CRUDModel->do_create('uploads', $do_create_data_images);

     echo $upload['upload_id'].' >> '.$upload['upload_file'].' >> '.$upload_file.'<br/>';

      rename($upload_file_old_full, $upload_file_full);
      
      }

            }

    $get_row_where = array('item_id' => $product['product_id']);                    
        $get_row = $this->CRUDModel->get_row('items', $get_row_where);

        if(!$get_row){

        $req_slug = $get_row_products_description['slug'];
        $req_title = $get_row_products_description['meta_title'];
        $req_name = $get_row_products_description['name'];
        $req_spotlight = $get_row_products_description['meta_description'];
        $req_description = $get_row_products_description['description'];
        $req_status = 1;
        $req_searchable = 1;
        $req_listed = 1;
        $req_featured = 1;
        $req_launch_year = 2025;
        $req_published_time = time();
        $req_meta_title = $get_row_products_description['meta_title'];
        $req_meta_description = $get_row_products_description['meta_description'];
        $req_meta_keywords = $get_row_products_description['meta_keyword'];
        $req_model = $product['model'];
        $req_sku = get_token_fnc(2, 'capital_alphabetic').'-'.get_token_fnc(4, 'numbers').'-'.get_token_fnc(2, 'capital_alphabetic');
        $req_mpn = get_token_fnc(2, 'capital_alphabetic').'-'.get_token_fnc(6, 'numbers');
        $req_gtin = get_token_fnc(13, 'numbers');
        $req_price = get_token_fnc(2, 'numbers').'.'.get_token_fnc(2, 'numbers');
        $req_price_previous = $req_price+(get_token_fnc(2, 'numbers').'.'.get_token_fnc(2, 'numbers'));
        $req_today_views = 99;
        $req_lifetime_views = 999;
        $req_today_hits = 99;
        $req_lifetime_hits = 999;
        $req_votes = 99;
        $req_ratings = 5;
        $req_scores = 495;
        $req_likes = 99;

      $do_create_item_data = array('item_id' => $product['product_id'], 'slug' => slug_fnc($req_slug), 'title' => $req_title, 'name' => $req_name, 'spotlight' => $req_spotlight, 'description' => $req_description, 'status' => $req_status, 'searchable' => $req_searchable, 'listed' => $req_listed, 'featured' => $req_featured, 'sku' => $req_sku, 'model' => $req_model, 'mpn' => $req_mpn, 'gtin' => $req_gtin, 'price' => $req_price, 'price_previous' => $req_price_previous, 'today_views' => $req_today_views, 'lifetime_views' => $req_lifetime_views, 'today_hits' => $req_today_hits, 'lifetime_hits' => $req_lifetime_hits, 'votes' => $req_votes, 'ratings' => $req_ratings, 'scores' => $req_scores, 'likes' => $req_likes, 'launch_year' => $req_launch_year, 'published_time' => $req_published_time, 'meta_title' => $req_meta_title, 'meta_description' => $req_meta_description, 'meta_keywords' => $req_meta_keywords, 'token' => $req_token, 'add_by' => 0, 'add_time' => time(), 'add_ip' => $this->request->getIPAddress());

      $do_create__item_id = $this->CRUDModel->do_create('items', $do_create_item_data);

      echo $product['product_id'].' >> '.$get_row_products_description['slug'].'<hr/>';

        }

      }

            }


      echo '<hr/>okay';

       exit;

    }



    public function captcha_image($token='')
    {

      $get_where = ['token' => $token];

      $get_captcha = $this->ToolsModel->get_captcha($get_where);

      if($get_captcha){

      $get_content = captcha_generator_fnc($get_captcha['code']);

      }else{

      $get_content = captcha_generator_fnc('   ');
        
      }

      echo $get_content;
      exit;  
    }

    public function components($component_info)
    {

      if (!isset($component_info) || !is_string($component_info)) {
        die('Invalid input provided.');
      }

      $segments = explode("/", $component_info);

      if (count($segments) < 2) {
          die('Invalid component path format.');
      }

      $read_file = '';
      

      $components_path = FCPATH;
      $new_components_path = FCPATH.'writable/cache/htmls/';
      $full_components_path = FCPATH.$component_info;
      $extension = strtolower(pathinfo($component_info, PATHINFO_EXTENSION)) ?: '';
      $do_cache = array('js', 'css');
      $full_new_components_path = FCPATH.'writable/cache/htmls/'.md5($component_info);

      if (in_array($extension, $do_cache))
    {

      if(file_exists($full_new_components_path)){

      $read_file = $full_new_components_path;

      }else{

      if(file_exists($full_components_path) && is_readable($full_components_path)){

      $component_content = file_get_contents($full_components_path);

      if (!is_dir($new_components_path)) {
            mkdir($new_components_path, 0777, true);
        }

        if ($extension === 'js') {
         $component_content = preg_replace('!/\*.*?\*/!s', ' ', $component_content);
         $component_content = preg_replace('/(^|\s)\/\/\s.*/m', ' ', $component_content);
        } elseif ($extension === 'css') {
         $component_content = preg_replace('!/\*.*?\*/!s', ' ', $component_content); 
        }


        $component_content = str_replace(["\r", "\n", "\r\n"], ' ', $component_content);
        $component_content = preg_replace('/\s+/', ' ', $component_content);
        $component_content = trim($component_content);

        file_put_contents($full_new_components_path, $component_content);


      }else{

        die('Component file not found or not readable.');

      }

    }

    }else{
      

      if(file_exists($full_components_path) && is_readable($full_components_path)){

      $read_file = $full_components_path;

      }else{

        die('Component file not found or not readable.');

      }

    }

    $mime_types = [
    'css'   => 'text/css',
    'js'    => 'application/javascript',
    'map'   => 'application/json',
    'ttf'   => 'font/ttf',
    'woff'  => 'font/woff',
    'woff2' => 'font/woff2',
    'eot'   => 'application/vnd.ms-fontobject',
    'otf'   => 'font/otf',
    'svg'   => 'image/svg+xml'
];

    $content_type = $mime_types[$extension] ?? 'application/octet-stream';

     header("Content-Type: ".$content_type);
     header("Cache-Control: max-age=31536000, public");
     header("Expires: " . gmdate("D, d M Y H:i:s", time() + 31536000) . " GMT");
     header("Pragma: no-cache");
     if(file_exists($read_file) && is_readable($read_file)){
     readfile($read_file);
     }else{
      echo $component_content;
     }

      exit;

    }


    public function images($image_info)
{
    if (!is_string($image_info) || strpos($image_info, '/') === false) {
        return $this->renderErrorImage('Invalid input');
    }
    
    $mode = 'normal';
    $segments = explode('/', $image_info, 3);

    if(count($segments) === 3 && $segments[1] !== 'images'){ 
     [$image_path, $mode, $image_name] = $segments;
    }else{
    [$image_path, $image_name] = $segments;
    }

    $allowed_modes = ['normal', 'auto', 'fix'];
    if (!in_array($mode, $allowed_modes)) {
        return $this->renderErrorImage('Invalid cropping');
    }
   

    $uploads_path = FCPATH . 'public/uploads/';
    $cache_path = FCPATH . 'writable/cache/images/';
    $cache_key = md5($image_path . $mode . $image_name);
    $cached_image = $cache_path . $cache_key;

    $image_extension = strtolower(pathinfo($image_name, PATHINFO_EXTENSION));
    $image_filename = basename($image_name, '.' . $image_extension);

    $mime_map = [
        'jpg' => IMAGETYPE_JPEG, 'jpeg' => IMAGETYPE_JPEG,
        'png' => IMAGETYPE_PNG, 'gif' => IMAGETYPE_GIF,
        'webp' => IMAGETYPE_WEBP, 'bmp' => IMAGETYPE_BMP
    ];
    $IMAGETYPE = $mime_map[$image_extension] ?? IMAGETYPE_JPC;

    $info_parts = explode('-', $image_path);
    if (count($info_parts) < 2 || strpos($info_parts[1], 'x') === false) {
        return $this->renderErrorImage('Invalid format');
    }

    [$old_ext, $size_str] = $info_parts;
    [$new_width, $new_height] = array_map('intval', explode('x', $size_str));
    $source_image = $uploads_path . $image_filename . '.' . $old_ext;

    if (!file_exists($source_image)) {
        return $this->renderErrorImage('Image Not Found');
    }

    if (!file_exists($cached_image)) {
        try {
            $image = service('image', 'gd')->withFile($source_image);
            $orig_w = $image->getWidth();
            $orig_h = $image->getHeight();

            if (!is_dir($cache_path)) {
                mkdir($cache_path, 0777, true);
            }

            if ($new_width === 0 && $new_height === 0) {
                  $image->convert($IMAGETYPE)
                        ->save($cached_image, $this->cc['image_quality']);
              } else {

                  if ($new_width === 0) {
                      $new_width = intval(($new_height / $orig_h) * $orig_w);
                  } elseif ($new_height === 0) {
                      $new_height = intval(($new_width / $orig_w) * $orig_h);
                  }

                  if ($mode === 'auto') {
                      // ✅ AUTO CROP (no stretch)
                      $image->fit($new_width, $new_height, 'center')
                            ->convert($IMAGETYPE)
                            ->save($cached_image, $this->cc['image_quality']);
                  } elseif ($mode === 'fix') {
                      // ✅ FIXED SIZE (stretch)
                      $image->resize($new_width, $new_height, false)
                            ->convert($IMAGETYPE)
                            ->save($cached_image, $this->cc['image_quality']);
                  } else {
                      // ✅ Normal proportional resize
                      $image->resize($new_width, $new_height, true)
                            ->convert($IMAGETYPE)
                            ->save($cached_image, $this->cc['image_quality']);
                  }
              }
        } catch (\CodeIgniter\Images\Exceptions\ImageException $e) {
            return $this->renderErrorImage('Processing Error');
        }
    }

    header('Content-Type: ' . image_type_to_mime_type($IMAGETYPE));
    header('Cache-Control: max-age=31536000, public');
    header('Expires: ' . gmdate('D, d M Y H:i:s', time() + 31536000) . ' GMT');
    header('Pragma: cache');
    readfile($cached_image);
    exit;
}

private function renderErrorImage(string $message)
{

header('Content-Type: image/webp');
header('Cache-Control: no-store, no-cache, must-revalidate, max-age=0');
header('Expires: Thu, 01 Jan 1970 00:00:00 GMT');
header('Pragma: no-cache');

$notfound_image_path = FCPATH.'public/images/notfound.webp';

if (is_file($notfound_image_path)) {  
    readfile($notfound_image_path); 
    exit; 
}

    $width = 250;
    $height = 250;
    $image = imagecreatetruecolor($width, $height);
    $bg = imagecolorallocate($image, 221, 221, 221);
    $fg = imagecolorallocate($image, 255, 0, 0);

    imagefilledrectangle($image, 0, 0, $width, $height, $bg);

    $fontSize = 5;
    $textWidth = imagefontwidth($fontSize) * strlen($message);
    $textHeight = imagefontheight($fontSize);
    $x = ($width - $textWidth) / 2;
    $y = ($height - $textHeight) / 2;

    imagestring($image, $fontSize, $x, $y, $message, $fg);

    
    imagewebp($image);
    imagedestroy($image);
    exit;
}


  

   

}


