<div class="container mt-3 mb-3">
  <div class="row">
    <div class="col-sm">
		<div class="container bg-dark text-white p-2 rounded">
		  <div class="row">
			<div class="col-sm">
				<img src="img/profileEmpty.png" class="rounded" alt="">
			</div>
			<div class="col-sm">
				<div class="container mt-3">
				  <div class="row">
					<div class="col-sm">
						<h2><?php echo $userdata['username']; ?></h2>
						<p><small><?php echo $userdata['email']; ?></small></p>
					</div>
				  </div>
				  <div class="row">
					<div class="col-sm">
						<p>Fecha de registro: <?php echo $userdata['registration_date']; ?></p>
						<p><a href="#">Editar tus datos</a> | <a href="<?php echo base_url('platformsManagement'); ?>">Crear bulómetro</a><?php if ($userdata['isSuperuser'] == "1") echo " | <a href='".base_url('superuserManagement')."'>Área de gestión del sistema</a>"; ?></p>
					</div>
				  </div>
				</div>
			</div>
		  </div>
		</div>
    </div>
    <div class="col-sm">
		Bulómetros que sigues:
		<table class="table">
			<thead>
				<tr>
					<th scope="col">Título</th>
					<th scope="col">Temática</th>
				</tr>
			</thead>
			<tbody>
				<?php
					foreach ($suscribedPlatforms as $platform){
						echo "<tr>";
						echo '<td><a href="'.base_url('platform/id/'.$platform['id']).'">'.$platform['title'].'</a></td>';
						echo '<td>'.$platform['theme'].'</td>';
						echo '</tr>';
					}
				?>
			</tbody>
		</table>
    </div>
    <div class="col-sm">
		Bulómetros que administras:
		<table class="table">
			<thead>
				<tr>
					<th scope="col">Título</th>
					<th scope="col">Temática</th>
				</tr>
			</thead>
			<tbody>
				<?php
					foreach ($administratedPlatforms as $platform){
						echo "<tr>";
						echo '<td><a href="'.base_url('platform/id/'.$platform['id']).'">'.$platform['title'].'</a><p><small>Administrador</small></p></td>';
						echo '<td>'.$platform['theme'].'</td>';
						echo '</tr>';
					}
					foreach ($ownedPlatforms as $platform){
						echo "<tr>";
						echo '<td><a href="'.base_url('platform/id/'.$platform['id']).'">'.$platform['title'].'</a><p><small>Propietario</small></p></td>';
						echo '<td>'.$platform['theme'].'</td>';
						echo '</tr>';
					}
				?>
			</tbody>
		</table>
	</div>
  </div>
  <div class="row">
    <div class="col-sm">
		Tus comentarios:
    </div>
	<table class="table">
		<thead>
			<tr>
				<th scope="col">Fecha</th>
				<th scope="col">Comentario</th>
				<th scope="col">Noticia</th>
			</tr>
		</thead>
		<tbody>
			<?php
				foreach ($comments as $comment){
					echo "<tr>";
					echo '<td class="col-md-2">'.$comment['date'].'</td>';
					echo '<td class="col-md-6">'.$comment['content'].'</td>';
					echo '<td class="col-md-4"><a href="'.base_url('news/id/'.$comment['idNew']).'">'.$comment['newTitle'].'</a></td>';
					echo '</tr>';
				}
			?>
		</tbody>
	</table>
  </div>
</div>

