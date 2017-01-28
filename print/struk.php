<?php  
session_start();  
ob_start();  
include_once("../system/koneksi.php");
$nofaktur = $_GET['no_faktur'];
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
		<h3 class='text-center'>Nota Penjualan</h3>
		<table>
			<tr>
				<td>No Resep</td>
				<td>&nbsp;&nbsp;&nbsp;: <strong><?php echo $nofaktur; ?></strong></td>
			</tr>
			<tr>
				<td>Tanggal</td>
				<td>
					&nbsp;&nbsp;&nbsp;:
					<strong>
						<?php
							$tanggal = mysql_fetch_array(mysql_query("SELECT * FROM penjualan_resep WHERE no_resep='$nofaktur'"));
							$tanggal2 = $tanggal['tanggal'];
							$timestamp = strtotime($tanggal2);
							echo date("d", $timestamp);
							echo " " .date("M", $timestamp);
							echo " " .date("Y", $timestamp);
						?>
					</strong>
				</td>
			</tr>
			<tr>
				<td>Dokter</td>
				<td>&nbsp;&nbsp;&nbsp;: 
					<strong>
						<?php 
						$iddokter = $tanggal['id_dokter']; 
						$getdokter = mysql_fetch_array(mysql_query("SELECT * FROM dokter WHERE id_dokter='$iddokter'"));
						echo $getdokter['nama'];
						?>
					</strong>
				</td>
			</tr>
			<tr>
				<td>Alamat</td>
				<td>&nbsp;&nbsp;&nbsp;: 
					<strong>
						<?php 
						echo $getdokter['alamat'];
						?>
					</strong>
				</td>
			</tr>
			<tr>
				<td>No. Telepon</td>
				<td>&nbsp;&nbsp;&nbsp;: 
					<strong>
						<?php 
						echo $getdokter['no_telepon'];
						?>
					</strong>
				</td>
			</tr>
			<tr>
				<td>Nama Pasien</td>
				<td>&nbsp;&nbsp;&nbsp;: 
					<strong>
						<?php 
						echo $tanggal['namapasien'];
						?>
					</strong>
				</td>
			</tr>
		</table>
		<br>
		<table class="table table-bordered">
			<thead>
				<tr>
					<th class="text-center" style="vertical-align:middle;">No.</th>
					<th class="text-center" style="vertical-align:middle;">Nama Obat</th>
					<th class="text-center">Jumlah Pembelian</th>
					<th class="text-center" style="vertical-align:middle;">Subtotal</th>
				</tr>
			</thead>
			<tfoot>
				<tr>
					<th colspan="3" class='text-right'>Total</th>
					<th class='text-center'>
						<?php 
							$getjual = mysql_fetch_array(mysql_query("SELECT * FROM penjualan_resep WHERE no_resep='$nofaktur'"));
							echo $getjual['total'];
						?>
					</th>
				</tr>
				<tr>
					<th colspan="3" class='text-right'>Bayar</th>
					<th class='text-center'>
						<?php 
							echo $getjual['bayar'];
						?>
					</th>
				</tr>
				<tr>
					<th colspan="3" class='text-right'>Kembalian</th>
					<th class='text-center'>
						<?php 
							echo $getjual['kembalian'];
						?>
					</th>
				</tr>
			</tfoot>
			<tbody>
				<?php 
					$no=1;
					$getpenjualan = mysql_query("SELECT * FROM faktur_penjualan_resep WHERE no_resep='$nofaktur'");
					while ($penjualan=mysql_fetch_array($getpenjualan)) {
				?>
				<tr>
					<td class="text-center"><?php echo $no; ?></td>
					<td class="text-center">
						<?php
						$idobat = $penjualan['id_obat'];
						$obat = mysql_fetch_array(mysql_query("SELECT * FROM obat WHERE id_obat=$idobat"));
						echo $obat['nama_obat'];
						?>
					</td>
					<td class="text-center"><?php echo $penjualan['jumlah']; echo ' '; echo $obat['satuan']; ?></td>
					<td class="text-center"><?php echo $penjualan['subtotal']; ?></td>
				</tr>
				<?php $no++; } ?>
			</tbody>
		</table>
		<p class='text-center text-muted'>- Terimakasih telah membeli obat di apotik kami. Semoga lekas sembuh - </p>
		<iframe name="print_frame" width="0" height="0" frameborder="0" src="about:blank"></iframe>
	</div>
		<br>
		<br>
		<center>
			<a class='btn btn-info btn-lg' onclick="printDiv('div1')"><i class='fa fa-print'></i> Print</a>
		</center>
</body>
</html>