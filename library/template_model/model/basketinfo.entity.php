<?php

include_once dirname(__FILE__).'/../interfaces/basketinfo.entity.php';

class BasketStorage implements IBasketInfo {
    private $amount_data = 0;
    private $price_data = 0;

    function __construct($amount, $price){
        $this->amount_data = (int) $amount;
        $this->price_data = (float) $price;
    }

    function amount() {
        return $this->amount_data;
    }

    function price() {
        return $this->price_data;
    }

    function url() {
        return '/cut';
    }
}
?>