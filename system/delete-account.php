<?php 
include("koneksi.php");
$id = (int) $_GET['id'];
$hapus = mysql_query("DELETE from users where id_user=$id");
if ($hapus) {
	header("Location:../lihat-data/user.php?info=1");
}
 ?>