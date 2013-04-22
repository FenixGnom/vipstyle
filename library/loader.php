<?php
class ClassLoader {

	public static function Load ($strClassName)
	{
		$cs = Registry::getParam('controllers_settings');

        include_once $cs['dirName'] . $strClassName . 'Controller.php';
        $classHandleName = $strClassName . 'Controller';
        $classHandle = new $classHandleName();
		return $classHandle;
	}
}

?>