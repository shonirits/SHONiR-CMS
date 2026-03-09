<?php

namespace Config;

use CodeIgniter\Events\Events;
use CodeIgniter\Exceptions\FrameworkException;
use CodeIgniter\HotReloader\HotReloader;

Events::on('pre_system', static function (): void {
    // 🧱 SECURITY: Block common bad bot patterns before CodeIgniter routing
    $uri = $_SERVER['REQUEST_URI'] ?? '';
    $method = $_SERVER['REQUEST_METHOD'] ?? '';

    if (
        stripos($uri, 'cgi-bin/luci') !== false ||
        stripos($uri, ';stok=') !== false ||
        stripos($uri, 'b%27http') !== false ||
        stripos($uri, 'etc/passwd') !== false ||
        stripos($uri, 'logs.txt') !== false ||
        preg_match('/(^|\/)(app|application)\b/i', $uri) ||
        stripos($uri, 'composer.json') !== false ||
        stripos($uri, '.env') !== false ||
        stripos($uri, 'wp-login') !== false ||
        stripos($uri, 'config.json') !== false ||
        stripos($uri, 'eval(') !== false ||
        stripos($uri, '<script') !== false
    ) {
        header('HTTP/1.1 403 Forbidden');
        exit;
    }

    // Block unwanted HTTP methods
    if (in_array($method, ['TRACE', 'TRACK'], true)) {
        header('HTTP/1.1 405 Method Not Allowed');
        exit;
    }

    // 🧹 Safety check (default from CodeIgniter)
    if (ENVIRONMENT !== 'testing') {
        if (ini_get('zlib.output_compression')) {
            throw FrameworkException::forEnabledZlibOutputCompression();
        }

        while (ob_get_level() > 0) {
            ob_end_flush();
        }

        ob_start(static fn ($buffer) => $buffer);
    }

    // 🧰 Debug Toolbar and Hot Reload (only in dev)
    if (CI_DEBUG && ! is_cli()) {
        Events::on('DBQuery', 'CodeIgniter\Debug\Toolbar\Collectors\Database::collect');
        service('toolbar')->respond();

        if (ENVIRONMENT === 'development') {
            service('routes')->get('__hot-reload', static function (): void {
                (new HotReloader())->run();
            });
        }
    }
});
