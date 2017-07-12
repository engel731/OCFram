<?php
namespace OCFram;

abstract class Widget extends ApplicationComponent
{
  protected $managers;
  protected $vars = [];
  protected $template;

  public function __construct(Application $app)
  {
  	parent::__construct($app);
    $this->managers = new Managers('PDO', PDOFactory::getMysqlConnexion());
  }

  abstract public function controllerWidget();

  public function addVar($var, $value)
  {
    if (!is_string($var) || is_numeric($var) || empty($var))
    {
      throw new \InvalidArgumentException('Le nom de la variable doit être une chaine de caractères non nulle');
    }

    $this->vars[$var] = $value;
  }

  public function setTemplate($template) 
  {
    if (!is_string($template) || empty($template))
    {
      throw new \InvalidArgumentException('Le template spécifiée est invalide');
    }

    $this->template = $template;
  }

  public function generatedWidget() 
  {
    $user = $this->app->user();

    $this->controllerWidget();

    extract($this->vars);

    ob_start();
      require $this->template;
    return ob_get_clean();
  }
}