<!-- Begin Page Content -->
<div class="container-fluid">

	<!-- Page Heading -->
	<div class="d-sm-flex align-items-center justify-content-between mb-4">
		<h1 class="h3 mb-0 text-gray-800"><?php echo $title ?></h1>
	</div>

	<table class="table table-striped table-bordered">
		<tr class="flex-wrap" align="center">
			<th class="text-center">Bulan/Tahun</th>
			<th class="text-center" width="150px">Gaji Pokok</th>
			<th class="text-center" width="150px">Tunjangan Jabatan</th>
			<th class="text-center" width="150px">Tunjangan Transportasi</th>
			<th class="text-center" width="150px">Insentif</th>
			<th class="text-center">Uang Makan</th>
			<th class="text-center">Uang Lembur</th>
			<th class="text-center">Hadir (Hari)</th>
			<th class="text-center">Lembur (Jam)</th>
			<th class="text-center">Cetak Slip</th>
		</tr>


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

$bul = array(
    '01' => 'Januari',
    '02' => 'Februari',
    '03' => 'Maret',
    '04' => 'April',
    '05' => 'Mei',
    '06' => 'Juni',
    '07' => 'Juli',
    '08' => 'Agustus',
    '09' => 'September',
    '10' => 'Oktober',
    '11' => 'November',
    '12' => 'Desember',
);

$bulanName = (isset($bul[$bulan]) ? $bul[$bulan] : '-');

date_default_timezone_set('Asia/Jakarta');
$hari = date('d');

if ($hadir = 22) {
    $insentif = 15000;
} else {
    $insentif = 0;
}

?>
		<?php foreach ($gaji as $g): ?>
			<tr>
				<td><?php echo $bulanName . ' ' . $tahun ?></td>
				<td>Rp. <?php echo number_format($g->basic_salary, 0, ',', '.') ?></td>
				<td>Rp. <?php echo number_format($g->t_jabatan, 0, ',', '.') ?></td>
				<td>Rp. <?php echo number_format($g->t_transport, 0, ',', '.') ?></td>
				<td>Rp. <?php echo number_format($insentif, 0, ',', '.') ?></td>
				<td>Rp. <?php echo number_format($g->uang_makan, 0, ',', '.') ?></td>
				<td>Rp. <?php echo number_format($g->uang_lembur, 0, ',', '.') ?></td>
				<td><?php echo $g->hadir ?></td>
				<td><?php echo $g->lembur ?></td>
				<td>
					<center>
						<a class="btn btn-sm btn-primary" href="<?php echo base_url('pegawai/data_gaji/cetak_slip/' . $g->id) ?>"><i class="fas fa-print"></i></a>
					</center>
				</td>
			</tr>
		<?php endforeach;?>
	</table>

</div>
<!-- /.container-fluid -->