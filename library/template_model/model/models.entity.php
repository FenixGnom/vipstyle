<?php
include_once dirname(__FILE__).'/../interfaces/models.entity.php';

class ModelsStorage implements IModels {
    private $id_model = 0;
    private $name_model = '';
   

    function __construct($id,$name){
        $this->id_model = $id;
        $this->name_model = $name;       
    }

    function name() {
        return $this->name_model; 
    }

    function id() {        
       return $this->id_model; 
    }

    
}

?>