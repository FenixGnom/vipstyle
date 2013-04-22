<?php
/**
 * Интерфейс объекта данных страницы категории. Описывает методы доступа к данным страницы,
 * которые отсутсвуют в данных описанных в интерфейсе IPage
 */
interface ICategoryPage {
    /**
     * Возвращает Массив товаров, выводящихся на странице
     * @return Array of IOffer
     */
    function offers();

    /**
     * Возвращает объект данных пагинатора
     * @return IPagginator
     */
    function pagginator();

    /**
     * Возвращает название категории
     * @return String
     */
    function category_name();
    
    /**
     * Возвращает описание категории
     * @return String
     */
    function category_desc();
}

?>