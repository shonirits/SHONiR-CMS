<?php use PHPUnit\TextUI\Command;
use function PHPUnit\Framework\isEmpty;
use function PHPUnit\Framework\isNull;

if (!function_exists('navbar_fnc')) {
   function navbar_fnc($items, $active_id, $level = 1, $start = true) {
    if ($start) {
        return navbar_fnc($items, $active_id, $level, false);
    }

    $html = '';
    foreach ($items as $item) {
        if (!isset($item['name']) || !isset($item['link'])) continue;

        $hasChildren = isset($item['children']) && is_array($item['children']) && count($item['children']);
        $isActive = strtolower($active_id) == strtolower(slug_fnc($item['name'])) || has_active_child($item['children'] ?? [], $active_id);

        $liClass = 'nav-item';
        $aClass = 'nav-link';
        $ulClass = 'dropdown-menu level-'.$level;
        $toggleAttr = '';
        $submenuClass = '';

        if ($level === 1) {
            if ($hasChildren) {
                $liClass .= ' dropdown';
                $aClass .= ' dropdown-toggle has-submenu';
                $toggleAttr = ' data-bs-toggle="dropdown"';
            }
            if ($isActive) {
                $liClass .= ' active';
                $aClass .= ' active';
            }
        } else {
            $liClass = '';
            $aClass = 'dropdown-item';
            if ($hasChildren) {
                $aClass .= ' has-submenu';
                $ulClass = 'submenu dropdown-menu level-'.$level;
            }
        }

        $html .= "\n<li class=\"$liClass\">";
        $html .= "\n  <a href=\"{$item['link']}\" class=\"$aClass\"$toggleAttr"
       . (isset($item['image1']) && $item['image1'] ? " data-image=\"{$item['image1']}\"" : "")
       . ">" . htmlspecialchars($item['name'], ENT_QUOTES, 'UTF-8') . "</a>";

        if ($hasChildren) {
            $html .= "\n  <ul class=\"$ulClass\" data-bs-auto-close=\"outside\">";
            $html .= navbar_fnc($item['children'], $active_id, $level + 1, false);
            $html .= "\n  </ul>";
        }

        $html .= "\n</li>";
    }

    return $html;
}

function has_active_child($items, $active_id) {
    foreach ($items as $item) {
        if (strtolower($active_id) == strtolower(slug_fnc($item['name'])) || has_active_child($item['children'] ?? [], $active_id)) {
            return true;
        }
    }
    return false;
}

}

if (!function_exists('get_first_level_fnc')) {
    function get_first_level_fnc(array $tree, int $parent_id, string $slug2url, string $type, string $base_url): array {
        if ($parent_id === 0) {
            $direct_children = array_map(function ($parent) use ($base_url, $type, $slug2url) {
                $parent_copy = $parent;
                unset($parent_copy['children']);

                if (
                    isset($parent_copy['link']) && $parent_copy['link'] === '#' &&
                    isset($parent_copy[$type . '_id'], $parent_copy['slug'], $parent_copy['title'])
                ) {
                    $parent_copy['link'] = $base_url . slug2url_fnc($slug2url, $parent_copy[$type . '_id'], $parent_copy['slug'], $parent_copy['title']);
                }

                return $parent_copy;
            }, $tree);

            usort($direct_children, function ($a, $b) {
                return ($a['sort_order'] ?? 0) <=> ($b['sort_order'] ?? 0);
            });

            return $direct_children;
        }

        foreach ($tree as $parent) {
            if (!isset($parent[$type . '_id'])) {
                continue;
            }

            if ((int)$parent[$type . '_id'] === $parent_id) {
                $children = $parent['children'] ?? [];

                $direct_children = array_map(function ($child) use ($base_url, $type, $slug2url) {
                    $child_copy = $child;
                    unset($child_copy['children']);

                    if (
                        isset($child_copy['link']) && $child_copy['link'] === '#' &&
                        isset($child_copy[$type . '_id'], $child_copy['slug'], $child_copy['title'])
                    ) {
                        $child_copy['link'] = $base_url . slug2url_fnc($slug2url, $child_copy[$type . '_id'], $child_copy['slug'], $child_copy['title']);
                    }

                    return $child_copy;
                }, $children);

                usort($direct_children, function ($a, $b) {
                    return ($a['sort_order'] ?? 0) <=> ($b['sort_order'] ?? 0);
                });

                return $direct_children;
            }

            if (!empty($parent['children']) && is_array($parent['children'])) {
                $result = get_first_level_fnc($parent['children'], $parent_id, $slug2url, $type, $base_url);
                if (!empty($result)) {
                    return $result;
                }
            }
        }

        return [];
    }
}




if (!function_exists('get_deep_levels_fnc')) {
    function get_deep_levels_fnc(array $tree, int $parent_id, string $type): array {
        foreach ($tree as $parent) {
            if (isset($parent[$type . '_id']) && (int)$parent[$type . '_id'] === $parent_id) {
                $children = $parent['children'] ?? [];

                usort($children, function ($a, $b) {
                    return ($a['sort_order'] ?? 0) <=> ($b['sort_order'] ?? 0);
                });

                return $children;
            }

            if (!empty($parent['children']) && is_array($parent['children'])) {
                $result = get_deep_levels_fnc($parent['children'], $parent_id, $type);
                if (!empty($result)) {
                    return $result;
                }
            }
        }

        return [];
    }
}



if (!function_exists('extract_by_key_fnc')) {
    function extract_by_key_fnc(array $tree, string $slug2url, string $type, string $column, string $base_url): array {
        $result = [];
        $seen_ids = [];

        foreach ($tree as $array) {
            if (!empty($array[$column]) && $array[$column] == 1) {
                $array_id = $array[$type . '_id'] ?? null;

                if (
                    $array_id !== null &&
                    !in_array($array_id, $seen_ids, true) &&
                    isset($array['slug'], $array['title'])
                ) {
                    $sel_filtered = $array;
                    unset($sel_filtered['children']);
                    $sel_filtered['link'] = $base_url . slug2url_fnc($slug2url, $array_id, $array['slug'], $array['title']);
                    $result[] = $sel_filtered;
                    $seen_ids[] = $array_id;
                }
            }

            if (!empty($array['children']) && is_array($array['children'])) {
                $child_results = extract_by_key_fnc($array['children'], $slug2url, $type, $column, $base_url);

                foreach ($child_results as $child_array) {
                    $child_id = $child_array[$type . '_id'] ?? null;

                    if ($child_id !== null && !in_array($child_id, $seen_ids, true)) {
                        $result[] = $child_array;
                        $seen_ids[] = $child_id;
                    }
                }
            }
        }

        usort($result, function ($a, $b) {
            return ($a['sort_order'] ?? 0) <=> ($b['sort_order'] ?? 0);
        });

        return $result;
    }
}


