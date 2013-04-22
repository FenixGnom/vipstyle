<?php
include_once dirname(__FILE__).'/../interfaces/index.page.php';
include_once dirname(__FILE__).'/abstract.pages.php';

/**
 * Пример класса реализующего хранение и выдачу данных Главной страницы
 */
class IndexPageStorage extends AbstractPageWithOffersAndPagginator implements IPage, IIndexPage {
}
?>