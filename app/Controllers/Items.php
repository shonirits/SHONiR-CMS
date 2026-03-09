<?php

namespace App\Controllers;

class Items extends Shonir_Controller
{

    public function __construct() {
        parent::__construct();
    }

    public function index()
    {

        $view_data['page'] = [
            'title' => "Items | ".$this->cc['app_name'],
           'description' => "",
           'keywords' => "",
           'url' => current_url(),
           'type' => "website"
         ];  

       $view_data['cc'] = $this->cc;

        return view('welcome_message', $view_data);

    }


    public function items($type = '', $req_id = '')
    {

      $current_page_id = 'items-'.$type;

     
      $by = [
        'ibc' => 'items_by_category',
        'search' => 'items_by_search',
        'sale'  => 'items_by_sale',
        'featured' => 'items_by_featured',
        'newbie'  => 'items_by_newbie',
        'all'  => 'items_all'
          ];

          

      $items_by = $by[strtolower($type)] ?? 'items_by_trending';

      $db_limit = [
        'items_by_search'  => $this->cc['limit_items_search'],
        'items_by_trending' => $this->cc['limit_items_trending'],
        'items_by_sale'  => $this->cc['limit_items_sale'],
        'items_by_featured' => $this->cc['limit_items_featured'],
        'items_by_newbie'  => $this->cc['limit_items_newbie'],
        'items_all'  => $this->cc['limit_items_all']
          ];
      
        $default_limit = $db_limit[$items_by] ?? $this->cc['limit_items_list'];
        $get_result_where = ''; 
        $get_result_like =  '';

        $page = (int) ($this->request->getGet('page') ?? 1);        
        $limit = (int) ($this->request->getGet('limit') ?? $default_limit);

        $order = $this->request->getGet('order');
        $sort = $this->request->getGet('sort');
        $query = $this->request->getGet('query');

        $order_list = array('item_id' => 'Item ID', 'title' => 'Title', 'name' => 'Name', 'launch_year' => 'Launch Year', 'published_time' => 'Published Time', 'today_views' => 'Today Views', 'lifetime_views' => 'Lifetime Views', 'today_hits' => 'Today Hits', 'lifetime_hits' => 'Lifetime Hits', 'votes' => 'Votes', 'rating' => 'Rating',  'edit_time' => 'Last Edited Time');
        if(!array_key_exists($order, $order_list)){
            $order = 'item_id';
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

        $view_data['page'] = [
            'title' => $this->cc['app_meta_title'].' '.$this->cc['app_name'],
           'description' => $this->cc['app_meta_description'],
           'keywords' => $this->cc['app_meta_keywords'],
           'url' => current_url(),
           'id' => $current_page_id,
           'type' => "website"
         ];


         $view_data['content'] = [
            'title' => $this->cc['app_title'],
           'name' => $this->cc['app_name'],
           'paging' => true
         ];

        if($items_by == 'items_by_category'){

          $view_data['category_id'] = $req_id;

          if($req_id <= 0){

          $get_result_where = "item_id NOT IN (
            SELECT DISTINCT item_id FROM tbl_items_to_categories
        ) AND status = 1 AND listed = 1 AND published_time <= " . time();
          $order = 'last_cart_time';
          $sort = 'DESC';
          $url = $this->cc['base_url'].'ibc.html';

          $view_data['page']['title'] = "Browse Product Categories | " . $this->cc['app_name'];
          $view_data['page']['description'] = 'Explore our full range of product categories including custom apparel, club kits, martial arts gear, leather accessories, and more. Find exactly what you need. ' . $this->cc['app_meta_description'];
          $view_data['page']['keywords'] = 'product categories, custom sportswear, leather goods, martial arts gear, club uniforms, private label, custom manufacturing, wholesale apparel, ' . $this->cc['app_meta_keywords'];

          $view_data['content'] = [
            'title' => 'Browse All Categories',
           'name' => 'Categories',
           'paging' => true
         ];

          }else{

         $get_result_where = "item_id IN (SELECT DISTINCT item_id FROM tbl_items_to_categories WHERE category_id IN ($req_id) AND category_id IN (SELECT category_id FROM tbl_categories WHERE status = 1 AND listed = 1 AND published_time<= ".time().")) AND status = 1 AND listed = 1 AND published_time<= ".time();
        
        $get_row_category_where = array('category_id' => $req_id);                    
        $get_row_category = $this->CRUDModel->get_row('categories', $get_row_category_where);

        if(!$get_row_category){
            throw \CodeIgniter\Exceptions\PageNotFoundException::forPageNotFound(); 
        }

          $url = $this->cc['base_url'].slug2url_fnc('items_by_categories', $get_row_category['category_id'], $get_row_category['slug'], $get_row_category['name']);

           $view_data['page']['title'] = $get_row_category['meta_title'] . " | " . $this->cc['app_name'];
          $view_data['page']['description'] = $get_row_category['meta_description'];
          $view_data['page']['keywords'] = $get_row_category['meta_keywords'];

          $view_data['content'] = [
            'title' => $get_row_category['title'],
           'name' => $get_row_category['name'],
           'paging' => true
         ];

        }

        }


        if($items_by == 'items_by_search'){

          $get_result_where = " status = 1 AND listed = 1 AND published_time<= ".time();
          $order = 'lifetime_hits';
          $sort = 'ASC';
          $url = $this->cc['base_url'].'search.html?query='.$query;

          if($query){
            $get_result_like = array("LOWER(model)" => strtolower($query), "LOWER(sku)" => strtolower($query), "LOWER(mpn)" => strtolower($query), "LOWER(gtin)" => strtolower($query), "LOWER(price)" => strtolower($query), "LOWER(price_previous)" => strtolower($query), "LOWER(slug)" => strtolower($query), "LOWER(name)" => strtolower($query), "LOWER(title)" => strtolower($query), "LOWER(description)" => strtolower($query), "LOWER(spotlight)" => strtolower($query), "LOWER(meta_title)" => strtolower($query), "LOWER(meta_description)" => strtolower($query), "LOWER(meta_keywords)" => strtolower($query));          
         }

          $view_data['page']['title'] = 'Search Results for '.$query . " | " . $this->cc['app_name'];
          $view_data['page']['description'] = $query . '. ' . $this->cc['app_meta_description'];
          $view_data['page']['keywords'] = paragraph2keywords_fnc($query) . ', ' . $this->cc['app_meta_keywords'];

          $view_data['content'] = [
            'title' => 'Search Results for '.$query,
           'name' => 'Search Products',
           'paging' => true
         ];
         
        }


        if($items_by == 'items_by_sale'){
          $get_result_where = "price_previous > price AND status = 1 AND listed = 1 AND published_time<= ".time();
          $order = 'lifetime_hits';
          $sort = 'ASC';
          $url = $this->cc['base_url'].'sale.html';

          $view_data['page']['title'] = "Exclusive OnSale Deals | Huge Discounts & Limited Offers | " . $this->cc['app_name'];
          $view_data['page']['description'] = 'Shop the best OnSale deals! Limited-time discounts on top products. Grab your savings before they’re gone!. ' . $this->cc['app_meta_description'];
          $view_data['page']['keywords'] = 'OnSale, discounts, deals, limited-time offers, best prices, sale items, ' . $this->cc['app_meta_keywords'];

          $view_data['content'] = [
            'title' => 'Limited-Time Offers on Top Products',
           'name' => 'OnSale Products',
           'paging' => false
         ];

        }


        if($items_by == 'items_by_featured'){
          $get_result_where = "featured = 1 AND status = 1 AND listed = 1 AND published_time<= ".time();
          $order = 'lifetime_views';
          $sort = 'ASC';
          $url = $this->cc['base_url'].'featured.html';

          $view_data['page']['title'] = "Featured Items  Top Picks & Best-Selling Products | " . $this->cc['app_name'];
          $view_data['page']['description'] = 'Discover our featured items! Handpicked top-rated products, best sellers, and exclusive deals. Find the perfect choice today!. ' . $this->cc['app_meta_description'];
          $view_data['page']['keywords'] = 'featured items, top picks, best sellers, trending products, exclusive deals, must-have items, ' . $this->cc['app_meta_keywords'];

          $view_data['content'] = [
            'title' => 'Discover Our Most Popular & Highly Rated Selections',
           'name' => 'Featured Products',
           'paging' => false
         ];
          
        }


        if($items_by == 'items_by_newbie'){
          $get_result_where = "newbie = 1 AND status = 1 AND listed = 1 AND published_time<= ".time();
          $order = 'published_time';
          $sort = 'DESC';
          $url = $this->cc['base_url'].'newbie.html';

          $view_data['page']['title'] = "Newbie Items  Fresh Arrivals & Latest Trends | " . $this->cc['app_name'];
          $view_data['page']['description'] = 'Explore our newest additions! Fresh arrivals, trending products, and must-have items for every shopper. Stay ahead with the latest picks!. ' . $this->cc['app_meta_description'];
          $view_data['page']['keywords'] = 'newbie items, new arrivals, latest trends, fresh products, trending items, must-have picks, ' . $this->cc['app_meta_keywords'];

          $view_data['content'] = [
            'title' => 'Discover the Newest Additions to Our Collection',
           'name' => 'Newbie Products',
           'paging' => false
         ];

        }

        if($items_by == 'items_by_trending'){
          $get_result_where = "status = 1 AND listed = 1 AND published_time<= ".time();
          $order = 'last_hit_time';
          $sort = 'DESC';
          $url = $this->cc['base_url'].'trending.html';

          $view_data['page']['title'] = "Trending Items  Hottest Picks & Most Popular Products | " . $this->cc['app_name'];
          $view_data['page']['description'] = 'Discover the latest trending items! Stay ahead with the most popular products, top-rated choices, and must-have deals. ' . $this->cc['app_meta_description'];
          $view_data['page']['keywords'] = 'trending items, popular products, best sellers, top-rated, hot picks, latest trends, must-have deals, ' . $this->cc['app_meta_keywords'];

          $view_data['content'] = [
            'title' => 'Discover What\'s Trending Right Now',
           'name' => 'OnTrending Products',
           'paging' => false
         ];

        }


        if($items_by == 'items_all'){
          $get_result_where = "status = 1 AND listed = 1 AND published_time<= ".time();
          $order = 'last_cart_time';
          $sort = 'DESC';
          $url = $this->cc['base_url'].'all.html';

          $view_data['page']['title'] = "All Items – Explore Full Range of Custom Products | " . $this->cc['app_name'];
          $view_data['page']['description'] = 'Browse the complete collection of custom sportswear, leather goods, club kits, martial arts apparel, and accessories tailored to your specs. ' . $this->cc['app_meta_description'];
          $view_data['page']['keywords'] = 'all items, full product range, custom apparel, sportswear collection, leather goods, club uniforms, martial arts gear, private label manufacturing, ' . $this->cc['app_meta_keywords'];

          $view_data['content'] = [
            'title' => 'Explore Our Complete Product Range',
           'name' => 'All Products',
           'paging' => true
         ];

        }

        $view_data['content']['by'] = strtolower($type);

        $total_records = $this->CRUDModel->do_count('items', $get_result_where, $get_result_like);

        $start = ($page-1)*$limit;

         $get_result_select = "tbl_items.*,  
        (SELECT upload_file FROM tbl_uploads  
         WHERE upload_type = 'image'  
         AND parent_type = 'items_images'  
         AND parent_id = tbl_items.item_id  
         ORDER BY sort_order ASC LIMIT 1) AS upload_file,
         
        (SELECT upload_id FROM tbl_uploads  
         WHERE upload_type = 'image'  
         AND parent_type = 'items_images'  
         AND parent_id = tbl_items.item_id  
         ORDER BY sort_order ASC LIMIT 1) AS upload_id,

        (SELECT upload_file FROM tbl_uploads  
         WHERE upload_type = 'image'  
         AND parent_type = 'items_images'  
         AND parent_id = tbl_items.item_id  
         ORDER BY sort_order ASC LIMIT 1 OFFSET 1) AS upload_file2,
         
        (SELECT upload_id FROM tbl_uploads  
         WHERE upload_type = 'image'  
         AND parent_type = 'items_images'  
         AND parent_id = tbl_items.item_id  
         ORDER BY sort_order ASC LIMIT 1 OFFSET 1) AS upload_id2";

        $get_result = ($total_records > 0)?$this->CRUDModel->get_result('items', $get_result_where, $get_result_select, $order.' '.$sort, $limit, $start, $get_result_like):false;

         if (!empty($get_result)) {

          $get_result_update_item_ids = array_column($get_result, 'item_id');

          if (!empty($get_result_update_item_ids)) {

              $get_result_update_where = [
                  'item_id' => $get_result_update_item_ids
              ];

              $get_result_update_data = [
                  'today_views'    => 'today_views + 1',
                  'last_view_time' => time()
              ];

              $this->CRUDModel->do_update(
                  'items',  
                  $get_result_update_where,
                  $get_result_update_data,
                  false
              );
          }

          }


        $micro_items = '';
        $json_items = '';

        if($get_result){

          $count = count($get_result);
          $i = 0;

        foreach($get_result as $result){

              $json_items .= '{
                            "@type": "ListItem",
                            "position": '.($i+1).',
                            "item": {
                              "@type": "Product",
                              "name": "'.data2json_fnc($result['meta_title']).'",
                              "description": "'.data2json_fnc($result['meta_description']).'",
                              "image": "'.$this->cc['img_url'].display_image_fnc('webp-0x0', $result['upload_file'], $this->cc['cache_image'], $this->cc['image_original']).'",
                              "url": "'.$this->cc['base_url'].slug2url_fnc('items_details', $result['item_id'], $result['slug'], $result['meta_title']).'",
                              "aggregateRating": {
                              "@type": "AggregateRating",
                              "ratingValue": '.$result['ratings'].',
                              "reviewCount": '.$result['votes'].',
                              "bestRating": 5
                            }
                            }
                              
                          }';


          $micro_items .= '<div itemprop="itemListElement" itemscope itemtype="https://schema.org/ListItem">
        <meta itemprop="position" content="'.($i+1).'">
        <div itemprop="item" itemscope itemtype="https://schema.org/Product">
            <meta itemprop="name" content="'.data2json_fnc($result['meta_title']).'">
            <meta itemprop="description" content="'.data2json_fnc($result['meta_description']).'">
            <link itemprop="image" href="'.$this->cc['img_url'].display_image_fnc('webp-0x0', $result['upload_file'], $this->cc['cache_image'], $this->cc['image_original']).'">
            <link itemprop="url" href="'.$this->cc['base_url'].slug2url_fnc('items_details', $result['item_id'], $result['slug'], $result['meta_title']).'">
            <div itemprop="aggregateRating" itemscope itemtype="https://schema.org/AggregateRating">
                <meta itemprop="ratingValue" content="'.$result['ratings'].'">
                <meta itemprop="reviewCount" content="'.$result['votes'].'">
                <meta itemprop="bestRating" content="5">
            </div>
        </div>
    </div>';

              if (++$i < $count) {
            $json_items .= ',';
            }

        }

        if($json_items){
           $json_items = '['. $json_items.']';
        }else{
           $json_items = 'null';
        }


        }


