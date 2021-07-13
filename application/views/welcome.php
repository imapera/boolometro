<div class="container mt-3 mb-3">
  <div class="row">
    <div class="col-sm">
      <h1>¡Bienvenido a Bulómetro!</h1>
    </div>
  </div>
  <div class="row">
    <div class="col-sm">
      <?php
		if (isset($registerOK)) echo "<div class='container bg-success text-white m-3 p-1'>Registro realizado con éxito. Ya puede iniciar sesión.</div>";
	  ?>
    </div>
  </div>
</div>
      
<div class="container">
  <div class="row">
    <div class="col-md-6">
	  <img src="img/logo150.png" class="rounded float-right" alt=""><br>
    </div>
	<div class="col-md-auto">
      <?php if ($this->session->username) {?>
		<div class="container">
		  <div class="row">
			<div class="col-sm">
			¡Bienvenido <?php echo $this->session->username; ?>!
			</div>
		  </div>
		  <div class="row">
			<div class="col-sm">
			Ir a tu <a href="<?php echo base_url('userPage'); ?> "> Zona personal</a>.
			</div>
		  </div>
		  <div class="row">
			<div class="col-sm">
			<a href="<?php echo base_url('common/logOut'); ?>">Cerrar sesión</a>
			</div>
		  </div>
		 </div>
	<?php } else {?>
		Inicia sesión:
		<form class="form-signin" method="POST" action="<?php echo base_url('common/logIn'); ?>">
		  <label for="username" class="sr-only">Nombre de usuario:</label>
		  <input type="text" id="username" name="username" class="form-control" placeholder="Nombre de usuario" required="" autofocus="">
		  <label for="password" class="sr-only">Contraseña:</label>
		  <input type="password" id="password" name="password" class="form-control" placeholder="Contraseña" required=""><hr>
		  <button class="btn btn-lg btn-primary btn-block" type="submit">Entrar</button>
		</form>  
		<hr>
		<a href="<?php echo base_url("register"); ?>">Obtén una cuenta</a>
      <?php } ?>
    </div>
  </div>
</div>
<hr>
<div class="container mt-3 mb-3">
  <div class="row">
    <div class="col-sm">
		<div class="container mt-3 mb-3">
		  <div class="row">
			<div class="col-sm">
			  <h2>Top informadores:</h2>
			</div>
		  </div>
		  <div class="row">
			<div class="col-sm">
				<table class="table">
				  <thead>
					<tr>
					  <th scope="col">Nombre</th>
					  <th scope="col">Noticias publicadas</th>
					  <th scope="col"></th>
					</tr>
				  </thead>
				  <tbody>
					<?php
						foreach ($topInformers as $informer){
							echo '<tr>';
							echo '<td>'.$informer['name'].'</td>';
							echo '<td>'.$informer['newsCount'].'</td>';
							echo '<td><a href='.base_url('informer/id/'.$informer['id']).'>Visitar</a></td>';
							echo '</tr>';
						}
					?>
					<tr>
					  <th scope="col"></th>
					  <th scope="col"></th>
					  <th scope="col"><a href="<?php echo base_url('informer/listAll'); ?>">Ver todos</a></th>
					</tr>
				  </tbody>
				</table>
			</div>
		  </div>
		</div>
    </div>
    <div class="col-sm">
		<div class="container mt-3 mb-3">
		  <div class="row">
			<div class="col-sm">
			  <h2>Bulómetros más populares:</h2>
			</div>
		  </div>
		  <div class="row">
			<div class="col-sm">
				<table class="table">
				  <thead>
					<tr>
					  <th scope="col">Título</th>
					  <th scope="col">Tema</th>
					  <th scope="col">Noticias</th>
					  <th scope="col"></th>
					</tr>
				  </thead>
				  <tbody>
					<?php
						foreach ($popularPlatforms as $platform){
							echo '<tr>';
							echo '<td>'.$platform['title'].'</td>';
							echo '<td>'.$platform['theme'].'</td>';
							echo '<td>'.$platform['newsCount'].'</td>';
							echo '<td><a href='.base_url('platform/id/'.$platform['id']).'>Visitar</a></td>';
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
</div>
