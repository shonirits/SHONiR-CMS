<?php

namespace App\Controllers;

class Ajax extends Shonir_Controller
{

    public function __construct() {
        parent::__construct();
        
    }

    public function _statistics_update($statistics_where = []){

       $get_categories_statistics = $this->CRUDModel->get_result('categories', $statistics_where);

      if (!empty($get_categories_statistics)) {
       foreach ($get_categories_statistics as $category) {

        $get_all_categories_id = [$category['category_id']];
          $get_all_child_categories_id = $this->_get_all_child_categories_id($category['category_id']);
          $get_all_categories_id = array_merge($get_all_categories_id, $get_all_child_categories_id);

          $count_categories_childrens = $this->CRUDModel->do_count('categories_to_categories', [
              'parent_id' => $get_all_categories_id
          ]);

          $count_categories_items = $this->CRUDModel->do_count('items_to_categories', [
              'category_id' => $get_all_categories_id
          ]);

          $do_update_categories_where = ['category_id' => $category['category_id']];
          $do_update_categories_data = [
              'childrens' => $count_categories_childrens,
              'items' => $count_categories_items,
              'statistics_update' => time()
          ];
          $this->CRUDModel->do_update('categories', $do_update_categories_where, $do_update_categories_data);
      }
    }


    $get_blogs_categories_statistics = $this->CRUDModel->get_result('blogs_categories', $statistics_where);

      if (!empty($get_blogs_categories_statistics)) {
       foreach ($get_blogs_categories_statistics as $blog_category) {

        $get_all_blogs_categories_id = [$blog_category['blog_category_id']];
          $get_all_blogs_child_categories_id = $this->_get_all_blogs_child_categories_id($blog_category['blog_category_id']);
          $get_all_blogs_categories_id = array_merge($get_all_blogs_categories_id, $get_all_blogs_child_categories_id);

          $count_blogs_categories_childrens = $this->CRUDModel->do_count('blogs_categories_to_categories', [
              'parent_id' => $get_all_blogs_categories_id
          ]);

          $count_blogs_categories_posts = $this->CRUDModel->do_count('blogs_posts_to_categories', [
              'blog_category_id' => $get_all_blogs_categories_id
          ]);

          $do_update_blogs_categories_where = ['blog_category_id' => $blog_category['blog_category_id']];
          $do_update_blogs_categories_data = [
              'childrens' => $count_blogs_categories_childrens,
              'posts' => $count_blogs_categories_posts,
              'statistics_update' => time()
          ];
          $this->CRUDModel->do_update('blogs_categories', $do_update_blogs_categories_where, $do_update_blogs_categories_data);
      }
    }

            $statistics_map = [
                'awards'     => 'award_id',
                'brands'     => 'brand_id',
                'industries' => 'industry_id',
                'places'     => 'place_id',
                'regions'    => 'region_id',
                'sections'   => 'section_id',
                'voices'     => 'voice_id',
                'talents'    => 'talent_id'
            ];


            foreach ($statistics_map as $table => $column) {
                $records = $this->CRUDModel->get_result($table, $statistics_where);

                if (!empty($records)) {
                foreach ($records as $record) {
                    $count_where = [$column => $record[$column]];
                    $count = $this->CRUDModel->do_count("items_to_{$table}", $count_where);

                    $update_where = [$column => $record[$column]];
                    $update_data = ['items' => $count, 'statistics_update' => time()];

                    $this->CRUDModel->do_update($table, $update_where, $update_data);
                }
              }
            }

            $rend = rand(1, 3);
          sleep($rend);

            return true;


    }

      public function _cleanup_caches($step, $do){

  switch ($step) {
        case 1:

          $rend = rand(1, 3);
          sleep($rend);

           $this->_statistics_update();
           
      $tmp_life_time = ($do)?time()+86400:time()-86400;
      $tmp_timestamp = ($do)?date('Y-m-d H:i:s', strtotime('+1 day')):date('Y-m-d H:i:s', strtotime('-1 day'));

      $do_delete_ci_sessions_where = ['timestamp <' => $tmp_timestamp]; 
      $this->CRUDModel->do_delete('ci_sessions', $do_delete_ci_sessions_where);

      $visitors_where = ['edit_time<' => $tmp_life_time]; 
      $this->CRUDModel->do_delete('visitors', $visitors_where);

      $likes_where = ['add_time<' => $tmp_life_time]; 
      $this->CRUDModel->do_delete('likes', $likes_where);

      $ratings_where = ['add_time<' => $tmp_life_time]; 
      $this->CRUDModel->do_delete('ratings', $ratings_where);

      $captcha_where = ['add_at<' => $tmp_life_time]; 
      $this->CRUDModel->do_delete('captcha', $captcha_where);

      $mails_queues_where = ['last_try_time<' => $tmp_life_time, 'status' => 1]; 
      $this->CRUDModel->do_delete('mails_queues', $mails_queues_where);

          break;

        case 2:

          $rend = rand(1, 3);
          sleep($rend);

      $tmp_life_time = ($do)?time()+86400:time()-86400;

      $get_carts_where = ['add_time<' => $tmp_life_time];      
      $get_carts = $this->CRUDModel->get_result('carts', $get_carts_where);

      if(!empty($get_carts)){

        foreach($get_carts as $cart){
          $do_delete_carts_items_where = ['cart_id' => $cart['cart_id']]; 
          $this->CRUDModel->do_delete('carts_items', $do_delete_carts_items_where);

          $do_delete_carts_where = ['cart_id' => $cart['cart_id']]; 
        $this->CRUDModel->do_delete('carts', $do_delete_carts_where);
        }

      }

          break;
        
        case 3:

          $rend = rand(1, 3);
          sleep($rend);

      $php_cache_life = ($do)?time()+86400:time() - $this->cc['cache_time'];
      $php_cache_path = FCPATH.'writable/cache/';
      $php_files = array_filter(glob($php_cache_path . '/*'), fn($file) => is_file($file) && filemtime($file) < $php_cache_life);

      if (!empty($php_files)) {
      foreach ($php_files as $php) {
        if (is_file($php)) {
            unlink($php);
        }
      } 
    }     

          break;

        case 4:

          $rend = rand(1, 3);
          sleep($rend);

          $htmls_cache_life = ($do)?time()+86400:time() - (($this->cc['cache_time']+3600)*24);
       $htmls_cache_path = FCPATH.'writable/cache/htmls/';
  $htmls_files = array_filter(glob($htmls_cache_path . '/*'), fn($file) => is_file($file) && filemtime($file) < $htmls_cache_life);

  if (!empty($htmls_files)) {
      foreach ($htmls_files as $html) {
        if (is_file($html)) {
            unlink($html);
        }
      }
    }

          break;

        case 5:

          $rend = rand(1, 3);
          sleep($rend);

      $images_cache_life = ($do)?time()+86400:time() - (($this->cc['cache_time']+86400)*365);
     $images_cache_path = FCPATH.'writable/cache/images/';   
      $images_files = array_filter(glob($images_cache_path . '/*'), fn($file) => is_file($file) && filemtime($file) < $images_cache_life);

      if (!empty($images_files)) {
      foreach ($images_files as $image) {
        if (is_file($image)) {
            unlink($image);
        }
      }
    }

          break;

  }

  $rend = rand(1, 3);
  sleep($rend);

      return true;

      }



public function _get_all_child_categories_id($parentId, &$collected = []) {
    $children = $this->CRUDModel->get_result('categories_to_categories', ['parent_id' => $parentId]);

    if (!empty($children)) {
    foreach ($children as $child) {
        $childId = $child['children_id'];
        if (!in_array($childId, $collected)) {
            $collected[] = $childId;
            $this->_get_all_child_categories_id($childId, $collected); 
        }
    }
  }

    return $collected;
}

public function _get_all_blogs_child_categories_id($parentId, &$collected = []) {
    $children = $this->CRUDModel->get_result('blogs_categories_to_categories', ['parent_id' => $parentId]);

    if (!empty($children)) {
    foreach ($children as $child) {
        $childId = $child['children_id'];
        if (!in_array($childId, $collected)) {
            $collected[] = $childId;
            $this->_get_all_blogs_child_categories_id($childId, $collected); 
        }
    }
  }

    return $collected;
}

