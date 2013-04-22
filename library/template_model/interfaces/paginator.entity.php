<?php

/**
 * Интерфейс объекта с данными ссылок погинации
 */
interface IPagginator {
    /**
     * Возвращает массив ссылок пагинации
     * @return Array of IMenuLink
     */
    function links();

    /**
     * Возвращает объект данных ссылки на первую страницу или false в случае ее отсутсвия
     * @return IMenuLink | False
     */
    function first();

    /**
     * Возвращает объект данных ссылки на последнюю страницу или false в случае ее отсутсвия
     * @return IMenuLink | False
     */
    function last();

    /**
     * Возвращает объект данных ссылки на следующую страницу или false в случае ее отсутсвия
     * @return IMenuLink | False
     */
    function next();

    /**
     * Возвращает объект данных ссылки на предыдущую страницу или false в случае ее отсутсвия
     * @return IMenuLink | False
     */
    function previus();
}
?>