if (!function_exists('build_tree_fnc')) {
    function build_tree_fnc(array $tree, array $relations, string $slug2url, string $type, string $base_url): array {
        $index = [];
        foreach ($tree as $array) {
            $index[$array[$type . '_id']] = [
                $type . '_id' => $array[$type . '_id'],
                'title'       => $array['title'],
                'name'        => $array['name'],
                'spotlight'   => $array['spotlight'],
                'featured'    => $array['featured'],
                'top'         => $array['top'],
                'bottom'      => $array['bottom'],
                'slug'        => $array['slug'],
                'image1'      => $array['image1'],
                'image2'      => $array['image2'],
                'sort_order'  => $array['sort_order'],
                'link'        => $base_url . slug2url_fnc($slug2url, $array[$type . '_id'], $array['slug'], $array['name']),
            ];
        }

        $parent_map = [];
        foreach ($relations as $rel) {
            $parent_id = $rel['parent_id'];
            $child_id  = $rel['children_id'];
            if (isset($index[$parent_id], $index[$child_id])) {
                $parent_map[$parent_id][] = $child_id;
            }
        }

        $build_node = function($id) use (&$build_node, $index, $parent_map): array {
            $node = $index[$id];
            $node['children'] = [];

            if (!empty($parent_map[$id])) {
                $children = $parent_map[$id];
                usort($children, function($a, $b) use ($index) {
                    return ($index[$a]['sort_order'] ?? 0) <=> ($index[$b]['sort_order'] ?? 0);
                });

                foreach ($children as $child_id) {
                    $node['children'][] = $build_node($child_id);
                }

                $node['link'] = '#';
            }

            return $node;
        };

        $all_children = array_column($relations, 'children_id');
        $menu = [];

        $sorted_ids = array_keys($index);
        usort($sorted_ids, function($a, $b) use ($index) {
            return ($index[$a]['sort_order'] ?? 0) <=> ($index[$b]['sort_order'] ?? 0);
        });

        foreach ($sorted_ids as $id) {
            if (!in_array($id, $all_children)) {
                $menu[] = $build_node($id);
            }
        }

        return $menu;
    }
}





    if (!function_exists('parent_map_fnc')) {
    function parent_map_fnc()
    {

        $parent_map = [
        'items'       => ['table' => 'items',       'id' => 'item_id',      'name' => 'name'],
        'categories'       => ['table' => 'categories',       'id' => 'category_id',      'name' => 'name'],
        'blogs_categories'       => ['table' => 'blogs_categories',       'id' => 'blog_category_id',      'name' => 'name'],
        'sections'         => ['table' => 'sections',         'id' => 'section_id',       'name' => 'name'],
        'awards'           => ['table' => 'awards',           'id' => 'award_id',         'name' => 'name'],
        'natives'         => ['table' => 'natives',           'id' => 'native_id',       'name' => 'name'],
        'brands'           => ['table' => 'brands',           'id' => 'brand_id',         'name' => 'name'],
        'industries'       => ['table' => 'industries',       'id' => 'industry_id',      'name' => 'name'],
        'places'           => ['table' => 'places',           'id' => 'place_id',         'name' => 'name'],
        'regions'          => ['table' => 'regions',          'id' => 'region_id',        'name' => 'name'],
        'voices'           => ['table' => 'voices',           'id' => 'voice_id',         'name' => 'name'],
        'talents'          => ['table' => 'talents',          'id' => 'talent_id',        'name' => 'name'],
        'actors'           => ['table' => 'talents',          'id' => 'talent_id',        'name' => 'name', 'type_id' => 1],
        'actresses'        => ['table' => 'talents',          'id' => 'talent_id',        'name' => 'name', 'type_id' => 2],
        'directors'        => ['table' => 'talents',          'id' => 'talent_id',        'name' => 'name', 'type_id' => 3],
        'producers'        => ['table' => 'talents',          'id' => 'talent_id',        'name' => 'name', 'type_id' => 4],
        'writers'          => ['table' => 'talents',          'id' => 'talent_id',        'name' => 'name', 'type_id' => 5],
        'singers'          => ['table' => 'talents',          'id' => 'talent_id',        'name' => 'name', 'type_id' => 6],
        'designers'        => ['table' => 'talents',          'id' => 'talent_id',        'name' => 'name', 'type_id' => 7],
        'editors'          => ['table' => 'talents',          'id' => 'talent_id',        'name' => 'name', 'type_id' => 8],
        'cinematographers' => ['table' => 'talents',          'id' => 'talent_id',        'name' => 'name', 'type_id' => 9]
    ];

        return $parent_map;

    }

}


if (!function_exists('link_types_fnc')) {
    function link_types_fnc($input = '', $return = 'full')
    {
        $link_types = [
            1 => 'redirect',
            2 => 'embed',
            3 => 'iframe'
        ];

        if ($input === '') {
            switch ($return) {
                case 'full':
                    return $link_types;
                case 'key':
                    return array_keys($link_types);
                case 'value':
                    return array_values($link_types);
                default:
                    return [0 => 'unknown'];
            }
        }

        $input = strtolower(trim($input));

        if ($return === 'value' && is_numeric($input)) {
            return isset($link_types[(int)$input]) ? $link_types[(int)$input] : 'unknown';
        }

        if ($return === 'key') {
            $key = array_search($input, $link_types);
            return $key !== false ? $key : 0;
        }

        return [0 => 'unknown'];
    }
}


if (!function_exists('link_categories_fnc')) {
    function link_categories_fnc($input = '', $return = 'full')
    {
        $link_categories = [
            1 => 'trailer',
            2 => 'download',
            3 => 'stream'
        ];

        if ($input === '') {
            switch ($return) {
                case 'full':
                    return $link_categories;
                case 'key':
                    return array_keys($link_categories);
                case 'value':
                    return array_values($link_categories);
                default:
                    return [0 => 'unknown'];
            }
        }

        $input = strtolower(trim($input));

        if ($return === 'value' && is_numeric($input)) {
            return isset($link_categories[(int)$input]) ? $link_categories[(int)$input] : 'unknown';
        }

        if ($return === 'key') {
            $key = array_search($input, $link_categories);
            return $key !== false ? $key : 0;
        }

        return [0 => 'unknown'];
    }
}


if (!function_exists('quality_types_fnc')) {
    function quality_types_fnc($input = '', $return = 'full')
    {
        $quality_types = [
            1 => '240p',
            2 => '360p',
            3 => '480p',
            4 => '720p',
            5 => '1080p',
            6 => '4k'
        ];

        if ($input === '') {
            switch ($return) {
                case 'full':
                    return $quality_types;
                case 'key':
                    return array_keys($quality_types);
                case 'value':
                    return array_values($quality_types);
                default:
                    return [0 => 'unknown'];
            }
        }

        $input = strtolower(trim($input));

        if ($return === 'value' && is_numeric($input)) {
            return isset($quality_types[(int)$input]) ? $quality_types[(int)$input] : 'unknown';
        }

        if ($return === 'key') {
            $key = array_search($input, $quality_types);
            return $key !== false ? $key : 0;
        }

        return [0 => 'unknown'];
    }
}



if (!function_exists('relay_types_fnc')) {
    function relay_types_fnc($input = '', $return = 'full')
    {
        $relay_types = [
                        0 => ['name' => 'Unlimited', 'reset' => 0],
                        1 => ['name' => 'Second', 'reset' => 1],
                        2 => ['name' => 'Minutes', 'reset' => 60],
                        3 => ['name' => 'Hourly', 'reset' => 3600],
                        4 => ['name' => 'Daily', 'reset' => 86400],
                        5 => ['name' => 'Weekly', 'reset' => 604800],
                        6 => ['name' => 'Monthly', 'reset' => 2592000] 
                    ];


        if ($input === '') {
            switch ($return) {
                case 'full':
                    return $relay_types;
                case 'id_and_name':
                    return array_map(fn($data) => $data['name'], $relay_types);
                case 'id_and_reset':
                    return array_map(fn($data) => $data['reset'], $relay_types);
                default:
                    return [0 => 'unknown'];
            }
        }

        $input = is_string($input) ? strtolower(trim($input)) : $input;

        if ($return === 'name' && is_numeric($input)) {
            return $relay_types[(int)$input]['name'] ?? 'unknown';
        }

        if ($return === 'key') {
            foreach ($relay_types as $key => $data) {
                if (strtolower($data['name']) === $input) {
                    return $key;
                }
            }
            return 0;
        }

        if ($return === 'data') {
            if (is_numeric($input) && isset($relay_types[(int)$input])) {
                return $relay_types[(int)$input];
            }
            foreach ($relay_types as $data) {
                if (strtolower($data['name']) === $input) {
                    return $data;
                }
            }
            return ['name' => 'unknown', 'reset' => ''];
        }

        return ['name' => 'unknown', 'reset' => ''];
    }
}



