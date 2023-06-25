<!DOCTYPE html>
<html>

<head>
	<title><?php echo $title ?></title>
	<style type="text/css">
		body {
			font-family: Arial;
			color: black;
		}
	</style>
</head>

<body>
	<center>
		<h1>PT. Kyodo Utama Indonesia</h1>
		<h2>Laporan Kehadiran Pegawai</h2>
	</center>

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

	<?php $bul = array(
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
		'12' => 'Desember'
	);

	$bulanName = (isset($bul[$bulan]) ? $bul[$bulan] : '-');
	?>

	<table>
		<tr>
			<td>Bulan</td>
			<td>:</td>
			<td>
				<?php echo $bulanName ?></td>
		</tr>
		<tr>
			<td>Tahun</td>
			<td>:</td>
			<td><?php echo $tahun ?></td>
		</tr>
	</table>

	<table class="table table-bordered table-triped">
		<tr>
			<th class="text-center">No</th>
			<th class="text-center">NIK</th>
			<th class="text-center">Nama Pegawai</th>
			<th class="text-center">Jabatan</th>
			<th class="text-center">Hadir</th>
			<th class="text-center">Lembur</th>
		</tr>
		<?php $no = 1;
		foreach ($lap_kehadiran as $l) : ?>
			<tr>
				<td class="text-center"><?php echo $no++ ?></td>
				<td class="text-center"><?php echo $l->nik ?></td>
				<td class="text-center"><?php echo $l->nama_pegawai ?></td>
				<td class="text-center"><?php echo $l->nama_jabatan ?></td>
				<td class="text-center"><?php echo $l->hadir ?> Hari</td>
				<td class="text-center"><?php echo $l->lembur ?> Jam</td>
			</tr>
		<?php endforeach; ?>
	</table>

</body>

</html>

<!-- <script type="text/javascript">
	window.print();
</script> -->