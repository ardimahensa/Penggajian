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
	<?php foreach ($print_slip as $p): ?>

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
$bulan = date('n');
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
$bulan_indonesia = $nama_bulan[$bulan];
?>

<?php
if ($hadir = 22) {
    $insentif = 15000;
} else {
    $insentif = 0;
}
?>

<?php
$totalT_transport = $p->t_transport * $p->hadir;
$totalUang_makan = $p->uang_makan * $p->hadir;
$totalLembur = $p->lembur * 21250;
$pembulatan = ($p->um_lembur * $p->uang_makan) + ($p->ts_lembur * $p->t_transport);
$gajiKotor = $p->basic_salary + $p->t_jabatan + $totalT_transport + $totalUang_makan + $totalLembur + $pembulatan;
$bpjs = ($p->basic_salary + $p->t_jabatan) * 0.04 + 15838;
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
		</br>
		<table style="width: 100%">

			<!-- baris ke-1 -->
			<tr>
				<td width="10%" sty><b>PT. KYI</b></td>
				<td colspan="4"></td>
				<td width="5%">Nama</td>
				<td>:</td>
				<td width="10%"><?php echo $p->full_name ?></td>
				<td style="border-right: 1px solid black;"><?php echo $p->nik ?></td>
				<td width="2%"></td>
				<td width="10%"><b>PT. KYI</b></td>
				<td></td>
				<td rowspan="11"></td>
			</tr>

			<!-- baris ke-2 -->
			<tr>
				<td colspan="5"></td>
				<td>Divisi</td>
				<td>:</td>
				<td><?php echo $p->name ?></td>
				<td style="border-right: 1px solid black;"></td>
				<td></td>
				<td>Slip</td>
				<td></td>
			</tr>

			<!-- baris ke-3 -->
			<tr>
				<td>Hari Kerja</td>
				<td>:</td>
				<td><?php echo $p->hadir ?></td>
				<td colspan="2"></td>
				<td>Bulan</td>
				<td>:</td>
				<td><?php echo $bulan_indonesia . ' - ' . substr($tahun, 2) ?></td>
				<td style="border-right: 1px solid black;"></td>
				<td></td>
				<td>Bulan</td>
				<td><?php echo $bulan_indonesia . ' - ' . substr($tahun, 2) ?></td>
			</tr>

			<!-- baris ke-4 -->
			<tr height="25px">
				<td colspan="9" style="border-right: 1px solid black;"></td>
				<td></td>
				<td colspan="2"></td>
			</tr>

			<!-- baris ke-5 -->
			<tr>
				<td colspan="7"></td>
				<td align="center" colspan="2" style="border-right: 1px solid black;">Potongan</td>
				<td></td>
				<td colspan="2"></td>
			</tr>

			<!-- baris ke-6 -->
			<tr>
				<td>Gaji Pokok</td>
				<td colspan="3"></td>
				<td>Rp. <?php echo number_format($p->basic_salary, 0, ',', '.') ?></td>
				<td colspan="2"></td>
				<td>BPJS</td>
				<td style="border-right: 1px solid black;">Rp. <?php echo number_format($bpjs, 0, ',', '.') ?></td>
				<td></td>
				<td>Gaji Kotor</td>
				<td>Rp. <?php echo number_format($gajiKotor, 0, ',', '.') ?></td>
			</tr>

			<!-- baris ke-7 -->
			<tr>
				<td>Tunjangan Jabatan</td>
				<td colspan="3"></td>
				<td>Rp. <?php echo number_format($p->t_jabatan, 0, ',', '.') ?></td>
				<td colspan="2"></td>
				<td>TAX</td>
				<td style="border-right: 1px solid black;">Rp. <?php echo number_format($tax, 0, ',', '.') ?></td>
				<td></td>
				<td>Potongan</td>
				<td style="border-bottom: 1px solid black">Rp. <?php echo number_format($potongan, 0, ',', '.') ?></td>
			</tr>

			<!-- baris ke-8 -->
			<tr>
				<td>Tunjangan Transport</td>
				<td colspan="3"></td>
				<td>Rp. <?php echo number_format($totalT_transport, 0, ',', '.') ?></td>
				<td colspan="2"></td>
				<td colspan="2" style="border-right: 1px solid black;"></td>
				<td></td>
				<td>Gaji Bersih</td>
				<td>Rp. <?php echo number_format($gajiBersih, 0, ',', '.') ?></td>
			</tr>

			<!-- baris ke-9 -->
			<tr>
				<td>Insentif</td>
				<td colspan="3"></td>
				<td>Rp. <?php echo number_format($insentif, 0, ',', '.') ?></td>
				<td colspan="2"></td>
				<td colspan="2" style="border-right: 1px solid black;"></td>
				<td></td>
				<td colspan="2"></td>
			</tr>

			<!-- baris ke-10 -->
			<tr>
				<td>Tunjangan Makan</td>
				<td colspan="3"></td>
				<td>Rp. <?php echo number_format($totalUang_makan, 0, ',', '.') ?></td>
				<td colspan="2"></td>
				<td colspan="2" style="border-right: 1px solid black;"></td>
				<td></td>
				<td><b>Dibayarkan</b></td>
				<td><b>Rp. <?php echo number_format($total, 0, ',', '.') ?></b></td>
			</tr>

			<!-- baris ke-11 -->
			<tr>
				<td>Lembur</td>
				<td colspan="2"></td>
				<td><?php echo $p->lembur ?> Jam</td>
				<td>Rp. <?php echo number_format($totalLembur, 0, ',', '.') ?></td>
				<td colspan="2"></td>
				<td colspan="2" style="border-right: 1px solid black;"></td>
				<td></td>
				<td colspan="2"></td>
			</tr>

			<!-- baris ke-12 -->
			<tr>
				<td>Pembulatan (+)/(-)</td>
				<td colspan="3"></td>
				<td>Rp. <?php echo number_format($pembulatan, 0, ',', '.') ?></td>
				<td colspan="2"></td>
				<td colspan="2" style="border-right: 1px solid black;"></td>
				<td></td>
				<td colspan="2"></td>
			</tr>

			<!-- baris ke-13 -->
			<tr height="25px">
				<td colspan="4"></td>
				<td style="border-bottom: 1px solid black;"></td>
				<td colspan="2"></td>
				<td colspan="2" style="border-bottom: 1px solid black; border-right: 1px solid black;"></td>
				<td></td>
				<td colspan="2"></td>
			</tr>

			<!-- baris ke-14 -->
			<tr>
				<td>Gaji Kotor</td>
				<td colspan="3"></td>
				<td>Rp. <?php echo number_format($gajiKotor, 0, ',', '.') ?></td>
				<td colspan="2"></td>
				<td>Potongan</td>
				<td style="border-right: 1px solid black;">Rp. <?php echo number_format($potongan, 0, ',', '.') ?></td>
				<td></td>
				<td colspan="2" align="center"><b><?php echo $p->full_name ?></b></td>
			</tr>

			<!-- baris ke-15 -->
			<tr>
				<td>Gaji Bersih</td>
				<td colspan="3"></td>
				<td>Rp. <?php echo number_format($gajiBersih, 0, ',', '.') ?></td>
				<td colspan="2"></td>
				<td><b>Dibayarkan</b></td>
				<td style="border-right: 1px solid black;"><b>Rp. <?php echo number_format($total, 0, ',', '.') ?></b></td>
				<td></td>
				<td colspan="2" align="center"><b><?php echo $p->nik ?></b></td>
			</tr>
		</table>
		</br>
	<?php endforeach;?>

</body>

</html>

<script type="text/javascript">
	window.print();
</script>