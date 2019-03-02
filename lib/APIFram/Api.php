<?php

namespace OCFram\APIFram;

use OCFram\HTTPRequest;
use OCFram\HTTPResponse;
use OCFram\Router;

abstract class Api 
{
    protected $httpRequest;
    protected $httpResponse;
    
    protected $name;
    protected $applicationPath;

    public function __construct()
    {
        $this->httpRequest = new HTTPRequest($this);
        $this->httpResponse = new HTTPResponse($this);

        $this->name = '';
        $this->applicationPath = '';
    }
    
    public function getController() {
        $router = new Router;

        $xml = new \DOMDocument;
        $xml->load($this->applicationPath.'/Config/routes.api.xml');
        
        $routes = $xml->getElementsByTagName('route');
      
        foreach ($routes as $route) {
            $vars = [];

            if ($route->hasAttribute('vars')) {
                $vars = explode(',', $route->getAttribute('vars'));
            }

            $router->addRoute(new Route($route->getAttribute('method'), $route->getAttribute('url'), $route->getAttribute('ressources'), $route->getAttribute('function'), $vars));
        }
        
        try {
            $matchedRoute = $router->getRoute($this->httpRequest->requestURI());
        } catch (\RuntimeException $e)
        {
            if ($e->getCode() == Router::NO_ROUTE) {
                $this->httpResponse->send(json_encode(array('status' => '404')));
            }
        }
        
        $_GET = array_merge($_GET, $matchedRoute->vars());
        
        $accessorClass = 'App\\'.$this->name.'\\Ressources\\'.$matchedRoute->ressources().'Accessor';
        return new $accessorClass($this, $matchedRoute->action(), $matchedRoute->ressources(), $matchedRoute->getFunction());
    }

    abstract public function run();

    public function httpRequest() { return $this->httpRequest; }
    public function httpResponse() { return $this->httpResponse; }
    public function name() { return $this->name; }
}