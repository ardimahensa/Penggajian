<div class="container-fluid">
  <div class="d-sm-flex align-items-center justify-content-between mb-4">
    <h1 class="h3 mb-0 text-gray-800"><?php echo $title ?></h1>
  </div>

  <div class="card mb-3">
  <div class="card-header bg-primary text-white">
    Filter Data Absensi Pegawai
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

	  <button type="submit" class="btn btn-primary mb-2 ml-auto"><i class="fas fa-eye"></i> Tampilkan Data</button>
	  <a href="<?php echo base_url('admin/data_absensi/input_absensi') ?>" class="btn btn-success mb-2 ml-3"><i class="fas fa-plus"></i> Input Kehadiran</a>
	</form>
  </div>
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

	<?php

$jml_data = count($presences);
if ($jml_data > 0) {?>

		<div class="container-fluid ">
		  <div class="card shadow mb-4">
		   <div class="card-body">
		     <div class="table-responsive">
		       <table class="table table-bordered align-items-center" id="dataTable" width="100%" cellspacing="0">
		         <thead class="thead-dark">
		           <tr>
		              	<td class="text-center">No</td>
		              	<td class="text-center">NIK</td>
						<td class="text-center">Nama Pegawai</td>
						<td class="text-center">Jabatan</td>
						<td class="text-center">Hadir</td>
						<td class="text-center">Lembur</td>
						<td class="text-center">Uang Makan Lembur</td>
						<td class="text-center">Uang Transport Lembur</td>
		           </tr>
		         </thead>
		         <tbody>
		           <?php $no = 1;foreach ($presences as $a): ?>
					<tr>
						<td class="text-center"><?php echo $no++ ?></td>
						<td class="text-center"><?php echo $a->nik ?></td>
						<td class="text-center"><?php echo $a->full_name ?></td>
						<td class="text-center"><?php echo $a->name ?></td>
						<td class="text-center"><?php echo $a->hadir ?> Hari</td>
						<td class="text-center"><?php echo $a->lembur ?> Jam</td>
						<td class="text-center"><?php echo $a->um_lembur ?></td>
						<td class="text-center"><?php echo $a->ts_lembur ?></td>
					</tr>
		            </tr>
		          <?php endforeach;?>
		         </tbody>
		       </table>
		     </div>
		   </div>
		  </div>
		</div>

	<?php } else {?>
		<center><span class="badge badge-danger"><i class="fas fa-info-circle"></i> Data masih kosong, silakan input data kehadiran pada bulan dan tahun yang anda pilih</span>
	</center>
	<?php }?>
</div>