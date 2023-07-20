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
		<?php foreach ($jabatan as $j): ?>
			<form method="POST" action="<?php echo base_url('admin/data_jabatan/update_data_aksi') ?>">
				<div class="form-group">
					<label>Nama Jabatan</label>
					<input type="hidden" name="id_jabatan" class="form-control" value="<?php echo $j->id ?>">
					<input type="text" name="nama_jabatan" class="form-control" value="<?php echo $j->name ?>">
					<?php echo form_error('nama_jabatan', '<div class="text-small text-danger"> </div>') ?>
				</div>

				<div class="form-group">
					<label>Gaji Pokok</label>
					<input type="number" name="basic_salary" class="form-control" value="<?php echo $j->basic_salary ?>">
					<?php echo form_error('basic_salary', '<div class="text-small text-danger"> </div>') ?>
				</div>

				<div class="form-group">
					<label>Tunjangan Jabatan</label>
					<input type="number" name="t_jabatan" class="form-control" value="<?php echo $j->t_jabatan ?>">
					<?php echo form_error('t_jabatan', '<div class="text-small text-danger"> </div>') ?>
				</div>

				<div class="form-group">
					<label>Tunjangan Transport</label>
					<input type="number" name="t_transport" class="form-control" value="<?php echo $j->t_transport ?>">
					<?php echo form_error('t_transport', '<div class="text-small text-danger"> </div>') ?>
				</div>

				<div class="form-group">
					<label>Uang Makan</label>
					<input type="number" name="uang_makan" class="form-control" value="<?php echo $j->uang_makan ?>">
					<?php echo form_error('uang_makan', '<div class="text-small text-danger"> </div>') ?>
				</div>

				<div class="form-group">
					<label>Uang Lembur</label>
					<input type="number" name="uang_lembur" class="form-control" value="<?php echo $j->uang_lembur ?>">
					<?php echo form_error('uang_lembur', '<div class="text-small text-danger"> </div>') ?>
				</div>
				<button type="submit" class="btn btn-success">Simpan</button>
			</form>
		<?php endforeach;?>
	</div>
</div>