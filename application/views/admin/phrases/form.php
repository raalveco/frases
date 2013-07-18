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
			<form method="post" action="<?= $base_url ?>index.php/phrases/<?= $variable ? "edit" : "add" ?>" class="form-horizontal phrases">
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
					<label class="control-label" for="selectError1">Categorías: </label>
					
					<div class="controls">
					  <select name="categorias[]" id="selectError1" multiple="multiple" data-rel="chosen" class="span6">
						<?php if($categories) foreach($categories as $category){ ?>
							<?php
								$flag = false;
								
								if($categories_selected) foreach($categories_selected as $tpx){
									if($category->id == $tpx->category_id->id){
										$flag = true;
									}
								}
							?>
							<option value="<?= $category->id ?>"<?= $flag ? ' selected="selected"' : "" ?>><?= $category->name ?></option>
						<?php } ?>
					  </select>
					</div>
				  </div>
				<div class="control-group">
					<label class="control-label" for="selectError1">Etiquetas: </label>
					<div class="controls">
					  <select name="etiquetas[]" id="selectError2" multiple="multiple" data-rel="chosen" class="span6">
						<?php if($tags) foreach($tags as $tag){ ?>
							<?php
								$flag = false;
								
								if($tags_selected) foreach($tags_selected as $tpx){
									if($tag->id == $tpx->tag_id->id){
										$flag = true;
									}
								}
							?>
							<option value="<?= $tag->id ?>"<?= $flag ? ' selected="selected"' : "" ?>><?= $tag->keyword ?></option>
						<?php } ?>
					  </select>
					</div>
				  </div>
				<div class="control-group">
					<label class="control-label" for="selectError">Tipografía: </label>
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