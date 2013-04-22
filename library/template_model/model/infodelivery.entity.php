<?php

include_once dirname(__FILE__).'/../interfaces/infodelivery.entity.php';

class DeliveryInfo implements IDeliveryInfo {
   private $cost = null;
    private $name = '';
    private $name_lat = '';
    private $text ='' ;
   
   
    function __construct($name,$name_lat,$cost,$text){
       
       $this->cost = $cost;
       $this->name = $name;
       $this->name_lat = $name_lat;
       $this->text =$text;
        
    }


   public function name()
   {
       return $this->name;
   }
   
   public function name_lat()
   {
       return $this->name_lat;
   }

   public function cost()
   {
       return $this->cost;
   }
   public function text()
   {
       return $this->text;
   }
    
}

?>