        $view_data['structured_data'] = '

      <script type="application/ld+json">

{
  "@context": "https://schema.org",
  "@type": "ItemList",
  "name": "'.data2json_fnc($view_data['page']['title']).'",
  "description": "'.data2json_fnc($view_data['page']['description']).'",
  "url": "'.$view_data['page']['url'].'",
  "itemListElement": '.$json_items.'
}

      </script>
      
 <div itemscope itemtype="https://schema.org/ItemList">
    <meta itemprop="name" content="'.data2json_fnc($view_data['page']['title']).'">
    <meta itemprop="description" content="'.data2json_fnc($view_data['page']['description']).'">
    <link itemprop="url" href="'.$view_data['page']['url'].'">
        '.$micro_items.'
    </div>';


        $view_data['pagination'] = ($total_records > 0)?pagination_fnc($get_result, $total_records, $limit, $page, $url):false; 
        
        $view_data['order_list'] = $order_list;
        $view_data['sort_list'] = $sort_list;
        $view_data['limit_list'] = $limit_list;
        $view_data['order'] = $order;
        $view_data['sort'] = $sort;
        $view_data['limit'] = $limit;
        $view_data['query'] = $query;
  

      if (!empty($get_result_update_item_ids)) {
        $get_result_update_items = implode(',', array_map('intval', $get_result_update_item_ids));
        $random_where = "item_id NOT IN ($get_result_update_items) AND status = 1 AND published_time <= " . time();
        } else {
          $random_where = "status = 1 AND published_time <= " . time();
      }

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


         $view_data['cc'] = $this->cc;

      
         if($this->cc['cache_time'] > 0){
       $this->cachePage($this->cc['cache_time']);
       }
      
