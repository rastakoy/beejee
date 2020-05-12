<?php

	/**
	 * интерфейс для общения с базой данных
	 * Class DatabaseInterface
	 */
class DatabaseInterface extends Mysqli{
	
	public $rows;
	public $row;

	/**
	
	*/
	function __construct($param1 = '', $param2 = '', $param3 = '', $param4 = ''){
		$param = array('host' => $param1, 'user' => $param2, 'pass' => $param3, 'database' => $param4);
		foreach($param as $key => $tParam){
			$param[$key] = ($tParam == '' ? $GLOBALS[$key] : $tParam);
		}
		parent::__construct($param['host'], $param['user'], $param['pass'], $param['database']);
		parent::set_charset("utf-8");
		parent::query("SET NAMES 'utf-8' COLLATE 'utf8_general_ci'");
	}

	/**
	
	*/
	private function s_query($query, $resultmode = MYSQLI_STORE_RESULT){
		$query = parent::query($query, $resultmode);
		if(!$query){
			throw new Exception("ошибка базы данных [ошибка запроса: {$this->errno}, ошибка соединения {$this->connect_errno}]");
		}
		return $query;
	}

	/**
	
	*/
	function query($query, $resultmode = MYSQLI_STORE_RESULT){
		try{
			$array = array();
			$query = $this->s_query($query, $resultmode);
			if($query->num_rows>0){
				while($item=$query->fetch_assoc()){
					$array[] = $item;
				}
			}
			return $array;
		}catch(Exception $e){
			
		}
	}
	
	/**
	
	*/
	function encodeSQL($params=false, $start=false){
		echo "<br/>--------<br/>start encodeSQL<br/>\n";
		if(is_array($params)){
			foreach($params as $key=>$value){
				preg_match("/(^>|^>=|^<|^<=)/", $value, $assig);
				//echo "$assig";
				print_r($assig);
				echo "\n-----------\n";
			}
		}
		if(strlen($str)>0){
			$str = $start.$str;
		}
		return $str;
	}

}