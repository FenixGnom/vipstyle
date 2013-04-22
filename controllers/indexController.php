<?php
class IndexController {
	public function indexAction() {
	    //Run install if there are no parameters configurated
		if (install_installer::checkFirstRun() )
		{
		   $front = new Front( ClassLoader::Load('install') );
		    return $front->dispatch('install');
		}
		
		$content = ClassLoader::Load('catalog');
		$front = new Front($content);
		return $front->dispatch('showall');
		
	}
}

?>