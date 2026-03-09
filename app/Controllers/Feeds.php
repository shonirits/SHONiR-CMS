<?php

namespace App\Controllers;

class Feeds extends Shonir_Controller
{

    public function __construct() {
        parent::__construct();
        
    }

    public function indexing()
        {


            $GLOBALS['HTMLS_CACHE'] = false;

            $key = "d073e3a7a0e343fcb9f55640712284eb";
            $host = parse_url($this->cc['base_url'], PHP_URL_HOST);
            $location = $this->cc['base_url'].$key.'.txt';
            $list = [];

            $get_items_where = ['status' => 1, 'published_time<=' => time()];
            $items = $this->CRUDModel->get_result('items', $get_items_where, 'item_id, slug, name');

            foreach ($items as $item) {

                $url = $this->cc['base_url'] . slug2url_fnc('items_details', $item['item_id'], $item['slug'], $item['name']);

                $list[] = $url;

            }

        $get_categories_where = ['status' => 1, 'published_time<=' => time()];
        $categories = $this->CRUDModel->get_result('categories', $get_categories_where, 'category_id, name, slug');

        foreach($categories as $category){

            $url = $this->cc['base_url'].slug2url_fnc('items_by_categories', $category['category_id'], $category['slug'], $category['name']);

            $list[] = $url;

        }

        $get_pages_where = ['status' => 1, 'published_time<=' => time()];
        $pages = $this->CRUDModel->get_result('pages', $get_pages_where, 'page_id, name, slug');

        foreach($pages as $page){

            $url = $this->cc['base_url'].slug2url_fnc('pages_details', $page['page_id'], $page['slug'], $page['name']);

           $list[] = $url;

        }


        $get_images_where = array('upload_type' => 'image', 'parent_type' => 'items_images');
        $get_images = $this->CRUDModel->get_result('uploads', $get_images_where);

        foreach($get_images as $image){

            $url = $this->cc['base_url'].display_image_fnc('webp-0x0', $image['upload_file']);

            $list[] = $url;

        }

           $payload = [
                "host" => $host,
                "key" => $key,
                "keyLocation" => $location,
                "urlList" => $list
            ];


           $options = [
        'headers' => ['User-Agent' => 'SHONiR/0.1', 'Content-Type' => 'application/json'],
          'verify' => false,
          'debug' => true,
          'body' => json_encode($payload),
      ];

      try {
        $client = \Config\Services::curlrequest();
        $response = $client->request('POST', 'https://api.indexnow.org/indexnow', $options);

        echo 'Status Code: ' . $response->getStatusCode() . '<br>';
        echo 'Response Body: ' . htmlspecialchars($response->getBody()) . '<br>';
        echo 'Timestamp: ' . time();
    } catch (\Exception $e) {
        echo 'Error: ' . $e->getMessage();
    }
    
    exit;


        }


