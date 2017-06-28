<?php
namespace OCFram\Form\BootstrapField;

use \OCFram\Field;

class StringField extends Field
{
  protected $maxLength;
  
  public function buildWidget()
  {
    $widget = (!empty($this->errorMessage)) ?  '<div class="form-group has-error">' : '<div class="form-group">';
    $widget .= '<label class="control-label" for="'.$this->name.'">'.$this->label.'</label><input class="form-control" id="'.$this->name.'" type="text" name="'.$this->name.'" aria-describedby="help-'.$this->name.'"';
    
    if (!empty($this->value))
    {
      $widget .= ' value="'.htmlspecialchars($this->value).'"';
    }

    if (!empty($this->maxLength))
    {
      $widget .= ' maxlength="'.$this->maxLength.'"';
    }

    $widget .= '/>';

    if (!empty($this->errorMessage))
    {
      $widget .= '<span id="help-'.$this->name.'" class="help-block">'.$this->errorMessage.'</span>';
    }
    
    return $widget .= '</div>';
  }
  
  public function setMaxLength($maxLength)
  {
    $maxLength = (int) $maxLength;
    
    if ($maxLength > 0)
    {
      $this->maxLength = $maxLength;
    }
    else
    {
      throw new \RuntimeException('La longueur maximale doit être un nombre supérieur à 0');
    }
  }
}