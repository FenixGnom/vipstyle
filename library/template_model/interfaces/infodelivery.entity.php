<?php
/**
 * Интерфейс объекта с краткой информацией о способах доставки
 */
interface IDeliveryInfo {
	
        /**
        * Возвращает название доставки
        * @return String
        */
	
	public function name();
        
         /**
        * Возвращает латинское название доставки
        * @return String
        */
	
	public function name_lat();
        
       /**
        * Возвращает цены на доставку
        * @return Array of IDelivery
        */
	
	public function cost();
        
        /**
        * Возвращает информацию о доставке
        * @return String
        */
	
	public function text();

   
}
?>