    public function cron()
    {

      if ($this->session->get('last_request_time') && (time() - $this->session->get('last_request_time')) < 5) {
        die("Too many requests, please wait.");
        }
    $this->session->set('last_request_time', time());

    $req_do = false;
    $req_step = 0;

    if($this->request->isAJAX()){

    if($this->_is_user_logged_in()){

    $req_do = $this->request->getGetPost('do') ?? false;
    $req_step = (int) ($this->request->getGet('step') ?? 0);

    }

    }

    $servers = $this->CRUDModel->get_result('mails_servers', ['status' => 1]);

    if (!empty($servers)) {
foreach ($servers as $server) {
    $relay_data = relay_types_fnc($server['relay_type'], 'data');
    $reset_interval = $relay_data['reset'];

    if ($reset_interval <= 0) {
        continue;
    }

    $next_reset_time = $server['reset_time'] + $reset_interval;
    if (time() >= $next_reset_time) {
        $update_data = [
            'sent' => 0,
            'reset_time' => time()
        ];
        $this->CRUDModel->do_update('mails_servers', ['mail_server_id' => $server['mail_server_id']], $update_data);
    }
}
    }

    $rend = rand(1, 3);
    sleep($rend);

    $last_try_time = (time()-300);
    $get_mails_queues_where = array('status' => 0, 'total_try <' => 12, 'last_try_time <' => $last_try_time); 
    $get_mails_queues_order = 'total_try ASC, priority DESC, RAND()';
    $get_mails_queues = $this->CRUDModel->get_row('mails_queues', $get_mails_queues_where, '*', $get_mails_queues_order);
    if($get_mails_queues){

    $do_update_mails_queues_where = array('mail_queue_id' => $get_mails_queues['mail_queue_id']);
    $do_update_mails_queues_data = array('last_try_time' => time());
    $this->CRUDModel->do_update('mails_queues', $do_update_mails_queues_where, $do_update_mails_queues_data);

    $last_used_time = (time()-60);
    $get_mails_servers_where = "status = 1 AND last_used_time < {$last_used_time} AND sent < relay";

    $get_mails_servers_order = 'total_used ASC, priority DESC, RAND()';
    $get_mails_servers = $this->CRUDModel->get_row('mails_servers', $get_mails_servers_where, '*', $get_mails_servers_order);
    if($get_mails_servers){

    $do_update_mails_servers_where = array('mail_server_id' => $get_mails_servers['mail_server_id']);
    $do_update_mails_servers_data = array('last_used_time' => time(), 'total_used' => $get_mails_servers['total_used']+1);
    $this->CRUDModel->do_update('mails_servers', $do_update_mails_servers_where, $do_update_mails_servers_data);

    $do_update_mails_queues_data = array('total_try' => $get_mails_queues['total_try']+1);
    $this->CRUDModel->do_update('mails_queues', $do_update_mails_queues_where, $do_update_mails_queues_data);

    $email = \Config\Services::email();

    $config['priority']   = $get_mails_queues['priority'];
    $config['userAgent']   = 'SHONiR';
    $config['validate']   = true;
    $config['protocol']   = 'smtp';
    $config['SMTPHost']   = $get_mails_servers['hostname'] ?? '';
    $config['SMTPPort'] = isset($get_mails_servers['port']) ? (int) $get_mails_servers['port'] : '';
    $config['SMTPCrypto'] = $get_mails_servers['crypto'] ?? '';
    $config['SMTPUser']   = $get_mails_servers['username'] ?? '';
    $config['SMTPPass']   = $get_mails_servers['password'] ?? '';
    $config['mailType'] = $get_mails_queues['mail_type'];
    $config['SMTPTimeout'] = 30;
    $config['charset']     = 'UTF-8';
    $config['newline'] = "\r\n";
    $config['crlf']    = "\r\n";
    $config['SMTPKeepAlive'] = true;
    $config['wordWrap']      = true;
    $config['wrapChars']     = 76;

    $email->initialize($config);

    $email->setHeader('List-Unsubscribe', '<'.$get_mails_servers['email'].'>, <'.$this->cc['base_url'].'Ajax/execution?mqid='.$get_mails_queues['mail_queue_id'].'&do=unsubscribe&email='.$get_mails_queues['to_email'].'&token='.get_token_fnc(16).'>');
    $email->setFrom($get_mails_servers['email'], $this->cc['app_name']);
    $email->setTo($get_mails_queues['to_email'], $get_mails_queues['to_name']);
    $email->setSubject($get_mails_queues['mail_subject']);
    $email->setMessage($get_mails_queues['mail_content']);

    if(is_serialized_fnc($get_mails_queues['mail_attachments'])){
      $db_mail_attachments = unserialize($get_mails_queues['mail_attachments']);
      }

      if(is_array($db_mail_attachments)){
      foreach ($db_mail_attachments as $attachment) {
    $path = FCPATH . 'public/tmp/' . $attachment;
    if (is_file($path)) {
        $email->attach($path);
          }
      }
      }

      if ($email->send())
      {
        $do_update_mails_servers_data = array('succeed' => $get_mails_servers['succeed']+1, 'sent' => $get_mails_servers['sent']+1);
        $do_update_mails_queues_data = array('status' => 1, 'mail_server_id' => $get_mails_servers['mail_server_id']);

        }else{

       $last_error = $email->printDebugger(['headers', 'subject', 'body']);
       $do_update_mails_servers_data = array('last_error' => $last_error, 'last_error_time' => time(), 'failed' => $get_mails_servers['failed']+1);
       $do_update_mails_queues_data = array('last_error' => $last_error, 'mail_server_id' => $get_mails_servers['mail_server_id']);

        }

    $this->CRUDModel->do_update('mails_servers', $do_update_mails_servers_where, $do_update_mails_servers_data);
    $this->CRUDModel->do_update('mails_queues', $do_update_mails_queues_where, $do_update_mails_queues_data);

    }
    }
      
      
      if($req_do == true && $req_step > 0){

      $this->_cleanup_caches($req_step, $req_do);

      }else{
        
        $this->_cleanup_caches(1, $req_do);
        $rend = rand(1, 3);
        sleep($rend);
        $this->_cleanup_caches(2, $req_do);
        $rend = rand(1, 3);
        sleep($rend);
        $this->_cleanup_caches(3, $req_do);
        $rend = rand(1, 3);
        sleep($rend);
        $this->_cleanup_caches(4, $req_do);
        $rend = rand(1, 3);
        sleep($rend);
        $this->_cleanup_caches(5, $req_do);

      }

      if((time()-3600) > $this->cc['currency_last_update_try'] && $req_step < 1){

      $currency_last_update_try_where = array('config_key' => 'currency_last_update_try'); 
      $currency_last_update_try_data = ['config_value' =>  time()];
      $this->CRUDModel->do_update('config', $currency_last_update_try_where, $currency_last_update_try_data);

      $url = 'https://my.celebiz.com/Api/get_exchange_rates';
      $params = [
          'public_key' => $this->cc['celebiz_public_key'],
          'secret_key' => $this->cc['celebiz_secret_key']
      ];

      $response = json_curl_fnc($url, $params);

      if ($response['code'] == 200) {
          $data = json_decode($response['body'], true);
          if (isset($data['rates']) && is_array($data['rates'])) {
    $rates = $data['rates'];
        foreach ($rates as $currency => $rate) {

          $currencies_update_where = array('currency' => $currency);

          $currencies_update_data = [
                    'exchange_rate' => $rate,
                    'update_time' => time()
                ];

          $this->CRUDModel->do_update('currencies', $currencies_update_where, $currencies_update_data);

            }

            $currency_last_update_where = array('config_key' => 'currency_last_update'); 
      $currency_last_update_data = ['config_value' =>  time()];
      $this->CRUDModel->do_update('config', $currency_last_update_where, $currency_last_update_data);

        }
              }              

    }

    if((time()-86400) > $this->cc['statistics_update'] && $req_step < 1){


     $get_statistics_where = array(
        'statistics_update <' => strtotime(date('Y-m-d 00:00:00')),
    );

    $statistics_update = $this->_statistics_update($get_statistics_where);

    if($statistics_update){

      $statistics_update_where = array('config_key' => 'statistics_update'); 
      $statistics_update_data = ['config_value' =>  time()];
      $this->CRUDModel->do_update('config', $statistics_update_where, $statistics_update_data);

    }

  }

      return 'true';

    }


