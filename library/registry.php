<?php
	class Registry
	{
		public static function getParam($id){
			return unserialize($_SESSION[$id]);}
			
		public static function setParam($name,$value){
			$_SESSION[$name] = serialize($value);}
	}
?>