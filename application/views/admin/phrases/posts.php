<div class="row-fluid sortable">	
	<div class="box span12">
		<div class="box-header well" data-original-title>
			<h2><i class="icon-user"></i> Publicaciones </h2>
		</div>
		<div class="box-content">
			<table class="table table-striped table-bordered bootstrap-datatable datatable">
			  <thead>
				  <tr>
					  <th style="width: 50px;">Id</th>
					  <th>Usuario</th>
					  <th>Frase</th>
					  <th>Fecha de Publicación</th>
					  <th style="width: 250px;">Acciones</th>
				  </tr>
			  </thead>   
			  <tbody>
			  	<?php if($posts) foreach($posts as $post){ ?>
			  	<tr>
			  		<td class="center"><?= $post->id ?></td>
			  		<td><?= $post->user_id->facebook_id ?></td>
			  		<td><?= $post->phrase_id->phrase ?></td>
			  		<td><?= $post->post_date ?></td>
			  		<td style="text-align: center;">
			  			<a class="btn btn-success" href="#">
							<i class="icon-zoom-in icon-white"></i>  
							Ver                                            
						</a>
						<a class="btn btn-info" href="#">
							<i class="icon-edit icon-white"></i>  
							Editar                                            
						</a>
						<a class="btn btn-danger" href="#">
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