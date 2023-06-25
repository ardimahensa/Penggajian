<!-- Begin Page Content -->
<div class="container-fluid">

  <!-- Page Heading -->
  <div class="d-sm-flex align-items-center justify-content-between mb-4">
    <h1 class="h3 mb-0 text-gray-800"><?php echo $title ?></h1>
  </div>

  <div class="card mb-3">
  <div class="card-header bg-primary text-white">
    Input Absensi Pegawai
  </div>
  <div class="card-body">
    <form class="form-inline">
	  <div class="form-group mb-2">
	    <label for="staticEmail2">Bulan</label>
	    <select class="form-control ml-3" name="bulan">
		    <option value=""> Pilih Bulan </option>
		    <option value="01">Januari</option>
		    <option value="02">Februari</option>
		    <option value="03">Maret</option>
		    <option value="04">April</option>
		    <option value="05">Mei</option>
		    <option value="06">Juni</option>
		    <option value="07">Juli</option>
		    <option value="08">Agustus</option>
		    <option value="09">September</option>
		    <option value="10">Oktober</option>
		    <option value="11">November</option>
		    <option value="12">Desember</option>
	    </select>
	  </div>
	  <div class="form-group mb-2 ml-5">
	    <label for="staticEmail2">Tahun</label>
	    <select class="form-control ml-3" name="tahun">
		    <option value=""> Pilih Tahun </option>
		    <?php $tahun = date('Y');
for ($i = 2020; $i < $tahun + 5; $i++) {?>
		    <option value="<?php echo $i ?>"><?php echo $i ?></option>
		<?php }?>
		</select>
	    </select>
	  </div>

	  <button type="submit" class="btn btn-primary mb-2 ml-auto"><i class="fas fa-eye"></i> Generate Form</button>
	</form>
  </div>
</div>

	<?php
if ((isset($_GET['bulan']) && $_GET['bulan'] != '') && (isset($_GET['tahun']) && $_GET['tahun'] != '')) {
    $bulan = $_GET['bulan'];
    $tahun = $_GET['tahun'];
    $bulantahun = $bulan . $tahun;
} else {
    $bulan = date('m');
    $tahun = date('Y');
    $bulantahun = $bulan . $tahun;
}
?>

	<div class="alert alert-info">
		Menampilkan Data Kehadiran Pegawai Bulan: <span class="font-weight-bold"><?php echo $bulan ?></span> Tahun: <span class="font-weight-bold"><?php echo $tahun ?></span>
	</div>
	<form method="POST"  style="text-align: right;">
	<button class="btn btn-success mb-3" type="submit" name="submit" value="submit">Simpan</button>
	<table class="table table-bordered table-striped">
		<tr class="text-center">
			<td>No</td>
			<td>NIK</td>
			<td>Nama Pegawai</td>
			<td>Jabatan</td>
			<td width="8%">Hadir</td>
			<td width="8%">Lembur</td>
		</tr>
		<?php $no = 1;foreach ($input_absensi as $a): ?>
			<tr align="center">
				<input type="hidden" name="bulan[]" class="form-control" value="<?php echo $bulantahun ?>">
				<input type="hidden" name="user_id[]" class="form-control" value="<?php echo $a->user_id ?>">
				<td><?php echo $no++ ?></td>
				<td><?php echo $a->nik ?></td>
				<td><?php echo $a->full_name ?></td>
				<td><?php echo $a->name ?></td>
				<td style="text-align: center;"><input type="number" name="hadir[]" class="form-control" value="0"></td>
				<td style="text-align: center;"><input type="number" name="lembur[]" class="form-control" value="0"></td>
		<?php endforeach;?>
	</table><br></br><br></br>
	</form>

</div>
<!-- /.container-fluid -->