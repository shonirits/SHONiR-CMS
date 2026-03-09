<?php

namespace App\Controllers;

class Analytics extends Shonir_Controller
{

    public function __construct() {
        parent::__construct();
    }

   public function index()
    {

        $GLOBALS['HTMLS_CACHE'] = false;

       $this->_verify_user_area();

$traffic_heatmap_select = "HOUR(FROM_UNIXTIME(add_time)) AS hour, COUNT(*) AS visitor_count";
$traffic_heatmap_where  = "add_time >= UNIX_TIMESTAMP(NOW() - INTERVAL 24 HOUR)";
$traffic_heatmap_orderBy  = "hour ASC";
$traffic_heatmap_groupBy = "HOUR(FROM_UNIXTIME(add_time))";

$traffic_heatmap_results = $this->CRUDModel->get_result('visitors', $traffic_heatmap_where, $traffic_heatmap_select, $traffic_heatmap_orderBy, '', 0, '', true, $traffic_heatmap_groupBy);

$traffic_heatmap = array_fill(0, 24, null);
$visitors = 0;

foreach ($traffic_heatmap_results as $traffic_heatmap_row) {
    $hour = intval($traffic_heatmap_row['hour']); 
    $visitor_count = intval($traffic_heatmap_row['visitor_count']);
    $traffic_heatmap[$hour] = $visitor_count;
    $visitors += $visitor_count;
}

$view_data['visitors'] = $visitors;

$view_data['traffic_heatmap'] = json_encode($traffic_heatmap);

$visitors_data_where  = ['add_ip !=' => $this->request->getIPAddress(), 'edit_ip !=' => $this->request->getIPAddress()];
$visitors_data_orderBy  = "edit_time DESC";

$visitors_data = $this->CRUDModel->get_result('visitors', $visitors_data_where, '', $visitors_data_orderBy, 100);

    $active_5min_where = "edit_time >= UNIX_TIMESTAMP(NOW() - INTERVAL 5 MINUTE)";
    $active_5min_count = $this->CRUDModel->do_count('visitors', $active_5min_where);
    $view_data['active_5min'] = $active_5min_count;

    $active_30min_where = "edit_time >= UNIX_TIMESTAMP(NOW() - INTERVAL 30 MINUTE)";
    $active_30min_count = $this->CRUDModel->do_count('visitors', $active_30min_where);
    $view_data['active_30min'] = $active_30min_count;

$view_data['visitors_data'] = $visitors_data;

        $view_data['page'] = [
            'title' => "Analytics | ".$this->cc['app_name'],
           'description' => "",
           'keywords' => "",
           'url' => current_url(),
           'type' => "website"
         ];  

        $view_data['cc'] = $this->cc;        

        return view('backend/'.$this->cc['backend_theme'].'/analytics', $view_data);

        }


}