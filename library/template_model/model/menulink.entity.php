<?php
include_once dirname(__FILE__).'/../interfaces/menulink.entity.php';

class MenuLinkStorage implements IMenuLink {
    private $name_data = '';
    private $url_data = '';
    private $current_data = '';
    private $target_data='';

    function __construct($name, $url, $current = false,$target=false){
        $this->name_data = (string) $name;
        $this->url_data = (string) $url;
        $this->current_data = (boolean) $current;
        $this->target_data = (boolean) $target;
    }

    function name() {
        return $this->name_data;
    }

    function url() {
        return $this->url_data;
    }

    function is_selected() {
        return $this->current_data;
    }
    
    function is_target() {
        return $this->target_data;
    }
}
?>