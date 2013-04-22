<?php
/**
 * Интерфейс данных страницы подтверждения заказа. Описывает методы доступа к данным страницы,
 * которые отсутсвуют в данных описанных в интерфейсе IPage
 */
interface ICutConfirmationPage {
   
        /**
    * Возвращает область проживания заказчика 
    * @return string
    */
	
	public function region();
	
	/**
    * Возвращает страну проживания заказчика 
    * @return string
    */
	
	public function country();
	
	/**
    * Возвращает возвращает почтовый индекс заказчика
    * @return string
    */
	
	public function index();
	
	/**
    * Возвращает город проживания заказчика
    * @return string
    */
	
	public function city();
	
	/**
    * Возвращает адрес проживания заказчика
    * @return string
    */
	
	public function address();
	
	/**
    * Возвращает имя заказчика
    * @return string
    */
	
	public function name();
	
	/**
    * Возвращает отчество заказчика
    * @return string
    */
	
	public function patronymic();
	
	/**
    * Возвращает фамилию заказчика
    * @return string
    */
	
	public function lastname();
	
	/**
    * Возвращает номер телефона заказчика
    * @return string
    */
	
	public function phone();
	
	/**
    * Возвращает электроный адрес заказчика
    * @return string
    */
	
	public function email();
	
	/**
    * Возвращает комментарий заказчика
    * @return string
    */
	
	public function comments();
        
       /**
    * Возвращает способ доставки заказчика
    * @return IDelivery
    */	
    public function delivery();
    
    /**
    * Возвращает способ оплаты заказчика
    * @return string
    */
    public function pay();
    
     /**
    * Возвращает сумму заказа
    * @return Float
    */
    public function sum(); 
    
     /**
    * Возвращает сумму доставки заказчика
    * @return Float
    */
    public function post_pay();
    
     /**
    * Возвращает сумму тарифа на денежный перевод 
    * @return Float
    */
    public function post_tarif();

   
}

?>