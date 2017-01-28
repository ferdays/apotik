<?php
include("koneksi.php");
$nama = $_POST['nama'];
$alamat = $_POST['alamat'];
$no_telepon = $_POST['no_telepon'];
$id_dokter = $_POST['id_dokter'];
	$update = mysql_query("UPDATE dokter SET nama='$nama', alamat='$alamat', no_telepon='$no_telepon' WHERE id_dokter='$id_dokter'");
	if ($update) {
		header("Location:../lihat-data/dokter.php?info=2");
	}
 ?>