<?php
class FUNCTIONS {

    public static function dd($value){
        echo  '<h1>'.$value . '<h1>';
        exit;
    }

    public static function cadastrarClipagemTest() { 
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
        
    }
    
    public static function cadastrarClipagem() {

        $conexao = mysqlCon();
        
        $titulo = $_POST['titulo'];
        $veiculo = $_POST['veiculo'];
        $editoria = $_POST['editoria'];
        $autor = $_POST['autor'];
        $data = $_POST['data'];
        $date = new DateTime($data);
        $data = $date->format('d/m/Y');
        $pagina = $_POST['pagina'];
        $tipo = $_POST['tipo'];
        $tags = $_POST['tags'];
        
        $conexao = cadastro_clipagem($conexao, $titulo, $veiculo, $editoria, $autor, $data, $pagina, $tipo, $tags);
        $id_clipagem = $conexao->insert_id;
        $date = new DateTime($_POST['data']);
        $data = $date->format('d-m-Y');
        
        
        //$titulo = FUNCTIONS::removeAccents($titulo);
        
        $fileName = $data . '-' . $id_clipagem . '.pdf';
        //$fileName = str_replace(' ', '_', $fileName);
        
        FUNCTIONS::uploadArquivos($conexao, $id_clipagem, $fileName);
        
        /*$id_clipagem = $conexao->insert_id;
        
        $fileName =  $id_clipagem. '-' .$_FILES['file']['name'];
        
        $tempFile = $_FILES['file']['tmp_name'];     
        
        $targetPath = dirname( __FILE__ ) . DIRECTORY_SEPARATOR. 'uploads'. DIRECTORY_SEPARATOR;
        
        $targetFile =  $targetPath. $fileName;
        
        move_uploaded_file($tempFile,$targetFile);
        
        cadastro_arquivo($conexao, $id_clipagem, $fileName);
        */
    }
    
    public static function uploadArquivos($conexao, $id_clipagem, $fileName){
        require_once 'vendor' . DIRECTORY_SEPARATOR . 'autoload.php';
        $pdf = new \Clegginabox\PDFMerger\PDFMerger;
        //$fileName = str_replace('"','', $fileName)
        
        //$fileName =  $id_clipagem. '-' .$_FILES['file']['name'];
        //$targetPath = dirname( __FILE__ ) . DIRECTORY_SEPARATOR. 'uploads'. DIRECTORY_SEPARATOR;
        //$targetFile =  $targetPath. $fileName;
        //move_uploaded_file($tempFile,$targetFile);
        
        foreach ($_FILES['file']['tmp_name'] as $tempFile){
            $pdf->addPDF($tempFile, 'all');        
        }
        
        $pdf->merge('file', 'uploads'. DIRECTORY_SEPARATOR . $fileName, 'P');
        
        cadastro_arquivo($conexao, $id_clipagem, $fileName);
        
    }
    
    public static function editarClipagem() {
        require_once 'vendor' . DIRECTORY_SEPARATOR . 'autoload.php';
        $pdf = new \Clegginabox\PDFMerger\PDFMerger;
        $conexao = mysqlCon();
        
        $titulo = $_POST['titulo'];
        $id = $_POST['id'];
        $veiculo = $_POST['veiculo'];
        $editoria = $_POST['editoria'];
        $autor = $_POST['autor'];
        $data = $_POST['data'];
        $date = new DateTime($data);
        $data = $date->format('d/m/Y');
        $pagina = $_POST['pagina'];
        $tipo = $_POST['tipo'];
        $tags = $_POST['tags'];
        
        
        
        atualizarClipagem($conexao,$id, $titulo, $veiculo, $editoria, $autor, $data, $pagina, $tipo, $tags);
        
        if (empty($_FILES['file']['name'][0])== false) {



            foreach ($_FILES['file']['tmp_name'] as $tempFile){
                $pdf->addPDF($tempFile, 'all');        
                echo $tempFile;
            }
            
            $date = new DateTime($_POST['data']);
            
            $data = $date->format('d-m-Y');
            
            /*$titulo = FUNCTIONS::removeAccents($titulo);
            
            $fileName = trim(mb_strtolower($titulo, 'UTF-8')). '_' . trim(mb_strtolower($veiculo, 'UTF-8')). '-' . $data . '-' . $id . '.pdf';
            $fileName = str_replace(' ', '_', $fileName);
            */
            $fileName = $data . '-' . $id . '.pdf';
            
            $pdf->merge('file', 'uploads'. DIRECTORY_SEPARATOR . $fileName, 'P');
            
            $arquivo =  buscarArquivo($conexao, $id);
            
            atualizarArquivo($conexao, $arquivo['ID'], $fileName);
        }
        
        header('Location: /clipagens');
        
        
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
        //echo 'Inicio:' . $inicio . ' FIM:' . $fim;
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
        header('Location: clipagens');
    }
    
