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
?>

	<table>
		<tr>
			<td>Bulan</td>
			<td>:</td>
			<td><?php echo $bulanName ?></td>
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
			<th class="text-center">Gaji</th>
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

<?php
$totalT_transport = $g->t_transport * $g->hadir;
$totalUang_makan = $g->uang_makan * $g->hadir;
$totalLembur = $g->lembur * 21250;
$pembulatan = ($g->um_lembur * $g->uang_makan) + ($g->ts_lembur * $g->t_transport);
$gajiKotor = $g->basic_salary + $g->t_jabatan + $totalT_transport + $totalUang_makan + $totalLembur + $pembulatan;
$bpjs = ($g->basic_salary + $g->t_jabatan) * 0.04 + 15838;
$gajiPertahun = $gajiKotor * 12;
$tax = 0;
$potongan = $bpjs + $tax;
$gajiBersih = $gajiKotor - $potongan;
$total = ROUND($gajiBersih, -3);
switch (true) {
    case ($gajiPertahun <= 60000000);
        $tax = $gajiKotor * 0.05;
        break;
    case ($gajiPertahun > 60000000 && $gajiPertahun <= 250000000);
        $tax = $gajiKotor * 0.15;
        break;
    default:
        $tax = $gajiKotor * 0.25;
        break;
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
				<td class="text-center">Rp. <?php echo number_format($total, 0, ',', '.') ?></td>
			</tr>
		<?php endforeach;?>
	</table>
</body>

</html>

<script type="text/javascript">
	window.print();
</script>