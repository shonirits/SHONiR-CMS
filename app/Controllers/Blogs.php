<?php

namespace App\Controllers;

class Blogs extends Shonir_Controller
{

    public function __construct() {
        parent::__construct();
    }


    public function index()
    {

        $view_data['page'] = [
            'title' => "Pages | ".$this->cc['app_name'],
           'description' => "",
           'keywords' => "",
           'url' => current_url(),
           'type' => "website"
         ];  

       $view_data['cc'] = $this->cc;

        return view('welcome_message', $view_data);

    }

    public function posts($type = '', $req_id = '')
    {

    $current_page_id = 'blogs';

    $by = [
        'bpbc' => 'posts_by_category',
        'search' => 'posts_by_search',
        'featured' => 'posts_by_featured',
        'all'  => 'posts_all'
          ];

    $posts_by = $by[strtolower($type)] ?? 'posts_all';


    $db_limit = [
        'posts_by_search'  => $this->cc['limit_posts_search'],
        'posts_by_featured' => $this->cc['limit_posts_featured'],
        'posts_by_newbie'  => $this->cc['limit_posts_newbie'],
        'posts_all'  => $this->cc['limit_posts_list']
          ];


        $default_limit = $db_limit[$posts_by] ?? $this->cc['limit_posts_list'];
        $get_result_where = ''; 
        $get_result_like =  '';

        $page = (int) ($this->request->getGet('page') ?? 1);        
        $limit = (int) ($this->request->getGet('limit') ?? $default_limit);

        $order = $this->request->getGet('order');
        $sort = $this->request->getGet('sort');
        $query = $this->request->getGet('query');

         $order_list = array('blog_post_id' => 'Post ID', 'title' => 'Title', 'name' => 'Name', 'launch_year' => 'Launch Year', 'published_time' => 'Published Time', 'today_views' => 'Today Views', 'lifetime_views' => 'Lifetime Views', 'today_hits' => 'Today Hits', 'lifetime_hits' => 'Lifetime Hits', 'votes' => 'Votes', 'rating' => 'Rating',  'edit_time' => 'Last Edited Time');
        if(!array_key_exists($order, $order_list)){
            $order = 'published_time';
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


         if($posts_by == 'posts_by_category'){

          $view_data['blog_category_id'] = $req_id;

         $get_result_where = "blog_post_id IN (SELECT DISTINCT blog_post_id FROM tbl_blogs_posts_to_categories WHERE blog_category_id IN ($req_id) AND blog_category_id IN (SELECT blog_category_id FROM tbl_blogs_categories WHERE status = 1 AND listed = 1 AND published_time<= ".time().")) AND status = 1 AND listed = 1 AND published_time<= ".time();
        
        $get_row_category_where = array('blog_category_id' => $req_id);                    
        $get_row_category = $this->CRUDModel->get_row('blogs_categories', $get_row_category_where);

        if(!$get_row_category){
            throw \CodeIgniter\Exceptions\PageNotFoundException::forPageNotFound(); 
        }

          $url = $this->cc['base_url'].slug2url_fnc('blogs_posts_by_categories', $get_row_category['blog_category_id'], $get_row_category['slug'], $get_row_category['name']);

           $view_data['page']['title'] = $get_row_category['meta_title'] . " | " . $this->cc['app_name'];
          $view_data['page']['description'] = $get_row_category['meta_description'];
          $view_data['page']['keywords'] = $get_row_category['meta_keywords'];

          $view_data['content'] = [
            'title' => $get_row_category['title'],
           'name' => $get_row_category['name'],
           'paging' => true
         ];


        }


         if($posts_by == 'posts_by_search'){

          $get_result_where = " status = 1 AND listed = 1 AND published_time<= ".time();
          $order = 'lifetime_hits';
          $sort = 'ASC';
          $url = $this->cc['base_url'].'bsearch.html?query='.$query;

          if($query){
            $get_result_like = array("LOWER(slug)" => strtolower($query), "LOWER(name)" => strtolower($query), "LOWER(title)" => strtolower($query), "LOWER(description)" => strtolower($query), "LOWER(spotlight)" => strtolower($query), "LOWER(meta_title)" => strtolower($query), "LOWER(meta_description)" => strtolower($query), "LOWER(meta_keywords)" => strtolower($query));          
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


        if($posts_by == 'posts_all'){
          $get_result_where = "status = 1 AND listed = 1 AND published_time<= ".time();
          $order = 'published_time';
          $sort = 'DESC';
          $url = $this->cc['base_url'].'Blog';

          $view_data['page']['title'] = "Latest Blog & Articles | Insights, Stories & Reviews | " . $this->cc['app_name'];
          $view_data['page']['description'] = 'Explore our collection of blogs and articles featuring expert insights, engaging stories, and community reviews. Stay informed, inspired, and connected with trending topics. ' . $this->cc['app_meta_description'];
          $view_data['page']['keywords'] = 'blogs, articles, insights, reviews, trending stories, expert opinions, community ratings, latest updates, informative content, ' . $this->cc['app_meta_keywords'];

          $view_data['content'] = [
            'title' => 'Our Blog & Articles',
           'name' => 'Blog',
           'paging' => false
         ];
        }

        $total_records = $this->CRUDModel->do_count('blogs_posts', $get_result_where, $get_result_like);

        $start = ($page-1)*$limit;

        $get_result_select = "tbl_blogs_posts.*,  
        (SELECT upload_file FROM tbl_uploads  
         WHERE upload_type = 'image'  
         AND parent_type = 'blogs_posts_images'  
         AND parent_id = tbl_blogs_posts.blog_post_id  
         ORDER BY sort_order ASC LIMIT 1) AS upload_file,
         
        (SELECT upload_id FROM tbl_uploads  
         WHERE upload_type = 'image'  
         AND parent_type = 'blogs_posts_images'  
         AND parent_id = tbl_blogs_posts.blog_post_id  
         ORDER BY sort_order ASC LIMIT 1) AS upload_id,

        (SELECT upload_file FROM tbl_uploads  
         WHERE upload_type = 'image'  
         AND parent_type = 'blogs_posts_images'  
         AND parent_id = tbl_blogs_posts.blog_post_id  
         ORDER BY sort_order ASC LIMIT 1 OFFSET 1) AS upload_file2";

        //     (SELECT GROUP_CONCAT(upload_file ORDER BY sort_order ASC) 
        // FROM tbl_uploads 
        // WHERE upload_type = 'image' 
        // AND parent_type = 'blogs_posts_gallery' 
        // AND parent_id = tbl_blogs_posts.blog_post_id) AS gallery_files,
        
        // (SELECT GROUP_CONCAT(upload_id ORDER BY sort_order ASC) 
        // FROM tbl_uploads 
        // WHERE upload_type = 'image' 
        // AND parent_type = 'blogs_posts_gallery' 
        // AND parent_id = tbl_blogs_posts.blog_post_id) AS gallery_ids

        $get_result = ($total_records > 0)?$this->CRUDModel->get_result('blogs_posts', $get_result_where, $get_result_select, $order.' '.$sort, $limit, $start, $get_result_like):false;

        if (!empty($get_result)) {
//         foreach ($get_result as $key => $post) {
//     $files = !empty($post['gallery_files']) ? explode(',', $post['gallery_files']) : [];
//     $ids = !empty($post['gallery_ids']) ? explode(',', $post['gallery_ids']) : [];
    
//     $gallery = [];
//     foreach ($files as $index => $file) {
//         $gallery[] = ['upload_file' => $file, 'upload_id' => $ids[$index]];
//     }
//     $get_result[$key]['gallery'] = $gallery;
// }

$get_result_update_blog_post_ids = array_column($get_result, 'blog_post_id');

if (!empty($get_result_update_blog_post_ids)) {

    $get_result_update_where = [
        'blog_post_id' => $get_result_update_blog_post_ids
    ];

    $get_result_update_data = [
        'today_views'    => 'today_views + 1',
        'last_view_time' => time()
    ];

    $update_result = $this->CRUDModel->do_update(
        'blogs_posts',  
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

        $parents_blogs_categories_where = "blog_category_id IN (SELECT DISTINCT blog_category_id FROM tbl_blogs_posts_to_categories WHERE blog_post_id = ".$result['blog_post_id'].")";
        $parents_blogs_categories_select = "blog_category_id, title, name, slug";
        $parents_blogs_categories = $this->CRUDModel->get_result('blogs_categories', $parents_blogs_categories_where, $parents_blogs_categories_select);

        $blogs_posts_to_categories = array_column($parents_blogs_categories, 'blog_category_id');

        $get_result[$i]['parents_blogs_categories'] = $parents_blogs_categories;

        $add_by_info_where = ['user_id' => $result['add_by']];
        $add_by_info_select = "email, nickname, gender";
        $get_result[$i]['add_by_info'] = $this->CRUDModel->get_row('users', $add_by_info_where, $add_by_info_select);

        $json_items .= '{
        "@type": "ListItem",
        "position": '.($i+1).',
        "item": {
            "@type": "Article",
            "headline": "'.data2json_fnc($result['meta_title']).'",
            "description": "'.data2json_fnc($result['meta_description']).'",
            "image": "'.$this->cc['img_url'].display_image_fnc('webp-0x0', $result['upload_file'], $this->cc['cache_image'], $this->cc['image_original']).'",
            "url": "'.$this->cc['base_url'].slug2url_fnc('blogs_posts_details', $result['blog_post_id'], $result['slug'], $result['meta_title']).'",
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
        <div itemprop="item" itemscope itemtype="https://schema.org/Article">
            <meta itemprop="headline" content="'.data2json_fnc($result['meta_title']).'">
            <meta itemprop="description" content="'.data2json_fnc($result['meta_description']).'">
            <link itemprop="image" href="'.$this->cc['img_url'].display_image_fnc('webp-0x0', $result['upload_file'], $this->cc['cache_image'], $this->cc['image_original']).'">
            <link itemprop="url" href="'.$this->cc['base_url'].slug2url_fnc('blogs_posts_details', $result['blog_post_id'], $result['slug'], $result['meta_title']).'">
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

        if (!empty($get_result_update_blog_post_ids)) {
        $get_result_update_blogs_posts = implode(',', array_map('intval', $get_result_update_blog_post_ids));
        $random_blogs_posts_where = "blog_post_id NOT IN ($get_result_update_blogs_posts) AND status = 1 AND listed = 1 AND published_time <= " . time();
        } else {
          $random_blogs_posts_where = "status = 1 AND listed = 1 AND published_time <= " . time();
      }

        
        $random_blogs_posts = $this->CRUDModel->get_blogs_posts($random_blogs_posts_where, 'RAND()', $this->cc['limit_posts_random']);
        $view_data['random_blogs_posts'] = $random_blogs_posts;

        $blogs_categories_where = ['status' => 1, 'listed' => 1, 'published_time <=' => time()];
        $view_data['blogs_categories'] = $this->CRUDModel->get_result('blogs_categories', $blogs_categories_where, 'blog_category_id, posts, slug, title, name', 'sort_order ASC');

        $random_where = "status = 1 AND published_time <= " . time();
        $view_data['random_items'] = $this->CRUDModel->get_items($random_where, 'RAND()', $this->cc['limit_items_trending']);

         $view_data['categories_tree'] = $this->CRUDModel->get_categories_tree($this->cc['base_url']);

        $view_data['pages_tree'] = $this->CRUDModel->get_pages_tree($this->cc['base_url']);

        $pages_where = ['status' => 1, 'listed' => 1, 'published_time <=' => time()];

        $view_data['pages'] = $this->CRUDModel->get_result('pages', $pages_where, 'page_id, sort_order, slug, title, name');

        $categories_where = ['status' => 1, 'listed' => 1, 'published_time <=' => time()];

        $view_data['categories'] = $this->CRUDModel->get_result('categories', $categories_where, 'category_id, items, icon, slug, title, name', 'sort_order ASC');

        $view_data['banners'] = $this->CRUDModel->get_banners($current_page_id, 'sort_order ASC');
        $view_data['gallery_videos'] = $this->CRUDModel->get_galleries('gallery-videos', 'video');
        $view_data['gallery_images'] = $this->CRUDModel->get_galleries('gallery-images', 'image');

       $view_data['cc'] = $this->cc;

        if($this->cc['cache_time'] > 0){
       $this->cachePage($this->cc['cache_time']);
       }

        return view('frontend/'.$this->cc['frontend_theme'].'/blogs_posts', $view_data);

    }

    public function posts_details($req_id = 0)
    {

    $current_page_id = 'blog_post_'.$req_id;


     $get_row_where = array('blog_post_id' => $req_id, 'status' => 1, 'published_time<=' => time());                    
        $get_row = $this->CRUDModel->get_row('blogs_posts', $get_row_where);

        if(!$get_row){

            throw \CodeIgniter\Exceptions\PageNotFoundException::forPageNotFound(); 

        }

        $next_previous_base_where = ['status' => 1, 'published_time <=' => time()];
        $next_previous_select = 'blog_post_id, name, slug';

        $next = $this->CRUDModel->get_row(
            'blogs_posts',
            array_merge($next_previous_base_where, ['blog_post_id >' => $req_id]),
            $next_previous_select,
            'published_time ASC'
        );

        $previous = $this->CRUDModel->get_row(
            'blogs_posts',
            array_merge($next_previous_base_where, ['blog_post_id <' => $req_id]),
            $next_previous_select,
            'published_time DESC'
        );

        if (!$next) {
            $next = $this->CRUDModel->get_row(
                'blogs_posts',
                $next_previous_base_where,
                $next_previous_select,
                'published_time ASC'
            );
        }
        if (!$previous) {
            $previous = $this->CRUDModel->get_row(
                'blogs_posts',
                $next_previous_base_where,
                $next_previous_select,
                'published_time DESC'
            );
        }

        if ($next && $next['blog_post_id'] == $req_id) $next = null;
        if ($previous && $previous['blog_post_id'] == $req_id) $previous = null;

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

       $do_update_where = array('blog_post_id' => $req_id);
       $do_update_data = array('last_hit_time' => time(), 'last_view_time' => time(), 'today_views' => $get_row['today_views']+1, 'today_hits' => $get_row['today_hits']+1, 'lifetime_views' => $get_row['lifetime_views']+1, 'lifetime_hits' => $get_row['lifetime_hits']+1);

        if(date("d/m/Y", $get_row['statistics_update']) != date("d/m/Y")){
          $do_update_data['statistics_update'] = time();
          $do_update_data['today_views'] = 1;
          $do_update_data['today_hits'] = 1;
        }

        $do_update = $this->CRUDModel->do_update('blogs_posts', $do_update_where, $do_update_data);

        $get_row_where_images = array('parent_id' => $req_id, 'parent_type' => 'blogs_posts_images');                    
        $view_data['images'] = $this->CRUDModel->get_result('uploads', $get_row_where_images, '', 'sort_order ASC');

        $get_row_where_gallery = array('parent_id' => $req_id, 'parent_type' => 'blogs_posts_gallery');                    
        $view_data['gallery'] = $this->CRUDModel->get_result('uploads', $get_row_where_gallery, '', 'sort_order ASC');

        $get_row['description'] = replace_placeholders_fnc(
                $get_row['description'],
                $view_data['images'],
                $view_data['gallery'],
                $this->cc['base_url'],
                $this->cc['img_url'],
                $this->cc['cache_image']
            );

        $parents_blogs_categories_where = "blog_category_id IN (SELECT DISTINCT blog_category_id FROM tbl_blogs_posts_to_categories WHERE blog_post_id = ".$req_id.")";
        $parents_blogs_categories_select = "blog_category_id, title, name, slug";
        $parents_blogs_categories = $this->CRUDModel->get_result('blogs_categories', $parents_blogs_categories_where, $parents_blogs_categories_select);

        $blogs_posts_to_categories = array_column($parents_blogs_categories, 'blog_category_id');

        $view_data['parents_blogs_categories'] = $parents_blogs_categories;

        $add_by_info_where = ['user_id' => $get_row['add_by']];
        $add_by_info_select = "email, nickname, gender";
        $view_data['add_by_info'] = $this->CRUDModel->get_row('users', $add_by_info_where, $add_by_info_select);

        $random_blogs_posts_where = "status = 1 AND listed = 1 AND published_time <= " . time() . " AND blog_post_id != ".$req_id;
        $random_blogs_posts = $this->CRUDModel->get_blogs_posts($random_blogs_posts_where, 'RAND()', $this->cc['limit_posts_random']);
        $view_data['random_blogs_posts'] = $random_blogs_posts;

        $blogs_categories_where = ['status' => 1, 'listed' => 1, 'published_time <=' => time()];
        $view_data['blogs_categories'] = $this->CRUDModel->get_result('blogs_categories', $blogs_categories_where, 'blog_category_id, posts, slug, title, name', 'sort_order ASC');

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

        $view_data['page'] = [
            'title' => $get_row['meta_title']." | ".$this->cc['app_name'],
           'description' => $get_row['meta_description'],
           'keywords' => $get_row['meta_keywords'],
           'url' => current_url(),
           'id' => $current_page_id,
           'type' => "website"
         ];

        $view_data['cc'] = $this->cc;
        $view_data['row'] = $get_row;

       $all_images = [];

        if (!empty($view_data['images'])) {
            foreach ($view_data['images'] as $image) {
                $all_images[] = $this->cc['img_url'] . display_image_fnc('webp-0x0', $image['upload_file']);
            }
        }

        if (!empty($view_data['gallery'])) {
            foreach ($view_data['gallery'] as $gallery) {
                $all_images[] = $this->cc['img_url'] . display_image_fnc('webp-0x0', $gallery['upload_file']);
            }
        }

        $json_images = json_encode($all_images, JSON_UNESCAPED_SLASHES | JSON_UNESCAPED_UNICODE);

        $micro_images = '';
        foreach ($all_images as $img) {
            $micro_images .= '<meta itemprop="image" content="'.$img.'" />';
        }

        $blog_post_url = $this->cc['base_url'] . slug2url_fnc(
            'blogs_posts_details',
            $get_row['blog_post_id'],
            $get_row['slug'],
            $get_row['meta_title']
        );

        $structured_data = [
            "@context" => "https://schema.org",
            "@type" => "BlogPosting",
            "headline" => $get_row['meta_title'],
            "description" => $get_row['meta_description'],
            "url" => $blog_post_url,
            "image" => $all_images,
            "author" => [
                "@type" => "Organization",
                "name" => $this->cc['app_name'],
                "url" => $this->cc['base_url']
            ],
            "publisher" => [
                "@type" => "Organization",
                "name" => $this->cc['app_name'],
                "logo" => [
                    "@type" => "ImageObject",
                    "url" => $this->cc['img_url'].'public/images/frontend/'.$this->cc['frontend_theme'].'/logo.webp'
                ],
                "url" => $this->cc['base_url']
            ],
            "datePublished" => date('c', strtotime($get_row['published_time'])),
            "dateModified" => date('c', strtotime($get_row['updated_time'] ?? $get_row['published_time']))
        ];

        if (!empty($view_data['next'])) {
            $structured_data['nextItem'] = [
                "@type" => "BlogPosting",
                "headline" => $view_data['next']['name'],
                "url" => $this->cc['base_url'] . slug2url_fnc('blogs_posts_details', $view_data['next']['blog_post_id'], $view_data['next']['slug'], $view_data['next']['name'])
            ];
        }
        if (!empty($view_data['previous'])) {
            $structured_data['previousItem'] = [
                "@type" => "BlogPosting",
                "headline" => $view_data['previous']['name'],
                "url" => $this->cc['base_url'] . slug2url_fnc('blogs_posts_details', $view_data['previous']['blog_post_id'], $view_data['previous']['slug'], $view_data['previous']['name'])
            ];
        }

        $view_data['structured_data'] = '
        <script type="application/ld+json">'.json_encode($structured_data, JSON_UNESCAPED_SLASHES | JSON_UNESCAPED_UNICODE).'</script>

        <div itemscope itemtype="https://schema.org/BlogPosting">
            <meta itemprop="headline" content="'.htmlspecialchars($get_row['meta_title'], ENT_QUOTES).'">
            <meta itemprop="description" content="'.htmlspecialchars($get_row['meta_description'], ENT_QUOTES).'">
            '.$micro_images.'
            <div itemprop="publisher" itemscope itemtype="https://schema.org/Organization">
                <meta itemprop="name" content="'.htmlspecialchars($this->cc['app_name'], ENT_QUOTES).'">
                <meta itemprop="url" content="'.$this->cc['base_url'].'">
                <meta itemprop="logo" content="'.$this->cc['img_url'].'public/images/frontend/'.$this->cc['frontend_theme'].'/logo.webp">
            </div>
        </div>';

         if($this->cc['cache_time'] > 0){
       $this->cachePage($this->cc['cache_time']);
       }
      
        return view('frontend/'.$this->cc['frontend_theme'].'/blogs_posts_details', $view_data);

    }


    
    public function categories_list()
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

        $order_list = array('blog_category_id' => 'Category ID', 'title' => 'Title', 'name' => 'Name', 'published_time' => 'Published Time', 'today_view' => 'Today View', 'lifetime_view' => 'Lifetime View', 'today_hit' => 'Today Hit', 'lifetime_hit' => 'Lifetime Hit', 'votes' => 'Votes', 'ratings' => 'Ratings', 'add_time' => 'Added Time', 'edit_time' => 'Last Edited Time');
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
             return redirect()->to($this->cc['base_url'].'Blogs/categories_list');
           }

        $view_data['page'] = [
            'title' => "List | Categories | Blogs | ".$this->cc['app_name'],
           'description' => "",
           'keywords' => "",
           'url' => current_url(),
           'type' => "website"
         ];         

         $total_records = $this->CRUDModel->do_count('blogs_categories', $get_result_where, $get_result_like);

        $start = ($page-1)*$limit;

        $get_result = ($total_records > 0)?$this->CRUDModel->get_result('blogs_categories', $get_result_where, '', $order.' '.$sort, $limit, $start, $get_result_like):false;

        $url = $this->cc['base_url'].'Blogs/categories_list?query='.$query.'&order='.$order.'&sort='.$sort.'&limit='.$limit;

        $view_data['pagination'] = ($total_records > 0)?pagination_fnc($get_result, $total_records, $limit, $page, $url):false; 
        
        $view_data['order_list'] = $order_list;
        $view_data['sort_list'] = $sort_list;
        $view_data['limit_list'] = $limit_list;
        $view_data['order'] = $order;
        $view_data['sort'] = $sort;
        $view_data['limit'] = $limit;
        $view_data['query'] = $query;
  
        $view_data['cc'] = $this->cc;

        return view('backend/'.$this->cc['backend_theme'].'/blogs_categories_list', $view_data);

    }

    public function categories_delete()
    {

        $GLOBALS['HTMLS_CACHE'] = false;

        $user_info = $this->_verify_user_area(1);

        if($user_info['role'] == 0){
         $alert_data['alert'] = ['type' => 'error', 'message' => "Authorization failed: You are not permitted to perform this action."];
             $this->session->set($alert_data);
             return redirect()->to($this->cc['base_url'].'Backend');
        }


        $req_id = $this->request->getGet('id');

        $get_row_where = array('blog_category_id' => $req_id);                    
        $get_row = $this->CRUDModel->get_row('blogs_categories', $get_row_where);

        if(!$get_row){

            $alert_data['alert'] = ['type' => 'error', 'message' => "The record id# ".$req_id." was not found"];
             $this->session->set($alert_data);

             return redirect()->to($this->cc['base_url'].'Blogs/categories_list');

        }else{

            if($get_row['removable'] != 1){

            $alert_data['alert'] = ['type' => 'error', 'message' => "The record id# ".$req_id." was not removable"];
             $this->session->set($alert_data);

             return redirect()->to($this->cc['base_url'].'Blogs/categories_list');

          }else{

        $uploads_path = FCPATH.'public/uploads/';

        $get_row_where_images = array('parent_id' => $req_id, 'parent_type' => 'blogs_categories_images');                    
        $get_result_images = $this->CRUDModel->get_result('uploads', $get_row_where_images);

        $get_row_where_gallery = array('parent_id' => $req_id, 'parent_type' => 'blogs_categories_gallery');                    
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

        $this->CRUDModel->do_delete('blogs_categories', $get_row_where);

        $get_delete_children_items = array('blog_category_id' => $req_id); 
        $this->CRUDModel->do_delete('blogs_posts_to_categories', $get_delete_children_items);
            
        $alert_data['alert'] = ['type' => 'success', 'message' => "The record id# ".$req_id." has been deleted successfully"];
        $this->session->set($alert_data);

        return redirect()->to($this->cc['base_url'].'Blogs/categories_list');
        }

    }

    }


    public function categories_edit()
    {

        $GLOBALS['HTMLS_CACHE'] = false;

        $user_info = $this->_verify_user_area(1);

        $req_id = $this->request->getGet('id');

        $get_row_where = array('blog_category_id' => $req_id);                    
        $get_row = $this->CRUDModel->get_row('blogs_categories', $get_row_where);

        if(!$get_row){

            $alert_data['alert'] = ['type' => 'error', 'message' => "The requested record id# ".$req_id." was not found"];
             $this->session->set($alert_data);

             return redirect()->to($this->cc['base_url'].'Blogs/categories_list');

        }else{

        $get_row_where_images = array('parent_id' => $req_id, 'parent_type' => 'blogs_categories_images');                    
        $get_result_images = $this->CRUDModel->get_result('uploads', $get_row_where_images);

        $get_row_where_gallery = array('parent_id' => $req_id, 'parent_type' => 'blogs_categories_gallery');                    
        $get_result_gallery = $this->CRUDModel->get_result('uploads', $get_row_where_gallery);

        $view_data['form'] = array('id' => $req_id, 'token' => get_token_fnc(16), 'slug' => $get_row['slug'], 'title' => $get_row['title'], 'name' => $get_row['name'], 'spotlight' => $get_row['spotlight'], 'description' => $get_row['description'], 'status' => $get_row['status'], 'searchable' => $get_row['searchable'], 'listed' => $get_row['listed'], 'featured' => $get_row['featured'], 'today_views' => $get_row['today_views'], 'lifetime_views' => $get_row['lifetime_views'], 'today_hits' => $get_row['today_hits'], 'lifetime_hits' => $get_row['lifetime_hits'], 'votes' => $get_row['votes'], 'ratings' => $get_row['ratings'], 'scores' => $get_row['scores'], 'likes' => $get_row['likes'], 'top' => $get_row['top'], 'bottom' => $get_row['bottom'], 'published_year' => date('Y', $get_row['published_time']), 'published_month' => date('n', $get_row['published_time']), 'published_day' => date('j', $get_row['published_time']), 'published_hour' => date('H', $get_row['published_time']), 'published_minute' => date('i', $get_row['published_time']), 'published_second' => date('s', $get_row['published_time']), 'meta_title' => $get_row['meta_title'], 'meta_description' => $get_row['meta_description'], 'meta_keywords' => $get_row['meta_keywords'], 'images' => $get_result_images, 'gallery' => $get_result_gallery);

        if ($this->request->getMethod() == "POST") {

        if($user_info['role'] == 0){
         $alert_data['alert'] = ['type' => 'error', 'message' => "Authorization failed: You are not permitted to perform this action."];
             $this->session->set($alert_data);
             return redirect()->to($this->cc['base_url'].'Backend');
        }

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
                    $do_count = $this->CRUDModel->do_count('blogs_categories', $do_count_where);

                    if($do_count > 0){
    
                        $alert_data['alert'] = ['type' => 'error', 'message' => 'Duplicate records entry not allowed'];        
                        $this->session->set($alert_data);

                    }else{   

                    $do_update_where = array('blog_category_id' => $req_id);

                    $var_published_time = "$req_published_year-$req_published_month-$req_published_day $req_published_hour:$req_published_minute:$req_published_second";
                    $var_published_time = datetime_to_unixtimestamp_fnc($var_published_time);

                    $do_update_data =  array('slug' => slug_fnc($req_slug), 'title' => $req_title, 'name' => $req_name, 'spotlight' => $req_spotlight, 'description' => $req_description, 'status' => $req_status, 'searchable' => $req_searchable, 'today_views' => $req_today_views, 'lifetime_views' => $req_lifetime_views, 'today_hits' => $req_today_hits, 'lifetime_hits' => $req_lifetime_hits, 'votes' => $req_votes, 'ratings' => $req_ratings, 'scores' => $req_scores, 'likes' => $req_likes, 'listed' => $req_listed, 'featured' => $req_featured, 'top' => $req_top, 'bottom' => $req_bottom, 'published_time' => $var_published_time, 'meta_title' => $req_meta_title, 'meta_description' => $req_meta_description, 'meta_keywords' => $req_meta_keywords, 'token' => $req_token, 'edit_by' => $user_info['user_id'], 'edit_time' => time(), 'edit_ip' => $this->request->getIPAddress());

                   $this->CRUDModel->do_update('blogs_categories', $do_update_where, $do_update_data);

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

                            $do_create_data_images =  array('upload_type' => 'image', 'upload_file' => $image_new_name, 'parent_id' => $req_id, 'parent_type' => 'blogs_categories_images', 'sort_order' => $var_image_sort_order, 'token' => $req_token, 'add_by' => $user_info['user_id'], 'add_time' => time(), 'add_ip' => $this->request->getIPAddress());

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

                                $do_create_data_gallery =  array('upload_type' => 'image', 'upload_file' => $gallery_new_name, 'parent_id' => $req_id, 'parent_type' => 'blogs_categories_gallery', 'sort_order' => $var_gallery_sort_order, 'token' => $req_token, 'add_by' => $user_info['user_id'], 'add_time' => time(), 'add_ip' => $this->request->getIPAddress());

                             $this->CRUDModel->do_create('uploads', $do_create_data_gallery);

    
                                }
    
                            }
    
                            $alert_data['alert'] = ['type' => 'success', 'message' => "The record id# ".$req_id." has been updated successfully"];
                            $this->session->set($alert_data);                

                            return redirect()->to($this->cc['base_url'].'Blogs/categories_list');
                        }

                }


        }

        $view_data['page'] = [
            'title' => "Edit | Categories | Blogs | ".$this->cc['app_name'],
           'description' => "",
           'keywords' => "",
           'url' => current_url(),
           'type' => "website"
         ];  
  
       $view_data['cc'] = $this->cc;

        return view('backend/'.$this->cc['backend_theme'].'/blogs_categories_edit', $view_data);

    }

    }


    public function categories_add()
    {

        $GLOBALS['HTMLS_CACHE'] = false;

        $user_info = $this->_verify_user_area(1);

        $var_db_blogs_categories = [];

        $view_data['form'] = array('token' => get_token_fnc(16), 'slug' => '', 'name' => '', 'title' => '', 'spotlight' => '', 'description' => '', 'status' => 1, 'searchable' => 1, 'listed' => 1, 'featured' => 0, 'top' => 0, 'bottom' => 0, 'published_year' => date('Y'), 'published_month' => date('n'), 'published_day' => date('j'), 'published_hour' => date('H'), 'published_minute' => date('i'), 'published_second' => date('s'), 'meta_title' => '', 'meta_description' => '', 'meta_keywords' => '', 'db_blogs_categories' => $var_db_blogs_categories, 'blogs_categories' => []);


        if ($this->request->getMethod() == "POST") {

        if($user_info['role'] == 0){
         $alert_data['alert'] = ['type' => 'error', 'message' => "Authorization failed: You are not permitted to perform this action."];
             $this->session->set($alert_data);
             return redirect()->to($this->cc['base_url'].'Backend');
        }

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
        $req_blogs_categories = $this->request->getPost('blogs_categories');

        $view_data['form'] = array('token' => $req_token, 'slug' => $req_slug, 'title' => $req_title, 'name' => $req_name, 'spotlight' => $req_spotlight, 'description' => $req_description, 'status' => $req_status, 'searchable' => $req_searchable, 'listed' => $req_listed, 'featured' => $req_featured, 'top' => $req_top, 'bottom' => $req_bottom, 'published_year' => $req_published_year, 'published_month' => $req_published_month, 'published_day' => $req_published_day, 'published_hour' => $req_published_hour, 'published_minute' => $req_published_minute, 'published_second' => $req_published_second, 'meta_title' => $req_meta_title, 'meta_description' => $req_meta_description, 'meta_keywords' => $req_meta_keywords, 'db_blogs_categories' => $var_db_blogs_categories, 'blogs_categories' => $req_blogs_categories);

            if($this->validation->withRequest($this->request)->run() == FALSE){
    
                $alert_data['alert'] = ['type' => 'error', 'message' => $this->validation->listErrors('my_validation_list')];        
                $this->session->set($alert_data);

                }else{

                    $do_count_where = array('token' => $req_token);                    
                    $do_count = $this->CRUDModel->do_count('blogs', $do_count_where);

                    if($do_count > 0){
    
                        $alert_data['alert'] = ['type' => 'error', 'message' => 'Duplicate records entry not allowed'];        
                        $this->session->set($alert_data);

                        }else{

                    $var_published_time = "$req_published_year-$req_published_month-$req_published_day $req_published_hour:$req_published_minute:$req_published_second";
                    $var_published_time = datetime_to_unixtimestamp_fnc($var_published_time);

                    $do_create_data =  array('slug' => slug_fnc($req_slug), 'title' => $req_title, 'name' => $req_name, 'spotlight' => $req_spotlight, 'description' => $req_description, 'status' => $req_status, 'searchable' => $req_searchable, 'listed' => $req_listed, 'featured' => $req_featured, 'top' => $req_top, 'bottom' => $req_bottom, 'published_time' => $var_published_time, 'meta_title' => $req_meta_title, 'meta_description' => $req_meta_description, 'meta_keywords' => $req_meta_keywords, 'token' => $req_token, 'add_by' => $user_info['user_id'], 'add_time' => time(), 'add_ip' => $this->request->getIPAddress());

                   $do_create_id = $this->CRUDModel->do_create('blogs_categories', $do_create_data);

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

                            $do_create_data_images =  array('upload_type' => 'image', 'upload_file' => $image_new_name, 'parent_id' => $do_create_id, 'parent_type' => 'blogs_categories_images', 'sort_order' => $var_image_sort_order, 'token' => $req_token, 'add_by' => $user_info['user_id'], 'add_time' => time(), 'add_ip' => $this->request->getIPAddress());

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

                                $do_create_data_gallery =  array('upload_type' => 'image', 'upload_file' => $gallery_new_name, 'parent_id' => $do_create_id, 'parent_type' => 'blogs_categories_gallery', 'sort_order' => $var_gallery_sort_order, 'token' => $req_token, 'add_by' => $user_info['user_id'], 'add_time' => time(), 'add_ip' => $this->request->getIPAddress());

                             $this->CRUDModel->do_create('uploads', $do_create_data_gallery);

    
                                }
    
                            }
    
                            $alert_data['alert'] = ['type' => 'success', 'message' => "The new record id# ".$do_create_id." has been saved successfully"];
                            $this->session->set($alert_data);   
                            
                            return redirect()->to($this->cc['base_url'].'Blogs/categories_list');

                        }

                }


        }

        $view_data['page'] = [
            'title' => "Add | Categories | Blogs | ".$this->cc['app_name'],
           'description' => "",
           'keywords' => "",
           'url' => current_url(),
           'type' => "website"
         ];  
  
       $view_data['cc'] = $this->cc;

        return view('backend/'.$this->cc['backend_theme'].'/blogs_categories_add', $view_data);

    }


