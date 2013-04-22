<?php

class LOG 
{
	public static function echoLog ($logText) {
		echo '<font color="red">' . $logText . '</font>';
	}
	
	public static function writeLog ($logText,$logType) {
		echo '<font color="red">' . $logType . '<br>';
		echo $logText . '</font>';
	}
}

?>