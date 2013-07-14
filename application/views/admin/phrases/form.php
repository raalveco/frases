<?php
	$this->config->load('config'); 
	$base_url = $this->config->item('base_url');
?>
<div class="row-fluid sortable">
	<div class="box span12">
		<div class="box-header well" data-original-title>
			<h2><i class="icon-edit"></i> Frases</h2>
		</div>
		<div class="box-content">
			<form method="post" action="<?= $base_url ?>index.php/phrases/<?= $variable ? "edit" : "add" ?>" class="form-horizontal">
			  <input type="hidden" name="id" value="<?= $variable ? $variable->id : "" ?>" />
			  <fieldset>
				<legend><?= $variable ? "Editar Registro" : "Nuevo Registro" ?></legend>
				<div class="control-group">
				  <label class="control-label" for="typeahead">Frase: </label>
				  <div class="controls">
					<input type="text" name="phrase" class="span6" value="<?= $variable ? $variable->phrase : "" ?>">
				  </div>
				</div>
				<div class="control-group">
					<label class="control-label" for="selectError" ¿>Tipografía: </label>
					<div class="controls">
					  <select name="font" id="selectError" data-rel="chosen" class="span6">
					  	<?php if($fonts) foreach($fonts as $font){ ?>
							<option value="<?= $font->id ?>"<?= $variable ? ($variable->font_id == $font->id ? ' selected="selected"' : "") : "" ?>><?= $font->name ?></option>
						<?php } ?>
					  </select>
					</div>
				  </div>
				<div class="control-group">
				  <label class="control-label" for="typeahead">De: </label>
				  <div class="controls">
					<input type="text" name="from" class="span6" value="<?= $variable ? $variable->from : "" ?>">
				  </div>
				</div>
				<div class="control-group">
				  <label class="control-label" for="typeahead">Para: </label>
				  <div class="controls">
					<input type="text" name="to" class="span6" value="<?= $variable ? $variable->to : "" ?>">
				  </div>
				</div>
				<div class="form-actions">
				  <button type="submit" class="btn btn-primary">Guardar</button>
				  <a href="<?= $base_url ?>index.php/phrases" class="btn btn-danger">Regresar</a>
				</div>
			  </fieldset>
			</form>   

		</div>
	</div><!--/span-->

</div><!--/row-->