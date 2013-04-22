<?php
include_once dirname(__FILE__).'/basepage.interface.php';

/**
 * Интерфейс объекта данных главной страницы. Описывает методы доступа к данным главной страницы,
 * которые отсутсвуют в данных описанных в интерфейсе IPage
 */
interface IIndexPage {
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
}
?>