if (!function_exists('part_types_fnc')) {
    function part_types_fnc($input = '', $return = 'full')
    {
        $part_types = [
            1 => 'part',
            2 => 'episode',
            3 => 'season',
            4 => 'episode part',
            5 => 'season part'
        ];

        if ($input === '') {
            switch ($return) {
                case 'full':
                    return $part_types;
                case 'key':
                    return array_keys($part_types);
                case 'value':
                    return array_values($part_types);
                default:
                    return [0 => 'unknown'];
            }
        }

        $input = strtolower(trim($input));

        if ($return === 'value' && is_numeric($input)) {
            return isset($part_types[(int)$input]) ? $part_types[(int)$input] : 'unknown';
        }

        if ($return === 'key') {
            $key = array_search($input, $part_types);
            return $key !== false ? $key : 0;
        }

        return [0 => 'unknown'];
    }
}



if (!function_exists('host_types_fnc')) {
    function host_types_fnc($input = '', $return = 'full')
    {
        $host_types = [
                        1 => ['name' => 'Facebook',      'url' => 'https://www.facebook.com',      'ratings' => 9.5],
                        2 => ['name' => 'Dailymotion',   'url' => 'https://www.dailymotion.com',   'ratings' => 8.9],
                        3 => ['name' => 'Vimeo',         'url' => 'https://www.vimeo.com',         'ratings' => 9.0],
                        4 => ['name' => 'YouTube',       'url' => 'https://www.youtube.com',       'ratings' => 9.8],
                        5 => ['name' => 'BiliBili',      'url' => 'https://www.bilibili.com',      'ratings' => 8.7],
                        6 => ['name' => 'Google Drive',  'url' => 'https://drive.google.com',      'ratings' => 9.2],
                        7 => ['name' => 'Mega',          'url' => 'https://mega.nz',               'ratings' => 9.1],
                        8 => ['name' => 'DoodStream',    'url' => 'https://doodstream.com',        'ratings' => 8.5],
                        9 => ['name' => 'TikTok',        'url' => 'https://www.tiktok.com',        'ratings' => 9.1],
                        10 => ['name' => 'CeleBiz',      'url' => 'https://www.celebiz.com',       'ratings' => 9.9],
                        11 => ['name' => 'up-4ever',     'url' => 'https://www.up-4ever.net',      'ratings' => 9.1],
                        12 => ['name' => 'UpFiles',      'url' => 'https://upfiles.com',           'ratings' => 9.1],
                        13 => ['name' => 'KatFile',      'url' => 'https://katfile.com',           'ratings' => 9.1],
                        14 => ['name' => 'Uploady',      'url' => 'https://uploady.io',            'ratings' => 9.1],
                        15 => ['name' => 'FileUpload',   'url' => 'https://www.file-upload.org',   'ratings' => 9.1],
                        16 => ['name' => 'UploadRAR',    'url' => 'https://uploadrar.com',         'ratings' => 9.1],
                        17 => ['name' => 'DLSurf',       'url' => 'https://dl.surf',               'ratings' => 9.1],
                        18 => ['name' => 'JioUpload',    'url' => 'https://jioupload.com',         'ratings' => 9.1],
                        19 => ['name' => 'DailyUploads', 'url' => 'https://dailyuploads.net',      'ratings' => 9.1],
                    ];


        if ($input === '') {
            switch ($return) {
                case 'full':
                    return $host_types;
                case 'id_and_name':
                    return array_map(fn($data) => $data['name'], $host_types);
                case 'id_and_url':
                    return array_map(fn($data) => $data['url'], $host_types);
                case 'id_and_ratings':
                    return array_map(fn($data) => $data['ratings'], $host_types);
                default:
                    return [0 => 'unknown'];
            }
        }

        $input = is_string($input) ? strtolower(trim($input)) : $input;

        if ($return === 'name' && is_numeric($input)) {
            return $host_types[(int)$input]['name'] ?? 'unknown';
        }

        if ($return === 'key') {
            foreach ($host_types as $key => $data) {
                if (strtolower($data['name']) === $input) {
                    return $key;
                }
            }
            return 0;
        }

        if ($return === 'data') {
            if (is_numeric($input) && isset($host_types[(int)$input])) {
                return $host_types[(int)$input];
            }
            foreach ($host_types as $data) {
                if (strtolower($data['name']) === $input) {
                    return $data;
                }
            }
            return ['name' => 'unknown', 'url' => '', 'ratings' => 0];
        }

        return ['name' => 'unknown', 'url' => '', 'ratings' => 0];
    }
}


if (!function_exists('talent_types_fnc')) {
    function talent_types_fnc($input = '', $return = 'full')
{
    $talent_types = [
        'actors'           => ['id' => 1, 'name' => 'actor'],
        'actresses'        => ['id' => 2, 'name' => 'actress'],
        'directors'        => ['id' => 3, 'name' => 'director'],
        'producers'        => ['id' => 4, 'name' => 'producer'],
        'writers'          => ['id' => 5, 'name' => 'writer'],
        'singers'          => ['id' => 6, 'name' => 'singer'],
        'designers'        => ['id' => 7, 'name' => 'designer'],
        'editors'          => ['id' => 8, 'name' => 'editor'],
        'cinematographers' => ['id' => 9, 'name' => 'cinematographer']
    ];

    if ($input === '') {
        switch ($return) {
            case 'full':
                return $talent_types;
            case 'id_as_key':
                $output = [];
                foreach ($talent_types as $data) {
                    $output[$data['id']] = $data['name'];
                }
                return $output;
            case 'id_and_name':
            case 'name_and_id':
                return array_values(array_map(function ($data) {
        return ['id' => $data['id'], 'name' => $data['name']];
    }, $talent_types));
            default:
                return ['id' => 0, 'name' => 'unknown'];
        }
    }

    $input = strtolower(trim($input));
    $result = null;

    if (is_numeric($input)) {
        foreach ($talent_types as $key => $data) {
            if ((int)$input === $data['id']) {
                $result = ['key' => $key, 'id' => $data['id'], 'name' => $data['name']];
                break;
            }
        }
    } else {
        if (isset($talent_types[$input])) {
            $result = ['key' => $input, 'id' => $talent_types[$input]['id'], 'name' => $talent_types[$input]['name']];
        } else {
            foreach ($talent_types as $key => $data) {
                if ($data['name'] === $input) {
                    $result = ['key' => $key, 'id' => $data['id'], 'name' => $data['name']];
                    break;
                }
            }
        }
    }

    if (!$result) {
        return $return === 'id' ? 0 : ($return === 'name' ? 'unknown' : ['id' => 0, 'name' => 'unknown']);
    }

    switch ($return) {
        case 'id':
            return $result['id'];
        case 'name':
            return $result['name'];
        case 'key':
            return $result['key'];
        case 'key_and_id':
            return ['key' => $result['key'], 'id' => $result['id']];
        case 'id_and_name':
        case 'name_and_id':
            return ['id' => $result['id'], 'name' => $result['name']];
        default:
            return $result;
    }
}

}


