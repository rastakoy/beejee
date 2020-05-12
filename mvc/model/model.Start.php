<?php
class ModelStart extends Controller{
	
	/**
	
	*/
	function init($data=false){
		//initialize
	}
	
	/**
	
	*/
	function getTasks($data=false){
		//echo '<pre>'; print_r($data); echo '</pre>';
		$q  = "SELECT SQL_CALC_FOUND_ROWS \n";
		$q .= "`tasks`.*, \n";
		$q .= "`users2`.`id` AS `userId`, \n";
		$q .= "`users2`.`name` AS `userName`, \n";
		$q .= "`users2`.`email` AS `userEmail` \n";
		$q .= "FROM `tasks` \n"; 
		$q .= "LEFT JOIN `users2` ON `users2`.`id`=`tasks`.`user` \n";
		//************
		if(is_array($data['direct']) && count($data['direct'])>0){
			//echo '<pre>'; print_r($data['direct']); echo '</pre>';
			$q .= "ORDER BY ";
			$aq = '';
			foreach($data['direct'] as $key=>$value){
				if($value=='desc'){
					$aq .= "`$key` DESC, ";
				}else{
					$aq .= "`$key` ASC, ";
				}
			}
			$q .= preg_replace("/, ?$/", " \n", $aq);
		}else{
			$q .= "ORDER BY `id` DESC \n";
		}
		//************
		$q.= "LIMIT ".(($data['page']*$data['onPage'])-$data['onPage']).",".$data['onPage']." \n";
		//echo $q." \n\n";
		$result = $this->db->query($q);
		return $result;
	}
	
	/**
	
	*/
	function getLastSQLTotal(){
		$result = $this->db->query("SELECT FOUND_ROWS() as total");
		return $result['0']['total'];
	}
	
	/**
	
	*/
	function hrefDirect($data){
		$link='';
		if(is_array($data['direct'])){
			foreach($data['direct'] as $key=>$value){
				$link.='direct['.$key.']='.$value.'&';
			}
		}
		return preg_replace("/&$/", '', $link);
	}
	
	/**
	
	*/
	function editStatus($id, $value){
		$value = ($value=='true')?1:0;
		$this->db->query("UPDATE `tasks` SET `status`='{$value}' WHERE `id`='{$id}' ");
	}
	
	/**
	
	*/
	function getTask($id){
		$q  = "SELECT SQL_CALC_FOUND_ROWS \n";
		$q .= "`tasks`.*, \n";
		$q .= "`users2`.`id` AS `userId`, \n";
		$q .= "`users2`.`name` AS `userName`, \n";
		$q .= "`users2`.`email` AS `userEmail` \n";
		$q .= "FROM `tasks` \n"; 
		$q .= "LEFT JOIN `users2` ON `users2`.`id`=`tasks`.`user` \n";
		$q .= "WHERE `tasks`.`id`='{$id}' LIMIT 0,1";
		$task = $this->db->query($q);
		return $task['0'];
	}
	
	/**
	
	*/
	function newTask($data, $user){
		$userId = '0';
		if($user['reg']=='1'){
			$userId = $user['id'];
		}
		$value = $data['content'];
		if(get_magic_quotes_gpc()=='0'){
			$value = str_replace("\\", "\\\\", $value);
			$value = str_replace("'", "\\'", $value);
		}else{
			$value = str_replace('\\"', '"', $value);
		}
		$q  = "INSERT INTO `tasks` (`user`, `name`, `email`, `content`, `addDate`) \n";
		$q .= "VALUES \n";
		$q .= "('{$userId}', '{$data['name']}', '{$data['email']}', '{$value}', NOW())";
		//echo $q;
		$this->db->query($q);
	}
	
	/**
	
	*/
	function editTaskContent($id, $value){
		if(get_magic_quotes_gpc()=='0'){
			$value = str_replace("\\", "\\\\", $value);
			$value = str_replace("'", "\\'", $value);
		}else{
			$value = str_replace('\\"', '"', $value);
		}
		$q = "UPDATE `tasks` SET `content`='{$value}', `adedited`='1' WHERE `id`='{$id}' ";
		echo $q;
		$this->db->query($q);
	}
	
}