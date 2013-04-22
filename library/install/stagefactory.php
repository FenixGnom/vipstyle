<?php

/**
 * install_stageFactory
 * 
 * install_stageFactory. Creates *stage implementations.
 * 
 * @author Kornushkin Aleksei kornushkin@gmail.com
 */
	class install_stageFactory
	{
	  private function __constructor() {}
	  
	  static public function getInstance( $stageName )
	  {
	      $stage = null;
	      
	      switch ( $stageName )
	      {
	          case 'final':
	              $stage = new install_finalStage( $stageName );
	              break;
	          case 'test':
	              $stage = new install_testStage( $stageName );
	              break;
	          case 'partner':
	              $stage = new install_partnerStage( $stageName );
	              break;
	          case 'database':
	              $stage = new install_databaseStage( $stageName );
	              break;
	          case 'requirements': default:
	              $stage = new install_requirementsStage( $stageName );
	              break;
	      }
	      return $stage;
	  }
	}
?>