<?php
namespace Core\Engine\Components;

class Router
{
    public $routes = [
        'GET' => [],
        'POST' => []
    ];

    public static function load($file)
    {
        $router = new static;
        require $file;
        return $router;
    }


    public function get($uri, $controller)
    {
        $this->routes['GET'][$uri] = $controller;
    }

    public function post($uri, $controller)
    {
        $this->routes['POST'][$uri] = $controller;
    }

    public function direct($uri, $requestType)
    {   
        if(array_key_exists($uri, $this->routes[$requestType]))
        {
            return $this->callAction(...explode('@', $this->routes[$requestType][$uri]));
        }

        die('No route defined for this URI: ' . $uri);
    }

    protected function callAction($controller, $action)
    {
        $controller = "Core\\App\\Controllers\\$controller";
        $controller = new $controller;

        if(! method_exists($controller, $action)) 
        {
            die("Controller does not respond the $action action");
        }

        return $controller->$action();
    }
}