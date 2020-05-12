<?php
class Controller{
	
	public $user, $url, $params, $className, $renderResult = false;
	public $showView = true;
	
	/**
	
	*/
	public function __construct(){
		$this->db = new DatabaseInterface;
		$this->user = $this->getUser();
	}
	
	/**
	
	*/
	public function render($data=false){
		//echo '<pre>'; print_r($data); echo '</pre>';
		if(is_array($data['renderVariables'])){ foreach($data['renderVariables'] as $key=>$value){ $$key = $value; }}
		require_once('template/default/header.php');		
		require_once('mvc/view/'.strtolower($this->className).'.php');
		require_once('template/default/footer.php');
	}
	
	/**
	
	*/
	public function getUser($login=false, $password=false, $json=false){
		//if($json) echo "login=$login,pass=$password\n";
		$token = false;
		if($login && $pass){
			$login = $login;
			$password = $password;
		}elseif($_COOKIE['login'] && $_COOKIE['login']!=''){
			$login = $_COOKIE['login'];
			$token = $_COOKIE['token'];
		}elseif($_SESSION['login'] && $_SESSION['login']!=''){
			$login = $_SESSION['login'];
			$token = $_SESSION['token'];
		}
		//if($json) echo "login=$login,pass=$password,token=$token\n";
		if(!$login){
			$_SESSION['login'] = '';
			$_SESSION['token'] = '';
			setcookie('login', '', 1, '/');
			setcookie('token', '', 1, '/');
			if($json){
				return array('status'=>'0','errs'=>'1','errnum'=>'2','err'=>'Отсутствует логин');
			}
			return false; //array('status'=>'0','err'=>'nologin');
		}
		$q = "SELECT * FROM `users2` WHERE `login`='$login' LIMIT 0,1 ";
		$queryArray = $this->db->query($q);
		//echo "count=".count($queryArray)."\n"; //print_r($queryArray);
		if(count($queryArray)>0){
			$user = $queryArray['0'];
			if($password && $password!=''){
				//echo "password\n";
				$hash  = hash('sha256', $login.$user['salt'].$user['password']);
				$hash2 = hash('sha256', $login.$user['salt'].hash('sha256', $password));
				//echo "$hash\n$hash2\n";
				if($hash==$hash2){
					$user['reg'] = '1';
					unset($user['salt']);
					unset($user['password']);
					$_SESSION['login'] = $user['login'];
					$_SESSION['token'] = $hash;
					setcookie('login', $user['login'], 3600*24*30, '/');
					setcookie('token', $hash, 3600*24*30, '/');
					return $user;
				}else{
					$_SESSION['login'] = '';
					$_SESSION['token'] = '';
					setcookie('login', '', 1, '/');
					setcookie('token', '', 1, '/');
					if($json){
						return array('status'=>'0','errs'=>'1','errnum'=>'3','err'=>'Неверный пароль');
					}else{
						return false;
					}
				}
			}elseif($token){
				//echo "token\n";
				$hash = hash('sha256', $login.$user['salt'].$user['password']);
				if($hash==$token){
					$user['reg'] = '1';
					unset($user['salt']);
					unset($user['password']);
					$_SESSION['login'] = $user['login'];
					$_SESSION['token'] = $hash;
					setcookie('login', $user['login'], 3600*24*30, '/');
					setcookie('token', $hash, 3600*24*30, '/');
					return $user;
				}else{
					$_SESSION['login'] = '';
					$_SESSION['token'] = '';
					setcookie('login', '', 1, '/');
					setcookie('token', '', 1, '/');
					if($json){
						return array('status'=>'0','errs'=>'1','errnum'=>'3','err'=>'Неверный пароль');
					}else{
						return false;
					}
				}
			}else{
				$_SESSION['login'] = '';
				$_SESSION['token'] = '';
				setcookie('login', '', 1, '/');
				setcookie('token', '', 1, '/');
				if($json){
					return array('status'=>'0','errs'=>'1','errnum'=>'3','err'=>'Неверный пароль');
				}else{
					return false;
				}
			}
		}else{
			$_SESSION['login'] = '';
			$_SESSION['token'] = '';
			setcookie('login', '', 1, '/');
			setcookie('token', '', 1, '/');
			if($json){
				return array('status'=>'0','errs'=>'1','errnum'=>'4','err'=>'Логин отсутствует в системе');
			}else{
				return false;
			}
		}
		if($json){
			return array('status'=>'0','errs'=>'1','errnum'=>'1','err'=>'Неизвестная ошибка');
		}else{
			return false;
		}
	}
	
}