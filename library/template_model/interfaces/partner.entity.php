<?php

/**
 * Интерфейс объекта с данными о партнере (владельце партнерской витрины)
 */
interface IPartner {
    /**
     * Возвращает название витрины
     * @return String
     */
    function shop_name();

    /**
     * Возвращает контактный номер телефона
     * @string
     */
    function contact_phone();

    /**
     * Возвращает контактный адрес электронной почты
     * @string
     */
    function contact_email();

    /**
     * Возвращает контактный ICQ номер
     * @string
     */
    function contact_icq();
}
?>