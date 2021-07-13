<div class="container mt-3 mb-3">
	<h1>Moderación del bulómetro</h1>
</div>

<div class="container mt-3 mb-3">
	<h3>Denuncias a la plataforma pendientes</h3>
	<table class="table">
		<thead>
			<th scope="col">Razón de la denuncia</th>
			<th scope="col">Mensaje de denuncia</th>
			<th scope="col"></th>
		</thead>
		<tbody>
			<?php
				foreach ($platformsReports as $report){
					echo '<tr>';
					echo '<td>'.$report['reasonOnText'].'</td>';
					echo '<td>'.$report['message'].'</td>';
					echo '<td><a href="'.base_url('platform/id/'.$report['idResource']).'">Ver plataforma</a><br><a href="'.base_url('platform/checkedReport/'.$report['id']).'">Marcar como revisada</a></td>';
					echo '</tr>';
				}			
			?>
		</tbody>
	</table>
</div>
<div class="container mt-3 mb-3">
	<h3>Denuncias a noticias pendientes</h3>
	<table class="table">
		<thead>
			<th scope="col">Razón de la denuncia</th>
			<th scope="col">Mensaje de denuncia</th>
			<th scope="col"></th>
		</thead>
		<tbody>
			<?php
				foreach ($newsReports as $report){
					echo '<tr>';
					echo '<td>'.$report['reasonOnText'].'</td>';
					echo '<td>'.$report['message'].'</td>';
					echo '<td><a href="'.base_url('news/id/'.$report['idResource']).'">Ver noticia</a><br><a href="'.base_url('platform/checkedReport/'.$report['id']).'">Marcar como revisada</a></td>';
					echo '</tr>';
				}			
			?>
		</tbody>
	</table>
</div>
<div class="container mt-3 mb-3">
	<h3>Denuncias a comentarios pendientes</h3>
	<table class="table">
		<thead>
			<th scope="col">Razón de la denuncia</th>
			<th scope="col">Mensaje de denuncia</th>
			<th scope="col">Comentario denunciado</th>
			<th scope="col"></th>
		</thead>
		<tbody>
			<?php
				foreach ($commentsReports as $report){
					echo '<tr>';
					echo '<td class="col-md-2">'.$report['reasonOnText'].'</td>';
					echo '<td class="col-md-3">'.$report['message'].'</td>';
					echo '<td class="col-md-4">'.$report['commentContent'].'</td>';
					echo '<td class="col-md-3"><a href="'.base_url('news/id/'.$report['idNew']).'">Ver noticia</a><br><a href="'.base_url('platform/checkedReport/'.$report['id']).'">Marcar como revisada</a><br><a href="'.base_url('platform/deleteComment/'.$platform['id'].'/'.$report['idResource'].'/'.$report['id']).'">Eliminar comentario</a></td>';
					echo '</tr>';
				}			
			?>
		</tbody>
	</table>
</div>
<div class="container mt-3 mb-3">
	<h3>Denuncias a fichas de informadres pendientes</h3>
	<table class="table">
		<thead>
			<th scope="col">Razón de la denuncia</th>
			<th scope="col">Mensaje de denuncia</th>
			<th scope="col">Comentario denunciado</th>
			<th scope="col"></th>
		</thead>
		<tbody>
			<?php
				foreach ($informersReports as $report){
					echo '<tr>';
					echo '<td>'.$report['reasonOnText'].'</td>';
					echo '<td>'.$report['message'].'</td>';
					echo '<td><a href="'.base_url('informer/id/'.$report['idResource']).'">Ver informador</a><br><a href="'.base_url('platform/checkedReport/'.$report['id']).'">Marcar como revisada</a></td>';
					echo '</tr>';
				}			
			?>
		</tbody>
	</table>
</div>
		

		

