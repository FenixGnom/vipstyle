<?php 
include_once dirname(__FILE__).'/../interfaces/feetback.page.php';
include_once dirname(__FILE__).'/abstract.pages.php';

/**
 * Пример класса реализующего хранение и выдачу данных страницы обратной связи
 */
class FeedbackPageStorage extends AbstractPage implements IPage, IFeetbackPage {
    
    /**
     * Хранение данных о ошибке в имени
     * @var String
     */
    protected $error_name = '';
   
   /**
     * Хранение данных о ошибке в электронном адресе
     * @var String
     */
    protected $error_email = '';
    
    /**
     * Хранение данных о ошибке в сообщении
     * @var String
     */
    protected $error_message = '';
    
    /**
     * Хранение данных о ошибке в каптче
     * @var String
     */
    protected $error_captcha = '';
    
    /**
     * Хранение имени пользователя 
     * @var String
     */
    protected $data_name = '';
    
     /**
     * Хранение электронного адреса пользователя 
     * @var String
     */
    protected $data_email = '';
    
     /**
     * Хранение сообщения пользователя 
     * @var String
     */
    protected $data_message = '';
    
     /**
     * Хранение значения каптчи 
     * @var String
     */
    protected $data_captcha = '';
    
    /**
     * Хранение данных пользователя, выводимых на странице
     * @var Boolean
     */
    protected $result = false;

    function set_error_name($error){       
        $this->error_name =(string) $error;
    }
    
    function set_error_email($error){       
        $this->error_email =(string) $error;
    }
    
    function set_error_message($error){       
        $this->error_message =(string) $error;
    }
    
    function set_error_captcha($error){       
        $this->error_captcha =(string) $error;
    }
    
    function set_data_name($data){       
        $this->data_name =(string) $data;
    }
    
    function set_data_email($data){       
        $this->data_email =(string) $data;
    }
    
    function set_data_message($data){       
        $this->data_message =(string) $data;
    }
    function set_data_captcha($data){       
        $this->data_captcha =(string) $data;
    }
   
    function set_result($result){  
      
        $this->result =(boolean) $result;
    }
    
      
    /**
     * Реализация методов интерфейса IFeetbackPage
     */
     function name_error(){       
        return $this->error_name;
    }
    
    function email_error(){       
        return  $this->error_email;
    }
    
    function message_error(){       
        return  $this->error_message;
    }
    
    function captcha_error(){       
        return  $this->error_captcha;
    }
    
    function name(){       
        return $this->data_name;
    }
    
    function email(){       
        return $this->data_email;
    }
    
    function message(){       
        return $this->data_message;
    }
    function captcha(){       
       return 'number.php?code='.$this->data_captcha;
    }
    
    function is_result(){     
      
        return $this->result;
    }
    
}

?>