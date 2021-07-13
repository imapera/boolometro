<?php if (($message == "reportNewSuccessful") or ($message == "reportCommentSuccessful")) { echo '<div class="container mt-3 mb-3 rounded bg-success text-white w-50 pt-2 pb-2">Denuncia registrada correctamente</div>'; }?>
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
			</div>
		</div>
	</div>
	<div class="row mt-4">
		<div class="col-sm">	
			<h2>Comentarios</h2>
			<?php if ($this->session->userID){ ?>
				<div class="container mt-3 mb-3 bg-light rounded pb-2 w-50">
					<div class="row">
						<div class="col pt-2">
							Deja tu comentario
						</div>
					</div>
						<form action="<?php echo base_url('news/addComment/'.$newData["id"]); ?>" method="POST">
							<div class="row">
									<div class="col-10">
										<textarea class="form-control" id="commentContent" name="commentContent" placeholder="Escribre lo que piensas respetando siempre a los demás." rows="3" required></textarea>
									</div>
									<div class="col-2 align-middle">
										<button type="submit" class="btn btn-primary" id="send" name="send" value="send">Enviar</button>
									</div>
							</div>
						</form>
				</div>
			<?php } ?>
			<?php foreach ($comments as $comment) { ?>
				<div class="container mt-3 mb-3 w-75 bg-light rounded">
					<div class="row bg-light pb-1">
						<div class="col-md-2 pt-3">
							<img src="<?php echo base_url('img/profileEmptyThumbail.png'); ?>" class="rounded" alt=""><br>
							<?php echo $comment['username']?><br>
							<?php echo $comment['date']?>
						</div>
						<div class="col-md-10 pt-3 text-justify">
							<?php echo $comment['content']?>
						</div>
					</div>
					<div class="row pb-1">
						<div class="col-md-12 pt-3 text-right">
							<small><a href="" data-toggle="modal" data-target="#<?php echo "modalComment".$comment['id']; ?>">Denunciar</a></small>
						</div>
					</div>
				</div>	
			<?php } ?>
		</div>
	</div>
  <form action="<?php echo base_url('platform/report/'.$newData['id']); ?>" method="POST">
	<div class="row mt-4">
		<div class="col-md-auto">
			Denunciar noticia:
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
			<button type="submit" class="btn btn-primary" id="reportNew" name="reportNew" value="reportNew">Denunciar</button>
		</div>
	</div>
  </form>
</div>

<?php foreach ($comments as $comment) { ?>
	<div class="modal fade" id="<?php echo "modalComment".$comment['id']; ?>" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
	  <div class="modal-dialog" role="document">
		<div class="modal-content">
		  <div class="modal-header">
			<h5 class="modal-title" id="exampleModalLabel">Denunciar comentario de <?php echo $comment['username']; ?></h5>
			<button type="button" class="close" data-dismiss="modal" aria-label="Close">
			  <span aria-hidden="true">&times;</span>
			</button>
		  </div>
		  <div class="modal-body">
			<?php echo $comment['content']; ?>
			  <form action="<?php echo base_url('platform/report/'.$comment['id']); ?>" method="POST">
				<div class="container mt-3 mb-3">
					<div class="row">
						<div class="col-md">
							<select class="form-control" id="reportReason" name="reportReason" required>
								<option value=""></option>
								<option value="badInformation">Información incorrecta o falsa</option>
								<option value="unrespectful">Faltas de respeto</option>
								<option value="badLanguaje">Lenguaje inapropiado</option>
								<option value="others">Otros</option>
							</select>
						</div>
					</div>
					<div class="row">
						<div class="col">
							<input type="text" class="form-control w-100" id="reportMessage" name="reportMessage" placeholder="Descrive la denuncia brevemente" required>
						</div>
					</div>
					<div class="row">
						<div class="col">
							<button type="submit" class="btn btn-primary" id="reportComment" name="reportComment" value="reportComment">Denunciar</button>
						</div>
					</div>
				</div>
			  </form>
		  </div>
		</div>
	  </div>
	</div>
<?php } ?>

		

