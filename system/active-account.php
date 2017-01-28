<?php 
include("koneksi.php");
$id = (int) $_GET['id'];
$update = mysql_query("UPDATE users SET status='inactive' WHERE id_user=$id");
if ($update) {
	header("Location:../lihat-data/user.php?info=3");
}
 ?>