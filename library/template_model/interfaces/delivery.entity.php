<?php
/**
 * Интерфейс объекта с краткими данными о доставке
 */
interface IDelivery {
    /**
        * Возвращает название типа доставки 
        * @return string
        */
	
	public function name();
	
        /**
        * Возвращает тип доставки (POSTAL,COURIER,MSKPOINT2 и т.д.)
        * @return string
        */
	
	public function value();
	
	/**
        * Возвращает стоимость доставки
        * @return float
        */
	
	public function cost();
        
        /**
        * Возвращает название доставки
        * @return String
        */
	
	public function amount();
        
        /**
        * Пункт выдачи 
        * @return String
        */
	
	public function point();
        
        
        
        

   
}
?>