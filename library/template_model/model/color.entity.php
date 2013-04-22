<?php

include_once dirname(__FILE__).'/../interfaces/color.entity.php';

class ColorStorage implements IColor {
    private $img_front = 0;
    private $img_back = 0;
    private $hand_product = 0;
    private $id_product = 0;
    private $color_type = '';
    private $color_model = '';
    private $color_name = '';
    private $views='';

    function __construct($id,$hand,$front,$back, $type_color,$model,$name){
        $this->img_front = $front;
        $this->img_back = $back;
        $this->hand_product =(int) $hand;
        $this->id_product = $id;        
        $this->color_type = $type_color; 
        $this->color_model=$model;
        $this->color_name=$name;
        $this->views=new View();
    }

    function img_url() {
       
        if($this->img_front==0 and $this->img_back==1)
            return $this->views->LoadProdImageFutBack($this->id_product,$this->color_model,$this->color_type,'250',$this->hand_product,$this->img_back);
	else
            return $this->views->LoadProdImageFut($this->id_product,$this->color_model,$this->color_type,'250',$this->hand_product,$this->img_front);
    }

    function link() {        
        $hand_temp=$this->hand_product==0 ? '':'/long/1';
        return 'getcolor(\'/catalog/img_loader/im/'.$this->id_product.'_'.str_replace('_','@',$this->color_model).'_'.$this->color_type.$hand_temp.'\','.$this->id_product.')';
    }

    function name()
    {
        return $this->color_name;
    }
    function model()
    {
        return $this->color_model;
    }
    function color_abriv()
    {
        return $this->color_type;
    }
    function hand()
    {
        return $this->hand_product;
    }
    
}

?>