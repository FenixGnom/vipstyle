<?php

class Shop_Memcache
{   
    /**
     * Экземпляр класса для работы с memcache сервером
     * @var Memcache|Memcached
     */
    public $cache=null;
    
    /**
     * Тип установленного эстеншена для работы со службой Memcache
     * @var boolean|String
     */
    public $type_cache='';
    function __construct()
    {
            $this->type_cache=$this->is_cached();
            if($this->type_cache)
            $this->cache=new $this->type_cache;
    }
    /**
     * Возвращает тип установленного эстеншена для работы со службой Memcache
     * @return Boolean|Any
     */
    
    public  function is_cached()
    {	
            if(!extension_loaded('memcache'))
            {
                    if(!extension_loaded('memcached'))
                            return false;
                    else
                            return 'Memcached';
            }
            else
                    return 'Memcache';
    }
     /**
     * Проверяем соединения с memcache или memcached сервером
     * @return Boolean;
     */
    public function connect($host,$port)
    {
        
        if($this->type_cache)
        {
           if($this->type_cache=='Memcache')
               $this->cache->connect ($host, $port);
           else 
               $this->cache->addServer ($host, $port);
           return true;
        }
        return false;

    }
    /**
     * Запись значения в memcache или memcached 
     * @param String $cacheName -Ключ
     * @param Any $value - значение
     * @param Integer $lifeTime -время жизни в секундах
     */
    public function set($cacheName,$value,$lifeTime)
    {
        if($this->type_cache=='Memcache')
            $this->cache->set($cacheName, $value, false, $lifeTime);
        else 
            $this->cache->set($cacheName, $value, $lifeTime);
    }
    /**
     * Получение значения из memcache
     * @param String $cacheName - Кэш Ключь
     * @return Boolean|Any
     */
    public function get($cacheName)
    {
        $value=$this->cache->get($cacheName);
        if(!$value)
          return false;
        return $value;
    }
    /**
     * Закрытие соединения с серверов     
     */
    public function close()
    {
        if($this->type_cache=='Memcache')
            $this->cache->close();           

    }
    /**
     * Очистка memcache      
     */
    public function fetch()
    {
       $this->cache->flush();
    }
	
}

?>