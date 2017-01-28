<?php  
session_start();  
ob_start();  
include_once("../system/koneksi.php");
?>
<html>
<head>
	<title>Data Obat</title>
	<link rel="stylesheet" type="text/css" href="../css/bootstrap.css">
	<style type="text/css">
	body { padding:20px;}
	</style>
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
	<button class="btn btn-info" onclick="printDiv('div1')"><i class='fa fa-print'></i> Print</button>
	<div id="div1">
		<center><img src="../img/logo.png">
		<p style='margin-top:-10px;text-align:center;'>Jl. Lebak, Kp. Gunung Bentang, Kec. Padalarang, Ds. Jaya Mekar, Kab. Bandung Barat</p>
		</center>
		<hr>
		<h1>Laporan Data Obat</h1>
		<table class="table table-bordered">
			<tr>
				<th style="width:5%;padding:10px;" class="text-center">No.</th>
				<th style="width:35%" class="text-center">Nama Obat</th>
				<th style="width:20%" class="text-center">Stok Obat</th>
				<th style="width:20%" class="text-center">Harga Beli</th>
				<th style="width:20%" class="text-center">Harga Jual</th>
			</tr>
			<?php 
			$no = 1;
			$dataobat = mysql_query("SELECT * FROM obat");
			while ($data2=mysql_fetch_array($dataobat)) {
			?>
			<tr>
				<td style="padding:10px;"><?php echo $no; ?></td>
				<td><?php echo $data2['nama_obat']; ?></td>
				<td><?php echo $data2['stok']; ?> <?php echo $data2['satuan']; ?></td>
				<td>Rp. <?php echo number_format($data2['harga_beli'],2,",",".");?></td>
				<td>Rp. <?php echo number_format($data2['harga_jual'],2,",","."); ?></td>
			</tr>
			<?php $no++; } ?> 
		</table>

		<p>Total Persediaan Obat: <b><?php $total = mysql_fetch_array(mysql_query("SELECT SUM(stok) FROM obat")); echo $total['SUM(stok)']; ?></b> Obat</p>
		</div>
</body>
</html>