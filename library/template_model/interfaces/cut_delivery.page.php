<?php
/**
 * Интерфейс объекта данных корзины. Описывает методы доступа к данным страницы,
 * которые отсутсвуют в данных описанных в интерфейсе IPage
 */
interface ICutDeliveryPage {
   
        /**
        * Возвращает Массив возможных доставок, выводящихся на странице
        * @return Array of IDelivery
        */
	
	public function delivery();
        
        /**
        * Возвращает тип доставки по-умолчанию
        * @return IDelivery
        */
	
	public function delivery_default();

   
}

?>