<?php
/**
 * Интерфейс объекта с краткими данными о моделе
 */
interface IModel {
    /**
    * Вывод названия модели товара 
    * @return String
    */
	public function name();
        
     /**
    * Вывод буквенного кода модели товара 
    * @return String
    */
	public function id_abriviature();    
	
	/**
    * Вывод идентификатора модели товара 
    * @return int
    */
	public function id();
        
    /**
    * Признак  двойной модели товара 
    * @return Boolean
    */
	public function double();      

   
}
?>