<?php

namespace App\Controllers;

class Contact extends Shonir_Controller
{

    public function __construct() {
        parent::__construct();
    }

    public function index()
    {

        $GLOBALS['HTMLS_CACHE'] = false;

        $current_page_id = 'contact';

        $get_row_where = array('page_id' => 14, 'status' => 1, 'published_time<=' => time());                    
        $get_row = $this->CRUDModel->get_row('pages', $get_row_where);

        if(!$get_row){

            throw \CodeIgniter\Exceptions\PageNotFoundException::forPageNotFound(); 

        }

        $view_data['row'] = $get_row;

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
        
        $random_where = "status = 1 AND published_time <= " . time();

        $random_items = $this->CRUDModel->get_items($random_where, 'RAND()', $this->cc['limit_items_trending']);

        $view_data['random_items'] = $random_items;

        $get_pages_where = ['status' => 1, 'published_time<=' => time()];
        $get_pages_result = $this->CRUDModel->get_result('pages', $get_pages_where, 'page_id, slug, name, listed, top, bottom');
        $pages = [];
        foreach ($get_pages_result as $page) {
        $pages[$page['page_id']] = $page;     
        }
        $view_data['pages'] = $pages; 

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
      "name": "'.data2json_fnc($get_row['meta_title']).'",
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
      "description": "'.data2json_fnc($get_row['meta_description']).'"
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
    }
  ]
}
       </script>

  <div style="display: none;" itemscope itemtype="https://schema.org/WebPage">
  <div itemscope itemtype="https://schema.org/WebSite">
    <meta itemprop="name" content="'.data2json_fnc($get_row['meta_title']).'" />
    <meta itemprop="alternateName" content="'.data2json_fnc($this->cc['app_name']).'" />
    <link itemprop="url" href="'.$this->cc['base_url'].'" />
    <div itemprop="potentialAction" itemscope itemtype="https://schema.org/SearchAction">
      <meta itemprop="query-input" content="required name=search_term_string" />
      <div itemprop="target" itemscope itemtype="https://schema.org/EntryPoint">
        <meta itemprop="urlTemplate" content="'.$this->cc['base_url'].'search.html?query={search_term_string}" />
      </div>
    </div>
    <meta itemprop="description" content="'.data2json_fnc($get_row['meta_description']).'" />
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
</div>

';
    

        $view_data['page'] = [
            'title' => $get_row['meta_title']." | ".$this->cc['app_name'],
           'description' => $get_row['meta_description'],
           'keywords' => $get_row['meta_keywords'],
           'url' => current_url(),
           'id' => $current_page_id,
           'type' => "website"
         ];  

       $view_data['cc'] = $this->cc;

       if($this->cc['cache_time'] > 0){
       $this->cachePage($this->cc['cache_time']);
       }

        return view('frontend/'.$this->cc['frontend_theme'].'/contact', $view_data);

    }


}