<?php

namespace Core;

use Exception;

class Router
{
    /**
     * All registered routes.
     *
     * @var array
     */
    public $routes = [
        'GET' => [],
        'POST' => []
    ];
    /**
     * Load a user's routes file.
     *
     * @param string $file
     */
    public static function load($file)
    {
        $router = new static;
        require $file;
        return $router;
    }
    /**
     * Register a GET route.
     *
     * @param string $uri
     * @param string $controller
     */
    public function get($uri, $controller)
    {
        $this->routes['GET'][$uri] = $controller;
    }
    /**
     * Register a POST route.
     *
     * @param string $uri
     * @param string $controller
     */
    public function post($uri, $controller)
    {
        $this->routes['POST'][$uri] = $controller;
    }
    /**
     * Load the requested URI's associated controller method.
     *
     * @param string $uri
     * @param string $requestType
     */
    public function direct($uri, $requestType)
    {   
        
        try{
            
            if (array_key_exists($uri, $this->routes[$requestType])) {
                return $this->callAction(
                    ...explode('@', $this->routes[$requestType][$uri])
                );
            }
            
            throw new Exception('No route defined for this URI.');

        } 
        catch (Exception $e) 
        {    
             echo $e->getMessage();
        }
    
    }
    /**
     * Load and call the relevant controller action.
     *
     * @param string $controller
     * @param string $action
     */
    protected function callAction($controllerName, $action)
    {
        $controller = "App\\Controllers\\{$controllerName}";
        $controller = new $controller;

        try{
            
            if (! method_exists($controller, $action)) 
            {
                throw new Exception(
                    "{$controllerName} does not respond to the {$action} action."
                );
            }
            
            return $controller->$action();

        } 
        catch (Exception $e) 
        {
            
             echo $e->getMessage();
        
        }
        
    }
}