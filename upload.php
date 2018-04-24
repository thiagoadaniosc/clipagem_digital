<?php

$security_flag = true;

require_once 'includes' . DIRECTORY_SEPARATOR . 'db.php';

$conexao = mysqlCon();

if (!empty($_FILES['file'] and $_SERVER['REQUEST_METHOD'] == "POST")) {
    
    $titulo = $_POST['titulo'];
    $veiculo = $_POST['veiculo'];
    $editoria = $_POST['editoria'];
    $autor = $_POST['autor'];
    $data = $_POST['data'];
    $pagina = $_POST['pagina'];
    $tipo = $_POST['tipo'];
    $tags = $_POST['tags'];

    $conexao = cadastro_clipagem($conexao, $titulo, $veiculo, $editoria, $autor, $data, $pagina, $tipo, $tags);

    $id_clipagem = $conexao->insert_id;

    $fileName =  $id_clipagem. '-' .$_FILES['file']['name'];
    
    $tempFile = $_FILES['file']['tmp_name'];     
    
    $targetPath = dirname( __FILE__ ) . DIRECTORY_SEPARATOR. 'uploads'. DIRECTORY_SEPARATOR;
    $targetFile =  $targetPath. $fileName;
    move_uploaded_file($tempFile,$targetFile);
    
    cadastro_arquivo($conexao, $id_clipagem, $fileName);
    
} else {
  echo "Nenhum Arquivo encontrado";
}

?>