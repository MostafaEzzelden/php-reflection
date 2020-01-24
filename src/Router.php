<?php
namespace App;

class Router
{
    public static $instance;

    protected $server;

    private function __construct()
    {
        $this->server = $_SERVER;
        self::$instance = $this;
    }

    public static function getInstance()
    {
        if (!self::$instance) {
            new static;
        }
        return self::$instance;
    }

    private function getServer($key = null, $default = null)
    {
        if ($key && isset($this->server[$key])) {
            return $this->server[$key];
        }
        return $default ?: $this->server;
    }

    private function matchURI(string $uri)
    {
        $pathInfo = self::$instance->getServer('PATH_INFO');

        return ($pathInfo == $uri) || ($pathInfo == ($uri . '/'));
    }

    private function reflect($callback)
    {
        if (is_callable($callback)) {
            return AppReflection::reflectFunction($callback);
        }
    }

    public static function get(string $uri, $callback)
    {
        if (self::$instance->isGet() && self::$instance->matchURI($uri)) {
            return self::$instance->reflect($callback);
        }
    }

    private function isGet()
    {
        return $this->getServer('REQUEST_METHOD')  === 'GET';
    }
}
