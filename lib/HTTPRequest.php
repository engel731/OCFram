<?php
namespace OCFram;

class HTTPRequest extends ApplicationComponent
{
  public function cookieData($key)
  {
    return isset($_COOKIE[$key]) ? $_COOKIE[$key] : null;
  }

  public function cookieExists($key)
  {
    return isset($_COOKIE[$key]);
  }

  public function getData($key)
  {
    return isset($_GET[$key]) ? $_GET[$key] : null;
  }

  public function getExists($key)
  {
    return isset($_GET[$key]);
  }

  public function getFile($key)
  {
    return (!isset($_FILES[$key]) OR $_FILES[$key]['error'] > 0) ? null : $_FILES[$key];
  }

  public function fileExists($key)
  {
    return (!isset($_FILES[$key]) OR $_FILES[$key]['error'] > 0) ? FALSE : TRUE;
  }

  public function method()
  {
    return $_SERVER['REQUEST_METHOD'];
  }

  public function postData($key)
  {
    return isset($_POST[$key]) ? $_POST[$key] : null;
  }

  public function postExists($key)
  {
    return isset($_POST[$key]);
  }

  public function requestURI()
  {
    return $_SERVER['REQUEST_URI'];
  }
}