<?php FUNCTIONS::getHeader(); ?>
<div class="row col-lg-11 col-xl-6 col-md-11 col-sm-11 justify-content-center formBody">
    <h1 class="text-center">Cadastro de Clipagem</h1>
    <form class="col-lg-12 col-sm-8 row" method="post" action="/cadastrar" enctype="multipart/form-data">
        <div class="form-group col-lg-12">
            <!-- <label for="titulo">Título</label> -->
            <div class="input-group">
                <div class="input-group-prepend">
                    <label class="input-group-text" style="height: 50px;" for="titulo">Título</label>
                </div>

                <input type="text" class="form-control" name="titulo" placeholder="Título da Matéria" aria-describedby="tituloHelp" id="titulo"
                    required>
            </div>
            <!-- <small id="tituloHelp" class="form-text text-muted">Insirá o titulo da matéria</small> -->
        </div>

        <div class="form-group col-lg-6">
            <input type="text" class="form-control col-lg-12" name="veiculo" id="veiculo" placeholder="Veículo" required>

        </div>

        <div class="form-group col-lg-6">
            <input type="text" class="form-control col-lg-12" name="editoria" id="editoria" placeholder="Editoria" required>
        </div>

        <div class="form-group col-lg-12">
            <input class="form-control" type="text" name="autor" placeholder="Autor" required>
        </div>

        <div class="form-group col-lg-12">
            <input class="form-control" type="date" value="0000-01-01" name="data" placeholder="Data" required>
        </div>

        <div class="form-group col-lg-6">
            <input class="form-control" type="number" name="pagina" placeholder="Página" required>
        </div>

        <div class=" form-group col-lg-6 justify-content-center ">
            <div class="btn-group" data-toggle="buttons">
                <label class="btn btn-primary" style="padding: 14px; border-radius: 0;">
                    <input type="radio" name="tipo" id="option1" autocomplete="off" value="capa">Capa
                </label>
                <label class="btn btn-primary active" style="padding: 14px; border-radius: 0;">
                    <input type="radio" name="tipo" id="option2" autocomplete="off" value="conteudo" checked>Conteudo Interno
                </label>
            </div>
        </div>

        <div class="form-group col-lg-12">
            <input class="form-control" type="text" name="tags" data-role="tagsinput" id="tagInput" placeholder="Tags" required>
        </div>

        <div class="form-group col-lg-12">
            <input class="form-control float-left" value="1" type="checkbox" name="visible" style="height: 25px !important; width: 30px !important" checked>
            <label for="visible" class="ml-2"><strong>Público</strong> (Visibilidade)</label>
        </div>

        <div class="form-group col-lg-12">
            <input id="file" name="file[]" type="file" style="height: 50px;" class="file" data-show-upload="false" data-show-caption="true"
                data-msg-placeholder="Selecione {arquivos} para a matéria..." multiple required>
        </div>
        <div class="form-group col-lg-12">
            <button class="float-left btn btn-danger col-lg-5 rounded-0" style="height: 50px;" type="button"  onclick="window.location.href='/'">
                <i class="fa fa-times" aria-hidden="true"></i> CANCELAR </button>

            <button class="float-right btn btn-primary col-lg-5 rounded-0" style="height: 50px;" type="submit">Cadastrar
                <i class="fa fa-plus" aria-hidden="true"></i>
            </button>
            
        </div>
    </form>
</div>

<?php FUNCTIONS::getFooter(); ?>