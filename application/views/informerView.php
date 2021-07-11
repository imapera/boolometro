<div class="container mt-3 mb-3">
  <h1><?php echo $informerData['name']; ?></h1><hr class=" mt-0 mb-0 w-25">Informador
  <div class="row mt-4">
    <div class="col-md-auto">
		<div class="container mt-3 mb-3">
			<div class="row mt-4">
				<div class="col-sm">
					<img src="<?php echo base_url('img/profileEmpty.png'); ?>" class="rounded" alt="">
				</div>
			</div>
			<div class="row mt-0 mb-0">
				<div class="col-sm">
					<small><i>Ficha creada el <?php echo $informerData['registered']; ?></i><?php if ($this->session->username != '') echo ' | <a href="'.base_url('informer/registerInformer/'.$informerData['id']).'"> Editar </a>'; ?></small>
				</div>
			</div>
			<div class="row mt-4">
				<div class="col-sm">
					Enlaces:
					<?php
						if (isset($informerData['socialLink1']) and $informerData['socialLink1'] != "") echo "<a href='".$informerData['socialLink1']."'><img src='".base_url("img/socialLink1Icon.png")."'></a>";
						if (isset($informerData['socialLink2']) and $informerData['socialLink2'] != "") echo "<a href='".$informerData['socialLink2']."'><img src='".base_url("img/socialLink2Icon.png")."'></a>";
						if (isset($informerData['socialLink3']) and $informerData['socialLink3'] != "") echo "<a href='".$informerData['socialLink3']."'><img src='".base_url("img/socialLink3Icon.png")."'></a>";
					?>
				</div>
			</div>
		</div>
    </div>
    <div class="col-sm">
		<div class="container mt-3 mb-3">
			<div class="row mt-4">
				<div class="col-sm">
					<?php echo $informerData['description']; ?>
				</div>
			</div>
			<div class="row mt-4">
				<div class="col-sm bg-light round pb-3">
					<h2>Valoración</h2>
					<div class="container">
						<div class="row">
							<div class="col">
								Noticias correctas:
								<p><?php echo $correctNews; ?></p>
							</div>
							<div class="col">
								Noticias incorrectas:
								<p><?php echo $wrongNews ?></p>
							</div>
							<div class="col">
								Puntuación:
								<p><?php echo $mark ?></p>
							</div>
						</div>
						<div class="row">
							<div class="col">
								<?php
									if ($totalNews >= 8){
										
										switch ($valoration){
											case 0:
												echo '<div class="container bg-danger rounded text-light pt-2 pb-2 w-50">Este informador tiene una tasa de acierto de: '.$successRate.'%</div>';
												break;
											case 1:
												echo '<div class="container bg-warning rounded text-light pt-2 pb-2 w-50">Este informador tiene una tasa de acierto de: '.$successRate.'%</div>';
												break;
											case 2:
												echo '<div class="container bg-info rounded text-light pt-2 pb-2 w-50">Este informador tiene una tasa de acierto de: '.$successRate.'%</div>';
												break;
											case 3:
												echo '<div class="container bg-success rounded text-light pt-2 pb-2 w-50">Este informador tiene una tasa de acierto de: '.$successRate.'%</div>';
												break;
											case 4:
												echo '<div class="container bg-success rounded text-light pt-2 pb-2 w-50">Este informador tiene una tasa de acierto de: '.$successRate.'%</div>';
												break;
											default:
												break;
										}
									} else {
										echo '<div class="container bg-danger rounded text-light pt-2 pb-2">No se dispone de noticias resueltas suficientes para estableccer la valoración de este informador.</div>';
									}
								?>
							</div>
						</div>
					</div>
				</div>
			</div>
		</div>
	</div>
  </div>
  <div class="row">
    <div class="col-sm">
		<h1>Sus noticias</h1>
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
			foreach ($news as $new){
				echo '<tr>';
				echo '<th scope="col"><p>'.$new['title'].'</p><p><small>'.$new['resume'].'</small></p><p><small>En <a href="">'.$new['platformTitle'].'</a></small></p></th>';
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
</div>

		

		

