<?php FUNCTIONS::getHeader(); ?>

<div class="row col-lg-8 col-xl-6 col-md-8 justify-content-center menuBody">
	<h2 class="col-lg-12 text-center"> Cadastro de Clipagem </h2>
	
	<div class="row p-2 col-lg-12">
		
		<div class="col-lg-6">
			<a href="/cadastro/link" class="btn btn-primary col-lg-12 float-right" style="margin-top: 20px; padding: 30px; border-radius: 0px ; font-size: 1.2em"> <i class="fa fa-link"></i> Link (Página de Internet)</a>
		</div>

		<div class="col-lg-6">
			<a href="/cadastro/arquivo" class="btn btn-secondary col-lg-12" style="margin-top: 20px; padding: 30px; border-radius: 0px; font-size: 1.2em"> Arquivo (PDF) <i class="fa fa-file-pdf-o"></i>
			</a>	
		</div>

		
		<div class="col-lg-6">
			<a href="/cadastro/video" class="btn btn-primary col-lg-12 float-right" style="margin-top: 20px; padding: 30px; border-radius: 0px ; font-size: 1.2em"> <i class="fa fa-film"></i>
			Video (mp4)</a>
		</div>

		<div class="col-lg-6">
			<a href="/cadastro/audio" class="btn btn-secondary col-lg-12 float-right" style="margin-top: 20px; padding: 30px; border-radius: 0px ; font-size: 1.2em"> Audio (mp3) <i class="fa fa-music"></i>
			</a>
		</div>
	</div>

	<p class="text-center" style="margin-top: 20px">
		<span class="text-center badge badge-primary">Versão: <?=$version?></span>
		<br>
		<span class="text-center badge badge-light">By: TI CMSJ</span>

	</p>

</div>



<?php FUNCTIONS::getFooter(); ?>