if ( ! function_exists('paragraph2keywords_fnc'))
            {
            
                function paragraph2keywords_fnc($text) {
                
                $text = trim($text);
                if (empty($text)) {
                    return '';
                }

                $text = strip_tags($text);
                $text = strtolower(preg_replace('/[^a-zA-Z0-9\s]/', '', $text));
                $text = trim($text);
                if (empty($text)) {
                    return '';
                }
                $words = explode(' ', $text);
                $stopWords = ['the', 'is', 'and', 'or', 'of', 'to', 'in', 'on', 'for', 'with', 'at', 'by', 'a', 'it', 'my', 'has', 'have', 'this', 'that', 'was', 'were', 'be', 'been', 'am', 'are', 'an', 'as', 'if', 'but', 'so', 'do', 'does', 'did', 'not', 'no', 'yes', 'you', 'your', 'we', 'our', 'us', 'he', 'she', 'they', 'them', 'his', 'her', 'its', 'which', 'what', 'who', 'whom', 'where', 'when', 'why', 'how', 'about', 'above', 'across', 'after', 'again', 'against', 'all', 'almost', 'alone', 'along', 'already', 'also', 'although', 'always', 'among', 'amongst', 'another', 'any', 'anyhow', 'anyone', 'anything', 'anyway', 'anywhere', 'around', 'back', 'because', 'become', 'before', 'behind', 'being', 'below', 'beside', 'besides', 'between', 'beyond', 'both', 'bottom', 'call', 'can', 'cannot', 'cant', 'could', 'couldnt', 'cry', 'de', 'describe', 'detail', 'done', 'down', 'due', 'during', 'each', 'eg', 'eight', 'either', 'eleven', 'else', 'elsewhere', 'empty', 'enough', 'etc', 'even', 'ever', 'every', 'everyone', 'everything', 'everywhere', 'except', 'few', 'first', 'five', 'former', 'formerly', 'four', 'from', 'front', 'full', 'further', 'get', 'give', 'go', 'had', 'hasnt', 'hence', 'here', 'hereafter', 'hereby', 'herein', 'hereupon', 'hers', 'herself', 'him', 'himself', 'however', 'hundred', 'ie', 'inc', 'indeed', 'interest', 'into', 'keep', 'last', 'latter', 'latterly', 'least', 'less', 'ltd', 'made', 'many', 'may', 'me', 'meanwhile', 'might', 'mine', 'more', 'moreover', 'most', 'mostly', 'move', 'much', 'must', 'myself', 'name', 'namely', 'neither', 'never', 'nevertheless', 'next', 'nine', 'nobody', 'none', 'noone', 'nor', 'nothing', 'now', 'nowhere', 'off', 'often', 'once', 'one', 'only', 'onto', 'other', 'others', 'otherwise', 'ours', 'ourselves', 'out', 'over', 'own', 'part', 'perhaps', 'please', 'put', 'rather', 're', 'same', 'see', 'seem', 'seemed', 'seeming', 'seems', 'serious', 'several', 'should', 'show', 'side', 'since', 'sincere', 'six', 'some', 'somehow', 'someone', 'something', 'sometime', 'sometimes', 'somewhere', 'still', 'such', 'system', 'take', 'ten', 'than', 'their', 'themselves', 'then', 'there', 'thereafter', 'thereby', 'therefore', 'therein', 'thereupon', 'these', 'third', 'those', 'though', 'three', 'through', 'throughout', 'thus', 'together', 'too', 'top', 'toward', 'towards', 'twelve', 'twenty', 'two', 'under', 'until', 'up', 'upon', 'very', 'via', 'well', 'whatever', 'whence', 'whenever', 'whereafter', 'whereas', 'whereby', 'wherein', 'whereupon', 'wherever', 'whether', 'while', 'whither', 'whoever', 'whole', 'whose', 'will', 'within', 'without', 'would', 'yet', 'yours', 'yourself', 'yourselves'];
                $filteredWords = array_diff($words, $stopWords);
                $text = trim($text);
                if (empty($text)) {
                    return '';
                }
                $keywords = implode(', ', array_slice(array_unique($filteredWords), 0, 15));

                return $keywords;
            }

    }


if ( ! function_exists('display_image_fnc'))
            {
           function display_image_fnc($image_info, $image_name, $cropping = 'normal', $cache = true, $original = false) {

                $allowed_modes = ['normal', 'auto', 'fix'];
                    if (!in_array($cropping, $allowed_modes)) {
                        return 'public/images/notfound.webp';
                    }
                
                if (!is_string($image_name) || empty($image_name)) return 'public/images/notfound.webp';

                $old_image_extension = pathinfo($image_name, PATHINFO_EXTENSION);
                 if (empty($old_image_extension)) return 'public/images/notfound.webp';

                 $image_filename = pathinfo($image_name, PATHINFO_FILENAME);
                 if (empty($image_filename)) return 'public/images/notfound.webp';

                 $original_image_path = 'public/uploads/'.$image_filename.'.'.$old_image_extension;

                 if(!is_file(FCPATH.$original_image_path)) return 'public/images/notfound.webp';

                $info_parts = explode("-", $image_info);
                if (count($info_parts) !== 2) return 'public/images/notfound.webp'; 

                $new_image_extension = $info_parts[0];
                $new_sizes = explode("x", $info_parts[1]);
                if (count($new_sizes) !== 2) return 'public/images/notfound.webp';

                $new_width = $new_sizes[0]; 
                $new_height = $new_sizes[1];
    
                $final_image_path = $old_image_extension.'-'.$new_width.'x'.$new_height.'/'.$cropping.'/'.$image_filename.'.'.$new_image_extension;

                if ($cache === true || strtolower((string)$cache) === 'true') {
                    $final_image_path = 'cache/images/'.$final_image_path;
                } else {
                    $final_image_path = $original_image_path;
                }

                if ($original !== false && strtolower((string)$original) !== 'false') {
                    if ($original !== true && strtolower((string)$original) !== 'true') {
                    $final_image_path .= '?'.$original;
                    }
                }

                return $final_image_path;
            }
    }


if ( ! function_exists('slug2url_fnc'))
            {
            function slug2url_fnc($type, $id, $slug, $name = 'slug not found'){
            
            $url = '';

            if ($type == 'items_details')
                {
                    $id_type = 'id';
                }
                else
                if ($type == 'pages_details')
                {
                    $id_type = 'pd';
                }
                else
                if ($type == 'items_by_categories')
                {
                    $id_type = 'ibc';
                }
                 else
                if ($type == 'items_by_brands')
                {
                    $id_type = 'ibb';
                }
                 else
                if ($type == 'items_by_industries')
                {
                    $id_type = 'ibi';
                }
                 else
                if ($type == 'items_by_voices')
                {
                    $id_type = 'ibv';
                }
                 else
                if ($type == 'items_by_places')
                {
                    $id_type = 'ibp';
                }
                 else
                if ($type == 'items_by_sections')
                {
                    $id_type = 'ibs';
                }
                 else
                if ($type == 'items_by_regions')
                {
                    $id_type = 'ibr';
                }
                else
                if ($type == 'items_by_talents')
                {
                    $id_type = 'ibt';
                }
                else
                if ($type == 'items_by_years')
                {
                    $id_type = 'iby';
                }
                else
                    if ($type == 'blogs_posts_details')
                {
                    $id_type = 'bpd';
                }
                else
               if ($type == 'blogs_posts_by_categories')
                {
                    $id_type = 'bpbc';
                }
                else
                if ($type == 'blogs_posts_by_date')
                {
                    $id_type = 'bpbd';
                }
                else
                {
                    $id_type = '';
                }                     
            
                if (!empty($id_type)) {

                if (empty($slug)) {
                    $slug = slug_fnc($name);
                }

               $url =   $id_type.$id.'/'.$slug.'.html';              
            }

            return $url;

            }

    }

    if ( ! function_exists('data2json_fnc'))
            {
            function data2json_fnc($text){
           
            if (!empty($text)) {
                $text = str_replace("\r\n"," ",$text);
                $text = str_replace("\n"," ",$text);
                $text = str_replace("'","&#039;",$text);
                $text = str_replace('"',"&quot;",$text);
            }
            return $text;

            }

    }

if ( ! function_exists('data2js_fnc'))
            {
            function data2js_fnc($text){
           
            if (!empty($text)) {
                $text = str_replace("\r\n"," ",$text);
                $text = str_replace("\n"," ",$text);
                $text = addslashes($text); 
               $text = htmlspecialchars($text);               
            }
            return $text;

            }

    }

if ( ! function_exists('html2text_fnc'))
            {
            function html2text_fnc($text){
           
            if (!empty($text)) {
                $text = str_replace("'","&#039;",$text);
                $text = str_replace("&","&amp;",$text);
                $text = str_replace('"',"&quot;",$text);                
                $text = str_replace("<","&lt;",$text);
                $text = str_replace(">","&gt;",$text);
            }
            return $text;

            }

    }

    if ( ! function_exists('text2html_fnc'))
            {
            function text2html_fnc($text){
           
            if (!empty($text)) {
                $text = str_replace(" ","&nbsp;",$text);
                $text = str_replace("\r\n","<br/>",$text);
                $text = str_replace("\n","<br/>",$text);
            }
            return $text;
            
            }

    }

