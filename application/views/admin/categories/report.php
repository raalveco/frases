<div class="row-fluid sortable">	
	<div class="box span12">
		<div class="box-header well" data-original-title>
			<h2><i class="icon-user"></i> Categories</h2>
		</div>
		<div class="box-content">
			<table class="table table-striped table-bordered bootstrap-datatable datatable">
			  <thead>
				  <tr>
					  <th style="width: 50px;">Id</th>
					  <th>Name</th>
					  <th style="width: 250px;">Actions</th>
				  </tr>
			  </thead>   
			  <tbody>
			  	<?php if($categories) foreach($categories as $category){ ?>
			  	<tr>
			  		<td class="center"><?= $category->id ?></td>
			  		<td><?= $category->name ?></td>
			  		<td style="text-align: center;">
			  			<a class="btn btn-success" href="#">
							<i class="icon-zoom-in icon-white"></i>  
							View                                            
						</a>
						<a class="btn btn-info" href="#">
							<i class="icon-edit icon-white"></i>  
							Edit                                            
						</a>
						<a class="btn btn-danger" href="#">
							<i class="icon-trash icon-white"></i> 
							Delete
						</a>
			  		</td>
			  	</tr>
			  	<?php } ?>
			  </tbody>
		  </table>            
		</div>
	</div><!--/span-->

</div><!--/row-->