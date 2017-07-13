<?php
namespace OCFram\Form;

use \OCFram\Validator;

class ExtensionsValidator extends Validator
{
  protected $extensions;
  protected $key;
  
  public function __construct($errorMessage, $key, array $extensions)
  {
    parent::__construct($errorMessage);
    
    $this->setExtensions($extensions);
    $this->key = $key;
  }
  
  public function isValid($value)
  {
    $ext = substr(strrchr($_FILES[$this->key]['name'],'.'),1);
    return (!in_array($ext, $this->extensions)) ? false : true;
  }
  
  public function setExtensions(array $extensions)
  {
    $this->extensions = $extensions;
  }
}