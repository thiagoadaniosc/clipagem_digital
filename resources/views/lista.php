<?php FUNCTIONS::getHeader(); ?>
<div class="row col-lg-12 col-xl-11 col-md-12 baseBody" style="overflow-x: auto;">
    <h1 class="text-left col-lg-12" style="padding: 20px;">Lista de Clipagens</h1>
    
    <form style="padding: 20px;" id="form-pesquisa" class="row col-lg-12 col-xl-12 col-md-12 col-sm-12 justify-content-end">
        <div class="col-lg-3 col-xl-3 col-md-12">
            <label class="col-lg-4 col-xl-4 float-left" style="padding-top:10px; padding-bottom:10px;" for="show">Exibir: </label>
            <select id="show" class="form-control col-lg-4 col-xl-4 float-left" name="show" style="height: 50px; border-radius: 0">
                <?php if (isset($_GET['show']) && $_GET['show'] == 10): ?>
                    <option value="10"  selected="selected">10</option>
                    <option value="20">20</option>
                    <option value="50">50</option>
                    <option value="100">100</option>
                    <option value="500">500</option>
                <?php elseif(isset($_GET['show']) && $_GET['show'] == 20): ?>
                    <option value="10">10</option>
                    <option value="20" selected="selected">20</option>
                    <option value="50">50</option>
                    <option value="100">100</option>
                    <option value="500">500</option>
                <?php elseif(isset($_GET['show']) && $_GET['show'] == 50): ?>
                    <option value="10">10</option>
                    <option value="20">20</option>
                    <option value="50" selected="selected">50</option>
                    <option value="100">100</option>
                    <option value="500">500</option>
                <?php elseif(isset($_GET['show']) && $_GET['show'] == 100): ?>
                    <option value="10">10</option>
                    <option value="20">20</option>
                    <option value="50">50</option>
                    <option value="100" selected="selected">100</option>
                    <option value="500">500</option>
                <?php elseif(isset($_GET['show']) && $_GET['show'] == 500): ?>
                    <option value="10">10</option>
                    <option value="20">20</option>
                    <option value="50">50</option>
                    <option value="100">100</option>
                    <option value="500" selected="selected">500</option>
                <?php else : ?>
                    <option value="10">10</option>
                    <option value="20">20</option>
                    <option value="50">50</option>
                    <option value="100">100</option>
                    <option value="500">500</option>
                <?php endif; ?>
            </select>

            <?php
            if ($complete_request_uri == '/clipagens' || $complete_request_uri == '/') {
                $showLink = '';
            } else {

                if ($complete_request_uri == '/clipagens?show=10' || $complete_request_uri == '/clipagens?show=20' ||
                    $complete_request_uri == '/clipagens?show=50' || $complete_request_uri == '/clipagens?show=100' ||
                    $complete_request_uri == '/clipagens?show=500'){
                    $showLink = '';
            } elseif (explode("show=10&", $complete_request_uri)[0] !== $complete_request_uri) {
                $showLink = explode("show=10&", $complete_request_uri);
                $showLink =  empty($showLink[1]) ? '' : $showLink[1];
            }  elseif (explode("show=20&", $complete_request_uri)[0] !== $complete_request_uri) {
                $showLink = explode("show=20&", $complete_request_uri);
                $showLink =  empty($showLink[1]) ? '' : $showLink[1];
            } elseif (explode("show=50&", $complete_request_uri)[0] !== $complete_request_uri) {
                $showLink = explode("show=50&", $complete_request_uri);
                $showLink =  empty($showLink[1]) ? '' : $showLink[1];

            } elseif (explode("show=100&", $complete_request_uri)[0] !== $complete_request_uri) {
                $showLink = explode("show=100&", $complete_request_uri);
                $showLink =  empty($showLink[1]) ? '' : $showLink[1];        
            } elseif (explode("show=500&", $complete_request_uri)[0] !== $complete_request_uri) {
                $showLink = explode("show=500&", $complete_request_uri);
                $showLink =  empty($showLink[1]) ? '' : $showLink[1];

            } else {
                $showLink = '';

            }
            if (isset($_GET['page'])) {
                $showLink = str_replace('page='.$_GET['page'], '', $showLink);;
            }
            

        } ?>

        <a data-link="<?= $showLink ?>" id="show-link" class="form-control btn btn-primary col-xl-4 col-lg-4 rounded-0" style="color: white; padding: 14px; border-radius: 0 !important;" onclick="showSubmit()">OK</a>
    </div>
    <div class="form-inline justify-content-end col-xl-9 col-lg-9 col-md-12 col-sm-12">
        <select class="form-control col-xl-2 col-lg-2 col-md-12 col-sm-12" name="pesquisar" style="height: 50px; border-radius: 0">
            <option value="todos">Todos</option>
            <option value="titulo">Título</option>
            <option value="data">Data</option>
            <option value="tags">Tags</option>
            <option value="autor">Autor</option>
            <option value="veiculo">Veículo</option>
            <option value="editoria">Editoria</option>
        </select>
        <input class="form-control col-xl-2 col-lg-2 col-md-12 col-sm-12" name="valor" type="search" placeholder="Pesquisar...">
        <select class="form-control col-lg-2 col-xl-2 col-md-12 col-sm-12" name="mes" style="height: 50px; border-radius: 0">
            <option value="">Mês</option>
            <option value="01">Janeiro</option>
            <option value="02">Fevereiro</option>
            <option value="03">Março</option>
            <option value="04">Abril</option>
            <option value="05">Maio</option>
            <option value="06">Junho</option>
            <option value="07">Julho</option>
            <option value="08">Agosto</option>
            <option value="09">Setembro</option>
            <option value="10">Outubro</option>
            <option value="11">Novembro</option>
            <option value="12">Dezembro</option>
        </select>
        <input class="form-control col-lg-3 col-xl-2 col-md-12 col-sm-12" type="number" name="ano" placeholder="Ano">
        <button type="submit" class="btn btn-primary form-control col-lg-2 col-xl-2 col-md-12 col-sm-12" style="padding:14px; border-radius: 0">Pesquisar</button>

    </div>
