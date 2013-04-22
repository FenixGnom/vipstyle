<?php
/**
 * Интерфейс объекта данных о заказе. Описывает методы доступа к данным страницы,
 * которые отсутсвуют в данных описанных в интерфейсе IPage
 */
interface ICutOrderPage {
    /**
     * Возвращает номер заказа
     * @return Integer
     */
    function order();

    /**
     * Возвращает электронный адрес заказчика
     * @return String
     */
    function email();

    /**
     * Возвращает результат выполнение заказ(true-заказ принят,false-заказ не принят)
     * @return Boolean
     */
    function is_result();
    
     /**
     * Возвращает ответ сервера заказов
     * @return String
     */
    function answer();
}

?>