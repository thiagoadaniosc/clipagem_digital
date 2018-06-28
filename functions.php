<?php
class FUNCTIONS {

    public static function dd($value){
        echo  '<h1 style="text-align:center">'.$value . '<h1>';
        exit;
    }

    /* public static function cadastrarClipagemTest() { 
        $conexao = mysqlCon();
        
        $titulo = 'teste';
        $veiculo = 'teste';
        $editoria = 'teste';
        $autor ='teste';
        $data = '07/12/1995';
        $pagina = 2;
        $tipo ='teste';
        $tags = 'teste';
        
        $conexao = cadastro_clipagem($conexao, $titulo, $veiculo, $editoria, $autor, $data, $pagina, $tipo, $tags);
        $id_clipagem = $conexao->insert_id;
        cadastro_arquivo($conexao, $id_clipagem, 'teste.pdf');
        
    }*/

    public function filter_string($var) {
        return filter_var($var, FILTER_SANITIZE_STRING);
    }

    public function filter_integer($var) {
        if (filter_var($var, FILTER_VALIDATE_INT)) {
        return filter_var($var, FILTER_VALIDATE_INT);
        } else {
            return 0;
        }
    }
    
    public static function cadastrarClipagem() {
        $conexao = mysqlCon();
        
        $titulo = filter_string($_POST['titulo']); //FILTER_SANITIZE_SPECIAL_CHARS
        $veiculo = filter_string($_POST['veiculo']);
        $editoria = filter_string(isset($_POST['editoria']) ? $_POST['editoria'] : ' ');
        $autor = filter_string($_POST['autor']);
        $data = filter_date($_POST['data']);
        $pagina = filter_integer(isset($_POST['pagina']) ? $_POST['pagina'] : 0);
        $tipo = filter_string(isset($_POST['tipo']) ? $_POST['tipo'] : $_POST['tipo_formato']);
        $tags = filter_string($_POST['tags']);
        $visible = filter_string($_POST['visible']);
        
        $conexao = cadastro_clipagem($conexao, $titulo, $veiculo, $editoria, $autor, $data, $pagina, $tipo, $tags, $visible);
        $id_clipagem = $conexao->insert_id;
        $date = new DateTime($_POST['data']);
        $data = $date->format('d-m-Y');
        // FUNCTIONS::dd($id_clipagem);
        $fileName = $data . '-' . $id_clipagem;
        FUNCTIONS::uploadArquivos($conexao, $id_clipagem, $fileName);
    }
    
    public static function uploadArquivos($conexao, $id_clipagem, $fileName){
        if ($_POST['tipo_formato'] == 'pdf') {
            require_once 'vendor' . DIRECTORY_SEPARATOR . 'autoload.php';
            $pdf = new \Clegginabox\PDFMerger\PDFMerger;

            foreach ($_FILES['file']['tmp_name'] as $tempFile){
                $pdf->addPDF($tempFile, 'all');        
            }
            $fileName = $fileName . '.pdf';
            $pdf->merge('file', 'uploads'. DIRECTORY_SEPARATOR . $fileName, 'P');

        } elseif($_POST['tipo_formato'] == 'video'){
            $video = $_FILES['file'];
            $tmp_name = $_FILES['file']['tmp_name'];

            // var_dump($tmp_name);
            $extension = pathinfo($video['name'], PATHINFO_EXTENSION);
            $fileName = $fileName . '.' . $extension;
            move_uploaded_file($tmp_name, dirname( __FILE__ ) . DIRECTORY_SEPARATOR . 'uploads' . DIRECTORY_SEPARATOR .  $fileName);  
            // echo  dirname( __FILE__ ) . DIRECTORY_SEPARATOR . 'uploads' . DIRECTORY_SEPARATOR .  $fileName;
        } elseif($_POST['tipo_formato'] == 'audio'){
            $audio = $_FILES['file'];
            $tmp_name = $_FILES['file']['tmp_name'];

            // var_dump($tmp_name);
            $extension = pathinfo($audio['name'], PATHINFO_EXTENSION);
            $fileName = $fileName . '.' . $extension;
            move_uploaded_file($tmp_name, dirname( __FILE__ ) . DIRECTORY_SEPARATOR . 'uploads' . DIRECTORY_SEPARATOR .  $fileName);  
            // echo  dirname( __FILE__ ) . DIRECTORY_SEPARATOR . 'uploads' . DIRECTORY_SEPARATOR .  $fileName;
        } elseif($_POST['tipo_formato'] == 'link'){
            $fileName = $_POST['link'];
        }

        cadastro_arquivo($conexao, $id_clipagem, $fileName, $_POST['tipo_formato']);

        
    }
    
