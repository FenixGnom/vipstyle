<?php
/**
 * Интерфейс объекта данных  страницы обратной связи. Описывает методы доступа к данным страницы,
 * которые отсутсвуют в данных описанных в интерфейсе IPage
 */
interface IFeetbackPage {
        
    /**
     * Возвращает ошибку в имени пользователя
     * @return String
     */
    function name_error();

    /**
     * Возвращает ошибку в электронном адресе пользователя
     * @return String
     */
    function email_error();

    /**
     * Возвращает ошибку в сообщении пользователя
     * @return String
     */
    function message_error();

    /**
     * звращает ошибку в значении captcha 
     * @return String
     */
    function captcha_error();
    
      /**
     * Возвращает  имя пользователя
     * @return String
     */
    function name();

    /**
     * Возвращает электронный адрес пользователя
     * @return String
     */
    function email();

    /**
     * Возвращает  сообщение пользователя
     * @return String
     */
    function message();

    /**
     * Возвращает  значение captcha 
     * @return String
     */
    function captcha(); 
    
    /**
     * Возвращает результат обработки данных
     * @return Boolean
     */
    function is_result();

    
}

?>