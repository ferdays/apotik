<?php  
session_start();  
ob_start();  
include_once("../system/koneksi.php");
$namabulan = array("Januari", "Februari", "Maret", "April", "Mei", "Juni", "Juli", "Agustus", "September", "Oktober", "November", "Desember");
$bulan = $_POST['bulan'];
if (!isset($bulan)) {
	header("Location:../index.php");
}
?>
<html moznomarginboxes mozdisallowselectionprint>
<head>
	<title></title>
	<style type="text/css">
	body {
		padding: 10px;
		font-family: 'Calibri',sans-serif;
	}
	</style>
	<link rel="stylesheet" type="text/css" href="../fonts/font-awesome/css/font-awesome.min.css">
	<link rel="stylesheet" type="text/css" href="../css/bootstrap.css">
	<script>
	printDivCSS = new String ('<link href="bootstrap.css" rel="stylesheet" type="text/css">')
	function printDiv(divName) {
     var printContents = document.getElementById(divName).innerHTML;
     var originalContents = document.body.innerHTML;

     document.body.innerHTML = printContents;

     window.print();

     document.body.innerHTML = originalContents;
	}
	</script>
</head>
<body>
	<div id="div1">
		<center><img src="../img/logo.png"></center>
		<p style='margin-top:-10px;text-align:center;'>Jl. Lebak, Kp. Gunung Bentang, Kec. Padalarang, Ds. Jaya Mekar, Kab. Bandung Barat</p>
		<hr style="border:1px solid #D4D4D4;">
		<h3 class='text-center'>Rekap Penjualan Obat Resep Bulan <?php echo $namabulan[$bulan]; ?></h3>
		<br>
		<table class="table table-bordered">
			<thead>
				<tr>
					<th class="text-center">No.</th>
					<th class="text-center">Tanggal Penjualan</th>
					<th class="text-center">No. Resep</th>
					<th class="text-center">Dokter</th>
					<th class="text-center">Nama Obat</th>
					<th class="text-center">Jumlah Penjualan</th>
					<th class="text-center">Total</th>
				</tr>
			</thead>
			<tbody>
				<?php
					$no = 1;
					$bulan2 = $bulan + 1;
					$getbulanan = mysql_query("SELECT * FROM faktur_penjualan_resep WHERE MONTH(tanggal)=$bulan2 ORDER BY id_faktur_r DESC");
					while ($bulanan=mysql_fetch_array($getbulanan)) {
				?>
				<tr>
					<td class="text-center"><?php echo $no; ?></td>
					<td class="text-center">
						<?php
						$string = $bulanan['tanggal'];
						$timestamp = strtotime($string);
						echo date("d", $timestamp);
						echo " " .$namabulan[$bulan];
						echo " " .date("Y", $timestamp);
						?>
					</td>
					<td class="text-center"><?php echo $bulanan['no_resep']; ?></td>
					<td class="text-center">
						<?php
						$noresep = $bulanan['no_resep'];
						$getpenjualan = mysql_fetch_array(mysql_query("SELECT * FROM penjualan_resep WHERE no_resep='$noresep'"));
						$iddokter = $getpenjualan['id_dokter'];
						$getdokter = mysql_fetch_array(mysql_query("SELECT * FROM dokter WHERE id_dokter='$iddokter'"));
						echo $getdokter['nama'];
						?>
					</td>
					<td class="text-center">
						<?php
							$idobat = $bulanan['id_obat'];
							$getobat = mysql_query("SELECT * FROM obat WHERE id_obat=$idobat");
							$obat = mysql_fetch_array($getobat);
							echo "<b>".$obat['nama_obat']."</b>";
						?>
					</td>
					<td class="text-center"><?php echo $bulanan['jumlah']; ?></td>
					<td class="text-center">Rp. <?php echo number_format($bulanan['subtotal'],2,",","."); ?></td>
				</tr>
				<?php $no++; } ?>
			</tbody>
		</table>
		<iframe name="print_frame" width="0" height="0" frameborder="0" src="about:blank"></iframe>
	</div>
		<br>
		<br>
		<center>
			<a class='btn btn-info btn-lg' onclick="printDiv('div1')"><i class='fa fa-print'></i> Print</a>
		</center>
</body>
</html>