    public static function editarClipagem() {
        require_once 'vendor' . DIRECTORY_SEPARATOR . 'autoload.php';
        $pdf = new \Clegginabox\PDFMerger\PDFMerger;
        $conexao = mysqlCon();

        $id = filter_integer($_POST['id']);
        $titulo = filter_string($_POST['titulo']);
        $veiculo = filter_string($_POST['veiculo']);
        $editoria = filter_string(isset($_POST['editoria']) ? $_POST['editoria'] : ' ');
        $autor = filter_string($_POST['autor']);
        $data = filter_date($_POST['data']);
        $pagina = filter_integer(isset($_POST['pagina']) ? $_POST['pagina'] : 0);
        $tipo = filter_string(isset($_POST['tipo']) ? $_POST['tipo'] : $_POST['tipo_formato']);
        $tags = filter_string($_POST['tags']);
        $visible = filter_integer($_POST['visible']);
        $tipo_formato = filter_string($_POST['tipo_formato']);
        
        atualizarClipagem($conexao,$id, $titulo, $veiculo, $editoria, $autor, $data, $pagina, $tipo, $tags, $visible);
        if ($tipo_formato == 'arquivo') {
            if (empty($_FILES['file']['name'][0]) == false) {

                foreach ($_FILES['file']['tmp_name'] as $tempFile){
                    $pdf->addPDF($tempFile, 'all');        
                    echo $tempFile;
                }
                
                $date = new DateTime($_POST['data']);
                
                $data = $date->format('d-m-Y');

                $fileName = $data . '-' . $id . '.pdf';
                
                $pdf->merge('file', 'uploads'. DIRECTORY_SEPARATOR . $fileName, 'P');
                
                $arquivo =  buscarArquivo($conexao, $id);
                
                atualizarArquivo($conexao, $arquivo['ID'], $fileName);
            }
        } elseif ($tipo_formato == 'audio'){
            if (!empty($_FILES['file']['name'])){

                 $date = new DateTime($_POST['data']);
                $data = $date->format('d-m-Y');
                $fileName = $data . '-' . $id;
                $audio = $_FILES['file'];
                $tmp_name = $_FILES['file']['tmp_name'];
                $extension = pathinfo($audio['name'], PATHINFO_EXTENSION);

                $fileName = $fileName . '.' . $extension;
                move_uploaded_file($tmp_name, dirname( __FILE__ ) . DIRECTORY_SEPARATOR . 'uploads' . DIRECTORY_SEPARATOR .  $fileName);                
                
                $arquivo =  buscarArquivo($conexao, $id);

                atualizarArquivo($conexao, $arquivo['ID'], $fileName);
            }

        } elseif ($tipo_formato == 'video'){
            if (!empty($_FILES['file']['name'])){
                
                $date = new DateTime($_POST['data']);
                $data = $date->format('d-m-Y');
                $fileName = $data . '-' . $id;
                $video = $_FILES['file'];
                $tmp_name = $_FILES['file']['tmp_name'];
                $extension = pathinfo($video['name'], PATHINFO_EXTENSION);

                $fileName = $fileName . '.' . $extension;
                move_uploaded_file($tmp_name, dirname( __FILE__ ) . DIRECTORY_SEPARATOR . 'uploads' . DIRECTORY_SEPARATOR .  $fileName);                
                
                $arquivo =  buscarArquivo($conexao, $id);

                atualizarArquivo($conexao, $arquivo['ID'], $fileName);
            }
        } elseif ($tipo_formato == 'link'){
            $fileName = $_POST['link'];
            $arquivo =  buscarArquivo($conexao, $id);
            atualizarArquivo($conexao, $arquivo['ID'], $fileName);        
        }
        
        redirect('/clipagens');
        
        
    }
    
