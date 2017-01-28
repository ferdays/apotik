<?php
$nama = $_POST['nama'];
$satuan = $_POST['satuan'];
$hargabeli = $_POST['hrg_beli'];
$hargajual = $_POST['hrg_jual'];
$id = $_POST['id_obat'];
$get = mysql_query("SELECT * FROM obat WHERE id_obat='$id'");
$nama2 = mysql_fetch_array($get);
if ($nama==$nama2) {
	header("Location:../lihat-data/obat.php?info=2");
}
else {
	$update = mysql_query("UPDATE obat SET nama_obat='$nama', satuan='$satuan', harga_beli='$hargabeli', harga_jual='$hargajual' WHERE id_obat=$id");
	if ($update) {
		header("Location:../lihat-data/obat.php?info=3");
	}
}
 ?>