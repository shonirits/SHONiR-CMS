<?php

namespace App\Controllers;
use DirectoryIterator;

class Configurations extends Shonir_Controller
{

    public function __construct() {
        parent::__construct();
    }

   public function index()
    {

        $GLOBALS['HTMLS_CACHE'] = false;

       $this->_verify_user_area();

       $views_path = FCPATH.'app/Views/';

       $frontend_path = FCPATH.'app/Views/frontend/';
       $backend_path = FCPATH.'app/Views/backend/';

       $frontend_theme = [];
       $backend_theme = [];

       if (is_dir($frontend_path)) {
    $ft_iterator = new DirectoryIterator($frontend_path);
    foreach ($ft_iterator as $ft_fileinfo) {
        if ($ft_fileinfo->isDir() && !$ft_fileinfo->isDot()) {
            $frontend_theme[] = $ft_fileinfo->getFilename();
        }
         }
       }

       if (is_dir($backend_path)) {
    $bt_iterator = new DirectoryIterator($backend_path);
    foreach ($bt_iterator as $bt_fileinfo) {
        if ($bt_fileinfo->isDir() && !$bt_fileinfo->isDot()) {
            $backend_theme[] = $bt_fileinfo->getFilename();
        }
         }
       }

       
       $view_data['form'] = [
        'base_url' => $this->cc['base_url'],
    'assets_url' => $this->cc['assets_url'],
    'uploads_url' => $this->cc['uploads_url'],
    'img_url' => $this->cc['img_url'],
    'css_url' => $this->cc['css_url'],
    'js_url' => $this->cc['js_url'],
    'cdn_url' => $this->cc['cdn_url'],

    'app_author' => $this->cc['app_author'],
    'app_name' => $this->cc['app_name'],
    'notify_email' => $this->cc['notify_email'],
    'app_title' => $this->cc['app_title'],
    'app_meta_title' => $this->cc['app_meta_title'],
    'app_meta_description' => $this->cc['app_meta_description'],
    'app_meta_keywords' => $this->cc['app_meta_keywords'],
    'app_founding_date' => $this->cc['app_founding_date'],
    'app_telephone' => $this->cc['app_telephone'],
    'app_address' => $this->cc['app_address'],
    'app_city' => $this->cc['app_city'],
    'app_region' => $this->cc['app_region'],
    'app_postal' => $this->cc['app_postal'],
    'app_country' => $this->cc['app_country'],
    'app_languages' => $this->cc['app_languages'],
    'app_email' => $this->cc['app_email'],
    'app_website' => $this->cc['app_website'],

    'frontend_theme' => $this->cc['frontend_theme'],
    'backend_theme' => $this->cc['backend_theme'],
    'cache_time' => $this->cc['cache_time'],
    'app_key' => $this->cc['app_key'],
    'developer_mode' => $this->cc['developer_mode'],

    'price' => $this->cc['price'],
    'ratings' => $this->cc['ratings'],
    'likes' => $this->cc['likes'],
    'promo_code' => $this->cc['promo_code'],
    'badge_newbie' => $this->cc['badge_newbie'],
    'badge_featured' => $this->cc['badge_featured'],
    'badge_sale' => $this->cc['badge_sale'],
    'badge_hd' => $this->cc['badge_hd'],
    'badge_lq' => $this->cc['badge_lq'],
    'badge_st' => $this->cc['badge_st'],

    'hero_slides_width' => $this->cc['hero_slides_width'],
    'hero_slides_height' => $this->cc['hero_slides_height'],
    'tiny_image_width' => $this->cc['tiny_image_width'],
    'tiny_image_height' => $this->cc['tiny_image_height'],
    'small_image_width' => $this->cc['small_image_width'],
    'small_image_height' => $this->cc['small_image_height'],
    'medium_image_width' => $this->cc['medium_image_width'],
    'medium_image_height' => $this->cc['medium_image_height'],
    'large_image_width' => $this->cc['large_image_width'],
    'large_image_height' => $this->cc['large_image_height'],
    'category_image_width' => $this->cc['category_image_width'],
    'category_image_height' => $this->cc['category_image_height'],
    'image_quality' => $this->cc['image_quality'],

    'limit_items_list' => $this->cc['limit_items_list'],
    'limit_items_newbie' => $this->cc['limit_items_newbie'],
    'limit_items_featured' => $this->cc['limit_items_featured'],
    'limit_items_sale' => $this->cc['limit_items_sale'],
    'limit_items_trending' => $this->cc['limit_items_trending'],
    'limit_items_search' => $this->cc['limit_items_search'],
    'limit_items_all' => $this->cc['limit_items_all'],
    'limit_items_related' => $this->cc['limit_items_related'],
    'limit_items_same' => $this->cc['limit_items_same'],

    'ip_info_token' => $this->cc['ip_info_token'],
    'celebiz_public_key' => $this->cc['celebiz_public_key'],
    'celebiz_secret_key' => $this->cc['celebiz_secret_key'],

    'developer_mode_notice' => $this->cc['developer_mode_notice'],
    'head_code' => $this->cc['head_code'],
    'end_code' => $this->cc['end_code'],

    'social_facebook' => $this->cc['social_facebook'],
    'social_instagram' => $this->cc['social_instagram'],
    'social_x' => $this->cc['social_x'],
    'social_pinterest' => $this->cc['social_pinterest'],
    'social_linkedin' => $this->cc['social_linkedin'],
    'social_youtube' => $this->cc['social_youtube'],
    'social_blogger' => $this->cc['social_blogger'],
    'social_group' => $this->cc['social_group'],
    'social_tumblr' => $this->cc['social_tumblr'],
    'social_reddit' => $this->cc['social_reddit'],
    'social_whatsapp' => $this->cc['social_whatsapp'],
    'social_telegram' => $this->cc['social_telegram'],
    'social_tiktok' => $this->cc['social_tiktok'],
    'social_map' => $this->cc['social_map']
       ];


        if ($this->request->getMethod() == "POST") {

        if($user_info['role'] == 0){
         $alert_data['alert'] = ['type' => 'error', 'message' => "Authorization failed: You are not permitted to perform this action."];
             $this->session->set($alert_data);
             return redirect()->to($this->cc['base_url'].'Backend');
        }


            $this->validation->setRules([
    
    'frontend_theme' => ['label' => 'Frontend Theme', 'rules' => 'required|in_list[' . implode(',', $frontend_theme) . ']'],
    'backend_theme' => ['label' => 'Backend Theme', 'rules' => 'required|in_list[' . implode(',', $backend_theme) . ']'],

    'base_url' => ['label' => 'Base URL', 'rules' => 'required|valid_url'],
    'assets_url' => ['label' => 'Assets URL', 'rules' => 'required|valid_url'],
    'uploads_url' => ['label' => 'Uploads URL', 'rules' => 'required|valid_url'],
    'img_url' => ['label' => 'Image URL', 'rules' => 'required|valid_url'],
    'css_url' => ['label' => 'CSS URL', 'rules' => 'required|valid_url'],
    'js_url' => ['label' => 'JS URL', 'rules' => 'required|valid_url'],
    'cdn_url' => ['label' => 'CDN URL', 'rules' => 'required|valid_url'],

    'app_author' => ['label' => 'Author', 'rules' => 'required|trim|min_length[2]|max_length[64]'],
    'app_name' => ['label' => 'Name', 'rules' => 'required|trim|min_length[2]|max_length[64]'],
    'notify_email' => ['label' => 'Notify Email', 'rules' => 'required|valid_email'],
    'app_title' => ['label' => 'Title', 'rules' => 'required|trim'],
    'app_meta_title' => ['label' => 'Meta Title', 'rules' => 'required|trim'],
    'app_meta_description' => ['label' => 'Meta Description', 'rules' => 'required|trim'],
    'app_meta_keywords' => ['label' => 'Meta Keywords', 'rules' => 'required|trim'],
    'app_founding_date' => ['label' => 'Founding Date', 'rules' => 'required|regex_match[/^\d{4}-\d{2}-\d{2}$/]'],
    'app_telephone' => ['label' => 'Telephone', 'rules' => 'required|trim'],
    'app_address' => ['label' => 'Address', 'rules' => 'required|trim'],
    'app_city' => ['label' => 'City', 'rules' => 'required|trim'],
    'app_region' => ['label' => 'Region', 'rules' => 'required|trim'],
    'app_postal' => ['label' => 'Postal Code', 'rules' => 'required|trim'],
    'app_country' => ['label' => 'Country', 'rules' => 'required|alpha|max_length[2]'],
    'app_languages' => ['label' => 'Languages', 'rules' => 'required|trim'],
    'app_email' => ['label' => 'Email', 'rules' => 'required|valid_email'],
    'app_website' => ['label' => 'Website', 'rules' => 'required|trim'],

    'cache_time' => ['label' => 'Cache Time', 'rules' => 'required|numeric'],
    'app_key' => ['label' => 'App Key', 'rules' => 'required|alpha_numeric'],

    'hero_slides_width' => ['label' => 'Hero Width', 'rules' => 'required|numeric'],
    'hero_slides_height' => ['label' => 'Hero Height', 'rules' => 'required|numeric'],
    'tiny_image_width' => ['label' => 'Tiny Width', 'rules' => 'required|numeric'],
    'tiny_image_height' => ['label' => 'Tiny Height', 'rules' => 'required|numeric'],
    'small_image_width' => ['label' => 'Small Width', 'rules' => 'required|numeric'],
    'small_image_height' => ['label' => 'Small Height', 'rules' => 'required|numeric'],
    'medium_image_width' => ['label' => 'Medium Width', 'rules' => 'required|numeric'],
    'medium_image_height' => ['label' => 'Medium Height', 'rules' => 'required|numeric'],
    'large_image_width' => ['label' => 'Large Width', 'rules' => 'required|numeric'],
    'large_image_height' => ['label' => 'Large Height', 'rules' => 'required|numeric'],
    'category_image_width' => ['label' => 'Category Width', 'rules' => 'required|numeric'],
    'category_image_height' => ['label' => 'Category Height', 'rules' => 'required|numeric'],
    'image_quality' => ['label' => 'Image Quality', 'rules' => 'required|numeric|greater_than_equal_to[0]|less_than_equal_to[100]'],

    'limit_items_list' => ['label' => 'Items By Category', 'rules' => 'required|numeric'],
    'limit_items_newbie' => ['label' => 'New Items Page', 'rules' => 'required|numeric'],
    'limit_items_featured' => ['label' => 'Featured Items Page', 'rules' => 'required|numeric'],
    'limit_items_sale' => ['label' => 'onSale Items Page', 'rules' => 'required|numeric'],
    'limit_items_trending' => ['label' => 'Trending Items Page', 'rules' => 'required|numeric'],
    'limit_items_search' => ['label' => 'Search Items Page', 'rules' => 'required|numeric'],
    'limit_items_all' => ['label' => 'All Items Page', 'rules' => 'required|numeric'],
    'limit_items_related' => ['label' => 'Related Items', 'rules' => 'required|numeric'],
    'limit_items_same' => ['label' => 'Same Category Items', 'rules' => 'required|numeric'],

    'ip_info_token' => ['label' => 'IP Info Token', 'rules' => 'required|trim'],
    'celebiz_public_key' => ['label' => 'Celebiz Public Key', 'rules' => 'required|trim'],
    'celebiz_secret_key' => ['label' => 'Celebiz Secret Key', 'rules' => 'required|trim'],

    'developer_mode_notice' => ['label' => 'Developer Mode Notice', 'rules' => 'required|trim'],
]);

$req_base_url = $this->request->getPost('base_url');
$req_assets_url = $this->request->getPost('assets_url');
$req_uploads_url = $this->request->getPost('uploads_url');
$req_img_url = $this->request->getPost('img_url');
$req_css_url = $this->request->getPost('css_url');
$req_js_url = $this->request->getPost('js_url');
$req_cdn_url = $this->request->getPost('cdn_url');

$req_app_author = $this->request->getPost('app_author');
$req_app_name = $this->request->getPost('app_name');
$req_notify_email = $this->request->getPost('notify_email');
$req_app_title = $this->request->getPost('app_title');
$req_app_meta_title = $this->request->getPost('app_meta_title');
$req_app_meta_description = $this->request->getPost('app_meta_description');
$req_app_meta_keywords = $this->request->getPost('app_meta_keywords');
$req_app_founding_date = $this->request->getPost('app_founding_date');
$req_app_telephone = $this->request->getPost('app_telephone');
$req_app_address = $this->request->getPost('app_address');
$req_app_city = $this->request->getPost('app_city');
$req_app_region = $this->request->getPost('app_region');
$req_app_postal = $this->request->getPost('app_postal');
$req_app_country = $this->request->getPost('app_country');
$req_app_languages = $this->request->getPost('app_languages');
$req_app_email = $this->request->getPost('app_email');
$req_app_website = $this->request->getPost('app_website');

$req_frontend_theme = $this->request->getPost('frontend_theme');
$req_backend_theme = $this->request->getPost('backend_theme');
$req_cache_time = $this->request->getPost('cache_time');
$req_app_key = $this->request->getPost('app_key');
$req_developer_mode = $this->request->getPost('developer_mode') ?? 'FALSE';

$req_price = $this->request->getPost('price') ?? 'FALSE';
$req_ratings = $this->request->getPost('ratings') ?? 'FALSE';
$req_likes = $this->request->getPost('likes') ?? 'FALSE';
$req_promo_code = $this->request->getPost('promo_code') ?? 'FALSE';
$req_badge_newbie = $this->request->getPost('badge_newbie') ?? 'FALSE';
$req_badge_featured = $this->request->getPost('badge_featured') ?? 'FALSE';
$req_badge_sale = $this->request->getPost('badge_sale') ?? 'FALSE';
$req_badge_sale = $this->request->getPost('badge_sale') ?? 'FALSE';
$req_badge_hd = $this->request->getPost('badge_hd') ?? 'FALSE';
$req_badge_lq = $this->request->getPost('badge_lq') ?? 'FALSE';
$req_badge_st = $this->request->getPost('badge_st') ?? 'FALSE';

$req_hero_slides_width = $this->request->getPost('hero_slides_width');
$req_hero_slides_height = $this->request->getPost('hero_slides_height');
$req_tiny_image_width = $this->request->getPost('tiny_image_width');
$req_tiny_image_height = $this->request->getPost('tiny_image_height');
$req_small_image_width = $this->request->getPost('small_image_width');
$req_small_image_height = $this->request->getPost('small_image_height');
$req_medium_image_width = $this->request->getPost('medium_image_width');
$req_medium_image_height = $this->request->getPost('medium_image_height');
$req_large_image_width = $this->request->getPost('large_image_width');
$req_large_image_height = $this->request->getPost('large_image_height');
$req_category_image_width = $this->request->getPost('category_image_width');
$req_category_image_height = $this->request->getPost('category_image_height');
$req_image_quality = $this->request->getPost('image_quality');

$req_limit_items_list = $this->request->getPost('limit_items_list');
$req_limit_items_newbie = $this->request->getPost('limit_items_newbie');
$req_limit_items_featured = $this->request->getPost('limit_items_featured');
$req_limit_items_sale = $this->request->getPost('limit_items_sale');
$req_limit_items_trending = $this->request->getPost('limit_items_trending');
$req_limit_items_search = $this->request->getPost('limit_items_search');
$req_limit_items_all = $this->request->getPost('limit_items_all');
$req_limit_items_related = $this->request->getPost('limit_items_related');
$req_limit_items_same = $this->request->getPost('limit_items_same');

$req_ip_info_token = $this->request->getPost('ip_info_token');
$req_celebiz_public_key = $this->request->getPost('celebiz_public_key');
$req_celebiz_secret_key = $this->request->getPost('celebiz_secret_key');

$req_developer_mode_notice = $this->request->getPost('developer_mode_notice');
$req_head_code = $this->request->getPost('head_code');
$req_end_code = $this->request->getPost('end_code');

$req_social_facebook = $this->request->getPost('social_facebook');
$req_social_instagram = $this->request->getPost('social_instagram');
$req_social_x = $this->request->getPost('social_x');
$req_social_pinterest = $this->request->getPost('social_pinterest');
$req_social_linkedin = $this->request->getPost('social_linkedin');
$req_social_youtube = $this->request->getPost('social_youtube');
$req_social_blogger = $this->request->getPost('social_blogger');
$req_social_group = $this->request->getPost('social_group');
$req_social_tumblr = $this->request->getPost('social_tumblr');
$req_social_reddit = $this->request->getPost('social_reddit');
$req_social_whatsapp = $this->request->getPost('social_whatsapp');
$req_social_telegram = $this->request->getPost('social_telegram');
$req_social_tiktok = $this->request->getPost('social_tiktok');
$req_social_map = $this->request->getPost('social_map');

$view_data['form'] = [
    'base_url' => $req_base_url,
    'assets_url' => $req_assets_url,
    'uploads_url' => $req_uploads_url,
    'img_url' => $req_img_url,
    'css_url' => $req_css_url,
    'js_url' => $req_js_url,
    'cdn_url' => $req_cdn_url,

    'app_author' => $req_app_author,
    'app_name' => $req_app_name,
    'notify_email' => $req_notify_email,
    'app_title' => $req_app_title,
    'app_meta_title' => $req_app_meta_title,
    'app_meta_description' => $req_app_meta_description,
    'app_meta_keywords' => $req_app_meta_keywords,
    'app_founding_date' => $req_app_founding_date,
    'app_telephone' => $req_app_telephone,
    'app_address' => $req_app_address,
    'app_city' => $req_app_city,
    'app_region' => $req_app_region,
    'app_postal' => $req_app_postal,
    'app_country' => $req_app_country,
    'app_languages' => $req_app_languages,
    'app_email' => $req_app_email,
    'app_website' => $req_app_website,

    'frontend_theme' => $req_frontend_theme,
    'backend_theme' => $req_backend_theme,
    'cache_time' => $req_cache_time,
    'app_key' => $req_app_key,
    'developer_mode' => $req_developer_mode,

    'price' => $req_price,
    'ratings' => $req_ratings,
    'likes' => $req_likes,
    'promo_code' => $req_promo_code,
    'badge_newbie' => $req_badge_newbie,
    'badge_featured' => $req_badge_featured,
    'badge_sale' => $req_badge_sale,
    'badge_sale' => $req_badge_sale,
    'badge_hd' => $req_badge_hd,
    'badge_lq' => $req_badge_lq,
    'badge_st' => $req_badge_st,

    'hero_slides_width' => $req_hero_slides_width,
    'hero_slides_height' => $req_hero_slides_height,
    'tiny_image_width' => $req_tiny_image_width,
    'tiny_image_height' => $req_tiny_image_height,
    'small_image_width' => $req_small_image_width,
    'small_image_height' => $req_small_image_height,
    'medium_image_width' => $req_medium_image_width,
    'medium_image_height' => $req_medium_image_height,
    'large_image_width' => $req_large_image_width,
    'large_image_height' => $req_large_image_height,
    'category_image_width' => $req_category_image_width,
    'category_image_height' => $req_category_image_height,
    'image_quality' => $req_image_quality,

    'limit_items_list' => $req_limit_items_list,
    'limit_items_newbie' => $req_limit_items_newbie,
    'limit_items_featured' => $req_limit_items_featured,
    'limit_items_sale' => $req_limit_items_sale,
    'limit_items_trending' => $req_limit_items_trending,
    'limit_items_search' => $req_limit_items_search,
    'limit_items_all' => $req_limit_items_all,
    'limit_items_related' => $req_limit_items_related,
    'limit_items_same' => $req_limit_items_same,

    'ip_info_token' => $req_ip_info_token,
    'celebiz_public_key' => $req_celebiz_public_key,
    'celebiz_secret_key' => $req_celebiz_secret_key,

    'developer_mode_notice' => $req_developer_mode_notice,
    'head_code' => $req_head_code,    
    'end_code' => $req_end_code,

    'social_facebook' => $req_social_facebook,
    'social_instagram' => $req_social_instagram,
    'social_x' => $req_social_x,
    'social_pinterest' => $req_social_pinterest,
    'social_linkedin' => $req_social_linkedin,
    'social_youtube' => $req_social_youtube,
    'social_blogger' => $req_social_blogger,
    'social_group' => $req_social_group,
    'social_tumblr' => $req_social_tumblr,
    'social_reddit' => $req_social_reddit,
    'social_whatsapp' => $req_social_whatsapp,
    'social_telegram' => $req_social_telegram,
    'social_tiktok' => $req_social_tiktok,
    'social_map' => $req_social_map
];

if($this->validation->withRequest($this->request)->run() == FALSE){
    
                $alert_data['alert'] = ['type' => 'error', 'message' => $this->validation->listErrors('my_validation_list')];        
                $this->session->set($alert_data);

                }else{

$config_data = [

    'base_url' => $req_base_url,
    'assets_url' => $req_assets_url,
    'uploads_url' => $req_uploads_url,
    'img_url' => $req_img_url,
    'css_url' => $req_css_url,
    'js_url' => $req_js_url,
    'cdn_url' => $req_cdn_url,

    'app_author' => $req_app_author,
    'app_name' => $req_app_name,
    'notify_email' => $req_notify_email,
    'app_title' => $req_app_title,
    'app_meta_title' => $req_app_meta_title,
    'app_meta_description' => $req_app_meta_description,
    'app_meta_keywords' => $req_app_meta_keywords,
    'app_founding_date' => $req_app_founding_date,
    'app_telephone' => $req_app_telephone,
    'app_address' => $req_app_address,
    'app_city' => $req_app_city,
    'app_region' => $req_app_region,
    'app_postal' => $req_app_postal,
    'app_country' => $req_app_country,
    'app_languages' => $req_app_languages,
    'app_email' => $req_app_email,
    'app_website' => $req_app_website,

    'frontend_theme' => $req_frontend_theme,
    'backend_theme' => $req_backend_theme,
    'cache_time' => $req_cache_time,
    'app_key' => $req_app_key,
    'developer_mode' => $req_developer_mode,

    'price' => $req_price,
    'ratings' => $req_ratings,
    'likes' => $req_likes,
    'promo_code' => $req_promo_code,
    'badge_newbie' => $req_badge_newbie,
    'badge_featured' => $req_badge_featured,
    'badge_sale' => $req_badge_sale,
    'badge_hd' => $req_badge_hd,
    'badge_lq' => $req_badge_lq,
    'badge_st' => $req_badge_st,

    'hero_slides_width' => $req_hero_slides_width,
    'hero_slides_height' => $req_hero_slides_height,
    'tiny_image_width' => $req_tiny_image_width,
    'tiny_image_height' => $req_tiny_image_height,
    'small_image_width' => $req_small_image_width,
    'small_image_height' => $req_small_image_height,
    'medium_image_width' => $req_medium_image_width,
    'medium_image_height' => $req_medium_image_height,
    'large_image_width' => $req_large_image_width,
    'large_image_height' => $req_large_image_height,
    'category_image_width' => $req_category_image_width,
    'category_image_height' => $req_category_image_height,
    'image_quality' => $req_image_quality,

    'limit_items_list' => $req_limit_items_list,
    'limit_items_newbie' => $req_limit_items_newbie,
    'limit_items_featured' => $req_limit_items_featured,
    'limit_items_sale' => $req_limit_items_sale,
    'limit_items_trending' => $req_limit_items_trending,
    'limit_items_search' => $req_limit_items_search,
    'limit_items_all' => $req_limit_items_all,
    'limit_items_related' => $req_limit_items_related,
    'limit_items_same' => $req_limit_items_same,

    'ip_info_token' => $req_ip_info_token,
    'celebiz_public_key' => $req_celebiz_public_key,
    'celebiz_secret_key' => $req_celebiz_secret_key,

    'developer_mode_notice' => $req_developer_mode_notice,
    'head_code' => $req_head_code,
    'end_code' => $req_end_code,

    'social_facebook' => $req_social_facebook,
    'social_instagram' => $req_social_instagram,
    'social_x' => $req_social_x,
    'social_pinterest' => $req_social_pinterest,
    'social_linkedin' => $req_social_linkedin,
    'social_youtube' => $req_social_youtube,
    'social_blogger' => $req_social_blogger,
    'social_group' => $req_social_group,
    'social_tumblr' => $req_social_tumblr,
    'social_reddit' => $req_social_reddit,
    'social_whatsapp' => $req_social_whatsapp,
    'social_telegram' => $req_social_telegram,
    'social_tiktok' => $req_social_tiktok,
    'social_map' => $req_social_map,
];

        foreach($config_data as $config_key => $config_value){

            $req_id = $config_key;

            $get_row_where = array('config_key' => $config_key);                    
            $get_row = $this->CRUDModel->get_row('config', $get_row_where);

            if($get_row){

                $config_update_where = array('config_id' => $get_row['config_id']);

                $config_update_data = [
                    'config_value' => $config_value
                ];
                $this->CRUDModel->do_update('config', $config_update_where, $config_update_data);

                
            }


                }

                 $alert_data['alert'] = ['type' => 'success', 'message' => "The record configurations has been updated successfully"];
                            $this->session->set($alert_data);                

                 return redirect()->to($this->cc['base_url'].'Backend');



                }


        }


        $view_data['page'] = [
            'title' => "Configurations | ".$this->cc['app_name'],
           'description' => "",
           'keywords' => "",
           'url' => current_url(),
           'type' => "website"
         ];  

        $view_data['cc'] = $this->cc;   
        $view_data['frontend_themes'] = $frontend_theme;
        $view_data['backend_themes'] = $backend_theme;     

        return view('backend/'.$this->cc['backend_theme'].'/configurations', $view_data);

        }


}