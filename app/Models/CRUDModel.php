<?php namespace App\Models;
use CodeIgniter\Model;
use App\Models\BaseModel;

class CRUDModel extends BaseModel
{


  public function resolve_table($table)
{
    $tables = $this->db->listTables();
    $prefix = $this->db->getPrefix();

    if (in_array($table, $tables)) {
        return $table;
    }

    $prefixed = $prefix . $table;
    if (in_array($prefixed, $tables)) {
        return $prefixed;
    }

    $log_data = "Table {$table} not found.";
    logs_fnc($log_data);

    return false;
}
    
    
  public function do_create($table, $data)
{
    $table = $this->resolve_table($table);
    if (!$table) {
        return 0;
    }

    $validFields = $this->db->getFieldNames($table);
    $invalidFields = array_diff(array_keys($data), $validFields);
    if (!empty($invalidFields)) {
        logs_fnc("do_create() Invalid columns in '{$table}': " . implode(', ', $invalidFields));
    }
    $filteredData = array_intersect_key($data, array_flip($validFields));
    if (empty($filteredData)) {
        return 0; 
    }

    $builder = $this->db->table($table);
    $inserted = $builder->insert($filteredData);

    return $inserted ? $this->db->insertID() : 0;
}



  public function do_update($table, $where, $data, $escaping = true)
{
    
    $table = $this->resolve_table($table);
    if (!$table) {
        return false;
    }

    $validFields = $this->db->getFieldNames($table);
     $invalidFields = array_diff(array_keys($data), $validFields);
    if (!empty($invalidFields)) {
        logs_fnc("do_update() Invalid columns in '{$table}': " . implode(', ', $invalidFields));
    }
    $filteredData = array_intersect_key($data, array_flip($validFields));
    if (empty($filteredData)) {
        return false; 
    }

    $builder = $this->db->table($table);

    
    if ($escaping === true) {
        $builder->set($filteredData);
    } else {
        foreach ($filteredData as $column => $value) {
            $builder->set($column, $value, $escaping);
        }
    }

    
    if (!empty($where)) {
        if (is_array($where)) {
            foreach ($where as $key => $value) {
                if (is_array($value)) {
                    $builder->whereIn($key, $value);
                } else {
                    $builder->where($key, $value);
                }
            }
        } elseif (is_string($where)) {
            $builder->where($where);
        }
    } else {
        return false; 
    }

    return $builder->update();
}



 public function do_delete($table, $where)
{
    $table = $this->resolve_table($table);
    if (!$table) {
        return false;
    }

    if (empty($where)) {
        return false; 
    }

    $builder = $this->db->table($table);

    if (is_array($where)) {
        foreach ($where as $key => $value) {
            if (is_array($value)) {
                $builder->whereIn($key, $value);
            } else {
                $builder->where($key, $value);
            }
        }
    } elseif (is_string($where)) {
        $builder->where($where);
    } else {
        return false; 
    }

    return $builder->delete();
}



  public function is_exist($table, $where = '', $like = '')
{
    $table = $this->resolve_table($table);
    if (!$table) {
        return false;
    }

    $builder = $this->db->table($table)->select('1')->limit(1);

    if (!empty($like)) {
        $builder->groupStart();
        $builder->like($like);
        $builder->orLike($like);
        $builder->groupEnd();
    }

    if (!empty($where)) {
        if (is_array($where)) {
            foreach ($where as $key => $value) {
                if (is_array($value)) {
                    $builder->whereIn($key, $value);
                } else {
                    $builder->where($key, $value);
                }
            }
        } elseif (is_string($where)) {
            $builder->where($where);
        }
    }

    return $builder->get()->getNumRows() > 0;
}

  
  public function do_count($table, $where = '', $like = '')
{
    $table = $this->resolve_table($table);
    if (!$table) {
        return 0;
    }

    $builder = $this->db->table($table);

    if (!empty($like)) {
        $builder->groupStart();
        $builder->like($like);
        $builder->orLike($like);
        $builder->groupEnd();
    }

    if (!empty($where)) {
        if (is_array($where)) {
            foreach ($where as $key => $value) {
                if (is_array($value)) {
                    $builder->whereIn($key, $value);
                } else {
                    $builder->where($key, $value);
                }
            }
        } elseif (is_string($where)) {
            $builder->where($where);
        }
    }

    return $builder->countAllResults();
}

  


  public function get_row($table, $where, $select = '', $orderBy = '', $limit = 1)
{
    $table = $this->resolve_table($table);
    if (!$table) {
        return [];
    }

    $builder = $this->db->table($table);

    if (!empty($select)) {
        $builder->select($select);
    }

    if (!empty($where)) {
        if (is_array($where)) {
            foreach ($where as $key => $value) {
                if (is_array($value)) {
                    $builder->whereIn($key, $value);
                } else {
                    $builder->where($key, $value);
                }
            }
        } elseif (is_string($where)) {
            $builder->where($where);
        }
    }

    if (!empty($orderBy)) {
        $builder->orderBy($orderBy);
    }

    $builder->limit($limit);

    return $builder->get()->getRowArray();
}