    public static function listarClipagens() {
        $conexao = mysqlCon();
        
        $show = isset($_GET['show']) && !empty($_GET['show']) ? $_GET['show'] : 10;
        $page = isset($_GET['page']) && !empty($_GET['page']) ? $_GET['page'] : 1;
        
        if ($page == 1 ){
            $inicio = 0;
            $fim = $show;
        } else {
            $inicio = ($page-1) * $show;
            $fim = $show;
        }

        $lista = listar($conexao, $inicio, $fim);
        $totalReg = FUNCTIONS::totalRegClipagens();
        $_SESSION['totalReg'] = $totalReg;
        
        return $lista;
    }

    public static function totalRegClipagens(){
        $conexao = mysqlCon();
        $totalReg = getNumRows($conexao);
        return $totalReg;
    }
    
    public static function totalRegClipagensBusca($valor, $pesquisar, $ano, $mes){
        $conexao = mysqlCon();
        $totalReg = getNumRowsBusca($conexao, $valor, $pesquisar, $ano, $mes);
        return $totalReg;
    }

    public static function getTotalClipagens($tipo = 'all') {
        $conn = mysqlCon();
        return countClipagens($conn, $tipo);
    }

    
    public static function buscarClipagens() {
        $conexao = mysqlCon();
        $pesquisar = $_GET['pesquisar'];
        $valor = $_GET['valor'];
        
        $show = isset($_GET['show']) && !empty($_GET['show']) ? $_GET['show'] : 10;
        $page = isset($_GET['page']) && !empty($_GET['page']) ? $_GET['page'] : 1;
        
        if ($page == 1 ){
            $inicio = 0;
            $fim = $show;
        } else {
            $inicio = ($page-1) * $show;
            $fim = $show;
        }        
        
        
        $ano = isset($_GET['ano']) && !empty($_GET['ano']) ? $_GET['ano'] : '';
        $mes = isset($_GET['mes']) && !empty($_GET['mes']) ? '/' . $_GET['mes'] . '/' : '';
        
        $lista = buscar($conexao,$pesquisar, $valor, $ano, $mes, $inicio, $fim);
        $totalReg = FUNCTIONS::totalRegClipagensBusca($valor, $pesquisar, $ano, $mes);
        $_SESSION['totalReg'] = $totalReg;
        return $lista;
    }
    
    public static function buscarClipagem($id){
        $conexao = mysqlCon();
        return buscarClipagem($conexao, $id);      
        
    }
    
    public static function deletarClipagem() {
        $conexao = mysqlCon();
        $id = $_GET['id'];
        deletar($conexao,$id);
        redirect('/clipagens');
    }
    
