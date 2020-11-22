
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
					Form Edit Submenu
					</div>
					<div class="card-body">
						
						<form action="<?= base_url('menu/editsubmenu'); ?>/<?= $subMenu['id'] ?>" method="post">
					      <div class="modal-body">
					        <div class="form-group">
							    <input type="text" class="form-control" id="title" name="title" placeholder="" value="<?= $subMenu['title']; ?>">
						  	</div>
						  	<div class="form-group">
						  		<input type="text" class="form-control" id="menu_id" name="menu_id" placeholder="" value="<?= $subMenu['menu_id']; ?>">
						  	</div>
						  	<div class="form-group">
							    <input type="text" class="form-control" id="url" name="url" placeholder="" value="<?= $subMenu['url']; ?>">
						  	</div>
						  	<div class="form-group">
							    <input type="text" class="form-control" id="icon" name="icon" placeholder="" value="<?= $subMenu['icon']; ?>">
						  	</div>
						  	<div class="form-group">
						  		<div class="form-check">
									<input class="form-check-input" type="checkbox" value="1" name="is_active" id="is_active" checked>
									<label class="form-check-label" for="is_active">
										Active?
									</label>
								</div>
						  	</div>
					      </div>
						<a href="<?= base_url('menu/submenu'); ?>" class="btn btn-secondary">Cancel</a>
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

<!-- Modal -->
<div class="modal fade" id="newSubMenuModal" tabindex="-1" aria-labelledby="newSubMenuModalLabel" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="newSubMenuModalLabel">Add New Sub Menu</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <form action="<?= base_url('menu/submenu'); ?>" method="post">
	      <div class="modal-body">
	        <div class="form-group">
			    <input type="text" class="form-control" id="title" name="title" placeholder="Submenu title">
		  	</div>
		  	<div class="form-group">
		  		<select name="menu_id" id="menu_id" class="form-control">
		  			<option value="">Select Menu</option>
		  			<?php foreach ($menu as $m) : ?>
		  				<option value="<?= $m['id']; ?>"><?= $m['menu']; ?></option>
		  			<?php endforeach; ?>
		  		</select>
		  	</div>
		  	<div class="form-group">
			    <input type="text" class="form-control" id="url" name="url" placeholder="Submenu url">
		  	</div>
		  	<div class="form-group">
			    <input type="text" class="form-control" id="icon" name="icon" placeholder="Submenu icon">
		  	</div>
		  	<div class="form-group">
		  		<div class="form-check">
					<input class="form-check-input" type="checkbox" value="1" name="is_active" id="is_active" checked>
					<label class="form-check-label" for="is_active">
						Active?
					</label>
				</div>
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

