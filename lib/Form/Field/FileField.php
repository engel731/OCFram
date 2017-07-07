<?php
namespace OCFram\Form\Field;

use \OCFram\Field;

class FileField extends Field
{
  public function buildWidget()
  {
    $widget = '';
    
    if (!empty($this->errorMessage))
    {
      $widget .= $this->errorMessage.'<br />';
    }
    
    return $widget .= '<label>'.$this->label.'</label><input type="file" name="'.$this->name.'" /><br />';
  }
}