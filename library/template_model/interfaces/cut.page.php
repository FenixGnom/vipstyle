<?php
/**
 * Интерфейс объекта данных корзины. Описывает методы доступа к данным страницы,
 * которые отсутсвуют в данных описанных в интерфейсе IPage
 */
interface ICutPage {
    /**
     * Возвращает Массив товаров, находящихся в корзине
     * @return Array of IOfferCut
     */
    function offers();

    /**
     * Возвращает общее число товаров в корзине
     * @return Integer
     */
    function count();

    /**
     * Возвращает общую сумму денег за товары, находящихся в корзине
     * @return String
     */
    function sum();
    
    /**
     * Возвращает Массив, с информаций о доставке 
     * @return Array of IDeliveryInfo
     */
    function deliveryinfo();    
    
}

?>