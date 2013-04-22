<?php

/**
 * install_requirements
 * 
 * install_requirementsStage. Requirements installation stage.
 * 
 * @author Kornushkin Aleksei kornushkin@gmail.com
 */
	class install_requirementsStage extends install_stage
	{
	  public function check()
	  {
	      install_installRegistry::setParam( 'stage_name',  'database');
	      $this->stageName = 'database';
	      return false;
	  }
	  
	  private function checkPermissions( $file, $perm, $class, &$data, &$flag )
	  {
	     	  
	      if ( is_writable($file) )
	      {	    
			  $data[$class]['text'] = '777';
	          $data[$class]['correct'] = 'yes';
	      }
	      else
	      {
	         
			  $data[$class]['text'] = "(выставьте права 777)";
	          $data[$class]['correct'] = 'no';
	          $flag = true;
	      }
	  }
	  
	  public function getFormData()
	  {
	      $data = array();
	      
	      $check_failure_flag = false;
	      
	      //checking file permissions
	      $this->checkPermissions('config.php', '777', 'config', $data, $check_failure_flag);
	      $this->checkPermissions('cache', '777', 'cache', $data, $check_failure_flag);
	      $this->checkPermissions('cache/files', '777', 'files', $data, $check_failure_flag);
	      $this->checkPermissions('cache/catalog', '777', 'cachecatalog', $data, $check_failure_flag);
	      $this->checkPermissions('catalog/offers', '777', 'catalogoffer', $data, $check_failure_flag);
	      $this->checkPermissions('update', '777', 'catalogupdate', $data, $check_failure_flag);
              $this->checkPermissions('error', '777', 'catalogerror', $data, $check_failure_flag);
	      $this->checkPermissions('catalog', '777', 'catalog', $data, $check_failure_flag);
              $this->checkPermissions('templates_c', '777', 'templates_c', $data, $check_failure_flag);
	      
	      //Getting PHP version information
	      if ( strnatcmp( phpversion(), $this->config['requirements']['php_version'] ) >= 0)
          {
              $data['php']['correct'] = 'yes';
          }
          else
          {
              $data['php']['correct'] = 'no';
              $check_failure_flag = true;
          }
          $data['php']['text'] = phpversion();
          
	      //Getting GD library version information
          $gdinfo = gd_info();
          if ( $gdinfo['GD Version'] )
          {
              $data['gd']['text'] = $gdinfo['GD Version'];
              $data['gd']['correct'] = 'yes';
          }
          else
          {
              $data['gd']['text'] = 'Нет';
              $data['gd']['correct'] = 'no';
              $check_failure_flag = true;
          }
          
          //Checking mysqli module
          try
          {
              mysqli_init();
              $data['mysqli']['text'] = 'Доступен';
              $data['mysqli']['correct'] = 'yes';
          }
          catch ( Exception $e )
          {
              $data['mysqli']['text'] = 'Нет';
              $data['mysqli']['correct'] = 'no';
              $check_failure_flag = true;
          }
          if(!function_exists('curl_init'))
          {
              $data['curl']['text'] = 'Нет';
              $data['curl']['correct'] = 'no';
              $check_failure_flag = true;
          }
          else
          {
              $data['curl']['text'] = 'Доступен';
              $data['curl']['correct'] = 'yes';
          }
          
          //If any unsupported feature detected
          if ( $check_failure_flag )
          {
              $data['note'] = 'Внимание! Некоторые системные требования не выполнены!';
              $data['allowed'] = 'hidden';
          }
          else
          {
              $data['note'] = ''; $data['allowed'] = 'visible';
          }
          
	      return $data;
	  }
	}
?>