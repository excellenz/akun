
<!-- Begin Page Content -->
<div class="container-fluid">

  <!-- Page Heading -->
  <h1 class="h3 mb-4 text-gray-800"><?= $title; ?></h1>

  <div class="row">
  	<div class="col-lg">

  		<?= $this->session->flashdata('message'); ?>

  		<table class="table table-hover">
		  <thead>
		    <tr>
		      <th scope="col">#</th>
		      <th scope="col">Email</th>
		      <th scope="col">Name</th>
		      <th scope="col">Role</th>
		      <th scope="col">Active</th>
		      <th scope="col">Date Modified</th>
		      <th scope="col">Action</th>
		    </tr>
		  </thead>
		  <tbody>
		  	<?php
		  		$i = 1;
		  		foreach ($users as $user) :
		  	?>
		    <tr>
		      <th scope="row"><?= $i; ?></th>
		      <td><?= $user['email']; ?></td>
		      <td><?= $user['name']; ?></td>
		      <td><?= $user['role']; ?></td>
		      <td><?= $user['is_active'] == 1 ? 'Yes' : 'No'; ?></td>
		      <td><?= date('d-M-Y', $user['date_modified']);?></td>
		      <td>
		      		<a href="manageuser/<?= $user['id']; ?>" class="badge badge-success">edit</a>
		      		<a href="javascript:hapusData(<?= $user['id']; ?>)" class="badge badge-danger">delete</a>
		      </td>
		    </tr>
			<?php
				$i++;
				endforeach;
			?>
		  </tbody>
		</table>
  	</div>
  </div>

</div>
<!-- /.container-fluid -->

<script language="JavaScript" type="text/javascript">
	function hapusData(id){
		if (confirm("Apakah anda yakin akan menghapus data ini?")){
		  	window.location.href = 'deleteuser/' + id;
		}
	}
</script>

</div>
<!-- End of Main Content -->

<!-- Modal -->
<div class="modal fade" id="newRoleModal" tabindex="-1" aria-labelledby="newRoleModalLabel" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="newRoleModalLabel">Add New Role</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <form action="<?= base_url('admin/role'); ?>" method="post">
	      <div class="modal-body">
	        <div class="form-group">
			    <input type="text" class="form-control" id="role" name="role" placeholder="Role name">
		  </div>
	      </div>
	      <div class="modal-footer">
	        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
	        <button type="submit" class="btn btn-primary">Add</button>
	      </div>
      </form>
    </div>
  </div>
</div>