if ( ! function_exists('slug_fnc'))
            {
            function slug_fnc($title){
            $title = preg_replace('~[^\pL\d]+~u', '-', $title);
            $title = iconv('utf-8', 'us-ascii//TRANSLIT', $title);
            $title = preg_replace('~[^-\w]+~', '', $title);
            $title = trim($title, '-');
            $title = preg_replace('~-+~', '-', $title);
            $title = strtolower($title);
            if (empty($title)) {
                $title = 'n-a';
            }
            return $title;
            }

    }

if ( ! function_exists('datetime_to_unixtimestamp_fnc'))
            {
        function datetime_to_unixtimestamp_fnc($date) {
            $yr=strval(substr($date,0,4));
            $mo=strval(substr($date,5,2));
            $da=strval(substr($date,8,2));
            $hr=strval(substr($date,11,2));
            $mi=strval(substr($date,14,2));
            $se=strval(substr($date,17,2));
            return mktime($hr,$mi,$se,$mo,$da,$yr);
        }
 }

 if ( ! function_exists('pagination_fnc'))
            {
        function pagination_fnc($results, $total_records, $limit, $current_page, $url) {
            $return = false;
           if($total_records > 0){
           $total_pages = ceil($total_records / $limit);
           if($current_page > $total_pages || $current_page < 1){
            return $return;
           }
           if (strpos($url, '?') === false) {
                $url .= '?';
            }

           $start = ($current_page-1)*$limit;
           $end = $start + $limit;
           $end = ($end > $total_records)?$total_records:$end;
           $previous = '<li class="page-item disabled">
                <a class="page-link">Previous</a>
              </li>';
           if($current_page > 1){
            $previous = '<li class="page-item">
                <a class="page-link" href="'.$url.'&page='. ($current_page-1) .'">Previous</a>
              </li>';
           }
           $next = ' <li class="page-item disabled">
                <a class="page-link" href="#">Next</a>
              </li>';
              if($current_page < $total_pages){
                $next = '<li class="page-item">
                    <a class="page-link" href="'.$url.'&page='. ($current_page+1) .'">Next</a>
                  </li>';
               }

               $pager = '';

               for ($i = 1; $i <= $total_pages; $i++) {
                $i_url = $url.'&page='.$i;
                $pager .= '<li class="page-item '.(($i == $current_page)?'active" aria-current="page':'').'"><a class="page-link" href="'.$i_url.'">'.$i.'</a></li>';
               }

           $pager = '<nav aria-label="pagination">
            <ul class="pagination">
             '.$previous.$pager.$next.'
            </ul>
          </nav>';
           $return = [
            'result' => $results,
            'total_records' => $total_records,
            'start' => $start+1,
            'end' => $end,
            'pager' => $pager,
            'current_page' => $current_page,
            'total_pages' => $total_pages,
           ];
        }
            return $return;
        }
     }

        if ( ! function_exists('time_difference_fnc'))
            {

                function time_difference_fnc($old_time, $new_time = '', $full_time = false) {

                 if (empty($new_time)) {
                            $new_time = time();
                        }

                    $newDateTime = new DateTime(date("Y-m-d H:i:s", $new_time));
                        $oldDateTime = new DateTime(date("Y-m-d H:i:s", $old_time));

                        $diff = $newDateTime->diff($oldDateTime);
                        $isFuture = $new_time < $old_time;

                        $totalSeconds = abs($new_time - $old_time);

                        if ($totalSeconds < 5) {
                            return $isFuture ? 'right now' : 'just now';
                        } elseif ($totalSeconds < 30) {
                            return $isFuture ? 'in a moment' : 'a moment ago';
                        }

                        $units = [
                            'y' => 'year',
                            'm' => 'month',
                            'd' => 'day',
                            'h' => 'hour',
                            'i' => 'minute',
                            's' => 'second',
                        ];

                        $parts = [];
                        foreach ($units as $key => $label) {
                            if ($diff->$key) {
                                $parts[] = $diff->$key . ' ' . $label . ($diff->$key > 1 ? 's' : '');
                            }
                        }

                        if (!$full_time) {
                            $parts = array_slice($parts, 0, 1);
                        }

                        $formatted = implode(', ', $parts);
                        return $isFuture ? "in $formatted" : "$formatted ago";
                    }


            }



        if (!function_exists('time_short_fnc')) {

    function time_short_fnc($old_time, $new_time = null, $format = "M j") {
        $new_time ??= time();
        $diff_seconds = $new_time - $old_time;
        $abs_seconds  = abs($diff_seconds);
        $isFuture     = $diff_seconds < 0;

        if ($abs_seconds > 2419200) {
            return date($format, $old_time); 
        }

        if ($abs_seconds < 5) {
            return $isFuture ? 'right now' : 'just now';
        }
        if ($abs_seconds < 30) {
            return $isFuture ? 'in a moment' : 'a moment ago';
        }

        $units = [
            604800   => 'week',
            86400    => 'day',
            3600     => 'hour',
            60       => 'minute',
            1        => 'second'
        ];

        foreach ($units as $seconds => $label) {
            if ($abs_seconds >= $seconds) {
                $count = (int)($abs_seconds / $seconds);
                $formatted = $count . ' ' . $label . ($count > 1 ? 's' : '');
                return $isFuture ? "in $formatted" : "$formatted ago";
            }
        }

    return 'unknown';

    }
}

            if ( ! function_exists('time_duration_fnc'))
            {

            function time_duration_fnc($startTimestamp, $endTimestamp) {
                    $start = (int)$startTimestamp;
                    $end   = (int)$endTimestamp;

                    if ($end < $start) {
                        return 'unknown';
                    }

                    $diff = $end - $start;

                    $hours   = floor($diff / 3600);
                    $minutes = floor(($diff % 3600) / 60);
                    $seconds = $diff % 60;

                    return sprintf('%d:%02d:%02d', $hours, $minutes, $seconds);
                }

            }


            if (!function_exists('get_browser_fnc')) {

            function get_browser_fnc($userAgent) {
                $userAgent = strtolower($userAgent);

                if (strpos($userAgent, 'facebookexternalhit') !== false || strpos($userAgent, 'meta-externalads') !== false) return 'facebook';
                if (strpos($userAgent, 'googlebot') !== false) return 'google';
                if (strpos($userAgent, 'bingbot') !== false) return 'microsoft';
                if (strpos($userAgent, 'slurp') !== false) return 'yahoo';
                if (strpos($userAgent, 'duckduckbot') !== false) return 'duckduck';
                if (strpos($userAgent, 'baiduspider') !== false) return 'baidu';
                if (strpos($userAgent, 'yandexbot') !== false) return 'yandex';
                if (strpos($userAgent, 'sogou') !== false) return 'sogou';
                if (strpos($userAgent, 'exabot') !== false) return 'exa';
                if (strpos($userAgent, 'facebot') !== false) return 'facebook';
                if (strpos($userAgent, 'ia_archiver') !== false) return 'alexa';
                if (strpos($userAgent, 'mj12bot') !== false) return 'majestic';
                if (strpos($userAgent, 'semrushbot') !== false) return 'semrush';
                if (strpos($userAgent, 'ahrefsbot') !== false) return 'ahrefs';
                if (strpos($userAgent, 'dotbot') !== false) return 'moz';

                if (strpos($userAgent, 'firefox') !== false) return 'firefox';
                if (strpos($userAgent, 'chrome') !== false && strpos($userAgent, 'edg') === false) return 'chrome';
                if (strpos($userAgent, 'safari') !== false && strpos($userAgent, 'chrome') === false) return 'safari';
                if (strpos($userAgent, 'edg') !== false || strpos($userAgent, 'edge') !== false) return 'edge';
                if (strpos($userAgent, 'opera') !== false || strpos($userAgent, 'opr') !== false) return 'opera';
                if (strpos($userAgent, 'brave') !== false) return 'brave';
                if (strpos($userAgent, 'vivaldi') !== false) return 'vivaldi';
                if (strpos($userAgent, 'yandex') !== false) return 'yandex';
                if (strpos($userAgent, 'ucbrowser') !== false) return 'uc-browser';
                if (strpos($userAgent, 'qqbrowser') !== false) return 'qq';
                if (strpos($userAgent, 'samsungbrowser') !== false) return 'samsung';
                if (strpos($userAgent, 'maxthon') !== false) return 'maxthon';
                if (strpos($userAgent, 'netscape') !== false) return 'netscape';
                if (strpos($userAgent, 'konqueror') !== false) return 'konqueror';
                if (strpos($userAgent, 'seamonkey') !== false) return 'seamonkey';
                if (strpos($userAgent, 'palemoon') !== false) return 'palemoon';
                if (strpos($userAgent, 'midori') !== false) return 'midori';
                if (strpos($userAgent, 'tor') !== false) return 'tor';

                return 'font-awesome';
            }

        }



        if (!function_exists('get_os_fnc')) {

    function get_os_fnc($userAgent) {
        $userAgent = strtolower($userAgent);

    if (strpos($userAgent, 'facebookexternalhit') !== false || strpos($userAgent, 'meta-externalads') !== false) return 'bots';
    if (strpos($userAgent, 'googlebot') !== false) return 'bots';
    if (strpos($userAgent, 'bingbot') !== false) return 'bots';
    if (strpos($userAgent, 'slurp') !== false) return 'bots';
    if (strpos($userAgent, 'duckduckbot') !== false) return 'bots';
    if (strpos($userAgent, 'baiduspider') !== false) return 'bots';
    if (strpos($userAgent, 'yandexbot') !== false) return 'bots';
    if (strpos($userAgent, 'sogou') !== false) return 'bots';
    if (strpos($userAgent, 'exabot') !== false) return 'bots';
    if (strpos($userAgent, 'facebot') !== false) return 'bots';
    if (strpos($userAgent, 'ia_archiver') !== false) return 'bots';
    if (strpos($userAgent, 'mj12bot') !== false) return 'bots';
    if (strpos($userAgent, 'semrushbot') !== false) return 'bots';
    if (strpos($userAgent, 'ahrefsbot') !== false) return 'bots';
    if (strpos($userAgent, 'dotbot') !== false) return 'bots';

    if (strpos($userAgent, 'windows') !== false) return 'windows';
    if (strpos($userAgent, 'macintosh') !== false || strpos($userAgent, 'mac os') !== false) return 'apple';
    if (strpos($userAgent, 'iphone') !== false || strpos($userAgent, 'ios') !== false) return 'apple';
    if (strpos($userAgent, 'ipad') !== false) return 'apple';
    if (strpos($userAgent, 'android') !== false) return 'android';
    if (strpos($userAgent, 'linux') !== false && strpos($userAgent, 'android') === false) return 'linux';
    if (strpos($userAgent, 'ubuntu') !== false) return 'ubuntu';
    if (strpos($userAgent, 'debian') !== false) return 'debian';
    if (strpos($userAgent, 'fedora') !== false) return 'fedora';
    if (strpos($userAgent, 'centos') !== false) return 'centos';
    if (strpos($userAgent, 'red hat') !== false || strpos($userAgent, 'rhel') !== false) return 'redhat';
    if (strpos($userAgent, 'chrome os') !== false) return 'chromeos';
    if (strpos($userAgent, 'freebsd') !== false) return 'freebsd';
    if (strpos($userAgent, 'openbsd') !== false) return 'openbsd';
    if (strpos($userAgent, 'netbsd') !== false) return 'netbsd';
    if (strpos($userAgent, 'unix') !== false) return 'unix';

        return 'font-awesome';
    }

}


    if ( ! function_exists('location_distance_fnc'))
    {

        function location_distance_fnc($lat1, $lon1, $lat2, $lon2) {
            if (($lat1 == $lat2) && ($lon1 == $lon2)) {
            return 'Same boat';
            }
            else {
            $theta = $lon1 - $lon2;
            $dist = sin(deg2rad($lat1)) * sin(deg2rad($lat2)) +  cos(deg2rad($lat1)) * cos(deg2rad($lat2)) * cos(deg2rad($theta));
            $dist = acos($dist);
            $dist = rad2deg($dist);
            $miles = $dist * 60 * 1.1515;
            $km = ($miles * 1.609344);

            if($km <= 0.5){
                return 'Beside you';
            }elseif($km <= 2.5){
                return 'Close to you';
            }elseif($km <= 5){
                return 'Near to you';
            }else{
                return round($miles,2).' Miles ('.round($km,2).' KM)';
            }

            }
        }

    }


     if ( ! function_exists('is_valid_email'))
    {

    function is_valid_email(string $email, bool $checkDomain = false): bool
{

    if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
        return false;
    }

    if ($checkDomain) {
        $domain = substr(strrchr($email, "@"), 1);
        if (!checkdnsrr($domain, "MX")) {
            return false;
        }
    }

    return true;
}

    }

    if (!function_exists('gender_dp_fnc')) {
   
    function gender_dp_fnc(string $gender): string
    {
        $gender = strtolower(trim($gender));

        $map = [
            'male'          => 'male.jpg',
            'female'        => 'female.jpg',
            'room'          => 'room.jpg',
            'not specified' => 'any.jpg',
        ];

        return $map[$gender] ?? 'any.jpg';
    }

}


    if ( ! function_exists('price_fnc'))
{
    function price_fnc($price_fnc) {

        $response = false;

        if (preg_match('/^[0-9]\d*(\.\d{1,3})?$/', $price_fnc)) {
            $response = true;
        }

        return $response;

    }

}

