<?php  
session_start();  
ob_start();  
include_once("../system/koneksi.php");
$nofaktur   = $_GET['nofaktur'];
$faktur_pembelian  = mysql_query("SELECT * FROM faktur_pembelian WHERE no_faktur='".$nofaktur."'");  
$data   = mysql_fetch_array($faktur_pembelian);
$pembelian = mysql_query("SELECT * FROM pembelian WHERE no_faktur='".$nofaktur."'");
$datapembelian = mysql_fetch_array($pembelian);
$id_supplier = $datapembelian['id_supplier'];
$supplier = mysql_query("SELECT * FROM supplier WHERE id_supplier='".$id_supplier."'");
$datasupplier = mysql_fetch_array($supplier);
?>
<html>
<head>
	<title>Bukti Pembelian Obat | <?php echo $nofaktur; ?></title>
	<style type="text/css">
	body {
		font-family: 'Calibri',sans-serif;
	}
	</style>
</head>
<body>
		<img src="../img/logo.png" style="position: absolute;left: 28%;margin-right: -28%;transform: translate(-28%);">
		<p style='margin-top:-10px;text-align:center;'>Jl. Lebak, Kp. Gunung Bentang, Kec. Padalarang, Ds. Jaya Mekar, Kab. Bandung Barat</p>
		<hr>
		<table style="width:100%;">
			<tr>
				<td style="width:60%;">
					<table>
					<tr>
						<td>Pemasok Obat</td><td>: &nbsp; &nbsp; <b><?php echo $datasupplier['nama']; ?></b></td>
					</tr>
					<tr>
						<td>Alamat</td><td>: &nbsp; &nbsp; <b><?php echo $datasupplier['alamat']; ?></b></td>
					</tr>
					<tr>
						<td>No. Telepon</td><td>: &nbsp; &nbsp; <b><?php echo $datasupplier['telepon_supplier']; ?></b></td>
					</tr>
					</table>
				</td>
				<td style="width:40%;">
					<table align="right" style="margin-top:-50px;">
						<tr>
							<td>Tanggal</td><td>: &nbsp; &nbsp; <b><?php echo $datapembelian['tanggal']; ?></b></td>
						</tr>
						<tr>
							<td>No. Faktur</td><td>: &nbsp; &nbsp; <b style='text-transform:uppercase;'><?php echo $datapembelian['no_faktur']; ?></b></td>
						</tr>
					</table>
				</td>
			</tr>
		</table>
		<hr style="margin-top:-100px;">
		<h1 style="margin:0;">Bukti Pembelian Obat</h1>
		<table style="width:100%;text-align:center;border:#d4d4d4;border-collapse:collapse;" border='1'>
			<tr>
				<td style="width:5%;padding:10px;">No.</td>
				<td style="width:35%">Nama Obat</td>
				<td style="width:20%">Jumlah Pembelian</td>
				<td style="width:20%">Harga Beli</td>
				<td style="width:20%">Sub Total</td>
			</tr>
			<?php 
			$no = 1;
			$faktur_pembelian2 = mysql_query("SELECT * FROM faktur_pembelian WHERE no_faktur='$nofaktur'");
			while ($data2=mysql_fetch_array($faktur_pembelian2)) {
			$idobat = $data2['id_obat'];
			$obat = mysql_fetch_array(mysql_query("SELECT * FROM obat WHERE id_obat=$idobat"));
			?>
			<tr>
				<td style="padding:10px;"><?php echo $no; ?></td>
				<td><?php echo $obat['nama_obat']; ?></td>
				<td><?php echo $data2['jumlah']; ?> <?php echo $obat['satuan']; ?></td>
				<td>Rp. <?php echo number_format($data2['harga_beli'],2,",","."); ?></td>
				<td>Rp. <?php echo number_format($data2['subtotal'],2,",","."); ?></td>
			</tr>
			<?php $no++; } ?>
			<tr>
				<td colspan="4" style='text-align:right;padding:10px;'> Total &nbsp; </td>
				<td>Rp. <?php echo number_format($datapembelian['total'],2,",","."); ?></td>
			</tr>
		</table>
		<div class="footer">
			<table style="width:100%;">
				<tr>
					<td style="width:50%;">
						<p style='text-align:center;'>Pemasok</p>
						<br>
						<br>
						<p style='text-align:center;'>(..............................)</p>
					</td>
					<td style="width:50%;">
						<p style='text-align:center;'>Pegawai APOTIK</p>
						<br>
						<br>
						<p style='text-align:center;'>(..............................)</p>
					</td>
				</tr>
			</table>
		</div>
</body>
</html>
<?php  
$filename="fakturpembelian-".$nofaktur.".pdf"; //ubah untuk menentukan nama file pdf yang dihasilkan nantinya  
//==========================================================================================================  
//Copy dan paste langsung script dibawah ini,untuk mengetahui lebih jelas tentang fungsinya silahkan baca-baca tutorial tentang HTML2PDF  
//==========================================================================================================  
$content = ob_get_clean();  
$content = '<page style="font-family: freeserif">'.nl2br($content).'</page>';  
 require_once('../html2pdf/html2pdf.class.php');  
 try  
 {  
  $html2pdf = new HTML2PDF('P','A4','en', false, 'ISO-8859-15',array(10, 0, 10, 0));  
  $html2pdf->setDefaultFont('Arial');  
  $html2pdf->writeHTML($content, isset($_GET['vuehtml']));  
  $html2pdf->Output($filename);  
 }  
 catch(HTML2PDF_exception $e) { echo $e; }  
?>  