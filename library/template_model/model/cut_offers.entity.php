<?php
include_once dirname(__FILE__).'/../interfaces/cut_offers.entity.php';


class OffersCutStorage implements IOfferCut {
    private $hand = '';
    private $price = 0;
    private $name = '';
    private $size = '';
    private $model_name = '';
    private $amount = 0;
    private $img = '';
    private $img_big = '';
    private $link = '';
    private $color_name = 0;
    
   
    function __construct($name,$price,$amount,$model_name,$hand,$size,$img,$link,$img_big,$colorname){
        $this->hand = $hand;
        $this->price = (float) $price;
        $this->name = $name;
        $this->size = $size;
        $this->model_name = $model_name;
        $this->amount =(float) $amount;
        $this->img = $img;
        $this->link=$link;
        $this->color_name=$colorname;
        $this->img_big=$img_big;
        
        
    }

    public function name()
    {
        return $this->name;		
    }
    public function price()
    {	
        return  $this->price;		
    }

    public function size()
    {	
        return  $this->size;			
    }

    public function model_name()
    {	
        return  $this->model_name;		
    }	
    public function price_amount()
    {
        return (float)($this->price * $this->amount);
    }
    public function link_del()
    {
        return $this->link;
    }

    public function hand()	
    {
       return  $this->hand;       
    }

    public function amount()
    {
       return  $this->amount;	
    }	
    public function images_url()
    {
        return $this->img;    
    }
    public function imagesbig_url()
    {
        return $this->img_big;    
    }
    public function color_name()
    {
        return $this->color_name; 
       
    }
    
    
}

?>