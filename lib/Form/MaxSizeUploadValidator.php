<?php
namespace OCFram\Form;

use \OCFram\Validator;

class MaxSizeUploadValidator extends Validator
{
  protected $maxSizeUpload;
  protected $key;
  
  public function __construct($errorMessage, $key, $maxSizeUpload)
  {
    parent::__construct($errorMessage);
    
    $this->setMaxSizeUpload($maxSizeUpload);
    $this->key = $key;
  }
  
  public function isValid($value)
  {
    return $_FILES[$this->key]['size'] < $this->maxSizeUpload;
  }
  
  public function setMaxSizeUpload($maxSizeUpload)
  {
    $maxSizeUpload = (int) $maxSizeUpload;
    
    if ($maxSizeUpload >= 1000000)
    {
      $this->maxSizeUpload = $maxSizeUpload;
    }
    else
    {
      throw new \RuntimeException('La longueur maximale doit être un nombre supérieur ou egal à 1 Mo');
    }
  }
}