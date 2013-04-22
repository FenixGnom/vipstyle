<?php
/**
 * Интерфейс объекта с краткими данными товара
 */
interface IOffer {
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
     * Возвращает ссылку на страницу товара
     * @return String
     */
    function url();

    /**
     * Возвращает ссылку на изображение товара
     * @return String
     */
    function image_url();

    /**
     * Возвращает стоимость единицы товара
     * @return Integer
     */
    function price();
}
?>