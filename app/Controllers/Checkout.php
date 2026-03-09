<?php

namespace App\Controllers;

class Checkout extends Shonir_Controller
{

    public function __construct() {
        parent::__construct();
    }

    public function index()
    {

        $GLOBALS['HTMLS_CACHE'] = false;

        $current_page_id = 'checkout';

        $get_carts_items = false;

        $var_session_id = $this->session->session_id;
        $req_user_id = 0;
        $req_user_ip = $this->request->getIPAddress();

        $get_cart_where = array('session_id' => $var_session_id);                    
        $get_cart = $this->CRUDModel->get_row('carts', $get_cart_where);

         if(!$get_cart){

          return redirect()->to($this->cc['base_url'].'Cart');

         }else{

        $req_do = $this->request->getGetPost('do') ?? '';
        $req_checkout = $this->request->getPost('checkout') ?? '';

         $view_data['form'] = array(
            'name' => '',
            'company' => '',
            'email' => '',
            'phone' => '',
            'address' => '',
            'address2' => '',
            'country' => '',
            'state' => '',
            'city' => '',
            'zip' => '',
            'details' => ''
          );

        if($req_do == 'send' && $req_checkout== $this->session->get('checkout')){

          if ($this->request->getMethod() == "POST") {

            $this->validation->setRules([
          'name' => ['label' => 'name', 'rules' => 'required|trim'],
          'company' => ['label' => 'company', 'rules' => 'required|trim'],
          'email' => ['label' => 'email', 'rules' => 'required|trim'],
          'phone' => ['label' => 'phone', 'rules' => 'required|trim'],
          'address' => ['label' => 'address', 'rules' => 'required|trim'],
          'country' => ['label' => 'country', 'rules' => 'required|trim'],
          'state' => ['label' => 'state', 'rules' => 'required|trim'],
          'city' => ['label' => 'city', 'rules' => 'required|trim'],
          'zip' => ['label' => 'zip', 'rules' => 'required|trim'],
          'details' => ['label' => 'details', 'rules' => 'required|trim'],
          ]);


      $req_name = $this->request->getPost('name');
      $req_company = $this->request->getPost('company');
      $req_email = $this->request->getPost('email');
      $req_phone = $this->request->getPost('phone');
      $req_address = $this->request->getPost('address');
      $req_address2 = $this->request->getPost('address2');
      $req_country = $this->request->getPost('country');
      $req_state = $this->request->getPost('state');
      $req_city = $this->request->getPost('city');
      $req_zip = $this->request->getPost('zip');
      $req_details = $this->request->getPost('details');
      $var_details = text2list_fnc($req_details);


     $view_data['form'] = array('name' => $req_name, 'company' => $req_company, 'email' => $req_email, 'phone' => $req_phone, 'address' => $req_address, 'address2' => $req_address2, 'country' => $req_country, 'state' => $req_state, 'city' => $req_city, 'zip' => $req_zip, 'details' => $req_details);


      if($this->validation->withRequest($this->request)->run() == FALSE){
    
                $alert_data['alert'] = ['type' => 'error', 'message' => $this->validation->listErrors('my_validation_list')];        
                $this->session->set($alert_data);

                }else{

                  $req_captcha_token = $this->request->getPost('captcha_token');
                  $req_captcha_code = $this->request->getPost('captcha_code');

              if(!$this->_captcha_verify($req_captcha_code, $req_captcha_token)){

                $alert_data['alert'] = ['type' => 'error', 'message' => " Incorrect CAPTCHA Code " ];        
                $this->session->set($alert_data);                

              }else{
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
                ORDER BY tbl_uploads.sort_order ASC LIMIT 1) AS uploads,   
                (SELECT JSON_OBJECT(
                    'item_id', tbl_items.item_id, 
                    'title', tbl_items.title, 
                    'slug', tbl_items.slug,
                    'name', tbl_items.name, 
                    'description', tbl_items.description, 
                    'spotlight', tbl_items.spotlight, 
                    'sku', tbl_items.sku, 
                    'mpn', tbl_items.mpn, 
                    'gtin', tbl_items.gtin, 
                    'model', tbl_items.model, 
                    'price', tbl_items.price, 
                    'price_previous', tbl_items.price_previous
                    ) FROM tbl_items 
                WHERE tbl_items.item_id = tbl_carts_items.item_id) AS item_details";

     $get_carts_items = $this->CRUDModel->get_result('carts_items', $get_carts_items_where, $get_carts_items_select);

                  if($get_carts_items){

              $order_number = time().rand(100, 999);

               $do_create_data_order =  array('session_id' => $var_session_id, 'token' => $req_checkout, 'promo_code' => $get_cart['promo_code'], 'order_number' => $order_number, 'name' => $req_name, 'company' => $req_company, 'email' => $req_email, 'phone' => $req_phone, 'address' => $req_address, 'address2' => $req_address2, 'country' => $req_country, 'state' => $req_state, 'city' => $req_city, 'zip' => $req_zip, 'details' => $var_details, 'add_by' => $req_user_id, 'add_time' => time(), 'add_ip' => $req_user_ip);

               $do_create_order_id = $this->CRUDModel->do_create('orders', $do_create_data_order);    

              $total_items = 0;
              $total_quantity = 0;
              $sub_total = 0;
              $discount_net = 0;
              $net_total = 0;
              $gst_net = 0;
              $vat_net = 0;
              $grand_total = 0;
              $products_html = '';
              $total_from = 0;
              $total_to = 0;

              foreach($get_carts_items as $item_info){ 
                $total_items++;
	              $total_quantity += $item_info['quantity'];
                $item_details = json_decode($item_info['item_details'], true)?? [];
                $item_details['url'] = $this->cc['base_url'].slug2url_fnc('items_details', $item_details['item_id'], $item_details['slug'], $item_details['name']);
                $uploads = json_decode($item_info['uploads'], true)?? [];
                if (!empty($uploads['upload_file'])) {
                      $uploads['url'] = $this->cc['cdn_url'].display_image_fnc('webp-'.$this->cc['tiny_image_width'].'x'.$this->cc['tiny_image_height'], $uploads['upload_file']);
                  }else{
                      $uploads = [
                          'upload_id' => 0,
                          'upload_file' => 'image-not-found.webp',
                          'url' => $this->cc['cdn_url'].display_image_fnc('webp-'.$this->cc['tiny_image_width'].'x'.$this->cc['tiny_image_height'], 'image-not-found.webp')
                      ];
                  }
                $item_total = $item_details['price']*$item_info['quantity'];
                $sub_total += $item_total;
                $total_from += $item_details['price']*$item_info['quantity'];
                $total_to += ($item_details['price_previous'] > $item_details['price'])?$item_details['price_previous']*$item_info['quantity']:$item_details['price']*$item_info['quantity'];
	

                $do_create_data_orders_items =  array('item_id' => $item_details['item_id'], 'order_id' => $do_create_order_id, 'quantity' => $item_info['quantity'], 'title' => $item_details['title'], 'name' => $item_details['name'], 'description' => $item_details['description'], 'spotlight' => $item_details['spotlight'], 'model' => $item_details['model'], 'sku' => $item_details['sku'], 'mpn' => $item_details['mpn'], 'gtin' => $item_details['gtin'], 'price' => $item_details['price'], 'price_previous' => $item_details['price_previous']);

                $this->CRUDModel->do_create('orders_items', $do_create_data_orders_items);

                if (!empty($this->cc['price']) && strtolower($this->cc['price']) == 'true') {

                  $item_price = 'US $ '.number_format($item_details['price'], 2).' - '.(($item_details['price_previous'] > $item_details['price'])?number_format($item_details['price_previous'], 2):number_format($item_details['price'], 2));


                }else{

                  $item_price = 'Quote Ready';
                }

                $products_html .= '
                                  <tr>
                                    <td class="product-cell">
                                    <a href="'.$item_details['url'].'">
                                      <img src="'.$uploads['url'].'" alt="'.$item_details['name'].'" class="product-img">
                                      </a>
                                      <div class="product-info">
                                      <a href="'.$item_details['url'].'">
                                        <strong>'.$item_details['name'].'</strong></a> <br>
                                        <span>Model #: '.$item_details['model'].'</span>                                        
                                      </div>
                                    </td>
                                    <td>'.$item_info['quantity'].'</td>
                                    <td>'.$item_price.'</td>
                                  </tr>
                                  ';

              }

$order_date       = date("d M, Y");

              $do_update_orders_where = array('order_id' => $do_create_order_id);
              $do_update_orders_data = array('total_items' => $total_items, 'total_quantity' => $total_quantity, 'sub_total' => $sub_total, 'discount_net' => $discount_net, 'net_total' => $net_total, 'gst_net' => $gst_net, 'vat_net' => $vat_net, 'grand_total' => $grand_total);
              $this->CRUDModel->do_update('orders', $do_update_orders_where, $do_update_orders_data);

$whatsapp_link = clean_phone_fnc($this->cc['app_telephone']).'?text='.urlencode("Hello! I received the quote order number# {$order_number} summary email and would like to discuss some customization options. Please assist.");

              $email_html = <<<HTML
<!DOCTYPE html>
<html>
<head>
  <meta charset="UTF-8">
  <title>Quote Request Received</title>
  <style>
     body {
      margin: 0;
      padding: 0;
      background-color: #f4f4f4;
      font-family: 'Helvetica Neue', Helvetica, Arial, sans-serif;
    }
    .email-wrapper {
      max-width: 700px;
      margin: auto;
      background-color: #ffffff;
      padding: 20px;
      border-radius: 10px;
    }
    .logo {
      text-align: center;
      margin-bottom: 20px;
    }
    .logo img {
      max-width: 180px;
      height: auto;
    }
    h2 {
      color: #004080;
      font-size: 24px;
      margin-bottom: 10px;
      text-align: center;
    }
    h3 {
      margin-top: 30px;
      color: #004080;
    }
    p {
      font-size: 16px;
      color: #333;
      line-height: 1.5;
    }
    a {
  color: inherit;
  text-decoration: none;
}

a:hover {
  text-decoration: underline;
  color: #004080;
}
.order-highlight {
  background-color: #fff8b3;
  padding: 2px 8px;
  border-radius: 6px;
  font-weight: bold;
  display: inline-block;
}

    table {
      width: 100%;
      border-collapse: collapse;
      margin-top: 20px;
    }
    th, td {
      padding: 12px;
      border: 1px solid #ddd;
      text-align: left;
      vertical-align: middle;
    }
    th:nth-child(2),
    th:nth-child(3),
    td:nth-child(2),
    td:nth-child(3) {
      text-align: center;
    }
    th {
      background-color: #f0f0f0;
    }
    img.product-img {
      max-width: 60px;
      margin-right: 10px;
      border-radius: 6px;
      vertical-align: middle;
    }
    .product-cell {
      display: flex;
      align-items: center;
    }
    .product-info {
      display: flex;
      flex-direction: column;
    }
    .instructions {
      background-color: #f9f9f9;
      border-left: 4px solid #007a3d;
      padding: 15px;
      margin-top: 20px;
      font-size: 15px;
    }
    .customer-info {
      background-color: #f9f9f9;
      border-left: 4px solid #004080;
      padding: 15px;
      margin-top: 20px;
      font-size: 15px;
    }
    .footer {
      font-size: 14px;
      color: #666;
      margin-top: 25px;
      text-align: center;
    }
    .footer a {
      color: #005baa;
      text-decoration: none;
    }
    @media screen and (max-width: 600px) {
      .product-cell {
        flex-direction: column;
        align-items: flex-start;
      }
      img.product-img {
        margin-bottom: 8px;
      }
    }
  </style>
</head>
<body>
  <div class="email-wrapper">
    <div class="logo">
      <a href="{$this->cc['base_url']}" title="{$this->cc['app_name']}">
					<img src="{$this->cc['cdn_url']}public/images/frontend/{$this->cc['frontend_theme']}/logo.png"  alt="{$this->cc['app_name']}" />
					</a>
    </div>

    <h2>🧾 Quote Inquiry Received</h2>
    <p><strong>Order Number:</strong> <span class="order-highlight">{$order_number}</span><br>
       <strong>Date:</strong> {$order_date}</p>

    <p>Dear <strong>{$req_name}</strong>,</p>
    <p>We sincerely appreciate your interest in <strong>{$this->cc['app_name']}</strong> — where bespoke craftsmanship meets elite performance. Your quote inquiry has been received with care, and a curated summary of your selected pieces is presented below. Our dedicated team is now meticulously reviewing your specifications to craft a personalized pricing proposal that reflects our commitment to excellence. You will receive this quotation shortly.</p>

    <h3>🛍️ Order Summary</h3>
    <table>
      <tr>
        <th>Product Details</th>
        <th>Quantity</th>
        <th>Unit Price</th>
      </tr>
      {$products_html}
    </table>

    <h3>📋 Customer-Provided Instructions & Requirements</h3>
    <div class="instructions">
      {$var_details}
    </div>

    <h3>👤 Customer Information</h3>
    <div class="customer-info">
      <p><strong>Name:</strong> {$req_name}<br>
         <strong>Company:</strong> {$req_company}<br>
         <strong>Email:</strong> {$req_email}<br>
         <strong>WhatsApp:</strong> {$req_phone}<br>
         <strong>Address:</strong> {$req_address}<br>
         <strong>Address 2:</strong> {$req_address2}<br>
         <strong>City:</strong> {$req_city}<br>
         <strong>State:</strong> {$req_state}<br>
         <strong>Country:</strong> {$req_country}<br>
         <strong>Zip:</strong> {$req_zip}</p>
    </div>

    <div class="footer">
      <p>To revise your inquiry or share additional details, kindly contact us using the methods below.</p>
      <p><strong>Email:</strong> <a href="mailto:{$this->cc['app_email']}">{$this->cc['app_email']}</a><br>
         <strong>WhatsApp:</strong> <a href="https://wa.me/{$whatsapp_link}">{$this->cc['app_telephone']}</a><br>
         <strong>Website:</strong> <a href="{$this->cc['base_url']}">{$this->cc['app_website']}</a></p>
      <p style="margin-top: 8px; font-style: italic;">Please note: replies to this email are not monitored.</p>
      <p style="margin-top: 18px;">Thank you for considering {$this->cc['app_name']} — your trusted partner in precision apparel and tailored solutions — delivering excellence that elevates your brand, your team, and your business.</p>
    </div>
  </div>
</body>
</html>
HTML;


$do_create_data_mails_queues_customer =  array('to_name' => $req_name, 'to_email' => $req_email, 'mail_subject' => "Acknowledgment of Your Inquiry — Order #{$order_number}", 'mail_content' => $email_html, 'mail_type' => 'html', 'priority' => 9, 'parent_id' => $do_create_order_id, 'parent_type' => 'orders', 'add_time' => time());

$this->CRUDModel->do_create('mails_queues', $do_create_data_mails_queues_customer);

$do_create_data_mails_queues_admin =  array('to_name' => $this->cc['app_name'], 'to_email' => $this->cc['app_email'], 'mail_subject' => "Acknowledgment of Your Inquiry — Order #{$order_number}", 'mail_content' => $email_html, 'mail_type' => 'html', 'priority' => 9, 'parent_id' => $do_create_order_id, 'parent_type' => 'orders', 'add_time' => time());

$this->CRUDModel->do_create('mails_queues', $do_create_data_mails_queues_admin);

          $do_delete_carts_where = ['cart_id' => $var_cart_id]; 
          $this->CRUDModel->do_delete('carts_items', $do_delete_carts_where);
          $this->CRUDModel->do_delete('carts', $do_delete_carts_where);

          $this->session->set('thanks', $order_number);

          return redirect()->to($this->cc['base_url'].'Thanks');


                  }

                }

             }

          }

        }

       

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


         if(!$get_carts_items){

          return redirect()->to($this->cc['base_url'].'Cart');

         }

}

   $view_data['carts_items'] = $get_carts_items;

   $checkout = get_token_fnc();

   $this->session->set('checkout', $checkout);

   $view_data['checkout'] = $checkout;

   $view_data['captcha_token'] = $this->_captcha_token();

        $view_data['page'] = [
            'title' => "Finalize Quote Request | ".$this->cc['app_name'],
           'description' => "",
           'keywords' => "",
           'url' => current_url(),
           'id' => $current_page_id,
           'type' => "website"
         ];  

       $view_data['cc'] = $this->cc;

        return view('frontend/'.$this->cc['frontend_theme'].'/checkout', $view_data);

    }


}