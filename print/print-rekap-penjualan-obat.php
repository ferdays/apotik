<?php  
session_start();  
ob_start();  
include_once("../system/koneksi.php");
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
		<h3 class='text-center'>Rekap Penjualan Obat Tahun 2016</h3>
		<br>
		<table class="table table-bordered">
			<thead>
				<tr>
					<th rowspan="2" class="text-center" style="vertical-align:middle;">No.</th>
					<th rowspan="2" class="text-center" style="vertical-align:middle;">Nama Obat</th>
					<th colspan="12" class="text-center">Jumlah Penjualan</th>
					<th rowspan="2" class="text-center" style="vertical-align:middle;">Total Penjualan</th>
					<tr>
						<th class="text-center">Jan</th>
						<th class="text-center">Feb</th>
						<th class="text-center">Mar</th>
						<th class="text-center">Apr</th>
						<th class="text-center">Mei</th>
						<th class="text-center">Jun</th>
						<th class="text-center">Jul</th>
						<th class="text-center">Agu</th>
						<th class="text-center">Sep</th>
						<th class="text-center">Okt</th>
						<th class="text-center">Nov</th>
						<th class="text-center">Des</th>
					</tr>
				</tr>
			</thead>
			<tbody>
				<?php 
					$no=1;
					$dataobat = mysql_query("SELECT * FROM obat ORDER BY nama_obat ASC");
					while ($obat=mysql_fetch_array($dataobat)) {
				?>
				<tr>
					<td class="text-center"><?php echo $no; ?></td>
					<td class="text-center"><?php echo $obat['nama_obat']; ?></td>
						<?php 
						for ($i=1; $i < 13; $i++) { 
						?>
						<td class="text-center">
							<?php
								$idobat = $obat['id_obat'];
								$getbulan = mysql_query("SELECT SUM(jumlah) FROM faktur_penjualan WHERE MONTH(tanggal)='$i' AND id_obat=$idobat");
								$bulan = mysql_fetch_array($getbulan);
								if ($bulan['SUM(jumlah)']==NULL) {
									echo "0";
								}
								else {
								echo $bulan['SUM(jumlah)'];
							}
							?>
						</td>
						<?php } ?>
					<td class="text-center">
						<?php
							$getjumlah = mysql_query("SELECT SUM(jumlah) FROM faktur_penjualan WHERE id_obat=$idobat");
							$jumlah = mysql_fetch_array($getjumlah);
							if ($jumlah['SUM(jumlah)']==NULL) {
								echo "0";
							}
							else {
								echo $jumlah['SUM(jumlah)'];
							}
						?>
					</td>
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