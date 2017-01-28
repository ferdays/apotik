<?php 
include("koneksi.php");
$id = $_POST['id'];
$pass1 = md5($_POST['password']);
$pass2 = md5($_POST['password1']);
if ($pass1 == $pass2) {
	$sql = mysql_query("UPDATE users SET password='$pass1' WHERE id_user=$id");
	header("Location:../pengaturan/change-password.php?info=1");
}
else {
	header("Location:../pengaturan/change-password.php?info=2");
}
 ?>