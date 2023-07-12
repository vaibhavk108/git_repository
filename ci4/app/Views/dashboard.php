
<div class="container">

	<div class="container tbl-cont mt-4">
		<table class="table table-hover table-striped">
			<thead class="thead-dark">
				<tr>
					<th>ID</th>
					<th>Name</th>
					<th>Address</th>
					<th>Salary</th>
					<th>Edit / Update </th>
					<th>
						<button type="button" class="btn btn-primary" data-target="#create_user" data-toggle="modal">Add User <i class="fa-solid fa-plus"></i>
						</button>
					</th>
				</tr>
			</thead>
			
			<tbody>
				<?php $count = 1; foreach($users as $user):?>
				<tr>
					<td><?php echo $count++; ?></td>
					<td><?php echo $user['name']; ?></td>
					<td><?php echo $user['address']; ?></td>
					<td><?php echo $user['salary']; ?></td>
					<td><button type="button" data-target="#edit_user" data-toggle="modal" class="btn btn-primary edit_btn" id="<?php echo $user['id']; ?>">Edit <i class="fa-solid fa-pen-to-square"></i>
					</button>

						<button type="button" class="btn btn-danger del_btn" id="<?php echo $user['id']; ?>">Delete <i class="fa-solid fa-trash"></i></a>
					</td>
					<td></td>
				</tr>
			    <?php endforeach; ?>

			</tbody>
		</table>
	</div>


	<!-- CREATE USER MODAL -->
	
	<div class="modal fade animated" id="create_user">
		<div class="modal-dialog">
			<div class="modal-content">
				<div class="modal-body">
					<h3 class="bg-info text-light p-3 mb-4 text-center">Add User</h3>
					<form action="<?php echo site_url('/submit-form') ?>" method="POST">
					  <div class="form-group">
						<label for="name">Name:</label>
					  	<input type="text" class="form-control" name="name" required>
					  </div>
					  <div class="form-group">
						<label for="address">Address:</label>
					  	<input type="text" class="form-control" name="address" required>
					  </div>
					  <div class="form-group">
						<label for="salary">Salary:</label>
					  	<input type="text" class="form-control" name="salary" required>
					  </div>
					  <div class="form-group">
					  	<button type="submit" class="btn btn-primary">Submit</button>
					  	<button type="button" class="btn btn-danger" data-dismiss="modal">Cancel</button>
					  </div>
				</form>
				</div>
			</div>
		</div>
	</div>
</div>

<!-- EDIT USER MODAL -->

<div class="modal fade animated" id="edit_user">
		<div class="modal-dialog">
			<div class="modal-content">
				<div class="modal-body">
					<h3 class="bg-info text-light p-3 mb-4 text-center">Edit User</h3>
					<form action="<?php echo site_url('/update-data') ?>" method="POST">

						<input type="hidden" name="id" id="id">

					  <div class="form-group">
						<label for="name">Name:</label>
					  	<input type="text" class="form-control" name="name" id="name" required>
					  </div>
					  <div class="form-group">
						<label for="address">Address:</label>
					  	<input type="text" class="form-control" name="address" id="address" required>
					  </div>
					  <div class="form-group">
						<label for="salary">Salary:</label>
					  	<input type="text" class="form-control" name="salary" id="salary" required>
					  </div>
					  <div class="form-group">
					  	<button type="submit" class="btn btn-primary">Submit</button>
					  	<button type="button" class="btn btn-danger" data-dismiss="modal">Cancel</button>
					  </div>
				</form>
				</div>
			</div>
		</div>
	</div>
</div>


<!-- Script Start From Here -->
<script>
	$(document).ready(function(){

		$('.del_btn').click(function(){

			var id = $(this).attr('id');

			Swal.fire({
			  title: 'Are you sure?',
			  text: "You won't be able to revert this!",
			  icon: 'warning',
			  showCancelButton: true,
			  confirmButtonColor: '#3085d6',
			  cancelButtonColor: '#d33',
			  confirmButtonText: 'Yes, delete it!'
			}).then((result) => {
			 	 
				 if (result.isConfirmed) {
				 	deleteData(id);
				    Swal.fire(
				      'Deleted!',
				      'Your file has been deleted.',
				      'success'
				    )
				  }
			})
		});


		function deleteData(id){
				// alert('test');
			 $.ajax({
				type: "POST",
			 	url: "<?php echo base_url('delete-data') ?>",
			 	data: {id:id},
			 	success:function(response){
			 		if(response == 1){
			 			location.reload(true);
			 		}
			 	}
			 });
		}

		$('.edit_btn').click(function(){

			var id = $(this).attr('id');	
			 $.ajax({
					type: "GET",
				 	url: "<?php echo base_url('edit-data') ?>",
				 	data: {id:id},
				 	dataType: "JSON",
				 	success:function(data){

				 		console.log(data);
				 		$('#id').val(data.id);
				 		$('#name').val(data.name);
			            $('#address').val(data.address);
			            $('#salary').val(data.salary);
				 	}
				 });
		});






  });

</script>