<?php if(isset($_SERVER['HTTP_CF_CONNECTING_IP'])) {
    $_SERVER['REMOTE_ADDR'] = $_SERVER['HTTP_CF_CONNECTING_IP'];
    }
    
    use CodeIgniter\Boot;
    use Config\Paths;
    use voku\helper\HtmlMin;

header_remove('X-Powered-By');
header('X-Powered-By: SHONiR', true);

/*
 *---------------------------------------------------------------
 * CHECK PHP VERSION
 *---------------------------------------------------------------
 */

$minPhpVersion = '8.1'; // If you update this, don't forget to update `spark`.
if (version_compare(PHP_VERSION, $minPhpVersion, '<')) {
    $message = sprintf(
        'Your PHP version must be %s or higher to run CodeIgniter. Current version: %s',
        $minPhpVersion,
        PHP_VERSION,
    );

    header('HTTP/1.1 503 Service Unavailable.', true, 503);
    echo $message;

    exit(1);
}

/*
 *---------------------------------------------------------------
 * SET THE CURRENT DIRECTORY
 *---------------------------------------------------------------
 */

// Path to the front controller (this file)
define('FCPATH', __DIR__ . DIRECTORY_SEPARATOR);

// Ensure the current directory is pointing to the front controller's directory
if (getcwd() . DIRECTORY_SEPARATOR !== FCPATH) {
    chdir(FCPATH);
}

// ---------------------------
// Load html.cache from .env
// ---------------------------
$html_cache = false;

$envFile = FCPATH . '.env';

if (is_file($envFile)) {
    $handle = fopen($envFile, 'rb'); 
    if ($handle) {
        while (($line = fgets($handle, 128)) !== false) { 
            $line = ltrim($line);
            if ($line === '' || $line[0] === '#') continue;
            if (strpos($line, 'html.cache') === 0) {
                $eqPos = strpos($line, '=');
                if ($eqPos !== false) {
                    $value = substr($line, $eqPos + 1);
                    $value = trim(explode('#', $value)[0], " \t\n\r\0\x0B\"'");                    
                    $html_cache = ($value === 'true' || $value === '1' || $value === 'on');
                }
                break;
            }
        }
        fclose($handle);
    }
}

$GLOBALS['HTMLS_CACHE'] = $html_cache;
define('HTMLS_CACHE', $html_cache);

header('X-SHONiR-Cache: ' . (HTMLS_CACHE ? 'ENABLED' : 'DISABLED'));

function php_memory_fnc()
{
    $memory = memory_get_usage();
    $peak = memory_get_peak_usage();
    $unit=array('b','kb','mb','gb','tb','pb');
    $stamp = date("m/d/y G:i:s T");
    return 'Time: '.$stamp.' Usage:'.@round($memory/pow(1024,($i=floor(log($memory,1024)))),2).' '.$unit[$i].' Peak:'.@round($peak/pow(1024,($i=floor(log($peak,1024)))),2).' '.$unit[$i];
}

/**
 * Enterprise-grade minification helper
 */

function minify_content_fnc(string $content): string
{
    if (trim($content) === '') {
        return $content;
    }
    
    $htmlMin = new HtmlMin();
    
    // Optional: Configure minification
    $htmlMin->doOptimizeViaHtmlDomParser(true);
    $htmlMin->doRemoveComments(true);
    $htmlMin->doRemoveWhitespaceAroundTags(true);
    
    return $htmlMin->minify($content);
}


/**
 * SHONiR High-Performance Cache System
 * Optimizes I/O, Minification, and Browser Caching.
 */