  public function get_result($table, $where = '', $select = '', $orderBy = '', $limit = '', $start = 0, $like = '', $array = true, $groupBy = '')
{
    $table = $this->resolve_table($table);
    if (!$table) {
        return $array ? [] : (object)[];
    }

    $builder = $this->db->table($table);

    if (!empty($select)) {
        $builder->select($select);
    }

    if (!empty($groupBy)) {
        $builder->groupBy($groupBy);
    }

    if (!empty($like)) {
        $builder->groupStart();
        $builder->like($like);
        $builder->orLike($like);
        $builder->groupEnd();
    }

    if (!empty($where)) {
        if (is_array($where)) {
            foreach ($where as $key => $value) {
                if (is_array($value)) {
                    $builder->whereIn($key, $value);
                } else {
                    $builder->where($key, $value);
                }
            }
        } elseif (is_string($where)) {
            $builder->where($where);
        }
    }

    if (!empty($orderBy)) {
        $builder->orderBy($orderBy);
    }

    if (!empty($limit)) {
        $builder->limit($limit, $start);
    }

    $query = $builder->get();

    return $array ? $query->getResultArray() : $query->getResult();
}


function get_with_uploads($tbl, $where, $id, $type, $limit)
{

$cache_key = md5('get_with_uploads_'.$tbl.'_'.$id.'_'.$type.'_'.$limit);

    $cache = service('cache');

    if ($cached = $cache->get($cache_key)) {
        return $cached;
    }


    $parent_data = $this->get_row($tbl, $where);

    if (!$parent_data) {
        return [];
    }

    $return = $parent_data;

    $uploads_where = [
        'upload_type' => $type,
        'parent_id'   => $id,
        'parent_type' => $tbl . '_' . $type . 's'
    ];

    $uploads_data = $this->get_result(
        'uploads',
        $uploads_where,
        'upload_file',
        'sort_order ASC',
        $limit
    );

    if (!empty($uploads_data)) {
        $i = 1;
        foreach ($uploads_data as $data) {
            $return[$type . $i] = $data['upload_file'] ?? '';
            $i++;
        }
    }

    $cache->save($cache_key, $return, 3600); 

    return $return;
}


  
function get_pages_tree($base_url) {
    
    $cache_key = md5('get_pages_tree');

    $cache = service('cache');

    if ($cached = $cache->get($cache_key)) {
        return $cached;
    }

    $pages_where = ['status' => 1, 'listed' => 1, 'published_time <=' => time()];

    $get_pages_select = "tbl_pages.*,  
    (SELECT upload_file FROM tbl_uploads  
     WHERE upload_type = 'image'  
     AND parent_type = 'pages_images'  
     AND parent_id = tbl_pages.page_id  
     ORDER BY sort_order ASC LIMIT 1 OFFSET 0) AS image1,
     
    (SELECT upload_file FROM tbl_uploads  
     WHERE upload_type = 'image'  
     AND parent_type = 'pages_images'  
     AND parent_id = tbl_pages.page_id  
     ORDER BY sort_order ASC LIMIT 1 OFFSET 1) AS image2,

    page_id, title, name, spotlight, sort_order, slug, featured, top, bottom";

    $pages = $this->get_result('pages', $pages_where, $get_pages_select, 'sort_order ASC', '', '', '', true);
    $relations = $this->get_result('pages_to_pages', '', 'parent_id, children_id', '', '', '', '', true);

    $menu_data = build_tree_fnc($pages, $relations, 'pages_details', 'page', $base_url);

    $cache->save($cache_key, $menu_data, 3600); 

    return $menu_data;
}


  function get_categories_tree($base_url) {
    
    $cache_key = md5('get_categories_tree');

    $cache = service('cache');

    if ($cached = $cache->get($cache_key)) {
        return $cached;
    }

    $categories_where = ['status' => 1, 'listed' => 1, 'published_time <=' => time()];

    $get_categories_select = "tbl_categories.*,  
    (SELECT upload_file FROM tbl_uploads  
     WHERE upload_type = 'image'  
     AND parent_type = 'categories_images'  
     AND parent_id = tbl_categories.category_id  
     ORDER BY sort_order ASC LIMIT 1 OFFSET 0) AS image1,
     
    (SELECT upload_file FROM tbl_uploads  
     WHERE upload_type = 'image'  
     AND parent_type = 'categories_images'  
     AND parent_id = tbl_categories.category_id  
     ORDER BY sort_order ASC LIMIT 1 OFFSET 1) AS image2,

    category_id, title, name, spotlight, sort_order, slug, featured, top, bottom";

    $categories = $this->get_result('categories', $categories_where, $get_categories_select, 'sort_order ASC', '', '', '', true);
    $relations = $this->get_result('categories_to_categories', '', 'parent_id, children_id', '', '', '', '', true);

    $menu_data = build_tree_fnc($categories, $relations, 'items_by_categories', 'category', $base_url);

    $cache->save($cache_key, $menu_data, 3600); 

    return $menu_data;
}



