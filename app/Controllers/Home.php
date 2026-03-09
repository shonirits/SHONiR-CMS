<?php

namespace App\Controllers;

class Home extends Shonir_Controller
{

    public function __construct() {
        parent::__construct();
    }

    public function index(): string
    {

      $current_page_id = 'home';      

        $featured_blogs_posts_where = "status = 1 AND featured = 1 AND published_time <= " . time();
        $featured_blogs_posts = $this->CRUDModel->get_blogs_posts($featured_blogs_posts_where, 'RAND()', $this->cc['limit_posts_featured']);
        $view_data['featured_blogs_posts'] = $featured_blogs_posts;

        $trending_where = "status = 1 AND published_time <= " . time();
        $trending_items = $this->CRUDModel->get_items($trending_where, 'last_hit_time DESC', $this->cc['limit_items_newbie']);
        $view_data['trending_items'] = $trending_items;

        $newbie_where = "newbie = 1 AND status = 1 AND published_time <= " . time();
        $newbie_items = $this->CRUDModel->get_items($newbie_where, 'RAND()', $this->cc['limit_items_newbie']);
        $view_data['newbie_items'] = $newbie_items;

        $newbie_items_id = array_column($newbie_items, 'item_id');

        $featured_excluded_items = implode(',', $newbie_items_id);

        if (!empty($featured_excluded_items)) {
        $featured_where = "item_id NOT IN ($featured_excluded_items) AND status = 1 AND featured = 1 AND published_time <= " . time();
        } else {
          $featured_where = "status = 1 AND featured = 1 AND published_time <= " . time();
          }  

        $featured_items = $this->CRUDModel->get_items($featured_where, 'RAND()', $this->cc['limit_items_featured']);
        $view_data['featured_items'] = $featured_items;


        $all_excluded_items = array_merge($newbie_items_id, array_column($featured_items, 'item_id'));
        $random_excluded_items = implode(',', $all_excluded_items);


       if (!empty($random_excluded_items)) {
        $random_where = "item_id NOT IN ($random_excluded_items) AND status = 1 AND published_time <= " . time();
        } else {
          $random_where = "status = 1 AND published_time <= " . time();
      }   

      $random_items = $this->CRUDModel->get_items($random_where, 'RAND()', $this->cc['limit_items_trending']);

        $view_data['random_items'] = $random_items;

        $view_data['categories_tree'] = $this->CRUDModel->get_categories_tree($this->cc['base_url']);

        $view_data['pages_tree'] = $this->CRUDModel->get_pages_tree($this->cc['base_url']);

        $pages_where = ['status' => 1, 'listed' => 1, 'published_time <=' => time()];

        $view_data['pages'] = $this->CRUDModel->get_result('pages', $pages_where, 'page_id, sort_order, slug, title, name');

        $categories_where = ['status' => 1, 'listed' => 1, 'published_time <=' => time()];

        $view_data['categories'] = $this->CRUDModel->get_result('categories', $categories_where, 'category_id, items, icon, slug, title, name', 'sort_order ASC');

        $view_data['sections'] = $this->CRUDModel->get_result('sections', '', 'section_id, slug, title, name', 'sort_order ASC', 10);
        $view_data['industries'] = $this->CRUDModel->get_result('industries', '', 'industry_id, slug, title, name', 'sort_order ASC', 10);
        $view_data['voices'] = $this->CRUDModel->get_result('voices', '', 'voice_id, slug, title, name', 'sort_order ASC', 10);
        $view_data['regions'] = $this->CRUDModel->get_result('regions', '', 'region_id, slug, title, name', 'sort_order ASC', 10);
        $view_data['banners'] = $this->CRUDModel->get_banners($current_page_id, 'sort_order ASC');
        $view_data['gallery_videos'] = $this->CRUDModel->get_galleries('gallery-videos', 'video');
        $view_data['gallery_images'] = $this->CRUDModel->get_galleries('gallery-images', 'image');

        
         $view_data['page'] = [
            'title' => $this->cc['app_meta_title'],
           'description' => $this->cc['app_meta_description'],
           'keywords' => $this->cc['app_meta_keywords'],
           'url' => current_url(),
           'id' => $current_page_id,
           'type' => "website"
         ];  

       $view_data['cc'] = $this->cc;

       $i = 0;
       $x = 0;
       $micro_items = '';
       $json_items = '';

       if($trending_items){

         $count = count($trending_items);          

        foreach($trending_items as $trending_item){

         $x++;
         $i++;

           $json_items .= '{
                            "@type": "ListItem",
                            "position": '.($i).',
                            "name": "'.data2json_fnc($trending_item['meta_title']).'",
                            "item": "'.$this->cc['base_url'].slug2url_fnc('items_details', $trending_item['item_id'], $trending_item['slug'], $trending_item['meta_title']).'"                              
                          }';

                           if ($x < $count) {
            $json_items .= ',';
            }


            $micro_items .= ' <li itemprop="itemListElement" itemscope itemtype="https://schema.org/ListItem">
        <a itemprop="item" href="'.$this->cc['base_url'].slug2url_fnc('items_details', $trending_item['item_id'], $trending_item['slug'], $trending_item['meta_title']).'">
          <span itemprop="name">'.data2json_fnc($trending_item['meta_title']).'</span>
        </a>
        <meta itemprop="position" content="'.($i).'" />
      </li>';


        }
       }

