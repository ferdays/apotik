<?php 
include("koneksi.php");
$id = (int) $_GET['id'];
$hapus = mysql_query("DELETE FROM obat WHERE id_obat=$id");
if ($hapus) {
	header("Location:../lihat-data/obat.php?info=1");
}
 ?>