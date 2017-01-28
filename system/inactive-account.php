<?php 
include("koneksi.php");
$id = (int) $_GET['id'];
$update = mysql_query("UPDATE users SET status='active' WHERE id_user=$id");
if ($update) {
	header("Location:../lihat-data/user.php?info=2");
}
 ?>