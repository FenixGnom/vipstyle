<?php

include_once dirname(__FILE__).'/../interfaces/delivery.entity.php';

class DeliveryStorage implements IDelivery {
    private $cost = 0;
    private $value = '';
    private $name = '';
    private $point = '';
    private $amount = 0;
   
    function __construct($name,$value,$cost,$point,$amount=0){
        $this->cost = $cost;
        $this->value = $value;
        $this->name = $name;
        $this->amount = $amount;
        $this->point = $point;
    }

   public function name()
   {
       return $this->name;
   }

   public function value()
   {
       return $this->value;
   }
   
   public function cost()
   {
       return $this->cost;
   }
   public function amount()
   {
       return $this->amount;
   }
   public function point()
   {
       return $this->point;
   }

    
}

?>