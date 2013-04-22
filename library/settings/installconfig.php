<?php

/**
 * settings_installConfig
 * 
 * settings_installConfig. Carrying configuration information.
 * 
 * @author Kornushkin Aleksei kornushkin@gmail.com
 */
    class settings_installConfig
    {
        static public function getSettings()
        {
            return $config = array(
                'requirements' => array(
            
                    'php_version' => '5.2.6',
                ),
                
                'contacts' => array(
                
                    'icq'   => '450996234',
                
                    'email' => 'partners@vsemayki.ru',
                ),
            );
        }
    }
?>