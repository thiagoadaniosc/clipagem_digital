<?php 
ini_set('default_charset', 'UTF-8');
session_start();
//$base_url = $_SERVER['HTTP_HOST'];
//$base_path = $_SERVER['DOCUMENT_ROOT'];
$request_uri = explode("?",$_SERVER['REQUEST_URI']);
$complete_request_uri = $_SERVER['REQUEST_URI'];
$request_uri = $request_uri[0];
$request_method = $_SERVER['REQUEST_METHOD'];
$security_flag = true;
$version = '1.1.4 Stable';
$version_beta = '1.6.4 Beta';
$version_alfa = '1.9.2 Alfa';

require_once 'includes' . DIRECTORY_SEPARATOR . 'db.php';
require_once 'functions.php'; 


//echo $request_uri;
//var_dump($_SERVER);

if (!isset($_SESSION['login']) || $_SESSION['login'] != true) {
    if ($request_uri == '/logar') {
        FUNCTIONS::login();
    } elseif ($request_uri == '/visitante' && isset($_GET['username'])){
        $username = empty($_GET['username']) ? 'visitante' : $_GET['username'];
        FUNCTIONS::guestLogin($username);
    } else {
        require_once 'login.php';
    }
} else {
    if ($_SESSION['admin'] == false) {
        if ($request_uri == '/') {
            header('Location: /clipagens');
        } elseif ($request_uri == '/clipagens') {
            if (isset($_GET['pesquisar']) && !empty($_GET['pesquisar'])) { 
                $lista = FUNCTIONS::buscarClipagens();
                require_once 'lista.php';
            } else {
                $lista = FUNCTIONS::listarClipagens();
                require_once 'lista.php';
            }
        } elseif($request_uri == '/pesquisa') {
            FUNCTIONS::downloadPesquisa();
        } elseif($request_uri == '/logon') {
            FUNCTIONS::logon();
            header('Location: /');
        } else {
            header('Location: /');
        }
    } else {
        
        if ($request_uri == '/') {
            require_once 'menu.php';
        } else if ($request_uri == '/login') {
            require_once 'login.php';
        } elseif ($request_uri == '/cadastro') {
            require_once 'cadastro.php';
        } elseif ($request_uri == '/clipagens') {
            if (isset($_GET['pesquisar']) && !empty($_GET['pesquisar'])) { 
                $lista = FUNCTIONS::buscarClipagens();
                require_once 'lista.php';
            } else {
                $lista = FUNCTIONS::listarClipagens();
                require_once 'lista.php';
            }
        } elseif ($request_uri == '/editar' && isset($_GET['id']) && $_GET['id'] != null && is_numeric($_GET['id'])) { 
            $clipagem = FUNCTIONS::buscarClipagem($_GET['id']);
            require_once 'editar.php';
        } elseif ($request_uri == '/editar' && $request_method == 'POST') {
            FUNCTIONS::editarClipagem();
        } elseif($request_uri == '/logon') {
            FUNCTIONS::logon();
            header('Location:/');
        } elseif ($request_uri == '/cadastrar' && $request_method == 'POST') {
            FUNCTIONS::cadastrarClipagem();
            header('Location: /');
        } elseif ($request_uri == '/editar' && $request_method == 'POST') {
            echo 'Editar Clipagem';
        }  elseif ($request_uri == '/deletar') {
            FUNCTIONS::deletarClipagem();
        } elseif($request_uri == '/pesquisa') {
            FUNCTIONS::downloadPesquisa();
        } elseif ($request_uri == '/informacoes') {
            require_once 'informacoes.php';
        } //elseif ($request_uri == '/teste') { 
          //  FUNCTIONS::cadastrarClipagemTest();
        //} 
        else {
            require_once 'menu.php';
        }
        
    }
}