if ( ! function_exists('timezone_offset_fnc'))
{
    function timezone_offset_fnc($timezone) {

        $timezone = str_replace(' ', '', $timezone);

        if($timezone != 'GMT'){

        $sign = substr($timezone, 0, 1);

        $is_numeric = substr($timezone, 0, 2);       

        if($sign != '+' && $sign != '-' && is_numeric($is_numeric)){

          $timezone = "+$timezone";

        }

        }

        if(strlen($timezone) < 1){
            $timezone = 'GMT';
        }

        $tz_tmp = new DateTimeZone($timezone);
        $dt_tmp = new DateTime('now', $tz_tmp);
        $offset = $dt_tmp->getOffset();

        return $offset;

    }

}

if ( ! function_exists('convert_time_local_fnc'))
{
        function convert_time_local_fnc($datetime = '573091200', $origin_timezone = 'GMT', $destination_timezone = 'GMT') {

            $originOffset = timezone_offset_fnc($origin_timezone);
            $destinationOffset = timezone_offset_fnc($destination_timezone);
            $gmtTime = $datetime - $originOffset;
            $convertedTime = $gmtTime + $destinationOffset;	

            return $convertedTime;

        }
}

if ( ! function_exists('time_gmt_fnc'))
{

    function time_gmt_fnc($from, $to, $value){
        

        $return = gmdate($value);

        

          return $return;

    }

}

