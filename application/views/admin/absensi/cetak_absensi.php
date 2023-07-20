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
<left>
	<img src="<?php echo base_url('assets/img/logo.png'); ?>" alt="Logo">
	</left>
	<center>
		<h2>Laporan Absensi Pegawai</h2>
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
    '12' => 'Desember',
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
</br>

	<table class="table table-bordered table-triped">
		<tr>
			<th class="text-center">No</th>
			<th class="text-center">NIK</th>
			<th class="text-center">Nama Pegawai</th>
			<th class="text-center">Jabatan</th>
			<th class="text-center">Hadir</th>
			<th class="text-center">Lembur</th>
			<td class="text-center"><b>Uang Makan Lembur</b></td>
			<td class="text-center"><b>Uang Transport Lembur</b></td>

		</tr>
		<?php $no = 1;
foreach ($lap_kehadiran as $l): ?>
			<tr>
				<td class="text-center"><?php echo $no++ ?></td>
				<td class="text-center"><?php echo $l->nik ?></td>
				<td class="text-center"><?php echo $l->full_name ?></td>
				<td class="text-center"><?php echo $l->name ?></td>
				<td class="text-center"><?php echo $l->hadir ?> Hari</td>
				<td class="text-center"><?php echo $l->lembur ?> Jam</td>
				<td width="130px" class="text-center"><?php echo $l->um_lembur ?> Kali</td>
				<td width="150px" class="text-center"><?php echo $l->ts_lembur ?> Kali</td>
			</tr>
		<?php endforeach;?>
	</table>

</body>

</html>

<script type="text/javascript">
	window.print();
</script>