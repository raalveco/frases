<?php
	$this->config->load('config'); 
	$base_url = $this->config->item('base_url');
?>
<div class="row-fluid sortable">
	<div class="box span12">
		<div class="box-header well" data-original-title>
			<h2><i class="icon-edit"></i> Edición de Etiqueta</h2>
		</div>
		<div class="box-content">
			<form method="post" action="<?= $base_url ?>index.php/tags/<?= $variable ? "edit" : "add" ?>" class="form-horizontal">
			  <input type="hidden" name="id" value="<?= $variable ? $variable->id : "" ?>" />
			  <fieldset>
				<legend><?= $variable ? "Editar Registro" : "Nuevo Registro" ?></legend>
				<div class="control-group">
				  <label class="control-label" for="typeahead">Palabra Clave: </label>
				  <div class="controls">
					<input type="text" name="keyword" class="span6" value="<?= $variable ? $variable->keyword : "" ?>">
				  </div>
				<div class="form-actions">
				  <button type="submit" class="btn btn-primary">Guardar</button>
				  <a href="<?= $base_url ?>index.php/tags" class="btn btn-danger">Regresar</a>
				</div>
			  </fieldset>
			</form>   

		</div>
	</div><!--/span-->

</div><!--/row-->