<?php
/**
 * Интерфейс объекта с данными товара
 */
interface IProduct {
    /**
     * Возвращает название товара
     * @return String
     */
    function name();

    /**
     * Возвращает идентификационный номер товара
     * @return Integer
     */
    function id();   
    
    /**
     * Возвращает стоимость единицы товара
     * @return Float
     */
    function price();
    
    /**
     * Возвращает параметры модели товара  по-умолчанию 
     * @return IModel
     */
    function model_default();
    
    /**
     * Возвращает параметры цвета товара  по-умолчанию 
     * @return IColor
     */
    
    function color_default();
    
    /**
    * Возвращает объект с информацией о категории
    * @return IMenuLink
    */
    function category();

   /**
    * Возвращает признак передней картинки
    * @return Boolean
    */
    function front();
    
    /**
    * Возвращает признак задней картинки
    * @return Boolean
    */
    function back();
    
    /**
     * Возвращает Массив моделей товара
     * @return Array of IModel
     */
    function models();
    
     /**
     * Возвращает Массив цветов товара
     * @return Array of IColor
     */
    function colors();
    
     /**
     * Возвращает Массив похожих товаров
     * @return Array of IOffer
     */
    function other_offers();
    
    /**
     * Возвращает Массив размеров
     * @return Array of ISize
     */
    function sizes();
    
    
    /**
    * Возвращает значение флага поиска (true- пользователь перешел на этот товар со страницы поиска, else - пользователь перешел на этот товар не со страницы поиска  )
    * @return Boolean
    */
    public function is_from_serch_page(); 
    
    /**
    * Возвращает признак длинного рукава (true- есть, else - нет  )
    * @return Boolean
    */
    public function is_hand();   
    
    /**
    * Возвращает описание товара
    * @return String
    */
     public function description();
     
     
     
    
	
    /**
    * Возвращает объект с информацией о подкатегории
    * @return IMenuLink
    */
    function subcat();
        
    /**
     * Возвращает ссылку на изображение товара, размером 250Х250(вид спереди)
     * @return String
     */
    function img_url();    
     /**
     * Возвращает ссылку на увеличенное изображение товара, размером 500Х500(вид спереди)
     * @return String
     */
    function imgbig_url();
    
    /**
     * Возвращает ссылку на изображение товара, размером 250Х250(вид сзади)
     * @return String
     */
    function imgback_url();
    
     /**
     * Возвращает ссылку на увеличенное изображение товара, размером 500Х500(вид сзади)
     * @return String
     */
    function imgbackbig_url();
    
    /**
     * Возвращает размер товара по-умолчанию
     * @return ISize
     */
    function size_default();
    
}
?>