    public function execution()
    {

      $req_do = $this->request->getGetPost('do') ?? false;
      $req_token = $this->request->getGetPost('token') ?? false;
      $req_email = $this->request->getGetPost('email') ?? false;
      $req_name = $this->request->getGetPost('name') ?? '';
      $req_mqid = (int) ($this->request->getGetPost('mqid') ?? 0);

      $do = ['subscribe', 'email_verify', 'unsubscribe', 'email_confirm'];

      $return_data = ['status' => 'FALSE'];

      if(in_array(strtolower($req_do), $do) && $req_token){

        $req_user_ip = $this->request->getIPAddress();
        $req_user_id = 0;
        
        if($req_do == 'subscribe'){

          if (is_valid_email($req_email, true)) {

            $get_emails_where = array('email' => $req_email); 
            $get_emails = $this->CRUDModel->get_row('emails', $get_emails_where);

            $req_token = get_token_fnc(16);

            if($get_emails){

              $is_verified = $get_emails['verified'];
              $email_id = $get_emails['email_id'];

              $do_update_emails_where = array('email_id' => $get_emails['email_id']);
              $do_update_emails_data = array('subscribed' => 1, 'subscribed_time' => time(), 'token' => $req_token, 'edit_time' => time(), 'edit_ip' => $req_user_ip, 'edit_by' => $req_user_id);
              if($req_name){
                $do_update_emails_data['name'] = $req_name;
              }
              $this->CRUDModel->do_update('emails', $do_update_emails_where, $do_update_emails_data);

            }else{

              $is_verified = 0;

              $do_create_emails_data =  array('name' => $req_name, 'email' => $req_email, 'subscribed' => 1, 'subscribed_time' => time(), 'token' => $req_token, 'add_time' => time(), 'add_ip' => $req_user_ip, 'add_by' => $req_user_id);
              $email_id = $this->CRUDModel->do_create('emails', $do_create_emails_data);

            }

            if(!$is_verified){

              $var_name = ($req_name)?' '.$req_name:'';

              $email_html = '<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <title>Email Subscription Confirmation</title>
  <style>
    body {
      font-family: Arial, sans-serif;
      background-color: #f4f6f8;
      padding: 0;
      margin: 0;
    }
    .email-container {
      max-width: 600px;
      margin: auto;
      background-color: #ffffff;
      padding: 20px;
      border-radius: 8px;
      box-shadow: 0 2px 5px rgba(0,0,0,0.05);
    }
    .logo {
      text-align: center;
      margin-bottom: 20px;
    }
      .logo img {
      border: 0;
    }

    .content {
      color: #333333;
      font-size: 16px;
      line-height: 1.6;
    }
    .cta-button {
      display: inline-block;
      margin-top: 20px;
      padding: 12px 24px;
      background-color: #003423;
      color: #c9bb04 !important;
      text-decoration: none;
      border-radius: 5px;
      font-weight: bold;
    }
    .footer {
      margin-top: 30px;
      font-size: 12px;
      color: #999999;
      text-align: center;
    }
  </style>
</head>
<body>
  <div class="email-container">
    <div class="logo">
      <a href="'.$this->cc['base_url'].'"><img src="'.$this->cc['cdn_url'].'public/images/frontend/'.$this->cc['frontend_theme'].'/logo.png" alt="'.$this->cc['app_name'].'" /></a>
    </div>
    <div class="content">
      <h2>Confirm Your Subscription</h2>
      <p>Hello'.$var_name.',</p>
      <p>Thanks for signing up! Please confirm your subscription by clicking the button below.</p>
      <p>This helps us ensure you\'re the one who requested it, and you\'ll start receiving updates right away.</p>
      <a href="'.$this->cc['base_url'].'Ajax/execution?do=email_verify&token='.$req_token.'&email='.$req_email.'" class="cta-button">Verify My Email</a>
      <p>If you didn’t request this, feel free to ignore this message.</p>
    </div>
    <div class="footer">
      &copy; '.date('Y').' '.$this->cc['app_name'].'. All rights reserved.
    </div>
  </div>
</body>
</html>';

$do_create_data_mails_queues =  array('to_name' => $req_name, 'to_email' => $req_email, 'mail_subject' => "Welcome! Just one step to finish your subscription", 'mail_content' => $email_html, 'mail_type' => 'html', 'priority' => 9, 'parent_id' => $email_id, 'parent_type' => 'emails', 'add_time' => time());

$this->CRUDModel->do_create('mails_queues', $do_create_data_mails_queues);            

            }

            $return_data['status'] = 'TRUE';
            $return_data['data']['alert'] = "<b>Thank you for subscribing!</b> 🎉 <br> We’re excited to have you—please check your email to confirm and start receiving updates!";

          }else{

            $return_data['data']['alert'] = "<b>Oops! That doesn’t look like a valid email.</b> <br> Please double-check and try again.";

          }

        }elseif($req_do == 'email_verify'){

           $get_emails_where = array('email' => $req_email, 'token' => $req_token); 
            $get_emails = $this->CRUDModel->get_row('emails', $get_emails_where);

            if($get_emails){

              $req_token = get_token_fnc(16);

              $do_update_emails_where = array('email_id' => $get_emails['email_id']);
              $do_update_emails_data = array('verified' => 1, 'verified_time' => time(), 'token' => $req_token, 'edit_time' => time(), 'edit_ip' => $req_user_ip, 'edit_by' => $req_user_id);
              $this->CRUDModel->do_update('emails', $do_update_emails_where, $do_update_emails_data);


              $var_name = ($get_emails['name'])?' '.$get_emails['name']:' there';

              $email_html = '<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <title>Welcome to Our Community!</title>
  <style>
    body {
      font-family: Arial, sans-serif;
      background-color: #f4f6f8;
      margin: 0;
      padding: 0;
    }
    .container {
      max-width: 600px;
      margin: auto;
      background-color: #ffffff;
      padding: 25px;
      border-radius: 10px;
      box-shadow: 0 2px 8px rgba(0,0,0,0.05);
    }
    .logo {
      text-align: center;
      margin-bottom: 20px;
    }
    .logo img {
      border: 0;
    }
    .message {
      color: #333333;
      font-size: 16px;
      line-height: 1.6;
    }
    .cta {
      margin-top: 25px;
      text-align: center;
      font-weight: bold;
      font-size: 16px;
    }
    .footer {
      margin-top: 30px;
      font-size: 13px;
      color: #888888;
      text-align: center;
    }
  </style>
</head>
<body>
  <div class="container">
    <div class="logo">
      <a href="'.$this->cc['base_url'].'"><img src="'.$this->cc['cdn_url'].'public/images/frontend/'.$this->cc['frontend_theme'].'/logo.png" alt="'.$this->cc['app_name'].'" /></a>
    </div>
    <div class="message">
      <h2>Welcome Aboard! 🎉</h2>
      <p>Hi'.$var_name.',</p>
      <p>You’re now part of a growing community of movie lovers who crave fresh, free entertainment in Urdu, Hindi, and Punjabi. From trending releases to hidden gems, we’ll keep your inbox updated with the latest uploads, curated picks, and exclusive streaming highlights — all delivered straight to your inbox.</p>
      <p>If you ever need help or have questions, we’re just a message away.</p>
    </div>
    <div class="cta">
      Thank you for joining us!
    </div>
    <div class="footer">
      &copy; '.date('Y').' '.$this->cc['app_name'].'. All rights reserved. 
    </div>
  </div>
</body>
</html>';

$do_create_data_mails_queues =  array('to_name' => $get_emails['name'], 'to_email' => $get_emails['email'], 'mail_subject' => "Email Verified — and now the good stuff begins!", 'mail_content' => $email_html, 'mail_type' => 'html', 'priority' => 9, 'parent_id' => $get_emails['email_id'], 'parent_type' => 'emails', 'add_time' => time());

$this->CRUDModel->do_create('mails_queues', $do_create_data_mails_queues);

              $return_data['status'] = 'TRUE';
              $return_data['data']['alert'] = "<b>🎉 Email Verified Successfully!</b>";

            }else{

               $return_data['data']['alert'] = "<b>Oops! This verification link is invalid or has expired.</b> <br> Please subscribe again to receive a new confirmation email. We're excited to welcome you!";

            }

        }elseif($req_do == 'unsubscribe'){

          if (is_valid_email($req_email, true)) {

           $get_emails_where = array('email' => $req_email); 
            $get_emails = $this->CRUDModel->get_row('emails', $get_emails_where);

            $req_token = get_token_fnc(16);

            if($get_emails){

              $email_id = $get_emails['email_id'];

              $is_unsubscribed = $get_emails['unsubscribed'];

              $do_update_emails_where = array('email_id' => $get_emails['email_id']);
              $do_update_emails_data = array('mail_queue_id' => $req_mqid, 'unsubscribed_time' => time(), 'token' => $req_token, 'edit_time' => time(), 'edit_ip' => $req_user_ip, 'edit_by' => $req_user_id);
              if($req_name){
                $do_update_emails_data['name'] = $req_name;
              }
              $this->CRUDModel->do_update('emails', $do_update_emails_where, $do_update_emails_data);

              $var_name = $get_emails['name'];

            }else{

              $var_name = $req_name;

              $is_unsubscribed = 0;

              $do_create_emails_data =  array('name' => $var_name, 'email' => $req_email, 'unsubscribed_time' => time(), 'token' => $req_token, 'add_time' => time(), 'add_ip' => $req_user_ip, 'add_by' => $req_user_id);
              $email_id = $this->CRUDModel->do_create('emails', $do_create_emails_data);

            }

            if($is_unsubscribed){

               $return_data['status'] = 'TRUE';
            $return_data['data']['alert'] = "<b>We're sorry to see you go</b> <br> You've been successfully removed from our mailing list. If you change your mind, you're always welcome back!";

            }else{

          $var_name = ($var_name)?' '.$var_name:' there';

            $email_html = '<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <title>Email Unsubscription Confirmation</title>
  <style>
    body {
      font-family: Arial, sans-serif;
      background-color: #f4f6f8;
      padding: 0;
      margin: 0;
    }
    .email-container {
      max-width: 600px;
      margin: auto;
      background-color: #ffffff;
      padding: 20px;
      border-radius: 8px;
      box-shadow: 0 2px 5px rgba(0,0,0,0.05);
    }
    .logo {
      text-align: center;
      margin-bottom: 20px;
    }
      .logo img {
      border: 0;
    }

    .content {
      color: #333333;
      font-size: 16px;
      line-height: 1.6;
    }
    .cta-button {
      display: inline-block;
      margin-top: 20px;
      padding: 12px 24px;
      background-color: #420000;
      color: #c9bb04 !important;
      text-decoration: none;
      border-radius: 5px;
      font-weight: bold;
    }
    .footer {
      margin-top: 30px;
      font-size: 12px;
      color: #999999;
      text-align: center;
    }
  </style>
</head>
<body>
  <div class="email-container">
    <div class="logo">
      <a href="'.$this->cc['base_url'].'"><img src="'.$this->cc['cdn_url'].'public/images/frontend/'.$this->cc['frontend_theme'].'/logo.png" alt="'.$this->cc['app_name'].'" /></a>
    </div>
    <div class="content">
      <h2>Confirm Unsubscription</h2>
      <p>Hi'.$var_name.',</p>
      <p>We received your request to unsubscribe from our mailing list. To confirm, simply click the button below.</p>
      <p>You’ll stop receiving updates, offers, and news from us — but you\'re always welcome back anytime.</p>
      <a href="'.$this->cc['base_url'].'Ajax/execution?do=email_confirm&token='.$req_token.'&email='.$req_email.'" class="cta-button">Confirm Unsubscribe</a>
      <p>If you didn’t request this, feel free to ignore this message.</p>
    </div>
    <div class="footer">
      &copy; '.date('Y').' '.$this->cc['app_name'].'. All rights reserved.
    </div>
  </div>
</body>
</html>';

$do_create_data_mails_queues =  array('to_name' => $req_name, 'to_email' => $req_email, 'mail_subject' => "We're sorry to see you go — confirm to unsubscribe", 'mail_content' => $email_html, 'mail_type' => 'html', 'priority' => 9, 'parent_id' => $email_id, 'parent_type' => 'emails', 'add_time' => time());

$this->CRUDModel->do_create('mails_queues', $do_create_data_mails_queues);

 $return_data['status'] = 'TRUE';
            $return_data['data']['alert'] = "<b>We're sorry to see you go</b> <br> Please check your email to confirm your unsubscribe request. If you change your mind, you're always welcome back!";

            }

          }else{

     $return_data['data']['alert'] = "<b>Oops! That doesn’t look like a valid email.</b> <br> Please double-check and try again.";

          }

        }elseif($req_do == 'email_confirm'){

          $get_emails_where = array('email' => $req_email, 'token' => $req_token); 
            $get_emails = $this->CRUDModel->get_row('emails', $get_emails_where);

             if($get_emails){

              $req_token = get_token_fnc(16);

              $do_update_emails_where = array('email_id' => $get_emails['email_id']);
              $do_update_emails_data = array('unsubscribed' => 1, 'verified' => 1, 'unsubscribed_time' => time(), 'token' => $req_token, 'edit_time' => time(), 'edit_ip' => $req_user_ip, 'edit_by' => $req_user_id);
              $this->CRUDModel->do_update('emails', $do_update_emails_where, $do_update_emails_data);

              $var_name = ($get_emails['name'])?' '.$get_emails['name']:' there';

              $email_html = '<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <title>Email Unsubscription Successfully</title>
  <style>
    body {
      font-family: Arial, sans-serif;
      background-color: #f4f6f8;
      margin: 0;
      padding: 0;
    }
    .container {
      max-width: 600px;
      margin: auto;
      background-color: #ffffff;
      padding: 25px;
      border-radius: 10px;
      box-shadow: 0 2px 8px rgba(0,0,0,0.05);
    }
    .logo {
      text-align: center;
      margin-bottom: 20px;
    }
    .logo img {
      border: 0;
    }
    .message {
      color: #333333;
      font-size: 16px;
      line-height: 1.6;
    }
    .cta {
      margin-top: 25px;
      text-align: center;
      font-weight: bold;
      font-size: 16px;
    }
    .footer {
      margin-top: 30px;
      font-size: 13px;
      color: #888888;
      text-align: center;
    }
  </style>
</head>
<body>
  <div class="container">
    <div class="logo">
      <a href="'.$this->cc['base_url'].'"><img src="'.$this->cc['cdn_url'].'public/images/frontend/'.$this->cc['frontend_theme'].'/logo.png" alt="'.$this->cc['app_name'].'" /></a>
    </div>
    <div class="message">
      <h2>You’ve Been Unsubscribed</h2>
      <p>Hi'.$var_name.',</p>
      <p>We’ve confirmed your request to unsubscribe from our mailing list.</p>
    </div>
    <div class="cta">
      Thank you for being part of our journey. You’re always welcome back anytime.
    </div>
    <div class="footer">
      &copy; '.date('Y').' '.$this->cc['app_name'].'. All rights reserved. 
    </div>
  </div>
</body>
</html>';

$do_create_data_mails_queues =  array('to_name' => $get_emails['name'], 'to_email' => $get_emails['email'], 'mail_subject' => "Unsubscription confirmed — we’re always here if you return", 'mail_content' => $email_html, 'mail_type' => 'html', 'priority' => 9, 'parent_id' => $get_emails['email_id'], 'parent_type' => 'emails', 'add_time' => time());

$this->CRUDModel->do_create('mails_queues', $do_create_data_mails_queues);

              $return_data['status'] = 'TRUE';
              $return_data['data']['alert'] = "<b>You’re now unsubscribed.</b> <br> Thanks for being with us — you’re always welcome back!";

            }else{

               $return_data['data']['alert'] = "<b>Oops! This verification link is invalid or has expired.</b> <br> Please unsubscribe again to receive a fresh confirmation email — we’ll make sure it reaches you safely this time.";

            }          

        }

      }else{

        $return_data['data']['alert'] = "Action incomplete. We couldn’t verify any recent request. Please start again to proceed.";

      }

      if($this->request->isAJAX() === FALSE){

        if($return_data['status'] == 'TRUE'){

        $alert_data['alert'] = ['type' => 'success', 'message' => $return_data['data']['alert']];             

        }else{

          $alert_data['alert'] = ['type' => 'error', 'message' => $return_data['data']['alert']];

        }

        $this->session->set($alert_data);

        redirect_fnc($this->cc['base_url']);   

      }else{

        return $this->response->setJSON($return_data);

      }

    }