function htmls_cache_fnc($do, $html_cache, $boot)
{
     // AJAX or JSON Guard: Do not cache or serve cache if request is AJAX or expects JSON
    $isAjax = !empty($_SERVER['HTTP_X_REQUESTED_WITH']) &&
              strtolower($_SERVER['HTTP_X_REQUESTED_WITH']) === 'xmlhttprequest';

    $acceptHeader = strtolower($_SERVER['HTTP_ACCEPT'] ?? '');
    $contentType  = strtolower($_SERVER['CONTENT_TYPE'] ?? '');

    $isJson = strpos($acceptHeader, 'application/json') !== false ||
              strpos($contentType, 'application/json') !== false;

    if ($isAjax || $isJson) {
       return $boot;
    }

    // 1. Initial Guards
    if (!defined('FCPATH') || !$html_cache) return $boot;

    $cache_root = FCPATH . 'writable/cache/';
    $uri = $_SERVER['REQUEST_URI'] ?? '';
    $host_name = strtolower(trim(preg_replace('/:\d+$/', '', $_SERVER['HTTP_HOST'] ?? '')));
    
    // Sanitize URI and Pathing
    $path = parse_url($uri, PHP_URL_PATH);
    $segments = array_values(array_filter(explode('/', trim($path, '/')), function($seg) {
    return $seg !== '' && $seg !== '.' && $seg !== '..';
    }));
    $total_segments = count($segments);
    
    $extension = strtolower(pathinfo($path, PATHINFO_EXTENSION) ?: '');
    if (!preg_match('/^[a-z0-9]+$/', $extension)) $extension = '';

    if($extension == 'xml') return $boot;
    
    // 2. Identify Segment (Localhost vs Production)
    $segment = ($host_name === 'localhost' || $host_name === '127.0.0.1') 
               ? ($segments[1] ?? '') 
               : ($segments[0] ?? '');


    // 3. Configuration & Mime Types
    static $image_types = [
        'jpg' => IMAGETYPE_JPEG, 'jpeg' => IMAGETYPE_JPEG, 'png' => IMAGETYPE_PNG, 
        'gif' => IMAGETYPE_GIF, 'webp' => IMAGETYPE_WEBP, 'bmp' => IMAGETYPE_BMP
    ];
    static $mime_types = [
        'xml' => 'application/xml', 'css' => 'text/css', 'js' => 'application/javascript',
        'json' => 'application/json', 'html' => 'text/html', '' => 'text/html',
        'webp' => 'image/webp', 'avif' => 'image/avif', 'svg' => 'image/svg+xml',
        'woff' => 'font/woff', 'woff2' => 'font/woff2', 'ttf' => 'font/ttf'
    ];

    $is_image = isset($image_types[$extension]);
    $is_static = in_array($extension, ['css', 'js', 'map', 'woff', 'woff2', 'ttf']);
    $is_commentable = in_array($extension, ['css', 'js', 'html', '']);

    $dont_process  = ['ajax', 'cart', 'checkout', 'backend', 'categories', 'sections', 'brands', 'items', 'pages', 'banners', 'mailsservers', 'emails', 'configurations', 'analytics', 'awards', 'industries', 'places', 'regions', 'voices', 'natives', 'talents', 'links', 'blogs', 'api'];

    // 4. Dynamic Cache Key & Subdir Logic
    $subdir = 'htmls';
    $cache_key = md5($uri);

    if (($i = array_search('public', $segments)) !== false) {
        $cache_key = md5(implode('/', array_slice($segments, $i + 1)));
    } elseif (($i = array_search('images', $segments)) !== false && $total_segments >= 2) {
        $mode = 'normal';
        if ($total_segments >= 3) {
            $possible_mode = strtolower($segments[$total_segments - 2]);
            if (in_array($possible_mode, ['auto', 'fix'])) $mode = $possible_mode;
        }
        $size_part = $segments[$total_segments - ($mode !== 'normal' ? 3 : 2)] ?? 'orig';
        $cache_key = md5($size_part . $mode . pathinfo($path, PATHINFO_BASENAME));
        $subdir = 'images';
    }

    $cache_file = $cache_root . $subdir . '/' . $cache_key;

    $send_security_headers = function() {
    header("X-Content-Type-Options: nosniff");
    header("X-Frame-Options: SAMEORIGIN");
    header("Referrer-Policy: strict-origin-when-cross-origin");
    header("Permissions-Policy: geolocation=(), microphone=(), camera=()");
};

static $comment_loaded_types = [
    'css' => '/* SHONiR Cache loaded %memory% */',
    'js' => '/* SHONiR Cache loaded %memory% */',
    'map' => '/* SHONiR Cache loaded %memory% */',
    'html' => '<!-- SHONiR Cache loaded %memory% -->',
    '' => ''
];

static $comment_generated_types = [
                'css' => '/* SHONiR Cache generated: %stamp% */',
                'js' => '/* SHONiR Cache generated: %stamp% */',
                'map' => '/* SHONiR Cache generated: %stamp% */',
                'html' => '<!-- SHONiR Cache generated: %stamp% --> ',
                '' => ''
            ];


    // --- READ OPERATION ---
    if ($do === 'r') {
        if (in_array(strtolower($segment), $dont_process)) return $boot;
        if (!is_file($cache_file)) {
            if ($is_static) return htmls_cache_fnc('w', $html_cache, $boot);
            return $boot;
        }

        $mtime = filemtime($cache_file);
        $etag  = md5_file($cache_file);

        // Browser Cache Validation (Etag/Last-Modified)
        if ((($_SERVER['HTTP_IF_NONE_MATCH'] ?? '') === $etag) || 
            (strtotime($_SERVER['HTTP_IF_MODIFIED_SINCE'] ?? '') >= $mtime)) {
            header('Cache-Control: public, max-age=86400, must-revalidate');
            http_response_code(304);
            exit;
        }

        // Prepare Headers
        $content_type = $is_image ? image_type_to_mime_type($image_types[$extension]) : ($mime_types[$extension] ?? 'text/html');
        header("X-Cache-Status: HIT");
        $send_security_headers();
        header("Content-Type: $content_type" . (strpos($content_type, 'text') !== false ? "; charset=UTF-8" : ""));
        header("Last-Modified: " . gmdate("D, d M Y H:i:s", $mtime) . " GMT");
        header("ETag: \"$etag\"");
        header("Cache-Control: public, max-age=86400, must-revalidate");
        header("Accept-Ranges: bytes");

        // Clean all buffers for clean output
        while (ob_get_level() > 0) ob_end_clean();

        if ($is_image) {
            $image_filesize = filesize($cache_file);
            header("Content-Length: " . $image_filesize);            
            if ($image_filesize > 1048576) {
                $fp = fopen($cache_file, 'rb');
                fpassthru($fp);
                fclose($fp);
            } else {
                readfile($cache_file);
            }
        } else {
            // Buffer text to handle memory comment and precise content-length       
                ob_start();
            readfile($cache_file);

            // Append comment only for text-based content
            if ($is_commentable) {
                
            $comment = $comment_loaded_types[$extension] ?? '';

            if ($comment){ 
                $comment = str_replace('%memory%', php_memory_fnc(), $comment);             
                echo "\n" . $comment;
            } 

            }
            header("Content-Length: " . ob_get_length());
            ob_end_flush();
        }
        exit;
    }

    // --- WRITE OPERATION ---
    if ($do === 'w') {
        if (in_array(strtolower($segment), $dont_process)) return $boot;

        // Ensure Directories
        if (!is_dir($cache_root . $subdir)) {
            @mkdir($cache_root . $subdir, 0775, true);
        }

        $content = '';
        if (($i = array_search('public', $segments)) !== false && $is_static) {
            $read_file = realpath(FCPATH . implode('/', array_slice($segments, $i)));
            if ($read_file && strpos($read_file, FCPATH) === 0 && is_file($read_file)) {
                $content = file_get_contents($read_file);
            } else {
                return $boot;
            }
        } else {
            $content = ob_get_contents() ?: '';
            while (ob_get_level() > 0) ob_end_clean();
        }

        if (empty($content)) return $boot;

        $write_content = $content;

         if ($is_commentable) {
            // High-performance Minification            
           $write_content = minify_content_fnc($write_content);

            $comment = $comment_generated_types[$extension] ?? '';

            // Add Timestamp Header
            $stamp = date("m/d/y H:i:s T");
            if ($comment){ 
                $comment = str_replace('%stamp%', $stamp, $comment);              
            $write_content = $comment . "\n" . trim($write_content);
            } 

            }


        // Atomic File Write
        $tmp_file = $cache_file . uniqid('.tmp', true);
        if (file_put_contents($tmp_file, $write_content, LOCK_EX)) {
            rename($tmp_file, $cache_file);
            @chmod($cache_file, 0644);
        }

        // Final Output
        header("X-Cache-Status: INIT");
        $send_security_headers();
        header("Cache-Control: no-store, no-cache, must-revalidate");
        
                ob_start();
            
        echo $content;
        if ($is_commentable) {
                
            $comment = $comment_loaded_types[$extension] ?? '';

            if ($comment){ 
                $comment = str_replace('%memory%', php_memory_fnc(), $comment);              
                echo "\n" . $comment;
            } 

            }
        header("Content-Length: " . ob_get_length());
        ob_end_flush();

        if ($is_static) exit;
    }

    return $boot;
}


