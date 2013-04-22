<?php
include_once dirname(__FILE__).'/../interfaces/cut_address.page.php';
include_once dirname(__FILE__).'/abstract.pages.php';

/**
 * Пример класса реализующего хранение и выдачу данных страницы категории
 */
class CutAdressPageStorage extends AbstractPage implements IPage, ICutAddressPage {
   
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
}

?>