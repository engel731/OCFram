<?php 

namespace OCFram;

class IResult 
{
    protected $object;

    public function __construct($data) {
        $this->setObject($data);
    }
    
    public function list_object_to_array() {
        for($i= 0, $size = count($this->object), $result; $i < $size; $i++) {
            if($this->object[$i] instanceof Entity) {
                $result[] = $this->object[$i]->object_to_array();
            } else {
                throw new \RuntimeException('Vous devez renvoyer des entitées');
            }
        }

        return $result;
    }

    public function setObject(array $object) { $this->object = $object; }
    public function object() { return $this->object; }
}