<div class="container mt-3 mb-3">
	<h1>Crear un nuevo bulómetro:</h1>
	<?php if (isset($creationOK)) { ?>
		<div class="container w-50 bg-success rounded text-light">Plataforma creada correctamente</div>
	<?php } ?>
	<div class="container mt-3 mb-3 w-75">
		<form action="<?php echo base_url('platformsManagement'); ?>" method="POST">
			<div class="form-group">
			  <div class="form-group row mt-2 mb-2">
				<label for="<?php echo $form_content[0]["id"]; ?>" class="col-sm-2 col-form-label"><?php echo $form_content[0]["name"]; ?></label>
				<div class="col-sm-10">
				  <input type="text" class="form-control <?php if ($form_content[0]["error"] != "") echo "is-invalid"; ?>" id="<?php echo $form_content[0]["id"]; ?>" name="<?php echo $form_content[0]["id"]; ?>" placeholder="<?php echo $form_content[0]["name"]; ?>" value="<?php echo $form_content[0]["value"];?>" required>
				  <div class="invalid-feedback">
					  <?php echo $form_content[0]["error"]; ?>
				  </div>
				</div>
			  </div>
			  <div class="form-group row mt-2 mb-2">
				<label for="<?php echo $form_content[1]["id"]; ?>" class="col-sm-2 col-form-label"><?php echo $form_content[1]["name"]; ?></label>
				<div class="col-sm-10">
				  <textarea class="form-control" id="<?php echo $form_content[1]["id"]; ?>" name="<?php echo $form_content[1]["id"]; ?>" placeholder="<?php echo $form_content[1]["name"]; ?>" rows="3"></textarea>
				  <div class="invalid-feedback">
					  <?php echo $form_content[1]["error"]; ?>
				  </div>
				</div>
			  </div>
			  <div class="form-group row mt-2 mb-2">
				<label for="<?php echo $form_content[2]["id"]; ?>" class="col-sm-2 col-form-label"><?php echo $form_content[2]["name"]; ?></label>
				<div class="col-sm-10">
				  <select class="form-control" id="<?php echo $form_content[2]["id"]; ?>" name="<?php echo $form_content[2]["id"]; ?>" required>
					<option value=""></option>
					<option value="Política">Política</option>
					<option value="Tecnología">Tecnología</option>
					<option value="Salud">Salud</option>
					<option value="Sociedad">Sociedad</option>
				  </select>
				  <div class="invalid-feedback">
					  <?php echo $form_content[2]["error"]; ?>
				  </div>
				</div>
			  </div>
			  <div class="form-group row mt-3">
				<div class="col-sm-10">
				  <button type="submit" class="btn btn-primary" id="create" name="create" value="Create">Crear</button>
				</div>
			  </div>
			</div>
		</form>
	</div>
</div>