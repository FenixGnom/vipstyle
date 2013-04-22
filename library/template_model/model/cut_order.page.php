<?php
include_once dirname(__FILE__).'/../interfaces/cut_order.page.php';
include_once dirname(__FILE__).'/abstract.pages.php';

/**
 * Пример класса реализующего хранение и выдачу данных страницы категории
 */
class CutOrderPageStorage extends AbstractPage implements IPage, ICutOrderPage {
   
     /**
     * Хранение номера заказа
     * @var Integer
     */
    protected $order='';
    
     /**
     * Хранение электронного адреса пользователя
     * @var String
     */
    protected $email='';
    
    /**
     * Хранение результат отправки заказа 
     * @var Boolean
     */
    protected $result='';
    
     /**
     * Хранение ответа сервера 
     * @var String
     */
    protected $answer='';
    
    




    public function set_order($data)
    {
        $this->order=(int) $data;
    }
    
    public function set_email($data)
    {
        $this->email=(string) $data;
    }
    
    public function set_result($data)
    {
        $this->result=(boolean) $data;
    }
    
    public function set_answer($data)
    {
        $this->answer=(string) $data;
    }
	
    
     
     
      /**
     * Реализация методов интерфейса ICutOrderPage
     */

    public function order()
    {
        return $this->order;
    }
    
    public function email()
    {
        return $this->email;
    }
    
    public function is_result()
    {
        return $this->result;
    }
    
    public function answer()
    {
        return $this->answer;
    }
	
    
   
}

?>