     public function id($item_id = 0)
    {

    $get_row_where = array('item_id' => $item_id);                    
          $get_row = $this->CRUDModel->get_row('items', $get_row_where);

        if (!empty($get_row)) {

        $destination_url = $this->cc['base_url'].slug2url_fnc('items_details', $get_row['item_id'], $get_row['slug'], $get_row['meta_title']);

        }else{

        $destination_url = $this->cc['base_url'];

        }

    redirect_fnc($destination_url);

    }

    public function quote()
    {

      if($this->request->isAJAX() === FALSE){

        die("Access denied - Look like your request is unsecure or invalid. Please reload the page and try again.");
 
       }

       $return_data = ['status' => 'FALSE'];

       $req_item_id = $this->request->getPost('item_id') ?? 0;

       $get_row_where = array('item_id' => $req_item_id, 'status' => 1, 'published_time<=' => time());                    
          $get_row = $this->CRUDModel->get_row('items', $get_row_where);

        if (!empty($get_row)) {

        $req_captcha_token = $this->request->getPost('captcha_token');
       $req_captcha_code = $this->request->getPost('captcha_code');

       if($this->_captcha_verify($req_captcha_code, $req_captcha_token)){

         $this->validation->setRules([
                    'name' => ['label' => 'Your Name', 'rules' => 'required|trim'],
                    'email' => ['label' => 'Email Address', 'rules' => 'required|trim|valid_email|min_length[3]'],
                    'phone' => ['label' => 'WhatsApp', 'rules' => 'required|trim'],
                    'country' => ['label' => 'Country', 'rules' => 'required|trim'],
                    'quantity' => ['label' => 'Quantity', 'rules' => 'required|trim'],
                    'message' => ['label' => 'Message', 'rules' => 'required|trim'],
                ]);

                if ($this->validation->withRequest($this->request)->run() == FALSE) {

                  $return_data['data']['captcha_token'] = $this->_captcha_token();
                  $return_data['data']['alert'] = $this->validation->listErrors('my_validation_list');

                  }else{

          $item_link = $this->cc['base_url'].'Go/id/'.$get_row['item_id'];
          
           $email_html  = '<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0" />
  <title>Request A Quote Form Submission</title>
  <style>
    body {
      font-family: Arial, Helvetica, sans-serif;
      margin: 0;
      padding: 0;
      background-color: #f4f4f4;
    }
    .email-container {
      max-width: 600px;
      margin: auto;
      background-color: #ffffff;
      padding: 20px;
      border-radius: 8px;
    }
    .header {
      background-color: #007BFF;
      color: white;
      padding: 10px;
      text-align: center;
      border-radius: 8px 8px 0 0;
    }
    .content {
      padding: 20px;
      color: #333333;
    }
    .field {
      margin-bottom: 10px;
    }
    .label {
      font-weight: bold;
      color: #555555;
    }
    .timestamp {
      font-size: 12px;
      color: #888888;
      margin-top: 20px;
      text-align: right;
    }
    @media only screen and (max-width: 600px) {
      .email-container {
        padding: 10px;
      }
    }
  </style>
</head>
<body>
  <div class="email-container">
    <div class="header">
      <h2>Request A Quote Form Submission</h2>
    </div>
    <div class="content">
    <div class="field">
        <span class="label">Item:</span> <a href="' . $item_link . '">' . htmlspecialchars($get_row['name'], ENT_QUOTES, 'UTF-8') . '</a>
      </div>
      <div class="field">
        <span class="label">Name:</span> ' . htmlspecialchars($this->request->getPost('name'), ENT_QUOTES, 'UTF-8') . '
      </div>
      <div class="field">
        <span class="label">Email:</span> ' . htmlspecialchars($this->request->getPost('email'), ENT_QUOTES, 'UTF-8') . '
      </div>
      <div class="field">
        <span class="label">WhatsApp:</span> ' . htmlspecialchars($this->request->getPost('phone'), ENT_QUOTES, 'UTF-8') . '
      </div>
      <div class="field">
        <span class="label">Country:</span> ' . htmlspecialchars($this->request->getPost('country'), ENT_QUOTES, 'UTF-8') . '
      </div>
      <div class="field">
        <span class="label">Quantity:</span> ' . htmlspecialchars($this->request->getPost('quantity'), ENT_QUOTES, 'UTF-8') . '
      </div>
      <div class="field">
        <span class="label">Message:</span><br />
        ' . nl2br(htmlspecialchars($this->request->getPost('message'), ENT_QUOTES, 'UTF-8')) . '
      </div>
      <div class="field">
        <span class="label">IP Address:</span> ' . $this->request->getIPAddress() . '
      </div>
      <div class="timestamp">
        Submitted on ' . date("F j, Y, g:i a") . '
      </div>
    </div>
  </div>
</body>
</html>';


$do_create_data_mails_queues_admin =  array('to_name' => $this->cc['app_name'], 'to_email' => $this->cc['app_email'], 'mail_subject' => "[".$this->request->getPost('name')."] Quote Request For: ".$get_row['model'], 'mail_content' => $email_html, 'mail_type' => 'html', 'priority' => 9,  'parent_type' => 'quote', 'add_time' => time());

$this->CRUDModel->do_create('mails_queues', $do_create_data_mails_queues_admin);

            $return_data['status'] = 'TRUE';
            $return_data['data']['alert'] = "<b>Thank you!</b> Your message has been sent successfully. We’ll get back to you shortly.";

                  }
            }else{

              $return_data['data']['captcha_token'] = $this->_captcha_token();
              $return_data['data']['alert'] = " Incorrect CAPTCHA Code ";

            }

             } else {

          $return_data['data']['captcha_token'] = $this->_captcha_token();
          $return_data['data']['alert'] = "Invalid item selected. Please reload the page and try again.";

        }

      return $this->response->setJSON($return_data);

    }

