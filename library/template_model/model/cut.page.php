<?php
include_once dirname(__FILE__).'/../interfaces/cut.page.php';
include_once dirname(__FILE__).'/abstract.pages.php';

/**
 * Пример класса реализующего хранение и выдачу данных страницы категории
 */
class CutPageStorage extends AbstractPageCutOffers implements IPage, ICutPage {
    /**
     * Общее число товаров в корзине
     * @return Integer
     */
    protected $count_offer = 0;
    
    /**
     * Общая сумма денег за товары
     * @return Float
     */
    protected $sum_offer = 0;
    
     /**
     * Хранение информации о доствке 
     * @return Array of IDeliveryInfo
     */
    protected $deliveryinfo = null;
    

   
    
   
    function set_count_offer_set_($count){
        $this->count_offer = (int) $count;
    }
    
     function set_sum_offer_set_($count){
        $this->sum_offer = (float) $count;
    }
    
    function set_deliveryinfo($info){       
      
        $this->deliveryinfo = $info;    
        
    }
    
   
    /**
     * Реализация методов интерфейса ICutPage отсутсвующих в абстракном классе
     * AbstractPageCutOffers
     */

    function count() {
        return $this->count_offer;
    }
    function sum() {
        return $this->sum_offer;
    }
   function deliveryinfo(){
        
      return $this->deliveryinfo;    
        
    }
    
    
}

?>