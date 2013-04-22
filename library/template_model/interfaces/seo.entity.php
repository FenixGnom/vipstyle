<?php

/**
 * Интерфейс объекта с SEO данными страницы
 */
interface ISeo {
    /**
     * Возвращает строку с ключевыми словами страницы
     * @return String
     */
    function keywords();

    /**
     * Возвращает строку с описанием страницы
     * @return String
     */
    function description();
}

?>