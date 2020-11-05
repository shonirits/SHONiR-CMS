<?php defined('SHONiR') OR exit('No direct script access allowed');


$Tracking_Message = array('The shipping label generated that has been assigned to the package.', 'A shipping label has been created, but the package has not yet been scanned and/or picked up by the carrier.', 'Carrier is aware of the shipment.', 'Carrier has received information about the package but it has not yet been scanned and picked up.', 'A package is traveling to its destination. You may receive multiple updates of this type as the package travels to its destination.', 'A package has reached the local area and is in the process of being delivered.', 'The package has been delivered.', 'The package encountered an error during transit. The carrier may still be able to reroute the package successfully.', 'The package is being returned to the sender.', 'Parcel was "unshipped".', '');


function SHONiR_Tracking_Status_Fnc($SHONiR_ID = FALSE){

    $Status_Array = array(1 => 'Staged', 2 => 'Unknown', 3 => 'Submitted', 4 => 'Pre-Transit', 5 => 'In-Transit', 6 => 'Out For Delivery', 7 => 'Delivered', 8 => 'Failure', 9 => 'Return to Sender', 10 => 'Voided');
 

    if($SHONiR_ID != FALSE){

        $SHONiR_Return = 'Unknown';

    if (array_key_exists($SHONiR_ID, $Status_Array)){ 
        $SHONiR_Return = $Status_Array[$SHONiR_ID]; 
    } 

    return $SHONiR_Return;

}elseif($SHONiR_ID == 0){

    return 'Pending';

}else{

    return $Status_Array;

}
       
}


function SHONiR_Order_Status_Fnc($SHONiR_ID = FALSE){

    $Status_Array = array(1 => 'Pending', 2 => 'Processing', 3 => 'Shipped', 4 => 'Complete', 5 => 'Canceled', 6 => 'Denied', 7 => 'Canceled Reversal', 8 => 'Failed', 9 => 'Refunded', 10 => 'Reversed',  11 => 'Chargeback',  12 => 'Expired',  13 => 'Processed',  14 => 'Voided',  15 => 'Awaiting Email Confirmation', 16 => 'Awaiting Call Confirmation', 17 => 'Awaiting For Payment');
 

    if($SHONiR_ID != FALSE){

        $SHONiR_Return = 'Unknown';

    if (array_key_exists($SHONiR_ID, $Status_Array)){ 
        $SHONiR_Return = $Status_Array[$SHONiR_ID]; 
    } 

    return $SHONiR_Return;

}elseif($SHONiR_ID == 0){

    return 'Pending';

}else{

    return $Status_Array;

}
       
}

function SHONiR_Shipping_Fnc($SHONiR_Amount){

    $SHONiR_Return = 0;

    if($SHONiR_Amount < 1000){

        $SHONiR_Return = 100;   
    
    }

    return $SHONiR_Return;

}


function SHONiR_Tax_Fnc($SHONiR_Amount){

    $SHONiR_Return = 0;

    return $SHONiR_Return;

}

