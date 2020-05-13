<?php defined('SHONiR') OR exit('No direct script access allowed');

function SHONiR_Cart_Fnc_Render(){

    $SHONiR_CSRF = SHONiR_Post_Fnc('SHONiR_CSRF');

    if($SHONiR_CSRF){

        if(SHONiR_CSRF_Fnc($SHONiR_CSRF)){

            $SHONiR_Query_Cart = SHONiR_Query_Fnc("select * from tbl_cart where session_id='".$GLOBALS['SHONiR_SESSION_ID']."'");

            $SHONiR_Row_Cart = SHONiR_Row_Fnc($SHONiR_Query_Cart);
            
            if($SHONiR_Row_Cart > 0 ){
            
                $SHONiR_Fetch_Cart = SHONiR_Fetch_Fnc($SHONiR_Query_Cart);
                
                $SHONiR_Query_Cart_Products = SHONiR_Query_Fnc("select * from tbl_cart_products where cart_id=".$SHONiR_Fetch_Cart['cart_id']." ");
            
            $SHONiR_Row_Cart_Products = SHONiR_Row_Fnc($SHONiR_Query_Cart_Products);
            
            if($SHONiR_Row_Cart_Products > 0 ){
            
                while($SHONiR_Fetch_Cart_Product =  SHONiR_Fetch_Fnc($SHONiR_Query_Cart_Products))
                {

                    $SHONiR_Quantity = SHONiR_Post_Fnc('quantity_'.$SHONiR_Fetch_Cart_Product['id']);

                    if($SHONiR_Quantity > 0){

                    SHONiR_Query_Fnc("update tbl_cart_products set quantity=". $SHONiR_Quantity ." where id=".$SHONiR_Fetch_Cart_Product['id']);

                    }else{

              SHONiR_Query_Fnc("delete from tbl_cart_products where cart_id=".$SHONiR_Fetch_Cart['cart_id']." and id=".$SHONiR_Fetch_Cart_Product['id']);

                    }
        

                }

            }

        }


        }else{

            $SHONiR_Alert['type'] = 'error';
            $SHONiR_Alert['message'] = 'Please make sure your browser has cookies enabled and try again.';
            SHONiR_Session_Write_Fnc('SHONiR_Alert', $SHONiR_Alert);
    
         }

    }else{

        $SHONiR_ID = SHONiR_URI['ID'];   

        if($SHONiR_ID){

            $SHONiR_Query_Cart = SHONiR_Query_Fnc("select * from tbl_cart where session_id='".$GLOBALS['SHONiR_SESSION_ID']."'");

            $SHONiR_Row_Cart = SHONiR_Row_Fnc($SHONiR_Query_Cart);
            
            if($SHONiR_Row_Cart > 0 ){
            
                $SHONiR_Fetch_Cart = SHONiR_Fetch_Fnc($SHONiR_Query_Cart);

              SHONiR_Query_Fnc("delete from tbl_cart_products where cart_id=".$SHONiR_Fetch_Cart['cart_id']." and id=".$SHONiR_ID);

            }


        }

    }

    $SHONiR_Main = SHONiR_Page_Details_Fnc(15, ' and p.status=1 ', SHONiR_LANGUAGE['language_id']);

    $SHONiR_Main['SHONiR_Cart'] = SHONiR_Cart_Details_Fnc('session_id', $GLOBALS['SHONiR_SESSION_ID']);

    $SHONiR_Main['SHONiR_CSRF'] = SHONiR_CSRF_Fnc('G');

    $SHONiR_Data["Categories_Tree"] = SHONiR_Categories_Tree_Fnc(0, 'c.status=1 and c.listed=1', SHONiR_LANGUAGE['language_id']);

    $SHONiR_Data["Pages_Tree"] = SHONiR_Pages_Tree_Fnc(0, 'p.status=1 and p.listed=1', SHONiR_LANGUAGE['language_id']);

    $SHONiR_Data["Recently_Viewed_Products"] = SHONiR_Get_Products_Fnc(TRUE, 0, "p.status=1 and p.listed=1", "p.last_hit", "desc", SHONiR_SETTINGS['config_records_limit']);

    $SHONiR_Data["SHONiR_Main"] =  $SHONiR_Main;

    $GLOBALS['SHONiR_CACHE'] = FALSE;

    return $SHONiR_Data;

}