    public function captcha_token()
    {

      if($this->request->isAJAX() === FALSE){

        die("Access denied - Look like your request is unsecure or invalid. Please reload the page and try again.");
 
       }

        $return_data = ['status' => 'TRUE'];

        $return_data['data']['captcha_token'] = $this->_captcha_token();

      return $this->response->setJSON($return_data);

    }

    public function contact()
    {

      if($this->request->isAJAX() === FALSE){

        die("Access denied - Look like your request is unsecure or invalid. Please reload the page and try again.");
 
       }

       $return_data = ['status' => 'FALSE'];

       $req_captcha_token = $this->request->getPost('captcha_token');
       $req_captcha_code = $this->request->getPost('captcha_code');

       if($this->_captcha_verify($req_captcha_code, $req_captcha_token)){

         $this->validation->setRules([
                    'name' => ['label' => 'Your Name', 'rules' => 'required|trim'],
                    'email' => ['label' => 'Email Address', 'rules' => 'required|trim|valid_email|min_length[3]'],
                    'phone' => ['label' => 'WhatsApp', 'rules' => 'required|trim'],
                    'subject' => ['label' => 'Subject', 'rules' => 'required|trim'],
                    'message' => ['label' => 'Message', 'rules' => 'required|trim'],
                ]);

                if ($this->validation->withRequest($this->request)->run() == FALSE) {

                  $return_data['data']['captcha_token'] = $this->_captcha_token();
                  $return_data['data']['alert'] = $this->validation->listErrors('my_validation_list');

                  }else{


           $email_html  = '<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0" />
  <title>Contact Form Submission</title>
  <style>
    body {
      font-family: Arial, Helvetica, sans-serif;
      margin: 0;
      padding: 0;
      background-color: #f4f4f4;
    }
    .email-container {
      max-width: 600px;
      margin: auto;
      background-color: #ffffff;
      padding: 20px;
      border-radius: 8px;
    }
    .header {
      background-color: #007BFF;
      color: white;
      padding: 10px;
      text-align: center;
      border-radius: 8px 8px 0 0;
    }
    .content {
      padding: 20px;
      color: #333333;
    }
    .field {
      margin-bottom: 10px;
    }
    .label {
      font-weight: bold;
      color: #555555;
    }
    .timestamp {
      font-size: 12px;
      color: #888888;
      margin-top: 20px;
      text-align: right;
    }
    @media only screen and (max-width: 600px) {
      .email-container {
        padding: 10px;
      }
    }
  </style>
</head>
<body>
  <div class="email-container">
    <div class="header">
      <h2>Contact Form Submission</h2>
    </div>
    <div class="content">
      <div class="field">
        <span class="label">Name:</span> ' . htmlspecialchars($this->request->getPost('name'), ENT_QUOTES, 'UTF-8') . '
      </div>
      <div class="field">
        <span class="label">Email:</span> ' . htmlspecialchars($this->request->getPost('email'), ENT_QUOTES, 'UTF-8') . '
      </div>
      <div class="field">
        <span class="label">WhatsApp:</span> ' . htmlspecialchars($this->request->getPost('phone'), ENT_QUOTES, 'UTF-8') . '
      </div>
      <div class="field">
        <span class="label">Subject:</span> ' . htmlspecialchars($this->request->getPost('subject'), ENT_QUOTES, 'UTF-8') . '
      </div>
      <div class="field">
        <span class="label">Message:</span><br />
        ' . nl2br(htmlspecialchars($this->request->getPost('message'), ENT_QUOTES, 'UTF-8')) . '
      </div>
      <div class="field">
        <span class="label">IP Address:</span> ' . $this->request->getIPAddress() . '
      </div>
      <div class="timestamp">
        Submitted on ' . date("F j, Y, g:i a") . '
      </div>
    </div>
  </div>
</body>
</html>';


$do_create_data_mails_queues_admin =  array('to_name' => $this->cc['app_name'], 'to_email' => $this->cc['app_email'], 'mail_subject' => "[".$this->request->getPost('name')."] Contact Form: ".$this->request->getPost('subject') , 'mail_content' => $email_html, 'mail_type' => 'html', 'priority' => 9,  'parent_type' => 'contact', 'add_time' => time());

$this->CRUDModel->do_create('mails_queues', $do_create_data_mails_queues_admin);

            $return_data['status'] = 'TRUE';
            $return_data['data']['alert'] = "<b>Thank you!</b> Your message has been sent successfully. We’ll get back to you shortly.";

                  }
            }else{

              $return_data['data']['captcha_token'] = $this->_captcha_token();
              $return_data['data']['alert'] = " Incorrect CAPTCHA Code ";

            }

      return $this->response->setJSON($return_data);

    }

