<?php 
ini_set('default_charset', 'UTF-8');
session_start();
require_once 'kernel.php';
require_once 'configs/globalVariables.php';
require_once 'includes' . DIRECTORY_SEPARATOR . 'db.php';
require 'configs' . DIRECTORY_SEPARATOR . 'ad.php';
require_once 'functions.php'; 


//echo $request_uri;
//var_dump($_SERVER);

if (!isset($_SESSION['login']) || $_SESSION['login'] != true) {
    if (routePost('/logar')) {
        FUNCTIONS::login($_POST['usuario'], $_POST['senha']);
    } elseif (routeGet('/visitante') && isset($_GET['username'])){
        $username = empty($_GET['username']) ? 'visitante' : $_GET['username'];
        FUNCTIONS::guestLogin($username);
    } else {
        getView('login');
    }
} else {
    if (!isAdmin()) { // Usuário Comum
        if (routeGet('/')) {
            header('Location: /clipagens');
        } elseif (routeAny('/clipagens')) {
            if (isset($_GET['pesquisar']) && !empty($_GET['pesquisar'])) { 
                $lista = FUNCTIONS::buscarClipagens();
                $data = [
                    "lista" => $lista
                ];
                getView('lista', $data);
            } else {
                 $data = [
                    "lista" => FUNCTIONS::listarClipagens()
                ];
                getView('lista', $data);

            }
        } elseif(routeAny('/pesquisa')) {
            FUNCTIONS::downloadPesquisa();
        } elseif(routeAny('/logon')) {
            FUNCTIONS::logon();
            redirect('/');
        } else {
            //FUNCTIONS::dbLogin('thiagoas', '123');
            //exit;
            redirect('/');
        }
    } else {
        
        if (routeGet('/')) {
            require_once 'menu.php';
        } else if (routeGet('/login')) {
            require_once 'login.php';
        } elseif (routeGet('/cadastro')) {
            require_once 'cadastro.php';
        } elseif (routeAny('/clipagens')) {
            if (isset($_GET['pesquisar']) && !empty($_GET['pesquisar'])) { 
                $lista = FUNCTIONS::buscarClipagens();
                $data = [
                    "lista" => $lista
                ];
                getView('clipagens', $data);
            } else {
                $lista = FUNCTIONS::listarClipagens();
                $data = [
                    "lista" => $lista
                ];
                getView('lista', $data);
            }
        } elseif (routeGet('/editar') && isset($_GET['id']) && $_GET['id'] != null && is_numeric($_GET['id'])) { 
            $clipagem = FUNCTIONS::buscarClipagem($_GET['id']);
            $data = [
                'clipagem' => $clipagem
            ];
            getView('editar', $data);
        } elseif (routePost('/editar')) {
            FUNCTIONS::editarClipagem();
        } elseif(routeAny('/logon')) {
            FUNCTIONS::logon();
            redirect('/');
        } elseif (routePost('/cadastrar')) {
            FUNCTIONS::cadastrarClipagem();
            redirect('/');
        } elseif (routeGet('/deletar')) {
            FUNCTIONS::deletarClipagem();
        } elseif(routeGet('/pesquisa')) {
            FUNCTIONS::downloadPesquisa();
        } elseif (routeGet('/informacoes')) {
            getView('informacoes');
        } elseif ($request_uri == '/teste') { 
            /*$display_name = 'thiagosc6';
            $username = "thiagosc6";
            $password = "123";
            $role = 1;
            FUNCTIONS::dbStoreUser($display_name, $username, $password, $role);
            */
            $data = [
                'lista' =>  FUNCTIONS::listarClipagens()
            ];
            getView('lista', $data);
        } 
        else {
            getView('menu');
        }
        
    }
}
