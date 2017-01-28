<?php
include("koneksi.php");
$pemasok = $_POST["pemasok"];
$obat = $_POST["nama"];
$satuan = $_POST["satuan"];
$tanggalwaktu = $_POST["tanggalwaktu"];
$hargabeli = $_POST["hrg_beli"];
$hargajual = $_POST["hrg_jual"];
$jumlah = $_POST["jumlah"];
$id_user = $_POST["id_user"];
$keranjang = $_POST["keranjang"];
$kadaluarsa = $_POST["kadaluarsa"];
if (isset($_POST["resep"])) {
	$resep = 1;	
}
else {
	$resep = 0;
}
$get=mysql_fetch_array(mysql_query("SELECT * FROM keranjang WHERE id_obat='$obat' AND tipe='beli'"));
$jumlahasal = $get['jumlah'];
$idobat = $get['id_obat'];
if ($obat==$idobat) {
	$tambah = $jumlah + $jumlahasal;
	$update = mysql_query("UPDATE keranjang SET jumlah='$tambah' WHERE id_obat='$obat'");
	if ($update) {
		header("Location:../entri-data/beli-obat.php");
	}
}
else{
$sql = mysql_query("INSERT INTO keranjang(id_supplier, id_obat, id_user, satuan, tanggal_beli, harga_beli, harga_jual, jumlah, resep, tipe, kadaluarsa) VALUES('$pemasok','$obat','$id_user','$satuan','$tanggalwaktu','$hargabeli','$hargajual','$jumlah','$resep','beli','$kadaluarsa')");
    if ($sql){
        header("Location:../entri-data/beli-obat.php");
    }
}
        ?> 