    public static function downloadPesquisa(){
        require_once 'vendor' . DIRECTORY_SEPARATOR . 'autoload.php';
        $pdf = new \Clegginabox\PDFMerger\PDFMerger;
        
        if (isset($_SESSION['arquivos'])) {
            $fileName = $_SESSION['usuario']. '_' . 'pesquisa.pdf';
            foreach($_SESSION['arquivos'] as $arquivo){
                if(file_exists('uploads/' . $arquivo)) {
                    $pdf->addPDF('uploads'. DIRECTORY_SEPARATOR . $arquivo, 'all');
                }
            }
            $pdf->merge('file', 'pesquisas'. DIRECTORY_SEPARATOR . $fileName);
            header('Location: pesquisas/' . $fileName);
            
            //$pdf->merge('donwload', 'uploads'. DIRECTORY_SEPARATOR . 'testedownload.pdf');
            //unset($_SESSION['arquivos']);
        } else {
            header('Location: /clipagens');   
        }
    }
    public static function guestLogin($username){
        $_SESSION['usuario'] = $username;
        $_SESSION['nome'] = $username;
        $_SESSION['admin'] = false;
        $_SESSION['login'] = true;
        return header('Location: /clipagens');
    }

    public static function login(){
        if (LDAP_LOGIN){
            FUNCTIONS::adlogin($username, $password);
        } else {
            FUNCTIONS::dbLogin($username, $password);
        }
    }
    
