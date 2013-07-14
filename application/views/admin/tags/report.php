<?php
	$this->config->load('config'); 
	$base_url = $this->config->item('base_url');
?>
<div class="row-fluid sortable">	
	<div class="box span12">
		<div class="box-header well" data-original-title>
			<h2><i class="icon-user"></i>Etiquetas</h2>
		</div>
		<div class="box-content">
			<table class="table table-striped table-bordered bootstrap-datatable datatable">
			  <thead>
				  <tr>
					  <th style="width: 50px;">Id</th>
					  <th>Palabra Clave</th>
					  <th style="width: 250px;">
					  	<a class="btn btn-info" href="<?= $base_url ?>index.php/tags/add">
							<i class="icon-edit icon-white"></i>  
							Nuevo 
						</a>
					  </th>
				  </tr>
			  </thead>   
			  <tbody>
			  	<?php if($tags) foreach($tags as $tag){ ?>
			  	<tr>
			  		<td class="center"><?= $tag->id ?></td>
			  		<td><?= $tag->keyword ?></td>
			  		<td style="text-align: center;">
						<a class="btn btn-danger" href="<?= $base_url ?>index.php/tags/delete/<?= $tag->id ?>">
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