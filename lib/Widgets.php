<?php
namespace OCFram;

class Widgets extends ApplicationComponent
{
  protected $widgets = [];

  public function __construct(Application $app)
  {
    parent::__construct($app);
  }

  public function getWidgetsOf($module)
  {
    if (!is_string($module) || empty($module))
    {
      throw new \InvalidArgumentException('Le widget spécifié est invalide');
    }

    if (!isset($this->widgets[$module]))
    {
      $widget = '\\Widget\\'.$module;

      $this->widgets[$module] = new $widget($this->app);
    }

    return $this->widgets[$module];
  }
}