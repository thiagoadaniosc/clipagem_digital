<?php FUNCTIONS::getHeader(); ?>

<div class="row col-lg-8 col-xl-10 col-md-8 justify-content-center menuBody relatorios-body">
	<h2 class="col-lg-12 text-center mt-0 text-white p-2 relatorios-header">Relatórios</h2>

	
	<div class="row p-2 col-lg-12">
		<ul class="relatorios row col-lg-12 list-unstyled">

			<li class="col-lg-4">
				<div class="bg-primary relatorios-card col-lg-12" style="background: linear-gradient(to bottom, rgba(255,255,255,0.15) 0%, rgba(0,0,0,0.15) 100%), radial-gradient(at top center, rgba(255,255,255,0.40) 0%, rgba(0,0,0,0.40) 120%) #989898; 
 background-blend-mode: multiply,multiply;">
					<h2 class="text-white text-center pt-1">Total de Clipagens</h2>
					<hr>
					<h4 class="text-center text-white counter"><?= $total_clipagens; ?></h4>
				</div>
			</li>

			<li class="col-lg-4">
				<div class="bg-primary relatorios-card col-lg-12" style="background: linear-gradient(to bottom, rgba(255,255,255,0.15) 0%, rgba(0,0,0,0.15) 100%), radial-gradient(at top center, rgba(255,255,255,0.40) 0%, rgba(0,0,0,0.40) 120%) #989898; 
 background-blend-mode: multiply,multiply;">
					<h2 class="text-white text-center pt-1">Total de Hoje</h2>
					<hr>
					<h4 class="text-center text-white counter"><?= $total_today; ?></h4>
				</div>
			</li>

			<li class="col-lg-4">
				<div class="relatorios-card col-lg-12" style="background: linear-gradient(to bottom, #323232 0%, #3F3F3F 40%, #1C1C1C 150%), linear-gradient(to top, rgba(255,255,255,0.40) 0%, rgba(0,0,0,0.25) 200%);
 background-blend-mode: multiply;">
					<h2 class="text-white text-center pt-1">Clipagens de Arquivos</h2>
					<hr>
					<h4 class="text-center text-white counter"><?= $total_arquivos;?></h4>
				</div>
			</li>


			<li class="col-lg-4">
				<div class="relatorios-card col-lg-12" style="background-image: linear-gradient(to top, #0ba360 0%, #3cba92 100%);">
					<h2 class="text-white text-center pt-1">Clipagens de Links</h2>
					<hr>
					<h4 class="text-center text-white counter"><?= $total_link;?></h4>
				</div>
			</li>

			<li class="col-lg-4">
				<div class="bg-primary relatorios-card col-lg-12" style="background-image: linear-gradient(60deg, #29323c 0%, #485563 100%);">
					<h2 class="text-white text-center pt-1">Clipagens de Video</h2>
					<hr>
					<h4 class="text-center text-white counter"><?= $total_video;?></h4>
				</div>
			</li>

			<li class="col-lg-4">
				<div class="bg-primary relatorios-card col-lg-12" style="background-image: linear-gradient(to top, #1e3c72 0%, #1e3c72 1%, #2a5298 100%);">
					<h2 class="text-white text-center pt-1">Clipagens de Audio</h2>
					<hr>
					<h4 class="text-center text-white counter"><?= $total_audio;?></h4>
				</div>
			</li>


		</ul>
	</div>
</div>



<?php FUNCTIONS::getFooter(); ?>