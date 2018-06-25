<?php FUNCTIONS::getHeader(); ?>

<div class="row col-lg-8 col-xl-6 col-md-8 justify-content-center menuBody">
	<h2 class="col-lg-12 text-center">Menu Principal</h2>
	
	<div class="row p-2 col-lg-12">
		
		<div class="col-lg-6">
			<a href="/clipagens" class="btn btn-primary col-lg-12 float-right" style="margin-top: 20px; padding: 30px; border-radius: 0px ; font-size: 1.5em"> <i class="fa fa-paperclip"></i> Clipagens</a>
		</div>

		<div class="col-lg-6">
			<a href="/cadastro/menu" class="btn btn-primary col-lg-12" style="margin-top: 20px; padding: 30px; border-radius: 0px; font-size: 1.5em">Nova Clipagem <i class="fa fa-plus-square"></i>
			</a>	
		</div>

		<?php if(!LDAP_LOGIN): ?>
		<div class="col-lg-6">
			<a href="/usuarios" class="btn btn-primary col-lg-12 float-right" style="margin-top: 20px; padding: 30px; border-radius: 0px ; font-size: 25px"> <i class="fa fa-users"></i>
			Usuários</a>
		</div>

		<div class="col-lg-6">
			<a href="/usuario/cadastrar" class="btn btn-primary col-lg-12 float-right" style="margin-top: 20px; padding: 30px; border-radius: 0px ; font-size: 25px">Novo Usuário <i class="fa fa-user-plus"></i>
			</a>
		</div>

		<?php  endif;?>

		<div class="col-lg-6">
			<a href="/informacoes" class="btn btn-secondary disabled col-lg-12" style="margin-top: 20px; padding: 30px; border-radius: 0px; font-size: 25px"><i class="fa fa-line-chart	
"></i> Relatórios</a>
		</div>

		<div class="col-lg-6">
			<a href="/informacoes" class="btn btn-secondary col-lg-12" style="margin-top: 20px; padding: 30px; border-radius: 0px; font-size: 25px">INFORMAÇÕES <i class="fa fa-info-circle"></i></a>
		</div>
	</div>

	<p class="text-center" style="margin-top: 20px">
		<span class="text-center badge badge-primary">Versão: <?=$version?></span>
		<br>
		<span class="text-center badge badge-light">By: TI CMSJ</span>

	</p>

</div>



<?php FUNCTIONS::getFooter(); ?>