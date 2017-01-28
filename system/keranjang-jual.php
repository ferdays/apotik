<?php
include("koneksi.php");
$obat = $_POST["nama"];
$jumlah = $_POST["jumlah"];
$id_user = $_POST["id_user"];
$resep = $_POST["resep"];
if (isset($_POST["iddokter"])) {
	$iddokter = $_POST["iddokter"];
}
else {
	$iddokter = 0;
}
date_default_timezone_set("Asia/Pontianak");
$tanggal = date("Y-m-d H:i:s");
$getharga = mysql_fetch_array(mysql_query("SELECT * FROM obat WHERE id_obat=$obat"));
$harga = $getharga['harga_jual'];
$stok = $getharga['stok'];
if ($jumlah > $stok) {
	header("Location: ../entri-data/jual-obat.php?info=1");
}
else{
$get=mysql_fetch_array(mysql_query("SELECT * FROM keranjang WHERE id_obat='$obat' AND tipe='jual'"));
$jumlahasal = $get['jumlah'];
$idobat = $get['id_obat'];
if ($obat==$idobat) {
	$tambah = $jumlah + $jumlahasal;
	$update = mysql_query("UPDATE keranjang SET jumlah='$tambah' WHERE id_obat='$obat'");
	if ($update) {
		header("Location:../entri-data/jual-obat.php");
	}
}
else{
$sql = mysql_query("INSERT INTO keranjang(id_obat, id_user, id_dokter, tanggal_beli, harga_beli, jumlah, tipe, resep) VALUES('$obat','$id_user','$iddokter','$tanggal','$harga','$jumlah','jual','$resep')");
    if ($sql){
        header("Location:../entri-data/jual-obat.php");
    }
}
} ?> 