/*
 *---------------------------------------------------------------
 * BOOTSTRAP THE APPLICATION
 *---------------------------------------------------------------
 * This process sets up the path constants, loads and registers
 * our autoloader, along with Composer's, loads our constants
 * and fires up an environment-specific bootstrapping.
 */

 // 1. Attempt to serve from cache FIRST
// This should be done before any significant application logic runs.
htmls_cache_fnc('r', $GLOBALS['HTMLS_CACHE'], 0);

// Start output buffering to capture the application's output
@ob_start();

// LOAD OUR PATHS CONFIG FILE
// This is the line that might need to be changed, depending on your folder structure.
require FCPATH . '/app/Config/Paths.php';
// ^^^ Change this line if you move your application folder

$paths = new Paths();

// LOAD THE FRAMEWORK BOOTSTRAP FILE
require $paths->systemDirectory . '/Boot.php';

// BOOT THE APPLICATION AND CAPTURE RETURN VALUE
$bootReturn = Boot::bootWeb($paths);

// PASS RETURN VALUE TO htmls_cache_fnc()
$cacheReturn = htmls_cache_fnc('w', $GLOBALS['HTMLS_CACHE'], $bootReturn);

// Send the buffered output to the browser
while (ob_get_level() > 0) {
    @ob_end_flush();
}
exit($cacheReturn);