function SHONiR_New_Order_Fnc($Products, $SHONiR_ship_name, $SHONiR_ship_company, $SHONiR_ship_email, $SHONiR_ship_cell, $SHONiR_ship_address1, $SHONiR_ship_address2, $SHONiR_ship_postcode, $SHONiR_ship_country_id, $SHONiR_ship_region_id, $SHONiR_ship_city_id, $SHONiR_bill_name, $SHONiR_bill_company, $SHONiR_bill_email, $SHONiR_bill_cell, $SHONiR_bill_address1, $SHONiR_bill_address2, $SHONiR_bill_postcode, $SHONiR_bill_country_id, $SHONiR_bill_region_id, $SHONiR_bill_city_id, $SHONiR_shipping_method, $SHONiR_payment_method, $SHONiR_gift_cover = 0, $SHONiR_tag_card = 0, $SHONiR_tag_card_text, $SHONiR_user_id, $SHONiR_user_type, $SHONiR_user_comments, $SHONiR_contract_term, $SHONiR_freight_forwarding, $SHONiR_product_history){

    

    $SHONiR_Order = SHONiR_SETTINGS['website_order_prefix'].SHONiR_Counter_Fnc('order');
    $SHONiR_Subject = 'Order: '.$SHONiR_Order;
    $SHONiR_Reference = SHONiR_Reference_Fnc();

    $SHONiR_Total_Items = 0;
    $SHONiR_Total_Quantity = 0;
    $SHONiR_Sub_Total = 0;
    $SHONiR_tag_card_price = 0;
    $SHONiR_gift_cover_price = 0;

    foreach ($Products as $key => $val){

      $SHONiR_Total_Items++; 
      $SHONiR_Total_Quantity += $Products[$key]['quantity']; 
      $SHONiR_Sub_Total += $Products[$key]['selling_price']*$Products[$key]['quantity'];

    }

    $SHONiR_taxable = 0;
    $SHONiR_shippable = 1;

    if($SHONiR_tag_card){

    $SHONiR_tag_card_price = 250;

    }else{

        $SHONiR_tag_card = 0;
    }

    if($SHONiR_gift_cover){

    $SHONiR_gift_cover_price = 250;

    }else{

        $SHONiR_gift_cover = 0;
    }
    

    $SHONiR_Shipping = SHONiR_Shipping_Fnc($SHONiR_Sub_Total+$SHONiR_tag_card_price+$SHONiR_gift_cover_price);
    $SHONiR_Tax = SHONiR_Tax_Fnc($SHONiR_Shipping+$SHONiR_Sub_Total+$SHONiR_tag_card_price+$SHONiR_gift_cover_price);
    $SHONiR_Grand_Total = $SHONiR_Sub_Total+$SHONiR_Shipping+$SHONiR_Tax+$SHONiR_tag_card_price+$SHONiR_gift_cover_price;


    $SHONiR_bill_address = ($SHONiR_bill_address2)?$SHONiR_bill_address1.'<br/>'.$SHONiR_bill_address2:$SHONiR_bill_address1;

    $SHONiR_ship_address = ($SHONiR_ship_address2)?$SHONiR_ship_address1.'<br/>'.$SHONiR_ship_address2:$SHONiR_ship_address1;

    
    SHONiR_Query_Fnc("insert into tbl_orders (order_no, language_id, currency_id, reference, add_time, user_comments, subtotal, tax, shipping, grandtotal, items, quantity, bill_address, bill_email, bill_cell, bill_name, bill_company, ship_address, ship_email, ship_cell, ship_name, ship_company, add_ip, taxable, shippable, gift_cover, tag_card, tag_card_text, tag_card_price, gift_cover_price, bill_postcode, bill_country_id, bill_region_id, bill_city_id, ship_postcode, ship_country_id, ship_region_id, ship_city_id, user_id, user_type, contract_term, freight_forwarding, history) values ('".$SHONiR_Order."', ".SHONiR_LANGUAGE['language_id'].", ".SHONiR_CURRENCY['currency_id'].", '".$SHONiR_Reference."', ".time().", '".$SHONiR_user_comments."', '".$SHONiR_Sub_Total."', '".$SHONiR_Tax."', '".$SHONiR_Shipping."', '".$SHONiR_Grand_Total."', ".$SHONiR_Total_Items.", ".$SHONiR_Total_Quantity.", '".$SHONiR_bill_address."', '".$SHONiR_bill_email."', '".$SHONiR_bill_cell."', '".$SHONiR_bill_name."', '".$SHONiR_bill_company."', '".$SHONiR_ship_address."', '".$SHONiR_ship_email."', '".$SHONiR_ship_cell."', '".$SHONiR_ship_name."', '".$SHONiR_ship_company."', '".SHONiR_IP_Fnc()."', ".$SHONiR_taxable.", ".$SHONiR_shippable.", ".$SHONiR_gift_cover.", ".$SHONiR_tag_card.", '".$SHONiR_tag_card_text."', '".$SHONiR_tag_card_price."', '".$SHONiR_gift_cover_price."',  '".$SHONiR_bill_postcode."', ".$SHONiR_bill_country_id.", ".$SHONiR_bill_region_id.", ".$SHONiR_bill_city_id.",  '".$SHONiR_ship_postcode."', ".$SHONiR_ship_country_id.", ".$SHONiR_ship_region_id.", ".$SHONiR_ship_city_id.", ".$SHONiR_user_id.", ".$SHONiR_user_type.", '".$SHONiR_contract_term."', '".$SHONiR_freight_forwarding."', ".$SHONiR_product_history.")");

    $SHONiR_order_id = SHONiR_Insert_ID_Fnc();
    
    foreach ($Products as $key => $val){
        
    SHONiR_Query_Fnc("insert into tbl_orders_products (order_id, quantity, cost_price, selling_price,  product_id, reference, brand_id, model, stock, price, sold, points, shipping, weight_id, weight, length_id, length, width, height, priority, discount_price, discount_start_time, discount_end_time, tax_id, subtract, country_made, availability_time, minimum, sort_order, status, listed, locked, featured, express_delivery, standard_delivery, viewed, hits, last_hit, searchable, add_time, edit_time, slug, name, description, meta_title, meta_description, meta_keyword, shippable) values (".$SHONiR_order_id.", ".$Products[$key]['quantity'].", '".$Products[$key]['cost_price']."', '".$Products[$key]['selling_price']."',".$Products[$key]['product_id'].", '".$Products[$key]['reference']."', ".$Products[$key]['brand_id'].", '".$Products[$key]['model']."', ".$Products[$key]['stock'].", '".$Products[$key]['selling_price']."', ".$Products[$key]['sold'].", ".$Products[$key]['points'].", ".$Products[$key]['shipping'].", ".$Products[$key]['weight_id'].", '".$Products[$key]['weight']."', ".$Products[$key]['length_id'].", '".$Products[$key]['length']."', '".$Products[$key]['width']."', '".$Products[$key]['height']."', ".$Products[$key]['priority'].", '".$Products[$key]['discount_price']."', ".$Products[$key]['discount_start_time'].", ".$Products[$key]['discount_end_time'].", ".$Products[$key]['tax_id'].", ".$Products[$key]['subtract'].", ".$Products[$key]['country_made'].", ".$Products[$key]['availability_time'].", ".$Products[$key]['minimum'].", ".$Products[$key]['sort_order'].", ".$Products[$key]['status'].", ".$Products[$key]['listed'].", ".$Products[$key]['locked'].", ".$Products[$key]['featured'].", ".$Products[$key]['express_delivery'].", ".$Products[$key]['standard_delivery'].", ".$Products[$key]['viewed'].", ".$Products[$key]['hits'].", ".$Products[$key]['last_hit'].", ".$Products[$key]['searchable'].", ".$Products[$key]['add_time'].", ".$Products[$key]['edit_time'].", '".$Products[$key]['slug']."', '".SHONiR_Escape_String_Fnc($Products[$key]['name'])."', '".SHONiR_Escape_String_Fnc($Products[$key]['description'])."', '".SHONiR_Escape_String_Fnc($Products[$key]['meta_title'])."', '".SHONiR_Escape_String_Fnc($Products[$key]['meta_description'])."', '".SHONiR_Escape_String_Fnc($Products[$key]['meta_keyword'])."', ".$Products[$key]['shippable'].")");

$SHONiR_order_product_id = SHONiR_Insert_ID_Fnc();

if($SHONiR_product_history == 1){

$SHONiR_Product_Uploads = $Products[$key]['uploads'];

if(count($SHONiR_Product_Uploads) > 0){

$SHONiR_sort_order = 0;
foreach ($SHONiR_Product_Uploads as $upload_key => $upload_value)
{
$SHONiR_sort_order++;
$SHONiR_new_file = $SHONiR_order_product_id.'_'.$upload_value['upload_file'];

if (file_exists(SHONiR_ROOT.'media/uploads/'.$upload_value['upload_file'])) { 

SHONiR_Query_Fnc("insert into tbl_uploads (upload_file, sort_order, parent_id, parent_type, add_time) values ('".$SHONiR_new_file."', ".$SHONiR_sort_order.", ".$SHONiR_order_product_id.", 'order', ".time().")");

copy(SHONiR_ROOT.'media/uploads/'.$upload_value['upload_file'], SHONiR_ROOT.'cache/uploads/'.$SHONiR_new_file); 

} 

}

}

}

}


$SHONiR_bill_country = SHONiR_Countries_Fnc($SHONiR_bill_country_id);
$SHONiR_bill_country = $SHONiR_bill_country[0]['name'];

$SHONiR_bill_region = SHONiR_Regions_Fnc($SHONiR_bill_region_id);
$SHONiR_bill_region = $SHONiR_bill_region[0]['name'];

$SHONiR_bill_city = SHONiR_Cities_Fnc($SHONiR_bill_city_id);
$SHONiR_bill_city = $SHONiR_bill_city[0]['name'];

$SHONiR_ship_country = SHONiR_Countries_Fnc($SHONiR_ship_country_id);
$SHONiR_ship_country = $SHONiR_ship_country[0]['name'];

$SHONiR_ship_region = SHONiR_Regions_Fnc($SHONiR_ship_region_id);
$SHONiR_ship_region = $SHONiR_ship_region[0]['name'];

$SHONiR_ship_city = SHONiR_Cities_Fnc($SHONiR_ship_city_id);
$SHONiR_ship_city = $SHONiR_ship_city[0]['name'];

$SHONiR_country = SHONiR_Countries_Fnc(SHONiR_SETTINGS['website_country_id']);
$SHONiR_country = $SHONiR_country[0]['name'];

$SHONiR_region = SHONiR_Regions_Fnc(SHONiR_SETTINGS['website_region_id']);
$SHONiR_region = $SHONiR_region[0]['name'];

$SHONiR_city = SHONiR_Cities_Fnc(SHONiR_SETTINGS['website_city_id']);
$SHONiR_city = $SHONiR_city[0]['name'];

$SHONiR_Array = [ 'products' => $Products, 'gift_cover' => $SHONiR_gift_cover, 'tag_card' => $SHONiR_tag_card, 'gift_cover_price' => $SHONiR_gift_cover_price, 'tag_card_price' => $SHONiR_tag_card_price, 'tag_card_text' => $SHONiR_tag_card_text, 'quantity' => $SHONiR_Total_Quantity, 'items' => $SHONiR_Total_Items, 'sub_total' => $SHONiR_Sub_Total, 'shipping' => $SHONiR_Shipping, 'tax' => $SHONiR_Tax, 'grand_total' => $SHONiR_Grand_Total, 'bill_address' => $SHONiR_bill_address, 'bill_postcode' => $SHONiR_bill_postcode, 'bill_email' => $SHONiR_bill_email, 'bill_cell' => $SHONiR_bill_cell, 'bill_name' => $SHONiR_bill_name, 'bill_company' => $SHONiR_bill_company, 'bill_country' => $SHONiR_bill_country, 'bill_region' => $SHONiR_bill_region, 'bill_city' => $SHONiR_bill_city, 'ship_address' => $SHONiR_ship_address, 'ship_postcode' => $SHONiR_ship_postcode, 'ship_email' => $SHONiR_ship_email, 'ship_cell' => $SHONiR_ship_cell, 'ship_name' => $SHONiR_ship_name, 'ship_company' => $SHONiR_ship_company, 'ship_country' => $SHONiR_ship_country, 'ship_region' => $SHONiR_ship_region, 'ship_city' => $SHONiR_ship_city, 'currency' => SHONiR_CURRENCY['name'], 'user_comments' => $SHONiR_user_comments, 'contract_term' => $SHONiR_contract_term, 'freight_forwarding' => $SHONiR_freight_forwarding, 'ip' => SHONiR_IP_Fnc(), 'time' => time(), 'status' => 'Pending', 'number' => $SHONiR_Order, 'reference' => $SHONiR_Reference, 'base_url' => SHONiR_BASE, 'logo' => SHONiR_SETTINGS['config_logo'], 'company' => SHONiR_SETTINGS['website_company'], 'email' => SHONiR_SETTINGS['website_email'], 'website' => SHONiR_SETTINGS['website_url'], 'telephone' => SHONiR_SETTINGS['website_telephone'], 'whatsapp' => 'https://wa.me/92'.SHONiR_Get_Number_Fnc(SHONiR_SETTINGS['website_telephone']), 'address' => SHONiR_SETTINGS['website_address'], 'city' => $SHONiR_city, 'postcode' => SHONiR_SETTINGS['website_postcode'], 'region' => $SHONiR_region, 'country' => $SHONiR_country, 'payment_method' => $SHONiR_payment_method, 'shipping_method' => $SHONiR_shipping_method];

    $SHONiR_Message = SHONiR_Template_Fnc('order.tpl', $SHONiR_Array);

    SHONiR_Mail_Fnc_Render(SHONiR_SETTINGS['website_email'], SHONiR_SETTINGS['website_contact_name'], $SHONiR_Subject, $SHONiR_Message);

    SHONiR_Mail_Fnc_Render($SHONiR_bill_email, $SHONiR_bill_name, 'Copy of '.$SHONiR_Subject, $SHONiR_Message);
    
    if($SHONiR_ship_email != $SHONiR_bill_email){
    
   SHONiR_Mail_Fnc_Render($SHONiR_ship_email, $SHONiR_ship_name, 'Copy of '.$SHONiR_Subject, $SHONiR_Message);
    
    }

}


