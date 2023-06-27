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
		<h1>Laporan Gaji Pegawai</h1>
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
	<?php
$bulan = date('n'); // Mendapatkan angka bulan saat ini (1-12)
$nama_bulan = array(
    1 => 'Januari',
    2 => 'Februari',
    3 => 'Maret',
    4 => 'April',
    5 => 'Mei',
    6 => 'Juni',
    7 => 'Juli',
    8 => 'Agustus',
    9 => 'September',
    10 => 'Oktober',
    11 => 'November',
    12 => 'Desember',
);
$bulan_indonesia = $nama_bulan[$bulan]; // Mengambil nama bulan dari array berdasarkan angka bulan// Output: Nama bulan dalam bahasa Indonesia
?>

	<table>
		<tr>
			<td>Bulan</td>
			<td>:</td>
			<td><?php echo $bulan_indonesia ?></td>
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
			<th class="text-center">Gaji Pokok</th>
			<th class="text-center">Tunjangan Jabatan</th>
			<th class="text-center">Tunjangan Transport</th>
			<th class="text-center">Uang Lembur</th>
			<th class="text-center">Uang Makan</th>
			<th class="text-center">Insentif</th>
			<th class="text-center">Total Gaji</th>
		</tr>
		<?php $no = 1;
foreach ($cetak_gaji as $g): ?>
			<?php
if ($g->hadir == 22) {
    $insentif = 15000;
} else {
    $insentif = 0;
}
?>
			<tr>
				<td class="text-center"><?php echo $no++ ?></td>
				<td class="text-center"><?php echo $g->nik ?></td>
				<td class="text-center"><?php echo $g->full_name ?></td>
				<td class="text-center"><?php echo $g->name ?></td>
				<td class="text-center">Rp. <?php echo number_format($g->basic_salary, 0, ',', '.') ?></td>
				<td class="text-center">Rp. <?php echo number_format($g->t_jabatan, 0, ',', '.') ?></td>
				<td class="text-center">Rp. <?php echo number_format($g->ts, 0, ',', '.') ?></td>
				<td class="text-center">Rp. <?php echo number_format($g->ul, 0, ',', '.') ?></td>
				<td class="text-center">Rp. <?php echo number_format($g->um, 0, ',', '.') ?></td>
				<td class="text-center">Rp. <?php echo number_format($insentif, 0, ',', '.') ?></td>
				<td class="text-center">Rp. <?php echo number_format($g->total + $insentif, 0, ',', '.') ?></td>
			</tr>
		<?php endforeach;?>
	</table>

	<table width="100%">
		<tr>
			<td></td>
			<td width="200px">
				<p>Purwakarta, <?php echo date("d M Y") ?> <br> Direktur</p>
				<br>
				<br>
				<br>
				<p>_____________________</p>
			</td>
		</tr>
	</table>
</body>

</html>

<!-- <script type="text/javascript">
	window.print();
</script> -->