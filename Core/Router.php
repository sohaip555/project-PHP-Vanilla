<?php

namespace Core;


use Core\middlerware\Middleware;

require_once 'functions.php';

class Router
{

    protected array $routes = [];

    public function add($method, $uri, $controller)
    {
        $this->routes[] = [
            'uri' => $uri,
            'controller' => $controller,
            'method' => $method,
            'middleware' => null
        ];

        return $this;
    }


    public function get($uri, $controller)
    {
        return $this->add('GET', $uri, $controller);
    }


    public function post($uri, $controller)
    {
        return $this->add('post', $uri, $controller);
    }

    public function delete($uri, $controller)
    {
        return $this->add('delete', $uri, $controller);
    }

    public function patch($uri, $controller)
    {
        return $this->add('patch', $uri, $controller);
    }

    public function put($uri, $controller)
    {
        return $this->add('put', $uri, $controller);
    }

    public function only($key)
    {
        $this->routes[array_key_last($this->routes)]['middleware'] = $key;
    }

    public function route($uri, $method)
    {
        foreach ($this->routes as $route) {
            if ($route['uri'] === $uri && strtoupper($route['method']) === strtoupper($method)) {
                Middleware::resolve($route['middleware']);

                return require base_path('Http\controllers\\'.$route['controller']);
            }
        }

        abort();
    }

    public function abort($code = 404): void
    {
        http_response_code($code);

        require "views/{$code}.php";

        die();
    }

    public function previousUrl()
    {
        return $_SERVER['HTTP_REFERER'];
    }


}