    public function rss()
{
    date_default_timezone_set('UTC');

    $xml  = "<?xml version='1.0' encoding='UTF-8'?>\n";
    $xml .= "<rss version='2.0' xmlns:atom='http://www.w3.org/2005/Atom'>\n";
    $xml .= "  <channel>\n";
    $xml .= "   <atom:link href='" . $this->cc['base_url'] . "rss.xml' rel='self' type='application/rss+xml'/>\n";
    $xml .= "    <title>". $this->cc['app_name'] ." Feed</title>\n";
    $xml .= "    <link>" . $this->cc['base_url'] . "</link>\n";
    $xml .= "    <description>Latest items, categories and information from ". $this->cc['app_name'] ."</description>\n";
    $xml .= "    <language>en-us</language>\n";
    $xml .= "    <lastBuildDate>" . date("D, d M Y H:i:s O") . "</lastBuildDate>\n";
    $xml .= "    <ttl>1440</ttl>\n";

    $get_items_select = "tbl_items.*,  
          (SELECT upload_file FROM tbl_uploads  
           WHERE upload_type = 'image'  
           AND parent_type = 'items_images'  
           AND parent_id = tbl_items.item_id  
           ORDER BY sort_order ASC LIMIT 1) AS upload_file,
          (SELECT upload_id FROM tbl_uploads  
           WHERE upload_type = 'image'  
           AND parent_type = 'items_images'  
           AND parent_id = tbl_items.item_id  
           ORDER BY sort_order ASC LIMIT 1) AS upload_id";


    $get_items_where = ['status' => 1, 'published_time<=' => time()];
    $items = $this->CRUDModel->get_result('items', $get_items_where, $get_items_select);

    foreach ($items as $item) {
        $url = $this->cc['base_url'] . slug2url_fnc('items_details', $item['item_id'], $item['slug'], $item['name']);
        $image_url = $this->cc['cdn_url'].display_image_fnc('webp-0x0', $item['upload_file']);
        $local_path    = FCPATH.'writable/cache/images/' . $item['upload_file'];
        $image_length  = file_exists($local_path) ? filesize($local_path) : 32768;
        $xml .= "    <item>\n";
        $xml .= "      <title>" . htmlspecialchars($item['title']) . "</title>\n";
        $xml .= "      <link>" . htmlspecialchars($url) . "</link>\n";
        $xml .= "    <enclosure url=\"$image_url\" type=\"image/webp\" length=\"$image_length\" />\n";
        $xml .= "    <description><![CDATA[\n";
        $xml .= "        " . htmlspecialchars($item['spotlight']) . "<br/>\n";
        $price = isset($item['price']) ? floatval(preg_replace('/[^0-9.]/', '', $item['price'])) : 0.0;
        $price_previous = isset($item['price_previous']) ? floatval(preg_replace('/[^0-9.]/', '', $item['price_previous'])) : 0.0;            
        if($price_previous > $price){
            $xml .= "        <strong>Original Price:</strong> <del>$" . number_format($price_previous, 2) . "</del><br/>\n";
            $xml .= "        <strong>Sale Price:</strong> <span style='color:red;'>$" . number_format($price, 2) . "</span><br/>\n";
        } else {
            $xml .= "        <strong>Price:</strong> $" . number_format($price, 2) . "<br/>\n";
        }
        $xml .= "    ]]></description>\n";
        $xml .= "      <pubDate>" . date("D, d M Y H:i:s O") . "</pubDate>\n";
        $xml .= "      <guid>" . htmlspecialchars($url) . "</guid>\n";
        $xml .= "    <author>". $this->cc['app_email'] ." (". $this->cc['app_name'] .")</author>\n";
        $xml .= "    </item>\n";
    }

    $get_categories_where = ['status' => 1, 'published_time<=' => time()];
    $categories = $this->CRUDModel->get_result('categories', $get_categories_where, 'category_id, name, slug, spotlight');

    foreach ($categories as $category) {
        $url = $this->cc['base_url'] . slug2url_fnc('items_by_categories', $category['category_id'], $category['slug'], $category['name']);
        $xml .= "    <item>\n";
        $xml .= "      <title>Category: " . htmlspecialchars($category['name']) . "</title>\n";
        $xml .= "      <link>" . htmlspecialchars($url) . "</link>\n";
        $xml .= "      <description><![CDATA[" . htmlspecialchars($category['spotlight']) . "]]></description>\n";
        $xml .= "      <pubDate>" . date("D, d M Y H:i:s O") . "</pubDate>\n";
        $xml .= "      <guid>" . htmlspecialchars($url) . "</guid>\n";
        $xml .= "    <author>". $this->cc['app_email'] ." (". $this->cc['app_name'] .")</author>\n";
        $xml .= "    </item>\n";
    }

    $get_pages_where = ['status' => 1, 'published_time<=' => time()];
    $pages = $this->CRUDModel->get_result('pages', $get_pages_where, 'page_id, name, slug, spotlight');

    foreach ($pages as $page) {
        $url = $this->cc['base_url'] . slug2url_fnc('pages_details', $page['page_id'], $page['slug'], $page['name']);
        $xml .= "    <item>\n";
        $xml .= "      <title>Page: " . htmlspecialchars($page['name']) . "</title>\n";
        $xml .= "      <link>" . htmlspecialchars($url) . "</link>\n";
        $xml .= "      <description><![CDATA[" . htmlspecialchars($page['spotlight']) . "]]></description>\n";
        $xml .= "      <pubDate>" . date("D, d M Y H:i:s O") . "</pubDate>\n";
        $xml .= "      <guid>" . htmlspecialchars($url) . "</guid>\n";
        $xml .= "    <author>". $this->cc['app_email'] ." (". $this->cc['app_name'] .")</author>\n";
        $xml .= "    </item>\n";
    }

    $xml .= "  </channel>\n";
    $xml .= "</rss>";

    return $this->response
                ->setHeader('Content-Type', 'application/rss+xml')
                ->setBody($xml);
}
    

