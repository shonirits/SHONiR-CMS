<?php

namespace App\Controllers;

class Thanks extends Shonir_Controller
{

    public function __construct() {
        parent::__construct();
    }

    public function index()
    {

        $GLOBALS['HTMLS_CACHE'] = false;

        $current_page_id = 'thanks';

        $var_order_number = $this->session->thanks;

        if (empty($var_order_number)) {
            return redirect()->to($this->cc['base_url']);
        } else {
            $this->session->remove('thanks');
        }

          $view_data['order_number'] = $var_order_number;

        $view_data['page'] = [
            'title' => "Thank You for Your Inquiry! | ".$this->cc['app_name'],
           'description' => "",
           'keywords' => "",
           'url' => current_url(),
           'id' => $current_page_id,
           'type' => "website"
         ];  

       $view_data['cc'] = $this->cc;

        return view('frontend/'.$this->cc['frontend_theme'].'/thanks', $view_data);

    }


}