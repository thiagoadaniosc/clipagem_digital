<?php FUNCTIONS::getHeader();
?>
<div class="row col-lg-11 col-xl-8 col-md-8 justify-content-center formBody">
    <h1 class="text-center">Editar Clipagem</h1>
    <form class="col-lg-12 col-sm-8 row" method="post" action="/editar" enctype="multipart/form-data">
        <div class="form-group col-lg-12">
            <!-- <label for="titulo">Título</label> -->
            <div class="input-group">
                <div class="input-group-prepend">
                    <label class="input-group-text" style="height: 50px;" for="titulo">Título</label>
                </div>

                <input type="text" value="<?= $clipagem['titulo'] ?>" class="form-control" name="titulo" placeholder="Título da Matéria" aria-describedby="tituloHelp" id="titulo"
                    required>
            </div>
            <!-- <small id="tituloHelp" class="form-text text-muted">Insirá o titulo da matéria</small> -->
        </div>

        <input type="hidden" name="id" value="<?=$clipagem['ID']?>">

        <div class="form-group col-lg-6">
            <input type="text" value="<?=$clipagem['veiculo']?> " class="form-control col-lg-12" name="veiculo" id="veiculo" placeholder="Veículo" required>

        </div>

        <div class="form-group col-lg-6">
            <input type="text" value="<?=$clipagem['editoria']?>" class="form-control col-lg-12" name="editoria" id="editoria" placeholder="Editoria" required>
        </div>

        <div class="form-group col-lg-12">
            <input class="form-control" value="<?=$clipagem['editoria']?>" type="text" name="autor" placeholder="Autor" required>
        </div>

        <div class="form-group col-lg-12">
                
                <?php
                $clipagem['data'] = str_replace('/','-', $clipagem['data']);
                $data = new DateTime($clipagem['data']);
                ?>
            
            <input class="form-control" type="date" value="<?= $data->format('Y-m-d'); ?>" name="data" placeholder="Data" required>
        </div>

        <div class="form-group col-lg-6">
            <input class="form-control" value="<?=$clipagem['pagina']?>" type="number" name="pagina" placeholder="Página" required>
        </div>

        <div class=" form-group col-lg-6 justify-content-center ">
            <div class="btn-group" data-toggle="buttons">

                <?php if ($clipagem['tipo'] == 'capa'): ?>


                <label class="btn btn-primary active" style="padding: 14px; border-radius: 0;">
                    <input type="radio" name="tipo" id="option1" autocomplete="off" value="capa" checked>Capa
                </label>

                <label class="btn btn-primary" style="padding: 14px; border-radius: 0;">
                    <input type="radio" name="tipo" id="option2" autocomplete="off" value="conteudo">Conteudo Interno
                </label>
                <?php else :?>

                <label class="btn btn-primary" style="padding: 14px; border-radius: 0;">
                    <input type="radio" name="tipo" id="option1" autocomplete="off" value="capa">Capa
                </label>

                <label class="btn btn-primary active" style="padding: 14px; border-radius: 0;">
                    <input type="radio" name="tipo" id="option2" autocomplete="off" value="conteudo" checked>Conteudo Interno
                </label>

                <?php endif; ?>


            </div>
        </div>

        <div class="form-group col-lg-12">
            <input class="form-control" type="text" value="<?=$clipagem['tags']?>" name="tags" data-role="tagsinput" id="tagInput" placeholder="Tags" required>
        </div>
        <div class="form-group col-lg-12">
            <input id="file" name="file[]" type="file" style="height: 50px;" class="file" data-show-upload="false" data-show-caption="true"
                data-msg-placeholder="Selecione {arquivos} para a matéria..." multiple>
        </div>
        <div class="form-group col-lg-12">
            <button class="float-left btn btn-danger col-lg-5" style="height: 50px;" type="button"  onclick="window.location.href='<?= FUNCTIONS::back();?>'">
                <i class="fa fa-times" aria-hidden="true"></i> CANCELAR </button>

            <button class="float-right btn btn-primary col-lg-5" style="height: 50px;" type="submit">Editar
                <i class="fa fa-check" aria-hidden="true"></i>
            </button>

        </div>
    </form>
</div>

<?php 
global $request_uri;
FUNCTIONS::getFooter(); ?>