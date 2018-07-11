<?php FUNCTIONS::getHeader(); ?>
<div class="row col-lg-11 col-xl-6 col-md-11 col-sm-11 justify-content-center formBody">
    <style type="text/css" media="screen">
        .kv-file-upload{
            display: none !important;
        }
        .kv-file-remove {
            display: inline !important;
        }
    </style>
    <h1 class="text-center"> <i class="fa fa-file-pdf-o"></i> Juntar PDF</h1>
    <form class="col-lg-12 col-sm-8 row" method="post" action="/arquivos/juntar" enctype="multipart/form-data">
        <div class="form-group col-lg-12">
            <!-- <label for="titulo">Título</label> -->
            <div class="input-group">
                <div class="input-group-prepend">
                    <label class="input-group-text" style="height: 50px;" for="titulo">Título</label>
                </div>

                <input type="text" class="form-control" name="fileName" placeholder="Título do Arquivo gerado" aria-describedby="tituloHelp" id="titulo"
                    required>
            </div>
            <!-- <small id="tituloHelp" class="form-text text-muted">Insirá o titulo da matéria</small> -->
        </div>

        <div class="form-group col-lg-12">
            <input id="file_join" name="file[]" type="file" style="height: 50px;" class="file"  data-show-caption="true"
                data-msg-placeholder="Selecione {arquivos} para a matéria..." multiple>
        </div>

        <div class="form-group col-lg-12">
            <button class="float-left btn btn-danger col-lg-5 rounded-0" style="height: 50px;" type="button"  onclick="window.location.href='/'">
                <i class="fa fa-times" aria-hidden="true"></i> CANCELAR </button>

            <button class="float-right btn btn-primary col-lg-5 rounded-0" style="height: 50px;" type="submit">Juntar
                <i class="fa fa-plus" aria-hidden="true"></i>
            </button>
            
        </div>
    </form>
</div>

<?php FUNCTIONS::getFooter(); ?>