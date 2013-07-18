<?php
	$this->config->load('config'); 
	$base_url = $this->config->item('base_url');
?>
<div class="row-fluid sortable">	
	<div class="box span12">
		<div class="box-header well" data-original-title>
			<h2><i class="icon-user"></i> Frases</h2>
		</div>
		<div class="box-content">
			<table class="table table-striped table-bordered bootstrap-datatable datatable">
			  <thead>
				  <tr>
					  <th style="width: 50px;">Id</th>
					  <th style="width: 75px;">Fondo</th>
					  <th style="width: 150px;">Fuente</th>
					  <th>Frase</th>
					  <th style="width: 280px;">
					  	<a class="btn btn-info" href="<?= $base_url ?>index.php/phrases/add">
							<i class="icon-edit icon-white"></i>  
							Nuevo 
						</a>
					  </th>
				  </tr>
			  </thead>   
			  <tbody>
			  	<?php if($phrases) foreach($phrases as $phrase){ ?>
			  	<tr>
			  		<td class="center">
			  			<a class="btn btn-info renderizar" href="<?= $base_url ?>index.php/phrases/view/<?= $phrase->id ?>">
							<i class="icon-picture icon-white"></i>     
						</a>
			  		</td>
			  		<td>
			  			<?php if(is_object($phrase->background_id)){ ?>
				  			<?php $imagen = explode(".",$phrase->background_id->image); ?>
				  			<img src="<?= $base_url ?>backgrounds/thumbnails/<?= $imagen[0] ?>_thumb.<?= $imagen[1] ?>" />
			  			<?php } ?>
			  		</td>
			  		<td><?= $phrase->font_id->name ?></td>
			  		<td><?= $phrase->phrase ?></td>
			  		<td style="text-align: center;">
			  			<a class="btn btn-info fondos" href="<?= $base_url ?>index.php/phrases/backgrounds/<?= $phrase->id ?>">
							<i class="icon-picture icon-white"></i>  
							Fondo                                            
						</a>
						<a class="btn btn-success" href="<?= $base_url ?>index.php/phrases/edit/<?= $phrase->id ?>">
							<i class="icon-edit icon-white"></i>  
							Editar                                            
						</a>
						<a class="btn btn-danger" href="<?= $base_url ?>index.php/phrases/delete/<?= $phrase->id ?>">
							<i class="icon-trash icon-white"></i> 
							Eliminar
						</a>
			  		</td>
			  	</tr>
			  	<?php } ?>
			  </tbody>
		  </table>            
		</div>
	</div><!--/span-->

</div><!--/row-->
