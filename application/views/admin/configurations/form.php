<?php
	$this->config->load('config'); 
	$base_url = $this->config->item('base_url');
?>
<div class="row-fluid sortable">
	<div class="box span12">
		<div class="box-header well" data-original-title>
			<h2><i class="icon-edit"></i> Variable de Configuración</h2>
		</div>
		<div class="box-content">
			<form method="post" action="<?= $base_url ?>index.php/configurations/<?= $variable ? "edit" : "add" ?>" class="form-horizontal">
			  <input type="hidden" name="id" value="<?= $variable ? $variable->id : "" ?>" />
			  <fieldset>
				<legend><?= $variable ? "Editar Registro" : "Nuevo Registro" ?></legend>
				<div class="control-group">
				  <label class="control-label" for="typeahead">Variable: </label>
				  <div class="controls">
					<input type="text" name="code" class="span6" value="<?= $variable ? $variable->code : "" ?>">
				  </div>
				</div>
				<div class="control-group">
				  <label class="control-label" for="typeahead">Valor: </label>
				  <div class="controls">
					<input type="text" name="value" class="span6" value="<?= $variable ? $variable->value : "" ?>">
				  </div>
				</div>
				<div class="form-actions">
				  <button type="submit" class="btn btn-primary">Guardar</button>
				  <a href="<?= $base_url ?>index.php/configurations" class="btn btn-danger">Regresar</a>
				</div>
			  </fieldset>
			</form>   

		</div>
	</div><!--/span-->

</div><!--/row-->