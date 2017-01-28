<?php 
	include("koneksi.php");
	$id_obat = $_POST['id_obat'];
	$jumlah = $_POST['jumlah'];
	$subtotal = $_POST['subtotal'];
	$nama_obat = $_POST['nama_obat'];
	$satuan = $_POST['satuan'];
	$harga_beli = $_POST['harga_beli'];
	$harga_jual = $_POST['harga_jual'];
	$id_supplier = $_POST['id_supplier'];
	$row = count($id_obat);
	$tanggalbeli = $_POST['tanggal_beli'];
	$totalbayar = $_POST['totalbayar'];
	$id_user = $_POST['id_user'];
	$resep = $_POST['resep'];
	$kodebeli = $_POST['kodebeli'];
	$kadaluarsa = $_POST['kadaluarsa'];
	for ($i=0; $i < $row; $i++) {
		$stok2 = mysql_query("SELECT SUM(stok) FROM obat WHERE id_obat='$id_obat[$i]'");
		$stok = mysql_fetch_array($stok2);
		$stok3 = $stok['SUM(stok)'];
		$jumlah2 = $stok3 + $jumlah[$i];
		$dataobat = mysql_query("SELECT * FROM obat WHERE id_obat='$id_obat[$i]'");
		$getobat = mysql_fetch_array($getobat);
		$execute = "INSERT INTO faktur_pembelian VALUES ('','$kodebeli','$id_obat[$i]','$tanggalbeli[$i]','$harga_beli[$i]','$jumlah[$i]','$subtotal[$i]','$id_user')";
		$execute2 = mysql_query($execute);
		$execute3 = mysql_query("UPDATE obat SET satuan='$satuan[$i]', harga_beli='$harga_beli[$i]', harga_jual='$harga_jual[$i]', stok='$jumlah2', resep='$resep[$i]', kadaluarsa='$kadaluarsa[$i]' WHERE id_obat='$id_obat[$i]'");
	}
	$executepembelian = mysql_query("INSERT INTO pembelian(no_faktur, id_supplier, tanggal, total) VALUES ('$kodebeli','$id_supplier','$tanggalbeli[0]','$totalbayar')");
	mysql_query("DELETE FROM keranjang");
	header("Location:../lihat-data/detail-pembelian-obat.php?nofaktur=".$kodebeli."&info=1");
 ?>