function SHONiR_AP_Orders_Fnc_Render(){

    $SHONiR_Second =  SHONiR_URI['Second'];

    $SHONiR_CSRF = SHONiR_Post_Fnc('SHONiR_CSRF');

    if($SHONiR_CSRF){  

    if(SHONiR_CSRF_Fnc($SHONiR_CSRF)){


    }else{

        $SHONiR_Alert['type'] = 'error';
        $SHONiR_Alert['message'] = 'Please make sure your browser has cookies enabled and try again.';
        SHONiR_Session_Write_Fnc('SHONiR_Alert', $SHONiR_Alert);

     }

  }

  if($SHONiR_Second == 'Details'){ 

    $SHONiR_Get_order_id = SHONiR_Get_Fnc('order_id');

    if(!$SHONiR_Get_order_id){

     $SHONiR_Alert['type'] = 'error';
 $SHONiR_Alert['message'] = 'Unknown error occurred please try again later.';
 SHONiR_Session_Write_Fnc('SHONiR_Alert', $SHONiR_Alert);
 SHONiR_Redirect_Fnc(SHONiR_APANEL.'Orders');

    }

    $SHONiR__Order_Details = SHONiR_Order_Details_Fnc($SHONiR_Get_order_id);

            if(!$SHONiR__Order_Details){

                $SHONiR_Alert['type'] = 'error';
            $SHONiR_Alert['message'] = 'The requested record was not found.';
            SHONiR_Session_Write_Fnc('SHONiR_Alert', $SHONiR_Alert);
            SHONiR_Redirect_Fnc(SHONiR_APANEL.'Orders');
    
               }

    $SHONiR_Main['SHONiR_Order_Details'] = $SHONiR__Order_Details;

    $SHONiR_Main['meta_title'] = 'Edit | Orders | SHONiR Administrator Panel | Created with LOVE by SHONiR';

    $SHONiR_Main['meta_description'] = '';
    
    $SHONiR_Main['meta_keyword'] = '';

    $SHONiR_Main['SHONiR_GET_ID'] = $SHONiR_Get_order_id;

    $SHONiR_Main['SHONiR_CSRF'] = SHONiR_CSRF_Fnc('G');

    $GLOBALS['SHONiR_VIEWS_FILE'] = "orders-details";


}else{

  $SHONiR_Main['meta_title'] = 'Orders | SHONiR Administrator Panel | Created with LOVE by SHONiR';

            $SHONiR_Main['meta_description'] = '';
            
            $SHONiR_Main['meta_keyword'] = '';

          $SHONiR_Main['SHONiR_Get_Orders'] = SHONiR_Get_Orders_Fnc();

}

          $SHONiR_Data["SHONiR_Main"] =  $SHONiR_Main;    

return $SHONiR_Data;

}

