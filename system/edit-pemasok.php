<?php
include("koneksi.php");
$id = $_POST['id'];
$nama = $_POST['nama'];
$alamat = $_POST['alamat'];
$notelp = $_POST['notelp'];
	$update = mysql_query("UPDATE supplier SET nama='$nama', alamat='$alamat', telepon_supplier='$notelp' WHERE id_supplier=$id");
	if ($update) {
		header("Location:../lihat-data/pemasok.php?info=4");
	}
 ?>