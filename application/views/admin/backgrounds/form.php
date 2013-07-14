<?php
	$this->config->load('config'); 
	$base_url = $this->config->item('base_url');
?>
<div class="row-fluid sortable">
	<div class="box span12">
		<div class="box-header well" data-original-title>
			<h2><i class="icon-edit"></i> Edición de Fondo</h2>
		</div>
		<div class="box-content">
			<form enctype="multipart/form-data" method="post" action="<?= $base_url ?>index.php/backgrounds/<?= $variable ? "edit" : "add" ?>" class="form-horizontal">
			  <input type="hidden" name="id" value="<?= $variable ? $variable->id : "" ?>" />
			  <fieldset>
				<legend><?= $variable ? "Editar Registro" : "Nuevo Registro" ?></legend>
				<div class="control-group">
				  <label class="control-label" for="fileInput">Imagen</label>
				  <div class="controls">
					<input name="image" class="input-file uniform_on" id="fileInput" type="file">
				  </div>
				</div>
				<div class="form-actions">
				  <button type="submit" class="btn btn-primary">Guardar</button>
				  <a href="<?= $base_url ?>index.php/backgrounds" class="btn btn-danger">Regresar</a>
				</div>
			  </fieldset>
			</form>   

		</div>
	</div><!--/span-->

</div><!--/row-->