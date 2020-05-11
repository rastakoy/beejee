<?php
$GLOBALS['host'] = 'localhost';
$GLOBALS['database'] = 'beejee';
$GLOBALS['user'] = 'root';
$GLOBALS['pass'] = '';
$GLOBALS['onPage'] = '3';
session_start();
$url = array_filter(array_slice(explode('/', array_shift(each(parse_url($_SERVER['REQUEST_URI'])))), 1));
parse_str(array_shift(each(array_reverse(parse_url($_SERVER['REQUEST_URI'])))), $params);
foreach($params as $key=>$value){if(!preg_match("/^[a-zA-Z0-9_\[\]]*$/", $key)){unset($params[$key]);}}
$params = array_merge ($params, $_POST);
//echo '<pre>'; print_r($url); echo '</pre>';
//echo '<pre>params:'; print_r($params); echo '</pre>';
//exit;

spl_autoload_register(function ($className){
	//echo "className = $className<br/>\n";
	if($className=='Controller' || $className=='DatabaseInterface'){
		include 'system/system.'.$className.'.php';
	}else{
		if(preg_match("/^model/", strtolower($className))){
			$foo = 'model.'.ucfirst(str_replace('model', '', (strtolower($className))));
			include 'mvc/model/'.strtolower($foo).'.php';
		}else{
			include 'mvc/controller/'.strtolower($className).'.php';
		}
	}
});

header("Cache-Control: no-store, no-cache, must-revalidate");
header("Cache-Control: post-check=0, pre-check=0", false);
header("Pragma: no-cache");

$url['0'] = ucfirst((!$url['0'])?'start':$url['0']);
if(file_exists('mvc/controller/'.strtolower($url['0']).'.php')){
	$controller = new $url['0'];
	$controller->url = array_slice($url, 1);
	$controller->params = $params;
	$controller->className = $url['0'];
	//**********
	$controller = startModel($controller);
	//**********
	if(method_exists($controller, 'init' )===true){
		$controller->init();
	}
	if($controller->showView){
		$controller->render($controller->renderResult);
	}
}else{
	echo '404';
	exit;
}

function startModel($controller){
	if(file_exists('mvc/model/model.'.$controller->className.'.php')){
		$modelName = 'Model'.$controller->className;
		$controller->model = new $modelName;
		$controller->model->className = 'Model'.$controller->className;
		if(method_exists($controller, 'init' )===true){
			$controller->model->init();
		}
	}
	return $controller;
}
