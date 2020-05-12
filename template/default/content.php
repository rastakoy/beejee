<?php
session_start();
$url = array_filter(array_slice(explode('/', array_shift(each(parse_url($_SERVER['REQUEST_URI'])))), 1));
parse_str(array_shift(each(array_reverse(parse_url($_SERVER['REQUEST_URI'])))), $params);
//echo '<pre>'; print_r($url); echo '</pre>';
//echo '<pre>'; print_r($params); echo '</pre>';

//for php 5.3
spl_autoload_register(function ($className){
	include 'system/system.'.$className.'.php';
});

header("Cache-Control: no-store, no-cache, must-revalidate");
header("Cache-Control: post-check=0, pre-check=0", false);
header("Pragma: no-cache");

$index = new Index($url, $params);
