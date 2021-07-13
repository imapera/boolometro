<?php if ($message == "reportPlatformSuccessful") { echo '<div class="container mt-3 mb-3 rounded bg-success text-white w-50 pt-2 pb-2">Denuncia registrada correctamente</div>'; }?>
<div class="container mt-3 mb-3">
  <h1><?php echo $platformData['title']; ?></h1><hr class=" mt-0 mb-0 w-25">
  <?php echo $platformData['theme']; ?>
  <div class="row mt-4">
    <div class="col-md-auto">
		<img src="<?php echo base_url('img/emptyPlatformIcon.png'); ?>" class="rounded" alt="">
		<?php
			if ($this->session->username){
				if ($platformData['isSuscribed']){
					echo '<p>Estas suscrito. <a href="'.base_url('platform/unsuscribe/'.$platformData['id']).'">Borrar suscripción</a></p>';
				} else {
					echo '<p><a href="'.base_url('platform/suscribe/'.$platformData['id']).'">Suscribirme</a></p>';
				}
			} else {
				echo '<p><small>Inicia sesión para suscribirte</small></p>';
			}
		?>
    </div>
    <div class="col-sm">
		<div class="container mt-3 mb-3">
		  <div class="row mt-3">
			<div class="col-sm text-justify">
				<?php echo $platformData['description']; ?>
			</div>
		  </div>
		  <div class="row mt-3">
			<div class="col-sm">
				<?php
					if ($platformData['isOwner'] or $platformData['isAdministrator']) {
						if ($platformData['isOwner']) echo '<i>Eres el propietario</i>';
						elseif ($platformData['isAdministrator']) echo '<i>Eres administrador</i>';
					} else echo 'Bulómetro de '.$platformData['idUser'].'</i>';
					echo ' | Creado el <i>'.$platformData['registration_date'].'</i>';
						
						
				?>			
			</div>
		  </div>
		</div>
	</div>
	<?php if ($platformData['isOwner'] or $platformData['isAdministrator']) { ?>
		<div class="col-md-3 bg-light rounded">
			<div class="container mt-3 mb-3">
				<div class="row mt-4">
					<div class="col-sm">
						<h3>Gestión del bulómetro</h3>
					</div>
				</div>
				<div class="row mt-4">
					<div class="col-sm">
						<?php
						if ($platformData['isOwner'] or $platformData['isAdministrator']) {
							echo '<a href="'.base_url('news/registerEditNew/'.$platformData['id']).'">Añadir noticia</a> | <a href="'.base_url('informer/registerInformer/').'">Crear ficha de informador</a> | <a href="'.base_url('platform/moderation/'.$platformData['id']).'">Moderación y denuncias</a>';
						} ?>
					</div>
				</div>
				<div class="row mt-4">
					<div class="col-sm">
					<?php if ($platformData['isOwner']) { ?>
						<table class="table">
							<thead>
								<th>Administradores</th>
							</thead>
							<tbody>
								<?php
									if (sizeof ($platformData['administrators'])) {
										foreach ($platformData['administrators'] as $administrator){
											echo '<tr>';
											echo '<td scope="col">'.$administrator['username'].' | <a href="'.base_url('platform/deleteAdministrator/'.$platformData['id'].'/'.$administrator['id']).'">Quitar</a></td>';
											echo '</tr>';
										}
									} else {
										echo "<tr><td>No hay administradores</td></tr>";
									}
								?>
							</tbody>
						</table>
					<?php } ?>
					</div>
				</div>
				<div class="row mt-4">
					<div class="col-sm">
					<?php if ($platformData['isOwner']) { ?>
						<p class="mb-3">Añadir nuevo administrador:</p>
						<form action="<?php echo base_url('platform/addAdministrator/'.$platformData['id']); ?>" method="POST">
							<select class="form-control" id="userId" name="userId" required>
								<option value=""></option>
								<?php
									foreach ($users as $user){
										echo '<option value="'.$user['id'].'">'.$user['username'].'</option>';
									}
								?>
							</select>
							<button type="submit" class="btn btn-primary mt-1" id="newsFilterSubmit" name="newsFilterSubmit" value="newsFilterSubmit">Añadir</button>
						</form>					
					<?php } ?>
					</div>
				</div>
			</div>
		</div>
	<?php } ?>
  </div>
  <div class="row mt-3">
    <div class="col-sm">
		<hr>
    </div>
  </div>
  <div class="row mt-3">
    <div class="col-sm">
		<h2>Noticias</h2>
    </div>
    <div class="col-sm-auto">
		<form action="<?php echo base_url('platform/id/'.$platformData['id']); ?>" method="POST">
			<input type="text" class="form-control>" id="newsFilter" name="newsFilter" placeholder="Escribe algo" value="<?php echo $newsFilter; ?>">
			<div class="invalid-feedback">
			</div>
			<button type="submit" class="btn btn-primary" id="newsFilterSubmit" name="newsFilterSubmit" value="newsFilterSubmit">Filtrar</button>
		</form>
	</div>
  </div>
  <div class="row mt-3">
    <div class="col-sm">
		<table class="table">
		  <thead>
			<tr>
			  <th scope="col">Noticia</th>
			  <th scope="col">Informador</th>
			  <th scope="col">Fecha original</th>
			  <th scope="col">Resultado</th>
			  <th scope="col">Fecha de resolución</th>
			  <th scope="col"></th>
			</tr>
		  </thead>
		  <tbody>
		  <?php
			foreach ($newsData as $new){
				echo '<tr>';
				echo '<th scope="col"><p>'.$new['title'].'</p><p><small>'.$new['resume'].'</small></p></th>';
				echo '<td>'.$new['informerName'].'</td>';
				echo '<td>'.$new['originDate'].'</td>';
				echo '<td>';
				switch ($new['result']){
					case 0:
						echo 'Desconocido';
						break;
					case 1:
						echo 'Acierto';
						break;
					case 2:
						echo 'Fallo';
						break;
					case 3:
						echo 'Indemostrable';
						break;
					default:
						echo '';
						break;
				}
				echo '</td>';
				echo '<td>'.$new['resultDate'].'</td>';
				echo '<td><a href="'.base_url('news/id/'.$new['id']).'">Ver</a></td>';
				echo '</tr>';
			}		  
		  ?>
		  </tbody>
		</table>
    </div>
  </div>
  <form action="<?php echo base_url('platform/report/'.$platformData['id']); ?>" method="POST">
	<div class="row mt-4">
		<div class="col-md-auto">
			Denunciar bulómetro:
		</div>
	</div>
	<div class="row mt-2">
		<div class="col-md-5">
			<select class="form-control" id="reportReason" name="reportReason" required>
				<option value=""></option>
				<option value="badInformation">Información incorrecta o falsa</option>
				<option value="unrespectful">Faltas de respeto</option>
				<option value="badLanguaje">Lenguaje inapropiado</option>
				<option value="others">Otros</option>
			</select>
		</div>
	</div>
	<div class="row mt-2">
		<div class="col-md-5">
			<input type="text" class="form-control w-100" id="reportMessage" name="reportMessage" placeholder="Descrive la denuncia brevemente" required>
		</div>
	</div>
	<div class="row mt-2">
		<div class="col-md-auto">
			<button type="submit" class="btn btn-primary" id="reportPlatform" name="reportPlatform" value="reportPlatform">Denunciar</button>
		</div>
	</div>
  </form>
</div>