function SHONiR_Get_Order_Fnc($SHONiR_Value, $SHONiR_Column = 'order_id', $SHONiR_Where = null){

    $SHONiR_Data = array();
    
    $SHONiR_Return = FALSE;

    if($SHONiR_Value){

        $SHONiR_Query_Order = SHONiR_Query_Fnc("select * from tbl_orders where ".$SHONiR_Column."='".$SHONiR_Value."'".$SHONiR_Where);

        $SHONiR_Row_Order = SHONiR_Row_Fnc($SHONiR_Query_Order);

        if($SHONiR_Row_Order > 0 ){

            $SHONiR_Data = SHONiR_Fetch_Fnc($SHONiR_Query_Order);

            $SHONiR_Return = $SHONiR_Data;


        
        }

    }


    return $SHONiR_Return;


}

function SHONiR_Order_Details_Fnc($SHONiR_Value, $SHONiR_Column = 'order_id', $SHONiR_Where = null, $SHONiR_Count = FALSE, $SHONiR_History = FALSE){

    $SHONiR_Data = array();

    if(!$SHONiR_Value){

        return false;

    }

    $SHONiR_Get_Order = SHONiR_Get_Order_Fnc($SHONiR_Value, $SHONiR_Column, $SHONiR_Where);

            if(!$SHONiR_Get_Order){

                return false;
    
               }

$SHONiR_Data['thref'] = SHONiR_BASE.'Orders/track/'.$SHONiR_Get_Order['reference'];

 $SHONiR_Query_Run_Products = "select * from tbl_orders_products where order_id=".$SHONiR_Get_Order['order_id'] ;

 $SHONiR_Query_Products = SHONiR_Query_Fnc($SHONiR_Query_Run_Products);

 $SHONiR_Row_Products = SHONiR_Row_Fnc($SHONiR_Query_Products);

 if($SHONiR_Row_Products > 0 ){

    while($row =  SHONiR_Fetch_Fnc($SHONiR_Query_Products))
    {

        $SHONiR_More['image2'] = '';

        $SHONiR_Product_Uploads = SHONiR_Uploads_Fnc($row['product_id'], 'product');
    
        if($SHONiR_Product_Uploads){
    
            $SHONiR_More['image'] = (SHONiR_SETTINGS['config_auto_watermark']=="TRUE")?$SHONiR_Product_Uploads[0]['upload_id']:$SHONiR_Product_Uploads[0]['upload_file'];       
    
            if(count($SHONiR_Product_Uploads) > 1){            
    
                $SHONiR_More['image2'] = (SHONiR_SETTINGS['config_auto_watermark']=="TRUE")?$SHONiR_Product_Uploads[1]['upload_id']:$SHONiR_Product_Uploads[1]['upload_file'];
            }else{
    
                unset($SHONiR_More['image2']);
            }
    
         }else{
    
            $SHONiR_More['image'] = 'n-a.png';
    
         }
    
         $SHONiR_More['href'] =  SHONiR_Product_Href_Fnc($row['product_id'], $row['slug']);
    
         $SHONiR_More['qhref'] =  SHONiR_Product_Href_Fnc($row['product_id'], $row['slug'], 'Quick');

         $SHONiR_Data['Products'][] = array_merge($row,$SHONiR_More);

    }

 }




               $SHONiR_Data['Order'] = $SHONiR_Get_Order;

               return $SHONiR_Data;



 }



