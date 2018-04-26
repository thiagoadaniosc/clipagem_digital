<?php FUNCTIONS::getHeader(); ?>
<div class="row col-lg-8 col-xl-4 col-md-11 col-sm-11 justify-content-center formBody">
    <h1 class="text-center">Cadastro de Usuário</h1>
    <form class="col-lg-12 col-sm-8 row" method="post" action="/usuario/store" enctype="multipart/form-data">
        <div class="form-group col-lg-12">
            <!-- <label for="titulo">Título</label> -->
            <div class="input-group">
                <div class="input-group-prepend">
                    <label class="input-group-text" style="height: 50px;" for="titulo"><i class="fa fa-address-card-o"></i></label>
                </div>

                <input type="text" class="form-control" name="username" placeholder="Username" aria-describedby="usernameHelp" id="titulo"
                    required>
            </div>
        </div>

        <div class="form-group col-lg-12">
            <input type="text" class="form-control col-lg-12" name="display_name" id="display_name" placeholder="Nome Completo" required>
        </div>
        <div class="form-group col-lg-12">
            <input type="email" class="form-control col-lg-12" name="email" id="email" placeholder="E-mail: teste@gmail.com" required>
        </div>

        <div class="form-group col-lg-12">
            <select name="role" class="c-select form-control rounded-0" style="height: 50px !important;" required>
                <option value="0">Padrão</option>
                <option value="1">Administrador</option>
            </select>
        </div>

        <div class="form-group col-lg-12">
            <input class="form-control" type="password" name="password" placeholder="Senha..." required>
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