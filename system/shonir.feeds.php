<?php defined('SHONiR') OR exit('No direct script access allowed');

function SHONiR_Feeds_Fnc_Render(){

  header('Content-Type: application/xml; charset=utf-8');

    $SHONiR_Second =  SHONiR_URI['Second'];


    if($SHONiR_Second == 'rss.xml'){

      echo "<?xml version='1.0' encoding='UTF-8'?>
      <rss version='2.0'>
      <channel>";
 $SHONiR_Page_Details = SHONiR_Page_Details_Fnc(10);

         
      echo '<title>'. utf8_encode(htmlentities($SHONiR_Page_Details['meta_title'], ENT_XML1)).'</title>
      <description>'. utf8_encode(htmlentities($SHONiR_Page_Details['meta_description'], ENT_XML1)).'</description>
      <link>'.SHONiR_BASE.'</link>
      <language>en-us</language>';

      $SHONiR_Array = array('blogs', 'products');

      $SHONiR_Array_Key = array_rand($SHONiR_Array);

      $SHONiR_Array_Value =  $SHONiR_Array[$SHONiR_Array_Key];

      if($SHONiR_Array_Value === 'blogs'){

      $SHONiR_Get_Blogs = SHONiR_Get_Blogs_Fnc(FALSE, 0, "b.status=1 and b.published_time<".time(), "b.published_time", "desc", 1);

    if($SHONiR_Get_Blogs){
    foreach ($SHONiR_Get_Blogs as $Blog_key => $Blog_value)
    {

      $Blog_Name = utf8_encode(htmlentities($Blog_value['name'], ENT_XML1));

          $Blog_Description = utf8_encode(htmlentities(SHONiR_H2T_Fnc($Blog_value['description']), ENT_XML1));
    
      echo '<item>
      <title>'.$Blog_Name.'</title>
      <link>'. $Blog_value['href'] .'</link>
      <description><![CDATA[<img src="'.SHONiR_BASE.$Blog_value['image'].'" alt="'.$Blog_Name.'"> '.$Blog_Description.']]></description>
      <pubDate>' . date("D, d M Y H:i:s O", $Blog_value['published_time']) . '</pubDate>
      </item>';
}
    }

  }else{

    $SHONiR_Get_Products = SHONiR_Get_Products_Fnc(TRUE, 0, "p.status=1 and p.listed=1", "p.viewed asc, p.hits", "asc", 1);

      if($SHONiR_Get_Products){

        foreach ($SHONiR_Get_Products as $Product_key => $Product_value)
        {

          $Product_Name = utf8_encode(htmlentities($Product_value['name'], ENT_XML1));

          $Product_Description = utf8_encode(htmlentities(SHONiR_H2T_Fnc($Product_value['description']), ENT_XML1));

          $Product_Description = ($Product_Description)?$Product_Description:$Product_Name;


      echo '<item>
      <title>'.$Product_Name.'</title>
      <link>'. $Product_value['href'] .'</link>
      <description><![CDATA[<img src="'.SHONiR_Write_Uploads_Fnc($Product_value['image'], FALSE) .'" alt="'.$Product_Name.'"> '.$Product_Description.']]></description>
      <pubDate>' . date("D, d M Y H:i:s O", $Product_value['edit_time']) . '</pubDate>
      </item>';
        
  }
      }

    }

      echo "</channel>
      </rss>";

    }elseif($SHONiR_Second == 'images.xml'){

      echo '<?xml version="1.0" encoding="UTF-8"?>
      <urlset xmlns="http://www.sitemaps.org/schemas/sitemap/0.9"
              xmlns:image="http://www.google.com/schemas/sitemap-image/1.1">';

              $SHONiR_Get_Uploads = SHONiR_Uploads_Fnc();

    if($SHONiR_Get_Uploads){
        foreach ($SHONiR_Get_Uploads as $Upload_key => $Upload_value)
        {

          if($Upload_value['parent_type'] == 'product'){

            $SHONiR_Source = (SHONiR_SETTINGS['config_auto_watermark']=="TRUE")? $Upload_value['upload_id'] : $Upload_value['upload_file'];

          $SHONiR_image_url = SHONiR_Write_Uploads_Fnc($SHONiR_Source, FALSE);

          }else{

            $SHONiR_image_url = SHONiR_BASE.$Upload_value['upload_file'];

          }
        
          echo '<image:image>
              <image:loc>'.$SHONiR_image_url.'</image:loc>
            </image:image>';
    }
        }             

              echo '</urlset>';
    }elseif($SHONiR_Second == 'products.xml'){

        echo '<?xml version="1.0" encoding="utf-8"?>
        <rss version="2.0" xmlns:g="http://base.google.com/ns/1.0">
          <channel>';

          $SHONiR_Page_Details = SHONiR_Page_Details_Fnc(10);

          echo '<title>'. utf8_encode(htmlentities($SHONiR_Page_Details['meta_title'], ENT_XML1)).'</title>
          <description>'. utf8_encode(htmlentities($SHONiR_Page_Details['meta_description'], ENT_XML1)).'</description>
          <link>'.SHONiR_BASE.'</link>';

          $SHONiR_Get_Products = SHONiR_Get_Products_Fnc();

    if($SHONiR_Get_Products){
        foreach ($SHONiR_Get_Products as $Product_key => $Product_value)
        {

          $Product_Name = utf8_encode(htmlentities($Product_value['name'], ENT_XML1));

          $Product_Description = utf8_encode(htmlentities(SHONiR_H2T_Fnc($Product_value['description']), ENT_XML1));

          $Product_Description = ($Product_Description)?$Product_Description:$Product_Name;

         echo '<item>
         <g:id>'. $Product_value['reference'] .'</g:id>
         <title>'. $Product_Name .'</title>
          <description>'. $Product_Description.'</description>
          <link>'. $Product_value['href'] .'</link>
          <g:price>'. $Product_value['selling_price'] .' PKR</g:price>
      <g:condition>new</g:condition>
      <g:availability>in stock</g:availability>
      <g:image_link>'. SHONiR_Write_Uploads_Fnc($Product_value['image'], FALSE) .'</g:image_link>
          </item>';
    }
        }

          echo '</channel>
          </rss>';


    }elseif($SHONiR_Second == 'sitemap.xml'){

    echo '<?xml version="1.0" encoding="UTF-8"?>
    <urlset xmlns="http://www.sitemaps.org/schemas/sitemap/0.9">';


    echo '<url>
    <loc>'.SHONiR_BASE.'</loc>
    <lastmod>'.date("Y-m-d").'</lastmod>
  </url>';

  $SHONiR_Get_Blogs = SHONiR_Get_Blogs_Fnc(FALSE, 0, "b.status=1 and b.published_time<".time(), "b.published_time", "desc");

    if($SHONiR_Get_Blogs){
    foreach ($SHONiR_Get_Blogs as $Blog_key => $Blog_value)
    {
     echo '<url>
        <loc>'.$Blog_value['href'].'</loc>
        <lastmod>'.date("Y-m-d", $Blog_value['published_time']).'</lastmod>
      </url>';
}
    }


    $SHONiR_Get_Products = SHONiR_Get_Products_Fnc(FALSE, 0, "p.status=1", "hits", "asc");

    if($SHONiR_Get_Products){
        foreach ($SHONiR_Get_Products as $Product_key => $Product_value)
        {
         echo '<url>
            <loc>'.$Product_value['href'].'</loc>
            <lastmod>'.date("Y-m-d", $Product_value['edit_time']).'</lastmod>
          </url>';
    }
        }

    $SHONiR_Get_Categories = SHONiR_Get_Categories_Fnc(0, "c.status=1");

    if($SHONiR_Get_Categories){
    foreach ($SHONiR_Get_Categories as $Catagory_key => $Catagory_value)
    {
     echo '<url>
        <loc>'.$Catagory_value['href'].'</loc>
        <lastmod>'.date("Y-m-d", $Catagory_value['edit_time']).'</lastmod>
      </url>';
}
    }

    $SHONiR_Get_Pages = SHONiR_Get_Pages_Fnc(0, "p.status=1");

    if($SHONiR_Get_Pages){
    foreach ($SHONiR_Get_Pages as $Page_key => $Page_value)
    {
     echo '<url>
        <loc>'.$Page_value['href'].'</loc>
        <lastmod>'.date("Y-m-d", $Page_value['edit_time']).'</lastmod>
      </url>';
}
    }


    echo '<url>
    <loc>'.SHONiR_BASE.'Contact</loc>
    <lastmod>'.date("Y-m-d").'</lastmod>
  </url>';

    echo '</urlset>';

  }

exit;

}





?>