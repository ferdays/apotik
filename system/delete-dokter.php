<?php 
include("koneksi.php");
$id = $_GET['id'];
$hapus = mysql_query("DELETE from dokter where id_dokter='$id'");
if ($hapus) {
	header("Location:../lihat-data/dokter.php?info=1");
}
 ?>