        if($newbie_items){

          if ($x > 0) {
            $json_items .= ',';
            }

         $count = count($newbie_items);
          $x = 0;           

        foreach($newbie_items as $newbie_item){

         $x++;
         $i++;

           $json_items .= '{
                            "@type": "ListItem",
                            "position": '.($i).',
                            "name": "'.data2json_fnc($newbie_item['meta_title']).'",
                            "item": "'.$this->cc['base_url'].slug2url_fnc('items_details', $newbie_item['item_id'], $newbie_item['slug'], $newbie_item['meta_title']).'"                              
                          }';

                           if ($x < $count) {
            $json_items .= ',';
            }


            $micro_items .= ' <li itemprop="itemListElement" itemscope itemtype="https://schema.org/ListItem">
        <a itemprop="item" href="'.$this->cc['base_url'].slug2url_fnc('items_details', $newbie_item['item_id'], $newbie_item['slug'], $newbie_item['meta_title']).'">
          <span itemprop="name">'.data2json_fnc($newbie_item['meta_title']).'</span>
        </a>
        <meta itemprop="position" content="'.($i).'" />
      </li>';


        }
       }


        if($featured_items){

          if ($x > 0) {
            $json_items .= ',';
            }

         $count = count($featured_items);
          $x = 0;

        foreach($featured_items as $featured_item){

         $x++;
         $i++;

           $json_items .= '{
                            "@type": "ListItem",
                            "position": '.($i).',
                            "name": "'.data2json_fnc($featured_item['meta_title']).'",
                            "item": "'.$this->cc['base_url'].slug2url_fnc('items_details', $featured_item['item_id'], $featured_item['slug'], $featured_item['meta_title']).'"                              
                          }';

                           if ($x < $count) {
            $json_items .= ',';
            }


            $micro_items .= ' <li itemprop="itemListElement" itemscope itemtype="https://schema.org/ListItem">
        <a itemprop="item" href="'.$this->cc['base_url'].slug2url_fnc('items_details', $featured_item['item_id'], $featured_item['slug'], $featured_item['meta_title']).'">
          <span itemprop="name">'.data2json_fnc($featured_item['meta_title']).'</span>
        </a>
        <meta itemprop="position" content="'.($i).'" />
      </li>';


        }
       }




       if($random_items){

        if ($x > 0) {
            $json_items .= ',';
            }

         $count = count($random_items);
          $x = 0;

        foreach($random_items as $random_item){

         $x++;
         $i++;

           $json_items .= '{
                            "@type": "ListItem",
                            "position": '.($i).',
                            "name": "'.data2json_fnc($random_item['meta_title']).'",
                            "item": "'.$this->cc['base_url'].slug2url_fnc('items_details', $random_item['item_id'], $random_item['slug'], $random_item['meta_title']).'"                              
                          }';

                           if ($x < $count) {
            $json_items .= ',';
            }


            $micro_items .= ' <li itemprop="itemListElement" itemscope itemtype="https://schema.org/ListItem">
        <a itemprop="item" href="'.$this->cc['base_url'].slug2url_fnc('items_details', $random_item['item_id'], $random_item['slug'], $random_item['meta_title']).'">
          <span itemprop="name">'.data2json_fnc($random_item['meta_title']).'</span>
        </a>
        <meta itemprop="position" content="'.($i).'" />
      </li>';


        }
       }
       

        if($json_items){
           $json_items = '['. $json_items.']';
        }else{
           $json_items = 'null';
        }

        

        $json_lang = '';
        $micro_lang = '';


        if (!empty($this->cc['app_languages']) && is_string($this->cc['app_languages'])) {

         $language_array = explode(',', $this->cc['app_languages']);

          if (!empty($language_array)) {
        foreach ($language_array as $index => $lang) {
          $json_lang .= '"'.trim($lang).'"';
          $micro_lang .= '<meta itemprop="availableLanguage" content="' . trim($lang) . "\" />\n";
          if ($index < count($language_array) - 1) {
              $json_lang .= ', ';
          }
      }

    }

    }


       $view_data['structured_data'] = '
       <script type="application/ld+json">
         {
  "@context": "https://schema.org",
  "@graph": [
    {
      "@type": "WebSite",
      "name": "'.data2json_fnc($this->cc['app_meta_title']).'",
      "alternateName": "'.data2json_fnc($this->cc['app_name']).'",
      "url": "'.$this->cc['base_url'].'",
      "potentialAction": {
        "@type": "SearchAction",
        "target": {
          "@type": "EntryPoint",
          "urlTemplate": "'.$this->cc['base_url'].'search.html?query={search_term_string}"
        },
        "query-input": "required name=search_term_string"
      },
      "description": "'.data2json_fnc($this->cc['app_meta_description']).'"
    },
    {
      "@type": "Organization",
      "name": "'.data2json_fnc($this->cc['app_name']).'",
      "url": "'.$this->cc['base_url'].'",
      "logo": "'.$this->cc['base_url'].'public/images/frontend/'.$this->cc['frontend_theme'].'/logo.png",
      "sameAs": [
        "'.$this->cc['social_facebook'].'",
        "'.$this->cc['social_instagram'].'",
        "'.$this->cc['social_x'].'",
        "'.$this->cc['social_pinterest'].'",
        "'.$this->cc['social_linkedin'].'",
        "'.$this->cc['social_youtube'].'",
        "'.$this->cc['social_blogger'].'",
        "'.$this->cc['social_group'].'",
        "'.$this->cc['social_tumblr'].'",
        "'.$this->cc['social_reddit'].'",
        "'.$this->cc['social_map'].'"
      ],
      "foundingDate": "'.$this->cc['app_founding_date'].'",
      "contactPoint": [
        {
          "@type": "ContactPoint",
          "telephone": "'.$this->cc['app_telephone'].'",
          "contactType": "customer service",
          "email": "mailto:'.$this->cc['app_email'].'",
          "areaServed": "'.$this->cc['app_country'].'",
          "availableLanguage": ['.$json_lang.']
        }
      ],
      "address": {
        "@type": "PostalAddress",
        "streetAddress": "'.$this->cc['app_address'].'",
        "addressLocality": "'.$this->cc['app_city'].'",
        "addressRegion": "'.$this->cc['app_region'].'",
        "postalCode": "'.$this->cc['app_postal'].'",
        "addressCountry": "'.$this->cc['app_country'].'"
      }
    },
    {
      "@type": "BreadcrumbList",
      "itemListElement": '.$json_items.'
    }
  ]
}
       </script>


