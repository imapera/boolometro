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
      
<div class="container w-50">
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
