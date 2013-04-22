<?php
include_once dirname(__FILE__).'/seo.entity.php';
include_once dirname(__FILE__).'/partner.entity.php';
include_once dirname(__FILE__).'/enviroment.entity.php';
include_once dirname(__FILE__).'/basketinfo.entity.php';
include_once dirname(__FILE__).'/menulink.entity.php';
include_once dirname(__FILE__).'/paginator.entity.php';
include_once dirname(__FILE__).'/offer.entity.php';

/**
 * Базовый интерфейс который должен поддерживать объект данных, любой страницы
 */
interface IPage {
    /**
     * Идентификатор меню, содержащего ссылки на страницы категорий
     */
    const MenuCategory = 1;

    /**
     * Идентификатор меню, содержащего ссылки на страницы подкатегорий
     */
    const MenuSubCategory = 2;

    /**
     * Идентификатор меню, содержащего ссылки на страницы продукттипов
     */
    const MenuProducts = 3;

    /**
     * Идентификатор меню, содержащего сылки на статические страницы
     */
    const MenuStatic = 4;

    /**
     * Идентификатор меню, содержащего ссылки на страницы, по типу "Хлебных Крошек"
     */
    const MenuBreadCrumbs = 5;

    /**
     * Возвращает заголовок html страницы
     * @return String
     */
    function title();

    /**
     * Возвращает объект SEO данных страницы
     * @return ISeo
     */
    function seo();

    /**
     * Возвращает объект с информацией о владельце витрины.
     * @return IPartner
     */
    function partner();

    /**
     * Возвращает объект с информацией об окружении.
     * @return IEnviroment
     */
    function enviroment();

    /**
     * Возвращает Краткую информацию о данных в корзине.
     * @return IBasketInfo
     */
    function basket_info();

    /**
     * Возвращает Коллекцию ссылок указанного меню.
     * @param $menu Integer Тип коллекции. В качестве значений может быть одно
     * из значений констант интерфейса MenuCategory, MenuSubCategory,
     * MenuProducts, MenuStatic, MenuBreadCrumbs
     * @return Array of IMenuLink
     */
    function menu($menu = 4);

    /**
     * Возвращает Массив товаров, являющихся новинками
     * @return Array of IOffer
     */
    function novelty();    
    
}

?>