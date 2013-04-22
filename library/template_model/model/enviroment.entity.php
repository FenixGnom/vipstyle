<?php

include_once dirname(__FILE__).'/../interfaces/enviroment.entity.php';

class EnviromentStorage implements IEnviroment {
    private $path_data = '';
    private $version_data = '';
    private $page = '';
    private $action = '';

    function __construct($path, $version,$page,$action){
        $this->path_data = (string) $path;
        $this->version_data = (string) $version;
        $this->page = (string) $page;
        $this->action = (string) $action;
       
    }

    function theme_path() {
        return $this->path_data;
    }

    function version() {
        return $this->version_data;
    }
    
    public function page()
    {
        return $this->page;		
    }
    public function action()
    {	
        return  $this->action;		
    }
    
    
}
?>