</form>
<?php if( !isset($_GET['show']) || $_GET['show'] <= 100 ): ?>
    <a href="/pesquisa" class="text-center col-lg-12 print-none" style="padding-left: 20px" target="_blank">Baixar Pesquisa</a>
<?php else : ?>
    <a href="/" class="text-center col-lg-12 print-none" onclick="alert('Máximo de 100 Arquivos por página.');return false;" style="padding-left: 20px" target="_blank">Baixar Pesquisa</a>
<?php endif; ?>

<?php ?>
<?php if(isset($_GET['valor'])): ?>
    <p class="text-center col-lg-12" style="padding: 0; margin-bottom: 0"><b> Pesquisa: </b> <?=$_GET['valor']?>
        <?php if (isset($_GET['mes']) && !empty($_GET['mes'])) : ?>
            <b> Mês: </b> <?=$_GET['mes']?>
        <?php endif; ?>
        <?php if (isset($_GET['ano']) && !empty($_GET['ano'])) : ?>
            <b> Ano: </b> <?=$_GET['ano']?>
        <?php endif; ?>
        
    </p>
<?php endif; ?>
<div class="table-responsive">
    <table class="table table-bordered table-hover table-sm col-lg-12" style="font-size: 1vw !important">

        <thead class="thead-light">
            <th scrope="col">#</th>
            <th scrope="col" style="min-width: 10vw">Título</th>
            <th scrope="col" style="min-width: 8vw; max-width: 8px">Veículo</th>
            <th scrope="col" style="min-width: 5vw;  max-width: 5px">Editoria</th>
            <th scrope="col" style="min-width: 10vw; max-width: 10px">Autor</th>
            <th scrope="col" class=" text-center m-auto d-xl-table-cell d-lg-table-cell">Data<small><br>(Publicação)</small></th>
            <th scrope="col" style="min-width: 2vw" class="text-center" align="center">Página</th>
            <th scrope="col" style="min-width: 8vw;  max-width: 10px" class="d-xl-table-cell d-lg-table-cell d-md-none d-sm-none text-center">Tipo</th>
            <th scrope="col" style="min-width: 15vw;  max-width: 15vw" class="d-xl-table-cell d-lg-table-cell d-md-none d-sm-none">Tags</th>
            <?php if(isAdmin()): ?>
            <th scrope="col" class="d-xl-table-cell d-lg-table-cell d-md-none d-sm-none text-center">Visibilidade</th>
            <?php endif; ?>
            <th scrope="col" class="text-center th-opcoes" align="center" style="min-width: 8vw">Opções</th>
        </thead>
        <tbody>
            <?php 
            $i = 0;
            if (isset($_SESSION['arquivos'])) {
                unset($_SESSION['arquivos']);
            }
            while($dados = $lista->fetch_assoc()): ?>

            <?php if(!isAdmin() && $dados['visible'] == false) {
                continue;
            } ?>
            <?php if ($dados['tipo'] == 'capa') {
                $tipo = 'Capa';
            } elseif($dados['tipo'] == 'conteudo') {
                $tipo = 'Conteúdo Interno';
            } elseif($dados['tipo'] == 'video') {
                $tipo = 'Arquivo de Vídeo';
            } elseif($dados['tipo'] == 'audio') {
                $tipo = 'Arquivo de Audio';
            } elseif($dados['tipo'] == 'link') {
                $tipo = 'Link Externo';
            }
            if ($dados['tipo'] == 'conteudo' || $dados['tipo'] == 'capa') {
                $_SESSION['arquivos'][$i] = $dados['nome'];
                $i++;
            }
            ?>
            <tr>
                <th scope="row"><?=$dados['id_clipagem']?></th>
                <td><?=$dados['titulo']?></td>
                <td><?=$dados['veiculo']?></td>
                <td><?=$dados['editoria']?></td>
                <td>
                    <?php if(strpos($dados['autor'], "http") !== FALSE || strpos($dados['autor'], 'https') !==FALSE): ?>
                    <a href='<?= $dados['autor'] ?>' class="badge badge-primary" title="">
                      <i class="fa fa-eye"></i> Acessar Link
                    </a>
                    <?php else : ?>
                    <p style="word-wrap: break-word; width: 10vw"><?=$dados['autor']?></p>
                    <?= strpos($dados['autor'], "com")?>
                    <?php endif ?>
                </td>
                <td><?=$dados['data']?></td>
                <?php if($dados['tipo'] == 'audio') {
                    $pagina = '<span class="badge badge-primary">Audio</span>';
                } elseif ($dados['tipo'] == 'video') {
                     $pagina = '<span class="badge badge-danger">Video</span>';
                } elseif ($dados['tipo'] == 'link') {
                     $pagina = '<span class="badge badge-dark">Link</span>';
                } else {
                    $pagina = '<span class="badge badge-secondary rounded-0">' .$dados['pagina'] .'</span>';
                }

                 ?>
                <td class="text-center"><?=$pagina?></td>

                <td class="d-xl-table-cell d-lg-table-cell d-md-none d-sm-none text-center"><span class="badge badge-secondary"><?=$tipo?></span></td>
                <td class="d-xl-table-cell d-lg-table-cell d-md-none d-sm-none overflow-x">                
                        <?php $tags_array = explode(',', $dados['tags']);
                            foreach ($tags_array as $tags) {
                                echo '<span class="badge badge-primary mr-2">' .$tags . '</span>';
                            }
                        ?> 

                </td>
                <?php if(isAdmin()): ?>
                    <?php $text_visible = $dados['visible'] ? 'badge badge-success' : 'badge badge-danger' ?>
                <td width="10px" class="d-xl-table-cell d-lg-table-cell d-md-none d-sm-none m-auto text-center">
                    <span class="<?=$text_visible?>"><?php echo $visibilidade = $dados['visible'] ? 'Público' : 'Privado';?></span>
                </td>
                <?php endif; ?>

                <td align="center" class="th-opcoes">
                    <?php 
                    if ($dados['tipo'] == 'link') { // Upload Link
                        $upload_link = $dados['nome'];
                    } else {
                        $upload_link = 'uploads/' . $dados['nome'];
                    }
                    ?>
                    <?php if ($_SESSION['admin'] == true):?> 
                        <a class="badge badge-primary" href="<?= $upload_link ?>" target="_blank"><i class="fa fa-eye"></i></a>
                        <a class="badge badge-secondary bg-dark" href="/editar?id=<?=$dados['id_clipagem']?>"><i class="fa fa-edit"></i></a>
                        <a class="badge badge-danger" onclick="return confirm('Tem certeza que deseja remover este item ? ')" href="/deletar?id=<?=$dados['id_clipagem']?>"><i class="fa fa-trash-o"></i></a>
                    <?php else:  ?>
                        <a class="badge badge-primary" href="<?= $upload_link ?>" target="_blank"> Visualizar <i class="fa fa-eye"></i></a>
                    <?php endif;?>
                </td>
            </tr>
        <?php endwhile; ?>
    </tbody>
    <caption> 
        <?php
        $regInicial = isset($_GET['page']) && !empty($_GET['page']) ? $_GET['page'] : 1;
        $page = isset($_GET['page']) && !empty($_GET['page']) ? $_GET['page'] : 1;
        $regFinal = isset($_GET['show']) && !empty($_GET['show']) ? $_GET['show'] : 10;
        
        if ($regInicial != 1) {
            $regInicial = ($regInicial -1) * $regFinal;
        } else {
            $regInicial = 1;
        }

        if (($regFinal * $page) >= $_SESSION['totalReg']) {
            $regFinal = $_SESSION['totalReg'];
        } else {
            $regFinal = $regFinal * $page;
        }

        ?>
        Listando <?= $regInicial ?> de <?= $regFinal ?> para <?= $_SESSION['totalReg']?> - Clipagens encontradas
    </caption>
