<?php
/**
 * Интерфейс объекта с данными о оплате 
 */
interface IPayPage {
    /**
    * Возвращает значение типа оплаты по-умолчанию 
    * @return string
    */
	
     public function pay_default();
	
    /**
    * Возвращает сумму при оплате для типа "Оплата при получении" 
    * @return string
    */
	
     public function post();
     
     
     /**
    * Возвращает сумму доставки для типа "Оплата при получении" 
    * @return string
    */
	
     public function post_delivery();
     
      /**
    * Возвращает сумму тарифа на денежный перевод при оплате для типа "Оплата при получении" 
    * @return string
    */
	
     public function post_tarif();
     
     
     /**
    * Возвращает сумму при оплате для типа "Предоплата" 
    * @return string
    */
	
     public function prepay();
	
	
	

   
}
?>