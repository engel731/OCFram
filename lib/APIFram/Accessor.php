<?php
namespace OCFram\APIFram;

use OCFram\ApplicationComponent;
use OCFram\Managers;
use OCFram\PDOFactory;

abstract class Accessor extends ApplicationComponent
{
  protected $action = '';
  protected $ressource = '';
  protected $function = '';
  
  protected $managers = null;

  public function __construct(Api $app, $action, $ressource, $function)
  {
    parent::__construct($app);

    $this->managers = new Managers('PDO', PDOFactory::getMysqlConnexion());
    
    $this->setRessource($ressource);
    $this->setAction($action);
    $this->setFunction($function);
  }

  public function execute()
  {
    $method = $this->action.'_'.$this->function.ucfirst($this->ressource);

    if (!is_callable([$this, $method]))
    {
      throw new \RuntimeException('La ressource "'.$this->$ressource.'" n\'est pas définie');
    }

    return $this->$method($this->app->httpRequest());
  }

  public function setAction($action)
  {
    if (!is_string($action) || empty($action))
    {
      throw new \InvalidArgumentException('L\'action doit être une chaine de caractères valide');
    }

    $this->action = $action;
  }

  public function setFunction($function)
  {
    if (!is_string($function))
    {
      throw new \InvalidArgumentException('La fonction doit être une chaine de caractères valide');
    }

    $this->function = $function;
  }

  public function setRessource($ressource)
  {
    if (!is_string($ressource) || empty($ressource))
    {
      throw new \InvalidArgumentException('La ressource doit être une chaine de caractères valide');
    }

    $this->ressource = $ressource;
  }

  public function action() { return $this->action; }
  public function ressource() { return $this->ressource; }
  public function getFunction() { return $this->function; }
}