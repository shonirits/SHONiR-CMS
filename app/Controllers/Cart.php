<?php

namespace App\Controllers;

class Cart extends Shonir_Controller
{

    public function __construct() {
        parent::__construct();
    }

    public function index()
    {

        $GLOBALS['HTMLS_CACHE'] = false;

        $current_page_id = 'cart';

        $get_carts_items = false;

        $var_session_id = $this->session->session_id;
        $req_user_id = 0;
        $req_user_ip = $this->request->getIPAddress();

        $get_cart_where = array('session_id' => $var_session_id);                    
        $get_cart = $this->CRUDModel->get_row('carts', $get_cart_where);

         if($get_cart){

        $req_do = $this->request->getGetPost('do') ?? '';
        $req_cart_item_id = $this->request->getGet('cart_item_id') ?? 0;
        $req_token = $this->request->getPost('token') ?? '';

        if($req_do == 'remove' && $req_cart_item_id > 0){

          $do_delete_carts_items_where = ['cart_id' => $get_cart['cart_id'], 'cart_item_id' => $req_cart_item_id]; 

          if($this->CRUDModel->is_exist('carts_items', $do_delete_carts_items_where)){
          $do_delete = $this->CRUDModel->do_delete('carts_items', $do_delete_carts_items_where);

          $do_update_carts_where = array('cart_id' => $get_cart['cart_id']);
         $do_update_carts_data = array('edit_time' => time(), 'edit_ip' => $req_user_ip, 'edit_by' => $req_user_id);

      $do_update_carts = $this->CRUDModel->do_update('carts', $do_update_carts_where, $do_update_carts_data);
          
          $alert_data['alert'] = ['type' => 'success', 'message' => "Item removed! We're standing by if you need it later."];
        $this->session->set($alert_data);
          
          }else{

            $alert_data['alert'] = ['type' => 'error', 'message' => "That item’s not in your cart—maybe already removed or never added."];
        $this->session->set($alert_data);

          }

        }


        if($req_do == 'update' && $req_token == $this->session->get('token')){

          $get_carts_items_where = ['cart_id' => $get_cart['cart_id']];

          if($this->CRUDModel->is_exist('carts_items', $get_carts_items_where)){

          $get_carts_items = $this->CRUDModel->get_result('carts_items', $get_carts_items_where);

          if($get_carts_items){

            foreach($get_carts_items as $item){

              $req_item_quantity = $this->request->getPost($item['cart_item_id']);

              $var_item_quantity = (is_numeric($req_item_quantity) && $req_item_quantity > 0) ? (int)$req_item_quantity : 1;

              $do_update_carts_items_where = array('cart_item_id' => $item['cart_item_id']);

              $do_update_carts_items_data = array('quantity' => $var_item_quantity);

              $this->CRUDModel->do_update('carts_items', $do_update_carts_items_where, $do_update_carts_items_data);

            }

            $do_update_carts_where = array('cart_id' => $get_cart['cart_id']);
         $do_update_carts_data = array('edit_time' => time(), 'edit_ip' => $req_user_ip, 'edit_by' => $req_user_id);

      $do_update_carts = $this->CRUDModel->do_update('carts', $do_update_carts_where, $do_update_carts_data);

          }

          $alert_data['alert'] = ['type' => 'success', 'message' => "Update complete—your selections have been modified"];
        $this->session->set($alert_data);

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

   }

   $view_data['carts_items'] = $get_carts_items;

   $token = get_token_fnc();

   $this->session->set('token', $token);

   $view_data['token'] = $token;

        $view_data['page'] = [
            'title' => "Quote Cart | ".$this->cc['app_name'],
           'description' => "",
           'keywords' => "",
           'url' => current_url(),
           'id' => $current_page_id,
           'type' => "website"
         ];  

       $view_data['cc'] = $this->cc;

        return view('frontend/'.$this->cc['frontend_theme'].'/cart', $view_data);

    }


}