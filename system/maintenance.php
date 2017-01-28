<?php 
include('koneksi.php');
$set = mysql_query("UPDATE pengaturanweb SET status='mt'");
if ($set) {
	header("Location:../index.php?mt=1");
}
?>