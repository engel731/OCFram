<?php

namespace OCFram\APIFram;

use OCFram\HTTPRequest;
use OCFram\HTTPResponse;
use OCFram\Router;

abstract class Api 
{
    protected $httpRequest;
    protected $httpResponse;
    protected $router;
    
    protected $name;

    public function __construct()
    {
        $this->httpRequest = new HTTPRequest($this);
        $this->httpResponse = new HTTPResponse($this);
        $this->router = new Router();

        $this->name = '';
    }

    abstract public function init();
    
    public function getController() {
        try {
            $matchedRoute = $this->router->getRoute($this->httpRequest->requestURI());
        } catch (\RuntimeException $e)
        {
            if ($e->getCode() == Router::NO_ROUTE) {
                //Renvoyer une erreur
            }
        }
        
        $_GET = array_merge($_GET, $matchedRoute->vars());

        $controllerClass = 'App\\'.$this->name.'\\'.$matchedRoute->action().'Controller';
        return new $controllerClass($this, $matchedRoute->ressources());
    }

    abstract public function run();

    public function router() { return $this->router; }
    public function httpRequest() { return $this->httpRequest; }
    public function httpResponse() { return $this->httpResponse; }
    public function name() { return $this->name; }
}