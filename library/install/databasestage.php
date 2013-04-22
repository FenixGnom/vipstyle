<?php

/**
 * install_databaseStage
 * 
 * install_databaseStage. Database installation stage.
 * 
 * @author Kornushkin Aleksei kornushkin@gmail.com
 */
	class install_databaseStage extends install_stage
	{
	  public function check() {
	      try
	      {
	          $connect = @mysql_connect( @$_POST['db_host'], @$_POST['db_user'], @$_POST['db_pwd']);
	          if ( ! $connect )
	          {
	              throw new Exception( "Неверные параметры соединения с базой данных" );
	          }
	          $database = @mysql_select_db( @$_POST['db_dbname'], $connect );
	          if ( ! $database )
	          {				
	              throw new Exception( "База данных с названием \"".@$_POST['db_dbname']."\" не найдена на сервере." );
	          }
			  
	      }
	      catch ( Exception $e )
	      {
	          return $e->getMessage();
	      }
	      
	      $database_params = array(
	          'db_host'   => @$_POST['db_host'],
    	      'db_user'   => @$_POST['db_user'],
    	      'db_pwd'    => @$_POST['db_pwd'],
    	      'db_dbname' => @$_POST['db_dbname'],
	      );
	      
	      install_installRegistry::saveArray($database_params);

	      install_installRegistry::setParam( 'stage_name',  'partner');
	      $this->stageName = 'partner';
	      return false;
	  }
	  
	  public function getFormData() {}
	  
	}
?>