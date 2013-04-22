<?php

include_once dirname(__FILE__).'/../interfaces/partner.entity.php';

class PartnerStorage implements IPartner {
    private $name_data = '';
    private $phone_data = '';
    private $email_data = '';
    private $icq_data = '';

    function __construct($name, $phone, $email, $icq){
        $this->name_data = (string) $name;
        $this->phone_data = (string) $phone;
        $this->email_data = (string) $email;
        $this->icq = (string) $icq;
    }

    function shop_name(){
        return $this->name_data;
    }

    function contact_phone(){
        return $this->phone_data;
    }

    function contact_email(){
        return $this->email_data;
    }

    function contact_icq(){
        return $this->icq_data;
    }
}
?>