<?php
namespace OCFram\Form\BootstrapField;

use \OCFram\Field;

class TextField extends Field
{
  protected $cols;
  protected $rows;
  
  public function buildWidget()
  {
    $widget = (!empty($this->errorMessage)) ?  '<div class="form-group has-error">' : '<div class="form-group">';
    $widget .= '<label class="control-label" for="'.$this->name.'">'.$this->label.'</label><textarea class="form-control" id="'.$this->name.'" name="'.$this->name.'" aria-describedby="help-'.$this->name.'"';
    
    if (!empty($this->cols))
    {
      $widget .= ' cols="'.$this->cols.'"';
    }
    
    if (!empty($this->rows))
    {
      $widget .= ' rows="'.$this->rows.'"';
    }
    
    $widget .= '>';
    
    if (!empty($this->value))
    {
      $widget .= htmlspecialchars($this->value);
    }

    $widget .= '</textarea>';

    if (!empty($this->errorMessage))
    {
      $widget .= '<span id="help-'.$this->name.'" class="help-block">'.$this->errorMessage.'</span>';
    }
    
    return $widget.'</div>';
  }
  
  public function setCols($cols)
  {
    $cols = (int) $cols;
    
    if ($cols > 0)
    {
      $this->cols = $cols;
    }
  }
  
  public function setRows($rows)
  {
    $rows = (int) $rows;
    
    if ($rows > 0)
    {
      $this->rows = $rows;
    }
  }
}