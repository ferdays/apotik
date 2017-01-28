<?php 
include('koneksi.php');
$set = mysql_query("UPDATE pengaturanweb SET status='active'");
if ($set) {
	header("Location:../index.php?mt=2");
}
?>