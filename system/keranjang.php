<?php
include("koneksi.php");
$nama_obat = $_POST['nama'];
$id_supplier = $_POST['pemasok'];
$satuan = $_POST['satuan'];
$harga_beli = $_POST['hrg_beli'];
$harga_jual = $_POST['hrg_jual'];
$stok = $_POST['stok'];
$get = mysql_query("SELECT stok FROM obat WHERE nama_obat='$nama_obat'");
list($fetch) = mysql_fetch_array($get);
$stok2 = $fetch + $stok;

$execute = mysql_query("UPDATE obat SET satuan='$satuan', harga_beli='$harga_beli', harga_jual='$harga_jual', stok='$stok2' WHERE nama_obat='$nama_obat'");
if ($execute) {
	function randStrGen($len){
    $result = "";
    $chars = "abcdefghijklmnopqrstuvwxyz0123456789";
    $charArray = str_split($chars);
    for($i = 0; $i < $len; $i++){
	    $randItem = array_rand($charArray);
	    $result .= "".$charArray[$randItem];
    }
    return $result;
	}

	// Usage example
	$randstr = randStrGen(5);

	$insert = mysql_query("INSERT INTO fakturpembelian VALUES ('$randstr','')")
	header("Location:../entri-data/beli-obat.php?info=1");
}
else {
	echo "error";
}
 ?>