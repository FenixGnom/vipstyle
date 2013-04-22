<?php
include_once dirname(__FILE__).'/../interfaces/sizes.entity.php';

class SizesStorage implements ISize {
    private $size_name = '';
   
   

    function __construct($size){
        $this->size_name = $size;    
    }

    function size() {
        return $this->size_name; 
    }

    

    
}

?>