<div style="display: none;" itemscope itemtype="https://schema.org/WebPage">
  <div itemscope itemtype="https://schema.org/WebSite">
    <meta itemprop="name" content="'.data2json_fnc($this->cc['app_meta_title']).'" />
    <meta itemprop="alternateName" content="'.data2json_fnc($this->cc['app_name']).'" />
    <link itemprop="url" href="'.$this->cc['base_url'].'" />
    <div itemprop="potentialAction" itemscope itemtype="https://schema.org/SearchAction">
      <meta itemprop="query-input" content="required name=search_term_string" />
      <div itemprop="target" itemscope itemtype="https://schema.org/EntryPoint">
        <meta itemprop="urlTemplate" content="'.$this->cc['base_url'].'search.html?query={search_term_string}" />
      </div>
    </div>
    <meta itemprop="description" content="'.data2json_fnc($this->cc['app_meta_description']).'" />
  </div>
  <div itemscope itemtype="https://schema.org/Organization">
    <meta itemprop="name" content="'.data2json_fnc($this->cc['app_name']).'" />
    <link itemprop="url" href="'.$this->cc['base_url'].'" />
    <img itemprop="logo" src="'.$this->cc['base_url'].'public/images/frontend/'.$this->cc['frontend_theme'].'/logo.png" alt="'.data2json_fnc($this->cc['app_name']).'" />    
    <meta itemprop="sameAs" content="'.$this->cc['social_facebook'].'" />
    <meta itemprop="sameAs" content="'.$this->cc['social_instagram'].'" />
    <meta itemprop="sameAs" content="'.$this->cc['social_x'].'" />
    <meta itemprop="sameAs" content="'.$this->cc['social_pinterest'].'" />
    <meta itemprop="sameAs" content="'.$this->cc['social_linkedin'].'" />
    <meta itemprop="sameAs" content="'.$this->cc['social_youtube'].'" />
    <meta itemprop="sameAs" content="'.$this->cc['social_blogger'].'" />
    <meta itemprop="sameAs" content="'.$this->cc['social_group'].'" />
    <meta itemprop="sameAs" content="'.$this->cc['social_tumblr'].'" />
    <meta itemprop="sameAs" content="'.$this->cc['social_reddit'].'" />
    <meta itemprop="sameAs" content="'.$this->cc['social_map'].'" />
    <meta itemprop="foundingDate" content="'.$this->cc['app_founding_date'].'" />    
    <div itemprop="contactPoint" itemscope itemtype="https://schema.org/ContactPoint">
      <meta itemprop="contactType" content="customer service" />
      <meta itemprop="telephone" content="'.$this->cc['app_telephone'].'" />
      <meta itemprop="email" content="'.$this->cc['app_email'].'" />
      <meta itemprop="areaServed" content="'.$this->cc['app_country'].'" />
      '.$micro_lang.'
    </div>
    <div itemprop="address" itemscope itemtype="https://schema.org/PostalAddress">
      <meta itemprop="streetAddress" content="'.$this->cc['app_address'].'" />
      <meta itemprop="addressLocality" content="'.$this->cc['app_city'].'" />
      <meta itemprop="addressRegion" content="'.$this->cc['app_region'].'" />
      <meta itemprop="postalCode" content="'.$this->cc['app_postal'].'" />
      <meta itemprop="addressCountry" content="'.$this->cc['app_country'].'" />
    </div>
  </div>
  <nav style="display: none;" aria-label="breadcrumb" itemscope itemtype="https://schema.org/BreadcrumbList">
    <ol>     
     '.$micro_items.'
    </ol>
  </nav>
</div>
';

        $welcome_where = array('page_id' => 10, 'status' => 1, 'published_time<=' => time());                    
        $view_data['content_welcome'] = $this->CRUDModel->get_with_uploads('pages', $welcome_where, 10, 'image', 5);

          if($this->cc['cache_time'] > 0){
       $this->cachePage($this->cc['cache_time']);
       }
      
        return view('frontend/'.$this->cc['frontend_theme'].'/home', $view_data);
    }
}
