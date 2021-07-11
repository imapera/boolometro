<div class="container mt-3 mb-3">
	<h1>Resolver noticia:</h1>
	<?php if (isset($creationOK)) { ?>
		<div class="container w-50 bg-success rounded text-light">Noticia creado correctamente</div>
	<?php } ?>
	<div class="container mt-3 mb-3 w-75">
		<form action="" method="POST">
			<div class="form-row">
				<div class="form-group col-md-6">
					<label for="<?php echo $form_content[0]["id"]; ?>" class="col-md-auto col-form-label"><?php echo $form_content[0]["name"]; ?></label>
					<select class="form-control <?php if ($form_content[0]["error"] != "") echo "is-invalid"; ?>" id="<?php echo $form_content[0]["id"]; ?>" name="<?php echo $form_content[0]["id"]; ?>" required>
						<?php
							if (isset($form_content[0]["value"])){
								$options='';
								foreach ($form_content[0]['options'] as $option){
									if ($form_content[0]["value"] == $option['value']){
										$options='<option value="'.$option['value'].'">'.$option['name'].'</option>'.$options;
									} else {
										$options=$options.'<option value="'.$option['value'].'">'.$option['name'].'</option>';
									}
								}
							} else {
								$options='<option value=""></option>';
								foreach ($form_content[0]['options'] as $option){
									$options=$options.'<option value="'.$option['value'].'">'.$options['name'].'</option>';
								}
							}
							echo $options;
						?>
					</select>
					<div class="invalid-feedback">
						<?php echo $form_content[0]["error"]; ?>
					</div>
				</div>
				<div class="form-group col-md-6">
					<label for="<?php echo $form_content[1]["id"]; ?>" class="col-md-auto col-form-label"><?php echo $form_content[1]["name"]; ?></label>
					<input type="text" class="form-control <?php if ($form_content[1]["error"] != "") echo "is-invalid"; ?>" id="<?php echo $form_content[1]["id"]; ?>" name="<?php echo $form_content[1]["id"]; ?>" placeholder="<?php echo $form_content[1]["name"]; ?>" value="<?php echo $form_content[1]["value"];?>">
					<div class="invalid-feedback">
						<?php echo $form_content[1]["error"]; ?>
					</div>
				</div>
			</div>	
			<div class="form-group">
				<label for="<?php echo $form_content[2]["id"]; ?>" class="col-md-auto col-form-label"><?php echo $form_content[2]["name"]; ?></label>
				<textarea class="form-control" id="<?php echo $form_content[2]["id"]; ?>" name="<?php echo $form_content[2]["id"]; ?>" placeholder="<?php echo $form_content[2]["name"]; ?>" rows="3"><?php echo $form_content[2]["value"]; ?></textarea>
				<div class="invalid-feedback">
					<?php echo $form_content[2]["error"]; ?>
				</div>
			</div>	
			<div class="form-group">
				<button type="submit" class="btn btn-primary" id="create" name="create" value="Create">Resolver</button>
			</div>
		</form>
	</div>
</div>