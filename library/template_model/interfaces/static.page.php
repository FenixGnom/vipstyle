<?php

/**
 * Интерфейс объекта данных статической страницы. Описывает методы доступа к данным страницы,
 * которые отсутсвуют в данных описанных в интерфейсе IPage
 */
interface IStaticPage {
    /**
     * Возвращает контент страницы
     * @return String
     */
    function content();
}

?>