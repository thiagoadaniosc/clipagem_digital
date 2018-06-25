<?php 

//$base_url = $_SERVER['HTTP_HOST'];
//$base_path = $_SERVER['DOCUMENT_ROOT'];
$request_uri = explode("?",$_SERVER['REQUEST_URI']);
$complete_request_uri = $_SERVER['REQUEST_URI'];
$request_uri = $request_uri[0];
$request_method = $_SERVER['REQUEST_METHOD'];
$security_flag = true;
$version = '1.4.0 Stable';
$version_beta = '1.6.4 Beta';
$version_alfa = '1.9.2 Alfa';