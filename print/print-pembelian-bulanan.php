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
		<h3 class='text-center'>Rekap Pembelian Obat Bulan <?php echo $namabulan[$bulan]; ?></h3>
		<br>
		<table class="table table-bordered">
			<thead>
				<tr>
					<th class="text-center">No.</th>
					<th class="text-center">Tanggal Pembelian</th>
					<th class="text-center">Pemasok</th>
					<th class="text-center">No. Faktur</th>
					<th class="text-center">Nama Obat</th>
					<th class="text-center">Harga Beli</th>
					<th class="text-center">Jumlah Pembelian</th>
					<th class="text-center">Total</th>
				</tr>
			</thead>
			<tfoot>
				<th colspan="7" class="text-right">Total Pembelian</th>
				<th>
					Rp. <?php
						$bulan3 = $bulan + 1;
						$gettotal = mysql_query("SELECT SUM(subtotal) FROM faktur_pembelian WHERE MONTH(tanggal)=$bulan3");
						$total = mysql_fetch_array($gettotal);
						echo number_format($total['SUM(subtotal)'],2,",",".");
					?>
				</th>
			</tfoot>
			<tbody>
				<?php
					$no = 1;
					$bulan2 = $bulan + 1;
					$getbulanan = mysql_query("SELECT * FROM faktur_pembelian WHERE MONTH(tanggal)=$bulan2 ORDER BY id_faktur DESC");
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
					<td class="text-center">
						<?php 
						$nofaktur = $bulanan['no_faktur'];
						$getidpemasok = mysql_query("SELECT * FROM pembelian WHERE no_faktur='$nofaktur'");
						$idpemasok = mysql_fetch_array($getidpemasok);
						$idpemasok2 = $idpemasok['id_supplier'];
						$getpemasok = mysql_query("SELECT * FROM supplier WHERE id_supplier=$idpemasok2");
						$pemasok = mysql_fetch_array($getpemasok);
						echo $pemasok['nama'];
						?>
					</td>
					<td class="text-center"><?php echo $bulanan['no_faktur']; ?></td>
					<td class="text-center">
						<?php
							$idobat = $bulanan['id_obat'];
							$getobat = mysql_query("SELECT * FROM obat WHERE id_obat=$idobat");
							$obat = mysql_fetch_array($getobat);
							echo "<b>".$obat['nama_obat']."</b>";
						?>
					</td>
					<td class="text-center">Rp. <?php echo number_format($bulanan['harga_beli'],2,",","."); ?></td>
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