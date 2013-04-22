<?php
include_once dirname(__FILE__).'/../interfaces/seo.entity.php';

class SeoStorage implements ISeo {
    private $keywords_data = '';
    private $description_data = '';

    function __construct($description, $keywords){
        $this->description_data = (string) $description;
        $this->keywords_data = (string) $keywords;
    }

    function keywords() {
        return $this->keywords_data;
    }

    function description() {
        return $this->description_data;
    }
}

?>