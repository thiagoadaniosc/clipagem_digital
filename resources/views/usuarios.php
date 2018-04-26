<?php FUNCTIONS::getHeader(); ?>

<div class="row col-lg-12 col-xl-11 col-md-12 baseBody" style="overflow-x: auto;">
	<h1 class="text-left col-lg-12" style="padding: 20px;">Usuários Cadastrados</h1>

	<table class="table table-sm table-hover">
		<thead>
			<tr>
				<th>#</th>
				<th>Username</th>
				<th>Nome Completo</th>
				<th>E-mail</th>
				<th>Tipo</th>
				<th>Status</th>
				<th>Opções</th>
			</tr>
		</thead>
		<tbody>
			<?php while($usuario = $usuarios->fetch_assoc()): ?>
				<tr>
					<td><?= $usuario['ID'] ?></td>
					<td><?= $usuario['username'] ?></td>
					<td><?= $usuario['display_name'] ?></td>
					<td><?= $usuario['email'] ?></td>
					<td><?= FUNCTIONS::getRole($usuario['role'])?></td>
					<td><?= FUNCTIONS::getStatus($usuario['status'])?></td>
					<td><a style="text-decoration: none;" href="/usuario/editar?id=<?= $usuario['ID']?>" class="badge badge-primary"> Editar <i class="fa fa-edit"></i> </a></td>
				</tr>
			<?php endwhile; ?>
		</tbody>
	</table>

</div>

<?php FUNCTIONS::getFooter(); ?>