    public function initialize()
    {

      if ($this->session->get('last_request_time') && time() - $this->session->get('last_request_time') < 5) {
    die("Too many requests, please wait.");
}
$this->session->set('last_request_time', time());

      if($this->request->isAJAX() === FALSE){

        die("Access denied - Look like your request is unsecure or invalid. Please reload the page and try again.");
 
           }

      $return_data = ['status' => 'FALSE'];

      $req_offset = $this->request->getGetPost('offset');
      $req_token = $this->request->getGetPost('token');
      $req_visitor_data = $this->request->getGetPost('visitor_data');

      if($req_offset){
      $this->session->set('offset', $req_offset);
      }

      $var_session_id = $this->session->session_id;
      $req_user_id = 0;
      $req_user_ip = $this->request->getIPAddress();

if (!empty($req_visitor_data) && is_array($req_visitor_data)) {

         $get_visitors_where = array('session_id' => $var_session_id); 
        $get_visitors = $this->CRUDModel->get_row('visitors', $get_visitors_where);

        if($get_visitors){

          $do_update_visitors_where = array('visitor_id' => $get_visitors['visitor_id']);
          $do_update_visitors_data = array('token' => $req_token, 'views' => $get_visitors['views']+1, 'data' => json_encode($req_visitor_data), 'edit_time' => time(), 'edit_ip' => $req_user_ip, 'edit_by' => $req_user_id);
          $this->CRUDModel->do_update('visitors', $do_update_visitors_where, $do_update_visitors_data);

        }else{

      $do_create_visitors_data = array('session_id' => $var_session_id, 'token' => $req_token, 'views' => 1, 'data' => json_encode($req_visitor_data), 'add_time' => time(), 'add_ip' => $req_user_ip, 'add_by' => $req_user_id, 'edit_time' => time(), 'edit_ip' => $req_user_ip, 'edit_by' => $req_user_id);

      $this->CRUDModel->do_create('visitors', $do_create_visitors_data);

      }

      }

       $get_cart_where = array('session_id' => $var_session_id);                    
          $get_cart = $this->CRUDModel->get_row('carts', $get_cart_where);

          if (!empty($get_cart)) {

              $var_cart_id = $get_cart['cart_id'];

           $get_carts_items_where = "cart_id = '$var_cart_id' 
                          AND item_id IN (SELECT item_id FROM tbl_items WHERE status = 1)";

$get_carts_items_select = "tbl_carts_items.*,   
    (SELECT JSON_OBJECT(
        'upload_id', tbl_uploads.upload_id, 
        'upload_file', tbl_uploads.upload_file
     ) FROM tbl_uploads 
     WHERE tbl_uploads.upload_type = 'image'  
     AND tbl_uploads.parent_type = 'items_images' 
     AND tbl_uploads.parent_id = tbl_carts_items.item_id 
     ORDER BY tbl_uploads.sort_order ASC LIMIT 1) AS uploads";

    if (!empty($this->cc['price']) && strtolower($this->cc['price']) == 'true') {
    $get_carts_items_select .= ",
    (SELECT JSON_OBJECT(
        'item_id', tbl_items.item_id, 
        'slug', tbl_items.slug,
        'name', tbl_items.name, 
        'model', tbl_items.model, 
        'price', tbl_items.price, 
        'price_previous', tbl_items.price_previous
        ) FROM tbl_items 
     WHERE tbl_items.item_id = tbl_carts_items.item_id) AS item_details";    
    } else {   
   $get_carts_items_select .= ",
    (SELECT JSON_OBJECT(
        'item_id', tbl_items.item_id, 
        'slug', tbl_items.slug,
        'name', tbl_items.name, 
        'model', tbl_items.model
        ) FROM tbl_items 
     WHERE tbl_items.item_id = tbl_carts_items.item_id) AS item_details";     
    }

$get_carts_items = $this->CRUDModel->get_result('carts_items', $get_carts_items_where, $get_carts_items_select);

if (!empty($get_carts_items)) {
foreach ($get_carts_items as &$item) {
    $uploads = json_decode($item['uploads'], true)?? [];
    if (!empty($uploads['upload_file'])) {
        $uploads['url'] = $this->cc['img_url'].display_image_fnc('webp-'.$this->cc['tiny_image_width'].'x'.$this->cc['tiny_image_height'], $uploads['upload_file'], 'fix', $this->cc['cache_image'], $this->cc['image_original']);
    }else{
        $uploads = [
            'upload_id' => 0,
            'upload_file' => 'notfound.webp',
            'url' => $this->cc['img_url'].display_image_fnc('webp-'.$this->cc['tiny_image_width'].'x'.$this->cc['tiny_image_height'], 'notfound.webp', 'fix', $this->cc['cache_image'], $this->cc['image_original'])
        ];
    }
    $item['uploads'] = json_encode($uploads, JSON_UNESCAPED_SLASHES | JSON_UNESCAPED_UNICODE);
    $item_details = json_decode($item['item_details'], true);
    $item_details['url'] = $this->cc['base_url'].slug2url_fnc('items_details', $item_details['item_id'], $item_details['slug'], $item_details['name']);
    $item['item_details'] = json_encode($item_details, JSON_UNESCAPED_SLASHES | JSON_UNESCAPED_UNICODE);
}

      $do_update_carts_where = array('cart_id' => $var_cart_id);
      $do_update_carts_data = array('edit_time' => time(), 'edit_ip' => $req_user_ip, 'edit_by' => $req_user_id);
      $do_update_carts = $this->CRUDModel->do_update('carts', $do_update_carts_where, $do_update_carts_data);

}


             $return_data['data']['cart'] = $get_carts_items;
             $return_data['status'] = 'TRUE';

            }

            if($this->session->has('alert')){
              $return_data['data']['alert'] = $this->session->alert;
             $return_data['status'] = 'TRUE';
            $this->session->remove('alert');
        }

      return $this->response->setJSON($return_data);
    }

