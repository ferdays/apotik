<?php
include("koneksi.php");
$nama = $_POST['namaobatbaru'];
$sql = mysql_query("SELECT * FROM obat WHERE nama_obat='$nama'");
$hasil = mysql_fetch_array($sql);
    if ($hasil['nama_obat'] != $nama){
        mysql_query("INSERT INTO obat(nama_obat) VALUES('$nama')");
        header("Location:../entri-data/beli-obat.php?info=1");
    }
    else{
        header("Location:../entri-data/beli-obat.php?info=2");   
    }
        ?> 