</table>
</div>

<div class="row col-lg-12 justify-content-center">
    <nav aria-label="...">
        <ul class="pagination">

            <?php $page = isset($_GET['page']) && !empty($_GET['page']) ? $_GET['page'] : 1; ?>
            <?php $show = isset($_GET['show']) && !empty($_GET['show']) ? $_GET['show'] : 10; ?>

            <?php $totalReg = $_SESSION['totalReg'] ?>
            <?php $lastPage = ceil($totalReg / $show);  ?>
            <?php 
            if ($complete_request_uri == '/clipagens' || $complete_request_uri == '/') {
                $pageURI = '/clipagens?page=';
            } else {
                $pageURI = explode("&page", $complete_request_uri);
                $pageURI = explode("?page", $pageURI[0]);

                if ($pageURI[0] == '/clipagens') {
                    $pageURI = $pageURI[0].'?page=';
                } else {
                    $pageURI = $pageURI[0].'&page=';
                }
            }
            
            ?>
            <?php if ($page > 1): ?>
                <li class="page-item">
                    <a class="page-link" href="<?=$pageURI . ($page-1)?>" tabindex="-1" aria-label="Previous">
                        <span aria-hidden="true">&laquo;</span>
                        <span class="sr-only">Previous</span>
                    </a>
                </li>


                <li class="page-item"><a class="page-link" href="<?=$pageURI . ($page-1)?>"><?= $page -1; ?></a></li>

            <?php endif; ?>
            <li class="page-item active">
                <a class="page-link" href="<?=$pageURI . $page?>"><?= $page; ?><span class="sr-only">(current)</span></a>
            </li>


            <?php if ($page < $lastPage) : ?>
                <li class="page-item"><a class="page-link" href="<?=$pageURI . ($page+1)?>"><?= $page + 1;?></a></li>

                <li class="page-item">
                    <a class="page-link" href="<?=$pageURI. ($page+1)?>" aria-label="Next">
                        <span aria-hidden="true">&raquo;</span>
                        <span class="sr-only">Next</span>
                    </a>
                </li>
            <?php endif; ?>
        </ul>
    </nav>
</div>

</div>
<?php FUNCTIONS::getFooter(); ?>