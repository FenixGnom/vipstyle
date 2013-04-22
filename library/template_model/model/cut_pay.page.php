<?php
include_once dirname(__FILE__).'/../interfaces/pay.page.php';
include_once dirname(__FILE__).'/abstract.pages.php';

/**
 * Пример класса реализующего хранение и выдачу данных страницы категории
 */
class CutPayPageStorage extends AbstractPage implements IPage, IPayPage {
   
     /**
     * Хранение данных о способе оплаты по-умолчанию
     * @var String
     */
    protected $pay_default='';
    
    /**
     * Хранение данных о способе оплаты по-умолчанию
     * @var Float
     */
    protected $post=0;
    
    /**
     * Хранение данных о способе оплаты по-умолчанию
     * @var Float
     */
    protected $post_delivery=0;
    
     /**
     * Хранение данных о способе оплаты по-умолчанию
     * @var Float
     */
    protected $post_tarif=0;
    
     /**
     * Хранение данных о способе оплаты по-умолчанию
     * @var Float
     */
    protected $prepay=0;




    public function set_pay_default($data)
    {
        $this->pay_default=(string) $data;
    }
	
     public function set_post($data)
     {
        $this->post=(float) $data;
     }        
	
     public function set_post_delivery($data)
     {
        $this->post_delivery=(float) $data;
     }
	
     public function set_post_tarif($data)
     {
         $this->post_tarif=$data;
     }
	
     public function set_prepay($data)
     {
         $this->prepay=$data;
     }
     
     
      /**
     * Реализация методов интерфейса IPay
     */

    public function pay_default()
    {
        return $this->pay_default;
    }
	
     public function post()
     {
        return $this->post;
     }        
	
     public function post_delivery()
     {
         return $this->post_delivery;
     }
	
     public function post_tarif()
     {
         return $this->post_tarif;
     }
	
     public function prepay()
     {
         return $this->prepay;
     }
   
}

?>