if ( ! function_exists('api_type_fnc'))
{

    function api_type_fnc($value){

        $return = '';

        if($value == 'currency'){
            $return = 'Currency';    
          }elseif($value == 'ip_address'){    
            $return = 'IP Address';    
          }else{    
            $return = false;
        }

          return $return;

    }

}


        if (! function_exists('filter_query_fnc')) {

                    function filter_query_fnc($data, $remove) {
                    if (is_array($data)) {
                        foreach ($remove as $key) {
                            if (array_key_exists($key, $data)) {
                                unset($data[$key]);
                            }
                        }
                        return $data;
                    } else {
                        $query = $data;                         
                        foreach ($remove as $key) {
                            $query = preg_replace('/\b' . preg_quote($key, '/') . '\s*(=|>=|<=|<|>)\s*[^ANDOR]+(\s*(AND|OR))?/i', '', $query);
                        }
                        $query = preg_replace('/\s*(AND|OR)\s*$/i', '', trim($query));
                        $query = preg_replace('/\s{2,}/', ' ', $query);

                        return $query;
                    }
                }
                
        }

    

    if (! function_exists('is_serialized_fnc')) {

    function is_serialized_fnc( $data, $strict = true ) {
        // If it isn't a string, it isn't serialized.
        return true;
        if ( ! is_string( $data ) ) {
            return false;
        }
        $data = trim( $data );
        if ( 'N;' === $data ) {
            return true;
        }
        if ( strlen( $data ) < 4 ) {
            return false;
        }
        if ( ':' !== $data[1] ) {
            return false;
        }
        if ( $strict ) {
            $lastc = substr( $data, -1 );
            if ( ';' !== $lastc && '}' !== $lastc ) {
                return false;
            }
        } else {
            $semicolon = strpos( $data, ';' );
            $brace     = strpos( $data, '}' );
            // Either ; or } must exist.
            if ( false === $semicolon && false === $brace ) {
                return false;
            }
            // But neither must be in the first X characters.
            if ( false !== $semicolon && $semicolon < 3 ) {
                return false;
            }
            if ( false !== $brace && $brace < 4 ) {
                return false;
            }
        }
        $token = $data[0];
        switch ( $token ) {
            case 's':
                if ( $strict ) {
                    if ( '"' !== substr( $data, -2, 1 ) ) {
                        return false;
                    }
                } elseif ( false === strpos( $data, '"' ) ) {
                    return false;
                }
                // Or else fall through.
            case 'a':
            case 'O':
                return (bool) preg_match( "/^{$token}:[0-9]+:/s", $data );
            case 'b':
            case 'i':
            case 'd':
                $end = $strict ? '$' : '';
                return (bool) preg_match( "/^{$token}:[0-9.E+-]+;$end/", $data );
        }
        return false;
    }

}

    

if (! function_exists('recaptcha_verify_fnc')) {

function recaptcha_verify_fnc($response = '')
{

    $var_secret_key ='6LeG9rQpAAAAAAL9FyPjv1ZOEX2nTa1Dtird_3CP';
       
    $var_credential = array(
          'secret' => $var_secret_key,
          'response' => $response
      );

    $var_verify = curl_init();
    curl_setopt($var_verify, CURLOPT_URL, "https://www.google.com/recaptcha/api/siteverify");
    curl_setopt($var_verify, CURLOPT_POST, true);
    curl_setopt($var_verify, CURLOPT_POSTFIELDS, http_build_query($var_credential));
    curl_setopt($var_verify, CURLOPT_SSL_VERIFYPEER, false);
    curl_setopt($var_verify, CURLOPT_RETURNTRANSFER, true);
    $var_response = curl_exec($var_verify);

    $var_status = json_decode($var_response, true);

    return $var_status['success'];
    
}

}




if (! function_exists('parser_content_fnc')) {

    function parser_content_fnc($pseudo = array(), $content = '')
    {
    
        $loader = new \Twig\Loader\ArrayLoader([
            'index' => $content,
          ]);
          $twig = new \Twig\Environment($loader, ['debug' => true, 'cache' => false, 'strict_variables' => false]);
          
          return $twig->render('index', $pseudo);
        
    }

}

if ( ! function_exists('logs_fnc'))
{

    function logs_fnc($data)
{
    $logFilePath = FCPATH . 'logs.txt';

    if (!is_writable(dirname($logFilePath))) {
        return false;
    }

    if (is_array($data) || is_object($data)) {
        $data = json_encode($data, JSON_PRETTY_PRINT | JSON_UNESCAPED_UNICODE);
    } elseif (!is_string($data)) {
        $data = var_export($data, true);
    }

    $logEntry = date("Y-m-d H:i:s") . ': ' . $data . PHP_EOL;
    file_put_contents($logFilePath, $logEntry, FILE_APPEND | LOCK_EX);

    return true;
}

}

if ( ! function_exists('json_curl_fnc'))
{

    function json_curl_fnc($url, $params = [], $multipart = false){

        $client = \Config\Services::curlrequest();

      $return_data['code'] = 0;

      if($multipart){

        $params['data'] = new \CURLFile($multipart);

        $options = [
            'multipart' => $params
          ];

      }else{
      $options = [
        'form_params' => $params
      ];
    }

      $response = $client->request('POST', $url, $options);

    if ($response->getStatusCode() == 200) {
        $return_data['code'] = $response->getStatusCode();
        $return_data['body'] = $response->getBody();
        $return_data['header'] = $response->header('content-type')->getValue();
    }

    return $return_data;

    }

}

if ( ! function_exists('clean_phone_fnc'))
{

function clean_phone_fnc($number) {

    $cleaned = preg_replace('/\D+/', '', trim($number));

    $cleaned = ltrim($cleaned, '0'); 
    
    if (empty($cleaned)) {
        return null; 
    }

    return $cleaned;

}

}


if ( ! function_exists('text2list_fnc'))
{

function text2list_fnc($input) {
    $input = str_replace(["\r\n", "\r"], "\n", trim($input));

    $lines = explode("\n", $input);

    $unique_lines = [];

    foreach ($lines as $line) {
        $clean = trim($line);

        if (!empty($clean) && !in_array($clean, $unique_lines, true)) {
            $unique_lines[] = $clean;
        }
    }

    if (empty($unique_lines)) {
        return null;
    }

    $output = "<ul>\n";
    foreach ($unique_lines as $item) {
        $safe_item = htmlspecialchars($item, ENT_QUOTES, 'UTF-8');
        $output .= "  <li>{$safe_item}</li>\n";
    }
    $output .= "</ul>";

    return $output;
}

}

if ( ! function_exists('number_abbreviation_fnc'))
{

function number_abbreviation_fnc($number) {
    if (abs($number) < 1000) {
            return (string)$number;
        }
        static $units = [
            1000           => 'k',
            1000000        => 'M',
            1000000000     => 'B',
            1000000000000  => 'T'
        ];

        $sign = $number < 0 ? '-' : '';
        $number = abs($number);

        foreach ($units as $value => $suffix) {
            if ($number < $value * 1000) {
                $raw = $number / $value;
                $formatted = round($raw, $precision);
                $formatted = rtrim(rtrim((string)$formatted, '0'), '.');
                return $sign . $formatted . $suffix;
            }
        }

        return $sign . (string)$number;
}

}

if ( ! function_exists('get_token_fnc'))
{

    function get_token_fnc($length = 32, $type = '') {
    $token = "";
    $characters = '';

    switch (strtolower($type)) {
        case 'numbers':
            $characters = "0123456789";
            break;
        case 'capital_alphabetic':
            $characters = "ABCDEFGHJKLMNPQRSTUVWXYZ";
            break;
        case 'small_alphabetic':
            $characters = "abcdefghijkmnpqrstuvwxyz";
            break;
        case 'numbers_capital_alphabetic':
            $characters = "ABCDEFGHJKLMNPQRSTUVWXYZ0123456789";
            break;
        case 'numbers_small_alphabetic':
            $characters = "abcdefghijkmnpqrstuvwxyz0123456789";
            break;
        case 'all':
        default:
            $characters = "ABCDEFGHJKLMNPQRSTUVWXYZabcdefghijkmnpqrstuvwxyz0123456789";
            break;
    }

    $max = strlen($characters) - 1;

    if ($max < 0) {
        return '';
    }

    for ($i = 0; $i < $length; $i++) {
        $token .= $characters[rand(0, $max)];
    }

    return $token;
}

}


