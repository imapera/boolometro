<div class="container mt-3 mb-3">
	<h1>Informadores</h1>
	<div id="container">
		<form action="<?php echo base_url('informer/listAll'); ?>" method="POST">
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

		

		

