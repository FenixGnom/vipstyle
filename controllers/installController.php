<?php
class InstallController
{
    
	public function installAction()
	{
	   
	    
	    if ( ! ($stageName = install_installRegistry::getParam( 'stage_name' )) )
	    {
	       
			$stageName = install_installRegistry::setParam( 'stage_name', 'requirements' );
	    }
		
	    $installer = new install_installer( $stageName );
		
	    if (@$_POST)
	    {
	        $error = $installer->checkValues();
	        return $installer->showForm( $error );
	    }
	    
	    return $installer->showForm();
	}
}
?>