<div class="container mt-3 mb-3">
	<h1>Registrar nueva noticia:</h1>
	<?php if (isset($creationOK)) { ?>
		<div class="container w-50 bg-success rounded text-light">Noticia creado correctamente</div>
	<?php } ?>
	<div class="container mt-3 mb-3 w-75">
		<form action="<?php if ($form_content['newId'] == '') echo base_url('news/registerEditNew/'.$form_content['platformId']); else echo base_url('news/registerEditNew/'.$form_content['platformId'].'/'.$form_content['newId']); ?>" method="POST">
			<div class="form-row">
				<div class="form-group col-md-6">
					<label for="<?php echo $form_content[0]["id"]; ?>" class="col-sm-2 col-form-label"><?php echo $form_content[0]["name"]; ?></label>
					<input type="text" class="form-control <?php if ($form_content[0]["error"] != "") echo "is-invalid"; ?>" id="<?php echo $form_content[0]["id"]; ?>" name="<?php echo $form_content[0]["id"]; ?>" placeholder="<?php echo $form_content[0]["name"]; ?>" value="<?php echo $form_content[0]["value"];?>" required>
					<div class="invalid-feedback">
						<?php echo $form_content[0]["error"]; ?>
					</div>
				</div>
				<div class="form-group col-md-6">
					<label for="<?php echo $form_content[1]["id"]; ?>" class="col-sm-2 col-form-label"><?php echo $form_content[1]["name"]; ?></label>
					<input type="text" class="form-control <?php if ($form_content[1]["error"] != "") echo "is-invalid"; ?>" id="<?php echo $form_content[1]["id"]; ?>" name="<?php echo $form_content[1]["id"]; ?>" placeholder="<?php echo $form_content[1]["name"]; ?>" value="<?php echo $form_content[1]["value"];?>" required>
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
			<div class="form-row">
				<div class="form-group col-md-6">
					<label for="<?php echo $form_content[3]["id"]; ?>" class="col-md-auto col-form-label"><?php echo $form_content[3]["name"]; ?></label>
					<input type="text" class="form-control <?php if ($form_content[3]["error"] != "") echo "is-invalid"; ?>" id="<?php echo $form_content[3]["id"]; ?>" name="<?php echo $form_content[3]["id"]; ?>" placeholder="<?php echo $form_content[3]["name"]; ?>" value="<?php echo $form_content[3]["value"];?>">
					<div class="invalid-feedback">
						<?php echo $form_content[3]["error"]; ?>
					</div>
				</div>
				<div class="form-group col-md-6">
					<label for="<?php echo $form_content[8]["id"]; ?>" class="col-md-auto col-form-label"><?php echo $form_content[8]["name"]; ?></label>
					<input type="text" class="form-control <?php if ($form_content[8]["error"] != "") echo "is-invalid"; ?>" id="<?php echo $form_content[8]["id"]; ?>" name="<?php echo $form_content[8]["id"]; ?>" placeholder="<?php echo $form_content[8]["name"]; ?>" value="<?php echo $form_content[8]["value"];?>">
					<div class="invalid-feedback">
						<?php echo $form_content[8]["error"]; ?>
					</div>
				</div>
			</div>	
			<div class="form-group">
					<label for="<?php echo $form_content[7]["id"]; ?>" class="col-md-auto col-form-label"><?php echo $form_content[7]["name"]; ?></label>
					<select class="form-control <?php if ($form_content[7]["error"] != "") echo "is-invalid"; ?>" id="<?php echo $form_content[7]["id"]; ?>" name="<?php echo $form_content[7]["id"]; ?>" required>
						<?php
							if (isset($form_content[7]["value"])){
								$options='';
								foreach ($form_content[7]['options'] as $informer){
									if ($form_content[7]["value"] == $informer['id']){
										$options='<option value="'.$informer['id'].'">'.$informer['name'].'</option>'.$options;
									} else {
										$options=$options.'<option value="'.$informer['id'].'">'.$informer['name'].'</option>';
									}
								}
							} else {
								$options='<option value=""></option>';
								foreach ($form_content[7]['options'] as $informer){
									$options=$options.'<option value="'.$informer['id'].'">'.$informer['name'].'</option>';
								}
							}
							echo $options;
						?>
					</select>
					<div class="invalid-feedback">
						<?php echo $form_content[7]["error"]; ?>
					</div>
			</div>
			<div class="form-row">
				<div class="form-group col">
					<label for="<?php echo $form_content[4]["id"]; ?>" class="col-md-auto col-form-label"><?php echo $form_content[4]["name"]; ?></label>
						<input type="text" class="form-control <?php if ($form_content[4]["error"] != "") echo "is-invalid"; ?>" id="<?php echo $form_content[4]["id"]; ?>" name="<?php echo $form_content[4]["id"]; ?>" placeholder="<?php echo $form_content[4]["name"]; ?>" value="<?php echo $form_content[4]["value"];?>" required>
						<div class="invalid-feedback">
							<?php echo $form_content[4]["error"]; ?>
						</div>
					</div>
				<div class="form-group col">
					<label for="<?php echo $form_content[5]["id"]; ?>" class="col-md-auto col-form-label"><?php echo $form_content[5]["name"]; ?></label>
					<input type="text" class="form-control <?php if ($form_content[5]["error"] != "") echo "is-invalid"; ?>" id="<?php echo $form_content[5]["id"]; ?>" name="<?php echo $form_content[5]["id"]; ?>" placeholder="<?php echo $form_content[5]["name"]; ?>" value="<?php echo $form_content[5]["value"];?>">
					<div class="invalid-feedback">
						<?php echo $form_content[5]["error"]; ?>
					</div>
				</div>
				<div class="form-group col">
					<label for="<?php echo $form_content[6]["id"]; ?>" class="col-md-auto col-form-label"><?php echo $form_content[6]["name"]; ?></label>
					<input type="text" class="form-control <?php if ($form_content[6]["error"] != "") echo "is-invalid"; ?>" id="<?php echo $form_content[6]["id"]; ?>" name="<?php echo $form_content[6]["id"]; ?>" placeholder="<?php echo $form_content[6]["name"]; ?>" value="<?php echo $form_content[6]["value"];?>">
					<div class="invalid-feedback">
						<?php echo $form_content[6]["error"]; ?>
					</div>
				</div>
			</div>	
			<div class="form-group">
					<?php if ($form_content['newId'] == ""){ ?>
						<button type="submit" class="btn btn-primary" id="create" name="create" value="Create">Registrar noticia</button>
					<?php } else { ?>
						<button type="submit" class="btn btn-primary" id="create" name="create" value="Create">Editar</button>					
					<?php } ?>
			</div>
		</form>
	</div>
</div>