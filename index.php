<?php 
ini_set('default_charset', 'UTF-8');
session_start();
require_once 'kernel.php';
require_once 'configs/globalVariables.php';
require_once 'includes' . DIRECTORY_SEPARATOR . 'db.php';
require 'configs' . DIRECTORY_SEPARATOR . 'ad.php';
require_once 'functions.php';

if (!isset($_SESSION['login']) || $_SESSION['login'] != true) {
    if (routeAny('/logar')) {
        FUNCTIONS::login($_POST['usuario'], $_POST['senha']);
    } elseif (routeGet('/visitante') && isset($_GET['username'])){
        $username = empty($_GET['username']) ? 'visitante' : $_GET['username'];
        $name = empty($_GET['name']) ? 'Visitante' : $_GET['name'];
        FUNCTIONS::guestLogin($username, $name);
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
            } elseif (routeGet('/api/clipagens')) {
                FUNCTIONS::jsonClipagens(0,15);
            } else {
                redirect('/');
            }
        } else { // Routes Administrator

            if (routeGet('/')) {
                getView('menu');
            } else if (routeGet('/login')) {
                getView('login');
            } elseif (routeGet('/cadastro/menu')) {
                getView('cadastro_menu');
            } elseif (routeGet('/cadastro')) {
                getView('cadastro');
            } elseif (routeGet('/cadastro/arquivo')) {
                getView('cadastro');
            } elseif (routeGet('/cadastro/link')) {
                getView('cadastro_link');
            } elseif (routeGet('/cadastro/video')) {
                getView('cadastro_video');
            } elseif (routeGet('/cadastro/audio')) {
                getView('cadastro_audio');
            } elseif (routeAny('/clipagens')) {
                if (isset($_GET['pesquisar']) && !empty($_GET['pesquisar'])) { 
                    $lista = FUNCTIONS::buscarClipagens();
                    $data = [
                        "lista" => $lista
                    ];
                    getView('lista', $data);
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
                if($clipagem['tipo'] == 'audio'): getView('editar_audio', $data);
                elseif($clipagem['tipo'] == 'video'): getView('editar_video', $data);
                elseif($clipagem['tipo'] == 'link'): getView('editar_link', $data);
                else : getView('editar', $data);
                endif;

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
            } elseif (routeGet('/relatorios')) {
                $data = [
                    'total_clipagens' => FUNCTIONS::getTotalClipagens(),
                    'total_arquivos' => FUNCTIONS::getTotalClipagens('pdf'),
                    'total_link' => FUNCTIONS::getTotalClipagens('link'),
                    'total_video' => FUNCTIONS::getTotalClipagens('video'),
                    'total_audio' => FUNCTIONS::getTotalClipagens('audio'),
                ];
                getView('relatorios', $data);
            } elseif (routeAny('teste')) { 
                $data = [
                    'lista' =>  FUNCTIONS::listarClipagens()
                ];
                getView('lista', $data);
            } else if(routeGet('/usuarios')){
                $data = [
                    'usuarios' => FUNCTIONS::dbShowUsers()
                ];
                getView('usuarios', $data);
            } else if(routeAny('/usuario/cadastrar')){
                getView('usuarioCadastro');
            } else if(routePost('/usuario/store')){
                $display_name = $_POST['display_name'];
                $username = $_POST['username'];
                $email = $_POST['email'];
                $password = $_POST['password'];
                $role = $_POST['role'];
                FUNCTIONS::dbStoreUser($display_name, $username, $email, $password, $role);
                redirect('/usuarios');
            } else if(routeAny('/usuario/editar') && isset($_GET['id'])){
                $user = FUNCTIONS::dbShowUser($_GET['id']);
                $data = [
                    'usuario' => $user = $user->fetch_assoc()
                ];
                getView('usuarioEditar', $data);
            } else if(routePost('/usuario/update')){
                $id = $_POST['id'];
                $display_name = $_POST['display_name'];
                $username = $_POST['username'];
                $email = $_POST['email'];
                $password = isset($_POST['password']) ? $_POST['password'] : false;
                $status = isset($_POST['status']) ? 1 : 0;
                $role = $_POST['role'];
                FUNCTIONS::dbUpdateUser($id, $display_name, $username, $email, $password,$status, $role);
                redirect('/usuarios');
            } else {
                redirect('/');
            }

        }
}
