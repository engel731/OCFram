<?php
namespace OCFram\APIFram;

abstract class ApiComponent
{
  protected $app;
  
  public function __construct(Api $app)
  {
    $this->app = $app;
  }
  
  public function app()
  {
    return $this->app;
  }
}