    public static function downloadPesquisa(){
        require_once 'vendor' . DIRECTORY_SEPARATOR . 'autoload.php';
        $pdf = new \Clegginabox\PDFMerger\PDFMerger;
        $i = 0;

        if (isset($_SESSION['arquivos'])) {
            $fileName = $_SESSION['usuario']. '_' . 'pesquisa.pdf';
            foreach($_SESSION['arquivos'] as $arquivo){
                $extension = pathinfo($arquivo, PATHINFO_EXTENSION);
                if ($extension == 'pdf') {
                    if(file_exists('uploads/' . $arquivo)) {
                        $pdf->addPDF('uploads'. DIRECTORY_SEPARATOR . $arquivo, 'all');
                        $i++;
                    }
                }
            }
            if ($i != 0) {
                $pdf->merge('file', 'pesquisas'. DIRECTORY_SEPARATOR . $fileName);
                redirect('/pesquisas' .DIRECTORY_SEPARATOR. $fileName);
            } else {
                redirect('/clipagens');
            }

        } else {
         redirect('/clipagens');   
     }
 }
 public static function guestLogin($username, $name){
    $_SESSION['usuario'] = $username;
    $_SESSION['nome'] = $name;
    $_SESSION['admin'] = false;
    $_SESSION['login'] = true;
    return redirect('/clipagens'); 
}

public static function login($username, $password){
    if (empty($username) || empty($password)) {
        redirect('/');
    }
    if (LDAP_LOGIN){
        FUNCTIONS::adlogin($username, $password);
    } else {
        FUNCTIONS::dbLogin($username, $password);
    }
}

public static function adlogin($user, $pass){

    $ldap_server = LDAP_SERVER;
    $ldapport = LDAP_PORT;
    $dn=LDAP_DN;
        // Tenta se conectar com o servidor
        //try {
    $connect = ldap_connect($ldap_server, $ldapport) or die('erro');
    ldap_set_option($connect, LDAP_OPT_PROTOCOL_VERSION, 3);
    ldap_set_option($connect, LDAP_OPT_REFERRALS, 0);

    if($connect != null) {
        echo 'Conectado ao Servidor <br>';
        if ($result = ldap_bind($connect, 'AD-CMSJ\\' . $user, $pass)) {

            $_SESSION['login'] = true;
            $_SESSION['usuario'] = $user;


            $filter="(samaccountname=$user)";

            $res = ldap_search($connect, $dn, $filter);

            $entries = ldap_get_entries($connect, $res);

            $_SESSION['nome'] = $entries[0]['cn'][0];

            $isGroupAdmin = preg_grep("/^.*".LDAP_GROUP_ADMIN.".*/", $entries[0]['memberof']);


            if ($isGroupAdmin != null) {
                $_SESSION['admin'] = true;
                //echo 'É Comunicação';
            } else {
                $_SESSION['admin'] = false;
            }
            redirect('/');
        } else {
            redirect('/login?login=false');
        }
    } else {
        echo 'Problema na Conexão';
        exit;
    }
}

public static function dbLogin($username, $password){
    $conexao = mysqlCon();
    $user = getUser($conexao, $username, $password);
    if ($user->num_rows == 1) {
        while ($userData = $user->fetch_assoc()):
            if ($userData['status'] == 1):
                $_SESSION['usuario'] = $userData['username'];
                $_SESSION['nome'] = $userData['display_name'];
                if ($userData['role'] == 1):
                    $_SESSION['admin'] = true;
                else:
                    $_SESSION['admin'] = false;
                endif;
                $_SESSION['login'] = true;
            else:
                redirect('/login?login=false');
            endif;
        endwhile;
        redirect('/');
    } else {
       redirect('/login?login=false');
   }

}

public static function dbStoreUser($display_name, $username,$email, $password, $role){
    $conexao = mysqlCon();
    $result = storeUser($conexao, $display_name, $username,$email, $password, $role);
    if ($result == true) {
        echo "ok";
    } else {
        self::goBack();
    }

}

public static function dbShowUsers(){
    $conexao = mysqlCon();
    $usuarios =  getUsers($conexao);
    return $usuarios;
}

public static function dbShowUser($id){
    $conexao = mysqlCon();
    $usuario =  getUserID($conexao, $id);
    return $usuario;
}

public static function getRole($role):string {
    if ($role == 1) {
        return 'Administrador';
    } else {
        return 'Padrão';
    }
}

public static function dbUpdateUser($id, $display_name, $username, $email, $password,$status, $role){
    $conexao = mysqlCon();
    updateUser($conexao, $id, $display_name, $username, $email, $password,$status, $role);
    redirect('/usuarios');
}

public static function getStatus($status):string {
    if ($status == 1) {
        return 'Ativado';
    } else {
        return 'Desativado';
    }
}

public static function createDB(){
    $mysql = mysqlCon();
    $mysql->query('CREATE TABLE IF NOT EXISTS clipagens (
        ID INT NOT NULL AUTO_INCREMENT PRIMARY KEY,
        titulo varchar(255),
        veiculo varchar(255),
        editoria varchar(255),
        autor varchar(255),
        data varchar(255),
        pagina INT,
        tipo varchar(255),
        tags varchar(255),
        visible boolean DEFAULT true
    )');

    $mysql->query('CREATE TABLE IF NOT EXISTS arquivos (
        ID INT NOT NULL AUTO_INCREMENT PRIMARY KEY,
        id_clipagem INT NOT NULL,
        nome varchar(255)    
    )');

    $mysql->query('CREATE TABLE IF NOT EXISTS usuarios (
        ID INT NOT NULL AUTO_INCREMENT PRIMARY KEY,
        display_name varchar(255),
        username varchar(255) UNIQUE NOT NULL,
        email varchar(255) NOT NULL,
        password varchar(255) NOT NULL,
        status INT DEFAULT 1,
        role INT DEFAULT 0

    )');

    $mysql->query("INSERT INTO usuarios values (1,'Administrador', 'admin', '-','21232f297a57a5a743894a0e4a801fc3', 1,1)");
    $mysql->query("INSERT INTO usuarios values (2,'Visitante', 'user ', '-','ee11cbb19052e40b07aac0ca060c23ee', 1,0)");


}

public static function createDir($dirname) {
    if (!is_dir(dirname(__FILE__) . DIRECTORY_SEPARATOR. $dirname )) {
    mkdir( dirname(__FILE__) . DIRECTORY_SEPARATOR. $dirname, 0777, true );
    }
}


public static function goBack(){
    if(isset($_SERVER['HTTP_REFERER'])) {
        header("Location: {$_SERVER['HTTP_REFERER']}");
        exit;
    }
}

public static function back(){
    if(isset($_SERVER['HTTP_REFERER'])) {
        return $_SERVER['HTTP_REFERER'];
    }
}

public static function logon(){
    session_destroy();
}

public static function getHeader(){
    require_once 'includes' . DIRECTORY_SEPARATOR . 'header.php';
}

public static function getFooter(){
    $request_uri = explode("?",$_SERVER['REQUEST_URI']);
    $request_uri = $request_uri[0];
    global $request_uri;
    if ($request_uri == '/editar') {

        global $clipagem;       
    }


    require_once 'includes' . DIRECTORY_SEPARATOR . 'footer.php';
}



public static function fileExists($id, $nome){
    $conexao = mysqlCon();
    $arquivo = buscarArquivo($conexao, $id);

    if ($arquivo['nome'] == $nome) {
        return true;
    } else {
        return false;
    }            
}

public static function jsonClipagens($inicio, $fim){
    $conexao = mysqlCon();
    $clipagens = listar($conexao, $inicio, $fim);
    $clipagensArray = array();
    while($clipagem = $clipagens->fetch_assoc()) {
        
        array_push($clipagensArray, $clipagem);
    } 
    $query_result = getQuery($conexao,$query = "SELECT COUNT(*) FROM clipagens;")->fetch_assoc()['COUNT(*)'];
    $paginas_total = ceil($query_result / $fim);
    $dados = [
        'Inicio' => $inicio,
        'numItens' => $fim,
        'totalPaginas' => $paginas_total
    ];


    array_push($clipagensArray, $dados);

    echo json_encode($clipagensArray);
 


}


public static function removeAccents($str) {
    $a = array('À', 'Á', 'Â', 'Ã', 'Ä', 'Å', 'Æ', 'Ç', 'È', 'É', 'Ê', 'Ë', 'Ì', 'Í', 'Î', 'Ï', 'Ð', 'Ñ', 'Ò', 'Ó', 'Ô', 'Õ', 'Ö', 'Ø', 'Ù', 'Ú', 'Û', 'Ü', 'Ý', 'ß', 'à', 'á', 'â', 'ã', 'ä', 'å', 'æ', 'ç', 'è', 'é', 'ê', 'ë', 'ì', 'í', 'î', 'ï', 'ñ', 'ò', 'ó', 'ô', 'õ', 'ö', 'ø', 'ù', 'ú', 'û', 'ü', 'ý', 'ÿ', 'Ā', 'ā', 'Ă', 'ă', 'Ą', 'ą', 'Ć', 'ć', 'Ĉ', 'ĉ', 'Ċ', 'ċ', 'Č', 'č', 'Ď', 'ď', 'Đ', 'đ', 'Ē', 'ē', 'Ĕ', 'ĕ', 'Ė', 'ė', 'Ę', 'ę', 'Ě', 'ě', 'Ĝ', 'ĝ', 'Ğ', 'ğ', 'Ġ', 'ġ', 'Ģ', 'ģ', 'Ĥ', 'ĥ', 'Ħ', 'ħ', 'Ĩ', 'ĩ', 'Ī', 'ī', 'Ĭ', 'ĭ', 'Į', 'į', 'İ', 'ı', 'Ĳ', 'ĳ', 'Ĵ', 'ĵ', 'Ķ', 'ķ', 'Ĺ', 'ĺ', 'Ļ', 'ļ', 'Ľ', 'ľ', 'Ŀ', 'ŀ', 'Ł', 'ł', 'Ń', 'ń', 'Ņ', 'ņ', 'Ň', 'ň', 'ŉ', 'Ō', 'ō', 'Ŏ', 'ŏ', 'Ő', 'ő', 'Œ', 'œ', 'Ŕ', 'ŕ', 'Ŗ', 'ŗ', 'Ř', 'ř', 'Ś', 'ś', 'Ŝ', 'ŝ', 'Ş', 'ş', 'Š', 'š', 'Ţ', 'ţ', 'Ť', 'ť', 'Ŧ', 'ŧ', 'Ũ', 'ũ', 'Ū', 'ū', 'Ŭ', 'ŭ', 'Ů', 'ů', 'Ű', 'ű', 'Ų', 'ų', 'Ŵ', 'ŵ', 'Ŷ', 'ŷ', 'Ÿ', 'Ź', 'ź', 'Ż', 'ż', 'Ž', 'ž', 'ſ', 'ƒ', 'Ơ', 'ơ', 'Ư', 'ư', 'Ǎ', 'ǎ', 'Ǐ', 'ǐ', 'Ǒ', 'ǒ', 'Ǔ', 'ǔ', 'Ǖ', 'ǖ', 'Ǘ', 'ǘ', 'Ǚ', 'ǚ', 'Ǜ', 'ǜ', 'Ǻ', 'ǻ', 'Ǽ', 'ǽ', 'Ǿ', 'ǿ', 'Ά', 'ά', 'Έ', 'έ', 'Ό', 'ό', 'Ώ', 'ώ', 'Ί', 'ί', 'ϊ', 'ΐ', 'Ύ', 'ύ', 'ϋ', 'ΰ', 'Ή', 'ή', '"','.', ',');

    $b = array('A', 'A', 'A', 'A', 'A', 'A', 'AE', 'C', 'E', 'E', 'E', 'E', 'I', 'I', 'I', 'I', 'D', 'N', 'O', 'O', 'O', 'O', 'O', 'O', 'U', 'U', 'U', 'U', 'Y', 's', 'a', 'a', 'a', 'a', 'a', 'a', 'ae', 'c', 'e', 'e', 'e', 'e', 'i', 'i', 'i', 'i', 'n', 'o', 'o', 'o', 'o', 'o', 'o', 'u', 'u', 'u', 'u', 'y', 'y', 'A', 'a', 'A', 'a', 'A', 'a', 'C', 'c', 'C', 'c', 'C', 'c', 'C', 'c', 'D', 'd', 'D', 'd', 'E', 'e', 'E', 'e', 'E', 'e', 'E', 'e', 'E', 'e', 'G', 'g', 'G', 'g', 'G', 'g', 'G', 'g', 'H', 'h', 'H', 'h', 'I', 'i', 'I', 'i', 'I', 'i', 'I', 'i', 'I', 'i', 'IJ', 'ij', 'J', 'j', 'K', 'k', 'L', 'l', 'L', 'l', 'L', 'l', 'L', 'l', 'l', 'l', 'N', 'n', 'N', 'n', 'N', 'n', 'n', 'O', 'o', 'O', 'o', 'O', 'o', 'OE', 'oe', 'R', 'r', 'R', 'r', 'R', 'r', 'S', 's', 'S', 's', 'S', 's', 'S', 's', 'T', 't', 'T', 't', 'T', 't', 'U', 'u', 'U', 'u', 'U', 'u', 'U', 'u', 'U', 'u', 'U', 'u', 'W', 'w', 'Y', 'y', 'Y', 'Z', 'z', 'Z', 'z', 'Z', 'z', 's', 'f', 'O', 'o', 'U', 'u', 'A', 'a', 'I', 'i', 'O', 'o', 'U', 'u', 'U', 'u', 'U', 'u', 'U', 'u', 'U', 'u', 'A', 'a', 'AE', 'ae', 'O', 'o', 'Α', 'α', 'Ε', 'ε', 'Ο', 'ο', 'Ω', 'ω', 'Ι', 'ι', 'ι', 'ι', 'Υ', 'υ', 'υ', 'υ', 'Η', 'η','','','');
    return str_replace($a, $b, $str);
}

}

?>