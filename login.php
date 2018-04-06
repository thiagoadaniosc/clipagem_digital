<?php FUNCTIONS::getHeader(); ?>
<div class="row col-lg-7 col-xl-4 col-md-10 baseBody justify-content-center" style="overflow:auto;">
    <img src="img/brasao.jpg" class="img-fluid" alt="" style="height:150px;">
    <h4 class="col-lg-12 text-center text-primary">Autenticação</h4>
    <?php if (isset($_GET['login']) && $_GET['login'] == 'false'){?>
        <small class="text-danger">Usuário ou senha incorretos !</small>
    <?php } else {?>
    <small>Autenticação necessária</small>
    <?php } ?>

    <form action="/logar" method="post" class="col-lg-12 m-4 mb-5">
        <div class="form-group">
            <input class="form-control" type="text" name="usuario" placeholder="Usuário..." required="true">
            <input class="form-control mt-4" type="password" name="senha" placeholder="Senha..." required="true">
            <div>
            <a href="http://intranet.cmsj.info">
            <button class="form-control mt-4 btn btn-danger col-xl-5 col-lg-5 float-left" type="button" name="" id="voltar" style="border-radius: 0 !important; height: 50px !important;"> <i class="fa fa-reply"></i> VOLTAR  </button>
            </a>
            <button class="form-control mt-4 btn btn-primary col-xl-5 col-lg-5 float-right" type="submit" name="" id="entrar" style="border-radius: 0 !important; height: 50px !important;">ENTRAR <i class="fa fa-sign-in" ></i> </button>
            </div>
        </div>
    </form>
    <p class="text-center" style="margin-top: 20px">
    <span class="text-center badge badge-primary">Versão: <?=$version?></span>
    <br>
    <span class="text-center badge badge-light">By: TI CMSJ</span>
    

    </p>
</div>
<?php FUNCTIONS::getFooter(); ?>