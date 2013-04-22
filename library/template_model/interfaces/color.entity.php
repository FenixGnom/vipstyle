<?php
/**
 * Интерфейс объекта с краткими данными о цвете
 */
interface IColor {
    /**
    * Возвращает ссылку к уменьшенному изображению цвета
    * @return String
    */
    function img_url();

    /**
    * Возвращает ссылку на изменения цвета 
    * @return String
    */
    function link();
    
    /**
    * Возвращает название цвета 
    * @return String
    */
    function name();
    
    /**
    * Возвращает модель для текущего цвета 
    * @return String
    */
    function model();
    
    /**
    * Латинская абрривиатура цвета 
    * @return String
    */
    function color_abriv();
    
    /**
    * Возвращает значение рукава (0-короткий 1-длинный) 
    * @return Integer
    */
    function hand();

   
}
?>