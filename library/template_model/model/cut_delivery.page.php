<?php
include_once dirname(__FILE__).'/../interfaces/cut_delivery.page.php';
include_once dirname(__FILE__).'/abstract.pages.php';

/**
 * Пример класса реализующего хранение и выдачу данных страницы категории
 */
class CutDeliveryPageStorage extends AbstractPage implements IPage, ICutDeliveryPage {
   
     /**
     * Хранение данных о доступных доставках, выводимых на странице
     * @var Array of IDelibery
     */
    protected $delivery='';
    
    /**
     * Хранение данных о способе доставки по-умолчанию
     * @var IDelivery
     */
    protected $delivery_user='';
  
   
    public function set_delivery($delivery,$check)
    {
        if ($check) {
            
            $this->check_is_delivery_array($delivery);
        }
        $this->delivery = $delivery;
    }
    
    public function set_delivery_default(IDelivery $delivery)
    {
        $this->delivery_user=$delivery;
    }
    
    public function delivery()
    {
        return $this->delivery;
    }
    
    public function delivery_default() 
    {
        return $this->delivery_user;
    }
    
    protected function check_is_delivery_array($delivery){
        if ( !is_array($delivery) ) {
            throw new Exception('Не верное значение элемента. Ожидали массив.');
        }
        foreach($delivery as $data){
            if ( !($data instanceof IDelivery) ){
                throw new Exception('Не верное значение элемента. Ожидали объект реализующий интерфейс IDelivery');
            }
        }
    }
   
}

?>