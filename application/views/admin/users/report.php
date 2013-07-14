<?php
	$this->config->load('config'); 
	$base_url = $this->config->item('base_url');
?>
<div class="row-fluid sortable">	
	<div class="box span12">
		<div class="box-header well" data-original-title>
			<h2><i class="icon-user"></i> Usuarios</h2>
		</div>
		<div class="box-content">
			<table class="table table-striped table-bordered bootstrap-datatable datatable">
			  <thead>
				  <tr>
					  <th style="width: 50px;">Id</th>
					  <th>Facebook</th>
					  <th>Nombre</th>
					  <th>Apellido</th>
					  <th>Correo Electrónico</th>
				  </tr>
			  </thead>   
			  <tbody>
			  	<?php if($users) foreach($users as $user){ ?>
			  	<tr>
			  		<td class="center"><?= $user->id ?></td>
			  		<td><?= $user->facebook_id ?></td>
			  		<td><?= $user->first_name ?></td>
			  		<td><?= $user->last_name ?></td>
			  		<td><?= $user->email ?></td>
			  	</tr>
			  	<?php } ?>
			  </tbody>
		  </table>            
		</div>
	</div><!--/span-->

</div><!--/row-->