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

		<?php foreach ($pegawai as $p): ?>
		<form method="POST" action="<?php echo base_url('admin/data_pegawai/update_data_aksi') ?>" enctype="multipart/form-data">

			<div class="form-group">
				<label>NIK</label>
				<input type="hidden" name="id_pegawai" class="form-control" value="<?php echo $p->id ?>">
				<input type="text" name="nik" class="form-control" value="<?php echo $p->nik ?>">
				<?php echo form_error('nik', '<div class="text-small text-danger"> </div>') ?>
			</div>

			<div class="form-group">
				<label>Nama Pegawai</label>
				<input type="text" name="full_name" class="form-control" value="<?php echo $p->full_name ?>">
				<?php echo form_error('full_name', '<div class="text-small text-danger"> </div>') ?>
			</div>

			<div class="form-group">
				<label>Username</label>
				<input type="text" name="username" class="form-control" value="<?php echo $p->username ?>">
				<?php echo form_error('username', '<div class="text-small text-danger"> </div>') ?>
			</div>

			<div class="form-group">
				<label>Password</label>
				<input type="password" name="password" class="form-control" value="<?php echo md5($p->password) ?>">
				<?php echo form_error('password', '<div class="text-small text-danger"> </div>') ?>
			</div>

			<div class="form-group">
				<label>Jenis Kelamin</label>
				<select name="gender" class="form-control" value="<?php echo $p->id ?>">
					<option value="<?php echo $p->gender ?>"><?php echo $p->gender ?></option>
					<option value="Laki-Laki">Laki-Laki</option>
					<option value="Perempuan">Perempuan</option>
				</select>
				<?php echo form_error('gender', '<div class="text-small text-danger"> </div>') ?>
			</div>

			<div class="form-group">
				<label>Jabatan</label>
				<select name="jabatan" class="form-control">
					<!-- <option value="<?php echo $p->name ?>"><?php echo $p->name ?></option> -->
					<?php foreach ($posisi->result() as $j): ?>
								<option value="<?php echo $j->id ?>"><?php echo $j->name ?></option>
								<?php endforeach;?>
				</select>
			</div>

			<div class="form-group">
				<label>Tanggal Masuk</label>
				<input type="date" name="tanggal_masuk" class="form-control" value="<?php echo $p->tanggal_masuk ?>">
				<?php echo form_error('tanggal_masuk', '<div class="text-small text-danger"> </div>') ?>
			</div>

			<div class="form-group">
				<label>Status</label>
				<select name="employe_status" class="form-control">
					<option value="<?php echo $p->employe_status ?>"><?php echo $p->employe_status ?></option>
					<option value="tetap">Karyawan Tetap</option>
					<option value="tidak tetap">Karyawan Tidak Tetap</option>
				</select>
				<?php echo form_error('employe_status', '<div class="text-small text-danger"> </div>') ?>
			</div>

			<div class="form-group">
				<label>Photo</label>
				<input type="file" name="foto" class="form-control">
			</div>

			<button type="submit" class="btn btn-success" >Simpan</button>
			<a href="<?php echo base_url('admin/data_pegawai') ?>" class="btn btn-warning">Kembali</a>

		</form>
	<?php endforeach;?>
	</div>
</div>