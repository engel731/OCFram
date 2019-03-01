<?php
namespace OCFram\Api;

use OCFram;

abstract class BackController extends ApplicationComponent
{
  protected $action = '';
  protected $ressource = '';
  
  protected $managers = null;

  public function __construct(Application $app, $ressource)
  {
    parent::__construct($app);

    $this->managers = new Managers('PDO', PDOFactory::getMysqlConnexion());
    
    $this->setRessource($ressource);
  }

  public function execute()
  {
    $method = 'get'.ucfirst($this->ressource);

    if (!is_callable([$this, $method]))
    {
      throw new \RuntimeException('L\'action "'.$this->$ressource.'" n\'est pas définie pour cette resource');
    }

    return $this->$method($this->app->httpRequest());
  }

  public function setRessource($ressource)
  {
    if (!is_string($ressource) || empty($ressource))
    {
      throw new \InvalidArgumentException('La ressource doit être une chaine de caractères valide');
    }

    $this->ressource = $ressource;
  }

  public function ressource() { return $this->ressource; }
}