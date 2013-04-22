<?php

/**
 * Интерфейс объекта с данными окружения.
 */
interface IEnviroment {
    /**
     * Путь до каталога выбраной темы оформления.
     * Используется ди составления ссылок на файлы скриптов и стилей.
     * @return String
     */
    function theme_path();

    /**
     * Версия движка магазина.
     * @return String
     */
    function version();
     /**
     * Возвращает внутренний идентификатор запрошеной страницы
     * @return String
     */
    public function page();
    
      /**
     * Возвращает внутренний идентификатор запрошеной функции
     * @return String
     */
    public function action();
}
?>