    public function sitemap()
    {
        $xml  = "<?xml version='1.0' encoding='UTF-8'?>\n";
        $xml .= "<urlset xmlns='http://www.sitemaps.org/schemas/sitemap/0.9'>\n";


        $get_categories_where = ['status' => 1, 'published_time<=' => time()];
        $categories = $this->CRUDModel->get_result('categories', $get_categories_where, 'category_id, name, slug');

        foreach($categories as $category){

            $xml .= "<url>\n";
            $xml .= "<loc>" .$this->cc['base_url'].slug2url_fnc('items_by_categories', $category['category_id'], $category['slug'], $category['name']). "</loc>\n";
            $xml .= "<lastmod>" . date("Y-m-d") . "</lastmod>\n";
            $xml .= "<changefreq>daily</changefreq>\n";
            $xml .= "<priority>1.0</priority>\n";
            $xml .= "</url>\n";

        }


        $get_items_where = ['status' => 1, 'published_time<=' => time()];
        $items = $this->CRUDModel->get_result('items', $get_items_where, 'item_id, name, slug');

        foreach($items as $item){

            $xml .= "<url>\n";
            $xml .= "<loc>" .$this->cc['base_url'].slug2url_fnc('items_details', $item['item_id'], $item['slug'], $item['name']). "</loc>\n";
            $xml .= "<lastmod>" . date("Y-m-d") . "</lastmod>\n";
            $xml .= "<changefreq>daily</changefreq>\n";
            $xml .= "<priority>1.0</priority>\n";
            $xml .= "</url>\n";

        }


        $get_pages_where = ['status' => 1, 'published_time<=' => time()];
        $pages = $this->CRUDModel->get_result('pages', $get_pages_where, 'page_id, name, slug');

        foreach($pages as $page){

            $xml .= "<url>\n";
            $xml .= "<loc>" .$this->cc['base_url'].slug2url_fnc('pages_details', $page['page_id'], $page['slug'], $page['name']). "</loc>\n";
            $xml .= "<lastmod>" . date("Y-m-d") . "</lastmod>\n";
            $xml .= "<changefreq>daily</changefreq>\n";
            $xml .= "<priority>1.0</priority>\n";
            $xml .= "</url>\n";

        }

    $xml .= "</urlset>";


    return $this->response
                ->setHeader('Content-Type', 'application/xml')
                ->setBody($xml);

    }




    public function images()
    {
        $xml  = "<?xml version='1.0' encoding='UTF-8'?>\n";
        $xml .= "<urlset xmlns='http://www.sitemaps.org/schemas/sitemap/0.9' xmlns:image='http://www.google.com/schemas/sitemap-image/1.1'> \n";
        
        
        $select = "tbl_uploads.*,  
          (SELECT slug FROM tbl_items  
           WHERE item_id = tbl_uploads.parent_id LIMIT 1) AS slug,
           (SELECT name FROM tbl_items  
           WHERE item_id = tbl_uploads.parent_id LIMIT 1) AS name,
           (SELECT title FROM tbl_items  
           WHERE item_id = tbl_uploads.parent_id LIMIT 1) AS title
          ";


        $where = array('upload_type' => 'image', 'parent_type' => 'items_images');
        $images = $this->CRUDModel->get_result('uploads', $where, $select);

        foreach($images as $image){

            $xml .= "<url>\n";
            $xml .= "<loc>" . $this->cc['base_url'].slug2url_fnc('items_details', $image['parent_id'], $image['slug'], $image['name']) . "</loc>\n";
            $xml .= "<image:image>\n";
            $xml .= "<image:loc>". $this->cc['cdn_url'].display_image_fnc('webp-0x0', $image['upload_file']) ."</image:loc>\n";
            $xml .= "<image:title>".data2js_fnc($image['name'])."</image:title>\n";
            $xml .= "<image:caption>".data2js_fnc($image['title'])."</image:caption>\n";
            $xml .= "</image:image>\n";
            $xml .= "</url>\n";

        }

    $xml .= "</urlset>";


    return $this->response
                ->setHeader('Content-Type', 'application/xml')
                ->setBody($xml);

    }



