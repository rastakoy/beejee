<?php
class Ajax extends Controller{
	
	function init(){
		$this->showView = false;
		foreach($this->params as $key=>$value){
			if(preg_match("/^[a-zA-Z_]*$/", $key)){
				$$key = $value;
			}
		}
		//****************
		switch($ajax){
			case 'login':
				$result = $this->getUser($this->params['login'], $this->params['password'], true);
				if(is_array($result) && $result['reg']=='1'){
					echo '{"status":"1","login":"ok"}';
				}elseif(is_array($result) && $result['errs']=='1'){
					echo json_encode($result);
				}
			break;
			
			case 'logout':
				$_SESSION['login'] = '';
				$_SESSION['token'] = '';
				setcookie('login', '', 1, '/');
				setcookie('token', '', 1, '/');
				echo '{"status":"1","ajax":"logout"}';
			break;
			
			case 'editStatus':
				if($this->user['reg']=='1' && $this->user['login']=='admin'){
					$taskModel = new ModelStart;
					$taskModel->editStatus($this->params['taskId'], $this->params['value']);
				}
			break;
			
			case 'newTask':
				$taskModel = new ModelStart;
				$taskModel->newTask($this->params, $this->user);
				//echo '{"status":"1","ajax":"logout"}';
			break;
			
			case 'getEditItem':
				if($this->user['reg']=='1' && $this->user['login']=='admin'){
					$taskModel = new ModelStart;
					$array = $taskModel->getTask($this->params['taskId']);
					echo json_encode($array);
				}
				//echo '{"status":"1","ajax":"logout"}';
			break;
			
			case 'editTaskContent':
				if($this->user['reg']=='1' && $this->user['login']=='admin'){
					$taskModel = new ModelStart;
					$taskModel->editTaskContent($this->params['taskId'], $this->params['content']);
				}
			break;
			
			case 'getTasks':
				$taskModel = new ModelStart;
				$page = ($this->params['page'])?$this->params['page']:1;
				$onPage = ($this->params['onPage'])?$this->params['onPage']:1;
				$data['tasks'] = $taskModel->getTasks($this->params);
				$total = $taskModel->getLastSQLTotal();
				$direct = $taskModel->hrefDirect($this->params);
				echo '{"link":"page='.$page.'&onPage='.$onPage.'&'.$direct.'"}';
				//require_once("mvc/view/__tasks.php");
			break;
			
			default:
				echo '{"status":"0","ajax":"empty"}';
			break;
		}
	}
	
}