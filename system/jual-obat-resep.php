<?php 
	include("koneksi.php");
	$id_obat = $_POST['idobat'];
	$harga = $_POST['harga'];
	$jumlah = $_POST['jumlah'];
	$subtotal = $_POST['subtotal'];
	$row = count($id_obat);
	$tanggalbeli = $_POST['tanggal'];
	$totalbayar = $_POST['totalbayar'];
	$id_user = $_POST['id_user'];
	$bayar = $_POST['bayar'];
	$kembalian = $_POST['kembalian'];
	$noresep = $_POST['idresep'];
	$id_dokter = $_POST['iddokter'];
	$namapasien = $_POST['namapasien'];
	if ($bayar < $totalbayar) {
		header("Location: ../entri-data/jual-obat.php?info=2");
	}
	else{
	for ($i=0; $i < $row; $i++) {
		$stok2 = mysql_query("SELECT SUM(stok) FROM obat WHERE id_obat='$id_obat[$i]'");
		$stok = mysql_fetch_array($stok2);
		$stok3 = $stok['SUM(stok)'];
		$jumlah2 = $stok3 - $jumlah[$i];
		$dataobat = mysql_query("SELECT * FROM obat WHERE id_obat='$id_obat[$i]'");
		$getobat = mysql_fetch_array($dataobat);
		$execute = "INSERT INTO faktur_penjualan_resep VALUES ('','$id_obat[$i]','$noresep','$harga[$i]','$jumlah[$i]','$subtotal[$i]','$id_user','$tanggalbeli')";
		$execute2 = mysql_query($execute);
		$execute3 = mysql_query("UPDATE obat SET stok='$jumlah2' WHERE id_obat='$id_obat[$i]'");
	}
	$executepembelian = mysql_query("INSERT INTO penjualan_resep(no_resep, id_dokter, tanggal, total, bayar, kembalian, namapasien) VALUES ('$noresep','$id_dokter','$tanggalbeli','$totalbayar','$bayar','$kembalian','$namapasien')");
	mysql_query("DELETE FROM keranjang");
	header("Location: ../lihat-data/detail-penjualan-obat-resep.php?nofaktur=".$noresep);
	}
 ?>