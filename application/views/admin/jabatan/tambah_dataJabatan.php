<!-- Begin Page Content -->
<div class="container-fluid">

	<!-- Page Heading -->
	<div class="d-sm-flex align-items-center justify-content-between mb-4">
		<h1 class="h3 mb-0 text-gray-800"><?php echo $title ?></h1>
	</div>

</div>
<!-- /.container-fluid -->

<div class="card" style="width: 60% ; margin-bottom: 100px">
	<div class="card-body">
		<form method="POST" action="<?php echo base_url('admin/data_jabatan/tambah_data_aksi') ?>">

			<div class="form-group">
				<label>Nama Jabatan</label>
				<input type="text" name="name" class="form-control">
				<?php echo form_error('name', '<div class="text-small text-danger"> </div>') ?>
			</div>

			<div class="form-group">
				<label>Gaji Pokok</label>
				<input type="number" name="basic_salary" class="form-control">
				<?php echo form_error('basic_salary', '<div class="text-small text-danger"> </div>') ?>
			</div>

			<div class="form-group">
				<label>Tunjangan Jabatan</label>
				<input type="number" name="t_jabatan" class="form-control">
				<?php echo form_error('t_jabatan', '<div class="text-small text-danger"> </div>') ?>
			</div>

			<div class="form-group">
				<label>Tunjangan Transport</label>
				<input type="number" name="t_transport" class="form-control">
				<?php echo form_error('t_transport', '<div class="text-small text-danger"> </div>') ?>
			</div>

			<div class="form-group">
				<label>Uang Makan</label>
				<input type="number" name="uang_makan" class="form-control">
				<?php echo form_error('uang_makan', '<div class="text-small text-danger"> </div>') ?>
			</div>

			<div class="form-group">
				<label>Uang Lembur</label>
				<input type="number" name="uang_lembur" class="form-control">
				<?php echo form_error('uang_lembur', '<div class="text-small text-danger"> </div>') ?>
			</div>

			<button type="submit" class="btn btn-success">Simpan</button>
			<button type="reset" class="btn btn-danger">Reset</button>

		</form>
	</div>
</div>