  public function get_items($get_items_where = '', $orderBy = '', $limit = '')
{
    $remove = ['published_time'];
    $get_key = filter_query_fnc($get_items_where, $remove);
    $cache_key = md5('get_items_'.$orderBy.'_'.$get_key);

    $cache = service('cache');

    if ($cached = $cache->get($cache_key)) {
        return $cached;
    }

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
         ORDER BY sort_order ASC LIMIT 1) AS upload_id,

        (SELECT upload_file FROM tbl_uploads  
         WHERE upload_type = 'image'  
         AND parent_type = 'items_images'  
         AND parent_id = tbl_items.item_id  
         ORDER BY sort_order ASC LIMIT 1 OFFSET 1) AS upload_file2,
         
        (SELECT upload_id FROM tbl_uploads  
         WHERE upload_type = 'image'  
         AND parent_type = 'items_images'  
         AND parent_id = tbl_items.item_id  
         ORDER BY sort_order ASC LIMIT 1 OFFSET 1) AS upload_id2";

    $get_items = $this->get_result('items', $get_items_where, $get_items_select, $orderBy, $limit);

    if (!empty($get_items)) {

          $get_items_update_item_ids = array_column($get_items, 'item_id');

          if (!empty($get_items_update_item_ids)) {

              $get_items_update_where = [
                  'item_id' => $get_items_update_item_ids
              ];

              $get_items_update_data = [
                  'today_views'    => 'today_views + 1',
                  'last_view_time' => time()
              ];

              $this->do_update(
                  'items',  
                  $get_items_update_where,
                  $get_items_update_data,
                  false
              );
          }

          }

    $cache->save($cache_key, $get_items, 3600);

    return $get_items;
}


