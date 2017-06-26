<?php
namespace OCFram\Form;

use \OCFram\Validator;

class NotNullValidator extends Validator
{
  public function isValid($value)
  {
    return $value != '';
  }
}