    public function select_search()
{
    if (!$this->request->isAJAX()) {
        return $this->response->setJSON([
            ['id' => 0, 'name' => 'Access denied']
        ]);
    }

    $req_t = $this->request->getGetPost('t');
    $req_q = trim($this->request->getGetPost('q'));

    $return_data = [
        ['id' => 0, 'name' => '---None---']
    ];

    $config_map = parent_map_fnc();

    if (!empty($req_t) && isset($config_map[$req_t])) {
        $cfg = $config_map[$req_t];

        $where = isset($cfg['type_id']) ? ['type_id' => $cfg['type_id']] : [];

        $like_value = strtolower($req_q);

        $select = "{$cfg['id']}, {$cfg['name']}";

        $query_results = $this->CRUDModel->get_result(
            $cfg['table'],
            $where,
            $select,
            "{$cfg['name']} ASC",
            15,
            0,
            ["LOWER({$cfg['name']})" => $like_value]
        );

        if (!empty($query_results)) {
            foreach ($query_results as $row) {
                $return_data[] = [
                    'id' => $row[$cfg['id']],
                    'name' => $row[$cfg['name']]
                ];
            }
        }
    }
    return $this->response->setJSON($return_data);
}



    public function search()
    {

      if($this->request->isAJAX() === FALSE){

        die("Access denied - Look like your request is unsecure or invalid. Please reload the page and try again.");
 
         }

      $return_data = ['status' => 'FALSE'];

      $query = trim($this->request->getGetPost('query'));

      if(strlen($query) > 2){

      $get_result_like = array("LOWER(model)" => strtolower($query), "LOWER(sku)" => strtolower($query), "LOWER(mpn)" => strtolower($query), "LOWER(gtin)" => strtolower($query), "LOWER(price)" => strtolower($query), "LOWER(price_previous)" => strtolower($query), "LOWER(slug)" => strtolower($query), "LOWER(name)" => strtolower($query), "LOWER(title)" => strtolower($query), "LOWER(description)" => strtolower($query), "LOWER(spotlight)" => strtolower($query), "LOWER(meta_title)" => strtolower($query), "LOWER(meta_description)" => strtolower($query), "LOWER(meta_keywords)" => strtolower($query)); 

      $get_result_where = "status = 1 AND published_time<= ".time();
       $order = 'last_hit_time';
       $sort = 'DESC';
       $limit = 10;
       $start = 0;

       $get_result_select = 'tbl_items.item_id, tbl_items.name, tbl_items.model, tbl_items.slug,';
       if (!empty($this->cc['price']) && strtolower($this->cc['price']) == 'true') {
        $get_result_select .= 'tbl_items.price, tbl_items.price_previous,';
       }
       $get_result_select .= "   
          (SELECT JSON_OBJECT(
        'upload_id', tbl_uploads.upload_id, 
        'upload_file', tbl_uploads.upload_file
     ) FROM tbl_uploads 
     WHERE tbl_uploads.upload_type = 'image'  
     AND tbl_uploads.parent_type = 'items_images' 
     AND tbl_uploads.parent_id = tbl_items.item_id 
     ORDER BY tbl_uploads.sort_order ASC LIMIT 1) AS uploads";
                  
      $get_result = $this->CRUDModel->get_result('items', $get_result_where, $get_result_select, $order.' '.$sort, $limit, $start, $get_result_like);

      if (!empty($get_result)) {

      foreach ($get_result as &$item) {
        $uploads = json_decode($item['uploads'], true) ?? [];
        if (!empty($uploads['upload_file'])) {
            $uploads['url'] = $this->cc['img_url'].display_image_fnc('webp-'.$this->cc['tiny_image_width'].'x'.$this->cc['tiny_image_height'], $uploads['upload_file'], 'fix', $this->cc['cache_image'], $this->cc['image_original']);
        }else{
            $uploads = [
                'upload_id' => 0,
                'upload_file' => 'notfound.webp',
                'url' => $this->cc['img_url'].display_image_fnc('webp-'.$this->cc['tiny_image_width'].'x'.$this->cc['tiny_image_height'], 'notfound.webp', 'fix', $this->cc['cache_image'], $this->cc['image_original'])
            ];
        }
        $item['uploads'] = json_encode($uploads, JSON_UNESCAPED_SLASHES | JSON_UNESCAPED_UNICODE);

        $item['url'] = $this->cc['base_url'].slug2url_fnc('items_details', $item['item_id'], $item['slug'], $item['name']);

    }

     $return_data = [
          'data' => $get_result,
          'status' => 'TRUE'
          ];

  }

}

      return $this->response->setJSON($return_data);

        }


        public function a2c()
        {

          $req_type = $this->request->getGetPost('type');
          $req_value = $this->request->getGetPost('value');


          $allowed_columns = ['item_id', 'model', 'sku', 'mpn', 'gtin']; 
          if (!in_array($req_type, $allowed_columns)) {
              $req_type = 'item_id';
          }

          if (empty($req_value)) {
              $req_value = 0;
          }          

        $get_row_where = array($req_type => $req_value, 'status' => 1, 'published_time<=' => time());                    
        $get_row = $this->CRUDModel->get_row('items', $get_row_where);

        if (!empty($get_row)) {

          $this->add2cart(false, $get_row['item_id'], get_token_fnc());

         redirect_fnc($this->cc['base_url'].'Cart');

        }else{

          throw \CodeIgniter\Exceptions\PageNotFoundException::forPageNotFound();

        }

        }

