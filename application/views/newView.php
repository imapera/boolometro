<div class="container mt-3 mb-3">
	<h1><?php echo $newData['title']; ?></h1><hr class=" mt-0 mb-0 w-25"><a href="<?php echo base_url('platform/id/'.$newData['idPlatform']); ?>"><?php echo $newData['platformTitle']; ?></a>
	<div class="row mt-4">
		<div class="col-md-auto">
			<div class="container mt-3 mb-3">
				<div class="row mt-0">
					<div class="col-sm">
						<img src="<?php echo base_url('img/emptyNewIcon.png'); ?>" class="rounded" alt="">
					</div>
				</div>
				<div class="row mt-0 mb-0">
					<div class="col-sm">
						<small><i>Noticia registrada el <?php echo $newData['registered']; ?></i><?php if ($userCanEdit) { echo ' | <a href='.base_url('news/registerEditNew/'.$newData['idPlatform']."/".$newData['id']).'>Editar</a> | <a href='.base_url('news/resolveNew/'.$newData['id']).'>Resolver</a>'; } ?></small>
						<hr>
						<p class="mb-1">Informador:</p>
						<img src="<?php echo base_url('img/profileEmpty.png'); ?>" class="rounded" alt="">
						<div class="container mt-1 mb-3 bg-light w-75 pt-1 pb-1">
							<b><?php echo '<a href="'.base_url('informer/id/'.$newData['idInformer']).'" class=" text-dark">',$newData['informerName'].'</a>'; ?></b>
						</div>
						<hr>
						<p>Enlaces a las fuentes:</p>
						<?php 
							if ((isset($newData['link1'])) and ($newData['link1'] != "")) echo "<a href='".$newData['link1']."'>Fuente 1</a> ";
							if ((isset($newData['link2'])) and ($newData['link2'] != "")) echo "| <a href='".$newData['link2']."'>Fuente 2</a> ";
							if ((isset($newData['link3'])) and ($newData['link3'] != "")) echo "| <a href='".$newData['link3']."'>Fuente 3</a> ";			
						?>
					</div>
				</div>
			</div>
		</div>
		<div class="col-sm">
			<div class="container mt-3 mb-3">
				<div class="row mt-4">
					<div class="col-sm text-justify">
						<?php echo $newData['description']; ?>
					</div>
				</div>
				<div class="row mt-4">
					<div class="col-sm">
						<h3>Fecha de publicación</h3>
						<hr class="mt-1 mb-1 w-50">
						<h4><?php echo $newData['origin_date']; ?></h4>
					</div>
					<div class="col-sm">
						<h3>Fecha de resolución</h3>
						<hr class="mt-1 mb-1 w-50">
						<h4><?php echo $newData['result_date']; ?></h4>
					</div>
				</div>
				<div class="row mt-4">
					<div class="col-sm">					
						<?php
							if ($newData["result"] == "0") echo '<div class="container bg-info w-50 rounded text-white pt-2 pb-2"><h3>Resultado</h3><hr class="mt-1 mb-1 w-50"><h4>Resultado aún desconocido</h4></div>';
							if ($newData["result"] == "1") echo '<div class="container bg-success w-50 rounded text-white pt-2 pb-2"><h3>Resultado</h3><hr class="mt-1 mb-1 w-50"><h4>Correcto</h4></div>';
							if ($newData["result"] == "2") echo '<div class="container bg-danger w-50 rounded text-white pt-2 pb-2"><h3>Resultado</h3><hr class="mt-1 mb-1 w-50"><h4>Incorrecto</h4></div>';
							if ($newData["result"] == "3") echo '<div class="container bg-warning w-50 rounded text-white pt-2 pb-2"><h3>Resultado</h3><hr class="mt-1 mb-1 w-50"><h4>No pudo ser determinado</h4></div>';
						?>
						<div class="container mt-2 pt-2 pb-2 text-justify"><?php echo $newData['resultDescription']; ?></div>
					</div>
				</div>
				<div class="row mt-4">
					<div class="col-sm">	
						<h2>Comentarios</h2>
					</div>
				</div>
			</div>
		</div>
	</div>
</div>

		

		

