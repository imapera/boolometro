<form action="<?php echo base_url('register/validateAndRegister'); ?>" method="POST">
	<div class="form-group mt-4">
	  <div class="form-group row">
		<label for="<?php echo $form_content[0]["id"]; ?>" class="col-sm-2 col-form-label"><?php echo $form_content[0]["name"]; ?></label>
		<div class="col-sm-10">
		  <input type="text" class="form-control <?php if ($form_content[0]["error"] != "") echo "is-invalid"; ?>" id="<?php echo $form_content[0]["id"]; ?>" name="<?php echo $form_content[0]["id"]; ?>" placeholder="<?php echo $form_content[0]["name"]; ?>" value="<?php echo $form_content[0]["value"];?>">
		  <div class="invalid-feedback">
			  <?php echo $form_content[0]["error"]; ?>
		  </div>
		</div>
	  </div>
	  <div class="form-group row">
		<label for="<?php echo $form_content[1]["id"]; ?>" class="col-sm-2 col-form-label"><?php echo $form_content[1]["name"]; ?></label>
		<div class="col-sm-10">
		  <input type="password" class="form-control <?php if ($form_content[1]["error"] != "") echo "is-invalid"; ?>" id="<?php echo $form_content[1]["id"]; ?>" name="<?php echo $form_content[1]["id"]; ?>" placeholder="<?php echo $form_content[1]["name"]; ?>" value="<?php echo $form_content[1]["value"];?>">
		  <div class="invalid-feedback">
			  <?php echo $form_content[1]["error"]; ?>
		  </div>
		</div>
	  </div>
	  <div class="form-group row">
		<label for="<?php echo $form_content[2]["id"]; ?>" class="col-sm-2 col-form-label"><?php echo $form_content[2]["name"]; ?></label>
		<div class="col-sm-10">
		  <input type="password" class="form-control <?php if ($form_content[2]["error"] != "") echo "is-invalid"; ?>" id="<?php echo $form_content[2]["id"]; ?>" name="<?php echo $form_content[2]["id"]; ?>" placeholder="<?php echo $form_content[2]["name"]; ?>" value="<?php echo $form_content[2]["value"];?>">
		  <div class="invalid-feedback">
			  <?php echo $form_content[2]["error"]; ?>
		  </div>
		</div>
	  </div>
	  <div class="form-group row">
		<label for="<?php echo $form_content[3]["id"]; ?>" class="col-sm-2 col-form-label"><?php echo $form_content[3]["name"]; ?></label>
		<div class="col-sm-10">
		  <input type="email" class="form-control <?php if ($form_content[3]["error"] != "") echo "is-invalid"; ?>" id="<?php echo $form_content[3]["id"]; ?>" name="<?php echo $form_content[3]["id"]; ?>" placeholder="<?php echo $form_content[3]["name"]; ?>" value="<?php echo $form_content[3]["value"];?>">
		  <div class="invalid-feedback">
			  <?php echo $form_content[3]["error"]; ?>
		  </div>
		</div>
	  </div>
	  <div class="form-group row">
		<div class="col-sm-10">
		  <div class="form-check">
			<input class="form-check-input <?php if ($form_content[4]["error"] != "") echo "is-invalid"; ?>" type="checkbox" id="<?php echo $form_content[4]["id"]; ?>" name="<?php echo $form_content[4]["id"]; ?>" required>
			<label class="form-check-label" for="<?php echo $form_content[4]["id"]; ?>">
			  <?php echo $form_content[4]["name"]; ?>
			</label>
			<div class="invalid-feedback">
			  <?php echo $form_content[4]["error"]; ?>
			</div>
		  </div>
		</div>
	  </div>
	  <div class="form-group row">
		<div class="col-sm-10">
		  <div class="form-check">
			<input class="form-check-input <?php if ($form_content[5]["error"] != "") echo "is-invalid"; ?>" type="checkbox" id="<?php echo $form_content[5]["id"]; ?>"  name="<?php echo $form_content[5]["id"]; ?>" required>
			<label class="form-check-label" for="<?php echo $form_content[5]["id"]; ?>">
			  <?php echo $form_content[5]["name"]; ?>
			</label>
			<div class="invalid-feedback">
			  <?php echo $form_content[5]["error"]; ?>
			</div>
		  </div>
		</div>
	  </div>
	  <div class="form-group row">
		<div class="col-sm-10">
		  <button type="submit" class="btn btn-primary">Sign in</button>
		</div>
	  </div>
	</div>
</form>