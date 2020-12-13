
<!-- Begin Page Content -->
<div class="container-fluid">

	<!-- Page Heading -->
	<h1 class="h3 mb-4 text-gray-800"><?= $title; ?></h1>
	<div class="col-lg-8">
		<?= $this->session->flashdata('message'); ?>
		<?= form_error('file', '<div class="alert alert-danger" role="alert">', '</div>'); ?>
	</div>

	<div class="row">
		<div class="col-lg-8">
			<?= form_open_multipart('user/upload');?>
				<div class="form-group row">
					<label for="email" class="col-sm-2 col-form-label">Email</label>
					<div class="col-sm-10">
						<input type="text" class="form-control" id="email" name="email" value="<?= $user['email']; ?>" readonly>
					</div>
				</div>
				<div class="form-group row">
					<div class="col-sm-2">File</div>
					<div class="col-sm-10">
						<div class="custom-file">
							<input type="file" class="custom-file-input" id="file" name="file" accept="application/pdf, application/vnd.openxmlformats-officedocument.presentationml.presentation, application/vnd.ms-powerpoint, application/msword, application/vnd.openxmlformats-officedocument.wordprocessingml.document, application/vnd.ms-excel, application/vnd.openxmlformats-officedocument.spreadsheetml.sheet">
							<label class="custom-file-label" for="file">Choose file</label>
						</div>
					</div>
				</div>
				<div class="form-group row justify-content-end">
					<div class="col-sm-10">
						<button type="submit" class="btn btn-primary">Upload</button>
					</div>
				</div>
			</form>
		</div>
	</div>
	<div class="row">
		<div class="col-lg">
			<table class="table table-hover">
			  <thead>
			    <tr>
			      <th scope="col">#</th>
			      <th scope="col">Nama File</th>
			      <th scope="col">Jenis File</th>
			      <th scope="col">Tanggal Upload</th>
			      <th scope="col">Action</th>
			    </tr>
			  </thead>
			  <tbody>
			  	<?php
			  		$i = 1;
			  		foreach ($file as $f) :
			  	?>
			    <tr>
			      <th scope="row"><?= $i; ?></th>
			      <td><?= $f['name']; ?></td>
			      <td><?= $f['file_type']; ?></td>
			      <td><?= date("d-m-Y", $f['date']); ?></td>
			      <td>
			      		<a href="<?= base_url('assets/files/') . $f['name']; ?>" class="badge badge-success">download</a>
			      		<a href="javascript:hapusData(<?= $f['id']; ?>)" class="badge badge-danger">delete</a>
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
		  	window.location.href = 'hapusfile/' + id;
		}
	}
</script>
</div>