if ( ! function_exists('captcha_generator_fnc'))
{

    function captcha_generator_fnc($text){

        ob_clean();

        header('content-type: image/jpeg');
            $image_height=60;
            $image_width=225;
            $image = imagecreate($image_width, $image_height);
            imagecolorallocate($image, 255 ,255, 255);
            $shadow = imagecolorallocate($image, 0, 0, 0);
            for ($i=1; $i<=strlen($text);$i++){
                $font_size=rand(30,40);
                $r=rand(0,255);
                $g=rand(0,255);
                $b= 0;
                $index=rand(1,10);
                $x=15+(75*($i-1));
                $x=rand($x-5,$x+5);
                $y=rand(35,45);
                $o=rand(-25,5);
                $font_color = imagecolorallocate($image, $r ,$g, $b);
                imagettftext($image, $font_size, $o, $x+3, $y+3, $shadow, FCPATH.'public/fonts/captcha/'.$index.'.ttf', $text[$i-1]);
                imagettftext($image, $font_size, $o, $x+2, $y+2, $font_color, FCPATH.'public/fonts/captcha/'.$index.'.ttf', $text[$i-1]);
            }
            for($i=1; $i<=100;$i++){
                $x1= rand(1,225);
                $y1= rand(1,225);
                $x2= rand(1,225);
                $y2= rand(1,225);
                $r=rand(0,255);
                $g=rand(0,255);
                $b=200;
                $font_color = imagecolorallocate($image, $r ,$g, $b);
                imageline($image,$x1,$y1,$x2,$y2,$font_color);
            }
            imagejpeg($image);     
            
        return $text;

    }

}


if ( ! function_exists('redirect_fnc'))
{

    function redirect_fnc($url=32, $code = 301){

        header('Location: ' . $url, true, $code);
        exit;
    }

}

if ( ! function_exists('url_encode_fnc'))
{

    function url_encode_fnc($url){

       return urlencode($url);

    }

}

if ( ! function_exists('url_decode_fnc'))
{

    function url_decode_fnc($url){

       return urldecode($url);

    }

}

if ( ! function_exists('get_default_value_fnc'))
{

    function get_default_value_fnc($value, $array){

        $results = '';

       $get_array_key = get_array_key($value, $array);

       if( is_array( $get_array_key ) && array_key_exists( 'default_value', $get_array_key ) ){

       $results = $get_array_key['default_value'];

       }

       return $results;

    }

}



if ( ! function_exists('get_array_key_fnc'))
{

    function get_array_key_fnc($value, $array){

        $results = array();
        $l = 0;

    foreach( $array as $item ){

        if( is_array( $item ) ){
            $l++;

            if( array_filter($item, function($var) use ($value) { return ( !is_array( $var ) )? stristr( $var, $value ): false; } ) ){
                $results[] = $item;
                continue;
            }else if( array_key_exists('asset_info', $item) ){
                $find_assets = array();
                foreach( $item['asset_info'] as $k=>$v ){               

                    if( is_array( $v ) && array_filter($v, function($var) use ($value) { return stristr($var, $value); }) ){
                        $find_assets[] = $v;
                    }
                }
                if( count( $find_assets ) ){
                    $temp = $item;
                    $temp['asset_info'] = $find_assets;
                    $results[] = $temp;
                }
            }
        }
    }

    $return_array = array();

    if($l>0 ){

        foreach ($results as $key => $val)
            {

            $return_array = $val;

        }

    }else{

        $return_array = $array;

    }    

    return $return_array;

}

}

if ( ! function_exists('select_array_fnc'))
{

    function select_array_fnc($array, $where, $value, $command = '==', $group = false){

        $return = array();

        if($array && $where && $value){

        switch ($command)
        {
             case '==':

                $group_val ='';
                
                foreach($array as $key){ 
                    
                    if($group == TRUE){

                        if(empty($group_val)){

                            $group_val = $key['field_group'];
                        }

                        if($key[$where] == $value && $key['field_group'] == $group_val){
       
                            $return[] = $key;
                 
                        }

                    }else{

                        if(is_array($value))
                        {

                            if(in_array($key[$where], $value)){
       
                                $return[] = $key;
                
                            }


                        }else{
            
                    if($key[$where] == $value){
       
                       $return[] = $key;
       
                   }

                }

                }
               }

                return $return;
                break;
                
             case '!=': 

                $group_val ='';
    
                foreach($array as $key){ 
            
                    if($group == TRUE){

                        if(empty($group_val)){

                            $group_val = $key['field_group'];
                        }

                        if($key[$where] != $value && $key['field_group'] == $group_val){
       
                            $return[] = $key;
                 
                        }

                    }else{

                        if(is_array($value))
                        {

                            if(!in_array($key[$where], $value)){
       
                                $return[] = $key;
                
                            }


                        }else{
            
                    if($key[$where] != $value){
       
                       $return[] = $key;
       
                   }

                }

                }
               }

                return $return;
                break;           
                
        }     

    }

    }

}

if ( ! function_exists('array_value_update_fnc'))
{

    function array_value_update_fnc($array, $key, $value){

       

    }

}

if ( ! function_exists('replace_placeholders_fnc'))
{
function replace_placeholders_fnc($content, $images = [], $gallery = [], $base_url = '', $img_url = '', $cache_image = true)
{
    if (!empty($images)) {
        foreach ($images as $index => $img) {

            $i = $index + 1;

            if (empty($img['upload_file'])) continue;

            $image_url = $img_url .
                display_image_fnc(
                    'webp-0x0',
                    $img['upload_file'],
                    'normal',
                    $cache_image,
                    true
                );

            $content = str_replace(
                "{img_src_$i}",
                '<img src="'.$image_url.'" alt="" class="img-fluid">',
                $content
            );

            $content = str_replace(
                "{img_url_$i}",
                $image_url,
                $content
            );
        }
    }

    if (!empty($gallery)) {
        foreach ($gallery as $index => $img) {

            $i = $index + 1;

            if (empty($img['upload_file'])) continue;

            $image_url = $img_url .
                display_image_fnc(
                    'webp-0x0',
                    $img['upload_file'],
                    'normal',
                    $cache_image,
                    true
                );

            $content = str_replace(
                "{gal_src_$i}",
                '<img src="'.$image_url.'" alt="" class="img-fluid">',
                $content
            );

            $content = str_replace(
                "{gal_url_$i}",
                $image_url,
                $content
            );
        }
    }


     $content = preg_replace_callback(
        '/#([a-zA-Z0-9_]+)/',
        function ($matches) use ($base_url) {
            $hashtag = $matches[1];
            $url = $base_url . 'bsearch.html?query=' . urlencode($hashtag);
            return ' <a href="' . $url . '" class="hashtag">#' . htmlspecialchars($hashtag) . '</a> ';
        },
        $content
    );


 
$video_short_tag_pattern = '/\{vid_(youtube|vimeo|dailymotion)_([a-zA-Z0-9_-]+)\}/i';

$content = preg_replace_callback($video_short_tag_pattern, function($matches) {
    $platform = strtolower($matches[1]);
    $video_id = $matches[2];

    $embeds = [
        'youtube'     => "https://www.youtube.com/embed/$video_id?rel=0&autoplay=0",
        'vimeo'       => "https://player.vimeo.com/video/$video_id?autoplay=0",
        'dailymotion' => "https://geo.dailymotion.com/player.html?video=$video_id&autoplay=0&mute=false"
    ];

    if (!isset($embeds[$platform])) return $matches[0]; 

    $src = $embeds[$platform];

    return '
    <div class="card border-0 shadow-sm rounded-4 my-1">
        <div class="ratio ratio-16x9">
            <iframe src="'.$src.'" 
                    title="'.$platform.' video player" 
                    loading="lazy"
                    frameborder="0" 
                    allow="accelerometer; encrypted-media; gyroscope; picture-in-picture; web-share;"
            allowfullscreen >
            </iframe>
        </div>
    </div>';
}, $content);



    return $content;
 }

}