    public function posts_list()
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

        $order_list = array('blog_post_id' => 'Post ID', 'title' => 'Title', 'name' => 'Name', 'published_time' => 'Published Time', 'today_view' => 'Today View', 'lifetime_view' => 'Lifetime View', 'today_hit' => 'Today Hit', 'lifetime_hit' => 'Lifetime Hit', 'votes' => 'Votes', 'ratings' => 'Ratings', 'add_time' => 'Added Time', 'edit_time' => 'Last Edited Time');
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
             return redirect()->to($this->cc['base_url'].'Blogs/posts_list');
           }

        $view_data['page'] = [
            'title' => "List | Posts | Blogs | ".$this->cc['app_name'],
           'description' => "",
           'keywords' => "",
           'url' => current_url(),
           'type' => "website"
         ];         

         $total_records = $this->CRUDModel->do_count('blogs_posts', $get_result_where, $get_result_like);

        $start = ($page-1)*$limit;

        $get_result = ($total_records > 0)?$this->CRUDModel->get_result('blogs_posts', $get_result_where, '', $order.' '.$sort, $limit, $start, $get_result_like):false;

        $url = $this->cc['base_url'].'Blogs/posts_list?query='.$query.'&order='.$order.'&sort='.$sort.'&limit='.$limit;

        $view_data['pagination'] = ($total_records > 0)?pagination_fnc($get_result, $total_records, $limit, $page, $url):false; 
        
        $view_data['order_list'] = $order_list;
        $view_data['sort_list'] = $sort_list;
        $view_data['limit_list'] = $limit_list;
        $view_data['order'] = $order;
        $view_data['sort'] = $sort;
        $view_data['limit'] = $limit;
        $view_data['query'] = $query;
  
        $view_data['cc'] = $this->cc;

        return view('backend/'.$this->cc['backend_theme'].'/blogs_posts_list', $view_data);

    }

    public function posts_delete()
    {

        $GLOBALS['HTMLS_CACHE'] = false;

        $user_info = $this->_verify_user_area(1);

        if($user_info['role'] == 0){
         $alert_data['alert'] = ['type' => 'error', 'message' => "Authorization failed: You are not permitted to perform this action."];
             $this->session->set($alert_data);
             return redirect()->to($this->cc['base_url'].'Backend');
        }

        $req_id = $this->request->getGet('id');

        $get_row_where = array('blog_post_id' => $req_id);                    
        $get_row = $this->CRUDModel->get_row('blogs_posts', $get_row_where);

        if(!$get_row){

            $alert_data['alert'] = ['type' => 'error', 'message' => "The record id# ".$req_id." was not found"];
             $this->session->set($alert_data);

             return redirect()->to($this->cc['base_url'].'Blogs/posts_list');

        }else{

            if($get_row['removable'] != 1){

            $alert_data['alert'] = ['type' => 'error', 'message' => "The record id# ".$req_id." was not removable"];
             $this->session->set($alert_data);

             return redirect()->to($this->cc['base_url'].'Blogs/posts_list');

          }else{

        $uploads_path = FCPATH.'public/uploads/';

        $get_row_where_images = array('parent_id' => $req_id, 'parent_type' => 'blogs_posts_images');                    
        $get_result_images = $this->CRUDModel->get_result('uploads', $get_row_where_images);

        $get_row_where_gallery = array('parent_id' => $req_id, 'parent_type' => 'blogs_posts_gallery');                    
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

        $this->CRUDModel->do_delete('blogs_posts', $get_row_where);

        $get_delete_children_items = array('blog_post_id' => $req_id); 
        $this->CRUDModel->do_delete('blogs_posts_to_categories', $get_delete_children_items);
            
        $alert_data['alert'] = ['type' => 'success', 'message' => "The record id# ".$req_id." has been deleted successfully"];
        $this->session->set($alert_data);

        return redirect()->to($this->cc['base_url'].'Blogs/posts_list');
        }

    }

    }


    public function posts_edit()
    {

        $GLOBALS['HTMLS_CACHE'] = false;

        $user_info = $this->_verify_user_area(1);

        $req_id = $this->request->getGet('id');

        $get_row_where = array('blog_post_id' => $req_id);                    
        $get_row = $this->CRUDModel->get_row('blogs_posts', $get_row_where);

        if(!$get_row){

            $alert_data['alert'] = ['type' => 'error', 'message' => "The requested record id# ".$req_id." was not found"];
             $this->session->set($alert_data);

             return redirect()->to($this->cc['base_url'].'Blogs/posts_list');

        }else{

        $get_row_where_images = array('parent_id' => $req_id, 'parent_type' => 'blogs_posts_images');                    
        $get_result_images = $this->CRUDModel->get_result('uploads', $get_row_where_images);

        $get_row_where_gallery = array('parent_id' => $req_id, 'parent_type' => 'blogs_posts_gallery');                    
        $get_result_gallery = $this->CRUDModel->get_result('uploads', $get_row_where_gallery);

         $var_where_posts_to_categories = ['blog_post_id' => $req_id];
            $var_select_posts_to_categories = 'blog_category_id';

            $var_db_posts_to_categories = $this->CRUDModel->get_result(
                'blogs_posts_to_categories',
                $var_where_posts_to_categories,
                $var_select_posts_to_categories
            );

            $linked_category_ids = array_column($var_db_posts_to_categories, 'blog_category_id');


            $var_db_blogs_categories = [];
            if (!empty($linked_category_ids)) {
                $var_db_blogs_categories = $this->CRUDModel->get_result(
                    'blogs_categories',
                    ['blog_category_id' => $linked_category_ids]
                );
            }

        $view_data['form'] = array('id' => $req_id, 'token' => get_token_fnc(16), 'slug' => $get_row['slug'], 'title' => $get_row['title'], 'name' => $get_row['name'], 'spotlight' => $get_row['spotlight'], 'description' => $get_row['description'], 'status' => $get_row['status'], 'searchable' => $get_row['searchable'], 'listed' => $get_row['listed'], 'featured' => $get_row['featured'], 'today_views' => $get_row['today_views'], 'lifetime_views' => $get_row['lifetime_views'], 'today_hits' => $get_row['today_hits'], 'lifetime_hits' => $get_row['lifetime_hits'], 'votes' => $get_row['votes'], 'ratings' => $get_row['ratings'], 'scores' => $get_row['scores'], 'likes' => $get_row['likes'], 'published_year' => date('Y', $get_row['published_time']), 'published_month' => date('n', $get_row['published_time']), 'published_day' => date('j', $get_row['published_time']), 'published_hour' => date('H', $get_row['published_time']), 'published_minute' => date('i', $get_row['published_time']), 'published_second' => date('s', $get_row['published_time']), 'meta_title' => $get_row['meta_title'], 'meta_description' => $get_row['meta_description'], 'meta_keywords' => $get_row['meta_keywords'], 'images' => $get_result_images, 'gallery' => $get_result_gallery, 'db_blogs_categories' => $var_db_blogs_categories, 'blogs_categories' => $var_db_posts_to_categories);

        if ($this->request->getMethod() == "POST") {

        if($user_info['role'] == 0){
         $alert_data['alert'] = ['type' => 'error', 'message' => "Authorization failed: You are not permitted to perform this action."];
             $this->session->set($alert_data);
             return redirect()->to($this->cc['base_url'].'Backend');
        }

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
        $req_published_year = $this->request->getPost('published_year');
        $req_published_month = $this->request->getPost('published_month');
        $req_published_day = $this->request->getPost('published_day');
        $req_published_hour = $this->request->getPost('published_hour');
        $req_published_minute = $this->request->getPost('published_minute');
        $req_published_second = $this->request->getPost('published_second');
        $req_meta_title = $this->request->getPost('meta_title');
        $req_meta_description = $this->request->getPost('meta_description');
        $req_meta_keywords = $this->request->getPost('meta_keywords');
        $req_blogs_categories = $this->request->getPost('blogs_categories');
        $req_today_views = $this->request->getPost('today_views');
        $req_lifetime_views = $this->request->getPost('lifetime_views');
        $req_today_hits = $this->request->getPost('today_hits');
        $req_lifetime_hits = $this->request->getPost('lifetime_hits');
        $req_votes = $this->request->getPost('votes');
        $req_ratings = $this->request->getPost('ratings');
        $req_scores = $this->request->getPost('scores');
        $req_likes = $this->request->getPost('likes');

        $view_data['form'] = array('id' => $req_id, 'token' => get_token_fnc(16), 'slug' => $req_slug, 'title' => $req_title, 'name' => $req_name, 'spotlight' => $req_spotlight, 'description' => $req_description, 'status' => $req_status, 'searchable' => $req_searchable, 'listed' => $req_listed, 'featured' => $req_featured, 'today_views' => $req_today_views, 'lifetime_views' => $req_lifetime_views, 'today_hits' => $req_today_hits, 'lifetime_hits' => $req_lifetime_hits, 'votes' => $req_votes, 'ratings' => $req_ratings, 'scores' => $req_scores, 'likes' => $req_likes, 'published_year' => $req_published_year, 'published_month' => $req_published_month, 'published_day' => $req_published_day, 'published_hour' => $req_published_hour, 'published_minute' => $req_published_minute, 'published_second' => $req_published_second, 'meta_title' => $req_meta_title, 'meta_description' => $req_meta_description, 'meta_keywords' => $req_meta_keywords, 'images' => $get_result_images, 'gallery' => $get_result_gallery, 'db_blogs_categories' => $var_db_blogs_categories, 'blogs_categories' => $req_blogs_categories);

            if($this->validation->withRequest($this->request)->run() == FALSE){
    
                $alert_data['alert'] = ['type' => 'error', 'message' => $this->validation->listErrors('my_validation_list')];        
                $this->session->set($alert_data);

                }else{

                    $var_delete_posts_to_categories = array('blog_post_id' => $req_id);
                    $this->CRUDModel->do_delete('blogs_posts_to_categories', $var_delete_posts_to_categories);

                    $do_count_where = array('token' => $req_token);                    
                    $do_count = $this->CRUDModel->do_count('blogs_posts', $do_count_where);

                    if($do_count > 0){
    
                        $alert_data['alert'] = ['type' => 'error', 'message' => 'Duplicate records entry not allowed'];        
                        $this->session->set($alert_data);

                    }else{   

                    $do_update_where = array('blog_post_id' => $req_id);

                    $var_published_time = "$req_published_year-$req_published_month-$req_published_day $req_published_hour:$req_published_minute:$req_published_second";
                    $var_published_time = datetime_to_unixtimestamp_fnc($var_published_time);

                    $do_update_data =  array('slug' => slug_fnc($req_slug), 'title' => $req_title, 'name' => $req_name, 'spotlight' => $req_spotlight, 'description' => $req_description, 'status' => $req_status, 'searchable' => $req_searchable, 'today_views' => $req_today_views, 'lifetime_views' => $req_lifetime_views, 'today_hits' => $req_today_hits, 'lifetime_hits' => $req_lifetime_hits, 'votes' => $req_votes, 'ratings' => $req_ratings, 'scores' => $req_scores, 'likes' => $req_likes, 'listed' => $req_listed, 'featured' => $req_featured,  'published_time' => $var_published_time, 'meta_title' => $req_meta_title, 'meta_description' => $req_meta_description, 'meta_keywords' => $req_meta_keywords, 'token' => $req_token, 'edit_by' => $user_info['user_id'], 'edit_time' => time(), 'edit_ip' => $this->request->getIPAddress());

                   $this->CRUDModel->do_update('blogs_posts', $do_update_where, $do_update_data);

                   if($req_blogs_categories){ 
                    foreach ($req_blogs_categories as $blog_category_id) {

                         $parent = (int) $blog_category_id;
                        if($parent > 0 ){

                            $do_create_posts_to_categories =  array('blog_post_id' => $req_id, 'blog_category_id' => $parent);
                            $this->CRUDModel->do_create('blogs_posts_to_categories', $do_create_posts_to_categories); 
                                                       
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

                            $do_create_data_images =  array('upload_type' => 'image', 'upload_file' => $image_new_name, 'parent_id' => $req_id, 'parent_type' => 'blogs_posts_images', 'sort_order' => $var_image_sort_order, 'token' => $req_token, 'add_by' => $user_info['user_id'], 'add_time' => time(), 'add_ip' => $this->request->getIPAddress());

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

                                $do_create_data_gallery =  array('upload_type' => 'image', 'upload_file' => $gallery_new_name, 'parent_id' => $req_id, 'parent_type' => 'blogs_posts_gallery', 'sort_order' => $var_gallery_sort_order, 'token' => $req_token, 'add_by' => $user_info['user_id'], 'add_time' => time(), 'add_ip' => $this->request->getIPAddress());

                             $this->CRUDModel->do_create('uploads', $do_create_data_gallery);

    
                                }
    
                            }
    
                            $alert_data['alert'] = ['type' => 'success', 'message' => "The record id# ".$req_id." has been updated successfully"];
                            $this->session->set($alert_data);                

                            return redirect()->to($this->cc['base_url'].'Blogs/posts_list');
                        }

                }


        }

        $view_data['page'] = [
            'title' => "Edit | Posts | Blogs | ".$this->cc['app_name'],
           'description' => "",
           'keywords' => "",
           'url' => current_url(),
           'type' => "website"
         ];  
  
       $view_data['cc'] = $this->cc;

        return view('backend/'.$this->cc['backend_theme'].'/blogs_posts_edit', $view_data);

    }

    }


    public function posts_add()
    {

        $GLOBALS['HTMLS_CACHE'] = false;

        $user_info = $this->_verify_user_area(1);

        $var_db_blogs_categories = [];

        $view_data['form'] = array('token' => get_token_fnc(16), 'slug' => '', 'name' => '', 'title' => '', 'spotlight' => '', 'description' => '', 'status' => 1, 'searchable' => 1, 'listed' => 1, 'featured' => 0, 'published_year' => date('Y'), 'published_month' => date('n'), 'published_day' => date('j'), 'published_hour' => date('H'), 'published_minute' => date('i'), 'published_second' => date('s'), 'meta_title' => '', 'meta_description' => '', 'meta_keywords' => '', 'db_blogs_categories' => $var_db_blogs_categories, 'blogs_categories' => []);


        if ($this->request->getMethod() == "POST") {

        if($user_info['role'] == 0){
         $alert_data['alert'] = ['type' => 'error', 'message' => "Authorization failed: You are not permitted to perform this action."];
             $this->session->set($alert_data);
             return redirect()->to($this->cc['base_url'].'Backend');
        }

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
        $req_published_year = $this->request->getPost('published_year');
        $req_published_month = $this->request->getPost('published_month');
        $req_published_day = $this->request->getPost('published_day');
        $req_published_hour = $this->request->getPost('published_hour');
        $req_published_minute = $this->request->getPost('published_minute');
        $req_published_second = $this->request->getPost('published_second');
        $req_meta_title = $this->request->getPost('meta_title');
        $req_meta_description = $this->request->getPost('meta_description');
        $req_meta_keywords = $this->request->getPost('meta_keywords');
        $req_blogs_categories = $this->request->getPost('blogs_categories');
        $req_today_views = 99;
        $req_lifetime_views = 999;
        $req_today_hits = 99;
        $req_lifetime_hits = 999;
        $req_votes = 99;
        $req_ratings = 5;
        $req_scores = 495;
        $req_likes = 99;

        $view_data['form'] = array('token' => $req_token, 'slug' => $req_slug, 'title' => $req_title, 'name' => $req_name, 'spotlight' => $req_spotlight, 'description' => $req_description, 'status' => $req_status, 'searchable' => $req_searchable, 'listed' => $req_listed, 'featured' => $req_featured, 'published_year' => $req_published_year, 'published_month' => $req_published_month, 'published_day' => $req_published_day, 'published_hour' => $req_published_hour, 'published_minute' => $req_published_minute, 'published_second' => $req_published_second, 'meta_title' => $req_meta_title, 'meta_description' => $req_meta_description, 'meta_keywords' => $req_meta_keywords, 'db_blogs_categories' => $var_db_blogs_categories, 'blogs_categories' => $req_blogs_categories);

            if($this->validation->withRequest($this->request)->run() == FALSE){
    
                $alert_data['alert'] = ['type' => 'error', 'message' => $this->validation->listErrors('my_validation_list')];        
                $this->session->set($alert_data);

                }else{

                    $do_count_where = array('token' => $req_token);                    
                    $do_count = $this->CRUDModel->do_count('blogs', $do_count_where);

                    if($do_count > 0){
    
                        $alert_data['alert'] = ['type' => 'error', 'message' => 'Duplicate records entry not allowed'];        
                        $this->session->set($alert_data);

                        }else{

                    $var_published_time = "$req_published_year-$req_published_month-$req_published_day $req_published_hour:$req_published_minute:$req_published_second";
                    $var_published_time = datetime_to_unixtimestamp_fnc($var_published_time);

                    $do_create_data =  array('slug' => slug_fnc($req_slug), 'title' => $req_title, 'name' => $req_name, 'spotlight' => $req_spotlight, 'description' => $req_description, 'status' => $req_status, 'searchable' => $req_searchable, 'listed' => $req_listed, 'featured' => $req_featured, 'published_time' => $var_published_time, 'meta_title' => $req_meta_title, 'meta_description' => $req_meta_description, 'meta_keywords' => $req_meta_keywords, 'token' => $req_token, 'add_by' => $user_info['user_id'], 'today_views' => $req_today_views, 'lifetime_views' => $req_lifetime_views, 'today_hits' => $req_today_hits, 'lifetime_hits' => $req_lifetime_hits, 'votes' => $req_votes, 'ratings' => $req_ratings, 'scores' => $req_scores, 'likes' => $req_likes, 'add_time' => time(), 'add_ip' => $this->request->getIPAddress());

                   $do_create_id = $this->CRUDModel->do_create('blogs_posts', $do_create_data);

                   if($req_blogs_categories){ 
                    foreach ($req_blogs_categories as $blog_category_id) {

                         $parent = (int) $blog_category_id;
                        if($parent > 0 ){

                            $do_create_posts_to_categories =  array('blog_post_id' => $do_create_id, 'blog_category_id' => $parent);
                            $this->CRUDModel->do_create('blogs_posts_to_categories', $do_create_posts_to_categories); 
                                                       
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

                            $do_create_data_images =  array('upload_type' => 'image', 'upload_file' => $image_new_name, 'parent_id' => $do_create_id, 'parent_type' => 'blogs_posts_images', 'sort_order' => $var_image_sort_order, 'token' => $req_token, 'add_by' => $user_info['user_id'], 'add_time' => time(), 'add_ip' => $this->request->getIPAddress());

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

                                $do_create_data_gallery =  array('upload_type' => 'image', 'upload_file' => $gallery_new_name, 'parent_id' => $do_create_id, 'parent_type' => 'blogs_posts_gallery', 'sort_order' => $var_gallery_sort_order, 'token' => $req_token, 'add_by' => $user_info['user_id'], 'add_time' => time(), 'add_ip' => $this->request->getIPAddress());

                             $this->CRUDModel->do_create('uploads', $do_create_data_gallery);

    
                                }
    
                            }
    
                            $alert_data['alert'] = ['type' => 'success', 'message' => "The new record id# ".$do_create_id." has been saved successfully"];
                            $this->session->set($alert_data);   
                            
                            return redirect()->to($this->cc['base_url'].'Blogs/posts_list');

                        }

                }


        }

        $view_data['page'] = [
            'title' => "Add | Posts | Blogs | ".$this->cc['app_name'],
           'description' => "",
           'keywords' => "",
           'url' => current_url(),
           'type' => "website"
         ];  
  
       $view_data['cc'] = $this->cc;

        return view('backend/'.$this->cc['backend_theme'].'/blogs_posts_add', $view_data);

    }


    

}