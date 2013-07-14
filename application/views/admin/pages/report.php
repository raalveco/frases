<?php
	$this->config->load('config'); 
	$base_url = $this->config->item('base_url');
?>
<div class="row-fluid sortable">	
	<div class="box span12">
		<div class="box-header well" data-original-title>
			<h2><i class="icon-user"></i>Paginas</h2>
		</div>
		<div class="box-content">
			<table class="table table-striped table-bordered bootstrap-datatable datatable">
			  <thead>
				  <tr>
					  <th style="width: 50px;">Id</th>
					  <th>Código</th>
					  <th>Titulo</th>
					  <th style="width: 200px;">
						<a class="btn btn-info" href="<?= $base_url ?>index.php/pages/add">
							<i class="icon-edit icon-white"></i>  
							Nuevo 
						</a>
					  </th>
				  </tr>
			  </thead>   
			  <tbody>
			  	<?php if($pages) foreach($pages as $page){ ?>
			  	<tr>
			  		<td class="center"><?= $page->id ?></td>
			  		<td><?= $page->code ?></td>
			  		<td><?= $page->title ?></td>
			  		<td style="text-align: center;">
			  			<a class="btn btn-success" href="<?= $base_url ?>index.php/pages/edit/<?= $page->id ?>">
							<i class="icon-edit icon-white"></i>  
							Editar                                            
						</a>
						<a class="btn btn-danger" href="<?= $base_url ?>index.php/pages/delete/<?= $page->id ?>">
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