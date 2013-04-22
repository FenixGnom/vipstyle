<?php
include_once dirname(__FILE__).'/../interfaces/model.entity.php';

class ModelsStorage implements IModel {
    private $id_model = 0;
    private $name_model = '';
    private $abriv_model = '';
    private $double_model = 0;
   

    function __construct($id,$name,$abriv='',$double=0){
        $this->id_model = $id;
        $this->name_model = $name;
        $this->abriv_model=$abriv;
        $this->double_model=(boolean) $double;
    }

    function name() {
        return $this->name_model; 
    }

    function id() {        
       return $this->id_model; 
    }
    
    function id_abriviature()
    {
        return $this->abriv_model; 
    }
    function double()
    {
        return $this->double_model;
    } 

    
}

?>