<?php 
include("koneksi.php");
$id = (int) $_GET['id'];
$hapus = mysql_query("DELETE from supplier where id_supplier=$id");
if ($hapus) {
	header("Location:../lihat-data/pemasok.php?info=1");
}
 ?>