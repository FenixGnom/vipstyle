<?php
include_once dirname(__FILE__).'/../interfaces/static.page.php';
include_once dirname(__FILE__).'/abstract.pages.php';

/**
 * Пример класса реализующего хранение и выдачу данных статической страницы
 */
class StaticPageStorage extends AbstractPage implements IPage, IStaticPage {
    /**
     * Контент страницы
     * @var String
     */
    protected $data = '';

    function set_content($content){
        $this->data = (string) $content;
    }

    /**
     * Реализация методов интерфейса IStaticPage
     */

    function content() {
        return $this->data;
    }
}
?>