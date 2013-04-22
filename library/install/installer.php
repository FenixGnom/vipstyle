<?php

/**
 * install_installer
 * 
 * install_installer. Manages installation proccess.
 * 
 * @author Kornushkin Aleksei kornushkin@gmail.com
 */
	class install_installer
	{
	  private $stage;
	  
	  public function __construct( $stageName )
	  {
	      $this->stage = install_stageFactory::getInstance( $stageName );
	  }
	  
	  static public function checkFirstRun()
	  {
	      $f=fopen('config.php','r');
	      $config_text = fread( $f, 5000 );
	      $match = '';
	      preg_match("/PartnerSalt = \'(.*)\'/", $config_text, $match);
	      fclose($f);
	      return $match[1] ? false : true;
	  }
	  
	  public function checkValues()
	  {
	      return $this->stage->check();
	  }
	  
	  public function showForm( $error = false )
	  {  
	      $data = array();
	      $data = $this->stage->getFormData();
	      if ( $error )
	      {
	          $data['note'] = $error;
	      }
	      $form = $this->stage->getForm();
	      $data['stage'] = $form;
		 
	       if(file_exists('install/install.phtml'))	      
		{	
			
			$view = new View();			
			return  $view->Render( 'install.phtml',$data);	
		
		}	  
		  else
		  {
			$view = new View();
			echo $view->Render('../noinstall.phtml',$data);		
		  }
	  }
	    
	}
?>