    public static function adlogin($user, $pass){
        // $conexao = mysqlCon();
        /*
        $checkLogin = checkLogin($conexao, $user, $pass);
        if ($checkLogin != false) {
            $_SESSION['login'] = true;
            $_SESSION['nome'] = $checkLogin['nome'];
            $_SESSION['usuario'] = $checkLogin['login'];
            header('Location:/');
        } else {
            header('Location: /login?login=false');
        }*/
        
        $ldap_server = 'ad.cmsj.sc.gov.br';
        $ldapport = 389;
        $dn="DC=ad,DC=cmsj,DC=sc,DC=gov,DC=br";
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

                $isComunicacao = preg_grep("/^.*{LDAP_GROUP_ADMIN}.*/", $entries[0]['memberof']);


                if ($isComunicacao != null) {
                    $_SESSION['admin'] = true;
                    echo 'É Comunicação';
                } else {
                    $_SESSION['admin'] = false;
                }
                echo 'Logado';
                header('Location: /');
            } else {
                echo 'deslogado';
                header('Location: /login?login=false');
            }
        } else {
            echo 'Problema na Conexão';
            exit;
        }
            /* } catch(Exception $e){
                echo 'Erro ao Conectar';
                exit;
            }*/
            
            
            //var_dump($entries);
            
            //var_dump($entries[0]['department'][0]);
            //var_dump($entries[0]['cn'][0]);
            //var_dump($entries[0]['memberof']);
            
            //var_dump(in_array('CN=Comunicação', $entries[0]['memberof']));
            
            
            
            
            // var_dump($result);
            /*
            if ($_POST['usuario'] == 'cmsj' && $_POST['senha'] == 'cmsj@2018') {
                $_SESSION['login'] = true;
                $_SESSION['usuario'] = 'CMSJ';
                echo $_SESSION['usuario'];
                header('Location:/');
            } else {
                header('Location: /login?login=false');
            }
            */
        }

        public static function dbLogin($username, $password){
            $conexao = mysqlCon();
            $user = getUser($conexao, $username, $password);
            if ($user->num_rows == 1) {
                while ($userData = $user->fetch_assoc()):
                    $_SESSION['usuario'] = $userData['username'];
                    $_SESSION['nome'] = $userData['display_name'];
                    if ($userData['role'] == 1):
                        $_SESSION['admin'] = true;
                    else:
                        $_SESSION['admin'] = false;
                    endif;
                    $_SESSION['login'] = true;
                endwhile;
                self::goBack();
            } else {
                header('Location: /login?login=false');
            }

        }

        public static function dbStoreUser($display_name, $username, $password, $role){
            $conexao = mysqlCon();
            $result = storeUser($conexao, $display_name, $username, $password, $role);
            var_dump($result);
            if ($result == true) {
                echo "ok";
            } else {
                echo "Este usuário ja foi cadastrado.";
            }

        }

        public function createDB(){
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
                tags varchar(255)
            )');

            $mysql->query('CREATE TABLE IF NOT EXISTS arquivos (
                ID INT NOT NULL AUTO_INCREMENT PRIMARY KEY,
                id_clipagem INT NOT NULL,
                nome varchar(255)    
            )');

            $mysql->query('CREATE TABLE usuarios (
                ID INT NOT NULL AUTO_INCREMENT PRIMARY KEY,
                display_name varchar(255),
                username varchar(255) UNIQUE NOT NULL,
                password varchar(255) NOT NULL,
                role INT DEFAULT 0

            )');
        }

        public static function goBack(){
            if(isset($_SERVER['HTTP_REFERER'])) {
                header("Location: {$_SERVER['HTTP_REFERER']}");
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


    public static function removeAccents($str) {
        $a = array('À', 'Á', 'Â', 'Ã', 'Ä', 'Å', 'Æ', 'Ç', 'È', 'É', 'Ê', 'Ë', 'Ì', 'Í', 'Î', 'Ï', 'Ð', 'Ñ', 'Ò', 'Ó', 'Ô', 'Õ', 'Ö', 'Ø', 'Ù', 'Ú', 'Û', 'Ü', 'Ý', 'ß', 'à', 'á', 'â', 'ã', 'ä', 'å', 'æ', 'ç', 'è', 'é', 'ê', 'ë', 'ì', 'í', 'î', 'ï', 'ñ', 'ò', 'ó', 'ô', 'õ', 'ö', 'ø', 'ù', 'ú', 'û', 'ü', 'ý', 'ÿ', 'Ā', 'ā', 'Ă', 'ă', 'Ą', 'ą', 'Ć', 'ć', 'Ĉ', 'ĉ', 'Ċ', 'ċ', 'Č', 'č', 'Ď', 'ď', 'Đ', 'đ', 'Ē', 'ē', 'Ĕ', 'ĕ', 'Ė', 'ė', 'Ę', 'ę', 'Ě', 'ě', 'Ĝ', 'ĝ', 'Ğ', 'ğ', 'Ġ', 'ġ', 'Ģ', 'ģ', 'Ĥ', 'ĥ', 'Ħ', 'ħ', 'Ĩ', 'ĩ', 'Ī', 'ī', 'Ĭ', 'ĭ', 'Į', 'į', 'İ', 'ı', 'Ĳ', 'ĳ', 'Ĵ', 'ĵ', 'Ķ', 'ķ', 'Ĺ', 'ĺ', 'Ļ', 'ļ', 'Ľ', 'ľ', 'Ŀ', 'ŀ', 'Ł', 'ł', 'Ń', 'ń', 'Ņ', 'ņ', 'Ň', 'ň', 'ŉ', 'Ō', 'ō', 'Ŏ', 'ŏ', 'Ő', 'ő', 'Œ', 'œ', 'Ŕ', 'ŕ', 'Ŗ', 'ŗ', 'Ř', 'ř', 'Ś', 'ś', 'Ŝ', 'ŝ', 'Ş', 'ş', 'Š', 'š', 'Ţ', 'ţ', 'Ť', 'ť', 'Ŧ', 'ŧ', 'Ũ', 'ũ', 'Ū', 'ū', 'Ŭ', 'ŭ', 'Ů', 'ů', 'Ű', 'ű', 'Ų', 'ų', 'Ŵ', 'ŵ', 'Ŷ', 'ŷ', 'Ÿ', 'Ź', 'ź', 'Ż', 'ż', 'Ž', 'ž', 'ſ', 'ƒ', 'Ơ', 'ơ', 'Ư', 'ư', 'Ǎ', 'ǎ', 'Ǐ', 'ǐ', 'Ǒ', 'ǒ', 'Ǔ', 'ǔ', 'Ǖ', 'ǖ', 'Ǘ', 'ǘ', 'Ǚ', 'ǚ', 'Ǜ', 'ǜ', 'Ǻ', 'ǻ', 'Ǽ', 'ǽ', 'Ǿ', 'ǿ', 'Ά', 'ά', 'Έ', 'έ', 'Ό', 'ό', 'Ώ', 'ώ', 'Ί', 'ί', 'ϊ', 'ΐ', 'Ύ', 'ύ', 'ϋ', 'ΰ', 'Ή', 'ή', '"','.', ',');

        $b = array('A', 'A', 'A', 'A', 'A', 'A', 'AE', 'C', 'E', 'E', 'E', 'E', 'I', 'I', 'I', 'I', 'D', 'N', 'O', 'O', 'O', 'O', 'O', 'O', 'U', 'U', 'U', 'U', 'Y', 's', 'a', 'a', 'a', 'a', 'a', 'a', 'ae', 'c', 'e', 'e', 'e', 'e', 'i', 'i', 'i', 'i', 'n', 'o', 'o', 'o', 'o', 'o', 'o', 'u', 'u', 'u', 'u', 'y', 'y', 'A', 'a', 'A', 'a', 'A', 'a', 'C', 'c', 'C', 'c', 'C', 'c', 'C', 'c', 'D', 'd', 'D', 'd', 'E', 'e', 'E', 'e', 'E', 'e', 'E', 'e', 'E', 'e', 'G', 'g', 'G', 'g', 'G', 'g', 'G', 'g', 'H', 'h', 'H', 'h', 'I', 'i', 'I', 'i', 'I', 'i', 'I', 'i', 'I', 'i', 'IJ', 'ij', 'J', 'j', 'K', 'k', 'L', 'l', 'L', 'l', 'L', 'l', 'L', 'l', 'l', 'l', 'N', 'n', 'N', 'n', 'N', 'n', 'n', 'O', 'o', 'O', 'o', 'O', 'o', 'OE', 'oe', 'R', 'r', 'R', 'r', 'R', 'r', 'S', 's', 'S', 's', 'S', 's', 'S', 's', 'T', 't', 'T', 't', 'T', 't', 'U', 'u', 'U', 'u', 'U', 'u', 'U', 'u', 'U', 'u', 'U', 'u', 'W', 'w', 'Y', 'y', 'Y', 'Z', 'z', 'Z', 'z', 'Z', 'z', 's', 'f', 'O', 'o', 'U', 'u', 'A', 'a', 'I', 'i', 'O', 'o', 'U', 'u', 'U', 'u', 'U', 'u', 'U', 'u', 'U', 'u', 'A', 'a', 'AE', 'ae', 'O', 'o', 'Α', 'α', 'Ε', 'ε', 'Ο', 'ο', 'Ω', 'ω', 'Ι', 'ι', 'ι', 'ι', 'Υ', 'υ', 'υ', 'υ', 'Η', 'η','','','');
        return str_replace($a, $b, $str);
    }


}

?>