<?php
include("koneksi.php");
$id = $_POST['id'];
$nama = $_POST['nama'];
$jabatan = $_POST['jabatan'];
	$update = mysql_query("UPDATE users SET nama='$nama', role='$jabatan' WHERE id_user=$id");
	if ($update) {
		header("Location:../lihat-data/user.php?info=4");
	}
 ?>