<?php 
include("koneksi.php");
$id = $_GET['id'];
if ($id!="all") {
	$hapus = mysql_query("DELETE from keranjang where id_keranjang=$id");
	if ($hapus) {
		header('Location: ' . $_SERVER['HTTP_REFERER']);
	}
}
elseif ($id=="all") {
	$hapusall = mysql_query("DELETE FROM keranjang WHERE id_dokter='0'");
	if ($hapusall) {
		header('Location: ' . $_SERVER['HTTP_REFERER']);
	}
}
elseif ($id=="allresep") {
	$hapusall2 = mysql_query("DELETE FROM keranjang WHERE id_dokter!='0'");
	if ($hapusall2) {
		header('Location: ' . $_SERVER['HTTP_REFERER']);
	}
}
 ?>