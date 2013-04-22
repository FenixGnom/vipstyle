<?php

class Database {
	protected $db = null;
	protected $db_settings;

	public function __construct($connect = true, $database = null, $server = null,
			$username = null, $password = null, $charset = null) {
		$db_settings = Registry::getParam('db_settings');
		$db_settings['charset'] = "utf8";
		$this->db_settings = $db_settings;
		if ($database !== null) $this->db_settings['name'] = $database;
		if ($server   !== null) $this->db_settings['host'] = $server;
		if ($username !== null) $this->db_settings['user'] = $username;
		if ($password !== null) $this->db_settings['password'] = $password;
		if ($charset  !== null) $this->db_settings['charset'] = $charset;
		if ($connect) $this->connect();
	}

	public function connect() {
		$db = $this->db_settings;
		$this->db = @mysql_connect($db['host'],$db['user'],$db['password']);
		if (!$this->db) {
			LOG::echoLog("Could not connect to server \"".$db['host']."\" !!!");
			return null;
		} else {
			mysql_select_db($db['name']);
			$this->do_insert("SET NAMES '".$db['charset']."'");
		}
	}

	public function close() {
		$success = @mysql_close($this->db);
		if (!$success) LOG::echoLog("Could close connection to database \"".$this->db_settings['name']."\"! <br/>".mysql_error());
		return $success;
	}

	public function do_insert ($query) {
		$res = mysql_query($query,$this->db);
		if (!$res) {
			return false;;
			return false;
		}

		return true;
	}

	public function do_select ($query) {
		$res = mysql_query($query,$this->db);
		if (!$res) return false;
		$data = array();
		while ($result=mysql_fetch_assoc($res)) $data[]=$result;
		mysql_free_result($res);
		return $data;
	}

	public function do_selectRow ($query)
	{
		$res = mysql_query($query);
		if (!$res) return false;
		$data = array();
		while ($data=mysql_fetch_assoc($res)) {break;}
		mysql_free_result($res);
 		return $data;
	}

	public function do_selectVal ($query)
	{
		$res = mysql_query($query);
		if (!$res) return false;;
		$data = array();
		while ($result=mysql_fetch_array($res)) {
			$data=$result[0];
			break;
		}
		mysql_free_result($res);
 		return $data;
	}

	public function do_saaofv($query,$field) {
		$res = mysql_query($query);
		if (!$res) LOG::echoLog("Could not execute query \"$query\"!!!<br/>".mysql_error());
		$data = array();
		if(is_array($field)){
			$field_count = count($field);
			while ($result=mysql_fetch_assoc($res)) {
				$unique = "";
				for($i=0;$i<$field_count;$i++) $unique .= $result[$field[$i]]."^";
				$data[$unique]=$result;
			}
		} else while ($result=mysql_fetch_assoc($res)) $data[$result[$field]]=$result;
		mysql_free_result($res);
		return $data;
	}

	public function cachedQuery($query) {
		$subdir= "catalog/";
		$cache = new Cache();
		$cacheID = md5($query);
		if(!$result = $cache->Load($subdir.$cacheID)) {
                    
			$result = $this->do_select($query);
			if($result) $cache->Save($result,$subdir.$cacheID);
		}
                
		return $result;
	}

}

?>