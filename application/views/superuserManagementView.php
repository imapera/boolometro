<div class="container mt-3 mb-3">
	<h1>Gestión de datos</h1>
	<div id="accordion">
	  <div class="card mt-2 mb-2">
		<div class="card-header" id="headingOne">
		  <h5 class="mb-0">
			<button class="btn btn-link collapsed" data-toggle="collapse" data-target="#collapseOne" aria-expanded="false" aria-controls="collapseOne">
			  Bulómetros
			</button>
		  </h5>
		</div>
		<div id="collapseOne" class="collapse <?php if ($platformsFilter != "") echo 'show'; ?>" aria-labelledby="headingOne" data-parent="#accordion">
		    <div class="card-body">
				<form action="<?php echo base_url('superUserManagement'); ?>" method="POST">
					<input type="text" class="form-control>" id="platformFilter" name="platformFilter" placeholder="Escribe algo" value="<?php echo $platformsFilter; ?>">
					<div class="invalid-feedback">
					</div>
					<button type="submit" class="btn btn-primary" id="platformFilterSubmit" name="platformFilterSubmit" value="platformFilterSubmit">Filtrar</button>
				</form>
				<table class="table">
					<thead>
						<tr>
							<th scope="col">Nombre</th>
							<th scope="col">Descripción</th>
							<th scope="col">Temática</th>
							<th scope="col"></th>
						</tr>
					</thead>
					<tbody>
						<?php
							foreach ($platforms as $platform){
								echo '<tr>';
								echo '<td>'.$platform['title'].'</td>';
								echo '<td><small>'.$platform['description'].'<small></td>';
								echo '<td>'.$platform['theme'].'</td>';
								echo '<td><a href="'.base_url('platform/id/'.$platform['id']).'">Ver</a></td>';
								echo '</tr>';
							}
						?>
					</tbody>
				</table>
		    </div>
		</div>
	  </div>
	</div>
	<div id="informer-accordion">
	  <div class="card mt-2 mb-2">
		<div class="card-header" id="headingTwo">
		  <h5 class="mb-0">
			<button class="btn btn-link collapsed" data-toggle="collapse" data-target="#collapseTwo" aria-expanded="false" aria-controls="collapseTwo">
			  Informadores
			</button>
		  </h5>
		</div>
		<div id="collapseTwo" class="collapse <?php if ($informersFilter != "") echo 'show'; ?>" aria-labelledby="headingTwo" data-parent="#informer-accordion">
		    <div class="card-body">
				<form action="<?php echo base_url('superUserManagement'); ?>" method="POST">
					<input type="text" class="form-control>" id="informersFilter" name="informersFilter" placeholder="Escribe algo" value="<?php echo $informersFilter; ?>">
					<div class="invalid-feedback">
					</div>
					<button type="submit" class="btn btn-primary" id="informerFilterSubmit" name="informerFilterSubmit" value="informerFilterSubmit">Filtrar</button>
				</form>
				<table class="table">
					<thead>
						<tr>
							<th scope="col">Nombre</th>
							<th scope="col">Descripción</th>
							<th scope="col"></th>
						</tr>
					</thead>
					<tbody>
						<?php
							foreach ($informers as $informer){
								echo '<tr>';
								echo '<td>'.$informer['name'].'</td>';
								echo '<td><small>'.$informer['description'].'<small></td>';
								echo '<td><a href="'.base_url('informer/id/'.$informer['id']).'">Ver</a></td>';
								echo '</tr>';
							}
						?>
					</tbody>
				</table>
		    </div>
		</div>
	  </div>
	</div>
	<div id="new-accordion">
	  <div class="card mt-2 mb-2">
		<div class="card-header" id="headingThree">
		  <h5 class="mb-0">
			<button class="btn btn-link collapsed" data-toggle="collapse" data-target="#collapseThree" aria-expanded="false" aria-controls="collapseThree">
			  Noticias
			</button>
		  </h5>
		</div>
		<div id="collapseThree" class="collapse show" aria-labelledby="headingThree" data-parent="#new-accordion">
		    <div class="card-body">
				<form action="<?php echo base_url('superUserManagement'); ?>" method="POST">
					<input type="text" class="form-control>" id="newsFilter" name="newsFilter" placeholder="Escribe algo" value="<?php echo $newsFilter; ?>">
					<div class="invalid-feedback">
					</div>
					<button type="submit" class="btn btn-primary" id="newsFilterSubmit" name="newsFilterSubmit" value="newsFilterSubmit">Filtrar</button>
				</form>
				<table class="table">
					<thead>
						<tr>
							<th scope="col">Titulo</th>
							<th scope="col">Reusmen</th>
							<th scope="col">Fecha origen</th>
							<th scope="col">Informador</th>
							<th scope="col">Fecha resultado</th>
							<th scope="col"></th>
						</tr>
					</thead>
					<tbody>
						<?php
							foreach ($news as $new){
								echo '<tr>';
								echo '<td>'.$new['title'].'</td>';
								echo '<td><small>'.$new['resume'].'<small></td>';
								echo '<td>'.$new['originDate'].'</td>';
								echo '<td>'.$new['informerName'].'</td>';
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
	</div>
</div>

		

		

