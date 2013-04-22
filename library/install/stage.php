<?php

/**
 * install_stage
 * 
 * install_stage. Abstract class that implements basic stages interfaces.
 * 
 * @author Kornushkin Aleksei kornushkin@gmail.com
 */
	abstract class install_stage
	{
	  protected $stageName;
	  
	  protected $config;
	  
      public function __construct( $stageName )
      {
          $this->stageName = $stageName;
          
          $this->config = settings_installConfig::getSettings();
      }
      
	  public function getForm() {
	      return $this->stageName.'.phtml';
	  }
	  
	  abstract public function getFormData();
	  
	  abstract public function check();
	}
?>