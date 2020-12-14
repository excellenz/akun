
<!-- Begin Page Content -->
<div class="container-fluid">

	<!-- Page Heading -->
	<h1 class="h3 mb-4 text-gray-800"><?= $title; ?></h1>

	<div class="row">
		<div class="col-lg-6">
			<?php if (validation_errors()) : ?>
          			<div class="alert alert-danger" role="alert">
          				<?= validation_errors(); ?>
          			</div>
          		<?php endif; ?>

          		<?= $this->session->flashdata('message'); ?>
			<div class="card">
				<div class="card-header">
				Form Edit Role
				</div>
				<div class="card-body">

					<form action="<?= base_url('admin/editrole'); ?>/<?= $role['id']; ?>" method="post">
						<div class="modal-body">
							<div class="form-group">
								<input type="text" class="form-control" id="role" name="role" placeholder="" value="<?= $role['role']; ?>">
							</div>
						</div>
						<a href="<?= base_url('admin/role'); ?>" class="btn btn-secondary">Cancel</a>
						<button type="submit" class="btn btn-primary">Save</button>
					</form>

				</div>
			</div>
		</div>
	</div>

</div>
	<!-- /.container-fluid -->

</div>
<!-- End of Main Content -->


