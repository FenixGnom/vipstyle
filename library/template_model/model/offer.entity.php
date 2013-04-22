<?php

include_once dirname(__FILE__).'/../interfaces/offer.entity.php';

class OfferStorage implements IOffer {
    private $id_data = 0;
    private $name_data = '';
    private $image_data = '';
    private $url_data = '';
    private $price_data = 0;

    function __construct($id, $name, $price, $image, $url){
        $this->id_data = (int) $id;
        $this->price_data = (string) $price;
        $this->name_data = (string) $name;
        $this->image_data = (string) $image;
        $this->url_data = (string) $url;
    }

    function id() {
        return $this->id_data;
    }

    function name() {
        return $this->name_data;
    }

    function price() {
        return $this->price_data;
    }

    function image_url() {
        return $this->image_data;
    }

    function url() {
        return $this->url_data;
    }
}

?>