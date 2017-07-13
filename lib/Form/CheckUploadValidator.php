<?php
namespace OCFram\Form;

use \OCFram\Validator;

class CheckUploadValidator extends Validator
{
  protected $key;

  public function __construct($errorMessage, $key)
  {
    parent::__construct($errorMessage);

    $this->key = $key;
  }

  public function isValid($value)
  {
    return (!isset($_FILES[$this->key]) OR $_FILES[$this->key]['error'] > 0) ? FALSE : TRUE;
  }
}