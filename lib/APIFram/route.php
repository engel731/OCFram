<?php
namespace OCFram\APIFram;

class Route
{
  protected $action;
  protected $ressources;
  protected $url;
  protected $function;
  protected $varsNames;
  protected $vars = [];

  public function __construct($action, $url, $ressources, $function, array $varsNames=[])
  {
    $this->setAction($action);
    $this->setUrl($url);
    $this->setFunction($function);
    $this->setRessources($ressources);
    $this->setVarsNames($varsNames);
  }

  public function hasVars()
  {
    return !empty($this->varsNames);
  }

  public function match($url)
  {
    if (preg_match('`^'.$this->url.'$`', $url, $matches))
    {
      return $matches;
    }
    else
    {
      return false;
    }
  }

  public function setAction($action)
  {
    if (is_string($action))
    {
      $this->action = $action;
    }
  }

  public function setFunction($function)
  {
    if (is_string($function))
    {
      $this->function = $function;
    }
  }

  public function setRessources($ressources)
  {
    if (is_string($ressources))
    {
      $this->ressources = $ressources;
    }
  }

  public function setUrl($url)
  {
    if (is_string($url))
    {
      $this->url = $url;
    }
  }

  public function setVarsNames(array $varsNames)
  {
    $this->varsNames = $varsNames;
  }

  public function setVars(array $vars)
  {
    $this->vars = $vars;
  }

  public function action() { return $this->action; }
  public function ressources() { return $this->ressources; }
  public function getFunction() { return $this->function; }
  public function vars() { return $this->vars; }
  public function varsNames() { return $this->varsNames; }
}