    public function add2cart($ajax = true, $item_id = '', $token = '')
        {


          if($ajax == true){

          if($this->request->isAJAX() === FALSE){

        die("Access denied - Look like your request is unsecure or invalid. Please reload the page and try again.");
 
           }

          }
          

          $req_item_id = $this->request->getGetPost('item_id')?? $item_id;
          $req_token = $this->request->getGetPost('token') ?? $token;
          $req_quantity = $this->request->getGetPost('quantity');
          $var_session_id = $this->session->session_id;
          $req_user_id = 0;
          $req_user_ip = $this->request->getIPAddress();

          if(!price_fnc($req_quantity)){
            $req_quantity = 1;
          }


           $return_data = [
          'data' => '<p class="text-danger">An unknown error occurred.</p>',
          'status' => 'FALSE'
          ];


        $get_row_where = array('item_id' => $req_item_id, 'status' => 1, 'published_time<=' => time());                    
          $get_row = $this->CRUDModel->get_row('items', $get_row_where);

        if (!empty($get_row)) {

          $items_details = $this->cc['base_url'].slug2url_fnc('items_details', $get_row['item_id'], $get_row['slug'], $get_row['meta_title']);


          $do_update_where = array('item_id' => $req_item_id);
        $do_update_data = array('last_cart_time' => time(), 'today_carts' => $get_row['today_carts']+1, 'lifetime_carts' => $get_row['lifetime_carts']+1);

     if(date("d/m/Y", $get_row['statistics_update']) != date("d/m/Y")){
          $do_update_data['statistics_update'] = time();
          $do_update_data['today_views'] = 1;
          $do_update_data['today_hits'] = 1;
          $do_update_data['today_carts'] = 1;
        }

        $do_update = $this->CRUDModel->do_update('items', $do_update_where, $do_update_data);

          $get_cart_where = array('session_id' => $var_session_id);                    
          $get_cart = $this->CRUDModel->get_row('carts', $get_cart_where);

          if (!empty($get_cart)) {

              $var_cart_id = $get_cart['cart_id'];

            }else{

        $do_create_cart_data = array('session_id' => $var_session_id, 'add_by' => $req_user_id, 'add_time' => time(), 'add_ip' => $req_user_ip, 'edit_time' => time(), 'token' => $req_token);

        $var_cart_id = $this->CRUDModel->do_create('carts', $do_create_cart_data);

            }

      $get_cart_item_where = array('cart_id' => $var_cart_id, 'item_id' => $req_item_id);                    
          $get_cart_item = $this->CRUDModel->get_row('carts_items', $get_cart_item_where);

        if (!empty($get_cart_item)) {

          $return_data = [
          'data' => '<a href="'.$items_details.'" class="link-info"><i class="fa-solid fa-basket-shopping"></i> '.$get_row['name'].' ['.$get_row['model'].']</a> is already in your <a href="'.$this->cc['base_url'].'Cart" class="link-primary">quote cart</a>! You can update the quantity in your <a href="'.$this->cc['base_url'].'Cart" class="link-primary">quote cart</a>.',
          'status' => 'FALSE'
          ];


        }else{

        $req_quantity = max($req_quantity, $get_row['minimum']);
        $req_quantity = min($req_quantity, $get_row['maximum']);
        $req_quantity = max($req_quantity, 1);        

          $do_create_cart_item_data = array('cart_id' => $var_cart_id, 'item_id' => $req_item_id, 'quantity' => $req_quantity, 'token' => $req_token);

          $this->CRUDModel->do_create('carts_items', $do_create_cart_item_data);

       $do_update_carts_where = array('cart_id' => $var_cart_id);
      $do_update_carts_data = array('edit_time' => time(), 'edit_ip' => $req_user_ip, 'edit_by' => $req_user_id);

      $do_update_carts = $this->CRUDModel->do_update('carts', $do_update_carts_where, $do_update_carts_data);
          
          $return_data = [
          'data' => '<b>Success!</b> <a href="'.$items_details.'" class="link-success"><i class="fa-solid fa-basket-shopping"></i> '.$get_row['name'].' ['.$get_row['model'].']</a> has been added to your <a href="'.$this->cc['base_url'].'Cart" class="link-primary">quote cart</a>.',
          'status' => 'TRUE'
          ];

        }

        }

        if($ajax == true){

          return $this->response->setJSON($return_data);

        }else{

          return true;
        }


          }

    
    public function ratings()
        {

          if($this->request->isAJAX() === FALSE){

        die("Access denied - Look like your request is unsecure or invalid. Please reload the page and try again.");
 
           }

          $return_data = [
          'data' => 'An unknown error occurred.',
          'status' => 'FALSE'
          ];

      if($this->cc['ratings'] == 'TRUE'){

      $req_parent = $this->request->getGetPost('parent');
      $req_parent_type = $this->request->getGetPost('parent_type');
      $req_parent_id = $this->request->getGetPost('parent_id');
      $req_scores = $this->request->getGetPost('scores');
      $req_token = $this->request->getGetPost('token');
      $req_add_by = 0;
      $req_add_ip = $this->request->getIPAddress();

      $get_row_token_where = array('token' => $req_token); 

      $get_row_token = $this->CRUDModel->get_row('ratings', $get_row_token_where);

        if (empty($get_row_token)) {

      $get_row_ratings_where = array('parent_type' => $req_parent_type, 'parent_id' => $req_parent_id); 
      
      if($this->cc['ratings_guest'] == 'TRUE'){
      $get_row_ratings_where['add_ip'] = $req_add_ip;
      $get_row_ratings_where['year(from_unixtime(add_time))'] = date("Y");
      $get_row_ratings_where['month(from_unixtime(add_time))'] = date("m");
      $get_row_ratings_where['day(from_unixtime(add_time))'] = date("d");
      }else{
      $get_row_ratings_where['add_by'] = $req_add_by;
      }

      $get_row_ratings = $this->CRUDModel->get_row('ratings', $get_row_ratings_where);

      if (empty($get_row_ratings)) {
      
     $get_row_parent_where = array($req_parent_type.'_id' => $req_parent_id);                    
        $get_row_parent = $this->CRUDModel->get_row($req_parent, $get_row_parent_where);

        if (empty($get_row_parent)) {

             $return_data = [
          'data' => 'No parent records were found. Please verify the information and try again.',
          'status' => 'FALSE'
          ];

        }

      $var_parent_votes = $get_row_parent['votes']+1;
      $var_parent_scores = $get_row_parent['scores']+$req_scores;

      $var_parent_ratings = number_format($var_parent_scores / $var_parent_votes, 1);

      if($var_parent_ratings > 5){
        $var_parent_ratings = 5;
      }

      if($var_parent_ratings < 0){
        $var_parent_ratings = 0;
      }

      $do_update_ratings_where = array($req_parent_type.'_id' => $req_parent_id);
      $do_update_ratings_data = array('votes' => $var_parent_votes, 'scores' => $var_parent_scores, 'ratings' => $var_parent_ratings);

      $do_update_ratings = $this->CRUDModel->do_update($req_parent, $do_update_ratings_where, $do_update_ratings_data);

     
      $do_create_ratings_data = array('parent_type' => $req_parent_type, 'parent_id' => $req_parent_id, 'scores' => $req_scores, 'add_by' => $req_add_by, 'add_time' => time(), 'add_ip' => $req_add_ip, 'token' => $req_token);

       $do_create_ratings = $this->CRUDModel->do_create('ratings', $do_create_ratings_data);

         $return_data = [
          'data' => 'Thank you for your rating—we appreciate your feedback!',
          'status' => 'TRUE'
          ];

      }else{

        $return_data = [
          'data' => 'Your rating has already been recorded—your participation is greatly appreciated!',
          'status' => 'FALSE'
          ];

      }

    }else{

      $return_data = [
          'data' => 'Request error detected. Please refresh the page and try again.',
          'status' => 'FALSE'
          ];

    }

  }

      return $this->response->setJSON($return_data);

        }


        public function likes()
        {

          if($this->request->isAJAX() === FALSE){

        die("Access denied - Look like your request is unsecure or invalid. Please reload the page and try again.");
 
           }

          $return_data = [
          'data' => 'An unknown error occurred.',
          'status' => 'FALSE'
          ];

      if($this->cc['likes'] == 'TRUE'){

      $req_parent = $this->request->getGetPost('parent');
      $req_parent_type = $this->request->getGetPost('parent_type');
      $req_parent_id = $this->request->getGetPost('parent_id');
      $req_add_by = 0;
      $req_token = $this->request->getGetPost('token');
      $req_add_ip = $this->request->getIPAddress();


      $get_row_token_where = array('token' => $req_token); 

      $get_row_token = $this->CRUDModel->get_row('likes', $get_row_token_where);

       if (empty($get_row_token)) {

      $get_row_likes_where = array('parent_type' => $req_parent_type, 'parent_id' => $req_parent_id); 
      
      if($this->cc['likes_guest'] == 'TRUE'){
      $get_row_likes_where['add_ip'] = $req_add_ip;
      $get_row_likes_where['year(from_unixtime(add_time))'] = date("Y");
      $get_row_likes_where['month(from_unixtime(add_time))'] = date("m");
      $get_row_likes_where['day(from_unixtime(add_time))'] = date("d");
      }else{
      $get_row_likes_where['add_by'] = $req_add_by;
      }

      $get_row_likes = $this->CRUDModel->get_row('likes', $get_row_likes_where);

      if (empty($get_row_likes)) {
      
     $get_row_parent_where = array($req_parent_type.'_id' => $req_parent_id);                    
        $get_row_parent = $this->CRUDModel->get_row($req_parent, $get_row_parent_where);

        if (empty($get_row_parent)){

             $return_data = [
          'data' => 'No parent records were found. Please verify the information and try again.',
          'status' => 'FALSE'
          ];

        }

      $var_parent_likes = $get_row_parent['likes']+1;

      $do_update_likes_where = array($req_parent_type.'_id' => $req_parent_id);
      $do_update_likes_data = array('likes' => $var_parent_likes);

      $do_update_likes = $this->CRUDModel->do_update($req_parent, $do_update_likes_where, $do_update_likes_data);

     
      $do_create_likes_data = array('parent_type' => $req_parent_type, 'parent_id' => $req_parent_id, 'add_by' => $req_add_by, 'add_time' => time(), 'add_ip' => $req_add_ip, 'token' => $req_token);

       $do_create_likes = $this->CRUDModel->do_create('likes', $do_create_likes_data);

         $return_data = [
          'data' => 'Thank you for liking—we truly appreciate it!',
          'status' => 'TRUE'
          ];

      }else{

        $return_data = [
          'data' => "You'\ve already liked—your engagement is greatly appreciated!",
          'status' => 'FALSE'
          ];

      }

      }else{

      $return_data = [
          'data' => 'Request error detected. Please refresh the page and try again.',
          'status' => 'FALSE'
          ];
          
    }

    }   

      return $this->response->setJSON($return_data);

        }
   

}


