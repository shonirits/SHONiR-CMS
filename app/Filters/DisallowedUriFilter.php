<?php

namespace App\Filters;

use CodeIgniter\HTTP\RequestInterface;
use CodeIgniter\HTTP\ResponseInterface;
use CodeIgniter\Filters\FilterInterface;
use CodeIgniter\Exceptions\PageNotFoundException;
use Config\Services;

class DisallowedUriFilter implements FilterInterface
{
    /**
     * List of risky characters and patterns to block in URI path
     */
    protected array $disallowedChars = [
        '<', '>', '"', '\'', '{', '}', '(', ')', '[', ']', '|', '\\', '`',
        '^', '~', '#', '&', '%', '$', '*', '+', ';', '='
    ];


    /**
     * Keywords and encodings often seen in malicious payloads
     */
    protected array $disallowedPatterns = [
        '../', '..\\', '%2e%2e%2f', '%3c', '%3e',
        'script', 'eval(', 'base64_decode',
        'select ', 'union ', '--', 'drop ',
        '<iframe', '<img', '<svg',
        'file://', 'php://', 'data:text',
        '/cgi-bin/', 'cmd=', ';stok=', 'luci'
    ];


    protected int $banDuration = 3600;

    public function before(RequestInterface $request, $arguments = null)
    {
        $ip    = $request->getIPAddress();
        $path  = rawurldecode($request->getUri()->getPath());
        $cache = Services::cache();
        $key   = $this->sanitizeKey($ip);

        if ($path === '' || $path === '/') {
            return;
        }

        if ($cache->get($key)) {
            throw PageNotFoundException::forPageNotFound();
        }

        foreach ($this->disallowedChars as $char) {
            if (strpos($path, $char) !== false) {
                $this->banIp($ip, $path, "char '{$char}'", $key);
            }
        }

        foreach ($this->disallowedPatterns as $pattern) {
            if (stripos($path, $pattern) !== false) {
                $this->banIp($ip, $path, "pattern '{$pattern}'", $key);
            }
        }
    }

    public function after(RequestInterface $request, ResponseInterface $response, $arguments = null)
    {
    }

    protected function banIp(string $ip, string $path, string $reason, string $key): void
    {
         log_message('critical', "IP {$ip} banned due to {$reason} in path: {$path}");
        Services::cache()->save($key, true, $this->banDuration);
        throw PageNotFoundException::forPageNotFound();
    }


    protected function sanitizeKey(string $ip): string
    {
        return 'banned_ip_' . preg_replace('/[{}()\/\\\\@:]/', '_', $ip);
    }

}