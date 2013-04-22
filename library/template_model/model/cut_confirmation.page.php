<?php
include_once dirname(__FILE__).'/../interfaces/cut_confirmation.page.php';
include_once dirname(__FILE__).'/abstract.pages.php';

/**
 * класс реализующий хранение и выдачу данных на странице подтверждения заказа
 */
class CutConfirmationPageStorage extends AbstractPage implements IPage, ICutConfirmationPage {
   
     /**
     * Регион пользователя
     * @var String
     */
    protected $region='';
     /**
     * Страна пользователя
     * @var String
     */
    protected $country='';
    
     /**
     * Индекс пользователя
     * @var String
     */
    protected $indeks='';
    
     /**
     * Город пользователя
     * @var String
     */
    protected $city='';
    
     /**
     * Адрес пользователя
     * @var String
     */
    protected $address='';
    
     /**
     * Имя пользователя
     * @var String
     */
    protected $name='';
    
     /**
     * Отчество пользователя
     * @var String
     */
    protected $patronymic='';
    
     /**
     * Фамилия пользователя
     * @var String
     */
    protected $lastname='';
    
     /**
     * Электронный адрес пользователя
     * @var String
     */
    protected $email='';
    
     /**
     * Телефон пользователя
     * @var String
     */
    protected $phone='';
    
     /**
     * Комментарий пользователя
     * @var String
     */
    protected $comments=''; 
    
    /**
     * Способ доставки,выбранный пользователем
     * @var String
     */
    protected $delivery='';   
    
    
    /**
     * Способ оплаты,выбранный пользователем
     * @var String
     */
    protected $pay=''; 
    
    /**
     * Общая сумма заказа
     * @var Float
     */
    protected $sum=''; 
    
    /**
     * Сумма за доставку, при выбранном типе оплаты "Оплата при получении" и доставки почтой
     * @var Float
     */
    protected $post_pay='';
    
    /**
     * Тариф на денежные переводы, при выбранном типе оплаты "Оплата при получении" и доставки почтой
     * @var Float
     */
    protected $post_tarif='';


    public function set_region($region)
    {
        $this->region=(string) $region;
    }
    public function set_country($country)
    {
        $this->country=(string) $country;
    }
    public function set_index($index)
    {
        $this->indeks=(string) $index;
    }
    
    public function set_city($city)
    {
        $this->city=(string) $city;
    }
    
    public function set_address($address)
    {
        $this->address=(string) $address;
    }
    
    public function set_name($name)
    {
        $this->name=(string) $name;
    }
    public function set_patronymic($patronamic)
    {
        $this->patronymic=(string) $patronamic;
    }
    
    public function set_lastname($lastname)
    {
        $this->lastname=(string) $lastname;
    }
    
    public function set_phone($phone)
    {
       $this->phone=(string) $phone;
    }
    public function set_email($email)
    {
       $this->email=(string) $email;
    }
    public function set_comments($comments)
    {
        $this->comments=(string) $comments;
    } 
    
    public function set_summ($summ)
    {
        $this->sum=(float) $summ;
    }
    public function set_delivery(IDelivery $delivery)
    {
        $this->delivery=$delivery;
    } 
    
    public function set_pay($pay)
    {
        $this->pay=(string) $pay;
    }
    
    public function set_post_delivery($post)
    {
        $this->post_pay=(float) $post;
    }
    
    public function set_post_tarif($tarif)
    {
        $this->post_tarif=(float) $tarif;
    }
    
    public function region()
    {
        return $this->region;
    }
    public function country()
    {
        return $this->country;
    }
    
    public function index()           
    {
        return $this->indeks;
    }
    public function city()
    {
        return $this->city;
    }
    public function address()
    {
        return $this->address;
    }
    public function name()
    {
        return $this->name;
    }
    public function patronymic()
    {
        return $this->patronymic;
    }
    public function lastname()
    {
        return $this->lastname;
    }
    public function phone()
    {
        return $this->phone;
    }
    public function email()
    {
        return $this->email;
    }
    public function comments()
    {
        return $this->comments;
    } 
    
    public function delivery()
    {
        return $this->delivery;
    } 
    
    public function pay()
    {
        return $this->pay;
    } 
    
    public function sum()
    {
        return $this->sum;
    } 
    public function post_pay()
    {
        return $this->post_pay;
    }
    public function post_tarif()
    {
        return $this->post_tarif;
    }
}

?>