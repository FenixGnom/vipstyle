<?php

/**
 * Интерфейс объекта с данными ссылки меню.
 */
interface IMenuLink {
    /**
     * Возвращает название ссылки
     * @return String
     */
    function name();

    /**
     * Возвращает, признак является ли ссылка выделеной
     * @return Boolean
     */
    function is_selected();
    
    /**
     * Возвращает, признак необходимо ли открыть ссылку в новом окне
     * @return Boolean
     */
    function  is_target();
   

    /**
     * Возвращает ссылку на страницу
     * @return String
     */
    function url();
}
?>