function SHONiR_Get_Orders_Fnc($SHONiR_Where = FALSE, $SHONiR_Order = 'o.add_time', $SHONiR_By = 'asc', $SHONiR_Limit = FALSE){

    $SHONiR_Data = array();  
    
    $SHONiR_SQL_Orders_Where = '';
    
    $SHONiR_SQL_Orders = "select * from tbl_orders o " ;
    
    if($SHONiR_Where !== FALSE){
    
        $SHONiR_SQL_Orders_Where = " where ".$SHONiR_Where;
    
        }
    
    
    $SHONiR_SQL_Orders_Limit = '';    
    
    $SHONiR_SQL_Orders_Sort = " order by ".$SHONiR_Order."  ".$SHONiR_By." ";
    
    if($SHONiR_Limit !== FALSE){
    
    $SHONiR_SQL_Orders_Limit = "  limit ".$SHONiR_Limit;
    
    }
    
    $SHONiR_Query_Orders = SHONiR_Query_Fnc($SHONiR_SQL_Orders.$SHONiR_SQL_Orders_Where.$SHONiR_SQL_Orders_Sort.$SHONiR_SQL_Orders_Limit);
    
    $SHONiR_Row_Orders = SHONiR_Row_Fnc($SHONiR_Query_Orders);
    
    
    if($SHONiR_Row_Orders > 0 ){  
        
        $SHONiR_Data =  SHONiR_Fetch_All_ASSOC_Fnc($SHONiR_Query_Orders); 
    
    }else{
    
        $SHONiR_Data = false;
    
    }       
    
    return $SHONiR_Data;
    
    }

