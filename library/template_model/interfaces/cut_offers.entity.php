<?php
/**
 * Интерфейс объекта с данными о товаре, находящегося в корзине
 */
interface IOfferCut {
   
	
    /**
    * Возвращает название товара 
    * @return string
    */    
        
    public function name();
    
    /**
    * Возвращает стоимость товара 
    * @return Float
    */  
    public function price();
    
    /**
    * Возвращает размер товара 
    * @return string
    */  
    public function size();

    /**
    * Возвращает модель товара 
    * @return string
    */
    public function model_name();
    
    /**
    * Возвращает общуюю сумму денег товара 
    * @return Float
    */
    public function price_amount();
    
    /**
    * Возвращает ссылку на удаление товара из корзины 
    * @return string
    */
    public function link_del();
    
    /**
    * Возвращает тип рукава 
    * @return string
    */
    public function hand();

    /**
    * Возвращает количество товара 
    * @return string
    */
    public function amount();
    
    /**
    * Возвращает ссылку на изображение товара 
    * @return string
    */
    public function images_url();
    
    /**
    * Возвращает ссылку на большое изображение товара 
    * @return string
    */
    public function imagesbig_url();
    
     /**
    * Возвращает название цвета 
    * @return string
    */
    public function color_name();
        

   
}
?>