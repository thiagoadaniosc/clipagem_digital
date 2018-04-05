<?php FUNCTIONS::getHeader(); ?>

<div class="row col-lg-8 col-xl-4 col-md-8 justify-content-center menuBody">
    <h2 class="col-lg-12 text-center">Menu Principal</h2>

    <a href="/cadastro" class="btn btn-primary col-lg-12" style="margin-top: 20px; padding: 30px; border-radius: 0px; font-size: 25px">Nova Clipagem</a>

    <a href="/clipagens" class="btn btn-primary col-lg-12" style="margin-top: 20px; padding: 30px; border-radius: 0px ; font-size: 25px">Lista de Clipagens</a>

    <a href="/informacoes" class="btn btn-secondary col-lg-12" style="margin-top: 20px; padding: 30px; border-radius: 0px; font-size: 25px">INFORMAÇÕES</a>

    <p class="text-center" style="margin-top: 20px">
    <span class="text-center badge badge-primary">Versão: <?=$version?></span>
    <br>
    <span class="text-center badge badge-light">By: TI CMSJ</span>

    </p>

</div>



<?php FUNCTIONS::getFooter(); ?>