<?php

class Cache
{
    /**
     * Счетчик работы кэша
     * @var Array
     */
    static private $counter = null;
    /**
     * Метод кэширования через Memcache
     */
    const MemoryType = 'memory';
    /**
     * Метод кэширования, в файлах
     */
    const FileType = 'file';

    /**
     * Метод кэширования. Одно из двух значений [self::MemoryType | self::FileType ]
     * @var String
     */
	private $type = null;

    /**
     * Директория хранения (относительно DOCUMENT_ROOT) файлов кэша, для
     * метода кэширования в файлах
     * @var String
     */
	private $dir = null;

    /**
     * Хост или ip адрес, memcache сервера.
     * Для метода кэширования через memcache
     * @var String
     */
	private $Server = null;

    /**
     * Порт memcache сервера.
     * Для метода кэширования через memcache
     * @var Integer
     */
	private $Port = null;

    /**
     * Время жизни кэша в секундах.
     * Для метода кэширования через memcache
     * @var Integer
     */
	private $cacheLife = 86400;

    /**
     * Экземпляр класса для работы с memcache сервером
     * @var Memcache
     */
    private $memcache = null;

	function __construct () {
        // Получаем конфигурационные параметры кэширования
		$cache_settings = Registry::getParam('cache_settings');
        // Настраиваем объект
		$this->dir = $cache_settings['dir'];

        if ( in_array($cache_settings['typeCaching'], array(self::FileType, self::MemoryType)) ){
            $this->type = $cache_settings['typeCaching'];
        } else {
            // Не изветный метод кэширования, используем метод основаный на файлах
            $this->type = self::FileType;
        }

		$this->Server = $cache_settings['CachingIp'];
		$this->Port = $cache_settings['CachingPort'];

        if($this->type == self::MemoryType) {
           
            $this->memcache=new Shop_Memcache();
           
            // Проверяем соединения с memcache сервером
            if( !$this->memcache->connect($this->Server, $this->Port) ) {
                // Нет соединения с кэш сервером используем метод хранения кэша
                // на файлах
                $this->type = self::FileType;
                $this->memcache = null;
            }
        }

        if ( is_null(self::$counter) ){
            $this->init_counter();
        }
	}

    private function init_counter(){
        self::$counter = array(
            // Количество установок кэша
            'write' => 0,
            // Количество обращений на чтение, при отсутсвии кэша
            'not_exists' => 0,
            // Количество удачных чтений с кэша
            'read' => 0
        );
    }

    /**
     * Возвращает значение из кэша по ключу или false при его отсутсвии
     * @param String $cacheName - Кэш Ключь
     * @return Boolean|Any
     */
	public function Load($cacheName) {
        $method_name = 'get_from_'.$this->type;
        return $this->$method_name($cacheName);
	}

    /**
     * Получение значения из memcache
     * @param String $cacheName - Кэш Ключь
     * @return Boolean|Any
     */
    private function get_from_memory($cacheName){
        // Так как ключ для файлом содержит в себе часть пути к фалу кэша,
        // Переводим его в хэш вид, для удаление лишних символов
        $cacheName = md5($cacheName);
        $value = $this->memcache->get($cacheName);

        if( !$value ) {
            self::$counter['not_exists'] += 1;
            return false;
        } else {
            self::$counter['read'] += 1;
            return unserialize($value);
        }
    }

    /**
     * Получение значения из кэш файла
     * @param String $cacheName - Кэш Ключь
     * @return Boolean|Any
     */
    private function get_from_file($cacheName){
        $value = false;
        if (!$value = @file_get_contents($_SERVER["DOCUMENT_ROOT"].$this->dir . $cacheName . '.dat')) {
            self::$counter['not_exists'] += 1;
            return false;
        }
        self::$counter['read'] += 1;
        return unserialize($value);
    }

    /**
     * Записывает значение в кэш по ключу
     * @param Any $value - Записываемое значение
     * @param String $cacheName - Кэш Ключь
     */
	public function Save ($value, $cacheName) {
		if ($cacheName == '') return false;

		$method_name = 'set_to_'.$this->type;
        return $this->$method_name($value, $cacheName);
	}

    /**
     * Записывает значение в memcache
     * @param Any $value - Записываемое значение
     * @param String $cacheName - Кэш Ключь
     */
    private function set_to_memory($value, $cacheName){
        $value = serialize($value);
        // Так как ключ для файлом содержит в себе часть пути к фалу кэша,
        // Переводим его в хэш вид, для удаление лишних символов
        $cacheName = md5($cacheName);
        $this->memcache->set($cacheName, $value, false, $this->cacheLife);
        self::$counter['write'] += 1;
    }

    /**
     * Записывает значение в файл кэш
     * @param Any $value - Записываемое значение
     * @param String $cacheName - Кэш Ключь
     */
    private function set_to_file($value, $cacheName){
        $value = serialize($value);
        if( $file = fopen ($_SERVER["DOCUMENT_ROOT"].$this->dir . $cacheName . '.dat' , 'w') ){
            fwrite($file, $value);
            fclose($file);
            chmod($_SERVER["DOCUMENT_ROOT"].$this->dir . $cacheName . '.dat',0777);
            self::$counter['write'] += 1;
        }
    }

    /**
     * Возвращает колличество чтений с кэша, указаного типа
     * @param Boolean $exists Тип чтений, true - существующих записей в кэше, false - чтение отсутсвующих в кэша данных
     * @return Integer
     */
    static public function read_counter($exists = true){
        if ( $exists ){
            return self::$counter['read'];
        } else {
            return self::$counter['not_exists'];
        }
    }

    /**
     * Возвращает колличество записей в кэш
     * @return Integer
     */
    static public function write_counter(){
        return self::$counter['write'];
    }

	function __destruct() {
        if($this->type == self::MemoryType) {
            $this->memcache->close();
        }
    }
}

?>