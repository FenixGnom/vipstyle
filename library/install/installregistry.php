<?php

/**
 * install_InstallRegistry
 * 
 * install_InstallRegistry. Registry for saving installing information.
 * 
 * @author Kornushkin Aleksei kornushkin@gmail.com
 */
	class Install_InstallRegistry
	{
    	static public function setParam( $key, $val )
    	{
    	    return $_SESSION[ $key ] = $val;
    	}
    	
    	static public function getParam( $key )
    	{
    	    if(isset($_SESSION[ $key ]))
            return $_SESSION[ $key ];
            else return '';
    	}
    	
    	static public function saveArray( $data )
    	{
    	  foreach ( $data as $k => $v )
	      {
	          self::setParam( $k,  $v);
	      }
    	}
	}
?>