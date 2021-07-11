<html>
<head>
	<title>Boolometro</title>
	<?php foreach ($header_tags as $tag) echo $tag;?>
</head>
<body class="text-center">
<nav class="navbar navbar-expand-sm navbar-dark bg-dark" aria-label="Third navbar example">
    <div class="container-fluid">
      <a class="navbar-brand" href="<?php echo base_url(); ?>">Boolometro</a>
      <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarsExample03" aria-controls="navbarsExample03" aria-expanded="false" aria-label="Toggle navigation">
        <span class="navbar-toggler-icon"></span>
      </button>

      <div class="collapse navbar-collapse" id="navbarsExample03">
        <ul class="navbar-nav me-auto mb-2 mb-sm-0">
          <li class="nav-item active">
            <a class="nav-link" aria-current="page" href="<?php echo base_url(); ?>">Inicio</a>
          </li>
		  <?php if ($this->session->username) { ?>
			  <li class="nav-item dropdown">
				<a class="nav-link dropdown-toggle" href="#" id="navbarDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
				  Siguiendo
				</a>
				<div class="dropdown-menu" aria-labelledby="navbarDropdown">
				  <a class="dropdown-item" href="#">Action</a>
				  <a class="dropdown-item" href="#">Another action</a>
				  <a class="dropdown-item" href="#">Something else here</a>
				</div>
			  </li>
		  <?php } ?>
        </ul>
		<?php
			if ($this->session->username){
				echo "<span class='navbar-text'>¡Hola ".$this->session->username."! | <a href='" . base_url('userPage'). "'>Zona personal</a> | <a href='" . base_url('common/logOut'). "'>Cerrar sesión</a></span>";
			} else {
				echo "<span class='navbar-text'>No has iniciado sesión</span>";
			}
		?>	
      </div>
    </div>
  </nav>