<?php
	$this->config->load('config'); 
	$base_url = $this->config->item('base_url');
?>
<div class="row-fluid sortable">	
	<div class="box span12">
		<div class="box-header well" data-original-title>
			<h2><i class="icon-user"></i> Variables de Configuración </h2>
		</div>
		<div class="box-content">
			<table class="table table-striped table-bordered bootstrap-datatable datatable">
			  <thead>
				  <tr>
					  <th style="width: 50px;">Id</th>
					  <th>Variable</th>
					  <th>Valor</th>
					  <th style="width: 250px;">
					  	<a class="btn btn-info" href="<?= $base_url ?>index.php/configurations/add">
							<i class="icon-edit icon-white"></i>  
							Nuevo 
						</a>
					  </th>
				  </tr>
			  </thead>   
			  <tbody>
			  	<?php if($configurations) foreach($configurations as $configuration){ ?>
			  	<tr>
			  		<td class="center"><?= $configuration->id ?></td>
			  		<td><?= $configuration->code ?></td>
			  		<td><?= $configuration->value ?></td>
			  		<td style="text-align: center;">
			  			<a class="btn btn-success" href="<?= $base_url ?>index.php/configurations/edit/<?= $configuration->id ?>">
							<i class="icon-edit icon-white"></i>  
							Editar                                            
						</a>
						<a class="btn btn-danger" href="<?= $base_url ?>index.php/configurations/delete/<?= $configuration->id ?>">
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