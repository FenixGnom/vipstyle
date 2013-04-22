<?php
include_once dirname(__FILE__).'/../interfaces/category.page.php';
include_once dirname(__FILE__).'/abstract.pages.php';

/**
 * Пример класса реализующего хранение и выдачу данных страницы категории
 */
class CategoryPageStorage extends AbstractPageWithOffersAndPagginator implements IPage, ICategoryPage {
    /**
     * Название категории
     * @var String
     */
    protected $category_name_data = '';
    
    /**
     * Описание категории
     * @var String
     */
    protected $category_desc_data = '';

    function set_category_name($name){
        $this->category_name_data = (string) $name;
    }
    
    function set_category_desc($desc){
        $this->category_desc_data = (string) $desc;
    }

    /**
     * Реализация методов интерфейса ICategoryPage отсутсвующих в абстракном классе
     * AbstractPageWithOffersAndPagginator
     */

    function category_name() {
        return $this->category_name_data;
    }
    
    function category_desc(){
        return $this->category_desc_data;
    }
}

?>