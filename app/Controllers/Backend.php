<?php

namespace App\Controllers;

class Backend extends Shonir_Controller
{

    public function __construct() {
        parent::__construct();
    }

    public function index()
    {

        $GLOBALS['HTMLS_CACHE'] = false;

       $this->_verify_user_area();

        $view_data['page'] = [
            'title' => "Backend | ".$this->cc['app_name'],
           'description' => "",
           'keywords' => "",
           'url' => current_url(),
           'type' => "website"
         ];  


         $currencies_select = "currency, name, symbol, exchange_rate";
         $currencies_orderby  = "priority DESC";
         $currencies_where = ['currency !=' => 'USD'];

         $var_exchange_rates = $this->CRUDModel->get_result('currencies', $currencies_where , $currencies_select, $currencies_orderby, 7);

         $var_get_currencies = $this->CRUDModel->get_result('currencies', '', $currencies_select, $currencies_orderby);


        $view_data['exchange_rates'] = $var_exchange_rates;
       
        $view_data['currencies'] = $var_get_currencies;

        $view_data['cc'] = $this->cc;        

        return view('backend/'.$this->cc['backend_theme'].'/home', $view_data);

        }


        public function cleanup_caches()
    {

        $GLOBALS['HTMLS_CACHE'] = false;

       $this->_verify_user_area();

        $view_data['page'] = [
            'title' => "Cleanup Caches | ".$this->cc['app_name'],
           'description' => "",
           'keywords' => "",
           'url' => current_url(),
           'type' => "website"
         ];  

        $view_data['cc'] = $this->cc;        

        return view('backend/'.$this->cc['backend_theme'].'/cleanup_caches', $view_data);

        }


    

}


