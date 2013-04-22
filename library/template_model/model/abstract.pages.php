<?php

abstract class AbstractPage {
    /**
     * Заголовок страницы
     * @var String
     */
    protected $title_data = '';

    /**
     * SEO данные страницы
     * @var ISeo
     */
    protected $seo_data = null;

    /**
     * Данные партнера
     * @var IPartner
     */
    protected $partner_data = null;

    /**
     * Данные окружения
     * @var IEnviroment
     */
    protected $enviroment_data = null;

    /**
     * Краткие данные корзины товаров
     * @var IBasketInfo
     */
    protected $basket_info_data = null;

    protected $menu_data = array();

    /**
     * Хранение данных новых товаров, выводимых на странице
     * @var Array of IOffer
     */
    private $novelty_data = array();
    
    

    function set_title($title){
        $this->title_data = (string) $title;
    }

    function set_seo(ISeo $seo){
        $this->seo_data = $seo;
    }

    function set_partner(IPartner $partner){
        $this->partner_data = $partner;
    }

    function set_enviroment(IEnviroment $env){
        $this->enviroment_data = $env;
    }

    function set_novelty($offers, $check = true){
        // TODO фдаг $check нужно передавать в зависимости от конфигурационного
        // параметра debug. В рабочем варианте проверка типов данных излишня
        // но при разработке и внесения изменений в код движка, данная проверка
        // нужна.
        if ($check) {
            // Если нужна проверка типа данных массива
            $this->check_is_offer_array($offers);
        }
        $this->novelty_data = $offers;
    }

    /**
     * Проверяет являится ли значение параметра, массивом с элементами реализующие
     * интерфейс IOffer
     * @param Array $offers Проверяемое значение
     * @throws Exception В случае не соответствия значения генерируется исключение, с описанием проблемы.
     */
    protected function check_is_offer_array($offers){
        if ( !is_array($offers) ) {
            throw new Exception('Не верное значение элемента. Ожидали массив.');
        }
        foreach($offers as $offer){
            if ( !($offer instanceof IOffer) ){
                throw new Exception('Не верное значение элемента. Ожидали объект реализующий интерфейс IOffer');
            }
        }
    }
    
    protected function check_is_offerСut_array($offers){
        if ( !is_array($offers) ) {
            throw new Exception('Не верное значение элемента. Ожидали массив.');
        }
        foreach($offers as $offer){
            if ( !($offer instanceof IOfferCut) ){
                throw new Exception('Не верное значение элемента. Ожидали объект реализующий интерфейс IOfferCut');
            }
        }
    }

    function set_basket_info(IBasketInfo $info){
        $this->basket_info_data = $info;
    }

     
    function add_menu($menu, $data, $check = true){
        if (!in_array($menu, $this->possible_menus()) ) {
            throw new Exception('Не известный ключь данных меню');
        }

        if ($check){
            $this->check_is_menulink_array($data);
        }

        $this->menu_data[$menu] = $data;
    }

    private function possible_menus(){
        return array(
            IPage::MenuCategory,
            IPage::MenuSubCategory,
            IPage::MenuStatic,
            IPage::MenuBreadCrumbs,
            IPage::MenuProducts
        );
    }

    /**
     * Проверяет являится ли значение параметра, массивом с элементами реализующие
     * интерфейс IMenuLink
     * @param Array $links Проверяемое значение
     * @throws Exception В случае не соответствия значения генерируется исключение, с описанием проблемы.
     */
    protected function check_is_menulink_array($links){
        if ( !is_array($links) ) {
            throw new Exception('Не верное значение элемента. Ожидали массив.');
        }
        foreach($links as $link){
            if ( !($link instanceof IMenuLink) ){
                throw new Exception('Не верное значение элемента. Ожидали объект реализующий интерфейс IMenuLink');
            }
        }
    }


    /**
     * Реализация методов интерфейса IPage
     */

    function title(){
        return $this->title_data;
    }

    function seo(){
        return $this->seo_data;
    }

    function partner(){
        return $this->partner_data;
    }

    function enviroment(){
        return $this->enviroment_data;
    }

    function basket_info(){
        return $this->basket_info_data;
    }

    function menu($menu = 4){
        if (!in_array($menu, $this->possible_menus()) ) {
            throw new Exception('Не известный ключь данных меню');
        }

        if ( array_key_exists($menu, $this->menu_data) ){
            return $this->menu_data[$menu];
        } else {
            return array();
        }
    }

    function novelty(){
        return $this->novelty_data;
    }
    
   
}

abstract class AbstractPageWithOffersAndPagginator extends AbstractPage {
    /**
     * Хранение данных товаров, выводимых на странице
     * @var Array of IOffer
     */
    protected $offers_data = array();
    /**
     * Хранение данных пагинации
     * @var IPagginator
     */
    protected $pagginator_data = null;

    function set_offers($offers, $check = true){
        // TODO фдаг $check нужно передавать в зависимости от конфигурационного
        // параметра debug. В рабочем варианте проверка типов данных излишня
        // но при разработке и внесения изменений в код движка, данная проверка
        // нужна.
        if ($check) {
            // Если нужна проверка типа данных массива
            $this->check_is_offer_array($offers);
        }
        $this->offers_data = $offers;
    }

    function set_pagginator(IPagginator $paginator){
        $this->pagginator_data = $paginator;
    }

    /**
     * Реализация методов интерфейса IIndexPage
     */

    function offers(){
        return $this->offers_data;
    }

    function pagginator(){
        return $this->pagginator_data;
    }
}

abstract class AbstractPageCutOffers extends AbstractPage {
    /**
     * Хранение данных товаров, выводимых в корзине
     * @var Array of IOfferCut
     */
    protected $offers_data = array();
    
   

    function set_offers($offers, $check = true){
       
        if ($check) {
            
            $this->check_is_offerСut_array($offers);
        }
        $this->offers_data = $offers;
    }

   
    /**
     * Реализация методов интерфейса ICutPage
     */

    function offers(){
        return $this->offers_data;
    }

   
}



?>