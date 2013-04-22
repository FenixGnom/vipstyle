<?php
class ClassLoader {

	public static function Load ($strClassName)
	{
		$cs = Registry::getParam('controllers_settings');
		@eval ('
			include_once "' . $cs['dirName'] . $strClassName . 'Controller.php";
			$classHandle = new ' . $strClassName . 'Controller();');
		return $classHandle;
	}
}

?>