public function get_blogs_posts($get_blogs_posts_where = '', $orderBy = '', $limit = '')
{
    $remove = ['published_time'];
    $get_key = filter_query_fnc($get_blogs_posts_where, $remove);
    $cache_key = md5('get_blogs_posts_'.$orderBy.'_'.$get_key);

    $cache = service('cache');

    if ($cached = $cache->get($cache_key)) {
        return $cached;
    }

    $get_blogs_posts_select = "tbl_blogs_posts.*,  
        (SELECT upload_file FROM tbl_uploads  
         WHERE upload_type = 'image'  
         AND parent_type = 'blogs_posts_images'  
         AND parent_id = tbl_blogs_posts.blog_post_id  
         ORDER BY sort_order ASC LIMIT 1) AS upload_file,
         
        (SELECT upload_id FROM tbl_uploads  
         WHERE upload_type = 'image'  
         AND parent_type = 'blogs_posts_images'  
         AND parent_id = tbl_blogs_posts.blog_post_id  
         ORDER BY sort_order ASC LIMIT 1) AS upload_id,

        (SELECT upload_file FROM tbl_uploads  
         WHERE upload_type = 'image'  
         AND parent_type = 'blogs_posts_images'  
         AND parent_id = tbl_blogs_posts.blog_post_id  
         ORDER BY sort_order ASC LIMIT 1 OFFSET 1) AS upload_file2,
         
        (SELECT upload_id FROM tbl_uploads  
         WHERE upload_type = 'image'  
         AND parent_type = 'blogs_posts_images'  
         AND parent_id = tbl_blogs_posts.blog_post_id  
         ORDER BY sort_order ASC LIMIT 1 OFFSET 1) AS upload_id2";

    $get_blogs_posts = $this->get_result('blogs_posts', $get_blogs_posts_where, $get_blogs_posts_select, $orderBy, $limit);

    if (!empty($get_blogs_posts)) {

          $get_blogs_posts_update_blog_post_ids = array_column($get_blogs_posts, 'blog_post_id');

          if (!empty($get_blogs_posts_update_blog_post_ids)) {

              $get_blogs_posts_update_where = [
                  'blog_post_id' => $get_blogs_posts_update_blog_post_ids
              ];

              $get_blogs_posts_update_data = [
                  'today_views'    => 'today_views + 1',
                  'last_view_time' => time()
              ];

              $this->do_update(
                  'blogs_posts',  
                  $get_blogs_posts_update_where,
                  $get_blogs_posts_update_data,
                  false
              );
          }

          $i = 0;
        foreach($get_blogs_posts as $result){

        $parents_blogs_categories_where = "blog_category_id IN (SELECT DISTINCT blog_category_id FROM tbl_blogs_posts_to_categories WHERE blog_post_id = ".$result['blog_post_id'].")";
        $parents_blogs_categories_select = "blog_category_id, title, name, slug";
        $parents_blogs_categories = $this->get_result('blogs_categories', $parents_blogs_categories_where, $parents_blogs_categories_select);

        $blogs_posts_to_categories = array_column($parents_blogs_categories, 'blog_category_id');

        $get_blogs_posts[$i]['parents_blogs_categories'] = $parents_blogs_categories;

        $add_by_info_where = ['user_id' => $result['add_by']];
        $add_by_info_select = "email, nickname, gender";
        $get_blogs_posts[$i]['add_by_info'] = $this->get_row('users', $add_by_info_where, $add_by_info_select);

        $i++;
        }

          }

    $cache->save($cache_key, $get_blogs_posts, 3600);

    return $get_blogs_posts;
}



    public function get_banners($parent_id, $orderBy)
    {

      if(!$parent_id){return false;}

       $cache_key = md5('get_banners_'.$parent_id);

      $cache = service('cache');

      if ($cached = $cache->get($cache_key)) {
        return $cached;
    }

      $get_banners_select = "tbl_banners.*,  
          (SELECT upload_file FROM tbl_uploads  
           WHERE upload_type = 'image'  
           AND parent_type = 'banners_images'  
           AND parent_id = tbl_banners.banner_id  
           ORDER BY  RAND() LIMIT 1) AS upload_file,
          (SELECT upload_id FROM tbl_uploads  
           WHERE upload_type = 'image'  
           AND parent_type = 'banners_images'  
           AND parent_id = tbl_banners.banner_id  
           ORDER BY  RAND() LIMIT 1) AS upload_id";

           $get_banners_where = "status = 1 AND published_time <= " . time() . " AND (parent_id = '" . $parent_id . "' OR parent_id = 'global') ";

      $get_banners = $this->get_result('banners', $get_banners_where, $get_banners_select, $orderBy);


        if (!empty($get_banners)) {

          $get_banners_update_banner_ids = array_column($get_banners, 'banner_id');

          if (!empty($get_banners_update_banner_ids)) {

              $get_banners_update_where = [
                  'banner_id' => $get_banners_update_banner_ids
              ];

              $get_banners_update_data = [
                  'today_views'    => 'today_views + 1',
                  'last_view_time' => time()
              ];

              $this->do_update(
                  'banners',  
                  $get_banners_update_where,
                  $get_banners_update_data,
                  false
              );
          }

          }
        

        $cache->save($cache_key, $get_banners, 3600);

        return $get_banners;

    } 


    public function get_galleries($parent_id, $parent_type)
    {

      if(!$parent_id){return false;}

       $cache_key = md5('get_galleries_'.$parent_id);

      $cache = service('cache');

      if ($cached = $cache->get($cache_key)) {
        return $cached;
    }

      $get_galleries_select = "tbl_galleries.*,  
          (SELECT upload_file FROM tbl_uploads  
           WHERE upload_type = 'image'  
           AND parent_type = 'galleries_images'  
           AND parent_id = tbl_galleries.gallery_id  
           ORDER BY  RAND() LIMIT 1) AS upload_file,
          (SELECT upload_id FROM tbl_uploads  
           WHERE upload_type = 'image'  
           AND parent_type = 'galleries_images'  
           AND parent_id = tbl_galleries.gallery_id  
           ORDER BY  RAND() LIMIT 1) AS upload_id";

           $get_galleries_where = "status = 1 AND listed = 1 AND featured = 1 AND parent_id = '" . $parent_id . "' AND parent_type = '" . $parent_type . "'";

      $get_galleries = $this->get_result('galleries', $get_galleries_where, $get_galleries_select, 'sort_order ASC');

        if (!empty($get_galleries)) {

          $get_galleries_update_gallery_ids = array_column($get_galleries, 'gallery_id');

          if (!empty($get_galleries_update_gallery_ids)) {

              $get_galleries_update_where = [
                  'gallery_id' => $get_galleries_update_gallery_ids
              ];

              $get_galleries_update_data = [
                  'today_views'    => 'today_views + 1',
                  'last_view_time' => time()
              ];

              $this->do_update(
                  'galleries',  
                  $get_galleries_update_where,
                  $get_galleries_update_data,
                  false
              );
          }

          }

       $cache->save($cache_key, $get_galleries, 3600);

        return $get_galleries;

    } 


}