function SHONiR_Cart_Empty_Fnc($SHONiR_Type = 'session_id', $SHONiR_ID = SHONiR_SESSION_ID ){

    $SHONiR_Query_Cart = SHONiR_Query_Fnc("select * from tbl_cart where $SHONiR_Type='".$SHONiR_ID."'");

$SHONiR_Row_Cart = SHONiR_Row_Fnc($SHONiR_Query_Cart);

if($SHONiR_Row_Cart > 0 ){

    $SHONiR_Fetch_Cart = SHONiR_Fetch_Fnc($SHONiR_Query_Cart);

    SHONiR_Query_Fnc("delete from tbl_cart_products where cart_id=".$SHONiR_Fetch_Cart['cart_id']);


}

SHONiR_Query_Fnc("delete from tbl_cart where $SHONiR_Type='".$SHONiR_ID."'");

}

function SHONiR_Cart_Details_Fnc($SHONiR_Type = 'session_id', $SHONiR_ID = SHONiR_SESSION_ID ){

    $SHONiR_Data = FALSE;
    $SHONiR_Total_Quantity = 0; 
  $SHONiR_Total_Price = 0;
  $SHONiR_Total_Items = 0;

    $SHONiR_Query_Cart = SHONiR_Query_Fnc("select * from tbl_cart where $SHONiR_Type='".$SHONiR_ID."'");

$SHONiR_Row_Cart = SHONiR_Row_Fnc($SHONiR_Query_Cart);

if($SHONiR_Row_Cart > 0 ){

    $SHONiR_Fetch_Cart = SHONiR_Fetch_Fnc($SHONiR_Query_Cart);
    
    $SHONiR_Query_Cart_Products = SHONiR_Query_Fnc("select * from tbl_cart_products where cart_id=".$SHONiR_Fetch_Cart['cart_id']." ");

$SHONiR_Row_Cart_Products = SHONiR_Row_Fnc($SHONiR_Query_Cart_Products);

if($SHONiR_Row_Cart_Products > 0 ){

    while($SHONiR_Fetch_Cart_Product =  SHONiR_Fetch_Fnc($SHONiR_Query_Cart_Products))
    {
        
     $SHONiR_Total_Items++;

    $SHONiR_Product_Details = SHONiR_Product_Details_Fnc($SHONiR_Fetch_Cart_Product['product_id'], ' and status=1', SHONiR_LANGUAGE['language_id']);

    $SHONiR_Total_Quantity += $SHONiR_Fetch_Cart_Product['quantity']; 
    $SHONiR_Total_Price += $SHONiR_Product_Details['selling_price']*$SHONiR_Fetch_Cart_Product['quantity'];

    $SHONiR_Data['Products'][] = array_merge($SHONiR_Fetch_Cart_Product,$SHONiR_Product_Details);

    }
    
    

}


$SHONiR_Shipping = SHONiR_Shipping_Fnc($SHONiR_Total_Price);
$SHONiR_Tax = SHONiR_Tax_Fnc($SHONiR_Shipping+$SHONiR_Total_Price);


$SHONiR_Data['Items'] = $SHONiR_Total_Items;
$SHONiR_Data['Quantity'] = $SHONiR_Total_Quantity;
$SHONiR_Data['Sub'] = $SHONiR_Total_Price;
$SHONiR_Data['Shipping'] = $SHONiR_Shipping;
$SHONiR_Data['Tax'] = $SHONiR_Tax;

$SHONiR_Grand = $SHONiR_Total_Price + $SHONiR_Shipping + $SHONiR_Tax;

$SHONiR_Data['Grand'] = $SHONiR_Grand;

$SHONiR_Data['Cart'] = $SHONiR_Fetch_Cart;

}

    return $SHONiR_Data;

}


?>