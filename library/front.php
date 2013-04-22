<?php
class Front {

	public $curr_class = null;

	function __construct ($objClass) {
  		$this->curr_class = $objClass;
	}

	public function dispatch ($strActionName) {

        $strActionName = $strActionName.'Action';
        $results = $this->curr_class->$strActionName();
        return $results;
	}
}

?>