    public function shop()
    {
        $xml  = "<?xml version='1.0' encoding='UTF-8'?>\n";
        $xml .= "<rss version='2.0' xmlns:g='http://base.google.com/ns/1.0'>\n";
        $xml .= "<channel>\n";
        $xml .= "<title>" . data2js_fnc($this->cc['app_meta_title']) . "</title>\n";
        $xml .= "<link>" . $this->cc['base_url'] . "</link>\n";
        $xml .= "<description>" . data2js_fnc($this->cc['app_meta_description']) . "</description>\n";

        $get_items_select = "tbl_items.*,  
          (SELECT upload_file FROM tbl_uploads  
           WHERE upload_type = 'image'  
           AND parent_type = 'items_images'  
           AND parent_id = tbl_items.item_id  
           ORDER BY sort_order ASC LIMIT 1) AS upload_file,
          (SELECT upload_id FROM tbl_uploads  
           WHERE upload_type = 'image'  
           AND parent_type = 'items_images'  
           AND parent_id = tbl_items.item_id  
           ORDER BY sort_order ASC LIMIT 1) AS upload_id";

           $get_items_where = ['status' => 1, 'published_time<=' => time()];

        $items = $this->CRUDModel->get_result('items', $get_items_where, $get_items_select, '', '');

$country_currency_map = [
  "US" => "USD", "CA" => "CAD", "MX" => "MXN", "AT" => "EUR", "BE" => "EUR",
  "BG" => "BGN", "HR" => "EUR", "CY" => "EUR", "CZ" => "CZK", "DK" => "DKK",
  "EE" => "EUR", "FI" => "EUR", "FR" => "EUR", "DE" => "EUR", "GR" => "EUR",
  "HU" => "HUF", "IE" => "EUR", "IT" => "EUR", "LV" => "EUR", "LT" => "EUR",
  "LU" => "EUR", "MT" => "EUR", "NL" => "EUR", "PL" => "PLN", "PT" => "EUR",
  "RO" => "RON", "SK" => "EUR", "SI" => "EUR", "ES" => "EUR", "SE" => "SEK",
  "AU" => "AUD", "NZ" => "NZD", "JP" => "JPY", "SG" => "SGD", "IN" => "INR",
  "AE" => "AED", "SA" => "SAR", "ZA" => "ZAR", "CR" => "CRC", "DO" => "DOP",
  "SV" => "USD", "GT" => "GTQ", "NI" => "NIO", "PA" => "PAB", "PR" => "USD",
  "AR" => "ARS", "BR" => "BRL", "CL" => "CLP", "CO" => "COP", "EC" => "USD",
  "PY" => "PYG", "PE" => "PEN", "UY" => "UYU", "VE" => "VES", "BY" => "BYN",
  "GE" => "GEL", "NO" => "NOK", "RU" => "RUB", "CH" => "CHF", "TR" => "TRY",
  "UA" => "UAH", "BH" => "BHD", "BD" => "BDT", "KH" => "KHR", "HK" => "HKD",
  "ID" => "IDR", "JO" => "JOD", "KZ" => "KZT", "KW" => "KWD", "LB" => "LBP",
  "MY" => "MYR", "MM" => "MMK", "NP" => "NPR", "OM" => "OMR", "PK" => "PKR",
  "PH" => "PHP", "KR" => "KRW", "LK" => "LKR", "TW" => "TWD", "TH" => "THB",
  "UZ" => "UZS", "VN" => "VND", "DZ" => "DZD", "AO" => "AOA", "CM" => "XAF",
  "CI" => "XOF", "EG" => "EGP", "ET" => "ETB", "GH" => "GHS", "KE" => "KES",
  "MG" => "MGA", "MU" => "MUR", "MA" => "MAD", "MZ" => "MZN", "NG" => "NGN",
  "SN" => "XOF", "TZ" => "TZS", "TN" => "TND", "UG" => "UGX", "ZM" => "ZMW",
  "ZW" => "ZWL"
];

 $accepted_countries = ["US", "CA", "MX", "AT", "BE", "BG", "HR", "CY", "CZ", "DK", "EE", "FI", "FR", "DE", "GR", "HU", "IE", "IT", "LV", "LT", "LU", "MT", "NL", "PL", "PT", "RO", "SK", "SI", "ES", "SE", "AU", "NZ", "JP", "SG", "IN", "AE", "SA", "ZA", "CR", "DO", "SV", "GT", "NI", "PA", "PR", "AR", "BR", "CL", "CO", "EC", "PY", "PE", "UY", "VE", "BY", "GE", "NO", "RU", "CH", "TR", "UA", "BH", "BD", "KH", "HK", "ID", "JO", "KZ", "KW", "LB", "MY", "MM", "NP", "OM", "PK", "PH", "KR", "LK", "TW", "TH", "UZ", "VN", "DZ", "AO", "CM", "CI", "EG", "ET", "GH", "KE", "MG", "MU", "MA", "MZ", "NG", "SN", "TZ", "TN", "UG", "ZM", "ZW"];

$xml_countries = '';
foreach ($accepted_countries as $country) {
    $currency = isset($country_currency_map[$country]) ? $country_currency_map[$country] : 'USD';
    $xml_countries .= "<g:shipping>\n";
    $xml_countries .= "<g:country>{$country}</g:country>\n";
    $xml_countries .= "<g:service>Standard</g:service>\n";
    $xml_countries .= "<g:price>0.0 USD</g:price>\n";
    $xml_countries .= "<g:min_transit_time>3</g:min_transit_time>\n";
    $xml_countries .= "<g:max_transit_time>5</g:max_transit_time>\n";
    $xml_countries .= "</g:shipping>\n";
}


        foreach($items as $item){

        $parents_sections_where = "section_id IN (SELECT DISTINCT section_id FROM tbl_items_to_sections WHERE item_id = ".$item['item_id'].")";
        $parents_sections_select = "section_id, title, name, slug";
        $parents_sections = $this->CRUDModel->get_result('sections', $parents_sections_where, $parents_sections_select);

        $parents_brands_where = "brand_id IN (SELECT DISTINCT brand_id FROM tbl_items_to_brands WHERE item_id = ".$item['item_id'].")";
        $parents_brands_select = "brand_id, title, name, slug";
        $parents_brands = $this->CRUDModel->get_result('brands', $parents_brands_where, $parents_brands_select);

        $section_title = '';
      if(!empty($parents_sections) && is_array($parents_sections)) {
        foreach ($parents_sections as $section)
                             {
                              if (!empty($section_title)) {
                                  $section_title .= ' > ';
                              }
                              $section_title .= $section['title'];
                             }
            }

      $brand_title = '';
      if(!empty($parents_brands) && is_array($parents_brands)) {
        foreach ($parents_brands as $brand)
                             {
                              if (!empty($brand_title)) {
                                  $brand_title .= ', ';
                              }
                              $brand_title .= $brand['title'];
                             }
        }

            $xml .= "<item>\n";
            $xml .= "<g:id>" . $item['mpn'] . "</g:id>\n";
            $xml .= "<g:title>" . data2js_fnc($item['title']) . "</g:title>\n";
            $price = isset($item['price']) ? floatval(preg_replace('/[^0-9.]/', '', $item['price'])) : 0.0;
            $price_previous = isset($item['price_previous']) ? floatval(preg_replace('/[^0-9.]/', '', $item['price_previous'])) : 0.0;
            if($price_previous > $price){
            $xml .= "<g:price>" . number_format($price_previous, 2, '.', '') . " USD</g:price>\n";
            $xml .= "<g:sale_price>" . number_format($price, 2, '.', '') . " USD</g:sale_price>\n";
            $sale_start = date('Y-m-d\TH:i:sO');
            $sale_end = date('Y-m-d\TH:i:sO', strtotime('+7 days'));
            $xml .= "<g:sale_price_effective_date>{$sale_start}/{$sale_end}</g:sale_price_effective_date>\n";
            }else{
             $xml .= "<g:price>" . number_format($price, 2, '.', '') . " USD</g:price>\n";   
            }
            $xml .= "<g:age_group>adult</g:age_group>\n";
            $xml .= "<g:gender>unisex</g:gender>\n";
            $xml .= "<g:color>Multicolor</g:color>\n";
            $xml .= "<g:description>" . data2js_fnc($item['spotlight']) . "</g:description>\n";
            $xml .= "<g:link>" .$this->cc['base_url'].slug2url_fnc('items_details', $item['item_id'], $item['slug'], $item['name']). "</g:link>\n";
            $xml .= "<g:image_link>". $this->cc['cdn_url'].display_image_fnc('webp-0x0', $item['upload_file']) ."</g:image_link>\n";
            $xml .= "<g:condition>new</g:condition>\n";
            $xml .= "<g:availability>in stock</g:availability>\n";
            $xml .= $xml_countries;
            $xml .= "<g:shipping_handling_time>\n";
            $xml .= "<g:min_handling_time>1</g:min_handling_time>\n";
            $xml .= "<g:max_handling_time>2</g:max_handling_time>\n";
            $xml .= "</g:shipping_handling_time>\n";
            $xml .= "<g:google_product_category>" . data2js_fnc($section_title) . "</g:google_product_category>\n";
            $xml .= "<g:gtin>" . $item['gtin'] . "</g:gtin>\n";
            $xml .= "<g:brand>" . data2js_fnc($brand_title) . "</g:brand>\n";
            $xml .= "<g:shipping_label>Worldwide Free Shipping</g:shipping_label>\n";
            $xml .= "<g:shipping_weight>1.9 kg</g:shipping_weight>\n";
            $xml .= "</item>\n";

        }

    $xml .= "</channel>\n";
    $xml .= "</rss>";


    return $this->response
                ->setHeader('Content-Type', 'application/xml')
                ->setBody($xml);

    }



   }