function SHONiR_Orders_Fnc_Render(){

    $SHONiR_Last = SHONiR_URI['Last'];

    $SHONiR_Reference = SHONiR_Get_Fnc('refrence');

    if($SHONiR_Last=='track'){

        $SHONiR_Main = SHONiR_Page_Details_Fnc(14, ' and p.status=1 ', SHONiR_LANGUAGE['language_id']);

        if($SHONiR_Reference){

        $SHONiR_Main['meta_title'] = 'Reference# '.$SHONiR_Reference.' | '.$SHONiR_Main['meta_title'];
    
        $SHONiR_Main['meta_description'] = 'Reference# '.$SHONiR_Reference.' | '.$SHONiR_Main['meta_description'];
        
        $SHONiR_Main['meta_keyword'] = 'Reference# '.$SHONiR_Reference.', '.$SHONiR_Main['meta_keyword'];

        $SHONiR_Data["Order"] = SHONiR_Get_Order_Fnc($SHONiR_Reference, 'reference');
    
        }

        $SHONiR_Data["Categories_Tree"] = SHONiR_Categories_Tree_Fnc(0, 'c.status=1 and c.listed=1', SHONiR_LANGUAGE['language_id']);

    $SHONiR_Data["Pages_Tree"] = SHONiR_Pages_Tree_Fnc(0, 'p.status=1 and p.listed=1', SHONiR_LANGUAGE['language_id']);

    $SHONiR_Data["Recently_Viewed_Products"] = SHONiR_Get_Products_Fnc(TRUE,0, "p.status=1 and p.listed=1", "p.last_hit", "desc", SHONiR_SETTINGS['config_records_limit']);

        $GLOBALS['SHONiR_VIEWS_FILE'] = "order_track";

        $SHONiR_Data["SHONiR_Main"] =  $SHONiR_Main;

    return $SHONiR_Data;

    }

    

}




?>