        return view('frontend/'.$this->cc['frontend_theme'].'/items', $view_data);
        

    }


    public function details($req_id = 0)
    {

      $current_page_id = 'item_'.$req_id;

         $get_row_where = array('item_id' => $req_id, 'status' => 1, 'published_time<=' => time());                    
        $get_row = $this->CRUDModel->get_row('items', $get_row_where);

        if(!$get_row){

            throw \CodeIgniter\Exceptions\PageNotFoundException::forPageNotFound(); 

        }


        $next_previous_base_where = ['status' => 1, 'published_time <=' => time()];
        $next_previous_select = 'item_id, name, slug';

        $next = $this->CRUDModel->get_row(
            'items',
            array_merge($next_previous_base_where, ['item_id >' => $req_id]),
            $next_previous_select,
            'published_time ASC'
        );

        $previous = $this->CRUDModel->get_row(
            'items',
            array_merge($next_previous_base_where, ['item_id <' => $req_id]),
            $next_previous_select,
            'published_time DESC'
        );

        if (!$next) {
            $next = $this->CRUDModel->get_row(
                'items',
                $next_previous_base_where,
                $next_previous_select,
                'published_time ASC'
            );
        }
        if (!$previous) {
            $previous = $this->CRUDModel->get_row(
                'items',
                $next_previous_base_where,
                $next_previous_select,
                'published_time DESC'
            );
        }

        if ($next && $next['item_id'] == $req_id) $next = null;
        if ($previous && $previous['item_id'] == $req_id) $previous = null;

        $view_data['next'] = $next;
        $view_data['previous'] = $previous;


        if($this->cc['ratings'] == 'TRUE'){

        $get_row_ratings_where = array('parent_id' => $req_id, 'parent_type' => 'item'); 
        
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

        $get_row_likes_where = array('parent_id' => $req_id, 'parent_type' => 'item'); 
        
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

    $do_update_where = array('item_id' => $req_id);
        $do_update_data = array('last_hit_time' => time(), 'last_view_time' => time(), 'today_views' => $get_row['today_views']+1, 'today_hits' => $get_row['today_hits']+1, 'lifetime_views' => $get_row['lifetime_views']+1, 'lifetime_hits' => $get_row['lifetime_hits']+1);

     if(date("d/m/Y", $get_row['statistics_update']) != date("d/m/Y")){
          $do_update_data['statistics_update'] = time();
          $do_update_data['today_views'] = 1;
          $do_update_data['today_hits'] = 1;
          $do_update_data['today_carts'] = 1;
        }

        $do_update = $this->CRUDModel->do_update('items', $do_update_where, $do_update_data);


        $get_row_where_images = array('parent_id' => $req_id, 'parent_type' => 'items_images');                    
        $view_data['images'] = $this->CRUDModel->get_result('uploads', $get_row_where_images, '', 'sort_order ASC');

        $get_row_where_gallery = array('parent_id' => $req_id, 'parent_type' => 'items_gallery');                    
        $view_data['gallery'] = $this->CRUDModel->get_result('uploads', $get_row_where_gallery, '', 'sort_order ASC');

         $get_row['description'] = replace_placeholders_fnc(
                $get_row['description'],
                $view_data['images'],
                $view_data['gallery'],
                $this->cc['base_url'],
                $this->cc['img_url'],
                $this->cc['cache_image']
            );

        $parents_categories_where = "category_id IN (SELECT DISTINCT category_id FROM tbl_items_to_categories WHERE item_id = ".$req_id.")";
        $parents_categories_select = "category_id, title, name, slug";
        $parents_categories = $this->CRUDModel->get_result('categories', $parents_categories_where, $parents_categories_select);

        $items_to_categories = array_column($parents_categories, 'category_id');

        $view_data['parents_categories'] = $parents_categories;  

        $parents_sections_where = "section_id IN (SELECT DISTINCT section_id FROM tbl_items_to_sections WHERE item_id = ".$req_id.")";
        $parents_sections_select = "section_id, title, name, slug";
        $parents_sections = $this->CRUDModel->get_result('sections', $parents_sections_where, $parents_sections_select);

        $view_data['parents_sections'] = $parents_sections;

        $parents_brands_where = "brand_id IN (SELECT DISTINCT brand_id FROM tbl_items_to_brands WHERE item_id = ".$req_id.")";
        $parents_brands_select = "brand_id, title, name, slug";
        $parents_brands = $this->CRUDModel->get_result('brands', $parents_brands_where, $parents_brands_select);

        $view_data['parents_brands'] = $parents_brands;

        if (!empty($items_to_categories)) {
        $in_the_same_categories = implode(',', $items_to_categories);
        $in_the_same_where = "item_id IN (SELECT DISTINCT item_id FROM tbl_items_to_categories WHERE category_id IN ($in_the_same_categories)) AND status = 1 AND published_time<= ".time()." AND item_id != ".$req_id;
        } else {
            $in_the_same_where = "item_id NOT IN (SELECT DISTINCT item_id FROM tbl_items_to_categories) AND status = 1 AND published_time<= ".time()." AND item_id != ".$req_id;
        }

        $in_the_same_items = $this->CRUDModel->get_items($in_the_same_where, '', $this->cc['limit_items_same']);

        $view_data['in_the_same_items'] = $in_the_same_items;

        $in_the_same_items_id = array_column($in_the_same_items, 'item_id');
        $excluded_in_the_same_items = implode(',', $in_the_same_items_id);

                if (!empty($excluded_in_the_same_items)) {
            $excluded_items_condition = "item_id NOT IN ($excluded_in_the_same_items) AND ";
        } else {
            $excluded_items_condition = ""; 
        }


        if (!empty($items_to_categories)) {
            $related_where = "$excluded_items_condition 
                               item_id IN (SELECT DISTINCT item_id FROM tbl_items_to_categories 
                              WHERE category_id NOT IN ($in_the_same_categories)) 
                              AND status = 1 AND published_time <= ".time()." AND item_id != ".$req_id;
        } else {
           
            $related_where = "$excluded_items_condition
                               item_id NOT IN (SELECT DISTINCT item_id FROM tbl_items_to_categories) 
                              AND status = 1 AND published_time <= ".time()." AND item_id != ".$req_id;
        }

        $related_items = $this->CRUDModel->get_items($related_where, '', $this->cc['limit_items_related']);

        $view_data['related_items'] = $related_items;      

        $all_excluded_items = array_merge($in_the_same_items_id, array_column($related_items, 'item_id'));
        $random_excluded_items = implode(',', $all_excluded_items);

        if (!empty($random_excluded_items)) {
        $random_where = "item_id NOT IN ($random_excluded_items) AND status = 1 AND published_time <= " . time()." AND item_id != ".$req_id;
        } else {
          $random_where = "status = 1 AND published_time <= " . time()." AND item_id != ".$req_id;
      }       

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

        
         $view_data['page'] = [
            'title' => $get_row['model']." - ".$get_row['meta_title']." | ".$this->cc['app_name'],
           'description' => $get_row['model'].", ".$get_row['meta_description'],
           'keywords' => $get_row['model'].", ".$get_row['meta_keywords'],
           'url' => current_url(),
           'id' => $current_page_id,
           'type' => "website"
         ];  

       $view_data['cc'] = $this->cc;
       $view_data['row'] = $get_row;

$all_images = [];

foreach (['images', 'gallery'] as $type) {
    if (!empty($view_data[$type])) {
        foreach ($view_data[$type] as $img) {
            $all_images[] = $this->cc['img_url'] . display_image_fnc('webp-0x0', $img['upload_file']);
        }
    }
}

$base_where = ['status' => 1, 'published_time <=' => time()];
$select = 'item_id, meta_title, slug';

$next = $this->CRUDModel->get_row('items', array_merge($base_where, ['item_id >' => $get_row['item_id']]), $select, 'item_id ASC');
if (!$next) $next = $this->CRUDModel->get_row('items', $base_where, $select, 'item_id ASC');
if ($next && $next['item_id'] == $get_row['item_id']) $next = null;

$previous = $this->CRUDModel->get_row('items', array_merge($base_where, ['item_id <' => $get_row['item_id']]), $select, 'item_id DESC');
if (!$previous) $previous = $this->CRUDModel->get_row('items', $base_where, $select, 'item_id DESC');
if ($previous && $previous['item_id'] == $get_row['item_id']) $previous = null;

$item_url = $this->cc['base_url'] . slug2url_fnc('items_details', $get_row['item_id'], $get_row['slug'], $get_row['meta_title']);
$next_url = $next ? $this->cc['base_url'] . slug2url_fnc('items_details', $next['item_id'], $next['slug'], $next['meta_title']) : '';
$prev_url = $previous ? $this->cc['base_url'] . slug2url_fnc('items_details', $previous['item_id'], $previous['slug'], $previous['meta_title']) : '';

$section_title = !empty($parents_sections) ? implode(' > ', array_column($parents_sections, 'title')) : '';
$brand_title = !empty($parents_brands) ? implode(', ', array_column($parents_brands, 'title')) : '';

$structured_data = [
    "@context" => "https://schema.org/",
    "@type" => "Product",
    "name" => $get_row['meta_title'],
    "description" => $get_row['meta_description'],
    "image" => $all_images,
    "sku" => $get_row['sku'],
    "mpn" => $get_row['mpn'],
    "category" => $section_title,
    "gtin13" => $get_row['gtin'],
    "brand" => ["@type" => "Brand", "name" => $brand_title],
    "offers" => [
        "@type" => "Offer",
        "url" => $item_url,
        "price" => $get_row['price'],
        "priceCurrency" => "USD",
        "availability" => "https://schema.org/InStock",
        "itemCondition" => "https://schema.org/NewCondition",
        "priceValidUntil" => date("Y-m-d", strtotime("+7 days")),
        "seller" => ["@type"=>"Organization","name"=>$this->cc['app_name'],"url"=>$this->cc['base_url']],
        "priceSpecification" => ["@type"=>"PriceSpecification","price"=>$get_row['price'],"priceCurrency"=>"USD","valueAddedTaxIncluded"=>true,"maxPrice"=>$get_row['price_previous']],
        "hasMerchantReturnPolicy" => ["@type"=>"MerchantReturnPolicy","applicableCountry"=>"Worldwide","returnPolicyCountry"=>"Worldwide","returnPolicyCategory"=>"https://schema.org/MerchantReturnFiniteReturnWindow","merchantReturnDays"=>90,"returnMethod"=>"https://schema.org/ReturnByMail","returnFees"=>"https://schema.org/FreeReturn"],
        "shippingDetails" => ["@type"=>"OfferShippingDetails","shippingRate"=>["@type"=>"MonetaryAmount","value"=>0,"currency"=>"USD"],"shippingDestination"=>[["@type"=>"DefinedRegion","addressCountry"=>"Worldwide"]],"deliveryTime"=>["@type"=>"ShippingDeliveryTime","handlingTime"=>["@type"=>"QuantitativeValue","minValue"=>0,"maxValue"=>1,"unitCode"=>"DAY"],"transitTime"=>["@type"=>"QuantitativeValue","minValue"=>1,"maxValue"=>5,"unitCode"=>"DAY"]]]
    ],
    "aggregateRating" => ["@type"=>"AggregateRating","ratingValue"=>$get_row['ratings'],"reviewCount"=>$get_row['votes'],"bestRating"=>5],
    "additionalProperty" => [
        ["@type"=>"PropertyValue","name"=>"age_group","value"=>"Adult"],
        ["@type"=>"PropertyValue","name"=>"gender","value"=>"Unisex"],
        ["@type"=>"PropertyValue","name"=>"color","value"=>"Multicolor"]
    ],
    "mainEntityOfPage" => $item_url,
    "isRelatedTo" => array_filter([$prev_url ? ["@type"=>"Product","url"=>$prev_url] : null, $next_url ? ["@type"=>"Product","url"=>$next_url] : null])
];

$json_ld = '<script type="application/ld+json">'.json_encode($structured_data, JSON_UNESCAPED_SLASHES | JSON_UNESCAPED_UNICODE).'</script>';

$micro_images = '';
foreach ($all_images as $img) {
    $micro_images .= '<meta itemprop="image" content="'.$img.'" />';
}

$related_links = '';
if ($prev_url) $related_links .= '<link itemprop="isRelatedTo" href="'.$prev_url.'"/>';
if ($next_url) $related_links .= '<link itemprop="isRelatedTo" href="'.$next_url.'"/>';

$view_data['structured_data'] = $json_ld . '

<div itemscope itemtype="https://schema.org/Product">
    <meta itemprop="name" content="'.htmlspecialchars($get_row['meta_title'], ENT_QUOTES).'"/>
    <meta itemprop="description" content="'.htmlspecialchars($get_row['meta_description'], ENT_QUOTES).'"/>
    <meta itemprop="sku" content="'.$get_row['sku'].'"/>
    <meta itemprop="mpn" content="'.$get_row['mpn'].'"/>
    <meta itemprop="category" content="'.htmlspecialchars($section_title, ENT_QUOTES).'"/>
    <meta itemprop="gtin13" content="'.$get_row['gtin'].'"/>
    <div itemprop="brand" itemscope itemtype="https://schema.org/Brand">
        <meta itemprop="name" content="'.htmlspecialchars($brand_title, ENT_QUOTES).'"/>
    </div>
    '.$micro_images.'

    <link itemprop="url" href="'.$item_url.'"/>
    '.$related_links.'
</div>
';

         if($this->cc['cache_time'] > 0){
       $this->cachePage($this->cc['cache_time']);
       }
      
        return view('frontend/'.$this->cc['frontend_theme'].'/items_details', $view_data);        

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

        $order_list = array('item_id' => 'Item ID', 'title' => 'Title', 'name' => 'Name', 'launch_year' => 'Launch Year', 'published_time' => 'Published Time', 'today_views' => 'Today Views', 'lifetime_views' => 'Lifetime Views', 'today_hits' => 'Today Hits', 'lifetime_hits' => 'Lifetime Hits', 'votes' => 'Votes', 'rating' => 'Rating',  'edit_time' => 'Last Edited Time');
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
            $get_result_like = array("LOWER(item_id)" => strtolower($query), "LOWER(model)" => strtolower($query), "LOWER(sku)" => strtolower($query), "LOWER(mpn)" => strtolower($query), "LOWER(gtin)" => strtolower($query), "LOWER(price)" => strtolower($query), "LOWER(price_previous)" => strtolower($query), "LOWER(slug)" => strtolower($query), "LOWER(name)" => strtolower($query), "LOWER(title)" => strtolower($query), "LOWER(description)" => strtolower($query), "LOWER(spotlight)" => strtolower($query), "LOWER(meta_title)" => strtolower($query), "LOWER(meta_description)" => strtolower($query), "LOWER(meta_keywords)" => strtolower($query));          
         }

        if($limit < $default_limit || $page < 1){
            $alert_data['alert'] = ['type' => 'error', 'message' => "The requested record was not found"];
             $this->session->set($alert_data);
             return redirect()->to($this->cc['base_url'].'Items/list');
           }

        $view_data['page'] = [
            'title' => "List | Items | ".$this->cc['app_name'],
           'description' => "",
           'keywords' => "",
           'url' => current_url(),
           'type' => "website"
         ];         

        $total_records = $this->CRUDModel->do_count('items', $get_result_where, $get_result_like);

        $start = ($page-1)*$limit;

        $get_result = ($total_records > 0)?$this->CRUDModel->get_result('items', $get_result_where, '', $order.' '.$sort, $limit, $start, $get_result_like):false;

        $url = $this->cc['base_url'].'Items/list?query='.$query.'&order='.$order.'&sort='.$sort.'&limit='.$limit;

        $view_data['pagination'] = ($total_records > 0)?pagination_fnc($get_result, $total_records, $limit, $page, $url):false; 
        
        $view_data['order_list'] = $order_list;
        $view_data['sort_list'] = $sort_list;
        $view_data['limit_list'] = $limit_list;
        $view_data['order'] = $order;
        $view_data['sort'] = $sort;
        $view_data['limit'] = $limit;
        $view_data['query'] = $query;
  
        $view_data['cc'] = $this->cc;

        return view('backend/'.$this->cc['backend_theme'].'/items_list', $view_data);

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

        $get_row_where = array('item_id' => $req_id);                    
        $get_row = $this->CRUDModel->get_row('items', $get_row_where);

        if(!$get_row){

            $alert_data['alert'] = ['type' => 'error', 'message' => "The record id# ".$req_id." was not found"];
             $this->session->set($alert_data);

             return redirect()->to($this->cc['base_url'].'Items/list');

        }else{

          if($get_row['removable'] != 1){

            $alert_data['alert'] = ['type' => 'error', 'message' => "The record id# ".$req_id." was not removable"];
             $this->session->set($alert_data);

             return redirect()->to($this->cc['base_url'].'Items/list');

          }else{        
          
        $uploads_path = FCPATH.'public/uploads/';

        $get_row_where_images = array('parent_id' => $req_id, 'parent_type' => 'items_images');                    
        $get_result_images = $this->CRUDModel->get_result('uploads', $get_row_where_images);

        $get_row_where_gallery = array('parent_id' => $req_id, 'parent_type' => 'items_gallery');                    
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

        $this->CRUDModel->do_delete('items', $get_row_where);
        $this->CRUDModel->do_delete('items_to_categories', $get_row_where);
        $this->CRUDModel->do_delete('items_to_sections', $get_row_where);
        $this->CRUDModel->do_delete('items_to_brands', $get_row_where);
            
        $alert_data['alert'] = ['type' => 'success', 'message' => "The record id# ".$req_id." has been deleted successfully"];
        $this->session->set($alert_data);

        return redirect()->to($this->cc['base_url'].'Items/list');
        }

      }

    }


    public function edit()
    {

      $GLOBALS['HTMLS_CACHE'] = false;

        $user_info = $this->_verify_user_area(1);

        $req_id = $this->request->getGet('id');

        $get_row_where = array('item_id' => $req_id);                    
        $get_row = $this->CRUDModel->get_row('items', $get_row_where);

        if(!$get_row){

            $alert_data['alert'] = ['type' => 'error', 'message' => "The requested record id# ".$req_id." was not found"];
             $this->session->set($alert_data);

             return redirect()->to($this->cc['base_url'].'Items/list');

        }else{

        $get_row_where_images = array('parent_id' => $req_id, 'parent_type' => 'items_images');                    
        $get_result_images = $this->CRUDModel->get_result('uploads', $get_row_where_images);

        $get_row_where_gallery = array('parent_id' => $req_id, 'parent_type' => 'items_gallery');                    
        $get_result_gallery = $this->CRUDModel->get_result('uploads', $get_row_where_gallery);

            $var_where_items_to_categories = ['item_id' => $req_id];
            $var_select_items_to_categories = 'category_id';

            $var_db_items_to_categories = $this->CRUDModel->get_result(
                'items_to_categories',
                $var_where_items_to_categories,
                $var_select_items_to_categories
            );

            $linked_category_ids = array_column($var_db_items_to_categories, 'category_id');


            $var_db_categories = [];
            if (!empty($linked_category_ids)) {
                $var_db_categories = $this->CRUDModel->get_result(
                    'categories',
                    ['category_id' => $linked_category_ids]
                );
            }

        
        $var_where_items_to_sections = ['item_id' => $req_id];
        $var_select_items_to_sections = 'section_id';

        $var_db_items_to_sections = $this->CRUDModel->get_result(
            'items_to_sections',
            $var_where_items_to_sections,
            $var_select_items_to_sections
        );

        $linked_section_ids = array_column($var_db_items_to_sections, 'section_id');

        $var_db_sections = [];
        if (!empty($linked_section_ids)) {
            $var_db_sections = $this->CRUDModel->get_result(
                'sections',
                ['section_id' => $linked_section_ids] 
            );
        }



        $var_where_items_to_brands = ['item_id' => $req_id];
        $var_select_items_to_brands = 'brand_id';

        $var_db_items_to_brands = $this->CRUDModel->get_result(
            'items_to_brands',
            $var_where_items_to_brands,
            $var_select_items_to_brands
        );

        $linked_brand_ids = array_column($var_db_items_to_brands, 'brand_id');

        $var_db_brands = [];
        if (!empty($linked_brand_ids)) {
            $var_db_brands = $this->CRUDModel->get_result(
                'brands',
                ['brand_id' => $linked_brand_ids]
            );
        }


        $var_where_items_to_awards = ['item_id' => $req_id];
        $var_select_items_to_awards = 'award_id';
        $var_db_items_to_awards = $this->CRUDModel->get_result('items_to_awards', $var_where_items_to_awards, $var_select_items_to_awards);
        $linked_award_ids = array_column($var_db_items_to_awards, 'award_id');
        $var_db_awards = [];
        if (!empty($linked_award_ids)) {
            $var_db_awards = $this->CRUDModel->get_result('awards', ['award_id' => $linked_award_ids]);
        }

        $var_where_items_to_industries = ['item_id' => $req_id];
        $var_select_items_to_industries = 'industry_id';
        $var_db_items_to_industries = $this->CRUDModel->get_result('items_to_industries', $var_where_items_to_industries, $var_select_items_to_industries);
        $linked_industry_ids = array_column($var_db_items_to_industries, 'industry_id');
        $var_db_industries = [];
        if (!empty($linked_industry_ids)) {
            $var_db_industries = $this->CRUDModel->get_result('industries', ['industry_id' => $linked_industry_ids]);
        }

        $var_where_items_to_natives = ['item_id' => $req_id];
        $var_select_items_to_natives = 'native_id';
        $var_db_items_to_natives = $this->CRUDModel->get_result('items_to_natives', $var_where_items_to_natives, $var_select_items_to_natives);
        $linked_native_ids = array_column($var_db_items_to_natives, 'native_id');
        $var_db_natives = [];
        if (!empty($linked_native_ids)) {
            $var_db_natives = $this->CRUDModel->get_result('natives', ['native_id' => $linked_native_ids]);
        }

        $var_where_items_to_places = ['item_id' => $req_id];
        $var_select_items_to_places = 'place_id';
        $var_db_items_to_places = $this->CRUDModel->get_result('items_to_places', $var_where_items_to_places, $var_select_items_to_places);
        $linked_place_ids = array_column($var_db_items_to_places, 'place_id');
        $var_db_places = [];
        if (!empty($linked_place_ids)) {
            $var_db_places = $this->CRUDModel->get_result('places', ['place_id' => $linked_place_ids]);
        }

        $var_where_items_to_regions = ['item_id' => $req_id];
        $var_select_items_to_regions = 'region_id';
        $var_db_items_to_regions = $this->CRUDModel->get_result('items_to_regions', $var_where_items_to_regions, $var_select_items_to_regions);
        $linked_region_ids = array_column($var_db_items_to_regions, 'region_id');
        $var_db_regions = [];
        if (!empty($linked_region_ids)) {
            $var_db_regions = $this->CRUDModel->get_result('regions', ['region_id' => $linked_region_ids]);
        }

        $var_where_items_to_voices = ['item_id' => $req_id];
        $var_select_items_to_voices = 'voice_id';
        $var_db_items_to_voices = $this->CRUDModel->get_result('items_to_voices', $var_where_items_to_voices, $var_select_items_to_voices);
        $linked_voice_ids = array_column($var_db_items_to_voices, 'voice_id');
        $var_db_voices = [];
        if (!empty($linked_voice_ids)) {
            $var_db_voices = $this->CRUDModel->get_result('voices', ['voice_id' => $linked_voice_ids]);
        }

        $var_db_items_to_actors = [];
        $var_db_items_to_actresses = [];
        $var_db_items_to_directors = [];
        $var_db_items_to_producers = [];
        $var_db_items_to_writers = [];
        $var_db_items_to_singers = [];
        $var_db_items_to_designers = [];
        $var_db_items_to_editors = [];
        $var_db_items_to_cinematographers = [];

        $var_db_actors = [];
        $var_db_actresses = [];
        $var_db_directors = [];
        $var_db_producers = [];
        $var_db_writers = [];
        $var_db_singers = [];
        $var_db_designers = [];
        $var_db_editors = [];
        $var_db_cinematographers = [];

        $talent_types = talent_types_fnc();

        foreach ($talent_types as $key => $type_data) {
            $type_id = $type_data['id'];

            $var_where_items_to_talents = ['item_id' => $req_id, 'type_id' => $type_id];
            $var_select_items_to_talents = 'talent_id';

            ${'var_db_items_to_' . $key} = $this->CRUDModel->get_result(
                'items_to_talents',
                $var_where_items_to_talents,
                $var_select_items_to_talents
            );

            $linked_talent_ids = array_column(${'var_db_items_to_' . $key}, 'talent_id');

            if (!empty($linked_talent_ids)) {
                ${'var_db_' . $key} = $this->CRUDModel->get_result(
                    'talents',
                    ['talent_id' => $linked_talent_ids]
                );
            }
        }

        
        $view_data['form'] = array('id' => $req_id, 'token' => get_token_fnc(16), 'sort_order' => $get_row['sort_order'], 'slug' => $get_row['slug'], 'title' => $get_row['title'], 'name' => $get_row['name'], 'spotlight' => $get_row['spotlight'], 'description' => $get_row['description'], 'status' => $get_row['status'], 'searchable' => $get_row['searchable'], 'listed' => $get_row['listed'], 'featured' => $get_row['featured'], 'newbie' => $get_row['newbie'], 'hd' => $get_row['hd'], 'lq' => $get_row['lq'], 'st' => $get_row['st'], 'sku' => $get_row['sku'], 'model' => $get_row['model'], 'mpn' => $get_row['mpn'], 'gtin' => $get_row['gtin'], 'price' => $get_row['price'], 'price_previous' => $get_row['price_previous'], 'today_views' => $get_row['today_views'], 'lifetime_views' => $get_row['lifetime_views'], 'today_hits' => $get_row['today_hits'], 'lifetime_hits' => $get_row['lifetime_hits'], 'votes' => $get_row['votes'], 'ratings' => $get_row['ratings'], 'scores' => $get_row['scores'], 'likes' => $get_row['likes'], 'launch_year' => $get_row['launch_year'], 'published_year' => date('Y', $get_row['published_time']), 'published_month' => date('n', $get_row['published_time']), 'published_day' => date('j', $get_row['published_time']), 'published_hour' => date('H', $get_row['published_time']), 'published_minute' => date('i', $get_row['published_time']), 'published_second' => date('s', $get_row['published_time']), 'meta_title' => $get_row['meta_title'], 'meta_description' => $get_row['meta_description'], 'meta_keywords' => $get_row['meta_keywords'], 'images' => $get_result_images, 'gallery' => $get_result_gallery, 'db_categories' => $var_db_categories, 'categories' => $var_db_items_to_categories, 'db_sections' => $var_db_sections, 'sections' => $var_db_items_to_sections, 'db_brands' => $var_db_brands, 'brands' => $var_db_items_to_brands, 'db_awards' => $var_db_awards, 'awards' => $var_db_items_to_awards, 'db_industries' => $var_db_industries, 'industries' => $var_db_items_to_industries, 'db_natives' => $var_db_natives, 'natives' => $var_db_items_to_natives, 'db_places' => $var_db_places, 'places' => $var_db_items_to_places, 'db_regions' => $var_db_regions, 'regions' => $var_db_items_to_regions, 'db_voices' => $var_db_voices, 'voices' => $var_db_items_to_voices, 'db_actors' => $var_db_actors, 'actors' => $var_db_items_to_actors, 'db_actresses' => $var_db_actresses, 'actresses' => $var_db_items_to_actresses, 'db_directors' => $var_db_directors, 'directors' => $var_db_items_to_directors, 'db_producers' => $var_db_producers, 'producers' => $var_db_items_to_producers, 'db_writers' => $var_db_writers, 'writers' => $var_db_items_to_writers, 'db_singers' => $var_db_singers, 'singers' => $var_db_items_to_singers, 'db_designers' => $var_db_designers, 'designers' => $var_db_items_to_designers, 'db_editors' => $var_db_editors, 'editors' => $var_db_items_to_editors, 'db_cinematographers' => $var_db_cinematographers, 'cinematographers' => $var_db_items_to_cinematographers);

        if ($this->request->getMethod() == "POST") {

        if($user_info['role'] == 0){
         $alert_data['alert'] = ['type' => 'error', 'message' => "Authorization failed: You are not permitted to perform this action."];
             $this->session->set($alert_data);
             return redirect()->to($this->cc['base_url'].'Backend');
        }

        $this->validation->setRules([
          'sort_order' => ['label' => 'Sort Order', 'rules' => 'required|trim|integer'],
          'slug' => ['label' => 'Slug', 'rules' => 'required|trim'],
          'title' => ['label' => 'Title', 'rules' => 'required|trim'],
          'name' => ['label' => 'Name', 'rules' => 'required|trim'],
          'spotlight' => ['label' => 'Spotlight', 'rules' => 'required|trim'],
          'description' => ['label' => 'Description', 'rules' => 'required|trim'],
          'launch_year' => ['label' => 'Launch Year', 'rules' => 'required|trim'],
          'published_year' => ['label' => 'Published Year', 'rules' => 'required|trim'],
          'published_month' => ['label' => 'Published Month', 'rules' => 'required|trim'],
          'published_day' => ['label' => 'Published Day', 'rules' => 'required|trim'],
          'published_hour' => ['label' => 'Published Hour', 'rules' => 'required|trim'],
          'published_minute' => ['label' => 'Published Minute', 'rules' => 'required|trim'],
          'published_second' => ['label' => 'Published Second', 'rules' => 'required|trim'],
          'meta_title' => ['label' => 'Meta Title', 'rules' => 'required|trim'],
          'meta_description' => ['label' => 'Meta Description', 'rules' => 'required|trim'],
          'model' => ['label' => 'model', 'rules' => 'max_length[16]|trim'],
          'sku' => ['label' => 'sku', 'rules' => 'max_length[16]|trim'],
          'mpn' => ['label' => 'mpn', 'rules' => 'max_length[16]|trim'],
          'gtin' => ['label' => 'gtin', 'rules' => 'max_length[16]|trim'],
          'price' => ['label' => 'price', 'rules' => 'max_length[16]|decimal|trim'],
          'price_previous' => ['label' => 'price_previous', 'rules' => 'max_length[16]|decimal|trim'],
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
        $req_sort_order = (int) ($this->request->getPost('sort_order') ?? 0);
        $req_status = (int) ($this->request->getPost('status') ?? 0);
        $req_searchable = (int) ($this->request->getPost('searchable') ?? 0);
        $req_listed = (int) ($this->request->getPost('listed') ?? 0);
        $req_featured = (int) ($this->request->getPost('featured') ?? 0);
        $req_newbie = (int) ($this->request->getPost('newbie') ?? 0);
        $req_hd = (int) ($this->request->getPost('hd') ?? 0);
        $req_lq = (int) ($this->request->getPost('lq') ?? 0);
        $req_st = (int) ($this->request->getPost('st') ?? 0);
        $req_launch_year = $this->request->getPost('launch_year');
        $req_published_year = $this->request->getPost('published_year');
        $req_published_month = $this->request->getPost('published_month');
        $req_published_day = $this->request->getPost('published_day');
        $req_published_hour = $this->request->getPost('published_hour');
        $req_published_minute = $this->request->getPost('published_minute');
        $req_published_second = $this->request->getPost('published_second');
        $req_meta_title = $this->request->getPost('meta_title');
        $req_meta_description = $this->request->getPost('meta_description');
        $req_meta_keywords = $this->request->getPost('meta_keywords');
        $req_categories = $this->request->getPost('categories');
        $req_sections = $this->request->getPost('sections');
        $req_brands = $this->request->getPost('brands');
        $req_awards = $this->request->getPost('awards');
        $req_industries = $this->request->getPost('industries');
        $req_regions = $this->request->getPost('regions');
        $req_voices = $this->request->getPost('voices');
        $req_places = $this->request->getPost('places');
        $req_natives = $this->request->getPost('natives');
        $req_actors = $this->request->getPost('actors');
        $req_actresses = $this->request->getPost('actresses');
        $req_directors = $this->request->getPost('directors');
        $req_producers = $this->request->getPost('producers');
        $req_writers = $this->request->getPost('writers');
        $req_singers = $this->request->getPost('singers');
        $req_designers = $this->request->getPost('designers');
        $req_editors = $this->request->getPost('editors');
        $req_cinematographers = $this->request->getPost('cinematographers');
        $req_model = $this->request->getPost('model');
        $req_sku = $this->request->getPost('sku');
        $req_mpn = $this->request->getPost('mpn');
        $req_gtin = $this->request->getPost('gtin');
        $req_price = $this->request->getPost('price');
        $req_price_previous = $this->request->getPost('price_previous');
        $req_today_views = $this->request->getPost('today_views');
        $req_lifetime_views = $this->request->getPost('lifetime_views');
        $req_today_hits = $this->request->getPost('today_hits');
        $req_lifetime_hits = $this->request->getPost('lifetime_hits');
        $req_votes = $this->request->getPost('votes');
        $req_ratings = $this->request->getPost('ratings');
        $req_scores = $this->request->getPost('scores');
        $req_likes = $this->request->getPost('likes');
        

        $view_data['form'] = array('id' => $req_id, 'token' => get_token_fnc(16), 'sort_order' => $req_sort_order, 'slug' => $req_slug, 'title' => $req_title, 'name' => $req_name, 'spotlight' => $req_spotlight, 'description' => $req_description, 'status' => $req_status, 'searchable' => $req_searchable, 'listed' => $req_listed, 'featured' => $req_featured, 'newbie' => $req_newbie, 'hd' => $req_hd, 'lq' => $req_lq, 'st' => $req_st, 'sku' => $req_sku, 'model' => $req_model, 'mpn' => $req_mpn, 'gtin' => $req_gtin, 'price' => $req_price, 'price_previous' => $req_price_previous, 'today_views' => $req_today_views, 'lifetime_views' => $req_lifetime_views, 'today_hits' => $req_today_hits, 'lifetime_hits' => $req_lifetime_hits, 'votes' => $req_votes, 'ratings' => $req_ratings, 'scores' => $req_scores, 'likes' => $req_likes, 'launch_year' => $req_launch_year, 'published_year' => $req_published_year, 'published_month' => $req_published_month, 'published_day' => $req_published_day, 'published_hour' => $req_published_hour, 'published_minute' => $req_published_minute, 'published_second' => $req_published_second, 'meta_title' => $req_meta_title, 'meta_description' => $req_meta_description, 'meta_keywords' => $req_meta_keywords, 'images' => $get_result_images, 'gallery' => $get_result_gallery, 'db_categories' => $var_db_categories, 'categories' => $req_categories, 'db_sections' => $var_db_sections, 'sections' => $req_sections, 'db_brands' => $var_db_brands, 'brands' => $req_brands, 'db_awards' => $var_db_awards, 'awards' => $req_awards, 'db_industries' => $var_db_industries, 'industries' => $req_industries, 'db_regions' => $var_db_regions, 'regions' => $req_regions, 'db_voices' => $var_db_voices, 'voices' => $req_voices, 'db_places' => $var_db_places, 'places' => $req_places, 'db_actors' => $var_db_actors, 'actors' => $req_actors, 'db_actresses' => $var_db_actresses, 'actresses' => $req_actresses, 'db_directors' => $var_db_directors, 'directors' => $req_directors, 'db_producers' => $var_db_producers, 'producers' => $req_producers, 'db_writers' => $var_db_writers, 'writers' => $req_writers, 'db_singers' => $var_db_singers, 'singers' => $req_singers, 'db_designers' => $var_db_designers, 'designers' => $req_designers, 'db_editors' => $var_db_editors, 'editors' => $req_editors, 'db_cinematographers' => $var_db_cinematographers, 'cinematographers' => $req_cinematographers);

            if($this->validation->withRequest($this->request)->run() == FALSE){
    
                $alert_data['alert'] = ['type' => 'error', 'message' => $this->validation->listErrors('my_validation_list')];        
                $this->session->set($alert_data);

                }else{

                    $do_count_where = array('token' => $req_token);                    
                    $do_count = $this->CRUDModel->do_count('items', $do_count_where);

                    if($do_count > 0){
    
                        $alert_data['alert'] = ['type' => 'error', 'message' => 'Duplicate records entry not allowed'];
                        $this->session->set($alert_data);        
                        
                    }else{ 
                      
                      
                      $relations = [
                          'categories' => 'category_id',
                          'sections'   => 'section_id',
                          'brands'     => 'brand_id',
                          'awards'     => 'award_id',
                          'industries' => 'industry_id',
                          'places'     => 'place_id',
                          'regions'    => 'region_id',
                          'natives'    => 'native_id',
                          'voices'     => 'voice_id'
                      ];

                      foreach ($relations as $key => $column) {
                          $var_delete_items_to = [$column => $req_id];
                          $this->CRUDModel->do_delete('items_to_' . $key, $var_delete_items_to);
                      }

                      $this->CRUDModel->do_delete('items_to_talents', ['item_id' => $req_id]);

                    $do_update_where = array('item_id' => $req_id);

                    $var_published_time = "$req_published_year-$req_published_month-$req_published_day $req_published_hour:$req_published_minute:$req_published_second";
                    $var_published_time = datetime_to_unixtimestamp_fnc($var_published_time);

                    $do_update_data =  array('slug' => slug_fnc($req_slug), 'sort_order' => $req_sort_order, 'title' => $req_title, 'name' => $req_name, 'spotlight' => $req_spotlight, 'description' => $req_description, 'status' => $req_status, 'searchable' => $req_searchable, 'listed' => $req_listed, 'featured' => $req_featured, 'newbie' => $req_newbie, 'hd' => $req_hd, 'lq' => $req_lq, 'st' => $req_st, 'sku' => $req_sku, 'model' => $req_model, 'mpn' => $req_mpn, 'gtin' => $req_gtin, 'price' => $req_price, 'price_previous' => $req_price_previous, 'today_views' => $req_today_views, 'lifetime_views' => $req_lifetime_views, 'today_hits' => $req_today_hits, 'lifetime_hits' => $req_lifetime_hits, 'votes' => $req_votes, 'ratings' => $req_ratings, 'scores' => $req_scores, 'likes' => $req_likes, 'launch_year' => $req_launch_year, 'published_time' => $var_published_time, 'meta_title' => $req_meta_title, 'meta_description' => $req_meta_description, 'meta_keywords' => $req_meta_keywords, 'token' => $req_token, 'edit_by' => $user_info['user_id'], 'edit_time' => time(), 'edit_ip' => $this->request->getIPAddress());

                   $this->CRUDModel->do_update('items', $do_update_where, $do_update_data);

                  foreach ($relations as $key => $column) {
                        $req_values = ${'req_' . $key};

                        if (!empty($req_values)) {
                            foreach ($req_values as $value) {
                                if ($value > 0) {
                                    $data = [
                                        'item_id' => $req_id,
                                        $column   => $value
                                    ];
                                    $this->CRUDModel->do_create("items_to_{$key}", $data);
                                }
                            }
                        }
                    }


                    $talent_types = talent_types_fnc();

                    foreach ($talent_types as $key => $type_data) {
                        $type_id = $type_data['id'];
                        $req_values = ${'req_' . $key};

                        if (!empty($req_values)) {
                            foreach ($req_values as $talent_id) {
                                if ($talent_id > 0) {
                                    $data = [
                                        'item_id'   => $req_id,
                                        'talent_id' => $talent_id,
                                        'type_id'   => $type_id
                                    ];
                                    $this->CRUDModel->do_create('items_to_talents', $data);
                                }
                            }
                        }
                    }


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

                            $do_create_data_images =  array('upload_type' => 'image', 'upload_file' => $image_new_name, 'parent_id' => $req_id, 'parent_type' => 'items_images', 'sort_order' => $var_image_sort_order, 'token' => $req_token, 'add_by' => $user_info['user_id'], 'add_time' => time(), 'add_ip' => $this->request->getIPAddress());

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

                                $do_create_data_gallery =  array('upload_type' => 'image', 'upload_file' => $gallery_new_name, 'parent_id' => $req_id, 'parent_type' => 'items_gallery', 'sort_order' => $var_gallery_sort_order, 'token' => $req_token, 'add_by' => $user_info['user_id'], 'add_time' => time(), 'add_ip' => $this->request->getIPAddress());

                             $this->CRUDModel->do_create('uploads', $do_create_data_gallery);

    
                                }
    
                            }
    
                            $alert_data['alert'] = ['type' => 'success', 'message' => "The record id# ".$req_id." has been updated successfully"];
                            $this->session->set($alert_data);                

                            return redirect()->to($this->cc['base_url'].'Items/list');
                        }

                }


        }

        $view_data['page'] = [
            'title' => "Edit | Items | ".$this->cc['app_name'],
           'description' => "",
           'keywords' => "",
           'url' => current_url(),
           'type' => "website"
         ];  
  
       $view_data['cc'] = $this->cc;

        return view('backend/'.$this->cc['backend_theme'].'/items_edit', $view_data);

    }

    }


    public function add()
    {

      $GLOBALS['HTMLS_CACHE'] = false;

        $user_info = $this->_verify_user_area(1);

        $var_db_categories = [];
        $var_db_sections = [];
        $var_db_brands = [];
        $var_db_awards = [];
        $var_db_industries = [];
        $var_db_regions = [];
        $var_db_voices = [];
        $var_db_natives = [];
        $var_db_places = [];
        $var_db_actors = [];
        $var_db_actresses = [];
        $var_db_directors = [];
        $var_db_producers = [];
        $var_db_writers = [];
        $var_db_singers = [];
        $var_db_designers = [];
        $var_db_editors = [];
        $var_db_cinematographers = [];

         $var_model = get_token_fnc(2, 'capital_alphabetic').'-'.get_token_fnc(4, 'numbers');
        $var_sku = get_token_fnc(2, 'capital_alphabetic').'-'.get_token_fnc(4, 'numbers').'-'.get_token_fnc(2, 'capital_alphabetic');
        $var_mpn = get_token_fnc(2, 'capital_alphabetic').'-'.get_token_fnc(6, 'numbers');
        $var_gtin = get_token_fnc(13, 'numbers');
        $var_price = get_token_fnc(2, 'numbers').'.'.get_token_fnc(2, 'numbers');
        $var_price_previous = $var_price+(get_token_fnc(2, 'numbers').'.'.get_token_fnc(2, 'numbers'));

        $sort_order_count = $this->CRUDModel->do_count('items')+1;

        $view_data['form'] = array('token' => get_token_fnc(16), 'sort_order' => $sort_order_count, 'slug' => '', 'name' => '', 'title' => '', 'spotlight' => '', 'description' => '', 'status' => 1, 'searchable' => 1, 'listed' => 1, 'featured' => 0, 'newbie' => 0, 'hd' => 0, 'lq' => 0, 'st' => 0, 'model' => $var_model, 'sku' => $var_sku, 'mpn' => $var_mpn, 'gtin' => $var_gtin, 'price' => $var_price, 'price_previous' => $var_price_previous, 'launch_year' => date('Y'), 'published_year' => date('Y'), 'published_month' => date('n'), 'published_day' => date('j'), 'published_hour' => date('H'), 'published_minute' => date('i'), 'published_second' => date('s'), 'meta_title' => '', 'meta_description' => '', 'meta_keywords' => '', 'db_categories' => $var_db_categories, 'categories' => [], 'db_sections' => $var_db_sections, 'sections' => [], 'db_brands' => $var_db_brands, 'brands' => [], 'db_awards' => $var_db_awards, 'awards' => [], 'db_industries' => $var_db_industries, 'industries' => [], 'db_regions' => $var_db_regions, 'regions' => [], 'db_voices' => $var_db_voices, 'voices' => [], 'db_natives' => $var_db_natives, 'natives' => [], 'db_places' => $var_db_places, 'places' => [], 'db_actors' => $var_db_actors, 'actors' => [], 'db_actresses' => $var_db_actresses, 'actresses' => [], 'db_directors' => $var_db_directors, 'directors' => [], 'db_producers' => $var_db_producers, 'producers' => [], 'db_writers' => $var_db_writers, 'writers' => [], 'db_singers' => $var_db_singers, 'singers' => [], 'db_designers' => $var_db_designers, 'designers' => [], 'db_editors' => $var_db_editors, 'editors' => [], 'db_cinematographers' => $var_db_cinematographers, 'cinematographers' => []);


        if ($this->request->getMethod() == "POST") {

        if($user_info['role'] == 0){
         $alert_data['alert'] = ['type' => 'error', 'message' => "Authorization failed: You are not permitted to perform this action."];
             $this->session->set($alert_data);
             return redirect()->to($this->cc['base_url'].'Backend');
        }

        $this->validation->setRules([
          'sort_order' => ['label' => 'Sort Order', 'rules' => 'required|trim|integer'],
          'slug' => ['label' => 'Slug', 'rules' => 'required|trim'],
          'title' => ['label' => 'Title', 'rules' => 'required|trim'],
          'name' => ['label' => 'Name', 'rules' => 'required|trim'],
          'spotlight' => ['label' => 'Spotlight', 'rules' => 'required|trim'],
          'description' => ['label' => 'Description', 'rules' => 'required|trim'],
          'launch_year' => ['label' => 'Launch Year', 'rules' => 'required|trim'],
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
        $req_sort_order = (int) ($this->request->getPost('sort_order') ?? 0);
        $req_status = (int) ($this->request->getPost('status') ?? 0);
        $req_searchable = (int) ($this->request->getPost('searchable') ?? 0);
        $req_listed = (int) ($this->request->getPost('listed') ?? 0);
        $req_featured = (int) ($this->request->getPost('featured') ?? 0);
        $req_newbie = (int) ($this->request->getPost('newbie') ?? 0);
        $req_hd = (int) ($this->request->getPost('hd') ?? 0);
        $req_lq = (int) ($this->request->getPost('lq') ?? 0);
        $req_st = (int) ($this->request->getPost('st') ?? 0);
        $req_launch_year = $this->request->getPost('launch_year');
        $req_published_year = $this->request->getPost('published_year');
        $req_published_month = $this->request->getPost('published_month');
        $req_published_day = $this->request->getPost('published_day');
        $req_published_hour = $this->request->getPost('published_hour');
        $req_published_minute = $this->request->getPost('published_minute');
        $req_published_second = $this->request->getPost('published_second');
        $req_meta_title = $this->request->getPost('meta_title');
        $req_meta_description = $this->request->getPost('meta_description');
        $req_meta_keywords = $this->request->getPost('meta_keywords');
        $req_categories = $this->request->getPost('categories');
        $req_sections = $this->request->getPost('sections');
        $req_brands = $this->request->getPost('brands');
        $req_awards = $this->request->getPost('awards');
        $req_industries = $this->request->getPost('industries');
        $req_regions = $this->request->getPost('regions');
        $req_voices = $this->request->getPost('voices');
        $req_places = $this->request->getPost('places');
        $req_natives = $this->request->getPost('natives');
        $req_actors = $this->request->getPost('actors');
        $req_actresses = $this->request->getPost('actresses');
        $req_directors = $this->request->getPost('directors');
        $req_producers = $this->request->getPost('producers');
        $req_writers = $this->request->getPost('writers');
        $req_singers = $this->request->getPost('singers');
        $req_designers = $this->request->getPost('designers');
        $req_editors = $this->request->getPost('editors');
        $req_cinematographers = $this->request->getPost('cinematographers');        
        $req_model = $this->request->getPost('model');
        $req_sku = $this->request->getPost('sku');
        $req_mpn = $this->request->getPost('mpn');
        $req_gtin = $this->request->getPost('gtin');
        $req_price = $this->request->getPost('price');
        $req_price_previous = $this->request->getPost('price_previous');
        $req_today_views = 99;
        $req_lifetime_views = 999;
        $req_today_hits = 99;
        $req_lifetime_hits = 999;
        $req_votes = 99;
        $req_ratings = 5;
        $req_scores = 495;
        $req_likes = 99;

        $view_data['form'] = array('token' => $req_token, 'sort_order' => $req_sort_order, 'slug' => $req_slug, 'title' => $req_title, 'name' => $req_name, 'spotlight' => $req_spotlight, 'description' => $req_description, 'status' => $req_status, 'searchable' => $req_searchable, 'listed' => $req_listed, 'featured' => $req_featured, 'newbie' => $req_newbie, 'hd' => $req_hd, 'lq' => $req_lq, 'st' => $req_st, 'model' => $req_model, 'sku' => $req_sku, 'mpn' => $req_mpn, 'gtin' => $req_gtin, 'price' => $req_price, 'price_previous' => $req_price_previous, 'launch_year' => $req_launch_year, 'published_year' => $req_published_year, 'published_month' => $req_published_month, 'published_day' => $req_published_day, 'published_hour' => $req_published_hour, 'published_minute' => $req_published_minute, 'published_second' => $req_published_second, 'meta_title' => $req_meta_title, 'meta_description' => $req_meta_description, 'meta_keywords' => $req_meta_keywords, 'db_categories' => $var_db_categories, 'categories' => $req_categories, 'db_sections' => $var_db_sections, 'sections' => $req_sections, 'db_brands' => $var_db_brands, 'brands' => $req_brands, 'db_awards' => $var_db_awards, 'awards' => $req_awards, 'db_industries' => $var_db_industries, 'industries' => $req_industries, 'db_regions' => $var_db_regions, 'regions' => $req_regions, 'db_voices' => $var_db_voices, 'voices' => $req_voices, 'db_places' => $var_db_places, 'places' => $req_places, 'db_actors' => $var_db_actors, 'actors' => $req_actors, 'db_actresses' => $var_db_actresses, 'actresses' => $req_actresses, 'db_directors' => $var_db_directors, 'directors' => $req_directors, 'db_producers' => $var_db_producers, 'producers' => $req_producers, 'db_writers' => $var_db_writers, 'writers' => $req_writers, 'db_singers' => $var_db_singers, 'singers' => $req_singers, 'db_designers' => $var_db_designers, 'designers' => $req_designers, 'db_editors' => $var_db_editors, 'editors' => $req_editors, 'db_cinematographers' => $var_db_cinematographers, 'cinematographers' => $req_cinematographers);

            if($this->validation->withRequest($this->request)->run() == FALSE){
    
                $alert_data['alert'] = ['type' => 'error', 'message' => $this->validation->listErrors('my_validation_list')];        
                $this->session->set($alert_data);
                
                }else{

                    $do_count_where = array('token' => $req_token);                    
                    $do_count = $this->CRUDModel->do_count('items', $do_count_where);

                    if($do_count > 0){
    
                        $alert_data['alert'] = ['type' => 'error', 'message' => 'Duplicate records entry not allowed'];        
                        $this->session->set($alert_data);

                        }else{

                    $var_published_time = "$req_published_year-$req_published_month-$req_published_day $req_published_hour:$req_published_minute:$req_published_second";
                    $var_published_time = datetime_to_unixtimestamp_fnc($var_published_time);

                    $do_create_data =  array('slug' => slug_fnc($req_slug), 'sort_order' => $req_sort_order, 'title' => $req_title, 'name' => $req_name, 'spotlight' => $req_spotlight, 'description' => $req_description, 'status' => $req_status, 'searchable' => $req_searchable, 'listed' => $req_listed, 'featured' => $req_featured, 'newbie' => $req_newbie, 'hd' => $req_hd, 'lq' => $req_lq, 'st' => $req_st, 'sku' => $req_sku, 'model' => $req_model, 'mpn' => $req_mpn, 'gtin' => $req_gtin, 'price' => $req_price, 'price_previous' => $req_price_previous, 'today_views' => $req_today_views, 'lifetime_views' => $req_lifetime_views, 'today_hits' => $req_today_hits, 'lifetime_hits' => $req_lifetime_hits, 'votes' => $req_votes, 'ratings' => $req_ratings, 'scores' => $req_scores, 'likes' => $req_likes, 'launch_year' => $req_launch_year, 'published_time' => $var_published_time, 'meta_title' => $req_meta_title, 'meta_description' => $req_meta_description, 'meta_keywords' => $req_meta_keywords, 'token' => $req_token, 'add_by' => $user_info['user_id'], 'add_time' => time(), 'add_ip' => $this->request->getIPAddress());

                   $do_create_id = $this->CRUDModel->do_create('items', $do_create_data);

                    $relations = [
                        'categories' => 'category_id',
                        'sections'   => 'section_id',
                        'brands'     => 'brand_id',
                        'awards'     => 'award_id',
                        'industries'     => 'industry_id',
                        'places'     => 'place_id',
                        'regions'     => 'region_id',
                        'natives'     => 'native_id',
                        'voices'     => 'voice_id'
                        
                    ];

                    foreach ($relations as $key => $column) {
                        $req_values = ${'req_' . $key};

                        if (!empty($req_values)) {
                            foreach ($req_values as $value) {
                                if ($value > 0) {
                                    $data = [
                                        'item_id' => $do_create_id,
                                        $column   => $value
                                    ];
                                    $this->CRUDModel->do_create("items_to_{$key}", $data);
                                }
                            }
                        }
                    }


                    $talent_types = talent_types_fnc();

                    foreach ($talent_types as $key => $type_data) {
                        $type_id = $type_data['id'];
                        $req_values = ${'req_' . $key};

                        if (!empty($req_values)) {
                            foreach ($req_values as $talent_id) {
                                if ($talent_id > 0) {
                                    $data = [
                                        'item_id'   => $do_create_id,
                                        'talent_id' => $talent_id,
                                        'type_id'   => $type_id
                                    ];
                                    $this->CRUDModel->do_create('items_to_talents', $data);
                                }
                            }
                        }
                    }


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

                            $do_create_data_images =  array('upload_type' => 'image', 'upload_file' => $image_new_name, 'parent_id' => $do_create_id, 'parent_type' => 'items_images', 'sort_order' => $var_image_sort_order, 'token' => $req_token, 'add_by' => $user_info['user_id'], 'add_time' => time(), 'add_ip' => $this->request->getIPAddress());

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

                                $do_create_data_gallery =  array('upload_type' => 'image', 'upload_file' => $gallery_new_name, 'parent_id' => $do_create_id, 'parent_type' => 'items_gallery', 'sort_order' => $var_gallery_sort_order, 'token' => $req_token, 'add_by' => $user_info['user_id'], 'add_time' => time(), 'add_ip' => $this->request->getIPAddress());

                             $this->CRUDModel->do_create('uploads', $do_create_data_gallery);

    
                                }
    
                            }
    
                            $alert_data['alert'] = ['type' => 'success', 'message' => "The new record id# ".$do_create_id." has been saved successfully"];
                            $this->session->set($alert_data);
                                                        
                            return redirect()->to($this->cc['base_url'].'Items/list');

                        }

                }


        }

        $view_data['page'] = [
            'title' => "Add | Items | ".$this->cc['app_name'],
           'description' => "",
           'keywords' => "",
           'url' => current_url(),
           'type' => "website"
         ];  
  
       $view_data['cc'] = $this->cc;

        return view('backend/'.$this->cc['backend_theme'].'/items_add', $view_data);

    }


    

}


