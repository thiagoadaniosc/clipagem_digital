<?php

function viewExists($viewName){
	return file_exists('resources'. DIRECTORY_SEPARATOR . 'views' . DIRECTORY_SEPARATOR . $viewName . '.php');
}

function getView($viewName, $data = ""){
	include 'configs/globalVariables.php';
	if(is_array($data)){
		foreach ($data as $key => $value) {
			${$key} = $value;
		}
	}
	if (viewExists($viewName)) {
		require_once('resources'. DIRECTORY_SEPARATOR . 'views' . DIRECTORY_SEPARATOR . $viewName . '.php' );
	} else {
		FUNCTIONS::dd("A View '{$viewName}' não existe");
	}
}

function isAdmin() {
	if ($_SESSION['admin'] == true) {
		return true;
	} else {
		return false;
	}
}

function is_uri(){

}

function routeGet($route){
	global $request_uri;
	global $request_method;
	if ($route == $request_uri && $request_method == 'GET') {
		return true;
	} else {
		return false;
	}
}

function routePost($route){
		global $request_uri;
	global $request_method;
	if ($route == $request_uri && $request_method == 'POST') {
		return true;
	} else {
		return false;
	}
}

function routeAny($route){
	global $request_uri;
	if ($route == $request_uri) {
		return true;
	} else {
		return false;
	}
}

function redirect($route = '/'){
	header("Location: {$route}");
	exit;
}